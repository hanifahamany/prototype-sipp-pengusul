<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Informasi Satyalancana Karya Satya')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> html { overflow-y: scroll; } body { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; } </style>
</head>
<body class="group/body min-h-screen bg-[#FFFEFE] text-[#364153]" data-collapsed="@yield('sidebar_collapsed', 'false')">
    <script>
        var savedSidebarState = localStorage.getItem('sidebar-collapsed');
        if (savedSidebarState === 'true' || savedSidebarState === 'false') {
            document.body.dataset.collapsed = savedSidebarState;
        } else if (window.matchMedia('(max-width: 1279px)').matches) {
            document.body.dataset.collapsed = 'true';
        }
    </script>

    @php
        $navAktif = 'bg-[#E2F2FD] font-medium text-[#0055B6]';
        $navBiasa = 'text-[#1E2939] hover:bg-[#F3F4F6]';
    @endphp

    <header class="relative z-10 flex h-20 items-center justify-between bg-[#0055B6] px-4 text-white shadow-md md:px-12">
        <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-white p-1">
                <img src="{{ asset('images/logo-kemdiktisaintek.png') }}" alt="Logo Kemdiktisaintek" class="h-full w-full object-contain">
            </div>
            <div class="hidden sm:block">
                <p class="text-base font-bold leading-tight">Sistem Informasi Satyalancana Karya Satya</p>
                <p class="text-sm leading-tight">Biro Organisasi dan Sumber Daya Manusia Kemdiktisaintek RI</p>
            </div>
        </div>

        <div class="flex items-center gap-5">
            <button type="button" class="relative" aria-label="Notifikasi">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                {{-- <span class="absolute -right-2 -top-2 flex h-5 w-5 items-center justify-center rounded-full bg-[#C5D500] text-xs font-semibold text-[#364153]">2</span> --}}
            </button>
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#C5D500] text-white">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div class="hidden text-left md:block">
                    <p class="text-sm font-semibold leading-tight">{{ $user['nama'] }}</p>
                    <p class="text-xs leading-tight">{{ $user['unit'] }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" aria-label="Keluar" title="Keluar">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/></svg>
                </button>
            </form>
        </div>
    </header>

    <div class="flex min-h-[calc(100vh-5rem)]">
        <aside class="w-[230px] shrink-0 border-r border-[#E5E7EB] bg-[#FFFEFE] shadow-sm transition-[width] duration-200 group-data-[collapsed=true]/body:w-12 max-xl:fixed max-xl:bottom-0 max-xl:left-0 max-xl:top-20 max-xl:z-20 max-xl:w-12 group-data-[collapsed=false]/body:max-xl:w-[230px]">
            <div class="flex items-start justify-between p-3 group-data-[collapsed=true]/body:justify-center group-data-[collapsed=true]/body:px-0">
                <span class="mt-2 text-xs tracking-wide text-[#6A7282] group-data-[collapsed=true]/body:hidden">MENU</span>
                <button type="button" id="sidebar-toggle" aria-label="Buka/tutup menu" class="text-[#364153]">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><rect x="3" y="3" width="8" height="8" rx="2.5"/><rect x="13" y="3" width="8" height="8" rx="2.5"/><rect x="3" y="13" width="8" height="8" rx="2.5"/><rect x="13" y="13" width="8" height="8" rx="2.5"/></svg>
                </button>
            </div>

            <nav class="space-y-1 px-3 group-data-[collapsed=true]/body:hidden">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm {{ request()->routeIs('dashboard', 'usulan.*') ? $navAktif : $navBiasa }}">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    Beranda
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm {{ request()->routeIs('profile.*') ? $navAktif : $navBiasa }}">
                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" fill-rule="evenodd" stroke="currentColor" stroke-width="1" stroke-linejoin="round" aria-hidden="true"><path d="M9.53 4.81 L9.71 2.06 L14.29 2.06 L14.47 4.81 L15.33 5.17 L17.41 3.35 L20.65 6.59 L18.83 8.67 L19.19 9.53 L21.94 9.71 L21.94 14.29 L19.19 14.47 L18.83 15.33 L20.65 17.41 L17.41 20.65 L15.33 18.83 L14.47 19.19 L14.29 21.94 L9.71 21.94 L9.53 19.19 L8.67 18.83 L6.59 20.65 L3.35 17.41 L5.17 15.33 L4.81 14.47 L2.06 14.29 L2.06 9.71 L4.81 9.53 L5.17 8.67 L3.35 6.59 L6.59 3.35 L8.67 5.17Z M15.3 12 a3.3 3.3 0 1 0 -6.6 0 a3.3 3.3 0 1 0 6.6 0Z"/></svg>
                    Profile
                </a>
            </nav>
        </aside>

        <main class="min-w-0 flex-1 p-4 md:p-8 lg:p-10 max-xl:pl-14">
            <div class="mx-auto max-w-[5000px]">    
            @yield('content')
            </div>
        </main>
    </div>

    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function () {
            var b = document.body;
            b.dataset.collapsed = b.dataset.collapsed === 'true' ? 'false' : 'true';
            localStorage.setItem('sidebar-collapsed', b.dataset.collapsed);
        });
    </script>

    @stack('scripts')
</body>
</html>