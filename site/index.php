<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Hack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="./styles/main.css">
    <script src="./scripts/main.js" defer></script>
</head>
<body class="font-serif bg-gray-50">
    <!-- Navigation -->
    <?php $basePath = './'; include __DIR__ . '/partials/navbar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-bg min-h-[50vh] flex items-center justify-center text-white">
        <div class="text-center px-4" data-aos="fade-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Instituto Hack</h1>
            <div class="typewriter text-xl md:text-2xl mb-8 mx-auto max-w-2xl">
                Bem-aventurados os que ouvem a palavra de Deus e a guardam.
            </div>
            <a href="./books/" class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-full font-medium transition inline-block">
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
                    <img src="./img/books/para_que_voce_serve_.jpg" alt="Jonathan Hack" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Jonathan Hack</h3>
                        <p class="text-gray-600 mb-4">Livros autorais.</p>
                        <div class="flex justify-between items-center">
                            <a href="./books/#books-jonathan-autorais" class="text-gray-800 hover:text-amber-600 transition flex items-center">
                                <span>Veja mais</span>
                                <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Livros traduzidos Jonathan -->
                <div class="book-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300" data-aos="fade-up" data-aos-delay="200">
                    <img src="./img/books/tolkien_e_a_biblia.jpg" alt="Jonathan Hack" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Jonathan Hack</h3>
                        <p class="text-gray-600 mb-4">Livros traduzidos.</p>
                        <div class="flex justify-between items-center">
                            <a href="./books/#books-jonathan-traduzidos" class="text-gray-800 hover:text-amber-600 transition flex items-center">
                                <span>Veja mais</span>
                                <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Livros autorais Osvaldo -->
                <div class="book-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300" data-aos="fade-up" data-aos-delay="300">
                    <img src="./img/books/vida_longa_e_prospera_dt_1_4.jpg" alt="Osvaldo Hack" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Osvaldo Hack</h3>
                        <p class="text-gray-600 mb-4">Livros autorais.</p>
                        <div class="flex justify-between items-center">
                            <a href="./books/#books-osvaldo-autorais" class="text-gray-800 hover:text-amber-600 transition flex items-center">
                                <span>Veja mais</span>
                                <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
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
                <article class="bg-white rounded-lg overflow-hidden shadow-md" data-aos="fade-up" data-aos-delay="100">
                    <img src="http://static.photos/workspace/640x360/11" alt="Meu processo de escrita: Da ideia à publicação" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Bíblia</h3>
                        <p class="text-gray-600 mb-4">Estudos sobre a natureza de Deus e a fé cristã.</p>
                        <a href="#" class="text-amber-600 hover:text-amber-700 font-medium inline-flex items-center">
                            <span>Ler mais</span>
                            <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                        </a>
                    </div>
                </article>

                <article class="bg-white rounded-lg overflow-hidden shadow-md" data-aos="fade-up" data-aos-delay="200">
                    <img src="http://static.photos/workspace/640x360/12" alt="Exemplo texto studies 2" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Teologia</h3>
                        <p class="text-gray-600 mb-4">Estudos teológicos.</p>
                        <a href="#" class="text-amber-600 hover:text-amber-700 font-medium inline-flex items-center">
                            <span>Ler mais</span>
                            <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                        </a>
                    </div>
                </article>

                <article class="bg-white rounded-lg overflow-hidden shadow-md" data-aos="fade-up" data-aos-delay="300">
                    <img src="./img/family.png" alt="Exemplo texto studies 3" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Família</h3>
                        <p class="text-gray-600 mb-4">Estudos sobre a vida familiar e relacionamentos.</p>
                        <a href="#" class="text-amber-600 hover:text-amber-700 font-medium inline-flex items-center">
                            <span>Ler mais</span>
                            <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                        </a>
                    </div>
                </article>
            </div>

            <div class="text-center mt-12" data-aos="fade-up">
                <a href="./studies/" class="inline-block border-2 border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-6 py-2 rounded-full font-medium transition">
                    Veja todos os estudos
                </a>
            </div>
        </div>
    </section>


    <!-- Abstracts Section (links to resumos page) -->
    <section id="abstracts" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Resumos</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Resumos e extratos organizados por categoria</p>
            </div>

            <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up">
                <div class="p-8 text-center">
                    <p class="text-gray-600 mb-6">Acesse a biblioteca de PDFs (resumos/extratos) por categoria.</p>
                    <a href="./resumos/" class="inline-block bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-full font-medium transition">
                        Ver resumos
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Videos Section (links to videos page) -->
    <section id="videos" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Vídeos</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Últimos vídeos do canal</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8" data-aos="fade-up">
                <article class="bg-white rounded-xl shadow-md overflow-hidden">
                    <img src="http://static.photos/workspace/640x360/61" alt="Writing Thrilling Suspense" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Writing Thrilling Suspense</h3>
                        <p class="text-gray-600">Tips on crafting tension and suspense.</p>
                    </div>
                </article>
                <article class="bg-white rounded-xl shadow-md overflow-hidden">
                    <img src="http://static.photos/workspace/640x360/62" alt="Creating Authentic Characters" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Creating Authentic Characters</h3>
                        <p class="text-gray-600">Character building techniques.</p>
                    </div>
                </article>
                <article class="bg-white rounded-xl shadow-md overflow-hidden">
                    <img src="http://static.photos/workspace/640x360/63" alt="Developing Strong Story Plots" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Developing Strong Story Plots</h3>
                        <p class="text-gray-600">Structuring engaging narratives.</p>
                    </div>
                </article>
            </div>

            <div class="text-center mt-12" data-aos="fade-up">
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="./videos/" class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-full font-medium transition">
                        Ver vídeos
                    </a>
                    <a href="https://www.youtube.com/channel/UCjrk1H8o2CdH0YQ9CcgZGvw" target="_blank" rel="noopener" class="border-2 border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-8 py-3 rounded-full font-medium transition">
                        Ir para o YouTube
                    </a>
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

            <div class="text-center mb-10" data-aos="fade-up">
                <a href="./about/" class="inline-block bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-full font-medium transition">
                    Ver a página Sobre
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-white rounded-xl shadow-md overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <img src="./img/jonathan.jpg" alt="Jonathan Hack" class="w-full h-80 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Jonathan Hack</h3>
                        <p class="text-gray-600">
                            Teólogo, pastor presbiteriano, professor universitário e autor.
                        </p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <img src="./img/osvaldo.jpg" alt="Osvaldo Hack" class="w-full h-80 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Osvaldo Hack</h3>
                        <p class="text-gray-600">
                            Teólogo, pastor presbiteriano e professor universitário.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Contato</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Entre em contato conosco</p>
            </div>

            <div class="bg-gray-50 rounded-xl shadow-md overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Fale conosco</h3>
                        <p class="text-gray-600 mb-6">
                            Entre em contato conosco para perguntas, comentários ou solicitações.
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <i data-feather="mail" class="text-amber-600"></i>
                                <span>contato@institutohack.com</span>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i data-feather="map-pin" class="text-amber-600"></i>
                                <span>São Paulo, Brasil</span>
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

    <!-- Newsletter 
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
    </section>-->

    <!-- Footer -->
    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
