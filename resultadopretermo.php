<?php
session_start();

include ("conexao.php");

$login = $_SESSION['login'];
$idtermo = $_GET['idtermo'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
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
    
    <title>GAAR - Pesquisa de pré termo online</title>
    
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
			  
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
<?php

$nomeanimal = $_POST['nomedoanimal'];
$nomedointeressado = $_POST ['nomedointeressado'];
$especie = $_POST['especie'];
$respondido = $_POST['respondido'];
$reprovado = $_POST['reprovado'];
$nomedointeressado_livre = $_POST['nomedointeressado_livre'];
$emaildointeressado = $_POST['emaildointeressado'];

if ($nomeanimal == '' && $especie == '' && ($respondido == 'Não' || $respondido == '') && ($nomedointeressado == '' || $nomedointeressado_livre != '')  && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 1";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE NOME_COMPLETO like '%".$nomedointeressado_livre."%'  ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}

if ($nomeanimal != '' && $especie == '' && $respondido == 'Não' && ($respondido == 'Não' || $respondido == '') && $nomedointeressado == '' && $nomedointeressado_livre == '' && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 2";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE REPROVADO <> 'Sim' AND  NOME_ANIMAL like '%".$nomeanimal."'  ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
			echo "<br> reccount: ".$reccount;
}

if ($nomeanimal != '' && $especie != '' && $respondido == 'Não' && ($respondido == 'Não' || $respondido == '') && $nomedointeressado == '' && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 3";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE REPROVADO <> 'Sim' AND  NOME_ANIMAL like '%".$nomeanimal."' and ESPECIE = '$especie'  ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}

if ($nomeanimal != '' && $especie == '' && $respondido == 'Não' && ($respondido == 'Não' || $respondido == '') && $nomedointeressado == '' && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 4";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE REPROVADO <> 'Sim' AND  NOME_ANIMAL like '%".$nomeanimal."'   ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
			
}

if ($nomeanimal != '' && $especie == '' && $respondido == 'Sim' && ($respondido == 'Não' || $respondido == '') && $nomedointeressado == '' && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 5";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE REPROVADO <> 'Sim' AND  NOME_ANIMAL like '%".$nomeanimal."'   ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
			
}

if ($nomeanimal == '' && $especie != '' &&  $respondido == 'Não' && ($respondido == 'Não' || $respondido == '') && $nomedointeressado == '' && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 6";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE REPROVADO <> 'Sim' AND  ESPECIE = '$especie'  ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);

}	

if ($nomeanimal == '' && $especie != '' &&  $respondido == '' && ($respondido == 'Não' || $respondido == '') && $nomedointeressado == '' && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 7";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE REPROVADO <> 'Sim' AND  ESPECIE = '$especie' ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
			
}	

if ($nomeanimal == '' && $especie != '' &&  $respondido == 'Sim' && ($respondido == 'Não' || $respondido == '') && $nomedointeressado == '' && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 8";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE REPROVADO <> 'Sim' AND  ESPECIE = '$especie'  ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
			
}

if ($especie == '' && $nomeanimal == '' && ($respondido == 'Não' || $respondido == '') && ($reprovado == '' || $reprovado == 'Não') && $nomedointeressado == '' && $nomedointeressado_livre == '' && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 9";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE REPROVADO <> 'Sim' ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
			
}	

if ($especie == '' && $nomeanimal == '' && $respondido == 'Sim' && ($reprovado == '' || $reprovado == 'Não') && $nomedointeressado == '' && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 10";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE REPROVADO <> 'Sim' ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
			
}	 


if ($nomeanimal == '' && $especie == '' && $respondido == '' && ($reprovado == '' || $reprovado == 'Não') && $nomedointeressado != '' && $emaildointeressado == '') {
			/*echo "<br>caiu aqui 12";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE REPROVADO <> 'Sim' AND NOME_COMPLETO = '$nomedointeressado' ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}

if ($nomeanimal != '' && $especie == '' && $respondido == '' && ($reprovado == '' || $reprovado == 'Não') && $nomedointeressado != '' && $emaildointeressado == '') {
			/*echo "<br>caiu aqui 12";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE NOME_ANIMAL like '%".$nomeanimal."' AND NOME_COMPLETO = '$nomedointeressado' ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}

if ($nomeanimal != '' && $especie == '' && $respondido == '' && ($reprovado == '' || $reprovado == 'Não') && $nomedointeressado == '' && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 13";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE NOME_ANIMAL like '%".$nomeanimal."' ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}

if ($nomeanimal == '' && $especie == '' && $respondido != '' && $reprovado == '' && $nomedointeressado == '' && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 13";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE OBS = '' ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}

if ($nomeanimal == '' && $especie != '' && $respondido != '' && $reprovado == '' && $nomedointeressado == '' && $emaildointeressado == '') {
            /*echo "<br>caiu aqui 13";*/
			$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE OBS = '' AND ESPECIE='".$especie."'ORDER BY ID DESC LIMIT 50";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}

if ($reprovado == 'Sim'){
    /*echo "<br>caiu aqui 15";*/
    $query = "SELECT * FROM REPROVADOS";
	$selectreprova = mysqli_query($connect,$query);
	$reccount = mysqli_num_rows($selectreprova);
	
}

if ($nomeanimal == '' && $especie == '' && ($respondido == 'Não' || $respondido == '') && ($nomedointeressado == '' || $nomedointeressado_livre != '')  && $emaildointeressado != '') {
    /*echo "<br>caiu aqui 16";*/
    $query = "SELECT * FROM FORM_PRE_ADOCAO WHERE EMAIL = '$emaildointeressado'";
	$select = mysqli_query($connect,$query);
	$reccount = mysqli_num_rows($select);
	
}


?>
<center>
    <br>
<?	

		if ($reccount == 0) {
		    echo "<center>Nenhum pré termo encontrado<br>";
		}else{ 
		   if ($reprovado == 'Não' || $reprovado == ''){ 
        		    echo "<h2> PRÉ TERMOS ONLINE</h2><br>";
        		    echo "<center>É proibida a reprodução, parcial ou total, dos dados pessoais aqui apresentados sem prévia autorização. Todas as informações estão protegidas pela Lei Geral de Proteção de Dados Pessoais (LGPD) - LEI Nº 13.709, DE 14 DE AGOSTO DE 2018. Conheça a lei na íntegra clicando <a href='http://www.planalto.gov.br/ccivil_03/_Ato2015-2018/2018/Lei/L13709.htm' target='_blank'>aqui</a>. </center><br>";
        		    echo "<p> Serão exibidos os últimos 50 pré termos de adoção recebidos. Pré termos reprovados não serão exibidos, para consultá-los acesse <a href='pesquisareprova.php' target='_blank'>a lista de reprovados</a></p><br>";
        			echo "<table class='table'>";
                    echo "<thead class='thead-light'>";
                	echo "<th scope='col'>Número</th>";
                	echo "<th scope='col'>Interessado</th>";
                	echo "<th scope='col'>Animal interessado</th>";
                	echo "<th scope='col'>Espécie</th>";
                	/*echo "<th scope='col'>Lar temporário</th>";*/
                	echo "<th scope='col'>Responsável</th>";
                	echo "<th scope='col'>Recebido em</th>";
                	echo "<th scope='col'>Observações</th>";
                	echo "<th scope='col' colspan='5'>&nbsp;</th>";
                	echo "</thead>";
                    while ($fetch = mysqli_fetch_row($select)) {
        					$idpretermo = $fetch[0];	
        					$interessado = $fetch[1];
        					$nomeanimal = $fetch[11];
        					$especie = $fetch[12];
        					$email = $fetch[3];
        					$celular = $fetch[6];
        					$obs = $fetch[64];
        					$resp = $fetch[68];
        					$lt = $fetch[69];
        					if ($obs == '') {
        					    $obs = 'A responder';
        					}
        					$data_reg = $fetch[66];
                		    echo "<tbody>";
                			echo "<tr>";
                			echo "<td align='left'>".$idpretermo."</td>";
        					echo "<td align='left'>".$interessado."</td>";
        					echo "<td align='left'>".$nomeanimal."</td>";
        					echo "<td align='left'>".$especie."</td>";
        					/*echo "<td align='left'>".$lt."</td>";*/
        					echo "<td align='left'>".$resp."</td>";
        					echo "<td align='left'>".$data_reg."</td>";
        					echo "<td align='left'>".$obs."</td>";
        					echo "<td align='left'>
                                  <a href='visualizapretermo.php?idpretermo=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Visualizar'>
        					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                </svg>
                                  </button></a></td>
                                  <td align='left'><a href='formcadastroreprova.php?idpretermo=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Reprovar'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-square-fill' viewBox='0 0 16 16'>
                                          <path d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z'/>
                                        </svg>
                                  </button></a></td>
                                  <td align='left'>
                                  <a href='criatermoimpresso.php?idpretermo=".$fetch[0]."' target='_blank'><button type='button' class='btn btn-primary' title='Imprimir termo pré preenchido'>
                                  <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-printer' viewBox='0 0 16 16'>
                                      <path d='M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z'/>
                                      <path d='M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z'/>
                                    </svg></button></a></td>";
        					if ($area == 'diretoria'){
        					    echo "<td><a href='deletapretermo.php?idtermo=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Deletar'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                      </svg>
                                  </button></a></td>";
        					} else{
        					    echo "<td>&nbsp;</td>";
        					}
        					echo "</tr>";
        					echo "</tbody>";
        			}
        			        echo "</table>";
        		} else {
        		    echo "<script>document.location='pesquisareprova.php'</script>";
        		}
		}
?>
<br>
<a href="pesquisapretermo.php" class="btn btn-primary">Nova pesquisa</a> 
</center>
   </div>
   <? mysqli_close($connect); ?>
</main>
<br><br><br>
<footer class="footer fixed-bottom bg-light">
    <center>GAAR - GRUPO DE APOIO AO ANIMAL DE RUA</center>
</footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>