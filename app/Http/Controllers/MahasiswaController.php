<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mahasiswa::query();
        
        if ($request->filled('program_studi')) {
            $query->where('program_studi', $request->program_studi);
        }
        
        $mahasiswas = $query->latest()->get();
        $programStudiList = Mahasiswa::select('program_studi')->distinct()->get();
        
        return view('mahasiswa.index', compact('mahasiswas', 'programStudiList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|unique:mahasiswas|max:20',
            'nama' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'program_studi' => 'required|max:255',
            'semester' => 'required|integer|min:1|max:14',
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        $validated = $request->validate([
            'nim' => 'required|max:20|unique:mahasiswas,nim,' . $id,
            'nama' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'program_studi' => 'required|max:255',
            'semester' => 'required|integer|min:1|max:14',
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
