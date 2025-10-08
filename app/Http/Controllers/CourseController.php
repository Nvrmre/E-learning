<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Menampilkan daftar semua materi (course)
     */
    public function index()
    {
        // Ambil semua data course dengan pagination agar ringan
        $courses = Course::with('teacher', 'classroom')->paginate(10);

        return view('courses.index', compact('courses'));
    }

    /**
     * Menampilkan form untuk membuat materi baru
     */
    public function create()
    {
        // Ambil semua kelas dan guru untuk dropdown di form
        $classrooms = Classroom::all();
        $teachers = Teacher::all();

        return view('courses.create', compact('classrooms', 'teachers'));
    }

    /**
     * Menyimpan data materi ke database
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'mapel' => 'required|string',
            'materi_judul' => 'required|string',
            'materi_tipe' => 'required|in:pdf,text',
            'materi_text' => 'nullable|string',
            'materi_file' => 'nullable|file|mimes:pdf|max:2048',
            'kelas_id' => 'required|exists:classrooms,id',
        ]);

        // Gunakan data guru langsung dari form
        $teacher = Teacher::find($request->guru_id);

        if (!$teacher) {
            return back()->withErrors(['error' => 'Guru tidak ditemukan.']);
        }

        // Jika materi berupa file PDF, simpan filenya
        $materi_file = null;
        if ($request->materi_tipe === 'pdf' && $request->hasFile('materi_file')) {
            // File disimpan di storage/app/materi
            $materi_file = $request->file('materi_file')->store('materi','public');
        }

        // Simpan data ke tabel courses
        Course::create([
            'guru_id' => $teacher->id, // ID guru dari tabel teachers
            'kelas_id' => $request->kelas_id, // ID kelas dari form
            'mapel' => $request->mapel,
            'materi_judul' => $request->materi_judul,
            'materi_text' => $request->materi_text,
            'materi_file' => $materi_file,
            'materi_tipe' => $request->materi_tipe,
        ]);

        // Redirect ke halaman daftar materi dengan pesan sukses
        return redirect()->route('courses.index')->with('success', 'Materi berhasil diupload.');
    }

    /**
     * Menampilkan detail dari satu materi
     */
    public function show($id)
    {
        $course = Course::with('teacher', 'classroom')->findOrFail($id);
        return view('courses.show', compact('course'));
    }

    /**
     * Menampilkan form edit materi
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $classrooms = Classroom::all();

        return view('courses.edit', compact('course', 'classrooms'));
    }

    /**
     * Menyimpan perubahan data materi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'mapel' => 'required|string',
            'materi_judul' => 'required|string',
            'materi_tipe' => 'required|in:pdf,text',
            'materi_text' => 'nullable|string',
            'materi_file' => 'nullable|file|mimes:pdf|max:2048',
            'kelas_id' => 'required|exists:classrooms,id',
        ]);

        $course = Course::findOrFail($id);

        // Jika upload file baru, ganti file lama
        if ($request->materi_tipe === 'pdf' && $request->hasFile('materi_file')) {
            $materi_file = $request->file('materi_file')->store('materi');
        } else {
            $materi_file = $course->materi_file;
        }

        $course->update([
            'kelas_id' => $request->kelas_id,
            'mapel' => $request->mapel,
            'materi_judul' => $request->materi_judul,
            'materi_text' => $request->materi_text,
            'materi_file' => $materi_file,
            'materi_tipe' => $request->materi_tipe,
        ]);

        return redirect()->route('courses.index')->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Menghapus materi dari database
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Materi berhasil dihapus.');
    }
}
