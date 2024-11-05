<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

        /** PAGAMENTO DE VETERINARIOS **/
        
        function pag_vet_mensal($ano_atu,$mes,$vet,$connect){
				$query = "SELECT VALOR,VALOR_TUTOR FROM PROCEDIMENTOS WHERE CLINICA = '".$vet."' AND DATA LIKE '".$ano_atu."-".$mes."-%' ORDER BY DATA ASC";
				$result = mysqli_query($connect,$query);
				$reccount = mysqli_num_rows($result);	
				
				$valor = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valorgaar = $fetch[0];
				    $valortutor = $fetch[1];
				    $valor = $valor + ($valorgaar + $valortutor);
				}
					
				return ($valor);
		}
		
		function pag_vet_anual($ano_atu,$vet,$connect){
				$query = "SELECT VALOR,VALOR_TUTOR FROM PROCEDIMENTOS WHERE CLINICA = '".$vet."' AND DATA LIKE '".$ano_atu."-%' ORDER BY DATA ASC";
				$result = mysqli_query($connect,$query);
				
				$valor = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valorgaar = $fetch[0];
				    $valortutor = $fetch[1];
				    $valor = $valor + ($valorgaar + $valortutor);
				}
					
				return($valor);
		}

		/*** RECEITAS **/
		
		function lancamentos_socios_ano($ano_atu,$connect){
				$query = "SELECT TIPO_LANC FROM FINANCEIRO WHERE TIPO_LANC = 'Sócio' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$qtde = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $qtde = $qtde + 1;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_socios($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Sócio' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
	
		function lancamentos_mensal_anual_socios($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Sócio' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_socios($mes_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Sócio' AND DATA_LANC LIKE '%-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_bazar($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Bazar' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_bazar($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Bazar' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_bazar($mes_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Bazar' AND DATA_LANC LIKE '%-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_doacoes($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Doações' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_doacoes($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Doações' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_doacoes($mes_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Doações' AND DATA_LANC LIKE '%-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_rifas($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Rifas' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_rifas($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Rifas' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_rifas($mes_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Rifas' AND DATA_LANC LIKE '%-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_nfp($ano_atu,$connect){
				$query = "SELECT VALOR_LANC FROM FINANCEIRO WHERE TIPO_LANC = 'NFP' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_nfp($ano_atu,$mes,$connect){
		    
		        $query = "SELECT VALOR_LANC FROM FINANCEIRO WHERE TIPO_LANC = 'NFP' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_vendas($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Vendas' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_vendas($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Vendas' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_taxasadocao($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Taxas' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_taxasadocao($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Taxas' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_juros($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Juros' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_juros($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Juros' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_outrosrec($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Outros-RECEITAS' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_outrosrec($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Outros-RECEITAS' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		/*** DESPESAS **/
		
		function lancamentos_anual_lt($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'LT' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_lt($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'LT' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_racao($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Ração' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_racao($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Ração' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_vet($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Veterinário' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_vet($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Veterinário' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_taxidog($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Taxi dog' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_taxidog($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Taxi dog' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_medicam($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Medicamentos' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_medicam($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Medicamentos' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_compras($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Compras' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_compras($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Compras' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_imposto($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Impostos' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_imposto($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Impostos' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_outrosdes($ano_atu,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Outros-despesas' AND DATA_LANC LIKE '".$ano_atu."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_outrosdes($ano_atu,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Outros-despesas' AND DATA_LANC LIKE '".$ano_atu."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
	
	$sumrec = 0;
	$sumdesp = 0;
	
	$ano_atu = date("Y");
	$mes_atu = date("m");
	$dia_atu = date("d");
	
	$dtatu = date("Y-m-d");
	
	$ano_atu = '2020';
	
	$mensagem = "<!DOCTYPE html>
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
                                        <h3>RELATÓRIO FINANCEIRO MENSAL</h3><br>
                                    </center>";
	
	$count_mes = 1;
	
	$mes = str_pad($count_mes, 2, '0',STR_PAD_LEFT);
	
	/*while ($count_mes <= $mes_atu){*/
	
	while ($count_mes <= 12){
    
            echo "<br>mes = ".$mes;
            echo "<br>mes_atu = ".$mes_atu;
            echo "<br>ano = ".$ano_atu;
            
            $somasocio = 0;
        	  
            $somabazar = 0;
            
            $somadoacoes = 0;
            
            $somarifas = 0;
            
            $somanfp = 0;
            
            $somavendas = 0;
            
            $somataxasadoc = 0;
            
            $somajuros = 0;
            
            $somaoutrosrec = 0;
            
            $totalRECEITAS = 0;
            
            $somasocio = lancamentos_mensal_anual_socios($ano_atu,$mes,$connect);
        	      	
          	$somabazar = lancamentos_mensal_anual_bazar($ano_atu,$mes,$connect);
          	
          	$somadoacoes = lancamentos_mensal_anual_doacoes($ano_atu,$mes,$connect);
          	
          	$somarifas = lancamentos_mensal_anual_rifas($ano_atu,$mes,$connect);
          	
          	$somanfp = lancamentos_mensal_anual_nfp($ano_atu,$mes,$connect);
          	
          	$somavendas = lancamentos_mensal_anual_vendas($ano_atu,$mes,$connect);
          	
          	$somataxasadocao = lancamentos_mensal_anual_taxasadocao($ano_atu,$mes,$connect);
          	
          	$somajuros = lancamentos_mensal_anual_juros($ano_atu,$mes,$connect);
        
          	$somaoutrosrec = lancamentos_mensal_anual_outrosrec($ano_atu,$mes,$connect);
        
          	$totalRECEITAS = floatval($somasocio) +
          	                 floatval($somabazar) +
          	                 floatval($somadoacoes) +
          	                 floatval($somarifas) +
          	                 floatval($somanfp) +
          	                 floatval($somavendas) +
          	                 floatval($somataxasadocao) +
          	                 floatval($somajuros) +
          	                 floatval($somaoutrosrec);
          	                 
          	/** DESPESAS **/
          	
          	$somalt = 0; 
          	
            $somavet = 0;
            
            $somaracao = 0;
            
            $somataxidog = 0;
            
            $somamedicam = 0;
            
            $somacompras = 0;
            
            $somaimposto = 0;
            
            $somaoutrosdes = 0;
            
            $totaldespesas - 0;
        	      	
          	$somalt = lancamentos_mensal_anual_lt($ano_atu,$mes,$connect);
          	
          	$somavet = lancamentos_mensal_anual_vet($ano_atu,$mes,$connect);
          	
          	$somaracao = lancamentos_mensal_anual_racao($ano_atu,$mes,$connect);
          	
          	$somataxidog = lancamentos_mensal_anual_taxidog($ano_atu,$mes,$connect);
          	
          	$somamedicam = lancamentos_mensal_anual_medicam($ano_atu,$mes,$connect);
          	
          	$somacompras = lancamentos_mensal_anual_compras($ano_atu,$mes,$connect);
          	
          	$somaimposto = lancamentos_mensal_anual_imposto($ano_atu,$mes,$connect);
          	
          	$somaoutrosdes = lancamentos_mensal_anual_outrosdes($ano_atu,$mes,$connect);
        
            $totaldespesas = floatval($somalt) +
                             floatval($somavet) +
                             floatval($somaracao) +
                             floatval($somataxidog) +
                             floatval($somamedicam) +
                             floatval($somacompras) +
                             floatval($somaimposto) +
                             floatval($somaoutrosdes);
                             
            $total = 0;
            
        	$total = floatval($totalRECEITAS) - floatval($totaldespesas);
        	
        	$acumtotal = floatval($acumtotal) + floatval($total);
        	
        	$acumtotalRECEITAS = floatval($acumtotalRECEITAS) + floatval($totalRECEITAS);
        	
        	$acumtotaldespesas = floatval($acumtotaldespesas) + floatval($totaldespesas);
        	                 
        	$perc_socios = (floatval ($somasocio) / floatval ($totalRECEITAS)) * 100;
        	
        	$perc_doacoes = (floatval ($somadoacoes) / floatval ($totalRECEITAS)) * 100;
        	$perc_bazar = (floatval ($somabazar) / floatval ($totalRECEITAS)) * 100;
        	$perc_nfp = (floatval ($somanfp) / floatval ($totalRECEITAS)) * 100;
        	$perc_rifas = (floatval ($somarifas) / floatval ($totalRECEITAS)) * 100;
        	$perc_vendas = (floatval ($somavendas) / floatval ($totalRECEITAS)) * 100;
        	$perc_taxas = (floatval ($somataxasadocao) / floatval ($totalRECEITAS)) * 100;
        	$perc_juros = (floatval ($somajuros) / floatval ($totalRECEITAS)) * 100;
        	$perc_outrosrec = (floatval ($somaoutrosrec) / floatval ($totalRECEITAS)) * 100;
        	$perc_rifas = (floatval ($somarifas) / floatval ($totalRECEITAS)) * 100;
            				                
            $perc_lt = (floatval ($somalt) / floatval ($totaldespesas)) * 100;
        	$perc_racao = (floatval ($somaracao) / floatval ($totaldespesas)) * 100;
        	$perc_vet = (floatval ($somavet) / floatval ($totaldespesas)) * 100;
        	$perc_taxidog = (floatval ($somataxidog) / floatval ($totaldespesas)) * 100;
        	$perc_medicam = (floatval ($somamedicam) / floatval ($totaldespesas)) * 100;
        	$perc_compras = (floatval ($somacompras) / floatval ($totaldespesas)) * 100;
        	$perc_imposto = (floatval ($somaimposto) / floatval ($totaldespesas)) * 100;
        	$perc_outrosdes = (floatval ($somaoutrosdes) / floatval ($totaldespesas)) * 100;
            
            $mensagem .= " <h3>".$mes."/".$ano_atu."</h3> <br>
                        	        <table class='table w-50 p-3'>
                                        <thead class='thead-light'>
                                            <tr>
        						                <th scope='col' align='left'>RECEITAS</th>
        						                <th scope='col' >VALOR TOTAL</th>
        						                <th scope='col' >% DE 100</th>
        						         </tr>
                                	    </thead>
                                    	<tbody>
                                    	<tr>
                        					<th scope='row' align='left'>Sócios</th>
                        					<td>R$ ".number_format($somasocio, 2, ',', '.')."</td>
                        					<td>".number_format($perc_socios, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Doações</th>
                        					<td>R$ ".number_format($somadoacoes, 2, ',', '.')."</td>
                        					<td>".number_format($perc_doacoes, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Bazar</th>
                        					<td>R$ ".number_format($somabazar, 2, ',', '.')."</td>
                        					<td>".number_format($perc_bazar, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Nota Fiscal Paulista</th>
                        					<td>R$ ".number_format($somanfp, 2, ',', '.')."</td>
                        					<td>".number_format($perc_nfp, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Rifas</th>
                        					<td>R$ ".number_format($somarifas, 2, ',', '.')."</td>
                        					<td>".number_format($perc_rifas, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Vendas de produtos</th>
                        					<td>R$ ".number_format($somavendas, 2, ',', '.')."</td>
                        					<td>".number_format($perc_vendas, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Taxas de adoção</th>
                        					<td>R$ ".number_format($somataxasadocao, 2, ',', '.')."</td>
                        					<td>".number_format($perc_taxas, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Juros de poupança</th>
                        					<td>R$ ".number_format($somajuros, 2, ',', '.')."</td>
                        					<td>".number_format($perc_juros, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Outras receitas</th>
                        					<td>R$ ".number_format($somaoutrosrec, 2, ',', '.')."</td>
                        					<td>".number_format($perc_outrosrec, 2, '.', '')."% </td>
                    					</tr>
                    					</tbody>
                    					</table>
                    					<br>
                    					
                    					<table class='table'>
                                        <thead class='thead-light'>
                                            <tr>
        						                <th scope='col' align='left'>DESPESAS</th>
        						                <th scope='col' >VALOR TOTAL</th>
        						                <th scope='col' >% DE 100</th>
        						         </tr>
                                	    </thead>
                                    	<tbody>
                    					<tr>
                        					<th scope='row' align='left'>Lares temporários</th>
                        					<td>R$ ".number_format($somalt, 2, ',', '.')."</td>
                        					<td>".number_format($perc_lt, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Ração</th>
                        					<td>R$ ".number_format($somaracao, 2, ',', '.')."</td>
                        					<td>".number_format($perc_racao, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Veterinários e clínicas (castrações, pequenas cirurgias, etc)</th>
                        					<td>R$ ".number_format($somavet, 2, ',', '.')."</td>
                        					<td>".number_format($perc_vet, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Táxi dog</th>
                        					<td>R$ ".number_format($somataxidog, 2, ',', '.')."</td>
                        					<td>".number_format($perc_taxidog, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Medicamentos (vacinas, vermífugos, anti-inflamatórios, antibióticos, etc)</th>
                        					<td>R$ ".number_format($somamedicam, 2, ',', '.')."</td>
                        					<td>".number_format($perc_medicam, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Compras (areia, caixa de areia, guias, coleiras, potinhos, caminhas, etc)</th>
                        					<td>R$ ".number_format($somacompras, 2, ',', '.')."</td>
                        					<td>".number_format($perc_compras, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Impostos bancários</th>
                        					<td>R$ ".number_format($somaimposto, 2, ',', '.')."</td>
                        					<td>".number_format($perc_imposto, 2, '.', '')."% </td>
                    					</tr>
                    					<tr>
                        					<th scope='row' align='left'>Outras despesas</th>
                        					<td>R$ ".number_format($somaoutrosdes, 2, ',', '.')."</td>
                        					<td>".number_format($perc_outrosdes, 2, '.', '')."% </td>
                    					</tr>
                    					</tbody>
                    				</table>
                    				<br>
                    				
                    				<table class='table'>
                    				<tbody>
                    				<tr>
                                                <th scope='col' class='thead-light' align='left'>RECEITAS </th>
                                                <td>R$ ".number_format($totalRECEITAS, 2, ',', '.')."</td>
                                        </tr>
                                    <tr>
                                                <th scope='col' class='thead-light' align='left'>DESPESAS </th>
                                                <td>R$ ".number_format($totaldespesas, 2, ',', '.')."</td>
                                        </tr>
                                    <tr>
                                                <th scope='col' class='thead-light' align='left'>TOTAL </th>";
                                                if ($total >= 0){
                                                    $mensagem .= "<td><strong><font color='blue'>R$ ".number_format($total, 2, ',', '.')."</font></strong></td>";
                                                } else {
                                                    $mensagem .= "<td><strong><font color='red'>R$ ".number_format($total, 2, ',', '.')."</font></strong></td>";
                                                }
                                                
                                    $mensagem .= "            
                                        </tr>
                    				</tbody>
                    				</table>
                    				<br><br>";
        
        $count_mes = $count_mes + 1;

        $mes = str_pad($count_mes, 2, '0',STR_PAD_LEFT);
    
	}
	
    ini_set('display_errors', 1);
        
	error_reporting(E_ALL);

	$from = "financeiro@gaarcampinas.org";
	
	$to = "thaise.piculi@gmail.com";
	
	$subject = "[GAAR Campinas] Relatório financeiro mensal";
	
	$headers = "MIME-Version: 1.0\n";               
	$headers .= "Content-type: text/html; charset=utf-8\n";            
	$headers .= "From: <{$from}> \r\n";
	$headers .= "Reply-To: <{$from}> \r\n";    

    $mensagem .= "
                    <table class='table'>
                    				<tbody>
                    				<tr>
                                                <th scope='col' class='thead-light' align='left'>RECEITAS ANUAIS </th>
                                                <td>R$ ".number_format($acumtotalRECEITAS, 2, ',', '.')."</td>
                                        </tr>
                                    <tr>
                                                <th scope='col' class='thead-light' align='left'>DESPESAS ANUAIS </th>
                                                <td>R$ ".number_format($acumtotaldespesas, 2, ',', '.')."</td>
                                        </tr>
                                    <tr>
                                                <th scope='col' class='thead-light' align='left'>TOTAL ANUAL </th>";
                                                if ($acumtotal >= 0){
                                                    $mensagem .= "<td><strong><font color='blue'>R$ ".number_format($acumtotal, 2, ',', '.')."</font></strong></td>";
                                                } else {
                                                    $mensagem .= "<td><strong><font color='red'>R$ ".number_format($acumtotal, 2, ',', '.')."</font></strong></td>";
                                                }
                                                
                                    $mensagem .= "            
                                        </tr>
                    				</tbody>
                    </table>
                    <!--- BOOTSTRAP --->
                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
                    <!--- BOOTSTRAP --->
                    </font>
                    </body>
                    </html>
    
                ";
	$message = $mensagem ;
	
	mail($to, $subject, $message, $headers);
    
    mysqli_close($connect);
		
		
?>