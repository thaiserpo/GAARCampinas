<?php 		
		/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
		$login = $_SESSION['login'];
		
		if($login == "" || $login == null){
				  echo"<script language='javDESCript' type='text/javDESCript'>
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
    
    <link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">

    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/auto-refresh/bootstrap-table-auto-refresh.min.js"></script>
    <!--- BOOTSTRAP --->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--- BOOTSTRAP --->
    
    <title>GAAR - Repositório de documentos</title>
    
    <script type='text/javascript'>
         function OnChangeRadio1() {
                document.getElementById('divvalor').className  = "d-none";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('N/A').checked  = false;
          }
          
          function OnChangeRadio2() {
                document.getElementById('divvalor').className  = "d-block";
                document.getElementById('divlt').className  = "d-none";
                document.getElementById('N/A').checked  = false;
          }
          
          function OnChangeRadio3() {
                document.getElementById('N/A').checked  = true;
          }
          
          function OnChangeRadio4() {
                document.getElementById('divlt').className  = "d-block";
                document.getElementById('N/A').checked  = false;
          }
          
          $(document).ready(function(){
                $("#btnAdicionarDoc").click(function(){
                                
                            	$.ajax({
                                	url: "cadastrodoc.php",
                             		type: "POST",
                             		data: {
                             		    areadoc: document.getElementById("area").value,
                             		    bancodoc: document.getElementById("banco").value,
                             		    doc: document.getElementById("doc").value,
                             		    datadoc: document.getElementById("data").value,
                                        valordoc: document.getElementById("valor").value,
                                        subtipodoc: document.getElementById("subtipo").value

                             		},
                            		success: function(response){
                            		    //document.getElementById('AlertSuccess_docnome').innerHTML= document.getElementById("voluntarios").value + " cadastrado com sucesso";
                            		    document.getElementById('AlertSuccess_docnome').innerHTML= "Documento cadastrado com sucesso";
                            		    document.getElementById('lblAlertSuccess_doc').className = "alert alert-success d-block";
                                    },
                                    error: function(response){
                                        document.getElementById('AlertDanger_docnome').innerHTML= "Documento não foi cadastrado. Por favor tente novamente"; 
                                        document.getElementById('lblAlertDanger_doc').className = "alert alert-danger d-block";
                                    }
                            	});
                            });
          });
          
        function loadData(){
            document.getElementById('data').valueAsDate = new Date();
        }
          
     </script>
     <!--- GOOGLE ADSENSE --->
     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
     <!--- GOOGLE ADSENSE --->

</head>
<body onload="loadData()"> 
    <?php 
			 switch ($area) {
				  case 'operacional':
				    if ($subarea == 'lt'){
				        include_once("menu_lt.php") ;
				    }  else {
				        include_once("menu_operacional.php") ;  
				    }
				  	$query = "SELECT * FROM DOCUMENTACAO WHERE AREA_PRINCIPAL = 'Administração' or AREA_PRINCIPAL ='Operacional' ORDER BY DATA DESC";
        			$select = mysqli_query($connect,$query);
        			$reccount = mysqli_num_rows($select);
					break;
				  case 'diretoria':
				  	include_once("menu_diretoria.php") ;
				  	$query = "SELECT * FROM DOCUMENTACAO ORDER BY DATA DESC";
        			$select = mysqli_query($connect,$query);
        			$reccount = mysqli_num_rows($select);
        			/*$uploaddir = '/home/gaarcam1/public_html/docs/captacao/';*/
					break;
				  case 'captacao':
				  	include_once("menu_captacao.php") ;
				  	$query = "SELECT * FROM DOCUMENTACAO WHERE AREA_PRINCIPAL = 'Administração' or AREA_PRINCIPAL ='Captação' ORDER BY DATA DESC";
        			$select = mysqli_query($connect,$query);
        			$reccount = mysqli_num_rows($select);
					break;
     			  case 'financeiro':
				  	include_once("menu_financeiro.php") ;
				  	$query = "SELECT * FROM DOCUMENTACAO WHERE AREA_PRINCIPAL = 'Administração' or AREA_PRINCIPAL ='Captação' or AREA_PRINCIPAL ='Financeiro' ORDER BY DATA DESC";
        			$select = mysqli_query($connect,$query);
        			$reccount = mysqli_num_rows($select);
					break;
				  case 'admin':
				  	include_once("menu_admin.php") ;
				  	$query = "SELECT * FROM DOCUMENTACAO WHERE AREA_PRINCIPAL = 'Administração' ORDER BY DATA DESC";
        			$select = mysqli_query($connect,$query);
        			$reccount = mysqli_num_rows($select);
					break;
				  case 'comunicacao':
				  	include_once("menu_comunicacao.php") ;
				  	$query = "SELECT * FROM DOCUMENTACAO WHERE AREA_PRINCIPAL = 'Administração' or AREA_PRINCIPAL ='Comunicação' ORDER BY DATA DESC";
        			$select = mysqli_query($connect,$query);
        			$reccount = mysqli_num_rows($select);
					break;
				  
			  }
?>
<main role="main" class="container">
    <div class="starter-template">
        <center>
        <h3>CADASTRO DE DOCUMENTOS</h3><br>
        <p><label> É importante cadastrar o documento ou comprovante corretamente pois as informações aqui preenchidas irão ser usadas para realizar pagamentos, gerar estatísticas e relatórios.</label><br></p>
       </center>
    <form action="cadastrodoc.php" method="POST" enctype="multipart/form-data" name="form">
        <div class="form-group row">
                <label class="col-sm-3 col-form-label">Arquivo a ser carregado:<font color="red"><strong>*</strong></font>: </label> 
                <div class="col-sm-09">
                    <input type="file" class="form-control-file" id="doc" name="doc">
                    <small id="passwordHelpBlock" class="form-text text-muted"></small>
                </div>
        </div>
                <script>
                    // Add the following code if you want the name of the file appear on select
                    $(".custom-file-input").on("change", function() {
                      var fileName = $(this).val().split("\\").pop();
                      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                    });
                </script>
                      <p>Escolha a área em que o documento pertence para definir o nível de acesso:<font color="red"><strong>*</strong></font>: </p>
                      <p><strong>Administração: </strong>Apenas os voluntários da Administração poderão acessar. </p>
                      <p><strong>Captação: </strong>Apenas os voluntários da Captação poderão acessar. </p>
                      <p><strong>Comunicação: </strong>Apenas os voluntários da Comunicação poderão acessar. </p>
                      <p><strong>Financeiro: </strong>Apenas os voluntários da Financeiro poderão acessar. </p> 
                      <p><strong>Operacional: </strong>Apenas os voluntários da Operacional poderão acessar. </p>
                      <p><strong>Público: </strong>Todos poderão acessar (nível de documentação a ser disponibilizada no site). </p>
                      <p><strong>Todos: </strong>Todos os voluntários e sócios poderão acessar. </p>
                      
        <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Área<font color="red"><strong>*</strong></font>: </label> 
                      <div class="col-sm-09">
    	                <input type="radio" name="area" id="area" value="Administração" onclick="OnChangeRadio1 (this)">Administração <br>
            	        <input type="radio" name="area" id="area" value="Captação" onclick="OnChangeRadio1 (this)" >Captação <br>
            	        <input type="radio" name="area" id="area" value="Comunicação" onclick="OnChangeRadio1 (this)">Comunicação <br>
            	        <input type="radio" name="area" id="area" value="Financeiro" onclick="OnChangeRadio2 (this)" >Financeiro <br>
            	        <input type="radio" name="area" id="area" value="Operacional" onclick="OnChangeRadio1 (this)">Operacional <br>
            	        <input type="radio" name="area" id="area" value="Público" onclick="OnChangeRadio1 (this)">Público <br>
            	        <input type="radio" name="area" id="area" value="Todos" onclick="OnChangeRadio1 (this)">Todos <br>
            	     </div>
        </div>
        <div id ="divvalor" class="form-row d-none">
            <div class="form-row">
                <label class="col-sm-3 col-form-label">Data:<font color="red"><strong>*</strong></font>: </label> 
                <div class="col-sm-09">
                    <input type="date" class="form-control" id="data" name="data">
                </div>
            </div>
            <div class="form-row">
                <label class="col-sm-3 col-form-label">Valor:<font color="red"><strong>*</strong></font>: </label> 
                <div class="col-sm-09">
                    <input type="text" class="form-control" id="valor" name="valor">
                    <small id="passwordHelpBlock" class="form-text text-muted">Ao invés da vírgula, colocar ponto</small>
                </div>
            </div>
            <div class="form-group row">
                  <label class="col-sm-1 col-form-label">Categoria:<font color="red"><strong>*</strong></font>: </label> 
                  <div class="col-sm-8">
                        <input type ="radio" id="subtipo" name="subtipo" value="Sócio" ><label class="form-check-label" for="gridRadios1" > Sócio </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Bazar" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1" > Bazar </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Doações" onclick="OnChangeRadio12 (this)"><label class="form-check-label" for="gridRadios1"> Doações </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Rifas" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1"> Rifas </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="NFP" onclick="OnChangeRadio9 (this)"><label class="form-check-label" for="gridRadios1"> Nota Fiscal Paulista </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Vendas" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1"> Vendas </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Taxas" onclick="OnChangeRadio6 (this)"><label class="form-check-label" for="gridRadios1"> Taxas de adoção </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Juros" onclick="OnChangeRadio7 (this)"><label class="form-check-label" for="gridRadios1"> Juros </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Outras receitas" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1"> Outras receitas </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Lar temporário" onclick="OnChangeRadio4 (this)"><label class="form-check-label" for="gridRadios1"> Lar temporário</label> <br>
                        <div id="divlt" class="form-row d-none">
                                    <div class="form-group col-md-8">
                                        <select class="form-control" id="lt" name="lt" required>
                                            <option selected value="">Selecione</option>
                                        <?
                                            $querylt = "SELECT * FROM LT ORDER BY LAR_TEMPORARIO ASC";
                                            $selectlt = mysqli_query($connect,$querylt);
                                            
                                			while ($fetchlt = mysqli_fetch_row($selectlt)) {
                                					$id = $fetchlt[0];	
                                					$nome = $fetchlt[1];
                                					$banco = $fetchlt[13];
                                					$agencia = $fetchlt[14];
                                					$conta = $fetchlt[15];
                                					$dv = $fetchlt[16];
                                        			echo "<option value='".$nome."'>".$nome."</option>";
                                			}	
                                        ?>
                                        </select>
                                </div>
                        </div>
                        <input type ="radio" id="subtipo" name="subtipo" value="Ração" ><label class="form-check-label" for="gridRadios1"> Ração </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Veterinário" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1"> Veterinário </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Taxi dog" ><label class="form-check-label" for="gridRadios1"> Táxi dog </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Medicamentos" ><label class="form-check-label" for="gridRadios1"> Medicamentos (vacinas, vermífugos, etc)</label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Compras" ><label class="form-check-label" for="gridRadios1"> Compras </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Impostos" ><label class="form-check-label" for="gridRadios1"> Impostos </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Ads redes" onclick="OnChangeRadio8 (this)"><label class="form-check-label" for="gridRadios1"> Posts patrocinados (redes sociais) </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Transferência entre contas GAAR" onclick="OnChangeRadio8 (this)"><label class="form-check-label" for="gridRadios1"> Transferência entre contas GAAR </label> <br>
                        <input type ="radio" id="subtipo" name="subtipo" value="Outras despesas" ><label class="form-check-label" for="gridRadios1"> Outras despesas </label> <br>
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
                                <div class="form-check">    
                                    <input class="form-check-input" type="radio" name="banco" id="Mercado Pago" value="Mercado Pago"> <label class="form-check-label">Mercado Pago</label> &nbsp; &nbsp;
                                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tipo da arquivo<font color="red"><strong>*</strong></font>: </label> 
              <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoarq" id="Comprovante" value="Comprovante"> <label class="form-check-label" required>Comprovante</label> &nbsp; &nbsp;
                                </div>
                                <div class="form-check">    
                                    <input class="form-check-input" type="radio" name="tipoarq" id="NF-e" value="NF-e" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1" > Nota fiscal (NF-e) </label> <br>
                                </div>
               </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tipo da transação<font color="red"><strong>*</strong></font>: </label> 
              <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipotransf" id="PIX" value="PIX"> <label class="form-check-label" required>PIX</label> &nbsp; &nbsp;
                                </div>
                                <div class="form-check">    
                                    <input class="form-check-input" type="radio" name="tipotransf" id="DOC/TED" value="DOC/TED"> <label class="form-check-label">DOC/TED</label> &nbsp; &nbsp;
                                </div>
                                <div class="form-check">    
                                    <input class="form-check-input" type="radio" name="tipotransf" id="N/A" value="N/A"> <label class="form-check-label">Não se aplica</label> &nbsp; &nbsp;
                                </div>
              </div>
            </div>
        </div>

    	<div class="form-group row">
                <label class="col-sm-2 col-form-label">Descrição: </label> 
                <div class="col-sm-10">
                    <textarea class="form-control" name="descricao" cols="50" rows="5" id="descricao" required></textarea> 
                    <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis. Máximo 100 caracteres. Caso a descrição não seja preenchida, o nome do arquivo será a descrição do lançamento.</small>
                </div>
        </div>
        <div class="form-group row d-none">
            <button type="button" style="margin-left:2%;margin-right:auto;display:block;" class="btn btn-primary d-block" id="btnAdicionarDoc"> Adicionar</button>
        </div>
        <div class="alert alert-success d-none" role="alert" id="lblAlertSuccess_doc">
                     <label class="col-sm-4 col-form-label" id="AlertSuccess_docnome">Documento cadastrado!</label> 
        </div>
        <div class="alert alert-danger d-none" role="alert" id="lblAlertDanger_doc">
          <danger><label class="col-sm-4 col-form-label" id="AlertDanger_docnome">Documento não cadastrado!</label>Por favor, tente novamente.</danger> 
        </div>
    	<center><a href="javascript:form.submit()" class="btn btn-primary">Cadastrar</a></center>
    </form>
    <br>
    <hr/>
    <br>
    <p><h3><center>LISTA DE DOCUMENTOS DISPONÍVEIS</center></h3></p>
    <br>
<?php 			
		
		if ($reccount == 0) {
			echo "Nenhum evento encontrado <br><br>
				<a href='formcadastroadmin.php'class='btn btn-primary >Voltar</a>";
		}else{ 
			echo "<table class='table'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>ÁREA</th>";
			echo "<th colspan='2'>DESCRIÇÃO</th>";
			echo "<th colspan='1'>UPLOAD EM</th>";
			echo "<th colspan='1'>&nbsp;</th>";
			echo "</tr>";
			echo "</thead>";
			while ($fetch = mysqli_fetch_row($select)) {
					$id = $fetch[0];	
					$evento = $fetch[1];
					$data = $fetch[3];
					$descricao = $fetch[4];
					$doc = $fetch[6];
					$areadoc = $fetch[7];
					$valordoc = $fetch[9];
					$datacompra = $fetch[10];
					
					$ano_data = substr($data,0,4);
        		    $mes_data = substr($data,5,2);
        		    $dia_data = substr($data,8,2);
        		    
        		    $ano_compra = substr($datacompra,0,4);
        		    $mes_compra = substr($datacompra,5,2);
        		    $dia_compra = substr($datacompra,8,2);

					echo "<tbody>";
        			echo "<tr>";
        			echo "<th scope='row'>".$areadoc."</th>";
        			echo "<td>".$descricao."</td>";
        			/*echo "<td>R$ ".number_format($valordoc,2,',', '.')."</td>";*/
					echo "<td>";
					if ($areadoc == 'Administração'){
					    if ((strpos($descricao, 'prestacao') !== false) ||  (strpos($descricao, 'Prestação') !== false) || (strpos($descricao, 'prestação') !== false) || (strpos($doc, 'planilha_financeiro') !== false)) {
					        $dir = '/docs/financeiro/prestacaodecontas/';
					    } else {
					        $dir = '/docs/administracao/';
					    }
					} 
					if ($areadoc == 'Operacional'){
					    $dir = '/docs/operacional/';
					}
					if ($areadoc == 'Captação'){
					    $dir = '/docs/captacao/';
					}
					if ($areadoc == 'Comunicação'){
					    $dir = '/docs/comunicacao/';
					}
					
					if ($areadoc == 'Público'){
					    $dir = '/docs/publico/';
					}
					
					if ($areadoc == 'Financeiro'){
					    if ((strpos($descricao, 'prestacao') !== false) ||  (strpos($descricao, 'Prestação') !== false) || (strpos($descricao, 'prestação') !== false)) {
					        $dir = '/docs/financeiro/prestacaodecontas/';
					    } else {
					        $dir = '/docs/financeiro/';
					    }
					    
					}
					echo "<td>".$dia_data."/".$mes_data."/".$ano_data."</td>";
					/*echo "<td>".$dia_compra."/".$mes_compra."/".$ano_compra."</td>";*/
					echo "<td><a href='".$dir.$doc."' download> Download</a></td>";
					echo "<td><a href='".$dir.$doc."' target='_blank'> Visualizar</a></td>";
					echo "</tr>";
					echo "</tbody>";
			}
			echo "</table>";
		}
		
		mysqli_close($connect);
		}
?>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--- BOOTSTRAP --->
</body>
</html>

