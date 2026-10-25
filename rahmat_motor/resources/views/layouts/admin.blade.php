@php
    $admin_user = session('admin_user', 'Admin');
    $admin_role = session('admin_role', 'superadmin');
    $pending_booking_count = \App\Models\BookingServis::where('status', 'Menunggu')->count();
    $unread_msg_count = \App\Models\PesanKontak::where('status', 'Belum Dibaca')->count();
    $total_pelanggan_count = \App\Models\Pelanggan::count();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Panel Admin') — Rahmat Motor Baebunta (Laravel)</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='8' fill='%23e63946'/><text x='16' y='23' font-size='18' font-weight='bold' fill='white' text-anchor='middle' font-family='sans-serif'>R</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/admin.css') }}">
  @stack('styles')
</head>
<body class="admin-body">

  <div class="admin-layout">

    <!-- ==================== SIDEBAR ==================== -->
    <aside class="admin-sidebar" id="adminSidebar">
      <div class="admin-sidebar__brand">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
          <img src="{{ asset('assets/images/logo.png') }}" alt="Rahmat Motor Logo" class="sidebar-logo__img">
          <div class="sidebar-logo__text">
            <span class="sidebar-logo__name"><span class="txt-white">RAHMAT</span> <span class="txt-red">MOTOR</span></span>
            <span class="sidebar-logo__sub">PANEL LARAVEL</span>
          </div>
        </a>
        <button class="sidebar-close-btn" id="sidebarCloseBtn" aria-label="Tutup menu">&times;</button>
      </div>

      <div class="sidebar-status-card">
        <div class="status-indicator-dot"></div>
        <div class="status-indicator-info">
          <div class="status-indicator-title">Bengkel Beroperasi</div>
          <div class="status-indicator-time">08.00 – 17.00 WITA</div>
        </div>
      </div>

      <nav class="admin-nav">
        <div class="admin-nav__group-label">Menu Utama</div>

        <a href="{{ route('admin.dashboard') }}" class="admin-nav__link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <div class="nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
          </div>
          <span class="nav-text">Dashboard</span>
        </a>

        <a href="{{ route('admin.booking.index') }}" class="admin-nav__link {{ request()->routeIs('admin.booking.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          </div>
          <span class="nav-text">Data Booking</span>
          @if($pending_booking_count > 0)
          <span class="nav-badge nav-badge--pulse" title="{{ $pending_booking_count }} booking menunggu">{{ $pending_booking_count }}</span>
          @endif
        </a>

        <a href="{{ route('admin.pelanggan.index') }}" class="admin-nav__link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <span class="nav-text">Data Pelanggan</span>
          <span class="nav-badge">{{ $total_pelanggan_count }}</span>
        </a>

        <a href="{{ route('admin.layanan.index') }}" class="admin-nav__link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
          </div>
          <span class="nav-text">Layanan Bengkel</span>
        </a>

        <a href="{{ route('admin.galeri.index') }}" class="admin-nav__link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
          </div>
          <span class="nav-text">Galeri Bengkel</span>
        </a>

        <div class="admin-nav__group-label">Komunikasi & Bengkel</div>

        <a href="{{ route('admin.pesan.index') }}" class="admin-nav__link {{ request()->routeIs('admin.pesan.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </div>
          <span class="nav-text">Pesan Masuk</span>
          @if($unread_msg_count > 0)
          <span class="nav-badge nav-badge--red">{{ $unread_msg_count }}</span>
          @endif
        </a>

        <a href="{{ route('admin.pengaturan.index') }}" class="admin-nav__link {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
          </div>
          <span class="nav-text">Pengaturan Bengkel</span>
        </a>
      </nav>

      <div class="admin-sidebar__footer">
        <a href="{{ route('home') }}" target="_blank" rel="noopener" class="sidebar-ext-btn">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
          Lihat Website Utama
        </a>
        <div class="sidebar-user-card">
          <div class="user-avatar">
            {{ strtoupper(substr($admin_user, 0, 1)) }}
          </div>
          <div class="user-meta">
            <div class="user-name">{{ $admin_user }}</div>
            <div class="user-role">{{ $admin_role }}</div>
          </div>
          <form method="POST" action="{{ route('admin.logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="user-logout-btn" title="Keluar / Logout" style="background: none; border: none; cursor: pointer; color: inherit;">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            </button>
          </form>
        </div>
      </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="admin-main">
      <header class="admin-topbar">
        <div class="topbar-left">
          <button class="topbar-toggle-btn" id="sidebarToggleBtn" aria-label="Buka navigasi">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
          </button>
          <div class="topbar-title-block">
            <h1 class="topbar-page-title">@yield('page_title', 'Panel Admin')</h1>
            <div class="topbar-breadcrumbs">
              <span>Admin</span> &rsaquo; <span>@yield('breadcrumb', 'Dashboard')</span>
            </div>
          </div>
        </div>

        <div class="topbar-right">
          <div class="topbar-chip topbar-chip--clock" id="liveClock">
            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span>{{ date('d M Y') }} &bull; WITA</span>
          </div>

          <a href="{{ route('admin.booking.index') }}" class="topbar-action-btn {{ $pending_booking_count > 0 ? 'topbar-action-btn--highlight' : '' }}">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <span>Antrean Booking</span>
            @if($pending_booking_count > 0)
            <span class="topbar-badge">{{ $pending_booking_count }}</span>
            @endif
          </a>
        </div>
      </header>

      <div class="admin-content-area">
        @if(session('success'))
        <div style="background: #064e3b; border: 1px solid #10b981; color: #a7f3d0; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; font-weight: 600; display: flex; align-items: center; justify-content: space-between; gap: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
          <div style="display: flex; align-items: center; gap: 10px;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>{{ session('success') }}</span>
          </div>
          @if(session('wa_url'))
          <a href="{{ session('wa_url') }}" target="_blank" rel="noopener" style="background: #25D366; color: #000; font-weight: 800; font-size: 0.85rem; padding: 6px 14px; border-radius: 9999px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
            Kirim WhatsApp &rarr;
          </a>
          @endif
        </div>
        @endif

        @if(session('error'))
        <div style="background: #4c0519; border: 1px solid #f43f5e; color: #fecdd3; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; font-weight: 600; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <span>{{ session('error') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div style="background: #4c0519; border: 1px solid #f43f5e; color: #fecdd3; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; font-size: 0.9rem; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
          <strong>Periksa kembali input form:</strong>
          <ul style="margin: 6px 0 0 1.2rem;">
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        @yield('content')
      </div>

      <footer class="admin-footer-bar">
        <div class="footer-left">
          &copy; {{ date('Y') }} <strong>Rahmat Motor Baebunta</strong> &bull; Laravel MVC & MySQL
        </div>
        <div class="footer-right">
          <span class="system-status-pill">
            <span class="status-dot-green"></span> MySQL & Laravel 9 Online
          </span>
        </div>
      </footer>
    </div>
  </div>

  <div class="toast-container" id="toastContainer"></div>

  <script>
    const toggleBtn = document.getElementById('sidebarToggleBtn');
    const closeBtn = document.getElementById('sidebarCloseBtn');
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
      if (sidebar) sidebar.classList.add('open');
      if (overlay) overlay.classList.add('active');
    }
    function closeSidebar() {
      if (sidebar) sidebar.classList.remove('open');
      if (overlay) overlay.classList.remove('active');
    }

    if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
    if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);
  </script>
  @stack('scripts')
</body>
</html>
