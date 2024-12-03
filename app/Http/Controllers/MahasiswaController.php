<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data mahasiswa dari database
        $mahasiswa = Mahasiswa::all();
        
        // Tampilkan ke view
        return view('dashboard', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form tambah data mahasiswa
        return view('mahasiswa.mahasiswa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'npm' => 'required|unique:mahasiswa|max:15',
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:100',
        ]);

        // Simpan data ke database
        Mahasiswa::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Data mahasiswa berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tampilkan detail data mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Tampilkan form edit
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $validated = $request->validate([
            'npm' => 'required|max:15|unique:mahasiswa,npm,' . $id,
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:100',
        ]);

        // Update data di database
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Data mahasiswa berhasil dihapus!');
    }
    public function exportExcel (){
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }
}
