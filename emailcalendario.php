<?php


include ("conexao.php"); 

$dia_atu = date("d");
	
$query = "SELECT EMAIL FROM TERMO_ADOCAO WHERE EMAIL <>'0' AND EMAIL <>''";
$select = mysqli_query($connect,$query);

ini_set('display_errors', 1);
            
error_reporting(E_ALL);

$from = "contato@gaarcampinas.org";

$headers = "MIME-Version: 1.0\n";               
$headers .= "Content-type: text/html; charset=utf-8\n";            
$headers .= "From: <{$from}> \r\n"; 

$subject = "Chegou o Calendário do GAAR 2021! " ;

/*while ($fetch = mysqli_fetch_row($select)) {
	$email = $fetch[0];*/

	$to = "voluntariosgaar@googlegroups.com";
	
	$message = "<html>
	            <body>
	               <center><a href='http://www.gaarcampinas.org/loja/'><img src='http://gaarcampinas.org/area/imagens/calendario2021.png'></a></center>
	           </body>
	           </html>";
	
	/*$message = "<p>
	
	            <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center><br>
	            
	            Olá ".$adotante.", <br><br>
	
	            Chegou o calendário do GAAR 2021! E o seu pet ".$nomedoanimal." estampou as páginas do modelo de ".$modelo." :) <br><br>
	            
	            Para adquirir sua unidade, acesse a loja virtual <a href='http://www.gaarcampinas.org/loja/'> clicando aqui</a> ou visite as feiras de adoção aos sábados na Petcamp Barão Geraldo das 10h as 13h (Avenida Albino José Barbosa de Oliveira, 948)<br><br>
	            
	            Em breve divulgaremos em nossas redes sociais mais pontos de venda. <br><br>
	            
	            Atenciosamente, <br>
	            Thaise - Equipe GAAR
	            ";*/

	echo "<br><br>".$message;
	echo "<br>e-mail: ".$email;
	            
	mail($to, $subject, $message, $headers);


?>