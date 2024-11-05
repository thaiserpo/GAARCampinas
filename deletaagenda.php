<?php 
session_start();

include ("conexao.php"); 

$idagenda = $_GET['id'];
//$codagenda = $_GET['cod'];

//echo "<br> cod: ".$codagenda;

if ($idagenda <> ""){
    //$queryselect = "SELECT * FROM AGENDAMENTO WHERE CODIGO = '$codagenda'";
    $queryselect = "SELECT * FROM AGENDAMENTO WHERE ID = '$idagenda'";
} 

$select = mysqli_query($connect,$queryselect);
$reccount = mysqli_num_rows($select);

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$login = $_SESSION['login'];

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode

$log_file_msg = "";
$listamail = "";

while ($fetch = mysqli_fetch_row($select)) {
    $codigo = $fetch[0];
    $data_ag = $fetch[1];
    $nomedoanimal = $fetch[3];
    $especie = $fetch[4];
    $sexo = $fetch[5];
    $porte = $fetch[6];
    $peso = $fetch[7];
    $dt_nasc = $fetch[8];
    $resp = $fetch[9];
    $emailtutor = $fetch[12];
    $idvet = $fetch[17];
    
    $ano_multi = substr($data_ag,0,4);
	$mes_multi = substr($data_ag,5,2);
	$dia_multi = substr($data_ag,8,2);
    
    $queryvet = "SELECT * FROM CLINICAS WHERE ID='$idvet'";
	$selectvet = mysqli_query($connect,$queryvet);
	
	while ($fetchvet = mysqli_fetch_row($selectvet)) {
		$emailvet = $fetchvet[9];
	}
	
	$queryupdate = "UPDATE AGENDAMENTO SET ATIVO='CANCELADO' WHERE ID = '$idagenda'";
	//$queryupdate = "DELETE FROM AGENDAMENTO WHERE CODIGO='$codigo'";
    $update = mysqli_query($connect,$queryupdate);
    
    
    if(mysqli_errno($connect) == '0'){
                    
        $log_file_msg="[deletaagenda.php] Agendamento código ".$codigo." foi cancelado às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg); 
        
        $subject = "[GAAR Campinas] Agendamento código ".$codigo." foi cancelado";
        
        $bodytext = "Agendamento código ".$codigo." foi cancelado às ".$horaatu."\n";
        
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$email->msgHTML(file_get_contents('contents.html'), __DIR__);
        $mail->SetFrom('castracao@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
        $mail->Subject   = $subject;
        $mail->Body      = $bodytext;
        $mail->IsHTML(true);
        $to = $emailvet;
        $mail->AddAddress($to);
        $mail->AddBCC("castracao@gaarcampinas.org");
        
        //send the message, check for errors
        if (!$mail->send()) {
            $log_file_msg .="[deletaagenda.php] Erro no envio de notificacao ao veterinário ".$to.": ".$mail->ErrorInfo." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
        } else {
            $mail->clearAddresses();
        }
                 
        $queryupdate2 = "UPDATE PEDIDO_CASTRACAO SET STATUS_PEDIDO='CANCELADO' WHERE CODIGO='$codigo'";
        //$queryupdate2 = "DELETE FROM PEDIDO_CASTRACAO WHERE NOME_ANIMAL='".$nomedoanimal."' AND ESPECIE='".$especie."' AND SEXO='".$sexo."' AND PORTE='".$porte."' AND PESO='".$peso."' AND DT_NASC='".$dt_nasc."' AND RESPONSAVEL='".$resp."'"; 
        $update2 = mysqli_query($connect,$queryupdate2);
        
        if(mysqli_errno($connect) == '0'){
            $log_file_msg="[deletaagenda.php] Pedido de castração com código ".$codigo." foi atualizado para CODIGO=0 às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg); 
        } else {
            $log_file_msg="[deletaagenda.php] Problema na exclusão do agendamento. Delete code: ".$update2." - Mensagem de erro: ".mysqli_error($connect). " SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
        }
            
        //$subject = "[GAAR Campinas] Código de autorização de procedimento cancelado";
  
        /*
        if ($data_ag < $data_atu) {
            
            $message .= "Código de autorização de procedimento ".$codigo." cancelado devido à data de validade vencida- ".$dia_multi."/".$mes_multi."/".$ano_multi."";
            //$to = $emailresp;
            $to="thaise.piculi@gmail.com";
            $mail->AddAddress($to);
            if (!$mail->send()) {
                $log_file_msg ="[deletaagenda.php] Erro no envio do e-mail ao responsável ".$to.": ".$mail->ErrorInfo." às ".$horaatu."\n";
                $fp = fopen($log_file, 'a');//opens file in append mode  
                fwrite($fp, $log_file_msg);  
            } else {
                $log_file_msg ="[deletaagenda.php] Envio do voucher ao responsável ".$to." às ".$horaatu."\n";
                $fp = fopen($log_file, 'a');//opens file in append mode  
                fwrite($fp, $log_file_msg);
                $mail->clearAddresses();
            }
            
            //$to = $emailvet;
            
        } else {
            if ($codagenda <> "") {
                $message .= "Código de autorização de procedimento ".$codigo." cancelado manualmente. Data de validade - ".$dia_multi."/".$mes_multi."/".$ano_multi."";   
                //$to = "castracao@gaarcampinas.org";
                $to="thaise.piculi@gmail.com";
                $mail->AddAddress($to);
                if (!$mail->send()) {
                    $log_file_msg ="[deletaagenda.php] Erro no envio do voucher à castração ".$to.": ".$mail->ErrorInfo." às ".$horaatu."\n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg);  
                } else {
                    $log_file_msg ="[deletaagenda.php] Envio do voucher à castração ".$to." às ".$horaatu."\n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg);
                    $mail->clearAddresses();
                }
            }
        }
        */
    }
}

/*
*/

 echo"<script language='javascript' type='text/javascript'>
    alert('Agendamento cancelado com sucesso!');
    window.history.go(-1);</script>";
?>