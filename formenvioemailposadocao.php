<?php

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$id = $_GET['idtermo'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);

		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
		
		$query = "SELECT * FROM TERMO_ADOCAO where ID='$id'";
		$select = mysqli_query($connect,$query);
        $fetch = mysqli_fetch_row($select);
		
		$adotante = $fetch[1];
		$celular = $fetch[10];
		$email = $fetch[11];
		$nomeanimal = $fetch[15];
		$especie = $fetch[16];
		$idade = $fetch[17];
		$sexo = $fetch[18];
		$cor = $fetch[19];
		$porte = $fetch[20];
		$castrado = $fetch[21];
		$dtcastracao = $fetch[22];
		$vermifug = $fetch[23];
		$vacinado = $fetch[24];
		$doses = $fetch[25];
		$possuianimal = $fetch[26];
		$sesimcastrados = $fetch[27];
		$teldoador = $fetch[28];
		$emaildoador = $fetch[29];
		$lt = $fetch[30];
		$termopor = $fetch[31];
		$dtadocao = $fetch[32];
		$localadocao = $fetch[33];
		$dtposadocao = $fetch[34];
		$posadocaopor = $fetch[35];
		$obs = $fetch[36];
		$usuario = $_SESSION['login'];

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
    
    <title>GAAR - Pós adoção</title>
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
           <h3>PÓS ADOÇÃO DO ANIMAL </h3><br>
        <p><label>Entre em contato com o adotante para saber como está o animal :) <br>Utilize o campo abaixo para digitar sua mensagem e enviar via e-mail, ou se preferir, envie um WhatsApp.</label></p>
       </center>
	<form method="POST" name="form" action="envioemailposadocao.php">
	    <div class="form-group row">
                  <label class="col-sm-2 col-form-label">ID do termo: </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-7 col-form-label"><? echo $id ?></label>
                  </div>
         </div>
	<div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome do adotante: </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-7 col-form-label"><? echo $adotante ?></label>
                  </div>
    </div>
    <div class="form-group row">
                  <label class="col-sm-2 col-form-label">E-mail do adotante: </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-7 col-form-label"><? echo $email ?></label>
                  </div>
    </div>
    <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome do animal: </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-7 col-form-label"><? echo $nomeanimal ?></label>
                  </div>
    </div>
	<div class="form-group row">
                  <label class="col-sm-2 col-form-label">Mensagem: </label> 
                  <div class="col-sm-10">
                    <textarea class="form-control" name="mensagem" cols="30" rows="10" id="mensagem">Olá <? echo $adotante ?>, <br><br><? echo $mensagem ?></textarea>
                  </div>
    </div>
	<center><a href="javascriot:form.submit()" class="btn btn-primary">Enviar</a></center>
	</form>
	<br>
   </div>
   <? mysqli_close($connect); ?>
   <center><a href="pesquisatermo.php" class="btn btn-primary"> Nova pesquisa</a></center> <br>
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