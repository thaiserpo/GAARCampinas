<?php

session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$login = $_SESSION['login'];

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode

$log_file_msg = "";
$listamail = "";

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
        $queryarea = "SELECT EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$emailvol = $fetcharea[0];
		}
		
        $id = $_SESSION['idpretermo'];
		$mensagem = $_POST['mensagem'];
		$emailadotante = $_POST['emailadotante'];
		$nomeadotante = $_POST['nomeadotante'];
		$nomeanimal = $_POST['nomeanimal'];
        /*$queryform = "SELECT * FROM FORM_PRE_ADOCAO where ID='$id'";
		$selectform = mysqli_query($connect,$queryform);
        $fetchform = mysqli_fetch_row($selectform);
		$emailadotante = $fetchform[3];
		$nomeadotante = $fetchform[1];
		$nomeanimal = $fetchform[12]; */

		$queryvol = "SELECT * FROM VOLUNTARIOS WHERE USUARIO = '$login'";
		$selectvol = mysqli_query($connect,$queryvol);
		
		while ($fetchvol = mysqli_fetch_row($selectvol)) {
    		$nomevoluntario = $fetchvol[2];
    		$emailvoluntario = $fetchvol[4];
		}
        
		$subject = "Resposta do formulário de interesse em adoção do animal ".$nomeanimal;
		
		$bodytext = "<center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br><br></center>";
		$bodytext .= $mensagem ;

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$email->msgHTML(file_get_contents('contents.html'), __DIR__);
        $mail->SetFrom('pretermo@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
        $mail->Subject   = $subject;
        $mail->Body      = $bodytext;
        $mail->IsHTML(true);
        $to = $emailadotante;
        $mail->AddAddress($to);
        
        //send the message, check for errors
        if (!$mail->send()) {
            $log_file_msg .="[envioemailpretermo.php] Erro no envio de resposta ao interessado ".$to.": ".$mail->ErrorInfo." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
            echo "<br> ".$log_file_msg;
        } else {
            $mail->clearAddresses();
            
            $bodytext ="";
            $subject="";
            $to="";
            if ($_POST['coordenadores'] ==='coordenadores'){
                $log_file_msg .="[envioemailpretermo.php] Envio de resposta do voluntário(a) ".$nomevoluntario." ao interessado ".$emailadotante." às ".$horaatu."\n";
                $queryupdate = "UPDATE FORM_PRE_ADOCAO SET OBS='Resposta enviada por ".$nomevoluntario." em ".$dia_atu."/".$mes_atu."' WHERE ID='$id'";
    		    $update = mysqli_query($connect,$queryupdate);

                $subject = "Cópia da resposta do formulário de interesse em adoção do animal ".$nomeanimal;
        		
        		$bodytext = " <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br><br></center>
        		              <p> <strong>Nome do interessado:</strong> ". $nomeadotante."<br>
        		                 <strong>E-mail              :</strong> ".$emailadotante."<br>
        		                 <strong>Respondido por      :</strong> ".$nomevoluntario."<br></p>" ;
        		                 
                $bodytext .= $mensagem;
                
                $bodytext .= "<br><br> Link para consulta das respostas do interessado: <a href ='http://gaarcampinas.org/area/visualizapretermo.php?idpretermo=".$id."&source=".$emailvol."'>Ver pré termo </a>";
        		                 
                $bodytext .="<br><br><i>Esta cópia da resposta ao interessado foi enviada apenas aos coordenadores de feira previamente cadastrados no banco de dados.</i>";
    
    		    /** ENVIO DE CÓPIA DA RESPOSTA AOS COORDENADORES**/
    		
        		$querycoord = "SELECT EMAIL FROM VOLUNTARIOS WHERE COORDENADOR='SIM' OR ENTREVISTADOR<>'0'";
        		$selectcoord = mysqli_query($connect,$querycoord);
        		
        		while ($fetchcoord = mysqli_fetch_row($selectcoord)) {
                    $bcc_mail = $fetchcoord[0];
                    $listamail .= $bcc_mail.", ";
                    $mail->AddCustomHeader("BCC: ".$bcc_mail.""); 
                }
                
                $mail->Subject   = $subject;
                $mail->Body      = $bodytext;
                $mail->IsHTML(true);
                $to ="admin@gaarcampinas.org";
                $mail->AddAddress($to);
                
                //send the message, check for errors
                if (!$mail->send()) {
                    $log_file_msg .="[envioemailpretermo.php] Erro no envio de resposta aos coordenadores ".$listamail.": ".$mail->ErrorInfo." às ".$horaatu."\n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg);  
                } else {
                    $log_file_msg .="[envioemailpretermo.php] Envio de resposta do pré termo ID ".$id." aos coordenadores ".$listamail." às ".$horaatu."\n"; 
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg);  
                }
            
        } 
        
            echo"<script language='javascript' type='text/javascript'>
                alert('E-mail enviado!');
                window.location.href='pesquisapretermo.php'</script>";
        fclose($fp);
      }
}
mysqli_close($connect);
?>
<html>
    <head>
        <!--- GOOGLE ADSENSE --->
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
                crossorigin="anonymous"></script> <br>
        <!--- GOOGLE ADSENSE --->
    </head>
</html>