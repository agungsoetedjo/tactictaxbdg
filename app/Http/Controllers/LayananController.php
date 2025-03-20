<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index()
    {
        if (Auth::user()?->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini!');
        }

        // $layanan = Layanan::with('kategori')
        // ->join('kategori', 'layanan.kategori_id', '=', 'kategori.id')
        // ->orderBy('kategori.id', 'asc') // Urutkan berdasarkan nama kategori
        // ->orderBy('layanan.id', 'asc') // Urutkan layanan setelah kategori
        // ->select('layanan.*')
        // ->get();
        $layanan = Layanan::with('kategori')->get();
        $kategori = Kategori::all();
        return view('masterdata.layanan', compact('layanan','kategori'));
    }

    // public function create()
    // {
    //     $layanan = Layanan::with('kategori')->get();
    //     $kategori = Kategori::all();
    //     return view('masterdata.tambah-layanan', compact('layanan','kategori'));
    // }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'slug' => Str::slug($request->nama),
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('uploads', 'public');
        }

        // Layanan::create($request->all());
        Layanan::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'slug' => Str::slug($request->nama),
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Cek apakah ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($layanan->gambar) {
                Storage::delete('public/' . $layanan->gambar);
            }
            // Simpan gambar baru
            $filePath = $request->file('gambar')->store('uploads', 'public');
        } else {
            // Gunakan gambar lama
            $filePath = $layanan->gambar;
        }

        // $layanan->update($request->all());
        $layanan->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'gambar' => $filePath,
            'kategori_id' => $request->kategori_id,
        ]);


        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->gambar) {
            Storage::disk('public')->delete($layanan->gambar);
        }

        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
