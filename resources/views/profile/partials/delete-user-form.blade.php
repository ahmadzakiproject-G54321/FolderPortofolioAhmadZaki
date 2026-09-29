<section>
    <div class="flex items-center gap-3 mb-6">
        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-600 text-white shadow-sm">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>
        </span>
        <div>
            <h2 class="text-base sm:text-lg font-bold text-red-950">
                Zona Berbahaya: Hapus Akun
            </h2>
            <p class="text-xs sm:text-sm text-red-700/80">
                Setelah akun Anda dihapus, semua sesi dan data otentikasi login akan dihapus secara permanen.
            </p>
        </div>
    </div>

    <div class="rounded-xl border border-red-200 bg-white/80 p-4 sm:p-5">
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Sebelum menghapus akun Anda, pastikan Anda telah mencadangkan data penting atau memiliki akun administrator alternatif. Tindakan ini tidak dapat dibatalkan.
        </p>

        <div class="mt-4 flex items-center justify-start">
            <button
                type="button"
                onclick="openDeleteAccountModal()"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-4 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm transition hover:bg-red-700 active:scale-[0.98]"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                Hapus Akun Administrator
            </button>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Akun -->
    <div id="deleteAccountModal" class="{{ $errors->userDeletion->isNotEmpty() ? '' : 'hidden' }} fixed inset-0 z-50 flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div id="deleteAccountBackdrop" onclick="closeDeleteAccountModal()" class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm transition-opacity"></div>

        <!-- Modal Dialog -->
        <div class="relative w-full max-w-lg rounded-2xl border border-slate-200 bg-white p-6 shadow-2xl transition-all sm:p-7 z-10">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="flex items-start gap-4">
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-red-100 text-red-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </span>
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-slate-950">
                            Konfirmasi Hapus Akun
                        </h3>
                        <p class="mt-1 text-xs sm:text-sm text-slate-500 leading-relaxed">
                            Apakah Anda yakin ingin menghapus akun ini secara permanen? Masukkan kata sandi akun Anda untuk mengonfirmasi.
                        </p>
                    </div>
                </div>

                <div class="mt-5">
                    <label for="password_delete" class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Kata Sandi Anda</label>
                    <div class="relative flex items-center">
                        <input
                            id="password_delete"
                            name="password"
                            type="password"
                            placeholder="Masukkan kata sandi saat ini"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 pr-11 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-red-500 focus:ring-4 focus:ring-red-100"
                        />
                        <button type="button" onclick="togglePasswordVisibility('password_delete', this)" title="Lihat kata sandi" aria-label="Lihat kata sandi" class="absolute right-0 top-0 bottom-0 px-3.5 flex items-center justify-center text-slate-400 hover:text-slate-700 transition cursor-pointer z-20 focus:outline-none">
                            <svg class="h-4 w-4 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        </button>
                    </div>
                    @if($errors->userDeletion->has('password'))
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>

                <div class="mt-6 flex items-center justify-end gap-3 border-t border-slate-100 pt-4">
                    <button
                        type="button"
                        onclick="closeDeleteAccountModal()"
                        class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-50 transition"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-red-600 px-4 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-red-700 transition"
                    >
                        Ya, Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
