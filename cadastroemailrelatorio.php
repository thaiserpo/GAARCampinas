<?php 
session_start();

include ("conexao.php"); 

$emailmarketing = $_POST['emailmarketing'];
$nome = $_POST['nome'];
$relatorios = $_POST['relatorios'];
$marketing = $_POST['marketing'];

$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$log_file_msg ="";

$log_file_msg="[cadastroemailrelatorio.php] Variavel relatorio: ".$relatorio;
$log_file_msg.="[cadastroemailrelatorio.php] Variavel marketing: ".$marketing;
$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg); 

if($relatorios == "Sim"){
    $queryinsert1 = "INSERT INTO EMAIL_RELATORIO (EMAIL, ENVIADO) VALUES ('$email','NÃO')";
    $insert1 = mysqli_query($connect,$queryinsert1);
    
    if(mysqli_errno($connect) == '0'){
        $log_file_msg="[cadastroemailrelatorio.php] Cadastro inserido na tabela EMAIL_RELATORIO. E-mail: ".$email." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);  
    } else {
        $log_file_msg="[cadastroemailrelatorio.php] Falha no cadastro da tabela EMAIL_RELATORIO. E-mail: ".$email." - Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);  
    }
                    
} else {
    
}

if($marketing == "Sim"){
    $queryinsert2 = "INSERT INTO EMAIL_MARKETING (NOME, EMAIL, RECEBER, ENVIADO) VALUES ('$nome',$email','SIM','NÃO')";
    $insert2 = mysqli_query($connect,$queryinsert2);
    
    if(mysqli_errno($connect) == '0'){
        $log_file_msg="[cadastroemailrelatorio.php] Cadastro inserido na tabela EMAIL_MARKETING. E-mail: ".$email." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);  
    } else {
        $log_file_msg="[cadastroemailrelatorio.php] Falha no cadastro da tabela EMAIL_MARKETING. E-mail: ".$email." - Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);  
    }
}


/*$query = "SELECT EMAIL FROM VOLUNTARIOS WHERE (AREA <> 'anuncios' AND AREA <> 'clinica') AND EMAIL <> '0' ";
$select = mysqli_query($connect,$query); 
$reccount = mysqli_num_rows($select);

while ($fetchvol = mysqli_fetch_row($selectvol)) {
    
    $email = $fetchvol[0];
    $queryinsert = "INSERT INTO EMAIL_RELATORIO (EMAIL, ENVIADO) VALUES ('$email','NÃO')";
    $insert = mysqli_query($connect,$queryinsert);
    
}*/

fclose($fp);

mysqli_close($connect);


?>