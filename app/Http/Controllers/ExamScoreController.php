<?php

// Controller untuk Mengelola Nilai Ujian
// ExamScoreController.php
namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamScore;
use App\Models\Student;
use Illuminate\Http\Request;

class ExamScoreController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya admin dan guru yang dapat mengakses create dan store
        $this->middleware('role:admin|guru')->only(['create', 'store']);
    }

    // Menampilkan daftar nilai ujian berdasarkan exam_id
    public function index(Exam $exam)
    {
        $scores = ExamScore::where('exam_id', $exam->id)->get();
        return view('exam_scores.index', compact('exam', 'scores'));
    }

    // Form untuk menambah nilai ujian
    public function create(Exam $exam)
    {
        $students = Student::all(); // Ambil semua siswa
        return view('exam_scores.create', compact('exam', 'students'));
    }

    // Menyimpan nilai ujian
    public function store(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'score' => 'required|integer|min:0|max:100',
        ]);

        // Menambahkan exam_id ke dalam data yang disimpan
        $validated['exam_id'] = $exam->id;

        // Simpan nilai ujian
        ExamScore::create($validated);

        return redirect()->route('exam_scores.index', $exam)->with('success', 'Nilai berhasil ditambahkan');
    }

    // Aksi lain (edit, update, delete) dapat mengikuti konvensi standar
}


