import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {

    // ==========================================
    // BACK TO TOP
    // ==========================================

    const backToTop = document.getElementById("backToTop");

    if (backToTop) {

        window.addEventListener("scroll", () => {

            if (window.scrollY > 300) {
                backToTop.classList.add("show");
            } else {
                backToTop.classList.remove("show");
            }

        });

        backToTop.addEventListener("click", () => {

            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });

        });

    }


    // ==========================================
    // MOBILE MENU
    // ==========================================

    const menuToggle = document.getElementById("menuToggle");
    const mobileMenu = document.getElementById("mobileMenu");

    if (menuToggle && mobileMenu) {

        menuToggle.addEventListener("click", () => {

            const isOpen = mobileMenu.classList.toggle("active");

            menuToggle.setAttribute(
                "aria-expanded",
                String(isOpen)
            );

        });

        // Tutup mobile menu setelah memilih menu
        mobileMenu.querySelectorAll("a").forEach((link) => {

            link.addEventListener("click", () => {

                mobileMenu.classList.remove("active");

                menuToggle.setAttribute(
                    "aria-expanded",
                    "false"
                );

            });

        });

        // Tutup mobile menu dengan tombol Escape
        document.addEventListener("keydown", (event) => {

            if (event.key === "Escape") {

                mobileMenu.classList.remove("active");

                menuToggle.setAttribute(
                    "aria-expanded",
                    "false"
                );

            }

        });

    }


    // ==========================================
    // ACTIVE NAVBAR
    // ==========================================

    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".nav-links a");

    if (sections.length && navLinks.length) {

        const updateActiveNav = () => {

            const scrollPosition = window.scrollY + 150;

            let currentSection = "";

            sections.forEach((section) => {

                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;

                if (
                    scrollPosition >= sectionTop &&
                    scrollPosition < sectionTop + sectionHeight
                ) {

                    currentSection = section.id;

                }

            });


            // Hapus active dari semua menu
            navLinks.forEach((link) => {

                link.classList.remove("active");

            });


            // Tambahkan active ke menu yang sesuai
            if (currentSection) {

                navLinks.forEach((link) => {

                    if (
                        link.getAttribute("href") ===
                        `#${currentSection}`
                    ) {

                        link.classList.add("active");

                    }

                });

            }

        };


        // Jalankan ketika halaman di-scroll
        window.addEventListener(
            "scroll",
            updateActiveNav
        );


        // Jalankan sekali ketika halaman pertama kali dibuka
        updateActiveNav();

    }

    // ==========================================
    // LANGUAGE PROGRESS BAR
    // ==========================================

    const progressBars = document.querySelectorAll(".progress-fill");

    if (progressBars.length) {
        const progressObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry) => {
                    
                    if (entry.isIntersecting) {
                        const bar = entry.target;
                        const width = bar.getAttribute("data-width");

                        bar.style.width = width;
                        observer.unobserve(bar);
                    }
                });
            },
            {
                threshold: 0.3
            }
        );
        progressBars.forEach((bar) => {
            progressObserver.observe(bar);
        });
    }

    // ==========================================
    // HERO TYPEWRITER ANIMATION
    // ==========================================
    const typewriterEl = document.getElementById("heroTypewriter");
    if (typewriterEl && !typewriterEl.dataset.typewriterInitialized) {
        typewriterEl.dataset.typewriterInitialized = "true";

        let words = [];
        try {
            words = JSON.parse(typewriterEl.getAttribute("data-words")) || [];
        } catch (e) {
            words = [];
        }

        if (!words.length) {
            words = [typewriterEl.textContent.trim() || "PHP Laravel Backend Developer"];
        }

        let wordIndex = 0;
        let charIndex = typewriterEl.textContent.length;
        let isDeleting = true;
        const typeSpeed = 85;
        const deleteSpeed = 45;
        const holdAfterTyping = 2100;
        const pauseBeforeTyping = 380;

        const tick = () => {
            const currentWord = words[wordIndex % words.length];

            if (isDeleting) {
                charIndex--;
                typewriterEl.textContent = currentWord.substring(0, charIndex);
            } else {
                charIndex++;
                typewriterEl.textContent = currentWord.substring(0, charIndex);
            }

            let nextDelay = isDeleting ? deleteSpeed : typeSpeed;

            if (!isDeleting && charIndex === currentWord.length) {
                nextDelay = holdAfterTyping;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex++;
                nextDelay = pauseBeforeTyping;
            }

            setTimeout(tick, nextDelay);
        };

        setTimeout(tick, holdAfterTyping);
    }
});