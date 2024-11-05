<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
} else {
	
		  $queryarea = "SELECT AREA,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		  $selectarea = mysqli_query($connect,$queryarea);
		
		  while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$emailvoluntario = $fetcharea[1];
		  }
		  
		$tiporelatorio = $_POST['tiporelatorio'];
		$anodre = $_POST['anodre'];
		$mesdre = $_POST['mesdre'];
	
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
    
    <title>GAAR - Relatórios</title>
    
    <script type="text/javascript">
        window.onload = function() {
          document.getElementById('text-print-relatorio').style.display = 'none';
        };
    </script>
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
			  
		
?>
<main role="main" class="container">
    <div class="starter-template">
        <div class="d-none d-print-block">
            <center><img src="/area/logo_transparent.png" width="70" height="70"></center>
        </div>
<?

    switch ($mesdre) {
        		        case '01': 
        		            $mesdesc = 'Janeiro';
        		            break;
        		        case '02': 
        		            $mesdesc = 'Fevereiro';
        		            break;
        		        case '03': 
        		            $mesdesc = 'Março';
        		            break;
        		        case '04': 
        		            $mesdesc = 'Abril';
        		            break;
        		        case '05': 
        		            $mesdesc = 'Maio';
        		            break;
        		        case '06': 
        		            $mesdesc = 'Junho';
        		            break;
        		        case '07': 
        		            $mesdesc = 'Julho';
        		            break;
        		        case '08': 
        		            $mesdesc = 'Agosto';
        		            break;
        		        case '09': 
        		            $mesdesc = 'Setembro';
        		            break;
        		        case '10': 
        		            $mesdesc = 'Outubro';
        		            break;
        		        case '11': 
        		            $mesdesc = 'Novembro';
        		            break;
        		        case '12': 
        		            $mesdesc = 'Dezembro';
        		            break;
    }
				

	switch ($tiporelatorio){
	    case 'DRE':
	        if ($anodre != 'branco' && $mesdre != 'branco'){

	            $queryfisico = "SELECT * FROM BAZAR where DATA LIKE '".$anodre."-".$mesdre."-%' AND TIPO_BAZAR = 'Físico'";
				$selectfisico = mysqli_query($connect,$queryfisico);
				
				$queryfora = "SELECT * FROM BAZAR where DATA LIKE '".$anodre."-".$mesdre."-%' AND TIPO_BAZAR = 'Fora do bazar'";
				$selectfora = mysqli_query($connect,$queryfora);
				
				$queryonline = "SELECT * FROM BAZAR where DATA LIKE '".$anodre."-".$mesdre."-%' AND TIPO_BAZAR = 'Online'";
				$selectonline = mysqli_query($connect,$queryonline);
				
				$querydespesas = "SELECT * FROM BAZAR where DATA LIKE '".$anodre."-".$mesdre."-%' AND TIPO_BAZAR = 'Despesas'";
				$selectdespesas = mysqli_query($connect,$querydespesas);
				
				$sumfora = 0;
				$sumfisico = 0;
				$sumonline = 0;
				$sumdespdia= 0;
				$totalrecbruta = 0;
				$totaldesbruta = 0;
				$totalrecliq = 0;
				
				    while ($fetch = mysqli_fetch_row($selectfisico)) {
        					$sumfisico = floatval($sumfisico) + (floatval($fetch[5]) + floatval($fetch[6]));
        					$sumdespdia = floatval($sumdespdia) + floatval($fetch[4]);
        			}
        			
        			while ($fetch = mysqli_fetch_row($selectfora)) {
        					$sumfora = floatval($sumfora) + floatval($fetch[7]);
        			}
        			
        			while ($fetch = mysqli_fetch_row($selectonline)) {
        					$sumonline = floatval($sumonline) + floatval($fetch[7]);
        			}
        			
        			while ($fetch = mysqli_fetch_row($selectdespesas)) {
        					$sumdespesas = floatval($sumdespesas) + floatval($fetch[7]);
        			}
        			
        			$totalrecbruta = floatval($sumfora) + floatval($sumonline) + floatval($sumfisico);
        			$totaldesbruta = floatval($sumdespdia) + floatval($sumdespesas);
        			$totalrecliq = floatval($totalrecbruta) - floatval($totaldesbruta);
        			
        			/* percentual equivalente receita bruta */
        			$precbrutafisico = (floatval($sumfisico) / floatval($totalrecbruta))*100;
        			$precbrutaonline = (floatval($sumonline) / floatval($totalrecbruta))*100;
        			$precbrutafora = (floatval($sumfora) / floatval($totalrecbruta))*100;
        			$precbrutatot = floatval($precbrutafisico) + floatval($precbrutaonline) + floatval($precbrutafora);
        			/* percentual equivalente receita bruta*/
        			
        			/* percentual equivalente despesa bruta */
        			$pdesbrutafisico = (floatval($sumdespdia) / floatval($totaldesbruta))*100;
        			/* percentual equivalente desp bruta*/
        			
        		    echo "<br><center><h2>DEMONSTRATIVO DE RESULTADOS DO EXERCÍCIO (DRE)</h2><br>";
        		    echo "<h4>Ano ".$anodre." - Mês ".$mesdesc."</center></h4><br>";
        			echo "<table class='table'>";
                    echo "<thead class='thead-dark'>";
                    echo "<th scope='col' cols='2'>Receita operacional bruta</th>";
                    echo "<th scope='col' cols='1'>R$ ".number_format($totalrecbruta,2,',', '.')."</th>";
                    echo "<th scope='col' cols='1'>100%</th>";
                    echo "</thead>";
                    echo "</table>";
                    echo "<table class='table'>";
                    echo "<thead class='thead-light'>";
                    echo "<th scope='col' cols='2'>Vendas do bazar físico</th>";
                    echo "<th scope='col' cols='1'>R$ ".number_format($sumfisico,2,',', '.')."</th>";
                    echo "<th scope='col' cols='1'>".number_format($precbrutafisico,1,'.', '.')."%</th>";
                    echo "</thead>";
                	echo "<tbody>";
                	
                	mysqli_data_seek($selectfisico,0);
                	
        			while ($fetch = mysqli_fetch_row($selectfisico)) {
        			    $data = $fetch[3];
        			    $descricao = $fetch[10];
        			    $valor = (floatval($fetch[5]) + floatval($fetch[6]) + floatval($fetch[7]));
        			    $tipobazar = $fetch[12];
        			    $perc = (floatval($valor) / floatval($sumfisico))*100;
        			    echo "<tr>";
        			    echo "<td>".$descricao."</td>";
        			    echo "<td>R$ ".number_format($valor,2,',', '.')."</td>"; 
        			    echo "<td>".number_format($perc,1,'.', '.')."%</td>";
					    echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    
                    echo "<table class='table'>";
                    echo "<thead class='thead-light'>";
                    echo "<th scope='col' cols='2'>Vendas do bazar online</th>";
                    echo "<th scope='col' cols='1'>R$ ".number_format($sumonline,2,',', '.')."</th>";
                    echo "<th scope='col' cols='1'>".number_format($precbrutaonline,1,'.', '.')."%</th>";
                    echo "</thead>";
                	echo "<tbody>";
                	
        			mysqli_data_seek($selectonline,0);
                	
        			while ($fetch = mysqli_fetch_row($selectonline)) {
        			    $data = $fetch[3];
        			    $descricao = $fetch[10];
        			    $valor = floatval($fetch[7]);
        			    $perc = (floatval($valor) / floatval($sumonline))*100;
        			    $tipobazar = $fetch[12];
        			    echo "<tr>";
        			    echo "<td>".$descricao."</td>";
        			    echo "<td>R$ ".number_format($valor,2,',', '.')."</td>"; 
        			    echo "<td>100%</td>";
					    echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    
					echo "<table class='table'>";
					echo "<thead class='thead-light'>";
					echo "<th scope='col' cols='3'>Vendas fora do bazar</th>";
					echo "<th scope='col' cols='1'>R$ ".number_format($sumfora,2,',', '.')."</th>";
					echo "<th scope='col' cols='1'>".number_format($precbrutafora,1,'.', '.')."%</th>";
					echo "</thead>";
					echo "<tbody>";
					
					mysqli_data_seek($selectfora,0);
                	
        			while ($fetch = mysqli_fetch_row($selectfora)) {
        			    $data = $fetch[3];
        			    $descricao = $fetch[10];
        			    $valor = floatval($fetch[7]);
        			    $perc = (floatval($valor) / floatval($sumfora))*100;
        			    $tipobazar = $fetch[12];
        			    echo "<tr>";
        			    echo "<td>".$descricao."</td>";
        			    echo "<td>R$ ".number_format($valor,2,',', '.')."</td>"; 
        			    echo "<td>".number_format($perc,1,'.', '.')."%</td>";
					    echo "</tr>";
                    }
                    echo "</tbody>";
					echo "</table>";
        			      
        			echo "<table class='table'>";
                    echo "<thead class='thead-dark'>";
                    echo "<th scope='col' cols='2'>Deduções da receita bruta</th>";
                    echo "<th scope='col' cols='1'>R$ ".number_format($totaldesbruta,2,',', '.')."</th>";
                    echo "<th scope='col' cols='1'>100%</th>";
                    echo "</thead>";
                	echo "<tbody>";
        			echo "<tr>";
					echo "<td>Despesas diárias do bazar físico</td>";
					echo "<td>R$ ".number_format($sumdespdia,2,',', '.')."</td>";
					echo "<td>".number_format($pdesbrutafisico,1,'.', '.')."%</td>";
					
					mysqli_data_seek($selectdespesas,0);
                	
        			while ($fetch = mysqli_fetch_row($selectdespesas)) {
        			    $data = $fetch[3];
        			    $descricao = $fetch[10];
        			    $valor = floatval($fetch[7]);
        			    $perc = (floatval($valor) / floatval($totaldesbruta))*100;
        			    $tipobazar = $fetch[12];
        			    echo "<tr>";
        			    echo "<td>".$descricao."</td>";
        			    echo "<td>R$ ".number_format($valor,2,',', '.')."</td>"; 
        			    echo "<td>".number_format($perc,1,'.', '.')."%</td>";
					    echo "</tr>";
                    }
					echo "</tr>";
        			echo "</tbody>
        			      </table> <br>";
        			      
        			echo "<table class='table'>";
                    echo "<thead class='thead-dark'>";
                    echo "<th scope='col' cols='2'>Receita operacional líquida</th>";
                    echo "<th scope='col' cols='1'>R$ ".number_format($totalrecliq,2,',', '.')."</th>";
                    echo "<th scope='col' cols='1'>100%</th>";
                    echo "</thead>";
                	echo "<tbody>";
        			echo "</tbody>
        			      </table> <br>
        			      
        			      <div class='d-print-none'>
            			      <h5> Perguntas frequentes </h5> <br>
            			      <p>
            			         <strong>1. </strong>Quais valores compõem o total de vendas do bazar físico? <br>
            			         <strong>R: </strong> Os valores são vendas no cartão e vendas em dinheiro depositadas na conta da ONG
            			         <br><br>
            			         <strong>2. </strong>Quais valores compõem o total de vendas do bazar online? <br>
            			         <strong>R: </strong> Os valores são vendas em dinheiro depositadas na conta da ONG
            			         <br><br>
            			         <strong>3. </strong>Quais valores compõem o total de vendas fora do bazar físico? <br>
            			         <strong>R: </strong> Os valores são vendas em dinheiro depositadas na conta da ONG
            			         <br><br>
            			         <strong>4. </strong>Quais valores compõem o total de despesas brutas? <br>
            			         <strong>R: </strong> Qualquer valor que for lançado como despesas no bazar físico e despesas em geral. 
            			         <br><br>
            			         <strong>5. </strong>Quais valores compõem o total de receitas operacionais líquidas? <br>
            			         <strong>R: </strong> Os valores são total de receitas brutas mais total de despesas brutas.
            			         <br><br>
        			          </p>
        			       </div>";

						$assunto = "Relatório - Adoções no ano de ".$anoadocao." / mês ".$mesadocao."";
						
						$mensagem ="<center><table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
                            <th scope='col'>&nbsp;</th>
							<th scope='col'>&nbsp;</th>
							<th scope='col' colspan='2'>Adoções</th>
							<th scope='col' colspan='2'>Animais doados castrados</th>
							<th scope='col' colspan='7'>Locais</th>
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Ano</th>
							<th scope='col'>Mês</th>
							<th scope='col'>Cães</th>
							<th scope='col'>Gatos</th>
							<th scope='col'>Cães</th>
							<th scope='col'>Gatos</th>
							<th scope='col'>Petz</th>
							<th scope='col'>Pet Marginal</th>
							<th scope='col'>Petcamp Barão</th>
							<th scope='col'>Petcamp Jasmim</th>
							<th scope='col'>Petland</th>
							<th scope='col'>Leroy M Dom Pedro</th>
							<th scope='col'>Fora da feira</th>
						  </tr>
						  </thead>
						  <tbody>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<td class='text-danger'>".$mesadocao."</td>
							<td class='text-danger'>".$mes_adotados_caes."</td>
							<td class='text-danger'>".$mes_adotados_gatos."</td>
							<td class='text-danger'>".$mes_castrados_caes."</td>
							<td class='text-danger'>".$mes_castrados_gatos."</td>
							<td class='text-danger'>".$mes_total_petz."</td>
							<td class='text-danger'>".$mes_total_petcenter."</td>
							<td class='text-danger'>".$mes_total_petcamp_bg."</td>
							<td class='text-danger'>".$mes_total_petcamp_jas."</td>
							<td class='text-danger'>".$mes_total_petland."</td>
							<td class='text-danger'>".$mes_total_leroy."</td>
							<td class='text-danger'>".$mes_total_fora_feira."</td>
						  </tr>
						  </tbody>
						 </table></center>";
					
				}
	        if ($anodre != 'branco' && $mesdre == 'branco'){
	            $query = "SELECT * FROM BAZAR where DATA LIKE '".$anodre."-%'";
				$select = mysqli_query($connect,$query);
				$reccount = mysqli_num_rows($select);
				
				if ($reccount == '0') {
        			echo "<center>Nenhum lançamento encontrado <br></center>";
        		}else{ 
        		    echo "<table class='table'>";
                    echo "<thead class='thead-dark'>";
                    echo "<th scope='col' cols='2'>&nbsp;</th>";
                    echo "<th scope='col' cols='2'>Bazar físico</th>";
                    echo "<th scope='col' cols='1'>Bazar online</th>";
                    echo "<th scope='col' cols='1'>Fora do bazar</th>";
                    echo "</thead>";
                    echo "<thead class='thead-light'>";
                	echo "<th scope='col'>Ano</th>";
                	echo "<th scope='col'>Mês</th>";
                	echo "<th scope='col'>Despesa</th>";
                	echo "<th scope='col'>Receita</th>";
                	echo "<th scope='col'>Receita</th>";
                	echo "<th scope='col'>Receita</th>";
                	echo "</thead>";
                	echo "<tbody>";
        			while ($fetch = mysqli_fetch_row($select)) {
        			        $produto = $fetch[1];	
        					$estoque = $fetch[2];
        					$tipobazar = $fetch[12];
        					echo "<tr>";
        					echo "<td>".$anodre."</td>";
        					echo "<td>".$mesdre."</td>";
        					echo "<td>".$produto."</td>";
        					switch ($tipobazar) {
        					    case 'Fora do bazar':
        					    case 'Online':
        					        $valor = $fetch[7];
        					    case 'Físico':
        					        $despdia = $fetch[4];
        					        $vendacartao = $fetch[5];
        					        $despdia = $fetch[4];
        					        
        					        $valor = $fetch[7];
        					   
        					}
        					echo "<td>R$ ".number_format($valor,2,',', '.')."</td>";
        					echo "<td>".$estoque."</td>";
        					/*echo "<td><a href='formvendaprod.php?id=".$fetch[0]."' class='btn btn-primary'>Cadastrar venda</a>&nbsp;</td>";*/
        					echo "</tr>";
        			}
        			echo "</tbody>
        			      </table> <br>";

						$assunto = "Relatório - Adoções no ano de ".$anoadocao." / mês ".$mesadocao."";
						
						$mensagem ="<center><table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
                            <th scope='col'>&nbsp;</th>
							<th scope='col'>&nbsp;</th>
							<th scope='col' colspan='2'>Adoções</th>
							<th scope='col' colspan='2'>Animais doados castrados</th>
							<th scope='col' colspan='7'>Locais</th>
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Ano</th>
							<th scope='col'>Mês</th>
							<th scope='col'>Cães</th>
							<th scope='col'>Gatos</th>
							<th scope='col'>Cães</th>
							<th scope='col'>Gatos</th>
							<th scope='col'>Petz</th>
							<th scope='col'>Pet Marginal</th>
							<th scope='col'>Petcamp Barão</th>
							<th scope='col'>Petcamp Jasmim</th>
							<th scope='col'>Petland</th>
							<th scope='col'>Leroy M Dom Pedro</th>
							<th scope='col'>Fora da feira</th>
						  </tr>
						  </thead>
						  <tbody>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<td class='text-danger'>".$mesadocao."</td>
							<td class='text-danger'>".$mes_adotados_caes."</td>
							<td class='text-danger'>".$mes_adotados_gatos."</td>
							<td class='text-danger'>".$mes_castrados_caes."</td>
							<td class='text-danger'>".$mes_castrados_gatos."</td>
							<td class='text-danger'>".$mes_total_petz."</td>
							<td class='text-danger'>".$mes_total_petcenter."</td>
							<td class='text-danger'>".$mes_total_petcamp_bg."</td>
							<td class='text-danger'>".$mes_total_petcamp_jas."</td>
							<td class='text-danger'>".$mes_total_petland."</td>
							<td class='text-danger'>".$mes_total_leroy."</td>
							<td class='text-danger'>".$mes_total_fora_feira."</td>
						  </tr>
						  </tbody>
						 </table></center>";
					
				}
	        }
	        if ($anodre == 'branco' && $mesdre == 'branco'){
	            $query = "SELECT * FROM BAZAR ORDER BY DATA DESC'";
				$select = mysqli_query($query,$connect);
				$reccount = mysqli_num_rows($select);
				
				if ($reccount == '0') {
        			echo "<center>Nenhum lançamento encontrado <br></center>";
        		}else{ 
        		    echo "<table class='table'>";
                    echo "<thead class='thead-dark'>";
                    echo "<th scope='col' cols='2'>&nbsp;</th>";
                    echo "<th scope='col' cols='2'>Bazar físico</th>";
                    echo "<th scope='col' cols='1'>Bazar online</th>";
                    echo "<th scope='col' cols='1'>Fora do bazar</th>";
                    echo "</thead>";
                    echo "<thead class='thead-light'>";
                	echo "<th scope='col'>Ano</th>";
                	echo "<th scope='col'>Mês</th>";
                	echo "<th scope='col'>Despesa</th>";
                	echo "<th scope='col'>Receita</th>";
                	echo "<th scope='col'>Receita</th>";
                	echo "<th scope='col'>Receita</th>";
                	echo "</thead>";
                	echo "<tbody>";
        			while ($fetch = mysqli_fetch_row($select)) {
        			        $produto = $fetch[1];	
        					$valor = $fetch[3];
        					$estoque = $fetch[2];
        					echo "<tr>";
        					echo "<td>".$anodre."</td>";
        					echo "<td>".$mesdre."</td>";
        					echo "<td>".$produto."</td>";
        					echo "<td>R$ ".number_format($valor,2,',', '.')."</td>";
        					echo "<td>".$estoque."</td>";
        					/*echo "<td><a href='formvendaprod.php?id=".$fetch[0]."' class='btn btn-primary'>Cadastrar venda</a>&nbsp;</td>";*/
        					echo "</tr>";
        			}
        			echo "</tbody>
        			      </table> <br>";

						$assunto = "Relatório - Adoções no ano de ".$anoadocao." / mês ".$mesadocao."";
						
						$mensagem ="<center><table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
                            <th scope='col'>&nbsp;</th>
							<th scope='col'>&nbsp;</th>
							<th scope='col' colspan='2'>Adoções</th>
							<th scope='col' colspan='2'>Animais doados castrados</th>
							<th scope='col' colspan='7'>Locais</th>
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Ano</th>
							<th scope='col'>Mês</th>
							<th scope='col'>Cães</th>
							<th scope='col'>Gatos</th>
							<th scope='col'>Cães</th>
							<th scope='col'>Gatos</th>
							<th scope='col'>Petz</th>
							<th scope='col'>Pet Marginal</th>
							<th scope='col'>Petcamp Barão</th>
							<th scope='col'>Petcamp Jasmim</th>
							<th scope='col'>Petland</th>
							<th scope='col'>Leroy M Dom Pedro</th>
							<th scope='col'>Fora da feira</th>
						  </tr>
						  </thead>
						  <tbody>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<td class='text-danger'>".$mesadocao."</td>
							<td class='text-danger'>".$mes_adotados_caes."</td>
							<td class='text-danger'>".$mes_adotados_gatos."</td>
							<td class='text-danger'>".$mes_castrados_caes."</td>
							<td class='text-danger'>".$mes_castrados_gatos."</td>
							<td class='text-danger'>".$mes_total_petz."</td>
							<td class='text-danger'>".$mes_total_petcenter."</td>
							<td class='text-danger'>".$mes_total_petcamp_bg."</td>
							<td class='text-danger'>".$mes_total_petcamp_jas."</td>
							<td class='text-danger'>".$mes_total_petland."</td>
							<td class='text-danger'>".$mes_total_leroy."</td>
							<td class='text-danger'>".$mes_total_fora_feira."</td>
						  </tr>
						  </tbody>
						 </table></center>";
					
				}
	        }
	    case 'Lançamentos diários':
}
		mysqli_close($connect);

}
		
?>
</div>
<center>
<div class="d-print-none">
<form action="enviarrelatorios.php" method="post" name="emailrelatorio">
    <div class="d-print-none">
        <center><p><strong>OBSERVAÇÕES</strong><br>
            <i>Os valores apresentados são as informações cadastradas e foram coletadas pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail financeiro@gaarcampinas.org</i></center>      
            <input type="text" id="assunto" name="assunto" value="<? echo $assunto ?>" hidden>
        <!--<textarea name="obs" cols="50" rows="20" id="obs"></textarea><br><br>-->
        <input type="text" id="mensagem" name="mensagem" value="<? echo $mensagem ?>" hidden><br><br>
        <a href="javascript:emailrelatorio.submit()" class="btn btn-primary">Enviar relatório por e-mail</a> &nbsp; <a href="javascript:window.print()" class="btn btn-primary">Download</a>
    </div>  
</form>
    <br>
    <a href="relatorio_captacao.php" class="btn btn-primary">Nova pesquisa</a>
	<br><br>
</center>
    </div>
</div>
<div class="d-none d-print-block">
        <center><p><strong>OBSERVAÇÕES</strong><br>
                <i>Os valores apresentados são as informações cadastradas e foram coletadas pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail financeiro@gaarcampinas.org</i></center>      
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