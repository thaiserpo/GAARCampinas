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
    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Cadastro para anúncios</title>
	<script type="text/javascript">
	function cadastro(){
		document.form.action = 'cadastro.php'; 
		document.form.submit();
	}
	function atualiza(){
		document.form.action = 'atualiza.php'; 
		document.form.submit();
	}
	function deleta(){
		document.form.action = 'deleta.php'; 
		document.form.submit();
	}
	function seleciona(){
		document.form.action = 'seleciona.php'; 
		document.form.submit();
	}
	</script>
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">
        <center><img src="logo pequeno.png"><br><br>
	        <h3>SISTEMA INTERNO DO GAAR</h3>

      <br>
         <p>Seja bem vindo(a) ao GAAR! <br>Faça seu cadastro e tenha acesso ao nosso sistema interno. Lá é possível gerenciar seus anúncios.</p><br>
                </CENTER>
    </div>
    <br>
    <form method="POST" name="form" action=login.html>
	    <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Login: </label> 
                  <div class="col-sm-4">
                    <input name="login" type="text" id="login" size="30" maxlength="30" class="form-control"> 
                    <small id="passwordHelpBlock" class="form-text text-muted">será o seu login de acesso ao sistema</small>
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Senha: </label> 
                  <div class="col-sm-4">
                    <input name="senha" type="password" id="senha" size="30" maxlength="32" class="form-control">
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nome completo: </label> 
                  <div class="col-sm-4">
                    <input name="nome" type="text" id="nome" size="50" maxlength="50" class="form-control">
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Celular: </label> 
                  <div class="col-sm-4">
                    <input type="text" name="celular" id="celular" size="20" maxlength="15" class="form-control">
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-3 col-form-label">E-mail: </label> 
                  <div class="col-sm-4">
                    <input name="email" type="text" id="email" size="50" maxlength="100" class="form-control">
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Área principal de atuação: </label> 
                  <div class="col-sm-4">
            		<select name="area" class="form-control" >
            			<option value="anuncios">Anúncios</option>
            		</select>
            	  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Sub área de atuação: </label> 
                  <div class="col-sm-4">
            			<select name="subarea" class="form-control">
                			<option value="anuncios">Anúncios</option>
                		</select>
            	  </div>
        </div>
        <div class="form-group row">
                  <div class="col-sm-4">
            	    <center><input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar" onClick="cadastro();" class="btn btn-primary"> &nbsp;</center>
		            <!--<input type="submit" value="Atualizar" id="atualizar" name="atualizar" onClick="atualiza();">-->
            	  </div>
        </div>
        </form>
        <br>
</main>
<footer class="footer">
      <div class="container">
        <span class="text-muted"><center>GAAR - GRUPO DE APOIO AO ANIMAL DE RUA</center></span>
      </div>
</footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>