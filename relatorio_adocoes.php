<?php
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}
else{
	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
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
                document.getElementById('divdisp').className  = "d-block";
                document.getElementById('divanimallt').className  = "d-none";
                document.getElementById('divnomelt').className  = "d-none";
                document.getElementById('divanomes').className  = "d-none";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divlocal').className  = "d-none";
        }
        
    function OnChangeRadio2 (radio) {
                document.getElementById('divanomes').className  = "d-block";
                document.getElementById('divlocal').className  = "d-block";
                document.getElementById('divcomtermos').className  = "d-block";
                document.getElementById('divdisp').className  = "d-none";
                document.getElementById('divanimallt').className  = "d-none";
                document.getElementById('divnomelt').className  = "d-none";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divcastra').className  = "d-none";
        }
    
    function OnChangeRadio3 (radio) {
                document.getElementById('divanimallt').className  = "d-block";
                document.getElementById('divnomelt').className  = "d-block";
                document.getElementById('divdisp').className  = "d-none";
                document.getElementById('divanomes').className  = "d-none";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divlocal').className  = "d-none";
        }
        
    function OnChangeRadio4 (radio) {
                document.getElementById('divlt').className  = "d-block";
                document.getElementById('divanimallt').className  = "d-none";
                document.getElementById('divnomelt').className  = "d-none";
                document.getElementById('divdisp').className  = "d-none";
                document.getElementById('divanomes').className  = "d-none";
                document.getElementById('divlocal').className  = "d-none";
        }
    function OnChangeRadio5 (radio) {
                document.getElementById('divcpg').className  = "d-block";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divanimallt').className  = "d-none";
                document.getElementById('divnomelt').className  = "d-none";
                document.getElementById('divdisp').className  = "d-none";
                document.getElementById('divanomes').className  = "d-none";
                document.getElementById('divlocal').className  = "d-none";
        }
    function OnChangeRadio6 (radio) {
                document.getElementById('divprocedi').className  = "d-block";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divanimallt').className  = "d-none";
                document.getElementById('divnomelt').className  = "d-none";
                document.getElementById('divdisp').className  = "d-none";
                document.getElementById('divanomes').className  = "d-none";
                document.getElementById('divlocal').className  = "d-none";
        }
        
    function OnChangeRadio7 (radio) {
                document.getElementById('divcastra').className  = "d-block";
                document.getElementById('divanomes').className  = "d-none";
                document.getElementById('divlocal').className  = "d-none";
                document.getElementById('divdisp').className  = "d-none";
                document.getElementById('divanimallt').className  = "d-none";
                document.getElementById('divnomelt').className  = "d-none";
                document.getElementById('divlt').className  = "d-none";
        }
        
    function OnChangeRadio8 (radio) {
                document.getElementById('divespeciecanina').className  = "d-block";
                document.getElementById('divespeciefelina').className  = "d-none";
        }
        
    function OnChangeRadio9 (radio) {
                document.getElementById('divespeciecanina').className  = "d-none";
                document.getElementById('divespeciefelina').className  = "d-block";
        }
    
    </script>
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
				  
			  }
			  
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
      <form method="POST" action="result_relatorioadocoes.php" name="relatorioadocao" >
         <CENTER><p><h3>RELATÓRIOS OPERACIONAIS</h3></p><br></CENTER>
         <div class="row">
                      <legend class="col-form-label col-sm-3 pt-0">Escolha o tipo do relatório: </legend>
                      <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tiporelatorio" id="tiporelatorio" value="Adotados" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1" required>Adotados</label>
                        </div>
                        <div id="divcomtermos" class="form-row d-none">
                            <br>
                                <input type ="radio" id="comtermos" name ="comtermos" value="Não"><label class="form-check-label" for="gridRadios1">Sem termos cadastrados</label> <br>
                                <input type ="radio" id="comtermos" name ="comtermos" value="Sim"><label class="form-check-label" for="gridRadios1">Com termos cadastrados</label> <br>
                            <br>
                            <label>Ou </label>
                        </div>
                        <div id="divlocal" class="form-row d-none">
                              <label>Local da adoção: </label>
                                  <select class="form-control" id="localadocao" name="localadocao" required>
                             		  <option selected value="">Selecione</option>
                             		  <option value="Centro de Convivência">Centro de Convivência</option>
                             		  <option value="Petcamp Barão Geraldo">Petcamp Barão Geraldo</option>
                                      <option value="Petcamp Jasmim">Petcamp Jasmim</option>
                                      <option value="Petland">Petland</option>
                                      <option value="Leroy M Dom Pedro">Leroy Merlin Dom Pedro</option>
                                      <option value="Fora da feira">Fora da feira</option>
                                      <option value="Pet Center Marginal">Pet Center Marginal</option>
                                      <option value="Petz">Petz</option>
                                  </select>
                        </div>
                        <div id="divanomes" class="form-row d-none">
                                  <label>Ano: </label>
                                      <select class="form-control" id="anoadocao" name="anoadocao" required>
                                                  <option selected value="">Selecione</option>
                                             		  <?
                                            		 		$queryanoadocao = "SELECT DISTINCT YEAR(DATA_ADOCAO) AS year FROM TERMO_ADOCAO WHERE DATA_ADOCAO <>'' AND YEAR(DATA_ADOCAO)<>'0' ORDER BY DATA_ADOCAO DESC";
                                            				$selectanoadocao = mysqli_query($connect,$queryanoadocao);
                                            				
                                            				while ($fetchanoadocao = mysqli_fetch_row($selectanoadocao)) {
                                            					echo "<option value='".$fetchanoadocao[0]."'>".$fetchanoadocao[0]."</option>";
                                            				}
                                            		?>
                                                  <!--<option value="">Selecione</option>
                                                  <option value="2025">2025</option>
                                                  <option value="2024">2024</option>
                                                  <option value="2023">2023</option>
                                                  <option value="2022">2022</option>
                                                  <option value="2021">2021</option>
                                                  <option value="2020">2020</option>
                                                  <option value="2019">2019</option>
                                                  <option value="2018">2018</option>
                                                  <option value="2017">2017</option>-->
                                    </select>
                                  <label>Mês: </label>
                                      <select class="form-control" id="mesadocao" name="mesadocao" required>
                                                    <option value="">Selecione</option>
                                                    <?
                                            		 		$querymesadocao = "SELECT DISTINCT MONTH(DATA_ADOCAO) AS year FROM TERMO_ADOCAO WHERE DATA_ADOCAO <>'' AND MONTH(DATA_ADOCAO)<>'0' ORDER BY MONTH(DATA_ADOCAO) DESC";
                                            				$selectmesadocao = mysqli_query($connect,$querymesadocao);
                                            				
                                            				while ($fetchmesadocao = mysqli_fetch_row($selectmesadocao)) {
                                            					echo "<option value='".$fetchmesadocao[0]."'>".$fetchmesadocao[0]."</option>";
                                            				}
                                            		?>
                                                    <!--<option value="01">Janeiro</option>
                                                    <option value="02">Fevereiro</option>
                                                    <option value="03">Março</option>
                                                    <option value="04">Abril</option>
                                                    <option value="05">Maio</option>
                                                    <option value="06">Junho</option>
                                                    <option value="07">Julho</option>
                                                    <option value="08">Agosto</option>
                                                    <option value="09">Setembro</option>
                                                    <option value="10">Outubro</option>
                                                    <option value="11">Novembro</option>
                                                    <option value="12">Dezembro</option>-->
                                    </select>
        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tiporelatorio" id="tiporelatorio" value="Animais disponíveis" onclick="OnChangeRadio (this)"><label class="form-check-label" for="gridRadios1">Animais do GAAR disponíveis</label>
                        </div>
                        <div id="divdisp" class="form-row d-none">
                                <div class="form-group col-md-12">
                                    <legend class="col-form-label col-sm-5 pt-0">Com foto? </legend>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input type ="radio" id="foto" name ="foto" value="Sim"><label class="form-check-label" for="gridRadios1">Sim</label> <br>
                                            <input type ="radio" id="foto" name ="foto" value="Não"><label class="form-check-label" for="gridRadios1">Não</label> <br>
                                            <input type ="radio" id="foto" name ="foto" value="Todos"><label class="form-check-label" for="gridRadios1">Todos</label> <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <legend class="col-form-label col-sm-5 pt-0">Por responsável: </legend>
                                    <div id="divnomeresp" class="form-row d-block">
                                                <div class="form-group col-md-">
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="nomeresp" name="nomeresp" required>
                                                     		  <option selected value="">Selecione</option>
                                                     		  <?
                                                    		 		$query = "SELECT NOME FROM VOLUNTARIOS WHERE STATUS_APROV='Aprovado' AND (AREA='captacao' OR AREA='operacional' OR AREA='diretoria' OR AREA='financeiro' OR AREA='comunicacao' OR AREA='administracao') ORDER BY NOME ASC";
                                                    				$select = mysqli_query($connect,$query);
                                                    				
                                                    				while ($fetch = mysqli_fetch_row($select)) {
                                                    					echo "<option value='".$fetch[0]."'>".$fetch[0]."</option>";
                                                    				}
                                                    		?>
                                            	        </select>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tiporelatorio" id="tiporelatorio" value="Animais em lts" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1">Animais em lares temporários</label>
                        </div>
                        <div id="divanimallt" class="form-row d-none">
                                <div class="form-group col-md-12">
                                    <legend class="col-form-label col-sm-5 pt-0"></legend>
                                    <div class="col-sm-12">
                                        <div class="form-check">
                                            <input type ="radio" id="lt" name ="lt" value="Nome do lt"><label class="form-check-label" for="gridRadios1" onclick="OnChangeRadio4 (this)">Listar por nome</label> <br>
                                            <div id="divnomelt" class="form-row d-none">
                                                <div class="form-group col-md-">
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="nomelt" name="nomelt" required>
                                                     		  <option selected value="">Selecione</option>
                                                     		  <?
                                                    		 		$query = "SELECT LAR_TEMPORARIO FROM LT ORDER BY LAR_TEMPORARIO ASC";
                                                    				$select = mysqli_query($connect,$query);
                                                    				
                                                    				while ($fetch = mysqli_fetch_row($select)) {
                                                    					echo "<option value='".$fetch[0]."'>".$fetch[0]."</option>";
                                                    				}
                                                    		?>
                                            	        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type ="radio" id="lt" name ="lt" value="Quantidade"><label class="form-check-label" for="gridRadios1">Listar quantidade</label> <br>
                                            <input type ="radio" id="lt" name ="lt" value="Espécie Canina" onclick="OnChangeRadio8 (this)"><label class="form-check-label" for="gridRadios1">Listar por espécie canina</label> <br>
                                            <div id="divespeciecanina" class="form-row d-none">
                                                    <div class="form-group col-md-12">
                                                        <legend class="col-form-label col-sm-5 pt-0"></legend>
                                                        <div class="col-sm-12">
                                                            <div class="form-check">
                                                                <label class="form-check-label" for="gridRadios1" >Status</label> <br>
                                                                <div id="divstatusespeciecanina" class="form-row d-block">
                                                                    <div class="form-group col-md-">
                                                                        <div class="col-sm-8">
                                                                            <select class="form-control" id="selectstatusespeciecanina" name="selectstatusespeciecanina" required>
                                                                         		  <option selected value="">Todos</option>
                                                                                  <option value="Disponível">Disponível</option>
                                                                                  <option value="Devolvido">Devolvido</option>
                                                                                  <option value="Pré adotado">Pré adotado</option>
                                                                                  <option value="Adotado">Adotado</option>
                                                                                  <option value="Adotado (sem termo)">Adotado (sem termo)</option>
                                                                                  <option value="Em adaptação">Em adaptação</option>
                                                                                  <option value="Indisponível">Indisponível</option>
                                                                                  <option value="Óbito">Óbito</option>
                                                                	        </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                               </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <input type ="radio" id="lt" name ="lt" value="Espécie Felina" onclick="OnChangeRadio9 (this)"><label class="form-check-label" for="gridRadios1">Listar por espécie felina</label> <br>
                                            <div id="divespeciefelina" class="form-row d-none">
                                                    <div class="form-group col-md-12">
                                                        <legend class="col-form-label col-sm-5 pt-0"></legend>
                                                        <div class="col-sm-12">
                                                            <div class="form-check">
                                                                <label class="form-check-label" for="gridRadios1" onclick="OnChangeRadio11 (this)">Status</label> <br>
                                                                <div id="divstatusespeciefelina" class="form-row d-block">
                                                                    <div class="form-group col-md-">
                                                                        <div class="col-sm-8">
                                                                            <select class="form-control" id="selectstatusespeciefelina" name="selectstatusespeciefelina" required>
                                                                         		  <option selected value="">Todos</option>
                                                                                  <option value="Disponível">Disponível</option>
                                                                                  <option value="Devolvido">Devolvido</option>
                                                                                  <option value="Pré adotado">Pré adotado</option>
                                                                                  <option value="Adotado">Adotado</option>
                                                                                  <option value="Adotado (sem termo)">Adotado (sem termo)</option>
                                                                                  <option value="Em adaptação">Em adaptação</option>
                                                                                  <option value="Indisponível">Indisponível</option>
                                                                                  <option value="Óbito">Óbito</option>
                                                                	        </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                               </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tiporelatorio" id="tiporelatorio" value="Castração" onclick="OnChangeRadio7 (this)"><label class="form-check-label" for="gridRadios1">Castrações</label>
                        </div>
                        <div id="divcastra" class="form-row d-none">
                            <div class="form-group col-md-6">
                                  <label>Ano: </label>
                                      <select class="form-control" id="anocastra" name="anocastra" required>
                                                  <?
                                            		 		$queryanocastra = "SELECT DISTINCT YEAR(DATA_AG) AS year FROM AGENDAMENTO WHERE DATA_AG <>'' AND YEAR(DATA_AG)<>'0' AND ATIVO<>'CANCELADO' ORDER BY DATA_AG DESC";
                                            				$selectanocastra = mysqli_query($connect,$queryanocastra);
                                            				
                                            				while ($fetchanocastra = mysqli_fetch_row($selectanocastra)) {
                                            					echo "<option value='".$fetchanocastra[0]."'>".$fetchanocastra[0]."</option>";
                                            				}
                                            		?>
                                                  <!--<option value="">Selecione</option>
                                                  <option value="2023">2023</option>
                                                  <option value="2022">2022</option>
                                                  <option value="2021">2021</option>
                                                  <option value="2020">2020</option>
                                                  <option value="2019">2019</option>
                                                  <option value="2018">2018</option>
                                                  <option value="2017">2017</option>-->
                                    </select>                            </div>
                            <!--<div class="form-group col-md-6">
                                  <label>Mês: </label>
                                      <select class="form-control" id="mescastra" name="mescastra" required>
                                                    <option name="" value="">Selecione</option>
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
                            </div>-->
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tiporelatorio" id="tiporelatorio" value="CPG" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1">Comissão provisória de gatos (CPG)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tiporelatorio" id="tiporelatorio" value="Feiras" onclick=""><label class="form-check-label" for="gridRadios1">Feiras</label>
                        </div>
                        <!--<div id="divcpg" class="form-row d-none">
                                <div class="form-group col-md-12">
                                    <legend class="col-form-label col-sm-5 pt-0">Com foto? </legend>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input type ="radio" id="fotocpg" name ="fotocpg" value="Sim" checked><label class="form-check-label" for="gridRadios1">Sim</label> <br>
                                            <input type ="radio" id="fotocpg" name ="fotocpg" value="Não"><label class="form-check-label" for="gridRadios1">Não</label> <br>
                                            <input type ="radio" id="fotocpg" name ="fotocpg" value="Todos"><label class="form-check-label" for="gridRadios1">Todos</label> <br>
                                        </div>
                                    </div>
                                </div>
                        </div>-->
                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tiporelatorio" id="tiporelatorio" value="Lares temporários" onclick="OnChangeRadio4 (this)"><label class="form-check-label" for="gridRadios1">Lares temporários</label>
                            </div>
                        <div id="divlt" class="form-row d-none">
                                    <div class="form-group col-md-9">
                                        <div class="col-sm-9">
                                            <div class="form-check">
                                                <input type ="radio" id="tipolt" name ="tipolt" value="Apenas cães no momento"><label class="form-check-label" for="gridRadios1"> Com apenas cães no momento</label> <br>
                                                <input type ="radio" id="tipolt" name ="tipolt" value="Apenas cães"><label class="form-check-label" for="gridRadios1"> Todos para cães</label> <br>
                                                <input type ="radio" id="tipolt" name ="tipolt" value="Apenas gatos no momento"><label class="form-check-label" for="gridRadios1"> Com apenas gatos no momento</label> <br>
                                                <input type ="radio" id="tipolt" name ="tipolt" value="Apenas gatos"><label class="form-check-label" for="gridRadios1"> Todos para gatos</label> <br>
                                                <input type ="radio" id="tipolt" name ="tipolt" value="Cães e gatos"><label class="form-check-label" for="gridRadios1"> Com cães e gatos</label> <br>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tiporelatorio" id="tiporelatorio" value="Procedimentos" onclick="OnChangeRadio6 (this)"><label class="form-check-label" for="gridRadios1">Procedimentos veterinários</label>
                        </div>
                        <div id="divprocedi" class="form-row d-none">
                            <div class="form-group col-md-6">
                                  <label>Ano: </label>
                                      <select class="form-control" id="anoprocedi" name="anoprocedi" required>
                                                  <option value="">Selecione</option>
                                                  <option value="2021">2021</option>
                                                  <option value="2020">2020</option>
                                                  <option value="2019">2019</option>
                                        </select>
                            </div>
                            <div class="form-group col-md-6">
                                  <label>Mês: </label>
                                      <select class="form-control" id="mesprocedi" name="mesprocedi" required>
                                                    <option value="">Selecione</option>
                                                    <option value="01">Janeiro</option>
                                                    <option value="02">Fevereiro</option>
                                                    <option value="03">Março</option>
                                                    <option value="04">Abril</option>
                                                    <option value="05">Maio</option>
                                                    <option value="06">Junho</option>
                                                    <option value="07">Julho</option>
                                                    <option value="08">Agosto</option>
                                                    <option value="09">Setembro</option>
                                                    <option value="10">Outubro</option>
                                                    <option value="11">Novembro</option>
                                                    <option value="12">Dezembro</option>
                                    </select>
                            </div>
                        </div>
                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tiporelatorio" id="tiporelatorio" value="Vacinas" ><label class="form-check-label" for="gridRadios1">Vacinas e testes</label>
                        </div>
                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tiporelatorio" id="tiporelatorio" value="Lista de presença" ><label class="form-check-label" for="gridRadios1">Lista de presença dos voluntários</label>
                        </div>
                        </div>
                        
         </div>
        <br>
        <p><center><a href="javascript:relatorioadocao.submit()" class="btn btn-primary">Gerar relatório</a></center></p>
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