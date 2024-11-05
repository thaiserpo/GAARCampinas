<?php 
session_start();

include ("area/conexao.php"); 

$queryselect = "SELECT * FROM FORM_VOLUNTARIO";
$select = mysqli_query($connect,$queryselect); 


while ($fetchselect = mysqli_fetch_row($select)) {
    $campo1 = $fetchselect[0];	//NOME
    $campo2 = $fetchselect[1];	//EMAIL
    $campo3 = "SIM"; //RECEBER
    $campo4 = "NÃO"; //ENVIADO

    $query = "INSERT INTO EMAIL_MARKETING 
                    (NOME,
                    EMAIL,
                    RECEBER,
                    ENVIADO)
                    VALUES (
                    '$campo1',
                    '$campo2',
                    '$campo3',
                    '$campo4') ";
    //echo "<br> insert: ".$query;
    /*
    $insert = mysqli_query($connect,$query); 
    echo "Insert code: ".$insert;
    echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
    if(mysqli_errno($connect) == '0'){
        echo "<br>Dado inserido: ".$campo1." - ".$campo2."";
    }else {
        echo "<br>Dado duplicado: ".$campo1." - ".$campo2."";
    }
    */

}


?>

