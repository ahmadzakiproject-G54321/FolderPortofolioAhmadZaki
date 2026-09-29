<!-- ===================== PROJECTS ===================== -->
    <section id="projects">
      <div class="container">
        <div class="section-head reveal">
          <span class="section-label">Portofolio</span>
          <h2 class="section-title">Proyek Unggulan</h2>
          <p class="section-subtitle">Pilihan sistem nyata dan aplikasi web yang telah saya rancang serta kembangkan dengan Laravel.</p>
        </div>

        <div class="projects-grid">
          @if(isset($projects) && $projects->isNotEmpty())
            @foreach($projects as $project)
              @php
                $thumbUrl = $project->thumbnail_url;

                $tags = [];
                if (!empty($project->technology)) {
                    $tags = array_filter(array_map('trim', explode(',', $project->technology)));
                }
                if (empty($tags)) {
                    $tags = ['Laravel', 'MySQL', 'PHP'];
                }
              @endphp

              <article class="glass project-card card-hover reveal">
                <div class="project-thumb" style="position: relative;">
                  <img src="{{ $thumbUrl }}" alt="Thumbnail {{ $project->title }}" loading="lazy" width="400" height="250" />
                  @if($project->featured)
                    <span style="position: absolute; top: 12px; right: 12px; background: rgba(37, 99, 235, 0.92); backdrop-filter: blur(4px); color: #fff; font-size: 0.72rem; font-weight: 700; padding: 4px 10px; border-radius: 9999px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35); display: inline-flex; align-items: center; gap: 4px; letter-spacing: 0.02em;">
                      <i class="bi bi-star-fill" style="color: #fbbf24; font-size: 0.7rem;"></i> Unggulan
                    </span>
                  @endif
                </div>
                <div class="project-body">
                  <h4>{{ $project->title }}</h4>
                  <p>{{ $project->description }}</p>
                  <div class="tech-tags">
                    @foreach($tags as $tag)
                      <span class="tech-tag">{{ $tag }}</span>
                    @endforeach
                  </div>
                  <div class="project-actions">
                    @if(!empty($project->github_url))
                      <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline"><i class="bi bi-github"></i> Lihat Kode</a>
                    @endif
                    @if(!empty($project->demo_url))
                      <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary"><i class="bi bi-arrow-up-right"></i> Live Demo</a>
                    @endif
                    @if(empty($project->github_url) && empty($project->demo_url))
                      <a href="#contact" class="btn btn-outline"><i class="bi bi-chat-dots"></i> Tanya Proyek</a>
                    @endif
                  </div>
                </div>
              </article>
            @endforeach
          @else
            <div class="glass reveal" style="grid-column: 1 / -1; padding: 3rem; text-align: center; border-radius: 1.5rem;">
              <i class="bi bi-folder-x" style="font-size: 2.5rem; color: #94a3b8; display: block; margin-bottom: 0.75rem;"></i>
              <h4 style="font-size: 1.15rem; font-weight: 700; color: #1e293b;">Belum Ada Proyek</h4>
              <p style="color: #64748b; font-size: 0.95rem; margin-top: 0.25rem;">Data proyek portofolio akan ditampilkan di sini setelah ditambahkan melalui dashboard admin.</p>
            </div>
          @endif
        </div>
      </div>
    </section>
