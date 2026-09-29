<x-admin-layout title="{{ isset($item) ? 'Edit' : 'Tambah' }} Skills">
    <div class="mb-7">
        <a href="{{ route('admin.crud.index', $resource) }}" class="text-sm font-medium text-slate-500 hover:text-slate-900">← Kembali ke Skills</a>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">{{ isset($item) ? 'Edit' : 'Tambah' }} Skills</h1>
        <p class="mt-2 text-sm text-slate-500">Kelola data skills melalui form khusus ini.</p>
    </div>
    <form method="POST" action="{{ isset($item) ? route('admin.crud.update', [$resource, $item->id]) : route('admin.crud.store', $resource) }}" enctype="multipart/form-data" class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf
        @if(isset($item)) @method('PUT') @endif
        <div class="grid gap-6 p-6 sm:grid-cols-2 lg:p-8">
        @php($value = old('category', isset($item) ? $item->category : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Kategori</label><input type="text" name="category" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('skill_name', isset($item) ? $item->skill_name : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Nama Skill</label><input type="text" name="skill_name" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('level', isset($item) ? $item->level : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Level (%)</label><input type="number" name="level" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('icon', isset($item) ? $item->icon : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Icon</label><input type="text" name="icon" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('is_active', isset($item) ? $item->is_active : false))
            <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 lg:col-span-2"><input type="checkbox" name="is_active" value="1" @checked($value) class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-400"><span class="text-sm font-semibold text-slate-700">Aktif</span></label>
        </div>
        <div class="flex flex-col-reverse gap-2.5 border-t border-slate-200 bg-slate-50 px-4 py-4 sm:flex-row sm:justify-end sm:px-6 sm:py-5 lg:px-8">
            <a href="{{ route('admin.crud.index', $resource) }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-center text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">Batal</a>
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-950 px-6 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">{{ isset($item) ? 'Simpan Perubahan' : 'Simpan Data' }}</button>
        </div>
    </form>
</x-admin-layout>
