<?php
$basePath = $basePath ?? './';
?>
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="<?php echo $basePath; ?>" class="text-xl font-bold text-gray-800">Instituto Hack</a>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="<?php echo $basePath; ?>" class="text-gray-800 hover:text-amber-600 transition">Home</a>
                <a href="<?php echo $basePath; ?>studies/" class="text-gray-800 hover:text-amber-600 transition">Estudos</a>
                <a href="<?php echo $basePath; ?>resumos/" class="text-gray-800 hover:text-amber-600 transition">Resumos</a>
                <a href="<?php echo $basePath; ?>books/" class="text-gray-800 hover:text-amber-600 transition">Livros</a>
                <a href="<?php echo $basePath; ?>videos/" class="text-gray-800 hover:text-amber-600 transition">Vídeos</a>
                <a href="<?php echo $basePath; ?>about/" class="text-gray-800 hover:text-amber-600 transition">Sobre</a>
                <a href="<?php echo $basePath; ?>#contact" class="text-gray-800 hover:text-amber-600 transition">Contato</a>
            </div>
            <div class="md:hidden flex items-center">
                <button class="mobile-menu-button" type="button" aria-label="Abrir menu">
                    <i data-feather="menu"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
