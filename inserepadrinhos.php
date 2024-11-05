<?php 
session_start();

include ("conexao.php"); 

$queryselect = "SELECT * FROM SOCIO WHERE APADRINHAMENTO <>'NÃO'";
$select = mysqli_query($connect,$queryselect); 
$reccountsocio = mysqli_num_rows($select);

echo "<br> reccount socio: ".$reccountsocio;

while ($fetchselect = mysqli_fetch_row($select)) {
    $idpad = $fetchselect[0];	
    $nomepad = $fetchselect[1];	
    $emailpad = $fetchselect[3];	
    $celularpad = $fetchselect[4];
    $valor = $fetchselect[5];	
    $forma_ajuda = $fetchselect[6];
    $idanimal = $fetchselect[16];	
    $frequencia = $fetchselect[13];	 
    
    $queryresp = "SELECT RESPONSAVEL FROM ANIMAL WHERE ID = '$idanimal'";
    $selectresp = mysqli_query($connect,$queryresp);
    $reccountresp = mysqli_num_rows($selectresp);
    
    /*echo "<br> reccount responsavel: ".$reccountresp;*/
        				
    while ($fetchresp = mysqli_fetch_row($selectresp)) {
    	 $resp = $fetchresp[0];
    }
    
    $queryarea = "SELECT EMAIL,CELULAR FROM VOLUNTARIOS WHERE NOME ='$resp'";
	$selectarea = mysqli_query($connect,$queryarea);
		
	while ($fetcharea = mysqli_fetch_row($selectarea)) {
			$emailresp = $fetcharea[0];
			$celularresp = $fetcharea[2];
	}
    
    
    $queryinsert = "INSERT INTO APADRINHAMENTO 
                    (NOME_PADRINHO,
                    CELULAR_PADRINHO,
                    EMAIL_PADRINHO,
                    VALOR_PADRINHO,
                    FORMA_AJUDAR,
                    ID_ANIMAL,
                    NOME_RESP,
                    EMAIL_RESP,
                    CELULAR_RESP,
                    FREQUENCIA,
                    ATIVO,
                    ID_SOCIO)
                    VALUES (
                    '$nomepad',
                    '$celularpad',
                    '$emailpad',
                    '$valor',
                    '$forma_ajuda',
                    '$idanimal',
                    '$resp',
                    '$emailresp',
                    '$celularresp',
                    '$frequencia',
                    'Sim',
                    '$idpad')
                    ";
    
    $insert = mysqli_query($connect,$queryinsert); 

    if(mysqli_errno($connect) == '0'){
        echo "<br>ID sócio inserido: ".$idpad;
    } else {
        echo "Insert code: ".$insert;
        echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
        echo "<br> ID Padrinho: ".$idpad;
    }
}
?>

