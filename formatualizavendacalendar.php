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
		
		$query = "SELECT * FROM VENDAS_CALENDARIO WHERE ID = '$idvenda'";
		$select = mysqli_query($connect,$query);
		$fetch = mysqli_fetch_row($select);	
		
		$idvenda = $fetch[0];
		$nome = $_POST['nome'];
        $cpfcnpj = $_POST['cpfcnpj'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $cep = $_POST['cep'];
        $celular = $_POST['celular'];
        $email = $_POST['email'];
        $qtdemesa = $_POST['qtdemesa'];
        $qtdeparede = $_POST['qtdeparede'];
		$subtotal = $_POST['subtotal'];
        $frete = $_POST['frete'];
		$total = $_POST['total'];
        $idloja2 = $_POST['idloja2'];
        $meiopag = $_POST['meiopag'];
        $codcorreio = $_POST['codcorreio'];
        $status_post = $_POST['status_post'];
        $obs = $_POST['obs'];
		
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
    <meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="style-area.css" />
	<title>GAAR - Formulário de vendas dos calendários </title>
	<script type="text/javascript">
	
	</script>
</head>
<body class="texto">
<header>
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
</header>
<div class="div-responsive">
<br>
<form name="formatualizavendacalendar.php" method="post" action="atualizavendacalendar.php">
    <center>ID do pedido: <input class="box" type="text" id="idvenda" name="idvenda" value="<? echo $idvenda?>" readonly></center>
  <table width="610" border="0">
    <tr>
      <th align="center" valign="middle" class="relatorio-table-tr-header-1">DADOS DO CLIENTE</th>
      <td width="41">&nbsp;</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>Nome:</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>
        <input class="box" name="nome" type="text" id="nome" size="80" maxlength="80" value="<? echo $nome ?>"></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>CPF/CNPJ:</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td><input class="box" name="cpfcnpj" type="text" id="cpfcnpj" size="30" maxlength="30" value="<? echo $cpfcnpj ?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Endereço:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input class="box" name="endereco" type="text" id="endereco" size="80" maxlength="100" value="<? echo $endereco ?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Bairro: </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input class="box" name="bairro" type="text" id="bairro" size="50" maxlength="50" value="<? echo $bairro ?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Cidade: </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input class="box" name="cidade" type="text" id="cidade" size="50" maxlength="50" value="<? echo $cidade ?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Estado: </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input class="box" name="uf" type="text" id="uf" size="30" maxlength="30" value="<? echo $estado ?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>CEP: </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input class="box" name="cep" type="text" id="cep" size="20" maxlength="20" value="<? echo $cep ?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>DDD + Celular (só números):</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td><input class="box" name="celular" type="text" id="celular" size="30" maxlength="20" value="<? echo $celular ?>"></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>E-mail:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input class="box" name="email" type="email" id="email" size="80" maxlength="100" value="<? echo $email ?>"></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="center" valign="middle" class="relatorio-table-tr-header-1">DADOS DO PEDIDO</th>
      <td width="41">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>Quantidade de calendários de mesa:</td>
      <td width="41">&nbsp;</td>
    </tr>
      <td align="left"><input class="box" name="qtdemesa" type="text" id="qtdemesa" size="10" maxlength="11" value="<? echo $qtdemesa ?>"></td>
      <td width="41">&nbsp;</td>
    </tr>
    <tr>
      <td>Quantidade de calendários de parede:</td>
      <td width="41">&nbsp;</td>
    </tr>
    <tr>
      <td><input class="box" name="qtdeparede" type="text" id="qtdeparede" size="10" maxlength="11" value="<? echo $qtdeparede ?>"></td>
      <td width="41">&nbsp;</td>
    </tr>
    <tr>
      <td>Subtotal:</td>
      <td width="41"><input class="box" name="qtdeparede" type="text" id="qtdeparede" size="10" maxlength="11" value="<? echo $subtotal ?>" readonly></td>
    </tr>
    <tr>
      <td>Frete: </td>
      <td width="41"><input class="box" name="qtdeparede" type="text" id="qtdeparede" size="10" maxlength="11" value="<? echo $frete ?>"></td>
    </tr>
    <tr>
      <td>Total:</td>
      <td width="41"><input class="box" name="qtdeparede" type="text" id="qtdeparede" size="10" maxlength="11" value="<? echo $total ?>" readonly></td>
    </tr>
    <tr>
      <td>Meio de pagamento:</td>
      <td width="41">&nbsp;</td>
    <tr>
      <td>
          <?php
            if ($fetch[16] == 'Pagseguro Crédito') {
                echo "<input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito' checked>Pagseguro Crédito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito'>Pagseguro Débito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Dinheiro'>Dinheiro &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito online'>Pagseguro Crédito online&nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito online'>Pagseguro Débito online &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Boleto online'>Boleto bancário &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='DOC ou TED'>DOC ou TED &nbsp;";
            }
            if ($fetch[16] == 'Pagseguro Débito') {
                echo "<input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito'>Pagseguro Crédito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito' checked>Pagseguro Débito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Dinheiro'>Dinheiro &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito online'>Pagseguro Crédito online&nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito online'>Pagseguro Débito online &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Boleto online'>Boleto bancário &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='DOC ou TED'>DOC ou TED &nbsp;";
            }
            if ($fetch[16] == 'Dinheiro') {
                echo "<input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito'>Pagseguro Crédito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito'>Pagseguro Débito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Dinheiro' checked>Dinheiro &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito online'>Pagseguro Crédito online&nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito online'>Pagseguro Débito online &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Boleto online'>Boleto bancário &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='DOC ou TED'>DOC ou TED &nbsp;";
            }
            if ($fetch[16] == 'Pagseguro Crédito online') {
                echo "<input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito'>Pagseguro Crédito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito'>Pagseguro Débito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Dinheiro'>Dinheiro &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito online' checked>Pagseguro Crédito online&nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito online'>Pagseguro Débito online &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Boleto online'>Boleto bancário &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='DOC ou TED'>DOC ou TED &nbsp;";
            }
            if ($fetch[16] == 'Pagseguro Débito online') {
                echo "<input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito'>Pagseguro Crédito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito'>Pagseguro Débito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Dinheiro'>Dinheiro &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito online'>Pagseguro Crédito online&nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito online' checked>Pagseguro Débito online &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Boleto online'>Boleto bancário &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='DOC ou TED'>DOC ou TED &nbsp;";
					  
            }
            if ($fetch[16] == 'Boleto online') {
                echo "<input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito'>Pagseguro Crédito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito'>Pagseguro Débito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Dinheiro'>Dinheiro &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito online'>Pagseguro Crédito online&nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito online'>Pagseguro Débito online &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Boleto online' checked>Boleto bancário &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='DOC ou TED'>DOC ou TED &nbsp;";
            }
            if ($fetch[16] == 'DOC ou TED') {
                echo "<input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito'>Pagseguro Crédito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito'>Pagseguro Débito &nbsp;
                      <input class='box' type ='radio' name='meiopag' id='meiopag' value='Dinheiro'>Dinheiro &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Crédito online'>Pagseguro Crédito online&nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Pagseguro Débito online'>Pagseguro Débito online &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='Boleto online'>Boleto bancário &nbsp;
					  <input class='box' type ='radio' name='meiopag' id='meiopag' value='DOC ou TED'  checked>DOC ou TED &nbsp;";
            }
        
          ?>
      </td>
      <td width="41">&nbsp;</td>
    </tr>
    <tr>
      <td>ID do Pedido na Loja2:</td>
      <td width="41">&nbsp;</td>
    </tr>
    <tr>
      <td><input class="box" name="idloja2" type="text" id="idloja2" size="15" maxlength="15" value="<? echo $idloja2 ?>"></td>
      <td width="41">&nbsp;</td>
    </tr>
    <tr>
      <td>Código de rastreio (Correios):</td>
      <td width="41">&nbsp;</td>
    </tr>
    <tr>
      <td><input class="box" name="codcorreio" type="text" id="codcorreio" size="30" maxlength="30" value="<? echo $codcorreio ?>"></td>
      <td width="41">&nbsp;</td>
    </tr>
  <tr>
    <td align="left">Comprovante de postagem ou DOC/TED: </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left">
        <input class="box" name="foto" type="file" id="foto" size="50" maxlength="100"></td>
  </tr>
  <tr>
    <td align="left">Status da postagem: </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left">
        <?php
            if ($fetch[20] == 'Postado'){
                echo "<input class="box" type='radio' id='status' name='status' value='Postado' checked>Postado  <br>
                        <input class="box" type='radio' id='status' name='status' value='Não postado'>Não postado  <br>
                        <input class="box" type='radio' id='status' name='status' value='Em mãos'>Em mãos ";
            }
            if ($fetch[20] == 'Não postado'){
                echo "	<input class="box" type='radio' id='status' name='status' value='Postado'>Postado  <br>
                        <input class="box" type='radio' id='status' name='status' value='Não postado' checked>Não postado  <br>
                        <input class="box" type='radio' id='status' name='status' value='Em mãos'>Em mãos ";
            }
            if ($fetch[20] == 'Em mãos'){
                echo "	<input class="box" type='radio' id='status' name='status' value='Postado'>Postado  <br>
                        <input class="box" type='radio' id='status' name='status' value='Não postado'>Não postado  <br>
                        <input class="box" type='radio' id='status' name='status' value='Em mãos' checked>Em mãos ";
            }
        ?>
    </td>
  </tr>
  <tr>
      <td>Observações:</td>
      <td width="41">&nbsp;</td>
    </tr>
    <tr>
      <td><textarea name="obs" cols="70" rows="10" id="obs" value="<? echo $obs ?>"></textarea></td>
      <td width="41">&nbsp;</td>
    </tr>
  <tr>
    <td align="center">
        <input type="submit" name="enviar" id="enviar" value="Enviar">
    </td>
  </tr>
    </table>
</form>
</div>
<br>
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