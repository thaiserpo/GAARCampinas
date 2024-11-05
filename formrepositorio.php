<?php
session_start();

include ("conexao.php");

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
    <meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="style-area.css" />
	<title>GAAR - Repositório de documentos </title>
	<script type="text/javascript">
	</script>
</head>
<body class="texto">
<header>
	<?php 
			  switch ($area) {
				  case 'operacional':
				  	include_once("menu_operacional.php") ;
					break;
				  case 'diretoria':
				  	include_once("menu_diretoria.php") ;
					break;
				  case 'captacao':
				  	include_once("menu_captacao.php") ;
					break;
     			  case 'financeiro':
				  	include_once("menu_financeiro.php") ;
					break;
				  case 'admin':
				  	include_once("menu_admin.php") ;
					break;
				  case 'comunicacao':
				  	include_once("menu_comunicacao.php") ;
					break;
				  
			  }
	}
?>
</header>
<div class="div-responsive">
<br>
<center><h2>Repositório de documentos do GAAR</h2></center>
<div class="div-responsive">
	<br><br>
	 <form action="cadastrodoc.php" method="POST" enctype="multipart/form-data" name="form"> 
	 <table width="400" border="0" align="center" id="cadastrapet">
	     <tr>
            <td align="right">Nome do arquivo: </td>
            <td align="left"><input class="box"  type="file" name="doc" id="doc" >/td> </td>
        </tr>
	 </table>
	</form>
	<br><br>
    <?
		 		$query = "SELECT FILE FROM DOCUMENTACAO ORDER BY FILE ASC";
				$select = mysqli_query($connect,$query);
				
				while ($fetch = mysqli_fetch_row($select)) {
					echo "<center><a href='/docs/".$fetch[0]."' download> Baixar ".$fetch[0]."</a></center>";
				}
				
		?>
</div>
<br>
<footer class="footer fixed-bottom bg-light">
      <div class="container">
        <p class="text-center">GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
      </div>
    </footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>