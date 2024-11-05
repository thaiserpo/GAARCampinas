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
    
    <title>GAAR Campinas - Prestação de contas</title>
    
    <script type="text/javascript">
	
        function OnShowDiv2019 (radio) {
                    document.getElementById('2019').className  = "d-block";
                    document.getElementById('2020').className  = "d-none";
        }
        
        function OnShowDiv2020 (radio) {
                    document.getElementById('2020').className  = "d-block";
                    document.getElementById('2019').className  = "d-none";
        }
        
        function OnShowDiv2021 (radio) {
                    document.getElementById('2021').className  = "d-block";
                    document.getElementById('2020').className  = "d-none";
                    document.getElementById('2019').className  = "d-none";
        }
    </script>
    
</head>
<body> 
<?
 include_once ("/wp-content/themes/pet-business/header.php");
?>

<main role="main" class="container">
    <div class="starter-template">
            <center><img src="logo pequeno.png" width="70" height="70"><br>
            		   <h3>PRESTAÇÃO DE CONTAS</h3><br></center>
            
            <p>O GAAR – Grupo de Apoio ao Animal de Rua – luta a anos contra o abandono e maus-tratos de cães e gatos de Campinas e região, em um trabalho contínuo de castração, cuidados básicos e busca de lares para eles, além de difundir a conscientização para guarda responsável e bem estar animal. <br><br>
Os recursos para assistir animais resgatados do abandono, de maus tratos ou pertencentes a famílias carentes são fruto do resultado de bazares, rifas, lojinha virtual, eventos beneficentes, crédito semestral da Nota Fiscal Paulista e doações mensais ou esporádicas.<br><br>
Oos valores apresentados são os lançamentos de todas as fontes de despesas do dia 01 até o último dia do mês coletados pelo sistema diretamente do banco de dados do GAAR. <br><br>
Não há valor mínimo para contribuir e as doações podem ser mensais ou esporádicas. O GAAR não recebe nenhuma verba pública ou privada, contamos somente com a solidariedade de pessoas conscientizadas.<br><br>

Todos os que se propõem a nos ajudar financeiramente fortalecem o nosso trabalho, afinal, somente com maior apoio o GAAR conseguirá ampliar o número de animais castrados e resgatados, reduzindo efetivamente a fila de vítimas da crueldade, da fome e de todo tipo de sofrimento inerente à situação de abandono, sem contar que nosso trabalho traz reflexos positivos para a saúde pública.<br><br>

Por isso fazemos aqui este apelo para que você se junte a nós e nos ajude nas despesas veterinárias e de cuidados básicos, para podermos resgatar, tratar, castrar e proteger mais animais, até que sejam doados para pessoas responsáveis.<br><br></p>
<?

		/*** RECEITAS **/
		
		function lancamentos_socios_ano($ano,$connect){
				$query = "SELECT TIPO_LANC FROM FINANCEIRO WHERE TIPO_LANC = 'Sócio' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$qtde = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $qtde = $qtde + 1;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_socios($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Sócio' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
	
		function lancamentos_mensal_anual_socios($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Sócio' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_socios($mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Sócio' AND DATA_LANC LIKE '%-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_bazar($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Bazar' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_bazar($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Bazar' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_bazar($mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Bazar' AND DATA_LANC LIKE '%-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_doacoes($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Doações' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_doacoes($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Doações' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_doacoes($mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Doações' AND DATA_LANC LIKE '%-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_rifas($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Rifas' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_rifas($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Rifas' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_rifas($mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Rifas' AND DATA_LANC LIKE '%-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_nfp($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'NFP' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_nfp($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'NFP' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_vendas($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Vendas' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_vendas($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Vendas' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_taxasadocao($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Taxas' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_taxasadocao($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Taxas' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_juros($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Juros' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_juros($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Juros' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_outrosrec($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Outras receitas' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_outrosrec($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Outras receitas' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
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
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Lar temporário' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_lt($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Lar temporário' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_racao($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Ração' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_racao($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Ração' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_vet($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Veterinário' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_vet($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Veterinário' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_taxidog($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Taxi dog' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_taxidog($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Taxi dog' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_medicam($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Medicamentos' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_medicam($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Medicamentos' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_compras($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Compras' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_compras($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Compras' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_imposto($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Impostos' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_imposto($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Impostos' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_anual_outrosdes($ano,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Outras despesas' AND DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
		
		function lancamentos_mensal_anual_outrosdes($ano,$mes,$connect){
				$query = "SELECT VALOR_REL_CONTABIL FROM FINANCEIRO WHERE TIPO_LANC = 'Outras despesas' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
				$result = mysqli_query($connect,$query);
				
				$sum = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valor = $fetch[0];
				    $sum = $sum + $valor;
				}
					
				return($sum);
		}
?>
<center><a href="javascript:OnShowDiv2019 (this)" class="btn btn-primary">2019</a> &nbsp; <a href="javascript:OnShowDiv2020 (this)" class="btn btn-primary">2020</a>&nbsp; <a href="javascript:OnShowDiv2021 (this)" class="btn btn-primary">2021</a></center>
<br>

<div id="2021" class="form-row d-none">
<?
		    $sum21 = 0;
	
	        for ($i2021 = 1; $i2021 <= 12; $i2021++){
	            
	            $ano = '2021';
	           
	            $sumlt = 0;
	            $sumvet = 0;
	            $sumtaxi = 0;
	            $summed = 0;
	            $sumcompras = 0;
	            $sumimp = 0;
	            $sumoutrosdesp = 0;
	            
	            switch ($i2021){
	                case 1:
    	                $mes = '01';
    	                $titulo = 'Janeiro';
    	                break;
    	            case 2:
    	                $mes = '02';
    	                $titulo = 'Fevereiro';
    	                break;
    	            case 3:
    	                $mes = '03';
    	                $titulo = 'Março';
    	                break;
    	            case 4:
    	                $mes = '04';
    	                $titulo = 'Abril';
    	                break;
    	            case 5:
    	                $mes = '05';
    	                $titulo = 'Maio';
    	                break;
    	            case 6:
    	                $mes = '06';
    	                $titulo = 'Junho';
    	                break;
    	            case 7:
    	                $mes = '07';
    	                $titulo = 'Julho';
    	                break;
    	            case 8:
    	                $mes = '08';
    	                $titulo = 'Agosto';
    	                break;
    	            case 9:
    	                $mes = '09';
    	                $titulo = 'Setembro';
    	                break;
    	            case 10:
    	                $mes = '10';
    	                $titulo = 'Outubro';
    	                break;
    	            case 11:
    	                $mes = '11';
    	                $titulo = 'Novembro';
    	                break;
    	            case 12:
    	                $mes = '12';
    	                $titulo = 'Dezembro';
    	                break;
	            }
        	    
        	    $querylanc_ano = "SELECT * FROM FINANCEIRO WHERE TIPO_LANC ='Despesa' AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
    		    $resultlanc_ano = mysqli_query($connect,$querylanc_ano);
    		    $reccount = mysqli_num_rows($resultlanc_ano);

    		    if ($reccount != '0'){
	                    
	               echo "<div>";
        	            echo "<h5>".$titulo."</h5><br>";
        	            echo "<table class='table'>";
                        echo "<thead class='thead-light'>";
                    	echo "<th scope='col'>Data</th>";
                    	echo "<th scope='col'>Descrição</th>";
                    	echo "<th scope='col'>Tipo</th>";
                    	echo "<th scope='col'>Valor</th>";
                    	echo "<th scope='col' colspan='2' align='center'>&nbsp</th>";
                    	echo "</thead>";
                    	echo "<tbody>";
            		    
            	        while ($fetchlanc_ano = mysqli_fetch_row($resultlanc_ano)) {
            				$dtlanc = $fetchlanc_ano[1];
            				$desclanc = $fetchlanc_ano[2];
            				$tipolanc = $fetchlanc_ano[3];
            				$valorlanc = $fetchlanc_ano[4];
            				$sum20 = floatval($sum21) + floatval($valorlanc);
            				
            				switch ($tipolanc) {
            				  case 'Lar temporário':
            				  	$sumlt = $sumlt + floatval($valorlanc);
            					break;
            				  case 'Veterinário':
            				  	$sumvet = $sumvet + floatval($valorlanc);
            					break;
            				  case 'Taxi dog':
            				  	$sumtaxi = $sumtaxi + floatval($valorlanc);
            					break;
                 			  case 'Medicamentos':
            				  	$summed = $summed + floatval($valorlanc);
            					break;
            				  case 'Compras':
            				  	$sumcompras = $sumcompras + floatval($valorlanc);
            					break;
            				  case 'Impostos':
            				  	$sumimp = $sumimp + floatval($valorlanc);
            					break;
            				  case 'Outras despesas':
            				  	$sumoutrosdesp = $sumoutrosdesp + floatval($valorlanc);
            					break;
            				  
            			  }
        	        
        	                echo "<tr>";
                			echo "<td>".$dtlanc."</td>";
        					echo "<td>".$desclanc."</td>";
        					echo "<td>".$tipolanc."</td>";
        					echo "<td><p class='text-danger'>R$ ".number_format($valorlanc,2,',', '.')."</p></td>";
        					echo "<td>&nbsp;</td>";
        				    echo "</tr>";
        			    }   
        			        echo "</tbody>";
        			        echo "</table><br>";
        			        
        			        echo"<h5>Total de gastos em ".$titulo."</h5><br>
        			             <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Pagamento de lares temporários (LT): </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumlt,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                      <label>Gastos veterinários (castrações, cirurgias, etc): </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumvet,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Táxi dog: </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumtaxi,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Medicamentos (vacinas, vermífugos, antipulgas, antibióticos, anti-inflamatórios,etc): </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($summed,2,',', '.')."</label>
                                    </div>
                                 </div>
        			             <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Compras (areia para gatos, caixinhas de areia, guias, comedouros, casinhas, etc): </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumcompras,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Impostos bancários: </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumimp,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Outras despesas: </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumoutrosdesp,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-12'>
                                    <label>_________________________________________________________________________</label>
                                 </div>
                        </div>
                                 ";
        			             
        		
        	        }
	        }
	        
	        
				$querylanc_receita = "SELECT * FROM FINANCEIRO WHERE (TIPO_LANC ='Sócio' or TIPO_LANC ='Bazar' or TIPO_LANC ='Doações' or TIPO_LANC ='Rifas' or TIPO_LANC ='NFP' or TIPO_LANC ='Vendas' or TIPO_LANC ='Taxas' or TIPO_LANC ='Juros' or TIPO_LANC ='Outras receitas') and DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
    		    $resultlanc_receita = mysqli_query($connect,$querylanc_receita);
    
    	        
    			$querylanc_despesa = "SELECT * FROM FINANCEIRO WHERE (TIPO_LANC ='LT' or TIPO_LANC ='Veterinário' or TIPO_LANC ='Taxi dog' or TIPO_LANC ='Medicamentos' or TIPO_LANC ='Compras' or TIPO_LANC ='Impostos' or TIPO_LANC ='Outras despesas') DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
    		    $resultlanc_despesa = mysqli_query($connect,$querylanc_despesa);
    
    	   
        			
		    
		  echo"<center><h5>TOTAL EM 2020</h5></center>
	                <div class='form-group row'>
                          <label class='col-sm-2 col-form-label'><strong>Despesas: </strong></label> 
                          <div class='col-sm-10'>
                            <label class='col-sm-10 col-form-label text-danger'>R$ ".number_format($sum20,2,',', '.')."</label> 
                          </div>
                    </div>";
?>
</div>
<div id="2020" class="form-row d-none">
<?
		    $sum20 = 0;
	
	        for ($i2020 = 1; $i2020 <= 12; $i2020++){
	            
	            $ano = '2020';
	           
	            $sumlt = 0;
	            $sumvet = 0;
	            $sumtaxi = 0;
	            $summed = 0;
	            $sumcompras = 0;
	            $sumimp = 0;
	            $sumoutrosdesp = 0;
	            
	            switch ($i2020){
	                case 1:
    	                $mes = '01';
    	                $titulo = 'Janeiro';
    	                break;
    	            case 2:
    	                $mes = '02';
    	                $titulo = 'Fevereiro';
    	                break;
    	            case 3:
    	                $mes = '03';
    	                $titulo = 'Março';
    	                break;
    	            case 4:
    	                $mes = '04';
    	                $titulo = 'Abril';
    	                break;
    	            case 5:
    	                $mes = '05';
    	                $titulo = 'Maio';
    	                break;
    	            case 6:
    	                $mes = '06';
    	                $titulo = 'Junho';
    	                break;
    	            case 7:
    	                $mes = '07';
    	                $titulo = 'Julho';
    	                break;
    	            case 8:
    	                $mes = '08';
    	                $titulo = 'Agosto';
    	                break;
    	            case 9:
    	                $mes = '09';
    	                $titulo = 'Setembro';
    	                break;
    	            case 10:
    	                $mes = '10';
    	                $titulo = 'Outubro';
    	                break;
    	            case 11:
    	                $mes = '11';
    	                $titulo = 'Novembro';
    	                break;
    	            case 12:
    	                $mes = '12';
    	                $titulo = 'Dezembro';
    	                break;
	            }
        	    
        	    $querylanc_ano = "SELECT * FROM FINANCEIRO WHERE (TIPO_LANC ='LT' or TIPO_LANC ='Veterinário' or TIPO_LANC ='Taxi dog' or TIPO_LANC ='Medicamentos' or TIPO_LANC ='Compras' or TIPO_LANC ='Impostos' or TIPO_LANC ='Outras despesas') AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
    		    $resultlanc_ano = mysqli_query($connect,$querylanc_ano);
    		    $reccount = mysqli_num_rows($resultlanc_ano);

    		    if ($reccount != '0'){
	                    
	               echo "<div>";
        	            echo "<h5>".$titulo."</h5><br>";
        	            echo "<table class='table'>";
                        echo "<thead class='thead-light'>";
                    	echo "<th scope='col'>Data</th>";
                    	/*echo "<th scope='col'>Descrição</th>";*/
                    	echo "<th scope='col'>Tipo</th>";
                    	echo "<th scope='col'>Valor</th>";
                    	echo "<th scope='col' colspan='2' align='center'>&nbsp</th>";
                    	echo "</thead>";
                    	echo "<tbody>";
            		    
            	        while ($fetchlanc_ano = mysqli_fetch_row($resultlanc_ano)) {
            				$dtlanc = $fetchlanc_ano[1];
            				$desclanc = $fetchlanc_ano[2];
            				$tipolanc = $fetchlanc_ano[3];
            				$valorlanc = $fetchlanc_ano[4];
            				$sum20 = floatval($sum20) + floatval($valorlanc);
            				
            				switch ($tipolanc) {
            				  case 'LT':
            				  	$sumlt = $sumlt + floatval($valorlanc);
            					break;
            				  case 'Veterinário':
            				  	$sumvet = $sumvet + floatval($valorlanc);
            					break;
            				  case 'Taxi dog':
            				  	$sumtaxi = $sumtaxi + floatval($valorlanc);
            					break;
                 			  case 'Medicamentos':
            				  	$summed = $summed + floatval($valorlanc);
            					break;
            				  case 'Compras':
            				  	$sumcompras = $sumcompras + floatval($valorlanc);
            					break;
            				  case 'Impostos':
            				  	$sumimp = $sumimp + floatval($valorlanc);
            					break;
            				  case 'Outras despesas':
            				  	$sumoutrosdesp = $sumoutrosdesp + floatval($valorlanc);
            					break;
            				  
            			  }
        	        
        	                echo "<tr>";
                			echo "<td>".$dtlanc."</td>";
        					/*echo "<td>".$desclanc."</td>";*/
        					echo "<td>".$tipolanc."</td>";
        					echo "<td><p class='text-danger'>R$ ".number_format($valorlanc,2,',', '.')."</p></td>";
        					echo "<td>&nbsp;</td>";
        				    echo "</tr>";
        			    }   
        			        echo "</tbody>";
        			        echo "</table><br>";
        			        
        			        echo"<h5>Total de gastos em ".$titulo."</h5><br>
        			             <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Pagamento de lares temporários (LT): </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumlt,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                      <label>Gastos veterinários (castrações, cirurgias, etc): </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumvet,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Táxi dog: </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumtaxi,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Medicamentos (vacinas, vermífugos, antipulgas, antibióticos, anti-inflamatórios,etc): </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($summed,2,',', '.')."</label>
                                    </div>
                                 </div>
        			             <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Compras (areia para gatos, caixinhas de areia, guias, comedouros, casinhas, etc): </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumcompras,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Impostos bancários: </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumimp,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Outras despesas: </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumoutrosdesp,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-12'>
                                    <label>_________________________________________________________________________</label>
                                 </div>
                        </div>
                                 ";
        			             
        		
        	        }
	        }
	        
	        
				$querylanc_receita = "SELECT * FROM FINANCEIRO WHERE (TIPO_LANC ='Sócio' or TIPO_LANC ='Bazar' or TIPO_LANC ='Doações' or TIPO_LANC ='Rifas' or TIPO_LANC ='NFP' or TIPO_LANC ='Vendas' or TIPO_LANC ='Taxas' or TIPO_LANC ='Juros' or TIPO_LANC ='Outras receitas') and DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
    		    $resultlanc_receita = mysqli_query($connect,$querylanc_receita);
    
    	        
    			$querylanc_despesa = "SELECT * FROM FINANCEIRO WHERE (TIPO_LANC ='LT' or TIPO_LANC ='Veterinário' or TIPO_LANC ='Taxi dog' or TIPO_LANC ='Medicamentos' or TIPO_LANC ='Compras' or TIPO_LANC ='Impostos' or TIPO_LANC ='Outras despesas') DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
    		    $resultlanc_despesa = mysqli_query($connect,$querylanc_despesa);
    
    	   
        			
		    
		  echo"<center><h5>TOTAL EM 2020</h5></center>
	                <div class='form-group row'>
                          <label class='col-sm-2 col-form-label'><strong>Despesas: </strong></label> 
                          <div class='col-sm-10'>
                            <label class='col-sm-10 col-form-label text-danger'>R$ ".number_format($sum20,2,',', '.')."</label> 
                          </div>
                    </div>";
?>
</div>
<div id="2019" class="form-row d-none">
<?
		    $sum19 = 0;
	
	        for ($i2019 = 1; $i2019 <= 12; $i2019++){
	            
	            $ano = '2019';
	           
	            $sumlt = 0;
	            $sumvet = 0;
	            $sumtaxi = 0;
	            $summed = 0;
	            $sumcompras = 0;
	            $sumimp = 0;
	            $sumoutrosdesp = 0;
	            
	            switch ($i2019){
	                case 1:
    	                $mes = '01';
    	                $titulo = 'Janeiro';
    	                break;
    	            case 2:
    	                $mes = '02';
    	                $titulo = 'Fevereiro';
    	                break;
    	            case 3:
    	                $mes = '03';
    	                $titulo = 'Março';
    	                break;
    	            case 4:
    	                $mes = '04';
    	                $titulo = 'Abril';
    	                break;
    	            case 5:
    	                $mes = '05';
    	                $titulo = 'Maio';
    	                break;
    	            case 6:
    	                $mes = '06';
    	                $titulo = 'Junho';
    	                break;
    	            case 7:
    	                $mes = '07';
    	                $titulo = 'Julho';
    	                break;
    	            case 8:
    	                $mes = '08';
    	                $titulo = 'Agosto';
    	                break;
    	            case 9:
    	                $mes = '09';
    	                $titulo = 'Setembro';
    	                break;
    	            case 10:
    	                $mes = '10';
    	                $titulo = 'Outubro';
    	                break;
    	            case 11:
    	                $mes = '11';
    	                $titulo = 'Novembro';
    	                break;
    	            case 12:
    	                $mes = '12';
    	                $titulo = 'Dezembro';
    	                break;
	            }
        	    
        	    $querylanc_ano = "SELECT * FROM FINANCEIRO WHERE (TIPO_LANC ='LT' or TIPO_LANC ='Veterinário' or TIPO_LANC ='Taxi dog' or TIPO_LANC ='Medicamentos' or TIPO_LANC ='Compras' or TIPO_LANC ='Impostos' or TIPO_LANC ='Outras despesas') AND DATA_LANC LIKE '".$ano."-".$mes."-%' ORDER BY DATA_LANC DESC";
    		    $resultlanc_ano = mysqli_query($connect,$querylanc_ano);
    		    $reccount = mysqli_num_rows($resultlanc_ano);

    		    if ($reccount != '0'){
	                    
	               echo "<div>";
        	            echo "<h5>".$titulo."</h5><br>";
        	            echo "<table class='table'>";
                        echo "<thead class='thead-light'>";
                    	echo "<th scope='col'>Data</th>";
                    	/*echo "<th scope='col'>Descrição</th>";*/
                    	echo "<th scope='col'>Tipo</th>";
                    	echo "<th scope='col'>Valor</th>";
                    	echo "<th scope='col' colspan='2' align='center'>&nbsp</th>";
                    	echo "</thead>";
                    	echo "<tbody>";
            		    
            	        while ($fetchlanc_ano = mysqli_fetch_row($resultlanc_ano)) {
            				$dtlanc = $fetchlanc_ano[1];
            				$desclanc = $fetchlanc_ano[2];
            				$tipolanc = $fetchlanc_ano[3];
            				$valorlanc = $fetchlanc_ano[4];
            				$sum19 = floatval($sum19) + floatval($valorlanc);
            				
            				switch ($tipolanc) {
            				  case 'LT':
            				  	$sumlt = $sumlt + floatval($valorlanc);
            					break;
            				  case 'Veterinário':
            				  	$sumvet = $sumvet + floatval($valorlanc);
            					break;
            				  case 'Taxi dog':
            				  	$sumtaxi = $sumtaxi + floatval($valorlanc);
            					break;
                 			  case 'Medicamentos':
            				  	$summed = $summed + floatval($valorlanc);
            					break;
            				  case 'Compras':
            				  	$sumcompras = $sumcompras + floatval($valorlanc);
            					break;
            				  case 'Impostos':
            				  	$sumimp = $sumimp + floatval($valorlanc);
            					break;
            				  case 'Outras despesas':
            				  	$sumoutrosdesp = $sumoutrosdesp + floatval($valorlanc);
            					break;
            				  
            			  }
        	        
        	                echo "<tr>";
                			echo "<td>".$dtlanc."</td>";
        					/*echo "<td>".$desclanc."</td>";*/
        					echo "<td>".$tipolanc."</td>";
        					echo "<td><p class='text-danger'>R$ ".number_format($valorlanc,2,',', '.')."</p></td>";
        					echo "<td>&nbsp;</td>";
        				    echo "</tr>";
        			    }   
        			        echo "</tbody>";
        			        echo "</table><br>";
        			        
        			        echo"<h5>Total de gastos em ".$titulo."</h5><br>
        			             <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Pagamento de lares temporários (LT): </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumlt,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                      <label>Gastos veterinários (castrações, cirurgias, etc): </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumvet,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Táxi dog: </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumtaxi,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Medicamentos (vacinas, vermífugos, antipulgas, antibióticos, anti-inflamatórios,etc): </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($summed,2,',', '.')."</label>
                                    </div>
                                 </div>
        			             <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Compras (areia para gatos, caixinhas de areia, guias, comedouros, casinhas, etc): </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumcompras,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Impostos bancários: </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumimp,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-5'>
                                          <label>Outras despesas: </label>
                                    </div>
                                    <div class='form-group col-md-5'>
                                          <label>R$ ".number_format($sumoutrosdesp,2,',', '.')."</label>
                                    </div>
                                 </div>
                                 <div class='form-row'>
                                    <div class='form-group col-md-12'>
                                    <label>_________________________________________________________________________</label>
                                 </div>
                        </div>
                                 ";
        			             
        		
        	        }
	        }
	        
	        
				$querylanc_receita = "SELECT * FROM FINANCEIRO WHERE (TIPO_LANC ='Sócio' or TIPO_LANC ='Bazar' or TIPO_LANC ='Doações' or TIPO_LANC ='Rifas' or TIPO_LANC ='NFP' or TIPO_LANC ='Vendas' or TIPO_LANC ='Taxas' or TIPO_LANC ='Juros' or TIPO_LANC ='Outras receitas') and DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
    		    $resultlanc_receita = mysqli_query($connect,$querylanc_receita);
    
    	        
    			$querylanc_despesa = "SELECT * FROM FINANCEIRO WHERE (TIPO_LANC ='LT' or TIPO_LANC ='Veterinário' or TIPO_LANC ='Taxi dog' or TIPO_LANC ='Medicamentos' or TIPO_LANC ='Compras' or TIPO_LANC ='Impostos' or TIPO_LANC ='Outras despesas') DATA_LANC LIKE '".$ano."-%' ORDER BY DATA_LANC DESC";
    		    $resultlanc_despesa = mysqli_query($connect,$querylanc_despesa);
    
    	   
        			
		    
		  echo"<center><h5>TOTAL EM 2019</h5></center>
	                <div class='form-group row'>
                          <label class='col-sm-2 col-form-label'><strong>Despesas: </strong></label> 
                          <div class='col-sm-10'>
                            <label class='col-sm-10 col-form-label text-danger'>R$ ".number_format($sum19,2,',', '.')."</label> 
                          </div>
                    </div>";
?>
</div>
<?
	    
		mysqli_close($connect);
		
?>
    <div class="d-print-none">
        <center><p><strong>OBSERVAÇÕES</strong><br>
            <i>O valor total é a somatória dos lançamentos de todas as fontes de despesas do dia 01 até o último dia do mês coletados pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail financeiro@gaarcampinas.org</i></center>
    </div>
    <br>
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