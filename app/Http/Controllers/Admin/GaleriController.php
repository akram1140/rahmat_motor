<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest('id')->get();
        return view('admin.galeri.index', compact('galeri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:bengkel,servis,mekanik,hasil_kerja,lainnya',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $file = $request->file('gambar');
        $gambarName = 'gal_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/uploads'), $gambarName);

        Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'gambar' => $gambarName,
        ]);

        return redirect()->back()->with('success', 'Foto baru berhasil ditambahkan ke galeri.');
    }

    public function destroy($id)
    {
        $foto = Galeri::findOrFail($id);
        $foto->delete();
        return redirect()->back()->with('success', 'Foto galeri berhasil dihapus.');
    }
}
