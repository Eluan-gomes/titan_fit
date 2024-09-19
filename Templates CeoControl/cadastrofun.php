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
            <li class="text-xl font-bold pr-4"><a href="home.php" class="text-black">Home</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="cadastrofun.php" cx lass="text-black">Cadastro Funcionário</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="listafun.php" class="text-black">Lista Funcionários</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="cadastroepi.php" class="text-black">Cadastro EPI's</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="listaepi.php" class="text-black">Lista EPI's</a></li>
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
        $nome = $_POST["nome"];
        $idade = $_POST['idade'];
        $cargo = $_POST['cargo'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $salario = $_POST['salario'];
        $descricao = $_POST['descricao'];

        $sql = "INSERT INTO cadastrofun (nome, idade, cargo, cpf, email, telefone, salario, descricao) VALUES('$nome', '$idade', '$cargo','$cpf', '$email', '$telefone', '$salario', '$descricao')";

        if ($mysqli->query($sql) === TRUE) {
            $showPopup = true;
        } else {
            echo "Erro ao cadastrar funcionário: " . $mysqli->error;
        }
    }

    // Exibir o formulário de cadastro
        ?>

        <form class="space-y-4 border rounded-xl m-2 p-2 bg-gradient-to-r from-gray-200 to-white" method="post">
            <div>
                <label class="text-lg text-gray-800">Nome:</label>
                <input class="input" type="text" name="nome" required>
            </div>
            <div>
                <label class="text-lg text-gray-800">Idade:</label>
                <input class="input" type="text" name="idade" required>
            </div>
            <div>
                <label class="text-lg text-gray-800">Cargo:</label>
                <input class="input" type="text" name="cargo" required>
            </div>
            <div>
                <label class="text-lg text-gray-800">Cpf:</label>
                <input class="input" type="text" name="cpf" required>
            </div>
            <div>
                <label class="text-lg text-gray-800">E-mail:</label>
                <input class="input" type="text" name="email" required>
            </div>
            <div>
                <label class="text-lg text-gray-800">Telefone:</label>
                <input class="input" type="text" name="telefone" required>
            </div>
            <div>
                <label class="text-lg text-gray-800">Salário:</label>
                <input class="input" type="text" name="salario" required>
            </div>
            <div>
                <label class="text-lg text-gray-800">Descrição:</label>
                <input class="input" type="text" name="descricao" required>
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
