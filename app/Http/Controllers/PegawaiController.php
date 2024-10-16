<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
class PegawaiController extends Controller
{
    public function index()
    {
        //
        $pegawai = Pegawai::latest()->paginate(10);
        return view('admin.page.pegawai', ['title' => 'halaman pegawai', 'name' => 'pegawai'], compact('pegawai'));
    }
    public function create()
    {
        //
        return view('admin.page.pegawais.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|numeric|digits_between:10,15',
        ]);

        Pegawai::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $pegawai = Pegawai::find($id);
        return view('admin.page.pegawais.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
        ]);

        $pegawai = Pegawai::find($id);
        $pegawai->update([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return redirect()->route('pegawai.index')->with('error', 'Pegawai tidak ditemukan.');
        }

        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
