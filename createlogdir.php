<?php 
session_start();

// CRIA DIRETÓRIO DE LOG DO MÊS

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");
$log_file_msg ="";
$dias_ant = date('d',strtotime('-7 days'));
$mes_ant = date('m',strtotime('-1 months'));

$newdir = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu;

mkdir($newdir);

/*$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode 

$log_file_msg .="[createlogdir.php] Diretório /home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu." criado às ".$horaatu."\n";

$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  
fclose($fp);*/

?>          


