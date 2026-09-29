<x-admin-layout title="{{ isset($item) ? 'Edit' : 'Tambah' }} Education">
    @php
        $level = old('education_level', $item->education_level ?? 'Kuliah');
        $institution = old('institution', $item->institution ?? '');
        $degree = old('degree', $item->degree ?? '');
        $major = old('major', $item->major ?? '');
        $startYear = old('start_year', $item->start_year ?? '');
        $endYear = old('end_year', $item->end_year ?? '');
        $gpa = old('gpa', $item->gpa ?? '');
        $description = old('description', $item->description ?? '');
    @endphp

    <div class="mb-7">
        <a href="{{ route('admin.crud.index', $resource) }}" class="text-sm font-medium text-slate-500 hover:text-slate-900">← Kembali ke Education</a>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">{{ isset($item) ? 'Edit' : 'Tambah' }} Pendidikan</h1>
        <p class="mt-2 text-sm text-slate-500">Pilih jenjang pendidikan. Field dan sistem penilaian akan otomatis menyesuaikan.</p>
    </div>

    <form method="POST" action="{{ isset($item) ? route('admin.crud.update', [$resource, $item->id]) : route('admin.crud.store', $resource) }}" class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <div class="grid gap-6 p-6 sm:grid-cols-2 lg:p-8">
            <div class="sm:col-span-2">
                <label for="education_level" class="mb-2 block text-sm font-semibold text-slate-700">Jenjang Pendidikan</label>
                <select id="education_level" name="education_level" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                    <option value="SMA/SMK" @selected($level === 'SMA/SMK')>SMA / SMK</option>
                    <option value="Kuliah" @selected($level === 'Kuliah')>Kuliah / Perguruan Tinggi</option>
                </select>
                @error('education_level')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label id="institution-label" for="institution" class="mb-2 block text-sm font-semibold text-slate-700">Nama Perguruan Tinggi</label>
                <input id="institution" type="text" name="institution" value="{{ $institution }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                @error('institution')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div id="degree-field">
                <label for="degree" class="mb-2 block text-sm font-semibold text-slate-700">Gelar</label>
                <input id="degree" type="text" name="degree" value="{{ $degree }}" placeholder="Contoh: S.Kom."
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                @error('degree')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label id="major-label" for="major" class="mb-2 block text-sm font-semibold text-slate-700">Program Studi</label>
                <input id="major" type="text" name="major" value="{{ $major }}" placeholder="Contoh: Teknik Informatika"
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                @error('major')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="start_year" class="mb-2 block text-sm font-semibold text-slate-700">Tahun Mulai</label>
                <input id="start_year" type="number" name="start_year" value="{{ $startYear }}" min="1900" max="2100" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                @error('start_year')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="end_year" class="mb-2 block text-sm font-semibold text-slate-700">Tahun Selesai</label>
                <input id="end_year" type="number" name="end_year" value="{{ $endYear }}" min="1900" max="2100" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                @error('end_year')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label id="gpa-label" for="gpa" class="mb-2 block text-sm font-semibold text-slate-700">IPK</label>
                <div class="relative">
                    <input id="gpa" type="number" name="gpa" value="{{ $gpa }}" step="0.01" min="0" max="4"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-16 text-sm text-slate-800 outline-none focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                    <span id="gpa-scale" class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs font-medium text-slate-400">/ 4.00</span>
                </div>
                <p id="gpa-help" class="mt-1 text-xs text-slate-500">Masukkan IPK dengan skala 0,00 sampai 4,00.</p>
                @error('gpa')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-2">
                <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi</label>
                <textarea id="description" name="description" rows="6" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-500 focus:ring-4 focus:ring-slate-100">{{ $description }}</textarea>
                @error('description')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex flex-col-reverse gap-2.5 border-t border-slate-200 bg-slate-50 px-4 py-4 sm:flex-row sm:justify-end sm:px-6 sm:py-5 lg:px-8">
            <a href="{{ route('admin.crud.index', $resource) }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-center text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">Batal</a>
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-950 px-6 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">{{ isset($item) ? 'Simpan Perubahan' : 'Simpan Data' }}</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const level = document.getElementById('education_level');
            const institutionLabel = document.getElementById('institution-label');
            const degreeField = document.getElementById('degree-field');
            const degreeInput = document.getElementById('degree');
            const majorLabel = document.getElementById('major-label');
            const majorInput = document.getElementById('major');
            const gpaLabel = document.getElementById('gpa-label');
            const gpaInput = document.getElementById('gpa');
            const gpaScale = document.getElementById('gpa-scale');
            const gpaHelp = document.getElementById('gpa-help');

            function updateEducationForm() {
                const isSchool = level.value === 'SMA/SMK';

                institutionLabel.textContent = isSchool ? 'Nama Sekolah' : 'Nama Perguruan Tinggi';
                degreeField.classList.toggle('hidden', isSchool);
                degreeInput.required = !isSchool;

                majorLabel.textContent = isSchool ? 'Jurusan / Peminatan' : 'Program Studi';
                majorInput.placeholder = isSchool ? 'Contoh: RPL, TKJ, IPA, IPS' : 'Contoh: Teknik Informatika';

                gpaLabel.textContent = isSchool ? 'Nilai Akhir' : 'IPK';
                gpaInput.max = isSchool ? '100' : '4';
                gpaInput.step = '0.01';
                gpaScale.textContent = isSchool ? '/ 100' : '/ 4.00';
                gpaHelp.textContent = isSchool
                    ? 'Masukkan nilai akhir dengan skala 0 sampai 100.'
                    : 'Masukkan IPK dengan skala 0,00 sampai 4,00.';

                if (isSchool && Number(gpaInput.value) > 100) gpaInput.value = '';
                if (!isSchool && Number(gpaInput.value) > 4) gpaInput.value = '';
            }

            level.addEventListener('change', updateEducationForm);
            updateEducationForm();
        });
    </script>
</x-admin-layout>
