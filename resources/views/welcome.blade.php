<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'MyEsa-Productions') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|space-grotesk:700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            @layer theme {
                :root {
                    /* KONFIGURASI WARNA OTOMATIS (Ganti di sini aja) */
                    --color-main-bg: #FDFDFC;      /* Background halaman */
                    --color-dark-bg: #0f172a;      /* Background Dark Mode */
                    --color-primary: #f53003;      /* Warna aksen (Tombol/Link) */
                    --color-primary-hover: #c42602;
                    --color-text-bold: #1b1b18;    /* Warna teks utama */
                    --color-text-light: #706f6c;   /* Warna teks sekunder */
                    
                    /* Variabel Font */
                    --font-heading: 'Space Grotesk', sans-serif;
                }
            }

            body {
                background-color: var(--color-main-bg);
                color: var(--color-text-bold);
                font-family: 'Instrument Sans', sans-serif;
            }

            .dark body {
                background-color: var(--color-dark-bg);
                color: #EDEDEC;
            }

            .heading-font {
                font-family: var(--font-heading);
            }

            .btn-primary {
                background-color: var(--color-primary);
                color: white;
                transition: all 0.3s;
            }

            .btn-primary:hover {
                background-color: var(--color-primary-hover);
                transform: translateY(-2px);
            }
        </style>
    </head>
    <body class="antialiased flex flex-col min-h-screen">
        
        <header class="w-full max-w-6xl mx-auto px-6 py-6 flex justify-between items-center">
            <div class="text-xl font-bold heading-font tracking-tighter">
                SIROYO<span class="text-[var(--color-primary)]">321</span>
            </div>
            
            @if (Route::has('login'))
                <nav class="flex gap-4 items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-[var(--color-primary)]">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium hover:text-[var(--color-primary)]">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 border border-slate-300 rounded-lg text-sm font-medium hover:bg-slate-100 transition">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="flex-grow flex items-center justify-center px-6">
            <div class="max-w-4xl w-full grid lg:grid-cols-2 gap-12 items-center">
                
                <div class="space-y-6">
                    <h1 class="text-5xl lg:text-6xl font-bold heading-font leading-tight">
                        Building the <span class="text-[var(--color-primary)]">Future</span> of IoT & AI.
                    </h1>
                    <p class="text-lg text-[var(--color-text-light)] leading-relaxed">
                        Halo, saya **siroyo321**. Saya seorang developer yang fokus pada integrasi sistem IoT menggunakan ESP32 dan pengembangan aplikasi berbasis AI.
                    </p>
                    <div class="flex gap-4">
                        <a href="/contact" class="btn-primary px-8 py-4 rounded-xl font-semibold shadow-lg shadow-red-500/20">
                            Hubungi Saya
                        </a>
                        <a href="#projects" class="px-8 py-4 border border-slate-300 rounded-xl font-semibold hover:bg-slate-50 transition">
                            Lihat Proyek
                        </a>
                    </div>
                </div>

                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-[var(--color-primary)] to-orange-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                    <div class="relative bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-4 rounded-2xl shadow-2xl">
                        <div class="aspect-video bg-slate-100 dark:bg-slate-900 rounded-lg flex items-center justify-center overflow-hidden">
                            <span class="text-slate-400 italic text-sm">Pratinjau Proyek Utama (IoT System)</span>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-widest text-[var(--color-primary)]">Featured Project</span>
                            <span class="text-xs text-slate-500">2026 Edition</span>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <footer class="w-full max-w-6xl mx-auto px-6 py-12 border-t border-slate-100 dark:border-slate-800 text-center">
            <p class="text-sm text-[var(--color-text-light)]">
                &copy; {{ date('Y') }} siroyo321. Built with Laravel & Passion.
            </p>
        </footer>

    </body>
</html>