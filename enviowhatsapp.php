<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

        $ano_atu = date("Y");
		$mes_atu = date("m");
		$dia_atu = date("d");
		
		$dtatu = date("Y-m-d");
		
		$dtatu_format = date("d-m-Y");
		
		$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);
		
		header("Location:https://web.whatsapp.com/send?phone=5519989831474&text=Eu+tenho+interesse+no+seu+carro+%C3%A0+venda&source&data&app_absent") ;
                		
		mysqli_close($connect);
		
?>