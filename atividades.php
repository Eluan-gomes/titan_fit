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
    <title>Controle de Atividades - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="home.php"><img src="./assets/imgs/TITANFIT.png" alt="titanfit"></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="usuarios.php">Gerenciar Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="atividades.php">Gerenciar Atividades</a>
                </li>
            </ul>
        </div>
        <a href="logout.php" class="btn btn-danger ml-auto">Sair</a>
    </nav>

    <div class="container mt-5">
        <h2>Controle de Atividades</h2>

        <div class="row">
            <!-- Formulário para Adicionar Atividade -->
            <div class="col-md-10">
                <h3>Adicionar Nova Atividade</h3>
                <form method="POST" action="atividades.php">
                    <input type="hidden" name="acao" value="adicionar">
                    <div class="form-group">
                        <label for="atividade">Atividade</label>
                        <input type="text" class="form-control border border-info" name="atividade" required>
                    </div>
                    <div class="form-group">
                        <label for="imagem">Imagem</label>
                        <input type="file" name="imagem" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descricao</label>
                        <input type="text" class="form-control border border-info" name="descricao" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Atividade</button>
                </form>
            </div>
        </div>
        <div class="col-md-10 aling-center p-4">
                    <h3>Usuários Cadastrados</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Atividade</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($atividades as $atividade): ?>
                                <tr>
                                    <form method="POST" action="atividades.php">
                                        <input type="hidden" name="acao" value="editar">
                                        <input type="hidden" name="id" value="<?= $atividade['id'] ?>">
                                        <td><?= $atividade['id'] ?></td>
                                        <td>
                                            <input type="text" name="atividade" value="<?= $atividade['atividade'] ?>" class="form-control">
                                        </td>
                                        <td>
                                            <input type="descricao" name="descricao" value="<?= $atividade['descricao'] ?>" class="form-control">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-warning">Salvar</button>
                                            <a href="atividades.php?acao=excluir&id=<?= $atividade['id'] ?>" class="btn btn-danger">Excluir</a>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
    </div>
    <!-- lista de atividades -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
