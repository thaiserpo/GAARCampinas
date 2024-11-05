<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$idpet = $_POST['idpet'];
$novadatapost = $_POST['novadatapost'];
$novahorapost = $_POST['novahorapost'];

$query = "UPDATE ANIMAIS_REDES SET DIA_POST='$novadatapost', HORA_POST='$novahorapost' WHERE ID_ANIMAL ='$idpet'";
$insert = mysqli_query($connect,$query); 	
 
if(mysqli_errno($connect) == '0'){
/*	echo "Insert code: ".$insert;
	echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
  echo"<script language='javascript' type='text/javascript'>
  alert('Post atualizado com sucesso!');
  window.location.href='gradeposts.php'</script>";
}else{ 
	echo "Insert code: ".$insert;
	echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
	echo "<a href='gradeposts.php'>Voltar</a>";

}

?>