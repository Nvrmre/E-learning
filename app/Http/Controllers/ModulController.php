<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function __construct()
    {
        // Hanya admin & guru yang boleh create/edit/delete
        $this->middleware('role:admin|guru')->except(['showAllModul']);
    }

    public function showAllModul()
    {
        $moduls = Modul::with('classroom')->get();
        return view('modul.index', compact('moduls'));
    }

    public function create()
    {
        return view('modul.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'classroom_id' => 'required|exists:classrooms,id',
            'file' => 'nullable|file|mimes:pdf,mp4,docx,pptx|max:20480', // max 20MB
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('modul', 'public');
        }

        Modul::create($validated);

        return redirect()->route('modul.index')->with('success', 'Modul berhasil ditambahkan');
    }

    public function edit(Modul $modul)
    {
        return view('modul.edit', compact('modul'));
    }

    public function update(Request $request, Modul $modul)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'classroom_id' => 'required|exists:classrooms,id',
            'file' => 'nullable|file|mimes:pdf,mp4,docx,pptx|max:20480',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('modul', 'public');
        }

        $modul->update($validated);

        return redirect()->route('modul.index')->with('success', 'Modul berhasil diperbarui');
    }

    public function destroy(Modul $modul)
    {
        $modul->delete();
        return redirect()->route('modul.index')->with('success', 'Modul berhasil dihapus');
    }
}
