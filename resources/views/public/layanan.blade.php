@extends('layouts.public')

@section('title', 'Layanan Bengkel')
@section('meta_description', 'Layanan servis motor, perawatan berkala, ganti oli, dan perbaikan mesin profesional di Bengkel Rahmat Motor Baebunta.')

@section('content')
  <!-- ==================== HERO SECTION LAYANAN (DESAIN REFERENSI UI) ==================== -->
  <section class="layanan-hero" id="layanan-hero">
    <!-- Background Decor, Diagonal Slant & Ambient Glow -->
    <div class="layanan-hero__backdrop" aria-hidden="true">
      <div class="layanan-hero__backdrop-slant"></div>
      <div class="layanan-hero__glow"></div>
      <div class="layanan-hero__grid-pattern"></div>
    </div>

    <div class="container layanan-hero__container">
      <div class="layanan-hero__grid">
        <!-- Kolom Kiri: Teks & Headline Sesuai Referensi -->
        <div class="layanan-hero__content scroll-reveal">
          <div class="layanan-hero__badge">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/>
            </svg>
            <span>Kami Solusi Motor Anda ~</span>
          </div>

          <h1 class="layanan-hero__title">
            Performa.<br>
            Kami buat<br>
            <span class="layanan-hero__title-accent">Maksimal!</span>
          </h1>

          <p class="layanan-hero__desc">
            Kami menempatkan Anda di pusat jaringan layanan profesional untuk memajukan kenyamanan dan performa berkendara Anda.
          </p>

          <div class="layanan-hero__actions">
            <a href="#katalog-layanan" class="layanan-hero__btn-primary" id="btn-lihat-layanan">
              <span>Lihat Layanan</span>
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg>
            </a>
            <a href="{{ route('booking') }}" class="layanan-hero__btn-secondary" id="btn-hero-booking">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              <span>Booking Servis</span>
            </a>
          </div>
        </div>

        <!-- Kolom Kanan: Foto Bengkel Rahmat Motor dengan Bingkai Miring & Ambient Glow -->
        <div class="layanan-hero__media-wrapper scroll-reveal delay-2">
          <div class="layanan-hero__media-ambient"></div>
          <div class="layanan-hero__frame">
            <img src="{{ asset('assets/images/hero-bengkel.jpeg') }}" alt="Area Servis Bengkel Rahmat Motor Baebunta" class="layanan-hero__img" loading="eager" decoding="async">
            <div class="layanan-hero__frame-overlay"></div>
            <div class="layanan-hero__card-pill">
              <div class="layanan-hero__card-pill-dot"></div>
              <span>Rahmat Motor &bull; Baebunta</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== KATALOG DAFTAR LAYANAN (BACKGROUND PUTIH SEPERTI BERANDA) ==================== -->
  <section class="section services" id="katalog-layanan" style="padding: 4.5rem 0; background: var(--color-gray-50);">
    <div class="container">
      <div class="section-header scroll-reveal">
        <div class="section-header__label">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
          Katalog Servis
        </div>
        <h2 class="section-header__title">Daftar Layanan Bengkel Rahmat Motor</h2>
        <p class="section-header__desc">
          Daftar lengkap layanan servis berkala, perawatan, perbaikan mesin, ganti oli, dan penggantian suku cadang sepeda motor Anda.
        </p>
      </div>

      <div class="services__grid">
        @foreach($layanan as $item)
        <div class="service-card scroll-reveal">
          <div class="service-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
          </div>
          <h3 class="service-card__title">{{ $item->nama_layanan }}</h3>
          <p class="service-card__desc">{{ $item->deskripsi }}</p>
          <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.25rem; border-top: 1px solid var(--color-gray-200); padding-top: 0.85rem;">
            <span style="font-weight: 800; color: var(--color-accent); font-size: 1.18rem;">{{ \App\Helpers\RahmatHelper::formatRupiah($item->harga) }}</span>
            <span style="font-size: 0.85rem; color: var(--color-gray-500); font-weight: 500;">⏱ {{ $item->estimasi_waktu ?? '-' }}</span>
          </div>
          <div style="margin-top: 1.25rem;">
            <a href="{{ route('booking', ['layanan_id' => $item->id]) }}" class="btn btn--primary" style="width: 100%; justify-content: center; font-size: 0.9rem; padding: 0.75rem; border-radius: var(--radius-full); box-shadow: 0 4px 15px rgba(230, 57, 70, 0.35);">
              Booking Layanan Ini &rarr;
            </a>
          </div>
        </div>
        @endforeach
      </div>

      <div class="services__note scroll-reveal" style="margin-top: 3.5rem; text-align: center; color: var(--color-gray-600); background: var(--color-white); border: 1px solid var(--color-gray-200); padding: 1.5rem; border-radius: 16px; box-shadow: var(--shadow-sm); max-width: 700px; margin-left: auto; margin-right: auto;">
        Ada keluhan spesifik yang tidak tercantum? <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pengaturan->whatsapp ?? '6282300017150') }}?text={{ urlencode('Halo Rahmat Motor, saya ingin konsultasi servis motor saya.') }}" target="_blank" rel="noopener" style="color: var(--color-accent); font-weight: 700; text-decoration: underline;">Konsultasikan via WhatsApp &rarr;</a>
      </div>
    </div>
  </section>
@endsection
