<?php
session_start(); // Inicia a sessão

// Remove todas as variáveis de sessão
$_SESSION = [];

// Se desejar destruir a sessão completamente
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header("Location: index.php");
exit;
?>
