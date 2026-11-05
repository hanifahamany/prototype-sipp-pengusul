<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UsulanController extends Controller
{
    public function create(): View
    {
        return view('usulan.create', [
            'user' => [
                'nama' => 'Pengusul Layanan Satyalancana',
                'unit' => 'Layanan Satyalancana Karya Satya',
            ],
        ]);
    }

    public function show(Request $request): View
    {
        $query = $request->query();
        $id = $query['id'] ?? null;

        if ($id === null && count($query) === 1) {
            $id = array_key_first($query);
        }

        $id ??= '1';
        abort_unless((is_int($id) || is_string($id)) && ctype_digit((string) $id), 404);

        return view('usulan.show', [
            'user' => [
                'nama' => 'Pengusul Layanan Satyalancana',
                'unit' => 'Layanan Satyalancana Karya Satya',
            ],
            'usulan' => $this->findUsulan((string) $id),
        ]);
    }

    public function redirectToShow(string $id): RedirectResponse
    {
        return redirect()->route('usulan.show');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'pangkat_golongan' => ['required', 'string', 'max:100'],
            'jabatan'          => ['required', 'string', 'max:150'],
            'unit_kerja'       => ['required', 'string', 'max:150'],
            'verifikasi'       => ['nullable', 'array'],
            'verifikasi.*'     => ['nullable', 'string', 'max:255'],
        ]);

        return redirect()
            ->route('usulan.show')
            ->with('status', 'Penyimpanan perubahan belum tersedia.');
    }

    public function lihatDokumen(string $id, int $dokumen): StreamedResponse
    {
        $berkas = $this->findDokumen($id, $dokumen);

        return Storage::disk('local')->response($berkas['path'], $berkas['file'], [], 'inline');
    }

    public function unduhDokumen(string $id, int $dokumen): StreamedResponse
    {
        $berkas = $this->findDokumen($id, $dokumen);

        return Storage::disk('local')->download($berkas['path'], $berkas['file']);
    }

    private function findDokumen(string $id, int $dokumen): array
    {
        $berkas = collect($this->findUsulan($id)['dokumen'])->firstWhere('id', $dokumen);

        abort_if($berkas === null, 404);
        abort_unless(Storage::disk('local')->exists($berkas['path']), 404, 'Berkas belum tersedia.');

        return $berkas;
    }

    /**
     * Data contoh (statis) seperti pada DashboardController.
     * Ganti dengan query Eloquent bila model Usulan sudah tersedia.
     */
    private function findUsulan(string $id): array
    {
        abort_unless(ctype_digit($id), 404);

        $tahapan = [
            ['judul' => 'Usulan Dikirim',           'deskripsi' => 'Usulan berhasil dikirim',       'state' => 'selesai',  'mulai' => '15 Mei 2026', 'selesai' => '15 Mei 2026', 'catatan' => 'Usulan berhasil dikirim ke sistem'],
            ['judul' => 'Verifikasi Biro SDM',      'deskripsi' => 'Verifikasi oleh Biro SDM',      'state' => 'berjalan', 'mulai' => '16 Mei 2026', 'selesai' => null,          'catatan' => 'Sedang dalam proses verifikasi'],
            ['judul' => 'Verifikasi Sesmil',        'deskripsi' => 'Verifikasi oleh Sesjen Kemhan', 'state' => 'menunggu', 'mulai' => null,          'selesai' => null,          'catatan' => null],
            ['judul' => 'Penghargaan Siap Diambil', 'deskripsi' => 'Penghargaan siap diambil',      'state' => 'menunggu', 'mulai' => null,          'selesai' => null,          'catatan' => null],
        ];

        $selesai  = collect($tahapan)->where('state', 'selesai')->count();
        $progress = (int) round($selesai / count($tahapan) * 100);

        $dokumen = [
            ['id' => 1, 'nama' => 'Surat pengantar dan lampiran daftar nama', 'pertanyaan' => 'Siapa nama pegawai yang diusulkan pada dokumen ini?'],
            ['id' => 2, 'nama' => 'Salinan sah piagam Satyalancana',          'pertanyaan' => 'Satyalancana tingkat berapa yang tercantum pada piagam ini?'],
            ['id' => 3, 'nama' => 'Asli daftar riwayat hidup',                'pertanyaan' => 'Apakah NIP pada riwayat hidup sesuai dengan data pegawai?'],
            ['id' => 4, 'nama' => 'SK CPNS',                                  'pertanyaan' => 'Apa nomor dan tanggal SK CPNS pegawai?'],
            ['id' => 5, 'nama' => 'Salinan sah SK pangkat terakhir',          'pertanyaan' => 'Apa pangkat/golongan pada SK pangkat terakhir?'],
            ['id' => 6, 'nama' => 'Salinan sah SK jabatan terakhir',          'pertanyaan' => 'Apa jabatan yang tercantum pada SK jabatan terakhir?'],
        ];

        $dokumen = array_map(fn ($d) => $d + [
            'file'    => "dokumen_doc{$d['id']}.pdf",
            'ukuran'  => '13.45 MB',
            'path'    => "usulan/{$id}/dokumen_doc{$d['id']}.pdf",
            'jawaban' => '',
        ], $dokumen);

        return [
            'id'               => $id,
            'kode'             => str_pad($id, 3, '0', STR_PAD_LEFT),
            'progress'         => $progress,
            'status'           => 'Verifikasi BOSDM',
            'nama'             => 'Budi Santoso',
            'nip'              => '198503122010011002',
            'pangkat_golongan' => 'Penata Muda Tk. I (III/b)',
            'jabatan'          => 'Analis Kepegawaian',
            'unit_kerja'       => 'Biro Organisasi dan SDM',
            'jenis'            => 'Satyalancana Karya Satya 10 Tahun',
            'tahapan'          => $tahapan,
            'dokumen'          => $dokumen,
        ];
    }
}