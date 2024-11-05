<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
$id = $_SESSION['idpretermo'];
$obs = $_POST['obs'];
$status = $_POST['status'];

	if ($id != '') {
      $query = "UPDATE FORM_PRE_ADOCAO 
					SET 
					STATUS_ANIMAL = '$status'
					WHERE ID ='$id'"; 
					
		$update = mysqli_query($connect,$query) or die(mysql_error());	
		
        /*if($update=='0'){*/
          echo"<script language='javascript' type='text/javascript'>
          alert('Pré termo atualizado com sucesso!');
		  window.location.href='pesquisapretermo.php'</script>";
/*        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao atualizar');
		  window.location.href='pesquisatermo.php'</script>";
        }*/
	}else{
		  echo"<script language='javascript' type='text/javascript'>
          alert('ID inválido');
		  window.location.href='pesquisapretermo.php'</script>";
		
}
}
?>