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
                                        <h3>RELATÓRIO MENSAL PARA PAGAMENTO DE VETERINÁRIOS</h3><br>
                                    </center>
                                    
                                    <br>
                                    <p> Diretoria Financeira, <br> Segue o relatório para pagamento dos procedimentos veterinários realizados em ".$mes_ant."/".$ano_atu." e que estão cadastrados no sistema. 
                                    
                                    <br><br>
                                    <B>DADOS PARA PAGAMENTO</B> <br><br>
                                        
                                        <table>";

    function pag_vet_mensal($ano_atu,$mes,$vet,$connect){
				$query = "SELECT * FROM PROCEDIMENTOS WHERE CLINICA = '".$vet."' AND DATA LIKE '".$ano_atu."-".$mes."-%' ORDER BY DATA ASC";
				$result = mysqli_query($connect,$query);
				$reccount = mysqli_num_rows($result);	
				
				$valor = 0;
				
				while ($fetch = mysqli_fetch_row($result)) {
				    $valorgaar = $fetch[11];
				    $valortutor = $fetch[12];
				    $valor = $valor + ($valorgaar + $valortutor);
				}
					
				return ($valor);
		}
		
		$queryvet = "SELECT * FROM CLINICAS";
		$resultvet = mysqli_query($connect,$queryvet);
		$reccountvet = mysqli_num_rows($resultvet);
	
	    while ($fetchvet = mysqli_fetch_row($resultvet)) {
	            $nomevet = $fetchvet[1];
	            
	            $pagamento =  pag_vet_mensal($ano_atu,$mes_ant,$nomevet,$connect);
	            
	            if ($pagamento != 0) {
	                
	                $mensagem .="<tr>
                                    <td align='left'>Clínica ou veterinário </td>
                                    <td align='left'>: ".$nomevet."</td>
                                </tr>
                                <tr>
                                    <td align='left'>Valor total </td>
                                    <td align='left'>: R$ ".number_format($pagamento,2,',', '.')."</td>
                                </tr>
                                <tr rowspan='2'>
                                    <td align='left'></td>
                                </tr>";
	            }
	            
	            
	    }
	    
	    $mensagem .="</table>
	    
	                  <br>
	                  
	                  <B>DETALHES DOS LANÇAMENTOS</B> <br><br>
                                        
                                        <table border='1'>
                                        <thead class='thead-dark'>
                        						  <tr>
                        							<th scope='col' colspan='2'>&nbsp;</th>
                        							<th scope='col' colspan='3'>DADOS DO ANIMAL</th>
                        						    <th scope='col' colspan='3'>DADOS DO GAAR</th>
                        						    <th scope='col' colspan='2'>DADOS DA CLÍNICA</th>
                        						   </tr>
                        				</thead> 
                                        <thead class='thead-light'>
                        						  <tr>
                        						    <th scope='col'>ID</th>
                        							<th scope='col'>Data</th>
                        							<th scope='col'>Animal</th>
                        							<th scope='col'>Espécie</th>
                        							<th scope='col'>Tutor</th>
                        							<th scope='col'>Requisitor</th>
                        							<th scope='col'>Aprovador</th>
                        							<th scope='col'>Valor</th>
                        							<th scope='col'>Procedimento</th>
                        							<th scope='col'>Clínica</th>
                        						   </tr>
                        				</thead>
                        				<tbody>";
	                  
	    $queryprocedi = "SELECT * FROM PROCEDIMENTOS WHERE DATA LIKE '".$ano_atu."-".$mes_ant."-%' ORDER BY CLINICA, DATA ASC";
		$resultprocedi = mysqli_query($connect,$queryprocedi);
		$reccountprocedi = mysqli_num_rows($resultprocedi);	
		
		if ($reccountprocedi != 0 ) {
		    
		    while ($fetchprocedi = mysqli_fetch_row($resultprocedi)) {
        	        $id = $fetchprocedi[0];
        			$data = $fetchprocedi[1];
        			$nomedoanimal = $fetchprocedi[2];
        			$especie = $fetchprocedi[3];
        			$sexo = $fetchprocedi[4];
        			$porte = $fetchprocedi[5];
        			$nomedotutor = $fetchprocedi[6];
        			$requigaar = $fetchprocedi[8];
        			$aprovagaar  = $fetchprocedi[9];
        			$tipoproc = $fetchprocedi[10];
        			$valor = $fetchprocedi[11];
        			$valortutor = $fetchprocedi[12];
        			$clinica = $fetchprocedi[13];
        			$status = $fetchprocedi[14];
        			$emaildotutor = $fetchprocedi[16];
        			$qtde = $fetchprocedi[17];
        			
        			$ano_proc = substr($data,0,4);
        		    $mes_proc = substr($data,5,2);
        		    $dia_proc = substr($data,8,2);
			
			$mensagem .="
			            <tr>
    			            <td>".$id."</td>
                			<td>".$dia_proc."/".$mes_proc."</td>
        					<td>".$nomedoanimal."</td>
        				    <td>".$especie."</td>
        				    <td>".$nomedotutor."</td>
        				    <td>".$requigaar."</td>
        				    <td>".$aprovagaar."</td>
                            <td>".$valor."</td>
        				    <td>".$tipoproc."</td>
        				    <td>".$clinica."</td>
        				</tr>";
	        }
		}

	    $mensagem .= "</tbody>
	                  </table>
	                  
	                  <br><br>
                            
                      * Esta notificação foi gerada automaticamente através do sistema e serve apenas para conhecimento e controle*
                      </font>
                      </body>
                      </html>";


    ini_set('display_errors', 1);
        
	error_reporting(E_ALL);

	$from = "admin@gaarcampinas.org";
	
	$to = "financeiro@gaarcampinas.org, operacional@gaarcampinas.org";
	
	$subject = "[GAAR Campinas] Pagamentos de veterinários - mês ".$mes_ant."/".$ano_atu."";
	
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
	
	echo "e-mail enviado para ".$to;
    
    mysqli_close($connect);
		
		
?>