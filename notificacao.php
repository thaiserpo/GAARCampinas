<?php

include ("conexao.php"); 

ini_set('display_errors', 1);
            
error_reporting(E_ALL);

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$idpet = $_GET['idanimal'];
$parm = $_GET['parm'];

$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");
$log_file = "/home/gaarca06/public_html/area/logs/log-".$data_atu.".txt";

$querypet = "SELECT * FROM ANIMAL WHERE ID = '$idpet'";
$selectpet = mysqli_query($connect,$querypet); 	

while ($fetchpet = mysqli_fetch_row($selectpet)) { 
    
    $id = $fetchpet[0];
    $nome_animal = $fetchpet[1];
    $especie = $fetchpet[2];
    $dtvacinacao = $fetchpet[30];
    $dtvacinacao_r = $fetchpet[43];
    $status = $fetchpet[10];
    $lt = $fetchpet[11];
    $resp = $fetchpet[12];
    
    $querypet = "SELECT EMAIL,NOME FROM VOLUNTARIOS WHERE NOME = '$resp'";
    $selectpet = mysqli_query($connect,$querypet); 
    $rc = mysqli_fetch_row($selectpet);
	$email_resp = $rc[0];
	$nome_resp = $rc[1];
	
	switch ($parm) {
	    case 'poli':
	        $queryinsert = "INSERT INTO NOTIFICACAO 
	                (
	                ID_ANIMAL,
	                NOME_RESP,
	                EMAIL_RESP,
	                NOTIFICA_VACINA_POLI,
	                DT_NOTIFICA_VACINA_POLI,
	                NOTIFICA_CASTRA,
	                DT_NOTIFICA_CASTRA,
	                NOTIFICA_FIVFELV,
	                DT_NOTIFICA_FIVFELV)
	                VALUES (
	                '$id',
	                '$nome_resp',
	                '$email_resp',
	                'SIM',
	                '$data_atu',
	                '0',
	                '0',
	                '0',
	                '0')";
	        echo "<br> query: ".$queryinsert;
	        $queryupdate = "UPDATE NOTIFICACAO SET NOTIFICA_VACINA_POLI='SIM', DT_NOTIFICA_VACINA_POLI='$data_atu' WHERE ID_ANIMAL='$id' AND NOME_RESP='$nome_resp'";
	        
	        $subject = "[Operacional] Cadastro inconsistente para ".$nome_animal.": Vacinas";
	        
	        $bodytext = "<p>Olá ".$resp.", <br><br>
    
                     Identificamos que o animal ".$nome_animal." está sem vacina cadastrada ou está desatualizada no sistema. <br><br>
                     
                     Por gentileza, acesse o cadastro dele no site e atualize o mais breve possível ou responda esse e-mail com a data das vacina para que algum voluntário possa atualizar. <br><br>
                     
                     Equipe GAAR<br><br>
                     <i>Este é um e-mail automático enviado através do nosso sistema</i>
             
                ";    
	        break;
	    case 'castra':
	        $queryinsert = "INSERT INTO NOTIFICACAO (
	                ID_ANIMAL,
	                NOME_RESP,
	                EMAIL_RESP,
	                NOTIFICA_VACINA_POLI,
	                DT_NOTIFICA_VACINA_POLI,
	                NOTIFICA_CASTRA,
	                DT_NOTIFICA_CASTRA,
	                NOTIFICA_FIVFELV,
	                DT_NOTIFICA_FIVFELV)
	                VALUES (
	                '$id',
	                '$nome_resp',
	                '$email_resp',
	                '0',
	                '0',
	                'SIM',
	                '$data_atu',
	                '0',
	                '0')"; 
            echo "<br> query: ".$queryinsert;	 
            $queryupdate = "UPDATE NOTIFICACAO SET NOTIFICA_CASTRA='SIM', DT_NOTIFICA_CASTRA='$data_atu' WHERE ID_ANIMAL='$id' AND NOME_RESP='$nome_resp'";
	        break;
	    case 'fivfelv':
	        $queryinsert = "INSERT INTO NOTIFICACAO (
	                ID_ANIMAL,
	                NOME_RESP,
	                EMAIL_RESP,
	                NOTIFICA_VACINA_POLI,
	                DT_NOTIFICA_VACINA_POLI,
	                NOTIFICA_CASTRA,
	                DT_NOTIFICA_CASTRA,
	                NOTIFICA_FIVFELV,
	                DT_NOTIFICA_FIVFELV)
	                VALUES (
	                '$id',
	                '$nome_resp',
	                '$email_resp',
	                '0',
	                '0',
	                '0',
	                '0',
	                'SIM',
	                '$data_atu')"; 
	        echo "<br> query: ".$queryinsert;
	        $queryupdate = "UPDATE NOTIFICACAO SET NOTIFICA_FIVFELV='SIM', DT_NOTIFICA_FIVFELV='$data_atu' WHERE ID_ANIMAL='$id' AND NOME_RESP='$nome_resp'";
	       
	        $subject = "[Operacional] Cadastro inconsistente para ".$nome_animal.": Teste FIV/FELV";
	        
	        $bodytext = "<p>Olá ".$resp.", <br><br>
    
                     Identificamos que o animal ".$nome_animal." está sem data e/ou resultado de teste FIV/FELV no sistema. <br><br>
                     
                     Por gentileza, acesse o cadastro dele no site e atualize o mais breve possível ou responda esse e-mail com a data do teste e/ou resultado para que algum voluntário possa atualizar. <br><br>
                     
                     Equipe GAAR<br><br>
                     <i>Este é um e-mail automático enviado através do nosso sistema</i>
             
                ";    
	        break;
	}
	
	$insert = mysqli_query($connect,$queryinsert); 
	
	switch (mysqli_errno($connect)) {
	    case '1062': /* DUPLICATED ENTRY */
	        $update = mysqli_query($connect,$queryupdate); 
	        echo "<br> query update: ".$queryupdate;
	        break;
	}
    
    $mail = new PHPMailer();
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->CharSet = 'UTF-8';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
    $mail->SetFrom('contato@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
    $mail->Subject   = $subject;
    $mail->Body      = $bodytext;
    $mail->IsHTML(true);
    $to = $email_resp;
    $mail->AddAddress($to);
    $mail->addBCC('thaise.piculi@gmail.com');
    
    /*$mail->addAttachment($file_to_attach, $arquivo); */
    
    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo"<script language='javascript' type='text/javascript'>
              alert('E-mail enviado!');window.close();</script>";
    }
    
    $mail->clearAddresses();

}

$log_file_msg="[notificacao.php] Notificação de vacina polivalente vencida e/ou teste de fiv/felv enviado às ".$horaatu."\n";
$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  
fclose($fp); 

mysqli_close($connect);

?>


