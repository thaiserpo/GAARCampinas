<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{

$logarray = $array['login'];

$query = "DELETE FROM VOLUNTARIOS WHERE USUARIO = '$login'";
$delete = mysqli_query($connect,$query);
        
if($delete){
          echo"<script language='javascript' type='text/javascript'>
          alert('Usuário deletado com sucesso!');window.location.
          href='cadastro.html'</script>";
}else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao deletar');window.location
          .href='cadastro.html'</script>";
        }
}
?>