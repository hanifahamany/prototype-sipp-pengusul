@extends('layouts.app')

@section('title', 'Detail Usulan - Sistem Informasi Satyalancana Karya Satya')

@section('content')
@php
    $stepStyle = [
        'selesai'  => [
            'circle' => 'bg-[#41BFD5] text-white',
            'judul'  => 'text-[#1E2939]',
            'desk'   => 'text-[#99A1AF]',
            'card'   => 'border-[#E5E7EB] bg-white shadow-sm',
            'teks'   => 'text-[#364153]',
        ],
        'berjalan' => [
            'circle' => 'bg-[#00A4FF] text-white ring-4 ring-[#E2F2FD]',
            'judul'  => 'text-[#0055B6]',
            'desk'   => 'text-[#4A5565]',
            'card'   => 'border-[#00A4FF] bg-[#E2F2FD]',
            'teks'   => 'text-[#364153]',
        ],
        'menunggu' => [
            'circle' => 'bg-[#D1D5DC] text-white',
            'judul'  => 'text-[#99A1AF]',
            'desk'   => 'text-[#99A1AF]',
            'card'   => 'border-[#F3F4F6] bg-[#F9FAFB]',
            'teks'   => 'text-[#99A1AF]',
        ],
    ];
    $jumlahTahap = count($usulan['tahapan']);
@endphp

<style>
    .field-input { height: 2.25rem; width: 100%; border-radius: .5rem; border: 1px solid #00A4FF; background: #fff; padding: 0 .75rem; font-size: .875rem; color: #364153; outline: none; }
    .field-input:focus { box-shadow: 0 0 0 3px #E2F2FD; }
    .field-input[readonly] { border-color: transparent; background: transparent; padding-left: 0; padding-right: 0; box-shadow: none; cursor: default; }
    dialog.dokumen-dialog::backdrop { background: rgba(30, 41, 57, .45); }
</style>

<div class="mx-auto max-w-[5000px]">
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm text-[#0055B6] hover:underline">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
        Kembali ke Dashboard
    </a>

    @if (session('status'))
        <div role="status" class="mt-5 rounded-lg border border-[#41BFD5] bg-[#E2F2FD] px-4 py-3 text-sm text-[#0055B6]">
            {{ session('status') }}
        </div>
    @endif

    <section class="mt-5 overflow-hidden rounded-2xl bg-white shadow-md" aria-labelledby="judul-monitoring">
        <div class="flex items-center justify-between bg-[#41BFD5] px-6 py-5 text-white">
            <h2 id="judul-monitoring" class="flex items-center gap-3 text-xl font-medium">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Monitoring Progress Usulan Satyalancana
            </h2>
            <div class="text-right">
                <p class="text-sm">Progress</p>
                <p class="text-2xl font-semibold leading-tight">{{ $usulan['progress'] }}%</p>
            </div>
        </div>

        <ol class="grid gap-6 px-6 py-8 sm:grid-cols-2 lg:grid-cols-4 lg:gap-8">
            @foreach ($usulan['tahapan'] as $i => $tahap)
                @php $s = $stepStyle[$tahap['state']]; @endphp
                <li class="flex flex-col items-center text-center" @if ($tahap['state'] === 'berjalan') aria-current="step" @endif>
                    <div class="relative flex h-12 w-full items-center justify-center">
                        @if ($i > 0)
                            <span class="absolute left-0 right-1/2 top-1/2 hidden h-0.5 -translate-y-1/2 lg:block {{ $tahap['state'] === 'menunggu' ? 'bg-[#E5E7EB]' : 'bg-[#41BFD5]' }}"></span>
                        @endif
                        @if ($i < $jumlahTahap - 1)
                            <span class="absolute left-1/2 right-0 top-1/2 hidden h-0.5 -translate-y-1/2 lg:block {{ $tahap['state'] === 'selesai' ? 'bg-[#41BFD5]' : 'bg-[#E5E7EB]' }}"></span>
                        @endif

                        <span class="relative z-10 flex h-12 w-12 items-center justify-center rounded-full text-base font-medium {{ $s['circle'] }}">
                            @if ($tahap['state'] === 'selesai')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
                                <span class="sr-only">Selesai</span>
                            @else
                                {{ $i + 1 }}
                            @endif
                        </span>
                    </div>

                    <h3 class="mt-4 text-sm font-semibold {{ $s['judul'] }}">{{ $tahap['judul'] }}</h3>
                    <p class="mt-1 text-xs {{ $s['desk'] }}">{{ $tahap['deskripsi'] }}</p>

                    <dl class="mt-4 w-full space-y-2.5 rounded-xl border px-4 py-4 text-left text-xs {{ $s['card'] }} {{ $s['teks'] }}">
                        <div class="flex gap-3"><dt class="w-14 shrink-0">Mulai:</dt><dd>{{ $tahap['mulai'] ?? '-' }}</dd></div>
                        <div class="flex gap-3"><dt class="w-14 shrink-0">Selesai:</dt><dd>{{ $tahap['selesai'] ?? '-' }}</dd></div>
                        <div class="flex gap-3"><dt class="w-14 shrink-0">Catatan:</dt><dd>{{ $tahap['catatan'] ?? '-' }}</dd></div>
                    </dl>
                </li>
            @endforeach
        </ol>
    </section>

    <section class="mt-6 overflow-hidden rounded-2xl bg-white shadow-md">
        <div class="bg-[#E2F2FD] px-6 py-5">
            <h1 class="text-xl font-semibold text-[#0055B6]">Detail Usulan Satyalancana</h1>
            <p class="mt-2 text-sm text-[#4A5565]">ID: {{ $usulan['kode'] }}</p>
        </div>

        <form method="POST" action="{{ route('usulan.update', $usulan['id']) }}" id="form-usulan">
            @csrf
            @method('PUT')

            <div class="border-b border-[#F3F4F6] p-6">
                <h2 class="text-base font-semibold text-[#1E2939]">Data Pegawai</h2>

                <div class="mt-5 grid gap-x-8 gap-y-5 md:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-[#1E2939]">Nama Pegawai</p>
                        <p class="mt-1 flex h-9 items-center text-sm text-[#364153]">{{ $usulan['nama'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-[#1E2939]">NIP</p>
                        <p class="mt-1 flex h-9 items-center text-sm text-[#364153]">{{ $usulan['nip'] }}</p>
                    </div>

                    @foreach ([
                        'pangkat_golongan' => 'Pangkat/Golongan',
                        'jabatan'          => 'Jabatan',
                        'unit_kerja'       => 'Unit Kerja',
                    ] as $field => $label)
                        <div>
                            <div class="flex items-center gap-2">
                                <label for="{{ $field }}" class="text-sm font-medium text-[#1E2939]">{{ $label }}</label>
                                <button type="button" data-edit="{{ $field }}" aria-label="Ubah {{ $label }}"
                                        class="rounded text-[#00A4FF] hover:text-[#0055B6] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#00A4FF]">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                </button>
                            </div>
                            <input id="{{ $field }}" name="{{ $field }}" type="text"
                                   value="{{ old($field, $usulan[$field]) }}"
                                   class="field-input mt-1" @unless ($errors->has($field)) readonly @endunless>
                            @error($field)
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @if ($field === 'unit_kerja')
                            <div>
                                <p class="text-sm font-medium text-[#1E2939]">Jenis Satyalancana</p>
                                <p class="mt-1 flex h-9 items-center text-sm text-[#364153]">{{ $usulan['jenis'] }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="mt-5">
                    <p class="text-sm font-medium text-[#1E2939]">Status</p>
                    <span class="mt-2 inline-flex rounded-full bg-[#00A4FF] px-3 py-1 text-xs font-medium text-white">{{ $usulan['status'] }}</span>
                </div>
            </div>

            <div class="p-6">
                <h2 class="text-lg font-medium text-[#1E2939]">Dokumen Persyaratan</h2>

                <ul class="mt-5 space-y-3">
                    @foreach ($usulan['dokumen'] as $dok)
                        @php $jawaban = old('verifikasi.' . $dok['id'], $dok['jawaban']); @endphp
                        <li class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-[#D6ECFA] bg-[#E2F2FD] px-4 py-5">
                            <p class="flex items-baseline gap-3 text-sm text-[#364153]">
                                <span class="w-4 shrink-0">{{ $loop->iteration }}.</span>
                                <span>{{ $dok['nama'] }}</span>
                            </p>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('usulan.dokumen.lihat', [$usulan['id'], $dok['id']]) }}" target="_blank" rel="noopener"
                                   title="Lihat {{ $dok['nama'] }}" aria-label="Lihat {{ $dok['nama'] }}"
                                   class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-[#C5D500] hover:bg-[#F9FAFB]">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>

                                <a href="{{ route('usulan.dokumen.unduh', [$usulan['id'], $dok['id']]) }}"
                                   title="Unduh {{ $dok['file'] }} ({{ $dok['ukuran'] }})" aria-label="Unduh {{ $dok['nama'] }}"
                                   class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-[#41BFD5] hover:bg-[#F9FAFB]">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 15V3"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/></svg>
                                </a>

                                <button type="button" data-verifikasi="{{ $dok['id'] }}"
                                        class="inline-flex h-9 items-center gap-1.5 rounded-lg bg-[#00A4FF] px-4 text-sm font-medium text-white hover:bg-[#0090E0] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#0055B6]">
                                    <svg data-check class="h-4 w-4 {{ $jawaban === '' ? 'hidden' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
                                    Verifikasi
                                </button>
                            </div>

                            <dialog id="dialog-{{ $dok['id'] }}" aria-labelledby="dialog-judul-{{ $dok['id'] }}"
                                    class="dokumen-dialog m-auto w-[calc(100%-2rem)] max-w-md rounded-2xl p-0 shadow-xl">
                                <div class="rounded-t-2xl bg-[#E2F2FD] px-6 py-4">
                                    <h3 id="dialog-judul-{{ $dok['id'] }}" class="text-base font-semibold text-[#0055B6]">Verifikasi Dokumen</h3>
                                    <p class="mt-1 text-xs text-[#4A5565]">{{ $loop->iteration }}. {{ $dok['nama'] }}</p>
                                </div>
                                <div class="px-6 py-5">
                                    <label for="verifikasi-{{ $dok['id'] }}" class="mb-2 block text-sm font-medium text-[#1E2939]">{{ $dok['pertanyaan'] }}</label>
                                    <input id="verifikasi-{{ $dok['id'] }}" name="verifikasi[{{ $dok['id'] }}]" type="text" maxlength="255"
                                           value="{{ $jawaban }}" data-original="{{ $jawaban }}" placeholder="Tulis jawaban Anda"
                                           class="h-11 w-full rounded-lg border border-[#E5E7EB] bg-white px-3 text-sm text-[#364153] focus:border-[#00A4FF] focus:outline-none focus:ring-2 focus:ring-[#E2F2FD]">
                                    @error('verifikasi.' . $dok['id'])
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-2 text-xs text-[#6A7282]">Jawaban baru tersimpan setelah Anda menekan tombol Simpan di halaman ini.</p>
                                </div>
                                <div class="flex justify-end gap-2 border-t border-[#F3F4F6] px-6 py-4">
                                    <button type="button" data-batal="{{ $dok['id'] }}" class="h-9 rounded-lg border border-[#E5E7EB] bg-white px-4 text-sm text-[#364153] hover:bg-[#F9FAFB]">Batal</button>
                                    <button type="button" data-ok="{{ $dok['id'] }}" class="h-9 rounded-lg bg-[#00A4FF] px-4 text-sm font-medium text-white hover:bg-[#0090E0]">Simpan Jawaban</button>
                                </div>
                            </dialog>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                            class="h-12 rounded-lg bg-[#41BFD5] px-8 text-base font-medium text-white shadow-lg hover:bg-[#35AEC3] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#0055B6]">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </section>
</div>

<script>
    (function () {
        document.querySelectorAll('[data-edit]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = document.getElementById(btn.dataset.edit);
                input.removeAttribute('readonly');
                input.focus();
                input.setSelectionRange(input.value.length, input.value.length);
            });
        });

        function tandai(id) {
            var input = document.getElementById('verifikasi-' + id);
            var tombol = document.querySelector('[data-verifikasi="' + id + '"] [data-check]');
            tombol.classList.toggle('hidden', input.value.trim() === '');
        }

        document.querySelectorAll('[data-verifikasi]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var dialog = document.getElementById('dialog-' + btn.dataset.verifikasi);
                dialog.showModal();
                document.getElementById('verifikasi-' + btn.dataset.verifikasi).focus();
            });
        });

        document.querySelectorAll('[data-ok]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var id = btn.dataset.ok;
                var input = document.getElementById('verifikasi-' + id);
                input.dataset.original = input.value;
                tandai(id);
                document.getElementById('dialog-' + id).close();
            });
        });

        document.querySelectorAll('[data-batal]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var id = btn.dataset.batal;
                var input = document.getElementById('verifikasi-' + id);
                input.value = input.dataset.original;
                document.getElementById('dialog-' + id).close();
            });
        });

        document.querySelectorAll('dialog input').forEach(function (input) {
            input.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    input.closest('dialog').querySelector('[data-ok]').click();
                }
            });
        });
    })();
</script>
@endsection