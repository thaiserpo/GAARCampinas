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
				$nome = $fetcharea[2];
				$celular = $fetcharea[3];
				$email = $fetcharea[4];
				$area = $fetcharea[5];
				$cpfcnpj =  $fetcharea[9];
				$rg =  $fetcharea[11];
				$orgaoexp = $fetcharea[12];
				$dtnasc =  $fetcharea[13];
				$nacionalidade =  $fetcharea[14];
				$estadocivil =  $fetcharea[15];
				$profissao =  $fetcharea[16];
				$cep =  $fetcharea[17];
				$endereco =  $fetcharea[18];
				$complemento =  $fetcharea[19];
				$numero =  $fetcharea[20];
				$bairro =  $fetcharea[21];
				$cidade =  $fetcharea[22];
				$estado =  $fetcharea[23];
		}
		
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta charset="gb18030">
    <!-- Meta tags Obrigat贸rias -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Termo de voluntariado</title>
    
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
      <br>
         <h4> ATUALIZAÇÃO DOS DADOS CADASTRAIS</h4><br>
         <p><strong>Em conformidade com a Lei do Voluntariado, nº 9.608, de 18/02/98, é necessário realizar a atualização de seus dados cadastrais para que possa assinar o termo.<br><br></strong>
            
            <p> Todos os campos são <strong><font color="red">obrigatórios</font></strong></p>
            <form method="POST" name="form" action="atualizadados.php" enctype="multipart/form-data" >
        	    <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nome completo: <font color="red">*</font></label> 
                          <div class="col-sm-4">
                            <input name="nome" type="text" id="nome" size="50" maxlength="30" class="form-control" value="<? echo $nome ?>"> 
                          </div>
                </div>
                <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Celular: <font color="red">*</font></label> 
                          <div class="col-sm-4">
                            <input name="celular" type="text" id="celular" size="20" maxlength="20" class="form-control" value="<? echo $celular ?>">
                            <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (com DDD e sem espaços)</small>
                          </div>
                </div>
                <div class="form-row">
                            <label class="col-sm-3 col-form-label">RG: <font color="red">*</font></label>
                            <div class="col-sm-4">
                                    <input type="text" required name="rg" id="rg" maxlength="10" class="form-control cpf-mask" placeholder="Ex.: 00.000.000-0" value="<? echo $rg ?>">
                            </div>
                </div>
                <br>
                <div class="form-row">
                            <label class="col-sm-3 col-form-label">Órgão expedidor: <font color="red">*</font></label>
                            <div class="col-sm-4">
                                    <input type="text" required name="orgaoexp" id="orgaoexp" maxlength="10" class="form-control" placeholder="XXX/XX" value="<? echo $orgaoexp ?>">
                            </div>
                </div>
                <br>
                <div class="form-row">
                            <label class="col-sm-3 col-form-label">CPF: <font color="red">*</font></label>
                            <div class="col-sm-4">
                                    <input type="text" required name="cpf" id="cpf" maxlength="12" class="form-control cpf-mask" placeholder="Ex.: 000.000.000-00" value="<? echo $cpfcnpj?>">
                            </div>
                </div>
                <br>
                <div class="form-row">
                    <label class="col-sm-3 col-form-label">CEP: <font color="red">*</font></label>
                    <div class="col-sm-4">
                                	    <input name="cep" type="text" id="cep" size="10" maxlength="9" required class="form-control" value="<? echo $cep?>" onblur="pesquisacep(this.value);" />
                                	    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
                    </div>
                </div>
                    <br>
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
                    <label class="col-sm-3 col-form-label">Endereço: <font color="red">*</font></label>
                        <div class="col-sm-7">
                    		          <input type="text" name="endereco" id="endereco" maxlength="200" required class="form-control" value="<? echo $endereco?>" />
                        </div>
                </div>    
                <br>
                   <div class="form-row">
                    <label class="col-sm-3 col-form-label">Complemento: <font color="red">*</font></label>
                        <div class="col-sm-4">
                    		          <input type="text" name="complemento" id="complemento" maxlength="20" class="form-control" value="<? echo $complemento?>" />
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <label class="col-sm-3 col-form-label">Número: <font color="red">*</font></label>
                            <div class="col-sm-4">
                        		            <input type="text" name="numero" id="numero" maxlength="10" required class="form-control" value="<? echo $numero?>"/ >
                            </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <label class="col-sm-3 col-form-label">Bairro: <font color="red">*</font></label>
                            <div class="col-sm-4">
                    		          <input type="text"  name="bairro" id="bairro" maxlength="50" required class="form-control" value="<? echo $bairro?>" />
                    		</div>
                    </div>
                    <br>
                    <div class="form-row">
                        <label class="col-sm-3 col-form-label">Cidade: <font color="red">*</font></label>
                            <div class="col-sm-4">
                    		          <input type="text"  name="cidade" id="cidade" maxlength="25" required class="form-control" value="<? echo $cidade?>" />
                    		</div>
                    </div>
                    <br>
                    <div class="form-row">
                        <label class="col-sm-3 col-form-label">Estado: <font color="red">*</font></label>
                            <div class="col-sm-4">
                    		            <input type="text" required name="estado" id="estado" maxlength="5" required class="form-control" />
                    		</div>
                    </div>
                    <br>
            	<div class="form-row">
                        <label class="col-sm-3 col-form-label">E-mail: <font color="red">*</font></label>
                            <div class="col-sm-4">
                		          <input name="email" type="text" id="email" maxlength="100" class="form-control" required value="<? echo $email?>">
            		        </div>
            	</div>
            	<br>
            	<div class="form-row">
                        <label class="col-sm-3 col-form-label">Profissão: <font color="red">*</font></label>
                            <div class="col-sm-4">
            		            <input type="text" required name="profissao" id="profissao" maxlength="30" class="form-control" value="<? echo $profissao?>">
            		        </div>
            	</div>
            	<br>
            	<div class="form-row">
                        <label class="col-sm-3 col-form-label">Data de nascimento: <font color="red">*</font></label>
                            <div class="col-sm-4">
            		            <input type="date" name="nascimento" id="nascimento" class="form-control" value="<? echo $nascimento?>" required>
            		        </div>
            	</div>
            	<br>
            	<div class="form-row">
                        <label class="col-sm-3 col-form-label">Nacionalidade: <font color="red">*</font></label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" name="nacionalidade" id="nacionalidade" maxlength="20" value="<? echo $nacionalidade?>">
                            </div>
                </div>
                <br>
                <div class="form-row">
                        <label class="col-sm-3 col-form-label">Estado Civil: <font color="red">*</font></label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" name="estadocivil" id="estadocivil" maxlength="20" value="<? echo $estadocivil?>">
                            </div>
                </div>
                <br>
                
                <center><a href="javascript:form.submit()" class="btn btn-primary">Atualizar</a></center>
        </form>
        <br>
<?
    }
?>
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
