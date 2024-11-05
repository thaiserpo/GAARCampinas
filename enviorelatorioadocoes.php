<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');
require_once('/home1/gaarca06/public_html/area/fpdf/fpdf.php');
/*require("home1/gaarca06/public_html/PHPMailer/src/PHPMailer.php");
require("home1/gaarca06/public_html/PHPMailer/src/SMTP.php");*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail*/
$mail->IsHTML(true);
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
$mail->IsHTML(true);
$to = "contato@gaarcampinas.org";
$mail->AddAddress($to);
        
$mes_ant = date('m',strtotime('-1 months'));
$mes_atu = date("m");
$trimestre = date('m',strtotime('-3 months'));
        
if ($mes_atu == "01"){
    $anoadocao = date('Y', strtotime('-1 year'));
} else {
    $anoadocao = date("Y");    
}

$sumqtdeprocedi = 0;
$sumvalorprocedi = 0;
$sumtransf = 0;

$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");
$ano_atu = date("Y");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

        function adotados_mes($ano,$mes,$especie,$connect){
				$query = "SELECT * FROM TERMO_ADOCAO WHERE ESPECIE = '".$especie."' and DATA_ADOCAO LIKE '".$ano."-".$mes."-%'";
				$connect = mysqli_query($connect,$query);
				$rc= mysqli_num_rows($connect);
				
				return ($rc);
		}
		
		function local_adocao($anoadocao,$mesadocao,$local_adocao,$connect){
				$querylocal = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND  DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."%' and LOCAL_ADOCAO = '".$local_adocao."'";
				$resultlocal = mysqli_query($connect,$querylocal);
				$rc= mysqli_num_rows($resultlocal);	
											
				return($rc);
		}
		
		function local_adocao_especie($anoadocao,$mesadocao,$local_adocao,$especie,$connect){
				$querylocal = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND  DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."%' and LOCAL_ADOCAO = '".$local_adocao."' AND ESPECIE='".$especie."'";
				$resultlocal = mysqli_query($connect,$querylocal);
				$rc= mysqli_num_rows($resultlocal);	
											
				return($rc);
		}
		
		function castrados_mes_caes($anoadocao,$mesadocao,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO WHERE CASTRADO = 'Sim' AND ESPECIE='Canina' AND DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."-%'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes); 	
											
				return($rc);
		}
		
		function castrados_mes_gatos($anoadocao,$mesadocao,$connect){
				$querygatos = "SELECT * FROM TERMO_ADOCAO WHERE CASTRADO = 'Sim' AND ESPECIE='Felina' AND DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."-%'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc= mysqli_num_rows($resultgatos);	
											
				return($rc);
		}
		
		function castrados_total_caes($anoadocao,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO WHERE DATA_ADOCAO LIKE '".$anoadocao."-%' AND ESPECIE='Canina' AND CASTRADO = 'Sim'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);
											
				return($rc);
		}
		
		function castrados_total_gatos($anoadocao,$connect){
				$querygatos = "SELECT * FROM TERMO_ADOCAO WHERE DATA_ADOCAO LIKE '".$anoadocao."-%' AND ESPECIE='Felina' AND CASTRADO = 'Sim'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc= mysqli_num_rows($resultgatos);	
											
				return($rc);
		}
		
		function adotados_total_caes($anoadocao,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-%' AND ESPECIE='Canina'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);	
											
				return($rc);
		}
		
		function adotados_total_gatos($anoadocao,$connect){
				$querygatos = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-%' AND ESPECIE='Felina'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc= mysqli_num_rows($resultgatos);	
											
				return($rc);
		}
		
		function adotados_ano_femeas($anoadocao, $especie,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-%' AND ESPECIE='$especie' AND SEXO='Fêmea'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);	
											
				return($rc);
		}
		
		function adotados_ano_machos($anoadocao, $especie,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-%' AND ESPECIE='$especie' AND SEXO='Macho'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);	
											
				return($rc);
		}
		
		function animais_filhotes_disponiveis($especie, $sexo, $connect){
				$querypet = "SELECT * FROM ANIMAL WHERE ESPECIE='$especie' AND SEXO='$sexo' AND (IDADE_JUL > '0' AND IDADE_JUL <='365') AND ADOTADO ='Disponível' AND DIVULGAR_COMO ='GAAR'";
				$resultpet = mysqli_query($connect,$querypet);
				$rc= mysqli_num_rows($resultpet);	
											
				return($rc);
		}
        
        function animais_adultos_disponiveis($especie, $sexo, $connect){
				$querypet = "SELECT * FROM ANIMAL WHERE ESPECIE='$especie' AND SEXO='$sexo' AND (IDADE_JUL >= '365') AND ADOTADO ='Disponível' AND DIVULGAR_COMO ='GAAR'";
				$resultpet = mysqli_query($connect,$querypet);
				$rc= mysqli_num_rows($resultpet);	
											
				return($rc);
		}
		
		function animais_indisponiveis($connect){
				$querypet = "SELECT * FROM ANIMAL WHERE ADOTADO <>'Disponível' AND ADOTADO NOT LIKE '%Adotado%' AND ADOTADO <>'Óbito' AND DIVULGAR_COMO ='GAAR'";
				$resultpet = mysqli_query($connect,$querypet);
				$rc= mysqli_num_rows($resultpet);	
											
				return($rc);
		}
		
         $adotados_mes01_caes = adotados_mes($anoadocao,'01','Canina',$connect);
	     $adotados_mes02_caes = adotados_mes($anoadocao,'02','Canina',$connect);
	     $adotados_mes03_caes = adotados_mes($anoadocao,'03','Canina',$connect);
	     $adotados_mes04_caes = adotados_mes($anoadocao,'04','Canina',$connect);
	     $adotados_mes05_caes = adotados_mes($anoadocao,'05','Canina',$connect);
	     $adotados_mes06_caes = adotados_mes($anoadocao,'06','Canina',$connect);
	     $adotados_mes07_caes = adotados_mes($anoadocao,'07','Canina',$connect);
	     $adotados_mes08_caes = adotados_mes($anoadocao,'08','Canina',$connect);
	     $adotados_mes09_caes = adotados_mes($anoadocao,'09','Canina',$connect);
	     $adotados_mes10_caes = adotados_mes($anoadocao,'10','Canina',$connect);
	     $adotados_mes11_caes = adotados_mes($anoadocao,'11','Canina',$connect);
	     $adotados_mes12_caes = adotados_mes($anoadocao,'12','Canina',$connect);
	     $adotados_mes01_gatos = adotados_mes($anoadocao,'01','Felina',$connect);
	     $adotados_mes02_gatos = adotados_mes($anoadocao,'02','Felina',$connect);
	     $adotados_mes03_gatos = adotados_mes($anoadocao,'03','Felina',$connect);
	     $adotados_mes04_gatos = adotados_mes($anoadocao,'04','Felina',$connect);
	     $adotados_mes05_gatos = adotados_mes($anoadocao,'05','Felina',$connect);
	     $adotados_mes06_gatos = adotados_mes($anoadocao,'06','Felina',$connect);
	     $adotados_mes07_gatos = adotados_mes($anoadocao,'07','Felina',$connect);
	     $adotados_mes08_gatos = adotados_mes($anoadocao,'08','Felina',$connect);
	     $adotados_mes09_gatos = adotados_mes($anoadocao,'09','Felina',$connect);
	     $adotados_mes10_gatos = adotados_mes($anoadocao,'10','Felina',$connect);
	     $adotados_mes11_gatos = adotados_mes($anoadocao,'11','Felina',$connect);
	     $adotados_mes12_gatos = adotados_mes($anoadocao,'12','Felina',$connect);
		 
		    
		 $adotados_mes01_petcamp_bg = local_adocao($anoadocao,'01','Petcamp Barão Geraldo',$connect);
		 $adotados_mes02_petcamp_bg = local_adocao($anoadocao,'02','Petcamp Barão Geraldo',$connect);
		 $adotados_mes03_petcamp_bg = local_adocao($anoadocao,'03','Petcamp Barão Geraldo',$connect);
		 $adotados_mes04_petcamp_bg = local_adocao($anoadocao,'04','Petcamp Barão Geraldo',$connect);
		 $adotados_mes05_petcamp_bg = local_adocao($anoadocao,'05','Petcamp Barão Geraldo',$connect);
		 $adotados_mes06_petcamp_bg = local_adocao($anoadocao,'06','Petcamp Barão Geraldo',$connect);
		 $adotados_mes07_petcamp_bg = local_adocao($anoadocao,'07','Petcamp Barão Geraldo',$connect);
		 $adotados_mes08_petcamp_bg = local_adocao($anoadocao,'08','Petcamp Barão Geraldo',$connect);
		 $adotados_mes09_petcamp_bg = local_adocao($anoadocao,'09','Petcamp Barão Geraldo',$connect);
		 $adotados_mes10_petcamp_bg = local_adocao($anoadocao,'10','Petcamp Barão Geraldo',$connect);
		 $adotados_mes11_petcamp_bg = local_adocao($anoadocao,'11','Petcamp Barão Geraldo',$connect);
		 $adotados_mes12_petcamp_bg = local_adocao($anoadocao,'12','Petcamp Barão Geraldo',$connect);
		 
		 $adotados_mes01_petcamp_jasmim = local_adocao($anoadocao,'01','Petcamp Jasmim',$connect);
		 $adotados_mes02_petcamp_jasmim = local_adocao($anoadocao,'02','Petcamp Jasmim',$connect);
		 $adotados_mes03_petcamp_jasmim = local_adocao($anoadocao,'03','Petcamp Jasmim',$connect);
		 $adotados_mes04_petcamp_jasmim = local_adocao($anoadocao,'04','Petcamp Jasmim',$connect);
		 $adotados_mes05_petcamp_jasmim = local_adocao($anoadocao,'05','Petcamp Jasmim',$connect);
		 $adotados_mes06_petcamp_jasmim = local_adocao($anoadocao,'06','Petcamp Jasmim',$connect);
		 $adotados_mes07_petcamp_jasmim = local_adocao($anoadocao,'07','Petcamp Jasmim',$connect);
		 $adotados_mes08_petcamp_jasmim = local_adocao($anoadocao,'08','Petcamp Jasmim',$connect);
		 $adotados_mes09_petcamp_jasmim = local_adocao($anoadocao,'09','Petcamp Jasmim',$connect);
		 $adotados_mes10_petcamp_jasmim = local_adocao($anoadocao,'10','Petcamp Jasmim',$connect);
		 $adotados_mes11_petcamp_jasmim = local_adocao($anoadocao,'11','Petcamp Jasmim',$connect);
		 $adotados_mes12_petcamp_jasmim = local_adocao($anoadocao,'12','Petcamp Jasmim',$connect);
		 
		 $adotados_mes01_leroy = local_adocao($anoadocao,'01','Leroy M Dom Pedro',$connect);
		 $adotados_mes02_leroy = local_adocao($anoadocao,'02','Leroy M Dom Pedro',$connect);
		 $adotados_mes03_leroy = local_adocao($anoadocao,'03','Leroy M Dom Pedro',$connect);
		 $adotados_mes04_leroy = local_adocao($anoadocao,'04','Leroy M Dom Pedro',$connect);
		 $adotados_mes05_leroy = local_adocao($anoadocao,'05','Leroy M Dom Pedro',$connect);
		 $adotados_mes06_leroy = local_adocao($anoadocao,'06','Leroy M Dom Pedro',$connect);
		 $adotados_mes07_leroy = local_adocao($anoadocao,'07','Leroy M Dom Pedro',$connect);
		 $adotados_mes08_leroy = local_adocao($anoadocao,'08','Leroy M Dom Pedro',$connect);
		 $adotados_mes09_leroy = local_adocao($anoadocao,'09','Leroy M Dom Pedro',$connect);
		 $adotados_mes10_leroy = local_adocao($anoadocao,'10','Leroy M Dom Pedro',$connect);
		 $adotados_mes11_leroy = local_adocao($anoadocao,'11','Leroy M Dom Pedro',$connect);
		 $adotados_mes12_leroy = local_adocao($anoadocao,'12','Leroy M Dom Pedro',$connect);
		 
		 $adotados_mes01_fora_feira = local_adocao($anoadocao,'01','Fora da feira',$connect);
		 $adotados_mes02_fora_feira = local_adocao($anoadocao,'02','Fora da feira',$connect);
		 $adotados_mes03_fora_feira = local_adocao($anoadocao,'03','Fora da feira',$connect);
		 $adotados_mes04_fora_feira = local_adocao($anoadocao,'04','Fora da feira',$connect);
		 $adotados_mes05_fora_feira = local_adocao($anoadocao,'05','Fora da feira',$connect);
		 $adotados_mes06_fora_feira = local_adocao($anoadocao,'06','Fora da feira',$connect);
		 $adotados_mes07_fora_feira = local_adocao($anoadocao,'07','Fora da feira',$connect);
		 $adotados_mes08_fora_feira = local_adocao($anoadocao,'08','Fora da feira',$connect);
		 $adotados_mes09_fora_feira = local_adocao($anoadocao,'09','Fora da feira',$connect);
		 $adotados_mes10_fora_feira = local_adocao($anoadocao,'10','Fora da feira',$connect);
		 $adotados_mes11_fora_feira = local_adocao($anoadocao,'11','Fora da feira',$connect);
		 $adotados_mes12_fora_feira = local_adocao($anoadocao,'12','Fora da feira',$connect);
		 
		 $adotados_mes01_cc = local_adocao($anoadocao,'01','Centro de Convivência',$connect);
		 $adotados_mes02_cc = local_adocao($anoadocao,'02','Centro de Convivência',$connect);
		 $adotados_mes03_cc = local_adocao($anoadocao,'03','Centro de Convivência',$connect);
		 $adotados_mes04_cc = local_adocao($anoadocao,'04','Centro de Convivência',$connect);
		 $adotados_mes05_cc = local_adocao($anoadocao,'05','Centro de Convivência',$connect);
		 $adotados_mes06_cc = local_adocao($anoadocao,'06','Centro de Convivência',$connect);
		 $adotados_mes07_cc = local_adocao($anoadocao,'07','Centro de Convivência',$connect);
		 $adotados_mes08_cc = local_adocao($anoadocao,'08','Centro de Convivência',$connect);
		 $adotados_mes09_cc = local_adocao($anoadocao,'09','Centro de Convivência',$connect);
		 $adotados_mes10_cc = local_adocao($anoadocao,'10','Centro de Convivência',$connect);
		 $adotados_mes11_cc = local_adocao($anoadocao,'11','Centro de Convivência',$connect);
		 $adotados_mes12_cc = local_adocao($anoadocao,'12','Centro de Convivência',$connect);
		 
		 $castrados_mes01_caes = castrados_mes_caes($anoadocao,'01',$connect);
		 $castrados_mes02_caes = castrados_mes_caes($anoadocao,'02',$connect);
		 $castrados_mes03_caes = castrados_mes_caes($anoadocao,'03',$connect);
		 $castrados_mes04_caes = castrados_mes_caes($anoadocao,'04',$connect);
		 $castrados_mes05_caes = castrados_mes_caes($anoadocao,'05',$connect);
		 $castrados_mes06_caes = castrados_mes_caes($anoadocao,'06',$connect);
		 $castrados_mes07_caes = castrados_mes_caes($anoadocao,'07',$connect);
		 $castrados_mes08_caes = castrados_mes_caes($anoadocao,'08',$connect);
		 $castrados_mes09_caes = castrados_mes_caes($anoadocao,'09',$connect);
		 $castrados_mes10_caes = castrados_mes_caes($anoadocao,'10',$connect);
		 $castrados_mes11_caes = castrados_mes_caes($anoadocao,'11',$connect);
		 $castrados_mes12_caes = castrados_mes_caes($anoadocao,'12',$connect);
		 $castrados_mes01_gatos = castrados_mes_gatos($anoadocao,'01',$connect);
		 $castrados_mes02_gatos = castrados_mes_gatos($anoadocao,'02',$connect);
		 $castrados_mes03_gatos = castrados_mes_gatos($anoadocao,'03',$connect);
		 $castrados_mes04_gatos = castrados_mes_gatos($anoadocao,'04',$connect);
		 $castrados_mes05_gatos = castrados_mes_gatos($anoadocao,'05',$connect);
		 $castrados_mes06_gatos = castrados_mes_gatos($anoadocao,'06',$connect);
		 $castrados_mes07_gatos = castrados_mes_gatos($anoadocao,'07',$connect);
		 $castrados_mes08_gatos = castrados_mes_gatos($anoadocao,'08',$connect);
		 $castrados_mes09_gatos = castrados_mes_gatos($anoadocao,'09',$connect);
		 $castrados_mes10_gatos = castrados_mes_gatos($anoadocao,'10',$connect);
		 $castrados_mes11_gatos = castrados_mes_gatos($anoadocao,'11',$connect);
		 $castrados_mes12_gatos = castrados_mes_gatos($anoadocao,'12',$connect);
		 
		 $total_castrados_caes = castrados_total_caes($anoadocao,$connect);
		 $total_castrados_gatos = castrados_total_gatos($anoadocao,$connect);
		 $total_adocoes_caes = adotados_total_caes($anoadocao,$connect);
 		 $total_adocoes_gatos = adotados_total_gatos($anoadocao,$connect);
 		 
 		 
	 
		 $adotados_caes = intval($adotados_mes01_caes) +           
				intval($adotados_mes02_caes) +
                intval($adotados_mes03_caes) +
                intval($adotados_mes04_caes) +
                intval($adotados_mes05_caes) +
                intval($adotados_mes06_caes) +
                intval($adotados_mes07_caes) +
				intval($adotados_mes08_caes) +
				intval($adotados_mes09_caes) +
				intval($adotados_mes10_caes) +
				intval($adotados_mes11_caes) +
                intval($adotados_mes12_caes);
                
        $adotados_gatos = intval($adotados_mes01_gatos) +           
				intval($adotados_mes02_gatos) +
                intval($adotados_mes03_gatos) +
                intval($adotados_mes04_gatos) +
                intval($adotados_mes05_gatos) +
                intval($adotados_mes06_gatos) +
                intval($adotados_mes07_gatos) +
				intval($adotados_mes08_gatos) +
				intval($adotados_mes09_gatos) +
				intval($adotados_mes10_gatos) +
				intval($adotados_mes11_gatos) +
                intval($adotados_mes12_gatos);
                
        $castrados_gatos = intval($castrados_mes01_gatos) +           
				intval($castrados_mes02_gatos) +
                intval($castrados_mes03_gatos) +
                intval($castrados_mes04_gatos) +
                intval($castrados_mes05_gatos) +
                intval($castrados_mes06_gatos) +
                intval($castrados_mes07_gatos) +
				intval($castrados_mes08_gatos) +
				intval($castrados_mes09_gatos) +
				intval($castrados_mes10_gatos) +
				intval($castrados_mes11_gatos) +
                intval($castrados_mes12_gatos); 
        
        $castrados_caes = intval($castrados_mes01_caes) +           
				intval($castrados_mes02_caes) +
                intval($castrados_mes03_caes) +
                intval($castrados_mes04_caes) +
                intval($castrados_mes05_caes) +
                intval($castrados_mes06_caes) +
                intval($castrados_mes07_caes) +
				intval($castrados_mes08_caes) +
				intval($castrados_mes09_caes) +
				intval($castrados_mes10_caes) +
				intval($castrados_mes11_caes) +
                intval($castrados_mes12_caes); 
                
        $total_anoadocao_petcamp_bg = intval($adotados_mes01_petcamp_bg) +           
				intval($adotados_mes02_petcamp_bg) +
                intval($adotados_mes03_petcamp_bg) +
                intval($adotados_mes04_petcamp_bg) +
                intval($adotados_mes05_petcamp_bg) +
                intval($adotados_mes06_petcamp_bg) +
                intval($adotados_mes07_petcamp_bg) +
				intval($adotados_mes08_petcamp_bg) +
				intval($adotados_mes09_petcamp_bg) +
				intval($adotados_mes10_petcamp_bg) +
				intval($adotados_mes11_petcamp_bg) +
                intval($adotados_mes12_petcamp_bg);
                
        $total_anoadocao_petcamp_jas = intval($adotados_mes01_petcamp_jasmim) +           
				intval($adotados_mes02_petcamp_jasmim) +
                intval($adotados_mes03_petcamp_jasmim) +
                intval($adotados_mes04_petcamp_jasmim) +
                intval($adotados_mes05_petcamp_jasmim) +
                intval($adotados_mes06_petcamp_jasmim) +
                intval($adotados_mes07_petcamp_jasmim) +
				intval($adotados_mes08_petcamp_jasmim) +
				intval($adotados_mes09_petcamp_jasmim) +
				intval($adotados_mes10_petcamp_jasmim) +
				intval($adotados_mes11_petcamp_jasmim) +
                intval($adotados_mes12_petcamp_jasmim);
                
        $total_anoadocao_fora_feira = intval($adotados_mes01_fora_feira) +           
				intval($adotados_mes02_fora_feira) +
                intval($adotados_mes03_fora_feira) +
                intval($adotados_mes04_fora_feira) +
                intval($adotados_mes05_fora_feira) +
                intval($adotados_mes06_fora_feira) +
                intval($adotados_mes07_fora_feira) +
				intval($adotados_mes08_fora_feira) +
				intval($adotados_mes09_fora_feira) +
				intval($adotados_mes10_fora_feira) +
				intval($adotados_mes11_fora_feira) +
                intval($adotados_mes12_fora_feira);
                
        $total_anoadocao_cc = intval($adotados_mes01_cc) +           
				intval($adotados_mes02_cc) +
                intval($adotados_mes03_cc) +
                intval($adotados_mes04_cc) +
                intval($adotados_mes05_cc) +
                intval($adotados_mes06_cc) +
                intval($adotados_mes07_cc) +
				intval($adotados_mes08_cc) +
				intval($adotados_mes09_cc) +
				intval($adotados_mes10_cc) +
				intval($adotados_mes11_cc) +
                intval($adotados_mes12_cc);
                
        $total_anoadocao_leroy = intval($adotados_mes01_leroy) +           
				intval($adotados_mes02_leroy) +
                intval($adotados_mes03_leroy) +
                intval($adotados_mes04_leroy) +
                intval($adotados_mes05_leroy) +
                intval($adotados_mes06_leroy) +
                intval($adotados_mes07_leroy) +
				intval($adotados_mes08_leroy) +
				intval($adotados_mes09_leroy) +
				intval($adotados_mes10_leroy) +
				intval($adotados_mes11_leroy) +
                intval($adotados_mes12_leroy);
	
		$animais_adotados = intval ($adotados_caes) + intval ($adotados_gatos);
		 
    	 $animais_doados_castrados = intval ($castrados_gatos) + intval ($castrados_caes);
    	 
    	 $animais_doados_naocastrados = $animais_adotados - $animais_doados_castrados;
    	 
    	 $adotados_caes_femeas = adotados_ano_femeas($anoadocao,'Canina',$connect);
    	 $adotados_caes_machos = adotados_ano_machos($anoadocao,'Canina',$connect);
    		
    	 $adotados_gatos_femeas = adotados_ano_femeas($anoadocao,'Felina',$connect);
    	 $adotados_gatos_machos = adotados_ano_machos($anoadocao,'Felina',$connect);
    	 
    	 $caes_doados_forafeira = local_adocao_especie($anoadocao,$mes_ant,'Fora da feira','Canina',$connect);
    	 $caes_doados_internetfeira = local_adocao_especie($anoadocao,$mes_ant,'Via internet - Feira','Canina',$connect);
    	 $gatos_doados_internetfeira = local_adocao_especie($anoadocao,$mes_ant,'Via internet - Feira','Felina',$connect);
    	 $gatos_doados_forafeira = local_adocao_especie($anoadocao,$mes_ant,'Fora da feira','Felina',$connect);
    	 $caes_doados_feirapetcampbg = local_adocao_especie($anoadocao,$mes_ant,'Petcamp Barão Geraldo','Canina',$connect);
    	 $gatos_doados_feirapetcampbg = local_adocao_especie($anoadocao,$mes_ant,'Petcamp Barão Geraldo','Felina',$connect);
    	 
    	 $caes_doados_feira = intval($caes_doados_feirapetcampbg) + intval ($caes_doados_internetfeira);
    	 $gatos_doados_feira = intval($gatos_doados_feirapetcampbg) + intval ($gatos_doados_internetfeira);;
    		
    	 $perc_caes = (intval($adotados_caes) / intval($animais_adotados))*100;
    	 $perc_caes_feira = ((intval($caes_doados_feira))*100) / intval($perc_caes);
    	 $perc_caes_forafeira = ((intval($caes_doados_forafeira))*100) / intval($perc_caes);
    	 $perc_caes_femeas = (intval($adotados_caes_femeas) / intval($animais_adotados))*100;
    	 $perc_caes_machos = (intval($adotados_caes_machos) / intval($animais_adotados))*100;
    		
    	 $perc_gatos = (intval($adotados_gatos) / intval($animais_adotados))*100;
    	 $perc_gatos_feira = (intval($gatos_doados_feira))*100;
    	 $perc_gatos_forafeira = (intval($gatos_doados_forafeira))*100;
    	 $perc_gatos_femeas = (intval($adotados_gatos_femeas) / intval($animais_adotados))*100;
    	 $perc_gatos_machos = (intval($adotados_gatos_machos) / intval($animais_adotados))*100;
    	 
    	 $caes_machos_filhotes = animais_filhotes_disponiveis ('Canina', 'Macho', $connect);
    	 $caes_femeas_filhotes = animais_filhotes_disponiveis ('Canina', 'Fêmea', $connect);
    	 $caes_machos_adultos = animais_adultos_disponiveis ('Canina', 'Macho', $connect);
    	 $caes_femeas_adultos = animais_adultos_disponiveis ('Canina', 'Fêmea', $connect);
    	 $gatos_machos_filhotes = animais_filhotes_disponiveis ('Felina', 'Macho', $connect);
    	 $gatos_femeas_filhotes = animais_filhotes_disponiveis ('Felina', 'Fêmea', $connect);
    	 $gatos_machos_adultos = animais_adultos_disponiveis ('Felina', 'Macho', $connect);
    	 $gatos_femeas_adultos = animais_adultos_disponiveis ('Felina', 'Fêmea', $connect);
    	 
    	 $total_animais = intval($caes_machos_filhotes) + intval($caes_femeas_filhotes) + intval($caes_machos_adultos) + intval($caes_femeas_adultos) + intval($gatos_machos_filhotes) + intval($gatos_femeas_filhotes) + intval($gatos_machos_adultos) + intval($gatos_femeas_adultos) ;
    	 
    	 $total_indisponivel = animais_indisponiveis($connect);
    	 
    	 $total_geral = intval($total_indisponivel) + intval($total_animais);
    	 
    	 $mensagem = "
		        <!DOCTYPE html>
                <html lang='pt-br'>
                  <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                    
                    <!-- Bootstrap CSS -->
                    
                    <link rel='stylesheet' media='all' href='/assets/application-mailer-dbc5154d3c4160e8fa7ef52fa740fa402760c39b5d22c8f6d64ad5999499d263.css' />
                    
                    <link rel='stylesheet' type='text/css' href='style-area.css'/>

                    <link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>
                    
                  </head>
                  
                <tbody>
                <font> 
                <center><img src='http://gaarcampinas.org/area/imagens/header".$mes_ant.".png'></center>
                <br>
                <p><center> Atualmente o GAAR tem ao todo ".$total_geral." animais sob responsabilidade, sendo ".$total_indisponivel." animais em tratamento/em preparação/adotados em adaptação e <br> ".$total_animais." animais prontos para adoção responsável. <br><br> Dentre os animais disponíveis são: <br>
                <table class='table'>
				  <tbody>
				  <tr> 
					<th scope='row' align='left' >".$caes_machos_filhotes."</th>
					<th scope='row' align='left'>cães filhotes</th>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$caes_femeas_filhotes."</th>
					<th scope='row' align='left'>cadelas filhotes</th>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$gatos_machos_filhotes."</th>
					<th scope='row' align='left'>gatos filhotes</th>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$gatos_femeas_filhotes."</th>
					<th scope='row' align='left'>gatas filhotes</th>
				  </tr>
				  <tr> 
					<th scope='row' align='left' colspan='2'>&nbsp;</th>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$caes_machos_adultos."</th>
					<th scope='row' align='left'>cães adultos</th>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$caes_femeas_adultos."</th>
					<th scope='row' align='left'>cadelas adultas</th>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$gatos_machos_adultos."</th>
					<th scope='row' align='left'>gatos adultos</th>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$gatos_femeas_adultos."</th>
					<th scope='row' align='left'>gatas adultos</th>
				  </tr>
                </tbody>
                </table>
                <p><center> Para conhecê-los e ajudar na divulgação, <a href='http://gaarcampinas.org/queroadotar.php'>clique aqui</a></center><br>
                <div class='bg-warning text-dark'>
                    <center><img src='http://gaarcampinas.org/area/imagens/adotados.png'></center>
                </div>
                <center>
		        <table class='table'>
				  <thead class='thead-dark  th-header'>
				  <tr>
                    <th scope='col'>&nbsp;</th>
					<th scope='col'>&nbsp;</th>
					<th scope='col' colspan='2'>Adoções</th>
				  </tr>
				  </thead>
				  <thead class='thead-light'>
				  <tr>
					<th scope='col'>Ano</th>
					<th scope='col'>Mês</th>
					<th scope='col'>Cães</th>
					<th scope='col'>Gatos</th>
				  </tr>
				  </thead>
				  <tbody>
				  <tr> 
					<th scope='row' align='left' >".$anoadocao."</th>
					<th scope='row' align='left'>Janeiro</th>
					<td align='center'>".$adotados_mes01_caes."</td>
					<td align='center'>".$adotados_mes01_gatos."</td>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$anoadocao."</th>
					<th scope='row' align='left' >Fevereiro</th>
					<td align='center'>".$adotados_mes02_caes."</td>
					<td align='center'>".$adotados_mes02_gatos."</td>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$anoadocao."</th>
					<th scope='row' align='left' >Março</th>
					<td align='center'>".$adotados_mes03_caes."</td>
					<td align='center'>".$adotados_mes03_gatos."</td>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$anoadocao."</th>
					<th scope='row' align='left' >Abril</th>
					<td align='center'>".$adotados_mes04_caes."</td>
					<td align='center'>".$adotados_mes04_gatos."</td>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$anoadocao."</th>
					<th scope='row' align='left' >Maio</th>
					<td align='center'>".$adotados_mes05_caes."</td>
					<td align='center'>".$adotados_mes05_gatos."</td>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$anoadocao."</th>
					<th scope='row' align='left' >Junho</th>
					<td align='center'>".$adotados_mes06_caes."</td>
					<td align='center'>".$adotados_mes06_gatos."</td>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$anoadocao."</th>
					<th scope='row' align='left' >Julho</th>
					<td align='center'>".$adotados_mes07_caes."</td>
					<td align='center'>".$adotados_mes07_gatos."</td>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$anoadocao."</th>
					<th scope='row' align='left' >Agosto</th>
					<td align='center'>".$adotados_mes08_caes."</td>
					<td align='center'>".$adotados_mes08_gatos."</td>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$anoadocao."</th>
					<th scope='row' align='left' >Setembro</th>
					<td align='center'>".$adotados_mes09_caes."</td>
					<td align='center'>".$adotados_mes09_gatos."</td>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$anoadocao."</th>
					<th scope='row' align='left' >Outubro</th>
					<td align='center'>".$adotados_mes10_caes."</td>
					<td align='center'>".$adotados_mes10_gatos."</td>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$anoadocao."</th>
					<th scope='row' align='left' >Novembro</th>
					<td align='center'>".$adotados_mes11_caes."</td>
					<td align='center'>".$adotados_mes11_gatos."</td>
				  </tr>
				  <tr> 
					<th scope='row' align='left' >".$anoadocao."</th>
					<th scope='row' align='left' >Dezembro</th>
					<td align='center'>".$adotados_mes12_caes."</td>
					<td align='center'>".$adotados_mes12_gatos."</td>
				  </tr>
				  <tr>
					<th scope='row' colspan='2'>TOTAL</th>
					<td class='text-danger' align='center'>$adotados_caes</td>
					<td class='text-danger' align='center'>$adotados_gatos</td>
				  </tr>
				  </tbody>
				 </table>
				 </center>
				 <br>
                           
                <center>
    	        <table class='table'>
                    <thead class='thead-light'>
            	    </thead>
                	<tbody>
                    	<tr>
        					<th scope='row' align='left'>Animais doados</th>
        					<td align='left'>: ".$animais_adotados."</td>
    					</tr>
    					<tr>
        					<th scope='row' align='left'>Animais doados castrados</th>
        					<td align='left'>: ".$animais_doados_castrados."</td>
    					</tr>
    					<tr>
        					<th scope='row' align='left'>Animais doados não castrados (menores de 5 meses)</th>
        					<td align='left'>: ".$animais_doados_naocastrados."</td>
    					</tr>
					</tbody>
				</table>
				</center>
				<br>
                <div class='bg-warning text-dark'>
                    <center><img src='http://gaarcampinas.org/area/imagens/estatisticas.png'></center>
                </div>
                <center>
        	        <table class='table'>
                        <thead class='thead-light'>
                        <tr>
        					<th scope='row'>Percentual de cães adotados</th>
        					<th>".number_format($perc_caes,2,',', '.')."%</th>
    					</tr>
                	    </thead>
                    	<tbody>
                    	<!--<tr>
        					<th>Na feira:</th>
        					<td>".number_format($perc_caes_feira,2,',', '.')."%</td>
    					</tr>
    					<tr>
        					<th>Fora da feira:</th>
        					<td>".number_format($perc_caes_forafeira,2,',', '.')."%</td>
    					</tr> -->
    					<tr>
        					<th>Fêmeas</th>
        					<td>".number_format($perc_caes_femeas,2,',', '.')."%</td>
    					</tr>
    					<tr>
        					<th>Machos</th>
        					<td>".number_format($perc_caes_machos,2,',', '.')."%</td>
    					</tr>
    					</tbody>
    				</table>
    				<br>
    				<table class='table'>
                        <thead class='thead-light'>
                        <tr>
        					<th scope='row'>Percentual de gatos adotados</th>
        					<th>".number_format($perc_gatos,2,',', '.')."%</th>
    					</tr>
                	    </thead>
                    	<tbody>
                    	<!--<tr>
        					<th>Na feira:</th>
        					<td>".number_format($perc_gatos_feira,2,',', '.')."%</td>
    					</tr>
    					<tr>
        					<th>Fora da feira:</th>
        					<td>".number_format($perc_gatos_forafeira,2,',', '.')."%</td>
    					</tr>-->
    					<tr>
        					<th>Fêmeas</th>
        					<td>".number_format($perc_gatos_femeas,2,',', '.')."%</td>
    					</tr>
    					<tr>
        					<th>Machos</th>
        					<td>".number_format($perc_gatos_machos,2,',', '.')."%</td>
    					</tr>
    					</tbody>
    				</table>
    			</center>
				
				<br>
                <center>
				    <table border='1'>
                    <thead class='thead-dark'>
    						  <tr>
    							<th scope='col' colspan='1'>&nbsp;</th>
    							<th scope='col' colspan='2'>DADOS DO ANIMAL</th>
    						    <th scope='col' colspan='4'>DADOS DA ADOÇÃO</th>
    						   </tr>
    				</thead> 
                    <thead class='thead-light'>
    						  <tr>
    						    <th scope='col'>ID do termo</th>
    							<th scope='col'>Animal</th>
    							<th scope='col'>Espécie</th>
    							<th scope='col'>Data</th>
    							<th scope='col'>Local</th>
    							<th scope='col'>Link do perfil</th>
    							<th scope='col'>Foto da adoção</th>
    						   </tr>
    				</thead>
    				<tbody>";
    				
    	$queryadotados = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND  DATA_ADOCAO LIKE '".$anoadocao."-".$mes_ant."-%' ORDER BY DATA_ADOCAO ASC";
        $resultadotados = mysqli_query($connect,$queryadotados);			    
    	
    	while ($fetchadotados = mysqli_fetch_row($resultadotados)) { 	
    	    
    	        $id = $fetchadotados[0];
    	        $nomedoanimal = $fetchadotados[15];
    	        $especie = $fetchadotados[16];
    	        $dtadocao = $fetchadotados[32];
    	        $localadocao = $fetchadotados[33];
    	        $idanimal = $fetchadotados[52];
    	        $foto_adotante = $fetchadotados[47]; 
    	        $autorizaimagem = $fetchadotados[51]; 

    	        $ano_dtadocao = substr($dtadocao,0,4);
    		    $mes_dtadocao = substr($dtadocao,5,2);
    		    $dia_dtadocao = substr($dtadocao,8,2);
    	        
                $mensagem .="<tr>
        			            <td>".$id."</td>
            					<td>".$nomedoanimal."</td>
            				    <td>".$especie."</td>
            				    <td>".$dia_dtadocao."/".$mes_dtadocao."</td>
            				    <td>".$localadocao."</td>
            				    <td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."'>Clique aqui</a></td>";
            				    if ($autorizaimagem == 'Sim') {
            				        $mensagem .="<td><a href='http://gaarcampinas.org/docs/adotantes/".$foto_adotante."' target='_blank'>Clique aqui</a></td>";  
            				    } else {
            				        $mensagem .="<td>Divulgação não autorizada</td>";
            				    }
            				    
            	$mensagem .="</tr>
                            ";
    	}
    				
    	$mensagem .="</tbody>
            	             </table>
            	             </center>
            	             <br>
            				
            	<div class='bg-warning text-dark'>
                    <center><img src='http://gaarcampinas.org/area/imagens/castracoes.png'></center>
                </div>
                
                <p>Para acessar o relatório de todos os procedimentos realizados no ano, <a href='https://gaarcampinas.org/castracoes.php'>clique aqui.</a></p>";
                
        $querydoc = "SELECT FILE FROM DOCUMENTACAO WHERE AREA_PRINCIPAL ='Administração' AND FILE LIKE 'prestacao_de_contas_".$mes_ant.$anoadocao."%'";
		$selectdoc = mysqli_query($connect,$querydoc);
		$tmp = mysqli_fetch_row($selectdoc);
		$reccountdoc = mysqli_num_rows($selectdoc);
        
        if ($reccountdoc == 0){
	        $log_file_msg="[enviorelatorioadocoes.php] Arquivo de despesa não encontrado às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
	    }else {
	        $arquivo = $tmp[0];
	        if ((strpos($arquivo, 'prestacao_de_contas') !== false) ) {
	            $file_to_attach = '/home/gaarca06/public_html/docs/financeiro/prestacaodecontas/'.$arquivo;
                $mail->addAttachment($file_to_attach, 'Despesas'); 
	        } elseif ((strpos($arquivo, 'planilha_financeiro') !== false)) {
	            $path_prestacao_xls = $arquivo;
	        }
	        
            $mensagem .= "<div class='bg-warning text-dark'>
                                    <center><img src='http://gaarcampinas.org/area/imagens/despesas.png'></center>
                                </div>
                                <center>
        			                <p> Anexada a prestação de contas do mês. Para visualizar o histórico <a href='https://gaarcampinas.org/transparencia/'>clique aqui</a>. Caso tenha alguma dúvida entre em contato pelo e-mail financeiro@gaarcampinas.org </p>
                                </center>
                        <br>";
	    }
	    
	    $mensagem.= "<center><p><strong>OBSERVAÇÕES</strong><br>
                    <i>Os valores apresentados são as informações cadastradas e foram coletadas pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail operacional@gaarcampinas.org</i><br>
                    Este e-mail foi enviado automaticamente pelo sistema </p></center>  
                    
                    <center><img src='http://gaarcampinas.org/area/imagens/footer.png'></center>

                <!--- BOOTSTRAP --->
                <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
                <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
                <!--- BOOTSTRAP --->  
                </font>
                
            </tbody>
            </html>
                    ";
        
        $bodytext = $mensagem;
        
        $subject = "[GAAR Campinas] Informativo mensal - ".$mes_ant."/".$anoadocao."";
        
        $mail->Subject   = $subject;
        $mail->Body      = $bodytext;
        $to = "contato@gaarcampinas.org";
        $mail->AddAddress($to);
        
        $query = "SELECT EMAIL FROM EMAIL_RELATORIO WHERE ENVIADO='NÃO' ORDER BY EMAIL ASC LIMIT 250";
        $select = mysqli_query($connect,$query);
        
        while ($fetch = mysqli_fetch_row($select)) {
            $to_vol =$fetch[0];
            $mail->AddBCC($to_vol);
            //$mail->AddAddress($to_vol);
            $lista_email .=", ".$to_vol;
            $queryupdate = "UPDATE EMAIL_RELATORIO SET ENVIADO='SIM' WHERE EMAIL='$to_vol'";
            $update = mysqli_query($connect,$queryupdate);
        }
        
        if (!$mail->send()) {
            $log_file_msg="[enviorelatorioadocoes.php] Erro de envio de informativo mensal: Mailer Error: " . $mail->ErrorInfo." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);
        } else {
            $log_file_msg="[enviorelatorioadocoes.php] Informativo mensal - ".$mes_ant."/".$anoadocao." enviado à ".$lista_email." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg); 
            
        }
        $mail->clearAddresses();
        //$lista_email = $to;
        $queryupdate2 = "UPDATE EMAIL_RELATORIO SET ENVIADO='NÃO'";
        $update2 = mysqli_query($connect,$queryupdate2);
        $log_file_msg="[enviorelatorioadocoes.php] Tabela EMAIL_RELATORIO atualizada para NÃO  às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);
        echo "<br> lista mail: ".$lista_email;
        $lista_email = "";
        fclose($fp);
        
        
		
mysqli_close($connect);

?>

