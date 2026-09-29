<section>
    <div class="flex items-center gap-3 mb-6">
        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
        </span>
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-950">
                Informasi Akun Login
            </h2>
            <p class="text-xs sm:text-sm text-slate-500">
                Perbarui nama akun pengguna dan alamat email yang digunakan untuk masuk ke panel admin.
            </p>
        </div>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="mb-5 flex items-center gap-2.5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs sm:text-sm font-medium text-emerald-800">
            <svg class="h-4 w-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
            <span>Informasi akun berhasil diperbarui.</span>
        </div>
    @endif

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Nama Akun / Administrator</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" placeholder="Nama Anda" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
            @error('name')
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-700">Alamat Email Login</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" placeholder="admin@domain.com" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 sm:px-4 sm:py-3 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-4 focus:ring-slate-100">
            @error('email')
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 rounded-xl border border-amber-200 bg-amber-50 p-3.5 text-xs text-amber-800">
                    <p class="font-medium">Alamat email Anda belum diverifikasi.</p>
                    <button form="send-verification" class="mt-1.5 font-semibold text-amber-900 underline hover:text-amber-950">
                        Klik di sini untuk mengirim ulang tautan verifikasi email.
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-semibold text-emerald-700">
                            Tautan verifikasi baru telah dikirimkan ke alamat email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-950 px-5 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 active:scale-[0.98]">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
                Simpan Informasi Akun
            </button>
        </div>
    </form>
</section>
