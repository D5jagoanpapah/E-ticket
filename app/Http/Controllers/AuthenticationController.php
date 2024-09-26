<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    // Menampilkan form login
    public function showFormLogin()
    {
        return view('authentication.login'); // Sesuaikan path view
    }

    // Proses login
    public function postLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Mencari user berdasarkan email
        $user = User::where('email', $request->input('email'))->first();

        // Memeriksa apakah user ditemukan dan password sesuai
        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Login user
            Auth::login($user);

            // Mengecek role user dan mengarahkan berdasarkan role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('home')->with('success', 'Anda berhasil masuk sebagai Admin');
                case 'user':
                    return redirect()->route('home')->with('success', 'Anda berhasil masuk sebagai User');
                default:
                    // Jika role tidak dikenali, logout dan kembali ke login dengan pesan error
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Role tidak dikenali');
            }
        } else {
            // Jika login gagal, kembali ke halaman login dengan pesan error
            return redirect()->route('login')->with('error', 'Email atau password salah');
        }
    }

    // Menampilkan form register
    public function showFormRegister()
    {
        return view('authentication.register'); // Sesuaikan path view
    }

    // Proses registrasi
    public function postRegister(Request $request)
    {
        // Validasi input registrasi
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Validasi konfirmasi password
        ];

        $this->validate($request, $rules);

        // Membuat user baru dengan role default 'user'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Tetapkan role secara eksplisit jika dibutuhkan
        ]);

        // Login user setelah registrasi
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registrasi berhasil dan Anda telah login sebagai User.');
    }

    // Proses logout
    public function logout()
    {
        // Logout dan hapus session
        Auth::logout();
        Session::flush();
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
