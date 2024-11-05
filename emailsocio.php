<?php

session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$parm = $_GET['email'];

if ($parm =='') {
    $query = "SELECT * FROM SOCIO WHERE RECEBER_LEMBRETE = 'Sim' AND EMAIL <> '' AND (CPF <> '0' OR CPF <> '')";    
    $send_now = False;
} else {
    $query = "SELECT * FROM SOCIO WHERE EMAIL ='$parm'";   
    $send_now = True;
    
}

echo "<br> query: ".$query;

$select = mysqli_query($connect,$query);

while ($fetch = mysqli_fetch_row($select)) {
    
	$id = $fetch[0];	
	$nome = $fetch[1];
	$email = $fetch[4];
	$valor = $fetch[5];
	$forma  = $fetch[6];
	$melhordia = $fetch[7];
	$melhordia_mais1 = intval($melhordia) +1;
	$lembrete = $fetch[8];
	$frequencia = $fetch[13];
	$cpf =  $fetch[14];

	/*var_dump($melhordia);*/
	
	$ano_atu = date('Y');
	$mes_atu = date('m');
	$mes_prox = date('m',strtotime('+1 months'));
	$dia_atu = date('d');
    $dt_atu = date("Y-m-d");
    $dt_atu_1 = date('Y-m-d', strtotime("+1 day"));
    $dt_atu_30 = date('Y-m-d', strtotime("+30 day"));
	
	$vencimento = $ano_atu ."-".$mes_atu."-".$melhordia;
	
	if ($mes_atu == '12'){
	    $ano_atu= $ano_atu + 1;
	    $mes_atu = '01';
	}

	/*echo "<br>";
	echo "<br> socio: ".$nome;
    echo "<br> vencimento: ".$vencimento;
    echo "<br> dt_atu_1: ".$dt_atu_1;
    echo "<br> dt_atu_30: ".$dt_atu_30;
    echo "<br> email: ".$email;
    echo "<br> forma: ".$forma;*/

    $vencimento_banco = $ano_atu ."-".$mes_atu."-".$melhordia;
    	
    $vencimentojd = gregoriantojd($mes_atu,$melhordia,$ano_atu);
    	
    $vencimento_bancojd = gregoriantojd($mes_atu,$melhordia,$ano_atu);
    	
    $dt_atujd = gregoriantojd($mes_atu,$dia_atu,$ano_atu);
    	
    $dia_boleto = (intval($vencimentojd) - intval($dt_atujd));
    	
    $dia_banco = (intval($vencimento_bancojd) - intval($dt_atujd));
    
	if ($send_now == 'True') {
	        $vencimento = $ano_atu ."-".$mes_atu."-".$melhordia_mais1;
	        $urlapi = 'https://ws.pagseguro.uol.com.br/recurring-payment/boletos?email=financeiro@gaarcampinas.org&token=02d20d8b-7da8-473d-8ee3-ab5ebf2ee77139322f674648953abadfe1d34196a2659026-757d-40e6-9ab8-d48b9de8fefb';
            $ch = curl_init($urlapi);
            $dadossocio = array("reference"=>"Boleto mensal", 
                                "firstDueDate"=>$vencimento, 
                                "numberOfPayments"=>01, 
                                "periodicity"=>"monthly", 
                                "amount"=>$valor, 
                                "instructions"=>"", 
                                "description"=>"Boleto mensal do GAAR", 
                                "customer"=>array(
                                    "document"=>array(
                                        "type"=>"CPF", "value"=>"$cpf"), 
                                "name"=>$nome,
                                "email"=>$email,
                                "phone"=>array(
                                        "areaCode"=>"19", "number"=>"32222222"),
                                "address"=>array(
                                        "postalCode"=>"13076270", "street"=>"0", "number"=>"0", "district"=>"0", "city"=>"Campinas", "state"=>"SP"),
                                        ) );
        
            $json_str = json_encode($dadossocio);
                               
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_str);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            $result = curl_exec($ch);
            echo "result: ".$result;
            
            $boletoRetorno = json_decode($result,true);
            echo "<br>BOLETORETORNO: ". $boletoRetorno;
            $linkpag = $boletoRetorno['boletos'][0]['paymentLink'];
            
            $rc_api = $boletoRetorno['errors'][0]['code'];
	} elseif (($vencimento >= $dt_atu_1) && ($vencimento <= $dt_atu_30) ) {
            	echo "<br>                         ";
            	echo "<br>nome: ".$nome;
            	echo "<br>forma: ".$forma;
                //echo "<br>dia banco: ".$dia_banco;
                echo "<br>dia boleto: ".$dia_boleto;
                echo "<br>vencimento: ".$vencimento;
                echo "<br>vencimento banco: ".$vencimento_banco;
                //echo "<br>vencimento jd: ".$vencimentojd;
                //echo "<br>vencimento banco jd: ".$vencimento_bancojd;
                //echo "<br> data atual jd: ".$vencimentojd; 
                
                switch ($forma) {
            	        case 'Boleto':
                         	if ($dia_bonenhleto == 1)  {
                                $urlapi = 'https://ws.pagseguro.uol.com.br/recurring-payment/boletos?email=financeiro@gaarcampinas.org&token=02d20d8b-7da8-473d-8ee3-ab5ebf2ee77139322f674648953abadfe1d34196a2659026-757d-40e6-9ab8-d48b9de8fefb';
                                $ch = curl_init($urlapi);
                                $dadossocio = array("reference"=>"Boleto mensal", 
                                                    "firstDueDate"=>$vencimento, 
                                                    "numberOfPayments"=>01, 
                                                    "periodicity"=>"monthly", 
                                                    "amount"=>$valor, 
                                                    "instructions"=>"", 
                                                    "description"=>"Boleto mensal do GAAR", 
                                                    "customer"=>array(
                                                        "document"=>array(
                                                            "type"=>"CPF", "value"=>"$cpf"), 
                                                    "name"=>$nome,
                                                    "email"=>$email,
                                                    "phone"=>array(
                                                            "areaCode"=>"19", "number"=>"32222222"),
                                                    "address"=>array(
                                                            "postalCode"=>"13076270", "street"=>"0", "number"=>"0", "district"=>"0", "city"=>"Campinas", "state"=>"SP"),
                                                            ) );
                            
                                $json_str = json_encode($dadossocio);
                                                   
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_str);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                                $result = curl_exec($ch);
                                echo "result: ".$result;
                                
                                $boletoRetorno = json_decode($result,true);
                                echo "<br>BOLETORETORNO: ". $boletoRetorno;
                                $linkpag = $boletoRetorno['boletos'][0]['paymentLink'];
                                
                                $rc_api = $boletoRetorno['errors'][0]['code'];
                                
                                ini_set('display_errors', 1);
                        
                                error_reporting(E_ALL);
                                
                                $headers = "MIME-Version: 1.0\n";               
                                $headers .= "Content-type: text/html; charset=utf-8\n";            
                                $headers .= "From: <{$from}> \r\n"; 
                                
                                $from = "financeiro@gaarcampinas.org";
                        		$to = $email;
        
                                switch ($rc_api) {
                                    case '15015':
                                		$subject = "[GAAR Campinas] Erro nos dados do seu cadastro";
                                		$message = "<p>
                        		
                        		            <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center><br>
                        		            
                        		            Olá ".$nome.", <br><br>
                        		
                        		            O boleto não foi gerado porque seu nome não está completo no cadastro. Por gentileza entre em contato com o financeiro respondendo esse e-mail. <br><br>
                        		            
                        		            <i>* Este e-mail foi enviado automaticamente pelo sistema do GAAR *</i>
                        		            ";
                                		
                                		mail($to, $subject, $message, $headers);
                                		
                                		$log_file_msg .="[emailsocio.php] Erro nos dados do cadastro de ".$nome." às ".$horaatu."\n";
                                        $fp = fopen($log_file, 'a');//opens file in append mode  
                                        fwrite($fp, $log_file_msg);  
                                		
                                        break;
                                    default:
                                        $ano_venc = substr($vencimento,0,4);
                        		        $mes_venc = substr($vencimento,5,2);
                        		        $dia_venc = substr($vencimento,8,2);
                        		        
                                        $subject = "[ GAAR Campinas ] Doação mensal - Vencimento em ".$dia_venc."-".$mes_venc."-".$ano_venc."";
                                		$message = "<p>
                        		
                        		            <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center><br>
                        		            
                        		            Olá ".$nome.", <br><br>
                        		
                        		            Você está recebendo essa notificação porque optou por receber um lembrete via e-mail de sua contribuição. <br> <br>
                        		            
                        		            <table>
                                                <tr>
                                                    <td align='left'>Melhor dia escolhido </td>
                                                    <td align='left'>: ".$melhordia."</td>
                                                </tr>
                                                <tr>
                                                    <td align='left'>Forma de ajudar </td>
                                                    <td align='left'>: ".$forma."</td>
                                                </tr>
                                                <tr>
                                                    <td align='left'>Vencimento do boleto em </td>
                                                    <td align='left'>: ".$dia_venc."/".$mes_venc."/".$ano_venc."</td>
                                                </tr>
                                                <tr>
                                                    <td align='left'>Link </td>
                                                    <td align='left'>: ".$linkpag."</td>
                                                </tr>
                                            </table>
                        		            
                        		            <br><br>
                        		            <i>Caso não deseje mais receber nosso lembrete, <a href='http://gaarcampinas.org/area/atualizasocio.php?id=".$id."&receber=Não&email=".$email."'>clique aqui</a></i>
                        		            
                        		            <br><br>
                        		            
                        		            * Este e-mail foi enviado automaticamente pelo sistema do GAAR *
                        		            ";
                                		
                                		mail($to, $subject, $message, $headers);
                                		
                                		$log_file_msg .="[emailsocio.php] Doação mensal enviada para ".$to." - Vencimento em ".$dia_venc."-".$mes_venc."-".$ano_venc." às ".$horaatu."\n";
                                        $fp = fopen($log_file, 'a');//opens file in append mode  
                                        fwrite($fp, $log_file_msg);  
                                		
                                		/* CÓPIA DO E-MAIL AO FINANCEIRO */
                                		
                                		$from = "admin@gaarcampinas.org";
                        		
                                		$to = "financeiro@gaarcampinas.org";
                                		
                                		$subject = "[GAAR Campinas] Boleto mensal enviado para ".$nome;
                                		
                                		$mensagem = "<center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br></center> <br>
                                		
                                		    Olá Diretoria Financeira, <br><br>
                                		
                                		    O boleto mensal para ".$nome." foi gerado e enviado para o e-mail ".$email.". Para acompanhar o status, acesse o Pagseguro<br>
                                		    
                                		    Link do boleto: ".$linkpag."<br><br>
                                		    
                                		    - Este e-mail foi enviado automaticamente de nosso sistema - "; 
                                		
                                		$headers = "MIME-Version: 1.0\n";               
                                		$headers .= "Content-type: text/html; charset=utf-8\n";            
                                		$headers .= "From: <{$from}> \r\n"; 
                                		$message = $mensagem ;
                                		
                                	    mail($to, $subject, $message, $headers);
                                
                                        if (isset($_GET['boleto'])) {
                                           boleto_sendjson($_GET['vencimento'],$_GET['valor'],$_GET['cpf'],$_GET['nome'],$_GET['email']);
                                        }
                                        
                                }
        
                                curl_close($ch);
                         	}
                
            	            break;
            	            
            	        default:
            	            if ($dia_banco == 2) {
            
                	            ini_set('display_errors', 1);
                        
                                error_reporting(E_ALL);
                                
                                $from = "financeiro@gaarcampinas.org";
                                
                        		$to = $email;
                        		
                        		$subject = "[ GAAR Campinas ] Lembrete de doação mensal";
                        		
                        		$message = "<p>
                        		
                        		            <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center><br>
                        		            
                        		            Olá ".$nome.", <br><br>
                        		
                        		            Você está recebendo esta notificação porque optou por receber um lembrete via e-mail de sua contribuição. <br> <br>
                        		            
                        		            <table>
                                                <tr>
                                                    <td align='left'>Melhor dia escolhido </td>
                                                    <td align='left'>: ".$melhordia."</td>
                                                </tr>
                                                <tr>
                                                    <td align='left'>Forma de ajudar </td>
                                                    <td align='left'>: ".$forma."</td>
                                                </tr>
                                            </table>
                        		            
                        		            <br><br>
                        		            <i>Caso não deseje mais receber nosso lembrete, <a href='http://gaarcampinas.org/area/atualizasocio.php?id=".$id."&receber=Não&email=".$email."'>clique aqui</a></i>
                        		            
                        		            <br><br>
                        		            
                        		            * Este e-mail foi enviado automaticamente pelo sistema do GAAR *
                        		            ";
                        		            
                        		$headers = "MIME-Version: 1.0\n";               
                        		$headers .= "Content-type: text/html; charset=utf-8\n";            
                        		$headers .= "From: <{$from}> \r\n"; 
                        		            
                        		mail($to, $subject, $message, $headers);
                        		
                        		$log_file_msg .="[emailsocio.php] Lembrete de doação mensal enviada para ".$to." às ".$horaatu."\n";
                                $fp = fopen($log_file, 'a');//opens file in append mode  
                                fwrite($fp, $log_file_msg); 
                        		
                        		/* NOTIFICAÇÃO PARA O FINANCEIRO */
                        		
                        		$from = "admin@gaarcampinas.org";
                        		
                        		$to = "financeiro@gaarcampinas.org";
                        		
                        		$subject = "[GAAR Campinas] Lembrete de doação mensal enviado para ".$nome;
                        		
                        		$mensagem = "<center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br></center> <br>
                        		
                        		    Olá Diretoria Financeira, <br><br>
                        		
                        		    O lembrete de doação mensal para ".$nome." foi gerado e enviado para o e-mail ".$email.". <br>
                        		    
                        		    - Este e-mail foi enviado automaticamente de nosso sistema - "; 
                        		
                        		$headers = "MIME-Version: 1.0\n";               
                        		$headers .= "Content-type: text/html; charset=utf-8\n";            
                        		$headers .= "From: <{$from}> \r\n"; 
                        		$message = $mensagem ;
                        		
                        		mail($to, $subject, $message, $headers);
            	            }
            	            break;
            	    }
            	    
            	}

}

fclose($fp); 
mysqli_close($connect);

?>