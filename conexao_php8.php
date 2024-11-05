<?php
header("content-type: text/html; charset=utf-8");
global $connect;
$connect = mysqli_connect('localhost:3306','gaarca06_user','Gaar2000@','gaarca06_area');
$db = mysqli_select_db($connect,'gaarca06_area');

if (!$connect) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


//comandos de acentuação
mysqli_query($connect,"SET NAMES 'utf-8'");
mysqli_query($connect,"SET character_set_connection=utf8");
mysqli_query($connect,"SET character_set_client=utf8");
mysqli_query($connect,"SET character_set_results=utf8");

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