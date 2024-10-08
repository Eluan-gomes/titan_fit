<main class="py-6 bg-black">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Carrossel de Profissionais -->       
        <div class="relative overflow-hidden">
            <h3 class="text-2xl font-semibold mb-4 text-center font-serif text-white-500">Profissionais</h3>
            <div id="profissionaisCarouselWrapper" class="overflow-hidden">
                <div id="profissionaisCarousel" class="flex transition-transform duration-700 p-2 rounded-lg items-center p-2">
                    <?php foreach ($profissionais as $profissional): ?>
                        <div class="flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden mx-2 p-2">
                            <img src="<?= $profissional['imagem'] ?>" alt="<?= $profissional['nome'] ?>" class="w-full h-48 rounded-lg object-cover">
                            <div class="p-4">
                                <h5 class="font-bold text-lg"><?= $profissional['nome'] ?></h5>
                                <p class="text-gray-600">Função: <?= $profissional['funcao'] ?></p>
                                <p class="text-gray-500">Experiência: <?= $profissional['experiencia'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="absolute inset-y-0 left-0 flex items-center">
                <button id="prevProf" class="bg-gray text-gray-800 p-2 rounded-full shadow-lg hover:bg-gray-200 m-1">&lt;</button>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center">
                <button id="nextProf" class="bg-gray text-gray-800 p-2 rounded-full shadow-lg hover:bg-gray-200 m-1">&gt;</button>
            </div>
        </div>
    </div>
</main>