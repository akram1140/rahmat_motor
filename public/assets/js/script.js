/**
 * Rahmat Motor - Website Multi-Page Interaktif
 * JavaScript untuk navigasi, scroll reveal, lightbox, dan interaksi lainnya.
 * Disesuaikan untuk multi-page PHP.
 */

(function () {
  'use strict';

  // ===================================================
  // NAVBAR - Scroll Effect & Active Link
  // ===================================================
  const navbar = document.getElementById('navbar');

  const navLinks = document.querySelectorAll('.navbar__link');
  const sections = document.querySelectorAll('section[id]');

  function updateActiveNavLink() {
    if (!sections.length) return;
    const scrollPos = window.scrollY + 140;

    sections.forEach(function (section) {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;
      const sectionId = section.getAttribute('id');

      if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
        navLinks.forEach(function (link) {
          const href = link.getAttribute('href');
          if (href === '#' + sectionId) {
            link.classList.add('active');
          } else if (href && href.startsWith('#')) {
            link.classList.remove('active');
          }
        });
        mobileMenuLinks.forEach(function (link) {
          const href = link.getAttribute('href');
          if (href === '#' + sectionId) {
            link.classList.add('active');
          } else if (href && href.startsWith('#')) {
            link.classList.remove('active');
          }
        });
      }
    });
  }

  window.addEventListener('scroll', function () {
    handleNavbarScroll();
    updateActiveNavLink();
  }, { passive: true });

  // ===================================================
  // MOBILE MENU - Hamburger Toggle
  // ===================================================
  const hamburgerBtn = document.getElementById('hamburger-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileMenuLinks = document.querySelectorAll('.mobile-menu__link');

  function toggleMobileMenu() {
    if (!hamburgerBtn || !mobileMenu) return;
    hamburgerBtn.classList.toggle('active');
    mobileMenu.classList.toggle('open');

    // Prevent body scroll when menu is open
    if (mobileMenu.classList.contains('open')) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }
  }

  function closeMobileMenu() {
    if (!hamburgerBtn || !mobileMenu) return;
    hamburgerBtn.classList.remove('active');
    mobileMenu.classList.remove('open');
    document.body.style.overflow = '';
  }

  if (hamburgerBtn) {
    hamburgerBtn.addEventListener('click', toggleMobileMenu);
  }

  mobileMenuLinks.forEach(function (link) {
    link.addEventListener('click', closeMobileMenu);
  });

  // Close mobile menu on CTA click
  var mobileCta = document.querySelector('.mobile-menu__cta');
  if (mobileCta) {
    mobileCta.addEventListener('click', function() {
      setTimeout(closeMobileMenu, 100);
    });
  }

  // Close mobile menu on escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeMobileMenu();
      closeLightbox();
    }
  });

  // ===================================================
  // SCROLL REVEAL - Intersection Observer
  // ===================================================
  function initScrollReveal() {
    var revealElements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-left, .scroll-reveal-right');

    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      });

      revealElements.forEach(function (el) {
        observer.observe(el);
      });
    } else {
      // Fallback for older browsers
      revealElements.forEach(function (el) {
        el.classList.add('revealed');
      });
    }
  }

  // ===================================================
  // GALLERY LIGHTBOX
  // ===================================================
  var lightbox = document.getElementById('lightbox');
  var lightboxImg = document.getElementById('lightbox-img');
  var lightboxClose = document.getElementById('lightbox-close');

  window.openLightbox = function (element) {
    var img = element.querySelector('img');
    if (img && lightbox && lightboxImg) {
      lightboxImg.src = img.src;
      lightboxImg.alt = img.alt;
      lightbox.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  };

  function closeLightbox() {
    if (lightbox) {
      lightbox.classList.remove('active');
      document.body.style.overflow = '';
      // Clear src after transition
      setTimeout(function () {
        if (!lightbox.classList.contains('active') && lightboxImg) {
          lightboxImg.src = '';
        }
      }, 300);
    }
  }

  if (lightboxClose) {
    lightboxClose.addEventListener('click', closeLightbox);
  }

  if (lightbox) {
    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox) {
        closeLightbox();
      }
    });
  }

  // ===================================================
  // SMOOTH SCROLL - Anchor Links (in-page only)
  // ===================================================
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var targetId = this.getAttribute('href');
      if (targetId === '#') return;

      var targetEl = document.querySelector(targetId);
      if (targetEl) {
        e.preventDefault();
        var navbarHeight = navbar ? navbar.offsetHeight : 72;
        var targetPosition = targetEl.getBoundingClientRect().top + window.pageYOffset - navbarHeight;

        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
      }
    });
  });

  // ===================================================
  // FORM VALIDATION HELPERS
  // ===================================================
  var forms = document.querySelectorAll('.form');
  forms.forEach(function(form) {
    var inputs = form.querySelectorAll('.form__input');
    inputs.forEach(function(input) {
      // Add visual feedback on blur
      input.addEventListener('blur', function() {
        if (this.required && !this.value.trim()) {
          this.style.borderColor = 'var(--color-accent)';
        } else {
          this.style.borderColor = '';
        }
      });
      // Reset on focus
      input.addEventListener('focus', function() {
        this.style.borderColor = '';
      });
    });
  });

  // ===================================================
  // INITIALIZATION
  // ===================================================
  document.addEventListener('DOMContentLoaded', function () {
    initScrollReveal();
    handleNavbarScroll();
    updateActiveNavLink();
  });

  // If DOM is already loaded
  if (document.readyState === 'interactive' || document.readyState === 'complete') {
    initScrollReveal();
    handleNavbarScroll();
    updateActiveNavLink();
  }

})();
