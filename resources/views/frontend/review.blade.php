<!-- ===================== REVIEWS & TESTIMONIALS ===================== -->
<section id="reviews" style="background: #f8fafc; position: relative; overflow: hidden;">
  <div class="container">
    <div class="section-head reveal" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
      <span class="section-label">Testimoni &amp; Ulasan</span>
      <h2 class="section-title">Penilaian dari Klien &amp; Mitra</h2>
      <p class="section-subtitle">Tingkat kepuasan nyata dari para klien yang telah berkolaborasi dalam pengembangan website dan backend API.</p>
      
      <div style="margin-top: 1.25rem;">
        <button type="button" id="btnOpenReviewModal" class="btn btn-primary" style="gap: 0.5rem; box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);">
          <i class="bi bi-star-fill" style="color: #fbbf24;"></i> + Berikan Ulasan Anda
        </button>
      </div>
    </div>

    <!-- Reviews Grid -->
    <div class="reviews-grid">
      @forelse($reviews as $rev)
        <div class="glass review-card card-hover reveal">
          <div class="review-card-top">
            <div class="review-stars" aria-label="Rating: {{ $rev->rating }} dari 5 bintang">
              @for($i = 1; $i <= 5; $i++)
                <i class="bi {{ $i <= $rev->rating ? 'bi-star-fill star-active' : 'bi-star star-empty' }}"></i>
              @endfor
              <span class="review-score">{{ $rev->rating }}.0</span>
            </div>
            @if($rev->project_name)
              <span class="review-project-badge">
                <i class="bi bi-check2-circle"></i> {{ $rev->project_name }}
              </span>
            @endif
          </div>

          <p class="review-text">
            &ldquo;{{ $rev->review }}&rdquo;
          </p>

          <div class="review-author">
            <div class="review-avatar">
              {{ strtoupper(substr($rev->name, 0, 1)) }}
            </div>
            <div class="review-author-info">
              <h4 class="review-author-name">{{ $rev->name }}</h4>
              <p class="review-author-role">{{ $rev->company ?: 'Klien Terverifikasi' }}</p>
            </div>
          </div>
        </div>
      @empty
        <div class="glass reveal" style="grid-column: 1 / -1; padding: 3rem; text-align: center; border-radius: 1.5rem;">
          <i class="bi bi-chat-heart" style="font-size: 2.5rem; color: #94a3b8; display: block; margin-bottom: 0.75rem;"></i>
          <h4 style="font-size: 1.15rem; font-weight: 700; color: #1e293b;">Belum Ada Penilaian</h4>
          <p style="color: #64748b; font-size: 0.95rem; margin-top: 0.25rem;">Jadilah klien pertama yang memberikan ulasan hasil kerjasama!</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

<!-- Modal Popup Form Berikan Penilaian -->
<div id="reviewModal" class="contact-modal-overlay" aria-hidden="true" role="dialog" aria-labelledby="modalReviewTitle">
  <div class="contact-modal-card glass review-modal-card">
    <button type="button" class="contact-modal-close" id="btnCloseReviewModal" aria-label="Tutup popup" style="top: 0.75rem; right: 0.85rem; width: 34px; height: 34px; font-size: 1.4rem;">&times;</button>
    
    <!-- Compact Header (Horizontal) -->
    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding-right: 2.25rem;">
      <div style="width: 40px; height: 40px; border-radius: 12px; background: linear-gradient(135deg, #f59e0b, #fbbf24); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; box-shadow: 0 6px 16px -3px rgba(245, 158, 11, 0.45);">
        <i class="bi bi-star-fill"></i>
      </div>
      <div style="min-width: 0;">
        <h3 id="modalReviewTitle" style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0; line-height: 1.3;">Berikan Penilaian &amp; Ulasan</h3>
        <p style="font-size: 0.78rem; color: #64748b; margin: 0; margin-top: 0.15rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Bagikan kepuasan &amp; pengalaman Anda bekerja sama</p>
      </div>
    </div>

    <form id="reviewForm" action="{{ route('review.store') }}" method="POST">
      @csrf

      <div id="reviewAlertError" class="contact-alert-error" role="alert" style="margin-bottom: 0.75rem; font-size: 0.8rem; padding: 0.5rem 0.75rem;"></div>

      <!-- Compact Star Rating Selector -->
      <div style="text-align: center; margin-bottom: 0.85rem; background: #f8fafc; padding: 0.55rem 0.75rem; border-radius: 0.85rem; border: 1px solid #e2e8f0;">
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 0.4rem; flex-wrap: wrap;">
          <span style="font-size: 0.72rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">
            Tingkat Kepuasan:
          </span>
          <span id="starRatingLabel" style="font-size: 0.78rem; font-weight: 700; color: #d97706;">
            5.0 / 5.0 (Sangat Puas ⭐⭐⭐⭐⭐)
          </span>
        </div>
        <div id="starPicker" class="interactive-stars" style="display: inline-flex; gap: 0.35rem; font-size: 1.65rem; cursor: pointer; margin-top: 0.2rem;">
          <i class="bi bi-star-fill star-item active" data-rating="1"></i>
          <i class="bi bi-star-fill star-item active" data-rating="2"></i>
          <i class="bi bi-star-fill star-item active" data-rating="3"></i>
          <i class="bi bi-star-fill star-item active" data-rating="4"></i>
          <i class="bi bi-star-fill star-item active" data-rating="5"></i>
        </div>
        <input type="hidden" name="rating" id="reviewRatingInput" value="5" />
      </div>

      <!-- Responsive Form Grid -->
      <div class="review-form-grid">
        <div class="form-group" style="margin-bottom: 0;">
          <label for="reviewName" style="display: block; font-size: 0.76rem; font-weight: 600; color: #334155; margin-bottom: 0.25rem;">Nama Lengkap *</label>
          <input type="text" id="reviewName" name="name" class="form-control" style="font-size: 0.84rem; padding: 0.48rem 0.75rem; border-radius: 0.65rem; height: auto;" placeholder="Nama Anda" required />
        </div>
        <div class="form-group" style="margin-bottom: 0;">
          <label for="reviewCompany" style="display: block; font-size: 0.76rem; font-weight: 600; color: #334155; margin-bottom: 0.25rem;">Perusahaan / Jabatan</label>
          <input type="text" id="reviewCompany" name="company" class="form-control" style="font-size: 0.84rem; padding: 0.48rem 0.75rem; border-radius: 0.65rem; height: auto;" placeholder="Contoh: CEO PT ABC / Owner" />
        </div>
      </div>

      <div class="form-group" style="margin-bottom: 0.65rem;">
        <label for="reviewProject" style="display: block; font-size: 0.76rem; font-weight: 600; color: #334155; margin-bottom: 0.25rem;">Nama Proyek yang Dikerjakan</label>
        <input type="text" id="reviewProject" name="project_name" class="form-control" style="font-size: 0.84rem; padding: 0.48rem 0.75rem; border-radius: 0.65rem; height: auto;" placeholder="Contoh: Website Portofolio, REST API, E-Commerce" />
      </div>

      <div class="form-group" style="margin-bottom: 0.85rem;">
        <label for="reviewContent" style="display: block; font-size: 0.76rem; font-weight: 600; color: #334155; margin-bottom: 0.25rem;">Ulasan / Testimoni Anda *</label>
        <textarea id="reviewContent" name="review" class="form-control" rows="2" style="font-size: 0.84rem; padding: 0.5rem 0.75rem; border-radius: 0.65rem; min-height: 60px; max-height: 140px; resize: vertical;" placeholder="Tuliskan pengalaman Anda bekerja sama dengan {{ $profile->full_name ?? 'Ahmad Zaki' }}..." required></textarea>
      </div>

      <div style="display: flex; gap: 0.5rem; justify-content: flex-end; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 0.75rem;">
        <button type="button" id="btnCancelReview" class="btn btn-ghost" style="padding: 0.45rem 1rem; font-size: 0.82rem; height: 36px;">Batal</button>
        <button type="submit" id="reviewSubmitBtn" class="btn btn-primary" style="padding: 0.45rem 1.25rem; font-size: 0.82rem; height: 36px; min-width: 130px; justify-content: center;">
          <i class="bi bi-send-fill" id="reviewSubmitIcon"></i> <span id="reviewSubmitText">Kirim Penilaian</span>
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Popup Sukses Penilaian -->
<div id="reviewSuccessModal" class="contact-modal-overlay" aria-hidden="true" role="dialog">
  <div class="contact-modal-card glass" style="max-width: 400px; text-align: center; padding: 1.75rem 1.5rem 1.5rem;">
    <button type="button" class="contact-modal-close" id="btnCloseReviewSuccess" aria-label="Tutup popup" style="top: 0.75rem; right: 0.85rem; width: 32px; height: 32px; font-size: 1.4rem;">&times;</button>
    
    <div class="contact-modal-icon-wrap" style="margin-bottom: 1rem;">
      <div class="contact-modal-icon" style="width: 58px; height: 58px; font-size: 1.8rem; background: linear-gradient(135deg, #f59e0b, #fbbf24); box-shadow: 0 10px 24px -5px rgba(245, 158, 11, 0.5), 0 0 0 6px rgba(245, 158, 11, 0.15);">
        <i class="bi bi-award-fill"></i>
      </div>
    </div>
    
    <h3 class="contact-modal-title" style="font-size: 1.25rem; margin-bottom: 0.35rem;">Penilaian Diterima!</h3>
    <p class="contact-modal-desc" style="font-size: 0.88rem; line-height: 1.5; margin-bottom: 1.25rem;">
      Terima kasih banyak atas penilaian dan ulasan yang Anda berikan! Ulasan Anda telah berhasil dikirim dan akan segera ditampilkan di situs setelah diverifikasi oleh admin.
    </p>
    
    <div class="contact-modal-actions">
      <button type="button" class="btn btn-primary" id="btnOkReviewSuccess" style="min-width: 120px; height: 38px; font-size: 0.85rem; justify-content: center;">
        OK, Siap
      </button>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
  const btnOpenModal = document.getElementById("btnOpenReviewModal");
  const modal = document.getElementById("reviewModal");
  const btnCloseModal = document.getElementById("btnCloseReviewModal");
  const btnCancelReview = document.getElementById("btnCancelReview");
  const form = document.getElementById("reviewForm");
  const alertError = document.getElementById("reviewAlertError");
  const submitBtn = document.getElementById("reviewSubmitBtn");
  const submitIcon = document.getElementById("reviewSubmitIcon");
  const submitText = document.getElementById("reviewSubmitText");
  const ratingInput = document.getElementById("reviewRatingInput");
  const ratingLabel = document.getElementById("starRatingLabel");
  const starItems = document.querySelectorAll("#starPicker .star-item");

  const successModal = document.getElementById("reviewSuccessModal");
  const btnCloseSuccess = document.getElementById("btnCloseReviewSuccess");
  const btnOkSuccess = document.getElementById("btnOkReviewSuccess");

  const ratingDescriptions = {
    1: "1.0 / 5.0 (Kurang Puas ⭐)",
    2: "2.0 / 5.0 (Cukup Puas ⭐⭐)",
    3: "3.0 / 5.0 (Puas ⭐⭐⭐)",
    4: "4.0 / 5.0 (Sangat Puas ⭐⭐⭐⭐)",
    5: "5.0 / 5.0 (Sangat Puas ⭐⭐⭐⭐⭐)"
  };

  function updateStars(val) {
    if (ratingInput) ratingInput.value = val;
    if (ratingLabel) ratingLabel.textContent = ratingDescriptions[val] || (val + " Bintang");
    starItems.forEach(star => {
      const starRating = parseInt(star.getAttribute("data-rating"), 10);
      if (starRating <= val) {
        star.classList.add("active");
        star.classList.replace("bi-star", "bi-star-fill");
      } else {
        star.classList.remove("active");
        star.classList.replace("bi-star-fill", "bi-star");
      }
    });
  }

  starItems.forEach(star => {
    star.addEventListener("click", function () {
      const val = parseInt(this.getAttribute("data-rating"), 10);
      updateStars(val);
    });

    star.addEventListener("mouseenter", function () {
      const hoverVal = parseInt(this.getAttribute("data-rating"), 10);
      starItems.forEach(s => {
        const r = parseInt(s.getAttribute("data-rating"), 10);
        if (r <= hoverVal) {
          s.style.color = "#f59e0b";
        } else {
          s.style.color = "#cbd5e1";
        }
      });
    });

    star.addEventListener("mouseleave", function () {
      starItems.forEach(s => s.style.color = "");
    });
  });

  function openModal() {
    if (modal) {
      modal.classList.add("active");
      modal.setAttribute("aria-hidden", "false");
      document.body.style.overflow = "hidden";
    }
  }

  function closeModal() {
    if (modal) {
      modal.classList.remove("active");
      modal.setAttribute("aria-hidden", "true");
      document.body.style.overflow = "";
    }
  }

  function openSuccessModal() {
    if (successModal) {
      successModal.classList.add("active");
      successModal.setAttribute("aria-hidden", "false");
      document.body.style.overflow = "hidden";
    }
  }

  function closeSuccessModal() {
    if (successModal) {
      successModal.classList.remove("active");
      successModal.setAttribute("aria-hidden", "true");
      document.body.style.overflow = "";
    }
  }

  if (btnOpenModal) btnOpenModal.addEventListener("click", openModal);
  if (btnCloseModal) btnCloseModal.addEventListener("click", closeModal);
  if (btnCancelReview) btnCancelReview.addEventListener("click", closeModal);

  if (modal) {
    modal.addEventListener("click", function (e) {
      if (e.target === modal) closeModal();
    });
  }

  if (btnCloseSuccess) btnCloseSuccess.addEventListener("click", closeSuccessModal);
  if (btnOkSuccess) btnOkSuccess.addEventListener("click", closeSuccessModal);
  if (successModal) {
    successModal.addEventListener("click", function (e) {
      if (e.target === successModal) closeSuccessModal();
    });
  }

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      if (modal && modal.classList.contains("active")) closeModal();
      if (successModal && successModal.classList.contains("active")) closeSuccessModal();
    }
  });

  if (form) {
    form.addEventListener("submit", async function (e) {
      e.preventDefault();

      if (alertError) {
        alertError.style.display = "none";
        alertError.textContent = "";
      }

      if (submitBtn) {
        submitBtn.disabled = true;
        if (submitIcon) submitIcon.className = "bi bi-arrow-repeat spin-icon";
        if (submitText) submitText.textContent = "Menyimpan...";
      }

      const formData = new FormData(form);
      const actionUrl = form.getAttribute("action") || "/reviews";

      try {
        const response = await fetch(actionUrl, {
          method: "POST",
          headers: {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
          },
          body: formData,
        });

        const data = await response.json();

        if (response.ok && data.success) {
          form.reset();
          updateStars(5);
          closeModal();
          openSuccessModal();

          // Refresh page smoothly after 2.5s or on OK click so new review shows up
          if (btnOkSuccess) {
            btnOkSuccess.onclick = () => window.location.reload();
          }
        } else {
          const errMsg = data.message || "Terjadi kesalahan saat menyimpan penilaian. Silakan coba lagi.";
          if (alertError) {
            alertError.textContent = errMsg;
            alertError.style.display = "block";
          } else {
            alert(errMsg);
          }
        }
      } catch (err) {
        if (alertError) {
          alertError.textContent = "Koneksi bermasalah. Pastikan perangkat Anda terhubung ke internet.";
          alertError.style.display = "block";
        } else {
          alert("Koneksi bermasalah. Silakan coba lagi.");
        }
      } finally {
        if (submitBtn) {
          submitBtn.disabled = false;
          if (submitIcon) submitIcon.className = "bi bi-send-fill";
          if (submitText) submitText.textContent = "Kirim Penilaian";
        }
      }
    });
  }
});
</script>
@endpush
