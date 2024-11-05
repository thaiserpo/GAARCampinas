<?php 

session_start();

include ("conexao.php"); 

$codprocedi = $_GET['cod'];

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
    
    <title>GAAR - Atualização de procedimentos</title>
    
    
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">
       <center>
        <img src='/area/imagens/logo_pequeno2.png' width='90' height='90'>
        <h4>ATUALIZAÇÃO DE PROCEDIMENTOS</h4><br>
       </center>
        <form action="atualizaprocediqrcode.php" method="POST" enctype="multipart/form-data" name="form">
            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <p><label> CÓDIGO <?echo $codprocedi?> </label>
                                    <input type="text" id="codprocedi" name="codprocedi" value="<? echo $codprocedi ?>" hidden></p>
                                </div>
            </div>
            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label>ID da clínica<font color="red">*</font>: </label> 
                                    <input name="idvet" type="text" id="idvet" maxlength="5" class="form-control" required>
                                </div>
            </div>
            <font color="red"><i>* Campos obrigatórios</i></font>
            <br>
            <center><a href="javascript:form.submit()" class="btn btn-primary">Autorizar</a></center>
            <br>
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