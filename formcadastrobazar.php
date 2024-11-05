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
    
    <title>GAAR - Cadastro do bazar</title>
    
    <script type="text/javascript">
	
                            function OnChangeRadio (radio) {
                                        document.getElementById('vendabazarfisico').className  = "d-block";
                                        document.getElementById('botaocadastrar').className  = "d-block";
                                        document.getElementById('vendabazaronline').className  = "d-none";
                                        document.getElementById('vendaforabazar').className  = "d-none";
                                        document.getElementById('divdespesas').className  = "d-none";
                                }
                                
                            function OnChangeRadio2 (radio) {
                                        document.getElementById('vendabazaronline').className  = "d-block";
                                        document.getElementById('botaocadastrar').className  = "d-block";
                                        document.getElementById('vendabazarfisico').className  = "d-none";
                                        document.getElementById('vendaforabazar').className  = "d-none";
                                        document.getElementById('divdespesas').className  = "d-none";
                                }
                                
                            function OnChangeRadio3 (radio) {
                                        document.getElementById('vendaforabazar').className  = "d-block";
                                        document.getElementById('botaocadastrar').className  = "d-block";
                                        document.getElementById('vendabazaronline').className  = "d-none";
                                        document.getElementById('vendabazarfisico').className  = "d-none";
                                        document.getElementById('divdespesas').className  = "d-none";
                                        
                                }
                            
                            function OnChangeRadio4 (radio) {
                                        document.getElementById('divdespesas').className  = "d-block";
                                        document.getElementById('botaocadastrar').className  = "d-block";
                                        document.getElementById('vendaforabazar').className  = "d-none";
                                        document.getElementById('vendabazaronline').className  = "d-none";
                                        document.getElementById('vendabazarfisico').className  = "d-none";
                                        
                                }
                            
                            function FechamentoCaixa (fechamento){
                                
                                var abertura = document.getElementById("aberturacaixa").value;
                                var vendasnocartao = document.getElementById("vendascartao").value;
                                var vendasdeposito = document.getElementById("vendasfisicas").value;
                                var despesas = document.getElementById("despdiarias").value;
                                
                                var total = (parseFloat(abertura) + parseFloat(vendasnocartao) + parseFloat(vendasdeposito)) - parseFloat(despesas);
                                
                                var lucro = (parseFloat(total) - parseFloat(abertura));
                                
                                if (Number.isNaN(total))
                                    total = 0;
                                    
                                document.getElementById('fechamentocaixa').value= total;
                                document.getElementById('lucro').value= lucro;
                                
                            }
    </script>
    
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
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
       <center>
        <h3>CADASTRO DO BAZAR</h3><br>
        <p><label> É importante cadastrar o bazar corretamente pois as informações aqui preenchidas irão ser usadas para gerar estatísticas</label></p>
       </center>
    <form action="cadastrobazar.php" method="post" enctype="multipart/form-data" name="form">
     <div class="form-row">
         <div class="row">
                      <legend class="col-form-label col-sm-4 pt-0">Tipo: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipobazar" id="tipobazar" value="Físico" onclick="OnChangeRadio (this)"><label class="form-check-label" for="gridRadios1" required>Bazar físico</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipobazar" id="tipobazar" value="Online" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1">Bazar online</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipobazar" id="tipobazar" value="Fora do bazar" onclick="OnChangeRadio3 (this)"><label class="form-check-label" for="gridRadios1">Venda fora do bazar</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipobazar" id="tipobazar" value="Despesas" onclick="OnChangeRadio4 (this)"><label class="form-check-label" for="gridRadios1">Despesas (compras, pagamentos, etc)</label>
                        </div>
                      </div>
                    </div>
     </div>
    <br>
     <div id="divdespesas" class="form-row d-none">
        <h4>DESPESAS</h4> <br>
        <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Data: </label> 
                            <input name="datadespesa" type="date" id="datadespesa" class="form-control" required>
                        </div>
                        
        </div>
        <div class="form-group col-md-6">
                  <label>Valor:</label>
                  <div class="input-group-prepend">
                        <div class="input-group-text">R$ </div>
                            <input name="valordespesa" type="text" id="valordespesa" maxlength="13" class="form-control" required>
                  </div>
                  <small id="passwordHelpBlock" class="form-text text-muted">Ao invés de vírgula, coloque ponto</small>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Meio de pagamento: </label> 
                              <div class="col-sm-09">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="meiopgtodesp" id="meiopgtodesp" value="Dinheiro"> <label class="form-check-label">Dinheiro (depósito) </label> &nbsp; &nbsp; <br>
                                    <input class="form-check-input" type="radio" name="meiopgtodesp" id="meiopgtodesp" value="DOCTED"> <label class="form-check-label">DOC/TED </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtodesp" id="meiopgtodesp" value="Aguardando pgto"> <label class="form-check-label">Aguardando pagamento </label> &nbsp; &nbsp;<br>
                                </div>
                            </div>
                        </div>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-6">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="fotodespesa">
                                <label class="custom-file-label" for="validatedCustomFile">Comprovante (transferência)</label>
                        </div>
       </div> 
        <div class="form-row">
                        <div class="form-group col-md-6">
                                <label>Descrição: </label> 
                                <textarea class="form-control" name="obsdespesa" cols="70" rows="10" id="obsdespesa" value="<? echo $obs?>"></textarea>
                                <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                        </div>
                        
         </div>
        </div>
     <div id="vendabazarfisico" class="form-row d-none">
        <h4>BAZAR FÍSICO</h4> <br>
        <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Nome do evento: </label> 
                            <input name="nomebazar" type="text" id="nomebazar" maxlength="50" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Local: </label> 
                            <input name="local" type="text" id="local" maxlength="50" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Data: </label> 
                            <input name="datafisica" type="date" id="datafisica" class="form-control" required>
                        </div>
        </div>
        <div class="form-group col-md-6">
                  <label>Valor das despesas diárias:</label>
                  <div class="input-group-prepend">
                        <div class="input-group-text">R$ </div>
                            <input name="despdiarias" type="text" id="despdiarias" maxlength="13" class="form-control" required>
                  </div>
                  <small id="passwordHelpBlock" class="form-text text-muted">Ao invés de vírgula, coloque ponto</small>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Meio de pagamento: </label> 
                              <div class="col-sm-09">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="meiopgtodespesa" id="meiopgtodespesa" value="Dinheiro"> <label class="form-check-label">Dinheiro (depósito) </label> &nbsp; &nbsp; <br>
                                    <input class="form-check-input" type="radio" name="meiopgtodespesa" id="meiopgtodespesa" value="DOCTED"> <label class="form-check-label">DOC/TED </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtodespesa" id="meiopgtodespesa" value="Cartão de crédito"> <label class="form-check-label">Cartão de crédito </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtodespesa" id="meiopgtodespesa" value="Cartão de débito" > <label class="form-check-label">Cartão de débito </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtodespesa" id="meiopgtodespesa" value="Pagseguro boleto" > <label class="form-check-label">Pagseguro boleto</label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtodespesa" id="meiopgtodespesa" value="Pagseguro débito" > <label class="form-check-label">Pagseguro débito</label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtodespesa" id="meiopgtodespesa" value="Pagseguro crédito" > <label class="form-check-label">Pagseguro crédito</label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtodespesa" id="meiopgtodespesa" value="Aguardando pgto"> <label class="form-check-label">Aguardando pagamento </label> &nbsp; &nbsp;<br>
                                </div>
                            </div>
                        </div>
        </div>
        <div class="form-group col-md-6">
                  <label>Vendas em cartão: </label>
                  <div class="input-group-prepend">
                        <div class="input-group-text">R$ </div>
                            <input name="vendascartao" type="text" id="vendascartao" maxlength="13" class="form-control" required>
                  </div>
                  <small id="passwordHelpBlock" class="form-text text-muted">Ao invés de vírgula, coloque ponto</small>
        </div>
        <div class="form-group col-md-6">
                  <label>Valor do depósito das vendas físicas: </label>
                  <div class="input-group-prepend">
                        <div class="input-group-text">R$ </div>
                            <input name="vendasfisicas" type="text" id="vendasfisicas" maxlength="13" class="form-control" required>
                  </div>
                  <small id="passwordHelpBlock" class="form-text text-muted">Ao invés de vírgula, coloque ponto</small>
        </div>
        <div class="form-group col-md-6">
                  <label>Valor da abertura do caixa: </label>
                  <div class="input-group-prepend">
                        <div class="input-group-text">R$ </div>
                            <input name="aberturacaixa" type="text" id="aberturacaixa" maxlength="13" class="form-control" required  onblur="FechamentoCaixa(this.value);">
                  </div>
                  <small id="passwordHelpBlock" class="form-text text-muted">Ao invés de vírgula, coloque ponto</small>
        </div>
        <div class="form-group col-md-6">
                  <label>Valor do fechamento do caixa: </label>
                  <div class="input-group-prepend">
                        <div class="input-group-text">R$ </div>
                            <input name="fechamentocaixa" type="text" id="fechamentocaixa" maxlength="13" class="form-control" required>
                  </div>
                  <small id="passwordHelpBlock" class="form-text text-muted">Ao invés de vírgula, coloque ponto</small>
        </div>
        <div class="form-group col-md-6">
                  <label>Lucro: </label>
                  <div class="input-group-prepend">
                        <div class="input-group-text">R$ </div>
                            <input name="lucro" type="text" id="lucro" maxlength="13" class="form-control" required>
                  </div>
                  <small id="passwordHelpBlock" class="form-text text-muted">Ao invés de vírgula, coloque ponto</small>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-6">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="fotofisico">
                                <label class="custom-file-label" for="validatedCustomFile">Comprovante (transferência)</label>
                        </div>
       </div> 
        <div class="form-row">
                        <div class="form-group col-md-6">
                                <label>Observações: </label> 
                                <textarea class="form-control" name="obs" cols="70" rows="10" id="obs" value="<? echo $obs?>"></textarea>
                                <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                        </div>
                        
         </div>
       </div>
     <div id="vendabazaronline" class="form-row d-none">
   	  <h4>BAZAR ONLINE</h4> <br>
        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Data: </label> 
                            <input name="dataonline" type="date" id="dataonline" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                                  <label>Valor da venda: </label>
                                  <div class="input-group-prepend">
                                        <div class="input-group-text">R$ </div>
                                            <input name="valoronline" type="text" id="valoronline" maxlength="13" class="form-control" required>
                                  </div>
                                  <small id="passwordHelpBlock" class="form-text text-muted">Ao invés de vírgula, coloque ponto</small>
                        </div>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Meio de pagamento: </label> 
                              <div class="col-sm-09">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="meiopgtoonline" id="meiopgtoonline" value="Dinheiro"> <label class="form-check-label">Dinheiro (depósito) </label> &nbsp; &nbsp; <br>
                                    <input class="form-check-input" type="radio" name="meiopgtoonline" id="meiopgtoonline" value="DOCTED"> <label class="form-check-label">DOC/TED </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtoonline" id="meiopgtoonline" value="Cartão de crédito"> <label class="form-check-label">Cartão de crédito </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtoonline" id="meiopgtoonline" value="Cartão de débito" > <label class="form-check-label">Cartão de débito </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtoonline" id="meiopgtoonline" value="Pagseguro boleto" > <label class="form-check-label">Pagseguro boleto</label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtoonline" id="meiopgtoonline" value="Pagseguro débito" > <label class="form-check-label">Pagseguro débito</label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtoonline" id="meiopgtoonline" value="Pagseguro crédito" > <label class="form-check-label">Pagseguro crédito</label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtoonline" id="meiopgtoonline" value="Aguardando pgto"> <label class="form-check-label">Aguardando pagamento </label> &nbsp; &nbsp;<br>
                                </div>
                            </div>
                        </div>
        </div>
       <div class="form-row">
                        <div class="form-group col-md-6">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="fotoonline">
                                <label class="custom-file-label" for="validatedCustomFile">Comprovante (transferência)</label>
                        
                        </div>
       </div> 
        <div class="form-row">
                        <div class="form-group col-md-6">
                                <label>Observações: </label> 
                                <textarea class="form-control" name="obsonline" cols="70" rows="10" id="obsonline" value="<? echo $obs?>"></textarea>
                                <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                        </div>
        </div>
    </div>
     <div id="vendaforabazar" class="form-row d-none">
   	  <h4>VENDAS FORA DO BAZAR FÍSICO OU ONLINE</h4> <br>
        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Data: </label> 
                            <input name="datafora" type="date" id="datafora" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                                  <label>Valor da venda: </label>
                                  <div class="input-group-prepend">
                                        <div class="input-group-text">R$ </div>
                                            <input name="vendasfora" type="text" id="vendasfora" maxlength="13" class="form-control" required>
                                  </div>
                                  <small id="passwordHelpBlock" class="form-text text-muted">Ao invés de vírgula, coloque ponto</small>
                        </div>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Meio de pagamento: </label> 
                              <div class="col-sm-09">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="meiopgtofora" id="meiopgtofora" value="Dinheiro"> <label class="form-check-label">Dinheiro (depósito)</label> &nbsp; &nbsp; <br>
                                    <input class="form-check-input" type="radio" name="meiopgtofora" id="meiopgtofora" value="DOCTED"> <label class="form-check-label">DOC/TED </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtofora" id="meiopgtofora" value="Cartão de crédito"> <label class="form-check-label">Cartão de crédito </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtofora" id="meiopgtofora" value="Cartão de débito" > <label class="form-check-label">Cartão de débito </label> &nbsp; &nbsp;<br>
                                    <input class="form-check-input" type="radio" name="meiopgtofora" id="meiopgtofora" value="Aguardando pgto"> <label class="form-check-label">Aguardando pagamento </label> &nbsp; &nbsp;<br>
                                </div>
                            </div>
                        </div>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-6">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="fotofora">
                                <label class="custom-file-label" for="validatedCustomFile">Comprovante (transferência)</label>
                        
                        </div>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-6">
                                <label>Observações: </label> 
                                <textarea class="form-control" name="obsfora" cols="70" rows="10" id="obsfora" value="<? echo $obs?>"></textarea>
                                <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                        </div>
                        
         </div>
       </div>
    <br>
        <center><a href="javascript:form.submit()" class="btn btn-primary d-none" id="botaocadastrar">Cadastrar</a></center>
    <br>	
   </div>
   </form>
   <br>
   <?
            $query = "SELECT * FROM BAZAR ORDER BY ID DESC LIMIT 10";
    		$select = mysqli_query($connect,$query);
    		$reccount = mysqli_num_rows($select);
   ?>
   <h3><center>ÚLTIMOS LANÇAMENTOS </center></h3><br>
    <table class='table'>
       <thead class='thead-light'>
           <th scope='col'>Data</th>
           <th scope='col'>Descrição</th>
           <th scope='col'>Valor</th>
           <th scope='col'>Tipo do bazar</th>
       </thead>
       <tbody>
           <?
                while ($fetch = mysqli_fetch_row($select)) {
    			        $data = $fetch[3];	
    			        $descricao = $fetch[10];	
    					$tipobazar = $fetch[12];
    					switch ($tipobazar){
    					    case 'Físico':
    					        $descricao = $fetch[1];
    					        $valor = (intval($fetch[5]) + intval($fetch[6])) - intval($fetch[4]);
    					        break;
    					    case 'Online':
    					    case 'Fora do bazar':
    					    case 'Despesas':
    					        $valor = $fetch[7];
    					        break;
    					}
    					echo "<tr>";
    					echo "<td>".$data."</td>";
    					echo "<td>".$descricao."</td>";
    					echo "<td>R$ ".number_format($valor,2,',', '.')."</td>";
    					echo "<td>".$tipobazar."</td>";
    					/*echo "<td><a href='formvendaprod.php?id=".$fetch[0]."' class='btn btn-primary'>Cadastrar venda</a>&nbsp;</td>";*/
    					echo "</tr>";
    			}
			?>
       </tbody>
    </table> 
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
<?
    }
?>
</body>
</html>
