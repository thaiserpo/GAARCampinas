<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA,NOME FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
				$nome = $fetcharea[2];
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
    
    <title>GAAR - Pesquisa de procedimentos</title>
    
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
        <br>
        <center>
        <p>Os dados foram consultados da tabela de procedimentos. <br>
           Caso o procedimento não tenha sido encontrado, por favor entre em contato com a diretoria<br>
		</p>
		</center>
        
<?
		
		$nomedoanimal = strtoupper($_POST['nomedoanimal']);
		$nomedotutor = strtoupper($_POST['nomedotutor']);
		$status = $_POST['status'];
		$requigaar = $_POST['requigaar'];

		$query = "SELECT * FROM PROCEDIMENTOS WHERE REQUISITOR_GAAR = '$nome' ORDER BY DATA DESC";
		$select = mysqli_query($connect,$query);
		$reccount = mysqli_num_rows($select);
		
		if ($reccount == 0) {
			echo "
			<center><p>Nenhum procedimento encontrado</p> <br></center>
			";
		}else{ 
			echo "<form id='form' name='cadastratermo' action='#' method='GET' target='_blank'>";
            echo "<table class='table'>";
            echo "<thead class='thead-light'>
						  <tr>
							<th scope='col'>Data</th>
							<th scope='col'>Nome do animal</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Tutor</th>
							<th scope='col'>Requisitor</th>
							<th scope='col'>Aprovador</th>
							<th scope='col'>Tipo de procedimento</th>
							<th scope='col'>Valor GAAR</th>
							<th scope='col'>Valor tutor</th>
							<th scope='col'>Clínica</th>
							<th scope='col'>Status</th>
							<th scope='col'>&nbsp;</th>
						   </tr>
				</thead> ";
			while ($fetch = mysqli_fetch_row($select)) {
					$id = $fetch[0];
					$data = $fetch[1];
					$nomedoanimal = $fetch[2];
					$especie = $fetch[3];
					$sexo = $fetch[4];
					$nomedotutor = $fetch[5];
					$requigaar = $fetch[7];
					$aprovagaar  = $fetch[8];
					$tipoproc = $fetch[9];
					$valor = $fetch[10];
					$valortutor = $fetch[11];
					$clinica = $fetch[12];
					$status = $fetch[13];
					$emaildotutor = $fetch[14];
        		    echo "<tbody>";
					echo "<tr>";
        			echo "<td>".$data."</td>";
					echo "<td>".$nomedoanimal."</td>";
				    echo "<td>".$especie."</td>";
				    echo "<td>".$nomedotutor."</td>";
				    echo "<td>".$requigaar."</td>";
				    echo "<td>".$aprovagaar."</td>";
				    echo "<td>".$tipoproc."</td>";
				    echo "<td>".$valor."</td>";
				    echo "<td>".$valortutor."</td>";
				    echo "<td>".$clinica."</td>";
				    echo "<td>".$status."</td>";
				    if ($subarea =='diretoria'){
				        echo "<td><a href='formatualizaprocedi.php?id=".$id."' class='btn btn-primary'>Atualizar</a></td>";    
				    }else {
				        echo "<td>&nbsp;</td>";    
				    }
					echo "</tr>";
					echo "</tbody>";
					
			}   
			        echo "</table><br>";
			        echo "</form>";
		echo "</center>";
		echo "<center>".$reccount." procedimentos encontrados <br></center>";
		echo "</form><br>";
		}
		
		mysqli_close($connect);
?>
    <center><a href="formpesquisaprocedi.php" class="btn btn-primary">Voltar</a></center>
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