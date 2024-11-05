<?php 

session_start();

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

/*// incluir a funcionalidade do recaptcha
require_once ("recaptchalib.php");

// definir a chave secreta
$secret = "6LcwZ7oUAAAAAGQaqFS4tYQrrvGjPAAoqf_WQTJ6";

// verificar a chave secreta
$response = null;
$reCaptcha = new ReCaptcha($secret);

if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
}

// deu tudo certo?
if ($response != null && $response->success) {*/

$nome = $_POST['nome'];
$email =  strtolower ( $_POST['email']);
$dtnascimento = $_POST['dtnascimento'];
$celular= $_POST['celular'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$como_ajudar = $_POST['como_ajudar'];
$como_pode_ajudar = $_POST['como_pode_ajudar'];
$spam = $_POST['spam'];

if ($spam ==''){
					
				$ano_dtnascvol = substr($dtnascimento,0,4);
				
				$ano_atu = date("Y");
				
				$tmp = intval($ano_atu) - intval($ano_dtnascvol) ;
				
				if (($tmp == $ano_atu) || ($ano_dtnascvol == '')) {
				    echo"<script language='javascript' type='text/javascript'>
        				  alert('Por gentileza preencha a data de nascimento correta');
        				  window.location.href='http://gaarcampinas.org'</script>";
				} else {
				    if ($tmp >= '16') {
				        $query = "INSERT INTO FORM_VOLUNTARIO (NOME,CIDADE,DATA_NASC,TEL_CELULAR,EMAIL,COMO_AJUDAR,COMO_PODE_AJUDAR,BAIRRO,STATUS_APROV) VALUES ('$nome','$cidade','$dtnascimento','$celular','$email','$como_ajudar','$como_pode_ajudar','$bairro','0')";
        				$insert = mysqli_query($connect,$query);
        				
        				/*echo "Insert code: ".$insert;
                	    echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
        				
        		        if(mysqli_errno($connect) == '0'){
        		            
        				    echo"<script language='javascript' type='text/javascript'>
        				    alert('Cadastro realizado com sucesso! Em breve retornaremos o contato');
        				    window.location.href='http://gaarcampinas.org'</script>";
            					
            				$bodytext = "Olá, ".$nome." <br><br> Ficamos felizes pelo seu contato em ser voluntário do GAAR! <br><br>Pedimos que, por gentileza, aguarde nosso próximo contato :) <br><Br> Atenciosamente, <br> Equipe GAAR <br><br> ****Este e-mail foi enviado automaticamente pelo nosso sistema****";
            				
            				$subject = "Resposta do contato feito pelo site do GAAR. Assunto: Quero ser voluntário";
            				
            				$mail->Subject   = $subject;
                            $mail->Body      = $bodytext;
                            $mail->IsHTML(true);
                            $to = $email;
                            $mail->AddAddress($to);
                            //send the message, check for errors
                            if (!$mail->send()) {
                                $log_file_msg="[cadastrointeressevoluntario.php] Erro de envio de e-mail para o interessado ".$to." às ".$horaatu."\n";
                                $fp = fopen($log_file, 'a');//opens file in append mode  
                                fwrite($fp, $log_file_msg);  
                                fclose($fp); 
                            } else {
                                $log_file_msg="[cadastrointeressevoluntario.php] Envio de e-mail realizado com sucesso para o interessado ".$to." às ".$horaatu."\n";
                                $fp = fopen($log_file, 'a');//opens file in append mode  
                                fwrite($fp, $log_file_msg);  
                                fclose($fp); 
                            }
            				$mail->clearAddresses();
            				
            				/*E-mail a ser enviado à diretoria */

            				switch ($como_ajudar) {
            				    case 'Feiras de adoção':
            				        $to = "feiradeadocao@gaarcampinas.org";
                    				break;
            				    case 'Lar temporário':
            				    case 'Carona solidária':
            				    case 'Cuidado com os animais':
                    				$to = "operacional@gaarcampinas.org";
                    				break;
                    				
                    			case 'Bazar':
                    				$to = "bazar@gaarcampinas.org";
                    				break;
                    			
                    			default:
                    			    $to = "captacao@gaarcampinas.org";
        
                    			    break;
            				    
            				} 
                			
                				
            				$bodytext = "Olá! <br> Recebemos o formulário de interesse de ".$nome." em ser voluntário. <br><br> Seguem os dados para contato: <br><Br> 
                				    E-mail: ".$email." <br>
                				    Celular ".$celular." <br>
                				    Cidade: ".$cidade." <br>
                				    Área de interesse em ajudar: ".$como_ajudar." <br>
                				    Como pode ajudar: ".$como_pode_ajudar." <br><br>
                				    
                				    Essas informações também estarão armazenadas na área restrita. <br>
                				    1. Acesse: http://gaarcampinas.org/area/login.html <br>
                				    2. Menu Captação<br>
                				    3. Menu Candidatos à voluntários <br><br>
                				    
                				    <i>****Este e-mail foi enviado automaticamente pelo nosso sistema****</i>";
                				
                			$subject = "".$nome." quer ser voluntário(a) em ".$como_ajudar."";
    
        				    $mail->Subject   = $subject;
                            $mail->Body      = $bodytext;
                            $mail->IsHTML(true);
                            $mail->AddAddress($to);
                            $mail->AddReplyTo($email);
                            $mail->AddBCC("thaise.piculi@gmail.com");
                            
                            //send the message, check for errors
                            if (!$mail->send()) {
                                $log_file_msg="[cadastrointeressevoluntario.php] Erro de envio de e-mail para ".$to." às ".$horaatu."\n";
                                $fp = fopen($log_file, 'a');//opens file in append mode  
                                fwrite($fp, $log_file_msg);  
                                fclose($fp); 
                            } else {
                                $log_file_msg="[cadastrointeressevoluntario.php] Envio de e-mail realizado com sucesso para ".$to." às ".$horaatu."\n";
                                $fp = fopen($log_file, 'a');//opens file in append mode  
                                fwrite($fp, $log_file_msg);  
                                fclose($fp); 
                            }
            				$mail->clearAddresses();
        				
        		        }else{ 
        				  echo"<script language='javascript' type='text/javascript'>
        				  alert('Erro ao cadastrar');
        				  window.location.href='http://gaarcampinas.org'</script>";
        				}
				    } else {
				        echo"<script language='javascript' type='text/javascript'>
        				  alert('Cadastro não enviado - menor de 16 anos ou data inválida');
        				  window.location.href='http://gaarcampinas.org'</script>";
				    }
				    
				}
}
mysqli_close($connect);

?>