<?php 
session_start();

include ("conexao.php"); 

$query = "SELECT ID,FOTO,FOTO_2,FOTO_3,FOTO_4 FROM ANIMAL WHERE DIVULGAR_COMO='GAAR'";
$select = mysqli_query($connect,$query);

while ($fetch = mysqli_fetch_row($select)) {
			$idanimal = $fetch[0];	
			$foto_1 = $fetch[1];	
			$foto_2 = $fetch[2];	
			$foto_3 = $fetch[3];	
			$foto_4 = $fetch[4];	
			
			$olddir_1 = "/home/gaarca06/public_html/pets/".$foto_1;
			$newdir_1 = "/home/gaarca06/public_html/pets/".$idanimal."/".$foto_1;
			
			$olddir_2 = "/home/gaarca06/public_html/pets/".$foto_2;
			$newdir_2 = "/home/gaarca06/public_html/pets/".$idanimal."/".$foto_2;
			
			$olddir_3 = "/home/gaarca06/public_html/pets/".$foto_3;
			$newdir_3 = "/home/gaarca06/public_html/pets/".$idanimal."/".$foto_3;
			
			$olddir_4 = "/home/gaarca06/public_html/pets/".$foto_4;
			$newdir_4 = "/home/gaarca06/public_html/pets/".$idanimal."/".$foto_4;
			
			echo "<br>ID animal        : ".$idanimal;
			echo "<br>Old dir Foto 1   : ".$olddir_1;
			echo "<br>New dir Foto 1   : ".$newdir_1;
			echo "<br>Old dir Foto 2   : ".$olddir_2;
			echo "<br>New dir Foto 2   : ".$newdir_2;
			echo "<br>Old dir Foto 3   : ".$olddir_3;
			echo "<br>New dir Foto 3   : ".$newdir_3;
			echo "<br>Old dir Foto 4   : ".$olddir_4;
			echo "<br>New dir Foto 4   : ".$newdir_4;
			
			try {
               copy($olddir_1,$newdir_1); 
               copy($olddir_2,$newdir_2); 
               copy($olddir_3,$newdir_3); 
               copy($olddir_4,$newdir_4); 
               
            } catch(ErrorException $ex) {
               echo "<br> Cópia não foi realizada com sucesso de ".$olddir_1." para ".$newdir_1." Erro: ".$ex->getMessage()." - ".$horaatu."\n";
            }

}


fclose($fp); 
mysqli_close($connect);

?>