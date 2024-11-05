<?php

include ("conexao.php"); 

ini_set('display_errors', 1);
            
error_reporting(E_ALL);

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$countok = 0;
$countfailed = 0;

$query1 = "SELECT NOME, EMAIL FROM SOCIO WHERE EMAIL <> ''";
$select = mysqli_query($connect,$query1);
while ($fetch = mysqli_fetch_row($select)) {
    $nome = $fetch[0];
	$email = $fetch[1];
	
	$queryinsert = "INSERT INTO EMAIL_MARKETING (NOME, EMAIL, RECEBER, ENVIADO) VALUES ('$nome','$email','SIM', 'NÃO')";
	$insert = mysqli_query($connect,$queryinsert); 	
                        		 
    if(mysqli_errno($connect) <> '0') {
        //echo "<br> Erro ao cadastrar: Nome: ".$nome." - E-mail: ".$email." Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
        $countfailed = intval($countfailed) + 1;
    } else {
        $countok = intval($countok) + 1;
    }
        
}

$query2 = "SELECT ADOTANTE, EMAIL FROM CALENDARIO WHERE EMAIL <> ''";
$select = mysqli_query($connect,$query2);
while ($fetch = mysqli_fetch_row($select)) {
    $nome = $fetch[0];
	$email = $fetch[1];
	
	$queryinsert = "INSERT INTO EMAIL_MARKETING (NOME, EMAIL, RECEBER) VALUES ('$nome','$email','SIM')";
	$insert = mysqli_query($connect,$queryinsert); 	
                        		 
    if(mysqli_errno($connect) <> '0') {
        //echo "<br> Erro ao cadastrar: Nome: ".$nome." - E-mail: ".$email." Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
        $countfailed = intval($countfailed) + 1;
    } else {
        $countok = intval($countok) + 1;
    }
        
}

$query3 = "SELECT ADOTANTE, EMAIL FROM TERMO_ADOCAO WHERE EMAIL <> ''";
$select = mysqli_query($connect,$query3);
while ($fetch = mysqli_fetch_row($select)) {
    $nome = $fetch[0];
	$email = $fetch[1];
	
	$queryinsert = "INSERT INTO EMAIL_MARKETING (NOME, EMAIL, RECEBER) VALUES ('$nome','$email','SIM')";
	$insert = mysqli_query($connect,$queryinsert); 	
                        		 
    if(mysqli_errno($connect) <> '0') {
        //echo "<br> Erro ao cadastrar: Nome: ".$nome." - E-mail: ".$email." Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
        $countfailed = intval($countfailed) + 1;
    } else {
        $countok = intval($countok) + 1;
    }
        
}

$query4 = "SELECT NOME, EMAIL FROM VOLUNTARIOS WHERE EMAIL <> '' AND STATUS_APROV='Aprovado'";
$select = mysqli_query($connect,$query4);
while ($fetch = mysqli_fetch_row($select)) {
    $nome = $fetch[0];
	$email = $fetch[1];
	
	$queryinsert = "INSERT INTO EMAIL_MARKETING (NOME, EMAIL, RECEBER) VALUES ('$nome','$email','SIM')";
	$insert = mysqli_query($connect,$queryinsert); 	
                        		 
    if(mysqli_errno($connect) <> '0') {
        echo "<br> Erro ao cadastrar: Nome: ".$nome." - E-mail: ".$email." Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
        $countfailed = intval($countfailed) + 1;
    } else {
        $countok = intval($countok) + 1;
    }
        
}

$query5 = "SELECT NOME, EMAIL FROM FORM_VOLUNTARIO WHERE EMAIL <> ''";
$select = mysqli_query($connect,$query5);
while ($fetch = mysqli_fetch_row($select)) {
    $nome = $fetch[0];
	$email = $fetch[1];
	
	$queryinsert = "INSERT INTO EMAIL_MARKETING (NOME, EMAIL, RECEBER) VALUES ('$nome','$email','SIM')";
	$insert = mysqli_query($connect,$queryinsert); 	
                        		 
    if(mysqli_errno($connect) <> '0') {
        echo "<br> Erro ao cadastrar: Nome: ".$nome." - E-mail: ".$email." Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
        $countfailed = intval($countfailed) + 1;
    } else {
        $countok = intval($countok) + 1;
    }
        
}

if ($countok <> '0') {
    
    $from = "contato@gaarcampinas.org";

    $headers = "MIME-Version: 1.0¥n";               
    $headers .= "Content-type: text/html; charset=utf-8¥n";            
    $headers .= "From: <{$from}> ¥r¥n"; 
    
    $subject = "EMAIL_MARKETING report";
    
    $to='thaise.piculi@gmail.com';
    
    $message ="<center> Registros inseridos com sucesso: ".$countok." <br> Registros falhados: ".$countfailed."";
    
    //$result =  mail($to, $subject, $message, $headers);   
}

$log_file_msg ="[loademailmarketing.php] Registros inseridos com sucesso: ".$countok." - Registros falhados: ".$countfailed." às ".$horaatu."\n";
    
$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  
fclose($fp);

?>
