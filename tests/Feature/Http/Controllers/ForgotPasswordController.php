<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nip' => ['required', 'digits:18'], // NIP PNS = 18 digit
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.digits'   => 'NIP harus terdiri dari 18 digit angka.',
        ]);

        // Asumsi: tabel users memiliki kolom `nip` dan `email`.
        $user = User::where('nip', $request->input('nip'))->first();

        if ($user && $user->email) {
            // Memerlukan route bernama `password.reset` (halaman set password baru).
            Password::sendResetLink(['email' => $user->email]);
        }

        // Respons sama untuk NIP terdaftar maupun tidak (mencegah enumerasi NIP).
        return back()->with(
            'status',
            'Jika NIP terdaftar, tautan reset password telah dikirim ke email yang terhubung dengan akun tersebut.'
        );
    }
}