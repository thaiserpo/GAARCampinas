<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	    echo"<script language='javascript' type='text/javascript'>
        alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
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
    
    <title>GAAR - Atualização de valores</title>
    
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
				  	include_once("menu_clinica.php") ;
					break;
				  case 'veterinario':
				  	include_once("menu_veterinario.php") ;
					break;
				  case 'lt':
				  	include_once("menu_lt.php") ;
					break;
			  }
		$id = $_POST['id'];
	    $valorunitgato = $_POST['valorunitgato'];
    	$valorunitgata = $_POST['valorunitgata'];
    	$valorunitmachop = $_POST['valorunitmachop'];
    	$valorunitmachom = $_POST['valorunitmachom'];
    	$valorunitmachog = $_POST['valorunitmachog'];
    	$valorunitfemeap = $_POST['valorunitfemeap'];
    	$valorunitfemeam = $_POST['valorunitfemeam'];
    	$valorunitfemeag = $_POST['valorunitfemeag'];

	   $query = "UPDATE CLINICAS
					SET 
					VALOR_GATO='$valorunitgato',
					VALOR_GATA='$valorunitgata',
					VALOR_CAOP='$valorunitmachop',
					VALOR_CAOM='$valorunitmachom',
					VALOR_CAOG='$valorunitmachog',
					VALOR_CADELAP='$valorunitfemeap',
					VALOR_CADELAM='$valorunitfemeam',
					VALOR_CADELAG='$valorunitfemeag'
					WHERE 
					ID = '$id'";
					 				
        $insert = mysqli_query($connect,$query);

        if(mysqli_errno($connect) == '0'){
    		 echo"<script language='javascript' type='text/javascript'>
                      alert('Valores atualizados');window.location
                      .href='formatualizavalores.php'</script>";
                                  
        } else {
        
		echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                  echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                  echo "<a href='formatualizavalores.php' class='btn btn-primary'>Voltar</a></center><br>";
        }
	 
}
?>
