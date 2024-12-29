<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::all();
        
        return view('classrooms.index',compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classrooms.create');
    }

    // Menyimpan kelas baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kelas' => 'required|string|max:255',
        ]);

        // Membuat data kelas baru
        Classroom::create([
            'kelas' => $request->kelas,
        ]);

        // Redirect kembali ke halaman kelas dengan pesan sukses
        return redirect()->route('classrooms.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        //
    }
}
