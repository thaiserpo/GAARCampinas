<?php 
session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');
require_once('/home1/gaarca06/public_html/area/fpdf/fpdf.php');
/*require("home1/gaarca06/public_html/PHPMailer/src/PHPMailer.php");
require("home1/gaarca06/public_html/PHPMailer/src/SMTP.php");*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$login = $_POST['usuario'];
$idevento = $_POST['idevento'];
$cargo = $_POST['cargo_vol'];

$data_atu = date("Y-m-d");
$mes_atu = date("m");
$ano_atu = date("Y"); 
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";
$fp = fopen($log_file, 'a');//opens file in write mode  

/* Pesquisa data do evento */
$querydtfeira = "SELECT DATA,NOME_EVENTO FROM EVENTOS WHERE ID='$idevento'";
$selectdtfeira = mysqli_query($connect,$querydtfeira);
$rc = mysqli_fetch_row($selectdtfeira);
$dtfeira = $rc[0];
$evento = $rc[1];

/*Voluntarios presentes */
$query = "INSERT INTO LISTA_DE_PRESENCA
            (NOME_VOLUNTARIO,
            DATA_FEIRA,
            ID_EVENTO,
            CARGO)
            VALUES 
            ('$login',
            '$dtfeira',
            '$idevento',
            '$cargo')";
            
$insert = mysqli_query($connect,$query); 

if(mysqli_errno($connect) == '0'){
     $queryarea = "SELECT EMAIL FROM VOLUNTARIOS WHERE NOME='$login'";
     $selectarea = mysqli_query($connect,$queryarea); 
     $rc = mysqli_fetch_row($selectarea);
     $emailvol = $rc[0];
     
     $ano_dtevento = substr($dtfeira,0,4);
     $mes_dtevento = substr($dtfeira,5,2);
     $dia_dtevento = substr($dtfeira,8,2);
    
     $mail = new PHPMailer();
     /*$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
     $mail->SMTPAuth = true; // authentication enabled
     $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail*/
     $mail->IsHTML(true);
     $mail->Debugoutput = 'html';
     $mail->CharSet = 'UTF-8';
     //Read an HTML message body from an external file, convert referenced images to embedded,
     //convert HTML into a basic plain-text alternative body
     //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
     $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
     $mail->IsHTML(true);
     $mail->AddAddress($emailvol);
     
     /* E-MAIL PARA O RESPONSÁVEL */
     $subject = "[GAAR Campinas] Presença na feira registrada";
     
     $bodytext = "<html>
                <p> Olá ".$login.", <br><br> Sua presença no evento ".$evento." dia ".$dia_dtevento."/".$mes_dtevento."/".$ano_dtevento." foi registrada no sistema.";
     
     $mail->Subject   = $subject;
     $mail->Body      = $bodytext;
     
     if (!$mail->send()) {
        $log_file_msg="[cadastrovol.php] Erro de envio de notificação de presença ao voluntário: Mailer Error: " . $mail->ErrorInfo." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);  
     } else {
        $log_file_msg="[cadastrovol.php] Envio de notificação de presença ao voluntário para ".$login." e-mail: ".$emailvol." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);  
     }
} else {
    $log_file_msg="[cadastrovol.php] Erro no cadastro de voluntários da feira. <p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p> às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);  
}

fclose($fp);
mysqli_close($connect);

?>          
