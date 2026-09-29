<!-- ===================== EDUCATION ===================== -->
<section id="education" style="background: #eef4ff">
  <div class="container">
    <div class="section-head reveal">
      <span class="section-label">Pendidikan</span>
      <h2 class="section-title">Riwayat Pendidikan</h2>
      <p class="section-subtitle">Latar belakang pendidikan formal dan pencapaian akademik.</p>
    </div>

    <div class="timeline">
      @forelse($education as $item)
        <div class="timeline-item reveal">
          <span class="timeline-dot"></span>
          <div class="glass timeline-card card-hover">
            <div class="timeline-meta">
              <div>
                <h4>{{ !empty($item->degree) ? $item->degree : ($item->education_level ?: 'Pendidikan Formal') }}</h4>
                <span class="company">{{ $item->institution }}</span>
              </div>
              <span class="timeline-date">{{ $item->start_year }} — {{ $item->end_year ?: 'Sekarang' }}</span>
            </div>

            @if($item->major)
              <p style="color: var(--muted); margin: 0.6rem 0 0.4rem"><strong>{{ $item->education_level === 'SMA/SMK' ? 'Jurusan:' : 'Program Studi:' }}</strong> {{ $item->major }}</p>
            @endif

            @if($item->gpa !== null)
              <p style="color: var(--muted); margin: 0.4rem 0"><strong>{{ $item->education_level === 'SMA/SMK' ? 'Nilai Akhir:' : 'IPK:' }}</strong> {{ rtrim(rtrim(number_format((float) $item->gpa, 2, '.', ''), '0'), '.') }} / {{ $item->education_level === 'SMA/SMK' ? '100' : '4.00' }}</p>
            @endif

            @if($item->description)
              <p style="color: var(--muted); margin: 0.6rem 0 0">{{ $item->description }}</p>
            @endif
          </div>
        </div>
      @empty
        <div class="glass timeline-card">
          <p style="color: var(--muted); margin: 0">Belum ada data riwayat pendidikan.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>
