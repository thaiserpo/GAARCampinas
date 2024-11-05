<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
} else {
	
		  $queryarea = "SELECT AREA,SUBAREA,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		  $selectarea = mysqli_query($connect,$queryarea);
		
		  while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
				$emailvoluntario = $fetcharea[2];
		  }
	
		$ano = $_POST['ano'];
		$tiporelatorio = $_POST['tiporelatorio'];
		$mes = $_POST['mes'];
		$mes_ant_sis = date('m',strtotime('-1 months'));
		/*$mes_ant_pesq = int($mes) - 1 ;*/
		$banco = $_POST['banco'];
		
		if ($tiporelatorio == '') {
		    echo"<script language='javascript' type='text/javascript'>
          alert('Escolha o tipo do relatório');window.location
          .href='relatorio_financeiro.php'</script>";
		    
		}else {
	/*	echo "ano: ".$ano;
		echo "<br>tiporelatorio: ".$tiporelatorio;
		echo "<br>mes: ".$mes;*/
	
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Meta tags Obrigatórias -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <title>GAAR - Relatório contábil</title>
    
</head>
<body> 
<?php 
		
		switch ($area) {
				  case 'operacional':
				  	include_once("menu_operacional.php") ;
					break;
				  case 'diretoria':
				  	include_once("menu_diretoria.php") ;
					break;
				  case 'captacao':
				  	include_once("menu_captacao.php") ;
					break;
     			  case 'financeiro':
				  	include_once("menu_financeiro.php") ;
					break;
				  case 'admin':
				  	include_once("menu_admin.php") ;
					break;
				  case 'comunicacao':
				  	include_once("menu_comunicacao.php") ;
					break;
				  
			  }
			  
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
        <div class="d-none d-print-block">
            <center><img src="/area/logo_transparent.png" width="70" height="70"></center>
        </div>
<?

        /** SOMATÓRIA DO SUBTIPO LANÇAMENTO **/
        function select_subtipolanc_mensal($anolanc_func,$meslanc_func,$subtipolanc_func,$connect){
				$querysumvalor = "SELECT SUM(VALOR_LANC) FROM FINANCEIRO WHERE DATA_LANC LIKE '".$anolanc_func."-".$meslanc_func."-%' AND SUBTIPO_LANC = '".$subtipolanc_func."'";
				$resultsumvalor = mysqli_query($connect,$querysumvalor);
			    $rc = mysqli_fetch_row($resultsumvalor);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}

        /** PAGAMENTO DE VETERINARIOS **/
        
        function pag_vet_mensal($ano,$mes,$vet,$connect){
				$query = "SELECT VALOR,VALOR_TUTOR FROM PROCEDIMENTOS WHERE CLINICA = '".$vet."' AND DATA LIKE '".$ano."-".$mes."-%' ORDER BY DATA ASC";
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
		
		function pag_vet_anual($ano,$vet,$connect){
				$query = "SELECT VALOR,VALOR_TUTOR FROM PROCEDIMENTOS WHERE CLINICA = '".$vet."' AND DATA LIKE '".$ano."-%' ORDER BY DATA ASC";
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
		
		function lancamentos_socios_ano($ano,$connect){
				$query = "SELECT SUBTIPO_LANC FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Sócio' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$qtde = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $qtde = $qtde + 1;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_socios($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Sócio' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
	
		function lancamentos_mensal_anual_socios($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Sócio' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_socios($mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Sócio' AND DATA_LANC LIKE '%-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_bazar($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Bazar' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_bazar($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Bazar' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_bazar($mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Bazar' AND DATA_LANC LIKE '%-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_doacoes($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Doações' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_doacoes($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Doações' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_doacoes($mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Doações' AND DATA_LANC LIKE '%-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_rifas($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Rifas' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_rifas($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Rifas' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_rifas($mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Rifas' AND DATA_LANC LIKE '%-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_nfp($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'NFP' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_nfp($ano,$mes,$area,$connect){
		        if ($area =='diretoria') {
		            $query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'NFP' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
		        } else {
		            $query = "SELECT VALOR_LANC FROM FINANCEIRO WHERE SUBTIPO_LANC = 'NFP' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
		        }
				
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_vendas($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Vendas' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_vendas($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Vendas' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_taxasadocao($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Taxas' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_taxasadocao($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Taxas' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_juros($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Juros' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_juros($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Juros' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_outrosrec($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Outros-receitas' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_outrosrec($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Outros-receitas' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		/*** DESPESAS **/
		
		function lancamentos_anual_lt($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'LT' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_lt($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'LT' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_racao($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Ração' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_racao($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Ração' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_vet($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Veterinário' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_vet($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Veterinário' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_taxidog($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Taxi dog' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_taxidog($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Taxi dog' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_medicam($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Medicamentos' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_medicam($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Medicamentos' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_compras($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Compras' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_compras($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Compras' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_imposto($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Impostos' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_imposto($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Impostos' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_outrosdes($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Outros-despesas' AND DATA_LANC LIKE '".$ano."-%'";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_outrosdes($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Outros-despesas' AND DATA_LANC LIKE '".$ano."-".$mes."-%'";
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
	
	switch ($tiporelatorio) {
	    case 'Sócios':
	    
    	    if ($ano != 'branco' && $mes == 'branco' && $banco ==''){
    	        echo "<center>
                           <br>
                            <h3>RELATÓRIO DE LANÇAMENTOS DIÁRIOS - SÓCIOS</h3><br>
                            <h5>ANO ".$ano."</h5>
                       </center>";
    	        echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>Data</th>";
            	echo "<th scope='col'>Descrição</th>";
            	echo "<th scope='col'>Tipo</th>";
            	echo "<th scope='col'>Categoria</th>";
            	echo "<th scope='col'>Valor</th>";
            	if ($area =='diretoria'){
            	    echo "<th scope='col'>Valor contábil</th>";
            	}
            	echo "<th scope='col'>Banco</th>";
            	echo "<th scope='col' colspan='2' align='center'>&nbsp</th>";
            	echo "</thead>";
            	echo "<tbody>";
            	
            	$querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Sócio' and DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC ASC";
    		    $resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
    
    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
    	            $idlanc = $fetchlanc_dia_ano[0];
    				$dtlanc = $fetchlanc_dia_ano[1];
    				$desclanc = $fetchlanc_dia_ano[2];
    				$tipolanc = $fetchlanc_dia_ano[3];
    				$valorlanc = $fetchlanc_dia_ano[4];
    				$valorcont = $fetchlanc_dia_ano[8];
    				$bancolanc = $fetchlanc_dia_ano[6];
    			    $categoria = 'Receita';
    				$sum = floatval($sum) + floatval($valorlanc);
            			echo "<tr>";
            			echo "<td>".$dtlanc."</td>";
    					echo "<td>".$desclanc."</td>";
    					echo "<td>".$tipolanc."</td>";
    					echo "<td>".$categoria."</td>";
    					echo "<td>R$ ".number_format($valorlanc,2,',', '.')."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td>R$ ".number_format($valorcont,2,',', '.')."</td>";
                    	}
    					echo "<td>".$bancolanc."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                    	}
                    	echo "<td><a href='formatualizalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Atualizar</a></td>";
    					echo "<td>&nbsp;</td>";
    				    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
    		
    		    
    		  echo"<center><h5>TOTAL ANUAL</h5></center>
    	                <div class='form-group row'>
                              <label class='col-sm-2 col-form-label'><strong>Receitas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sum,2,',', '.')."</label> 
                              </div>
                        </div>";
            	
            	
            	
            	
            	
    	    }
    	    
    	    if ($ano == 'branco' && $mes != 'branco' && $banco ==''){
    	        echo "<center>
                           <br>
                            <h3>RELATÓRIO DE LANÇAMENTOS DIÁRIOS - SÓCIOS</h3><br>
                            <h5>MÊS ".$mes." </h5>
                       </center>";
    	        echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>Data</th>";
            	echo "<th scope='col'>Descrição</th>";
            	echo "<th scope='col'>Tipo</th>";
            	echo "<th scope='col'>Categoria</th>";
            	echo "<th scope='col'>Valor</th>";
            	if ($area =='diretoria'){
            	    echo "<th scope='col'>Valor contábil</th>";
            	}
            	echo "<th scope='col'>Banco</th>";
            	echo "<th scope='col' colspan='2' align='center'>&nbsp</th>";
            	echo "</thead>";
            	echo "<tbody>";
            	
            	$querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Sócio' and DATA_LANC LIKE '%-".$mes."-%' ORDER BY DATA_LANC ASC";
    		    $resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
    
    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
    	            $idlanc = $fetchlanc_dia_ano[0];
    				$dtlanc = $fetchlanc_dia_ano[1];
    				$desclanc = $fetchlanc_dia_ano[2];
    				$tipolanc = $fetchlanc_dia_ano[3];
    				$valorlanc = $fetchlanc_dia_ano[4];
    				$valorcont = $fetchlanc_dia_ano[8];
    				$bancolanc = $fetchlanc_dia_ano[6];
    			    $categoria = 'Receita';
    				$sum = floatval($sum) + floatval($valorlanc);
            			echo "<tr>";
            			echo "<td>".$dtlanc."</td>";
    					echo "<td>".$desclanc."</td>";
    					echo "<td>".$tipolanc."</td>";
    					echo "<td>".$categoria."</td>";
    					echo "<td>R$ ".number_format($valorlanc,2,',', '.')."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td>R$ ".number_format($valorcont,2,',', '.')."</td>";
                    	}
    					echo "<td>".$bancolanc."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                    	}
                    	echo "<td><a href='formatualizalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Atualizar</a></td>";
    					echo "<td>&nbsp;</td>";
    				    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
    		
    		    
    		  echo"<center><h5>TOTAL MENSAL</h5></center>
    	                <div class='form-group row'>
                              <label class='col-sm-2 col-form-label'><strong>Receitas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sum,2,',', '.')."</label> 
                              </div>
                        </div>";
    	
            	
    	    }
    	    
    	    if ($ano == 'branco' && $mes == 'branco' && $banco !=''){
    	        echo "<center>
                           <br>
                            <h3>RELATÓRIO DE LANÇAMENTOS DIÁRIOS - SÓCIOS</h3><br>
                            <h5>BANCO ".$banco." </h5>
                       </center>";
    	        echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>Data</th>";
            	echo "<th scope='col'>Descrição</th>";
            	echo "<th scope='col'>Tipo</th>";
            	echo "<th scope='col'>Categoria</th>";
            	echo "<th scope='col'>Valor</th>";
            	if ($area =='diretoria'){
            	    echo "<th scope='col'>Valor contábil</th>";
            	}
            	echo "<th scope='col'>Banco</th>";
            	echo "<th scope='col' colspan='2' align='center'>&nbsp</th>";
            	echo "</thead>";
            	echo "<tbody>";
            	
            	$querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Sócio' and BANCO_LANC = '".$banco."' ORDER BY DATA_LANC ASC";
    		    $resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
    
    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
    	            $idlanc = $fetchlanc_dia_ano[0];
    				$dtlanc = $fetchlanc_dia_ano[1];
    				$desclanc = $fetchlanc_dia_ano[2];
    				$tipolanc = $fetchlanc_dia_ano[3];
    				$valorlanc = $fetchlanc_dia_ano[4];
    				$valorcont = $fetchlanc_dia_ano[8];
    				$bancolanc = $fetchlanc_dia_ano[6];
    			    $categoria = 'Receita';
    				$sum = floatval($sum) + floatval($valorlanc);
            			echo "<tr>";
            			echo "<td>".$dtlanc."</td>";
    					echo "<td>".$desclanc."</td>";
    					echo "<td>".$tipolanc."</td>";
    					echo "<td>".$categoria."</td>";
    					echo "<td>R$ ".number_format($valorlanc,2,',', '.')."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td>R$ ".number_format($valorcont,2,',', '.')."</td>";
                    	}
    					echo "<td>".$bancolanc."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                    	}
                    	echo "<td><a href='formatualizalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Atualizar</a></td>";
    					echo "<td>&nbsp;</td>";
    				    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
    		
    		    
    		  echo"<center><h5>TOTAL ANUAL</h5></center>
    	                <div class='form-group row'>
                              <label class='col-sm-2 col-form-label'><strong>Receitas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sum,2,',', '.')."</label> 
                              </div>
                        </div>";
    	
            	
    	    }
    	    
    	    if ($ano != 'branco' && $mes != 'branco' && $banco ==''){
    	        echo "<center>
                           <br>
                            <h3>RELATÓRIO DE LANÇAMENTOS DIÁRIOS - SÓCIOS</h3><br>
                            <h5>ANO ".$ano."</h5>
                       </center>";
    	        echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>Data</th>";
            	echo "<th scope='col'>Descrição</th>";
            	echo "<th scope='col'>Tipo</th>";
            	echo "<th scope='col'>Categoria</th>";
            	echo "<th scope='col'>Valor</th>";
            	if ($area =='diretoria'){
            	    echo "<th scope='col'>Valor contábil</th>";
            	}
            	echo "<th scope='col'>Banco</th>";
            	echo "<th scope='col' colspan='2' align='center'>&nbsp</th>";
            	echo "</thead>";
            	echo "<tbody>";
            	
            	$querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Sócio' and DATA_LANC LIKE '".$ano."-".$mes."%' ORDER BY DATA_LANC ASC";
    		    $resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
    
    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
    	            $idlanc = $fetchlanc_dia_ano[0];
    				$dtlanc = $fetchlanc_dia_ano[1];
    				$desclanc = $fetchlanc_dia_ano[2];
    				$tipolanc = $fetchlanc_dia_ano[3];
    				$valorlanc = $fetchlanc_dia_ano[4];
    				$valorcont = $fetchlanc_dia_ano[8];
    				$bancolanc = $fetchlanc_dia_ano[6];
    			    $categoria = 'Receita';
    				$sum = floatval($sum) + floatval($valorlanc);
            			echo "<tr>";
            			echo "<td>".$dtlanc."</td>";
    					echo "<td>".$desclanc."</td>";
    					echo "<td>".$tipolanc."</td>";
    					echo "<td>".$categoria."</td>";
    					echo "<td>R$ ".number_format($valorlanc,2,',', '.')."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td>R$ ".number_format($valorcont,2,',', '.')."</td>";
                    	}
    					echo "<td>".$bancolanc."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                    	}
                    	echo "<td><a href='formatualizalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Atualizar</a></td>";
    					echo "<td>&nbsp;</td>";
    				    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
    		
    		    
    		  echo"<center><h5>TOTAL ANUAL</h5></center>
    	                <div class='form-group row'>
                              <label class='col-sm-2 col-form-label'><strong>Receitas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sum,2,',', '.')."</label> 
                              </div>
                        </div>";
            	
            	
            	
            	
            	
    	    }
    	    
    	    if ($ano != 'branco' && $mes != 'branco' && $banco !=''){
    	        echo "<center>
                           <br>
                            <h3>RELATÓRIO DE LANÇAMENTOS DIÁRIOS - SÓCIOS</h3><br>
                            <h5>ANO ".$ano."</h5>
                       </center>";
    	        echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>Data</th>";
            	echo "<th scope='col'>Descrição</th>";
            	echo "<th scope='col'>Tipo</th>";
            	echo "<th scope='col'>Categoria</th>";
            	echo "<th scope='col'>Valor</th>";
            	if ($area =='diretoria'){
            	    echo "<th scope='col'>Valor contábil</th>";
            	}
            	echo "<th scope='col'>Banco</th>";
            	echo "<th scope='col' colspan='2' align='center'>&nbsp</th>";
            	echo "</thead>";
            	echo "<tbody>";
            	
            	$querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Sócio' and DATA_LANC LIKE '".$ano."-".$mes."%' and BANCO_LANC = '".$banco."' ORDER BY DATA_LANC ASC";
    		    $resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
    
    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
    	            $idlanc = $fetchlanc_dia_ano[0];
    				$dtlanc = $fetchlanc_dia_ano[1];
    				$desclanc = $fetchlanc_dia_ano[2];
    				$tipolanc = $fetchlanc_dia_ano[3];
    				$valorlanc = $fetchlanc_dia_ano[4];
    				$valorcont = $fetchlanc_dia_ano[8];
    				$bancolanc = $fetchlanc_dia_ano[6];
    			    $categoria = 'Receita';
    				$sum = floatval($sum) + floatval($valorlanc);
            			echo "<tr>";
            			echo "<td>".$dtlanc."</td>";
    					echo "<td>".$desclanc."</td>";
    					echo "<td>".$tipolanc."</td>";
    					echo "<td>".$categoria."</td>";
    					echo "<td>R$ ".number_format($valorlanc,2,',', '.')."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td>R$ ".number_format($valorcont,2,',', '.')."</td>";
                    	}
    					echo "<td>".$bancolanc."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                    	}
                    	echo "<td><a href='formatualizalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Atualizar</a></td>";
    					echo "<td>&nbsp;</td>";
    				    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
    		
    		    
    		  echo"<center><h5>TOTAL ANUAL</h5></center>
    	                <div class='form-group row'>
                              <label class='col-sm-2 col-form-label'><strong>Receitas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sum,2,',', '.')."</label> 
                              </div>
                        </div>";
    
    	    }
    	    
    	    if ($ano == 'branco' && $mes == 'branco' && $banco ==''){
    	        echo "<center>
                           <br>
                            <h3>RELATÓRIO DE LANÇAMENTOS DIÁRIOS - SÓCIOS</h3><br>
                       </center>";
    	        echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>Data</th>";
            	echo "<th scope='col'>Descrição</th>";
            	echo "<th scope='col'>Tipo</th>";
            	echo "<th scope='col'>Categoria</th>";
            	echo "<th scope='col'>Valor</th>";
            	if ($area =='diretoria'){
            	    echo "<th scope='col'>Valor contábil</th>";
            	}
            	echo "<th scope='col'>Banco</th>";
            	echo "<th scope='col' colspan='2' align='center'>&nbsp</th>";
            	echo "</thead>";
            	echo "<tbody>";
            	
            	$querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE SUBTIPO_LANC = 'Sócio' ORDER BY DATA_LANC ASC";
    		    $resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
    
    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
    	            $idlanc = $fetchlanc_dia_ano[0];
    				$dtlanc = $fetchlanc_dia_ano[1];
    				$desclanc = $fetchlanc_dia_ano[2];
    				$tipolanc = $fetchlanc_dia_ano[3];
    				$valorlanc = $fetchlanc_dia_ano[4];
    				$valorcont = $fetchlanc_dia_ano[8];
    				$bancolanc = $fetchlanc_dia_ano[6];
    			    $categoria = 'Receita';
    				$sum = floatval($sum) + floatval($valorlanc);
            			echo "<tr>";
            			echo "<td>".$dtlanc."</td>";
    					echo "<td>".$desclanc."</td>";
    					echo "<td>".$tipolanc."</td>";
    					echo "<td>".$categoria."</td>";
    					echo "<td>R$ ".number_format($valorlanc,2,',', '.')."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td>R$ ".number_format($valorcont,2,',', '.')."</td>";
                    	}
    					echo "<td>".$bancolanc."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                    	}
                    	echo "<td><a href='formatualizalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Atualizar</a></td>";
    					echo "<td>&nbsp;</td>";
    				    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
    		
    		    
    		  echo"<center><h5>TOTAL ANUAL</h5></center>
    	                <div class='form-group row'>
                              <label class='col-sm-2 col-form-label'><strong>Receitas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sum,2,',', '.')."</label> 
                              </div>
                        </div>";
            	
            	
    	    }
    	    
            break;
        
        case 'Lançamentos diários':
	    
    	    if ($ano != 'branco' && $mes == 'branco' && $banco ==''){
    	        echo "<center>
                           <br>
                            <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS DIÁRIOS</h3><br>
                            <h5>ANO ".$ano."</h5>
                       </center>";
    	        echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>Data</th>";
            	echo "<th scope='col'>Descrição</th>";
            	echo "<th scope='col'>Tipo</th>";
            	echo "<th scope='col'>Categoria</th>";
            	echo "<th scope='col'>Valor</th>";
            	if ($area =='diretoria'){
            	    echo "<th scope='col'>Valor contábil</th>";
            	}
            	echo "<th scope='col'>Banco</th>";
            	echo "<th scope='col' colspan='2' align='center'>&nbsp</th>";
            	echo "</thead>";
            	echo "<tbody>";
            	
    			$querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC ASC";
    		    $resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
    
    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
    	            $idlanc = $fetchlanc_dia_ano[0];
    				$dtlanc = $fetchlanc_dia_ano[1];
    				$desclanc = $fetchlanc_dia_ano[2];
    				$tipolanc = $fetchlanc_dia_ano[3];
    				$valorlanc = $fetchlanc_dia_ano[4];
    				$valorcont = $fetchlanc_dia_ano[8];
    				$bancolanc = $fetchlanc_dia_ano[6];
    				$sum = floatval($sum) + floatval($valorlanc);
    				
    				if ($tipolanc =='Sócio' || $tipolanc =='Bazar' || $tipolanc =='Doações' || $tipolanc =='Rifas' || $tipolanc =='NFP' || $tipolanc =='Vendas' || $tipolanc =='Taxas' || $tipolanc =='Juros' || $tipolanc =='Outros-receitas'){
        				$sumrec = floatval($sumrec) + floatval($valorlanc);
        				$categoria = 'Receita';
        					
        			}  
        			
        			if ($tipolanc =='LT' || $tipolanc =='Veterinário'|| $tipolanc =='Taxi dog' || $tipolanc =='Medicamentos' || $tipolanc =='Compras' || $tipolanc =='Impostos' || $tipolanc =='Outros-despesas'){
        				$sumdesp = floatval($sumdesp) + floatval($valorlanc);
        				$categoria = 'Despesa';
        					
        			}   
            			echo "<tr>";
            			echo "<td>".$dtlanc."</td>";
    					echo "<td>".$desclanc."</td>";
    					echo "<td>".$tipolanc."</td>";
    					echo "<td>".$categoria."</td>";
    					echo "<td>R$ ".number_format($valorlanc,2,',', '.')."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td>R$ ".number_format($valorcont,2,',', '.')."</td>";
                    	}
    					echo "<td>".$bancolanc."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                    	}
                    	echo "<td><a href='formatualizalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Atualizar</a></td>";
    					echo "<td>&nbsp;</td>";
    				    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
    		
    		    
    		  echo"<center><h5>TOTAL ANUAL</h5></center>
    	                <div class='form-group row'>
                              <label class='col-sm-2 col-form-label'><strong>Receitas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sumrec,2,',', '.')."</label> 
                              </div>
                              <label class='col-sm-2 col-form-label'><strong>Despesas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sumdesp,2,',', '.')."</label> 
                              </div>
                        </div>";
    	    }
    	    
    	    if ($ano != 'branco' && $mes != 'branco' && $banco ==''){
    	        echo "<center>
                           <br>
                            <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS DIÁRIOS</h3><br>
                            <h5>ANO ".$ano." - MÊS ".$mes."</h5>
                       </center>";
    	        echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>Data</th>";
            	echo "<th scope='col'>Descrição</th>";
            	echo "<th scope='col'>Tipo</th>";
            	echo "<th scope='col'>Valor</th>";
            	if ($area =='diretoria'){
            	    echo "<th scope='col'>Valor contábil</th>";
            	}
            	echo "<th scope='col'>Banco</th>";
            	echo "<th scope='col' colspan='1' align='center'>&nbsp</th>";
            	echo "</thead>";
            	echo "<tbody>";
            	
    			$querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE DATA_LANC LIKE '".$ano."-".$mes."%' ORDER BY DATA_LANC ASC";
    		    $resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
    
    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
    	            $idlanc = $fetchlanc_dia_ano[0];
    				$dtlanc = $fetchlanc_dia_ano[1];
    				$desclanc = $fetchlanc_dia_ano[2];
    				$tipolanc = $fetchlanc_dia_ano[3];
    				$valorlanc = $fetchlanc_dia_ano[4];
    				$valorcont = $fetchlanc_dia_ano[8];
    				$bancolanc = $fetchlanc_dia_ano[6];
    				$sum = floatval($sum) + floatval($valorlanc);
    				
    				if ($tipolanc =='Sócio' || $tipolanc =='Bazar' || $tipolanc =='Doações' || $tipolanc =='Rifas' || $tipolanc =='NFP' || $tipolanc =='Vendas' || $tipolanc =='Taxas' || $tipolanc =='Juros' || $tipolanc =='Outros-receitas'){
        				$sumrec = floatval($sumrec) + floatval($valorlanc);
        				$categoria = 'Receita';
        					
        			}  
        			
        			if ($tipolanc =='LT' || $tipolanc =='Veterinário'|| $tipolanc =='Taxi dog' || $tipolanc =='Medicamentos' || $tipolanc =='Compras' || $tipolanc =='Impostos' || $tipolanc =='Outros-despesas'){
        				$sumdesp = floatval($sumdesp) + floatval($valorlanc);
        				$categoria = 'Despesa';
        					
        			}   
            			echo "<tr>";
            			echo "<td>".$dtlanc."</td>";
    					echo "<td>".$desclanc."</td>";
    					echo "<td>".$tipolanc."</td>";
    					echo "<td>R$ ".number_format($valorlanc,2,',', '.')."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td>R$ ".number_format($valorcont,2,',', '.')."</td>";
                    	}
    					echo "<td>".$bancolanc."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                    	}
                    	echo "<td><a href='formatualizalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Atualizar</a></td>";
    					echo "<td>&nbsp;</td>";
    				    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
    		    
    		  echo"<center><h5>TOTAL MENSAL</h5></center>
    	                <div class='form-group row'>
                              <label class='col-sm-2 col-form-label'><strong>Receitas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sumrec,2,',', '.')."</label> 
                              </div>
                              <label class='col-sm-2 col-form-label'><strong>Despesas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sumdesp,2,',', '.')."</label> 
                              </div>
                        </div>";
    	    }
    	    
    	    if ($ano == 'branco' && $mes != 'branco' && $banco ==''){
    	        echo "<center>
                           <br>
                            <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS DIÁRIOS</h3><br>
                            <h5>MÊS ".$mes."</h5>
                       </center>";
    	        echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>Data</th>";
            	echo "<th scope='col'>Descrição</th>";
            	echo "<th scope='col'>Tipo</th>";
            	echo "<th scope='col'>Valor</th>";
            	if ($area =='diretoria'){
            	    echo "<th scope='col'>Valor contábil</th>";
            	}
            	echo "<th scope='col'>Banco</th>";
            	echo "<th scope='col' colspan='3' align='center'>&nbsp</th>";
            	echo "</thead>";
            	echo "<tbody>";
            	
    			$querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE DATA_LANC LIKE '%-".$mes."%' ORDER BY DATA_LANC ASC";
    		    $resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
    
    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
    	            $idlanc = $fetchlanc_dia_ano[0];
    				$dtlanc = $fetchlanc_dia_ano[1];
    				$desclanc = $fetchlanc_dia_ano[2];
    				$tipolanc = $fetchlanc_dia_ano[3];
    				$valorlanc = $fetchlanc_dia_ano[4];
    				$valorcont = $fetchlanc_dia_ano[8];
    				$bancolanc = $fetchlanc_dia_ano[6];
    				$sum = floatval($sum) + floatval($valorlanc);
    				
    				if ($tipolanc =='Sócio' || $tipolanc =='Bazar' || $tipolanc =='Doações' || $tipolanc =='Rifas' || $tipolanc =='NFP' || $tipolanc =='Vendas' || $tipolanc =='Taxas' || $tipolanc =='Juros' || $tipolanc =='Outros-receitas'){
        				$sumrec = floatval($sumrec) + floatval($valorlanc);
        				$categoria = 'Receita';
        					
        			}  
        			
        			if ($tipolanc =='LT' || $tipolanc =='Veterinário'|| $tipolanc =='Taxi dog' || $tipolanc =='Medicamentos' || $tipolanc =='Compras' || $tipolanc =='Impostos' || $tipolanc =='Outros-despesas'){
        				$sumdesp = floatval($sumdesp) + floatval($valorlanc);
        				$categoria = 'Despesa';
        					
        			}   
            			echo "<tr>";
            			echo "<td>".$dtlanc."</td>";
    					echo "<td>".$desclanc."</td>";
    					echo "<td>".$tipolanc."</td>";
    					echo "<td>R$ ".number_format($valorlanc,2,',', '.')."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td>R$ ".number_format($valorcont,2,',', '.')."</td>";
                    	}
    					echo "<td>".$bancolanc."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                    	}
                    	echo "<td><a href='formatualizalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Atualizar</a></td>";
    					echo "<td>&nbsp;</td>";
    				    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
    		
    		    
    		  echo"<center><h5>TOTAL MENSAL</h5></center>
    	                <div class='form-group row'>
                              <label class='col-sm-2 col-form-label'><strong>Receitas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sumrec,2,',', '.')."</label> 
                              </div>
                              <label class='col-sm-2 col-form-label'><strong>Despesas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sumdesp,2,',', '.')."</label> 
                              </div>
                        </div>";
    	    }
    	    
    	    if ($ano == 'branco' && $mes != 'branco' && $banco !=''){
    	        echo "<center>
                           <br>
                            <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS DIÁRIOS</h3><br>
                            <h5>MÊS ".$mes."</h5>
                       </center>";
    	        echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>Data</th>";
            	echo "<th scope='col'>Descrição</th>";
            	echo "<th scope='col'>Tipo</th>";
            	echo "<th scope='col'>Valor</th>";
            	if ($area =='diretoria'){
            	    echo "<th scope='col'>Valor contábil</th>";
            	}
            	echo "<th scope='col'>Banco</th>";
            	echo "<th scope='col' colspan='1' align='center'>&nbsp</th>";
            	echo "</thead>";
            	echo "<tbody>";
            	
    			$querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE DATA_LANC LIKE '%-".$mes."%' AND BANCO_LANC = '$banco' ORDER BY DATA_LANC ASC";
    		    $resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
    
    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
    	            $idlanc = $fetchlanc_dia_ano[0];
    				$dtlanc = $fetchlanc_dia_ano[1];
    				$desclanc = $fetchlanc_dia_ano[2];
    				$tipolanc = $fetchlanc_dia_ano[3];
    				$valorlanc = $fetchlanc_dia_ano[4];
    				$valorcont = $fetchlanc_dia_ano[8];
    				$bancolanc = $fetchlanc_dia_ano[6];
    				$sum = floatval($sum) + floatval($valorlanc);
    				
    				if ($tipolanc =='Sócio' || $tipolanc =='Bazar' || $tipolanc =='Doações' || $tipolanc =='Rifas' || $tipolanc =='NFP' || $tipolanc =='Vendas' || $tipolanc =='Taxas' || $tipolanc =='Juros' || $tipolanc =='Outros-receitas'){
        				$sumrec = floatval($sumrec) + floatval($valorlanc);
        				$categoria = 'Receita';
        					
        			}  
        			
        			if ($tipolanc =='LT' || $tipolanc =='Veterinário'|| $tipolanc =='Taxi dog' || $tipolanc =='Medicamentos' || $tipolanc =='Compras' || $tipolanc =='Impostos' || $tipolanc =='Outros-despesas'){
        				$sumdesp = floatval($sumdesp) + floatval($valorlanc);
        				$categoria = 'Despesa';
        					
        			}   
    				
            			echo "<tr>";
            			echo "<td>".$dtlanc."</td>";
    					echo "<td>".$desclanc."</td>";
    					echo "<td>".$tipolanc."</td>";
    					echo "<td>R$ ".number_format($valorlanc,2,',', '.')."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td>R$ ".number_format($valorcont,2,',', '.')."</td>";
                    	}
    					echo "<td>".$bancolanc."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                    	}
    					echo "<td>&nbsp;</td>";
    				    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
    		
    		    
    		  echo"<center><h5>TOTAL MENSAL - ".$banco."</h5></center>
    	                <div class='form-group row'>
                              <label class='col-sm-2 col-form-label'><strong>Receitas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sumrec,2,',', '.')."</label> 
                              </div>
                              <label class='col-sm-2 col-form-label'><strong>Despesas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sumdesp,2,',', '.')."</label> 
                              </div>
                        </div>";
    	    }
    	    
    	    if ($ano != 'branco' && $mes != 'branco' && $banco !=''){
    	        echo "<center>
                           <br>
                            <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS DIÁRIOS</h3><br>
                            <h5>MÊS ".$mes."</h5>
                       </center>";
    	        echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>Data</th>";
            	echo "<th scope='col'>Descrição</th>";
            	echo "<th scope='col'>Tipo</th>";
            	echo "<th scope='col'>Valor</th>";
            	if ($area =='diretoria'){
            	    echo "<th scope='col'>Valor contábil</th>";
            	}
            	echo "<th scope='col'>Banco</th>";
            	echo "<th scope='col' colspan='1' align='center'>&nbsp</th>";
            	echo "</thead>";
            	echo "<tbody>";
            	
    			$querylanc_dia_ano = "SELECT * FROM FINANCEIRO WHERE DATA_LANC LIKE '".$ano."-".$mes."%' AND BANCO_LANC = '$banco' ORDER BY DATA_LANC ASC";
    		    $resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
    
    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
    	            $idlanc = $fetchlanc_dia_ano[0];
    				$dtlanc = $fetchlanc_dia_ano[1];
    				$desclanc = $fetchlanc_dia_ano[2];
    				$tipolanc = $fetchlanc_dia_ano[3];
    				$valorlanc = $fetchlanc_dia_ano[4];
    				$valorcont = $fetchlanc_dia_ano[8];
    				$bancolanc = $fetchlanc_dia_ano[6];
    				$sum = floatval($sum) + floatval($valorlanc);
    				
    				if ($tipolanc =='Sócio' || $tipolanc =='Bazar' || $tipolanc =='Doações' || $tipolanc =='Rifas' || $tipolanc =='NFP' || $tipolanc =='Vendas' || $tipolanc =='Taxas' || $tipolanc =='Juros' || $tipolanc =='Outros-receitas'){
        				$sumrec = floatval($sumrec) + floatval($valorlanc);
        				$categoria = 'Receita';
        					
        			}  
        			
        			if ($tipolanc =='LT' || $tipolanc =='Veterinário'|| $tipolanc =='Taxi dog' || $tipolanc =='Medicamentos' || $tipolanc =='Compras' || $tipolanc =='Impostos' || $tipolanc =='Outros-despesas'){
        				$sumdesp = floatval($sumdesp) + floatval($valorlanc);
        				$categoria = 'Despesa';
        					
        			}   
    				
            			echo "<tr>";
            			echo "<td>".$dtlanc."</td>";
    					echo "<td>".$desclanc."</td>";
    					echo "<td>".$tipolanc."</td>";
    					echo "<td>R$ ".number_format($valorlanc,2,',', '.')."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td>R$ ".number_format($valorcont,2,',', '.')."</td>";
                    	}
    					echo "<td>".$bancolanc."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                    	}
    					echo "<td>&nbsp;</td>";
    				    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
    		
    		    
    		  echo"<center><h5>TOTAL MENSAL - ".$banco."</h5></center>
    	                <div class='form-group row'>
                              <label class='col-sm-2 col-form-label'><strong>Receitas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sumrec,2,',', '.')."</label> 
                              </div>
                              <label class='col-sm-2 col-form-label'><strong>Despesas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sumdesp,2,',', '.')."</label> 
                              </div>
                        </div>";
    	    }
    	    
    	    if ($ano == 'branco' && $mes == 'branco' && $banco ==''){
    	        echo "<center>
                           <br>
                            <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS DIÁRIOS</h3><br>
                       </center>";
    	        echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>Data</th>";
            	echo "<th scope='col'>Descrição</th>";
            	echo "<th scope='col'>Tipo</th>";
            	echo "<th scope='col'>Valor</th>";
            	if ($area =='diretoria'){
            	    echo "<th scope='col'>Valor contábil</th>";
            	}
            	echo "<th scope='col'>Banco</th>";
            	echo "<th scope='col' colspan='1' align='center'>&nbsp</th>";
            	echo "</thead>";
            	echo "<tbody>";
            	
    			$querylanc_dia_ano = "SELECT * FROM FINANCEIRO ORDER BY DATA_LANC ASC ";
    		    $resultlanc_dia_ano = mysqli_query($connect,$querylanc_dia_ano);
    
    	        while ($fetchlanc_dia_ano = mysqli_fetch_row($resultlanc_dia_ano)) {
    	            $idlanc = $fetchlanc_dia_ano[0];
    				$dtlanc = $fetchlanc_dia_ano[1];
    				$desclanc = $fetchlanc_dia_ano[2];
    				$tipolanc = $fetchlanc_dia_ano[3];
    				$valorlanc = $fetchlanc_dia_ano[4];
    				$valorcont = $fetchlanc_dia_ano[8];
    				$bancolanc = $fetchlanc_dia_ano[6];
    				$sum = floatval($sum) + floatval($valorlanc);
    				
    				if ($tipolanc =='Sócio' || $tipolanc =='Bazar' || $tipolanc =='Doações' || $tipolanc =='Rifas' || $tipolanc =='NFP' || $tipolanc =='Vendas' || $tipolanc =='Taxas' || $tipolanc =='Juros' || $tipolanc =='Outros-receitas'){
        				$sumrec = floatval($sumrec) + floatval($valorlanc);
        				$categoria = 'Receita';
        					
        			}  
        			
        			if ($tipolanc =='LT' || $tipolanc =='Veterinário'|| $tipolanc =='Taxi dog' || $tipolanc =='Medicamentos' || $tipolanc =='Compras' || $tipolanc =='Impostos' || $tipolanc =='Outros-despesas'){
        				$sumdesp = floatval($sumdesp) + floatval($valorlanc);
        				$categoria = 'Despesa';
        					
        			}   
        			
            			echo "<tr>";
            			echo "<td>".$dtlanc."</td>";
    					echo "<td>".$desclanc."</td>";
    					echo "<td>".$tipolanc."</td>";
    					echo "<td>R$ ".number_format($valorlanc,2,',', '.')."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td>R$ ".number_format($valorcont,2,',', '.')."</td>";
                    	}
    					echo "<td>".$bancolanc."</td>";
    					if ($area =='diretoria'){
                    	    echo "<td><a href='deletalanc.php?idlanc=".$idlanc."' class='btn btn-primary'>Deletar</a></td>";
                    	}
    					echo "<td>&nbsp;</td>";
    				    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
    		
    		    
    		  echo"<center><h5>TOTAL</h5></center>
    	                <div class='form-group row'>
                              <label class='col-sm-2 col-form-label'><strong>Receitas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sumrec,2,',', '.')."</label> 
                              </div>
                              <label class='col-sm-2 col-form-label'><strong>Despesas: </strong></label> 
                              <div class='col-sm-10'>
                                <label class='col-sm-10 col-form-label'>R$ ".number_format($sumdesp,2,',', '.')."</label> 
                              </div>
                        </div>";
    	    }
    	    
    	    break;
    	    
	    case 'Lançamentos mensais':
	    
			  if ($ano != 'branco' && $mes == 'branco' && $banco ==''){
			      
			      	$somasocio_jan = lancamentos_mensal_anual_socios($ano,'01',$connect);
			      	$somasocio_fev = lancamentos_mensal_anual_socios($ano,'02',$connect);
			      	$somasocio_mar = lancamentos_mensal_anual_socios($ano,'03',$connect);
			      	$somasocio_abr = lancamentos_mensal_anual_socios($ano,'04',$connect);
			      	$somasocio_mai = lancamentos_mensal_anual_socios($ano,'05',$connect);
			      	$somasocio_jun = lancamentos_mensal_anual_socios($ano,'06',$connect);
			      	$somasocio_jul = lancamentos_mensal_anual_socios($ano,'07',$connect);
			      	$somasocio_ago = lancamentos_mensal_anual_socios($ano,'08',$connect);
			      	$somasocio_set = lancamentos_mensal_anual_socios($ano,'09',$connect);
			      	$somasocio_out = lancamentos_mensal_anual_socios($ano,'10',$connect);
			      	$somasocio_nov = lancamentos_mensal_anual_socios($ano,'11',$connect);
			      	$somasocio_dez = lancamentos_mensal_anual_socios($ano,'12',$connect);
			      	
			      	$somabazar_jan = lancamentos_mensal_anual_bazar($ano,'01',$connect);
			      	$somabazar_fev = lancamentos_mensal_anual_bazar($ano,'02',$connect);
			      	$somabazar_mar = lancamentos_mensal_anual_bazar($ano,'03',$connect);
			      	$somabazar_abr = lancamentos_mensal_anual_bazar($ano,'04',$connect);
			      	$somabazar_mai = lancamentos_mensal_anual_bazar($ano,'05',$connect);
			      	$somabazar_jun = lancamentos_mensal_anual_bazar($ano,'06',$connect);
			      	$somabazar_jul = lancamentos_mensal_anual_bazar($ano,'07',$connect);
			      	$somabazar_ago = lancamentos_mensal_anual_bazar($ano,'08',$connect);
			      	$somabazar_set = lancamentos_mensal_anual_bazar($ano,'09',$connect);
			      	$somabazar_out = lancamentos_mensal_anual_bazar($ano,'10',$connect);
			      	$somabazar_nov = lancamentos_mensal_anual_bazar($ano,'11',$connect);
			      	$somabazar_dez = lancamentos_mensal_anual_bazar($ano,'12',$connect);
			      	
			      	$somadoacoes_jan = lancamentos_mensal_anual_doacoes($ano,'01',$connect);
			      	$somadoacoes_fev = lancamentos_mensal_anual_doacoes($ano,'02',$connect);
			      	$somadoacoes_mar = lancamentos_mensal_anual_doacoes($ano,'03',$connect);
			      	$somadoacoes_abr = lancamentos_mensal_anual_doacoes($ano,'04',$connect);
			      	$somadoacoes_mai = lancamentos_mensal_anual_doacoes($ano,'05',$connect);
			      	$somadoacoes_jun = lancamentos_mensal_anual_doacoes($ano,'06',$connect);
			      	$somadoacoes_jul = lancamentos_mensal_anual_doacoes($ano,'07',$connect);
			      	$somadoacoes_ago = lancamentos_mensal_anual_doacoes($ano,'08',$connect);
			      	$somadoacoes_set = lancamentos_mensal_anual_doacoes($ano,'09',$connect);
			      	$somadoacoes_out = lancamentos_mensal_anual_doacoes($ano,'10',$connect);
			      	$somadoacoes_nov = lancamentos_mensal_anual_doacoes($ano,'11',$connect);
			      	$somadoacoes_dez = lancamentos_mensal_anual_doacoes($ano,'12',$connect);
			      	
			      	$somarifas_jan = lancamentos_mensal_anual_rifas($ano,'01',$connect);
			      	$somarifas_fev = lancamentos_mensal_anual_rifas($ano,'02',$connect);
			      	$somarifas_mar = lancamentos_mensal_anual_rifas($ano,'03',$connect);
			      	$somarifas_abr = lancamentos_mensal_anual_rifas($ano,'04',$connect);
			      	$somarifas_mai = lancamentos_mensal_anual_rifas($ano,'05',$connect);
			      	$somarifas_jun = lancamentos_mensal_anual_rifas($ano,'06',$connect);
			      	$somarifas_jul = lancamentos_mensal_anual_rifas($ano,'07',$connect);
			      	$somarifas_ago = lancamentos_mensal_anual_rifas($ano,'08',$connect);
			      	$somarifas_set = lancamentos_mensal_anual_rifas($ano,'09',$connect);
			      	$somarifas_out = lancamentos_mensal_anual_rifas($ano,'10',$connect);
			      	$somarifas_nov = lancamentos_mensal_anual_rifas($ano,'11',$connect);
			      	$somarifas_dez = lancamentos_mensal_anual_rifas($ano,'12',$connect);
			      	
			      	$somanfp_jan = lancamentos_mensal_anual_nfp($ano,'01',$area,$connect);
			      	$somanfp_fev = lancamentos_mensal_anual_nfp($ano,'02',$area,$connect);
			      	$somanfp_mar = lancamentos_mensal_anual_nfp($ano,'03',$area,$connect);
			      	$somanfp_abr = lancamentos_mensal_anual_nfp($ano,'04',$area,$connect);
			      	$somanfp_mai = lancamentos_mensal_anual_nfp($ano,'05',$area,$connect);
			      	$somanfp_jun = lancamentos_mensal_anual_nfp($ano,'06',$area,$connect);
			      	$somanfp_jul = lancamentos_mensal_anual_nfp($ano,'07',$area,$connect);
			      	$somanfp_ago = lancamentos_mensal_anual_nfp($ano,'08',$area,$connect);
			      	$somanfp_set = lancamentos_mensal_anual_nfp($ano,'09',$area,$connect);
			      	$somanfp_out = lancamentos_mensal_anual_nfp($ano,'10',$area,$connect);
			      	$somanfp_nov = lancamentos_mensal_anual_nfp($ano,'11',$area,$connect);
			      	$somanfp_dez = lancamentos_mensal_anual_nfp($ano,'12',$area,$connect);
			      	
			      	$somavendas_jan = lancamentos_mensal_anual_vendas($ano,'01',$connect);
			      	$somavendas_fev = lancamentos_mensal_anual_vendas($ano,'02',$connect);
			      	$somavendas_mar = lancamentos_mensal_anual_vendas($ano,'03',$connect);
			      	$somavendas_abr = lancamentos_mensal_anual_vendas($ano,'04',$connect);
			      	$somavendas_mai = lancamentos_mensal_anual_vendas($ano,'05',$connect);
			      	$somavendas_jun = lancamentos_mensal_anual_vendas($ano,'06',$connect);
			      	$somavendas_jul = lancamentos_mensal_anual_vendas($ano,'07',$connect);
			      	$somavendas_ago = lancamentos_mensal_anual_vendas($ano,'08',$connect);
			      	$somavendas_set = lancamentos_mensal_anual_vendas($ano,'09',$connect);
			      	$somavendas_out = lancamentos_mensal_anual_vendas($ano,'10',$connect);
			      	$somavendas_nov = lancamentos_mensal_anual_vendas($ano,'11',$connect);
			      	$somavendas_dez = lancamentos_mensal_anual_vendas($ano,'12',$connect);
			      	
			      	$somataxasadocao_jan = lancamentos_mensal_anual_taxasadocao($ano,'01',$connect);
			      	$somataxasadocao_fev = lancamentos_mensal_anual_taxasadocao($ano,'02',$connect);
			      	$somataxasadocao_mar = lancamentos_mensal_anual_taxasadocao($ano,'03',$connect);
			      	$somataxasadocao_abr = lancamentos_mensal_anual_taxasadocao($ano,'04',$connect);
			      	$somataxasadocao_mai = lancamentos_mensal_anual_taxasadocao($ano,'05',$connect);
			      	$somataxasadocao_jun = lancamentos_mensal_anual_taxasadocao($ano,'06',$connect);
			      	$somataxasadocao_jul = lancamentos_mensal_anual_taxasadocao($ano,'07',$connect);
			      	$somataxasadocao_ago = lancamentos_mensal_anual_taxasadocao($ano,'08',$connect);
			      	$somataxasadocao_set = lancamentos_mensal_anual_taxasadocao($ano,'09',$connect);
			      	$somataxasadocao_out = lancamentos_mensal_anual_taxasadocao($ano,'10',$connect);
			      	$somataxasadocao_nov = lancamentos_mensal_anual_taxasadocao($ano,'11',$connect);
			      	$somataxasadocao_dez = lancamentos_mensal_anual_taxasadocao($ano,'12',$connect);
			      	
			      	$somajuros_jan = lancamentos_mensal_anual_juros($ano,'01',$connect);
			      	$somajuros_fev = lancamentos_mensal_anual_juros($ano,'02',$connect);
			      	$somajuros_mar = lancamentos_mensal_anual_juros($ano,'03',$connect);
			      	$somajuros_abr = lancamentos_mensal_anual_juros($ano,'04',$connect);
			      	$somajuros_mai = lancamentos_mensal_anual_juros($ano,'05',$connect);
			      	$somajuros_jun = lancamentos_mensal_anual_juros($ano,'06',$connect);
			      	$somajuros_jul = lancamentos_mensal_anual_juros($ano,'07',$connect);
			      	$somajuros_ago = lancamentos_mensal_anual_juros($ano,'08',$connect);
			      	$somajuros_set = lancamentos_mensal_anual_juros($ano,'09',$connect);
			      	$somajuros_out = lancamentos_mensal_anual_juros($ano,'10',$connect);
			      	$somajuros_nov = lancamentos_mensal_anual_juros($ano,'11',$connect);
			      	$somajuros_dez = lancamentos_mensal_anual_juros($ano,'12',$connect);
			      	
			      	$somaoutrosrec_jan = lancamentos_mensal_anual_outrosrec($ano,'01',$connect);
			      	$somaoutrosrec_fev = lancamentos_mensal_anual_outrosrec($ano,'02',$connect);
			      	$somaoutrosrec_mar = lancamentos_mensal_anual_outrosrec($ano,'03',$connect);
			      	$somaoutrosrec_abr = lancamentos_mensal_anual_outrosrec($ano,'04',$connect);
			      	$somaoutrosrec_mai = lancamentos_mensal_anual_outrosrec($ano,'05',$connect);
			      	$somaoutrosrec_jun = lancamentos_mensal_anual_outrosrec($ano,'06',$connect);
			      	$somaoutrosrec_jul = lancamentos_mensal_anual_outrosrec($ano,'07',$connect);
			      	$somaoutrosrec_ago = lancamentos_mensal_anual_outrosrec($ano,'08',$connect);
			      	$somaoutrosrec_set = lancamentos_mensal_anual_outrosrec($ano,'09',$connect);
			      	$somaoutrosrec_out = lancamentos_mensal_anual_outrosrec($ano,'10',$connect);
			      	$somaoutrosrec_nov = lancamentos_mensal_anual_outrosrec($ano,'11',$connect);
			      	$somaoutrosrec_dez = lancamentos_mensal_anual_outrosrec($ano,'12',$connect);
			      	
			      	$totalsocio = floatval($somasocio_jan) + 
			      	              floatval($somasocio_fev) + 
			      	              floatval($somasocio_mar) + 
			      	              floatval($somasocio_abr) + 
			      	              floatval($somasocio_mai) + 
			      	              floatval($somasocio_jun) + 
			      	              floatval($somasocio_jul) + 
			      	              floatval($somasocio_ago) + 
			      	              floatval($somasocio_set) + 
			      	              floatval($somasocio_out) + 
			      	              floatval($somasocio_nov) + 
			      	              floatval($somasocio_dez); 
			      	              
			      	 $totalbazar = floatval($somabazar_jan) + 
			      	              floatval($somabazar_fev) + 
			      	              floatval($somabazar_mar) + 
			      	              floatval($somabazar_abr) + 
			      	              floatval($somabazar_mai) + 
			      	              floatval($somabazar_jun) + 
			      	              floatval($somabazar_jul) + 
			      	              floatval($somabazar_ago) + 
			      	              floatval($somabazar_set) + 
			      	              floatval($somabazar_out) + 
			      	              floatval($somabazar_nov) + 
			      	              floatval($somabazar_dez); 
			      	              
			      	 $totaldoacoes = floatval($somadoacoes_jan) + 
			      	              floatval($somadoacoes_fev) + 
			      	              floatval($somadoacoes_mar) + 
			      	              floatval($somadoacoes_abr) + 
			      	              floatval($somadoacoes_mai) + 
			      	              floatval($somadoacoes_jun) + 
			      	              floatval($somadoacoes_jul) + 
			      	              floatval($somadoacoes_ago) + 
			      	              floatval($somadoacoes_set) + 
			      	              floatval($somadoacoes_out) + 
			      	              floatval($somadoacoes_nov) + 
			      	              floatval($somadoacoes_dez); 
			      	              
			      	  $totalrifas = floatval($somarifas_jan) + 
			      	              floatval($somarifas_fev) + 
			      	              floatval($somarifas_mar) + 
			      	              floatval($somarifas_abr) + 
			      	              floatval($somarifas_mai) + 
			      	              floatval($somarifas_jun) + 
			      	              floatval($somarifas_jul) + 
			      	              floatval($somarifas_ago) + 
			      	              floatval($somarifas_set) + 
			      	              floatval($somarifas_out) + 
			      	              floatval($somarifas_nov) + 
			      	              floatval($somarifas_dez); 
			      	              
			      	  $totalnfp = floatval($somanfp_jan) + 
			      	              floatval($somanfp_fev) + 
			      	              floatval($somanfp_mar) + 
			      	              floatval($somanfp_abr) + 
			      	              floatval($somanfp_mai) + 
			      	              floatval($somanfp_jun) + 
			      	              floatval($somanfp_jul) + 
			      	              floatval($somanfp_ago) + 
			      	              floatval($somanfp_set) + 
			      	              floatval($somanfp_out) + 
			      	              floatval($somanfp_nov) + 
			      	              floatval($somanfp_dez); 
			      	              
		              $totalvendas = floatval($somavendas_jan) + 
			      	              floatval($somavendas_fev) + 
			      	              floatval($somavendas_mar) + 
			      	              floatval($somavendas_abr) + 
			      	              floatval($somavendas_mai) + 
			      	              floatval($somavendas_jun) + 
			      	              floatval($somavendas_jul) + 
			      	              floatval($somavendas_ago) + 
			      	              floatval($somavendas_set) + 
			      	              floatval($somavendas_out) + 
			      	              floatval($somavendas_nov) + 
			      	              floatval($somavendas_dez);  
			      	              
			      	  $totaltaxasadocao = floatval($somataxasadocao_jan) + 
			      	              floatval($somataxasadocao_fev) + 
			      	              floatval($somataxasadocao_mar) + 
			      	              floatval($somataxasadocao_abr) + 
			      	              floatval($somataxasadocao_mai) + 
			      	              floatval($somataxasadocao_jun) + 
			      	              floatval($somataxasadocao_jul) + 
			      	              floatval($somataxasadocao_ago) + 
			      	              floatval($somataxasadocao_set) + 
			      	              floatval($somataxasadocao_out) + 
			      	              floatval($somataxasadocao_nov) + 
			      	              floatval($somataxasadocao_dez); 
			      	              
			      	  $totaljuros = floatval($somajuros_jan) + 
			      	              floatval($somajuros_fev) + 
			      	              floatval($somajuros_mar) + 
			      	              floatval($somajuros_abr) + 
			      	              floatval($somajuros_mai) + 
			      	              floatval($somajuros_jun) + 
			      	              floatval($somajuros_jul) + 
			      	              floatval($somajuros_ago) + 
			      	              floatval($somajuros_set) + 
			      	              floatval($somajuros_out) + 
			      	              floatval($somajuros_nov) + 
			      	              floatval($somajuros_dez); 
			      	              
			      	  $totaloutrosrec = floatval($somaoutrosrec_jan) + 
			      	              floatval($somaoutrosrec_fev) + 
			      	              floatval($somaoutrosrec_mar) + 
			      	              floatval($somaoutrosrec_abr) + 
			      	              floatval($somaoutrosrec_mai) + 
			      	              floatval($somaoutrosrec_jun) + 
			      	              floatval($somaoutrosrec_jul) + 
			      	              floatval($somaoutrosrec_ago) + 
			      	              floatval($somaoutrosrec_set) + 
			      	              floatval($somaoutrosrec_out) + 
			      	              floatval($somaoutrosrec_nov) + 
			      	              floatval($somaoutrosrec_dez); 
			      	
			      	/** DESPESAS **/
			      	
			      	$somalt_jan = lancamentos_mensal_anual_lt($ano,'01',$connect);
			      	$somalt_fev = lancamentos_mensal_anual_lt($ano,'02',$connect);
			      	$somalt_mar = lancamentos_mensal_anual_lt($ano,'03',$connect);
			      	$somalt_abr = lancamentos_mensal_anual_lt($ano,'04',$connect);
			      	$somalt_mai = lancamentos_mensal_anual_lt($ano,'05',$connect);
			      	$somalt_jun = lancamentos_mensal_anual_lt($ano,'06',$connect);
			      	$somalt_jul = lancamentos_mensal_anual_lt($ano,'07',$connect);
			      	$somalt_ago = lancamentos_mensal_anual_lt($ano,'08',$connect);
			      	$somalt_set = lancamentos_mensal_anual_lt($ano,'09',$connect);
			      	$somalt_out = lancamentos_mensal_anual_lt($ano,'10',$connect);
			      	$somalt_nov = lancamentos_mensal_anual_lt($ano,'11',$connect);
			      	$somalt_dez = lancamentos_mensal_anual_lt($ano,'12',$connect);
			      	
			      	$somavet_jan = lancamentos_mensal_anual_vet($ano,'01',$connect);
			      	$somavet_fev = lancamentos_mensal_anual_vet($ano,'02',$connect);
			      	$somavet_mar = lancamentos_mensal_anual_vet($ano,'03',$connect);
			      	$somavet_abr = lancamentos_mensal_anual_vet($ano,'04',$connect);
			      	$somavet_mai = lancamentos_mensal_anual_vet($ano,'05',$connect);
			      	$somavet_jun = lancamentos_mensal_anual_vet($ano,'06',$connect);
			      	$somavet_jul = lancamentos_mensal_anual_vet($ano,'07',$connect);
			      	$somavet_ago = lancamentos_mensal_anual_vet($ano,'08',$connect);
			      	$somavet_set = lancamentos_mensal_anual_vet($ano,'09',$connect);
			      	$somavet_out = lancamentos_mensal_anual_vet($ano,'10',$connect);
			      	$somavet_nov = lancamentos_mensal_anual_vet($ano,'11',$connect);
			      	$somavet_dez = lancamentos_mensal_anual_vet($ano,'12',$connect);
			      	
			      	$somataxidog_jan = lancamentos_mensal_anual_taxidog($ano,'01',$connect);
			      	$somataxidog_fev = lancamentos_mensal_anual_taxidog($ano,'02',$connect);
			      	$somataxidog_mar = lancamentos_mensal_anual_taxidog($ano,'03',$connect);
			      	$somataxidog_abr = lancamentos_mensal_anual_taxidog($ano,'04',$connect);
			      	$somataxidog_mai = lancamentos_mensal_anual_taxidog($ano,'05',$connect);
			      	$somataxidog_jun = lancamentos_mensal_anual_taxidog($ano,'06',$connect);
			      	$somataxidog_jul = lancamentos_mensal_anual_taxidog($ano,'07',$connect);
			      	$somataxidog_ago = lancamentos_mensal_anual_taxidog($ano,'08',$connect);
			      	$somataxidog_set = lancamentos_mensal_anual_taxidog($ano,'09',$connect);
			      	$somataxidog_out = lancamentos_mensal_anual_taxidog($ano,'10',$connect);
			      	$somataxidog_nov = lancamentos_mensal_anual_taxidog($ano,'11',$connect);
			      	$somataxidog_dez = lancamentos_mensal_anual_taxidog($ano,'12',$connect);
			      	
			      	$somamedicam_jan = lancamentos_mensal_anual_medicam($ano,'01',$connect);
			      	$somamedicam_fev = lancamentos_mensal_anual_medicam($ano,'02',$connect);
			      	$somamedicam_mar = lancamentos_mensal_anual_medicam($ano,'03',$connect);
			      	$somamedicam_abr = lancamentos_mensal_anual_medicam($ano,'04',$connect);
			      	$somamedicam_mai = lancamentos_mensal_anual_medicam($ano,'05',$connect);
			      	$somamedicam_jun = lancamentos_mensal_anual_medicam($ano,'06',$connect);
			      	$somamedicam_jul = lancamentos_mensal_anual_medicam($ano,'07',$connect);
			      	$somamedicam_ago = lancamentos_mensal_anual_medicam($ano,'08',$connect);
			      	$somamedicam_set = lancamentos_mensal_anual_medicam($ano,'09',$connect);
			      	$somamedicam_out = lancamentos_mensal_anual_medicam($ano,'10',$connect);
			      	$somamedicam_nov = lancamentos_mensal_anual_medicam($ano,'11',$connect);
			      	$somamedicam_dez = lancamentos_mensal_anual_medicam($ano,'12',$connect);
			      	
			      	$somacompras_jan = lancamentos_mensal_anual_compras($ano,'01',$connect);
			      	$somacompras_fev = lancamentos_mensal_anual_compras($ano,'02',$connect);
			      	$somacompras_mar = lancamentos_mensal_anual_compras($ano,'03',$connect);
			      	$somacompras_abr = lancamentos_mensal_anual_compras($ano,'04',$connect);
			      	$somacompras_mai = lancamentos_mensal_anual_compras($ano,'05',$connect);
			      	$somacompras_jun = lancamentos_mensal_anual_compras($ano,'06',$connect);
			      	$somacompras_jul = lancamentos_mensal_anual_compras($ano,'07',$connect);
			      	$somacompras_ago = lancamentos_mensal_anual_compras($ano,'08',$connect);
			      	$somacompras_set = lancamentos_mensal_anual_compras($ano,'09',$connect);
			      	$somacompras_out = lancamentos_mensal_anual_compras($ano,'10',$connect);
			      	$somacompras_nov = lancamentos_mensal_anual_compras($ano,'11',$connect);
			      	$somacompras_dez = lancamentos_mensal_anual_compras($ano,'12',$connect);
			      	
			      	$somaimposto_jan = lancamentos_mensal_anual_imposto($ano,'01',$connect);
			      	$somaimposto_fev = lancamentos_mensal_anual_imposto($ano,'02',$connect);
			      	$somaimposto_mar = lancamentos_mensal_anual_imposto($ano,'03',$connect);
			      	$somaimposto_abr = lancamentos_mensal_anual_imposto($ano,'04',$connect);
			      	$somaimposto_mai = lancamentos_mensal_anual_imposto($ano,'05',$connect);
			      	$somaimposto_jun = lancamentos_mensal_anual_imposto($ano,'06',$connect);
			      	$somaimposto_jul = lancamentos_mensal_anual_imposto($ano,'07',$connect);
			      	$somaimposto_ago = lancamentos_mensal_anual_imposto($ano,'08',$connect);
			      	$somaimposto_set = lancamentos_mensal_anual_imposto($ano,'09',$connect);
			      	$somaimposto_out = lancamentos_mensal_anual_imposto($ano,'10',$connect);
			      	$somaimposto_nov = lancamentos_mensal_anual_imposto($ano,'11',$connect);
			      	$somaimposto_dez = lancamentos_mensal_anual_imposto($ano,'12',$connect);
			      	
			      	$somaoutrosdes_jan = lancamentos_mensal_anual_outrosdes($ano,'01',$connect);
			      	$somaoutrosdes_fev = lancamentos_mensal_anual_outrosdes($ano,'02',$connect);
			      	$somaoutrosdes_mar = lancamentos_mensal_anual_outrosdes($ano,'03',$connect);
			      	$somaoutrosdes_abr = lancamentos_mensal_anual_outrosdes($ano,'04',$connect);
			      	$somaoutrosdes_mai = lancamentos_mensal_anual_outrosdes($ano,'05',$connect);
			      	$somaoutrosdes_jun = lancamentos_mensal_anual_outrosdes($ano,'06',$connect);
			      	$somaoutrosdes_jul = lancamentos_mensal_anual_outrosdes($ano,'07',$connect);
			      	$somaoutrosdes_ago = lancamentos_mensal_anual_outrosdes($ano,'08',$connect);
			      	$somaoutrosdes_set = lancamentos_mensal_anual_outrosdes($ano,'09',$connect);
			      	$somaoutrosdes_out = lancamentos_mensal_anual_outrosdes($ano,'10',$connect);
			      	$somaoutrosdes_nov = lancamentos_mensal_anual_outrosdes($ano,'11',$connect);
			      	$somaoutrosdes_dez = lancamentos_mensal_anual_outrosdes($ano,'12',$connect);
			      	
			      	$totallt = floatval($somalt_jan) + 
			      	              floatval($somalt_fev) + 
			      	              floatval($somalt_mar) + 
			      	              floatval($somalt_abr) + 
			      	              floatval($somalt_mai) + 
			      	              floatval($somalt_jun) + 
			      	              floatval($somalt_jul) + 
			      	              floatval($somalt_ago) + 
			      	              floatval($somalt_set) + 
			      	              floatval($somalt_out) + 
			      	              floatval($somalt_nov) + 
			      	              floatval($somalt_dez);
			      	 
			      	$totalracao = floatval($somaracao_jan) + 
			      	              floatval($somaracao_fev) + 
			      	              floatval($somaracao_mar) + 
			      	              floatval($somaracao_abr) + 
			      	              floatval($somaracao_mai) + 
			      	              floatval($somaracao_jun) + 
			      	              floatval($somaracao_jul) + 
			      	              floatval($somaracao_ago) + 
			      	              floatval($somaracao_set) + 
			      	              floatval($somaracao_out) + 
			      	              floatval($somaracao_nov) + 
			      	              floatval($somaracao_dez);
			      	
			      	$totalvet = floatval($somavet_jan) + 
			      	              floatval($somavet_fev) + 
			      	              floatval($somavet_mar) + 
			      	              floatval($somavet_abr) + 
			      	              floatval($somavet_mai) + 
			      	              floatval($somavet_jun) + 
			      	              floatval($somavet_jul) + 
			      	              floatval($somavet_ago) + 
			      	              floatval($somavet_set) + 
			      	              floatval($somavet_out) + 
			      	              floatval($somavet_nov) + 
			      	              floatval($somavet_dez);
			      	              
			      	$totaltaxidog = floatval($somataxidog_jan) + 
			      	              floatval($somataxidog_fev) + 
			      	              floatval($somataxidog_mar) + 
			      	              floatval($somataxidog_abr) + 
			      	              floatval($somataxidog_mai) + 
			      	              floatval($somataxidog_jun) + 
			      	              floatval($somataxidog_jul) + 
			      	              floatval($somataxidog_ago) + 
			      	              floatval($somataxidog_set) + 
			      	              floatval($somataxidog_out) + 
			      	              floatval($somataxidog_nov) + 
			      	              floatval($somataxidog_dez);
			      	
			      	$totalmedicam = floatval($somamedicam_jan) + 
			      	              floatval($somamedicam_fev) + 
			      	              floatval($somamedicam_mar) + 
			      	              floatval($somamedicam_abr) + 
			      	              floatval($somamedicam_mai) + 
			      	              floatval($somamedicam_jun) + 
			      	              floatval($somamedicam_jul) + 
			      	              floatval($somamedicam_ago) + 
			      	              floatval($somamedicam_set) + 
			      	              floatval($somamedicam_out) + 
			      	              floatval($somamedicam_nov) + 
			      	              floatval($somamedicam_dez);
			      	
			      	$totalcompras = floatval($somacompras_jan) + 
			      	              floatval($somacompras_fev) + 
			      	              floatval($somacompras_mar) + 
			      	              floatval($somacompras_abr) + 
			      	              floatval($somacompras_mai) + 
			      	              floatval($somacompras_jun) + 
			      	              floatval($somacompras_jul) + 
			      	              floatval($somacompras_ago) + 
			      	              floatval($somacompras_set) + 
			      	              floatval($somacompras_out) + 
			      	              floatval($somacompras_nov) + 
			      	              floatval($somacompras_dez);
					
					$totalimposto = floatval($somaimposto_jan) + 
			      	              floatval($somaimposto_fev) + 
			      	              floatval($somaimposto_mar) + 
			      	              floatval($somaimposto_abr) + 
			      	              floatval($somaimposto_mai) + 
			      	              floatval($somaimposto_jun) + 
			      	              floatval($somaimposto_jul) + 
			      	              floatval($somaimposto_ago) + 
			      	              floatval($somaimposto_set) + 
			      	              floatval($somaimposto_out) + 
			      	              floatval($somaimposto_nov) + 
			      	              floatval($somaimposto_dez);
			      	 
			        $totaloutrosdes = floatval($somaoutrosdes_jan) + 
			      	              floatval($somaoutrosdes_fev) + 
			      	              floatval($somaoutrosdes_mar) + 
			      	              floatval($somaoutrosdes_abr) + 
			      	              floatval($somaoutrosdes_mai) + 
			      	              floatval($somaoutrosdes_jun) + 
			      	              floatval($somaoutrosdes_jul) + 
			      	              floatval($somaoutrosdes_ago) + 
			      	              floatval($somaoutrosdes_set) + 
			      	              floatval($somaoutrosdes_out) + 
			      	              floatval($somaoutrosdes_nov) + 
			      	              floatval($somaoutrosdes_dez);
					
					echo "<center>
                               <br>
                                <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS</h3><br>
                                <h5>ANO ".$ano." - RECEITAS</h5>
                           </center>
                            <table class='table'>
                            <thead class='thead-light'>
                        	<th scope='col'>Mês</th>
                        	<th scope='col'>Sócio</th>
                        	<th scope='col'>Doações</th>
                        	<th scope='col'>Bazar</th>
                        	<th scope='col'>NFP</th>
                        	<th scope='col'>Rifas</th>
                        	<th scope='col'>Vendas</th>
                        	<th scope='col'>Taxas de adoção</th>
                        	<th scope='col'>Juros</th>
                        	<th scope='col'>Outros</th>
                        	</thead>
                        	<tbody>
                        	<tr>
        					<th scope='row'>Janeiro</th>
        					<td>R$ ".number_format($somasocio_jan,2,',', '.')."</td>
        							<td>R$ ".number_format($somabazar_jan,2,',', '.')."</td>
        							<td>R$ ".number_format($somadoacoes_jan,2,',', '.')."</td>
        							<td>R$ ".number_format($somanfp_jan,2,',', '.')."</td>
        							<td>R$ ".number_format($somarifas_jan,2,',', '.')."</td>
        							<td>R$ ".number_format($somavendas_jan,2,',', '.')."</td>
        							<td>R$ ".number_format($somataxasadocao_jan,2,',', '.')."</td>
        							<td>R$ ".number_format($somajuros_jan,2,',', '.')."</td>
        							<td>R$ ".number_format($somaoutrosrec_jan,2,',', '.')."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Fevereiro</th>
        							<td>R$ ".number_format($somasocio_fev,2,',', '.')."</td>
        							<td>R$ ".number_format($somadoacoes_fev,2,',', '.')."</td>
        							<td>R$ ".number_format($somabazar_fev,2,',', '.')."</td>
        							<td>R$ ".number_format($somanfp_fev,2,',', '.')."</td>
        							<td>R$ ".number_format($somarifas_fev,2,',', '.')."</td>
        							<td>R$ ".number_format($somavendas_fev,2,',', '.')."</td>
        							<td>R$ ".number_format($somataxasadocao_fev,2,',', '.')."</td>
        							<td>R$ ".number_format($somajuros_fev,2,',', '.')."</td>
        							<td>R$ ".number_format($somaoutrosrec_fev,2,',', '.')."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Março</th>
        							<td>R$ ".number_format($somasocio_mar,2,',', '.')."</td>
        							<td>R$ ".number_format($somadoacoes_mar,2,',', '.')."</td>
        							<td>R$ ".number_format($somabazar_mar,2,',', '.')."</td>
        							<td>R$ ".number_format($somanfp_mar,2,',', '.')."</td>
        							<td>R$ ".number_format($somarifas_mar,2,',', '.')."</td>
        							<td>R$ ".number_format($somavendas_mar,2,',', '.')."</td>
        							<td>R$ ".number_format($somataxasadocao_mar,2,',', '.')."</td>
        							<td>R$ ".number_format($somajuros_mar,2,',', '.')."</td>
        							<td>R$ ".number_format($somaoutrosrec_mar,2,',', '.')."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Abril</th>
        							<td>R$ ".number_format($somasocio_abr,2,',', '.')."</td>
        							<td>R$ ".number_format($somadoacoes_abr,2,',', '.')."</td>
        							<td>R$ ".number_format($somabazar_abr,2,',', '.')."</td>
        							<td>R$ ".number_format($somanfp_abr,2,',', '.')."</td>
        							<td>R$ ".number_format($somarifas_abr,2,',', '.')."</td>
        							<td>R$ ".number_format($somavendas_abr,2,',', '.')."</td>
        							<td>R$ ".number_format($somataxasadocao_abr,2,',', '.')."</td>
        							<td>R$ ".number_format($somajuros_abr,2,',', '.')."</td>
        							<td>R$ ".number_format($somaoutrosrec_abr,2,',', '.')."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Maio</th>
        							<td>R$ ".number_format($somasocio_mai,2,',', '.')."</td>
        							<td>R$ ".number_format($somadoacoes_mai,2,',', '.')."</td>
        							<td>R$ ".number_format($somabazar_mai,2,',', '.')."</td>
        							<td>R$ ".number_format($somanfp_mai,2,',', '.')."</td>
        							<td>R$ ".number_format($somarifas_mai,2,',', '.')."</td>
        							<td>R$ ".number_format($somavendas_mai,2,',', '.')."</td>
        							<td>R$ ".number_format($somataxasadocao_mai,2,',', '.')."</td>
        							<td>R$ ".number_format($somajuros_mai,2,',', '.')."</td>
        							<td>R$ ".number_format($somaoutrosrec_mai,2,',', '.')."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Junho</th>
        							<td>R$ ".number_format($somasocio_jun,2,',', '.')."</td>
        							<td>R$ ".number_format($somadoacoes_jun,2,',', '.')."</td>
        							<td>R$ ".number_format($somabazar_jun,2,',', '.')."</td>
        							<td>R$ ".number_format($somanfp_jun,2,',', '.')."</td>
        							<td>R$ ".number_format($somarifas_jun,2,',', '.')."</td>
        							<td>R$ ".number_format($somavendas_jun,2,',', '.')."</td>
        							<td>R$ ".number_format($somataxasadocao_jun,2,',', '.')."</td>
        							<td>R$ ".number_format($somajuros_jun,2,',', '.')."</td>
        							<td>R$ ".number_format($somaoutrosrec_jun,2,',', '.')."</td>
        						  </tr>
        						  <tr>
        						 <th scope='row'>Julho</th>
        							<td>R$ ".number_format($somasocio_jul,2,',', '.')."</td>
        							<td>R$ ".number_format($somadoacoes_jul,2,',', '.')."</td>
        							<td>R$ ".number_format($somabazar_jul,2,',', '.')."</td>
        							<td>R$ ".number_format($somanfp_jul,2,',', '.')."</td>
        							<td>R$ ".number_format($somarifas_jul,2,',', '.')."</td>
        							<td>R$ ".number_format($somavendas_jul,2,',', '.')."</td>
        							<td>R$ ".number_format($somataxasadocao_jul,2,',', '.')."</td>
        							<td>R$ ".number_format($somajuros_jul,2,',', '.')."</td>
        							<td>R$ ".number_format($somaoutrosrec_jul,2,',', '.')."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Agosto</th>
        							<td>R$ ".number_format($somasocio_ago,2,',', '.')."</td>
        							<td>R$ ".number_format($somadoacoes_ago,2,',', '.')."</td>
        							<td>R$ ".number_format($somabazar_ago,2,',', '.')."</td>
        							<td>R$ ".number_format($somanfp_ago,2,',', '.')."</td>
        							<td>R$ ".number_format($somarifas_ago,2,',', '.')."</td>
        							<td>R$ ".number_format($somavendas_ago,2,',', '.')."</td>
        							<td>R$ ".number_format($somataxasadocao_ago,2,',', '.')."</td>
        							<td>R$ ".number_format($somajuros_ago,2,',', '.')."</td>
        							<td>R$ ".number_format($somaoutrosrec_ago,2,',', '.')."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Setembro</th>
        							<td>R$ ".number_format($somasocio_set,2,',', '.')."</td>
        							<td>R$ ".number_format($somadoacoes_set,2,',', '.')."</td>
        							<td>R$ ".number_format($somabazar_set,2,',', '.')."</td>
        							<td>R$ ".number_format($somanfp_set,2,',', '.')."</td>
        							<td>R$ ".number_format($somarifas_set,2,',', '.')."</td>
        							<td>R$ ".number_format($somavendas_set,2,',', '.')."</td>
        							<td>R$ ".number_format($somataxasadocao_set,2,',', '.')."</td>
        							<td>R$ ".number_format($somajuros_set,2,',', '.')."</td>
        							<td>R$ ".number_format($somaoutrosrec_set,2,',', '.')."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Outubro</th>
        							<td>R$ ".number_format($somasocio_out,2,',', '.')."</td>
        							<td>R$ ".number_format($somadoacoes_out,2,',', '.')."</td>
        							<td>R$ ".number_format($somabazar_out,2,',', '.')."</td>
        							<td>R$ ".number_format($somanfp_out,2,',', '.')."</td>
        							<td>R$ ".number_format($somarifas_out,2,',', '.')."</td>
        							<td>R$ ".number_format($somavendas_out,2,',', '.')."</td>
        							<td>R$ ".number_format($somataxasadocao_out,2,',', '.')."</td>
        							<td>R$ ".number_format($somajuros_out,2,',', '.')."</td>
        							<td>R$ ".number_format($somaoutrosrec_out,2,',', '.')."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Novembro</th>
        							<td>R$ ".number_format($somasocio_nov,2,',', '.')."</td>
        							<td>R$ ".number_format($somadoacoes_nov,2,',', '.')."</td>
        							<td>R$ ".number_format($somabazar_nov,2,',', '.')."</td>
        							<td>R$ ".number_format($somanfp_nov,2,',', '.')."</td>
        							<td>R$ ".number_format($somarifas_nov,2,',', '.')."</td>
        							<td>R$ ".number_format($somavendas_nov,2,',', '.')."</td>
        							<td>R$ ".number_format($somataxasadocao_nov,2,',', '.')."</td>
        							<td>R$ ".number_format($somajuros_nov,2,',', '.')."</td>
        							<td>R$ ".number_format($somaoutrosrec_nov,2,',', '.')."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Dezembro</th>
        							<td>R$ ".number_format($somasocio_dez,2,',', '.')."</td>
        							<td>R$ ".number_format($somadoacoes_dez,2,',', '.')."</td>
        							<td>R$ ".number_format($somabazar_dez,2,',', '.')."</td>
        							<td>R$ ".number_format($somanfp_dez,2,',', '.')."</td>
        							<td>R$ ".number_format($somarifas_dez,2,',', '.')."</td>
        							<td>R$ ".number_format($somavendas_dez,2,',', '.')."</td>
        							<td>R$ ".number_format($somataxasadocao_dez,2,',', '.')."</td>
        							<td>R$ ".number_format($somajuros_dez,2,',', '.')."</td>
        							<td>R$ ".number_format($somaoutrosrec_dez,2,',', '.')."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>TOTAL</th>
        							<td scope='row'>R$ ".number_format($totalsocio,2,',', '.')."</td>
        							<td scope='row'>R$ ".number_format($totaldoacoes,2,',', '.')."</td>
        							<td scope='row'>R$ ".number_format($totalbazar,2,',', '.')."</td>
        							<td scope='row'>R$ ".number_format($totalnfp,2,',', '.')."</td>
        							<td scope='row'>R$ ".number_format($totalrifas,2,',', '.')."</td>
        							<td scope='row'>R$ ".number_format($totalvendas,2,',', '.')."</td>
        							<td scope='row'>R$ ".number_format($totaltaxasadocao,2,',', '.')."</td>
        							<td scope='row'>R$ ".number_format($totaljuros,2,',', '.')."</td>
        							<td scope='row'>R$ ".number_format($totaloutrosdes,2,',', '.')."</td>
        						  </tr>
        						  </tbody>
        						  </table>
        						  <br>
        						  <center>
                                        <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS</h3>
                                        <br>
                                        <h5>ANO ".$ano." - DESPESAS</h5>
                                   </center>
                        	        <table class='table'>
                                    <thead class='thead-light'>
                                	<th scope='col'>Mês</th>
                                	<th scope='col'>Lar temporário</th>
                                	<th scope='col'>Ração</th>
                                	<th scope='col'>Veterinário</th>
                                	<th scope='col'>Táxi Dog</th>
                                	<th scope='col'>Medicamentos</th>
                                	<th scope='col'>Compras</th>
                                	<th scope='col'>Impostos</th>
                                	<th scope='col'>Outros</th>
                                	</thead>
                                	<tbody>
                                	<tr>
                					<th scope='row'>Janeiro</th>
                							<td>R$ ".number_format($somalt_jan,2,',', '.')."</td>
                							<td>R$ ".number_format($somaracao_jan,2,',', '.')."</td>
                							<td>R$ ".number_format($somavet_jan,2,',', '.')."</td>
                							<td>R$ ".number_format($somataxidog_jan,2,',', '.')."</td>
                							<td>R$ ".number_format($somamedicam_jan,2,',', '.')."</td>
                							<td>R$ ".number_format($somacompras_jan,2,',', '.')."</td>
                							<td>R$ ".number_format($somaimposto_jan,2,',', '.')."</td>
                							<td>R$ ".number_format($somaoutrosdes_jan,2,',', '.')."</td>
                						  </tr>
                						  <th scope='row'>Fevereiro</th>
                							<td>R$ ".number_format($somalt_fev,2,',', '.')."</td>
                							<td>R$ ".number_format($somaracao_fev,2,',', '.')."</td>
                							<td>R$ ".number_format($somavet_fev,2,',', '.')."</td>
                							<td>R$ ".number_format($somataxidog_fev,2,',', '.')."</td>
                							<td>R$ ".number_format($somamedicam_fev,2,',', '.')."</td>
                							<td>R$ ".number_format($somacompras_fev,2,',', '.')."</td>
                							<td>R$ ".number_format($somaimposto_fev,2,',', '.')."</td>
                							<td>R$ ".number_format($somaoutrosdes_fev,2,',', '.')."</td>
                						  </tr>
                						  <th scope='row'>Março</th>
                							<td>R$ ".number_format($somalt_mar,2,',', '.')."</td>
                							<td>R$ ".number_format($somaracao_mar,2,',', '.')."</td>
                							<td>R$ ".number_format($somavet_mar,2,',', '.')."</td>
                							<td>R$ ".number_format($somataxidog_mar,2,',', '.')."</td>
                							<td>R$ ".number_format($somamedicam_mar,2,',', '.')."</td>
                							<td>R$ ".number_format($somacompras_mar,2,',', '.')."</td>
                							<td>R$ ".number_format($somaimposto_mar,2,',', '.')."</td>
                							<td>R$ ".number_format($somaoutrosdes_mar,2,',', '.')."</td>
                						  </tr>
                						  <th scope='row'>Abril</th>
                							<td>R$ ".number_format($somalt_abr,2,',', '.')."</td>
                							<td>R$ ".number_format($somaracao_abr,2,',', '.')."</td>
                							<td>R$ ".number_format($somavet_abr,2,',', '.')."</td>
                							<td>R$ ".number_format($somataxidog_abr,2,',', '.')."</td>
                							<td>R$ ".number_format($somamedicam_abr,2,',', '.')."</td>
                							<td>R$ ".number_format($somacompras_abr,2,',', '.')."</td>
                							<td>R$ ".number_format($somaimposto_abr,2,',', '.')."</td>
                							<td>R$ ".number_format($somaoutrosdes_abr,2,',', '.')."</td>
                						  </tr>
                						  <th scope='row'>Maio</th>
                							<td>R$ ".number_format($somalt_mai,2,',', '.')."</td>
                							<td>R$ ".number_format($somaracao_mai,2,',', '.')."</td>
                							<td>R$ ".number_format($somavet_mai,2,',', '.')."</td>
                							<td>R$ ".number_format($somataxidog_mai,2,',', '.')."</td>
                							<td>R$ ".number_format($somamedicam_mai,2,',', '.')."</td>
                							<td>R$ ".number_format($somacompras_mai,2,',', '.')."</td>
                							<td>R$ ".number_format($somaimposto_mai,2,',', '.')."</td>
                							<td>R$ ".number_format($somaoutrosdes_mai,2,',', '.')."</td>
                						  </tr>
                						  <th scope='row'>Junho</th>
                							<td>R$ ".number_format($somalt_jun,2,',', '.')."</td>
                							<td>R$ ".number_format($somaracao_jun,2,',', '.')."</td>
                							<td>R$ ".number_format($somavet_jun,2,',', '.')."</td>
                							<td>R$ ".number_format($somataxidog_jun,2,',', '.')."</td>
                							<td>R$ ".number_format($somamedicam_jun,2,',', '.')."</td>
                							<td>R$ ".number_format($somacompras_jun,2,',', '.')."</td>
                							<td>R$ ".number_format($somaimposto_jun,2,',', '.')."</td>
                							<td>R$ ".number_format($somaoutrosdes_jun,2,',', '.')."</td>
                						  </tr>
                						  <th scope='row'>Julho</th>
                							<td>R$ ".number_format($somalt_jul,2,',', '.')."</td>
                							<td>R$ ".number_format($somaracao_jul,2,',', '.')."</td>
                							<td>R$ ".number_format($somavet_jul,2,',', '.')."</td>
                							<td>R$ ".number_format($somataxidog_jul,2,',', '.')."</td>
                							<td>R$ ".number_format($somamedicam_jul,2,',', '.')."</td>
                							<td>R$ ".number_format($somacompras_jul,2,',', '.')."</td>
                							<td>R$ ".number_format($somaimposto_jul,2,',', '.')."</td>
                							<td>R$ ".number_format($somaoutrosdes_jul,2,',', '.')."</td>
                						  </tr>
                						  <th scope='row'>Agosto</th>
                							<td>R$ ".number_format($somalt_ago,2,',', '.')."</td>
                							<td>R$ ".number_format($somaracao_ago,2,',', '.')."</td>
                							<td>R$ ".number_format($somavet_ago,2,',', '.')."</td>
                							<td>R$ ".number_format($somataxidog_ago,2,',', '.')."</td>
                							<td>R$ ".number_format($somamedicam_ago,2,',', '.')."</td>
                							<td>R$ ".number_format($somacompras_ago,2,',', '.')."</td>
                							<td>R$ ".number_format($somaimposto_ago,2,',', '.')."</td>
                							<td>R$ ".number_format($somaoutrosdes_ago,2,',', '.')."</td>
                						  </tr>
                						  <th scope='row'>Setembro</th>
                							<td>R$ ".number_format($somalt_set,2,',', '.')."</td>
                							<td>R$ ".number_format($somaracao_set,2,',', '.')."</td>
                							<td>R$ ".number_format($somavet_set,2,',', '.')."</td>
                							<td>R$ ".number_format($somataxidog_set,2,',', '.')."</td>
                							<td>R$ ".number_format($somamedicam_set,2,',', '.')."</td>
                							<td>R$ ".number_format($somacompras_set,2,',', '.')."</td>
                							<td>R$ ".number_format($somaimposto_set,2,',', '.')."</td>
                							<td>R$ ".number_format($somaoutrosdes_set,2,',', '.')."</td>
                						  </tr>
                						  <th scope='row'>Outubro</th>
                							<td>R$ ".number_format($somalt_out,2,',', '.')."</td>
                							<td>R$ ".number_format($somaracao_out,2,',', '.')."</td>
                							<td>R$ ".number_format($somavet_out,2,',', '.')."</td>
                							<td>R$ ".number_format($somataxidog_out,2,',', '.')."</td>
                							<td>R$ ".number_format($somamedicam_out,2,',', '.')."</td>
                							<td>R$ ".number_format($somacompras_out,2,',', '.')."</td>
                							<td>R$ ".number_format($somaimposto_out,2,',', '.')."</td>
                							<td>R$ ".number_format($somaoutrosdes_out,2,',', '.')."</td>
                						  </tr>
                						  <th scope='row'>Novembro</th>
                							<td>R$ ".number_format($somalt_nov,2,',', '.')."</td>
                							<td>R$ ".number_format($somaracao_nov,2,',', '.')."</td>
                							<td>R$ ".number_format($somavet_nov,2,',', '.')."</td>
                							<td>R$ ".number_format($somataxidog_nov,2,',', '.')."</td>
                							<td>R$ ".number_format($somamedicam_nov,2,',', '.')."</td>
                							<td>R$ ".number_format($somacompras_nov,2,',', '.')."</td>
                							<td>R$ ".number_format($somaimposto_nov,2,',', '.')."</td>
                							<td>R$ ".number_format($somaoutrosdes_nov,2,',', '.')."</td>
                						  </tr>
                						  <th scope='row'>Dezembro</th>
                							<td scope='row'>R$ ".number_format($somalt_dez,2,',', '.')."</td>
                							<td scope='row'>R$ ".number_format($somaracao_dez,2,',', '.')."</td>
                							<td scope='row'>R$ ".number_format($somavet_dez,2,',', '.')."</td>
                							<td scope='row'>R$ ".number_format($somataxidog_dez,2,',', '.')."</td>
                							<td scope='row'>R$ ".number_format($somamedicam_dez,2,',', '.')."</td>
                							<td scope='row'>R$ ".number_format($somacompras_dez,2,',', '.')."</td>
                							<td scope='row'>R$ ".number_format($somaimposto_dez,2,',', '.')."</td>
                							<td scope='row'>R$ ".number_format($somaoutrosdes_dez,2,',', '.')."</td>
                						  </tr>
                						  <tr>
                    						  <th scope='row'>TOTAL</th>
                    							<td scope='row'>R$ ".number_format($totallt,2,',', '.')."</td>
                    							<td scope='row'>R$ ".number_format($totalracao,2,',', '.')."</td>
                    							<td scope='row'>R$ ".number_format($totalvet,2,',', '.')."</td>
                    							<td scope='row'>R$ ".number_format($totaltaxidog,2,',', '.')."</td>
                    							<td scope='row'>R$ ".number_format($totalmedicam,2,',', '.')."</td>
                    							<td scope='row'>R$ ".number_format($totalcompras,2,',', '.')."</td>
                    							<td scope='row'>R$ ".number_format($totalimposto,2,',', '.')."</td>
                    							<td scope='row'>R$ ".number_format($totaloutrosdes,2,',', '.')."</td>
                    					  </tr>
                						  </tbody>
                			</table>
                			<br>
                			       <center>
                                        <h3>RESUMO - ANO ".$ano."</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                	    </thead>
                                    	<tbody>
                                    	<tr>
                        					<th scope='row'>Sócios</th>
                        					<td>R$ ".number_format($totalsocio, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Doações</th>
                        					<td>R$ ".number_format($totaldoacoes, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Bazar</th>
                        					<td>R$ ".number_format($totalbazar, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Nota Fiscal Paulista</th>
                        					<td>R$ ".number_format($totalnfp, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Rifas</th>
                        					<td>R$ ".number_format($totalrifas, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Vendas</th>
                        					<td>R$ ".number_format($totalvendas, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Taxas de adoção</th>
                        					<td>R$ ".number_format($totaltaxasadocao, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Juros</th>
                        					<td>R$ ".number_format($totaljuros, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Outras receitas</th>
                        					<td>R$ ".number_format($totaloutrosrec, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Lares temporários</th>
                        					<td>R$ ".number_format($totallt, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Ração</th>
                        					<td>R$ ".number_format($totalracao, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Veterinários e clínicas</th>
                        					<td>R$ ".number_format($totalvet, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Táxi dog</th>
                        					<td>R$ ".number_format($totaltaxidog, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Medicamentos (vacinas, vermífugos, etc)</th>
                        					<td>R$ ".number_format($totalmedicam, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Compras</th>
                        					<td>R$ ".number_format($totalcompras, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Impostos</th>
                        					<td>R$ ".number_format($totalimposto, 2, ',', '.')."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Outras despesas</th>
                        					<td>R$ ".number_format($totaloutrosdes, 2, ',', '.')."</td>
                    					</tr>
                    					</tbody>
                    				</table>";
                					
						 
						$assunto = "Relatório - Lançamentos mensais no ano de ".$ano."";
						
						$mensagem ="<center>
                               <br>
                                <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS</h3><br>
                                <h5>ANO ".$ano." - RECEITAS</h5>
                           </center>
                            <table class='table'>
                            <thead class='thead-light'>
                        	<th scope='col'>Mês</th>
                        	<th scope='col'>Sócio</th>
                        	<th scope='col'>Bazar</th>
                        	<th scope='col'>NFP</th>
                        	<th scope='col'>Rifas</th>
                        	<th scope='col'>Vendas</th>
                        	<th scope='col'>Taxas de adoção</th>
                        	<th scope='col'>Juros</th>
                        	<th scope='col'>Outros</th>
                        	</thead>
                        	<tbody>
                        	<tr>
        					<th scope='row'>Janeiro</th>
        					<td>R$ ".$somasocio_jan."</td>
        							<td>R$ ".$somabazar_jan."</td>
        							<td>R$ ".$somanfp_jan."</td>
        							<td>R$ ".$somarifas_jan."</td>
        							<td>R$ ".$somavendas_jan."</td>
        							<td>R$ ".$somataxasadocao_jan."</td>
        							<td>R$ ".$somajuros_jan."</td>
        							<td>R$ ".$somaoutrosrec_jan."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Fevereiro</th>
        							<td>R$ ".$somasocio_fev."</td>
        							<td>R$ ".$somabazar_fev."</td>
        							<td>R$ ".$somanfp_fev."</td>
        							<td>R$ ".$somarifas_fev."</td>
        							<td>R$ ".$somavendas_fev."</td>
        							<td>R$ ".$somataxasadocao_fev."</td>
        							<td>R$ ".$somajuros_fev."</td>
        							<td>R$ ".$somaoutrosrec_fev."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Março</th>
        							<td>R$ ".$somasocio_mar."</td>
        							<td>R$ ".$somabazar_mar."</td>
        							<td>R$ ".$somanfp_mar."</td>
        							<td>R$ ".$somarifas_mar."</td>
        							<td>R$ ".$somavendas_mar."</td>
        							<td>R$ ".$somataxasadocao_mar."</td>
        							<td>R$ ".$somajuros_mar."</td>
        							<td>R$ ".$somaoutrosrec_mar."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Abril</th>
        							<td>R$ ".$somasocio_abr."</td>
        							<td>R$ ".$somabazar_abr."</td>
        							<td>R$ ".$somanfp_abr."</td>
        							<td>R$ ".$somarifas_abr."</td>
        							<td>R$ ".$somavendas_abr."</td>
        							<td>R$ ".$somataxasadocao_abr."</td>
        							<td>R$ ".$somajuros_abr."</td>
        							<td>R$ ".$somaoutrosrec_abr."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Maio</th>
        							<td>R$ ".$somasocio_mai."</td>
        							<td>R$ ".$somabazar_mai."</td>
        							<td>R$ ".$somanfp_mai."</td>
        							<td>R$ ".$somarifas_mai."</td>
        							<td>R$ ".$somavendas_mai."</td>
        							<td>R$ ".$somataxasadocao_mai."</td>
        							<td>R$ ".$somajuros_mai."</td>
        							<td>R$ ".$somaoutrosrec_mai."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Junho</th>
        							<td>R$ ".$somasocio_jun."</td>
        							<td>R$ ".$somabazar_jun."</td>
        							<td>R$ ".$somanfp_jun."</td>
        							<td>R$ ".$somarifas_jun."</td>
        							<td>R$ ".$somavendas_jun."</td>
        							<td>R$ ".$somataxasadocao_jun."</td>
        							<td>R$ ".$somajuros_jun."</td>
        							<td>R$ ".$somaoutrosrec_jun."</td>
        						  </tr>
        						  <tr>
        						 <th scope='row'>Julho</th>
        							<td>R$ ".$somasocio_jul."</td>
        							<td>R$ ".$somabazar_jul."</td>
        							<td>R$ ".$somanfp_jul."</td>
        							<td>R$ ".$somarifas_jul."</td>
        							<td>R$ ".$somavendas_jul."</td>
        							<td>R$ ".$somataxasadocao_jul."</td>
        							<td>R$ ".$somajuros_jul."</td>
        							<td>R$ ".$somaoutrosrec_jul."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Agosto</th>
        							<td>R$ ".$somasocio_ago."</td>
        							<td>R$ ".$somabazar_ago."</td>
        							<td>R$ ".$somanfp_ago."</td>
        							<td>R$ ".$somarifas_ago."</td>
        							<td>R$ ".$somavendas_ago."</td>
        							<td>R$ ".$somataxasadocao_ago."</td>
        							<td>R$ ".$somajuros_ago."</td>
        							<td>R$ ".$somaoutrosrec_ago."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Setembro</th>
        							<td>R$ ".$somasocio_set."</td>
        							<td>R$ ".$somabazar_set."</td>
        							<td>R$ ".$somanfp_set."</td>
        							<td>R$ ".$somarifas_set."</td>
        							<td>R$ ".$somavendas_set."</td>
        							<td>R$ ".$somataxasadocao_set."</td>
        							<td>R$ ".$somajuros_set."</td>
        							<td>R$ ".$somaoutrosrec_set."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Outubro</th>
        							<td>R$ ".$somasocio_out."</td>
        							<td>R$ ".$somabazar_out."</td>
        							<td>R$ ".$somanfp_out."</td>
        							<td>R$ ".$somarifas_out."</td>
        							<td>R$ ".$somavendas_out."</td>
        							<td>R$ ".$somataxasadocao_out."</td>
        							<td>R$ ".$somajuros_out."</td>
        							<td>R$ ".$somaoutrosrec_out."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Novembro</th>
        							<td>R$ ".$somasocio_nov."</td>
        							<td>R$ ".$somabazar_nov."</td>
        							<td>R$ ".$somanfp_nov."</td>
        							<td>R$ ".$somarifas_nov."</td>
        							<td>R$ ".$somavendas_nov."</td>
        							<td>R$ ".$somataxasadocao_nov."</td>
        							<td>R$ ".$somajuros_nov."</td>
        							<td>R$ ".$somaoutrosrec_nov."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Dezembro</th>
        							<td>R$ ".$somasocio_dez."</td>
        							<td>R$ ".$somabazar_dez."</td>
        							<td>R$ ".$somanfp_dez."</td>
        							<td>R$ ".$somarifas_dez."</td>
        							<td>R$ ".$somavendas_dez."</td>
        							<td>R$ ".$somataxasadocao_dez."</td>
        							<td>R$ ".$somajuros_dez."</td>
        							<td>R$ ".$somaoutrosrec_dez."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>TOTAL</th>
        							<td scope='row'>R$ ".$totalsocio."</td>
        							<td scope='row'>R$ ".$totaldoacoes."</td>
        							<td scope='row'>R$ ".$totalbazar."</td>
        							<td scope='row'>R$ ".$totalnfp."</td>
        							<td scope='row'>R$ ".$totalrifas."</td>
        							<td scope='row'>R$ ".$totalvendas."</td>
        							<td scope='row'>R$ ".$totaltaxasadocao."</td>
        							<td scope='row'>R$ ".$totaljuros."</td>
        							<td scope='row'>R$ ".$totaloutrosrec."</td>
        						  </tr>
        						  </tbody>
        						  </table>
        						  <br>
        						  <center>
                                        <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS</h3>
                                        <br>
                                        <h5>ANO ".$ano." - DESPESAS</h5>
                                   </center>
                        	        <table class='table'>
                                    <thead class='thead-light'>
                                	<th scope='col'>Mês</th>
                                	<th scope='col'>LT + Ração</th>
                                	<th scope='col'>Veterinário</th>
                                	<th scope='col'>Táxi Dog</th>
                                	<th scope='col'>Medicamentos</th>
                                	<th scope='col'>Compras</th>
                                	<th scope='col'>Impostos</th>
                                	<th scope='col'>Outros</th>
                                	</thead>
                                	<tbody>
                                	<tr>
                					<th scope='row'>Janeiro</th>
                							<td>R$ ".$somalt_jan."</td>
                							<td>R$ ".$somavet_jan."</td>
                							<td>R$ ".$somataxidog_jan."</td>
                							<td>R$ ".$somamedicam_jan."</td>
                							<td>R$ ".$somacompras_jan."</td>
                							<td>R$ ".$somaimposto_jan."</td>
                							<td>R$ ".$somaoutrosdes_jan."</td>
                						  </tr>
                						  <th scope='row'>Fevereiro</th>
                							<td>R$ ".$somalt_fev."</td>
                							<td>R$ ".$somavet_fev."</td>
                							<td>R$ ".$somataxidog_fev."</td>
                							<td>R$ ".$somamedicam_fev."</td>
                							<td>R$ ".$somacompras_fev."</td>
                							<td>R$ ".$somaimposto_fev."</td>
                							<td>R$ ".$somaoutrosdes_fev."</td>
                						  </tr>
                						  <th scope='row'>Fevereiro</th>
                							<td>R$ ".$somalt_mar."</td>
                							<td>R$ ".$somavet_mar."</td>
                							<td>R$ ".$somataxidog_mar."</td>
                							<td>R$ ".$somamedicam_mar."</td>
                							<td>R$ ".$somacompras_mar."</td>
                							<td>R$ ".$somaimposto_mar."</td>
                							<td>R$ ".$somaoutrosdes_mar."</td>
                						  </tr>
                						  <th scope='row'>Março</th>
                							<td>R$ ".$somalt_abr."</td>
                							<td>R$ ".$somavet_abr."</td>
                							<td>R$ ".$somataxidog_abr."</td>
                							<td>R$ ".$somamedicam_abr."</td>
                							<td>R$ ".$somacompras_abr."</td>
                							<td>R$ ".$somaimposto_abr."</td>
                							<td>R$ ".$somaoutrosdes_abr."</td>
                						  </tr>
                						  <th scope='row'>Abril</th>
                							<td>R$ ".$somalt_mai."</td>
                							<td>R$ ".$somavet_mai."</td>
                							<td>R$ ".$somataxidog_mai."</td>
                							<td>R$ ".$somamedicam_mai."</td>
                							<td>R$ ".$somacompras_mai."</td>
                							<td>R$ ".$somaimposto_mai."</td>
                							<td>R$ ".$somaoutrosdes_mai."</td>
                						  </tr>
                						  <th scope='row'>Maio</th>
                							<td>R$ ".$somalt_jun."</td>
                							<td>R$ ".$somavet_jun."</td>
                							<td>R$ ".$somataxidog_jun."</td>
                							<td>R$ ".$somamedicam_jun."</td>
                							<td>R$ ".$somacompras_jun."</td>
                							<td>R$ ".$somaimposto_jun."</td>
                							<td>R$ ".$somaoutrosdes_jun."</td>
                						  </tr>
                						  <th scope='row'>Junho</th>
                							<td>R$ ".$somalt_jul."</td>
                							<td>R$ ".$somavet_jul."</td>
                							<td>R$ ".$somataxidog_jul."</td>
                							<td>R$ ".$somamedicam_jul."</td>
                							<td>R$ ".$somacompras_jul."</td>
                							<td>R$ ".$somaimposto_jul."</td>
                							<td>R$ ".$somaoutrosdes_jul."</td>
                						  </tr>
                						  <th scope='row'>Agosto</th>
                							<td>R$ ".$somalt_ago."</td>
                							<td>R$ ".$somavet_ago."</td>
                							<td>R$ ".$somataxidog_ago."</td>
                							<td>R$ ".$somamedicam_ago."</td>
                							<td>R$ ".$somacompras_ago."</td>
                							<td>R$ ".$somaimposto_ago."</td>
                							<td>R$ ".$somaoutrosdes_ago."</td>
                						  </tr>
                						  <th scope='row'>Setembro</th>
                							<td>R$ ".$somalt_set."</td>
                							<td>R$ ".$somavet_set."</td>
                							<td>R$ ".$somataxidog_set."</td>
                							<td>R$ ".$somamedicam_set."</td>
                							<td>R$ ".$somacompras_set."</td>
                							<td>R$ ".$somaimposto_set."</td>
                							<td>R$ ".$somaoutrosdes_set."</td>
                						  </tr>
                						  <th scope='row'>Outubro</th>
                							<td>R$ ".$somalt_out."</td>
                							<td>R$ ".$somavet_out."</td>
                							<td>R$ ".$somataxidog_out."</td>
                							<td>R$ ".$somamedicam_out."</td>
                							<td>R$ ".$somacompras_out."</td>
                							<td>R$ ".$somaimposto_out."</td>
                							<td>R$ ".$somaoutrosdes_out."</td>
                						  </tr>
                						  <th scope='row'>Novembro</th>
                							<td>R$ ".$somalt_nov."</td>
                							<td>R$ ".$somavet_nov."</td>
                							<td>R$ ".$somataxidog_nov."</td>
                							<td>R$ ".$somamedicam_nov."</td>
                							<td>R$ ".$somacompras_nov."</td>
                							<td>R$ ".$somaimposto_nov."</td>
                							<td>R$ ".$somaoutrosdes_nov."</td>
                						  </tr>
                						  <th scope='row'>Dezembro</th>
                							<td scope='row'>R$ ".$somalt_dez."</td>
                							<td scope='row'>R$ ".$somavet_dez."</td>
                							<td scope='row'>R$ ".$somataxidog_dez."</td>
                							<td scope='row'>R$ ".$somamedicam_dez."</td>
                							<td scope='row'>R$ ".$somacompras_dez."</td>
                							<td scope='row'>R$ ".$somaimposto_dez."</td>
                							<td scope='row'>R$ ".$somaoutrosdes_dez."</td>
                						  </tr>
                						  </tbody>
                			</table>";
					
				}
				
		      if ($ano == 'branco' && $mes != 'branco' && $banco ==''){
		            
		            $somasocio = lancamentos_mensal_socios($mes,$connect);
			      	$somabazar = lancamentos_mensal_bazar($mes,$connect);
			      	$somadoacoes = lancamentos_mensal_doacoes($mes,$connect);
			      	$somarifas = lancamentos_mensal_rifas($mes,$connect);
			      	$somanfp = lancamentos_mensal_nfp($mes,$connect);
			      	$somavendas = lancamentos_mensal_vendas($mes,$connect);
			      	$somataxasadocao = lancamentos_mensal_taxasadocao($mes,$connect);
			      	$somajuros = lancamentos_mensal_juros($mes,$connect);
			      	$somaoutrosrec = lancamentos_mensal_outrosrec($mes,$connect);
			      	
			      	$totalreceitas = floatval($somasocio) +
                			      	floatval($somabazar) +
                			      	floatval($somadoacoes) +
                			      	floatval($somarifas) +
                			      	floatval($somanfp) +
                			      	floatval($somavendas) +
                			      	floatval($somataxasadocao) +
                			      	floatval($somajuros) +
                			      	floatval($somaoutrosrec);
                			      
			      	
			      	/** DESPESAS **/
			      	
			      	$somalt = lancamentos_mensal_anual_lt($ano,$mes,$connect);
			      	$somavet = lancamentos_mensal_anual_vet($ano,$mes,$connect);
			      	$somataxidog = lancamentos_mensal_anual_taxidog($ano,$mes,$connect);
			      	$somamedicam = lancamentos_mensal_anual_medicam($ano,$mes,$connect);
			      	$somacompras = lancamentos_mensal_anual_compras($ano,$mes,$connect);
			      	$somaimposto = lancamentos_mensal_anual_imposto($ano,$mes,$connect);
			      	$somaoutrosdes = lancamentos_mensal_anual_outrosdes($ano,$mes,$connect);
			      	
			      	$totaldespesas = floatval($somalt) +
                			      	floatval($somavet) +
                			      	floatval($somataxidog) +
                			      	floatval($somamedicam) +
                			      	floatval($somacompras) +
                			      	floatval($somaimposto) +
                			      	floatval($somaoutrosdes);
                			      	
                	$total = floatval($totalreceitas) - floatval($totaldespesas);
                	
                	echo "teste";
                	
					echo "<center>
                               <br>
                                <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS</h3><br>
                                <h5>MÊS ".$mes." - RECEITAS</h5>
                           </center>
                            <table class='table'>
                            <thead class='thead-light'>
                        	<th scope='col'>Sócio</th>
                        	<th scope='col'>Doações</th>
                        	<th scope='col'>Bazar</th>
                        	<th scope='col'>NFP</th>
                        	<th scope='col'>Rifas</th>
                        	<th scope='col'>Vendas</th>
                        	<th scope='col'>Taxas de adoção</th>
                        	<th scope='col'>Juros</th>
                        	<th scope='col'>Outros</th>
                        	</thead>
                        	<tbody>
                        	<tr>
        					<td>".$somasocio."</td>
        					<td>".$somabazar."</td>
        					<td>".$somadoacoes."</td>
        					<td>".$somarifas."</td>
        					<td>".$somanfp."</td>
        					<td>".$somavendas."</td>
        					<td>".$somataxasadocao."</td>
        					<td>".$somajuros."</td>
        					<td>".$somaoutrosrec."</td>
        					</tr>
        					</tbody>
        					</table>
        					
					        <H3>ANO: ".$ano."<br>
					        MÊS: ".$mes."</h3><br><br>
					        <center>
					       <table border='0' class='texto div-responsive' width='150'>
					       <tr class='relatorio-table-tr-header-1'>
							    <td colspan='2'><b>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS - GERAL</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>RECEITAS</b></td>
						        <td><b>R$".number_format($totalreceitas, 2, ',', '.')."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>DESPESAS</b></td>
						        <td><b>R$".$totaldespesas."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>TOTAL</b></td>
						        <td><b><font color='red'>R$".$total."</font></b></td>
						   </tr>
					       </table>
					       <br><br>
					      <table border='0' class='texto div-responsive' width='150'>
					       <tr class='relatorio-table-tr-header-1'>
							    <td colspan='2'><b>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS - DETALHADO</b></td>
						   </tr>
						  <tr>
						        <td colspan='2' align='center' class='relatorio-table-tr-header-2'><b> RECEITAS</b> </td>

						  </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>Sócio</b></td>
						        <td><b>R$".$somasocio."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>Bazar</b></td>
							    <td><b>R$".$somabazar."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>Nota Fiscal Paulista</b></td>
							    <td><b>R$".$somanfp."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>Rifas</b></td>
							    <td><b>R$".$somarifas."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>Vendas</b></td>
							    <td><b>R$".$somavendas."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>Taxa de adoção</b></td>
							    <td><b>R$".$somataxasadocao."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>Juros</b></td>
							    <td><b>R$".$somajuros."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>Outros</b></td>
							    <td><b>R$".$somaoutrosrec."</b></td>
						   </tr>
						  <tr class='relatorio-table-tr-total'> 
							<td><b>TOTAL</b></td>
							<td><b>R$ ".$totalreceitas."</b></td>

						  </tr>
						  </table> 
						  <table border='0' class='texto div-responsive'>
						  <tr>
						        <td colspan='2' align='center' class='relatorio-table-tr-header-2'><b> DESPESAS</b> </td>
						  </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>Lar temporário + ração</b></td>
						        <td><b>R$".$somalt."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>Veterinários</b></td>
							    <td><b>R$".$somavet."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>Medicamentos</b></td>
							    <td><b>R$".$somamedicam."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							   <td><b>Compras</b></td>
							    <td><b>R$".$somacompras."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							   <td><b>Imposto</b></td>
							    <td><b>R$".$somaimposto."</b></td>
						   </tr>
						   <tr class='relatorio-table-tr-detail'>
							    <td><b>Outas despesas</b></td>
							    <td><b>R$".$somaoutrosdes."</b></td>
						   </tr>
						  <tr class='relatorio-table-tr-total'> 
							<td><b>TOTAL</b></td>
							<td><b>R$ ".$totaldespesas."</b></td>
						  </tr>
						  <tr>
						    <td>&nbsp;</td>
						  </tr>
						  </table></center>";
						 
						$assunto = "Relatório - Lançamentos no mês de ".$mes."";
						
						$mensagem ="<center><img src='/area/logo pequeno.png'></center>
						            <H3>ANO: ".$ano."<br>
        					        MÊS: ".$mes."</h3><br><br>
        					        <center>
        					       <table border='0' class='texto div-responsive' width='150'>
        					       <tr class='relatorio-table-tr-header-1'>
        							    <td colspan='2'><b>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS - GERAL</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>RECEITAS</b></td>
        						        <td><b>R$".$totalreceitas."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>DESPESAS</b></td>
        						        <td><b>R$".$totaldespesas."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>TOTAL</b></td>
        						        <td><b><font color='red'>R$".$total."</font></b></td>
        						   </tr>
        					       </table>
        					       <br><br>
        					      <table border='0' class='texto div-responsive' width='150'>
        					       <tr class='relatorio-table-tr-header-1'>
        							    <td colspan='2'><b>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS - DETALHADO</b></td>
        						   </tr>
        						  <tr>
        						        <td colspan='2' align='center' class='relatorio-table-tr-header-2'><b> RECEITAS</b> </td>
        
        						  </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>Sócio</b></td>
        						        <td><b>R$".$somasocio."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>Bazar</b></td>
        							    <td><b>R$".$somabazar."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>Nota Fiscal Paulista</b></td>
        							    <td><b>R$".$somanfp."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>Rifas</b></td>
        							    <td><b>R$".$somarifas."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>Vendas</b></td>
        							    <td><b>R$".$somavendas."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>Taxa de adoção</b></td>
        							    <td><b>R$".$somataxasadocao."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>Juros</b></td>
        							    <td><b>R$".$somajuros."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>Outros</b></td>
        							    <td><b>R$".$somaoutrosrec."</b></td>
        						   </tr>
        						  <tr class='relatorio-table-tr-total'> 
        							<td><b>TOTAL</b></td>
        							<td><b>R$ ".$totalreceitas."</b></td>
        
        						  </tr>
        						  </table> 
        						  <table border='0' class='texto div-responsive'>
        						  <tr>
        						        <td colspan='2' align='center' class='relatorio-table-tr-header-2'><b> DESPESAS</b> </td>
        						  </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>Lar temporário + ração</b></td>
        						        <td><b>R$".$somalt."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>Veterinários</b></td>
        							    <td><b>R$".$somavet."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>Medicamentos</b></td>
        							    <td><b>R$".$somamedicam."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							   <td><b>Compras</b></td>
        							    <td><b>R$".$somacompras."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							   <td><b>Imposto</b></td>
        							    <td><b>R$".$somaimposto."</b></td>
        						   </tr>
        						   <tr class='relatorio-table-tr-detail'>
        							    <td><b>Outas despesas</b></td>
        							    <td><b>R$".$somaoutrosdes."</b></td>
        						   </tr>
        						  <tr class='relatorio-table-tr-total'> 
        							<td><b>TOTAL</b></td>
        							<td><b>R$ ".$totaldespesas."</b></td>
        						  </tr>
        						  <tr>
        						    <td>&nbsp;</td>
        						  </tr>
        						  </table></center>";
			  
				
		      }
		      
			  if ($ano == 'branco' && $mes == 'branco' && $banco ==''){}
			  
			  if ($ano != 'branco' && $mes != 'branco' && $banco ==''){
			      
					$somasocio_mes = lancamentos_mensal_anual_socios($ano,$mes,$connect);
			      	$somabazar_mes = lancamentos_mensal_anual_bazar($ano,$mes,$connect);
			      	$somadoacoes_mes = lancamentos_mensal_anual_doacoes($ano,$mes,$connect);
			      	$somarifas_mes = lancamentos_mensal_anual_rifas($ano,$mes,$connect);
			      	$somanfp_mes = lancamentos_mensal_anual_nfp($ano,$mes,$area,$connect);
			      	$somavendas_mes = lancamentos_mensal_anual_vendas($ano,$mes,$connect);
			      	$somataxasadocao_mes = lancamentos_mensal_anual_taxasadocao($ano,$mes,$connect);
			      	$somajuros_mes = lancamentos_mensal_anual_juros($ano,'01',$connect);
			      	$somaoutrosrec_mes = lancamentos_mensal_anual_outrosrec($ano,'01',$connect);
			      				      	
			      	$totalrec_mes = floatval($somasocio_men) + 
			      	              floatval($somabazar_mes) + 
			      	              floatval($somadoacoes_mes) + 
			      	              floatval($somarifas_mes) + 
			      	              floatval($somanfp_mes) + 
			      	              floatval($somavendas_mes) + 
			      	              floatval($somataxasadocao_mes) + 
			      	              floatval($somajuros_mes) + 
			      	              floatval($somaoutrosrec_mes) + 
			      	              floatval($somasocio_out) + 
			      	              floatval($somasocio_nov) + 
			      	              floatval($somasocio_dez); 
			      	
			      	/** DESPESAS **/
			      	
			      	$somalt_mes = lancamentos_mensal_anual_lt($ano,$mes,$connect);
			      	$somavet_mes = lancamentos_mensal_anual_vet($ano,$mes,$connect);
			      	$somataxidog_mes = lancamentos_mensal_anual_taxidog($ano,$mes,$connect);
			      	$somamedicam_mes = lancamentos_mensal_anual_medicam($ano,$mes,$connect);
			      	$somacompras_mes = lancamentos_mensal_anual_compras($ano,$mes,$connect);
			      	$somaoutrosdes_mes = lancamentos_mensal_anual_outrosdes($ano,$mes,$connect);
			      				      	
			      	$totaldesp_mes = floatval($somalt_mes) + 
			      	              floatval($somavet_mes ) + 
			      	              floatval($somataxidog_mes) + 
			      	              floatval($somamedicam_mes) + 
			      	              floatval($somacompras_mes) + 
			      	              floatval($somaoutrosdes_mes);
					
					echo "<center>
                               <br>
                                <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS</h3><br>
                                <h5>ANO ".$ano."</h5>
                           </center>
                            <table class='table'>
                            <thead class='thead-light'>
							<th scope='col' colspan='2'> RECEITAS - MÊS ".$mes."</th>
                        	</thead>
                        	<tbody>
                        	<tr>
                            	<th scope='row'>Sócio</th>
                            	<td>R$ ".$somasocio_mes."</td>
                        	</tr>
                        	<tr>
                        	    <th scope='row'>Doações</th>
                        	    <td>R$ ".$somadoacoes_mes."</td>
                        	</tr>
                        	<tr>
                            	<th scope='row'>Bazar</th>
                            	<td>R$ ".$somabazar_mes."</td>
                            </tr>
                        	<tr>
                            	<th scope='row'>NFP</th>
                            	<td>R$ ".$somanfp_mes."</td>
                            </tr>
                        	<tr>
                            	<th scope='row'>Rifas</th>
                            	<td>R$ ".$somarifas_mes."</td>
                            </tr>
                        	<tr>
                            	<th scope='row'>Vendas</th>
                            	<td>R$ ".$somavendas_mes."</td>
                            </tr>
                        	<tr>
                            	<th scope='row'>Taxas de adoção</th>
                            	<td>R$ ".$somataxasadocao_mes."</td>
                            </tr>
                        	<tr>
                            	<th scope='row'>Juros</th>
                            	<td>R$ ".$somajuros_mes."</td>
                            </tr>
                        	<tr>
                            	<th scope='row'>Outros</th>
                            	<td>R$ ".$somaoutrosrec_mes."</td>
                            </tr>
                            <tr>
                                <th scope='row'>TOTAL</th>
                                <td><strong>R$".$totalrec_mes."</strong></td>
                            </tr>
							</tbody>
							</table>
							<br>
							<table class='table'>
                            <thead class='thead-light'>
							<th scope='col' colspan='2'> DESPESAS - MÊS ".$mes."</th>
                        	</thead>
                        	<tbody>
                        	<tr>
                            	<th scope='row'>Lar temporário</th>
                            	<td>R$ ".$somalt_mes."</td>
                            </tr>
                            <tr>
                                <th scope='row'>Ração</th>
                                <td>R$ ".$somaracao_mes."</td>
                            </tr>
                            <tr>
                                <th scope='row'>Veterinário</th>
                                <td>R$ ".$somavet_mes."</td>
                            </tr>
                            <tr>
                                <th scope='row'>Táxi Dog</th>
                                <td>R$ ".$somataxidog_mes."</td>
                            </tr>
                            <tr>
                                <th scope='row'>Medicamentos</th>
                                <td>R$ ".$somamedicam_mes."</td>
                            </tr>
                            <tr>
                                <th scope='row'>Compras</th>
                                <td>R$ ".$somacompras_mes."</td>
                            </tr>
                            <tr>
                                <th scope='row'>Impostos</th>
                                <td>R$ ".$somaimposto_mes."</td>
                            </tr>
                            <tr>
                                <th scope='row'>Outros</th>
                                <td>R$ ".$somaoutrosdes_mes."</td>
                            </tr>
                            <tr>
                                <th scope='row'>TOTAL</th>
                                <td><strong>R$ ".$totaldesp_mes."</strong></td>
                            </tr>
							</tbody>
							</table>
                			<br>";

						 
						$assunto = "Relatório - Lançamentos mensais no ano de ".$ano."";
						
						$mensagem ="<center>
                               <br>
                                <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS</h3><br>
                                <h5>ANO ".$ano." - RECEITAS</h5>
                           </center>
                            <table class='table'>
                            <thead class='thead-light'>
                        	<th scope='col'>Mês</th>
                        	<th scope='col'>Sócio</th>
                        	<th scope='col'>Bazar</th>
                        	<th scope='col'>NFP</th>
                        	<th scope='col'>Rifas</th>
                        	<th scope='col'>Vendas</th>
                        	<th scope='col'>Taxas de adoção</th>
                        	<th scope='col'>Juros</th>
                        	<th scope='col'>Outros</th>
                        	</thead>
                        	<tbody>
                        	<tr>
        					<th scope='row'>Janeiro</th>
        					<td>R$ ".$somasocio_jan."</td>
        							<td>R$ ".$somabazar_jan."</td>
        							<td>R$ ".$somanfp_jan."</td>
        							<td>R$ ".$somarifas_jan."</td>
        							<td>R$ ".$somavendas_jan."</td>
        							<td>R$ ".$somataxasadocao_jan."</td>
        							<td>R$ ".$somajuros_jan."</td>
        							<td>R$ ".$somaoutrosrec_jan."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Fevereiro</th>
        							<td>R$ ".$somasocio_fev."</td>
        							<td>R$ ".$somabazar_fev."</td>
        							<td>R$ ".$somanfp_fev."</td>
        							<td>R$ ".$somarifas_fev."</td>
        							<td>R$ ".$somavendas_fev."</td>
        							<td>R$ ".$somataxasadocao_fev."</td>
        							<td>R$ ".$somajuros_fev."</td>
        							<td>R$ ".$somaoutrosrec_fev."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Março</th>
        							<td>R$ ".$somasocio_mar."</td>
        							<td>R$ ".$somabazar_mar."</td>
        							<td>R$ ".$somanfp_mar."</td>
        							<td>R$ ".$somarifas_mar."</td>
        							<td>R$ ".$somavendas_mar."</td>
        							<td>R$ ".$somataxasadocao_mar."</td>
        							<td>R$ ".$somajuros_mar."</td>
        							<td>R$ ".$somaoutrosrec_mar."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Abril</th>
        							<td>R$ ".$somasocio_abr."</td>
        							<td>R$ ".$somabazar_abr."</td>
        							<td>R$ ".$somanfp_abr."</td>
        							<td>R$ ".$somarifas_abr."</td>
        							<td>R$ ".$somavendas_abr."</td>
        							<td>R$ ".$somataxasadocao_abr."</td>
        							<td>R$ ".$somajuros_abr."</td>
        							<td>R$ ".$somaoutrosrec_abr."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Maio</th>
        							<td>R$ ".$somasocio_mai."</td>
        							<td>R$ ".$somabazar_mai."</td>
        							<td>R$ ".$somanfp_mai."</td>
        							<td>R$ ".$somarifas_mai."</td>
        							<td>R$ ".$somavendas_mai."</td>
        							<td>R$ ".$somataxasadocao_mai."</td>
        							<td>R$ ".$somajuros_mai."</td>
        							<td>R$ ".$somaoutrosrec_mai."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Junho</th>
        							<td>R$ ".$somasocio_jun."</td>
        							<td>R$ ".$somabazar_jun."</td>
        							<td>R$ ".$somanfp_jun."</td>
        							<td>R$ ".$somarifas_jun."</td>
        							<td>R$ ".$somavendas_jun."</td>
        							<td>R$ ".$somataxasadocao_jun."</td>
        							<td>R$ ".$somajuros_jun."</td>
        							<td>R$ ".$somaoutrosrec_jun."</td>
        						  </tr>
        						  <tr>
        						 <th scope='row'>Julho</th>
        							<td>R$ ".$somasocio_jul."</td>
        							<td>R$ ".$somabazar_jul."</td>
        							<td>R$ ".$somanfp_jul."</td>
        							<td>R$ ".$somarifas_jul."</td>
        							<td>R$ ".$somavendas_jul."</td>
        							<td>R$ ".$somataxasadocao_jul."</td>
        							<td>R$ ".$somajuros_jul."</td>
        							<td>R$ ".$somaoutrosrec_jul."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Agosto</th>
        							<td>R$ ".$somasocio_ago."</td>
        							<td>R$ ".$somabazar_ago."</td>
        							<td>R$ ".$somanfp_ago."</td>
        							<td>R$ ".$somarifas_ago."</td>
        							<td>R$ ".$somavendas_ago."</td>
        							<td>R$ ".$somataxasadocao_ago."</td>
        							<td>R$ ".$somajuros_ago."</td>
        							<td>R$ ".$somaoutrosrec_ago."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Setembro</th>
        							<td>R$ ".$somasocio_set."</td>
        							<td>R$ ".$somabazar_set."</td>
        							<td>R$ ".$somanfp_set."</td>
        							<td>R$ ".$somarifas_set."</td>
        							<td>R$ ".$somavendas_set."</td>
        							<td>R$ ".$somataxasadocao_set."</td>
        							<td>R$ ".$somajuros_set."</td>
        							<td>R$ ".$somaoutrosrec_set."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Outubro</th>
        							<td>R$ ".$somasocio_out."</td>
        							<td>R$ ".$somabazar_out."</td>
        							<td>R$ ".$somanfp_out."</td>
        							<td>R$ ".$somarifas_out."</td>
        							<td>R$ ".$somavendas_out."</td>
        							<td>R$ ".$somataxasadocao_out."</td>
        							<td>R$ ".$somajuros_out."</td>
        							<td>R$ ".$somaoutrosrec_out."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Novembro</th>
        							<td>R$ ".$somasocio_nov."</td>
        							<td>R$ ".$somabazar_nov."</td>
        							<td>R$ ".$somanfp_nov."</td>
        							<td>R$ ".$somarifas_nov."</td>
        							<td>R$ ".$somavendas_nov."</td>
        							<td>R$ ".$somataxasadocao_nov."</td>
        							<td>R$ ".$somajuros_nov."</td>
        							<td>R$ ".$somaoutrosrec_nov."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>Dezembro</th>
        							<td>R$ ".$somasocio_dez."</td>
        							<td>R$ ".$somabazar_dez."</td>
        							<td>R$ ".$somanfp_dez."</td>
        							<td>R$ ".$somarifas_dez."</td>
        							<td>R$ ".$somavendas_dez."</td>
        							<td>R$ ".$somataxasadocao_dez."</td>
        							<td>R$ ".$somajuros_dez."</td>
        							<td>R$ ".$somaoutrosrec_dez."</td>
        						  </tr>
        						  <tr>
        						  <th scope='row'>TOTAL</th>
        							<td scope='row'>R$ ".$totalsocio."</td>
        							<td scope='row'>R$ ".$totaldoacoes."</td>
        							<td scope='row'>R$ ".$totalbazar."</td>
        							<td scope='row'>R$ ".$totalnfp."</td>
        							<td scope='row'>R$ ".$totalrifas."</td>
        							<td scope='row'>R$ ".$totalvendas."</td>
        							<td scope='row'>R$ ".$totaltaxasadocao."</td>
        							<td scope='row'>R$ ".$totaljuros."</td>
        							<td scope='row'>R$ ".$totaloutrosrec."</td>
        						  </tr>
        						  </tbody>
        						  </table>
        						  <br>
        						  <center>
                                        <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS</h3>
                                        <br>
                                        <h5>ANO ".$ano." - DESPESAS</h5>
                                   </center>
                        	        <table class='table'>
                                    <thead class='thead-light'>
                                	<th scope='col'>Mês</th>
                                	<th scope='col'>LT + Ração</th>
                                	<th scope='col'>Veterinário</th>
                                	<th scope='col'>Táxi Dog</th>
                                	<th scope='col'>Medicamentos</th>
                                	<th scope='col'>Compras</th>
                                	<th scope='col'>Impostos</th>
                                	<th scope='col'>Outros</th>
                                	</thead>
                                	<tbody>
                                	<tr>
                					<th scope='row'>Janeiro</th>
                							<td>R$ ".$somalt_jan."</td>
                							<td>R$ ".$somavet_jan."</td>
                							<td>R$ ".$somataxidog_jan."</td>
                							<td>R$ ".$somamedicam_jan."</td>
                							<td>R$ ".$somacompras_jan."</td>
                							<td>R$ ".$somaimposto_jan."</td>
                							<td>R$ ".$somaoutrosdes_jan."</td>
                						  </tr>
                						  <th scope='row'>Fevereiro</th>
                							<td>R$ ".$somalt_fev."</td>
                							<td>R$ ".$somavet_fev."</td>
                							<td>R$ ".$somataxidog_fev."</td>
                							<td>R$ ".$somamedicam_fev."</td>
                							<td>R$ ".$somacompras_fev."</td>
                							<td>R$ ".$somaimposto_fev."</td>
                							<td>R$ ".$somaoutrosdes_fev."</td>
                						  </tr>
                						  <th scope='row'>Fevereiro</th>
                							<td>R$ ".$somalt_mar."</td>
                							<td>R$ ".$somavet_mar."</td>
                							<td>R$ ".$somataxidog_mar."</td>
                							<td>R$ ".$somamedicam_mar."</td>
                							<td>R$ ".$somacompras_mar."</td>
                							<td>R$ ".$somaimposto_mar."</td>
                							<td>R$ ".$somaoutrosdes_mar."</td>
                						  </tr>
                						  <th scope='row'>Março</th>
                							<td>R$ ".$somalt_abr."</td>
                							<td>R$ ".$somavet_abr."</td>
                							<td>R$ ".$somataxidog_abr."</td>
                							<td>R$ ".$somamedicam_abr."</td>
                							<td>R$ ".$somacompras_abr."</td>
                							<td>R$ ".$somaimposto_abr."</td>
                							<td>R$ ".$somaoutrosdes_abr."</td>
                						  </tr>
                						  <th scope='row'>Abril</th>
                							<td>R$ ".$somalt_mai."</td>
                							<td>R$ ".$somavet_mai."</td>
                							<td>R$ ".$somataxidog_mai."</td>
                							<td>R$ ".$somamedicam_mai."</td>
                							<td>R$ ".$somacompras_mai."</td>
                							<td>R$ ".$somaimposto_mai."</td>
                							<td>R$ ".$somaoutrosdes_mai."</td>
                						  </tr>
                						  <th scope='row'>Maio</th>
                							<td>R$ ".$somalt_jun."</td>
                							<td>R$ ".$somavet_jun."</td>
                							<td>R$ ".$somataxidog_jun."</td>
                							<td>R$ ".$somamedicam_jun."</td>
                							<td>R$ ".$somacompras_jun."</td>
                							<td>R$ ".$somaimposto_jun."</td>
                							<td>R$ ".$somaoutrosdes_jun."</td>
                						  </tr>
                						  <th scope='row'>Junho</th>
                							<td>R$ ".$somalt_jul."</td>
                							<td>R$ ".$somavet_jul."</td>
                							<td>R$ ".$somataxidog_jul."</td>
                							<td>R$ ".$somamedicam_jul."</td>
                							<td>R$ ".$somacompras_jul."</td>
                							<td>R$ ".$somaimposto_jul."</td>
                							<td>R$ ".$somaoutrosdes_jul."</td>
                						  </tr>
                						  <th scope='row'>Agosto</th>
                							<td>R$ ".$somalt_ago."</td>
                							<td>R$ ".$somavet_ago."</td>
                							<td>R$ ".$somataxidog_ago."</td>
                							<td>R$ ".$somamedicam_ago."</td>
                							<td>R$ ".$somacompras_ago."</td>
                							<td>R$ ".$somaimposto_ago."</td>
                							<td>R$ ".$somaoutrosdes_ago."</td>
                						  </tr>
                						  <th scope='row'>Setembro</th>
                							<td>R$ ".$somalt_set."</td>
                							<td>R$ ".$somavet_set."</td>
                							<td>R$ ".$somataxidog_set."</td>
                							<td>R$ ".$somamedicam_set."</td>
                							<td>R$ ".$somacompras_set."</td>
                							<td>R$ ".$somaimposto_set."</td>
                							<td>R$ ".$somaoutrosdes_set."</td>
                						  </tr>
                						  <th scope='row'>Outubro</th>
                							<td>R$ ".$somalt_out."</td>
                							<td>R$ ".$somavet_out."</td>
                							<td>R$ ".$somataxidog_out."</td>
                							<td>R$ ".$somamedicam_out."</td>
                							<td>R$ ".$somacompras_out."</td>
                							<td>R$ ".$somaimposto_out."</td>
                							<td>R$ ".$somaoutrosdes_out."</td>
                						  </tr>
                						  <th scope='row'>Novembro</th>
                							<td>R$ ".$somalt_nov."</td>
                							<td>R$ ".$somavet_nov."</td>
                							<td>R$ ".$somataxidog_nov."</td>
                							<td>R$ ".$somamedicam_nov."</td>
                							<td>R$ ".$somacompras_nov."</td>
                							<td>R$ ".$somaimposto_nov."</td>
                							<td>R$ ".$somaoutrosdes_nov."</td>
                						  </tr>
                						  <th scope='row'>Dezembro</th>
                							<td scope='row'>R$ ".$somalt_dez."</td>
                							<td scope='row'>R$ ".$somavet_dez."</td>
                							<td scope='row'>R$ ".$somataxidog_dez."</td>
                							<td scope='row'>R$ ".$somamedicam_dez."</td>
                							<td scope='row'>R$ ".$somacompras_dez."</td>
                							<td scope='row'>R$ ".$somaimposto_dez."</td>
                							<td scope='row'>R$ ".$somaoutrosdes_dez."</td>
                						  </tr>
                						  </tbody>
                			</table>";
					
				}
			
			  break;
		
		case 'Total':
			  
			  echo "<iframe src='/area/relatorio_anual.php'>"; 
				
			  break;
		
		case 'Pagamento vets':	  
		    
		     echo "<center>
                       <br>
                        <h3>PROCEDIMENTOS VETERINÁRIOS</h3><br>
                        <h5>ANO ".$ano." </h5>
                        <p>Os valores listados abaixo são dos procedimentos aprovados cadastrados no sistema pelas clínicas, veterinários ou voluntários</p>
                   </center>
                    <table class='table'>
                    <thead class='thead-light'>
                    	<th scope='col'>Mês</th>
                    	<th scope='col'>Clínica ou veterinário</th>
                    	<th scope='col'>Valor</th>
                	</thead>
                	<tbody>";
		    
		    if ($ano != 'branco' && $mes == 'branco' && $banco ==''){
		        
		        $queryvet = "SELECT CLINICA FROM CLINICAS ORDER BY ID ASC";
		        $resultvet = mysqli_query($connect,$queryvet);
		        
		        $i = 1;
		        
		        while ($fetchvet = mysqli_fetch_row($resultvet)) {

                    while ( $i <= '12') {
                        
                        $sum = 0;
                        
                        $mes = str_pad($i, 2, 0, STR_PAD_LEFT);
                        
                        switch ($mes) {
    	                case '01':
    	                    $mestexto = "Janeiro";
    	                    $vet = $fetchvet[0];
    	                    $pagvetmensal = pag_vet_mensal($ano,$mes,$vet,$connect);
    	                    echo "<br> valor: ".$pagvetmensal [0];
    	                    echo "<br> qtde: ".$pagvetmensal[1];
        	                $sum = floatval($sum) + floatval($valorapagar);
        	                if ($sum != 0){
            		            echo "<tr>
                    					<th scope='row'>".$mestexto."</th>
                    					<td>".$vet."</td>
                    					<td>R$ ".number_format($sum,2,',', '.')."</td>
                    				  </tr>";
        		            } 
    	                    break;
    	                case '02':
    	                    $mestexto = "Fevereiro";
    	                    $valorapagar = pag_vet_mensal($ano,$mes,$vet,$connect);
        	                $sum = floatval($sum) + floatval($valorapagar);
        	                if ($sum != 0){
            		            echo "<tr>
                    					<th scope='row'>".$mestexto."</th>
                    					<td>".$vet."</td>
                    					<td>R$ ".number_format($sum,2,',', '.')."</td>
                    				  </tr>";
        		            } 
    	                    break;
    	                case '03':
    	                    $mestexto = "Março";
    	                    $valorapagar = pag_vet_mensal($ano,$mes,$vet,$connect);
        	                $sum = floatval($sum) + floatval($valorapagar);
        	                if ($sum != 0){
            		            echo "<tr>
                    					<th scope='row'>".$mestexto."</th>
                    					<td>".$vet."</td>
                    					<td>R$ ".number_format($sum,2,',', '.')."</td>
                    				  </tr>";
        		            } 
    	                    break;
    	                case '04':
    	                    $mestexto = "Abril";
    	                    $valorapagar = pag_vet_mensal($ano,$mes,$vet,$connect);
        	                $sum = floatval($sum) + floatval($valorapagar);
        	                if ($sum != 0){
            		            echo "<tr>
                    					<th scope='row'>".$mestexto."</th>
                    					<td>".$vet."</td>
                    					<td>R$ ".number_format($sum,2,',', '.')."</td>
                    				  </tr>";
        		            } 
    	                    break;
    	                case '05':
    	                    $mestexto = "Maio";
    	                    $valorapagar = pag_vet_mensal($ano,$mes,$vet,$connect);
        	                $sum = floatval($sum) + floatval($valorapagar);
        	                if ($sum != 0){
            		            echo "<tr>
                    					<th scope='row'>".$mestexto."</th>
                    					<td>".$vet."</td>
                    					<td>R$ ".number_format($sum,2,',', '.')."</td>
                    				  </tr>";
        		            } 
    	                    break;
    	                case '06':
    	                    $mestexto = "Junho";
    	                    $valorapagar = pag_vet_mensal($ano,$mes,$vet,$connect);
        	                $sum = floatval($sum) + floatval($valorapagar);
        	                if ($sum != 0){
            		            echo "<tr>
                    					<th scope='row'>".$mestexto."</th>
                    					<td>".$vet."</td>
                    					<td>R$ ".number_format($sum,2,',', '.')."</td>
                    				  </tr>";
        		            } 
    	                    break;
    	                case '07':
    	                    $mestexto = "Julho";
    	                    $valorapagar = pag_vet_mensal($ano,$mes,$vet,$connect);
        	                $sum = floatval($sum) + floatval($valorapagar);
        	                if ($sum != 0){
            		            echo "<tr>
                    					<th scope='row'>".$mestexto."</th>
                    					<td>".$vet."</td>
                    					<td>R$ ".number_format($sum,2,',', '.')."</td>
                    				  </tr>";
        		            } 
    	                    break;
    	                case '08':
    	                    $mestexto = "Agosto";
    	                    $valorapagar = pag_vet_mensal($ano,$mes,$vet,$connect);
        	                $sum = floatval($sum) + floatval($valorapagar);
        	                if ($sum != 0){
            		            echo "<tr>
                    					<th scope='row'>".$mestexto."</th>
                    					<td>".$vet."</td>
                    					<td>R$ ".number_format($sum,2,',', '.')."</td>
                    				  </tr>";
        		            } 
    	                    break;
    	                case '09':
    	                    $mestexto = "Setembro";
    	                    $valorapagar = pag_vet_mensal($ano,$mes,$vet,$connect);
        	                $sum = floatval($sum) + floatval($valorapagar);
        	                if ($sum != 0){
            		            echo "<tr>
                    					<th scope='row'>".$mestexto."</th>
                    					<td>".$vet."</td>
                    					<td>R$ ".number_format($sum,2,',', '.')."</td>
                    				  </tr>";
        		            } 
    	                    break;
    	                case '10':
    	                    $mestexto = "Outubro";
    	                    $valorapagar = pag_vet_mensal($ano,$mes,$vet,$connect);
        	                $sum = floatval($sum) + floatval($valorapagar);
        	                if ($sum != 0){
            		            echo "<tr>
                    					<th scope='row'>".$mestexto."</th>
                    					<td>".$vet."</td>
                    					<td>R$ ".number_format($sum,2,',', '.')."</td>
                    				  </tr>";
        		            } 
    	                    break;
    	                case '11':
    	                    $mestexto = "Novembro";
    	                    $valorapagar = pag_vet_mensal($ano,$mes,$vet,$connect);
        	                $sum = floatval($sum) + floatval($valorapagar);
        	                if ($sum != 0){
            		            echo "<tr>
                    					<th scope='row'>".$mestexto."</th>
                    					<td>".$vet."</td>
                    					<td>R$ ".number_format($sum,2,',', '.')."</td>
                    				  </tr>";
        		            } 
    	                    break;
    	                case '12':
    	                    $mestexto = "Dezembro";
    	                    $valorapagar = pag_vet_mensal($ano,$mes,$vet,$connect);
        	                $sum = floatval($sum) + floatval($valorapagar);
        	                if ($sum != 0){
            		            echo "<tr>
                    					<th scope='row'>".$mestexto."</th>
                    					<td>".$vet."</td>
                    					<td>R$ ".number_format($sum,2,',', '.')."</td>
                    				  </tr>";
        		            } 
    	                    break;
        		     }
    	                
    		            $i = $i + 1;
    		            }
		        }
		    }
		    
	        if ($ano != 'branco' && $mes != 'branco' && $banco ==''){
	            
	            switch ($mes) {
	                case '01':
	                    $mestexto = "Janeiro";
	                    break;
	                case '02':
	                    $mestexto = "Fevereiro";
	                    break;
	                case '03':
	                    $mestexto = "Março";
	                    break;
	                case '04':
	                    $mestexto = "Abril";
	                    break;
	                case '05':
	                    $mestexto = "Maio";
	                    break;
	                case '06':
	                    $mestexto = "Junho";
	                    break;
	                case '07':
	                    $mestexto = "Julho";
	                    break;
	                case '08':
	                    $mestexto = "Agosto";
	                    break;
	                case '09':
	                    $mestexto = "Setembro";
	                    break;
	                case '10':
	                    $mestexto = "Outubro";
	                    break;
	                case '11':
	                    $mestexto = "Novembro";
	                    break;
	                case '12':
	                    $mestexto = "Dezembro";
	                    break;
	            }
	        
    	        $queryvet = "SELECT CLINICA FROM CLINICAS";
    	        $resultvet = mysqli_query($connect,$queryvet);
    	        
    	        
    	        while ($fetchvet = mysqli_fetch_row($resultvet)) {
    		            $vet = $fetchvet[0];
        		        if ($tmp == $vet) {
        		                $valorapagar = pag_vet_mensal($ano,$mes,$vet,$connect);
        		                $sum = floatval($sum) + floatval($valorapagar);
        		        } else {
        		                $sum = pag_vet_mensal($ano,$mes,$vet,$connect);
        		        }
        		            $tmp = $vet;
    		            
    		            if ($sum != 0){
        		            echo "<tr>
                					<th scope='row'>".$mestexto."</th>
                					<td>".$vet."</td>
                					<td>R$ ".number_format($sum,2,',', '.')."</td>
                				  </tr>";
    		            } 
    	                $i = 1;
    	            
    	        }
    		        

    		        
    		    }
		        		        
	        echo "</tbody>
	              </table>";
	              
	       	break;
	   
	   case 'Pagamento lts':
	       
	       $lt_ant = '';
	       
	       if ($ano !='branco' && $mes == 'branco'){
	           $querylt ="SELECT * FROM HISTORICO_PAG_LT WHERE ANO_VIGENTE='$ano' ORDER BY LAR_TEMPORARIO ASC";    
	       }
	       
	       if ($ano !='branco' && $mes != 'branco'){
	           $querylt ="SELECT * FROM HISTORICO_PAG_LT WHERE ANO_VIGENTE='$ano' AND MES_VIGENTE ='$mes' ORDER BY LAR_TEMPORARIO ASC";    
	       }
	       
	       if ($ano =='branco' && $mes != 'branco'){
	           $querylt ="SELECT * FROM HISTORICO_PAG_LT WHERE MES_VIGENTE ='$mes' ORDER BY LAR_TEMPORARIO ASC";    
	       }
	       
	       if ($ano =='branco' && $mes == 'branco'){
	           $querylt ="SELECT * FROM HISTORICO_PAG_LT ORDER BY LAR_TEMPORARIO ASC";    
	       }
	       
	       $selectlt = mysqli_query($connect,$querylt);
	       $reccountlt = mysqli_num_rows($selectlt);
		
		   echo "<center>
                       <br>
                        <h3>PAGAMENTOS DOS LARES TEMPORÁRIOS</h3><br>
                        <h5>ANO ".$ano." - Mês ".$mes."</h5>
                        <p>Os valores listados abaixo foram cadastrados na tabela de acordo com os valores incluídos no cadastro do animal.</p>
                   </center>";
            
            echo "<table class='table'>
                                <thead class='thead-light'>
                                	<th scope='col'>Nome do animal</th>
                                	<th scope='col'>Lar temporário</th>
                                	<th scope='col'>Nascimento em</th>
                                	<th scope='col'>Período inicial</th>
                                	<th scope='col'>Período final</th>
                                	<th scope='col'>Qtde de dias</th>
                                	<th scope='col'>Valor pago</th>
                                	<th scope='col'>Data do pgto</th>
                                	<th scope='col'>Status</th>
                            	</thead>
                            	<tbody>";
        
		   while ($fetchlt = mysqli_fetch_row($selectlt)) {
                $nomeanimal = $fetchlt[1];
                $lt = $fetchlt[2];
                $valor_dia = $fetchlt[4];
                $valor_pago = $fetchlt[5];
                $dt_pgto = $fetchlt[6];
                $periodo_inicial = $fetchlt[7];
                $periodo_final = $fetchlt[8];
                $qtd_dias = $fetchlt[9];
                $status = $fetchlt[12];
                $dtnasc = $fetchlt[13];
                /*echo "<br> lt ant: ".$lt_ant;
                echo "<br> lt atu: ".$lt;*/
                $ano_inicio = substr($periodo_inicial,0,4);
		        $mes_inicio = substr($periodo_inicial,5,2);
		        $dia_inicio = substr($periodo_inicial,8,2);
		        
		        $ano_fim = substr($periodo_final,0,4);
		        $mes_fim = substr($periodo_final,5,2);
		        $dia_fim = substr($periodo_final,8,2);
		        
		        $ano_pgto = substr($dt_pgto,0,4);
		        $mes_pgto = substr($dt_pgto,5,2);
		        $dia_pgto = substr($dt_pgto,8,2);
		        
		        $ano_nasc = substr($dtnasc,0,4);
		        $mes_nasc = substr($dtnasc,5,2);
		        $dia_nasc = substr($dtnasc,8,2);
		        
                echo " <tr>
            					<td>".$nomeanimal."</td>
            					<td>".$lt."</td>
            					<td>".$dia_nasc."/".$mes_nasc."/".$ano_nasc."</td>
            					<td>".$dia_inicio."/".$mes_inicio."/".$ano_inicio."</td>
            					<td>".$dia_fim."/".$mes_fim."/".$ano_fim."</td>
            					<td>".$qtd_dias."</td>
            					<td>R$ ".number_format($valor_pago,2,',', '.')."</td>
            					<td>".$dia_pgto."/".$mes_pgto."/".$ano_pgto."</td>
            					<td>".$status."</td>
            				  </tr>
            	";
            	$sum_total = floatval($sum_total) + floatval($valor_pago);
                
		   }
		   
		   echo "    </tbody>
		         </table>";
		   
		   function pag_lt_mensal($ano,$mes,$lt,$connect){
				$querysum = "SELECT SUM(VALOR_PAGO) FROM HISTORICO_PAG_LT WHERE DATA_PGTO LIKE '".$ano."-".$mes."-%' AND LAR_TEMPORARIO = '$lt' ORDER BY DATA ASC";
				$resultsum = mysqli_query($connect,$querysum);
			    $rc = mysqli_fetch_row($resultsum);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);

		    }
		    
		    echo "
                    <center>
                    <h3>TOTAL A PAGAR</h3><br>
                   </center>
        	        <table class='table'>
                        <thead class='thead-light'>
                	    </thead>
                    	<tbody>";
		    
		    $querydist = "SELECT DISTINCT(LAR_TEMPORARIO) FROM HISTORICO_PAG_LT WHERE DATA_PGTO LIKE '".$ano."-".$mes."-%'";
			$resultdist = mysqli_query($connect,$querydist);
			
			$reccountd = mysqli_num_rows($resultdist);
			
			echo "<br> reccountd: ".$reccountd;
		    
		    while ($fetchdist = mysqli_fetch_row($selectdist)) {
                $nome_lt = $fetchdist[0];
                $total_pagar = pag_lt_mensal($ano,$mes_ant,$nome_lt);
		        
		        echo "  <tr>
        					<th scope='row'>".$nome_lt."</th>
        					<td> R$".$total_pagar."</td>
    					</tr>";
		   
		    }
            
			echo "  </tbody>
			      </table>";
	       
	       break;
	       
	   case 'Vendas de canecas':
	       echo "<script>document.location='result_relatoriofornec.php?mes=".$mes."&ano=".$ano."'</script>";
	       break;
	       	
	}
	    
	mysqli_close($connect);
		
}
		
?>
  <form action="enviarrelatoriofinanc.php" method="post" name="emailrelatorio" id="emailrelatorio">  
    <div class="d-print-none">
        <center><p><strong>OBSERVAÇÕES</strong><br>
            <i>O valor total é a somatória dos lançamentos de todas as fontes de receitas do dia 01 até o último dia do mês coletados pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail financeiro@gaarcampinas.org</i></center>
        <input type="text" id="assunto" name="assunto" value="<? echo $assunto?>" hidden>
        <input type="text" id="mensagem" name="mensagem" value="<? echo $mensagem?>" hidden> <br>
        <center><a href="javascript:emailrelatorio.submit()" class="btn btn-primary">Enviar relatório por e-mail</a> &nbsp; <a href="javascript:window.print()" class="btn btn-primary">Download</a> &nbsp; <a href="relatorio_financeiro.php" class="btn btn-primary">Nova pesquisa</a></center>
    </div>
    </form>
    <br>
    </div>
    <!--<div class="visible-print-inline-block">-->
    <div class="d-none d-print-block">
        <center><p><strong>OBSERVAÇÕES</strong><br>
                <i>O valor total é a somatória dos lançamentos de todas as fontes de receitas do dia 01 até o último dia do mês coletados pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail financeiro@gaarcampinas.org</i></center>
    </div>
</main>
<br><br>
<footer class="footer fixed-bottom bg-light">
      <div class="container">
        <p class="text-center">GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
      </div>
    </footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>
