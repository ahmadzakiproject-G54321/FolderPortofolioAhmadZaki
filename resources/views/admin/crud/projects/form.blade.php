<x-admin-layout title="{{ isset($item) ? 'Edit' : 'Tambah' }} Projects">
    <div class="mb-7">
        <a href="{{ route('admin.crud.index', $resource) }}" class="text-sm font-medium text-slate-500 hover:text-slate-900">← Kembali ke Projects</a>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">{{ isset($item) ? 'Edit' : 'Tambah' }} Projects</h1>
        <p class="mt-2 text-sm text-slate-500">Kelola data projects melalui form khusus ini.</p>
    </div>
    <form method="POST" action="{{ isset($item) ? route('admin.crud.update', [$resource, $item->id]) : route('admin.crud.store', $resource) }}" enctype="multipart/form-data" class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf
        @if(isset($item)) @method('PUT') @endif
        <div class="grid gap-6 p-6 sm:grid-cols-2 lg:p-8">
        @php($value = old('title', isset($item) ? $item->title : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Judul</label><input type="text" name="title" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('slug', isset($item) ? $item->slug : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Slug</label><input type="text" name="slug" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-semibold text-slate-700">Thumbnail Proyek</label>
                    <span class="inline-flex items-center gap-1 rounded bg-indigo-50 px-2 py-0.5 text-xs font-semibold text-indigo-700 border border-indigo-200">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5"/></svg>
                        Fitur Crop (16:10 / Bebas)
                    </span>
                </div>
                <input type="file" name="thumbnail" accept="image/*" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-slate-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200">
                @if(isset($item) && $item->thumbnail)
                    <p class="mt-2 text-xs text-slate-500">File saat ini: <span class="font-medium text-slate-700">{{ basename($item->thumbnail) }}</span>. Upload baru untuk mengganti.</p>
                @endif
            </div>
@php($value = old('description', isset($item) ? $item->description : ''))
            <div class="sm:col-span-2"><label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi</label><textarea name="description" rows="6" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100">{{ $value }}</textarea></div>
@php($value = old('technology', isset($item) ? $item->technology : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Teknologi</label><input type="text" name="technology" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('github_url', isset($item) ? $item->github_url : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">GitHub URL</label><input type="url" name="github_url" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('demo_url', isset($item) ? $item->demo_url : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Demo URL</label><input type="url" name="demo_url" value="{{ $value }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100"></div>
@php($value = old('featured', isset($item) ? $item->featured : false))
            <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 lg:col-span-2"><input type="checkbox" name="featured" value="1" @checked($value) class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-400"><span class="text-sm font-semibold text-slate-700">Project Unggulan</span></label>
@php($value = old('status', isset($item) ? $item->status : ''))
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Status</label><select name="status" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100"><option value="Published" @selected($value === 'Published')>Published</option><option value="Draft" @selected($value === 'Draft')>Draft</option></select></div>
        </div>
        <div class="flex flex-col-reverse gap-2.5 border-t border-slate-200 bg-slate-50 px-4 py-4 sm:flex-row sm:justify-end sm:px-6 sm:py-5 lg:px-8">
            <a href="{{ route('admin.crud.index', $resource) }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-center text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">Batal</a>
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-950 px-6 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">{{ isset($item) ? 'Simpan Perubahan' : 'Simpan Data' }}</button>
        </div>
    </form>
</x-admin-layout>
