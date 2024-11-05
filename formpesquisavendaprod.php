<?php 		

session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 

ini_set('display_errors', 1);

error_reporting(E_ALL);

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
    
    <title>GAAR - Pesquisar vendas de produtos</title>
    
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
			
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
<form action="pesquisavendaprod.php" id="pesquisavendaprod" name="pesquisavendaprod" method="POST">
<!--<form action="pesquisavendaprod.php" id="pesquisavendaprod" name="pesquisavendaprod" method="POST">-->
     	    <center><p>Para pesquisar uma venda, escolha uma das opções abaixo ou, se deseja visualizar todos, deixe os campos em branco</p><br></center>
            <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Produto: </label> 
                  <div class="col-sm-5">
                    <select class="form-control" id="inlineFormCustomSelect" name="prodvenda" required>
                     		  <option selected value="">Selecione</option>
                     		  <option value="Calendário">Calendário</option>
                     		  <option value="Vaso">Vaso</option>
                         		  <?/*
                        		 		$queryprod = "SELECT PRODUTO FROM CONTROLE_ESTOQUE WHERE QTDE >= 1 ORDER BY PRODUTO ASC";
                        				$selectprod = mysqli_query($connect,$queryprod);
                        				
                        				while ($fetchprod = mysqli_fetch_row($selectprod)) {
                        					echo "<option value='".$fetchprod[0]."'>".$fetchprod[0]."</option>";
                        				}
                        				*/
                        				
                        		?>
                    	    </select>
                  </div>
            </div>
            <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Status: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusprod" id="wc-ps-pagamento" value="wc-ps-pagamento" ><label class="form-check-label" for="gridRadios1" required>Aguardando pagamento</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusprod" id="wc-ps-paga" value="wc-ps-paga" ><label class="form-check-label" for="gridRadios1">Pago</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusprod" id="wc-ps-cancelada" value="wc-ps-cancelada" ><label class="form-check-label" for="gridRadios1">Cancelado</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusprod" id="wc-ps-separacao" value="wc-ps-separacao" ><label class="form-check-label" for="gridRadios1">Em separação</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusprod" id="wc-ps-correios" value="wc-ps-correios" ><label class="form-check-label" for="gridRadios1">Enviado pelos Correios</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusprod" id="wc-ps-entregue" value="wc-ps-entregue" ><label class="form-check-label" for="gridRadios1">Entregue</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusprod" id="todosped" value="" ><label class="form-check-label" for="gridRadios1">Todos</label>
                        </div>
                      </div>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Local da venda: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="localvenda" id="Feira de adoção" value="Feira de adoção" onclick="OnChangeRadio1 (this)"><label class="form-check-label" for="gridRadios1" required>Feira de adoção</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="localvenda" id="Encomenda" value="Encomenda" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1">Encomenda</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="localvenda" id="Loja online" value="Loja" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1">Loja</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="localvenda" id="Ponto de venda" value="Ponto de venda" onclick="OnChangeRadio2 (this)"><label class="form-check-label" for="gridRadios1">Ponto de venda</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="localvenda" id="Outros" value="Outros" onclick="OnChangeRadio6 (this)"><label class="form-check-label" for="gridRadios1">Outros</label>
                        </div>
                      </div>
                    </div>
        </fieldset>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Número do pedido: </label> 
                  <div class="col-sm-5">
                    <input name="numpedido" type="text" id="numpedido" class="form-control">
                  </div>
            </div>
              <center><a href="javascript:pesquisavendaprod.submit()" class="btn btn-primary">Pesquisar</a></center>
              <br>
      </form>
    </div>
<?
}
?>
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