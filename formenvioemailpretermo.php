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
		$mes_atu = date("m");
		$dia_atu = date("d");
		
        $id = $_GET['idpretermo'];
        $queryform = "SELECT * FROM FORM_PRE_ADOCAO where ID='$id'";
		$selectform = mysqli_query($connect,$queryform);
        $fetchform = mysqli_fetch_row($selectform);
		
		$emailadotante = $fetchform[3];
		$nomeadotante = $fetchform[1];
		$nomeanimal = $fetchform[11];
		$celular = $fetchform[6];
		
		$queryvol = "SELECT NOME,EMAIL FROM VOLUNTARIOS WHERE USUARIO = '$login'";
		$selectvol = mysqli_query($connect,$queryvol);
        $fetchvol = mysqli_fetch_row($selectvol);
		
		$nomevoluntario = $fetchvol[0];
		$emailvoluntario = $fetchvol[1];
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
    
    <title>GAAR - Responder pré termo de adoção</title>
    
    <script language="javascript" type="text/javascript">
        function limite_textarea(valor) {
            quant = 5000;
            total = valor.length;
            if(total <= quant) {
                resto = quant - total;
                document.getElementById('cont').innerHTML = resto;
            } else {
                document.getElementById('mensagem').value = valor.substr(0,quant);
            }
        }
    </script>
    
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
				  case 'anuncios':
				  	include_once("menu_terceiros.php") ;
					break;
				  
			  }
		
?>
<main role="main" class="container">
    <div class="starter-template">
	   <CENTER>
	        <h3>ENVIO DE RESPOSTA AO INTERESSADO PELO ANIMAL <? echo $nomeanimal ?></h3><br></center><br>
	<form method="POST" name="envioemailpretermo" action="envioemailpretermo.php">
        	<div class="form-group row">
                          <label class="col-sm-3 col-form-label"><strong>Nome do adotante: </strong></label> 
                          <div class="col-sm-8">
                            <label class="col-sm-8 col-form-label"><? echo $nomeadotante ?></label> 
                          </div>
        	              <label class="col-sm-3 col-form-label"><strong>E-mail:</strong></label> 
                          <div class="col-sm-8">
                            <label class="col-sm-8 col-form-label"><a href="mailto:<? echo $emailadotante ?>"><? echo $emailadotante ?></a></label> 
                          </div>
        	              <label class="col-sm-3 col-form-label"><strong>Celular:</strong></label> 
                          <div class="col-sm-8">
                            <label class="col-sm-8 col-form-label"><? echo $celular ?></label> 
                          </div>
        	              <label class="col-sm-3 col-form-label"><strong>Responder para:</strong></label> 
                          <div class="col-sm-8">
                            <label class="col-sm-8 col-form-label"><a href="mailto:pretermo@gaarcampinas.org">pretermo@gaarcampinas.org</a></label> 
                          </div>
        	</div>
        	<div class="form-group row">
                          <label class="col-sm-3 col-form-label"><strong>Mensagem: </strong></label> 
                          <div class="col-sm-8">
                            <textarea name="mensagem" cols="60" rows="10" id="mensagem" onkeyup="limite_textarea(this.value)"></textarea>
                            <small id="passwordHelpBlock" class="form-text text-muted"><span id="cont">5000</span> Restantes. Texto sem emojis.</small>
                          </div>
            </div>
            <div class="form-group row">
        	    <div class="col-sm-10">
                     <input type="checkbox" id="coordenadores" name="coordenadores" value="coordenadores" checked>
                    <label class="col-sm-10 col-form-label">Enviar cópia da resposta aos coordenadores</label> 
                </div>
            </div>
        	<input type="text" id="nomeanimal" name="nomeanimal" value="<? echo $nomeanimal ?>" hidden> <input type="text" id="emailadotante" name="emailadotante" value="<? echo $emailadotante ?>" hidden> <input type="text" id="emailvoluntario" name="emailvoluntario" value="<? echo $emailvoluntario ?>" hidden> <input type="text" id="nomeadotante" name="nomeadotante" value="<? echo $nomeadotante ?>" hidden>    
        	<center><a href="javascript:envioemailpretermo.submit()" class="btn btn-primary">Enviar e-mail</a></center>
	</form>
	<br>
    <form method="POST" name="enviowhatspretermo" action="enviowhatspretermo.php">
        <center><input name="whats" value="Enviar WhatsApp" type="button" onClick="location.href='https://api.whatsapp.com/send?phone=55<? echo $celular ?>'" class="btn btn-primary"></center>
        <?
        $queryupdate = "UPDATE FORM_PRE_ADOCAO SET OBS='Resposta enviada via WhatsApp por ".$nomevoluntario." em ".$dia_atu."/".$mes_atu."' WHERE ID='$id'";
		
		$update = mysqli_query($connect,$queryupdate);
		?>
    </form>
    <br>
<center><a id="myLink" title="Nova pesquisa" href="pesquisapretermo.php" onclick="MyFunction();return false;" class="btn btn-primary">Nova pesquisa</a></center>

   <? mysqli_close($connect); ?>
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