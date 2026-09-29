<!-- ===================== ABOUT ===================== -->
    <section id="about">
      <div class="container">
        <div class="section-head reveal">
          <span class="section-label">Tentang Saya</span>
          <h2 class="section-title">Profil &amp; Dedikasi Profesional</h2>
          <p class="section-subtitle">{{ $profile->profession ?? 'Backend Developer' }} yang berfokus pada penulisan kode bersih, arsitektur scalable, dan performa tinggi.</p>
        </div>

        <div class="about-grid">
          <div class="about-text reveal">
            <h3>Biografi Singkat</h3>
            <p>
              {{ $profile->about ?? 'Saya adalah lulusan Sistem Komputer dari STMIK Jayanusa Padang dengan fokus keahlian pada Backend Development menggunakan Laravel, PHP, dan MySQL. Berpengalaman dalam merancang dan membangun sistem informasi inventaris, apotek, absensi, hingga integrasi perangkat IoT.' }}
            </p>
            <h3 style="margin-top: 1.5rem">Tujuan Karir</h3>
            <p>
              {{ $profile->career_objective ?? 'Berkomitmen untuk terus berkembang dan berkontribusi sebagai Backend Software Engineer profesional dalam merancang dan membangun arsitektur sistem web yang handal, efisien, aman, dan scalable untuk memberikan dampak positif nyata bagi pengguna dan bisnis.' }}
            </p>

            <ul class="info-list">
              <li class="info-item">
                <i class="bi bi-person-fill"></i>
                <span><span class="label">Nama Lengkap</span><span class="value">{{ $profile?->full_name ?? 'Ahmad Zaki' }}</span></span>
              </li>
              <li class="info-item">
                <i class="bi bi-briefcase-fill"></i>
                <span><span class="label">Profesi</span><span class="value">{{ $profile?->profession ?? 'Backend Developer' }}</span></span>
              </li>
              <li class="info-item">
                <i class="bi bi-envelope-fill"></i>
                <span><span class="label">Alamat Email</span><span class="value">{{ $profile?->email ?? '-' }}</span></span>
              </li>
              <li class="info-item">
                <i class="bi bi-geo-alt-fill"></i>
                <span><span class="label">Domisili / Lokasi</span><span class="value">{{ $profile?->address ?? '-' }}</span></span>
              </li>
              <li class="info-item">
                <i class="bi bi-telephone-fill"></i>
                <span><span class="label">Telepon / WhatsApp</span><span class="value">{{ $profile?->phone ?? '-' }}</span></span>
              </li>
            </ul>
          </div>

          <div class="about-side">
            <div class="glass about-card card-hover reveal">
              <h4><i class="bi bi-mortarboard-fill"></i> Pendidikan Terakhir</h4>
              @php
                $topEdu = isset($education) && $education->isNotEmpty() ? $education->first() : null;
              @endphp
              @if($topEdu)
                <p><strong>{{ $topEdu->degree ?: ($topEdu->major ? 'Jurusan ' . $topEdu->major : $topEdu->education_level) }}</strong><br />{{ $topEdu->institution }}<br />{{ $topEdu->start_year }} — {{ $topEdu->end_year ?: 'Sekarang' }}</p>
              @else
                <p style="color: var(--muted); margin: 0">Belum ada data riwayat pendidikan.</p>
              @endif
            </div>
            <div class="glass about-card card-hover reveal">
              <h4><i class="bi bi-briefcase-fill"></i> Pengalaman</h4>
              @if(!empty($experienceYears) && $experienceYears > 0)
                <p>{{ $experienceYears }}+ tahun merancang aplikasi web Laravel, arsitektur database, dan integrasi RESTful API.</p>
              @else
                <p>Fokus dalam merancang dan mengembangkan aplikasi web Laravel, arsitektur database, dan integrasi RESTful API.</p>
              @endif
            </div>
            <div class="glass about-card card-hover reveal">
              <h4><i class="bi bi-translate"></i> Penguasaan Bahasa</h4>
              @php
                $languages = $profile->languages_list ?? [];
              @endphp
              @if(!empty($languages) && count($languages) > 0)
                @foreach($languages as $lang)
                  <div class="lang-bar" @if($loop->last) style="margin-bottom: 0" @endif>
                    <div class="lang-top">
                      <span>{{ $lang['name'] ?? '' }}</span>
                      <span>{{ (int)($lang['percentage'] ?? 100) }}%</span>
                    </div>
                    <div class="progress-track">
                      <div class="progress-fill" data-width="{{ max(0, min(100, (int)($lang['percentage'] ?? 100))) }}%"></div>
                    </div>
                  </div>
                @endforeach
              @else
                <p style="color: var(--muted); margin: 0">Belum ada data penguasaan bahasa.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
