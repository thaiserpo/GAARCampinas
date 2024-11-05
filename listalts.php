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
        <h3>LISTA DE LARES TEMPORÁRIOS</h3><br>
        <p><label> Caso algum não esteja aparecendo, cadastre <a href="formcadastrolt.php">aqui</a>. Para enviar um WhatsApp, clique no número de telefone</label></p>
       </center>
<?php 			
            $query = "SELECT * FROM LT ORDER BY LAR_TEMPORARIO ASC";
    		$select = mysqli_query($connect,$query);
    		$reccount = mysqli_num_rows($select);

		if ($reccount == 0) {
			echo "<center>Nenhum lar temporário encontrado <br></center>";
		}else{ 
		    echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>Lar temporário</th>";
        	echo "<th scope='col'>Telefone</th>";
        	echo "<th scope='col'>E-mail</th>";
        	echo "<th scope='col'>Responsável</th>";
        	echo "</thead>";
        	echo "<tbody>";
			while ($fetch = mysqli_fetch_row($select)) {
			        $lt = $fetch[1];	
					$cel = $fetch[6];
					$email = $fetch[7];
					$resp = $fetch[12];
					echo "<tr>";
					echo "<td>".$lt."</td>";
					echo "<td>".$cel."</td>";
					echo "<td>".$email."</td>";
					echo "<td>".$resp."</td>";
					echo "<td><input name='whats' value='Enviar WhatsApp' type='button' onClick='location.href='https://api.whatsapp.com/send?phone=55".$cel."'' class='btn btn-primary'></td>";
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
