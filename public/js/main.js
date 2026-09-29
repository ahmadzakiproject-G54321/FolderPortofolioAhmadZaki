// ============================================
// Portfolio interactions
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.getElementById("navbar");
  const menuToggle = document.getElementById("menuToggle");
  const mobileMenu = document.getElementById("mobileMenu");
  const backToTop = document.getElementById("backToTop");
  const navLinks = document.querySelectorAll(".nav-links a");
  const sections = document.querySelectorAll("section[id]");

  // ---- Current year ----
  const yearEl = document.getElementById("year");
  if (yearEl) yearEl.textContent = new Date().getFullYear();

  // ---- Navbar scroll state + back to top ----
  function onScroll() {
    if (window.scrollY > 40) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }

    if (window.scrollY > 400) {
      backToTop.classList.add("show");
    } else {
      backToTop.classList.remove("show");
    }

    // Active nav highlight
    let current = "";
    sections.forEach(function (section) {
      const top = section.offsetTop - 120;
      if (window.scrollY >= top) current = section.getAttribute("id");
    });
    navLinks.forEach(function (link) {
      link.classList.remove("active");
      if (link.getAttribute("href") === "#" + current) link.classList.add("active");
    });
  }
  window.addEventListener("scroll", onScroll);
  onScroll();

  // ---- Mobile menu toggle ----
  let menuOpen = false;
  function setMenu(open) {
    menuOpen = open;
    mobileMenu.style.display = open ? "flex" : "none";
    menuToggle.innerHTML = open
      ? '<i class="fa-solid fa-xmark"></i>'
      : '<i class="fa-solid fa-bars"></i>';
  }
  menuToggle.addEventListener("click", function () {
    setMenu(!menuOpen);
  });
  mobileMenu.querySelectorAll("a").forEach(function (link) {
    link.addEventListener("click", function () {
      setMenu(false);
    });
  });

  // ---- Back to top ----
  backToTop.addEventListener("click", function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  // ---- Scroll reveal + progress bars + counters ----
  const observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");

          // Animate any progress bars inside
          entry.target.querySelectorAll(".progress-fill").forEach(function (bar) {
            bar.style.width = bar.getAttribute("data-width");
          });

          // Animate counters
          entry.target.querySelectorAll("[data-count]").forEach(function (el) {
            animateCount(el);
          });

          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.15 }
  );

  document.querySelectorAll(".reveal").forEach(function (el) {
    observer.observe(el);
  });

  // Also observe standalone progress bars not wrapped in reveal
  document.querySelectorAll(".progress-fill").forEach(function (bar) {
    const wrapper = bar.closest(".reveal");
    if (!wrapper) {
      const o = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting) {
            bar.style.width = bar.getAttribute("data-width");
            o.unobserve(bar);
          }
        });
      });
      o.observe(bar);
    }
  });

  function animateCount(el) {
    const target = parseInt(el.getAttribute("data-count"), 10);
    const duration = 1600;
    const start = performance.now();
    function tick(now) {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.floor(eased * target) + (progress === 1 ? "+" : "");
      if (progress < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }

  // ---- Contact form submission with Modal Popup ----
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
      const actionUrl = contactForm.getAttribute("action") || "/contact";

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
          const errMsg = data.message || "Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.";
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
});
