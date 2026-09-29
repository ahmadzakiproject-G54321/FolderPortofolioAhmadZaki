<footer class="footer">
      <div class="container">
        <div class="footer-grid">
          <div>
            <a href="#home" class="brand">
              @if(!empty($setting?->logo_url))
                <img src="{{ $setting->logo_url }}" alt="{{ $setting->site_name ?? 'Logo' }}" class="brand-logo">
              @else
                <span class="brand-mark">{{ $profile->initials ?? 'AZ' }}</span>
              @endif
              {{ $profile->full_name ?? 'Ahmad Zaki' }}<span class="dot">.</span>
            </a>
            <p>{{ $profile->short_description ?? 'Software Engineer & Web Developer yang berfokus pada arsitektur backend Laravel modern, perancangan RESTful API, dan optimasi basis data.' }}</p>
            <div class="footer-socials">
              @if(isset($socialLinks) && $socialLinks->isNotEmpty())
                @foreach($socialLinks as $link)
                  <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $link->platform }}" title="{{ $link->platform }}"><i class="{{ $link->icon ?: 'bi bi-link-45deg' }}"></i></a>
                @endforeach
              @else
                <a href="{{ !empty($profile->github) ? $profile->github : '#' }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><i class="bi bi-github"></i></a>
                <a href="{{ !empty($profile->linkedin) ? $profile->linkedin : '#' }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                @if(!empty($profile->instagram))
                  <a href="{{ $profile->instagram }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                @endif
                <a href="mailto:{{ $profile->email ?? 'zaki081261514108@gmail.com' }}" aria-label="Email"><i class="bi bi-envelope"></i></a>
                <a href="{{ !empty($profile->whatsapp) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $profile->whatsapp) : '#' }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
              @endif
            </div>
          </div>
          <div>
            <h5>Navigasi Cepat</h5>
            <ul class="footer-links">
              <li><a href="#home">Beranda</a></li>
              <li><a href="#about">Tentang</a></li>
              <li><a href="#skills">Keahlian</a></li>
              <li><a href="#projects">Proyek</a></li>
              <li><a href="#experience">Pengalaman</a></li>
            </ul>
          </div>
          <div>
            <h5>Menu Lainnya</h5>
            <ul class="footer-links">
              <li><a href="#education">Pendidikan</a></li>
              <li><a href="#certificates">Sertifikat</a></li>
              <li><a href="#services">Layanan</a></li>
              <li><a href="#reviews">Ulasan</a></li>
              <li><a href="#contact">Kontak</a></li>
              <li>
                @auth
                  <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard Admin</a>
                @else
                  <a href="{{ route('login') }}"><i class="bi bi-shield-lock"></i> Login Admin</a>
                @endauth
              </li>
            </ul>
          </div>
        </div>
        <div class="footer-bottom">
          @if(!empty($setting?->footer_text))
            {!! $setting->footer_text !!}
          @else
            &copy; <span id="year">{{ date('Y') }}</span> {{ $profile->full_name ?? 'Ahmad Zaki' }}. Seluruh hak cipta dilindungi. Dikembangkan dengan Laravel.
          @endif
          @auth
            <a href="{{ route('admin.dashboard') }}" class="footer-admin-link" title="Dashboard Admin"><i class="bi bi-shield-check"></i> Dashboard</a>
          @else
            <a href="{{ route('login') }}" class="footer-admin-link" title="Login Khusus Administrator"><i class="bi bi-shield-lock"></i> Admin</a>
          @endauth
        </div>
      </div>
    </footer>
