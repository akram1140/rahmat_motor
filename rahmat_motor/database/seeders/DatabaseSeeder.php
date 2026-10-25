<?php

namespace Database\Seeders;

use App\Models\Galeri;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\PengaturanBengkel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'email' => 'admin@rahmatmotor.com',
                'password' => Hash::make('admin123'),
                'role' => 'superadmin',
            ]
        );

        // Pengaturan Bengkel
        if (PengaturanBengkel::count() === 0) {
            PengaturanBengkel::create([
                'nama_bengkel' => 'Rahmat Motor',
                'alamat' => 'Baebunta, Kabupaten Luwu Utara, Sulawesi Selatan',
                'no_hp' => '082300017150',
                'whatsapp' => '6282300017150',
                'email' => 'rahmatmotor@gmail.com',
                'jam_buka' => '08.00',
                'jam_tutup' => '17.00',
                'deskripsi' => 'Rahmat Motor merupakan usaha mikro, kecil, dan menengah (UMKM) yang bergerak dalam jasa perawatan, servis, dan perbaikan sepeda motor. Berdiri sejak tahun 2014, Rahmat Motor telah hadir melayani masyarakat di Baebunta dan sekitarnya.',
                'maps_url' => 'https://maps.google.com/maps?q=Rahmat%20Motor%20Baebunta%20Luwu%20Utara%20Sulawesi%20Selatan&output=embed',
            ]);
        }

        // Layanan Default
        if (Layanan::count() === 0) {
            $services = [
                ['nama_layanan' => 'Servis & Perawatan Sepeda Motor', 'deskripsi' => 'Pemeriksaan dan perawatan kendaraan untuk menjaga performa optimal.', 'harga' => 50000, 'estimasi_waktu' => '30-60 menit'],
                ['nama_layanan' => 'Perbaikan Kendaraan', 'deskripsi' => 'Pemeriksaan dan perbaikan berbagai permasalahan pada sepeda motor.', 'harga' => 75000, 'estimasi_waktu' => '1-3 jam'],
                ['nama_layanan' => 'Penggantian Suku Cadang', 'deskripsi' => 'Penggantian komponen atau suku cadang motor yang aus atau rusak.', 'harga' => 100000, 'estimasi_waktu' => '1-2 jam'],
                ['nama_layanan' => 'Perawatan Komponen Kendaraan', 'deskripsi' => 'Pembersihan karburator/injeksi, filter udara, dan CVT.', 'harga' => 40000, 'estimasi_waktu' => '30-45 menit'],
                ['nama_layanan' => 'Pengecekan Kondisi Kendaraan', 'deskripsi' => 'Diagnosa menyeluruh kondisi kelistrikan, rem, suspensi, dan rantai.', 'harga' => 25000, 'estimasi_waktu' => '15-30 menit'],
                ['nama_layanan' => 'Ganti Oli Mesin & Gardan', 'deskripsi' => 'Penggantian pelumas mesin berkualitas tinggi untuk performa mesin halus.', 'harga' => 35000, 'estimasi_waktu' => '15-20 menit'],
            ];
            foreach ($services as $srv) {
                Layanan::create($srv);
            }
        }
    }
}
