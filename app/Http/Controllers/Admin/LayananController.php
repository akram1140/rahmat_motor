<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::withCount('bookings')->orderBy('id', 'asc')->get();
        return view('admin.layanan.index', compact('layanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'estimasi_waktu' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $gambarName = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambarName = 'srv_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/uploads'), $gambarName);
        }

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'estimasi_waktu' => $request->estimasi_waktu,
            'status' => $request->status,
            'gambar' => $gambarName,
        ]);

        return redirect()->back()->with('success', 'Layanan bengkel baru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'estimasi_waktu' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $layanan = Layanan::findOrFail($id);

        $data = [
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'estimasi_waktu' => $request->estimasi_waktu,
            'status' => $request->status,
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambarName = 'srv_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/uploads'), $gambarName);
            $data['gambar'] = $gambarName;
        }

        $layanan->update($data);

        return redirect()->back()->with('success', 'Data layanan berhasil diperbarui.');
    }

    public function toggleStatus($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->status = ($layanan->status === 'aktif') ? 'nonaktif' : 'aktif';
        $layanan->save();

        return redirect()->back()->with('success', 'Status layanan ' . $layanan->nama_layanan . ' kini ' . $layanan->status . '.');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();
        return redirect()->back()->with('success', 'Layanan berhasil dihapus.');
    }
}
