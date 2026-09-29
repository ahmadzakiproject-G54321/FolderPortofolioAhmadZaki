<x-admin-layout title="Pengaturan Akun & Keamanan">
    <div class="mb-5 sm:mb-7">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-slate-500 transition hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
            </svg>
            Kembali ke Dashboard
        </a>
        <div class="mt-2 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-950">Pengaturan Akun & Keamanan</h1>
                <p class="mt-1 text-xs sm:text-sm text-slate-500">Kelola informasi kredensial login akun admin, alamat email, dan pembaruan kata sandi.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    {{ $user->email }}
                </span>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Informasi Akun -->
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 sm:p-7 lg:p-8 shadow-sm">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Pembaruan Kata Sandi -->
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 sm:p-7 lg:p-8 shadow-sm">
            @include('profile.partials.update-password-form')
        </div>

        <!-- Zona Bahaya: Hapus Akun -->
        <div class="overflow-hidden rounded-2xl border border-red-200/80 bg-red-50/20 p-5 sm:p-7 lg:p-8 shadow-sm">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

    @push('scripts')
    <script>
        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            if (!input) return;

            if (input.type === 'password') {
                input.type = 'text';
                btn.innerHTML = `<svg class="h-4 w-4 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>`;
            } else {
                input.type = 'password';
                btn.innerHTML = `<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>`;
            }
        }

        function openDeleteAccountModal() {
            const modal = document.getElementById('deleteAccountModal');
            if (modal) {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                setTimeout(() => {
                    const input = document.getElementById('password_delete');
                    if (input) input.focus();
                }, 100);
            }
        }

        function closeDeleteAccountModal() {
            const modal = document.getElementById('deleteAccountModal');
            if (modal) {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeDeleteAccountModal();
            }
        });
    </script>
    @endpush
</x-admin-layout>
