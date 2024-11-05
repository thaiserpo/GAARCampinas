<?php

include ("conexao.php"); 
		
		$query = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO <> 'GAAR'";
		$select = mysqli_query($connect,$query);
		$reccount = mysqli_num_rows($select);
		
		$ano_atu = date("Y");
		$mes_atu = date("m");
		$dia_atu = date("d");
		
		$dtatu = date("Y-m-d");
		
		$dtatu_format = date("d-m-Y");
		
		$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);
		
		while ($fetch = mysqli_fetch_row($select)) {
		    
		    $id = $fetch[0];
		    $nomedoanimal = $fetch[1];
		    $emailresp = $fetch[17];
		    $dt_reg = $fetch[19];
		    $tipo_anuncio =  $fetch[20];
		    $foto = $fetch[16];
		    $uploaddir = '/home/gaarcam1/public_html/pets/';
            $file = $uploaddir.$foto;
		    
		    $ano_anuncio = substr($dt_reg,0,4);
		    $mes_anuncio = substr($dt_reg,5,2);
		    $dia_anuncio = substr($dt_reg,8,2);
		   

		    /* CONVERSAO DATA GREG TO JD */
		    $anuncio_jul = gregoriantojd($mes_anuncio,$dia_anuncio,$ano_anuncio);
		    
		    /* CALCULO DE DIAS */
		  
		    $anuncio = intval($data_atu_jul) - intval($anuncio_jul) ;
		    
		   if ($anuncio == 30) { 
		       switch ($tipo_anuncio){
		           case 'Doação':
		               $mensagem = "<p>Olá, <br><br>
    		        
    		                     Sou voluntário(a) da equipe GAAR, tudo bem?<br><br>
    		                     
    		                     Estamos entrando em contato para saber se o animal ".$nomedoanimal." foi adotado. 
    		                     
    		                     Caso ele tenha sido, pedimos que por gentileza apague o anúncio <a href='http://gaarcampinas.org/area/deletapet.php?idanimal=".$id."&source=".$emailresp."'>clicando aqui</a>.<br><br>
    		                     
    		                     <font color='red'><strong>Atenção! Anúncios com 60 dias serão apagados automaticamente. </strong></font><br><br>
		                        
		                        <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
		               
		               break;
		               
		             case 'Encontrado':
		               $mensagem = "<p>Olá, <br><br>
    		        
    		                     Sou voluntário(a) da equipe GAAR, tudo bem?<br><br>
    		                     
    		                     Estamos entrando em contato para saber se o animal ".$nomedoanimal." foi encontrado. 
    		                     
    		                     Caso ele tenha sido, pedimos que por gentileza apague o anúncio <a href='http://gaarcampinas.org/area/deletapet.php?idanimal=".$id."&source=".$emailresp."'>clicando aqui</a>.<br><br>
		                        
		                         <font color='red'><strong>Atenção! Anúncios com 60 dias serão apagados automaticamente. </strong></font><br><br>
		                         
		                        <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
		               
		               break;
		               
		               case 'Perdido':
		               $mensagem = "<p>Olá, <br><br>
    		        
    		                     Sou voluntário(a) da equipe GAAR, tudo bem?<br><br>
    		                     
    		                     Estamos entrando em contato para saber se você encontrou o animal ".$nomedoanimal.".
    		                     
    		                     Caso tenha encontrado, pedimos que por gentileza apague o anúncio <a href='http://gaarcampinas.org/area/deletapet.php?idanimal=".$id."&source=".$emailresp."'>clicando aqui</a>.<br><br>
    		                     
    		                     <font color='red'><strong>Atenção! Anúncios com 60 dias serão apagados automaticamente. </strong></font><br><br>
		                        
		                        <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
		               
		               break;
		               
		               
		       }

        		ini_set('display_errors', 1);
        
        		error_reporting(E_ALL);
        
        		$from = "contato@gaarcampinas.org";
        		
        		$to = $emailresp;
        		
        		$subject = "Verifique o anúncio do animal ".$nomedoanimal."";
        		
        		$headers = "MIME-Version: 1.0\n";               
        		$headers .= "Content-type: text/html; charset=utf-8\n";            
        		$headers .= "From: <{$from}> \r\n";
        		$headers .= "Reply-To: <{$from}> \r\n";    
        
        		$message = $mensagem ;
        		
        		mail($to, $subject, $message, $headers);

		   }  
		   
		   if ($anuncio >= 60) { 
		      
		        $query = "DELETE FROM ANIMAL WHERE ID = '$id'";
                $delete = mysqli_query($connect,$query);
                
                if(mysqli_errno($connect) == '0'){
                    
                        /* deleta a foto da pasta pets*/
                        unlink($file);
                        
		                $mensagem = "<p>Olá, <br><br>
    		        
    		                     Seu anúncio para o animal ".$nomedoanimal." foi deletado do nosso sistema pois atingiu 60 dias após a publicação. 
    		                     
    		                     Caso queira enviar um novo anúncio, <a href='http://gaarcampinas.org/quero-anunciar/'>clique aqui</a>.<br><br>
		                        
		                        <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
		               ini_set('display_errors', 1);
        
                		error_reporting(E_ALL);
                
                		$from = "contato@gaarcampinas.org";
                		
                		$to = $emailresp;
                		
                		$subject = "Seu anúncio para o animal ".$nomedoanimal." foi deletado do nosso sistema";
                		
                		$headers = "MIME-Version: 1.0\n";               
                		$headers .= "Content-type: text/html; charset=utf-8\n";            
                		$headers .= "From: <{$from}> \r\n";
                		$headers .= "Reply-To: <{$from}> \r\n";    
                
                		$message = $mensagem ;
                		
                		mail($to, $subject, $message, $headers);
 
		       }

		   }  
		  }
		
		
?>