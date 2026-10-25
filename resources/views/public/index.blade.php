@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
  <!-- ==================== HERO SECTION ==================== -->
  <section class="hero" id="beranda">
    <div class="hero__bg">
      <img src="{{ asset('assets/images/hero-bengkel.jpeg') }}" alt="Bengkel Rahmat Motor - Area Kerja Servis Motor" loading="eager">
    </div>
    <div class="hero__decor"></div>
    <div class="hero__decor hero__decor--2"></div>

    <div class="container">
      <div class="hero__content">
        <div class="hero__badge scroll-reveal">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
          Bengkel Motor Terpercaya Sejak 2014
        </div>

        <h1 class="hero__title scroll-reveal delay-1">
          Solusi <span>Perawatan & Perbaikan</span> Motor Anda
        </h1>

        <p class="hero__desc scroll-reveal delay-2">
          Rahmat Motor hadir untuk membantu menjaga sepeda motor tetap dalam kondisi prima melalui layanan servis, perawatan, pengecekan, dan perbaikan kendaraan terstandar.
        </p>

        <div class="hero__actions scroll-reveal delay-3">
          <a href="{{ route('booking') }}" class="btn btn--primary btn--large" id="hero-cta-booking">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Booking Servis Sekarang
          </a>
          <a href="{{ route('layanan') }}" class="btn btn--secondary btn--large" id="hero-cta-layanan">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
            Lihat Layanan
          </a>
        </div>

        <div class="hero__stats scroll-reveal delay-4">
          <div class="hero__stat">
            <div class="hero__stat-icon">
              <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 2v4M16 2v4M3 10h18"/>
                <rect x="3" y="4" width="18" height="18" rx="3"/>
                <circle cx="8" cy="14" r="1" fill="currentColor"/>
                <circle cx="12" cy="14" r="1" fill="currentColor"/>
                <circle cx="16" cy="14" r="1" fill="currentColor"/>
                <circle cx="8" cy="18" r="1" fill="currentColor"/>
                <circle cx="12" cy="18" r="1" fill="currentColor"/>
                <circle cx="16" cy="18" r="1" fill="currentColor"/>
              </svg>
            </div>
            <strong class="hero__stat-value">Sejak 2014</strong>
            <span class="hero__stat-label">Tahun Berdiri</span>
          </div>
          <div class="hero__stat">
            <div class="hero__stat-icon">
              <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
                <circle cx="12" cy="12" r="1.5" fill="currentColor"/>
              </svg>
            </div>
            <strong class="hero__stat-value">{{ $pengaturan->jam_buka ?? '08.00' }}–{{ $pengaturan->jam_tutup ?? '17.00' }}</strong>
            <span class="hero__stat-label">Senin — Sabtu WITA</span>
          </div>
          <div class="hero__stat">
            <div class="hero__stat-icon">
              <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                <circle cx="12" cy="10" r="3"/>
              </svg>
            </div>
            <strong class="hero__stat-value">Baebunta</strong>
            <span class="hero__stat-label">Luwu Utara, Sulsel</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== RINGKASAN TENTANG ==================== -->
  <section class="section about" id="tentang-ringkasan">
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
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
            Tentang Kami
          </div>
          <h2 class="about__title">Tentang Rahmat Motor</h2>
          <p class="about__desc">
            Rahmat Motor merupakan usaha mikro, kecil, dan menengah (UMKM) yang bergerak dalam jasa perawatan, servis, dan perbaikan sepeda motor. Berdiri sejak tahun 2014, Rahmat Motor telah hadir melayani masyarakat di Baebunta dan sekitarnya.
          </p>
          <p class="about__desc">
            Dengan pengalaman lebih dari satu dekade, Rahmat Motor terus berkomitmen memberikan layanan yang dapat diandalkan bagi setiap pelanggan.
          </p>
          <div style="margin-top: var(--space-6);">
            <a href="{{ route('tentang') }}" class="btn btn--primary">Selengkapnya Tentang Kami</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== RINGKASAN LAYANAN ==================== -->
  <section class="section services" id="layanan-ringkasan">
    <div class="container">
      <div class="section-header scroll-reveal">
        <div class="section-header__label">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
          Layanan Kami
        </div>
        <h2 class="section-header__title">Layanan Unggulan</h2>
        <p class="section-header__desc">
          Berbagai layanan perawatan dan perbaikan sepeda motor yang tersedia di Rahmat Motor.
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
          <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; border-top: 1px solid rgba(255,255,255,0.06); padding-top: 0.75rem;">
            <p class="service-card__price" style="font-weight: 700; color: var(--color-accent); margin: 0;">Mulai {{ \App\Helpers\RahmatHelper::formatRupiah($item->harga) }}</p>
            <span style="font-size: 0.8rem; color: var(--color-gray-400);">⏱ {{ $item->estimasi_waktu ?? '-' }}</span>
          </div>
        </div>
        @endforeach
      </div>

      <div class="services__cta scroll-reveal">
        <a href="{{ route('layanan') }}" class="services__btn-all" id="btn-lihat-semua-layanan">
          <span>Lihat Semua Layanan</span>
          <span class="services__btn-icon">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M5 12h14"></path>
              <path d="M12 5l7 7-7 7"></path>
            </svg>
          </span>
        </a>
      </div>
    </div>
  </section>

  <!-- ==================== CTA BOOKING ==================== -->
  <section class="section contact" id="cta-booking">
    <div class="container contact__inner">
      <div class="section-header scroll-reveal">
        <div class="section-header__label" style="color: var(--color-accent-light);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
          Hubungi Kami
        </div>
        <h2 class="section-header__title" style="color: var(--color-white);">Butuh Servis Motor Tanpa Antre?</h2>
        <p class="section-header__desc">
          Booking jadwal servis motor Anda secara online langsung dari smartphone atau hubungi admin via WhatsApp.
        </p>
      </div>

      <div class="contact__grid">
        <div class="contact__card scroll-reveal delay-1">
          <div class="contact__card-icon">
            <svg viewBox="0 0 24 24" width="28" height="28" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          </div>
          <h4>WhatsApp</h4>
          <p>{{ $pengaturan->no_hp ?? '+62 823-0001-7150' }}</p>
        </div>
        <div class="contact__card scroll-reveal delay-2">
          <div class="contact__card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <h4>Lokasi Bengkel</h4>
          <p>{{ $pengaturan->alamat ?? 'Baebunta, Luwu Utara' }}</p>
        </div>
        <div class="contact__card scroll-reveal delay-3">
          <div class="contact__card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </div>
          <h4>Jam Operasional</h4>
          <p>Senin–Sabtu, {{ $pengaturan->jam_buka ?? '08.00' }}–{{ $pengaturan->jam_tutup ?? '17.00' }} WITA</p>
        </div>
      </div>

      <div class="contact__cta-wrapper scroll-reveal" style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('booking') }}" class="btn btn--primary btn--large">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Booking Servis Online Sekarang
        </a>
        <a href="{{ route('cek-booking') }}" class="btn btn--secondary btn--large">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          Cek Status Booking Saya
        </a>
      </div>
    </div>
  </section>
@endsection
