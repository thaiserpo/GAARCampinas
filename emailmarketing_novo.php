<?php

include ("conexao.php"); 

ini_set('display_errors', 1);
            
error_reporting(E_ALL);

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$subject = file_get_contents("http://gaarcampinas.org/area/imagens/text-".$ano_atu."-".$mes_atu."-".$dia_atu.".txt");

$bodytext = "<center><img src='http://gaarcampinas.org/area/imagens/image-".$ano_atu."-".$mes_atu."-".$dia_atu.".png' valign='top' align='center' width='50%' height='50%'/> <br></center>";  

//$subject = "[GAAR Campinas] teste de texto";

$path = "/home/gaarca06/public_html/area/imagens/*".$ano_atu."-".$mes_atu."-".$dia_atu.".png";

$filenames = glob($path);

$count = 0;

foreach ($filenames as $filename) {
    $count = $count + 1;
}

echo "count: ".$count;

if ($count == 1) {

    $mail = new PHPMailer();
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->CharSet = 'UTF-8';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
    $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
    $mail->Subject   = $subject;
    $mail->Body      = $bodytext;
    $mail->IsHTML(true);
    $to = 'contato@gaarcampinas.org';
    $mail->AddAddress($to);
    $log_file_msg = "";
    $listamail = "";
    
    $query = "SELECT EMAIL FROM EMAIL_MARKETING WHERE RECEBER='SIM' AND ENVIADO='NÃO' LIMIT 400";
    //$query = "SELECT EMAIL FROM EMAIL_MARKETING WHERE EMAIL='thaise.piculi@gmail.com'";
    $select = mysqli_query($connect,$query);
    
    while ($fetch = mysqli_fetch_row($select)) {
        $bcc_mail = $fetch[0];
        $listamail .= $bcc_mail.", ";
        $mail->AddCustomHeader("BCC: ".$bcc_mail.""); 
        $queryupdatestatus = "UPDATE EMAIL_MARKETING SET ENVIADO ='SIM' WHERE EMAIL='$fetch[0]'";
        $updatestatus = mysqli_query($connect,$queryupdatestatus);
    }

    if (!$mail->send()) {
            $log_file_msg .="[emailmarketing_novo.php] Erro de envio do e-mail marketing:".$mail->ErrorInfo."\n";
    } else {
            $log_file_msg .="[emailmarketing_novo.php] E-mail marketing enviado para ".$listamail." às ".$horaatu."\n";
    }
    
    $mail->clearAddresses();

    //$mail->addAttachment($file_to_attach, $arquivo);
    
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);  
    fclose($fp);

} else {
    $log_file_msg="[emailmarketing_novo.php] Nenhum e-mail marketing enviado às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);  
    fclose($fp); 
}
mysqli_close($connect);

?>

<html lang="pt-br">
  <head>
    <!--- GOOGLE ADSENSE --->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
    <!--- GOOGLE ADSENSE --->
</head>
</html>
