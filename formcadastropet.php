<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];


if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA,NOME,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
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
    
    <title>GAAR - Cadastro de animais</title>
    
    <script type="text/javascript">
	function cadastropet(){
		document.form.action = 'cadastropet.php'; 
		document.form.submit();
	}
	function atualizapet(){
		document.form.action = 'atualizapet.php'; 
		document.form.submit();
	}
	
	function validaimagem() {
		var extensoesOk = ",.gif,.jpg,.jpeg,.png,.gif,.bmp,";
		var extensao	= "," + document.form.foto.value.substr( document.form.foto.value.length - 4 ).toLowerCase() + ",";
		window.document.write(extensao);
		if (document.form.foto.value == "")
		 {alert("O campo do endereço da imagem está vazio!!")}
		else if( extensoesOk.indexOf( extensao ) == -1 )
		 { alert( document.form.foto.value + "\nNão possui uma extensão válida" );javascript:location.reload()}
		else {javascript:tamanhos()}	 
		}
		
		function tamanhos() {
		var imagem=new Image();
		imagem.src=document.form.foto.value;
		tamanho_imagem = imagem.fileSize 
		img_tan = tamanho_imagem
		if (tamanho_imagem < 0)
		 {javascript:tamanhos()}
		else if (tamanho_imagem > 150000)
		{alert("O tamanho da Imagem é muito grande ...  "+tamanho_imagem+" Bytes!!");javascript:location.reload()}
		else 
		{javascript:ativafigura()}
		}
		function ativafigura() {
			largura = document.getElementById("foto").width;
			altura = document.getElementById("foto").height;
			if (largura > 400 || altura > 400 ){
				alert("A imagem é "+largura+"x"+altura+" está fora do padrão requerido: 400 x 400");javascript:location.reload()
		  	}
		  }
	</script>
	<script type="text/javascript">
                        
                            function AddFoto2 () {
                                        document.getElementById('divfoto2').className  = "d-block";
                                        document.getElementById('addfoto3').className  = "d-block";
                                        document.getElementById('addfoto2').className  = "d-none";
                                }
                            
                            function OnChangeRadio (radio) {
                                        document.getElementById('divterceiros').className  = "d-block";
                                        document.getElementById('divrespgaar').className  = "d-none";
                                }
                                
                            function OnChangeRadio2 (radio) {
                                        document.getElementById('divterceiros').className  = "d-none";
                                        document.getElementById('divrespgaar').className  = "d-block";
                                        document.getElementById('divdisponivel').className  = "d-block";
                                        document.getElementById('Indisponível').checked  = true;
                                }
                            
                            function OnChangeRadio3 (radio) { /* ESPÉCIE CANINA */
                                        document.getElementById('divpeso').className  = "d-block";
                                        document.getElementById('divgaar').className  = "d-block";
                                        document.getElementById('divleg').className  = "d-none";
                                        document.getElementById('divulgargaar').checked  = true;
                                        document.getElementById('N/A').checked  = false;
                                        document.getElementById('apto').checked  = true;
                                        document.getElementById('exame_fivfelv_na').checked  = true;
                                        document.getElementById('dt_exame_fivfelv').setAttribute('disabled', 'disabled');
                                }
                                
                            function OnChangeRadio4 (radio) { /* ESPÉCIE FELINA */
                                        document.getElementById('divgaar').className  = "d-none";
                                        document.getElementById('divleg').className  = "d-block";
                                        document.getElementById('divterceiros').className  = "d-none";
                                        document.getElementById('divrespgaar').className  = "d-none";
                                        document.getElementById('divpeso').className  = "d-none";
                                        document.getElementById('divulgarleg').checked  = true;
                                        document.getElementById('N/A').checked  = true;
                                        document.getElementById('apto').checked  = true;
                                        document.getElementById('dt_exame_fivfelv').removeAttribute('disabled');
                                }
                            
                            function OnChangeRadio5 (radio) {
                                        document.getElementById('divterceiros').className  = "d-none";
                                        document.getElementById('divrespgaar').className  = "d-none";
                                        document.getElementById('divpeso').className  = "d-none";
                                        document.getElementById('divulgarleg').checked  = true;
                                }
                              
                            function OnChangeRadio6 (radio) {
                                    
                                        document.getElementById("dtcastracao").value ='';
                                        
                                        var anoCadastracao
                                        var mesCadastracao
                                        var diaCadastracao
                                        var meses = ["01","02","03","04","05","06","07","08","09","10","11","12"];
                                        dataatual = new Date();
                                        
                                        var dtnasc = document.getElementById("idade").value;
                                        nascimento = new Date(dtnasc)
                                        nascimento.setDate(nascimento.getDate() + 1)
                                        
                                        console.log(dtnasc);
                                        console.log(nascimento);
                                        console.log(dataatual);
                                        
                                        diferenca = Math.abs(nascimento.getTime() - dataatual.getTime())
                                        days = Math.ceil(diferenca / (1000 * 60 * 60 * 24));
                                        console.log(days);
                                        if ( days >= 1 && days <= 30){
                                            nascimento.setDate(nascimento.getDate() + 150)
                                        }
                                        
                                        if ( days >= 31 && days <= 60){
                                            nascimento.setDate(nascimento.getDate() + 150)
                                        }
                                        
                                        if ( days >= 61 && days <= 90){
                                            nascimento.setDate(nascimento.getDate() + 150)
                                        }
                                        
                                        if ( days >= 91 && days <= 120){
                                            nascimento.setDate(nascimento.getDate() + 150)
                                        }
                                        
                                        if ( days >= 121 && days <= 149){
                                            nascimento.setDate(nascimento.getDate() + 150)
                                        }
                                        
                                        var datacadastracaonova = ""
                                        anonovo = nascimento.getFullYear();
                                        mesnovo = meses[nascimento.getMonth()];
                                        dianovo = nascimento.getDate();
                                        
                                        anoconversao = anonovo.toString();
                                        diaconversao = dianovo.toString();

                                        
                                        
                                        datacadastracaonova = anoconversao.concat("-",mesnovo,"-",diaconversao);
                                        document.getElementById("dtcastracao").value = datacadastracaonova;
                                        
                                        
                                        
                                        if ( days >= 150){
                                            alert("Castração já deveria estar realizada!",0,"Atenção");
                                            //document.getElementById("dtcastracao").value ='';
                                        }
                                        
                                        
                                                                 
                                                                 
                                } 
                            
                            function OnChangeRadio7 (radio) {
                                        document.getElementById('divdisponivel').className  = "d-block";
                                }
                                
                            function OnChangeRadio8 (radio) {
                                        document.getElementById('divdisponivel').className  = "d-none";
                                }
                                
                            function OnChangeRadio9 (radio) { /*FIV/FELV não testado */
                                       document.getElementById('dt_exame_fivfelv').setAttribute('disabled', 'disabled');
                                       document.getElementById('result_exame_fivfelv').disabled = true;
                                }
                            function OnChangeRadio10 (radio) { /*FIV/FELV testado */
                                       document.getElementById('dt_exame_fivfelv').removeAttribute('disabled');
                                       document.getElementById('result_exame_fivfelv').disabled = false;
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
				    if ($subarea == 'lt'){
				        include_once("menu_lt.php") ;
				    }  else {
				        include_once("menu_operacional.php") ;    
				    }
				  	
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
       <center>
        <h3>CADASTRO DE ANIMAIS</h3><br>
        <p><label> É importante cadastrar o animal corretamente pois as informações aqui preenchidas irão ser usadas para cadastrar o termo de adoção, gerar estatísticas e aparecer no resultado da pesquisa externa de animais do site. <br></center>
        
        <strong>Observações:</strong> <br>
        - Caso o animal não esteja castrado, a data prevista da castração vai ser calculada automaticamente de acordo com a data de nascimento do animal; <br>
        - É importante cadastrar a data da última vacinação porque o sistema enviará um lembrete da próxima vacinação via e-mail ao voluntário responsável <br><br>
        
        </label></p>
       </center>
            <form action="cadastropet.php" method="POST" enctype="multipart/form-data" name="form">
                	<div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome do animal: </label> 
                            <input name="nomeanimal" type="text" id="nomeanimal" maxlength="20" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nascimento (aproximado): </label> 
                            <input name="idade" type="date" id="idade" class="form-control" required>
                        </div>
                    </div>
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Espécie: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="especie" id="Canina" value="Canina" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1" required>Canina</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="especie" id="Felina" value="Felina" onclick="OnChangeRadio4 (this)"><label class="form-check-label" for="gridRadios1">Felina</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-row d-none" id="divpeso">
                        <div class="form-group col-md-3">
                            <label>Peso aproximado (em kg): </label> 
                            <input name="peso" type="text" id="peso" maxlength="10" class="form-control" required>
                            <small id="passwordHelpBlock" class="form-text text-muted">Apenas números inteiros (sem vírgulas ou pontos)</small>
                        </div>
                    </div>
                </fieldset>
                <br>
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Sexo: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sexo" id="Macho" value="Macho"><label class="form-check-label" required>Macho </label> &nbsp;&nbsp;
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sexo" id="Fêmea" value="Fêmea"><label class="form-check-label">Fêmea </label> 
                        </div>
                      </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Cor: </label> 
                  <div class="col-sm-10">
                    <select class="form-control" id="inlineFormCustomSelect" name="cor" required>
                         		  <option selected value="">Selecione</option>
                         		  <option value="Amarelo">Amarelo</option>
                         		  <option value="Branco">Branco</option>
                         		  <option value="Branco e bege">Branco e bege</option>
                         		  <option value="Branco e preto">Branco e preto</option>
                         		  <option value="Branco e cinza">Branco e cinza</option>
                         		  <option value="Branco e amarelo">Branco e amarelo</option>
                         		  <option value="Bege">Bege</option>
                         		  <option value="Caramelo">Caramelo</option>
                         		  <option value="Cinza">Cinza</option>
                         		  <option value="Marrom">Marrom</option>
                         		  <option value="Preto">Preto</option>
                         		  <option value="Preto e marrom">Preto e marrom</option>
                         		  <option value="Preto e bege">Preto e bege</option>
                         		  <option value="Escaminha">Escaminha</option>
                         		  <option value="Rajado">Rajado</option>
                         		  <option value="Siames">Siames</option>
                         		  <option value="Tigrado">Tigrado</option>
                         		  <option value="Tricolor">Tricolor</option>
                        </select>
                  </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Porte: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="porte" id="Pequeno" value="Pequeno"> <label class="form-check-label" required>Pequeno </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">    
                            <input class="form-check-input" type="radio" name="porte" id="Médio" value="Médio"> <label class="form-check-label">Médio </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="porte" id="Grande" value="Grande"> <label class="form-check-label">Grande </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="porte" id="N/A" value="N/A"> <label class="form-check-label">Gato </label> &nbsp; &nbsp;
                        </div>
                      </div>
                    </div>
                </fieldset>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Castrado? </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="castracao" id="Castrado" value="Sim"><label class="form-check-label" required>Sim </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="castracao" id="Não castrado" value="Não" onclick="OnChangeRadio6 (this)"><label class="form-check-label">Não</label> &nbsp; &nbsp;
                        </div>
                    </div>
                    <!--<div id="divcastracao" class="form-row d-none">-->
                        <div class="form-group col-md-6">
                          <label>Data da castração (ou previsão): </label>
                            <input class="form-control" type="date" name="dtcastracao" id="dtcastracao" required>
                        </div>
                   <!-- </div>-->
                </div>
                <div class="form-row">
                <!-- Vacina v10/v4 -->
                    <div class="form-group col-md-4">
                      <label>Vacinado com polivalente? </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vacinacao" id="vacinacao" value="Sim"><label class="form-check-label" required>Sim </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vacinacao" id="nao_vacinado" value="Não"><label class="form-check-label">Não</label> &nbsp; &nbsp;
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Doses: </label>
                        <select class="form-control" id="inlineFormCustomSelect" name="doses" required>
                         		  <option selected value="0">00</option>
                         		  <option value="1">01</option>
                         		  <option value="2">02</option>
                         		  <option value="3">03</option>
                         		  <option value="4">04</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Data da última vacinação: </label>
                            <input class="form-control" type="date" name="dtvacina" id="dtvacina" required>
                    </div>
                <!-- Vacina da raiva -->
                    <div class="form-group col-md-6">
                      <label>Vacinado contra raiva? </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vacinacao_r" id="vacinacao_r" value="Sim"><label class="form-check-label" required>Sim </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vacinacao_r" id="nao_vacinado_r" value="Não"><label class="form-check-label">Não</label> &nbsp; &nbsp;
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Data da última vacinação: </label>
                            <input class="form-control" type="date" name="dtvacina_r" id="dtvacina_r" required>
                    </div>
                <!-- Teste FIV/FELV -->
                    <div class="form-group col-md-4">
                      <label>Testado contra FIV/FEV? </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exame_fivfelv" id="exame_fivfelv_s" value="Sim" onclick="OnChangeRadio10 (this)"><label class="form-check-label" required>Sim </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exame_fivfelv" id="exame_fivfelv_n" value="Não" onclick="OnChangeRadio9 (this)"><label class="form-check-label">Não</label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exame_fivfelv" id="exame_fivfelv_na" value="N/A" onclick="OnChangeRadio9 (this)"><label class="form-check-label">N/A</label> &nbsp; &nbsp;
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Resultado: </label>
                            <select class="form-control" id="result_exame_fivfelv" name="result_exame_fivfelv" required>
                         		  <option selected value="0">Selecione</option>
                         		  <option value="FIV/FELV Positivo">FIV/FELV Positivo</option>
                         		  <option value="FIV/FELV Negativo">FIV/FELV Negativo</option>
                         		  <option value="FIV Negativo/FELV Positivo">FIV Negativo / FELV Positivo</option>
                         		  <option value="FIV Positivo/FELV Negativo">FIV Positivo / FELV Negativo</option>
                         		  
                        </select>
                    </div>
                    <div class="form-group col-md-5">
                      <label>Data do teste: </label>
                            <input class="form-control" type="date" name="dt_exame_fivfelv" id="dt_exame_fivfelv" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Vermifugado? </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vermifugado" id="Vermifugado" value="Sim"><label class="form-check-label" required>Sim </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vermifugado" id="Não vermifugado" value="Não"><label class="form-check-label">Não</label> &nbsp; &nbsp;
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                            <label>Data da última vermifugação: </label>
                            <input class="form-control" type="date" name="dt_vermifugacao" id="dt_vermifugacao" required>
                    </div>
                </div>
                <div class="form-row ">
                    <legend class="col-form-label col-sm-2 pt-0">Divulgar como: </legend>
                    <div class="col-sm-10">
                        <div id="divgaar" class="form-row d-none">
                                    <div class='form-check'>
                                          <input class='form-check-input' type='radio' name='divulgar' id='divulgargaar' value='GAAR' onclick='OnChangeRadio2 (this)' checked><label class='form-check-label'>GAAR </label>
                                    </div>
                                    <div class='form-check'>
                                          <input class='form-check-input' type='radio' name='divulgar' id='divulgargaar' value='Controle interno' onclick='OnChangeRadio2 (this)' checked><label class='form-check-label'>Controle interno (não divulgar / status Indisponível) </label>
                                    </div>
                        </div>
                        <div id="divleg" class="form-row d-none">
                                    <div class='form-check'>
                                              <input class='form-check-input' type='radio' name='divulgar' id='divulgarleg' value='LEG' onclick='OnChangeRadio5 (this)' checked><label class='form-check-label'>Lista de espera de gatos </label>
                                    </div>
                        </div>
                            <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='divulgar' id='divulgar' value='Terceiros' onclick="OnChangeRadio (this)"><label class='form-check-label'>Terceiros </label>
                            </div>
                            <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='divulgar' id='divulgar' value='Não divulgar' onclick="OnChangeRadio2 (this)"><label class='form-check-label'>Não divulgar para adoção (para controle do CPG)</label>
                            </div>
                       </div>
                </div>
                <div id="divterceiros" class="form-row d-none">
                                <br>
                                <label>Anúncios de terceiros ficarão em nosso sistema por 60 dias. Logo após o período será excluído automaticamente. </label>
                                <div class="form-group col-md-4">
                                    <label>Lar temporário: </label>
                                    <select class="form-control" id="inlineFormCustomSelect" name="ltresp" required>
                                 		  <option selected value="Terceiros">Terceiros</option>
                        	        </select>
                        	    </div>
                                <div class="form-group col-md-6">
                                    <label>Responsável: </label> 
                                    <select class="form-control" id="inlineFormCustomSelect" name="emailresp" required>
                     		            <option selected value="">Selecione</option>
                                    <?
                        		 		$queryterc = "SELECT * FROM VOLUNTARIOS WHERE AREA = 'anuncios' ORDER BY NOME ASC";
                        				$selectterc = mysqli_query($connect,$queryterc);
                        				
                        				while ($fetchterc = mysqli_fetch_row($selectterc)) {
                        					echo "<option value='".$fetchterc[4]."'>".$fetchterc[2]."</option>";
                        				}
                        		    ?>
                        		    </select>
                                    <small id="passwordHelpBlock" class="form-text text-muted">Máximo 500 caracteres</small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Telefone do responsável: </label> 
                                    <input name="telresp" type="text" id="telresp" class="form-control" value="0">
                                    <small id="passwordHelpBlock" class="form-text text-muted">com DDD, sem espaços e sem hífen</small>
                                </div>
                </div>
                <br>
                <div class="form-row" id="divrespgaar">
                        <div class="form-group col-md-4">
                            <label>Lar temporário: </label>
                            <select class="form-control" id="inlineFormCustomSelect" name="lt" required>
                         		  <option selected value="">Selecione</option>
                         		  <?
                        		 		$query = "SELECT LAR_TEMPORARIO FROM LT WHERE ATIVO = 'Sim' ORDER BY LAR_TEMPORARIO ASC";
                        				$select = mysqli_query($connect,$query);
                        				
                        				while ($fetch = mysqli_fetch_row($select)) {
                        					echo "<option value='".$fetch[0]."'>".$fetch[0]."</option>";
                        				}
                        		?>
                	        </select>
                	    </div>
                	    <div class="form-group col-md-4">
                            <label>Data de entrada: </label>
                            <input type="date" name="dtentradalt" id="dtentradalt" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4" >
                            <label>Responsável: </label>
                            <select class="form-control" id="inlineFormCustomSelect" name="resp" required>
                     		  <option selected value="">Selecione</option>
                         		  <?
                        		 		$queryresp = "SELECT NOME FROM VOLUNTARIOS WHERE AREA <> 'anuncios' OR AREA <> 'clinica' ORDER BY NOME ASC";
                        				$selectresp = mysqli_query($connect,$queryresp);
                        				
                        				while ($fetchresp = mysqli_fetch_row($selectresp)) {
                        					echo "<option value='".$fetchresp[0]."'>".$fetchresp[0]."</option>";
                        				}
                        		    ?>
                    	    </select>
                    	 </div>
                            
                </div>
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Status: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="status" id="Disponível" value="Disponível" onclick="OnChangeRadio8 (this)" checked><label class="form-check-label">Disponível </label>
                        </div>
                        <div class='form-check'>
                           <input class='form-check-input' type='radio' name='status' id='Indisponível' onclick="OnChangeRadio7 (this)" value='Indisponível' ><label class='form-check-label'>Indisponível</label>
                        </div>
                       </div>
                    </div>
                    <div id="divdisponivel" class="form-row d-none">
                        <div class="form-group col-md-6">
                          <label>Disponível em: </label>
                            <input class="form-control" type="date" name="dtdisponivel" id="dtdisponivel" required>
                            <small id="passwordHelpBlock" class="form-text text-muted">Nesta data o status irá atualizar automaticamente para Disponível</small>
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Perfil: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="outrosanimais" id="outrosanimais" value="Sim" ><label class="form-check-label">Convive bem com outros animais</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="outrosanimais" id="outrosanimais" value="Não" ><label class="form-check-label">Não convive bem com outros animais</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="criancas" id="criancas" value="Sim" ><label class="form-check-label">Convive bem com crianças</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="criancas" id="criancas" value="Não" ><label class="form-check-label">Não convive bem com crianças</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="apto" id="apto" value="Sim" ><label class="form-check-label">Vive bem em apartamento </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="apto" id="apto" value="Não" ><label class="form-check-label">Não vive bem em apartamento </label>
                        </div>
                       </div>
                    </div>
                </fieldset>
                	
                   <!-- <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Saída do lt: </label> 
                      <div class="col-sm-10">
                        <input name="idade" type="date" name="dtsaidalt" id="dtsaidalt" class="form-control">
                      </div>
                    </div>-->
                     <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-4 pt-0">Tipo do anúncio: </legend>
                      <div class="col-sm-12">
                            <div class='form-check'>
                                    <input class='form-check-input' type="radio" name="tipoanuncio" id="tipoanuncio" value="Doação" checked>Doação<br>
                                    <input class='form-check-input' type="radio" name="tipoanuncio" id="tipoanuncio" value="Perdido">Animal perdido<br>
                                    <input class='form-check-input' type="radio" name="tipoanuncio" id="tipoanuncio" value="Encontrado">Animal encontrado<br><br>
                            </div>
                        </div>
                      
                    </div>
                        
                </fieldset>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Vídeo do animal:</label>
                    <input name="video" type="text" id="video" maxlength="150" class="form-control">
                    <small id="passwordHelpBlock" class="form-text text-muted"> Coloque o link embed (por exemplo: https://www.youtube.com/embed/HSNrsFapUIY)</small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Escolher foto 1 do animal</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="foto">
                    <small id="passwordHelpBlock" class="form-text text-muted">Tamanho máximo da foto: 1MB</small>
                </div>
                
                <div id="divfoto2" class="form-row d-block">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Escolher foto 2 do animal</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="foto_2">
                        <small id="passwordHelpBlock" class="form-text text-muted">Tamanho máximo da foto: 1MB</small>
                    </div>
                </div>
                <div id="divfoto3" class="form-row d-block">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Escolher foto 3 do animal</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="foto_3">
                        <small id="passwordHelpBlock" class="form-text text-muted">Tamanho máximo da foto: 1MB</small>
                    </div>
                </div>
                <div id="divfoto4" class="form-row d-block">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Escolher foto 4 do animal</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="foto_4">
                        <small id="passwordHelpBlock" class="form-text text-muted">Tamanho máximo da foto: 1MB</small>
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Foto da frente da carteirinha</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="carteirinha_frente">
                    <small id="passwordHelpBlock" class="form-text text-muted">Tamanho máximo da foto: 1MB</small>
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Foto do verso da carteirinha</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="carteirinha_verso">
                    <small id="passwordHelpBlock" class="form-text text-muted">Tamanho máximo da foto: 1MB</small>
                </div>
                <br><br>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Texto para divulgação: </label> 
                  <div class="col-sm-10">
                    <textarea class="form-control" name="obs" cols="70" rows="10" id="obs" value="<? echo $obs?>"></textarea>
                    <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Observações para o apadrinhamento: </label> 
                  <div class="col-sm-10">
                    <textarea class="form-control" name="obs_apadrinhamento" cols="70" rows="10" id="obs_apadrinhamento"></textarea>
                    <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Observações: </label> 
                  <div class="col-sm-10">
                    <textarea class="form-control" name="obs2" cols="70" rows="10" id="obs2" value="<? echo $obs2?>"></textarea>
                    <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                  </div>
                </div>
                <center><a href="javascript:form.submit()" class="btn btn-primary">Cadastrar</a></center>
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