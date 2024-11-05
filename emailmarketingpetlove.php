<?php

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$subject = "[GAAR & Petlove] Rações e petiscos com até 50% off";

$mensagem ="<center>
            <img src='https://www.petlove.com.br/images/whitelabel/campaign/images/22-03-racoes-e-petiscos-com-50-off.png'> <br><br>
            <p>
            
            Acesse nossa lojinha oficial em parceria com a @petlovebrasil<br>
            🌐 gaarcampinas.petlove.com.br<br><br>
            
            🔹 10% off para assinantes<br>
            💰 O GAAR recebe 10% do valor de sua compra em doação - com esse valor podemos dar assistência a mais de 70 animais que estão sob nossa responsabilidade e fornecer castração e ração para animais de famílias carentes em Campinas/SP <br>
            🚚 Entrega para todo o Brasil garantida pela Petlove <br><br>

            Aproveite e ajude nossa ONG :) <br>
            </p>
            </center>
        
        <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p></center><br><br>
        
        ";
        
        /*$deleta = "<p style='color:black;font-size:10px;'> Caso não queira mais receber nossos e-mails, <a href='http://gaarcampinas.org/area/unsubscribe.php?id='".$idmail."'>clique aqui</p>".
        
        $message .= $deleta;*/
    
$bodytext = $mensagem;

$email = new PHPMailer();
$email->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$email->msgHTML(file_get_contents('contents.html'), __DIR__);
$email->SetFrom('contato@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
$email->Subject   = $subject ;
$email->IsHTML(true);
$email->Body      = $bodytext;
$email->AddAddress('contato@gaarcampinas.org');

$query = "SELECT EMAIL FROM EMAIL_MARKETING WHERE RECEBER='SIM'";
$select = mysqli_query($connect,$query);

while ($fetch = mysqli_fetch_row($select)) {
		$email->AddBCC($fetch[0]);
}

//send the message, check for errors
if (!$email->send()) {
    echo 'Mailer Error: ' . $email->ErrorInfo;
} else {
    echo 'E-mail enviado! ';
}

?>
