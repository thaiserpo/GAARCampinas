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
		
		$queryprocedi = "SELECT * FROM PEDIDO_CASTRACAO WHERE STATUS_PEDIDO ='0' AND CODIGO ='0' ORDER BY DATA_REG DESC LIMIT 100";
		$selectprocedi = mysqli_query($connect,$queryprocedi);
		$reccount = mysqli_num_rows($selectprocedi);

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
    
    <title>GAAR - Pesquisa de solicitações</title>
    
</head>
<body> 
<?php 
		
		switch ($area) {
				  case 'operacional':
				    if ($subarea == 'lt'){
				        include_once("menu_lt.php") ;
				    }  else {
				        include_once("menu_operacional.php") ;    
				    }
				  	
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

?>
<main role="main" class="container">
    <div class="starter-template">
        <br>
     	<form action="pesquisaprocedi.php" id="pesquisaprocedi" name="pesquisaprocedi" method="POST" >
            <table class='table'>
            <thead class='thead-light'>
						  <tr>
						    <th scope='col'>ID</th>
							<th scope='col'>Animal</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Protetor</th>
							<th scope='col'>Clínica</th>
							<th scope='col'>Solicitado em</th>
							<th scope='col' colspan='2'>&nbsp;</th>
					</tr>
				</thead> 
				<tbody>
<?
			while ($fetchprocedi = mysqli_fetch_row($selectprocedi)) {
			        $id = $fetchprocedi[0];
    				$nomedoanimal = $fetchprocedi[1];
                    $dtnascanimal = $fetchprocedi[5];
                    $especie = $fetchprocedi[2];
                    $sexo = $fetchprocedi[3];
                    $porte = $fetchprocedi[4];
                    $nomedotutor = $fetchprocedi[6];
                    $teldotutor = $fetchprocedi[7];
                    $emaildotuto = $fetchprocedi[8];
                    $valorajuda = $fetchprocedi[9];
                    $obs = $fetchprocedi[10];
                    $volgaar = $fetchprocedi[11];
                    $datareg = $fetchprocedi[12];
                    $clinica = $fetchprocedi[16];
					
					$ano_nasc = substr($dtnascanimal,0,4);
        		    $mes_nasc = substr($dtnascanimal,5,2);
        		    $dia_nasc = substr($dtnascanimal,8,2);
        		    
        		    $ano_dtreg = substr($datareg,0,4);
        		    $mes_dtreg = substr($datareg,5,2);
        		    $dia_dtreg = substr($datareg,8,2);
        		    
        		    $queryclinica = "SELECT CLINICA FROM CLINICAS WHERE ID='$clinica'";
                    $selectclinica = mysqli_query($connect,$queryclinica);
                    $reccountclinica = mysqli_num_rows($selectclinica);
                    $rc = mysqli_fetch_row($selectclinica);
                    $nome_clinica = $rc[0]; 
		   
    		        echo "<tr>";
    				echo "<td>".$id."</td>";
            		//echo "<td>".$dia_nasc ."/".$mes_nasc ."/".$ano_nasc."</td>";
    				echo "<td>".$nomedoanimal."</td>";
    				echo "<td>".$especie."</td>";
    				echo "<td>".$nomedotutor."</td>";
    				echo "<td>".$nome_clinica."</td>";
    				echo "<td>".$dia_dtreg ."/".$mes_dtreg ."/".$ano_dtreg."</td>";
    				echo "<td><a href='formautorizaprocedi.php?id=".$id."&action=a'>Autorizar</a></td>";
    				echo "<td><a href='deletapedidocastra.php?id=".$id."'>Remover</a></td>";
    				echo "</tr>";
			}
             echo "</tbody>
			    </table><br>
		</form> <br>
		<p><center>".$reccount." pedidos encontrados <br></center></p>
		</center>";
}
mysqli_close($connect);
?>
      </form>
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