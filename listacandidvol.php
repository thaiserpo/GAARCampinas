<?php 		
		/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
$login = $_SESSION['login'];
$area_interesse = $_POST['area_interesse'];

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
			  

?>
<main role="main" class="container">
    <div class="starter-template">
    <center>
        <h3>LISTA DE CANDIDATOS À VOLUNTÁRIOS</h3><br>
        <p><label> Aqui estão todos os candidatos à voluntários cadastrados.</label></p>
       </center>
<?php 		

        if ($area_interesse == ''){
           $query = "SELECT * FROM FORM_VOLUNTARIO WHERE NOME <> '' AND STATUS_APROV <> 'Não' AND STATUS_APROV <>'Aprovado' ORDER BY ID DESC"; 
        } else {
            $query = "SELECT * FROM FORM_VOLUNTARIO WHERE COMO_AJUDAR = '$area_interesse' AND STATUS_APROV <> 'Não' AND STATUS_APROV <>'Aprovado' ORDER BY ID DESC";
        }

		$select = mysqli_query($connect,$query);
		$reccount = mysqli_num_rows($select);

		if ($reccount == 0) {
			echo "<center>Nenhum voluntário encontrado <br></center>";
		}else{ 
		    echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>Idade</th>";
        	echo "<th scope='col'>Telefone</th>";
        	echo "<th scope='col'>E-mail</th>";
        	echo "<th scope='col'>Área de interesse</th>";
        	echo "<th scope='col'>Data da inscrição</th>";
        	echo "<th scope='col' colspan='3'>Status</th>";
        	echo "</thead>";
        	echo "<tbody>";
			while ($fetch = mysqli_fetch_row($select)) {
			        $idcandidvol = $fetch[0];	
			        $nomecandidvol = $fetch[1];	
			        $telcandidvol = $fetch[4];	
			        $emailcandidvol = $fetch[5];	
					$areacandidvol = $fetch[6];
					$dtnasccandidvol = $fetch[3];
					$dtcandidvol = $fetch[23];
					
					$ano_dtnascvol = substr($dtnasccandidvol,0,4);
					
					$ano_atu = date("Y");
					
					$tmp = intval($ano_atu) - intval($ano_dtnascvol) ;
					
					if ($tmp == $ano_atu) {
					    $idade = "Não informada";
					} else {
					    $idade = $tmp." anos";
					}
					
					echo "<tr>";
					echo "<td>".$nomecandidvol."</td>";
					echo "<td>".$idade."</td>";
					echo "<td>".$telcandidvol."</td>";
					echo "<td>".$emailcandidvol."</td>";
					echo "<td>".$areacandidvol."</td>";
					echo "<td>".$dtcandidvol."</td>";
					echo "<td><a href='viewcandidvol.php?id=".$idcandidvol."'><button type='button' class='btn btn-primary' title='Visualizar'>
        					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                </svg>
                            </button></a></td>";
					echo "</tr>";
			}
			echo "</tbody>
			      </table> <br>";
		}
		
		mysqli_close($connect);
}
?>
        </center>
        <center><a href="formpesquisavol.php" class="btn btn-primary">Nova pesquisa</a></center>
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

