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
  const subpages = ['/studies/', '/abstracts/', '/books/', '/videos/', '/about/'];
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

async function renderAbstracts() {
  const page = document.querySelector('[data-page="abstracts"]');
  if (!page) return;

  const prefix = getSiteRelativePrefix();

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

    for (const file of category.files) {
      container.appendChild(createPdfCard({ title: file.name, url: resolveSiteUrl(prefix, file.url) }));
    }
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
