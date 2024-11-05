<?php 

session_start();

include ("conexao.php");

$login = $_GET['login'];
$idvol = $_GET['idvol'];
//$funcao = $_GET['atualiza'];
$ano_atu= date("Y");

if ($login != '') {
    $queryarea = "SELECT * FROM VOLUNTARIOS WHERE USUARIO ='$login'";
	$selectarea = mysqli_query($connect,$queryarea);
	
	while ($fetcharea = mysqli_fetch_row($selectarea)) {
			$usuariobd =  $fetcharea[0];
			$senhabd =  $fetcharea[1];
			$nome = $fetcharea[2];
			$area = $fetcharea[5];
			$subarea = $fetcharea[6];
			$celular = $fetcharea[3];
			$email = $fetcharea[4];
			$cpfcnpj =  $fetcharea[9];
			$rg =  $fetcharea[11];
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
			$status = $fetcharea[25];
	}

    switch ($area) {
    case 'admin':
        $descricaoarea = 'Administrativo';
        break;
        
    case 'captacao':
        $descricaoarea = 'Captação';
        break;
  
    case 'financeiro':
        $descricaoarea = 'Financeiro';
        break;
        
    case 'comunicacao':
        $descricaoarea = 'Comunicação';
        break;
        
    case 'operacional':
        $descricaoarea = 'Operacional';
        break;
        
    case 'diretoria':
        $descricaoarea = 'Diretoria';
        break;
}


    switch ($subarea) {
    case 'admin':
        $descricaosubarea = 'Administrativo';
        break;
        
    case 'assessoria':
        $descricaosubarea = 'Assessoria';
        break;
        
    case 'bazar':
        $descricaosubarea = 'Bazar';
        break;
  
    case 'cadastrotermo':
        $descricaosubarea = 'Cadastro de termos de adoção';
        break;
        
    case 'caosciencia':
        $descricaosubarea = 'Cãosciencia Pet';
        break;
        
    case 'contabil':
        $descricaosubarea = 'Contabilidade';
        break;
        
    case 'designer':
        $descricaosubarea = 'Designer';
        break;
        
    case 'feira':
        $descricaosubarea = 'Feira';
        break;
        
    case 'financeiro':
        $descricaosubarea = 'Financeiro';
        break;
        
    case 'lt':
        $descricaosubarea = 'Lar temporário';
        break;
        
    case 'notas':
        $descricaosubarea = 'Cadastro de notas fiscais';
        break;
        
    case 'operacional':
        $descricaosubarea = 'Operacional';
        break;
        
    case 'eventos':
        $descricaosubarea = 'Organizador de eventos';
        break;
        
    case 'posadocao':
        $descricaosubarea = 'Pós adoção';
        break;
        
    case 'redes':
        $descricaosubarea = 'Redes sociais';
        break;
        
    case 'site':
        $descricaosubarea = 'Site';
        break;
    
    case 'vet':
        $descricaosubarea = 'Veterinários parceiros';
        break;
        
    case 'diretoria':
        $descricaosubarea = 'Diretoria';
        break;
}

} else {
    echo "<script type='text/javascript'>
            function divs () {
                                document.getElementById('divcadastro').className  = 'd-block';
                                document.getElementById('divlogin').className  = 'd-block';
                                document.getElementById('divatualiza').className  = 'd-none';
                                
                        }
          </script>
    
    ";   
    $query = "SELECT * FROM FORM_VOLUNTARIO WHERE ID ='$idvol' ORDER BY ID DESC";
	$select = mysqli_query($connect,$query);
	$reccount = mysqli_num_rows($select);
	$fetch = mysqli_fetch_row($select);
	
    $nomecandidvol = $fetch[1];	
    $dtnascvol = $fetch[3];
    $telcandidvol = $fetch[4];	
    $emailcandidvol = $fetch[5];	
	$areacandidvol = $fetch[6];
	$comopodeajudar = $fetch[7];
	$dtcandidvol = $fetch[23];
	$cidadevol = $fetch[2];
	$bairrovol = $fetch[20];
	$enderecovol = $fetch[21];
	$senha_padrao = "Gaar".$ano_atu."@@";
    
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
    
    <title>GAAR - Cadastro de novos voluntários</title>
	<script type="text/javascript">
	function cadastro(){
		document.form.action = 'cadastro.php'; 
		document.form.submit();
	}
	function atualiza(){
		document.form.action = 'atualizadados.php'; 
		document.form.submit();
	}
	function deleta(){
		document.form.action = 'deleta.php'; 
		document.form.submit();
	}
	function seleciona(){
		document.form.action = 'seleciona.php'; 
		document.form.submit();
	}
	
	</script>
</head>
<body onload="divs()"> 
<script type="text/javascript">
<?

	    if ($funcao == '') {
	        echo "
	                function divs () {
                                        document.getElementById('divcadastro').className  = 'd-block';
                                        document.getElementById('divlogin').className  = 'd-block';
                                        document.getElementById('divatualiza').className  = 'd-none';
                                        
                                }
	        
	        ";
	    } else {
	        echo "
	                function divs () {
                                        document.getElementById('divcadastro').className  = 'd-none';
                                        document.getElementById('divatualiza').className  = 'd-block';
                                        
                                }
	        
	        ";
	    }
?>
</script>
<main role="main" class="container">
    <div class="starter-template">
        <center><img src="logo pequeno.png"><br><br></center>
       <div id="divcadastro" class="form-row d-none">
            <center>
    	        <h3>CADASTRO DE VOLUNTÁRIOS</h3>
            </CENTER>
            <br>
             <p>Seja bem vindo(a) ao GAAR! <br>Faça seu cadastro e tenha acesso ao nosso sistema interno. <br>Lá é possível cadastrar animais da ONG, termos de adoção, consultar relatórios, etc</p><br>
             <h4> LEI DO VOLUNTARIADO</h4><br>
             <p><strong>Alteração na Lei nº 13.297, em 16 de junho de 2016 <br><br></strong>
                <i>Lei nº 13.297, de 16 de junho de 2016</i><br><br>
                
                O Ato em referência altera o artigo 1º da Lei 9.608, de 18/02/98, para incluir a assistência à pessoa como objetivo de atividade não remunerada reconhecida como serviço voluntário.<br><br>
                
                Art. 1º O caput do art. 1º da Lei nº 9.608, de 18 de fevereiro de 1998, passa a vigorar com a seguinte redação:<br>
                “Art. 1º Considera-se serviço voluntário, para os fins desta Lei, a atividade não remunerada prestada por pessoa física a entidade pública de qualquer natureza ou a instituição privada de fins não lucrativos que tenha objetivos cívicos, culturais, educacionais, científicos, recreativos ou de assistência à pessoa.”<br>
                Art. 2º Esta Lei entra em vigor na data de sua publicação.<br><br>
                
                <strong><i>Michel Temer<br>
                Alexandre de Moraes<br>
                Ronaldo Nogueira de Oliveira<br>
                Brasília, 16 de junho de 2016. </i></strong><br><br>
                
                <i>Lei nº 9.608, de 18 de fevereiro de 1998</i><br><br>
                
                Dispõe sobre o serviço voluntário e dá outras providências<br><br>
                
                Art. 1° – Considera-se serviço voluntário, para fins desta Lei, a atividade não remunerada, prestada por pessoa física a entidade pública de qualquer natureza, ou a Instituição privada de fins não lucrativos, que tenha objetivos cívicos, culturais, educacionais, científicos, recreativos ou de assistência social, inclusive mutualidade.<br><br>
                
                Parágrafo único. O serviço voluntário não gera vínculo empregatício, nem obrigação de natureza trabalhista, previdenciária ou afim.<br><br>
                
                Art. 2° – O serviço voluntário será exercido mediante a celebração de Termo de Adesão entre a entidade, pública ou privada, e o prestador do serviço voluntário, dele devendo constar o objeto e as condições de seu exercício.<br>
                
                Art. 3° – O prestador de serviço voluntário poderá ser ressarcido pelas despesas que comprovadamente realizar no desempenho das atividades voluntárias.<br><br>
                
                Parágrafo único. As despesas a serem ressarcidas deverão estar expressamente autorizadas pela entidade a que for prestado o serviço voluntário.<br><br>
                
                Art. 4° – Esta Lei entra em vigor na data de sua publicação.<br>
                
                Art. 5° – Revogam-se as disposições em contrário.<br><br>
                
                <i><strong>Fernando Henrique Cardoso<br>
                Brasília, 18 de fevereiro de 1998; 177º da Independência e 110º da República.</p><br></i></strong>
                
            <p><h3>Como escolher a área de atuação?</h3></p><br>
    	       <h4>Administração</h4><br>
                    <p>
    	            Para executar as atividades, o departamento administrativo necessita de um voluntário, com conhecimento básico de contabilidade e administração de empresas, MS Excel, e perfil adequado. <br><br>
                        DIÁRIA<br>
                        •	Controle e realização de Pagamentos e controle dos recebimentos;<br>
                        •	Monitoramento do extrato das contas bancárias;<br><br>
                        MENSAL<br>
                        •	Extração dos relatórios mensais de receitas e despesas através da área restrita e apresentá-los à Diretoria e ao Conselho Fiscal<br><br>
                        BIMESTRAL<br>
                        •	Convocar e presidir as reuniões da Diretoria; <br>
                        •	Convocar e presidir as reuniões Dos voluntários;<br><br>
                        
                        SEMESTRAL<br>
                        •	Convocar as Assembleias Gerais<br>
                        •	Apresentar relatório financeiro para ser submetido à Assembleia Geral<br>
                        •	Apresentar, semestralmente, o balancete ao Conselho Fiscal<br><br>
                        
                        ESPORÁDICA<br>
                        •	Carregar documentação da ONG no repositório<br><br>
                        
                        O perfil exigido para o voluntário que pretende se dedicar a essa atividade é de alguém comprometido, discreto e confiável, sem prejuízo de possuir conhecimento intermediário de MS Excel, conhecimento e facilidade com a área administrativa, financeira e contábil e elaboração de relatórios.<br>
                        O voluntário que trabalha na admninistração deve cumprir o dever de guardar sigilo quanto aos números e dados que têm conhecimento, ciente que só é permitido informar valores, saldos ou outros dados financeiros somente para a Diretoria, quando por ela solicitado ou somente divulgá-los mediante consentimento da Diretoria Colegiada.<br>
                        Muito importante haver sempre pelo menos dois voluntários (diretor administrativo e mais um) monitorando as contas bancárias e operação da ONG. Nunca deixar essa atividade para um indivíduo isoladamente. Desconfiar de quem aceite fazer isso sem monitoramento.<br><br>
    	        </p>
    	    <h4>Captação</h4><br>
            	<p>
    	            MENSAL<br>
                    •	Participar do bazar <br>
                    •	Ajudar na arrumação do depósito<br>
                    •	Levar o material até o local do Bazar (voluntário com carro);<br>
                    •	Vender os produtos no Bazar;<br>
                    •	Levar o material de volta pro depósito;<br>
                    •	Inclusão do relatório dos eventos no sistema;<br>
                    •	Divulgar as atividades do Bazar nas redes sociais<br><br>
    
            	</p>
    	   <h4>Comunicação</h4><br>
    	        <p>
    	            DIÁRIO<br>
                    •	Inclusão de posts sobre ações ligadas aos animais (adoção, pós-adoção, mutirões de castração etc), eventos beneficentes, campanhas, chamadas de apoio direto ou indireto ao trabalho da ONG, informações sobre a atuação do GAAR nas redes sociais<br>
                    •	Divulgação dos produtos da ONG para anglariar recursos;<br>
                    •	Inclusão de posts sobre conscientização destacando a importância da castração, adoção responsável, guarda responsável e o combate ao abandono e aos maus tratos<br>
                    •	Inclusão dos animais no sistema<br>
                    •	Autorização de posts de pedidos de terceiros<br><br>
    
    	        </p>
    	   <h4>Financeiro</h4><br>
    	        <p>
    	            SEMANAL<br>
                    •	Inclusão de lançamentos bancários no sistema para controle e relatório<br><br>
    
                </p>
    	   <h4>Operacional</h4><br>
    	        <p>
    	            LAR TEMPORÁRIO<br>
                •	Inclusão e atualização de animais no sistema<br>
    	        </p>      
    	        <p>
    	            DIÁRIO<br>
                    •	Inclusão de animais e termos de adoção no sistema<br>
    	        </p>
    	        <p>
    	            PÓS ADOÇÃO<br>
                    •	Atualizar o termo quando o e-mail do adotante for respondido<br>
    	        </p>
        <br>
            <h4>FAÇA SEU CADASTRO AQUI</h4>
            <br>
        </div>
        <!--<div id="divatualiza" class="form-row d-none">
            <center>
    	        <h3>ATUALIZE SEUS DADOS</h3>
            </CENTER>
            <br>
            <p> Para prosseguir é necessário completar o seu cadastro. Por gentileza, preencha todos os campos.</p><br>
        </div>-->
            <p> Todos os campos são <strong><font color="red">obrigatórios</font></strong></p>
            <form method="POST" name="form" action=login.html>
             <div id="divlogin" class="form-row d-none">    
        	    <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Login: <font color="red">*</font></label> 
                          <div class="col-sm-4">
                            <input name="login" type="text" id="login" size="30" maxlength="30" class="form-control" value="<?echo $emailcandidvol?>"> 
                            <small id="passwordHelpBlock" class="form-text text-muted">será o seu login de acesso ao sistema</small>
                            <input name="idvol" type="text" id="idvol" size="30" maxlength="30" class="form-control" value="<?echo $idvol?>" hidden> 
                          </div>
                </div>
                <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Senha: <font color="red">*</font></label> 
                          <div class="col-sm-4">
                            <input name="senha" type="password" id="senha" size="30" maxlength="32" class="form-control" value="<?echo $senha_padrao?>">
                            <small>A senha é pré definida para novos cadastros aprovados via Captação. Por favor, altere assim que possível.</small>
                          </div>
                </div>
             </div>
                <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nome completo: <font color="red">*</font></label> 
                          <div class="col-sm-4">
                            <input name="nome" type="text" id="nome" size="50" maxlength="50" class="form-control" value="<? echo $nomecandidvol ?>">
                          </div>
                </div>
                <div class="form-row">
                            <label class="col-sm-3 col-form-label">RG: <font color="red">*</font></label>
                            <div class="col-sm-4">
                                    <input type="text" required name="rg" id="rg" maxlength="10" class="form-control" value="<? echo $rg ?>">
                                    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
                            </div>
                </div>
                <div class="form-row">
                            <label class="col-sm-3 col-form-label">CPF: <font color="red">*</font></label>
                            <div class="col-sm-4">
                                    <input type="text" required name="cpf" id="cpf" maxlength="12" class="form-control" value="<? echo $cpfcnpj?>">
                                    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
                            </div>
                </div>
                <div class="form-row">
                    <label class="col-sm-3 col-form-label">CEP: <font color="red">*</font></label>
                    <div class="col-sm-4">
                                	    <input name="cep" type="text" id="cep" size="10" maxlength="9" required class="form-control" value="<? echo $cep?>" onblur="pesquisacep(this.value);" />
                                	    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-sm-3 col-form-label">Endereço: <font color="red">*</font></label>
                        <div class="col-sm-7">
                    		          <input type="text" name="endereco" id="endereco" maxlength="200" required class="form-control" value="<? echo $enderecovol?>" />
                        </div>
                </div>    
                <br>
                   <div class="form-row">
                    <label class="col-sm-3 col-form-label">Complemento: <font color="red">*</font></label>
                        <div class="col-sm-4">
                    		          <input type="text" name="complemento" id="complemento" maxlength="20" class="form-control" value="<? echo $complementovol?>" />
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
                    		          <input type="text"  name="bairro" id="bairro" maxlength="50" required class="form-control" value="<? echo $bairrovol?>" />
                    		</div>
                    </div>
                    <br>
                    <div class="form-row">
                        <label class="col-sm-3 col-form-label">Cidade: <font color="red">*</font></label>
                            <div class="col-sm-4">
                    		          <input type="text"  name="cidade" id="cidade" maxlength="25" required class="form-control" value="<? echo $cidadevol?>" />
                    		</div>
                    </div>
                    <br>
                    <div class="form-row">
                        <label class="col-sm-3 col-form-label">Estado: <font color="red">*</font></label>
                            <div class="col-sm-4">
                    		            <input type="text" required name="estado" id="estado" maxlength="5" required class="form-control" value="<? echo $estado?>" />
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
                        <label class="col-sm-3 col-form-label">Celular: <font color="red">*</font></label>
                            <div class="col-sm-4">
                                <input type="text" name="celular" id="celular" size="20" maxlength="15" class="form-control" value="<? echo $telcandidvol ?>">
                                <small id="passwordHelpBlock" class="form-text text-muted">Apenas números, sem espaço e sem hífen</small>
                          </div>
            	</div>
            	<div class="form-row">
                        <label class="col-sm-3 col-form-label">E-mail: <font color="red">*</font></label>
                            <div class="col-sm-4">
                		          <input name="email" type="text" id="email" maxlength="100" class="form-control" required value="<? echo $emailcandidvol?>">
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
            		            <input type="date" name="nascimento" id="nascimento" class="form-control" value="<? echo $dtnascvol?>" required>
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
                <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Área: <font color="red">*</font></label> 
                          <div class="col-sm-4">
                              <select name="area" class="form-control">
                        			<option name="" value="">Selecione</option>
                        			<option name="" value="administracao">Administrativo</option>
                        			<option name="" value="captacao">Captação</option>
                        			<option name="" value="comunicacao">Comunicação</option>
                        			<option name="" value="financeiro">Financeiro</option>
                        			<option name="" value="operacional">Operacional</option>
                        		</select>
                    	  </div>
                </div>
                <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Subárea: <font color="red">*</font></label> 
                          <div class="col-sm-4">
                    			<select name="subarea" class="form-control">
                    			    <option name="" value="<?echo $areacandidvol?>"><?echo $areacandidvol?></option>
                    			    <option name="" value="">---------------</option>
                    			    <option name="" value="">Selecione</option>
                    			    <option name="" value="admin">Administrativo</option>
                        			<option name="" value="bazar">Bazar</option>
                        			<option name="" value="cadastrotermo">Cadastro de termos de adoção</option>
                        			<option name="" value="cadastropet">Cadastro de animais</option>
                        			<option name="" value="contabil">Contabilidade</option>
                        			<option name="" value="designer">Designer</option>
                        			<option name="" value="feira">Feira</option>
                        			<option name="" value="financeiro">Financeiro</option>
                        			<option name="" value="lt">Lar temporário</option>
                        			<option name="" value="notas">Notas fiscais</option>
                        			<option name="" value="operacional">Operacional</option>
                        			<option name="" value="eventos">Organizador de eventos</option>
                        			<option name="" value="posadocao">Pós adoção</option>
                        			<option name="" value="redes">Redes sociais</option>
                        			<option name="" value="site">Site</option>
                        			<option name="" value="vet">Veterinários parceiros</option>
                        		</select>
                    	  </div>
                </div>
            </div>
        </div>
            <div class="form-group row">
                      <div class="col-sm-4">
                          <?
                            if ($login != '') {
                               echo "<center><input type='submit' value='Atualizar' id='atualizar' name='atualizar' onClick='atualiza();' class='btn btn-primary'> &nbsp;</center>" ;
                            } else {
                               echo "<center><input type='submit' value='Cadastrar' id='cadastrar' name='cadastrar' onClick='cadastro();' class='btn btn-primary'> &nbsp;</center>" ;
                            }
                          ?>
                	    
    		            <!--<input type="submit" value="Atualizar" id="atualizar" name="atualizar" onClick="atualiza();">-->
                	  </div>
            </div>
        </div>
        </form>
        <br>
<?
}
fclose($fp); 
mysqli_close($connect);

?>
</main>
<footer class="footer">
      <div class="container">
        <span class="text-muted"><center>GAAR - GRUPO DE APOIO AO ANIMAL DE RUA</center></span>
      </div>
</footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>