<?php
header("content-type: text/html; charset=utf-8");
global $connect;

function conectarMySQLi($host, $username, $password, $database) {
    $conexao = new mysqli($host, $username, $password, $database);

    // Verificar se ocorreu algum erro na conexão
    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }

    return $conexao;
}

$host = 'localhost:3306';
$username = 'gaarca06_user';
$password = 'Gaar2000@';
$database = 'gaarca06_area'; 

$connect = conectarMySQLi($host, $username, $password, $database);

//$connect->close();

/*
$host = 'localhost:3306';
$username = 'gaarca06_user';
$password = 'Gaar2000@';
$database = 'gaarca06_area';

// Cria a string de conexão do PDO
$dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

try {
    // Cria a conexão PDO
    $connect = new PDO($dsn, $username, $password);

    // Configura o modo de erro do PDO para Exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Realize operações no banco de dados aqui...

    // Fecha a conexão quando não for mais necessária
    $connect = null;
} catch (PDOException $e) {
    // Trate qualquer exceção ocorrida durante a conexão
    die('Erro na conexão: ' . $e->getMessage());
}
*/
?>