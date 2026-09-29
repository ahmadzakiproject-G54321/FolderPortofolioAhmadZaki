<x-admin-layout title="{{ isset($item) ? 'Edit' : 'Tambah' }} Experiences">
    <div class="mb-7">
        <a href="{{ route('admin.crud.index', $resource) }}" class="text-sm font-medium text-slate-500 hover:text-slate-900">← Kembali ke Experiences</a>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">{{ isset($item) ? 'Edit' : 'Tambah' }} Experiences</h1>
        <p class="mt-2 text-sm text-slate-500">Kelola data experiences melalui form khusus ini.</p>
    </div>
    <form method="POST" action="{{ isset($item) ? route('admin.crud.update', [$resource, $item->id]) : route('admin.crud.store', $resource) }}" enctype="multipart/form-data" class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf
        @if(isset($item)) @method('PUT') @endif
        <div class="grid gap-6 p-6 sm:grid-cols-2 lg:p-8">
        @php($value = old('company', isset($item) ? $item->company : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Perusahaan</label><input type="text" name="company" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('position', isset($item) ? $item->position : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Posisi</label><input type="text" name="position" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('employment_type', isset($item) ? $item->employment_type : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Tipe Pekerjaan</label><input type="text" name="employment_type" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('location', isset($item) ? $item->location : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Lokasi</label><input type="text" name="location" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('start_date', isset($item) ? $item->start_date : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Mulai</label><input type="date" name="start_date" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('end_date', isset($item) ? $item->end_date : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Selesai</label><input type="date" name="end_date" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('description', isset($item) ? $item->description : ''))
            <div class="sm:col-span-2"><label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi</label><textarea name="description" rows="6" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100">{{ $value }}</textarea></div>
@php($value = old('technologies', isset($item) ? $item->technologies : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Teknologi</label><input type="text" name="technologies" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('is_current', isset($item) ? $item->is_current : false))
            <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 lg:col-span-2"><input type="checkbox" name="is_current" value="1" @checked($value) class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-400"><span class="text-sm font-semibold text-slate-700">Masih Bekerja</span></label>
        </div>
        <div class="flex flex-col-reverse gap-2.5 border-t border-slate-200 bg-slate-50 px-4 py-4 sm:flex-row sm:justify-end sm:px-6 sm:py-5 lg:px-8">
            <a href="{{ route('admin.crud.index', $resource) }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-center text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">Batal</a>
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-950 px-6 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">{{ isset($item) ? 'Simpan Perubahan' : 'Simpan Data' }}</button>
        </div>
    </form>
</x-admin-layout>
