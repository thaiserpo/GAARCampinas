<?php 
session_start();

include ("conexao.php"); 

$idmail = $_GET['id'];

         $query = "UPDATE EMAIL_MARKETING SET RECEBER='NÃO' WHERE ID = '$idmail'";
         $update = mysqli_query($connect,$query);
         
         if(mysqli_errno($connect) == '0'){
               echo"<script language='javascript' type='text/javascript'>
                                  alert('E-mail removido com sucesso!');
                        		  window.close()</script>";
        }


?>