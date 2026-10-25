<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingServis;
use App\Models\Galeri;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\PesanKontak;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pelanggan' => Pelanggan::count(),
            'total_layanan' => Layanan::where('status', 'aktif')->count(),
            'total_booking' => BookingServis::count(),
            'booking_menunggu' => BookingServis::where('status', 'Menunggu')->count(),
            'booking_dikonfirmasi' => BookingServis::where('status', 'Dikonfirmasi')->count(),
            'booking_ditolak' => BookingServis::where('status', 'Ditolak')->count(),
            'booking_diproses' => BookingServis::where('status', 'Diproses')->count(),
            'booking_selesai' => BookingServis::where('status', 'Selesai')->count(),
            'booking_dibatalkan' => BookingServis::where('status', 'Dibatalkan')->count(),
            'pesan_masuk' => PesanKontak::where('status', 'Belum Dibaca')->count(),
            'total_galeri' => Galeri::count(),
        ];

        $recent_bookings = BookingServis::with(['pelanggan', 'layanan'])
            ->latest('id')
            ->take(5)
            ->get();

        $recent_pesan = PesanKontak::latest('id')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_bookings', 'recent_pesan'));
    }
}
