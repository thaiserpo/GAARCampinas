<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

// INSERIR AGENDAMENTOS NA TABELA DE PROCEDIMENTOS MANUALMENTE

$queryselect = "SELECT * FROM AGENDAMENTO";
$select = mysqli_query($connect,$queryselect); 
$reccount = mysqli_num_rows($select);

$countinseridos =0;
$countnaoinseridos =0;

while ($fetchselect = mysqli_fetch_row($select)) {
    $codigoautoriza = $fetchselect[0];	
    $dtcirurgia = $fetchselect[1];	
    $nomedoanimal = $fetchselect[3];	
    $especie = $fetchselect[4];
    $sexo = $fetchselect[5];	
    $porte = $fetchselect[6];
    $nomedotutor = $fetchselect[9];	
    $teldotutor = $fetchselect[11];
    $emaildotutor = $fetchselect[12];
    $requigaar = $fetchselect[10];	 
    $aprovagaar = $fetchselect[10];
    $tipoproc = $fetchselect[20];
    $valor = $fetchselect[14];
    $valortutor = $fetchselect[13];
    $clinica = $fetchselect[19];
    $id_gaar = $fetchselect[23];
    
    $queryvet = "SELECT CLINICA FROM CLINICAS WHERE ID='$clinica'";
    $selectvet = mysqli_query($connect,$queryvet);
	$rc = mysqli_fetch_row($selectvet);
	$nomeclinica = $rc[0];
	
	$obs = $fetchselect[17];
	$statusproc = $fetchselect[17]; 
	$qtde = "1";
	
    
    $query = "INSERT INTO PROCEDIMENTOS
    					(DATA,
    					NOME_ANIMAL,
    					ESPECIE, 
    					SEXO, 
    					PORTE,
    	                NOME_TUTOR,
    	                TEL_TUTOR,
    	                REQUISITOR_GAAR,
    					APROVADOR_GAAR,
    					TIPO_PROC, 
    					VALOR, 
    					VALOR_TUTOR,
    					CLINICA, 
    					OBS,
    					STATUS_PROC,
    					EMAIL_TUTOR,
    					QTDE,
    					DESCONTO,
    					LOGIN,
    					CODIGO,
    					DTNASC_ANIMAL,
    					ID_GAAR) 
    					VALUES
                ('$dtcirurgia',
                '$nomedoanimal',
                '$especie',
                '$sexo',
                '$porte',
                '$nomedotutor',
                '$teldotutor',
                '$requigaar',
                '$aprovagaar',
                '$tipoproc',
                '$valor',
                '$valortutor',
                '$nomeclinica',
                '$obs',
                'Aprovado',
                '$emaildotutor',
                '$qtde',
                '0',
                '$login',
                '$codigoautoriza',
                '$dtnascanimal',
                '$id_gaar')";
    						
    $insert = mysqli_query($connect,$query); 

    if(mysqli_errno($connect) == '0'){
        $queryupdate = "UPDATE AGENDAMENTO SET REALIZADO='SIM' WHERE CODIGO='$codigoautoriza'";
        $update = mysqli_query($connect,$queryupdate);
        if(mysqli_errno($connect) == '0'){
            echo "<br>Código inserido e atualizado como realizado: ".$codigoautoriza;
            echo "<br> ------------------------------------------------------";
            $countinseridos = intval($countinseridos) + 1;
        }
    } else {
        //echo "Insert code: ".$insert;
        //echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
        echo "<br>Código não inserido: ".$codigoautoriza;
        echo "<br> ------------------------------------------------------";
        $countnaoinseridos = intval($countnaoinseridos) + 1;
    }
}
echo "<br> Procedimentos inseridos    : ".$countinseridos;
echo "<br> Procedimentos não inseridos: ".$countnaoinseridos;
?>

