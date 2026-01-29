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

  const isResumosPage = Boolean(document.querySelector('[data-page="resumos"]'));
  const hashAliases = isResumosPage
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
    if (!isResumosPage) return;
    const gsap = window.gsap;
    if (!gsap?.fromTo) return;

    // Keep this simple to avoid fighting component animations.
    if (panel.querySelector('.masonry-list')) {
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
      tab.classList.toggle('tab-active', active);
    });
    panels.forEach((panel) => {
      const match = panel.dataset.panel === key;
      panel.classList.toggle('hidden-panel', !match);

      if (match) {
        animatePanel(panel);
      }
    });

    if (isResumosPage) {
      try {
        window.__resumosMasonry?.activate?.(key);
      } catch {
        // ignore
      }
    }

    if (setHash) setHashWithoutJump(key);
  }

  tabs.forEach((tab) => {
    tab.addEventListener('click', () => activateTab(tab.dataset.target, { setHash: isResumosPage }));
    tab.addEventListener('keydown', (e) => {
      const idx = Array.from(tabs).indexOf(tab);
      if (e.key === 'ArrowRight') {
        const next = tabs[(idx + 1) % tabs.length];
        next.focus();
        activateTab(next.dataset.target, { setHash: isResumosPage });
      } else if (e.key === 'ArrowLeft') {
        const prev = tabs[(idx - 1 + tabs.length) % tabs.length];
        prev.focus();
        activateTab(prev.dataset.target, { setHash: isResumosPage });
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
  if (isResumosPage) {
    // For non-resumos pages, we don't want to hijack hash navigation.
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
  const subpages = ['/studies/', '/resumos/', '/books/', '/videos/', '/about/'];
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

function hashStringToInt(str) {
  // Small deterministic hash (FNV-1a-ish)
  let hash = 2166136261;
  for (let i = 0; i < str.length; i++) {
    hash ^= str.charCodeAt(i);
    hash = Math.imul(hash, 16777619);
  }
  return hash >>> 0;
}

function preloadImages(urls) {
  return Promise.all(
    urls.map(
      (src) =>
        new Promise((resolve) => {
          const img = new Image();
          img.src = src;
          img.onload = img.onerror = () => resolve();
        })
    )
  );
}

function createMasonry(container, initialItems, options = {}) {
  const {
    ease = 'sine.out',
    duration = 0.6,
    stagger = 0.05,
    animateFrom = 'top',
    scaleOnHover = true,
    hoverScale = 0.95,
    blurToFocus = false,
    colorShiftOnHover = true
  } = options;

  const gsap = window.gsap;
  // Keep mobile cards large: use 1 column below 600px.
  const queries = ['(min-width:1500px)', '(min-width:1100px)', '(min-width:800px)', '(min-width:600px)'];
  const values = [5, 4, 3, 2];
  const media = queries.map((q) => matchMedia(q));

  function getColumns() {
    const idx = media.findIndex((m) => m.matches);
    return values[idx] ?? 1;
  }

  let items = Array.isArray(initialItems) ? initialItems : [];
  let imagesReady = false;
  let hasMounted = false;
  let grid = [];

  container.classList.add('masonry-list');
  container.style.position = 'relative';
  container.style.width = '100%';

  const elementsById = new Map();
  let resizeObserver = null;

  function getInitialPosition(item) {
    const containerRect = container.getBoundingClientRect();
    let direction = animateFrom;

    if (animateFrom === 'random') {
      const dirs = ['top', 'bottom', 'left', 'right'];
      direction = dirs[Math.floor(Math.random() * dirs.length)];
    }

    switch (direction) {
      case 'top':
        return { x: item.x, y: -200 };
      case 'bottom':
        return { x: item.x, y: window.innerHeight + 200 };
      case 'left':
        return { x: -200, y: item.y };
      case 'right':
        return { x: window.innerWidth + 200, y: item.y };
      case 'center':
        return {
          x: containerRect.width / 2 - item.w / 2,
          y: containerRect.height / 2 - item.h / 2
        };
      default:
        return { x: item.x, y: item.y + 100 };
    }
  }

  function ensureElements() {
    // Rebuild DOM if ids mismatch.
    const ids = new Set(items.map((i) => String(i.id)));
    let needsRebuild = false;

    for (const id of elementsById.keys()) {
      if (!ids.has(id)) {
        needsRebuild = true;
        break;
      }
    }
    if (!needsRebuild) {
      for (const id of ids) {
        if (!elementsById.has(id)) {
          needsRebuild = true;
          break;
        }
      }
    }

    if (!needsRebuild) return;

    container.innerHTML = '';
    elementsById.clear();

    const fragment = document.createDocumentFragment();

    for (const item of items) {
      const wrapper = document.createElement('div');
      wrapper.className = 'masonry-item-wrapper';
      wrapper.dataset.key = String(item.id);
      wrapper.style.opacity = '0';

      const card = document.createElement('div');
      card.className = 'masonry-item-card';

      const img = document.createElement('div');
      img.className = 'masonry-item-img';
      if (item.img) {
        img.style.backgroundImage = `url(${item.img})`;
      } else {
        img.style.backgroundImage = '';
      }

      const hoverLabel = document.createElement('div');
      hoverLabel.className = 'masonry-hover-label';
      hoverLabel.textContent = String(item.title ?? '');
      img.appendChild(hoverLabel);

      if (colorShiftOnHover) {
        const overlay = document.createElement('div');
        overlay.className = 'masonry-color-overlay';
        img.appendChild(overlay);
      }

      card.appendChild(img);
      wrapper.appendChild(card);

      wrapper.addEventListener('click', () => {
        if (!item.url) return;
        window.open(item.url, '_blank', 'noopener');
      });

      wrapper.addEventListener('mouseenter', () => {
        if (scaleOnHover && gsap?.to) {
          gsap.to(wrapper, { scale: hoverScale, duration: 0.3, ease: 'power2.out' });
        }
        if (colorShiftOnHover && gsap?.to) {
          const overlay = wrapper.querySelector('.masonry-color-overlay');
          if (overlay) gsap.to(overlay, { opacity: 0.15, duration: 0.3 });
        }
      });

      wrapper.addEventListener('mouseleave', () => {
        if (scaleOnHover && gsap?.to) {
          gsap.to(wrapper, { scale: 1, duration: 0.3, ease: 'power2.out' });
        }
        if (colorShiftOnHover && gsap?.to) {
          const overlay = wrapper.querySelector('.masonry-color-overlay');
          if (overlay) gsap.to(overlay, { opacity: 0, duration: 0.3 });
        }
      });

      elementsById.set(String(item.id), wrapper);
      fragment.appendChild(wrapper);
    }

    container.appendChild(fragment);
  }

  function computeGrid(width) {
    const columns = getColumns();
    const colHeights = new Array(columns).fill(0);
    const columnWidth = width / columns;

    const out = items.map((child) => {
      const col = colHeights.indexOf(Math.min(...colHeights));
      const x = columnWidth * col;
      // Bigger tiles on mobile; scale down a bit as columns increase.
      const base = Math.max(360, Math.round(Number(child.height) || 560));
      const scale = columns >= 4 ? 0.6 : columns === 3 ? 0.72 : columns === 2 ? 0.85 : 1;
      const h = Math.max(360, Math.round(base * scale));
      const y = colHeights[col];
      colHeights[col] += h;

      return { ...child, x, y, w: columnWidth, h };
    });

    const maxHeight = Math.max(0, ...colHeights);
    container.style.height = `${Math.ceil(maxHeight)}px`;
    return out;
  }

  function layout() {
    const width = container.clientWidth;
    if (!width) return;
    if (!gsap?.to) return;

    grid = computeGrid(width);
    ensureElements();

    grid.forEach((item, index) => {
      const el = elementsById.get(String(item.id));
      if (!el) return;

      const animationProps = { x: item.x, y: item.y, width: item.w, height: item.h };

      if (!hasMounted) {
        const initialPos = getInitialPosition(item);
        const initialState = {
          opacity: 0,
          x: initialPos.x,
          y: initialPos.y,
          width: item.w,
          height: item.h,
          ...(blurToFocus ? { filter: 'blur(10px)' } : {})
        };

        gsap.fromTo(
          el,
          initialState,
          {
            opacity: 1,
            ...animationProps,
            ...(blurToFocus ? { filter: 'blur(0px)' } : {}),
            duration: 0.8,
            ease: 'power3.out',
            delay: index * stagger
          }
        );
      } else {
        gsap.to(el, { ...animationProps, duration, ease, overwrite: 'auto' });
      }
    });

    hasMounted = true;
  }

  let preloadToken = 0;
  async function setItems(nextItems) {
    items = Array.isArray(nextItems) ? nextItems : [];
    imagesReady = false;
    hasMounted = false;
    preloadToken += 1;
    const token = preloadToken;

    ensureElements();

    try {
      await preloadImages(items.map((i) => i.img));
    } catch {
      // ignore
    }

    if (token !== preloadToken) return;
    imagesReady = true;
    // If the panel is currently hidden, width will be 0; layout will run on activation.
    requestAnimationFrame(() => layout());
  }

  function relayout() {
    if (!imagesReady) return;
    requestAnimationFrame(() => layout());
  }

  function destroy() {
    try {
      resizeObserver?.disconnect();
    } catch {
      // ignore
    }
    resizeObserver = null;

    const handler = () => relayout();
    for (const m of media) {
      try {
        m.removeEventListener('change', handler);
      } catch {
        // ignore
      }
    }
  }

  // Observe size and media changes.
  resizeObserver = new ResizeObserver(() => relayout());
  resizeObserver.observe(container);

  const handler = () => relayout();
  for (const m of media) {
    try {
      m.addEventListener('change', handler);
    } catch {
      // ignore
    }
  }

  // Kick off.
  setItems(items);

  return { setItems, relayout, destroy };
}

async function renderResumos() {
  const page = document.querySelector('[data-page="resumos"]');
  if (!page) return;

  const prefix = getSiteRelativePrefix();

  let data;
  try {
    data = await fetchJson(prefix + 'data/resumos.json');
  } catch {
    return;
  }

  const itemsByKey = new Map();
  for (const category of data.categories ?? []) {
    const files = category.files ?? [];
    const items = files.map((file, index) => {
      const seed = hashStringToInt(`${category.key}:${file.name}`);
      const cover = file.coverUrl ? resolveSiteUrl(prefix, file.coverUrl) : '';
      const height = 250 + (seed % 650); // 250..899

      const rawTitle = String(file.name ?? '');
      const displayTitle = rawTitle.replace(/^resumo[.\s_-]+/i, '');

      return {
        id: `${category.key}:${index}`,
        img: cover,
        url: resolveSiteUrl(prefix, file.url),
        title: displayTitle,
        height
      };
    });
    itemsByKey.set(category.key, { title: category.title ?? category.key, items });
  }

  const instancesByKey = new Map();

  function ensureMounted(key) {
    const entry = itemsByKey.get(key);
    const container = document.querySelector(`[data-resumos-container="${CSS.escape(key)}"]`);
    if (!container) return;

    if (!entry || entry.items.length === 0) {
      container.innerHTML = '';
      const empty = document.createElement('div');
      empty.className = 'text-gray-600';
      empty.textContent = 'Nenhum PDF encontrado nesta categoria.';
      container.appendChild(empty);
      return;
    }

    if (!instancesByKey.has(key)) {
      const instance = createMasonry(container, entry.items, {
        ease: 'sine.out',
        duration: 0.6,
        stagger: 0.05,
        animateFrom: 'top',
        scaleOnHover: true,
        hoverScale: 0.95,
        blurToFocus: false,
        colorShiftOnHover: false
      });
      instancesByKey.set(key, instance);
    } else {
      instancesByKey.get(key)?.relayout?.();
    }
  }

  window.__resumosMasonry = {
    activate: (key) => ensureMounted(key)
  };

  // Mount the current active panel (or first tab).
  const activeTab = document.querySelector('[role="tab"][aria-selected="true"]');
  const initialKey = activeTab?.getAttribute('data-target') || (data.categories?.[0]?.key ?? '');
  if (initialKey) ensureMounted(initialKey);

  initAosAndFeather();
}

async function renderStudies() {
  const page = document.querySelector('[data-page="studies"]');
  if (!page) return;

  const prefix = getSiteRelativePrefix();

  let data;
  try {
    data = await fetchJson(prefix + 'data/studies.json');
  } catch {
    return;
  }

  const modal = document.getElementById('pdfflixModal');
  const modalTitle = document.getElementById('pdfflixModalTitle');
  const modalDesc = document.getElementById('pdfflixModalDesc');
  const modalFrame = document.getElementById('pdfflixModalFrame');
  const openNewTab = document.getElementById('pdfflixOpenNewTab');
  const downloadLink = document.getElementById('pdfflixDownload');

  async function ensurePdfJsLoaded(timeoutMs = 4000) {
    if (window.pdfjsLib?.getDocument) return true;

    return await new Promise((resolve) => {
      let waited = 0;
      const interval = 100;
      const timer = setInterval(() => {
        waited += interval;
        if (window.pdfjsLib?.getDocument) {
          clearInterval(timer);
          resolve(true);
        } else if (waited >= timeoutMs) {
          clearInterval(timer);
          resolve(false);
        }
      }, interval);
    });
  }

  function openModal(item) {
    if (!modal || !modalTitle || !modalFrame || !openNewTab || !downloadLink) return;
    modalTitle.textContent = item.title || 'PDF';
    if (modalDesc) modalDesc.textContent = '';
    modalFrame.src = item.url;
    openNewTab.href = item.url;
    downloadLink.href = item.url;

    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    if (!modal || !modalFrame) return;
    modal.setAttribute('aria-hidden', 'true');
    modalFrame.src = 'about:blank';
    document.body.style.overflow = '';
  }

  if (modal) {
    modal.addEventListener('click', (e) => {
      if (e.target && e.target.matches('[data-close]')) closeModal();
    });

    window.addEventListener('keydown', (e) => {
      if (modal.getAttribute('aria-hidden') === 'false' && e.key === 'Escape') {
        closeModal();
      }
    });
  }

  function createStudiesCard({ title, url }) {
    const card = document.createElement('div');
    card.className = 'pdfCard';
    card.tabIndex = 0;
    card.setAttribute('role', 'button');
    card.setAttribute('aria-label', `Abrir PDF: ${title}`);

    card.innerHTML = `
      <div class="pdfCard__thumb">
        <div class="pdfCard__fallback">PDF</div>
      </div>

      <div class="pdfCard__overlay"></div>

      <div class="pdfCard__info">
        <div class="pdfCard__name"></div>

        <div class="pdfCard__actions">
          <div class="pdfPlay" aria-hidden="true">▶</div>
          <div class="pdfCard__cta">Abrir</div>
        </div>
      </div>
    `;

    const name = card.querySelector('.pdfCard__name');
    if (name) name.textContent = title;

    const thumb = card.querySelector('.pdfCard__thumb');
    if (thumb) {
      renderPdfThumb(url, thumb).catch(() => {
        // keep fallback
      });
    }

    const item = { title, url };
    card.addEventListener('click', () => openModal(item));
    card.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        openModal(item);
      }
    });

    return card;
  }

  async function renderPdfThumb(pdfUrl, thumbHost) {
    const loaded = await ensurePdfJsLoaded();
    if (!loaded || !window.pdfjsLib) return;
    if (!window.pdfjsLib.GlobalWorkerOptions.workerSrc) {
      window.pdfjsLib.GlobalWorkerOptions.workerSrc =
        'https://cdn.jsdelivr.net/npm/pdfjs-dist@4.10.38/build/pdf.worker.min.js';
    }

    const loadingTask = window.pdfjsLib.getDocument({ url: pdfUrl });
    const pdf = await loadingTask.promise;
    const page = await pdf.getPage(1);
    const viewport = page.getViewport({ scale: 0.7 });

    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d', { alpha: false });
    if (!ctx) return;

    canvas.width = Math.floor(viewport.width);
    canvas.height = Math.floor(viewport.height);

    await page.render({ canvasContext: ctx, viewport }).promise;

    const img = new Image();
    img.alt = '';
    img.src = canvas.toDataURL('image/jpeg', 0.85);
    img.loading = 'lazy';

    thumbHost.innerHTML = '';
    thumbHost.appendChild(img);
  }

  for (const category of data.categories ?? []) {
    const categoryKey = category.key;
    for (const section of category.sections ?? []) {
      const sectionKey = section.key;
      const containers = document.querySelectorAll(
        `[data-studies-container="${CSS.escape(categoryKey)}"][data-studies-section="${CSS.escape(sectionKey)}"]`
      );
      if (containers.length === 0) continue;

      containers.forEach((container) => {
        container.innerHTML = '';
      });

      const files = section.files ?? [];
      if (files.length === 0) {
        const empty = document.createElement('div');
        empty.className = 'text-gray-600';
        empty.textContent = 'Nenhum PDF encontrado nesta categoria.';
        containers[0].appendChild(empty);
        continue;
      }

      const topRail = Array.from(containers).find((el) => el.dataset.rail === 'top') ?? containers[0];
      const bottomRail =
        Array.from(containers).find((el) => el.dataset.rail === 'bottom') ?? (containers.length > 1 ? containers[1] : null);

      for (let i = 0; i < files.length; i += 1) {
        const file = files[i];
        const rawTitle = String(file.name ?? '');
        const card = createStudiesCard({
          title: rawTitle,
          url: resolveSiteUrl(prefix, file.url)
        });

        if (bottomRail && i % 2 !== 0) {
          bottomRail.appendChild(card);
        } else {
          topRail.appendChild(card);
        }
      }
    }
  }

  document.querySelectorAll('.pdfflix__row').forEach((row) => {
    row.querySelectorAll('.pdfflix__railWrap').forEach((wrap) => {
      const rail = wrap.querySelector('.pdfflix__rail');
      if (!rail) return;

      const leftBtn = wrap.querySelector('.pdfflix__nav--left');
      const rightBtn = wrap.querySelector('.pdfflix__nav--right');

      function updateNavState() {
        const maxScroll = rail.scrollWidth - rail.clientWidth;
        const atStart = rail.scrollLeft <= 2;
        const atEnd = rail.scrollLeft >= maxScroll - 2;

        if (leftBtn) leftBtn.classList.toggle('pdfflix__nav--hidden', atStart);
        if (rightBtn) rightBtn.classList.toggle('pdfflix__nav--hidden', atEnd || maxScroll <= 0);
      }

      if (leftBtn) {
        leftBtn.addEventListener('click', () => {
          rail.scrollBy({ left: -520, behavior: 'smooth' });
        });
      }

      if (rightBtn) {
        rightBtn.addEventListener('click', () => {
          rail.scrollBy({ left: 520, behavior: 'smooth' });
        });
      }

      rail.addEventListener('scroll', () => updateNavState());
      window.addEventListener('resize', () => updateNavState());
      updateNavState();
    });
  });

  document.querySelectorAll('.pdfflix__rail').forEach((rail) => {
    rail.addEventListener(
      'wheel',
      (event) => {
        if (event.shiftKey) return;
        if (Math.abs(event.deltaX) > Math.abs(event.deltaY)) return;
        rail.scrollBy({ left: event.deltaY, behavior: 'auto' });
        event.preventDefault();
      },
      { passive: false }
    );
  });

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

  await renderResumos();
  await renderStudies();
  await renderVideos();
});
