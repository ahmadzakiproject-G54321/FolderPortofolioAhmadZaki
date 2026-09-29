<x-admin-layout title="{{ isset($item) ? 'Edit' : 'Tambah' }} Statistics">
    <div class="mb-5 sm:mb-7">
        <a href="{{ route('admin.crud.index', $resource) }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-slate-500 hover:text-slate-900 transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
            Kembali ke Statistics
        </a>
        <h1 class="mt-2 sm:mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950">{{ isset($item) ? 'Edit' : 'Tambah' }} Statistics</h1>
        <p class="mt-1 text-xs sm:text-sm text-slate-500">Angka dan judul di bawah ini terhubung langsung dengan kartu statistik di Hero Section halaman depan website.</p>
    </div>

    @php
        $publishedProjectsCount = \App\Models\Project::where('status', 'Published')->count();
        $approvedReviewsCount = \App\Models\Review::where('is_approved', true)->count();
    @endphp

    <!-- Info banner & Quick references -->
    <div class="mb-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
        <div class="flex items-center justify-between rounded-xl border border-blue-200 bg-blue-50/80 p-3.5 text-xs sm:text-sm text-blue-900">
            <div class="flex items-center gap-2.5">
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-600 text-white font-bold text-xs"><i class="bi bi-folder-check"></i></span>
                <div>
                    <span class="font-semibold block">Data Project di Database:</span>
                    <span class="text-blue-700 text-xs">{{ $publishedProjectsCount }} project berstatus 'Published'</span>
                </div>
            </div>
            <button type="button" onclick="setNumberValue({{ $publishedProjectsCount }})" class="rounded-lg bg-white px-2.5 py-1 text-xs font-semibold text-blue-700 shadow-sm border border-blue-200 hover:bg-blue-100 transition">
                Gunakan ({{ $publishedProjectsCount }})
            </button>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-amber-200 bg-amber-50/80 p-3.5 text-xs sm:text-sm text-amber-900">
            <div class="flex items-center gap-2.5">
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-600 text-white font-bold text-xs"><i class="bi bi-star-fill"></i></span>
                <div>
                    <span class="font-semibold block">Data Review Klien di Database:</span>
                    <span class="text-amber-700 text-xs">{{ $approvedReviewsCount }} ulasan klien berstatus 'Disetujui'</span>
                </div>
            </div>
            <button type="button" onclick="setNumberValue({{ $approvedReviewsCount }})" class="rounded-lg bg-white px-2.5 py-1 text-xs font-semibold text-amber-700 shadow-sm border border-amber-200 hover:bg-amber-100 transition">
                Gunakan ({{ $approvedReviewsCount }})
            </button>
        </div>
    </div>

    <!-- Quick Preset Buttons -->
    <div class="mb-5 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <span class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Pilih Preset Kartu Hero:</span>
        <div class="flex flex-wrap gap-2">
            <button type="button" onclick="applyPreset('Proyek Selesai', {{ $publishedProjectsCount > 0 ? $publishedProjectsCount : 7 }}, '+', 'bi-folder-check')" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-700 hover:border-blue-500 hover:bg-blue-50 hover:text-blue-700 transition">
                <i class="bi bi-folder-check text-blue-600"></i> Proyek Selesai
            </button>
            <button type="button" onclick="applyPreset('Tahun Pengalaman', 3, '+', 'bi-briefcase')" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-700 hover:border-blue-500 hover:bg-blue-50 hover:text-blue-700 transition">
                <i class="bi bi-briefcase text-blue-600"></i> Tahun Pengalaman
            </button>
            <button type="button" onclick="applyPreset('Klien Puas', {{ $approvedReviewsCount > 0 ? $approvedReviewsCount : 3 }}, '+', 'bi-emoji-smile')" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-700 hover:border-blue-500 hover:bg-blue-50 hover:text-blue-700 transition">
                <i class="bi bi-emoji-smile text-blue-600"></i> Klien Puas
            </button>
            <button type="button" onclick="applyPreset('REST API Dibangun', 15, '+', 'bi-cpu')" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-700 hover:border-blue-500 hover:bg-blue-50 hover:text-blue-700 transition">
                <i class="bi bi-cpu text-blue-600"></i> REST API Dibangun
            </button>
        </div>
    </div>

    <form method="POST" action="{{ isset($item) ? route('admin.crud.update', [$resource, $item->id]) : route('admin.crud.store', $resource) }}" enctype="multipart/form-data" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf
        @if(isset($item)) @method('PUT') @endif
        
        <div class="grid gap-4 p-4 sm:grid-cols-2 sm:gap-6 sm:p-6 lg:p-8">
            @php($titleVal = old('title', isset($item) ? $item->title : ''))
            <div>
                <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Judul Statistik *</label>
                <input type="text" id="statTitleInput" name="title" value="{{ $titleVal }}" placeholder="Contoh: Tahun Pengalaman" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100" required>
            </div>

            @php($numVal = old('number', isset($item) ? $item->number : ''))
            <div>
                <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Angka Statistik *</label>
                <input type="number" id="statNumberInput" name="number" value="{{ $numVal }}" placeholder="Contoh: 30" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100" required>
                <p class="mt-1 text-[11px] text-slate-500">Angka ini yang akan dihitung dan ditampilkan di Hero Section.</p>
            </div>

            @php($suffixVal = old('suffix', isset($item) ? ($item->suffix ?? '') : '+'))
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="block text-xs sm:text-sm font-semibold text-slate-700">Suffix (Simbol Akhir)</label>
                    <button type="button" onclick="document.getElementById('statSuffixInput').value = ''; updateCardPreview();" class="text-[11px] font-medium text-blue-600 hover:text-blue-800 hover:underline">
                        Hapus Tanda / Kosongkan
                    </button>
                </div>
                <input type="text" id="statSuffixInput" name="suffix" value="{{ $suffixVal }}" placeholder="Contoh: + atau % (kosongkan jika tanpa tanda)" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                <p class="mt-1 text-[11px] text-slate-500">Bisa diisi simbol seperti <strong>+</strong>, <strong>%</strong>, atau <strong>dikosongkan jika ingin menampilkan angka murni tanpa tanda</strong>.</p>
            </div>

            @php($iconVal = old('icon', isset($item) ? $item->icon : 'bi-folder-check'))
            <div>
                <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Icon Class (Bootstrap Icons)</label>
                <input type="text" id="statIconInput" name="icon" value="{{ $iconVal }}" placeholder="Contoh: bi-folder-check, bi-briefcase, bi-cpu" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
            </div>

            <!-- Live Card Preview -->
            <div class="sm:col-span-2 rounded-xl border border-slate-200 bg-slate-50/80 p-4">
                <span class="block text-xs font-semibold text-slate-600 mb-2">Pratinjau Tampilan di Hero Section Website:</span>
                <div class="flex items-center justify-center">
                    <div class="w-full max-w-xs rounded-2xl border border-slate-200 bg-white p-5 text-center shadow-sm">
                        <div id="previewStatNum" class="text-3xl font-extrabold text-blue-600" style="font-family: sans-serif;">
                            {{ ($numVal !== '' ? $numVal : '30') . ($suffixVal ?? '') }}
                        </div>
                        <div id="previewStatTitle" class="mt-1 text-xs sm:text-sm font-semibold text-slate-600">
                            {{ $titleVal ?: 'Projects Completed' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col-reverse gap-2.5 border-t border-slate-200 bg-slate-50 px-4 py-4 sm:flex-row sm:justify-end sm:px-6 sm:py-5 lg:px-8">
            <a href="{{ route('admin.crud.index', $resource) }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-center text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                Batal
            </a>
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-950 px-6 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                {{ isset($item) ? 'Simpan Perubahan' : 'Simpan Data' }}
            </button>
        </div>
    </form>

    <script>
        function applyPreset(title, num, suffix, icon) {
            document.getElementById('statTitleInput').value = title;
            document.getElementById('statNumberInput').value = num;
            document.getElementById('statSuffixInput').value = suffix;
            document.getElementById('statIconInput').value = icon;
            updateCardPreview();
        }

        function setNumberValue(num) {
            document.getElementById('statNumberInput').value = num;
            updateCardPreview();
        }

        function updateCardPreview() {
            const title = document.getElementById('statTitleInput').value || 'Judul Statistik';
            const num = document.getElementById('statNumberInput').value || '0';
            const suffix = document.getElementById('statSuffixInput').value || '';
            document.getElementById('previewStatNum').textContent = num + suffix;
            document.getElementById('previewStatTitle').textContent = title;
        }

        document.getElementById('statTitleInput').addEventListener('input', updateCardPreview);
        document.getElementById('statNumberInput').addEventListener('input', updateCardPreview);
        document.getElementById('statSuffixInput').addEventListener('input', updateCardPreview);
    </script>
</x-admin-layout>
