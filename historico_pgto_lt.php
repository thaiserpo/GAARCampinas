<?php 
session_start();

include ("conexao.php"); 
$dt_inicial = date("Y-m-01");
$dt_pgto = date("Y-m-05");
$ano_inicial = date("Y");
$mes_inicial = date("m");
$dia_inicial = "01";
$dt_atu = date("Y-m-d");
$dia_atu = date("d");
$mes_ant = date('m',strtotime('-1 months'));
$ultimo_dia = date("t", strtotime('-1 months'));
$periodo_de = $dia_inicial."/".$mes_ant."/".$ano_inicial;  

$querypet = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO='GAAR' AND (DATA_SAIDA_LT='0001-01-01' OR DATA_SAIDA_LT LIKE '".$ano_inicial."-".$mes_ant."-%') ORDER BY LAR_TEMPORARIO ASC";
$resultpet = mysqli_query($connect,$querypet); 


 echo "<table border='1'>
                <tr>
                    <th>Nome do animal</th>
                    <th>Total de dias</th>
                    <th>Valor diário</th>
                    <th>Valor total</th>
                    <th>Período</th>
                    <th>Status</th>
                    <th>Lar temporário</th>
                    <th>Responsável</th>
                    <th>Peso(kg)</th>
                    <th>Ração diária(gr)</th>
                    <th>Ração mensal(kg)</th>
                </tr>";

while ($fetchpet = mysqli_fetch_row($resultpet)) {
    $nomedoanimal = $fetchpet[1];
    $lt = $fetchpet[11];
    $responsavel = $fetchpet[12];
    $dtadocao = $fetchpet[14];
    $status=$fetchpet[10];
    $peso=$fetchpet[28];
    
    $ano_adocao = substr($dtadocao,0,4);
    $mes_adocao = substr($dtadocao,5,2);
	$dia_adocao = substr($dtadocao,8,2);
	
	if ($peso == 0){
	    $racao_dia = 0;
	}
	if ($peso >=1 && $peso <=5){
	    $racao_dia = 0.100;
	}
	if ($peso >=6 && $peso <=8){
	    $racao_dia = 0.120;
	}
	if ($peso >=9 && $peso <=10){
	    $racao_dia = 0.130;
	}
	if ($peso >=11 && $peso <=15){
	    $racao_dia = 0.200;
	}
	if ($peso >=16 && $peso <=20){
	    $racao_dia = 0.250;
	}
    if ($peso >=21 && $peso <=25){
	    $racao_dia = 0.376;
	}
    
    if ($dtadocao == '0001-01-01') {
        $periodo_ate = $ultimo_dia."/".$mes_ant."/".$ano_inicial;
    } else {
        $periodo_ate = $dia_adocao."/".$mes_adocao."/".$ano_adocao;
    }
    
    $querylt = "SELECT VALOR_DIA FROM LT WHERE LAR_TEMPORARIO='$lt'";
    $resultlt = mysqli_query($connect,$querylt);
    
    while ($fetchlt = mysqli_fetch_row($resultlt)) {
        $valor_dia = $fetchlt[0];
    }
    
    $dt_inicial_jul = gregoriantojd($mes_ant,$dia_inicial,$ano_inicial);
    
    $dt_final_jul = gregoriantojd($mes_ant,$ultimo_dia,$ano_inicial);
    
    $dias = intval($dt_final_jul) - intval($dt_inicial_jul);
    
    $qtde_dias = $dias + 1;
    
    $valor_total = floatval($valor_dia) * $qtde_dias;
    
    $sum_valor_total = floatval($sum_valor_total) + floatval($valor_total);
    
    $racao_mes = floatval($racao_dia) * $qtde_dias;
    
    $sum_racao_mes = floatval($sum_racao_mes) + floatval($racao_mes);
    
    if ($valor_total > 0) {
        /* "<br> nome do animal: ".$nomedoanimal;
        echo "<br> lar temporario: ".$lt;
        echo "<br> data adoção   : ".$dtadocao;
        echo "<br> valor total: ".$valor_total;*/
       
        echo "<tr>
                    <td>".$nomedoanimal."</td>
                    <td>".$qtde_dias."</td>
                    <td>R$ ".number_format($valor_dia,2,',', '.')."</td>
                    <td>R$ ".number_format($valor_total,2,',', '.')."</td>
                    <td>".$periodo_de." a ".$periodo_de."</td>
                    <td>".$status."</td>
                    <td>".$lt."</td>
                    <td>".$responsavel."</td>
                    <td>".$peso."</td>
                    <td>".$racao_dia."</td>
                    <td>".round($racao_mes)."</td>
                </tr>
                    ";

        $query = "INSERT INTO HISTORICO_PAG_LT
    					(NOME_ANIMAL, 
    					LAR_TEMPORARIO, 
    					RESPONSAVEL, 
    					VALOR_DIA, 
    					VALOR_PAGO, 
    					DATA_PGTO, 
    					PERIODO_INICIAL, 
    					PERIODO_FINAL, 
    					QTDE_DIAS, 
    					MES_VIGENTE, 
    					ANO_VIGENTE,
    					ADOTADO) 
    					VALUES
                        ('$nomedoanimal',
                        '$lt',
                        '$responsavel',
                        '$valor_dia',
                        '$valor_total',
                        '$dt_pgto',
                        '$periodo_de',
                        '$periodo_de',
                        '$qtde_dias',
                        '$mes_ant',
                        '$ano_inicial',
                        '$status')";
    						
            $insert = mysqli_query($connect,$query); 	
    		 
           if(mysqli_errno($connect) != '0'){
               
                ini_set('display_errors', 1);
        
            	error_reporting(E_ALL);
            
            	$from = "operacional@gaarcampinas.org";
            	
            	$to = "thaise.piculi@gmail.com";
            	
            	$subject = "[GAAR Campinas] Erro ao cadastrar - tabela HISTORICO_PAG_LT";
            	
            	$headers = "MIME-Version: 1.0\n";               
            	$headers .= "Content-type: text/html; charset=utf-8\n";            
            	$headers .= "From: <{$from}> \r\n";
            	$headers .= "Reply-To: <{$from}> \r\n";    
                $mensagem .= "Insert code: ".$insert." <br> Mensagem de erro: ".mysql_error()."SQL Error: ".mysql_errno()."";
    	  }

echo "<tr>
                    <th colspan='3'>&nbsp;</th>
                    <th>R$ ".number_format($sum_valor_total,2,',', '.')."</th>
                    <th colspan='6'>&nbsp;</th>
                    <th>".round($sum_racao_mes)."kg</th>
                </tr>
                ";
echo "</table>";
}
}
?>
