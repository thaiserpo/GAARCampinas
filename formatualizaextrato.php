<?php
session_start();

include ("conexao.php");

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
		
		$id = $_GET['id'];
		
		$query = "SELECT * FROM LT WHERE ID = '$id'";
		$select = mysqli_query($connect,$query);
		$fetch = mysqli_fetch_row($select);	
		
		$nome = $fetch[1];
		$endereco = $fetch[2];
		$bairro = $fetch[3];
		$cidade = $fetch[4];
		$fixo = $fetch[5];
		$celular= $fetch[6];
		$email = $fetch[7];
		$especies = $fetch[8];
		$qtd_caes = $fetch[9];
		$qtd_gatos = $fetch[10];
		$valor_dia = $fetch[11];
		$responsavel = $fetch[12];
		$banco = $fetch[13];
		$agencia = $fetch[14];
		$conta = $fetch[15];
		$dv = $fetch[16];
		$cpf = $fetch[17];
		$ativo = $fetch[18];
		$qtde_vagas = $fetch[19];
		$vagas_disp = $fetch[20];
		
		
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
    
    <title>GAAR - Atualização de lar temporário</title>
    
    <script type="text/javascript">
                            
                            $(document).ready(function(){
                             $("#btnAtualizalt").click(function(){
                                
                            	$.ajax({
                                	url: "atualizalt.php",
                             		type: "POST",
                             		data: {
                             		    id_lt=document.getElementById("id").value,
                             		    nome_lt: document.getElementById("nomelt").value,
                             		    endereco_lt: document.getElementById("endereco").value,
                             		    bairro_lt: document.getElementById("bairro").value,
                             		    tel_fixo_lt: document.getElementById("tel_fixo").value,
                             		    celular_lt: document.getElementById("celular").value,
                             		    email_lt: document.getElementById("email").value,
                             		    especies_lt: document.getElementById("especies").value,
                             		    qtdecaes_lt: document.getElementById("qtdecaes").value,
                             		    qtdegatos_lt: document.getElementById("qtdegatos").value,
                             		    vagasdisp_lt: document.getElementById("vagasdisp").value,
                             		    resp_lt: document.getElementById("resp").value,
                             		    ativo_lt: document.getElementById("ativo").value,
                             		    ltpago_lt: document.getElementById("ltpago").value,
                             		    banco_lt: document.getElementById("bancolt").value,
                             		    agencia_lt: document.getElementById("agencialt").value,
                             		    conta_lt: document.getElementById("contalt").value,
                             		    dv_lt: document.getElementById("dvlt").value,
                             		    cpfcnpj_lt: document.getElementById("cpfcnpj").value,
                             		    valordiario_lt: document.getElementById("valordiario").value,
                             		    qtde_vagas_lt = document.getElementById("qtdevagas").value,
                             		},
                            		success: function(response){
                            		    document.getElementById('AlertSuccess_lt').innerHTML= document.getElementById("nomelt").value + " atualizado com sucesso";
                            		    document.getElementById('lblAlertSuccess_lt').className = "alert alert-success d-block";
                                    },
                                    error: function(response){
                                        document.getElementById('AlertDanger_lt').innerHTML= document.getElementById("nomelt").value + " não foi atualizado. Por favor tente novamente"; 
                                        document.getElementById('lblAlertDanger_lt').className = "alert alert-danger d-block";
                                    }
                            	});
                            });
                            
                             
                          });                        
                        
                            function OnChangeRadio (radio) {
                                        document.getElementById('agencialt').value  = "0";
                                        document.getElementById('contalt').value  = "0";
                                        document.getElementById('dvlt').value  = "0";
                                        document.getElementById('valordiario').value  = "0.0";
                                        document.getElementById('agencialt').disabled  = false;
                                        document.getElementById('contalt').disabled  = false;
                                        document.getElementById('dvlt').disabled  = false;
                                        document.getElementById('valordiario').disabled  = false;
                                        document.getElementById('bancolt').disabled  = false;
                                
                                }
                                
                            function OnChangeRadio2 (radio) {
                                        document.getElementById('agencialt').value  = "0";
                                        document.getElementById('contalt').value  = "0";
                                        document.getElementById('dvlt').value  = "0";
                                        document.getElementById('valordiario').value  = "0.0";
                                        document.getElementById('agencialt').disabled  = true;
                                        document.getElementById('contalt').disabled  = true;
                                        document.getElementById('dvlt').disabled  = true;
                                        document.getElementById('valordiario').disabled  = true;
                                        document.getElementById('bancolt').disabled  = true;
                                }
                                
                            function OnChangeRadio3 (radio) {
                                        document.getElementById('qtdegatos').value  = 0;
                                        document.getElementById('qtdegatos').disabled  = true;
                                        document.getElementById('qtdecaes').value  = "";
                                        document.getElementById('qtdecaes').disabled  = false;
                                }
                                
                            function OnChangeRadio4 (radio) {
                                        document.getElementById('qtdecaes').value  = 0;
                                        document.getElementById('qtdecaes').disabled  = true;
                                        document.getElementById('qtdegatos').value  = "";
                                        document.getElementById('qtdegatos').disabled  = false;
                                }
                                
                            function OnChangeRadio5 (radio) {
                                        document.getElementById('qtdecaes').value  = "";
                                        document.getElementById('qtdecaes').disabled  = false;
                                        document.getElementById('qtdegatos').value  = "";
                                        document.getElementById('qtdegatos').disabled  = false;
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
            <center>
        <h3>ATUALIZAÇÃO DE LAR TEMPORÁRIO</h3><br>
    </center>
    <form action="atualizalt.php" method="POST" enctype="multipart/form-data" name="form">
        <input name="id" type="text" id="id" maxlength="50" class="form-control" value="<? echo $id?>" hidden>
        <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Nome: </label> 
                            <input name="nomelt" type="text" id="nomelt" maxlength="50" class="form-control" value="<? echo $nome?>" required>
                        </div>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Endereço: </label> 
                            <input name="endereco" type="text" id="endereco" maxlength="200" class="form-control" value="<? echo $endereco?>" required>
                        </div>
                         <div class="form-group col-md-4">
                            <label>Bairro: </label> 
                            <input name="bairro" type="text" id="bairro" maxlength="30" class="form-control" value="<? echo $bairro?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cidade: </label> 
                            <input name="cidade" type="text" id="cidade" maxlength="20" class="form-control" value="<? echo $cidade?>" required>
                        </div>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Telefone fixo (com DDD): </label> 
                            <input name="telfixo" type="text" id="telfixo" maxlength="15" class="form-control" value="<? echo $fixo?>" required>
                        </div>
                         <div class="form-group col-md-4">
                            <label>Celular (com DDD): </label> 
                            <input name="celular" type="text" id="celular" maxlength="15" class="form-control" value="<? echo $celular?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>E-mail: </label> 
                            <input name="email" type="text" id="email" maxlength="100" class="form-control" value="<? echo $email?>" required>
                        </div>
        </div>
        <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Espécies sob guarda: </legend>
                      <div class="col-sm-10">
                          <? switch ($especies) {
                              case 'Apenas cães':
                                echo "<div class='form-check'>
                                        	<input class='form-check-input' type='radio' name='especies' id='Caes' value='Apenas cães' onclick='OnChangeRadio3 (this)' checked><label class='form-check-label' for='gridRadios1' required>Cães</label>
                                      </div>
                                      <div class='form-check'>
                                    	<input class='form-check-input' type='radio' name='especies' id='Gatos' value='Apenas gatos' onclick='OnChangeRadio4 (this)'><label class='form-check-label' for='gridRadios1'>Gatos</label>
                                      </div>
                                      <div class='form-check'>
                                    	<input class='form-check-input' type='radio' name='especies' id='CaeseGatos' value='Cães e gatos' onclick='OnChangeRadio5 (this)'><label class='form-check-label' for='gridRadios1'>Cães e gatos</label>
                                      </div>";
                                  break;
                              case 'Apenas gatos':
                                echo "<div class='form-check'>
                                        	<input class='form-check-input' type='radio' name='especies' id='Caes' value='Apenas cães' onclick='OnChangeRadio3 (this)'><label class='form-check-label' for='gridRadios1' required>Cães</label>
                                      </div>
                                      <div class='form-check'>
                                    	<input class='form-check-input' type='radio' name='especies' id='Gatos' value='Apenas gatos' onclick='OnChangeRadio4 (this)' checked><label class='form-check-label' for='gridRadios1'>Gatos</label>
                                      </div>
                                      <div class='form-check'>
                                    	<input class='form-check-input' type='radio' name='especies' id='CaeseGatos' value='Cães e gatos' onclick='OnChangeRadio5 (this)'><label class='form-check-label' for='gridRadios1'>Cães e gatos</label>
                                      </div>";
                                  break;
                              case 'Cães e gatos':
                                echo "<div class='form-check'>
                                        	<input class='form-check-input' type='radio' name='especies' id='Caes' value='Apenas cães' onclick='OnChangeRadio3 (this)'><label class='form-check-label' for='gridRadios1' required>Cães</label>
                                      </div>
                                      <div class='form-check'>
                                    	<input class='form-check-input' type='radio' name='especies' id='Gatos' value='Apenas gatos' onclick='OnChangeRadio4 (this)'><label class='form-check-label' for='gridRadios1'>Gatos</label>
                                      </div>
                                      <div class='form-check'>
                                    	<input class='form-check-input' type='radio' name='especies' id='CaeseGatos' value='Cães e gatos' onclick='OnChangeRadio5 (this)' checked ><label class='form-check-label' for='gridRadios1'>Cães e gatos</label>
                                      </div>";
                                  break;
                              default:
                                echo "<div class='form-check'>
                                        	<input class='form-check-input' type='radio' name='especies' id='Caes' value='Apenas cães' onclick='OnChangeRadio3 (this)'><label class='form-check-label' for='gridRadios1' required>Cães</label>
                                      </div>
                                      <div class='form-check'>
                                    	<input class='form-check-input' type='radio' name='especies' id='Gatos' value='Apenas gatos' onclick='OnChangeRadio4 (this)'><label class='form-check-label' for='gridRadios1'>Gatos</label>
                                      </div>
                                      <div class='form-check'>
                                    	<input class='form-check-input' type='radio' name='especies' id='CaeseGatos' value='Cães e gatos' onclick='OnChangeRadio5 (this)'><label class='form-check-label' for='gridRadios1'>Cães e gatos</label>
                                      </div>";
                                  break;
                              
                             }
                           ?>
                      </div>
                    </div>
                </fieldset>
        <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Quantidade de vagas total: </label> 
                            <input name="qtdevagas" type="text" id="qtdevagas" maxlength="10" class="form-control" value="<? echo $qtde_vagas?>" required>
                        </div>
                         <div class="form-group col-md-4">
                            <label>Quantidade de gatos: </label> 
                            <input name="qtdegatos" type="text" id="qtdegatos" maxlength="10" class="form-control" value="<? echo $qtd_gatos?>" required>
                        </div>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Quantidade de cães: </label> 
                            <input name="qtdecaes" type="text" id="qtdecaes" maxlength="10" class="form-control" value="<? echo $qtd_caes?>" required>
                        </div>
                         <div class="form-group col-md-4">
                            <label>Quantidade de gatos: </label> 
                            <input name="qtdegatos" type="text" id="qtdegatos" maxlength="10" class="form-control" value="<? echo $qtd_gatos?>" required>
                        </div>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Vagas disponíveis: </label> 
                            <input name="vagasdisp" type="text" id="vagasdisp" maxlength="10" class="form-control" value="<? echo $vagas_disp?>" required>
                        </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                            <label>Voluntário responsável: </label>
                            <select class="form-control" id="resp" name="resp" required>
                              <option selected value="<? echo $responsavel ?>"><? echo $responsavel ?></option>
                     		  <option value="">--------------------------</option>
                         		  <?
                        		 		$queryresp = "SELECT NOME FROM VOLUNTARIOS ORDER BY NOME ASC";
                        				$selectresp = mysqli_query($connect,$queryresp);
                        				
                        				while ($fetchresp = mysqli_fetch_row($selectresp)) {
                        					echo "<option value='".$fetchresp[0]."'>".$fetchresp[0]."</option>";
                        				}
                        				
                        				
                        		?>
                    	    </select>
                    	 </div>
        </div>
        <br>
        <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0"> Ativo? </legend>
                    <div class="col-sm-10">
                        <? switch ($ativo) {
                            case 'Sim':
                                echo "<div class='form-check'>
                                        				<input class='form-check-input' type='radio' name='ativo' id='ativo' value='Sim' checked><label class='form-check-label' for='gridRadios1' required>Sim</label>
                                       </div>
                                       <div class='form-check'>
                                        				<input class='form-check-input' type='radio' name='ativo' id='ativo' value='Não'><label class='form-check-label' for='gridRadios1' required >Não</label>
                                        </div>";
                                break;
                            case 'Não':
                                echo "<div class='form-check'>
                                        				<input class='form-check-input' type='radio' name='ativo' id='ativo' value='Sim'><label class='form-check-label' for='gridRadios1' required>Sim</label>
                                       </div>
                                       <div class='form-check'>
                                        				<input class='form-check-input' type='radio' name='ativo' id='ativo' value='Não' checked><label class='form-check-label' for='gridRadios1' required >Não</label>
                                        </div>";
                                break;
                            default:
                                echo "<div class='form-check'>
                                        				<input class='form-check-input' type='radio' name='ativo' id='ativo' value='Sim'><label class='form-check-label' for='gridRadios1' required>Sim</label>
                                       </div>
                                       <div class='form-check'>
                                        				<input class='form-check-input' type='radio' name='ativo' id='ativo' value='Não'><label class='form-check-label' for='gridRadios1' required >Não</label>
                                        </div>";
                                break;
                            
                        }
                        ?>
                    </div>
                </div>
        </fieldset>
        <br>
        <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0"> Lar temporário pago?</legend>
                    <div class="col-sm-10">
                        <? switch ($valor_dia) {
                                case '0':
                                    echo "<div class='form-check'>
                                            				<input class='form-check-input' type='radio' name='ltpago' id='ltpago' value='Sim' onclick='OnChangeRadio (this)' ><label class='form-check-label' for='gridRadios1' required>Sim</label>
                                          </div>
                                          <div class='form-check'>
                                            				<input class='form-check-input' type='radio' name='ltpago' id='ltpago' value='Não' onclick='OnChangeRadio2 (this)' checked><label class='form-check-label' for='gridRadios1' required >Não</label>
                                          </div>";
                                    break;
                                default:
                                    echo "<div class='form-check'>
                                            				<input class='form-check-input' type='radio' name='ltpago' id='ltpago' value='Sim' onclick='OnChangeRadio (this)' checked><label class='form-check-label' for='gridRadios1' required>Sim</label>
                                          </div>
                                          <div class='form-check'>
                                            				<input class='form-check-input' type='radio' name='ltpago' id='ltpago' value='Não' onclick='OnChangeRadio2 (this)' ><label class='form-check-label' for='gridRadios1' required >Não</label>
                                          </div>";
                                    break;
                                    
                            
                            }
                        ?>
                    </div>
                </div>
        </fieldset>
        </div>
                                <center><h5>DADOS PARA PAGAMENTO</h5></center>
        <div class="form-row">
                <div class="form-group col-md-3">
                            <label>Banco: </label> <br>
                                <select name="bancolt" id="bancolt" class="form-control">
                                  <? if ($banco !='') {
                                      echo "<option value='".$banco."'>".$banco."</option>";
                                      echo "<option value=''>--------------</option>";
                                  }
                                  ?>
                                  <option value="">Selecione</option>
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
                        <div class="form-group col-md-4">
                            <label>Agência: </label> 
                            <input name="agencialt" type="text" id="agencialt" maxlength="10" class="form-control" value="<? echo $agencia?>" required>
                        </div>
                         <div class="form-group col-md-4">
                            <label>Conta </label> 
                            <input name="contalt" type="text" id="contalt" maxlength="10" class="form-control" value="<? echo $conta?>" required>
                        </div>
                        <div class="form-group col-md-4">
                             <label>DV: </label>
                                <input name="dvlt" type="text" id="dvlt" maxlength="2" class="form-control" value="<? echo $dv?>" required>
                        </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                             <label>CPF/CNPJ: </label>
                                <input name="cpfcnpj" type="text" id="cpfcnpj" maxlength="30" class="form-control" value="<? echo $cpf?>" required>
            </div>
            <div class="form-group col-md-4">
                             <label>Valor pago por animal: </label>
                                <input name="valordiario" type="text" id="valordiario" maxlength="30" class="form-control" value="<? echo $valor_dia?>" required>
            </div>
        </div>
        <div class="form-group row">
                <center><button type="button" style="margin-left:2%;margin-right:auto;display:block;" class="btn btn-primary d-block" id="btnAtualizalt"> Atualizar </button></center>
        </div>
        <div class="alert alert-success d-none" role="alert" id="lblAlertSuccess_lt">
                 <label class="col-sm-4 col-form-label" id="AlertSuccess_lt">Lar temporário atualizado!</label> 
        </div>
        <div class="alert alert-danger d-none" role="alert" id="lblAlertDanger_lt">
          <danger><label class="col-sm-4 col-form-label" id="AlertDanger_lt">Lar temporário não cadastrado!</label>Por favor, tente novamente.</danger> 
        </div>
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