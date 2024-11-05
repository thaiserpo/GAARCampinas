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
    
    <title>GAAR - Cria termo pré preenchido</title>
    
    <script>
		function mostrarDiv() {
			// Obter a div a ser exibida
			var div = document.getElementById("divdadosadotante");
			// Verificar se o checkbox está marcado
			if (document.getElementById("dadosadotante").checked) {
				// Se estiver marcado, exibir a div
				div.className  = "d-block";
			} else {
				// Se não estiver marcado, ocultar a div
				div.className = "d-none";
			}
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
			
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
<form action="criatermoimpresso.php" id="formcriatermoimpresso" name="formcriatermoimpresso" method="GET" target="_blank">
<!--<form action="pesquisavendaprod.php" id="pesquisavendaprod" name="pesquisavendaprod" method="POST">-->
     	    <center><p>Para criar um termo pré preenchido, escolha o nome do animal</p><br></center>
            <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome do animal<font color="red"><b>*</b></font>: </label> 
                  <div class="col-sm-5">
                    <select class="form-control" id="idanimal" name="idanimal" required>
                         		  <option selected value="">Selecione</option>
                         		  <?
                        		 		$query = "SELECT ID,NOME_ANIMAL,ESPECIE FROM ANIMAL WHERE (ADOTADO ='Disponivel' OR ADOTADO='Adotado (sem termo)' OR ADOTADO='Em adaptação' OR ADOTADO='Pré adotado') and DIVULGAR_COMO ='GAAR' ORDER BY NOME_ANIMAL,ESPECIE ASC";
                        				$select = mysqli_query($connect,$query);
                        				
                        				while ($fetch = mysqli_fetch_row($select)) {
                        					echo "<option value='".$fetch[0]."'>".$fetch[1]." - Espécie: ".$fetch[2]."</option>";
                        				}
                        		?>
                	</select>
                  </div>
                  <!--<div class="col-sm-10">
                    <input name="iddoanimal" type="text" id="" maxlength="20" class="form-control">
                  </div>-->
         </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" value="dadosadotante" id="dadosadotante" name="dadosadotante" onclick="mostrarDiv()">
              <label class="form-check-label" for="defaultCheck1"> Incluir dados do adotante </label>
            </div>
            <div id="divdadosadotante" class="d-none">
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome: </label> 
                  <div class="col-sm-10">
                    <input name="adotante" type="text" required id="adotante" maxlength="100" class="form-control">
                  </div>
              </div>
              <div class="form-row">
                    <div class="form-group col-md-6">
                          <label>RG: </label>
                            <input type="text" required name="rg" id="rg" maxlength="15" class="form-control" >
                            <small id="passwordHelpBlock" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-md-6">
                          <label>CPF: </label>
                            <input type="text" required name="cpf" id="cpf" maxlength="12" class="form-control" >
                            <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
                    </div>
              </div>
              <div>
              <div class="form-group row">
                          <label class="col-sm-3 col-form-label">CEP: </label> 
                          <div class="col-sm-09">
                    	    <input name="cep" type="text" id="cep" size="10" maxlength="9" required class="form-control" onblur="pesquisacep(this.value);" />
                    	    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
                    	  </div>
              </div>
        	  <div class="form-row">
                    <div class="form-group col-md-6">
                          <label>Endereço: </label>
        		          <input type="text" name="endereco" id="endereco" maxlength="200" required class="form-control">
        		    </div>
        		    <div class="form-group col-md-2">
                          <label>Número: </label>
        		            <input type="text" name="numero" id="numero" maxlength="10" required class="form-control">
        		   </div>
        		    <div class="form-group col-md-4">
                          <label>Complemento: </label>
        		          <input type="text" name="complemento" id="complemento" maxlength="30" required class="form-control">
        		    </div>
        	  </div>
        	  <div class="form-row">
                    <div class="form-group col-md-6">
                          <label>Bairro: </label>
        		          <input type="text"  name="bairro" id="bairro" maxlength="50" required class="form-control">
        		    </div>
        	  </div>
            	<div class="form-row">
                        <div class="form-group col-md-6">
                              <label>Cidade: </label>
            		          <input type="text"  name="cidade" id="cidade" maxlength="25" required class="form-control" />
            		    </div>
            		   <div class="form-group col-md-6">
                              <label>Estado: </label>
            		            <input type="text" required name="estado" id="estado" maxlength="5" required class="form-control" />
            		   </div>
            	</div>
            	<script type="text/javascript" >
                      	function limpa_formulário_cep() {
                                //Limpa valores do formulário de cep.
                                document.getElementById('endereco').value=("");
                                document.getElementById('bairro').value=("");
                                document.getElementById('cidade').value=("");
                                document.getElementById('estado').value=("");
                        }
                    
                        function meu_callback(conteudo) {
                            if (!("erro" in conteudo)) {
                                //Atualiza os campos com os valores.
                                document.getElementById('endereco').value=(conteudo.logradouro);
                                document.getElementById('bairro').value=(conteudo.bairro);
                                document.getElementById('cidade').value=(conteudo.localidade);
                                document.getElementById('estado').value=(conteudo.uf);
                            } //end if.
                            else {
                                //CEP não Encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        }
                            
                        function pesquisacep(valor) {
                            
                            limpa_formulário_cep();
                    
                            //Nova variável "cep" somente com dígitos.
                            var cep = valor.replace(/\D/g, '');
                    
                            //Verifica se campo cep possui valor informado.
                            if (cep != "") {
                    
                                //Expressão regular para validar o CEP.
                                var validacep = /^[0-9]{8}$/;
                    
                                //Valida o formato do CEP.
                                if(validacep.test(cep)) {
                    
                                    //Preenche os campos com "..." enquanto consulta webservice.
                                    document.getElementById('endereco').value="...";
                                    document.getElementById('bairro').value="...";
                                    document.getElementById('cidade').value="...";
                                    document.getElementById('estado').value="...";
                    
                                    //Cria um elemento javascript.
                                    var script = document.createElement('script');
                    
                                    //Sincroniza com o callback.
                                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
                    
                                    //Insere script no documento e carrega o conteúdo.
                                    document.body.appendChild(script);
                    
                                } //end if.
                                else {
                                    //cep é inválido.
                                    limpa_formulário_cep();
                                    alert("Formato de CEP inválido.");
                                }
                            } //end if.
                            else {
                                //cep sem valor, limpa formulário.
                                limpa_formulário_cep();
                            }
                        };
    			
                  </script>
          <!--  </form>-->
    	</div>
    	<div class="form-row">
                <div class="form-group col-md-6">
                      <label>Telefone fixo: </label>
    		          <input type="text" name="telfixo" id="telfixo" maxlength="12" class="form-control" >
    		          <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (com DDD e sem espaços)</small>
    		    </div>
    		   <div class="form-group col-md-6">
                      <label>Telefone celular: </label>
    		            <input type="text" required name="celular" id="celular" maxlength="15" class="form-control" >
    		            <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (com DDD e sem espaços)</small>
    		   </div>
    	</div>
    	<div class="form-row">
                <div class="form-group col-md-6">
                      <label>E-mail: </label>
    		          <input type="email" required name="email" id="email" class="form-control" >
    		          <small id="passwordHelpBlock" class="form-text text-muted">Máx. 100 caracteres</small>
    		    </div>
    		   <div class="form-group col-md-6">
                      <label>Profissão: </label>
    		            <input type="text" required name="profissao" id="profissao" class="form-control" >
    		   </div>
    	</div>
    	<div class="form-row">
                <div class="form-group col-md-6">
                      <label>Perfil do Facebook: </label>
    		          <input type="text" name="facebook" id="facebook" class="form-control" placeholder="http://www.facebook.com/" >
    		          <small id="passwordHelpBlock" class="form-text text-muted">Cadastre sem espaços</small>
    		    </div>
    		   <div class="form-group col-md-6">
                      <label>Perfil do Instagram: </label>
                      <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                                <input type="text" class="form-control" name="instagram" id="instagram" >
                      </div>
                      <small id="passwordHelpBlock" class="form-text text-muted">Cadastre sem espaços</small>
                </div>
    	</div>
    	<fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-4 pt-0">Possui outros animais em casa? </legend>
                      <div class="col-sm-6">
                            <div class='form-check'>
                                <input class='form-check-input'  name='possuianimal' type='radio' value='Sim' checked><label class='form-check-label' for='gridRadios1' required>Sim</label>
                            </div>
                            <div class='form-check'>
                                <input class='form-check-input'  name='possuianimal' type='radio' value='Não' checked><label class='form-check-label' for='gridRadios1' required>Não</label>
                            </div>
                      </div>
                     </div>
        </fieldset>
        <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-4 pt-0">Se sim, estão castrados? </legend>
                      <div class="col-sm-6">
                            <div class='form-check'>
                                <input class='form-check-input'  name='sesimcastrados' type='radio' value='Sim' checked><label class='form-check-label' for='gridRadios1' required>Sim</label>
                            </div>
                            <div class='form-check'>
                                <input class='form-check-input'  name='sesimcastrados' type='radio' value='Não' checked><label class='form-check-label' for='gridRadios1' required>Não</label>
                            </div>
                            <div class='form-check'>
                                <input class='form-check-input'  name='sesimcastrados' type='radio' value='Não possui animais' checked><label class='form-check-label' for='gridRadios1' required>Não possui animais</label>
                            </div>
                      </div>
                     </div>
        </fieldset>
        </div>
            
            <center><button type="submit" class="btn btn-primary">Criar</button></center>
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