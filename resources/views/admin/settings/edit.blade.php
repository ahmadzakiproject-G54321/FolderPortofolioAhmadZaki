<x-admin-layout title="Pengaturan Website">
    <div class="mb-5 sm:mb-7">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-slate-500 transition hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
            </svg>
            Kembali ke Dashboard
        </a>
        <h1 class="mt-2 sm:mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950">Pengaturan Website</h1>
        <p class="mt-1 text-xs sm:text-sm text-slate-500">Sesuaikan nama situs, logo, favicon, warna tema utama, dan teks hak cipta footer.</p>
    </div>

    @if(!file_exists(public_path('storage')))
    <div class="mb-6 rounded-2xl border border-sky-200 bg-sky-50/80 p-4 sm:p-5 text-sky-950 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-start gap-3">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-sky-600 text-white shadow-sm mt-0.5">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </span>
            <div>
                <h3 class="text-sm font-bold text-sky-950">Mode Penyajian Storage Otomatis Aktif</h3>
                <p class="text-xs text-sky-800 mt-0.5">Karena hosting Rumahweb membatasi fitur <code>symlink/exec</code> di PHP, file icon dan upload Anda kini otomatis dilayani oleh rute internal Laravel (<code>/storage/*</code>). Icon dan gambar tetap tampil normal.</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.settings.link-storage') }}" class="shrink-0">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-sky-700 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-sky-800 transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                Sinkronkan Storage
            </button>
        </form>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf
        @method('PUT')

        <!-- Identitas Website -->
        <div class="border-b border-slate-200 p-4 sm:p-6 lg:p-8">
            <div class="flex items-center gap-3 mb-4">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                </span>
                <div>
                    <h2 class="text-base font-bold text-slate-950">Identitas Utama Website</h2>
                    <p class="text-xs text-slate-500">Pengaturan nama website dan judul tab browser pengunjung.</p>
                </div>
            </div>

            <div class="max-w-xl">
                <label for="site_name" class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Nama Website / Title Tab *</label>
                <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $setting->site_name) }}" placeholder="Contoh: Portofolio Ahmad Zaki" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100" required>
                @error('site_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-[11px] text-slate-500">Nama ini akan menjadi judul utama pada tab peramban (browser) dan identitas portal portofolio.</p>
            </div>
        </div>

        <!-- Logo & Favicon -->
        <div class="border-b border-slate-200 p-4 sm:p-6 lg:p-8">
            <div class="flex items-center gap-3 mb-6">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                </span>
                <div>
                    <h2 class="text-base font-bold text-slate-950">Aset Visual (Logo &amp; Icon Tab)</h2>
                    <p class="text-xs text-slate-500">Unggah logo website, icon tab untuk pengunjung (frontend), dan icon tab khusus panel admin.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Logo Uploader -->
                <div class="rounded-2xl border border-slate-200 bg-slate-50/60 p-4 sm:p-5 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs sm:text-sm font-semibold text-slate-800">Logo Website (Navbar)</label>
                            <span class="inline-flex items-center gap-1 rounded bg-indigo-50 px-2 py-0.5 text-[10px] font-semibold text-indigo-700 border border-indigo-200">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5"/></svg>
                                Crop Bebas / Presisi
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-500 mb-3">Format PNG transparan atau SVG. Tampil di navbar depan.</p>

                        <div class="flex items-center gap-4 mb-4">
                            <div class="h-16 w-16 shrink-0 rounded-xl border border-slate-200 bg-white flex items-center justify-center p-2 shadow-sm overflow-hidden">
                                <img id="logoPreview" src="{{ $setting->logo_url ?: asset('assets/profile.png') }}" class="max-h-full max-w-full object-contain {{ $setting->logo ? '' : 'opacity-40' }}" alt="Pratinjau Logo">
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="block text-xs font-semibold text-slate-700">Status:</span>
                                <span class="text-xs {{ $setting->logo ? 'text-emerald-600 font-medium' : 'text-slate-400' }}">
                                    {{ $setting->logo ? '✓ Logo aktif' : '— Inisial nama' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <input type="file" id="logoInput" name="logo" accept="image/*" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-xs sm:text-sm text-slate-700 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-xs file:font-semibold hover:file:bg-slate-200">
                        @error('logo') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

                        @if($setting->logo)
                            <label class="mt-3 flex items-center gap-2 text-xs text-red-600 font-medium cursor-pointer">
                                <input type="checkbox" name="remove_logo" value="1" class="h-4 w-4 rounded border-slate-300 text-red-600 focus:ring-red-400">
                                Hapus logo kustom
                            </label>
                        @endif
                    </div>
                </div>

                <!-- Favicon Frontend Uploader -->
                <div class="rounded-2xl border border-slate-200 bg-slate-50/60 p-4 sm:p-5 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs sm:text-sm font-semibold text-slate-800">Icon Tab Frontend</label>
                            <span class="inline-flex items-center gap-1 rounded bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-700 border border-blue-200">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5"/></svg>
                                Auto Crop (1:1)
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-500 mb-3">Tampil di tab browser pengunjung website (.ico, .png, .svg).</p>

                        <div class="flex items-center gap-4 mb-4">
                            <div class="h-16 w-16 shrink-0 rounded-xl border border-slate-200 bg-white flex items-center justify-center p-2 shadow-sm overflow-hidden">
                                <img id="faviconPreview" src="{{ $setting->favicon_url }}" class="h-8 w-8 object-contain" alt="Pratinjau Favicon">
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="block text-xs font-semibold text-slate-700">Status:</span>
                                @php
                                    $hasCustomFavicon = !empty($setting->favicon) && (file_exists(public_path('storage/' . $setting->favicon)) || file_exists(public_path($setting->favicon)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($setting->favicon));
                                @endphp
                                <span class="text-xs {{ $hasCustomFavicon ? 'text-emerald-600 font-medium' : 'text-slate-400' }}">
                                    {{ $hasCustomFavicon ? '✓ Favicon kustom aktif' : '— Default icon website' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <input type="file" id="faviconInput" name="favicon" accept=".ico,.png,.svg,.jpg,.jpeg,image/*" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-xs sm:text-sm text-slate-700 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-xs file:font-semibold hover:file:bg-slate-200">
                        @error('favicon') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

                        @if(!empty($setting->favicon))
                            <label class="mt-3 flex items-center gap-2 text-xs text-red-600 font-medium cursor-pointer">
                                <input type="checkbox" name="remove_favicon" value="1" class="h-4 w-4 rounded border-slate-300 text-red-600 focus:ring-red-400">
                                Reset ke default website
                            </label>
                        @endif
                    </div>
                </div>

                <!-- Admin Favicon Uploader -->
                <div class="rounded-2xl border border-slate-200 bg-slate-50/60 p-4 sm:p-5 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs sm:text-sm font-semibold text-slate-800">Icon Tab Admin</label>
                            <span class="inline-flex items-center gap-1 rounded bg-purple-50 px-2 py-0.5 text-[10px] font-semibold text-purple-700 border border-purple-200">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5"/></svg>
                                Auto Crop (1:1)
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-500 mb-3">Tampil di tab browser dashboard admin &amp; portal login.</p>

                        <div class="flex items-center gap-4 mb-4">
                            <div class="h-16 w-16 shrink-0 rounded-xl border border-slate-200 bg-white flex items-center justify-center p-2 shadow-sm overflow-hidden">
                                <img id="adminFaviconPreview" src="{{ $setting->admin_favicon_url }}" class="h-8 w-8 object-contain" alt="Pratinjau Icon Tab Admin">
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="block text-xs font-semibold text-slate-700">Status:</span>
                                @php
                                    $hasCustomAdminFavicon = !empty($setting->admin_favicon) && (file_exists(public_path('storage/' . $setting->admin_favicon)) || file_exists(public_path($setting->admin_favicon)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($setting->admin_favicon));
                                @endphp
                                <span class="text-xs {{ $hasCustomAdminFavicon ? 'text-emerald-600 font-medium' : 'text-slate-400' }}">
                                    {{ $hasCustomAdminFavicon ? '✓ Icon admin kustom aktif' : '— Default icon admin' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <input type="file" id="adminFaviconInput" name="admin_favicon" accept=".ico,.png,.svg,.jpg,.jpeg,image/*" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-xs sm:text-sm text-slate-700 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-xs file:font-semibold hover:file:bg-slate-200">
                        @error('admin_favicon') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

                        @if(!empty($setting->admin_favicon))
                            <label class="mt-3 flex items-center gap-2 text-xs text-red-600 font-medium cursor-pointer">
                                <input type="checkbox" name="remove_admin_favicon" value="1" class="h-4 w-4 rounded border-slate-300 text-red-600 focus:ring-red-400">
                                Reset ke default admin
                            </label>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Palet Warna Tema Website -->
        <div class="border-b border-slate-200 p-4 sm:p-6 lg:p-8">
            <div class="flex items-center gap-3 mb-6">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-amber-500 text-white shadow-sm">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z"/></svg>
                </span>
                <div>
                    <h2 class="text-base font-bold text-slate-950">Warna Tema Brand Website</h2>
                    <p class="text-xs text-slate-500">Atur warna aksen utama tombol, gradient, dan navigasi website secara instan.</p>
                </div>
            </div>

            <!-- Quick Theme Presets -->
            <div class="mb-5 rounded-2xl border border-slate-200 bg-slate-50/80 p-4">
                <span class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2.5">Pilih Preset Tema Populer:</span>
                <div class="flex flex-wrap gap-2">
                    <button type="button" onclick="setThemeColors('#2563EB', '#1E293B')" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm hover:border-blue-400 hover:bg-blue-50/50 transition">
                        <span class="h-3.5 w-3.5 rounded-full" style="background: #2563EB;"></span>
                        Modern Blue (Default)
                    </button>
                    <button type="button" onclick="setThemeColors('#059669', '#064E3B')" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm hover:border-emerald-400 hover:bg-emerald-50/50 transition">
                        <span class="h-3.5 w-3.5 rounded-full" style="background: #059669;"></span>
                        Emerald Green
                    </button>
                    <button type="button" onclick="setThemeColors('#4F46E5', '#1E1B4B')" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm hover:border-indigo-400 hover:bg-indigo-50/50 transition">
                        <span class="h-3.5 w-3.5 rounded-full" style="background: #4F46E5;"></span>
                        Indigo Tech
                    </button>
                    <button type="button" onclick="setThemeColors('#7C3AED', '#2E1065')" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm hover:border-purple-400 hover:bg-purple-50/50 transition">
                        <span class="h-3.5 w-3.5 rounded-full" style="background: #7C3AED;"></span>
                        Royal Purple
                    </button>
                    <button type="button" onclick="setThemeColors('#E11D48', '#1C1917')" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm hover:border-rose-400 hover:bg-rose-50/50 transition">
                        <span class="h-3.5 w-3.5 rounded-full" style="background: #E11D48;"></span>
                        Crimson Rose
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 max-w-2xl">
                <!-- Primary Color -->
                <div>
                    <label for="primary_color" class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Warna Primer (Tombol, Aksen, Badge)</label>
                    <div class="flex items-center gap-2.5">
                        <input type="color" id="primaryColorPicker" value="{{ old('primary_color', $setting->primary_color ?: '#2563EB') }}" class="h-10 w-12 cursor-pointer rounded-xl border border-slate-300 bg-white p-1">
                        <input type="text" id="primaryColorText" name="primary_color" value="{{ old('primary_color', $setting->primary_color ?: '#2563EB') }}" placeholder="#2563EB" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-xs sm:text-sm font-mono text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                    </div>
                    @error('primary_color') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Secondary Color -->
                <div>
                    <label for="secondary_color" class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Warna Sekunder (Teks Gelap / Background)</label>
                    <div class="flex items-center gap-2.5">
                        <input type="color" id="secondaryColorPicker" value="{{ old('secondary_color', $setting->secondary_color ?: '#1E293B') }}" class="h-10 w-12 cursor-pointer rounded-xl border border-slate-300 bg-white p-1">
                        <input type="text" id="secondaryColorText" name="secondary_color" value="{{ old('secondary_color', $setting->secondary_color ?: '#1E293B') }}" placeholder="#1E293B" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-xs sm:text-sm font-mono text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                    </div>
                    @error('secondary_color') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Live Button Preview -->
            <div class="mt-5 rounded-2xl border border-slate-200 bg-slate-50/80 p-4 max-w-xl">
                <span class="block text-xs font-semibold text-slate-600 mb-2.5">Pratinjau Tombol Aksen di Website:</span>
                <div class="flex items-center gap-3">
                    <button type="button" id="liveBtnPreview" class="rounded-xl px-5 py-2.5 text-xs font-bold text-white shadow-sm transition" style="background: {{ $setting->primary_color ?: '#2563EB' }};">
                        Hubungi Saya
                    </button>
                    <div id="liveBadgePreview" class="rounded-full px-3 py-1 text-xs font-bold text-white shadow-xs" style="background: {{ $setting->primary_color ?: '#2563EB' }};">
                        ★ Unggulan
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Text -->
        <div class="p-4 sm:p-6 lg:p-8">
            <div class="flex items-center gap-3 mb-4">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-800 text-white shadow-sm">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </span>
                <div>
                    <h2 class="text-base font-bold text-slate-950">Teks Hak Cipta Footer</h2>
                    <p class="text-xs text-slate-500">Teks copyright yang tampil di bagian paling bawah website.</p>
                </div>
            </div>

            <div class="max-w-xl">
                <label for="footer_text" class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Teks Footer / Copyright</label>
                <input type="text" id="footer_text" name="footer_text" value="{{ old('footer_text', $setting->footer_text) }}" placeholder="Contoh: © {{ date('Y') }} Ahmad Zaki. Seluruh hak cipta dilindungi." class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                @error('footer_text') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col-reverse gap-2.5 border-t border-slate-200 bg-slate-50 px-4 py-4 sm:flex-row sm:justify-end sm:px-6 sm:py-5 lg:px-8">
            <a href="{{ route('admin.dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-center text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                Batal
            </a>
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-950 px-6 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                Simpan Pengaturan
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Logo, Favicon, dan Admin Favicon kini ditangani otomatis oleh image-cropper-modal
            // dengan pratinjau instan saat crop diterapkan.

            // Color Sync & Live Preview
            const primaryPicker = document.getElementById('primaryColorPicker');
            const primaryText = document.getElementById('primaryColorText');
            const secondaryPicker = document.getElementById('secondaryColorPicker');
            const secondaryText = document.getElementById('secondaryColorText');
            const liveBtnPreview = document.getElementById('liveBtnPreview');
            const liveBadgePreview = document.getElementById('liveBadgePreview');

            function syncColors() {
                const color = primaryText.value;
                if (liveBtnPreview) liveBtnPreview.style.background = color;
                if (liveBadgePreview) liveBadgePreview.style.background = color;
            }

            if (primaryPicker && primaryText) {
                primaryPicker.addEventListener('input', function () {
                    primaryText.value = this.value.toUpperCase();
                    syncColors();
                });
                primaryText.addEventListener('input', function () {
                    if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
                        primaryPicker.value = this.value;
                    }
                    syncColors();
                });
            }

            if (secondaryPicker && secondaryText) {
                secondaryPicker.addEventListener('input', function () {
                    secondaryText.value = this.value.toUpperCase();
                });
                secondaryText.addEventListener('input', function () {
                    if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
                        secondaryPicker.value = this.value;
                    }
                });
            }

            window.setThemeColors = function (primary, secondary) {
                if (primaryPicker) primaryPicker.value = primary;
                if (primaryText) primaryText.value = primary;
                if (secondaryPicker) secondaryPicker.value = secondary;
                if (secondaryText) secondaryText.value = secondary;
                syncColors();
            };
        });
    </script>
</x-admin-layout>
