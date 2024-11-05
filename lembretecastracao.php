<?php

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
		
$query = "SELECT * FROM ANIMAL WHERE (ADOTADO <> 'Óbito' AND ADOTADO <> 'Adotado' AND ADOTADO <> 'Indisponível') AND (DIVULGAR_COMO ='GAAR' OR DIVULGAR_COMO='LEG') AND CASTRADO='Não'";
$select = mysqli_query($connect,$query); 	

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");

$data_atu = date("Y-m-d");

$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$dtatu_format = date("d-m-Y");

$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);

while ($fetch = mysqli_fetch_row($select)) {

    $emailadotante = 0;
    $resp = 0;
    
    $idanimal = $fetch[0];
    $nomedoanimal = $fetch[1];
    $especie =$fetch[2]; 
    $idade = $fetch[3];
    $castrado = $fetch[7];
    $dtcastracao = $fetch[8];
    $status = $fetch[10];
    $resp = $fetch[12];
    
    $queryresp = "SELECT EMAIL FROM VOLUNTARIOS WHERE NOME='$resp'";
    $selectresp = mysqli_query($connect,$queryresp);
    $rc = mysqli_fetch_row($selectresp);
    $emailresp = $rc[0];
    
    if ($emailresp == '') {
        $emailresp = "castracao@gaarcampinas.org";
    }
    
    if($resp == ''){
        $resp = "GAAR Campinas";
    }

    $ano_castra = substr($dtcastracao,0,4);
    $mes_castra = substr($dtcastracao,5,2);
    $dia_castra = substr($dtcastracao,8,2);
    
    /* CONVERSAO DATA GREG TO JD */
    $dtcastra_jul = gregoriantojd($mes_castra,$dia_castra,$ano_castra);
    
    /* CALCULO DE DIAS */
    
    $dtcastra_dias = intval($dtcastra_jul) - intval($data_atu_jul) ;
    
    if ($dtcastra_dias == 5 ) {
    
        $bodytext ="";
        
        $subject = "[GAAR Campinas] A data da castração do(a) ".$nomedoanimal." está chegando";
        
        $bodytext = "<p>Olá voluntários responsáveis pelas castrações, <br><br>
        
                     Identificamos que a data de castração do(a) ".$nomedoanimal." está chegando.  <br><br>
                     
                     A data prevista é ".$dia_castra."/".$mes_castra."/".$ano_castra.". <br><br>
                     
                     Código do animal: ".$idanimal."<br><br>
                     
                     Por gentileza, realize o agendamento aos veterinários conveniados. <br><br>
                     
                     Equipe GAAR
                     <i> Este e-mail foi enviado automaticamente pelo sistema </i></p>";
        
        /* E-MAIL PARA OS VOLUNTARIOS DO AGENDAMENTO DE CASTRACOES */ 
        
        $mail->Subject   = $subject;
        $mail->Body      = $bodytext;
        $mail->IsHTML(true);
        $to = "castracao@gaarcampinas.org";
        $mail->AddAddress($to);
        
        if ($especie =='Felina') { /* ENVIAR TAMBEM À CPG */
            $querycpg = "SELECT EMAIL FROM VOLUNTARIOS WHERE CPG='SIM'";
            $selectcpg = mysqli_query($connect,$querycpg);
            while ($fetchcpg = mysqli_fetch_row($selectcpg)) {
                $emailcpg = $fetchcpg[0];
                $mail->addBCC($emailcpg);
            }
        }
        
        /* ENVIAR UMA CÓPIA AO RESPONSÁVEL PELO ANIMAL */
        $mail->addBCC($emailresp);
        $mail->addBCC('thaise.piculi@gmail.com');
        
        if (!$mail->send()) {
            $log_file_msg="[lembretecastracao.php] Lembrete de castração não enviado \n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
        } else {
            $log_file_msg="[lembretecastracao.php] Lembrete de castração enviado às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
        }
        
        $mail->clearAddresses();
    }
}

fclose($fp); 

mysqli_close($connect);
		
?>