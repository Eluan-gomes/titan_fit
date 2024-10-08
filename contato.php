<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'inserir') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Conecte-se ao banco de dados
   
    // Prepare a consulta
    $stmt = $mysqli->prepare("INSERT INTO contatos (nome, email, mensagem) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $mensagem);

    // Execute a consulta
    if ($stmt->execute()) {
        echo "Contato adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar contato: " . $stmt->error;
    }

    // Feche a declaração e a conexão
    $stmt->close();
    $mysqli->close();

    // Redirecione para a página de contatos
    header("Location: contato.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - Minha Academia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100">
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
                <div class="absolute inset-y-0 right-0 flex items-center">
                    <a href="logout.php" class="border-transparent text-gray-900 hover:border-red-500 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Sair</a>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="bg-light shadow-md rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-4 text-primary">Entre em Contato</h3>
    <form method="POST" action="contato.php">
        <input type="hidden" name="acao" value="inserir">
        <div class="mb-4">
            <label for="nome" class="block text-secondary font-medium mb-2">Nome</label>
            <input type="text" name="nome" id="nome" class="w-full border border-muted p-2 rounded focus:outline-none focus:border-accent text-primary" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-secondary font-medium mb-2">Email</label>
            <input type="email" name="email" id="email" class="w-full border border-muted p-2 rounded focus:outline-none focus:border-accent text-primary" required>
        </div>
        <div class="mb-4">
            <label for="mensagem" class="block text-secondary font-medium mb-2">Mensagem</label>
            <textarea name="mensagem" id="mensagem" rows="4" class="w-full border border-muted p-2 rounded focus:outline-none focus:border-accent text-primary" required></textarea>
        </div>
        <button type="submit" class="bg-accent text-white px-4 py-2 rounded hover:bg-secondary">Enviar</button>
    </form>
</div>

</body>
</html>
