<?php
session_start();

include ("conexao.php");

$login = $_SESSION['login'];
$idanimal = $_GET['idanimal'];
$email = $_GET['email'];


if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login' or EMAIL = '$email'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
		
		$query = "SELECT * FROM ANIMAL WHERE ID = '$idanimal'";
		$select = mysqli_query($connect,$query);
		$fetch = mysqli_fetch_row($select);		
		
		$idanimal = $fetch[0];
		$nomeanimal = $fetch[1];
		$especie = $fetch[2];
		$idade = $fetch[3];
		$sexo = $fetch[4];
		$cor = $fetch[5];
		$porte = $fetch[6];
		$castracao = $fetch[7];
		$dtcastracao = $fetch[8];
		$vacinacao = $fetch[9];
		$dtvacinacao = $fetch[30];
		$doses = $fetch[22];
		$vermifugado = $fetch[21];
		$status = $fetch[10];
		$statusold = $fetch[10];
		$lt = $fetch[11];
		$resp = $fetch[12];
		$dtentradalt = $fetch[13];
		$dtsaidalt = $fetch[14];
		$obs = $fetch[15];
		$nome_foto1_ori = $fetch[16];
		$nome_foto2_ori = $fetch[31];
		$nome_foto3_ori = $fetch[32];
		$nome_foto4_ori = $fetch[33];
		$carteirinha_frente_ori = $fetch[26];
		$carteirinha_verso_ori = $fetch[27];
		$obs2 = $fetch[17];
		$divulgar = $fetch[18];
		$perfil_outrosanimais = $fetch[34];
		$perfil_criancas = $fetch[35];
		$perfil_apto = $fetch[36];
		$uploaddir = "/home/gaarcam1/public_html/pets/".$idanimal."/";
		$uploadfile = $uploaddir.($_FILES['foto']['name']);
		$foto = $uploadfile;	
		$uploadfile_2 = $uploaddir.($_FILES['foto_2']['name']);
        $uploadfile_3 = $uploaddir.($_FILES['foto_3']['name']);
        $uploadfile_4 = $uploaddir.($_FILES['foto_4']['name']);
        $nome_foto = $_FILES['foto']['name'];
        $nome_foto_2 = $_FILES['foto_2']['name'];
        $nome_foto_3 = $_FILES['foto_3']['name'];
        $nome_foto_4 = $_FILES['foto_4']['name'];
        $foto_2 = $uploadfile_2;
        $foto_3 = $uploadfile_3;
        $foto_4 = $uploadfile_4;
		$ltold = $lt;
		$uploaddircart = '/home/gaarcam1/public_html/docs/carteirinhas/';
        $uploadcart_frente = $uploaddircart.($_FILES['carteirinha_frente']['name']);
        $uploadcart_verso = $uploaddircart.($_FILES['carteirinha_verso']['name']);
        $peso = $fetch[28];
        $obs_apadrinha=$fetch[39];
        $dtdisponivel=$fetch[40];
        $video = $fetch[41];
        $vacinacao_r = $fetch[42];
        $dtvacinacao_r = $fetch[43];
        $exame_fivfelv = $fetch[44];
        $dt_exame_fivfelv = $fetch[45];
        $dt_vermifugacao = $fetch[46];
        $result_exame_fivfelv = $fetch[47];
		
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
    
    <title>GAAR - Atualização de animal</title>
    
    <script type="text/javascript">	
    
    $("#cb_post").on('click', function(){

	$("#foto").toggle();

    });   

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
                        
                            function OnChangeRadio3 (radio) {
                                        document.getElementById('divpeso').className  = "d-block";
                                }
                                
                            function OnChangeRadio4 (radio) {
                                        document.getElementById('divpeso').className  = "d-none";
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
				  case 'anuncios':
				  	include_once("menu_terceiros.php") ;
					break;
				  
			  }
			  
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
    <form action="atualizapet.php" method="POST" enctype="multipart/form-data" name="form">
    	<center>
            <h3>ATUALIZAÇÃO CADASTRAL DE ANIMAIS</h3><br>
        <p><label> É importante cadastrar o animal corretamente pois as informações aqui preenchidas irão ser usadas para cadastrar o termo de adoção, gerar estatísticas e aparecer no resultado da pesquisa externa de animais do site</label></p>
       </center>
            <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Número: <input name="idanimal" type="text" id="idanimal" class="form-control" value="<? echo $idanimal?>" readonly></label> 
            </div>
            <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome do animal </label> 
                            <input name="nomedoanimal" type="text" id="nomedoanimal" class="form-control" value="<? echo $nomeanimal?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nascimento (aproximado): </label> 
                            <input name="idade" type="date" id="idade" class="form-control" value="<? echo $idade?>">
                        </div>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Espécie: </legend>
                      <div class="col-sm-10">
                          <? if ($especie =='Felina') {
                              echo "<div class='form-check'>
                                        <input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' onclick='OnChangeRadio3 (this)' ><label class='form-check-label' for='gridRadios1' required>Canina</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' onclick='OnChangeRadio4 (this)' checked><label class='form-check-label' for='gridRadios1'>Felina</label>
                                    </div>
                                    <div class='form-row d-none' id='divpeso'>
                                        <div class='form-group col-md-6'>
                                            <label>Peso aproximado (em kg): </label> 
                                            <input name='peso' type='text' id='peso' maxlength='10' class='form-control' required value='0'>
                                            <small id='passwordHelpBlock' class='form-text text-muted'>Apenas números inteiros (sem vírgulas ou pontos)</small>
                                        </div>
                                    </div>";
                          } else {
                              echo "<div class='form-check'>
                                        <input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' onclick='OnChangeRadio3 (this)' checked><label class='form-check-label' for='gridRadios1' required>Canina</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' onclick='OnChangeRadio4 (this)' ><label class='form-check-label' for='gridRadios1'>Felina</label>
                                    </div>
                                    <div class='form-row d-block' id='divpeso'>
                                        <div class='form-group col-md-6'>
                                            <label>Peso aproximado (em kg): </label> 
                                            <input name='peso' type='text' id='peso' maxlength='10' class='form-control' required value='".$peso."'>
                                            <small id='passwordHelpBlock' class='form-text text-muted'>Apenas números inteiros (sem vírgulas ou pontos)</small>
                                        </div>
                                    </div>";
                          }
                          ?>
                      </div>
                    </div>
                </fieldset>
                <br>
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Sexo: </legend>
                      <div class="col-sm-10">
                         <? if ($sexo =='Macho') { 
                             echo "<div class='form-check'>
                                      <input class='form-check-input' type='radio' name='sexo' id='Macho' value='Macho' checked><label class='form-check-label' required>Macho </label> &nbsp;&nbsp;
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='sexo' id='Fêmea' value='Fêmea'><label class='form-check-label'>Fêmea </label> 
                                    </div>";
                         } else {
                             echo "<div class='form-check'>
                                      <input class='form-check-input' type='radio' name='sexo' id='Macho' value='Macho'><label class='form-check-label' required>Macho </label> &nbsp;&nbsp;
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='sexo' id='Fêmea' value='Fêmea' checked><label class='form-check-label'>Fêmea </label> 
                                    </div>";
                         }
                        ?>
                      </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Cor: </label> 
                  <div class="col-sm-10">
                      <select class="form-control" id="inlineFormCustomSelect" name="cor" required>
                             		  <option selected value="<? echo $cor ?>"><? echo $cor ?></option>
                             		  <option value="">-----</option>
                             		  <option value="Amarelo">Amarelo</option>
                             		  <option value="Branco">Branco</option>
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
                          <? if ($porte =='Pequeno') { 
                                echo "<div class='form-check'>
                                            <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno' checked> <label class='form-check-label' required>Pequeno </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>    
                                            <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio'> <label class='form-check-label'>Médio </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande'> <label class='form-check-label'>Grande </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='porte' id='Não se aplica' value='Não se aplica'> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;
                                        </div>";
                                }
                                if ($porte =='Médio') { 
                                echo "<div class='form-check'>
                                            <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno'> <label class='form-check-label' required>Pequeno </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>    
                                            <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio' checked> <label class='form-check-label'>Médio </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande'> <label class='form-check-label'>Grande </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='porte' id='Não se aplica' value='Não se aplica'> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;
                                        </div>";
                                }
                                if ($porte =='Grande') { 
                                echo "<div class='form-check'>
                                            <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno'> <label class='form-check-label' required>Pequeno </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>    
                                            <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio'> <label class='form-check-label'>Médio </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande' checked> <label class='form-check-label'>Grande </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='porte' id='Não se aplica' value='Não se aplica'> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;
                                        </div>";
                                }
                                if ($porte =='Não se aplica') { 
                                echo "<div class='form-check'>
                                            <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno'> <label class='form-check-label' required>Pequeno </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>    
                                            <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio'> <label class='form-check-label'>Médio </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande'> <label class='form-check-label'>Grande </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='porte' id='Não se aplica' value='Não se aplica' checked> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;
                                        </div>";
                                }
                                
                          ?>
                      </div>
                    </div>
                </fieldset>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Castrado? </label>
                        <?
                            if ($castracao == 'Sim'){
                                
                                $queryvet = "SELECT CLINICA FROM AGENDAMENTO WHERE ID_GAAR ='$idanimal'";
                                $selectvet = mysqli_query($connect,$queryvet);
                                $rc = mysqli_fetch_row($selectvet);
                                $tmp_vet = $rc[0];
                                
                                $queryvet2 = "SELECT CLINICA FROM CLINICAS WHERE ID ='$tmp_vet'";
                                $selectvet2 = mysqli_query($connect,$queryvet2);
                                $rc2 = mysqli_fetch_row($selectvet2);
                                $vet = $rc2[0];
                                
			                                
                                echo "<div class='form-check'>
                                            <input class='form-check-input' type='radio' name='castracao' id='Castrado' value='Sim' checked><label class='form-check-label' required>Sim </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='castracao' id='Não castrado' value='Não'><label class='form-check-label'>Não</label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-group'>
                                            <label>Veterinário responsável pelo procedimento: ".$vet."</label>
                                        </div>";
                            } else {
                                echo "<div class='form-check'>
                                            <input class='form-check-input' type='radio' name='castracao' id='Castrado' value='Sim'><label class='form-check-label' required>Sim </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='castracao' id='Não castrado' value='Não' checked><label class='form-check-label'>Não</label> &nbsp; &nbsp;
                                        </div>";
                            }
                        
                        
                        ?>
                        
                    </div>
                    <div class="form-group col-md-6">
                      <label>Data da castração: </label>
                        <input class="form-control" type="date" name="dtcastracao" id="dtcastracao" value="<? echo $dtcastracao?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>Vacinado com polivalente? </label>
                      <?
                        if ($vacinacao == 'Sim'){
                            echo "<div class='form-check'>
                                        <input class='form-check-input' type='radio' name='vacinacao' id='vacinacao' value='Sim' checked><label class='form-check-label' required>Sim </label> &nbsp; &nbsp;
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='vacinacao' id='nao vacinado' value='Não'><label class='form-check-label'>Não</label> &nbsp; &nbsp;
                                    </div>";
                        }else {
                             echo "<div class='form-check'>
                                        <input class='form-check-input' type='radio' name='vacinacao' id='vacinacao' value='Sim'><label class='form-check-label' required>Sim </label> &nbsp; &nbsp;
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='vacinacao' id='nao_vacinado' value='Não' checked><label class='form-check-label'>Não</label> &nbsp; &nbsp;
                                    </div>";
                        }
                      ?>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Doses: </label>
                        <select class="form-control" id="inlineFormCustomSelect" name="doses" required>
                         		  <?    
                         		        echo "<option selected value='".$doses."'>".$doses."</option>";
                         		        echo "<option value=''>------------------------</option>";
                        		  ?>
                         		  <option value="1">01</option>
                         		  <option value="2">02</option>
                         		  <option value="3">03</option>
                         		  <option value="4">04</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Data da última vacinação: </label>
                            <input class="form-control" type="date" name="dtvacina" id="dtvacina" value="<?echo $dtvacinacao?>" required>
                    </div>
                    <!-- Vacina da raiva -->
                    <div class="form-group col-md-6">
                      <label>Vacinado contra raiva? </label>
                        <?
                            if ($vacinacao_r == 'Sim'){
                                echo "<div class='form-check'>
                                            <input class='form-check-input' type='radio' name='vacinacao_r' id='vacinacao_r' value='Sim' checked><label class='form-check-label' required>Sim </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='vacinacao_r' id='nao_vacinado_r' value='Não'><label class='form-check-label'>Não</label> &nbsp; &nbsp;
                                        </div>";
                            }else {
                                 echo "<div class='form-check'>
                                            <input class='form-check-input' type='radio' name='vacinacao_r' id='vacinacao_r' value='Sim'><label class='form-check-label' required>Sim </label> &nbsp; &nbsp;
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='vacinacao_r' id='nao_vacinado_r' value='Não' checked><label class='form-check-label'>Não</label> &nbsp; &nbsp;
                                        </div>";
                            }
                      ?>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Data da última vacinação: </label>
                            <input class="form-control" type="date" name="dtvacina_r" id="dtvacina_r" value="<?echo $dtvacinacao_r?>" required>
                    </div>
                    <!-- Teste FIV/FELV -->
                    <div class="form-group col-md-4">
                      <label>Testado contra FIV/FEV? </label>
                      <?
                        switch ($exame_fivfelv) {
                            case 'Sim':
                                echo "
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='exame_fivfelv' id='exame_fivfelv_s' value='Sim' checked onclick='OnChangeRadio10 (this)'><label class='form-check-label' required>Sim </label> &nbsp; &nbsp;
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='exame_fivfelv' id='exame_fivfelv_n' value='Não' onclick='OnChangeRadio9 (this)'><label class='form-check-label'>Não</label> &nbsp; &nbsp;
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='exame_fivfelv' id='exame_fivfelv_na' value='N/A' onclick='OnChangeRadio9 (this)'><label class='form-check-label'>Não se aplica</label> &nbsp; &nbsp;
                                    </div>
                                ";
                                break;
                                
                            case 'Não':
                                echo "
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='exame_fivfelv' id='exame_fivfelv_s' value='Sim' onclick='OnChangeRadio10 (this)'><label class='form-check-label' required>Sim </label> &nbsp; &nbsp;
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='exame_fivfelv' id='exame_fivfelv_n' value='Não' checked onclick='OnChangeRadio9 (this)'><label class='form-check-label'>Não</label> &nbsp; &nbsp;
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='exame_fivfelv' id='exame_fivfelv_na' value='N/A' onclick='OnChangeRadio9 (this)'><label class='form-check-label'>Não se aplica</label> &nbsp; &nbsp;
                                    </div>
                                ";
                                break;
                            
                            default:
                                echo "
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='exame_fivfelv' id='exame_fivfelv_s' value='Sim' onclick='OnChangeRadio10 (this)'><label class='form-check-label' required>Sim </label> &nbsp; &nbsp;
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='exame_fivfelv' id='exame_fivfelv_n' value='Não' onclick='OnChangeRadio9 (this)'><label class='form-check-label'>Não</label> &nbsp; &nbsp;
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='exame_fivfelv' id='exame_fivfelv_na' value='N/A' checked onclick='OnChangeRadio9 (this)'><label class='form-check-label'>Não se aplica</label> &nbsp; &nbsp;
                                    </div>
                                ";
                                break;
                        }
                      ?>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Resultado: </label>
                      <?
                            switch ($result_exame_fivfelv) {
                                case 'FIV/FELV Positivo':
                                    echo "
                                            <select class='form-control' id='result_exame_fivfelv' name='result_exame_fivfelv' required>
                                             		  <option value='0'>Selecione</option>
                                             		  <option selected value='FIV/FELV Positivo'>FIV/FELV Positivo</option>
                                             		  <option value='FIV/FELV Negativo'>FIV/FELV Negativo</option>
                                             		  <option value='FIV Negativo/FELV Positivo'>FIV Negativo / FELV Positivo</option>
                                             		  <option value='FIV Positivo/FELV Negativo'>FIV Positivo / FELV Negativo</option>
                                             		  
                                            </select>   
                                    ";
                                    break;
                                case 'FIV/FELV Negativo':
                                    echo "
                                            <select class='form-control' id='result_exame_fivfelv' name='result_exame_fivfelv' required>
                                             		  <option value='0'>Selecione</option>
                                             		  <option value='FIV/FELV Positivo'>FIV/FELV Positivo</option>
                                             		  <option selected value='FIV/FELV Negativo'>FIV/FELV Negativo</option>
                                             		  <option value='FIV Negativo/FELV Positivo'>FIV Negativo / FELV Positivo</option>
                                             		  <option value='FIV Positivo/FELV Negativo'>FIV Positivo / FELV Negativo</option>
                                             		  
                                            </select>   
                                    ";
                                    break;
                                case 'FIV Negativo/FELV Positivo':
                                    echo "
                                            <select class='form-control' id='result_exame_fivfelv' name='result_exame_fivfelv' required>
                                             		  <option value='0'>Selecione</option>
                                             		  <option value='FIV/FELV Positivo'>FIV/FELV Positivo</option>
                                             		  <option value='FIV/FELV Negativo'>FIV/FELV Negativo</option>
                                             		  <option selected value='FIV Negativo/FELV Positivo'>FIV Negativo / FELV Positivo</option>
                                             		  <option value='FIV Positivo/FELV Negativo'>FIV Positivo / FELV Negativo</option>
                                             		  
                                            </select>   
                                    ";
                                    break;
                                case 'FIV Positivo/FELV Negativo':
                                    echo "
                                            <select class='form-control' id='result_exame_fivfelv' name='result_exame_fivfelv' required>
                                             		  <option value='0'>Selecione</option>
                                             		  <option value='FIV/FELV Positivo'>FIV/FELV Positivo</option>
                                             		  <option value='FIV/FELV Negativo'>FIV/FELV Negativo</option>
                                             		  <option value='FIV Negativo/FELV Positivo'>FIV Negativo / FELV Positivo</option>
                                             		  <option selected value='FIV Positivo/FELV Negativo'>FIV Positivo / FELV Negativo</option>
                                             		  
                                            </select>   
                                    ";
                                    break;
                                default:
                                    echo "
                                            <select class='form-control' id='result_exame_fivfelv' name='result_exame_fivfelv' required>
                                             		  <option selected value='0'>Selecione</option>
                                             		  <option value='FIV/FELV Positivo'>FIV/FELV Positivo</option>
                                             		  <option value='FIV/FELV Negativo'>FIV/FELV Negativo</option>
                                             		  <option value='FIV Negativo/FELV Positivo'>FIV Negativo / FELV Positivo</option>
                                             		  <option value='FIV Positivo/FELV Negativo'>FIV Positivo / FELV Negativo</option>
                                             		  
                                            </select>   
                                    ";
                                    break;
                                
                            }
                      ?>
                    </div>
                    <div class="form-group col-md-5">
                      <label>Data do teste: </label>
                       <? 
                            if ($exame_fivfelv =='N/A') {
                                echo "<input class='form-control' type='date' name='dt_exame_fivfelv' id='dt_exame_fivfelv' value=".$dt_exame_fivfelv." disabled='disabled'>";
                            } else {
                                echo "<input class='form-control' type='date' name='dt_exame_fivfelv' id='dt_exame_fivfelv' value=".$dt_exame_fivfelv.">";
                            }
                       ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Vermifugado? </label>
                      <?
                            if ($vermifugado =='Sim'){
                                echo "<div class='form-check'>
                                          <input class='form-check-input' type='radio' name='vermifugado' id='Vermifugado' value='Sim' checked><label class='form-check-label' required>Sim </label> &nbsp; &nbsp;
                                         </div>
                                        <div class='form-check'>
                                          <input class='form-check-input' type='radio' name='vermifugado' id='Não vermifugado' value='Não'><label class='form-check-label'>Não</label> &nbsp; &nbsp;
                                        </div>";
                            }else {
                                echo "<div class='form-check'>
                                          <input class='form-check-input' type='radio' name='vermifugado' id='Vermifugado' value='Sim'><label class='form-check-label' required>Sim </label> &nbsp; &nbsp;
                                         </div>
                                        <div class='form-check'>
                                          <input class='form-check-input' type='radio' name='vermifugado' id='Não vermifugado' value='Não' checked><label class='form-check-label'>Não</label> &nbsp; &nbsp;
                                        </div>";
                            }
                          
                          ?>
                    </div>
                    <div class="form-group col-md-6">
                            <label>Data da última vermifugação: </label>
                            <input class="form-control" type="date" name="dt_vermifugacao" id="dt_vermifugacao" value="<?echo $dt_vermifugacao?>" required>
                    </div>
                </div>
                
                <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Lar temporário: </label>
                            <select class="form-control" id="inlineFormCustomSelect" name="lt" required>
                         		  <?    
                         		        echo "<option selected value='".$lt."'>".$lt."</option>";
                         		        
                         		        if ($area != 'anuncios'){
                         		            echo "<option value=''>------------------------</option>";
                         		            $query = "SELECT LAR_TEMPORARIO FROM LT WHERE ATIVO = 'Sim' ORDER BY LAR_TEMPORARIO ASC";
                         		            $select = mysqli_query($connect,$query);
                        				
                            				while ($fetch = mysqli_fetch_row($select)) {
                            				        echo "<option value='".$fetch[0]."'>".$fetch[0]."</option>";
                            				    }
                         		        }
                        		 		
                        				
                        		?>
                	        </select>
                	    </div>
                	    <div class="form-group col-md-3">
                            <label>Data de entrada: </label>
                            <input type="date" name="dtentradalt" id="dtentradalt" class="form-control" value="<? echo $dtentradalt?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Data de saída: </label>
                            <input type="date" name="dtsaidalt" id="dtsaidalt" class="form-control" value="<? echo $dtsaidalt?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Responsável: </label>
                            <select class="form-control" id="inlineFormCustomSelect" name="resp" required>
                         		  <?
                         		        if ($area == 'anuncios'){
                         		            echo "<option selected value='".$obs2."'>".$obs2."</option>";
                         		        } else {
                         		            echo "<option selected value='".$resp."'>".$resp."</option>";
                             		        echo "<option value=''>------------------------</option>";
                            		 		$queryresp = "SELECT NOME FROM VOLUNTARIOS WHERE AREA <> 'anuncios' AND AREA <> 'clinica' AND STATUS_APROV='Aprovado' ORDER BY NOME ASC";
                            				$selectresp = mysqli_query($connect,$queryresp);
                            				
                            				while ($fetchresp = mysqli_fetch_row($selectresp)) {
                            				        echo "<option value='".$fetchresp[0]."'>".$fetchresp[0]."</option>";
                            				    }
                         		        }
                         		        
                        					
                        		?>
                    	    </select>
                    	 </div>
                            
                </div>
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Status: </legend>
                      <div class="col-sm-10">
                          <?
                                switch ($status){
                                    case 'Disponível':
                                        echo "<div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Disponível' onclick='OnChangeRadio8 (this)' checked><label class='form-check-label'>Disponível </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Devolvido' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Devolvido </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Óbito' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Óbito </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Pré adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Pré adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (sem termo)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (sem termo)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (fora do GAAR)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (fora do GAAR)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Indisponível' onclick='OnChangeRadio7 (this)'><label class='form-check-label'>Indisponível</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Em adaptação' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Em adaptação</label>
                                                </div>";
                                        break;
                            
                                    case 'Devolvido':
                                        echo "<div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Disponível' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Disponível </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Devolvido' checked onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Devolvido </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Óbito' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Óbito </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Pré adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Pré adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (sem termo)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (sem termo)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (fora do GAAR)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (fora do GAAR)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Indisponível' onclick='OnChangeRadio7 (this)'><label class='form-check-label'>Indisponível</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Em adaptação' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Em adaptação</label>
                                                </div>";
                                        break;
                                        
                                    case 'Indisponível':
                                        echo "<div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Disponível' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Disponível </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Devolvido' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Devolvido </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Óbito' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Óbito </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Pré adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Pré adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (sem termo)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (sem termo)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (fora do GAAR)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (fora do GAAR)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Indisponível' checked><label class='form-check-label'>Indisponível</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Em adaptação' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Em adaptação</label>
                                                </div>
                                                <div id='divdisponivel' class='form-row d-block'>
                                                	<div class='form-group col-md-6'>
                                                	  <label>Disponível em: </label>
                                                		<input class='form-control' type='date' name='dtdisponivel' id='dtdisponivel' value=".$dtdisponivel.">
                                                		<small id='passwordHelpBlock' class='form-text text-muted'>Nesta data o status irá atualizar automaticamente para Disponível</small>
                                                	</div>
                                                </div>";
                                        break;
                                        
                                    case 'Óbito': 
                                        echo "<div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Disponível' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Disponível </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Devolvido' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Devolvido </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Óbito' checked onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Óbito </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Pré adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Pré adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (sem termo)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (sem termo)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (fora do GAAR)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (fora do GAAR)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Indisponível' onclick='OnChangeRadio7 (this)'><label class='form-check-label'>Indisponível</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Em adaptação' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Em adaptação</label>
                                                </div>";
                                        break;
                                        
                                    case 'Pré adotado': 
                                        echo "<div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Disponível' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Disponível </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Devolvido' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Devolvido </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Óbito' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Óbito </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Pré adotado' checked onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Pré adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (sem termo)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (sem termo)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (fora do GAAR)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (fora do GAAR)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Indisponível' onclick='OnChangeRadio7 (this)'><label class='form-check-label'>Indisponível</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Em adaptação'onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Em adaptação</label>
                                                </div>";
                                        break;
                                                
                                    case 'Adotado':
                                        echo "<div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Disponível' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Disponível </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Devolvido' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Devolvido </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Óbito' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Óbito </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Pré adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Pré adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado' checked onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (sem termo)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (sem termo)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (fora do GAAR)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (fora do GAAR)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Indisponível' onclick='OnChangeRadio7 (this)'><label class='form-check-label'>Indisponível</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Em adaptação' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Em adaptação</label>
                                                </div>";
                                        break;
                                    case 'LEG':
                                       echo "<div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Disponível' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Disponível </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Devolvido' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Devolvido </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Óbito' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Óbito </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='LEG' checked onclick='OnChangeRadio7 (this)'><label class='form-check-label'>LEG </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Pré adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Pré adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (sem termo)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (sem termo)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (fora do GAAR)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (fora do GAAR)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Indisponível' onclick='OnChangeRadio7 (this)'><label class='form-check-label'>Indisponível</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Em adaptação' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Em adaptação</label>
                                                </div>";
                                        break;
                                    
                                    case 'Em adaptação':
                                       echo "<div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Disponível' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Disponível </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Devolvido' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Devolvido </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Óbito' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Óbito </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='LEG' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>LEG </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Pré adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Pré adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (sem termo)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (sem termo)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (fora do GAAR)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (fora do GAAR)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Indisponível' onclick='OnChangeRadio7 (this)'><label class='form-check-label'>Indisponível</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Em adaptação' checked onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Em adaptação</label>
                                                </div>";
                                        break;
                                        
                                    case 'Adotado (sem termo)':
                                       echo "<div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Disponível' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Disponível </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Devolvido' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Devolvido </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Óbito' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Óbito </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='LEG' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>LEG </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Pré adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Pré adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (sem termo)' checked onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (sem termo)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (fora do GAAR)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (fora do GAAR)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Indisponível' onclick='OnChangeRadio7 (this)'><label class='form-check-label'>Indisponível</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Em adaptação' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Em adaptação</label>
                                                </div>";
                                        break;
                                        
                                    case 'Adotado (fora do GAAR)':
                                       echo "<div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Disponível' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Disponível </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Devolvido' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Devolvido </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Óbito' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Óbito </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='LEG' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>LEG </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Pré adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Pré adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (sem termo)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (sem termo)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (fora do GAAR)' checked onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (fora do GAAR)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Indisponível' onclick='OnChangeRadio7 (this)'><label class='form-check-label'>Indisponível</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Em adaptação' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Em adaptação</label>
                                                </div>";
                                        break;
                                    
                                    default:
                                        echo "<div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Disponível' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Disponível </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Devolvido' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Devolvido </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Óbito' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Óbito </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='LEG' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>LEG </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Pré adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Pré adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado </label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (sem termo)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (sem termo)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Adotado (fora do GAAR)' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Adotado (fora do GAAR)</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Indisponível' onclick='OnChangeRadio7 (this)'><label class='form-check-label'>Indisponível</label>
                                                </div>
                                                <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='status' id='status' value='Em adaptação' onclick='OnChangeRadio8 (this)'><label class='form-check-label'>Em adaptação</label>
                                                </div>";
                                        break;
                                        
                            }
                          
                          ?>
                          </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Perfil: </legend>
                      <div class="col-sm-10">
                          <? 
                          
                             if ($perfil_outrosanimais == 'Sim') {
                                echo "<div class='form-check'>
                                          <input class='form-check-input' type='checkbox' name='outrosanimais' id='outrosanimais' value='Sim' checked><label class='form-check-label'>Convive bem com outros animais</label>
                                        </div>";
                             } else {
                                 echo "<div class='form-check'>
                                          <input class='form-check-input' type='checkbox' name='outrosanimais' id='outrosanimais' value='Sim'><label class='form-check-label'>Convive bem com outros animais</label>
                                        </div>";
                             }
                                
                             if ($perfil_criancas == 'Sim') {
                                echo "<div class='form-check'>
                                          <input class='form-check-input' type='checkbox' name='criancas' id='criancas' value='Sim' checked><label class='form-check-label'>Convive bem com crianças</label>
                                        </div>"; 
                             } else {
                                 echo "<div class='form-check'>
                                          <input class='form-check-input' type='checkbox' name='criancas' id='criancas' value='Sim' ><label class='form-check-label'>Convive bem com crianças</label>
                                        </div>"; 
                             }
                             
                             if ($perfil_apto == 'Sim') {
                                echo "<div class='form-check'>
                                          <input class='form-check-input' type='checkbox' name='apto' id='apto' value='Sim' checked><label class='form-check-label'>Vive bem em apartamento </label>
                                        </div>";  
                             } else {
                                 echo "<div class='form-check'>
                                          <input class='form-check-input' type='checkbox' name='apto' id='apto' value='Sim'><label class='form-check-label'>Vive bem em apartamento </label>
                                        </div>";
                             }
                             
                        ?>
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
                      <legend class="col-form-label col-sm-2 pt-0">Divulgar como: </legend>
                      <div class="col-sm-10">
                        
                        <? if ($area == 'anuncios'){
                           echo "<div class='form-check'>
                                  <input class='form-check-input' type='radio' name='divulgar' id='divulgar' value='Terceiros' checked><label class='form-check-label'>Terceiros </label>
                                </div>";
                        } else {
                            echo "<div class='form-check'>
                                      <input class='form-check-input' type='radio' name='divulgar' id='divulgar' value='Terceiros'><label class='form-check-label'>Terceiros </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='divulgar' id='divulgar' value='GAAR' checked><label class='form-check-label'>GAAR </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='divulgar' id='divulgar' value='Não divulgar'><label class='form-check-label'>Não divulgar para adoção (para controle do CPG)</label>
                                    </div>";
                        }
                        ?>
                       </div>
                    </div>
                </fieldset>
                <!--<input type="checkbox" id="cb_post">Usar a mesma foto-->
                <div class="form-group">
                    <label for="exampleFormControlFile1">Vídeo do animal:</label>
                    <input name="video" type="text" id="video" maxlength="150" class="form-control" value="<? echo $video ?>">
                    <small id="passwordHelpBlock" class="form-text text-muted"> Coloque o link embed (por exemplo: https://www.youtube.com/embed/HSNrsFapUIY)</small>
                </div>
                <div id="foto" class="form-row d-block">
                    <div class="container">
                    <?
                        if ($nome_foto1_ori == '') {
                            echo "<div class='form-group'>
                                    <label for='exampleFormControlFile1'>Escolher foto principal do animal</label>
                                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='foto_1'>
                                    <small id='passwordHelpBlock' class='form-text text-muted'>Tamanho máximo da foto: 1MB</small>
                                </div>";
                        } else {
                            echo "
                                      <div class='row'>
                                        <div class='col-3'><figure><a href='/pets/".$idanimal."/".$nome_foto1_ori."' target='_blank'><img src='/pets/".$idanimal."/".$nome_foto1_ori."' class='img-fluid' /></a></figure></div>
                                      </div>
                                  ";
                            echo "<div class='form-group'>
                                    <label for='exampleFormControlFile1'>Escolha a nova foto principal do animal</label>
                                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='foto_1'>
                                    <small id='passwordHelpBlock' class='form-text text-muted'>Tamanho máximo da foto: 1MB</small>
                                    <input class='form-check-input' type='checkbox' name='deletarfoto1' id='deletarfoto1' value='deletarfoto1'><label class='form-check-label'>Apagar essa foto</label>
                                </div><br>";
                            
                        }
                    ?>
                    </div>
                </div>
                <div id="divfoto2" class="form-row d-block">
                    <div class="container">
                    <?
                        if ($nome_foto2_ori == '') {
                            echo "<div class='form-group'>
                                    <label for='exampleFormControlFile1'>Escolher foto 2 do animal</label>
                                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='foto_2'>
                                    <small id='passwordHelpBlock' class='form-text text-muted'>Tamanho máximo da foto: 1MB</small>
                                </div>";
                        } else {
                            echo "
                                      <div class='row'>
                                        <div class='col-3'><figure><a href='/pets/".$idanimal."/".$nome_foto2_ori."' target='_blank'><img src='/pets/".$idanimal."/".$nome_foto2_ori."' class='img-fluid' /></a></figure></div>
                                      </div>
                                  ";
                            echo "<div class='form-group'>
                                    <label for='exampleFormControlFile1'>Escolha a nova foto 2 do animal</label>
                                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='foto_2'>
                                    <small id='passwordHelpBlock' class='form-text text-muted'>Tamanho máximo da foto: 1MB</small>
                                    <input class='form-check-input' type='checkbox' name='deletarfoto2' id='deletarfoto2' value='deletarfoto2'><label class='form-check-label'>Apagar essa foto</label>
                                </div><br>";
                            
                        }
                    ?>
                    </div>
                </div>
                <div id="divfoto3" class="form-row d-block">
                    <div class="container">  
                    <?
                        if ($nome_foto3_ori == '') {
                            echo "<div class='form-group'>
                                    <label for='exampleFormControlFile1'>Escolher foto 3 do animal</label>
                                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='foto_3'>
                                    <small id='passwordHelpBlock' class='form-text text-muted'>Tamanho máximo da foto: 1MB</small>
                                </div>";
                        } else {
                            echo "
                                      <div class='row'>
                                        <div class='col-3'><figure><a href='/pets/".$idanimal."/".$nome_foto3_ori."' target='_blank'><img src='/pets/".$idanimal."/".$nome_foto3_ori."' class='img-fluid' /></a></figure></div>
                                      </div>
                                  ";
                            echo "<div class='form-group'>
                                    <label for='exampleFormControlFile1'>Escolha a nova foto 3 do animal</label>
                                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='foto_3'>
                                    <small id='passwordHelpBlock' class='form-text text-muted'>Tamanho máximo da foto: 1MB</small>
                                    <input class='form-check-input' type='checkbox' name='deletarfoto3' id='deletarfoto3' value='deletarfoto3'><label class='form-check-label'>Apagar essa foto</label>
                                </div><br>";
                            
                        }
                    
                    ?>
                    </div>
                </div>
                <div id="divfoto4" class="form-row d-block">
                    <div class="container">  
                    <?
                        if ($nome_foto4_ori == '') {
                            echo "<div class='form-group'>
                                    <label for='exampleFormControlFile1'>Escolher foto do animal</label>
                                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='foto_4'>
                                    <small id='passwordHelpBlock' class='form-text text-muted'>Tamanho máximo da foto: 1MB</small>
                                </div>";
                        } else {
                            echo "
                                      <div class='row'>
                                        <div class='col-3'><figure><a href='/pets/".$idanimal."/".$nome_foto4_ori."' target='_blank'><img src='/pets/".$idanimal."/".$nome_foto4_ori."' class='img-fluid' /></a></figure></div>
                                      </div>
                                  ";
                            echo "<div class='form-group'>
                                    <label for='exampleFormControlFile1'>Escolha a nova foto do animal</label>
                                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='foto_4'>
                                    <small id='passwordHelpBlock' class='form-text text-muted'>Tamanho máximo da foto: 1MB</small>
                                    <input class='form-check-input' type='checkbox' name='deletarfoto4' id='deletarfoto4' value='deletarfoto4'><label class='form-check-label'>Apagar essa foto</label>
                                </div><br>";
                            
                        }
                    
                    ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class='col-3'><figure><a href='/area/carteirinhas/<? echo $carteirinha_frente_ori?>' target='_blank'><img src='/area/carteirinhas/<? echo $carteirinha_frente_ori?>' class='img-fluid' /></a></figure></div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Foto da frente da carteirinha</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="carteirinha_frente" value="<? echo $carteirinha_frente_ori?>">
                    <small id="passwordHelpBlock" class="form-text text-muted">Tamanho máximo da foto: 1MB</small>
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Foto do verso da carteirinha</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="carteirinha_verso" value="<? echo $carteirinha_verso_ori?>">
                    <small id="passwordHelpBlock" class="form-text text-muted">Tamanho máximo da foto: 1MB</small>
                </div>
                <br>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Texto para divulgação: </label> 
                  <div class="col-sm-10">
                    <textarea class="form-control" name="obs" cols="70" rows="10" id="obs"><? echo $obs ?></textarea>
                    <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Observações para o apadrinhamento: </label> 
                  <div class="col-sm-10">
                    <textarea class="form-control" name="obs3" cols="70" rows="10" id="obs3"><? echo $obs_apadrinha ?></textarea>
                    <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Observações: </label> 
                  <div class="col-sm-10">
                    <textarea class="form-control" name="obs2" cols="70" rows="10" id="obs2"><? echo $obs2 ?></textarea>
                    <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-10">
                    <input class="form-check-input" type="text" name="ltold" id="ltold" value="<? echo $ltold?>" hidden>
                    <input class="form-check-input" type="text" name="nome_foto1_ori" id="nome_foto1_ori" value="<? echo $nome_foto1_ori?>" hidden>
                    <input class="form-check-input" type="text" name="nome_foto2_ori" id="nome_foto2_ori" value="<? echo $nome_foto2_ori?>" hidden>
                    <input class="form-check-input" type="text" name="nome_foto3_ori" id="nome_foto3_ori" value="<? echo $nome_foto3_ori?>" hidden>
                    <input class="form-check-input" type="text" name="nome_foto4_ori" id="nome_foto4_ori" value="<? echo $nome_foto4_ori?>" hidden>
                  </div>
                </div>
                <input name="statusold" type="text" id="statusold" class="form-control" value="<? echo $statusold?>" hidden>
                <center><a href="javascript:form.submit()" class="btn btn-primary">Atualizar</a> &nbsp;&nbsp; <a href="formpesquisapetinterna.php" class="btn btn-primary">Voltar</a></center>
            </form>
	</center>
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