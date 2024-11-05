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
    
    <title>GAAR - Cadastro do bazar</title>
    
</head>
<body> 
<?php 
		
		switch ($area) {
				  case 'operacional':
				    if ($subarea == 'lt'){
				        include_once("menu_lt.php") ;
				    }  else {
				        include_once("menu_operacional.php") ;    
				    }
				  	
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
$tipobazar = $_POST['tipobazar'];

/*VENDAS FÍSICAS */
$nomebazar = $_POST['nomebazar'];
$local = $_POST['local'];
$datafisica = $_POST['datafisica'];
$despdiarias = $_POST['despdiarias'];
$vendascartao = $_POST['vendascartao'];
$vendasfisicas = $_POST['vendasfisicas'];
$aberturacaixa = $_POST['aberturacaixa'];
$fechamentocaixa = $_POST['fechamentocaixa'];
$lucro = $_POST['lucro'];
$obs = $_POST['obs'];


/* VENDAS ONLINE */
$dataonline = $_POST['dataonline'];
$valoronline = $_POST['valoronline'];
$meiopgtoonline = $_POST['meiopgtoonline'];
$obsonline = $_POST['obsonline'];


/* VENDAS FORA */
$datafora = $_POST['datafora'];
$vendasfora = $_POST['vendasfora'];
$meiopgtofora = $_POST['meiopgtofora'];
$obsfora = $_POST['obsfora'];


/* DESPESAS */

$descdespesa = $_POST['descdespesa'];
$datadespesa = $_POST['datadespesa'];
$valordespesa = $_POST['valordespesa'];
$meiopgtodesp = $_POST['meiopgtodesp'];
$obsdespesa = $_POST['obsdespesa']; ;


        /*if (move_uploaded_file($_FILES['fotofisico']['tmp_name'], $uploadfilefisico)) {
		    $nome_fotofisico = $uploadfilefisico;
	    }
	    else{
	        $nome_fotofisico = '';
	    }
	    
        if (move_uploaded_file($_FILES['fotoonline']['tmp_name'], $uploadfileonline)) {
		    $nome_fotoonline = $uploadfileonline;
	    }
	    else{
	        $nome_fotoonline = '';
	    }
	    
	    if (move_uploaded_file($_FILES['fotofora']['tmp_name'], $uploadfilefora)) {
		    $nome_fotofora = $uploadfilefora;
	    }
	    else{
	        $nome_fotofora = '';
	    }
	    */
		
		switch ($tipobazar) {
		    case 'Físico':
		        $uploaddir = '/home/gaarca06/public_html/docs/captacao/bazar/fisico/';
                $uploadfile = $uploaddir.($_FILES['fotofisico']['name']);
                $nome_foto = $_FILES['fotofisico']['name'];

		        move_uploaded_file($_FILES['fotofisico']['tmp_name'], $uploadfile);
		        
		        $query = "INSERT INTO BAZAR
        					(NOME_BAZAR, 
        					LOCAL_BAZAR, 
        					DATA, 
        					DESPESAS_DIARIAS, 
        					VENDAS_CARTAO, 
        					DEPOSITO_BAZ_FISICO, 
        					DEPOSITO_BAZ_ONLINE, 
        					ABERTURA_CAIXA, 
        					FECHAMENTO_CAIXA, 
        					OBS, 
        					COMPROVANTE, 
        					TIPO_BAZAR,
        					MEIO_PGTO,
        					LUCRO) 
        					VALUES
                            ('$nomebazar',
                            '$local',
                            '$datafisica',
                            '$despdiarias',
                            '$vendascartao',
                            '$vendasfisicas',
                            '0',
                            '$aberturacaixa',
                            '$fechamentocaixa',
                            '$obs',
                            '$nome_foto',
                            '$tipobazar',
                            '0',
                            '$lucro')";
        						
                $insert = mysqli_query($connect,$query); 
                
                if(mysqli_errno($connect) == '0'){
                  echo"<script language='javascript' type='text/javascript'>
                  alert('Bazar físico cadastrado com sucesso!');
        		  window.location.href='formcadastrobazar.php'</script>";
        	    }else{ 
        	        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                    echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                    echo "<a href='formcadastrobazar.php' class='btn btn-primary'>Voltar</a></center><br>";
                }
                
            case 'Online':
                $uploaddir = '/home/gaarca06/public_html/docs/captacao/bazar/online/';
                $uploadfile = $uploaddir.($_FILES['fotoonline']['name']);
                $nome_foto = $_FILES['fotoonline']['name'];

		        move_uploaded_file($_FILES['fotoonline']['tmp_name'], $uploadfile);
                
		        $query = "INSERT INTO BAZAR
        					(NOME_BAZAR, 
        					LOCAL_BAZAR, 
        					DATA, 
        					DESPESAS_DIARIAS, 
        					VENDAS_CARTAO, 
        					DEPOSITO_BAZ_FISICO, 
        					DEPOSITO_BAZ_ONLINE, 
        					ABERTURA_CAIXA, 
        					FECHAMENTO_CAIXA, 
        					OBS, 
        					COMPROVANTE, 
        					TIPO_BAZAR,
        					MEIO_PGTO,
        					LUCRO) 
        					VALUES
                            ('Bazar online',
                            'Online',
                            '$dataonline',
                            '0',
                            '0',
                            '0',
                            '$valoronline',
                            '0',
                            '0',
                            '$obsonline',
                            '$nome_foto',
                            '$tipobazar',
                            '$meiopgtoonline',
                            '0')";
        						
                $insert = mysqli_query($connect,$query); 
                
                if(mysqli_errno($connect) == '0'){
                  echo"<script language='javascript' type='text/javascript'>
                  alert('Bazar online cadastrado com sucesso!');
        		  window.location.href='formcadastrobazar.php'</script>";
        	    }else{ 
        	        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                    echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                    echo "<a href='formcadastrobazar.php' class='btn btn-primary'>Voltar</a></center><br>";
                }
                
            case 'Fora do bazar':
                $uploaddir = '/home/gaarca06/public_html/docs/captacao/bazar/fora/';
                $uploadfile = $uploaddir.($_FILES['fotofora']['name']);
                $nome_foto = $_FILES['fotofora']['name'];

		        if (move_uploaded_file($_FILES['fotofora']['tmp_name'], $uploadfile)) {
            		    $foto = $uploadfile;
            	 }
                
		        $query = "INSERT INTO BAZAR
        					(NOME_BAZAR, 
        					LOCAL_BAZAR, 
        					DATA, 
        					DESPESAS_DIARIAS, 
        					VENDAS_CARTAO, 
        					DEPOSITO_BAZ_FISICO, 
        					DEPOSITO_BAZ_ONLINE, 
        					ABERTURA_CAIXA, 
        					FECHAMENTO_CAIXA, 
        					OBS, 
        					COMPROVANTE, 
        					TIPO_BAZAR,
        					MEIO_PGTO,
        					LUCRO) 
        					VALUES
                            ('Fora do bazar',
                            'Fora do bazar',
                            '$datafora',
                            '0',
                            '0',
                            '0',
                            '$vendasfora',
                            '0',
                            '0',
                            '$obsfora',
                            '$nome_foto',
                            '$tipobazar',
                            '$meiopgtofora',
                            '0')";
        						
                $insert = mysqli_query($connect,$query); 
                
                if(mysqli_errno($connect) == '0'){
                echo"<script language='javascript' type='text/javascript'>
                  alert('Venda fora do bazar cadastrada com sucesso!');
        		  window.location.href='formcadastrobazar.php'</script>";
        	    }else{ 
        	        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                    echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                    echo "<a href='formcadastrobazar.php' class='btn btn-primary'>Voltar</a></center><br>";
                }
                
            case 'Despesas':
                $uploaddir = '/home/gaarca06/public_html/docs/captacao/bazar/despesas/';
                $uploadfile = $uploaddir.($_FILES['fotodespesa']['name']);
                $nome_foto = $_FILES['fotodespesa']['name'];

		        if (move_uploaded_file($_FILES['fotodespesa']['tmp_name'], $uploadfile)) {
            		    $foto = $uploadfile;
            	 }
                
		        $query = "INSERT INTO BAZAR
        					(NOME_BAZAR, 
        					LOCAL_BAZAR, 
        					DATA, 
        					DESPESAS_DIARIAS, 
        					VENDAS_CARTAO, 
        					DEPOSITO_BAZ_FISICO, 
        					DEPOSITO_BAZ_ONLINE, 
        					ABERTURA_CAIXA, 
        					FECHAMENTO_CAIXA, 
        					OBS, 
        					COMPROVANTE, 
        					TIPO_BAZAR,
        					MEIO_PGTO,
        					LUCRO) 
        					VALUES
                            ('Fora do bazar',
                            'Fora do bazar',
                            '$datadespesa',
                            '0',
                            '0',
                            '0',
                            '$valordespesa',
                            '0',
                            '0',
                            '$obsdespesa',
                            '$nome_foto',
                            '$tipobazar',
                            '$meiopgtodesp',
                            '0')";
        						
                $insert = mysqli_query($connect,$query); 
                
                if(mysqli_errno($connect) == '0'){
                echo"<script language='javascript' type='text/javascript'>
                  alert('Despesa cadastrada com sucesso!');
        		  window.location.href='formcadastrobazar.php'</script>";
        	    }else{ 
        	        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                    echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                    echo "<a href='formcadastrobazar.php' class='btn btn-primary'>Voltar</a></center><br>";
                }
		}
        		
		}
?>