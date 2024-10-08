<?php
include 'db.php';

// Inserir novo usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'inserir') {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $role_id = $_POST['role_id'];
    // Prepare a consulta
    $stmt = $mysqli->prepare("INSERT INTO usuarios (usuario, email, senha, role_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $usuario, $email, $senha, $role_id);

    // Execute a consulta
    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    // Feche a declaração e a conexão
    $stmt->close();
    $mysqli->close();

    // Redirecione para a página de usuários
    header("Location: usuarios.php");
    exit();
}


// Editar usuário
if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];

    $stmt = $mysqli->prepare("UPDATE usuarios SET usuario = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $usuario, $email, $id);
    $stmt->execute();
    header("Location: usuarios.php");
}

// Excluir usuário
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Conecte-se ao banco de dado

    // Prepare a consulta
    $stmt = $mysqli->prepare("DELETE FROM usuarios WHERE id_user = ?");
    $stmt->bind_param("i", $id);

    // Execute a consulta
    if ($stmt->execute()) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro ao excluir usuário: " . $stmt->error;
    }

    // Feche a declaração e a conexão
    $stmt->close();
    $mysqli->close();

    // Redirecione para a página de usuários
    header("Location: usuarios.php");
    exit();
}

// Listar usuários
$result = $mysqli->query("SELECT * FROM usuarios");
$usuarios = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Usuários - Academia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Acetone&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jhon+O&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sans+Portler&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sportage&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-primary {
            background-color: #400e28;
        }

        .bg-secondary {
            background-color: #992f4d;
        }

        .bg-accent {
            background-color: #f25872;
        }

        .bg-light {
            background-color: #f08e73;
        }

        .bg-muted {
            background-color: #e8b787;
        }

        .text-primary {
            color: #400e28;
        }

        .text-secondary {
            color: #992f4d;
        }

        .text-accent {
            color: #f25872;
        }

        .text-light {
            color: #f08e73;
        }

        .text-muted {
            color: #e8b787;
        }
    </style>
</head>
<body class="bg-primary text-light">

    <!-- Navbar -->
    <nav class="shadow bg-light">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex justify-between h-16">
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="block sm:hidden">
                        <button id="navbar-toggle" class="text-muted hover:text-secondary focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>
                    </div>
                    <div id="navbar-menu" class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="./admin/homeAdmin.php" class="text-primary inline-flex items-center px-1 pt-1 text-3xl font-serif hover:border-red-500 hover:shadow-md border-b-2 border-transparent">Titan Fit</a>
                        <a href="./usuarios.php" class="border-transparent hover:border-accent text-primary inline-flex items-center px-1 pt-1 hover:border-red-500 hover:shadow-md border-b-2 border-transparent text-sm font-medium">Ger Users</a>
                        <a href="./atividades.php" class="border-transparent text-primary hover:border-accent inline-flex items-center px-1 pt-1 hover:border-red-500 hover:shadow-md border-b-2 border-transparent text-sm font-medium">Ger Atividades</a>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center">
                        <div class="mr-5">
                <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="absolute -inset-1.5"></span>
                  <span class="sr-only">Open user menu</span>
                  <img class="h-8 w-8 rounded-full" src="./assets/imgs/carlos.jpeg" alt="">
                    </button>
                    </div>
                        <a href="../logout.php" class="border-transparent text-primary hover:border-accent inline-flex items-center px-1 pt-1 hover:border-red-500 hover:shadow-md border-b-2 border-transparent text-sm font-medium">Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 text-center font-serif">Controle de Usuários</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Formulário para Inserir Usuário -->
            <div class="bg-light shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-primary">Inserir Novo Usuário</h3>
                <form method="POST" action="usuarios.php">
                    <input type="hidden" name="acao" value="inserir">
                    <div class="mb-4">
                        <label for="usuario" class="block text-secondary font-medium mb-2">Usuário</label>
                        <input type="text" name="usuario" class="w-full border border-muted p-2 rounded focus:outline-none focus:border-accent text-primary" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-secondary font-medium mb-2">Email</label>
                        <input type="email" name="email" class="w-full border border-muted p-2 rounded focus:outline-none focus:border-accent text-primary" required>
                    </div>
                    <div class="mb-4">
                        <label for="senha" class="block text-secondary font-medium mb-2">Senha</label>
                        <input type="password" name="senha" class="w-full border border-muted p-2 rounded focus:outline-none focus:border-accent text-primary" required>
                    </div>
                    <div class="mb-4">
            <label for="role_id" class="block text-secondary font-medium mb-2">Tipo de Usuário</label>
            <select name="role_id" class="w-full border border-muted p-2 rounded focus:outline-none focus:border-accent text-primary" required>
                <option value="">Selecione o tipo de usuário</option>
                <option value="1">Administrador</option>
                <option value="2">Cliente</option>
            </select>
        </div>
                    <button type="submit" class="bg-accent text-white px-4 py-2 rounded hover:bg-secondary">Adicionar Usuário</button>
                </form>
            </div>

            <!-- Lista de Usuários -->
            <div class="bg-light shadow-md rounded-lg p-6">
                <h3 class="text-xl text-primary font-semibold mb-4">Usuários Cadastrados</h3>
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-muted text-secondary uppercase text-sm">
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Usuário</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr class="border-t">
                                <form method="POST" action="usuarios.php">
                                    <input type="hidden" name="acao" value="editar">
                                    <input type="hidden" name="id" value="<?php echo isset($usuario['id']) ? $usuario['id'] : ''; ?>">
                                    <td class="border px-4 py-2"><?php echo isset($usuario['id']) ? $usuario['id'] : ''; ?></td>
                                    <td class="border px-4 py-2">
                                        <input type="text" name="usuario" value="<?php echo isset($usuario['usuario']) ? $usuario['usuario'] : ''; ?>" class="w-full border border-gray-300 p-1 rounded-md text-primary">
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="email" name="email" value="<?php echo isset($usuario['email']) ? $usuario['email'] : ''; ?>" class="w-full border border-gray-300 p-1 rounded-md text-primary">
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <div class="inline-flex space-x-2">
                                            <button type="submit" class="bg-accent hover:bg-secondary text-white font-medium px-4 py-1 rounded-md">Salvar</button>
                                            <a href="usuarios.php?acao=excluir&id=<?php echo isset($usuario['id']) ? $usuario['id'] : ''; ?>" class="bg-red-500 hover:bg-red-700 text-white font-medium px-4 py-1 rounded-md">Excluir</a>
                                        </div>
                                    </td>
                                </form>
                            </tr> 
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="bg-light shadow-md rounded-lg p-6 mt-6">
    <h3 class="text-xl text-primary font-semibold mb-4">Contatos Recebidos</h3>
    <table class="min-w-full table-auto">
        <thead>
            <tr class="bg-muted text-secondary uppercase text-sm">
                <th class="px-4 py-2 text-left">Nome</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Mensagem</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conecte-se ao banco de dados e busque os contatos
            $mysqli = new mysqli("localhost", "user", "password", "database");

            if ($mysqli->connect_error) {
                die("Conexão falhou: " . $mysqli->connect_error);
            }

            $result = $mysqli->query("SELECT nome, email, mensagem FROM contatos");

            if ($result->num_rows > 0) {
                while($contato = $result->fetch_assoc()) {
                    echo "<tr class='border-t'>
                            <td class='px-4 py-2'>" . htmlspecialchars($contato['nome']) . "</td>
                            <td class='px-4 py-2'>" . htmlspecialchars($contato['email']) . "</td>
                            <td class='px-4 py-2'>" . htmlspecialchars($contato['mensagem']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr class='border-t'>
                        <td class='px-4 py-2' colspan='3'>Nenhum contato recebido.</td>
                      </tr>";
            }

            $mysqli->close();
            ?>
        </tbody>
    </table>
</div>


    <script>
        const toggleButton = document.getElementById('navbar-toggle');
        const navbarMenu = document.getElementById('navbar-menu');
        toggleButton.addEventListener('click', function () {
            navbarMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
