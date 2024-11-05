<?php 
session_start();

include ("conexao.php"); 

    $queryvol = "SELECT ID,IDADE FROM ANIMAL WHERE DIVULGAR_COMO ='GAAR'";
	$selectvol = mysqli_query($connect,$queryvol); 	
	
	$ano_atu = date("Y");
	$mes_atu = date("m");
	$dia_atu = date("d");
	
	$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);
	
	while ($fetchvol = mysqli_fetch_row($selectvol)) { 
	    
	    $id = $fetchvol[0];
	    $idade = $fetchvol[1];

	    $ano_idade = substr($idade,0,4);
        $mes_idade = substr($idade,5,2);
        $dia_idade = substr($idade,8,2);
        
        $idade_jul = gregoriantojd($mes_idade,$dia_idade,$ano_idade);

        $idade = intval ($data_atu_jul) - intval ($idade_jul);

        $query = "UPDATE ANIMAL
					SET 
					IDADE_JUL='$idade'
					WHERE 
					ID = '$id'";
					 				
        $insert = mysqli_query($connect,$query); 	
        
        }

?>