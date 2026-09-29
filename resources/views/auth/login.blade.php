<x-guest-layout>
    @php
        $profile = \App\Models\Profile::first();
    @endphp

    <div class="w-full max-w-[430px] glass-card rounded-3xl p-7 sm:p-9 shadow-2xl relative border border-slate-700/60 shadow-indigo-950/40">
        
        <!-- Header -->
        <div class="text-center mb-7">
            <!-- Glowing Monogram / Brand Icon -->
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-tr from-blue-600 to-cyan-400 text-xl font-extrabold text-white shadow-lg shadow-blue-500/25 ring-4 ring-blue-500/10 transition-transform duration-300 hover:scale-105">
                {{ $profile->initials ?? 'AZ' }}
            </div>

            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-[11px] font-semibold text-blue-400 mb-2">
                <i class="bi bi-shield-lock-fill text-xs"></i> Portal Administrator
            </div>

            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-white font-display">Selamat Datang Kembali</h1>
            <p class="mt-1 text-xs text-slate-400">Masuk untuk mengelola portfolio, proyek, dan pesan masuk.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-5 rounded-xl border border-emerald-500/30 bg-emerald-950/40 p-3.5 text-xs text-emerald-300 flex items-center gap-2.5">
                <i class="bi bi-check-circle-fill text-base shrink-0 text-emerald-400"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <!-- General Error Alert -->
        @if ($errors->any())
            <div class="mb-5 rounded-xl border border-rose-500/30 bg-rose-950/40 p-3.5 text-xs text-rose-300 flex items-start gap-2.5">
                <i class="bi bi-exclamation-octagon-fill text-base shrink-0 text-rose-400 mt-0.5"></i>
                <div class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-300 mb-1.5">
                    Alamat Email
                </label>
                <div class="relative flex items-center">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                        <i class="bi bi-envelope text-sm"></i>
                    </div>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username" 
                           placeholder="nama@domain.com"
                           class="w-full rounded-xl bg-slate-950/70 border {{ $errors->has('email') ? 'border-rose-500 focus:border-rose-500 focus:ring-rose-500/20' : 'border-slate-700/70 focus:border-blue-500 focus:ring-blue-500/20' }} py-2.5 pl-10 pr-3.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 transition duration-150" />
                </div>
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-xs font-semibold text-slate-300">
                        Kata Sandi
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[11px] font-medium text-blue-400 hover:text-blue-300 transition hover:underline">
                            Lupa kata sandi?
                        </a>
                    @endif
                </div>
                <div class="relative flex items-center">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                        <i class="bi bi-key text-sm"></i>
                    </div>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="current-password" 
                           placeholder="••••••••"
                           class="w-full rounded-xl bg-slate-950/70 border {{ $errors->has('password') ? 'border-rose-500 focus:border-rose-500 focus:ring-rose-500/20' : 'border-slate-700/70 focus:border-blue-500 focus:ring-blue-500/20' }} py-2.5 pl-10 pr-10 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 transition duration-150" />
                    <button type="button" 
                            id="togglePassword" 
                            class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-200 transition focus:outline-none"
                            aria-label="Tampilkan atau sembunyikan kata sandi">
                        <i id="togglePasswordIcon" class="bi bi-eye text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center pt-1">
                <input id="remember_me" 
                       type="checkbox" 
                       name="remember" 
                       class="h-4 w-4 rounded border-slate-700 bg-slate-900/80 text-blue-600 focus:ring-2 focus:ring-blue-500/40 focus:ring-offset-0 transition cursor-pointer">
                <label for="remember_me" class="ml-2.5 text-xs text-slate-400 cursor-pointer select-none hover:text-slate-300">
                    Ingat sesi saya di perangkat ini
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" 
                        id="submitBtn"
                        class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-500 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold text-sm shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 active:scale-[0.99] transition-all duration-200 cursor-pointer">
                    <i class="bi bi-box-arrow-in-right text-base" id="btnIcon"></i>
                    <span id="btnText">Masuk Sekarang</span>
                </button>
            </div>
        </form>

        <!-- Footer Note / Security Badge -->
        <div class="mt-6 pt-5 border-t border-slate-800/80 text-center">
            <div class="inline-flex items-center gap-1.5 text-[11px] font-medium text-slate-400 bg-slate-950/40 px-3 py-1 rounded-full border border-slate-800">
                <i class="bi bi-shield-check text-emerald-400"></i> Area Khusus Administrator &bull; Terenkripsi
            </div>
        </div>
    </div>

    <!-- Toggle Password Visibility Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            const loginForm = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');

            if (toggleBtn && passwordInput && toggleIcon) {
                toggleBtn.addEventListener('click', function () {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    toggleIcon.classList.toggle('bi-eye', !isPassword);
                    toggleIcon.classList.toggle('bi-eye-slash', isPassword);
                });
            }

            if (loginForm && submitBtn && btnText && btnIcon) {
                loginForm.addEventListener('submit', function () {
                    submitBtn.classList.add('opacity-80', 'cursor-wait');
                    btnText.textContent = 'Memverifikasi...';
                    btnIcon.className = 'bi bi-arrow-repeat animate-spin text-base';
                });
            }
        });
    </script>
</x-guest-layout>
