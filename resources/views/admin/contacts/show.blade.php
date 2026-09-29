<x-admin-layout title="Detail Pesan - {{ $contact->name }}">
    <!-- Top Bar Navigation -->
    <div class="mb-5 sm:mb-7 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.contacts.index') }}" class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 shadow-sm hover:bg-slate-50 hover:text-slate-950 transition" title="Kembali ke Daftar Pesan">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-950">Detail Pesan</h1>
                    @if(!$contact->is_read)
                        <span class="rounded-full bg-blue-100 px-2 py-0.5 text-[10px] font-bold text-blue-700">Baru</span>
                    @else
                        <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">Sudah Dibaca</span>
                    @endif
                </div>
                <p class="text-xs text-slate-500">Diterima pada {{ $contact->created_at->isoFormat('dddd, D MMMM Y - HH:mm') }} ({{ $contact->created_at->diffForHumans() }})</p>
            </div>
        </div>

        <!-- Header Actions -->
        <div class="flex items-center gap-2">
            <form action="{{ route('admin.contacts.toggle-read', $contact->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition">
                    @if($contact->is_read)
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Tandai Belum Dibaca
                    @else
                        <svg class="h-4 w-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Tandai Sudah Dibaca
                    @endif
                </button>
            </form>

            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return openDeleteModal(event, 'Pesan dari {{ addslashes($contact->name) }}')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-1.5 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 shadow-sm hover:bg-red-100 transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Sender Information Card (Left Column) -->
        <div class="lg:col-span-1 space-y-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                <div class="flex items-center gap-3.5 border-b border-slate-100 pb-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 text-lg font-bold text-white shadow-md">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <h2 class="text-base font-bold text-slate-950 truncate">{{ $contact->name }}</h2>
                        <span class="text-xs text-slate-500">Pengirim Pesan Web</span>
                    </div>
                </div>

                <div class="mt-4 space-y-3.5 text-xs">
                    <!-- Email -->
                    <div>
                        <span class="block text-[11px] font-medium text-slate-400">ALAMAT EMAIL</span>
                        <a href="mailto:{{ $contact->email }}?subject=Re: {{ rawurlencode($contact->subject) }}" class="mt-0.5 inline-flex items-center gap-1.5 font-semibold text-blue-600 hover:text-blue-800 break-all">
                            <svg class="h-3.5 w-3.5 shrink-0 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                            {{ $contact->email }}
                        </a>
                    </div>

                    <!-- Phone / WhatsApp -->
                    <div>
                        <span class="block text-[11px] font-medium text-slate-400">NOMOR TELEPON / WHATSAPP</span>
                        @if($contact->phone)
                            <div class="mt-0.5 flex items-center justify-between">
                                <span class="font-semibold text-slate-800 text-sm">{{ $contact->phone }}</span>
                                <a href="https://wa.me/{{ $contact->clean_phone }}?text={{ rawurlencode('Halo ' . $contact->name . ', terima kasih telah menghubungi saya melalui website portofolio.') }}" target="_blank" class="inline-flex items-center gap-1 rounded-lg bg-emerald-600 px-2 py-1 text-[11px] font-bold text-white shadow-sm hover:bg-emerald-700 transition">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592z"/></svg>
                                    Chat WA
                                </a>
                            </div>
                        @else
                            <span class="mt-0.5 block text-slate-400 italic">Tidak dicantumkan oleh pengirim</span>
                        @endif
                    </div>

                    <!-- Date Received -->
                    <div>
                        <span class="block text-[11px] font-medium text-slate-400">TANGGAL MASUK</span>
                        <span class="mt-0.5 block font-semibold text-slate-700">{{ $contact->created_at->format('d F Y, H:i:s') }} WIB</span>
                    </div>
                </div>

                <!-- Quick Action Buttons -->
                <div class="mt-6 space-y-2 pt-4 border-t border-slate-100">
                    @if($contact->phone)
                        @php
                            $adminName = \App\Models\Profile::first()?->full_name ?? (auth()->user()->name ?? 'Admin');
                        @endphp
                        <a href="https://wa.me/{{ $contact->clean_phone }}?text={{ rawurlencode('Halo ' . $contact->name . ', saya ' . $adminName . '. Mengenai pesan Anda terkait ' . $contact->subject . '...') }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-emerald-700 transition">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592z"/></svg>
                            Balas via WhatsApp
                        </a>
                    @endif

                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ rawurlencode($contact->subject) }}" class="w-full inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 hover:text-slate-950 transition">
                        <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                        Balas via Email
                    </a>
                </div>
            </div>
        </div>

        <!-- Message Content Card (Right Column) -->
        <div class="lg:col-span-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-7 shadow-sm">
                <div class="border-b border-slate-100 pb-4">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">SUBJEK PESAN</span>
                    <h2 class="mt-1 text-lg sm:text-xl font-bold text-slate-950">{{ $contact->subject }}</h2>
                </div>

                <div class="mt-5">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">ISI PESAN</span>
                    <div class="mt-3 rounded-xl border border-slate-100 bg-slate-50/60 p-4 sm:p-6 text-sm text-slate-800 leading-relaxed whitespace-pre-line font-normal">
                        {!! nl2br(e($contact->message)) !!}
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-5 text-xs text-slate-400">
                    <div>
                        ID Pesan: <span class="font-mono text-slate-600">#{{ $contact->id }}</span>
                    </div>
                    <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-1 font-semibold text-slate-700 hover:text-slate-950 transition">
                        ← Kembali ke Daftar Pesan
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
