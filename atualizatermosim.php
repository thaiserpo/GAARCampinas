<?php 
session_start();

include ("conexao.php"); 

/*** atualiza tabela de animais com os termos cadastrados **/

$getpet= "SELECT * FROM TERMO_ADOCAO";
$pet = mysqli_query($connect,$getpet); 

$sum =0;

while ($fetch = mysqli_fetch_row($pet)) {
    
    $nomeanimal = $fetch[15];
    $especie = $fetch[16];
    $lt = $fetch[30];
    $resp = $fetch[50];
    
    /*echo "<br> Nome do animal: ".$nomeanimal;
    echo "<br> Especie       : ".$especie;
    echo "<br> Lar temporario: ".$lt;
    echo "<br> Responsavel   : ".$resp;*/
    
    $query = "UPDATE ANIMAL SET TERMO_ADOCAO='Sim' WHERE NOME_ANIMAL = '$nomeanimal'  AND ESPECIE = '$especie'  AND LAR_TEMPORARIO = '$lt' AND RESPONSAVEL = '$resp'";
    $update = mysqli_query($connect,$query);
    
    /*echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";*/
    
    if(mysqli_errno($connect) == '0' ){
        $sum = intval($sum) + 1;
    }
}

echo "<br> reg atualizados: ".$sum;


?>