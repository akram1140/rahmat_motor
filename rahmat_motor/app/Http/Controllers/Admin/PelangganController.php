<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));
        $query = Pelanggan::withCount('bookings');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        $pelanggan = $query->latest('id')->paginate(15)->withQueryString();
        return view('admin.pelanggan.index', compact('pelanggan', 'search'));
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return redirect()->back()->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
