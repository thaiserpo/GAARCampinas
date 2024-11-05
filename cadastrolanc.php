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
    
    <title>GAAR - Cadastro de lançamentos</title>
    
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
        <br>
<?
$dtlanc = $_POST['dtlanci'];
$socio = $_POST['socio'];
$vet = $_POST['vet'];
$lt = $_POST['lt'];
$desc = $_POST['desc'];
$tipo = $_POST['tipo'];
$valor = $_POST['valor'];
$novovalor = $_POST['novovalor'];
/*$valorsocio = $_POST['valorsocio'];*/
$nomesocio = explode (",",$_POST['valorsocio']);
$valorcont = $_POST['valorcont'];
$banco = $_POST['banco'];
$nome_file = $_FILES['file']['name'];




        switch ($tipo){
            case 'LT':
                $desc = $lt;
                break;
                
            case 'Sócio':  
                if ($desc != 'Outros'){ 
                    $desc = $nomesocio[0];
                    if ($valor == '') {
                        $valor = $nomesocio[1];
                    }
                }
                break;
                
            case 'Veterinário':  
                $desc = $vet;
                break;
        }
        

	    if ($valorcont == ''){
	        $valorcont = $valor;
	        if ($tipo=='NFP'){
	            $valor = floatval($valor) / 2 ;   
	        }
	    }
	    
	    if ($banco == '' || $dtlanc == '' ) {
	          echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
              echo "<p>Banco ou data de lançamento inválida</p><br>";
              echo "<a href='formcadastrolanc.php' class='btn btn-primary'>Voltar</a></center><br>";
	    } else {
            $query = "INSERT INTO FINANCEIRO
    					(DATA_LANC, 
    				    DESCRICAO_LANC, 
    					TIPO_LANC, 
    					VALOR_LANC, 
    					BANCO_LANC,
    					VALOR_REL_CONTABIL,
    					USUARIO ) 
    					VALUES
                    ('$dtlanc',
                    '$desc',
                    '$tipo',
                    '$valor',
                    '$banco',
                    '$valorcont',
                    '$login')";
    						
            $insert = mysqli_query($connect,$query); 
        
            if (mysqli_errno($connect) == '0'){
                if ($nome_file != ''){ 
                    $querydoc = "INSERT INTO DOCUMENTACAO
            					(EVENTO, 
            					ENDERECO, 
            					DATA, 
            					DESCRICAO, 
            					VOLUNTARIOS_PRESENTES, 
            					FILE,
            					AREA_PRINCIPAL) 
            					VALUES
                                ('',
                                '',
                                '$dtlanc',
                                '$desc',
                                '',
                                '$nome_file', 
                                'Financeiro')";
            						
                    $insertdoc = mysqli_query($connect,$querydoc); 	
                    
                    echo "<br>sql error insert doc: ".mysqli_errno($connect);
                    
                    if (mysqli_errno($connect) == '0'){
                		/*	echo "Insert code: ".$insert;
                			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
                          echo"<script language='javascript' type='text/javascript'>
                          alert('Lançamento cadastrado com sucesso!');
                		  window.location.href='formcadastrolanc.php'</script>";
        	        }else{ 
                		  echo "<center><h3>Oooops! Algo deu errado ao cadastrar o comprovante...</h3><br>";
                          echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                          echo "<a href='formcadastrolanc.php' class='btn btn-primary'>Voltar</a></center><br>";
                          /*echo"<script language='javascript' type='text/javascript'>
                          alert('Erro ao cadastrar');window.location
                          .href='termo.php'</script>";*/
                }
                }
                else {
                    echo"<script language='javascript' type='text/javascript'>
                          alert('Lançamento cadastrado com sucesso!');
                		  window.location.href='formcadastrolanc.php'</script>";
                }
	        } else{ 
        		  echo "<center><h3>Oooops! Algo deu errado ao cadastrar o lançamento...</h3><br>";
                  echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                  echo "<a href='formcadastrolanc.php' class='btn btn-primary'>Voltar</a></center><br>";
            }
        }
}
?>

