<section>
    <div class="flex items-center gap-3 mb-6">
        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-500 text-white shadow-sm">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
        </span>
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-950">
                Pembaruan Kata Sandi
            </h2>
            <p class="text-xs sm:text-sm text-slate-500">
                Pastikan akun Anda menggunakan kata sandi yang aman dan tidak digunakan di tempat lain.
            </p>
        </div>
    </div>

    @if (session('status') === 'password-updated')
        <div class="mb-5 flex items-center gap-2.5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs sm:text-sm font-medium text-emerald-800">
            <svg class="h-4 w-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
            <span>Kata sandi akun Anda berhasil diperbarui.</span>
        </div>
    @endif

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Kata Sandi Saat Ini</label>
            <div class="relative flex items-center">
                <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" placeholder="Masukkan kata sandi lama" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 pr-11 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                <button type="button" onclick="togglePasswordVisibility('update_password_current_password', this)" title="Lihat kata sandi" aria-label="Lihat kata sandi" class="absolute right-0 top-0 bottom-0 px-3.5 flex items-center justify-center text-slate-400 hover:text-slate-700 transition cursor-pointer z-20 focus:outline-none">
                    <svg class="h-4 w-4 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                </button>
            </div>
            @if($errors->updatePassword->has('current_password'))
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password" class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Kata Sandi Baru</label>
            <div class="relative flex items-center">
                <input id="update_password_password" name="password" type="password" autocomplete="new-password" placeholder="Minimal 8 karakter" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 pr-11 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                <button type="button" onclick="togglePasswordVisibility('update_password_password', this)" title="Lihat kata sandi" aria-label="Lihat kata sandi" class="absolute right-0 top-0 bottom-0 px-3.5 flex items-center justify-center text-slate-400 hover:text-slate-700 transition cursor-pointer z-20 focus:outline-none">
                    <svg class="h-4 w-4 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                </button>
            </div>
            @if($errors->updatePassword->has('password'))
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation" class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Konfirmasi Kata Sandi Baru</label>
            <div class="relative flex items-center">
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Ulangi kata sandi baru" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 pr-11 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
                <button type="button" onclick="togglePasswordVisibility('update_password_password_confirmation', this)" title="Lihat kata sandi" aria-label="Lihat kata sandi" class="absolute right-0 top-0 bottom-0 px-3.5 flex items-center justify-center text-slate-400 hover:text-slate-700 transition cursor-pointer z-20 focus:outline-none">
                    <svg class="h-4 w-4 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                </button>
            </div>
            @if($errors->updatePassword->has('password_confirmation'))
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-950 px-5 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 active:scale-[0.98]">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
                Perbarui Kata Sandi
            </button>
        </div>
    </form>
</section>

<script>
    window.togglePasswordVisibility = function(inputId, btn) {
        const input = document.getElementById(inputId);
        if (!input) return;

        const eyeOpen = '<svg class="h-4 w-4 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>';
        const eyeSlash = '<svg class="h-4 w-4 pointer-events-none text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>';

        if (input.type === 'password') {
            input.type = 'text';
            btn.innerHTML = eyeSlash;
            btn.setAttribute('title', 'Sembunyikan kata sandi');
            btn.setAttribute('aria-label', 'Sembunyikan kata sandi');
        } else {
            input.type = 'password';
            btn.innerHTML = eyeOpen;
            btn.setAttribute('title', 'Lihat kata sandi');
            btn.setAttribute('aria-label', 'Lihat kata sandi');
        }
    };
</script>
