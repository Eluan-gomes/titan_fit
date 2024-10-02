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
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
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

    <!-- Conteúdo Principal -->
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Controle de Atividades</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Formulário para Adicionar Atividade -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Adicionar Nova Atividade</h3>
                <form method="POST" action="atividades.php" enctype="multipart/form-data">
                    <input type="hidden" name="acao" value="adicionar">
                    <div class="mb-4">
                        <label for="atividade" class="block text-sm font-medium text-gray-700">Atividade</label>
                        <input type="text" name="atividade" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="imagem" class="block text-sm font-medium text-gray-700">Imagem</label>
                        <input type="file" name="imagem" accept="image/*" class="mt-1 block w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                        <input type="text" name="descricao" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md">Adicionar Atividade</button>
                </form>
            </div>

            <!-- Tabela de Atividades -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Atividades Cadastradas</h3>
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Atividade</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Descrição</th>
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
