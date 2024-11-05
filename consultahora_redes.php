<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$datapost = $_POST['datapost'];

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode 

$query = "SELECT HORA_POST FROM ANIMAIS_REDES WHERE DIA_POST ='$datapost' AND ID_ANIMAL <>'0'";
$insert = mysqli_query($connect,$query); 

/*if(mysqli_errno($connect) == '0'){ 
    $log_file_msg.="[cadastrotexto_redes.php] Texto atualizado para o animal ID: ".$idpet." em ".$datapost." às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);  
} else {
    $log_file_msg.="[cadastrotexto_redes.php] Erro ao atualizar o texto do animal ID: ".$idpet." em ".$datapost.": Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."  às ".$horaatu."\n";
    //$queryupdate = "UPDATE ANIMAIS_REDES SET ID_ANIMAL='$idpet',DIA_POST='$datapost',ULTIMO_POST='$ultimopost',NOVO_TEXTO='$novotexto' WHERE ID_ANIMAL='$idpet'";
    //$log_file_msg.="[cadastropet_redes.php] Animal ID: ".$idpet." atualizado para ser postado em ".$datapost." às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);
}*/

fclose($fp); 
mysqli_close($connect);

?>