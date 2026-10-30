<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    private const PER_PAGE = 4;

    public function index(Request $request)
    {
        $all = $this->dummyUsulan();

        $stats = [
            'total'     => $all->count(),
            'menunggu'  => $all->whereIn('status', ['Verifikasi BOSDM', 'Verifikasi Sesmil'])->count(),
            'perbaikan' => $all->where('status', 'Perlu Perbaikan')->count(),
        ];

        $q = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', '');

        $filtered = $all
            ->when($q !== '', function ($c) use ($q) {
                $kata = mb_strtolower($q);

                return $c->filter(function ($u) use ($kata) {
                    $teks = mb_strtolower(implode(' ', [
                        $u['no'],
                        $u['no_registrasi'],
                        $u['no_surat'],
                        $u['tanggal'],
                        $u['dibuat_oleh'],
                    ]));

                    return str_contains($teks, $kata);
                });
            })
            ->when($status !== '', fn ($c) => $c->where('status', $status))
            ->values();

        $page = max(1, (int) $request->query('page', 1));
        $usulan = new LengthAwarePaginator(
            $filtered->forPage($page, self::PER_PAGE)->values(),
            $filtered->count(),
            self::PER_PAGE,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('dashboard', [
            'user'     => ['nama' => 'Pengusul Layanan Satyalancana', 'unit' => 'Layanan Satyalancana Karya Satya'],
            'stats'    => $stats,
            'usulan'   => $usulan,
            'q'        => $q,
            'status'   => $status,
            'statuses' => ['Verifikasi BOSDM', 'Verifikasi Sesmil', 'Perlu Perbaikan', 'Disetujui'],
        ]);
    }

    private function dummyUsulan()
    {
        $instansi = ['UI', 'ITB', 'UGM', 'IPB', 'ITS', 'Unair', 'Undip', 'UNS', 'UB',
                     'Unhas', 'USU', 'Unpad', 'UNY', 'UPI', 'UNP', 'Unand', 'Unsri', 'Unram'];

        $status = [
            0 => 'Verifikasi BOSDM', 1 => 'Verifikasi Sesmil', 2 => 'Perlu Perbaikan',
            3 => 'Verifikasi BOSDM', 4 => 'Verifikasi Sesmil', 5 => 'Verifikasi BOSDM',
            7 => 'Perlu Perbaikan',
        ];

        return collect(range(0, 17))->map(fn ($i) => [
            'no'            => $i + 1,
            'no_registrasi' => sprintf('REG-2026/%03d/SATYA', $i + 1),
            'no_surat'      => sprintf('SU-2026/%03d/BOSDM', $i + 1),
            'status'        => $status[$i] ?? 'Disetujui',
            'tanggal'       => Carbon::create(2026, 5, 8)->subDays($i)->format('Y-m-d'),
            'dibuat_oleh'   => 'Admin Kepegawaian ' . $instansi[$i],
        ]);
    }
}