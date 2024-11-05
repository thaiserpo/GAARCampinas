<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$funcao = $_GET ['voltar'];

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
    
    <title>GAAR - Pesquisa de termo</title>
    
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

        mysqli_set_charset($connect,'utf8');
        
        $nomeanimal = strtoupper($_POST['nomedoanimal']);
        $adotante = strtoupper($_POST['adotante']);
        $mesadocao = $_POST['mesdaadocao'];
        $anoadocao = $_POST['anodaadocao'];
        $lt = $_POST['lt'];
        $especie = $_POST['especie'];
        $posadocao = $_POST['posadocao'];
        $status = $_POST['status'];

?>
<main role="main" class="container">
    <div class="starter-template">
        <br>
        <center><h3>TERMOS DE ADOÇÃO</h3><br>
        É proibida a reprodução, parcial ou total, dos dados pessoais aqui apresentados sem prévia autorização. Todas as informações estão protegidas pela Lei Geral de Proteção de Dados Pessoais (LGPD) - LEI Nº 13.709, DE 14 DE AGOSTO DE 2018. Conheça a lei na íntegra clicando <a href='http://www.planalto.gov.br/ccivil_03/_Ato2015-2018/2018/Lei/L13709.htm' target='_blank'>aqui</a>. <br>
        <p>Caso não encontrou o termo, cadastre-o <a href='formprecadastrotermo.php'>aqui</a></p></center>
        <br>
<?
       
        if ($nomeanimal != '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie == '' && $posadocao =='' && $adotante == ''){
            /*echo "caiu aqui 1";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND NOME_ANIMAL LIKE '%".$nomeanimal."%' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal != '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie != '' && $posadocao =='' && $adotante == ''){
            /*echo "caiu aqui 2";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND NOME_ANIMAL LIKE '%".$nomeanimal."%' AND ESPECIE = '".$especie."' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie != '' && $posadocao =='' && $adotante != ''){
            /*echo "caiu aqui 3";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND ESPECIE ='".$especie."' AND ADOTANTE LIKE '%".$adotante."%' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao != 'branco' && $anoadocao == 'branco' && $lt == '' && $especie == '' && $posadocao =='' && $adotante == ''){
            /*echo "caiu aqui 4";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND DATA_ADOCAO LIKE '%-".$mesadocao."-%' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao != 'branco' && $lt == '' && $especie == '' && $posadocao =='' && $adotante == ''){
            /*echo "caiu aqui 5";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND DATA_ADOCAO LIKE '".$anoadocao."-%' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao != 'branco' && $anoadocao != 'branco' && $lt == '' && $especie == '' && $posadocao =='' && $adotante == ''){
            /*echo "caiu aqui 6";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."-%' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao != 'branco' && $anoadocao != 'branco' && $lt == '' && $especie != '' && $posadocao =='' && $adotante == ''){
            /*echo "caiu aqui 7";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."-%' AND ESPECIE = '".$especie."' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal != '' && $mesadocao == 'branco' && $anoadocao != 'branco' && $lt == '' && $especie == '' && $posadocao =='' && $adotante == ''){
            /*echo "caiu aqui 8";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND DATA_ADOCAO LIKE '".$anoadocao."-%' and NOME_ANIMAL LIKE '%".$nomeanimal."%' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt != '' && $especie == '' && $posadocao =='' && $adotante == ''){
            /*echo "caiu aqui 9";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND LAR_TEMPORARIO like '%".$lt."%' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal != '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt != '' && $especie == '' && $posadocao =='' && $adotante == ''){
            /*echo "caiu aqui 10";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND NOME_ANIMAL LIKE '%".$nomeanimal."%' AND LAR_TEMPORARIO like '%".$lt."%' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie != '' && $posadocao =='' && $adotante == ''){
            /*echo "caiu aqui 11";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND ESPECIE = '".$especie."' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao != 'branco' && $anoadocao == 'branco' && $lt == '' && $especie != '' && $posadocao =='' && $adotante == ''){
            /*echo "caiu aqui 12";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND DATA_ADOCAO LIKE '%".$mesadocao."-%' AND ESPECIE = '".$especie."' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao != '' && $lt == '' && $especie != '' && $posadocao =='' && $adotante == ''){
            /*echo "caiu aqui 13";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND ESPECIE = '".$especie."' AND DATA_ADOCAO LIKE '".$anoadocao."-%' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie == '' && $posadocao =='Sim' && $adotante == ''){
            /*echo "caiu aqui 14";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND STATUS_POS = 'Pós adoção ok' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie == '' && $posadocao =='Não' && $adotante == ''){
            /*echo "caiu aqui 15";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND STATUS_POS <> 'Pós adoção ok' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie == '' && $posadocao == '' && $adotante == ''){
            /*echo "caiu aqui 16";*/
        			$query = "SELECT * FROM TERMO_ADOCAO ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal != '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie == '' && $posadocao == '' && $adotante != ''){
            /*echo "caiu aqui 17";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND NOME_ANIMAL LIKE '%".$nomeanimal."%' AND ADOTANTE LIKE '%".$adotante."%' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie == '' && $posadocao == '' && $adotante != ''){
            /*echo "caiu aqui 18";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND ADOTANTE LIKE '%".$adotante."%' AND REPROVADO <> 'Sim' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt != '' && $especie != '' && $posadocao == '' && $adotante == ''){
            /*echo "caiu aqui 19";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND LAR_TEMPORARIO like '%".$lt."%' AND ESPECIE ='".$especie."' ORDER BY DATA_ADOCAO DESC";
        } elseif ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt != '' && $especie == '' && $posadocao == '' && $adotante != ''){
            /*echo "caiu aqui 20";*/
        			$query = "SELECT * FROM TERMO_ADOCAO WHERE REPROVADO <> 'Sim' AND LAR_TEMPORARIO like '%".$lt."%' AND ADOTANTE LIKE '%".$adotante."%' ORDER BY DATA_ADOCAO DESC";
        } 
        
        $select = mysqli_query($connect,$query);
        $reccount = mysqli_num_rows($select);
        
		if ($reccount == 0) {
			echo "<center>Nenhum termo encontrado<br></center>";
		}else{ 
			while ($fetch = mysqli_fetch_row($select)) {
					$idtermo = $fetch[0];	
					$adotante = $fetch[1];
					$celular = $fetch[10];
					$nomeanimal = $fetch[15];
					$especie = $fetch[16];
					$responsavel = $fetch[29];
					$dtadocao = $fetch[32];
					$localadocao = $fetch[33];
					$dtposadocao = $fetch[34];
					$statusposadocao = $fetch[37];
					$lt = $fetch[30];
					$obs = $fetch[36];
					$foto_adotante = $fetch[47];
					echo "
					    <center><img src='/area/imagens/line_termo.png'></center>
                        <div class='container'>
                          <div class='row'>
                            <div class='col-3'><center><figure><a href='/docs/adotantes/".$foto_adotante."' target='_blank'><img src='/docs/adotantes/".$foto_adotante."' class='img-fluid' /></a></figure></center></div>
                          </div>
                        </div>
                       <center> <i>Clique na foto para ampliar</i> <br><br> </center>";  
        		    echo "<table class='table'>";
        		    echo "<tbody>";
					echo "<tr>";
        			echo "<td align='left' colspan='1' scope='row'><b>Termo número:</b></td>";
					echo "<td align='left' colspan='1'>".$idtermo."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' colspan='1' scope='row'><b>Nome do(a) adotante:</b></td>";
					echo "<td align='left' colspan='1'>".$adotante."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td align='left' colspan='1' scope='row'><b>Nome do animal:</b></td>";
					echo "<td align='left' colspan='1'>".$nomeanimal."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td align='left' colspan='1' scope='row'><b>Espécie:</b></td>";
					echo "<td align='left' colspan='1'>".$especie."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td align='left' colspan='1' scope='row'><b>E-mail do responsável (GAAR):</b></td>";
					echo "<td align='left' colspan='1'>".$responsavel."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td align='left' colspan='1' scope='row'><b>Data da adoção:</b></td>";
					echo "<td align='left' colspan='1'>".$dtadocao."</td>";
					echo "</tr>";
					if ($dtposadocao =='0001-01-01'){
					    $dtposadocao ='Não';
					}
					else {
					    $dtposadocao = 'Sim';
					}
					echo "<tr>";
                    echo "<td align='left' colspan='1' scope='row'><b>Pós adoção realizado?:</b></td>";
					echo "<td align='left' colspan='1'>".$dtposadocao."</td>";
					echo "</tr>";
					echo "<tr>";
                    echo "<td align='left' colspan='1' scope='row'><b>Data do pós adoção:</b></td>";
					echo "<td align='left' colspan='1'>".$dtposadocao."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<tr>";
                    echo "<td align='left' colspan='1' scope='row'><b>Observações pós adoção:</b></td>";
					echo "<td align='left' colspan='1'>".$statusposadocao."</td>";
					echo "</tr>";
                    echo "<tr>";
                    echo "<td align='center' colspan='2'>
                                  <a href='formvisualizatermo.php?idtermo=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Visualizar'>
        					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                </svg>
                                  </button></a> &nbsp;
                                  <a href='formatualizatermo.php?idtermo=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Atualizar'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                          <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                        </svg>
                                  </button></a> &nbsp;
                                  <a href='formcadastroreprova.php?idtermo=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Reprovar'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-square-fill' viewBox='0 0 16 16'>
                                          <path d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z'/>
                                        </svg>
                                  </button></a> &nbsp;
                                  <a href='formenvioemailposadocao.php?idtermo=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Enviar e-mail de pós adoção'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-envelope-fill' viewBox='0 0 16 16'>
                                          <path d='M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z'/>
                                        </svg>
                                  </button></a></td>";
					if ($area =='diretoria'){
					    echo "<td><a href='deletatermo.php?idtermo=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Deletar'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                      </svg>
                                  </button></a></td>";
					}
					echo "</tr>";
					echo "</tbody>";
					echo "</table>";
			}
		
		mysqli_close($connect);
		}
		
		echo "<center><a href='pesquisatermo.php' class='btn btn-primary'> Nova pesquisa</a></center>";
		
}
?>
</center>
   </div>
</main>
<footer class="footer">
      <div class="container">
        <span class="text-muted"><center>GAAR - GRUPO DE APOIO AO ANIMAL DE RUA</center></span>
      </div>
</footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>