

<?php 
session_start();

include ("conexao.php"); 

$id = $_GET['id'];
$ativo = $_GET['ativo'];

	
$query = "UPDATE LT
		SET 
		ATIVO='$ativo'
		WHERE 
		ID = '$id'";

$insert = mysqli_query($connect,$query); 	

if(mysqli_errno($connect) == '0'){
    echo "<html>";
    echo "<body>";
    echo"<script type='text/javascript'>
                  if (confirm('Lar temporário atualizado!')) {
                    window.history.go(-1);
                  }
                </script>";
    echo "</body>";
    echo "</html>";
} else{
   echo "Insert code: ".$insert;
		echo "Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);
}
        
mysqli_close($connect);
?>