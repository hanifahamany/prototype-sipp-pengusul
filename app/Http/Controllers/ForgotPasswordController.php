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
            'nip' => ['required', 'digits:18'], 
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.digits'   => 'NIP harus terdiri dari 18 digit angka.',
        ]);

        $user = User::where('nip', $request->input('nip'))->first();

        if ($user && $user->email) {
            Password::sendResetLink(['email' => $user->email]);
        }

        return back()->with(
            'status',
            'Jika NIP terdaftar, tautan reset password telah dikirim ke email yang terhubung dengan akun tersebut.'
        );
    }
}