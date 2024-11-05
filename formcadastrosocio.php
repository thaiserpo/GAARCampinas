<?php 

session_start();

include ("conexao.php"); 

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
    
    <title>GAAR - Cadastro de sócios</title>
    
    <script type="text/javascript">
	
        function OnChangeRadio (radio) {
                    document.getElementById('divoutrovalor').className  = "d-block"; 
                    document.getElementById('divboleto').className  = "d-none";
            }
            
        function OnChangeRadio2 (radio) {
                    document.getElementById('valoritens').checked = true; 
                    document.getElementById('agenciaconta').className  = "d-none";
                    document.getElementById('divboleto').className  = "d-none";
            }
        
        function OnChangeRadio3 (radio) {
                    document.getElementById('mensal').checked = true; 
                    document.getElementById('lembrete_nao').checked = true; 
                    document.getElementById('agenciaconta').className  = "d-none";
                    document.getElementById('divboleto').className  = "d-none";
            }
            
        function OnChangeRadio4 (radio) {
                    document.getElementById('divboleto').className  = "d-block";
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
			  
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
       <center>
        <h3>CADASTRO DE SÓCIOS</h3><br>
        <p><label> É importante cadastrar o sócio corretamente pois as informações aqui preenchidas irão ser usadas para cadastrar o lançamento financeiro e enviar notificações</label></p>
       </center>
<form name="formsocio" method="post" action="cadastrosocio.php">
    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome<font color="red">*</font>: </label> 
                            <input name="nomesocio" type="text" id="nomesocio" maxlength="100" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Cidade/UF: </label> 
                            <input name="cidadesocio" type="text" id="cidadesocio" maxlength="20" class="form-control" required>
                        </div>
    </div>
    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>DDD + Celular (só números): </label> 
                            <input name="celularsocio" type="text" id="celularsocio" maxlength="20" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>E-mail: </label> 
                            <input name="emailsocio" type="email" id="emailsocio" maxlength="150" class="form-control" required>
                        </div>
    </div>
    <div class="form-row">
                <div class="form-group col-md-6">
                            <label>Qual das formas abaixo o sócio preferiu utilizar para fazer a doação?<font color="red">*</font></label> <br>
                            <input type="radio" name="forma" id="apoiase" value="Apoia.se">Apoia.se <br>
                            <input type="radio" name="forma" id="itau" value="Banco Itaú">Banco Itaú <br>
                            <input type="radio" name="forma" id="bb" value="Banco do Brasil">Banco do Brasil <br>
                            <input type="radio" name="forma" id="boleto" value="Boleto" onClick="OnChangeRadio4 (this)">Boleto bancário <br>
                            <input type="radio" name="forma" id="pagseguro" value="Pag Seguro">Pagseguro <br>
                            <input type="radio" name="forma" id="picpay" value="PicPay" onClick="OnChangeRadio3 (this)">PicPay<br>
                            <input type="radio" name="forma" id="itens" value="Doação de itens" onClick="OnChangeRadio2 (this)">Doação de itens (ração, areia, medicamentos, etc)<br>
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
                            <input class="form-check-input" type="radio" name="valorsocio" id="valorsocio" value="Outro" onClick="OnChangeRadio (this)"> <label class="form-check-label">Outro valor</label> &nbsp; &nbsp; <br>
                            <input class="form-check-input" type="radio" name="valorsocio" id="valoritens" value="Item"> <label class="form-check-label">Doação de itens</label> &nbsp; &nbsp; <br>
                </div>
    </div>
    <div class="form-row">
                        <div id="divboleto" class="form-row d-none">
                            <div class="form-group col-md-12">
                                <label>CPF: </label> 
                                <input type="text" name="cpf" id="cpf" maxlength="12" class="form-control" required>
                                <small id="passwordHelpBlock" class="form-text text-muted">A Febraban, Federação Brasileira de Bancos, em atenção à determinação do Banco Central do Brasil – Circular n. 3.656/2013 – instituiu a obrigatoriedade do registro do CPF ou CNPJ do destinatário em todas as cobranças por boleto bancário</small>
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
                    <div class="form-group col-md-3">
                                <label>Banco: </label> <br>
                                    <select name="bancosocio" id="bancosocio" class="form-control" id="inlineFormCustomSelect">
                                      <option value="001 – Banco do Brasil">001 – Banco do Brasil </option>
                                      <option value="341 – Banco Itaú">341 – Banco Itaú </option>
                                      <option value="033 – Banco Santander (Brasil)">033 – Banco Santander (Brasil) </option>
                                      <option value="652 – Itaú Unibanco Holding">652 – Itaú Unibanco Holding </option>
                                      <option value="237 – Banco Bradesco">237 – Banco Bradesco </option>
                                      <option value="745 – Banco Citibank">745 – Banco Citibank </option>
                                      <option value="399 – HSBC Bank Brasil">399 – HSBC Bank Brasil </option>
                                      <option value="389 – Banco Mercantil do Brasil">389 – Banco Mercantil do Brasil </option>
                                      <option value="453 – Banco Rural">453 – Banco Rural </option>
                                      <option value="422 – Banco Safra">422 – Banco Safra </option>
                                      <option value="633 – Banco Rendimento">633 – Banco Rendimento </option>
                                      <option value="318 – Banco BMG">318 – Banco BMG</option>
                                      <option value="260 – Nubank">260 - Nubank</option>
                                      <option value="077 – Banco Inter">077 – Banco Inter</option>
                                      <option value="104 – Caixa Econômica Federal">104 – Caixa Econômica Federal</option>
                                    </select>
                    </div>
                    <div class="form-group col-md-3">
                                <label>Agência: </label> 
                                <input type="text" id="agsocio" name="agsocio" maxlength="10" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3">
                                <label>Conta: </label> 
                                <input type="text" id="contasocio" name="contasocio" maxlength="15" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3">
                                <label>DV: </label> 
                                <input type="text" id="dv" name="dv" maxlength="3" class="form-control" required>
                    </div>
        </div>
        <div class="form-row">
                    <div class="form-group col-md-6">
                                <label>Frequência da doação<font color="red">*</font>: </label> <br>
                                <input type="radio" name="freq" id="mensal" value="Mensal">Mensal <br>
                                <input type="radio" name="freq" id="esporadica" value="Esporádica">Esporádica <br>
                    </div>
        </div>
        <div class="form-row">
                <div class="form-group col-md-6">
                            <label>Qual melhor dia do mês pra doar?<font color="red">*</font> <br>
                            <select name="diadomesocio" id="diadomesocio" class="form-control" >
                                
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
    <center><a href="javascript:formsocio.submit()" class="btn btn-primary">Cadastrar</a></center>
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