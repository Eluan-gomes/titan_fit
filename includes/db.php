<?php
// db.php

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'titan_fit';
$username = 'root';  // Altere conforme sua configuração
$password = '';      // Altere conforme sua configuração

try {
    // Conectando ao banco de dados com PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Configurando o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Definindo a codificação para UTF-8
    $pdo->exec("set names utf8");

} catch (PDOException $e) {
    // Se a conexão falhar, exibe uma mensagem de erro
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
