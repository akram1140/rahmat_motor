@echo off
title Bengkel Rahmat Motor - Server Website
color 0A

echo =================================================================
echo   BENGKEL RAHMAT MOTOR - MENJALANKAN SERVER WEBSITE
echo =================================================================
echo.

:: 1. Atur Working Directory ke folder proyek
cd /d "%~dp0"

:: 2. Tentukan lokasi PHP
set "PHP_BIN=C:\xampp\php\php.exe"
if not exist "%PHP_BIN%" (
    set "PHP_BIN=php"
)

:: 3. Cek dan Jalankan MySQL jika belum aktif
tasklist /FI "IMAGENAME eq mysqld.exe" 2>NUL | find /I /N "mysqld.exe" >NUL
if "%ERRORLEVEL%"=="0" (
    echo [OK] MySQL Service / MariaDB sudah aktif.
) else (
    echo [..] Memulai MySQL Server dari XAMPP...
    if exist "C:\xampp\mysql_start.bat" (
        start "" /MIN cmd.exe /c "cd /d C:\xampp && mysql_start.bat"
    ) else if exist "C:\xampp\mysql\bin\mysqld.exe" (
        start "" /MIN /D "C:\xampp" "C:\xampp\mysql\bin\mysqld.exe" --defaults-file="C:\xampp\mysql\bin\my.ini" --standalone
    )
    ping -n 3 127.0.0.1 >nul
    echo [OK] MySQL berhasil dijalankan.
)

:: 4. Buka Browser otomatis ke Website
echo.
echo [..] Membuka website di browser...
start http://localhost:8000

:: 5. Tampilkan Informasi Akses
echo.
echo =================================================================
echo   WEBSITE AKTIF & BERJALAN!
echo =================================================================
echo   Website Publik : http://localhost:8000
echo   Panel Admin    : http://localhost:8000/admin/login
echo   Database MySQL : Port 3306 (rahmat_motor)
echo.
echo   [PENTING]
echo   Biarkan jendela ini tetap terbuka selama website digunakan.
echo   Untuk menghentikan website, tekan Ctrl+C atau tutup jendela ini.
echo =================================================================
echo.

:: 6. Jalankan Laravel Artisan Server
"%PHP_BIN%" artisan serve --host=127.0.0.1 --port=8000

echo.
echo Server telah dimatikan.
pause
