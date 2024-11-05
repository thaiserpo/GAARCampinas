<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');
require_once('/home1/gaarca06/public_html/area/fpdf/fpdf.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/*function pesquisa_vet($idvet,$connect){
				$queryvet = "SELECT CLINICA,EMAIL FROM CLINICAS WHERE ID='$idvet'";
				$resultvet = mysqli_query($connect,$queryvet);
				$rc= mysqli_fetch_row($resultvet);
				$tmpvet = $rc[0];
				$emailvet=$rc[1];
											
				return($tmpvet);

}*/

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$mes_ant = date('m',strtotime('-1 months'));
$dia_prox = date('d', strtotime("+1 day"));
$dia_expiracao = date('Y-m-d', strtotime("+2 days"));

if ($dia_prox == '01') {
    $mes_atu = date("m",strtotime('+1 month'));
}
if ($dia_prox == '31' && $mes_atu=='12') {
    $ano_atu = date("Y",strtotime('+1 year'));
}

$qtd_dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes_atu, $ano_atu); 

$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$queryvet = "SELECT ID,CLINICA, EMAIL FROM CLINICAS";
$resultvet = mysqli_query($connect,$queryvet);
$rc= mysqli_fetch_row($resultvet);

$bodytext = "<!DOCTYPE html>
                            <html lang='pt-br'>
                              <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                                
                                <!-- Bootstrap CSS -->
                                
                                <link rel='stylesheet' media='all' href='/assets/application-mailer-dbc5154d3c4160e8fa7ef52fa740fa402760c39b5d22c8f6d64ad5999499d263.css' />
                                
                                <link rel='stylesheet' type='text/css' href='style-area.css'/>
        
                                <link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>
                                
                              </head>
                              
                            <body>
                            <font face='verdana'> 
    				        <div class='d-none d-print-block'>
                                <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center>
                            </div>
            			       <center>
                                    <h3>RELATÓRIO DIÁRIO DE AGENDAMENTOS</h3><br>
                                </center>
                                
                                <br>
                                <p> Olá, <br> Segue o relatório dos procedimentos veterinários agendados para ".$dia_prox."/".$mes_atu."/".$ano_atu." e que estão cadastrados no sistema. ";
                                
$header = "                     <br><br>
                                                
                                                <table border='1' style='border-color: black;'>
                                                <thead style='background-color: #154c79; color: white; font-weight: bold; font-size: 11px;'>
                                						  <tr>
                                							<th scope='col' colspan='5'>DADOS DO AGENDAMENTO</th>
                                							<th scope='col' colspan='6'>DADOS DO ANIMAL</th>
                                							<th scope='col' colspan='2'>DADOS DO RESPONSÁVEL</th>
                                						    
                                						   </tr>
                                				</thead> 
                                                <thead style='background-color: #1e81b0; color: white; font-weight: bold; font-size: 11px;'>
                                						  <tr>
                                						    <th scope='col'>CÓDIGO</th>
                                							<th scope='col'>DATA</th>
                                							<th scope='col'>HORA</th>
                                							<th scope='col'>VALOR A SER PAGO</th>
                            				 		  	    <th scope='col'>EXPIRA EM</th>
                                							<th scope='col'>NOME</th>
                                							<th scope='col'>ESPÉCIE</th>
                                							<th scope='col'>SEXO</th>
                                							<th scope='col'>PORTE</th>
                                							<th scope='col'>NASC.</th>
                                							<th scope='col'>PESO</th>
                            				 		  	    <th scope='col'>NOME</th>
                            				 		  	    <th scope='col'>TELEFONE</th>
                            						   </tr>
                            				 </thead>
                            				 <tbody style='font-size: 11px;'>";

$footer = "</tbody>
        	                  </table>
        	  <br>";
        	                  
        	                  
                                    
$footer_2 =" <br>Olá veterinário, <br><br> Esta notificação é automática e será enviada diariamente caso tenha agendamento cadastrado para o dia seguinte. <br>Em caso de dúvidas, entre em contato com os voluntários do GAAR ou responda esse e-mail.</p>
                              </font>
                              </body>
                              </html>";

$bodytextvet .= $bodytext;

while ($fetchvet = mysqli_fetch_row($resultvet)) {
    
        $idclinica = $fetchvet[0];
        $clinica = $fetchvet[1];
        $emailclinica = $fetchvet[2];
        
        $queryagenda = "SELECT * FROM AGENDAMENTO WHERE DATA_AG = '".$ano_atu."-".$mes_atu."-".$dia_prox."' AND CLINICA='$idclinica' AND ATIVO='SIM'";
        $resultagenda = mysqli_query($connect,$queryagenda);
        $reccountagenda = mysqli_num_rows($resultagenda);
        //$fetchagenda = mysqli_fetch_row($resultagenda);
        
        $bodytextvet = "";
            
        if ($reccountagenda != '0') {
            $bodytextvet .= "<br>".$header;
            while ($fetchagenda = mysqli_fetch_row($resultagenda)) {
                $nomedoanimal = $fetchagenda[3];
                $especie = $fetchagenda[4];
                $sexo = $fetchagenda[5];
                $porte = $fetchagenda[6];
                $idade = $fetchagenda[8];
                $peso = $fetchagenda[7];
                $codigoautoriza = $fetchagenda[0];
                $data_ag = $fetchagenda[1];
                $horario_ag = $fetchagenda[2];
                $resp = $fetchagenda[9];
                $tmptelresp = $fetchagenda[11];
                $valorajuda = $fetchagenda[13];
                $valorgaar = $fetchagenda[14];
                $tipoproc = $fetchagenda[20];
                
                $telresp = sprintf("(%s) %s-%s", substr($tmptelresp, 0, 2), substr($tmptelresp, 2, 4), substr($tmptelresp, 6, 4));
                
                $ano_idade = substr($idade,0,4);
        	    $mes_idade = substr($idade,5,2);
        	    $dia_idade = substr($idade,8,2);
        	    
        	    $ano_agenda = substr($data_ag,0,4);
        	    $mes_agenda = substr($data_ag,5,2);
        	    $dia_agenda = substr($data_ag,8,2);
        	    
        	    $ano_expira = substr($dia_expiracao,0,4);
        	    $mes_expira = substr($dia_expiracao,5,2);
        	    $dia_expira = substr($dia_expiracao,8,2);
                
                //$clinica = pesquisa_vet($idclinica,$connect);
                
                $bodytextvet .="
                	            <tr>
                	                <td style='color: red;'><strong>".$codigoautoriza."</strong></td>
                				    <td>".$dia_agenda."/".$mes_agenda."/".$ano_agenda."</td>
                				    <td>".$horario_ag."</td>
                				    <td>R$ ".number_format($valorajuda, 2, ',', '.')."</td>
                				    <td>".$dia_expira."/".$mes_expira."/".$ano_expira."</td>
                		            <td>".$nomedoanimal."</td>
                        			<td>".$especie."</td>
                					<td>".$sexo."</td>
                					<td>".$porte."</td>
                					<td>".$dia_idade."/".$mes_idade."/".$ano_idade."</td>
                				    <td>".$peso." kg</td>
                				    <td>".$resp."</td>
                				    <td><input type='tel' pattern='(99) 9999-9999' value='".$telresp."'></td>
                				</tr>";
                
            } 
            $bodytextvet .= $footer;
            $bodytextvet .= $footer_2;
            
            $subjectvet = "[GAAR Campinas] Agendamentos do dia ".$dia_agenda."/".$mes_agenda."/".$ano_agenda." - ".$clinica."";
    
            $mail = new PHPMailer();
            $mail->CharSet = 'UTF-8';
            $mail->SetFrom('castracao@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
            $mail->IsHTML(true);
            $mail->Subject   = $subjectvet;
            $mail->Body      = $bodytextvet;
            $to = $emailclinica;
            //$to = "thaise.piculi@gmail.com";
            $mail->AddAddress($to);
            $to_bcc = "castracao@gaarcampinas.org";
            $mail->AddBCC($to_bcc);
            
            if (!$mail->send()) {
                $log_file_msg ="[enviorelatorioagenda.php] Erro no envio de relatório dos agendamentos: ".$mail->ErrorInfo." às ".$horaatu."\n";
                $fp = fopen($log_file, 'a');//opens file in append mode  
                fwrite($fp, $log_file_msg);  
            } else {
                $log_file_msg ="[enviorelatorioagenda.php] Envio de relatório dos agendamentos para ".$to.",".$to_bcc." às ".$horaatu."\n"; 
                echo $log_file_msg;
                $fp = fopen($log_file, 'a');//opens file in append mode  
                fwrite($fp, $log_file_msg);  
                $mail->clearAddresses();
                //$to = "thaise.piculi@gmail.com";
                //$mail->AddAddress($to);
                $mail->send();
            }
            
            $mail->clearAddresses();
            
        } else {
            $log_file_msg ="[enviorelatorioagenda.php] Nenhum agendamento cadastrado - ".$horaatu."\n"; 
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
        }
    
}


//E-MAIL PARA OS VOLUNTÁRIOS DA CASTRAÇÃO

/*$bodytext .= $header;

$queryagendavol = "SELECT * FROM AGENDAMENTO WHERE DATA_AG = '".$ano_atu."-".$mes_atu."-".$dia_prox."'";
$resultagendavol = mysqli_query($connect,$queryagendavol);
$reccountagendavol = mysqli_num_rows($resultagendavol);
//$fetchagenda = mysqli_fetch_row($resultagenda);

if ($reccountagendavol != '0') {
    
while ($fetchagendavol = mysqli_fetch_row($resultagendavol)) {
    $nomedoanimal = $fetchagendavol[3];
    $especie = $fetchagendavol[4];
    $sexo = $fetchagendavol[5];
    $porte = $fetchagendavol[6];
    $idade = $fetchagendavol[8];
    $peso = $fetchagendavol[7];
    $codigoautoriza = $fetchagendavol[0];
    $data_ag = $fetchagendavol[1];
    $horario_ag = $fetchagendavol[2];
    $resp = $fetchagendavol[9];
    $telresp = $fetchagendavol[11];
    $valorajuda = $fetchagendavol[13];
    $valorgaar = $fetchagendavol[14];
    $tipoproc = $fetchagendavol[20];
    
    $ano_idade = substr($idade,0,4);
    $mes_idade = substr($idade,5,2);
    $dia_idade = substr($idade,8,2);
    
    $ano_agenda = substr($data_ag,0,4);
    $mes_agenda = substr($data_ag,5,2);
    $dia_agenda = substr($data_ag,8,2);
    
    $ano_expira = substr($dia_expiracao,0,4);
    $mes_expira = substr($dia_expiracao,5,2);
    $dia_expira = substr($dia_expiracao,8,2);
    
    $bodytext .="
    	            <tr>
    	                <td style='color: red;'><strong>".$codigoautoriza."</strong></td>
    				    <td>".$dia_agenda."/".$mes_agenda."/".$ano_agenda."</td>
    				    <td>".$horario_ag."</td>
    		            <td>".$nomedoanimal."</td>
            			<td>".$especie."</td>
    					<td>".$sexo."</td>
    					<td>".$porte."</td>
    					<td>".$dia_idade."/".$mes_idade."/".$ano_idade."</td>
    				    <td>".$peso." kg</td>
                        <td>R$ ".number_format($valorajuda, 2, ',', '.')."</td>
    				    <td>".$tipoproc."</td>
    				    <td>".$dia_expira."/".$mes_expira."/".$ano_expira."</td>
    				    <td>".$clinica."</td>
    				    <td>".$resp."</td>
    				    <td>".$telresp."</td>
    				</tr>";
    
} 

$bodytext .= $footer; //fecha a tabela

$footer_2 =" <br>Olá voluntário, <br><br> Esta notificação é automática e será enviada diariamente caso tenha agendamento cadastrado para o dia seguinte. <br>Cada veterinário recebeu os seus agendamentos por e-mail também.</p>
                              </font>
                              </body>
                              </html>";

$bodytext .= $footer_2;

$subject = "[GAAR Campinas] Agendamentos dos procedimentos do dia ".$dia_agenda."/".$mes_agenda."/".$ano_agenda."";
            
$mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
$mail->IsHTML(true);
$mail->Subject   = $subject;
$mail->Body      = $bodytext;
//$to = "castracao@gaarcampinas.org";
$to ="thaise.piculi@gmail.com";
$mail->AddAddress($to);
$to_bcc = "thaise.piculi@gmail.com";
$mail->AddBCC($to_bcc);

if (!$mail->send()) {
    $log_file_msg .="[enviorelatorioagenda.php] Erro no envio de relatório dos agendamentos para a clínica: ".$mail->ErrorInfo." às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);  
} else {
    $log_file_msg .="[enviorelatorioagenda.php] Envio de relatório dos agendamentos para a clínica ".$to." às ".$horaatu."\n"; 
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);  
}

}
*/
fclose($fp); 
mysqli_close($connect);
		
		
?>