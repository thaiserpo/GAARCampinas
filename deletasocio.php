<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{

      $logarray = $array['login'];
      $idsocio = $_GET['idsocio'];

      echo"<script language='javascript' type='text/javascript'>
      if (confirm('Deseja deletar o sócio ID '+".$idsocio."+'?')) {";
         $query = "DELETE FROM SOCIO WHERE ID = '$idsocio'";
         $delete = mysqli_query($connect,$query);
         /*if($delete){*/
                   echo"alert('Sócio deletado com sucesso!');window.location.href='pesquisarsocio.php';";
         /*}else{
                   echo"alert('Erro ao deletar');window.location.href='resultadopretermo.php';";
                 }*/
         }
        echo "} 
        else {
                alert('Sócio não deletado!');window.location.href='pesquisarsocio.php';
        }
        </script>";
?>