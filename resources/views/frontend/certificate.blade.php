<!-- ===================== CERTIFICATES ===================== -->
    <section id="certificates">
      <div class="container">
        <div class="section-head reveal">
          <span class="section-label">Sertifikasi</span>
          <h2 class="section-title">Sertifikasi &amp; Lisensi</h2>
          <p class="section-subtitle">Sertifikasi profesional dan pelatihan yang memvalidasi kompetensi teknis saya.</p>
        </div>

        <div class="cert-grid">
          @if(isset($certificates) && $certificates->isNotEmpty())
            @foreach($certificates as $cert)
              @php
                $certImg = $cert->certificate_image_url;
                $pdfUrl = $cert->certificate_file_url ?? '';

                $credentialUrl = !empty($cert->credential_url) ? $cert->credential_url : '';
                $certYear = !empty($cert->issue_date) ? \Carbon\Carbon::parse($cert->issue_date)->format('Y') : '2025';
                $certDateFormatted = !empty($cert->issue_date) ? \Carbon\Carbon::parse($cert->issue_date)->translatedFormat('d F Y') : 'Tahun ' . $certYear;
              @endphp

              <article class="glass cert-card card-hover reveal"
                data-title="{{ $cert->title }}"
                data-issuer="{{ $cert->issuer }}"
                data-date="{{ $certDateFormatted }}"
                data-year="{{ $certYear }}"
                data-image="{{ $certImg }}"
                data-pdf="{{ $pdfUrl }}"
                data-url="{{ $credentialUrl }}">
                
                <div class="cert-thumb cert-preview-trigger" title="Klik untuk melihat pratinjau sertifikat">
                  <img src="{{ $certImg }}" alt="Sertifikat {{ $cert->title }}" loading="lazy" width="400" height="250" />
                  
                  <div class="cert-pill-badges">
                    @if(!empty($pdfUrl))
                      <span class="cert-pill-badge badge-pdf" title="Dokumen PDF Asli Tersedia"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</span>
                    @endif
                    @if(!empty($credentialUrl))
                      <span class="cert-pill-badge badge-online" title="Tautan Verifikasi Online Tersedia"><i class="bi bi-patch-check-fill"></i> Online</span>
                    @endif
                  </div>

                  <div class="cert-thumb-overlay">
                    <span class="cert-preview-badge-hover"><i class="bi bi-zoom-in"></i> Pratinjau Sertifikat</span>
                  </div>
                </div>

                <div class="cert-body">
                  <h4>{{ $cert->title }}</h4>
                  <p class="issuer"><i class="bi bi-building"></i> {{ $cert->issuer }}</p>
                  <div class="cert-foot">
                    <span class="cert-year"><i class="bi bi-calendar3"></i> {{ $certYear }}</span>
                    <button type="button" class="btn btn-ghost cert-preview-trigger" style="padding: 0.5rem 1rem">
                      <i class="bi bi-eye"></i> Lihat Sertifikat
                    </button>
                  </div>
                </div>
              </article>
            @endforeach
          @else
            <div class="glass reveal" style="grid-column: 1 / -1; padding: 3rem; text-align: center; border-radius: 1.5rem;">
              <i class="bi bi-award" style="font-size: 2.5rem; color: #94a3b8; display: block; margin-bottom: 0.75rem;"></i>
              <h4 style="font-size: 1.15rem; font-weight: 700; color: #1e293b;">Belum Ada Sertifikasi</h4>
              <p style="color: #64748b; font-size: 0.95rem; margin-top: 0.25rem;">Sertifikasi dan lisensi akan ditampilkan di sini setelah ditambahkan melalui dashboard admin.</p>
            </div>
          @endif
        </div>
      </div>
    </section>

    <!-- ===================== CERTIFICATE LIGHTBOX MODAL ===================== -->
    <div id="certLightboxModal" class="contact-modal-overlay" aria-hidden="true" role="dialog" aria-labelledby="certModalTitle">
      <div class="contact-modal-card glass cert-lightbox-card">
        <button type="button" class="contact-modal-close" id="btnCloseCertModal" aria-label="Tutup pratinjau" style="top: 1rem; right: 1.15rem; width: 34px; height: 34px; font-size: 1.45rem;">&times;</button>
        
        <div class="cert-modal-header">
          <span class="cert-modal-tag" id="certModalTag">
            <i class="bi bi-award-fill"></i> Sertifikasi &amp; Lisensi
          </span>
          <h3 id="certModalTitle" class="cert-modal-title">Judul Sertifikat</h3>
          <div class="cert-modal-meta">
            <span id="certModalIssuerWrap"><i class="bi bi-building"></i> <strong id="certModalIssuer">Penerbit</strong></span>
            <span class="meta-dot">•</span>
            <span id="certModalDateWrap"><i class="bi bi-calendar-check"></i> <span id="certModalDate">Tanggal</span></span>
          </div>
        </div>

        <div class="cert-modal-viewer">
          <img id="certModalImg" src="" alt="Pratinjau Sertifikat" class="cert-modal-img" />
        </div>

        <div class="cert-modal-footer">
          <div class="cert-modal-actions-left">
            <!-- Tombol Buka File PDF (hanya jika user mengunggah PDF) -->
            <a id="certModalPdfBtn" href="#" target="_blank" rel="noopener noreferrer" class="btn btn-outline" style="border-color: #fca5a5; color: #b91c1c; background: #fff1f2; gap: 0.45rem; padding: 0.5rem 1rem; font-size: 0.84rem;">
              <i class="bi bi-file-earmark-pdf-fill" style="color: #ef4444; font-size: 1rem;"></i> Buka File PDF
            </a>

            <!-- Tombol Verifikasi Online (hanya jika ada link URL) -->
            <a id="certModalUrlBtn" href="#" target="_blank" rel="noopener noreferrer" class="btn btn-primary" style="gap: 0.45rem; padding: 0.5rem 1.15rem; font-size: 0.84rem;">
              <i class="bi bi-patch-check-fill" style="font-size: 1rem;"></i> Verifikasi Online
            </a>

            <!-- Tombol Buka Gambar Penuh -->
            <a id="certModalFullImgBtn" href="#" target="_blank" rel="noopener noreferrer" class="btn btn-ghost" style="gap: 0.4rem; padding: 0.5rem 0.95rem; font-size: 0.84rem;">
              <i class="bi bi-arrows-fullscreen"></i> Gambar Penuh
            </a>
          </div>

          <div class="cert-modal-actions-right">
            <button type="button" class="btn btn-ghost" id="certModalCloseFooterBtn" style="padding: 0.5rem 1.15rem; font-size: 0.84rem;">
              Tutup
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Certificate Modal Interactivity Script -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("certLightboxModal");
        if (!modal) return;

        const btnClose = document.getElementById("btnCloseCertModal");
        const btnCloseFooter = document.getElementById("certModalCloseFooterBtn");
        const modalTitle = document.getElementById("certModalTitle");
        const modalIssuer = document.getElementById("certModalIssuer");
        const modalDate = document.getElementById("certModalDate");
        const modalImg = document.getElementById("certModalImg");
        const modalPdfBtn = document.getElementById("certModalPdfBtn");
        const modalUrlBtn = document.getElementById("certModalUrlBtn");
        const modalFullImgBtn = document.getElementById("certModalFullImgBtn");

        function openCertModal(data) {
          if (modalTitle) modalTitle.textContent = data.title || "Sertifikat";
          if (modalIssuer) modalIssuer.textContent = data.issuer || "Penyelenggara";
          if (modalDate) modalDate.textContent = data.date || ("Tahun " + (data.year || ""));

          if (modalImg) {
            modalImg.src = data.image || "";
            modalImg.alt = "Sertifikat " + (data.title || "");
          }

          if (modalFullImgBtn) {
            if (data.image) {
              modalFullImgBtn.href = data.image;
              modalFullImgBtn.style.display = "inline-flex";
            } else {
              modalFullImgBtn.style.display = "none";
            }
          }

          // PDF Button visibility
          if (modalPdfBtn) {
            if (data.pdf && data.pdf.trim() !== "" && data.pdf !== "#") {
              modalPdfBtn.href = data.pdf;
              modalPdfBtn.style.display = "inline-flex";
            } else {
              modalPdfBtn.style.display = "none";
            }
          }

          // Credential URL Button visibility
          if (modalUrlBtn) {
            if (data.url && data.url.trim() !== "" && data.url !== "#") {
              modalUrlBtn.href = data.url;
              modalUrlBtn.style.display = "inline-flex";
            } else {
              modalUrlBtn.style.display = "none";
            }
          }

          modal.classList.add("active");
          modal.setAttribute("aria-hidden", "false");
          document.body.style.overflow = "hidden";
        }

        function closeCertModal() {
          modal.classList.remove("active");
          modal.setAttribute("aria-hidden", "true");
          document.body.style.overflow = "";
        }

        // Attach event listeners to all triggers
        document.querySelectorAll(".cert-card").forEach(function (card) {
          const data = {
            title: card.getAttribute("data-title"),
            issuer: card.getAttribute("data-issuer"),
            date: card.getAttribute("data-date"),
            year: card.getAttribute("data-year"),
            image: card.getAttribute("data-image"),
            pdf: card.getAttribute("data-pdf"),
            url: card.getAttribute("data-url")
          };

          const triggers = card.querySelectorAll(".cert-preview-trigger");
          triggers.forEach(function (trigger) {
            trigger.addEventListener("click", function (e) {
              e.preventDefault();
              openCertModal(data);
            });
          });
        });

        if (btnClose) btnClose.addEventListener("click", closeCertModal);
        if (btnCloseFooter) btnCloseFooter.addEventListener("click", closeCertModal);

        // Click outside on backdrop
        modal.addEventListener("click", function (e) {
          if (e.target === modal) {
            closeCertModal();
          }
        });

        // Close on ESC key
        document.addEventListener("keydown", function (e) {
          if (e.key === "Escape" && modal.classList.contains("active")) {
            closeCertModal();
          }
        });
      });
    </script>
