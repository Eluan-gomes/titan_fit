<?php
// No início de páginas protegidas:
session_start();

// Verifique se o usuário está autenticado.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se não estiver autenticado, redirecione para a página de login.
    //header('Location: login.php');
    //exit();
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-blue-600">
    <nav class="bg-gradient-to-r from-gray-200 to-white flex justify-end items-center py-4 px-8">
        <ul>
            <li class="text-xl font-bold pr-4"><a href="home.php" class="text-black">Home</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="cadastrofun.php" class="text-black">Cadastro Funcionário</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="listafun.php" class="text-black">Lista de Funcionários</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="cadastroepi.php" class="text-black">Cadastro EPI's</a></li>
        </ul>
        <ul>
            <li class="text-xl font-bold pr-4"><a href="listaepi.php" class="text-black">Lista EPI's</a></li>
        </ul>
    </nav>

    <div class="p-6 bg-white rounded-lg mt-10"><!--w-full max-w-md mx-auto-->
        <div class="flex items-center space-x-4">
            <h1 class="text-4xl font-bold text-center">Lista de Funcionários</h1>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr class="bg-white">
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Cargo</th>
                    <th>Salário</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $hostname = "localhost";
                $username = "root";
                $password = "";
                $database = "ceocontrolsystem";
                
                try {
                    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $stmt = $pdo->prepare("SELECT nome, idade, cargo, salario FROM cadastrofun");
                    $stmt->execute();
                    
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['idade'] . "</td>";
                        echo "<td>" . $row['cargo'] . "</td>";
                        echo "<td>" . $row['salario'] . "</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
