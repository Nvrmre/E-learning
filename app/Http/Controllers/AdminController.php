<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkrole:admin'); // Hanya admin yang bisa mengakses manajemen pengguna
    }

    public function index(Request $request)
    {
        $role = $request->query('role'); // Menangkap query parameter 'role'

        // Jika role ditentukan, filter berdasarkan role
        if ($role) {
            // Menampilkan pengguna sesuai dengan role yang dipilih
            $users = User::where('role', $role)
                         ->with(['teacher', 'student']) // Memuat relasi teacher dan student
                         ->get();
        } else {
            $users = User::with(['teacher', 'student'])->get(); // Memuat relasi teacher dan student
        }
    
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $classrooms = Classroom::all();
        return view('admin.user.create',compact('classrooms')); // Form untuk membuat pengguna baru
    }
// Store Method
public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:admin,siswa,guru', // Validasi role
    ]);

    // Membuat pengguna baru
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
    ]);

    // Jika role adalah guru, tambahkan data ke tabel teachers
    if ($request->role == 'guru') {
        // Menambahkan data ke tabel teachers
        \App\Models\Teacher::create([
            'id_user' => $user->id, // Menyimpan user_id sebagai referensi ke users
            'email' => $request->email, // Menyimpan email dari form
            'nama_guru' => $request->nama_guru, // Menyimpan nama guru dari form
            'password' => bcrypt($request->password), // Menyimpan password (jika diperlukan, bisa diubah)
        ]);
    }
    if ($request->role == 'siswa') {
        \App\Models\Student::create([
            'id_user' => $user->id, // Menyimpan user_id sebagai referensi ke users
            'nama_siswa' => $request->nama_siswa, // Nama siswa
            'kelas_id' => $request->kelas_id, // ID kelas siswa
        ]);
    }

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}


// Update Method
public function update(Request $request, User $user)
{
    // Validasi data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'role' => 'required|in:admin,siswa,guru', // Validasi role
    ]);

    // Update pengguna
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? bcrypt($request->password) : $user->password,
        'role' => $request->role,  // Pastikan role yang dipilih disimpan
    ]);

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}


    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user')); // Form untuk edit pengguna
    }

    public function destroy(User $user)
    {
        $user->delete(); // Menghapus pengguna
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}

