@extends('layouts.admin')

@section('page_title', 'Kelola Layanan Bengkel')
@section('breadcrumb', 'Layanan')

@section('content')
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Form Tambah Layanan -->
    <div class="admin-card-panel">
      <h3 style="font-size: 1.1rem; font-weight: 800; color: #fff; margin: 0 0 1rem; border-bottom: 1px solid var(--admin-card-border); padding-bottom: 0.75rem;">
        + Tambah Layanan Servis Baru
      </h3>

      <form method="POST" action="{{ route('admin.layanan.store') }}" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 1rem;">
          <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.35rem;">Nama Layanan *</label>
          <input type="text" name="nama_layanan" required placeholder="Contoh: Servis CVT Matic" style="width: 100%; padding: 0.65rem 0.85rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.88rem;">
        </div>

        <div style="margin-bottom: 1rem;">
          <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.35rem;">Deskripsi Singkat</label>
          <textarea name="deskripsi" rows="2" placeholder="Penjelasan singkat servis..." style="width: 100%; padding: 0.65rem 0.85rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.88rem; font-family: inherit;"></textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1rem;">
          <div>
            <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.35rem;">Tarif Harga (Rp) *</label>
            <input type="number" name="harga" required min="0" step="1000" placeholder="50000" style="width: 100%; padding: 0.65rem 0.85rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.88rem;">
          </div>
          <div>
            <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.35rem;">Estimasi Waktu</label>
            <input type="text" name="estimasi_waktu" placeholder="30-45 menit" style="width: 100%; padding: 0.65rem 0.85rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.88rem;">
          </div>
        </div>

        <div style="margin-bottom: 1.25rem;">
          <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.35rem;">Status Publikasi</label>
          <select name="status" style="width: 100%; padding: 0.65rem 0.85rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.88rem;">
            <option value="aktif">Aktif (Ditampilkan di Website)</option>
            <option value="nonaktif">Nonaktif (Disembunyikan)</option>
          </select>
        </div>

        <button type="submit" class="btn btn--primary" style="width: 100%; justify-content: center; padding: 0.75rem;">
          Simpan Layanan Baru
        </button>
      </form>
    </div>

    <!-- Info Panel -->
    <div class="admin-card-panel" style="display: flex; flex-direction: column; justify-content: space-between;">
      <div>
        <h3 style="font-size: 1.1rem; font-weight: 800; color: #fff; margin: 0 0 0.75rem;">Informasi Layanan & Tarif</h3>
        <p style="font-size: 0.85rem; color: var(--admin-text-muted); line-height: 1.6; margin-bottom: 1rem;">
          Layanan yang berstatus <strong>aktif</strong> akan otomatis muncul pada form booking online dan katalog layanan publik di website. Pelanggan dapat memilih layanan saat mengajukan jadwal servis.
        </p>
      </div>

      <div style="background: rgba(255,255,255,0.03); border: 1px dashed var(--admin-card-border); border-radius: 12px; padding: 1.25rem;">
        <span style="font-size: 0.8rem; color: var(--admin-text-sub); text-transform: uppercase;">Total Layanan Tersedia</span>
        <div style="font-size: 2rem; font-weight: 900; color: #fff; margin-top: 4px;">{{ $layanan->count() }} Jenis</div>
      </div>
    </div>
  </div>

  <!-- Tabel Layanan -->
  <div class="admin-card-panel" style="padding: 0; overflow: hidden;">
    <div style="overflow-x: auto;">
      <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem;">
        <thead>
          <tr style="background: rgba(255,255,255,0.03); border-bottom: 1px solid var(--admin-card-border); color: var(--admin-text-sub); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px;">
            <th style="padding: 1rem 1.25rem;">Layanan</th>
            <th style="padding: 1rem 1.25rem;">Tarif Harga</th>
            <th style="padding: 1rem 1.25rem;">Estimasi</th>
            <th style="padding: 1rem 1.25rem;">Total Booking</th>
            <th style="padding: 1rem 1.25rem;">Status</th>
            <th style="padding: 1rem 1.25rem; text-align: right;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($layanan as $l)
          <tr style="border-bottom: 1px solid rgba(255,255,255,0.04);">
            <td style="padding: 1rem 1.25rem;">
              <strong style="color: #fff; display: block;">{{ $l->nama_layanan }}</strong>
              <span style="color: var(--admin-text-muted); font-size: 0.78rem;">{{ $l->deskripsi }}</span>
            </td>
            <td style="padding: 1rem 1.25rem; font-weight: 700; color: var(--accent-orange);">
              {{ \App\Helpers\RahmatHelper::formatRupiah($l->harga) }}
            </td>
            <td style="padding: 1rem 1.25rem; color: var(--admin-text-sub);">
              {{ $l->estimasi_waktu ?? '-' }}
            </td>
            <td style="padding: 1rem 1.25rem;">
              <span style="color: #fff; font-weight: 600;">{{ $l->bookings_count }}x dipesan</span>
            </td>
            <td style="padding: 1rem 1.25rem;">
              <form method="POST" action="{{ route('admin.layanan.toggle', $l->id) }}" style="margin: 0;">
                @csrf
                <button type="submit" class="status-pill status-pill--{{ $l->status === 'aktif' ? 'dikonfirmasi' : 'ditolak' }}" style="cursor: pointer; border: none; font-size: 0.75rem;">
                  ● {{ ucfirst($l->status) }}
                </button>
              </form>
            </td>
            <td style="padding: 1rem 1.25rem; text-align: right;">
              <form method="POST" action="{{ route('admin.layanan.destroy', $l->id) }}" style="margin: 0; display: inline-block;" onsubmit="return confirm('Hapus layanan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); padding: 5px 10px; font-size: 0.78rem; border-radius: 6px;">
                  Hapus
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
