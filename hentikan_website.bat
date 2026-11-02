@echo off
title Hentikan Server Website - Bengkel Rahmat Motor
color 0C

echo =================================================================
echo   BENGKEL RAHMAT MOTOR - HENTIKAN SERVER WEBSITE
echo =================================================================
echo.

echo [..] Mencari proses server Laravel di port 8000...
set "FOUND=0"
for /f "tokens=5" %%a in ('netstat -aon ^| findstr /R /C:":8000 .*LISTENING"') do (
    set "FOUND=1"
    taskkill /F /PID %%a >nul 2>&1
)

ping -n 2 127.0.0.1 >nul
netstat -ano | findstr /R /C:":8000 .*LISTENING" >nul
if "%ERRORLEVEL%"=="1" (
    echo [OK] Server Laravel di port 8000 berhasil dihentikan.
) else (
    if "%FOUND%"=="0" (
        echo [OK] Server Laravel di port 8000 sudah tidak aktif.
    ) else (
        echo [!] Gagal menghentikan beberapa proses di port 8000.
    )
)

echo.
echo Catatan: Database MySQL tetap aktif di XAMPP.
echo Jika ingin menyalakan kembali website, cukup klik:
echo   jalankan_website.bat
echo =================================================================
echo.
pause
