<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT * FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[5];
				$nomevol = $fetcharea[2];
		}
		
		$id = $_GET['id'];
		
            /*$query = "SELECT * FROM VENDAS_PRODUTOS WHERE ID = '$id'";
    		$select = mysqli_query($connect,$query);
    		$reccount = mysqli_num_rows($select);
    			
    		while ($fetch = mysqli_fetch_row($select)) {
    					$nome = $fetch[1];
    					$celular = $fetch[2];
    					$dtentrega = $fetch[3];
    					$produto = $fetch[4];
    					$qtde  = $fetch[5];
    					$dtvenda = $fetch[6];
    					$qtdevendida = $fetch[7];
    		}*/


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
    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Cadastro de vendas de produtos</title>
    
    <script type="text/javascript">
         
         function OnChangeSelect () {
             
                    var select = document.getElementById('prodvenda');
                    var str = select.options[select.selectedIndex].value;
                    
                       switch (str){
                           case "Calendário modelo mesa":
                           case "Calendário modelo parede":
                                    document.getElementById('divcalendar').className  = "d-block";
                                    document.getElementById('divstatus').className  = "d-none";
                                    break;
                           default:
                                    document.getElementById('divcalendar').className  = "d-none";
                                    document.getElementById('divstatus').className  = "d-block";
                                    break;
                       }
         }
         
         function OnChangeRadio1 () {
                document.getElementById('divcliente').className  = "d-none";
                document.getElementById('divpontovenda').className  = "d-none";
                document.getElementById('divstatus').className  = "d-block";
                document.getElementById('divbotao').className  = "d-block";
                
                document.getElementById('Entregue').checked = true;
         }
         
         function OnChangeRadio2 () {
                document.getElementById('divcliente').className  = "d-block";
                document.getElementById('divvenda').className  = "d-block";
                document.getElementById('divbotao').className  = "d-block";
                document.getElementById('Entregue').checked = true;
                document.getElementById('MercadoPago').checked = true;
         }
         function OnChangeRadio3 () {
                document.getElementById('divfrete').className  = "d-block";
         }
         function OnChangeRadio4 () {
                document.getElementById('divfrete').className  = "d-none";
         }
         
         function OnChangeRadio5 () {
                document.getElementById('divpontovenda').className  = "d-block";
                document.getElementById('divvenda').className  = "d-block";
                document.getElementById('divbotao').className  = "d-block";
                document.getElementById('divfrete').className  = "d-none";
                document.getElementById('divcalendar').className  = "d-none";
                document.getElementById('Ponto de venda').checked = true;
                document.getElementById('DOCTED').checked = true;
                
         }
         
         function OnChangeRadio6 () {
                document.getElementById('divcliente').className  = "d-block";
                document.getElementById('divvenda').className  = "d-block";
                document.getElementById('divbotao').className  = "d-block";
                document.getElementById('divfrete').className  = "d-none";
                document.getElementById('divcalendar').className  = "d-none";
                document.getElementById('divpontovenda').className  = "d-none";
                document.getElementById('Ponto de venda').checked = true;
                document.getElementById('DOCTED').checked = true;
                
         }
         
         function loadData(){
            document.getElementById('dtvenda').valueAsDate = new Date();
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
        <h3>CADASTRO DE VENDAS DE PRODUTOS</h3><br>
        <p><label> </label></p>
       </center>
    <form name="form" method="post" action="cadastrovendaprod.php" enctype="multipart/form-data" name="form">
        <input name="id" type="text" id="id" class="form-control" value="<? echo $id ?>" hidden>
        <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Local da venda: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="localvenda" id="Feira de adoção" value="Feira de adoção" onclick="OnChangeRadio1 (this)"><label class="form-check-label" for="gridRadios1" required>Feira de adoção</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="localvenda" id="Pontodevenda" value="Ponto de venda" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1">Ponto de venda</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="localvenda" id="Loja virtual" value="Loja virtual" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1">Loja virtual</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="localvenda" id="Outros" value="Outros" onclick="OnChangeRadio6 (this)"><label class="form-check-label" for="gridRadios1">Outros</label>
                        </div>
                      </div>
                    </div>
        </fieldset>
        <div class="form-row d-none" id="divcliente">
            <center><h5>DADOS DO CLIENTE</h5></center>
            <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nome do cliente ou voluntário: </label> 
                          <div class="col-sm-5">
                            <input name="nome" type="text" id="nome" maxlength="50" required class="form-control" value="<? echo $nome ?>"> 
                          </div>
            </div>
             <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Celular: </label> 
                          <div class="col-sm-5">
                            <input name="celular" type="text" id="nome" required class="form-control" value="<? echo $celular ?>" maxlength="20"> 
                            <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (com DDD e sem espaços)</small>
                          </div>
            </div>
             <div class="form-group row">
                          <label class="col-sm-3 col-form-label">E-mail: </label> 
                          <div class="col-sm-5">
                            <input name="email" type="email" id="email" size="80" maxlength="100" required class="form-control" value="<? echo $email ?>"> 
                            <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (com DDD e sem espaços)</small>
                          </div>
            </div>
        <br>
        </div>
        <div class="form-row d-none" id="divpontovenda">
            <center><h5>DADOS DA ENCOMENDA</h5></center>
            <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Fornecedor: </label> 
                          <div class="col-sm-4">
                            <select class="form-control" id="fornecedor" name="fornecedor" required> 
                                <option selected value="">Selecione</option>
                             		  <?
                             		  
                             		    $queryfornec = "SELECT * FROM FORNECEDORES ORDER BY NOME_FORNEC ASC";
                                		$selectfornec = mysqli_query($connect,$queryfornec);
                                		$reccountfornec = mysqli_num_rows($selectfornec);
                                			
                                		while ($fetchfornec = mysqli_fetch_row($selectfornec)) {
                                					echo "<option value='".$fetchfornec[0]."'>".$fetchfornec[1]."</option>";
                                		}
                             		  
                             		  ?>
                            	    </select>
                          </div>
            </div>
        <br>
        </div>
        <div class="form-row d-none" id="divvenda">
            <center><h5>DADOS DA VENDA</h5></center>
            <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Data: </label> 
                          <div class="col-sm-3">
                            <input name="dtvenda" type="date" id="dtvenda" required class="form-control" >
                          </div>
            </div>
            <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Pedido na Loja Integrada: </label> 
                          <div class="col-sm-3">
                            <input name="pedidolojaintegrada" type="text" id="pedidolojaintegrada" required class="form-control" >
                          </div>
            </div>
            <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Produto: </label> 
                          <div class="col-sm-4">
                            <select class="form-control" id="prodvenda" name="prodvenda" required onchange="OnChangeSelect()" > 
                                <option selected value="">Selecione</option>
                             		  <?
                             		  
                             		    $query = "SELECT * FROM CONTROLE_ESTOQUE ORDER BY PRODUTO ASC";
                                		$select = mysqli_query($connect,$query);
                                		$reccount = mysqli_num_rows($select);
                                			
                                		while ($fetch = mysqli_fetch_row($select)) {
                                					echo "<option value='".$fetch[0]."'>".$fetch[1]." - ".$fetch[7]." - ".$fetch[8]." - modelo ".$fetch[9]." - cor interna ".$fetch[10]."</option>";
                                		}
                             		  
                             		  ?>
                            	    </select>
                            
                          </div>
            </div>
            <div class="form-group row">
                                  <legend class="col-form-label col-sm-3 pt-0">Fundo da estampa: </legend>
                                  <div class="col-sm-09">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="fundoestampa" id="Branco" value="Branco"> <label class="form-check-label">Branco </label> &nbsp; &nbsp;<br>
                                        <input class="form-check-input" type="radio" name="fundoestampa" id="Original" value="Original"> <label class="form-check-label">Original </label> &nbsp; &nbsp;<br>
                                    </div>
                                   </div>
                                
                             </div>
            <div class="form-group row">
                          <div id="divcalendar" class="d-none">
                                        <center><h5>DADOS DO CLIENTE</h5></center><BR>
                                        <div class="form-group row">
                                                      <label class="col-sm-1 col-form-label">CPF/CNPJ: </label> 
                                                      <div class="col-sm-5">
                                                       <input name="cpfcnpj" type="text" id="cpfcnpj" maxlength="30" required class="form-control">
                                                      </div>
                                        </div>
                                        <div class="form-group row">
                                                      <label class="col-sm-1 col-form-label">Quantidade: </label> 
                                                      <div class="col-sm-2">
                                                        <input name="qtde" type="text" id="qtde" maxlength="10" required class="form-control">
                                                      </div>
                                                      <br>
                                                      <label class="col-sm-2 col-form-label">Valor do frete: </label> 
                                                      <div class="col-sm-2">
                                                        <input name="frete" type="text" id="frete" maxlength="10" required class="form-control">
                                                      </div>
                                                      <small id="passwordHelpBlock" class="form-text text-muted">Ao invés da vírgula, colocar ponto</small>
                                                      <br>
                                                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="foto">
                                                        <label class="custom-file-label" for="validatedCustomFile">Comprovante (postagem ou transferência)</label>
                                                          <legend class="col-form-label col-sm-2 pt-0">Status da postagem: </legend>
                                                          <div class="col-sm-10">
                                                              <input type ="radio" id="statuspost" name="statuspost" value="Postado">Postado  <br>
                                                              <input type ="radio" id="statuspost" name="statuspost" value="Não postado">Não postado  <br>
                                                              <input type ="radio" id="statuspost" name="statuspost" value="Em mãos">Em mãos
                                                          </div>
                                        </div>
                          </div>
            </div>
            <fieldset class="form-group">
                            <div id="divstatus" class="d-none">
                             <div class="row">
                                  <legend class="col-form-label col-sm-3 pt-0">Status: </legend>
                                  <div class="col-sm-09">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="Entregue" value="Entregue" onclick="OnChangeRadio4 (this)"> <label class="form-check-label">Entregue </label> &nbsp; &nbsp;<br>
                                        <input class="form-check-input" type="radio" name="status" id="Postado" value="Postado"> <label class="form-check-label">Postado </label> &nbsp; &nbsp;<br>
                                        <input class="form-check-input" type="radio" name="status" id="Loja virtual-confecção" value="Loja virtual - confecção" onclick="OnChangeRadio4 (this)"> <label class="form-check-label">Loja virtual - confecção</label> &nbsp; &nbsp;<br>
                                        <input class="form-check-input" type="radio" name="status" id="Loja virtual-confecção e entrega" value="Loja virtual - confecção e entrega" onclick="OnChangeRadio3 (this)" > <label class="form-check-label">Loja virtual - confecção e entrega</label> &nbsp; &nbsp;<br>
                                        <input class="form-check-input" type="radio" name="status" id="Consignação" value="Consignação" onclick="OnChangeRadio4 (this)"> <label class="form-check-label">Consignação </label> &nbsp; &nbsp;<br>
                                        <input class="form-check-input" type="radio" name="status" id="Ponto de venda" value="Ponto de venda" onclick="OnChangeRadio4 (this)"> <label class="form-check-label">Ponto de venda </label> &nbsp; &nbsp;
                                    </div>
                                   </div>
                                
                             </div>
                             <div id="divfrete" class="d-none">
                                <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Valor do frete: </label> 
                                      <div class="col-sm-5">
                                        <input name="frete" type="text" id="frete" maxlength="50" required class="form-control" value="2.50"> 
                                      </div>
                                </div>
                                <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Endereço para entrega: </label> 
                                      <div class="col-sm-5">
                                        <input name="endereco" type="text" id="endereco" maxlength="200" required class="form-control" > 
                                      </div>
                                </div>
                             </div>
                            </div>
                            
            </fieldset>
            <fieldset class="form-group">
                            <div class="row">
                              <legend class="col-form-label col-sm-3 pt-0">Meio de pagamento: </legend>
                              <div class="col-sm-09">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="meiopgto" id="Dinheiro" value="Dinheiro"> <label class="form-check-label">Dinheiro </label> &nbsp; &nbsp; <br>
                                    <input class="form-check-input" type="radio" name="meiopgto" id="DOCTED" value="DOCTED"> <label class="form-check-label">DOC/TED </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgto" id="Cartão de crédito" value="Cartão de crédito"> <label class="form-check-label">Cartão de crédito </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgto" id="Cartão de débito" value="Cartão de débito" > <label class="form-check-label">Cartão de débito </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgto" id="MercadoPago-Boleto" value="MercadoPago - boleto" > <label class="form-check-label">Mercado Pago - boleto</label><br>
                                    <input class="form-check-input" type="radio" name="meiopgto" id="MercadoPago-Cartão" value="MercadoPago - cartão de crédito" > <label class="form-check-label">Mercado Pago - cartão de crédito</label><br>
                                    <input class="form-check-input" type="radio" name="meiopgto" id="PagSeguro" value="PagSeguro" > <label class="form-check-label">PagSeguro</label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgto" id="Aguardando pgto" value="Aguardando pgto"> <label class="form-check-label">Aguardando pagamento </label> &nbsp; &nbsp;<br>
                                </div>
                              </div>
                            </div>
                            
                        </fieldset>
            <div class="form-row">
                                    <div class="form-group col-md-2">
                                                <label>Quantidade: <font color="red"><strong>*</strong></font></label>
                                                <!--<select class="form-control" id="qtde" name="qtde" required onchange="OnChangeRadio4 (this)">-->
                                                <select class="form-control" id="qtde" name="qtde" required>
                                                    <option value="0">Selecione</option>
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
                                                </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                                <label>Outra quantidade: <font color="red"><strong>*</strong></font></label>
                                                <!--<select class="form-control" id="qtde" name="qtde" required onchange="OnChangeRadio4 (this)">-->
                                                <input name="qtde_outro" type="text" id="qtde_outro" maxlength="3" required class="form-control">
                                    </div>
                                </div>
            </div> 
            <div id="divbotao" class="d-none">
                <center><a href="javascript:form.submit()" class="btn btn-primary">Cadastrar</a></center>
            </div>
    </form>
    <div id="divpedidos" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMAS VENDAS CADASTRADAS</h4><br>
                    	<?

                    	    $query = "SELECT * FROM VENDAS_PRODUTOS ORDER BY ID DESC LIMIT 10";
                		    $select = mysqli_query($connect,$query);
                		    $reccount = mysqli_num_rows($select);  
                                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                    echo "<thead class='thead-light'>";
                                	echo "<th scope='col'>Nome</th>";
                                	/*echo "<th scope='col'>Celular</th>";*/
                                	echo "<th scope='col'>Produto</th>";
                                	echo "<th scope='col'>Qtde</th>";
                                	echo "<th scope='col'>Data da venda</th>";
                                	echo "<th scope='col'>Local</th>";
                                	echo "<th scope='col'>Status</th>";
                                	echo "<th scope='col' colspan='2'>&nbsp</th>";
                                	echo "</thead>";
                                	echo "<tbody>";
                        			while ($fetch = mysqli_fetch_row($select)) {
                        			        $id = $fetch[0];	
                        					$nome = $fetch[1];
                        					$celular = $fetch[2];
                        					$produto = $fetch[6];
                        					$qtdentreg  = $fetch[7];
                        					$dtvenda = $fetch[8];
                        					$localvenda = $fetch[17];
                        					$statusvenda = $fetch[11];
                        					$notificacao = $fetch[20];
                        					$idlojaintegr = $fetch[16];
                        					
                        					$ano_dtvenda = substr($dtvenda,0,4);
                                		    $mes_dtvenda = substr($dtvenda,5,2);
                                		    $dia_dtvenda = substr($dtvenda,8,2);
                        					
                        					echo "<tr>";
                        					echo "<td>".$idlojaintegr."</td>";
                        					echo "<td>".$nome."</td>";
                        					echo "<td>".$produto."</td>";
                        					echo "<td>".$qtdentreg."</td>";
                        					echo "<td>".$dia_dtvenda."/".$mes_dtvenda."/".$ano_dtvenda."</td>";
                        					echo "<td>".$localvenda."</td>";
                        					echo "<td>".$statusvenda."</td>";
                        					if ($notificacao =='Não'){
                        					    echo "<td><a href='envioemailpedido.php?id=".$id."' class='btn btn-primary'>Notificar</a></td>";
                        					} else {
                        					    echo "<td><a href='envioemailpedido.php?id=".$id."' class='btn btn-primary disabled'>Notificado</a></td>";
                        					}
                        					/*echo "<td>".$sumqtd."</td>";*/
                        					/*echo "<td><a href='formvendaprod.php?id=".$fetch[0]."' class='btn btn-primary'>Cadastrar venda</a>&nbsp;</td>";*/
                        					echo "</tr>";
                        			}
                        			echo "</tbody>
                        			      </table>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhuma venda encontrada</p><br>";
                    		}
                    	?>
                    	</center>
        </div>
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