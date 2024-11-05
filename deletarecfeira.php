<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{

      $id = $_GET['id'];
      $tipo = $_GET['tipo']; 
      
       switch ($tipo){
            case 'vol':
                $query = "DELETE FROM LISTA_DE_PRESENCA WHERE ID = '$id'";
                break;
            case 'pet':
                $query = "DELETE FROM ANIMAIS_FEIRAS WHERE REG_ID = '$id'";
                break;
            case 'prod':
                $query = "DELETE FROM VENDAS_PRODUTOS WHERE ID = '$id'";
                break;
        }
        echo $query;
        $delete = mysqli_query($connect,$query);
        
        if(mysqli_errno($connect) == '0'){
                   echo"<script language='javascript' type='text/javascript'>
                          alert('Registro deleteado com sucesso!');
                		  window.location.href='formcadastrofeira.php'</script>";
         }else{
                   echo"<script language='javascript' type='text/javascript'>
                          alert('Erro ao deletar!');
                		  window.location.href='formcadastrofeira.php'</script>";
         }
}
?>
