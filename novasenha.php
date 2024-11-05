<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$senha = MD5($_POST['senha']);
	
		$querya = "SELECT SENHA FROM VOLUNTARIOS WHERE USUARIO ='$login'" OR die("Error:".mysql_error());;
        $select = mysqli_query($querya,$connect);
	
		echo "Login: ".$login;
		echo "Senha antiga: ".$select;
		echo "Senha nova: ".$senha;

        $query = "UPDATE VOLUNTARIOS SET SENHA='$senha' WHERE USUARIO = '$login'" OR die("Error:".mysql_error());;
        $update = mysqli_query($connect,$query);

        if($update =='0'){
          echo"<script language='javascript' type='text/javascript'>
          alert('Senha atualzada com sucesso!');window.location.
          href='login.html'</script>";
        }else{
		  echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao atualizar');window.location
          .href='novasenha.html'</script>";
}
?>