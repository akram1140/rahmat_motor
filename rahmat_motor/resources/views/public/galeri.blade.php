@extends('layouts.public')

@section('title', 'Galeri Dokumentasi')

@section('content')
  <section class="page-header">
    <div class="container">
      <div class="page-header__content scroll-reveal">
        <div class="page-header__label">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
          Dokumentasi
        </div>
        <h1 class="page-header__title">Galeri Bengkel Rahmat Motor</h1>
        <p class="page-header__desc">Dokumentasi suasana bengkel, peralatan, aktivitas teknisi/mekanik saat mengerjakan perbaikan sepeda motor.</p>
      </div>
    </div>
  </section>

  <section class="section gallery" style="padding: 3.5rem 0;">
    <div class="container">
      <div class="gallery__grid">
        @forelse($galeri as $foto)
        @php
          $imgPath = asset('assets/images/' . $foto->gambar);
          if (file_exists(public_path('assets/uploads/' . $foto->gambar))) {
              $imgPath = asset('assets/uploads/' . $foto->gambar);
          }
        @endphp
        <div class="gallery__item scroll-reveal" onclick="openLightbox(this)">
          <img src="{{ $imgPath }}" alt="{{ $foto->judul }}" loading="lazy">
          <div class="gallery__item-overlay">
            <span>{{ $foto->judul }}</span>
          </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 0; color: var(--color-gray-500);">
          <p>Belum ada foto galeri.</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Lightbox -->
  <div class="lightbox" id="lightbox">
    <button class="lightbox__close" id="lightbox-close" aria-label="Tutup galeri">&times;</button>
    <img class="lightbox__img" id="lightbox-img" src="" alt="Gambar galeri Rahmat Motor">
  </div>
@endsection
