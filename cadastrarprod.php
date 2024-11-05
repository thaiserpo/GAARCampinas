<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$proddesc = $_POST['proddesc'];
$quantidade = $_POST['quantidade'];
$idevento = $_POST['idevento'];
$pgto = $_POST['pagamento'];

$query_dtfeira = "SELECT DATA,TIPO FROM EVENTOS WHERE ID='$idevento'";
$select = mysqli_query($connect,$query_dtfeira); 

while ($fetchevento = mysqli_fetch_row($selectevento)) {
    $dtfeira = $fetchevento[0];
    $tipoevento = $fetchevento[1];
}

$query_valorprod = "SELECT VALOR FROM CONTROLE_ESTOQUE WHERE DESCRICAO='$proddesc'";
$select_valorprod = mysqli_query($connect,$query_valorprod); 
$rc = mysqli_fetch_row($select_valorprod);
$valorprod = $rc[0];

$valor_total = floatval($valorprod) * $quantidade;

/*Voluntarios presentes */

$queryvendas = "INSERT INTO VENDAS_PRODUTOS
            (NOME,
            TELEFONE,
            EMAIL, 
            CPF,
            DT_ENTREGA,
            PRODUTO,
            QTDE,
            DT_VENDA,
            QTD_VENDIDA,
            USUARIO,
            STATUS_VENDA,
            MEIO_PGTO,
            VALOR_FRETE,
            COMPROVANTE,
            STATUS_POST,
            ID_EVENTO,
            LOCAL_VENDA)
            VALUES 
            ('$tipoevento',
            '0',
            '0',
            '0',
            '$dtfeira',
            '$proddesc',
            '$quantidade',
            '$dtfeira',
            '$quantidade',
            '$login',
            'Entregue',
            '$pgto',
            '$valor_total',
            '0',
            '0',
            '$idevento',
            '$tipoevento')";
$insert = mysqli_query($connect,$queryvendas); 

if(mysqli_errno($connect) == '0'){

    $queryqtde = "SELECT QTDE FROM CONTROLE_ESTOQUE WHERE PRODUTO='$proddesc'";
    $select = mysqli_query($connect,$queryqtde); 
    
    while ($fetchqtde = mysqli_fetch_row($select)) {
        $qtde_estoque = intval($fetchqtde[0]);
    }
    

     if(mysqli_errno($connect) == '0'){

        $qtde = intval($qtde_estoque) - intval($quantidade);

        $queryupdate = "UPDATE CONTROLE_ESTOQUE SET QTDE='$qtde' WHERE PRODUTO='$proddesc'";
        $update = mysqli_query($connect,$queryupdate); 
     }
}


?>