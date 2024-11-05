<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

/*
if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
    $queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
		
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
}*/
			  
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
    
    <title>GAAR - Cadastro de fornecedores</title>
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
	        <h3>CADASTRO DE FORNECEDORES</h3>
        </CENTER>
      <br>
         <p><center>Seja bem vindo(a) ao GAAR! <br>Faça seu cadastro e tenha acesso ao nosso sistema interno.</center></p>
    <br>
    <form method="POST" name="form" action=login.html>
	    <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Login: </label> 
                  <div class="col-sm-4">
                    <input name="login" type="text" id="login" size="30" maxlength="30" class="form-control"> 
                    <small id="passwordHelpBlock" class="form-text text-muted">será o seu login de acesso ao sistema</small>
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Senha: </label> 
                  <div class="col-sm-4">
                    <input name="senha" type="password" id="senha" size="30" maxlength="32" class="form-control">
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome: </label> 
                  <div class="col-sm-4">
                    <input name="nome" type="text" id="nome" size="100" maxlength="100" class="form-control">
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Celular: </label> 
                  <div class="col-sm-4">
                    <input type="text" name="celular" id="celular" size="20" maxlength="15" class="form-control">
                    <small id="passwordHelpBlock" class="form-text text-muted">DDD+Telefone (apenas números)</small>
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">E-mail: </label> 
                  <div class="col-sm-4">
                    <input name="email" type="text" id="email" size="50" maxlength="100" class="form-control">
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Área principal de atuação: </label> 
                  <div class="col-sm-4">
            		<select name="area" class="form-control" >
            			<option name="op2" value="fornecedor" selected>Fornecedor</option>
            		</select>
            	  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Sub área de atuação: </label> 
                  <div class="col-sm-4">
            			<select name="subarea" class="form-control">
                			<option name="op1" value="canecas" selected>Canecas</option>
                		</select>
            	  </div>
        </div>
        <br>
        <center>
	        <h3>DADOS BANCÁRIOS PARA PAGAMENTO</h3>
        </CENTER>
      <br>
        <div class="form-row">
                <div class="form-group col-md-3">
                            <label>Banco: </label> <br>
                                <select name="bancofornec" id="bancofornec" class="form-control" id="inlineFormCustomSelect">
                                  <option value="001 – Banco do Brasil">001 – Banco do Brasil </option>
                                  <option value="341 – Banco Itaú">341 – Banco Itaú </option>
                                  <option value="033 – Banco Santander (Brasil)">033 – Banco Santander (Brasil) </option>
                                  <option value="652 – Itaú Unibanco Holding">652 – Itaú Unibanco Holding </option>
                                  <option value="237 – Banco Bradesco">237 – Banco Bradesco </option>
                                  <option value="745 – Banco Citibank">745 – Banco Citibank </option>
                                  <option value="399 – HSBC Bank Brasil">399 – HSBC Bank Brasil </option>
                                  <option value="389 – Banco Mercantil do Brasil">389 – Banco Mercantil do Brasil </option>
                                  <option value="453 – Banco Rural">453 – Banco Rural </option>
                                  <option value="422 – Banco Safra">422 – Banco Safra </option>
                                  <option value="633 – Banco Rendimento">633 – Banco Rendimento </option>
                                  <option value="318 – Banco BMG">318 – Banco BMG</option>
                                  <option value="260 – Nubank">260 - Nubank</option>
                                  <option value="077 – Banco Inter">077 – Banco Inter</option>
                                  <option value="104 – Caixa Econômica Federal">104 – Caixa Econômica Federal</option>
                                </select>
                </div>
        </div>
        <div class="form-row">
                <div class="form-group col-md-3">
                            <label>Agência: </label> 
                            <input type="text" id="agfornec" name="agfornec" maxlength="10" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                            <label>Conta: </label> 
                            <input type="text" id="contafornec" name="contafornec" maxlength="15" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                            <label>DV: </label> 
                            <input type="text" id="dvfornec" name="dvfornec" maxlength="3" class="form-control" required>
                </div>
        </div>
        <div class="form-row">
                <div class="form-group col-md-3">
                            <label>CPF/CNPJ: </label> 
                            <input type="text" id="cpffornec" name="cpffornec" maxlength="20" class="form-control" required>
                </div>
        </div>
        <div class="form-row">
                <div class="form-group col-md-6">
                            <label>Qual melhor dia do mês pra pagamento?<font color="red">*</font> <br>
                            <select name="diapgtofornec" id="diapgtofornec" class="form-control">
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
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
<?
		
    		mysqli_close($connect);
?>
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