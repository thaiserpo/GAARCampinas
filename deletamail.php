<?php 
session_start();

include ("conexao.php"); 

$email = $_GET['email'];

$query = "UPDATE EMAIL_MARKETING SET RECEBER ='NÃO' WHERE EMAIL='$email'";
$delete = mysqli_query($connect,$query);
        
if($delete){
          echo"<script language='javascript' type='text/javascript'>
          alert('E-mail removido com sucesso!');window.close();</script>";
}else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao deletar');window.close();</script>";
        }
?>