<?php 		
		/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
		$login = $_SESSION['login'];
		
		if($login == "" || $login == null){
				  echo"<script language='javasript' type='text/javscript'>
				  alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
		}else{
		
		$queryarea = "SELECT * FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[5];
				$subarea = $fetcharea[6];
				
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
    
    <title>GAAR - Lista de lares temporários</title>
    
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
           <br>
        <h3>LISTA DE ESPERA DE CÃES (LEC)</h3><br>
        <p><label> Caso algum não esteja aparecendo, cadastre <a href="forminscricaoleg.php" target="_blank">aqui</a></label></p>
       </center>
<?php 			
            $query = "SELECT * FROM ANIMAL WHERE ADOTADO <> 'Adotado' AND ESPECIE = 'Canina' and (DIVULGAR_COMO ='GAAR' OR DIVULGAR_COMO ='CPG') ORDER BY DATA_REG ASC";
    		$select = mysqli_query($connect,$query);
    		$reccount = mysqli_num_rows($select);
    		
    		/*if ($reccount <= '55') {
    		    echo "<p><center>Hoje temos 0 vagas disponíveis.</center></p>";
    		} else {
    		    echo "<p><center>Hoje temos ".$reccount." vagas disponíveis.</center></p>";
    		}*/
    		
?>
    
        

<?
        
        $query = "SELECT * FROM ANIMAL WHERE ESPECIE ='Canina' ORDER BY DATA_REG ASC";
    	$select = mysqli_query($connect,$query);
    	$reccount = mysqli_num_rows($select);

		if ($reccount == 0) {
			echo "<center>Nenhum animal encontrado <br></center>";
		}else{ 
		    echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>Nome do animal</th>";
        	echo "<th scope='col'>Responsável</th>";
        	echo "<th scope='col' colspan='3'>Data da inscrição</th>";
        	echo "</thead>";
        	echo "<tbody>";
			while ($fetch = mysqli_fetch_row($select)) {
			        $nomedoanimal = $fetch[1];	
					$resp = $fetch[12];
					$dtinscricao = $fetch[19];
					$status = $fetch[10];
					if ($status == 'LEG') {
    					echo "<tr>";
    					echo "<td>".$nomedoanimal."</td>";
    					echo "<td>".$resp."</td>";
    					echo "<td>".$dtinscricao."</td>";
    					if ($subarea =='diretoria'){
    					   echo "<td align='center' colspan='3'><a href='formatualizapet.php?idanimal=".$fetch[0]."' class='btn btn-primary'>Atualizar</a>&nbsp;<a href='deletapet.php?idanimal=".$fetch[0]."' class='btn btn-primary'>Deletar</a></td>";    
    					} else {
    					    echo "<td align='center' colspan='3'><a href='formatualizapet.php?idanimal=".$fetch[0]."' class='btn btn-primary'>Atualizar</a>&nbsp;</td>";
    					}
    					echo "</tr>";
					}
			}
			echo "</tbody>
			      </table> <br>";
		}
		
		mysqli_close($connect);
?>
</center>
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
</html>
