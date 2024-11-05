<?php

include ("conexao.php"); 

ini_set('display_errors', 1);
            
error_reporting(E_ALL);

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$bodytext = "<p>Olá sócio, <br><br>
                     Identificamos que seu boleto não foi gerado porque há inconsistências no seu cadastro:<br><br>
                     - CPF inválido <br>
                     
                     <i>A Febraban, Federação Brasileira de Bancos, em atenção à determinação do Banco Central do Brasil – Circular n. 3.656/2013 – instituiu a obrigatoriedade do registro do CPF ou CNPJ do destinatário em todas as cobranças por boleto bancário</i>
                     
                     Para geração dos próximos boletos, por gentileza responda esse e-mail com o número. <br><br>
                     
                     Qualquer dúvida estamos à disposição. <br><br>
                     
                     Thaise Piculi<br>
                     Diretora Administrativa - GAAR Campinas <br><br>
             
                ";          

$subject = "[GAAR Financeiro] Cadastro inconsistente para boleto";

$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('financeiro@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
$mail->Subject   = $subject;
$mail->Body      = $bodytext;
$mail->IsHTML(true);
$to = 'contato@gaarcampinas.org';
$mail->AddAddress($to);

/*$query = "SELECT EMAIL FROM EMAIL_MARKETING WHERE RECEBER='SIM'";*/
$query = "SELECT EMAIL FROM SOCIO where FORMA_AJUDAR ='Boleto' and CPF='0'";
$select = mysqli_query($connect,$query);

while ($fetch = mysqli_fetch_row($select)) {
    $to =$fetch[0];
    $mail->addBCC($to);
}

/*$mail->addAttachment($file_to_attach, $arquivo);*/

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'E-mail enviado! ';
}

$mail->clearAddresses();

?>


