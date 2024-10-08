<?php
include('db.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {
    // Validação dos campos de email e senha
    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu email";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        // Escapando os dados para evitar SQL Injection
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']); // Agora a senha é tratada diretamente

        // Busca o usuário pelo email e senha diretamente (texto puro)
        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código de busca: " . $mysqli->error);

        // Verifica se o usuário existe
        if ($sql_query->num_rows == 1) {
            // Usuário encontrado
            $usuario = $sql_query->fetch_assoc();

            // Inicia a sessão e armazena as informações do usuário
            session_start();
            $_SESSION['usuario'] = $usuario['id_user'];
            $_SESSION['usuario'] = $usuario['usuario'];
            $_SESSION['role_id'] = $usuario['role_id'];

            // Redireciona com base no papel do usuário
            if ($_SESSION['role_id'] == 1) {
                // header('Location: ./admin/dashboard.php');
                header('Location: ./admin/homeAdmin.php');
                echo("teste admin");
            } elseif ($_SESSION['role_id'] == 2) {
                header('Location: ./client/homeClient.php');
                echo("teste admin");
            }
        } else {
            echo "Email ou senha inválidos!";
        }
    }
}

// if(isset($_POST['email']) || isset($_POST['senha'])) {
//     if(strlen($_POST['email']) == 0) {
//         echo "Preencha seu email";
//     } else if(strlen($_POST['senha']) == 0) {
//         echo "Preencha sua senha";
//     } else {
//         $email = $mysqli->real_escape_string($_POST['email']);
//         $senha = $mysqli->real_escape_string($_POST['senha']);

//         $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
//         $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código de busca").$mysqli->error;

//         $quantidade = $sql_query->num_rows;

//         if($quantidade == 1) {
//             $usuario = $sql_query->fetch_assoc();

//             if(!isset($_SESSION)) {
//                 session_start();
//             }

//             $_SESSION['user'] = $usuario['id'];
//             $_SESSION['nome'] = $usuario['nome'];

//             header("Location: home.php");
//         } else {
//             echo "Falha ao logar! email ou senha inválidos";
//         }
//     }
// }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
<body class="flex justify-center items-center h-screen bg-white">
    <div class="bg-gray p-8 rounded-lg shadow-xl w-full max-w-sm">
        <img class="block mx-auto mb-4" src="./assets/imgs/TITANFIT.png" alt="Titan Fit">
        <form action="" method="POST">
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                <input type="text" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Seu e-mail">
            </div>
            <div class="mb-5">
                <label for="senha" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                <input type="password" name="senha" id="senha" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Sua senha">
            </div>
            <div class="text-center">
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white rounded-full px-10 py-2 font-bold focus:outline-none focus:ring-2 focus:ring-red-500">Entrar</button>
            </div>
            <br>
            <div class="text-center">
                <a href="./contato.php" class="text-gray-700 p-2 font-medium text-sm">Caso não tenha cadastro! Entre em contato conosco, e realize seu cadastro</a>
            </div>
        </form>
    </div>
</body>
</html>
