@extends('layouts.app')

@section('title', 'Beranda - Sistem Informasi Satyalancana Karya Satya')

@php
    $badge = [
        'Verifikasi BOSDM'  => 'bg-[#00A4FF]',
        'Verifikasi Sesmil' => 'bg-[#00A4FF]',
        'Perlu Perbaikan'   => 'bg-[#D4217A]',
        'Disetujui'         => 'bg-[#41BFD5]',
    ];
@endphp

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <a href="{{ route('usulan.create') }}" class="flex min-h-[150px] flex-col justify-between rounded-2xl bg-[#41BFD5] p-6 text-white shadow-md transition hover:brightness-95">
            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/20">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            </span>
            <span class="text-lg font-semibold">Buat Usulan Baru</span>
        </a>

        <div class="rounded-2xl border-l-4 border-[#0055B6] bg-white p-6 shadow-md">
            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#0055B6]/[0.125] text-[#0055B6]">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/><circle cx="12" cy="8" r="6"/></svg>
            </span>
            <p class="mt-4 text-3xl font-semibold text-[#1E2939]">{{ $stats['total'] }}</p>
            <p class="text-sm text-[#4A5565]">Total Usulan</p>
        </div>

        <div class="rounded-2xl border-l-4 border-[#00A4FF] bg-white p-6 shadow-md">
            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#00A4FF]/[0.125] text-[#00A4FF]">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            </span>
            <p class="mt-4 text-3xl font-semibold text-[#1E2939]">{{ $stats['menunggu'] }}</p>
            <p class="text-sm text-[#4A5565]">Menunggu Verifikasi</p>
        </div>

        <div class="rounded-2xl border-l-4 border-[#D4217A] bg-white p-6 shadow-md">
            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#D4217A]/[0.125] text-[#D4217A]">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
            </span>
            <p class="mt-4 text-3xl font-semibold text-[#1E2939]">{{ $stats['perbaikan'] }}</p>
            <p class="text-sm text-[#4A5565]">Perlu Perbaikan</p>
        </div>
    </div>

    <section class="mt-8 overflow-hidden rounded-2xl bg-white shadow-md">
        <form id="form-filter" method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap items-center justify-between gap-3 bg-[#E2F2FD] px-4 py-4 sm:px-6 sm:py-5">
            <h2 class="text-lg font-semibold text-[#0055B6]">Usulan Terbaru</h2>
            <div class="flex w-full flex-wrap gap-3 sm:w-auto">
                <div class="relative w-full sm:w-72">
                    <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#99A1AF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    <input type="text" name="q" value="{{ $q }}" autocomplete="off" placeholder="Cari no. registrasi, surat usul..."
                           class="h-10 w-72 max-w-full rounded-lg border border-transparent bg-white pl-9 pr-3 text-sm placeholder:text-[#6A7282] focus:border-[#00A4FF] focus:outline-none">
                </div>
                <select name="status" onchange="this.form.submit()"
                        class="h-10 rounded-lg border border-transparent bg-white px-3 text-sm text-[#364153] shadow-sm focus:border-[#00A4FF] focus:outline-none">
                    <option value="">Seluruh Status</option>
                    @foreach ($statuses as $s)
                        <option value="{{ $s }}" @selected($status === $s)>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-left text-sm">
                <thead class="bg-[#F9FAFB] text-[#364153]">
                    <tr class="border-b border-[#E5E7EB]">
                        <th class="px-6 py-4 font-medium">No</th>
                        <th class="px-3 py-4 font-medium">No. Registrasi</th>
                        <th class="px-3 py-4 font-medium">No. Surat Usul</th>
                        <th class="px-3 py-4 font-medium">Status Usulan</th>
                        <th class="px-3 py-4 font-medium">Tanggal</th>
                        <th class="px-3 py-4 font-medium">Dibuat Oleh</th>
                        {{-- tampil pas sidebar ditutup --}}
                        {{-- <th class="hidden px-3 py-4 font-medium group-data-[collapsed=true]/body:table-cell">Aksi</th> --}}
                        <th class="px-3 py-4 font-medium group-data-[collapsed=true]/body:table-cell">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F3F4F6]">
                    @forelse ($usulan as $u)
                        <tr class="hover:bg-[#F9FAFB]">
                            <td class="px-6 py-5">{{ $u['no'] }}</td>
                            <td class="px-3 py-5">{{ $u['no_registrasi'] }}</td>
                            <td class="px-3 py-5 text-[#4A5565]">{{ $u['no_surat'] }}</td>
                            <td class="px-3 py-5">
                                <span class="inline-block whitespace-nowrap rounded-full px-3 py-0.5 text-xs text-white {{ $badge[$u['status']] ?? 'bg-[#99A1AF]' }}">{{ $u['status'] }}</span>
                            </td>
                            <td class="px-3 py-5 text-[#4A5565]">{{ $u['tanggal'] }}</td>
                            <td class="px-3 py-5">{{ $u['dibuat_oleh'] }}</td>
                            <td class="px-3 py-5">
                                <div class="flex items-center gap-3">
                                    <a href="{{route('usulan.show', $u['no'])}}" title="Lihat" class="text-[#C5D500]"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.06 12.35a1 1 0 0 1 0-.7 10.75 10.75 0 0 1 19.88 0 1 1 0 0 1 0 .7 10.75 10.75 0 0 1-19.88 0"/><circle cx="12" cy="12" r="3"/></svg></a>
                                    <a href="#" title="Catatan" class="text-[#00A4FF]"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></a>
                                    <a href="#" title="Unduh" class="text-[#41BFD5]"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg></a>
                                    <a href="#" title="Lainnya" class="text-[#364153]"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="12" cy="19" r="1.6"/></svg></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-6 py-10 text-center text-[#6A7282]">Tidak ada usulan yang cocok.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-[#E5E7EB] bg-[#F9FAFB] px-4 py-4 text-sm text-[#4A5565]">
            <p>
                @if ($usulan->total() > 0)
                    Menampilkan {{ $usulan->firstItem() }}–{{ $usulan->lastItem() }} dari {{ $usulan->total() }} usulan
                @else
                    Menampilkan 0 usulan
                @endif
            </p>
            <div class="flex gap-2">
                @if ($usulan->onFirstPage())
                    <span class="rounded-lg border border-[#E5E7EB] bg-white px-4 py-2 text-[#99A1AF]">Previous</span>
                @else
                    <a href="{{ $usulan->previousPageUrl() }}" class="rounded-lg border border-[#E5E7EB] bg-white px-4 py-2 font-medium text-[#1E2939] hover:bg-[#F3F4F6]">Previous</a>
                @endif
                @if ($usulan->hasMorePages())
                    <a href="{{ $usulan->nextPageUrl() }}" class="rounded-lg bg-[#00A4FF] px-4 py-2 text-white hover:bg-[#0092E6]">Next</a>
                @else
                    <span class="rounded-lg bg-[#00A4FF]/50 px-4 py-2 text-white">Next</span>
                @endif
            </div>
        </div>
    </section>
@endsection