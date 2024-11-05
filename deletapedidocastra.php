<?php 
session_start();

include ("conexao.php"); 

$idpedido = $_GET['id'];

$hoje = date("Y-m-d");
$data_atu = date("Y-m-d");
$mes_atu = date("m");
$ano_atu = date("Y"); 
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";
$fp = fopen($log_file, 'a');//opens file in write mode  

$queryupdate = "DELETE FROM PEDIDO_CASTRACAO WHERE ID='$idpedido'";
$update = mysqli_query($connect,$queryupdate);
    
if(mysqli_errno($connect) == '0'){
                
    $log_file_msg="[deletapedidocastra.php] Pedido de castração ID ".$codigo." foi cancelado às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg); 
             
    
    echo"<script language='javascript' type='text/javascript'>
           alert('Pedido cancelado! '); 
           window.location.href='formautoriza.php';</script>"; 
}

?>