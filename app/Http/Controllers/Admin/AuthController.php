<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = trim($request->username);
        $password = $request->password;

        $user = User::where('username', $username)
            ->orWhere('email', $username)
            ->first();

        if ($user) {
            // Check password or fallback default admin123
            if (Hash::check($password, $user->password) || ($password === 'admin123' && $user->username === 'admin')) {
                session([
                    'admin_id' => $user->id,
                    'admin_user' => $user->username,
                    'admin_role' => $user->role,
                ]);
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, ' . $user->username);
            }
        }

        return back()->withInput()->with('error', 'Username atau password salah. Silakan coba lagi!');
    }

    public function logout()
    {
        session()->forget(['admin_id', 'admin_user', 'admin_role']);
        session()->flush();
        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil logout.');
    }
}
