@extends('layouts.admin')

@section('page_title', 'Dashboard Ringkasan')
@section('breadcrumb', 'Dashboard')

@section('content')
  <!-- KPI Grid -->
  <div class="kpi-grid">
    <div class="kpi-card">
      <div class="kpi-card__header">
        <span class="kpi-card__label">Antrean Menunggu</span>
        <div class="kpi-card__icon" style="color: var(--accent-orange);">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
      </div>
      <div class="kpi-card__value">{{ $stats['booking_menunggu'] }}</div>
      <div class="kpi-card__desc">Perlu respon terima atau tolak</div>
    </div>

    <div class="kpi-card">
      <div class="kpi-card__header">
        <span class="kpi-card__label">Dikonfirmasi</span>
        <div class="kpi-card__icon" style="color: var(--accent-green);">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
      </div>
      <div class="kpi-card__value">{{ $stats['booking_dikonfirmasi'] }}</div>
      <div class="kpi-card__desc">Jadwal servis disetujui</div>
    </div>

    <div class="kpi-card">
      <div class="kpi-card__header">
        <span class="kpi-card__label">Sedang Diproses</span>
        <div class="kpi-card__icon" style="color: var(--accent-blue);">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
      </div>
      <div class="kpi-card__value">{{ $stats['booking_diproses'] }}</div>
      <div class="kpi-card__desc">Motor sedang dikerjakan mekanik</div>
    </div>

    <div class="kpi-card">
      <div class="kpi-card__header">
        <span class="kpi-card__label">Total Pelanggan</span>
        <div class="kpi-card__icon" style="color: #a855f7;">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        </div>
      </div>
      <div class="kpi-card__value">{{ $stats['total_pelanggan'] }}</div>
      <div class="kpi-card__desc">Tersimpan di database MySQL</div>
    </div>
  </div>

  <!-- Banner Ringkasan -->
  <div class="admin-banner">
    <div>
      <h2 style="font-size: 1.25rem; font-weight: 800; color: #fff; margin: 0 0 0.4rem; letter-spacing: -0.2px;">
        Panel Manajemen Servis Rahmat Motor (Laravel 9 + MySQL)
      </h2>
      <p style="font-size: 0.88rem; color: var(--admin-text-muted); max-width: 640px; margin: 0; line-height: 1.55;">
        Saat ini terdapat <strong style="color: #fdba74;">{{ $stats['booking_menunggu'] }} booking menunggu</strong> yang memerlukan respon Anda. Setiap update status dapat mengirimkan konfirmasi instan ke WhatsApp pelanggan.
      </p>
    </div>
    <a href="{{ route('admin.booking.index') }}" class="admin-banner-btn">
      Buka Antrean Booking &rarr;
    </a>
  </div>

  <!-- 2-Column Grid -->
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(420px, 1fr)); gap: 1.5rem;">
    <!-- Antrean Booking Terbaru -->
    <div class="admin-card-panel">
      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.35rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--admin-card-border);">
        <h3 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin: 0;">Antrean Booking Terbaru</h3>
        <a href="{{ route('admin.booking.index') }}" style="color: var(--accent-orange); font-size: 0.82rem; font-weight: 700; text-decoration: none;">Lihat Semua &rarr;</a>
      </div>

      @if($recent_bookings->isEmpty())
        <p style="color: var(--admin-text-sub); font-size: 0.85rem; margin: 0;">Belum ada data booking.</p>
      @else
        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
          @foreach($recent_bookings as $rb)
          <div class="admin-list-item">
            <div>
              <div style="font-size: 0.88rem; font-weight: 700; color: #fff; margin-bottom: 2px;">
                {{ $rb->pelanggan->nama ?? 'Pelanggan' }} ({{ $rb->formatted_id }})
              </div>
              <div style="font-size: 0.76rem; color: var(--admin-text-muted);">
                {{ $rb->layanan->nama_layanan ?? 'Servis' }} &bull; {{ \App\Helpers\RahmatHelper::formatTanggal($rb->tanggal_booking) }} {{ date('H.i', strtotime($rb->jam_booking)) }} WITA
              </div>
            </div>
            <span class="status-pill status-pill--{{ strtolower($rb->status) }}">
              {{ $rb->status }}
            </span>
          </div>
          @endforeach
        </div>
      @endif
    </div>

    <!-- Pesan Kontak Terbaru -->
    <div class="admin-card-panel">
      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.35rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--admin-card-border);">
        <h3 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin: 0;">Pesan Kontak Pengunjung</h3>
        <a href="{{ route('admin.pesan.index') }}" style="color: var(--accent-red); font-size: 0.82rem; font-weight: 700; text-decoration: none;">Lihat Semua &rarr;</a>
      </div>

      @if($recent_pesan->isEmpty())
        <p style="color: var(--admin-text-sub); font-size: 0.85rem; margin: 0;">Belum ada pesan masuk.</p>
      @else
        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
          @foreach($recent_pesan as $rp)
          <div class="admin-list-item">
            <div style="width: 100%;">
              <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.3rem;">
                <span style="font-size: 0.88rem; font-weight: 700; color: #fff;">{{ $rp->nama }}</span>
                <span style="font-size: 0.72rem; color: var(--admin-text-sub); background: rgba(255,255,255,0.06); padding: 2px 7px; border-radius: 9999px;">{{ date('d M H:i', strtotime($rp->created_at)) }}</span>
              </div>
              <div style="font-size: 0.78rem; color: var(--admin-text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                {{ $rp->pesan }}
              </div>
            </div>
          </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
@endsection
