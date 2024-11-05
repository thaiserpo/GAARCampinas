<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

$ano_atu = date('Y');
$mes_atu = date('m');
$dia_prox = date('d',strtotime('+1 day'));
$dia_atu = date('d');

$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);

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
    <h2>RELATÓRIO DAS FEIRAS</h2><br>
</center>

<br><br>";

/*$queryfeira = "SELECT * FROM EVENTOS WHERE DATA LIKE '".$ano_atu."-".$mes_atu."-%'";*/
$queryfeira = "SELECT * FROM EVENTOS";
$resultfeira = mysqli_query($connect,$queryfeira);
$reccountfeira = mysqli_num_rows($resultfeira);

$sum_total_vendas = 0;

$sent_email = False;

while ($fetchfeira = mysqli_fetch_row($resultfeira)) {
    $idevento = $fetchfeira[0];
    $desc = $fetchfeira[1];
    $local = $fetchfeira[3];
    $data = $fetchfeira[4];
    
    $ano_feira = substr($data,0,4);
    $mes_feira = substr($data,5,2);
    $dia_feira = substr($data,8,2);
    
    $data_feira_jul = gregoriantojd($mes_feira,$dia_feira,$ano_feira);
    
    $dias = intval($data_atu_jul) - intval($data_feira_jul);
    
    if ($dias == '2'){
        
            $sent_email = True;
            
            $total_vendas = 0;
            
            $sum_taxa = 0;
        
            $mensagem .= "
                            <hr>
                            <h3>".$desc." - ".$dia_feira."/".$mes_feira."/".$ano_feira." - ".$local."</h3>";
    
            $mensagem .= "<B>Voluntários presentes</B> <br><br>
                        
                        <table border='1'>
                        <thead class='thead-dark'>
        						  <tr>
        							<th scope='col' colspan='1'>Nome</th>
        							<th scope='col' colspan='1'>Cargo</th>
        						   </tr>
        				</thead> 
        			 <tbody>";
        
                $queryvol = "SELECT * FROM LISTA_DE_PRESENCA WHERE ID_EVENTO='$idevento'" ;
                $resultvol = mysqli_query($connect,$queryvol);
                while ($fetchvol = mysqli_fetch_row($resultvol)) {
                    $nome = $fetchvol[1];
                    $cargo = $fetchvol[4];
                    $mensagem .="
            			            <tr>
                			            <td>".$nome."</td>
                			            <td>".$cargo."</td>
                    				</tr>";
                }
                
                $mensagem .= "</tbody>
    	                  </table>
    	                  
    	                  <br>
    	                  
    	                  <B>Animais presentes</B> <br><br>
                
                            <table border='1'>
                            <thead class='thead-dark'>
            						  <tr>
            							<th scope='col' colspan='1'>Código</th>
            							<th scope='col' colspan='1'>Nome</th>
            							<th scope='col' colspan='1'>Espécie</th>
            							<th scope='col' colspan='1'>Lar temporário</th>
            							<th scope='col' colspan='1'>Responsável</th>
            							<th scope='col' colspan='1'>Status</th>
            							<th scope='col' colspan='1'>Forma de pagamento</th>
            						   </tr>
            				</thead> 
            			 <tbody>";
                
                $querypetid = "SELECT ID_ANIMAL FROM ANIMAIS_FEIRAS WHERE ID_FEIRA='$idevento' ORDER BY ID_ANIMAL ASC";
                $resultpetid = mysqli_query($connect,$querypetid);
                while ($fetchpetid = mysqli_fetch_row($resultpetid)) {
                    $petid = $fetchpetid[0];
                    $querypet = "SELECT * FROM ANIMAL WHERE ID='$petid'";
                    $resultpet = mysqli_query($connect,$querypet);
                    while ($fetchpet = mysqli_fetch_row($resultpet)) {
                        $nomedoanimal = $fetchpet[1];
                        $especie = $fetchpet[2];
                        $lt = $fetchpet[11];
                        $resp = $fetchpet[12];
                        $status = $fetchpet[10];
                        
                        $querytermo = "SELECT * FROM TERMO_ADOCAO WHERE ID_ANIMAL='$petid'";
                        $resulttermo = mysqli_query($connect,$querytermo);
                        $reccounttermo = mysqli_num_rows($resulttermo);
                        
                        if ($reccounttermo != '0'){
                            while ($fetchtermo = mysqli_fetch_row($resulttermo)) {
                                $forma_pgto = $fetchtermo[41];
                            }  
                        } else {
                            $forma_pgto = "N/A";
                        }
                        
                        if ($status == 'Adotado'){
                            $taxa = "50";
                            $sum_taxa = floatval($taxa) + floatval($sum_taxa);
                        }
                        
                        $mensagem .="
            			            <tr>
                			            <td>".$petid."</td>
                			            <td>".$nomedoanimal."</td>
                			            <td>".$especie."</td>
                			            <td>".$lt."</td>
                			            <td>".$resp."</td>
                			            <td>".$status."</td>
                			            <td>".$forma_pgto."</td>
                    				</tr>";
                        
                    }
                }
                $mensagem .= "</tbody>
    	                  </table>
    	                  <br>
    	                  
    	                  <br>
    	                  
    	                  <B>Produtos vendidos</B> <br><br>
                
                            <table border='1'>
                            <thead class='thead-dark'>
            						  <tr>
            							<th scope='col' colspan='1'>Produto</th>
            							<th scope='col' colspan='1'>Quantidade</th>
            							<th scope='col' colspan='1'>Meio de pagamento</th>
            							<th scope='col' colspan='1'>Valor</th>
            						   </tr>
            				</thead> 
            			 <tbody>";
            	$queryprod = "SELECT * FROM VENDAS_PRODUTOS WHERE ID_EVENTO='$idevento'";
            	$resultprod = mysqli_query($connect,$queryprod);
                while ($fetchprod = mysqli_fetch_row($resultprod)) {
                    $proddesc = $fetchprod[6];
                    $qtdeprod = $fetchprod[7];
                    $meiopgto = $fetchprod[12];
                    
                    $queryvalor = "SELECT VALOR FROM CONTROLE_ESTOQUE WHERE PRODUTO='$proddesc'";
            	    $resultvalor = mysqli_query($connect,$queryvalor);
            	    
            	    while ($fetchvalor = mysqli_fetch_row($resultvalor)) {
            	        $valor =  $fetchvalor[0];
            	    }
            	    
            	    $valor_total = floatval($valor) * $qtdeprod;
                    $mensagem .="
            			            <tr>
                			            <td>".$proddesc."</td>
                			            <td>".$qtdeprod."</td>
                			            <td>".$meiopgto."</td>
                			            <td>R$ ".number_format($valor_total, 2, ',', '.')."</td>
                    				</tr>";
                    $total_vendas = floatval($total_vendas) + floatval($valor_total);
                    $valor_total = 0;

                    }
                $mensagem .= "</tbody>
    	                  </table>";
    }
    
}

$mensagem .= "    <br>
    	                  <table>
    	                    <tbody>
    	                        <tr>
    	                            <td><strong> Total em vendas:</strong></td>
    	                            <td><strong><font color='blue'>R$ ".number_format($total_vendas, 2, ',', '.')."</font></strong></td>
    	                        </tr>
    	                        <tr>
    	                            <td><strong> Total em taxas:</strong></td>
    	                            <td><strong><font color='blue'>R$ ".number_format($sum_taxa, 2, ',', '.')."</font></strong></td>
    	                        </tr>
    	                    </tbody>
    	                  </table>
    	                  <br><br>
    	                  
    	                  <p><center><strong>OBSERVAÇÕES</strong><br><i> Todos os dados apresentados foram coletados do banco de dados do GAAR.<br>Esta notificação é automática e será enviada automaticamente 1 dia após a feira.</i></center><br><br>
                          </font>
                          </body>
                          </html>";
    	                  
ini_set('display_errors', 1);
    
error_reporting(E_ALL);

$from = "admin@gaarcampinas.org";

$to ="feiragaar@googlegroups.com";

/*$to = "thaise.piculi@gmail.com";*/

$subject = "[GAAR Campinas] Relatório de feira";

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
        	
echo $mensagem;

if ($sent_email) {
    $result =  mail($to, $subject, $message, $headers);
    if ($result){
     echo "E-mail enviado para: ".$to;
    } else {
        echo "Erro no envio";
    }
} else {
    echo "E-mail não enviado";
}

    mysqli_close($connect);
		
		
?>
