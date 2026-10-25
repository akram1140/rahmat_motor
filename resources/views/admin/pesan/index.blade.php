@extends('layouts.admin')

@section('page_title', 'Pesan Kontak Masuk')
@section('breadcrumb', 'Pesan Kontak')

@section('content')
  <div style="margin-bottom: 1.5rem;">
    <h2 style="font-size: 1.15rem; font-weight: 800; color: #fff; margin: 0 0 4px;">Pesan dari Form Kontak Website</h2>
    <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin: 0;">Total {{ $pesan->total() }} pesan masuk dari pengunjung.</p>
  </div>

  <div style="display: flex; flex-direction: column; gap: 1rem;">
    @forelse($pesan as $p)
    <div class="admin-card-panel" style="border-left: 4px solid {{ $p->status === 'Belum Dibaca' ? '#e63946' : '#22c55e' }};">
      <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 10px; margin-bottom: 0.75rem;">
        <div>
          <span style="font-size: 0.75rem; color: var(--admin-text-sub); background: rgba(255,255,255,0.06); padding: 2px 8px; border-radius: 9999px;">
            {{ date('d M Y, H:i', strtotime($p->created_at)) }} WITA
          </span>
          <h3 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin: 6px 0 2px;">{{ $p->nama }}</h3>
          <span style="font-size: 0.82rem; color: var(--accent-orange); font-weight: 600;">Subjek: {{ $p->subjek ?? 'Tanpa Subjek' }}</span>
        </div>

        <div style="display: flex; align-items: center; gap: 8px;">
          <span class="status-pill status-pill--{{ $p->status === 'Belum Dibaca' ? 'ditolak' : 'dikonfirmasi' }}">
            {{ $p->status }}
          </span>

          @if($p->status === 'Belum Dibaca')
          <form method="POST" action="{{ route('admin.pesan.read', $p->id) }}" style="margin: 0;">
            @csrf
            <button type="submit" class="btn btn--secondary" style="padding: 4px 10px; font-size: 0.78rem;">
              Tandai Dibaca
            </button>
          </form>
          @endif

          @if(!empty($p->no_hp))
          <a href="https://wa.me/{{ \App\Helpers\RahmatHelper::formatNoHpWa($p->no_hp) }}" target="_blank" rel="noopener" class="btn" style="background: #25D366; color: #000; padding: 4px 10px; font-size: 0.78rem; font-weight: 700; border-radius: 6px;">
            Balas via WA
          </a>
          @endif

          <form method="POST" action="{{ route('admin.pesan.destroy', $p->id) }}" onsubmit="return confirm('Hapus pesan ini?');" style="margin: 0;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn" style="background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); padding: 4px 8px; font-size: 0.78rem; border-radius: 6px;">
              Hapus
            </button>
          </form>
        </div>
      </div>

      <div style="background: #0d0f17; border-radius: 10px; padding: 1rem 1.25rem; font-size: 0.9rem; color: #e2e8f0; line-height: 1.6; border: 1px solid #1f2537;">
        {{ $p->pesan }}
      </div>

      <div style="margin-top: 0.75rem; font-size: 0.8rem; color: var(--admin-text-muted); display: flex; gap: 1.5rem;">
        @if(!empty($p->no_hp))
          <span>📱 {{ $p->no_hp }}</span>
        @endif
        @if(!empty($p->email))
          <span>✉️ {{ $p->email }}</span>
        @endif
      </div>
    </div>
    @empty
    <div class="admin-card-panel" style="text-align: center; padding: 3rem; color: var(--admin-text-sub);">
      Belum ada pesan masuk dari form kontak.
    </div>
    @endforelse

    @if($pesan->hasPages())
    <div style="display: flex; justify-content: center; margin-top: 1rem;">
      {{ $pesan->links() }}
    </div>
    @endif
  </div>
@endsection
