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
<body class="bg-blue-600">
    <nav class="bg-gradient-to-r from-gray-200 to-white flex justify-end items-center py-4 px-8">
        <ul>
            <li class="text-xl font-bold pr-4"><a href="home.php" class="text-black hover:animate-none">Home</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="cadastrofun.php" class="text-black hover:animate-none">Cadastro Funcionário</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="listafun.php" class="text-black hover:animate-none">Lista de Funcionários</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="cadastroepi.php" class="text-black hover:animate-none">Cadastro EPI's</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="listaepi.php" class="text-black hover:animate-none">Lista EPI's</a></li>
        </ul>
    </nav>

    <div class="w-full max-w-md mx-auto p-6 bg-white rounded-lg mt-10">
        <div class="flex items-center space-x-4">
            <h1 class="text-4xl font-bold text-center">Cadastro de Funcionários</h1><br><br>
        </div><br>

        <?php
            // Conexão com o banco de dados
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "ceocontrolsystem";

    $mysqli = new mysqli($hostname, $username, $password, $database);

    if ($mysqli->connect_error) {
        die("Conexão com o banco de dados falhou: " . $mysqli->connect_error);
    }

    // Inicializa uma variável para controlar a exibição do popup
    $showPopup = false;

    // Processamento do formulário
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $epi = $_POST["epi"];
        $descricao = $_POST['descricao'];
        $datacadastro = $_POST['datacadastro'];

        $sql = "INSERT INTO cadastroepi (epi, descricao, datacadastro) VALUES('$epi', '$descricao', '$datacadastro')";

        if ($mysqli->query($sql) === TRUE) {
            $showPopup = true;
        } else {
            echo "Erro ao cadastrar equipamento: " . $mysqli->error;
        }
    }

    // Exibir o formulário de cadastro
        ?>

        <form class="space-y-4 border rounded-xl m-2 p-2 bg-gradient-to-r from-gray-200 to-white" method="post">
            <div>
                <label class="text-lg text-gray-800">EPI:</label>
                <input class="input" type="text" name="epi" required>
            </div>
            <div>
                <label class="text-lg text-gray-800">Descrição:</label>
                <input class="input" type="text" name="descricao" required>
            </div>
            <div>
                <label class="text-lg text-gray-800">Data de Cadastro:</label>
                <input class="input" type="date" name="datacadastro" required>
            </div>
            <div class="text-center">
                <button class="bg-blue-500 text-white font-bold py-2 px-6 rounded-full" type="submit" value="Cadastrar">Cadastrar</button>
            </div>
            </form>
            <!-- Outros campos do formulário -->
    </div>

    <?php
    $mysqli->close();
    ?>

</body>
</html>
