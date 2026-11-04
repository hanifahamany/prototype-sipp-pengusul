@extends('layouts.app')

@section('title', 'Komunikasi Usulan - Sistem Informasi Satyalancana Karya Satya')

@section('content')
@php
    $kode = str_pad((string) $id, 3, '0', STR_PAD_LEFT);
@endphp

<a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm text-[#0055B6] hover:underline">
    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
    Kembali ke Detail Dokumen
</a>

<section class="mt-5 overflow-hidden rounded-2xl bg-white shadow-md">
    {{-- Header --}}
    <div class="bg-[#E2F2FD] px-6 py-5">
        <h1 class="text-xl font-semibold text-[#0055B6]">Komunikasi Usulan</h1>
        <p class="mt-1 text-sm text-[#4A5565]">Usulan Satyalancana Karya Satya</p>
        <p class="mt-1 text-xs text-[#6A7282]">ID Usulan: {{ $kode }}</p>
    </div>

    {{-- Area pesan (kosong) --}}
    <div class="flex min-h-[320px] flex-col items-center justify-center gap-3 px-6 py-10 text-center">
        <span class="flex h-14 w-14 items-center justify-center rounded-full bg-[#F3F4F6] text-[#99A1AF]">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </span>
        <p class="text-sm text-[#6A7282]">Belum ada percakapan untuk usulan ini.</p>
    </div>

    {{-- Composer statis untuk prototype --}}
    <div class="border-t border-[#E5E7EB] bg-[#F9FAFB] px-6 py-5">
        <div class="flex items-start gap-3">
            <div class="min-w-0 flex-1">
                <label for="isi-pesan" class="sr-only">Pesan</label>
                <textarea id="isi-pesan" rows="2" placeholder="Ketik pesan Anda..." disabled
                          class="w-full resize-none rounded-lg border border-[#E5E7EB] bg-white px-4 py-3 text-sm text-[#364153] placeholder:text-[#99A1AF] disabled:cursor-not-allowed disabled:bg-[#F3F4F6]"></textarea>
            </div>
            <button type="button" disabled
                    class="inline-flex h-10 shrink-0 cursor-not-allowed items-center gap-2 rounded-lg bg-[#E5E7EB] px-4 text-sm font-medium text-[#99A1AF]">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"/><path d="m21.854 2.147-10.94 10.939"/></svg>
                Kirim
            </button>
        </div>
    </div>
</section>
@endsection