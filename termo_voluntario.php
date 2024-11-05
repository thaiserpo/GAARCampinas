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
				$nome = $fetcharea[2];
				$celular = $fetcharea[3];
				$email = $fetcharea[4];
				$area = $fetcharea[5];
				$cpfcnpj =  $fetcharea[9];
				$rg =  $fetcharea[11];
				$dtnasc =  $fetcharea[13];
				$nacionalidade =  $fetcharea[14];
				$estadocivil =  $fetcharea[15];
				$profissao =  $fetcharea[16];
				$cep =  $fetcharea[17];
				$endereco =  $fetcharea[18];
				$complemento =  $fetcharea[19];
				$numero =  $fetcharea[20];
				$bairro =  $fetcharea[21];
				$cidade =  $fetcharea[22];
				$estado =  $fetcharea[23];
		}
		
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta charset="gb18030">
    <!-- Meta tags Obrigat贸rias -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Termo de voluntariado</title>
    
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
        
    <div id="ds-clickwrap"></div>

    <script src="https://demo.docusign.net/clickapi/sdk/latest/docusign-click.js"></script>

    <script>docuSignClick.Clickwrap.render({
    environment: 'https://demo.docusign.net',
    accountId: '064d032c-067c-4adb-b690-210b1b547723',
    clickwrapId: 'b27ecabc-419f-4a78-8269-520af11ae9a2',
    clientUserId: <? echo "'".$nome." - CPF: ".$cpfcnpj." - RG: ".$rg." - Area escolhida: ".$area."'" ;?>
  }, '#ds-clickwrap');</script>
  
  
<?
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
