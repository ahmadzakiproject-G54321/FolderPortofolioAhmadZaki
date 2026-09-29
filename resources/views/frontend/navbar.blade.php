<header class="navbar" id="navbar">
    <div class="container nav-inner">
        <a href="#home" class="brand">
            @if(!empty($setting?->logo_url))
                <img src="{{ $setting->logo_url }}" alt="{{ $setting->site_name ?? 'Logo' }}" class="brand-logo" id="brandLogo">
            @else
                <span class="brand-mark">{{ $profile->initials ?? 'AZ' }}</span>
            @endif
            <span class="brand-name">{{ $profile->first_name ?? 'Ahmad' }}<span class="dot">.</span></span>
        </a>

        <nav>
            <ul class="nav-links">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#skills">Keahlian</a></li>
                <li><a href="#projects">Proyek</a></li>
                <li><a href="#experience">Pengalaman</a></li>
                <li class="nav-dropdown" id="navDropdownMore">
                    <button type="button" class="nav-dropdown-toggle" aria-expanded="false">
                        Lainnya <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul class="nav-dropdown-menu">
                        <li><a href="#education"><i class="bi bi-mortarboard-fill"></i> Pendidikan</a></li>
                        <li><a href="#certificates"><i class="bi bi-award-fill"></i> Sertifikat</a></li>
                        <li><a href="#services"><i class="bi bi-gear-fill"></i> Layanan</a></li>
                        <li><a href="#reviews"><i class="bi bi-star-fill"></i> Ulasan</a></li>
                    </ul>
                </li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
        </nav>

        <div class="nav-cta">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="btn-admin-nav" title="Buka Dashboard Admin">
                    <span class="admin-dot" aria-hidden="true"></span>
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-admin-nav" title="Login Khusus Administrator">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Admin</span>
                </a>
            @endauth
            <a href="#contact" class="btn btn-primary nav-cta-btn"><i class="bi bi-chat-dots-fill"></i> Hubungi Saya</a>
        </div>

        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Toggle navigasi menu" aria-controls="mobileMenu" aria-expanded="false">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu glass" id="mobileMenu">
        <a href="#home">Beranda</a>
        <a href="#about">Tentang</a>
        <a href="#skills">Keahlian</a>
        <a href="#projects">Proyek</a>
        <a href="#experience">Pengalaman</a>
        <a href="#education">Pendidikan</a>
        <a href="#certificates">Sertifikat</a>
        <a href="#services">Layanan</a>
        <a href="#reviews">Ulasan</a>
        <a href="#contact">Kontak</a>
        @auth
            <a href="{{ route('admin.dashboard') }}" class="btn-admin-mobile">
                <span class="admin-dot" aria-hidden="true"></span>
                <i class="bi bi-speedometer2"></i> Dashboard Admin
            </a>
        @else
            <a href="{{ route('login') }}" class="btn-admin-mobile">
                <i class="bi bi-shield-lock-fill"></i> Login Admin
            </a>
        @endauth
        <a href="#contact" class="btn btn-primary" style="margin-top: 0.5rem; justify-content: center"><i class="bi bi-chat-dots-fill"></i> Hubungi Saya</a>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdown = document.getElementById('navDropdownMore');
        if (dropdown) {
            const toggle = dropdown.querySelector('.nav-dropdown-toggle');
            if (toggle) {
                toggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const isOpen = dropdown.classList.toggle('active');
                    toggle.setAttribute('aria-expanded', String(isOpen));
                });
            }
            document.addEventListener('click', function (e) {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove('active');
                    if (toggle) toggle.setAttribute('aria-expanded', 'false');
                }
            });
        }
    });
</script>
