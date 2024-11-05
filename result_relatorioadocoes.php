<?
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$dia01 = "01";

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
		  
		$anoadocao = $_POST['anoadocao'];
		$anoprocedi = $_POST['anoprocedi'];
		$anocastra = $_POST['anocastra'];
		$mesadocao = $_POST['mesadocao'];
		$mesprocedi = $_POST['mesprocedi'];
		$mescastra = $_POST['mescastra'];
		$localadocao = $_POST['localadocao'];
		$tiporelatorio = $_POST['tiporelatorio'];
		$lt = $_POST['lt'];
		$nomelt = $_POST['nomelt'];
		$tipolt = $_POST['tipolt'];
		$foto = $_POST['foto'];
		$comtermos = $_POST['comtermos'];
		$nomeresp = $_POST['nomeresp'];
		$selectstatusespeciecanina = $_POST['selectstatusespeciecanina'];
		$selectstatusespeciefelina = $_POST['selectstatusespeciefelina'];

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
    
    <style>
        .th-header {background-color: #0000A0;}
        
    </style>
    
    <script type="text/javascript">
        window.onload = function() {
          document.getElementById('text-print-relatorio').style.display = 'none';
        };
    </script>
    
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
        <div class="d-none d-print-block">
            <center><img src="/area/logo_transparent.png" width="70" height="70"></center>
        </div>
        <br><center><h2>RELATÓRIO OPERACIONAL</h2></center><br>
<?
		
		function animais_lt($connect){
				$querylocal = "SELECT * FROM ANIMAIS";
				$resultlocal = mysqli_query($querylocal,$connect);
				$rc= mysqli_num_rows($resultlocal);	
											
				return($rc);
		}
		
		function lista_presenca($ano_atu,$mes,$nomevolfeira,$connect){
				$querypresenca = "SELECT COUNT(NOME_VOLUNTARIO) FROM LISTA_DE_PRESENCA WHERE NOME_VOLUNTARIO='$nomevolfeira' AND DATA_FEIRA LIKE '".$ano_atu."-%'";
				$resultlocal = mysqli_query($connect,$querypresenca);
				$rc = mysqli_fetch_row($resultlocal);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function ultima_feira($ano_atu,$mes,$nomevolfeira,$connect){
				$querypresenca = "SELECT MAX(DATA_FEIRA) FROM LISTA_DE_PRESENCA WHERE NOME_VOLUNTARIO='$nomevolfeira'";
				$resultlocal = mysqli_query($connect,$querypresenca);
				$rc = mysqli_fetch_row($resultlocal);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
	
		function local_adocao($anoadocao,$mesadocao,$local_adocao,$connect){
				$querylocal = "SELECT * FROM TERMO_ADOCAO WHERE DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."%' and LOCAL_ADOCAO = '".$local_adocao."'";
				$resultlocal = mysqli_query($connect,$querylocal);
				$rc= mysqli_num_rows($resultlocal);	
											
				return($rc);
		}
		
		function exames_mensal($anoprocedi,$mesprocedi,$connect){
				$queryexames = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Exame' AND STATUS_PROC='Aprovado' AND DATA LIKE '".$anoprocedi."-".$mesprocedi."-%'";
				$resultexames = mysqli_query($connect,$queryexames);
			    $rc = mysqli_fetch_row($resultexames);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function vacina_caes_mensal($anoprocedi,$mesprocedi,$connect){
				$queryvacinadog = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Vacina' AND STATUS_PROC='Aprovado' AND ESPECIE='Canina' AND DATA LIKE '".$anoprocedi."-".$mesprocedi."-%'";
				$resultvacinadog = mysqli_query($connect,$queryvacinadog);
			    $rc = mysqli_fetch_row($resultvacinadog);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function vacina_gatos_mensal($anoprocedi,$mesprocedi,$connect){
				$queryvacinacat = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Vacina' AND STATUS_PROC='Aprovado' AND ESPECIE='Felina' AND DATA LIKE '".$anoprocedi."-".$mesprocedi."-%'";
				$resultvacinacat = mysqli_query($connect,$queryvacinacat);
			    $rc = mysqli_fetch_row($resultvacinacat);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function castrados_total_caes($anoadocao,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO WHERE DATA_ADOCAO LIKE '".$anoadocao."-%' AND ESPECIE='Canina' AND CASTRADO = 'Sim'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);
						
				return($rc);
		}

		
		function castrados_total_gatos($anoadocao,$connect){
				$querygatos = "SELECT * FROM TERMO_ADOCAO WHERE DATA_ADOCAO LIKE '".$anoadocao."-%' AND ESPECIE='Felina' AND CASTRADO = 'Sim'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc= mysqli_num_rows($resultgatos);	
				
				
				if ($sum ==''){
			        $sum = 0;
			    }
											
				return($rc);
		}
		
		function castracao_total_caes_machos($anoprocedi,$connect){
				//$querycaes = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Canina' AND SEXO='Macho' AND DATA LIKE '".$anoprocedi."-%'";
				$querycaes = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='Canina' AND SEXO='Macho' AND DATA_AG LIKE '".$anoprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc = mysqli_fetch_row($resultcaes);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function castracao_total_caes_femeas($anoprocedi,$connect){
				//$querycaes = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Canina' AND SEXO='Fêmea' AND DATA LIKE '".$anoprocedi."-%'";
				$querycaes = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='Canina' AND SEXO='Fêmea' AND DATA_AG LIKE '".$anoprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc = mysqli_fetch_row($resultcaes);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}

        function castracao_total_caes($anoprocedi,$connect){
				//$querycaes = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Canina' AND DATA LIKE '".$anoprocedi."-%'";
				$querycaes = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='Canina' AND DATA_AG LIKE '".$anoprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc = mysqli_fetch_row($resultcaes);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		
		function castracao_total_gatos($anoprocedi,$connect){
				//$querygatos = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Felina' AND DATA LIKE '".$anoprocedi."-%'";
				$querygatos = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='Felina' AND DATA_AG LIKE '".$anoprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc = mysqli_fetch_row($resultgatos);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function castracao_total_gatos_machos($anoprocedi,$connect){
				//$querygatos = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Felina' AND SEXO='Macho' AND DATA LIKE '".$anoprocedi."-%'";
				$querygatos = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='Felina' AND SEXO='Macho' AND DATA_AG LIKE '".$anoprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc = mysqli_fetch_row($resultgatos);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function castracao_total_gatos_femeas($anoprocedi,$connect){
				//$querygatos = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Felina' AND SEXO='Fêmea' AND DATA LIKE '".$anoprocedi."-%'";
				$querygatos = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='Felina' AND SEXO='Fêmea' AND DATA_AG LIKE '".$anoprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc = mysqli_fetch_row($resultgatos);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function castracao_mensal_caes($anoprocedi,$mesprocedi,$connect){
				//$querycaes = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Canina' AND DATA LIKE '".$anoprocedi."-".$mesprocedi."-%'";
				$querycaes = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='Canina' AND DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc = mysqli_fetch_row($resultcaes);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function castracao_mensal_caes_machos($anoprocedi,$mesprocedi,$connect){
				//$querycaes = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Canina' AND SEXO='Macho' AND DATA LIKE '".$anoprocedi."-".$mesprocedi."-%'";
				$querycaes = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='Canina' AND SEXO='Macho' AND DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc = mysqli_fetch_row($resultcaes);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function castracao_mensal_caes_femeas($anoprocedi,$mesprocedi,$connect){
				//$querycaes = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Canina' AND SEXO='Fêmea' AND DATA LIKE '".$anoprocedi."-".$mesprocedi."-%'";
				$querycaes = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='Canina' AND SEXO='Fêmea' AND DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc = mysqli_fetch_row($resultcaes);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function castracao_mensal_gatos($anoprocedi,$mesprocedi,$connect){
				//$querygatos = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Felina' AND DATA LIKE '".$anoprocedi."-".$mesprocedi."-%'";
				$querygatos = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='Felina' AND DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc = mysqli_fetch_row($resultgatos);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}

		
		function castracao_mensal_gatos_machos($anoprocedi,$mesprocedi,$connect){
				//$querygatos = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Felina' AND SEXO='Macho' AND DATA LIKE '".$anoprocedi."-".$mesprocedi."-%'";
				$querygatos = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='Felina' AND SEXO='Macho' AND DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc = mysqli_fetch_row($resultgatos);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function castracao_mensal_gatos_femeas($anoprocedi,$mesprocedi,$connect){
				//$querygatos = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Felina' AND SEXO='Fêmea' AND DATA LIKE '".$anoprocedi."-".$mesprocedi."-%'";
				$querygatos = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='Felina' AND SEXO='Fêmea' AND DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc = mysqli_fetch_row($resultgatos);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function castracao_mensal_especie_protetor($anoprocedi, $nomeprotetora, $especie, $connect){
				//$querygatos = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Felina' AND SEXO='Fêmea' AND DATA LIKE '".$anoprocedi."-".$mesprocedi."-%'";
				$querygatos = "SELECT COUNT(CODIGO) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='".$especie."' AND RESPONSAVEL='".$nomeprotetora."' AND DATA_AG LIKE '".$anoprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc = mysqli_fetch_row($resultgatos);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function castracao_mensal_gaar_valor($anoprocedi, $mesprocedi, $especie, $connect){
				//$querygatos = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Felina' AND SEXO='Fêmea' AND DATA LIKE '".$anoprocedi."-".$mesprocedi."-%'";
				$querygatos = "SELECT SUM(VALOR_GAAR) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND ESPECIE='".$especie."' AND DATA_AG LIKE '".$anoprocedi."-".$mesprocedi."-%' AND ATIVO <> 'CANCELADO'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc = mysqli_fetch_row($resultgatos);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function castracao_mensal_protetor_valor($anoprocedi, $idprot, $connect){
				//$querygatos = "SELECT SUM(QTDE) FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND ESPECIE='Felina' AND SEXO='Fêmea' AND DATA LIKE '".$anoprocedi."-".$mesprocedi."-%'";
				$querygatos = "SELECT SUM(VALOR_AJUDA) FROM AGENDAMENTO WHERE PROCEDIMENTO='Castração' AND DATA_AG LIKE '".$anoprocedi."-%' AND ID_PROTETOR='".$idprot."' AND ATIVO <> 'CANCELADO'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc = mysqli_fetch_row($resultgatos);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}
		
		function adotados_total_caes($anoadocao,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-%' AND ESPECIE='Canina'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);	
											
				return($rc);
		}
		
		function adotados_total_gatos($anoadocao,$connect){
				$querygatos = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-%' AND ESPECIE='Felina'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc= mysqli_num_rows($resultgatos);	
											
				return($rc);
		}
		
		function castrados_mes_caes($anoadocao,$mesadocao,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO WHERE CASTRADO = 'Sim' AND ESPECIE='Canina' AND DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."-%'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes); 	
											
				return($rc);
		}

		function castrados_mes_gatos($anoadocao,$mesadocao,$connect){
				$querygatos = "SELECT * FROM TERMO_ADOCAO WHERE CASTRADO = 'Sim' AND ESPECIE='Felina' AND DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."-%'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc= mysqli_num_rows($resultgatos);	
											
				return($rc);
		}
		
		function adotados_total_femeas($especie,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO where ESPECIE='$especie' AND SEXO='Fêmea'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);	
											
				return($rc);
		}
		
		function adotados_total_machos($especie,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO where ESPECIE='$especie' AND SEXO='Macho'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);	
											
				return($rc);
		}
		
		function adotados_ano_femeas($anoadocao, $especie,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-%' AND ESPECIE='$especie' AND SEXO='Fêmea'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);	
											
				return($rc);
		}
		
		function adotados_ano_machos($anoadocao, $especie,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-%' AND ESPECIE='$especie' AND SEXO='Macho'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);	
											
				return($rc);
		}
		
		function adotados_mes_femeas($anoadocao,$mesadocao,$especie,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."-%' AND ESPECIE='$especie' AND SEXO='Fêmea'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);	
											
				return($rc);
		}
		
		function adotados_mes_machos($anoadocao,$mesadocao,$especie,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."-%' AND ESPECIE='$especie' AND SEXO='Macho'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);	
											
				return($rc);
		}
		
		function adotados_mes_caes($anoadocao,$mesadocao,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."-%' AND ESPECIE='Canina'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);	
											
				return($rc);
		}
		
		
		function adotados_mes_gatos($anoadocao,$mesadocao,$connect){
				$querygatos = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."-%' AND ESPECIE='Felina'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc= mysqli_num_rows($resultgatos);	
											
				return($rc);
		}
		
		function lt_total_adocoes_gatos($anoadocao,$connect){
				$querygatos = "SELECT * FROM TERMO_ADOCAO where WHERE ADOTADO ='Disponível' AND ESPECIE='Felina'";
				$resultgatos = mysqli_query($connect,$querygatos);
				$rc= mysqli_num_rows($resultgatos);	
											
				return($rc);
		}
		function lt_total_adocoes_caes($anoadocao,$connect){
				$querycaes = "SELECT * FROM TERMO_ADOCAO WHERE ADOTADO ='Disponível' AND ESPECIE='Canina'";
				$resultcaes = mysqli_query($connect,$querycaes);
				$rc= mysqli_num_rows($resultcaes);	
											
				return($rc);
		}
		
		function adotados($ano,$mes,$especie,$rc,$connect){
				$query = "SELECT * FROM TERMO_ADOCAO WHERE ESPECIE = '".$especie."' and DATA_ADOCAO LIKE '".$ano."-".$mes."-%'";
				$connect = mysqli_query($connect,$query);
				$rc= mysqli_num_rows($connect);
		}
		
		function lt_animais($lt,$connect){
				$query = "SELECT LAR_TEMPORARIO,NOME_ANIMAL FROM ANIMAL WHERE LAR_TEMPORARIO = '".$lt."' ORDER BY NOME_ANIMAL ASC";
				$connect = mysqli_query($connect,$query);
				$rc= mysqli_num_rows($connect);
		}
		
		function procedi_mensal($lt,$connect){
				$query = "SELECT LAR_TEMPORARIO,NOME_ANIMAL FROM ANIMAL WHERE LAR_TEMPORARIO = '".$lt."' ORDER BY NOME_ANIMAL ASC";
				$connect = mysqli_query($connect,$query);
				$rc= mysqli_num_rows($connect);
		}

	switch ($tiporelatorio) {
	    case 'Adotados': 
			  if ($anoadocao!= '' && $mesadocao != '' && $localadocao == '' && $comtermos == ''){
					$mes_adotados_caes = adotados_mes_caes($anoadocao,$mesadocao,$connect);
 				 	$mes_adotados_gatos = adotados_mes_gatos($anoadocao,$mesadocao,$connect);
					$mes_castrados_caes = castrados_mes_caes($anoadocao,$mesadocao,$connect);
					$mes_castrados_gatos = castrados_mes_gatos($anoadocao,$mesadocao,$connect);
					$mes_total_cc = local_adocao($anoadocao,$mesadocao,'Centro de Convivência',$connect);
					$mes_total_petcamp_bg = local_adocao($anoadocao,$mesadocao,'Petcamp Barão Geraldo',$connect);
				 	$mes_total_petcamp_jas = local_adocao($anoadocao,$mesadocao,'Petcamp Jasmim',$connect);
					$mes_total_petcenter = local_adocao($anoadocao,$mesadocao,'Pet Center Marginal',$connect);
				 	$mes_total_petz = local_adocao($anoadocao,$mesadocao,'Petz',$connect);
					$mes_total_petland = local_adocao($anoadocao,$mesadocao,'Petland',$connect);
				 	$mes_total_leroy = local_adocao($anoadocao,$mesadocao,'Leroy M Dom Pedro',$connect);
					$mes_total_fora_feira = local_adocao($anoadocao,$mesadocao,'Fora da feira',$connect);	
					
					$animais_adotados = intval($mes_adotados_caes) + intval($mes_adotados_gatos);
					$animais_castrados = intval($mes_castrados_caes) + intval($mes_castrados_gatos);
					$animais_naocastrados = intval($animais_adotados) - intval($animais_castrados);
					
					$adotados_caes_femeas = adotados_mes_femeas($anoadocao,$mesadocao,'Canina',$connect);
					$adotados_caes_machos = adotados_mes_machos($anoadocao,$mesadocao,'Canina',$connect);
					
					$adotados_gatos_femeas = adotados_mes_femeas($anoadocao,$mesadocao,'Felina',$connect);
					$adotados_gatos_machos = adotados_mes_machos($anoadocao,$mesadocao,'Felina',$connect);
					
					$perc_caes = (intval($mes_adotados_caes) / intval($animais_adotados))*100;
					$perc_caes_femeas = (intval($adotados_caes_femeas) / intval($animais_adotados))*100;
					$perc_caes_machos = (intval($adotados_caes_machos) / intval($animais_adotados))*100;
					
					$perc_gatos = (intval($mes_adotados_gatos) / intval($animais_adotados))*100;
					$perc_gatos_femeas = (intval($adotados_gatos_femeas) / intval($animais_adotados))*100;
					$perc_gatos_machos = (intval($adotados_gatos_machos) / intval($animais_adotados))*100;
					
					
					echo "<center><table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
                            <th scope='col'>&nbsp;</th>
							<th scope='col'>&nbsp;</th>
							<th scope='col' colspan='2'>Adoções</th>
							<th scope='col' colspan='2'>Animais doados castrados</th>";
							if ($anoadocao <='2018'){
							    echo "<th scope='col' colspan='7'>Locais</th>";
							} else {
							    echo "<th scope='col' colspan='5'>Locais</th>";
							}
					echo "</tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Ano</th>
							<th scope='col'>Mês</th>
							<th scope='col'>Cães</th>
							<th scope='col'>Gatos</th>
							<th scope='col'>Cães</th>
							<th scope='col'>Gatos</th>";
							/*if ($anoadocao <='2018'){
							    echo "<th scope='col'>Petz</th>
							          <th scope='col'>Pet Marginal</th>
							          <th scope='col'>Petland</th>";
							} else {
							     echo "<th scope='col'>Centro de Convivência</th>";
							}*/
							echo "<th scope='col'>Petcamp Barão</th>
							<th scope='col'>Fora da feira</th>
						  </tr>
						  </thead>
						  </tbody>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<td>".$mesadocao."</td>
							<td>".$mes_adotados_caes."</td>
							<td>".$mes_adotados_gatos."</td>
							<td>".$mes_castrados_caes."</td>
							<td>".$mes_castrados_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$mes_total_petz."</td>";
							    echo "<td>".$mes_total_petcenter."</td>";
							    echo "<td>".$mes_total_petland."</td>";
							} else {
							    echo "<td>".$mes_total_cc."</td>";
							}*/
							echo "<td>".$mes_total_petcamp_bg."</td>
							<td>".$mes_total_fora_feira."</td>
						  </tr>
						  </tbody>
						 </table></center>
						 <br>
						 	       <center>
                                        <h3>RESUMO</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                	    </thead>
                                    	<tbody>
                                        	<tr>
                            					<th scope='row'>Animais doados</th>
                            					<td>".$animais_adotados."</td>
                        					</tr>
                        					<tr>
                            					<th scope='row'>Animais doados castrados</th>
                            					<td>".$animais_castrados."</td>
                        					</tr>
                        					<tr>
                            					<th scope='row'>Animais doados não castrados (menores de 5 meses)</th>
                            					<td>".$animais_naocastrados."</td>
                        					</tr>
                    					</tbody>
                    				</table>
                    				
                    				<center>
                                        <h3>ESTATÍSTICAS</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                        <tr>
                        					<th scope='row'>Percentual de cães adotados</th>
                        					<th>".number_format($perc_caes,2,',', '.')."%</th>
                    					</tr>
                                	    </thead>
                                    	<tbody>
                    					
                    					<tr>
                        					<th>Fêmeas</th>
                        					<td>".number_format($perc_caes_femeas,2,',', '.')."%</td>
                    					</tr>
                    					<tr>
                        					<th>Machos</th>
                        					<td>".number_format($perc_caes_machos,2,',', '.')."%</td>
                    					</tr>
                    					</tbody>
                    				</table>
                    				<br>
                    				<table class='table'>
                                        <thead class='thead-light'>
                                        <tr>
                        					<th scope='row'>Percentual de gatos adotados</th>
                        					<th>".number_format($perc_gatos,2,',', '.')."%</th>
                    					</tr>
                                	    </thead>
                                    	<tbody>
                    					<tr>
                        					<th>Fêmeas</th>
                        					<td>".number_format($perc_gatos_femeas,2,',', '.')."%</td>
                    					</tr>
                    					<tr>
                        					<th>Machos</th>
                        					<td>".number_format($perc_gatos_machos,2,',', '.')."%</td>
                    					</tr>
                    					</tbody>
                    				</table>";
						 
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
							<th scope='col'>Gatos</th>";
							if ($anoadocao <='2018'){
					        	$mensagem ="<th scope='col'>Petz</th>
							                <th scope='col'>Pet Marginal</th>";
							} else {
						        $mensagem ="<th scope='col'>Centro de Convivência</th>";
							}
							$mensagem ="<th scope='col'>Petcamp Barão</th>
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
							<td class='text-danger'>".$mes_castrados_gatos."</td>";
							if ($anoadocao <='2018'){
							    $mensagem = "<td>".$mes_total_petz."</td>
							                 <td>".$mes_total_petcenter."</td>";
							} else {
							    $mensagem ="<td>".$mes_total_cc."</td>";
							}
							$mensagem = "<td class='text-danger'>".$mes_total_petcamp_bg."</td>
							<td class='text-danger'>".$mes_total_petcamp_jas."</td>
							<td class='text-danger'>".$mes_total_petland."</td>
							<td class='text-danger'>".$mes_total_leroy."</td>
							<td class='text-danger'>".$mes_total_fora_feira."</td>
						  </tr>
						  </tbody>
						 </table></center>
						 <br>
						 	      <center>
                                        <h3>RESUMO</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                	    </thead>
                                    	<tbody>
                                        	<tr>
                            					<th scope='row'>Animais doados</th>
                            					<td>".$animais_adotados."</td>
                        					</tr>
                        					<tr>
                            					<th scope='row'>Animais doados castrados</th>
                            					<td>".$animais_castrados."</td>
                        					</tr>
                        					<tr>
                            					<th scope='row'>Animais doados não castrados (menores de 5 meses)</th>
                            					<td>".$animais_naocastrados."</td>
                        					</tr>
                    					</tbody>
                    				</table>
                    				
                    				<center>
                                        <h3>ESTATÍSTICAS</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                        <tr>
                        					<th scope='row'>Percentual de cães adotados</th>
                        					<th>".number_format($perc_caes,2,',', '.')."%</th>
                    					</tr>
                                	    </thead>
                                    	<tbody>
                    					
                    					<tr>
                        					<th>Fêmeas</th>
                        					<td>".number_format($perc_caes_femeas,2,',', '.')."%</td>
                    					</tr>
                    					<tr>
                        					<th>Machos</th>
                        					<td>".number_format($perc_caes_machos,2,',', '.')."%</td>
                    					</tr>
                    					</tbody>
                    				</table>
                    				<br>
                    				<table class='table'>
                                        <thead class='thead-light'>
                                        <tr>
                        					<th scope='row'>Percentual de gatos adotados</th>
                        					<th>".number_format($perc_gatos,2,',', '.')."%</th>
                    					</tr>
                                	    </thead>
                                    	<tbody>
                    					<tr>
                        					<th>Fêmeas</th>
                        					<td>".number_format($perc_gatos_femeas,2,',', '.')."%</td>
                    					</tr>
                    					<tr>
                        					<th>Machos</th>
                        					<td>".number_format($perc_gatos_machos,2,',', '.')."%</td>
                    					</tr>
                    					</tbody>
                    				</table>";
					
				}
			  if ($anoadocao == '' && $mesadocao != '' && $localadocao == '' && $comtermos == ''){
			  
				 $adotados_2014mes_caes = adotados_mes_caes('2014',$mesadocao,$connect);
				 $adotados_2015mes_caes = adotados_mes_caes('2015',$mesadocao,$connect);
				 $adotados_2015mes_caes = adotados_mes_caes('2015',$mesadocao,$connect);
				 $adotados_2016mes_caes = adotados_mes_caes('2016',$mesadocao,$connect);
				 $adotados_2017mes_caes = adotados_mes_caes('2017',$mesadocao,$connect);
				 $adotados_2018mes_caes = adotados_mes_caes('2018',$mesadocao,$connect);
				 $adotados_2019mes_caes = adotados_mes_caes('2019',$mesadocao,$connect);
				 $adotados_2020mes_caes = adotados_mes_caes('2020',$mesadocao,$connect);
				 $adotados_2021mes_caes = adotados_mes_caes('2021',$mesadocao,$connect);
				 
				 $adotados_2014mes_gatos = adotados_mes_gatos('2014',$mesadocao,$connect);
				 $adotados_2015mes_gatos = adotados_mes_gatos('2015',$mesadocao,$connect);
				 $adotados_2015mes_gatos = adotados_mes_gatos('2015',$mesadocao,$connect);
				 $adotados_2016mes_gatos = adotados_mes_gatos('2016',$mesadocao,$connect);
				 $adotados_2017mes_gatos = adotados_mes_gatos('2017',$mesadocao,$connect);
				 $adotados_2018mes_gatos = adotados_mes_gatos('2018',$mesadocao,$connect);
				 $adotados_2019mes_gatos = adotados_mes_gatos('2019',$mesadocao,$connect);
				 $adotados_2020mes_gatos = adotados_mes_gatos('2020',$mesadocao,$connect);
				 $adotados_2021mes_gatos = adotados_mes_gatos('2021',$mesadocao,$connect);
				 
				 $castrados_2014mes_caes = castrados_mes_caes('2014',$mesadocao,$connect);
				 $castrados_2015mes_caes = castrados_mes_caes('2015',$mesadocao,$connect);
				 $castrados_2016mes_caes = castrados_mes_caes('2016',$mesadocao,$connect);
				 $castrados_2017mes_caes = castrados_mes_caes('2017',$mesadocao,$connect);
				 $castrados_2018mes_caes = castrados_mes_caes('2018',$mesadocao,$connect);
				 $castrados_2019mes_caes = castrados_mes_caes('2019',$mesadocao,$connect);
				 $castrados_2020mes_caes = castrados_mes_caes('2020',$mesadocao,$connect);
				 $castrados_2021mes_caes = castrados_mes_caes('2021',$mesadocao,$connect);
				 
				 $castrados_2014mes_gatos = castrados_mes_gatos('2014',$mesadocao,$connect);
				 $castrados_2015mes_gatos = castrados_mes_gatos('2015',$mesadocao,$connect);
				 $castrados_2016mes_gatos = castrados_mes_gatos('2016',$mesadocao,$connect);
				 $castrados_2017mes_gatos = castrados_mes_gatos('2017',$mesadocao,$connect);
				 $castrados_2018mes_gatos = castrados_mes_gatos('2018',$mesadocao,$connect);
				 $castrados_2019mes_gatos = castrados_mes_gatos('2019',$mesadocao,$connect);
				 $castrados_2020mes_gatos = castrados_mes_gatos('2020',$mesadocao,$connect);
				 $castrados_2021mes_gatos = castrados_mes_gatos('2021',$mesadocao,$connect);

				 $mes_total2014_petcamp_bg = local_adocao('2014',$mesadocao,'Petcamp Barão Geraldo',$connect);
				 $mes_total2015_petcamp_bg = local_adocao('2015',$mesadocao,'Petcamp Barão Geraldo',$connect);
				 $mes_total2015_petcamp_bg = local_adocao('2015',$mesadocao,'Petcamp Barão Geraldo',$connect);
				 $mes_total2016_petcamp_bg = local_adocao('2016',$mesadocao,'Petcamp Barão Geraldo',$connect);
				 $mes_total2017_petcamp_bg = local_adocao('2017',$mesadocao,'Petcamp Barão Geraldo',$connect);
				 $mes_total2018_petcamp_bg = local_adocao('2018',$mesadocao,'Petcamp Barão Geraldo',$connect);
				 $mes_total2019_petcamp_bg = local_adocao('2019',$mesadocao,'Petcamp Barão Geraldo',$connect);
				 $mes_total2020_petcamp_bg = local_adocao('2020',$mesadocao,'Petcamp Barão Geraldo',$connect);
				 $mes_total2021_petcamp_bg = local_adocao('2021',$mesadocao,'Petcamp Barão Geraldo',$connect);				 
				 
				 $mes_total2014_petcamp_jas = local_adocao('2014',$mesadocao,'Petcamp Jasmim',$connect);
				 $mes_total2015_petcamp_jas = local_adocao('2015',$mesadocao,'Petcamp Jasmim',$connect);
				 $mes_total2015_petcamp_jas = local_adocao('2015',$mesadocao,'Petcamp Jasmim',$connect);
				 $mes_total2016_petcamp_jas = local_adocao('2016',$mesadocao,'Petcamp Jasmim',$connect);
				 $mes_total2017_petcamp_jas = local_adocao('2017',$mesadocao,'Petcamp Jasmim',$connect);
				 $mes_total2018_petcamp_jas = local_adocao('2018',$mesadocao,'Petcamp Jasmim',$connect);
				 $mes_total2019_petcamp_jas = local_adocao('2019',$mesadocao,'Petcamp Jasmim',$connect);
				 $mes_total2020_petcamp_jas = local_adocao('2020',$mesadocao,'Petcamp Jasmim',$connect);
				 $mes_total2021_petcamp_jas = local_adocao('2021',$mesadocao,'Petcamp Jasmim',$connect);	 
				 
				 $mes_total2014_petcenter = local_adocao('2014',$mesadocao,'Pet Center Marginal',$connect);
				 $mes_total2015_petcenter = local_adocao('2015',$mesadocao,'Pet Center Marginal',$connect);
				 $mes_total2015_petcenter = local_adocao('2015',$mesadocao,'Pet Center Marginal',$connect);
				 $mes_total2016_petcenter = local_adocao('2016',$mesadocao,'Pet Center Marginal',$connect);
				 $mes_total2017_petcenter = local_adocao('2017',$mesadocao,'Pet Center Marginal',$connect);
				 $mes_total2018_petcenter = local_adocao('2018',$mesadocao,'Pet Center Marginal',$connect);
				 $mes_total2019_petcenter = local_adocao('2019',$mesadocao,'Pet Center Marginal',$connect);
				 $mes_total2020_petcenter = local_adocao('2020',$mesadocao,'Pet Center Marginal',$connect);
				 $mes_total2021_petcenter = local_adocao('2021',$mesadocao,'Pet Center Marginal',$connect); 	 
				 
				 $mes_total2014_petz = local_adocao('2014',$mesadocao,'Petz',$connect);
				 $mes_total2015_petz = local_adocao('2015',$mesadocao,'Petz',$connect);
				 $mes_total2015_petz = local_adocao('2015',$mesadocao,'Petz',$connect);
				 $mes_total2016_petz = local_adocao('2016',$mesadocao,'Petz',$connect);
				 $mes_total2017_petz = local_adocao('2017',$mesadocao,'Petz',$connect);
				 $mes_total2018_petz = local_adocao('2018',$mesadocao,'Petz',$connect);
				 $mes_total2019_petz = local_adocao('2019',$mesadocao,'Petz',$connect);
				 $mes_total2020_petz = local_adocao('2020',$mesadocao,'Petz',$connect);
				 $mes_total2021_petz = local_adocao('2021',$mesadocao,'Petz',$connect);
				 
				 $mes_total2014_petland = local_adocao('2014',$mesadocao,'Petland',$connect);
				 $mes_total2015_petland = local_adocao('2015',$mesadocao,'Petland',$connect);
				 $mes_total2015_petland = local_adocao('2015',$mesadocao,'Petland',$connect);
				 $mes_total2016_petland = local_adocao('2016',$mesadocao,'Petland',$connect);
				 $mes_total2017_petland = local_adocao('2017',$mesadocao,'Petland',$connect);
				 $mes_total2018_petland = local_adocao('2018',$mesadocao,'Petland',$connect);
				 $mes_total2019_petland = local_adocao('2019',$mesadocao,'Petland',$connect);
				 $mes_total2020_petland = local_adocao('2020',$mesadocao,'Petland',$connect);
				 $mes_total2021_petland = local_adocao('2021',$mesadocao,'Petland',$connect);
		 				 
				 $mes_total2014_leroy = local_adocao('2014',$mesadocao,'Leroy M Dom Pedro',$connect);
				 $mes_total2015_leroy = local_adocao('2015',$mesadocao,'Leroy M Dom Pedro',$connect);
				 $mes_total2015_leroy = local_adocao('2015',$mesadocao,'Leroy M Dom Pedro',$connect);
				 $mes_total2016_leroy = local_adocao('2016',$mesadocao,'Leroy M Dom Pedro',$connect);
				 $mes_total2017_leroy = local_adocao('2017',$mesadocao,'Leroy M Dom Pedro',$connect);
				 $mes_total2018_leroy = local_adocao('2018',$mesadocao,'Leroy M Dom Pedro',$connect);
				 $mes_total2019_leroy = local_adocao('2019',$mesadocao,'Leroy M Dom Pedro',$connect);
				 $mes_total2020_leroy = local_adocao('2020',$mesadocao,'Leroy M Dom Pedro',$connect);
				 $mes_total2021_leroy = local_adocao('2021',$mesadocao,'Leroy M Dom Pedro',$connect);
				 
				 $mes_total2014_fora_feira = local_adocao('2014',$mesadocao,'Fora da feira',$connect);			
				 $mes_total2015_fora_feira = local_adocao('2015',$mesadocao,'Fora da feira',$connect);
				 $mes_total2015_fora_feira = local_adocao('2015',$mesadocao,'Fora da feira',$connect);
				 $mes_total2016_fora_feira = local_adocao('2016',$mesadocao,'Fora da feira',$connect);
				 $mes_total2017_fora_feira = local_adocao('2017',$mesadocao,'Fora da feira',$connect);
				 $mes_total2018_fora_feira = local_adocao('2018',$mesadocao,'Fora da feira',$connect);
				 $mes_total2019_fora_feira = local_adocao('2019',$mesadocao,'Fora da feira',$connect);
				 $mes_total2020_fora_feira = local_adocao('2020',$mesadocao,'Fora da feira',$connect);
				 $mes_total2021_fora_feira = local_adocao('2021',$mesadocao,'Fora da feira',$connect);		 

                 $adotados_caes = intval($adotados_2014mes_caes) +           
						intval($adotados_2015mes_caes) +
                        intval($adotados_2016mes_caes) +
                        intval($adotados_2017mes_caes) +
                        intval($adotados_2018mes_caes) +
                        intval($adotados_2019mes_caes) +
                        intval($adotados_2020mes_caes) +
                        intval($adotados_2021mes_caes); 
                        
                $adotados_gatos = intval($adotados_2014mes_gatos) +           
						intval($adotados_2015mes_gatos) +
                        intval($adotados_2016mes_gatos) +
                        intval($adotados_2017mes_gatos) +
                        intval($adotados_2018mes_gatos) +
                        intval($adotados_2019mes_gatos) +
                        intval($adotados_2020mes_gatos) +
                        intval($adotados_2021mes_gatos); 

                $castrados_gatos = intval($castrados_2014mes_gatos) + 
						intval($castrados_2015mes_gatos) +
                        intval($castrados_2016mes_gatos) +
                        intval($castrados_2017mes_gatos) +
                        intval($castrados_2018mes_gatos) +
                        intval($castrados_2019mes_gatos) +
                        intval($castrados_2020mes_gatos) +
                        intval($castrados_2021mes_gatos); 
                
                $castrados_caes = intval($castrados_2014mes_caes) +           
						intval($castrados_2015mes_caes) +
                        intval($castrados_2016mes_caes) +
                        intval($castrados_2017mes_caes) +
                        intval($castrados_2018mes_caes) +
                        intval($castrados_2019mes_caes) +
                        intval($castrados_2020mes_caes) +
                        intval($castrados_2021mes_caes); 

                 $total_fora_feira = intval($mes_total2014_fora_feira) + 
                        intval($mes_total2015_fora_feira) +
                        intval($mes_total2016_fora_feira) +
                        intval($mes_total2017_fora_feira) +
                        intval($mes_total2018_fora_feira) +
                        intval($mes_total2019_fora_feira) +
                        intval($mes_total2020_fora_feira) +
                        intval($mes_total2021_fora_feira);
                 
                 $total_leroy = intval($mes_total2014_leroy) +           
						intval($mes_total2015_leroy) +
                        intval($mes_total2016_leroy) +
                        intval($mes_total2017_leroy) +
                        intval($mes_total2018_leroy) +
                        intval($mes_total2019_leroy) +
                        intval($mes_total2020_leroy) +
                        intval($mes_total2021_leroy);  
                        
                $total_petland = intval($mes_total2014_petland) +           
						intval($mes_total2015_petland) +
                        intval($mes_total2016_petland) +
                        intval($mes_total2017_petland) +
                        intval($mes_total2018_petland) +
                        intval($mes_total2019_petland) +
                        intval($mes_total2020_petland) +
                        intval($mes_total2021_petland); 
                        
                $total_petz = intval($mes_total2014_petz) +           
						intval($mes_total2015_petz) +
                        intval($mes_total2016_petz) +
                        intval($mes_total2017_petz) +
                        intval($mes_total2018_petz) +
                        intval($mes_total2019_petz) +
                        intval($mes_total2020_petz) +
                        intval($mes_total2021_petz); 
                        
                $total_petcenter = intval($mes_total2014_petcenter) +           
						intval($mes_total2015_petcenter) +
                        intval($mes_total2016_petcenter) +
                        intval($mes_total2017_petcenter) +
                        intval($mes_total2018_petcenter) +
                        intval($mes_total2019_petcenter) +
                        intval($mes_total2020_petcenter) +
                        intval($mes_total2021_petcenter); 
                        
                $total_petcamp_jas = intval($mes_total2014_petcamp_jas) +  
						intval($mes_total2015_petcamp_jas) +
                        intval($mes_total2016_petcamp_jas) +
                        intval($mes_total2017_petcamp_jas) +
                        intval($mes_total2018_petcamp_jas) +
                        intval($mes_total2019_petcamp_jas) +
                        intval($mes_total2020_petcamp_jas) +
                        intval($mes_total2021_petcamp_jas); 
                        
                $total_petcamp_bg = intval($mes_total2014_petcamp_bg) +
						intval($mes_total2015_petcamp_bg) +
                        intval($mes_total2016_petcamp_bg) +
                        intval($mes_total2017_petcamp_bg) +
                        intval($mes_total2018_petcamp_bg) +
                        intval($mes_total2019_petcamp_bg) +
                        intval($mes_total2020_petcamp_bg) +
                        intval($mes_total2021_petcamp_bg); 
                
                $animais_adotados = intval($adotados_caes) + intval($adotados_gatos);
                
                $animais_doados_castrados = intval($castrados_gatos) + intval($castrados_caes);
                
                $animais_doados_naocastrados = (intval($castrados_gatos) - intval($adotados_gatos)) + (intval($castrados_caes) + intval($adotados_caes));
                
				 echo "<center><table class='table' >
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
							<th scope='col'>Petcamp Barão</th>
							<th scope='col'>Fora da feira</th>
						  </tr>
						  </thead>
						  <tbody>
						  <tr> 
							<th scope='row'>2014 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2014mes_caes."</td>
							<td>".$adotados_2014mes_gatos."</td>
							<td>".$castrados_2014mes_caes."</td>
							<td>".$castrados_2014mes_gatos."</td>
							<td>".$mes_total2014_petcamp_bg."</td>
							<td>".$mes_total2014_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>2015 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2015mes_caes."</td>
							<td>".$adotados_2015mes_gatos."</td>
							<td>".$castrados_2015mes_caes."</td>
							<td>".$castrados_2015mes_gatos."</td>
							<td>".$mes_total2015_petcamp_bg."</td>
							<td>".$mes_total2015_fora_feira."</td>
						  </tr>
						  <tr > 
							<th scope='row'>2016 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2016mes_caes."</td>
							<td>".$adotados_2016mes_gatos."</td>
							<td>".$castrados_2016mes_caes."</td>
							<td>".$castrados_2016mes_gatos."</td>
							<td>".$mes_total2016_petcamp_bg."</td>
							<td>".$mes_total2016_fora_feira."</td>
						  </tr>
						  <tr > 
							<th scope='row'>2017 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2017mes_caes."</td>
							<td>".$adotados_2017mes_gatos."</td>
							<td>".$castrados_2017mes_caes."</td>
							<td>".$castrados_2017mes_gatos."</td>
							<td>".$mes_total2017_petcamp_bg."</td>
							<td>".$mes_total2017_fora_feira."</td>
						  </tr>
						  <tr > 
							<th scope='row'>2017 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2018mes_caes."</td>
							<td>".$adotados_2018mes_gatos."</td>
							<td>".$castrados_2018mes_caes."</td>
							<td>".$castrados_2018mes_gatos."</td>
							<td>".$mes_total2018_petcamp_bg."</td>
							<td>".$mes_total2018_leroy."</td>
							<td>".$mes_total2018_fora_feira."</td>
						  </tr>
						  <tr > 
							<th scope='row'>2019 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2019mes_caes."</td>
							<td>".$adotados_2019mes_gatos."</td>
							<td>".$castrados_2019mes_caes."</td>
							<td>".$castrados_2019mes_gatos."</td>
							<td>".$mes_total2019_petcamp_bg."</td>
							<td>".$mes_total2019_petcamp_jas."</td>
							<td>".$mes_total2019_fora_feira."</td>
						  </tr>
						  <tr > 
							<th scope='row'>2020 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2020mes_caes."</td>
							<td>".$adotados_2020mes_gatos."</td>
							<td>".$castrados_2020mes_caes."</td>
							<td>".$castrados_2020mes_gatos."</td>
							<td>".$mes_total2020_petcamp_bg."</td>
							<td>".$mes_total2020_fora_feira."</td>
						  </tr>
						  <tr > 
							<th scope='row'>2021 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2021mes_caes."</td>
							<td>".$adotados_2021mes_gatos."</td>
							<td>".$castrados_2021mes_caes."</td>
							<td>".$castrados_2021mes_gatos."</td>
							<td>".$mes_total2021_petcamp_bg."</td>
							<td>".$mes_total2021_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>$adotados_caes</td>
							<td class='text-danger'>$adotados_gatos</td>
							<td class='text-danger'>$castrados_caes</td>
							<td class='text-danger'>$castrados_gatos</td>
							<td class='text-danger'>$total_petcamp_bg</td>
							<td class='text-danger'>$total_fora_feira</td>
						  </tr>
						  </tbody>
						 </table></center>
						 <br>
						 
						 	       <center>
                                        <h3>RESUMO</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                	    </thead>
                                    	<tbody>
                                    	<tr>
                        					<th scope='row'>Animais doados</th>
                        					<td>".$animais_adotados."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Animais doados castrados</th>
                        					<td>".$animais_doados_castrados."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Animais doados não castrados (menores de 5 meses)</th>
                        					<td>".$animais_doados_naocastrados."</td>
                    					</tr>
                    					</tbody>
                    				</table>";
						 
						 $assunto = "Relatório - Adoções do mês ".$mesadocao."";
						
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
						  <tbody>
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
							<th scope='row'>2014 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2014mes_caes."</td>
							<td>".$adotados_2014mes_gatos."</td>
							<td>".$castrados_2014mes_caes."</td>
							<td>".$castrados_2014mes_gatos."</td>
							<td>".$mes_total2014_petz."</td>
							<td>".$mes_total2014_petcenter."</td>
							<td>".$mes_total2014_petcamp_bg."</td>
							<td>".$mes_total2014_petcamp_jas."</td>
							<td>".$mes_total2014_petland."</td>
							<td>".$mes_total2014_leroy."</td>
							<td>".$mes_total2014_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>2015 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2015mes_caes."</td>
							<td>".$adotados_2015mes_gatos."</td>
							<td>".$castrados_2015mes_caes."</td>
							<td>".$castrados_2015mes_gatos."</td>
							<td>".$mes_total2015_petz."</td>
							<td>".$mes_total2015_petcenter."</td>
							<td>".$mes_total2015_petcamp_bg."</td>
							<td>".$mes_total2015_petcamp_jas."</td>
							<td>".$mes_total2015_petland."</td>
							<td>".$mes_total2015_leroy."</td>
							<td>".$mes_total2015_fora_feira."</td>
						  </tr>
						  <tr > 
							<th scope='row'>2016 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2016mes_caes."</td>
							<td>".$adotados_2016mes_gatos."</td>
							<td>".$castrados_2016mes_caes."</td>
							<td>".$castrados_2016mes_gatos."</td>
							<td>".$mes_total2016_petz."</td>
							<td>".$mes_total2016_petcenter."</td>
							<td>".$mes_total2016_petcamp_bg."</td>
							<td>".$mes_total2016_petcamp_jas."</td>
							<td>".$mes_total2016_petland."</td>
							<td>".$mes_total2016_leroy."</td>
							<td>".$mes_total2016_fora_feira."</td>
						  </tr>
						  <tr > 
							<th scope='row'>2017 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2017mes_caes."</td>
							<td>".$adotados_2017mes_gatos."</td>
							<td>".$castrados_2017mes_caes."</td>
							<td>".$castrados_2017mes_gatos."</td>
							<td>".$mes_total2017_petz."</td>
							<td>".$mes_total2017_petcenter."</td>
							<td>".$mes_total2017_petcamp_bg."</td>
							<td>".$mes_total2017_petcamp_jas."</td>
							<td>".$mes_total2017_petland."</td>
							<td>".$mes_total2017_leroy."</td>
							<td>".$mes_total2017_fora_feira."</td>
						  </tr>
						  <tr > 
							<th scope='row'>2017 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2018mes_caes."</td>
							<td>".$adotados_2018mes_gatos."</td>
							<td>".$castrados_2018mes_caes."</td>
							<td>".$castrados_2018mes_gatos."</td>
							<td>".$mes_total2018_petz."</td>
							<td>".$mes_total2018_petcenter."</td>
							<td>".$mes_total2018_petcamp_bg."</td>
							<td>".$mes_total2018_petcamp_jas."</td>
							<td>".$mes_total2018_petland."</td>
							<td>".$mes_total2018_leroy."</td>
							<td>".$mes_total2018_fora_feira."</td>
						  </tr>
						  <tr > 
							<th scope='row'>2019 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2019mes_caes."</td>
							<td>".$adotados_2019mes_gatos."</td>
							<td>".$castrados_2019mes_caes."</td>
							<td>".$castrados_2019mes_gatos."</td>
							<td>".$mes_total2019_petz."</td>
							<td>".$mes_total2019_petcenter."</td>
							<td>".$mes_total2019_petcamp_bg."</td>
							<td>".$mes_total2019_petcamp_jas."</td>
							<td>".$mes_total2019_petland."</td>
							<td>".$mes_total2019_leroy."</td>
							<td>".$mes_total2019_fora_feira."</td>
						  </tr>
						  <tr > 
							<th scope='row'>2020 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2020mes_caes."</td>
							<td>".$adotados_2020mes_gatos."</td>
							<td>".$castrados_2020mes_caes."</td>
							<td>".$castrados_2020mes_gatos."</td>
							<td>".$mes_total2020_petz."</td>
							<td>".$mes_total2020_petcenter."</td>
							<td>".$mes_total2020_petcamp_bg."</td>
							<td>".$mes_total2020_petcamp_jas."</td>
							<td>".$mes_total2020_petland."</td>
							<td>".$mes_total2020_leroy."</td>
							<td>".$mes_total2020_fora_feira."</td>
						  </tr>
						  <tr > 
							<th scope='row'>2021 </th>
							<td>".$mesadocao."</td>
							<td>".$adotados_2021mes_caes."</td>
							<td>".$adotados_2021mes_gatos."</td>
							<td>".$castrados_2021mes_caes."</td>
							<td>".$castrados_2021mes_gatos."</td>
							<td>".$mes_total2021_petz."</td>
							<td>".$mes_total2021_petcenter."</td>
							<td>".$mes_total2021_petcamp_bg."</td>
							<td>".$mes_total2021_petcamp_jas."</td>
							<td>".$mes_total2021_petland."</td>
							<td>".$mes_total2021_leroy."</td>
							<td>".$mes_total2021_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>$adotados_caes</td>
							<td class='text-danger'>$adotados_gatos</td>
							<td class='text-danger'>$castrados_caes</td>
							<td class='text-danger'>$castrados_gatos</td>
							<td class='text-danger'>$total_petz</td>
							<td class='text-danger'>$total_petcenter</td>
							<td class='text-danger'>$total_petcamp_bg</td>
							<td class='text-danger'>$total_petcamp_jas</td>
							<td class='text-danger'>$total_petland</td>
							<td class='text-danger'>$total_leroy</td>
							<td class='text-danger'>$total_fora_feira</td>
						  </tr>
						  </tbody>
						 </table></center>";
			  
			  }
			  if ($anoadocao != '' && $mesadocao == '' && $localadocao == '' && $comtermos == ''){
			     $adotados_mes01_caes = adotados_mes_caes($anoadocao,'01',$connect);
			     $adotados_mes02_caes = adotados_mes_caes($anoadocao,'02',$connect);
			     $adotados_mes03_caes = adotados_mes_caes($anoadocao,'03',$connect);
			     $adotados_mes04_caes = adotados_mes_caes($anoadocao,'04',$connect);
			     $adotados_mes05_caes = adotados_mes_caes($anoadocao,'05',$connect);
			     $adotados_mes06_caes = adotados_mes_caes($anoadocao,'06',$connect);
			     $adotados_mes07_caes = adotados_mes_caes($anoadocao,'07',$connect);
			     $adotados_mes08_caes = adotados_mes_caes($anoadocao,'08',$connect);
			     $adotados_mes09_caes = adotados_mes_caes($anoadocao,'09',$connect);
			     $adotados_mes10_caes = adotados_mes_caes($anoadocao,'10',$connect);
			     $adotados_mes11_caes = adotados_mes_caes($anoadocao,'11',$connect);
			     $adotados_mes12_caes = adotados_mes_caes($anoadocao,'12',$connect);
			     $adotados_mes01_gatos = adotados_mes_gatos($anoadocao,'01',$connect);
			     $adotados_mes02_gatos = adotados_mes_gatos($anoadocao,'02',$connect);
			     $adotados_mes03_gatos = adotados_mes_gatos($anoadocao,'03',$connect);
			     $adotados_mes04_gatos = adotados_mes_gatos($anoadocao,'04',$connect);
			     $adotados_mes05_gatos = adotados_mes_gatos($anoadocao,'05',$connect);
			     $adotados_mes06_gatos = adotados_mes_gatos($anoadocao,'06',$connect);
			     $adotados_mes07_gatos = adotados_mes_gatos($anoadocao,'07',$connect);
			     $adotados_mes08_gatos = adotados_mes_gatos($anoadocao,'08',$connect);
			     $adotados_mes09_gatos = adotados_mes_gatos($anoadocao,'09',$connect);
			     $adotados_mes10_gatos = adotados_mes_gatos($anoadocao,'10',$connect);
			     $adotados_mes11_gatos = adotados_mes_gatos($anoadocao,'11',$connect);
			     $adotados_mes12_gatos = adotados_mes_gatos($anoadocao,'12',$connect);
			     
			     $adotados_mes01_petz = local_adocao($anoadocao,'01','Petz',$connect);
				 $adotados_mes02_petz = local_adocao($anoadocao,'02','Petz',$connect);
				 $adotados_mes03_petz = local_adocao($anoadocao,'03','Petz',$connect);
				 $adotados_mes04_petz = local_adocao($anoadocao,'04','Petz',$connect);
				 $adotados_mes05_petz = local_adocao($anoadocao,'05','Petz',$connect);
				 $adotados_mes06_petz = local_adocao($anoadocao,'06','Petz',$connect);
				 $adotados_mes07_petz = local_adocao($anoadocao,'07','Petz',$connect);
				 $adotados_mes08_petz = local_adocao($anoadocao,'08','Petz',$connect);
				 $adotados_mes09_petz = local_adocao($anoadocao,'09','Petz',$connect);
				 $adotados_mes10_petz = local_adocao($anoadocao,'10','Petz',$connect);
				 $adotados_mes11_petz = local_adocao($anoadocao,'11','Petz',$connect);
				 $adotados_mes12_petz = local_adocao($anoadocao,'12','Petz',$connect);
				 
				 $adotados_mes01_petcenter = local_adocao($anoadocao,'01','Pet Marginal',$connect);
				 $adotados_mes02_petcenter = local_adocao($anoadocao,'02','Pet Marginal',$connect);
				 $adotados_mes03_petcenter = local_adocao($anoadocao,'03','Pet Marginal',$connect);
				 $adotados_mes04_petcenter = local_adocao($anoadocao,'04','Pet Marginal',$connect);
				 $adotados_mes05_petcenter = local_adocao($anoadocao,'05','Pet Marginal',$connect);
				 $adotados_mes06_petcenter = local_adocao($anoadocao,'06','Pet Marginal',$connect);
				 $adotados_mes07_petcenter = local_adocao($anoadocao,'07','Pet Marginal',$connect);
				 $adotados_mes08_petcenter = local_adocao($anoadocao,'08','Pet Marginal',$connect);
				 $adotados_mes09_petcenter = local_adocao($anoadocao,'09','Pet Marginal',$connect);
				 $adotados_mes10_petcenter = local_adocao($anoadocao,'10','Pet Marginal',$connect);
				 $adotados_mes11_petcenter = local_adocao($anoadocao,'11','Pet Marginal',$connect);
				 $adotados_mes12_petcenter = local_adocao($anoadocao,'12','Pet Marginal',$connect);
			     
				 $adotados_mes01_petcamp_bg = local_adocao($anoadocao,'01','Petcamp Barão Geraldo',$connect);
				 $adotados_mes02_petcamp_bg = local_adocao($anoadocao,'02','Petcamp Barão Geraldo',$connect);
				 $adotados_mes03_petcamp_bg = local_adocao($anoadocao,'03','Petcamp Barão Geraldo',$connect);
				 $adotados_mes04_petcamp_bg = local_adocao($anoadocao,'04','Petcamp Barão Geraldo',$connect);
				 $adotados_mes05_petcamp_bg = local_adocao($anoadocao,'05','Petcamp Barão Geraldo',$connect);
				 $adotados_mes06_petcamp_bg = local_adocao($anoadocao,'06','Petcamp Barão Geraldo',$connect);
				 $adotados_mes07_petcamp_bg = local_adocao($anoadocao,'07','Petcamp Barão Geraldo',$connect);
				 $adotados_mes08_petcamp_bg = local_adocao($anoadocao,'08','Petcamp Barão Geraldo',$connect);
				 $adotados_mes09_petcamp_bg = local_adocao($anoadocao,'09','Petcamp Barão Geraldo',$connect);
				 $adotados_mes10_petcamp_bg = local_adocao($anoadocao,'10','Petcamp Barão Geraldo',$connect);
				 $adotados_mes11_petcamp_bg = local_adocao($anoadocao,'11','Petcamp Barão Geraldo',$connect);
				 $adotados_mes12_petcamp_bg = local_adocao($anoadocao,'12','Petcamp Barão Geraldo',$connect);
				 $adotados_mes01_petcamp_jasmim = local_adocao($anoadocao,'01','Petcamp Jasmim',$connect);
				 $adotados_mes02_petcamp_jasmim = local_adocao($anoadocao,'02','Petcamp Jasmim',$connect);
				 $adotados_mes03_petcamp_jasmim = local_adocao($anoadocao,'03','Petcamp Jasmim',$connect);
				 $adotados_mes04_petcamp_jasmim = local_adocao($anoadocao,'04','Petcamp Jasmim',$connect);
				 $adotados_mes05_petcamp_jasmim = local_adocao($anoadocao,'05','Petcamp Jasmim',$connect);
				 $adotados_mes06_petcamp_jasmim = local_adocao($anoadocao,'06','Petcamp Jasmim',$connect);
				 $adotados_mes07_petcamp_jasmim = local_adocao($anoadocao,'07','Petcamp Jasmim',$connect);
				 $adotados_mes08_petcamp_jasmim = local_adocao($anoadocao,'08','Petcamp Jasmim',$connect);
				 $adotados_mes09_petcamp_jasmim = local_adocao($anoadocao,'09','Petcamp Jasmim',$connect);
				 $adotados_mes10_petcamp_jasmim = local_adocao($anoadocao,'10','Petcamp Jasmim',$connect);
				 $adotados_mes11_petcamp_jasmim = local_adocao($anoadocao,'11','Petcamp Jasmim',$connect);
				 $adotados_mes12_petcamp_jasmim = local_adocao($anoadocao,'12','Petcamp Jasmim',$connect);
				 
				 
				 $adotados_mes12_petland = local_adocao($anoadocao,'12','Petland',$connect);
				 $adotados_mes01_petland = local_adocao($anoadocao,'01','Petland',$connect);
				 $adotados_mes02_petland = local_adocao($anoadocao,'02','Petland',$connect);
				 $adotados_mes03_petland = local_adocao($anoadocao,'03','Petland',$connect);
				 $adotados_mes04_petland = local_adocao($anoadocao,'04','Petland',$connect);
				 $adotados_mes05_petland = local_adocao($anoadocao,'05','Petland',$connect);
				 $adotados_mes06_petland = local_adocao($anoadocao,'06','Petland',$connect);
				 $adotados_mes07_petland = local_adocao($anoadocao,'07','Petland',$connect);
				 $adotados_mes08_petland = local_adocao($anoadocao,'08','Petland',$connect);
				 $adotados_mes09_petland = local_adocao($anoadocao,'09','Petland',$connect);
				 $adotados_mes10_petland = local_adocao($anoadocao,'10','Petland',$connect);
				 $adotados_mes11_petland = local_adocao($anoadocao,'11','Petland',$connect);
				 $adotados_mes12_petland = local_adocao($anoadocao,'12','Petland',$connect);
				 $adotados_mes12_petland = local_adocao($anoadocao,'12','Petland',$connect);
				 
				 $adotados_mes01_leroy = local_adocao($anoadocao,'01','Leroy M Dom Pedro',$connect);
				 $adotados_mes02_leroy = local_adocao($anoadocao,'02','Leroy M Dom Pedro',$connect);
				 $adotados_mes03_leroy = local_adocao($anoadocao,'03','Leroy M Dom Pedro',$connect);
				 $adotados_mes04_leroy = local_adocao($anoadocao,'04','Leroy M Dom Pedro',$connect);
				 $adotados_mes05_leroy = local_adocao($anoadocao,'05','Leroy M Dom Pedro',$connect);
				 $adotados_mes06_leroy = local_adocao($anoadocao,'06','Leroy M Dom Pedro',$connect);
				 $adotados_mes07_leroy = local_adocao($anoadocao,'07','Leroy M Dom Pedro',$connect);
				 $adotados_mes08_leroy = local_adocao($anoadocao,'08','Leroy M Dom Pedro',$connect);
				 $adotados_mes09_leroy = local_adocao($anoadocao,'09','Leroy M Dom Pedro',$connect);
				 $adotados_mes10_leroy = local_adocao($anoadocao,'10','Leroy M Dom Pedro',$connect);
				 $adotados_mes11_leroy = local_adocao($anoadocao,'11','Leroy M Dom Pedro',$connect);
				 $adotados_mes12_leroy = local_adocao($anoadocao,'12','Leroy M Dom Pedro',$connect);
				 
				 $adotados_mes01_fora_feira = local_adocao($anoadocao,'01','Fora da feira',$connect);
				 $adotados_mes02_fora_feira = local_adocao($anoadocao,'02','Fora da feira',$connect);
				 $adotados_mes03_fora_feira = local_adocao($anoadocao,'03','Fora da feira',$connect);
				 $adotados_mes04_fora_feira = local_adocao($anoadocao,'04','Fora da feira',$connect);
				 $adotados_mes05_fora_feira = local_adocao($anoadocao,'05','Fora da feira',$connect);
				 $adotados_mes06_fora_feira = local_adocao($anoadocao,'06','Fora da feira',$connect);
				 $adotados_mes07_fora_feira = local_adocao($anoadocao,'07','Fora da feira',$connect);
				 $adotados_mes08_fora_feira = local_adocao($anoadocao,'08','Fora da feira',$connect);
				 $adotados_mes09_fora_feira = local_adocao($anoadocao,'09','Fora da feira',$connect);
				 $adotados_mes10_fora_feira = local_adocao($anoadocao,'10','Fora da feira',$connect);
				 $adotados_mes11_fora_feira = local_adocao($anoadocao,'11','Fora da feira',$connect);
				 $adotados_mes12_fora_feira = local_adocao($anoadocao,'12','Fora da feira',$connect);
				 
				 $adotados_mes01_cc = local_adocao($anoadocao,'01','Centro de Convivência',$connect);
				 $adotados_mes02_cc = local_adocao($anoadocao,'02','Centro de Convivência',$connect);
				 $adotados_mes03_cc = local_adocao($anoadocao,'03','Centro de Convivência',$connect);
				 $adotados_mes04_cc = local_adocao($anoadocao,'04','Centro de Convivência',$connect);
				 $adotados_mes05_cc = local_adocao($anoadocao,'05','Centro de Convivência',$connect);
				 $adotados_mes06_cc = local_adocao($anoadocao,'06','Centro de Convivência',$connect);
				 $adotados_mes07_cc = local_adocao($anoadocao,'07','Centro de Convivência',$connect);
				 $adotados_mes08_cc = local_adocao($anoadocao,'08','Centro de Convivência',$connect);
				 $adotados_mes09_cc = local_adocao($anoadocao,'09','Centro de Convivência',$connect);
				 $adotados_mes10_cc = local_adocao($anoadocao,'10','Centro de Convivência',$connect);
				 $adotados_mes11_cc = local_adocao($anoadocao,'11','Centro de Convivência',$connect);
				 $adotados_mes12_cc = local_adocao($anoadocao,'12','Centro de Convivência',$connect);
				 
				 $castrados_mes01_caes = castrados_mes_caes($anoadocao,'01',$connect);
				 $castrados_mes02_caes = castrados_mes_caes($anoadocao,'02',$connect);
				 $castrados_mes03_caes = castrados_mes_caes($anoadocao,'03',$connect);
				 $castrados_mes04_caes = castrados_mes_caes($anoadocao,'04',$connect);
				 $castrados_mes05_caes = castrados_mes_caes($anoadocao,'05',$connect);
				 $castrados_mes06_caes = castrados_mes_caes($anoadocao,'06',$connect);
				 $castrados_mes07_caes = castrados_mes_caes($anoadocao,'07',$connect);
				 $castrados_mes08_caes = castrados_mes_caes($anoadocao,'08',$connect);
				 $castrados_mes09_caes = castrados_mes_caes($anoadocao,'09',$connect);
				 $castrados_mes10_caes = castrados_mes_caes($anoadocao,'10',$connect);
				 $castrados_mes11_caes = castrados_mes_caes($anoadocao,'11',$connect);
				 $castrados_mes12_caes = castrados_mes_caes($anoadocao,'12',$connect);

				 
				 $castrados_mes01_gatos = castrados_mes_gatos($anoadocao,'01',$connect);
				 $castrados_mes02_gatos = castrados_mes_gatos($anoadocao,'02',$connect);
				 $castrados_mes03_gatos = castrados_mes_gatos($anoadocao,'03',$connect);
				 $castrados_mes04_gatos = castrados_mes_gatos($anoadocao,'04',$connect);
				 $castrados_mes05_gatos = castrados_mes_gatos($anoadocao,'05',$connect);
				 $castrados_mes06_gatos = castrados_mes_gatos($anoadocao,'06',$connect);
				 $castrados_mes07_gatos = castrados_mes_gatos($anoadocao,'07',$connect);
				 $castrados_mes08_gatos = castrados_mes_gatos($anoadocao,'08',$connect);
				 $castrados_mes09_gatos = castrados_mes_gatos($anoadocao,'09',$connect);
				 $castrados_mes10_gatos = castrados_mes_gatos($anoadocao,'10',$connect);
				 $castrados_mes11_gatos = castrados_mes_gatos($anoadocao,'11',$connect);
				 $castrados_mes12_gatos = castrados_mes_gatos($anoadocao,'12',$connect);
				 
				 $total_castrados_caes = castrados_total_caes($anoadocao,$connect);
				 $total_castrados_gatos = castrados_total_gatos($anoadocao,$connect);
				 $total_adocoes_caes = adotados_total_caes($anoadocao,$connect);
 				 $total_adocoes_gatos = adotados_total_gatos($anoadocao,$connect);
				 
				 $adotados_caes = intval($adotados_mes01_caes) +           
						intval($adotados_mes02_caes) +
                        intval($adotados_mes03_caes) +
                        intval($adotados_mes04_caes) +
                        intval($adotados_mes05_caes) +
                        intval($adotados_mes06_caes) +
                        intval($adotados_mes07_caes) +
						intval($adotados_mes08_caes) +
						intval($adotados_mes09_caes) +
						intval($adotados_mes10_caes) +
						intval($adotados_mes11_caes) +
                        intval($adotados_mes12_caes);
                        
                $adotados_gatos = intval($adotados_mes01_gatos) +           
						intval($adotados_mes02_gatos) +
                        intval($adotados_mes03_gatos) +
                        intval($adotados_mes04_gatos) +
                        intval($adotados_mes05_gatos) +
                        intval($adotados_mes06_gatos) +
                        intval($adotados_mes07_gatos) +
						intval($adotados_mes08_gatos) +
						intval($adotados_mes09_gatos) +
						intval($adotados_mes10_gatos) +
						intval($adotados_mes11_gatos) +
                        intval($adotados_mes12_gatos);
                        
                $castrados_gatos = intval($castrados_mes01_gatos) +           
						intval($castrados_mes02_gatos) +
                        intval($castrados_mes03_gatos) +
                        intval($castrados_mes04_gatos) +
                        intval($castrados_mes05_gatos) +
                        intval($castrados_mes06_gatos) +
                        intval($castrados_mes07_gatos) +
						intval($castrados_mes08_gatos) +
						intval($castrados_mes09_gatos) +
						intval($castrados_mes10_gatos) +
						intval($castrados_mes11_gatos) +
                        intval($castrados_mes12_gatos); 
                
                $castrados_caes = intval($castrados_mes01_caes) +           
						intval($castrados_mes02_caes) +
                        intval($castrados_mes03_caes) +
                        intval($castrados_mes04_caes) +
                        intval($castrados_mes05_caes) +
                        intval($castrados_mes06_caes) +
                        intval($castrados_mes07_caes) +
						intval($castrados_mes08_caes) +
						intval($castrados_mes09_caes) +
						intval($castrados_mes10_caes) +
						intval($castrados_mes11_caes) +
                        intval($castrados_mes12_caes); 
                        
                $total_anoadocao_petz = intval($adotados_mes01_petz) + 
						intval($adotados_mes02_petz) +
                        intval($adotados_mes03_petz) +
                        intval($adotados_mes04_petz) +
                        intval($adotados_mes05_petz) +
                        intval($adotados_mes06_petz) +
                        intval($adotados_mes07_petz) +
						intval($adotados_mes08_petz) +
						intval($adotados_mes09_petz) +
						intval($adotados_mes10_petz) +
						intval($adotados_mes11_petz) +
                        intval($adotados_mes12_petz);
                        
                $total_anoadocao_petcenter = intval($adotados_mes01_petcenter) +
                        intval($adotados_mes02_petcenter) +
                        intval($adotados_mes03_petcenter) +
                        intval($adotados_mes04_petcenter) +
                        intval($adotados_mes05_petcenter) +
                        intval($adotados_mes06_petcenter) +
                        intval($adotados_mes07_petcenter) +
						intval($adotados_mes08_petcenter) +
						intval($adotados_mes09_petcenter) +
						intval($adotados_mes10_petcenter) +
						intval($adotados_mes11_petcenter) +
                        intval($adotados_mes12_petcenter);
                        
                $total_anoadocao_petland = intval($adotados_mes01_petland) +           
						intval($adotados_mes02_petland) +
                        intval($adotados_mes03_petland) +
                        intval($adotados_mes04_petland) +
                        intval($adotados_mes05_petland) +
                        intval($adotados_mes06_petland) +
                        intval($adotados_mes07_petland) +
						intval($adotados_mes08_petland) +
						intval($adotados_mes09_petland) +
						intval($adotados_mes10_petland) +
						intval($adotados_mes11_petland) +
                        intval($adotados_mes12_petland);
                        
                $total_anoadocao_petcamp_bg = intval($adotados_mes01_petcamp_bg) +           
						intval($adotados_mes02_petcamp_bg) +
                        intval($adotados_mes03_petcamp_bg) +
                        intval($adotados_mes04_petcamp_bg) +
                        intval($adotados_mes05_petcamp_bg) +
                        intval($adotados_mes06_petcamp_bg) +
                        intval($adotados_mes07_petcamp_bg) +
						intval($adotados_mes08_petcamp_bg) +
						intval($adotados_mes09_petcamp_bg) +
						intval($adotados_mes10_petcamp_bg) +
						intval($adotados_mes11_petcamp_bg) +
                        intval($adotados_mes12_petcamp_bg);
                        
                $total_anoadocao_petcamp_jas = intval($adotados_mes01_petcamp_jas) +           
						intval($adotados_mes02_petcamp_jas) +
                        intval($adotados_mes03_petcamp_jas) +
                        intval($adotados_mes04_petcamp_jas) +
                        intval($adotados_mes05_petcamp_jas) +
                        intval($adotados_mes06_petcamp_jas) +
                        intval($adotados_mes07_petcamp_jas) +
						intval($adotados_mes08_petcamp_jas) +
						intval($adotados_mes09_petcamp_jas) +
						intval($adotados_mes10_petcamp_jas) +
						intval($adotados_mes11_petcamp_jas) +
                        intval($adotados_mes12_petcamp_jas);
                        
                $total_anoadocao_fora_feira = intval($adotados_mes01_fora_feira) +           
						intval($adotados_mes02_fora_feira) +
                        intval($adotados_mes03_fora_feira) +
                        intval($adotados_mes04_fora_feira) +
                        intval($adotados_mes05_fora_feira) +
                        intval($adotados_mes06_fora_feira) +
                        intval($adotados_mes07_fora_feira) +
						intval($adotados_mes08_fora_feira) +
						intval($adotados_mes09_fora_feira) +
						intval($adotados_mes10_fora_feira) +
						intval($adotados_mes11_fora_feira) +
                        intval($adotados_mes12_fora_feira);
                        
                $total_anoadocao_cc = intval($adotados_mes01_cc) +           
						intval($adotados_mes02_cc) +
                        intval($adotados_mes03_cc) +
                        intval($adotados_mes04_cc) +
                        intval($adotados_mes05_cc) +
                        intval($adotados_mes06_cc) +
                        intval($adotados_mes07_cc) +
						intval($adotados_mes08_cc) +
						intval($adotados_mes09_cc) +
						intval($adotados_mes10_cc) +
						intval($adotados_mes11_cc) +
                        intval($adotados_mes12_cc);
                        
                $total_anoadocao_leroy = intval($adotados_mes01_leroy) +           
						intval($adotados_mes02_leroy) +
                        intval($adotados_mes03_leroy) +
                        intval($adotados_mes04_leroy) +
                        intval($adotados_mes05_leroy) +
                        intval($adotados_mes06_leroy) +
                        intval($adotados_mes07_leroy) +
						intval($adotados_mes08_leroy) +
						intval($adotados_mes09_leroy) +
						intval($adotados_mes10_leroy) +
						intval($adotados_mes11_leroy) +
                        intval($adotados_mes12_leroy);
				 
				 $animais_adotados = intval ($adotados_caes) + intval ($adotados_gatos);
				 
				 $animais_doados_castrados = intval ($castrados_gatos) + intval ($castrados_caes);
				 
				 $animais_doados_naocastrados = $animais_adotados - $animais_doados_castrados;
				 
				 $adotados_caes_femeas = adotados_ano_femeas($anoadocao,'Canina',$connect);
				 $adotados_caes_machos = adotados_ano_machos($anoadocao,'Canina',$connect);
				
				 $adotados_gatos_femeas = adotados_ano_femeas($anoadocao,'Felina',$connect);
				 $adotados_gatos_machos = adotados_ano_machos($anoadocao,'Felina',$connect);
				
				 $perc_caes = (intval($adotados_caes) / intval($animais_adotados))*100;
				 $perc_caes_femeas = (intval($adotados_caes_femeas) / intval($animais_adotados))*100;
				 $perc_caes_machos = (intval($adotados_caes_machos) / intval($animais_adotados))*100;
				
				 $perc_gatos = (intval($adotados_gatos) / intval($animais_adotados))*100;
				 $perc_gatos_femeas = (intval($adotados_gatos_femeas) / intval($animais_adotados))*100;
				 $perc_gatos_machos = (intval($adotados_gatos_machos) / intval($animais_adotados))*100;
				 
				 echo "<center><table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
                            <th scope='col'>&nbsp;</th>
							<th scope='col'>&nbsp;</th>
							<th scope='col' colspan='2'>Adoções</th>
							<th scope='col' colspan='2'>Animais doados castrados</th>
							<th scope='col' colspan='2'>Locais</th>
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Ano</th>
							<th scope='col'>Mês</th>
							<th scope='col'>Cães</th>
							<th scope='col'>Gatos</th>
							<th scope='col'>Cães</th>
							<th scope='col'>Gatos</th>";
							/*if ($anoadocao <='2018'){
							    echo "<th scope='col'>Petz</th>
							          <th scope='col'>Pet Marginal</th>";
							} else {
							     echo "<th scope='col'>Centro de Convivência</th>";
							}*/
							echo "
							<th scope='col'>Petcamp Barão</th>
							<th scope='col'>Fora da feira</th>
						  </tr>
						  </thead>
						  <tbody>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_mes01_caes."</td>
							<td>".$adotados_mes01_gatos."</td>
							<td>".$castrados_mes01_caes."</td>
							<td>".$castrados_mes01_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$adotados_mes01_petz."</td>
							          <td>".$adotados_mes01_petcenter."</td>";
							} else {
							     echo "<td>".$adotados_mes01_cc."</td>";
							}*/
							echo "<td>".$adotados_mes01_petcamp_bg."</td>
							<td>".$adotados_mes01_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_mes02_caes."</td>
							<td>".$adotados_mes02_gatos."</td>
							<td>".$castrados_mes02_caes."</td>
							<td>".$castrados_mes02_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$adotados_mes02_petz."</td>
							          <td>".$adotados_mes02_petcenter."</td>";
							} else {
							     echo "<td>".$adotados_mes02_cc."</td>";
							}*/
							echo "<td>".$adotados_mes02_petcamp_bg."</td>
							<td>".$adotados_mes02_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Março</th>
							<td>".$adotados_mes03_caes."</td>
							<td>".$adotados_mes03_gatos."</td>
							<td>".$castrados_mes03_caes."</td>
							<td>".$castrados_mes03_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$adotados_mes03_petz."</td>
							          <td>".$adotados_mes03_petcenter."</td>";
							} else {
							     echo "<td>".$adotados_mes03_cc."</td>";
							}*/
							echo "<td>".$adotados_mes03_petcamp_bg."</td>
							<td>".$adotados_mes03_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_mes04_caes."</td>
							<td>".$adotados_mes04_gatos."</td>
							<td>".$castrados_mes04_caes."</td>
							<td>".$castrados_mes04_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$adotados_mes04_petz."</td>
							          <td>".$adotados_mes04_petcenter."</td>";
							} else {
							     echo "<td>".$adotados_mes04_cc."</td>";
							}*/
							echo "<td>".$adotados_mes04_petcamp_bg."</td>
							<td>".$adotados_mes04_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_mes05_caes."</td>
							<td>".$adotados_mes05_gatos."</td>
							<td>".$castrados_mes05_caes."</td>
							<td>".$castrados_mes05_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$adotados_mes05_petz."</td>
							          <td>".$adotados_mes05_petcenter."</td>";
							} else {
							     echo "<td>".$adotados_mes05_cc."</td>";
							}*/
							echo "<td>".$adotados_mes05_petcamp_bg."</td>
							<td>".$adotados_mes05_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_mes06_caes."</td>
							<td>".$adotados_mes06_gatos."</td>
							<td>".$castrados_mes06_caes."</td>
							<td>".$castrados_mes06_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$adotados_mes06_petz."</td>
							          <td>".$adotados_mes06_petcenter."</td>";
							} else {
							     echo "<td>".$adotados_mes06_cc."</td>";
							}*/
							echo "<td>".$adotados_mes06_petcamp_bg."</td>
							<td>".$adotados_mes06_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_mes07_caes."</td>
							<td>".$adotados_mes07_gatos."</td>
							<td>".$castrados_mes07_caes."</td>
							<td>".$castrados_mes07_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$adotados_mes07_petz."</td>
							          <td>".$adotados_mes07_petcenter."</td>";
							} else {
							     echo "<td>".$adotados_mes07_cc."</td>";
							}*/
							echo "<td>".$adotados_mes07_petcamp_bg."</td>
							<td>".$adotados_mes07_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_mes08_caes."</td>
							<td>".$adotados_mes08_gatos."</td>
							<td>".$castrados_mes08_caes."</td>
							<td>".$castrados_mes08_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$adotados_mes08_petz."</td>
							          <td>".$adotados_mes08_petcenter."</td>";
							} else {
							     echo "<td>".$adotados_mes08_cc."</td>";
							}*/
							echo "<td>".$adotados_mes08_petcamp_bg."</td>
							<td>".$adotados_mes08_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_mes09_caes."</td>
							<td>".$adotados_mes09_gatos."</td>
							<td>".$castrados_mes09_caes."</td>
							<td>".$castrados_mes09_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$adotados_mes09_petz."</td>
							          <td>".$adotados_mes09_petcenter."</td>";
							} else {
							     echo "<td>".$adotados_mes09_cc."</td>";
							}*/
							echo "<td>".$adotados_mes09_petcamp_bg."</td>
							<td>".$adotados_mes09_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_mes10_caes."</td>
							<td>".$adotados_mes10_gatos."</td>
							<td>".$castrados_mes10_caes."</td>
							<td>".$castrados_mes10_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$adotados_mes10_petz."</td>
							          <td>".$adotados_mes10_petcenter."</td>";
							} else {
							     echo "<td>".$adotados_mes10_cc."</td>";
							}*/
							echo "<td>".$adotados_mes10_petcamp_bg."</td>
							<td>".$adotados_mes10_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_mes11_caes."</td>
							<td>".$adotados_mes11_gatos."</td>
							<td>".$castrados_mes11_caes."</td>
							<td>".$castrados_mes11_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$adotados_mes11_petz."</td>
							          <td>".$adotados_mes11_petcenter."</td>";
							} else {
							     echo "<td>".$adotados_mes11_cc."</td>";
							}*/
							echo "<td>".$adotados_mes11_petcamp_bg."</td>
							<td>".$adotados_mes11_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_mes12_caes."</td>
							<td>".$adotados_mes12_gatos."</td>
							<td>".$castrados_mes12_caes."</td>
							<td>".$castrados_mes12_gatos."</td>";
							/*if ($anoadocao <='2018'){
							    echo "<td>".$adotados_mes12_petz."</td>
							          <td>".$adotados_mes12_petcenter."</td>";
							} else {
							     echo "<td>".$adotados_mes12_cc."</td>";
							}*/
							echo "<td>".$adotados_mes12_petcamp_bg."</td>
							<td>".$adotados_mes12_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row' colspan='2'>TOTAL</th>
							<td class='text-danger'>$adotados_caes</td>
							<td class='text-danger'>$adotados_gatos</td>
							<td class='text-danger'>$castrados_caes</td>
							<td class='text-danger'>$castrados_gatos</td>";
							/*if ($anoadocao <='2018'){
							       echo "<td class='text-danger'>$total_anoadocao_petz</td>
							        <td class='text-danger'>$total_anoadocao_petcenter</td>";
							} else {
							        echo "<td class='text-danger'>$total_anoadocao_cc</td>";   
							}*/
							echo "<td class='text-danger'>$total_anoadocao_petcamp_bg</td>
							<td class='text-danger'>$total_anoadocao_fora_feira</td>
						  </tr>
						  </tbody>
						 </table></center>
						 
						 <br>
                			       <center>
                                        <h3>RESUMO</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                	    </thead>
                                    	<tbody>
                                        	<tr>
                            					<th scope='row'>Animais doados</th>
                            					<td>".$animais_adotados."</td>
                        					</tr>
                        					<tr>
                            					<th scope='row'>Animais doados castrados</th>
                            					<td>".$animais_doados_castrados."</td>
                        					</tr>
                        					<tr>
                            					<th scope='row'>Animais doados não castrados (menores de 5 meses)</th>
                            					<td>".$animais_doados_naocastrados."</td>
                        					</tr>
                    					</tbody>
                    				</table>
                    				
                    				<center>
                                        <h3>ESTATÍSTICAS</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                        <tr>
                        					<th scope='row'>Percentual de cães adotados</th>
                        					<th>".number_format($perc_caes,2,',', '.')."%</th>
                    					</tr>
                                	    </thead>
                                    	<tbody>
                    					
                    					<tr>
                        					<th>Fêmeas</th>
                        					<td>".number_format($perc_caes_femeas,2,',', '.')."%</td>
                    					</tr>
                    					<tr>
                        					<th>Machos</th>
                        					<td>".number_format($perc_caes_machos,2,',', '.')."%</td>
                    					</tr>
                    					</tbody>
                    				</table>
                    				<br>
                    				<table class='table'>
                                        <thead class='thead-light'>
                                        <tr>
                        					<th scope='row'>Percentual de gatos adotados</th>
                        					<th>".number_format($perc_gatos,2,',', '.')."%</th>
                    					</tr>
                                	    </thead>
                                    	<tbody>
                    					<tr>
                        					<th>Fêmeas</th>
                        					<td>".number_format($perc_gatos_femeas,2,',', '.')."%</td>
                    					</tr>
                    					<tr>
                        					<th>Machos</th>
                        					<td>".number_format($perc_gatos_machos,2,',', '.')."%</td>
                    					</tr>
                    					</tbody>
                    				</table>";
				
				$assunto = "Relatório de adoções do ano de ".$anoadocao."";
				
				$mensagem = "<center><table class='table' >
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
							<th scope='row'>Janeiro</th>
							<td>".$adotados_mes01_caes."</td>
							<td>".$adotados_mes01_gatos."</td>
							<td>".$castrados_mes01_caes."</td>
							<td>".$castrados_mes01_gatos."</td>
							<td>".$adotados_mes01_petz."</td>
							<td>".$adotados_mes01_petcenter."</td>
							<td>".$adotados_mes01_petcamp_bg."</td>
							<td>".$adotados_mes01_petcamp_jasmim."</td>
							<td>".$adotados_mes01_petland."</td>
							<td>".$adotados_mes01_leroy."</td>
							<td>".$adotados_mes01_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_mes02_caes."</td>
							<td>".$adotados_mes02_gatos."</td>
							<td>".$castrados_mes02_caes."</td>
							<td>".$castrados_mes02_gatos."</td>
							<td>".$adotados_mes02_petz."</td>
							<td>".$adotados_mes02_petcenter."</td>
							<td>".$adotados_mes02_petcamp_bg."</td>
							<td>".$adotados_mes02_petcamp_jasmim."</td>
							<td>".$adotados_mes02_petland."</td>
							<td>".$adotados_mes02_leroy."</td>
							<td>".$adotados_mes02_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Março</th>
							<td>".$adotados_mes03_caes."</td>
							<td>".$adotados_mes03_gatos."</td>
							<td>".$castrados_mes03_caes."</td>
							<td>".$castrados_mes03_gatos."</td>
							<td>".$adotados_mes03_petz."</td>
							<td>".$adotados_mes03_petcenter."</td>
							<td>".$adotados_mes03_petcamp_bg."</td>
							<td>".$adotados_mes03_petcamp_jasmim."</td>
							<td>".$adotados_mes03_petland."</td>
							<td>".$adotados_mes03_leroy."</td>
							<td>".$adotados_mes03_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_mes04_caes."</td>
							<td>".$adotados_mes04_gatos."</td>
							<td>".$castrados_mes04_caes."</td>
							<td>".$castrados_mes04_gatos."</td>
							<td>".$adotados_mes04_petz."</td>
							<td>".$adotados_mes04_petcenter."</td>
							<td>".$adotados_mes04_petcamp_bg."</td>
							<td>".$adotados_mes04_petcamp_jasmim."</td>
							<td>".$adotados_mes04_petland."</td>
							<td>".$adotados_mes04_leroy."</td>
							<td>".$adotados_mes04_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_mes05_caes."</td>
							<td>".$adotados_mes05_gatos."</td>
							<td>".$castrados_mes05_caes."</td>
							<td>".$castrados_mes05_gatos."</td>
							<td>".$adotados_mes05_petz."</td>
							<td>".$adotados_mes05_petcenter."</td>
							<td>".$adotados_mes05_petcamp_bg."</td>
							<td>".$adotados_mes05_petcamp_jasmim."</td>
							<td>".$adotados_mes05_petland."</td>
							<td>".$adotados_mes05_leroy."</td>
							<td>".$adotados_mes05_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_mes06_caes."</td>
							<td>".$adotados_mes06_gatos."</td>
							<td>".$castrados_mes06_caes."</td>
							<td>".$castrados_mes06_gatos."</td>
							<td>".$adotados_mes06_petz."</td>
							<td>".$adotados_mes06_petcenter."</td>
							<td>".$adotados_mes06_petcamp_bg."</td>
							<td>".$adotados_mes06_petcamp_jasmim."</td>
							<td>".$adotados_mes06_petland."</td>
							<td>".$adotados_mes06_leroy."</td>
							<td>".$adotados_mes06_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_mes07_caes."</td>
							<td>".$adotados_mes07_gatos."</td>
							<td>".$castrados_mes07_caes."</td>
							<td>".$castrados_mes07_gatos."</td>
							<td>".$adotados_mes07_petz."</td>
							<td>".$adotados_mes07_petcenter."</td>
							<td>".$adotados_mes07_petcamp_bg."</td>
							<td>".$adotados_mes07_petcamp_jasmim."</td>
							<td>".$adotados_mes07_petland."</td>
							<td>".$adotados_mes07_leroy."</td>
							<td>".$adotados_mes07_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_mes08_caes."</td>
							<td>".$adotados_mes08_gatos."</td>
							<td>".$castrados_mes08_caes."</td>
							<td>".$castrados_mes08_gatos."</td>
							<td>".$adotados_mes08_petz."</td>
							<td>".$adotados_mes08_petcenter."</td>
							<td>".$adotados_mes08_petcamp_bg."</td>
							<td>".$adotados_mes08_petcamp_jasmim."</td>
							<td>".$adotados_mes08_petland."</td>
							<td>".$adotados_mes08_leroy."</td>
							<td>".$adotados_mes08_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_mes09_caes."</td>
							<td>".$adotados_mes09_gatos."</td>
							<td>".$castrados_mes09_caes."</td>
							<td>".$castrados_mes09_gatos."</td>
							<td>".$adotados_mes09_petz."</td>
							<td>".$adotados_mes09_petcenter."</td>
							<td>".$adotados_mes09_petcamp_bg."</td>
							<td>".$adotados_mes09_petcamp_jasmim."</td>
							<td>".$adotados_mes09_petland."</td>
							<td>".$adotados_mes09_leroy."</td>
							<td>".$adotados_mes09_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_mes10_caes."</td>
							<td>".$adotados_mes10_gatos."</td>
							<td>".$castrados_mes10_caes."</td>
							<td>".$castrados_mes10_gatos."</td>
							<td>".$adotados_mes10_petz."</td>
							<td>".$adotados_mes10_petcenter."</td>
							<td>".$adotados_mes10_petcamp_bg."</td>
							<td>".$adotados_mes10_petcamp_jasmim."</td>
							<td>".$adotados_mes10_petland."</td>
							<td>".$adotados_mes10_leroy."</td>
							<td>".$adotados_mes10_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_mes11_caes."</td>
							<td>".$adotados_mes11_gatos."</td>
							<td>".$castrados_mes11_caes."</td>
							<td>".$castrados_mes11_gatos."</td>
							<td>".$adotados_mes11_petz."</td>
							<td>".$adotados_mes11_petcenter."</td>
							<td>".$adotados_mes11_petcamp_bg."</td>
							<td>".$adotados_mes11_petcamp_jasmim."</td>
							<td>".$adotados_mes11_petland."</td>
							<td>".$adotados_mes11_leroy."</td>
							<td>".$adotados_mes11_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>".$anoadocao."</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_mes12_caes."</td>
							<td>".$adotados_mes12_gatos."</td>
							<td>".$castrados_mes12_caes."</td>
							<td>".$castrados_mes12_gatos."</td>
							<td>".$adotados_mes12_petz."</td>
							<td>".$adotados_mes12_petcenter."</td>
							<td>".$adotados_mes12_petcamp_bg."</td>
							<td>".$adotados_mes12_petcamp_jasmim."</td>
							<td>".$adotados_mes12_petland."</td>
							<td>".$adotados_mes12_leroy."</td>
							<td>".$adotados_mes12_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row' colspan='2'>TOTAL</th>
							<td class='text-danger'>$adotados_caes</td>
							<td class='text-danger'>$adotados_gatos</td>
							<td class='text-danger'>$castrados_caes</td>
							<td class='text-danger'>$castrados_gatos</td>
							<td class='text-danger'>$total_anoadocao_petz</td>
							<td class='text-danger'>$total_anoadocao_petcenter</td>
							<td class='text-danger'>$total_anoadocao_petcamp_bg</td>
							<td class='text-danger'>$total_anoadocao_petcamp_jas</td>
							<td class='text-danger'>$total_anoadocao_petland</td>
							<td class='text-danger'>$total_anoadocao_leroy</td>
							<td class='text-danger'>$total_anoadocao_fora_feira</td>
						  </tr>
						  </tbody>
						 </table></center>
						 
						 <br>
                			       <center>
                                        <h3>RESUMO</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                	    </thead>
                                    	<tbody>
                                        	<tr>
                            					<th scope='row'>Animais doados</th>
                            					<td>".$animais_adotados."</td>
                        					</tr>
                        					<tr>
                            					<th scope='row'>Animais doados castrados</th>
                            					<td>".$animais_castrados."</td>
                        					</tr>
                        					<tr>
                            					<th scope='row'>Animais doados não castrados (menores de 5 meses)</th>
                            					<td>".$animais_naocastrados."</td>
                        					</tr>
                    					</tbody>
                    				</table>
                    				
                    				<center>
                                        <h3>ESTATÍSTICAS</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                        <tr>
                        					<th scope='row'>Percentual de cães adotados</th>
                        					<th>".number_format($perc_caes,2,',', '.')."%</th>
                    					</tr>
                                	    </thead>
                                    	<tbody>
                    					
                    					<tr>
                        					<th>Fêmeas</th>
                        					<td>".number_format($perc_caes_femeas,2,',', '.')."%</td>
                    					</tr>
                    					<tr>
                        					<th>Machos</th>
                        					<td>".number_format($perc_caes_machos,2,',', '.')."%</td>
                    					</tr>
                    					</tbody>
                    				</table>
                    				<br>
                    				<table class='table'>
                                        <thead class='thead-light'>
                                        <tr>
                        					<th scope='row'>Percentual de gatos adotados</th>
                        					<th>".number_format($perc_gatos,2,',', '.')."%</th>
                    					</tr>
                                	    </thead>
                                    	<tbody>
                    					<tr>
                        					<th>Fêmeas</th>
                        					<td>".number_format($perc_gatos_femeas,2,',', '.')."%</td>
                    					</tr>
                    					<tr>
                        					<th>Machos</th>
                        					<td>".number_format($perc_gatos_machos,2,',', '.')."%</td>
                    					</tr>
                    					</tbody>
                    				</table>";
				
				}
			  if ($anoadocao == '' && $mesadocao == '' && $localadocao == '' && $comtermos == ''){
				  /********* 2014 **********/
				 $total_201401_petcamp_bg = local_adocao('2014','01','Petcamp Barão Geraldo',$connect);
				 $total_201402_petcamp_bg = local_adocao('2014','02','Petcamp Barão Geraldo',$connect);
				 $total_201403_petcamp_bg = local_adocao('2014','03','Petcamp Barão Geraldo',$connect);
				 $total_201404_petcamp_bg = local_adocao('2014','04','Petcamp Barão Geraldo',$connect);
				 $total_201405_petcamp_bg = local_adocao('2014','05','Petcamp Barão Geraldo',$connect);
				 $total_201406_petcamp_bg = local_adocao('2014','06','Petcamp Barão Geraldo',$connect);
				 $total_201407_petcamp_bg = local_adocao('2014','07','Petcamp Barão Geraldo',$connect);
				 $total_201408_petcamp_bg = local_adocao('2014','08','Petcamp Barão Geraldo',$connect);
				 $total_201409_petcamp_bg = local_adocao('2014','09','Petcamp Barão Geraldo',$connect);
				 $total_201410_petcamp_bg = local_adocao('2014','10','Petcamp Barão Geraldo',$connect);
				 $total_201411_petcamp_bg = local_adocao('2014','11','Petcamp Barão Geraldo',$connect);
				 $total_201412_petcamp_bg = local_adocao('2014','12','Petcamp Barão Geraldo',$connect);
				 $total_201401_petcamp_jas = local_adocao('2014','01','Petcamp Jasmim',$connect);
				 $total_201402_petcamp_jas = local_adocao('2014','02','Petcamp Jasmim',$connect);
				 $total_201403_petcamp_jas = local_adocao('2014','03','Petcamp Jasmim',$connect);
				 $total_201404_petcamp_jas = local_adocao('2014','04','Petcamp Jasmim',$connect);
				 $total_201405_petcamp_jas = local_adocao('2014','05','Petcamp Jasmim',$connect);
				 $total_201406_petcamp_jas = local_adocao('2014','06','Petcamp Jasmim',$connect);
				 $total_201407_petcamp_jas = local_adocao('2014','07','Petcamp Jasmim',$connect);
				 $total_201408_petcamp_jas = local_adocao('2014','08','Petcamp Jasmim',$connect);
				 $total_201409_petcamp_jas = local_adocao('2014','09','Petcamp Jasmim',$connect);
				 $total_201410_petcamp_jas = local_adocao('2014','10','Petcamp Jasmim',$connect);
				 $total_201411_petcamp_jas = local_adocao('2014','11','Petcamp Jasmim',$connect);
				 $total_201412_petcamp_jas = local_adocao('2014','12','Petcamp Jasmim',$connect);
				 $total_201401_petcenter = local_adocao('2014','01','Pet Center Marginal',$connect);
				 $total_201402_petcenter = local_adocao('2014','02','Pet Center Marginal',$connect);
				 $total_201403_petcenter = local_adocao('2014','03','Pet Center Marginal',$connect);
				 $total_201404_petcenter = local_adocao('2014','04','Pet Center Marginal',$connect);
				 $total_201405_petcenter = local_adocao('2014','05','Pet Center Marginal',$connect);
				 $total_201406_petcenter = local_adocao('2014','06','Pet Center Marginal',$connect);
				 $total_201407_petcenter = local_adocao('2014','07','Pet Center Marginal',$connect);
				 $total_201408_petcenter = local_adocao('2014','08','Pet Center Marginal',$connect);
				 $total_201409_petcenter = local_adocao('2014','09','Pet Center Marginal',$connect);
				 $total_201410_petcenter = local_adocao('2014','10','Pet Center Marginal',$connect);
				 $total_201411_petcenter = local_adocao('2014','11','Pet Center Marginal',$connect);
				 $total_201412_petcenter = local_adocao('2014','12','Pet Center Marginal',$connect);
				 $total_201401_petz = local_adocao('2014','01','Petz',$connect);
				 $total_201402_petz = local_adocao('2014','02','Petz',$connect);
				 $total_201403_petz = local_adocao('2014','03','Petz',$connect);
				 $total_201404_petz = local_adocao('2014','04','Petz',$connect);
				 $total_201405_petz = local_adocao('2014','05','Petz',$connect);
				 $total_201406_petz = local_adocao('2014','06','Petz',$connect);
				 $total_201407_petz = local_adocao('2014','07','Petz',$connect);
				 $total_201408_petz = local_adocao('2014','08','Petz',$connect);
				 $total_201409_petz = local_adocao('2014','09','Petz',$connect);
				 $total_201410_petz = local_adocao('2014','10','Petz',$connect);
				 $total_201411_petz = local_adocao('2014','11','Petz',$connect);
				 $total_201412_petz = local_adocao('2014','12','Petz',$connect);
				 $total_201401_petland = local_adocao('2014','01','Petland',$connect);
				 $total_201402_petland = local_adocao('2014','02','Petland',$connect);
				 $total_201403_petland = local_adocao('2014','03','Petland',$connect);
				 $total_201404_petland = local_adocao('2014','04','Petland',$connect);
				 $total_201405_petland = local_adocao('2014','05','Petland',$connect);
				 $total_201406_petland = local_adocao('2014','06','Petland',$connect);
				 $total_201407_petland = local_adocao('2014','07','Petland',$connect);
				 $total_201408_petland = local_adocao('2014','08','Petland',$connect);
				 $total_201409_petland = local_adocao('2014','09','Petland',$connect);
				 $total_201410_petland = local_adocao('2014','10','Petland',$connect);
				 $total_201411_petland = local_adocao('2014','11','Petland',$connect);
				 $total_201412_petland = local_adocao('2014','12','Petland',$connect);
				 $total_201401_leroy = local_adocao('2014','01','Leroy M Dom Pedro',$connect);
				 $total_201402_leroy = local_adocao('2014','02','Leroy M Dom Pedro',$connect);
				 $total_201403_leroy = local_adocao('2014','03','Leroy M Dom Pedro',$connect);
				 $total_201404_leroy = local_adocao('2014','04','Leroy M Dom Pedro',$connect);
				 $total_201405_leroy = local_adocao('2014','05','Leroy M Dom Pedro',$connect);
				 $total_201406_leroy = local_adocao('2014','06','Leroy M Dom Pedro',$connect);
				 $total_201407_leroy = local_adocao('2014','07','Leroy M Dom Pedro',$connect);
				 $total_201408_leroy = local_adocao('2014','08','Leroy M Dom Pedro',$connect);
				 $total_201409_leroy = local_adocao('2014','09','Leroy M Dom Pedro',$connect);
				 $total_201410_leroy = local_adocao('2014','10','Leroy M Dom Pedro',$connect);
				 $total_201411_leroy = local_adocao('2014','11','Leroy M Dom Pedro',$connect);
				 $total_201412_leroy = local_adocao('2014','12','Leroy M Dom Pedro',$connect);
				 $total_201401_fora_feira = local_adocao('2014','01','Fora da feira',$connect);
				 $total_201402_fora_feira = local_adocao('2014','02','Fora da feira',$connect);
				 $total_201403_fora_feira = local_adocao('2014','03','Fora da feira',$connect);
				 $total_201404_fora_feira = local_adocao('2014','04','Fora da feira',$connect);
				 $total_201405_fora_feira = local_adocao('2014','05','Fora da feira',$connect);
				 $total_201406_fora_feira = local_adocao('2014','06','Fora da feira',$connect);
				 $total_201407_fora_feira = local_adocao('2014','07','Fora da feira',$connect);
				 $total_201408_fora_feira = local_adocao('2014','08','Fora da feira',$connect);
				 $total_201409_fora_feira = local_adocao('2014','09','Fora da feira',$connect);
				 $total_201410_fora_feira = local_adocao('2014','10','Fora da feira',$connect);
				 $total_201411_fora_feira = local_adocao('2014','11','Fora da feira',$connect);
				 $total_201412_fora_feira = local_adocao('2014','12','Fora da feira',$connect);
				 $total_2014_caes = adotados_total_caes('2014',$connect);
				 $total_2014_gatos = adotados_total_gatos('2014',$connect);
				 $castrados_2014_caes = castrados_total_caes('2014',$connect);
				 $castrados_2014_gatos = castrados_total_gatos('2014',$connect);
				 $adotados_201401_caes = adotados_mes_caes('2014','01',$connect);
				 $adotados_201402_caes = adotados_mes_caes('2014','02',$connect);
				 $adotados_201403_caes = adotados_mes_caes('2014','03',$connect);;
				 $adotados_201404_caes = adotados_mes_caes('2014','04',$connect);
				 $adotados_201405_caes = adotados_mes_caes('2014','05',$connect);;
				 $adotados_201406_caes = adotados_mes_caes('2014','06',$connect);
				 $adotados_201407_caes = adotados_mes_caes('2014','07',$connect);
				 $adotados_201408_caes = adotados_mes_caes('2014','08',$connect);
				 $adotados_201409_caes = adotados_mes_caes('2014','09',$connect);
				 $adotados_201410_caes = adotados_mes_caes('2014','10',$connect);
				 $adotados_201411_caes = adotados_mes_caes('2014','11',$connect);
				 $adotados_201412_caes = adotados_mes_caes('2014','12',$connect);
				 $adotados_201401_gatos = adotados_mes_gatos('2014','01',$connect);
				 $adotados_201402_gatos = adotados_mes_gatos('2014','02',$connect);
				 $adotados_201403_gatos = adotados_mes_gatos('2014','03',$connect);
				 $adotados_201404_gatos = adotados_mes_gatos('2014','04',$connect);
				 $adotados_201405_gatos = adotados_mes_gatos('2014','05',$connect);
				 $adotados_201406_gatos = adotados_mes_gatos('2014','06',$connect);
				 $adotados_201407_gatos = adotados_mes_gatos('2014','07',$connect);
				 $adotados_201408_gatos = adotados_mes_gatos('2014','08',$connect);
				 $adotados_201409_gatos = adotados_mes_gatos('2014','09',$connect);
				 $adotados_201410_gatos = adotados_mes_gatos('2014','10',$connect);
				 $adotados_201411_gatos = adotados_mes_gatos('2014','11',$connect);
				 $adotados_201412_gatos = adotados_mes_gatos('2014','12',$connect);
				 $castrados_201401_caes = castrados_mes_caes('2014','01',$connect);
				 $castrados_201402_caes = castrados_mes_caes('2014','02',$connect);
				 $castrados_201403_caes = castrados_mes_caes('2014','03',$connect);
				 $castrados_201404_caes = castrados_mes_caes('2014','04',$connect);
				 $castrados_201405_caes = castrados_mes_caes('2014','05',$connect);
				 $castrados_201406_caes = castrados_mes_caes('2014','06',$connect);
				 $castrados_201407_caes = castrados_mes_caes('2014','07',$connect);
				 $castrados_201408_caes = castrados_mes_caes('2014','08',$connect);
				 $castrados_201409_caes = castrados_mes_caes('2014','09',$connect);
				 $castrados_201410_caes = castrados_mes_caes('2014','10',$connect);
				 $castrados_201411_caes = castrados_mes_caes('2014','11',$connect);
				 $castrados_201412_caes = castrados_mes_caes('2014','12',$connect);
				 $castrados_201401_gatos = castrados_mes_gatos('2014','01',$connect);
				 $castrados_201402_gatos = castrados_mes_gatos('2014','02',$connect);
				 $castrados_201403_gatos = castrados_mes_gatos('2014','03',$connect);
				 $castrados_201404_gatos = castrados_mes_gatos('2014','04',$connect);
				 $castrados_201405_gatos = castrados_mes_gatos('2014','05',$connect);
				 $castrados_201406_gatos = castrados_mes_gatos('2014','06',$connect);
				 $castrados_201407_gatos = castrados_mes_gatos('2014','07',$connect);
				 $castrados_201408_gatos = castrados_mes_gatos('2014','08',$connect);
				 $castrados_201409_gatos = castrados_mes_gatos('2014','09',$connect);
				 $castrados_201410_gatos = castrados_mes_gatos('2014','10',$connect);
				 $castrados_201411_gatos = castrados_mes_gatos('2014','11',$connect);
				 $castrados_201412_gatos = castrados_mes_gatos('2014','12',$connect);
				 
				 $total_201401 = intval($total_201401_petcamp_bg) + intval($total_201401_petcamp_jas) + intval($total_201401_petcenter) + intval($total_201401_petz) + intval($total_201401_petland) + intval($total_201401_leroy) + intval($total_201401_fora_feira);
				 $total_201402 = intval($total_201402_petcamp_bg) + intval($total_201402_petcamp_jas) + intval($total_201402_petcenter) + intval($total_201402_petz) + intval($total_201402_petland) + intval($total_201402_leroy) + intval($total_201402_fora_feira);
				 $total_201403 = intval($total_201403_petcamp_bg) + intval($total_201403_petcamp_jas) + intval($total_201403_petcenter) + intval($total_201403_petz) + intval($total_201403_petland) + intval($total_201403_leroy) + intval($total_201403_fora_feira);
				 $total_201404 = intval($total_201404_petcamp_bg) + intval($total_201404_petcamp_jas) + intval($total_201404_petcenter) + intval($total_201404_petz) + intval($total_201404_petland) + intval($total_201404_leroy) + intval($total_201404_fora_feira);
				 $total_201405 = intval($total_201405_petcamp_bg) + intval($total_201405_petcamp_jas) + intval($total_201405_petcenter) + intval($total_201405_petz) + intval($total_201405_petland) + intval($total_201405_leroy) + intval($total_201405_fora_feira);
				 $total_201406 = intval($total_201406_petcamp_bg) + intval($total_201406_petcamp_jas) + intval($total_201406_petcenter) + intval($total_201406_petz) + intval($total_201406_petland) + intval($total_201406_leroy) + intval($total_201406_fora_feira);
				 $total_201407 = intval($total_201407_petcamp_bg) + intval($total_201407_petcamp_jas) + intval($total_201407_petcenter) + intval($total_201407_petz) + intval($total_201407_petland) + intval($total_201407_leroy) + intval($total_201407_fora_feira);
				 $total_201408 = intval($total_201408_petcamp_bg) + intval($total_201408_petcamp_jas) + intval($total_201408_petcenter) + intval($total_201408_petz) + intval($total_201408_petland) + intval($total_201408_leroy) + intval($total_201408_fora_feira);
				 $total_201409 = intval($total_201409_petcamp_bg) + intval($total_201409_petcamp_jas) + intval($total_201409_petcenter) + intval($total_201409_petz) + intval($total_201409_petland) + intval($total_201409_leroy) + intval($total_201409_fora_feira);
				 $total_201410 = intval($total_201410_petcamp_bg) + intval($total_201410_petcamp_jas) + intval($total_201410_petcenter) + intval($total_201410_petz) + intval($total_201410_petland) + intval($total_201410_leroy) + intval($total_201410_fora_feira);
				 $total_201411 = intval($total_201411_petcamp_bg) + intval($total_201411_petcamp_jas) + intval($total_201411_petcenter) + intval($total_201411_petz) + intval($total_201411_petland) + intval($total_201411_leroy) + intval($total_201411_fora_feira);
				 $total_201412 = intval($total_201412_petcamp_bg) + intval($total_201412_petcamp_jas) + intval($total_201412_petcenter) + intval($total_201412_petz) + intval($total_201412_petland) + intval($total_201412_leroy) + intval($total_201412_fora_feira);
				 $total_2014 = intval($total_201401) + intval($total_201402) + intval($total_201403) + intval($total_201404) + intval($total_201405) + intval($total_201406) + intval($total_201407) + intval($total_201408) + intval($total_201409) + intval($total_201410) + intval($total_201411) + intval($total_201412);
				 
				 /********* 2015 **********/
				 $total_201501_petcamp_bg = local_adocao('2015','01','Petcamp Barão Geraldo',$connect);
				 $total_201502_petcamp_bg = local_adocao('2015','02','Petcamp Barão Geraldo',$connect);
				 $total_201503_petcamp_bg = local_adocao('2015','03','Petcamp Barão Geraldo',$connect);
				 $total_201504_petcamp_bg = local_adocao('2015','04','Petcamp Barão Geraldo',$connect);
				 $total_201505_petcamp_bg = local_adocao('2015','05','Petcamp Barão Geraldo',$connect);
				 $total_201506_petcamp_bg = local_adocao('2015','06','Petcamp Barão Geraldo',$connect);
				 $total_201507_petcamp_bg = local_adocao('2015','07','Petcamp Barão Geraldo',$connect);
				 $total_201508_petcamp_bg = local_adocao('2015','08','Petcamp Barão Geraldo',$connect);
				 $total_201509_petcamp_bg = local_adocao('2015','09','Petcamp Barão Geraldo',$connect);
				 $total_201510_petcamp_bg = local_adocao('2015','10','Petcamp Barão Geraldo',$connect);
				 $total_201511_petcamp_bg = local_adocao('2015','11','Petcamp Barão Geraldo',$connect);
				 $total_201512_petcamp_bg = local_adocao('2015','12','Petcamp Barão Geraldo',$connect);
				 $total_201501_petcamp_jas = local_adocao('2015','01','Petcamp Jasmim',$connect);
				 $total_201502_petcamp_jas = local_adocao('2015','02','Petcamp Jasmim',$connect);
				 $total_201503_petcamp_jas = local_adocao('2015','03','Petcamp Jasmim',$connect);
				 $total_201504_petcamp_jas = local_adocao('2015','04','Petcamp Jasmim',$connect);
				 $total_201505_petcamp_jas = local_adocao('2015','05','Petcamp Jasmim',$connect);
				 $total_201506_petcamp_jas = local_adocao('2015','06','Petcamp Jasmim',$connect);
				 $total_201507_petcamp_jas = local_adocao('2015','07','Petcamp Jasmim',$connect);
				 $total_201508_petcamp_jas = local_adocao('2015','08','Petcamp Jasmim',$connect);
				 $total_201509_petcamp_jas = local_adocao('2015','09','Petcamp Jasmim',$connect);
				 $total_201510_petcamp_jas = local_adocao('2015','10','Petcamp Jasmim',$connect);
				 $total_201511_petcamp_jas = local_adocao('2015','11','Petcamp Jasmim',$connect);
				 $total_201512_petcamp_jas = local_adocao('2015','12','Petcamp Jasmim',$connect);
				 $total_201501_petcenter = local_adocao('2015','01','Pet Center Marginal',$connect);
				 $total_201502_petcenter = local_adocao('2015','02','Pet Center Marginal',$connect);
				 $total_201503_petcenter = local_adocao('2015','03','Pet Center Marginal',$connect);
				 $total_201504_petcenter = local_adocao('2015','04','Pet Center Marginal',$connect);
				 $total_201505_petcenter = local_adocao('2015','05','Pet Center Marginal',$connect);
				 $total_201506_petcenter = local_adocao('2015','06','Pet Center Marginal',$connect);
				 $total_201507_petcenter = local_adocao('2015','07','Pet Center Marginal',$connect);
				 $total_201508_petcenter = local_adocao('2015','08','Pet Center Marginal',$connect);
				 $total_201509_petcenter = local_adocao('2015','09','Pet Center Marginal',$connect);
				 $total_201510_petcenter = local_adocao('2015','10','Pet Center Marginal',$connect);
				 $total_201511_petcenter = local_adocao('2015','11','Pet Center Marginal',$connect);
				 $total_201512_petcenter = local_adocao('2015','12','Pet Center Marginal',$connect);
				 $total_201501_petz = local_adocao('2015','01','Petz',$connect);
				 $total_201502_petz = local_adocao('2015','02','Petz',$connect);
				 $total_201503_petz = local_adocao('2015','03','Petz',$connect);
				 $total_201504_petz = local_adocao('2015','04','Petz',$connect);
				 $total_201505_petz = local_adocao('2015','05','Petz',$connect);
				 $total_201506_petz = local_adocao('2015','06','Petz',$connect);
				 $total_201507_petz = local_adocao('2015','07','Petz',$connect);
				 $total_201508_petz = local_adocao('2015','08','Petz',$connect);
				 $total_201509_petz = local_adocao('2015','09','Petz',$connect);
				 $total_201510_petz = local_adocao('2015','10','Petz',$connect);
				 $total_201511_petz = local_adocao('2015','11','Petz',$connect);
				 $total_201512_petz = local_adocao('2015','12','Petz',$connect);
				 $total_201501_petland = local_adocao('2015','01','Petland',$connect);
				 $total_201502_petland = local_adocao('2015','02','Petland',$connect);
				 $total_201503_petland = local_adocao('2015','03','Petland',$connect);
				 $total_201504_petland = local_adocao('2015','04','Petland',$connect);
				 $total_201505_petland = local_adocao('2015','05','Petland',$connect);
				 $total_201506_petland = local_adocao('2015','06','Petland',$connect);
				 $total_201507_petland = local_adocao('2015','07','Petland',$connect);
				 $total_201508_petland = local_adocao('2015','08','Petland',$connect);
				 $total_201509_petland = local_adocao('2015','09','Petland',$connect);
				 $total_201510_petland = local_adocao('2015','10','Petland',$connect);
				 $total_201511_petland = local_adocao('2015','11','Petland',$connect);
				 $total_201512_petland = local_adocao('2015','12','Petland',$connect);
				 $total_201501_leroy = local_adocao('2015','01','Leroy M Dom Pedro',$connect);
				 $total_201502_leroy = local_adocao('2015','02','Leroy M Dom Pedro',$connect);
				 $total_201503_leroy = local_adocao('2015','03','Leroy M Dom Pedro',$connect);
				 $total_201504_leroy = local_adocao('2015','04','Leroy M Dom Pedro',$connect);
				 $total_201505_leroy = local_adocao('2015','05','Leroy M Dom Pedro',$connect);
				 $total_201506_leroy = local_adocao('2015','06','Leroy M Dom Pedro',$connect);
				 $total_201507_leroy = local_adocao('2015','07','Leroy M Dom Pedro',$connect);
				 $total_201508_leroy = local_adocao('2015','08','Leroy M Dom Pedro',$connect);
				 $total_201509_leroy = local_adocao('2015','09','Leroy M Dom Pedro',$connect);
				 $total_201510_leroy = local_adocao('2015','10','Leroy M Dom Pedro',$connect);
				 $total_201511_leroy = local_adocao('2015','11','Leroy M Dom Pedro',$connect);
				 $total_201512_leroy = local_adocao('2015','12','Leroy M Dom Pedro',$connect);
				 $total_201501_fora_feira = local_adocao('2015','01','Fora da feira',$connect);
				 $total_201502_fora_feira = local_adocao('2015','02','Fora da feira',$connect);
				 $total_201503_fora_feira = local_adocao('2015','03','Fora da feira',$connect);
				 $total_201504_fora_feira = local_adocao('2015','04','Fora da feira',$connect);
				 $total_201505_fora_feira = local_adocao('2015','05','Fora da feira',$connect);
				 $total_201506_fora_feira = local_adocao('2015','06','Fora da feira',$connect);
				 $total_201507_fora_feira = local_adocao('2015','07','Fora da feira',$connect);
				 $total_201508_fora_feira = local_adocao('2015','08','Fora da feira',$connect);
				 $total_201509_fora_feira = local_adocao('2015','09','Fora da feira',$connect);
				 $total_201510_fora_feira = local_adocao('2015','10','Fora da feira',$connect);
				 $total_201511_fora_feira = local_adocao('2015','11','Fora da feira',$connect);
				 $total_201512_fora_feira = local_adocao('2015','12','Fora da feira',$connect);
				 $total_2015_caes = adotados_total_caes('2015',$connect);
				 $total_2015_gatos = adotados_total_gatos('2015',$connect);
				 $castrados_2015_caes = castrados_total_caes('2015',$connect);
				 $castrados_2015_gatos = castrados_total_gatos('2015',$connect);
				 $adotados_201501_caes = adotados_mes_caes('2015','01',$connect);
				 $adotados_201502_caes = adotados_mes_caes('2015','02',$connect);
				 $adotados_201503_caes = adotados_mes_caes('2015','03',$connect);
				 $adotados_201504_caes = adotados_mes_caes('2015','04',$connect);
				 $adotados_201505_caes = adotados_mes_caes('2015','05',$connect);
				 $adotados_201506_caes = adotados_mes_caes('2015','06',$connect);
				 $adotados_201507_caes = adotados_mes_caes('2015','07',$connect);
				 $adotados_201508_caes = adotados_mes_caes('2015','08',$connect);
				 $adotados_201509_caes = adotados_mes_caes('2015','09',$connect);
				 $adotados_201510_caes = adotados_mes_caes('2015','10',$connect);
				 $adotados_201511_caes = adotados_mes_caes('2015','11',$connect);
				 $adotados_201512_caes = adotados_mes_caes('2015','12',$connect);
				 $adotados_201501_gatos = adotados_mes_gatos('2015','01',$connect);
				 $adotados_201502_gatos = adotados_mes_gatos('2015','02',$connect);
				 $adotados_201503_gatos = adotados_mes_gatos('2015','03',$connect);
				 $adotados_201504_gatos = adotados_mes_gatos('2015','04',$connect);
				 $adotados_201505_gatos = adotados_mes_gatos('2015','05',$connect);
				 $adotados_201506_gatos = adotados_mes_gatos('2015','06',$connect);
				 $adotados_201507_gatos = adotados_mes_gatos('2015','07',$connect);
				 $adotados_201508_gatos = adotados_mes_gatos('2015','08',$connect);
				 $adotados_201509_gatos = adotados_mes_gatos('2015','09',$connect);
				 $adotados_201510_gatos = adotados_mes_gatos('2015','10',$connect);
				 $adotados_201511_gatos = adotados_mes_gatos('2015','11',$connect);
				 $adotados_201512_gatos = adotados_mes_gatos('2015','12',$connect);
				 $castrados_201501_caes = castrados_mes_caes('2015','01',$connect);
				 $castrados_201502_caes = castrados_mes_caes('2015','02',$connect);
				 $castrados_201503_caes = castrados_mes_caes('2015','03',$connect);
				 $castrados_201504_caes = castrados_mes_caes('2015','04',$connect);
				 $castrados_201505_caes = castrados_mes_caes('2015','05',$connect);
				 $castrados_201506_caes = castrados_mes_caes('2015','06',$connect);
				 $castrados_201507_caes = castrados_mes_caes('2015','07',$connect);
				 $castrados_201508_caes = castrados_mes_caes('2015','08',$connect);
				 $castrados_201509_caes = castrados_mes_caes('2015','09',$connect);
				 $castrados_201510_caes = castrados_mes_caes('2015','10',$connect);
				 $castrados_201511_caes = castrados_mes_caes('2015','11',$connect);
				 $castrados_201512_caes = castrados_mes_caes('2015','12',$connect);
				 $castrados_201501_gatos = castrados_mes_gatos('2015','01',$connect);
				 $castrados_201502_gatos = castrados_mes_gatos('2015','02',$connect);
				 $castrados_201503_gatos = castrados_mes_gatos('2015','03',$connect);
				 $castrados_201504_gatos = castrados_mes_gatos('2015','04',$connect);
				 $castrados_201505_gatos = castrados_mes_gatos('2015','05',$connect);
				 $castrados_201506_gatos = castrados_mes_gatos('2015','06',$connect);
				 $castrados_201507_gatos = castrados_mes_gatos('2015','07',$connect);
				 $castrados_201508_gatos = castrados_mes_gatos('2015','08',$connect);
				 $castrados_201509_gatos = castrados_mes_gatos('2015','09',$connect);
				 $castrados_201510_gatos = castrados_mes_gatos('2015','10',$connect);
				 $castrados_201511_gatos = castrados_mes_gatos('2015','11',$connect);
				 $castrados_201512_gatos = castrados_mes_gatos('2015','12',$connect);
				 
				 $total_201501 = intval($total_201501_petcamp_bg) + intval($total_201501_petcamp_jas) + intval($total_201501_petcenter) + intval($total_201501_petz) + intval($total_201501_petland) + intval($total_201501_leroy) + intval($total_201501_fora_feira);
				 $total_201502 = intval($total_201502_petcamp_bg) + intval($total_201502_petcamp_jas) + intval($total_201502_petcenter) + intval($total_201502_petz) + intval($total_201502_petland) + intval($total_201502_leroy) + intval($total_201502_fora_feira);
				 $total_201503 = intval($total_201503_petcamp_bg) + intval($total_201503_petcamp_jas) + intval($total_201503_petcenter) + intval($total_201503_petz) + intval($total_201503_petland) + intval($total_201503_leroy) + intval($total_201503_fora_feira);
				 $total_201504 = intval($total_201504_petcamp_bg) + intval($total_201504_petcamp_jas) + intval($total_201504_petcenter) + intval($total_201504_petz) + intval($total_201504_petland) + intval($total_201504_leroy) + intval($total_201504_fora_feira);
				 $total_201505 = intval($total_201505_petcamp_bg) + intval($total_201505_petcamp_jas) + intval($total_201505_petcenter) + intval($total_201505_petz) + intval($total_201505_petland) + intval($total_201505_leroy) + intval($total_201505_fora_feira);
				 $total_201506 = intval($total_201506_petcamp_bg) + intval($total_201506_petcamp_jas) + intval($total_201506_petcenter) + intval($total_201506_petz) + intval($total_201506_petland) + intval($total_201506_leroy) + intval($total_201506_fora_feira);
				 $total_201507 = intval($total_201507_petcamp_bg) + intval($total_201507_petcamp_jas) + intval($total_201507_petcenter) + intval($total_201507_petz) + intval($total_201507_petland) + intval($total_201507_leroy) + intval($total_201507_fora_feira);
				 $total_201508 = intval($total_201508_petcamp_bg) + intval($total_201508_petcamp_jas) + intval($total_201508_petcenter) + intval($total_201508_petz) + intval($total_201508_petland) + intval($total_201508_leroy) + intval($total_201508_fora_feira);
				 $total_201509 = intval($total_201509_petcamp_bg) + intval($total_201509_petcamp_jas) + intval($total_201509_petcenter) + intval($total_201509_petz) + intval($total_201509_petland) + intval($total_201509_leroy) + intval($total_201509_fora_feira);
				 $total_201510 = intval($total_201510_petcamp_bg) + intval($total_201510_petcamp_jas) + intval($total_201510_petcenter) + intval($total_201510_petz) + intval($total_201510_petland) + intval($total_201510_leroy) + intval($total_201510_fora_feira);
				 $total_201511 = intval($total_201511_petcamp_bg) + intval($total_201511_petcamp_jas) + intval($total_201511_petcenter) + intval($total_201511_petz) + intval($total_201511_petland) + intval($total_201511_leroy) + intval($total_201511_fora_feira);
				 $total_201512 = intval($total_201512_petcamp_bg) + intval($total_201512_petcamp_jas) + intval($total_201512_petcenter) + intval($total_201512_petz) + intval($total_201512_petland) + intval($total_201512_leroy) + intval($total_201512_fora_feira);
				 $total_2015 = intval($total_201501) + intval($total_201502) + intval($total_201503) + intval($total_201504) + intval($total_201505) + intval($total_201506) + intval($total_201507) + intval($total_201508) + intval($total_201509) + intval($total_201510) + intval($total_201511) + intval($total_201512);
				 
				 /********* 2016 **********/
				 $total_201601_petcamp_bg = local_adocao('2016','01','Petcamp Barão Geraldo',$connect);
				 $total_201602_petcamp_bg = local_adocao('2016','02','Petcamp Barão Geraldo',$connect);
				 $total_201603_petcamp_bg = local_adocao('2016','03','Petcamp Barão Geraldo',$connect);
				 $total_201604_petcamp_bg = local_adocao('2016','04','Petcamp Barão Geraldo',$connect);
				 $total_201605_petcamp_bg = local_adocao('2016','05','Petcamp Barão Geraldo',$connect);
				 $total_201606_petcamp_bg = local_adocao('2016','06','Petcamp Barão Geraldo',$connect);
				 $total_201607_petcamp_bg = local_adocao('2016','07','Petcamp Barão Geraldo',$connect);
				 $total_201608_petcamp_bg = local_adocao('2016','08','Petcamp Barão Geraldo',$connect);
				 $total_201609_petcamp_bg = local_adocao('2016','09','Petcamp Barão Geraldo',$connect);
				 $total_201610_petcamp_bg = local_adocao('2016','10','Petcamp Barão Geraldo',$connect);
				 $total_201611_petcamp_bg = local_adocao('2016','11','Petcamp Barão Geraldo',$connect);
				 $total_201612_petcamp_bg = local_adocao('2016','12','Petcamp Barão Geraldo',$connect);
				 $total_201601_petcamp_jas = local_adocao('2016','01','Petcamp Jasmim',$connect);
				 $total_201602_petcamp_jas = local_adocao('2016','02','Petcamp Jasmim',$connect);
				 $total_201603_petcamp_jas = local_adocao('2016','03','Petcamp Jasmim',$connect);
				 $total_201604_petcamp_jas = local_adocao('2016','04','Petcamp Jasmim',$connect);
				 $total_201605_petcamp_jas = local_adocao('2016','05','Petcamp Jasmim',$connect);
				 $total_201606_petcamp_jas = local_adocao('2016','06','Petcamp Jasmim',$connect);
				 $total_201607_petcamp_jas = local_adocao('2016','07','Petcamp Jasmim',$connect);
				 $total_201608_petcamp_jas = local_adocao('2016','08','Petcamp Jasmim',$connect);
				 $total_201609_petcamp_jas = local_adocao('2016','09','Petcamp Jasmim',$connect);
				 $total_201610_petcamp_jas = local_adocao('2016','10','Petcamp Jasmim',$connect);
				 $total_201611_petcamp_jas = local_adocao('2016','11','Petcamp Jasmim',$connect);
				 $total_201612_petcamp_jas = local_adocao('2016','12','Petcamp Jasmim',$connect);
				 $total_201601_petcenter = local_adocao('2016','01','Pet Center Marginal',$connect);
				 $total_201602_petcenter = local_adocao('2016','02','Pet Center Marginal',$connect);
				 $total_201603_petcenter = local_adocao('2016','03','Pet Center Marginal',$connect);
				 $total_201604_petcenter = local_adocao('2016','04','Pet Center Marginal',$connect);
				 $total_201605_petcenter = local_adocao('2016','05','Pet Center Marginal',$connect);
				 $total_201606_petcenter = local_adocao('2016','06','Pet Center Marginal',$connect);
				 $total_201607_petcenter = local_adocao('2016','07','Pet Center Marginal',$connect);
				 $total_201608_petcenter = local_adocao('2016','08','Pet Center Marginal',$connect);
				 $total_201609_petcenter = local_adocao('2016','09','Pet Center Marginal',$connect);
				 $total_201610_petcenter = local_adocao('2016','10','Pet Center Marginal',$connect);
				 $total_201611_petcenter = local_adocao('2016','11','Pet Center Marginal',$connect);
				 $total_201612_petcenter = local_adocao('2016','12','Pet Center Marginal',$connect);
				 $total_201601_petz = local_adocao('2016','01','Petz',$connect);
				 $total_201602_petz = local_adocao('2016','02','Petz',$connect);
				 $total_201603_petz = local_adocao('2016','03','Petz',$connect);
				 $total_201604_petz = local_adocao('2016','04','Petz',$connect);
				 $total_201605_petz = local_adocao('2016','05','Petz',$connect);
				 $total_201606_petz = local_adocao('2016','06','Petz',$connect);
				 $total_201607_petz = local_adocao('2016','07','Petz',$connect);
				 $total_201608_petz = local_adocao('2016','08','Petz',$connect);
				 $total_201609_petz = local_adocao('2016','09','Petz',$connect);
				 $total_201610_petz = local_adocao('2016','10','Petz',$connect);
				 $total_201611_petz = local_adocao('2016','11','Petz',$connect);
				 $total_201612_petz = local_adocao('2016','12','Petz',$connect);
				 $total_201601_petland = local_adocao('2016','01','Petland',$connect);
				 $total_201602_petland = local_adocao('2016','02','Petland',$connect);
				 $total_201603_petland = local_adocao('2016','03','Petland',$connect);
				 $total_201604_petland = local_adocao('2016','04','Petland',$connect);
				 $total_201605_petland = local_adocao('2016','05','Petland',$connect);
				 $total_201606_petland = local_adocao('2016','06','Petland',$connect);
				 $total_201607_petland = local_adocao('2016','07','Petland',$connect);
				 $total_201608_petland = local_adocao('2016','08','Petland',$connect);
				 $total_201609_petland = local_adocao('2016','09','Petland',$connect);
				 $total_201610_petland = local_adocao('2016','10','Petland',$connect);
				 $total_201611_petland = local_adocao('2016','11','Petland',$connect);
				 $total_201612_petland = local_adocao('2016','12','Petland',$connect);
				 $total_201601_leroy = local_adocao('2016','01','Leroy M Dom Pedro',$connect);
				 $total_201602_leroy = local_adocao('2016','02','Leroy M Dom Pedro',$connect);
				 $total_201603_leroy = local_adocao('2016','03','Leroy M Dom Pedro',$connect);
				 $total_201604_leroy = local_adocao('2016','04','Leroy M Dom Pedro',$connect);
				 $total_201605_leroy = local_adocao('2016','05','Leroy M Dom Pedro',$connect);
				 $total_201606_leroy = local_adocao('2016','06','Leroy M Dom Pedro',$connect);
				 $total_201607_leroy = local_adocao('2016','07','Leroy M Dom Pedro',$connect);
				 $total_201608_leroy = local_adocao('2016','08','Leroy M Dom Pedro',$connect);
				 $total_201609_leroy = local_adocao('2016','09','Leroy M Dom Pedro',$connect);
				 $total_201610_leroy = local_adocao('2016','10','Leroy M Dom Pedro',$connect);
				 $total_201611_leroy = local_adocao('2016','11','Leroy M Dom Pedro',$connect);
				 $total_201612_leroy = local_adocao('2016','12','Leroy M Dom Pedro',$connect);
				 $total_201601_fora_feira = local_adocao('2016','01','Fora da feira',$connect);
				 $total_201602_fora_feira = local_adocao('2016','02','Fora da feira',$connect);
				 $total_201603_fora_feira = local_adocao('2016','03','Fora da feira',$connect);
				 $total_201604_fora_feira = local_adocao('2016','04','Fora da feira',$connect);
				 $total_201605_fora_feira = local_adocao('2016','05','Fora da feira',$connect);
				 $total_201606_fora_feira = local_adocao('2016','06','Fora da feira',$connect);
				 $total_201607_fora_feira = local_adocao('2016','07','Fora da feira',$connect);
				 $total_201608_fora_feira = local_adocao('2016','08','Fora da feira',$connect);
				 $total_201609_fora_feira = local_adocao('2016','09','Fora da feira',$connect);
				 $total_201610_fora_feira = local_adocao('2016','10','Fora da feira',$connect);
				 $total_201611_fora_feira = local_adocao('2016','11','Fora da feira',$connect);
				 $total_201612_fora_feira = local_adocao('2016','12','Fora da feira',$connect);
				 $adotados_201601_caes = adotados_mes_caes('2016','01',$connect);
				 $adotados_201602_caes = adotados_mes_caes('2016','02',$connect);
				 $adotados_201603_caes = adotados_mes_caes('2016','03',$connect);
				 $adotados_201604_caes = adotados_mes_caes('2016','04',$connect);
				 $adotados_201605_caes = adotados_mes_caes('2016','05',$connect);
				 $adotados_201606_caes = adotados_mes_caes('2016','06',$connect);
				 $adotados_201607_caes = adotados_mes_caes('2016','07',$connect);
				 $adotados_201608_caes = adotados_mes_caes('2016','08',$connect);
				 $adotados_201609_caes = adotados_mes_caes('2016','09',$connect);
				 $adotados_201610_caes = adotados_mes_caes('2016','10',$connect);
				 $adotados_201611_caes = adotados_mes_caes('2016','11',$connect);
				 $adotados_201612_caes = adotados_mes_caes('2016','12',$connect);
				 $adotados_201601_gatos = adotados_mes_gatos('2016','01',$connect);
				 $adotados_201602_gatos = adotados_mes_gatos('2016','02',$connect);
				 $adotados_201603_gatos = adotados_mes_gatos('2016','03',$connect);
				 $adotados_201604_gatos = adotados_mes_gatos('2016','04',$connect);
				 $adotados_201605_gatos = adotados_mes_gatos('2016','05',$connect);
				 $adotados_201606_gatos = adotados_mes_gatos('2016','06',$connect);
				 $adotados_201607_gatos = adotados_mes_gatos('2016','07',$connect);
				 $adotados_201608_gatos = adotados_mes_gatos('2016','08',$connect);
				 $adotados_201609_gatos = adotados_mes_gatos('2016','09',$connect);
				 $adotados_201610_gatos = adotados_mes_gatos('2016','10',$connect);
				 $adotados_201611_gatos = adotados_mes_gatos('2016','11',$connect);
				 $adotados_201612_gatos = adotados_mes_gatos('2016','12',$connect); 
				 $castrados_201601_caes = castrados_mes_caes('2016','01',$connect);
				 $castrados_201602_caes = castrados_mes_caes('2016','02',$connect);
				 $castrados_201603_caes = castrados_mes_caes('2016','03',$connect);
				 $castrados_201604_caes = castrados_mes_caes('2016','04',$connect);
				 $castrados_201605_caes = castrados_mes_caes('2016','05',$connect);
				 $castrados_201606_caes = castrados_mes_caes('2016','06',$connect);
				 $castrados_201607_caes = castrados_mes_caes('2016','07',$connect);
				 $castrados_201608_caes = castrados_mes_caes('2016','08',$connect);
				 $castrados_201609_caes = castrados_mes_caes('2016','09',$connect);
				 $castrados_201610_caes = castrados_mes_caes('2016','10',$connect);
				 $castrados_201611_caes = castrados_mes_caes('2016','11',$connect);
				 $castrados_201612_caes = castrados_mes_caes('2016','12',$connect);
				 $castrados_201601_gatos = castrados_mes_gatos('2016','01',$connect);
				 $castrados_201602_gatos = castrados_mes_gatos('2016','02',$connect);
				 $castrados_201603_gatos = castrados_mes_gatos('2016','03',$connect);
				 $castrados_201604_gatos = castrados_mes_gatos('2016','04',$connect);
				 $castrados_201605_gatos = castrados_mes_gatos('2016','05',$connect);
				 $castrados_201606_gatos = castrados_mes_gatos('2016','06',$connect);
				 $castrados_201607_gatos = castrados_mes_gatos('2016','07',$connect);
				 $castrados_201608_gatos = castrados_mes_gatos('2016','08',$connect);;
				 $castrados_201609_gatos = castrados_mes_gatos('2016','09',$connect);
				 $castrados_201610_gatos = castrados_mes_gatos('2016','10',$connect);
				 $castrados_201611_gatos = castrados_mes_gatos('2016','11',$connect);
				 $castrados_201612_gatos = castrados_mes_gatos('2016','12',$connect);
				 $total_2016_caes = adotados_total_caes('2016',$connect);
				 $total_2016_gatos = adotados_total_gatos('2016',$connect);
				 $castrados_2016_caes = castrados_total_caes('2016',$connect);
				 $castrados_2016_gatos = castrados_total_gatos('2016',$connect);
				 
				 $total_201601 = intval($total_201601_petcamp_bg) + intval($total_201601_petcamp_jas) + intval($total_201601_petcenter) + intval($total_201601_petz) + intval($total_201601_petland) + intval($total_201601_leroy) + intval($total_201601_fora_feira);
				 $total_201602 = intval($total_201602_petcamp_bg) + intval($total_201602_petcamp_jas) + intval($total_201602_petcenter) + intval($total_201602_petz) + intval($total_201602_petland) + intval($total_201602_leroy) + intval($total_201602_fora_feira);
				 $total_201603 = intval($total_201603_petcamp_bg) + intval($total_201603_petcamp_jas) + intval($total_201603_petcenter) + intval($total_201603_petz) + intval($total_201603_petland) + intval($total_201603_leroy) + intval($total_201603_fora_feira);
				 $total_201604 = intval($total_201604_petcamp_bg) + intval($total_201604_petcamp_jas) + intval($total_201604_petcenter) + intval($total_201604_petz) + intval($total_201604_petland) + intval($total_201604_leroy) + intval($total_201604_fora_feira);
				 $total_201605 = intval($total_201605_petcamp_bg) + intval($total_201605_petcamp_jas) + intval($total_201605_petcenter) + intval($total_201605_petz) + intval($total_201605_petland) + intval($total_201605_leroy) + intval($total_201605_fora_feira);
				 $total_201606 = intval($total_201606_petcamp_bg) + intval($total_201606_petcamp_jas) + intval($total_201606_petcenter) + intval($total_201606_petz) + intval($total_201606_petland) + intval($total_201606_leroy) + intval($total_201606_fora_feira);
				 $total_201607 = intval($total_201607_petcamp_bg) + intval($total_201607_petcamp_jas) + intval($total_201607_petcenter) + intval($total_201607_petz) + intval($total_201607_petland) + intval($total_201607_leroy) + intval($total_201607_fora_feira);
				 $total_201608 = intval($total_201608_petcamp_bg) + intval($total_201608_petcamp_jas) + intval($total_201608_petcenter) + intval($total_201608_petz) + intval($total_201608_petland) + intval($total_201608_leroy) + intval($total_201608_fora_feira);
				 $total_201609 = intval($total_201609_petcamp_bg) + intval($total_201609_petcamp_jas) + intval($total_201609_petcenter) + intval($total_201609_petz) + intval($total_201609_petland) + intval($total_201609_leroy) + intval($total_201609_fora_feira);
				 $total_201610 = intval($total_201610_petcamp_bg) + intval($total_201610_petcamp_jas) + intval($total_201610_petcenter) + intval($total_201610_petz) + intval($total_201610_petland) + intval($total_201610_leroy) + intval($total_201610_fora_feira);
				 $total_201611 = intval($total_201611_petcamp_bg) + intval($total_201611_petcamp_jas) + intval($total_201611_petcenter) + intval($total_201611_petz) + intval($total_201611_petland) + intval($total_201611_leroy) + intval($total_201611_fora_feira);
				 $total_201612 = intval($total_201612_petcamp_bg) + intval($total_201612_petcamp_jas) + intval($total_201612_petcenter) + intval($total_201612_petz) + intval($total_201612_petland) + intval($total_201612_leroy) + intval($total_201612_fora_feira);
				 $total_2016 = intval($total_201601) + intval($total_201602) + intval($total_201603) + intval($total_201604) + intval($total_201605) + intval($total_201606) + intval($total_201607) + intval($total_201608) + intval($total_201609) + intval($total_201610) + intval($total_201611) + intval($total_201612);
				 
				 
				 /********* 2017 **********/
				 $total_201701_petcamp_bg = local_adocao('2017','01','Petcamp Barão Geraldo',$connect);
				 $total_201702_petcamp_bg = local_adocao('2017','02','Petcamp Barão Geraldo',$connect);
				 $total_201703_petcamp_bg = local_adocao('2017','03','Petcamp Barão Geraldo',$connect);
				 $total_201704_petcamp_bg = local_adocao('2017','04','Petcamp Barão Geraldo',$connect);
				 $total_201705_petcamp_bg = local_adocao('2017','05','Petcamp Barão Geraldo',$connect);
				 $total_201706_petcamp_bg = local_adocao('2017','06','Petcamp Barão Geraldo',$connect);
				 $total_201707_petcamp_bg = local_adocao('2017','07','Petcamp Barão Geraldo',$connect);
				 $total_201708_petcamp_bg = local_adocao('2017','08','Petcamp Barão Geraldo',$connect);
				 $total_201709_petcamp_bg = local_adocao('2017','09','Petcamp Barão Geraldo',$connect);
				 $total_201710_petcamp_bg = local_adocao('2017','10','Petcamp Barão Geraldo',$connect);
				 $total_201711_petcamp_bg = local_adocao('2017','11','Petcamp Barão Geraldo',$connect);
				 $total_201712_petcamp_bg = local_adocao('2017','12','Petcamp Barão Geraldo',$connect);
				 $total_201701_petcamp_jas = local_adocao('2017','01','Petcamp Jasmim',$connect);
				 $total_201702_petcamp_jas = local_adocao('2017','02','Petcamp Jasmim',$connect);
				 $total_201703_petcamp_jas = local_adocao('2017','03','Petcamp Jasmim',$connect);
				 $total_201704_petcamp_jas = local_adocao('2017','04','Petcamp Jasmim',$connect);
				 $total_201705_petcamp_jas = local_adocao('2017','05','Petcamp Jasmim',$connect);
				 $total_201706_petcamp_jas = local_adocao('2017','06','Petcamp Jasmim',$connect);
				 $total_201707_petcamp_jas = local_adocao('2017','07','Petcamp Jasmim',$connect);
				 $total_201708_petcamp_jas = local_adocao('2017','08','Petcamp Jasmim',$connect);
				 $total_201709_petcamp_jas = local_adocao('2017','09','Petcamp Jasmim',$connect);
				 $total_201710_petcamp_jas = local_adocao('2017','10','Petcamp Jasmim',$connect);
				 $total_201711_petcamp_jas = local_adocao('2017','11','Petcamp Jasmim',$connect);
				 $total_201712_petcamp_jas = local_adocao('2017','12','Petcamp Jasmim',$connect);
				 $total_201701_petcenter = local_adocao('2017','01','Pet Center Marginal',$connect);
				 $total_201702_petcenter = local_adocao('2017','02','Pet Center Marginal',$connect);
				 $total_201703_petcenter = local_adocao('2017','03','Pet Center Marginal',$connect);
				 $total_201704_petcenter = local_adocao('2017','04','Pet Center Marginal',$connect);
				 $total_201705_petcenter = local_adocao('2017','05','Pet Center Marginal',$connect);
				 $total_201706_petcenter = local_adocao('2017','06','Pet Center Marginal',$connect);
				 $total_201707_petcenter = local_adocao('2017','07','Pet Center Marginal',$connect);
				 $total_201708_petcenter = local_adocao('2017','08','Pet Center Marginal',$connect);
				 $total_201709_petcenter = local_adocao('2017','09','Pet Center Marginal',$connect);
				 $total_201710_petcenter = local_adocao('2017','10','Pet Center Marginal',$connect);
				 $total_201711_petcenter = local_adocao('2017','11','Pet Center Marginal',$connect);
				 $total_201712_petcenter = local_adocao('2017','12','Pet Center Marginal',$connect);
				 $total_201701_petz = local_adocao('2017','01','Petz',$connect);
				 $total_201702_petz = local_adocao('2017','02','Petz',$connect);
				 $total_201703_petz = local_adocao('2017','03','Petz',$connect);
				 $total_201704_petz = local_adocao('2017','04','Petz',$connect);
				 $total_201705_petz = local_adocao('2017','05','Petz',$connect);
				 $total_201706_petz = local_adocao('2017','06','Petz',$connect);
				 $total_201707_petz = local_adocao('2017','07','Petz',$connect);
				 $total_201708_petz = local_adocao('2017','08','Petz',$connect);
				 $total_201709_petz = local_adocao('2017','09','Petz',$connect);
				 $total_201710_petz = local_adocao('2017','10','Petz',$connect);
				 $total_201711_petz = local_adocao('2017','11','Petz',$connect);
				 $total_201712_petz = local_adocao('2017','12','Petz',$connect);
				 $total_201701_petland = local_adocao('2017','01','Petland',$connect);
				 $total_201702_petland = local_adocao('2017','02','Petland',$connect);
				 $total_201703_petland = local_adocao('2017','03','Petland',$connect);
				 $total_201704_petland = local_adocao('2017','04','Petland',$connect);
				 $total_201705_petland = local_adocao('2017','05','Petland',$connect);
				 $total_201706_petland = local_adocao('2017','06','Petland',$connect);
				 $total_201707_petland = local_adocao('2017','07','Petland',$connect);
				 $total_201708_petland = local_adocao('2017','08','Petland',$connect);
				 $total_201709_petland = local_adocao('2017','09','Petland',$connect);
				 $total_201710_petland = local_adocao('2017','10','Petland',$connect);
				 $total_201711_petland = local_adocao('2017','11','Petland',$connect);
				 $total_201712_petland = local_adocao('2017','12','Petland',$connect);
				 $total_201701_leroy = local_adocao('2017','01','Leroy M Dom Pedro',$connect);
				 $total_201702_leroy = local_adocao('2017','02','Leroy M Dom Pedro',$connect);
				 $total_201703_leroy = local_adocao('2017','03','Leroy M Dom Pedro',$connect);
				 $total_201704_leroy = local_adocao('2017','04','Leroy M Dom Pedro',$connect);
				 $total_201705_leroy = local_adocao('2017','05','Leroy M Dom Pedro',$connect);
				 $total_201706_leroy = local_adocao('2017','06','Leroy M Dom Pedro',$connect);
				 $total_201707_leroy = local_adocao('2017','07','Leroy M Dom Pedro',$connect);
				 $total_201708_leroy = local_adocao('2017','08','Leroy M Dom Pedro',$connect);
				 $total_201709_leroy = local_adocao('2017','09','Leroy M Dom Pedro',$connect);
				 $total_201710_leroy = local_adocao('2017','10','Leroy M Dom Pedro',$connect);
				 $total_201711_leroy = local_adocao('2017','11','Leroy M Dom Pedro',$connect);
				 $total_201712_leroy = local_adocao('2017','12','Leroy M Dom Pedro',$connect);
				 $total_201701_fora_feira = local_adocao('2017','01','Fora da feira',$connect);
				 $total_201702_fora_feira = local_adocao('2017','02','Fora da feira',$connect);
				 $total_201703_fora_feira = local_adocao('2017','03','Fora da feira',$connect);
				 $total_201704_fora_feira = local_adocao('2017','04','Fora da feira',$connect);
				 $total_201705_fora_feira = local_adocao('2017','05','Fora da feira',$connect);
				 $total_201706_fora_feira = local_adocao('2017','06','Fora da feira',$connect);
				 $total_201707_fora_feira = local_adocao('2017','07','Fora da feira',$connect);
				 $total_201708_fora_feira = local_adocao('2017','08','Fora da feira',$connect);
				 $total_201709_fora_feira = local_adocao('2017','09','Fora da feira',$connect);
				 $total_201710_fora_feira = local_adocao('2017','10','Fora da feira',$connect);
				 $total_201711_fora_feira = local_adocao('2017','11','Fora da feira',$connect);
				 $total_201712_fora_feira = local_adocao('2017','12','Fora da feira',$connect);
				 $adotados_201701_caes = adotados_mes_caes('2017','01',$connect);
				 $adotados_201702_caes = adotados_mes_caes('2017','02',$connect);
				 $adotados_201703_caes = adotados_mes_caes('2017','03',$connect);
				 $adotados_201704_caes = adotados_mes_caes('2017','04',$connect);
				 $adotados_201705_caes = adotados_mes_caes('2017','05',$connect);
				 $adotados_201706_caes = adotados_mes_caes('2017','06',$connect);
				 $adotados_201707_caes = adotados_mes_caes('2017','07',$connect);
				 $adotados_201708_caes = adotados_mes_caes('2017','08',$connect);
				 $adotados_201709_caes = adotados_mes_caes('2017','09',$connect);
				 $adotados_201710_caes = adotados_mes_caes('2017','10',$connect);
				 $adotados_201711_caes = adotados_mes_caes('2017','11',$connect);
				 $adotados_201712_caes = adotados_mes_caes('2017','12',$connect);
				 $adotados_201701_gatos = adotados_mes_gatos('2017','01',$connect);
				 $adotados_201702_gatos = adotados_mes_gatos('2017','02',$connect);
				 $adotados_201703_gatos = adotados_mes_gatos('2017','03',$connect);
				 $adotados_201704_gatos = adotados_mes_gatos('2017','04',$connect);
				 $adotados_201705_gatos = adotados_mes_gatos('2017','05',$connect);
				 $adotados_201706_gatos = adotados_mes_gatos('2017','06',$connect);
				 $adotados_201707_gatos = adotados_mes_gatos('2017','07',$connect);
				 $adotados_201708_gatos = adotados_mes_gatos('2017','08',$connect);
				 $adotados_201709_gatos = adotados_mes_gatos('2017','09',$connect);
				 $adotados_201710_gatos = adotados_mes_gatos('2017','10',$connect);
				 $adotados_201711_gatos = adotados_mes_gatos('2017','11',$connect);
				 $adotados_201712_gatos = adotados_mes_gatos('2017','12',$connect);
				 $castrados_201701_caes = castrados_mes_caes('2017','01',$connect);
				 $castrados_201702_caes = castrados_mes_caes('2017','02',$connect);
				 $castrados_201703_caes = castrados_mes_caes('2017','03',$connect);
				 $castrados_201704_caes = castrados_mes_caes('2017','04',$connect);
				 $castrados_201705_caes = castrados_mes_caes('2017','05',$connect);
				 $castrados_201706_caes = castrados_mes_caes('2017','06',$connect);
				 $castrados_201707_caes = castrados_mes_caes('2017','07',$connect);
				 $castrados_201708_caes = castrados_mes_caes('2017','08',$connect);
				 $castrados_201709_caes = castrados_mes_caes('2017','09',$connect);
				 $castrados_201710_caes = castrados_mes_caes('2017','10',$connect);
				 $castrados_201711_caes = castrados_mes_caes('2017','11',$connect);
				 $castrados_201712_caes = castrados_mes_caes('2017','12',$connect);
				 $castrados_201701_gatos = castrados_mes_gatos('2017','01',$connect);
				 $castrados_201702_gatos = castrados_mes_gatos('2017','02',$connect);
				 $castrados_201703_gatos = castrados_mes_gatos('2017','03',$connect);
				 $castrados_201704_gatos = castrados_mes_gatos('2017','04',$connect);
				 $castrados_201705_gatos = castrados_mes_gatos('2017','05',$connect);
				 $castrados_201706_gatos = castrados_mes_gatos('2017','06',$connect);
				 $castrados_201707_gatos = castrados_mes_gatos('2017','07',$connect);
				 $castrados_201708_gatos = castrados_mes_gatos('2017','08',$connect);
				 $castrados_201709_gatos = castrados_mes_gatos('2017','09',$connect);
				 $castrados_201710_gatos = castrados_mes_gatos('2017','10',$connect);
				 $castrados_201711_gatos = castrados_mes_gatos('2017','11',$connect);
				 $castrados_201712_gatos = castrados_mes_gatos('2017','12',$connect);
				 $total_2017_caes = adotados_total_caes('2017',$connect);
				 $total_2017_gatos = adotados_total_gatos('2017',$connect);
				 $castrados_2017_caes = castrados_total_caes('2017',$connect);
				 $castrados_2017_gatos = castrados_total_gatos('2017',$connect);
				 
				 $total_201701 = intval($total_201701_petcamp_bg) + intval($total_201701_petcamp_jas) + intval($total_201701_petcenter) + intval($total_201701_petz) + intval($total_201701_petland) + intval($total_201701_leroy) + intval($total_201701_fora_feira);
				 $total_201702 = intval($total_201702_petcamp_bg) + intval($total_201702_petcamp_jas) + intval($total_201702_petcenter) + intval($total_201702_petz) + intval($total_201702_petland) + intval($total_201702_leroy) + intval($total_201702_fora_feira);
				 $total_201703 = intval($total_201703_petcamp_bg) + intval($total_201703_petcamp_jas) + intval($total_201703_petcenter) + intval($total_201703_petz) + intval($total_201703_petland) + intval($total_201703_leroy) + intval($total_201703_fora_feira);
				 $total_201704 = intval($total_201704_petcamp_bg) + intval($total_201704_petcamp_jas) + intval($total_201704_petcenter) + intval($total_201704_petz) + intval($total_201704_petland) + intval($total_201704_leroy) + intval($total_201704_fora_feira);
				 $total_201705 = intval($total_201705_petcamp_bg) + intval($total_201705_petcamp_jas) + intval($total_201705_petcenter) + intval($total_201705_petz) + intval($total_201705_petland) + intval($total_201705_leroy) + intval($total_201705_fora_feira);
				 $total_201706 = intval($total_201706_petcamp_bg) + intval($total_201706_petcamp_jas) + intval($total_201706_petcenter) + intval($total_201706_petz) + intval($total_201706_petland) + intval($total_201706_leroy) + intval($total_201706_fora_feira);
				 $total_201707 = intval($total_201707_petcamp_bg) + intval($total_201707_petcamp_jas) + intval($total_201707_petcenter) + intval($total_201707_petz) + intval($total_201707_petland) + intval($total_201707_leroy) + intval($total_201707_fora_feira);
				 $total_201708 = intval($total_201708_petcamp_bg) + intval($total_201708_petcamp_jas) + intval($total_201708_petcenter) + intval($total_201708_petz) + intval($total_201708_petland) + intval($total_201708_leroy) + intval($total_201708_fora_feira);
				 $total_201709 = intval($total_201709_petcamp_bg) + intval($total_201709_petcamp_jas) + intval($total_201709_petcenter) + intval($total_201709_petz) + intval($total_201709_petland) + intval($total_201709_leroy) + intval($total_201709_fora_feira);
				 $total_201710 = intval($total_201710_petcamp_bg) + intval($total_201710_petcamp_jas) + intval($total_201710_petcenter) + intval($total_201710_petz) + intval($total_201710_petland) + intval($total_201710_leroy) + intval($total_201710_fora_feira);
				 $total_201711 = intval($total_201711_petcamp_bg) + intval($total_201711_petcamp_jas) + intval($total_201711_petcenter) + intval($total_201711_petz) + intval($total_201711_petland) + intval($total_201711_leroy) + intval($total_201711_fora_feira);
				 $total_201712 = intval($total_201712_petcamp_bg) + intval($total_201712_petcamp_jas) + intval($total_201712_petcenter) + intval($total_201712_petz) + intval($total_201712_petland) + intval($total_201712_leroy) + intval($total_201712_fora_feira);
				 $total_2017 = intval($total_201701) + intval($total_201702) + intval($total_201703) + intval($total_201704) + intval($total_201705) + intval($total_201706) + intval($total_201707) + intval($total_201708) + intval($total_201709) + intval($total_201710) + intval($total_201711) + intval($total_201712);
				 
				 /********* 2018 **********/
				 $total_201801_petcamp_bg = local_adocao('2018','01','Petcamp Barão Geraldo',$connect);
				 $total_201802_petcamp_bg = local_adocao('2018','02','Petcamp Barão Geraldo',$connect);
				 $total_201803_petcamp_bg = local_adocao('2018','03','Petcamp Barão Geraldo',$connect);
				 $total_201804_petcamp_bg = local_adocao('2018','04','Petcamp Barão Geraldo',$connect);
				 $total_201805_petcamp_bg = local_adocao('2018','05','Petcamp Barão Geraldo',$connect);
				 $total_201806_petcamp_bg = local_adocao('2018','06','Petcamp Barão Geraldo',$connect);
				 $total_201807_petcamp_bg = local_adocao('2018','07','Petcamp Barão Geraldo',$connect);
				 $total_201808_petcamp_bg = local_adocao('2018','08','Petcamp Barão Geraldo',$connect);
				 $total_201809_petcamp_bg = local_adocao('2018','09','Petcamp Barão Geraldo',$connect);
				 $total_201810_petcamp_bg = local_adocao('2018','10','Petcamp Barão Geraldo',$connect);
				 $total_201811_petcamp_bg = local_adocao('2018','11','Petcamp Barão Geraldo',$connect);
				 $total_201812_petcamp_bg = local_adocao('2018','12','Petcamp Barão Geraldo',$connect);
				 $total_201801_petcamp_jas = local_adocao('2018','01','Petcamp Jasmim',$connect);
				 $total_201802_petcamp_jas = local_adocao('2018','02','Petcamp Jasmim',$connect);
				 $total_201803_petcamp_jas = local_adocao('2018','03','Petcamp Jasmim',$connect);
				 $total_201804_petcamp_jas = local_adocao('2018','04','Petcamp Jasmim',$connect);
				 $total_201805_petcamp_jas = local_adocao('2018','05','Petcamp Jasmim',$connect);
				 $total_201806_petcamp_jas = local_adocao('2018','06','Petcamp Jasmim',$connect);
				 $total_201807_petcamp_jas = local_adocao('2018','07','Petcamp Jasmim',$connect);
				 $total_201808_petcamp_jas = local_adocao('2018','08','Petcamp Jasmim',$connect);
				 $total_201809_petcamp_jas = local_adocao('2018','09','Petcamp Jasmim',$connect);
				 $total_201810_petcamp_jas = local_adocao('2018','10','Petcamp Jasmim',$connect);
				 $total_201811_petcamp_jas = local_adocao('2018','11','Petcamp Jasmim',$connect);
				 $total_201812_petcamp_jas = local_adocao('2018','12','Petcamp Jasmim',$connect);
				 $total_201801_petcenter = local_adocao('2018','01','Pet Center Marginal',$connect);
				 $total_201802_petcenter = local_adocao('2018','02','Pet Center Marginal',$connect);
				 $total_201803_petcenter = local_adocao('2018','03','Pet Center Marginal',$connect);
				 $total_201804_petcenter = local_adocao('2018','04','Pet Center Marginal',$connect);
				 $total_201805_petcenter = local_adocao('2018','05','Pet Center Marginal',$connect);
				 $total_201806_petcenter = local_adocao('2018','06','Pet Center Marginal',$connect);
				 $total_201807_petcenter = local_adocao('2018','07','Pet Center Marginal',$connect);
				 $total_201808_petcenter = local_adocao('2018','08','Pet Center Marginal',$connect);
				 $total_201809_petcenter = local_adocao('2018','09','Pet Center Marginal',$connect);
				 $total_201810_petcenter = local_adocao('2018','10','Pet Center Marginal',$connect);
				 $total_201811_petcenter = local_adocao('2018','11','Pet Center Marginal',$connect);
				 $total_201812_petcenter = local_adocao('2018','12','Pet Center Marginal',$connect);
				 $total_201801_petz = local_adocao('2018','01','Petz',$connect);
				 $total_201802_petz = local_adocao('2018','02','Petz',$connect);
				 $total_201803_petz = local_adocao('2018','03','Petz',$connect);
				 $total_201804_petz = local_adocao('2018','04','Petz',$connect);
				 $total_201805_petz = local_adocao('2018','05','Petz',$connect);
				 $total_201806_petz = local_adocao('2018','06','Petz',$connect);
				 $total_201807_petz = local_adocao('2018','07','Petz',$connect);
				 $total_201808_petz = local_adocao('2018','08','Petz',$connect);
				 $total_201809_petz = local_adocao('2018','09','Petz',$connect);
				 $total_201810_petz = local_adocao('2018','10','Petz',$connect);
				 $total_201811_petz = local_adocao('2018','11','Petz',$connect);
				 $total_201812_petz = local_adocao('2018','12','Petz',$connect);
				 $total_201801_petland = local_adocao('2018','01','Petland',$connect);
				 $total_201802_petland = local_adocao('2018','02','Petland',$connect);
				 $total_201803_petland = local_adocao('2018','03','Petland',$connect);
				 $total_201804_petland = local_adocao('2018','04','Petland',$connect);
				 $total_201805_petland = local_adocao('2018','05','Petland',$connect);
				 $total_201806_petland = local_adocao('2018','06','Petland',$connect);
				 $total_201807_petland = local_adocao('2018','07','Petland',$connect);
				 $total_201808_petland = local_adocao('2018','08','Petland',$connect);
				 $total_201809_petland = local_adocao('2018','09','Petland',$connect);
				 $total_201810_petland = local_adocao('2018','10','Petland',$connect);
				 $total_201811_petland = local_adocao('2018','11','Petland',$connect);
				 $total_201812_petland = local_adocao('2018','12','Petland',$connect);
				 $total_201801_leroy = local_adocao('2018','01','Leroy M Dom Pedro',$connect);
				 $total_201802_leroy = local_adocao('2018','02','Leroy M Dom Pedro',$connect);
				 $total_201803_leroy = local_adocao('2018','03','Leroy M Dom Pedro',$connect);
				 $total_201804_leroy = local_adocao('2018','04','Leroy M Dom Pedro',$connect);
				 $total_201805_leroy = local_adocao('2018','05','Leroy M Dom Pedro',$connect);
				 $total_201806_leroy = local_adocao('2018','06','Leroy M Dom Pedro',$connect);
				 $total_201807_leroy = local_adocao('2018','07','Leroy M Dom Pedro',$connect);
				 $total_201808_leroy = local_adocao('2018','08','Leroy M Dom Pedro',$connect);
				 $total_201809_leroy = local_adocao('2018','09','Leroy M Dom Pedro',$connect);
				 $total_201810_leroy = local_adocao('2018','10','Leroy M Dom Pedro',$connect);
				 $total_201811_leroy = local_adocao('2018','11','Leroy M Dom Pedro',$connect);
				 $total_201812_leroy = local_adocao('2018','12','Leroy M Dom Pedro',$connect);
				 $total_201801_fora_feira = local_adocao('2018','01','Fora da feira',$connect);
				 $total_201802_fora_feira = local_adocao('2018','02','Fora da feira',$connect);
				 $total_201803_fora_feira = local_adocao('2018','03','Fora da feira',$connect);
				 $total_201804_fora_feira = local_adocao('2018','04','Fora da feira',$connect);
				 $total_201805_fora_feira = local_adocao('2018','05','Fora da feira',$connect);
				 $total_201806_fora_feira = local_adocao('2018','06','Fora da feira',$connect);
				 $total_201807_fora_feira = local_adocao('2018','07','Fora da feira',$connect);
				 $total_201808_fora_feira = local_adocao('2018','08','Fora da feira',$connect);
				 $total_201809_fora_feira = local_adocao('2018','09','Fora da feira',$connect);
				 $total_201810_fora_feira = local_adocao('2018','10','Fora da feira',$connect);
				 $total_201811_fora_feira = local_adocao('2018','11','Fora da feira',$connect);
				 $total_201812_fora_feira = local_adocao('2018','12','Fora da feira',$connect);
				 $adotados_201801_caes = adotados_mes_caes('2018','01',$connect);
				 $adotados_201802_caes = adotados_mes_caes('2018','02',$connect);
				 $adotados_201803_caes = adotados_mes_caes('2018','03',$connect);
				 $adotados_201804_caes = adotados_mes_caes('2018','04',$connect);
				 $adotados_201805_caes = adotados_mes_caes('2018','05',$connect);
				 $adotados_201806_caes = adotados_mes_caes('2018','06',$connect);
				 $adotados_201807_caes = adotados_mes_caes('2018','07',$connect);
				 $adotados_201808_caes = adotados_mes_caes('2018','08',$connect);
				 $adotados_201809_caes = adotados_mes_caes('2018','09',$connect);
				 $adotados_201810_caes = adotados_mes_caes('2018','10',$connect);
				 $adotados_201811_caes = adotados_mes_caes('2018','11',$connect);
				 $adotados_201812_caes = adotados_mes_caes('2018','12',$connect);
				 $adotados_201801_gatos = adotados_mes_gatos('2018','01',$connect);
				 $adotados_201802_gatos = adotados_mes_gatos('2018','02',$connect);
				 $adotados_201803_gatos = adotados_mes_gatos('2018','03',$connect);
				 $adotados_201804_gatos = adotados_mes_gatos('2018','04',$connect);
				 $adotados_201805_gatos = adotados_mes_gatos('2018','05',$connect);
				 $adotados_201806_gatos = adotados_mes_gatos('2018','06',$connect);
				 $adotados_201807_gatos = adotados_mes_gatos('2018','07',$connect);
				 $adotados_201808_gatos = adotados_mes_gatos('2018','08',$connect);
				 $adotados_201809_gatos = adotados_mes_gatos('2018','09',$connect);
				 $adotados_201810_gatos = adotados_mes_gatos('2018','10',$connect);
				 $adotados_201811_gatos = adotados_mes_gatos('2018','11',$connect);
				 $adotados_201812_gatos = adotados_mes_gatos('2018','12',$connect);
				 $castrados_201801_caes = castrados_mes_caes('2018','01',$connect);
				 $castrados_201802_caes = castrados_mes_caes('2018','02',$connect);
				 $castrados_201803_caes = castrados_mes_caes('2018','03',$connect);
				 $castrados_201804_caes = castrados_mes_caes('2018','04',$connect);
				 $castrados_201805_caes = castrados_mes_caes('2018','05',$connect);
				 $castrados_201806_caes = castrados_mes_caes('2018','06',$connect);
				 $castrados_201807_caes = castrados_mes_caes('2018','07',$connect);
				 $castrados_201808_caes = castrados_mes_caes('2018','08',$connect);
				 $castrados_201809_caes = castrados_mes_caes('2018','09',$connect);
				 $castrados_201810_caes = castrados_mes_caes('2018','10',$connect);
				 $castrados_201811_caes = castrados_mes_caes('2018','11',$connect);
				 $castrados_201812_caes = castrados_mes_caes('2018','12',$connect);
				 $castrados_201801_gatos = castrados_mes_gatos('2018','01',$connect);
				 $castrados_201802_gatos = castrados_mes_gatos('2018','02',$connect);
				 $castrados_201803_gatos = castrados_mes_gatos('2018','03',$connect);
				 $castrados_201804_gatos = castrados_mes_gatos('2018','04',$connect);
				 $castrados_201805_gatos = castrados_mes_gatos('2018','05',$connect);
				 $castrados_201806_gatos = castrados_mes_gatos('2018','06',$connect);
				 $castrados_201807_gatos = castrados_mes_gatos('2018','07',$connect);
				 $castrados_201808_gatos = castrados_mes_gatos('2018','08',$connect);
				 $castrados_201809_gatos = castrados_mes_gatos('2018','09',$connect);
				 $castrados_201810_gatos = castrados_mes_gatos('2018','10',$connect);
				 $castrados_201811_gatos = castrados_mes_gatos('2018','11',$connect);
				 $castrados_201812_gatos = castrados_mes_gatos('2018','12',$connect);
				 $total_2018_caes = adotados_total_caes('2018',$connect);
				 $total_2018_gatos = adotados_total_gatos('2018',$connect);
				 $castrados_2018_caes = castrados_total_caes('2018',$connect);
				 $castrados_2018_gatos = castrados_total_gatos('2018',$connect);
				 
				 $total_201801 = intval($total_201801_petcamp_bg) + intval($total_201801_petcamp_jas) + intval($total_201801_petcenter) + intval($total_201801_petz) + intval($total_201801_petland) + intval($total_201801_leroy) + intval($total_201801_fora_feira);
				 $total_201802 = intval($total_201802_petcamp_bg) + intval($total_201802_petcamp_jas) + intval($total_201802_petcenter) + intval($total_201802_petz) + intval($total_201802_petland) + intval($total_201802_leroy) + intval($total_201802_fora_feira);
				 $total_201803 = intval($total_201803_petcamp_bg) + intval($total_201803_petcamp_jas) + intval($total_201803_petcenter) + intval($total_201803_petz) + intval($total_201803_petland) + intval($total_201803_leroy) + intval($total_201803_fora_feira);
				 $total_201804 = intval($total_201804_petcamp_bg) + intval($total_201804_petcamp_jas) + intval($total_201804_petcenter) + intval($total_201804_petz) + intval($total_201804_petland) + intval($total_201804_leroy) + intval($total_201804_fora_feira);
				 $total_201805 = intval($total_201805_petcamp_bg) + intval($total_201805_petcamp_jas) + intval($total_201805_petcenter) + intval($total_201805_petz) + intval($total_201805_petland) + intval($total_201805_leroy) + intval($total_201805_fora_feira);
				 $total_201806 = intval($total_201806_petcamp_bg) + intval($total_201806_petcamp_jas) + intval($total_201806_petcenter) + intval($total_201806_petz) + intval($total_201806_petland) + intval($total_201806_leroy) + intval($total_201806_fora_feira);
				 $total_201807 = intval($total_201807_petcamp_bg) + intval($total_201807_petcamp_jas) + intval($total_201807_petcenter) + intval($total_201807_petz) + intval($total_201807_petland) + intval($total_201807_leroy) + intval($total_201807_fora_feira);
				 $total_201808 = intval($total_201808_petcamp_bg) + intval($total_201808_petcamp_jas) + intval($total_201808_petcenter) + intval($total_201808_petz) + intval($total_201808_petland) + intval($total_201808_leroy) + intval($total_201808_fora_feira);
				 $total_201809 = intval($total_201809_petcamp_bg) + intval($total_201809_petcamp_jas) + intval($total_201809_petcenter) + intval($total_201809_petz) + intval($total_201809_petland) + intval($total_201809_leroy) + intval($total_201809_fora_feira);
				 $total_201810 = intval($total_201810_petcamp_bg) + intval($total_201810_petcamp_jas) + intval($total_201810_petcenter) + intval($total_201810_petz) + intval($total_201810_petland) + intval($total_201810_leroy) + intval($total_201810_fora_feira);
				 $total_201811 = intval($total_201811_petcamp_bg) + intval($total_201811_petcamp_jas) + intval($total_201811_petcenter) + intval($total_201811_petz) + intval($total_201811_petland) + intval($total_201811_leroy) + intval($total_201811_fora_feira);
				 $total_201812 = intval($total_201812_petcamp_bg) + intval($total_201812_petcamp_jas) + intval($total_201812_petcenter) + intval($total_201812_petz) + intval($total_201812_petland) + intval($total_201812_leroy) + intval($total_201812_fora_feira);
				 $total_2018 = intval($total_201801) + intval($total_201802) + intval($total_201803) + intval($total_201804) + intval($total_201805) + intval($total_201806) + intval($total_201807) + intval($total_201808) + intval($total_201809) + intval($total_201810) + intval($total_201811) + intval($total_201812);
				 
				 /********* 2019 **********/
				 $total_201901_petcamp_bg = local_adocao('2019','01','Petcamp Barão Geraldo',$connect);
				 $total_201902_petcamp_bg = local_adocao('2019','02','Petcamp Barão Geraldo',$connect);
				 $total_201903_petcamp_bg = local_adocao('2019','03','Petcamp Barão Geraldo',$connect);
				 $total_201904_petcamp_bg = local_adocao('2019','04','Petcamp Barão Geraldo',$connect);
				 $total_201905_petcamp_bg = local_adocao('2019','05','Petcamp Barão Geraldo',$connect);
				 $total_201906_petcamp_bg = local_adocao('2019','06','Petcamp Barão Geraldo',$connect);
				 $total_201907_petcamp_bg = local_adocao('2019','07','Petcamp Barão Geraldo',$connect);
				 $total_201908_petcamp_bg = local_adocao('2019','08','Petcamp Barão Geraldo',$connect);
				 $total_201909_petcamp_bg = local_adocao('2019','09','Petcamp Barão Geraldo',$connect);
				 $total_201910_petcamp_bg = local_adocao('2019','10','Petcamp Barão Geraldo',$connect);
				 $total_201911_petcamp_bg = local_adocao('2019','11','Petcamp Barão Geraldo',$connect);
				 $total_201912_petcamp_bg = local_adocao('2019','12','Petcamp Barão Geraldo',$connect);
				 $total_201901_petcamp_jas = local_adocao('2019','01','Petcamp Jasmim',$connect);
				 $total_201902_petcamp_jas = local_adocao('2019','02','Petcamp Jasmim',$connect);
				 $total_201903_petcamp_jas = local_adocao('2019','03','Petcamp Jasmim',$connect);
				 $total_201904_petcamp_jas = local_adocao('2019','04','Petcamp Jasmim',$connect);
				 $total_201905_petcamp_jas = local_adocao('2019','05','Petcamp Jasmim',$connect);
				 $total_201906_petcamp_jas = local_adocao('2019','06','Petcamp Jasmim',$connect);
				 $total_201907_petcamp_jas = local_adocao('2019','07','Petcamp Jasmim',$connect);
				 $total_201908_petcamp_jas = local_adocao('2019','08','Petcamp Jasmim',$connect);
				 $total_201909_petcamp_jas = local_adocao('2019','09','Petcamp Jasmim',$connect);
				 $total_201910_petcamp_jas = local_adocao('2019','10','Petcamp Jasmim',$connect);
				 $total_201911_petcamp_jas = local_adocao('2019','11','Petcamp Jasmim',$connect);
				 $total_201912_petcamp_jas = local_adocao('2019','12','Petcamp Jasmim',$connect);
				 $total_201901_petcenter = local_adocao('2019','01','Pet Center Marginal',$connect);
				 $total_201902_petcenter = local_adocao('2019','02','Pet Center Marginal',$connect);
				 $total_201903_petcenter = local_adocao('2019','03','Pet Center Marginal',$connect);
				 $total_201904_petcenter = local_adocao('2019','04','Pet Center Marginal',$connect);
				 $total_201905_petcenter = local_adocao('2019','05','Pet Center Marginal',$connect);
				 $total_201906_petcenter = local_adocao('2019','06','Pet Center Marginal',$connect);
				 $total_201907_petcenter = local_adocao('2019','07','Pet Center Marginal',$connect);
				 $total_201908_petcenter = local_adocao('2019','08','Pet Center Marginal',$connect);
				 $total_201909_petcenter = local_adocao('2019','09','Pet Center Marginal',$connect);
				 $total_201910_petcenter = local_adocao('2019','10','Pet Center Marginal',$connect);
				 $total_201911_petcenter = local_adocao('2019','11','Pet Center Marginal',$connect);
				 $total_201912_petcenter = local_adocao('2019','12','Pet Center Marginal',$connect);
				 $total_201901_petz = local_adocao('2019','01','Petz',$connect);
				 $total_201902_petz = local_adocao('2019','02','Petz',$connect);
				 $total_201903_petz = local_adocao('2019','03','Petz',$connect);
				 $total_201904_petz = local_adocao('2019','04','Petz',$connect);
				 $total_201905_petz = local_adocao('2019','05','Petz',$connect);
				 $total_201906_petz = local_adocao('2019','06','Petz',$connect);
				 $total_201907_petz = local_adocao('2019','07','Petz',$connect);
				 $total_201908_petz = local_adocao('2019','08','Petz',$connect);
				 $total_201909_petz = local_adocao('2019','09','Petz',$connect);
				 $total_201910_petz = local_adocao('2019','10','Petz',$connect);
				 $total_201911_petz = local_adocao('2019','11','Petz',$connect);
				 $total_201912_petz = local_adocao('2019','12','Petz',$connect);
				 $total_201901_petland = local_adocao('2019','01','Petland',$connect);
				 $total_201902_petland = local_adocao('2019','02','Petland',$connect);
				 $total_201903_petland = local_adocao('2019','03','Petland',$connect);
				 $total_201904_petland = local_adocao('2019','04','Petland',$connect);
				 $total_201905_petland = local_adocao('2019','05','Petland',$connect);
				 $total_201906_petland = local_adocao('2019','06','Petland',$connect);
				 $total_201907_petland = local_adocao('2019','07','Petland',$connect);
				 $total_201908_petland = local_adocao('2019','08','Petland',$connect);
				 $total_201909_petland = local_adocao('2019','09','Petland',$connect);
				 $total_201910_petland = local_adocao('2019','10','Petland',$connect);
				 $total_201911_petland = local_adocao('2019','11','Petland',$connect);
				 $total_201912_petland = local_adocao('2019','12','Petland',$connect);
				 $total_201901_leroy = local_adocao('2019','01','Leroy M Dom Pedro',$connect);
				 $total_201902_leroy = local_adocao('2019','02','Leroy M Dom Pedro',$connect);
				 $total_201903_leroy = local_adocao('2019','03','Leroy M Dom Pedro',$connect);
				 $total_201904_leroy = local_adocao('2019','04','Leroy M Dom Pedro',$connect);
				 $total_201905_leroy = local_adocao('2019','05','Leroy M Dom Pedro',$connect);
				 $total_201906_leroy = local_adocao('2019','06','Leroy M Dom Pedro',$connect);
				 $total_201907_leroy = local_adocao('2019','07','Leroy M Dom Pedro',$connect);
				 $total_201908_leroy = local_adocao('2019','08','Leroy M Dom Pedro',$connect);
				 $total_201909_leroy = local_adocao('2019','09','Leroy M Dom Pedro',$connect);
				 $total_201910_leroy = local_adocao('2019','10','Leroy M Dom Pedro',$connect);
				 $total_201911_leroy = local_adocao('2019','11','Leroy M Dom Pedro',$connect);
				 $total_201912_leroy = local_adocao('2019','12','Leroy M Dom Pedro',$connect);
				 $total_201901_fora_feira = local_adocao('2019','01','Fora da feira',$connect);
				 $total_201902_fora_feira = local_adocao('2019','02','Fora da feira',$connect);
				 $total_201903_fora_feira = local_adocao('2019','03','Fora da feira',$connect);
				 $total_201904_fora_feira = local_adocao('2019','04','Fora da feira',$connect);
				 $total_201905_fora_feira = local_adocao('2019','05','Fora da feira',$connect);
				 $total_201906_fora_feira = local_adocao('2019','06','Fora da feira',$connect);
				 $total_201907_fora_feira = local_adocao('2019','07','Fora da feira',$connect);
				 $total_201908_fora_feira = local_adocao('2019','08','Fora da feira',$connect);
				 $total_201909_fora_feira = local_adocao('2019','09','Fora da feira',$connect);
				 $total_201910_fora_feira = local_adocao('2019','10','Fora da feira',$connect);
				 $total_201911_fora_feira = local_adocao('2019','11','Fora da feira',$connect);
				 $total_201912_fora_feira = local_adocao('2019','12','Fora da feira',$connect);
				 $adotados_201901_caes = adotados_mes_caes('2019','01',$connect);
				 $adotados_201902_caes = adotados_mes_caes('2019','02',$connect);
				 $adotados_201903_caes = adotados_mes_caes('2019','03',$connect);
				 $adotados_201904_caes = adotados_mes_caes('2019','04',$connect);
				 $adotados_201905_caes = adotados_mes_caes('2019','05',$connect);
				 $adotados_201906_caes = adotados_mes_caes('2019','06',$connect);
				 $adotados_201907_caes = adotados_mes_caes('2019','07',$connect);
				 $adotados_201908_caes = adotados_mes_caes('2019','08',$connect);
				 $adotados_201909_caes = adotados_mes_caes('2019','09',$connect);
				 $adotados_201910_caes = adotados_mes_caes('2019','10',$connect);
				 $adotados_201911_caes = adotados_mes_caes('2019','11',$connect);
				 $adotados_201912_caes = adotados_mes_caes('2019','12',$connect);
				 $adotados_201901_gatos = adotados_mes_gatos('2019','01',$connect);
				 $adotados_201902_gatos = adotados_mes_gatos('2019','02',$connect);
				 $adotados_201903_gatos = adotados_mes_gatos('2019','03',$connect);
				 $adotados_201904_gatos = adotados_mes_gatos('2019','04',$connect);
				 $adotados_201905_gatos = adotados_mes_gatos('2019','05',$connect);
				 $adotados_201906_gatos = adotados_mes_gatos('2019','06',$connect);
				 $adotados_201907_gatos = adotados_mes_gatos('2019','07',$connect);
				 $adotados_201908_gatos = adotados_mes_gatos('2019','08',$connect);
				 $adotados_201909_gatos = adotados_mes_gatos('2019','09',$connect);
				 $adotados_201910_gatos = adotados_mes_gatos('2019','10',$connect);
				 $adotados_201911_gatos = adotados_mes_gatos('2019','11',$connect);
				 $adotados_201912_gatos = adotados_mes_gatos('2019','12',$connect);
				 $castrados_201901_caes = castrados_mes_caes('2019','01',$connect);
				 $castrados_201902_caes = castrados_mes_caes('2019','02',$connect);
				 $castrados_201903_caes = castrados_mes_caes('2019','03',$connect);
				 $castrados_201904_caes = castrados_mes_caes('2019','04',$connect);
				 $castrados_201905_caes = castrados_mes_caes('2019','05',$connect);
				 $castrados_201906_caes = castrados_mes_caes('2019','06',$connect);
				 $castrados_201907_caes = castrados_mes_caes('2019','07',$connect);
				 $castrados_201908_caes = castrados_mes_caes('2019','08',$connect);
				 $castrados_201909_caes = castrados_mes_caes('2019','09',$connect);
				 $castrados_201910_caes = castrados_mes_caes('2019','10',$connect);
				 $castrados_201911_caes = castrados_mes_caes('2019','11',$connect);
				 $castrados_201912_caes = castrados_mes_caes('2019','12',$connect);
				 $castrados_201901_gatos = castrados_mes_gatos('2019','01',$connect);
				 $castrados_201902_gatos = castrados_mes_gatos('2019','02',$connect);
				 $castrados_201903_gatos = castrados_mes_gatos('2019','03',$connect);
				 $castrados_201904_gatos = castrados_mes_gatos('2019','04',$connect);
				 $castrados_201905_gatos = castrados_mes_gatos('2019','05',$connect);
				 $castrados_201906_gatos = castrados_mes_gatos('2019','06',$connect);
				 $castrados_201907_gatos = castrados_mes_gatos('2019','07',$connect);
				 $castrados_201908_gatos = castrados_mes_gatos('2019','08',$connect);
				 $castrados_201909_gatos = castrados_mes_gatos('2019','09',$connect);
				 $castrados_201910_gatos = castrados_mes_gatos('2019','10',$connect);
				 $castrados_201911_gatos = castrados_mes_gatos('2019','11',$connect);
				 $castrados_201912_gatos = castrados_mes_gatos('2019','12',$connect);				 
				 $total_2019_caes = adotados_total_caes('2019',$connect);
				 $total_2019_gatos = adotados_total_gatos('2019',$connect);
				 $castrados_2019_caes = castrados_total_caes('2019',$connect);
				 $castrados_2019_gatos = castrados_total_gatos('2019',$connect);
				 
				 $total_201901 = intval($total_201901_petcamp_bg) + intval($total_201901_petcamp_jas) + intval($total_201901_petcenter) + intval($total_201901_petz) + intval($total_201901_petland) + intval($total_201901_leroy) + intval($total_201901_fora_feira);
				 $total_201902 = intval($total_201902_petcamp_bg) + intval($total_201902_petcamp_jas) + intval($total_201902_petcenter) + intval($total_201902_petz) + intval($total_201902_petland) + intval($total_201902_leroy) + intval($total_201902_fora_feira);
				 $total_201903 = intval($total_201903_petcamp_bg) + intval($total_201903_petcamp_jas) + intval($total_201903_petcenter) + intval($total_201903_petz) + intval($total_201903_petland) + intval($total_201903_leroy) + intval($total_201903_fora_feira);
				 $total_201904 = intval($total_201904_petcamp_bg) + intval($total_201904_petcamp_jas) + intval($total_201904_petcenter) + intval($total_201904_petz) + intval($total_201904_petland) + intval($total_201904_leroy) + intval($total_201904_fora_feira);
				 $total_201905 = intval($total_201905_petcamp_bg) + intval($total_201905_petcamp_jas) + intval($total_201905_petcenter) + intval($total_201905_petz) + intval($total_201905_petland) + intval($total_201905_leroy) + intval($total_201905_fora_feira);
				 $total_201906 = intval($total_201906_petcamp_bg) + intval($total_201906_petcamp_jas) + intval($total_201906_petcenter) + intval($total_201906_petz) + intval($total_201906_petland) + intval($total_201906_leroy) + intval($total_201906_fora_feira);
				 $total_201907 = intval($total_201907_petcamp_bg) + intval($total_201907_petcamp_jas) + intval($total_201907_petcenter) + intval($total_201907_petz) + intval($total_201907_petland) + intval($total_201907_leroy) + intval($total_201907_fora_feira);
				 $total_201908 = intval($total_201908_petcamp_bg) + intval($total_201908_petcamp_jas) + intval($total_201908_petcenter) + intval($total_201908_petz) + intval($total_201908_petland) + intval($total_201908_leroy) + intval($total_201908_fora_feira);
				 $total_201909 = intval($total_201909_petcamp_bg) + intval($total_201909_petcamp_jas) + intval($total_201909_petcenter) + intval($total_201909_petz) + intval($total_201909_petland) + intval($total_201909_leroy) + intval($total_201909_fora_feira);
				 $total_201910 = intval($total_201910_petcamp_bg) + intval($total_201910_petcamp_jas) + intval($total_201910_petcenter) + intval($total_201910_petz) + intval($total_201910_petland) + intval($total_201910_leroy) + intval($total_201910_fora_feira);
				 $total_201911 = intval($total_201911_petcamp_bg) + intval($total_201911_petcamp_jas) + intval($total_201911_petcenter) + intval($total_201911_petz) + intval($total_201911_petland) + intval($total_201911_leroy) + intval($total_201911_fora_feira);
				 $total_201912 = intval($total_201912_petcamp_bg) + intval($total_201912_petcamp_jas) + intval($total_201912_petcenter) + intval($total_201912_petz) + intval($total_201912_petland) + intval($total_201912_leroy) + intval($total_201912_fora_feira);
				 $total_2019 = intval($total_201901) + intval($total_201902) + intval($total_201903) + intval($total_201904) + intval($total_201905) + intval($total_201906) + intval($total_201907) + intval($total_201908) + intval($total_201909) + intval($total_201910) + intval($total_201911) + intval($total_201912);
				 
				 /********* 2020 **********/
				 $total_202001_petcamp_bg = local_adocao('2020','01','Petcamp Barão Geraldo',$connect);
				 $total_202002_petcamp_bg = local_adocao('2020','02','Petcamp Barão Geraldo',$connect);
				 $total_202003_petcamp_bg = local_adocao('2020','03','Petcamp Barão Geraldo',$connect);
				 $total_202004_petcamp_bg = local_adocao('2020','04','Petcamp Barão Geraldo',$connect);
				 $total_202005_petcamp_bg = local_adocao('2020','05','Petcamp Barão Geraldo',$connect);
				 $total_202006_petcamp_bg = local_adocao('2020','06','Petcamp Barão Geraldo',$connect);
				 $total_202007_petcamp_bg = local_adocao('2020','07','Petcamp Barão Geraldo',$connect);
				 $total_202008_petcamp_bg = local_adocao('2020','08','Petcamp Barão Geraldo',$connect);
				 $total_202009_petcamp_bg = local_adocao('2020','09','Petcamp Barão Geraldo',$connect);
				 $total_202010_petcamp_bg = local_adocao('2020','10','Petcamp Barão Geraldo',$connect);
				 $total_202011_petcamp_bg = local_adocao('2020','11','Petcamp Barão Geraldo',$connect);
				 $total_202012_petcamp_bg = local_adocao('2020','12','Petcamp Barão Geraldo',$connect);
				 $total_202001_petcamp_jas = local_adocao('2020','01','Petcamp Jasmim',$connect);
				 $total_202002_petcamp_jas = local_adocao('2020','02','Petcamp Jasmim',$connect);
				 $total_202003_petcamp_jas = local_adocao('2020','03','Petcamp Jasmim',$connect);
				 $total_202004_petcamp_jas = local_adocao('2020','04','Petcamp Jasmim',$connect);
				 $total_202005_petcamp_jas = local_adocao('2020','05','Petcamp Jasmim',$connect);
				 $total_202006_petcamp_jas = local_adocao('2020','06','Petcamp Jasmim',$connect);
				 $total_202007_petcamp_jas = local_adocao('2020','07','Petcamp Jasmim',$connect);
				 $total_202008_petcamp_jas = local_adocao('2020','08','Petcamp Jasmim',$connect);
				 $total_202009_petcamp_jas = local_adocao('2020','09','Petcamp Jasmim',$connect);
				 $total_202010_petcamp_jas = local_adocao('2020','10','Petcamp Jasmim',$connect);
				 $total_202011_petcamp_jas = local_adocao('2020','11','Petcamp Jasmim',$connect);
				 $total_202012_petcamp_jas = local_adocao('2020','12','Petcamp Jasmim',$connect);
				 $total_202001_petcenter = local_adocao('2020','01','Pet Center Marginal',$connect);
				 $total_202002_petcenter = local_adocao('2020','02','Pet Center Marginal',$connect);
				 $total_202003_petcenter = local_adocao('2020','03','Pet Center Marginal',$connect);
				 $total_202004_petcenter = local_adocao('2020','04','Pet Center Marginal',$connect);
				 $total_202005_petcenter = local_adocao('2020','05','Pet Center Marginal',$connect);
				 $total_202006_petcenter = local_adocao('2020','06','Pet Center Marginal',$connect);
				 $total_202007_petcenter = local_adocao('2020','07','Pet Center Marginal',$connect);
				 $total_202008_petcenter = local_adocao('2020','08','Pet Center Marginal',$connect);
				 $total_202009_petcenter = local_adocao('2020','09','Pet Center Marginal',$connect);
				 $total_202010_petcenter = local_adocao('2020','10','Pet Center Marginal',$connect);
				 $total_202011_petcenter = local_adocao('2020','11','Pet Center Marginal',$connect);
				 $total_202012_petcenter = local_adocao('2020','12','Pet Center Marginal',$connect);
				 $total_202001_petz = local_adocao('2020','01','Petz',$connect);
				 $total_202002_petz = local_adocao('2020','02','Petz',$connect);
				 $total_202003_petz = local_adocao('2020','03','Petz',$connect);
				 $total_202004_petz = local_adocao('2020','04','Petz',$connect);
				 $total_202005_petz = local_adocao('2020','05','Petz',$connect);
				 $total_202006_petz = local_adocao('2020','06','Petz',$connect);
				 $total_202007_petz = local_adocao('2020','07','Petz',$connect);
				 $total_202008_petz = local_adocao('2020','08','Petz',$connect);
				 $total_202009_petz = local_adocao('2020','09','Petz',$connect);
				 $total_202010_petz = local_adocao('2020','10','Petz',$connect);
				 $total_202011_petz = local_adocao('2020','11','Petz',$connect);
				 $total_202012_petz = local_adocao('2020','12','Petz',$connect);
				 $total_202001_petland = local_adocao('2020','01','Petland',$connect);
				 $total_202002_petland = local_adocao('2020','02','Petland',$connect);
				 $total_202003_petland = local_adocao('2020','03','Petland',$connect);
				 $total_202004_petland = local_adocao('2020','04','Petland',$connect);
				 $total_202005_petland = local_adocao('2020','05','Petland',$connect);
				 $total_202006_petland = local_adocao('2020','06','Petland',$connect);
				 $total_202007_petland = local_adocao('2020','07','Petland',$connect);
				 $total_202008_petland = local_adocao('2020','08','Petland',$connect);
				 $total_202009_petland = local_adocao('2020','09','Petland',$connect);
				 $total_202010_petland = local_adocao('2020','10','Petland',$connect);
				 $total_202011_petland = local_adocao('2020','11','Petland',$connect);
				 $total_202012_petland = local_adocao('2020','12','Petland',$connect);
				 $total_202001_leroy = local_adocao('2020','01','Leroy M Dom Pedro',$connect);
				 $total_202002_leroy = local_adocao('2020','02','Leroy M Dom Pedro',$connect);
				 $total_202003_leroy = local_adocao('2020','03','Leroy M Dom Pedro',$connect);
				 $total_202004_leroy = local_adocao('2020','04','Leroy M Dom Pedro',$connect);
				 $total_202005_leroy = local_adocao('2020','05','Leroy M Dom Pedro',$connect);
				 $total_202006_leroy = local_adocao('2020','06','Leroy M Dom Pedro',$connect);
				 $total_202007_leroy = local_adocao('2020','07','Leroy M Dom Pedro',$connect);
				 $total_202008_leroy = local_adocao('2020','08','Leroy M Dom Pedro',$connect);
				 $total_202009_leroy = local_adocao('2020','09','Leroy M Dom Pedro',$connect);
				 $total_202010_leroy = local_adocao('2020','10','Leroy M Dom Pedro',$connect);
				 $total_202011_leroy = local_adocao('2020','11','Leroy M Dom Pedro',$connect);
				 $total_202012_leroy = local_adocao('2020','12','Leroy M Dom Pedro',$connect);
				 $total_202001_fora_feira = local_adocao('2020','01','Fora da feira',$connect);
				 $total_202002_fora_feira = local_adocao('2020','02','Fora da feira',$connect);
				 $total_202003_fora_feira = local_adocao('2020','03','Fora da feira',$connect);
				 $total_202004_fora_feira = local_adocao('2020','04','Fora da feira',$connect);
				 $total_202005_fora_feira = local_adocao('2020','05','Fora da feira',$connect);
				 $total_202006_fora_feira = local_adocao('2020','06','Fora da feira',$connect);
				 $total_202007_fora_feira = local_adocao('2020','07','Fora da feira',$connect);
				 $total_202008_fora_feira = local_adocao('2020','08','Fora da feira',$connect);
				 $total_202009_fora_feira = local_adocao('2020','09','Fora da feira',$connect);
				 $total_202010_fora_feira = local_adocao('2020','10','Fora da feira',$connect);
				 $total_202011_fora_feira = local_adocao('2020','11','Fora da feira',$connect);
				 $total_202012_fora_feira = local_adocao('2020','12','Fora da feira',$connect);
				 $adotados_202001_caes = adotados_mes_caes('2020','01',$connect);
				 $adotados_202002_caes = adotados_mes_caes('2020','02',$connect);
				 $adotados_202003_caes = adotados_mes_caes('2020','03',$connect);
				 $adotados_202004_caes = adotados_mes_caes('2020','04',$connect);
				 $adotados_202005_caes = adotados_mes_caes('2020','05',$connect);
				 $adotados_202006_caes = adotados_mes_caes('2020','06',$connect);
				 $adotados_202007_caes = adotados_mes_caes('2020','07',$connect);
				 $adotados_202008_caes = adotados_mes_caes('2020','08',$connect);
				 $adotados_202009_caes = adotados_mes_caes('2020','09',$connect);
				 $adotados_202010_caes = adotados_mes_caes('2020','10',$connect);
				 $adotados_202011_caes = adotados_mes_caes('2020','11',$connect);
				 $adotados_202012_caes = adotados_mes_caes('2020','12',$connect);
				 $adotados_202001_gatos = adotados_mes_gatos('2020','01',$connect);
				 $adotados_202002_gatos = adotados_mes_gatos('2020','02',$connect);
				 $adotados_202003_gatos = adotados_mes_gatos('2020','03',$connect);
				 $adotados_202004_gatos = adotados_mes_gatos('2020','04',$connect);
				 $adotados_202005_gatos = adotados_mes_gatos('2020','05',$connect);
				 $adotados_202006_gatos = adotados_mes_gatos('2020','06',$connect);
				 $adotados_202007_gatos = adotados_mes_gatos('2020','07',$connect);
				 $adotados_202008_gatos = adotados_mes_gatos('2020','08',$connect);
				 $adotados_202009_gatos = adotados_mes_gatos('2020','09',$connect);
				 $adotados_202010_gatos = adotados_mes_gatos('2020','10',$connect);
				 $adotados_202011_gatos = adotados_mes_gatos('2020','11',$connect);
				 $adotados_202012_gatos = adotados_mes_gatos('2020','12',$connect);
				 $castrados_202001_caes = castrados_mes_caes('2020','01',$connect);
				 $castrados_202002_caes = castrados_mes_caes('2020','02',$connect);
				 $castrados_202003_caes = castrados_mes_caes('2020','03',$connect);
				 $castrados_202004_caes = castrados_mes_caes('2020','04',$connect);
				 $castrados_202005_caes = castrados_mes_caes('2020','05',$connect);
				 $castrados_202006_caes = castrados_mes_caes('2020','06',$connect);
				 $castrados_202007_caes = castrados_mes_caes('2020','07',$connect);
				 $castrados_202008_caes = castrados_mes_caes('2020','08',$connect);
				 $castrados_202009_caes = castrados_mes_caes('2020','09',$connect);
				 $castrados_202010_caes = castrados_mes_caes('2020','10',$connect);
				 $castrados_202011_caes = castrados_mes_caes('2020','11',$connect);
				 $castrados_202012_caes = castrados_mes_caes('2020','12',$connect);
				 $castrados_202001_gatos = castrados_mes_gatos('2020','01',$connect);
				 $castrados_202002_gatos = castrados_mes_gatos('2020','02',$connect);
				 $castrados_202003_gatos = castrados_mes_gatos('2020','03',$connect);
				 $castrados_202004_gatos = castrados_mes_gatos('2020','04',$connect);
				 $castrados_202005_gatos = castrados_mes_gatos('2020','05',$connect);
				 $castrados_202006_gatos = castrados_mes_gatos('2020','06',$connect);
				 $castrados_202007_gatos = castrados_mes_gatos('2020','07',$connect);
				 $castrados_202008_gatos = castrados_mes_gatos('2020','08',$connect);
				 $castrados_202009_gatos = castrados_mes_gatos('2020','09',$connect);
				 $castrados_202010_gatos = castrados_mes_gatos('2020','10',$connect);
				 $castrados_202011_gatos = castrados_mes_gatos('2020','11',$connect);
				 $castrados_202012_gatos = castrados_mes_gatos('2020','12',$connect);
				 $total_2020_caes = adotados_total_caes('2020',$connect);
				 $total_2020_gatos = adotados_total_gatos('2020',$connect);
				 $castrados_2020_caes = castrados_total_caes('2020',$connect);
				 $castrados_2020_gatos = castrados_total_gatos('2020',$connect);
				 
				 $total_202001 = intval($total_202001_petcamp_bg) + intval($total_202001_petcamp_jas) + intval($total_202001_petcenter) + intval($total_202001_petz) + intval($total_202001_petland) + intval($total_202001_leroy) + intval($total_202001_fora_feira);
				 $total_202002 = intval($total_202002_petcamp_bg) + intval($total_202002_petcamp_jas) + intval($total_202002_petcenter) + intval($total_202002_petz) + intval($total_202002_petland) + intval($total_202002_leroy) + intval($total_202002_fora_feira);
				 $total_202003 = intval($total_202003_petcamp_bg) + intval($total_202003_petcamp_jas) + intval($total_202003_petcenter) + intval($total_202003_petz) + intval($total_202003_petland) + intval($total_202003_leroy) + intval($total_202003_fora_feira);
				 $total_202004 = intval($total_202004_petcamp_bg) + intval($total_202004_petcamp_jas) + intval($total_202004_petcenter) + intval($total_202004_petz) + intval($total_202004_petland) + intval($total_202004_leroy) + intval($total_202004_fora_feira);
				 $total_202005 = intval($total_202005_petcamp_bg) + intval($total_202005_petcamp_jas) + intval($total_202005_petcenter) + intval($total_202005_petz) + intval($total_202005_petland) + intval($total_202005_leroy) + intval($total_202005_fora_feira);
				 $total_202006 = intval($total_202006_petcamp_bg) + intval($total_202006_petcamp_jas) + intval($total_202006_petcenter) + intval($total_202006_petz) + intval($total_202006_petland) + intval($total_202006_leroy) + intval($total_202006_fora_feira);
				 $total_202007 = intval($total_202007_petcamp_bg) + intval($total_202007_petcamp_jas) + intval($total_202007_petcenter) + intval($total_202007_petz) + intval($total_202007_petland) + intval($total_202007_leroy) + intval($total_202007_fora_feira);
				 $total_202008 = intval($total_202008_petcamp_bg) + intval($total_202008_petcamp_jas) + intval($total_202008_petcenter) + intval($total_202008_petz) + intval($total_202008_petland) + intval($total_202008_leroy) + intval($total_202008_fora_feira);
				 $total_202009 = intval($total_202009_petcamp_bg) + intval($total_202009_petcamp_jas) + intval($total_202009_petcenter) + intval($total_202009_petz) + intval($total_202009_petland) + intval($total_202009_leroy) + intval($total_202009_fora_feira);
				 $total_202010 = intval($total_202010_petcamp_bg) + intval($total_202010_petcamp_jas) + intval($total_202010_petcenter) + intval($total_202010_petz) + intval($total_202010_petland) + intval($total_202010_leroy) + intval($total_202010_fora_feira);
				 $total_202011 = intval($total_202011_petcamp_bg) + intval($total_202011_petcamp_jas) + intval($total_202011_petcenter) + intval($total_202011_petz) + intval($total_202011_petland) + intval($total_202011_leroy) + intval($total_202011_fora_feira);
				 $total_202012 = intval($total_202012_petcamp_bg) + intval($total_202012_petcamp_jas) + intval($total_202012_petcenter) + intval($total_202012_petz) + intval($total_202012_petland) + intval($total_202012_leroy) + intval($total_202012_fora_feira);
				 $total_2020 = intval($total_202001) + intval($total_202002) + intval($total_202003) + intval($total_202004) + intval($total_202005) + intval($total_202006) + intval($total_202007) + intval($total_202008) + intval($total_202009) + intval($total_202010) + intval($total_202011) + intval($total_202012);
				 
				 /********* 2021 **********/
				 $total_202101_petcamp_bg = local_adocao('2021','01','Petcamp Barão Geraldo',$connect);
				 $total_202102_petcamp_bg = local_adocao('2021','02','Petcamp Barão Geraldo',$connect);
				 $total_202103_petcamp_bg = local_adocao('2021','03','Petcamp Barão Geraldo',$connect);
				 $total_202104_petcamp_bg = local_adocao('2021','04','Petcamp Barão Geraldo',$connect);
				 $total_202105_petcamp_bg = local_adocao('2021','05','Petcamp Barão Geraldo',$connect);
				 $total_202106_petcamp_bg = local_adocao('2021','06','Petcamp Barão Geraldo',$connect);
				 $total_202107_petcamp_bg = local_adocao('2021','07','Petcamp Barão Geraldo',$connect);
				 $total_202108_petcamp_bg = local_adocao('2021','08','Petcamp Barão Geraldo',$connect);
				 $total_202109_petcamp_bg = local_adocao('2021','09','Petcamp Barão Geraldo',$connect);
				 $total_202110_petcamp_bg = local_adocao('2021','10','Petcamp Barão Geraldo',$connect);
				 $total_202111_petcamp_bg = local_adocao('2021','11','Petcamp Barão Geraldo',$connect);
				 $total_202112_petcamp_bg = local_adocao('2021','12','Petcamp Barão Geraldo',$connect);
				 $total_202101_petcamp_jas = local_adocao('2021','01','Petcamp Jasmim',$connect);
				 $total_202102_petcamp_jas = local_adocao('2021','02','Petcamp Jasmim',$connect);
				 $total_202103_petcamp_jas = local_adocao('2021','03','Petcamp Jasmim',$connect);
				 $total_202104_petcamp_jas = local_adocao('2021','04','Petcamp Jasmim',$connect);
				 $total_202105_petcamp_jas = local_adocao('2021','05','Petcamp Jasmim',$connect);
				 $total_202106_petcamp_jas = local_adocao('2021','06','Petcamp Jasmim',$connect);
				 $total_202107_petcamp_jas = local_adocao('2021','07','Petcamp Jasmim',$connect);
				 $total_202108_petcamp_jas = local_adocao('2021','08','Petcamp Jasmim',$connect);
				 $total_202109_petcamp_jas = local_adocao('2021','09','Petcamp Jasmim',$connect);
				 $total_202110_petcamp_jas = local_adocao('2021','10','Petcamp Jasmim',$connect);
				 $total_202111_petcamp_jas = local_adocao('2021','11','Petcamp Jasmim',$connect);
				 $total_202112_petcamp_jas = local_adocao('2021','12','Petcamp Jasmim',$connect);
				 $total_202101_petcenter = local_adocao('2021','01','Pet Center Marginal',$connect);
				 $total_202102_petcenter = local_adocao('2021','02','Pet Center Marginal',$connect);
				 $total_202103_petcenter = local_adocao('2021','03','Pet Center Marginal',$connect);
				 $total_202104_petcenter = local_adocao('2021','04','Pet Center Marginal',$connect);
				 $total_202105_petcenter = local_adocao('2021','05','Pet Center Marginal',$connect);
				 $total_202106_petcenter = local_adocao('2021','06','Pet Center Marginal',$connect);
				 $total_202107_petcenter = local_adocao('2021','07','Pet Center Marginal',$connect);
				 $total_202108_petcenter = local_adocao('2021','08','Pet Center Marginal',$connect);
				 $total_202109_petcenter = local_adocao('2021','09','Pet Center Marginal',$connect);
				 $total_202110_petcenter = local_adocao('2021','10','Pet Center Marginal',$connect);
				 $total_202111_petcenter = local_adocao('2021','11','Pet Center Marginal',$connect);
				 $total_202112_petcenter = local_adocao('2021','12','Pet Center Marginal',$connect);
				 $total_202101_petz = local_adocao('2021','01','Petz',$connect);
				 $total_202102_petz = local_adocao('2021','02','Petz',$connect);
				 $total_202103_petz = local_adocao('2021','03','Petz',$connect);
				 $total_202104_petz = local_adocao('2021','04','Petz',$connect);
				 $total_202105_petz = local_adocao('2021','05','Petz',$connect);
				 $total_202106_petz = local_adocao('2021','06','Petz',$connect);
				 $total_202107_petz = local_adocao('2021','07','Petz',$connect);
				 $total_202108_petz = local_adocao('2021','08','Petz',$connect);
				 $total_202109_petz = local_adocao('2021','09','Petz',$connect);
				 $total_202110_petz = local_adocao('2021','10','Petz',$connect);
				 $total_202111_petz = local_adocao('2021','11','Petz',$connect);
				 $total_202112_petz = local_adocao('2021','12','Petz',$connect);
				 $total_202101_petland = local_adocao('2021','01','Petland',$connect);
				 $total_202102_petland = local_adocao('2021','02','Petland',$connect);
				 $total_202103_petland = local_adocao('2021','03','Petland',$connect);
				 $total_202104_petland = local_adocao('2021','04','Petland',$connect);
				 $total_202105_petland = local_adocao('2021','05','Petland',$connect);
				 $total_202106_petland = local_adocao('2021','06','Petland',$connect);
				 $total_202107_petland = local_adocao('2021','07','Petland',$connect);
				 $total_202108_petland = local_adocao('2021','08','Petland',$connect);
				 $total_202109_petland = local_adocao('2021','09','Petland',$connect);
				 $total_202110_petland = local_adocao('2021','10','Petland',$connect);
				 $total_202111_petland = local_adocao('2021','11','Petland',$connect);
				 $total_202112_petland = local_adocao('2021','12','Petland',$connect);
				 $total_202101_leroy = local_adocao('2021','01','Leroy M Dom Pedro',$connect);
				 $total_202102_leroy = local_adocao('2021','02','Leroy M Dom Pedro',$connect);
				 $total_202103_leroy = local_adocao('2021','03','Leroy M Dom Pedro',$connect);
				 $total_202104_leroy = local_adocao('2021','04','Leroy M Dom Pedro',$connect);
				 $total_202105_leroy = local_adocao('2021','05','Leroy M Dom Pedro',$connect);
				 $total_202106_leroy = local_adocao('2021','06','Leroy M Dom Pedro',$connect);
				 $total_202107_leroy = local_adocao('2021','07','Leroy M Dom Pedro',$connect);
				 $total_202108_leroy = local_adocao('2021','08','Leroy M Dom Pedro',$connect);
				 $total_202109_leroy = local_adocao('2021','09','Leroy M Dom Pedro',$connect);
				 $total_202110_leroy = local_adocao('2021','10','Leroy M Dom Pedro',$connect);
				 $total_202111_leroy = local_adocao('2021','11','Leroy M Dom Pedro',$connect);
				 $total_202112_leroy = local_adocao('2021','12','Leroy M Dom Pedro',$connect);
				 $total_202101_fora_feira = local_adocao('2021','01','Fora da feira',$connect);
				 $total_202102_fora_feira = local_adocao('2021','02','Fora da feira',$connect);
				 $total_202103_fora_feira = local_adocao('2021','03','Fora da feira',$connect);
				 $total_202104_fora_feira = local_adocao('2021','04','Fora da feira',$connect);
				 $total_202105_fora_feira = local_adocao('2021','05','Fora da feira',$connect);
				 $total_202106_fora_feira = local_adocao('2021','06','Fora da feira',$connect);
				 $total_202107_fora_feira = local_adocao('2021','07','Fora da feira',$connect);
				 $total_202108_fora_feira = local_adocao('2021','08','Fora da feira',$connect);
				 $total_202109_fora_feira = local_adocao('2021','09','Fora da feira',$connect);
				 $total_202110_fora_feira = local_adocao('2021','10','Fora da feira',$connect);
				 $total_202111_fora_feira = local_adocao('2021','11','Fora da feira',$connect);
				 $total_202112_fora_feira = local_adocao('2021','12','Fora da feira',$connect);
				 $total_202101_petcamp_bg = local_adocao('2021','01','Petcamp Barão Geraldo',$connect);
				 $total_202102_petcamp_bg = local_adocao('2021','02','Petcamp Barão Geraldo',$connect);
				 $total_202103_petcamp_bg = local_adocao('2021','03','Petcamp Barão Geraldo',$connect);
				 $total_202104_petcamp_bg = local_adocao('2021','04','Petcamp Barão Geraldo',$connect);
				 $total_202105_petcamp_bg = local_adocao('2021','05','Petcamp Barão Geraldo',$connect);
				 $total_202106_petcamp_bg = local_adocao('2021','06','Petcamp Barão Geraldo',$connect);
				 $total_202107_petcamp_bg = local_adocao('2021','07','Petcamp Barão Geraldo',$connect);
				 $total_202108_petcamp_bg = local_adocao('2021','08','Petcamp Barão Geraldo',$connect);
				 $total_202109_petcamp_bg = local_adocao('2021','09','Petcamp Barão Geraldo',$connect);
				 $total_202110_petcamp_bg = local_adocao('2021','10','Petcamp Barão Geraldo',$connect);
				 $total_202111_petcamp_bg = local_adocao('2021','11','Petcamp Barão Geraldo',$connect);
				 $total_202112_petcamp_bg = local_adocao('2021','12','Petcamp Barão Geraldo',$connect);
				 $total_202101_petcamp_jas = local_adocao('2021','01','Petcamp Jasmim',$connect);
				 $total_202102_petcamp_jas = local_adocao('2021','02','Petcamp Jasmim',$connect);
				 $total_202103_petcamp_jas = local_adocao('2021','03','Petcamp Jasmim',$connect);
				 $total_202104_petcamp_jas = local_adocao('2021','04','Petcamp Jasmim',$connect);
				 $total_202105_petcamp_jas = local_adocao('2021','05','Petcamp Jasmim',$connect);
				 $total_202106_petcamp_jas = local_adocao('2021','06','Petcamp Jasmim',$connect);
				 $total_202107_petcamp_jas = local_adocao('2021','07','Petcamp Jasmim',$connect);
				 $total_202108_petcamp_jas = local_adocao('2021','08','Petcamp Jasmim',$connect);
				 $total_202109_petcamp_jas = local_adocao('2021','09','Petcamp Jasmim',$connect);
				 $total_202110_petcamp_jas = local_adocao('2021','10','Petcamp Jasmim',$connect);
				 $total_202111_petcamp_jas = local_adocao('2021','11','Petcamp Jasmim',$connect);
				 $total_202112_petcamp_jas = local_adocao('2021','12','Petcamp Jasmim',$connect);
				 $total_202101_petcenter = local_adocao('2021','01','Pet Center Marginal',$connect);
				 $total_202102_petcenter = local_adocao('2021','02','Pet Center Marginal',$connect);
				 $total_202103_petcenter = local_adocao('2021','03','Pet Center Marginal',$connect);
				 $total_202104_petcenter = local_adocao('2021','04','Pet Center Marginal',$connect);
				 $total_202105_petcenter = local_adocao('2021','05','Pet Center Marginal',$connect);
				 $total_202106_petcenter = local_adocao('2021','06','Pet Center Marginal',$connect);
				 $total_202107_petcenter = local_adocao('2021','07','Pet Center Marginal',$connect);
				 $total_202108_petcenter = local_adocao('2021','08','Pet Center Marginal',$connect);
				 $total_202109_petcenter = local_adocao('2021','09','Pet Center Marginal',$connect);
				 $total_202110_petcenter = local_adocao('2021','10','Pet Center Marginal',$connect);
				 $total_202111_petcenter = local_adocao('2021','11','Pet Center Marginal',$connect);
				 $total_202112_petcenter = local_adocao('2021','12','Pet Center Marginal',$connect);
				 $total_202101_petz = local_adocao('2021','01','Petz',$connect);
				 $total_202102_petz = local_adocao('2021','02','Petz',$connect);
				 $total_202103_petz = local_adocao('2021','03','Petz',$connect);
				 $total_202104_petz = local_adocao('2021','04','Petz',$connect);
				 $total_202105_petz = local_adocao('2021','05','Petz',$connect);
				 $total_202106_petz = local_adocao('2021','06','Petz',$connect);
				 $total_202107_petz = local_adocao('2021','07','Petz',$connect);
				 $total_202108_petz = local_adocao('2021','08','Petz',$connect);
				 $total_202109_petz = local_adocao('2021','09','Petz',$connect);
				 $total_202110_petz = local_adocao('2021','10','Petz',$connect);
				 $total_202111_petz = local_adocao('2021','11','Petz',$connect);
				 $total_202112_petz = local_adocao('2021','12','Petz',$connect);
				 $total_202101_petland = local_adocao('2021','01','Petland',$connect);
				 $total_202102_petland = local_adocao('2021','02','Petland',$connect);
				 $total_202103_petland = local_adocao('2021','03','Petland',$connect);
				 $total_202104_petland = local_adocao('2021','04','Petland',$connect);
				 $total_202105_petland = local_adocao('2021','05','Petland',$connect);
				 $total_202106_petland = local_adocao('2021','06','Petland',$connect);
				 $total_202107_petland = local_adocao('2021','07','Petland',$connect);
				 $total_202108_petland = local_adocao('2021','08','Petland',$connect);
				 $total_202109_petland = local_adocao('2021','09','Petland',$connect);
				 $total_202110_petland = local_adocao('2021','10','Petland',$connect);
				 $total_202111_petland = local_adocao('2021','11','Petland',$connect);
				 $total_202112_petland = local_adocao('2021','12','Petland',$connect);
				 $total_202101_leroy = local_adocao('2021','01','Leroy M Dom Pedro',$connect);
				 $total_202102_leroy = local_adocao('2021','02','Leroy M Dom Pedro',$connect);
				 $total_202103_leroy = local_adocao('2021','03','Leroy M Dom Pedro',$connect);
				 $total_202104_leroy = local_adocao('2021','04','Leroy M Dom Pedro',$connect);
				 $total_202105_leroy = local_adocao('2021','05','Leroy M Dom Pedro',$connect);
				 $total_202106_leroy = local_adocao('2021','06','Leroy M Dom Pedro',$connect);
				 $total_202107_leroy = local_adocao('2021','07','Leroy M Dom Pedro',$connect);
				 $total_202108_leroy = local_adocao('2021','08','Leroy M Dom Pedro',$connect);
				 $total_202109_leroy = local_adocao('2021','09','Leroy M Dom Pedro',$connect);
				 $total_202110_leroy = local_adocao('2021','10','Leroy M Dom Pedro',$connect);
				 $total_202111_leroy = local_adocao('2021','11','Leroy M Dom Pedro',$connect);
				 $total_202112_leroy = local_adocao('2021','12','Leroy M Dom Pedro',$connect);
				 $total_202101_fora_feira = local_adocao('2021','01','Fora da feira',$connect);
				 $total_202102_fora_feira = local_adocao('2021','02','Fora da feira',$connect);
				 $total_202103_fora_feira = local_adocao('2021','03','Fora da feira',$connect);
				 $total_202104_fora_feira = local_adocao('2021','04','Fora da feira',$connect);
				 $total_202105_fora_feira = local_adocao('2021','05','Fora da feira',$connect);
				 $total_202106_fora_feira = local_adocao('2021','06','Fora da feira',$connect);
				 $total_202107_fora_feira = local_adocao('2021','07','Fora da feira',$connect);
				 $total_202108_fora_feira = local_adocao('2021','08','Fora da feira',$connect);
				 $total_202109_fora_feira = local_adocao('2021','09','Fora da feira',$connect);
				 $total_202110_fora_feira = local_adocao('2021','10','Fora da feira',$connect);
				 $total_202111_fora_feira = local_adocao('2021','11','Fora da feira',$connect);
				 $total_202112_fora_feira = local_adocao('2021','12','Fora da feira',$connect);
				 $adotados_202101_caes = adotados_mes_caes('2021','01',$connect);
				 $adotados_202102_caes = adotados_mes_caes('2021','02',$connect);
				 $adotados_202103_caes = adotados_mes_caes('2021','03',$connect);
				 $adotados_202104_caes = adotados_mes_caes('2021','04',$connect);
				 $adotados_202105_caes = adotados_mes_caes('2021','05',$connect);
				 $adotados_202106_caes = adotados_mes_caes('2021','06',$connect);
				 $adotados_202107_caes = adotados_mes_caes('2021','07',$connect);
				 $adotados_202108_caes = adotados_mes_caes('2021','08',$connect);
				 $adotados_202109_caes = adotados_mes_caes('2021','09',$connect);
				 $adotados_202110_caes = adotados_mes_caes('2021','10',$connect);
				 $adotados_202111_caes = adotados_mes_caes('2021','11',$connect);
				 $adotados_202112_caes = adotados_mes_caes('2021','12',$connect);
				 $adotados_202101_gatos = adotados_mes_gatos('2021','01',$connect);
				 $adotados_202102_gatos = adotados_mes_gatos('2021','02',$connect);
				 $adotados_202103_gatos = adotados_mes_gatos('2021','03',$connect);
				 $adotados_202104_gatos = adotados_mes_gatos('2021','04',$connect);
				 $adotados_202105_gatos = adotados_mes_gatos('2021','05',$connect);
				 $adotados_202106_gatos = adotados_mes_gatos('2021','06',$connect);
				 $adotados_202107_gatos = adotados_mes_gatos('2021','07',$connect);
				 $adotados_202108_gatos = adotados_mes_gatos('2021','08',$connect);
				 $adotados_202109_gatos = adotados_mes_gatos('2021','09',$connect);
				 $adotados_202110_gatos = adotados_mes_gatos('2021','10',$connect);
				 $adotados_202111_gatos = adotados_mes_gatos('2021','11',$connect);
				 $adotados_202112_gatos = adotados_mes_gatos('2021','12',$connect);
				 $castrados_202101_caes = castrados_mes_caes('2021','01',$connect);
				 $castrados_202102_caes = castrados_mes_caes('2021','02',$connect);
				 $castrados_202103_caes = castrados_mes_caes('2021','03',$connect);
				 $castrados_202104_caes = castrados_mes_caes('2021','04',$connect);
				 $castrados_202105_caes = castrados_mes_caes('2021','05',$connect);
				 $castrados_202106_caes = castrados_mes_caes('2021','06',$connect);
				 $castrados_202107_caes = castrados_mes_caes('2021','07',$connect);
				 $castrados_202108_caes = castrados_mes_caes('2021','08',$connect);
				 $castrados_202109_caes = castrados_mes_caes('2021','09',$connect);
				 $castrados_202110_caes = castrados_mes_caes('2021','10',$connect);
				 $castrados_202111_caes = castrados_mes_caes('2021','11',$connect);
				 $castrados_202112_caes = castrados_mes_caes('2021','12',$connect);
				 $castrados_202101_gatos = castrados_mes_gatos('2021','01',$connect);
				 $castrados_202102_gatos = castrados_mes_gatos('2021','02',$connect);
				 $castrados_202103_gatos = castrados_mes_gatos('2021','03',$connect);
				 $castrados_202104_gatos = castrados_mes_gatos('2021','04',$connect);
				 $castrados_202105_gatos = castrados_mes_gatos('2021','05',$connect);
				 $castrados_202106_gatos = castrados_mes_gatos('2021','06',$connect);
				 $castrados_202107_gatos = castrados_mes_gatos('2021','07',$connect);
				 $castrados_202108_gatos = castrados_mes_gatos('2021','08',$connect);
				 $castrados_202109_gatos = castrados_mes_gatos('2021','09',$connect);
				 $castrados_202110_gatos = castrados_mes_gatos('2021','10',$connect);
				 $castrados_202111_gatos = castrados_mes_gatos('2021','11',$connect);
				 $castrados_202112_gatos = castrados_mes_gatos('2021','12',$connect);				 
				 $total_2021_caes = adotados_total_caes('2021',$connect); 
				 $total_2021_gatos = adotados_total_gatos('2021',$connect);	
				 $castrados_2021_caes = castrados_total_caes('2021',$connect);
				 $castrados_2021_gatos = castrados_total_gatos('2021',$connect);
				 
				 $total_202101 = intval($total_202101_petcamp_bg) + intval($total_202101_petcamp_jas) + intval($total_202101_petcenter) + intval($total_202101_petz) + intval($total_202101_petland) + intval($total_202101_leroy) + intval($total_202101_fora_feira);
				 $total_202102 = intval($total_202102_petcamp_bg) + intval($total_202102_petcamp_jas) + intval($total_202102_petcenter) + intval($total_202102_petz) + intval($total_202102_petland) + intval($total_202102_leroy) + intval($total_202102_fora_feira);
				 $total_202103 = intval($total_202103_petcamp_bg) + intval($total_202103_petcamp_jas) + intval($total_202103_petcenter) + intval($total_202103_petz) + intval($total_202103_petland) + intval($total_202103_leroy) + intval($total_202103_fora_feira);
				 $total_202104 = intval($total_202104_petcamp_bg) + intval($total_202104_petcamp_jas) + intval($total_202104_petcenter) + intval($total_202104_petz) + intval($total_202104_petland) + intval($total_202104_leroy) + intval($total_202104_fora_feira);
				 $total_202105 = intval($total_202105_petcamp_bg) + intval($total_202105_petcamp_jas) + intval($total_202105_petcenter) + intval($total_202105_petz) + intval($total_202105_petland) + intval($total_202105_leroy) + intval($total_202105_fora_feira);
				 $total_202106 = intval($total_202106_petcamp_bg) + intval($total_202106_petcamp_jas) + intval($total_202106_petcenter) + intval($total_202106_petz) + intval($total_202106_petland) + intval($total_202106_leroy) + intval($total_202106_fora_feira);
				 $total_202107 = intval($total_202107_petcamp_bg) + intval($total_202107_petcamp_jas) + intval($total_202107_petcenter) + intval($total_202107_petz) + intval($total_202107_petland) + intval($total_202107_leroy) + intval($total_202107_fora_feira);
				 $total_202108 = intval($total_202108_petcamp_bg) + intval($total_202108_petcamp_jas) + intval($total_202108_petcenter) + intval($total_202108_petz) + intval($total_202108_petland) + intval($total_202108_leroy) + intval($total_202108_fora_feira);
				 $total_202109 = intval($total_202109_petcamp_bg) + intval($total_202109_petcamp_jas) + intval($total_202109_petcenter) + intval($total_202109_petz) + intval($total_202109_petland) + intval($total_202109_leroy) + intval($total_202109_fora_feira);
				 $total_202110 = intval($total_202110_petcamp_bg) + intval($total_202110_petcamp_jas) + intval($total_202110_petcenter) + intval($total_202110_petz) + intval($total_202110_petland) + intval($total_202110_leroy) + intval($total_202110_fora_feira);
				 $total_202111 = intval($total_202111_petcamp_bg) + intval($total_202111_petcamp_jas) + intval($total_202111_petcenter) + intval($total_202111_petz) + intval($total_202111_petland) + intval($total_202111_leroy) + intval($total_202111_fora_feira);
				 $total_202112 = intval($total_202112_petcamp_bg) + intval($total_202112_petcamp_jas) + intval($total_202112_petcenter) + intval($total_202112_petz) + intval($total_202112_petland) + intval($total_202112_leroy) + intval($total_202112_fora_feira);
				 $total_2021 = intval($total_202101) + intval($total_202102) + intval($total_202103) + intval($total_202104) + intval($total_202105) + intval($total_202106) + intval($total_202107) + intval($total_202108) + intval($total_202109) + intval($total_202110) + intval($total_202111) + intval($total_202112);
				 
				 $adotados_caes_femeas = adotados_total_femeas('Canina',$connect);
				 $adotados_caes_machos = adotados_total_machos('Canina',$connect);
				
				 $adotados_gatos_femeas = adotados_total_femeas('Felina',$connect);
				 $adotados_gatos_machos = adotados_total_machos('Felina',$connect);
				 
				 $adotados_caes = intval($adotados_201401_caes) +
                                    intval($adotados_201402_caes) +
                                    intval($adotados_201403_caes) +
                                    intval($adotados_201404_caes) +
                                    intval($adotados_201405_caes) +
                                    intval($adotados_201406_caes) +
                                    intval($adotados_201407_caes) +
                                    intval($adotados_201408_caes) +
                                    intval($adotados_201409_caes) +
                                    intval($adotados_201410_caes) +
                                    intval($adotados_201411_caes) +
                                    intval($adotados_201412_caes) +
                                    intval($adotados_201501_caes) +
                                    intval($adotados_201502_caes) +
                                    intval($adotados_201503_caes) +
                                    intval($adotados_201504_caes) +
                                    intval($adotados_201505_caes) +
                                    intval($adotados_201506_caes) +
                                    intval($adotados_201507_caes) +
                                    intval($adotados_201508_caes) +
                                    intval($adotados_201509_caes) +
                                    intval($adotados_201510_caes) +
                                    intval($adotados_201511_caes) +
                                    intval($adotados_201512_caes) +
                                    intval($adotados_201601_caes) +
                                    intval($adotados_201602_caes) +
                                    intval($adotados_201603_caes) +
                                    intval($adotados_201604_caes) +
                                    intval($adotados_201605_caes) +
                                    intval($adotados_201606_caes) +
                                    intval($adotados_201607_caes) +
                                    intval($adotados_201608_caes) +
                                    intval($adotados_201609_caes) +
                                    intval($adotados_201610_caes) +
                                    intval($adotados_201611_caes) +
                                    intval($adotados_201612_caes) +
                                    intval($adotados_201701_caes) +
                                    intval($adotados_201702_caes) +
                                    intval($adotados_201703_caes) +
                                    intval($adotados_201704_caes) +
                                    intval($adotados_201705_caes) +
                                    intval($adotados_201706_caes) +
                                    intval($adotados_201707_caes) +
                                    intval($adotados_201708_caes) +
                                    intval($adotados_201709_caes) +
                                    intval($adotados_201710_caes) +
                                    intval($adotados_201711_caes) +
                                    intval($adotados_201712_caes) +
                                    intval($adotados_201801_caes) +
                                    intval($adotados_201802_caes) +
                                    intval($adotados_201803_caes) +
                                    intval($adotados_201804_caes) +
                                    intval($adotados_201805_caes) +
                                    intval($adotados_201806_caes) +
                                    intval($adotados_201807_caes) +
                                    intval($adotados_201808_caes) +
                                    intval($adotados_201809_caes) +
                                    intval($adotados_201810_caes) +
                                    intval($adotados_201811_caes) +
                                    intval($adotados_201812_caes) +
                                    intval($adotados_201901_caes) +
                                    intval($adotados_201902_caes) +
                                    intval($adotados_201903_caes) +
                                    intval($adotados_201904_caes) +
                                    intval($adotados_201905_caes) +
                                    intval($adotados_201906_caes) +
                                    intval($adotados_201907_caes) +
                                    intval($adotados_201908_caes) +
                                    intval($adotados_201909_caes) +
                                    intval($adotados_201910_caes) +
                                    intval($adotados_201911_caes) +
                                    intval($adotados_201912_caes) +
                                    intval($adotados_202001_caes) +
                                    intval($adotados_202002_caes) +
                                    intval($adotados_202003_caes) +
                                    intval($adotados_202004_caes) +
                                    intval($adotados_202005_caes) +
                                    intval($adotados_202006_caes) +
                                    intval($adotados_202007_caes) +
                                    intval($adotados_202008_caes) +
                                    intval($adotados_202009_caes) +
                                    intval($adotados_202010_caes) +
                                    intval($adotados_202011_caes) +
                                    intval($adotados_202012_caes) +
                                    intval($adotados_202101_caes) +
                                    intval($adotados_202102_caes) +
                                    intval($adotados_202103_caes) +
                                    intval($adotados_202104_caes) +
                                    intval($adotados_202105_caes) +
                                    intval($adotados_202106_caes) +
                                    intval($adotados_202107_caes) +
                                    intval($adotados_202108_caes) +
                                    intval($adotados_202109_caes) +
                                    intval($adotados_202110_caes) +
                                    intval($adotados_202111_caes) +
                                    intval($adotados_202112_caes);
                                    
                $adotados_gatos = intval($adotados_201401_gatos) +
                                    intval($adotados_201402_gatos) +
                                    intval($adotados_201403_gatos) +
                                    intval($adotados_201404_gatos) +
                                    intval($adotados_201405_gatos) +
                                    intval($adotados_201406_gatos) +
                                    intval($adotados_201407_gatos) +
                                    intval($adotados_201408_gatos) +
                                    intval($adotados_201409_gatos) +
                                    intval($adotados_201410_gatos) +
                                    intval($adotados_201411_gatos) +
                                    intval($adotados_201412_gatos) +
                                    intval($adotados_201501_gatos) +
                                    intval($adotados_201502_gatos) +
                                    intval($adotados_201503_gatos) +
                                    intval($adotados_201504_gatos) +
                                    intval($adotados_201505_gatos) +
                                    intval($adotados_201506_gatos) +
                                    intval($adotados_201507_gatos) +
                                    intval($adotados_201508_gatos) +
                                    intval($adotados_201509_gatos) +
                                    intval($adotados_201510_gatos) +
                                    intval($adotados_201511_gatos) +
                                    intval($adotados_201512_gatos) +
                                    intval($adotados_201601_gatos) +
                                    intval($adotados_201602_gatos) +
                                    intval($adotados_201603_gatos) +
                                    intval($adotados_201604_gatos) +
                                    intval($adotados_201605_gatos) +
                                    intval($adotados_201606_gatos) +
                                    intval($adotados_201607_gatos) +
                                    intval($adotados_201608_gatos) +
                                    intval($adotados_201609_gatos) +
                                    intval($adotados_201610_gatos) +
                                    intval($adotados_201611_gatos) +
                                    intval($adotados_201612_gatos) +
                                    intval($adotados_201701_gatos) +
                                    intval($adotados_201702_gatos) +
                                    intval($adotados_201703_gatos) +
                                    intval($adotados_201704_gatos) +
                                    intval($adotados_201705_gatos) +
                                    intval($adotados_201706_gatos) +
                                    intval($adotados_201707_gatos) +
                                    intval($adotados_201708_gatos) +
                                    intval($adotados_201709_gatos) +
                                    intval($adotados_201710_gatos) +
                                    intval($adotados_201711_gatos) +
                                    intval($adotados_201712_gatos) +
                                    intval($adotados_201801_gatos) +
                                    intval($adotados_201802_gatos) +
                                    intval($adotados_201803_gatos) +
                                    intval($adotados_201804_gatos) +
                                    intval($adotados_201805_gatos) +
                                    intval($adotados_201806_gatos) +
                                    intval($adotados_201807_gatos) +
                                    intval($adotados_201808_gatos) +
                                    intval($adotados_201809_gatos) +
                                    intval($adotados_201810_gatos) +
                                    intval($adotados_201811_gatos) +
                                    intval($adotados_201812_gatos) +
                                    intval($adotados_201901_gatos) +
                                    intval($adotados_201902_gatos) +
                                    intval($adotados_201903_gatos) +
                                    intval($adotados_201904_gatos) +
                                    intval($adotados_201905_gatos) +
                                    intval($adotados_201906_gatos) +
                                    intval($adotados_201907_gatos) +
                                    intval($adotados_201908_gatos) +
                                    intval($adotados_201909_gatos) +
                                    intval($adotados_201910_gatos) +
                                    intval($adotados_201911_gatos) +
                                    intval($adotados_201912_gatos) +
                                    intval($adotados_202001_gatos) +
                                    intval($adotados_202002_gatos) +
                                    intval($adotados_202003_gatos) +
                                    intval($adotados_202004_gatos) +
                                    intval($adotados_202005_gatos) +
                                    intval($adotados_202006_gatos) +
                                    intval($adotados_202007_gatos) +
                                    intval($adotados_202008_gatos) +
                                    intval($adotados_202009_gatos) +
                                    intval($adotados_202010_gatos) +
                                    intval($adotados_202011_gatos) +
                                    intval($adotados_202012_gatos) +
                                    intval($adotados_202101_gatos) +
                                    intval($adotados_202102_gatos) +
                                    intval($adotados_202103_gatos) +
                                    intval($adotados_202104_gatos) +
                                    intval($adotados_202105_gatos) +
                                    intval($adotados_202106_gatos) +
                                    intval($adotados_202107_gatos) +
                                    intval($adotados_202108_gatos) +
                                    intval($adotados_202109_gatos) +
                                    intval($adotados_202110_gatos) +
                                    intval($adotados_202111_gatos) +
                                    intval($adotados_202112_gatos);
				
				 $perc_caes = (intval($adotados_caes) / intval($animais_adotados))*100;
				 $perc_caes_femeas = (intval($adotados_caes_femeas) / intval($animais_adotados))*100;
				 $perc_caes_machos = (intval($adotados_caes_machos) / intval($animais_adotados))*100;
				
				 $perc_gatos = (intval($adotados_gatos) / intval($animais_adotados))*100;
				 $perc_gatos_femeas = (intval($adotados_gatos_femeas) / intval($animais_adotados))*100;
				 $perc_gatos_machos = (intval($adotados_gatos_machos) / intval($animais_adotados))*100;
				 
				 /***************************************************/
				 
				echo "<center><table class='table' >
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
							<th scope='row'>2014 </th>
							<th scope='row'>Janeiro </th>
							<td>".$adotados_201401_caes."</td>
							<td>".$adotados_201401_gatos."</td>
							<td>".$castrados_201401_caes."</td>
							<td>".$castrados_201401_gatos."</td>
							<td>".$total_201401_petz."</td>
							<td>".$total_201401_petcenter."</td>
							<td>".$total_201401_petcamp_bg."</td>
							<td>".$total_201401_petcamp_jas."</td>
							<td>".$total_201401_petland."</td>
							<td>".$total_201401_leroy."</td>
							<td>".$total_201401_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>2014 </th>
							<th scope='row'>Fevereiro </th>
							<td>".$adotados_201402_caes."</td>
							<td>".$adotados_201402_gatos."</td>
							<td>".$castrados_201402_caes."</td>
							<td>".$castrados_201402_gatos."</td>
							<td>".$total_201402_petz."</td>
							<td>".$total_201402_petcenter."</td>
							<td>".$total_201402_petcamp_bg."</td>
							<td>".$total_201402_petcamp_jas."</td>
							<td>".$total_201402_petland."</td>
							<td>".$total_201402_leroy."</td>
							<td>".$total_201402_fora_feira."</td>
						  </tr>
						   <tr> 
							<th scope='row'>2014 </th>
							<th scope='row'>Março </th>
							<td>".$adotados_201403_caes."</td>
							<td>".$adotados_201403_gatos."</td>
							<td>".$castrados_201403_caes."</td>
							<td>".$castrados_201403_gatos."</td>
							<td>".$total_201403_petz."</td>
							<td>".$total_201403_petcenter."</td>
							<td>".$total_201403_petcamp_bg."</td>
							<td>".$total_201403_petcamp_jas."</td>
							<td>".$total_201403_petland."</td>
							<td>".$total_201403_leroy."</td>
							<td>".$total_201403_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Abril</th>
							<td>".$adotados_201404_caes."</td>
							<td>".$adotados_201404_gatos."</td>
							<td>".$castrados_201404_caes."</td>
							<td>".$castrados_201404_gatos."</td>
							<td>".$total_201404_petz."</td>
							<td>".$total_201404_petcenter."</td>
							<td>".$total_201404_petcamp_bg."</td>
							<td>".$total_201404_petcamp_jas."</td>
							<td>".$total_201404_petland."</td>
							<td>".$total_201404_leroy."</td>
							<td>".$total_201404_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Maio</th>
							<td>".$adotados_201405_caes."</td>
							<td>".$adotados_201405_gatos."</td>
							<td>".$castrados_201405_caes."</td>
							<td>".$castrados_201405_gatos."</td>
							<td>".$total_201405_petz."</td>
							<td>".$total_201405_petcenter."</td>
							<td>".$total_201405_petcamp_bg."</td>
							<td>".$total_201405_petcamp_jas."</td>
							<td>".$total_201405_petland."</td>
							<td>".$total_201405_leroy."</td>
							<td>".$total_201405_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Junho</th>
							<td>".$adotados_201406_caes."</td>
							<td>".$adotados_201406_gatos."</td>
							<td>".$castrados_201406_caes."</td>
							<td>".$castrados_201406_gatos."</td>
							<td>".$total_201406_petz."</td>
							<td>".$total_201406_petcenter."</td>
							<td>".$total_201406_petcamp_bg."</td>
							<td>".$total_201406_petcamp_jas."</td>
							<td>".$total_201406_petland."</td>
							<td>".$total_201406_leroy."</td>
							<td>".$total_201406_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Julho</th>
							<td>".$adotados_201407_caes."</td>
							<td>".$adotados_201407_gatos."</td>
							<td>".$castrados_201407_caes."</td>
							<td>".$castrados_201407_gatos."</td>
							<td>".$total_201407_petz."</td>
							<td>".$total_201407_petcenter."</td>
							<td>".$total_201407_petcamp_bg."</td>
							<td>".$total_201407_petcamp_jas."</td>
							<td>".$total_201407_petland."</td>
							<td>".$total_201407_leroy."</td>
							<td>".$total_201407_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_201408_caes."</td>
							<td>".$adotados_201408_gatos."</td>
							<td>".$castrados_201408_caes."</td>
							<td>".$castrados_201408_gatos."</td>
							<td>".$total_201408_petz."</td>
							<td>".$total_201408_petcenter."</td>
							<td>".$total_201408_petcamp_bg."</td>
							<td>".$total_201408_petcamp_jas."</td>
							<td>".$total_201408_petland."</td>
							<td>".$total_201408_leroy."</td>
							<td>".$total_201408_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_201409_caes."</td>
							<td>".$adotados_201409_gatos."</td>
							<td>".$castrados_201409_caes."</td>
							<td>".$castrados_201409_gatos."</td>
							<td>".$total_201409_petz."</td>
							<td>".$total_201409_petcenter."</td>
							<td>".$total_201409_petcamp_bg."</td>
							<td>".$total_201409_petcamp_jas."</td>
							<td>".$total_201409_petland."</td>
							<td>".$total_201409_leroy."</td>
							<td>".$total_201409_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_201410_caes."</td>
							<td>".$adotados_201410_gatos."</td>
							<td>".$castrados_201410_caes."</td>
							<td>".$castrados_201410_gatos."</td>
							<td>".$total_201410_petz."</td>
							<td>".$total_201410_petcenter."</td>
							<td>".$total_201410_petcamp_bg."</td>
							<td>".$total_201410_petcamp_jas."</td>
							<td>".$total_201410_petland."</td>
							<td>".$total_201410_leroy."</td>
							<td>".$total_201410_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_201411_caes."</td>
							<td>".$adotados_201411_gatos."</td>
							<td>".$castrados_201411_caes."</td>
							<td>".$castrados_201411_gatos."</td>
							<td>".$total_201411_petz."</td>
							<td>".$total_201411_petcenter."</td>
							<td>".$total_201411_petcamp_bg."</td>
							<td>".$total_201411_petcamp_jas."</td>
							<td>".$total_201411_petland."</td>
							<td>".$total_201411_leroy."</td>
							<td>".$total_201411_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_201412_caes."</td>
							<td>".$adotados_201412_gatos."</td>
							<td>".$castrados_201412_caes."</td>
							<td>".$castrados_201412_gatos."</td>
							<td>".$total_201412_petz."</td>
							<td>".$total_201412_petcenter."</td>
							<td>".$total_201412_petcamp_bg."</td>
							<td>".$total_201412_petcamp_jas."</td>
							<td>".$total_201412_petland."</td>
							<td>".$total_201412_leroy."</td>
							<td>".$total_201412_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2014."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2015</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_201501_caes."</td>
							<td>".$adotados_201501_gatos."</td>
							<td>".$castrados_201501_caes."</td>
							<td>".$castrados_201501_gatos."</td>
							<td>".$total_201501_petz."</td>
							<td>".$total_201501_petcenter."</td>
							<td>".$total_201501_petcamp_bg."</td>
							<td>".$total_201501_petcamp_jas."</td>
							<td>".$total_201501_petland."</td>
							<td>".$total_201501_leroy."</td>
							<td>".$total_201501_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_201502_caes."</td>
							<td>".$adotados_201502_gatos."</td>
							<td>".$castrados_201502_caes."</td>
							<td>".$castrados_201502_gatos."</td>
							<td>".$total_201502_petz."</td>
							<td>".$total_201502_petcenter."</td>
							<td>".$total_201502_petcamp_bg."</td>
							<td>".$total_201502_petcamp_jas."</td>
							<td>".$total_201502_petland."</td>
							<td>".$total_201502_leroy."</td>
							<td>".$total_201502_fora_feira."</td>
							
						  </tr>
						   <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Março </th>
							<td>".$adotados_201503_caes."</td>
							<td>".$adotados_201503_gatos."</td>
							<td>".$castrados_201503_caes."</td>
							<td>".$castrados_201503_gatos."</td>
							<td>".$total_201503_petz."</td>
							<td>".$total_201503_petcenter."</td>
							<td>".$total_201503_petcamp_bg."</td>
							<td>".$total_201503_petcamp_jas."</td>
							<td>".$total_201503_petland."</td>
							<td>".$total_201503_leroy."</td>
							<td>".$total_201503_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_201504_caes."</td>
							<td>".$adotados_201504_gatos."</td>
							<td>".$castrados_201504_caes."</td>
							<td>".$castrados_201504_gatos."</td>
							<td>".$total_201504_petz."</td>
							<td>".$total_201504_petcenter."</td>
							<td>".$total_201504_petcamp_bg."</td>
							<td>".$total_201504_petcamp_jas."</td>
							<td>".$total_201504_petland."</td>
							<td>".$total_201504_leroy."</td>
							<td>".$total_201504_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_201505_caes."</td>
							<td>".$adotados_201505_gatos."</td>
							<td>".$castrados_201505_caes."</td>
							<td>".$castrados_201505_gatos."</td>
							<td>".$total_201505_petz."</td>
							<td>".$total_201505_petcenter."</td>
							<td>".$total_201505_petcamp_bg."</td>
							<td>".$total_201505_petcamp_jas."</td>
							<td>".$total_201505_petland."</td>
							<td>".$total_201505_leroy."</td>
							<td>".$total_201505_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_201506_caes."</td>
							<td>".$adotados_201506_gatos."</td>
							<td>".$castrados_201506_caes."</td>
							<td>".$castrados_201506_gatos."</td>
							<td>".$total_201506_petz."</td>
							<td>".$total_201506_petcenter."</td>
							<td>".$total_201506_petcamp_bg."</td>
							<td>".$total_201506_petcamp_jas."</td>
							<td>".$total_201506_petland."</td>
							<td>".$total_201506_leroy."</td>
							<td>".$total_201506_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_201507_caes."</td>
							<td>".$adotados_201507_gatos."</td>
							<td>".$castrados_201507_caes."</td>
							<td>".$castrados_201507_gatos."</td>
							<td>".$total_201507_petz."</td>
							<td>".$total_201507_petcenter."</td>
							<td>".$total_201507_petcamp_bg."</td>
							<td>".$total_201507_petcamp_jas."</td>
							<td>".$total_201507_petland."</td>
							<td>".$total_201507_leroy."</td>
							<td>".$total_201507_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_201508_caes."</td>
							<td>".$adotados_201508_gatos."</td>
							<td>".$castrados_201508_caes."</td>
							<td>".$castrados_201508_gatos."</td>
							<td>".$total_201508_petz."</td>
							<td>".$total_201508_petcenter."</td>
							<td>".$total_201508_petcamp_bg."</td>
							<td>".$total_201508_petcamp_jas."</td>
							<td>".$total_201508_petland."</td>
							<td>".$total_201508_leroy."</td>
							<td>".$total_201508_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_201509_caes."</td>
							<td>".$adotados_201509_gatos."</td>
							<td>".$castrados_201509_caes."</td>
							<td>".$castrados_201509_gatos."</td>
							<td>".$total_201509_petz."</td>
							<td>".$total_201509_petcenter."</td>
							<td>".$total_201509_petcamp_bg."</td>
							<td>".$total_201509_petcamp_jas."</td>
							<td>".$total_201509_petland."</td>
							<td>".$total_201509_leroy."</td>
							<td>".$total_201509_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_201510_caes."</td>
							<td>".$adotados_201510_gatos."</td>
							<td>".$castrados_201510_caes."</td>
							<td>".$castrados_201510_gatos."</td>
							<td>".$total_201510_petz."</td>
							<td>".$total_201510_petcenter."</td>
							<td>".$total_201510_petcamp_bg."</td>
							<td>".$total_201510_petcamp_jas."</td>
							<td>".$total_201510_petland."</td>
							<td>".$total_201510_leroy."</td>
							<td>".$total_201510_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_201511_caes."</td>
							<td>".$adotados_201511_gatos."</td>
							<td>".$castrados_201511_caes."</td>
							<td>".$castrados_201511_gatos."</td>
							<td>".$total_201511_petz."</td>
							<td>".$total_201511_petcenter."</td>
							<td>".$total_201511_petcamp_bg."</td>
							<td>".$total_201511_petcamp_jas."</td>
							<td>".$total_201511_petland."</td>
							<td>".$total_201511_leroy."</td>
							<td>".$total_201511_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_201512_caes."</td>
							<td>".$adotados_201512_gatos."</td>
							<td>".$castrados_201512_caes."</td>
							<td>".$castrados_201512_gatos."</td>
							<td>".$total_201512_petz."</td>
							<td>".$total_201512_petcenter."</td>
							<td>".$total_201512_petcamp_bg."</td>
							<td>".$total_201512_petcamp_jas."</td>
							<td>".$total_201512_petland."</td>
							<td>".$total_201512_leroy."</td>
							<td>".$total_201512_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2015."</td>
							<td colspan='10'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2016</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_201601_caes."</td>
							<td>".$adotados_201601_gatos."</td>
							<td>".$castrados_201601_caes."</td>
							<td>".$castrados_201601_gatos."</td>
							<td>".$total_201601_petz."</td>
							<td>".$total_201601_petcenter."</td>
							<td>".$total_201601_petcamp_bg."</td>
							<td>".$total_201601_petcamp_jas."</td>
							<td>".$total_201601_petland."</td>
							<td>".$total_201601_leroy."</td>
							<td>".$total_201601_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_201602_caes."</td>
							<td>".$adotados_201602_gatos."</td>
							<td>".$castrados_201602_caes."</td>
							<td>".$castrados_201602_gatos."</td>
							<td>".$total_201602_petz."</td>
							<td>".$total_201602_petcenter."</td>
							<td>".$total_201602_petcamp_bg."</td>
							<td>".$total_201602_petcamp_jas."</td>
							<td>".$total_201602_petland."</td>
							<td>".$total_201602_leroy."</td>
							<td>".$total_201602_fora_feira."</td>
						  </tr>
						   <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Março </th>
							<td>".$adotados_201603_caes."</td>
							<td>".$adotados_201603_gatos."</td>
							<td>".$castrados_201603_caes."</td>
							<td>".$castrados_201603_gatos."</td>
							<td>".$total_201603_petz."</td>
							<td>".$total_201603_petcenter."</td>
							<td>".$total_201603_petcamp_bg."</td>
							<td>".$total_201603_petcamp_jas."</td>
							<td>".$total_201603_petland."</td>
							<td>".$total_201603_leroy."</td>
							<td>".$total_201603_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_201604_caes."</td>
							<td>".$adotados_201604_gatos."</td>
							<td>".$castrados_201604_caes."</td>
							<td>".$castrados_201604_gatos."</td>
							<td>".$total_201604_petz."</td>
							<td>".$total_201604_petcenter."</td>
							<td>".$total_201604_petcamp_bg."</td>
							<td>".$total_201604_petcamp_jas."</td>
							<td>".$total_201604_petland."</td>
							<td>".$total_201604_leroy."</td>
							<td>".$total_201604_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_201605_caes."</td>
							<td>".$adotados_201605_gatos."</td>
							<td>".$castrados_201605_caes."</td>
							<td>".$castrados_201605_gatos."</td>
							<td>".$total_201605_petz."</td>
							<td>".$total_201605_petcenter."</td>
							<td>".$total_201605_petcamp_bg."</td>
							<td>".$total_201605_petcamp_jas."</td>
							<td>".$total_201605_petland."</td>
							<td>".$total_201605_leroy."</td>
							<td>".$total_201605_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_201606_caes."</td>
							<td>".$adotados_201606_gatos."</td>
							<td>".$castrados_201606_caes."</td>
							<td>".$castrados_201606_gatos."</td>
							<td>".$total_201606_petz."</td>
							<td>".$total_201606_petcenter."</td>
							<td>".$total_201606_petcamp_bg."</td>
							<td>".$total_201606_petcamp_jas."</td>
							<td>".$total_201606_petland."</td>
							<td>".$total_201606_leroy."</td>
							<td>".$total_201606_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_201607_caes."</td>
							<td>".$adotados_201607_gatos."</td>
							<td>".$castrados_201607_caes."</td>
							<td>".$castrados_201607_gatos."</td>
							<td>".$total_201607_petz."</td>
							<td>".$total_201607_petcenter."</td>
							<td>".$total_201607_petcamp_bg."</td>
							<td>".$total_201607_petcamp_jas."</td>
							<td>".$total_201607_petland."</td>
							<td>".$total_201607_leroy."</td>
							<td>".$total_201607_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_201608_caes."</td>
							<td>".$adotados_201608_gatos."</td>
							<td>".$castrados_201608_caes."</td>
							<td>".$castrados_201608_gatos."</td>
							<td>".$total_201608_petz."</td>
							<td>".$total_201608_petcenter."</td>
							<td>".$total_201608_petcamp_bg."</td>
							<td>".$total_201608_petcamp_jas."</td>
							<td>".$total_201608_petland."</td>
							<td>".$total_201608_leroy."</td>
							<td>".$total_201608_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_201609_caes."</td>
							<td>".$adotados_201609_gatos."</td>
							<td>".$castrados_201609_caes."</td>
							<td>".$castrados_201609_gatos."</td>
							<td>".$total_201609_petz."</td>
							<td>".$total_201609_petcenter."</td>
							<td>".$total_201609_petcamp_bg."</td>
							<td>".$total_201609_petcamp_jas."</td>
							<td>".$total_201609_petland."</td>
							<td>".$total_201609_leroy."</td>
							<td>".$total_201609_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_201610_caes."</td>
							<td>".$adotados_201610_gatos."</td>
							<td>".$castrados_201610_caes."</td>
							<td>".$castrados_201610_gatos."</td>
							<td>".$total_201610_petz."</td>
							<td>".$total_201610_petcenter."</td>
							<td>".$total_201610_petcamp_bg."</td>
							<td>".$total_201610_petcamp_jas."</td>
							<td>".$total_201610_petland."</td>
							<td>".$total_201610_leroy."</td>
							<td>".$total_201610_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_201611_caes."</td>
							<td>".$adotados_201611_gatos."</td>
							<td>".$castrados_201611_caes."</td>
							<td>".$castrados_201611_gatos."</td>
							<td>".$total_201611_petz."</td>
							<td>".$total_201611_petcenter."</td>
							<td>".$total_201611_petcamp_bg."</td>
							<td>".$total_201611_petcamp_jas."</td>
							<td>".$total_201611_petland."</td>
							<td>".$total_201611_leroy."</td>
							<td>".$total_201611_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_201612_caes."</td>
							<td>".$adotados_201612_gatos."</td>
							<td>".$castrados_201612_caes."</td>
							<td>".$castrados_201612_gatos."</td>
							<td>".$total_201612_petz."</td>
							<td>".$total_201612_petcenter."</td>
							<td>".$total_201612_petcamp_bg."</td>
							<td>".$total_201612_petcamp_jas."</td>
							<td>".$total_201612_petland."</td>
							<td>".$total_201612_leroy."</td>
							<td>".$total_201612_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2016."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2017</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_201701_caes."</td>
							<td>".$adotados_201701_gatos."</td>
							<td>".$castrados_201701_caes."</td>
							<td>".$castrados_201701_gatos."</td>
							<td>".$total_201701_petz."</td>
							<td>".$total_201701_petcenter."</td>
							<td>".$total_201701_petcamp_bg."</td>
							<td>".$total_201701_petcamp_jas."</td>
							<td>".$total_201701_petland."</td>
							<td>".$total_201701_leroy."</td>
							<td>".$total_201701_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_201702_caes."</td>
							<td>".$adotados_201702_gatos."</td>
							<td>".$castrados_201702_caes."</td>
							<td>".$castrados_201702_gatos."</td>
							<td>".$total_201702_petz."</td>
							<td>".$total_201702_petcenter."</td>
							<td>".$total_201702_petcamp_bg."</td>
							<td>".$total_201702_petcamp_jas."</td>
							<td>".$total_201702_petland."</td>
							<td>".$total_201702_leroy."</td>
							<td>".$total_201702_fora_feira."</td>
						  </tr>
						   <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Março </th>
							<td>".$adotados_201703_caes."</td>
							<td>".$adotados_201703_gatos."</td>
							<td>".$castrados_201703_caes."</td>
							<td>".$castrados_201703_gatos."</td>
							<td>".$total_201703_petz."</td>
							<td>".$total_201703_petcenter."</td>
							<td>".$total_201703_petcamp_bg."</td>
							<td>".$total_201703_petcamp_jas."</td>
							<td>".$total_201703_petland."</td>
							<td>".$total_201703_leroy."</td>
							<td>".$total_201703_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_201704_caes."</td>
							<td>".$adotados_201704_gatos."</td>
							<td>".$castrados_201704_caes."</td>
							<td>".$castrados_201704_gatos."</td>
							<td>".$total_201704_petz."</td>
							<td>".$total_201704_petcenter."</td>
							<td>".$total_201704_petcamp_bg."</td>
							<td>".$total_201704_petcamp_jas."</td>
							<td>".$total_201704_petland."</td>
							<td>".$total_201704_leroy."</td>
							<td>".$total_201704_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_201705_caes."</td>
							<td>".$adotados_201705_gatos."</td>
							<td>".$castrados_201705_caes."</td>
							<td>".$castrados_201705_gatos."</td>
							<td>".$total_201705_petz."</td>
							<td>".$total_201705_petcenter."</td>
							<td>".$total_201705_petcamp_bg."</td>
							<td>".$total_201705_petcamp_jas."</td>
							<td>".$total_201705_petland."</td>
							<td>".$total_201705_leroy."</td>
							<td>".$total_201705_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_201706_caes."</td>
							<td>".$adotados_201706_gatos."</td>
							<td>".$castrados_201706_caes."</td>
							<td>".$castrados_201706_gatos."</td>
							<td>".$total_201706_petz."</td>
							<td>".$total_201706_petcenter."</td>
							<td>".$total_201706_petcamp_bg."</td>
							<td>".$total_201706_petcamp_jas."</td>
							<td>".$total_201706_petland."</td>
							<td>".$total_201706_leroy."</td>
							<td>".$total_201706_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_201707_caes."</td>
							<td>".$adotados_201707_gatos."</td>
							<td>".$castrados_201707_caes."</td>
							<td>".$castrados_201707_gatos."</td>
							<td>".$total_201707_petz."</td>
							<td>".$total_201707_petcenter."</td>
							<td>".$total_201707_petcamp_bg."</td>
							<td>".$total_201707_petcamp_jas."</td>
							<td>".$total_201707_petland."</td>
							<td>".$total_201707_leroy."</td>
							<td>".$total_201707_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_201708_caes."</td>
							<td>".$adotados_201708_gatos."</td>
							<td>".$castrados_201708_caes."</td>
							<td>".$castrados_201708_gatos."</td>
							<td>".$total_201708_petz."</td>
							<td>".$total_201708_petcenter."</td>
							<td>".$total_201708_petcamp_bg."</td>
							<td>".$total_201708_petcamp_jas."</td>
							<td>".$total_201708_petland."</td>
							<td>".$total_201708_leroy."</td>
							<td>".$total_201708_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_201709_caes."</td>
							<td>".$adotados_201709_gatos."</td>
							<td>".$castrados_201709_caes."</td>
							<td>".$castrados_201709_gatos."</td>
							<td>".$total_201709_petz."</td>
							<td>".$total_201709_petcenter."</td>
							<td>".$total_201709_petcamp_bg."</td>
							<td>".$total_201709_petcamp_jas."</td>
							<td>".$total_201709_petland."</td>
							<td>".$total_201709_leroy."</td>
							<td>".$total_201709_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_201710_caes."</td>
							<td>".$adotados_201710_gatos."</td>
							<td>".$castrados_201710_caes."</td>
							<td>".$castrados_201710_gatos."</td>
							<td>".$total_201710_petz."</td>
							<td>".$total_201710_petcenter."</td>
							<td>".$total_201710_petcamp_bg."</td>
							<td>".$total_201710_petcamp_jas."</td>
							<td>".$total_201710_petland."</td>
							<td>".$total_201710_leroy."</td>
							<td>".$total_201710_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_201711_caes."</td>
							<td>".$adotados_201711_gatos."</td>
							<td>".$castrados_201711_caes."</td>
							<td>".$castrados_201711_gatos."</td>
							<td>".$total_201711_petz."</td>
							<td>".$total_201711_petcenter."</td>
							<td>".$total_201711_petcamp_bg."</td>
							<td>".$total_201711_petcamp_jas."</td>
							<td>".$total_201711_petland."</td>
							<td>".$total_201711_leroy."</td>
							<td>".$total_201711_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_201712_caes."</td>
							<td>".$adotados_201712_gatos."</td>
							<td>".$castrados_201712_caes."</td>
							<td>".$castrados_201712_gatos."</td>
							<td>".$total_201712_petz."</td>
							<td>".$total_201712_petcenter."</td>
							<td>".$total_201712_petcamp_bg."</td>
							<td>".$total_201712_petcamp_jas."</td>
							<td>".$total_201712_petland."</td>
							<td>".$total_201712_leroy."</td>
							<td>".$total_201712_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2017."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2018</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_201801_caes."</td>
							<td>".$adotados_201801_gatos."</td>
							<td>".$castrados_201801_caes."</td>
							<td>".$castrados_201801_gatos."</td>
							<td>".$total_201801_petz."</td>
							<td>".$total_201801_petcenter."</td>
							<td>".$total_201801_petcamp_bg."</td>
							<td>".$total_201801_petcamp_jas."</td>
							<td>".$total_201801_petland."</td>
							<td>".$total_201801_leroy."</td>
							<td>".$total_201801_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_201802_caes."</td>
							<td>".$adotados_201802_gatos."</td>
							<td>".$castrados_201802_caes."</td>
							<td>".$castrados_201802_gatos."</td>
							<td>".$total_201802_petz."</td>
							<td>".$total_201802_petcenter."</td>
							<td>".$total_201802_petcamp_bg."</td>
							<td>".$total_201802_petcamp_jas."</td>
							<td>".$total_201802_petland."</td>
							<td>".$total_201802_leroy."</td>
							<td>".$total_201802_fora_feira."</td>
						  </tr>
						   <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Março </th>
							<td>".$adotados_201803_caes."</td>
							<td>".$adotados_201803_gatos."</td>
							<td>".$castrados_201803_caes."</td>
							<td>".$castrados_201803_gatos."</td>
							<td>".$total_201803_petz."</td>
							<td>".$total_201803_petcenter."</td>
							<td>".$total_201803_petcamp_bg."</td>
							<td>".$total_201803_petcamp_jas."</td>
							<td>".$total_201803_petland."</td>
							<td>".$total_201803_leroy."</td>
							<td>".$total_201803_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_201804_caes."</td>
							<td>".$adotados_201804_gatos."</td>
							<td>".$castrados_201804_caes."</td>
							<td>".$castrados_201804_gatos."</td>
							<td>".$total_201804_petz."</td>
							<td>".$total_201804_petcenter."</td>
							<td>".$total_201804_petcamp_bg."</td>
							<td>".$total_201804_petcamp_jas."</td>
							<td>".$total_201804_petland."</td>
							<td>".$total_201804_leroy."</td>
							<td>".$total_201804_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_201805_caes."</td>
							<td>".$adotados_201805_gatos."</td>
							<td>".$castrados_201805_caes."</td>
							<td>".$castrados_201805_gatos."</td>
							<td>".$total_201805_petz."</td>
							<td>".$total_201805_petcenter."</td>
							<td>".$total_201805_petcamp_bg."</td>
							<td>".$total_201805_petcamp_jas."</td>
							<td>".$total_201805_petland."</td>
							<td>".$total_201805_leroy."</td>
							<td>".$total_201805_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_201806_caes."</td>
							<td>".$adotados_201806_gatos."</td>
							<td>".$castrados_201806_caes."</td>
							<td>".$castrados_201806_gatos."</td>
							<td>".$total_201806_petz."</td>
							<td>".$total_201806_petcenter."</td>
							<td>".$total_201806_petcamp_bg."</td>
							<td>".$total_201806_petcamp_jas."</td>
							<td>".$total_201806_petland."</td>
							<td>".$total_201806_leroy."</td>
							<td>".$total_201806_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_201807_caes."</td>
							<td>".$adotados_201807_gatos."</td>
							<td>".$castrados_201807_caes."</td>
							<td>".$castrados_201807_gatos."</td>
							<td>".$total_201807_petz."</td>
							<td>".$total_201807_petcenter."</td>
							<td>".$total_201807_petcamp_bg."</td>
							<td>".$total_201807_petcamp_jas."</td>
							<td>".$total_201807_petland."</td>
							<td>".$total_201807_leroy."</td>
							<td>".$total_201807_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_201808_caes."</td>
							<td>".$adotados_201808_gatos."</td>
							<td>".$castrados_201808_caes."</td>
							<td>".$castrados_201808_gatos."</td>
							<td>".$total_201808_petz."</td>
							<td>".$total_201808_petcenter."</td>
							<td>".$total_201808_petcamp_bg."</td>
							<td>".$total_201808_petcamp_jas."</td>
							<td>".$total_201808_petland."</td>
							<td>".$total_201808_leroy."</td>
							<td>".$total_201808_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_201809_caes."</td>
							<td>".$adotados_201809_gatos."</td>
							<td>".$castrados_201809_caes."</td>
							<td>".$castrados_201809_gatos."</td>
							<td>".$total_201809_petz."</td>
							<td>".$total_201809_petcenter."</td>
							<td>".$total_201809_petcamp_bg."</td>
							<td>".$total_201809_petcamp_jas."</td>
							<td>".$total_201809_petland."</td>
							<td>".$total_201809_leroy."</td>
							<td>".$total_201809_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_201810_caes."</td>
							<td>".$adotados_201810_gatos."</td>
							<td>".$castrados_201810_caes."</td>
							<td>".$castrados_201810_gatos."</td>
							<td>".$total_201810_petz."</td>
							<td>".$total_201810_petcenter."</td>
							<td>".$total_201810_petcamp_bg."</td>
							<td>".$total_201810_petcamp_jas."</td>
							<td>".$total_201810_petland."</td>
							<td>".$total_201810_leroy."</td>
							<td>".$total_201810_fora_feira."</td>
						  </tr>
						 <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_201811_caes."</td>
							<td>".$adotados_201811_gatos."</td>
							<td>".$castrados_201811_caes."</td>
							<td>".$castrados_201811_gatos."</td>
							<td>".$total_201811_petz."</td>
							<td>".$total_201811_petcenter."</td>
							<td>".$total_201811_petcamp_bg."</td>
							<td>".$total_201811_petcamp_jas."</td>
							<td>".$total_201811_petland."</td>
							<td>".$total_201811_leroy."</td>
							<td>".$total_201811_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_201812_caes."</td>
							<td>".$adotados_201812_gatos."</td>
							<td>".$castrados_201812_caes."</td>
							<td>".$castrados_201812_gatos."</td>
							<td>".$total_201812_petz."</td>
							<td>".$total_201812_petcenter."</td>
							<td>".$total_201812_petcamp_bg."</td>
							<td>".$total_201812_petcamp_jas."</td>
							<td>".$total_201812_petland."</td>
							<td>".$total_201812_leroy."</td>
							<td>".$total_201812_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2018."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2019</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_201901_caes."</td>
							<td>".$adotados_201901_gatos."</td>
							<td>".$castrados_201901_caes."</td>
							<td>".$castrados_201901_gatos."</td>
							<td>".$total_201901_petz."</td>
							<td>".$total_201901_petcenter."</td>
							<td>".$total_201901_petcamp_bg."</td>
							<td>".$total_201901_petcamp_jas."</td>
							<td>".$total_201901_petland."</td>
							<td>".$total_201901_leroy."</td>
							<td>".$total_201901_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_201902_caes."</td>
							<td>".$adotados_201902_gatos."</td>
							<td>".$castrados_201902_caes."</td>
							<td>".$castrados_201902_gatos."</td>
							<td>".$total_201902_petz."</td>
							<td>".$total_201902_petcenter."</td>
							<td>".$total_201902_petcamp_bg."</td>
							<td>".$total_201902_petcamp_jas."</td>
							<td>".$total_201902_petland."</td>
							<td>".$total_201902_leroy."</td>
							<td>".$total_201902_fora_feira."</td>
						  </tr>
						   <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Março </th>
							<td>".$adotados_201903_caes."</td>
							<td>".$adotados_201903_gatos."</td>
							<td>".$castrados_201903_caes."</td>
							<td>".$castrados_201903_gatos."</td>
							<td>".$total_201903_petz."</td>
							<td>".$total_201903_petcenter."</td>
							<td>".$total_201903_petcamp_bg."</td>
							<td>".$total_201903_petcamp_jas."</td>
							<td>".$total_201903_petland."</td>
							<td>".$total_201903_leroy."</td>
							<td>".$total_201903_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_201904_caes."</td>
							<td>".$adotados_201904_gatos."</td>
							<td>".$castrados_201904_caes."</td>
							<td>".$castrados_201904_gatos."</td>
							<td>".$total_201904_petz."</td>
							<td>".$total_201904_petcenter."</td>
							<td>".$total_201904_petcamp_bg."</td>
							<td>".$total_201904_petcamp_jas."</td>
							<td>".$total_201904_petland."</td>
							<td>".$total_201904_leroy."</td>
							<td>".$total_201904_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_201905_caes."</td>
							<td>".$adotados_201905_gatos."</td>
							<td>".$castrados_201905_caes."</td>
							<td>".$castrados_201905_gatos."</td>
							<td>".$total_201905_petz."</td>
							<td>".$total_201905_petcenter."</td>
							<td>".$total_201905_petcamp_bg."</td>
							<td>".$total_201905_petcamp_jas."</td>
							<td>".$total_201905_petland."</td>
							<td>".$total_201905_leroy."</td>
							<td>".$total_201905_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_201906_caes."</td>
							<td>".$adotados_201906_gatos."</td>
							<td>".$castrados_201906_caes."</td>
							<td>".$castrados_201906_gatos."</td>
							<td>".$total_201906_petz."</td>
							<td>".$total_201906_petcenter."</td>
							<td>".$total_201906_petcamp_bg."</td>
							<td>".$total_201906_petcamp_jas."</td>
							<td>".$total_201906_petland."</td>
							<td>".$total_201906_leroy."</td>
							<td>".$total_201906_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_201907_caes."</td>
							<td>".$adotados_201907_gatos."</td>
							<td>".$castrados_201907_caes."</td>
							<td>".$castrados_201907_gatos."</td>
							<td>".$total_201907_petz."</td>
							<td>".$total_201907_petcenter."</td>
							<td>".$total_201907_petcamp_bg."</td>
							<td>".$total_201907_petcamp_jas."</td>
							<td>".$total_201907_petland."</td>
							<td>".$total_201907_leroy."</td>
							<td>".$total_201907_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_201908_caes."</td>
							<td>".$adotados_201908_gatos."</td>
							<td>".$castrados_201908_caes."</td>
							<td>".$castrados_201908_gatos."</td>
							<td>".$total_201908_petz."</td>
							<td>".$total_201908_petcenter."</td>
							<td>".$total_201908_petcamp_bg."</td>
							<td>".$total_201908_petcamp_jas."</td>
							<td>".$total_201908_petland."</td>
							<td>".$total_201908_leroy."</td>
							<td>".$total_201908_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_201909_caes."</td>
							<td>".$adotados_201909_gatos."</td>
							<td>".$castrados_201909_caes."</td>
							<td>".$castrados_201909_gatos."</td>
							<td>".$total_201909_petz."</td>
							<td>".$total_201909_petcenter."</td>
							<td>".$total_201909_petcamp_bg."</td>
							<td>".$total_201909_petcamp_jas."</td>
							<td>".$total_201909_petland."</td>
							<td>".$total_201909_leroy."</td>
							<td>".$total_201909_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_201910_caes."</td>
							<td>".$adotados_201910_gatos."</td>
							<td>".$castrados_201910_caes."</td>
							<td>".$castrados_201910_gatos."</td>
							<td>".$total_201910_petz."</td>
							<td>".$total_201910_petcenter."</td>
							<td>".$total_201910_petcamp_bg."</td>
							<td>".$total_201910_petcamp_jas."</td>
							<td>".$total_201910_petland."</td>
							<td>".$total_201910_leroy."</td>
							<td>".$total_201910_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_201911_caes."</td>
							<td>".$adotados_201911_gatos."</td>
							<td>".$castrados_201911_caes."</td>
							<td>".$castrados_201911_gatos."</td>
							<td>".$total_201911_petz."</td>
							<td>".$total_201911_petcenter."</td>
							<td>".$total_201911_petcamp_bg."</td>
							<td>".$total_201911_petcamp_jas."</td>
							<td>".$total_201911_petland."</td>
							<td>".$total_201911_leroy."</td>
							<td>".$total_201911_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_201912_caes."</td>
							<td>".$adotados_201912_gatos."</td>
							<td>".$castrados_201912_caes."</td>
							<td>".$castrados_201912_gatos."</td>
							<td>".$total_201912_petz."</td>
							<td>".$total_201912_petcenter."</td>
							<td>".$total_201912_petcamp_bg."</td>
							<td>".$total_201912_petcamp_jas."</td>
							<td>".$total_201912_petland."</td>
							<td>".$total_201912_leroy."</td>
							<td>".$total_201912_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2019."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2020</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_202001_caes."</td>
							<td>".$adotados_202001_gatos."</td>
							<td>".$castrados_202001_caes."</td>
							<td>".$castrados_202001_gatos."</td>
							<td>".$total_202001_petz."</td>
							<td>".$total_202001_petcenter."</td>
							<td>".$total_202001_petcamp_bg."</td>
							<td>".$total_202001_petcamp_jas."</td>
							<td>".$total_202001_petland."</td>
							<td>".$total_202001_leroy."</td>
							<td>".$total_202001_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_202002_caes."</td>
							<td>".$adotados_202002_gatos."</td>
							<td>".$castrados_202002_caes."</td>
							<td>".$castrados_202002_gatos."</td>
							<td>".$total_202002_petz."</td>
							<td>".$total_202002_petcenter."</td>
							<td>".$total_202002_petcamp_bg."</td>
							<td>".$total_202002_petcamp_jas."</td>
							<td>".$total_202002_petland."</td>
							<td>".$total_202002_leroy."</td>
							<td>".$total_202002_fora_feira."</td>
						  </tr>
						   <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Março </th>
							<td>".$adotados_202003_caes."</td>
							<td>".$adotados_202003_gatos."</td>
							<td>".$castrados_202003_caes."</td>
							<td>".$castrados_202003_gatos."</td>
							<td>".$total_202003_petz."</td>
							<td>".$total_202003_petcenter."</td>
							<td>".$total_202003_petcamp_bg."</td>
							<td>".$total_202003_petcamp_jas."</td>
							<td>".$total_202003_petland."</td>
							<td>".$total_202003_leroy."</td>
							<td>".$total_202003_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_202004_caes."</td>
							<td>".$adotados_202004_gatos."</td>
							<td>".$castrados_202004_caes."</td>
							<td>".$castrados_202004_gatos."</td>
							<td>".$total_202004_petz."</td>
							<td>".$total_202004_petcenter."</td>
							<td>".$total_202004_petcamp_bg."</td>
							<td>".$total_202004_petcamp_jas."</td>
							<td>".$total_202004_petland."</td>
							<td>".$total_202004_leroy."</td>
							<td>".$total_202004_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_202005_caes."</td>
							<td>".$adotados_202005_gatos."</td>
							<td>".$castrados_202005_caes."</td>
							<td>".$castrados_202005_gatos."</td>
							<td>".$total_202005_petz."</td>
							<td>".$total_202005_petcenter."</td>
							<td>".$total_202005_petcamp_bg."</td>
							<td>".$total_202005_petcamp_jas."</td>
							<td>".$total_202005_petland."</td>
							<td>".$total_202005_leroy."</td>
							<td>".$total_202005_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_202006_caes."</td>
							<td>".$adotados_202006_gatos."</td>
							<td>".$castrados_202006_caes."</td>
							<td>".$castrados_202006_gatos."</td>
							<td>".$total_202006_petz."</td>
							<td>".$total_202006_petcenter."</td>
							<td>".$total_202006_petcamp_bg."</td>
							<td>".$total_202006_petcamp_jas."</td>
							<td>".$total_202006_petland."</td>
							<td>".$total_202006_leroy."</td>
							<td>".$total_202006_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_202007_caes."</td>
							<td>".$adotados_202007_gatos."</td>
							<td>".$castrados_202007_caes."</td>
							<td>".$castrados_202007_gatos."</td>
							<td>".$total_202007_petz."</td>
							<td>".$total_202007_petcenter."</td>
							<td>".$total_202007_petcamp_bg."</td>
							<td>".$total_202007_petcamp_jas."</td>
							<td>".$total_202007_petland."</td>
							<td>".$total_202007_leroy."</td>
							<td>".$total_202007_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_202008_caes."</td>
							<td>".$adotados_202008_gatos."</td>
							<td>".$castrados_202008_caes."</td>
							<td>".$castrados_202008_gatos."</td>
							<td>".$total_202008_petz."</td>
							<td>".$total_202008_petcenter."</td>
							<td>".$total_202008_petcamp_bg."</td>
							<td>".$total_202008_petcamp_jas."</td>
							<td>".$total_202008_petland."</td>
							<td>".$total_202008_leroy."</td>
							<td>".$total_202008_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_202009_caes."</td>
							<td>".$adotados_202009_gatos."</td>
							<td>".$castrados_202009_caes."</td>
							<td>".$castrados_202009_gatos."</td>
							<td>".$total_202009_petz."</td>
							<td>".$total_202009_petcenter."</td>
							<td>".$total_202009_petcamp_bg."</td>
							<td>".$total_202009_petcamp_jas."</td>
							<td>".$total_202009_petland."</td>
							<td>".$total_202009_leroy."</td>
							<td>".$total_202009_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_202010_caes."</td>
							<td>".$adotados_202010_gatos."</td>
							<td>".$castrados_202010_caes."</td>
							<td>".$castrados_202010_gatos."</td>
							<td>".$total_202010_petz."</td>
							<td>".$total_202010_petcenter."</td>
							<td>".$total_202010_petcamp_bg."</td>
							<td>".$total_202010_petcamp_jas."</td>
							<td>".$total_202010_petland."</td>
							<td>".$total_202010_leroy."</td>
							<td>".$total_202010_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_202011_caes."</td>
							<td>".$adotados_202011_gatos."</td>
							<td>".$castrados_202011_caes."</td>
							<td>".$castrados_202011_gatos."</td>
							<td>".$total_202011_petz."</td>
							<td>".$total_202011_petcenter."</td>
							<td>".$total_202011_petcamp_bg."</td>
							<td>".$total_202011_petcamp_jas."</td>
							<td>".$total_202011_petland."</td>
							<td>".$total_202011_leroy."</td>
							<td>".$total_202011_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_202012_caes."</td>
							<td>".$adotados_202012_gatos."</td>
							<td>".$castrados_202012_caes."</td>
							<td>".$castrados_202012_gatos."</td>
							<td>".$total_202012_petz."</td>
							<td>".$total_202012_petcenter."</td>
							<td>".$total_202012_petcamp_bg."</td>
							<td>".$total_202012_petcamp_jas."</td>
							<td>".$total_202012_petland."</td>
							<td>".$total_202012_leroy."</td>
							<td>".$total_202012_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2020."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2021</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_202101_caes."</td>
							<td>".$adotados_202101_gatos."</td>
							<td>".$castrados_202101_caes."</td>
							<td>".$castrados_202101_gatos."</td>
							<td>".$total_202101_petz."</td>
							<td>".$total_202101_petcenter."</td>
							<td>".$total_202101_petcamp_bg."</td>
							<td>".$total_202101_petcamp_jas."</td>
							<td>".$total_202101_petland."</td>
							<td>".$total_202101_leroy."</td>
							<td>".$total_202101_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_202102_caes."</td>
							<td>".$adotados_202102_gatos."</td>
							<td>".$castrados_202102_caes."</td>
							<td>".$castrados_202102_gatos."</td>
							<td>".$total_202102_petz."</td>
							<td>".$total_202102_petcenter."</td>
							<td>".$total_202102_petcamp_bg."</td>
							<td>".$total_202102_petcamp_jas."</td>
							<td>".$total_202102_petland."</td>
							<td>".$total_202102_leroy."</td>
							<td>".$total_202102_fora_feira."</td>
						  </tr>
						   <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Março </th>
							<td>".$adotados_202103_caes."</td>
							<td>".$adotados_202103_gatos."</td>
							<td>".$castrados_202103_caes."</td>
							<td>".$castrados_202103_gatos."</td>
							<td>".$total_202103_petz."</td>
							<td>".$total_202103_petcenter."</td>
							<td>".$total_202103_petcamp_bg."</td>
							<td>".$total_202103_petcamp_jas."</td>
							<td>".$total_202103_petland."</td>
							<td>".$total_202103_leroy."</td>
							<td>".$total_202103_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_202104_caes."</td>
							<td>".$adotados_202104_gatos."</td>
							<td>".$castrados_202104_caes."</td>
							<td>".$castrados_202104_gatos."</td>
							<td>".$total_202104_petz."</td>
							<td>".$total_202104_petcenter."</td>
							<td>".$total_202104_petcamp_bg."</td>
							<td>".$total_202104_petcamp_jas."</td>
							<td>".$total_202104_petland."</td>
							<td>".$total_202104_leroy."</td>
							<td>".$total_202104_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_202105_caes."</td>
							<td>".$adotados_202105_gatos."</td>
							<td>".$castrados_202105_caes."</td>
							<td>".$castrados_202105_gatos."</td>
							<td>".$total_202105_petz."</td>
							<td>".$total_202105_petcenter."</td>
							<td>".$total_202105_petcamp_bg."</td>
							<td>".$total_202105_petcamp_jas."</td>
							<td>".$total_202105_petland."</td>
							<td>".$total_202105_leroy."</td>
							<td>".$total_202105_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_202106_caes."</td>
							<td>".$adotados_202106_gatos."</td>
							<td>".$castrados_202106_caes."</td>
							<td>".$castrados_202106_gatos."</td>
							<td>".$total_202106_petz."</td>
							<td>".$total_202106_petcenter."</td>
							<td>".$total_202106_petcamp_bg."</td>
							<td>".$total_202106_petcamp_jas."</td>
							<td>".$total_202106_petland."</td>
							<td>".$total_202106_leroy."</td>
							<td>".$total_202106_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_202107_caes."</td>
							<td>".$adotados_202107_gatos."</td>
							<td>".$castrados_202107_caes."</td>
							<td>".$castrados_202107_gatos."</td>
							<td>".$total_202107_petz."</td>
							<td>".$total_202107_petcenter."</td>
							<td>".$total_202107_petcamp_bg."</td>
							<td>".$total_202107_petcamp_jas."</td>
							<td>".$total_202107_petland."</td>
							<td>".$total_202107_leroy."</td>
							<td>".$total_202107_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_202108_caes."</td>
							<td>".$adotados_202108_gatos."</td>
							<td>".$castrados_202108_caes."</td>
							<td>".$castrados_202108_gatos."</td>
							<td>".$total_202108_petz."</td>
							<td>".$total_202108_petcenter."</td>
							<td>".$total_202108_petcamp_bg."</td>
							<td>".$total_202108_petcamp_jas."</td>
							<td>".$total_202108_petland."</td>
							<td>".$total_202108_leroy."</td>
							<td>".$total_202108_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_202109_caes."</td>
							<td>".$adotados_202109_gatos."</td>
							<td>".$castrados_202109_caes."</td>
							<td>".$castrados_202109_gatos."</td>
							<td>".$total_202109_petz."</td>
							<td>".$total_202109_petcenter."</td>
							<td>".$total_202109_petcamp_bg."</td>
							<td>".$total_202109_petcamp_jas."</td>
							<td>".$total_202109_petland."</td>
							<td>".$total_202109_leroy."</td>
							<td>".$total_202109_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_202110_caes."</td>
							<td>".$adotados_202110_gatos."</td>
							<td>".$castrados_202110_caes."</td>
							<td>".$castrados_202110_gatos."</td>
							<td>".$total_202110_petz."</td>
							<td>".$total_202110_petcenter."</td>
							<td>".$total_202110_petcamp_bg."</td>
							<td>".$total_202110_petcamp_jas."</td>
							<td>".$total_202110_petland."</td>
							<td>".$total_202110_leroy."</td>
							<td>".$total_202110_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_202111_caes."</td>
							<td>".$adotados_202111_gatos."</td>
							<td>".$castrados_202111_caes."</td>
							<td>".$castrados_202111_gatos."</td>
							<td>".$total_202111_petz."</td>
							<td>".$total_202111_petcenter."</td>
							<td>".$total_202111_petcamp_bg."</td>
							<td>".$total_202111_petcamp_jas."</td>
							<td>".$total_202111_petland."</td>
							<td>".$total_202111_leroy."</td>
							<td>".$total_202111_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_202112_caes."</td>
							<td>".$adotados_202112_gatos."</td>
							<td>".$castrados_202112_caes."</td>
							<td>".$castrados_202112_gatos."</td>
							<td>".$total_202112_petz."</td>
							<td>".$total_202112_petcenter."</td>
							<td>".$total_202112_petcamp_bg."</td>
							<td>".$total_202112_petcamp_jas."</td>
							<td>".$total_202112_petland."</td>
							<td>".$total_202112_leroy."</td>
							<td>".$total_202112_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2021."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						</table>
						</center>";
						
						/*** email ***/
						
						$assunto = "Relatório geral - Adoções";
						
						$mensagem = "<center><table class='table' >
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
							<th scope='row'>2014 </th>
							<th scope='row'>Janeiro </th>
							<td>".$adotados_201401_caes."</td>
							<td>".$adotados_201401_gatos."</td>
							<td>".$castrados_201401_caes."</td>
							<td>".$castrados_201401_gatos."</td>
							<td>".$total_201401_petz."</td>
							<td>".$total_201401_petcenter."</td>
							<td>".$total_201401_petcamp_bg."</td>
							<td>".$total_201401_petcamp_jas."</td>
							<td>".$total_201401_petland."</td>
							<td>".$total_201401_leroy."</td>
							<td>".$total_201401_fora_feira."</td>
						  </tr>
						  <tr> 
							<th scope='row'>2014 </th>
							<th scope='row'>Fevereiro </th>
							<td>".$adotados_201402_caes."</td>
							<td>".$adotados_201402_gatos."</td>
							<td>".$castrados_201402_caes."</td>
							<td>".$castrados_201402_gatos."</td>
							<td>".$total_201402_petz."</td>
							<td>".$total_201402_petcenter."</td>
							<td>".$total_201402_petcamp_bg."</td>
							<td>".$total_201402_petcamp_jas."</td>
							<td>".$total_201402_petland."</td>
							<td>".$total_201402_leroy."</td>
							<td>".$total_201402_fora_feira."</td>
						  </tr>
						   <tr> 
							<th scope='row'>2014 </th>
							<th scope='row'>Março </th>
							<td>".$adotados_201403_caes."</td>
							<td>".$adotados_201403_gatos."</td>
							<td>".$castrados_201403_caes."</td>
							<td>".$castrados_201403_gatos."</td>
							<td>".$total_201403_petz."</td>
							<td>".$total_201403_petcenter."</td>
							<td>".$total_201403_petcamp_bg."</td>
							<td>".$total_201403_petcamp_jas."</td>
							<td>".$total_201403_petland."</td>
							<td>".$total_201403_leroy."</td>
							<td>".$total_201403_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Abril</th>
							<td>".$adotados_201404_caes."</td>
							<td>".$adotados_201404_gatos."</td>
							<td>".$castrados_201404_caes."</td>
							<td>".$castrados_201404_gatos."</td>
							<td>".$total_201404_petz."</td>
							<td>".$total_201404_petcenter."</td>
							<td>".$total_201404_petcamp_bg."</td>
							<td>".$total_201404_petcamp_jas."</td>
							<td>".$total_201404_petland."</td>
							<td>".$total_201404_leroy."</td>
							<td>".$total_201404_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Maio</th>
							<td>".$adotados_201405_caes."</td>
							<td>".$adotados_201405_gatos."</td>
							<td>".$castrados_201405_caes."</td>
							<td>".$castrados_201405_gatos."</td>
							<td>".$total_201405_petz."</td>
							<td>".$total_201405_petcenter."</td>
							<td>".$total_201405_petcamp_bg."</td>
							<td>".$total_201405_petcamp_jas."</td>
							<td>".$total_201405_petland."</td>
							<td>".$total_201405_leroy."</td>
							<td>".$total_201405_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Junho</th>
							<td>".$adotados_201406_caes."</td>
							<td>".$adotados_201406_gatos."</td>
							<td>".$castrados_201406_caes."</td>
							<td>".$castrados_201406_gatos."</td>
							<td>".$total_201406_petz."</td>
							<td>".$total_201406_petcenter."</td>
							<td>".$total_201406_petcamp_bg."</td>
							<td>".$total_201406_petcamp_jas."</td>
							<td>".$total_201406_petland."</td>
							<td>".$total_201406_leroy."</td>
							<td>".$total_201406_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Julho</th>
							<td>".$adotados_201407_caes."</td>
							<td>".$adotados_201407_gatos."</td>
							<td>".$castrados_201407_caes."</td>
							<td>".$castrados_201407_gatos."</td>
							<td>".$total_201407_petz."</td>
							<td>".$total_201407_petcenter."</td>
							<td>".$total_201407_petcamp_bg."</td>
							<td>".$total_201407_petcamp_jas."</td>
							<td>".$total_201407_petland."</td>
							<td>".$total_201407_leroy."</td>
							<td>".$total_201407_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_201408_caes."</td>
							<td>".$adotados_201408_gatos."</td>
							<td>".$castrados_201408_caes."</td>
							<td>".$castrados_201408_gatos."</td>
							<td>".$total_201408_petz."</td>
							<td>".$total_201408_petcenter."</td>
							<td>".$total_201408_petcamp_bg."</td>
							<td>".$total_201408_petcamp_jas."</td>
							<td>".$total_201408_petland."</td>
							<td>".$total_201408_leroy."</td>
							<td>".$total_201408_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_201409_caes."</td>
							<td>".$adotados_201409_gatos."</td>
							<td>".$castrados_201409_caes."</td>
							<td>".$castrados_201409_gatos."</td>
							<td>".$total_201409_petz."</td>
							<td>".$total_201409_petcenter."</td>
							<td>".$total_201409_petcamp_bg."</td>
							<td>".$total_201409_petcamp_jas."</td>
							<td>".$total_201409_petland."</td>
							<td>".$total_201409_leroy."</td>
							<td>".$total_201409_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_201410_caes."</td>
							<td>".$adotados_201410_gatos."</td>
							<td>".$castrados_201410_caes."</td>
							<td>".$castrados_201410_gatos."</td>
							<td>".$total_201410_petz."</td>
							<td>".$total_201410_petcenter."</td>
							<td>".$total_201410_petcamp_bg."</td>
							<td>".$total_201410_petcamp_jas."</td>
							<td>".$total_201410_petland."</td>
							<td>".$total_201410_leroy."</td>
							<td>".$total_201410_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_201411_caes."</td>
							<td>".$adotados_201411_gatos."</td>
							<td>".$castrados_201411_caes."</td>
							<td>".$castrados_201411_gatos."</td>
							<td>".$total_201411_petz."</td>
							<td>".$total_201411_petcenter."</td>
							<td>".$total_201411_petcamp_bg."</td>
							<td>".$total_201411_petcamp_jas."</td>
							<td>".$total_201411_petland."</td>
							<td>".$total_201411_leroy."</td>
							<td>".$total_201411_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2014 </th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_201412_caes."</td>
							<td>".$adotados_201412_gatos."</td>
							<td>".$castrados_201412_caes."</td>
							<td>".$castrados_201412_gatos."</td>
							<td>".$total_201412_petz."</td>
							<td>".$total_201412_petcenter."</td>
							<td>".$total_201412_petcamp_bg."</td>
							<td>".$total_201412_petcamp_jas."</td>
							<td>".$total_201412_petland."</td>
							<td>".$total_201412_leroy."</td>
							<td>".$total_201412_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2014."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2015</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_201501_caes."</td>
							<td>".$adotados_201501_gatos."</td>
							<td>".$castrados_201501_caes."</td>
							<td>".$castrados_201501_gatos."</td>
							<td>".$total_201501_petz."</td>
							<td>".$total_201501_petcenter."</td>
							<td>".$total_201501_petcamp_bg."</td>
							<td>".$total_201501_petcamp_jas."</td>
							<td>".$total_201501_petland."</td>
							<td>".$total_201501_leroy."</td>
							<td>".$total_201501_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_201502_caes."</td>
							<td>".$adotados_201502_gatos."</td>
							<td>".$castrados_201502_caes."</td>
							<td>".$castrados_201502_gatos."</td>
							<td>".$total_201502_petz."</td>
							<td>".$total_201502_petcenter."</td>
							<td>".$total_201502_petcamp_bg."</td>
							<td>".$total_201502_petcamp_jas."</td>
							<td>".$total_201502_petland."</td>
							<td>".$total_201502_leroy."</td>
							<td>".$total_201502_fora_feira."</td>
							
						  </tr>
						   <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Março </th>
							<td>".$adotados_201503_caes."</td>
							<td>".$adotados_201503_gatos."</td>
							<td>".$castrados_201503_caes."</td>
							<td>".$castrados_201503_gatos."</td>
							<td>".$total_201503_petz."</td>
							<td>".$total_201503_petcenter."</td>
							<td>".$total_201503_petcamp_bg."</td>
							<td>".$total_201503_petcamp_jas."</td>
							<td>".$total_201503_petland."</td>
							<td>".$total_201503_leroy."</td>
							<td>".$total_201503_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_201504_caes."</td>
							<td>".$adotados_201504_gatos."</td>
							<td>".$castrados_201504_caes."</td>
							<td>".$castrados_201504_gatos."</td>
							<td>".$total_201504_petz."</td>
							<td>".$total_201504_petcenter."</td>
							<td>".$total_201504_petcamp_bg."</td>
							<td>".$total_201504_petcamp_jas."</td>
							<td>".$total_201504_petland."</td>
							<td>".$total_201504_leroy."</td>
							<td>".$total_201504_fora_feira."</td>
							
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_201505_caes."</td>
							<td>".$adotados_201505_gatos."</td>
							<td>".$castrados_201505_caes."</td>
							<td>".$castrados_201505_gatos."</td>
							<td>".$total_201505_petz."</td>
							<td>".$total_201505_petcenter."</td>
							<td>".$total_201505_petcamp_bg."</td>
							<td>".$total_201505_petcamp_jas."</td>
							<td>".$total_201505_petland."</td>
							<td>".$total_201505_leroy."</td>
							<td>".$total_201505_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_201506_caes."</td>
							<td>".$adotados_201506_gatos."</td>
							<td>".$castrados_201506_caes."</td>
							<td>".$castrados_201506_gatos."</td>
							<td>".$total_201506_petz."</td>
							<td>".$total_201506_petcenter."</td>
							<td>".$total_201506_petcamp_bg."</td>
							<td>".$total_201506_petcamp_jas."</td>
							<td>".$total_201506_petland."</td>
							<td>".$total_201506_leroy."</td>
							<td>".$total_201506_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_201507_caes."</td>
							<td>".$adotados_201507_gatos."</td>
							<td>".$castrados_201507_caes."</td>
							<td>".$castrados_201507_gatos."</td>
							<td>".$total_201507_petz."</td>
							<td>".$total_201507_petcenter."</td>
							<td>".$total_201507_petcamp_bg."</td>
							<td>".$total_201507_petcamp_jas."</td>
							<td>".$total_201507_petland."</td>
							<td>".$total_201507_leroy."</td>
							<td>".$total_201507_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_201508_caes."</td>
							<td>".$adotados_201508_gatos."</td>
							<td>".$castrados_201508_caes."</td>
							<td>".$castrados_201508_gatos."</td>
							<td>".$total_201508_petz."</td>
							<td>".$total_201508_petcenter."</td>
							<td>".$total_201508_petcamp_bg."</td>
							<td>".$total_201508_petcamp_jas."</td>
							<td>".$total_201508_petland."</td>
							<td>".$total_201508_leroy."</td>
							<td>".$total_201508_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_201509_caes."</td>
							<td>".$adotados_201509_gatos."</td>
							<td>".$castrados_201509_caes."</td>
							<td>".$castrados_201509_gatos."</td>
							<td>".$total_201509_petz."</td>
							<td>".$total_201509_petcenter."</td>
							<td>".$total_201509_petcamp_bg."</td>
							<td>".$total_201509_petcamp_jas."</td>
							<td>".$total_201509_petland."</td>
							<td>".$total_201509_leroy."</td>
							<td>".$total_201509_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_201510_caes."</td>
							<td>".$adotados_201510_gatos."</td>
							<td>".$castrados_201510_caes."</td>
							<td>".$castrados_201510_gatos."</td>
							<td>".$total_201510_petz."</td>
							<td>".$total_201510_petcenter."</td>
							<td>".$total_201510_petcamp_bg."</td>
							<td>".$total_201510_petcamp_jas."</td>
							<td>".$total_201510_petland."</td>
							<td>".$total_201510_leroy."</td>
							<td>".$total_201510_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_201511_caes."</td>
							<td>".$adotados_201511_gatos."</td>
							<td>".$castrados_201511_caes."</td>
							<td>".$castrados_201511_gatos."</td>
							<td>".$total_201511_petz."</td>
							<td>".$total_201511_petcenter."</td>
							<td>".$total_201511_petcamp_bg."</td>
							<td>".$total_201511_petcamp_jas."</td>
							<td>".$total_201511_petland."</td>
							<td>".$total_201511_leroy."</td>
							<td>".$total_201511_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_201512_caes."</td>
							<td>".$adotados_201512_gatos."</td>
							<td>".$castrados_201512_caes."</td>
							<td>".$castrados_201512_gatos."</td>
							<td>".$total_201512_petz."</td>
							<td>".$total_201512_petcenter."</td>
							<td>".$total_201512_petcamp_bg."</td>
							<td>".$total_201512_petcamp_jas."</td>
							<td>".$total_201512_petland."</td>
							<td>".$total_201512_leroy."</td>
							<td>".$total_201512_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2015."</td>
							<td colspan='10'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2016</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_201601_caes."</td>
							<td>".$adotados_201601_gatos."</td>
							<td>".$castrados_201601_caes."</td>
							<td>".$castrados_201601_gatos."</td>
							<td>".$total_201601_petz."</td>
							<td>".$total_201601_petcenter."</td>
							<td>".$total_201601_petcamp_bg."</td>
							<td>".$total_201601_petcamp_jas."</td>
							<td>".$total_201601_petland."</td>
							<td>".$total_201601_leroy."</td>
							<td>".$total_201601_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_201602_caes."</td>
							<td>".$adotados_201602_gatos."</td>
							<td>".$castrados_201602_caes."</td>
							<td>".$castrados_201602_gatos."</td>
							<td>".$total_201602_petz."</td>
							<td>".$total_201602_petcenter."</td>
							<td>".$total_201602_petcamp_bg."</td>
							<td>".$total_201602_petcamp_jas."</td>
							<td>".$total_201602_petland."</td>
							<td>".$total_201602_leroy."</td>
							<td>".$total_201602_fora_feira."</td>
						  </tr>
						   <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Março </th>
							<td>".$adotados_201603_caes."</td>
							<td>".$adotados_201603_gatos."</td>
							<td>".$castrados_201603_caes."</td>
							<td>".$castrados_201603_gatos."</td>
							<td>".$total_201603_petz."</td>
							<td>".$total_201603_petcenter."</td>
							<td>".$total_201603_petcamp_bg."</td>
							<td>".$total_201603_petcamp_jas."</td>
							<td>".$total_201603_petland."</td>
							<td>".$total_201603_leroy."</td>
							<td>".$total_201603_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_201604_caes."</td>
							<td>".$adotados_201604_gatos."</td>
							<td>".$castrados_201604_caes."</td>
							<td>".$castrados_201604_gatos."</td>
							<td>".$total_201604_petz."</td>
							<td>".$total_201604_petcenter."</td>
							<td>".$total_201604_petcamp_bg."</td>
							<td>".$total_201604_petcamp_jas."</td>
							<td>".$total_201604_petland."</td>
							<td>".$total_201604_leroy."</td>
							<td>".$total_201604_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_201605_caes."</td>
							<td>".$adotados_201605_gatos."</td>
							<td>".$castrados_201605_caes."</td>
							<td>".$castrados_201605_gatos."</td>
							<td>".$total_201605_petz."</td>
							<td>".$total_201605_petcenter."</td>
							<td>".$total_201605_petcamp_bg."</td>
							<td>".$total_201605_petcamp_jas."</td>
							<td>".$total_201605_petland."</td>
							<td>".$total_201605_leroy."</td>
							<td>".$total_201605_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_201606_caes."</td>
							<td>".$adotados_201606_gatos."</td>
							<td>".$castrados_201606_caes."</td>
							<td>".$castrados_201606_gatos."</td>
							<td>".$total_201606_petz."</td>
							<td>".$total_201606_petcenter."</td>
							<td>".$total_201606_petcamp_bg."</td>
							<td>".$total_201606_petcamp_jas."</td>
							<td>".$total_201606_petland."</td>
							<td>".$total_201606_leroy."</td>
							<td>".$total_201606_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_201607_caes."</td>
							<td>".$adotados_201607_gatos."</td>
							<td>".$castrados_201607_caes."</td>
							<td>".$castrados_201607_gatos."</td>
							<td>".$total_201607_petz."</td>
							<td>".$total_201607_petcenter."</td>
							<td>".$total_201607_petcamp_bg."</td>
							<td>".$total_201607_petcamp_jas."</td>
							<td>".$total_201607_petland."</td>
							<td>".$total_201607_leroy."</td>
							<td>".$total_201607_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_201608_caes."</td>
							<td>".$adotados_201608_gatos."</td>
							<td>".$castrados_201608_caes."</td>
							<td>".$castrados_201608_gatos."</td>
							<td>".$total_201608_petz."</td>
							<td>".$total_201608_petcenter."</td>
							<td>".$total_201608_petcamp_bg."</td>
							<td>".$total_201608_petcamp_jas."</td>
							<td>".$total_201608_petland."</td>
							<td>".$total_201608_leroy."</td>
							<td>".$total_201608_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_201609_caes."</td>
							<td>".$adotados_201609_gatos."</td>
							<td>".$castrados_201609_caes."</td>
							<td>".$castrados_201609_gatos."</td>
							<td>".$total_201609_petz."</td>
							<td>".$total_201609_petcenter."</td>
							<td>".$total_201609_petcamp_bg."</td>
							<td>".$total_201609_petcamp_jas."</td>
							<td>".$total_201609_petland."</td>
							<td>".$total_201609_leroy."</td>
							<td>".$total_201609_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_201610_caes."</td>
							<td>".$adotados_201610_gatos."</td>
							<td>".$castrados_201610_caes."</td>
							<td>".$castrados_201610_gatos."</td>
							<td>".$total_201610_petz."</td>
							<td>".$total_201610_petcenter."</td>
							<td>".$total_201610_petcamp_bg."</td>
							<td>".$total_201610_petcamp_jas."</td>
							<td>".$total_201610_petland."</td>
							<td>".$total_201610_leroy."</td>
							<td>".$total_201610_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_201611_caes."</td>
							<td>".$adotados_201611_gatos."</td>
							<td>".$castrados_201611_caes."</td>
							<td>".$castrados_201611_gatos."</td>
							<td>".$total_201611_petz."</td>
							<td>".$total_201611_petcenter."</td>
							<td>".$total_201611_petcamp_bg."</td>
							<td>".$total_201611_petcamp_jas."</td>
							<td>".$total_201611_petland."</td>
							<td>".$total_201611_leroy."</td>
							<td>".$total_201611_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_201612_caes."</td>
							<td>".$adotados_201612_gatos."</td>
							<td>".$castrados_201612_caes."</td>
							<td>".$castrados_201612_gatos."</td>
							<td>".$total_201612_petz."</td>
							<td>".$total_201612_petcenter."</td>
							<td>".$total_201612_petcamp_bg."</td>
							<td>".$total_201612_petcamp_jas."</td>
							<td>".$total_201612_petland."</td>
							<td>".$total_201612_leroy."</td>
							<td>".$total_201612_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2016."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2017</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_201701_caes."</td>
							<td>".$adotados_201701_gatos."</td>
							<td>".$castrados_201701_caes."</td>
							<td>".$castrados_201701_gatos."</td>
							<td>".$total_201701_petz."</td>
							<td>".$total_201701_petcenter."</td>
							<td>".$total_201701_petcamp_bg."</td>
							<td>".$total_201701_petcamp_jas."</td>
							<td>".$total_201701_petland."</td>
							<td>".$total_201701_leroy."</td>
							<td>".$total_201701_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_201702_caes."</td>
							<td>".$adotados_201702_gatos."</td>
							<td>".$castrados_201702_caes."</td>
							<td>".$castrados_201702_gatos."</td>
							<td>".$total_201702_petz."</td>
							<td>".$total_201702_petcenter."</td>
							<td>".$total_201702_petcamp_bg."</td>
							<td>".$total_201702_petcamp_jas."</td>
							<td>".$total_201702_petland."</td>
							<td>".$total_201702_leroy."</td>
							<td>".$total_201702_fora_feira."</td>
						  </tr>
						   <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Março </th>
							<td>".$adotados_201703_caes."</td>
							<td>".$adotados_201703_gatos."</td>
							<td>".$castrados_201703_caes."</td>
							<td>".$castrados_201703_gatos."</td>
							<td>".$total_201703_petz."</td>
							<td>".$total_201703_petcenter."</td>
							<td>".$total_201703_petcamp_bg."</td>
							<td>".$total_201703_petcamp_jas."</td>
							<td>".$total_201703_petland."</td>
							<td>".$total_201703_leroy."</td>
							<td>".$total_201703_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_201704_caes."</td>
							<td>".$adotados_201704_gatos."</td>
							<td>".$castrados_201704_caes."</td>
							<td>".$castrados_201704_gatos."</td>
							<td>".$total_201704_petz."</td>
							<td>".$total_201704_petcenter."</td>
							<td>".$total_201704_petcamp_bg."</td>
							<td>".$total_201704_petcamp_jas."</td>
							<td>".$total_201704_petland."</td>
							<td>".$total_201704_leroy."</td>
							<td>".$total_201704_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_201705_caes."</td>
							<td>".$adotados_201705_gatos."</td>
							<td>".$castrados_201705_caes."</td>
							<td>".$castrados_201705_gatos."</td>
							<td>".$total_201705_petz."</td>
							<td>".$total_201705_petcenter."</td>
							<td>".$total_201705_petcamp_bg."</td>
							<td>".$total_201705_petcamp_jas."</td>
							<td>".$total_201705_petland."</td>
							<td>".$total_201705_leroy."</td>
							<td>".$total_201705_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_201706_caes."</td>
							<td>".$adotados_201706_gatos."</td>
							<td>".$castrados_201706_caes."</td>
							<td>".$castrados_201706_gatos."</td>
							<td>".$total_201706_petz."</td>
							<td>".$total_201706_petcenter."</td>
							<td>".$total_201706_petcamp_bg."</td>
							<td>".$total_201706_petcamp_jas."</td>
							<td>".$total_201706_petland."</td>
							<td>".$total_201706_leroy."</td>
							<td>".$total_201706_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_201707_caes."</td>
							<td>".$adotados_201707_gatos."</td>
							<td>".$castrados_201707_caes."</td>
							<td>".$castrados_201707_gatos."</td>
							<td>".$total_201707_petz."</td>
							<td>".$total_201707_petcenter."</td>
							<td>".$total_201707_petcamp_bg."</td>
							<td>".$total_201707_petcamp_jas."</td>
							<td>".$total_201707_petland."</td>
							<td>".$total_201707_leroy."</td>
							<td>".$total_201707_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_201708_caes."</td>
							<td>".$adotados_201708_gatos."</td>
							<td>".$castrados_201708_caes."</td>
							<td>".$castrados_201708_gatos."</td>
							<td>".$total_201708_petz."</td>
							<td>".$total_201708_petcenter."</td>
							<td>".$total_201708_petcamp_bg."</td>
							<td>".$total_201708_petcamp_jas."</td>
							<td>".$total_201708_petland."</td>
							<td>".$total_201708_leroy."</td>
							<td>".$total_201708_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_201709_caes."</td>
							<td>".$adotados_201709_gatos."</td>
							<td>".$castrados_201709_caes."</td>
							<td>".$castrados_201709_gatos."</td>
							<td>".$total_201709_petz."</td>
							<td>".$total_201709_petcenter."</td>
							<td>".$total_201709_petcamp_bg."</td>
							<td>".$total_201709_petcamp_jas."</td>
							<td>".$total_201709_petland."</td>
							<td>".$total_201709_leroy."</td>
							<td>".$total_201709_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_201710_caes."</td>
							<td>".$adotados_201710_gatos."</td>
							<td>".$castrados_201710_caes."</td>
							<td>".$castrados_201710_gatos."</td>
							<td>".$total_201710_petz."</td>
							<td>".$total_201710_petcenter."</td>
							<td>".$total_201710_petcamp_bg."</td>
							<td>".$total_201710_petcamp_jas."</td>
							<td>".$total_201710_petland."</td>
							<td>".$total_201710_leroy."</td>
							<td>".$total_201710_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_201711_caes."</td>
							<td>".$adotados_201711_gatos."</td>
							<td>".$castrados_201711_caes."</td>
							<td>".$castrados_201711_gatos."</td>
							<td>".$total_201711_petz."</td>
							<td>".$total_201711_petcenter."</td>
							<td>".$total_201711_petcamp_bg."</td>
							<td>".$total_201711_petcamp_jas."</td>
							<td>".$total_201711_petland."</td>
							<td>".$total_201711_leroy."</td>
							<td>".$total_201711_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_201712_caes."</td>
							<td>".$adotados_201712_gatos."</td>
							<td>".$castrados_201712_caes."</td>
							<td>".$castrados_201712_gatos."</td>
							<td>".$total_201712_petz."</td>
							<td>".$total_201712_petcenter."</td>
							<td>".$total_201712_petcamp_bg."</td>
							<td>".$total_201712_petcamp_jas."</td>
							<td>".$total_201712_petland."</td>
							<td>".$total_201712_leroy."</td>
							<td>".$total_201712_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2017."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2018</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_201801_caes."</td>
							<td>".$adotados_201801_gatos."</td>
							<td>".$castrados_201801_caes."</td>
							<td>".$castrados_201801_gatos."</td>
							<td>".$total_201801_petz."</td>
							<td>".$total_201801_petcenter."</td>
							<td>".$total_201801_petcamp_bg."</td>
							<td>".$total_201801_petcamp_jas."</td>
							<td>".$total_201801_petland."</td>
							<td>".$total_201801_leroy."</td>
							<td>".$total_201801_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_201802_caes."</td>
							<td>".$adotados_201802_gatos."</td>
							<td>".$castrados_201802_caes."</td>
							<td>".$castrados_201802_gatos."</td>
							<td>".$total_201802_petz."</td>
							<td>".$total_201802_petcenter."</td>
							<td>".$total_201802_petcamp_bg."</td>
							<td>".$total_201802_petcamp_jas."</td>
							<td>".$total_201802_petland."</td>
							<td>".$total_201802_leroy."</td>
							<td>".$total_201802_fora_feira."</td>
						  </tr>
						   <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Março </th>
							<td>".$adotados_201803_caes."</td>
							<td>".$adotados_201803_gatos."</td>
							<td>".$castrados_201803_caes."</td>
							<td>".$castrados_201803_gatos."</td>
							<td>".$total_201803_petz."</td>
							<td>".$total_201803_petcenter."</td>
							<td>".$total_201803_petcamp_bg."</td>
							<td>".$total_201803_petcamp_jas."</td>
							<td>".$total_201803_petland."</td>
							<td>".$total_201803_leroy."</td>
							<td>".$total_201803_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_201804_caes."</td>
							<td>".$adotados_201804_gatos."</td>
							<td>".$castrados_201804_caes."</td>
							<td>".$castrados_201804_gatos."</td>
							<td>".$total_201804_petz."</td>
							<td>".$total_201804_petcenter."</td>
							<td>".$total_201804_petcamp_bg."</td>
							<td>".$total_201804_petcamp_jas."</td>
							<td>".$total_201804_petland."</td>
							<td>".$total_201804_leroy."</td>
							<td>".$total_201804_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_201805_caes."</td>
							<td>".$adotados_201805_gatos."</td>
							<td>".$castrados_201805_caes."</td>
							<td>".$castrados_201805_gatos."</td>
							<td>".$total_201805_petz."</td>
							<td>".$total_201805_petcenter."</td>
							<td>".$total_201805_petcamp_bg."</td>
							<td>".$total_201805_petcamp_jas."</td>
							<td>".$total_201805_petland."</td>
							<td>".$total_201805_leroy."</td>
							<td>".$total_201805_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_201806_caes."</td>
							<td>".$adotados_201806_gatos."</td>
							<td>".$castrados_201806_caes."</td>
							<td>".$castrados_201806_gatos."</td>
							<td>".$total_201806_petz."</td>
							<td>".$total_201806_petcenter."</td>
							<td>".$total_201806_petcamp_bg."</td>
							<td>".$total_201806_petcamp_jas."</td>
							<td>".$total_201806_petland."</td>
							<td>".$total_201806_leroy."</td>
							<td>".$total_201806_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_201807_caes."</td>
							<td>".$adotados_201807_gatos."</td>
							<td>".$castrados_201807_caes."</td>
							<td>".$castrados_201807_gatos."</td>
							<td>".$total_201807_petz."</td>
							<td>".$total_201807_petcenter."</td>
							<td>".$total_201807_petcamp_bg."</td>
							<td>".$total_201807_petcamp_jas."</td>
							<td>".$total_201807_petland."</td>
							<td>".$total_201807_leroy."</td>
							<td>".$total_201807_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_201808_caes."</td>
							<td>".$adotados_201808_gatos."</td>
							<td>".$castrados_201808_caes."</td>
							<td>".$castrados_201808_gatos."</td>
							<td>".$total_201808_petz."</td>
							<td>".$total_201808_petcenter."</td>
							<td>".$total_201808_petcamp_bg."</td>
							<td>".$total_201808_petcamp_jas."</td>
							<td>".$total_201808_petland."</td>
							<td>".$total_201808_leroy."</td>
							<td>".$total_201808_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_201809_caes."</td>
							<td>".$adotados_201809_gatos."</td>
							<td>".$castrados_201809_caes."</td>
							<td>".$castrados_201809_gatos."</td>
							<td>".$total_201809_petz."</td>
							<td>".$total_201809_petcenter."</td>
							<td>".$total_201809_petcamp_bg."</td>
							<td>".$total_201809_petcamp_jas."</td>
							<td>".$total_201809_petland."</td>
							<td>".$total_201809_leroy."</td>
							<td>".$total_201809_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_201810_caes."</td>
							<td>".$adotados_201810_gatos."</td>
							<td>".$castrados_201810_caes."</td>
							<td>".$castrados_201810_gatos."</td>
							<td>".$total_201810_petz."</td>
							<td>".$total_201810_petcenter."</td>
							<td>".$total_201810_petcamp_bg."</td>
							<td>".$total_201810_petcamp_jas."</td>
							<td>".$total_201810_petland."</td>
							<td>".$total_201810_leroy."</td>
							<td>".$total_201810_fora_feira."</td>
						  </tr>
						 <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_201811_caes."</td>
							<td>".$adotados_201811_gatos."</td>
							<td>".$castrados_201811_caes."</td>
							<td>".$castrados_201811_gatos."</td>
							<td>".$total_201811_petz."</td>
							<td>".$total_201811_petcenter."</td>
							<td>".$total_201811_petcamp_bg."</td>
							<td>".$total_201811_petcamp_jas."</td>
							<td>".$total_201811_petland."</td>
							<td>".$total_201811_leroy."</td>
							<td>".$total_201811_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_201812_caes."</td>
							<td>".$adotados_201812_gatos."</td>
							<td>".$castrados_201812_caes."</td>
							<td>".$castrados_201812_gatos."</td>
							<td>".$total_201812_petz."</td>
							<td>".$total_201812_petcenter."</td>
							<td>".$total_201812_petcamp_bg."</td>
							<td>".$total_201812_petcamp_jas."</td>
							<td>".$total_201812_petland."</td>
							<td>".$total_201812_leroy."</td>
							<td>".$total_201812_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2018."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2019</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_201901_caes."</td>
							<td>".$adotados_201901_gatos."</td>
							<td>".$castrados_201901_caes."</td>
							<td>".$castrados_201901_gatos."</td>
							<td>".$total_201901_petz."</td>
							<td>".$total_201901_petcenter."</td>
							<td>".$total_201901_petcamp_bg."</td>
							<td>".$total_201901_petcamp_jas."</td>
							<td>".$total_201901_petland."</td>
							<td>".$total_201901_leroy."</td>
							<td>".$total_201901_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_201902_caes."</td>
							<td>".$adotados_201902_gatos."</td>
							<td>".$castrados_201902_caes."</td>
							<td>".$castrados_201902_gatos."</td>
							<td>".$total_201902_petz."</td>
							<td>".$total_201902_petcenter."</td>
							<td>".$total_201902_petcamp_bg."</td>
							<td>".$total_201902_petcamp_jas."</td>
							<td>".$total_201902_petland."</td>
							<td>".$total_201902_leroy."</td>
							<td>".$total_201902_fora_feira."</td>
						  </tr>
						   <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Março </th>
							<td>".$adotados_201903_caes."</td>
							<td>".$adotados_201903_gatos."</td>
							<td>".$castrados_201903_caes."</td>
							<td>".$castrados_201903_gatos."</td>
							<td>".$total_201903_petz."</td>
							<td>".$total_201903_petcenter."</td>
							<td>".$total_201903_petcamp_bg."</td>
							<td>".$total_201903_petcamp_jas."</td>
							<td>".$total_201903_petland."</td>
							<td>".$total_201903_leroy."</td>
							<td>".$total_201903_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_201904_caes."</td>
							<td>".$adotados_201904_gatos."</td>
							<td>".$castrados_201904_caes."</td>
							<td>".$castrados_201904_gatos."</td>
							<td>".$total_201904_petz."</td>
							<td>".$total_201904_petcenter."</td>
							<td>".$total_201904_petcamp_bg."</td>
							<td>".$total_201904_petcamp_jas."</td>
							<td>".$total_201904_petland."</td>
							<td>".$total_201904_leroy."</td>
							<td>".$total_201904_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_201905_caes."</td>
							<td>".$adotados_201905_gatos."</td>
							<td>".$castrados_201905_caes."</td>
							<td>".$castrados_201905_gatos."</td>
							<td>".$total_201905_petz."</td>
							<td>".$total_201905_petcenter."</td>
							<td>".$total_201905_petcamp_bg."</td>
							<td>".$total_201905_petcamp_jas."</td>
							<td>".$total_201905_petland."</td>
							<td>".$total_201905_leroy."</td>
							<td>".$total_201905_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_201906_caes."</td>
							<td>".$adotados_201906_gatos."</td>
							<td>".$castrados_201906_caes."</td>
							<td>".$castrados_201906_gatos."</td>
							<td>".$total_201906_petz."</td>
							<td>".$total_201906_petcenter."</td>
							<td>".$total_201906_petcamp_bg."</td>
							<td>".$total_201906_petcamp_jas."</td>
							<td>".$total_201906_petland."</td>
							<td>".$total_201906_leroy."</td>
							<td>".$total_201906_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_201907_caes."</td>
							<td>".$adotados_201907_gatos."</td>
							<td>".$castrados_201907_caes."</td>
							<td>".$castrados_201907_gatos."</td>
							<td>".$total_201907_petz."</td>
							<td>".$total_201907_petcenter."</td>
							<td>".$total_201907_petcamp_bg."</td>
							<td>".$total_201907_petcamp_jas."</td>
							<td>".$total_201907_petland."</td>
							<td>".$total_201907_leroy."</td>
							<td>".$total_201907_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_201908_caes."</td>
							<td>".$adotados_201908_gatos."</td>
							<td>".$castrados_201908_caes."</td>
							<td>".$castrados_201908_gatos."</td>
							<td>".$total_201908_petz."</td>
							<td>".$total_201908_petcenter."</td>
							<td>".$total_201908_petcamp_bg."</td>
							<td>".$total_201908_petcamp_jas."</td>
							<td>".$total_201908_petland."</td>
							<td>".$total_201908_leroy."</td>
							<td>".$total_201908_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_201909_caes."</td>
							<td>".$adotados_201909_gatos."</td>
							<td>".$castrados_201909_caes."</td>
							<td>".$castrados_201909_gatos."</td>
							<td>".$total_201909_petz."</td>
							<td>".$total_201909_petcenter."</td>
							<td>".$total_201909_petcamp_bg."</td>
							<td>".$total_201909_petcamp_jas."</td>
							<td>".$total_201909_petland."</td>
							<td>".$total_201909_leroy."</td>
							<td>".$total_201909_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_201910_caes."</td>
							<td>".$adotados_201910_gatos."</td>
							<td>".$castrados_201910_caes."</td>
							<td>".$castrados_201910_gatos."</td>
							<td>".$total_201910_petz."</td>
							<td>".$total_201910_petcenter."</td>
							<td>".$total_201910_petcamp_bg."</td>
							<td>".$total_201910_petcamp_jas."</td>
							<td>".$total_201910_petland."</td>
							<td>".$total_201910_leroy."</td>
							<td>".$total_201910_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_201911_caes."</td>
							<td>".$adotados_201911_gatos."</td>
							<td>".$castrados_201911_caes."</td>
							<td>".$castrados_201911_gatos."</td>
							<td>".$total_201911_petz."</td>
							<td>".$total_201911_petcenter."</td>
							<td>".$total_201911_petcamp_bg."</td>
							<td>".$total_201911_petcamp_jas."</td>
							<td>".$total_201911_petland."</td>
							<td>".$total_201911_leroy."</td>
							<td>".$total_201911_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_201912_caes."</td>
							<td>".$adotados_201912_gatos."</td>
							<td>".$castrados_201912_caes."</td>
							<td>".$castrados_201912_gatos."</td>
							<td>".$total_201912_petz."</td>
							<td>".$total_201912_petcenter."</td>
							<td>".$total_201912_petcamp_bg."</td>
							<td>".$total_201912_petcamp_jas."</td>
							<td>".$total_201912_petland."</td>
							<td>".$total_201912_leroy."</td>
							<td>".$total_201912_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2019."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2020</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_202001_caes."</td>
							<td>".$adotados_202001_gatos."</td>
							<td>".$castrados_202001_caes."</td>
							<td>".$castrados_202001_gatos."</td>
							<td>".$total_202001_petz."</td>
							<td>".$total_202001_petcenter."</td>
							<td>".$total_202001_petcamp_bg."</td>
							<td>".$total_202001_petcamp_jas."</td>
							<td>".$total_202001_petland."</td>
							<td>".$total_202001_leroy."</td>
							<td>".$total_202001_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_202002_caes."</td>
							<td>".$adotados_202002_gatos."</td>
							<td>".$castrados_202002_caes."</td>
							<td>".$castrados_202002_gatos."</td>
							<td>".$total_202002_petz."</td>
							<td>".$total_202002_petcenter."</td>
							<td>".$total_202002_petcamp_bg."</td>
							<td>".$total_202002_petcamp_jas."</td>
							<td>".$total_202002_petland."</td>
							<td>".$total_202002_leroy."</td>
							<td>".$total_202002_fora_feira."</td>
						  </tr>
						   <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Março </th>
							<td>".$adotados_202003_caes."</td>
							<td>".$adotados_202003_gatos."</td>
							<td>".$castrados_202003_caes."</td>
							<td>".$castrados_202003_gatos."</td>
							<td>".$total_202003_petz."</td>
							<td>".$total_202003_petcenter."</td>
							<td>".$total_202003_petcamp_bg."</td>
							<td>".$total_202003_petcamp_jas."</td>
							<td>".$total_202003_petland."</td>
							<td>".$total_202003_leroy."</td>
							<td>".$total_202003_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_202004_caes."</td>
							<td>".$adotados_202004_gatos."</td>
							<td>".$castrados_202004_caes."</td>
							<td>".$castrados_202004_gatos."</td>
							<td>".$total_202004_petz."</td>
							<td>".$total_202004_petcenter."</td>
							<td>".$total_202004_petcamp_bg."</td>
							<td>".$total_202004_petcamp_jas."</td>
							<td>".$total_202004_petland."</td>
							<td>".$total_202004_leroy."</td>
							<td>".$total_202004_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_202005_caes."</td>
							<td>".$adotados_202005_gatos."</td>
							<td>".$castrados_202005_caes."</td>
							<td>".$castrados_202005_gatos."</td>
							<td>".$total_202005_petz."</td>
							<td>".$total_202005_petcenter."</td>
							<td>".$total_202005_petcamp_bg."</td>
							<td>".$total_202005_petcamp_jas."</td>
							<td>".$total_202005_petland."</td>
							<td>".$total_202005_leroy."</td>
							<td>".$total_202005_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_202006_caes."</td>
							<td>".$adotados_202006_gatos."</td>
							<td>".$castrados_202006_caes."</td>
							<td>".$castrados_202006_gatos."</td>
							<td>".$total_202006_petz."</td>
							<td>".$total_202006_petcenter."</td>
							<td>".$total_202006_petcamp_bg."</td>
							<td>".$total_202006_petcamp_jas."</td>
							<td>".$total_202006_petland."</td>
							<td>".$total_202006_leroy."</td>
							<td>".$total_202006_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_202007_caes."</td>
							<td>".$adotados_202007_gatos."</td>
							<td>".$castrados_202007_caes."</td>
							<td>".$castrados_202007_gatos."</td>
							<td>".$total_202007_petz."</td>
							<td>".$total_202007_petcenter."</td>
							<td>".$total_202007_petcamp_bg."</td>
							<td>".$total_202007_petcamp_jas."</td>
							<td>".$total_202007_petland."</td>
							<td>".$total_202007_leroy."</td>
							<td>".$total_202007_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_202008_caes."</td>
							<td>".$adotados_202008_gatos."</td>
							<td>".$castrados_202008_caes."</td>
							<td>".$castrados_202008_gatos."</td>
							<td>".$total_202008_petz."</td>
							<td>".$total_202008_petcenter."</td>
							<td>".$total_202008_petcamp_bg."</td>
							<td>".$total_202008_petcamp_jas."</td>
							<td>".$total_202008_petland."</td>
							<td>".$total_202008_leroy."</td>
							<td>".$total_202008_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_202009_caes."</td>
							<td>".$adotados_202009_gatos."</td>
							<td>".$castrados_202009_caes."</td>
							<td>".$castrados_202009_gatos."</td>
							<td>".$total_202009_petz."</td>
							<td>".$total_202009_petcenter."</td>
							<td>".$total_202009_petcamp_bg."</td>
							<td>".$total_202009_petcamp_jas."</td>
							<td>".$total_202009_petland."</td>
							<td>".$total_202009_leroy."</td>
							<td>".$total_202009_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_202010_caes."</td>
							<td>".$adotados_202010_gatos."</td>
							<td>".$castrados_202010_caes."</td>
							<td>".$castrados_202010_gatos."</td>
							<td>".$total_202010_petz."</td>
							<td>".$total_202010_petcenter."</td>
							<td>".$total_202010_petcamp_bg."</td>
							<td>".$total_202010_petcamp_jas."</td>
							<td>".$total_202010_petland."</td>
							<td>".$total_202010_leroy."</td>
							<td>".$total_202010_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_202011_caes."</td>
							<td>".$adotados_202011_gatos."</td>
							<td>".$castrados_202011_caes."</td>
							<td>".$castrados_202011_gatos."</td>
							<td>".$total_202011_petz."</td>
							<td>".$total_202011_petcenter."</td>
							<td>".$total_202011_petcamp_bg."</td>
							<td>".$total_202011_petcamp_jas."</td>
							<td>".$total_202011_petland."</td>
							<td>".$total_202011_leroy."</td>
							<td>".$total_202011_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_202012_caes."</td>
							<td>".$adotados_202012_gatos."</td>
							<td>".$castrados_202012_caes."</td>
							<td>".$castrados_202012_gatos."</td>
							<td>".$total_202012_petz."</td>
							<td>".$total_202012_petcenter."</td>
							<td>".$total_202012_petcamp_bg."</td>
							<td>".$total_202012_petcamp_jas."</td>
							<td>".$total_202012_petland."</td>
							<td>".$total_202012_leroy."</td>
							<td>".$total_202012_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2020."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						  </table>
						  <br>
						  <table class='table' >
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
							<th scope='row'>2021</th>
							<th scope='row'>Janeiro</th>
							<td>".$adotados_202101_caes."</td>
							<td>".$adotados_202101_gatos."</td>
							<td>".$castrados_202101_caes."</td>
							<td>".$castrados_202101_gatos."</td>
							<td>".$total_202101_petz."</td>
							<td>".$total_202101_petcenter."</td>
							<td>".$total_202101_petcamp_bg."</td>
							<td>".$total_202101_petcamp_jas."</td>
							<td>".$total_202101_petland."</td>
							<td>".$total_202101_leroy."</td>
							<td>".$total_202101_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Fevereiro</th>
							<td>".$adotados_202102_caes."</td>
							<td>".$adotados_202102_gatos."</td>
							<td>".$castrados_202102_caes."</td>
							<td>".$castrados_202102_gatos."</td>
							<td>".$total_202102_petz."</td>
							<td>".$total_202102_petcenter."</td>
							<td>".$total_202102_petcamp_bg."</td>
							<td>".$total_202102_petcamp_jas."</td>
							<td>".$total_202102_petland."</td>
							<td>".$total_202102_leroy."</td>
							<td>".$total_202102_fora_feira."</td>
						  </tr>
						   <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Março </th>
							<td>".$adotados_202103_caes."</td>
							<td>".$adotados_202103_gatos."</td>
							<td>".$castrados_202103_caes."</td>
							<td>".$castrados_202103_gatos."</td>
							<td>".$total_202103_petz."</td>
							<td>".$total_202103_petcenter."</td>
							<td>".$total_202103_petcamp_bg."</td>
							<td>".$total_202103_petcamp_jas."</td>
							<td>".$total_202103_petland."</td>
							<td>".$total_202103_leroy."</td>
							<td>".$total_202103_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Abril</th>
							<td>".$adotados_202104_caes."</td>
							<td>".$adotados_202104_gatos."</td>
							<td>".$castrados_202104_caes."</td>
							<td>".$castrados_202104_gatos."</td>
							<td>".$total_202104_petz."</td>
							<td>".$total_202104_petcenter."</td>
							<td>".$total_202104_petcamp_bg."</td>
							<td>".$total_202104_petcamp_jas."</td>
							<td>".$total_202104_petland."</td>
							<td>".$total_202104_leroy."</td>
							<td>".$total_202104_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Maio</th>
							<td>".$adotados_202105_caes."</td>
							<td>".$adotados_202105_gatos."</td>
							<td>".$castrados_202105_caes."</td>
							<td>".$castrados_202105_gatos."</td>
							<td>".$total_202105_petz."</td>
							<td>".$total_202105_petcenter."</td>
							<td>".$total_202105_petcamp_bg."</td>
							<td>".$total_202105_petcamp_jas."</td>
							<td>".$total_202105_petland."</td>
							<td>".$total_202105_leroy."</td>
							<td>".$total_202105_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Junho</th>
							<td>".$adotados_202106_caes."</td>
							<td>".$adotados_202106_gatos."</td>
							<td>".$castrados_202106_caes."</td>
							<td>".$castrados_202106_gatos."</td>
							<td>".$total_202106_petz."</td>
							<td>".$total_202106_petcenter."</td>
							<td>".$total_202106_petcamp_bg."</td>
							<td>".$total_202106_petcamp_jas."</td>
							<td>".$total_202106_petland."</td>
							<td>".$total_202106_leroy."</td>
							<td>".$total_202106_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Julho</th>
							<td>".$adotados_202107_caes."</td>
							<td>".$adotados_202107_gatos."</td>
							<td>".$castrados_202107_caes."</td>
							<td>".$castrados_202107_gatos."</td>
							<td>".$total_202107_petz."</td>
							<td>".$total_202107_petcenter."</td>
							<td>".$total_202107_petcamp_bg."</td>
							<td>".$total_202107_petcamp_jas."</td>
							<td>".$total_202107_petland."</td>
							<td>".$total_202107_leroy."</td>
							<td>".$total_202107_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Agosto</th>
							<td>".$adotados_202108_caes."</td>
							<td>".$adotados_202108_gatos."</td>
							<td>".$castrados_202108_caes."</td>
							<td>".$castrados_202108_gatos."</td>
							<td>".$total_202108_petz."</td>
							<td>".$total_202108_petcenter."</td>
							<td>".$total_202108_petcamp_bg."</td>
							<td>".$total_202108_petcamp_jas."</td>
							<td>".$total_202108_petland."</td>
							<td>".$total_202108_leroy."</td>
							<td>".$total_202108_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Setembro</th>
							<td>".$adotados_202109_caes."</td>
							<td>".$adotados_202109_gatos."</td>
							<td>".$castrados_202109_caes."</td>
							<td>".$castrados_202109_gatos."</td>
							<td>".$total_202109_petz."</td>
							<td>".$total_202109_petcenter."</td>
							<td>".$total_202109_petcamp_bg."</td>
							<td>".$total_202109_petcamp_jas."</td>
							<td>".$total_202109_petland."</td>
							<td>".$total_202109_leroy."</td>
							<td>".$total_202109_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Outubro</th>
							<td>".$adotados_202110_caes."</td>
							<td>".$adotados_202110_gatos."</td>
							<td>".$castrados_202110_caes."</td>
							<td>".$castrados_202110_gatos."</td>
							<td>".$total_202110_petz."</td>
							<td>".$total_202110_petcenter."</td>
							<td>".$total_202110_petcamp_bg."</td>
							<td>".$total_202110_petcamp_jas."</td>
							<td>".$total_202110_petland."</td>
							<td>".$total_202110_leroy."</td>
							<td>".$total_202110_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Novembro</th>
							<td>".$adotados_202111_caes."</td>
							<td>".$adotados_202111_gatos."</td>
							<td>".$castrados_202111_caes."</td>
							<td>".$castrados_202111_gatos."</td>
							<td>".$total_202111_petz."</td>
							<td>".$total_202111_petcenter."</td>
							<td>".$total_202111_petcamp_bg."</td>
							<td>".$total_202111_petcamp_jas."</td>
							<td>".$total_202111_petland."</td>
							<td>".$total_202111_leroy."</td>
							<td>".$total_202111_fora_feira."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<th scope='row'>Dezembro</th>
							<td>".$adotados_202112_caes."</td>
							<td>".$adotados_202112_gatos."</td>
							<td>".$castrados_202112_caes."</td>
							<td>".$castrados_202112_gatos."</td>
							<td>".$total_202112_petz."</td>
							<td>".$total_202112_petcenter."</td>
							<td>".$total_202112_petcamp_bg."</td>
							<td>".$total_202112_petcamp_jas."</td>
							<td>".$total_202112_petland."</td>
							<td>".$total_202112_leroy."</td>
							<td>".$total_202112_fora_feira."</td>
						  </tr>
						  <tr>
						  	<th scope='row' colspan='2'>TOTAL </th>
							<td class='text-danger'>".$total_2021."</td>
							<td colspan='13'>&nbsp;</td>
						  </tr>
						  </tbody>
						</table>
						</center>
						
						<br>
						<center>
                                        <h3>RESUMO</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                	    </thead>
                                    	<tbody>
                                        	<tr>
                            					<th scope='row'>Animais doados</th>
                            					<td>".$animais_adotados."</td>
                        					</tr>
                        					<tr>
                            					<th scope='row'>Animais doados castrados</th>
                            					<td>".$animais_castrados."</td>
                        					</tr>
                        					<tr>
                            					<th scope='row'>Animais doados não castrados (menores de 5 meses)</th>
                            					<td>".$animais_naocastrados."</td>
                        					</tr>
                    					</tbody>
                    				</table>
                    				
                    				<center>
                                        <h3>ESTATÍSTICAS</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                        <tr>
                        					<th scope='row'>Percentual de cães adotados</th>
                        					<th>".number_format($perc_caes,2,',', '.')."%</th>
                    					</tr>
                                	    </thead>
                                    	<tbody>
                    					
                    					<tr>
                        					<th>Fêmeas</th>
                        					<td>".number_format($perc_caes_femeas,2,',', '.')."%</td>
                    					</tr>
                    					<tr>
                        					<th>Machos</th>
                        					<td>".number_format($perc_caes_machos,2,',', '.')."%</td>
                    					</tr>
                    					</tbody>
                    				</table>
                    				<br>
                    				<table class='table'>
                                        <thead class='thead-light'>
                                        <tr>
                        					<th scope='row'>Percentual de gatos adotados</th>
                        					<th>".number_format($perc_gatos,2,',', '.')."%</th>
                    					</tr>
                                	    </thead>
                                    	<tbody>
                    					<tr>
                        					<th>Fêmeas</th>
                        					<td>".number_format($perc_gatos_femeas,2,',', '.')."%</td>
                    					</tr>
                    					<tr>
                        					<th>Machos</th>
                        					<td>".number_format($perc_gatos_machos,2,',', '.')."%</td>
                    					</tr>
                    					</tbody>
                    				</table>";
				
			  }
			  if ($localadocao != '' && $anoadocao!= '' && $mesadocao != '' && $comtermos == ''){
			      
			      $query = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."-%' AND LOCAL_ADOCAO = '".$localadocao."' ORDER BY DATA_ADOCAO ASC";
    			  $select = mysqli_query($connect,$query);
    			  $rc= mysqli_num_rows($connect);
    			  
    			  $adotados_caes_femeas = adotados_mes_femeas($anoadocao,$mesadocao,'Canina',$connect);
				  $adotados_caes_machos = adotados_mes_machos($anoadocao,$mesadocao,'Canina',$connect);
				
				  $adotados_gatos_femeas = adotados_mes_femeas($anoadocao,$mesadocao,'Felina',$connect);
				  $adotados_gatos_machos = adotados_mes_machos($anoadocao,$mesadocao,'Felina',$connect);
				
				  $perc_caes = (intval($mes_adotados_caes) / intval($animais_adotados))*100;
				  $perc_caes_femeas = (intval($adotados_caes_femeas) / intval($animais_adotados))*100;
				  $perc_caes_machos = (intval($adotados_caes_machos) / intval($animais_adotados))*100;
				
				  $perc_gatos = (intval($mes_adotados_gatos) / intval($animais_adotados))*100;
				  $perc_gatos_femeas = (intval($adotados_gatos_femeas) / intval($animais_adotados))*100;
				  $perc_gatos_machos = (intval($adotados_gatos_machos) / intval($animais_adotados))*100;
    			  
    			  echo "<center><table class='table' >
    						  <thead class='thead-light  th-header'>
    						  <tr>
                                <th scope='col'>Nome do animal;</th>
    							<th scope='col'>Espécie</th>
    							<th scope='col'>Lar temporário</th>
    							<th scope='col'>Responsável</th>
    							<th scope='col'>Data da adoção</th>
    						  </tr>
    						  </thead>
    						  <tbody>";
    			  
    			  while ($fetch = mysqli_fetch_row($select)) {
    			      $nomedoanimal = $fetch[15];
    			      $especie = $fetch[16];
    			      $lt = $fetch[30];
    			      $dtadocao = $fetch[32];
    			      $emailresp = $fetch[29];
    			      
    			      $query2 = "SELECT RESPONSAVEL FROM ANIMAL WHERE NOME_ANIMAL ='".$nomedoanimal."' AND ESPECIE = '".$especie."'";
    			      $select2 = mysqli_query($connect,$query2);
    			      
    			      while ($fetch2 = mysqli_fetch_row($select2)) {
    			        $resp = $fetch2[0];
    			      }
    			  
        			  echo "  <tr> 
    							<th scope='row'>".$nomedoanimal." </th>
    							<th scope='row'>".$especie." </th>
    							<td>".$lt."</td> 
    							<td>".$resp."</td>
    							<td>".$dtadocao."</td>
    						  </tr>";
    						  
    			  }
    			  
    			  echo "</tbody>
    			        </table>";
    		 }
    		  if ($localadocao != '' && $anoadocao!= '' && $mesadocao == '' && $comtermos == ''){
			      
			      $query = "SELECT * FROM TERMO_ADOCAO where DATA_ADOCAO LIKE '".$anoadocao."-%' AND LOCAL_ADOCAO = '".$localadocao."' ORDER BY DATA_ADOCAO ASC";
    			  $select = mysqli_query($connect,$query);
    			  $rc= mysqli_num_rows($connect);
    			  
    			  echo "<center><table class='table' >
    						  <thead class='thead-light  th-header'>
    						  <tr>
                                <th scope='col'>Nome do animal;</th>
    							<th scope='col'>Espécie</th>
    							<th scope='col'>Lar temporário</th>
    							<th scope='col'>Responsável</th>
    							<th scope='col'>Data da adoção</th>
    						  </tr>
    						  </thead>
    						  <tbody>";
    			  
    			  while ($fetch = mysqli_fetch_row($select)) {
    			      $nomedoanimal = $fetch[15];
    			      $especie = $fetch[16];
    			      $lt = $fetch[30];
    			      $dtadocao = $fetch[32];
    			      $emailresp = $fetch[29];
    			      
    			      $query2 = "SELECT RESPONSAVEL FROM ANIMAL WHERE NOME_ANIMAL ='".$nomedoanimal."' AND ESPECIE = '".$especie."'";
    			      $select2 = mysqli_query($connect,$query2);
    			      
    			      while ($fetch2 = mysqli_fetch_row($select2)) {
    			        $resp = $fetch2[0];
    			      }
    			  
        			  echo "  <tr> 
    							<th scope='row'>".$nomedoanimal." </th>
    							<th scope='row'>".$especie." </th>
    							<td>".$lt."</td> 
    							<td>".$resp."</td>
    							<td>".$dtadocao."</td>
    						  </tr>";
    						  
    			  }
    			  
    			  echo "</tbody>
    			        </table>";
    		 } 
    		  if ($anoadocao== '' && $mesadocao == '' && $localadocao == '' && $comtermos == 'Não'){
    		      
    		        $sum_semtermo = 0;
    		      
    		        $query = "SELECT * FROM ANIMAL WHERE TERMO_ADOCAO='Não' AND DIVULGAR_COMO ='GAAR' AND ADOTADO='Adotado' ORDER BY DATA_SAIDA_LT DESC";
        			$select = mysqli_query($connect,$query);
        			$reccount = mysqli_num_rows($select);
        			
        			echo "<center>
    				       <h4> Animais adotados </h4><br>
    				       <p> Os animais listados abaixo constam como adotados e não possuem termo de adoção cadastrado</p><br>";
            	    echo "<table class='table'>";
                    echo "<thead class='thead-light'>";
                	echo "<th scope='col'>Nome do animal</th>";
                	echo "<th scope='col'>Espécie</th>";
                	echo "<th scope='col'>Responsável</th>";
                	echo "<th scope='col'>Lar temporário</th>";
                	echo "<th scope='col'>Data da adoção</th>";
                	echo "</thead>";
                	echo "<tbody>";
        			
        			while ($fetch = mysqli_fetch_row($select)) {
    					$idanimal = $fetch[0];	
    					$nomedoanimal = $fetch[1];
    					$especie = $fetch[2];
    					$sexo = $fetch[4];
    					$castracao = $fetch[7];
    					$dtcastracao  = $fetch[8];
    					$vacinacao = $fetch[9];
    					$status = $fetch[10];
    					$lt = $fetch[11];
    					$resp = $fetch[12];
    					$dtadocao =$fetch[14];
    					
    					$ano_adocao = substr($dtadocao,0,4);
                        $mes_adocao = substr($dtadocao,5,2);
                        $dia_adocao = substr($dtadocao,8,2);

                        echo "<tr>";
            			echo "<td>".$nomedoanimal."</td>";
    					echo "<td>".$especie."</td>";
    					echo "<td>".$resp."</td>";
    					echo "<td>".$lt."</td>";
    					echo "<td>".$dia_adocao."/".$mes_adocao."/".$ano_adocao."</td>";
    			        echo "</tr>";
    			        $sum_semtermo = intval($sum_semtermo) + 1;
                }
                echo "</tbody>";
        	    echo "</table>";
        	    echo "<br>".$sum_semtermo." animais encontrados";

    		  }
    		  if ($anoadocao== '' && $mesadocao == '' && $localadocao == '' && $comtermos == 'Sim'){
    		      
    		        $query = "SELECT * FROM ANIMAL WHERE TERMO_ADOCAO='Sim' AND DIVULGAR_COMO ='GAAR' ORDER BY ID DESC";
        			$select = mysqli_query($connect,$query);
        			$reccount = mysqli_num_rows($select);
        			
        			echo "<center>
    				       <h4> Animais adotados </h4><br>
    				       <p> Os animais listados abaixo constam como adotados e não possuem termo de adoção cadastrado</p><br>";
            	    echo "<table class='table'>";
                    echo "<thead class='thead-light'>";
                	echo "<th scope='col'>Nome do animal</th>";
                	echo "<th scope='col'>Espécie</th>";
                	echo "<th scope='col'>Responsável</th>";
                	echo "<th scope='col'>Lar temporário</th>";
                	echo "</thead>";
                	echo "<tbody>";
        			
        			while ($fetch = mysqli_fetch_row($select)) {
    					$idanimal = $fetch[0];	
    					$nomedoanimal = $fetch[1];
    					$especie = $fetch[2];
    					$sexo = $fetch[4];
    					$castracao = $fetch[7];
    					$dtcastracao  = $fetch[8];
    					$vacinacao = $fetch[9];
    					$status = $fetch[10];
    					$lt = $fetch[11];
    					$resp = $fetch[12];
                        echo "<tr>";
            			echo "<td>".$nomedoanimal."</td>";
    					echo "<td>".$especie."</td>";
    					echo "<td>".$resp."</td>";
    					echo "<td>".$lt."</td>";
    			        echo "</tr>";
        	   
                }
                echo "</tbody>";
        	    echo "</table>";

    		  }
		      break;
		      
		case 'Castração':
			if ($anocastra != '' && $mescastra == ''){
			    
			     $valor_mensal01_gaar_caes = castracao_mensal_gaar_valor($anocastra, '01', 'Canina', $connect);
			     $valor_mensal02_gaar_caes = castracao_mensal_gaar_valor($anocastra, '02', 'Canina', $connect);
			     $valor_mensal03_gaar_caes = castracao_mensal_gaar_valor($anocastra, '03', 'Canina', $connect);
			     $valor_mensal04_gaar_caes = castracao_mensal_gaar_valor($anocastra, '04', 'Canina', $connect);
			     $valor_mensal05_gaar_caes = castracao_mensal_gaar_valor($anocastra, '05', 'Canina', $connect);
			     $valor_mensal06_gaar_caes = castracao_mensal_gaar_valor($anocastra, '06', 'Canina', $connect);
			     $valor_mensal07_gaar_caes = castracao_mensal_gaar_valor($anocastra, '07', 'Canina', $connect);
			     $valor_mensal08_gaar_caes = castracao_mensal_gaar_valor($anocastra, '08', 'Canina', $connect);
			     $valor_mensal09_gaar_caes = castracao_mensal_gaar_valor($anocastra, '09', 'Canina', $connect);
			     $valor_mensal10_gaar_caes = castracao_mensal_gaar_valor($anocastra, '10', 'Canina', $connect);
			     $valor_mensal11_gaar_caes = castracao_mensal_gaar_valor($anocastra, '11', 'Canina', $connect);
			     $valor_mensal12_gaar_caes = castracao_mensal_gaar_valor($anocastra, '12', 'Canina', $connect);
			     
			     $valor_mensal01_gaar_gatos = castracao_mensal_gaar_valor($anocastra, '01', 'Felina', $connect);
			     $valor_mensal02_gaar_gatos = castracao_mensal_gaar_valor($anocastra, '02', 'Felina', $connect);
			     $valor_mensal03_gaar_gatos = castracao_mensal_gaar_valor($anocastra, '03', 'Felina', $connect);
			     $valor_mensal04_gaar_gatos = castracao_mensal_gaar_valor($anocastra, '04', 'Felina', $connect);
			     $valor_mensal05_gaar_gatos = castracao_mensal_gaar_valor($anocastra, '05', 'Felina', $connect);
			     $valor_mensal06_gaar_gatos = castracao_mensal_gaar_valor($anocastra, '06', 'Felina', $connect);
			     $valor_mensal07_gaar_gatos = castracao_mensal_gaar_valor($anocastra, '07', 'Felina', $connect);
			     $valor_mensal08_gaar_gatos = castracao_mensal_gaar_valor($anocastra, '08', 'Felina', $connect);
			     $valor_mensal09_gaar_gatos = castracao_mensal_gaar_valor($anocastra, '09', 'Felina', $connect);
			     $valor_mensal10_gaar_gatos = castracao_mensal_gaar_valor($anocastra, '10', 'Felina', $connect);
			     $valor_mensal11_gaar_gatos = castracao_mensal_gaar_valor($anocastra, '11', 'Felina', $connect);
			     $valor_mensal12_gaar_gatos = castracao_mensal_gaar_valor($anocastra, '12', 'Felina', $connect);
			     
			     $total_valor_gaar_caes = floatval ($valor_mensal01_gaar_caes) + floatval ($valor_mensal02_gaar_caes) + floatval ($valor_mensal03_gaar_caes) + floatval ($valor_mensal04_gaar_caes) + floatval ($valor_mensal05_gaar_caes) + floatval ($valor_mensal06_gaar_caes) + floatval ($valor_mensal07_gaar_caes) + floatval ($valor_mensal08_gaar_caes) + floatval ($valor_mensal09_gaar_caes) + floatval ($valor_mensal10_gaar_caes) + floatval ($valor_mensal11_gaar_caes) + floatval ($valor_mensal12_gaar_caes);
			     $total_valor_gaar_gatos = floatval ($valor_mensal01_gaar_gatos) + floatval ($valor_mensal02_gaar_gatos) + floatval ($valor_mensal03_gaar_gatos) + floatval ($valor_mensal04_gaar_gatos) + floatval ($valor_mensal05_gaar_gatos) + floatval ($valor_mensal06_gaar_gatos) + floatval ($valor_mensal07_gaar_gatos) + floatval ($valor_mensal08_gaar_gatos) + floatval ($valor_mensal09_gaar_gatos) + floatval ($valor_mensal10_gaar_gatos) + floatval ($valor_mensal11_gaar_gatos) + floatval ($valor_mensal12_gaar_gatos);
			     
			     //$media_valor_caes = intval($total_valor_gaar_caes) / intval($total_castrados_procedi_caes);
			     //$media_valor_gatos = intval($total_valor_gaar_gatos) / intval($total_castrados_procedi_gatos);
			     
				 $total_castrados_procedi_caes = castracao_total_caes($anocastra,$connect);
				 $total_castrados_procedi_caes_machos = castracao_total_caes_machos($anocastra,$connect);
				 $total_castrados_procedi_caes_femeas = castracao_total_caes_femeas($anocastra,$connect);
				 $total_castrados_procedi_gatos = castracao_total_gatos($anocastra,$connect);
				 $total_castrados_procedi_gatos_machos = castracao_total_gatos_machos($anocastra,$connect);
				 $total_castrados_procedi_gatos_femeas = castracao_total_gatos_femeas($anocastra,$connect);
				 
				 $mes01_castrados_caes = castracao_mensal_caes($anocastra,'01',$connect);
				 $mes01_castrados_caes_machos = castracao_mensal_caes_machos($anocastra,'01',$connect);
				 $mes01_castrados_caes_femeas = castracao_mensal_caes_femeas($anocastra,'01',$connect);
				 $mes01_castrados_gatos = castracao_mensal_gatos($anocastra,'01',$connect);
				 $mes01_castrados_gatos_machos = castracao_mensal_gatos_machos($anocastra,'01',$connect);
				 $mes01_castrados_gatos_femeas = castracao_mensal_gatos_femeas($anocastra,'01',$connect);
				 
				 $mes02_castrados_caes = castracao_mensal_caes($anocastra,'02',$connect);
				 $mes02_castrados_caes_machos = castracao_mensal_caes_machos($anocastra,'02',$connect);
				 $mes02_castrados_caes_femeas = castracao_mensal_caes_femeas($anocastra,'02',$connect);
				 $mes02_castrados_gatos = castracao_mensal_gatos($anocastra,'02',$connect);
				 $mes02_castrados_gatos_machos = castracao_mensal_gatos_machos($anocastra,'02',$connect);
				 $mes02_castrados_gatos_femeas = castracao_mensal_gatos_femeas($anocastra,'02',$connect);
				 
				 $mes03_castrados_caes = castracao_mensal_caes($anocastra,'03',$connect);
				 $mes03_castrados_caes_machos = castracao_mensal_caes_machos($anocastra,'03',$connect);
				 $mes03_castrados_caes_femeas = castracao_mensal_caes_femeas($anocastra,'03',$connect);
				 $mes03_castrados_gatos = castracao_mensal_gatos($anocastra,'03',$connect);
				 $mes03_castrados_gatos_machos = castracao_mensal_gatos_machos($anocastra,'03',$connect);
				 $mes03_castrados_gatos_femeas = castracao_mensal_gatos_femeas($anocastra,'03',$connect);
				 
				 $mes04_castrados_caes = castracao_mensal_caes($anocastra,'04',$connect);
				 $mes04_castrados_caes_machos = castracao_mensal_caes_machos($anocastra,'04',$connect);
				 $mes04_castrados_caes_femeas = castracao_mensal_caes_femeas($anocastra,'04',$connect);
				 $mes04_castrados_gatos = castracao_mensal_gatos($anocastra,'04',$connect);
				 $mes04_castrados_gatos_machos = castracao_mensal_gatos_machos($anocastra,'04',$connect);
				 $mes04_castrados_gatos_femeas = castracao_mensal_gatos_femeas($anocastra,'04',$connect);

				 $mes05_castrados_caes = castracao_mensal_caes($anocastra,'05',$connect);
				 $mes05_castrados_caes_machos = castracao_mensal_caes_machos($anocastra,'05',$connect);
				 $mes05_castrados_caes_femeas = castracao_mensal_caes_femeas($anocastra,'05',$connect);
				 $mes05_castrados_gatos = castracao_mensal_gatos($anocastra,'05',$connect);
				 $mes05_castrados_gatos_machos = castracao_mensal_gatos_machos($anocastra,'05',$connect);
				 $mes05_castrados_gatos_femeas = castracao_mensal_gatos_femeas($anocastra,'05',$connect);
				 
				 $mes06_castrados_caes = castracao_mensal_caes($anocastra,'06',$connect);
				 $mes06_castrados_caes_machos = castracao_mensal_caes_machos($anocastra,'06',$connect);
				 $mes06_castrados_caes_femeas = castracao_mensal_caes_femeas($anocastra,'06',$connect);
				 $mes06_castrados_gatos = castracao_mensal_gatos($anocastra,'06',$connect);
				 $mes06_castrados_gatos_machos = castracao_mensal_gatos_machos($anocastra,'06',$connect);
				 $mes06_castrados_gatos_femeas = castracao_mensal_gatos_femeas($anocastra,'06',$connect);
				 
				 $mes07_castrados_caes = castracao_mensal_caes($anocastra,'07',$connect);
				 $mes07_castrados_caes_machos = castracao_mensal_caes_machos($anocastra,'07',$connect);
				 $mes07_castrados_caes_femeas = castracao_mensal_caes_femeas($anocastra,'07',$connect);
				 $mes07_castrados_gatos = castracao_mensal_gatos($anocastra,'07',$connect);
				 $mes07_castrados_gatos_machos = castracao_mensal_gatos_machos($anocastra,'07',$connect);
				 $mes07_castrados_gatos_femeas = castracao_mensal_gatos_femeas($anocastra,'07',$connect);
				 
				 $mes08_castrados_caes = castracao_mensal_caes($anocastra,'08',$connect);
				 $mes08_castrados_caes_machos = castracao_mensal_caes_machos($anocastra,'08',$connect);
				 $mes08_castrados_caes_femeas = castracao_mensal_caes_femeas($anocastra,'08',$connect);
				 $mes08_castrados_gatos = castracao_mensal_gatos($anocastra,'08',$connect);
				 $mes08_castrados_gatos_machos = castracao_mensal_gatos_machos($anocastra,'08',$connect);
				 $mes08_castrados_gatos_femeas = castracao_mensal_gatos_femeas($anocastra,'08',$connect);
				 
				 $mes09_castrados_caes = castracao_mensal_caes($anocastra,'09',$connect);
				 $mes09_castrados_caes_machos = castracao_mensal_caes_machos($anocastra,'09',$connect);
				 $mes09_castrados_caes_femeas = castracao_mensal_caes_femeas($anocastra,'09',$connect);
				 $mes09_castrados_gatos = castracao_mensal_gatos($anocastra,'09',$connect);
				 $mes09_castrados_gatos_machos = castracao_mensal_gatos_machos($anocastra,'09',$connect);
				 $mes09_castrados_gatos_femeas = castracao_mensal_gatos_femeas($anocastra,'09',$connect);
				 
				 $mes10_castrados_caes = castracao_mensal_caes($anocastra,'10',$connect);
				 $mes10_castrados_caes_machos = castracao_mensal_caes_machos($anocastra,'10',$connect);
				 $mes10_castrados_caes_femeas = castracao_mensal_caes_femeas($anocastra,'10',$connect);
				 $mes10_castrados_gatos = castracao_mensal_gatos($anocastra,'10',$connect);
				 $mes10_castrados_gatos_machos = castracao_mensal_gatos_machos($anocastra,'10',$connect);
				 $mes10_castrados_gatos_femeas = castracao_mensal_gatos_femeas($anocastra,'10',$connect);

				 $mes11_castrados_caes = castracao_mensal_caes($anocastra,'11',$connect);
				 $mes11_castrados_caes_machos = castracao_mensal_caes_machos($anocastra,'11',$connect);
				 $mes11_castrados_caes_femeas = castracao_mensal_caes_femeas($anocastra,'11',$connect);
				 $mes11_castrados_gatos = castracao_mensal_gatos($anocastra,'11',$connect);
				 $mes11_castrados_gatos_machos = castracao_mensal_gatos_machos($anocastra,'11',$connect);
				 $mes11_castrados_gatos_femeas = castracao_mensal_gatos_femeas($anocastra,'11',$connect);

				 $mes12_castrados_caes = castracao_mensal_caes($anocastra,'12',$connect);
				 $mes12_castrados_caes_machos = castracao_mensal_caes_machos($anocastra,'12',$connect);
				 $mes12_castrados_caes_femeas = castracao_mensal_caes_femeas($anocastra,'12',$connect);
				 $mes12_castrados_gatos = castracao_mensal_gatos($anocastra,'12',$connect);
				 $mes12_castrados_gatos_machos = castracao_mensal_gatos_machos($anocastra,'12',$connect);
				 $mes12_castrados_gatos_femeas = castracao_mensal_gatos_femeas($anocastra,'12',$connect);
				 
				 
				 echo "<center>
					       <h4> CASTRAÇÕES </h4><br>
					       <p> Os números equivalem as castrações realizadas para os animais do GAAR e terceiros que estão cadastrados no sistema. Sujeito à alteração.</p><br>
					       
					       <table class='table' >
    						  <thead class='thead-dark'>
    						  <tr>
    							<th scope='col' colspan='2'>&nbsp</th>
							    <th scope='col' colspan='2'>CÃES</th>
    							<th scope='col' colspan='2'>GATOS</th>
    						   </tr>
    						   </thead>
    						   <thead class='thead-light'>
    						   <tr>
    							<th scope='col'>Ano</th>
    							<th scope='col'>Mês</th>
    							<th scope='col'>Qtde</th>
    							<th scope='col'>Valor</th>
    							<th scope='col'>Qtde</th>
    							<th scope='col'>Valor</th>
    						   </tr>
    						  </thead>
    						  <tbody>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Janeiro</th>
    							<td>".$mes01_castrados_caes."</td>
    							<td>R$".number_format($valor_mensal01_gaar_caes,2,',', '.')."</td>
    							<td>".$mes01_castrados_gatos."</td>
    							<td>R$".number_format($valor_mensal01_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						  <tr> 
    						    <th scope='row'>".$anocastra."</th>
    							<th scope='row'>Fevereiro</th>
    							<td>".$mes02_castrados_caes."</td>
    							<td>R$".number_format($valor_mensal02_gaar_caes,2,',', '.')."</td>
    							<td>".$mes02_castrados_gatos."</td>
    							<td>R$".number_format($valor_mensal02_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						  <tr> 
    						    <th scope='row'>".$anocastra."</th>
    							<th scope='row'>Março</th>
    							<td>".$mes03_castrados_caes."</td>
    							<td>R$".number_format($valor_mensal03_gaar_caes,2,',', '.')."</td>
    							<td>".$mes03_castrados_gatos."</td>
    							<td>R$".number_format($valor_mensal03_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Abril</th>
    							<td>".$mes04_castrados_caes."</td>
    							<td>R$".number_format($valor_mensal04_gaar_caes,2,',', '.')."</td>
    							<td>".$mes04_castrados_gatos."</td>
    							<td>R$".number_format($valor_mensal04_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Maio</th>
    							<td>".$mes05_castrados_caes."</td>
    							<td>R$".number_format($valor_mensal05_gaar_caes,2,',', '.')."</td>
    							<td>".$mes05_castrados_gatos."</td>
    							<td>R$".number_format($valor_mensal05_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Junho</th>
    							<td>".$mes06_castrados_caes."</td>
    							<td>R$".number_format($valor_mensal06_gaar_caes,2,',', '.')."</td>
    							<td>".$mes06_castrados_gatos."</td>
    							<td>R$".number_format($valor_mensal06_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Julho</th>
    							<td>".$mes07_castrados_caes."</td>
    							<td>R$".number_format($valor_mensal07_gaar_caes,2,',', '.')."</td>
    							<td>".$mes07_castrados_gatos."</td>
    							<td>R$".number_format($valor_mensal07_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Agosto</th>
    							<td>".$mes08_castrados_caes."</td>
    							<td>R$".number_format($valor_mensal08_gaar_caes,2,',', '.')."</td>
    							<td>".$mes08_castrados_gatos."</td>
    							<td>R$".number_format($valor_mensal08_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Setembro</th>
    							<td>".$mes09_castrados_caes."</td>
    							<td>R$".number_format($valor_mensal09_gaar_caes,2,',', '.')."</td>
    							<td>".$mes09_castrados_gatos."</td>
    							<td>R$".number_format($valor_mensal09_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Outubro</th>
    							<td>".$mes10_castrados_caes."</td>
    							<td>R$".number_format($valor_mensal10_gaar_caes,2,',', '.')."</td>
    							<td>".$mes10_castrados_gatos."</td>
    							<td>R$".number_format($valor_mensal10_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Novembro</th>
    							<td>".$mes11_castrados_caes."</td>
    							<td>R$".number_format($valor_mensal11_gaar_caes,2,',', '.')."</td>
    							<td>".$mes11_castrados_gatos."</td>
    							<td>R$".number_format($valor_mensal11_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Dezembro</th>
    							<td>".$mes12_castrados_caes."</td>
    							<td>R$".number_format($valor_mensal12_gaar_caes,2,',', '.')."</td>
    							<td>".$mes12_castrados_gatos."</td>
    							<td>R$".number_format($valor_mensal12_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						  </tbody>
    						 </table></center>
    						 <br>
    						 <table class='table' >
    						  <tbody>
    						  <tr> 
    							<th >Total de castrações caninas: </th>
    							<td>".$total_castrados_procedi_caes."</td>
    						  </tr>
    						  <tr> 
    							<th >Valor total de castrações caninas pagas pelo GAAR: </th>
    							<td>R$".number_format($total_valor_gaar_caes,2,',', '.')."</td>
    						  </tr>
    						  <tr> 
    							<td>&nbsp;</td>
    						  </tr>
    						  <tr>
    							<th >Total de castrações felinas: </th>
    							<td>".$total_castrados_procedi_gatos."</td>
    						  </tr>
    						  <tr> 
    							<th >Valor total de castrações felinas pagas pelo GAAR: </th>
    							<td>R$".number_format($total_valor_gaar_gatos,2,',', '.')."</td>
    						  </tr>
    						 </tbody>
    						 </table></center>	
						     <br><br>
						     <table class='table' >
    						  <thead class='thead-light'>
    						  <tr>
    							<th scope='col'>&nbsp</th>
    							<th scope='col'>&nbsp</th>
    							<th scope='col' colspan='2'><center>Canina</center></th>
    							<th scope='col' colspan='2'><center>Felina</center></th>
    						  </tr>
    						  <tr>
    							<th scope='col' colspan='1'>Ano</th>
    							<th scope='col' colspan='1'>Mês</th>
    							<th scope='col' colspan='1'>Machos</th>
    							<th scope='col' colspan='1'>Fêmeas</th>
    							<th scope='col' colspan='1'>Machos</th>
    							<th scope='col' colspan='1'>Fêmeas</th>
    						  </tr>
    						  </thead>
    						  <tbody>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Janeiro</th>
    							<td>".$mes01_castrados_caes_machos."</td>
    							<td>".$mes01_castrados_caes_femeas."</td>
    							<td>".$mes01_castrados_gatos_machos."</td>
    							<td>".$mes01_castrados_gatos_femeas."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Fevereiro</th>
    							<td>".$mes02_castrados_caes_machos."</td>
    							<td>".$mes02_castrados_caes_femeas."</td>
    							<td>".$mes02_castrados_gatos_machos."</td>
    							<td>".$mes02_castrados_gatos_femeas."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Março</th>
    							<td>".$mes03_castrados_caes_machos."</td>
    							<td>".$mes03_castrados_caes_femeas."</td>
    							<td>".$mes03_castrados_gatos_machos."</td>
    							<td>".$mes03_castrados_gatos_femeas."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Abril</th>
    							<td>".$mes04_castrados_caes_machos."</td>
    							<td>".$mes04_castrados_caes_femeas."</td>
    							<td>".$mes04_castrados_gatos_machos."</td>
    							<td>".$mes04_castrados_gatos_femeas."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Maio</th>
    							<td>".$mes05_castrados_caes_machos."</td>
    							<td>".$mes05_castrados_caes_femeas."</td>
    							<td>".$mes05_castrados_gatos_machos."</td>
    							<td>".$mes05_castrados_gatos_femeas."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Junho</th>
                                <td>".$mes06_castrados_caes_machos."</td>
    							<td>".$mes06_castrados_caes_femeas."</td>
    							<td>".$mes06_castrados_gatos_machos."</td>
    							<td>".$mes06_castrados_gatos_femeas."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Julho</th>
    							<td>".$mes07_castrados_caes_machos."</td>
    							<td>".$mes07_castrados_caes_femeas."</td>
    							<td>".$mes07_castrados_gatos_machos."</td>
    							<td>".$mes07_castrados_gatos_femeas."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Agosto</th>
    							<td>".$mes08_castrados_caes_machos."</td>
    							<td>".$mes08_castrados_caes_femeas."</td>
    							<td>".$mes08_castrados_gatos_machos."</td>
    							<td>".$mes08_castrados_gatos_femeas."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Setembro</th>
    							<td>".$mes09_castrados_caes_machos."</td>
    							<td>".$mes09_castrados_caes_femeas."</td>
    							<td>".$mes09_castrados_gatos_machos."</td>
    							<td>".$mes09_castrados_gatos_femeas."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Outubro</th>
    							<td>".$mes10_castrados_caes_machos."</td>
    							<td>".$mes10_castrados_caes_femeas."</td>
    							<td>".$mes10_castrados_gatos_machos."</td>
    							<td>".$mes10_castrados_gatos_femeas."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Novembro</th>
    							<td>".$mes11_castrados_caes_machos."</td>
    							<td>".$mes11_castrados_caes_femeas."</td>
    							<td>".$mes11_castrados_gatos_machos."</td>
    							<td>".$mes11_castrados_gatos_femeas."</td>
    						  </tr>
    						  <tr> 
    							<th scope='row'>".$anocastra."</th>
    							<th scope='row'>Dezembro</th>
    							<td>".$mes12_castrados_caes_machos."</td>
    							<td>".$mes12_castrados_caes_femeas."</td>
    							<td>".$mes12_castrados_gatos_machos."</td>
    							<td>".$mes12_castrados_gatos_femeas."</td>
    						  </tr>
    						  <tr class='thead-light'>
    							<th scope='col'>TOTAL</th>
    							<th scope='col'>&nbsp</th>
    							<th scope='col'>".$total_castrados_procedi_caes_machos."</th>
    							<th scope='col'>".$total_castrados_procedi_caes_femeas."</th>
    							<th scope='col'>".$total_castrados_procedi_gatos_machos."</th>
    							<th scope='col'>".$total_castrados_procedi_gatos_femeas."</th>
    						   </tr>
    						  </tbody>
    						 </table></center>
						 ";
						$queryprotetora = "SELECT * FROM PROTETORES WHERE PROTETOR='SIM' AND SITUACAO='ATIVO'";
						$resultprotetora = mysqli_query($connect,$queryprotetora);
						
						echo "<center>
						    <BR>
					       <h5> CASTRAÇõES POR PROTETOR</h5><br>
					       <p> Procedimentos autorizados para os protetores que estão ativos cadastrados no sistema. Sujeito à alteração.</p><br>
					       <table class='table' >
    						  <thead class='thead-light'>
    						  <tr>
    							<th scope='col'>Nome</th>
    							<th scope='col'>Área de atuação</th>
    							<th scope='col' colspan='1'>Cães</th>
    							<th scope='col' colspan='1'>Gatos</th>
    							<th scope='col' colspan='1'>Valor de ajuda</th>
    						  </tr>
    						  </thead>
    						  <tbody>";
            					while ($fetchprotetor = mysqli_fetch_row($resultprotetora)) {
            					                $idprotetora = $fetchprotetor[0];
                    					        $nome_protetora = $fetchprotetor[1];
                    					        $area_atuacao = $fetchprotetor[8];
                    					        $qtd_caes = castracao_mensal_especie_protetor($anocastra,$nome_protetora, 'Canina', $connect);
                				                $qtd_gatos = castracao_mensal_especie_protetor($anocastra,$nome_protetora, 'Felina', $connect);
                				                $valor_ajuda_protetor = castracao_mensal_protetor_valor($anocastra, $idprotetora, $connect);
                				                echo "<tr>";
                				                echo "<td>".$nome_protetora."</td>";
                				                echo "<td>".$area_atuacao."</td>";
                				                echo "<td>".$qtd_caes."</td>";
            							        echo "<td>".$qtd_gatos."</td>";
            							        echo "<td>R$".number_format($valor_ajuda_protetor,2,',', '.')."</td>";
            							        echo "</tr>";
    							 } 
    					echo "  
    					        </tbody>
    						 </table></center>";		
    						 
						//$queryprocedi = "SELECT * FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND DATA LIKE '".$anocastra."-".$mescastra."-%' ORDER BY DATA ASC";
						$queryprocedi = "SELECT * FROM AGENDAMENTO WHERE PROCEDIMENTO = 'Castração' AND DATA_AG LIKE '".$anocastra."-%' AND ATIVO <> 'CANCELADO' ORDER BY DATA_AG ASC";
        				$resultprocedi = mysqli_query($connect,$queryprocedi);
        				
        				echo "<center>
        				   <div id='detalhes_procedi' class='d-print-none'>
					       <h5> DETALHES DOS PROCEDIMENTOS</h5><br>
					       <table class='table' >
    						  <thead class='thead-light'>
    						  <tr>
    							<th scope='col'>Data</th>
    							<th scope='col'>Animal</th>
    							<th scope='col'>Espécie</th>
    							<th scope='col'>Sexo</th>
    							<th scope='col'>Clínica ou veterinário</th>
    							<th scope='col'>Código</th>
    						  </thead>
    						  <tbody>";
        				
        				while ($fetchprocedi = mysqli_fetch_row($resultprocedi)) {
            					$dataprocedi = $fetchprocedi[1];
            					$nomeanimalprocedi = $fetchprocedi[3];
            					$especieprocedi = $fetchprocedi[4];
            					$sexoprocedi = $fetchprocedi[5];
            					$tipoprocedi = $fetchprocedi[20];
            					$clinicaprocedi = $fetchprocedi[19];
            					$codigoprocedi = $fetchprocedi[0];
            					
            					$ano_procedi = substr($dataprocedi,0,4);
                		        $mes_procedi = substr($dataprocedi,5,2);
                		        $dia_procedi = substr($dataprocedi,8,2);
                		        
                		        $queryvet = "SELECT * FROM CLINICAS WHERE ID='$clinicaprocedi'";
                            	$selectvet = mysqli_query($connect,$queryvet);
                            	$rc = mysqli_fetch_row($selectvet);
                            	$reccount = mysqli_num_rows($selectvet);
                                $nomevet = $rc[1];
            					
            					echo "<tr>
            					        <td>".$dia_procedi."/".$mes_procedi."/".$ano_procedi."</td>
            					        <td>".$nomeanimalprocedi."</td>
            					        <td>".$especieprocedi."</td>
            					        <td>".$sexoprocedi."</td>
            					        <td>".$nomevet."</td>
            					        <td>".$codigoprocedi."</td>
                                    </tr>
            					";
        				}
        				echo "</tbody>
						 </table>
						 </div></center>";
						 
			  }
			if ($anocastra == '' && $mescastra == ''){	
				 $castrados_2014_caes = castrados_total_caes('2014',$connect);
				 $castrados_2014_gatos = castrados_total_gatos('2014',$connect);
				 $castrados_2015_caes = castrados_total_caes('2015',$connect);
				 $castrados_2015_gatos = castrados_total_gatos('2015',$connect);
				 $castrados_2016_caes = castrados_total_caes('2016',$connect);
				 $castrados_2016_gatos = castrados_total_gatos('2016',$connect);
				 $castrados_2017_caes = castrados_total_caes('2017',$connect);
				 $castrados_2017_gatos = castrados_total_gatos('2017',$connect);
				 $castrados_2018_caes = castrados_total_caes('2018',$connect);
				 $castrados_2018_gatos = castrados_total_gatos('2018',$connect);
				 $castrados_2019_caes = castrados_total_caes('2019',$connect);
				 $castrados_2019_gatos = castrados_total_gatos('2019',$connect);
				 $castrados_2020_caes = castrados_total_caes('2020',$connect);
				 $castrados_2020_gatos = castrados_total_gatos('2020',$connect);
				 $castrados_2021_caes = castrados_total_caes('2021',$connect);
				 $castrados_2021_gatos = castrados_total_gatos('2021',$connect);		 
				 
				echo "<center>
					       <h4> CASTRAÇÕES</h4><br>
					       <p> Os números equivalem as castrações realizadas para os animais do GAAR e terceiros que estão cadastrados no sistema. Sujeito à alteração.</p><br>
					       <table class='table' >
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Ano</th>
							<th scope='col'>Mês</th>
							<th scope='col'>Cães</th>
							<th scope='col'>Gatos</th>
						  </thead>
						  <tbody>
						  <tr> 
							<th scope='row'>2014</th>
							<td>".$castrados_2014_caes."</td>
							<td>".$castrados_2014_gatos."</td>
						  </tr>
						  <tr>
							<th scope='row'>2015</th>
							<td>".$castrados_2015_caes."</td>
							<td>".$castrados_2015_gatos."</td>
						  </tr>
						  <tr>
							<th scope='row'>2016</th>
							<td>".$castrados_2016_caes."</td>
							<td>".$castrados_2016_gatos."</td>
						  </tr>
						  <tr>
							<th scope='row'>2017</th>
							<td>".$castrados_2017_caes."</td>
							<td>".$castrados_2017_gatos."</td>
						  </tr>
						  <tr>
							<th scope='row'>2018</th>
							<td>".$castrados_2018_caes."</td>
							<td>".$castrados_2018_gatos."</td>
						  </tr>
						  <tr>
							<th scope='row'>2019</th>
							<td>".$castrados_2019_caes."</td>
							<td>".$castrados_2019_gatos."</td>
						  </tr>
						  <tr>
							<th scope='row'>2020</th>
							<td>".$castrados_2020_caes."</td>
							<td>".$castrados_2020_gatos."</td>
						  </tr>
						  <tr>
							<th scope='row'>2021</th>
							<td>".$castrados_2021_caes."</td>
							<td>".$castrados_2021_gatos."</td>
						  </tr>
						</table></center>";
						
						//$queryprocedi = "SELECT * FROM PROCEDIMENTOS WHERE TIPO_PROC = 'Castração' AND STATUS_PROC='Aprovado' AND DATA LIKE '".$anocastra."-".$mescastra."-%' ORDER BY DATA ASC";
						$queryprocedi = "SELECT * FROM AGENDAMENTO WHERE PROCEDIMENTO = 'Castração' AND ATIVO <> 'CANCELADO' ORDER BY DATA_AG ASC";
        				$resultprocedi = mysqli_query($connect,$queryprocedi);
        				
        				echo "<center>
					       <h5> DETALHES DOS PROCEDIMENTOS</h5><br>
					       <table class='table' >
    						  <thead class='thead-light'>
    						  <tr>
    							<th scope='col'>Data</th>
    							<th scope='col'>Animal</th>
    							<th scope='col'>Espécie</th>
    							<th scope='col'>Sexo</th>
    							<th scope='col'>Tipo de procedimento</th>
    							<th scope='col'>Clínica ou veterinário</th>
    						  </thead>
    						  <tbody>";
        				
        				while ($fetchprocedi = mysqli_fetch_row($resultprocedi)) {
            					$dataprocedi = $fetchprocedi[1];
            					$nomeanimalprocedi = $fetchprocedi[3];
            					$especieprocedi = $fetchprocedi[4];
            					$sexoprocedi = $fetchprocedi[5];
            					$tipoprocedi = $fetchprocedi[20];
            					$clinicaprocedi = $fetchprocedi[19];
            					
            					$ano_procedi = substr($dataprocedi,0,4);
                		        $mes_procedi = substr($dataprocedi,5,2);
                		        $dia_procedi = substr($dataprocedi,8,2);
                		        
                		        $queryvet = "SELECT * FROM CLINICAS WHERE ID='$idvet'";
                            	$selectvet = mysqli_query($connect,$queryvet);
                            	$rc = mysqli_fetch_row($selectvet);
                            	$reccount = mysqli_num_rows($selectvet);
                                $nomevet = $rc[1];
            					
            					echo "<tr>
            					        <td>".$dia_procedi."/".$mes_procedi."/".$ano_procedi."</td>
            					        <td>".$nomeanimalprocedi."</td>
            					        <td>".$especieprocedi."</td>
            					        <td>".$sexoprocedi."</td>
            					        <td>".$volgaarprocedi."</td>
            					        <td>".$tipoprocedi."</td>
            					        <td>".$nomevet."</td>
                                    </tr>
            					";
        				}
        				echo "</tbody>
						 </table></center>";
				
			  }
			break;
			
		case 'Animais disponíveis':
	        switch ($foto){
	           case 'Sim':
	             $querylt = "SELECT * FROM ANIMAL WHERE ADOTADO ='Disponível' AND DIVULGAR_COMO = 'GAAR' AND FOTO != '' ORDER BY nome_animal ASC";
	             break;
	           case 'Não':
	             $querylt = "SELECT * FROM ANIMAL WHERE ADOTADO ='Disponível' AND DIVULGAR_COMO = 'GAAR' AND FOTO = '' ORDER BY nome_animal ASC";
	             break;
	           case "Todos":
	             $querylt = "SELECT * FROM ANIMAL WHERE ADOTADO ='Disponível' AND (DIVULGAR_COMO = 'GAAR' OR DIVULGAR_COMO = 'Não divulgar') ORDER BY nome_animal ASC";
	             break;
	           default:
	             $querylt = "";
	             break;
	        }
	        
            if ($nomeresp <> "") {
			   $querylt = "SELECT * FROM ANIMAL WHERE RESPONSAVEL='".$nomeresp."' AND ADOTADO='Disponível' ORDER BY nome_animal ASC";
            }
	       
    		  $resultlt = mysqli_query($connect,$querylt); 
    		  $reccount = mysqli_num_rows($resultlt);
				  
				  $sumdog = 0;
				  $sumcat = 0;
				  $sumdisp = 0;
				  $sumnaodisp = 0;
				  
				  if ($reccount == 0) {
            			echo "Nenhum animal encontrado<br><br>";
            		}else{ 
            			echo "<center><h4>Animais disponíveis para adoção responsável</h4><br>
            			<table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
						    <th scope='col' colspan='3'>Dados do animal</th>
							<th scope='col' colspan='3'>Dados do lar temporário</th>
							<th scope='col' colspan='2'>Pesquisa externa</th>
							
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Nome</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Sexo</th>
							<th scope='col'>Data de entrada</th>
							<th scope='col'>Lar temporário</th>
							<th scope='col'>Responsável</th>
							<th scope='col'>Possui foto?</th>
							<th scope='col'>&nbsp;</th>
						  </thead>
						  <tbody>";
            			while ($fetch = mysqli_fetch_row($resultlt)) {
            					$nomeanimal = $fetch[1];
            					$especie = $fetch[2];
            					$sexo = $fetch[4];
            					$dtentradalt = $fetch[13];
            					$lt = $fetch[11];
            					$voluntario = $fetch[12];
            					$possuifoto = $fetch[16];
            					$divcomo = $fetch[18];
            					switch ($especie){
            					    case 'Canina':
            					        $sumdog = intval($sumdog)  + 1;
            					        break;
                					case 'Felina': 
            					        $sumcat = intval($sumcat)  + 1;
            					        if ($divcomo == 'Não divulgar' ){
            					            $sumcatnaodisp = intval($sumcatnaodisp)  + 1;
            					        }
            					        break;
            					}
            					
            					echo "<tr> 
            							<th scope='row'>".$nomeanimal."</th>
            							<td>".$especie."</td>
            							<td>".$sexo."</td>
            							<td>".$dtentradalt."</td>
            							<td>".$lt."</td>
            							<td>".$voluntario."</td>";
            							if ($possuifoto ==''){
            							   echo "<td>Não</td>";
            							} else {
            							   echo "<td>Sim</td>"; 
            							}
            				     echo "<td><div class='d-print-none'><a href='formatualizapet.php?idanimal=".$fetch[0]."' class='btn btn-primary'>Atualizar</a></div></td>
            						   </tr>";
            			}
            			
            			$sumcat = intval($sumcat) - intval($sumcatnaodisp);
            			
            			echo "</tbody>
            			        </table>
            			        </center>
            			        
            			        <center>
                                        <h3>RESUMO</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                	    </thead>
                                    	<tbody>
                                    	<tr>
                        					<th scope='row'>Cães</th>
                        					<td>".$sumdog."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Gatos</th>
                        					<td>".$sumcat."</td>
                    					</tr>
                    					<tr>
                        					<th scope='row'>Gatos não disponíveis (para controle do CPG)</th>
                        					<td>".$sumcatnaodisp."</td>
                    					</tr>
                    					</tbody>
                    				</table>";
            			
            			$assunto = "Relatório dos animais disponíveis";
            			
            			$message = "<center><h4>Animais disponíveis para adoção responsável</h4><br>
            			<table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
						    <th scope='col' colspan='3'>Dados do animal</th>
							<th scope='col' colspan='3'>Dados do lar temporário</th>
							<th scope='col' colspan='1'>Pesquisa externa</th>
							
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Nome</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Sexo</th>
							<th scope='col'>Data de entrada</th>
							<th scope='col'>Lar temporário</th>
							<th scope='col'>Responsável</th>
							<th scope='col'>Possui foto?</th>
						  </thead>
						  <tbody>";
            			while ($fetch = mysqli_fetch_row($resultlt)) {
            					$nomeanimal = $fetch[1];
            					$especie = $fetch[2];
            					$sexo = $fetch[4];
            					$dtentradalt = $fetch[13];
            					$lt = $fetch[11];
            					$voluntario = $fetch[12];
            				    $message .= "echo '<tr> 
            							<th scope='row'>".$nomeanimal."</th>
            							<td>".$especie."</td>
            							<td>".$sexo."</td>
            							<td>".$dtentradalt."</td>
            							<td>".$lt."</td>
            							<td>".$voluntario."</td>";
                						   if ($possuifoto ==''){
                							   echo "<td>Não</td>";
                							} else {
                							   echo "<td>Sim</td>"; 
                							}
                						   echo "</tr>";
            			}
            			$message .= "echo '</tbody>
            			        </table></center>";
			}
		    break;
			          
        case 'Animais em lts':
			if ($lt == 'Nome do lt'){
				  $querylt = "SELECT * FROM ANIMAL WHERE ADOTADO ='Disponivel' AND DIVULGAR_COMO = 'GAAR' AND LAR_TEMPORARIO = '$nomelt' ORDER BY nome_animal";
			      $resultlt = mysqli_query($connect,$querylt); 
				  $reccount = mysqli_num_rows($resultlt);
				  
				  if ($reccount == 0) {
            			echo "Nenhum animal encontrado<br><br>";
            		}else{ 
            			echo "<center><h4>Animais disponíveis para adoção responsável</h4><br>
            			<table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
						    <th scope='col' colspan='3'>Dados do animal</th>
							<th scope='col' colspan='3'>Dados do lar temporário</th>
							<th scope='col' colspan='2'>&nbsp;</th>
							
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Nome</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Sexo</th>
							<th scope='col'>Data de entrada</th>
							<th scope='col'>Lar temporário</th>
							<th scope='col'>Responsável</th>
							<th scope='col'>&nbsp;</th>
						  </thead>
						  <tbody>";
            			while ($fetch = mysqli_fetch_row($resultlt)) {
            					$nomeanimal = $fetch[1];
            					$especie = $fetch[2];
            					$sexo = $fetch[4];
            					$dtentradalt = $fetch[13];
            					$lt = $fetch[11];
            					$voluntario = $fetch[12];
            					
            					$ano_entrada = substr($dtentradalt,0,4);
		                        $mes_entrada = substr($dtentradalt,5,2);
		                        $dia_entrada = substr($dtentradalt,8,2);
		    
            					echo "<tr> 
            							<th scope='row'>".$nomeanimal."</th>
            							<td>".$especie."</td>
            							<td>".$sexo."</td>
            							<td>".$dia_entrada."/".$mes_entrada."/".$ano_entrada."</td>
            							<td>".$lt."</td>
            							<td>".$voluntario."</td>
            					        <td><div class='d-print-none'><a href='formatualizapet.php?idanimal=".$fetch[0]."' class='btn btn-primary'>Atualizar</a></div></td>
            						    </tr>";
            			}
            			echo "</tbody>
            			        </table></center>";
            			
            			$assunto = "Relatório dos animais disponíveis";
            			
            			$message = "<center><h4>Animais disponíveis para adoção responsável</h4><br>
            			<table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
						    <th scope='col' colspan='3'>Dados do animal</th>
							<th scope='col' colspan='3'>Dados do lar temporário</th>
							<th scope='col' colspan='1'>&nbsp;</th>
							
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Nome</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Sexo</th>
							<th scope='col'>Data de entrada</th>
							<th scope='col'>Lar temporário</th>
							<th scope='col'>Responsável</th>
						  </thead>
						  <tbody>";
            			while ($fetch = mysqli_fetch_row($resultlt)) {
            					$nomeanimal = $fetch[1];
            					$especie = $fetch[2];
            					$sexo = $fetch[4];
            					$dtentradalt = $fetch[13];
            					$lt = $fetch[11];
            					$voluntario = $fetch[12];
            				    $message .= "echo '<tr> 
            							<th scope='row'>".$nomeanimal."</th>
            							<td>".$especie."</td>
            							<td>".$sexo."</td>
            							<td>".$dtentradalt."</td>
            							<td>".$lt."</td>
            							<td>".$voluntario."</td>
                						</tr>";
            			}
            			$message .= "echo '</tbody>
            			        </table></center>";
			    }
			}
			if ($lt == 'Quantidade'){
				  $querylt = "SELECT * FROM LT WHERE ATIVO='Sim' ORDER BY LAR_TEMPORARIO";
			      $resultlt = mysqli_query($connect,$querylt); 
				  $reccount = mysqli_num_rows($resultlt);
				  
				  $summacho = 0;
				  $sumfemea = 0;
				  
				  if ($reccount == 0) {
            			echo "Nenhum animal encontrado<br><br>";
            		}else{ 
            			echo "<center><h4>Quantidade de animais disponíveis</h4><br>
            			<table class='table' >
						  <thead class='thead-light'>
						  <tr>
						    <th scope='col'>Lar temporário</th>
							<th scope='col'>Responsável</th>
							<th scope='col'>Cães</th>
							<th scope='col'>Gatos</th>
							<th scope='col' colspan='2'>Ativo?</th>
						  </thead>
						  <tbody>";
            			while ($fetch = mysqli_fetch_row($resultlt)) {
            			        $id = $fetch[0];
            					$lt = $fetch[1];
            					$caes = $fetch[9];
            					$gatos = $fetch[10];
            					$voluntario = $fetch[12];
            					$ativo = $fetch[18];
            					echo "<tr> 
            							<th scope='row'>".$lt."</th>
            							<td>".$voluntario."</td>
            							<td>".$caes."</td>
            							<td>".$gatos."</td>
            							<td>".$ativo."</td>";
            							if ($ativo ='Sim') {
            							    echo "<td><a href='ativarlt.php?id=".$id."&ativo=Não' class='btn btn-primary'>Desativar</a>&nbsp;</td>";   
            							} else {
            							    echo "<td><a href='ativarlt.php?id=".$id."&ativo=Sim' class='btn btn-primary'>Ativar</a>&nbsp;</td>";   
            							}
            							
            						   echo "</tr>";
            			}
            			echo "</tbody>
            			        </table></center>";
            			
            			$assunto = "Relatório dos animais disponíveis";
            			
            			$message = "<center><h4>Animais disponíveis para adoção responsável</h4><br>
            			<table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
						    <th scope='col' colspan='3'>Dados do animal</th>
							<th scope='col' colspan='3'>Dados do lar temporário</th>
							<th scope='col' colspan='1'>&nbsp;</th>
							
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Nome</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Sexo</th>
							<th scope='col'>Data de entrada</th>
							<th scope='col'>Lar temporário</th>
							<th scope='col'>Responsável</th>
						  </thead>
						  <tbody>";
            			while ($fetch = mysqli_fetch_row($resultlt)) {
            					$nomeanimal = $fetch[1];
            					$especie = $fetch[2];
            					$sexo = $fetch[4];
            					$dtentradalt = $fetch[13];
            					$lt = $fetch[11];
            					$voluntario = $fetch[12];
            					$ano_entrada = substr($dtentradalt,0,4);
		                        $mes_entrada = substr($dtentradalt,5,2);
		                        $dia_entrada = substr($dtentradalt,8,2);
		                        
            				    $message .= "echo '<tr> 
            							<th scope='row'>".$nomeanimal."</th>
            							<td>".$especie."</td>
            							<td>".$sexo."</td>
            							<td>".$dia_entrada."/".$mes_entrada."/".$ano_entrada."</td>
            							<td>".$lt."</td>
            							<td>".$voluntario."</td>
                						</tr>";
            			}
            			$message .= "echo '</tbody>
            			        </table></center>";
			    }
			}
			if ($lt == 'Espécie Canina'){
			      if ($selectstatusespeciecanina <>"") {
			        $queryltespeciecanina = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO = 'GAAR' AND ESPECIE = 'Canina' AND ADOTADO='$selectstatusespeciecanina' ORDER BY NOME_ANIMAL ASC";   
			      } else {
			        $queryltespeciecanina = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO = 'GAAR' AND ESPECIE = 'Canina' ORDER BY NOME_ANIMAL ASC";    
			      }
				  
			      $resultltespeciecanina = mysqli_query($connect,$queryltespeciecanina); 
				  $reccountespeciecanina = mysqli_num_rows($resultltespeciecanina);
				  
				  $sumdog = 0;
				  $sumcat = 0;
				  $summacho = 0;
				  $sumfemea = 0;
				  
				  if ($reccountespeciecanina == 0) {
            			echo "Nenhum animal encontrado<br><br>";
            		}else{ 
            		    echo "<br>selectstatusespeciecanina: ".$selectstatusespeciecanina;
            		    echo "<br>query: ".$queryltespeciecanina;
            		    echo "<br> result: ".$reccountespeciecanina;
            			echo "<center><h4>Cães disponíveis para adoção</h4><br>
            			<table class='table' >
						  <thead class='thead-light'>
						  <tr>
						    <th scope='col'>Nome do animal</th>
						    <th scope='col'>Sexo</th>
						    <th scope='col'>Lar temporário</th>
						    <th scope='col'>Responsável</th>
						    <th scope='col'>Ração consumida (kg)</th>
						    <th scope='col'>Valor mensal</th>
							<th scope='col'>Status</th>
						  </thead>
						  <tbody>";
            			while ($fetchespeciecanina = mysqli_fetch_row($resultltespeciecanina)) {
            			        $nomedoanimalespeciecanina = $fetchespeciecanina[1];
            					$especieespeciecanina = $fetchespeciecanina[2];
            					$sexoespeciecanina = $fetchespeciecanina[4];
            					$ltespeciecanina = $fetchespeciecanina[11];
            					$voluntarioespeciecanina = $fetchespeciecanina[12];
            					$pesoespeciecanina = $fetchespeciecanina[28];
            					$statusespeciecanina = $fetchespeciecanina[10];
            					
            					$queryvalor = "SELECT VALOR_DIA FROM LT WHERE LAR_TEMPORARIO = '$lt'";
			                    $resultvalor = mysqli_query($connect,$queryvalor); 
			                    $rc = mysqli_fetch_row($resultvalor);
			                    $valor_dia = $rc[0];
			                    
			                    //echo "<br> valor dia: ".$valor_dia;
            					
            					if ($peso >=5 && $peso <10) {
            					    $gramas = 0.100;
            					}
            					if ($peso >=10 && $peso <15) {
            					    $gramas = 0.130;
            					}
            					if ($peso >=15 && $peso <20) {
            					    $gramas = 0.200;
            					}
            					if ($peso >=20 && $peso <25) {
            					    $gramas = 0.250;
            					}
            					if ($peso >=25) {
            					    $gramas = 0.320;
            					}
            					
            					$dtatu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);
            					$dtinicial_jul = gregoriantojd($mes_atu,$dia01,$ano_atu);
            					
            					$dias = intval($dtatu_jul) - intval($dtinicial_jul);
            					
            					$qtde_racao = $gramas * $dias;
            					
            					$valor_mensal = $dias * floatval($valor_dia);
            					
            					echo "<tr> 
            							<th scope='row'>".$nomedoanimalespeciecanina."</th>
            							<td>".$sexoespeciecanina."</td>
            							<td>".$ltespeciecanina."</td>
            							<td>".$voluntarioespeciecanina."</td>
            							<td>".$qtde_racaoespeciecanina."</td>
            							<td>".number_format($valor_mensal,2,',', '.')."</td>
            							<td>".$statusespeciecanina."</td>
            							
            						 </tr>";
            			}
            			echo "</tbody>
            			        </table><br>
            			        ".$reccountespeciecanina." animais encontrados.</center>";
            			
            			$assunto = "Relatório dos animais disponíveis";
            			
            			$message = "<center><h4>Animais disponíveis para adoção responsável</h4><br>
            			<table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
						    <th scope='col' colspan='3'>Dados do animal</th>
							<th scope='col' colspan='3'>Dados do lar temporário</th>
							<th scope='col' colspan='1'>&nbsp;</th>
							
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Nome</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Sexo</th>
							<th scope='col'>Data de entrada</th>
							<th scope='col'>Lar temporário</th>
							<th scope='col'>Responsável</th>
						  </thead>
						  <tbody>";
            			while ($fetch = mysqli_fetch_row($resultlt)) {
            					$nomeanimal = $fetch[1];
            					$especie = $fetch[2];
            					$sexo = $fetch[4];
            					$dtentradalt = $fetch[13];
            					$lt = $fetch[11];
            					$voluntario = $fetch[12];
            				    $message .= "echo '<tr> 
            							<th scope='row'>".$nomeanimal."</th>
            							<td>".$especie."</td>
            							<td>".$sexo."</td>
            							<td>".$dtentradalt."</td>
            							<td>".$lt."</td>
            							<td>".$voluntario."</td>
                						</tr>";
            			}
            			$message .= "echo '</tbody>
            			        </table><br>
            			        ".$reccountespeciecanina." animais encontrados.</center>";
			    }
			}
			if ($lt == 'Espécie Felina'){
			      if ($selectstatusespeciefelina <> ""){
			        $querylt = "SELECT * FROM ANIMAL WHERE ADOTADO NOT LIKE '%Adotado%' AND ADOTADO <> 'Óbito' AND DIVULGAR_COMO = 'GAAR' AND ESPECIE = 'Felina' AND ADOTADO='".$selectstatusespeciefelina."' ORDER BY NOME_ANIMAL ASC";    
			      } else {
			          $querylt = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO = 'GAAR' AND ESPECIE = 'Felina' ORDER BY NOME_ANIMAL ASC";    
			      }
				  
			      $resultlt = mysqli_query($connect,$querylt); 
				  $reccountespeciefelina = mysqli_num_rows($resultlt);
				  
				  $sumdog = 0;
				  $sumcat = 0;
				  $summacho = 0;
				  $sumfemea = 0;
				  
				  if ($reccountespeciefelina == 0) {
            			echo "Nenhum animal encontrado<br><br>";
            		}else{ 
            			echo "<center><h4>Gatos dos lares temporários</h4><br>
            			<table class='table' >
						  <thead class='thead-light'>
						  <tr>
						    <th scope='col'>Nome do animal</th>
						    <th scope='col'>Sexo</th>
						    <th scope='col'>Lar temporário</th>
							<th scope='col'>Responsável</th>
							<th scope='col'>Status</th>

						  </thead>
						  <tbody>";
            			while ($fetch = mysqli_fetch_row($resultlt)) {
            			        $nomedoanimal = $fetch[1];
            					$especie = $fetch[2];
            					$sexo = $fetch[4];
            					$lt = $fetch[11];
            					$voluntario = $fetch[12];
            					$status = $fetch[10];
            					echo "<tr> 
            							<th scope='row'>".$nomedoanimal."</th>
            							<td>".$sexo."</td>
            							<td>".$lt."</td>
            							<td>".$voluntario."</td>
            							<td>".$status."</td>
            						 </tr>";
            			}
            			echo "</tbody>
            			        </table><br>
            			        ".$reccountespeciefelina." animais encontrados. </center>";
            			
            			$assunto = "Relatório dos animais disponíveis";
            			
            			$message = "<center><h4>Animais disponíveis para adoção responsável</h4><br>
            			<table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
						    <th scope='col' colspan='3'>Dados do animal</th>
							<th scope='col' colspan='3'>Dados do lar temporário</th>
							<th scope='col' colspan='1'>&nbsp;</th>
							
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Nome</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Sexo</th>
							<th scope='col'>Data de entrada</th>
							<th scope='col'>Lar temporário</th>
							<th scope='col'>Responsável</th>
						  </thead>
						  <tbody>";
            			while ($fetch = mysqli_fetch_row($resultlt)) {
            					$nomeanimal = $fetch[1];
            					$especie = $fetch[2];
            					$sexo = $fetch[4];
            					$dtentradalt = $fetch[13];
            					$lt = $fetch[11];
            					$voluntario = $fetch[12];
            				    $message .= "echo '<tr> 
            							<th scope='row'>".$nomeanimal."</th>
            							<td>".$especie."</td>
            							<td>".$sexo."</td>
            							<td>".$dtentradalt."</td>
            							<td>".$lt."</td>
            							<td>".$voluntario."</td>
                						</tr>";
            			}
            			$message .= "echo '</tbody>
            			        </table><br>
            			        ".$reccountespeciefelina." animais encontrados. </center>";
			    }
			}
			break;
			
		case 'Feiras':
		    echo "<div class='embed-responsive embed-responsive-16by9'>
                  <iframe class='embed-responsive-item' src='https://app.powerbi.com/view?r=eyJrIjoiOTRiM2RjMjctNjU4MS00MDJhLThmMjYtZTY4NzVhNWIzYzNhIiwidCI6IjY1ZWYwNGMzLTBmZmMtNDZiZC04ZjVlLTE1NDdkNWI0ZWJjNyJ9' allowfullscreen></iframe>
                </div>
                <br>
		            ";
		    break;
		    
		case 'CPG':
	              $querylt = "SELECT * FROM ANIMAL WHERE ADOTADO ='Disponível' AND DIVULGAR_COMO = 'Não divulgar' AND ESPECIE= 'Felina' ORDER BY nome_animal ASC";
				  $resultlt = mysqli_query($connect,$querylt); 
				  $reccount = mysqli_num_rows($resultlt);
				  
				  $sumdog = 0;
				  $sumcat = 0;
				  $sumdisp = 0;
				  $sumnaodisp = 0;
				  
				  if ($reccount == 0) {
            			echo "Nenhum animal encontrado<br><br>";
            		}else{ 
            			echo "<center><h4>Animais para controle da CPG</h4><br>
            			<p> Apenas animais que estão cadastrados no sistema como disponíveis e status da divulgação = Não divulgar </p> <br>
            			<table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
						    <th scope='col' colspan='3'>Dados do animal</th>
							<th scope='col' colspan='3'>Dados do lar temporário</th>
							<th scope='col' colspan='2'>Pesquisa externa</th>
							
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Nome</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Sexo</th>
							<th scope='col'>Data de entrada</th>
							<th scope='col'>Lar temporário</th>
							<th scope='col'>Responsável</th>
							<th scope='col'>Possui foto?</th>
							<th scope='col'>&nbsp;</th>
						  </thead>
						  <tbody>";
            			while ($fetch = mysqli_fetch_row($resultlt)) {
            					$nomeanimal = $fetch[1];
            					$especie = $fetch[2];
            					$sexo = $fetch[4];
            					$dtentradalt = $fetch[13];
            					$lt = $fetch[11];
            					$voluntario = $fetch[12];
            					$possuifoto = $fetch[16];
            					$divcomo = $fetch[18];
            					$sumcat = intval($sumcat)  + 1;
            					echo "<tr> 
            							<th scope='row'>".$nomeanimal."</th>
            							<td>".$especie."</td>
            							<td>".$sexo."</td>
            							<td>".$dtentradalt."</td>
            							<td>".$lt."</td>
            							<td>".$voluntario."</td>";
            							if ($possuifoto ==''){
            							   echo "<td>Não</td>";
            							} else {
            							   echo "<td>Sim</td>"; 
            							}
            						   echo "<td><div class='d-print-none'><a href='formatualizapet.php?idanimal=".$fetch[0]."' class='btn btn-primary'>Atualizar</a></div></td>";
            						   echo "</tr>";
            			}
            			echo "</tbody>
            			        </table>
            			        </center>
            			        <br>
            			        <center>
                                        <h3>RESUMO</h3><br>
                                   </center>
                        	        <table class='table'>
                                        <thead class='thead-light'>
                                	    </thead>
                                    	<tbody>
                    					<tr>
                        					<th scope='row'>Total </th>
                        					<td>".$sumcat."</td>
                    					</tr>
                    					</tbody>
                    				</table>";
                    	
            			$assunto = "Relatório dos animais disponíveis";
            			
            			$message = "<center><h4>Animais disponíveis para adoção responsável</h4><br>
            			<table class='table' >
						  <thead class='thead-dark  th-header'>
						  <tr>
						    <th scope='col' colspan='3'>Dados do animal</th>
							<th scope='col' colspan='3'>Dados do lar temporário</th>
							<th scope='col' colspan='1'>Pesquisa externa</th>
							
						  </tr>
						  </thead>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Nome</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Sexo</th>
							<th scope='col'>Data de entrada</th>
							<th scope='col'>Lar temporário</th>
							<th scope='col'>Responsável</th>
							<th scope='col'>Possui foto?</th>
						  </thead>
						  <tbody>";
            			while ($fetch = mysqli_fetch_row($resultlt)) {
            					$nomeanimal = $fetch[1];
            					$especie = $fetch[2];
            					$sexo = $fetch[4];
            					$dtentradalt = $fetch[13];
            					$lt = $fetch[11];
            					$voluntario = $fetch[12];
            				    $message .= "echo '<tr> 
            							<th scope='row'>".$nomeanimal."</th>
            							<td>".$especie."</td>
            							<td>".$sexo."</td>
            							<td>".$dtentradalt."</td>
            							<td>".$lt."</td>
            							<td>".$voluntario."</td>";
                						   if ($possuifoto ==''){
                							   echo "<td>Não</td>";
                							} else {
                							   echo "<td>Sim</td>"; 
                							}
                						echo "</tr>";
            			}
            			$message .= "echo '</tbody>
            			        </table></center>";
			}

                  break;
                  
        case 'Lares temporários':
                  $querylt = "SELECT * FROM LT WHERE ATIVO='SIM' ORDER BY LAR_TEMPORARIO ASC";
        	      $resultlt = mysqli_query($connect,$querylt); 
        
        			echo "<center><h4>Lares temporários</h4><br>
        			 <center><p> A quantidade de animais listada é equivalente aos animais que estão nos lares temporários, prontos pra adoção ou em tratamento. <br> Lares temporários sem animais ou animais doados não entram nesse relatório. </p> <br></center>
        			<table class='table' >
        			  <thead class='thead-light'>
        			  <tr>
        				<th scope='col'>Nome</th>
        				<th scope='col'>Celular</th>
        				<th scope='col'>E-mail</th>
        				<th scope='col'>Responsável</th>
        				<th scope='col'>Espécies</th>
        				<th scope='col'>Qtde animais</th>
        			   </tr>
        			   </thead>
        			  <tbody>";
        			  
        			while ($fetch = mysqli_fetch_row($resultlt)) {
        					$lt = $fetch[1];
        					$celular = $fetch[6];
        					$email = $fetch[7];
        					$especies = $fetch[8];
        					$responsavel = $fetch[11];
        					
        					$sumdog = 0;
                            $sumcat = 0;
        					
        
        					switch ($tipolt){
                                case 'Apenas cães':
                                        //$queryqtd = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO = '$lt' AND ESPECIE='Canina' AND ADOTADO='Disponível'";
                                        $queryqtd = "SELECT COUNT(QTDE_CAES) FROM LT WHERE LAR_TEMPORARIO = '$lt' AND ESPECIES='Apenas cães'";
					                    $resultqtd = mysqli_query($connect,$queryqtd); 
					                    $rc_qtdecaes = mysqli_fetch_row($resultqtd);
			                            $qtdecaes = $rc[0];
                                        
                                        echo "<tr> 
                							<th scope='row'>".$lt."</th>
                							<td>".$celular."</td>
                							<td>".$email."</td>
                							<td>".$responsavel."</td>
                							<td>".$especies."</td>
                							<td>".$qtdecaes."</td>";
                						   echo "</tr>";
                						   $sumlt = intval($sumlt) +1;
                                      break;
                                      
                                case 'Apenas cães no momento':
                                        $queryqtd = "SELECT * FROM LT WHERE LAR_TEMPORARIO = '$lt' AND ESPECIES='Apenas cães'";
					                    $resultqtd = mysqli_query($connect,$queryqtd); 
					                    
					                    while ($fetchqtd = mysqli_fetch_row($resultqtd)) {
                    					        $sumdog = intval($sumdog) + 1;
                    					}
                    					
                                        if ($sumdog != '0'){
                                          echo "<tr> 
                							<th scope='row'>".$lt."</th>
                							<td>".$celular."</td>
                							<td>".$email."</td>
                							<td>".$responsavel."</td>
                							<td>".$especies."</td>
                							<td>".$sumdog."</td>";
                						   echo "</tr>";
                						   $sumlt = intval($sumlt) +1;
                                        }
                                      break;
            						   
                                case 'Apenas gatos':
                                        $queryqtd = "SELECT * FROM LT WHERE LAR_TEMPORARIO = '$lt' AND ESPECIES='Apenas gatos'";
					                    $resultqtd = mysqli_query($connect,$queryqtd); 
					                    
					                    while ($fetchqtd = mysqli_fetch_row($resultqtd)) {
                    					        $sumcat = intval($sumcat) + 1;
                    					}
                                                echo "<tr> 
                    							<th scope='row'>".$lt."</th>
                    							<td>".$celular."</td>
                    							<td>".$email."</td>
                    							<td>".$responsavel."</td>
                    							<td>".$especies."</td>
                    							<td>".$sumcat."</td>";
                    						   echo "</tr>";
                    						   $sumlt = intval($sumlt) +1;
            						    break;
            						    
            				    case 'Apenas gatos no momento':
                                        $queryqtd = "SELECT * FROM LT WHERE LAR_TEMPORARIO = '$lt' AND ESPECIES='Apenas gatos'";
					                    $resultqtd = mysqli_query($connect,$queryqtd); 
					                    
					                    while ($fetchqtd = mysqli_fetch_row($resultqtd)) {
                    					        $sumcat = intval($sumcat) + 1;
                    					}
					                    
                                        if ($sumcat != '0'){
                                              echo "<tr> 
                    							<th scope='row'>".$lt."</th>
                    							<td>".$celular."</td>
                    							<td>".$email."</td>
                    							<td>".$responsavel."</td>
                    							<td>".$especies."</td>
                    							<td>".$sumcat."</td>";
                    						   echo "</tr>";
                    						   $sumlt = intval($sumlt) +1;
                                            }
            						    break;
            						
                                case 'Cães e gatos':
                                        $queryqtd = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO = '$lt' AND ADOTADO = 'Disponível' AND ESPECIE='Canina'";
					                    $resultqtd = mysqli_query($connect,$queryqtd); 
					                    
					                    while ($fetchqtd = mysqli_fetch_row($resultqtd)) {
                    					        $sumdog = intval($sumdog) + 1;
                    					}
                    					
                    					$queryqtd = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO = '$lt' AND ADOTADO = 'Disponível' AND ESPECIE='Felina'";
					                    $resultqtd = mysqli_query($connect,$queryqtd); 
					                    
					                    while ($fetchqtd = mysqli_fetch_row($resultqtd)) {
                    					        $sumcat = intval($sumcat) + 1;
                    					}
                    					
                    					if ($sumdog != 0 || $sumcat != 0){
                                          echo "<tr> 
                							<th scope='row'>".$lt."</th>
                							<td>".$celular."</td>
                							<td>".$email."</td>
                							<td>".$responsavel."</td>
                							<td>".$especies."</td>
                							<td>".$sumcat."</td>
                							<td>".$sumdog."</td>";
                						   echo "</tr>";
                						   $sumlt = intval($sumlt) +1;
                    					}
                                      break;
                            }
        					}
        					
        			echo "</tbody>
        			        </table><br>
        			        
        			        <p>".$sumlt." lares temporários encontrados</center>";
        			
        			$assunto = "Relatório dos animais disponíveis";
        			
        			$message = "<center><h4>Animais disponíveis para adoção responsável</h4><br>
        			<table class='table' >
        			  <thead class='thead-dark  th-header'>
        			  <tr>
        			    <th scope='col' colspan='3'>Dados do animal</th>
        				<th scope='col' colspan='3'>Dados do lar temporário</th>
        				<th scope='col' colspan='1'>&nbsp;</th>
        				
        			  </tr>
        			  </thead>
        			  <thead class='thead-light'>
        			  <tr>
        				<th scope='col'>Nome</th>
        				<th scope='col'>Espécie</th>
        				<th scope='col'>Sexo</th>
        				<th scope='col'>Data de entrada</th>
        				<th scope='col'>Lar temporário</th>
        				<th scope='col'>Responsável</th>
        			  </thead>
        			  <tbody>";
        			  
        			while ($fetch = mysqli_fetch_row($resultlt)) {
        					$nomeanimal = $fetch[1];
        					$especie = $fetch[2];
        					$sexo = $fetch[4];
        					$dtentradalt = $fetch[13];
        					$lt = $fetch[11];
        					$voluntario = $fetch[12];
        				    $message .= "echo '<tr> 
        							<th scope='row'>".$nomeanimal."</th>
        							<td>".$especie."</td>
        							<td>".$sexo."</td>
        							<td>".$dtentradalt."</td>
        							<td>".$lt."</td>
        							<td>".$voluntario."</td>
            						</tr>";
        			}
        			$message .= "echo '</tbody>
        			        </table><br>
        			        
        			        <p>".$reccount." lares encontrados</center>";
            
                    break;
                    
        case 'Procedimentos':
            
            echo "<center><h4>Procedimentos veterinários</h4><br></center>
    			 <center><p> A quantidade listada é equivalente aos procedimentos que foram cadastrados pelos veterinários ou voluntários e já aprovados pela diretoria<br></p> <br></center>
    			 
    			 <center><h5> CASTRAÇÕES <br></h5> <br></center>
        			<table class='table' >
        			  <thead class='thead-dark'>
        			  <tr>
        			    <th scope='col' colspan='2'>&nbsp;</th>
        				<th scope='col' colspan='2'>Espécie</th>
        				<th scope='col' colspan='2'>Quantidade</th>
        			  </tr>
        			 </thead>
        			<thead class='thead-light'>
        			  <tr>
        			    <th scope='col'>Ano</th>
        			    <th scope='col'>Mês</th>
        				<th scope='col'>Canina</th>
        				<th scope='col'>Felina</th>
        				<th scope='col'>Fêmea</th>
        				<th scope='col'>Macho</th>
        			</tr>
        			</thead>";
            
            switch ($anoprocedi) {
                case '':
                    $anoprocedi = date("Y");
                    break;
            }
            
            if ($mesprocedi != ''){
                
                $examesmes = exames_mensal($anoprocedi,$mesprocedi,$connect);
                
                $vacinacaesmes = vacina_caes_mensal($anoprocedi,$mesprocedi,$connect);
                
                $vacinagatosmes = vacina_gatos_mensal($anoprocedi,$mesprocedi,$connect);
                
                $caofemeames = castracao_mensal_caes_femeas($anoprocedi,$mesprocedi,$connect);

                $caomachomes = castracao_mensal_caes_machos($anoprocedi,$mesprocedi,$connect);
                
                $gatomachomes = castracao_mensal_gatos_machos($anoprocedi,$mesprocedi,$connect);
                
                $gatofemeames = castracao_mensal_gatos_femeas($anoprocedi,$mesprocedi,$connect);

                $femeasmes = intval($gatofemeames) + 
                             intval($caofemeames) ;
                
                $machosmes = intval($gatomachomes) + 
                             intval($caomachomes) ;
                             
                echo "
        			<tbody>
        			<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Janeiro</td>
							<td>".$caescastradosjan."</td>
							<td>".$gatoscastradosjan."</td>
							<td>".$femeasjan."</td>
							<td>".$machosjan."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Fevereiro</td>
							<td>".$caescastradosfev."</td>
							<td>".$gatoscastradosfev."</td>
							<td>".$femeasfev."</td>
							<td>".$machosfev."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Março</td>
							<td>".$caescastradosmar."</td>
							<td>".$gatoscastradosmar."</td>
							<td>".$femeasmar."</td>
							<td>".$machosmar."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Abril</td>
							<td>".$caescastradosabr."</td>
							<td>".$gatoscastradosabr."</td>
							<td>".$femeasabr."</td>
							<td>".$machosabr."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Maio</td>
							<td>".$caescastradosmai."</td>
							<td>".$gatoscastradosmai."</td>
							<td>".$femeasmai."</td>
							<td>".$machosmai."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Junho</td>
							<td>".$caescastradosjun."</td>
							<td>".$gatoscastradosjun."</td>
							<td>".$femeasjun."</td>
							<td>".$machosjun."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Julho</td>
							<td>".$caescastradosjul."</td>
							<td>".$gatoscastradosjul."</td>
							<td>".$femeasjul."</td>
							<td>".$machosjul."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Agosto</td>
							<td>".$caescastradosago."</td>
							<td>".$gatoscastradosago."</td>
							<td>".$femeasago."</td>
							<td>".$machosago."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Setembro</td>
							<td>".$caescastradosset."</td>
							<td>".$gatoscastradosset."</td>
							<td>".$femeasset."</td>
							<td>".$machosset."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Outubro</td>
							<td>".$caescastradosout."</td>
							<td>".$gatoscastradosout."</td>
							<td>".$femeasout."</td>
							<td>".$machosout."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Novembro</td>
							<td>".$caescastradosnov."</td>
							<td>".$gatoscastradosnov."</td>
							<td>".$femeasnov."</td>
							<td>".$machosnov."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Dezembro</td>
							<td>".$caescastradosdez."</td>
							<td>".$gatoscastradosdez."</td>
							<td>".$femeasdez."</td>
							<td>".$machosdez."</td>
					</tr>
        			</tbody>
        			</table>
        			
        			<br>

        	        <table class='table'>
                        <thead class='thead-light'>
                            <tr>
            					<th scope='row'>Castrações caninas</th>
            					<th>".$caescastrados."</th>
        					</tr>
                	    </thead>
                    	<tbody>
        					<tr>
            					<th>Machos</th>
            					<td>".$caesmachoscastrados."</td>
        					</tr>
        					<tr>
            					<th>Fêmeas</th>
            					<td>".$caesfemeascastradas."</td>
        					</tr>
        			    </tbody>
        			</table>
        			<br>
        			<table class='table'>
                        <thead class='thead-light'>
                            <tr>
            					<th scope='row'>Castrações felinas</th>
            					<th>".$gatoscastrados."</th>
        					</tr>
                	    </thead>
                    	<tbody>
        					<tr>
            					<th>Machos</th>
            					<td>".$gatosmachoscastrados."</td>
        					</tr>
        					<tr>
            					<th>Fêmeas</th>
            					<td>".$gatosfemeascastradas."</td>
        					</tr>
    					</tbody>
    				</table>
        			
        			<br><br>
        			
        			<center><h5> VACINAS <br></h5> <br></center>
        			<table class='table' >
        			  <thead class='thead-dark'>
        			  <tr>
        			    <th scope='col' colspan='2'>&nbsp;</th>
        				<th scope='col' colspan='2'>Espécie</th>
        			  </tr>
        			 </thead>
        			<thead class='thead-light'>
        			  <tr>
        			    <th scope='col'>Ano</th>
        			    <th scope='col'>Mês</th>
        				<th scope='col'>Canina</th>
        				<th scope='col'>Felina</th>
        			</tr>
        			</thead>
        			<tbody>
        			<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Janeiro</td>
							<td>".$vacinacaesjan."</td>
							<td>".$vacinagatosjan."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Fevereiro</td>
							<td>".$vacinacaesfev."</td>
							<td>".$vacinagatosfev."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Março</td>
							<td>".$vacinacaesmar."</td>
							<td>".$vacinagatosmar."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Abril</td>
							<td>".$vacinacaesabr."</td>
							<td>".$vacinagatosabr."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Maio</td>
							<td>".$vacinacaesmai."</td>
							<td>".$vacinagatosmai."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Junho</td>
							<td>".$vacinacaesjun."</td>
							<td>".$vacinagatosjun."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Julho</td>
							<td>".$vacinacaesjul."</td>
							<td>".$vacinagatosjul."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Agosto</td>
							<td>".$vacinacaesago."</td>
							<td>".$vacinagatosago."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Setembro</td>
							<td>".$vacinacaesset."</td>
							<td>".$vacinagatosset."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Outubro</td>
							<td>".$vacinacaesout."</td>
							<td>".$vacinagatosout."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Novembro</td>
							<td>".$vacinacaesnov."</td>
							<td>".$vacinagatosnov."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Dezembro</td>
							<td>".$vacinacaesdez."</td>
							<td>".$vacinagatosdez."</td>
					</tr>
        			</tbody>
        			</table>
        			
        			<br>
        			<table class='table'>
                        <thead class='thead-light'>
                            <tr>
            					<th scope='row'>Vacinas caninas</th>
            					<th>".$caesvacinados."</th>
        					</tr>
        					<tr>
            					<th scope='row'>Vacinas felinas</th>
            					<th>".$gatosvacinados."</th>
        					</tr>
                	    </thead>
                    	<tbody>
    					</tbody>
    				</table>
    				
    				<br><br>
        			
        			<center><h5> EXAMES <br></h5> <br></center>
        			<table class='table' >
        			  <thead class='thead-dark'>
        			  <tr>
        			    <th scope='col' colspan='2'>&nbsp;</th>
        				<th scope='col' colspan='2'>Espécie</th>
        			  </tr>
        			 </thead>
        			<thead class='thead-light'>
        			  <tr>
        			    <th scope='col'>Ano</th>
        			</tr>
        			</thead>
        			<tbody>
        			<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>".$examesmes01."</td>
					</tr>
        			</tbody>
        			</table>";
                
            }
            else {
                
                $examesmes01 = exames_mensal($anoprocedi,'01',$connect);
                $examesmes02 = exames_mensal($anoprocedi,'02',$connect);
                $examesmes03 = exames_mensal($anoprocedi,'03',$connect);
                $examesmes04 = exames_mensal($anoprocedi,'04',$connect);
                $examesmes05 = exames_mensal($anoprocedi,'05',$connect);
                $examesmes06 = exames_mensal($anoprocedi,'06',$connect);
                $examesmes07 = exames_mensal($anoprocedi,'07',$connect);
                $examesmes08 = exames_mensal($anoprocedi,'08',$connect);
                $examesmes09 = exames_mensal($anoprocedi,'09',$connect);
                $examesmes10 = exames_mensal($anoprocedi,'10',$connect);
                $examesmes11 = exames_mensal($anoprocedi,'11',$connect);
                $examesmes12 = exames_mensal($anoprocedi,'12',$connect);
                
                $vacinacaesjan = vacina_caes_mensal($anoprocedi,'01',$connect);
                $vacinacaesfev = vacina_caes_mensal($anoprocedi,'02',$connect);
                $vacinacaesmar = vacina_caes_mensal($anoprocedi,'03',$connect);
                $vacinacaesabr = vacina_caes_mensal($anoprocedi,'04',$connect);
                $vacinacaesmai = vacina_caes_mensal($anoprocedi,'05',$connect);
                $vacinacaesjun = vacina_caes_mensal($anoprocedi,'06',$connect);
                $vacinacaesjul = vacina_caes_mensal($anoprocedi,'07',$connect);
                $vacinacaesago = vacina_caes_mensal($anoprocedi,'08',$connect);
                $vacinacaesset = vacina_caes_mensal($anoprocedi,'09',$connect);
                $vacinacaesout = vacina_caes_mensal($anoprocedi,'10',$connect);
                $vacinacaesnov = vacina_caes_mensal($anoprocedi,'11',$connect);
                $vacinacaesdez = vacina_caes_mensal($anoprocedi,'12',$connect);
                
                $vacinagatosjan = vacina_gatos_mensal($anoprocedi,'01',$connect);
                $vacinagatosfev = vacina_gatos_mensal($anoprocedi,'02',$connect);
                $vacinagatosmar = vacina_gatos_mensal($anoprocedi,'03',$connect);
                $vacinagatosabr = vacina_gatos_mensal($anoprocedi,'04',$connect);
                $vacinagatosmai = vacina_gatos_mensal($anoprocedi,'05',$connect);
                $vacinagatosjun = vacina_gatos_mensal($anoprocedi,'06',$connect);
                $vacinagatosjul = vacina_gatos_mensal($anoprocedi,'07',$connect);
                $vacinagatosago = vacina_gatos_mensal($anoprocedi,'08',$connect);
                $vacinagatosset = vacina_gatos_mensal($anoprocedi,'09',$connect);
                $vacinagatosout = vacina_gatos_mensal($anoprocedi,'10',$connect);
                $vacinagatosnov = vacina_gatos_mensal($anoprocedi,'11',$connect);
                $vacinagatosdez = vacina_gatos_mensal($anoprocedi,'12',$connect);
                
                $caofemeajan = castracao_mensal_caes_femeas($anoprocedi,'01',$connect);
                $caofemeafev = castracao_mensal_caes_femeas($anoprocedi,'02',$connect);
                $caofemeamar = castracao_mensal_caes_femeas($anoprocedi,'03',$connect);
                $caofemeaabr = castracao_mensal_caes_femeas($anoprocedi,'04',$connect);
                $caofemeamai = castracao_mensal_caes_femeas($anoprocedi,'05',$connect);
                $caofemeajun = castracao_mensal_caes_femeas($anoprocedi,'06',$connect);
                $caofemeajul = castracao_mensal_caes_femeas($anoprocedi,'07',$connect);
                $caofemeaago = castracao_mensal_caes_femeas($anoprocedi,'08',$connect);
                $caofemeaset = castracao_mensal_caes_femeas($anoprocedi,'09',$connect);
                $caofemeaout = castracao_mensal_caes_femeas($anoprocedi,'10',$connect);
                $caofemeanov = castracao_mensal_caes_femeas($anoprocedi,'11',$connect);
                $caofemeadez = castracao_mensal_caes_femeas($anoprocedi,'12',$connect);

                $caomachojan = castracao_mensal_caes_machos($anoprocedi,'01',$connect);
                $caomachofev = castracao_mensal_caes_machos($anoprocedi,'02',$connect);
                $caomachomar = castracao_mensal_caes_machos($anoprocedi,'03',$connect);
                $caomachoabr = castracao_mensal_caes_machos($anoprocedi,'04',$connect);
                $caomachomai = castracao_mensal_caes_machos($anoprocedi,'05',$connect);
                $caomachojun = castracao_mensal_caes_machos($anoprocedi,'06',$connect);
                $caomachojul = castracao_mensal_caes_machos($anoprocedi,'07',$connect);
                $caomachoago = castracao_mensal_caes_machos($anoprocedi,'08',$connect);
                $caomachoset = castracao_mensal_caes_machos($anoprocedi,'09',$connect);
                $caomachoout = castracao_mensal_caes_machos($anoprocedi,'10',$connect);
                $caomachonov = castracao_mensal_caes_machos($anoprocedi,'11',$connect);
                $caomachodez = castracao_mensal_caes_machos($anoprocedi,'12',$connect);
                
                $gatomachojan = castracao_mensal_gatos_machos($anoprocedi,'01',$connect);
                $gatomachofev = castracao_mensal_gatos_machos($anoprocedi,'02',$connect);
                $gatomachomar = castracao_mensal_gatos_machos($anoprocedi,'03',$connect);
                $gatomachoabr = castracao_mensal_gatos_machos($anoprocedi,'04',$connect);
                $gatomachomai = castracao_mensal_gatos_machos($anoprocedi,'05',$connect);
                $gatomachojun = castracao_mensal_gatos_machos($anoprocedi,'06',$connect);
                $gatomachojul = castracao_mensal_gatos_machos($anoprocedi,'07',$connect);
                $gatomachoago = castracao_mensal_gatos_machos($anoprocedi,'08',$connect);
                $gatomachoset = castracao_mensal_gatos_machos($anoprocedi,'09',$connect);
                $gatomachoout = castracao_mensal_gatos_machos($anoprocedi,'10',$connect);
                $gatomachonov = castracao_mensal_gatos_machos($anoprocedi,'11',$connect);
                $gatomachodez = castracao_mensal_gatos_machos($anoprocedi,'12',$connect);
                
                $gatofemeajan = castracao_mensal_gatos_femeas($anoprocedi,'01',$connect);
                $gatofemeafev = castracao_mensal_gatos_femeas($anoprocedi,'02',$connect);
                $gatofemeamar = castracao_mensal_gatos_femeas($anoprocedi,'03',$connect);
                $gatofemeaabr = castracao_mensal_gatos_femeas($anoprocedi,'04',$connect);
                $gatofemeamai = castracao_mensal_gatos_femeas($anoprocedi,'05',$connect);
                $gatofemeajun = castracao_mensal_gatos_femeas($anoprocedi,'06',$connect);
                $gatofemeajul = castracao_mensal_gatos_femeas($anoprocedi,'07',$connect);
                $gatofemeaago = castracao_mensal_gatos_femeas($anoprocedi,'08',$connect);
                $gatofemeaset = castracao_mensal_gatos_femeas($anoprocedi,'09',$connect);
                $gatofemeaout = castracao_mensal_gatos_femeas($anoprocedi,'10',$connect);
                $gatofemeanov = castracao_mensal_gatos_femeas($anoprocedi,'11',$connect);
                $gatofemeadez = castracao_mensal_gatos_femeas($anoprocedi,'12',$connect);
                
                $caesvacinados = intval($vacinacaesjan) + 
                                 intval($vacinacaesfev) +
                                 intval($vacinacaesmar) +
                                 intval($vacinacaesabr) +
                                 intval($vacinacaesmai) +
                                 intval($vacinacaesjun) +
                                 intval($vacinacaesjul) +
                                 intval($vacinacaesago) +
                                 intval($vacinacaesset) +
                                 intval($vacinacaesout) +
                                 intval($vacinacaesnov) +
                                 intval($vacinacaesdez);
                                 
                
                $gatosvacinados = intval($vacinagatosjan) + 
                                 intval($vacinagatosfev) +
                                 intval($vacinagatosmar) +
                                 intval($vacinagatosabr) +
                                 intval($vacinagatosmai) +
                                 intval($vacinagatosjun) +
                                 intval($vacinagatosjul) +
                                 intval($vacinagatosago) +
                                 intval($vacinagatosset) +
                                 intval($vacinagatosout) +
                                 intval($vacinagatosnov) +
                                 intval($vacinagatosdez);

                                 
                $caesmachoscastrados = intval($caomachojan) +
                                 intval($caomachofev) +
                                 intval($caomachomar) +
                                 intval($caomachoabr) +
                                 intval($caomachomai) +
                                 intval($caomachojun) +
                                 intval($caomachojul) +
                                 intval($caomachoago) +
                                 intval($caomachoset) +
                                 intval($caomachoout) +
                                 intval($caomachonov) +
                                 intval($caomachodez);
                                 
                $caesfemeascastradas = intval($caofemeajan) + 
                                 intval($caofemeafev) +
                                 intval($caofemeamar) +
                                 intval($caofemeaabr) +
                                 intval($caofemeamai) +
                                 intval($caofemeajun) +
                                 intval($caofemeajul) +
                                 intval($caofemeaago) +
                                 intval($caofemeaset) +
                                 intval($caofemeaout) +
                                 intval($caofemeanov) +
                                 intval($caofemeadez);
                                 
                $caescastradosjan = intval($caofemeajan) + 
                                    intval($caomachojan);
                                 
                $caescastradosfev = intval($caofemeafev) + 
                                    intval($caomachofev);
                                 
                $caescastradosmar = intval($caofemeamar) + 
                                    intval($caomachomar);
                                    
                $caescastradosabr = intval($caofemeaabr) + 
                                    intval($caomachoabr);
                                    
                $caescastradosmai = intval($caofemeamai) + 
                                    intval($caomachomai);
                                    
                $caescastradosjun = intval($caofemeajun) + 
                                    intval($caomachojun);
                                    
                $caescastradosjul = intval($caofemeajul) + 
                                    intval($caomachojul);
                
                $caescastradosago = intval($caofemeaago) + 
                                    intval($caomachoago);
                                    
                $caescastradosset = intval($caofemeaset) + 
                                    intval($caomachoset);
                                    
                $caescastradosout = intval($caofemeaout) + 
                                    intval($caomachoout);
                                    
                $caescastradosnov = intval($caofemeanov) + 
                                    intval($caomachonov);
                                    
                $caescastradosdez = intval($caofemeadez) + 
                                    intval($caomachodez);
                                    
                $gatoscastradosjan = intval($gatofemeajan) + 
                                    intval($gatomachojan);
                                 
                $gatoscastradosfev = intval($gatofemeafev) + 
                                    intval($gatomachofev);
                                 
                $gatoscastradosmar = intval($gatofemeamar) + 
                                    intval($gatomachomar);
                                    
                $gatoscastradosabr = intval($gatofemeaabr) + 
                                    intval($gatomachoabr);
                                    
                $gatoscastradosmai = intval($gatofemeamai) + 
                                    intval($gatomachomai);
                                    
                $gatoscastradosjun = intval($gatofemeajun) + 
                                    intval($gatomachojun);
                                    
                $gatoscastradosjul = intval($gatofemeajul) + 
                                    intval($gatomachojul);
                
                $gatoscastradosago = intval($gatofemeaago) + 
                                    intval($gatomachoago);
                                    
                $gatoscastradosset = intval($gatofemeaset) + 
                                    intval($gatomachoset);
                                    
                $gatoscastradosout = intval($gatofemeaout) + 
                                    intval($gatomachoout);
                                    
                $gatoscastradosnov = intval($gatofemeanov) + 
                                    intval($gatomachonov);
                                    
                $gatoscastradosdez = intval($gatofemeadez) + 
                                    intval($gatomachodez);
                                    
                $caescastrados = intval($caescastradosjan) + 
                                 intval($caescastradosfev) +
                                 intval($caescastradosmar) +
                                 intval($caescastradosabr) +
                                 intval($caescastradosmai) +
                                 intval($caescastradosjun) +
                                 intval($caescastradosjul) +
                                 intval($caescastradosago) +
                                 intval($caescastradosset) +
                                 intval($caescastradosout) +
                                 intval($caescastradosnov) +
                                 intval($caescastradosdez);
                                 
                $gatoscastrados = intval($gatoscastradosjan) + 
                                 intval($gatoscastradosfev) +
                                 intval($gatoscastradosmar) +
                                 intval($gatoscastradosabr) +
                                 intval($gatoscastradosmai) +
                                 intval($gatoscastradosjun) +
                                 intval($gatoscastradosjul) +
                                 intval($gatoscastradosago) +
                                 intval($gatoscastradosset) +
                                 intval($gatoscastradosout) +
                                 intval($gatoscastradosnov) +
                                 intval($gatoscastradosdez);
                                 
                    $gatosmachoscastrados = intval($gatomachojan) +
                                 intval($gatomachofev) +
                                 intval($gatomachomar) +
                                 intval($gatomachoabr) +
                                 intval($gatomachomai) +
                                 intval($gatomachojun) +
                                 intval($gatomachojul) +
                                 intval($gatomachoago) +
                                 intval($gatomachoset) +
                                 intval($gatomachoout) +
                                 intval($gatomachonov) +
                                 intval($gatomachodez);
                                 
                    $gatosfemeascastradas = intval($gatofemeajan) + 
                                 intval($gatofemeafev) +
                                 intval($gatofemeamar) +
                                 intval($gatofemeaabr) +
                                 intval($gatofemeamai) +
                                 intval($gatofemeajun) +
                                 intval($gatofemeajul) +
                                 intval($gatofemeaago) +
                                 intval($gatofemeaset) +
                                 intval($gatofemeaout) +
                                 intval($gatofemeanov) +
                                 intval($gatofemeadez);
                                 
                    $femeasjan = intval($gatofemeajan) + 
                                 intval($caofemeajan) ;
                    
                    $machosjan = intval($gatomachojan) + 
                                 intval($caomachojan) ;
                                 
                    $femeasfev = intval($gatofemeafev) + 
                                 intval($caofemeafev) ;
                    
                    $machosfev = intval($gatomachofev) + 
                                 intval($caomachofev) ;
                                 
                    $femeasmar = intval($gatofemeamar) + 
                                 intval($caofemeamar) ;
                    
                    $machosmar = intval($gatomachomar) + 
                                 intval($caomachomar) ;
                                 
                    $femeasabr = intval($gatofemeaabr) + 
                                 intval($caofemeaabr) ;
                    
                    $machosabr = intval($gatomachoabr) + 
                                 intval($caomachoabr) ;
                                 
                    $femeasmai = intval($gatofemeamai) + 
                                 intval($caofemeamai) ;
                    
                    $machosmai = intval($gatomachomai) + 
                                 intval($caomachomai) ;
                                 
                    $femeasjun = intval($gatofemeajun) + 
                                 intval($caofemeajun) ;
                    
                    $machosjun = intval($gatomachojun) + 
                                 intval($caomachojun) ;
                                 
                    $femeasjul = intval($gatofemeajul) + 
                                 intval($caofemeajul) ;
                    
                    $machosjul = intval($gatomachojul) + 
                                 intval($caomachojul) ;
                                 
                    $femeasago = intval($gatofemeaago) + 
                                 intval($caofemeaago) ;
                    
                    $machosago = intval($gatomachoago) + 
                                 intval($caomachoago) ;
                                 
                    $femeasset = intval($gatofemeaset) + 
                                 intval($caofemeaset) ;
                    
                    $machosset = intval($gatomachoset) + 
                                 intval($caomachoset) ;
                                 
                    $femeasout = intval($gatofemeaout) + 
                                 intval($caofemeaout) ;
                    
                    $machosout = intval($gatomachoout) + 
                                 intval($caomachoout) ;
                                 
                    $femeasnov = intval($gatofemeanov) + 
                                 intval($caofemeanov) ;
                    
                    $machosnov = intval($gatomachonov) + 
                                 intval($caomachonov) ;
                                 
                    $femeasdez = intval($gatofemeadez) + 
                                 intval($caofemeadez) ;
                    
                    $machosdez = intval($gatomachodez) + 
                                 intval($caomachodez) ;

			echo "
        			<tbody>
        			<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Janeiro</td>
							<td>".$caescastradosjan."</td>
							<td>".$gatoscastradosjan."</td>
							<td>".$femeasjan."</td>
							<td>".$machosjan."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Fevereiro</td>
							<td>".$caescastradosfev."</td>
							<td>".$gatoscastradosfev."</td>
							<td>".$femeasfev."</td>
							<td>".$machosfev."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Março</td>
							<td>".$caescastradosmar."</td>
							<td>".$gatoscastradosmar."</td>
							<td>".$femeasmar."</td>
							<td>".$machosmar."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Abril</td>
							<td>".$caescastradosabr."</td>
							<td>".$gatoscastradosabr."</td>
							<td>".$femeasabr."</td>
							<td>".$machosabr."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Maio</td>
							<td>".$caescastradosmai."</td>
							<td>".$gatoscastradosmai."</td>
							<td>".$femeasmai."</td>
							<td>".$machosmai."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Junho</td>
							<td>".$caescastradosjun."</td>
							<td>".$gatoscastradosjun."</td>
							<td>".$femeasjun."</td>
							<td>".$machosjun."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Julho</td>
							<td>".$caescastradosjul."</td>
							<td>".$gatoscastradosjul."</td>
							<td>".$femeasjul."</td>
							<td>".$machosjul."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Agosto</td>
							<td>".$caescastradosago."</td>
							<td>".$gatoscastradosago."</td>
							<td>".$femeasago."</td>
							<td>".$machosago."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Setembro</td>
							<td>".$caescastradosset."</td>
							<td>".$gatoscastradosset."</td>
							<td>".$femeasset."</td>
							<td>".$machosset."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Outubro</td>
							<td>".$caescastradosout."</td>
							<td>".$gatoscastradosout."</td>
							<td>".$femeasout."</td>
							<td>".$machosout."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Novembro</td>
							<td>".$caescastradosnov."</td>
							<td>".$gatoscastradosnov."</td>
							<td>".$femeasnov."</td>
							<td>".$machosnov."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Dezembro</td>
							<td>".$caescastradosdez."</td>
							<td>".$gatoscastradosdez."</td>
							<td>".$femeasdez."</td>
							<td>".$machosdez."</td>
					</tr>
        			</tbody>
        			</table>
        			
        			<br>

        	        <table class='table'>
                        <thead class='thead-light'>
                            <tr>
            					<th scope='row'>Castrações caninas</th>
            					<th>".$caescastrados."</th>
        					</tr>
                	    </thead>
                    	<tbody>
        					<tr>
            					<th>Machos</th>
            					<td>".$caesmachoscastrados."</td>
        					</tr>
        					<tr>
            					<th>Fêmeas</th>
            					<td>".$caesfemeascastradas."</td>
        					</tr>
        			    </tbody>
        			</table>
        			<br>
        			<table class='table'>
                        <thead class='thead-light'>
                            <tr>
            					<th scope='row'>Castrações felinas</th>
            					<th>".$gatoscastrados."</th>
        					</tr>
                	    </thead>
                    	<tbody>
        					<tr>
            					<th>Machos</th>
            					<td>".$gatosmachoscastrados."</td>
        					</tr>
        					<tr>
            					<th>Fêmeas</th>
            					<td>".$gatosfemeascastradas."</td>
        					</tr>
    					</tbody>
    				</table>
        			
        			<br><br>
        			
        			<center><h5> VACINAS <br></h5> <br></center>
        			<table class='table' >
        			  <thead class='thead-dark'>
        			  <tr>
        			    <th scope='col' colspan='2'>&nbsp;</th>
        				<th scope='col' colspan='2'>Espécie</th>
        			  </tr>
        			 </thead>
        			<thead class='thead-light'>
        			  <tr>
        			    <th scope='col'>Ano</th>
        			    <th scope='col'>Mês</th>
        				<th scope='col'>Canina</th>
        				<th scope='col'>Felina</th>
        			</tr>
        			</thead>
        			<tbody>
        			<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Janeiro</td>
							<td>".$vacinacaesjan."</td>
							<td>".$vacinagatosjan."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Fevereiro</td>
							<td>".$vacinacaesfev."</td>
							<td>".$vacinagatosfev."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Março</td>
							<td>".$vacinacaesmar."</td>
							<td>".$vacinagatosmar."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Abril</td>
							<td>".$vacinacaesabr."</td>
							<td>".$vacinagatosabr."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Maio</td>
							<td>".$vacinacaesmai."</td>
							<td>".$vacinagatosmai."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Junho</td>
							<td>".$vacinacaesjun."</td>
							<td>".$vacinagatosjun."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Julho</td>
							<td>".$vacinacaesjul."</td>
							<td>".$vacinagatosjul."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Agosto</td>
							<td>".$vacinacaesago."</td>
							<td>".$vacinagatosago."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Setembro</td>
							<td>".$vacinacaesset."</td>
							<td>".$vacinagatosset."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Outubro</td>
							<td>".$vacinacaesout."</td>
							<td>".$vacinagatosout."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Novembro</td>
							<td>".$vacinacaesnov."</td>
							<td>".$vacinagatosnov."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Dezembro</td>
							<td>".$vacinacaesdez."</td>
							<td>".$vacinagatosdez."</td>
					</tr>
        			</tbody>
        			</table>
        			<br>
        			<table class='table'>
                        <thead class='thead-light'>
                            <tr>
            					<th scope='row'>Vacinas caninas</th>
            					<th>".$caesvacinados."</th>
        					</tr>
        					<tr>
            					<th scope='row'>Vacinas felinas</th>
            					<th>".$gatosvacinados."</th>
        					</tr>
                	    </thead>
                    	<tbody>
    					</tbody>
    				</table>
    				
    				<br><br>
        			
        			<center><h5> EXAMES <br></h5> <br></center>
        			<table class='table' >
        			  <thead class='thead-dark'>
        			  <tr>
        			    <th scope='col' colspan='3'>&nbsp;</th>
        			  </tr>
        			 </thead>
        			<thead class='thead-light'>
        			  <tr>
        			    <th scope='col'>Ano</th>
        			    <th scope='col'>Mês</th>
        			    <th scope='col'>Quantidade</th>
        			</tr>
        			</thead>
        			<tbody>
        			<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Janeiro</td>
							<td>".$examesmes01."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Fevereiro</td>
							<td>".$examesmes02."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Março</td>
							<td>".$examesmes03."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Abril</td>
							<td>".$examesmes04."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Maio</td>
							<td>".$examesmes05."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Junho</td>
							<td>".$examesmes06."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Julho</td>
							<td>".$examesmes07."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Agosto</td>
							<td>".$examesmes08."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Setembro</td>
							<td>".$examesmes09."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Outubro</td>
							<td>".$examesmes10."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Novembro</td>
							<td>".$examesmes11."</td>
					</tr>
					<tr> 
							<th scope='row'>".$anoprocedi."</th>
							<td>Dezembro</td>
							<td>".$examesmes12."</td>
					</tr>
        			</tbody>
        			</table>";

	}
	
	        break;
	        
	         case 'Vacinas':
                echo "<div class='embed-responsive embed-responsive-16by9'>
                      <iframe class='embed-responsive-item' src='https://gaarcampinas.org/area/relatorio_vacina.php?parm=s' allowfullscreen></iframe>
                    </div>";
                break;
            
             case 'Lista de presença':
                 $queryvol = "SELECT * FROM VOLUNTARIOS WHERE SUBAREA='feira' AND STATUS_APROV='Aprovado' ORDER BY NOME ASC";
                 $selectvol = mysqli_query($connect,$queryvol);
                 
                 echo "<center><h5> LISTA DE PRESENÇA DOS VOLUNTÁRIOS FEIRA ATIVOS <br></h5> <br></center>
                    			<table class='table' >
                    			  <thead class='thead-dark'>
                    			  <tr>
                    			    <th scope='col' colspan='5'>&nbsp;</th>
                    			  </tr>
                    			 </thead>
                    			<thead class='thead-light'>
                    			  <tr>
                    			    <th scope='col'>Ano</th>
                    			    <th scope='col'>Nome</th>
                    			    <th scope='col'>Telefone</th>
                    			    <th scope='col'>Quantidade</th>
                    			    <th scope='col'>Última feira</th>
                    			</tr>
                    			</thead>
                    			<tbody>";
		
        		 while ($fetchvol = mysqli_fetch_row($selectvol)) {
        		      
        		        $nomevolfeira = $fetchvol[2];
        		        $telvolfeira = $fetchvol[3];
        				
        				$count_pres = lista_presenca($ano_atu,$mes_atu,$nomevolfeira,$connect);
        				
        				$ultima_feira = ultima_feira($ano_atu,$mes_atu,$nomevolfeira,$connect);
        				
        				$ano_feira = substr($ultima_feira,0,4);
        		        $mes_feira = substr($ultima_feira,5,2);
        		        $dia_feira = substr($ultima_feira,8,2);
				        
                    	echo "<tr> 
            							<th scope='row'>".$ano_atu."</th>
            							<td>".$nomevolfeira."</td>
            							<td>".$telvolfeira."</td>
            							<td>".$count_pres."</td>
            							<td>".$ultima_feira."</td>
            							
            					</tr>";
            					//<td>".$dia_feira."/".$mes_feira."/".$ano_feira/"</td>
        		  }
                         
                  echo "</tbody>
                    	</table>";
                 
                 break;
	}
    	
}
		mysqli_close($connect);
		
?>
</div>
<center>
<div class="d-print-none">
<form action="enviarrelatorios.php" method="post" name="emailrelatorio">
    <div class="d-print-none">
        <center><p><strong>OBSERVAÇÕES</strong><br>
            <i>Os valores apresentados são as informações cadastradas e foram coletadas pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail operacional@gaarcampinas.org</i></center>      
            <input type="text" id="assunto" name="assunto" value="<? echo $assunto ?>" hidden>
        <!--<textarea name="obs" cols="50" rows="20" id="obs"></textarea><br><br>-->
        <input type="text" id="mensagem" name="mensagem" value="<? echo $mensagem ?>" hidden><br><br>
        <a href="javascript:emailrelatorio.submit()" class="btn btn-primary">Enviar relatório por e-mail</a> &nbsp; <a href="javascript:window.print()" class="btn btn-primary">Download</a>
    </div>  
</form>
    <br>
    <a href="relatorio_adocoes.php" class="btn btn-primary">Nova pesquisa</a>
	<br><br>
</div>
</center>

<div class="d-none d-print-block">
        <center><p><strong>OBSERVAÇÕES</strong><br>
                <i>Os valores apresentados são as informações cadastradas e foram coletadas pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail operacional@gaarcampinas.org</i></center>      
</div>
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