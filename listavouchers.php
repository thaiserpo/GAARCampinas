<?php 		
		/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
$login = $_SESSION['login'];
$ano_atu = date("Y");
$mes_atu = date("m");
$data_atu = date("Y-m-d"); 

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
    
    <title>GAAR - Lista de vouchers</title>
    
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
			  

?>
<main role="main" class="container">
    <div class="starter-template">
    <center>
        <h3>LISTA DE VOUCHERS DE CASTRAÇÃO</h3><br>
        <p><label> Serão exibidos os últimos vouchers ativos gerados pelo sistema.</label></p>
       </center>
<?php 		

        $query = "SELECT * FROM AGENDAMENTO WHERE DATA_AG>= '".$data_atu."' ORDER BY DATA_AG DESC LIMIT 50"; 
		$select = mysqli_query($connect,$query);
		$reccount = mysqli_num_rows($select);

		if ($reccount == 0) {
			echo "<center>Nenhum voucher encontrado <br></center>";
		}else{ 
		    echo "<table class='table'>";
		    echo "<thead class='thead-dark  th-header'>
				    <tr>";
			echo "<th scope='col' colspan='1'>CÓDIGO</th>";
			echo "<th scope='col' colspan='1'>PROTETOR</th>";
			echo "<th scope='col' colspan='1'>ANIMAL</th>";
			echo "<th scope='col' colspan='1'>ESPÉCIE</th>";
			echo "<th scope='col' colspan='1'>DATA DO PROCEDIMENTO</th>";
			echo "<th scope='col' colspan='1'>CLÍNICA</th>";
			echo "<th scope='col' colspan='1'>&nbsp</th>";
		    echo "</thead>";
        	echo "<tbody>";
			while ($fetch = mysqli_fetch_row($select)) {
			        $codigo = $fetch[0];	
			        $data_ag = $fetch[1];	
			        $nome_animal = $fetch[3];	
			        $especie = $fetch[4];	
					$respanimal = $fetch[9];
					$clinica = $fetch[19];
					
					$ano_ag = substr($data_ag,0,4);
            	    $mes_ag = substr($data_ag,5,2);
            	    $dia_ag = substr($data_ag,8,2);
					
					$queryvet = "SELECT * FROM CLINICAS WHERE ID='$clinica'";
                	$selectvet = mysqli_query($connect,$queryvet);
                	$rc = mysqli_fetch_row($selectvet);
                	$reccount = mysqli_num_rows($selectvet);
                    $nomevet = $rc[1];
                    
					echo "<tr>";
					echo "<td>".$codigo."</td>";
					echo "<td>".$respanimal."</td>";
					echo "<td>".$nome_animal."</td>";
					echo "<td>".$especie."</td>";
					echo "<td>".$dia_ag."/".$mes_ag."/".$ano_ag."</td>";
					echo "<td>".$nomevet."</td>";
					echo "<td><a href='https://gaarcampinas.org/area/vouchers/".$codigo.".pdf' target='_blank'>Abrir</a></td>";
					echo "</tr>";
			}
			echo "</tbody>
			      </table> <br>";
			      

		}
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

