@extends('layouts.app')

@section('title', 'Profil - Sistem Informasi Satyalancana Karya Satya')

@section('content')
    <section class="flex flex-col items-center rounded-2xl bg-[#41BFD5] px-6 py-6 text-white shadow-md">
        <span class="flex h-[72px] w-[72px] items-center justify-center rounded-full bg-[#C5D500] text-[#0055B6]">
            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </span>
        <h1 class="mt-3 text-xl font-semibold">{{ $peran }}</h1>
        <p class="mt-1 text-sm">Detail Profile</p>
    </section>
    
    <div class="mt-8 w-full">
        <section class="mx-auto mt-8 w-full max-w-[720px]">
            <dl class="divide-y divide-[#E5E7EB] rounded-2xl border border-[#E5E7EB] bg-white px-6">
                @foreach ($profil as $label => $value)
                    <div class="grid gap-1 py-4 sm:grid-cols-[200px_1fr] sm:gap-6">
                        <dt class="text-sm text-[#6A7282]">{{ $label }}</dt>
                        <dd class="text-sm font-medium text-[#1E2939]">{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>
        </section>
    </div>
@endsection
