<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Instituto Hack</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@4.10.38/build/pdf.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="stylesheet" href="../styles/main.css">
  <script src="../scripts/main.js" defer></script>
</head>
<body class="font-serif bg-gray-50">

  <?php $basePath = '../'; include __DIR__ . '/../partials/navbar.php'; ?>

  <header class="hero-bg min-h-[28vh] flex items-center justify-center text-white">
    <div class="text-center px-4" data-aos="fade-up">
      <h1 class="text-4xl md:text-6xl font-bold mb-4">Estudos</h1>
      <p class="text-lg md:text-xl opacity-90">PDFs organizados por categoria</p>
    </div>
  </header>

  <main
    class="py-16 bg-white" style="padding-top:2rem;"
    id="tabs"
    data-page="studies"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <section class="pdfflix" data-aos="fade-up">
        <div class="w-full overflow-x-auto">
          <div class="flex flex-wrap justify-center gap-4 border-b border-white/10 pb-2" role="tablist" aria-label="Categorias de estudos">
            <button class="tab px-4 py-2 text-gray-200 hover:text-amber-300 transition" role="tab" aria-selected="true" aria-controls="panel-bible" id="tab-bible" data-target="bible">Bíblia</button>
            <button class="tab px-4 py-2 text-gray-200 hover:text-amber-300 transition" role="tab" aria-selected="false" aria-controls="panel-books" id="tab-books" data-target="books">Livros</button>
            <button class="tab px-4 py-2 text-gray-200 hover:text-amber-300 transition" role="tab" aria-selected="false" aria-controls="panel-family" id="tab-family" data-target="family">Família</button>
          </div>
        </div>

        <section class="mt-8">
          <div id="panel-bible" class="tab-panel" role="tabpanel" aria-labelledby="tab-bible" data-panel="bible">
            <div class="pdfflix__row" data-row="bible">
              <div class="pdfflix__carousel">
                <div class="pdfflix__rails"> 
                  <div class="pdfflix__rowHead">
                    <h3>Deuteronômio</h3>
                  </div>
                  <div class="pdfflix__railWrap" data-rail-wrap="top">
                    <button class="pdfflix__nav pdfflix__nav--left" data-dir="-1" aria-label="Scroll left" type="button">‹</button>
                    <div class="pdfflix__rail" data-studies-container="bible" data-studies-section="dt" data-rail="top" style="padding-left: 24px;"></div>
                    <button class="pdfflix__nav pdfflix__nav--right" data-dir="1" aria-label="Scroll right" type="button">›</button>
                  </div>
                  <div class="pdfflix__rowHead">
                    <h3>Sermões</h3>
                  </div>
                  <div class="pdfflix__railWrap" data-rail-wrap="bottom">
                    <button class="pdfflix__nav pdfflix__nav--left" data-dir="-1" aria-label="Scroll left" type="button">‹</button>
                    <div class="pdfflix__rail" data-studies-container="bible" data-studies-section="sermons" data-rail="bottom" style="padding-left: 24px;"></div>
                    <button class="pdfflix__nav pdfflix__nav--right" data-dir="1" aria-label="Scroll right" type="button">›</button>
                  </div>
                  <div class="pdfflix__rowHead">
                    <h3>Estudos</h3>
                  </div>
                  <div class="pdfflix__railWrap" data-rail-wrap="bottom">
                    <button class="pdfflix__nav pdfflix__nav--left" data-dir="-1" aria-label="Scroll left" type="button">‹</button>
                    <div class="pdfflix__rail" data-studies-container="bible" data-studies-section="studies" data-rail="bottom" style="padding-left: 24px;"></div>
                    <button class="pdfflix__nav pdfflix__nav--right" data-dir="1" aria-label="Scroll right" type="button">›</button>
                  </div>
                  <div class="pdfflix__rowHead">
                    <h3>Teologia</h3>
                  </div>
                  <div class="pdfflix__railWrap" data-rail-wrap="bottom">
                    <button class="pdfflix__nav pdfflix__nav--left" data-dir="-1" aria-label="Scroll left" type="button">‹</button>
                    <div class="pdfflix__rail" data-studies-container="bible" data-studies-section="teology" data-rail="bottom" style="padding-left: 24px;"></div>
                    <button class="pdfflix__nav pdfflix__nav--right" data-dir="1" aria-label="Scroll right" type="button">›</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="panel-books" class="tab-panel hidden-panel" role="tabpanel" aria-labelledby="tab-books" data-panel="books">
            <div class="pdfflix__row" data-row="books">
              <div class="pdfflix__carousel">
                <div class="pdfflix__rails">
                  <div class="pdfflix__rowHead">
                    <h3>Geral</h3>
                  </div>
                  <div class="pdfflix__railWrap" data-rail-wrap="top">
                    <button class="pdfflix__nav pdfflix__nav--left" data-dir="-1" aria-label="Scroll left" type="button">‹</button>
                    <div class="pdfflix__rail" data-studies-container="books" data-studies-section="general" data-rail="top" style="padding-left: 24px;"></div>
                    <button class="pdfflix__nav pdfflix__nav--right" data-dir="1" aria-label="Scroll right" type="button">›</button>
                  </div>
                  <div class="pdfflix__rowHead">
                    <h3>Teologia</h3>
                  </div>
                  <div class="pdfflix__railWrap" data-rail-wrap="top">
                    <button class="pdfflix__nav pdfflix__nav--left" data-dir="-1" aria-label="Scroll left" type="button">‹</button>
                    <div class="pdfflix__rail" data-studies-container="books" data-studies-section="teology" data-rail="top" style="padding-left: 24px;"></div>
                    <button class="pdfflix__nav pdfflix__nav--right" data-dir="1" aria-label="Scroll right" type="button">›</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="panel-family" class="tab-panel hidden-panel" role="tabpanel" aria-labelledby="tab-family" data-panel="family">
            <div class="pdfflix__row" data-row="family">
              <div class="pdfflix__carousel">
                <div class="pdfflix__rowHead">
                  <h3>Filhos</h3>
                </div>
                <div class="pdfflix__rails">
                  <div class="pdfflix__railWrap" data-rail-wrap="top">
                    <button class="pdfflix__nav pdfflix__nav--left" data-dir="-1" aria-label="Scroll left" type="button">‹</button>
                    <div class="pdfflix__rail" data-studies-container="family" data-studies-section="children" data-rail="top" style="padding-left: 24px;"></div>
                    <button class="pdfflix__nav pdfflix__nav--right" data-dir="1" aria-label="Scroll right" type="button">›</button>
                  </div>
                </div>

                <div class="pdfflix__rowHead">
                  <h3>Conflitos</h3>
                </div>
                <div class="pdfflix__rails">
                  <div class="pdfflix__railWrap" data-rail-wrap="top">
                    <button class="pdfflix__nav pdfflix__nav--left" data-dir="-1" aria-label="Scroll left" type="button">‹</button>
                    <div class="pdfflix__rail" data-studies-container="family" data-studies-section="conflicts" data-rail="top" style="padding-left: 24px;"></div>
                    <button class="pdfflix__nav pdfflix__nav--right" data-dir="1" aria-label="Scroll right" type="button">›</button>
                  </div>
                </div>

                <div class="pdfflix__rowHead">
                  <h3>Vida</h3>
                </div>
                <div class="pdfflix__rails">
                  <div class="pdfflix__railWrap" data-rail-wrap="top">
                    <button class="pdfflix__nav pdfflix__nav--left" data-dir="-1" aria-label="Scroll left" type="button">‹</button>
                    <div class="pdfflix__rail" data-studies-container="family" data-studies-section="life" data-rail="top" style="padding-left: 24px;"></div>
                    <button class="pdfflix__nav pdfflix__nav--right" data-dir="1" aria-label="Scroll right" type="button">›</button>
                  </div>
                </div>

                <div class="pdfflix__rowHead">
                  <h3>Casamento</h3>
                </div>
                <div class="pdfflix__rails">
                  <div class="pdfflix__railWrap" data-rail-wrap="top">
                    <button class="pdfflix__nav pdfflix__nav--left" data-dir="-1" aria-label="Scroll left" type="button">‹</button>
                    <div class="pdfflix__rail" data-studies-container="family" data-studies-section="marriage" data-rail="top" style="padding-left: 24px;"></div>
                    <button class="pdfflix__nav pdfflix__nav--right" data-dir="1" aria-label="Scroll right" type="button">›</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </section>
    </div>
  </main>

  <div class="pdfflixModal" id="pdfflixModal" aria-hidden="true">
    <div class="pdfflixModal__backdrop" data-close></div>

    <div class="pdfflixModal__panel" role="dialog" aria-modal="true" aria-label="PDF viewer">
      <button class="pdfflixModal__close" data-close aria-label="Close" type="button">✕</button>

      <div class="pdfflixModal__meta">
        <div>
          <div class="pdfflixModal__name" id="pdfflixModalTitle">Título</div>
          <div class="pdfflixModal__desc" id="pdfflixModalDesc"></div>
        </div>

        <div class="pdfflixModal__actions">
          <a class="pdfflixBtn" id="pdfflixOpenNewTab" target="_blank" rel="noreferrer">Abrir</a>
          <a class="pdfflixBtn pdfflixBtn--ghost" id="pdfflixDownload" download>Baixar</a>
        </div>
      </div>

      <iframe class="pdfflixModal__viewer" id="pdfflixModalFrame" title="PDF content"></iframe>
    </div>
  </div>

  <?php include __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
