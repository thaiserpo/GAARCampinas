<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$idanimal = $_GET['idanimal'];
$source = $_GET['source'];
$terceiro = $_GET['terceiro'];

if ($source != ''){
    $login = $source;
}

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
    
$queryselect = "SELECT NOME,AREA FROM VOLUNTARIOS WHERE USUARIO = '$login' or EMAIL = '".$login."'";
$select = mysqli_query($connect,$queryselect);

while ($fetch = mysqli_fetch_row($select)) {
    $nomevol = $fetch[0];
    $area = $fetch[1];
} 

$queryselect = "SELECT NOME_ANIMAL, ESPECIE,FOTO FROM ANIMAL WHERE ID = '$idanimal'";
$select = mysqli_query($connect,$queryselect);
$reccount = mysqli_num_rows($select);

while ($fetch = mysqli_fetch_row($select)) {
    $nomeanimal = $fetch[0];
    $especie = $fetch[1];
    $foto = $fetch[2];
    $carteirinha_frente = $fetch[26];
    $carteirinha_verso = $fetch[27];
}

$uploaddir = '/home/gaarca06/public_html/pets/';
$file = $uploaddir.$foto;

$uploaddircart = '/home/gaarca06/public_html/docs/carteirinhas/';
$cart_frente = $uploaddircart.$carteirinha_frente;
$cart_verso = $uploaddircart.$carteirinha_verso;

if ($reccount != '0'){
    echo"<script language='javascript' type='text/javascript'>
          if (confirm('Deseja deletar o animal '+".$idanimal."+'?')) {";
                $query = "DELETE FROM ANIMAL WHERE ID = '$idanimal'";
                $delete = mysqli_query($connect,$query);
                
                if(mysqli_errno($connect) == '0'){
                    
                        /* DELETA A FOTO DO SERVIDOR */
                        unlink($file);
                        unlink($cart_frente);
                        unlink($cart_verso);
                    
                        switch ($area){
                                case 'anuncios':
                                    echo"alert('Animal deletado com sucesso!');window.location.href='terceiros.php';";
                                    break;
                    		
                    		    default:
                    		        if ($terceiro == 'Sim') {
                    		            echo"alert('Animal deletado com sucesso!');window.location.href='pesquisapetterc.php';";
                    		        } else {
                    		            echo"alert('Animal deletado com sucesso!');window.location.href='formpesquisapetinterna.php';";    
                    		        }
                    		        
                                    break;
                          }
                        
                        
                        ini_set('display_errors', 1);
                
                		error_reporting(E_ALL);
                
                		$from = "operacional@gaarcampinas.org";
                		
                		$to = "thaise.piculi@gmail.com";
                		
                		$subject = $nomeanimal." deletado do sistema";
                		
                		$headers = "MIME-Version: 1.0\n";               
                		$headers .= "Content-type: text/html; charset=utf-8\n";            
                		$headers .= "From: {$from} \r\n"; 
                		$message = "O animal ".$nomeanimal." - espécie ".$especie." - foi deletado do sistema por ".$nomevol."";
                		
                		mail($to, $subject, $message, $headers);
                }else{
                    switch ($area){
                                case 'anuncios':
                                    echo"<script language='javascript' type='text/javascript'>
                                      alert('Erro ao deletar');window.location
                                      .href='terceiros.php';</script>";
                                    break;
                    		
                    		    default:
                    		        echo"<script language='javascript' type='text/javascript'>
                                      alert('Erro ao deletar');window.location
                                      .href='formpesquisapetinterna.php';</script>";
                                    break;
                          }
                          
                        }
          echo "} 
            else {
                    alert('Animal não deletado');window.location.href='formpesquisapetinterna.php';
            }
            </script>";
        
}
else {
     echo"<script language='javascript' type='text/javascript'>
             alert('Animal já deletado!');
			 window.location.href='http://gaarcampinas.org'</script>";
}
}

mysqli_close($connect);
?>