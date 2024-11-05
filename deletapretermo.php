<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{

$logarray = $array['login'];
$idtermo = $_GET['idtermo'];

          echo"<script language='javascript' type='text/javascript'>
          if (confirm('Deseja deletar o pré termo '+".$idtermo."+'?')) {";
             $query = "DELETE FROM FORM_PRE_ADOCAO WHERE ID = '$idtermo'";
             $delete = mysqli_query($connect,$query);
             /*if($delete){*/
                       echo"alert('Pré termo deletado com sucesso!');window.location.href='resultadopretermo.php';";
             /*}else{
                       echo"alert('Erro ao deletar');window.location.href='resultadopretermo.php';";
                     }*/
             }
            echo "} 
            else {
                    alert('Pré termo não deletado!');window.location.href='resultadopretermo.php';
            }
            </script>";
?>