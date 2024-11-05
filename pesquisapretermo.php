<?php
session_start();

include ("conexao.php");

$login = $_SESSION['login'];
$idtermo = $_GET['idtermo'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,NOME,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$nome = $fetcharea[1];
				$email = $fetcharea[2];
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
    
    <title>GAAR - Pesquisa de pré termo</title>
    
    <!--- GOOGLE ADSENSE --->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
    <!--- GOOGLE ADSENSE --->
    
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
			  
		}
		
		
?>

<main role="main" class="container">
    <div class="starter-template">
            <br>
            <center><p>Para pesquisar um pré termo, escolha uma das opções abaixo ou, se deseja visualizar todos, deixe os campos em branco</p></center>
            <br>
     	<form id="form" name="pesquisapretermo" action="resultadopretermo.php" method="POST">
            <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome do animal: </label> 
                  <div class="col-sm-08">
 	                        <select class="form-control"  name="nomedoanimal" id="nomedoanimal" required>
                     		  
                     		  <?
                                        echo "<option value=''>Selecione</option>";                     		        
                         		        
                         		        if ($area =='anuncios'){
                         		            $query = "SELECT NOME_ANIMAL FROM ANIMAL WHERE OBS2 = '$email' AND DIVULGAR_COMO ='Terceiros' ORDER BY NOME_ANIMAL ASC";     
                         		        }   else {
                         		            $query = "SELECT NOME_ANIMAL FROM ANIMAL WHERE DIVULGAR_COMO ='GAAR' and ADOTADO = 'Disponível' AND FOTO <> '' ORDER BY NOME_ANIMAL ASC";    
                         		        }
                        		 		
                        				$select = mysqli_query($connect,$query);
                        				
                        				while ($fetch = mysqli_fetch_row($select)) {
                        					echo "<option value='".$fetch[0]."'>".$fetch[0]."</option>";
                        				}
                    		?>
                    	    </select>
                    	    <small id="passwordHelpBlock" class="form-text text-muted">Serão listados os nomes dos animais disponíveis</small>
                  </div>
                </div>
            <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome do interessado: </label> 
                  <div class="col-sm-02">
 	                        <select class="form-control"  name="nomedointeressado" id="nomedointeressado" required>
                     		  
                     		  <?
                                        echo "<option value=''>Selecione</option>";                     		        
                         		        
                         		        if ($area !='anuncios'){
                         		            $query = "SELECT NOME_COMPLETO FROM FORM_PRE_ADOCAO ORDER BY ID DESC LIMIT 50";     
                         		        } 
                        				$select = mysqli_query($connect,$query);
                        				
                        				while ($fetch = mysqli_fetch_row($select)) {
                        					echo "<option value='".$fetch[0]."'>".$fetch[0]."</option>";
                        				}
                    		?>
                    	    </select>
                    	    <small id="passwordHelpBlock" class="form-text text-muted">Serão listados os nomes dos últimos 50 interessados</small>
                  </div>
                  <label class="col-sm-2 col-form-label">Ou digite aqui: </label> 
                  <div class="col-sm-02 justify-content-sm-left">
 	                                <input type="text" name="nomedointeressado_livre" id="nomedointeressado_livre" class="form-control" required>
                  </div>
            </div>
            <div class="form-group row">
                  <label class="col-sm-2 col-form-label">E-mail do interessado: </label> 
                  <div class="col-sm-05 justify-content-sm-left">
 	                                <input type="text" name="emaildointeressado" id="emaildointeressado" class="form-control" required>
                  </div>
            </div>
          <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-3 pt-0">Espécie: </legend>
                      <div class="col-sm-05">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="especie" id="Canina" value="Canina"><label class="form-check-label" for="gridRadios1">Canina</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="especie" id="Felina" value="Felina"><label class="form-check-label" for="gridRadios1">Felina</label>
                        </div>
                      </div>
                    </div>
           </fieldset>
           <div class="row">
                      <legend class="col-form-label col-sm-3 pt-0">Pré termo respondido? </legend>
                      <div class="col-sm-05">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="respondido" id="respondido" value="Sim"><label class="form-check-label">Sim </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="respondido" id="respondido" value="Não"><label class="form-check-label">Não </label>
                        </div>
                       </div>
            </div>
            <br>
            <div class="row">
                      <legend class="col-form-label col-sm-3 pt-0">Reprovados? </legend>
                      <div class="col-sm-05">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="reprovado" id="reprovado" value="Sim"><label class="form-check-label">Sim </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="reprovado" id="reprovado" value="Não"><label class="form-check-label">Não </label>
                        </div>
                       </div>
            </div>
            <div class="row">
                <small id="passwordHelpBlock" class="form-text text-muted"> Para consultar a lista completa de reprovados, <a href='pesquisareprova.php' target='_blank'>acesse aqui</a></small><br>
            </div>
          <center><a href="javascript:pesquisapretermo.submit()" class="btn btn-primary">Pesquisar</a></center>
        <br><br>
      </form>
   </div>
   <? mysqli_close($connect); ?>
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