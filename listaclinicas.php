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
    
    <title>GAAR - Lista de voluntários</title>
    
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
        <h3>LISTA DE CLÍNICAS</h3><br>
        <p><label> Aqui estão todas as clínicas e veterinários ativos no sistema e na ONG. </label></p>
       </center>
<?php 			
        $query = "SELECT * FROM CLINICAS ORDER BY CLINICA ASC";
		$select = mysqli_query($connect,$query);
		$reccount = mysqli_num_rows($select);

		if ($reccount == 0) {
			echo "<center>Nenhuma clínica encontrada <br></center>";
		}else{ 
		    echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>ID</th>";
        	echo "<th scope='col'>Veterinário</th>";
        	echo "<th scope='col'>Castração</th>";
        	echo "<th scope='col'>Cidade</th>";
        	echo "<th scope='col'>Telefone</th>";
        	echo "</thead>";
        	echo "<tbody>";
			while ($fetch = mysqli_fetch_row($select)) {
			        $idclinica = $fetch[0];	
			        $nomevet = $fetch[1];	
			        $cidade = $fetch[6];	
					$telefone = $fetch[7];
					$procedimento = $fetch[41];
					echo "<tr>";
					echo "<td>".$idclinica."</td>";
					echo "<td>".$nomevet."</td>";
					echo "<td>".$procedimento."</td>";
					echo "<td>".$cidade."</td>";
					echo "<td>".$telefone."</td>";
					echo "</tr>";
			}
			echo "</tbody>
			      </table> <br>";
		}
		
		if ($area=="diretoria") {
		    $query2 = "SELECT * FROM CLINICAS WHERE VALOR_GATO_PROT <> '0' OR VALOR_GATA_PROT <>'0' ORDER BY CLINICA ASC";
    		$select2 = mysqli_query($connect,$query2);
    		$reccount = mysqli_num_rows($select2);
    		
    		echo "<center><h2>VALORES</h2>";
    		
    	    echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>Veterinário</th>";
        	echo "<th scope='col'>Valor gato protetor</th>";
        	echo "<th scope='col'>Valor gata protetor</th>";
        	echo "<th scope='col'>Valor cachorro protetor</th>";
        	echo "<th scope='col'>Valor cadela protetor</th>";
        	echo "</thead>";
        	echo "<tbody>";
            	
    		while ($fetch2 = mysqli_fetch_row($select2)) {
    		    $idclinica = $fetch2[0];	
    			$nomevet = $fetch2[1];
    		    $valorgato_prot = $fetch2[42];
                $valorgata_prot = $fetch2[43];
                $valorcao_prot = $fetch2[44];
                $valorcadela_prot = $fetch2[45];
                echo "<tr>";
    					echo "<td>".$nomevet."</td>";
    					echo "<td>".$valorgato_prot."</td>";
    					echo "<td>".$valorgata_prot."</td>";
    					echo "<td>".$valorcao_prot."</td>";
    					echo "<td>".$valorcadela_prot."</td>";
    					echo "</tr>";
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

