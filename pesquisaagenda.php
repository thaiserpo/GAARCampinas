<?php 		
$lifetime=360;
session_set_cookie_params($lifetime);

/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
$login = $_SESSION['login'];
		
if($login == "" || $login == null){
				  echo"<script language='javascript' type='text/javascript'>
				  alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{

		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
		
		$codigo = $_POST['codigo'];
		$nomedoanimal = $_POST['nomedoanimal'];
		$nomedoprotetor = $_POST['nomedoprotetor'];
		$status = $_POST['status'];
		$clinica = $_POST['clinica'];
		$ativo = strtoupper($_POST['ativo']);
		$realizado = $_POST['realizado'];
		$mesprocedi = $_POST['mesprocedi'];
		$anoprocedi = $_POST['anoprocedi'];
		
		/*echo "<br><br><br><br>";
		echo "<br> codigo     :".$codigo;
		echo "<br> nome animal:".$nomedoanimal;
		echo "<br> nome tutor :".$nomedoprotetor;
		echo "<br>status      :".$status;
		echo "<br>clinica     :".$clinica;
		echo "<br>ativo       :".$ativo;
		echo "<br>realizado   :".$realizado;
		echo "<br>mes procedi :".$mesprocedi; 
		echo "<br>ano procedi :".$anoprocedi; */
		
		
		if ($mesprocedi != '' && $anoprocedi != '' && $clinica != '' && $realizado == '' && $codigo =='' && $nomedoanimal=='' && $nomedoprotetor=='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."-%' AND CLINICA ='$clinica' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi == '' && $anoprocedi != '' && $clinica == '' && $realizado == '' && $codigo =='' && $nomedoanimal=='' && $nomedoprotetor=='' && $status=='' && $ativo !=''){
			$query = "SELECT * FROM AGENDAMENTO WHERE DATA_AG LIKE '".$anoprocedi."-%' AND ATIVO='".$ativo."' ORDER BY DATA_AG DESC";
		}
		if ($mesprocedi != '' && $anoprocedi != '' && $clinica == '' && $realizado == '' && $codigo =='' && $nomedoanimal=='' && $nomedoprotetor=='' && $status=='' && $ativo !=''){
			$query = "SELECT * FROM AGENDAMENTO WHERE DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."-%' AND ATIVO='".$ativo."' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi != '' && $anoprocedi != '' && $clinica == '' && $realizado == '' && $codigo =='' && $nomedoanimal=='' && $nomedoprotetor=='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."-%' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi == '' && $anoprocedi != '' && $clinica == '' && $realizado == '' && $codigo =='' && $nomedoanimal=='' && $nomedoprotetor=='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE DATA_AG LIKE '".$anoprocedi."-%' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi != '' && $anoprocedi == '' && $clinica != '' && $realizado != '' && $codigo =='' && $nomedoanimal=='' && $nomedoprotetor=='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE DATA_AG LIKE '%-".$mesprocedi."-%' AND CLINICA ='$clinica' AND REALIZADO='$realizado' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi == '' && $anoprocedi == '' && $clinica != '' && $realizado != '' && $codigo =='' && $nomedoanimal=='' && $nomedoprotetor=='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE CLINICA ='$clinica' AND REALIZADO='$realizado' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi == '' && $anoprocedi == ''&& $clinica != '' && $realizado == '' && $codigo =='' && $nomedoanimal=='' && $nomedoprotetor=='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE CLINICA ='$clinica' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi == '' && $anoprocedi == '' && $clinica == '' && $realizado != ''&& $codigo =='' && $nomedoanimal=='' && $nomedoprotetor=='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE REALIZADO='$realizado' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi == '' && $anoprocedi == '' && $clinica == '' && $realizado == '' && $codigo !='' && $nomedoanimal=='' && $nomedoprotetor=='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE CODIGO='$codigo' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi == '' && $anoprocedi == '' && $clinica == '' && $realizado == '' && $codigo =='' && $nomedoanimal=='' && $nomedoprotetor !='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE RESPONSAVEL LIKE '%".$nomedoprotetor."%' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi != '' && $anoprocedi != '' && $clinica == '' && $realizado == '' && $codigo =='' && $nomedoanimal=='' && $nomedoprotetor !='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE RESPONSAVEL LIKE '%".$nomedoprotetor."%' AND DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."-%' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi != '' && $anoprocedi != '' && $clinica == '' && $realizado == '' && $codigo =='' && $nomedoanimal=='' && $nomedoprotetor !='' && $status=='' && $ativo !=''){
			$query = "SELECT * FROM AGENDAMENTO WHERE RESPONSAVEL LIKE '%".$nomedoprotetor."%' AND DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."-%' AND ATIVO='$ativo' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi != '' && $anoprocedi == '' && $clinica == '' && $realizado == '' && $codigo =='' && $nomedoanimal=='' && $nomedoprotetor !='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE RESPONSAVEL LIKE '%".$nomedoprotetor."%' AND DATA_AG LIKE '%-".$mesprocedi."-%' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi == '' && $anoprocedi == '' && $clinica == '' && $realizado == '' && $codigo =='' && $nomedoanimal !='' && $nomedoprotetor =='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE NOME_ANIMAL LIKE '%".$nomedoanimal."%' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi != '' && $anoprocedi != '' && $clinica != '' && $realizado == '' && $codigo =='' && $nomedoanimal =='' && $nomedoprotetor =='' && $status=='' && $ativo !=''){
			$query = "SELECT * FROM AGENDAMENTO WHERE NOME_ANIMAL LIKE '%".$nomedoanimal."%' AND CLINICA ='$clinica' AND DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."%' AND ATIVO='".$ativo."' ORDER BY DATA_AG DESC";
		}
		
		if ($mesprocedi == '' && $anoprocedi == '' && $clinica == '' && $realizado == '' && $codigo =='' && $nomedoanimal !='' && $nomedoprotetor !='' && $status=='' && $ativo ==''){
			$query = "SELECT * FROM AGENDAMENTO WHERE NOME_ANIMAL LIKE '%".$nomedoanimal."%' AND RESPONSAVEL LIKE '%".$nomedoprotetor."%' ORDER BY DATA_AG DESC";
		}
		
		$select = mysqli_query($connect,$query);
    	$reccount = mysqli_num_rows($select);
		
			
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Meta tags Obrigatórias -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Pesquisa de agendamentos</title>
    
    <script  type="text/javascript">
      function store(){
         var codmult= document.getElementById("codmult");
         localStorage.setItem("codmult", codmult.value);
        }

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
				  case 'clinica':
				  	include_once("menu_vet.php") ;
					break;
				  
			  }
		
?>
<br><br>
<main role="main" class="container">
    <div class="starter-template">
    <center>
        <h3> PESQUISA DE AGENDAMENTOS</h3><br>
<?php 			

        /*echo "<br>codigo: ".$codigo;
        echo "<br>nomedoanimal: ".$nomedoanimal;
        echo "<br>nomedotutor: ".$nomedoprotetor ;
        echo "<br>status: ".$status;
        echo "<br>clinica: ".$clinica;
        echo "<br>ativo: ".$ativo;
        echo "<br>realizado: ".$realizado;
        echo "<br>parm: ".$parm; */
        
		if ($reccount == 0) {
			echo "Nenhum agendamento encontrado <br><br>";
		}else{ 
			echo "<table class='table'>";
            echo "<thead class='thead-light'>";
            echo "<th scope='col'>Código</th>";
            echo "<th scope='col'>Data</th>";
            echo "<th scope='col'>Animal</th>";
            echo "<th scope='col'>Espécie</th>";
            echo "<th scope='col'>Responsável</th>";
            /*echo "<th scope='col'>Procedimento</th>";*/
            echo "<th scope='col'>Clínica</th>";
            echo "<th scope='col'>Ativo</th>";
            echo "<th scope='col'>Realizado</th>";
            echo "<th scope='col'>Valor</th>";
            /*echo "<th scope='col' colspan='3'>Realizado</th>";*/
            echo "</thead>";
            echo "<tbody>";
			while ($fetch = mysqli_fetch_row($select)) {
					$codmult = $fetch[0];	
					$datamulti = $fetch[1];
					$horamulti = $fetch[2];
					$nomedoanimal = $fetch[3];
					$especie = $fetch[4];
					$responsavel  = $fetch[9];
					$autorizadopor = $fetch[10];
					$clinica = $fetch[19];
					$tipoprocedi = $fetch[20];
					$ativo = $fetch[18];
					$idvet = $fetch[17];
					$realizado = $fetch[24];
					$valorajuda = $fetch[13];
					$id_registro = $fetch[28];
					
					$queryvet = "SELECT * FROM CLINICAS WHERE ID='$clinica'";
                    $selectvet = mysqli_query($connect,$queryvet);
                    
                    while ($fetchvet = mysqli_fetch_row($selectvet)) {
                    	    $nomevet = $fetchvet[1];
                    }
					
					$ano_proc = substr($datamulti,0,4);
        		    $mes_proc = substr($datamulti,5,2);
        		    $dia_proc = substr($datamulti,8,2);
        		    
                    echo "<tr>";
                    echo "<td>";
					echo $codmult;
					echo "<input type='text' name='codmult' id='codmult' value='".$codmult."' hidden>";
					echo "</td>";
					echo "<td>";
					echo $dia_proc."/".$mes_proc."/".$ano_proc;
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
					/*echo "<td>";
					echo $tipoprocedi;
					echo "</td>";*/
					echo "<td>";
					echo $nomevet;
					echo "</td>";
					echo "<td>";
					echo $ativo;
					echo "</td>";
					echo "<td>";
					echo $realizado;
					echo "</td>";
					echo "<td>";
					echo $valorajuda;
					echo "</td>";
					
					echo "<td>";
					echo "<a href='formatualizaprocedi.php?cod=".$codmult."'>Atualizar</a>";   
    				echo "</td>";
    				echo "<td>";
					if ($area =='diretoria') {
    					    echo "<a href='deletaagenda.php?id=".$id_registro."'>Cancelar</a>";
    				} 
    				echo "</td>";
    				echo "<td>";
    				echo "<a href='procedimento.php?cod=".$codmult."' target='_blank'>Ver voucher</a>";
					echo "</td>";
					//echo "<a href='procedimento.php?cod=".$codmult."' target='_blank'>Ver voucher</a>";
					/*echo "<td><a href='viewagenda.php?id=".$fetch[0]."' target='_blank'><button type='button' class='btn btn-primary' title='Visualizar'>
        					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                </svg>
                                            </button></a></td>";*/
					echo "</tr>";
			}
		echo "</tbody>";
		echo "</table>";
		mysqli_data_seek($select, 0 );

		echo "<center>".$reccount." agendamentos encontrados <br><br></center>";
		}
		
		echo "<center><a href='formpesquisaagenda.php' class='btn btn-primary'>Nova pesquisa</a></center>";
		mysqli_close($connect);
?>
    </center>
    </div>
</main>
<br><br><br><br>
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
<? } ?>
</html>