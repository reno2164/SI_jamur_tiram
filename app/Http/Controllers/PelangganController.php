<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;

class Pelanggancontroller extends Controller
{
    public function index()
    {
        //
        $pelanggan = Pelanggan::latest()->paginate(10);
        return view('admin.page.pelanggan',['title'=>'halaman pelanggan', 'name' => 'Pelanggan'], compact('pelanggan'));
    }
    public function create()
    {
        //
        return view('admin.page.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'email'=> 'required|string',
            'password'=>'required|string',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|numeric|digits_between:10,15',
        ]);

        Pelanggan::create([
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $pelanggan = Pelanggan::find($id);
        return view('admin.page.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
        ]);

        $pelanggan = Pelanggan::find($id);
        $pelanggan->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return redirect()->route('pelanggan.index')->with('error', 'pelanggan tidak ditemukan.');
        }

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'pelanggan berhasil dihapus.');
    }
}
