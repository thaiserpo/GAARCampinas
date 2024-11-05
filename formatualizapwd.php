<!doctype html>
<html lang="pt-br">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="../../../../favicon.ico">-->

    <title>GAAR - Área restrita dos voluntários</title>
	
    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Estilos customizados para esse template -->
    <link href="signin.css" rel="stylesheet">
    
    <script>
    function showPwd() {
          var x = document.getElementById("inputPassword");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
    }
    </script>
    
  </head>

  <body class="text-center">
   <main role="main" class="container">
    <div class="starter-template">
     <form class="form-signin" method="POST" action="atualizapwd.php">
      <img class="mb-4" src="logo_transparent.png" alt="" width="70" height="70">
      <div class="form-row  justify-content-center">
                        <div class="form-group col-md-3">
                            <input type="text" id="inputEmail" name="login" class="form-control" placeholder="Seu login" required autofocus>
                        </div>
      </div>
      <div class="form-row  justify-content-center">
                        <div class="form-group col-md-3">
                            <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Nova senha" required>
                        </div>
      </div>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" onclick="showPwd()"> Mostrar senha
        </label>
      </div>
      <button class="btn btn-primary" type="submit">Alterar</button>
      <p class="mt-5 mb-3 text-muted">&copy; Grupo de Apoio ao Animal de Rua</p>
    </form>
    </div>
    </main>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>