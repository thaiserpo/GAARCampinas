<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,NOME,EMAIL  FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$nome = $fetcharea[1];
				$email = $fetcharea[2];
		}
		
		$queryid = "SELECT ID FROM CLINICAS WHERE EMAIL ='$email'";
		$selectid = mysqli_query($connect,$queryid);
			
		while ($fetchid = mysqli_fetch_row($selectid)) {
				$id = $fetchid[0];
				
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
    
    <title>GAAR - Área do veterinário</title>
    
</head>
<body> 
<?php 
		
		switch ($area) {
				  case 'clinica':
				  	include_once("menu_vet.php") ;
					break;
			  }
			  
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
    <br>
    <p><h3>Olá <?echo $nome?>! Seja bem vindo a área restrita do GAAR!</h3> <br></p>
        <p>Código de cadastro: <?echo $id?></p>
        <div class="form-group row">
            <div id="divultimosagendamentos" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMOS AGENDAMENTOS CADASTRADOS</h4><br>
                    	<?
                    	    
                                $queryclinica = "SELECT * FROM AGENDAMENTO WHERE CLINICA = '".$id."' ORDER BY DATA_AG DESC LIMIT 15";
                                $selectclinica = mysqli_query($connect,$queryclinica);
                    	        $reccount = mysqli_num_rows($selectclinica);
                    	        
                    	        if ($reccount != '0'){
                        		    echo "<table class='table'>";
                                    echo "<thead class='thead-light'>";
                                    echo "<th scope='col'>Código</th>";
                                    echo "<th scope='col'>Data/hora</th>";
                                    echo "<th scope='col'>Animal</th>";
                                    echo "<th scope='col'>Espécie</th>";
                                    echo "<th scope='col'>Responsável</th>";
                                    echo "<th scope='col'>Autorização</th>";
                                    echo "<th scope='col'>Ativo</th>";
                                    echo "<th scope='col' colspan='2'>Realizado</th>";
                                    echo "</thead>";
                                    echo "<tbody>";
                        			while ($fetch = mysqli_fetch_row($selectclinica)) {
                        					$codmult = $fetch[0];	
                        					$datamulti = $fetch[1];
                        					$horamulti = $fetch[2];
                        					$nomedoanimal = $fetch[3];
                        					$especie = $fetch[4];
                        					$responsavel  = $fetch[9];
                        					$autorizadopor = $fetch[10];
                        					$clinica = $fetch[18];
                        					$ativo = $fetch[16];
                        					$idvet = $fetch[17];
                        					$realizado = $fetch[22];

                        					$ano_proc = substr($datamulti,0,4);
                                		    $mes_proc = substr($datamulti,5,2);
                                		    $dia_proc = substr($datamulti,8,2);
                                		    
                                            echo "<tr>";
                                            echo "<td class='w-25 p-3'>";
                        					echo $codmult;
                        					echo "<input type='text' name='codmult' id='codmult' value='".$codmult."' hidden>";
                        					echo "</td>";
                        					echo "<td>";
                        					echo $dia_proc."/".$mes_proc."/".$ano_proc."-".$horamulti;
                        					echo "</td>";
                        					echo "<td>";
                        					echo $nomedoanimal;
                        					echo "</td>";
                        					echo "<td>";
                        					echo $especie;
                        					echo "</td>";
                        					echo "<td>";
                        					echo $responsavel;
                        					echo "</td>";
                        					echo "<td>";
                        					echo $autorizadopor;
                        					echo "</td>";
                        					echo "<td>";
                        					echo $ativo;
                        					echo "</td>";
                        					echo "<td>";
                        					echo $realizado;
                        					echo "</td>";
                        					echo "<td>";
                        					if ($realizado =='SIM') {
                        					    echo "<a href='atualizaagenda.php?id=".$codmult."&action=NÃO&parm=".$parm."'>Não realizado</a>";   
                        					} else {
                        					    echo "<a href='atualizaagenda.php?id=".$codmult."&action=SIM&parm=".$parm."'>Realizado</a>";   
                        					}
                        					echo "</td>";
                        					echo "</tr>";
                        			}
                        		echo "</tbody>";
                        		echo "</table>";
                    	        }
                        		else {
                        		        echo "<p>Nenhum agendamento encontrado</p><br>";
                        		}
                    	?>
                    	</center>
            </div>
            <div id="divultimosprocedi" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMOS PROCEDIMENTOS CADASTRADOS</h4><br>
                    	<?
                    	    
                                $queryclinica = "SELECT * FROM PROCEDIMENTOS WHERE CLINICA = '".$tmpclinica."' ORDER BY DATA_REG DESC LIMIT 10";
                                $selectclinica = mysqli_query($connect,$queryclinica);
                    	        $reccount = mysqli_num_rows($selectclinica);
                    	        
                    	        if ($reccount != '0'){
                        		    echo "<table class='table'>";
                                    echo "<thead class='thead-light'>";
                                	echo "<th scope='col'>Data</th>";
                                	echo "<th scope='col'>Clínica</th>";
                                	echo "<th scope='col'>Tipo</th>";
                                	echo "<th scope='col'>Espécie</th>";
                                	echo "<th scope='col'>Sexo</th>";
                                	echo "<th scope='col'>Responsável do GAAR</th>";
                                	echo "<th scope='col'>Quantidade</th>";
                                	echo "<th scope='col'>Valor</th>";
                                	echo "</thead>";
                                	echo "<tbody>";
                    	        
                    	           while ($fetchclinica = mysqli_fetch_row($selectclinica)) {
                        	            $idclinica = $fetchclinica[0];
                        				$dtclinica = $fetchclinica[1];
                        				$especie = $fetchclinica[3];
                        				$sexo = $fetchclinica[4];
                        				$respgaar = $fetchclinica[8];
                        				$vetclinica = $fetchclinica[13];
                        				$tipoclinica = $fetchclinica[10];
                        				$valortutorclinica = $fetchclinica[12];
                        				$valorgaar = $fetchclinica[11];
                        				$qtdclinica = $fetchclinica[17];
                        				$sum = floatval($valortutorclinica) + floatval($valorgaar);
                        				
                        				$ano_dtclinica = substr($dtclinica,0,4);
                        		        $mes_dtclinica = substr($dtclinica,5,2);
                        		        $dia_dtclinica = substr($dtclinica,8,2);
                        		    
                                			echo "<tr>";
                                			echo "<td>".$dia_dtclinica."/".$mes_dtclinica."/".$ano_dtclinica."</td>";
                        					echo "<td>".$vetclinica."</td>";
                        					echo "<td>".$tipoclinica."</td>";
                        					echo "<td>".$especie."</td>";
                        					echo "<td>".$sexo."</td>";
                        					echo "<td>".$respgaar."</td>";
                        					echo "<td>".$qtdclinica."</td>";
                        					if ($area =='diretoria'){
                                        	    echo "<td>R$ ".number_format($sum,2,',', '.')."</td>";
                                        	} else {
                                        	    echo "<td>R$ ".number_format($sum,2,',', '.')."</td>";
                                        	}
                        				    echo "</tr>";
                        			}   
                        			        echo "</tbody>";
                        			        echo "</table><br>";
                    	        }
                        		else {
                        		        echo "<p>Nenhum procedimento encontrado para a data ".$dataprocedi."</p><br>";
                        		}
                    	?>
                    	</center>
            </div>
      </div>
    </div>
</main>
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