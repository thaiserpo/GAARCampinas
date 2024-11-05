<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$usuariovol = $_GET['usuario'];

$dias_inativo = date('Y-m-d', strtotime('-90 day'));

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

$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('contato@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
$mail->IsHTML(true);
$subject = "[GAAR Campinas] Acesso suspenso";
$mail->Subject   = $subject;

$queryselect = "SELECT NOME,AREA,USUARIO,EMAIL FROM VOLUNTARIOS WHERE ULTIMO_ACESSO <'$dias_inativo' AND STATUS_APROV='Aprovado' AND AREA <>'anuncios' AND AREA<>'clinica'";
$select = mysqli_query($connect,$queryselect);

echo "<br> query select: ".$queryselect;
    
while ($fetch = mysqli_fetch_row($select)) {
        $nomevol = $fetch[0];
        $area = $fetch[1];
        $usuario = $fetch[2];
        $email = $fetch[3];
        
        $bodytext = "Olá ".$nomevol."<br> Seu acesso ao site do GAAR foi suspenso devido à inatividade, com isso você não receberá mais informativos da ONG nem terá acesso às informações. Para maiores informações responda esse e-mail. <br><br><i> Esta notificação foi enviada automaticamente pelo sistema.</i>";
        $mail->Body      = $bodytext;
        
        $to = $email;
        $mail->AddAddress($to);

        $query = "UPDATE VOLUNTARIOS SET STATUS_APROV='Inativo' WHERE AREA <>'anuncios' AND AREA<>'clinica'";
        $update = mysqli_query($connect,$query);
        
        if (!$mail->send()) {
            $log_file_msg .="[deletavoluntarioauto.php] Erro de envio do e-mail:".$mail->ErrorInfo."\n";
        } else {
            $log_file_msg .="[deletavoluntarioauto.php] E-mail enviado para ".$to." às ".$horaatu."\n";
        }
        $mail->clearAddresses();
        
        echo $bodytext;
}
?>