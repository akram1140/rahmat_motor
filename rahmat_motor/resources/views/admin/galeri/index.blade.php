@extends('layouts.admin')

@section('page_title', 'Kelola Galeri Bengkel')
@section('breadcrumb', 'Galeri')

@section('content')
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Form Upload Foto -->
    <div class="admin-card-panel">
      <h3 style="font-size: 1.1rem; font-weight: 800; color: #fff; margin: 0 0 1rem; border-bottom: 1px solid var(--admin-card-border); padding-bottom: 0.75rem;">
        + Unggah Foto Baru ke Galeri
      </h3>

      <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 1rem;">
          <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.35rem;">Judul Foto *</label>
          <input type="text" name="judul" required placeholder="Contoh: Proses Tune Up Injeksi" style="width: 100%; padding: 0.65rem 0.85rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.88rem;">
        </div>

        <div style="margin-bottom: 1rem;">
          <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.35rem;">Kategori *</label>
          <select name="kategori" required style="width: 100%; padding: 0.65rem 0.85rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.88rem;">
            <option value="bengkel">Suasana Bengkel</option>
            <option value="servis">Proses Servis</option>
            <option value="mekanik">Mekanik</option>
            <option value="hasil_kerja">Hasil Kerja</option>
            <option value="lainnya">Lainnya</option>
          </select>
        </div>

        <div style="margin-bottom: 1rem;">
          <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.35rem;">Pilih File Gambar (JPG, PNG, WebP) *</label>
          <input type="file" name="gambar" required accept="image/*" style="width: 100%; padding: 0.5rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #94a3b8; font-size: 0.85rem;">
        </div>

        <button type="submit" class="btn btn--primary" style="width: 100%; justify-content: center; padding: 0.75rem;">
          Unggah Foto
        </button>
      </form>
    </div>

    <!-- Info Galeri -->
    <div class="admin-card-panel" style="display: flex; flex-direction: column; justify-content: space-between;">
      <div>
        <h3 style="font-size: 1.1rem; font-weight: 800; color: #fff; margin: 0 0 0.75rem;">Dokumentasi Bengkel</h3>
        <p style="font-size: 0.85rem; color: var(--admin-text-muted); line-height: 1.6; margin-bottom: 1rem;">
          Foto-foto yang diunggah akan otomatis ditampilkan di halaman Galeri publik untuk meningkatkan kepercayaan pelanggan terhadap kualitas kerja bengkel.
        </p>
      </div>

      <div style="background: rgba(255,255,255,0.03); border: 1px dashed var(--admin-card-border); border-radius: 12px; padding: 1.25rem;">
        <span style="font-size: 0.8rem; color: var(--admin-text-sub); text-transform: uppercase;">Total Foto Tersimpan</span>
        <div style="font-size: 2rem; font-weight: 900; color: #fff; margin-top: 4px;">{{ $galeri->count() }} Foto</div>
      </div>
    </div>
  </div>

  <!-- Grid Foto -->
  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.25rem;">
    @foreach($galeri as $item)
    @php
      $imgPath = asset('assets/images/' . $item->gambar);
      if (file_exists(public_path('assets/uploads/' . $item->gambar))) {
          $imgPath = asset('assets/uploads/' . $item->gambar);
      }
    @endphp
    <div class="admin-card-panel" style="padding: 0; overflow: hidden; position: relative;">
      <img src="{{ $imgPath }}" alt="{{ $item->judul }}" style="width: 100%; height: 160px; object-fit: cover; display: block;">
      <div style="padding: 1rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; color: var(--accent-orange); font-weight: 700;">{{ $item->kategori }}</span>
        <h4 style="font-size: 0.92rem; font-weight: 700; color: #fff; margin: 4px 0 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $item->judul }}</h4>
      </div>
      <div style="padding: 0 1rem 1rem; display: flex; justify-content: flex-end;">
        <form method="POST" action="{{ route('admin.galeri.destroy', $item->id) }}" onsubmit="return confirm('Hapus foto ini dari galeri?');" style="margin: 0;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn" style="background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); padding: 4px 8px; font-size: 0.78rem; border-radius: 6px;">
            Hapus
          </button>
        </form>
      </div>
    </div>
    @endforeach
  </div>
@endsection
