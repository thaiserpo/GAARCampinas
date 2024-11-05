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

        $queryshipping = "SELECT * FROM wp_postmeta WHERE meta_key like '%shipping%' AND post_id = '$idpedido' order by meta_id asc";
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
    	                $endereco_2 = $endereco_1." - ".$meta_value;
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
    	    
        $querystatus = "SELECT * FROM wp_wc_order_stats WHERE order_id = '$idpedido'";
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
    
    <script type="text/javascript">
                        
                            function showdivEmail () {
                                        document.getElementById('divemail').className  = "d-block";
                                }
    </script>
    
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
				  
			  }
			  
?>
<main role="main" class="container">
    <div class="starter-template">
	<br>
	 <form action="atualizapedido.php" method="POST" enctype="multipart/form-data" name="form">
    	   <CENTER>
    	        <br>
    	        <h3>DETALHE DO PEDIDO NÚMERO <? echo $idpedido ?> </h3><br>
    	   </CENTER>
    	   <input type="text" name="idpedido" id="idpedido" value="<?echo $idpedido?>" hidden>
    	   <input type="text" name="email_cliente" id="email_cliente" value="<? echo $email ?>" hidden>
            <div class="form-group row">
                  <label class="col-sm-2 col-form-label"><strong>Status: </strong></label> 
                  <div class="col-sm-4">
                    <select class="form-control" id="statusped" name="statusped" required>
                             <? 
                                    switch ($status){
                            	        case 'Aguardando pagamento':
                            	            echo "<option value='wc-ps-pagamento' selected>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga'>Pago</option>";
                            	            echo "<option value='wc-ps-cancelada'>Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida'>Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao'>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue'>Entregue</option>";
                            	            echo "<option value='wc-ps-correios'>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa'>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede'>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede'>Enviado pelos Correios + PDF versão parede</option>";
                            	            echo "<option value='wc-ps-saiu-entrega'>Saiu para entrega</option>";
                            	            break;
                            	            
                            	        case 'Pago':
                            	            echo "<option value='wc-ps-pagamento'>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga' selected>Pago</option>";
                            	            echo "<option value='wc-ps-cancelada'>Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida'>Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao'>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue'>Entregue</option>";
                            	            echo "<option value='wc-ps-correios'>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa'>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede'>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede'>Enviado pelos Correios + PDF versão parede</option>";
                            	            echo "<option value='wc-ps-saiu-entrega'>Saiu para entrega</option>";
                            	            break;
                            	            
                            	        case 'Cancelado':
                            	            echo "<option value='wc-ps-pagamento'>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga' >Pago</option>";
                            	            echo "<option value='wc-ps-cancelada' selected>Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida'>Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao'>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue'>Entregue</option>";
                            	            echo "<option value='wc-ps-correios'>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa'>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede'>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede'>Enviado pelos Correios + PDF versão parede</option>";
                            	            echo "<option value='wc-ps-saiu-entrega'>Saiu para entrega</option>";
                            	            break;
                            	            
                            	        case 'Devolvido':
                            	            echo "<option value='wc-ps-pagamento'>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga' >Pago</option>";
                            	            echo "<option value='wc-ps-cancelada' >Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida' selected >Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao'>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue'>Entregue</option>";
                            	            echo "<option value='wc-ps-correios'>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa'>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede'>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede'>Enviado pelos Correios + PDF versão parede</option>";
                            	            echo "<option value='wc-ps-saiu-entrega'>Saiu para entrega</option>";
                            	            break;
                            	            
                            	        case 'Entregue':
                            	            echo "<option value='wc-ps-pagamento'>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga' >Pago</option>";
                            	            echo "<option value='wc-ps-cancelada' >Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida'>Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao'>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue' selected>Entregue</option>";
                            	            echo "<option value='wc-ps-correios'>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa'>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede'>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede'>Enviado pelos Correios + PDF versão parede</option>";
                            	            echo "<option value='wc-ps-saiu-entrega'>Saiu para entrega</option>";
                            	            break;
                            	       
                            	        case 'Em separação':
                            	            echo "<option value='wc-ps-pagamento'>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga' >Pago</option>";
                            	            echo "<option value='wc-ps-cancelada' >Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida'>Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao' selected>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue'>Entregue</option>";
                            	            echo "<option value='wc-ps-correios'>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa'>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede'>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede'>Enviado pelos Correios + PDF versão parede</option>";
                            	            echo "<option value='wc-ps-saiu-entrega'>Saiu para entrega</option>";
                            	            break;
                            	        
                            	        case 'Enviado pelos Correios':
                            	            echo "<option value='wc-ps-pagamento'>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga' >Pago</option>";
                            	            echo "<option value='wc-ps-cancelada' >Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida'>Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao'>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue'>Entregue</option>";
                            	            echo "<option value='wc-ps-correios' selected>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa'>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede'>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede'>Enviado pelos Correios + PDF versão parede</option>";
                            	            echo "<option value='wc-ps-saiu-entrega'>Saiu para entrega</option>";
                            	            break;
                            	            
                            	        case 'Enviado PDF versão mesa':
                            	            echo "<option value='wc-ps-pagamento'>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga' >Pago</option>";
                            	            echo "<option value='wc-ps-cancelada' >Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida'>Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao'>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue'>Entregue</option>";
                            	            echo "<option value='wc-ps-correios'>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa' selected>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede'>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede'>Enviado pelos Correios + PDF versão parede</option>";
                            	            echo "<option value='wc-ps-saiu-entrega'>Saiu para entrega</option>";
                            	            break;
                            	            
                            	       case 'Enviado PDF versão parede':
                            	            echo "<option value='wc-ps-pagamento'>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga' >Pago</option>";
                            	            echo "<option value='wc-ps-cancelada' >Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida'>Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao'>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue'>Entregue</option>";
                            	            echo "<option value='wc-ps-correios'>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa'>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede' selected>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede'>Enviado pelos Correios + PDF versão parede</option>";
                            	            echo "<option value='wc-ps-saiu-entrega'>Saiu para entrega</option>";
                            	            break;
                            	            
                            	       case 'Enviado pelos Correios + PDF versão mesa':
                            	            echo "<option value='wc-ps-pagamento'>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga' >Pago</option>";
                            	            echo "<option value='wc-ps-cancelada' >Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida'>Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao'>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue'>Entregue</option>";
                            	            echo "<option value='wc-ps-correios'>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa'>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede'>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa selected'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede'>Enviado pelos Correios + PDF versão parede</option>";
                            	            echo "<option value='wc-ps-saiu-entrega'>Saiu para entrega</option>";
                            	            break;
                            	            
                            	       case 'Enviado pelos Correios + PDF versão parede':
                            	            echo "<option value='wc-ps-pagamento'>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga' >Pago</option>";
                            	            echo "<option value='wc-ps-cancelada' >Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida'>Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao'>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue'>Entregue</option>";
                            	            echo "<option value='wc-ps-correios'>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa'>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede'>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede' selected>Enviado pelos Correios + PDF versão parede</option>";
                            	            echo "<option value='wc-ps-saiu-entrega'>Saiu para entrega</option>";
                            	            break;
                            	            
                            	       case 'Saiu para entrega':
                            	            echo "<option value='wc-ps-pagamento'>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga' >Pago</option>";
                            	            echo "<option value='wc-ps-cancelada' >Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida'>Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao'>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue'>Entregue</option>";
                            	            echo "<option value='wc-ps-correios'>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa'>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede'>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede'>Enviado pelos Correios + PDF versão parede</option>";
                            	            echo "<option value='wc-ps-saiu-entrega' selected>Saiu para entrega</option>";
                            	            break;
                            	            
                            	       default:
                            	            echo "<option value='wc-ps-pagamento'>Aguardando pagamento</option>";
                            	            echo "<option value='wc-ps-paga'>Pago</option>";
                            	            echo "<option value='wc-ps-cancelada'>Cancelado</option>";
                            	            echo "<option value='wc-ps-devolvida'>Devolvido</option>";
                            	            echo "<option value='wc-trash'>Deletar</option>";
                            	            echo "<option value='wc-ps-separacao'>Em separação</option>";
                            	            echo "<option value='wc-ps-entregue'>Entregue</option>";
                            	            echo "<option value='wc-ps-correios'>Enviado pelos Correios</option>";
                            	            echo "<option value='wc-ps-pdf-mesa'>Enviado PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-parede'>Enviado PDF versão parede</option>";
                            	            echo "<option value='wc-ps-pdf-correios-mesa'>Enviado pelos Correios + PDF versão mesa</option>";
                            	            echo "<option value='wc-ps-pdf-correios-parede'>Enviado pelos Correios + PDF versão parede</option>";
                            	            break;
                            	    }
                             
                             ?>
                    	    </select>
                  </div>
                  <div class="col-sm-4">
                    <a href="javascript:form.submit()" class="btn btn-primary">Atualizar</a>
                  </div>
            </div>
            <div class="form-group row">
                  <label class="col-sm-2 col-form-label"><strong>Código de rastreio: </strong></label> 
                  <div class="col-sm-4">
                        <input name="codigo_correios" type="text" id="codigo_correios" maxlength="20" class="form-control">
                  </div>
            </div>
       </form>
       <input type="button" id="Enviadoemail" name="Enviadoemail" class="btn btn-primary" value="Notificar fornecedor" onclick="showdivEmail (this)">
       <form action="envioemailpedido.php" method="post" name="envioemailpedido">
         <div class="form-row d-none" id="divemail">
                            <label class="col-sm-7 col-form-label"><strong>Selecione o fornecedor a ser notificado abaixo: </strong></label> 
                            <div class="col-sm-5">
                                <?
                                $queryfornec = "SELECT * FROM FORNECEDORES ORDER BY ID ASC";
                        	    $resultfornec = mysqli_query($connect,$queryfornec);
                        	    
                        	    while ($fetchfornec = mysqli_fetch_row($resultfornec)) {
                        	        $fornec = $fetchfornec[1];
                        	        $emailpara = $fetchfornec[9];
                        	        
                        	        echo "
                            	         <div class='form-check'>
                                                  <input class='form-check-input' type='radio' name='emailpara' id='".$emailpara."' value='".$emailpara."'><label class='form-check-label' required>".$fornec." </label> &nbsp;&nbsp;
                                         </div>
                                            ";
                        	    }
                                ?>
                            </div>
                            <div class="col-sm-5">
                                <input name="idpedidoemail" type="text" id="idpedidoemail" class="form-control" value="<? echo $idpedido?>" hidden>
                                <a href="javascript:envioemailpedido.submit()" class="btn btn-primary">Enviado</a>
                            </div>
         </div>
        </form>
       <center><h5>DADOS DO CLIENTE</h5></center>
	   <div class="form-group row">
                  <label class="col-sm-2 col-form-label"><strong>Nome completo: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $first_name." ".$last_name; ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Endereço: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-6 col-form-label"><? echo $endereco_2 ?></label> &nbsp;  
                    <label class="col-sm-6 col-form-label"><a href="https://www.google.com/maps/place/<? echo $gmaps ?>/" target="_blank">Veja no Google Maps</a></label>
                  </div> 
                  <label class="col-sm-2 col-form-label"><strong>CEP: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $cep ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Cidade: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $cidade ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>UF:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $uf ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Celular:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $celular ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>E-mail:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><a href="mailto:<? echo $email ?>"><? echo $email ?></a></label> 
                  </div>
        </div>

       <center><h5>DADOS DO PEDIDO</h5></center>
	   <div class="form-group row">
                  <table class='table'>
                    <thead class='thead-light'>
						  <tr>
						    <th scope='col' colspan='1'>Pedido #</th>
							<th scope='col' colspan='1'>Data</th>
							<th scope='col' colspan='1'>Item</th>
							<th scope='col' colspan='1'>Quantidade</th>
							<th scope='col' colspan='1'>Valor unitário</th>
					      </tr>
				    </thead>
				    <tbody>
<?

    $querypedido = "SELECT * FROM wp_wc_order_product_lookup WHERE order_id='$idpedido'";
    $resultpedido = mysqli_query($connectloja,$querypedido);
    $reccountpedido = mysqli_num_rows($resultpedido);

    while ($fetchpedido = mysqli_fetch_row($resultpedido)) {
            
            $order_id = $fetchpedido[1];
            $product_id = $fetchpedido[2];
            $variation_id = $fetchpedido[3];
            $product_qty = $fetchpedido[6];
            $product_net_revenue = $fetchpedido[7];
            $shipping_amount = $fetchpedido[11];

            if ($variation_id == '0') {
                $queryproddesc = "SELECT * FROM wp_wc_product_meta_lookup WHERE product_id = '$product_id'";
            } else {
                $queryproddesc = "SELECT * FROM wp_wc_product_meta_lookup WHERE product_id = '$variation_id' ";
            }
            
    	    $resultproddesc = mysqli_query($connectloja,$queryproddesc);
    	    $reccountproddesc = mysqli_num_rows($resultproddesc);
    
    	    while ($fetchproddesc = mysqli_fetch_row($resultproddesc)) {
                $order_item_name = $fetchproddesc[1];
                $order_item_type = $fetchproddesc[2];
    	    }
            
            $sum_shipping_amount = floatval($shipping_amount) + floatval($sum_shipping_amount);
            $sum_product_net_revenue = floatval($product_net_revenue) + floatval($sum_product_net_revenue);
            $sum_product_qty = intval ($product_qty) + intval($sum_product_qty);
            $total = floatval($sum_product_net_revenue) + floatval($sum_shipping_amount);
			
            echo "<tr>
				     <td>".$order_id."</td>          
				     <td>".$date_created."</td>   
				     <td>".$order_item_name."</td>  
				     <td>".$product_qty."</td>  
				     <td>R$ ".number_format($product_net_revenue,2,',', '.')."</td>
				  </tr>";
    }
?>
				    </tbody>
	             </table>
                <center>
                    <h5>RESUMO</h5>
                </center>
    	        <table class='table'>
                    <thead class='thead-light'>
            	    </thead>
                	<tbody>
                    	<tr>
        					<th scope='row'>Quantidade de produtos</th>
        					<td><? echo $sum_product_qty ?></td>
    					</tr>
    					<tr>
        					<th scope='row'>Valor dos produtos</th>
        					<td>R$ <? echo number_format($sum_product_net_revenue,2,',', '.') ?></td>
    					</tr>
    					<tr>
        					<th scope='row'>Frete</th>
        					<td>R$ <? echo number_format($sum_shipping_amount,2,',', '.') ?></td>
    					</tr>
    					<tr>
        					<th scope='row'>Valor total</th>
        					<td>R$ <? echo number_format($total,2,',', '.') ?></td>
    					</tr>
					</tbody>
				</table>
        </div>
        <div class="d-print-none">
            <div class="d-print-none">
                <center><p><strong>OBSERVAÇÕES</strong><br>
                    <i>Os valores apresentados são as informações cadastradas e foram coletadas pelo sistema diretamente do banco de dados da lojinha do GAAR no Wordpress. </i></center>      
                    <input type="text" id="assunto" name="assunto" value="<? echo $assunto ?>" hidden>
                <!--<textarea name="obs" cols="50" rows="20" id="obs"></textarea><br><br>-->
                <input type="text" id="mensagem" name="mensagem" value="<? echo $mensagem ?>" hidden><br><br>
                <!--<a href="javascript:emailrelatorio.submit()" class="btn btn-primary">Enviado relatório por e-mail</a>-->
            </div>  
        <center>
        <a href="formpesquisavendaprod.php" class="btn btn-primary">Nova pesquisa</a> &nbsp; <a href="javascript:window.print()" class="btn btn-primary">Download</a> &nbsp;
        <br>
        </center>
        </div>
<?

mysqli_close($connect); 
mysqli_close($connectloja); 

/*}*/
        
}

?>
</main>
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
