<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:siswa'); // Hanya siswa yang bisa mengakses
    }

    public function index()
    {
        return view('student.index');
    }

    // public function viewGrades()
    // {
    //     return view('student.grades');
    // }
}
