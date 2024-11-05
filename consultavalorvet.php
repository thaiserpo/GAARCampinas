<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$idvetgato = $_POST['vetgato'];
$idvetcao = $_POST['vetcao'];
$especie = $_POST['especie'];

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode 

/*$log_file_msg.="[consultavalorvet.php]  \n";
$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  

*/

if ($especie == "Felina") {
    $queryvalores = "SELECT VALOR_GATA_PROT FROM CLINICAS WHERE ID='$idvetgato' AND ESPECIE='Felina'";    
}
if ($especie == "Canina") {
    $queryvalores = "SELECT VALOR_CADELA_PROT FROM CLINICAS WHERE ID='$idvetcao' AND ESPECIE='Canina'";    
}

$selectvalores = mysqli_query($connect,$queryvalores);
$reccount = mysqli_num_rows($selectvalores);
$tmp = mysqli_fetch_row($selectvalores);

//$idanimal = $tmp[0];
$valores = $tmp[0];

$log_file_msg.="[consultavalorvet.php] Valor de gata: ".$valores." \n";
$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  

/*if($reccount <> '0'){
    $queryupdate = "UPDATE ANIMAIS_REDES SET ID_ANIMAL='$idpet',DIA_POST='$datapost',NOVO_TEXTO='$novotexto' WHERE ID_ANIMAL='$idpet'";
    $update = mysqli_query($connect,$queryupdate); 
    $log_file_msg="[cadastropet_redes.php] RECCOUNT: ".$reccount." Animal ID: ".$idpet." atualizado para ser postado em ".$datapost." às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);  
}else{ 
    $query = "INSERT INTO ANIMAIS_REDES (ID_ANIMAL,DIA_POST,NOVO_TEXTO, ULTIMO_POST) VALUES ('$idpet','$datapost','$novotexto','$valores')";
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