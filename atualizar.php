<?php 
session_start();

include ("conexao.php"); 

$getid = "SELECT * FROM AGENDAMENTO ORDER BY DATA_AG ASC";
$id = mysqli_query($connect,$getid); 

$count=0;

while ($fetch = mysqli_fetch_row($id)) {
   $codigo = $fetch[0]; 
   $nomedoanimal = $fetch[3]; 
   $count = $count + 1;
   $sqlupdate = "UPDATE AGENDAMENTO 
        SET ID = '$count'
        WHERE CODIGO='$codigo' AND NOME_ANIMAL='$nomedoanimal'";
		
   $update = mysqli_query($connect,$sqlupdate); 
   echo "<br>".$sqlupdate." - - Mensagem de erro: ".mysqli_error($connect). " SQL Error: ".mysqli_errno($connect)."";
}


?>
