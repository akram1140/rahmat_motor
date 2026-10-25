@extends('layouts.admin')

@section('page_title', 'Data Booking Servis')
@section('breadcrumb', 'Booking Servis')

@section('content')
  <!-- Tabs / Filters -->
  <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
      <a href="{{ route('admin.booking.index') }}" class="btn {{ empty($status) ? 'btn--primary' : 'btn--secondary' }}" style="padding: 0.5rem 1rem; font-size: 0.85rem; border-radius: 9999px;">
        Semua ({{ $counts['total'] }})
      </a>
      <a href="{{ route('admin.booking.index', ['status' => 'Menunggu']) }}" class="btn {{ $status === 'Menunggu' ? 'btn--primary' : 'btn--secondary' }}" style="padding: 0.5rem 1rem; font-size: 0.85rem; border-radius: 9999px; {{ $counts['Menunggu'] > 0 ? 'border-color: #f97316; color: #fdba74;' : '' }}">
        Menunggu ({{ $counts['Menunggu'] }})
      </a>
      <a href="{{ route('admin.booking.index', ['status' => 'Dikonfirmasi']) }}" class="btn {{ $status === 'Dikonfirmasi' ? 'btn--primary' : 'btn--secondary' }}" style="padding: 0.5rem 1rem; font-size: 0.85rem; border-radius: 9999px;">
        Dikonfirmasi ({{ $counts['Dikonfirmasi'] }})
      </a>
      <a href="{{ route('admin.booking.index', ['status' => 'Diproses']) }}" class="btn {{ $status === 'Diproses' ? 'btn--primary' : 'btn--secondary' }}" style="padding: 0.5rem 1rem; font-size: 0.85rem; border-radius: 9999px;">
        Diproses ({{ $counts['Diproses'] }})
      </a>
      <a href="{{ route('admin.booking.index', ['status' => 'Selesai']) }}" class="btn {{ $status === 'Selesai' ? 'btn--primary' : 'btn--secondary' }}" style="padding: 0.5rem 1rem; font-size: 0.85rem; border-radius: 9999px;">
        Selesai ({{ $counts['Selesai'] }})
      </a>
      <a href="{{ route('admin.booking.index', ['status' => 'Ditolak']) }}" class="btn {{ $status === 'Ditolak' ? 'btn--primary' : 'btn--secondary' }}" style="padding: 0.5rem 1rem; font-size: 0.85rem; border-radius: 9999px;">
        Ditolak ({{ $counts['Ditolak'] }})
      </a>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.booking.index') }}" style="display: flex; gap: 0.5rem;">
      @if(!empty($status))
        <input type="hidden" name="status" value="{{ $status }}">
      @endif
      <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, no hp, kode..." style="padding: 0.5rem 1rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.88rem; width: 220px;">
      <button type="submit" class="btn btn--secondary" style="padding: 0.5rem 0.85rem;">Cari</button>
      @if(!empty($search))
        <a href="{{ route('admin.booking.index', ['status' => $status]) }}" class="btn btn--secondary" style="padding: 0.5rem 0.85rem;">Reset</a>
      @endif
    </form>
  </div>

  <!-- Booking List -->
  <div class="admin-card-panel" style="padding: 0; overflow: hidden;">
    <div style="overflow-x: auto;">
      <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem;">
        <thead>
          <tr style="background: rgba(255,255,255,0.03); border-bottom: 1px solid var(--admin-card-border); color: var(--admin-text-sub); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px;">
            <th style="padding: 1rem 1.25rem;">Kode</th>
            <th style="padding: 1rem 1.25rem;">Pelanggan</th>
            <th style="padding: 1rem 1.25rem;">Layanan</th>
            <th style="padding: 1rem 1.25rem;">Jadwal Datang</th>
            <th style="padding: 1rem 1.25rem;">Status</th>
            <th style="padding: 1rem 1.25rem; text-align: right;">Aksi Cepat</th>
          </tr>
        </thead>
        <tbody>
          @forelse($bookings as $b)
          <tr style="border-bottom: 1px solid rgba(255,255,255,0.04); transition: background 0.15s ease;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
            <td style="padding: 1.1rem 1.25rem; font-weight: 800; font-family: monospace; color: #fdba74;">
              {{ $b->formatted_id }}
            </td>
            <td style="padding: 1.1rem 1.25rem;">
              <strong style="color: #fff; display: block;">{{ $b->pelanggan->nama ?? '-' }}</strong>
              <span style="color: var(--admin-text-muted); font-size: 0.8rem;">📱 {{ $b->pelanggan->no_hp ?? '-' }}</span>
              @if(!empty($b->pelanggan->alamat))
                <span style="color: var(--admin-text-sub); font-size: 0.78rem; display: block;">📍 {{ $b->pelanggan->alamat }}</span>
              @endif
            </td>
            <td style="padding: 1.1rem 1.25rem;">
              <span style="color: #fff; font-weight: 600;">{{ $b->layanan->nama_layanan ?? '-' }}</span>
              @if(!empty($b->keluhan))
                <div style="font-size: 0.78rem; color: #94a3b8; max-width: 240px; margin-top: 2px;">
                  <em>"{{ $b->keluhan }}"</em>
                </div>
              @endif
            </td>
            <td style="padding: 1.1rem 1.25rem;">
              <span style="color: #fff; font-weight: 600;">{{ \App\Helpers\RahmatHelper::formatTanggal($b->tanggal_booking) }}</span>
              <span style="display: block; font-size: 0.8rem; color: var(--admin-text-muted);">Jam: {{ date('H.i', strtotime($b->jam_booking)) }} WITA</span>
            </td>
            <td style="padding: 1.1rem 1.25rem;">
              <span class="status-pill status-pill--{{ strtolower($b->status) }}">
                {{ $b->status }}
              </span>
              @if(!empty($b->catatan_admin))
                <div style="font-size: 0.75rem; color: var(--admin-text-muted); max-width: 200px; margin-top: 4px;">
                  Catatan: {{ $b->catatan_admin }}
                </div>
              @endif
            </td>
            <td style="padding: 1.1rem 1.25rem; text-align: right;">
              <div style="display: flex; gap: 6px; justify-content: flex-end; align-items: center; flex-wrap: wrap;">
                
                @if($b->status === 'Menunggu')
                  <!-- Terima -->
                  <form method="POST" action="{{ route('admin.booking.status', $b->id) }}" style="margin: 0;">
                    @csrf
                    <input type="hidden" name="status" value="Dikonfirmasi">
                    <input type="hidden" name="catatan_admin" value="Jadwal servis telah disetujui. Silakan datang tepat waktu.">
                    <input type="hidden" name="send_wa" value="1">
                    <button type="submit" class="btn" style="background: #16a34a; color: #fff; padding: 4px 10px; font-size: 0.78rem; font-weight: 700; border-radius: 6px;" title="Terima & Buka WhatsApp">
                      ✓ Terima & WA
                    </button>
                  </form>

                  <!-- Tolak -->
                  <form method="POST" action="{{ route('admin.booking.status', $b->id) }}" style="margin: 0;" onsubmit="return confirm('Tolak booking ini?');">
                    @csrf
                    <input type="hidden" name="status" value="Ditolak">
                    <input type="hidden" name="catatan_admin" value="Mohon maaf, antrean servis sedang penuh pada jam tersebut.">
                    <input type="hidden" name="send_wa" value="1">
                    <button type="submit" class="btn" style="background: #dc2626; color: #fff; padding: 4px 10px; font-size: 0.78rem; font-weight: 700; border-radius: 6px;" title="Tolak & Buka WhatsApp">
                      ✕ Tolak & WA
                    </button>
                  </form>
                @elseif($b->status === 'Dikonfirmasi')
                  <!-- Proses -->
                  <form method="POST" action="{{ route('admin.booking.status', $b->id) }}" style="margin: 0;">
                    @csrf
                    <input type="hidden" name="status" value="Diproses">
                    <input type="hidden" name="catatan_admin" value="Kendaraan sedang dalam pengerjaan teknisi.">
                    <input type="hidden" name="send_wa" value="1">
                    <button type="submit" class="btn" style="background: #2563eb; color: #fff; padding: 4px 10px; font-size: 0.78rem; font-weight: 700; border-radius: 6px;">
                      Proses Servis
                    </button>
                  </form>
                @elseif($b->status === 'Diproses')
                  <!-- Selesai -->
                  <form method="POST" action="{{ route('admin.booking.status', $b->id) }}" style="margin: 0;">
                    @csrf
                    <input type="hidden" name="status" value="Selesai">
                    <input type="hidden" name="catatan_admin" value="Servis selesai dan motor siap diambil di bengkel.">
                    <input type="hidden" name="send_wa" value="1">
                    <button type="submit" class="btn" style="background: #059669; color: #fff; padding: 4px 10px; font-size: 0.78rem; font-weight: 700; border-radius: 6px;">
                      ✓ Selesai & WA
                    </button>
                  </form>
                @endif

                <!-- WhatsApp Button Langsung -->
                @if(!empty($b->pelanggan->no_hp))
                  @php
                    $wa_phone = \App\Helpers\RahmatHelper::formatNoHpWa($b->pelanggan->no_hp);
                    $wa_msg = \App\Helpers\RahmatHelper::generatePesanWaNotif($b, $b->status, $b->catatan_admin ?? '');
                  @endphp
                  <a href="https://wa.me/{{ $wa_phone }}?text={{ urlencode($wa_msg) }}" target="_blank" rel="noopener" class="btn" style="background: #25D366; color: #000; padding: 4px 8px; font-size: 0.78rem; font-weight: 700; border-radius: 6px;" title="Chat WhatsApp Pelanggan">
                    WA
                  </a>
                @endif

                <!-- Hapus -->
                <form method="POST" action="{{ route('admin.booking.destroy', $b->id) }}" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data booking ini secara permanen?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn" style="background: rgba(255,255,255,0.06); color: #fca5a5; padding: 4px 8px; font-size: 0.78rem; border-radius: 6px;" title="Hapus Booking">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                  </button>
                </form>

              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" style="padding: 3rem; text-align: center; color: var(--admin-text-sub);">
              Tidak ada data booking yang sesuai filter.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($bookings->hasPages())
    <div style="padding: 1rem 1.25rem; border-top: 1px solid var(--admin-card-border); display: flex; justify-content: center;">
      {{ $bookings->links() }}
    </div>
    @endif
  </div>
@endsection
