<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$idpet = $_POST['idanimal'];
$datapost = $_POST['datapost'];
$horapost = $_POST['horapost'];
$novotexto_tmp = $_POST['novotexto'];

if ($novotexto_tmp <> "SIM"){
    $novotexto = "NÃO";
} else {
    $novotexto = "SIM";
}

$reccount=0; 

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode 

$log_file_msg.="[cadastropet_redes.php] novotexto_tmp = ".$novotexto_tmp." - novotexto = ".$novotexto." \n";
$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  

if ($datapost <> ''){
    $queryultimopost = "SELECT ID_ANIMAL,MAX(DIA_POST) FROM ANIMAIS_REDES WHERE ID_ANIMAL='$idpet'";
    $selectultimopost = mysqli_query($connect,$queryultimopost);
    $reccount = mysqli_num_rows($selectultimopost);
    $tmp = mysqli_fetch_row($selectultimopost);
    
    $idanimal = $tmp[0];
    $ultimopost = $tmp[1];
    
    $query = "INSERT INTO ANIMAIS_REDES (ID_ANIMAL,DIA_POST,HORA_POST, NOVO_TEXTO, ULTIMO_POST) VALUES ('$idpet','$datapost','$horapost', '$novotexto','$ultimopost')";
    $insert = mysqli_query($connect,$query); 
    
    if(mysqli_errno($connect) == '0'){ 
        $log_file_msg.="[cadastropet_redes.php] Animal ID: ".$idpet." cadastrado para ser postado em ".$datapost." às ".$horaatu."\n";
        $log_file_msg.="[cadastropet_redes.php] Mensagem de erro: ".mysqli_error($connect). " - SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);  
    } else {
        $log_file_msg.="[cadastropet_redes.php] Erro ao inserir animal ID: ".$idpet." em ".$datapost.": Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."  às ".$horaatu."\n";
        //$queryupdate = "UPDATE ANIMAIS_REDES SET ID_ANIMAL='$idpet',DIA_POST='$datapost',ULTIMO_POST='$ultimopost',NOVO_TEXTO='$novotexto' WHERE ID_ANIMAL='$idpet'";
        //$log_file_msg.="[cadastropet_redes.php] Animal ID: ".$idpet." atualizado para ser postado em ".$datapost." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);
    }
} else {
    echo "Data de post inválida. Por favor, selecione uma data válida";
}
    
/*if($reccount <> '0'){
    $queryupdate = "UPDATE ANIMAIS_REDES SET ID_ANIMAL='$idpet',DIA_POST='$datapost',NOVO_TEXTO='$novotexto' WHERE ID_ANIMAL='$idpet'";
    $update = mysqli_query($connect,$queryupdate); 
    $log_file_msg="[cadastropet_redes.php] RECCOUNT: ".$reccount." Animal ID: ".$idpet." atualizado para ser postado em ".$datapost." às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);  
}else{ 
    $query = "INSERT INTO ANIMAIS_REDES (ID_ANIMAL,DIA_POST,NOVO_TEXTO, ULTIMO_POST) VALUES ('$idpet','$datapost','$novotexto','$ultimopost')";
    $insert = mysqli_query($connect,$query); 
    if(mysqli_errno($connect) == '0'){ 
        $log_file_msg="[cadastropet_redes.php] Animal ID: ".$idpet." cadastrado para ser postado em ".$datapost." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);  
    } else {
        $log_file_msg="[cadastropet_redes.php] Erro ao inserir animal ID: ".$idpet." em ".$datapost.": Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."  às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);
    }
	echo "Insert code: ".$insert;
	echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
	echo "<a href='gradeposts.php'>Voltar</a>";

} */

fclose($fp); 
mysqli_close($connect);

?>