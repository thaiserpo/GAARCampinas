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
		
		$nomeanimal = strtoupper($_POST['nomedoanimal']);
		$nomeadotante = strtoupper($_POST['nomedoadotante']);
		$especie = $_POST['especie'];
		
		/*echo "Especie: ".$especie;
		echo "Nome: ".$nomeanimal;
		echo "Status: ".$status;
		echo "LT: ".$lt;
		echo "Divulgar como: ".$divulgar;*/
		
		if ($nomeanimal != '' && $especie == ''){
			$query = "SELECT * FROM CALENDARIO WHERE NOME_ANIMAL like '%$nomeanimal%' ORDER BY ID ASC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
		}
		
		
		if ($nomeanimal != '' && $especie != '' && $nomeadotante == ''){
			$query = "SELECT * FROM CALENDARIO WHERE NOME_ANIMAL like '%$nomeanimal%' and ESPECIE = '$especie' ORDER BY NOME_ANIMAL AND ESPECIE ASC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
		}

		if ($nomeanimal == '' && $especie != '' && $nomeadotante == ''){
			$query = "SELECT * FROM CALENDARIO WHERE ESPECIE ='$especie' ORDER BY NOME_ANIMAL ASC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
		}
		
		if ($nomeadotante != '' && $nomeanimal == '' && $especie == ''){
			$query = "SELECT * FROM CALENDARIO WHERE ADOTANTE like '%$nomeadotante%' ORDER BY ID ASC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
		}
		
		if ($nomeanimal == '' && $especie == '' && $nomeadotante == ''){
			$query = "SELECT * FROM CALENDARIO ORDER BY NOME_ANIMAL ASC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
		}
		
		
		if ($nomeadotante != '' && $nomeanimal != '' && $especie == ''){
			$query = "SELECT * FROM CALENDARIO WHERE ADOTANTE like '%$nomeadotante%' and NOME_ANIMAL like '%$nomeanimal%' ORDER BY ID ASC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
		}
		
		if ($nomeadotante == '' && $nomeanimal != '' && $especie == ''){
			$query = "SELECT * FROM CALENDARIO WHERE NOME_ANIMAL like '%$nomeanimal%' ORDER BY ID ASC";
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
    
    <title>GAAR - Pesquisa de animais para calendário</title>
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
<main role="main" class="container">
    <div class="starter-template">
       <center>
        <h3>PESQUISA DE ANIMAIS PARA CALENDÁRIO</h3><br>
        <p><label>Os dados foram consultados da base de dados do GAAR</label></p>
       </center>
       <br>
<?php 			
		
		if ($reccount == 0) {
			echo "Nenhum animal encontrado <br>";
		}else{ 
		    echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>Nome do animal</th>";
        	echo "<th scope='col'>Espécie</th>";
        	echo "<th scope='col'>Adotante</th>";
        	echo "<th scope='col'>E-mail</th>";
        	echo "<th scope='col'>Votos</th>";
        	echo "<th scope='col'>Modelo</th>";
        	echo "<th scope='col'>Ano</th>";
        	echo "<th scope='col'>Mês</th>";
        	echo "<th scope='col'>&nbsp</th>";
        	echo "</thead>";
        	echo "<tbody>";
			while ($fetch = mysqli_fetch_row($select)) {
					$idanimal = $fetch[0];	
					$nomedoanimal = $fetch[1];
					$adotante = $fetch[2];
					$email = $fetch[3];
					$especie = $fetch[4];
					$votos  = $fetch[5];
					$modelo = $fetch[6];
					$ano = $fetch[7];
					$mes = $fetch[8];
					echo "<tr>";
        			echo "<td>".$nomedoanimal."</td>";
					echo "<td>".$especie."</td>";
					echo "<td>".$adotante."</td>";
					echo "<td>".$email."</td>";
					echo "<td>".$votos."</td>";
					echo "<td>".$modelo."</td>";
					echo "<td>".$ano."</td>";
					echo "<td>".$mes."</td>";
					echo "<td><a href='formatualizapetcalend.php?id=".$idanimal."' class='btn btn-primary'>Atualizar</a></td>";
					echo "</tr>";
			}
			
			echo "</tbody>";
			echo "</table><br>";
			echo "<center><a href='formpesquisapetcalendar.php' class='btn btn-primary'>Voltar</a><center>";
		}
		
		mysqli_close($connect);
?>
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