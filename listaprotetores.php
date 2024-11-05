<?php 		
		/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
$login = $_SESSION['login'];
$ano_atu = date("Y");
$mes_atu = date("m");
$area_interesse = $_POST['area_interesse'];

if($login == "" || $login == null){
		  echo"<script language='javasript' type='text/javscript'>
		  alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{

    $queryarea = "SELECT * FROM VOLUNTARIOS WHERE USUARIO ='$login'";
    $selectarea = mysqli_query($connect,$queryarea);
    
    while ($fetcharea = mysqli_fetch_row($selectarea)) {
    		$area = $fetcharea[5];
    		$subarea = $fetcharea[6];
    		
    }
    
    function castracoes_gratis_mes($anocastracao,$mescastracao,$id_protetor,$connect){
				$querycastrames = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE DATA_AG LIKE '".$anocastracao."-".$mescastracao."-%' AND ID_PROTETOR = '".$id_protetor."' AND VALOR_AJUDA='0' AND ATIVO<>'CANCELADO'";
				//$querycastrames = "SELECT COUNT(ID) FROM PEDIDO_CASTRACAO WHERE DATA_REG LIKE '".$anocastracao."-".$mescastracao."-%' AND ID_PROTETOR = '".$id_protetor."' AND VALOR_AJUDA='0'";
				$resultcastrames = mysqli_query($connect,$querycastrames);
				$rc = mysqli_fetch_row($resultcastrames);
			    $sum = $rc[0];
			    
			    if ($sum ==""){
			        $sum = 0;
			    }

				return($sum);
	}
	
	function castracoes_pagas_mes($anocastracao,$mescastracao,$id_protetor,$connect){
				$querycastrames = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE DATA_AG LIKE '".$anocastracao."-".$mescastracao."-%' AND ID_PROTETOR = '".$id_protetor."' AND VALOR_AJUDA <>'0' AND ATIVO<>'CANCELADO'";
				//$querycastrames ="SELECT COUNT(ID) FROM PEDIDO_CASTRACAO WHERE DATA_REG LIKE '".$anocastracao."-".$mescastracao."-%' AND ID_PROTETOR = '".$id_protetor."' AND VALOR_AJUDA <> '0'";
				$resultcastrames = mysqli_query($connect,$querycastrames);
				$rc = mysqli_fetch_row($resultcastrames);
			    $sum = $rc[0];
			    
			    if ($sum ==""){
			        $sum = 0;
			    }

				return($sum);
	}
	
	function castracoes_ano($anocastracao,$id_protetor,$connect){
				$querycastraano = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE DATA_AG LIKE '".$anocastracao."-%' AND ID_PROTETOR = '".$id_protetor."' AND ATIVO<>'CANCELADO'";
				//$querycastraano = "SELECT COUNT(ID) FROM PEDIDO_CASTRACAO WHERE DATA_REG LIKE '".$anocastracao."-%' AND ID_PROTETOR = '".$id_protetor."'";
				$resultcastraano = mysqli_query($connect,$querycastraano);
				$rc = mysqli_fetch_row($resultcastraano);
			    $sum = $rc[0];
			    
			    if ($sum ==""){
			        $sum = 0;
			    }

				return($sum);
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
    
    <title>GAAR - Lista de protetores</title>
    
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
        <h3>LISTA DE PROTETORES INDEPENDENTES</h3><br>
        <p><label> Aqui estão todos os protetores cadastrados ativos, inativos e esperando aprovação.</label></p>
       <h5>PROTETORES ATIVOS</h3>
       </center>
<?php 		

        $query = "SELECT * FROM PROTETORES WHERE SITUACAO<>'INATIVO' ORDER BY NOME ASC"; 
		$select = mysqli_query($connect,$query);
		$reccount = mysqli_num_rows($select);

		if ($reccount == 0) {
			echo "<center>Nenhum protetor encontrado <br></center>";
		}else{ 
		    echo "<table class='table'>";
		    echo "<thead class='thead-dark  th-header'>
				    <tr>";
			echo "<th scope='col' colspan='6'>&nbsp;</th>";
			echo "<th scope='col' colspan='2'><center>Pedidos mensais aprovados</center></th>";
			echo "<th scope='col' colspan='1'>&nbsp;</th>";
			echo "<th scope='col' colspan='1'>&nbsp;</th>";
		    echo "</thead>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>Código</th>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>Telefone</th>";
        	echo "<th scope='col'>E-mail</th>";
        	echo "<th scope='col'>Bairro</th>";
        	echo "<th scope='col'>Cidade</th>";
        	echo "<th scope='col'>Gratuitos</th>";
        	echo "<th scope='col'>Pagos</th>";
        	echo "<th scope='col'>Pedidos anuais</th>";
        	echo "<th scope='col'>Status</th>";
        	echo "</thead>";
        	echo "<tbody>";
			while ($fetch = mysqli_fetch_row($select)) {
			        $idprotetor = $fetch[0];	
			        $nomeprotetor = $fetch[1];	
			        $telprotetor = $fetch[2];	
			        $emailprotetor = $fetch[3];	
					$bairroprotetor = $fetch[4];
					$cidadeprotetor = $fetch[5];
					$status = $fetch[9];
					
					$castracoes_gratis_mes = castracoes_gratis_mes($ano_atu,$mes_atu,$idprotetor,$connect);
					$castracoes_pagas_mes = castracoes_pagas_mes($ano_atu,$mes_atu,$idprotetor,$connect);
					$castracoes_ano = castracoes_ano($ano_atu,$idprotetor,$connect);
					
					echo "<tr>";
					echo "<td>".$idprotetor."</td>";
					echo "<td>".$nomeprotetor."</td>";
					echo "<td>".$telprotetor."</td>";
					echo "<td>".$emailprotetor."</td>";
					echo "<td>".$bairroprotetor."</td>";
					echo "<td>".$cidadeprotetor."</td>";
					echo "<td>".$castracoes_gratis_mes."</td>";
					echo "<td>".$castracoes_pagas_mes."</td>";
					echo "<td>".$castracoes_ano."</td>";
					/*echo "<td><a href='viewprotetor.php?id=".$idprotetor."'><button type='button' class='btn btn-primary' title='Visualizar'>
        					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                </svg>
                            </button></a></td>";*/
                    if ($status=="Esperando aprovação") {
                        echo "<td><a href='alterarstatusprot.php?id=".$idprotetor."&action=u'>Aprovar</a></td>";
                        echo "<td><a href='alterarstatusprot.php?id=".$idprotetor."&action=d'>Reprovar</a></td>";
                    } else {
                        echo "<td>".$status."</td>";  
                        echo "<td><a href='https://gaarcampinas.org/meusagendamentos.php?id=".$idprotetor."' target='_blank'>Agendamentos</td>";   
                    }
					echo "</tr>";
					
			}
			echo "</tbody>
			      </table> <br>";
			      

		}
		
?>
<center><h5>PROTETORES ESPERANDO APROVAÇÀO</h3>
<?
		$queryaprovacao = "SELECT * FROM PROTETORES WHERE SITUACAO='Esperando aprovação' ORDER BY NOME ASC"; 
		$selectaprovacao = mysqli_query($connect,$queryaprovacao);
		$reccountaprovacao = mysqli_num_rows($selectaprovacao);


		if ($reccountaprovacao <> 0) {
		    echo "<table class='table'>";
		    echo "<thead class='thead-dark  th-header'>
				    <tr>";
			echo "<th scope='col' colspan='6'>&nbsp;</th>";
		    echo "</thead>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>Código</th>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>Telefone</th>";
        	echo "<th scope='col'>E-mail</th>";
        	echo "<th scope='col'>Bairro</th>";
        	echo "<th scope='col'>Cidade</th>";
        	echo "</thead>";
        	echo "<tbody>";
			while ($fetchaprovacao = mysqli_fetch_row($selectaprovacao)) {
			        $idprotetor = $fetchaprovacao[0];	
			        $nomeprotetor = $fetchaprovacao[1];	
			        $telprotetor = $fetchaprovacao[2];	
			        $emailprotetor = $fetchaprovacao[3];	
					$bairroprotetor = $fetchaprovacao[4];
					$cidadeprotetor = $fetchaprovacao[5];
					$status = $fetchaprovacao[9];
					
					echo "<tr>";
					echo "<td>".$idprotetor."</td>";
					echo "<td>".$nomeprotetor."</td>";
					echo "<td>".$telprotetor."</td>";
					echo "<td>".$emailprotetor."</td>";
					echo "<td>".$bairroprotetor."</td>";
					echo "<td>".$cidadeprotetor."</td>";
					echo "</tr>";
			}
			echo "</tbody>
			      </table> <br>";
			      

		} else {
		    echo "<p> Nenhum protetor esperando aprovação.</p>";
		}

?>
        </center>
        
<center><h5>PROTETORES INATIVOS</h3>
<?
		$queryinativo = "SELECT * FROM PROTETORES WHERE SITUACAO='INATIVO' ORDER BY NOME ASC"; 
		$selectinativo = mysqli_query($connect,$queryinativo);
		$reccountinativo = mysqli_num_rows($selectinativo);


		if ($reccountinativo <> 0) {
		    echo "<table class='table'>";
		    echo "<thead class='thead-dark  th-header'>
				    <tr>";
			echo "<th scope='col' colspan='6'>&nbsp;</th>";
		    echo "</thead>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>Código</th>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>Telefone</th>";
        	echo "<th scope='col'>E-mail</th>";
        	echo "<th scope='col'>Bairro</th>";
        	echo "<th scope='col'>Cidade</th>";
        	echo "</thead>";
        	echo "<tbody>";
			while ($fetchinativo = mysqli_fetch_row($selectinativo)) {
			        $idprotetor = $fetchinativo[0];	
			        $nomeprotetor = $fetchinativo[1];	
			        $telprotetor = $fetchinativo[2];	
			        $emailprotetor = $fetchinativo[3];	
					$bairroprotetor = $fetchinativo[4];
					$cidadeprotetor = $fetchinativo[5];
					$status = $fetchinativo[9];
					
					echo "<tr>";
					echo "<td>".$idprotetor."</td>";
					echo "<td>".$nomeprotetor."</td>";
					echo "<td>".$telprotetor."</td>";
					echo "<td>".$emailprotetor."</td>";
					echo "<td>".$bairroprotetor."</td>";
					echo "<td>".$cidadeprotetor."</td>";
					echo "</tr>";
			}
			echo "</tbody>
			      </table> <br>";
			      

		} else {
		    echo "<p> Nenhum protetor inativo.</p>";
		}
		echo "<center><a href=\"javascript:window.history.go(-1)\" class=\"links\">Voltar</a></center>";
		
}
mysqli_close($connect);
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

