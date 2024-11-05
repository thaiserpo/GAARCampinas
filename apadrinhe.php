<?php 

session_start();

include ("conexao.php"); 

$id = $_GET['id'];

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
    
    <title>GAAR - socio um animal abandonado</title>
    
    <script type="text/javascript">
	
        function OnChangeRadio (radio) {
                    document.getElementById('divoutrovalor').className  = "d-block";   
                    document.getElementById('divboleto').className  = "d-none";
                    document.getElementById('divitens').className  = "d-none";
            }
            
        function OnChangeRadio2 (radio) {
                    document.getElementById('valoritens').checked = true; 
                    document.getElementById('agenciaconta').className  = "d-none";
                    document.getElementById('divboleto').className  = "d-none";
                    document.getElementById('divitens').className  = "d-block";
            }
        
        function OnChangeRadio3 (radio) {
                    document.getElementById('mensal').checked = true; 
                    document.getElementById('lembrete_nao').checked = true; 
                    document.getElementById('agenciaconta').className  = "d-none";
                    document.getElementById('divboleto').className  = "d-none";
                    document.getElementById('divitens').className  = "d-none";
            }
            
        function OnChangeRadio4 (radio) {
                    document.getElementById('divboleto').className  = "d-block";
                    document.getElementById('divitens').className  = "d-none";
            }
        
        function OnChangeRadio5 (radio) {
                    document.getElementById('divboleto').className  = "d-none";
                    document.getElementById('divitens').className  = "d-none";
            }
    </script>
    <!--- GOOGLE ADSENSE --->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
    <!--- GOOGLE ADSENSE --->
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">
       <center>
			<a href="http://www.gaarcampinas.org"><img src="/area/logo_transparent.png" width="70" height="70"></a><br>
            <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">APADRINHE UM ANIMAL ABANDONADO</h1><br>
        </center>
        
        <p>Olá, amigos do GAAR. Vamos falar sobre o apadrinhamento de animais. Já ouviu falar? <br>

            O apadrinhamento é um ato de amor que ajuda a manter uma vida enquanto o animal espera por sua família definitiva. As despesas que temos mantendo todos os animais assistidos são altas, portanto sua doação serve para que o GAAR tenha condições de ajudar tantos outros que ainda estão em condições de abandono nas ruas. <br>
            
            Além disso, vários animais esperam sua adoção por muito tempo, e alguns têm pouca chance de ser adotados, por motivos como idade, tamanho e aparência, inclusive preconceito contra sua cor. Eles também merecem ter alguém que se importe com eles, e o apadrinhamento é uma forma de isso acontecer. <br>
            
            Contribuindo mensalmente com um valor estipulado por você para o animal de sua escolha, podemos custear medicamentos, ração, castração e cirurgia para o seu "afilhado" de quatro patas. Você recebe um relatório sobre o animal, te atualizando e oferecendo a oportunidade de ter contato real com ele. <br>
            
            Se você gostaria de adotar mas por algum motivo não pode, ama animais e quer ajudá-los, essa é uma grande chance que o GAAR proporciona para que possamos fazer a diferença JUNTOS.

            <br>
            <h2 class="font-weight-light text-center text-lg-left mt-4 mb-0">Quer apadrinhar um cão ou gato? Veja como funciona</h2><br>
          
        <p>1.  Escolha um valor para depositar. Valores de referência: <br><br>
            Mensalmente<br>
            - R$ 80,00 para ração<br> 
            - R$ 150,00 para lar temporário<br><br> 
        
            Semestralmente:<br>
            - R$ 20,00 para vermífugos<br><br>
        
            Anualmente:<br>
            - R$ 50,00 para vacina (V10 para cães ou V4 para gatos)<br><br>
        
            Caso não esteja castrado:<br>
            - R$ 100,00 para castração <br><br>
        
            Caso seja filhote: <br>
            - R$ 50,00 para cada vacina até completar o ciclo de vacinação (ciclo completo: 3 doses de V10 ou V4 mais Raiva) <br><br>
        2. Preencha o cadastro abaixo <br><br>
        3. Pronto! O voluntário responsável pelo animal escolhido irá receber o seu contato e enviar notícias periódicas sobre ele :) <br><br>
        
        </p>
       <br><br>
<form action="cadastro_apadrinha.php" method="POST" enctype="multipart/form-data" name="form">
    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome<font color="red">*</font>: </label> 
                            <input name="nomesocio" type="text" id="nomesocio" maxlength="100" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>DDD + Celular (só números): </label> 
                            <input name="celularsocio" type="text" id="celularsocio" maxlength="20" class="form-control" required>
                        </div>
    </div>
    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>E-mail: </label> 
                            <input name="emailsocio" type="email" id="emailsocio" maxlength="150" class="form-control" required>
                        </div>
    </div>
    <div class="form-row">
                            <div class="form-group col-md-6">
                            <label>Nome do animal:</label>
                             <select class="form-control" id="nomedoanimal" name="nomedoanimal" required onchange="OnChangeSelect2()">
                         		  
                         		  <?
                         		    if ($id == ''){
                                        $query = "SELECT ID,NOME_ANIMAL FROM ANIMAL WHERE (DIVULGAR_COMO <> 'Terceiros' AND DIVULGAR_COMO <> 'Esperando aprovação') AND (ADOTADO <> 'Adotado' AND ADOTADO <> 'Óbito') ORDER BY NOME_ANIMAL,ESPECIE ASC";
                        				$select = mysqli_query($connect,$query);
                        				
                        				echo "<option selected value=''>Selecione</option>";
                        				
                        				while ($fetch = mysqli_fetch_row($select)) {
                        					echo "<option value='".$fetch[0]."'>".$fetch[1]."</option>";
                        				}
                        			}
                        			else {
                        			    $query = "SELECT ID, NOME_ANIMAL FROM ANIMAL WHERE ID = '$id'";
                                        $select = mysqli_query($connect,$query);
                                        
                                        while ($fetch = mysqli_fetch_row($select)) {
                                            $idanimal = $fetch[0];
                        					echo "<option value='".$fetch[0]."'>".$fetch[1]."</option>";
                        				}
                                        
                                        
                        			}
                        		?>
                	         </select>
                	        </div>
                	        <small id="passwordHelpBlock" class="form-text text-muted">A lista será apresentada como nome e espécie de forma ascendente. Ex: para dois nomes iguais, o primeiro nome será a espécie Canina e o segundo Felina. </small>
                        </div>
    <div class="form-row">
        <label><a href="http://www.gaarcampinas.org/queroapadrinhar.php" target="_blank">Conheça as histórias aqui</a></label>
    </div>
    <div class="form-row">
                <div class="form-group col-md-6">
                            <label>Qual das formas abaixo prefere utilizar para fazer a doação?<font color="red">*</font></label> <br>
                            <input type="radio" name="forma" id="itau" value="DOC/TED" onClick="OnChangeRadio5 (this)">DOC ou Ted<br>
                            <input type="radio" name="forma" id="boleto" value="Boleto" onClick="OnChangeRadio4 (this)">Boleto bancário<br>
                            <input type="radio" name="forma" id="picpay" value="PicPay" onClick="OnChangeRadio3 (this)">PicPay<br>
                            <input type="radio" name="forma" id="pix" value="PIX" onClick="OnChangeRadio3 (this)">PIX<br>
                            <input type="radio" name="forma" id="itens" value="Doação de itens" onClick="OnChangeRadio2 (this)">Doação de itens (ração, areia, medicamentos, etc)<br>
                </div>
    </div>
    <div class="form-row">
                        <div id="divboleto" class="form-row d-none">
                            <div class="form-group col-md-12">
                                <label>CPF: </label> 
                                <input type="text" name="cpfsocio" id="cpfsocio" maxlength="12" class="form-control" required>
                                <small id="passwordHelpBlock" class="form-text text-muted">* O boleto terá o custo de R$1,00 a mais no valor da doação. A Febraban, Federação Brasileira de Bancos, em atenção à determinação do Banco Central do Brasil – Circular n. 3.656/2013 – instituiu a obrigatoriedade do registro do CPF ou CNPJ do destinatário em todas as cobranças por boleto bancário</small>
                            </div>
                        </div>
    </div>
    <div class="form-row">
                <div class="form-group col-md-12">
                            <label>Valor da contribuição<font color="red">*</font>: </label> <br>
                            <input class="form-check-input" type="radio" name="valorsocio" id="valorsocio" value="10.00"> <label class="form-check-label">R$10,00</label> &nbsp; &nbsp; <br>
                            <input class="form-check-input" type="radio" name="valorsocio" id="valorsocio" value="20.00"> <label class="form-check-label">R$20,00</label> &nbsp; &nbsp; <br>
                            <input class="form-check-input" type="radio" name="valorsocio" id="valorsocio" value="30.00"> <label class="form-check-label">R$30,00</label> &nbsp; &nbsp; <br>
                            <input class="form-check-input" type="radio" name="valorsocio" id="valorsocio" value="40.00"> <label class="form-check-label">R$40,00</label> &nbsp; &nbsp; <br>
                            <input class="form-check-input" type="radio" name="valorsocio" id="valorsocio" value="50.00"> <label class="form-check-label">R$50,00</label> &nbsp; &nbsp; <br>
                            <input class="form-check-input" type="radio" name="valorsocio" id="valorsocio" value="80.00"> <label class="form-check-label">R$80,00</label> &nbsp; &nbsp; <br>
                            <input class="form-check-input" type="radio" name="valorsocio" id="valorsocio" value="100.00"> <label class="form-check-label">R$100,00</label> &nbsp; &nbsp; <br>
                            <input class="form-check-input" type="radio" name="valorsocio" id="valorsocio" value="150.00"> <label class="form-check-label">R$150,00</label> &nbsp; &nbsp; <br>
                            <input class="form-check-input" type="radio" name="valorsocio" id="valorsocio" value="Outro" onClick="OnChangeRadio (this)"> <label class="form-check-label">Outro valor</label> &nbsp; &nbsp; <br>
                            <input class="form-check-input" type="radio" name="valorsocio" id="valoritens" value="Item"> <label class="form-check-label">Doação de itens</label> &nbsp; &nbsp; <br>
                </div>
    </div>
    <div id="divitens" class="form-row d-none">
        <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Itens: </label> 
                      <div class="col-sm-10">
                        <textarea class="form-control" name="itens" cols="70" rows="10" id="itens"></textarea>
                        <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                      </div>
        </div>
    </div>
    <div class="form-row">
                        <div id="divoutrovalor" class="form-row d-none">
                            <div class="form-group col-md-12">
                                <label>Outro valor: </label> 
                                <input type="text" name="outrovalor" id="outrovalor" maxlength="12" class="form-control" required>
                            </div>
                        </div>
   </div>
   <div id="agenciaconta" class="form-row d-block">
        <div class="form-row">
                    <div class="form-group col-md-6">
                                <label>Frequência da doação<font color="red">*</font>: </label> <br>
                                <input type="radio" name="freq" id="mensal" value="Mensal">Mensal <br>
                                <input type="radio" name="freq" id="semestral" value="Semestral">Semestral <br>
                                <input type="radio" name="freq" id="anual" value="Anual">Anual <br>
                                <input type="radio" name="freq" id="esporadica" value="Esporádica">Esporádica <br>
                    </div>
        </div>
        <div class="form-row">
                <div class="form-group col-md-6">
                            <label>Qual melhor dia do mês pra doar?<font color="red">*</font> <br>
                            <select name="diadomesocio" id="diadomesocio" class="form-control" id="inlineFormCustomSelect">
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                              </select>
                </div>
            </div>
        <div class="form-row">
                    <div class="form-group col-md-6">
                                <label>Deseja receber lembrete mensal? <font color="red">*</font></label><br>
                                <input type="radio" name="lembrete" id="lembrete_sim" value="Sim">Sim <br>
                                <input type="radio" name="lembrete" id="lembrete_nao" value="Não">Não <br>
                    </div>
        </div>
    </div>
    <font color="red"><i>* Campos obrigatórios</i></font>
    <br>
    <input type="text" name="idanimal" id="idanimal" value="<? echo $idanimal ?>" hidden>
    <input type="text" name="apadrinhar" id="apadrinhar" value="apadrinhar" hidden>
    <center><a href="javascript:form.submit()" class="btn btn-primary">Cadastrar</a></center>
    <br>
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