<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
} else {
    $queryarealeg = "SELECT AREA,SUBAREA,EMAIL,NOME,CPG FROM VOLUNTARIOS WHERE USUARIO ='$login'";
	$selectarealeg = mysqli_query($connect,$queryarealeg);
	
	while ($fetcharealeg = mysqli_fetch_row($selectarealeg)) {
			$area = $fetcharealeg[0];
			$subarea = $fetcharealeg[1];
			$email = $fetcharealeg[2];
			$nomevoluntario = $fetcharealeg[3];
			$cpg = $fetcharealeg[4];
	}
        
    $idpet = $_POST['idpet'];
    $textopet = $_POST['textopet'];
    $ano_dtenvio = date("Y");
    $mes_dtenvio = date("m");
    $dia_dtenvio = date("d");
    
    $filename = $_FILES['textopettxt']['name'];
    
    $uploaddir = '/home/gaarca06/public_html/docs/comunicacao/textos/';
    
    echo "<br> file name: ".$filename;
    
    if ($filename =="") {
       $tmp_file = $uploaddir."textopet-id".$idpet.".txt";
       $txt_file = fopen($tmp_file, "w");
       fwrite($tmp_file, $textopet);
       fclose($tmp_file);
       
    } 
    
    move_uploaded_file($_FILES['textopet']['tmp_name'], $upload_textopet);
    
    /*echo"<script language='javascript' type='text/javascript'>
            alert('Upload realizado com sucesso!');
            window.location.href='formuploadtexto.php'</script>";
     */                               		        
}
?>          


