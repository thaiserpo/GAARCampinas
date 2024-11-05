<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{

$id = $_POST['id'];
$nome =$_POST['nome'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$dtvenda =$_POST['dtvenda'];
$idprodvenda = $_POST['prodvenda'];
$fundoestampa = $_POST['fundoestampa'];
$qtde = $_POST['qtde'];
$qtde_outro = $_POST['qtde_outro'];
$status = $_POST['status'];
$statuspost = $_POST['statuspost'];
$cpfcnpj = $_POST['cpfcnpj'];
$frete = $_POST['frete'];
$meiopgto = $_POST['meiopgto'];
$frete = $_POST['frete'];
$idfornec = $_POST['fornecedor'];
$localvenda = $_POST['localvenda'];
$pedidolojaintegrada = $_POST['pedidolojaintegrada'];
$endereco = $_POST['endereco'];
$notificacao = "Sim";

echo "<BR> ID PROD VENDA: ".$idprodvenda;

$queryprod = "SELECT * FROM CONTROLE_ESTOQUE WHERE ID = '$idprodvenda'";
$selectprod = mysqli_query($connect,$queryprod);

while ($fetchprod = mysqli_fetch_row($selectprod)) {
					$idprod = $fetchprod[0];
					$idfornec = $fetchprod[5];
                    $tipoprod = $fetchprod[1];
                    $estampaprod = $fetchprod[6];
                    $descprod = $fetchprod[7];
                    $volprod = $fetchprod[8];
                    $modeloprod = $fetchprod[9];
                    $corinterprod = $fetchprod[10];
}

if (strpos($tipoprod, 'Caneca') !== false) {
    $notificacao = "Não";
    $prodvenda = $tipoprod. " - ".$descprod." - ".$volprod." - modelo ".$modeloprod." - cor interna ".$corinterprod;
}

if (strpos($tipoprod, 'Vaso') !== false) {
    $notificacao = "Não";
    $prodvenda = $tipoprod. " - ".$descprod." - modelo ".$modeloprod." - cor do vaso ".$corinterprod;
}

$send_email = false;


if ($endereco ==''){
    $endereco = 0;
}

if ($email ==''){
    $email = 0;
}

if ($celular ==''){
    $celular = 0;
}

if ($qtde == '0') {
    $qtde = $qtde_outro;
}

        		switch($localvenda) {
        		    case 'Feira de adoção':
        		        $nome="Feira de adoção";
        		        $localvenda = "Feira de adoção";
        		        $dtentrega = $dtvenda;
        		        $frete=0;
                        break;
                    case 'Consignação':
                        $dtentrega = '2001-01-01';
                        $qtde = '0';
                        $frete=0;
                        break;
                    case 'Loja virtual':
                        $dtentrega = $dtvenda;
                        $idevento = $pedidolojaintegrada;
                        
                        $send_email = true;
                        
                        if ($nome == ''){
                            $nome = $status;   
                        }
                        
                        if ($status =='Loja virtual - confecção'){
                            $statuspost = "Enviado por Correio";
                            $frete = 0;
                        }
                        if ($status =='Postado'){
                            $statuspost = "Enviado por Correio";
                            $frete = 0;
                        }
                        if ($status =='Loja virtual - confecção e entrega'){
                            $statuspost = "Entregue pelo fornecedor";
                        }
                        break;
                        
                    case 'Ponto de venda':
                        $dtentrega = $dtvenda;
                        if ($nome == ''){
                            $nome = $status;   
                        }
                        $statuspost = $localvenda;
                        $nome = 'Ponto de venda';
                        $idevento = "PV".$dtvenda;
                        break;

                    default:
                        if ($statuspost =='Em mãos' || $statuspost =='Postado'){
                            $dtentrega = $dtvenda;
                            $frete = 0;
                        }
                        break;
                        
        		}
        		
        		$query = "INSERT INTO VENDAS_PRODUTOS
        					(NOME, 
        					TELEFONE,
        					EMAIL,
        					DT_ENTREGA,
        					PRODUTO,
                            QTDE,
                            DT_VENDA,
                            QTD_VENDIDA,
                            MEIO_PGTO,
                            VALOR_FRETE,
                            STATUS_POST,
                            STATUS_VENDA,
                            USUARIO,
                            ID_EVENTO,
                            LOCAL_VENDA,
                            ID_FORNEC,
                            ENDERECO,
                            NOTIFICACAO,
                            ID_PROD)
        					VALUES
                            ('$nome',
                            '$celular',
                            '$email',
                            '$dtentrega',
                            '$prodvenda',
                            '$qtde',
                            '$dtvenda',
                            '$qtde',
                            '$meiopgto',
                            '$frete',
                            '$statuspost',
                            '$status',
                            '$login',
                            '$idevento',
                            '$localvenda',
                            '$idfornec',
                            '$endereco',
                            '$notificacao',
                            '$idprod')";

                $insert = mysqli_query($connect,$query); 	
        		 
                if(mysqli_errno($connect) == '0'){
        		/*	echo "Insert code: ".$insert;
        			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
        		    $query = "SELECT QTDE FROM CONTROLE_ESTOQUE WHERE ID = '$idprodvenda'";
        		    $resultqtde = mysqli_query($connect,$query);
			        $rc = mysqli_fetch_row($resultqtde);
			        $qtde_estoque = $rc[0];
			        
			        $total = intval($qtde_estoque) - intval($qtde);
			        
			        $query = "UPDATE CONTROLE_ESTOQUE SET QTDE='$total' WHERE ID ='$idprodvenda'";
        		    $resultupdate = mysqli_query($connect,$query);
        		    

                   echo"<script language='javascript' type='text/javascript'>
                   alert('Venda cadastrada com sucesso!');
        		   window.location.href='formvendaprod.php'</script>";
        	    }else{ 
        			echo "Insert code: ".$insert;
        			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
        			echo "<a href='formvendaprod.php'>Voltar</a>";
                  /*echo"<script language='javascript' type='text/javascript'>
                  alert('Erro ao cadastrar');window.location
                  .href='termo.php'</script>";*/
                }
		}
?>
