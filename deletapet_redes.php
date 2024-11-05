<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$idpost = $_GET['idpost'];

$query = "DELETE FROM ANIMAIS_REDES WHERE ID_POST ='$idpost'";
$insert = mysqli_query($connect,$query); 	
 
if(mysqli_errno($connect) == '0'){
/*	echo "Insert code: ".$insert;
	echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
  echo"<script language='javascript' type='text/javascript'>
  alert('Post deletado com sucesso!');
  window.location.href='gradeposts.php'</script>";
}else{ 
	echo "Insert code: ".$insert;
	echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
	echo "<a href='gradeposts.php'>Voltar</a>";

}

?>