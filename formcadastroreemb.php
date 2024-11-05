<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA,NOME FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
				$nomevol = $fetcharea[2];
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
    
    <title>GAAR - Cadastro de lançamentos</title>
    
    <script type='text/javascript'>
         
            function OnChangeInput () {
                
                <?
                            $dom = new DOMDocument();
                            $doc->validateOnParse = true;
                            $dom->Loadhtml('formcadastrolanc.php');
                            
                            $datalanc = $dom->getElementById('dtlanci')->nodeValue;
                            
                            /*var_dump ($datalanc);*/
                        
                            $querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE DATA_LANC = '".$datalanc."' ORDER BY DATA_LANC ASC";
                    		$resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
                    		$reccount = mysqli_num_rows($resultlanc_dia_ano);
                ?>
                
                document.getElementById('divlanc').className  = "d-block";

            }

            function OnChangeRadio() {
                document.getElementById('divsocios').className  = "d-block";
                document.getElementById('divdesc').className  = "d-none";
                
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvalor').className  = "d-none";
                document.getElementById('divparcelam').className  = "d-none";
                document.getElementById('sem_reembolso').checked = true;
                
            }
            
            function OnChangeRadio2() {
                document.getElementById('divsocios').className  = "d-none";
                document.getElementById('divdesc').className  = "d-block";
                
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
            }
            
            function OnChangeRadio3() {
                document.getElementById('divreceitas').className  = "d-none";
                document.getElementById('divsocios').className  = "d-none";
                document.getElementById('divdesc').className  = "d-block";
                
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvet').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
            }
            
            function OnChangeRadio4() {
                document.getElementById('divreceitas').className  = "d-none";
                document.getElementById('divsocios').className  = "d-none";
                document.getElementById('divdesc').className  = "d-none";
                
                document.getElementById('divlt').className  = "d-block";
                document.getElementById('divvet').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
            }
            function OnChangeRadio5() {
                document.getElementById('divreceitas').className  = "d-none";
                document.getElementById('divsocios').className  = "d-none";
                document.getElementById('divdesc').className  = "d-none";
                
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvet').className  = "d-block";
                document.getElementById('divvalor').className  = "d-block";
                
            }
            
            function OnChangeRadio6() {
                document.getElementById('divreceitas').className  = "d-block";
                document.getElementById('divsocios').className  = "d-none";
                document.getElementById('divdesc').className  = "d-block";
                
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvet').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
                document.getElementById('desc').value = "Taxa de adoção";                
                document.getElementById('valor').value = "50.00";

            }
            
            function OnChangeRadio7() {
                document.getElementById('divreceitas').className  = "d-block";
                document.getElementById('divsocios').className  = "d-none";
                document.getElementById('divdesc').className  = "d-block";
                
                
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvet').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
                document.getElementById('desc').value = "JUROS - ANIVERSÁRIO";                

            }
            
            function OnChangeRadio8() {
                document.getElementById('divreceitas').className  = "d-none";
                document.getElementById('divsocios').className  = "d-none";
                document.getElementById('divdesc').className  = "d-block";
                
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvet').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
                document.getElementById('desc').value = "IMPOSTO DE RENDA";                

            }
            
            function OnChangeRadio9() {
                document.getElementById('divreceitas').className  = "d-block";
                document.getElementById('divsocios').className  = "d-none";
                document.getElementById('divdesc').className  = "d-block";
                
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvet').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
                document.getElementById('desc').value = "NFP - NOTA FISCAL PAULISTA";                

            }
            
            function OnChangeRadio10() {
                document.getElementById('desc').value = "Saldo em conta";                

            }

            function OnChangeRadio12() {
                document.getElementById('divsocios').className  = "d-none";
                document.getElementById('divdesc').className  = "d-block";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                document.getElementById('desc').value = "Doações"; 
                document.getElementById('sem_reembolso').checked = true;
                document.getElementById('semcomprovante').checked  = true;
                
            }

            function OnChangeCheckboxSem() {
                document.getElementById('divcomprovante').className  = "d-none";
                document.getElementById('comcomprovante').checked  = false;

            }
            
            function OnChangeCheckboxCom() {
                document.getElementById('divcomprovante').className  = "d-block";
                document.getElementById('semcomprovante').checked  = false;

            }
            
            function loadData(){
                document.getElementById('dtlanci').valueAsDate = new Date();
            }

    </script>
</head>
<body onload="loadData()">
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
           <br>
        <h3>CADASTRO DE LANÇAMENTO</h3><br>
        <p><label> É importante cadastrar o lançamento corretamente pois as informações aqui preenchidas irão ser usadas para realizar pagamentos, gerar estatísticas e relatórios.</label></p>
       </center>
  <form action="cadastroreemb.php" method="POST" enctype="multipart/form-data" name="form">
        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Data <font color="red"><strong>*</strong></font>: </label> 
                            <input type="date" id="dtlanci" name ="dtlanci" class="form-control" required onblur="OnChangeInput()">
                        </div>
        </div>
        
        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome do voluntário <font color="red"><strong>*</strong></font>: </label> 
                            <input type="text" id="nomevol" name ="nomevol" class="form-control" required value="<?echo $nomevol?>">
                        </div>
        </div>
        <br>
        <div class="form-group row">
                      <label class="col-sm-1 col-form-label">&nbsp;</label> 
                      <div class="col-sm-8">
                            <input type ="radio" id="subtipo" name="subtipo" value="Saldo em conta" onclick="OnChangeRadio10 (this)"><label class="form-check-label" for="gridRadios1" > Saldo em conta </label> <br>
                        </div>
        </div>
        <div class="form-group row">
                      <label class="col-sm-1 col-form-label">Receitas<font color="red"><strong>*</strong></font>: </label> 
                      <div class="col-sm-8">
                            <input type ="radio" id="subtipo" name="subtipo" value="Sócio" onclick="OnChangeRadio (this)"><label class="form-check-label" for="gridRadios1" > Sócio </label> <br>
                            <div id="divsocios" class="form-row d-none">
                                <select class="form-control" id="valorsocio" name="valorsocio" required>
                                    <?
                                        $querysocio = "SELECT * FROM SOCIO WHERE NOME <> '' ORDER BY NOME ASC";
                                        $selectsocio = mysqli_query($connect,$querysocio);
                            			while ($fetchsocio = mysqli_fetch_row($selectsocio)) {
                            					$idsocio = $fetchsocio[0];	
                            					$nomesocio = $fetchsocio[1];
                            					$agenciasocio = $fetchsocio[10];
                            					$contasocio = $fetchsocio[11];
                            					$valorsocio = $fetchsocio[5];
                                    			echo "<option value='".$idsocio."'>".$nomesocio." - doação de R$ ".$valorsocio."</option>";
                            			}
                                    ?>
                                </select>
                            </div>
                            <input type ="radio" id="subtipo" name="subtipo" value="Bazar" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1" > Bazar </label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="Doações" onclick="OnChangeRadio12 (this)"><label class="form-check-label" for="gridRadios1"> Doações </label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="Rifas" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1"> Rifas </label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="NFP" onclick="OnChangeRadio9 (this)"><label class="form-check-label" for="gridRadios1"> Nota Fiscal Paulista </label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="Vendas" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1"> Vendas </label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="Taxas de adoção" onclick="OnChangeRadio6 (this)"><label class="form-check-label" for="gridRadios1"> Taxas de adoção </label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="Juros" onclick="OnChangeRadio7 (this)"><label class="form-check-label" for="gridRadios1"> Juros </label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="Outras receitas" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1"> Outras receitas </label> <br>
                        </div>
                     </div>
        <div class="form-group row">
                    <label class="col-sm-1 col-form-label">Despesas<font color="red"><strong>*</strong></font>: </label> 
                      <div class="col-sm-8">
                            <input type ="radio" id="subtipo" name="subtipo" value="Lar temporário" onclick="OnChangeRadio4 (this)"><label class="form-check-label" for="gridRadios1"> Lar temporário</label> <br>
                            <div id="divlt" class="form-row d-none">
                                <select class="form-control" id="lt" name="lt" required>
                                <?
                                    $querylt = "SELECT * FROM LT ORDER BY LAR_TEMPORARIO ASC";
                                    $selectlt = mysqli_query($connect,$querylt);
                        			while ($fetchlt = mysqli_fetch_row($selectlt)) {
                        					$idlt = $fetchlt[0];	
                        					$nomelt = $fetchlt[1];
                        					$agencialt = $fetchlt[14];
                        					$contalt = $fetchlt[15];
                        					$dvlt = $fetchlt[16];
                                			echo "<option value='".$idlt."'>".$nomelt."</option>";
                        			}	
                                 ?>
                                 </select>
                            </div>
                            <input type ="radio" id="subtipo" name="subtipo" value="Ração" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1"> Ração </label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="Veterinário" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1"> Veterinário </label> <br>
                            <div id="divvet" class="form-row d-none">
                                <div class="form-group col-md-8">
                                <?
                                    $query = "SELECT * FROM CLINICAS ORDER BY CLINICA ASC";
                                    $select = mysqli_query($connect,$query);
                                    
                                    echo "<table class='table'>";
                                    echo "<thead class='thead-light'>";
                                    echo "<th scope='col'>&nbsp</th>";
                                	echo "<th scope='col'>Nome</th>";
                                	echo "<th scope='col'>Agência</th>";
                                	echo "<th scope='col'>Conta</th>";
                                	echo "</thead>";
                                	echo "<tbody>";
                        			while ($fetch = mysqli_fetch_row($select)) {
                        					$id = $fetch[0];	
                        					$nome = $fetch[1];
                        					$agencia = $fetch[19];
                        					$conta = $fetch[20];
                        					$dv = $fetch[21];
                                			echo "<tr>";
                                			echo "<td><input class='form-check-input' type='radio' name='vet' id='vet' value='".$nome."-".$agencia."-".$conta."-".$dv."'></td>";
                                			echo "<td>".$nome."</td>";
                                			echo "<td>".$agencia."</td>";
                                			echo "<td>".$conta."</td>";
                        					echo "</tr>";
                        			}	
                        			echo "</tbody>";
                        			echo "</table>";
                                ?>
                            </div>
                        </div>
                            <input type ="radio" id="subtipo" name="subtipo" value="Taxi dog" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1"> Táxi dog </label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="Medicamentos" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1"> Medicamentos (vacinas, vermífugos, etc)</label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="Compras" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1"> Compras </label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="Impostos" onclick="OnChangeRadio8 (this)"><label class="form-check-label" for="gridRadios1"> Impostos </label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="Ads redes" onclick="OnChangeRadio8 (this)"><label class="form-check-label" for="gridRadios1"> Posts patrocinados (redes sociais) </label> <br>
                            <input type ="radio" id="subtipo" name="subtipo" value="Outras despesas" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1"> Outras despesas </label> <br>
                        </div>
        </div>
        <div id ="divdesc" class="form-row d-block">
                        <div class="form-group col-md-6">
                            <label>Descrição<font color="red"><strong>*</strong></font>: </label> 
                            <textarea class="form-control" name="desc" cols="70" rows="10" id="desc" required></textarea>
                        </div>
        </div>
        <div id ="divvalor" class="form-row d-block">
        <div class="form-row">
            <div class="form-group col-md-6">
                  <label>Valor<font color="red"><strong>*</strong></font>: </label>
                  <div class="input-group-prepend">
                        <div class="input-group-text">R$</div>
                            <input type="text" class="form-control" type="text" id="valor" name="valor">
                  </div>
                  <small id="passwordHelpBlock" class="form-text text-muted">Ao invés da vírgula, colocar ponto</small>
            </div>
		    <div class="form-group col-md-6">
		            <? if ($subarea =='diretoria') {
		                echo "<label>Relatório contábil: </label>
		                      <div class='input-group-prepend'>
                                <div class='input-group-text'>R$</div>
                                    <input type='text' class='form-control'name='valorcont' id='valorcont'>
                                </div>
                              </div>";
		            }
                  ?>
            </div>
        </div>
    </div>
    <div id ="divparcelam" class="form-row d-block">
        <div class="form-group row">
              <label class="col-sm-2 col-form-label">Parcelamento <font color="red"><strong>*</strong></font>: </label> 
              <div class="col-sm-10">
                <select class="form-control" id="parcelamento" name="parcelamento" required>
                     		  <option selected value="">Selecione</option>
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
                    </select>
              </div>
            </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Tipo<font color="red"><strong>*</strong></font>: </label> 
      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reembolso" id="reembolso_expresso" value="Reembolso espresso"> <label class="form-check-label" required>Reembolso espresso (em até 24 horas)</label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">    
                            <input class="form-check-input" type="radio" name="reembolso" id="reembolso_normal" value="Reembolso normal"> <label class="form-check-label">Reembolso normal (próximo mês) </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reembolso" id="sem_reembolso" value="Sem reembolso"> <label class="form-check-label">Sem reembolso </label> &nbsp; &nbsp;
                        </div>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Banco<font color="red"><strong>*</strong></font>: </label> 
      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="banco" id="Banco Itaú" value="Banco Itaú"> <label class="form-check-label" required>Banco Itaú</label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">    
                            <input class="form-check-input" type="radio" name="banco" id="PagBank" value="PagBank"> <label class="form-check-label">PagBank</label> &nbsp; &nbsp;
                        </div>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Comprovante<font color="red"><strong>*</strong></font>: </label> 
      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="semcomprovante" id="semcomprovante" value="Sem comprovante" onclick="OnChangeCheckboxSem (this)"> <label class="form-check-label" required>Sem comprovante</label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">    
                            <input class="form-check-input" type="radio" name="comcomprovante" id="comcomprovante" value="Com comprovante" onclick="OnChangeCheckboxCom (this)"> <label class="form-check-label">Com comprovante</label> &nbsp; &nbsp;
                        </div>
                        <div id ="divcomprovante" class="form-row d-none">
                            <div class="form-row">
                                    <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="compr_compra" name="compr_compra">
                                            <label class="custom-file-label" for="validatedCustomFile">Escolher arquivo</label>
                                            <small id="passwordHelpBlock" class="form-text text-muted">Tamanho máximo: 1MB</small>
                                        </div>
                            </div>
                        </div>
      </div>
    </div>
    <br>
	    <font color="red"><strong>* Campos obrigatórios</strong></font><br>
        <center><a href="javascript:form.submit()" class="btn btn-primary">Cadastrar</a></center>
    </form>
      <br>
      <div class="form-group row">
                  <!--<div id="divlanc" class="d-none">-->
                  <div id="divlanc" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMOS LANÇAMENTOS CADASTRADOS</h4><br>
                    	<?
                    	    
                    	    $ano = date('Y');
                    		$mes_atu = date('m');
                    		
                    	   /* $querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE DATA_LANC LIKE '".$ano."-".$mes_atu."%' ORDER BY DATA_LANC ASC";*/
                    	    $querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE USUARIO='$login' ORDER BY ID DESC LIMIT 10";
                    		$resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
                    		$reccount = mysqli_num_rows($resultlanc_dia_ano);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Data</th>";
                            	echo "<th scope='col'>Descrição</th>";
                            	echo "<th scope='col'>Tipo</th>";
                            	echo "<th scope='col'>Valor</th>";
                            	echo "<th scope='col'>Link do comprovante</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
                    	            $idlanc = $fetchlanc_dia_ano[0];
                    				$dtlanc = $fetchlanc_dia_ano[1];
                    				$desclanc = $fetchlanc_dia_ano[2];
                    				$tipolanc = $fetchlanc_dia_ano[3];
                    				$valorsociolanc = $fetchlanc_dia_ano[4];
                    				$valorsociocont = $fetchlanc_dia_ano[7];
                    				$link_comprov = "http://www.gaarcampinas.org/docs/financeiro/".$fetchlanc_dia_ano[10];
                    				$sum = intval($sum) + intval($valorsociolanc);
                            			echo "<tr>";
                            			echo "<td>".$dtlanc."</td>";
                    					echo "<td>".$desclanc."</td>";
                    					echo "<td>".$tipolanc."</td>";
                    					if ($area =='diretoria'){
                                    	    echo "<td>R$ ".number_format($valorsociocont,2,',', '.')."</td>";
                                    	} else {
                                    	    echo "<td>R$ ".number_format($valorsociolanc,2,',', '.')."</td>";
                                    	}
                    					echo "<td><a href='".$link_comprov."' target='blank'>Download</a></td>";
                    					/*if ($area =='diretoria'){
                                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                                    	}
                                    	echo "<td><a href='formatualizalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Atualizar</a></td>";
                    					echo "<td>&nbsp;</td>";*/
                    				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<p>Nenhum lançamento encontrado para a data ".$datalanc."</p><br>";
                    		}
                    	?>
                    	</center>

    </div>
</main>
<br>
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
