<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$idprocedi = $_GET['id'];

$data_atu = date("Y-m-d");
$mes_atu = date("m");
$ano_atu = date("Y"); 
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";
$fp = fopen($log_file, 'a');//opens file in write mode  

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA,EMAIL,NOME,CELULAR FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
				$email = $fetcharea[2];
				$nome_vol= $fetcharea[3];
				$celular = $fetcharea[4];
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
    
    <title>GAAR - Pedido de castração</title>
    
    <script type="text/javascript">
    
        function preencherCampo(){
            // Captura o campo de texto e os botões de rádio
              var campoTexto = document.getElementById('peso');
              var portep = document.querySelector('input[value="Pequeno"]');
              var portem = document.querySelector('input[value="Médio"]');
              var porteg = document.querySelector('input[value="Grande"]');
              var portena = document.querySelector('input[value="N/A"]');
            
              // Adiciona um ouvinte de evento para o campo de texto
              campoTexto.addEventListener('change', function() {
                var valor = campoTexto.value;
            
                // Verifica o valor e seleciona o botão de rádio correspondente
                if (valor === 'opcao1') {
                  opcao1.checked = true;
                } else if (valor === 'opcao2') {
                  opcao2.checked = true;
                }
              });
        }

        function OnChangeRadio1 (radio) {
                    document.getElementById('divprotetor').className  = "d-block";
                    document.getElementById('divdadosprotetor').className  = "d-none";
                    document.getElementById('divdadosanimal').className  = "d-block";
                    document.getElementById('divhorario').className  = "d-block";
                    document.getElementById('divquemvailevar').className  = "d-block";
                    document.getElementById('divobservacao').className  = "d-block";
                    document.getElementById('divporte').className  = "d-block";
                    document.getElementById('divenviar').className  = "d-block";
                    document.getElementById('divpedidointermedio').className  = "d-block";
            }
            
        function OnChangeRadio2 (radio) {
                    document.getElementById('divprotetor').className  = "d-none";
                    document.getElementById('divdadosprotetor').className  = "d-block";
                    document.getElementById('divcastragratis').className  = "d-none";
                    document.getElementById('divdadosanimal').className  = "d-block";
                    document.getElementById('divhorario').className  = "d-block";
                    document.getElementById('divquemvailevar').className  = "d-block";
                    document.getElementById('divobservacao').className  = "d-block";
                    document.getElementById('divporte').className  = "d-block";
                    document.getElementById('divenviar').className  = "d-block";
                    document.getElementById('divpedidointermedio').className  = "d-block";
            }
            
        function OnChangeRadio3 (radio) {
                    document.getElementById('Gato').checked  = false;
                    document.getElementById('divvetcao').className  = "d-block";
                    document.getElementById('divvetgato').className  = "d-none";
                    document.getElementById('divcastragratis').className  = "d-block";
                    document.getElementById('divcaninaraca').className  = "d-block";
                    document.getElementById('divfelinaraca').className  = "d-none";
            }
            
        function OnChangeRadio4 (radio) {
                    document.getElementById('Gato').checked  = true;
                    document.getElementById('divvetcao').className  = "d-none";
                    document.getElementById('divvetgato').className  = "d-block";
                    document.getElementById('divcastragratis').className  = "d-block";
                    document.getElementById('divcaninaraca').className  = "d-none";
                    document.getElementById('divfelinaraca').className  = "d-block";
            }
            
        function OnChangeRadio5 (radio) {
                    document.getElementById('divhorarioobs').className  = "d-block";
            }
            
        function OnChangeRadio6 (radio) {
                    document.getElementById('divhorarioobs').className  = "d-none";
            }
        
        function OutroValor(){
            var valorajuda = document.getElementById('valorajuda').value;
            if (valorajuda != "Outro"){
                document.getElementById('outrovalor').value = "0";
                document.getElementById('outrovalor').disabled = true;
            } else {
                document.getElementById('outrovalor').value = "";
                document.getElementById('outrovalor').disabled = false;
            }
        }
        
        function OnChangeRadio7 (radio) {
                    document.getElementById('divnomevolgaar').className  = "d-block";
        }
        
        function OnChangeRadio8 (radio) {
                    document.getElementById('divnomevolgaar').className  = "d-none";
        }
        
        function OnChangeRadio9 (radio) {
                    var vet_cao = document.getElementsByName('vetcao');
          
                    for(i = 0; i < vet_cao.length; i++) {
                        if(vet_cao[i].value == "DRA THAÍS BAROZI")
                        document.getElementById("castragratis").disabled = true;
                    }
        }
    
        
        function habilitarDesabilitarCampo() {
            var select_nomedoanimalgaar =  document.getElementById("nomedoanimalgaar");
            
            if (select_nomedoanimalgaar.value === "0") {
                document.getElementById('divanimal').className  = "d-block";   
                document.getElementById('divvalorajuda').className  = "d-block"; 
            } else {
                document.getElementById('divanimal').className  = "d-none";   
                document.getElementById('divvalorajuda').className  = "d-none";
            }
            
          }
        
        $(document).ready(function(){
             
            $("#vetgato").change(function(){
                
            	$.ajax({
                	url: "consultavalorvet.php",
             		type: "POST",
             		data: {
             		    idvet: document.getElementById("vetgato").value,
             		    especie: document.getElementById("especie").value,
             		},
            		success: function(response){
            		    document.getElementById('valorajudagato').value = response;
                    },
                    error: function(response){
                        document.getElementById('AlertDanger_animal').innerHTML= document.getElementById("idanimal").value + " não foi encontrado. Por favor tente novamente"; 

                    }
            	});
             });
             
          });
             
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
				  case 'clinica':
				  	include_once("menu_vet.php") ;
					break;
				  case 'veterinario':
				  	include_once("menu_veterinario.php") ;
					break;
				  case 'lt':
				  	include_once("menu_lt.php") ;
					break;
			  }

		
?>
<main role="main" class="container">
    <div class="starter-template">
       <center>
           <br>
            <h3>FORMULÁRIO INTERNO PARA PEDIDO DE CASTRAÇÃO</h3><br>
            </center>
            <form action="pedidocastra.php" method="POST" enctype="multipart/form-data" name="form">
                    <div id="divdadosanimal" class="d-block">
                        <center><h5>DADOS DO ANIMAL</h5></center>
                        <fieldset class="form-group">
                        <div class="row">
                                <legend class="col-form-label col-sm-3 pt-0">Animal do GAAR:</legend>
                                <div class="col-sm-5">
                                    <select class='form-control' id='nomedoanimalgaar' name='nomedoanimalgaar' onchange="habilitarDesabilitarCampo()" required>
                                         		        <option selected value='0'>Selecione</option>
                                         		        <option value=''>-------------------</option>";
                                                        <?
                                                            $querypet = "SELECT ID,NOME_ANIMAL,ESPECIE FROM ANIMAL WHERE DIVULGAR_COMO='GAAR' AND CASTRADO='NÃO' AND ADOTADO='Disponível' ORDER BY NOME_ANIMAL ASC";
                                                            $selectpet = mysqli_query($connect,$querypet);
                                                            $reccount = mysqli_num_rows($selectpet);
                                                            
                                                            while ($fetchpet = mysqli_fetch_row($selectpet)) {
                                                    					echo "<option value='".$fetchpet[0]."'>".$fetchpet[1]."</option>";
                                                    		}
                                                        ?>                                       		        
                                         		        
                                    </select>
                                </div>
                        </div>
                        </fieldset>
                        <div id="divanimal" class="d-block">
                            <div class="row">
                                    <legend class="col-form-label col-sm-3 pt-0">Nome: <font color="red"><strong>*</strong></font></legend>
                                    <div class="col-sm-5">
                                        <input name="nomedoanimal" type="text" id="nomedoanimal" maxlength="50" class="form-control" required />
                                    </div>
                            </div>
                            <br>
                            <div class="row">
                                    <legend class="col-form-label col-sm-3 pt-0">Data de nascimento: <font color="red"><strong>*</strong></font></legend>
                                    <div class="col-sm-5">
                                        <input name="dtnascanimal" type="date" id="dtnascanimal" maxlength="50" class="form-control" required>
                                    </div>
                            </div>
                            <br>
                            <div class="row">
                                    <legend class="col-form-label col-sm-3 pt-0">Peso aproximado (em kg): <font color="red"><strong>*</strong></font></legend>
                                    <div class="col-sm-5">
                                        <input name="peso" type="number" id="peso" maxlength="50" class="form-control" required />
                                    </div>
                            </div>
                            <br>
                            <div class="row">
                              <legend class="col-form-label col-sm-3 pt-0">Espécie: <font color="red"><strong>*</strong></font></legend>
                              <div class="col-sm-5">
                                                <? if ($especie =='Canina') {
                                                        echo "<div class='form-check'>";
                                                        echo "<input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' onclick='OnChangeRadio3 (this)' checked ><label class='form-check-label' for='gridRadios1' required >Canina</label>";
                                                        echo "</div>";
                                                    } elseif ($especie =='Felina') {
                                                        echo "<div class='form-check'>";
                                                        echo "<input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' onclick='OnChangeRadio4 (this)' checked><label class='form-check-label' for='gridRadios1'>Felina</label>";
                                                        echo "</div>";
                                                    } else {
                                                        echo "<div class='form-check'>";
                                                        echo "<input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' onclick='OnChangeRadio3 (this)' ><label class='form-check-label' for='gridRadios1' required >Canina</label>";
                                                        echo "</div>";
                                                        echo "<div class='form-check'>";
                                                        echo "<input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' onclick='OnChangeRadio4 (this)'><label class='form-check-label' for='gridRadios1'>Felina</label>";
                                                        echo "</div>";
                                                    }
                                                ?>
                               </div>
                            </div>
                            <br>
                            <div id="divcaninaraca" class="d-none">
                                <div class="row">
                                  <legend class="col-form-label col-sm-3 pt-0">Raça: <font color="red"><strong>*</strong></font></legend>
                                  <div class="col-sm-9">
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='caninaraca' id='SRD' value='SRD' checked ><label class='form-check-label' for='gridRadios1' required >Sem raça definida</label>
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='caninaraca' id='Pug' value='Pug' ><label class='form-check-label' for='gridRadios1' required >Pug</label>
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='caninaraca' id='Shih-tzu' value='Shih-tzu' ><label class='form-check-label' for='gridRadios1' required >Shih-tzu</label>
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='caninaraca' id='Lhasa Apso' value='Lhasa Apso' ><label class='form-check-label' for='gridRadios1' required >Lhasa Apso</label>
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='caninaraca' id='Pequinês' value='Pequinês' ><label class='form-check-label' for='gridRadios1' required >Pequinês</label>
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='caninaraca' id='Bulldog' value='Bulldog' ><label class='form-check-label' for='gridRadios1' required >Bulldog</label>
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='caninaraca' id='Outros' value='Outros' ><label class='form-check-label' for='gridRadios1' required >Outra raça</label>
                                        </div>
                                  </div>
                                </div>
                            </div>
                            <br>
                            <div id="divfelinaraca" class="d-none">
                                <div class="row">
                                  <legend class="col-form-label col-sm-3 pt-0">Raça: <font color="red"><strong>*</strong></font></legend>
                                  <div class="col-sm-9">
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='felinaraca' id='felinaraca' value='SRD' checked><label class='form-check-label' for='gridRadios1' required >Sem raça definida</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='felinaraca' id='felinaraca' value='Persa' ><label class='form-check-label' for='gridRadios1' required >Persa</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='felinaraca' id='felinaraca' value='Gato britânico' ><label class='form-check-label' for='gridRadios1' required >Gato britânico de pelo curto</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='felinaraca' id='felinaraca' value='Himalaio' ><label class='form-check-label' for='gridRadios1' required >Himalaio</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='felinaraca' id='felinaraca' value='Scottish fold' ><label class='form-check-label' for='gridRadios1' required >Scottish fold</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='felinaraca' id='felinaraca' value='Burmilla' ><label class='form-check-label' for='gridRadios1' required >Burmilla</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='felinaraca' id='felinaraca' value='Bombaim' ><label class='form-check-label' for='gridRadios1' required >Bombaim</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='felinaraca' id='felinaraca' value='Gato exótico de pelo curto' ><label class='form-check-label' for='gridRadios1' required >Gato exótico de pelo curto</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='felinaraca' id='felinaraca' value='Selkirk rex' ><label class='form-check-label' for='gridRadios1' required >Selkirk rex</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='felinaraca' id='felinaraca' value='Munchkin' ><label class='form-check-label' for='gridRadios1' required >Munchkin</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='felinaraca' id='felinaraca' value='Gato sagrado da birmânia' ><label class='form-check-label' for='gridRadios1' required >Gato sagrado da birmânia</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='felinaraca' id='felinaraca' value='Outros' ><label class='form-check-label' for='gridRadios1' required >Outros</label>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <br>
                            <div class="row">
                              <legend class="col-form-label col-sm-3 pt-0">Sexo: <font color="red"><strong>*</strong></font></legend>
                              <div class="col-sm-5">
                                        <? if ($sexo == 'Macho') {
                                                echo "<div class='form-check'>";
                                                echo "<input class='form-check-input' type='radio' name='sexo' id='Macho' value='Macho' checked><label class='form-check-label' checked>Macho </label>";
                                                echo "</div>";
                                            } elseif ($sexo == 'Fêmea') {
                                                echo "<div class='form-check'>";
                                                echo "<input class='form-check-input' type='radio' name='sexo' id='Fêmea' value='Fêmea' checked><label class='form-check-label'>Fêmea </label> ";
                                                echo "</div>";
                                            } else {
                                                echo "<div class='form-check'>";
                                                echo "<input class='form-check-input' type='radio' name='sexo' id='Macho' value='Macho' ><label class='form-check-label' checked>Macho </label>";
                                                echo "</div>";
                                                echo "<div class='form-check'>";
                                                echo "<input class='form-check-input' type='radio' name='sexo' id='Fêmea' value='Fêmea' ><label class='form-check-label' checked>Fêmea </label>";
                                                echo "</div>";
                                            }
                                        ?>
                                    </div>
                              </div>
                            <br>
                            <div class="row">
                              <legend class="col-form-label col-sm-3 pt-0">Porte: <font color="red"><strong>*</strong></font></legend>
                                <div class="col-sm-5">
                                        <? if ($porte == 'Pequeno') {
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno' checked> <label class='form-check-label' required>Pequeno (até 10kg)</label> &nbsp; &nbsp;";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio' > <label class='form-check-label'>Médio (11 a 25kg) </label> &nbsp; &nbsp;";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande' > <label class='form-check-label'>Grande (acima de 25 kg) </label> &nbsp; &nbsp;";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Gato' value='N/A' > <label class='form-check-label'>Gato </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                            } elseif ($porte == 'Médio'){
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno' > <label class='form-check-label' required>Pequeno (até 10kg)</label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio' checked> <label class='form-check-label'>Médio (11 a 25kg) </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande' > <label class='form-check-label'>Grande (acima de 25kg) </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Gato' value='N/A' > <label class='form-check-label'>Gato </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                            } elseif ($porte == 'Grande'){
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno' checked> <label class='form-check-label' required>Pequeno (até 10kg)</label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio' > <label class='form-check-label'>Médio (11 a 25kg) </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande' checked> <label class='form-check-label'>Grande (acima de 25kg) </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Gato' value='N/A' > <label class='form-check-label'>Gato </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                            } elseif ($porte == 'N/A'){
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno' checked> <label class='form-check-label' required>Pequeno (até 10kg)</label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio' > <label class='form-check-label'>Médio (11 a 25kg) </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande' > <label class='form-check-label'>Grande (acima de 25kg) </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Gato' value='N/A' checked> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                            } else {
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno' > <label class='form-check-label' required>Pequeno (até 10kg)</label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio' > <label class='form-check-label'>Médio (11 a 25kg) </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande' > <label class='form-check-label'>Grande (acima de 25kg) </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                                 echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='porte' id='Gato' value='N/A' > <label class='form-check-label'>Gato </label> &nbsp; &nbsp;";
                                                 echo "</div>";
                                            }
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-row d-block" id="divvettodos">
                                <div class="form-group col-md-8">
                                <legend class="col-form-label col-sm-6 pt-0">Escolha a veterinária de sua preferência<font color="red"><strong>*</strong></font></legend> 
                                <?
                                    $queryvetdog = "SELECT * FROM CLINICAS WHERE PROCEDIMENTOS <> '0' ORDER BY CLINICA ASC";
                                    $selectvetdog = mysqli_query($connect,$queryvetdog);
                                    
                                    while ($fetchvetdog = mysqli_fetch_row($selectvetdog)) {
                            					echo "<div class='form-check'>";
                                                 echo "<input class='form-check-input' type='radio' name='vettodos' id='vettodos' value='".$fetchvetdog[0]."' onclick='OnChangeRadio9 (this)' > <label class='form-check-label'>".$fetchvetdog[1]."</label> ";
                                                 echo "</div>";
                            		}
                                ?>
                        </div>
                    </div>
                    <div class="form-row d-none" id="divcastragratis">
                                <div class="form-group col-md-8">
                                    <input type="checkbox" class="form-check-input" id="gaarcastragratis" name="gaarcastragratis" value="gaarcastragratis">
                                    <label class="form-check-label" for="exampleCheck1">O GAAR irá custear o procedimento.</label>
                                </div>
                    </div>
                    <br>
                </fieldset>
            <br>
            <div id="dadosprotetor" class="d-block">
                        <center><h5>DADOS DO RESPONSÁVEL</h5></center>
                        <fieldset class="form-group">
                            <div id="divdadosprotetor" class="d-block">
                                <div class="row">
                                    <legend class="col-form-label col-sm-3 pt-0">Nome completo: <font color="red"><strong>*</strong></font></legend> 
                                    <div class="col-sm-5">
                                        <input name="nomedotutor" type="text" id="nomedotutor" maxlength="100" class="form-control" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <legend class="col-form-label col-sm-3 pt-0">Telefone: <font color="red"><strong>*</strong></font></legend> 
                                    <div class="col-sm-5">
                                        <input name="teldotutor" type="text" id="teldotutor" maxlength="20" class="form-control" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <legend class="col-form-label col-sm-3 pt-0">Email: <font color="red"><strong>*</strong></font></legend> 
                                    <div class="col-sm-5">
                                        <input name="emaildotutor" type="text" id="emaildotutor" maxlength="100" class="form-control" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <legend class="col-form-label col-sm-3 pt-0">Bairro: <font color="red"><strong>*</strong></font></legend> 
                                    <div class="col-sm-5">
                                        <input name="bairrodotutor" type="text" id="bairrodotutor" maxlength="100" class="form-control" required>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <label class="col-form-label col-sm-3 pt-0">Cidade: <font color="red">*</font></label>
                                        <div class="col-sm-4">
                                		          <select class="form-control"  name="cidadedotutor" id="cidadedotutor" required>
                                		              <option value="">Selecione</option>
                                		              <option value="Campinas" selected>Campinas</option>
                                		              <option value="Hortolândia">Hortolândia</option>
                                		          </select>
                                		</div>
                                </div>
                                <div class="alert alert-success d-none" role="alert" id="lblAlertSuccess_texto">
                                    <label class="col-sm-4 col-form-label" id="AlertSuccess_texto"></label> 
                                </div>
                                <div class="alert alert-danger d-none" role="alert" id="lblAlertDanger_texto">
                                    <danger><label class="col-sm-4 col-form-label" id="AlertDanger_texto"></danger> 
                                </div>
                                <br>
                                <div class="row" id="divquemvailevar">
                                    <legend class="col-form-label col-sm-3 pt-0">Quem vai levar o animal: <font color="red"><strong>*</strong></font></legend> 
                                    <div class="col-sm-5">
                                        <input name="quemvailevar" type="text" id="quemvailevar" maxlength="100" class="form-control" required>
                                        <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis</small>
                                    </div>
                                </div>
                                <br>
                                <div id="divvalorajuda" class="d-block">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-3 pt-0">Valor negociado: <font color="red"><strong>*</strong></font></legend>
                                        <div class="col-sm-5">
                                            <input name="valorajuda" type="text" id="valorajuda" maxlength="10" class="form-control" required />
                                            <small id="passwordHelpBlock" class="form-text text-muted">Caso o valor seja decimal, use ponto ao invés de vírgula.</small>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="divhorario" class="d-none">
                                        <div class="row">
                                                <legend class="col-form-label col-sm-3 pt-0">Tem alguma restrição de dia e/ou horário? <font color="red"><strong>*</strong></font></legend> 
                                                <div class="col-sm-5">
                                                            <div class='form-check'>
                                                                <input class='form-check-input' type='radio' name='horario' id='horario' value='Sim' onclick='OnChangeRadio5 (this)' ><label class='form-check-label' for='gridRadios1' required >Sim</label>
                                                            </div>
                                                            <div id="divhorarioobs" class="d-none">
                                                                <div class="form-group col-md-10">
                                                                    <label>Por favor informe: <font color="red"><strong>*</strong></font></label> 
                                                                    <input name="horariosim" type="text" id="horariosim" maxlength="100" class="form-control" required>
                                                                </div>    
                                                            </div>
                                                            <div class='form-check'>
                                                                <input class='form-check-input' type='radio' name='horario' id='horario' value='Não' onclick='OnChangeRadio6 (this)' checked><label class='form-check-label' for='gridRadios1'>Não</label>
                                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <br>
                            </div>
                            <br>
                            <div class="row d-block" id="divobservacao">
                                <legend class="col-form-label col-sm-3 pt-0">Observações: <font color="red"><strong>*</strong></font></legend> 
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="obs" cols="70" rows="5" id="obs"><?echo $obs ?></textarea></textarea>
                                    <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis</small>
                                </div>
                            </div>
                            <br>
                        </fieldset>
            </div>
            <div class="row d-none" id="divpedidointermedio">
                                <legend class="col-form-label col-sm-5 pt-0">Pedido intermediado por um voluntário do GAAR? <font color="red"><strong>*</strong></font></legend> 
                                <div class="col-sm-5">
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='volgaar' id='Sim' value='Sim' onclick='OnChangeRadio7 (this)' ><label class='form-check-label' for='gridRadios1' required >Sim</label>
                                            </div>
                                            <div id="divnomevolgaar" class="d-none">
                                                <div class="form-group col-md-10">
                                                    <label>Nome: <font color="red"><strong>*</strong></font></label> 
                                                    <select class='form-control' id='nomevolgaar' name='nomevolgaar' required>
                                         		        <option selected value=''>Selecione</option>
                                                    <?
                                                        $queryvol = "SELECT NOME FROM VOLUNTARIOS WHERE AREA = 'diretoria' ORDER BY NOME ASC";
                                                        $selectvol = mysqli_query($connect,$queryvol);
                                                        $reccount = mysqli_num_rows($selectvol);
                                                        
                                                        while ($fetchvol = mysqli_fetch_row($selectvol)) {
                                                					echo "<option value='".$fetchvol[0]."'>".$fetchvol[0]."</option>";
                                                		}
                                                    ?>
                                                    </select>
                                                </div>    
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='volgaar' id='Não' value='Não' onclick='OnChangeRadio8 (this)' checked><label class='form-check-label' for='gridRadios1'>Não</label>
                                            </div>
                                </div>
                            </div>
            <br>
            <div id="divenviar" class="d-block">
                <p><font color="red"><strong>* Campos obrigatórios</strong></font></p>
                <br>
                <center><a href="javascript:form.submit()" class="btn btn-primary">ENVIAR</a></center>
            </div>
    </div>
    </form>
    <br>
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
<?
}
mysqli_close($connect);
?>
</html>