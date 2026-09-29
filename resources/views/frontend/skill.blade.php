<!-- ===================== SKILLS ===================== -->
<section id="skills" style="background: #eef4ff">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">Keahlian Teknis</span>
            <h2 class="section-title">Tech Stack &amp; Alat Kerja</h2>
            <p class="section-subtitle">
                Teknologi dan perangkat yang saya gunakan untuk merancang, membangun, dan mengoptimalkan sistem backend.
            </p>
        </div>

        @php
            $knownCategories = [
                'backend' => [
                    'title' => 'Backend Development',
                    'icon' => 'bi-code-slash',
                ],
                'database' => [
                    'title' => 'Basis Data (Database)',
                    'icon' => 'bi-database',
                ],
                'frontend' => [
                    'title' => 'Frontend Development',
                    'icon' => 'bi-window-fullscreen',
                ],
                'mobile' => [
                    'title' => 'Mobile Development',
                    'icon' => 'bi-phone',
                ],
                'tools' => [
                    'title' => 'Tools & Lingkungan Kerja',
                    'icon' => 'bi-tools',
                ],
            ];

            $groupedSkills = $skills->groupBy('category');
        @endphp

        <div class="skills-grid">
            @forelse ($groupedSkills as $rawCategory => $categorySkills)
                @php
                    $catKey = strtolower(trim((string)$rawCategory));
                    $config = $knownCategories[$catKey] ?? [
                        'title' => ucwords(str_replace(['_', '-'], ' ', (string)$rawCategory)),
                        'icon' => 'bi-code-square',
                    ];
                @endphp

                @if ($categorySkills->isNotEmpty())
                    <div class="glass skill-card card-hover reveal">
                        <div class="skill-head">
                            <div class="skill-icon">
                                <i class="bi {{ $config['icon'] }}"></i>
                            </div>
                            <h4>{{ $config['title'] }}</h4>
                        </div>

                        @foreach ($categorySkills as $skill)
                            <div class="skill-row {{ $loop->last ? 'mb-0' : '' }}">
                                <div class="skill-top">
                                    <span>
                                        @if ($skill->icon)
                                            <i class="{{ $skill->icon }}" aria-hidden="true"></i>
                                        @endif
                                        {{ $skill->skill_name }}
                                    </span>
                                    <span>{{ $skill->level }}%</span>
                                </div>

                                <div class="progress-track">
                                    <div
                                        class="progress-fill"
                                        data-width="{{ max(0, min(100, (int) $skill->level)) }}%"
                                        aria-hidden="true"
                                    ></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @empty
                <div class="glass reveal" style="grid-column: 1 / -1; padding: 3rem; text-align: center; border-radius: 1.5rem;">
                    <i class="bi bi-code-slash" style="font-size: 2.5rem; color: #94a3b8; display: block; margin-bottom: 0.75rem;"></i>
                    <h4 style="font-size: 1.15rem; font-weight: 700; color: #1e293b;">Belum Ada Keahlian Teknis</h4>
                    <p style="color: #64748b; font-size: 0.95rem; margin-top: 0.25rem;">Daftar keahlian dan teknologi akan ditampilkan di sini setelah ditambahkan melalui dashboard admin.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
