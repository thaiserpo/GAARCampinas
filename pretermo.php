<?php 		
include ("area/conexao.php");
require_once('recaptchalib.php');

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$id = $_GET['id'];
/*$especie = $_POST['especie'];
$sexo = $_POST['sexo'];
$cor = $_POST['cor'];
$porte = $_POST['porte'];
$idade = $_POST['idade'];*/

$query = "SELECT * FROM ANIMAL WHERE ID = '$id'";
$select = mysqli_query($connect,$query);
$reccount = mysqli_num_rows($select);

while ($fetch = mysqli_fetch_row($select)) {
            $idanimal = $fetch[0];
			$nomedoanimal = $fetch[1];
			$especie = $fetch[2];
			$cor = $fetch[5];
			$status = $fetch[10];
			
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

    
    <title>GAAR - Formulário de pré adoção</title>
	<script type="text/javascript">
         
         function OnChangeSelect () {
             
                    var select = document.getElementById('nomeanimal');
                    var str = select.options[select.selectedIndex].value;
                    
                       switch (str){
                           case "naoencontreionome":
                                    document.getElementById('divdadosanimal').className  = "d-block";
                                    break;
                           default:
                                    document.getElementById('divdadosanimal').className  = "d-none";
                                    break;
                       }
         }
         
         function OnChangeRadio (radio) {
                document.getElementById('divcanina').className  = "d-block";
                document.getElementById('divfelina').className  = "d-none";
        }
    
        
        function OnChangeRadio2 (radio) {
                document.getElementById('divfelina').className  = "d-block";
                document.getElementById('divcanina').className  = "d-none";
        }
	
        function OnChangeRadio3 (radio) {
                document.getElementById('perg5_0').checked = true;
                document.getElementById('perg6_na').checked = true;
        }
        
        
        function OnChangeRadio5 (radio) {
                document.getElementById('perg41').value = "Pretendo castrar na idade correta";
        }
        
        function OnChangeRadio6 (radio) {
                document.getElementById('perg26').value = "Eram vacinados em veterinário";
        }
        
        function OnChangeRadio7 (radio) {
                document.getElementById('perg26').value = "Eram vacinados em casa de ração";
        }
        
        function OnChangeRadio8 (radio) {
                document.getElementById('perg26').value = "Não possuo animais";
        }
        
        function OnChangeRadio9 (radio) {
                document.getElementById('perg26').value = "";
        }
        
        function OnChangeRadio10 (radio) {
                document.getElementById('perg17').value = "Meu apartamento possui telas";
        }
        
        function OnChangeRadio11 (radio) {
                document.getElementById('perg17').value = "Não é apartamento";
        }
        
        function OnChangeRadio12 (radio) {
                document.getElementById('perg17').value = "";
        }
        
        function OnChangeRadio13 (radio) {
                document.getElementById('Não tenho cães').checked = true;
        }
        
        function OnChangeRadio14 (radio) {
                document.getElementById('perg23_0').checked = true;
                document.getElementById('perg24_na').checked = true;
                document.getElementById('perg25_na').checked = true;
                document.getElementById('perg27_na').checked = true;
                document.getElementById('perg28_0').checked = true;
                document.getElementById('perg29_0').checked = true;
                document.getElementById('perg30_na').checked = true;
                document.getElementById('perg31_na').checked = true;
                document.getElementById('perg26').value = "Não possuo animais";
                document.getElementById('perg33_g').checked = true;
        }
        
        function OnChangeRadio15 (radio) {
                document.getElementById('perg11_na').checked = true;
                
                
        }
        
        function OnChangeRadio16 (radio) {
                document.getElementById('perg12_na').checked = true;
                document.getElementById('perg13_na').checked = true;
                document.getElementById('perg14_na').checked = true;
        }
        
        function OnChangeRadio17 (radio) {
                document.getElementById('perg12_na').checked = false;
                document.getElementById('perg13_na').checked = false;
                document.getElementById('perg14_na').checked = false;
                document.getElementById('perg15_na').checked = true;
                document.getElementById('perg16_na').checked = true;
                document.getElementById('perg20_na').checked = true;
        }
        
        function OnChangeRadio18 (radio) {
                document.getElementById('perg33_g').checked = true;
                document.getElementById('divtiveanimais').className  = "d-none";
        }
        
        function OnChangeRadio19 (radio) {
                document.getElementById('divtiveanimais').className  = "d-block";
                document.getElementById('perg33_g').checked = false;
        }
        
        function OnChangeRadio20 (radio) {
                document.getElementById('perg41').value = "";
        }
        
        function OnChangeRadio21 (radio) {
                document.getElementById('divfeira').className  = "d-block";
                document.getElementById('divinternet').className  = "d-none";
        }
        
        function OnChangeRadio22 (radio) {
                document.getElementById('divfeira').className  = "d-none";
                document.getElementById('divinternet').className  = "d-block";
        }
        
    </script>
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
   <script src='https://www.google.com/recaptcha/api.js' async defer></script>
   <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '648744272519006');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=648744272519006&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    <!--- GOOGLE ADSENSE --->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
    <!--- GOOGLE ADSENSE --->
</head>
<body>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
     crossorigin="anonymous"></script>
<!-- Anúncios 1 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5848149407283988"
     data-ad-slot="4700026599"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<main role="main" class="container">
    <div class="starter-template">
       <center>
			<a href="www.gaarcampinas.org"><center><img src="/area/logo_transparent.png" width="70" height="70"></a></center><br>
			<? if ($status == 'Adotado') {
    
                echo "<h2><center> Felizmente esse animalzinho já ganhou um lar :) <br><a href='https://gaarcampinas.org/queroadotar.php' target='_blank'>Clique aqui e conheça outros que ainda estão esperando uma família amorosa e responsável</a></h2></center>";
                
            } else {
            
            ?>
            <h2>FORMULÁRIO DE INTERESSE EM ADOÇÃO</h2>
            <small>Preencha preferencialmente com o navegador Chrome</small><br>
            
            <h4><strong><font color="red">Por favor, preencha TODO o formulário. Caso contrário, não será enviado.</font></strong></h4>
                <p><strong>ADOTAR É UMA DECISÃO SÉRIA PARA A VIDA TODA! <br>
                ANTES DE PREENCHER O FORMULÁRIO, CONSULTE SEU LAR, SEU BOLSO, SEU TEMPO, SEU PSICOLÓGICO E SUA PACIÊNCIA. ANIMAIS NÃO SÃO OBJETOS, POR FAVOR SEJA HONESTO EM SUAS RESPOSTAS. </strong></p>
            </center>
            
            <p>Vamos falar sobre devolução de animais adotados e o impacto negativo que isso gera no animal por toda a sua vida.
        Quando adotamos um cão ou gato, estamos nos responsabilizando por cuidar, alimentar, prover cuidados veterinários e carinho por toda a vida dele(a). É por isso que os candidatos à adoção passam por um processo rigoroso de seleção, podendo vir a ser às vezes descartados. Tentamos fazer o possível para que os adotantes tenham a consciência de que um animal se apega, sofre, fica traumatizado e não entende o que está acontecendo. Ao devolver um animal, ele volta para nós em condições muito tristes, porque animais, tem sentimentos SIM. Se você fosse tirado à força do seu ambiente que está acostumado, para ficar longe da sua família e das pessoas que te dão segurança, sem motivo algum ou aviso prévio para ir morar em um lugar cheio de outros animais esperando por uma adoção, como ficaria sua cabeça?
        Lutamos por uma posse RESPONSÁVEL, onde o tutor entenda que às vezes existem problemas que devem ser solucionados, e tudo em prol do animal deve ser tentado, o que não significa descartá-lo!
        Se você tem dúvidas se está pronto para adotar um animal, NÃO adote. Falamos sobre responsabilidade e compaixão, falamos sobre todos os membros da família em comum acordo e com o coração aberto para receber um animal. Adoção não é test - drive, é vidas não podem ser devolvidas assim, sem ninguém lutar por elas. O GAAR luta pela posse responsável.<br><br>
        Se você tem certeza de que chegou o momento de aumentar a família, ficamos muito felizes pelo seu interesse em adotar um animal do GAAR :)<br></p>
        
            <p>A expectativa de vida de um cão ou gato é de aproximadamente 15 anos e ele precisarão de sua proteção e atenção até a velhice ou em uma eventual doença.</p>
            <p>Antes de adotar, consulte seu lar, sua família, seu bolso, sua paciência e seu psicológico.</p>
            <p>Preparamos algumas perguntas para te fazer pensar e refletir se esse é o melhor momento para aumentar a família .</p>
            <p><strong>1. </strong>Um animal precisa de cuidados básicos como alimentação de qualidade, banhos, idas periódicas ao veterinário bem como vacinas de boa procedência. Quando ele ficar doente, vai precisar de exames e medicamentos. Isso exige gastos financeiros, algumas vezes altos. Você tem condições?</p>
            <p><strong>2. </strong>Um animal precisa de atenção e carinho. Eles são muito dependentes dos seus donos e por isso você precisa estar por perto quando ele precisar. Um cão precisa passear, brincar. Um gato, por sua vez, não precisa sair de casa pela sua segurança mas ele também precisa  brincar. Você tem tempo pra gastar com eles?</p>
            <p><strong>3. </strong>Um animal precisa de um lar confortável, de acordo com o seu porte. Um cão, mesmo saindo para passear, precisa de espaço para se movimentar. O mesmo se aplica aos gatos, no caso deles é ainda mais importante porque, para mantê-los seguros dos perigos das ruas, eles precisam de um local espaçoso dentro de casa.</p>
            <p><strong>4. </strong>TODOS da família estão de acordo com a adoção? Esse é um ponto super importante, pois se o animal não for amado, cuidado e respeitado dentro do seu lar, ele não viverá bem e poderá desenvolver traumas psicológicos.</p>
            <p><strong>5. </strong>Eles fazem xixi e cocô, bagunça, soltam pêlo. Filhotes de cachorro choram, roem as coisas da casa, fazem as necessidades em locais errados. Adultos resgatados muitas vezes tem traumas devido aos maus-tratos sofridos nas ruas e precisam de mais tempo para se adaptarem ao novo lar e a nova rotina. Você tem paciência para passar por essas situações?  </p>
            <p><strong>6. </strong>Muitas pessoas possuem problemas respiratórios (asma, rinite alérgica, sinusite, bronquite, etc) que podem ser controlados com medicação. Caso você tenha algum tipo de alergia e mesmo assim gostaria de ter um animal, está ciente de que terá que conviver com isso?</p>
            <p><font color="red"><strong>Esteja ciente de que para adotar o GAAR cobra uma taxa no valor de R$50,00 para ajudar na manutenção do nosso trabalho.</strong></font></span></p>
            <p>Todas as informações estão protegidas pela Lei Geral de Proteção de Dados Pessoais (LGPD) - LEI Nº 13.709, DE 14 DE AGOSTO DE 2018. Conheça a lei na íntegra clicando <a href='http://www.planalto.gov.br/ccivil_03/_Ato2015-2018/2018/Lei/L13709.htm' target='_blank'>aqui</a>. </p>
            <form action="/area/cadastropretermo.php" method="POST" enctype="multipart/form-data" name="form" onSubmit="return validar()">
                  
                  <p><h4>DADOS DO ADOTANTE</h4></p>
                    <p><strong><font color="red">O formulário deve ser preenchido pela pessoa responsável pelo animal</strong></font></p>
                    <p>Nome<font color="red"><b>*</b></font>: <br></btr><input class="form-control"  name="adotante" type="text" required id="adotante" size="80" maxlength="50"></p><br>
                    <p>CEP<font color="red"><b>*</b></font>: <br><input class="form-control"  type="number" required name="cep" id="cep"  maxlength="12" size="20" onblur="pesquisacep(this.value);"></p>
                    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (sem hífen e sem espaços)</small><br> 
                    <p>Endereço<font color="red"><b>*</b></font>: <br><input class="form-control"  type="text" required name="endereco" id="endereco" maxlength="100" size="100"></p>
                    <small id="passwordHelpBlock" class="form-text text-muted">Cadastre sem aspas simples</small><br>
                    <p>Complemento<font color="red"><b>*</b></font>: <br><input class="form-control"  type="text" required name="complemento" id="complemento" maxlength="50" size="10"></p><br>
                    <p>Número<font color="red"><b>*</b></font>: <br><input class="form-control"  type="number" required name="numero" id="numero" maxlength="10" size="10"></p>
                    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small><br>
                    <p>Bairro<font color="red"><b>*</b></font>: <br><input class="form-control"  type="text" required name="bairro" id="bairro" maxlength="30" size="50"></p><br>
                    <p>Cidade<font color="red"><b>*</b></font>: <br><input class="form-control"  type="text" required name="cidade" id="cidade" maxlength="20" size="50"></p><br>
                    <p>RG<font color="red"><b>*</b></font>: <br><input class="form-control"  type="number" required name="rg" id="rg" maxlength="15" size="20"></p><br>
                    <p>CPF<font color="red"><b>*</b></font>: <br><input class="form-control"  type="text" required name="cpf" id="cpf" maxlength="11" size="20"></p>
                    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (sem hífen e sem espaços)</small><br>
                    <p>Celular<font color="red"><b>*</b></font>: <br><input class="form-control"  type="number" required name="celular" id="celular" maxlength="12" size="20"></p>
                    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (com DDD e sem espaços)</small><br>
                    <p>E-mail: <font color="red"><b>*</b></font>: <br><input class="form-control"  type="email" required name="email" id="email" maxlength="150" size="60"></p><br>
                    <p>Profissão: <font color="red"><b>*</b></font>: <br><input class="form-control"  type="text" required name="profissao" id="profissao" maxlength="100" size="50"></p><br>
                    <p>Perfil do Facebook: <br><input class="form-control"  type="text" name="facebook" id="facebook" maxlength="30"  required size="50"></p><br>
                    <p>Perfil do Instagram: <br>
                          <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                                    <input type="text" class="form-control" name="instagram" id="instagram" maxlength="30" value="<? echo $instagram?>">
                          </div>
                          <small id="passwordHelpBlock" class="form-text text-muted">Cadastre sem espaços</small>
                  
                  <p><h4>DADOS DO ANIMAL INTERESSADO</h4></p>
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Espécie <b><font color="red">*</font></b>: </legend>
                      <div class="col-sm-10">
                          <?
                            if ($especie =='Canina') {
                                echo "<div class='form-check'>
                                        <input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' onclick='OnChangeRadio (this)' checked>Canina
                                       </div>
                                       <div class='form-check'>
                                                    <input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' onclick='OnChangeRadio2 (this)'>Felina
                                       </div>";
                            } 
                            if ($especie =='Felina') {
                                echo "<div class='form-check'>
                                        <input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' onclick='OnChangeRadio (this)' >Canina
                                       </div>
                                       <div class='form-check'>
                                                    <input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' onclick='OnChangeRadio2 (this)' checked>Felina
                                       </div>";
                            } 
                            if ($especie =='') {
                                echo "<div class='form-check'>
                                        <input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' onclick='OnChangeRadio (this)' >Canina
                                       </div>
                                       <div class='form-check'>
                                                    <input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' onclick='OnChangeRadio2 (this)'>Felina
                                       </div>";
                            }
                            ?>
                        </div>
                    </div>
                 		<br>
                 	<div class="form-group row">
                 	    <?
                 	        if ($especie == 'Canina') {
                 	            echo "<div id='divcanina' class='d-block'>";
                 	        } else if ($especie == '') {
                 	            echo "<div id='divcanina' class='d-none'>";
                 	        }
                 	      ?>
                 		    <p>Nome<font color="red"><b>*</b></font>:  <br>
 	                        <select class="form-control"  name="idanimalcanina" id="idanimalcanina" required>
                     		  
                     		  <?
                     		       if ($nomedoanimal !='') {
                     		           
                     		           echo "<option value='".$idanimal."'>".$nomedoanimal."</option>";
                     		           
                     		       } else {
                     		        
                                        echo "<option value=''>Selecione</option>";                     		        
                         		        echo "<option value='Não está cadastrado'>Não sei/encontrei o nome</option>";
                         		           
                        		 		$query = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO ='GAAR' and ADOTADO = 'Disponível' AND ESPECIE ='Canina' and FOTO <> '' ORDER BY NOME_ANIMAL ASC";
                        				$select = mysqli_query($connect,$query);
                        				
                        				while ($fetch = mysqli_fetch_row($select)) {
                        					echo "<option value='".$fetch[0]."'>".$fetch[1]."</option>";
                        				}
                     		       }
                    		?>
                    	    </select>
                    	    <small id="passwordHelpBlock" class="form-text text-muted">Apenas aparecerão nomes dos animais disponíveis</small>
                    	    <br>
                 		</div>
                 	</div>
                    <div class="form-group row">
                 		<div id="divfelina" class="d-none">
                 		    <p>Nome<font color="red"><b>*</b></font>:  <br>
 	                        <select class="form-control"  name="idanimalfelina" id="idanimalfelina" required>
                     		  
                     		  <?
                     		       if ($nomedoanimal !='') {
                     		           
                     		           echo "<option value='".$idanimal."'>".$nomedoanimal."</option>";
                     		           
                     		       } else {
                     		        
                                        echo "<option value=''>Selecione</option>";                     		        
                         		        echo "<option value='Não está cadastrado'>Não sei/encontrei o nome</option>";
                         		           
                        		 		$querycat = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO ='GAAR' and ADOTADO = 'Disponível' AND ESPECIE ='Felina' and FOTO <> '' ORDER BY NOME_ANIMAL ASC";
                        				$selectcat = mysqli_query($connect,$querycat);
                        				
                        				while ($fetchcat = mysqli_fetch_row($selectcat)) {
                        					echo "<option value='".$fetchcat[0]."'>".$fetchcat[1]."</option>";
                        				}
                     		       }
                    		?>
                    	    </select>
                    	    <small id="passwordHelpBlock" class="form-text text-muted">Apenas aparecerão nomes dos animais disponíveis</small>
                    	    <br>
                 		</div>
                 	</div>
                
                <p><h4>SOBRE VOCÊ E SUA FAMÍLIA</h4></p>
 	                <p><strong>1)</strong> Todos os membros da família estão dispostos a cuidar e zelar pela sa&uacute;de e segurança do animal por todo período de vida dele?<br>
 	                <div class="form-check">
                            <input class="form-check-input"  type="radio" class="form-control" name="perg1" value="Sim" required > Sim &nbsp; <br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg1" value="Não"> Não </p><br>
                    </div>
                    <p><strong>2)</strong> Quantas pessoas moram em sua residência? <br>
                    <div class="form-check">
                            <input class="form-check-input"  type="radio" class="form-control" name="perg2" value="1" required > 1 &nbsp; <br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg2" value="2"> 2 &nbsp; <br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg2" value="3"> 3 &nbsp;<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg2" value="4"> 4 &nbsp;<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg2" value="5 ou mais"> 5 ou mais &nbsp;</p><br>
                    </div>
                    <p><strong>3)</strong> Todos estão de acordo com a adoção? <br>
                    <div class="form-check">
                            <input class="form-check-input"  type="radio" class="form-control" name="perg3" value="Sim"  required > Sim &nbsp; <br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg3" value="Não"> Não </p><br>
                    </div>
                    <p><strong>4)</strong> Quantas crianças moram com você ou te visitam com  frequência? <br>
                    <div class="form-check">
                     		 <input class="form-check-input"  type="radio" class="form-control" name="perg4" value="0" onclick="OnChangeRadio3 (this)"> 0 &nbsp; <br>
                     		 <input class="form-check-input"  type="radio" class="form-control" name="perg4" value="1" > 1 &nbsp; <br>
                     		 <input class="form-check-input"  type="radio" class="form-control" name="perg4" value="2"> 2 &nbsp; <br>
                     		 <input class="form-check-input"  type="radio" class="form-control" name="perg4" value="3"> 3 &nbsp;<br>
                     		 <input class="form-check-input"  type="radio" class="form-control" name="perg4" value="4"> 4 &nbsp;<br>
                    	     <input class="form-check-input"  type="radio" class="form-control" name="perg4" value="5 ou mais">5 ou mais &nbsp;</p><br>
                    </div>
                    <p><strong>5)</strong> Qual a idade das crianças?<br>
                    <div class="form-check">
                            <input class="form-check-input"  type="radio" class="form-control" name="perg5" id="perg5_0" value="Nenhuma criança mora na residência ou visita" required > Nenhuma criança mora na residência ou visita <br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg5" id="perg5_a" value="Entre 0 e 3 anos" required > Entre 0 e 3 anos <br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg5" id="perg5_b" value="Entre 3 a 6 anos"> Entre 3 a 6 anos<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg5" id="perg5_c" value="Entre 6 a 9 anos"> Entre 6 a 9 anos<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg5" id="perg5_d" value="10 anos ou mais"> 10 anos ou mais<br></p><br>
                    </div>
                    <p><strong>6)</strong> As crianças já tiveram algum contato com animais? <br>
                    <div class="form-check">
                            <input class="form-check-input"  type="radio" class="form-control" name="perg6" id="perg6_sim" value="Sim" required > Sim &nbsp;<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg6" id="perg6_nao" value="Não"> Não &nbsp;<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg6" id="perg6_na" value="Não há crianças na residência"> Não há crianças na residência </p><br>
                    </div>
                    <p><strong>7)</strong> Há alguém que terá contato com o animal com alergias/rinites? <br>
                    <div class="form-check">
                            <input class="form-check-input"  type="radio" class="form-control" name="perg7" value="Sim" required > Sim &nbsp; <br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg7" value="Não"> Não</p><br>
                    </div>
                    <p><strong>8)</strong> Há alguém que terá contato com o animal com problemas respiratórios? <br>
                    <div class="form-check">
                            <input class="form-check-input"  type="radio" class="form-control" name="perg8" value="Sim" required > Sim <br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg8" value="Não"> Não </p><br>
                    </div>
                    <p><h4>SOBRE A MORADIA</h4></p>
                    <P><strong>9)</strong> Tipo: <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg9" value="Casa"  onclick="OnChangeRadio17 (this)" > Casa <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg9" value="Apartamento" onclick="OnChangeRadio16 (this)"> Apartamento <br></P>
                    </div>
                    <p><strong>10)</strong> O imóvel é alugado? <br>
                    <div class="form-check">
 		                <input class="form-check-input"  type="radio" class="form-control" name="perg10" value="Sim" required > Sim<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg10" value="Não" onclick="OnChangeRadio15 (this)"> Não<br></p>
                    </div>
                    <p><strong>11)</strong> Caso o imóvel seja alugado, existe alguma restrição  para animais?<br>
                    <div class="form-check">
             		    <input class="form-check-input"  type="radio" class="form-control" name="perg11" id="perg11_sim" value="Sim" required > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg11" id="perg11_nao" value="Não"> Não <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg11" id="perg11_na" value="Não é alugado"> Não é alugado <br></p>
                    </div>
 		            <p><strong>12)</strong> Caso sua residência seja casa, o animal terá acesso livre a rua? <br>
 		            <div class="form-check">
 		                <input class="form-check-input"  type="radio" class="form-control" name="perg12" id="perg12_sim" value="Sim"  required > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg12" id="perg12_nao" value="Não"> Não <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg12" id="perg12_na" value="Não é casa"> Não é casa <br></p>
                    </div>
                        
                    <p><strong>13)</strong> Caso sua residência seja casa, qual a altura dos muros? <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg13" id="perg13_baixo" value="Baixo" required > Baixos <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg13" id="perg13_medio" value="Médios"> Médios <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg13" id="perg13_alto" value="Altos"> Altos <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg13" id="perg13_na" value="Não é casa"> Não é casa<br></p>
                    </div>
                        
                    <p><strong>14)</strong> Caso sua residência seja casa, o portão é seguro contra fugas? <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg14" id="perg14_sim" value="Sim"  required > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg14" id="perg14_nao" value="Não"> Não <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg14" id="perg14_na" value="Não é casa"> Não é casa<br></p>
                    </div>
                        
                    <p><strong>15)</strong> Caso sua residência seja apartamento, contém telas de proteção (telas de proteção para animais e crianças, diferentes de grades de proteção) em todas as janelas? <br>
                    <div class="form-check">
                 		<input class="form-check-input"  type="radio" class="form-control" name="perg15" id="perg15_sim" value="Sim" onclick="OnChangeRadio10 (this)"> Sim<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg15" id="perg15_nao" value="Não" onclick="OnChangeRadio12 (this)"> Não <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg15" id="perg15_na"  value="Não é apartamento" onclick="OnChangeRadio11 (this)"> Não é apartamento <br></p>
                    </div>
                        
                    <p><strong>16)</strong> Caso sua residência seja apartamento, contém telas de proteção (telas de proteção para animais e crianças, diferentes de grades de proteção) na sacada? <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg16" id="perg16_sim" value="Sim" onclick="OnChangeRadio10 (this)" > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg16" id="perg16_nao" value="Não" onclick="OnChangeRadio12 (this)"> Não<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg16" id="perg16_na"  value="Não é apartamento" onclick="OnChangeRadio11 (this)"> Não é apartamento <br></p>
                    </div>
                        
                    <p><strong>17)</strong> Caso sua residência seja apartamento,  contém telas de proteção (telas de proteção para animais e crianças, diferentes  de grades de proteção) na janela do banheiro? <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg20" id="perg20_sim" value="Sim" onclick="OnChangeRadio10 (this)" > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg20" id="perg20_nao" value="Não" onclick="OnChangeRadio12 (this)"> Não <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg20" id="perg20_na"  value="Não é apartamento" onclick="OnChangeRadio11 (this)"> Não é apartamento<br></p>
                    </div>
                        
                    <p><strong>18)</strong> Caso não pretenda telar, como irá evitar que o animal saia para a rua ou pule a janela? <br>
                    <div class="form-check">
                        <textarea class="form-control"  name="perg17" cols="70" rows="5" id="perg17" required ></textarea><br></p>
                    </div>

                    <p><strong>19)</strong> Caso ocorram situações que alterem a rotina da família (ex: mudança de casa/cidade, chegada de um bebê, separação do  casal, etc) qual seria a melhor alternativa para o animal adotado? <strong><font color="red">Lembrando que caso tenha que devolver o animal, que seja para o GAAR. É PROIBIDA A TRANSFERÊNCIA DA POSSE PARA TERCEIROS SEM O CONHECIMENTO DA ONG.</font></strong> 
                    <div class="form-check">  	
                      	<textarea class="form-control"  name="perg21" cols="70" rows="5" id="perg21" required ></textarea><br> </p>
                    </div>
 		
 		<p><h4>SOBRE CUIDADOS E CONVIVÊNCIA</h4></p>    
 		
 		            <p><strong>20)</strong>Você tem outros animais?<br>
 		            <div class="form-check">
 		                <input class="form-check-input"  type="radio" class="form-control" name="perg22" value="Sim" required > Sim<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg22" value="Não" onclick="OnChangeRadio14 (this)"> Não <br> </p>
                    </div>
                    <p><strong>21)</strong> Se sim, quantos?<br>
                    <div class="form-check">
              		    <input class="form-check-input"  type="radio" class="form-control" name="perg23" id="perg23_0" value="0"> 0 &nbsp;<br>
              		    <input class="form-check-input"  type="radio" class="form-control" name="perg23" id="perg23_1" value="1"> 1 &nbsp;<br> 
                        <input class="form-check-input"  type="radio" class="form-control" name="perg23" id="perg23_2" value="2"> 2 &nbsp;<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg23" id="perg23_3" value="3"> 3 &nbsp;<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg23" id="perg23_4"value="4"> 4 &nbsp;<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg23" id="perg23_mais" value="5 ou mais"> 5 ou mais &nbsp;<br></p>
                    </div>
                    
                    <p><strong>22)</strong> Todos vacinados contra Cinomose, Hepatite, Parvovirose, etc (V10)? <br>
                    <div class="form-check">
              		    <input class="form-check-input"  type="radio" class="form-control" name="perg24" id="perg24_sim" value="Sim" required > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg24" id="perg24_nao" value="Não"> Não <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg24" id="perg24_na" value="Não tenho animais"> Não possuo animais <br></p>
                    </div>
                        
                    <p><strong>23)</strong> Caso afirmativo, foram vacinados em: <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg25" id="perg25_vet" value="Clínica veterinária" required onclick="OnChangeRadio6 (this)"> Clínica veterinária <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg25" id="perg25_casaracao" value="Loja agropecuária" onclick="OnChangeRadio7 (this)"> Loja agropecuária <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg25" id="perg25_petshop" value="Petshop" onclick="OnChangeRadio7 (this)"> Petshop <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg25" id="perg25_nuncavacinei" value="Nunca vacinei meus animais" onclick="OnChangeRadio9 (this)"> Nunca vacinei meus animais<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg25" id="perg25_na" value="Não tenho animais" onclick="OnChangeRadio8 (this)"> Não possuo animais<br> </p>
                    </div>
                    
                    <p><strong>24)</strong>Se não são, qual o motivo?<br>
                    <div class="form-check">
                        <textarea class="form-control"  name="perg26" cols="80" rows="5" required id="perg26"></textarea> <br></p>
                    </div>
                        
                    <p><strong>25)</strong> Se tem animais, estão castrados? <br>
                    <div class="form-check">
              		    <input class="form-check-input"  type="radio" class="form-control" name="perg27" id="perg27_sim" value="Sim" required > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg27" id="perg27_nao" value="Não"> Não <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg27" id="perg27_na" value="Não tenho animais"> Não possuo animais<br></p>
                    </div>
                        
                    <p><strong>26)</strong> Quantos cães? <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg28" id="perg28_0" value="0" onclick="OnChangeRadio13 (this)"> 0 &nbsp; <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg28" id="perg28_1" value="1" required > 1 &nbsp;<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg28" id="perg28_2" value="2"> 2 &nbsp; <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg28" id="perg28_3" value="3"> 3 &nbsp; <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg28" id="perg28_4" value="4"> 4 &nbsp; <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg28" id="perg28_mais" value="5 ou mais"> 5 ou mais &nbsp; <br></p>
                    </div>
                    
                    <p><strong>27)</strong> Quantos gatos? <br>
                    <div class="form-check">
                         <input class="form-check-input"  type="radio" class="form-control" name="perg29" id="perg29_0" value="0" required > 0 &nbsp; <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg29" id="perg29_1" value="1" required > 1 &nbsp; <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg29" id="perg29_2" value="2"> 2 &nbsp;<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg29" id="perg29_3" value="3"> 3 &nbsp;<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg29" id="perg29_4" value="4"> 4 &nbsp;<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg29" id="perg29_mais" value="5 ou mais"> 5 ou mais &nbsp; <br></p>
                    </div>
                        
                    <p><strong>28)</strong> Qual o porte dos cães?  <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg30" id="perg30_Pequeno" value="Pequeno" > Pequeno &nbsp; <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg30" id="perg30_Médio" value="Médio" > Médio &nbsp; <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg30" id="perg30_Grande" value="Grande"> Grande &nbsp; <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg30" id="perg30_na" value="Não tenho cães"> Não tenho cães <br> </p>  
                    </div>
                        
                    <p><strong>29)</strong> Já conviveram com outros animais? <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg31" id="perg31_sim" value="Sim" required > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg31" id="perg31_nao" value="Não"> Não <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg31" id="perg31_na" value="Não tenho animais"> Não possuo animais <br> </p>
                    </div>
                    
                    <p><strong>30)</strong> Já teve outros animais que não estão mais com você? <br> 
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg32" id="perg32_sim" value="Sim" required onclick="OnChangeRadio19 (this)"> Sim<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg32" id="perg32_nao" value="Não" onclick="OnChangeRadio18 (this)" > Não<br></p>
                    </div>
                        
                    <div id="divtiveanimais" class="form-row d-none">
      		            <p><strong>31)</strong> Caso afirmativo, o que aconteceu?  <br>
      		            <div class="form-check">
          		            <input class="form-check-input"  type="radio" class="form-control" name="perg33"  id="perg33_a" value="Morreu antes dos 10 anos" required > Morreu antes dos 10 anos <br>
          		            <input class="form-check-input"  type="radio" class="form-control" name="perg33"  id="perg33_h" value="Morreu depois dos 10 anos" required > Morreu depois dos 10 anos <br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg33"  id="perg33_b" value="Morreu de câncer"> Morreu de câncer<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg33"  id="perg33_c" value="Foi atropelado"> Foi atropelado<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg33"  id="perg33_d" value="Fugiu"> Fugiu<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg33"  id="perg33_e" value="Me mudei e deixei com minha família"> Me mudei e deixei com minha família<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg33"  id="perg33_i" value="Me mudei e deixei com amigos/vizinhos"> Me mudei e deixei com amigos/vizinhos<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg33"  id="perg33_f" value="Ficou com meu ex-cônjugue"> Ficou com meu ex-cônjugue<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg33"  id="perg33_g" value="Não tive outros animais" >Não tive outros animais <br> </p>
                        </div>
                    </div>
                    <br>    
                    <p><strong>32)</strong>Em caso de viagem, onde o animal ficará? <br>
                        <div class="form-check">
                            <input class="form-check-input"  type="radio" class="form-control" name="perg34" value="Em hotelzinho" required > Em hotelzinho <br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg34" value="Em casa com cuidadores"> Em casa com cuidadores<br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg34" value="Em casa de algum parente ou amigo"> Em casa de algum parente ou amigo<br></p>
                        </div>
                        <br>
                        
                    <p><strong>33)</strong> Quantas  horas por dia o animal ficará sozinho? <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg35" value="0" required > 0 &nbsp; <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg35" value="1"> 1 &nbsp;<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg35" value="2"> 2 &nbsp;<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg35" value="3"> 3 &nbsp;<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg35" value="4"> 4 &nbsp;<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg35" value="5"> 5 &nbsp;<br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg35" value="6"> 6 &nbsp; <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg35" value="7"> 7 &nbsp; <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg35" value="8 ou mais"> 8 ou mais<br></p>
                    </div>
                        
    		        <p><strong>34)</strong> Qual  ração pretende dar para o animal? <br>
    		        <div class="form-check">
                       <select class="form-control"  name="perg36" id="perg36" required>
                        <option value=""> Selecione </option>
                        <option value="Max"> Max </option>
                        <option value="Golden"> Golden </option>
                        <option value="Pedigree"> Pedigree </option>
                        <option value="Whiskas"> Whiskas </option>
                        <option value="Royal Canin"> Royal Canin </option>
                        <option value="Premier"> Premier </option>
                        <option value="Purina"> Purina </option>
                        <option value="Guabi"> Guabi </option>
                        <option value="Eukanuba"> Eukanuba </option>
                        <option value="Hills"> Hills </option>
                        <option value="Hero"> Hero </option>
                        <option value="Biriba"> Biriba </option>
                        <option value="Outras"> Outras </option>
                      </select><br></p>
                    </div>
                    
                    <p><strong>35)</strong> Caso o animal adotado seja um filhote e tenha apenas  uma dose da vacina, pretende terminar de vaciná-lo? <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg37" value="Sim" required > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg37" value="Não"> Não</p><br>
                    </div>
                    <p><strong>36)</strong> Terá  condições de vacinar anualmente o animal com vacinas importadas? <br>
                        <div class="form-check">
                            <input class="form-check-input"  type="radio" class="form-control" name="perg38" value="Sim" required > Sim <br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg38" value="Não"> Não <br></p>
                        </div>
                        
                    <p><strong>37)</strong> Terá condições de custear veterinário caso o animal necessite de cuidados no futuro? (doenças e outras necessidades) <br>
                        <div class="form-check">
                            <input class="form-check-input"  type="radio" class="form-control" name="perg39" value="Sim" required > Sim <br>
                            <input class="form-check-input"  type="radio" class="form-control" name="perg39" value="Não"> Não <br></p>
                        </div>
                        
                    <p><strong>38)</strong> Caso o animal adotado seja muito jovem e não esteja castrado, pretende castrar na idade correta? <br>
                    <div class="form-check">
		                <input class="form-check-input"  type="radio" class="form-control" name="perg40" value="Sim" required onclick="OnChangeRadio5 (this)" > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg40" value="Não" onclick="OnChangeRadio20 (this)"> Não <br></p>
                    </div>
                    
                    <p><strong>39)</strong> Caso negativo, qual o motivo? <br>
                    <div class="form-check">
                        <textarea class="form-control"  name="perg41" cols="70" id="perg41"></textarea></p>
                        <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis</small>
                    </div>
                    
                    <p><strong>40)</strong> Concorda que um voluntário poderá ir até sua casa, conhecer você e  sua família, e o local onde o animal ficará, entregando-o pessoalmente? <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg42" value="Sim" required > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg42" value="Não" required > Não <br></p>
                    </div>
                    
		            <p><strong>41)</strong> Concorda em assinar um termo de responsabilidade pelo  animal? <br>
		            <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg43" value="Sim" required > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg43" value="Não"> Não <br> </p>
                    </div>
                    
                    <p><strong>42)</strong> Concorda em manter contato com um(a) voluntário(a),  após a adoção, por tempo indeterminado, informando o estado do animal?  <br>
                    <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="perg44" value="Sim" required > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg44" value="Não"> Não <br></p>
                    </div>
                    
                    <p><strong>43)</strong> O GAAR cobra uma taxa de adoção no valor de R$ 70,00 que é um valor simbólico para ajudar nas despesas que a ONG teve com o animal. Você concorda com essa taxa?  <br>
                    <div class="form-check">    
                        <input class="form-check-input"  type="radio" class="form-control" name="perg45" value="Sim" required > Sim <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="perg45" value="Não"> Não <br></p> 
                    </div>
                    
                    <p><strong>44)</strong> Como ficou sabendo do animal? <br>
                    <div class="form-check">
                          <select class="form-control"  name="ficousabendo" id="ficousabendo" required>
                            <option value="Facebook"> Facebook </option>
                            <option value="Instagram"> Instagram </option>
                            <option value="Site"> Site do GAAR </option>
                            <option value="WhatsApp"> WhatsApp </option>
                            <option value="Outros"> Outros </option>
                          </select> <br></p>
                    </div>
                    
                    <p><strong>45)</strong> Devido ao COVID-19, gostaríamos de saber se você está presencialmente na feira de adoção. <br>
		            <div class="form-check">
                        <input class="form-check-input"  type="radio" class="form-control" name="feira" value="Sim" required onclick="OnChangeRadio21 (this)"> Sim, estou preenchendo o formulário na feira <br>
                        <input class="form-check-input"  type="radio" class="form-control" name="feira" value="Não" onclick="OnChangeRadio22 (this)"> Não estou preenchendo o formulário na feira <br>
                    </div>
                    <br>
                    <div class="form-group row">
                 		<div id="divfeira" class="d-none">
                 		    <p>Nome do voluntário que te atendeu<font color="red"><b>*</b></font>:  
 	                        <select class="form-control"  name="nomevoluntario" id="nomevoluntario" required>
                     		  
                     		  <?
                     		            echo "<option value=''>Selecione</option>";                     		        
                         		           
                        		 		$query = "SELECT NOME FROM VOLUNTARIOS WHERE SUBAREA='feira' ORDER BY NOME ASC";
                        				$select = mysqli_query($connect,$query);
                        				
                        				while ($fetch = mysqli_fetch_row($select)) {
                        					echo "<option value='".$fetch[0]."'>".$fetch[0]."</option>";
                        					$sexo = $fetch[1];
                        					$especie = $fetch[2];
                        				}
                    		?>
                    	    </select>
                    	    <small id="passwordHelpBlock" class="form-text text-muted">Ao enviar, o voluntário irá receber o formulário via e-mail.</small>
                 		</div>
                 	</div>
                 	<div class="form-group row">
                 		<div id="divinternet" class="d-none">
                            <!--<p><strong>46)</strong> Link do anúncio (caso houver): <br>
                            <div class="form-check">
                                <input class="form-check-input"  name="link" type="text" id="link" value=""  maxlength="500"> <br> <input class="form-check-input"  type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                            </div>
                            <p><strong>47)</strong> Foto do animal (caso houver): <br>
                            <div class="form-check">
                                <input class="form-check-input"  type="file" name="foto" id="foto"> <br></p>
                            </div> -->
                            
                            <p><strong>46)</strong> Alguma observação? <br>
                            <div class="form-check">
                                <textarea class="form-control"  name="obs_interessado" cols="70" rows="5" id="obs_interessado" required ></textarea><br></p>
                                <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis</small>
                            </div>
                        </div>
                    </div>
                        
        <div class="form-row">
            <div class="form-group col-md-6">
                <p>Por gentileza, preencha o Captcha (letras maiúsculas e minúsculas, sem espaços):</p>
                <img src="captcha.php?l=150&a=50&tf=20&ql=5">
                <input type="text" name="palavra"  />
            </div>
            <input type="text" name="idanimal" id="idanimal" value="<? echo $idanimal?>" hidden>
            <strong><center>O GAAR se reserva no direito de não concretizar a doaçao caso o perfil não se encaixe nas normas do estatuto interno da ONG.</center></strong>
            <i><center>Para garantir que os e-mails cheguem em sua caixa de entrada, sugerimos adicionar <strong>operacional@gaarcampinas.org</strong> à lista de remetentes confiáveis. Caso não adicione, verifique sua caixa de SPAM.</i></center><br>
            <a href="javascript:form.submit()" class="btn btn-button">Enviar</a><br><br></center>
        </div>
    </form>
</div>
<?
  }
?>
</main>
</body>
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
