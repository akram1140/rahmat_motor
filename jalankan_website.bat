@echo off
title Menjalankan Website Bengkel Rahmat Motor (Laravel 9 + MySQL)
color 0A

echo ========================================================
echo   BENGKEL RAHMAT MOTOR - LARAVEL & MYSQL DATABASE
echo ========================================================
echo.

:: 1. Cek apakah MySQL sudah berjalan
tasklist /FI "IMAGENAME eq mysqld.exe" 2>NUL | find /I /N "mysqld.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo [OK] MySQL Service / MariaDB sudah aktif.
) else (
    echo [..] Memulai MySQL Server dari XAMPP...
    start /B "" /D "C:\xampp" "C:\xampp\mysql\bin\mysqld.exe" --defaults-file="C:\xampp\mysql\bin\my.ini" --standalone
    timeout /t 2 /nobreak >nul
    echo [OK] MySQL berhasil dijalankan.
)

:: 2. Buka Browser ke http://localhost:8000
echo [..] Membuka website di browser...
start http://localhost:8000

:: 3. Jalankan Laravel Artisan Server
echo.
echo ========================================================
echo   Website Laravel berjalan di: http://localhost:8000
echo   Admin Panel               : http://localhost:8000/admin/login
echo   Database                  : MySQL (Database: rahmat_motor)
echo.
echo   JANGAN TUTUP JENDELA INI SELAMA MEMBUKA WEBSITE!
echo   (Tekan Ctrl+C untuk menghentikan server)
echo ========================================================
echo.

cd /d "%~dp0laravel_app"
"C:\xampp\php\php.exe" artisan serve --host=127.0.0.1 --port=8000

pause
