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
        
    $dtenvio = $_POST['dtenvio'];
    $ano_dtenvio = substr($dtenvio,0,4);
    $mes_dtenvio = substr($dtenvio,5,2);
    $dia_dtenvio = substr($dtenvio,8,2);
    
    $subject = $_POST['subject'];
    
    $uploaddir = '/home/gaarca06/public_html/area/imagens/';
    
    $new_subject = $uploaddir."text-".$ano_dtenvio."-".$mes_dtenvio."-".$dia_dtenvio.".txt";
    $subject_file = fopen($new_subject, "w");
    fwrite($subject_file, $subject);
    fclose($subject_file);
    
    $filename = $_FILES['body']['name'];
    
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); 

    switch ($extension) {
        case 'jpg':
        case 'jpeg':
           $image = imagecreatefromjpeg($filename);
        break;
        case 'gif':
           $image = imagecreatefromgif($filename);
        break;
        case 'png':
           $image = imagecreatefrompng($filename);
        break;
    }
    

    //imagepng($image, $new_body, '0');

    $upload_subject = $uploaddir.($new_subject);
    $upload_body = "image-".$ano_dtenvio."-".$mes_dtenvio."-".$dia_dtenvio.".png";

    move_uploaded_file($new_subject, $upload_subject) ;
    move_uploaded_file($_FILES['body']['tmp_name'], $uploaddir.$upload_body) ;
    
    echo"<script language='javascript' type='text/javascript'>
            alert('Upload realizado com sucesso!');
            window.location.href='formuploadmailmark.php'</script>";
                                    		        
}
?>          


