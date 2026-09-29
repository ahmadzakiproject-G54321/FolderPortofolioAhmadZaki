<x-admin-layout title="Pesan Masuk">
    <div class="mb-5 sm:mb-7 flex flex-col gap-3.5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs sm:text-sm font-semibold text-slate-400">Komunikasi & Klien</p>
            <h1 class="mt-0.5 sm:mt-1 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950">Pesan Masuk</h1>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">Kelola dan balas pesan atau penawaran kerja sama dari pengunjung web.</p>
        </div>
        @if($unreadCount > 0)
            <form action="{{ route('admin.contacts.mark-all-read') }}" method="POST" class="shrink-0">
                @csrf
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 hover:text-slate-950 transition">
                    <svg class="h-4 w-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    <!-- Quick Stat Cards -->
    <div class="mb-6 grid grid-cols-1 gap-3.5 sm:grid-cols-3 sm:gap-4">
        <a href="{{ route('admin.contacts.index', ['filter' => 'all']) }}" class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:border-slate-300 {{ $filter === 'all' ? 'ring-2 ring-slate-900/10' : '' }}">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-slate-500">Total Pesan</span>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                </span>
            </div>
            <div class="mt-2 text-2xl font-bold tracking-tight text-slate-950">{{ $totalCount }}</div>
        </a>

        <a href="{{ route('admin.contacts.index', ['filter' => 'unread']) }}" class="rounded-2xl border border-blue-200 bg-blue-50/50 p-4 shadow-sm transition hover:border-blue-300 {{ $filter === 'unread' ? 'ring-2 ring-blue-500/20' : '' }}">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-blue-700">Belum Dibaca</span>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-600 text-white">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                </span>
            </div>
            <div class="mt-2 text-2xl font-bold tracking-tight text-blue-900">{{ $unreadCount }}</div>
        </a>

        <a href="{{ route('admin.contacts.index', ['filter' => 'read']) }}" class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:border-slate-300 {{ $filter === 'read' ? 'ring-2 ring-slate-900/10' : '' }}">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-slate-500">Sudah Dibaca</span>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <div class="mt-2 text-2xl font-bold tracking-tight text-slate-950">{{ $readCount }}</div>
        </a>
    </div>

    <!-- Main Card -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <!-- Filter & Search Toolbar -->
        <div class="flex flex-col gap-3 border-b border-slate-200 p-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
            <!-- Filter Tabs -->
            <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0">
                <a href="{{ route('admin.contacts.index', ['filter' => 'all', 'q' => $search]) }}" class="rounded-lg px-3 py-1.5 text-xs font-semibold transition {{ $filter === 'all' ? 'bg-slate-950 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    Semua ({{ $totalCount }})
                </a>
                <a href="{{ route('admin.contacts.index', ['filter' => 'unread', 'q' => $search]) }}" class="rounded-lg px-3 py-1.5 text-xs font-semibold transition {{ $filter === 'unread' ? 'bg-blue-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    Belum Dibaca ({{ $unreadCount }})
                </a>
                <a href="{{ route('admin.contacts.index', ['filter' => 'read', 'q' => $search]) }}" class="rounded-lg px-3 py-1.5 text-xs font-semibold transition {{ $filter === 'read' ? 'bg-slate-950 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                    Sudah Dibaca ({{ $readCount }})
                </a>
            </div>

            <!-- Search Input Form -->
            <form method="GET" action="{{ route('admin.contacts.index') }}" class="flex items-center gap-2">
                <input type="hidden" name="filter" value="{{ $filter }}">
                <div class="relative w-full sm:w-64">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama, email, no telp..." class="w-full rounded-xl border border-slate-200 bg-slate-50 py-1.5 pl-8 pr-3 text-xs text-slate-800 placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:outline-none transition">
                    <svg class="absolute left-2.5 top-2 h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                </div>
                @if($search)
                    <a href="{{ route('admin.contacts.index', ['filter' => $filter]) }}" class="rounded-lg border border-slate-200 px-2 py-1.5 text-xs text-slate-500 hover:bg-slate-100 transition" title="Reset pencarian">
                        ✕
                    </a>
                @endif
                <button type="submit" class="rounded-xl bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-800 transition">
                    Cari
                </button>
            </form>
        </div>

        <!-- Scroll indicator for mobile -->
        <div class="flex items-center gap-1.5 border-b border-slate-100 bg-slate-50/80 px-4 py-2 text-[11px] text-slate-500 sm:hidden">
            <svg class="h-3.5 w-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            <span>Geser tabel ke kanan untuk melihat rincian kontak</span>
        </div>

        <!-- Messages Table -->
        <div class="w-full overflow-x-auto">
            <table class="w-full min-w-[760px] divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="w-20 px-4 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Status</th>
                        <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Nama Pemesan</th>
                        <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Kontak (Email & No. Telp)</th>
                        <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Subjek & Pesan</th>
                        <th class="w-32 px-4 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Waktu</th>
                        <th class="w-32 px-4 py-3 text-right text-[11px] font-bold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($contacts as $contact)
                    <tr class="transition hover:bg-slate-50/80 {{ !$contact->is_read ? 'bg-blue-50/20' : '' }}">
                        <!-- Status Badge -->
                        <td class="px-4 py-3.5">
                            @if(!$contact->is_read)
                                <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2 py-0.5 text-[10px] font-bold text-blue-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                                    Baru
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">
                                    Dibaca
                                </span>
                            @endif
                        </td>

                        <!-- Sender Name -->
                        <td class="px-4 py-3.5">
                            <div class="flex items-center gap-2.5">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full {{ !$contact->is_read ? 'bg-blue-600 text-white' : 'bg-slate-200 text-slate-700' }} text-xs font-bold">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs sm:text-sm font-bold text-slate-900 truncate">{{ $contact->name }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Contact (Email & Phone) -->
                        <td class="px-4 py-3.5">
                            <div class="space-y-0.5 text-xs">
                                <a href="mailto:{{ $contact->email }}" class="flex items-center gap-1 text-slate-600 hover:text-blue-600 transition truncate" title="Kirim Email">
                                    <svg class="h-3.5 w-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                                    <span>{{ $contact->email }}</span>
                                </a>

                                @if($contact->phone)
                                    <a href="https://wa.me/{{ $contact->clean_phone }}" target="_blank" class="inline-flex items-center gap-1 text-emerald-700 hover:text-emerald-800 font-medium transition" title="Chat via WhatsApp">
                                        <svg class="h-3.5 w-3.5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592z"/></svg>
                                        <span>{{ $contact->phone }}</span>
                                        <span class="rounded bg-emerald-100 px-1 py-0.2 text-[9px] font-bold text-emerald-800">WA</span>
                                    </a>
                                @else
                                    <span class="text-slate-400 text-[11px]">— No telp tidak ada —</span>
                                @endif
                            </div>
                        </td>

                        <!-- Subject & Snippet -->
                        <td class="max-w-xs px-4 py-3.5">
                            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="block group">
                                <div class="text-xs sm:text-sm font-semibold text-slate-900 group-hover:text-blue-600 transition truncate">
                                    {{ $contact->subject }}
                                </div>
                                <div class="text-xs text-slate-500 truncate mt-0.5">
                                    {{ \Illuminate\Support\Str::limit($contact->message, 60) }}
                                </div>
                            </a>
                        </td>

                        <!-- Timestamp -->
                        <td class="px-4 py-3.5 text-xs text-slate-500 whitespace-nowrap">
                            <div class="font-medium text-slate-700">{{ $contact->created_at->diffForHumans() }}</div>
                            <div class="text-[11px] text-slate-400">{{ $contact->created_at->format('d M Y, H:i') }}</div>
                        </td>

                        <!-- Actions -->
                        <td class="whitespace-nowrap px-4 py-3.5 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('admin.contacts.show', $contact->id) }}" class="rounded-lg border border-slate-200 bg-white px-2.5 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-100 hover:text-slate-950 transition" title="Lihat detail pesan">
                                    Detail
                                </a>

                                <form action="{{ route('admin.contacts.toggle-read', $contact->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="rounded-lg border border-slate-200 bg-white p-1 text-slate-500 hover:bg-slate-100 hover:text-slate-800 transition" title="{{ $contact->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">
                                        @if($contact->is_read)
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        @else
                                            <svg class="h-4 w-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                        @endif
                                    </button>
                                </form>

                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="inline" onsubmit="return openDeleteModal(event, 'Pesan dari {{ addslashes($contact->name) }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg border border-slate-200 bg-white p-1 text-slate-500 hover:bg-red-50 hover:text-red-600 transition" title="Hapus pesan">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                            </div>
                            <div class="mt-3 text-sm font-semibold text-slate-800">
                                @if($search)
                                    Tidak ditemukan pesan dengan kata kunci "{{ $search }}"
                                @elseif($filter === 'unread')
                                    Tidak ada pesan baru yang belum dibaca
                                @else
                                    Belum ada pesan masuk dari pengunjung web
                                @endif
                            </div>
                            <div class="mt-1 text-xs text-slate-500">
                                Pesan yang dikirim melalui formulir kontak frontend akan otomatis masuk ke sini.
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($contacts->hasPages())
            <div class="border-t border-slate-200 px-4 py-3 sm:px-6 sm:py-4">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
