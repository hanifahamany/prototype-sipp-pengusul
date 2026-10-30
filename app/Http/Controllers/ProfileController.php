<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('profile.edit', [
            'user' => [
                'nama' => 'Pengusul Layanan Satyalancana',
                'unit' => 'Layanan Satyalancana Karya Satya',
            ],
            'profil' => [
                'NIP' => '0000000000000000',
                'Email' => 'pengusul@sipp.id',
                'Pangkat/Golongan' => 'Muda / IIIa',
                'Jabatan' => 'Admin Universitas ABC',
                'Unit Kerja' => 'Universitas ABC',
            ],
            'peran' => 'Pengusul Layanan Satyalancana',
        ]);
    }
}