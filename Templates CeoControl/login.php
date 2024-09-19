<?php
include('conexao.php');

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
<body class="flex justify-center items-center h-screen bg-blue-500">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-900 text-center mb-4">Login</h1>
        <form action="" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-gray-900">E-mail</label>
                <input type="text" name="email" id="email" class="w-full px-4 py-2 rounded border" placeholder="Seu e-mail">
            </div>
            <div class="mb-4">
                <label for "senha" class="block text-gray-900">Senha</label>
                <input type="password" name="senha" id="senha" class="w-full px-4 py-2 rounded border" placeholder="Sua senha">
            </div>
            <div class="text-center">
                <button type="submit" class="bg-gray-500 text-white rounded-full px-4 py-2 font-bold">Entrar</button>
            </div>
        </form>
    </div>
</body>
</html>
