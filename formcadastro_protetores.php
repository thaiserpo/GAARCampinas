<?php 

session_start();

include ("conexao.php");
require_once('recaptchalib.php');

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
    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Cadastro de protetores</title>
	<script type="text/javascript">
	function cadastro(){
		document.form.action = 'cadastro.php'; 
		document.form.submit();
	}
	function atualiza(){
		document.form.action = 'atualizadados.php'; 
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
<body onload="divs()"> 
<script type="text/javascript">
<?

	    if ($funcao == '') {
	        echo "
	                function divs () {
                                        document.getElementById('divcadastro').className  = 'd-block';
                                        document.getElementById('divlogin').className  = 'd-block';
                                        document.getElementById('divatualiza').className  = 'd-none';
                                        
                                }
	        
	        ";
	    } else {
	        echo "
	                function divs () {
                                        document.getElementById('divcadastro').className  = 'd-none';
                                        document.getElementById('divatualiza').className  = 'd-block';
                                        
                                }
	        
	        ";
	    }
?>
</script>
<main role="main" class="container">
    <div class="starter-template">
        <center><img src="logo pequeno.png"><br><br></center>
       <div id="divcadastro" class="form-row d-none">
            <center>
    	        <h3>CADASTRO DE PROTETORES INDEPENDENTES</h3>
            </CENTER>
            <p> Todos os campos são <strong><font color="red">obrigatórios</font></strong></p>
            <form method="POST" name="form" action="cadastro_protetores.php">
                <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nome completo: <font color="red">*</font></label> 
                          <div class="col-sm-4">
                            <input name="nome" type="text" id="nome" size="50" maxlength="100" class="form-control" value="<? echo $nome ?>">
                          </div>
                </div>
                <div class="form-row">
                    <label class="col-sm-3 col-form-label">Bairro: <font color="red">*</font></label>
                        <div class="col-sm-4">
                		          <input type="text"  name="bairro" id="bairro" maxlength="50" required class="form-control" value="<? echo $bairro?>" />
                		</div>
                </div>
                <br>
                <div class="form-row">
                    <label class="col-sm-3 col-form-label">Cidade: <font color="red">*</font></label>
                        <div class="col-sm-4">
                		          <select class="form-control"  name="cidade" id="cidade" required>
                		              <option value="">Selecione</option>
                		              <option value="Campinas">Campinas</option>
                		              <option value="Hortolândia">Hortolândia</option>
                		              <option value="Sumaré">Sumaré</option>
                		          </select>
                		          <!--<input type="text"  name="cidade" id="cidade" maxlength="25" required class="form-control" value="<? echo $cidade?>" />-->
                		</div>
                </div>
                    <br>
            	<div class="form-row">
                        <label class="col-sm-3 col-form-label">Celular: <font color="red">*</font></label>
                            <div class="col-sm-4">
                                <input type="text" name="celular" id="celular" size="20" maxlength="15" class="form-control" value="<? echo $celular ?>">
                                <small id="passwordHelpBlock" class="form-text text-muted">Apenas números, sem espaço e sem hífen</small>
                          </div>
            	</div>
            	<div class="form-row">
                        <label class="col-sm-3 col-form-label">E-mail: <font color="red">*</font></label>
                            <div class="col-sm-4">
                		          <input name="email" type="email" id="email" maxlength="100" class="form-control" required>
            		        </div>
            	</div>
            	<br>
            	<div class="form-row">
                        <label class="col-sm-3 col-form-label">Bairro de atuação:</label><font color="red">*</font></label>
                            <div class="col-sm-4">
                                <input type="text" name="areatuacao" id="areatuacao" size="100" maxlength="100" class="form-control" >
                          </div>
            	</div>
            	<br>
            	<div class="form-row">
                        <label class="col-sm-3 col-form-label">Link do perfil de uma rede social:</label> <font color="red">*</font></label>
                            <div class="col-sm-4">
                                <input type="text" name="linkredesocial" id="linkredesocial" size="300" maxlength="300" class="form-control" >
                          </div>
            	</div>
            	<br>
            	<div class="form-row d-none">
                    <div class="form-group col-md-6">
                        <p>Por gentileza, preencha o Captcha (letras maiúsculas e minúsculas):</p>
                        <img src="captcha.php?l=150&a=50&tf=20&ql=5">
                        <input type="text" name="palavra"  />
                    </div>
                    <i><center>Para garantir que os e-mails cheguem em sua caixa de entrada, sugerimos adicionar <strong>castracao@gaarcampinas.org</strong> à lista de remetentes confiáveis. Caso não adicione, verifique sua caixa de SPAM.</i><br>
                    
                </div>
                <a href="javascript:form.submit()" class="btn btn-primary">Cadastrar</a></center>
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