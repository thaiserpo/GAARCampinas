<?php

include ("conexao.php"); 

ini_set('display_errors', 1);
            
error_reporting(E_ALL);

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$bodytext = "Olá voluntários!

            Em nome da Diretoria do GAAR, estamos lançando uma pesquisa para implementar reuniões periódicas com os voluntários de todas as áreas para ouvir sugestões, críticas, melhorias, definir planos de ações, etc. 
            
            Pedimos que por gentileza acesse a planilha pelo link https://docs.google.com/spreadsheets/d/1Lhh2SJSd7X9ABZ-yoTMdzROC_NP5A1SysazH-kEi6pM/edit?usp=sharing e preencha com os dados.
            
            Atenciosamente,
            Thaise Piculi ";          
    		      
                        
$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('contato@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
$mail->Subject   = 'Pesquisa para reunião dos voluntários';
$mail->Body      = $bodytext;
$mail->IsHTML(true);

$query = "SELECT EMAIL FROM VOLUNTARIOS WHERE STATUS_APROV ='Aprovado' and (AREA <> 'anúncios' AND AREA <> 'clinica') AND (EMAIL <>'0' AND EMAIL IS NOT NULL)";
$select = mysqli_query($connect,$query);

while ($fetch = mysqli_fetch_row($select)) {
    $to =$fetch[0];
    $mail->addBCC($to);
    echo "<br>E-mail: ".$to;
}


/*$nome_foto = "20200123_175808.jpg";

$file_to_attach = '/home1/gaarca06/private/docs/termos/'.$nome_foto;

$mail->addAttachment($file_to_attach, 'Termo digital');

$nome_fotoad = "20200202_124902.jpg";

$file_to_attach2 = '/home1/gaarca06/public_html/docs/adotantes/'.$nome_fotoad;

$mail->addAttachment($file_to_attach2, 'Foto adocao');*/

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'E-mail enviado! ';
}

?>
