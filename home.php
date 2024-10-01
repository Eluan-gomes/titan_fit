<?php
include 'db.php';
// session_start();  // Inicia a sessão

// // Verifica se o usuário está logado
// if (!isset($_SESSION['id'])) {
//     header("Location: login.php");
//     exit;
// }

// Conexão com o banco de dados e busca de atividades
$resultAtividades = $mysqli->query("SELECT * FROM atividades");
$atividades = $resultAtividades->fetch_all(MYSQLI_ASSOC);

// Exibir profissionais de educação física
$profissionais = [
    ['nome' => 'Carlos Silva', 'funcao' => 'Personal Trainer', 'experiencia' => '5 anos', 'imagem' => './assets/imgs/carlos.jpeg'],
    ['nome' => 'Maria Oliveira', 'funcao' => 'Instrutora de Yoga', 'experiencia' => '3 anos', 'imagem' => './assets/imgs/maria.jpg'],
    ['nome' => 'Maria Claudia', 'funcao' => 'Personal Trainer', 'experiencia' => '7 anos', 'imagem' => './assets/imgs/mariaclaudia.avif'],
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Academia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="min-h-full">
  <nav class="bg-red-600">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-auto w-15" src="./assets/imgs/TITANFIT.png" alt="Your Company">
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <a href="usuarios.php" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">Ger Users</a>
              <a href="atividades.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Ger Atividades</a>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">View notifications</span>
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
              </svg>
            </button>
            <div class="relative ml-3">
              <div>
                <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="absolute -inset-1.5"></span>
                  <span class="sr-only">Open user menu</span>
                  <img class="h-8 w-8 rounded-full" src="./assets/imgs/carlos.jpeg" alt="">
                </button>
              </div>
              <!-- <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
              </div> -->
            </div>
          </div>
        </div>
  </nav>

  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    </div>
  </header>

  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      <!-- Carrossel de Imagens -->
              <div class="relative">
        <div class="flex justify-center items-center h-screen">
    <div class="relative w-full max-w-full h-full max-h-full p-10">
        <!-- Grid de Imagens -->
        <div class="overflow-hidden rounded-lg shadow-md">
            <img src="./assets/imgs/imagem1.jpg" class="w-full h-full object-cover" alt="Imagem 1" id="carrossel-imagem">
        </div>

        <!-- Ícones de Navegação -->
        <div class="absolute inset-y-0 left-0 flex items-center">
            <button id="prev" class="bg-white rounded-full p-2 shadow-lg hover:bg-gray-200">
                &lt; <!-- Ícone de seta para esquerda -->
            </button>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center">
            <button id="next" class="bg-white rounded-full p-2 shadow-lg hover:bg-gray-200">
                &gt; <!-- Ícone de seta para direita -->
            </button>
        </div>
    </div>
</div>

<!-- Script para mudar as imagens -->
<script>
    const imagens = [
        './assets/imgs/imagem1.jpg',
        './assets/imgs/imagem2.jpg',
        './assets/imgs/imagem3.jpg'
    ];
    let index = 0;

    const imgElement = document.getElementById('carrossel-imagem');

    document.getElementById('next').addEventListener('click', () => {
        index = (index + 1) % imagens.length;
        imgElement.src = imagens[index];
    });

    document.getElementById('prev').addEventListener('click', () => {
        index = (index - 1 + imagens.length) % imagens.length;
        imgElement.src = imagens[index];
    });
</script>

      <!-- Lista de Profissionais de Educação Física -->
      <h3 class="text-xl font-semibold mt-8 mb-4">Profissionais</h3>
<div class="grid grid-cols-1 gap-4 md:grid-cols-3">
    <?php foreach ($profissionais as $profissional): ?>
        <div class="bg-white rounded-lg shadow-md p-4 transition-transform transform hover:scale-105">
            <img src="<?= $profissional['imagem'] ?>" class="w-full h-auto rounded-lg mb-2" alt="<?= $profissional['nome'] ?>">
            <h5 class="font-bold text-lg mb-1"><?= $profissional['nome'] ?></h5>
            <p class="text-gray-700">Função: <span class="font-medium"><?= $profissional['funcao'] ?></span></p>
            <p class="text-gray-600">Experiência: <span class="font-medium"><?= $profissional['experiencia'] ?></span></p>
        </div>
    <?php endforeach; ?>
</div>
<h3 class="text-xl font-semibold mt-8 mb-2">Atividades Registradas</h3>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php if (!empty($atividades)): ?>
        <?php foreach ($atividades as $atividade): ?>
            <div class="bg-white border border-gray-300 rounded-lg p-4 shadow-md">
                <h4 class="text-lg font-semibold"><?= htmlspecialchars($atividade['atividade']) ?></h4>
                <p class="text-gray-700"><?= htmlspecialchars($atividade['descricao']) ?></p>
                <p class="text-gray-500 mt-2"><?= htmlspecialchars($atividade['data']) ?></p>
                <img src="<?= htmlspecialchars($atividade['imagem']) ?>" alt="Imagem da atividade" class="mt-2 rounded-lg">
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="bg-white border border-gray-300 rounded-lg p-4 shadow-md">
            <p class="text-gray-700">Nenhuma atividade registrada.</p>
        </div>
    <?php endif; ?>
</div>


        <!-- Adicione mais funcionários conforme necessário -->
      </div>
    </div>
  </main>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
