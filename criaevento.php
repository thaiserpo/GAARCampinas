<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

/*if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
*/
    $mail = new PHPMailer();
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->CharSet = 'UTF-8';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
    $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
    
    $data_atu = date("Y-m-d");
    $horaatu = date("H:i:s");
    
    $log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";
    
    $fp = fopen($log_file, 'a');//opens file in write mode  

    $dtevento = date('Y-m-d', strtotime(' + 5 days'));
    $evento = "Feira de adoção";
    $local = "Petcamp Barão Geraldo";
    $horainicio = "09:30:00";
    $horatermino = "12:00:00";

    $query = "INSERT INTO EVENTOS
    			(NOME_EVENTO, 
    			TIPO, 
    			LOCAL, 
    			DATA, 
    			HORARIO_INICIAL, 
    			HORARIO_FINAL, 
    			OBS, 
    			FOTO) 
    			VALUES
                ('$evento',
                '$evento',
                '$local',
                '$dtevento',
                '$horainicio',
                '$horatermino',
                '0',
                '0')";
                
    $insert = mysqli_query($connect,$query); 

    if(mysqli_errno($connect) == '0'){
        /*echo "Insert code: ".$insert;
    	echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
    	
    	ini_set('display_errors', 1);
        error_reporting(E_ALL);
        
        $from ="captacao@gaarcampinas.org";
        
        $getid = "SELECT ID FROM EVENTOS WHERE NOME_EVENTO ='$evento' AND TIPO='$evento' AND LOCAL='$local' AND DATA='$dtevento'";
        $idfeira = mysqli_query($connect,$getid); 
        $fetch = mysqli_fetch_row($idfeira);
        
        $ano_dtevento = substr($dtevento,0,4);
	    $mes_dtevento = substr($dtevento,5,2);
	    $dia_dtevento = substr($dtevento,8,2);
	    
        $dtevento = $dia_dtevento."/".$mes_dtevento."/".$ano_dtevento."";

    	switch ($evento) {
    	  case 'Feira de adoção':
                
        		$subject= "Novo evento cadastrado: Feira de adoção em ".$dtevento."";
        		
        		$log_file_msg="[criaevento.php] ".$subject." inserida na tabela EVENTOS às ".$horaatu."\n";
        
                $message = "Olá voluntário, <br><br>
                
                            O evento ".$evento." a ser realizado em ".$dtevento." das ".$horainicio."h as ".$horatermino."h no local ".$local." foi cadastrado em nosso banco de dados e está disponível para visualização em www.gaarcampinas.org/feiras-de-adocao <br><br>
                            
                            Você pode acompanhar o relatório desta feira através do link: http://gaarcampinas.org/area/verfeira.php?idevento=".$fetch[0]."<br><br>
                            
                            <i><small>Este e-mail foi enviado automaticamente pelo sistema. Por gentileza não responda.</small></i>";

                      
                break;
                
          case 'Bazar':
                
        		$subject= "Novo evento cadastrado: Bazar em ".$dtevento."";
        		
        		$log_file_msg="[criaevento.php] ".$subject." inserido na tabela EVENTOS às ".$horaatu."\n";

                $message = "Olá voluntários, <br><br>
                
                            O evento ".$evento." a ser realizado em ".$dtevento." das ".$horainicio." as ".$horatermino." no local ".$local." foi cadastrado em nosso banco de dados e está disponível para visualização em www.gaarcampinas.org/bazar <br><br>
                            
                            <i><small>Este e-mail foi enviado automaticamente pelo sistema. Por gentileza não responda.</small></i>";

                break;
                
           case 'Reunião do CMPDA':
                
        		$subject= "Novo evento cadastrado: Reunião do CMPDA em ".$dtevento."";
        		
        		$log_file_msg="[criaevento.php] ".$subject." inserido na tabela EVENTOS às ".$horaatu."\n";

                $message = "Olá voluntários, <br><br>
                
                            O evento ".$evento." a ser realizado em ".$dtevento." das ".$horainicio." as ".$horatermino." no local ".$local." foi cadastrado em nosso banco de dados. <br><br>
                            
                            <i><small>Este e-mail foi enviado automaticamente pelo sistema. Por gentileza não responda.</small></i>";

                break;
         
    	}
    	
        $getmailop = "SELECT EMAIL FROM VOLUNTARIOS WHERE (AREA <> 'clinica' AND AREA <>'anuncios') AND STATUS_APROV='Aprovado'";
        $selectmailop = mysqli_query($connect,$getmailop); 
         
        $bodytext = $message;
        
        $mail->Subject   = $subject;
        $mail->Body      = $bodytext;
        $mail->IsHTML(true);
        while ($fetchmailop = mysqli_fetch_row($selectmailop)) {
            $to = $fetchmailop[0];
            $mail->AddAddress($to);
            if (!$mail->send()) {
                $log_file_msg="[criaevento.php] Erro de envio de evento: Mailer Error: " . $mail->ErrorInfo." às ".$horaatu."\n";
                $fp = fopen($log_file, 'a');//opens file in append mode  
                fwrite($fp, $log_file_msg);  
            } else {
                $log_file_msg="[criaevento.php] Envio de evento para ".$to." às ".$horaatu."\n";
                $fp = fopen($log_file, 'a');//opens file in append mode  
                fwrite($fp, $log_file_msg);  
            }
            $mail->clearAddresses();
        }
        
        /* E-MAIL PARA O RESPONSÁVEL */ 
	
       $log_file_msg="[criaevento.php] Evento criado:  ".$evento." Data: ".$dtevento."  às ".$horaatu."\n";
       fwrite($fp, $log_file_msg);  
    }else{ 
    	echo "Insert code: ".$insert;
    	echo "Mensagem de erro: ".mysql_error(). "SQL Error: ".mysql_errno();
    	echo "Erro ao cadastrar <br><br>";
    	echo "<a href='formcriaevento.php'>Voltar</a>";
      /*echo"<script language='javascript' type='text/javascript'>
      alert('Erro ao cadastrar');window.location
      .href='termo.php'</script>";*/
    }
//}

fclose($fp); 
mysqli_close($connect);
?>
