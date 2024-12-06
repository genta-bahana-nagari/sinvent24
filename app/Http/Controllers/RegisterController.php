<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {       
        return view('backend.auth.register');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //Pesan error
        $messages = [
            'password.min' => 'Kata sandi harus minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ];

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:8|confirmed', // Enforce min 8 chars & confirmation
        ], $messages);

        $user = User::create([
            'name'      => $request->input('nama_lengkap'),
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password'))
        ]);

        $maxId = DB::table('users')->max('id');
        
        if ($maxId === null) {
            $maxId = 0; // Jika tabel kosong, set maxId ke 0
        }
    
        // Set AUTO_INCREMENT ke nilai yang lebih tinggi dari id terakhir
        DB::statement('ALTER TABLE users AUTO_INCREMENT = ' . ($maxId + 1));

        if($user) {
            // Redirect to login page with success message
            return redirect()->route('login')->with('success', 'Register Berhasil! Silakan Login.');
        } else {
            return redirect()->back()->with('error', 'Register Gagal!'); // Redirect back with error if registration fails
        }
    }
}