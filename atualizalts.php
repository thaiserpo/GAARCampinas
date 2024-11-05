<?php 
session_start();


/* ATUALIZA A TABELA DE OS LARES TEMPORÁRIOS DE ACORDO COM OS ANIMAIS DISPONÍVEIS, LEG, E INDISPONÍVEIS */

include ("conexao.php"); 

$querylt_caes = "SELECT SUM(VAGAS_DISP) FROM LT WHERE ATIVO='Sim' AND ESPECIES ='Apenas cães'";
$selectlt_caes = mysqli_query($connect,$querylt_caes); 
$rc_caes = mysqli_fetch_row($selectlt_caes);
$vagas_disp_ant_caes = $rc_caes[0];

$querylt_gatos = "SELECT SUM(VAGAS_DISP) FROM LT WHERE ATIVO='Sim' AND ESPECIES ='Apenas gatos'";
$selectlt_gatos = mysqli_query($connect,$querylt_gatos); 
$rc_gatos = mysqli_fetch_row($selectlt_gatos);
$vagas_disp_ant_gatos = $rc_gatos[0];

$querylt_caesgatos = "SELECT SUM(VAGAS_DISP) FROM LT WHERE ATIVO='Sim' AND ESPECIES ='Cães e gatos'";
$selectlt_caesgatos = mysqli_query($connect,$querylt_caesgatos); 
$rc_caesgatos = mysqli_fetch_row($selectlt_caesgatos);
$vagas_disp_ant_ambos = $rc_caesgatos[0];

$querylt = "SELECT * FROM LT WHERE ATIVO='Sim' ORDER BY ESPECIES ASC ";
$selectlt = mysqli_query($connect,$querylt); 

$sum_vagas_disp_caes = 0;
$sum_vagas_disp_gatos = 0;
$sum_vagas_disp_ambos = 0;

ini_set('display_errors', 1);
        
error_reporting(E_ALL);

$from = "operacional@gaarcampinas.org";

$headers = "MIME-Version: 1.0\n";               
$headers .= "Content-type: text/html; charset=utf-8\n";            
$headers .= "From: <{$from}> \r\n";
$headers .= "Reply-To: <{$from}> \r\n";   


while ($fetchlt = mysqli_fetch_row($selectlt)) {
		$lt = $fetchlt[1];
		$voluntario = $fetchlt[12];
		$ativo = $fetchlt[18];
		$especies = $fetchlt[8];
		$qtde_vagas = $fetchlt[19];
		
		switch($especies){
		    case 'Apenas cães':
		        $especie = 'Canina';
		        $querydog = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO = '$lt' AND ESPECIE ='$especie' AND (ADOTADO='Disponível' OR ADOTADO='Indisponível') AND (DIVULGAR_COMO ='GAAR' OR DIVULGAR_COMO ='Controle Interno')";
		        $selectdog = mysqli_query($connect,$querydog); 	
    	        $reccountdog = mysqli_num_rows($selectdog);
    	        $caes = $reccountdog;
    	        $gatos = 0;
    	        $total = intval($caes) + intval($gatos);
    	        $vagas_disp = intval($qtde_vagas) - intval($total);
    	        $sum_vagas_disp_caes = intval($sum_vagas_disp_caes) + intval($vagas_disp);
    	        
		        break;
		    case 'Apenas gatos':
		        $especie = 'Felina';
		        $querycat = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO = '$lt' AND ESPECIE ='$especie' AND (ADOTADO='Disponível' OR ADOTADO='Indisponível')  AND (DIVULGAR_COMO ='Controle Interno' OR DIVULGAR_COMO ='GAAR' OR DIVULGAR_COMO='LEG')";
		        $selectcat = mysqli_query($connect,$querycat); 	
    	        $reccountcat = mysqli_num_rows($selectcat);
    	        $caes = 0;
    	        $gatos = $reccountcat;
    	        $total = intval($caes) + intval($gatos);
    	        $vagas_disp = intval($qtde_vagas) - intval($total);
    	        $sum_vagas_disp_gatos = intval($sum_vagas_disp_gatos) + intval($vagas_disp);

		        break;
		    case 'Cães e gatos':
		        $especie = 'Canina';
		        $querypet = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO = '$lt' AND ESPECIE ='$especie' AND (ADOTADO='Disponível' OR ADOTADO='Indisponível')  AND (DIVULGAR_COMO ='Controle Interno' OR DIVULGAR_COMO ='GAAR' OR DIVULGAR_COMO='LEG')";
		        $selectpet = mysqli_query($connect,$querypet); 	
    	        $reccount = mysqli_num_rows($selectpet);
    	        $caes = $reccount;
    	        $especie = 'Felina';
		        $querypet = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO = '$lt' AND ESPECIE ='$especie' AND (ADOTADO='Disponível' OR ADOTADO='Indisponível' OR ADOTADO='LEG')  AND (DIVULGAR_COMO ='Controle Interno' OR DIVULGAR_COMO ='GAAR')";
		        $selectpet = mysqli_query($connect,$querypet); 	
    	        $reccount = mysqli_num_rows($selectpet);
    	        $gatos = $reccount;
    	        $total = intval($caes) + intval($gatos);
    	        $vagas_disp = intval($qtde_vagas) - intval($total);
    	        $sum_vagas_disp_ambos = intval($sum_vagas_disp_ambos) + intval($vagas_disp);
		        break;
		}

        $query = "UPDATE LT
    					SET 
    					QTDE_CAES='$caes',
    					QTDE_GATOS='$gatos',
    					VAGAS_DISP='$vagas_disp'
    					WHERE 
    					LAR_TEMPORARIO  = '$lt'";
    					 				
        $insert = mysqli_query($connect,$query); 	

        if(mysqli_errno($connect) <> '0'){
    			echo "Insert code: ".$insert;
    			echo "Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);
        }
} 


echo "<br> vagas ant caes : ".$vagas_disp_ant_caes;
echo "<br> vagas atu caes : ".$sum_vagas_disp_caes;
echo "<br> vagas ant gatos: ".$vagas_disp_ant_gatos;
echo "<br> vagas atu gatos: ".$sum_vagas_disp_gatos;
echo "<br> vagas atu ambos: ".$sum_vagas_disp_ambos;

$sum_vagas_disp = intval($sum_vagas_disp_gatos) + intval($sum_vagas_disp_caes) + intval($sum_vagas_disp_ambos);
$sum_vagas_ant = intval($vagas_disp_ant_caes) + intval($vagas_disp_ant_gatos)  + intval($vagas_disp_ant_ambos);

if($sum_vagas_disp_gatos <> $vagas_disp_ant_gatos) {
    
   mysqli_data_seek($selectcat, 0);
   
   $subject = "Atualização nas vagas de gatos dos lares temporários ativos";
   
   $to = "thaise.piculi@gmail.com";
   
   $message = "<!DOCTYPE html>
                        <html lang='pt-br'>
                          <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                            
                            <!-- Bootstrap CSS -->
                            
                            <link rel='stylesheet' media='all' href='/assets/application-mailer-dbc5154d3c4160e8fa7ef52fa740fa402760c39b5d22c8f6d64ad5999499d263.css' />
                            
                            <link rel='stylesheet' type='text/css' href='style-area.css'/>
    
                            <link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>
                            
                          </head>
                          
                        <tbody>
				        <div class='d-none d-print-block'>
                            <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center>
                        </div>
                        <br><center><h2>RELATÓRIO OPERACIONAL SEMANAL - LARES TEMPORÁRIOS ATIVOS</h2></center><br> 
                        
                        <p> Olá Diretor, <br>
                            Você está recebendo essa notificação pois houve uma atualização no número de vagas dos lares temporários.<br> Esse número foi atualizado devido a inclusão de novos cadastros, sejam de animais ou termos de adoção. <br><br>
                            
                            <strong>Critério de seleção e contagem das vagas:</strong>:<br>
                            1. Animais que estão com o status 'Disponível' ou 'Indisponível' e que estejam na LEG ou já aptos para divulgação. <br>
                            2. Lares temporários que estão ativos no sistema e que hospedam apenas gatos. <br><br>
                            
                            Seguem abaixo os novos valores: <br><br>
                            
                            <strong>". $vagas_disp_ant_gatos."</strong> vagas antigas <br>
                            <strong>". $sum_vagas_disp_gatos."</strong> vagas atuais <br><br>";
   
   $message .= "
                    <table class='table'>
                    <thead class='thead-light'>
                	<th scope='col'>Lar temporário</th>
                	<th scope='col'>Celular</th>
                	<th scope='col'>Espécie</th>
                	<th scope='col'>Limites de vagas</th>
                	<th scope='col'>Qtd de animais</th>
                	<th scope='col'>Vagas disponíveis</th>
                	<th scope='col'></th>
                	</thead>
                	<tbody>";
        	        while ($fetch = mysqli_fetch_row($selectcat)) {
        	            $lt = $fetch[1];
        	            $celular = $fetch[6];
        				$especies = $fetch[8];
        				$qtde_vagas = $fetch[19];
        				$gatos = $fetch[10];
        				$vagas_disp = $fetch[20];
                		$message .="<tr>
                			            <td>".$lt."</td>";
                			            if ($celular <> ''){
                			                 $message .="<td><a href='https://api.whatsapp.com/send?phone=55".$celular."'>".$celular."</td>";
                    			         } else {
                    			            $message .="<td>".$celular."</td>"; 
                    			         }
        					            $message .= "<td>".$especies."</td>
        					            <td>".$qtde_vagas."</td>
        					            <td>".$gatos."</td>
        					            <td>".$vagas_disp."</td>";
        				if ($gatos <> '0'){
        					    $message .="<td><a href='www.gaarcampinas.org/area/animaislts.php?lt=".$lt."' target='_blank' class='btn btn-primary'>Listar animais</a>&nbsp;</td>";
        				}
        				
        				$message .="</tr>";
        			}   
        			$message .= "</tbody>
                    </table></center> <br><br>";
                    
                    $qtde_quem_entrou = intval($sum_vagas_disp_gatos) - intval ($vagas_disp_ant_gatos);
                    
                    $queryentrou = "SELECT * FROM ANIMAL WHERE ESPECIE ='Felina' AND (ADOTADO='Disponível' OR ADOTADO='Indisponível')  AND (DIVULGAR_COMO ='Controle Interno' OR DIVULGAR_COMO ='GAAR' OR DIVULGAR_COMO='LEG') ORDER BY ID DESC LIMIT ".$qtde_quem_entrou."";
		            $selectentrou = mysqli_query($connect,$queryentrou); 	
                    
                    $message .= "<h4> Quem entrou </h4>
                            <table class='table'>
                            <thead class='thead-light'>
                        	<th scope='col'>Nome</th>
                        	<th scope='col'>Responsável</th>
                        	<th scope='col'>Link</th>
                        	</thead>
                        	<tbody>";
                    
                    while ($fetchentrou = mysqli_fetch_row($selectentrou)) {
                        $id = $fetchentrou[0];
        	            $nomedoanimal = $fetchentrou[1];
        	            $resp = $fetchentrou[12];
        	            $message .="<tr>
                			            <td>".$nomedoanimal."</td>
        					            <td>".$resp."</td>
        					            <td><a href='http://www.gaarcampinas.org/pet.php?id=".$id."' target='_blank'>Ver animal</a></td>
                                   </tr>";
        			}   
        			$message .= "</tbody>
                    </table></center> <br><br>";
                    
                    $message .= "<strong>Observações:</strong><br>
                    <i> Clique no celular para enviar WhatsApp</i><br>
                    <i> O link da lista de animais só estará disponível caso tenha animal no lar temporário</i><br>
                    <i> O processo de verificação e atualização das tabelas ocorrerá automaticamente a cada 1 hora</i><br>
                    
                    </p>";
        	            
                    /*mail($to, $subject, $message, $headers);*/
                    echo "E-mail enviado para ".$to;
                    echo "<br> Assunto : ".$subject;
   
}

if($sum_vagas_disp_caes <> $vagas_disp_ant_caes) {
    
   mysqli_data_seek($selectdog, 0);
   
   $data = date('d-m');
   
   $subject = "Atualização nas vagas de cães dos lares temporários ativos";
   
   $to = "thaise.piculi@gmail.com";
   
   $message = "<!DOCTYPE html>
                        <html lang='pt-br'>
                          <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                            
                            <!-- Bootstrap CSS -->
                            
                            <link rel='stylesheet' media='all' href='/assets/application-mailer-dbc5154d3c4160e8fa7ef52fa740fa402760c39b5d22c8f6d64ad5999499d263.css' />
                            
                            <link rel='stylesheet' type='text/css' href='style-area.css'/>
    
                            <link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>
                            
                          </head>
                          
                        <tbody>
				        <div class='d-none d-print-block'>
                            <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center>
                        </div>
                        <br><center><h2>RELATÓRIO OPERACIONAL SEMANAL - LARES TEMPORÁRIOS ATIVOS</h2></center><br> 
                        
                           <p> Olá Diretor, <br>
                            Você está recebendo essa notificação pois houve uma atualização no número de vagas dos lares temporários.<br> Esse número foi atualizado devido a inclusão de novos cadastros, sejam de animais ou termos de adoção. <br><br>
                            
                            <strong>Critério de seleção e contagem das vagas:</strong>: <br>
                            1. Animais que estão com o status 'Disponível' ou 'Indisponível' e que estejam aptos para divulgação. <br>
                            2. Lares temporários que estão ativos no sistema e que hospedam apenas cães. <br><br>
                            
                            Seguem abaixo os novos valores: <br><br>
                            
                            <strong>". $vagas_disp_ant_caes."</strong> vagas antigas <br>
                            <strong>". $sum_vagas_disp_caes."</strong> vagas atuais <br><br>";

   $message .= "
                    <table class='table'>
                    <thead class='thead-light'>
                	<th scope='col'>Lar temporário</th>
                	<th scope='col'>Celular</th>
                	<th scope='col'>Espécie</th>
                	<th scope='col'>Limites de vagas</th>
                	<th scope='col'>Qtd de animais</th>
                	<th scope='col'>Vagas disponíveis</th>
                	<th scope='col'></th>
                	</thead>
                	<tbody>";
        	        while ($fetch = mysqli_fetch_row($selectdog)) {
        	            $lt = $fetch[1];
        	            $celular = $fetch[6];
        				$especies = $fetch[8];
        				$qtde_vagas = $fetch[19];
        				$caes = $fetch[9];
        				$animais_lt = intval($caes) + intval($gatos);
        				$vagas_disp = $fetch[20];
                		$message .="<tr>
                			            <td>".$lt."</td>";
                			            if ($celular <> ''){
                			                 $message .="<td><a href='https://api.whatsapp.com/send?phone=55".$celular."'>".$celular."</td>";
                    			         } else {
                    			            $message .="<td>".$celular."</td>"; 
                    			         }
        					            $message .= "<td>".$especies."</td>
        					            <td>".$qtde_vagas."</td>
        					            <td>".$caes."</td>
        					            <td>".$vagas_disp."</td>";
        				if ($caes <> '0'){
        					    $message .="<td><a href='www.gaarcampinas.org/area/animaislts.php?lt=".$lt."' target='_blank' class='btn btn-primary'>Listar animais</a>&nbsp;</td>";
        				}
        				
        				$message .="</tr>";
        			}   
        			$message .= "</tbody>
                    </table></center> <br><br>";
                    

                    $qtde_quem_entrou = intval($sum_vagas_disp_caes) - intval ($vagas_disp_ant_caes);
                    
                    echo "<br>qtde quem entrou: ".$qtde_quem_entrou;
                    
                    $queryentrou = "SELECT * FROM ANIMAL WHERE ESPECIE ='Canina' AND (ADOTADO='Disponível' OR ADOTADO='Indisponível')  AND (DIVULGAR_COMO ='Controle Interno' OR DIVULGAR_COMO ='GAAR') ORDER BY ID DESC LIMIT ".abs($qtde_quem_entrou)."";
		            $selectentrou = mysqli_query($connect,$queryentrou); 	
                    
                    $message .= "<h4> Quem entrou </h4>
                            <table class='table'>
                            <thead class='thead-light'>
                        	<th scope='col'>Nome</th>
                        	<th scope='col'>Responsável</th>
                        	<th scope='col'>Link</th>
                        	</thead>
                        	<tbody>";
                    
                    while ($fetchentrou = mysqli_fetch_row($selectentrou)) {
                        $id = $fetchentrou[0];
        	            $nomedoanimal = $fetchentrou[1];
        	            $resp = $fetchentrou[12];
        	            $message .="<tr>
                			            <td>".$nomedoanimal."</td>
        					            <td>".$resp."</td>
        					            <td><a href='http://www.gaarcampinas.org/pet.php?id=".$id."' target='_blank'>Ver animal</a></td>
                                   </tr>";
        			}   
        			$message .= "</tbody>
                    </table></center> <br><br>";
                    
                    $message .= "<strong>Observações:</strong><br>
                    <i> Clique no celular para enviar WhatsApp</i><br>
                    <i> O link da lista de animais só estará disponível caso tenha animal no lar temporário</i><br>
                    <i> O processo de verificação e atualização das tabelas ocorrerá automaticamente a cada 1 hora</i><br>
                    
                    </p>";
        	            
                    /*mail($to, $subject, $message, $headers);*/
                    echo "E-mail enviado para ".$to;
                    echo "<br> Assunto : ".$subject;
   
}

if($sum_vagas_disp_ambos <> $vagas_disp_ant_ambos) {
    
   mysqli_data_seek($selectpet, 0);
   
   $subject = "Atualização nas vagas dos lares temporários ativos";
   
   $to = "thaise.piculi@gmail.com";
   
   $message = "<!DOCTYPE html>
                        <html lang='pt-br'>
                          <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                            
                            <!-- Bootstrap CSS -->
                            
                            <link rel='stylesheet' media='all' href='/assets/application-mailer-dbc5154d3c4160e8fa7ef52fa740fa402760c39b5d22c8f6d64ad5999499d263.css' />
                            
                            <link rel='stylesheet' type='text/css' href='style-area.css'/>
    
                            <link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>
                            
                          </head>
                          
                        <tbody>
				        <div class='d-none d-print-block'>
                            <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center>
                        </div>
                        <br><center><h2>RELATÓRIO OPERACIONAL SEMANAL - LARES TEMPORÁRIOS ATIVOS</h2></center><br> 
                        
                           <p> Olá Diretor, <br>
                            Você está recebendo essa notificação pois houve uma atualização no número de vagas dos lares temporários.<br> Esse número foi atualizado devido a inclusão de novos cadastros, sejam de animais ou termos de adoção. <br><br>
                            
                            <strong>Critério de seleção e contagem das vagas:</strong>:<br>
                            1. Animais que estão com o status 'Disponível' ou 'Indisponível' e que estejam aptos para divulgação. <br>
                            2. Lares temporários que estão ativos no sistema e que hospedam apenas cães. <br><br>
                            
                            Seguem abaixo os novos valores: <br><br>
                            
                            <strong>". $vagas_disp_ant_ambos."</strong> vagas antigas <br>
                            <strong>". $sum_vagas_disp_ambos."</strong> vagas atuais <br><br>";

   $message .= "
                    <table class='table'>
                    <thead class='thead-light'>
                	<th scope='col'>Lar temporário</th>
                	<th scope='col'>Celular</th>
                	<th scope='col'>Espécie</th>
                	<th scope='col'>Limites de vagas</th>
                	<th scope='col'>Qtd de animais</th>
                	<th scope='col'>Vagas disponíveis</th>
                	<th scope='col'></th>
                	</thead>
                	<tbody>";
        	        while ($fetch = mysqli_fetch_row($selectpet)) {
        	            $lt = $fetch[1];
        	            $celular = $fetch[6];
        				$especies = $fetch[8];
        				$qtde_vagas = $fetch[19];
        				$caes = $fetch[9];
        				$gatos = $fetch[10];
        				$animais_lt = intval($caes) + intval($gatos);
        				$vagas_disp = $fetch[20];
                		$message .="<tr>
                			            <td>".$lt."</td>";
                			            if ($celular <> ''){
                			                 $message .="<td><a href='https://api.whatsapp.com/send?phone=55".$celular."'>".$celular."</td>";
                    			         } else {
                    			            $message .="<td>".$celular."</td>"; 
                    			         }
        					            $message .= "<td>".$especies."</td>
        					            <td>".$qtde_vagas."</td>
        					            <td>".$animais_lt."</td>
        					            <td>".$vagas_disp."</td>";
        				if ($animais_lt <> '0'){
        					    $message .="<td><a href='www.gaarcampinas.org/area/animaislts.php?lt=".$lt."' target='_blank' class='btn btn-primary'>Listar animais</a>&nbsp;</td>";
        				}
        				
        				$message .="</tr>";
        			}   
        			$message .= "</tbody>
                    </table></center> <br><br>
                    <strong>Observações:</strong><br>
                    <i> Clique no celular para enviar WhatsApp</i><br>
                    <i> O link da lista de animais só estará disponível caso tenha animal no lar temporário</i><br>
                    <i> O processo de verificação e atualização das tabelas ocorrerá automaticamente a cada 1 hora</i><br>
                    
                    </p>";
                    
                    /*mail($to, $subject, $message, $headers);*/
                    
                    echo "<br>E-mail enviado para ".$to;
                    echo "<br> Assunto : ".$subject;
   
}


/*echo "<br>".$message;*/
        
mysqli_close($connect);

