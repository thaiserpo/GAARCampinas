<?php 

session_start();

include ("conexao.php"); 

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
    
    <title>GAAR - Pedido de castração</title>
    
    <script type="text/javascript">

        function OnChangeRadio1 (radio) {
                    document.getElementById('nomevolgaar').className  = "d-block";
            }
            
        function OnChangeRadio2 (radio) {
                    document.getElementById('nomevolgaar').className  = "d-none";
            }
            
        function OnChangeRadio3 (radio) {
                    document.getElementById('Gato').checked  = false;
            }
            
        function OnChangeRadio4 (radio) {
                    document.getElementById('Gato').checked  = true;
            }
        

    </script>
    
</head>
<body> 

<main role="main" class="container">
    <div class="starter-template">
       <form action="cadastroemailmarketing.php" method="POST" enctype="multipart/form-data" name="form">
        <div class="form-row">
                        <div class="form-group col-md-10">
                            <label>Cadastre seu e-mail para receber o Estatuto dos Animais de Campinas: </label>
                        </div>
                        <div class="form-group col-md-10">
                            <input name="getmail" type="email" id="getmail" maxlength="100" class="form-control" required>
                            <a href="javascript:form.submit()" class="btn btn-primary">Cadastrar</a>
                        </div>
        </div>
        <div class="form-row">
        </div>
       </form>
            <br>
    </div>
</main>
<br><br>
<footer class="footer fixed-bottom bg-light d-none">
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