<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Bengkel Servis, Perawatan & Perbaikan Sepeda Motor') — {{ $pengaturan->nama_bengkel ?? 'Rahmat Motor' }} Baebunta</title>
  <meta name="description" content="@yield('meta_description', 'Rahmat Motor adalah bengkel servis, perawatan, dan perbaikan sepeda motor terpercaya di Baebunta, Kabupaten Luwu Utara, Sulawesi Selatan.')">
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='8' fill='%23e63946'/><text x='16' y='23' font-size='18' font-weight='bold' fill='white' text-anchor='middle' font-family='sans-serif'>R</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  @stack('styles')
</head>
<body>

  <!-- ==================== NAVBAR ==================== -->
  <header class="navbar" id="navbar">
    <div class="container navbar__inner">
      <a href="{{ route('home') }}" class="navbar__logo" id="logo">
        <img src="{{ asset('assets/images/logo.png') }}" alt="{{ $pengaturan->nama_bengkel ?? 'Rahmat Motor' }}" class="navbar__logo-img">
        <span class="navbar__logo-text"><span class="navbar__logo-name">RAHMAT</span> <span class="navbar__logo-sub">MOTOR</span></span>
      </a>

      <nav class="navbar__menu" id="desktop-menu">
        <a href="{{ route('home') }}" class="navbar__link {{ request()->routeIs('home') ? 'active' : '' }}" id="nav-beranda">Beranda</a>
        <a href="{{ route('tentang') }}" class="navbar__link {{ request()->routeIs('tentang') ? 'active' : '' }}" id="nav-tentang">Tentang Kami</a>
        <a href="{{ route('layanan') }}" class="navbar__link {{ request()->routeIs('layanan') ? 'active' : '' }}" id="nav-layanan">Layanan</a>
        <a href="{{ route('galeri') }}" class="navbar__link {{ request()->routeIs('galeri') ? 'active' : '' }}" id="nav-galeri">Galeri</a>
        <a href="{{ route('lokasi') }}" class="navbar__link {{ request()->routeIs('lokasi') ? 'active' : '' }}" id="nav-lokasi">Lokasi</a>
        <a href="{{ route('kontak') }}" class="navbar__link {{ request()->routeIs('kontak') ? 'active' : '' }}" id="nav-kontak">Kontak</a>
      </nav>

      <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pengaturan->whatsapp ?? '6282300017150') }}?text={{ urlencode('Halo Rahmat Motor, saya ingin bertanya tentang layanan servis.') }}" class="navbar__cta navbar__cta-desktop" id="nav-cta" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
        Hubungi Kami
      </a>

      <button class="navbar__hamburger" id="hamburger-btn" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </header>

  <!-- Mobile Menu -->
  <div class="mobile-menu" id="mobile-menu">
    <a href="{{ route('home') }}" class="mobile-menu__link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
    <a href="{{ route('tentang') }}" class="mobile-menu__link {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang Kami</a>
    <a href="{{ route('layanan') }}" class="mobile-menu__link {{ request()->routeIs('layanan') ? 'active' : '' }}">Layanan</a>
    <a href="{{ route('galeri') }}" class="mobile-menu__link {{ request()->routeIs('galeri') ? 'active' : '' }}">Galeri</a>
    <a href="{{ route('lokasi') }}" class="mobile-menu__link {{ request()->routeIs('lokasi') ? 'active' : '' }}">Lokasi</a>
    <a href="{{ route('kontak') }}" class="mobile-menu__link {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pengaturan->whatsapp ?? '6282300017150') }}?text={{ urlencode('Halo Rahmat Motor, saya ingin bertanya tentang layanan servis.') }}" class="mobile-menu__cta" target="_blank" rel="noopener">
      Hubungi via WhatsApp
    </a>
  </div>

  @if(session('success'))
  <div class="container" style="margin-top: 5rem; margin-bottom: -3rem;">
    <div style="background: #064e3b; border: 1px solid #10b981; color: #a7f3d0; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 600; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
      <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
      <span>{{ session('success') }}</span>
    </div>
  </div>
  @endif

  @if(session('error'))
  <div class="container" style="margin-top: 5rem; margin-bottom: -3rem;">
    <div style="background: #4c0519; border: 1px solid #f43f5e; color: #fecdd3; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 600; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
      <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <span>{{ session('error') }}</span>
    </div>
  </div>
  @endif

  <!-- Main Content -->
  @yield('content')

  <!-- ==================== FOOTER ==================== -->
  <footer class="footer" id="footer">
    <div class="container">
      <div class="footer__top">
        <div>
          <div class="footer__brand-name">RAHMAT <span>MOTOR</span></div>
          <p class="footer__brand-tagline">Servis &bull; Perawatan &bull; Perbaikan Sepeda Motor</p>
          <p class="footer__brand-desc">
            Bengkel servis, perawatan, dan perbaikan sepeda motor terpercaya di Baebunta, Kabupaten Luwu Utara, Sulawesi Selatan. Berdiri sejak 2014.
          </p>
        </div>

        <div class="footer__column">
          <h4>Navigasi</h4>
          <ul>
            <li><a href="{{ route('home') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg> Beranda</a></li>
            <li><a href="{{ route('tentang') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg> Tentang Kami</a></li>
            <li><a href="{{ route('layanan') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg> Layanan</a></li>
            <li><a href="{{ route('galeri') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg> Galeri</a></li>
            <li><a href="{{ route('lokasi') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg> Lokasi</a></li>
            <li><a href="{{ route('kontak') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg> Kontak</a></li>
            <li><a href="{{ route('cek-booking') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg> Cek Status Booking</a></li>
          </ul>
        </div>

        <div class="footer__column">
          <h4>Informasi Kontak</h4>
          <div class="footer__info-item">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>{{ $pengaturan->alamat ?? 'Baebunta, Kabupaten Luwu Utara, Sulawesi Selatan' }}</span>
          </div>
          <div class="footer__info-item">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
            <span>WhatsApp: {{ $pengaturan->no_hp ?? '+62 823-0001-7150' }}</span>
          </div>
          <div class="footer__info-item">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span>Senin–Sabtu: {{ $pengaturan->jam_buka ?? '08.00' }}–{{ $pengaturan->jam_tutup ?? '17.00' }} WITA</span>
          </div>
        </div>
      </div>

      <div class="footer__bottom" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
        <p class="footer__copyright">&copy; {{ date('Y') }} {{ $pengaturan->nama_bengkel ?? 'Rahmat Motor' }}. All Rights Reserved.</p>
        <a href="{{ route('admin.login') }}" style="color: var(--color-gray-500); font-size: var(--text-xs); text-decoration: none; display: inline-flex; align-items: center; gap: 4px;" title="Login Admin Bengkel">
          <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          Panel Admin
        </a>
      </div>
    </div>
  </footer>

  <!-- Floating WhatsApp -->
  <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pengaturan->whatsapp ?? '6282300017150') }}?text={{ urlencode('Halo Rahmat Motor, saya ingin bertanya.') }}" class="wa-float" id="wa-float" target="_blank" rel="noopener" aria-label="Chat WhatsApp Rahmat Motor">
    <div class="wa-float__btn">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </div>
  </a>

  <script src="{{ asset('assets/js/script.js') }}"></script>
  @stack('scripts')
</body>
</html>
