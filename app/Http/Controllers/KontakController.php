<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    // Menampilkan halaman Hubungi Kami
    public function index()
{
    $kontak = Kontak::all(); // Mengambil semua data kontak
    return view('masterdata.kontak', compact('kontak'));
}

public function store(Request $request)
{
    $request->validate([
        'pic' => 'nullable|string|max:100',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:100',
        'address' => 'nullable|string',
        'facebook' => 'nullable|url',
        'instagram' => 'nullable|url',
        'whatsapp' => 'nullable|string|max:20'
    ]);

    Kontak::create($request->all());

    return redirect()->route('kontak.index')->with('success', 'Kontak berhasil ditambahkan!');
}

public function update(Request $request, Kontak $kontak)
{
    $request->validate([
        'pic' => 'nullable|string|max:100',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:100',
        'address' => 'nullable|string',
        'facebook' => 'nullable|url',
        'instagram' => 'nullable|url',
        'whatsapp' => 'nullable|string|max:20'
    ]);

    $kontak->update($request->all());

    return redirect()->route('kontak.index')->with('success', 'Kontak berhasil diperbarui!');
}

}
