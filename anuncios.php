<?php 		
		/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

		include ("conexao.php"); 
		
		$login = $_SESSION['login'];
		$id = $_SESSION['idanimal'];
		
		/*if($login == "" || $login == null){
				  echo"<script language='javascript' type='text/javascript'>
				  alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
		}else{*/
		
		$queryarea = "SELECT AREA,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$email = $fetcharea[1];
		}
		
		$nomeanimal = $_POST['nomedoanimal'];
		$especie = $_POST['especie'];
		$status = $_POST['status'];
		$lt = $_POST['lt'];
		
		$query = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO <> 'GAAR' AND OBS2='".$email."' ORDER BY ID ASC";
		$select = mysqli_query($connect,$query);
		$reccount = mysqli_num_rows($select);
			
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
    
    <title>GAAR - Anúncios</title>
    
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
				  case 'anuncios':
				  	include_once("menu_terceiros.php") ;
					break;
				  
			  }
			  
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
         <CENTER>
	        <h3>SEUS ANÚNCIOS</h3>
         </CENTER>
         <br>
            </p></label>
<?
		if ($reccount == 0) {
			echo "<Center><p>Nenhum animal encontrado</p></center> <br><br>";
		}else{ 
		    echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>Espécie</th>";
        	echo "<th scope='col'>Status da castração</th>";
        	echo "<th scope='col'>Status da vacinação</th>";
        	echo "<th scope='col'>Responsável</th>";
        	echo "<th scope='col'>Status</th>";
        	echo "<th scope='col'>&nbsp;</th>";
        	echo "</thead>";
        	echo "<tbody>";
			while ($fetch = mysqli_fetch_row($select)) {
					$id = $fetch[0];	
					$nomedoanimal = $fetch[1];
					$especie = $fetch[2];
					$castracao = $fetch[7];
					$dtcastracao  = $fetch[8];
					$vacinacao = $fetch[9];
					$status = $fetch[10];
					$lt = $fetch[11];
					$resp = $fetch[12];
					$divcomo = $fetch[18];
					if ($divcomo =='Terceiros'){
					    $divcomo = 'Aprovado';
					}
					$categoria = $fetch[20];
        			echo "<tr>";
        			echo "<td>".$nomedoanimal."</td>";
        			echo "<td>".$especie."</td>";
        			echo "<td>".$castracao."</td>";
					echo "<td>".$vacinacao."</td>";
					echo "<td>".$resp."</td>";
					echo "<td>".$divcomo."</td>";
					echo "<td><a href='deletapet.php?idanimal=".$fetch[0]."' class='btn btn-primary'>Deletar</a></td>";
					echo "</tr>";
			}	
			       	echo "</tbody>";
					echo "</table>";
		}
?>
<br>

    </div>
</main>
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
