<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $role = $request->query('role');
        $users = $role
            ? User::where('role', $role)->with(['teacher', 'student'])->get()
            : User::with(['teacher', 'student'])->get();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $classrooms = Classroom::all();
        return view('admin.user.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,siswa,guru',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload foto profil jika ada
        $photoPath = null;
        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        // Simpan user utama
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'profile_photo_path' => $photoPath,
        ]);

        // Simpan ke tabel guru/siswa jika perlu
        if ($request->role === 'guru') {
            Teacher::create([
                'id_user' => $user->id,
                'nama_guru' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
            ]);
        } elseif ($request->role === 'siswa') {
            Student::create([
                'id_user' => $user->id,
                'nama_siswa' => $user->name,
                'kelas_id' => $request->kelas_id,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $classrooms = Classroom::all();
        return view('admin.user.edit', compact('user', 'classrooms'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'required|in:admin,siswa,guru',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cek jika ada upload foto baru
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Upload foto baru
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        } else {
            $photoPath = $user->profile_photo_path; // tetap pakai yang lama
        }

        // Update user
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
            'profile_photo_path' => $photoPath,
        ]);

        // Update data tambahan
        if ($user->role === 'guru' && $user->teacher) {
            $user->teacher->update(['nama_guru' => $request->name]);
        }

        if ($user->role === 'siswa' && $user->student) {
            $user->student->update(['nama_siswa' => $request->name]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Hapus foto dari storage jika ada
        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
