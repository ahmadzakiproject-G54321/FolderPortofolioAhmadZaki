<x-admin-layout title="{{ isset($item) ? 'Edit' : 'Tambah' }} Social Links">
    <div class="mb-5 sm:mb-7">
        <a href="{{ route('admin.crud.index', $resource) }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-slate-500 hover:text-slate-900 transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
            Kembali ke Social Links
        </a>
        <h1 class="mt-2 sm:mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950">{{ isset($item) ? 'Edit' : 'Tambah' }} Social Links</h1>
        <p class="mt-1 text-xs sm:text-sm text-slate-500">Kelola akun media sosial, link kontak, dan alamat email portfolio.</p>
    </div>

    <form method="POST" action="{{ isset($item) ? route('admin.crud.update', [$resource, $item->id]) : route('admin.crud.store', $resource) }}" enctype="multipart/form-data" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <div class="grid grid-cols-1 gap-4 p-4 sm:grid-cols-2 sm:gap-6 sm:p-6 lg:p-8">
            @php($platformVal = old('platform', isset($item) ? $item->platform : ''))
            <div>
                <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Platform <span class="text-rose-500">*</span></label>
                <input type="text" name="platform" value="{{ $platformVal }}" placeholder="Contoh: GitHub, LinkedIn, WhatsApp, Email" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100" required>
                <p class="mt-1 text-[11px] text-slate-500">Nama platform atau jenis tautan kontak.</p>
            </div>

            @php($iconVal = old('icon', isset($item) ? $item->icon : ''))
            <div>
                <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Icon (Bootstrap Icons)</label>
                <input type="text" name="icon" value="{{ $iconVal }}" placeholder="Contoh: bi bi-envelope-fill, bi bi-github" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                <p class="mt-1 text-[11px] text-slate-500">Nama class Bootstrap Icons (opsional, contoh: <code>bi bi-envelope-fill</code>).</p>
            </div>

            @php($urlVal = old('url', isset($item) ? $item->url : ''))
            <div class="sm:col-span-2">
                <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">URL / Tautan / Alamat Email <span class="text-rose-500">*</span></label>
                <input type="text" name="url" value="{{ $urlVal }}" placeholder="Contoh: https://github.com/username atau nama@gmail.com" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100" required>
                
                <div class="mt-2.5 rounded-xl bg-slate-50 border border-slate-200/80 p-3 sm:p-4 text-xs text-slate-600 space-y-1.5">
                    <p class="font-semibold text-slate-800 flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        Panduan Pengisian:
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-slate-600">
                        <li><strong>Email:</strong> Anda dapat langsung mengetik alamat email (contoh: <code>zaki@gmail.com</code>) atau format <code>mailto:zaki@gmail.com</code>. Sistem otomatis menyesuaikannya.</li>
                        <li><strong>Website / Media Sosial:</strong> Masukkan URL lengkap (contoh: <code>https://github.com/username</code>) atau tanpa https (contoh: <code>github.com/username</code>).</li>
                        <li><strong>WhatsApp:</strong> Bisa nomor WhatsApp langsung (contoh: <code>081261514108</code>) atau link <code>https://wa.me/6281261514108</code>.</li>
                    </ul>
                </div>
            </div>

            @php($isActiveVal = old('is_active', isset($item) ? $item->is_active : true))
            <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-3 sm:px-4 sm:py-3.5 sm:col-span-2 cursor-pointer hover:bg-slate-100/70 transition">
                <input type="checkbox" name="is_active" value="1" @checked($isActiveVal) class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-400">
                <div>
                    <span class="text-xs sm:text-sm font-semibold text-slate-800">Tampilkan di Website (Status Aktif)</span>
                    <p class="text-[11px] text-slate-500">Jika aktif, ikon dan tautan ini akan langsung muncul di bagian header/hero dan footer website.</p>
                </div>
            </label>
        </div>

        <div class="flex flex-col-reverse gap-2.5 border-t border-slate-200 bg-slate-50 px-4 py-4 sm:flex-row sm:justify-end sm:px-6 sm:py-5 lg:px-8">
            <a href="{{ route('admin.crud.index', $resource) }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-center text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">Batal</a>
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-950 px-6 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">{{ isset($item) ? 'Simpan Perubahan' : 'Simpan Data' }}</button>
        </div>
    </form>
</x-admin-layout>
