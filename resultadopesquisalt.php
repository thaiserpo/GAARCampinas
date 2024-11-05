<?php 		
		/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
		$login = $_SESSION['login'];
		
		if($login == "" || $login == null){
				  echo"<script language='javDESCript' type='text/javDESCript'>
				  alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
		}else{
		
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
		
		$nomelt = $_POST['nomelt'];
		$especies = $_POST['especies'];
		
		if ($nomelt != '' && $especies == ''){
			$query = "SELECT * FROM LT WHERE LAR_TEMPORARIO like '%$nomelt%' ORDER BY ID DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
		}
		
		if ($nomelt != '' && $especies != ''){
			$query = "SELECT * FROM LT WHERE LAR_TEMPORARIO like '%$nomelt%' AND ESPECIES = '$especies' ORDER BY ID DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
		}
		
		if ($nomelt == '' && $especies != ''){
			$query = "SELECT * FROM LT WHERE ESPECIES = '$especies' ORDER BY ID DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
		}
		
		if ($nomelt == '' && $especies -= ''){
			$query = "SELECT * FROM LT ORDER BY ID DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
		}
			
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Meta tags Obrigatórias -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Pesquisa de lares temporários</title>
    
</head>
<body> 
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
<br><br><br><br><br>
<main role="main" class="container">
    <div class="starter-template">
    <center>
        <h3> PESQUISA DE LARES TEMPORÁRIOS</h3><br>
        <p><label>Para pesquisar um lt, escolha uma das opções abaixo:</label></p>
       </center>
<?php 			

				
		if ($reccount == 0) {
			echo "Nenhum animal encontrado <br><br>
				<a href='formpesquisapetinterna.php'><font face='Verdana, Arial, Helvetica, sans-serif'>Voltar</font></a>
			";
		}else{ 
			echo "<table border='0' width='500' class='div-responsive'>";
			echo "<tr class='relatorio-table-tr-header-2'>";
			echo "<td>";
			echo "<b>Número</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Nome</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Espécie</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Castração</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Data da castração</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Vacinação</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Lar temporário</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Status</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Responsável</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Divulgar como</b>";
			echo "</td>";
			echo "</tr>";		
			while ($fetch = mysqli_fetch_row($select)) {
					$idanimal = $fetch[0];	
					$nomedoanimal = $fetch[1];
					$especie = $fetch[2];
					$castracao = $fetch[7];
					$dtcastracao  = $fetch[8];
					$vacinacao = $fetch[9];
					$status = $fetch[10];
					$lt = $fetch[11];
					$resp = $fetch[12];
					$divcomo = $fetch[18];
					echo "<tr class='relatorio-table-tr-detail'>";
					echo "<td>";
					echo $idanimal;
					echo "</td>";
					echo "<td>";
					echo $nomedoanimal;
					echo "</td>";
					echo "<td>";
					echo $especie;
					echo "</td>";
					echo "<td>";
					echo $castracao;
					echo "</td>";
					echo "<td>";
					echo $dtcastracao;
					echo "</td>";
					echo "<td>";
					echo $vacinacao;
					echo "</td>";
					echo "<td>";
					echo $lt;
					echo "</td>";
					echo "<td>";
					echo $status;
					echo "</td>";
					echo "<td>";
					echo $resp;
					echo "</td>";
					echo "<td>";
					echo $divcomo;
					echo "</td>";
					echo "</tr>";
			}
		mysqli_data_seek($select, 0 );
		echo "</table><br><br></center>";
		echo "<center>".$reccount." animais encontrados <br><br>
				<form action='formatualizapet.php' method='post' name='atualizapet'>
				<table width='240' border='0' class='texto'>
				<tr>
				<td align='left'>Escolha o termo para atualizar: </td>
			  	<td align='right'><select name='idanimal'>";
				while ($fetch = mysqli_fetch_row($select)) {
					echo "<option value='".$fetch[0]."' id='".$fetch[0]."'>".$fetch[0]."							
						</option>";
				}
				echo "</select></td>
				</tr>
				</table><br><br>
				<input type='submit' value='Atualizar' id='atualizar' name='atualizar' class='texto'>
				</form>
				<br>
			<a href='formpesquisapetinterna.php'><font face='Verdana, Arial, Helvetica, sans-serif'>Voltar</font></a>
			</center>
			</div>";
		}
		
		mysqli_close($connect);
		}
?>
<br><br>
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
</html>