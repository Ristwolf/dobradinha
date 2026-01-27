<?php
// summaries.php — Página de resumos com 5 categorias em abas

$siteTitle = 'institutohack';
$pageTitle = 'Resumos de Livros';

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
?><!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo h($siteTitle . ' | ' . $pageTitle); ?></title>
  <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <style>
    .hero-bg{
      background: linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url('http://static.photos/workspace/1200x630/42');
      background-size: cover; background-position: center;
    }
    .tab {
      border-bottom: 2px solid transparent;
    }
    .tab[aria-selected="true"] {
      color: #92400e; /* amber-800 */
      border-bottom-color: #f59e0b; /* amber-500 */
      font-weight: 700;
    }
    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 18px 22px -8px rgba(0,0,0,.12), 0 8px 10px -6px rgba(0,0,0,.06);
    }
    /* util para esconder/mostrar painéis */
    .hidden-panel { display: none; }
  </style>
</head>
<body class="font-serif bg-gray-50">

  <!-- Nav -->
  <nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex items-center">
          <a href="/" class="text-xl font-bold text-gray-800">institutohack</a>
        </div>
        <div class="hidden md:flex items-center space-x-8">
          <a href="/curso-php/site/index.php" class="text-gray-800 hover:text-amber-600 transition">Home</a>
          <a href="#tabs" class="text-gray-800 hover:text-amber-600 transition">Resumos</a>
        </div>
        <div class="md:hidden flex items-center">
          <button class="mobile-menu-button" aria-label="Abrir menu"><i data-feather="menu"></i></button>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <header class="hero-bg min-h-[40vh] flex items-center justify-center text-white">
    <div class="text-center px-4" data-aos="fade-up">
      <h1 class="text-4xl md:text-6xl font-bold mb-4"><?php echo h($pageTitle); ?></h1>
      <p class="text-lg md:text-xl opacity-90">Seleção de resumos por categoria</p>
    </div>
  </header>

  <!-- Tabs -->
  <main class="py-16 bg-white" id="tabs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Abas (role=tablist) -->
      <div class="w-full overflow-x-auto" data-aos="fade-up">
        <div class="inline-flex min-w-full md:min-w-0 gap-4 border-b border-gray-200 pb-2" role="tablist" aria-label="Categorias de resumos">
          <button class="tab px-4 py-2 text-gray-700 hover:text-amber-700 transition"
                  role="tab" aria-selected="true" aria-controls="panel-teologia" id="tab-teologia" data-target="teologia">
            Teologia
          </button>
          <button class="tab px-4 py-2 text-gray-700 hover:text-amber-700 transition"
                  role="tab" aria-selected="false" aria-controls="panel-exegese" id="tab-exegese" data-target="exegese">
            Exegese Bíblica
          </button>
          <button class="tab px-4 py-2 text-gray-700 hover:text-amber-700 transition"
                  role="tab" aria-selected="false" aria-controls="panel-historia" id="tab-historia" data-target="historia">
            História da Igreja
          </button>
          <button class="tab px-4 py-2 text-gray-700 hover:text-amber-700 transition"
                  role="tab" aria-selected="false" aria-controls="panel-vida" id="tab-vida" data-target="vida">
            Vida Cristã
          </button>
          <button class="tab px-4 py-2 text-gray-700 hover:text-amber-700 transition"
                  role="tab" aria-selected="false" aria-controls="panel-educacao" id="tab-educacao" data-target="educacao">
            Educação/Apologética
          </button>
        </div>
      </div>

      <!-- Painéis -->
      <section class="mt-10">

        <!-- Painel: Teologia -->
        <div id="panel-teologia" class="tab-panel" role="tabpanel" aria-labelledby="tab-teologia" data-panel="teologia">
          <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Teologia</h2>
            <p class="text-gray-600 mt-2">Sistemática, doutrina e fundamentos</p>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card exemplo -->
            <article class="bg-white rounded-lg overflow-hidden shadow-md card" data-aos="fade-up" data-aos-delay="100">
              <img src="http://static.photos/black/640x360/1" alt="Capa do livro" class="w-full h-48 object-cover">
              <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-1">Título do Livro (Exemplo)</h3>
                <p class="text-sm text-gray-500 mb-3">Autor • Editora • Ano</p>
                <p class="text-gray-600 mb-4">
                  <strong>Ideias-chave:</strong> Justificação pela fé; suficiência das Escrituras; cristologia bíblica.
                </p>
                <ul class="text-gray-600 text-sm list-disc list-inside mb-4">
                  <li>Cap. 1 — Resumo curto do argumento.</li>
                  <li>Cap. 2 — Pontos centrais com referências.</li>
                  <li>Cap. 3 — Implicações pastorais.</li>
                </ul>
                <div class="flex items-center justify-between">
                  <a href="#" target="_blank" class="text-amber-600 hover:text-amber-700 font-medium inline-flex items-center">
                    <span>Ver notas completas</span>
                    <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                  </a>
                  <span class="text-xs text-gray-500">~6 min</span>
                </div>
              </div>
            </article>
            <!-- Duplique mais cards aqui -->
          </div>
        </div>

        <!-- Painel: Exegese Bíblica -->
        <div id="panel-exegese" class="tab-panel hidden-panel" role="tabpanel" aria-labelledby="tab-exegese" data-panel="exegese">
          <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Exegese Bíblica</h2>
            <p class="text-gray-600 mt-2">Métodos, contextos e aplicações</p>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <article class="bg-white rounded-lg overflow-hidden shadow-md card" data-aos="fade-up" data-aos-delay="100">
              <img src="http://static.photos/workspace/640x360/11" alt="Capa do livro" class="w-full h-48 object-cover">
              <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-1">Manual de Exegese (Exemplo)</h3>
                <p class="text-sm text-gray-500 mb-3">Autor • Editora • Ano</p>
                <p class="text-gray-600 mb-4">
                  <strong>Ideias-chave:</strong> Análise literária; histórico-cultural; intertextualidade.
                </p>
                <ul class="text-gray-600 text-sm list-disc list-inside mb-4">
                  <li>Método de observação e estrutura.</li>
                  <li>Vocabulário e semântica.</li>
                  <li>Aplicação contemporânea responsável.</li>
                </ul>
                <div class="flex items-center justify-between">
                  <a href="#" target="_blank" class="text-amber-600 hover:text-amber-700 font-medium inline-flex items-center">
                    <span>Ver notas completas</span>
                    <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                  </a>
                  <span class="text-xs text-gray-500">~7 min</span>
                </div>
              </div>
            </article>
          </div>
        </div>

        <!-- Painel: História da Igreja -->
        <div id="panel-historia" class="tab-panel hidden-panel" role="tabpanel" aria-labelledby="tab-historia" data-panel="historia">
          <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">História da Igreja</h2>
            <p class="text-gray-600 mt-2">Movimentos, personagens e eventos</p>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <article class="bg-white rounded-lg overflow-hidden shadow-md card" data-aos="fade-up" data-aos-delay="100">
              <img src="http://static.photos/workspace/640x360/12" alt="Capa do livro" class="w-full h-48 object-cover">
              <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-1">Reforma e Legados (Exemplo)</h3>
                <p class="text-sm text-gray-500 mb-3">Autor • Editora • Ano</p>
                <p class="text-gray-600 mb-4">
                  <strong>Ideias-chave:</strong> 5 Solas; influência educacional; tradição confessional.
                </p>
                <ul class="text-gray-600 text-sm list-disc list-inside mb-4">
                  <li>Contexto pré-Reforma.</li>
                  <li>Principais reformas e controvérsias.</li>
                  <li>Impactos na liturgia e educação.</li>
                </ul>
                <div class="flex items-center justify-between">
                  <a href="#" target="_blank" class="text-amber-600 hover:text-amber-700 font-medium inline-flex items-center">
                    <span>Ver notas completas</span>
                    <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                  </a>
                  <span class="text-xs text-gray-500">~8 min</span>
                </div>
              </div>
            </article>
          </div>
        </div>

        <!-- Painel: Vida Cristã -->
        <div id="panel-vida" class="tab-panel hidden-panel" role="tabpanel" aria-labelledby="tab-vida" data-panel="vida">
          <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Vida Cristã</h2>
            <p class="text-gray-600 mt-2">Espiritualidade, ética e prática pastoral</p>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <article class="bg-white rounded-lg overflow-hidden shadow-md card" data-aos="fade-up" data-aos-delay="100">
              <img src="http://static.photos/workspace/640x360/13" alt="Capa do livro" class="w-full h-48 object-cover">
              <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-1">Disciplinas da Graça (Exemplo)</h3>
                <p class="text-sm text-gray-500 mb-3">Autor • Editora • Ano</p>
                <p class="text-gray-600 mb-4">
                  <strong>Ideias-chave:</strong> práticas devocionais; formação de caráter; serviço.
                </p>
                <ul class="text-gray-600 text-sm list-disc list-inside mb-4">
                  <li>Oração e meditação nas Escrituras.</li>
                  <li>Comunidade e discipulado.</li>
                  <li>Trabalho e mordomia.</li>
                </ul>
                <div class="flex items-center justify-between">
                  <a href="#" target="_blank" class="text-amber-600 hover:text-amber-700 font-medium inline-flex items-center">
                    <span>Ver notas completas</span>
                    <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                  </a>
                  <span class="text-xs text-gray-500">~5 min</span>
                </div>
              </div>
            </article>
          </div>
        </div>

        <!-- Painel: Educação/Apologética -->
        <div id="panel-educacao" class="tab-panel hidden-panel" role="tabpanel" aria-labelledby="tab-educacao" data-panel="educacao">
          <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Educação/Apologética</h2>
            <p class="text-gray-600 mt-2">Ensino, cosmovisão e defesa da fé</p>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <article class="bg-white rounded-lg overflow-hidden shadow-md card" data-aos="fade-up" data-aos-delay="100">
              <img src="http://static.photos/black/640x360/2" alt="Capa do livro" class="w-full h-48 object-cover">
              <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-1">Cosmovisão em Perspectiva (Exemplo)</h3>
                <p class="text-sm text-gray-500 mb-3">Autor • Editora • Ano</p>
                <p class="text-gray-600 mb-4">
                  <strong>Ideias-chave:</strong> criação-queda-redenção; verdade e cultura; formação integral.
                </p>
                <ul class="text-gray-600 text-sm list-disc list-inside mb-4">
                  <li>Fundamentos bíblicos de uma cosmovisão cristã.</li>
                  <li>Diálogo fé–ciência–sociedade.</li>
                  <li>Práticas pedagógicas cristãs.</li>
                </ul>
                <div class="flex items-center justify-between">
                  <a href="#" target="_blank" class="text-amber-600 hover:text-amber-700 font-medium inline-flex items-center">
                    <span>Ver notas completas</span>
                    <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                  </a>
                  <span class="text-xs text-gray-500">~9 min</span>
                </div>
              </div>
            </article>
          </div>
        </div>

      </section>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-400 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p>&copy; <?php echo date('Y'); ?> <?php echo h($siteTitle); ?>. Todos os direitos reservados.</p>
    </div>
  </footer>

  <script>
    AOS.init({ duration: 800, easing: 'ease-in-out', once: true });
    feather.replace();

    // Tabs: acessível e simples
    const tabs = document.querySelectorAll('[role="tab"]');
    const panels = document.querySelectorAll('.tab-panel');

    function activateTab(targetKey) {
      tabs.forEach(tab => {
        const active = tab.dataset.target === targetKey;
        tab.setAttribute('aria-selected', active ? 'true' : 'false');
      });
      panels.forEach(panel => {
        const match = panel.dataset.panel === targetKey;
        panel.classList.toggle('hidden-panel', !match);
      });
    }

    tabs.forEach(tab => {
      tab.addEventListener('click', () => activateTab(tab.dataset.target));
      tab.addEventListener('keydown', (e) => {
        // setas navegam entre abas
        const idx = Array.from(tabs).indexOf(tab);
        if (e.key === 'ArrowRight') {
          const next = tabs[(idx + 1) % tabs.length];
          next.focus(); activateTab(next.dataset.target);
        } else if (e.key === 'ArrowLeft') {
          const prev = tabs[(idx - 1 + tabs.length) % tabs.length];
          prev.focus(); activateTab(prev.dataset.target);
        }
      });
    });

    // Seleciona aba pela âncora (#exegese etc.)
    const hash = window.location.hash.replace('#','');
    if (hash && document.querySelector(`[data-target="${hash}"]`)) {
      activateTab(hash);
    } else {
      activateTab('teologia'); // padrão
    }

    // Menu mobile (placeholder)
    document.querySelector('.mobile-menu-button')?.addEventListener('click', function () {
      alert('Menu mobile (placeholder).');
    });
  </script>
</body>
</html>
