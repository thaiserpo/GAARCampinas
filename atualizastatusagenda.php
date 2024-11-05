<?php 
session_start();

include ("conexao.php"); 

$queryvol = "SELECT CODIGO FROM PEDIDO_CASTRACAO WHERE STATUS_PEDIDO='APROVADO'";
$selectvol = mysqli_query($connect,$queryvol); 	

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$count = 0;

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode 

$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);

while ($fetchvol = mysqli_fetch_row($selectvol)) { 

    $id = $fetchvol[0];

    $query = "UPDATE AGENDAMENTO
    			SET 
    			REALIZADO='SIM'
    			WHERE 
    			CODIGO = '$id'";

    $insert = mysqli_query($connect,$query); 
    //$count = int($count) + 1;
}
$log_file_msg.="[atualizastatusagenda.php] Processo de atualização de agendamento ".$id." executado às ".$horaatu."\n";
$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  

fclose($fp);
mysqli_close($connect);
?>