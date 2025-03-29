<?php

// Conexão com PHP 
//php -S localhost:3306


$host = "localhost:3306";
$user = "root";
$pass = ""; // Senha do usuário
$db = "to_do"; // Nome do banco de dados

$conn = new mysqli($host, $user, $pass, $db);



// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}



