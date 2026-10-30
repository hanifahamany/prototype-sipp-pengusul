<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Informasi Satyalancana Karya Satya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-[#FFFEFE] text-[#364153]">

    <header class="bg-[#0055B6] text-white shadow-md">
        <div class="flex items-center gap-4 px-6 py-4 md:px-12">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-white p-1">
                <img src="{{ asset('images/logo-kemdiktisaintek.png') }}" alt="Logo Kemdiktisaintek" class="h-full w-full object-contain">
            </div>
            <div>
                <p class="text-sm font-bold leading-tight md:text-base">Sistem Informasi Satyalancana Karya Satya</p>
                <p class="text-xs leading-tight md:text-sm">Biro Organisasi dan Sumber Daya Manusia Kemdiktisaintek RI</p>
            </div>
        </div>
    </header>

    <main class="flex flex-1 items-center justify-center px-4 py-10 md:px-12">
        <div class="grid w-full max-w-[1200px] overflow-hidden rounded-2xl bg-[#FFFEFE] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] md:grid-cols-2">

            <section class="flex flex-col justify-center bg-[#E2F2FD] p-8 md:p-12">
                <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#00A4FF]">
                    <svg class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/>
                        <circle cx="12" cy="8" r="6"/>
                    </svg>
                </div>
                <h2 class="mb-2 text-xl font-semibold text-[#0055B6] md:text-2xl">Sistem Informasi Satyalancana Karya Satya</h2>
                <p class="text-justify text-sm leading-7 text-[#364153]">
                    Satyalancana Karya Satya adalah tanda kehormatan Republik Indonesia bagi PNS atas pengabdian, kesetiaan, dan kedisiplinan selama 10, 20, atau 30 tahun secara terus-menerus, dengan tingkatan Perunggu, Perak, dan Emas sesuai masa bakti.
                </p>
            </section>

            <section class="flex flex-col justify-center p-8 md:p-12">
                <h1 class="text-2xl font-semibold text-[#0055B6]">Login</h1>
                <p class="mb-8 text-sm text-[#4A5565]">Silakan Akses Sistem Informasi Satyalancana Karya Satya</p>

                <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="nip" class="mb-2 block text-sm text-[#364153]">NIP</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-[#99A1AF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                            <input id="nip" name="nip" type="text" inputmode="numeric" value="{{ old('nip') }}" autofocus autocomplete="username"
                                   placeholder="Masukkan NIP"
                                   class="h-11 w-full rounded-xl border border-[#E5E7EB] bg-[#FFFEFE] pl-11 pr-4 text-sm text-[#0A0A0A] placeholder:text-[#99A1AF] focus:border-[#00A4FF] focus:outline-none focus:ring-2 focus:ring-[#00A4FF]/30">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm text-[#364153]">Password</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-[#99A1AF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                   placeholder="Masukkan password"
                                   class="h-11 w-full rounded-xl border border-[#E5E7EB] bg-[#FFFEFE] pl-11 pr-12 text-sm text-[#0A0A0A] placeholder:text-[#99A1AF] focus:border-[#00A4FF] focus:outline-none focus:ring-2 focus:ring-[#00A4FF]/30">
                            <button type="button" data-password-toggle aria-controls="password" aria-label="Tampilkan password" aria-pressed="false"
                                    class="absolute right-2 top-1/2 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-lg text-[#6A7282] hover:text-[#0055B6] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#00A4FF]/50">
                                <svg data-password-hidden-icon class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <svg data-password-visible-icon class="hidden h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="m3 3 18 18"/>
                                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                                    <path d="M9.9 5.2A11 11 0 0 1 12 5c6.4 0 10 7 10 7a13 13 0 0 1-3 3.8"/>
                                    <path d="M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7a10.7 10.7 0 0 0 4-.8"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                            class="h-12 w-full rounded-xl bg-[#00A4FF] text-sm font-medium text-white shadow-lg shadow-[#00A4FF]/30 transition hover:bg-[#0092E6] focus:outline-none focus:ring-2 focus:ring-[#00A4FF]/50">
                        Masuk
                    </button>

                    <p class="text-center text-xs">
                        <a href="{{ route('password.request') }}" class="text-[#00A4FF] hover:underline">Lupa password</a>
                    </p>
                </form>
            </section>
        </div>
    </main>

    <footer class="bg-[#0055B6] px-6 py-8 text-center text-white">
        <p class="text-sm">&copy; {{ date('Y') }} Biro OSDM - Kementerian Pendidikan Tinggi, Sains, dan Teknologi</p>
        <p class="mt-2 text-xs">Sistem Informasi Satyalancana Karya Satya</p>
    </footer>

</body>
</html>