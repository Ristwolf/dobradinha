<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Instituto Hack</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="stylesheet" href="../styles/main.css">
  <script src="../scripts/main.js" defer></script>
</head>
<body class="font-serif bg-gray-50">

  <!-- Nav (global) -->
  <?php $basePath = '../'; include __DIR__ . '/../partials/navbar.php'; ?>

  <!-- Hero -->
  <header class="hero-bg min-h-[28vh] flex items-center justify-center text-white">
    <div class="text-center px-4" data-aos="fade-up">
      <h1 class="text-4xl md:text-6xl font-bold mb-4">Livros</h1>
      <p class="text-lg md:text-xl opacity-90">Catálogo com links diretos para a Amazon</p>
    </div>
  </header>

  <!-- ======= Seção 1: Livros autorais — Jonathan ======= -->
  <section id="books-jonathan-autorais" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Livros autorais — Jonathan</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Obras escritas por Jonathan Hack</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <a href="https://www.amazon.com.br/Para-que-voc%C3%AA-serve-refletir-ebook/dp/B08DNMKRFC?ref_=ast_author_dp&th=1&psc=1"
           target="_blank" rel="noopener noreferrer"
           class="book-card bg-slate-50 rounded-lg overflow-hidden shadow-md block"
           data-aos="fade-up" data-aos-delay="100">
          <img src="../img/books/para_que_voce_serve_.jpg" alt="Para que você serve? (Refletir)" class="w-full h-[37rem] object-cover">
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-xl font-bold text-gray-800">Para que você serve? (Refletir)</h3>
              <span class="badge">E-book</span>
            </div>
            <p class="text-sm text-gray-500 mb-3">Jonathan Hack • Autor</p>
            <p class="text-gray-600 mb-4">Coletânea de reflexões breves para o cotidiano cristão.</p>
            <div class="flex justify-between items-center">
              <span class="text-amber-600 font-medium">Ver na Amazon</span>
              <span class="text-gray-800 group-hover:text-amber-600 transition inline-flex items-center">
                <span>Abrir</span><i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
              </span>
            </div>
          </div>
        </a>

        <a href="https://www.amazon.com.br/Vida-longa-pr%C3%B3spera-estudos-Deuteron%C3%B4mio-ebook/dp/B0FLZWZDN6?ref_=ast_author_dp&th=1&psc=1"
           target="_blank" rel="noopener noreferrer"
           class="book-card bg-slate-50 rounded-lg overflow-hidden shadow-md block"
           data-aos="fade-up" data-aos-delay="200">
          <img src="../img/books/vida_longa_e_prospera.jpg" alt="Vida longa e próspera: Sermões em Dt 1–4" class="w-full h-[37rem] object-cover">
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-xl font-bold text-gray-800">Vida longa e próspera: Sermões em Dt 1–4</h3>
              <span class="badge">Novo</span>
            </div>
            <p class="text-sm text-gray-500 mb-3">Jonathan Hack • Autor</p>
            <p class="text-gray-600 mb-4">Sermões e estudos expositivos em Deuteronômio 1–4.</p>
            <div class="flex justify-between items-center">
              <span class="text-amber-600 font-medium">Ver na Amazon</span>
              <span class="text-gray-800 group-hover:text-amber-600 transition inline-flex items-center">
                <span>Abrir</span><i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
              </span>
            </div>
          </div>
        </a>

        <a href="https://www.amazon.com.br/Vida-longa-pr%C3%B3spera-serm%C3%B5es-Deuteron%C3%B4mio-ebook/dp/B0FM1MNH48?ref_=ast_author_dp&th=1&psc=1"
           target="_blank" rel="noopener noreferrer"
           class="book-card bg-slate-50 rounded-lg overflow-hidden shadow-md block"
           data-aos="fade-up" data-aos-delay="200">
          <img src="../img/books/vida_longa_e_prospera_dt_1_4.jpg" alt="Vida longa e próspera: Sermões em Dt 1–4" class="w-full h-[37rem] object-cover">
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-xl font-bold text-gray-800">Vida longa e próspera: Sermões em Dt 1–4</h3>
              <span class="badge">Novo</span>
            </div>
            <p class="text-sm text-gray-500 mb-3">Jonathan Hack • Autor</p>
            <p class="text-gray-600 mb-4">Sermões e estudos expositivos em Deuteronômio 1–4.</p>
            <div class="flex justify-between items-center">
              <span class="text-amber-600 font-medium">Ver na Amazon</span>
              <span class="text-gray-800 group-hover:text-amber-600 transition inline-flex items-center">
                <span>Abrir</span><i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
              </span>
            </div>
          </div>
        </a>

        <a href="https://www.amazon.com.br/Tolkien-B%C3%ADblia-teol%C3%B3gicas-legend%C3%A1rio-tolkieniano-ebook/dp/B08H7Y8R3C?ref_=ast_author_dp&th=1&psc=1"
           target="_blank" rel="noopener noreferrer"
           class="book-card bg-slate-50 rounded-lg overflow-hidden shadow-md block"
           data-aos="fade-up" data-aos-delay="300">
          <img src="../img/books/tolkien_e_a_biblia.jpg" alt="Tolkien e a Bíblia" class="w-full h-[37rem] object-cover">
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-xl font-bold text-gray-800">Tolkien e a Bíblia</h3>
              <span class="badge">E-book</span>
            </div>
            <p class="text-sm text-gray-500 mb-3">Jonathan Hack • Autor</p>
            <p class="text-gray-600 mb-4">Contribuições teológicas do legendário tolkieniano.</p>
            <div class="flex justify-between items-center">
              <span class="text-amber-600 font-medium">Ver na Amazon</span>
              <span class="text-gray-800 group-hover:text-amber-600 transition inline-flex items-center">
                <span>Abrir</span><i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
              </span>
            </div>
          </div>
        </a>

        <a href="https://www.amazon.com.br/Minha-hist%C3%B3ria-sobre-Ossos-ebook/dp/B0B7TB2TBB?ref_=ast_author_dp&th=1&psc=1"
           target="_blank" rel="noopener noreferrer"
           class="book-card bg-slate-50 rounded-lg overflow-hidden shadow-md block"
           data-aos="fade-up" data-aos-delay="400">
          <img src="../img/books/minha_historia_sobre_ossos.jpg" alt="Minha história sobre ossos" class="w-full h-[37rem] object-cover">
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-xl font-bold text-gray-800">Minha história sobre ossos</h3>
              <span class="badge">E-book</span>
            </div>
            <p class="text-sm text-gray-500 mb-3">Jonathan Hack • Autor</p>
            <p class="text-gray-600 mb-4">Notas de um caminhar vocacional e espiritual.</p>
            <div class="flex justify-between items-center">
              <span class="text-amber-600 font-medium">Ver na Amazon</span>
              <span class="text-gray-800 group-hover:text-amber-600 transition inline-flex items-center">
                <span>Abrir</span><i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
              </span>
            </div>
          </div>
        </a>

        <a href="#"
           target="_blank" rel="noopener noreferrer"
           class="book-card bg-white rounded-lg overflow-hidden shadow-md block"
           data-aos="fade-up" data-aos-delay="200">
          <img src="http://static.photos/black/640x360/6" alt="Outro título de Osvaldo" class="w-full h-[37rem] object-cover">
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-xl font-bold text-gray-800">Outro título de Osvaldo</h3>
              <span class="badge">Impresso</span>
            </div>
            <p class="text-sm text-gray-500 mb-3">Osvaldo Hack • Autor</p>
            <p class="text-gray-600 mb-4">Descrição curta. Substitua e aponte para a Amazon.</p>
            <div class="flex justify-between items-center">
              <span class="text-amber-600 font-medium">Ver na Amazon</span>
              <span class="text-gray-800 group-hover:text-amber-600 transition inline-flex items-center">
                <span>Abrir</span><i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
              </span>
            </div>
          </div>
        </a>

      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
