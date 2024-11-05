<?php 

session_start();

include ("conexao.php"); 

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
    
    <title>GAAR - Inscrição para lista de espera do GAAR</title>
    
    <script type="text/javascript">
	function cadastropet(){
		document.form.action = 'cadastropet.php'; 
		document.form.submit();
	}
	function atualizapet(){
		document.form.action = 'atualizapet.php'; 
		document.form.submit();
	}
	
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
	</script>
	<script type="text/javascript">
                        
                            function OnChangeRadio (radio) {
                                        document.getElementById('divterceiros').className  = "d-block";
                                }
                                
                            function OnChangeRadio2 (radio) {
                                        document.getElementById('divterceiros').className  = "d-none";
                                }
                                
                            function OnChangeRadio6 (radio) {
                                    
                                        document.getElementById("dtcastracao").value ='';
                                        
                                        var anoCadastracao
                                        var mesCadastracao
                                        var diaCadastracao
                                        var meses = ["01","02","03","04","05","06","07","08","09","10","11","12"];
                                        dataatual = new Date();
                                        
                                        var dtnasc = document.getElementById("idade").value;
                                        nascimento = new Date(dtnasc)
                                        nascimento.setDate(nascimento.getDate() + 1)
                                        
                                        console.log(dtnasc);
                                        console.log(nascimento);
                                        console.log(dataatual);
                                        
                                        diferenca = Math.abs(nascimento.getTime() - dataatual.getTime())
                                        days = Math.ceil(diferenca / (1000 * 60 * 60 * 24));
                                        console.log(days);
                                        if ( days >= 1 && days <= 30){
                                            nascimento.setDate(nascimento.getDate() + 150)
                                        }
                                        
                                        if ( days >= 31 && days <= 60){
                                            nascimento.setDate(nascimento.getDate() + 150)
                                        }
                                        
                                        if ( days >= 61 && days <= 90){
                                            nascimento.setDate(nascimento.getDate() + 150)
                                        }
                                        
                                        if ( days >= 91 && days <= 120){
                                            nascimento.setDate(nascimento.getDate() + 150)
                                        }
                                        
                                        if ( days >= 121 && days <= 149){
                                            nascimento.setDate(nascimento.getDate() + 150)
                                        }
                                        
                                        var datacadastracaonova = ""
                                        anonovo = nascimento.getFullYear();
                                        mesnovo = meses[nascimento.getMonth()];
                                        dianovo = nascimento.getDate();
                                        
                                        anoconversao = anonovo.toString();
                                        diaconversao = dianovo.toString();

                                        
                                        
                                        datacadastracaonova = anoconversao.concat("-",mesnovo,"-",diaconversao);
                                        document.getElementById("dtcastracao").value = datacadastracaonova;
                                        
                                        
                                        
                                        if ( days >= 150){
                                            alert("Castração já deveria estar realizada!",0,"Atenção");
                                            document.getElementById("dtcastracao").value ='';
                                        }
                                        
                                        
                                                                 
                                                                 
                                } 
                            
                            
    </script>
    
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">
       <center><img src="logo pequeno.png"><br><br></center>
        
            <center><h3>COMISSÃO PROVISÓRIA DE CÃES (CPC)</h3><br>
            <h5>Novas regras relacionadas ao cães do GAAR</h5><br></center>
            <p>Em função da necessidade de maior organização e controle, visando o bem estar dos animais e clareza de informações, criamos a Comissão Provisória de Cães (CPC) para controle e administração dos caninos sob cuidados do GAAR. A comissão é formada atualmente por Marcelli Balduino, Juliana Gialluca, Sônia R. Pequeno e Ingrid Menz.<br><br>
            Pedimos que leiam com atenção, estamos a disposição para esclarecimentos. <br><br>
            Como se dará o controle dos cães a partir de hoje:<br><br>
            <strong>1. </strong>Manteremos contato com o LT do animal, atualizando informações do cadastro.<br>
            <strong>2. </strong>Todas as modificações e atualizações do animal (incluindo adoção e devolução) devem ser informadas à CPC.<br>
            <strong>3. </strong>Qualquer membro dessa comissão tem total liberdade de entrar em contato com os LT’s para pedir informações.<br>
            <center><h5>Regras para os voluntários que atuam como operacional e são responsáveis por cães</h5></center><br>
            <strong>1. </strong>Todos os cães que entrarem, a partir de hoje, devem ser obrigatoriamente informados a CPC.<br>
            <strong>2. </strong>Novos cães serão aceitos apenas depois de feito o cadastro na área restrita, localizada na plataforma online, onde todas as informações do animal e voluntário responsável devem ser submetidas, para controle da CPC. <br>
            <strong>3. </strong>Depois de feito o cadastro do animal, a CPC irá analisar o caso e o voluntário solicitante. <br>
            <strong>4. </strong>Quando abrir uma vaga, um membro da CPC entrará em contato com o voluntário informando o LT que o animal ficará. <br>
            <strong>5. </strong>Durante a espera para entrada no LT o voluntário deve informar à CPC qualquer alteração do animal (doença, castração, etc), para assim sabermos melhor qual LT será o ideal para o animal, e atualizar o cadastro do mesmo na plataforma online. <br>
            <strong>6. </strong>O voluntário responsável pelo animal deve seguir as orientações da CPC e respeitar as regras, caso não ocorra respeito às regras, o voluntário será proibido de submeter novos animais à CPC por tempo indeterminado. <br>
            <strong>7. </strong>O voluntário responsável deve se atentar às necessidades do animal e providenciá-las (mesmo que o GAAR pague), como vacina, vermífugo, castração, medicamentos, etc. Ou seja, o voluntário deve estar ciente de qualquer necessidade que o animal precise e ir atrás para supri-la. O animal que está no LT ainda é sua responsabilidade, e suas necessidades devem ser atendidas. <br>
            <strong>8. </strong>Só entrarão novos cães no LT quando abrirem vagas e mediante autorização da CPC. <br>
            <strong>9. </strong>O animal terá um prazo de permanência no LT de seis meses, após esse período o voluntário se responsabilizará pelo LT dele. <br>
            <strong>10. </strong>Pedidos de terceiros somente serão atendidos caso exista um voluntário responsável pelo animal (voluntário ativo na ONG), não serão aceitos pedidos de pessoas de fora do GAAR sem que exista um membro ativo que se responsabilize por ele e cumpra as exigências pedidas. <br>
            <strong>11. </strong>Após ocorrer a entrada do animal no LT as despesas financeiras serão todas de responsabilidade do GAAR (LT, ração, medicamentos, vacina, castração, etc). <br><br>
            
            <center><h5>Responsabilidades do voluntário que colocar o cão no LT pago pelo GAAR:</h5></center><br>
            
            <strong>1. </strong>Participação do voluntário nas feiras de adoção: O agendamento dos animais que forem para as feiras é feita pela Juliana e Dra. Ingrid . O voluntário deverá se envolver em atividades/ações cujo propósito é a adoção responsável desse animal por ele resgatado e, portanto, durante a semana deve enviar um pedido de agendamento à Juliana, se preparar para o transporte do animal e ficar presente durante o evento de adoção.<br>
            <strong>2. </strong>O voluntário deverá conversar com a equipe de comunicação, fotografar o animal e providenciar a divulgação até sua adoção. Diversificar as formas de divulgação para agilizar a doação do cão. <br>
            <strong>3. </strong>Ficar atento ao e-mail de recebimento de pré termo, e entrar em contato com o interessado pelo animal.<br>
            <strong>4. </strong>O voluntário deve atualizar o cadastro do animal no site e, em caso de adoção, submeter o termo de compromisso ou avisar para que isso ocorra.<br>
            <strong>5. </strong>O voluntário deverá se engajar em campanhas que visem à manutenção dos animais que estão em lares hospedeiros do GAAR. Ex: participação nos bazares da ONG; realização de rifas, eventos para a compra de ração, remédios, vacinas, pagamento de castração e outros itens que são necessários para a manutenção dos animais em lares temporários.<br>
            <strong>6. </strong>O voluntário deve passear regularmente com o animal, ou providenciar quem faça isso.<br>
            <strong>7. </strong>Todo transporte do animal, seja para feira, veterinário ou interessado em adoção, deve ser feita pelo voluntário responsável ou providenciada por ele.<br>
            <strong>8. </strong>Qualquer dúvida deve ser encaminhada à CPC. <br><br>
            
            <center><h5>Informações importantes</h5></center><br>
            
            <strong>1. </strong>Só serão escalados para a feira animais que estiverem com os requisitos adequados (vacina, vermífugo, antipulgas, castração). Agendamentos devem ser realizados com antecedência e a escala deve ser respeitada, animais que não ficarem na feira, mas irão apenas para serem adotados devem ser informados à coordenação de feiras (Juliana), e qualquer alteração na escala deve ser informada.<br>
            <strong>2. </strong>A CPC tem autonomia para realizar qualquer mudança no LT.<br>
            <strong>3. </strong>A CPC entrará em contato constante com o LT para obter informações de cada animal.<br>
            <strong>4. </strong>Não será permitida a permanência de animais não agendados na feira.<br>
            <strong>5. </strong>Caso um voluntário faça o resgate de um cão e não precise de LT (neste caso o animal estará com ele ou outro LT de sua responsabilidade), o GAAR pode assumir as despesas como ração, vacina, castração, divulgação, vaga em feira e medicamentos, mas é necessário passar pela aprovação da CPG. <br><br></p>
            
            <center><h3>COMISSÃO PROVISÓRIA DE GATOS (CPG)</h3><br>
            <h5>Novas regras relacionadas ao gatos do GAAR</h5><br></center>
            <p>Em função da enorme demanda de entradas de gatos na Ong criamos a Comissão Provisória de Gatos (CPG) para controle e administração dos felinos son cuidados do GAAR. A comissão é formada por Marcelli Balduino, Juliana Gialluca e Carlos Rosa. <br><br>
            No momento estamos com 71 gatos em lares temporários, e temos como objetivo abaixar este número para 55, correspondendo ao limite que a ONG estipulou e ao número que comportamos em lares temporários.<br><br>
            <strong>NÃO ESTAMOS ASSUMINDO MAIS GATOS</strong>, só serão aceitos mais animais quando o número total de gatos diminuírem e atingirmos 55 ou menos.<br><br>
            Como se dará o controle dos gatos a partir de hoje:<br>
            <strong>1. </strong>Entraremos em contato com todos os LT’s de gato, coletando todas as informações e mantendo o cadastro dos gatos atualizado.<br>
            <strong>2. </strong>Todas as trocas entre os LT’s deverão ser feitas pela CPG.<br>
            <strong>3. </strong>Qualquer mudança ou interferência que precise ocorrer no LT deve ser informada à CPG.<br>
            <strong>4. </strong>Adoções de gatos devem ser informadas à CPG.<br>
            <strong>5. </strong>Qualquer membro dessa comissão tem total liberdade de entrar em contato com os LT’s para pedir informações.<br><br>
            
            <center><h5>Regras para os voluntários que atuam como operacional e são responsáveis por gatos</h5></center><br>
            <strong>1. </strong> Todos os gatos que entrarão a partir de hoje devem ser obrigatoriamente informados a CPG, seremos nós responsáveis pela entrada deles na ONG e por designarmos o LT para o mesmo.<br>
            <strong>2. </strong>Novos gatos serão aceitos apenas depois de feito o cadastro deles no formulário abaixo, onde todas as informações do animal e voluntário responsável por ele devem ser submetidas, para controle da CPG.<br>
            <strong>3. </strong>Apenas serão permitidos <strong>3 animais </strong> por voluntário para submissão à plataforma, esses animais estarão na fila de espera  e deverão ser assumidos pelo responsável até termos vagas disponíveis. <br>
            <strong>4. </strong>Após submetidos na plataforma, os animais entrarão numa lista de espera para o LT, quando a vaga surgir, um membro da CPG entrará em contato com o voluntário informando o LT que o animal ficará.<br>
            <strong>5. </strong>Durante a espera para entrada no LT, o voluntário deve informar à CPG qualquer alteração do animal (doença, castração, etc), para assim sabermos melhor qual LT seria o ideal para o animal.<br>
            <strong>6. </strong> O voluntário responsável pelo animal deve seguir as orientações da CPG e respeitar as regras, caso não seja ocorra respeito às regras, o voluntário será proibido de submeter novos animais à CPG por tempo indeterminado.<br>
            <strong>7. </strong>O voluntário responsável pelo animal deve levar ele ao LT, ou providenciar o transporte dele.<br>
            <strong>8. </strong>O voluntário responsável deve se atentar as necessidades do animal, vacina, vermífugo, castração, medicamentos, ração, areia, etc. O animal que está no LT ainda é sua responsabilidade também, e as necessidades dele devem ser atendidas. Caso o animal entre no LT sem vacina, antipulgas e vermífugo, tais requisitos devem ser preparados para o animal (vermífugo e antipulgas devem ser entregues ao LT no momento da entrada do animal), vacinas devem ser providenciadas e agendadas, caso entrem sem elas. Caso o animal seja preparado antes, deve entrar no LT vacinado, vermifugado e despulgado. Fêmeas devem ser castradas com 4 meses, e machos com 4 ou 5 meses.<br>
            <strong>9. </strong>O voluntário deve se comunicar com um membro da CPG sobre qualquer atualização do animal. <br>
            <strong>10. </strong> O voluntário deve atualizar o cadastro do animal no site, e em caso de adoção, submeter o termo de compromisso ou avisado para que isso ocorra.<br><br>
            
            <center><h5>Informações importantes</h5></center><br>
            <strong>1. </strong>Só serão escalados para a feira animais que estiverem com os requisitos adequados (vacina, vermífugo, antipulgas, castração).<br>
            <strong>2. </strong>A CPG tem autonomia para realizar trocas nos LT’s, que serão informadas ao voluntário responsável.<br>
            <strong>3. </strong> A CPG entrará em contato constante com o LT para obter informações de cada animal.<br><br>
            
            <h5>Agradecemos a compreensão de todos, e estamos à disposição para esclarecimento de dúvidas e outras coisas.</h5><br><br>

        <center><h3>INSCRIÇÃO PARA A LISTA DE ESPERA DE ANIMAIS</h3><br></center>
        <p><label> Este formulário tem como objetivo coletar informações dos animais que estão sob responsabilidade da ONG GAAR, para fins administrativos e controle dos mesmos. Por gentileza, preencha um formulário para cada animal. </label></p>
       </center>
            <form action="cadastropet.php" method="POST" enctype="multipart/form-data" name="form">
                	<div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome do animal: </label> 
                            <input name="nomeanimal" type="text" id="nomeanimal" maxlength="20" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nascimento (aproximado): </label> 
                            <input name="idade" type="date" id="idade" class="form-control" required>
                        </div>
                    </div>
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Espécie: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="especie" id="Canina" value="Canina"><label class="form-check-label" for="gridRadios1" required>Canina</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="especie" id="Felina" value="Felina" checked><label class="form-check-label" for="gridRadios1">Felina</label>
                        </div>
                      </div>
                    </div>
                </fieldset>
                <br>
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Sexo: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sexo" id="Macho" value="Macho"><label class="form-check-label" required>Macho </label> &nbsp;&nbsp;
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sexo" id="Fêmea" value="Fêmea"><label class="form-check-label">Fêmea </label> 
                        </div>
                      </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Cor: </label> 
                  <div class="col-sm-10">
                    <select class="form-control" id="inlineFormCustomSelect" name="cor" required>
                         		  <option selected value="">Selecione</option>
                         		  <option value="Branco">Branco</option>
                         		  <option value="Branco e preto">Branco e preto</option>
                         		  <option value="Branco e cinza">Branco e cinza</option>
                         		  <option value="Branco e amarelo">Branco e amarelo</option>
                         		  <option value="Bege">Bege</option>
                         		  <option value="Caramelo">Caramelo</option>
                         		  <option value="Preto">Preto</option>
                         		  <option value="Preto e marrom">Preto e marrom</option>
                         		  <option value="Preto e bege">Preto e bege</option>
                         		  <option value="Escaminha">Escaminha</option>
                         		  <option value="Siames">Siames</option>
                         		  <option value="Tricolor">Tricolor</option>
                        </select>
                  </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Porte: </legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="porte" id="Pequeno" value="Pequeno"> <label class="form-check-label" required>Pequeno </label> &nbsp; &nbsp;
                            </div>
                            <div class="form-check">    
                                <input class="form-check-input" type="radio" name="porte" id="Médio" value="Médio"> <label class="form-check-label">Médio </label> &nbsp; &nbsp;
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="porte" id="Grande" value="Grande"> <label class="form-check-label">Grande </label> &nbsp; &nbsp;
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="porte" id="Não se aplica" value="Não se aplica"> <label class="form-check-label">Gato </label> &nbsp; &nbsp;
                            </div>
                      </div>
                      </div>
                </fieldset>
                <div class="form-row">
                    <div class="form-group col-md-10">
                      <label>O animal está castrado? Devem ser castrados a partir dos 4 meses (machos podem ser com 5 meses) </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="castracao" id="Castrado" value="Sim"><label class="form-check-label" required>Sim </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="castracao" id="Não castrado" value="Não" onclick="OnChangeRadio6 (this)"><label class="form-check-label">Não</label> &nbsp; &nbsp;
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Data da castração (ou previsão): </label>
                        <input class="form-control" type="date" name="dtcastracao" id="dtcastracao" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>O animal está vacinado? </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vacinacao" id="vacinacao" value="Sim"><label class="form-check-label" required>Sim </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vacinacao" id="nao vacinado" value="Não"><label class="form-check-label">Não</label> &nbsp; &nbsp;
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-10">
                      <label>Quantas doses de vacina já tomou? Animais recebem 2 doses da vacina, a 1ª a apartir dos 60 dias de idade, e a 2ª 30 dias depois. Caso o animal tenha 2 meses ou mais e não possui vacinas em dia, pedimos que entre em contato com a pessoa responsável por ele.  </label>
                        <select class="form-control" id="inlineFormCustomSelect" name="doses" required>
                         		  <option selected value="0">0</option>
                         		  <option value="1">01</option>
                         		  <option value="2">02</option>
                         		  <option value="3">03</option>
                        </select>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="form-group col-md-6">
                      <label>O animal foi vermifugado? Deve receber duas doses com intervalo de 15 dias entre elas </label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="vermifugado" id="Vermifugado" value="Sim"><label class="form-check-label" required>Sim </label> &nbsp; &nbsp;
                         </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="vermifugado" id="Não vermifugado" value="Não"><label class="form-check-label">Não</label> &nbsp; &nbsp;
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <div class="form-group col-md-6">
                      <label>O animal foi despulgado? (Obrigatório a partir dos 60 dias)</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="despulgado" id="despulgado" value="Sim"><label class="form-check-label" required>Sim </label> &nbsp; &nbsp;
                         </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="despulgado" id="Não despulgado" value="Não"><label class="form-check-label">Não</label> &nbsp; &nbsp;
                        </div>
                       </div>
                </fieldset>
                <!--<div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Lar temporário: </label>
                            <select class="form-control" id="inlineFormCustomSelect" name="lt" required>
                         		  <option selected value="">Selecione</option>
                         		  <?
                        		 		$query = "SELECT LAR_TEMPORARIO FROM LT ORDER BY LAR_TEMPORARIO ASC";
                        				$select = mysqli_query($connect,$query);
                        				
                        				while ($fetch = mysqli_fetch_row($select)) {
                        					echo "<option value='".$fetch[0]."'>".$fetch[0]."</option>";
                        				}
                        		?>
                	        </select>
                	    </div>
                	    <div class="form-group col-md-4">
                            <label>Data de entrada: </label>
                            <input type="date" name="dtentradalt" id="dtentradalt" class="form-control" required>
                        </div>
                </div>-->
                <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Quem está solicitando uma vaga: </label>
                            <select class="form-control" id="inlineFormCustomSelect" name="resp" required>
                     		  <option selected value="">Selecione</option>
                         		  <?
                        		 		$queryresp = "SELECT NOME FROM VOLUNTARIOS WHERE CPG <> '' ORDER BY NOME ASC";
                        				$selectresp = mysqli_query($connect,$queryresp);
                        				
                        				while ($fetchresp = mysqli_fetch_row($selectresp)) {
                        					echo "<option value='".$fetchresp[0]."'>".$fetchresp[0]."</option>";
                        				}
                        				
                        				
                        		?>
                    	    </select>
                    	 </div>
                            
                </div>
                <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Status: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="divulgar" id="divulgar" value="LEG" checked><label class="form-check-label">Lista de espera </label>
                        </div>
                       </div>
                    </div>
                </fieldset>
                   <!-- <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Saída do lt: </label> 
                      <div class="col-sm-10">
                        <input name="idade" type="date" name="dtsaidalt" id="dtsaidalt" class="form-control">
                      </div>
                    </div>
                     <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-4 pt-0">Tipo do anúncio: </legend>
                      <div class="col-sm-12">
                            <div class='form-check'>
                                    <input class='form-check-input' type="radio" name="tipoanuncio" id="tipoanuncio" value="Doação" checked>Doação<br>
                                    <input class='form-check-input' type="radio" name="tipoanuncio" id="tipoanuncio" value="Perdido">Animal perdido<br>
                                    <input class='form-check-input' type="radio" name="tipoanuncio" id="tipoanuncio" value="Encontrado">Animal encontrado<br><br>
                            </div>
                        </div>
                      <legend class="col-form-label col-sm-2 pt-0">Divulgar como: </legend>
                      <div class="col-sm-10">
                            <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='divulgar' id='divulgar' value='GAAR' onclick="OnChangeRadio2 (this)" checked><label class='form-check-label'>GAAR </label>
                            </div>
                            <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='divulgar' id='divulgar' value='Terceiros' onclick="OnChangeRadio (this)"><label class='form-check-label'>Terceiros </label>
                            </div>
                            <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='divulgar' id='divulgar' value='Não divulgar' onclick="OnChangeRadio2 (this)"><label class='form-check-label'>Não divulgar para adoção (para controle do CPG)</label>
                            </div>
                       </div>
                    </div>
                        <div id="divterceiros" class="form-row d-none">
                                <div class="form-group col-md-6">
                                    <label>E-mail do responsável: </label> 
                                    <input name="emailresp" type="email" id="emailresp" maxlength="500" class="form-control">
                                    <small id="passwordHelpBlock" class="form-text text-muted">Máximo 500 caracteres</small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Telefone do responsável: </label> 
                                    <input name="telresp" type="text" id="telresp" class="form-control">
                                    <small id="passwordHelpBlock" class="form-text text-muted">com DDD, sem espaços e sem hífen</small>
                                </div>
                        </div>
                </fieldset>-->
                <div class="form-row">
                    <label>Foto do animal: </label>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" name="foto">
                    <label class="custom-file-label" for="validatedCustomFile">Escolher arquivo</label>
                </div>
                <br>
                <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>História (Pedimos a gentileza, se possível, de informar como foi resgatado, da onde ele veio, como foi pego. Estas informações ajudam na divulgação do animal e informação para interessados. Caso não saiba, o responsável por ele nos informará.) </label> 
                            <textarea class="form-control" name="obs" cols="70" rows="10" id="obs" value="<? echo $obs?>"></textarea>
                                <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                        </div>
                </div>
                
                <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Origem do animal (deve conter o nome do voluntário que entregou o animal à você, ou seja, a pessoa responsável por ele. Caso seja você, coloque seu nome)</label> 
                            <textarea class="form-control" name="origem" cols="70" rows="10" id="origem"></textarea>
                                <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                        </div>
                </div>
                
                <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Comportamento do animal (pedimos por gentileza que descreva brevemente o comportamento dele, por exemplo: dócil, medroso, agitado, gosta de animais ou desgosta, arisco, etc)</label> 
                            <textarea class="form-control" name="comportamento" cols="70" rows="10" id="comportamento"></textarea>
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