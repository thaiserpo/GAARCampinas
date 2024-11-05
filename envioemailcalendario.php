<?php

include ("conexao.php"); 

		/*$query = "SELECT * FROM TERMO_ADOCAO WHERE POS_ADOCAO = '0001-01-01' ";*/
		
		$query = "SELECT DISTINCT(EMAIL) FROM VOTACAO_CALENDARIO ORDER BY ID DESC";
		$select = mysqli_query($connect,$query);
		$reccount = mysqli_num_rows($select);
		
		ini_set('display_errors', 1);
        
        error_reporting(E_ALL);
        
        $from = "operacional@gaarcampinas.org";
        
        $mensagem = "<p>Olá, <br><br>
    		        
    		                    <p>Nos últimos dias nosso site apresentou muitas instabilidades devido ao alto número de acessos por causa do concurso do calendário, ocasionando em e-mails de validação sendo recebidos com muito atraso ou às vezes nem recebidos. <br><br> 
    		                    <p>Mudamos de provedor para que os e-mails cheguem um pouco mais rápido, por isso o site ficou fora alguns dias mas já está no ar novamente :) <br><br>
    		                    <p>Por causa desse problema, <strong> estamos computando todos os votos que não estavam validados em nosso banco de dados até hoje e dentro dos próximos dias o total de votos será atualizado em cada perfil.</strong> <br><br>
    		                    <p>Atingimos mais de 45 mil votos e 451 pets inscritos! Número recorde! <br><br>
    		                    <p>Nosso muito obrigada a todos que estão participando e pedimos desculpas pelo ocorrido.<br><br>
		                        
		                        <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
		 
		$subject = "[GAAR Campinas] CONCURSO CALENDÁRIO 2021 - Nota de retratação ";
        		
        		$headers = "MIME-Version: 1.0\n";               
        		$headers .= "Content-type: text/html; charset=utf-8\n";            
        		$headers .= "From: <{$from}> \r\n";
        		$headers .= "Reply-To: <{$from}> \r\n";    
        
        $message = $mensagem ;
		

		while ($fetch = mysqli_fetch_row($select)) {
		    
		    $email = $fetch[0];
		    
		    $to = $email;
		    
		    mail($to, $subject, $message, $headers);

	    }
		
?>