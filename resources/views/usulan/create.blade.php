@extends('layouts.app')

@section('title', 'Tambah Usulan - Sistem Informasi Satyalancana Karya Satya')

@section('content')
@php
    $dokumen = [
        ['nama' => 'Surat pengantar dan lampiran daftar nama', 'wajib' => true,  'catatan' => null],
        ['nama' => 'Salinan sah piagam Satyalancana',          'wajib' => false, 'catatan' => '(khusus untuk pilihan 20 tahun & 30 tahun)'],
        ['nama' => 'Asli daftar riwayat hidup',                'wajib' => true,  'catatan' => null],
        ['nama' => 'SK CPNS',                                  'wajib' => true,  'catatan' => null],
        ['nama' => 'Salinan sah SK pangkat terakhir',          'wajib' => true,  'catatan' => null],
        ['nama' => 'Salinan sah SK jabatan terakhir',          'wajib' => true,  'catatan' => null],
    ];

    $input = 'h-[42px] w-full rounded-lg border border-[#E5E7EB] bg-white px-3.5 text-sm text-[#364153] placeholder:text-[#99A1AF] focus:border-[#00A4FF] focus:outline-none focus:ring-2 focus:ring-[#E2F2FD]';
    $label = 'mb-1.5 block text-sm text-[#1E2939]';
    $judulSeksi = 'flex items-center gap-2 text-sm font-medium text-[#0055B6]';
@endphp

<a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm text-[#0055B6] hover:underline">
    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
    Kembali ke Dashboard
</a>

<section class="mt-5 overflow-hidden rounded-2xl bg-white shadow-md">
    <div class="bg-[#00A4FF] px-6 py-6 text-white">
        <h1 class="text-xl font-semibold">Form Pengajuan Satyalancana Karya Satya</h1>
        <p class="mt-1 text-sm">Lengkapi data berikut untuk mengajukan permohonan Satyalancana Karya Satya</p>
    </div>

    <form>
        <div class="space-y-7 p-6">

            <div>
                <h2 class="{{ $judulSeksi }}">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Data Pegawai yang Diusulkan
                </h2>

                <div id="pegawai-list" class="mt-3 space-y-4">
                    <fieldset data-pegawai-card class="rounded-xl border border-[#E5E7EB] p-5">
                        <legend class="sr-only">Data pegawai</legend>
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-sm font-medium text-[#1E2939]">Pegawai <span data-pegawai-number>1</span></h3>
                            <button type="button" data-remove-pegawai hidden
                                    class="text-xs font-medium text-[#E7000B] hover:underline">
                                Hapus pegawai
                            </button>
                        </div>

                        <div class="grid gap-x-5 gap-y-5 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label data-label-field="nip" for="pegawai-0-nip" class="{{ $label }}">NIP <span class="text-[#E7000B]">*</span></label>
                                <input data-field="nip" id="pegawai-0-nip" name="pegawai[0][nip]" type="text" inputmode="numeric" maxlength="18"
                                       placeholder="Masukkan 18 digit NIP pegawai" class="{{ $input }}">
                            </div>

                            <div>
                                <label data-label-field="nama" for="pegawai-0-nama" class="{{ $label }}">Nama Pegawai <span class="text-[#E7000B]">*</span></label>
                                <input data-field="nama" id="pegawai-0-nama" name="pegawai[0][nama]" type="text" readonly
                                       placeholder="Otomatis terisi setelah NIP dimasukkan" class="{{ $input }}">
                            </div>
                            <div>
                                <label data-label-field="gelar" for="pegawai-0-gelar" class="{{ $label }}">Gelar</label>
                                <input data-field="gelar" id="pegawai-0-gelar" name="pegawai[0][gelar]" type="text" readonly
                                       placeholder="Otomatis terisi setelah NIP dimasukkan" class="{{ $input }}">
                            </div>

                            <div>
                                <label data-label-field="pangkat_golongan" for="pegawai-0-pangkat_golongan" class="{{ $label }}">Pangkat/Golongan <span class="text-[#E7000B]">*</span></label>
                                <input data-field="pangkat_golongan" id="pegawai-0-pangkat_golongan" name="pegawai[0][pangkat_golongan]" type="text" readonly
                                       placeholder="Auto-fill dari sistem SIASN" class="{{ $input }}">
                                <p class="mt-1 text-[10px] text-[#99A1AF]">Otomatis terisi berdasarkan data SIASN</p>
                            </div>
                            <div>
                                <label data-label-field="jabatan" for="pegawai-0-jabatan" class="{{ $label }}">Jabatan <span class="text-[#E7000B]">*</span></label>
                                <input data-field="jabatan" id="pegawai-0-jabatan" name="pegawai[0][jabatan]" type="text" readonly
                                       placeholder="Otomatis terisi setelah NIP dimasukkan" class="{{ $input }}">
                            </div>

                            <div class="md:col-span-2">
                                <label data-label-field="unit_kerja" for="pegawai-0-unit_kerja" class="{{ $label }}">Unit Kerja <span class="text-[#E7000B]">*</span></label>
                                <input data-field="unit_kerja" id="pegawai-0-unit_kerja" name="pegawai[0][unit_kerja]" type="text" readonly
                                       placeholder="Otomatis terisi setelah NIP dimasukkan" class="{{ $input }}">
                            </div>
                        </div>
                    </fieldset>
                </div>

                <button id="tambah-pegawai" type="button"
                        class="mt-4 inline-flex h-10 items-center gap-2 rounded-lg border border-[#00A4FF] px-4 text-sm font-medium text-[#0055B6] hover:bg-[#E2F2FD]">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                    Tambah Nama Pegawai
                </button>
            </div>

            {{-- Jenis Satyalancana --}}
            <div>
                <h2 class="{{ $judulSeksi }}">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/><circle cx="12" cy="8" r="6"/></svg>
                    Jenis Satyalancana
                </h2>

                <div class="mt-3">
                    <label for="jenis" class="{{ $label }}">Pilih Jenis Satyalancana <span class="text-[#E7000B]">*</span></label>
                    <select id="jenis" name="jenis" class="{{ $input }} cursor-pointer text-[#1E2939]">
                        <option value="">Pilih jenis Satyalancana</option>
                        <option value="10">Satyalancana Karya Satya 10 Tahun</option>
                        <option value="20">Satyalancana Karya Satya 20 Tahun</option>
                        <option value="30">Satyalancana Karya Satya 30 Tahun</option>
                    </select>
                </div>
            </div>

            <div>
                <h2 class="{{ $judulSeksi }}">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                    Upload Dokumen Persyaratan
                </h2>

                <ul class="mt-3 space-y-3 rounded-xl bg-[#E2F2FD] p-5">
                    @foreach ($dokumen as $d)
                        <li class="flex items-center justify-between gap-3 rounded-lg border border-[#E5E7EB] bg-white px-4 py-4">
                            <div class="flex min-w-0 items-center gap-3">
                                <span class="h-4 w-4 shrink-0 rounded-full bg-[#D1D5DC]"></span>
                                <span class="text-xs text-[#364153]">
                                    {{ $d['nama'] }}
                                    @if ($d['catatan']) {{ $d['catatan'] }} @endif
                                    @if ($d['wajib']) <span class="text-[#E7000B]">*</span> @endif
                                </span>
                            </div>

                            <button type="button"
                                    class="inline-flex h-[30px] shrink-0 cursor-pointer items-center gap-1.5 rounded-lg bg-[#00A4FF] px-3 text-xs font-medium text-white hover:bg-[#0090E0]">
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v12"/><path d="m17 8-5-5-5 5"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/></svg>
                                Upload
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="mx-6 flex justify-end gap-3 border-t border-[#E5E7EB] py-5">
            <a href="{{ route('dashboard') }}"
               class="inline-flex h-10 items-center rounded-lg border border-[#E5E7EB] bg-white px-5 text-sm text-[#364153] hover:bg-[#F9FAFB]">
                Batal
            </a>
            <button type="button"
                    class="inline-flex h-10 cursor-pointer items-center rounded-lg bg-[#00A4FF] px-7 text-sm font-semibold text-white shadow-lg shadow-[#00A4FF]/30 hover:bg-[#0090E0]">
                Simpan
            </button>
        </div>
    </form>
</section>
@endsection

@push('scripts')
    <script>
        const pegawaiList = document.getElementById('pegawai-list');
        const tambahPegawaiButton = document.getElementById('tambah-pegawai');

        if (pegawaiList && tambahPegawaiButton) {
            const updatePegawaiCards = () => {
                const cards = [...pegawaiList.querySelectorAll('[data-pegawai-card]')];

                cards.forEach((card, index) => {
                    card.querySelector('[data-pegawai-number]').textContent = String(index + 1);
                    card.querySelector('[data-remove-pegawai]').hidden = cards.length === 1;

                    card.querySelectorAll('[data-field]').forEach((field) => {
                        const name = field.dataset.field;
                        field.id = `pegawai-${index}-${name}`;
                        field.name = `pegawai[${index}][${name}]`;
                    });

                    card.querySelectorAll('[data-label-field]').forEach((label) => {
                        label.htmlFor = `pegawai-${index}-${label.dataset.labelField}`;
                    });
                });
            };

            tambahPegawaiButton.addEventListener('click', () => {
                const card = pegawaiList.querySelector('[data-pegawai-card]').cloneNode(true);
                card.querySelectorAll('[data-field]').forEach((field) => {
                    field.value = '';
                });
                pegawaiList.append(card);
                updatePegawaiCards();
                card.querySelector('[data-field="nip"]').focus();
            });

            pegawaiList.addEventListener('click', (event) => {
                const removeButton = event.target.closest('[data-remove-pegawai]');

                if (!removeButton) {
                    return;
                }

                removeButton.closest('[data-pegawai-card]').remove();
                updatePegawaiCards();
            });

            updatePegawaiCards();
        }
    </script>
@endpush