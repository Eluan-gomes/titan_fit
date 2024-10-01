<?php
include 'db.php';
// session_start();
// if (!isset($_SESSION['id'])) {
//     header("Location: usuarios.php");
//     exit;
// }

// $mysqli = new mysqli("localhost", "usuario", "senha", "academia");

// Inserir novo usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'inserir') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha);
    $stmt->execute();
    header("Location: usuarios.php");
}

// Editar usuário
if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $stmt = $mysqli->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nome, $email, $id);
    $stmt->execute();
    header("Location: usuarios.php");
}

// Excluir usuário
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $mysqli->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: usuarios.php");
}

// Listar usuários
$result = $mysqli->query("SELECT * FROM usuarios");
$usuarios = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Controle de Usuários - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="home.php"><img src="./assets/imgs/TITANFIT.png" alt="titan"></a>
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

    <div class="container mt-4">
        <h2>Controle de Usuários</h2>

        <div class="row aling-itens-center ">
            <!-- Formulário para Inserir Usuário -->
            <div class="col-md-6 ">
                <h3>Inserir Novo Usuário</h3>
                <form method="POST" action="usuarios.php">
                    <input type="hidden" name="acao" value="inserir">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control border border-info" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control border border-info" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control border border-info" name="senha" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Usuário</button>
                </form>
            </div>

            <!-- Lista de Usuários -->
            <div class="col-md-8 p-4">
                <h3>Usuários Cadastrados</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <form method="POST" action="usuarios.php">
                                    <input type="hidden" name="acao" value="editar">
                                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                                    <td><?= $usuario['id'] ?></td>
                                    <td>
                                        <input type="text" name="nome" value="<?= $usuario['nome'] ?>" class="form-control">
                                    </td>
                                    <td>
                                        <input type="email" name="email" value="<?= $usuario['email'] ?>" class="form-control">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-warning">Salvar</button>
                                        <a href="usuarios.php?acao=excluir&id=<?= $usuario['id'] ?>" class="btn btn-danger">Excluir</a>
                                    </td>
                                </form>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
