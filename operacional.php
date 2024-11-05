<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

$dia_iniciopost = date('Y-m-d', strtotime('next monday'));
$dia_iniciopost_semana = date('Y-m-d', strtotime('monday this week'));
$dia_fimpost = date('Y-m-d', strtotime($dia_iniciopost. ' + 6 days'));
$dia_fimpost_semana = date('Y-m-d', strtotime('sunday this week'));

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode 

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA,NOME FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
				$nome = $fetcharea[2];
				
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
    
    <title>GAAR - Área do voluntário</title>
    
    <!--- GOOGLE ADSENSE --->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
    <!--- GOOGLE ADSENSE --->
    
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
        <p><h3><center>Olá <? echo $nome?>! Seja bem vindo a área restrita do GAAR! </center></h3></p>
        <div id="divpretermos" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMOS PRÉ TERMOS CADASTRADOS</h4><br>
                    	<?

                    	    $query = "SELECT * FROM FORM_PRE_ADOCAO ORDER BY ID DESC LIMIT 5";
                    		$result = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($result);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Nome</th>";
                            	echo "<th scope='col'>Espécie</th>";
                            	echo "<th scope='col'>Responsável</th>";
                            	echo "<th scope='col'>Interessado</th>";
                            	echo "<th scope='col'>Recebido em</th>";
                            	echo "<th scope='col'>Status</th>";
                            	echo "<th scope='col'>&nbsp</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $nomeanimal = $fetch[11];
                    				$especie = $fetch[12];
                    				$adotante = $fetch[1];
                    				$resp = $fetch[68];
                    				$recebidoem = $fetch[66];
                    				$obs = $fetch[64];
                    				
                    				if ($obs =='') {
                    				    $obs = "Não respondido";
                    				}
                    				
                    				$ano_recebidoem = substr($recebidoem,0,4);
                        		    $mes_recebidoem = substr($recebidoem,5,2);
                        		    $dia_recebidoem = substr($recebidoem,8,2);
                        		    
                        			echo "<tr>";
                        			echo "<td>".$nomeanimal."</td>";
                					echo "<td>".$especie."</td>";
                					echo "<td>".$resp."</td>";
                					echo "<td>".$adotante."</td>";
                					echo "<td>".$dia_recebidoem."/".$mes_recebidoem."/".$ano_recebidoem."</td>";
                					echo "<td>".$obs."</td>";
                					if ($subarea != 'cadastrotermo') {
                					    echo "<td><a href='visualizapretermo.php?idpretermo=".$fetch[0]."' class='btn btn-primary'>Visualizar</a>&nbsp;</td>";
                					}
                				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum animal encontrado</p><br>";
                    		}
                    	if ($subarea != 'cadastrotermo') {
                    	    echo "<p> Para visualizar todos os pré termos recebidos, <a href='pesquisapretermo.php'>clique aqui</a></p>";
                    	}
                    	
                    	?>
                    	
                    	</center>
        </div>
        <div id="divanimaisgaar" class="d-block">
                <center>
                               <br><h4>ÚLTIMOS ANIMAIS DO GAAR CADASTRADOS</h4><br>
                               <p> Serão exibidos os últimos 10 cadastros.</p>
                    	<?

                    	    $query = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO <> 'Terceiros' AND DIVULGAR_COMO <> 'Esperando aprovação' ORDER BY ID DESC LIMIT 10";
                    		$result = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($result);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Nome</th>";
                            	echo "<th scope='col'>Espécie</th>";
                            	echo "<th scope='col'>Responsável</th>";
                            	echo "<th scope='col'>LT</th>";
                            	echo "<th scope='col'>Status</th>";
                            	echo "<th scope='col'></th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $id = $fetch[0];
                    	            $nome = $fetch[1];
                    				$especie = $fetch[2];
                    				$resp = $fetch[12];
                    				$lt = $fetch[11];
                    				$divulgarcomo = $fetch[18];
                    				
                    				if ($divulgarcomo == 'GAAR'){
                    				    $divulgarcomo = 'Disponível';
                    				}
                            			echo "<tr>";
                            			echo "<td>".$nome."</td>";
                    					echo "<td>".$especie."</td>";
                    					echo "<td>".$resp."</td>";
                    					echo "<td>".$lt."</td>";
                    					echo "<td>".$divulgarcomo."</td>";
                    					echo "<td><a href='http://www.gaarcampinas.org/pet.php?id=".$fetch[0]."' target='_blank'><button type='button' class='btn btn-primary' title='Visualizar'>
                					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                          <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                          <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                        </svg>
                                                    </button></a></td>";
                    				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum animal encontrado</p><br>";
                    		}
                    	?>
                    	<p> Para visualizar todos os animais cadastrados, <a href="formpesquisapetinterna.php">clique aqui</a></p>
                    	</center>
                </div>
        <div id="divgradesemana" class="d-block"><br>
            <center><h4>POSTS DA SEMANA ATUAL</h4>
            <p> <a href="https://gaarcampinas.org/area/envioemailredacao.php" target="_blank">Criar e-mail para grupo de redação</a></p></center>
            <?
                $query = "SELECT * FROM ANIMAIS_REDES WHERE DIA_POST >= '".$dia_iniciopost_semana."' AND DIA_POST <= '".$dia_fimpost_semana."' ORDER BY DIA_POST ASC";
                $select = mysqli_query($connect,$query);
                $reccount = mysqli_num_rows($select);
                
                echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>ID</th>";
            	echo "<th scope='col'>Nome</th>";
            	echo "<th scope='col'>Espécie</th>";
            	echo "<th scope='col' colspan='1'>Data do post</th>";
            	echo "<th scope='col' colspan='2'>Último post</th>";
            	echo "</thead>";
            	echo "<tbody>";
                
                while ($fetch = mysqli_fetch_row($select)) {
                
                    $idanimal = $fetch[1];
                    $data_post_semana = $fetch[2];
                    $ultimo_post = $fetch[4];
                    $dayofweek = date('w', strtotime($data_post));
                    
                    $querypet_redes = "SELECT NOME_ANIMAL,ESPECIE FROM ANIMAL WHERE ID='$idanimal'";
                	$selectpet_redes = mysqli_query($connect,$querypet_redes);
                	$rc = mysqli_fetch_row($selectpet_redes);
    			    $nomeanimal = $rc[0];
    			    $especie = $rc[1];
    			    
    			    $ano_datapost_semana = substr($data_post_semana,0,4);
        		    $mes_datapost_semana = substr($data_post_semana,5,2);
        		    $dia_datapost_semana = substr($data_post_semana,8,2);
        		    
        		    $ano_ultimopost = substr($ultimo_post,0,4);
        		    $mes_ultimopost = substr($ultimo_post,5,2);
        		    $dia_ultimopost = substr($ultimo_post,8,2);
                
                    echo "<tr>";
        			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>".$idanimal."</a></td>";
        			echo "<td>".$nomeanimal."</td>";
        			echo "<td>".$especie."</td>";
    				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
    				echo "<td>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</td>";
    				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
    			    echo "</tr>";
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
            ?>
    
        </div>
        <div id="divtermos" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMOS TERMOS CADASTRADOS</h4><br>
                    	<?

                    	    $query = "SELECT * FROM TERMO_ADOCAO ORDER BY ID DESC LIMIT 5";
                    		$result = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($result);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Nome</th>";
                            	echo "<th scope='col'>Espécie</th>";
                            	echo "<th scope='col'>Adotante</th>";
                            	echo "<th scope='col' colspan='2'>Data da adoção</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $nomeanimal = $fetch[15];
                    				$especie = $fetch[16];
                    				$adotante = $fetch[1];
                    				$dtadocao = $fetch[32];
                    				
                            		$ano_adocao = substr($dtadocao,0,4);
                        		    $mes_adocao = substr($dtadocao,5,2);
                        		    $dia_adocao = substr($dtadocao,8,2);

                        			echo "<tr>";
                        			echo "<td>".$nomeanimal."</td>";
                					echo "<td>".$especie."</td>";
                					echo "<td>".$adotante."</td>";
                					echo "<td>".$dia_adocao."/".$mes_adocao."/".$ano_adocao."</td>";
                					echo "<td><a href='formvisualizatermo.php?idtermo=".$fetch[0]."' class='btn btn-primary'>Visualizar</a>&nbsp;</td>";
                				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum animal encontrado</p><br>";
                    		}
                    	if ($subarea != 'cadastrotermo') {
                    	        echo "<p> Para visualizar todos os termos cadastrados, <a href='pesquisatermo.php'>clique aqui</a></p>";
                    	}
                    	
}
mysqli_close($connect);

fclose($fp); 
?>
                    	</center>
        </div>
    <br /><br />
    </div>
</main>
<br>
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