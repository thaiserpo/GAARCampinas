<?php 

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');
require_once('/home1/gaarca06/public_html/area/fpdf/fpdf.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/*$to = "thaise.piculi@gmail.com";*/

$mes_ant = date('m',strtotime('-1 months'));
$mes_atu =  date('m');
$ano_atu = date('Y');

$reccount = 0;

//$querylt = "SELECT * FROM LT WHERE ESPECIES LIKE '%gatos%' ORDER BY LAR_TEMPORARIO ASC";
$query = "SELECT * FROM ANIMAL WHERE ESPECIE='Felina' AND DIVULGAR_COMO='GAAR' AND (ADOTADO <>'Óbito' AND ADOTADO NOT LIKE '%Adotado%') ORDER BY LAR_TEMPORARIO ASC";
$result = mysqli_query($connect,$query);
$reccount = mysqli_num_rows($result);

if ($reccount <> '0') {
    
    $bodytext = "<!DOCTYPE html>
    <html lang='pt-br'>
    <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <!-- Meta tags Obrigatórias -->
    
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
    
    <link rel='stylesheet' type='text/css' href='style-area.css'/>
    
    <link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>
    
    <!-- Custom styles for this template -->
    <link href='navbar.css' rel='stylesheet'>
    
    <title>GAAR - Relatório dos lares temporários</title>
    
    </head>
    <body>
    <main role='main' class='container'>
    <p>
    <div class='starter-template'>
        <center>
            <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'>
            <h3>RELATÓRIO SEMANAL CPG </h3><br>
        <p> Segue o relatório para conferência dos animais em lares temporários <br><br>
        <div class='form-group row'>
          <table class='table' border='1'>
            <thead class='thead-light'>
				  <tr>
				    <th scope='col' colspan='1'>ID do animal</th>
				    <th scope='col' colspan='1'>Nome</th>
				    <th scope='col' colspan='1'>Sexo</th>
					<th scope='col' colspan='1'>LT</th>
					<th scope='col' colspan='1'>Responsável</th>
					<th scope='col' colspan='1'>Status</th>
					<th scope='col' colspan='1'>Entrada no lt</th>
			      </tr>
		    </thead>
            <tbody>";
                
    while ($fetch = mysqli_fetch_row($result)) {
            $idpet = $fetch[0];
            $nomedoanimal = $fetch[1];
            $sexo = $fetch[4];
            $lt = $fetch[11];
            $resp=$fetch[12];
            $status = $fetch[10];
            $entradalt = $fetch[13];
            
            $bodytext .="<tr>
    	     <td>".$idpet."</td>
    	     <td>".$nomedoanimal."</td>
    	     <td>".$sexo." </td> 
    	     <td>".$lt."</td>
    	     <td>".$resp."</td>
    	     <td>".$status."</td> 
    	     <td>".$entradalt."</td> 
    	    </tr>";
    }
    
    $bodytext .="</tbody>
    	             </table>
    	            </div>
    				</tbody>
    			</table>
            </div>
            <small> Este e-mail foi gerado automaticamente pelo sistema.</small>
            </center>
    </body>
    </html>";
    
    $subject = "[GAAR Campinas] Relatório semanal da CPG";
    
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
    $mail->IsHTML(true);
    
    $mail->Subject   = $subject;
    $mail->Body      = $bodytext;
    $to = "contato@gaarcampinas.org";
    $mail->AddAddress($to);
    $to_cpg = "thaise.piculi@gmail.com";
    $mail->AddBCC($to_cpg);
    
    $querymail = "SELECT EMAIL FROM VOLUNTARIOS WHERE CPG='SIM'";
    $selectmail = mysqli_query($connect,$querymail);
    
    while ($fetchmail = mysqli_fetch_row($selectmail)) {
        $to_cpg =$fetchmail[0];
        $mail->AddBCC($to_cpg);
        $lista_email .=", ".$to_cpg;
    }
    
    if (!$mail->send()) {
        $log_file_msg .="[enviorelatoriocpg.php] Erro no envio de relatório da CPG: ".$mail->ErrorInfo." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);  
    } else {
        $log_file_msg .="[enviorelatoriocpg.php] Envio de relatório da CPG para ".$lista_email." às ".$horaatu."\n"; 
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);  
        echo $bodytext;
    } 
    
}
mysqli_close($connect);
            
?>
