<?php
// videos.php — Lista vídeos automaticamente via RSS do YouTube (sem API key)

// ===== Configurações =====
$siteTitle   = 'Dobradinha Hack';
$pageTitle   = 'Vídeos';
$channelName = 'Jonathan Hack';
$channelId   = 'UCjrk1H8o2CdH0YQ9CcgZGvw'; // ID do canal (UC...)
$maxVideos   = 9;        // Quantos vídeos exibir
$cacheTtl    = 3600;     // Cache em segundos (1h)

// ===== RSS + Cache (sem API key) =====
function ytFetchUploadsRss(string $channelId, int $limit = 9, int $cacheTtl = 3600): array {
    $feedUrl = "https://www.youtube.com/feeds/videos.xml?channel_id=" . urlencode($channelId);

    // Diretório de cache ao lado deste arquivo (./cache)
    $cacheDir  = __DIR__ . '/cache';
    if (!is_dir($cacheDir)) { @mkdir($cacheDir, 0777, true); }
    $cacheFile = $cacheDir . '/yt_' . preg_replace('/[^A-Za-z0-9_\-]/','_', $channelId) . '.xml';

    $xmlStr = null;

    // Usa cache válido se existir
    if (is_file($cacheFile) && (time() - filemtime($cacheFile) < $cacheTtl)) {
        $xmlStr = @file_get_contents($cacheFile);
    } else {
        // Baixa o RSS com timeout simples
        $ctx = stream_context_create(['http' => ['timeout' => 6, 'header' => "User-Agent: PHP\r\n"]]);
        $xmlStr = @file_get_contents($feedUrl, false, $ctx);
        if ($xmlStr) { @file_put_contents($cacheFile, $xmlStr); }
        // Fallback ao cache antigo se a rede falhar
        if (!$xmlStr && is_file($cacheFile)) {
            $xmlStr = @file_get_contents($cacheFile);
        }
    }

    if (!$xmlStr) return [];

    $xml = @simplexml_load_string($xmlStr);
    if (!$xml) return [];

    $ns = $xml->getNamespaces(true);
    $items = [];

    foreach ($xml->entry as $entry) {
        $yt = $entry->children($ns['yt'] ?? null);
        $videoId = (string)($yt->videoId ?? '');
        $title   = (string)$entry->title;

        if ($videoId === '') continue;

        $items[] = [
            'id'        => $videoId,
            'title'     => $title,
            'published' => (string)$entry->published,
            'thumb'     => "https://i.ytimg.com/vi/{$videoId}/hqdefault.jpg",
            'url'       => "https://www.youtube.com/watch?v={$videoId}",
        ];

        if (count($items) >= $limit) break;
    }

    return $items;
}

// Busca dinâmica
$videos = ytFetchUploadsRss($channelId, $maxVideos, $cacheTtl);

/** Helper simples para escapar HTML. */
function h($str) { return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8'); }
?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($siteTitle . ' | ' . $pageTitle); ?></title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .hero-bg {
            background: linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url('http://static.photos/workspace/1200x630/42');
            background-size: cover;
            background-position: center;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 22px -8px rgba(0,0,0,.12), 0 8px 10px -6px rgba(0,0,0,.06);
        }
        /* Aspect ratio 16:9 sem plugin */
        .video-wrap { position: relative; width: 100%; padding-top: 56.25%; background: #000; }
        .video-wrap iframe, .video-wrap img { position: absolute; inset: 0; width: 100%; height: 100%; border: 0; object-fit: cover; }
        .play-overlay { position:absolute; inset:0; display:flex; align-items:center; justify-content:center; background:rgba(0,0,0,.35); opacity:0; transition:.2s; }
        .video-wrap:hover .play-overlay { opacity:1; }
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
                    <a href="/curso-php/site/index.php" class="text-gray-800 hover:text-amber-600 transition">Home</a>
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

    <!-- Hero -->
    <header class="hero-bg min-h-[40vh] flex items-center justify-center text-white">
        <div class="text-center px-4" data-aos="fade-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-4"><?php echo h($pageTitle); ?></h1>
            <p class="text-lg md:text-xl opacity-90">Seleção de vídeos do canal: <?php echo h($channelName); ?></p>
        </div>
    </header>

    <!-- Videos Grid -->
    <main id="videos" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Últimos vídeos</h2>
                <p class="text-gray-600 mt-2">Clique para assistir diretamente na página</p>
            </div>

            <?php if (empty($videos)): ?>
                <div class="max-w-3xl mx-auto text-center text-gray-600">
                    <p>Não foi possível carregar o feed agora. Tente novamente em alguns minutos.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($videos as $i => $v): ?>
                        <?php
                            $vid     = (string)($v['id'] ?? '');
                            $title   = (string)($v['title'] ?? 'Vídeo');
                            $thumb   = (string)($v['thumb'] ?? '');
                            $aosDelay = ($i + 1) * 100;
                        ?>
                        <article class="bg-white rounded-lg overflow-hidden shadow-md card"
                                 data-aos="fade-up"
                                 data-aos-delay="<?php echo (int)$aosDelay; ?>">
                            <!-- Carrega thumb e só cria o iframe ao clicar (melhor desempenho) -->
                            <div class="video-wrap group">
                                <img src="<?php echo h($thumb); ?>" alt="<?php echo h($title); ?>">
                                <button class="play-overlay" aria-label="Reproduzir vídeo"
                                  onclick="this.parentElement.innerHTML = '<iframe src=&quot;https://www.youtube.com/embed/<?php echo h($vid); ?>&autoplay=1&quot; title=&quot;<?php echo h($title); ?>&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; allowfullscreen></iframe>'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </button>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800"><?php echo h($title); ?></h3>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i data-feather="youtube" class="w-4 h-4 mr-2"></i>
                                    <span>youtube.com</span>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="text-center mt-12" data-aos="fade-up">
                <a href="https://www.youtube.com/@jonathanhack2993/videos" target="_blank" rel="noopener"
                   class="inline-block border-2 border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-6 py-2 rounded-full font-medium transition">
                    Ver mais no YouTube
                </a>
            </div>
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

        // Mobile menu (placeholder)
        document.querySelector('.mobile-menu-button')?.addEventListener('click', function () {
            alert('Menu mobile (placeholder).');
        });
    </script>
</body>
</html>
