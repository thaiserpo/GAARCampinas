<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$idpet = $_POST['idanimal'];
$idevento = $_POST['idfeira'];

$query = "INSERT INTO ANIMAIS_FEIRAS (ID_ANIMAL,ID_FEIRA) VALUES ('$idpet','$idevento')";
$insert = mysqli_query($connect,$query); 	
 
if(mysqli_errno($connect) == '0'){
/*	echo "Insert code: ".$insert;
	echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
  echo"<script language='javascript' type='text/javascript'>
  alert('Produto cadastrado com sucesso!');
  window.location.href='formcadastroprod.php'</script>";*/
}else{ 
	echo "Insert code: ".$insert;
	echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
	echo "<a href='formcadastroprod.php'>Voltar</a>";
  /*echo"<script language='javascript' type='text/javascript'>
  alert('Erro ao cadastrar');window.location
  .href='termo.php'</script>";*/
}

?>