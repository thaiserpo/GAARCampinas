<?php 
session_start();

// CLEAN UP DIÁRIO
include ("conexao.php"); 

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");
$log_file_msg ="";
$dias_ant = date('d',strtotime('-7 days'));
$mes_ant = date('m',strtotime('-1 months'));

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

function cleaning () {
    unlink ("/home/gaarca06/public_html/area/imagens/text-".$ano_atu."-".$mes_atu."-".$dia_atu.".txt");
    unlink ("/home/gaarca06/public_html/area/imagens/image-".$ano_atu."-".$mes_atu."-".$dia_atu.".png");
    $log_file_msg .="[cleanup.php] Arquivo /home/gaarca06/public_html/area/imagens/text-".$ano_atu."-".$mes_atu."-".$dia_atu.".txt deletado  às ".$horaatu."\n";
    $log_file_msg .="[cleanup.php] Arquivo /home/gaarca06/public_html/area/imagens/image-".$ano_atu."-".$mes_atu."-".$dia_atu.".png deletado  às ".$horaatu."\n";
}


cleaning ();

$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  
fclose($fp);
        
?>          


