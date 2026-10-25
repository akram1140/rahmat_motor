@extends('layouts.public')

@section('title', 'Layanan Bengkel')

@section('content')
  <section class="page-header">
    <div class="container">
      <div class="page-header__content scroll-reveal">
        <div class="page-header__label">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
          Katalog Servis
        </div>
        <h1 class="page-header__title">Layanan Bengkel Rahmat Motor</h1>
        <p class="page-header__desc">Daftar lengkap layanan servis berkala, perawatan, perbaikan mesin, ganti oli, dan penggantian suku cadang sepeda motor Anda.</p>
      </div>
    </div>
  </section>

  <section class="section services" style="padding: 3.5rem 0;">
    <div class="container">
      <div class="services__grid">
        @foreach($layanan as $item)
        <div class="service-card scroll-reveal">
          <div class="service-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
          </div>
          <h3 class="service-card__title">{{ $item->nama_layanan }}</h3>
          <p class="service-card__desc">{{ $item->deskripsi }}</p>
          <div style="margin-top: 1rem; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.06); padding-top: 0.75rem;">
            <span style="font-weight: 700; color: var(--color-accent); font-size: 1.15rem;">{{ \App\Helpers\RahmatHelper::formatRupiah($item->harga) }}</span>
            <span style="font-size: 0.85rem; color: var(--color-gray-400);">⏱ {{ $item->estimasi_waktu ?? '-' }}</span>
          </div>
          <div style="margin-top: 1.25rem;">
            <a href="{{ route('booking', ['layanan_id' => $item->id]) }}" class="btn btn--primary" style="width: 100%; justify-content: center; font-size: 0.88rem; padding: 0.65rem;">
              Booking Layanan Ini &rarr;
            </a>
          </div>
        </div>
        @endforeach
      </div>

      <div class="services__note scroll-reveal" style="margin-top: 2.5rem; text-align: center;">
        Ada keluhan spesifik yang tidak tercantum? <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pengaturan->whatsapp ?? '6282300017150') }}?text={{ urlencode('Halo Rahmat Motor, saya ingin konsultasi servis motor saya.') }}" target="_blank" rel="noopener" style="color: var(--color-accent); font-weight: 700;">Konsultasikan via WhatsApp</a>
      </div>
    </div>
  </section>
@endsection
