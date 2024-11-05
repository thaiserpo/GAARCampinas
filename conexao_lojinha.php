<?php
header("content-type: text/html; charset=utf-8");
global $connectloja;
$connectloja = mysqli_connect('localhost:3306','gaarca06_gaar','p6ni54S5..','gaarca06_gaar');
$db = mysqli_select_db($connectloja,'gaarca06_area');

if (!$connectloja) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


//comandos de acentuação
mysqli_query($connectloja,"SET NAMES 'utf-8'");
mysqli_query($connectloja,"SET character_set_connection=utf8");
mysqli_query($connectloja,"SET character_set_client=utf8");
mysqli_query($connectloja,"SET character_set_results=utf8");
?>