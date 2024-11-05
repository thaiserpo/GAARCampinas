<?php 
session_start();

include ("conexao.php"); 

$queryvol = "SELECT ID,IDADE,DISPONIVEL_EM,ADOTADO FROM ANIMAL WHERE DIVULGAR_COMO ='GAAR'";
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
    $idade = $fetchvol[1];
    $dtdisponivel = $fetchvol[2];
    $status = $fetchvol[3];
    
    $ano_idade = substr($idade,0,4);
    $mes_idade = substr($idade,5,2);
    $dia_idade = substr($idade,8,2);
    
    $idade_jul = gregoriantojd($mes_idade,$dia_idade,$ano_idade);
    
    $idade = intval ($data_atu_jul) - intval ($idade_jul);
    
    /*echo "<br>ID: ".$id;
    echo "<br>status: ".$status;
    echo "<br>dt disponivel: ".$dtdisponivel;
    echo "<br>current dt: ".$current_dt;*/
    
    if ($status == 'Indisponível' && $dtdisponivel == $data_atu){
        $query = "UPDATE ANIMAL
    			SET 
    			IDADE_JUL='$idade',
    			ADOTADO='Disponível',
    			DATA_MOD = '".$ano_atu."-".$mes_atu."-".$dia_atu."'
    			WHERE 
    			ID = '$id'";
       /*echo "ID: ".$id." atualizou status pra disponível <br>";*/
    } else {
        $query = "UPDATE ANIMAL
    			SET 
    			IDADE_JUL='$idade',
    			DATA_MOD = '".$ano_atu."-".$mes_atu."-".$dia_atu."'
    			WHERE 
    			ID = '$id'";
    }

    $insert = mysqli_query($connect,$query); 
    //$count = int($count) + 1;
}
$log_file_msg.="[atualizaidade.php] Processo de atualização de idade executado às ".$horaatu."\n";
$log_file_msg.="[atualizaidade.php] Atualização de idade realizado em ".$count." animais";
$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  

fclose($fp);
mysqli_close($connect);
?>