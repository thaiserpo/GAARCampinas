<?php 
session_start();

include ("conexao.php"); 


        $_SESSION['login'] = $_POST['login'];
        $login = $_SESSION['login'];
        $senha = md5($_POST['senha']);

        $queryarea = "SELECT EMAIL,NOME FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$email = $fetcharea[0];
				$nome = $fetcharea[2];
		}        

        $queryupdate = "UPDATE VOLUNTARIOS
					SET 
					SENHA='$senha'
					WHERE 
					USUARIO = '$login'";
					 				
        $update = mysqli_query($connect,$queryupdate); 	
		 
        if (mysqli_errno($connect) == '0'){
        /*echo "Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);*/
        
        ini_set('display_errors', 1);

		error_reporting(E_ALL);

		$from = "contato@gaarcampinas.org";
		
		$to = $email;
		
		$subject = "[Área restrita dos voluntários] Alteração de senha";
		
		$headers = "MIME-Version: 1.0\n";               
		$headers .= "Content-type: text/html; charset=utf-8\n";            
		$headers .= "From: <{$from}> \r\n"; 
		$message ="Olá ".$nome.", <br><br>
		
		            Sua senha foi alterada para acesso à área restrita do GAAR.<br>
		            
		            Caso não tenha solicitado, entre em contato com Thaise pelo WhatsApp (19) 98190-7940<br><br>
		            
		            ******* E-mail automático criado pelo sistema ******" ;
		
		mail($to, $subject, $message, $headers);
        
        echo"<script language='javascript' type='text/javascript'>
          alert('Atualização realizada com sucesso!');
		  window.location.href='http://gaarcampinas.org/area/login.html'</script>";
	    }
	    else{
			echo "Insert code: ".$insert;
			echo "Mensagem de erro: ".mysql_error(). "SQL Error: ".mysql_errno();
          /*echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao alterar');window.location
          .href='http://gaarcampinas.org/area/login.html'</script>";*/
        }
	  
?>