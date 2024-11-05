<?php 
session_start();

include ("conexao.php"); 

$query = "SELECT ID FROM ANIMAL WHERE DIVULGAR_COMO='GAAR'";
$select = mysqli_query($connect,$query);

while ($fetch = mysqli_fetch_row($select)) {
			$idanimal = $fetch[0];	
			$newdir = "/home/gaarca06/public_html/pets/".$idanimal."/";
			try {
               mkdir($newdir); // cria diretorio com fotos do pet
            } catch(ErrorException $ex) {
               echo "<br> Diretório ".$newdir." não foi criado com sucesso. Erro: ".$ex->getMessage()." às ".$horaatu."\n";
            }

}


fclose($fp); 
mysqli_close($connect);

?>