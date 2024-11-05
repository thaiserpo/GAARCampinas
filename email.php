<?php

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
        $id = $_SESSION['idpretermo'];
		$mensagem = $_POST['mensagem'];
        $queryform = "SELECT * FROM FORM_PRE_ADOCAO where ID='$id'";
		$selectform = mysqli_query($connect,$queryform);
        $fetchform = mysqli_fetch_row($selectform);
		
		$emailadotante = $fetchform[3];
		$nomeadotante = $fetchform[1];
		$nomeanimal = $fetchform[12];
			
		$queryvol = "SELECT * FROM VOLUNTARIOS WHERE USUARIO = '$login'";
		$selectvol = mysqli_query($connect,$queryvol);
        $fetchvol = mysqli_fetch_row($selectvol);
		
		$nomevoluntario = $fetchvol[2];
		$emailvoluntario = $fetchvol[4];
		
		
/*		$adotante = $fetch[1];
		$email = $fetch[11];
		$nomeanimal = $fetch[15];	
		$dtadocao = $fetch[32];
		
		$atual= date('Y-m-d');
		
		$intervalo = $dtadocao->diff($atual);
		
		echo "Intervalo: ".$intervalo; */
	
		ini_set('display_errors', 1);

		error_reporting(E_ALL);

		$from = $emailvoluntario;
		
		$to = $emailadotante;
		
		$subject = "Resposta do formulário de interesse em adoção do animal ".$nomeanimal;
		
		$headers = "MIME-Version: 1.0\n";               
		$headers .= "Content-type: text/html; charset=utf-8\n";            
		$headers .= "From: <{$from}> \r\n"; 		
		$headers .= "Bcc: ".$from."\r\n";
		$message = $mensagem ;
		
		mail($to, $subject, $message, $headers);
		
		$queryupdate = "UPDATE FORM_PRE_ADOCAO SET OBS='Resposta ao interessado enviada por ".$nomevoluntario."' WHERE ID='$id'";
		
		$update = mysqli_query($connect,$queryupdate);
		
		echo"<script language='javascript' type='text/javascript'>
				  alert('E-mail enviado com sucesso!');
				  window.location.href='pesquisapretermo.php'
			</script>";
		
		}

?>

<