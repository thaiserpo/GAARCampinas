<?php 

session_start();

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
    
    <title>GAAR - Atualização de termo</title>
    
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
<?
$id = $_SESSION['idtermo'];
$adotante = $_POST['adotante'];
$rg =$_POST['rg'];
$cpf = $_POST['cpf'];
$endereco = $_POST['endereco'];
$complemento = $_POST['complemento'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$pontoref = $_POST['pontoref'];
$telfixo = $_POST['telfixo'];		
$celular = $_POST['celular'];
$email = $_POST['email'];
$facebook = $_POST['facebook'];
$instagram = $_POST['instagram'];
$profissao = $_POST['profissao'];
$especie = $_POST['especie'];
$sexo = $_POST['sexo'];
$cor = $_POST['cor'];
$porte = $_POST['porte'];
$castrado = $_POST['castrado'];
$dtcastracao = $_POST['dtcastracao'];
$vermifug=$_POST['vermifug'];
$vacinado=$_POST['vacinado'];
$doses = $_POST['doses'];
$possuianimal = $_POST['possuianimal'];
$sesimcastrados = $_POST['sesimcastrados'];
$lt = $_POST['lt'];
$dtadocao = $_POST['dtadocao'];
$localadocao = $_POST['localadocao'];
$teldoador = $_POST['teldoador'];
$emaildoador = $_POST['emaildoador'];
$dtposadocao = $_POST['dtposadocao'];
$posadocaopor = $login;
$obs = $_POST['obs'];
$status = $_POST['statusposadocao'];
$pgtotaxa = $_POST['pgtotaxa'];
$obstaxa = $_POST['obstaxa'];
$updatefoto = $_POST['updatefoto'];
$updatefotoad = $_POST['updatefotoad'];
$nome_fotoori = $_POST['nome_fotoori'];
$nome_fotoadori = $_POST['nome_fotoadori'];

if ($updatefoto =='Sim' && $updatefotoad == 'Sim'){
      $uploaddir = '/home/gaarca06/public_html/docs/termos/';
      $uploadfile = $uploaddir.($_FILES['foto']['name']);
      $nome_foto = $_FILES['foto']['name'];

	  move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
	  
	  $uploaddir_ad = '/home/gaarca06/public_html/docs/adotantes/';
      $uploadfile_ad = $uploaddir_ad.($_FILES['fotoad']['name']);
      $nome_fotoad = $_FILES['fotoad']['name']; 
    
      move_uploaded_file($_FILES['fotoad']['tmp_name'], $uploadfile_ad);
    
      $query = "UPDATE TERMO_ADOCAO 
					SET 
					ADOTANTE = '$adotante',
					RG = '$rg',
					CPF = '$cpf',
					ENDERECO='$endereco',
					BAIRRO='$bairro',
					CEP='$cep',
					CIDADE='$cidade',
					PONTO_REF='$pontoref',
					TEL_FIXO='$telfixo',
					TEL_CEL='$celular',
					EMAIL='$email',
					FACEBOOK='$facebook',
					INSTAGRAM='$instagram',
					PROFISSAO='$profissao',
					ESPECIE = '$especie',
					SEXO = '$sexo',
				    COR = '$cor',
				    PORTE ='$porte',
					CASTRADO='$castrado',
					DATA_CASTRACAO='$dtcastracao',
					VERMIFUGADO='$vermifug',
					VACINADO='$vacinado',
					DOSES='$doses',
					POSSUI_ANIMAIS='$possuianimal',
					POSSUI_ANIMAIS_CASTRADOS='$sesimcastrados',
					LAR_TEMPORARIO='$lt',
					DATA_ADOCAO='$dtadocao',
					LOCAL_ADOCAO ='$localadocao',
					POS_ADOCAO ='$dtposadocao',
					POS_ADOCAO_POR='$posadocaopor',
					OBS='$obs',
					STATUS_POS='$status',
					COMPLEMENTO = '$complemento',
					NUMERO = '$numero',
					ESTADO = '$estado',
					PGTO_TAXA='$pgtotaxa',
					OBS_TAXA = '$obstaxa',
					FOTO = '$nome_foto',
					FOTO_ADOTANTE = '$nome_fotoad'
					WHERE ID ='$id'"; 
					
		unlink($nome_fotoori);
		unlink($nome_fotoadori);
		
} 

else if (($updatefoto =='' || $updatefoto =='Não') && $updatefotoad == 'Sim'){
	  $uploaddir_ad = '/home/gaarca06/public_html/docs/adotantes/';
      $uploadfile_ad = $uploaddir_ad.($_FILES['fotoad']['name']);
      $nome_fotoad = $_FILES['fotoad']['name']; 
    
      move_uploaded_file($_FILES['fotoad']['tmp_name'], $uploadfile_ad);
    
      $query = "UPDATE TERMO_ADOCAO 
					SET 
					ADOTANTE = '$adotante',
					RG = '$rg',
					CPF = '$cpf',
					ENDERECO='$endereco',
					BAIRRO='$bairro',
					CEP='$cep',
					CIDADE='$cidade',
					PONTO_REF='$pontoref',
					TEL_FIXO='$telfixo',
					TEL_CEL='$celular',
					EMAIL='$email',
					FACEBOOK='$facebook',
					INSTAGRAM='$instagram',
					PROFISSAO='$profissao',
					ESPECIE = '$especie',
					SEXO = '$sexo',
				    COR = '$cor',
				    PORTE ='$porte',
					CASTRADO='$castrado',
					DATA_CASTRACAO='$dtcastracao',
					VERMIFUGADO='$vermifug',
					VACINADO='$vacinado',
					DOSES='$doses',
					POSSUI_ANIMAIS='$possuianimal',
					POSSUI_ANIMAIS_CASTRADOS='$sesimcastrados',
					LAR_TEMPORARIO='$lt',
					DATA_ADOCAO='$dtadocao',
					LOCAL_ADOCAO ='$localadocao',
					POS_ADOCAO ='$dtposadocao',
					POS_ADOCAO_POR='$posadocaopor',
					OBS='$obs',
					STATUS_POS='$status',
					COMPLEMENTO = '$complemento',
					NUMERO = '$numero',
					ESTADO = '$estado',
					PGTO_TAXA='$pgtotaxa',
					OBS_TAXA = '$obstaxa',
					FOTO_ADOTANTE = '$nome_fotoad'
					WHERE ID ='$id'"; 
		
		unlink($nome_fotoadori);
}

else if (($updatefotoad =='' || $updatefotoad =='Não') && $updatefoto == 'Sim'){
      $uploaddir = '/home/gaarca06/public_html/docs/termos/';
      $uploadfile = $uploaddir.($_FILES['foto']['name']);
      $nome_foto = $_FILES['foto']['name'];

	  move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
	  
      $query = "UPDATE TERMO_ADOCAO 
					SET 
					ADOTANTE = '$adotante',
					RG = '$rg',
					CPF = '$cpf',
					ENDERECO='$endereco',
					BAIRRO='$bairro',
					CEP='$cep',
					CIDADE='$cidade',
					PONTO_REF='$pontoref',
					TEL_FIXO='$telfixo',
					TEL_CEL='$celular',
					EMAIL='$email',
					FACEBOOK='$facebook',
					INSTAGRAM='$instagram',
					PROFISSAO='$profissao',
					ESPECIE = '$especie',
					SEXO = '$sexo',
				    COR = '$cor',
				    PORTE ='$porte',
					CASTRADO='$castrado',
					DATA_CASTRACAO='$dtcastracao',
					VERMIFUGADO='$vermifug',
					VACINADO='$vacinado',
					DOSES='$doses',
					POSSUI_ANIMAIS='$possuianimal',
					POSSUI_ANIMAIS_CASTRADOS='$sesimcastrados',
					LAR_TEMPORARIO='$lt',
					DATA_ADOCAO='$dtadocao',
					LOCAL_ADOCAO ='$localadocao',
					POS_ADOCAO ='$dtposadocao',
					POS_ADOCAO_POR='$posadocaopor',
					OBS='$obs',
					STATUS_POS='$status',
					COMPLEMENTO = '$complemento',
					NUMERO = '$numero',
					ESTADO = '$estado',
					PGTO_TAXA='$pgtotaxa',
					OBS_TAXA = '$obstaxa',
					FOTO = '$nome_foto'
					WHERE ID ='$id'"; 
					
		unlink($nome_fotoori);
} 

else {
    $query = "UPDATE TERMO_ADOCAO 
					SET 
					ADOTANTE = '$adotante',
					RG = '$rg',
					CPF = '$cpf',
					ENDERECO='$endereco',
					BAIRRO='$bairro',
					CEP='$cep',
					CIDADE='$cidade',
					PONTO_REF='$pontoref',
					TEL_FIXO='$telfixo',
					TEL_CEL='$celular',
					EMAIL='$email',
					FACEBOOK='$facebook',
					INSTAGRAM='$instagram',
					PROFISSAO='$profissao',
					ESPECIE = '$especie',
					SEXO = '$sexo',
				    COR = '$cor',
				    PORTE ='$porte',
					CASTRADO='$castrado',
					DATA_CASTRACAO='$dtcastracao',
					VERMIFUGADO='$vermifug',
					VACINADO='$vacinado',
					DOSES='$doses',
					POSSUI_ANIMAIS='$possuianimal',
					POSSUI_ANIMAIS_CASTRADOS='$sesimcastrados',
					LAR_TEMPORARIO='$lt',
					DATA_ADOCAO='$dtadocao',
					LOCAL_ADOCAO ='$localadocao',
					POS_ADOCAO ='$dtposadocao',
					POS_ADOCAO_POR='$posadocaopor',
					OBS='$obs',
					STATUS_POS='$status',
					COMPLEMENTO = '$complemento',
					NUMERO = '$numero',
					ESTADO = '$estado',
					PGTO_TAXA='$pgtotaxa',
					OBS_TAXA = '$obstaxa'
					WHERE ID ='$id'"; 
}
					
		$update = mysqli_query($connect,$query);	
		
       if(mysqli_errno($connect) == '0' ){
           /*echo "Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect);*/
          echo"<script language='javascript' type='text/javascript'>
          alert('Termo atualizado com sucesso!');
		  window.location.href='pesquisatermo.php'</script>";
        }else{
          echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
          echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
          echo "<a href='formatualizatermo.php?idtermo=".$id."' class='btn btn-primary'>Voltar ao termo ".$id."</a></center><br>";
        }
}
?>
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