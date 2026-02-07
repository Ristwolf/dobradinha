<?php
$basePath = $basePath ?? './';
?>
<footer class="bg-gray-900 text-gray-400 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-white text-lg font-medium mb-4">Jonathan Hack</h3>
                <p class="mb-4">Discípulo do Senhor Jesus Cristo.</p>
                <div class="flex space-x-4">
                    <a href="https://www.youtube.com/channel/UCjrk1H8o2CdH0YQ9CcgZGvw" target="_blank" rel="noopener" class="hover:text-white transition"><i data-feather="youtube"></i></a>
                    <a href="https://www.instagram.com/jonathan.luis.hack/" class="hover:text-white transition"><i data-feather="instagram"></i></a>
                </div>
            </div>
            <div>
                <h3 class="text-white text-lg font-medium mb-4">Links Rápidos</h3>
                <ul class="space-y-2">
                    <li><a href="<?php echo $basePath; ?>" class="hover:text-white transition">Home</a></li>
                    <li><a href="<?php echo $basePath; ?>books/" class="hover:text-white transition">Livros</a></li>
                    <li><a href="<?php echo $basePath; ?>about/" class="hover:text-white transition">Sobre</a></li>
                    <li><a href="<?php echo $basePath; ?>studies/" class="hover:text-white transition">Estudos</a></li>
                    <li><a href="<?php echo $basePath; ?>#contact" class="hover:text-white transition">Contato</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white text-lg font-medium mb-4">Livros</h3>
                <ul class="space-y-2">
                    <li><a href="<?php echo $basePath; ?>books/#books-jonathan-autorais" class="hover:text-white transition">Autorais Jonathan</a></li>
                    <li><a href="<?php echo $basePath; ?>books/#books-jonathan-traduzidos" class="hover:text-white transition">Traduzidos Jonathan</a></li>
                    <li><a href="<?php echo $basePath; ?>books/#books-osvaldo-autorais" class="hover:text-white transition">Autorais Osvaldo</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white text-lg font-medium mb-4">Legal</h3>
                <ul class="space-y-2">
                    <li><a href="<?php echo $basePath; ?>privacy/" class="hover:text-white transition">Política de privacidade</a></li>
                    <li><a href="#" class="hover:text-white transition">Termos de Serviço</a></li>
                    <li><a href="#" class="hover:text-white transition">Copyright</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-12 pt-8 text-center">
            <p>&copy; <span id="y"></span> Jonathan Hack. All rights reserved.</p>
        </div>
    </div>
</footer>
