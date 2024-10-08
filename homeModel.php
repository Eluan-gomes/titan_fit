<?php

include './db.php';


// Conexão com o banco de dados e busca de atividades

$resultAtividades = $mysqli->query("SELECT * FROM atividades");

$atividades = $resultAtividades->fetch_all(MYSQLI_ASSOC);


// Exibir profissionais de educação física

$profissionais = [

    ['nome' => 'Carlos Silva', 'funcao' => 'Personal Trainer', 'experiencia' => '5 anos', 'imagem' => './assets/imgs/mariaclaudia.avif'],

    ['nome' => 'Maria Oliveira', 'funcao' => 'Instrutora yoga', 'experiencia' => '3 anos', 'imagem' => './assets/imgs/mariaclaudia.avif'],

    ['nome' => 'Maria Claudia', 'funcao' => 'Personal Trainer', 'experiencia' => '7 anos', 'imagem' => './assets/imgs/mariaclaudia.avif'],

    ['nome' => 'Renata Souza', 'funcao' => 'Personal Trainer', 'experiencia' => '7 anos', 'imagem' => './assets/imgs/mariaclaudia.avif'],

    ['nome' => 'Renata Souza', 'funcao' => 'Personal Trainer', 'experiencia' => '7 anos', 'imagem' => './assets/imgs/mariaclaudia.avif'],
    ['nome' => 'Renata Souza', 'funcao' => 'Personal Trainer', 'experiencia' => '7 anos', 'imagem' => './assets/imgs/mariaclaudia.avif'],

];

?>


<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Painel - Academia</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Acetone&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jhon+O&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sans+Portler&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sportage&display=swap">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="./tailwind.config.js"></script>
    <style>

.bg-red-600 {
    background-color: #992f4d;
}

.bg-white {
    background-color: #f08e73;
}

.bg-black {
    background-color: #400e28;
}
.bg-gray {
    background-color: #e8b787;
}
.text-blue {
  color: #f08e73;
}
.text-white {
    color: #f25872;
}
.text-white-500 {
    color: #e8b787;
}
.text-gray {
    color: #992f4d;
}


.bg-red-500 {
    background-color: #e8b787;
}

#carousel img {
    object-fit: cover;
}

.min-w-[300px] {
    background-color: #e8b787;
}

#carousel img {
    object-fit: cover;
}

#profissionaisCarousel {
    display: flex;
    transition: transform 0.5s ease;
}

#atividadesCarousel {

}
#navbar-menu {
    padding: 2px;
}
#carousel {

}
html {
    scroll-behavior: smooth;
}
#profissionaisCarouselWrapper {
    display: flex;
    justify-content: center;
}

#profissionaisCarousel {
    display: flex;
    justify-content: center;
}
#carousel-image {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    transition: all 0.7s;
    backdrop-filter: blur(10px); /* Desfoque de 10px */
}

    </style>

</head>

<body class="bg-gray-100">


<!-- Top Bar with Contact Info -->

<div class="bg-red-600 p-2 text-white text-center">

    <a href="tel:+18001234567" class="hover:underline">86-99999-999</a> | 

    <a href="mailto:atendimento@titanfit.com.br" class="hover:underline">atendimento@titanfit.com.br</a> | Teresina PI Brasil | 64000-000

</div>


<!-- Main Navigation -->

<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex justify-between h-16">
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <!-- Logo and Menu toggle button -->
                <div class="block sm:hidden">
                    <button id="navbar-toggle" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
                <!-- Navbar Links -->
                <div id="navbar-menu" class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="home.php" class=" text-gray-900 inline-flex items-center px-1 pt-1 text-3xl font-serif hover:border-red-500 hover:shadow-md border-b-2 border-transparent">Titan Fit</a>
                    <a href="usuarios.php" class="border-transparent hover:border-red-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Ger Users</a>
                    <a href="atividades.php" class="border-transparent text-gray-900 hover:border-red-500 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Ger Atividades</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Script to handle the hamburger menu toggle -->
<script>
    document.getElementById('navbar-toggle').addEventListener('click', () => {
        const navbarMenu = document.getElementById('navbar-menu');
        navbarMenu.classList.toggle('hidden');
    });
</script>


<section class="relative">
    <div class="relative h-screen overflow-hidden">
        <!-- <div id="carousel" class="absolute inset-0 bg-cover bg-center transition-all duration-700">
            <img src="./assets/imgs/imagem1.jpg" id="carousel-image" class="w-full h-full object-cover" alt="Hero Background">
        </div> -->
        <!-- <div class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div class="text-center text-white">
                <h1 class="text-6xl font-bold uppercase tracking-wide">No Pain No Gain</h1>
                <p class="text-xl mt-4 mb-8">Having a perfect body requires a lot of training. We can help you with both fitness and power.</p>
                <a href="#conheca" class="bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-full text-lg transition duration-300 ease-in-out">Nos Conheça</a>
            </div>
        </div> -->
        <div id="carousel" class="relative h-screen overflow-hidden">
        <img src="./assets/imgs/1.png" id="carousel-image" class="w-full h-full object-cover" alt="Hero Background">
    </div>
    <div class="absolute inset-0 bg-transparent bg-opacity-50 flex justify-center items-center">
        <div class="text-center text-gray-900 backdrop-blur-md p-8 rounded">
            <h1 class="text-6xl font-bold uppercase tracking-wide">No Pain No Gain</h1>
            <p class="text-xl mt-4 mb-8">Having a perfect body requires a lot of training. We can help you with both fitness and power.</p>
            <a href="#conheca" class="bg-red-500 text-gray font-bold py-3 px-6 rounded-full text-lg transition duration-300 ease-in-out">Nos Conheça</a>
        </div>
    </div>

        <!-- Navigation Buttons -->
        <div class="absolute inset-y-0 left-0 flex items-center">
            <button id="prev" class="bg-white text-gray-800 p-2 rounded-full shadow-lg hover:bg-gray-200">&lt;</button>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center">
            <button id="next" class="bg-white text-gray-800 p-2 rounded-full shadow-lg hover:bg-gray-200">&gt;</button>
        </div>
    </div>
</section>

<!-- Carousel Script for the Hero Section -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const images = [
            './assets/imgs/1.png',
            './assets/imgs/2.png',
            './assets/imgs/3.png',
            './assets/imgs/4.png'
        ];
        let currentIndex = 0;
        const imgElement = document.getElementById('carousel-image');

        document.getElementById('next').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            imgElement.src = images[currentIndex];
        });

        document.getElementById('prev').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            imgElement.src = images[currentIndex];
        });

        // Auto play functionality
        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            imgElement.src = images[currentIndex];
        }, 5000); // Change image every 5 seconds
    });
</script>




<section class="bg-gray py-12" id="conheca">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">Conheça a Titan Fit</h2>
            <p class="mt-4 text-lg text-gray-600">A Titan Fit é uma academia focada em promover saúde e bem-estar, oferecendo um ambiente moderno e acolhedor para alunos de todos os níveis. Com programas personalizados, buscamos ajudar cada pessoa a atingir seus objetivos fitness.
            </p>
        </div>
        <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold text-gray-900">Nossos Valores</h3>
                <p class="mt-4 text-gray-600"><ul class="mt-4 text-gray-600">
        <li>Compromisso com a Saúde: Priorizamos a promoção de saúde e bem-estar.</li>
        <li>Excelência no Atendimento: Atendimento próximo e personalizado.</li>
        <li>Inovação: Utilizamos tecnologia de ponta nos treinos.</li>
        <li>Inclusão e Respeito: Ambiente acolhedor e diverso para todos.
        </li>
    </ul></p>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold text-gray-900">Nossas Instalações</h3>
                <p class="mt-4 text-gray-600">Equipada com: <br>
                Área completa de musculação. <br>
                Espaço de treinamento funcional. <br>
                Estúdio de Yoga e Pilates. <br>
                Sala de cardio com equipamentos modernos. <br>
                Vestiários confortáveis e área de convivência.</p>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold text-gray-900">Nossa Equipe</h3>
                <p class="mt-4 text-gray-600">Profissionais qualificados e apaixonados por fitness. Estamos aqui para ajudar você a alcançar suas metas, oferecendo suporte e orientação personalizada.</p>
            </div>
        </div>
    </div>
</section>


<!-- Content Section -->

<main class="py-6 bg-black">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <!-- Carrossel de Profissionais -->       
        <div class="relative overflow-hidden">
            <h3 class="text-2xl font-semibold mb-4 text-center font-serif text-white-500">Profissionais</h3>
            <div id="profissionaisCarouselWrapper" class="overflow-hidden">
                <div id="profissionaisCarousel" class="flex transition-transform duration-700 p-2 rounded-lg items-center p-2">
                    <?php foreach ($profissionais as $profissional): ?>
                        <div class="flex-shrink-0 sm:w-1/2 md:w-auto lg:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden mx-2 p-2">
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



<script>
    const carousel = document.getElementById('profissionaisCarousel');
    const prevButton = document.getElementById('prevProf');
    const nextButton = document.getElementById('nextProf');

    let currentIndex = 0;

    function updateCarousel() {
        const items = carousel.children;
        const itemWidth = items[0].offsetWidth + parseFloat(getComputedStyle(items[0]).marginRight) * 2;
        const visibleItems = Math.floor(carousel.parentElement.offsetWidth / itemWidth);
        const maxIndex = Math.ceil(items.length / visibleItems) - 1;
        
        nextButton.addEventListener('click', () => {
            if (currentIndex < maxIndex) {
                currentIndex++;
                carousel.style.transform = `translateX(-${currentIndex * itemWidth * visibleItems}px)`;
            }
        });
        
        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                carousel.style.transform = `translateX(-${currentIndex * itemWidth * visibleItems}px)`;
            }
        });
    }

    window.addEventListener('resize', updateCarousel);
    window.addEventListener('load', updateCarousel);
</script>

<main class="py-6 bg-gray">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <!-- Carrossel de Profissionais -->       
        <div class="relative overflow-hidden">
            <h3 class="text-2xl font-semibold mb-4 text-center font-serif text-gray">Atividades</h3>
            <div id="profissionaisCarouselWrapper" class="overflow-hidden flex justify-center">
                <div id="profissionaisCarousel" class="flex transition-transform duration-700 p-2 rounded-lg items-center justify-center">
                    <?php if (!empty($atividades)): ?>
                        <?php foreach ($atividades as $atividade): ?>
                            <div class="min-w-[300px] bg-white rounded-lg shadow-lg p-4 mx-2">
                                <h4 class="text-lg font-semibold"><?= htmlspecialchars($atividade['atividade']) ?></h4>
                                <p class="text-gray-700"><?= htmlspecialchars($atividade['descricao']) ?></p>
                                <p class="text-gray-500 mt-2"><?= htmlspecialchars($atividade['data']) ?></p>
                                <img src="<?= htmlspecialchars($atividade['imagem']) ?>" alt="Imagem da atividade" class="mt-2 rounded-lg">
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="min-w-[300px] bg-white rounded-lg shadow-lg p-4">
                            <p class="text-gray-700">Nenhuma atividade registrada.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="absolute inset-y-0 left-0 flex items-center">
                <button id="prevProf" class="bg-white text-gray-800 p-2 rounded-full shadow-lg hover:bg-gray-200 m-1">&lt;</button>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center">
                <button id="nextProf" class="bg-white text-gray-800 p-2 rounded-full shadow-lg hover:bg-gray-200 m-1">&gt;</button>
            </div>
        </div>
    </div>
</main>

        <!-- Carrossel de Atividades -->


<!-- Carousel Script for the Activities Section -->
<script>
    const atividades = [
        <?php foreach ($atividades as $atividade): ?>
            '<?= $atividade['imagem'] ?>',
        <?php endforeach; ?>
    ];
    let index = 0;
    const atividadesCarousel = document.getElementById('atividadesCarousel');

    document.getElementById('nextAtiv').addEventListener('click', () => {
        index = (index + 1) % atividades.length;
        atividadesCarousel.style.transform = `translateX(-${index * 100}%)`;
    });

    document.getElementById('prevAtiv').addEventListener('click', () => {
        index = (index - 1 + atividades.length) % atividades.length;
        atividadesCarousel.style.transform = `translateX(-${index * 100}%)`;
    });
</script>
    </main>
    <footer class="bg-gray-800 text-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:justify-between">
            <div class="mb-6 md:mb-0">
                <h2 class="text-2xl font-bold mb-4">Titan Fit</h2>
                <p class="text-gray-400">Sua jornada fitness começa aqui! Fique em forma, sinta-se bem.</p>
            </div>
            <div class="mb-6 md:mb-0">
                <h2 class="text-xl font-semibold mb-4">Links Rápidos</h2>
                <ul>
                    <li><a href="./home.php" class="text-gray-400 hover:text-white transition duration-300">Home</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Serviços</a></li>
                    <li><a href="#about" class="text-gray-400 hover:text-white transition duration-300">Sobre</a></li>
                    <li><a href="#contact" class="text-gray-400 hover:text-white transition duration-300">Contato</a></li>
                </ul>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-4">Siga-nos</h2>
                <ul class="flex space-x-4">
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Facebook</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Twitter</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-700 pt-4">
            <p class="text-center text-gray-400">&copy; 2024 Titan Fit. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>

</body>
</html>