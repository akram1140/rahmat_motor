<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index()
    {
        $pesan = PesanKontak::latest('id')->paginate(15);
        return view('admin.pesan.index', compact('pesan'));
    }

    public function markAsRead($id)
    {
        $item = PesanKontak::findOrFail($id);
        $item->update(['status' => 'Sudah Dibaca']);
        return redirect()->back()->with('success', 'Pesan ditandai sebagai sudah dibaca.');
    }

    public function destroy($id)
    {
        $item = PesanKontak::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('success', 'Pesan kontak berhasil dihapus.');
    }
}
