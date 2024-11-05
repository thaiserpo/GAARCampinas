<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

        $ano_atu = date("Y");
		$mes_atu = date("m");
		$dia_atu = date("d");
		
		$dtatu = date("Y-m-d");
		
		$dtatu_format = date("d-m-Y");
		
		$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);
		
		$querypet = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO = 'GAAR' AND (ADOTADO <> 'Adotado' AND ADOTADO <> 'Óbito') AND OBS = '' AND FOTO <>'' ORDER BY DATA_REG DESC";
		$selectpet = mysqli_query($connect,$querypet);
		$reccountpet = mysqli_num_rows($selectpet);
		
		if ($reccountpet <> '0') {
		    
                $mensagem = "
        				        <!DOCTYPE html>
                                <html lang='pt-br'>
                                  <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                                    
                                    <!-- Bootstrap CSS -->
                                    
                                    <link rel='stylesheet' media='all' href='/assets/application-mailer-dbc5154d3c4160e8fa7ef52fa740fa402760c39b5d22c8f6d64ad5999499d263.css' />
                                    
                                    <link rel='stylesheet' type='text/css' href='style-area.css'/>
            
                                    <link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>
                                    
                                  </head>
                                  
                                <tbody>
        				        <div class='d-none d-print-block'>
                                    <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center>
                                </div>
                                <br><center><h2>VERIFICAÇÃO DE CADASTROS PET</h2></center><br> ";
                                
                
                 $mensagem .= "
                    <p> Abaixo estão os animais que constam como Disponíveis no sistema e não possuem texto para divulgação <br><br></p>
                            <h4>ANIMAIS SEM TEXTO DE DIVULGAÇÃO</h4><br>
        				        <table class='table'>
        						  <thead class='thead-light'>
        						  <tr>
        							<th scope='col' colspan='1' align='left'>Animal</th>
        							<th scope='col' colspan='1' align='left'>Espécie</th>
        							<th scope='col' colspan='1' align='left'>Responsável</th>
        							<th scope='col' colspan='1' align='left'>Data do registro</th>
        						  </tr>
        						  </thead>
        						 <tbody>";
        
        
        		
        		while ($fetchpet = mysqli_fetch_row($selectpet)) {
        		    
        		    $id = $fetchpet[0];
        		    $nomedoanimal = $fetchpet[1];
        		    $especie = $fetchpet[2];
        		    $datareg = $fetchpet[19];
        		    $resp = $fetchpet[12];
        		    $status = $fetchpet[10];
        		    
        		    $ano_reg = substr($datareg,0,4);
        		    $mes_reg = substr($datareg,5,2);
        		    $dia_reg = substr($datareg,8,2);
        		    
        		    $data_reg_jul = gregoriantojd($mes_reg,$dia_reg,$ano_reg);
        		    
        		    $qtde_dias_reg = intval($data_atu_jul) - intval($data_reg_jul);
        		    
        		    /*if ($qtde_dias_reg <= 7) {*/
        
            		    $mensagem .="
            						  <tr> 
            							<th scope='row' align='left'>".$nomedoanimal."</th>
            							<td align='left'>".$especie."</td>
            							<td align='left'>".$resp."</td>
            							<td align='left'>".$dia_reg."/".$mes_reg."/".$ano_reg."</td>
            							<td align='left'><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$id."&email=".$email."' target='_blank'>Atualizar</a></td>
            						  </tr>
            						  ";
        		    
        		}
        		    
        		    $mensagem .="
        						 </tbody>
        						 </table><br><br>";
        
        
                    $mensagem .=" <br><br>
                            				
                            				<center><p><strong>OBSERVAÇÕES</strong><br>
                                            <i>Os valores apresentados são as informações cadastradas e foram coletadas pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail operacional@gaarcampinas.org</i><br>
                                            Este e-mail foi enviado automaticamente pelo sistema </p></center>  
                                            
                                        <!--- BOOTSTRAP --->
                                        <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                                        <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
                                        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
                                        <!--- BOOTSTRAP --->        
                                    </tbody>
                                    </html>
                                            ";
        				
        				$assunto = "Verificação de cadastros pet";
        
        				ini_set('display_errors', 1);
                
                		error_reporting(E_ALL);
                
                		$from = "contato@gaarcampinas.org";
                		
                		$subject = $assunto;
                		
                		$headers = "MIME-Version: 1.0\n";               
                		$headers .= "Content-type: text/html; charset=utf-8\n";            
                		$headers .= "From: <{$from}> \r\n";
                		$headers .= "Reply-To: <{$from}> \r\n";    
                
                		$message = $mensagem ;
                		
                		/*$to = "operacional@gaarcampinas.org, redes-sociais-gaar@googlegroups.com";*/
                		
                		$queryvol = "SELECT EMAIL FROM VOLUNTARIOS WHERE AREA ='comunicacao'";
            		    $selectvol = mysqli_query($connect,$queryvol);
            		    
            		    while ($fetchvol = mysqli_fetch_row($selectvol)) {
            		        
            		        $email = $fetchvol[0];
                		
                		    $to = $email;
                		    
                		    mail($to, $subject, $message, $headers);
            		    }
                		
                		
		}

		mysqli_close($connect);
		
?>