<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
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
$frete = $_POST['frete'];
$idloja2 = $_POST['idloja2'];
$meiopag = $_POST['meiopag'];
$codcorreio = $_POST['codcorreio'];
$obs = $_POST['obs'];
$status_post = $_POST['status'];
$uploaddir = '/home/gaarcam1/public_html/docs/financeiro/';
$uploadfile = $uploaddir.($_FILES['foto']['name']);
$nome_file = $_FILES['foto']['name'];
$resp =  $_POST['voluntario'];

        
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
		    $file = $uploadfile;
        } else {
            $file = '';
        }

        
        if ($qtdemesa == ''){
            $qtdemesa = 0;
        }
        
        if ($qtdeparede == ''){
            $qtdeparede = 0;
        }
        
        if ($frete == ''){
            $frete = 0;
        }
        
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
        

       $query = "INSERT INTO VENDAS_CALENDARIO
					(NOME, 
					CPFCNPJ, 
					ENDERECO, 
					BAIRRO, 
					CIDADE, 
					ESTADO,
					CEP,
					TELEFONE,
					EMAIL,
					QTDE_MESA,
					QTDE_PAREDE,
					SUBTOTAL,
					FRETE,
					TOTAL,
					ID_LOJA2,
					MEIO_PAG,
					COD_RASTREIO,
					COMPROVANTE_POST,
					STATUS_POST,
					RESPONSAVEL,
					OBS) 
					VALUES
                    ('$nome',
                    '$cpfcnpj',
                    '$endereco',
                    '$bairro',
                    '$cidade',
                    '$uf',
                    '$cep',
                    '$celular',
                    '$email',
                    '$qtdemesa',
                    '$qtdeparede',
                    '$totalpedido',
                    '$frete',
                    '$total',
                    '$idloja2',
                    '$meiopag',
                    '$codcorreio',
                    '$nome_file',
                    '$status_post',
                    '$resp',
                    '$obs')";
						
        $insert = mysqli_query($connect,$query); 	
        
         $admin = "INSERT INTO DOCUMENTACAO 
		                (EVENTO,
		                 ENDERECO,
		                 DATA,
		                 DESCRICAO,
		                 VOLUNTARIOS_PRESENTES,
		                 FILE,
		                 AREA_PRINCIPAL,
		                 USUARIO)	
        		        VALUES 
        		        ('Comprovante de postagem do calendário - cliente ".$nome."',
        		        '0',
        		        now(),
        		        'Comprovante de postagem do calendário - cliente ".$nome."',
        		        '0',
        		        '$nome_file',
        		        'Financeiro',
        		        '$login')";
		        
		 $insertadmin = mysqli_query($connect,$admin); 
		 
        if($insert=='0' || $insert == '1'){
           /* echo "Insert code: ".$insert;
			echo "Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);
			echo "Erro ao cadastrar <br><br>";*/
		  
		   if ($nome_file != '' && ($meiopag == 'Dinheiro' || $meiopag == 'DOC ou TED' )){
		        $obs = "Produto entregue";
		    }
		    
		    
		    ini_set('display_errors', 1);

		    error_reporting(E_ALL);

		    $from ="contato@gaarcampinas.org";
		    
		    $to = "financeiro@gaarcampinas.org";
		
    		$subject="Nova venda de calendário cadastrada";
    		
    		$headers ="MIME-Version: 1.0\n";               
    		$headers .="Content-type: text/html; charset=utf-8\n";            
    		$headers .="From: <{$from}> \r\n";    
    		$headers .= "Bcc: thaise.piculi@gmail.com \r\n"; 	

    		$message = "Nova venda de calendário cadastrada!<br><br> Seguem os dados para controle:<br><br>
    		            Nome do cliente: ".$nome."<br>
    		            Quantidade de calendários de mesa: ".$qtdemesa."<br>
    		            Quantidade de calendários de parede: ".$qtdeparede."<br>
    		            Meio de pagamento: ".$meiopag."<br>
    		            Subtotal: ".$totalpedido."<br>
    		            Total a receber (com taxa e frete): ".$total." <br>
    		            Observações: ".$obs." <br><br>
    		            
    		            Para mais detalhes, <br><br>
    		            
    		            1. Acesse a área restrita: <a href='http://gaarcampinas.org/area/login.html' target=_blank>http://gaarcampinas.org/area/login.html</a><br>
    		            2. Posicione o mouse no menu Captação <br>
    		            3. Escolha Pesquisar pedidos calendário <br><br>
    		            
    		            *** Este é um extrato gerado pela área restrita **
    		            " ;
    		
    		mail($to, $subject, $message, $headers);
    		
    		echo"<script language='javascript' type='text/javascript'>
                    alert('Venda cadastrada com sucesso!');
		            window.location.href='formvendacalendar.php'</script>";
		    
		    
	    }else{ 
			echo "Insert code: ".$insert;
			echo "Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);
			echo "Erro ao cadastrar <br><br>";
			echo "<a href='formvendacalendar.php'>Voltar</a>";
          /*echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao cadastrar');window.location
          .href='termo.php'</script>";*/
        }
}
?>