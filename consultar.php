<?php 
session_start();

include ("conexao.php"); 

$getid = "SELECT * FROM ANIMAL";
$id = mysqli_query($connect,$getid); 

while ($fetch = mysqli_fetch_row($id)) {
   $idanimal = $fetch[0]; 
   $nomeanimal = $fetch[1]; 
   $especie = $fetch[2];
   $lt = $fetch[11];
   $resp = $fetch[12];
   
   $queryresp="SELECT EMAIL FROM VOLUNTARIOS WHERE NOME='$resp'";
   $result_resp=mysqli_query($connect,$queryresp); 
   while ($femail = mysqli_fetch_row($result_resp)) {
     $emailresp = $femail[0];    
   }
   
   $sqlupdate = "SELECT ID FROM TERMO_ADOCAO WHERE NOME_ANIMAL='$nomeanimal' AND ESPECIE='$especie' AND LAR_TEMPORARIO='$lt' AND EMAIL_DOADOR='$emailresp'";
   $update = mysqli_query($connect,$sqlupdate); 
   while ($ftermo = mysqli_fetch_row($update)) {
     $idtermo = $ftermo[0];    
   }
   
   if (mysqli_errno($connect) == '0'){
       echo "Nome do animal: ".$nomeanimal." <br> Espécie: ".$especie."<br> Lt: ".$lt."<br> Resp.: ".$emailresp."<br> Termo ID: ".$idtermo."<br><br>";
   }
   
}


?>
