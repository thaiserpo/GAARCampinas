<?php 

session_start();

include ("conexao.php"); 

$nomesocio = strtoupper($_POST['nomesocio']);
$celularsocio = $_POST['celularsocio'];
$emailsocio = $_POST['emailsocio'];
$valorsocio = $_POST['valorsocio'];
$cpfsocio = $_POST['cpfsocio'];
$outrovalor = $_POST['outrovalor'];
$forma = $_POST['forma'];
$frequencia = $_POST['freq'];
$apadrinhar = $_POST['apadrinhar'];
$idanimal = $_POST['idanimal'];
$diadomesocio = $_POST['diadomesocio'];

    if ($nomesocio !=''){

		if ($valorsocio == 'Outro'){
				$valorsocio = $outrovalor;
		}
		
		if ($diadomesocio == '') {
		    $diadomesocio = 0;
		}
		
		if ($lembrete =='') {
		    $lembrete = "Não";
		}
		
		
		$queryresp = "SELECT NOME_ANIMAL,RESPONSAVEL FROM ANIMAL WHERE ID = '$idanimal'";
        $selectresp = mysqli_query($connect,$queryresp);
        $reccountresp = mysqli_num_rows($selectresp);
        
        /*echo "<br> reccount responsavel: ".$reccountresp;*/
            				
        while ($fetchresp = mysqli_fetch_row($selectresp)) {
        	 $nomedoanimal = $fetchresp[0];
        	 $resp = $fetchresp[1];
        }
        
        $queryarea = "SELECT EMAIL,CELULAR FROM VOLUNTARIOS WHERE NOME ='$resp'";
    	$selectarea = mysqli_query($connect,$queryarea);
    		
    	while ($fetcharea = mysqli_fetch_row($selectarea)) {
    			$emailresp = $fetcharea[0];
    			$celularresp = $fetcharea[2];
    	}
    	
        $queryinsertsocio = "INSERT INTO SOCIO 
	            (NOME,
	            CIDADE,
	            TEL_CELULAR,
	            EMAIL,
	            VALOR,
	            FORMA_AJUDAR,
	            MELHOR_DIA,
	            RECEBER_LEMBRETE,
	            BANCO,
	            AGENCIA,
	            CONTA,
	            DV,
	            FREQ_DOACAO,
	            CPF,
	            APADRINHAMENTO,
	            ID_ANIMAL,
	            OBS,
	            LOGIN,
	            SENHA) 
	            VALUES 
	            ('$nomesocio',
	            '0',
	            '$celularsocio',
	            '$emailsocio',
	            '$valorsocio',
	            '$forma',
	            '$diadomesocio',
	            'Sim',
	            '0',
	            '0',
	            '0',
	            '0',
	            '$frequencia',
	            '$cpfsocio',
	            'Sim',
	            '$idanimal',
	            '0',
	            '0',
	            '0') ";
	 
		$insert = mysqli_query($connect,$queryinsertsocio);            
		
		$querygetid = "SELECT ID FROM SOCIO WHERE NOME ='$nomesocio'";
    	$selectgetid = mysqli_query($connect,$querygetid);
		$fetchid = mysqli_fetch_row($selectgetid);    
		
		if ($cpfsocio =='') {
		    $cpfsocio = 0;   
		}
    	
    	if ($fetchid[0] ==''){
    	    $fetchid[0] = 0;
    	}
    	
        $queryinsert = "INSERT INTO APADRINHAMENTO 
                    (NOME_PADRINHO,
                    CELULAR_PADRINHO,
                    EMAIL_PADRINHO,
                    VALOR_PADRINHO,
                    FORMA_AJUDAR,
                    ID_ANIMAL,
                    NOME_RESP,
                    EMAIL_RESP,
                    CELULAR_RESP,
                    FREQUENCIA,
                    ATIVO,
                    ID_SOCIO,
                    CPF_PADRINHO)
                    VALUES (
                    '$nomesocio',
                    '$celularsocio',
                    '$emailsocio',
                    '$valorsocio',
                    '$forma',
                    '$idanimal',
                    '$resp',
                    '$emailresp',
                    '$celularresp',
                    '$frequencia',
                    'Sim',
                    '$fetchid[0]',
                    '$cpfsocio')
                    ";
    
        $insert = mysqli_query($connect,$queryinsert); 
        
        if(mysqli_errno($connect)== '0'){
            
            echo"<script language='javascript' type='text/javascript'>
            alert('Cadastro realizado com sucesso');window.location
            .href='http://gaarcampinas.org/'</script>";
            
            ini_set('display_errors', 1);

		    error_reporting(E_ALL);
		    
		/*	echo "Insert code: ".$insert;
			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */

    		$from ="financeiro@gaarcampinas.org";
    		
    		$to = $emailsocio;
    		
    		$subject="Seja bem vindo(a) sócio contribuinte!";
    		
    		$headers ="MIME-Version: 1.0\n";               
    		$headers .="Content-type: text/html; charset=utf-8\n";            
    		$headers .="From: <{$from}> \r\n";    
    /*		$headers .='Bcc: {$bcc} \r\n";*/
    
            $message = "Olá ".$nomesocio."! <br><br> Ficamos muito felizes em tê-lo como padrinho/madrinha de ".$nomedoanimal.". <br><br>
            
            Sua valiosa ajuda chegou em boa hora. Agradecemos imensamente! Abaixo estão os dados cadastrados em nosso banco de dados <br><br>
            
    		<B>SUAS INFORMAÇÕES</B> <br><br>
                                    
                                <table>
                                    <tr>    
                                        <td align='left'>Nome</td>
                                        <td align='left'>: ".$nomesocio."</td>
                                    </tr>
                                    <tr>    
                                        <td align='left'>Celular</td>
                                        <td align='left'>: ".$celularsocio."</td>
                                    </tr>
                                    <tr>    
                                        <td align='left'>E-mail</td>
                                        <td align='left'>: ".$emailsocio."</td>
                                    </tr>
                                    <tr>    
                                        <td align='left'>Valor da contribuição</td>
                                        <td align='left'>: ".$valorsocio."</td>
                                    </tr>
                                    <tr>    
                                        <td align='left'>Forma de ajudar</td>
                                        <td align='left'>: ".$forma."</td>
                                    </tr>
                                    <tr>    
                                        <td align='left'>Melhor dia do mês pra doar</td>
                                        <td align='left'>: ".$diadomesocio."</td>
                                    </tr>
                                    <tr>    
                                        <td align='left'>Deseja receber lembretes mensais?</td>
                                        <td align='left'>: ".$lembrete."</td>
                                    </tr>
                                    <tr>    
                                        <td align='left'>Animal apadrinhado</td>
                                        <td align='left'>: ".$nomedoanimal."</td>
                                    </tr>
                                    <tr>    
                                        <td align='left'>E-mail do voluntário responsável</td>
                                        <td align='left'>: ".$emailresp."</td>
                                    </tr>
                                </table> <br>";
                                
                                if ($forma =='Banco Itaú'){
                                    $message .= "<B>DADOS BANCÁRIOS PARA DEPÓSITO</B> <br>
                                     <p> Banco Itaú <br>
                                         Agência 4518 <br>
                                         Conta corrente 22205-6<br>
                                         CNPJ 04.825.442/0001-28</p>";
                                }
                                
                                if ($forma =='PIX'){
                                    $message .= "<B>PIX</B> <br>
                                     <p> Chave PIX: financeiro@gaarcampinas.org</p>";
                                }
                                
                                $message .= "<br><br>
    					
    		Caso haja alguma informação incoerente, por gentileza responda esse e-mail. <br><br>
    		
    		<img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
	        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas <br><br>
    		
    		***** Este e-mail foi gerado automaticamente pelo nosso site *****" ;
                }
    		
    		mail($to, $subject, $message, $headers);
    		
    		$from = "admin@gaarcampinas.org";
    
            $subject="Novo padrinho/madrinha para ".$nomedoanimal." cadastrado!";
            
            $to = $emailresp;

    		$headers ="MIME-Version: 1.0\n";               
    		$headers .="Content-type: text/html; charset=utf-8\n";            
    		$headers .="From: <{$from}> \r\n";    
    		$headers .="Bcc: thaise.piculi@gmail.com \r\n";
    
    		$message = "
    		
    					<B>NOVO SÓCIO CADASTRADO</B> <br><br>
                                        
                                    <table>
                                        <tr>    
                                            <td align='left'>Nome</td>
                                            <td align='left'>: ".$nomesocio."</td>
                                        </tr>
                                        <tr>    
                                            <td align='left'>Cidade</td>
                                            <td align='left'>: ".$cidadesocio."</td>
                                        </tr>
                                        <tr>    
                                            <td align='left'>Celular</td>
                                            <td align='left'>: ".$celularsocio."</td>
                                        </tr>
                                        <tr>    
                                            <td align='left'>E-mail</td>
                                            <td align='left'>: ".$emailsocio."</td>
                                        </tr>
                                        <tr>    
                                            <td align='left'>Valor da contribuição</td>
                                            <td align='left'>: ".$valorsocio."</td>
                                        </tr>
                                        <tr>    
                                            <td align='left'>Forma de ajudar</td>
                                            <td align='left'>: ".$forma."</td>
                                        </tr>
                                        <tr>    
                                            <td align='left'>Melhor dia do mês pra doar</td>
                                            <td align='left'>: ".$diadomesocio."</td>
                                        </tr>
                                        <tr>    
                                            <td align='left'>Deseja receber lembretes mensais?</td>
                                            <td align='left'>: ".$lembrete."</td>
                                        </tr>
                                        <tr>    
                                            <td align='left'>Padrinho/madrinha de: </td>
                                            <td align='left'>: ".$nomedoanimal."</td>
                                        </tr>
                                        </table> <br><br>";

                            
    					$message .= "
    					Todas essas informações estarão disponíveis também na área restrita: <br>
    					1 - Acesse o link http://gaarcampinas.org/area/login.html; <br>
    					2 - Posicione o mouse em cima do menu Financeiro, vai abrir uma lista de menus e clique em Pesquisar sócio contribuinte<BR><BR>
    					
    					***** Este e-mail foi gerado automaticamente pelo nosso site *****" ;
    		
    		mail($to, $subject, $message, $headers);			  
		
        }else{ 
			echo "Insert code: ".$insert;
			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
			echo "Erro ao cadastrar <br><br>";
			echo "<a href='http://gaarcampinas.org/quero-ser-socio/'>Voltar</a>";
          /*echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao cadastrar');window.location
          .href='termo.php'</script>";*/
        }
?>