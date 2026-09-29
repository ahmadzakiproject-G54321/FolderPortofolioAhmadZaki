@props(['title' => 'Admin Portfolio'])
@php
$navSections = [
    [
        'title' => 'Overview',
        'items' => [
            [
                'url' => route('admin.dashboard'),
                'label' => 'Dashboard',
                'icon' => 'M3 13h8V3H3v10Zm10 8h8V11h-8v10ZM3 21h8v-6H3v6Zm10-18v5h8V3h-8Z',
                'active' => request()->routeIs('admin.dashboard')
            ],
        ]
    ],
    [
        'title' => 'Portfolio',
        'items' => [
            [
                'url' => route('admin.crud.index', 'projects'),
                'label' => 'Projects',
                'icon' => 'M4 6h16M4 12h16M4 18h16',
                'active' => request()->routeIs('admin.crud.*') && request()->route('resource') === 'projects'
            ],
            [
                'url' => route('admin.crud.index', 'skills'),
                'label' => 'Skills',
                'icon' => 'M12 3v18M3 12h18',
                'active' => request()->routeIs('admin.crud.*') && request()->route('resource') === 'skills'
            ],
            [
                'url' => route('admin.crud.index', 'experiences'),
                'label' => 'Experience',
                'icon' => 'M6 7V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2M4 7h16v12H4V7Z',
                'active' => request()->routeIs('admin.crud.*') && request()->route('resource') === 'experiences'
            ],
            [
                'url' => route('admin.crud.index', 'education'),
                'label' => 'Education',
                'icon' => 'M3 10l9-5 9 5-9 5-9-5Zm3 3v5c3 2 9 2 12 0v-5',
                'active' => request()->routeIs('admin.crud.*') && request()->route('resource') === 'education'
            ],
            [
                'url' => route('admin.crud.index', 'certificates'),
                'label' => 'Certificates',
                'icon' => 'M6 3h12v18l-6-3-6 3V3Z',
                'active' => request()->routeIs('admin.crud.*') && request()->route('resource') === 'certificates'
            ],
            [
                'url' => route('admin.crud.index', 'services'),
                'label' => 'Services',
                'icon' => 'M4 6h16M4 12h16M4 18h16',
                'active' => request()->routeIs('admin.crud.*') && request()->route('resource') === 'services'
            ],
            [
                'url' => route('admin.crud.index', 'statistics'),
                'label' => 'Statistik Hero',
                'icon' => 'M4 19V5m0 14h16M8 16v-4m4 4V8m4 8V4',
                'active' => request()->routeIs('admin.crud.*') && request()->route('resource') === 'statistics'
            ],
            [
                'url' => route('admin.crud.index', 'social-links'),
                'label' => 'Social Links',
                'icon' => 'M18 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6ZM6 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm12 7a3 3 0 1 0 0 6 3 3 0 0 0 0-6ZM8.6 13.5l6.8 4m0-9-6.8 4',
                'active' => request()->routeIs('admin.crud.*') && request()->route('resource') === 'social-links'
            ],
        ]
    ],
    [
        'title' => 'Komunikasi',
        'items' => [
            [
                'url' => route('admin.contacts.index'),
                'label' => 'Pesan Masuk',
                'icon' => 'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75',
                'active' => request()->routeIs('admin.contacts.*'),
                'badge' => \App\Models\Contact::where('is_read', false)->count() ?: null,
            ],
            [
                'url' => route('admin.crud.index', 'reviews'),
                'label' => 'Penilaian Klien',
                'icon' => 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z',
                'active' => request()->routeIs('admin.crud.*') && request()->route('resource') === 'reviews',
            ],
        ]
    ],
    [
        'title' => 'Website',
        'items' => [
            [
                'url' => route('admin.profile.edit'),
                'label' => 'Profil Portfolio',
                'icon' => 'M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 9a7 7 0 0 0-14 0',
                'active' => request()->routeIs('admin.profile.*')
            ],
            [
                'url' => route('admin.settings.edit'),
                'label' => 'Pengaturan Website',
                'icon' => 'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                'active' => request()->routeIs('admin.settings.*')
            ],
            [
                'url' => route('profile.edit'),
                'label' => 'Akun & Keamanan',
                'icon' => 'M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z',
                'active' => request()->routeIs('profile.*')
            ],
            [
                'url' => route('home'),
                'label' => 'Lihat Website',
                'icon' => 'M14 5h5v5M10 14 19 5M19 14v5H5V5h5',
                'target' => '_blank',
                'active' => false
            ],
        ]
    ],
];
$adminProfile = \App\Models\Profile::first();
$unreadContactCount = \App\Models\Contact::where('is_read', false)->count();
$recentUnreadContacts = \App\Models\Contact::where('is_read', false)->latest()->take(5)->get();
@endphp
<!doctype html>
<html lang="id" class="h-full bg-slate-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <title>{{ $title }} - {{ $setting?->site_name ?? 'Admin Panel' }}</title>

    @php
        $faviconVersion = $setting?->updated_at?->timestamp ?? time();
        $rawAdminFavicon = $setting?->admin_favicon_url ?? asset('assets/admin-favicon.svg');
        $adminFavicon = $rawAdminFavicon . '?v=' . $faviconVersion;
        $adminFaviconMime = \App\Models\Setting::getFaviconMimeType($rawAdminFavicon);
    @endphp
    <!-- Tab Icon (Favicon Admin) -->
    <link rel="icon" type="{{ $adminFaviconMime }}" href="{{ $adminFavicon }}">
    <link rel="apple-touch-icon" href="{{ $adminFavicon }}">

    <!-- Cropper.js (Local & Offline) -->
    <link rel="stylesheet" href="{{ asset('css/cropper.min.css') }}">
    <script src="{{ asset('js/cropper.min.js') }}"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .custom-sidebar-scroll {
            scrollbar-width: thin;
            scrollbar-color: #334155 transparent;
        }
        .custom-sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .custom-sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-sidebar-scroll::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 9999px;
        }
    </style>
</head>
<body class="min-h-full bg-slate-100 text-slate-800 antialiased selection:bg-slate-900 selection:text-white">
<div class="min-h-screen flex flex-col">

    <!-- Mobile Drawer Backdrop -->
    <div id="mobile-sidebar-backdrop" class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none lg:hidden" aria-hidden="true"></div>

    <!-- Mobile Slide-Over Sidebar Drawer -->
    <aside id="mobile-sidebar" class="fixed inset-y-0 left-0 z-50 flex w-72 max-w-[85vw] flex-col bg-slate-950 text-slate-200 shadow-2xl transition-transform duration-300 ease-in-out -translate-x-full lg:hidden" aria-label="Navigasi Mobile">
        <!-- Drawer Header -->
        <div class="flex h-14 shrink-0 items-center justify-between border-b border-slate-800/80 px-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-xs font-black text-slate-950">{{ $adminProfile?->initials ?? 'AZ' }}</div>
                <div>
                    <div class="text-sm font-bold tracking-tight text-white leading-none">Portfolio Admin</div>
                    <div class="text-[10px] text-slate-400 mt-0.5 leading-none">Management Panel</div>
                </div>
            </a>
            <button id="mobile-sidebar-close" type="button" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition" aria-label="Tutup navigasi">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Drawer Navigation List -->
        <nav class="flex-1 overflow-y-auto px-3 py-3 custom-sidebar-scroll">
            @foreach($navSections as $section)
                <div class="mb-1.5 {{ !$loop->first ? 'mt-3.5' : '' }} px-2.5 text-[10px] font-bold uppercase tracking-[0.16em] text-slate-500">
                    {{ $section['title'] }}
                </div>
                @foreach($section['items'] as $item)
                    <a href="{{ $item['url'] }}" @if(isset($item['target'])) target="{{ $item['target'] }}" @endif class="mb-1 flex items-center justify-between rounded-lg px-2.5 py-2.5 text-xs font-medium transition {{ $item['active'] ? 'bg-slate-900 text-white font-semibold shadow-sm' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="{{ $item['icon'] }}" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="truncate">{{ $item['label'] }}</span>
                        </div>
                        @if(!empty($item['badge']))
                            <span class="notif-badge shrink-0 rounded-full bg-blue-600 px-2 py-0.5 text-[10px] font-bold text-white shadow-sm">{{ $item['badge'] }}</span>
                        @endif
                    </a>
                @endforeach
            @endforeach
        </nav>

        <!-- Drawer Footer: Profile & Logout -->
        <div class="border-t border-slate-800/80 p-3">
            <div class="flex items-center justify-between gap-2 rounded-xl bg-slate-900/90 p-2">
                <div class="flex min-w-0 items-center gap-2.5">
                    @if($adminProfile?->profile_photo_url)
                        <img src="{{ $adminProfile->profile_photo_url }}" class="h-8 w-8 rounded-lg object-cover ring-1 ring-slate-700" alt="Profile">
                    @else
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-700 text-xs font-bold text-white">
                            {{ $adminProfile?->initials ?? 'AZ' }}
                        </div>
                    @endif
                    <div class="min-w-0">
                        <div class="truncate text-xs font-semibold text-white">{{ $adminProfile?->full_name ?? 'Nama Anda' }}</div>
                        <div class="truncate text-[10px] text-slate-400">{{ $adminProfile?->profession ?? 'Admin' }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                    @csrf
                    <button type="submit" title="Logout" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 transition hover:bg-red-500/10 hover:text-red-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Desktop Sidebar (Fixed Left) -->
    <aside class="fixed inset-y-0 left-0 z-40 hidden w-64 border-r border-slate-800 bg-slate-950 text-slate-200 lg:flex lg:flex-col">
        <div class="flex h-14 shrink-0 items-center border-b border-slate-800/80 px-5">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-xs font-black text-slate-950">{{ $adminProfile?->initials ?? 'AZ' }}</div>
                <div>
                    <div class="text-sm font-bold tracking-tight text-white leading-none">Portfolio Admin</div>
                    <div class="text-[10px] text-slate-400 mt-0.5 leading-none">Management Panel</div>
                </div>
            </a>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-3 custom-sidebar-scroll">
            @foreach($navSections as $section)
                <div class="mb-1.5 {{ !$loop->first ? 'mt-3.5' : '' }} px-2.5 text-[10px] font-bold uppercase tracking-[0.16em] text-slate-500">
                    {{ $section['title'] }}
                </div>
                @foreach($section['items'] as $item)
                    <a href="{{ $item['url'] }}" @if(isset($item['target'])) target="{{ $item['target'] }}" @endif class="mb-1 flex items-center justify-between rounded-lg px-2.5 py-2 text-xs font-medium transition {{ $item['active'] ? 'bg-slate-900 text-white font-semibold' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="{{ $item['icon'] }}" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="truncate">{{ $item['label'] }}</span>
                        </div>
                        @if(!empty($item['badge']))
                            <span class="notif-badge shrink-0 rounded-full bg-blue-600 px-2 py-0.5 text-[10px] font-bold text-white shadow-sm">{{ $item['badge'] }}</span>
                        @endif
                    </a>
                @endforeach
            @endforeach
        </nav>

        <div class="border-t border-slate-800/80 p-3">
            <div class="flex items-center justify-between gap-2 rounded-xl bg-slate-900/90 p-2">
                <a href="{{ route('profile.edit') }}" class="flex min-w-0 flex-1 items-center gap-2.5 rounded-lg p-1 transition hover:bg-slate-800" title="Pengaturan Akun & Keamanan">
                    @if($adminProfile?->profile_photo_url)
                        <img src="{{ $adminProfile->profile_photo_url }}" class="h-8 w-8 rounded-lg object-cover ring-1 ring-slate-700" alt="Profile">
                    @else
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-700 text-xs font-bold text-white">
                            {{ $adminProfile?->initials ?? 'AZ' }}
                        </div>
                    @endif
                    <div class="min-w-0">
                        <div class="truncate text-xs font-semibold text-white">{{ $adminProfile?->full_name ?? 'Nama Anda' }}</div>
                        <div class="truncate text-[10px] text-slate-400">{{ auth()->user()?->email ?? 'Admin' }}</div>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                    @csrf
                    <button type="submit" title="Logout" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 transition hover:bg-red-500/10 hover:text-red-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Mobile Top Header Bar -->
    <header class="sticky top-0 z-30 flex h-14 items-center justify-between border-b border-slate-200 bg-white/95 backdrop-blur px-3 sm:px-4 lg:hidden">
        <div class="flex items-center gap-2.5">
            <button id="mobile-sidebar-open" type="button" class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-100 hover:text-slate-950 active:scale-95 transition" aria-label="Buka navigasi menu">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>
            <div class="min-w-0">
                <div class="truncate text-sm font-bold text-slate-950 leading-tight">{{ $title }}</div>
                <div class="text-[10px] font-medium text-slate-400 leading-tight">Admin Panel</div>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <!-- Notification Bell (Mobile) -->
            <div class="relative" id="mobile-notif-container">
                <button id="mobile-notif-btn" type="button" class="relative flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 hover:text-slate-950 transition" aria-label="Pemberitahuan Pesan">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                    </svg>
                    @if($unreadContactCount > 0)
                        <span class="notif-badge absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[9px] font-bold text-white ring-2 ring-white animate-pulse">
                            {{ $unreadContactCount }}
                        </span>
                    @endif
                </button>

                <!-- Mobile Dropdown -->
                <div id="mobile-notif-dropdown" class="hidden absolute right-0 mt-2 w-72 max-w-[85vw] rounded-2xl border border-slate-200 bg-white shadow-xl z-50 overflow-hidden">
                    <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/80 px-4 py-2.5">
                        <span class="text-xs font-bold text-slate-900">Pesan Masuk</span>
                        <span class="notif-badge rounded-full bg-blue-100 px-2 py-0.5 text-[10px] font-bold text-blue-700">{{ $unreadContactCount }} Baru</span>
                    </div>
                    <div class="max-h-60 overflow-y-auto divide-y divide-slate-100 notif-list">
                        @forelse($recentUnreadContacts as $notif)
                            <a href="{{ route('admin.contacts.show', $notif->id) }}" class="block p-3 hover:bg-slate-50 transition">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-900 truncate">{{ $notif->name }}</span>
                                    <span class="text-[10px] text-slate-400">{{ $notif->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-[11px] font-medium text-slate-600 truncate mt-0.5">{{ $notif->subject }}</div>
                                @if($notif->phone)
                                    <div class="text-[10px] text-emerald-600 font-semibold mt-0.5">WA: {{ $notif->phone }}</div>
                                @endif
                            </a>
                        @empty
                            <div class="p-4 text-center text-xs text-slate-400">Tidak ada pesan baru</div>
                        @endforelse
                    </div>
                    <a href="{{ route('admin.contacts.index') }}" class="block border-t border-slate-100 bg-slate-50/50 py-2 text-center text-xs font-semibold text-blue-600 hover:text-blue-800">
                        Lihat Semua Pesan →
                    </a>
                </div>
            </div>

            <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-2 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-100 transition">
                @if($adminProfile?->profile_photo_url)
                    <img src="{{ $adminProfile->profile_photo_url }}" class="h-5 w-5 rounded-full object-cover" alt="Profile">
                @else
                    <div class="flex h-5 w-5 items-center justify-center rounded-full bg-slate-900 text-[9px] font-bold text-white">
                        {{ $adminProfile?->initials ?? 'AZ' }}
                    </div>
                @endif
                <span class="hidden sm:inline">Profil</span>
            </a>
            <a href="{{ route('home') }}" target="_blank" title="Lihat Website" class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-100 hover:text-slate-900 transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                </svg>
            </a>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="min-h-screen flex-1 lg:ml-64 flex flex-col">
        <!-- Desktop Header Bar -->
        <div class="hidden lg:block border-b border-slate-200 bg-white">
            <div class="mx-auto flex min-h-14 max-w-[1440px] items-center justify-between px-7 lg:px-9 py-2.5">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-medium text-slate-400">Admin Panel</span>
                    <span class="text-slate-300">/</span>
                    <span class="text-xs font-semibold text-slate-800">{{ $title }}</span>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Notification Bell (Desktop) -->
                    <div class="relative" id="desktop-notif-container">
                        <button id="desktop-notif-btn" type="button" class="relative flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-950 transition" aria-label="Pemberitahuan Pesan Baru">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                            </svg>
                            @if($unreadContactCount > 0)
                                <span class="notif-badge absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[9px] font-bold text-white ring-2 ring-white animate-pulse">
                                    {{ $unreadContactCount }}
                                </span>
                            @endif
                        </button>

                        <!-- Desktop Dropdown Panel -->
                        <div id="desktop-notif-dropdown" class="hidden absolute right-0 mt-2 w-80 rounded-2xl border border-slate-200 bg-white shadow-xl z-50 overflow-hidden">
                            <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/80 px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-slate-900">Pesan Masuk Terbaru</span>
                                    <span class="notif-badge rounded-full bg-blue-100 px-2 py-0.5 text-[10px] font-bold text-blue-700">{{ $unreadContactCount }} Baru</span>
                                </div>
                                <a href="{{ route('admin.contacts.index') }}" class="text-[11px] font-medium text-slate-500 hover:text-slate-800">Semua</a>
                            </div>
                            <div class="max-h-72 overflow-y-auto divide-y divide-slate-100 notif-list">
                                @forelse($recentUnreadContacts as $notif)
                                    <a href="{{ route('admin.contacts.show', $notif->id) }}" class="block p-3.5 hover:bg-slate-50 transition">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-bold text-slate-900 truncate">{{ $notif->name }}</span>
                                            <span class="text-[10px] text-slate-400">{{ $notif->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="text-xs font-medium text-slate-600 truncate mt-0.5">{{ $notif->subject }}</div>
                                        @if($notif->phone)
                                            <div class="text-[11px] text-emerald-600 font-semibold mt-0.5 flex items-center gap-1">
                                                <span>WA: {{ $notif->phone }}</span>
                                            </div>
                                        @endif
                                    </a>
                                @empty
                                    <div class="p-6 text-center text-xs text-slate-400">
                                        <svg class="mx-auto h-8 w-8 text-slate-300 mb-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                                        Semua pesan sudah dibaca
                                    </div>
                                @endforelse
                            </div>
                            <a href="{{ route('admin.contacts.index') }}" class="block border-t border-slate-100 bg-slate-50/60 py-2.5 text-center text-xs font-semibold text-blue-600 hover:text-blue-800 transition">
                                Buka Kotak Masuk Pesan →
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-slate-900 transition">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                        </svg>
                        Lihat Website
                    </a>
                    <span class="h-3.5 w-px bg-slate-200"></span>
                    <a href="{{ route('admin.profile.edit') }}" class="text-xs font-semibold text-slate-700 hover:text-slate-950 transition">
                        Kelola Profil
                    </a>
                    <span class="h-3.5 w-px bg-slate-200"></span>
                    <a href="{{ route('profile.edit') }}" class="text-xs font-semibold text-slate-700 hover:text-slate-950 transition">
                        Akun & Keamanan →
                    </a>
                </div>
            </div>
        </div>

        <!-- Page Main Body -->
        <div class="mx-auto w-full max-w-[1440px] flex-1 px-3.5 py-4 sm:px-6 sm:py-6 lg:px-9 lg:py-8">
            @if(session('success'))
                <div id="admin-flash-success" class="relative overflow-hidden mb-5 flex items-center justify-between gap-3 rounded-2xl border border-emerald-200 bg-emerald-50/95 p-4 text-xs sm:text-sm font-semibold text-emerald-900 shadow-sm transition-all duration-300" role="alert">
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-sm">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </span>
                        <span class="flex-1">{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="dismissFlashAlert('admin-flash-success')" class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg text-emerald-700/70 hover:bg-emerald-200/60 hover:text-emerald-950 transition" title="Tutup pemberitahuan">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <!-- Progress Bar Timer -->
                    <div id="flash-progress-bar" class="absolute bottom-0 left-0 h-1 bg-emerald-500/70 transition-all ease-linear" style="width: 100%;"></div>
                </div>
            @endif

            @if(session('error'))
                <div id="admin-flash-error" class="relative overflow-hidden mb-5 flex items-center justify-between gap-3 rounded-2xl border border-red-200 bg-red-50/95 p-4 text-xs sm:text-sm font-semibold text-red-900 shadow-sm transition-all duration-300" role="alert">
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-xl bg-red-600 text-white shadow-sm">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        </span>
                        <span class="flex-1">{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="dismissFlashAlert('admin-flash-error')" class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg text-red-700/70 hover:bg-red-200/60 hover:text-red-950 transition" title="Tutup pemberitahuan">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div id="admin-flash-validation-error" class="relative overflow-hidden mb-5 rounded-2xl border border-red-200 bg-red-50/95 p-4 text-xs sm:text-sm text-red-900 shadow-sm transition-all duration-300" role="alert">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="font-bold flex items-center gap-2">
                                <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-red-600 text-white text-[10px]">!</span>
                                Mohon periksa kembali input formulir:
                            </div>
                            <ul class="mt-2 list-disc pl-5 space-y-0.5 text-xs text-red-800">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" onclick="dismissFlashAlert('admin-flash-validation-error')" class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg text-red-700/70 hover:bg-red-200/60 hover:text-red-950 transition" title="Tutup pemberitahuan">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            @endif

            {{ $slot }}
        </div>
    </main>
</div>

        <!-- Real-Time Toast Container -->
        <div id="admin-toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2 pointer-events-none"></div>

        <!-- Custom Premium Delete Confirmation Modal -->
        <div id="deleteConfirmModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">
            <!-- Backdrop with Blur -->
            <div id="deleteModalBackdrop" class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm transition-opacity duration-300 opacity-0 cursor-pointer"></div>

            <!-- Modal Content Card -->
            <div id="deleteModalCard" class="relative w-full max-w-md transform overflow-hidden rounded-3xl bg-white p-6 sm:p-7 text-center shadow-2xl ring-1 ring-slate-900/10 transition-all duration-300 scale-95 opacity-0">
                <!-- Close (X) Icon Top Right -->
                <button type="button" id="deleteModalCloseXBtn" class="absolute top-4 right-4 flex h-8 w-8 items-center justify-center rounded-xl text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition" aria-label="Batal dan tutup modal">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <!-- Danger Icon with Glowing Rings -->
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-red-100 text-red-600 ring-8 ring-red-50/80 shadow-inner">
                    <svg class="h-8 w-8 stroke-[1.8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                    </svg>
                </div>

                <!-- Title -->
                <h3 id="deleteModalTitle" class="text-lg sm:text-xl font-bold tracking-tight text-slate-950">
                    Hapus Data Ini?
                </h3>

                <!-- Target Item Box -->
                <div class="mt-3.5 rounded-2xl border border-slate-200/80 bg-slate-50/90 px-4 py-3 text-left">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Target Item yang Dihapus:</p>
                    <p id="deleteModalItemName" class="mt-0.5 text-xs sm:text-sm font-bold text-slate-800 break-words line-clamp-2">
                        Data terpilih
                    </p>
                </div>

                <!-- Description Note -->
                <p class="mt-3.5 text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Tindakan ini bersifat <strong class="text-red-600 font-semibold">permanen</strong> dan tidak dapat dibatalkan. Berkas atau entri terkait akan dihapus dari server.
                </p>

                <!-- Actions -->
                <div class="mt-6 flex flex-col-reverse gap-2.5 sm:flex-row sm:gap-3">
                    <button type="button" id="deleteModalCancelBtn" class="flex-1 rounded-xl border border-slate-200 bg-white py-2.5 px-4 text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 hover:text-slate-900 active:scale-95 transition">
                        Batal
                    </button>
                    <button type="button" id="deleteModalConfirmBtn" class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 py-2.5 px-4 text-xs sm:text-sm font-semibold text-white shadow-lg shadow-red-500/25 hover:bg-red-700 active:scale-95 transition">
                        <svg id="deleteModalConfirmIcon" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                        </svg>
                        <span id="deleteModalConfirmText">Ya, Hapus Data</span>
                    </button>
                </div>
            </div>
        </div>

<script>
    let pendingDeleteForm = null;

    window.openDeleteModal = function (event, itemName) {
        if (event) {
            event.preventDefault();
            pendingDeleteForm = event.target.closest('form');
        }

        const modal = document.getElementById('deleteConfirmModal');
        const backdrop = document.getElementById('deleteModalBackdrop');
        const card = document.getElementById('deleteModalCard');
        const itemNameEl = document.getElementById('deleteModalItemName');
        const confirmBtn = document.getElementById('deleteModalConfirmBtn');
        const confirmText = document.getElementById('deleteModalConfirmText');
        const confirmIcon = document.getElementById('deleteModalConfirmIcon');

        if (!modal || !backdrop || !card) {
            if (pendingDeleteForm) pendingDeleteForm.submit();
            return false;
        }

        if (confirmBtn) confirmBtn.disabled = false;
        if (confirmText) confirmText.textContent = 'Ya, Hapus Data';
        if (confirmIcon) {
            confirmIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>';
            confirmIcon.classList.remove('animate-spin');
        }

        if (itemNameEl) {
            itemNameEl.textContent = itemName && itemName.trim() !== '' ? itemName : 'Item yang dipilih';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        requestAnimationFrame(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        });

        const cancelBtn = document.getElementById('deleteModalCancelBtn');
        if (cancelBtn) cancelBtn.focus();

        return false;
    };

    window.closeDeleteModal = function () {
        const modal = document.getElementById('deleteConfirmModal');
        const backdrop = document.getElementById('deleteModalBackdrop');
        const card = document.getElementById('deleteModalCard');

        if (!modal || !backdrop || !card) return;

        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            pendingDeleteForm = null;
        }, 200);
    };

    window.dismissFlashAlert = function (id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.style.transition = 'all 0.35s cubic-bezier(0.4, 0, 0.2, 1)';
        el.style.opacity = '0';
        el.style.transform = 'translateY(-8px) scale(0.98)';
        setTimeout(() => {
            el.style.maxHeight = '0px';
            el.style.paddingTop = '0px';
            el.style.paddingBottom = '0px';
            el.style.marginTop = '0px';
            el.style.marginBottom = '0px';
            el.style.borderWidth = '0px';
        }, 150);
        setTimeout(() => {
            el.remove();
        }, 500);
    };

    document.addEventListener('DOMContentLoaded', () => {
        // Auto-dismiss for success alert
        const successAlert = document.getElementById('admin-flash-success');
        const progressBar = document.getElementById('flash-progress-bar');
        if (successAlert) {
            if (progressBar) {
                progressBar.style.transition = 'width 4000ms linear';
                setTimeout(() => {
                    progressBar.style.width = '0%';
                }, 50);
            }

            let dismissTimeout = setTimeout(() => {
                dismissFlashAlert('admin-flash-success');
            }, 4000);

            successAlert.addEventListener('mouseenter', () => {
                clearTimeout(dismissTimeout);
                if (progressBar) {
                    progressBar.style.transition = 'none';
                    progressBar.style.width = '100%';
                }
            });

            successAlert.addEventListener('mouseleave', () => {
                if (progressBar) {
                    progressBar.style.transition = 'width 3000ms linear';
                    setTimeout(() => {
                        progressBar.style.width = '0%';
                    }, 50);
                }
                dismissTimeout = setTimeout(() => {
                    dismissFlashAlert('admin-flash-success');
                }, 3000);
            });
        }

        // Mobile drawer open/close
        const mobileBackdrop = document.getElementById('mobile-sidebar-backdrop');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const mobileOpenBtn = document.getElementById('mobile-sidebar-open');
        const mobileCloseBtn = document.getElementById('mobile-sidebar-close');

        const openMobileSidebar = () => {
            if (!mobileSidebar || !mobileBackdrop) return;
            mobileBackdrop.classList.remove('opacity-0', 'pointer-events-none');
            mobileBackdrop.classList.add('opacity-100', 'pointer-events-auto');
            mobileSidebar.classList.remove('-translate-x-full');
            mobileSidebar.classList.add('translate-x-0');
            document.body.classList.add('overflow-hidden');
        };

        const closeMobileSidebar = () => {
            if (!mobileSidebar || !mobileBackdrop) return;
            mobileBackdrop.classList.remove('opacity-100', 'pointer-events-auto');
            mobileBackdrop.classList.add('opacity-0', 'pointer-events-none');
            mobileSidebar.classList.remove('translate-x-0');
            mobileSidebar.classList.add('-translate-x-full');
            document.body.classList.remove('overflow-hidden');
        };

        if (mobileOpenBtn) mobileOpenBtn.addEventListener('click', openMobileSidebar);
        if (mobileCloseBtn) mobileCloseBtn.addEventListener('click', closeMobileSidebar);
        if (mobileBackdrop) mobileBackdrop.addEventListener('click', closeMobileSidebar);

        // Notification dropdown toggles
        const desktopNotifBtn = document.getElementById('desktop-notif-btn');
        const desktopNotifDropdown = document.getElementById('desktop-notif-dropdown');
        const mobileNotifBtn = document.getElementById('mobile-notif-btn');
        const mobileNotifDropdown = document.getElementById('mobile-notif-dropdown');

        function toggleDropdown(btn, dropdown) {
            if (!btn || !dropdown) return;
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
            });
        }
        toggleDropdown(desktopNotifBtn, desktopNotifDropdown);
        toggleDropdown(mobileNotifBtn, mobileNotifDropdown);

        document.addEventListener('click', () => {
            if (desktopNotifDropdown && !desktopNotifDropdown.classList.contains('hidden')) {
                desktopNotifDropdown.classList.add('hidden');
            }
            if (mobileNotifDropdown && !mobileNotifDropdown.classList.contains('hidden')) {
                mobileNotifDropdown.classList.add('hidden');
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeMobileSidebar();
                if (desktopNotifDropdown) desktopNotifDropdown.classList.add('hidden');
                if (mobileNotifDropdown) mobileNotifDropdown.classList.add('hidden');
            }
        });

        // ===============================================
        // Real-Time New Message Polling & Toast Alert
        // ===============================================
        let lastUnreadCount = {{ $unreadContactCount }};
        const toastContainer = document.getElementById('admin-toast-container');

        function playNotificationSound() {
            try {
                const ctx = new (window.AudioContext || window.webkitAudioContext)();
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.type = 'sine';
                osc.frequency.setValueAtTime(587.33, ctx.currentTime); // D5
                osc.frequency.setValueAtTime(880, ctx.currentTime + 0.12); // A5
                gain.gain.setValueAtTime(0.15, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.35);
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.start();
                osc.stop(ctx.currentTime + 0.35);
            } catch (e) {}
        }

        function showToast(name, phone, subject, url) {
            playNotificationSound();
            const toast = document.createElement('div');
            toast.className = 'pointer-events-auto flex items-start gap-3 rounded-2xl border border-blue-200 bg-white p-4 shadow-2xl transition-all duration-400 transform translate-y-4 opacity-0 max-w-sm';
            toast.innerHTML = `
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-white shadow-md">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-blue-700">Pesan Baru Masuk!</span>
                        <span class="text-[10px] text-slate-400">Baru saja</span>
                    </div>
                    <div class="text-xs font-bold text-slate-900 mt-0.5 truncate">${name}</div>
                    <div class="text-[11px] text-slate-600 truncate">${subject}</div>
                    ${phone && phone !== '-' ? `<div class="text-[10px] text-emerald-600 font-semibold mt-0.5">WA: ${phone}</div>` : ''}
                    <div class="mt-2 flex items-center gap-2">
                        <a href="${url}" class="rounded-lg bg-blue-600 px-2.5 py-1 text-[11px] font-bold text-white shadow-sm hover:bg-blue-700 transition">Buka Pesan</a>
                        <button type="button" class="toast-close text-[11px] text-slate-400 hover:text-slate-600">Tutup</button>
                    </div>
                </div>
            `;
            toastContainer.appendChild(toast);
            setTimeout(() => {
                toast.classList.remove('translate-y-4', 'opacity-0');
            }, 50);

            toast.querySelector('.toast-close').addEventListener('click', () => {
                toast.classList.add('translate-y-4', 'opacity-0');
                setTimeout(() => toast.remove(), 400);
            });

            setTimeout(() => {
                if (toast.parentElement) {
                    toast.classList.add('translate-y-4', 'opacity-0');
                    setTimeout(() => toast.remove(), 400);
                }
            }, 8000);
        }

        function checkNewMessages() {
            fetch('{{ route('admin.contacts.check-unread') }}')
                .then(r => r.json())
                .then(data => {
                    if (data && typeof data.unread_count === 'number') {
                        if (data.unread_count > lastUnreadCount && data.latest && data.latest.length > 0) {
                            const newest = data.latest[0];
                            showToast(newest.name, newest.phone, newest.subject, newest.url);
                        }
                        lastUnreadCount = data.unread_count;

                        // Update badges in UI
                        document.querySelectorAll('.notif-badge').forEach(badge => {
                            if (data.unread_count > 0) {
                                badge.textContent = data.unread_count;
                                badge.classList.remove('hidden');
                            } else {
                                badge.classList.add('hidden');
                            }
                        });
                    }
                })
                .catch(() => {});
        }

        // Poll every 15 seconds
        setInterval(checkNewMessages, 15000);

        // Delete Modal Event Listeners
        const cancelBtn = document.getElementById('deleteModalCancelBtn');
        const closeXBtn = document.getElementById('deleteModalCloseXBtn');
        const deleteBackdrop = document.getElementById('deleteModalBackdrop');
        const confirmBtn = document.getElementById('deleteModalConfirmBtn');

        if (cancelBtn) cancelBtn.addEventListener('click', closeDeleteModal);
        if (closeXBtn) closeXBtn.addEventListener('click', closeDeleteModal);
        if (deleteBackdrop) deleteBackdrop.addEventListener('click', closeDeleteModal);

        if (confirmBtn) {
            confirmBtn.addEventListener('click', () => {
                if (pendingDeleteForm) {
                    confirmBtn.disabled = true;
                    const confirmText = document.getElementById('deleteModalConfirmText');
                    const confirmIcon = document.getElementById('deleteModalConfirmIcon');
                    if (confirmText) confirmText.textContent = 'Menghapus...';
                    if (confirmIcon) {
                        confirmIcon.classList.add('animate-spin');
                        confirmIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>';
                    }
                    pendingDeleteForm.submit();
                }
            });
        }

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const modal = document.getElementById('deleteConfirmModal');
                if (modal && !modal.classList.contains('hidden')) {
                    closeDeleteModal();
                }
            }
        });
    });
</script>
<x-image-cropper-modal />
@stack('scripts')
</body>
</html>
