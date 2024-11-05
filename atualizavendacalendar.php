<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$idanimalter = $_POST['idanimalter'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
	    $query = "SELECT * FROM VENDAS_CALENDARIO WHERE ID = '$idvenda'";
		$select = mysqli_query($connect,$query);
		$fetch = mysqli_fetch_row($select);	
		
		$nome = $_POST['nome'];
        $cpfcnpj = $_POST['cpfcnpj'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $cep = $_POST['cep'];
        $celular = $_POST['celular'];
        $email = $_POST['email'];
        $qtdemesa = $_POST['qtdemesa'];
        $qtdeparede = $_POST['qtdeparede'];
		$subtotal = $_POST['subtotal'];
        $frete = $_POST['frete'];
		$total = $_POST['total'];
        $idloja2 = $_POST['idloja2'];
        $meiopag = $_POST['meiopag'];
        $codcorreio = $_POST['codcorreio'];
        $status_post = $_POST['status_post'];
        $obs = $_POST['obs'];
        $uploaddir = '/home/gaarcam1/public_html/docs/';
        $uploadfile = $uploaddir.($_FILES['foto']['name']);
        $nome_file = $_FILES['foto']['name'];
	
	    move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
	    
        $total_pedido = ((intval($qtdemesa)*20) + (intval($qtdeparede)*20) + intval($frete));
        
        if ($meiopag == 'Pagseguro Crédito online' || $meiopag == 'Pagseguro Débito online' || $meiopag == 'Boleto online'){
            $taxa = (( $total_pedido * 3.99)/100) + 0.40;
        }
        
        if ($meiopag == 'Pagseguro Crédito'){
           $taxa = (( $total_pedido * 3.19)/100) + 0.40;
        }
        
        if ($meiopag == 'Pagseguro Débito'){
            $taxa = (( $total_pedido * 2.39)/100) + 0.40;
        }
        
        $a = $total_pedido - $taxa;
        
        $total = number_format($a,2);
        
        $totalpedido = number_format($total_pedido,2);
		
        $query = "UPDATE VENDAS_CALENDARIO
					SET 
					NOME='$nome',
					CPFCNPJ='$cpfcnpj', 
					ENDERECO= '$endereco',
					BAIRRO='$bairro', 
					CIDADE= '$cidade',
					ESTADO= '$uf',
					CEP='$cep',
					TELEFONE='$celular',
					EMAIL='$email',
					QTDE_MESA='$qtdemesa',
					QTDE_PAREDE='$qtdeparede',
					SUBTOTAL='$subtotal',
					FRETE='$frete',
					TOTAL='$total',
					ID_LOJA2='$idloja2',
					MEIO_PAG='$meiopag',
					COD_RASTREIO='$codcorreio',
					COMPROVANTE_POST='$nome_file',
					STATUS_POST='$status_post',
					OBS='$obs'
					WHERE 
					ID = '$idvenda'";
					 				
        $insert = mysqli_query($connect,$query); 	
		 
        if($insert=='0' || $insert=='1'){
          /*echo "Insert code: ".$insert;
			echo "Mensagem de erro: ".mysqli_error($connect). "<br>SQL Error: ".mysqli_errno($connect);*/
         echo"<script language='javascript' type='text/javascript'>
          alert('Pedido atualizado com sucesso!');
		  window.location.href='formatualizavendacalendar.php'</script>";
	    }else{
			echo "Insert code: ".$insert;
			echo "Mensagem de erro: ".mysqli_error($connect). "<br>SQL Error: ".mysqli_errno($connect);
          echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao cadastrar');window.location
          .href='formatualizavendacalendar.php'</script>";
        }
	  
	  	ini_set('display_errors', 1);

		error_reporting(E_ALL);
		
		$from = "contato@gaarcampinas.org";
		
		$to = $emailresp;
		
		$headers = "MIME-Version: 1.0\n";               
		$headers .= "Content-type: text/html; charset=utf-8\n";            
		$headers .= "From: <{$from}> \r\n";  
		$headers .= "Bcc: thaise.piculi@gmail.com \r\n";   
			
		$message = "Olá, <br><br> Seu anúncio para o animal ".$nomeanimal." foi aprovado. <br><br> Para visualização, acesse <a href='http://gaarcampinas.org/petterceiros.php'>Anúncios de terceiros</a>";			
		
		$subject = "Seu anúncio foi aprovado!";
		
		mail($to, $subject, $message, $headers);
}
?>