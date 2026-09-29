<x-admin-layout title="{{ isset($item) ? 'Edit' : 'Tambah' }} {{ $config['title'] }}">
    <div class="mb-5 sm:mb-7">
        <a href="{{ route('admin.crud.index',$resource) }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-slate-500 hover:text-slate-900 transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
            Kembali ke {{ $config['title'] }}
        </a>
        <h1 class="mt-2 sm:mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950">{{ isset($item) ? 'Edit' : 'Tambah' }} {{ $config['title'] }}</h1>
        <p class="mt-1 text-xs sm:text-sm text-slate-500">Isi informasi dengan lengkap dan simpan perubahan.</p>
    </div>

    <form method="POST" action="{{ isset($item) ? route('admin.crud.update',[$resource,$item->id]) : route('admin.crud.store',$resource) }}" enctype="multipart/form-data" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <div class="grid grid-cols-1 gap-4 p-4 sm:grid-cols-2 sm:gap-6 sm:p-6 lg:p-8">
        @foreach($config['fields'] as $name=>$field)
            @php($value=old($name,isset($item)?$item->{$name}:(($field['type']??'')==='checkbox'?false:'')))
            @if(($field['type']??'')==='checkbox')
                <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-3 sm:px-4 sm:py-3.5 lg:col-span-2">
                    <input type="checkbox" name="{{ $name }}" value="1" @checked($value) class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-400">
                    <span class="text-xs sm:text-sm font-semibold text-slate-700">{{ $field['label'] }}</span>
                </label>
            @else
                <div class="{{ in_array(($field['type']??''),['textarea']) ? 'sm:col-span-2' : '' }}">
                    <label class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">{{ $field['label'] }}</label>
                    @if(($field['type']??'')==='textarea')
                        <textarea name="{{ $name }}" rows="5" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100">{{ $value }}</textarea>
                    @elseif(($field['type']??'')==='select')
                        <select name="{{ $name }}" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                            @foreach($field['options'] as $option=>$label)
                                <option value="{{ $option }}" @selected($value===$option)>{{ $label }}</option>
                            @endforeach
                        </select>
                    @elseif(($field['type']??'')==='file')
                        <input type="file" name="{{ $name }}" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-xs sm:text-sm text-slate-700 shadow-sm file:mr-3 file:rounded-lg file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-xs file:font-semibold hover:file:bg-slate-200">
                        @if(isset($item)&&$item->{$name})
                            <p class="mt-1.5 text-xs text-slate-500">File saat ini: <span class="font-medium text-slate-700">{{ basename($item->{$name}) }}</span></p>
                        @endif
                    @else
                        <input type="{{ $field['type'] }}" name="{{ $name }}" value="{{ $value }}" @if(isset($field['step'])) step="{{ $field['step'] }}" @endif class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                    @endif
                </div>
            @endif
        @endforeach
        </div>

        <div class="flex flex-col-reverse gap-2.5 border-t border-slate-200 bg-slate-50 px-4 py-4 sm:flex-row sm:justify-end sm:px-6 sm:py-5 lg:px-8">
            <a href="{{ route('admin.crud.index',$resource) }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-center text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                Batal
            </a>
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-950 px-6 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                {{ isset($item) ? 'Simpan Perubahan' : 'Simpan Data' }}
            </button>
        </div>
    </form>
</x-admin-layout>
