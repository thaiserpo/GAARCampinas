<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

	$ano_atu = date("Y");
	$mes_atu = date("m");
	$dia_atu = date("d");
    $mes_ant = date('m',strtotime('-1 months'));
	
	$dtatu = date("Y-m-d");

    $mensagem = "<!DOCTYPE html>
                                <html lang='pt-br'>
                                  <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                                    
                                    <!-- Bootstrap CSS -->
                                    
                                    <link rel='stylesheet' media='all' href='/assets/application-mailer-dbc5154d3c4160e8fa7ef52fa740fa402760c39b5d22c8f6d64ad5999499d263.css' />
                                    
                                    <link rel='stylesheet' type='text/css' href='style-area.css'/>
            
                                    <link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>
                                    
                                  </head>
                                  
                                <body>
                                <font face='verdana'> 
        				        <div class='d-none d-print-block'>
                                    <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center>
                                </div>
                			       <center>
                                        <h3>RELATÓRIO DOS SÓCIOS CONTRIBUINTES</h3><br>
                                    </center>
                                    
                                    <br>
                                    <p> Diretoria Financeira, <br> Segue o relatório dos sócios e padrinhos/madrinhas cadastrados no sistema. 
                                    
                                    <br><br>

                                        <table border='1'>
                                        <thead class='thead-light'>
                        						  <tr>
                        							<th scope='col' colspan='1'>NOME</th>
                        							<th scope='col' colspan='1'>CELULAR</th>
                        						    <th scope='col' colspan='1'>E-MAIL</th>
                        						    <th scope='col' colspan='1'>FORMA DE AJUDAR</th>
                        						    <th scope='col' colspan='1'>VALOR</th>
                        						    <th scope='col' colspan='1'>FREQUÊNCIA</th>
                        						    <th scope='col' colspan='1'>APADRINHAMENTO?</th>
                        						    <th scope='col' colspan='1'>ANIMAL</th>
                        						    <th scope='col' colspan='1'>ESPÉCIE</th>
                        						    <th scope='col' colspan='1'>RESPONSÁVEL</th>
                        						   </tr>
                        				</thead> ";

				$query = "SELECT * FROM SOCIO ORDER BY APADRINHAMENTO DESC";
				$result = mysqli_query($connect,$query);
				$reccount = mysqli_num_rows($result);	
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $nome = $fetch[1];
				    $celular = $fetch[3];
				    $email = $fetch[4];
				    $forma_ajudar = $fetch[6];
				    $valor = $fetch[5];
				    $freq_doacao = $fetch[13];
				    $apadrinhamento = $fetch[15];
				    $idanimal = $fetch[16];
				    
				    if ($nome ==''){
				        $nome = "Não identificado";
				    }
				    
				    if ($apadrinhamento =='Sim'){
				        $query = "SELECT NOME_ANIMAL,ESPECIE, RESPONSAVEL FROM ANIMAL WHERE ID='$idanimal'";
    				    $resultpet = mysqli_query($connect,$query);
    				    
    				    while ($fetchpet = mysqli_fetch_row($resultpet)) {
    				        $nomedoanimal = $fetchpet[0];
    				        $especie = $fetchpet[1];
    				        $resp = $fetchpet[2];
    				    }
				    } else {
				            $nomedoanimal = "N/A";
    				        $especie = "N/A";
    				        $resp = "N/A";
				    }
				    
				    
				    
				    $mensagem .="<tr>
                                    <td align='left'>".$nome."</td>
                                    <td align='left'>".$celular."</td>
                                    <td align='left'>".$email."</td>
                                    <td align='left'>".$forma_ajudar."</td>
                                    <td align='left'>".$valor."</td>
                                    <td align='left'>".$freq_doacao."</td>
                                    <td align='left'>".$apadrinhamento."</td>
                                    <td align='left'>".$nomedoanimal."</td>
                                    <td align='left'>".$especie."</td>
                                    <td align='left'>".$resp."</td>
                                </tr>";

				}



	    $mensagem .="</table>
	                  <br><br>
                            
                      * Esta notificação foi gerada automaticamente através do sistema e serve apenas para conhecimento e controle*
                      </font>
                      </body>
                      </html>";


    ini_set('display_errors', 1);
        
	error_reporting(E_ALL);

	$from = "admin@gaarcampinas.org";
	
	$to = "financeiro@gaarcampinas.org";
	
	$subject = "[GAAR Campinas] Relatório dos sócios - mês ".$mes_ant."/".$ano_atu."";
	
	$headers = "MIME-Version: 1.0\n";               
	$headers .= "Content-type: text/html; charset=utf-8\n";            
	$headers .= "From: <{$from}> \r\n";
	$headers .= "Reply-To: <{$from}> \r\n";    
    $mensagem .= "            
                        <!--- BOOTSTRAP --->
                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
                    <!--- BOOTSTRAP --->
                    </font>
                    </body>
                    </html>
    
                ";
	$message = $mensagem ;
	
	mail($to, $subject, $message, $headers);

    mysqli_close($connect);
		
		
?>
