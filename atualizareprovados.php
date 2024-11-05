<?php 
session_start();

include ("conexao.php");

$query = "SELECT ID, NOME_COMPLETO FROM FORM_PRE_ADOCAO";
$select = mysqli_query($connect,$query);

while ($fetch = mysqli_fetch_row($select)) {
    $id = $fetch[0];
    $nome_completo = $fetch[1];
    
    $query = "UPDATE REPROVADOS SET ID_PRETERMO='$id' WHERE ADOTANTE='$nome_completo'";
    $update =  mysqli_query($connect,$query);

}
				 			

mysqli_close($connect);

