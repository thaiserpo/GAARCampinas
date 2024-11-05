<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 
include ("conexao_lojinha.php"); 

$login = $_SESSION['login'];
$statusprod = $_POST['statusprod'];
$numpedido = $_POST['numpedido'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,NOME,EMAIL,SUBAREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$nome = $fetcharea[1];
				$email = $fetcharea[2];
				$subarea = $fetcharea[3];
		}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Meta tags Obrigatórias -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <title>GAAR - Lista de pedidos</title>
    
</head>
<body> 
<?php 
		
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
				  case 'anuncios':
				  	include_once("menu_terceiros.php") ;
					break;
				  case 'fornecedor':
				  	include_once("menu_fornec.php") ;
					break;
				  
			  }
			  
?>

<main role="main" class="container">
    <div class="starter-template">
            <br>
            <center><h3>Lista de pedidos da loja virtual</h3></center>
            <br>
<?
    if ($numpedido != '') {
        echo "<script>document.location='verpedido.php?idpedido=".$numpedido."'</script>";
    } else {
      if ($statusprod == ''){
        if ($area == 'fornecedor' && $subarea =='canecas') {
            $queryprod = "SELECT * FROM wp_wc_product_meta_lookup WHERE sku like '%caneca%'";
            $resultprod = mysqli_query($connectloja,$queryprod);
            
            while ($fetchprod = mysqli_fetch_row($resultprod)) {
                $product_id = $fetchprod[0];
                $query = "SELECT order_id FROM wp_wc_order_product_lookup WHERE product_id = '$product_id'";
                $resultorder = mysqli_query($connectloja,$query);
                
                while ($fetchtmp = mysqli_fetch_row($resultorder)){
                    $order_id = $fetchtmp[0];
                }
                
                $querystatus = "SELECT * FROM wp_wc_order_stats WHERE order_id = '$order_id' ORDER BY ORDER_ID DESC ";
            }
            
        } else {
            $querystatus = "SELECT * FROM wp_wc_order_stats WHERE status <> 'wc-trash' ORDER BY ORDER_ID DESC ";
        }
        } else {
            $querystatus = "SELECT * FROM wp_wc_order_stats WHERE status = '$statusprod' ORDER BY ORDER_ID DESC ";
        }
    	$resultstatus = mysqli_query($connectloja,$querystatus);
    	$reccountstatus = mysqli_num_rows($resultstatus);
    	
    	echo "
    	         <center>".$reccountstatus." pedidos encontrados </center>
    	         <br>
    	         
        <table class='table'>
                <thead class='thead-light'>
    						  <tr>
    						    <th scope='col' colspan='1'>Pedido</th>
    							<th scope='col' colspan='1'>Data</th>
    							<th scope='col' colspan='1'>Cliente</th>
    							<th scope='col' colspan='1'>Item</th>
    							<th scope='col' colspan='1'>Valor</th>
        			            <th scope='col' colspan='3'>Status</th>
    					  
    					      </tr>
    				</thead>
    				<tbody>";
    				
    		$sum_total = 0;
    		
        while ($fetchstatus = mysqli_fetch_row($resultstatus) ) {
            
            $total = 0;
            $count_caneca = 0;
            $count_calendar = 0;
            
            $order_id = $fetchstatus[0];
            $date_created = $fetchstatus[2];
    	    $status = $fetchstatus[10];
    	    $customer_id = $fetchstatus[11];
    	    $total = floatval($fetchstatus[5]);
    	    
    	    $sum_total = floatval($sum_total) + floatval($total);
    
            $querypedido = "SELECT * FROM wp_woocommerce_order_items WHERE order_item_type='line_item' AND ORDER_ID = '$order_id' ORDER BY ORDER_ITEM_ID DESC";
    	    $resultpedido = mysqli_query($connectloja,$querypedido);
    	    $reccountpedido = mysqli_num_rows($resultpedido);
    	    
    	    $desc ='';
    
    	    while ($fetchpedido = mysqli_fetch_row($resultpedido)) {
                $order_item_name = $fetchpedido[1];
                $order_item_type = $fetchpedido[2];
    
                if (strpos($order_item_name, 'Caneca') !== false) {
    	            if ($desc == ''){
        	           $desc_caneca = "Caneca"; 
        	           $count_caneca = intval($count_caneca) + 1;
        	           $desc = $desc_caneca;
        	        } else {
        	            if ($count_caneca >= 1) {
        	                $desc = $desc_caneca;
        	            } else {
        	                $desc = $desc_caneca." e ".$desc_calendario;
        	            }
        	                
        	        }
        	    }
        	    
        	    if (strpos($order_item_name, 'Calendário') !== false) {
        	        if ($desc == ''){
        	           $desc_calendario = "Calendário"; 
        	           $count_calendar = intval($count_calendar) + 1;
        	           $desc = $desc_calendario;
        	        } else {
        	            if ($count_calendar >= 1) {
        	                $desc = $desc_calendario;
        	            } else {
        	                $desc = $desc_caneca." e ".$desc_calendario;
        	            }
        	                
        	        }
        	         
        	    }
    	    }
    	    
    	    /*echo "<br> count calendar: ".$count_calendar;
    	    echo "<br> desc: ".$desc;
    	    echo "<br><br>";*/
    	    
    	    $querycliente = "SELECT * FROM wp_wc_customer_lookup WHERE customer_id = '$customer_id'";
    	    $resultcliente = mysqli_query($connectloja,$querycliente);
    	    
            while ($fetchcliente = mysqli_fetch_row($resultcliente)) {
    	        $first_name = $fetchcliente[3];
    	        $last_name = $fetchcliente[4];
    	        $email = $fetchstatus[5];
    	    }
    	    
    	    switch ($status){
        	        case 'wc-ps-pagamento':
        	            $status = 'Aguardando pagamento';
        	            break;
        	            
        	        case 'wc-ps-paga':
        	            $status = 'Pago';
        	            break;
        	            
        	        case 'wc-ps-cancelada':
        	        case 'wc-ps-devolvida':
        	            $status = 'Cancelado';
        	            break;
        	            
        	        case 'wc-ps-separacao':
        	            $status = 'Em separação';
        	            break;
        	            
        	        case 'wc-ps-correios':
        	            $status = 'Enviado pelos Correios';
        	            break;
        	        
        	        case 'wc-ps-pdf-mesa':
        	            $status = 'Enviado PDF versão mesa';
        	            break;
        	            
        	        case 'wc-ps-pdf-parede':
        	            $status = 'Enviado PDF versão parede';
        	            break;
        	            
        	        case 'wc-ps-pdf-correios-mesa':
        	            $status = 'Enviado pelos Correios + PDF versão mesa';
        	            break;
        	            
        	        case 'wc-ps-pdf-correios-parede':
        	            $status = 'Enviado pelos Correios + PDF versão parede';
        	            break;
        	            
        	        case 'wc-ps-entregue':
        	            $status = 'Entregue';
        	            break;
        	    }
    	    
    	    if ($area == 'fornecedor' && $subarea =='canecas') {
    	         while ($fetchorder = mysqli_fetch_row($resultorder)){
    	             
    	         }
    	    } else {
    	       
    	    echo "<tr>";
    					echo "<td>".$order_id."</td>";
            			echo "<td>".$date_created."</td>";
    					echo "<td>".$first_name." ".$last_name."</td>";
    					echo "<td>".$desc." <br><a href='veritens.php?idpedido=".$order_id."' target='_blank'>Ver itens</a>&nbsp;</td>";
    					echo "<td>R$ ".number_format($total,2,',', '.')."</td>";
    				    echo "<td>".$status."</td>";
    				    echo "<td><a href='verpedido.php?idpedido=".$order_id."' class='btn btn-primary'>Visualizar</a>&nbsp;</td>";
    				    echo "<td><a href='geraretiqueta.php?idpedido=".$order_id."' class='btn btn-primary' target='_blank'>Gerar etiqueta</a></td>
    		      </tr>";
            
            }
            
        }
    	
    	   echo " </tbody>
    	         </table>
    	         
    	         <br>
    	         <center>
                                            <h3>RESUMO</h3><br>
                                       </center>
                            	        <table class='table'>
                                            <thead class='thead-light'>
                                    	    </thead>
                                        	<tbody>
                                            	<tr>
                                					<th scope='row'>Valor total dos pedidos (sem desconto da taxa do Pagseguro)</th>
                                					<td>R$ ".number_format($sum_total,2,',', '.')."</td>
                            					</tr>
                        					</tbody>
                        				</table>
    	         
    	         ";   
        }
	         
	
    mysqli_close($connectloja);
		
}

?>
<center><a href="formpesquisavendaprod.php" class="btn btn-primary">Nova pesquisa</a></center>
</main>
<br><br>
<footer class="footer fixed-bottom bg-light">
      <div class="container">
        <p class="text-center">GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
      </div>
    </footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
