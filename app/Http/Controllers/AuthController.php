<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function loginVerify(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:7'
        ]);
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user = User::where('email', $credentials['email'])->first();
                if ($user->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('app.survey');
                }
            } else {
                return redirect()->back()->with('error', 'Email atau password salah.');
            }
        } catch (Exception $e) {
            return redirect()->route('auth.login')->with('error', $e->getMessage());
        }
    }


    public function register()
    {
        return view('auth.register');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth/login')->with('success', 'Logout berhasil.');
    }

    public function registerVerify(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|same:password'
            ]);
            // Menyimpan pengguna baru ke dalam database
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),  // Mengenkripsi password
            ]);

            // Arahkan ke halaman login atau halaman lain setelah registrasi
            return redirect()->route('auth.login')->with('success', 'Registration successful! Please log in.');
        } catch (Exception $e) {
            return redirect()->route('admin.register')->with('error', $e->getMessage());
        }
    }
}
