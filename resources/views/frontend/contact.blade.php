<!-- ===================== CONTACT ===================== -->
    <section id="contact" style="background: #eef4ff">
      <div class="container">
        <div class="section-head reveal">
          <span class="section-label">Kontak</span>
          <h2 class="section-title">Mari Berkolaborasi</h2>
          <p class="section-subtitle">Punya rencana proyek web atau membutuhkan {{ $profile->profession ?? 'Backend Developer' }}? Saya siap berdiskusi dengan Anda.</p>
        </div>

        <div class="contact-grid">
          <div class="glass contact-info reveal">
            <div class="contact-line">
              <div class="ci-icon"><i class="bi-solid bi-envelope"></i></div>
              <div><span class="label">Email</span><span class="value">{{ $profile->email ?? 'zaki081261514108@gmail.com' }}</span></div>
            </div>
            <div class="contact-line">
              <div class="ci-icon"><i class="bi-solid bi-phone"></i></div>
              <div><span class="label">Telepon</span><span class="value">{{ $profile->phone ?? '081261514108' }}</span></div>
            </div>
            <div class="contact-line">
              <div class="ci-icon"><i class="bi bi-whatsapp"></i></div>
              <div><span class="label">WhatsApp</span><span class="value">{{ $profile->whatsapp ?? '081261514108' }}</span></div>
            </div>
            <div class="contact-line">
              <div class="ci-icon"><i class="bi bi-github"></i></div>
              <div><span class="label">GitHub</span><span class="value">{{ !empty($profile->github) ? str_replace(['https://', 'http://'], '', $profile->github) : 'github.com/ahmadzakiproject' }}</span></div>
            </div>
            <div class="contact-line">
              <div class="ci-icon"><i class="bi bi-linkedin"></i></div>
              <div><span class="label">LinkedIn</span><span class="value">{{ !empty($profile->linkedin) ? str_replace(['https://', 'http://'], '', $profile->linkedin) : 'linkedin.com/in/ahmadzaki' }}</span></div>
            </div>
            @if(!empty($profile->instagram))
            <div class="contact-line">
              <div class="ci-icon"><i class="bi bi-instagram"></i></div>
              <div><span class="label">Instagram</span><span class="value">{{ str_replace(['https://', 'http://'], '', $profile->instagram) }}</span></div>
            </div>
            @endif
            <div class="map-interactive-wrap" style="margin-top: 1.5rem;">
              <iframe 
                src="{{ $profile->maps_iframe_url ?? 'https://maps.google.com/maps?q=' . urlencode($profile->address ?? 'Pesisir Selatan, Sumatera Barat') . '&t=&z=13&ie=UTF8&iwloc=&output=embed' }}" 
                title="Google Maps Lokasi"
                loading="lazy" 
                allowfullscreen 
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
              <div class="map-badge-overlay">
                <div style="display: flex; align-items: center; gap: 0.4rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                  <i class="bi bi-geo-alt-fill" style="font-size: 0.95rem; color: var(--primary);"></i>
                  <span style="font-weight: 600; color: #1e293b; font-size: 0.78rem;">{{ $profile->address ?? 'Pesisir Selatan, Sumatera Barat' }}</span>
                </div>
                <a href="https://maps.google.com/?q={{ urlencode($profile->address ?? 'Pesisir Selatan, Sumatera Barat') }}" target="_blank" rel="noopener noreferrer" style="font-size: 0.72rem; color: var(--primary); text-decoration: none; font-weight: 700; white-space: nowrap;">
                  Buka Maps <i class="bi bi-box-arrow-up-right" style="font-size: 0.7rem;"></i>
                </a>
              </div>
            </div>
          </div>

          <form class="glass contact-form reveal" id="contactForm" action="{{ route('contact.send') }}" method="POST">
            @csrf

            <div id="contactAlertError" class="contact-alert-error" role="alert"></div>

            <div class="form-row">
              <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Nama Anda" required />
              </div>
              <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="nama@example.com" required />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="phone">Nomor Telepon / WhatsApp</label>
                <input type="tel" id="phone" name="phone" class="form-control" placeholder="0812xxxxxxxx (opsional)" />
              </div>
              <div class="form-group">
                <label for="subject">Subjek</label>
                <input type="text" id="subject" name="subject" class="form-control" placeholder="Topik atau keperluan pesan..." required />
              </div>
            </div>
            <div class="form-group">
              <label for="message">Pesan</label>
              <textarea id="message" name="message" class="form-control" placeholder="Tuliskan pesan Anda secara detail..." rows="4" required></textarea>
            </div>
            <button type="submit" id="contactSubmitBtn" class="btn btn-primary" style="width: 100%; justify-content: center">
              <i class="bi bi-send-fill" id="contactSubmitIcon"></i> <span id="contactSubmitText">Kirim Pesan</span>
            </button>
          </form>
        </div>
      </div>
    </section>

    <!-- Modal Popup Ucapan Terima Kasih -->
    <div id="contactSuccessModal" class="contact-modal-overlay" aria-hidden="true" role="dialog" aria-labelledby="modalSuccessTitle">
      <div class="contact-modal-card glass">
        <button type="button" class="contact-modal-close" id="closeContactModal" aria-label="Tutup popup">&times;</button>
        
        <div class="contact-modal-icon-wrap">
          <div class="contact-modal-icon">
            <i class="bi bi-check-lg"></i>
          </div>
        </div>
        
        <h3 id="modalSuccessTitle" class="contact-modal-title">Pesan Terkirim!</h3>
        <p class="contact-modal-desc">
          Terima kasih! Pesan Anda telah dikirim.
        </p>
        
        <div class="contact-modal-actions">
          <button type="button" class="btn btn-primary" id="btnOkContactModal" style="min-width: 130px; justify-content: center;">
            OK, Siap
          </button>
        </div>
      </div>
    </div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
  const contactForm = document.getElementById("contactForm");
  const contactModal = document.getElementById("contactSuccessModal");
  const closeContactModal = document.getElementById("closeContactModal");
  const btnOkContactModal = document.getElementById("btnOkContactModal");
  const contactSubmitBtn = document.getElementById("contactSubmitBtn");
  const contactSubmitIcon = document.getElementById("contactSubmitIcon");
  const contactSubmitText = document.getElementById("contactSubmitText");
  const contactAlertError = document.getElementById("contactAlertError");

  function showModal() {
    if (contactModal) {
      contactModal.classList.add("active");
      contactModal.setAttribute("aria-hidden", "false");
      document.body.style.overflow = "hidden";
    }
  }

  function hideModal() {
    if (contactModal) {
      contactModal.classList.remove("active");
      contactModal.setAttribute("aria-hidden", "true");
      document.body.style.overflow = "";
    }
  }

  if (closeContactModal) closeContactModal.addEventListener("click", hideModal);
  if (btnOkContactModal) btnOkContactModal.addEventListener("click", hideModal);

  if (contactModal) {
    contactModal.addEventListener("click", function (e) {
      if (e.target === contactModal) {
        hideModal();
      }
    });
  }

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && contactModal && contactModal.classList.contains("active")) {
      hideModal();
    }
  });

  if (contactForm) {
    contactForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      if (contactAlertError) {
        contactAlertError.style.display = "none";
        contactAlertError.textContent = "";
      }

      // Button loading state
      if (contactSubmitBtn) {
        contactSubmitBtn.disabled = true;
        if (contactSubmitIcon) {
          contactSubmitIcon.className = "bi bi-arrow-repeat spin-icon";
        }
        if (contactSubmitText) {
          contactSubmitText.textContent = "Mengirim...";
        }
      }

      const formData = new FormData(contactForm);
      const actionUrl = contactForm.getAttribute("action") || "{{ route('contact.send') }}";

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
          contactForm.reset();
          showModal();
        } else {
          let errMsg = "Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.";
          if (data && data.message) {
            errMsg = data.message;
          } else if (data && data.errors) {
            const firstKey = Object.keys(data.errors)[0];
            if (firstKey && data.errors[firstKey].length > 0) {
              errMsg = data.errors[firstKey][0];
            }
          }
          if (contactAlertError) {
            contactAlertError.textContent = errMsg;
            contactAlertError.style.display = "block";
          } else {
            alert(errMsg);
          }
        }
      } catch (err) {
        if (contactAlertError) {
          contactAlertError.textContent = "Koneksi bermasalah. Pastikan perangkat Anda terhubung ke internet.";
          contactAlertError.style.display = "block";
        } else {
          alert("Koneksi bermasalah. Silakan coba lagi.");
        }
      } finally {
        // Reset button state
        if (contactSubmitBtn) {
          contactSubmitBtn.disabled = false;
          if (contactSubmitIcon) {
            contactSubmitIcon.className = "bi bi-send-fill";
          }
          if (contactSubmitText) {
            contactSubmitText.textContent = "Kirim Pesan";
          }
        }
      }
    });
  }

  @if(session('success'))
    showModal();
  @endif
});
</script>
@endpush
