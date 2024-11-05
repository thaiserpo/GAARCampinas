<?php 
session_start();

include ("conexao.php"); 
include ("conexao_lojinha.php");

$login = $_SESSION['login'];
$order_id = $_POST['idpedido'];
$status = $_POST['statusped'];
$codigo_correios = $_POST['codigo_correios'];
$email_cliente = $_POST['email_cliente'];


if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
    
        $query = "UPDATE wp_wc_order_stats SET STATUS='$status' WHERE order_id = '$order_id'";
        $update = mysqli_query($connectloja,$query);
        
        /*echo "<br>Mensagem de erro: ".mysqli_error($connectloja). "<br> SQL Error: ".mysqli_errno($connectloja);*/
        
        ini_set('display_errors', 1);
                    		
        error_reporting(E_ALL);

        if(mysqli_errno($connectloja) == '0'){
            
            switch ($status){
                
                case 'wc-ps-paga':
                    $subject = "[Loja do GAAR] Alteração de status do pedido ".$order_id."";
                    $message = "Olá! <br><br> O pagamento para o pedido número ".$order_id." foi aprovado e em breve será entregue.<br><br><a href='http://gaarcampinas.org/area/pedido.php?idpedido=".$order_id."' target='_blank'>Clique aqui para ver o pedido</a><br><br>
                                 <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
    		                     Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
                    break;
                    
                case 'wc-ps-pdf-mesa':
                    $subject = "[Loja do GAAR] Download do seu pedido ".$order_id."";
                    $message = "<p>Olá! <br><br> Segue o link para download do seu calendário de mesa versão online: <a href='https://drive.google.com/file/d/1I6xdI8sy20cWIpLKWy8O04FG0k0xuBQv/view?usp=sharing'>Download</a><br><br>
                                <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
                    break;
                    
                case 'wc-ps-pdf-correios-mesa':
                    $subject = "[Loja do GAAR] Alteração de status do pedido ".$order_id."";
                    $message = "<p>Olá! <br><br> Segue o link para download do seu calendário de mesa versão online: <a href='https://drive.google.com/file/d/1I6xdI8sy20cWIpLKWy8O04FG0k0xuBQv/view?usp=sharing'>Download</a><br><br>
                                A versão física já foi postada. Seu código de rastreio é: ".$codigo_correios." <br><br>
                                <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
                    break;
                    
                case 'wc-ps-pdf-parede':
                    $subject = "[Loja do GAAR] Download do seu pedido ".$order_id."";
                    $message = "Olá! <br><br> Segue o link para download do seu calendário de parede versão online: <a href='https://drive.google.com/file/d/1GiyWxEgqjycG6cyB7vpdBAe4lu7nKWVi/view?usp=sharing'>Download</a><br><br>
                             <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                     Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
                    break;
                    
                case 'wc-ps-pdf-correios-parede':
                    $subject = "[Loja do GAAR] Alteração de status do pedido ".$order_id."";
                    $message = "Olá! <br><br> Segue o link para download do seu calendário de parede versão online: <a href='https://drive.google.com/file/d/1GiyWxEgqjycG6cyB7vpdBAe4lu7nKWVi/view?usp=sharing'>Download</a><br><br>
                             A versão física já foi postada. Seu código de rastreio é: ".$codigo_correios." <br><br>
                             <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                     Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
                    break;
                    
                case 'wc-ps-saiu-entrega':
                    $subject = "[Loja do GAAR] Alteração de status do pedido ".$order_id."";
                    $message = "Olá! <br><br> Seu pedido número ".$order_id." saiu para entrega.<br><br><a href='http://gaarcampinas.org/area/pedido.php?idpedido=".$order_id."' target='_blank'>Clique aqui para ver o pedido</a><br><br>
                             <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                     Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
                    break;
                
                case 'wc-ps-separacao':
                    $subject = "[Loja do GAAR] Alteração de status do pedido ".$order_id."";
                    $message = "Olá! <br><br> Seu pedido número ".$order_id." está sendo preparado para a entrega.<br>Caso tenha vaso ou caneca em seu pedido, ela será entregue separadamente.<br><br><a href='http://gaarcampinas.org/area/pedido.php?idpedido=".$order_id."' target='_blank'>Clique aqui para ver o pedido</a><br><br>
                             <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                     Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
                    break;
                    
                case 'wc-ps-correios':
                    $subject = "[Loja do GAAR] Alteração de status do pedido ".$order_id."";
                    if ($codigo_correios =='') {
                       $message = "Olá! <br><br> Seu pedido número ".$order_id." foi postado. <br>Caso tenha vaso ou caneca em seu pedido, ela será entregue separadamente.<br><br><a href='http://gaarcampinas.org/area/pedido.php?idpedido=".$order_id."' target='_blank'>Clique aqui para ver o pedido</a><br><br>
                             <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                     Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>"; 
                    } else {
                        $message = "Olá! <br><br> Seu pedido número ".$order_id." foi postado. <br>Seu código de rastreio é: ".$codigo_correios." <br>Caso tenha vaso ou caneca em seu pedido, ela será entregue separadamente.<br><br><a href='http://gaarcampinas.org/area/pedido.php?idpedido=".$order_id."' target='_blank'>Clique aqui para ver o pedido</a><br><br>
                             <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                     Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>"; 
                    }
                    
                    break;
                
                case 'wc-ps-entregue':
                    $query = "SELECT * FROM wp_wc_order_product_lookup WHERE order_id = '$order_id'";
                    $select = mysqli_query($connectloja,$query);
                    $reccountorder = mysqli_num_rows($select);
                    
                    while ($fetch = mysqli_fetch_row($select)) { 	
                        $product_id = $fetch[2];
                        $product_qty = $fetch[6];
            
                        $querysku = "SELECT sku FROM wp_wc_product_meta_lookup WHERE product_id = '$product_id'";
                        $selectsku = mysqli_query($connectloja,$querysku);
                        
                        while ($fetchsku = mysqli_fetch_row($selectsku)) {
                            $prod_desc = $fetchsku[0];
                            
                            echo "<br> prod desc: ".$prod_desc;
                            
                            if (strpos($prod_desc, 'Calendário') !== false) {
                            
                                $queryqtde = "SELECT QTDE FROM CONTROLE_ESTOQUE WHERE PRODUTO = '$prod_desc'";
                                $selectqtde = mysqli_query($connect,$queryqtde);
                                
                                while ($fetchqtde = mysqli_fetch_row($selectqtde)) {
                                    $estoque = $fetchqtde[0];
                                }
                                
                                $tmp = intval($estoque) - intval($product_qty);
                                
                                $query = "UPDATE CONTROLE_ESTOQUE SET QTDE = '$tmp' WHERE PRODUTO = '$prod_desc'";
                                $update = mysqli_query($connect,$query);

                                if(mysqli_errno($connect) != '0'){
                                    
                                    $from = "lojinha@gaarcampinas.org";
                		
                		            $to = "thaise.piculi@gmail.com";
                		            
                		            $subject = "Erro ao atualizar o estoque com o pedido ".$order_id."";
                		
                            		$headers = "MIME-Version: 1.0\n";               
                            		$headers .= "Content-type: text/html; charset=utf-8\n";            
                            		$headers .= "From: {$from} \r\n"; 
                            		
                            		$message = "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect).""; 
                            		
                            		echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect).""; 
                        
                            		mail($to, $subject, $message, $headers);
                                } 
                            }
                            
                        }
                            
                    }
                    
                    $subject = "[Loja do GAAR] Alteração de status do pedido ".$order_id."";
                    
                    $message = "Olá! <br><br> Seu pedido número ".$order_id." foi entregue.<br><br>
                                 <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
    		                     Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
                    break;
                
            }
                
          
    		$from = "lojinha@gaarcampinas.org";
    		
    		$to = $email_cliente;
    		
    		$headers = "MIME-Version: 1.0\n";               
    		$headers .= "Content-type: text/html; charset=utf-8\n";            
    		$headers .= "From: {$from} \r\n"; 
    		$headers .= "Bcc: lojinha@gaarcampinas.org \r\n";
    
            if ($status <> 'wc-trash' && $status <> 'wc-ps-cancelada') {
                mail($to, $subject, $message, $headers);
                echo "<br> mensagem: ".$message;
                echo "<br> código correio: ".$codigo_correios;
    		    echo "<br> E-mail enviado para ".$to;
    		    
            }
    		
    		
            echo"<script language='javascript' type='text/javascript'>
                         alert('Pedido atualizado');
            			 window.location.href='formpesquisavendaprod.php'</script>";
        }
}
?>