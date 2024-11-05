<?php 		
		/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
		$login = $_SESSION['login'];
		
		if($login == "" || $login == null){
				  echo"<script language='javasript' type='text/javscript'>
				  alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
		}else{
		
		$queryarea = "SELECT * FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[5];
				
		}

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
    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Pesquisa de vendas de produtos</title>
    
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
    <center>
           <br>
        <h3>RESULTADO DAS VENDAS DOS PRODUTOS</h3><br>
        <p><label> Todas as vendas de produtos estão cadastradas aqui. Caso alguma venda não foi encontrada, cadastre <a href="formvendaprod.php">aqui</a>. </label></p>
       </center>
<?php 			
		
				
		$prodvenda = $_POST['prodvenda'];
		$localvenda = $_POST['localvenda'];

		$summesa = 0;
		$sumparede = 0;
		$sumcanbeaglebd = 0;
		$sumcanquadri = 0;
		$sumcangatobd = 0;
		$sumcanretrodog = 0;
		$sumchavpatarosa = 0;
		$sumchavpataazul = 0;
		$sumchavpatapreto = 0;
		$sumtermicacinza = 0;
		$sumtermicabranca = 0;

		
		if ($prodvenda != ''){
		    $query = "SELECT * FROM VENDAS_PRODUTOS WHERE PRODUTO like '%".$prodvenda."%' ORDER BY DT_VENDA DESC";
    		$select = mysqli_query($connect,$query);
    		$reccount = mysqli_num_rows($select);
		} else if($localvenda !='') {
		    $query = "SELECT * FROM VENDAS_PRODUTOS WHERE LOCAL_VENDA LIKE '%".$localvenda."%' ORDER BY ID DESC";
    		$select = mysqli_query($connect,$query);
    		$reccount = mysqli_num_rows($select);
		} else {
		    $query = "SELECT * FROM VENDAS_PRODUTOS ORDER BY DT_VENDA DESC";
		    $select = mysqli_query($connect,$query);
		    $reccount = mysqli_num_rows($select);  
		}

		if ($reccount == 0) {
			echo "<center>Nenhum produto encontrado <br><br>
				<a href='formpesquisavendaprod.php' class='btn btn-primary'>Voltar</a></center>";
		}else{ 
		    echo "<table class='table'>";
            echo "<thead class='thead-light'>";
            echo "<th scope='col'>Pedido Loja Integrada</th>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>Produto</th>";
        	echo "<th scope='col'>Qtde</th>";
        	echo "<th scope='col'>Data da venda</th>";
        	echo "<th scope='col'>Local</th>";
        	echo "<th scope='col'>Status</th>";
        	echo "<th scope='col' colspan='2'>Fornecedor</th>";
        	echo "</thead>";
        	echo "<tbody>";
			/*while ($fetch = mysqli_fetch_row($select)) {
					$qtdevenda = $fetch[7];
					$sumqtd = $sumqtd + intval($qtdevenda);
			}*/
			
			/*mysql_data_seek($select,0);*/
			while ($fetch = mysqli_fetch_row($select)) {
			        $id = $fetch[0];	
					$nome = $fetch[1];
					$celular = $fetch[2];
					$produto = $fetch[6];
					$qtdentreg  = $fetch[7];
					$dtvenda = $fetch[8];
					$localvenda = $fetch[17];
					$statusvenda = $fetch[11];
					$notificacao = $fetch[20];
					$idlojaintegr = $fetch[16];
					
					$ano_dtvenda = substr($dtvenda,0,4);
        		    $mes_dtvenda = substr($dtvenda,5,2);
        		    $dia_dtvenda = substr($dtvenda,8,2);
					
					switch ($produto) {
					    case 'Calendário modelo mesa':
					        $summesa = intval($summesa) + 1;
        					break;
        			    case 'Calendário modelo parede':
					        $sumparede = intval($sumparede) + 1;
					        break;
					    case 'Caneca Beagle Bom dia':
    					    $sumcanbeaglebd = intval($sumcanbeaglebd) + 1;
        					break;
    					case 'Caneca quadriculada de cachorro':
					        $sumcanquadri = intval($sumcanquadri) + 1;
					        break;
					    case 'Caneca Gato Bom dia':
					        $sumcangatobd = intval($sumcangatobd) + 1;
					        break;
    					case 'Caneca cachorro retrô (dog)':
					        $sumcanretrodog = intval($sumcanretrodog) + 1;
					        break;
					    case 'Chaveiro em borracha pata rosa':
					        $sumchavpatarosa = intval($sumchavpatarosa) + 1;
					        break;
					    case 'Chaveiro em borracha pata azul':
					        $sumchavpataazul = intval($sumchavpataazul) + 1;
					        break;
					    case 'Chaveiro em borracha pata preto':
					        $sumchavpatapreto = intval($sumchavpatapreto) + 1;
					        break;
					    case 'Garrafa térmica cinza':
					        $sumtermicacinza = intval($sumtermicacinza) + 1;
					        break;
					    case 'Garrafa térmica branca':
					        $sumtermicabranca = intval($sumtermicabranca) + 1;
					        break;
					}
					
					echo "<tr>";
					echo "<td>".$idlojaintegr."</td>";
					echo "<td>".$nome."</td>";
					echo "<td>".$produto."</td>";
					echo "<td>".$qtdentreg."</td>";
					echo "<td>".$dia_dtvenda."/".$mes_dtvenda."/".$ano_dtvenda."</td>";
					echo "<td>".$localvenda."</td>";
					echo "<td>".$statusvenda."</td>";
					if ($notificacao =='Não'){
					    echo "<td><a href='envioemailpedido.php?id=".$idlojaintegr."' class='btn btn-primary'>Notificar</a></td>";
					} else {
					    echo "<td><a href='envioemailpedido.php?id=".$idlojaintegr."' class='btn btn-primary disabled'>Notificado</a></td>";
					}
					
					/*echo "<td>".$sumqtd."</td>";*/
					/*echo "<td><a href='formvendaprod.php?id=".$fetch[0]."' class='btn btn-primary'>Cadastrar venda</a>&nbsp;</td>";*/
					echo "</tr>";
			}
			echo "</tbody>
			      </table>";
			echo "<br>
                			       <center>
                                        <h3>RESUMO</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                	    </thead>
                                    	<tbody>
                                    	<tr>
                        					<th scope='row'>Calendário modelo mesa </th>
                        					<td>".$summesa."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Calendário modelo parede</th>
                        					<td>".$sumparede."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Caneca Beagle Bom dia</th>
                        					<td>".$sumcanbeaglebd."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Caneca quadriculada de cachorro</th>
                        					<td>".$sumcanquadri."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Caneca Gato Bom dia</th>
                        					<td>".$sumcangatobd."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Caneca cachorro retrô (dog)</th>
                        					<td>".$sumcanretrodog."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Chaveiro em borracha pata rosa</th>
                        					<td>".$sumchavpatarosa."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Chaveiro em borracha pata azul</th>
                        					<td>".$sumchavpataazul."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Chaveiro em borracha pata preto</th>
                        					<td>".$sumchavpatapreto."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Garrafa térmica cinza</th>
                        					<td>".$sumtermicacinza."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Garrafa térmica branca</th>
                        					<td>".$sumtermicabranca."</td>
                    					</tr>
                    					</tbody>
                    				</table>";
            echo "<br>";
	        echo "<center><a href='formpesquisavendaprod.php' class='btn btn-primary'>Voltar</a>
        			</center>
        			</div>";
		}
		
		mysqli_close($connect);
}
?>
</center>
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

