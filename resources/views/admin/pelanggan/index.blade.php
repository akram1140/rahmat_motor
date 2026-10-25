@extends('layouts.admin')

@section('page_title', 'Data Pelanggan Bengkel')
@section('breadcrumb', 'Pelanggan')

@section('content')
  <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.15rem; font-weight: 800; color: #fff; margin: 0 0 4px;">Daftar Pelanggan Rahmat Motor</h2>
      <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin: 0;">Total {{ $pelanggan->total() }} pelanggan tercatat di database.</p>
    </div>

    <form method="GET" action="{{ route('admin.pelanggan.index') }}" style="display: flex; gap: 0.5rem;">
      <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, no hp, alamat..." style="padding: 0.5rem 1rem; background: #0d0f17; border: 1px solid #232838; border-radius: 8px; color: #fff; font-size: 0.88rem; width: 240px;">
      <button type="submit" class="btn btn--secondary" style="padding: 0.5rem 0.85rem;">Cari</button>
      @if(!empty($search))
        <a href="{{ route('admin.pelanggan.index') }}" class="btn btn--secondary" style="padding: 0.5rem 0.85rem;">Reset</a>
      @endif
    </form>
  </div>

  <div class="admin-card-panel" style="padding: 0; overflow: hidden;">
    <div style="overflow-x: auto;">
      <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem;">
        <thead>
          <tr style="background: rgba(255,255,255,0.03); border-bottom: 1px solid var(--admin-card-border); color: var(--admin-text-sub); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px;">
            <th style="padding: 1rem 1.25rem;">ID</th>
            <th style="padding: 1rem 1.25rem;">Nama Pelanggan</th>
            <th style="padding: 1rem 1.25rem;">No. WhatsApp / HP</th>
            <th style="padding: 1rem 1.25rem;">Alamat</th>
            <th style="padding: 1rem 1.25rem;">Riwayat Booking</th>
            <th style="padding: 1rem 1.25rem; text-align: right;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($pelanggan as $p)
          <tr style="border-bottom: 1px solid rgba(255,255,255,0.04); transition: background 0.15s ease;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
            <td style="padding: 1rem 1.25rem; font-family: monospace; color: var(--admin-text-sub);">
              #{{ $p->id }}
            </td>
            <td style="padding: 1rem 1.25rem; font-weight: 700; color: #fff;">
              {{ $p->nama }}
            </td>
            <td style="padding: 1rem 1.25rem;">
              <a href="https://wa.me/{{ \App\Helpers\RahmatHelper::formatNoHpWa($p->no_hp) }}" target="_blank" rel="noopener" style="color: #22c55e; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                <span>💬</span> {{ $p->no_hp }}
              </a>
            </td>
            <td style="padding: 1rem 1.25rem; color: var(--admin-text-muted);">
              {{ $p->alamat ?? '-' }}
            </td>
            <td style="padding: 1rem 1.25rem;">
              <span class="status-pill status-pill--dikonfirmasi" style="font-size: 0.78rem;">
                {{ $p->bookings_count }}x Servis
              </span>
            </td>
            <td style="padding: 1rem 1.25rem; text-align: right;">
              <form method="POST" action="{{ route('admin.pelanggan.destroy', $p->id) }}" style="margin: 0; display: inline-block;" onsubmit="return confirm('Hapus data pelanggan ini? Data booking terkait juga akan terhapus.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); padding: 5px 10px; font-size: 0.78rem; border-radius: 6px;">
                  Hapus
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" style="padding: 3rem; text-align: center; color: var(--admin-text-sub);">
              Belum ada data pelanggan yang cocok.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($pelanggan->hasPages())
    <div style="padding: 1rem 1.25rem; border-top: 1px solid var(--admin-card-border); display: flex; justify-content: center;">
      {{ $pelanggan->links() }}
    </div>
    @endif
  </div>
@endsection
