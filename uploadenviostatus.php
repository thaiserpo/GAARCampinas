<?php 
session_start();

// RESET DIÁRIO DE STATUS NA TABELA DE EMAIL_MARKETING
include ("conexao.php"); 

$queryupdatestatus = "UPDATE EMAIL_MARKETING SET ENVIADO ='NÃO' WHERE RECEBER='SIM'";
$updatestatus = mysqli_query($connect,$queryupdatestatus);

$log_file_msg ="[uploadenviostatus.php] Reset diário de status na tabela EMAIL_MARKETING realizado com sucesso às ".$horaatu."\n";
$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  
fclose($fp);
        
?>          


