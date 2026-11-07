/**
 * Rahmat Motor - Website Multi-Page Interaktif
 * High-Performance JavaScript: 60/120 FPS Optimized Scrolling & Smooth Interactions
 */

(function () {
  'use strict';

  // ===================================================
  // NAVBAR - High-FPS Scroll Effect & Active Link
  // ===================================================
  const navbar = document.getElementById('navbar');
  const navLinks = document.querySelectorAll('.navbar__link');
  const sections = document.querySelectorAll('section[id]');
  const mobileMenuLinks = document.querySelectorAll('.mobile-menu__link');

  let isNavbarScrolled = false;
  let scrollTicking = false;
  let sectionCache = [];

  // Cache section positions to avoid layout thrashing during scroll
  function updateSectionCache() {
    if (!sections.length) return;
    sectionCache = Array.from(sections).map(function (section) {
      const rect = section.getBoundingClientRect();
      const top = rect.top + window.pageYOffset;
      return {
        id: section.getAttribute('id'),
        top: top,
        bottom: top + section.offsetHeight
      };
    });
  }

  function handleNavbarScroll() {
    if (!navbar) return;
    const shouldBeScrolled = window.pageYOffset > 20;
    if (shouldBeScrolled !== isNavbarScrolled) {
      isNavbarScrolled = shouldBeScrolled;
      if (isNavbarScrolled) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    }
  }

  function updateActiveNavLink() {
    if (!sectionCache.length) return;
    const scrollPos = window.pageYOffset + 140;

    for (let i = 0; i < sectionCache.length; i++) {
      const sec = sectionCache[i];
      if (scrollPos >= sec.top && scrollPos < sec.bottom) {
        navLinks.forEach(function (link) {
          const href = link.getAttribute('href');
          if (href === '#' + sec.id) {
            link.classList.add('active');
          } else if (href && href.startsWith('#')) {
            link.classList.remove('active');
          }
        });
        mobileMenuLinks.forEach(function (link) {
          const href = link.getAttribute('href');
          if (href === '#' + sec.id) {
            link.classList.add('active');
          } else if (href && href.startsWith('#')) {
            link.classList.remove('active');
          }
        });
        break;
      }
    }
  }

  // Ultra-smooth requestAnimationFrame scroll handler
  window.addEventListener('scroll', function () {
    if (!scrollTicking) {
      window.requestAnimationFrame(function () {
        handleNavbarScroll();
        updateActiveNavLink();
        scrollTicking = false;
      });
      scrollTicking = true;
    }
  }, { passive: true });

  // Update position cache on resize & orientation change
  window.addEventListener('resize', function () {
    updateSectionCache();
  }, { passive: true });

  // ===================================================
  // MOBILE MENU - Hamburger Toggle
  // ===================================================
  const hamburgerBtn = document.getElementById('hamburger-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  function toggleMobileMenu() {
    if (!hamburgerBtn || !mobileMenu) return;
    hamburgerBtn.classList.toggle('active');
    mobileMenu.classList.toggle('open');

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

  const mobileCta = document.querySelector('.mobile-menu__cta');
  if (mobileCta) {
    mobileCta.addEventListener('click', function() {
      setTimeout(closeMobileMenu, 100);
    });
  }

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeMobileMenu();
      closeLightbox();
    }
  });

  // ===================================================
  // SCROLL REVEAL - Intersection Observer (GPU-Optimized)
  // ===================================================
  function initScrollReveal() {
    const revealElements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-left, .scroll-reveal-right');
    if (!revealElements.length) return;

    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.05,
        rootMargin: '0px 0px 40px 0px'
      });

      revealElements.forEach(function (el) {
        observer.observe(el);
      });
    } else {
      revealElements.forEach(function (el) {
        el.classList.add('revealed');
      });
    }
  }

  // ===================================================
  // GALLERY LIGHTBOX
  // ===================================================
  const lightbox = document.getElementById('lightbox');
  const lightboxImg = document.getElementById('lightbox-img');
  const lightboxClose = document.getElementById('lightbox-close');

  window.openLightbox = function (element) {
    const img = element.querySelector('img');
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
  // SMOOTH SCROLL - Anchor Links
  // ===================================================
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#' || !targetId) return;

      const targetEl = document.querySelector(targetId);
      if (targetEl) {
        e.preventDefault();
        const navbarHeight = navbar ? navbar.offsetHeight : 72;
        const targetPosition = targetEl.getBoundingClientRect().top + window.pageYOffset - navbarHeight + 2;

        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
      }
    });
  });

  // ===================================================
  // HOLOCARD & HOLOGRAPHIC SHADER ANIMATION (React Bits)
  // Interactive 3D Tilt Spring Physics + WebGL2 Foil
  // ===================================================
  const HOLO_PRESETS = ['bursts', 'stars', 'shards', 'cosmos', 'rainbow', 'swirl', 'glitter', 'gold', 'glass', 'none'];
  const HOLO_PERSPECTIVE = 1100;

  const HOLO_VERTEX = `#version 300 es
in vec2 position;
void main() {
  gl_Position = vec4(position, 0.0, 1.0);
}
`;

  const HOLO_FRAGMENT = `#version 300 es
precision highp float;

uniform sampler2D uArt;
uniform vec2 uSize;
uniform float uAspect;
uniform vec2 uTilt;
uniform vec2 uLight;
uniform float uDistance;
uniform int uPreset;
uniform float uIntensity;
uniform float uScale;
uniform float uEdge;
uniform float uFrame;
uniform float uRadius;
uniform float uGlare;
uniform vec3 uFoil;
uniform float uReady;

out vec4 outColor;

const float TAU = 6.28318530718;

struct Foil {
  float mask;
  float angle;
  float jitter;
  vec2 facet;
};

float hash(vec2 p) {
  p = fract(p * vec2(234.34, 435.345));
  p += dot(p, p + 34.23);
  return fract(p.x * p.y);
}

vec2 hash2(vec2 p) {
  return vec2(hash(p), hash(p + 17.31));
}

vec3 hue(float t) {
  // Tanpa warna pelangi: pantulan kilau cahaya perak/putih monokrom yang elegan
  return vec3(0.95, 0.96, 1.0);
}

Foil bursts(vec2 p) {
  vec2 q = mat2(0.7071068, 0.7071068, -0.7071068, 0.7071068) * (p - vec2(0.5, 0.5 * uAspect)) / (0.283 / uScale);
  vec2 d = fract(q) - 0.5;
  float u = length(d) / 0.49;
  float angle = atan(d.y, d.x);
  if (u < 0.12) {
    float ring = min(floor(u / 0.045 + 0.5), 2.0);
    float count = max(1.0, ring * 6.0);
    float spot = (floor(angle / TAU * count) + 0.5) / count * TAU;
    vec2 dot = vec2(cos(spot), sin(spot)) * ring * 0.045;
    float m = smoothstep(0.024, 0.012, length(d / 0.49 - dot));
    return Foil(m, angle, 0.5, vec2(0.0));
  }
  bool inner = u < 0.66;
  float slot = angle / TAU * (inner ? 56.0 : 72.0);
  bool shifted = mod(floor(slot), 2.0) > 0.5;
  vec2 band = inner ? (shifted ? vec2(0.45, 0.61) : vec2(0.33, 0.49)) : (shifted ? vec2(0.84, 0.99) : vec2(0.7, 0.85));
  float across = abs(u - (band.x + band.y) * 0.5) / ((band.y - band.x) * 0.5);
  float along = abs(fract(slot) - 0.5) * 2.0;
  float width = inner ? 0.72 : 0.6;
  float m = smoothstep(1.0, 0.78, across) * smoothstep(width, width - 0.2, along);
  return Foil(m, angle, 0.5, vec2(0.0));
}

Foil stars(vec2 p) {
  Foil best = Foil(0.0, 0.0, 0.0, vec2(0.0));
  vec2 g = p / (0.08 / uScale);
  vec2 base = floor(g);
  for (int j = -1; j <= 1; j++) {
    for (int i = -1; i <= 1; i++) {
      vec2 id = base + vec2(float(i), float(j));
      float pick = hash(id + 1.3);
      vec2 d = g - (id + 0.5 + (hash2(id) - 0.5) * 0.55);
      float m = smoothstep(0.07, 0.035, length(d));
      if (pick < 0.62) {
        float size = mix(0.16, 0.5, pow(hash(id + 9.0), 1.8));
        float sector = TAU / (pick < 0.3 ? 4.0 : 5.0);
        float k = abs(fract((atan(d.y, d.x) + hash(id + 4.0) * TAU) / sector) - 0.5) * 2.0;
        float edge = size * mix(1.0, 0.36, pow(k, 0.6));
        m = smoothstep(edge, edge * 0.8, length(d));
      }
      if (m > best.mask) best = Foil(m, hash(id + 6.0) * TAU, hash(id + 8.0), (hash2(id + 2.0) - 0.5) * 0.6);
    }
  }
  return best;
}

Foil shards(vec2 p) {
  vec2 g = p * 19.0 * uScale;
  vec2 base = floor(g);
  float best = 9.0;
  float second = 9.0;
  vec2 id = base;
  for (int j = -1; j <= 1; j++) {
    for (int i = -1; i <= 1; i++) {
      vec2 cell = base + vec2(float(i), float(j));
      float d = length(cell + 0.08 + hash2(cell) * 0.84 - g);
      if (d < best) {
        second = best;
        best = d;
        id = cell;
      } else if (d < second) {
        second = d;
      }
    }
  }
  float crack = smoothstep(0.015, 0.07, second - best);
  float shine = 0.25 + 0.75 * pow(hash(id + 7.7), 2.0);
  return Foil((0.2 + 0.8 * crack) * shine, hash(id + 3.17) * TAU, hash(id + 11.73), (hash2(id + 5.0) - 0.5) * 0.5);
}

Foil cosmos(vec2 p) {
  Foil best = Foil(0.0, 0.0, 0.0, vec2(0.0));
  vec2 g = p / (0.16 / uScale);
  vec2 base = floor(g);
  for (int j = -1; j <= 1; j++) {
    for (int i = -1; i <= 1; i++) {
      vec2 id = base + vec2(float(i), float(j));
      vec2 d = g - (id + 0.5 + (hash2(id) - 0.5) * 0.7);
      float size = mix(0.16, 0.52, hash(id + 2.0));
      float r = length(d);
      float m = max(smoothstep(0.05, 0.0, abs(r - size)), smoothstep(size, size - 0.04, r) * 0.22);
      if (m > best.mask) best = Foil(m, hash(id + 6.0) * TAU + atan(d.y, d.x) * 0.5, hash(id + 1.0), (hash2(id + 4.0) - 0.5) * 0.5);
    }
  }
  vec2 fine = p / (0.035 / uScale);
  vec2 cell = floor(fine);
  float dots = smoothstep(0.2, 0.1, length(fine - cell - 0.5 - (hash2(cell + 9.0) - 0.5) * 0.6)) * step(0.55, hash(cell + 2.0));
  if (dots > best.mask) best = Foil(dots, hash(cell) * TAU, hash(cell + 3.0), (hash2(cell + 7.0) - 0.5) * 0.6);
  return best;
}

Foil rainbow(vec2 p) {
  return Foil(0.86 + 0.14 * hash(floor(p * 700.0 * uScale)), 0.2, 0.5, vec2(0.0));
}

Foil swirl(vec2 p) {
  vec2 d = p - vec2(0.5, 0.42 * uAspect);
  float angle = atan(d.y, d.x);
  float rays = 0.55 + 0.45 * smoothstep(0.3, 0.7, abs(fract(angle / TAU * 60.0 * uScale) - 0.5) * 2.0);
  return Foil(rays, angle, length(d), vec2(0.0));
}

Foil glitter(vec2 p) {
  vec2 g = p * 72.0 * uScale;
  vec2 cell = floor(g);
  float size = mix(0.18, 0.4, hash(cell + 3.0));
  float m = smoothstep(size, size * 0.55, length(fract(g) - 0.5 - (hash2(cell) - 0.5) * 0.5)) * step(0.25, hash(cell + 5.0));
  return Foil(m, hash(cell + 7.0) * TAU, hash(cell + 9.0), (hash2(cell + 11.0) - 0.5) * 0.9);
}

Foil gold(vec2 p) {
  Foil flake = glitter(p * 0.8);
  if (flake.mask > 0.5) return flake;
  float etch = 0.55 + 0.45 * smoothstep(0.2, 0.8, abs(fract((p.x * 0.6 + p.y) * 140.0 * uScale) - 0.5) * 2.0);
  return Foil(etch, 0.9, 0.4, vec2(0.0));
}

vec3 sparkles(vec2 p, vec3 halfway, vec2 sweep, float awake) {
  vec2 g = p * 62.0;
  vec2 cell = floor(g);
  vec2 d = fract(g) - 0.5 - (hash2(cell) - 0.5) * 0.36;
  float spin = hash(cell + 3.0) * TAU;
  d = mat2(cos(spin), -sin(spin), sin(spin), cos(spin)) * d;
  vec2 a = abs(d);
  float hexagon = max(a.x * 0.866 + a.y * 0.5, a.y);
  float size = mix(0.22, 0.38, hash(cell + 2.0));
  float piece = smoothstep(size, size - 0.07, hexagon) * step(0.42, hash(cell + 4.0));
  vec3 facet = normalize(vec3((hash2(cell + 6.0) - 0.5) * 0.9, 1.0));
  float flash = pow(max(dot(facet, halfway), 0.0), 6.0);
  vec3 tint = vec3(0.95, 0.96, 1.0);
  vec3 color = piece * tint * (0.3 + 1.6 * flash) * awake;
  vec2 fine = p * 210.0;
  vec2 speckCell = floor(fine);
  float speck = smoothstep(0.24, 0.0, length(fract(fine) - 0.5 - (hash2(speckCell) - 0.5) * 0.5)) * step(0.72, hash(speckCell + 1.0));
  float speckFlash = pow(max(dot(normalize(vec3((hash2(speckCell + 2.0) - 0.5) * 0.9, 1.0)), halfway), 0.0), 10.0);
  return color + vec3(1.2) * speck * speckFlash * (1.0 - piece);
}

void main() {
  vec2 uv = vec2(gl_FragCoord.x / uSize.x, 1.0 - gl_FragCoord.y / uSize.y);
  vec2 p = vec2(uv.x, uv.y * uAspect);
  vec2 center = vec2(0.5, 0.5 * uAspect);
  vec2 q = abs(p - center) - center + uRadius;
  float outside = length(max(q, 0.0)) + min(max(q.x, q.y), 0.0) - uRadius;
  float pixel = 1.0 / uSize.x;
  float alpha = clamp(0.5 - outside / pixel, 0.0, 1.0);
  if (alpha <= 0.0) {
    outColor = vec4(0.0);
    return;
  }

  mat3 rx = mat3(1.0, 0.0, 0.0, 0.0, cos(uTilt.x), sin(uTilt.x), 0.0, -sin(uTilt.x), cos(uTilt.x));
  mat3 ry = mat3(cos(uTilt.y), 0.0, -sin(uTilt.y), 0.0, 1.0, 0.0, sin(uTilt.y), 0.0, cos(uTilt.y));
  mat3 turn = rx * ry;
  vec3 world = turn * vec3(p - center, 0.0);
  vec3 view = normalize(transpose(turn) * (vec3(0.0, 0.0, uDistance) - world));
  vec3 lamp = vec3((uLight - 0.5) * vec2(1.1, 1.1 * uAspect), 0.9);
  vec3 light = normalize(transpose(turn) * (lamp - world));
  vec3 halfway = normalize(light + view);
  vec2 sweep = light.xy + view.xy;
  float sheen = pow(max(halfway.z, 0.0), 10.0);
  float shine = pow(max(halfway.z, 0.0), 80.0);
  float frame = 1.0 - smoothstep(uFrame - pixel, uFrame + pixel, -outside);

  Foil f;
  if (uPreset == 0) f = bursts(p);
  else if (uPreset == 1) f = stars(p);
  else if (uPreset == 2) f = shards(p);
  else if (uPreset == 3) f = cosmos(p);
  else if (uPreset == 4) f = rainbow(p);
  else if (uPreset == 5) f = swirl(p);
  else if (uPreset == 6) f = glitter(p);
  else if (uPreset == 7) f = gold(p);
  else f = Foil(0.0, 0.0, 0.0, vec2(0.0));

  vec3 metal = uPreset == 7 ? vec3(1.0, 0.85, 0.5) * dot(uFoil, vec3(0.3333)) * 1.15 : uFoil;
  vec4 look = uPreset == 0 ? vec4(0.25, 1.9, 0.12, 1.0)
    : uPreset == 1 ? vec4(0.6, 1.4, 0.3, 1.0)
    : uPreset == 2 ? vec4(0.9, 0.9, 0.6, 0.5)
    : uPreset == 3 ? vec4(0.7, 1.2, 0.35, 0.85)
    : uPreset == 4 ? vec4(0.0, 2.2, 0.0, 0.45)
    : uPreset == 5 ? vec4(1.6, 0.3, 0.0, 0.4)
    : uPreset == 6 ? vec4(0.9, 1.0, 0.6, 1.0)
    : vec4(0.3, 1.0, 0.2, 0.95);
  vec2 dir = vec2(cos(f.angle), sin(f.angle));
  float phase = dot(sweep, dir) * look.x + dot(sweep, vec2(0.8, 0.6)) * look.y + f.jitter * look.z;
  float spoke = 1.0;
  if (uPreset == 5) {
    float facing = dot(normalize(sweep + 0.0001), dir);
    phase = f.jitter * 2.4 + facing * 0.6 + length(sweep) * 0.8;
    spoke = 0.3 + 0.7 * smoothstep(0.25, 0.95, abs(facing));
  }
  vec3 tint = hue(phase);
  if (uPreset == 7) tint = mix(tint, metal, 0.65);
  float glint = pow(max(dot(normalize(vec3(f.facet, 1.0)), halfway), 0.0), 24.0) * step(0.001, length(f.facet));
  bool layered = uPreset == 2 || uPreset == 4 || uPreset == 5 || uPreset == 7;
  vec3 foil = (layered ? tint : mix(tint, vec3(1.0), 0.12)) * (1.15 + 0.3 * sheen) + metal * glint * 1.2;
  float tilted = smoothstep(0.02, 0.21, length(sin(uTilt)));
  float awake = mix(0.2, 1.0, tilted);
  float strength = uIntensity * f.mask * (1.0 - frame) * awake;
  float band = uPreset == 5 ? spoke : layered ? 0.25 + 0.75 * smoothstep(0.3, 0.95, 0.5 + 0.5 * cos(phase * TAU * 0.5 + 1.3)) : 1.0;

  // Pure lighting & reflection overlay (mix-blend-mode: screen over sharp native <img>)
  vec3 color = foil * clamp(strength * look.w * band, 0.0, 1.0);
  color += sparkles(p, halfway, sweep, mix(0.55, 1.0, tilted)) * uEdge * frame;
  color += uFoil * sheen * 0.12 * frame;
  color += vec3(sheen * 0.18 + shine * 0.55) * uGlare;
  color = clamp(color, 0.0, 1.0);
  outColor = vec4(color * alpha, alpha);
}
`;

  function holoClamp(value, min, max) {
    return Math.min(max, Math.max(min, value));
  }

  function holoParseColor(value) {
    const fallback = [0.88, 0.90, 0.94];
    if (typeof document === 'undefined') return fallback;
    const ctx = document.createElement('canvas').getContext('2d');
    if (!ctx) return fallback;
    ctx.fillStyle = '#000000';
    ctx.fillStyle = value;
    const resolved = ctx.fillStyle;
    if (!resolved.startsWith('#') || resolved.length !== 7) return fallback;
    return [1, 3, 5].map(i => Math.pow(parseInt(resolved.slice(i, i + 2), 16) / 255, 2.2));
  }

  function holoCompile(gl, type, source) {
    const shader = gl.createShader(type);
    if (!shader) return null;
    gl.shaderSource(shader, source);
    gl.compileShader(shader);
    if (gl.getShaderParameter(shader, gl.COMPILE_STATUS)) return shader;
    gl.deleteShader(shader);
    return null;
  }

  function holoSpring(value, velocity, target, stiffness, damping, dt) {
    const next = velocity + ((target - value) * stiffness - velocity * damping) * dt;
    return [value + next * dt, next];
  }

  function initHoloCard(root, opts) {
    if (!root || root._holoCardInit) return;
    root._holoCardInit = true;
    opts = opts || {};

    let shadow = root.querySelector('.holo-card__shadow');
    let rotor = root.querySelector('.holo-card__rotor');
    let face = root.querySelector('.holo-card__face--front');
    let img = root.querySelector('img');
    let badge = root.querySelector('.about__experience-badge');
    let canvas = root.querySelector('.holo-card__canvas');

    if (!rotor) {
      root.classList.add('holo-card');

      shadow = document.createElement('span');
      shadow.className = 'holo-card__shadow';
      shadow.setAttribute('aria-hidden', 'true');
      root.appendChild(shadow);

      rotor = document.createElement('div');
      rotor.className = 'holo-card__rotor';

      face = document.createElement('div');
      face.className = 'holo-card__face holo-card__face--front';

      if (img) {
        face.appendChild(img);
      }

      canvas = document.createElement('canvas');
      canvas.className = 'holo-card__canvas';
      face.appendChild(canvas);

      rotor.appendChild(face);

      // Keep badge inside rotor for 3D parallax depth
      if (badge) {
        rotor.appendChild(badge);
      }

      root.appendChild(rotor);
    } else {
      root.classList.add('holo-card');
      if (!canvas && face) {
        canvas = document.createElement('canvas');
        canvas.className = 'holo-card__canvas';
        face.appendChild(canvas);
      }
    }

    const presetName = opts.preset || root.dataset.preset || 'glass';
    const isGlass = presetName === 'glass' || presetName === 'none';
    let presetIdx = HOLO_PRESETS.indexOf(presetName);
    if (presetIdx === -1) presetIdx = HOLO_PRESETS.indexOf('glass');
    if (presetIdx === -1) presetIdx = 8;

    const settings = {
      preset: presetIdx,
      intensity: holoClamp(opts.intensity !== undefined ? opts.intensity : (root.dataset.intensity !== undefined ? parseFloat(root.dataset.intensity) : (isGlass ? 0 : 0.2)), 0, 1),
      scale: holoClamp(opts.scale !== undefined ? opts.scale : 1.1, 0.25, 4),
      edgeSparkle: holoClamp(opts.edgeSparkle !== undefined ? opts.edgeSparkle : 0.8, 0, 1),
      frame: holoClamp(opts.frame !== undefined ? opts.frame : 0, 0, 20) / 100,
      glare: holoClamp(opts.glare !== undefined ? opts.glare : (root.dataset.glare !== undefined ? parseFloat(root.dataset.glare) : 0.8), 0, 1),
      foil: holoParseColor(opts.foilColor || '#e2e6ec'),
      radius: Math.max(0, opts.radius !== undefined ? opts.radius : 24),
      tiltMax: holoClamp(opts.tiltMax !== undefined ? opts.tiltMax : 14, 0, 45),
      hoverScale: holoClamp(opts.hoverScale !== undefined ? opts.hoverScale : 1.04, 0.8, 1.3),
      idle: opts.idle !== false
    };

    const reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let gl = null;
    let program = null;
    let texture = null;
    let buffer = null;
    const uniforms = {};
    let textureReady = false;

    if (canvas) {
      try {
        gl = canvas.getContext('webgl2', { alpha: true, premultipliedAlpha: true, antialias: false });
      } catch (err) {
        gl = null;
      }
    }

    if (gl) {
      const vertex = holoCompile(gl, gl.VERTEX_SHADER, HOLO_VERTEX);
      const fragment = holoCompile(gl, gl.FRAGMENT_SHADER, HOLO_FRAGMENT);
      if (vertex && fragment) {
        program = gl.createProgram();
        gl.attachShader(program, vertex);
        gl.attachShader(program, fragment);
        gl.bindAttribLocation(program, 0, 'position');
        gl.linkProgram(program);
        gl.deleteShader(vertex);
        gl.deleteShader(fragment);
        if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
          gl.deleteProgram(program);
          program = null;
        }
      }

      if (program) {
        buffer = gl.createBuffer();
        gl.bindBuffer(gl.ARRAY_BUFFER, buffer);
        gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, 3, -1, -1, 3]), gl.STATIC_DRAW);
        gl.enableVertexAttribArray(0);
        gl.vertexAttribPointer(0, 2, gl.FLOAT, false, 0, 0);

        texture = gl.createTexture();
        gl.bindTexture(gl.TEXTURE_2D, texture);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR_MIPMAP_LINEAR);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
        gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, 1, 1, 0, gl.RGBA, gl.UNSIGNED_BYTE, new Uint8Array([0, 0, 0, 0]));

        const uniformNames = [
          'uArt', 'uSize', 'uAspect', 'uTilt', 'uLight', 'uDistance',
          'uPreset', 'uIntensity', 'uScale', 'uEdge', 'uFrame',
          'uRadius', 'uGlare', 'uFoil', 'uReady'
        ];
        uniformNames.forEach(function (name) {
          uniforms[name] = gl.getUniformLocation(program, name);
        });
        root.setAttribute('data-ready', '');
      }
    }

    const state = {
      tiltX: 0,
      tiltY: 0,
      tiltVX: 0,
      tiltVY: 0,
      lightX: 0.36,
      lightY: 0.26,
      lightVX: 0,
      lightVY: 0,
      lift: 1,
      liftV: 0,
      clock: Math.random() * 40
    };

    const pointer = { x: 0.5, y: 0.5, inside: false };
    let raf = 0;
    let last = 0;
    let visible = true;
    let calm = 0;

    function draw() {
      if (!gl || !program || !canvas) return;
      const w = canvas.width;
      const h = canvas.height;
      if (!w || !h) return;
      gl.viewport(0, 0, w, h);
      gl.clearColor(0, 0, 0, 0);
      gl.clear(gl.COLOR_BUFFER_BIT);
      gl.useProgram(program);
      gl.activeTexture(gl.TEXTURE0);
      gl.bindTexture(gl.TEXTURE_2D, texture);
      gl.uniform1i(uniforms.uArt, 0);
      gl.uniform2f(uniforms.uSize, w, h);
      gl.uniform1f(uniforms.uAspect, h / w);
      gl.uniform2f(uniforms.uTilt, (state.tiltX * Math.PI) / 180, (state.tiltY * Math.PI) / 180);
      gl.uniform2f(uniforms.uLight, state.lightX, state.lightY);
      gl.uniform1f(uniforms.uDistance, HOLO_PERSPECTIVE / Math.max(1, canvas.clientWidth));
      gl.uniform1i(uniforms.uPreset, settings.preset);
      gl.uniform1f(uniforms.uIntensity, settings.intensity);
      gl.uniform1f(uniforms.uScale, settings.scale);
      gl.uniform1f(uniforms.uEdge, settings.edgeSparkle);
      gl.uniform1f(uniforms.uFrame, settings.frame);
      gl.uniform1f(uniforms.uRadius, settings.radius / Math.max(1, canvas.clientWidth));
      gl.uniform1f(uniforms.uGlare, settings.glare);
      gl.uniform3f(uniforms.uFoil, settings.foil[0], settings.foil[1], settings.foil[2]);
      gl.uniform1f(uniforms.uReady, textureReady ? 1 : 0);
      gl.drawArrays(gl.TRIANGLES, 0, 3);
    }

    function tick(now) {
      raf = 0;
      const dt = Math.min(1 / 30, Math.max(1 / 240, (now - last) / 1000));
      last = now;

      let targetX = 0;
      let targetY = 0;
      let lightX = 0.36;
      let lightY = 0.26;
      let lift = 1;
      const drifting = settings.idle && !reduce && !pointer.inside;

      if (pointer.inside && !reduce) {
        targetX = (0.5 - pointer.y) * 2 * settings.tiltMax;
        targetY = (pointer.x - 0.5) * 2 * settings.tiltMax;
        lightX = pointer.x;
        lightY = pointer.y;
        lift = settings.hoverScale;
      } else if (drifting) {
        state.clock += dt;
        const t = state.clock;
        targetX = Math.sin(t * 0.7) * settings.tiltMax * 0.28;
        targetY = Math.sin(t * 0.53 + 1.2) * settings.tiltMax * 0.4;
        lightX = 0.5 + Math.sin(t * 0.41) * 0.42;
        lightY = 0.38 + Math.sin(t * 0.33 + 0.6) * 0.3;
      }

      const steps = Math.ceil(dt / (1 / 240));
      const h = dt / steps;
      for (let i = 0; i < steps; i++) {
        const sX = holoSpring(state.tiltX, state.tiltVX, targetX, 150, 16, h);
        state.tiltX = sX[0]; state.tiltVX = sX[1];

        const sY = holoSpring(state.tiltY, state.tiltVY, targetY, 150, 16, h);
        state.tiltY = sY[0]; state.tiltVY = sY[1];

        const sLX = holoSpring(state.lightX, state.lightVX, lightX, 220, 30, h);
        state.lightX = sLX[0]; state.lightVX = sLX[1];

        const sLY = holoSpring(state.lightY, state.lightVY, lightY, 220, 30, h);
        state.lightY = sLY[0]; state.lightVY = sLY[1];

        const sL = holoSpring(state.lift, state.liftV, lift, 320, 30, h);
        state.lift = sL[0]; state.liftV = sL[1];
      }

      rotor.style.transform = `perspective(${HOLO_PERSPECTIVE}px) scale(${state.lift}) rotateX(${state.tiltX}deg) rotateY(${state.tiltY}deg)`;
      if (shadow) {
        shadow.style.transform = `translate(${-state.tiltY * 0.7}px, ${state.tiltX * 0.7}px) scale(${0.9 + (state.lift - 1) * 1.5})`;
      }

      draw();

      const motion =
        Math.abs(state.tiltVX) +
        Math.abs(state.tiltVY) +
        Math.abs(state.liftV) * 40 +
        Math.abs(state.lightVX) + Math.abs(state.lightVY) +
        Math.abs(state.tiltX - targetX) +
        Math.abs(state.tiltY - targetY);
      calm = motion > 0.02 ? 0 : calm + dt;

      if (!visible || (!drifting && !pointer.inside && calm > 0.3)) return;
      raf = requestAnimationFrame(tick);
    }

    function wake() {
      if (raf) return;
      calm = 0;
      last = performance.now();
      raf = requestAnimationFrame(tick);
    }

    function resize() {
      if (!canvas) return;
      const dpr = Math.min(window.devicePixelRatio || 1, 2);
      const w = Math.max(1, Math.round(canvas.clientWidth * dpr));
      const h = Math.max(1, Math.round(canvas.clientHeight * dpr));
      if (canvas.width !== w || canvas.height !== h) {
        canvas.width = w;
        canvas.height = h;
      }
      draw();
      wake();
    }

    function loadTexture(imageSrc) {
      if (!gl || !program || !imageSrc) return;
      textureReady = false;
      const loader = new Image();
      loader.crossOrigin = 'anonymous';
      loader.onload = function () {
        try {
          gl.bindTexture(gl.TEXTURE_2D, texture);
          gl.pixelStorei(gl.UNPACK_FLIP_Y_WEBGL, false);
          gl.pixelStorei(gl.UNPACK_PREMULTIPLY_ALPHA_WEBGL, false);
          gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, loader);
          gl.generateMipmap(gl.TEXTURE_2D);
          textureReady = true;
          root.setAttribute('data-ready', '');
          draw();
          wake();
        } catch (e) {
          textureReady = false;
        }
      };
      loader.src = imageSrc;
    }

    if (img && img.src) {
      if (img.complete && img.naturalWidth) {
        loadTexture(img.src);
      } else {
        img.addEventListener('load', function () {
          loadTexture(img.src);
        });
      }
    }

    function track(e) {
      if (e.pointerType === 'touch' && e.type === 'pointermove' && !e.buttons) return;
      const rect = root.getBoundingClientRect();
      pointer.x = holoClamp((e.clientX - rect.left) / rect.width, 0, 1);
      pointer.y = holoClamp((e.clientY - rect.top) / rect.height, 0, 1);
      pointer.inside = true;
      wake();
    }

    function leave() {
      pointer.inside = false;
      wake();
    }

    root.addEventListener('pointerenter', track);
    root.addEventListener('pointermove', track);
    root.addEventListener('pointerdown', track);
    root.addEventListener('pointerleave', leave);
    root.addEventListener('pointercancel', leave);

    if (window.ResizeObserver && canvas) {
      const resizeObserver = new ResizeObserver(resize);
      resizeObserver.observe(canvas);
    }
    if (window.IntersectionObserver) {
      const visibility = new IntersectionObserver(function (entries) {
        visible = entries.some(entry => entry.isIntersecting);
        if (visible) wake();
      });
      visibility.observe(root);
    }

    resize();
    wake();
  }

  function initAllHoloCards() {
    const cards = document.querySelectorAll('.about__image-wrapper, .holo-card');
    cards.forEach(function (card) {
      initHoloCard(card);
    });
  }

  // ===================================================
  // ANTIGRAVITY PARTICLES — WebGL2 Background Animation
  // Adapted from React Bits Antigravity component
  // ===================================================
  var AG_PIXEL_BUDGET = 2.4e6;
  var AG_WORLD_HEIGHT = 31.5;
  var AG_PALETTE_SIZE = 256;

  var AG_VERTEX = '#version 300 es\nprecision highp float;\nlayout(location=0) in vec2 aCorner;\nlayout(location=1) in vec4 aParticle;\nlayout(location=2) in vec4 aSeed;\nuniform vec2 uSize;uniform float uPixel;uniform vec2 uCursor;uniform float uRing;uniform float uBand;uniform float uParticle;uniform float uAmbient;uniform float uTime;uniform float uPulse;uniform float uVariance;uniform float uDepth;uniform float uShape;uniform float uColorMode;uniform float uStops;uniform float uHue;uniform float uReveal;uniform float uStreak;uniform float uCharge;\nout vec2 vLocal;out vec2 vBounds;out float vU;out float vAlpha;out float vSoft;\nvoid main(){\nvec2 rel=aParticle.xy-uCursor;float dist=length(rel);vec2 radial=dist>1e-3?rel/dist:vec2(1.,0.);vec2 dir=radial;\nfloat speed=length(aParticle.zw);float streak=clamp(speed/uStreak,0.,2.5);\nif(speed>1e-3){vec2 heading=aParticle.zw/speed*sign(dot(aParticle.zw,radial)+1e-4);dir=normalize(mix(radial,heading,smoothstep(0.,1.,streak)));}\nfloat ring=exp(-pow((dist-uRing)/uBand,2.));float z=aSeed.x;float depth=1.+z*0.32*uDepth;float pulse=1.+sin(uTime*uPulse+aSeed.y)*0.22*uVariance;float grow=uAmbient+(1.-uAmbient)*ring;\nfloat size=uParticle*depth*pulse*(0.85+0.3*aSeed.w)*(1.+uCharge*0.25*ring);\nvec2 bounds;\nif(uShape<0.5){float w=size*0.17*mix(0.55,1.,ring);bounds=vec2(max(w,size*0.5*grow)*(1.+streak*1.2),w);}\nelse if(uShape<1.5){bounds=vec2(size*0.22*mix(0.45,1.,grow));}\nelse{bounds=vec2(size*0.26*mix(0.45,1.,grow));}\nfloat soft=1.+max(-z,0.)*1.6*uDepth;\nvec2 local=aCorner*(bounds+soft*1.5/uPixel);\nvec2 world=aParticle.xy+dir*local.x+vec2(-dir.y,dir.x)*local.y;\ngl_Position=vec4(world.x/uSize.x*2.-1.,1.-world.y/uSize.y*2.,0.,1.);\nvLocal=local*uPixel;vBounds=bounds*uPixel;vSoft=soft;\nif(uColorMode<0.5){vU=atan(radial.y,radial.x)/6.28318530718+uHue+(aSeed.z-0.5)*0.06;}\nelse if(uColorMode<1.5){vU=clamp(dist/(uRing*2.4),0.,1.)+(aSeed.z-0.5)*0.06;}\nelse{vU=floor(aSeed.z*uStops)/max(uStops-1.,1.);}\nfloat fog=1.-max(-z,0.)*0.35*uDepth;\nvAlpha=mix(uAmbient,1.,ring)*fog*uReveal;\n}';

  var AG_FRAGMENT = '#version 300 es\nprecision highp float;\nuniform sampler2D uPalette;uniform float uShape;uniform float uColorMode;uniform float uOpacity;\nin vec2 vLocal;in vec2 vBounds;in float vU;in float vAlpha;in float vSoft;\nout vec4 fragColor;\nvoid main(){\nvec2 p=vLocal;float d;\nif(uShape<0.5){float r=vBounds.y;d=length(vec2(max(abs(p.x)-max(vBounds.x-r,0.),0.),p.y))-r;}\nelse if(uShape<1.5){d=length(p)-vBounds.x;}\nelse if(uShape<2.5){float r=vBounds.x*0.28;vec2 q=abs(p)-(vBounds-r);d=length(max(q,0.))+min(max(q.x,q.y),0.)-r;}\nelse{float r=vBounds.x*1.15;vec2 q=vec2(r*0.5774-p.x,abs(p.y));d=max(dot(q,vec2(0.5,0.8660254))-r*0.5,-q.x-r*0.5)*1.2;}\nfloat alpha=clamp(0.5-d/vSoft,0.,1.)*vAlpha*uOpacity;\nif(alpha<0.002) discard;\nvec3 color=texture(uPalette,vec2(uColorMode<0.5?fract(vU):vU,uColorMode<0.5?0.25:0.75)).rgb;\nfragColor=vec4(color*alpha,alpha);\n}';

  function agClamp(v, lo, hi) { return Math.min(hi, Math.max(lo, v)); }

  function agParseColor(val) {
    var t = String(val || '').trim();
    var hex = /^#?([0-9a-f]{3}|[0-9a-f]{6})$/i.exec(t);
    if (hex) {
      var full = hex[1].length === 3 ? hex[1].replace(/./g, function (d) { return d + d; }) : hex[1];
      return [parseInt(full.slice(0, 2), 16) / 255, parseInt(full.slice(2, 4), 16) / 255, parseInt(full.slice(4, 6), 16) / 255];
    }
    var rgb = /^rgba?\(\s*([\d.]+)[\s,]+([\d.]+)[\s,]+([\d.]+)/i.exec(t);
    if (rgb) return [agClamp(parseFloat(rgb[1]) / 255, 0, 1), agClamp(parseFloat(rgb[2]) / 255, 0, 1), agClamp(parseFloat(rgb[3]) / 255, 0, 1)];
    return null;
  }

  function agToLinear(c) { return c <= 0.04045 ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4); }
  function agToSrgb(c) { return c <= 0.0031308 ? c * 12.92 : 1.055 * Math.pow(Math.max(c, 0), 1 / 2.4) - 0.055; }

  function agToOklab(color) {
    var r = agToLinear(color[0]), g = agToLinear(color[1]), b = agToLinear(color[2]);
    var l = Math.cbrt(0.4122214708 * r + 0.5363325363 * g + 0.0514459929 * b);
    var m = Math.cbrt(0.2119034982 * r + 0.6806995451 * g + 0.1073969566 * b);
    var s = Math.cbrt(0.0883024619 * r + 0.2817188376 * g + 0.6299787005 * b);
    return [
      0.2104542553 * l + 0.793617785 * m - 0.0040720468 * s,
      1.9779984951 * l - 2.428592205 * m + 0.4505937099 * s,
      0.0259040371 * l + 0.7827717662 * m - 0.808675766 * s
    ];
  }

  function agFromOklab(lab) {
    var l = Math.pow(lab[0] + 0.3963377774 * lab[1] + 0.2158037573 * lab[2], 3);
    var m = Math.pow(lab[0] - 0.1055613458 * lab[1] - 0.0638541728 * lab[2], 3);
    var s = Math.pow(lab[0] - 0.0894841775 * lab[1] - 1.291485548 * lab[2], 3);
    return [
      agClamp(agToSrgb(4.0767416621 * l - 3.3077115913 * m + 0.2309699292 * s), 0, 1),
      agClamp(agToSrgb(-1.2684380046 * l + 2.6097574011 * m - 0.3413193965 * s), 0, 1),
      agClamp(agToSrgb(-0.0041960863 * l - 0.7034186147 * m + 1.707614701 * s), 0, 1)
    ];
  }

  function agBuildPalette(colors) {
    var stops = [];
    colors.forEach(function (c) {
      var parsed = agParseColor(c);
      if (!parsed) return;
      stops.push(agToOklab(parsed));
    });
    if (!stops.length) stops.push(agToOklab([1, 1, 1]));
    var data = new Uint8Array(AG_PALETTE_SIZE * 2 * 4);
    var rows = [[].concat(stops, [stops[0]]), stops.length > 1 ? stops : [stops[0], stops[0]]];
    rows.forEach(function (row, ri) {
      for (var x = 0; x < AG_PALETTE_SIZE; x++) {
        var t = (x / (AG_PALETTE_SIZE - (ri === 0 ? 0 : 1))) * (row.length - 1);
        var from = Math.min(Math.floor(t), row.length - 2);
        var k = t - from;
        var eased = k * k * (3 - 2 * k);
        var start = row[from], end = row[from + 1];
        var chroma = Math.hypot(start[1], start[2]) * (1 - eased) + Math.hypot(end[1], end[2]) * eased;
        var a = start[1] + (end[1] - start[1]) * eased;
        var b = start[2] + (end[2] - start[2]) * eased;
        var len = Math.hypot(a, b);
        var scale = len > 1e-4 ? chroma / len : 0;
        var color = agFromOklab([start[0] + (end[0] - start[0]) * eased, a * scale, b * scale]);
        for (var ch = 0; ch < 3; ch++) {
          data[(ri * AG_PALETTE_SIZE + x) * 4 + ch] = Math.round(color[ch] * 255);
        }
        data[(ri * AG_PALETTE_SIZE + x) * 4 + 3] = 255;
      }
    });
    return data;
  }

  function agRandom(seed) {
    return function () {
      seed |= 0;
      seed = (seed + 0x6d2b79f5) | 0;
      var t = Math.imul(seed ^ (seed >>> 15), 1 | seed);
      t = (t + Math.imul(t ^ (t >>> 7), 61 | t)) ^ t;
      return ((t ^ (t >>> 14)) >>> 0) / 4294967296;
    };
  }

  function agCompile(gl, type, source) {
    var shader = gl.createShader(type);
    if (!shader) return null;
    gl.shaderSource(shader, source);
    gl.compileShader(shader);
    if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
      gl.deleteShader(shader);
      return null;
    }
    return shader;
  }

  function agLink(gl) {
    var vertex = agCompile(gl, gl.VERTEX_SHADER, AG_VERTEX);
    var fragment = agCompile(gl, gl.FRAGMENT_SHADER, AG_FRAGMENT);
    if (!vertex || !fragment) {
      if (vertex) gl.deleteShader(vertex);
      if (fragment) gl.deleteShader(fragment);
      return null;
    }
    var program = gl.createProgram();
    gl.attachShader(program, vertex);
    gl.attachShader(program, fragment);
    gl.linkProgram(program);
    gl.deleteShader(vertex);
    gl.deleteShader(fragment);
    if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
      gl.deleteProgram(program);
      return null;
    }
    var uniforms = {};
    var count = gl.getProgramParameter(program, gl.ACTIVE_UNIFORMS);
    for (var i = 0; i < count; i++) {
      var info = gl.getActiveUniform(program, i);
      if (info) uniforms[info.name] = gl.getUniformLocation(program, info.name);
    }
    return { program: program, uniforms: uniforms };
  }

  function initAntigravity(canvas, opts) {
    if (!canvas || canvas._agInit) return;
    canvas._agInit = true;
    opts = opts || {};

    var container = canvas.parentElement;
    if (!container) return;

    var gl;
    try {
      gl = canvas.getContext('webgl2', {
        alpha: true, premultipliedAlpha: true, antialias: false,
        depth: false, stencil: false, powerPreference: 'high-performance'
      });
    } catch (e) { gl = null; }
    var shader = gl ? agLink(gl) : null;
    if (!gl || !shader) return;

    var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Settings
    var palette = opts.colors || ['#e63946', '#ff6b6b', '#ff9faa'];
    var count = agClamp(Math.round(opts.count || 1200), 1, 20000);
    var magnetRadius = Math.max(0, opts.magnetRadius !== undefined ? opts.magnetRadius : 9);
    var ringRadius = Math.max(0, opts.ringRadius !== undefined ? opts.ringRadius : 7);
    var particleSize = Math.max(0, opts.particleSize !== undefined ? opts.particleSize : 0.9);
    var ambient = agClamp(opts.ambient !== undefined ? opts.ambient : 0.2, 0, 1);
    var follow = agClamp(opts.lerpSpeed || 0.05, 0.001, 1);
    var colorSpeed = opts.colorSpeed !== undefined ? opts.colorSpeed : 0.05;
    var waveSpeed = opts.waveSpeed !== undefined ? opts.waveSpeed : 0.4;
    var waveAmplitude = Math.max(0, opts.waveAmplitude !== undefined ? opts.waveAmplitude : 1);
    var waveCount = Math.max(0, Math.round(opts.waveCount !== undefined ? opts.waveCount : 3));
    var variance = Math.max(0, opts.particleVariance !== undefined ? opts.particleVariance : 1);
    var rotationSpeed = opts.rotationSpeed || 0;
    var depthFactor = Math.max(0, opts.depthFactor !== undefined ? opts.depthFactor : 1);
    var pulseSpeed = opts.pulseSpeed !== undefined ? opts.pulseSpeed : 3;
    var shape = opts.particleShape || 0; // 0=capsule
    var tightness = Math.max(0, opts.fieldStrength !== undefined ? opts.fieldStrength : 10);
    var autoAnimate = opts.autoAnimate !== false;
    var interactive = opts.interactive !== false;
    var clickBurst = opts.clickBurst !== false;
    var opacity = agClamp(opts.opacity !== undefined ? opts.opacity : 1, 0, 1);
    var maxRatio = agClamp(opts.maxDevicePixelRatio || 2, 0.5, 3);
    var colorMode = opts.colorMode || 0; // 0=conic

    // WebGL setup
    var vao = gl.createVertexArray();
    gl.bindVertexArray(vao);

    var cornerBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, cornerBuffer);
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, 1, -1, -1, 1, 1, 1]), gl.STATIC_DRAW);
    gl.enableVertexAttribArray(0);
    gl.vertexAttribPointer(0, 2, gl.FLOAT, false, 0, 0);

    var particleBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, particleBuffer);
    gl.enableVertexAttribArray(1);
    gl.vertexAttribPointer(1, 4, gl.FLOAT, false, 0, 0);
    gl.vertexAttribDivisor(1, 1);

    var seedBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, seedBuffer);
    gl.enableVertexAttribArray(2);
    gl.vertexAttribPointer(2, 4, gl.FLOAT, false, 0, 0);
    gl.vertexAttribDivisor(2, 1);

    var paletteTex = gl.createTexture();
    gl.bindTexture(gl.TEXTURE_2D, paletteTex);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.REPEAT);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);

    // Upload palette
    var palData = agBuildPalette(palette);
    gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA8, AG_PALETTE_SIZE, 2, 0, gl.RGBA, gl.UNSIGNED_BYTE, palData);

    var size = { width: 1, height: 1, ratio: 1 };
    var cursor = { x: 0, y: 0, vx: 0, vy: 0, tx: 0, ty: 0, ready: false };
    var pointer = { x: 0, y: 0, inside: false, down: false, moved: -Infinity };
    var field = null;
    var time = 0, hue = 0, charge = 0;
    var introClock = reduced ? Infinity : 0;
    var raf = 0, last = 0, visible = true;

    function buildField(total, w, h, prev) {
      var rand = agRandom(1337);
      var margin = 0.06;
      var spanX = w * (1 + margin * 2);
      var spanY = h * (1 + margin * 2);
      var cols = Math.max(1, Math.ceil(Math.sqrt(total * spanX / spanY)));
      var rows = Math.max(1, Math.ceil(total / cols));
      var cells = [];
      for (var ci = 0; ci < cols * rows; ci++) cells.push(ci);
      for (var idx = cells.length - 1; idx > 0; idx--) {
        var sw = Math.floor(rand() * (idx + 1));
        var tmp = cells[idx]; cells[idx] = cells[sw]; cells[sw] = tmp;
      }
      var depths = [];
      for (var di = 0; di < total; di++) depths.push(rand() * 2 - 1);
      depths.sort(function (a, b) { return a - b; });
      var f = {
        total: total, width: w, height: h,
        homeX: new Float32Array(total), homeY: new Float32Array(total),
        band: new Float32Array(total), phase: new Float32Array(total),
        agility: new Float32Array(total), delay: new Float32Array(total),
        orbit: new Float32Array(total),
        x: new Float32Array(total), y: new Float32Array(total),
        vx: new Float32Array(total), vy: new Float32Array(total),
        particles: new Float32Array(total * 4), seeds: new Float32Array(total * 4)
      };
      for (var i = 0; i < total; i++) {
        var cell = cells[i % cells.length];
        var hx = -w * margin + ((cell % cols + 0.5 + (rand() - 0.5) * 0.85) / cols) * spanX;
        var hy = -h * margin + ((Math.floor(cell / cols) + 0.5 + (rand() - 0.5) * 0.85) / rows) * spanY;
        f.homeX[i] = hx; f.homeY[i] = hy;
        f.band[i] = rand() * 2 - 1;
        f.phase[i] = rand() * Math.PI * 2;
        f.agility[i] = 0.75 + rand() * 0.5;
        f.delay[i] = rand();
        if (prev && i < prev.total) {
          f.x[i] = prev.x[i] / prev.width * w;
          f.y[i] = prev.y[i] / prev.height * h;
          f.vx[i] = prev.vx[i]; f.vy[i] = prev.vy[i];
          f.orbit[i] = prev.orbit[i];
        } else {
          f.x[i] = hx;
          f.y[i] = introClock === 0 ? hy + h * (0.45 + f.delay[i] * 0.4) : hy;
        }
        f.seeds[i * 4] = depths[i < depths.length ? i : depths.length - 1];
        f.seeds[i * 4 + 1] = f.phase[i];
        f.seeds[i * 4 + 2] = rand();
        f.seeds[i * 4 + 3] = rand();
      }
      gl.bindBuffer(gl.ARRAY_BUFFER, seedBuffer);
      gl.bufferData(gl.ARRAY_BUFFER, f.seeds, gl.STATIC_DRAW);
      gl.bindBuffer(gl.ARRAY_BUFFER, particleBuffer);
      gl.bufferData(gl.ARRAY_BUFFER, f.particles.byteLength, gl.DYNAMIC_DRAW);
      return f;
    }

    function resize() {
      var rect = container.getBoundingClientRect();
      var cssW = Math.max(1, rect.width);
      var cssH = Math.max(1, rect.height);
      var ratio = Math.min(window.devicePixelRatio || 1, maxRatio, Math.sqrt(AG_PIXEL_BUDGET / (cssW * cssH)));
      var pw = Math.max(1, Math.round(cssW * ratio));
      var ph = Math.max(1, Math.round(cssH * ratio));
      if (canvas.width !== pw || canvas.height !== ph) {
        canvas.width = pw; canvas.height = ph;
      }
      size.width = cssW; size.height = cssH; size.ratio = pw / cssW;
      if (!cursor.ready) {
        cursor.x = cursor.tx = cssW / 2;
        cursor.y = cursor.ty = cssH / 2;
        cursor.ready = true;
      }
      if (!field || field.total !== count || Math.abs(field.width - cssW) > 0.5 || Math.abs(field.height - cssH) > 0.5) {
        field = buildField(count, cssW, cssH, field);
      }
    }

    function simulate(dt) {
      if (!field) return;
      var unit = size.height / AG_WORLD_HEIGHT;
      var ringPx = ringRadius * unit * (1 - 0.38 * charge);
      var magnetPx = Math.max(magnetRadius * unit, 1);
      var spread = (5 / (tightness + 0.1)) * unit;
      var wavePx = waveAmplitude * unit * 0.5;
      var omegaBase = 2.2 + follow * 80;
      var spinRate = (rotationSpeed + charge * 3) * (reduced ? 0.3 : 1);
      var centerX = size.width / 2, centerY = size.height / 2;
      var edge = magnetPx * 0.18;
      var f = field;
      for (var i = 0; i < f.total; i++) {
        var parallax = 1 - f.seeds[i * 4] * 0.12 * depthFactor;
        var cx = centerX + (cursor.x - centerX) * parallax;
        var cy = centerY + (cursor.y - centerY) * parallax;
        var hx = f.homeX[i];
        var hy = f.homeY[i] + Math.sin(time * 0.7 + f.phase[i]) * unit * 0.12 * waveAmplitude;
        var dx = hx - cx, dy = hy - cy;
        var dist = Math.sqrt(dx * dx + dy * dy);
        var capture = 1 - agClamp((dist - (magnetPx - edge)) / (edge * 2), 0, 1);
        var ease = capture * capture * (3 - 2 * capture);
        var turn = f.orbit[i] + spinRate * ease * dt;
        turn -= Math.atan2(Math.sin(turn), Math.cos(turn)) * (1 - ease) * Math.min(1, dt * 2.5);
        f.orbit[i] = turn;
        var tx = hx, ty = hy;
        if (ease > 0 || Math.abs(turn) > 1e-4) {
          var angle = Math.atan2(dy, dx) + turn;
          var wave = wavePx * (0.6 * Math.sin(angle * waveCount - time * waveSpeed * 2) +
            0.4 * Math.sin(f.phase[i] + time * waveSpeed * 1.3));
          var radius = dist + (ringPx + wave + f.band[i] * spread - dist) * ease;
          tx = cx + Math.cos(angle) * radius;
          ty = cy + Math.sin(angle) * radius;
        }
        var omega = introClock < f.delay[i] * 0.9 ? 0 : omegaBase * f.agility[i];
        var damping = 1.64 * omega;
        var stiffness = omega * omega;
        var steps = Math.min(4, Math.max(1, Math.ceil(omega * dt * 2)));
        var h = dt / steps;
        for (var s = 0; s < steps; s++) {
          f.vx[i] += ((tx - f.x[i]) * stiffness - f.vx[i] * damping) * h;
          f.vy[i] += ((ty - f.y[i]) * stiffness - f.vy[i] * damping) * h;
          f.x[i] += f.vx[i] * h;
          f.y[i] += f.vy[i] * h;
        }
        f.particles[i * 4] = f.x[i];
        f.particles[i * 4 + 1] = f.y[i];
        f.particles[i * 4 + 2] = f.vx[i];
        f.particles[i * 4 + 3] = f.vy[i];
      }
    }

    function burst(strength) {
      if (!field) return;
      var unit = size.height / AG_WORLD_HEIGHT;
      var reach = Math.max(magnetRadius, ringRadius) * unit * 1.8;
      var f = field;
      for (var i = 0; i < f.total; i++) {
        var dx = f.x[i] - cursor.x, dy = f.y[i] - cursor.y;
        var dist = Math.sqrt(dx * dx + dy * dy) + 1e-3;
        var kick = unit * 110 * strength * Math.exp(-Math.pow(dist / reach, 2)) * f.agility[i];
        f.vx[i] += (dx / dist) * kick;
        f.vy[i] += (dy / dist) * kick;
      }
    }

    function frame(now) {
      raf = 0;
      if (!field) return;
      var dt = agClamp((now - last) / 1000 || 0, 0, 1 / 30);
      last = Math.max(last, now);
      var pace = reduced ? 0.3 : 1;
      time += dt * pace;
      hue += dt * colorSpeed * pace;
      if (introClock < 3) introClock += dt;
      charge = pointer.down ? Math.min(1, charge + dt / 0.9) : Math.max(0, charge - dt * 4);

      var idle = performance.now() - pointer.moved > 2000 || !pointer.inside;
      if (autoAnimate && !reduced && (idle || !interactive)) {
        cursor.tx = size.width / 2 + Math.sin(time * 0.5) * (size.width / 4);
        cursor.ty = size.height / 2 + Math.cos(time) * (size.height / 4);
      } else if (interactive && pointer.inside) {
        cursor.tx = pointer.x;
        cursor.ty = pointer.y;
      }
      cursor.vx += ((cursor.tx - cursor.x) * 49 - cursor.vx * 14) * dt;
      cursor.vy += ((cursor.ty - cursor.y) * 49 - cursor.vy * 14) * dt;
      cursor.x += cursor.vx * dt;
      cursor.y += cursor.vy * dt;

      simulate(dt);

      var unit = size.height / AG_WORLD_HEIGHT;
      gl.viewport(0, 0, canvas.width, canvas.height);
      gl.clearColor(0, 0, 0, 0);
      gl.clear(gl.COLOR_BUFFER_BIT);
      gl.enable(gl.BLEND);
      gl.blendFunc(gl.ONE, gl.ONE_MINUS_SRC_ALPHA);
      gl.useProgram(shader.program);
      gl.bindVertexArray(vao);
      gl.bindBuffer(gl.ARRAY_BUFFER, particleBuffer);
      gl.bufferSubData(gl.ARRAY_BUFFER, 0, field.particles);
      var u = shader.uniforms;
      gl.activeTexture(gl.TEXTURE0);
      gl.bindTexture(gl.TEXTURE_2D, paletteTex);
      gl.uniform1i(u.uPalette, 0);
      gl.uniform2f(u.uSize, size.width, size.height);
      gl.uniform1f(u.uPixel, size.ratio);
      gl.uniform2f(u.uCursor, cursor.x, cursor.y);
      gl.uniform1f(u.uRing, ringRadius * unit * (1 - 0.38 * charge));
      gl.uniform1f(u.uBand, Math.max(unit * 6, 1));
      gl.uniform1f(u.uParticle, particleSize * unit * 0.6);
      gl.uniform1f(u.uAmbient, ambient);
      gl.uniform1f(u.uTime, time);
      gl.uniform1f(u.uPulse, pulseSpeed);
      gl.uniform1f(u.uVariance, variance);
      gl.uniform1f(u.uDepth, depthFactor);
      gl.uniform1f(u.uShape, shape);
      gl.uniform1f(u.uColorMode, colorMode);
      gl.uniform1f(u.uStops, palette.length);
      gl.uniform1f(u.uHue, hue);
      gl.uniform1f(u.uReveal, introClock < 3 ? agClamp(introClock / 0.6, 0, 1) : 1);
      gl.uniform1f(u.uStreak, unit * 30);
      gl.uniform1f(u.uCharge, charge);
      gl.uniform1f(u.uOpacity, opacity);
      gl.drawArraysInstanced(gl.TRIANGLE_STRIP, 0, 4, field.total);

      if (visible) raf = requestAnimationFrame(frame);
    }

    function wake() {
      if (raf || !visible) return;
      last = performance.now();
      raf = requestAnimationFrame(frame);
    }

    // Pointer events scoped to container
    function locate(e) {
      var rect = container.getBoundingClientRect();
      return {
        x: e.clientX - rect.left, y: e.clientY - rect.top,
        inside: e.clientX >= rect.left && e.clientX <= rect.right && e.clientY >= rect.top && e.clientY <= rect.bottom
      };
    }
    function onMove(e) {
      var spot = locate(e);
      pointer.inside = spot.inside;
      if (!spot.inside) return;
      pointer.x = spot.x; pointer.y = spot.y;
      pointer.moved = performance.now();
    }
    function onDown(e) {
      var spot = locate(e);
      if (!spot.inside || !interactive) return;
      pointer.x = spot.x; pointer.y = spot.y;
      pointer.inside = true;
      pointer.moved = performance.now();
      if (clickBurst && !reduced) pointer.down = true;
    }
    function onUp(e) {
      if (pointer.down) burst(0.45 + charge);
      pointer.down = false;
      if (e.pointerType !== 'mouse') pointer.inside = false;
    }
    function onLeave() { pointer.inside = false; pointer.down = false; }

    window.addEventListener('pointermove', onMove, { passive: true });
    window.addEventListener('pointerdown', onDown, { passive: true });
    window.addEventListener('pointerup', onUp, { passive: true });
    window.addEventListener('pointercancel', onUp, { passive: true });
    document.documentElement.addEventListener('pointerleave', onLeave);

    if (window.ResizeObserver) {
      var ro = new ResizeObserver(function () { resize(); wake(); });
      ro.observe(container);
    }
    if (window.IntersectionObserver) {
      var io = new IntersectionObserver(function (entries) {
        visible = entries.some(function (e) { return e.isIntersecting; });
        if (visible) wake();
      });
      io.observe(container);
    }

    resize();
    wake();
  }

  function initHeroParticles() {
    var canvas = document.querySelector('.hero__particles');
    if (!canvas) return;
    initAntigravity(canvas, {
      colors: ['#e63946', '#ff6b6b', '#c1121f', '#ff9faa'],
      count: 1200,
      magnetRadius: 9,
      ringRadius: 7,
      particleSize: 0.9,
      ambient: 0.18,
      autoAnimate: true,
      interactive: true,
      clickBurst: true,
      colorSpeed: 0.04,
      opacity: 0.65,
      lerpSpeed: 0.05,
      waveAmplitude: 1,
      waveCount: 3,
      depthFactor: 1,
      pulseSpeed: 3,
      fieldStrength: 10,
      particleVariance: 1
    });
  }

  // ===================================================
  // INITIALIZATION
  // ===================================================
  function init() {
    updateSectionCache();
    initScrollReveal();
    handleNavbarScroll();
    updateActiveNavLink();
    initAllHoloCards();
    initHeroParticles();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  // Recalculate once all assets and images finish loading
  window.addEventListener('load', function () {
    updateSectionCache();
  });

})();
