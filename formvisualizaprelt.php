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
    
    <title>GAAR - Área do voluntário</title>
    
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
        <div id="divpretermos" class="d-block">
                    	<center>
                               <br><h4>Candidatos a lar temporário</h4><br>
                               <p> Serão exibidos os últimos 50 cadastros.</p>
                    	<?

                    	    $query = "SELECT * FROM FORM_VOLUNTARIO WHERE COMO_AJUDAR LIKE '%Lar%' AND STATUS_APROV <>'Reprovado' ORDER BY ID DESC LIMIT 50";
                    		$result = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($result);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Nome</th>";
                            	echo "<th scope='col'>Endereço</th>";
                            	echo "<th scope='col'>Cidade</th>";
                            	/*echo "<th scope='col'>Celular</th>";
                            	echo "<th scope='col'>E-mail</th>";*/
                            	echo "<th scope='col'>Como ajudar</th>";
                            	echo "<th scope='col'>Cadastro em</th>";
                            	echo "<th scope='col'>&nbsp;</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $id = $fetch[0];
                    	            $nome = $fetch[1];
                    				$endereco = $fetch[21];
                    				$cidade = $fetch[2];
                    				$celular = $fetch[4];
                    				$email = $fetch[5];
                    				$comoajudar = $fetch[6];
                    				$data_reg =  $fetch[23];
                    				
                    				$ano_data_reg = substr($data_reg,0,4);
                            	    $mes_data_reg = substr($data_reg,5,2);
                            	    $dia_data_reg = substr($data_reg,8,2);
                            	    
                            			echo "<tr>";
                            			echo "<td>".$nome."</td>";
                    					echo "<td>".$endereco."</td>";
                    					echo "<td>".$cidade."</td>";
                    					/*echo "<td>".$celular."</td>";
                    					echo "<td>".$email."</td>";*/
                    					echo "<td>".$comoajudar."</td>";
                    					echo "<td>".$dia_data_reg."/".$mes_data_reg."/".$ano_data_reg."</td>";
                    					echo "<td><a href='visualizaprelt.php?id=".$fetch[0]."' class='btn btn-primary'>Visualizar</a>&nbsp;</td>";
                    				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum candidato encontrado</p><br>";
                    		}
                    	?>
                    	</center>
        </div>
    <br /><br />
    </div>
</main>
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
</html>