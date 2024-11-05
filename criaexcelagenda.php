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

$query = "SELECT * FROM AGENDAMENTO WHERE DATA_AG LIKE '2023-04-%' ORDER BY DATA_AG DESC";
$select = mysqli_query($connect,$query);
$reccount = mysqli_num_rows($select);


// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "castracoes_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('DATA DO AGENDAMENTO','HORARIO','CODIGO','CODIGO DO PROTETOR','NOME DO ANIMAL','ID DO GAAR','ESPECIE','SEXO','PORTE kg','NASCIMENTO','RESPONSÁVEL','CONTATO','AUTORIZADO POR','PROCEDIMENTO','EXTRA','PRODUTOS','VALOR GAAR','VALOR RESP','OBS'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 

while ($fetch = mysqli_fetch_row($select)) {
					$codmult = $fetch[0];	
					$datamulti = $fetch[1];
					$horamulti = $fetch[2];
					$nomedoanimal = $fetch[3];
					$especie = $fetch[4];
					$sexo = $fetch[5];
					$porte = $fetch[6];
					$idade = $fetch[8];
					$responsavel  = $fetch[9];
					$telresponsavel =  $fetch[11];
					$autorizadopor = $fetch[10];
					$clinica = $fetch[19];
					$tipoprocedi = $fetch[20];
					$ativo = $fetch[18];
					$idvet = $fetch[17];
					$realizado = $fetch[24];
					$idprotetor = $fetch[25]; 
					$idgaar = $fetch[23];
					$extra = $fetch[15];
					$obs = $fetch[17];
					$produtos = $fetch[16];
					$valorgaar = $fetch[14];
					$valorresp = $fetch[13];
					
					$queryvet = "SELECT * FROM CLINICAS WHERE ID='$clinica'";
                    $selectvet = mysqli_query($connect,$queryvet);
                    
                    while ($fetchvet = mysqli_fetch_row($selectvet)) {
                    	    $nomevet = $fetchvet[1];
                    }
					
					$ano_proc = substr($datamulti,0,4);
        		    $mes_proc = substr($datamulti,5,2);
        		    $dia_proc = substr($datamulti,8,2);
        		    
        		    $ano_idade_pet = substr($idade,0,4);
        		    $mes_idade_pet = substr($idade,5,2);
        		    $dia_idade_pet = substr($idade,8,2);
        		    
        		    $idade_pet = $dia_idade_pet."/".$mes_idade_pet."/".$ano_idade_pet;
        		    
        		    if ($reccount <> '0') {
        		        //$status = ($row['status'] == 1)?'Active':'Inactive'; 
                        $lineData = array($datamulti, $horamulti, $codmult, $idprotetor, $nomedoanimal, $idgaar, $especie, $sexo, $porte, $idade_pet, $responsavel, $telresponsavel, $autorizadopor, $tipoprocedi, $extra, $produtos, $valorgaar, $valorresp, $obs); 
                        $frutas_utf8 = array_map('utf8_encode', $lineData);
                        $string_frutas = implode(', ', $frutas_utf8);
                        echo $string_frutas."\n";
                        
                        array_walk($lineData, 'filterData'); 
                        $excelData .= implode("\t", array_values($lineData)) . "\n";    
        		    } else {
        		        $excelData .= 'No records found...'. "\n";    
        		    }

}

// Headers for download 
header("Content-Type: application/vnd.ms-excel; text/html; charset=UTF-8'"); 
mb_internal_encoding('UTF-8');
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 

mysqli_close($connect);
?>
