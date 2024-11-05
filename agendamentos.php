<?php 		
/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
$idvet = $_GET["id"];
$ano_atu = date("Y-m-d");
$data_atu = date("Y-m-d");
$data_seguinte = date("Y-m-d",strtotime('+1 days'));
$data_7days = date("Y-m-d",strtotime('+7 days'));
$data_7daysless = date("Y-m-d",strtotime('-7 days'));

$ano_atu = substr($data_atu,0,4);
$mes_atu = substr($data_atu,5,2);
$dia_atu = substr($data_atu,8,2);

$ano_seguinte = substr($data_seguinte,0,4);
$mes_seguinte = substr($data_seguinte,5,2);
$dia_seguinte = substr($data_seguinte,8,2);

$ano_7dias = substr($data_7days,0,4);
$mes_7dias = substr($data_7days,5,2);
$dia_7dias = substr($data_7days,8,2);
		
$query = "SELECT * FROM AGENDAMENTO WHERE DATA_AG ='".$data_atu."' AND CLINICA ='$idvet' AND ATIVO='SIM' ORDER BY DATA_AG,HORA_AG ASC";
$select = mysqli_query($connect,$query);
$reccount = mysqli_num_rows($select);

$querydiaseguinte = "SELECT * FROM AGENDAMENTO WHERE DATA_AG ='".$data_seguinte."' AND CLINICA ='$idvet' AND ATIVO='SIM' ORDER BY DATA_AG,HORA_AG ASC";
$selectdiaseguinte = mysqli_query($connect,$querydiaseguinte);
$reccountdiaseguinte = mysqli_num_rows($selectdiaseguinte);

$query7dias = "SELECT * FROM AGENDAMENTO WHERE DATA_AG >'".$data_atu."' AND DATA_AG <='$data_7days' AND CLINICA ='$idvet' AND ATIVO='SIM' ORDER BY DATA_AG,HORA_AG ASC";
$select7dias = mysqli_query($connect,$query7dias);
$reccount7dias = mysqli_num_rows($select7dias);

$queryrealizados = "SELECT * FROM AGENDAMENTO WHERE (DATA_AG >='".$ano_atu ."-01-01' AND DATA_AG <='".$data_atu."') AND ATIVO<>'SIM' AND CLINICA ='$idvet' ORDER BY DATA_AG DESC";
$selectrealizados = mysqli_query($connect,$queryrealizados);
$reccountrealizados = mysqli_num_rows($selectrealizados);

$querycancelados = "SELECT * FROM AGENDAMENTO WHERE (DATA_AG <='".$data_atu."' AND DATA_AG >'".$data_7daysless."') AND CLINICA ='$idvet' AND ATIVO='CANCELADO' ORDER BY DATA_AG DESC LIMIT 10";
$selectcancelados = mysqli_query($connect,$querycancelados);
$reccountcancelados = mysqli_num_rows($selectcancelados);

$queryvet = "SELECT * FROM CLINICAS WHERE ID='$idvet'";
$selectvet = mysqli_query($connect,$queryvet);

while ($fetchvet = mysqli_fetch_row($selectvet)) {
	    $nomevet = $fetchvet[1];
}

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
    
    <title>GAAR - Agendamentos</title>
    
    <script  type="text/javascript">
      function store(){
         var codmult= document.getElementById("codmult");
         localStorage.setItem("codmult", codmult.value);
        }

    </script>

    
</head>
<body> 
<br><br>
<main role="main" class="container">
    <div class="starter-template">
    <center>
        <h3> <?echo $nomevet?></h3><br>
        <h4>AGENDAMENTOS DE HOJE</h4>
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
            echo "<th scope='col'>Horário</th>";
            echo "<th scope='col'>Animal</th>";
            echo "<th scope='col'>Espécie</th>";
            echo "<th scope='col'>Peso</th>";
            echo "<th scope='col'>Data de nascimento</th>";
            echo "<th scope='col'>Responsável</th>";
            echo "<th scope='col'>Telefone</th>";
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
					$dtnasc = $fetch[8];
					$responsavel  = $fetch[9];
					$telcontato = $fetch[11];
					$autorizadopor = $fetch[10];
					$clinica = $fetch[19];
					$tipoprocedi = $fetch[20];
					$ativo = $fetch[18];
					$idvet = $fetch[17];
					$realizado = $fetch[24];
					$valorajuda = $fetch[13];
					
					
					$ano_nasc = substr($dtnasc,0,4);
        		    $mes_nasc = substr($dtnasc,5,2);
        		    $dia_nasc = substr($dtnasc,8,2);
        		    
                    echo "<tr>";
                    echo "<td>";
					echo $codmult;
					echo "<input type='text' name='codmult' id='codmult' value='".$codmult."' hidden>";
					echo "</td>";
					echo "<td>";
					echo $horamulti;
					echo "</td>";
				    echo "<td>";
					echo $nomedoanimal;
					echo "</td>";
					echo "<td>";
					echo $especie;
					echo "</td>";
					echo "<td>";
					echo $peso."kg";
					echo "</td>";
					echo "<td>";
					echo $dia_nasc."/".$mes_nasc."/".$ano_nasc;
					echo "</td>";
					echo "<td>";
					echo $responsavel;
					echo "</td>";
					/*echo "<td>";
					echo $tipoprocedi;
					echo "</td>";*/
					echo "<td>";
					echo $telcontato;
					echo "</td>";
					echo "<td>";
					echo $valorajuda;
					echo "</td>";
					/*echo "<td>";
					echo $realizado;
					echo "</td>";*/
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
?>
<div id="divagendaseguinte" class="d-none">
<center>
        <h4> AGENDAMENTOS DE <?echo $dia_seguinte."/".$mes_seguinte."/".$ano_seguinte?></h4>
        <?
        if ($reccountdiaseguinte == 0) {
			echo "Nenhum agendamento encontrado <br><br>";
		}else{ 
			echo "<table class='table'>";
            echo "<thead class='thead-light'>";
            echo "<th scope='col'>Código</th>";
            echo "<th scope='col'>Horário</th>";
            echo "<th scope='col'>Animal</th>";
            echo "<th scope='col'>Espécie</th>";
            echo "<th scope='col'>Peso</th>";
            echo "<th scope='col'>Data de nascimento</th>";
            echo "<th scope='col'>Responsável</th>";
            echo "<th scope='col'>Telefone</th>";
            echo "<th scope='col'>Valor</th>";
            /*echo "<th scope='col' colspan='3'>Realizado</th>";*/
            echo "</thead>";
            echo "<tbody>";
			while ($fetchdiaseguinte = mysqli_fetch_row($selectdiaseguinte)) {
					$codmult = $fetchdiaseguinte[0];	
					$datamulti = $fetchdiaseguinte[1];
					$horamulti = $fetchdiaseguinte[2];
					$nomedoanimal = $fetchdiaseguinte[3];
					$especie = $fetchdiaseguinte[4];
					$peso = $fetchdiaseguinte[7];
					$dtnasc = $fetchdiaseguinte[8];
					$responsavel  = $fetchdiaseguinte[9];
					$telcontato = $fetchdiaseguinte[11];
					$autorizadopor = $fetchdiaseguinte[10];
					$clinica = $fetchdiaseguinte[19];
					$tipoprocedi = $fetchdiaseguinte[20];
					$ativo = $fetchdiaseguinte[18];
					$idvet = $fetchdiaseguinte[17];
					$realizado = $fetchdiaseguinte[24];
					$valorajuda = $fetchdiaseguinte[13];
					
					$ano_nasc = substr($dtnasc,0,4);
        		    $mes_nasc = substr($dtnasc,5,2);
        		    $dia_nasc = substr($dtnasc,8,2);
        		    
                    echo "<tr>";
                    echo "<td>";
					echo $codmult;
					echo "<input type='text' name='codmult' id='codmult' value='".$codmult."' hidden>";
					echo "</td>";
					echo "<td>";
					echo $horamulti;
					echo "</td>";
				    echo "<td>";
					echo $nomedoanimal;
					echo "</td>";
					echo "<td>";
					echo $especie;
					echo "</td>";
					echo "<td>";
					echo $peso."kg";
					echo "</td>";
					echo "<td>";
					echo $dia_nasc."/".$mes_nasc."/".$ano_nasc;
					echo "</td>";
					echo "<td>";
					echo $responsavel;
					echo "</td>";
					/*echo "<td>";
					echo $tipoprocedi;
					echo "</td>";*/
					echo "<td>";
					echo $telcontato;
					echo "</td>";
					echo "<td>";
					echo $valorajuda;
					echo "</td>";
					/*echo "<td>";
					echo $realizado;
					echo "</td>";*/
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
		mysqli_data_seek($selectdiaseguinte, 0 );

		echo "<center>".$reccountdiaseguinte." agendamentos encontrados <br><br></center>";
		}
        
        ?>
 </center>
</div>
<div id="divagendasemana" class="d-block">
<center>
        <h4> AGENDAMENTOS DA SEMANA </h4>
		<?
        if ($reccount7dias == 0) {
			echo "Nenhum agendamento encontrado <br><br>";
		}else{ 
			echo "<table class='table'>";
            echo "<thead class='thead-light'>";
            echo "<th scope='col'>Código</th>";
            echo "<th scope='col'>Data</th>";
            echo "<th scope='col'>Horário</th>";
            echo "<th scope='col'>Animal</th>";
            echo "<th scope='col'>Espécie</th>";
            echo "<th scope='col'>Peso</th>";
            echo "<th scope='col'>Data de nascimento</th>";
            echo "<th scope='col'>Responsável</th>";
            echo "<th scope='col'>Telefone</th>";
            echo "<th scope='col' colspan='1'>Valor</th>";
            echo "<th scope='col' colspan='2'>&nbsp;</th>";
            /*echo "<th scope='col' colspan='3'>Realizado</th>";*/
            echo "</thead>";
            echo "<tbody>";
			while ($fetch7dias = mysqli_fetch_row($select7dias)) {
					$codmult = $fetch7dias[0];	
					$datamulti = $fetch7dias[1];
					$horamulti = $fetch7dias[2];
					$nomedoanimal = $fetch7dias[3];
					$especie = $fetch7dias[4];
					$peso = $fetch7dias[7];
					$dtnasc = $fetch7dias[8];
					$responsavel  = $fetch7dias[9];
					$telcontato = $fetch7dias[11];
					$autorizadopor = $fetch7dias[10];
					$clinica = $fetch7dias[19];
					$tipoprocedi = $fetch7dias[20];
					$ativo = $fetch7dias[18];
					$idvet = $fetch7dias[17];
					$realizado = $fetch7dias[24];
					$valorajuda = $fetch7dias[13];
					
					
					$ano_nasc = substr($dtnasc,0,4);
        		    $mes_nasc = substr($dtnasc,5,2);
        		    $dia_nasc = substr($dtnasc,8,2);
        		    
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
					echo $horamulti;
					echo "</td>";
				    echo "<td>";
					echo $nomedoanimal;
					echo "</td>";
					echo "<td>";
					echo $especie;
					echo "</td>";
					echo "<td>";
					echo $peso."kg";
					echo "</td>";
					echo "<td>";
					echo $dia_nasc."/".$mes_nasc."/".$ano_nasc;
					echo "</td>";
					echo "<td>";
					echo $responsavel;
					echo "</td>";
					/*echo "<td>";
					echo $tipoprocedi;
					echo "</td>";*/
					echo "<td>";
					echo $telcontato;
					echo "</td>";
					echo "<td>";
					echo $valorajuda;
					echo "</td>";
					/*echo "<td>";
					echo $realizado;
					echo "</td>";*/
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
		mysqli_data_seek($select7dias, 0 );

		echo "<center>".$reccount7dias." agendamentos encontrados <br><br></center>";
		}
        
        ?>
</center>
</div>
<div  id="divrealizados" class="d-block">
<center>
        <h4> AGENDAMENTOS JÁ REALIZADOS E/OU CANCELADOS</h4>
        <p>Seguem os agendamentos cadastrados no banco de dados para o ano de <? echo $ano_atu?></p>
		<?
        if ($reccountrealizados == 0) {
			echo "Nenhum agendamento encontrado <br><br>";
		}else{ 
			echo "<table class='table'>";
            echo "<thead class='thead-light'>";
            echo "<th scope='col'>Código</th>";
            echo "<th scope='col'>Data</th>";
            echo "<th scope='col'>Horário</th>";
            echo "<th scope='col'>Animal</th>";
            echo "<th scope='col'>Espécie</th>";
            //echo "<th scope='col'>Peso</th>";
            //echo "<th scope='col'>Data de nascimento</th>";
            echo "<th scope='col'>Responsável</th>";
            //echo "<th scope='col'>Telefone</th>";
            echo "<th scope='col'>Valor</th>";
            echo "<th scope='col' colspan='4'>Status</th>";
            /*echo "<th scope='col' colspan='3'>Realizado</th>";*/
            echo "</thead>";
            echo "<tbody>";
			while ($fetchrealizados = mysqli_fetch_row($selectrealizados)) {
					$codmult = $fetchrealizados[0];	
					$datamulti = $fetchrealizados[1];
					$horamulti = $fetchrealizados[2];
					$nomedoanimal = $fetchrealizados[3];
					$especie = $fetchrealizados[4];
					$peso = $fetchrealizados[7];
					$dtnasc = $fetchrealizados[8];
					$responsavel  = $fetchrealizados[9];
					$telcontato = $fetchrealizados[11];
					$autorizadopor = $fetchrealizados[10];
					$clinica = $fetchrealizados[19];
					$tipoprocedi = $fetchrealizados[20];
					$ativo = $fetchrealizados[18];
					$idprotetor = $fetchrealizados[17];
					$realizado = $fetchrealizados[24];
					$valorajuda = $fetchrealizados[13];
					
					if ($ativo=='SIM'){
					    $ativo='Ativo';
					} else {
					    $ativo='Cancelado/Inativo';
					}
					
					$ano_nasc = substr($dtnasc,0,4);
        		    $mes_nasc = substr($dtnasc,5,2);
        		    $dia_nasc = substr($dtnasc,8,2);
        		    
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
					echo $horamulti;
					echo "</td>";
				    echo "<td>";
					echo $nomedoanimal;
					echo "</td>";
					echo "<td>";
					echo $especie;
					echo "</td>";
					/*echo "<td>";
					echo $peso."kg";
					echo "</td>";
					echo "<td>";
					echo $dia_nasc."/".$mes_nasc."/".$ano_nasc;
					echo "</td>";*/
					echo "<td>";
					echo $responsavel;
					echo "</td>";
					/*echo "<td>";
					echo $tipoprocedi;
					echo "</td>";
					echo "<td>";
					echo $telcontato;
					echo "</td>";*/
					echo "<td>";
					echo $valorajuda;
					echo "</td>";
					echo "<td>";
					echo $ativo;
					echo "</td>";
					echo "<td>";
    				echo "<a href='procedimento.php?cod=".$codmult."&user=vet' target='_blank'>Ver voucher</a>";
					echo "</td>";
					/*echo "<td>";
					echo $realizado;
					echo "</td>";
    				
					echo "<td>";
					echo "<a href='deletaagenda.php?cod=".$codmult."'>Cancelar</a>";
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
		mysqli_data_seek($fetchrealizados, 0 );

		echo "<center>".$reccountrealizados." agendamentos encontrados <br><br></center>";
		}
        
        ?>
    </center>
</div>
<div  id="divcancelados" class="d-block">
<center>
        <h4> AGENDAMENTOS CANCELADOS</h4>
        <p>Seguem os agendamentos cancelados no banco de dados para os últimos 7 dias</p>
		<?
        if ($reccountcancelados == 0) {
			echo "Nenhum agendamento encontrado <br><br>";
		}else{ 
			echo "<table class='table'>";
            echo "<thead class='thead-light'>";
            echo "<th scope='col'>Código</th>";
            echo "<th scope='col'>Data</th>";
            echo "<th scope='col'>Horário</th>";
            echo "<th scope='col'>Animal</th>";
            echo "<th scope='col'>Espécie</th>";
            //echo "<th scope='col'>Peso</th>";
            //echo "<th scope='col'>Data de nascimento</th>";
            echo "<th scope='col'>Responsável</th>";
            //echo "<th scope='col'>Telefone</th>";
            echo "<th scope='col'>Valor</th>";
            echo "<th scope='col' colspan='4'>Status</th>";
            /*echo "<th scope='col' colspan='3'>Realizado</th>";*/
            echo "</thead>";
            echo "<tbody>";
			while ($fetchcancelados = mysqli_fetch_row($selectcancelados)) {
					$codmult = $fetchcancelados[0];	
					$datamulti = $fetchcancelados[1];
					$horamulti = $fetchcancelados[2];
					$nomedoanimal = $fetchcancelados[3];
					$especie = $fetchcancelados[4];
					$peso = $fetchcancelados[7];
					$dtnasc = $fetchcancelados[8];
					$responsavel  = $fetchcancelados[9];
					$telcontato = $fetchcancelados[11];
					$autorizadopor = $fetchcancelados[10];
					$clinica = $fetchcancelados[19];
					$tipoprocedi = $fetchcancelados[20];
					$ativo = $fetchcancelados[18];
					$idprotetor = $fetchcancelados[17];
					$realizado = $fetchcancelados[24];
					$valorajuda = $fetchcancelados[13];

					$ano_nasc = substr($dtnasc,0,4);
        		    $mes_nasc = substr($dtnasc,5,2);
        		    $dia_nasc = substr($dtnasc,8,2);
        		    
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
					echo $horamulti;
					echo "</td>";
				    echo "<td>";
					echo $nomedoanimal;
					echo "</td>";
					echo "<td>";
					echo $especie;
					echo "</td>";
					/*echo "<td>";
					echo $peso."kg";
					echo "</td>";
					echo "<td>";
					echo $dia_nasc."/".$mes_nasc."/".$ano_nasc;
					echo "</td>";*/
					echo "<td>";
					echo $responsavel;
					echo "</td>";
					/*echo "<td>";
					echo $tipoprocedi;
					echo "</td>";
					echo "<td>";
					echo $telcontato;
					echo "</td>";*/
					echo "<td>";
					echo $valorajuda;
					echo "</td>";
					echo "<td>";
					echo $ativo;
					echo "</td>";
					/*echo "<td>";
    				echo "<a href='procedimento.php?cod=".$codmult."&user=vet' target='_blank'>Ver voucher</a>";
					echo "</td>";
					/*echo "<td>";
					echo $realizado;
					echo "</td>";
    				
					echo "<td>";
					echo "<a href='deletaagenda.php?cod=".$codmult."'>Cancelar</a>";
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
		mysqli_data_seek($fetchcancelados, 0 );

		echo "<center>".$reccountcancelados." agendamentos encontrados <br><br></center>";
		}
        
        ?>
</center>
</div>

<?
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
</html>