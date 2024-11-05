<?php

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$ano = $_POST['ano'];
$mes = str_pad($_POST['mes'], 2, "0", STR_PAD_LEFT);

$ano_atu = date("Y");
    		
$mes_ant = date('m',strtotime('-1 months'));
$dia_atu = date("d");

$dtatu = date("Y-m-d");
    		
$dtatu_format = date("d-m-Y");

$tipotransf = 0;
$call_func_mensal = FALSE;
$call_func_anual = FALSE;
$call_func_anual_mensal = FALSE;
$call_func_total = FALSE;

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}
else{
        function close_window() {
            if (confirm("Fechar janela?")) {
                close();
            }
        }
        
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
		
		function select_subtipolanc_anual($bancolanc_func,$anolanc_func,$subtipolanc_func,$connect){
				$querysumvalor = "SELECT SUM(VALOR_LANC) FROM FINANCEIRO WHERE BANCO_LANC = '".$bancolanc_func."' AND DATA_LANC LIKE '".$anolanc_func."-%' AND SUBTIPO_LANC = '".$subtipolanc_func."'";
				$resultsumvalor = mysqli_query($connect,$querysumvalor);
			    $rc = mysqli_fetch_row($resultsumvalor);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function select_tipolanc_mensal($bancolanc_func,$meslanc_func,$tipolanc_func,$connect){
				$querysumvalor = "SELECT SUM(VALOR_LANC) FROM FINANCEIRO WHERE BANCO_LANC = '".$bancolanc_func."' AND DATA_LANC LIKE '%-".$meslanc_func."-%' AND TIPO_LANC = '".$tipolanc_func."'";
				$resultsumvalor = mysqli_query($connect,$querysumvalor);
			    $rc = mysqli_fetch_row($resultsumvalor);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function select_tipolanc_mensal_outros($meslanc_func,$tipolanc_func,$connect){
				$querysumvalor = "SELECT SUM(VALOR_LANC) FROM FINANCEIRO WHERE DATA_LANC LIKE '%-".$meslanc_func."-%' AND TIPO_LANC = '".$tipolanc_func."'";
				$resultsumvalor = mysqli_query($connect,$querysumvalor);
			    $rc = mysqli_fetch_row($resultsumvalor);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function select_tipolanc_anual($bancolanc_func,$anolanc_func,$tipolanc_func,$connect){
				$querysumvalor = "SELECT SUM(VALOR_LANC) FROM FINANCEIRO WHERE BANCO_LANC = '".$bancolanc_func."' AND DATA_LANC LIKE '".$anolanc_func."-%' AND TIPO_LANC = '".$tipolanc_func."'";
				$resultsumvalor = mysqli_query($connect,$querysumvalor);
			    $rc = mysqli_fetch_row($resultsumvalor);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function select_tipolanc_anual_outros($anolanc_func,$tipolanc_func,$connect){
				$querysumvalor = "SELECT SUM(VALOR_LANC) FROM FINANCEIRO WHERE DATA_LANC LIKE '".$anolanc_func."-%' AND TIPO_LANC = '".$tipolanc_func."'";
				$resultsumvalor = mysqli_query($connect,$querysumvalor);
			    $rc = mysqli_fetch_row($resultsumvalor);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function select_tipolanc_anual_mensal($bancolanc_func,$anolanc_func,$meslanc_func,$tipolanc_func,$connect){
				$querysumvalor = "SELECT SUM(VALOR_LANC) FROM FINANCEIRO WHERE BANCO_LANC = '".$bancolanc_func."' AND DATA_LANC LIKE '".$anolanc_func."-".$meslanc_func."-%' AND TIPO_LANC = '".$tipolanc_func."'";
				$resultsumvalor = mysqli_query($connect,$querysumvalor);
			    $rc = mysqli_fetch_row($resultsumvalor);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function select_tipolanc_anual_mensal_outros($anolanc_func,$meslanc_func,$tipolanc_func,$connect){
				$querysumvalor = "SELECT SUM(VALOR_LANC) FROM FINANCEIRO WHERE BANCO_LANC = '".$bancolanc_func."' AND DATA_LANC LIKE '".$anolanc_func."-".$meslanc_func."-%' AND TIPO_LANC = '".$tipolanc_func."'";
				$resultsumvalor = mysqli_query($connect,$querysumvalor);
			    $rc = mysqli_fetch_row($resultsumvalor);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function select_tipolanc_total($bancolanc_func,$tipolanc_func,$connect){
				$querysumvalor = "SELECT SUM(VALOR_LANC) FROM FINANCEIRO WHERE BANCO_LANC = '".$bancolanc_func."' AND TIPO_LANC = '".$tipolanc_func."'";
				$resultsumvalor = mysqli_query($connect,$querysumvalor);
			    $rc = mysqli_fetch_row($resultsumvalor);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function select_tipolanc_total_outros($tipolanc_func,$connect){
				$querysumvalor = "SELECT SUM(VALOR_LANC) FROM FINANCEIRO WHERE TIPO_LANC = '".$tipolanc_func."'";
				$resultsumvalor = mysqli_query($connect,$querysumvalor);
			    $rc = mysqli_fetch_row($resultsumvalor);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
        function tipo_lanc($valortmp,$connect){
                $query = "SELECT * FROM PROCEDIMENTOS WHERE CLINICA = '".$vet."' AND DATA LIKE '".$ano_atu."-".$mes."-%' ORDER BY DATA ASC";
				$result = mysqli_query($connect,$query);
				$reccount = mysqli_num_rows($result);	
				
				$valor = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valorgaar = $fetch[11];
				    $valortutor = $fetch[12];
				    $valor = $valor + ($valorgaar + $valortutor);
				}
					
				return ($valor);
		}

	    function floatvalue($val){
            $val = str_replace(",",".",$val);
            $val = preg_replace('/\.(?=.*\.)/', '', $val);
            return floatval($val);
        }
	    
        function retiraAcentos($string){
           $acentos  =  'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
           $sem_acentos  =  'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
           $string = strtr($string, utf8_decode($acentos), $sem_acentos);
           $string = str_replace(" ","-",$string);
           return utf8_decode($string);
        }

		$queryarea = "SELECT AREA,SUBAREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
		}

		/*$query = "SELECT * FROM TERMO_ADOCAO WHERE POS_ADOCAO = '0001-01-01' ";*/
		
		$extrato=$_FILES['extratoxls']['name'];
		/*$uploaddir = "/home/gaarca06/public_html/docs/financeiro/".$ano_atu."/".$mes_ant."/";*/
		$uploaddir = "/home/gaarca06/public_html/docs/financeiro/extratos/".$ano_atu."/".$mes_ant."/";
		$downloaddir = "http://gaarcampinas.org/docs/financeiro/extratos/".$ano_atu."/".$mes_ant."/";
        $uploadfile = $uploaddir.($_FILES['extratoxls']['name']);
        $banco = $_POST['banco'];
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
    
    <link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">

    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/auto-refresh/bootstrap-table-auto-refresh.min.js"></script>
    <!--- BOOTSTRAP --->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--- BOOTSTRAP --->
    <title>GAAR - Extratos</title>
    
    <script type="text/javascript">
    
        $(document).ready(function(){
                             $("#btnAdicionarVol").click(function(){
                                
                            	$.ajax({
                                	url: "atualizaextrato.php",
                             		type: "POST",
                             		data: {
                             		    idlancam: document.getElementById("idlanc").value,
                             		    newcat: document.getElementById("updtcateg").value,
                             		},
                            		success: function(response){
                            		    document.getElementById('AlertSuccess_volnome').innerHTML= document.getElementById("voluntarios").value + " cadastrado com sucesso";
                            		    document.getElementById('lblAlertSuccess_vol').className = "alert alert-success d-block";
                                    },
                                    error: function(response){
                                        document.getElementById('AlertDanger_volnome').innerHTML= document.getElementById("voluntarios").value + " não foi cadastrado. Por favor tente novamente"; 
                                        document.getElementById('lblAlertDanger_vol').className = "alert alert-danger d-block";
                                    }
                            	});
                            });
                             
                          });
                          
    </script>
    
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">
        <center><img src="http://gaarcampinas.org/area/logo_transparent.png" width="70" height="70"></center><br>
<?
        $mensagem = "<!DOCTYPE html>
                                    <html lang='pt-br'>
                                      <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                                        
                                        <!-- Bootstrap CSS -->
                                        
                                        <link rel='stylesheet' media='all' href='/assets/application-mailer-dbc5154d3c4160e8fa7ef52fa740fa402760c39b5d22c8f6d64ad5999499d263.css' />
                                        
                                        <link rel='stylesheet' type='text/css' href='style-area.css'/>
                
                                        <link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>
                                        
                                      </head>
                                      
                                    <body style='font-family: verdana; font-size: 12px'>
                                    <font face='verdana'> 
            				        <div class='d-none d-print-block'>
                                        <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center>
                                    </div>
                    			       <center>
                                            <h3>EXTRATOS ".$ano_atu."</h3><br>
                                        </center>
                                        
                                        <br>
                                        <p> Seguem os extratos dos lançamentos cadastrados no sistema. 
                                        
                                        <br><br>";
    
		if ($extrato != ''){
		  $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
          if(in_array($_FILES['extratoxls']['type'],$mimes)){
    		    if (move_uploaded_file($_FILES['extratoxls']['tmp_name'], $uploadfile)) {
    		            
            		    $countlidas = 0;
            		    $countupload = 0;
            		    $sumdespesas = 0;
            		    $sumreceitas = 0;
            		    $sumreceitas_itaucc = 0;
            		    $sumreceitas_itaupp = 0;
            		    $sumreceitas_pagbank = 0;
            		    $sumreceitas_mp = 0;
            		    $sumdespesas_itaucc = 0;
            		    $sumdespesas_itaupp = 0;
            		    $sumdespesas_pagbank = 0;
            		    $sumdespesas_mp = 0;
            		    $sumoutros = 0;
            		    $saldo = 0;
            		
            		    if (($handle = fopen($uploadfile, "r")) !== FALSE) {
            		        $fgetcsv = ",";
            		        
            		        while (($data = fgetcsv($handle, 1000, $fgetcsv)) !== FALSE) {   
                                $tmp = 0;
                                /****** LAYOUT DA PLANILHA ******
                                /* IDENTIFICACAO DO BANCO : COLUNA 0
                                /* DATA DO LANÇAMENTO     : COLUNA 1
                                /* DESCRIÇÃO DO LANÇAMENTO: COLUNA 2
                                /* VALOR DE RECEITA       : COLUNA 3
                                /* VALOR DE DESPESA       : COLUNA 4 */
                                /****** LAYOUT DA PLANILHA ******/
                                
                                $banco_lanc = $data[0];
                		        
                    		    $dia_lanc = substr($data[1],0,2);
                    		    $mes_lanc = substr($data[1],3,2);
                    		    $ano_lanc = substr($data[1],6,4);
                    		    $tmpdescricao = $data[2];
                    		    $descricao_lanc = $data[3];
                    		    $valor_receita = $data[4];
                    		    $valor_despesa = $data[5];
                    		    
                                $checadata = checkdate($mes_lanc,$dia_lanc,$ano_lanc);
                                
                		        if (checkdate($mes_lanc,$dia_lanc,$ano_lanc) != FALSE) {
                		                $tmpvalordesp =0;
                		                $tmpvalorrec =0;
                		                $tmpvaloroutros = 0;
                		                $valor = 0;
                		                $tmpvalor_receita_itaucc = 0;
                		                $tmpvalor_despesa_itaucc = 0;
                		                $tmpvalor_receita_itaupp = 0;
                		                $tmpvalor_despesa_itaupp = 0;
                		                $tmpvalor_receita_pagbank = 0;
                		                $tmpvalor_despesa_pagbank = 0;
                		                $tmpvalor_receita_mp = 0;
                		                $tmpvalor_despesa_mp = 0;
                		                
                		                /* IDENTIFICACAO DO BANCO */
                		                if ((strpos($banco_lanc, 'Banco Itaú CC') !== false)) {
                                                    $banco = 'Banco Itaú - Conta Corrente'; 
                                                    $tmpvalor_receita_itaucc = floatvalue($valor_receita);
                                                    $tmpvalor_despesa_itaucc = floatvalue($valor_despesa);
                                                    $sumreceitas_itaucc = floatval($tmpvalor_receita_itaucc) + $sumreceitas_itaucc;
                                                    $sumdespesas_itaucc = floatval($tmpvalor_despesa_itaucc) + $sumdespesas_itaucc;
                		                }
                		                if ((strpos($banco_lanc, 'Banco Itaú PP') !== false)) {
                                                    $banco = 'Banco Itaú - Conta Poupança'; 
                                                    $tmpvalor_receita_itaupp = floatvalue($valor_receita);
                                                    $tmpvalor_despesa_itaupp = floatvalue($valor_despesa);
                                                    $sumreceitas_itaupp = floatval($tmpvalor_receita_itaupp) + $sumreceitas_itaupp;
                                                    $sumdespesas_itaupp = floatval($tmpvalor_despesa_itaupp) + $sumdespesas_itaupp;
                		                }
                		                if ((strpos($banco_lanc, 'Pagbank') !== false)) {
                                                    $banco = 'Pagbank'; 
                                                    $tmpvalor_receita_pagbank = floatvalue($valor_receita);
                                                    $tmpvalor_despesa_pagbank = floatvalue($valor_despesa);
                                                    $sumreceitas_pagbank = floatval($tmpvalor_receita_pagbank) + $sumreceitas_pagbank;
                                                    $sumdespesas_pagbank = floatval($tmpvalor_despesa_pagbank) + $sumdespesas_pagbank;
                		                }
                		                if ((strpos($banco_lanc, 'Mercado Pago') !== false)) {
                                                    $banco = 'Mercado Pago'; 
                                                    $tmpvalor_receita_mp = floatvalue($valor_receita);
                                                    $tmpvalor_despesa_mp = floatvalue($valor_despesa);
                                                    $sumreceitas_mp = floatval($tmpvalor_receita_mp) + $sumreceitas_mp;
                                                    $sumdespesas_mp = floatval($tmpvalor_despesa_mp) + $sumdespesas_mp;
                		                }
                		                
                                        $descricao = strval($tmpdescricao);
                                        
                		                /* CATEGORIZACAO */
                                        /* DESPESAS*/
                                        if ((strpos($descricao, 'Imposto') !== false) || (strpos($descricao, 'IMPOSTO') !== false) || (strpos($descricao, 'Tarifa') !== false) || (strpos($descricao, 'IOF') !== false) || (strpos($descricao, 'TAR') !== false)) {
                                                    $subtipo_lanc = 'Impostos bancários e/ou federais'; 
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'Loja') !== false) ){
                                                    $subtipo_lanc = 'Mensalidade Loja Virtual'; 
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'Adestrador') !== false) ){
                                                    $subtipo_lanc = 'Adestrador'; 
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'Facebook') !== false) || (strpos($descricao, 'FACEBOOK') !== false) || (strpos($descricao, 'Fbok') !== false) || (strpos($descricao, 'FBOK') !== false)){
                                                    $subtipo_lanc = 'Anúncios patrocinados redes sociais';
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'LT') !== false) ){
                                                    $subtipo_lanc = 'Lar temporário';
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'MED') !== false) || (strpos($descricao, 'Med') !== false) ){
                                                    $subtipo_lanc = 'Medicamentos';
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'VET') !== false) || (strpos($descricao, 'Vet') !== false)){
                                                    $subtipo_lanc = 'Veterinário';
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'Compra') !== false) || (strpos($descricao, 'COMPRA') !== false)){
                                                    $subtipo_lanc = 'Compras';
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'Caneca') !== false) || (strpos($descricao, 'CANECA') !== false) || (strpos($descricao, 'COMPRA') !== false) ){
                                                    $subtipo_lanc = 'Compras';
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'CEMITÉRIO') !== false) || (strpos($descricao, 'Cemitério') !== false)){
                                                    $subtipo_lanc = 'Cemitério';
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'GRÁFICA') !== false) || (strpos($descricao, 'Gráfica') !== false) || (strpos($descricao, 'CÓPIA') !== false)){
                                                    $subtipo_lanc = 'Gráfica';
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'CARTÓRIO') !== false)){
                                                    $subtipo_lanc = 'Cartório';
                                                    $tipo_lanc = 'Despesa';
                                        } elseif (strpos($descricao, 'Bricolagem') !== false){
                                                    $subtipo_lanc = 'Bricolagem';
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'Ração') !== false) || (strpos($descricao, 'Rações') !== false) || (strpos($descricao, 'RAÇÃO') !== false) || (strpos($descricao, 'RAÇÕES') !== false)){
                                                    $subtipo_lanc = 'Ração';
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'Taxi') !== false) || (strpos($descricao, 'TAXI') !== false)){
                                                    $subtipo_lanc = 'Taxi Dog';
                                                    $tipo_lanc = 'Despesa';
                                        } elseif ((strpos($descricao, 'Renovação') !== false)){
                                                    $subtipo_lanc = 'Renovação';
                                                    $tipo_lanc = 'Despesa';
                                        /* RECEITAS */
                                        } elseif ((strpos($descricao, 'Sócio') !== false) || (strpos($descricao, 'SÓCIO') !== false) || (strpos($descricao, 'Sócia') !== false) || (strpos($descricao, 'SÓCIA') !== false)){
                                                    $subtipo_lanc = 'Sócio'; 
                                                    $tipo_lanc = 'Receita';
                                        } elseif ((strpos($descricao, 'Doação') !== false) || (strpos($descricao, 'Doações') !== false) || (strpos($descricao, 'DOAÇÃO') !== false) || (strpos($descricao, 'DOAÇÕES') !== false)){
                                                    $subtipo_lanc = 'Doações';
                                                    $tipo_lanc = 'Receita';
                                        } elseif ((strpos($descricao, 'Rifa') !== false) || (strpos($descricao, 'RIFA') !== false) || (strpos($descricao, 'Sorteio') !== false)){
                                                    $subtipo_lanc = 'Rifas';
                                                    $tipo_lanc = 'Receita';
                                        } elseif ((strpos($descricao, 'Bazar') !== false) || (strpos($descricao, 'BAZAR') !== false)){
                                                    $subtipo_lanc = 'Bazares';
                                                    $tipo_lanc = 'Receita';
                                        } elseif ((strpos($descricao, 'NFP') !== false) || (strpos($descricao, 'NOTA FISCAL PAULISTA') !== false) ){
                                                    $subtipo_lanc = 'Nota Fiscal Paulista';
                                                    $tipo_lanc = 'Receita';
                                        } elseif ((strpos($descricao, 'Venda') !== false) ){
                                                    $subtipo_lanc = 'Vendas';
                                                    $tipo_lanc = 'Receita';
                                        } elseif ((strpos($descricao, 'DOÇÃO') !== false) || (strpos($descricao, 'doção') !== false) || (strpos($descricao, 'docao') !== false) || (strpos($descricao, 'DOCAO') !== false)){
                                                    $subtipo_lanc = 'Taxa de Adoção';
                                                    $tipo_lanc = 'Receita';
                                        } elseif ((strpos($descricao, 'Juros') !== false) || (strpos($descricao, 'JUROS') !== false) ){
                                                    $subtipo_lanc = 'Rendimentos';
                                                    $tipo_lanc = 'Receita';
                                        /* OUTROS */
                                        } elseif ((strpos($descricao, 'GAAR') !== false) || (strpos($descricao, 'Gaar') !== false) || (strpos($descricao, 'gaar') !== false) ){
                                                    $subtipo_lanc = 'Transferência entre contas GAAR';
                                                    $tipo_lanc = 'Outros';
                                        } elseif ((strpos($descricao, 'ESTORNO') !== false) || (strpos($descricao, 'Estorno') !== false) || (strpos($descricao, 'Reembolso') !== false)){
                                                    $subtipo_lanc = 'Estorno ou Reembolso';
                                                    $tipo_lanc = 'Outros';
                                        } else {
                                            echo "<br> Lançamento não categorizado: ".$descricao;
                                        }
                                        
                                        switch ($subtipo_lanc) {
                                            case 'Estorno ou Reembolso':
                                            case 'Transferência entre contas GAAR':
                                                if ($valor_despesa != ''){
                                                    $tmpvaloroutros = floatvalue($valor_despesa);
                                                } elseif ($valor_receita != '') {
                                                    $tmpvaloroutros = floatvalue($valor_receita);
                                                }
                                                $valor = floatval($tmpvaloroutros);
                                                $sumoutros = floatvalue($tmpvaloroutros) + $sumoutros;
                                                break;
                                            default:
                                                if ($valor_despesa != ''){
                        		                    $tmpvalordesp = floatvalue($valor_despesa);
                                                    /*$valor_despesa = floatval($tmpvalordesp) * floatval(-1);*/
                                                    /*$valor = $valor_despesa;*/
                                                    $valor = $tmpvalordesp;
                                                    $sumdespesas = floatval($tmpvalordesp) + $sumdespesas;
                        		                } elseif ($valor_receita != ''){
                        		                    $tmpvalorrec = floatvalue($valor_receita);
                                                    $valor = $tmpvalorrec;
                                                    $sumreceitas = floatval($tmpvalorrec) + $sumreceitas;
                                                } 
                                                break;
                                        }
                		                /*if ($tipo_lanc <> 'Outros'){
                		                    if ($valor_despesa != ''){
                    		                    $tmpvalordesp = floatvalue($valor_despesa);
                                                $valor_despesa = floatval($tmpvalordesp) * floatval(-1);
                                                $valor = $valor_despesa;
                                                $sumdespesas = floatval($tmpvalordesp) + $sumdespesas;
                    		                } elseif ($valor_receita != ''){
                    		                    $tmpvalorrec = floatvalue($valor_receita);
                                                $valor = $tmpvalorrec;
                                                /*echo "<br> banco: ".$banco;
                                                echo "<br> data_lanc: ".$dia_lanc."/".$mes_lanc."/".$ano_lanc;
                                                echo "<br> descricao: ".$descricao;
                                                echo "<br> valor: ".$valor;
                                                echo "<br> subtipo_lanc: ".$subtipo_lanc;
                                                echo "<br> tipo_lanc: ".$tipo_lanc;
                                                $sumreceitas = floatval($tmpvalorrec) + $sumreceitas;
                                            } 
                		                }*/
                		                
                		                $countlidas =  intval($countlidas) + 1;
                		        
                		                $data_lanc = $ano_lanc."-".$mes_lanc."-".$dia_lanc;

                                        $valor_contabil = $valor;
                                    
                                        $parcelamento = '01';
                                        $tipo_reemb = 'Sem reembolso';
                                    
                                        /*echo "<br> banco: ".$banco;
                                        echo "<br> data_lanc: ".$dia_lanc."/".$mes_lanc."/".$ano_lanc;
                                        echo "<br> descricao: ".$descricao;
                                        echo "<br> valor: ".$valor;
                                        echo "<br> subtipo_lanc: ".$subtipo_lanc;
                                        echo "<br> tipo_lanc: ".$tipo_lanc;
                                        echo "<br> --------------------------- "; */
                                    
                                        $queryinsertdoc = "INSERT INTO DOCUMENTACAO (
                                                            EVENTO, 
                                                            ENDERECO, 
                                                            DATA,
                                                            DESCRICAO,
                                                            VOLUNTARIOS_PRESENTES,
                                                            FILE,
                                                            AREA_PRINCIPAL,
                                                            USUARIO,
                                                            VALOR,
                                                            DATA_DOC) 
                                                            values (
                                                                'Planilha bancária',
                                                                '$banco',
                                                                '$dtatu',
                                                                '$banco',
                                                                '0',
                                                                '$extrato',
                                                                'Financeiro',
                                                                '$login',
                                                                '0',
                                                                '0')";

                                        $queryinsert = "INSERT INTO FINANCEIRO (
                                                            DATA_LANC, 
                                                            DESCRICAO_LANC, 
                                                            SUBTIPO_LANC,
                                                            VALOR_LANC,
                                                            BANCO_LANC,
                                                            VALOR_REL_CONTABIL,
                                                            PARCELAMENTO,
                                                            TIPO_REEMB,
                                                            COMPROVANTE_COMPRA,
                                                            COMPROVANTE_REEMB,
                                                            OBS,
                                                            TIPO_LANC,
                                                            USUARIO,
                                                            TIPO_TRANSF) 
                                                            values (
                                                                '$data_lanc',
                                                                '$descricao_lanc',
                                                                '$subtipo_lanc',
                                                                '$valor',
                                                                '$banco',
                                                                '$valor_contabil',
                                                                '$parcelamento',
                                                                '$tipo_reemb',
                                                                '0',
                                                                '0',
                                                                '0',
                                                                '$tipo_lanc',
                                                                '$login',
                                                                '$tipotransf')";
                                        
                                        $insert = mysqli_query($connect,$queryinsert);
                                        
                                        /* INSERT TABELA DOCUMENTAÇÃO */
                                        /*$insertdoc = mysqli_query($connect,$queryinsertdoc);*/
                                        
                                        if(mysqli_errno($connect) == '0'){
                                                    $countupload = intval($countupload) + 1;
                                                    /*echo "<br> Lançamento carregado: Data: ".$data_lanc." Descrição: ".$descricao. " TMP Valor: ".$tmpvalor." Valor: ".$valor." Banco: ".$banco." SQLCODE: ".mysqli_errno($connect)."Tipo: ".gettype($valor);*/
                                        } else {
                                                    /*echo "<br> query: ".$queryinsert;
                                                    echo "<br>Insert code: ".$insert;
                                            		echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); **/
                                            		$message .= "<p> REGISTRO DUPLICADO NÃO CARREGADOS</p>";
                                            		$message .= "<br>Data: ".$data_lanc." Descrição: ".$tmpdescricao. " Valor: ".$valor." Banco: ".$banco." ";
                                            		echo $message;
                                        }
                                }
                		        
                            }
                            
                        if ($countupload <> 0) {
                                /*$sum_valorlanc_itaucc = select_subtipolanc('Banco Itaú - Conta Corrente',$subtipolanc);*/
                                $message .="<br><br> ESTATÍSTICAS DO ARQUIVO ".$extrato."<br>";
                                $message .="<br>Despesas totais: R$ ".number_format($sumdespesas, 2, ',', '.')."";
                                $message .="<br>Receitas totais: R$ ".number_format($sumreceitas, 2, ',', '.')."";
                                $saldo = floatval($sumreceitas) - floatval($sumdespesas);
                                $message .="<br>Saldo: R$".number_format($saldo, 2, ',', '.')."";
                                $message .="<br> -----------------";
                                $message .="<br> TRANSFERÊNCIA ENTRE CONTAS GAAR E/OU ERROS BANCÁRIOS";
                                $message .="<br> R$ ".number_format($sumoutros, 2, ',', '.')."";
                                $message .="<br> -----------------";
                                $message .="<br> BANCO ITAÚ - CONTA CORRENTE";
                                $message .="<br> Despesas: R$ ".number_format($sumdespesas_itaucc, 2, ',', '.')."";
                                $message .="<br> Receitas: R$ ".number_format($sumreceitas_itaucc, 2, ',', '.')."";
                                $message .="<br> -----------------";
                                $message .="<br> BANCO ITAÚ - CONTA POUPANÇA";
                                $message .="<br> Despesas: R$ ".number_format($sumdespesas_itaupp, 2, ',', '.')."";
                                $message .="<br> Receitas: R$ ".number_format($sumreceitas_itaupp, 2, ',', '.')."";
                                $message .="<br> -----------------";
                                $message .="<br> BANCO PAGBANK";
                                $message .="<br> Despesas: R$ ".number_format($sumdespesas_pagbank, 2, ',', '.')."";
                                $message .="<br> Receitas: R$ ".number_format($sumreceitas_pagbank, 2, ',', '.')."";
                                $message .="<br> -----------------";
                                $message .="<br> BANCO MERCADO PAGO";
                                $message .="<br> Despesas: R$ ".number_format($sumdespesas_mp, 2, ',', '.')."";
                                $message .="<br> Receitas: R$ ".number_format($sumreceitas_mp, 2, ',', '.')."";
                                $message .="<br> -----------------";
                                $message .="<br>Upload realizado com sucesso <br>".$countupload." linhas carregadas <br> ".$countlidas." linhas lidas ";
                                
                                echo $message;
                                
                                ini_set('display_errors', 1);
            
                                error_reporting(E_ALL);
                                
                                $from = "contato@gaarcampinas.org";
                                
                                $headers = "MIME-Version: 1.0\n";               
                                $headers .= "Content-type: text/html; charset=utf-8\n";            
                                $headers .= "From: <{$from}> \r\n"; 
                                
                                $subject = "Relatório de upload";
                                
                                $to = "thaise.piculi@gmail.com";
                                
                                $result =  mail($to, $subject, $message, $headers);
        
                                if ($result){
                                    echo "<br>Estatísticas enviadas para: ".$to;
                                } else {
                                    echo "<br>Erro no envio: ".$to;
                                }
                                
                                /*echo"<script language='javascript' type='text/javascript'>
                                        alert('Upload realizado com sucesso');window.location
                                        .href='formextrato.php'</script>"; */
                        } else {
                                echo "<br>Upload não realizado - ".$countlidas." linhas lidas";
                                echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
                                /*echo"<script language='javascript' type='text/javascript'>
                                        alert('Upload não realizado');window.location
                                        .href='formextrato.php'</script>";*/
                        }
                            
                        fclose($handle);
                        
                        echo "<br><br><input type='submit' name='fechar' value='Fechar' class='btn btn-primary' onClick='window.close()'></center><br>";
            		  
                } else {
            		        echo"<script language='javascript' type='text/javascript'>
                                        alert('Erro ao carregar');window.location
                                        .href='formextrato.php'</script>";
            		    }
    		    } else {
    		        echo"<script language='javascript' type='text/javascript'>
                                        alert('Erro ao carregar - Formato inválido');window.location
                                        .href='formextrato.php'</script>"; 
    		    }
		} 
	    } else { /* GERAR RELATÓRIO */
		    if ($ano == "branco" && $mes == "branco"){
    		    $ano = date("Y");
    		    $querydata = "SELECT * FROM FINANCEIRO WHERE DATA_LANC LIKE '".$ano."-%'";
    		    $call_func_total = TRUE;
    		} 
    		if ($ano == "branco" && $mes != "branco"){
    		    /*$ano = date("Y");*/
    		    $querydata = "SELECT * FROM FINANCEIRO WHERE DATA_LANC LIKE '%-".$mes."-%'";
    		    $call_func_mensal = TRUE;
    		} 
    		
    		if ($ano != "branco" && $mes == "branco"){
    		    $querydata = "SELECT * FROM FINANCEIRO WHERE DATA_LANC LIKE '".$ano."-%'";
    		    $call_func_anual = TRUE;
    		} 
    		
    		if ($ano != "branco" && $mes != "branco"){
    		    $querydata = "SELECT * FROM FINANCEIRO WHERE DATA_LANC LIKE '".$ano."-".$mes."%'";
    		    $call_func_anual_mensal = TRUE;
    		} 
    		
    		$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);
    		
    		$sum_pagbank_receita = 0;
    		$sum_itaucc_receita = 0;
    		$sum_itaupp_receita = 0;
    		$sum_mercp_receita = 0;
    		$sum_pagbank_despesa = 0;
    		$sum_itaucc_despesa = 0;
    		$sum_itaupp_despesa = 0;
    		$sum_mercp_despesa = 0;
    		$saldo_pagbank = 0;
    		$saldo_itau = 0;
    		$saldo_mercp = 0;
    		
    		$select = mysqli_query($connect,$query);
    		$reccount = mysqli_num_rows($select);

    		if ($reccount <> '0'){
    		    $querypagbank = $querydata." AND BANCO_LANC = 'PagBank' ORDER BY DATA_LANC ASC";
    		    $selectpagbank = mysqli_query($connect,$querypagbank);         
    		    $reccountpagbank = mysqli_num_rows($selectpagbank);
    		    
    		    if ($reccountpagbank == '0') {
    		        $mensagem .="<br> Nenhum lançamento encontrado no banco PagBank<br><br>";
    		    } else {
    		        $mensagem .="<table border='1'>
                                                    <thead class='thead-light'>
                                    						  <tr>
                                    							<th scope='col' colspan='1'>DATA</th>
                                    							<th scope='col' colspan='1'>DESCRIÇÃO</th>
                                    						    <th scope='col' colspan='1'>SUBTIPO</th>
                                    						    <th scope='col' colspan='1'>TIPO</th>
                                    						    <th scope='col' colspan='1'>VALOR</th>
                                    						    <th scope='col' colspan='1'>BANCO</th>
                                    						    <th scope='col' colspan='1'>COMPROVANTE</th>
                                    						   </tr>
                                    				</thead>";
                
    		        while ($fetch = mysqli_fetch_row($selectpagbank)) {
            		    $id = $fetch[0];
            		    $dtlanc = $fetch[1];
            		    $desc = $fetch[2];
            		    $tipo_lanc = $fetch[13];
            		    $subtipo_lanc = $fetch[3];
            		    $valor = $fetch[4];
            		    $banco = $fetch[6];
            		    $compr_compra = $fetch[10];
            		    $compr_reemb = $fetch[11];
            		    $obs = $fetch[12];
            		    
            		    $anolanc = substr($dtlanc,0,4);
            		    $meslanc = substr($dtlanc,5,2);
            		    $dialanc = substr($dtlanc,8,2);
        
                        $mensagem .="<tr>
                                                <td align='left'>".$dialanc."/".$meslanc."</td>
                                                <td align='left'>".$desc."</td>
                                                <td align='left'>".$subtipo_lanc."</td>
                                                <td align='left'>".$tipo_lanc."</td>";
                                                if ($tipo_lanc == 'Despesa'){
                                                   $mensagem .="<td align='left'><font color='red'> - R$ ".number_format($valor, 2, ',', '.')."</font></td>"; 
                                                } else{
                                                    $mensagem .="<td align='left'>R$ ".number_format($valor, 2, ',', '.')."</td>";
                                                }
                                                $mensagem .="<td align='left'>".$banco."</td>";
                                                if ($compr_compra <> '0'){
                                                    $mensagem .= "<td align='left'><a href='http://www.gaarcampinas.org/docs/financeiro/".$compr_compra."'>Download </a></td>";  
                                                } else {
                                                    $mensagem .= "<td align='left'>&nbsp;</td>";
                                                }
                                                $mensagem .="<td><a href='fatualizalanc.php?idlanc=".$id."' target='_blank'>Atualizar</a></td>";
                        $mensagem .= "</tr>";
            		    
            		
            	    }
            	    
            	    $mensagem .="</table>
            	                  <br><br>";
            	    
            	    if ($call_func_total == TRUE) {
            	        $sum_pagbank_receita = select_tipolanc_total($banco,'Receita',$connect);
            	        $sum_pagbank_despesa = select_tipolanc_total($banco,'Despesa',$connect);
            	        $sum_pagbank_outros = select_tipolanc_total_outros('Outros',$connect);
            	
            	    } elseif ($call_func_mensal == TRUE) {
            	        $sum_pagbank_receita = select_tipolanc_mensal($banco,$meslanc,'Receita',$connect);
            	        $sum_pagbank_despesa = select_tipolanc_mensal($banco,$meslanc,'Despesa',$connect);
            	        $sum_pagbank_outros = select_tipolanc_mensal_outros($meslanc,'Outros',$connect);
            	
            	    } elseif ($call_func_anual == TRUE) {
            	        $sum_pagbank_receita = select_tipolanc_anual($banco,$anolanc,'Receita',$connect);
            	        $sum_pagbank_despesa = select_tipolanc_anual($banco,$anolanc,'Despesa',$connect);
            	        $sum_pagbank_outros = select_tipolanc_anual_outros($anolanc,'Outros',$connect);
            	
            	    } elseif ($call_func_anual_mensal == TRUE) {
            	        $sum_pagbank_receita = select_tipolanc_anual_mensal($banco,$anolanc,$meslanc,'Receita',$connect);
            	        $sum_pagbank_despesa = select_tipolanc_anual_mensal($banco,$anolanc,$meslanc,'Despesa',$connect);
            	        $sum_pagbank_outros = select_tipolanc_anual_mensal_outros($anolanc,$meslanc,'Outros',$connect);
            	
            	   }

    		    }

        	    $queryitaucc = $querydata." AND BANCO_LANC = 'Banco Itaú - Conta Corrente' ORDER BY DATA_LANC ASC";
        		$selectitaucc = mysqli_query($connect,$queryitaucc);
        		$reccountitaucc = mysqli_num_rows($selectitaucc);
        		
        		if ($reccountitaucc == '0') {
    		        $mensagem .="<br> Nenhum lançamento encontrado no banco Itaú - conta corrente<br><br>";
    		    } else {
    		        
            		$mensagem .="<table border='1'>
                                                    <thead class='thead-light'>
                                    						  <tr>
                                    							<th scope='col' colspan='1'>DATA</th>
                                    							<th scope='col' colspan='1'>DESCRIÇÃO</th>
                                    						    <th scope='col' colspan='1'>SUBTIPO</th>
                                    						    <th scope='col' colspan='1'>TIPO</th>
                                    						    <th scope='col' colspan='1'>VALOR</th>
                                    						    <th scope='col' colspan='1'>BANCO</th>
                                    						    <th scope='col' colspan='1'>COMPROVANTE</th>
                                    						   </tr>
                                    				</thead>";
            		
            		while ($fetch = mysqli_fetch_row($selectitaucc)) {
            		    $id = $fetch[0];
            		    $dtlanc = $fetch[1];
            		    $desc = $fetch[2];
            		    $tipo_lanc = $fetch[13];
            		    $subtipo_lanc = $fetch[3];
            		    $valor = $fetch[4];
            		    $banco = $fetch[6];
            		    $compr_compra = $fetch[10];
            		    $compr_reemb = $fetch[11];
            		    $obs = $fetch[12];
            		    
            		    $anolanc = substr($dtlanc,0,4);
            		    $meslanc = substr($dtlanc,5,2);
            		    $dialanc = substr($dtlanc,8,2);
            
                        $mensagem .="<tr>
                                                <td align='left'>".$dialanc."/".$meslanc."</td>
                                                <td align='left'>".$desc."</td>
                                                <td align='left'>".$subtipo_lanc."</td>
                                                <td align='left'>".$tipo_lanc."</td>";
                                                if ($tipo_lanc == 'Despesa'){
                                                   $mensagem .="<td align='left'><font color='red'> - R$ ".number_format($valor, 2, ',', '.')."</font></td>"; 
                                                } else{
                                                    $mensagem .="<td align='left'>R$ ".number_format($valor, 2, ',', '.')."</td>";
                                                }
                                                $mensagem .="<td align='left'>".$banco."</td>";
                                                if ($compr_compra <> '0'){
                                                    $mensagem .= "<td align='left'><a href='http://www.gaarcampinas.org/docs/financeiro/".$compr_compra."'>Download</a></td>";  
                                                } else {
                                                    $mensagem .= "<td align='left'>&nbsp;</td>";
                                                }
                                                $mensagem .="<td><a href='fatualizalanc.php?idlanc=".$id."' target='_blank'>Atualizar</a></td>";
                        $mensagem .= "</tr>";
            		    
            	    }
            	    $mensagem .="</table>
            	                  <br><br>";
            	   
            	    if ($call_func_total == TRUE) {
            	        $sum_itaucc_receita = select_tipolanc_total($banco,'Receita',$connect);
            	        $sum_itaucc_despesa = select_tipolanc_total($banco,'Despesa',$connect);
            	        $sum_itaucc_outros = select_tipolanc_total_outros('Outros',$connect);
            	
            	    } elseif ($call_func_mensal == TRUE) {
            	        $sum_itaucc_receita = select_tipolanc_mensal($banco,$meslanc,'Receita',$connect);
            	        $sum_itaucc_despesa = select_tipolanc_mensal($banco,$meslanc,'Despesa',$connect);
            	        $sum_itaucc_outros = select_tipolanc_mensal_outros($meslanc,'Outros',$connect);
            	
            	    } elseif ($call_func_anual == TRUE) {
            	        $sum_itaucc_receita = select_tipolanc_anual($banco,$anolanc,'Receita',$connect);
            	        $sum_itaucc_despesa = select_tipolanc_anual($banco,$anolanc,'Despesa',$connect);
            	        $sum_itaucc_outros = select_tipolanc_anual_outros($anolanc,'Outros',$connect);
            	
            	    } elseif ($call_func_anual_mensal == TRUE) {
            	        $sum_itaucc_receita = select_tipolanc_anual_mensal($banco,$anolanc,$meslanc,'Receita',$connect);
            	        $sum_itaucc_despesa = select_tipolanc_anual_mensal($banco,$anolanc,$meslanc,'Despesa',$connect);
            	        $sum_itaucc_outros = select_tipolanc_anual_mensal_outros($anolanc,$meslanc,'Outros',$connect);
            	
            	   }
            	    
    		    }

        	    $queryitaupp = $querydata." AND BANCO_LANC = 'Banco Itaú - Conta Poupança' ORDER BY DATA_LANC ASC";
        		$selectitaupp = mysqli_query($connect,$queryitaupp);
        		$reccountitaupp = mysqli_num_rows($selectitaupp);
        		
        		if ($reccountitaupp == '0') {
    		        $mensagem .="<br> Nenhum lançamento encontrado no banco Itaú - conta Poupança<br><br>";
    		    } else {
    		        
            		$mensagem .="<table border='1'>
                                                    <thead class='thead-light'>
                                    						  <tr>
                                    							<th scope='col' colspan='1'>DATA</th>
                                    							<th scope='col' colspan='1'>DESCRIÇÃO</th>
                                    						    <th scope='col' colspan='1'>SUBTIPO</th>
                                    						    <th scope='col' colspan='1'>TIPO</th>
                                    						    <th scope='col' colspan='1'>VALOR</th>
                                    						    <th scope='col' colspan='1'>BANCO</th>
                                    						    <th scope='col' colspan='1'>COMPROVANTE</th>
                                    						   </tr>
                                    				</thead>";
            		
            		while ($fetch = mysqli_fetch_row($selectitaupp)) {
            		    $id = $fetch[0];
            		    $dtlanc = $fetch[1];
            		    $desc = $fetch[2];
            		    $tipo_lanc = $fetch[13];
            		    $subtipo_lanc = $fetch[3];
            		    $valor = $fetch[4];
            		    $banco = $fetch[6];
            		    $compr_compra = $fetch[10];
            		    $compr_reemb = $fetch[11];
            		    $obs = $fetch[12];
            		    
            		    $anolanc = substr($dtlanc,0,4);
            		    $meslanc = substr($dtlanc,5,2);
            		    $dialanc = substr($dtlanc,8,2);
            		    
                        $mensagem .="<tr>
                                                <td align='left'>".$dialanc."/".$meslanc."</td>
                                                <td align='left'>".$desc."</td>
                                                <td align='left'>".$subtipo_lanc."</td>
                                                <td align='left'>".$tipo_lanc."</td>";
                                                if ($tipo_lanc == 'Despesa'){
                                                   $mensagem .="<td align='left'><font color='red'> - R$ ".number_format($valor, 2, ',', '.')."</font></td>"; 
                                                } else{
                                                    $mensagem .="<td align='left'>R$ ".number_format($valor, 2, ',', '.')."</td>";
                                                }
                                                $mensagem .="<td align='left'>".$banco."</td>";
                                                if ($compr_compra <> '0'){
                                                    $mensagem .= "<td align='left'><a href='http://www.gaarcampinas.org/docs/financeiro/".$compr_compra."'>Download</a></td>";  
                                                } else {
                                                    $mensagem .= "<td align='left'>&nbsp;</td>";
                                                }
                                                $mensagem .="<td><a href='fatualizalanc.php?idlanc=".$id."' target='_blank'>Atualizar</a></td>";
                        $mensagem .= "</tr>";
            		    
            	    }
            	    $mensagem .="</table>
            	                  <br><br>";
            	                  
            	    if ($call_func_total == TRUE) {
            	        $sum_itaupp_receita = select_tipolanc_total($banco,'Receita',$connect);
            	        $sum_itaupp_despesa = select_tipolanc_total($banco,'Despesa',$connect);
            	        $sum_itaupp_outros = select_tipolanc_total_outros('Outros',$connect);
            	
            	    } elseif ($call_func_mensal == TRUE) {
            	        $sum_itaupp_receita = select_tipolanc_mensal($banco,$meslanc,'Receita',$connect);
            	        $sum_itaupp_despesa = select_tipolanc_mensal($banco,$meslanc,'Despesa',$connect);
            	        $sum_itaupp_outros = select_tipolanc_mensal_outros($meslanc,'Outros',$connect);
            	
            	    } elseif ($call_func_anual == TRUE) {
            	        $sum_itaupp_receita = select_tipolanc_anual($banco,$anolanc,'Receita',$connect);
            	        $sum_itaupp_despesa = select_tipolanc_anual($banco,$anolanc,'Despesa',$connect);
            	        $sum_itaupp_outros = select_tipolanc_anual_outros($anolanc,'Outros',$connect);
            	
            	    } elseif ($call_func_anual_mensal == TRUE) {
            	        $sum_itaupp_receita = select_tipolanc_anual_mensal($banco,$anolanc,$meslanc,'Receita',$connect);
            	        $sum_itaupp_despesa = select_tipolanc_anual_mensal($banco,$anolanc,$meslanc,'Despesa',$connect);
            	        $sum_itaupp_outros = select_tipolanc_anual_mensal_outros($anolanc,$meslanc,'Outros',$connect);
            	
            	   }

    		    }

                /*MERCADO PAGO*/    		    
    		    $querymercp = $querydata." AND BANCO_LANC = 'Mercado Pago' ORDER BY DATA_LANC ASC";
        		$selectmercp = mysqli_query($connect,$querymercp);
        		$reccountmercp = mysqli_num_rows($selectmercp);
        		
        		if ($reccountmercp == '0') {
    		        $mensagem .="<br> Nenhum lançamento encontrado no banco Mercado Pago<br><br>";
    		    } else {
    		        
            		$mensagem .="<table border='1'>
                                                    <thead class='thead-light'>
                                    						  <tr>
                                    							<th scope='col' colspan='1'>DATA</th>
                                    							<th scope='col' colspan='1'>DESCRIÇÃO</th>
                                    						    <th scope='col' colspan='1'>SUBTIPO</th>
                                    						    <th scope='col' colspan='1'>TIPO</th>
                                    						    <th scope='col' colspan='1'>VALOR</th>
                                    						    <th scope='col' colspan='1'>BANCO</th>
                                    						    <th scope='col' colspan='1'>COMPROVANTE</th>
                                    						   </tr>
                                    				</thead>";
            		
            		while ($fetch = mysqli_fetch_row($selectmercp)) {
            		    $id = $fetch[0];
            		    $dtlanc = $fetch[1];
            		    $desc = $fetch[2];
            		    $tipo_lanc = $fetch[13];
            		    $subtipo_lanc = $fetch[3];
            		    $valor = $fetch[4];
            		    $banco = $fetch[6];
            		    $compr_compra = $fetch[10];
            		    $compr_reemb = $fetch[11];
            		    $obs = $fetch[12];
            		    
            		    $anolanc = substr($dtlanc,0,4);
            		    $meslanc = substr($dtlanc,5,2);
            		    $dialanc = substr($dtlanc,8,2);
            
                        $mensagem .="<tr>
                                                <td align='left'>".$dialanc."/".$meslanc."</td>
                                                <td align='left'>".$desc."</td>
                                                <td align='left'>".$subtipo_lanc."</td>
                                                <td align='left'>".$tipo_lanc."</td>";
                                                if ($tipo_lanc == 'Despesa'){
                                                   $mensagem .="<td align='left'><font color='red'> - R$ ".number_format($valor, 2, ',', '.')."</font></td>"; 
                                                } else{
                                                    $mensagem .="<td align='left'>R$ ".number_format($valor, 2, ',', '.')."</td>";
                                                }
                                                $mensagem .="<td align='left'>".$banco."</td>";
                                                if ($compr_compra <> '0'){
                                                    $mensagem .= "<td align='left'><a href='http://www.gaarcampinas.org/docs/financeiro/".$compr_compra."'>Download</a></td>";  
                                                } else {
                                                    $mensagem .= "<td align='left'>&nbsp;</td>";
                                                }
                        $mensagem .= "</tr>";
            		    
            	    }
            	    $mensagem .="</table>
            	                  <br><br>";
            	                  
            	    if ($call_func_total == TRUE) {
            	        $sum_mercp_receita = select_tipolanc_total($banco,'Receita',$connect);
            	        $sum_mercp_despesa = select_tipolanc_total($banco,'Despesa',$connect);
            	        $sum_mercp_outros = select_tipolanc_total_outros('Outros',$connect);
            	
            	    } elseif ($call_func_mensal == TRUE) {
            	        $sum_mercp_receita = select_tipolanc_mensal($banco,$meslanc,'Receita',$connect);
            	        $sum_mercp_despesa = select_tipolanc_mensal($banco,$meslanc,'Despesa',$connect);
            	        $sum_mercp_outros = select_tipolanc_mensal_outros($meslanc,'Outros',$connect);
            	
            	    } elseif ($call_func_anual == TRUE) {
            	        $sum_mercp_receita = select_tipolanc_anual($banco,$anolanc,'Receita',$connect);
            	        $sum_mercp_despesa = select_tipolanc_anual($banco,$anolanc,'Despesa',$connect);
            	        $sum_mercp_outros = select_tipolanc_anual_outros($anolanc,'Outros',$connect);
            	
            	    } elseif ($call_func_anual_mensal == TRUE) {
            	        $sum_mercp_receita = select_tipolanc_anual_mensal($banco,$anolanc,$meslanc,'Receita',$connect);
            	        $sum_mercp_despesa = select_tipolanc_anual_mensal($banco,$anolanc,$meslanc,'Despesa',$connect);
            	        $sum_mercp_outros = select_tipolanc_anual_mensal_outros($anolanc,$meslanc,'Outros',$connect);
            	
            	   }

    		    }

            	    $saldo_pagbank = floatval($sum_pagbank_receita) - (floatval($sum_pagbank_despesa) * floatval(-1)) - floatval($sum_pagbank_outros);
            	    $saldo_itaucc = floatval($sum_itaucc_receita) - (floatval($sum_itaucc_despesa) * floatval(-1)) - floatval($sum_itaucc_outros) ;
            	    $saldo_itaupp = floatval($sum_itaupp_receita) - (floatval($sum_itaupp_despesa) * floatval(-1)) - floatval($sum_itaupp_outros);
            	    $saldo_mercp = floatval($sum_mercp_receita) - (floatval($sum_mercp_despesa) * floatval(-1)) - floatval($sum_mercp_outros);
            	    
            	    /* RESUMO */
                    $mensagem .="<table class='table'>
                                				<tbody>
                                				<tr>
                                                            <th scope='col' class='thead-light' align='left' colspan='5'>RECEITAS </th>
                                                </tr>
                                                <tr>    
                                                            <td> PagBank </td>
                                                            <td>R$ ".number_format($sum_pagbank_receita, 2, ',', '.')."</td>
                                                </tr>
                                                <tr>    
                                                            <td> Itaú - Conta Corrente</td>
                                                            <td>R$ ".number_format($sum_itaucc_receita, 2, ',', '.')."</td>
                                                </tr>
                                                <tr>    
                                                            <td> Itaú - Conta Poupança</td>
                                                            <td>R$ ".number_format($sum_itaupp_receita, 2, ',', '.')."</td>
                                                </tr>
                                                <tr>    
                                                            <td> Mercado Pago </td>
                                                            <td>R$ ".number_format($sum_mercp_receita, 2, ',', '.')."</td>
                                                </tr>
                                                </tbody>
                                 </table>
                                 <p><i>Sócios, bazares, doações, rifas, crédito da Nota Fiscal Paulista, vendas de produtos, taxas de adoção, juros de poupança, outras receitas </i></p>
                                 <br><br>
                                 <table class='table'>
                                				<tbody>
                                                <tr>
                                                            <th scope='col' class='thead-light' align='left' colspan='5'>DESPESAS </th>
                                                </tr>
                                                <tr>    
                                                            <td> PagBank </td>
                                                            <td>R$ ".number_format($sum_pagbank_despesa, 2, ',', '.')."</td>
                                                </tr>
                                                <tr>    
                                                            <td> Itaú - Conta Corrente</td>
                                                            <td>R$ ".number_format($sum_itaucc_despesa, 2, ',', '.')."</td>
                                                </tr>
                                                <tr>    
                                                            <td> Itaú - Conta Poupança</td>
                                                            <td>R$ ".number_format($sum_itaupp_despesa, 2, ',', '.')."</td>
                                                </tr>
                                                <tr>    
                                                            <td> Mercado Pago </td>
                                                            <td>R$ ".number_format($sum_mercp_despesa, 2, ',', '.')."</td>
                                                </tr>
                                                </tbody>
                                 </table>
                                 <p><i>Lar temporário, ração, veterinários, taxi dog, medicamentos, compras, impostos, anúncios nas redes sociais (Ads redes)</i></p>
                                 <br><br>
                                 <table class='table'>
                                				<tbody>
                                                <tr>
                                                            <th scope='col' class='thead-light' align='left' colspan='5'>OUTROS </th>
                                                </tr>
                                                <tr>    
                                                            <td> PagBank </td>
                                                            <td>R$ ".number_format($sum_pagbank_outros, 2, ',', '.')."</td>
                                                </tr>
                                                <tr>    
                                                            <td> Itaú - Conta Corrente</td>
                                                            <td>R$ ".number_format($sum_itaucc_outros, 2, ',', '.')."</td>
                                                </tr>
                                                <tr>    
                                                            <td> Itaú - Conta Poupança</td>
                                                            <td>R$ ".number_format($sum_itaupp_outros, 2, ',', '.')."</td>
                                                </tr>
                                                <tr>    
                                                            <td> Mercado Pago </td>
                                                            <td>R$ ".number_format($sum_mercp_outros, 2, ',', '.')."</td>
                                                </tr>
                                                </tbody>
                                 </table>
                                 <p><i>Erros técnicos nas transações (com estornos), transferências entre contas do GAAR</i></p>
                                 <br><br>
                                 <table class='table'>
                                				<tbody>
                                                <tr>
                                                            <th scope='col' class='thead-light' align='left'>SALDO </th>
                                                </tr>
                                                <tr>    
                                                            <td> PagBank </td>
                                                            <td>R$ ".number_format($saldo_pagbank, 2, ',', '.')."</td>
                                                </tr>
                                                <tr>    
                                                            <td> Itaú - Conta Corrente</td>
                                                            <td>R$ ".number_format($saldo_itaucc, 2, ',', '.')."</td>
                                                </tr>
                                                <tr>    
                                                            <td> Itaú - Conta Poupança</td>
                                                            <td>R$ ".number_format($saldo_itaupp, 2, ',', '.')."</td>
                                                </tr>
                                                <tr>    
                                                            <td> Mercado Pago </td>
                                                            <td>R$ ".number_format($saldo_mercp, 2, ',', '.')."</td>
                                                </tr>
                                				</tbody>
                				  </table>
                                <br><br>
                                <table class='table'>
                                				<tbody>
                                                <tr>
                                                            <th scope='col' class='thead-light' align='left' colspan='5'>DOWNLOAD DAS PLANILHAS </th>
                                                </tr>";
                                                
                                $queryplanilha = "SELECT * FROM DOCUMENTACAO WHERE EVENTO = 'Planilha bancária' ORDER BY DATA DESC";
                    		    $selectplanilha = mysqli_query($connect,$queryplanilha);         
                    		    $reccountplanilha = mysqli_num_rows($selectplanilha);
    		                    
    		                    while ($fetchplanilha = mysqli_fetch_row($selectplanilha)) {
    		                            $bancodown = $fetchplanilha[4];
    		                            $datadown = $fetchplanilha[3];
    		                            $filename = $fetchplanilha[6];
    		                            
    		                            $ano_datadown = substr($datadown,0,4);
                            		    $mes_datadown = substr($datadown,5,2);
                            		    $dia_datadown = substr($datadown,8,2);
    		                            
    		                            $mensagem .="
                                                <tr>    
                                                            <td>".$bancodown."</td>
                                                            <td> Nome do arquivo: ".$filename."</td>
                                                            <td> Upload em ".$dia_datadown."/".$mes_datadown."/".$ano_datadown."</td>
                                                            <td><a href ='".$downloaddir.$filename."' target='_blank'>Download</a></td>
                                                </tr>";
                                }
                                $mensagem .="</tbody>
                				  </table>
                                <br><br>
                                
                                    <p><i>  * Esta notificação foi gerada automaticamente através do sistema e serve apenas para conhecimento e controle *</i></p>
                                    </font>
                                     <!--- BOOTSTRAP --->
                                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
                                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
                                    <!--- BOOTSTRAP --->
                                    </body>
                                  </html>";
                                  
                    echo $mensagem;  
                    echo "<center><input type='submit' name='download' value='Download' class='btn btn-primary' onClick='window.print()'>&nbsp;&nbsp;<input type='submit' name='fechar' value='Fechar' class='btn btn-primary' onClick='window.close()'></center><br>";
        	} else {
        		    echo "<br> Nenhum lançamento encontrado<br><br>";
        		    echo "<a href='formextrato.php' class='btn btn-primary' >Nova pesquisa</a>";
        		}
    }
}
?>


