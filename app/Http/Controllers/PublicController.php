<?php

namespace App\Http\Controllers;

use App\Models\BookingServis;
use App\Models\Galeri;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\PengaturanBengkel;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    private function getBengkel()
    {
        return PengaturanBengkel::first() ?? new PengaturanBengkel([
            'nama_bengkel' => 'Rahmat Motor',
            'alamat' => 'Baebunta, Kabupaten Luwu Utara, Sulawesi Selatan',
            'no_hp' => '082300017150',
            'whatsapp' => '6282300017150',
            'email' => 'rahmatmotor@gmail.com',
            'jam_buka' => '08.00',
            'jam_tutup' => '17.00',
            'deskripsi' => 'Bengkel Servis, Perawatan & Perbaikan Sepeda Motor Terpercaya di Baebunta Luwu Utara.',
            'maps_url' => 'https://maps.google.com/maps?q=Rahmat%20Motor%20Baebunta%20Luwu%20Utara%20Sulawesi%20Selatan&output=embed',
        ]);
    }

    public function index()
    {
        $pengaturan = $this->getBengkel();
        $layanan = Layanan::where('status', 'aktif')->take(6)->get();
        $galeri = Galeri::latest('id')->take(6)->get();
        return view('public.index', compact('pengaturan', 'layanan', 'galeri'));
    }

    public function layanan()
    {
        $pengaturan = $this->getBengkel();
        $layanan = Layanan::where('status', 'aktif')->get();
        return view('public.layanan', compact('pengaturan', 'layanan'));
    }

    public function booking()
    {
        $pengaturan = $this->getBengkel();
        $layanan = Layanan::where('status', 'aktif')->get();
        return view('public.booking', compact('pengaturan', 'layanan'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'layanan_id' => 'required|exists:layanan,id',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jam_booking' => 'required',
            'keluhan' => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::firstOrCreate(
            ['no_hp' => trim($request->no_hp)],
            ['nama' => trim($request->nama), 'alamat' => trim($request->alamat ?? '')]
        );

        if ($request->filled('nama') || $request->filled('alamat')) {
            $pelanggan->update([
                'nama' => trim($request->nama),
                'alamat' => trim($request->alamat ?? $pelanggan->alamat),
            ]);
        }

        $booking = BookingServis::create([
            'pelanggan_id' => $pelanggan->id,
            'layanan_id' => $request->layanan_id,
            'tanggal_booking' => $request->tanggal_booking,
            'jam_booking' => $request->jam_booking,
            'keluhan' => $request->keluhan,
            'status' => 'Menunggu',
        ]);

        return redirect()->route('cek-booking', ['q' => $booking->id])
            ->with('success', 'Booking berhasil diajukan! Kode Booking Anda: #' . str_pad($booking->id, 3, '0', STR_PAD_LEFT));
    }

    public function cekBooking(Request $request)
    {
        $pengaturan = $this->getBengkel();
        $q = trim($request->input('q', ''));
        $bookings = collect();

        if (!empty($q)) {
            $clean_num = preg_replace('/[^0-9]/', '', $q);

            $bookings = BookingServis::with(['pelanggan', 'layanan'])
                ->where(function ($query) use ($q, $clean_num) {
                    if (!empty($clean_num)) {
                        $query->where('id', (int)$clean_num)
                              ->orWhereHas('pelanggan', function ($sub) use ($clean_num) {
                                  $sub->where('no_hp', 'like', "%{$clean_num}%");
                              });
                    }
                    $query->orWhereHas('pelanggan', function ($sub) use ($q) {
                        $sub->where('nama', 'like', "%{$q}%");
                    });
                })
                ->latest('id')
                ->get();
        }

        return view('public.cek-booking', compact('pengaturan', 'bookings', 'q'));
    }

    public function galeri(Request $request)
    {
        $pengaturan = $this->getBengkel();
        $kategori = $request->input('kategori');

        $query = Galeri::query();
        if (!empty($kategori) && in_array($kategori, ['bengkel', 'servis', 'mekanik', 'hasil_kerja', 'lainnya'])) {
            $query->where('kategori', $kategori);
        }
        $galeri = $query->latest('id')->get();

        return view('public.galeri', compact('pengaturan', 'galeri', 'kategori'));
    }

    public function tentang()
    {
        $pengaturan = $this->getBengkel();
        return view('public.tentang', compact('pengaturan'));
    }

    public function kontak()
    {
        $pengaturan = $this->getBengkel();
        return view('public.kontak', compact('pengaturan'));
    }

    public function storeKontak(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'no_hp' => 'nullable|string|max:20',
            'subjek' => 'nullable|string|max:200',
            'pesan' => 'required|string',
        ]);

        PesanKontak::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'subjek' => $request->subjek ?? 'Pesan dari Form Kontak',
            'pesan' => $request->pesan,
            'status' => 'Belum Dibaca',
        ]);

        return redirect()->route('kontak')->with('success', 'Pesan Anda telah berhasil dikirim! Kami akan segera merespons.');
    }

    public function lokasi()
    {
        $pengaturan = $this->getBengkel();
        return view('public.lokasi', compact('pengaturan'));
    }
}
