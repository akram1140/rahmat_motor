@extends('layouts.admin')

@section('page_title', 'Pengaturan Profil Bengkel')
@section('breadcrumb', 'Pengaturan')

@section('content')
  <div class="admin-card-panel" style="max-width: 800px;">
    <h3 style="font-size: 1.15rem; font-weight: 800; color: #fff; margin: 0 0 1.25rem; border-bottom: 1px solid var(--admin-card-border); padding-bottom: 0.75rem;">
      Informasi Profil & Jam Operasional Bengkel
    </h3>

    <form method="POST" action="{{ route('admin.pengaturan.update') }}" enctype="multipart/form-data">
      @csrf

      <div style="margin-bottom: 1.25rem;">
        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.4rem;">Nama Bengkel *</label>
        <input type="text" name="nama_bengkel" required value="{{ old('nama_bengkel', $pengaturan->nama_bengkel ?? 'Rahmat Motor') }}" style="width: 100%; padding: 0.75rem 1rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.95rem;">
      </div>

      <div style="margin-bottom: 1.25rem;">
        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.4rem;">Alamat Lengkap Bengkel *</label>
        <textarea name="alamat" rows="2" required style="width: 100%; padding: 0.75rem 1rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.95rem; font-family: inherit;">{{ old('alamat', $pengaturan->alamat ?? 'Baebunta, Kabupaten Luwu Utara, Sulawesi Selatan') }}</textarea>
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 1.25rem;">
        <div>
          <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.4rem;">No. Telepon Bengkel *</label>
          <input type="text" name="no_hp" required value="{{ old('no_hp', $pengaturan->no_hp ?? '082300017150') }}" style="width: 100%; padding: 0.75rem 1rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.95rem;">
        </div>
        <div>
          <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.4rem;">Nomor WhatsApp (format 62xxx) *</label>
          <input type="text" name="whatsapp" required value="{{ old('whatsapp', $pengaturan->whatsapp ?? '6282300017150') }}" style="width: 100%; padding: 0.75rem 1rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.95rem;">
        </div>
        <div>
          <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.4rem;">Email Bengkel</label>
          <input type="email" name="email" value="{{ old('email', $pengaturan->email ?? 'rahmatmotor@gmail.com') }}" style="width: 100%; padding: 0.75rem 1rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.95rem;">
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
        <div>
          <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.4rem;">Jam Buka *</label>
          <input type="text" name="jam_buka" required value="{{ old('jam_buka', $pengaturan->jam_buka ?? '08.00') }}" style="width: 100%; padding: 0.75rem 1rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.95rem;">
        </div>
        <div>
          <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.4rem;">Jam Tutup *</label>
          <input type="text" name="jam_tutup" required value="{{ old('jam_tutup', $pengaturan->jam_tutup ?? '17.00') }}" style="width: 100%; padding: 0.75rem 1rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.95rem;">
        </div>
      </div>

      <div style="margin-bottom: 1.25rem;">
        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.4rem;">Deskripsi Singkat Profil Bengkel</label>
        <textarea name="deskripsi" rows="3" style="width: 100%; padding: 0.75rem 1rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.95rem; font-family: inherit;">{{ old('deskripsi', $pengaturan->deskripsi ?? '') }}</textarea>
      </div>

      <div style="margin-bottom: 1.75rem;">
        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.4rem;">URL Google Maps Embed</label>
        <textarea name="maps_url" rows="2" style="width: 100%; padding: 0.75rem 1rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.88rem; font-family: monospace;">{{ old('maps_url', $pengaturan->maps_url ?? '') }}</textarea>
      </div>

      <button type="submit" class="btn btn--primary btn--large" style="padding: 0.85rem 2rem;">
        Simpan Perubahan Profil
      </button>
    </form>
  </div>
@endsection
