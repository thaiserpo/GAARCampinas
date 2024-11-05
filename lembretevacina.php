<?php

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
		
$idpet = $_GET['idanimal'];
$parm = $_GET['parm'];

if ($idpet <> '') {
    $query = "SELECT * FROM ANIMAL WHERE ID = '$idpet'";
} else {
    $query = "SELECT * FROM ANIMAL WHERE ADOTADO <> 'Óbito' AND ADOTADO not like '%Adotado%' AND (DIVULGAR_COMO ='GAAR' OR DIVULGAR_COMO='LEG')";
}

$select = mysqli_query($connect,$query); 	
$reccount = mysqli_num_rows($select);

$enviarmail = 0;

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");

$data_atu = date("Y-m-d");

$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$dtatu_format = date("d-m-Y");

$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);

if ($reccount <> "0") {
    $mail = new PHPMailer();
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->CharSet = 'UTF-8';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
    $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
    
    $header = " <!DOCTYPE html>
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
                                        <h3>LEMBRETES DE VACINAS</h3><br>
                                    </center>
                                    
                                    <br>
                                    <p> Olá, <br> Seguem os lembretes de vacina. Para atualizar a data acesse o perfil do animal no sistema ou responda esse e-mail com a atualização do status: se foi vacinado ou não.<br><br>
                                        Observações: <br>
                                        - A data da próxima vacinação dos filhotes com idade menor que 4 meses e doses menores que 3 está sendo calculada com intervalo de 21 dias;<br>
                                        - A data da próxima vacinação dos filhotes com idade maior que 4 meses está sendo calculada com intervalo de 365 dias;<br>
                                        - A data da próxima vacinação dos adultos com idade maior que 1 ano está sendo calculada com intervalo de 365 dias; <br>
                                        - O lembrete está sendo enviado ao responsável pelo animal cadastrado no sistema; <br><Br></p>
                                        <table border='1' style='border-color: black;'>
                                        <thead style='background-color: #1e81b0; color: white; font-weight: bold; font-size: 11px;'>
                        						  <tr>
                        						    <th scope='col'>ID</th>
                        							<th scope='col'>NOME DO ANIMAL</th>
                        							<th scope='col'>ESPÉCIE</th>
                        							<th scope='col'>LAR TEMPORÁRIO</th>
                    				 		  	    <th scope='col'>DATA DA ÚLTIMA VACINAÇÃO</th>
                    				 		  	    <th scope='col'>DOSES</th>
                        							<th scope='col'>PRÓXIMA VACINAÇÃO</th>
                    						   </tr>
                        				 </thead>
                        				 <tbody style='font-size: 11px;'>";
            	                  
    
    $bodytext = $header;
    
    while ($fetch = mysqli_fetch_row($select)) {
    
        //$emailadotante = 0;
        //$resp = 0;
        
        $idanimal = $fetch[0];
        $nomedoanimal = $fetch[1];
        $especie =$fetch[2]; 
        $idade = $fetch[3];
        $lt = $fetch[11];
        $dtvacina_poli = $fetch[30];
        $doses = $fetch[22];
        $castrado = $fetch[7];
        $dtcastracao = $fetch[8];
        $status = $fetch[10];
        $resp = $fetch[12];
        
        // E-MAIL DO RESPONSÁVEL
        $queryresp = "SELECT EMAIL FROM VOLUNTARIOS WHERE NOME='$resp'"; 
        $selectresp = mysqli_query($connect,$queryresp);
        $rc = mysqli_fetch_row($selectresp);
        $emailresp = $rc[0];
        
        $ano_poli = substr($dtvacina_poli,0,4);
        $mes_poli = substr($dtvacina_poli,5,2);
        $dia_poli = substr($dtvacina_poli,8,2);
        
        $ano_idade = substr($idade,0,4);
        $mes_idade = substr($idade,5,2);
        $dia_idade = substr($idade,8,2);
        
        /* CONVERSAO DATA GREG TO JD */
        $dtvacina_poli_jul = gregoriantojd($mes_poli,$dia_poli,$ano_poli);
        
        /* CONVERSAO IDADE */ 
        
        $idade_jul = gregoriantojd($mes_idade,$dia_idade,$ano_idade);
        
        /* CALCULO DE DIAS IDADE */
        
        $dias_idade = intval($data_atu_jul) - intval($idade_jul);
    
        echo "<br> nome do animal: ".$nomedoanimal;
        echo "<br> dias idade: ".$dias_idade;
        /* CALCULO DE DIAS */
        
        // Create a new DateTime object from the original date
        $date = new DateTime($dtvacina_poli);
        
        // Add days to the date
        if ($dias_idade <"120" && $doses < "3" ) {
            $date->modify('+21 days');   
        } elseif ($dias_idade > "120") {
            $date->modify('+365 days'); 
        }
        // Format the date in the desired format (optional)
        $dtvacina_prox = $date->format('Y-m-d');
        
        echo "<br> prox vacina: ".$dtvacina_prox;
        
        $ano_proxvacina = substr($dtvacina_prox,0,4);
        $mes_proxvacina = substr($dtvacina_prox,5,2);
        $dia_proxvacina = substr($dtvacina_prox,8,2);
    
        $dtvacina_prox_jul = gregoriantojd($mes_proxvacina,$dia_proxvacina,$ano_proxvacina);
        
        $qtddiasvacina_poli = intval($data_atu_jul) - intval($dtvacina_prox_jul);
        
        if ($qtddiasvacina_poli == 7) {
            
            $enviarmail = "Y";
            
            $bodytext .="
                    	            <tr>
                    	                <td>".$idanimal."</td>
                    	                <td>".$nomedoanimal."</td>
                    	                <td>".$especie."</td>
                    	                <td>".$lt."</td>
                    				    <td>".$dia_poli."/".$mes_poli."/".$ano_poli."</td>
                    				    <td>".$doses."</td>
                    				    <td style='color: red;'>".$dia_proxvacina."/".$mes_proxvacina."/".$ano_proxvacina."</td>
                    				</tr>";
                    				
            $subject = "[GAAR Campinas] Lembrete de vacinas para o dia ".$dia_proxvacina."/".$mes_proxvacina."/".$ano_proxvacina."";
            
            
        }
            
        }
    
    $footer = "</tbody>
            	                  </table>
                                  </font>
                                  </body>
                                  </html>";
    $bodytext .= $footer;
    
    
    echo "<br> enviar email: ".$enviarmail;
    
    if ($enviarmail == "Y") {
        /* E-MAIL PARA O RESPONSÁVEL */ 
        $mail->Subject   = $subject;
        $mail->Body      = $bodytext;
        $mail->IsHTML(true);
        $to = $emailresp;
        //$to="thaise.piculi@gmail.com";
        $lista_email = $emailresp;
        $mail->AddAddress($to);
        $mail->AddBCC("thaise.piculi@gmail.com");
        $lista_email .= ",thaise.piculi@gmail.com";
        $mail->AddBCC("leka.kamimura@gmail.com");
        $lista_email .= ",leka.kamimura@gmail.com";
        $mail->AddReplyTo("thaise.piculi@gmail.com");
        
        if ($especie =="Felina") { /* ENVIAR TAMBEM À CPG */
            $querycpg = "SELECT EMAIL FROM VOLUNTARIOS WHERE CPG='Sim'";
            $selectcpg = mysqli_query($connect,$querycpg);
            while ($fetchcpg = mysqli_fetch_row($selectcpg)) {
                $emailcpg = $fetchcpg[0];
                //$mail->AddBCC($emailcpg);
                $lista_email .= $emailcpg;
            }
        }
        if (!$mail->send()) {
            $log_file_msg .="[enviorelatoriocpg.php] Erro no envio de lembrete de vacina: ".$mail->ErrorInfo." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
        } else {
            $log_file_msg .="[enviorelatoriocpg.php] Envio de lembrete de vacina para ".$lista_email." - ID: ".$idanimal." animal ".$nomedoanimal." às ".$horaatu."\n"; 
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
            echo $bodytext;
        } 
    }
    /*if ($dtvacina_poli < 0) {
    $bodytext ="";
    
    $subject = "[Operacional] A data da vacinação do(a) ".$nomedoanimal." está atrasada";
    
    $bodytext = "<p>Olá ".$resp.", <br><br>
    
                 Identificamos que a data de vacinação do(a) ".$nomedoanimal." está atrasada.  <br><br>
                 
                 A data prevista é ".$dia_poli."/".$mes_poli."/".$ano_poli.". <br><br>
                 
                 Código do animal: ".$idanimal."<br><br>
                 
                 Para atualizar a data e não receber mais os e-mails por gentileza acesse o perfil do animal no sistema ou responda esse e-mail com a atualização do status: se foi vacinado ou não.<br><br>
                 
                 Equipe GAAR<br>
                 <i> Este e-mail foi enviado automaticamente pelo sistema </i></p>";
    }*/
    
    /*$log_file_msg="[lembretevacina.php] Lembrete de vacina enviado às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);  */

}

fclose($fp); 

mysqli_close($connect);
		
?>