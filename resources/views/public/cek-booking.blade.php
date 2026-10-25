@extends('layouts.public')

@section('title', 'Cek Status Booking')

@push('styles')
<style>
  .status-search-card {
    background: #fff;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    border: 1px solid var(--color-gray-200);
    max-width: 680px;
    margin: 0 auto 2.5rem;
  }
  .client-status-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--color-gray-200);
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    padding: 2rem;
    margin-bottom: 1.5rem;
  }
  .client-status-card--menunggu { border-top: 5px solid #f97316; }
  .client-status-card--dikonfirmasi { border-top: 5px solid #10b981; }
  .client-status-card--diproses { border-top: 5px solid #3b82f6; }
  .client-status-card--selesai { border-top: 5px solid #059669; }
  .client-status-card--ditolak { border-top: 5px solid #ef4444; }
  .client-status-card--dibatalkan { border-top: 5px solid #6b7280; }

  .status-badge-lg {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 9999px;
    font-size: 0.88rem;
    font-weight: 700;
  }
  .status-badge-lg--menunggu { background: #fff7ed; color: #c2410c; border: 1px solid #fdba74; }
  .status-badge-lg--dikonfirmasi { background: #ecfdf5; color: #047857; border: 1px solid #6ee7b7; }
  .status-badge-lg--diproses { background: #eff6ff; color: #1d4ed8; border: 1px solid #93c5fd; }
  .status-badge-lg--selesai { background: #f0fdf4; color: #15803d; border: 1px solid #86efac; }
  .status-badge-lg--ditolak { background: #fef2f2; color: #b91c1c; border: 1px solid #fca5a5; }
  .status-badge-lg--dibatalkan { background: #f3f4f6; color: #4b5563; border: 1px solid #d1d5db; }
</style>
@endpush

@section('content')
  <section class="page-header">
    <div class="container">
      <div class="page-header__content scroll-reveal">
        <div class="page-header__label">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          Lacak Antrean
        </div>
        <h1 class="page-header__title">Cek Status Booking Servis</h1>
        <p class="page-header__desc">Pantau status konfirmasi antrean dan progres servis motor Anda secara real-time langsung dari sistem database bengkel.</p>
      </div>
    </div>
  </section>

  <section class="section" style="background: var(--color-gray-50); padding: 3rem 0;">
    <div class="container">
      <div class="status-search-card scroll-reveal">
        <h2 style="font-size: 1.25rem; font-weight: 800; color: var(--color-gray-900); margin-bottom: 0.5rem; text-align: center;">Cari Booking Servis Anda</h2>
        <p style="text-align: center; color: var(--color-gray-600); font-size: 0.9rem; margin-bottom: 1.5rem;">Masukkan Kode Booking (contoh: <code>#001</code> atau <code>1</code>), Nomor WhatsApp, atau Nama Anda.</p>

        <form method="GET" action="{{ route('cek-booking') }}">
          <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
            <input type="text" name="q" value="{{ $q }}" placeholder="Nomor HP atau ID Booking..." required style="flex: 1; min-width: 220px; padding: 0.85rem 1.25rem; border: 1px solid var(--color-gray-300); border-radius: 10px; font-size: 1rem;">
            <button type="submit" class="btn btn--primary" style="padding: 0.85rem 1.5rem;">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
              Cek Status
            </button>
          </div>
        </form>
      </div>

      @if(!empty($q))
        <div style="max-width: 680px; margin: 0 auto;">
          <h3 style="font-size: 1.1rem; font-weight: 700; color: var(--color-gray-800); margin-bottom: 1.25rem;">
            Hasil Pencarian untuk: <span style="color: var(--color-accent);">"{{ $q }}"</span> ({{ $bookings->count() }} data ditemukan)
          </h3>

          @forelse($bookings as $item)
          <div class="client-status-card client-status-card--{{ strtolower($item->status) }} scroll-reveal">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 10px; margin-bottom: 1.25rem;">
              <div>
                <span style="font-size: 0.82rem; font-weight: 700; color: var(--color-gray-500); text-transform: uppercase;">Kode Booking</span>
                <div style="font-size: 1.35rem; font-weight: 900; color: var(--color-gray-900); font-family: monospace;">{{ $item->formatted_id }}</div>
              </div>
              <span class="status-badge-lg status-badge-lg--{{ strtolower($item->status) }}">
                ● {{ $item->status }}
              </span>
            </div>

            <div style="background: var(--color-gray-50); border-radius: 12px; padding: 1.25rem; margin-bottom: 1.25rem;">
              <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 0.75rem;">
                <div>
                  <span style="font-size: 0.8rem; color: var(--color-gray-500);">Nama Pelanggan:</span>
                  <div style="font-weight: 700; color: var(--color-gray-900);">{{ $item->pelanggan->nama ?? '-' }}</div>
                </div>
                <div>
                  <span style="font-size: 0.8rem; color: var(--color-gray-500);">Layanan Dipilih:</span>
                  <div style="font-weight: 700; color: var(--color-accent);">{{ $item->layanan->nama_layanan ?? '-' }}</div>
                </div>
                <div>
                  <span style="font-size: 0.8rem; color: var(--color-gray-500);">Jadwal Booking:</span>
                  <div style="font-weight: 600; color: var(--color-gray-800);">{{ \App\Helpers\RahmatHelper::formatTanggal($item->tanggal_booking) }} &bull; {{ date('H.i', strtotime($item->jam_booking)) }} WITA</div>
                </div>
                <div>
                  <span style="font-size: 0.8rem; color: var(--color-gray-500);">Estimasi Biaya:</span>
                  <div style="font-weight: 700; color: var(--color-gray-900);">Mulai {{ \App\Helpers\RahmatHelper::formatRupiah($item->layanan->harga ?? 0) }}</div>
                </div>
              </div>

              @if(!empty($item->keluhan))
              <div style="margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px dashed var(--color-gray-200); font-size: 0.88rem; color: var(--color-gray-700);">
                <strong>Keluhan:</strong> {{ $item->keluhan }}
              </div>
              @endif

              @if(!empty($item->catatan_admin))
              <div style="margin-top: 0.75rem; background: #fff; padding: 0.75rem 1rem; border-radius: 8px; border-left: 4px solid var(--color-accent); font-size: 0.88rem;">
                <strong style="color: var(--color-accent);">Catatan dari Bengkel:</strong>
                <p style="margin: 0.25rem 0 0; color: var(--color-gray-800);">{{ $item->catatan_admin }}</p>
              </div>
              @endif
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
              <span style="font-size: 0.8rem; color: var(--color-gray-500);">Diajukan pada {{ date('d M Y, H:i', strtotime($item->created_at)) }} WITA</span>
              <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pengaturan->whatsapp ?? '6282300017150') }}?text={{ urlencode('Halo Bengkel Rahmat Motor, saya ingin menanyakan booking servis saya dengan kode ' . $item->formatted_id) }}" target="_blank" rel="noopener" style="font-size: 0.88rem; font-weight: 700; color: #16a34a; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                Tanya Admin via WhatsApp &rarr;
              </a>
            </div>
          </div>
          @empty
          <div style="background: #fff; border-radius: 16px; padding: 3rem 2rem; text-align: center; border: 1px solid var(--color-gray-200);">
            <div style="font-size: 2.5rem; margin-bottom: 1rem;">🔍</div>
            <h4 style="font-size: 1.15rem; font-weight: 800; color: var(--color-gray-900); margin-bottom: 0.4rem;">Data Booking Tidak Ditemukan</h4>
            <p style="color: var(--color-gray-600); font-size: 0.9rem; max-width: 440px; margin: 0 auto 1.5rem;">Periksa kembali nomor HP atau ID booking yang Anda masukkan, atau buat jadwal booking baru sekarang.</p>
            <a href="{{ route('booking') }}" class="btn btn--primary">Buat Booking Servis Baru</a>
          </div>
          @endforelse
        </div>
      @endif
    </div>
  </section>
@endsection
