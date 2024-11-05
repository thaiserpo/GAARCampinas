<?php

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');
require_once('/home1/gaarca06/public_html/area/fpdf/fpdf.php');
/*require("home1/gaarca06/public_html/PHPMailer/src/PHPMailer.php");
require("home1/gaarca06/public_html/PHPMailer/src/SMTP.php");*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$horaatu = date("H:i:s");
$data_atu = date("Y-m-d");
$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");

/*
// Create a new DateTime object
$dia_iniciopost = new DateTime();
$dia_fimpost = new DateTime();

// Modify the date it contains
$dia_iniciopost->modify('next monday');

// clone start date
$dia_fimpost = clone $dia_iniciopost;

// Add 7 days to start date
$dia_fimpost->modify('+6 days');
*/
$log_file = "/home/gaarca06/public_html/area/logs/log-".$data_atu.".txt";

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
$mail->SetFrom('castracao@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
$mail->IsHTML(true);
//$to = "contato@gaarcampinas.org";
//$mail->AddAddress($to);

$query = "SELECT * FROM PROTETORES WHERE SITUACAO='ATIVO' AND PROTETOR='SIM' ORDER BY NOME ASC";
$select = mysqli_query($connect,$query);
$reccount = mysqli_num_rows($select);

$subject = "[GAAR Campinas] Boletim informativo para protetores - ".$mes_atu."/".$ano_atu."";

$mail->Subject   = $subject;

while ($fetch = mysqli_fetch_row($select)) {

    $nomeprotetor = $fetch[1];
    $emailprotetor = $fetch[3];

    $bodytext ="<p>Olá ".$nomeprotetor.", <br> Segue o link do boletim informativo número 4 para protetores: <br> <br> http://gaarcampinas.org/docs/publico/boletim_informativo_no.4.pdf</p>";
    $mail->Body      = $bodytext;
    $mail->AddAddress($emailprotetor);
    //$mail->AddBCC("thaise.piculi@gmail.com");
    $lista_email .=", ".$emailprotetor;
    $mail->send();
    $mail->clearAddresses();
}

echo "<br> enviado para ".$lista_email;
mysqli_close($connect);
		
?>