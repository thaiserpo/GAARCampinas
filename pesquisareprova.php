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
    
    <title>GAAR - Pesquisa interna de reprovados</title>
    
    <script type='text/javascript'>
     
    </script>
    
</head>
<body onselectstart="return false" oncontextmenu="return false"> 
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
				  case 'ong':
				  	include_once("menu_ong.php") ;
					break;
				  
			  }
			  

			$query = "SELECT * FROM REPROVADOS ORDER BY ID DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);		
		
?>
<main role="main" class="container">
    <div class="starter-template d-print-none">
        <br>
        <center><h3>LISTA DE REPROVADOS</h3></center>
        <p><center>É proibida a reprodução, parcial ou total, dos dados pessoais aqui apresentados sem prévia autorização. Todas as informações estão protegidas pela Lei Geral de Proteção de Dados Pessoais (LGPD) - LEI Nº 13.709, DE 14 DE AGOSTO DE 2018. Conheça a lei na íntegra clicando <a href="http://www.planalto.gov.br/ccivil_03/_Ato2015-2018/2018/Lei/L13709.htm" target="_blank">aqui</a>. </center> </p>
        
<?
        		
        		if ($reccount == 0) {
        			echo "<center>Nenhum cadastro encontrado <br><br>
        			        <a href='formcadastroreprova.php' class='btn btn-primary'>Cadastrar reprovado</a><br><br>"; 
        		}else{ 
        		    		
        			while ($fetch = mysqli_fetch_row($select)) {
        					$nomeadotante = $fetch[1];
        					$cpf = $fetch[3];
        					$cidade = $fetch[8];
        					$estado = $fetch[9];
        					$reprovadopor = $fetch[18];
        					$nomedoanimal = $fetch[19];
        					$especie = $fetch[20];
        					$estado = $fetch[9];
        					$obs = $fetch[17];
        					$id_pretermo = $fetch[21];
        					
        					echo "<div>";
        					echo "<form id='form' name='visualizareprova' action='formverreprova.php' method='GET' target='_blank'>";
        					echo "<table class='table'>";
                		    echo "<tbody>";
        					echo "<tr>";
                			echo "<td align='left' colspan='2' scope='row'><b>Nome</b></td>";
        					echo "<td align='left' colspan='2'>: ".$nomeadotante."</td>";
        					echo "</tr>";
        					echo "<tr>";
                			echo "<td align='left' colspan='2' scope='row'><b>Animal interessado/adotado</b></td>";
        					echo "<td align='left' colspan='2'>: ".$nomedoanimal."</td>";
        					echo "</tr>";
        					echo "<tr>";
                			echo "<td align='left' colspan='2' scope='row'><b>Espécie</b></td>";
        					echo "<td align='left' colspan='2'>: ".$especie."</td>";
        					echo "</tr>";
        					echo "<tr>";
                			echo "<td align='left' colspan='2' scope='row'><b>Reprovado por</b></td>";
        					echo "<td align='left' colspan='2'>: ".$reprovadopor."</td>";
        					echo "</tr>";
        					echo "<tr>";
                			echo "<td align='left' colspan='2' scope='row'><b>Cidade </b></td>";
        					echo "<td align='left' colspan='2'>: ".$cidade."</td>";
        					echo "</tr>";
        					echo "<tr>";
                			echo "<td align='left' colspan='2' scope='row'><b>Observações:</b></td>";
        					echo "<td align='left' colspan='2'>: ".$obs."</td>";
        					echo "</tr>";
        					echo "<tr>";
                			echo "<td align='left' colspan='4' scope='row'><a href='visualizapretermo.php?idpretermo=".$id_pretermo."' target='_blank' class='btn btn-primary'>Visualizar formulário</a>&nbsp;</td>";
        					echo "</tr>";
        					echo "</tbody><br>";
        					echo "</table>";
        		
        			       
                    echo "<input class='form-check-input' type='radio' name='idadotante' value='".$idadotante."' hidden>";
                    echo "</form>";
                    echo "</div>";
        			}       
        			
        		}
        		
        		mysqli_close($connect);
        		
        		echo "<center><a href=\"javascript:window.history.go(-1)\" class=\"links\">Voltar</a></p></center><br>";
        	
	}
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
</html>