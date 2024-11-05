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
                        
    function OnChangeRadio (radio) {
                document.getElementById('divdre').className  = "d-block";
    }
    
    function OnChangeRadio2 (radio) {
                document.getElementById('divdre').className  = "d-none";
                document.getElementById('divlancdia').className  = "d-block";
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
      <form method="POST" action="result_relatoriocaptacao.php" name="relatoriocaptacao" >
         <CENTER><h3>RELATÓRIOS</h3><br></CENTER>
      	 <div class="row">
                      <legend class="col-form-label col-sm-3 pt-0">Escolha o tipo do relatório: </legend>
                      <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tiporelatorio" id="tiporelatorio" value="Lançamentos diários" onclick="OnChangeRadio2 (this)" disabled><label class="form-check-label" for="gridRadios1" required>Lançamentos diários (em construção)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tiporelatorio" id="tiporelatorio" value="DRE" onclick="OnChangeRadio (this)"><label class="form-check-label" for="gridRadios1" required>Demonstrativo dos resultados do exercício (DRE)</label>
                        </div>
                       </div>
        </div>
      <div id="divdre" class="form-row d-none">
       <div class="form-row">
            <div class="form-group col-md-6">
                  <label>Ano <strong><font color="red">*</font></strong>: </label>
                      <select class="form-control" id="inlineFormCustomSelect" name="anodre" required>
                                  <option name="branco" value="branco">Selecione</option>
                                  <option name="2020" value="2020">2020</option>
                    </select>
            </div>
            <div class="form-group col-md-6">
                  <label>Mês <strong><font color="red">*</font></strong>: </label>
                      <select class="form-control" id="inlineFormCustomSelect" name="mesdre" required>
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
        <div class="form-row">
            <label><font color="red">* Campos obrigatórios</font></label>
        </div>
      </div>
      <div id="divlancdia" class="form-row d-none">
       <div class="form-row">
            <div class="form-group col-md-6">
                  <label>Ano <strong><font color="red">*</font></strong>: </label>
                      <select class="form-control" id="inlineFormCustomSelect" name="ano" required>
                                  <option name="branco" value="branco">Selecione</option>
                                  <option name="2020" value="2020">2020</option>
                    </select>
            </div>
            <div class="form-group col-md-6">
                  <label>Mês <strong><font color="red">*</font></strong>: </label>
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
        <div class="form-row">
            <label><font color="red">* Campos obrigatórios</font></label>
        </div>
      </div>
         <center><a href="javascript:relatoriocaptacao.submit()" class="btn btn-primary">Gerar relatório</a></center>
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