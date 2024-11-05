<?php 
session_start();

include ("conexao.php"); 

    $queryvol = "SELECT ID,IDADE,DATA_CASTRACAO FROM ANIMAL WHERE DIVULGAR_COMO ='GAAR' and CASTRADO ='Não'";
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
        
        $idade_jul = gregoriantojd($mes_idade, $dia_idade, $ano_idade);
        
        $data_atu = gregoriantojd($mes_atu, $dia_atu, $ano_atu);
        
        $dt_castra = intval ($data_atu) - intval ($idade_jul);
        
        echo "<br>dt castra          : ".$dt_castra;
        
        echo "<br>idade              :".$idade;
        
        $idade_castra = $idade_jul + 120;
        $idade_castra_greg = jdtogregorian($idade_castra);
        
        echo "<br> idade castra greg :".$idade_castra_greg;
        
        $ano_castra = substr($idade_castra_greg,4,4);
        $mes_castra = substr($idade_castra_greg,0,1);
        $dia_castra = substr($idade_castra_greg,2,1);

        echo "<br> idade castra greg: ".$ano_castra."-".$mes_castra."-".$dia_castra."";
        
        $idade = $ano_idade."-".$mes_prox."-".$dia_idade;

        $query = "UPDATE ANIMAL
					SET 
					DATA_CASTRACAO='$idade'
					WHERE 
					ID = '$id'";
					 				
        /*$insert = mysqli_query($connect,$query); 	*/
        
        if(mysqli_errno($connect) != '0'){
                echo "Insert code: ".$insert;
                echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
        }
        
        }

?>