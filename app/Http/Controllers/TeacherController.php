<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:guru'); // Hanya guru yang bisa mengakses
    }

    public function index()
    {
        return view('guru.dashboard');
    }

    public function manageClass()
    {
        // Mengelola kelas, hanya untuk guru
        return view('guru.manage-class');
    }
}
