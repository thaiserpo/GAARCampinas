<?php 
session_start();

include ("conexao.php"); 

$queryselect = "SELECT FOTO, FOTO_2, FOTO_3, FOTO_4 FROM `ANIMAL` WHERE DIVULGAR_COMO ='GAAR' AND FOTO <>'' AND FOTO_2 <> '' AND FOTO_3 <> '' AND FOTO_4 <> ''";
$select = mysqli_query($connect,$queryselect);
$reccount = mysqli_num_rows($select);

$uploaddir = '/home/gaarca06/public_html/pets/';

while ($fetch = mysqli_fetch_row($select)) {
    $foto1 = $fetch[0];
    $foto2 = $fetch[1];
    $foto3 = $fetch[2];
    $foto4 = $fetch[3];
    
    unlink($uploaddir.$foto1);
    echo "<br> Foto apagada: ".$uploaddir.$foto1;
    unlink($uploaddir.$foto2);
    echo "<br> Foto apagada: ".$uploaddir.$foto2;
    unlink($uploaddir.$foto3);
    echo "<br> Foto apagada: ".$uploaddir.$foto3;
    unlink($uploaddir.$foto4);
    echo "<br> Foto apagada: ".$uploaddir.$foto4;
    
}

mysqli_close($connect);
?>