<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$usuariovol = $_GET['usuario'];

$dias_inativo = date('d/m/Y', strtotime('-90 days'));

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
    
    $queryselect = "SELECT NOME,AREA,USUARIO FROM VOLUNTARIOS WHERE USUARIO = '$login' or EMAIL = '".$login."'";
    $select = mysqli_query($connect,$queryselect);
    
    while ($fetch = mysqli_fetch_row($select)) {
        $nomevol = $fetch[0];
        $area = $fetch[1];
        $usuario = $fetch[2];
    } 
    
    if ($usuario == $login){
        $query = "UPDATE VOLUNTARIOS WHERE USUARIO = '$usuariovol'";
        $delete = mysqli_query($connect,$query);
        
        if(mysqli_errno($connect) == '0'){
            echo"<script language='javascript' type='text/javascript'>
                                        alert('Usuário deletado com sucesso');window.location
                                        .href='listavoluntarios.php'</script>";
        }
    }
}
?>