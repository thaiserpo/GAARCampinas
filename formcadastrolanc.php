<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
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
            
            function OnClickSocio () {
                document.getElementById('desc').value = "Outros";
                document.getElementById('divdesc').className  = "d-block";
                document.getElementById('divvalor').className  = "d-block";
                
            }
            
            function OnChangeRadio() {
                if (document.getElementById('bancoitau').checked){
                    document.getElementById('divsociosbb').className  = "d-none";
                    document.getElementById('divsociositau').className  = "d-block";
                    
                }
                if (document.getElementById('bancobb').checked){
                    document.getElementById('divsociosbb').className  = "d-block";
                    document.getElementById('divsociositau').className  = "d-none";
                    
                }
                document.getElementById('divdesc').className  = "d-none";
                document.getElementById('divdespesas').className  = "d-none";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
            }
            
            function OnChangeRadio2() {
                document.getElementById('divsociosbb').className  = "d-none";
                document.getElementById('divsociositau').className  = "d-none";
                document.getElementById('divdesc').className  = "d-block";
                document.getElementById('divdespesas').className  = "d-none";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
            }
            
            function OnChangeRadio3() {
                document.getElementById('divreceitas').className  = "d-none";
                document.getElementById('divsociosbb').className  = "d-none";
                document.getElementById('divdesc').className  = "d-block";
                document.getElementById('divdespesas').className  = "d-block";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvet').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
            }
            
            function OnChangeRadio4() {
                document.getElementById('divreceitas').className  = "d-none";
                document.getElementById('divsociosbb').className  = "d-none";
                document.getElementById('divdesc').className  = "d-none";
                document.getElementById('divdespesas').className  = "d-block";
                document.getElementById('divlt').className  = "d-block";
                document.getElementById('divvet').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
            }
            function OnChangeRadio5() {
                document.getElementById('divreceitas').className  = "d-none";
                document.getElementById('divsociosbb').className  = "d-none";
                document.getElementById('divdesc').className  = "d-none";
                document.getElementById('divdespesas').className  = "d-block";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvet').className  = "d-block";
                document.getElementById('divvalor').className  = "d-block";
                
            }
            
            function OnChangeRadio6() {
                document.getElementById('divreceitas').className  = "d-block";
                document.getElementById('divsociosbb').className  = "d-none";
                
                
                document.getElementById('divdesc').className  = "d-block";
                
                document.getElementById('divdespesas').className  = "d-none";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvet').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
                document.getElementById('desc').value = "Taxa de adoção";                
                document.getElementById('valor').value = "50.00";

            }
            
            function OnChangeRadio7() {
                document.getElementById('divreceitas').className  = "d-block";
                document.getElementById('divsociosbb').className  = "d-none";
                document.getElementById('divdesc').className  = "d-block";
                
                document.getElementById('divdespesas').className  = "d-none";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvet').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
                document.getElementById('desc').value = "JUROS - ANIVERSÁRIO";                

            }
            
            function OnChangeRadio8() {
                document.getElementById('divreceitas').className  = "d-none";
                document.getElementById('divsociosbb').className  = "d-none";
                document.getElementById('divsociositau').className  = "d-none";
                document.getElementById('divdesc').className  = "d-block";
                document.getElementById('divdespesas').className  = "d-block";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvet').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
                document.getElementById('desc').value = "IMPOSTO DE RENDA";                

            }
            
            function OnChangeRadio9() {
                document.getElementById('divreceitas').className  = "d-block";
                document.getElementById('divsociosbb').className  = "d-none";
                document.getElementById('divsociositau').className  = "d-none";
                document.getElementById('divdesc').className  = "d-block";
                document.getElementById('divdespesas').className  = "d-none";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('divvet').className  = "d-none";
                document.getElementById('divvalor').className  = "d-block";
                
                document.getElementById('desc').value = "NFP - NOTA FISCAL PAULISTA";                

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
           <br>
        <h3>CADASTRO DE LANÇAMENTOS BANCÁRIOS</h3><br>
        <p><label> É importante cadastrar o lançamento corretamente pois as informações aqui preenchidas irão ser usadas para realizar pagamentos, gerar estatísticas e relatórios.</label></p>
       </center>
  <form action="cadastrolanc.php" method="POST" enctype="multipart/form-data" name="form">
        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Data <font color="red"><strong>*</strong></font>: </label> 
                            <input type="date" id="dtlanci" name ="dtlanci" class="form-control" required onblur="OnChangeInput()">
                        </div>
        </div>
        
        <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Banco da operação<font color="red"><strong>*</strong></font>:</legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input type ="radio" id="bancoitau" name ="banco" value="Banco Itaú"><label class="form-check-label" for="gridRadios1"> Banco Itaú</label> <br>
                            <input type ="radio" id="bancobb" name ="banco" value="Banco do Brasil"><label class="form-check-label" for="gridRadios1">Banco do Brasil</label> <br>
                           <!-- <input type ="radio"id="banco" name ="banco" value="Pagseguro"><label class="form-check-label" for="gridRadios1">Pagseguro</label></label> <br>
                            <input type ="radio"id="banco" name ="banco" value="Apoiese"><label class="form-check-label" for="gridRadios1">Apoia.se</label> <br>-->
                        </div>
                      </div>
        </div>
        <br>
        <fieldset class="form-group">
                <div id="divreceitas" class="form-row d-block">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Receitas<font color="red"><strong>*</strong></font>: </legend>
                      <div class="col-sm-08">
                        <div class="form-check">
                            <input type ="radio" id="tipo" name ="tipo" value="Sócio" onclick="OnChangeRadio(this)"><label class="form-check-label" for="gridRadios1" > Sócio </label> <br>
                            <div id="divsociosbb" class="form-row d-none">
                                <div class="form-group col-md-08">
                                    <?
                                        $query = "SELECT * FROM SOCIO WHERE AGENCIA <> '' and FORMA_AJUDAR = 'Banco do Brasil' ORDER BY NOME ASC";
                                        $select = mysqli_query($connect,$query);
                                        
                                        echo "<table class='table'>";
                                        echo "<thead class='thead-light'>";
                                        echo "<th scope='col'>&nbsp</th>";
                                    	echo "<th scope='col'>Nome</th>";
                                    	echo "<th scope='col'>Agência</th>";
                                    	echo "<th scope='col'>Conta</th>";
                                    	echo "<th scope='col'>Valor</th>";
                                    	echo "</thead>";
                                    	echo "<tbody>";
                            			while ($fetch = mysqli_fetch_row($select)) {
                            					$id = $fetch[0];	
                            					$nome = $fetch[1];
                            					$agencia = $fetch[10];
                            					$conta = $fetch[11];
                            					$valorsocio = $fetch[5];
                                    			echo "<tr>";
                                    			echo "<td><input class='form-check-input' type='radio' name='valorsocio' id='valorsocio' value='".$nome.",".$valorsocio."'></td>";
                                    			echo "<td>".$nome."</td>";
                                    			echo "<td>".$agencia."</td>";
                                    			echo "<td>".$conta."</td>";
                                    			echo "<td>R$ ".number_format($valorsocio,2,',', '.')."</td>";
                            					echo "</tr>";
                            			}
                            			echo "<tr>";
                            			echo "<td><input class='form-check-input' type='radio' name='socio' id='socio' value='Outros' onclick='OnClickSocio(this)'>Outros</td>";
                            			echo "</tr>";
                            			echo "</tbody>";
                            			echo "</table>";
                                    ?>
                                </div>
                            </div>
                            <div id="divsociositau" class="form-row d-none">
                                <div class="form-group col-md-08">
                                    <?
                                        $query = "SELECT * FROM SOCIO WHERE AGENCIA <> '' and FORMA_AJUDAR = 'Banco Itaú' ORDER BY NOME ASC";
                                        $select = mysqli_query($connect,$query);
                                        
                                        echo "<table class='table'>";
                                        echo "<thead class='thead-light'>";
                                        echo "<th scope='col'>&nbsp</th>";
                                    	echo "<th scope='col'>Nome</th>";
                                    	echo "<th scope='col'>Agência</th>";
                                    	echo "<th scope='col'>Conta</th>";
                                    	echo "<th scope='col'>Valor</th>";
                                    	/*echo "<th scope='col'>Novo valor</th>";*/
                                    	
                                    	echo "</thead>";
                                    	echo "<tbody>";
                            			while ($fetch = mysqli_fetch_row($select)) {
                            					$id = $fetch[0];	
                            					$nome = $fetch[1];
                            					$agencia = $fetch[10];
                            					$conta = $fetch[11];
                            					$valorsocio = $fetch[5];
                                    			echo "<tr>";
                                    			echo "<td><input class='form-check-input' type='radio' name='valorsocio' id='valorsocio' value='".$nome.",".$valorsocio."'></td>";
                                    			echo "<td>".$nome."</td>";
                                    			echo "<td>".$agencia."</td>";
                                    			echo "<td>".$conta."</td>";
                                    			echo "<td>R$ ".number_format($valorsocio,2,',', '.')."</td>";
                                    			/*echo "<td>R$ <input type='text' class='form-control' id='novovalor' name='novovalor' value='".$valorsocio."' disabled></td>";*/
                            					echo "</tr>";
                            			}	
                            			echo "<tr>";
                            			echo "<td><input class='form-check-input' type='radio' name='socio' id='socio' value='Outros' onclick='OnClickSocio(this)'>Outros</td>";
                            			echo "</tr>";
                            			echo "</tbody>";
                            			echo "</table>";
                                    ?>
                                </div>
                            </div>
                            <input type ="radio" id="tipo" name ="tipo" value="Bazar" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1" > Bazar </label> <br>
                            <input type ="radio" id="tipo" name ="tipo" value="Doações" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1"> Doações </label> <br>
                            <input type ="radio" id="tipo" name ="tipo" value="Rifas" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1"> Rifas </label> <br>
                            <input type ="radio" id="tipo" name ="tipo" value="NFP" onclick="OnChangeRadio9 (this)"><label class="form-check-label" for="gridRadios1"> Nota Fiscal Paulista </label> <br>
                            <input type ="radio" id="tipo" name ="tipo" value="Vendas" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1"> Vendas </label> <br>
                            <input type ="radio" id="tipo" name ="tipo" value="Taxas" onclick="OnChangeRadio6 (this)"><label class="form-check-label" for="gridRadios1"> Taxas de adoção </label> <br>
                            <input type ="radio" id="tipo" name ="tipo" value="Juros" onclick="OnChangeRadio7 (this)"><label class="form-check-label" for="gridRadios1"> Juros </label> <br>
                            <input type ="radio" id="tipo" name ="tipo" value="Outros-receitas" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1"> Outras receitas </label> <br>
                        </div>
                     </div>
                    </div>
                </div>
                    <br>
                    <div id="divdespesas" class="form-row d-block">
                        <div class="row">
                          <legend class="col-form-label col-sm-2 pt-0">Despesas<font color="red"><strong>*</strong></font>: </legend>
                          <div class="col-sm-10">
                            <div class="form-check">
                                <input type ="radio" id="tipo" name ="tipo" value="LT" onclick="OnChangeRadio4 (this)"><label class="form-check-label" for="gridRadios1"> Lar temporário</label> <br>
                                <div id="divlt" class="form-row d-none">
                                    <div class="form-group col-md-8">
                                    <?
                                        $query = "SELECT * FROM LT ORDER BY LAR_TEMPORARIO ASC";
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
                            					$banco = $fetch[13];
                            					$agencia = $fetch[14];
                            					$conta = $fetch[15];
                            					$dv = $fetch[16];
                                    			echo "<tr>";
                                    			echo "<td><input class='form-check-input' type='radio' name='lt' id='lt' value='".$nome."-".$agencia."-".$conta."-".$dv."'></td>";
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
                                <input type ="radio" id="tipo" name ="tipo" value="Ração" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1"> Ração </label> <br>
                                <input type ="radio" id="tipo" name ="tipo" value="Veterinário" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1"> Veterinário </label> <br>
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
                            					$banco = $fetch[18];
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
                                <input type ="radio" id="tipo" name ="tipo" value="Taxi dog" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1"> Táxi dog </label> <br>
                                <input type ="radio" id="tipo" name ="tipo" value="Medicamentos" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1"> Medicamentos (vacinas, vermífugos, etc)</label> <br>
                                <input type ="radio" id="tipo" name ="tipo" value="Compras" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1"> Compras </label> <br>
                                <input type ="radio" id="tipo" name ="tipo" value="Impostos" onclick="OnChangeRadio8 (this)"><label class="form-check-label" for="gridRadios1"> Impostos </label> <br>
                                <input type ="radio" id="tipo" name ="tipo" value="Outros-despesas" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1"> Outras despesas </label> <br>
                            </div>
                         </div>
                        </div>
                    </div>
                    <br>
                </fieldset>
     <div id ="divdesc" class="form-row d-block">
                        <div class="form-group col-md-6">
                            <label>Descrição: </label> 
                            <input type="text" id="desc" maxlength="500" name ="desc" class="form-control" required>
                        </div>
        </div>
    <div id ="divvalor" class="form-row d-block">
     <div class="form-row">
            <div class="form-group col-md-6">
                  <label>Valor (ou novo valor para sócios)<font color="red"><strong>*</strong></font>: </label>
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
    <div class="form-row">
            <label>Recibo ou comprovante: </label>
            <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" name="file">
                    <label class="custom-file-label" for="validatedCustomFile">Escolher arquivo</label>
                </div>
    </div><br>
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
                    	    $querylanc_dia_ano = "SELECT * FROM FINANCEIRO ORDER BY ID DESC LIMIT 10";
                    		$resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
                    		$reccount = mysqli_num_rows($resultlanc_dia_ano);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Data</th>";
                            	echo "<th scope='col'>Descrição</th>";
                            	echo "<th scope='col'>Tipo</th>";
                            	echo "<th scope='col'>Valor</th>";
                            	echo "<th scope='col'>Banco</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
                    	            $idlanc = $fetchlanc_dia_ano[0];
                    				$dtlanc = $fetchlanc_dia_ano[1];
                    				$desclanc = $fetchlanc_dia_ano[2];
                    				$tipolanc = $fetchlanc_dia_ano[3];
                    				$valorsociolanc = $fetchlanc_dia_ano[4];
                    				$valorsociocont = $fetchlanc_dia_ano[7];
                    				$bancolanc = $fetchlanc_dia_ano[6];
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
                    					echo "<td>".$bancolanc."</td>";
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
