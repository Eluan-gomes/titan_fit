<?php
include('db.php');
session_start(); // Inicie a sessão aqui para garantir que ela esteja disponível em todo o script

if (isset($_POST['email']) && isset($_POST['senha'])) { // Usar '&&' para verificar ambos os campos
    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu email";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        // É recomendado usar hashing para senhas. Aqui, assumindo que as senhas estão armazenadas hashed
        $sql_code = "SELECT * FROM usuarios WHERE email = '$email'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código de busca: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();
            
            // Verificar a senha usando password_verify se a senha estiver hasheada
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['user'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];

                header("Location: dashboard.php");
                exit(); // Adicione exit() após header() para garantir que o script pare aqui
            } else {
                echo "Falha ao logar! email ou senha inválidos";
            }
        } else {
            echo "Falha ao logar! email ou senha inválidos";
        }
    }
}
?>
