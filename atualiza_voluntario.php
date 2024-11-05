<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
$senha = MD5($_POST['senha']);
$nome = $_POST['nome'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$area = $_POST['area'];
$subarea = $_POST['subarea'];
$name = $_POST['name'];
$query_select = "SELECT * FROM VOLUNTARIOS WHERE USUARIO = '$login'";
$select = mysqli_query($connect,$query_select);
$array = mysqli_fetch_array($select);
$logarray = $array['login'];

/*echo 'Login: '.$login;*/

if ($login == $logarray){
        $query = "UPDATE VOLUNTARIOS SET SENHA='$senha',NOME='$nome',CELULAR='$celular',EMAIL='$email',AREA='$area',SUBAREA='$subarea' WHERE USUARIO = '$login'";
        $update = mysqli_query($connect,$query);
        echo 'Update: '.$update;
        if($update =='0'){
          echo"<script language='javascript' type='text/javascript'>
          alert('Usuário atualizado com sucesso!');window.location.
          href='login.html'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao atualizar - preencha pelo menos o campo login');window.location
          .href='cadastro.html'</script>";
        }
}
else { 
		  echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não cadastrado');window.location
          .href='cadastro.html'</script>";
}
}
?>