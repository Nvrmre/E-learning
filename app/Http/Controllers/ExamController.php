<?php

// Controller untuk Mengelola Ujian
namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function create()
    {
        $classrooms = Classroom::all(); // Ambil semua kelas
        return view('exams.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'exam_name' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        Exam::create($validated);

        return redirect()->route('exams.index')->with('success', 'Ujian berhasil ditambahkan');
    }

    public function index()
    {
        $exams = Exam::all();
        return view('exams.index', compact('exams'));
    }
}

