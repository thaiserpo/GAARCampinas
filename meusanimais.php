<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT * FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[5];
				$subarea = $fetcharea[6];
				$resp = $fetcharea[2];
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
    
    <title>GAAR - Meus animais</title>
    
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
			  
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
        <h3><center>MEUS ANIMAIS</center></h3>
<?php 			

		$queryresp = "SELECT * FROM ANIMAL WHERE RESPONSAVEL ='$resp' ORDER BY NOME_ANIMAL ASC";
		$selectresp = mysqli_query($connect,$queryresp);
		$reccount = mysqli_num_rows($selectresp);
		
		if ($reccount == 0) {
			echo "<table class='table'>";
			echo "<tr>";
			echo "<td align='center'>Nenhum animal encontrado</td>";
			echo "<td align='center'><i>Os dados foram consultados da tabela de cadastro de animais.</i></td>";
            echo "<td align='center'><i>Para cadastrá-lo, por favor acesse <a href='formcadastropet.php'>aqui</a></i></p></td>";
			echo "</tr>";
			echo "</table>";
			echo "<a href='formpesquisapetinterna.php' class='btn btn-primary'><font face='Montserrat, Verdana, Arial, Helvetica, sans-serif'>Voltar</font></a></center>	";
		}else{ 
			echo "<p><center>Caso o animal não esteja na lista, cadastre-o <a href='formcadastropet.php'>aqui</a></center><br></p>";
			echo "<form id='form' name='meusanimais' action='atualizapet.php' method='GET' target='_blank'>";
			echo "<center><table class='table'>";
			while ($fetchresp = mysqli_fetch_row($selectresp)) {
			        $idanimal = $fetchresp[0];
                	$nomeanimal = $fetchresp[1];
                	$especie = $fetchresp[2];
                	$sexo = $fetchresp[4];
                	$status = $fetchresp[10];
                	$lt = $fetchresp[11];
                	$foto = $fetchresp[16];
        		    echo "<tbody>";
					echo "<tr>";
					if ($foto ==''){
					    echo "<td align='center' valign='middle' rowspan='5'>SEM FOTO</td>";
					}else{
					    echo "<td align='center' valign='middle' rowspan='5'><img src='/pets/".$foto."' valign='top' align='center' width='200' height='200'/></td>";   
					}
        			echo "<td align='left' colspan='1'><b>Nome do animal:</b></td>";
					echo "<td align='left' colspan='1'>".$nomeanimal."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' colspan='1'><b>Espécie:</b></td>";
					echo "<td align='left' colspan='1'>".$especie."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' colspan='1'><b>Sexo: </b></td>";
					echo "<td align='left' colspan='1'>".$sexo."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' colspan='1'><b>Lar temporário de:</b></td>";
					echo "<td align='left' colspan='1'>".$lt."</td>";
					echo "</tr>";
                    echo "<tr>";
        			echo "<td align='left' colspan='1'><b>Status:</b></td>";
					echo "<td align='left' colspan='2'>".$status."</td>";
					echo "</tr>";
					echo "<td align='right' colspan='1'><a href='formatualizapet.php?idanimal=".$fetchresp[0]."' class='btn btn-primary'>Atualizar</a></td>";
					echo "<td align='right' colspan='1'><a href='deletapet.php?idanimal=".$fetchresp[0]."' class='btn btn-primary'>Deletar</a></td>";
					echo "</tr>";
					echo "</tbody>";
					
			}   
			echo "</table><br>";
			echo "</form>";
			        
		echo "</center>";
		echo "<center>".$reccount." animais encontrados <br></center>";
		}
		
		mysqli_close($connect);
?>
    </div>
</main>
<footer>
   <center> GAAR - GRUPO DE APOIO AO ANIMAL DE RUA</center>
</footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>

