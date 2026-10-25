@extends('layouts.public')

@section('title', 'Hubungi Kami')

@section('content')
  <section class="page-header">
    <div class="container">
      <div class="page-header__content scroll-reveal">
        <div class="page-header__label">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
          Hubungi Kami
        </div>
        <h1 class="page-header__title">Kontak Bengkel Rahmat Motor</h1>
        <p class="page-header__desc">Hubungi kami melalui form pesan di bawah atau chat langsung via WhatsApp untuk pertanyaan seputar servis motor.</p>
      </div>
    </div>
  </section>

  <section class="section" style="padding: 3.5rem 0; background: var(--color-gray-50);">
    <div class="container">
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem; max-width: 1000px; margin: 0 auto;">
        
        <!-- Info Kontak -->
        <div class="scroll-reveal">
          <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-bottom: 1rem;">Informasi & Saluran Resmi</h2>
          <p style="color: var(--color-gray-600); font-size: 0.95rem; margin-bottom: 2rem; line-height: 1.6;">Silakan kunjungi bengkel kami di Baebunta, atau gunakan saluran komunikasi berikut untuk reservasi dan konsultasi cepat.</p>

          <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            <div style="background: #fff; border: 1px solid var(--color-gray-200); border-radius: 12px; padding: 1.25rem; display: flex; align-items: flex-start; gap: 1rem;">
              <div style="background: rgba(22, 163, 74, 0.1); color: #16a34a; padding: 10px; border-radius: 10px;">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
              </div>
              <div>
                <strong style="color: var(--color-gray-900); display: block; margin-bottom: 2px;">WhatsApp & Telepon</strong>
                <span style="color: var(--color-gray-600); font-size: 0.92rem;">{{ $pengaturan->no_hp ?? '+62 823-0001-7150' }}</span>
              </div>
            </div>

            <div style="background: #fff; border: 1px solid var(--color-gray-200); border-radius: 12px; padding: 1.25rem; display: flex; align-items: flex-start; gap: 1rem;">
              <div style="background: rgba(230, 57, 70, 0.1); color: #e63946; padding: 10px; border-radius: 10px;">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </div>
              <div>
                <strong style="color: var(--color-gray-900); display: block; margin-bottom: 2px;">Alamat Bengkel</strong>
                <span style="color: var(--color-gray-600); font-size: 0.92rem;">{{ $pengaturan->alamat ?? 'Baebunta, Luwu Utara, Sulawesi Selatan' }}</span>
              </div>
            </div>

            <div style="background: #fff; border: 1px solid var(--color-gray-200); border-radius: 12px; padding: 1.25rem; display: flex; align-items: flex-start; gap: 1rem;">
              <div style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 10px; border-radius: 10px;">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              </div>
              <div>
                <strong style="color: var(--color-gray-900); display: block; margin-bottom: 2px;">Jam Operasional</strong>
                <span style="color: var(--color-gray-600); font-size: 0.92rem;">Senin–Sabtu: {{ $pengaturan->jam_buka ?? '08.00' }}–{{ $pengaturan->jam_tutup ?? '17.00' }} WITA</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Form Kirim Pesan -->
        <div class="scroll-reveal delay-1">
          <div style="background: #fff; border: 1px solid var(--color-gray-200); border-radius: 16px; padding: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
            <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--color-gray-900); margin-bottom: 0.4rem;">Kirim Pesan</h3>
            <p style="color: var(--color-gray-600); font-size: 0.88rem; margin-bottom: 1.5rem;">Tulis pesan atau pertanyaan Anda di bawah ini:</p>

            <form method="POST" action="{{ route('kontak.store') }}">
              @csrf

              <div style="margin-bottom: 1.1rem;">
                <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--color-gray-700); margin-bottom: 0.35rem;">Nama Lengkap *</label>
                <input type="text" name="nama" required value="{{ old('nama') }}" placeholder="Nama Anda" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 0.95rem;">
              </div>

              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.1rem;">
                <div>
                  <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--color-gray-700); margin-bottom: 0.35rem;">No. WhatsApp</label>
                  <input type="tel" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxx" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 0.95rem;">
                </div>
                <div>
                  <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--color-gray-700); margin-bottom: 0.35rem;">Email</label>
                  <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 0.95rem;">
                </div>
              </div>

              <div style="margin-bottom: 1.1rem;">
                <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--color-gray-700); margin-bottom: 0.35rem;">Subjek Pesan</label>
                <input type="text" name="subjek" value="{{ old('subjek') }}" placeholder="Contoh: Tanya Biaya Servis Lengkap" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 0.95rem;">
              </div>

              <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.85rem; font-weight: 700; color: var(--color-gray-700); margin-bottom: 0.35rem;">Pesan / Pertanyaan *</label>
                <textarea name="pesan" rows="4" required placeholder="Tuliskan pesan Anda di sini..." style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 0.95rem; font-family: inherit;">{{ old('pesan') }}</textarea>
              </div>

              <button type="submit" class="btn btn--primary" style="width: 100%; justify-content: center; padding: 0.8rem;">
                Kirim Pesan Sekarang &rarr;
              </button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
