<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CommController extends Controller
{
    public function show(?string $id = null): View
    {
        $id ??= '1';

        return view('usulan.comm', [
            'id' => $id,
            'user' => [
                'nama' => 'Pengusul Layanan Satyalancana',
                'unit' => 'Layanan Satyalancana Karya Satya',
            ],
        ]);
    }
}