<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$mysqli = new mysqli("localhost", "usuario", "senha", "academia");

// Adicionar nova atividade
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'adicionar') {
    $atividade = $_POST['atividade'];
    $data = date('Y-m-d');

    $stmt = $mysqli->prepare("INSERT INTO atividades (atividade, data) VALUES (?, ?)");
    $stmt->bind_param("ss", $atividade, $data);
    $stmt->execute();
    header("Location: atividades.php");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Controle de Atividades - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Academia</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
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

    <div class="container mt-4">
        <h2>Controle de Atividades</h2>

        <div class="row">
            <!-- Formulário para Adicionar Atividade -->
            <div class="col-md-6">
                <h3>Adicionar Nova Atividade</h3>
                <form method="POST" action="atividades.php">
                    <input type="hidden" name="acao" value="adicionar">
                    <div class="form-group">
                        <label for="atividade">Atividade</label>
                        <input type="text" class="form-control" name="atividade" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Atividade</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
