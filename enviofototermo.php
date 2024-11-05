<?php
session_start();

include ("conexao.php"); 

ini_set('display_errors', 1);
            
error_reporting(E_ALL);

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$login = $_SESSION['login'];
$id_termo = $_GET['id'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$to = $fetcharea[0];
		}

        $query = "SELECT FOTO FROM TERMO_ADOCAO WHERE ID = '$id_termo'";
        $select = mysqli_query($connect,$query);
        $rc = mysqli_fetch_row($select);
        $nome_foto = $rc[0];
        
        $bodytext = "Segue anexo a foto do termo de adoção número ".$id_termo;
        
        $email = new PHPMailer();
        $email->CharSet = 'UTF-8';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$email->msgHTML(file_get_contents('contents.html'), __DIR__);
        $email->SetFrom('contato@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
        $email->Subject   = '[GAAR Campinas] Foto do termo';
        $email->Body      = $bodytext;
        $email->IsHTML(true);
        //$to = 'gaarcampinas@gmail.com';
        $email->AddAddress($to);
        
        $file_to_attach = '/home1/gaarca06/private/docs/termos/'.$nome_foto;
        
        $email->addAttachment($file_to_attach, 'Termo digital');
        
        //send the message, check for errors
        if (!$email->send()) {
            echo 'Mailer Error: ' . $email->ErrorInfo;
        } else {
            echo "E-mail enviado para : ".$to."<br>";
            //echo "<img src='".$file_to_attach."'>";
            //echo"<script language='javascript' type='text/javascript'>    alert('E-mail enviado!');window.close();</script>";
        }
}
?>
