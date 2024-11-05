<?php 
session_start();

// REMOVE DIRETORIO DE LOG DO MES

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");
$log_file_msg ="";
$dias_ant = date('d',strtotime('-7 days'));
$mes_ant = date('m',strtotime('-1 months'));

$dir = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu;

foreach (glob($dir."/*.*") as $filename) {
    if (is_file($filename)) {
        unlink($filename);
    }
}

rmdir($dir);


?>          


