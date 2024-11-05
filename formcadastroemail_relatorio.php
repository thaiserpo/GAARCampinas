<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

$ano_atu = date('Y');
$mes_atu = date('m');
$mes_feira = date('m',strtotime('-2 months'));


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
    
	<link href="calendar.css" rel="stylesheet" type="text/css">
	
    <!--- BOOTSTRAP AND AJAX --->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--- BOOTSTRAP AND AJAX --->
    
    <title>GAAR - Cadastro de e-mail marketing </title>
    <script type="text/javascript">
                            
                           $(document).ready(function(){
                             $("#btnAdicionarEmail").click(function(){
                                
                            	$.ajax({
                                	url: "cadastroemailrelatorio.php",
                             		type: "POST",
                             		data: {
                             		    nome: document.getElementById("nome").value,
                             		    emailmarketing: document.getElementById("emailmarketing").value,
                             		    relatorios: document.getElementById("relatorios").value,
                             		    marketing: document.getElementById("marketing").value,
                             		},
                            		success: function(response){
                            		    document.getElementById('AlertSuccess_cadastro').innerHTML= "E-mail cadastrado com sucesso";
                            		    document.getElementById('lblAlertSuccess_cadastro').className = "alert alert-success d-block";
                            		    document.getElementById("nome").value = "";
                            		    document.getElementById("emailmarketing").value = "";
                                    },
                                    error: function(response){
                                        document.getElementById('AlertDanger_cadastro').innerHTML= "E-mail não foi cadastrado. Por favor tente novamente"; 
                                        document.getElementById('lblAlertDanger_cadastro').className = "alert alert-danger d-block";
                                    }
                            	});
                            });
                             
                          });
                          
                          
    </script>
    <!--- GOOGLE ADSENSE --->
     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
     <!--- GOOGLE ADSENSE --->
    
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">
    <center>
        <h3>E-MAIL MARKETING </h3><br>
        <p><label> Cadastre seu e-mail abaixo para receber nossas comunicações </label></p>
       </center>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome: <strong><font color="red">*</font></strong></label> 
                  <div class="col-sm-5">
                        <input name="nome" type="text" id="nome" maxlength="150" class="form-control" required>
                        <small id="passwordHelpBlock" class="form-text text-muted"></small>
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">E-mail: <strong><font color="red">*</font></strong></label> 
                  <div class="col-sm-5">
                        <input name="emailmarketing" type="text" id="emailmarketing" maxlength="250" class="form-control" required>
                        <small id="passwordHelpBlock" class="form-text text-muted"></small>
                  </div>
        </div>
        <div class="form-group row">
                  <div class="col-sm-5">
                      <input type="checkbox" id="relatorios" name="relatorios" value="Sim" checked><label for="relatorios">&nbsp;Quero receber os relatórios mensais</label>
                  </div>
        </div>
        <div class="form-group row">
                  <div class="col-sm-5">
                      <input type="checkbox" id="marketing" name="marketing" value="Sim" checked><label for="marketing">&nbsp;Quero receber as comunicações</label>
                  </div>
        </div>
        <div class="form-row">
                <button type="button" style="margin-left:2%;margin-right:auto;display:block;" class="btn btn-primary d-block" id="btnAdicionarEmail"> Cadastrar </button>
        </div>
        <div class="alert alert-success d-none" role="alert" id="lblAlertSuccess_cadastro">
                 <label class="col-sm-4 col-form-label" id="AlertSuccess_cadastro"></label> 
        </div>
        <div class="alert alert-danger d-none" role="alert" id="lblAlertDanger_cadastro">
          <danger><label class="col-sm-4 col-form-label" id="AlertDanger_cadastro"></danger> 
        </div>
   <br>
</main>
<br><br>
<footer class="footer fixed-bottom bg-light">
      <div class="container">
        <p class="text-center">GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
      </div>
    </footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>
