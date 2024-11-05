<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
} else {
		  
		  $queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		  $selectarea = mysqli_query($connect,$queryarea);
		
		  while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		  }
		  
?>

<!DOCTYPE html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <!--site responsivo-->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    <title>GAAR - Pesquisa de termo</title>
</head>
<body class="texto">
<header>
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
</header>
<div class='div-responsive'><br>
<?php

mysqli_set_charset('utf8');

$nomeanimal = strtoupper($_POST['nomedoanimal']);
$mesadocao = $_POST['mesdaadocao'];
$anoadocao = $_POST['anodaadocao'];
$lt = $_POST['lart'];
$especie = $_POST['especie'];
$posadocao = $_POST['posadocao'];
$status = $_POST['status'];

/*echo "nomeanimal: ".$nomeanimal; 
echo "<br>";
echo "mesadocao: ".$mesadocao;
echo "<br>"; 
echo "anoadocao: ".$anoadocao;
echo "<br>"; 
echo "lt: ".$lt;
echo "<br>"; 
echo "especie: ".$especie;
echo "<br>"; 
echo "posadocao: ".$posadoca;
echo "<br>"; 
echo "status: ".$status;
echo "<br>"; */

if ($nomeanimal != '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie == '' && $posadocao ==''){
			$query = "SELECT * FROM TERMO_ADOCAO WHERE NOME_ANIMAL LIKE '%".$nomeanimal."%' ORDER BY DATA_ADOCAO DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}

if ($nomeanimal == '' && $mesadocao != 'branco' && $anoadocao == 'branco' && $lt == '' && $especie == '' && $posadocao ==''){
			$query = "SELECT * FROM TERMO_ADOCAO WHERE DATA_ADOCAO LIKE '%-".$mesadocao."-%' ORDER BY DATA_ADOCAO DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
} 
if ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao != 'branco' && $lt == '' && $especie == '' && $posadocao ==''){
			$query = "SELECT * FROM TERMO_ADOCAO WHERE DATA_ADOCAO LIKE '".$anoadocao."-%' ORDER BY DATA_ADOCAO DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}
if ($nomeanimal == '' && $mesadocao != 'branco' && $anoadocao != 'branco' && $lt == '' && $especie == '' && $posadocao ==''){
			$query = "SELECT * FROM TERMO_ADOCAO WHERE DATA_ADOCAO LIKE '".$anoadocao."-".$mesadocao."-%' ORDER BY DATA_ADOCAO DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}
if ($nomeanimal != '' && $mesadocao == 'branco' && $anoadocao != 'branco' && $lt == '' && $especie == '' && $posadocao ==''){
			$query = "SELECT * FROM TERMO_ADOCAO WHERE DATA_ADOCAO LIKE '".$anoadocao."-%' and NOME_ANIMAL LIKE '%".$nomeanimal."%' ORDER BY DATA_ADOCAO DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}		
if ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt != '' && $especie == '' && $posadocao ==''){
			$query = "SELECT * FROM TERMO_ADOCAO WHERE LAR_TEMPORARIO like '%".$lt."%' ORDER BY DATA_ADOCAO DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}
if ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie != '' && $posadocao ==''){
			$query = "SELECT * FROM TERMO_ADOCAO WHERE ESPECIE = '$especie' ORDER BY DATA_ADOCAO DESC";
			$select = mysqli_query($connect,$query);		
			$reccount = mysqli_num_rows($select);
}
if ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao != '' && $lt == '' && $especie != '' && $posadocao ==''){
			$query = "SELECT * FROM TERMO_ADOCAO WHERE ESPECIE = '$especie' AND DATA_ADOCAO LIKE '".$anoadocao."-%' ORDER BY DATA_ADOCAO DESC";
			$select = mysqli_query($connect,$query);		
			$reccount = mysqli_num_rows($select);
}

if ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie == '' && $posadocao =='Sim'){
			$query = "SELECT * FROM TERMO_ADOCAO WHERE POS_ADOCAO <> '0001-01-01' ORDER BY DATA_ADOCAO DESC";
			$select = mysqli_query($connect,$query);		
			$reccount = mysqli_num_rows($select);
}
if ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie == '' && $posadocao =='Não'){
			$query = "SELECT * FROM TERMO_ADOCAO WHERE POS_ADOCAO == '0001-01-01' ORDER BY DATA_ADOCAO DESC";
			$select = mysqli_query($connect,$query);		
			$reccount = mysqli_num_rows($select);
}
if ($nomeanimal == '' && $mesadocao == 'branco' && $anoadocao == 'branco' && $lt == '' && $especie == '' && $posadocao == ''){
			$query = "SELECT * FROM TERMO_ADOCAO ORDER BY DATA_ADOCAO DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);
}


		if ($reccount == 0) {
			echo "<center>Nenhum animal encontrado<br>
			      <table>
			      <tr>
			        <td align='center' colspan='8'><a href='formprecadastrotermo.php' class='button'> Cadastre o termo aqui</a></td>
			      </tr>
			      </table></center>";
		}else{ 
			echo "<center><table border='0' width='100%' bgcolor='#ffffff'>";
			echo "<thead>";
			echo "<tr class='relatorio-table-tr-header-1'>
					<td colspan='1' align='center' valign='middle'><h2>&nbsp;</h2></td>
					<td colspan='1' align='center' valign='middle'><h2>&nbsp;</h2></td>
					<td colspan='3' align='center' valign='middle'><h2>Dados do animal</h2></td>
					<td colspan='3' align='center' valign='middle'><h2>Dados da adoção</h2></td>		
				  </tr>";
			echo "<tr class='relatorio-table-tr-header-2'>";
			echo "<td align='center'>";
			echo "<b>Termo</b>";
			echo "</td>";
			echo "<td align='center'>";
			echo "<b>Adotante</b>";
			echo "</td>";
			/*echo "<td align='center'>";
			echo "<b>Celular</b>";
			echo "</td>";*/
			echo "<td align='center'>";
			echo "<b>Nome</b>";
			echo "</td>";
			echo "<td align='center'>";
			echo "<b>Espécie</b>";
			echo "</td>";
			echo "<td align='center'>";
			echo "<b>LT</b>";
			echo "</td>";
			echo "<td align='center'>";
			echo "<b>Data</b>";
			echo "</td>";
			echo "<td align='center'>";
			echo "<b>Local</b>";
			echo "</td>";
			echo "<td align='center'>";
			echo "<b>Pós adoção</b>";
			echo "</td>";
			echo "</font>";
			echo "</tr>";
			echo "</thead>";
			while ($fetch = mysqli_fetch_row($select)) {
					$idtermo = $fetch[0];	
					$adotante = $fetch[1];
					$celular = $fetch[10];
					$nomeanimal = $fetch[15];
					$especie = $fetch[16];
					$dtadocao = $fetch[32];
					$localadocao = $fetch[33];
					$dtposadocao = $fetch[34];
					$lt = $fetch[30];
					$obs = $fetch[36];
					echo "<tbody>";
					echo "<tr class='tr'>";
					echo "<td>";
					echo $idtermo;
					echo "</td>";
					echo "<td>";
					echo $adotante;
					echo "</td>";
					/*echo "<td>";
					echo $celular;
					echo "</td>";*/
					echo "<td>";
					echo $nomeanimal;
					echo "</td>";
					echo "<td>";
					echo $especie;
					echo "</td>";
					echo "<td>";
					echo $lt;
					echo "</td>";
					echo "<td>";
					echo $dtadocao;
					echo "</td>";
					echo "<td>";
					echo $localadocao;
					echo "</td>";
					echo "<td>";
					echo $dtposadocao;
					echo "</td>";
					echo "<td><a href='formatualizatermo.php?idtermo=".$fetch[0]."' class='button'>Atualizar</a>&nbsp;</td>";
					echo "<td><a href='formatualizatermo.php?idtermo=".$fetch[0]."' class='button'>Visualizar</a>&nbsp;</td>";
					echo "<td><a href='deletatermo.php?idtermo=".$fetch[0]."' class='button'>Deletar</a>&nbsp;</td>";
					echo "<td><a href='formenvioemailposadocao.php?idtermo=".$fetch[0]."' class='button'>Pós adoção</a></td>";
					echo "</tr>";
					echo "</tbody>";
			}
		mysqli_data_seek($select, 0 );
		echo " <tr>
			    <td align='center' colspan='8'><a href='pesquisatermo.php' class='button'> Nova pesquisa</a></td>
			   </tr>";
		echo "</table></center><br><br>";
		/*echo "<center>".$reccount." animais encontrados </center><br>";
		echo "<center><table>
		          <tr>
			        <td align='center' colspan='8'><a href='pesquisatermo.php' class='button'> Nova pesquisa</a></td>
			      </tr>
			  </table></center><br>";
		echo "<form action='formatualizatermo.php' method='post' name='atualizatermo'>";
		echo "<table width='300' border='0'>";
		echo "<tr>";
		echo "<td align='left'>Escolha o termo para atualizar: </td>
			  <td align='right'><select name='idtermo'>";
				while ($fetch = mysqli_fetch_row($select)) {
					echo "<option value='".$fetch[0]."' id='".$fetch[0]."'>".$fetch[0]."</option>";
				}
		echo "</select></td>";
		echo "<td><input name='idtermo' id='idtermo' type='text' maxlength='100' required value=".$idtermo."></td>";
		echo "</td>";
		echo "</tr>";
		echo "</table><br>";
		echo "<input type='submit' value='Atualizar' id='atualizar' name='atualizar'>&nbsp;&nbsp;<input type='submit' value='Visualizar' id='visualizar' name='atualizar'>";
		echo "</form>";
		echo "<br>";
		mysqli_data_seek($select, 0 );
		echo "<form action='formenvioemailposadocao.php' method='post' name='envioemail'>";
		echo "<table width='300' border='0'>";
		echo "<tr>";
		echo "<td align='left'>Escolha o termo para enviar e-mail de pós adoção: </td>
			  <td align='right'><select name='idtermo'>";
				while ($fetch = mysqli_fetch_row($select)) {
					echo "<option value='".$fetch[0]."' id='".$fetch[0]."'>".$fetch[0]."</option>";
				}
		echo "</select></td>";
		echo "</td>";
		echo "</tr>";
		echo "</table><br><br>";
		echo "<input type='submit' value='Enviar e-mail' id='envioemail' name='envioemail'></center>";
		echo "</form>";*/
		}
?>
</center>
</div>
<br><br>
<div class="div-responsive">
</div>
</body>
</html>
