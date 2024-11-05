<?php 

session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$subject = "[Admin] Remoção de padrinhos";

$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional

$queryapadrinha = "SELECT NOME_PADRINHO, CELULAR_PADRINHO, EMAIL_PADRINHO, VALOR_PADRINHO, FORMA_AJUDAR, ID_ANIMAL, FREQUENCIA, CPF_PADRINHO, ID_SOCIO, ID_PADRINHO FROM APADRINHAMENTO";

$selectapadrinha = mysqli_query($connect,$queryapadrinha);

while ($fetch = mysqli_fetch_row($selectapadrinha)) {
    $nomesocio = $fetch[0];
    $celularsocio = $fetch[1];
    $emailsocio = $fetch[2];
    $valorsocio = $fetch[3];
    $forma = $fetch[4];
    $idanimal = $fetch[5];
    $freq = $fetch[6];
    $cpfsocio = $fetch[7];
    $idsocio = $fetch[8];
    $idpadrinho = $fetch[9];
    $lembrete = 'Sim';
    $banco = '0';
    $agencia = '0';
    $conta = '0';
    $dv = '0';
    $banco = '0';
    $apadrinhar ='Sim';
    $obs='0';
    
    if ($cpfsocio =='') {
        $cpfsocio=0;
    }

    
    $querysocio = "INSERT INTO SOCIO 
            (NOME,
            CIDADE,
            TEL_CELULAR,
            EMAIL,
            VALOR,
            FORMA_AJUDAR,
            MELHOR_DIA,
            RECEBER_LEMBRETE,
            BANCO,
            AGENCIA,
            CONTA,
            DV,
            FREQ_DOACAO,
            CPF,
            APADRINHAMENTO,
            ID_ANIMAL,
            OBS) 
            VALUES 
            ('$nomesocio',
            '$cidadesocio',
            '$celularsocio',
            '$emailsocio',
            '$valorsocio',
            '$forma',
            '$diadomesocio',
            '$lembrete',
            '$banco',
            '$agencia',
            '$conta',
            '$dv',
            '$freq',
            '$cpfsocio',
            '$apadrinhar',
            '$idanimal',
            '$obs') ";
            
    /*$insertsocio = mysqli_query($connect,$querysocio); */
    
    $querypet ="SELECT ADOTADO, ID FROM ANIMAL WHERE ID ='$idanimal'";
    $selectpet = mysqli_query($connect,$querypet);
    $rc = mysqli_fetch_row($selectpet);
	$status_pet = $rc[0];
	
	if ($status_pet == "Adotado") {
	    $queryupdate = "UPDATE SOCIO SET APADRINHAMENTO='Não' WHERE ID_ANIMAL='$idanimal'";
	    $update = mysqli_query($connect,$queryupdate);
	    
	    $querydelete = "DELETE FROM SOCIO WHERE ID_ANIMAL='$idanimal'";
	    $delete = mysqli_query($connect,$querydelete);
	    
	    echo "<br> ID Padrinho ".$idpadrinho." deletado porque o animal ".$idanimal." foi adotado";
	}
    

    if(mysqli_errno($connect) <> '0'){
        echo "<br> Registro com erro: ".$emailsocio." - Mensagem de erro: ".mysqli_error($connect). " SQL Error: ".mysqli_errno($connect)."";
    }
}


        
?>