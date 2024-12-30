<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){

        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $classrooms = Classroom::all(); // Mengambil semua kelas
        $teachers = Teacher::all(); // Ambil semua guru

    return view('courses.create', compact('classrooms', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:teachers,id',
            'mapel' => 'required|string',
            'materi_judul' => 'required|string',
            'materi_tipe' => 'required|in:pdf,text',
            'materi_text' => 'nullable|string',
            'materi_file' => 'nullable|file|mimes:pdf|max:2048',
            'kelas_id' => 'required|exists:classrooms,id',
        ]);

        $materi_file = null;

        if ($request->materi_tipe === 'pdf' && $request->hasFile('materi_file')) {
            $materi_file = $request->file('materi_file')->store('materi');
        }

        Course::create([
            'guru_id' => auth()->id(), // ID guru (disesuaikan dengan login)
            'kelas_id' => $request->kelas_id, // Tambahkan input untuk kelas_id jika diperlukan
            'mapel' => $request->mapel,
            'materi_judul' => $request->materi_judul,
            'materi_text' => $request->materi_text,
            'materi_file' => $materi_file,
            'materi_tipe' => $request->materi_tipe,
        ]);

        return redirect()->route('courses.index')->with('success', 'Materi berhasil diupload.');
    }
}

