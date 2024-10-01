<?php
include('db.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {
    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu email";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código de busca").$mysqli->error;

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['user'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: home.php");
        } else {
            echo "Falha ao logar! email ou senha inválidos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex justify-center items-center h-screen bg-red-700">
    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-sm">
    <img class="block mx-auto" src="./assets/imgs/TITANFIT.png" alt="titan">
        <form action="" method="POST">
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                <input type="text" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Seu e-mail">
            </div>
            <div class="mb-5">
                <label for="senha" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                <input type="password" name="senha" id="senha" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Sua senha">
            </div>
            <div class="text-center">
                <button type="submit" class="bg-red-700 text-white rounded-full px-10 py-2 font-bold hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-blue-400">Entrar</button>
            </div>
        </form>
    </div>
</body>
</html>
