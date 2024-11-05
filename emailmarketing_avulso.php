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

$subject = "[GAAR Campinas] Proteja seu animal da leishmaniose";

$bodytext = "<center>Olá adotante, <br> Gostaríamos de compartilhar essa notícia muito importante sobre leishmaniose na região de Valinhos/SP: <br>https://jornaldevalinhos.com.br/doenca-canina-avanca-em-valinhos-e-soma-13-casos-e-65-notificacoes/ <br><br> Há algumas maneiras de proteger seu animal contra a leishmaniose, entre elas é uma coleira repelente (algumas boas marcas são Seresto, Scalibor e Leevre). A leishmaniose é uma doença transmitida por mosquitos infectados com o parasita Leishmania. Infelizmente não tem cura mas a boa notícia é que hoje essa doença tem tratamento. <br><br>Quem ama cuida, proteja seu pet. <br><br> Equipe GAAR. </center>";  

//$subject = "[GAAR Campinas] teste de texto";

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
$to = 'thaise.piculi@gmail.com';
$mail->AddAddress($to);
$log_file_msg = "";
$listamail = "";

$query = "SELECT EMAIL FROM FORM_TERMO WHERE CIDADE='VALINHOS'";
//$query = "SELECT EMAIL FROM EMAIL_MARKETING WHERE EMAIL='thaise.piculi@gmail.com'";
$select = mysqli_query($connect,$query);
    
   while ($fetch = mysqli_fetch_row($select)) {
        $bcc_mail = $fetch[0];
        $listamail .= $bcc_mail.", ";
        $mail->AddBCC($bcc_mail);
    }

    if (!$mail->send()) {
            $log_file_msg .="[emailmarketing_avulso.php] Erro de envio do e-mail marketing avulso:".$mail->ErrorInfo."\n";
    } else {
            $log_file_msg .="[emailmarketing_avulso.php] E-mail marketing avulso enviado para ".$listamail." às ".$horaatu."\n";
    }
    
    $mail->clearAddresses();

    //$mail->addAttachment($file_to_attach, $arquivo);
    
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);  
    fclose($fp);

/*else {
    $log_file_msg="[emailmarketing_avulso.php] Nenhum e-mail marketing enviado às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);  
    fclose($fp); 
}*/
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
