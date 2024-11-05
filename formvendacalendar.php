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
    
    <title>GAAR - Cadastro de vendas do calendário</title>
    
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
        <h3>CADASTRO DE VENDAS DOS CALENDÁRIOS</h3><br>
        <p><label> Todas as vendas de calendários deverão ser cadastradas aqui. É importante cadastrar corretamente pois as informações aqui preenchidas irão ser usadas para gerar estatísticas. </label></p>
       </center>
    <form name="form" method="post" action="cadastrovendascalendario.php" enctype="multipart/form-data" name="form">
    <center><h5>DADOS DO CLIENTE</h5></center>
    <div class="form-group row">
                  <label class="col-sm-1 col-form-label">Nome: </label> 
                  <div class="col-sm-5">
                    <input name="nome" type="text" id="nome" maxlength="80" required class="form-control">
                  </div>
                  <label class="col-sm-1 col-form-label">CPF/CNPJ: </label> 
                  <div class="col-sm-5">
                    <input name="cpfcnpj" type="text" id="cpfcnpj" maxlength="30" required class="form-control">
                  </div>
    </div>
    <div class="form-group row">
                  <label class="col-sm-1 col-form-label">Endereço: </label> 
                  <div class="col-sm-5">
                    <input name="endereco" type="text" id="endereco" maxlength="100" required class="form-control">
                  </div>
                  <label class="col-sm-1 col-form-label">Bairro: </label> 
                  <div class="col-sm-5">
                    <input name="bairro" type="text" id="bairro" maxlength="50" required class="form-control">
                  </div>
    </div>
    <div class="form-group row">
                  <label class="col-sm-1 col-form-label">Cidade: </label> 
                  <div class="col-sm-3">
                    <input name="cidade" type="text" id="cidade" maxlength="50" required class="form-control">
                  </div>
                  <label class="col-sm-1 col-form-label">Estado: </label> 
                  <div class="col-sm-3">
                    <input name="uf" type="text" id="uf" maxlength="30" required class="form-control">
                  </div>
                  <label class="col-sm-1 col-form-label">CEP: </label> 
                  <div class="col-sm-3">
                    <input name="cep" type="text" id="cep" maxlength="20" required class="form-control">
                  </div>
    </div>
    <div class="form-group row">
                  <label class="col-sm-3 col-form-label">DDD + Celular (só números): </label> 
                  <div class="col-sm-3">
                    <input name="celular" type="text" id="celular" maxlength="30" required class="form-control">
                  </div>
                  <label class="col-sm-1 col-form-label">E-mail: </label> 
                  <div class="col-sm-5">
                    <input name="email" type="email" id="email" size="80" maxlength="100" required class="form-control">
                  </div>
    </div>
    <br>
    <center><h5>DADOS DO PEDIDO</h5></center>
    <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Quantidade de calendários de mesa: </label> 
                  <div class="col-sm-2">
                    <input name="qtdemesa" type="text" id="qtdemesa" maxlength="11" required class="form-control">
                  </div>
    </div>
    <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Quantidade de calendários de parede: </label> 
                  <div class="col-sm-2">
                    <input name="qtdeparede" type="text" id="qtdeparede" maxlength="11" required class="form-control">
                  </div>
    </div>
    <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Meio de pagamento: </legend>
                      <div class="col-sm-10">
                          <input type ="radio" name="meiopag" id="meiopag" value="Pagseguro Crédito">Pagseguro Crédito &nbsp; <br>
                          <input type ="radio" name="meiopag" id="meiopag" value="Pagseguro Débito">Pagseguro Débito &nbsp;<br>
                          <input type ="radio" name="meiopag" id="meiopag" value="Dinheiro">Dinheiro &nbsp;<br>
                          <input type ="radio" name="meiopag" id="meiopag" value="DOC ou TED">DOC ou TED &nbsp;<br>
                      </div>
                    </div>
    </fieldset>
      <p><center><font color="#0000A0"> PREENCHER OS CAMPOS EM AZUL APENAS SE FOR VENDA ONLINE </font></p></center>
    <div class="form-group row">
                  <label class="col-sm-2 col-form-label"><font color="#0000A0">ID do Pedido na Loja2:</font></label> 
                  <div class="col-sm-5">
                    <input name="idloja2" type="text" id="idloja2" maxlength="15" required class="form-control">
                  </div>
    </div>
    <div class="form-group row">
                  <label class="col-sm-2 col-form-label"><font color="#0000A0">Valor do frete: </font></label> 
                  <div class="col-sm-2">
                    <input name="frete" type="text" id="frete" maxlength="10" required class="form-control">
                  </div>
                  <label class="col-sm-4 col-form-label"><font color="#0000A0">Código de rastreio (caso houver): </font></label> 
                  <div class="col-sm-3">
                    <input name="codcorreio" type="text" id="codcorreio" maxlength="30" required class="form-control">
                  </div>
    </div>
    <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0"><font color="#0000A0">Meio de pagamento: </legend>
                      <div class="col-sm-10">
                          <input type ="radio" name="meiopag" id="meiopag" value="Pagseguro Crédito online">Pagseguro Crédito &nbsp;<br>
                          <input type ="radio" name="meiopag" id="meiopag" value="Pagseguro Débito online">Pagseguro Débito &nbsp;<br>
                          <input type ="radio" name="meiopag" id="meiopag" value="Boleto online">Boleto bancário &nbsp;</font><br>
                      </div>
                    </div>
    </fieldset>
   <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" name="foto">
                    <label class="custom-file-label" for="validatedCustomFile">Comprovante (postagem ou transferência)</label>
   </div>
   <br><br>
  <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Status da postagem: </legend>
                      <div class="col-sm-10">
                          <input type ="radio" id="status" name="status" value="Postado">Postado  <br>
                          <input type ="radio" id="status" name="status" value="Não postado">Não postado  <br>
                          <input type ="radio" id="status" name="status" value="Em mãos">Em mãos
                      </div>
                    </div>
    </fieldset>
    <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Voluntário responsável pela venda: </label> 
                  <div class="col-sm-5">
                            <select class="form-control" id="inlineFormCustomSelect" name="voluntario" required>
                         		  <?    
                         		        echo "<option selected value='".$nomevol."'>".$nomevol."</option>";
                         		        echo "<option value=''>------------------------</option>";
                        		 		$query = "SELECT NOME FROM VOLUNTARIOS ORDER BY NOME ASC";
                        				$select = mysqli_query($connect,$query);
                        				
                        				while ($fetch = mysqli_fetch_row($select)) {
                        				        echo "<option value='".$fetch[0]."'>".$fetch[0]."</option>";
                        				    }
                        		?>
                	        </select>
                  </div>
    </div>
    <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Observações: </label> 
                  <div class="col-sm-10">
                    <textarea class="form-control" name="obs" cols="70" rows="10" id="obs"></textarea>
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
</html>