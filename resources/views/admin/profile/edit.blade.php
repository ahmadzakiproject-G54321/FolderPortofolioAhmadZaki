<x-admin-layout title="Edit Profil Admin">
    <div class="mb-5 sm:mb-7">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-slate-500 transition hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
            </svg>
            Kembali ke Dashboard
        </a>
        <h1 class="mt-2 sm:mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950">Edit Profil Admin</h1>
        <p class="mt-1 text-xs sm:text-sm text-slate-500">Ubah nama, foto profil, identitas, dan informasi kontak yang tampil di website.</p>
    </div>

    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf
        @method('PUT')

        <div class="border-b border-slate-200 p-4 sm:p-6 lg:p-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:gap-6">
                <div class="relative shrink-0">
                    <img id="profilePhotoPreview" src="{{ $profile->profile_photo_url }}" class="h-20 w-20 sm:h-28 sm:w-28 rounded-2xl object-cover ring-2 ring-slate-200 shadow-sm" alt="Foto Profil">
                </div>
                <div class="min-w-0 flex-1">
                    <h2 class="text-sm sm:text-base font-bold text-slate-950">Foto &amp; Identitas Utama</h2>
                    <p class="mt-0.5 text-xs sm:text-sm text-slate-500">Foto profil ini tersimpan di database dan otomatis ditampilkan di halaman utama website dan sidebar admin.</p>
                    <div class="mt-3">
                        <div class="flex items-center justify-between mb-1.5 max-w-lg">
                            <label class="block text-xs font-semibold text-slate-700">Ganti Foto Profil</label>
                            <span class="inline-flex items-center gap-1 rounded-md bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-700 border border-blue-200">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5"/></svg>
                                Auto Crop (1:1)
                            </span>
                        </div>
                        <input type="file" id="profilePhotoInput" name="profile_photo" accept="image/*" class="w-full max-w-lg rounded-xl border border-slate-300 bg-white px-3 py-2 text-xs sm:text-sm text-slate-700 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-xs file:font-semibold hover:file:bg-slate-200">
                        <p class="mt-1 text-[11px] text-slate-500">Pilih foto baru untuk membuka jendela crop persegi (1:1). Klik "Simpan Profil" untuk menyimpannya ke database.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 p-4 sm:grid-cols-2 sm:gap-6 sm:p-6 lg:p-8">
            @foreach([
                ['full_name', 'Nama Lengkap', 'text', 'Ahmad Zaki', ''],
                ['profession', 'Profesi', 'text', 'Backend Web Developer | Laravel & PHP Specialist', 'Terhubung langsung sebagai judul profesi utama di Hero Section, Tentang Saya, Kontak, dan judul website.'],
                ['email', 'Email', 'email', 'contoh@email.com', ''],
                ['phone', 'Nomor Telepon', 'text', '0812xxxxxxxx', ''],
                ['whatsapp', 'WhatsApp', 'text', '0812xxxxxxxx', ''],
                ['github', 'GitHub URL', 'url', 'https://github.com/...', ''],
                ['linkedin', 'LinkedIn URL', 'url', 'https://linkedin.com/in/...', ''],
                ['instagram', 'Instagram URL', 'url', 'https://instagram.com/...', '']
            ] as [$name, $label, $type, $placeholder, $hint])
                <div>
                    <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">{{ $label }}</label>
                    <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $profile->{$name}) }}" placeholder="{{ $placeholder }}" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                    @if(!empty($hint))
                        <p class="mt-1 text-[11px] text-slate-500">{{ $hint }}</p>
                    @endif
                </div>
            @endforeach

            <!-- Alamat & Google Maps Section -->
            <div class="sm:col-span-2 rounded-2xl border border-slate-200 bg-slate-50/70 p-4 sm:p-5">
                <div class="flex items-center gap-2.5 mb-3">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                    </span>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900">Alamat &amp; Integrasi Google Maps</h3>
                        <p class="text-xs text-slate-500">Peta pada bagian Kontak website akan otomatis aktif dan interaktif sesuai alamat atau embed di bawah ini.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Alamat Lengkap *</label>
                        <input type="text" id="adminAddressInput" name="address" value="{{ old('address', $profile->address) }}" placeholder="Contoh: Pesisir Selatan, Sumatera Barat" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                        <p class="mt-1 text-[11px] text-slate-500">Cukup ketik nama kota/daerah untuk menggunakan peta otomatis.</p>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Link Kustom / Embed Google Maps (Opsional)</label>
                        <input type="text" id="adminMapsEmbedInput" name="maps_embed" value="{{ old('maps_embed', $profile->maps_embed) }}" placeholder="https://maps.google.com/... atau kode &lt;iframe&gt;" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                        <p class="mt-1 text-[11px] text-slate-500">Biarkan kosong jika ingin peta otomatis mengikuti Alamat di sebelah kiri.</p>
                    </div>
                </div>

                <!-- Live Map Preview -->
                <div class="mt-4">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="block text-xs font-semibold text-slate-700">Pratinjau Peta Interaktif di Website:</span>
                        <a id="adminOpenMapsLink" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($profile->address ?: 'Pesisir Selatan, Sumatera Barat') }}" target="_blank" class="text-xs font-medium text-blue-600 hover:text-blue-800">
                            Buka di Google Maps ↗
                        </a>
                    </div>
                    <div class="w-full h-56 sm:h-64 rounded-xl overflow-hidden border border-slate-300 bg-slate-100 shadow-sm">
                        <iframe id="adminMapsPreviewFrame" src="{{ $profile->maps_iframe_url }}" width="100%" height="100%" style="border:0;" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <div class="sm:col-span-2">
                <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Deskripsi Singkat</label>
                <textarea name="short_description" rows="3" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm outline-none focus:border-slate-500 focus:ring-4 focus:ring-slate-100">{{ old('short_description', $profile->short_description) }}</textarea>
            </div>

            <div class="sm:col-span-2">
                <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Biografi Singkat</label>
                <textarea name="about" rows="5" placeholder="Tuliskan latar belakang pendidikan, keahlian, dan ringkasan profil Anda..." class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm outline-none focus:border-slate-500 focus:ring-4 focus:ring-slate-100">{{ old('about', $profile->about) }}</textarea>
            </div>

            <div class="sm:col-span-2">
                <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Tujuan Karir</label>
                <textarea name="career_objective" rows="4" placeholder="Tuliskan visi karir, aspirasi, atau kontribusi profesional yang ingin Anda capai..." class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm outline-none focus:border-slate-500 focus:ring-4 focus:ring-slate-100">{{ old('career_objective', $profile->career_objective) }}</textarea>
            </div>

            <!-- Penguasaan Bahasa Section -->
            <div class="sm:col-span-2 rounded-2xl border border-slate-200 bg-slate-50/70 p-4 sm:p-5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div class="flex items-center gap-2.5">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896 3.025 2.146 5.86 3.666 8.396"/></svg>
                        </span>
                        <div>
                            <h3 class="text-sm sm:text-base font-bold text-slate-900">Penguasaan Bahasa (Tampil di Bagian 'Tentang Saya')</h3>
                            <p class="text-xs text-slate-500">Kelola daftar bahasa dan tingkat kemahiran (0–100%) yang ditampilkan pada kartu Penguasaan Bahasa di website.</p>
                        </div>
                    </div>
                    <button type="button" id="btnAddLanguage" class="inline-flex items-center gap-1.5 self-start sm:self-auto rounded-xl bg-white border border-slate-300 px-3.5 py-2 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-100 hover:text-slate-900 transition">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Tambah Bahasa
                    </button>
                </div>

                <div id="languagesContainer" class="space-y-3">
                    @php
                        $languages = old('languages', $profile->languages_list ?? []);
                    @endphp
                    @forelse($languages as $index => $lang)
                        <div class="language-row flex flex-col sm:flex-row items-stretch sm:items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 shadow-sm transition hover:border-slate-300">
                            <div class="flex-1">
                                <label class="block text-[11px] font-semibold text-slate-500 mb-1 sm:hidden">Nama Bahasa &amp; Keterangan</label>
                                <input type="text" name="languages[{{ $index }}][name]" value="{{ $lang['name'] ?? '' }}" placeholder="Contoh: Bahasa Indonesia (Fasih) atau English (Fluent)" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-xs sm:text-sm text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100" required>
                            </div>
                            <div class="w-full sm:w-44 flex items-center gap-2">
                                <label class="block text-[11px] font-semibold text-slate-500 sm:hidden">Tingkat:</label>
                                <div class="relative flex-1">
                                    <input type="number" name="languages[{{ $index }}][percentage]" value="{{ $lang['percentage'] ?? 100 }}" min="0" max="100" placeholder="100" class="w-full rounded-lg border border-slate-300 px-3 py-2 pr-8 text-xs sm:text-sm text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100" required>
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-slate-400 pointer-events-none">%</span>
                                </div>
                            </div>
                            <button type="button" onclick="removeLanguageRow(this)" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition self-end sm:self-center" title="Hapus bahasa ini">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                            </button>
                        </div>
                    @empty
                        <div id="languagesEmptyNotice" class="text-center py-6 text-xs text-slate-500 border border-dashed border-slate-300 rounded-xl bg-white/60">
                            Belum ada bahasa yang ditambahkan. Klik tombol "+ Tambah Bahasa" di atas untuk menambahkan.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="sm:col-span-2">
                <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">CV / Resume (PDF)</label>
                <input type="file" name="resume_file" accept="application/pdf" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-xs sm:text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-xs file:font-semibold">
                @if($profile->resume_file)
                    <p class="mt-1.5 text-xs text-slate-500">
                        Resume saat ini: 
                        <a href="{{ route('cv.download') }}" target="_blank" class="inline-flex items-center gap-1 font-semibold text-blue-600 hover:text-blue-800 underline">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                            {{ basename($profile->resume_file) }}
                        </a>
                    </p>
                @endif
            </div>
        </div>

        <div class="flex flex-col-reverse gap-2.5 border-t border-slate-200 bg-slate-50 px-4 py-4 sm:flex-row sm:justify-end sm:px-6 sm:py-5 lg:px-8">
            <a href="{{ route('admin.dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-center text-xs sm:text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100 hover:text-slate-900">
                Kembali ke Dashboard
            </a>
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-950 px-6 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                Simpan Profil
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addressInput = document.getElementById('adminAddressInput');
            const mapsEmbedInput = document.getElementById('adminMapsEmbedInput');
            const previewFrame = document.getElementById('adminMapsPreviewFrame');
            const openMapsLink = document.getElementById('adminOpenMapsLink');

            let timer = null;

            function updatePreview() {
                const embedVal = mapsEmbedInput.value.trim();
                const addressVal = addressInput.value.trim() || 'Pesisir Selatan, Sumatera Barat';

                let url = '';
                if (embedVal) {
                    const match = embedVal.match(/src="([^"]+)"/);
                    if (match && match[1]) {
                        url = match[1];
                    } else if (embedVal.startsWith('http://') || embedVal.startsWith('https://')) {
                        url = embedVal;
                    }
                }

                if (!url) {
                    url = 'https://maps.google.com/maps?q=' + encodeURIComponent(addressVal) + '&t=&z=13&ie=UTF8&iwloc=&output=embed';
                }

                if (previewFrame.src !== url) {
                    previewFrame.src = url;
                }

                if (openMapsLink) {
                    openMapsLink.href = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(addressVal);
                }
            }

            if (addressInput) {
                addressInput.addEventListener('input', function () {
                    clearTimeout(timer);
                    timer = setTimeout(updatePreview, 600);
                });
            }

            if (mapsEmbedInput) {
                mapsEmbedInput.addEventListener('input', function () {
                    clearTimeout(timer);
                    timer = setTimeout(updatePreview, 600);
                });
            }

            // Dynamic Language Repeater
            const languagesContainer = document.getElementById('languagesContainer');
            const btnAddLanguage = document.getElementById('btnAddLanguage');

            if (btnAddLanguage && languagesContainer) {
                btnAddLanguage.addEventListener('click', function () {
                    const emptyNotice = document.getElementById('languagesEmptyNotice');
                    if (emptyNotice) emptyNotice.remove();

                    const newIndex = Date.now();
                    const newRow = document.createElement('div');
                    newRow.className = 'language-row flex flex-col sm:flex-row items-stretch sm:items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 shadow-sm transition hover:border-slate-300';
                    newRow.innerHTML = `
                        <div class="flex-1">
                            <label class="block text-[11px] font-semibold text-slate-500 mb-1 sm:hidden">Nama Bahasa &amp; Keterangan</label>
                            <input type="text" name="languages[${newIndex}][name]" value="" placeholder="Contoh: Bahasa Jepang (Dasar)" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-xs sm:text-sm text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100" required>
                        </div>
                        <div class="w-full sm:w-44 flex items-center gap-2">
                            <label class="block text-[11px] font-semibold text-slate-500 sm:hidden">Tingkat:</label>
                            <div class="relative flex-1">
                                <input type="number" name="languages[${newIndex}][percentage]" value="80" min="0" max="100" placeholder="100" class="w-full rounded-lg border border-slate-300 px-3 py-2 pr-8 text-xs sm:text-sm text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100" required>
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-slate-400 pointer-events-none">%</span>
                            </div>
                        </div>
                        <button type="button" onclick="removeLanguageRow(this)" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition self-end sm:self-center" title="Hapus bahasa ini">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                        </button>
                    `;
                    languagesContainer.appendChild(newRow);
                    const input = newRow.querySelector('input');
                    if (input) input.focus();
                });
            }

            window.removeLanguageRow = function (btn) {
                const row = btn.closest('.language-row');
                if (row) {
                    row.remove();
                    if (languagesContainer.querySelectorAll('.language-row').length === 0) {
                        languagesContainer.innerHTML = `
                            <div id="languagesEmptyNotice" class="text-center py-6 text-xs text-slate-500 border border-dashed border-slate-300 rounded-xl bg-white/60">
                                Belum ada bahasa yang ditambahkan. Klik tombol "+ Tambah Bahasa" di atas untuk menambahkan.
                            </div>
                        `;
                    }
                }
            };
        });
    </script>
</x-admin-layout>
