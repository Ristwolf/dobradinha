function initAosAndFeather() {
  try {
    if (typeof AOS !== 'undefined' && AOS?.init) {
      AOS.init({ duration: 800, easing: 'ease-in-out', once: true });
    }
  } catch {
    // ignore
  }

  try {
    if (typeof feather !== 'undefined' && feather?.replace) {
      feather.replace();
    }
  } catch {
    // ignore
  }
}

function initYear() {
  const el = document.getElementById('y');
  if (el) el.textContent = String(new Date().getFullYear());
}

function initMobileMenuPlaceholder() {
  const btn = document.querySelector('.mobile-menu-button');
  if (!btn) return;
  btn.addEventListener('click', () => {
    alert('Menu mobile (placeholder).');
  });
}

function initTabs() {
  const tabs = document.querySelectorAll('[role="tab"]');
  const panels = document.querySelectorAll('.tab-panel');
  if (tabs.length === 0 || panels.length === 0) return;

  const isAbstractsPage = Boolean(document.querySelector('[data-page="abstracts"]'));
  const hashAliases = isAbstractsPage
    ? {
        historia: 'history',
        ministerio: 'ministry',
        teologia: 'theology',
        'vida-crista': 'christian-life'
      }
    : {};

  function canonicalizeKey(key) {
    if (!key) return '';
    return hashAliases[key] ?? key;
  }

  function setHashWithoutJump(key) {
    try {
      history.replaceState(null, '', `#${encodeURIComponent(key)}`);
    } catch {
      // ignore
    }
  }

  function animatePanel(panel) {
    if (!isAbstractsPage) return;
    const gsap = window.gsap;
    if (!gsap?.fromTo) return;

    // Avoid fighting the CardSwap transforms.
    if (panel.querySelector('.card-swap-container')) {
      gsap.fromTo(panel, { autoAlpha: 0 }, { autoAlpha: 1, duration: 0.2, ease: 'power1.out' });
      return;
    }

    const cards = panel.querySelectorAll('.card');
    if (cards.length === 0) {
      gsap.fromTo(panel, { autoAlpha: 0, y: 6 }, { autoAlpha: 1, y: 0, duration: 0.25, ease: 'power1.out' });
      return;
    }

    gsap.fromTo(
      cards,
      { autoAlpha: 0, y: 10 },
      { autoAlpha: 1, y: 0, duration: 0.35, ease: 'power1.out', stagger: 0.04, clearProps: 'opacity,transform' }
    );
  }

  function activateTab(targetKey, { setHash = false } = {}) {
    const key = canonicalizeKey(targetKey);

    tabs.forEach((tab) => {
      const active = tab.dataset.target === key;
      tab.setAttribute('aria-selected', active ? 'true' : 'false');
    });
    panels.forEach((panel) => {
      const match = panel.dataset.panel === key;
      panel.classList.toggle('hidden-panel', !match);

      if (match) {
        animatePanel(panel);
      }
    });

    if (setHash) setHashWithoutJump(key);
  }

  tabs.forEach((tab) => {
    tab.addEventListener('click', () => activateTab(tab.dataset.target, { setHash: isAbstractsPage }));
    tab.addEventListener('keydown', (e) => {
      const idx = Array.from(tabs).indexOf(tab);
      if (e.key === 'ArrowRight') {
        const next = tabs[(idx + 1) % tabs.length];
        next.focus();
        activateTab(next.dataset.target, { setHash: isAbstractsPage });
      } else if (e.key === 'ArrowLeft') {
        const prev = tabs[(idx - 1 + tabs.length) % tabs.length];
        prev.focus();
        activateTab(prev.dataset.target, { setHash: isAbstractsPage });
      }
    });
  });

  function activateFromHash() {
    let hash = window.location.hash.replace('#', '');
    try {
      hash = decodeURIComponent(hash);
    } catch {
      // ignore
    }

    const canonical = canonicalizeKey(hash);
    if (hash && canonical !== hash) setHashWithoutJump(canonical);

    if (canonical && document.querySelector(`[data-target="${CSS.escape(canonical)}"]`)) {
      activateTab(canonical);
      return;
    }

    activateTab(tabs[0].dataset.target);
  }

  window.addEventListener('hashchange', activateFromHash);
  if (isAbstractsPage) {
    // For non-abstracts pages, we don't want to hijack hash navigation.
    activateFromHash();
  } else {
    activateTab(tabs[0].dataset.target);
  }
}

function resolveSiteUrl(prefix, url) {
  if (!url) return url;
  if (/^https?:\/\//i.test(url)) return url;
  if (url.startsWith('/')) return url;
  return prefix + url.replace(/^\.\//, '');
}

async function fetchJson(url) {
  const res = await fetch(url, { cache: 'no-store' });
  if (!res.ok) throw new Error(`Failed to load ${url}: ${res.status}`);
  return await res.json();
}

function getSiteRelativePrefix() {
  // When hosted on GitHub Pages, the site root is /<repo>/.
  // Our subpages live under known folders (e.g. /books/), so JSON lives at ../data/... there.
  const pathname = window.location.pathname;
  const subpages = ['/studies/', '/abstracts/', '/resumos/', '/books/', '/videos/', '/about/'];
  const isSubpage = subpages.some((seg) => pathname.includes(seg));
  return isSubpage ? '../' : './';
}

function createPdfCard({ title, url }) {
  const article = document.createElement('article');
  article.className = 'bg-white rounded-lg overflow-hidden shadow-md card';
  article.setAttribute('data-aos', 'fade-up');

  article.innerHTML = `
    <div class="p-6">
      <h3 class="text-xl font-bold text-gray-800 mb-3"></h3>
      <div class="flex items-center justify-between">
        <a class="text-amber-600 hover:text-amber-700 font-medium inline-flex items-center" target="_blank" rel="noopener">
          <span>Abrir PDF</span>
          <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
        </a>
      </div>
    </div>
  `;

  const h3 = article.querySelector('h3');
  h3.textContent = title;

  const a = article.querySelector('a');
  a.href = url;

  return article;
}

function createPdfSwapCard({ title, categoryTitle, url }) {
  const article = document.createElement('article');
  article.className = 'card rounded-xl overflow-hidden shadow-md';
  article.style.transformStyle = 'preserve-3d';
  article.style.willChange = 'transform';
  article.style.backfaceVisibility = 'hidden';
  article.style.webkitBackfaceVisibility = 'hidden';

  article.innerHTML = `
    <div class="relative w-full h-full">
      <img alt="" class="w-full h-full object-cover" />

      <div class="absolute inset-x-0 top-0 p-4 bg-black/55">
        <div class="text-xs text-white/80 mb-1"></div>
        <h3 class="text-lg md:text-xl font-bold text-white leading-snug"></h3>
      </div>

      <div class="absolute inset-x-0 bottom-0 p-4 flex justify-end">
        <a class="inline-flex items-center gap-2 rounded-lg bg-white/90 px-4 py-2 text-gray-900 hover:bg-white transition" target="_blank" rel="noopener">
          <span class="font-medium">Abrir PDF</span>
          <i data-feather="arrow-right" class="w-4 h-4"></i>
        </a>
      </div>
    </div>
  `;

  article.querySelector('h3').textContent = title;
  article.querySelector('div.text-xs').textContent = categoryTitle;
  article.querySelector('a').href = url;
  return article;
}

function mountCardSwap(
  container,
  cardElements,
  {
    delayMs = 5000,
    pauseOnHover = false,
    cardDistance = 60,
    verticalDistance = 70,
    skewAmount = 6,
    easing = 'elastic',
    width = 500,
    height = 400,
    imageUrl = ''
  } = {}
) {
  const gsap = window.gsap;
  // Fallback: if GSAP isn't available, show as a normal grid.
  if (!gsap?.timeline || cardElements.length === 0) {
    container.classList.remove('relative');
    container.innerHTML = '';
    const list = document.createElement('div');
    list.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8';
    for (const el of cardElements) {
      el.style.position = '';
      el.style.inset = '';
      list.appendChild(el);
    }
    container.appendChild(list);
    return { stop() {}, start() {} };
  }

  // Prepare container.
  container.innerHTML = '';
  container.classList.remove('grid', 'grid-cols-1', 'md:grid-cols-2', 'lg:grid-cols-3', 'gap-8');
  container.classList.add('card-swap-container');
  container.style.width = `${Number(width) || 500}px`;
  container.style.height = `${Number(height) || 400}px`;

  const config =
    easing === 'elastic'
      ? {
          ease: 'elastic.out(0.6,0.9)',
          durDrop: 2,
          durMove: 2,
          durReturn: 2,
          promoteOverlap: 0.9,
          returnDelay: 0.05
        }
      : {
          ease: 'power1.inOut',
          durDrop: 0.8,
          durMove: 0.8,
          durReturn: 0.8,
          promoteOverlap: 0.45,
          returnDelay: 0.2
        };

  // Set images and sizes.
  for (const el of cardElements) {
    el.style.width = `${Number(width) || 500}px`;
    el.style.height = `${Number(height) || 400}px`;
    if (imageUrl) {
      const img = el.querySelector('img');
      if (img) img.src = imageUrl;
    }
    container.appendChild(el);
  }

  const total = cardElements.length;
  const order = Array.from({ length: total }, (_, i) => i);

  const makeSlot = (i) => ({
    x: i * cardDistance,
    y: -i * verticalDistance,
    z: -i * cardDistance * 1.5,
    zIndex: total - i
  });

  const placeNow = (el, slot) =>
    gsap.set(el, {
      x: slot.x,
      y: slot.y,
      z: slot.z,
      xPercent: -50,
      yPercent: -50,
      skewY: skewAmount,
      transformOrigin: 'center center',
      zIndex: slot.zIndex,
      force3D: true
    });

  order.forEach((idx, i) => placeNow(cardElements[idx], makeSlot(i)));

  let tl = null;
  let intervalId = null;

  const swap = () => {
    if (order.length < 2) return;

    const front = order[0];
    const rest = order.slice(1);
    const elFront = cardElements[front];

    tl = gsap.timeline();

    tl.to(elFront, {
      y: '+=500',
      duration: config.durDrop,
      ease: config.ease
    });

    tl.addLabel('promote', `-=${config.durDrop * config.promoteOverlap}`);
    rest.forEach((idx, i) => {
      const el = cardElements[idx];
      const slot = makeSlot(i);
      tl.set(el, { zIndex: slot.zIndex }, 'promote');
      tl.to(
        el,
        {
          x: slot.x,
          y: slot.y,
          z: slot.z,
          duration: config.durMove,
          ease: config.ease
        },
        `promote+=${i * 0.15}`
      );
    });

    const backSlot = makeSlot(total - 1);
    tl.addLabel('return', `promote+=${config.durMove * config.returnDelay}`);
    tl.call(() => {
      gsap.set(elFront, { zIndex: backSlot.zIndex });
    }, undefined, 'return');
    tl.to(
      elFront,
      {
        x: backSlot.x,
        y: backSlot.y,
        z: backSlot.z,
        duration: config.durReturn,
        ease: config.ease
      },
      'return'
    );

    tl.call(() => {
      order.splice(0, 1);
      order.push(front);
    });
  };

  const start = () => {
    stop();
    swap();
    intervalId = window.setInterval(swap, Math.max(500, Number(delayMs) || 5000));
  };

  const stop = () => {
    if (intervalId) window.clearInterval(intervalId);
    intervalId = null;
  };

  if (pauseOnHover) {
    const pause = () => {
      tl?.pause();
      stop();
    };
    const resume = () => {
      tl?.play();
      intervalId = window.setInterval(swap, Math.max(500, Number(delayMs) || 5000));
    };
    container.addEventListener('mouseenter', pause);
    container.addEventListener('mouseleave', resume);
  }

  start();
  return { start, stop };
}

async function renderAbstracts() {
  const page = document.querySelector('[data-page="abstracts"]');
  if (!page) return;

  const prefix = getSiteRelativePrefix();
  const swapDelayMs = Number(page.getAttribute('data-swap-delay-ms')) || 5000;
  const pauseOnHover = String(page.getAttribute('data-swap-pause-on-hover') ?? 'false') === 'true';
  const cardDistance = Number(page.getAttribute('data-swap-card-distance')) || 60;
  const verticalDistance = Number(page.getAttribute('data-swap-vertical-distance')) || 70;
  const width = Number(page.getAttribute('data-swap-card-width')) || 500;
  const height = Number(page.getAttribute('data-swap-card-height')) || 400;
  const skewAmount = Number(page.getAttribute('data-swap-skew')) || 6;
  const easing = page.getAttribute('data-swap-easing') || 'elastic';

  let data;
  try {
    data = await fetchJson(prefix + 'data/abstracts.json');
  } catch {
    return;
  }

  for (const category of data.categories ?? []) {
    const container = document.querySelector(`[data-abstracts-container="${CSS.escape(category.key)}"]`);
    if (!container) continue;

    if (!category.files || category.files.length === 0) {
      const empty = document.createElement('div');
      empty.className = 'text-gray-600';
      empty.textContent = 'Nenhum PDF encontrado nesta categoria.';
      container.appendChild(empty);
      continue;
    }

    const placeholderImageUrl = resolveSiteUrl(prefix, 'img/j.jpeg');

    const cards = category.files.map((file) => {
      const el = createPdfSwapCard({
        title: file.name,
        categoryTitle: category.title ?? category.key,
        url: resolveSiteUrl(prefix, file.url)
      });
      // Image placeholder (can be customized later per card).
      const img = el.querySelector('img');
      if (img) img.src = placeholderImageUrl;
      return el;
    });

    mountCardSwap(container, cards, {
      delayMs: swapDelayMs,
      pauseOnHover,
      cardDistance,
      verticalDistance,
      width,
      height,
      skewAmount,
      easing
    });
  }

  initAosAndFeather();
}

function createVideoCard({ id, title, thumb }) {
  const article = document.createElement('article');
  article.className = 'bg-white rounded-lg overflow-hidden shadow-md card';
  article.setAttribute('data-aos', 'fade-up');

  const safeTitle = title || 'Vídeo';

  article.innerHTML = `
    <div class="video-wrap group">
      <img alt="" />
      <button class="play-overlay" aria-label="Reproduzir vídeo" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
      </button>
    </div>
    <div class="p-4">
      <h3 class="text-lg font-semibold text-gray-800"></h3>
      <div class="mt-2 flex items-center text-sm text-gray-500">
        <i data-feather="youtube" class="w-4 h-4 mr-2"></i>
        <span>youtube.com</span>
      </div>
    </div>
  `;

  const img = article.querySelector('img');
  img.src = thumb;
  img.alt = safeTitle;

  article.querySelector('h3').textContent = safeTitle;

  const button = article.querySelector('button');
  button.addEventListener('click', () => {
    const wrap = article.querySelector('.video-wrap');
    wrap.innerHTML = `
      <iframe
        src="https://www.youtube.com/embed/${encodeURIComponent(id)}?autoplay=1"
        title="${safeTitle.replace(/"/g, '&quot;')}"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen
      ></iframe>
    `;
  });

  return article;
}

async function renderVideos() {
  const page = document.querySelector('[data-page="videos"]');
  if (!page) return;

  const grid = document.querySelector('[data-videos-grid]');
  const empty = document.querySelector('[data-videos-empty]');
  if (!grid || !empty) return;

  let data;
  try {
    const prefix = getSiteRelativePrefix();
    data = await fetchJson(prefix + 'data/videos.json');
  } catch {
    empty.hidden = false;
    return;
  }

  const items = data.items ?? [];
  if (items.length === 0) {
    empty.hidden = false;
    return;
  }

  empty.hidden = true;
  for (const item of items) {
    grid.appendChild(createVideoCard(item));
  }

  initAosAndFeather();
}

document.addEventListener('DOMContentLoaded', async () => {
  initAosAndFeather();
  initYear();
  initMobileMenuPlaceholder();
  initTabs();

  await renderAbstracts();
  await renderVideos();
});
