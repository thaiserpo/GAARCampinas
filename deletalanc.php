<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
		}

$logarray = $array['login'];
$idlanc = $_GET['idlanc'];

$query = "DELETE FROM FINANCEIRO WHERE ID = '$idlanc'";
$delete = mysqli_query($connect,$query);
        
if($delete){
        if ($subarea == 'diretoria') {
          echo"<script language='javascript' type='text/javascript'>
          alert('Lançamento deletado com sucesso!');window.location.
          href='result_relatoriofinan.php';</script>";
        } else {
            echo"<script language='javascript' type='text/javascript'>
          alert('Lançamento deletado com sucesso!');window.location.
          href='result_relatoriofinan.php';</script>";
        }
}else{
          if ($subarea == 'diretoria') {
          echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao deletar');window.location.
          href='result_relatoriofinan.php';</script>";
        } else {
            echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao deletar');window.location.
          href='result_relatoriofinan.php';</script>";
        }
        }
}
?>