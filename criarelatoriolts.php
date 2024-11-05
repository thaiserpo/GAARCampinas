<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

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
    
    <title>GAAR - Relatório financeiro</title>
    
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">
        <div class="d-none d-print-block">
            <center><img src="/area/logo_transparent.png" width="70" height="70"></center>
        </div>
<?

        $mes_ant = date('m',strtotime('-1 months'));
        
        /* DATA ATUAL */ 
        
        $ano_atu = date("Y");
		$mes_atu = date("m");
		$mes_ant = date('m',strtotime('-1 months'));
		$mes_ant_2 = date('m',strtotime('-2 months'));
		$dia_atu = date("d");
		
		/* TESTE */
		$mes_atu = '04';
		$mes_ant = '03';
		$mes_ant_2 = '02';
		$dia_atu = '01';
		/* TESTE */
		
		$dtatu = date("Y-m-d");
		
		$dtatu_format = date("d-m-Y");
		
		$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);
		
		/* DATA ATUAL */ 

        echo "
        
        <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center><br>
        <center>
                   <br>
                    <h3>RELATÓRIO DE PAGAMENTO DE LARES TEMPORÁRIOS</h3><br>
                    <h5>ANO ".$ano_atu."</h5>
               </center>
               <br>";
        
        echo"<center><h5>VALORES A PAGAR</h5><br><p> Os valores abaixo correspondem as mensalidades dos lares temporários entre os meses ".$mes_ant_2." a ".$mes_ant."</p></center>";
        echo "<table class='table'>";
        echo "<thead class='thead-light'>";
    	echo "<th scope='col'>Lar temporário</th>";
    	echo "<th scope='col'>Quantidade de animais</th>";
    	echo "<th scope='col'>Valor total</th>";
    	echo "<th scope='col'>Ração consumida (em kg)</th>";
    	echo "</thead>";
    	echo "<tbody>";
    	                
    	$queryhist_pag_lt = "SELECT * FROM HISTORICO_PAG_LT WHERE MES_VIGENTE = '$mes_atu' AND ANO_VIGENTE = '$ano_atu' ORDER BY LAR_TEMPORARIO ASC";
	    $resulthist_pag_lt = mysqli_query($connect,$queryhist_pag_lt);
	    
	    $qtdpets = 1;
	    $qtd_racao = 0;
	    $acum_racao = 0;
	    
	    while ($fetchhist_pag_lt = mysqli_fetch_row($resulthist_pag_lt)) {
	        
            $id = $fetchhist_pag_lt[0];
			$lt = $fetchhist_pag_lt[2];
			$valorpag = $fetchhist_pag_lt[5];
			$nomedoanimal = $fetchhist_pag_lt[1];
			$lt = $fetchhist_pag_lt[2];
			$resp = $fetchhist_pag_lt[3];
			$qtddias = $fetchhist_pag_lt[9];
			
			$querypeso = "SELECT PESO FROM ANIMAL WHERE NOME_ANIMAL = '$nomedoanimal' AND LAR_TEMPORARIO = '$lt' AND RESPONSAVEL = '$resp'";
	        $resultpeso = mysqli_query($connect,$querypeso);

	        while ($fetchpeso = mysqli_fetch_row($resultpeso)) {
	             $peso = $fetchpeso[0];
	        }
	        
        	/*echo "<br> *************";
	        echo "<br> lt ant      : ".$lt_ant;
	        echo "<br> lt          : ".$lt;
	        echo "<br> qtde pets   : ".$qtdpets;
	        echo "<br> acum racao  : ".$acum_racao;
	        echo "<br> nome do pet :  ".$nomedoanimal;
	        echo "<br> peso        :  ".$peso;*/

    	  	if ($lt_ant == $lt) {
    	  	    
			    $acum_total = floatval($valorpag) + floatval($acum_total);
			    $qtdpets = $qtdpets + 1;

			    switch ($peso) {
    			    case '5':       
    			    case '6':       
    			    case '7':
    			    case '8':
    			    case '9':
    			    case '10':
    			    case '11':
    			        $qtd_racao = 196 * intval($qtddias);
    			        $acum_racao = intval($acum_racao) + intval($qtd_racao);
    			        break;
    			    case '12':
    		        case '13':
    			        $qtd_racao = 209 * intval($qtddias);
    			        $acum_racao = intval($acum_racao) + intval($qtd_racao);
    			        break;
    			    case '14':
    			        $qtd_racao = 235 * intval($qtddias);
    			        $acum_racao = intval($acum_racao) + intval($qtd_racao);
    			        break;
    			    case '15':
    			    case '16':
    			        $qtd_racao = 259 * intval($qtddias);
    			        $acum_racao = intval($acum_racao) + intval($qtd_racao);
    			        break;
    			    case '17':
    			    case '18':
    			        $qtd_racao = 283 * intval($qtddias);
    			        $acum_racao = intval($acum_racao) + intval($qtd_racao);
    			        break;
    			    case '19':
    			    case '20':
    			        $qtd_racao = 307 * intval($qtddias);
    			        $acum_racao = intval($acum_racao) + intval($qtd_racao);
    			        break;
    			    case '21':
    			    case '22':
    			        $qtd_racao = 329 * intval($qtddias);
    			        $acum_racao = intval($acum_racao) + intval($qtd_racao);
    			        break;
    			    case '23':
    			    case '24':
    			        $qtd_racao = 352 * intval($qtddias);
    			        $acum_racao = intval($acum_racao) + intval($qtd_racao);
    			        break;
    			    case '25':
    			        $qtd_racao = 363 * intval($qtddias);
    			        $acum_racao = intval($acum_racao) + intval($qtd_racao);
    			        break;
			    }

			} else {
			    echo "<tr>";
        		echo "<td>".$lt."</td>";
        		echo "<td>".$qtdpets."</td>";
        		echo "<td>R$ ".number_format($acum_total,2,',', '.')."</td>";
        		echo "<td>".number_format($acum_racao,0,',', ',')."</td>";
        		echo "</tr>";
        		
                $lt_ant = $lt;
			    $qtdpets = 1;
	            $qtd_racao = 0;
	            $acum_racao = 0;
			}
            
		    }
		
		echo "<tr>";
		echo "<td>".$lt."</td>";
		echo "<td>".$qtdpets."</td>";
		echo "<td>R$ ".number_format($acum_total,2,',', '.')."</td>";
		echo "<td>".number_format($acum_racao,0,',', ',')."</td>";
		echo "</tr>";
		echo "</tbody>";
		echo "</table><br>";
		
		mysqli_data_seek($resulthist_pag_lt, 0);
		
		mysqli_data_seek($resultpeso, 0);
		
		echo "<center>
                   <br>
                    <h4>LANÇAMENTOS DETALHADOS</h4>
                    <br>
                    <p> Os animais abaixo constam como disponíveis em nosso sistema. Caso algum deles foi adotado, por favor cadastre o termo de adoção <a href='formprecadastrotermo.php'> aqui</a>.
               </center>";
               
		echo "<table class='table'>";
        echo "<thead class='thead-light'>";
    	echo "<th scope='col'>Animal</th>";
    	echo "<th scope='col'>Total de dias</th>";
    	echo "<th scope='col'>Valor diário</th>";
    	echo "<th scope='col'>Valor mensal</th>";
    	echo "<th scope='col' colspan='4'>Período</th>";
    	echo "<th scope='col'>Lar temporário</th>";
    	echo "<th scope='col'>Responsável</th>";
    	echo "<th scope='col'>Status</th>";
    	echo "<th scope='col'>Peso (em kg)</th>";
    	echo "<th scope='col'>Ração consumida (em kg)</th>";
    	echo "</thead>";
    	echo "<tbody>";

        while ($fetchhist_pag_lt = mysqli_fetch_row($resulthist_pag_lt)) {
            $id = $fetchhist_pag_lt[0];
			$nomedoanimal = $fetchhist_pag_lt[1];
			$lt = $fetchhist_pag_lt[2];
			$resp = $fetchhist_pag_lt[3];
			$status = $fetchhist_pag_lt[12];
			$valordia = $fetchhist_pag_lt[4];
			$valorpag = $fetchhist_pag_lt[5];
			$dtpag = $fetchhist_pag_lt[6];
			$periodo_ini = $fetchhist_pag_lt[7];
			$periodo_fin = $fetchhist_pag_lt[8];
			$qtddias = $fetchhist_pag_lt[9];
			$mesvigente = $fetchhist_pag_lt[10];
			$anovigente = $fetchhist_pag_lt[11];
			
			$ano_ini = substr($periodo_ini,0,4);
            $mes_ini = substr($periodo_ini,5,2);
        	$dia_ini = substr($periodo_ini,8,2);
        	
        	$ano_fin = substr($periodo_fin,0,4);
            $mes_fin = substr($periodo_fin,5,2);
        	$dia_fin = substr($periodo_fin,8,2);
        	
        	$periodo_ini = $dia_ini ."-".$mes_ini;
        	
        	$periodo_fin = $dia_fin ."-".$mes_fin;
        	
        	$querypeso = "SELECT PESO FROM ANIMAL WHERE NOME_ANIMAL = '$nomedoanimal' AND LAR_TEMPORARIO = '$lt' AND RESPONSAVEL = '$resp'";
	        $resultpeso = mysqli_query($connect,$querypeso);

	        while ($fetchpeso = mysqli_fetch_row($resultpeso)) {
	             $peso = $fetchpeso[0];
			
    			switch ($peso) {
    			    case '0':
    			        $qtd_racao = 0;
    			        break;
    			    case '5':       
    			    case '6':       
    			    case '7':
    			    case '8':
    			    case '9':
    			    case '10':
    			    case '11':
    			        $qtd_racao = 196 * intval($qtddias);
    			        break;
    			    case '12':
    		        case '13':
    			        $qtd_racao = 209 * intval($qtddias);
    			        break;
    			    case '14':
    			        $qtd_racao = 235 * intval($qtddias);
    			        break;
    			    case '15':
    			    case '16':
    			        $qtd_racao = 259 * intval($qtddias);
    			        break;
    			    case '17':
    			    case '18':
    			        $qtd_racao = 283 * intval($qtddias);
    			        break;
    			    case '19':
    			    case '20':
    			        $qtd_racao = 307 * intval($qtddias);
    			        break;
    			    case '21':
    			    case '22':
    			        $qtd_racao = 329 * intval($qtddias);
    			        break;
    			    case '23':
    			    case '24':
    			        $qtd_racao = 352 * intval($qtddias);
    			        break;
    			    case '25':
    			        $qtd_racao = 363 * intval($qtddias);
    			        break;
    			}
	        }
			
			/*if ($periodo_fin = '0001-01-01') {
			    $periodo_fin = $dia_atu ."-".$mes_ant;
			}*/
    			echo "<tr>";
    			echo "<td>".$nomedoanimal."</td>";
				echo "<td>".$qtddias."</td>";
				echo "<td>R$ ".number_format($valordia,2,',', '.')."</td>";
				echo "<td>R$ ".number_format($valorpag,2,',', '.')."</td>";
				echo "<td colspan='4'>".$periodo_ini." a ".$periodo_fin."</td>";
				echo "<td>".$lt."</td>";
				echo "<td>".$resp."</td>";
				echo "<td>".$status."</td>";
				echo "<td>".$peso."</td>";
				echo "<td>".number_format($qtd_racao,0,',', ',')."</td>";
			    echo "</tr>";
			    
			    
			    $valorpag_ant = $valorpag ;
		}   
		        echo "</tbody>";
		        echo "</table><br>";
		        /*echo "<img src='https://www.geracaopet.com.br/media/catalog/product/cache/207e23213cf636ccdef205098cf3c8a3/q/u/quantidade-medium10__1.jpg'>";*/
		        
		mysqli_close($connect);
		
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
