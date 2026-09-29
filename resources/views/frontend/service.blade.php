<!-- ===================== SERVICES ===================== -->
    <section id="services">
      <div class="container">
        <div class="section-head reveal">
          <span class="section-label">Layanan</span>
          <h2 class="section-title">Layanan &amp; Solusi</h2>
          <p class="section-subtitle">Solusi pengembangan backend menyeluruh yang disesuaikan dengan kebutuhan bisnis Anda.</p>
        </div>

        <div class="services-grid">
          @if(isset($services) && $services->isNotEmpty())
            @foreach($services as $service)
              <div class="glass service-card card-hover reveal">
                <div class="service-icon"><i class="{{ $service->icon ?: 'bi bi-code-slash' }}"></i></div>
                <h4>{{ $service->title }}</h4>
                <p>{{ $service->description }}</p>
              </div>
            @endforeach
          @else
            <div class="glass reveal" style="grid-column: 1 / -1; padding: 3rem; text-align: center; border-radius: 1.5rem;">
              <i class="bi bi-gear" style="font-size: 2.5rem; color: #94a3b8; display: block; margin-bottom: 0.75rem;"></i>
              <h4 style="font-size: 1.15rem; font-weight: 700; color: #1e293b;">Belum Ada Layanan</h4>
              <p style="color: #64748b; font-size: 0.95rem; margin-top: 0.25rem;">Layanan dan solusi akan ditampilkan di sini setelah ditambahkan melalui dashboard admin.</p>
            </div>
          @endif
        </div>
      </div>
    </section>
