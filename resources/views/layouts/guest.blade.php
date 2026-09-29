<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-950">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $setting?->site_name ?? config('app.name', 'Laravel') }} - Admin Portal</title>

        @php
            $faviconVersion = $setting?->updated_at?->timestamp ?? time();
            $rawAdminFavicon = $setting?->admin_favicon_url ?? asset('assets/admin-favicon.svg');
            $adminFavicon = $rawAdminFavicon . '?v=' . $faviconVersion;
            $adminFaviconMime = \App\Models\Setting::getFaviconMimeType($rawAdminFavicon);
        @endphp
        <!-- Favicon / Tab Icon -->
        <link rel="icon" type="{{ $adminFaviconMime }}" href="{{ $adminFavicon }}">
        <link rel="apple-touch-icon" href="{{ $adminFavicon }}">

        <!-- Google Fonts: Inter & Poppins -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

        <!-- Tailwind CSS CDN for high fidelity rendering -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            display: ['Poppins', 'sans-serif'],
                        }
                    }
                }
            }
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .bg-mesh {
                background-color: #080c14;
                background-image: 
                    radial-gradient(at 15% 15%, rgba(37, 99, 235, 0.20) 0px, transparent 48%),
                    radial-gradient(at 85% 85%, rgba(99, 102, 241, 0.18) 0px, transparent 48%),
                    radial-gradient(at 50% 50%, rgba(14, 165, 233, 0.08) 0px, transparent 65%);
            }
            .grid-pattern {
                background-size: 32px 32px;
                background-image: radial-gradient(circle, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
            }
            .glass-card {
                background: rgba(15, 23, 42, 0.78);
                backdrop-filter: blur(24px);
                -webkit-backdrop-filter: blur(24px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
        </style>
    </head>
    <body class="font-sans text-slate-100 antialiased h-full bg-mesh selection:bg-blue-600 selection:text-white relative overflow-x-hidden min-h-screen flex flex-col justify-between">
        
        <!-- Ambient Grid & Glow Effects -->
        <div class="fixed inset-0 grid-pattern pointer-events-none opacity-60 z-0"></div>
        <div class="fixed -top-40 -left-40 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl pointer-events-none animate-pulse" style="animation-duration: 6s;"></div>
        <div class="fixed -bottom-40 -right-40 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none animate-pulse" style="animation-duration: 8s;"></div>

        <!-- Top Navigation Bar -->
        @php
            $profile = \App\Models\Profile::first();
        @endphp
        <header class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 flex items-center justify-between">
            <a href="{{ route('home') }}" class="group inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-medium text-slate-300 bg-slate-900/70 hover:bg-slate-800 hover:text-white border border-slate-700/50 backdrop-blur-md transition-all duration-200 hover:border-slate-600 shadow-sm">
                <i class="bi bi-arrow-left transition-transform duration-200 group-hover:-translate-x-0.5 text-blue-400"></i>
                <span>Kembali ke Website</span>
            </a>

            <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
                <span class="inline-flex h-2 w-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span class="text-slate-300">Portal Admin</span>
            </div>
        </header>

        <!-- Main Slot -->
        <main class="relative z-10 flex-1 flex flex-col justify-center items-center px-4 py-8 sm:px-6 w-full">
            {{ $slot }}
        </main>

        <!-- Minimal Footer -->
        <footer class="relative z-10 w-full py-5 text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} {{ $profile->full_name ?? 'Ahmad Zaki' }}. Hak Cipta Dilindungi.
        </footer>
    </body>
</html>
