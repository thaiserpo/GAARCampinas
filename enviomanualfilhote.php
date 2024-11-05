<?php 
session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');
require_once('/home1/gaarca06/public_html/area/fpdf/fpdf.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$queryselect = "SELECT ID,NOME_ANIMAL,ESPECIE,IDADE FROM ANIMAL WHERE ADOTADO='Adotado'";
$select = mysqli_query($connect,$queryselect);
$reccount = mysqli_num_rows($select);

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");

echo "<br> reccount: ".$reccount;

while ($rc = mysqli_fetch_row($select)) {
    $idanimal = $rc[0];
    $nomedoanimal =$rc[1];
    $especie =$rc[2];
    $idade =$rc[3];
    
    $ano_idade = substr($idade,0,4);
    $mes_idade = substr($idade,5,2);
    $dia_idade = substr($idade,8,2);
    
    $data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);
    $idade_jul = gregoriantojd($mes_idade,$dia_idade,$ano_idade);
    
    $diff_idade = intval($data_atu_jul) - intval($idade_jul) ;
    
    $subject = "[GAAR Campinas] Teste de manual";
    
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
    $to = "thaise.piculi@gmail.com";
    $mail->AddAddress($to);
    
    if ($diff_idade <= '365'){
        //$file_to_attach4 = '/home/gaarca06/public_html/docs/operacional/adocao_de_filhote_marco_23.docx';
        //$mail->addAttachment($file_to_attach4, 'Manual do filhote');
        $bodytext ="Olá adotante! <br><br>Nós do GAAR queremos sempre o bem-estar do animal e da família e por isso elaboramos um manual do filhote para que a adaptação do novo membro da família seja a mais tranquila possível. Segue anexo :) ";
        echo "<br>Animal ID ".$idanimal." NOME: ".$nomedoanimal." precisa de envio do manual";
    } 
    
    $mail->Subject   = $subject;
    $mail->Body      = $bodytext;
    
    //$mail->send();
}

?>