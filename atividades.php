<?php
include 'db.php';
// session_start();
// if (!isset($_SESSION['id'])) {
//     header("Location: index.php");
//     exit;
// }

// $mysqli = new mysqli("localhost", "usuario", "senha", "academia");

// Adicionar nova atividade
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'adicionar') {
    $atividade = $_POST['atividade'];
    $descricao = $_POST['descricao'];
    $data = date('Y-m-d');
    
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagem = $_FILES['imagem'];
        $imagemNome = basename($imagem['name']);
        $imagemPath = 'caminho/para/salvar/imagens/' . $imagemNome;

        // Mova a imagem para o diretório desejado
        if (move_uploaded_file($imagem['tmp_name'], $imagemPath)) {
            // Aqui você pode salvar os dados da atividade no banco de dados, incluindo o caminho da imagem
            // Supondo que você tenha uma conexão com o banco de dados $conn
            $sql = "INSERT INTO atividades (atividade, descricao, data, imagem) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $atividade, $descricao, $data, $imagemPath);
            $stmt->execute();
        } else {
            echo "Erro ao mover o arquivo da imagem.";
        }
    }

    $stmt = $mysqli->prepare("INSERT INTO atividades (atividade, descricao, data) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $atividade, $descricao, $data);
    $stmt->execute();
    header("Location: atividades.php");
}
if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {
    $id = $_POST['id'];
    $atividade = $_POST['atividade'];
    $descricao = $_POST['descricao'];

    $stmt = $mysqli->prepare("UPDATE atividades SET atividade = ?, descricao = ? WHERE id = ?");
    $stmt->bind_param("ssi", $atividade, $descricao, $id);
    $stmt->execute();
    header("Location: atividades.php");
}

// Excluir usuário
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $mysqli->prepare("DELETE FROM atividades WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: atividades.php");
}

// Listar usuários
$result = $mysqli->query("SELECT * FROM atividades");
$atividades = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Atividades - Academia</title>
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
<body class="bg-primary text-ligth">
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

    <!-- Conteúdo Principal -->
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 text-center font-serif text-light">Controle de Atividades</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Formulário para Adicionar Atividade -->
            <div class="bg-light shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-primary">Adicionar Nova Atividade</h3>
                <form method="POST" action="atividades.php" enctype="multipart/form-data">
                    <input type="hidden" name="acao" value="adicionar">
                    <div class="mb-4">
                        <label for="atividade" class="block text-sm font-medium text-secondary">Atividade</label>
                        <input type="text" name="atividade" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-primary" required>
                    </div>
                    <div class="mb-4">
                        <label for="imagem" class="block text-sm font-medium text-secondary">Imagem</label>
                        <input type="file" name="imagem" accept="image/*" class="mt-1 block w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="descricao" class="block text-sm font-medium text-secondary">Descrição</label>
                        <input type="text" name="descricao" class="mt-1 block w-full border border-gray-300 text-primary rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    </div>
                    <button type="submit" class="bg-accent text-white px-4 py-2 rounded hover:bg-secondary">Adicionar Atividade</button>
                </form>
            </div>

            <!-- Tabela de Atividades -->
            <div class="bg-light shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Atividades Cadastradas</h3>
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-muted text-secondary uppercase text-sm">
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Atividade</th>
                            <th class="px-4 py-2 text-left">Descrição</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($atividades as $atividade): ?>
                            <tr class="border-t">
                                <form method="POST" action="atividades.php">
                                    <input type="hidden" name="acao" value="editar">
                                    <input type="hidden" name="id" value="<?= $atividade['id'] ?>">
                                    <td class="border px-4 py-2"><?= $atividade['id'] ?></td>
                                    <td class="border px-4 py-2">
                                        <input type="text" name="atividade" value="<?= $atividade['atividade'] ?>" class="w-full border border-gray-300 rounded-md px-2 py-1">
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="text" name="descricao" value="<?= $atividade['descricao'] ?>" class="w-full border border-gray-300 rounded-md px-2 py-1">
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <div class="inline-flex space-x-2">
                                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-6 py-1 rounded-md">Salvar</button>
                                            <a href="atividades.php?acao=excluir&id=<?= $atividade['id'] ?>" class="bg-red-500  hover:bg-red-600 text-white font-medium px-6                                     py-1    rounded-md">Excluir</a>
                                        </div>
                                    </td>
                                    <!-- <td class="border px-4 py-2 text-right">
                                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-6 py-1 rounded-md">Salvar</button>
                                        <a href="atividades.php?acao=excluir&id=<?= $atividade['id'] ?>" class="bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-1 rounded-md ml-2">Excluir</a>
                                    </td> -->
                                </form>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
