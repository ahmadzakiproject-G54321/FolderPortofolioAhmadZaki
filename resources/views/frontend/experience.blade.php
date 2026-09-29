<!-- ===================== EXPERIENCE ===================== -->
    <section id="experience" style="background: #eef4ff">
      <div class="container">
        <div class="section-head reveal">
          <span class="section-label">Pengalaman Kerja</span>
          <h2 class="section-title">Perjalanan Profesional</h2>
          <p class="section-subtitle">Rekam jejak pengalaman kerja, magang, dan proyek pengembangan sistem backend.</p>
        </div>

        <div class="timeline">
          @if(isset($experiences) && $experiences->isNotEmpty())
            @foreach($experiences as $exp)
              @php
                $startDate = !empty($exp->start_date) ? \Carbon\Carbon::parse($exp->start_date)->format('M Y') : '';
                $endDate = $exp->is_current ? 'Sekarang' : (!empty($exp->end_date) ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : 'Selesai');
                $dateLabel = $startDate . ($endDate ? ' — ' . $endDate : '');
                $techs = !empty($exp->technologies) ? array_filter(array_map('trim', explode(',', $exp->technologies))) : [];
              @endphp
              <div class="timeline-item reveal">
                <span class="timeline-dot"></span>
                <div class="glass timeline-card card-hover">
                  <div class="timeline-meta">
                    <div>
                      <h4>{{ $exp->position }}</h4>
                      <span class="company">{{ $exp->company }} {{ $exp->location ? '• ' . $exp->location : '' }}</span>
                    </div>
                    <span class="timeline-date">{{ $dateLabel }}</span>
                  </div>
                  <p style="color: var(--muted); margin-bottom: 0.8rem; line-height: 1.6;">{{ $exp->description }}</p>
                  @if(!empty($techs))
                    <div class="tech-tags">
                      @foreach($techs as $tech)
                        <span class="tech-tag">{{ $tech }}</span>
                      @endforeach
                    </div>
                  @endif
                </div>
              </div>
            @endforeach
          @else
            <div class="glass reveal" style="padding: 2.5rem; text-align: center; border-radius: 1.5rem; max-width: 600px; margin: 0 auto;">
              <i class="bi bi-briefcase" style="font-size: 2.5rem; color: #94a3b8; display: block; margin-bottom: 0.75rem;"></i>
              <h4 style="font-size: 1.15rem; font-weight: 700; color: #1e293b;">Belum Ada Pengalaman Kerja</h4>
              <p style="color: #64748b; font-size: 0.95rem; margin-top: 0.25rem;">Data riwayat pengalaman kerja akan ditampilkan di sini setelah ditambahkan melalui dashboard admin.</p>
            </div>
          @endif
        </div>
      </div>
    </section>
