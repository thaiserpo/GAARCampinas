<?php 
session_start();

include ("conexao.php"); 

    $queryvol = "select * from PROCEDIMENTOS where CODIGO='0'";
	$selectvol = mysqli_query($connect,$queryvol); 	
	
	$count=0;
	
	while ($fetchvol = mysqli_fetch_row($selectvol)) { 
	    
	    $id = $fetchvol[0];
	    
	    $count = $count + 1;
	    
	    $query = "UPDATE PROCEDIMENTOS
					SET 
					CODIGO='$count'
					WHERE 
					ID = '$id'";
					
		echo "<br> query: ".$query;
			
        $insert = mysqli_query($connect,$query); 
        
        }

?>