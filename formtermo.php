<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	/*      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";*/
}else{
	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
		
		$idanimal = $_GET['idanimal'];
		$idadotante = $_GET['idadotante'];

        $query = "UPDATE ANIMAL
					SET 
					ADOTADO='Disponível'
					WHERE 
					ID = '$idanimal'";

        $querypet = "SELECT * FROM ANIMAL WHERE ID ='$idanimal'";
		$selectpet = mysqli_query($connect,$querypet);
		
		$querypretermo = "SELECT * FROM FORM_PRE_ADOCAO WHERE ID ='$idadotante'";
		$selectpretermo = mysqli_query($connect,$querypretermo);
		$reccountpretermo = mysqli_num_rows($selectpretermo);
		
		if ($reccountpretermo != '0'){
		    while ($fetchpretermo = mysqli_fetch_row($selectpretermo)) {
                $nomeadotante = $fetchpretermo[1];
                $cpf = $fetchpretermo[2];
                $rg = $fetchpretermo[74];
                $cep = $fetchpretermo[10];
                $endereco = $fetchpretermo[7];
                $numero = $fetchpretermo[70];
                $bairro = $fetchpretermo[8];
                $cidade = $fetchpretermo[9];
                $tmptelfixo =$fetchpretermo[5];
                $tmpcelularadotante =$fetchpretermo[6];
                $emailadotante = $fetchpretermo[3];
                $profissao = $fetchpretermo[4];
                $facebook = $fetchpretermo[15];
                $instagram =$fetchpretermo[16];
                
                $telfixo = sprintf("(%s) %s-%s", substr($tmptelfixo, 0, 2), substr($tmptelfixo, 2, 4), substr($tmptelfixo, 6, 4));
                $celularadotante = sprintf("(%s) %s-%s", substr($tmpcelularadotante, 0, 2), substr($tmpcelularadotante, 2, 4), substr($tmpcelularadotante, 6, 4));
                
        
            }
        }
        
        function busca_cep($cep){  
            $resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');  
            if(!$resultado){  
                $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";  
            }  
            parse_str($resultado, $retorno);   
            return $retorno;  
        }  
        
        $resultado_busca = busca_cep('90020022'); 
        
        switch($resultado_busca['resultado']){  
            case '2':  
                $texto = " 
            Cidade com logradouro único 
            <b>Cidade: </b> ".$resultado_busca['cidade']." 
            <b>UF: </b> ".$resultado_busca['uf']." 
                ";    
            break;  
              
            case '1':  
                $texto = " 
            Cidade com logradouro completo 
            <b>Tipo de Logradouro: </b> ".$resultado_busca['tipo_logradouro']." 
            <b>Logradouro: </b> ".$resultado_busca['logradouro']." 
            <b>Bairro: </b> ".$resultado_busca['bairro']." 
            <b>Cidade: </b> ".$resultado_busca['cidade']." 
            <b>UF: </b> ".$resultado_busca['uf']." 
                ";  
            break;  
              
            default:  
                $texto = "Fala ao buscar cep: ".$resultado_busca['resultado'];  
            break;  
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
    
        function validaimagem() {
		var extensoesOk = ",.gif,.jpg,.jpeg,.png,.gif,.bmp,";
		var extensao	= "," + document.form.foto.value.substr( document.form.foto.value.length - 4 ).toLowerCase() + ",";
		window.document.write(extensao);
		if (document.form.foto.value == "")
		 {alert("O campo do endereço da imagem está vazio!!")}
		else if( extensoesOk.indexOf( extensao ) == -1 )
		 { alert( document.form.foto.value + "\nNão possui uma extensão válida" );javascript:location.reload()}
		else {javascript:tamanhos()}	 
		}
		
		function tamanhos() {
		var imagem=new Image();
		imagem.src=document.form.foto.value;
		tamanho_imagem = imagem.fileSize 
		img_tan = tamanho_imagem
		if (tamanho_imagem < 0)
		 {javascript:tamanhos()}
		else if (tamanho_imagem > 150000)
		{alert("O tamanho da Imagem é muito grande ...  "+tamanho_imagem+" Bytes!!");javascript:location.reload()}
		else 
		{javascript:ativafigura()}
		}
		function ativafigura() {
			largura = document.getElementById("foto").width;
			altura = document.getElementById("foto").height;
			if (largura > 400 || altura > 400 ){
				alert("A imagem é "+largura+"x"+altura+" está fora do padrão requerido: 400 x 400");javascript:location.reload()
		  	}
		  }
	
		function validar(){
			var adotante  = document.form["adotante"].value;
			var rg 		  = form.rg.value;
			var endereco  = form.endereco.value;
			var cpf 	  = form.cpf.value;
			var bairro    = form.bairro.value;
			var cep 	  = form.cep.value;
			var pontoref = form.pontoref.value;
			var cidade 	  = form.cidade.value;
			var telfixo   = form.telfixo.value;
			var celular   = form.celular.value;
			var email 	  = form.email.value;
			var profissao = form.profissao.value;
			var facebook  = form.facebook.value;
			var instagram = form.instagram.value;
			var nomeanimal = form.nomeanimal.value;
			var especie = form.especie.value;
			var idade = form.idade.value;
			var sexo = form.sexo.value;
			var cor = form.cor.value;
			var porte = form.porte.value;
			var castrado = form.perg4.value;
			var vermifugado = form.perg5.value;
			var vacinado = form.perg6.value;
			var dtcastracao = form.dtcastracao.value;
			var doses = form.doses.value;
			var possuianimal = form.possuianimal.value;
			var sesimcastrados = form.sesimcastrados.value;
			var lt = form.lt.value;
			var termopor = form.termopor.value;
			var teldoador = form.teldoador.value;
			var emaildoador = form.emaildoador.value;
			var dtadocao = form.dtadocao.value;
			var localadocao = form.localadocao.value;
			
			if (adotante === ""){
				alert('Preencha o campo Nome');
				form.adotante.focus();
				return false;	
			}
			if (rg === ""){
				alert('Preencha o campo RG');
				form.rg.focus();
				return false;	
			}
			if (cpf === ""){
				alert('Preencha o campo CPF');
				form.cpf.focus();
				return false;	
			}
			if (endereco === ""){
				alert('Preencha o campo Endereço');
				form.endereco.focus();
				return false;	
			}
			if (bairro === ""){
				alert('Preencha o campo Bairro');
				form.bairro.focus();
				return false;	
			}
			if (cep === ""){
				alert('Preencha o campo CEP');
				form.cep.focus();
				return false;	
			}
			if (cidade === ""){
				alert('Preencha o campo Cidade');
				form.cidade.focus();
				return false;	
			}
			if (pontoref === ""){
				alert('Preencha o campo Ponto de referência');
				form.pontoref.focus();
				return false;	
			}
			if (celular === ""){
				alert('Preencha o campo Celular');
				form.celular.focus();
				return false;	
			}
			if (email === ""){
				alert('Preencha o campo E-mail');
				form.email.focus();
				return false;	
			}
			if (profissao === ""){
				alert('Preencha o campo Profissão');
				form.profissao.focus();
				return false;	
			}
			if (facebook === ""){
				alert('Preencha o campo Facebook. Caso não possua, preencha N/A');
				form.facebook.focus();
				return false;	
			}
			if (instagram === ""){
				alert('Preencha o campo Instagram. Caso não possua, preencha N/A');
				form.instagram.focus();
				return false;	
			}
			if (nomeanimal === ""){
				alert('Preencha o campo Nome do animal');
				form.nomeanimal.focus();
				return false;	
			}
			if (cor === ""){
				alert('Preencha o campo Cor');
				form.cor.focus();
				return false;	
			}
			if (sexo === "branco"){
				alert('Preencha o campo Sexo');
				form.sexo.focus();
				return false;
			}
			if (document.form.especie[0].checked == false && document.form.especie[1].checked == false){
				alert('Preencha o campo Espécie');
				return false;
			}
			if (document.form.sexo[0].checked == false && document.form.sexo[1].checked == false){
				alert('Preencha o campo Sexo');
				return false;
			}
			if (document.form.porte[0].checked == false && document.form.porte[1].checked == false && document.form.porte[2].checked == false && document.form.porte[3].checked == false){
				alert('Preencha o campo Porte');
				return false;
			}
			if (document.form.castrado[0].checked == false && document.form.castrado[1].checked == false){
				alert('Preencha o campo Castrado');
				return false;
			}
			if (document.form.vacinado[0].checked == false && document.form.vacinado[1].checked == false){
				alert('Preencha o campo Vacinado');
				return false;
			}
			if (document.form.vermifugado[0].checked == false && document.form.vermifugado[1].checked == false){
				alert('Preencha o campo Vermifugado');
				return false;
			}
			if (document.form.possuianimal[0].checked == false && document.form.possuianimal[1].checked == false){
				alert('Preencha o campo Possui animal');
				return false;
			}
			if (document.form.sesimcastrados[0].checked == false && document.form.sesimcastrados[1].checked == false){
				alert('Preencha o campo Se sim, castrados');
				return false;
			}
			if (termopor === ""){
				alert('Preencha o campo Termo preenchido por');
				form.termopor.focus();
				return false;
			}
			if (teldoador === ""){
				alert('Preencha o campo Telefone do doador');
				form.teldoador.focus();
				return false;
			}
			if (emaildoador === ""){
				alert('Preencha o campo E-mail do doador');
				form.emaildoador.focus();
				return false;
			}
			if (dtadocao === ""){
				alert('Preencha o campo Data da adoção');
				form.dtadocao.focus();
				return false;
			}
		}
		
                        
        function OnChangeRadio (radio) {
                document.getElementById('divobstaxa').className  = "d-block";
        }
        
        function OnChangeRadio2 (radio) {
                document.getElementById('divobstaxa').className  = "d-none";
        }
		
		function OnChangeRadio3 (radio) {
                document.getElementById('divfoto').className  = "d-block";
        }
        
        function OnChangeRadio4 (radio) {
                document.getElementById('divfoto').className  = "d-none";
        }
        
        function OnChangeRadio5 (radio) {
                document.getElementById('divfotoad').className  = "d-block";
        }
        
        function OnChangeRadio6 (radio) {
                document.getElementById('divfotoad').className  = "d-none";
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
<?
   while ($fetchpet = mysqli_fetch_row($selectpet)) {
				$nomedoanimal = $fetchpet[1];
				$especie = $fetchpet[2];
				$idade = $fetchpet[3];
				$sexo = $fetchpet[4];
				$cor = $fetchpet[5];
				$porte = $fetchpet[6];
				$castrado = $fetchpet[7];
				$dtcastracao = $fetchpet[8];
				$vacinado = $fetchpet[9];
				$doses =  $fetchpet [22];
				$vermifugado = $fetchpet[21];
				$lt = $fetchpet[11];
				$resp=$fetchpet[12];
    }
    
    
    $queryresp = "SELECT * FROM VOLUNTARIOS WHERE NOME = '$resp'";
	$selectresp = mysqli_query($connect,$queryresp);

    while ($fetchresp = mysqli_fetch_row($selectresp)) {
				$celular = $fetchresp[3];
				$email = $fetchresp[4];
    }

?>
    <form method="POST" name="form" action="cadastrotermo.php" onSubmit="return validar()" enctype="multipart/form-data" >
	  <CENTER>
	        <h3>CADASTRO DE TERMO DE ADOÇÃO</h3>
            <p><label class=".text-danger">Atenção!<br>Todos os campos devem ser preenchidos. Caso não haja informação, preencher com 0</p></label>
      </CENTER>
       <center><h5>DADOS DO ADOTANTE</h5></center>
     <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome: </label> 
                  <div class="col-sm-10">
                    <input name="adotante" type="text" required id="adotante" maxlength="100" class="form-control" value="<? echo $nomeadotante?>">
                  </div>
      </div>
      <div class="form-row">
            <div class="form-group col-md-6">
                  <label>RG: </label>
                    <input type="text" required name="rg" id="rg" maxlength="15" class="form-control" value="<? echo $rg?>">
                    <small id="passwordHelpBlock" class="form-text text-muted"></small>
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
        		            <input type="text" name="numero" id="numero" maxlength="10" required class="form-control" value="<? echo $numero?>"/ >
        		   </div>
        	</div>
        	<div class="form-row">
                    <div class="form-group col-md-6">
                          <label>Bairro: </label>
        		          <input type="text"  name="bairro" id="bairro" maxlength="50" required class="form-control" value="<? echo $bairro?>" />
        		    </div>
        		   <div class="form-group col-md-6">
                          <label>Ponto de referência: </label>
        		            <input type="text"  name="pontoref" id="pontoref" required class="form-control" />
        		   </div>
        	</div>
        	<div class="form-row">
                    <div class="form-group col-md-6">
                          <label>Cidade: </label>
        		          <input type="text"  name="cidade" id="cidade" maxlength="25" required class="form-control" value="<? echo $cidade?>" />
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
		          <input  type="number" pattern="[0-9]*" name="telfixo" id="telfixo" maxlength="12" class="form-control" value="<? echo $telfixo?>">
		          <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (com DDD e sem espaços)</small>
		    </div>
		   <div class="form-group col-md-6">
                  <label>Telefone celular: </label>
		            <input type="number" pattern="[0-9]*" required name="celular" id="celular" maxlength="15" class="form-control" value="<? echo $celularadotante?>">
		            <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (com DDD e sem espaços)</small>
		   </div>
	</div>
	<div class="form-row">
            <div class="form-group col-md-6">
                  <label>E-mail: </label>
		          <input type="email" required name="email" id="email" class="form-control" value="<? echo $emailadotante?>">
		          <small id="passwordHelpBlock" class="form-text text-muted">Máx. 100 caracteres</small>
		    </div>
		   <div class="form-group col-md-6">
                  <label>Profissão: </label>
		            <input type="text" required name="profissao" id="profissao" class="form-control" value="<? echo $profissao?>">
		   </div>
	</div>
	<div class="form-row">
            <div class="form-group col-md-6">
                  <label>Perfil do Facebook: </label>
		          <input type="text" name="facebook" id="facebook" class="form-control" placeholder="http://www.facebook.com/" value="<? echo $facebook?>">
		          <small id="passwordHelpBlock" class="form-text text-muted">Cadastre sem espaços</small>
		    </div>
		   <div class="form-group col-md-6">
                  <label>Perfil do Instagram: </label>
                  <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                            <input type="text" class="form-control" name="instagram" id="instagram" value="<? echo $instagram?>">
                  </div>
                  <small id="passwordHelpBlock" class="form-text text-muted">Cadastre sem espaços</small>
            </div>
	</div>
      <center><h5>DADOS DO ANIMAL</h5></center>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Código: </label> 
                  <div class="col-sm-2">
                    <input type="text" id="idanimal" name="idanimal" value="<? echo $idanimal ?>" readonly class="form-control">
                  </div>
      </div>
      
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome do animal: </label> 
                  <div class="col-sm-5">
                    <input type="text" id="nomeanimal" name="nomeanimal" value="<? echo $nomedoanimal ?>" readonly class="form-control">
                  </div>
      </div>

      <div class="form-row">
            <div class="form-group col-md-6">
                  <label>Nascimento (aproximado): </label>
                    <input name="idade" type="date" id="idade" class="form-control" value="<? echo $idade?>" readonly>
            </div>
            <div class="form-group col-md-6">
                  <label>Cor: </label>
                    <input name="cor" type="text" id="cor" maxlength="30" class="form-control" value="<? echo $cor?>" readonly>
            </div>
      </div>
      <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Espécie: </legend>
                      <div class="col-sm-10">
                            <?
                                if ($especie == 'Felina'){
                                    echo "<div class='form-check'>";
                                    echo "<input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' readonly><label class='form-check-label' for='gridRadios1' required>Canina</label>
                                        </div>
                                        <div class='form-check'>
                                          <input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' checked readonly><label class='form-check-label' for='gridRadios1' required>Felina</label>
                                        </div>";
                                } else {
                                    echo "<div class='form-check'>";
                                    echo "<input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' readonly checked><label class='form-check-label' for='gridRadios1' required>Canina</label>
                                        </div>
                                        <div class='form-check'>
                                          <input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' readonly><label class='form-check-label' for='gridRadios1' required>Felina</label>
                                        </div>";
                                    }
                            ?>
                        </div>
                    </div>
            </div>
      </fieldset>
       <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Sexo: </legend>
                      <div class="col-sm-10">
                            <?
                                if ($sexo == 'Fêmea'){
                                    echo "<div class='form-check'>";
                                    echo "<input class='form-check-input' type='radio' name='sexo' id='Fêmea' value='Fêmea' checked readonly><label class='form-check-label' for='gridRadios1' required>Fêmea</label>
                                        </div>
                                        <div class='form-check'>
                                          <input class='form-check-input' type='radio' name='sexo' id='Macho' value='Macho' readonly><label class='form-check-label' for='gridRadios1' required>Macho</label>
                                        </div>";
                                } else {
                                    echo "<div class='form-check'>";
                                    echo "<input class='form-check-input' type='radio' name='sexo' id='Fêmea' value='Fêmea' readonly><label class='form-check-label' for='gridRadios1' required>Fêmea</label>
                                        </div>
                                        <div class='form-check'>
                                          <input class='form-check-input' type='radio' name='sexo' id='Macho' value='Macho' checked readonly><label class='form-check-label' for='gridRadios1' required>Macho</label>
                                        </div>";
                                    }
                            ?>
                        </div>
                    </div>
            </div>
      </fieldset>
     
     <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Porte: </legend>
                      <div class="col-sm-10">
                            <?
                                if ($porte == 'Pequeno'){
                                    echo "<div class='form-check'>
                                            <input class='form-check-input'  name='porte' type='radio' value='Pequeno' checked><label class='form-check-label' for='gridRadios1' required>Pequeno</label>
                                           </div>
                                           <div class='form-check'>
                                            <input class='form-check-input'  name='porte' type='radio' value='Médio'><label class='form-check-label' for='gridRadios1' required>Médio</label>
                                            </div>
                                           <div class='form-check'>
                                            <input class='form-check-input'  name='porte' type='radio' value='Grande'><label class='form-check-label' for='gridRadios1' required>Grande</label>
                                           </div>
                                           <div class='form-check'>    
                                            <input class='form-check-input'  name='porte' type='radio' value='N/A'><label class='form-check-label' for='gridRadios1' required>Gato</label>
                                           </div>";
                                            
                                } 
                                if ($porte == 'Médio'){
                                    echo "<div class='form-check'>
                                            <input class='form-check-input'  name='porte' type='radio' value='Pequeno'><label class='form-check-label' for='gridRadios1' required>Pequeno</label>
                                           </div>
                                           <div class='form-check'>
                                            <input class='form-check-input'  name='porte' type='radio' value='Médio' checked><label class='form-check-label' for='gridRadios1' required>Médio</label>
                                            </div>
                                           <div class='form-check'>
                                            <input class='form-check-input'  name='porte' type='radio' value='Grande'><label class='form-check-label' for='gridRadios1' required>Grande</label>
                                           </div>
                                           <div class='form-check'>    
                                            <input class='form-check-input'  name='porte' type='radio' value='N/A'><label class='form-check-label' for='gridRadios1' required>Gato</label>
                                           </div>";
                                }
                                if ($porte == 'Grande'){
                                   echo "<div class='form-check'>
                                            <input class='form-check-input'  name='porte' type='radio' value='Pequeno'><label class='form-check-label' for='gridRadios1' required>Pequeno</label>
                                           </div>
                                           <div class='form-check'>
                                            <input class='form-check-input'  name='porte' type='radio' value='Médio'><label class='form-check-label' for='gridRadios1' required>Médio</label>
                                            </div>
                                           <div class='form-check'>
                                            <input class='form-check-input'  name='porte' type='radio' value='Grande' checked><label class='form-check-label' for='gridRadios1' required>Grande</label>
                                           </div>
                                           <div class='form-check'>    
                                            <input class='form-check-input'  name='porte' type='radio' value='N/A'><label class='form-check-label' for='gridRadios1' required>Gato</label>
                                           </div>";
                                } 
                                if ($porte == 'Não se aplica'){
                                    echo "<div class='form-check'>
                                            <input class='form-check-input'  name='porte' type='radio' value='Pequeno'><label class='form-check-label' for='gridRadios1' required>Pequeno</label>
                                           </div>
                                           <div class='form-check'>
                                            <input class='form-check-input'  name='porte' type='radio' value='Médio'><label class='form-check-label' for='gridRadios1' required>Médio</label>
                                            </div>
                                           <div class='form-check'>
                                            <input class='form-check-input'  name='porte' type='radio' value='Grande' ><label class='form-check-label' for='gridRadios1' required>Grande</label>
                                           </div>
                                           <div class='form-check'>    
                                            <input class='form-check-input'  name='porte' type='radio' value='N/A' checked><label class='form-check-label' for='gridRadios1' required>Gato</label>
                                           </div>";
                                } 
                            ?>
                        </div>
                    </div>
    </fieldset>
      <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Castrado? </legend>
                      <div class="col-sm-10">
                            <?
                                if ($castrado == 'Sim'){
                                    echo "<div class='form-check'>";
                                    echo "<input class='form-check-input' type='radio' name='castrado' id='castrado' value='Sim' checked><label class='form-check-label' for='gridRadios1' required>Sim</label>
                                        </div>
                                        <div class='form-check'>
                                          <input class='form-check-input' type='radio' name='castrado' id='castrado' value='Não'><label class='form-check-label' for='gridRadios1' required>Não</label>
                                        </div>";
                                } else {
                                    echo "<div class='form-check'>";
                                    echo "<input class='form-check-input' type='radio' name='castrado' id='castrado' value='Sim'><label class='form-check-label' for='gridRadios1' required>Sim</label>
                                        </div>
                                        <div class='form-check'>
                                          <input class='form-check-input' type='radio' name='castrado' id='castrado' value='Não' checked><label class='form-check-label' for='gridRadios1' required>Não</label>
                                        </div>";
                                    }
                            ?>
                        </div>
                    </div>
            </div>
      </fieldset>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Data da castração:</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="date" name="dtcastracao" id="dtcastracao" value="<? echo $dtcastracao?>">
                  </div>
       </div>
       <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Vermifugado? </legend>
                      <div class="col-sm-10">
                            <?
                                if ($vermifugado == 'Sim'){
                                        echo "<div class='form-check'>
                                                <input class='form-check-input' name='vermifugado' id='vermifugado' type='radio' value='Sim' checked><label class='form-check-label' for='gridRadios1' required>Sim</label>
                                              </div>
                                              <div class='form-check'>
                                                <input class='form-check-input' name='vermifugado' id='vermifugado' type='radio' value='Não'><label class='form-check-label' for='gridRadios1' required>Não</label>
                                              </div>";
                                } else {
                                        echo "<div class='form-check'>
                                                <input class='form-check-input' name='vermifugado' id='vermifugado' type='radio' value='Sim'><label class='form-check-label' for='gridRadios1' required>Sim</label>
                                              </div>
                                              <div class='form-check'>
                                                <input class='form-check-input' name='vermifugado' id='vermifugado' type='radio' value='Não' checked><label class='form-check-label' for='gridRadios1' required>Não</label>
                                              </div>";
                                }
                            ?>
                        </div>
                    </div>
        </fieldset>
        <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Vacinado? </legend>
                      <div class="col-sm-10">
                            <?
                                if ($vacinado == 'Sim'){
                                        echo "<div class='form-check'>
                                                <input class='form-check-input'  name='vacinado' type='radio' value='Sim' checked><label class='form-check-label' for='gridRadios1' required>Sim</label>
                                              </div>
                                              <div class='form-check'>
                                                <input class='form-check-input'  name='vacinado' type='radio' value='Não'><label class='form-check-label' for='gridRadios1' required>Não</label>
                                              </div>";
                                } else {
                                        echo "<div class='form-check'>
                                                <input class='form-check-input'  name='vacinado' type='radio' value='Sim'><label class='form-check-label' for='gridRadios1' required>Sim</label>
                                              </div>
                                              <div class='form-check'>
                                                <input class='form-check-input'  name='vacinado' type='radio' value='Não' checked><label class='form-check-label' for='gridRadios1' required>Não</label>
                                              </div>";
                                }
                            ?>
                        </div>
                    </div>
        </fieldset>
        <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Doses: </legend>
                      <div class="col-sm-10">
                      <?
                      if ($doses == '1'){
                                        echo "<div class='form-check'>
                                                <input class='form-check-input'  name='doses' type='radio' value='01' checked><label class='form-check-label' for='gridRadios1' required>01</label>
                                              </div>
                                              <div class='form-check'>
                                                <input class='form-check-input'  name='doses' type='radio' value='02'><label class='form-check-label' for='gridRadios1' required>02</label>
                                              </div>
                                              <div class='form-check'>
                                                <input class='form-check-input'  name='doses' type='radio' value='03'><label class='form-check-label' for='gridRadios1' required>03</label>
                                              </div>";
                        }
                        if ($doses == '2'){
                                        echo "<div class='form-check'>
                                                <input class='form-check-input'  name='doses' type='radio' value='01'><label class='form-check-label' for='gridRadios1' required>01</label>
                                              </div>
                                              <div class='form-check'>
                                                <input class='form-check-input'  name='doses' type='radio' value='02' checked><label class='form-check-label' for='gridRadios1' required>02</label>
                                              </div>
                                              <div class='form-check'>
                                                <input class='form-check-input'  name='doses' type='radio' value='03'><label class='form-check-label' for='gridRadios1' required>03</label>
                                              </div>";
                        }
                        if ($doses == '3'){
                                        echo "<div class='form-check'>
                                                <input class='form-check-input'  name='doses' type='radio' value='01'><label class='form-check-label' for='gridRadios1' required>01</label>
                                              </div>
                                              <div class='form-check'>
                                                <input class='form-check-input'  name='doses' type='radio' value='02'><label class='form-check-label' for='gridRadios1' required>02</label>
                                              </div>
                                              <div class='form-check'>
                                                <input class='form-check-input'  name='doses' type='radio' value='03' checked><label class='form-check-label' for='gridRadios1' required>03</label>
                                              </div>";
                        }
                            ?>
                    </div>
                     </div>
        </fieldset>
        <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Possui outros animais em casa? </legend>
                      <div class="col-sm-10">
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
                      <legend class="col-form-label col-sm-2 pt-0">Se sim, estão castrados? </legend>
                      <div class="col-sm-10">
                            <div class='form-check'>
                                <input class='form-check-input'  name='sesimcastrados' type='radio' value='Sim' checked><label class='form-check-label' for='gridRadios1' required>Sim</label>
                            </div>
                            <div class='form-check'>
                                <input class='form-check-input'  name='sesimcastrados' type='radio' value='Não' checked><label class='form-check-label' for='gridRadios1' required>Não</label>
                            </div>
                            <div class='form-check'>
                                <input class='form-check-input'  name='sesimcastrados' type='radio' value='Não' checked><label class='form-check-label' for='gridRadios1' required>Não possui animais</label>
                            </div>
                      </div>
                     </div>
        </fieldset>
    <center><h5>DADOS DO DOADOR/RESPONSÁVEL</h5></center>
    <div class="form-group row">
                  <div class="form-group col-md-6">
                    <label>Lar temporário: </label> 
                    <input type="text" id="lt" name="lt" value="<? echo $lt ?>" readonly class="form-control">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Termo preenchido por: </label> 
                    <select class="form-control" id="termopor" name="termopor" required>
                     		  <option selected value="">Selecione</option>
                         		  <?
                        		 		$querytermopor = "SELECT NOME FROM VOLUNTARIOS WHERE (AREA <> 'anuncios' and AREA <> 'clinica') AND STATUS_APROV='Aprovado' ORDER BY NOME ASC";
                        				$selecttermopor = mysqli_query($connect,$querytermopor);
                        				
                        				while ($fetchtermopor = mysqli_fetch_row($selecttermopor)) {
                        					echo "<option value='".$fetchtermopor[0]."'>".$fetchtermopor[0]."</option>";
                        				}
                        		    ?>
                    </select>
                    <!--<input type="text" required name="termopor" maxlength="20" id="termopor" class="form-control">-->
                  </div>
    </div>
    <div class="form-row">
            <div class="form-group col-md-6">
                  <label>Telefone do responsável: </label>
                    <input type="text" required name="teldoador" maxlength="12" id="teldoador" value="<? echo $celular?>" readonly class="form-control">
            </div>
            <div class="form-group col-md-6">
                  <label>E-mail do responsável: </label>
                    <input type="text" required name="emaildoador" maxlength="50" id="emaildoador" value="<? echo $email?>" readonly class="form-control">
            </div>
    </div>
     <div class="form-row">
            <div class="form-group col-md-6">
                  <label>Data da adoção: </label>
                    <input type="date" required name="dtadocao" id="dtadocao" class="form-control">
            </div>
            <div class="form-group col-md-6">
                  <label>Local da adoção: </label>
                      <select class="form-control" id="localadocao" name="localadocao" required onchange="showDivEvento(this)">
                 		  <option selected value="">Selecione</option>
                 		  <option value="Eventos">Eventos</option>
                 		  <option value="Fora da feira">Fora da feira</option>
                 		  <option value="Petcamp Barão Geraldo">Petcamp Barão Geraldo</option>
                          <option value="Via internet - Feira">Via internet - Feira</option>
                      </select>
                      <script type="text/javascript">
                            function showDivEvento(select){
                                var select = document.getElementById('localadocao');
                                var valor = select.options[select.selectedIndex].value;
                                if( valor =="Eventos"){
                                    document.getElementById('divlocalevento').style.display = "block";
                                } else{
                                    document.getElementById('divlocalevento').style.display = "none";
                                }
                            }
                      </script>
                  <div class="d-none" id="divlocalevento">
                    <label>Nome do local: </label>
                    <input type="text" required name="localevento" maxlength="50" id="localevento" value="<? echo $localevento?>" class="form-control">
                  </div>
            </div>
            
    </div>
	<fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-3 pt-0">Forma de pagamento da taxa: </legend>
                      <div class="col-sm-7">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="pgtotaxa" id="pgtotaxa" value="Dinheiro" onclick="OnChangeRadio2 (this)"><label class="form-check-label">Dinheiro </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="pgtotaxa" id="pgtotaxa" value="Débito" onclick="OnChangeRadio2 (this)"><label class="form-check-label">Cartão - débito </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="pgtotaxa" id="pgtotaxa" value="Crédito" onclick="OnChangeRadio2 (this)"><label class="form-check-label">Cartão - crédito </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="pgtotaxa" id="pgtotaxa" value="PIX" onclick="OnChangeRadio2 (this)"><label class="form-check-label">PIX </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="pgtotaxa" id="pgtotaxa" value="Sem taxa" onclick="OnChangeRadio (this)"><label class="form-check-label">Sem taxa </label>
                        </div>
                       </div>
                    </div>
    </fieldset>
    <div id="divobstaxa" class="form-row d-none">
       <div class="form-row">
            <input type="textarea" required name="obstaxa" maxlength="1000" id="obstaxa" class="form-control">
        </div>
      </div>
    <br>

    <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-3 pt-0">Deseja incluir a foto do termo? </legend>
                      <div class="col-sm-7">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="updatefoto" id="updatefoto" value="Sim" onclick="OnChangeRadio3 (this)"><label class="form-check-label">Sim </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="updatefoto" id="updatefoto" value="Não" onclick="OnChangeRadio4 (this)"><label class="form-check-label">Não</label>
                        </div>
                       </div>
                    </div>
    </fieldset>
      <div id="divfoto" class="form-row d-none">
      <div class="col-sm-09">
                <input type="file" class="form-control-file" id="foto" name="foto">
                <small id="passwordHelpBlock" class="form-text text-muted">Escolher arquivo (nome do arquivo sem espaço)</small>
       </div>
      </div>
      <br>
      <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-3 pt-0">Deseja incluir a foto dos adotantes? </legend>
                      <div class="col-sm-07">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="updatefotoad" id="updatefotoad" value="Sim" onclick="OnChangeRadio5 (this)"><label class="form-check-label">Sim </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="updatefotoad" id="updatefotoad" value="Não" onclick="OnChangeRadio6 (this)"><label class="form-check-label">Não</label>
                        </div>
                       </div>
                    </div>
      </fieldset>
      <div id="divfotoad" class="form-row d-none">
       <div class="col-sm-09">
                <input type="file" class="form-control-file" id="fotoad" name="fotoad">
                <small id="passwordHelpBlock" class="form-text text-muted">Escolher arquivo (nome do arquivo sem espaço)</small>
       </div>
       <fieldset class="form-group">
                <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">O adotante autoriza o uso da imagem no site e redes sociais? </legend>
                        <div class="col-sm-07">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="autorizaimagem" id="autorizaimagemsim" value="Sim"><label class="form-check-label">Sim </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="autorizaimagem" id="autorizaimagemnao" value="Não"><label class="form-check-label">Não</label>
                            </div>
                        </div>
                </div>
        </fieldset>
      </div>
    <br>
        <center><a href="javascript:form.submit()" class="btn btn-primary">Cadastrar</a></center>
    <br>	
	   <center><font color="red">Após o cadastro, por gentileza anote o número do termo que irá aparecer no popup no papel e entregue ao setor Operacional para arquivamento</font> <br><br>
   </div>
   </form>
<?
    }
    mysqli_close($connect);
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