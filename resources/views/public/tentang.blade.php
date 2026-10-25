@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')
  <section class="page-header">
    <div class="container">
      <div class="page-header__content scroll-reveal">
        <div class="page-header__label">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
          Tentang Kami
        </div>
        <h1 class="page-header__title">Tentang Rahmat Motor</h1>
        <p class="page-header__desc">Mengenal lebih dekat bengkel servis motor terpercaya di Baebunta, Luwu Utara yang berdedikasi menjaga performa kendaraan Anda.</p>
      </div>
    </div>
  </section>

  <!-- ==================== PROFIL BENGKEL ==================== -->
  <section class="section about" style="padding: 3.5rem 0;">
    <div class="container">
      <div class="about__grid">
        <div class="about__image-wrapper scroll-reveal-left">
          <img src="{{ asset('assets/images/about-bengkel.jpeg') }}" alt="Mekanik Rahmat Motor sedang melakukan servis motor" loading="lazy">
          <div class="about__experience-badge">
            <strong>10+</strong>
            <span>Tahun Pengalaman</span>
          </div>
        </div>

        <div class="scroll-reveal-right">
          <div class="about__label">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
            Profil Bengkel
          </div>
          <h2 class="about__title">{{ $pengaturan->nama_bengkel ?? 'Rahmat Motor' }} — Solusi Servis Motor Terpercaya</h2>
          <p class="about__desc">
            {{ $pengaturan->deskripsi ?? 'Rahmat Motor merupakan usaha mikro, kecil, dan menengah (UMKM) yang bergerak dalam jasa perawatan, servis, dan perbaikan sepeda motor. Berdiri sejak tahun 2014, Rahmat Motor telah hadir melayani masyarakat di Baebunta dan sekitarnya dalam memenuhi kebutuhan perawatan serta perbaikan sepeda motor.' }}
          </p>
          <p class="about__desc">
            Dengan mekanik berpengalaman dan peralatan kerja lengkap, kami senantiasa memastikan setiap sepeda motor diperiksa dan ditangani secara tepat, jujur, dan bergaransi kepuasan.
          </p>

          <div class="about__info">
            <div class="about__info-item">
              <div class="about__info-item-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              </div>
              <div>
                <span class="about__info-label">Tahun Berdiri</span>
                <span class="about__info-value">2014</span>
              </div>
            </div>
            <div class="about__info-item">
              <div class="about__info-item-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              </div>
              <div>
                <span class="about__info-label">Pemilik</span>
                <span class="about__info-value">Rahmat Hamzah</span>
              </div>
            </div>
            <div class="about__info-item">
              <div class="about__info-item-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </div>
              <div>
                <span class="about__info-label">Lokasi</span>
                <span class="about__info-value">Baebunta, Luwu Utara</span>
              </div>
            </div>
            <div class="about__info-item">
              <div class="about__info-item-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
              </div>
              <div>
                <span class="about__info-label">Fokus Layanan</span>
                <span class="about__info-value">Servis & Perbaikan Motor</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
