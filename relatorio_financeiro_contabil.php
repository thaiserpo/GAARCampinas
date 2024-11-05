<?php
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}
else{
	
		$queryarea = "SELECT AREA,SUBAREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
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
    
    <title>GAAR - Relatórios</title>

	<script type="text/javascript">		
		function mostrarelatorio(){
			document.getElementById("resultado").style.display = 'block';
			document.getElementById("anoadocao").value = "branco";
		}
		function novapesquisa(){
			document.getElementById("resultado").style.display = 'none';
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
				  
			  }
			  
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
	<br>
      <form method="POST" action="result_relatoriofinan_contabil.php" name="relatoriofinanceiro" target="_blank" onSubmit="javascript:validar()">
          <center>
           <br>
            <h3>RELATÓRIOS</h3><br>
           </center>
      	 <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Tipo do relatório: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tiporelatorio" id="Lanca_diario" value="Lançamentos diários"><label class="form-check-label" for="gridRadios1"> Lançamentos diários </label> <br>
                            <input class="form-check-input" type="radio" name="tiporelatorio" id="Lanca_diario" value="Sócios"><label class="form-check-label" for="gridRadios1"> Lançamentos diários de sócios </label> <br>
                            <input class="form-check-input" type="radio" name="tiporelatorio" id="Lanca_diario" value="Lançamentos mensais"><label class="form-check-label" for="gridRadios1"> Lançamentos mensais </label> <br>
                            <input class="form-check-input" type="radio" name="tiporelatorio" id="Lanca_diario" value="Geral"><label class="form-check-label" for="gridRadios1"> Total (despesas e receitas) </label> <br>
                        </div>
                     </div>
        </div>
        <br>
        <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Banco: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="banco" id="banco" value="Banco Itaú"><label class="form-check-label" for="gridRadios1"> Banco Itaú </label> <br>
                            <input class="form-check-input" type="radio" name="banco" id="banco" value="Banco do Brasil"><label class="form-check-label" for="gridRadios1"> Banco do Brasil </label> <br>
                            <input class="form-check-input" type="radio" name="banco" id="banco" value="Pagseguro"><label class="form-check-label" for="gridRadios1"> Pagseguro </label> <br>
                            <input class="form-check-input" type="radio" name="banco" id="banco" value="Apoiese"><label class="form-check-label" for="gridRadios1"> Apoia.se </label> <br>
                        </div>
                     </div>
        </div>
        <br>
       <div class="form-row">
            <div class="form-group col-md-6">
                  <label>Ano: </label>
                      <select class="form-control" id="inlineFormCustomSelect" name="ano" required>
                                  <option name="branco" value="branco">Selecione</option>
                                  <option name="2019" value="2019">2019</option>
                    </select>
            </div>
            <div class="form-group col-md-6">
                  <label>Mês: </label>
                      <select class="form-control" id="inlineFormCustomSelect" name="mes" required>
                                    <option name="branco" value="branco">Selecione</option>
                                    <option name="jan" value="01">Janeiro</option>
                                    <option name="fev" value="02">Fevereiro</option>
                                    <option name="mar" value="03">Março</option>
                                    <option name="abr" value="04">Abril</option>
                                    <option name="mai" value="05">Maio</option>
                                    <option name="jun" value="06">Junho</option>
                                    <option name="jul" value="07">Julho</option>
                                    <option name="ago" value="08">Agosto</option>
                                    <option name="set" value="09">Setembro</option>
                                    <option name="out" value="10">Outubro</option>
                                    <option name="nov" value="11">Novembro</option>
                                    <option name="dez" value="12">Dezembro</option>
                    </select>
            </div>
        </div>
         <center><a href="javascript:relatoriofinanceiro.submit()" class="btn btn-primary">Gerar relatório</a></center>
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
</html>