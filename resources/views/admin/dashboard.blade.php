<x-admin-layout title="Dashboard">
    <div class="mb-6 flex flex-col justify-between gap-3.5 sm:mb-8 sm:flex-row sm:items-end">
        <div>
            <p class="text-xs sm:text-sm font-semibold text-slate-400">Overview</p>
            <h1 class="mt-0.5 sm:mt-1 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950">Dashboard</h1>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">Kelola seluruh konten portfolio Anda dari satu tempat.</p>
        </div>
        <a href="{{ route('admin.profile.edit') }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-950 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
            Edit Profil
        </a>
    </div>

    @if(($unreadCount ?? 0) > 0)
        <div class="mb-6 flex flex-col gap-3 rounded-2xl border border-blue-200 bg-gradient-to-r from-blue-50 to-indigo-50/80 p-4 sm:flex-row sm:items-center sm:justify-between sm:p-5 shadow-sm">
            <div class="flex items-center gap-3.5">
                <div class="relative flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                    <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[9px] font-bold text-white ring-2 ring-white">
                        {{ $unreadCount }}
                    </span>
                </div>
                <div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900">Pemberitahuan: Ada {{ $unreadCount }} Pesan Baru Masuk!</h3>
                    <p class="text-xs text-slate-600">Pengunjung/calon klien mengirimkan pesan melalui form website yang belum Anda baca.</p>
                </div>
            </div>
            <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-blue-600 px-4 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-blue-700 transition shrink-0">
                Buka Pesan Masuk
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-3.5 sm:grid-cols-2 sm:gap-4 xl:grid-cols-3">
        @foreach($stats as $stat)
            @if($stat['route'])
                <a href="{{ $stat['resource'] ? route($stat['route'], $stat['resource']) : route($stat['route']) }}" class="group rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-md">
            @else
                <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-sm">
            @endif
                <div class="flex items-center justify-between">
                    <span class="text-xs sm:text-sm font-medium text-slate-500">{{ $stat['label'] }}</span>
                    <span class="rounded-lg bg-slate-100 px-2 py-0.5 sm:py-1 text-[11px] sm:text-xs font-semibold text-slate-600">Manage</span>
                </div>
                <div class="mt-4 sm:mt-5 flex items-end justify-between">
                    <div class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-950">{{ $stat['count'] }}</div>
                    @if($stat['route'])
                        <span class="text-xs sm:text-sm font-semibold text-slate-400 transition group-hover:text-slate-700">View →</span>
                    @endif
                </div>
            @if($stat['route'])
                </a>
            @else
                </div>
            @endif
        @endforeach
    </div>

    <!-- Section Pesan Masuk Terbaru -->
    <div class="mt-6 sm:mt-8 rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between border-b border-slate-200 px-4 py-3 sm:px-6 sm:py-4">
            <div>
                <h2 class="text-base sm:text-lg font-bold text-slate-950">Pesan Masuk Terbaru</h2>
                <p class="text-xs text-slate-500">Pesan dan pertanyaan terbaru yang dikirim oleh pengunjung melalui formulir kontak.</p>
            </div>
            <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-1 text-xs sm:text-sm font-semibold text-blue-600 hover:text-blue-800 transition">
                Lihat Semua Pesan ({{ $totalMessages ?? 0 }}) →
            </a>
        </div>

        @if(!empty($recentMessages) && $recentMessages->count() > 0)
            <div class="divide-y divide-slate-100">
                @foreach($recentMessages as $msg)
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 sm:px-6 transition hover:bg-slate-50/80 {{ !$msg->is_read ? 'bg-blue-50/40' : '' }}">
                        <div class="flex items-start gap-3 min-w-0">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full {{ !$msg->is_read ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-600' }} text-xs font-bold">
                                {{ strtoupper(substr($msg->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs sm:text-sm font-bold text-slate-900 truncate">{{ $msg->name }}</span>
                                    @if(!$msg->is_read)
                                        <span class="rounded-full bg-blue-100 px-2 py-0.5 text-[10px] font-bold text-blue-700">Baru</span>
                                    @endif
                                </div>
                                <div class="text-xs font-medium text-slate-700 truncate mt-0.5">{{ $msg->subject }}</div>
                                <div class="text-[11px] text-slate-500 truncate mt-0.5">{{ Str::limit($msg->message, 80) }}</div>
                                @if($msg->phone)
                                    <div class="text-[11px] text-emerald-600 font-medium mt-0.5">WA/Telp: {{ $msg->phone }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-3 shrink-0 sm:self-center">
                            <span class="text-[11px] text-slate-400">{{ $msg->created_at->diffForHumans() }}</span>
                            <a href="{{ route('admin.contacts.show', $msg->id) }}" class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-100 transition">
                                Baca Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-8 text-center">
                <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                </div>
                <p class="mt-2 text-xs sm:text-sm font-semibold text-slate-700">Belum ada pesan masuk</p>
                <p class="mt-0.5 text-xs text-slate-500">Pesan dari formulir kontak website Anda akan tampil di sini.</p>
            </div>
        @endif
    </div>
</x-admin-layout>
