<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanBengkel;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanBengkel::first() ?? new PengaturanBengkel();
        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_bengkel' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'jam_buka' => 'required|string|max:20',
            'jam_tutup' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
            'maps_url' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $pengaturan = PengaturanBengkel::first();
        if (!$pengaturan) {
            $pengaturan = new PengaturanBengkel();
        }

        $data = [
            'nama_bengkel' => $request->nama_bengkel,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'deskripsi' => $request->deskripsi,
            'maps_url' => $request->maps_url,
        ];

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $logoName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/uploads'), $logoName);
            $data['logo'] = $logoName;
        }

        $pengaturan->fill($data);
        $pengaturan->save();

        return redirect()->back()->with('success', 'Pengaturan bengkel berhasil disimpan!');
    }
}
