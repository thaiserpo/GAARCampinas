<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$id = $_GET['id'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}

        $query = "SELECT * FROM SOCIO WHERE ID = '".$id."'";
        $select = mysqli_query($connect,$query);
        
        
        while ($fetchsocio = mysqli_fetch_row($select)) {                               
            $id = $fetchsocio[0];	
    		$nome = $fetchsocio[1];
    		$cidade = $fetchsocio[2];
    		$celular = $fetchsocio[3];
    		$email = $fetchsocio[4];
    		$valor = $fetchsocio[5];
    		$forma_ajudar = $fetchsocio[6];
    		$melhor_dia = $fetchsocio[7];
    		$freq = $fetchsocio[13];
    		$lembrete = $fetchsocio[8];
    		$agencia = $fetchsocio[10];
    		$conta = $fetchsocio[11];
    		$id_animal = $fetchsocio[16];
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
    
    <title>GAAR - Atualização de sócios</title>
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
        <h3>ATUALIZAÇÃO DE SÓCIOS</h3><br>
        <p><label> É importante atualizar o sócio corretamente pois as informações aqui preenchidas irão ser usadas para cadastrar o lançamento financeiro e enviar notificações</label></p>
       </center>
<form name="formsocio" method="post" action="atualizasocio.php">
    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>ID: <? echo $id?></label> 
                            <input name="idsocio" type="text" id="idsocio" class="form-control" required value="<? echo $id ?>" hidden>
                        </div>
    </div>
    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome<font color="red">*</font>: </label> 
                            <input name="nomesocio" type="text" id="nomesocio" maxlength="100" class="form-control" required value="<? echo $nome ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Cidade/UF: </label> 
                            <input name="cidadesocio" type="text" id="cidadesocio" maxlength="20" class="form-control" value="<? echo $cidade ?>">
                        </div>
    </div>
    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>DDD + Celular (só números): </label> 
                            <input name="celularsocio" type="text" id="celularsocio" maxlength="20" class="form-control" value="<? echo $celular ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>E-mail: </label> 
                            <input name="emailsocio" type="email" id="emailsocio" maxlength="150" class="form-control" required value="<? echo $email ?>">
                        </div>
    </div>
    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Valor da contribuição<font color="red">*</font>: </label> 
                            <select name="valorsocio" id="valorsocio" class="form-control" id="inlineFormCustomSelect">
                              <option value="<? echo $valor ?>" selected><? echo $valor ?></option>
                              <option value="0">--------</option>
                              <option value="10.00">R$10,00</option>
                              <option value="20.00">R$20,00</option>
                              <option value="30.00">R$30,00</option>
                              <option value="40.00">R$40,00</option>
                              <option value="50.00">R$50,00</option>
                              <option value="Outro">Outro valor</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Outro valor: </label> 
                            <input type="text" name="outrovalor" id="outrovalor" maxlength="12" class="form-control" required>
                        </div>
   </div>
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
                            <label>Qual das formas abaixo o sócio preferiu utilizar para fazer a doação?<font color="red">*</font></label> <br>
                            <? switch ($forma_ajudar) {
                                case 'Apoia.se':
                                    echo "  <input type='radio' name='forma' id='forma' value='Apoia.se' checked>Apoia.se <br>
                                            <input type='radio' name='forma' id='forma' value='Banco Itaú' >Banco Itaú <br>
                                            <input type='radio' name='forma' id='forma' value='Banco do Brasil'>Banco do Brasil <br>
                                            <input type='radio' name='forma' id='forma' value='Boleto'>Boleto bancário <br>
                                            <input type='radio' name='forma' id='forma' value='Pag Seguro'>Pagseguro <br>
                                            <input type='radio' name='forma' id='forma' value='PicPay'>PicPay <br>
                                            <input type='radio' name='forma' id='forma' value='Pix'>PIX <br>
                                            <input type='radio' name='forma' id='forma' value='Doação de itens'>Doação de itens (ração, areia, medicamentos, etc) <br>
                                            ";
                                    break;
                                case 'Banco Itaú':
                                    echo "  <input type='radio' name='forma' id='forma' value='Apoia.se' >Apoia.se <br>
                                            <input type='radio' name='forma' id='forma' value='Banco Itaú' checked>Banco Itaú <br>
                                            <input type='radio' name='forma' id='forma' value='Banco do Brasil'>Banco do Brasil <br>
                                            <input type='radio' name='forma' id='forma' value='Boleto'>Boleto bancário <br>
                                            <input type='radio' name='forma' id='forma' value='Pag Seguro'>Pagseguro <br>
                                            <input type='radio' name='forma' id='forma' value='PicPay'>PicPay <br>
                                            <input type='radio' name='forma' id='forma' value='Pix'>PIX <br>
                                            <input type='radio' name='forma' id='forma' value='Doação de itens'>Doação de itens (ração, areia, medicamentos, etc) <br>";
                                    break;
                                case 'Banco do Brasil':
                                    echo "  <input type='radio' name='forma' id='forma' value='Apoia.se' >Apoia.se <br>
                                            <input type='radio' name='forma' id='forma' value='Banco Itaú' >Banco Itaú <br>
                                            <input type='radio' name='forma' id='forma' value='Banco do Brasil' checked>Banco do Brasil <br>
                                            <input type='radio' name='forma' id='forma' value='Boleto'>Boleto bancário <br>
                                            <input type='radio' name='forma' id='forma' value='Pag Seguro'>Pagseguro <br>
                                            <input type='radio' name='forma' id='forma' value='PicPay'>PicPay <br>
                                            <input type='radio' name='forma' id='forma' value='Pix'>PIX <br>
                                            <input type='radio' name='forma' id='forma' value='Doação de itens'>Doação de itens (ração, areia, medicamentos, etc) <br>";
                                    break;
                                case 'Boleto':
                                    echo "  <input type='radio' name='forma' id='forma' value='Apoia.se' >Apoia.se <br>
                                            <input type='radio' name='forma' id='forma' value='Banco Itaú' >Banco Itaú <br>
                                            <input type='radio' name='forma' id='forma' value='Banco do Brasil' >Banco do Brasil <br>
                                            <input type='radio' name='forma' id='forma' value='Boleto' checked>Boleto bancário <br>
                                            <input type='radio' name='forma' id='forma' value='Pag Seguro'>Pagseguro <br>
                                            <input type='radio' name='forma' id='forma' value='PicPay'>PicPay <br>
                                            <input type='radio' name='forma' id='forma' value='Pix'>PIX <br>
                                            <input type='radio' name='forma' id='forma' value='Doação de itens'>Doação de itens (ração, areia, medicamentos, etc) <br>";
                                    break;
                                case 'Pag Seguro':
                                    echo "  <input type='radio' name='forma' id='forma' value='Apoia.se' >Apoia.se <br>
                                            <input type='radio' name='forma' id='forma' value='Banco Itaú' >Banco Itaú <br>
                                            <input type='radio' name='forma' id='forma' value='Banco do Brasil' >Banco do Brasil <br>
                                            <input type='radio' name='forma' id='forma' value='Boleto' >Boleto bancário <br>
                                            <input type='radio' name='forma' id='forma' value='Pag Seguro' checked>Pagseguro <br>
                                            <input type='radio' name='forma' id='forma' value='PicPay'>PicPay <br>
                                            <input type='radio' name='forma' id='forma' value='Pix'>PIX <br>
                                            <input type='radio' name='forma' id='forma' value='Doação de itens'>Doação de itens (ração, areia, medicamentos, etc) <br>";
                                    break;
                                case 'PicPay':
                                    echo "  <input type='radio' name='forma' id='forma' value='Apoia.se' >Apoia.se <br>
                                            <input type='radio' name='forma' id='forma' value='Banco Itaú' >Banco Itaú <br>
                                            <input type='radio' name='forma' id='forma' value='Banco do Brasil' >Banco do Brasil <br>
                                            <input type='radio' name='forma' id='forma' value='Boleto' >Boleto bancário <br>
                                            <input type='radio' name='forma' id='forma' value='Pag Seguro' >Pagseguro <br>
                                            <input type='radio' name='forma' id='forma' value='PicPay' checked>PicPay <br>
                                            <input type='radio' name='forma' id='forma' value='Pix'>PIX <br>
                                            <input type='radio' name='forma' id='forma' value='Doação de itens'>Doação de itens (ração, areia, medicamentos, etc) <br>";
                                    break;
                                case 'Pix':
                                    echo "  <input type='radio' name='forma' id='forma' value='Apoia.se' >Apoia.se <br>
                                            <input type='radio' name='forma' id='forma' value='Banco Itaú' >Banco Itaú <br>
                                            <input type='radio' name='forma' id='forma' value='Banco do Brasil' >Banco do Brasil <br>
                                            <input type='radio' name='forma' id='forma' value='Boleto' >Boleto bancário <br>
                                            <input type='radio' name='forma' id='forma' value='Pag Seguro' >Pagseguro <br>
                                            <input type='radio' name='forma' id='forma' value='PicPay' >PicPay <br>
                                            <input type='radio' name='forma' id='forma' value='Pix' checked>PIX <br>
                                            <input type='radio' name='forma' id='forma' value='Doação de itens'>Doação de itens (ração, areia, medicamentos, etc) <br>";
                                    break;
                                case 'Doação de itens':
                                    echo "  <input type='radio' name='forma' id='forma' value='Apoia.se' >Apoia.se <br>
                                            <input type='radio' name='forma' id='forma' value='Banco Itaú' >Banco Itaú <br>
                                            <input type='radio' name='forma' id='forma' value='Banco do Brasil' >Banco do Brasil <br>
                                            <input type='radio' name='forma' id='forma' value='Boleto' >Boleto bancário <br>
                                            <input type='radio' name='forma' id='forma' value='Pag Seguro' >Pagseguro <br>
                                            <input type='radio' name='forma' id='forma' value='PicPay' >PicPay <br>
                                            <input type='radio' name='forma' id='forma' value='Pix'>PIX <br>
                                            <input type='radio' name='forma' id='forma' value='Doação de itens' checked>Doação de itens (ração, areia, medicamentos, etc) <br>";
                                    break;
                                default:
                                    echo "  <input type='radio' name='forma' id='forma' value='Apoia.se' >Apoia.se <br>
                                            <input type='radio' name='forma' id='forma' value='Banco Itaú' >Banco Itaú <br>
                                            <input type='radio' name='forma' id='forma' value='Banco do Brasil' >Banco do Brasil <br>
                                            <input type='radio' name='forma' id='forma' value='Boleto' >Boleto bancário <br>
                                            <input type='radio' name='forma' id='forma' value='Pag Seguro' >Pagseguro <br>
                                            <input type='radio' name='forma' id='forma' value='PicPay' >PicPay <br>
                                            <input type='radio' name='forma' id='forma' value='Pix'>PIX <br>
                                            <input type='radio' name='forma' id='forma' value='Doação de itens'>Doação de itens (ração, areia, medicamentos, etc) <br>";
                                    break;
                                
                            }
                                
                            ?>
                </div>
    </div>
    <div class="form-row">
                <div class="form-group col-md-6">
                            <label>Frequência da doação<font color="red">*</font>: </label> <br>
                            <?
                                switch ($freq) {
                                    case 'Mensal':
                                        echo "<input type='radio' name='freq' id='forma' value='Mensal' checked>Mensal <br>
                                              <input type='radio' name='freq' id='freq' value='Esporádica'>Esporádica <br>";
                                        break;
                                    case 'Esporádica':
                                        echo "<input type='radio' name='freq' id='freq' value='Mensal'>Mensal <br>
                                              <input type='radio' name='freq' id='freq' value='Esporádica' checked>Esporádica <br>";
                                        break;
                                    default:
                                        echo "<input type='radio' name='freq' id='freq' value='Mensal'>Mensal <br>
                                              <input type='radio' name='freq' id='freq' value='Esporádica'>Esporádica <br>";
                                        break;
                                }
                            ?>
                </div>
    </div>
    <div class="form-row">
                <div class="form-group col-md-6">
                            <label>Qual melhor dia do mês pra doar?<font color="red">*</font> <br>
                            <select name="diadomesocio" id="diadomesocio" class="form-control">
                                <option value="<? echo $melhor_dia?>"><? echo $melhor_dia?></option>
                                <option value="0">--------</option>
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
                            <?
                                switch ($lembrete) {
                                    case 'Sim':
                                        echo "<input type='radio' name='lembrete' id='lembrete' value='Sim' checked>Sim <br>";
                                        echo "<input type='radio' name='lembrete' id='lembrete' value='Não'>Não <br>";
                                        break;
                                        
                                    case 'Não':
                                        echo "<input type='radio' name='lembrete' id='lembrete' value='Sim' >Sim <br>";
                                        echo "<input type='radio' name='lembrete' id='lembrete' value='Não' checked>Não <br>";
                                        break;
                                }
                            ?>
                </div>
    </div>
    <div class="form-row">
                  <div class="form-group col-md-6">
                    <?
            		 		$querynomepet = "SELECT NOME_ANIMAL FROM ANIMAL WHERE ID = '$id_animal'";
            				$selectnomepet = mysqli_query($connect,$querynomepet);
            				$rc = mysqli_fetch_row($selectnomepet);
			                $nomedoanimal = $rc[0];
                    ?>
                    <label>Animal apadrinhado: <a href="https://www.gaarcampinas.org/pet.php?id=<? echo $id_animal?>" target="_blank"><? echo $nomedoanimal?></a></label> <br> <input type="text" id="animal_atual" name="animal_atual" value="<? echo $id_animal?>" hidden>
                    <label>Novo animal a ser apadrinhado: </label> 
                    <select class="form-control" id="novoanimal" name="novoanimal" required>
                         		  <option selected value="0">Selecione</option>
                         		  <?
                        		 		$querypet = "SELECT ID, NOME_ANIMAL FROM ANIMAL WHERE (ADOTADO ='Disponivel' OR ADOTADO='Adotado (sem termo)' OR ADOTADO='Em adaptação' OR ADOTADO='Pré adotado') and DIVULGAR_COMO ='GAAR' ORDER BY NOME_ANIMAL,ESPECIE ASC";
                        				$selectpet = mysqli_query($connect,$querypet);
                        				
                        				while ($fetchpet = mysqli_fetch_row($selectpet)) {
                        					echo "<option value='".$fetchpet[0]."'>".$fetchpet[1]."</option>";
                        				}
                        		?>
                	</select>
                	<small id="passwordHelpBlock" class="form-text text-muted">A lista será apresentada como nome e espécie de forma ascendente. Ex: para dois nomes iguais, o primeiro nome será a espécie Canina e o segundo Felina</small>
                  </div>
    </div>
    <font color="red"><i>* Campos obrigatórios</i></font>
    <br>
    <center><a href="javascript:formsocio.submit()" class="btn btn-primary">Atualizar</a></center>
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
