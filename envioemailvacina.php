<?php

include ("conexao.php"); 

		/*$query = "SELECT * FROM TERMO_ADOCAO WHERE POS_ADOCAO = '0001-01-01' ";*/
		
		$query = "SELECT * FROM TERMO_ADOCAO WHERE CASTRADO='Não' AND REPROVADO <> 'Sim'";
		$select = mysqli_query($connect,$query);
		$reccount = mysqli_num_rows($select);
		
		$ano_atu = date("Y");
		$mes_atu = date("m");
		$dia_atu = date("d");
		
		$dtatu = date("Y-m-d");
		
		$dtatu_format = date("d-m-Y");
		
		$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);
		
		while ($fetch = mysqli_fetch_row($select)) {
		    
		    $emailadotante = 0;
		    $resp = 0;
		    
		    $id = $fetch[0];
		    $adotante = $fetch[1];
		    $teladotante = $fetch[10];
		    $emailadotante = $fetch[11];
		    $nomedoanimal = $fetch[15];
		    $idade = $fetch[17];
		    $dataadocao = $fetch[32];
		    $castrado = $fetch[21];
		    $dtcastracao = $fetch[22];
		    $emailresp = $fetch[29];

		    $queryresp = "SELECT NOME FROM VOLUNTARIOS WHERE EMAIL='$emailresp'";
		    $selectresp = mysqli_query($connect,$queryresp);
		    
		    while ($fetchresp = mysqli_fetch_row($selectresp)) {
		        $resp = $fetchresp [0];
		    }
		    
		    if ($emailresp == '') {
		        $emailresp = "operacional@gaarcampinas.org";
		    }
		    
		    if($resp == ''){
		        $resp = "GAAR Campinas";
		    }
		    
		    $ano_idade = substr($idade,0,4);
		    $mes_idade = substr($idade,5,2);
		    $dia_idade = substr($idade,8,2);
		    
		    $ano_castracao = substr($dtcastracao,0,4);
		    $mes_castracao = substr($dtcastracao,5,2);
		    $dia_castracao = substr($dtcastracao,8,2);

		    /* CONVERSAO DATA GREG TO JD */
		    $idade_jul = gregoriantojd($mes_idade,$dia_idade,$ano_idade);
		    
		    $dtcastracao_jul = gregoriantojd($mes_castracao,$dia_castracao,$ano_castracao);
		    
		    /* CALCULO DE DIAS */
		    
		    $dtcastracao = intval($dtcastracao_jul) - intval($data_atu_jul) ;
		    
		    if ($dtcastracao == 7) {
		        
		        if ($castrado =='Não') {
		            
		            ini_set('display_errors', 1);
        
                    error_reporting(E_ALL);
        		
        		    $from = $emailresp;
        		    
    		        $headers = "MIME-Version: 1.0\n";               
    		        $headers .= "Content-type: text/html; charset=utf-8\n";    
		            $headers .= "From: <{$from}> \r\n";
        		    $headers .= "Reply-To: <{$from}> \r\n";   
		            
		            $subject = "[GAAR Campinas] A data da castração está chegando";
		            
		            $to = $emailadotante;
		            
    		        $mensagem = "<p>Olá ".$adotante.", <br><br>
    		        
    		                     Sou a(o) ".$resp."., voluntário do GAAR, tudo bem?<br><br>
    		                     
    		                     Estamos entrando em contato para comunicar que a castração do(a) ".$nomedoanimal." está chegando.  <br><br>
    		                     
    		                     A data prevista é ".$dia_castracao."/".$mes_castracao."/".$ano_castracao.". Você poderá levá-lo em seu veterinário preferido ou optar por um dos conveniados do GAAR que têm longa experiência em castrar, acesse o site e veja a lista <a href='http://gaarcampinas.org/veterinarios-parceiros/' target='_blank'>aqui</a>. Caso opte por levar a algum veterinário conveniado, pedimos que por gentileza leve sua via do termo de adoção.<br><br>
    		                     
    		                     Para melhorarmos os nossos registros, gostaríamos de saber o nome do veterinário (a) que você pretende ou já realizou o procedimento cirúrgico da castração. <br><br>
    		                     
    		                     Nossa ONG está sempre procurando novos profissionais parceiros para viabilizar a castração ao maior número possível de interessados e ter o registro de um profissional comprometido com a castração, ajudando a divulgar o seu trabalho. <br><br>
		                        
		                        <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
		
    		        /* E-MAIL PARA O ADOTANTE */ 
    		        
            		$message = $mensagem ;
            		
            		mail($to, $subject, $message, $headers);
            		
            		/* COPIA DO E-MAIL PARA O RESPONSAVEL */ 
            		
            		ini_set('display_errors', 1);
        
                    error_reporting(E_ALL);
            		
            		$from = "operacional@gaarcampinas.org";
            		
            	    $headers = "MIME-Version: 1.0\n";               
    		        $headers .= "Content-type: text/html; charset=utf-8\n";    
		            $headers .= "From: <{$from}> \r\n";
        		    $headers .= "Reply-To: <{$from}> \r\n";   
            		
            		$to = $emailresp;
            		
            		$subject = "[GAAR Campinas] Lembrete da data da castração do(a) ".$nomedoanimal."";
            		
            		$mensagem = "<p>Olá ".$resp.", <br><br>
    		                     
    		                     Estamos entrando em contato para comunicar que a castração do(a) ".$nomedoanimal." está chegando.  <br><br>
    		                     
    		                     A data prevista é ".$dia_castracao."/".$mes_castracao."/".$ano_castracao.". <br><br>
    		                     
    		                     O adotante também recebeu essa notificação. Caso ache necessário, entre em contato com ele para confirmar se o procedimento está agendado ou foi realizado. <br><br>
    		                     
    		                     <B>DADOS DO ADOTANTE</B> <br><br>
                                        
                                <table>
                                        <tr>
                                            <td align='left'>Nome </td>
                                            <td align='left'>: ".$adotante."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Celular </td>
                                            <td align='left'>: ".$teladotante."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>E-mail </td>
                                            <td align='left'>: ".$emailadotante."</td>
                                        </tr>
                                </table> 
    		                    
    		                    <br><br>
    		                     
    		                     Caso já tenha sido castrado, por favor atualize no sistema para evitar o envio duplicado de notificação automática. <br><br>
    		                     
    		                     1- Acesse a área restrita pelo link http://gaarcampinas.org/area/login.html<br><br> 
                    		     2- Menu Operacional <br><br> 
                    		     3- Menu Pesquisar termo de adoção <br><br> 
		                        
		                        <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
            
            		$message = $mensagem ;
            		
            		mail($to, $subject, $message, $headers);
                	
		        }
                            
        	}
		
	    }
mysqli_close($connect);
		
?>