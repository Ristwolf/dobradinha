<?php 
// Cole este bloco antes do <!DOCTYPE html> ou logo após <body>
$studies = [
    [
        'date'        => '2025-05-15',
        'title'       => 'Meu processo de escrita: Da ideia à publicação',
        'description' => 'Como eu desenvolvo meus textos a partir de uma ideia.',
        'image'       => 'http://static.photos/workspace/640x360/11',
        'read_time'   => 5,
        'url'         => '#'
    ],
    [
        'date'        => '2025-04-03',
        'title'       => 'Exemplo texto studies 2',
        'description' => 'Reflexões práticas sobre bloqueio criativo e disciplina.',
        'image'       => 'http://static.photos/workspace/640x360/12',
        'read_time'   => 4,
        'url'         => '#'
    ],
    [
        'date'        => '2025-03-18',
        'title'       => 'Exemplo texto studies 3',
        'description' => 'Notas sobre desenvolvimento de personagens e estrutura.',
        'image'       => 'http://static.photos/workspace/640x360/13',
        'read_time'   => 7,
        'url'         => '#'
    ],
];

// (Opcional) formatador de data simples (pt-BR)
function formatDatePtBr($dateIso)
{
    $ts = strtotime($dateIso);
    return date('d/m/Y', $ts);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Hack</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .hero-bg {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('http://static.photos/workspace/1200x630/42');
            background-size: cover;
            background-position: center;
        }
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .typewriter {
            border-right: 3px solid;
            white-space: nowrap;
            overflow: hidden;
            animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
        }
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: #f3f4f6 }
        }
    </style>
</head>
<body class="font-serif bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-bold text-gray-800">Dobradinha Hack</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-800 hover:text-amber-600 transition">Home</a>
                    <a href="#studies" class="text-gray-800 hover:text-amber-600 transition">Estudos</a>
                    <a href="#abstracts" class="text-gray-800 hover:text-amber-600 transition">Resumos</a>
                    <a href="#books" class="text-gray-800 hover:text-amber-600 transition">Livros</a>
                    <a href="#videos" class="text-gray-800 hover:text-amber-600 transition">Vídeos</a>
                    <a href="#about" class="text-gray-800 hover:text-amber-600 transition">Sobre</a>
                    <a href="#contact" class="text-gray-800 hover:text-amber-600 transition">Contato</a>
                </div>
                <div class="md:hidden flex items-center">
                    <button class="mobile-menu-button">
                        <i data-feather="menu"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg min-h-screen flex items-center justify-center text-white">
        <div class="text-center px-4" data-aos="fade-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Dobradinha Hack</h1>
            <div class="typewriter text-xl md:text-2xl mb-8 mx-auto max-w-2xl">
                Bem-aventurados os que ouvem a palavra de Deus e a guardam.
            </div>
            <a href="#books" class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-full font-medium transition inline-block">
                Explore nossos livros
            </a>
        </div>
    </section>

    <!-- Books Section -->
    <section id="books" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Trabalhos publicados</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Coleção de livros publicados e traduzidos</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Livros autorais Jonathan -->
                <div class="book-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300" data-aos="fade-up" data-aos-delay="100">
                    <img src="http://static.photos/black/640x360/1" alt="Whispers in the Dark" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2"> Jonathan Hack</h3>
                        <p class="text-gray-600 mb-4">Livros autorais. </p>
                        <div class="flex justify-between items-center">
                            <a href="/curso-php/site/videos.php" target="_blank" class="text-gray-800 hover:text-amber-600 transition flex items-center">
                                <span>Veja mais</span>
                                <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Livros traduzidos Jonathan -->
                <div class="book-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300" data-aos="fade-up" data-aos-delay="200">
                    <img src="http://static.photos/black/640x360/2" alt="The Last Summer" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Jonathan Hack</h3>
                        <p class="text-gray-600 mb-4">Livros traduzidos.</p>
                        <div class="flex justify-between items-center">
                            <a href="#" class="text-gray-800 hover:text-amber-600 transition flex items-center">
                                <span>Veja mais</span>
                                <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Livros autorais Osvaldo -->
                <div class="book-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300" data-aos="fade-up" data-aos-delay="300">
                    <img src="http://static.photos/black/640x360/3" alt="Beneath the Surface" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Osvaldo Hack</h3>
                        <p class="text-gray-600 mb-4">Livros autorais.</p>
                        <div class="flex justify-between items-center">
                            <a href="#" class="text-gray-800 hover:text-amber-600 transition flex items-center">
                                <span>Veja mais</span>
                                <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section (two authors) -->
<section id="about" class="py-20 bg-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14" data-aos="fade-up">
      <h2 class="text-3xl font-bold text-gray-800">Sobre os autores</h2>
      <p class="text-gray-600 mt-2">Conheça os dois autores por trás deste projeto</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
      <!-- Author 1 -->
      <article class="bg-white rounded-xl shadow-md overflow-hidden" data-aos="fade-right">
        <div class="md:flex">
          <div class="md:w-2/5">
            <img
              src="./img/J.jpeg"
              alt="Jonathan Luís Hack"
              class="w-full h-64 md:h-full object-cover"
            />
          </div>
          <div class="md:w-3/5 p-8">
            <h3 class="text-2xl font-bold text-gray-800">Jonathan Luís Hack</h3>
            <p class="text-amber-700 font-medium mt-1">Pastor, Teólogo & Professor</p>

            <div class="mt-5 space-y-4 text-gray-600">
              <p>
                Teólogo, pastor presbiteriano e professor universitário. Bacharel em
                Ciências da Computação, com mestrados em Ciências da Religião (UPM) e
                Estudos Teológicos (Calvin Theological Seminary), e doutorado em Letras (UPM).
              </p>
              <p>
                Atuou como professor e coordenador de Teologia na Universidade Presbiteriana
                Mackenzie. Autor de <em>Antigo Testamento: um panorama teológico</em> (2016) e
                <em>Vida longa e próspera: sermões e estudos em Deuteronômio 1–4</em> (JLH, 2025),
                entre outras publicações.
              </p>
              <p>
                Tradutor e editor de obras teológicas na Cultura Cristã; casado com Marineis,
                pai de quatro filhos e avô.
              </p>
            </div>

            <a href="#"
               class="inline-flex items-center mt-6 text-amber-600 hover:text-amber-700 font-medium">
              <span>Mais sobre Jonathan</span>
              <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
            </a>
          </div>
        </div>
      </article>

      <!-- Author 2 -->
      <article class="bg-white rounded-xl shadow-md overflow-hidden" data-aos="fade-left">
        <div class="md:flex">
          <div class="md:w-2/5">
            <img
              src="./img/O.jpeg"
              alt="Segundo Autor(a)"
              class="w-full h-64 md:h-full object-cover"
            />
          </div>
          <div class="md:w-3/5 p-8">
            <h3 class="text-2xl font-bold text-gray-800">Osvaldo Hack</h3>
            <p class="text-amber-700 font-medium mt-1">Autor(a) & Pesquisador(a)</p>

            <div class="mt-5 space-y-4 text-gray-600">
              <p>
                Osvaldo Henrique Hack é pastor presbiteriano e professor universitário. Especializou-se na área da história social religiosa com cursos de mestrado, doutorado e pós-doutorado. É membro do Instituto Histórico e Geográfico de Santa Catarina e da Academia Evangélica de Letras do Brasil. 

              </p>
              <p>
                Dentre os seus livros, destacamos: Protestantismo e educação brasileira (1983), Mackenzie College e o ensino superior brasileiro (2002), Raízes cristãs do Mackenzie e seu perfil confessional (2003), Sementes do calvinismo no Brasil colonial (2007), Semeadura presbiteriana no sul brasileiro (2008), Presbiterianismo no oeste catarinense (2008), Instituto Cristão de Castro (2015), Reforma protestante no sul do Brasil (2017), 120 anos de história: Igreja Presbiteriana de Florianópolis (2020), Presença presbiteriana no Paraná (2021), Presbiterianismo catarinense (2022) e a trilogia Caminhos frutíferos (2024), que revisou os dois últimos livros e acrescentou a história do presbiterianismo gaúcho. Também contribuiu com verbetes sobre escolas presbiterianas no Dicionário enciclopédico de instituições protestantes no Brasil (2019).

              </p>
              <p>
                É pastor emérito (1992) da Igreja Presbiteriana de Florianópolis e pastor jubilado (2011) da Igreja Presbiteriana do Brasil. Foi professor na Faculdade de Filosofia, Ciências e Letras de Itajaí (1966–1967); na Universidade Federal de Santa Catarina (UFSC) (1973–1992); e na Universidade Presbiteriana Mackenzie (UPM), onde foi Chanceler (1996–2003), professor (2003–2006), e membro dos Conselhos de Curadores, Deliberativo e Universitário (2008–2018).

              </p>
              <p>
                Foi presidente de vários concílios eclesiásticos da IPB: Presbitério de Florianópolis (1970–1972, 1976, 1979 e 1981), Sínodo Meridional (1971–1977), Sínodo Sul do Brasil (1982–1996), e Sínodo Integração Catarinense (2005–2011). Foi também presidente de órgãos e comissões da IPB: Secretário Geral do Trabalho Masculino (1982–1986), Junta de Educação Teológica (1990–1994; 1999–2002) e relator da comissão de revisão do Manual Presbiteriano (2008–2018).
              </p>
            </div>

            <a href="#"
               class="inline-flex items-center mt-6 text-amber-600 hover:text-amber-700 font-medium">
              <span>Mais sobre o(a) autor(a)</span>
              <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
            </a>
          </div>
        </div>
      </article>
    </div>
  </div>
</section>


        <!-- Studies Section -->
    <section id="studies" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Estudos</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Textos, estudos, pregações e expressões criativas</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($studies as $index => $post): ?>
                    <?php
                        $date        = $post['date'];
                        $title       = $post['title'];
                        $description = $post['description'];
                        $image       = $post['image'];
                        $read_time   = isset($post['read_time']) ? (int)$post['read_time'] : 0;
                        $url         = isset($post['url']) ? $post['url'] : '#';

                        // Atraso de animação em passos de 100ms (100, 200, 300…)
                        $aosDelay = ($index + 1) * 100;
                    ?>
                    <article class="bg-white rounded-lg overflow-hidden shadow-md"
                             data-aos="fade-up"
                             data-aos-delay="<?php echo $aosDelay; ?>">
                        <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($title); ?>" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <span><?php echo formatDatePtBr($date); ?></span>
                                <?php if ($read_time > 0): ?>
                                    <span class="mx-2">•</span>
                                    <span><?php echo $read_time; ?> min de leitura</span>
                                <?php endif; ?>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">
                                <?php echo htmlspecialchars($title); ?>
                            </h3>
                            <p class="text-gray-600 mb-4">
                                <?php echo htmlspecialchars($description); ?>
                            </p>
                            <a href="<?php echo htmlspecialchars($url); ?>" class="text-amber-600 hover:text-amber-700 font-medium inline-flex items-center">
                                <span>Ler mais</span>
                                <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-12" data-aos="fade-up">
                <a href="#" class="inline-block border-2 border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-6 py-2 rounded-full font-medium transition">
                    Veja todos os estudos
                </a>
            </div>
        </div>
    </section>


    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Entre em contato</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Eu me sentiria honrado em ouvir palavras de incentivo, críticas, sugestões e recomendações de textos a serem estudados.</p>
            </div>
            
            <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up">
                <div class="md:flex">
                    <div class="md:w-1/2 bg-amber-600 text-white p-8">
                        <h3 class="text-xl font-bold mb-6">Contato</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <i data-feather="mail" class="mr-4 mt-1"></i>
                                <div>
                                    <h4 class="font-medium">Email</h4>
                                    <p>jojo.o.jatinho@mail.com</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i data-feather="instagram" class="mr-4 mt-1"></i>
                                <div>
                                    <h4 class="font-medium">Instagram</h4>
                                    <p>@jonathan.luís.hack</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i data-feather="youtube" class="mr-4 mt-1"></i>
                                <div>
                                    <h4 class="font-medium">Youtube</h4>
                                    <p><a href="https://www.youtube.com/channel/UCjrk1H8o2CdH0YQ9CcgZGvw" target="_blank">youtube.com/JonathanHack</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="md:w-1/2 p-8">
                        <form>
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 mb-2">Nome</label>
                                <input type="text" id="name" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500">
                            </div>
                            <div class="mb-4">
                                <label for="message" class="block text-gray-700 mb-2">Breve mensagem</label>
                                <textarea id="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white py-2 px-4 rounded font-medium transition">
                                Enviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-gray-800 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold mb-4" data-aos="fade-up">Gostaria de receber algum conteúdo meu?</h2>
            <p class="mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Receba textos, comentários, notificações sobre conteúdos novos e mais!
            </p>
            <div class="max-w-md mx-auto flex" data-aos="fade-up" data-aos-delay="200">
                <input type="email" placeholder="Seu endereço de email" class="flex-grow px-4 py-2 rounded-l text-gray-800 focus:outline-none">
                <button class="bg-amber-600 hover:bg-amber-700 px-6 py-2 rounded-r font-medium transition">
                    Inscreva-se
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-white text-lg font-medium mb-4">Jonathan Hack</h3>
                    <p class="mb-4">Discípulo do Senhor Jesus Cristo.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-white transition">
                            <i data-feather="twitter"></i>
                        </a>
                        <a href="#" class="hover:text-white transition">
                            <i data-feather="instagram"></i>
                        </a>
                        <a href="#" class="hover:text-white transition">
                            <i data-feather="facebook"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-white text-lg font-medium mb-4">Links Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Home</a></li>
                        <li><a href="#books" class="hover:text-white transition">Livros</a></li>
                        <li><a href="#about" class="hover:text-white transition">Sobre</a></li>
                        <li><a href="#studies" class="hover:text-white transition">studies</a></li>
                        <li><a href="#contact" class="hover:text-white transition">Contato</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white text-lg font-medium mb-4">Livros</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Livro 1</a></li>
                        <li><a href="#" class="hover:text-white transition">Livro 2</a></li>
                        <li><a href="#" class="hover:text-white transition">Livro 3</a></li>
                        <li><a href="#" class="hover:text-white transition">Veja mais livros!!</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white text-lg font-medium mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Política de privacidade</a></li>
                        <li><a href="#" class="hover:text-white transition">Termos de Serviço</a></li>
                        <li><a href="#" class="hover:text-white transition">Copyright</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p>&copy; 2025 Jonathan Hack. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Initialize animations and icons
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        feather.replace();
        
        // Mobile menu toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            // You would implement mobile menu functionality here
            alert('Mobile menu would open here in a complete implementation');
        });
    </script>
</body>
</html>
