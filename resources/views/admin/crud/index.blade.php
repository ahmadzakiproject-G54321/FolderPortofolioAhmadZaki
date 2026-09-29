<x-admin-layout title="{{ $config['title'] ?? ucfirst($resource) }}">
    <div class="mb-5 sm:mb-7 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs sm:text-sm font-semibold text-slate-400">Portfolio</p>
            <h1 class="mt-0.5 sm:mt-1 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950">{{ $config['title'] ?? ucfirst($resource) }}</h1>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">Kelola data {{ strtolower($config['title'] ?? $resource) }}.</p>
        </div>
        <a href="{{ route('admin.crud.create',$resource) }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-950 px-4 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
            + Tambah {{ rtrim($config['title'] ?? 'Data','s') }}
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3 sm:px-5 sm:py-4">
            <div class="text-xs sm:text-sm font-semibold text-slate-800">Daftar data</div>
            <div class="rounded-lg bg-slate-100 px-2 py-0.5 text-xs font-semibold text-slate-600">{{ $items->total() }} item</div>
        </div>

        <!-- Scroll indicator for mobile -->
        <div class="flex items-center gap-1.5 border-b border-slate-100 bg-slate-50/80 px-4 py-2 text-[11px] text-slate-500 sm:hidden">
            <svg class="h-3.5 w-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            <span>Geser tabel ke kanan untuk melihat kolom lengkap</span>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="w-full min-w-[720px] divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="w-14 px-4 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">No.</th>
                        @foreach($config['fields'] as $name=>$field)
                            <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">{{ $field['label'] ?? ucfirst(str_replace('_',' ',$name)) }}</th>
                        @endforeach
                        <th class="w-32 px-4 py-3 text-right text-[11px] font-bold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($items as $item)
                    <tr class="transition hover:bg-slate-50/80">
                        <td class="px-4 py-3.5 text-xs sm:text-sm font-semibold text-slate-500">{{ ($items->firstItem() ?? 1) + $loop->index }}</td>
                        @foreach($config['fields'] as $name=>$field)
                            <td class="max-w-xs px-4 py-3.5 text-xs sm:text-sm text-slate-700">
                                <?php $value = $item->{$name} ?? null; ?>
                                @if(($field['type']??'')==='checkbox')
                                    <span class="inline-flex rounded-full px-2 py-0.5 text-[11px] font-semibold {{ $value ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">{{ $value ? 'Aktif' : 'Tidak' }}</span>
                                @elseif(($field['type']??'')==='file')
                                    <span class="text-xs font-medium {{ $value ? 'text-emerald-600' : 'text-slate-400' }}">{{ $value ? '✓ File ada' : '—' }}</span>
                                @elseif(($field['type']??'')==='select')
                                    <span class="rounded-full bg-slate-100 px-2 py-0.5 text-xs font-semibold text-slate-600">{{ $value ?: '—' }}</span>
                                @else
                                    <span title="{{ $value }}">{{ \Illuminate\Support\Str::limit((string)($value ?? '—'), 50) }}</span>
                                @endif
                            </td>
                        @endforeach
                        <td class="whitespace-nowrap px-4 py-3.5 text-right">
                            <a href="{{ route('admin.crud.edit',[$resource,$item->id]) }}" class="mr-3 text-xs sm:text-sm font-semibold text-slate-700 hover:text-slate-950 transition">Edit</a>
                            <?php $itemLabel = $item->title ?? $item->skill_name ?? $item->position ?? $item->school ?? $item->service_name ?? $item->platform ?? $item->label ?? $item->name ?? ($config['title'] ?? 'Data ini'); ?>
                            <form action="{{ route('admin.crud.destroy',[$resource,$item->id]) }}" method="POST" class="inline" onsubmit="return openDeleteModal(event, '{{ addslashes($itemLabel) }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs sm:text-sm font-semibold text-red-600 hover:text-red-700 transition">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($config['fields'])+2 }}" class="px-4 py-12 text-center">
                            <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-400">+</div>
                            <div class="mt-3 text-sm font-semibold text-slate-800">Belum ada data</div>
                            <div class="mt-1 text-xs text-slate-500">Tambahkan data pertama untuk mulai mengisi portfolio.</div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
            <div class="border-t border-slate-200 px-4 py-3 sm:px-5 sm:py-4">
                {{ $items->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
