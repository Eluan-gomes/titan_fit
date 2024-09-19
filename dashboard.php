<?php
include 'db.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$mysqli = new mysqli("localhost", "usuario", "senha", "academia");

// Exibir atividades
$resultAtividades = $mysqli->query("SELECT * FROM atividades");
$atividades = $resultAtividades->fetch_all(MYSQLI_ASSOC);

// Exibir profissionais de educação física
$profissionais = [
    ['nome' => 'Carlos Silva', 'funcao' => 'Personal Trainer', 'experiencia' => '5 anos', 'imagem' => 'carlos.jpg'],
    ['nome' => 'Maria Oliveira', 'funcao' => 'Instrutora de Yoga', 'experiencia' => '3 anos', 'imagem' => 'maria.jpg'],
    // Adicione mais profissionais conforme necessário
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel - Academia</title>
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
        <h2>Painel do Coordenador</h2>

        <!-- Grid de Imagens da Academia -->
        <h3>Imagens da Academia</h3>
        <div class="row">
            <div class="col-md-4"><img src="imagem1.jpg" class="img-fluid" alt="Imagem 1"></div>
            <div class="col-md-4"><img src="imagem2.jpg" class="img-fluid" alt="Imagem 2"></div>
            <div class="col-md-4"><img src="imagem3.jpg" class="img-fluid" alt="Imagem 3"></div>
        </div>

        <!-- Lista de Profissionais de Educação Física -->
        <h3>Profissionais de Educação Física</h3>
        <div class="row">
            <?php foreach ($profissionais as $profissional): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?= $profissional['imagem'] ?>" class="card-img-top" alt="<?= $profissional['nome'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $profissional['nome'] ?></h5>
                            <p class="card-text">Função: <?= $profissional['funcao'] ?></p>
                            <p class="card-text">Experiência: <?= $profissional['experiencia'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Lista de Atividades -->
        <h3>Atividades Registradas</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Atividade</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($atividades as $atividade): ?>
                    <tr>
                        <td><?= $atividade['id'] ?></td>
                        <td><?= $atividade['atividade'] ?></td>
                        <td><?= $atividade['data'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
