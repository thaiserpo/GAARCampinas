<?php 
session_start();

include ("conexao.php"); 

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

$subject = file_get_contents("http://gaarcampinas.org/area/imagens/text-".$ano_atu."-".$mes_atu."-".$dia_atu.".txt");

$querypet ="SELECT ADOTADO, ID FROM ANIMAL WHERE ADOTADO='Adotado'";
$selectpet = mysqli_query($connect,$querypet);

while ($fetch = mysqli_fetch_row($selectpet)) {
    
    $status_pet = $fetch[0];
    $id_pet = $fetch[1];
    
    $queryselect1 = "SELECT * FROM APADRINHAMENTO WHERE ID_ANIMAL ='$id_pet'";
    $select1=mysqli_query($connect,$queryselect1);
    $reccount1 = mysqli_num_rows($select1);
    
    if ($reccount1 <> '0') {
        $query1 ="DELETE FROM APADRINHAMENTO WHERE ID_ANIMAL ='$id_pet'";
        $delete1 = mysqli_query($connect,$query1);
        $log_file_msg="[dailyatualizasocio.php] Registros de padrinhos e/ou madrinhas do animal ".$id_pet." foram deletados da tabela APADRINHAMENTO pois o animal foi adotado. ".$horaatu." \n";
        fwrite($fp, $log_file_msg); 
    } else {
        $log_file_msg="[dailyatualizasocio.php] Nenhum registro deletado da tabela APADRINHAMENTO às ".$horaatu." \n";
        fwrite($fp, $log_file_msg); 
    }
    
    $queryselect2 = "SELECT * FROM APADRINHAMENTO WHERE ID_ANIMAL ='$id_pet'";
    $select2 =mysqli_query($connect,$queryselect2);
    $reccount2 = mysqli_num_rows($select2);
    
    if ($reccount2 <> '0') {
        $query2 ="DELETE FROM SOCIO WHERE ID_ANIMAL='$id_pet'";
        $delete2 = mysqli_query($connect,$query2);
        $log_file_msg="[dailyatualizasocio.php] Registros de padrinhos e/ou madrinhas do animal ".$id_pet." foram deletados da tabela SOCIO pois o animal foi adotado. ".$horaatu." \n";
        fwrite($fp, $log_file_msg); 

    } else {
        $log_file_msg="[dailyatualizasocio.php] Nenhum registro deletado da tabela SOCIO às ".$horaatu." \n";
        fwrite($fp, $log_file_msg); 
    }
fclose($fp);
mysqli_close($connect);
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!--- GOOGLE ADSENSE --->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
    <!--- GOOGLE ADSENSE --->
</head>
</html>