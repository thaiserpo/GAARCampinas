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
		
        $idprocedi = $_POST['idprocedi'];
        $mensagem = $_POST['mensagem'];
        
		$queryprocedi = "SELECT * FROM PEDIDO_CASTRACAO WHERE ID='$idprocedi'";
		$selectprocedi = mysqli_query($connect,$queryprocedi); 
        $rc = mysqli_fetch_row($selectprocedi);
        
        $nomedoanimal = $rc[1];
        $especie = $rc[2];
		$sexo = $rc[3];
		$porte = $rc[4];
		$peso = $rc[18];
		$dtnasc = $rc[5];
		$idprotetor = $rc[19];
		$nomeresp = $rc[6];
		$telresp = $rc[7];
		$emailresp = $rc[8];
		$valorajuda = $rc[9];
		$obs = $rc[10];
		$volgaar = $rc[11];
		$bairro = $rc[13];
		$cidade = $rc[14];
		$status = $rc[15];
		$melhorbairro = $rc[16];
		$melhordia= $rc[17];
		$quemleva = $rc[20];
		
		$ano_nascimento = substr($dtnasc,0,4);
	    $mes_nascimento = substr($dtnasc,5,2);
	    $dia_nascimento = substr($dtnasc,8,2);
	    
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

		$subject = "Resposta do formulário de procedimento ID ".$idprocedi;
		
        $bodytext = "<center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br><br></center>";
		$bodytext .= "  <p> <strong>Nome do animal:</strong> ". $nomedoanimal."<br>
        		                 <strong>Espécie        :</strong> ".$especie."<br>
        		                 <strong>Sexo           :</strong> ".$sexo."<br>
        		                 <strong>Respondido por      :</strong> ".$nomevoluntario."<br></p>" ;
        		                 
		$bodytext .= $mensagem ;
        
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$email->msgHTML(file_get_contents('contents.html'), __DIR__);
        $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
        $mail->Subject   = $subject;
        $mail->Body      = $bodytext;
        $mail->IsHTML(true);
        $to = $emailresp;
        $mail->AddAddress($to);
        
        
        //send the message, check for errors
        if (!$mail->send()) {
            $log_file_msg .="[envioemailcastracao.php] Erro no envio de resposta ao protetor ".$to.": ".$mail->ErrorInfo." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
        } else {
            $mail->clearAddresses();
            
            $bodytext ="";
            $subject="";
            $to="";
                
            if ($_POST['caixacastracao'] ==='caixacastracao'){
                $log_file_msg .="[envioemailcastracao.php] Envio de resposta do voluntário(a) ".$nomevoluntario." ao protetor ".$nomeresp." - ".$emailresp." às ".$horaatu."\n";
                $subject = "Cópia da resposta do formulário de procedimento ID ".$id;
        		
        		$bodytext = " <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br><br></center>
        		              <p> <strong>Nome do protetor:</strong> ". $nomeresp."<br>
        		                 <strong>E-mail              :</strong> ".$emailresp."<br>
        		                 <strong>Respondido por      :</strong> ".$nomevoluntario."<br></p>" ;
        		                 
                $bodytext .= $mensagem;
        		                 
                $bodytext .="<br><br><i>Esta cópia da resposta ao interessado foi enviada apenas aos voluntários de castração cadastrados no banco de dados.</i>";
    
        		echo"<script language='javascript' type='text/javascript'>
                alert('E-mail enviado!');
                window.location.href='formautoriza.php'</script>";
        } 
        
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