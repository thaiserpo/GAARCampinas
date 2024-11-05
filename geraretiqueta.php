<?php 

session_start();

include ("conexao.php"); 
include ("conexao_lojinha.php"); 

$login = $_SESSION['login'];
$idpedido = $_GET['idpedido'];

if($login == "" || $login == null ){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}

        $querypedido = "SELECT * FROM wp_wc_order_product_lookup WHERE order_id='$idpedido'";
    	$resultpedido = mysqli_query($connectloja,$querypedido);
    	$reccountpedido = mysqli_num_rows($resultpedido);

        while ($fetchpedido = mysqli_fetch_row($resultpedido)) {
            
            $order_id = $fetchpedido[1];
            $product_id = $fetchpedido[2];
            
            $queryshipping = "SELECT * FROM wp_postmeta WHERE meta_key like '%shipping%' AND post_id = '$order_id'";
            $resultshipping = mysqli_query($connectloja,$queryshipping);
            $reccountshipping = mysqli_num_rows($resultshipping);
            
            while ($fetchshipping = mysqli_fetch_row($resultshipping)) {
    	        $meta_key = $fetchshipping[2];
    	        $meta_value = $fetchshipping[3];

    	        switch ($meta_key){
    	            case '_shipping_address_1':
    	                $endereco_1 = $meta_value;
    	                break;
    	                
    	            case '_shipping_address_2':
    	                $endereco_2 = $endereco_1." ".$meta_value;
    	                break;
    	            
    	            case '_shipping_city':
    	                $cidade = $meta_value;
    	                break;
    	                
    	            case '_shipping_state':
    	                $uf = $meta_value;
    	                break;
    	                
    	            case '_shipping_postcode':
    	                $cep = $meta_value;
    	                break;
    	                
    	            case '_order_shipping':
    	                $frete = $meta_value;
    	                break;
    	                
    	            case '_shipping_phone':
    	                $celular = $meta_value;
    	                break;
    	            
    	        }
    	        
    	    }
            
            $querystatus = "SELECT * FROM wp_wc_order_stats WHERE order_id = '$order_id'";
    	    $resultstatus = mysqli_query($connectloja,$querystatus);
    	    
    	    while ($fetchstatus = mysqli_fetch_row($resultstatus)) {
    	        $date_created = $fetchstatus[2];
    	        $status = $fetchstatus[10];
    	        $customer_id = $fetchstatus[11];
    	        $num_items_sold = $fetchstatus[4];
    	        $total_sales = $fetchstatus[5];
    	    }
    	    
    	    $querycliente = "SELECT * FROM wp_wc_customer_lookup WHERE customer_id = '$customer_id'";
    	    $resultcliente = mysqli_query($connectloja,$querycliente);
    	    
            while ($fetchcliente = mysqli_fetch_row($resultcliente)) {
    	        $first_name = $fetchcliente[3];
    	        $last_name = $fetchcliente[4];
    	        $email = $fetchcliente[5];
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
    	            $status = 'Enviar pelos Correios';
    	            break;
    	        
    	        case 'wc-ps-pdf-mesa':
    	            $status = 'Enviar PDF versão mesa';
    	            break;
    	            
    	        case 'wc-ps-pdf-parede':
    	            $status = 'Enviar PDF versão parede';
    	            break;
    	            
    	        case 'wc-ps-pdf-correios-mesa':
    	            $status = 'Enviar pelos Correios + PDF versão mesa';
    	            break;
    	            
    	        case 'wc-ps-pdf-correios-parede':
    	            $status = 'Enviar pelos Correios + PDF versão parede';
    	            break;
    	            
    	        case 'wc-ps-saiu-entrega':
    	            $status = 'Saiu para entrega';
    	            break;
    	        
    	        case 'wc-ps-entregue':
    	            $status = 'Entregue';
    	            break;
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
    
    <title>GAAR - Detalhes do pedido</title>

</head>
<body> 
<?php 
		
?>
<main role="main" class="container">
    <div class="starter-template">
	   <div class="form-group row">
                  <div class="col-sm-10">
                    <label class="col-sm-8 col-form-label"><strong><? echo $first_name." ".$last_name; ?></strong></label> 
                  </div>
                  <div class="col-sm-10">
                    <label class="col-sm-8 col-form-label"><? echo $endereco_2 ?></label> &nbsp;  
                  </div> 
                  <div class="col-sm-10">
                    <label class="col-sm-8 col-form-label">CEP: <? echo $cep ?></label> 
                  </div>
                  <div class="col-sm-10">
                    <label class="col-sm-8 col-form-label"><? echo $cidade."/".$uf ?></label> 
                  </div>
        </div>
    </div>
        
<?

mysqli_close($connect); 
mysqli_close($connectloja); 

}
}

?>
</main>
</body>
<br> <br> <br>
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
</html>
