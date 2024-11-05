<?php

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
        $id = $_SESSION['idpretermo'];
        $nomedoanimal = $_POST['nomeanimal'];
		$emailresp = $_POST['email'];
		$resposta = $_POST['resposta'];
	
		ini_set('display_errors', 1);

		error_reporting(E_ALL);

		$from = 'contato@gaarcampinas.org';
		
		$to = $emailresp;
		
		$subject = "Resposta do anúncio do animal ".$nomedoanimal;
		
		$headers = "MIME-Version: 1.0\n";               
		$headers .= "Content-type: text/html; charset=utf-8\n";            
		$headers .= "From: <{$from}> \r\n"; 		
		$headers .= "Bcc: <{$from}> \r\n";
		$message = $resposta ;
		$message .="<font color=''blue'>GAAR - Grupo do Apoio ao Animal de Rua<br><br> 
            		http://gaarcampinas.org<br>
                    http://facebook.com/gaarcampinas<br>
                    http://instagram.com/gaarcampinas<br><br>
                    
                    <i>Adote um animal resgatado do abandono ou de maus tratos, dê uma chance a quem já sofreu!O mundo fica melhor quando nos unimos para fazer a diferença!</i><br><br>
                    Visite nossas feiras de adoção e encontre seu novo amigo<br><br>
                    
                    Aos sábados<br>
                    - Das 10h as 13h na PetCamp Barão Geraldo - Av Albino José Barbosa de Oliveira, 948 -Campinas/SP<br>
                    - A cada 15 dias das 10h as 13h na PetCamp Jasmin - Rua Jasmin, 215 - Mansões Santo Antonio - Campinas/SPAos domingos<br>
                    - A cada 15 dias das 10h as 13h na Leroy Merlin Dom Pedro - Campinas/SPPara denúncias de maus-tratos em Campinas, ligue no 156 ou acesse os sites http://www.ssp.sp.gov.br/depa - https://cidadao.campinas.sp.gov.br/. A denúncia é anônima e sigilosa.Para castração gratuita em Campinas, agende pelo telefone 156 ou https://cidadao.campinas.sp.gov.br/<br>
                    Para castração com valores acessíveis, entre em contato com nossos veterinários parceiros:http://gaarcampinas.org/veterinarios-parceiros/ ou agende no mutirão de castração do projeto Cãosciencia Pet pelo WhatsApp 19 99906-2095<br></font>";
		
		mail($to, $subject, $message, $headers);
		
		echo"<script language='javascript' type='text/javascript'>
				  alert('E-mail enviado com sucesso!');
				  window.location.href='pesquisapetterc.php'
			</script>";
		
		}

?>

<