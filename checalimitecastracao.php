<?php 
session_start();

include ("conexao.php"); 

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");

$idprotetor = $_POST['idprotetor'];

$querycount = "SELECT COUNT(ID_PROTETOR) FROM PEDIDO_CASTRACAO WHERE ID_PROTETOR='$idprotetor' AND DATA_REG LIKE '".$ano_atu."-".$mes_atu."%'";
$selectcount = mysqli_query($connect,$querycount); 
$rccount = mysqli_fetch_row($selectcount);
$castracoes_protetor = $rc[0];

mysqli_close($connect);
?>