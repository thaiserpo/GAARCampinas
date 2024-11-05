<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
	    ini_set('display_errors', 1);

		error_reporting(E_ALL);

		$from = "captacao@gaarcampinas.org";
		
		$headers = "MIME-Version: 1.0\n";               
		$headers .= "Content-type: text/html; charset=utf-8\n";            
		$headers .= "From: <{$from}> \r\n";
		$headers .= "Cc: <{$from}> \r\n";
		$headers .= "Bcc: operacional@gaarcampinas.org\r\n";
		$headers .= "Reply-To: <{$from}> \r\n";    
		
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$email = $fetcharea[1];
				
		}

    	$idsocio = $_POST['idsocio'];
    	$nomesocio = $_POST['nomesocio'];
    	$cidadesocio = $_POST['cidadesocio'];
    	$celularsocio = $_POST['celularsocio'];
    	$emailsocio = $_POST['emailsocio'];
    	$valorsocio = $_POST['valorsocio'];
    	$bancosocio = $_POST['bancosocio'];
    	$agsocio = $_POST['agsocio'];
    	$contasocio = $_POST['contasocio'];
    	$dv = $_POST['dv'];
    	$forma = $_POST['forma'];
    	$freq = $_POST['freq'];
    	$diadomesocio = $_POST['diadomesocio'];
    	$animal_atual = $_POST['animal_atual'];
    	$receberlembrete = $_POST['lembrete'];
    	$novoanimal = $_POST['novoanimal'];
    	$cpf = 0;

    	if ($novoanimal <> '0') { /*VAI APADRINHAR UM NOVO ANIMAL */
    	    $id_animal = $novoanimal;
    	    $apadrinha = 'Sim';
    	    $querynomepet = "SELECT NOME_ANIMAL FROM ANIMAL WHERE ID = '$id_animal'";
			$selectnomepet = mysqli_query($connect,$querynomepet);
			$rc = mysqli_fetch_row($selectnomepet);
            $nomedoanimal = $rc[0];
			                
    	    $subject = "[GAAR Campinas] Novo animal apadrinhado";
    	    
    	    $message = "<center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='70' height='70'></center>
    	                <p>Olá ".$nomesocio."! <br><br>
    	    
    	                   Seu cadastro foi atualizado, agora você apadrinha o(a) ".$nomedoanimal."<br><br> 
    	                   
    	                   Agradecemos imensamente o seu apoio, vamos torcer juntos e divulgar bastante para que seu apadrinhado ganhe uma família muito responsável e amorosa :) <br><br>
    	                   
    	                   Link para divulgação: <a href='https://www.gaarcampinas.org/pet.php?id=".$id_animal."' target='_blank'>https://www.gaarcampinas.org/pet.php?id=".$id_animal."</a> <br><br>
    	                   
    	                   Equipe GAAR <br><br>
    	                   
    	                   <i> Este e-mail foi enviado automaticamente pelo nosso sistema</i>";
    	                   
    	    $to = $emailsocio;
    	                   
    	    $result =  mail($to, $subject, $message, $headers);
    
            if ($result){
                echo "<br>E-mail enviado para: ".$emailsocio;
            } else {
                echo "<br>Erro no envio: ".$emailsocio;
            }
    	    
    	} elseif ($novoanimal == '0' && $animal_atual <> '0') { /* NÃO VAI APADRINHAR UM NOVO ANIMAL */
    	    $id_animal = $animal_atual;
    	    $apadrinha = 'Sim';
    	} elseif ($novoanimal == '0' && $animal_atual == '0') {
    	    $id_animal ='0';
    	    $apadrinha ='Não';
    	}
    	
        $query = "UPDATE SOCIO
    				SET 
    				NOME ='$nomesocio',
    				CIDADE ='$cidadesocio',
    				TEL_CELULAR ='$celularsocio',
    				EMAIL ='$emailsocio',
    				VALOR='$valorsocio',
    				FORMA_AJUDAR ='$forma',
    				MELHOR_DIA='$diadomesocio',
    				RECEBER_LEMBRETE='$receberlembrete',
    				BANCO ='$bancosocio',
    				AGENCIA ='$agsocio',
    				CONTA='$contasocio',
    				DV='$dv',
    				FREQ_DOACAO ='$freq',
    				CPF ='$cpf',
    				APADRINHAMENTO='$apadrinha',
    				ID_ANIMAL='$id_animal'
    				WHERE 
    				ID = '$idsocio'";
    				 				
        $update = mysqli_query($connect,$query); 	
        
        if(mysqli_errno($connect) == '0'){
           echo"<script language='javascript' type='text/javascript'>
                              alert('Cadastro atualizado com sucesso!');
                    		  </script>";
            switch ($area) {
				  case 'operacional':
				    if ($subarea == 'lt'){
				        echo "<script>document.location='lt.php'</script>";
				    }  else {
				        echo "<script>document.location='operacional.php'</script>"; 
				    }
				  	
					break;
				  case 'diretoria':
				  	echo "<script>document.location='diretoria.php'</script>";
					break;
				  case 'captacao':
				  	echo "<script>document.location='captacao.php'</script>";
					break;
     			  case 'financeiro':
				  	echo "<script>document.location='financeiro.php'</script>";
					break;
				  case 'admin':
				  	echo "<script>document.location='admin.php'</script>";
					break;
				  case 'comunicacao':
				  	echo "<script>document.location='comunicacao.php'</script>";
					break;
				  case 'clinica':
				  	echo "<script>document.location='vet.php'</script>";
					break;
				  case 'anuncios':
				  	echo "<script>document.location='terceiros.php'</script>";
					break;
				  case 'fornecedor':
				  	echo "<script>document.location='fornec.php'</script>";
					break;
				  case 'socio':
				  	echo "<script>document.location='socio.php'</script>";
					break;
				  
			  }
                    		  
        } else{
              echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
              echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
        }
    
}
mysqli_close($connect);
?>