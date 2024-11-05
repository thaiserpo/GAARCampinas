<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

$mes_ant = date('m',strtotime('-1 months'));
        
$anoadocao = date("Y"); 

$data_atu = date("Y-m-d",strtotime("-1 days"));

$dia_atu = date("d",strtotime("-1 days"));

$mes_atu = date("m");

echo "<br> data_atu: ".$data_atu;
echo "<br> dia_atu: ".$dia_atu;

$querycaes = "SELECT * FROM ANIMAL where DATA_SAIDA_LT = '$data_atu'";
$resultcaes = mysqli_query($connect,$querycaes);
$rc= mysqli_num_rows($resultcaes);	

echo "<br> reccount: ".$rc;

if ($rc <> '0') {
    
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
                <center>
                <div class='d-none d-print-block'>
                                    <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center>
                </div>
                <H4>ADOTADOS DO DIA ".$dia_atu."/".$mes_atu."</h4>
                <p> Olá grupo de Redes Sociais, <br><br> Segue o relatório dos adotados com termos cadastrados, para ajudar na programação dos posts dos animais: <br><br>
                
		        <table class='table'>
				  <thead class='thead-light'>
				  <tr>
					<th scope='col'>Nome do animal</th>
					<th scope='col'>Espécie</th>
					<th scope='col'>Responsável</th>
				  </tr>
				  </thead>
				  <tbody>";
				  
	     while ($fetch = mysqli_fetch_row($resultcaes)) {
	         $id = $fetch[0];
	         $nomedoanimal = $fetch[1];
	         $especie = $fetch[2];
	         $responsavel = $fetch[12];
	         
		     $mensagem .= "<tr> 
    					<th scope='row' align='left' >".$nomedoanimal."</th>
    					<td align='center'>".$especie."</td>
    					<td align='center'>".$responsavel."</td>
    				  </tr>";
	     }
	     
		$mensagem .= " </tbody>
        				 </table>
        				 </center>
        				 <br>";
  
    	$mensagem.= "<center><p><strong>OBSERVAÇÕES</strong><br>
                    <i>Esse relatório só será enviado caso haja adoção. <br>Os valores apresentados são as informações cadastradas e foram coletadas pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail operacional@gaarcampinas.org</i><br>
                    <strong>Este e-mail foi enviado automaticamente pelo sistema </strong></p></center>  

                <!--- BOOTSTRAP --->
                <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
                <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
                <!--- BOOTSTRAP --->  
                </font>
                
            </tbody>
            </html>
                    ";
		
		$assunto = "[GAAR Campinas] Adoções do dia ".$dia_atu."/".$mes_atu."";

		ini_set('display_errors', 1);

		error_reporting(E_ALL);

		$from = "operacional@gaarcampinas.org";
		
		$subject = $assunto;
		
		$headers = "MIME-Version: 1.0\n";               
		$headers .= "Content-type: text/html; charset=utf-8\n";            
		$headers .= "From: <{$from}> \r\n";
		$headers .= "Reply-To: <{$from}> \r\n";    

		$message = $mensagem ;
		
		$to = "redes-sociais-gaar@googlegroups.com ";
		
		mail($to, $subject, $message, $headers);

}
		 
mysqli_close($connect);

?>
