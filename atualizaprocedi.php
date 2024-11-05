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
    
    <title>GAAR - Atualização de procedimentos</title>
    
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
    	$status = $_POST['status'];
	    $aprovagaar = $_POST['aprovagaar'];

	   $query = "UPDATE PROCEDIMENTOS
					SET 
					STATUS_PROC='$status',
					APROVADOR_GAAR='$aprovagaar'
					WHERE 
					ID = '$id'";
					 				
        $insert = mysqli_query($connect,$query);
		
		$queryprocedi = "SELECT * FROM PROCEDIMENTOS WHERE ID = '$id'";
		$selectprocedi = mysqli_query($connect,$queryprocedi);
        $fetchprocedi = mysqli_fetch_row($selectprocedi);
        
        $nomedoanimal = $fetchprocedi[2];
        $especie = $fetchprocedi[3];
        $nomedotutor = $fetchprocedi[5];
        $requigaar = $fetchprocedi[7];
        $tipoproc = $fetchprocedi[9];
        $clinica = $fetchprocedi[12];
        
        $queryvol = "SELECT * FROM VOLUNTARIOS WHERE NOME = '$requigaar'";
		$selectvol = mysqli_query($connect,$queryvol);
        $fetchvol = mysqli_fetch_row($selectvol);
		
		$emailvoluntario = $fetchvol[4];
		 
        if(mysqli_errno($connect) == '0'){
        
                ini_set('display_errors', 1);
        
        		error_reporting(E_ALL);
        		
                if ($status =='Aprovado' || $status =='Rejeitado') {
                    
                		$from ="operacional@gaarcampinas.org";
                		
                		$to = $emailvoluntario;
                		
                		$subject = "Seu procedimento para o animal ".$nomedoanimal." foi autorizado";
                		
                		$headers = "MIME-Version: 1.0\n";               
                		$headers .= "Content-type: text/html; charset=utf-8\n";            
                		$headers .= "From: <{$from}> \r\n"; 
                		$message = "Olá ".$requigaar.", <br><br>
                		            Seu procedimento de ".$tipoproc." foi autorizado pelo Operacional. <br><br>A Clínica ".$clinica." irá também receber a notificação e realizar o procedimento. <br><br>
                		            
                		            <b>Para consultar todos os seus procedimentos, acesse:</b><br>
                		            
                		            1. <a href='http://gaarcampinas.org/area/login.html' target=_blank> Área restrita</a><br>
                		            2. Meu menu<br>
                		            3. Meus procedimentos <br><br>
                		            
                		            * ESTE E-MAIL FOI ENVIADO AUTOMATICAMENTE PELO SISTEMA";
                		
                		mail($to, $subject, $message, $headers);
                		
                		 echo"<script language='javascript' type='text/javascript'>
                                  alert('Procedimento atualizado');window.location
                                  .href='formpesquisaprocedi.php'</script>";
                                  
                        /* CÓPIA PARA O FINANCEIRO */
                        
                        $from ="operacional@gaarcampinas.org";
                		
                		$to = "thaise.piculi@gmail.com";
                		
                		$subject = "Procedimento autorizado para o animal".$nomedoanimal."";
                		
                		$headers = "MIME-Version: 1.0\n";               
                		$headers .= "Content-type: text/html; charset=utf-8\n";            
                		$headers .= "From: <{$from}> \r\n"; 
                		$message = "Olá Diretoria Financeira, <br><br>
                		            Um procedimento de ".$tipoproc." foi autorizado pelo Operacional. <br><br>A Clínica ".$clinica." irá também receber a notificação e realizar o procedimento. <br><br>
                		            
                		            <b>Dados do procedimento:</b><br>
                		            Nome do animal: ".$nomedoanimal."<br>
                		            Espécie: ".$especie."<br>
                		            Nome do Tutor: ".$nomedotutor."<br>
                		            Solicitante: ".$requigaar."<br>
                		            Aprovador: ".$aprovagaar."<br><br>
                		            
                		            Para consultar todos os procedimentos, acesse:<br>
                		            
                		            1. <a href='http://gaarcampinas.org/area/login.html' target=_blank> Área restrita</a><br>
                		            2. Menu Financeiro<br>
                		            3. Pesquisar procedimentos veterinários<br><br>
                		            
                		            * ESTE E-MAIL FOI ENVIADO AUTOMATICAMENTE PELO SISTEMA";
                		
                		mail($to, $subject, $message, $headers);
                		
                		/* CÓPIA PARA A CLINICA */
                        
                        $from ="operacional@gaarcampinas.org";
                		
                		$to = "thaise.piculi@gmail.com";
                		
                		$subject = "[GAAR Campinas] Procedimento autorizado para o animal".$nomedoanimal."";
                		
                		$headers = "MIME-Version: 1.0\n";               
                		$headers .= "Content-type: text/html; charset=utf-8\n";            
                		$headers .= "From: <{$from}> \r\n"; 
                		$message = "Olá ".$clinica.", <br><br>
                		            Um procedimento de ".$tipoproc." foi autorizado pelo Operacional da ONG GAAR Campinas. <br><br>
                		            
                		            <b>Dados do procedimento:</b><br>
                		            Nome do animal: ".$nomedoanimal."<br>
                		            Espécie: ".$especie."<br>
                		            Nome do Tutor: ".$nomedotutor."<br>
                		            Solicitante: ".$requigaar."<br>
                		            Aprovador: ".$aprovagaar."<br><br>
                		            
                		            Para consultar todos os procedimentos, acesse:<br>
                		            
                		            1. <a href='http://gaarcampinas.org/area/login.html' target=_blank> Área restrita</a><br>
                		            2. Menu Financeiro<br>
                		            3. Pesquisar procedimentos veterinários<br><br>
                		            
                		            * ESTE E-MAIL FOI ENVIADO AUTOMATICAMENTE PELO SISTEMA";
                		
                		mail($to, $subject, $message, $headers);
                		
                		 echo"<script language='javascript' type='text/javascript'>
                                  alert('Procedimento atualizado');window.location
                                  .href='formpesquisaprocedi.php'</script>";
        	    } else {
        	            $from ="operacional@gaarcampinas.org";
                		
                		$to = $emailvoluntario;
                		
                		$subject = "Seu procedimento para o animal ".$nomedoanimal." foi realizado";
                		
                		$headers = "MIME-Version: 1.0\n";               
                		$headers .= "Content-type: text/html; charset=utf-8\n";            
                		$headers .= "From: <{$from}> \r\n"; 
                		$message = "Olá ".$requigaar.", <br><br>
                		            Seu procedimento de ".$tipoproc." foi realizado por ".$aprovagaar.". <br><br>
                		            
                		            <b>Para consultar todos os seus procedimentos, acesse:</b><br>
                		            
                		            1. <a href='http://gaarcampinas.org/area/login.html' target=_blank> Área restrita</a><br>
                		            2. Meu menu<br>
                		            3. Meus procedimentos <br><br>
                		            
                		            * ESTE E-MAIL FOI ENVIADO AUTOMATICAMENTE PELO SISTEMA";
                		
                		mail($to, $subject, $message, $headers);
                		
                		 echo"<script language='javascript' type='text/javascript'>
                                  alert('Procedimento atualizado');window.location
                                  .href='formpesquisaprocedi.php'</script>";
                                  
                        /* CÓPIA PARA O FINANCEIRO */
                        
                        $from ="operacional@gaarcampinas.org";
                		
                		$to = "thaise.piculi@gmail.com";
                		
                		$subject = "Procedimento realizado para o animal".$nomedoanimal."";
                		
                		$headers = "MIME-Version: 1.0\n";               
                		$headers .= "Content-type: text/html; charset=utf-8\n";            
                		$headers .= "From: <{$from}> \r\n"; 
                		$message = "Olá Diretoria Financeira, <br><br>
                		            Um procedimento de ".$tipoproc." foi realizado por ".$aprovagaar.". <br><br>
                		            
                		            <b>Dados do procedimento:</b><br>
                		            Nome do animal: ".$nomedoanimal."<br>
                		            Espécie: ".$especie."<br>
                		            Nome do Tutor: ".$nomedotutor."<br>
                		            Solicitante: ".$requigaar."<br>
                		            Aprovador: ".$aprovagaar."<br><br>
                		            
                		            Para consultar todos os procedimentos, acesse:<br>
                		            
                		            1. <a href='http://gaarcampinas.org/area/login.html' target=_blank> Área restrita</a><br>
                		            2. Menu Financeiro<br>
                		            3. Pesquisar procedimentos veterinários<br><br>
                		            
                		            * ESTE E-MAIL FOI ENVIADO AUTOMATICAMENTE PELO SISTEMA";
                		
                		mail($to, $subject, $message, $headers);
        	    }
            }
	    else{
		echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                  echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                  echo "<a href='formpesquisaprocedi.php' class='btn btn-primary'>Voltar</a></center><br>";
        }
	 
}
?>
