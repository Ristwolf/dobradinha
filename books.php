<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Instituto Hack</title>
  <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <style>
    .book-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 25px -5px rgba(0,0,0,.1), 0 10px 10px -5px rgba(0,0,0,.06);
    }
    .hero-bg{
      background: linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url('http://static.photos/workspace/1200x630/42');
      background-size: cover; background-position: center;
    }
    .badge {
      display:inline-block; font-size:.75rem; padding:.15rem .5rem; border-radius:.375rem;
      background:#fef3c7; color:#92400e; border:1px solid #fcd34d;
    }
  </style>
</head>
<body class="font-serif bg-gray-50">

  <!-- Nav -->
  <nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex items-center">
          <a href="/" class="text-xl font-bold text-gray-800">Dobradinha Hack</a>
        </div>
        <div class="hidden md:flex items-center space-x-8">
          <a href="/" class="text-gray-800 hover:text-amber-600 transition">Home</a>
          <a href="#books-jonathan-autorais" class="text-gray-800 hover:text-amber-600 transition">Autorais Jonathan</a>
          <a href="#books-jonathan-traduzidos" class="text-gray-800 hover:text-amber-600 transition">Traduzidos Jonathan</a>
          <a href="#books-osvaldo-autorais" class="text-gray-800 hover:text-amber-600 transition">Autorais Osvaldo</a>
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


                        <!-- <div class="flex justify-between items-center">
                            <span class="text-amber-600 font-medium">R$ 14.99</span>
                            <a href="https://www.amazon.com.br/Para-que-voc%C3%AA-serve-refletir-ebook/dp/B08DNMKRFC?ref_=ast_author_dp&dib=eyJ2IjoiMSJ9.YKwVS20Re0ZnUXxYQS83Sw3jHPpFE18bYsreX0SMeZHGjHj071QN20LucGBJIEps.9oG6Rp8j5QTgT7xuveOHz5wsaJf1edGGiuw2xqWEo8w&dib_tag=AUTHOR" target="_blank" class="text-gray-800 hover:text-amber-600 transition flex items-center">
                                <span>Livro digital</span>
                                <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </a>
                        </div> -->

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Card exemplo com link real já usado por você -->
        <a href="https://www.amazon.com.br/Para-que-voc%C3%AA-serve-refletir-ebook/dp/B08DNMKRFC"
           target="_blank" rel="noopener noreferrer"
           class="book-card bg-white rounded-lg overflow-hidden shadow-md block"
           data-aos="fade-up" data-aos-delay="100">
          <img src="http://static.photos/black/640x360/1" alt="Para que você serve? (Refletir)" class="w-full h-64 object-cover">
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

        <!-- Duplique este bloco para mais livros autorais do Jonathan -->
        <a href="#"
           target="_blank" rel="noopener noreferrer"
           class="book-card bg-white rounded-lg overflow-hidden shadow-md block"
           data-aos="fade-up" data-aos-delay="200">
          <img src="http://static.photos/black/640x360/2" alt="Vida longa e próspera: Sermões em Dt 1–4" class="w-full h-64 object-cover">
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

      </div>
    </div>
  </section>

  <!-- ======= Seção 2: Livros traduzidos — Jonathan ======= -->
  <section id="books-jonathan-traduzidos" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Livros traduzidos — Jonathan</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Obras traduzidas para o português por Jonathan Hack</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- Card exemplo traduzido -->
        <a href="#"
           target="_blank" rel="noopener noreferrer"
           class="book-card bg-white rounded-lg overflow-hidden shadow-md block"
           data-aos="fade-up" data-aos-delay="100">
          <img src="http://static.photos/black/640x360/4" alt="Título Exemplo (tradução 1)" class="w-full h-64 object-cover">
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-xl font-bold text-gray-800">Título Exemplo (tradução 1)</h3>
              <span class="badge">Tradução</span>
            </div>
            <p class="text-sm text-gray-500 mb-3">Autor Internacional • Traduzido</p>
            <p class="text-gray-600 mb-4">Edição comentada em português.</p>
            <div class="flex justify-between items-center">
              <span class="text-amber-600 font-medium">Ver na Amazon</span>
              <span class="text-gray-800 group-hover:text-amber-600 transition inline-flex items-center">
                <span>Abrir</span><i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
              </span>
            </div>
          </div>
        </a>

        <!-- Duplique para mais traduzidos do Jonathan -->
        <a href="#"
           target="_blank" rel="noopener noreferrer"
           class="book-card bg-white rounded-lg overflow-hidden shadow-md block"
           data-aos="fade-up" data-aos-delay="200">
          <img src="http://static.photos/black/640x360/5" alt="Título Exemplo (tradução 2)" class="w-full h-64 object-cover">
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-xl font-bold text-gray-800">Título Exemplo (tradução 2)</h3>
              <span class="badge">Tradução</span>
            </div>
            <p class="text-sm text-gray-500 mb-3">Autor Internacional • Traduzido</p>
            <p class="text-gray-600 mb-4">Comentado e revisado.</p>
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

  <!-- ======= Seção 3: Livros autorais — Osvaldo ======= -->
  <section id="books-osvaldo-autorais" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Livros autorais — Osvaldo</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Obras escritas por Osvaldo Hack</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- Card exemplo autoral Osvaldo -->
        <a href="#"
           target="_blank" rel="noopener noreferrer"
           class="book-card bg-white rounded-lg overflow-hidden shadow-md block"
           data-aos="fade-up" data-aos-delay="100">
          <img src="http://static.photos/black/640x360/3" alt="Presbiterianismo catarinense" class="w-full h-64 object-cover">
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-xl font-bold text-gray-800">Presbiterianismo catarinense</h3>
              <span class="badge">Impresso</span>
            </div>
            <p class="text-sm text-gray-500 mb-3">Osvaldo Hack • Autor</p>
            <p class="text-gray-600 mb-4">Título ilustrativo. Substitua e aponte para a Amazon.</p>
            <div class="flex justify-between items-center">
              <span class="text-amber-600 font-medium">Ver na Amazon</span>
              <span class="text-gray-800 group-hover:text-amber-600 transition inline-flex items-center">
                <span>Abrir</span><i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
              </span>
            </div>
          </div>
        </a>

        <!-- Duplique para mais autorais do Osvaldo -->
        <a href="#"
           target="_blank" rel="noopener noreferrer"
           class="book-card bg-white rounded-lg overflow-hidden shadow-md block"
           data-aos="fade-up" data-aos-delay="200">
          <img src="http://static.photos/black/640x360/6" alt="Outro título de Osvaldo" class="w-full h-64 object-cover">
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
  <footer class="bg-gray-900 text-gray-400 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p>&copy; <span id="y"></span> Dobradinha Hack. Todos os direitos reservados.</p>
    </div>
  </footer>

  <script>
    AOS.init({ duration: 800, easing: 'ease-in-out', once: true });
    feather.replace();
    document.getElementById('y').textContent = new Date().getFullYear();

    // Menu mobile (placeholder)
    document.querySelector('.mobile-menu-button')?.addEventListener('click', function () {
      alert('Menu mobile (placeholder).');
    });
  </script>
</body>
</html>
