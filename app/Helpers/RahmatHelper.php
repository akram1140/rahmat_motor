<?php

namespace App\Helpers;

class RahmatHelper
{
    public static function formatRupiah($harga)
    {
        return 'Rp ' . number_format((float)$harga, 0, ',', '.');
    }

    public static function formatTanggal($tanggal)
    {
        if (empty($tanggal)) return '-';
        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $timestamp = strtotime($tanggal);
        $hari = date('d', $timestamp);
        $bln = (int)date('m', $timestamp);
        $tahun = date('Y', $timestamp);
        return $hari . ' ' . ($bulan[$bln] ?? '') . ' ' . $tahun;
    }

    public static function formatBookingId($id)
    {
        return '#' . str_pad($id, 3, '0', STR_PAD_LEFT);
    }

    public static function formatNoHpWa($no_hp)
    {
        $nomor = preg_replace('/[^0-9]/', '', $no_hp);
        if (substr($nomor, 0, 1) === '0') {
            $nomor = '62' . substr($nomor, 1);
        } elseif (substr($nomor, 0, 2) !== '62') {
            $nomor = '62' . $nomor;
        }
        return $nomor;
    }

    public static function generatePesanWaNotif($booking, $tipe, $catatan = '')
    {
        $kode = self::formatBookingId($booking->id);
        $nama = $booking->pelanggan->nama ?? 'Pelanggan';
        $layanan = $booking->layanan->nama_layanan ?? 'Servis Sepeda Motor';
        $tanggal = self::formatTanggal($booking->tanggal_booking);
        $jam = date('H.i', strtotime($booking->jam_booking)) . ' WITA';
        $tipe = strtolower(trim($tipe));

        if ($tipe === 'terima' || $tipe === 'dikonfirmasi') {
            $pesan = "Halo Kak *{$nama}*,\n\n";
            $pesan .= "Kabar baik dari *Bengkel Rahmat Motor Baebunta*! 🏍️✨\n\n";
            $pesan .= "Booking servis Anda telah *DIKONFIRMASI / DISETUJUI* ✅\n";
            $pesan .= "━━━━━━━━━━━━━━━━━━━━\n";
            $pesan .= "📋 *Kode Booking:* {$kode}\n";
            $pesan .= "🔧 *Layanan:* {$layanan}\n";
            $pesan .= "📅 *Tanggal:* {$tanggal}\n";
            $pesan .= "⏰ *Jam:* {$jam}\n";
            if (!empty($catatan)) {
                $pesan .= "📝 *Catatan Bengkel:* {$catatan}\n";
            }
            $pesan .= "━━━━━━━━━━━━━━━━━━━━\n\n";
            $pesan .= "Silakan datang ke bengkel tepat waktu sesuai jadwal yang telah ditentukan.\n";
            $pesan .= "📍 Lokasi: Baebunta, Kabupaten Luwu Utara, Sulawesi Selatan\n\n";
            $pesan .= "Terima kasih atas kepercayaan Anda pada Rahmat Motor! 🙏";
        } elseif ($tipe === 'proses' || $tipe === 'diproses') {
            $pesan = "Halo Kak *{$nama}*,\n\n";
            $pesan .= "Update progres pengerjaan dari *Bengkel Rahmat Motor Baebunta*! 🏍️⚙️\n\n";
            $pesan .= "Sepeda motor Anda dengan kode *{$kode}* saat ini *SEDANG DALAM PROSES PENGERJAAN* oleh mekanik kami.\n";
            $pesan .= "━━━━━━━━━━━━━━━━━━━━\n";
            $pesan .= "📋 *Kode Booking:* {$kode}\n";
            $pesan .= "🔧 *Layanan:* {$layanan}\n";
            if (!empty($catatan)) {
                $pesan .= "📝 *Catatan Mekanik:* {$catatan}\n";
            }
            $pesan .= "━━━━━━━━━━━━━━━━━━━━\n\n";
            $pesan .= "Kami pastikan servis dilakukan secara teliti. Kami akan segera mengabari Anda kembali jika pengerjaan telah tuntas.\n\n";
            $pesan .= "Terima kasih telah mempercayakan motor Anda pada Rahmat Motor! 🙏";
        } elseif ($tipe === 'selesai') {
            $pesan = "Halo Kak *{$nama}*,\n\n";
            $pesan .= "Kabar gembira dari *Bengkel Rahmat Motor Baebunta*! 🏍️🎉\n\n";
            $pesan .= "Servis sepeda motor Anda dengan kode *{$kode}* telah *SELESAI* & siap untuk diambil! ✅\n";
            $pesan .= "━━━━━━━━━━━━━━━━━━━━\n";
            $pesan .= "📋 *Kode Booking:* {$kode}\n";
            $pesan .= "🔧 *Layanan:* {$layanan}\n";
            if (!empty($catatan)) {
                $pesan .= "📝 *Catatan Hasil Servis:* {$catatan}\n";
            }
            $pesan .= "━━━━━━━━━━━━━━━━━━━━\n\n";
            $pesan .= "Silakan datang ke bengkel untuk pengambilan kendaraan dan serah terima hasil pengerjaan.\n";
            $pesan .= "📍 Lokasi: Bengkel Rahmat Motor, Baebunta, Luwu Utara\n\n";
            $pesan .= "Terima kasih banyak atas kunjungan Anda di Rahmat Motor! 🙏✨";
        } elseif ($tipe === 'batal' || $tipe === 'dibatalkan') {
            $pesan = "Halo Kak *{$nama}*,\n\n";
            $pesan .= "Informasi dari *Bengkel Rahmat Motor Baebunta*.\n\n";
            $pesan .= "Booking servis *{$kode}* ({$layanan}) Anda telah *DIBATALKAN*.\n";
            if (!empty($catatan)) {
                $pesan .= "📝 *Keterangan:* {$catatan}\n";
            }
            $pesan .= "━━━━━━━━━━━━━━━━━━━━\n\n";
            $pesan .= "Jika ingin menjadwalkan ulang servis di lain waktu, Anda dapat membuat booking baru melalui website kami.\nTerima kasih! 🙏";
        } else {
            $pesan = "Halo Kak *{$nama}*,\n\n";
            $pesan .= "Terima kasih telah menghubungi *Bengkel Rahmat Motor Baebunta*.\n\n";
            $pesan .= "Mohon maaf, booking servis Anda untuk jadwal berikut saat ini *BELUM DAPAT KAMI TERIMA / DITOLAK* ❌\n";
            $pesan .= "━━━━━━━━━━━━━━━━━━━━\n";
            $pesan .= "📋 *Kode Booking:* {$kode}\n";
            $pesan .= "🔧 *Layanan:* {$layanan}\n";
            $pesan .= "📅 *Tanggal:* {$tanggal}\n";
            $pesan .= "⏰ *Jam:* {$jam}\n";
            if (!empty($catatan)) {
                $pesan .= "⚠️ *Alasan:* {$catatan}\n";
            }
            $pesan .= "━━━━━━━━━━━━━━━━━━━━\n\n";
            $pesan .= "Anda dapat memilih jadwal lain atau membalas pesan ini untuk mendiskusikan jadwal alternatif yang masih tersedia.\n\n";
            $pesan .= "Terima kasih atas pengertian dan kerjasamanya! 🙏";
        }

        return $pesan;
    }
}
