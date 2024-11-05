<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$idtermo = $_GET ['idtermo'];
$idpretermo = $_GET ['idpretermo'];

if($login == "" || $login == null){
	/*      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";*/
}else{
	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
		
		if ($idtermo != ''){
		    $query = "SELECT * FROM TERMO_ADOCAO WHERE ID='$idtermo'";
    		$select = mysqli_query($connect,$query);
    			
    		while ($fetch = mysqli_fetch_row($select)) {
    				$nomeadotante = $fetch[1];
                    $rg = $fetch[2];
                    $cpf = $fetch[3];
                    $endereco = $fetch[4];
                    $numero = $fetch[43];
                    $bairro = $fetch[5];
                    $cep = $fetch[6];
                    $cidade = $fetch[7];
                    $estado = $fetch[44];
                    $pontoref = $fetch[8];
                    $fixo = $fetch[9];
                    $celular = $fetch[10];
                    $emailadotante = $fetch[11];
                    $facebook = $fetch[12];
                    $instagram = $fetch[13];
                    $profissao = $fetch[14];
                    $complemento = $fetch[45];
    				
    		}
		}
		
		if ($idpretermo != '') {
		    $query = "SELECT * FROM FORM_PRE_ADOCAO WHERE ID='$idpretermo'";
    		$select = mysqli_query($connect,$query);
    			
    		while ($fetch = mysqli_fetch_row($select)) {
    				$nomeadotante = $fetch[1];
                    $cpf = $fetch[2];
                    $emailadotante = $fetch[3];
                    $profissao = $fetch[4];
                    $fixo = $fetch[5];
                    $celular = $fetch[6];
                    $endereco = $fetch[7];
                    $bairro = $fetch[8];
                    $cidade = $fetch[9];
                    $cep = $fetch[10];
                    $facebook = $fetch[15];
                    $instagram = $fetch[16];                    
                    $numero = $fetch[70];
    		}
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
    
    <title>GAAR - Cadastro de termo</title>
    
    <script type="text/javascript">
    

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
				  case 'ong':
				  	include_once("menu_ong.php") ;
					break;
				  
			  }
			  
		
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
        
    <form method="POST" name="form" action="cadastroreprova.php" enctype="multipart/form-data" >
	  <CENTER>
	        <h3>CADASTRO DE REPROVADOS</h3>
            <p><label class=".text-danger">Atenção! Todos os campos devem ser preenchidos. Caso não haja informação, preencher com 0</p></label>
            <input type="text" name="idtermo" id="idtermo" value="<?php echo $idtermo ?>" hidden>
            <input type="text" name="idpretermo" id="idpretermo" value="<?php echo $idpretermo ?>" hidden>
      </CENTER>
     <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome: </label> 
                  <div class="col-sm-10">
                    <input name="adotante" type="text" required id="adotante" maxlength="100" class="form-control" value="<? echo $nomeadotante?>">
                  </div>
      </div>
      <div class="form-row">
            <div class="form-group col-md-6">
                  <label>RG: </label>
                    <input type="text" required name="rg" id="rg" maxlength="10" class="form-control" value="<? echo $rg ?>">
                    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
            </div>
            <div class="form-group col-md-6">
                  <label>CPF: </label>
                    <input type="text" required name="cpf" id="cpf" maxlength="12" class="form-control" value="<? echo $cpf?>">
                    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
            </div>
      </div>
      <div>
       <!--   <form method="get" action="."> -->
              <div class="form-group row">
                          <label class="col-sm-3 col-form-label">CEP: </label> 
                          <div class="col-sm-09">
                    	    <input name="cep" type="text" id="cep" size="10" maxlength="9" required class="form-control" value="<? echo $cep?>" onblur="pesquisacep(this.value);" />
                    	    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
                    	  </div>
              </div>
        	<div class="form-row">
                    <div class="form-group col-md-6">
                          <label>Endereço: </label>
        		          <input type="text" name="endereco" id="endereco" maxlength="200" required class="form-control" value="<? echo $endereco?>" />
        		    </div>
        		    <div class="form-group col-md-4">
                          <label>Complemento: </label>
        		          <input type="text" name="complemento" id="complemento" maxlength="20" required class="form-control" value="<? echo $complemento?>" />
        		    </div>
        		   <div class="form-group col-md-2">
                          <label>Número: </label>
        		            <input type="text" name="numero" id="numero" maxlength="5" required class="form-control" value="<? echo $numero?>"/ >
        		   </div>
        	</div>
        	<div class="form-row">
                    <div class="form-group col-md-6">
                          <label>Bairro: </label>
        		          <input type="text"  name="bairro" id="bairro" maxlength="50" required class="form-control" value="<? echo $bairro?>" />
        		    </div>
        		   <div class="form-group col-md-6">
                          <label>Ponto de referência: </label>
        		            <input type="text"  name="pontoref" id="pontoref" required class="form-control" value="<? echo $pontoref ?>"/>
        		   </div>
        	</div>
        	<div class="form-row">
                    <div class="form-group col-md-6">
                          <label>Cidade: </label>
        		          <input type="text"  name="cidade" id="cidade" maxlength="25" required class="form-control" value="<? echo $cidade?>" />
        		    </div>
        		   <div class="form-group col-md-6">
                          <label>Estado: </label>
        		            <input type="text" required name="estado" id="estado" maxlength="5" required class="form-control" value="<? echo $estado ?>" />
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
		          <input type="text" name="telfixo" id="telfixo" maxlength="12" class="form-control" value="<? echo $fixo?>">
		          <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (com DDD e sem espaços)</small>
		    </div>
		   <div class="form-group col-md-6">
                  <label>Telefone celular: </label>
		            <input type="text" required name="celular" id="celular" maxlength="15" class="form-control" value="<? echo $celular?>">
		            <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (com DDD e sem espaços)</small>
		   </div>
	</div>
	<div class="form-row">
            <div class="form-group col-md-6">
                  <label>E-mail: </label>
		          <input type="email" required name="email" id="email" maxlength="100" class="form-control" value="<? echo $emailadotante?>">
		          <small id="passwordHelpBlock" class="form-text text-muted">Máx. 100 caracteres</small>
		    </div>
		   <div class="form-group col-md-6">
                  <label>Profissão: </label>
		            <input type="text" required name="profissao" id="profissao" maxlength="30" class="form-control" value="<? echo $profissao?>">
		   </div>
	</div>
	<div class="form-row">
            <div class="form-group col-md-6">
                  <label>Perfil do Facebook: </label>
		          <input type="text" name="facebook" id="facebook" maxlength="30" class="form-control" placeholder="http://www.facebook.com/" value="<? echo $facebook?>">
		          <small id="passwordHelpBlock" class="form-text text-muted">Cadastre sem espaços</small>
		    </div>
		   <div class="form-group col-md-6">
                  <label>Perfil do Instagram: </label>
                  <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                            <input type="text" class="form-control" name="instagram" id="instagram" maxlength="15" value="<? echo $instagram?>">
                  </div>
                  <small id="passwordHelpBlock" class="form-text text-muted">Cadastre sem espaços</small>
            </div>
	</div>
	<div class="form-row">
                  <label>Observações: </label>
		          <textarea class="form-control" name="obs" cols="70" rows="10" id="obs" required></textarea>
		          <small id="passwordHelpBlock" class="form-text text-muted">Textos sem emojis. Calúnia, homofobia, difamação, feminicídio, apologia à violência, etc não serão aceitos. Sujeito a exclusão do acesso ao sistema.</small>
	</div>
    <br>
    
    <input type="text" name="idtermo" id="idtermo" maxlength="30" class="form-control" value="<? echo $idtermo?>" hidden>
    <input type="text" name="idpretermo" id="idpretermo" maxlength="30" class="form-control" alue="<? echo $idpretermo?>" hidden>
     <center><a href="javascript:form.submit()" class="btn btn-primary">Reprovar</a></center>
    <br>	
   </div>
   </form>
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
<? 
}
?>
</html>