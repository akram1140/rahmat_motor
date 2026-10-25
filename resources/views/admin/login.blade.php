<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin — Rahmat Motor (Laravel)</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='8' fill='%23e63946'/><text x='16' y='23' font-size='18' font-weight='bold' fill='white' text-anchor='middle' font-family='sans-serif'>R</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <style>
    body {
      background: #0d0f16;
      background-image: linear-gradient(180deg, #10131c 0%, #0c0e14 100%);
      background-attachment: fixed;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      padding: 1.5rem;
      color: #f8fafc;
      -webkit-font-smoothing: antialiased;
    }
    .login-box {
      width: 100%;
      max-width: 440px;
      background: #141724;
      border: 1px solid #232838;
      border-radius: 20px;
      padding: 2.5rem;
      box-shadow: 0 20px 45px rgba(0, 0, 0, 0.65);
      position: relative;
    }
    .login-logo {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      margin-bottom: 1.25rem;
      text-decoration: none;
    }
    .login-logo img {
      width: 46px;
      height: 46px;
      object-fit: contain;
    }
    .login-logo-text {
      font-size: 1.5rem;
      font-weight: 800;
      letter-spacing: 0.5px;
    }
    .login-logo-text .white-text { color: #ffffff; }
    .login-logo-text .red-text { color: #e63946; }
    .login-badge {
      display: inline-block;
      background: #191d2a;
      color: #94a3b8;
      border: 1px solid #282f44;
      font-size: 0.75rem;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 9999px;
      letter-spacing: 0.5px;
    }
    .login-title {
      font-size: 1.35rem;
      font-weight: 800;
      color: #fff;
      margin-bottom: 0.4rem;
      text-align: center;
      letter-spacing: -0.3px;
    }
    .login-desc {
      color: #94a3b8;
      font-size: 0.875rem;
      text-align: center;
      margin-bottom: 2rem;
      line-height: 1.5;
    }
    .form-group {
      margin-bottom: 1.35rem;
    }
    .form-label {
      display: block;
      font-size: 0.85rem;
      font-weight: 700;
      color: #cbd5e1;
      margin-bottom: 0.5rem;
    }
    .form-control {
      width: 100%;
      padding: 0.85rem 1.15rem;
      background: #0d0f17;
      border: 1px solid #232838;
      border-radius: 10px;
      color: #fff;
      font-size: 0.95rem;
      transition: all 0.2s ease;
      box-sizing: border-box;
    }
    .form-control:focus {
      outline: none;
      border-color: #3b82f6;
      box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }
    .btn-submit {
      width: 100%;
      padding: 0.85rem;
      background: linear-gradient(180deg, #e63946 0%, #cb2a37 100%);
      color: #fff;
      border: 1px solid #e63946;
      border-radius: 10px;
      font-size: 0.95rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.15s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin-top: 1.5rem;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }
    .btn-submit:hover {
      background: #cb2a37;
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
    }
    .alert-error {
      background: #201416;
      border: 1px solid #4d1c22;
      color: #fca5a5;
      padding: 0.85rem 1.1rem;
      border-radius: 10px;
      font-size: 0.875rem;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .demo-hint {
      margin-top: 1.5rem;
      padding: 0.75rem 1rem;
      background: #11141e;
      border: 1px solid #232838;
      border-radius: 10px;
      font-size: 0.8rem;
      color: #94a3b8;
      text-align: center;
    }
    .demo-hint code {
      color: #fdba74;
      background: #241a15;
      border: 1px solid #452310;
      padding: 2px 7px;
      border-radius: 6px;
      font-weight: 700;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <div style="text-align: center; margin-bottom: 1.5rem;">
      <a href="{{ route('home') }}" class="login-logo">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Rahmat Motor">
        <span class="login-logo-text"><span class="white-text">RAHMAT</span> <span class="red-text">MOTOR</span></span>
      </a>
      <span class="login-badge">PORTAL ADMIN (LARAVEL 9)</span>
    </div>

    <h1 class="login-title">Masuk ke Panel Admin</h1>
    <p class="login-desc">Kelola booking servis, pelanggan, layanan dan database MySQL</p>

    @if(session('error'))
    <div class="alert-error">
      <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <span>{{ session('error') }}</span>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
      @csrf

      <div class="form-group">
        <label for="username" class="form-label">Username atau Email</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required autofocus value="{{ old('username', 'admin') }}">
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required value="admin123">
      </div>

      <button type="submit" class="btn-submit">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
        Masuk Admin
      </button>
    </form>

    <div class="demo-hint">
      Default Akun: Username <code>admin</code> & Password <code>admin123</code>
    </div>

    <a href="{{ route('home') }}" style="display: block; text-align: center; margin-top: 1.5rem; color: #94a3b8; font-size: 0.875rem; text-decoration: none;">
      &larr; Kembali ke Website Rahmat Motor
    </a>
  </div>

</body>
</html>
