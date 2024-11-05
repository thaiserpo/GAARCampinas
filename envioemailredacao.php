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
$dia_iniciopost = date('Y-m-d', strtotime('next monday'));
$dia_fimpost = date('Y-m-d', strtotime($dia_iniciopost. ' + 6 days'));

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
$mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
$mail->IsHTML(true);
$to = "contato@gaarcampinas.org";
$mail->AddAddress($to);

$query = "SELECT * FROM ANIMAIS_REDES WHERE DIA_POST >= '".$dia_iniciopost."' AND DIA_POST <= '".$dia_fimpost."' AND NOVO_TEXTO = 'SIM' ORDER BY DIA_POST ASC";
$select = mysqli_query($connect,$query);
$reccount = mysqli_num_rows($select);

$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);

$ano_inicipost = substr($dia_iniciopost,0,4);
$mes_inicipost = substr($dia_iniciopost,5,2);
$dia_inicipost = substr($dia_iniciopost,8,2);

$ano_fimpost = substr($dia_fimpost,0,4);
$mes_fimpost = substr($dia_fimpost,5,2);
$dia_fimpost = substr($dia_fimpost,8,2);

$bodytext_1 = "Olá voluntárias! <br><br> Segue a programação dos animais que planejamos para esta semana. Sujeita à alterações:<br><br>";

while ($fetch = mysqli_fetch_row($select)) {

    $idanimal = $fetch[1];
    $data_post = $fetch[2];
    $texto_novo = $fetch[3];
    
    $querypet = "SELECT NOME_ANIMAL,ESPECIE FROM ANIMAL WHERE ID='$idanimal'";
    $selectpet = mysqli_query($connect,$querypet);
    $tmp = mysqli_fetch_row($selectpet);
    $nomeanimal = $tmp[0];
    $especie = $tmp[1];
    
    $ano_datapost = substr($data_post,0,4);
    $mes_datapost = substr($data_post,5,2);
    $dia_datapost = substr($data_post,8,2);
    
    if ($texto_novo == 'SIM') {
        $texto_novo = "Precisa de texto novo";
    } else {
        $texto_novo = "Não precisa de texto novo.";
    }
    
    if ($especie == 'Felina') {
        $subject_gato = "Programação de posts dos gatos - ".$dia_inicipost."/".$mes_inicipost." a ".$dia_fimpost."/".$mes_fimpost."";
        $bodytext_gato .="".$dia_datapost."/".$mes_datapost." - ".$nomeanimal.": <a href='http://gaarcampinas.org/pet.php?id=".$idanimal."'>http://gaarcampinas.org/pet.php?id=".$idanimal."</a><br> ";        
    } else {
        $subject_cachorro = "Programação de posts dos cães - ".$dia_inicipost."/".$mes_inicipost." a ".$dia_fimpost."/".$mes_fimpost."";
        $bodytext_cachorro .="".$dia_datapost."/".$mes_datapost." - ".$nomeanimal.": <a href='http://gaarcampinas.org/pet.php?id=".$idanimal."'>http://gaarcampinas.org/pet.php?id=".$idanimal."</a><br> ";
    }
    
}

$bodytext_2 .="<p><i>Este e-mail foi enviado automaticamente pelo sistema com base na tabela de programação de posts no banco de dados.</i></p>";

$mail->Subject   = $subject;
$mail->Body      = $bodytext;

echo "<html>";
echo "<body style='font-family: Verdana; font-size: 13px;'>";
echo $subject_gato."<br><br>";
echo $bodytext_1."<br>";
echo $bodytext_gato."<br><br>";
echo $bodytext_2."<br><br>";
echo "-------------------------------------------------------------------------------------------------------------------<br><br>";

echo $subject_cachorro."<br><br>";
echo $bodytext_1."<br>";
echo $bodytext_cachorro."<br><br>";
echo $bodytext_2."<br><br>";
echo "</body>";
echo "</html>";
mysqli_close($connect);
		
?>