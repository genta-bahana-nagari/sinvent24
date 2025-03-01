<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index'); // Redirect ke dashboard jika sudah login
        } else {
            return view('backend.auth.login'); // Tampilkan halaman login
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check_login(Request $request)
    {
        $email      = $request->input('email');
        $password   = $request->input('password');

        if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password])) {
            // Ambil nama pengguna yang sedang login
            $namaLengkap = Auth::user()->name; // Sesuaikan dengan kolom yang menyimpan nama lengkap
            
            // Redirect ke dashboard dengan pesan selamat datang
            return redirect()->route('dashboard.index')
                ->with('logged-in', "Selamat Datang, $namaLengkap!");
        } else {
            // Respon dengan pesan error jika login gagal
            return redirect()->back()->with('error', 'Login Gagal! Cek email dan password!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        $request->session()->invalidate(); // Menghapus sesi
        $request->session()->regenerateToken(); // Menghasilkan token sesi baru

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil.'
        ]);
    }

}