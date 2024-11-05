<?php 

session_start();

include ("conexao.php"); 


$login = $_SESSION['login'];

/*$to = "thaise.piculi@gmail.com";*/

$mes = $_GET['mes'];
$ano = $_GET['ano'];

if ($mes == 'branco'){
    $mes_ant = date('m',strtotime('-1 months'));
    $mes_atu =  $mes_atu = date('m');
} else {
    $mes_ant = $mes;
    $mes_atu = $mes;
}

if ($ano =='branco') {
    $ano_atu = date('Y');
    $querystatus = "select * from  VENDAS_PRODUTOS where DT_VENDA >= '".$ano_atu."-".$mes_ant."-01' and DT_VENDA <= '".$ano_atu."-".$mes_atu."-01' and PRODUTO LIKE '%Caneca%' ORDER BY DT_VENDA ASC";
} else {
    $ano_atu = $ano;
    $querystatus = "select * from  VENDAS_PRODUTOS where DT_VENDA >= '".$ano_atu."-".$mes_atu."-01' and DT_VENDA <= '".$ano_atu."-".$mes_atu."-31' and PRODUTO LIKE '%Caneca%' ORDER BY DT_VENDA ASC";
}

$resultstatus = mysqli_query($connect,$querystatus);
$reccount = mysqli_num_rows($resultstatus);

/*$ano_atu = date('Y');
$mes_atu = date('m');
$mes_ant = date('m',strtotime('-1 months'));
$dia_atu = date('d');*/

$sum_product_qty = 0;
$sum_fornec_price = 0;
$frete = 0;
$total = 0;
$sum_frete = 0;
$qtde_frete = 0;

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
} else {
	
		  $queryarea = "SELECT AREA,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		  $selectarea = mysqli_query($connect,$queryarea);
		
		  while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$emailvoluntario = $fetcharea[1];
		  }
		  
		  switch ($area) {
				  case 'operacional':
				  	include_once("menu_operacional.php") ;
					break;
				  case 'diretoria':
				  	include_once("menu_diretoria.php") ;
					break;
				  case 'captacao':
				  	include_once("menu_captacao.php") ;
					break;
     			  case 'financeiro':
				  	include_once("menu_financeiro.php") ;
					break;
				  case 'admin':
				  	include_once("menu_admin.php") ;
					break;
				  case 'comunicacao':
				  	include_once("menu_comunicacao.php") ;
					break;
				  
			  }

            $queryfornec = "SELECT * FROM FORNECEDORES WHERE PRODUTO = 'canecas'";
            $resultfornec = mysqli_query($connect,$queryfornec);
            
            while ($fetchfornec = mysqli_fetch_row($resultfornec)) {
                $nomefornec = $fetchfornec[1];
                $emailfornec = $fetchfornec[9];
                $prod_fornec= $fetchfornec[7];
            }
            

            $message = "<!DOCTYPE html>
            <html lang='pt-br'>
            <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
            <!-- Meta tags Obrigatórias -->
            
            <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
            
            <!-- Bootstrap CSS -->
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
            
            <link rel='stylesheet' type='text/css' href='style-area.css'/>
            
            <link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>
            
            <!-- Custom styles for this template -->
            <link href='navbar.css' rel='stylesheet'>
            
            <title>GAAR - Relatório de vendas</title>
            
            </head>
            <body>
            <main role='main' class='container'>
            <p>
            <div class='starter-template'>
                <center>
                    <h3>RELATÓRIO MENSAL DE VENDAS</h3><br>
                <p> Segue o relatório para conferência dos produtos confeccionados e vendidos em ".$mes_ant."/".$ano_atu." e que estão cadastrados no sistema.  <br><br>
                </center>
                <center><h4>DADOS DOS PEDIDOS</h4></center>
                    <div class='form-group row'>
                      <table class='table' border='1'>
                        <thead class='thead-light'>
            				  <tr>
            				    <th scope='col' colspan='1'>ID Loja Integrada</th>
            				    <th scope='col' colspan='1'>Cliente</th>
            				    <th scope='col' colspan='1'>Data</th>
            					<th scope='col' colspan='1'>Item</th>
            					<th scope='col' colspan='1'>Quantidade</th>
            					<th scope='col' colspan='1'>Valor unitário</th>
            					<th scope='col' colspan='1'>Serviço</th>
            			      </tr>
            		    </thead>
                        <tbody>";
                        
            while ($fetchstatus = mysqli_fetch_row($resultstatus)) {
                    $order_id = $fetchstatus[0];
                    $date_created = $fetchstatus[8];
                    $servico = $fetchstatus[11];
                    $customer = $fetchstatus[1];
                    $total_sales = $fetchstatus[5];
                    $proddesc = $fetchstatus[6];
                    $product_qty = $fetchstatus[7];
                    $frete = $fetchstatus[13];
                    $local_venda = $fetchstatus[17];
                    $id_lojaintegr = $fetchstatus[16];
                    $id_prod = $fetchstatus[21];
                    
                    if ($local_venda =='Loja virtual - confecção e entrega') {
                        $qtde_frete = intval($qtde_frete) + 1;
                    }

                    $ano_date_created = substr($date_created,0,4);
            	    $mes_date_created = substr($date_created,5,2);
            	    $dia_date_created = substr($date_created,8,2);
                	    
                	$queryprod = "SELECT PRECO_CUSTO FROM CONTROLE_ESTOQUE WHERE ID = '$id_prod'";
                	$resultprod = mysqli_query($connect,$queryprod);
                	
                	while ($fetchprod = mysqli_fetch_row($resultprod)) {
                	    $fornec_price = $fetchprod[0];
                	}

                    $price_order = floatval($fornec_price) * $product_qty;
    	
                	$sum_fornec_price = floatval($sum_fornec_price) + $price_order;
                	
                	$sum_product_qty = intval($sum_product_qty) + $product_qty;
                	
                    $message .="<tr>
                    	     <td>".$id_lojaintegr."</td>
                    	     <td>".$customer."</td>
                    	     <td>".$dia_date_created."/".$mes_date_created."/".$ano_date_created."</td> 
                    	     <td>".$proddesc."</td>  
                    	     <td>".$product_qty."</td>  
                    	     <td> R$ ".number_format($fornec_price,2,',', '.')."</td>
                    	     <td>".$servico."</td>
                    	    </tr>";
                }

                        
                $sum_frete = 2.50 * $qtde_frete;

                $total = floatval($sum_fornec_price) + floatval($sum_frete);
            
            
                mysqli_close($connect); 

                $message .="</tbody>
            	             </table>
            	            </div>
                            <center>
                                <h5>RESUMO</h5>
                            </center>
                	        <table class='table'>
                                <thead class='thead-light'>
                        	    </thead>
                            	<tbody>
                                	<tr>
                    					<th scope='row'>Quantidade de produtos</th>
                    					<td>".$sum_product_qty."</td>
                					</tr>
                					<tr>
                    					<th scope='row'>Quantidade de entregas</th>
                    					<td>".$qtde_frete."</td>
                					</tr>
                					<tr>
                    					<th scope='row'>Valor dos produtos</th>
                    					<td> R$".number_format($sum_fornec_price,2,',', '.')."</td>
                					</tr>
                					<tr>
                    					<th scope='row'>Frete</th>
                    					<td> R$".number_format($sum_frete,2,',', '.')."</td>
                					</tr>
                					<tr>
                    					<th scope='row'>Valor total a receber do GAAR</th>
                    					<td> R$".number_format($total,2,',', '.') ."</td>
                					</tr>
            					</tbody>
            				</table>
                    </div>
                    <p><center><a href='relatorio_financeiro.php' class='btn btn-primary'>Nova pesquisa</a></center></p>
            </body>
            </html>";

            echo $message;
            
            /*ini_set('display_errors', 1);
                            
            error_reporting(E_ALL);
            
            $from = "lojinha@gaarcampinas.org";
            
            $subject = "[GAAR Campinas] Relatário de vendas de ".$mes_ant."/".$ano_atu."";
                    	
            $headers = "MIME-Version: 1.0\n";               
            $headers .= "Content-type: text/html; charset=utf-8\n";            
            $headers .= "From: <{$from}> \r\n";
            $headers .= "Reply-To: <{$from}> \r\n";  
            $headers .= "Bcc: lojinha@gaarcampinas.org, financeiro@gaarcampinas.org \r\n";
            
            $to = $emailfornec;
            
            $result =  mail($to, $subject, $message, $headers);
            
            if ($result){
                echo"<script language='javascript' type='text/javascript'>
                alert('E-mail enviado!');
                window.location.href='listapedidos.php'</script>";
                echo "E-mail enviado para: ".$to;
            } else {
                echo "Erro no envio";
            }
            */
}
?>
