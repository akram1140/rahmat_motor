@extends('layouts.public')

@section('title', 'Lokasi Bengkel')

@section('content')
  <section class="page-header">
    <div class="container">
      <div class="page-header__content scroll-reveal">
        <div class="page-header__label">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
          Lokasi Bengkel
        </div>
        <h1 class="page-header__title">Temukan Kami di Baebunta</h1>
        <p class="page-header__desc">Kunjungi bengkel Rahmat Motor dengan akses jalan mudah di Baebunta, Kabupaten Luwu Utara, Sulawesi Selatan.</p>
      </div>
    </div>
  </section>

  <section class="section location" style="padding: 3.5rem 0;">
    <div class="container">
      <div class="location__grid">
        <div class="location__info scroll-reveal-left">
          <h3 class="location__name">{{ $pengaturan->nama_bengkel ?? 'Rahmat Motor' }}</h3>
          <div class="location__address">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>{{ $pengaturan->alamat ?? 'Baebunta, Kabupaten Luwu Utara, Sulawesi Selatan' }}</span>
          </div>

          <div class="location__details">
            <div class="location__detail">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <span>Senin — Sabtu: {{ $pengaturan->jam_buka ?? '08.00' }} — {{ $pengaturan->jam_tutup ?? '17.00' }} WITA</span>
            </div>
            <div class="location__detail">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
              <span>WhatsApp: {{ $pengaturan->no_hp ?? '+62 823-0001-7150' }}</span>
            </div>
            <div class="location__detail">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
              <span>Servis, Perawatan, Ganti Oli & Perbaikan Motor</span>
            </div>
          </div>

          <div class="location__actions" style="margin-top: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="https://www.google.com/maps/search/?api=1&query=Rahmat%20Motor%20Baebunta%20Luwu%20Utara%20Sulawesi%20Selatan" class="btn btn--primary" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Buka Google Maps
            </a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pengaturan->whatsapp ?? '6282300017150') }}?text={{ urlencode('Halo Rahmat Motor, saya ingin menanyakan rute dan lokasi bengkel.') }}" class="btn btn--whatsapp" target="_blank" rel="noopener">
              Tanya Panduan Rute
            </a>
          </div>
        </div>

        <div class="location__map-wrapper scroll-reveal-right">
          <iframe 
            src="{{ $pengaturan->maps_url ?? 'https://maps.google.com/maps?q=Rahmat%20Motor%20Baebunta%20Luwu%20Utara%20Sulawesi%20Selatan&output=embed' }}" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="Lokasi Rahmat Motor di Baebunta, Luwu Utara"
            style="width: 100%; height: 380px; border: 0; border-radius: 16px;">
          </iframe>
        </div>
      </div>
    </div>
  </section>
@endsection
