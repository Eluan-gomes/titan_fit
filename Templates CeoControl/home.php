<?php
// No início de páginas protegidas:
session_start();

// Verifique se o usuário está autenticado.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se não estiver autenticado, redirecione para a página de login.
    //header('Location: login.php');
    //exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen">

    <nav class="bg-gradient-to-r from-gray-200 to-white flex justify-end items-end py-4 px-8">
        <ul>
            <li class="text-xl font-bold pr-4"><a href="home.php" class="text-black">Home</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="cadastrofun.php" class="text-black">Cadastro Funcionário</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="listafun.php" class="text-black">Lista de Funcionários</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="cadastroepi.php" class="text-black">Cadastro EPI's</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="listaepi.php" class="text-black">Lista EPI's</a></li>
        </ul>
    </nav>

    <div class="bg-blue-600 text-white py-16">
        <div class="container mx-auto flex items-center justify-center">
            <div class="flex space-x-4">
                <img src="img/img1home.jpg" alt="Logo" class="w-25 h-25 object-contain">
                <div>
                    <h1 class="text-3xl font-bold pt-16">Bem-vindo ao CeoControl System</h1>
                    <p class="text-lg">&emsp;Sua solução de gerenciamento de funcionários <br>
                e EPI's, para melhor armazenamento de informações, <br>
                e controle de equipamentos.</p>
                    <p class="text-lg">&emsp;Destinado ao Publico que pretenda <br>
                um sistema simples e prático, e de baixo custo</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white text-black py-16 flex-grow">
        <div class="container mx-auto flex items-center justify-center">
            <div class="flex space-x-4 mr-4">
                <div>
                    <h1 class="text-3xl font-bold">Quem é a CeoControl Technology?</h1>
                    <p class="text-lg">&emsp;Somos a CeoControl, surgimos da proposta de resolução, <br>
                    de um problema que vive em algumas empresas que é o controle, <br>
                   z de EPI's que vai armazena-los no sistema, e mante-lo atualizado, <br>
                    para que seja usado de forma correta, para que seja usado <br>
                    de acordo com seu intuito, mas tendo como adicional, <br>
                    o cadastro de funcionarios, com o mesmo intuito de manter <br>
                    este controle constantemente.</p>
                </div>
            </div>
            <img src="img/img2home.jpg" alt="Recursos" class="w-25 h-25 object-contain">
        </div>
    </div>

    <footer class="bg-gradient-to-r from-gray-200 to-white py-8">
        <div class="container mx-auto flex items-center justify-start">
            <p class="text-gray-800 text-[15px] px-2">© Desenvolvido exclusivamente por Eluan .G, Todos os direitos reservados!</p>
            <p class="text-gray-800 text-[15px] pr-2">© Integrantes: Eluan - Tarsis - Felipe - Adécio - Lucas</p>
            <img src="img/logocadastrofun.png" alt="logo" class="w-16 h-16 object-contain rounded-xl">
        </div>
    </footer>
    <style>
        img {
            width: 300px;
            height: 300px;
        }
    </style>
</body>
</html>
