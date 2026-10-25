@extends('layouts.public')

@section('title', 'Booking Servis Online')

@section('content')
  <!-- ==================== PAGE HEADER ==================== -->
  <section class="page-header">
    <div class="container">
      <div class="page-header__content scroll-reveal">
        <div class="page-header__label">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Booking Online
        </div>
        <h1 class="page-header__title">Booking Servis Motor</h1>
        <p class="page-header__desc">Pesan jadwal servis secara online. Pilih layanan, tentukan waktu, dan motor Anda akan segera ditangani tanpa repot antre panjang.</p>
      </div>
    </div>
  </section>

  <!-- ==================== BOOKING FORM ==================== -->
  <section class="section" style="background: var(--color-gray-50); padding: 3rem 0;">
    <div class="container">
      <div style="max-width: 680px; margin: 0 auto;" class="scroll-reveal">
        <div style="background: #fff; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
          
          <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-bottom: 0.5rem;">Formulir Pendaftaran Servis</h2>
          <p style="color: var(--color-gray-600); font-size: 0.92rem; margin-bottom: 2rem;">Lengkapi data di bawah ini dengan benar agar mekanik kami dapat menyiapkan kebutuhan servis motor Anda.</p>

          <form method="POST" action="{{ route('booking.store') }}">
            @csrf

            <div style="margin-bottom: 1.25rem;">
              <label for="nama" style="display: block; font-size: 0.88rem; font-weight: 700; color: var(--color-gray-700); margin-bottom: 0.4rem;">Nama Lengkap *</label>
              <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Ahmad Fauzi" required value="{{ old('nama') }}" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 0.95rem;">
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; margin-bottom: 1.25rem;">
              <div>
                <label for="no_hp" style="display: block; font-size: 0.88rem; font-weight: 700; color: var(--color-gray-700); margin-bottom: 0.4rem;">Nomor WhatsApp / HP *</label>
                <input type="tel" id="no_hp" name="no_hp" class="form-control" placeholder="Contoh: 082345678901" required value="{{ old('no_hp') }}" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 0.95rem;">
              </div>
              <div>
                <label for="alamat" style="display: block; font-size: 0.88rem; font-weight: 700; color: var(--color-gray-700); margin-bottom: 0.4rem;">Alamat Domisili</label>
                <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Contoh: Baebunta, Luwu Utara" value="{{ old('alamat') }}" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 0.95rem;">
              </div>
            </div>

            <div style="margin-bottom: 1.25rem;">
              <label for="layanan_id" style="display: block; font-size: 0.88rem; font-weight: 700; color: var(--color-gray-700); margin-bottom: 0.4rem;">Pilih Jenis Layanan Servis *</label>
              <select id="layanan_id" name="layanan_id" class="form-control" required style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 0.95rem; background: #fff;">
                <option value="">-- Pilih Layanan Servis --</option>
                @foreach($layanan as $l)
                <option value="{{ $l->id }}" {{ old('layanan_id', request('layanan_id')) == $l->id ? 'selected' : '' }}>
                  {{ $l->nama_layanan }} — Mulai {{ \App\Helpers\RahmatHelper::formatRupiah($l->harga) }} ({{ $l->estimasi_waktu ?? '-' }})
                </option>
                @endforeach
              </select>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; margin-bottom: 1.25rem;">
              <div>
                <label for="tanggal_booking" style="display: block; font-size: 0.88rem; font-weight: 700; color: var(--color-gray-700); margin-bottom: 0.4rem;">Tanggal Rencana Datang *</label>
                <input type="date" id="tanggal_booking" name="tanggal_booking" min="{{ date('Y-m-d') }}" required value="{{ old('tanggal_booking', date('Y-m-d')) }}" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 0.95rem;">
              </div>
              <div>
                <label for="jam_booking" style="display: block; font-size: 0.88rem; font-weight: 700; color: var(--color-gray-700); margin-bottom: 0.4rem;">Jam Booking *</label>
                <select id="jam_booking" name="jam_booking" required style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 0.95rem; background: #fff;">
                  <option value="08:30" {{ old('jam_booking') == '08:30' ? 'selected' : '' }}>08.30 WITA</option>
                  <option value="09:00" {{ old('jam_booking') == '09:00' ? 'selected' : '' }}>09.00 WITA</option>
                  <option value="10:00" {{ old('jam_booking') == '10:00' ? 'selected' : '' }}>10.00 WITA</option>
                  <option value="11:00" {{ old('jam_booking') == '11:00' ? 'selected' : '' }}>11.00 WITA</option>
                  <option value="13:30" {{ old('jam_booking') == '13:30' ? 'selected' : '' }}>13.30 WITA</option>
                  <option value="14:30" {{ old('jam_booking') == '14:30' ? 'selected' : '' }}>14.30 WITA</option>
                  <option value="15:30" {{ old('jam_booking') == '15:30' ? 'selected' : '' }}>15.30 WITA</option>
                  <option value="16:00" {{ old('jam_booking') == '16:00' ? 'selected' : '' }}>16.00 WITA</option>
                </select>
              </div>
            </div>

            <div style="margin-bottom: 1.75rem;">
              <label for="keluhan" style="display: block; font-size: 0.88rem; font-weight: 700; color: var(--color-gray-700); margin-bottom: 0.4rem;">Keluhan / Kondisi Kendaraan (Opsional)</label>
              <textarea id="keluhan" name="keluhan" rows="3" placeholder="Contoh: Tarikan gas berat di tanjakan, rem depan berbunyi, atau ganti oli mesin." style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 0.95rem; font-family: inherit;">{{ old('keluhan') }}</textarea>
            </div>

            <button type="submit" class="btn btn--primary btn--large" style="width: 100%; justify-content: center;">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              Kirim Pendaftaran Booking
            </button>
          </form>

          <div style="margin-top: 1.5rem; text-align: center;">
            <a href="{{ route('cek-booking') }}" style="color: var(--color-accent); font-size: 0.88rem; font-weight: 600; text-decoration: none;">
              Sudah pernah booking? Klik di sini untuk Cek Status Booking &rarr;
            </a>
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection
