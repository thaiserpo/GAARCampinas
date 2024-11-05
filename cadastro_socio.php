<?php 

session_start();

include ("conexao.php"); 

$nomesocio = strtoupper($_POST['nomesocio']);
$cidadesocio = $_POST['cidadesocio'];
$celularsocio = $_POST['celularsocio'];
$emailsocio = $_POST['emailsocio'];
$valorsocio = $_POST['valorsocio'];
$cpfsocio = $_POST['cpfsocio'];
$outrovalor = $_POST['outrovalor'];
$forma = $_POST['forma'];
$diadomesocio = $_POST['diadomesocio'];
$lembrete = $_POST['lembrete'];
$agencia = $_POST['agencia'];
$conta = $_POST['conta'];
$dv = $_POST['dv'];
$freq = $_POST['freq'];
$apadrinhar = $_POST['apadrinhar'];
$idanimal = $_POST['idanimal'];
$obs = $_POST['itens'];

    if ($nomesocio !=''){

		if ($valorsocio == 'Outro'){
				$valorsocio = $outrovalor;
		}
		
		if ($agencia == ''){
		    $agencia = 0;
		}

		if ($apadrinhar == ''){
		    $apadrinhar = 'Não';
		    $idanimal = '0';
		} else {
		    $apadrinhar = 'Sim';
		}
		
        $query = "INSERT INTO SOCIO 
		            (NOME,
		            CIDADE,
		            TEL_CELULAR,
		            EMAIL,
		            VALOR,
		            FORMA_AJUDAR,
		            MELHOR_DIA,
		            RECEBER_LEMBRETE,
		            AGENCIA,
		            CONTA,
		            DV,
		            FREQ_DOACAO,
		            CPF,
		            APADRINHAMENTO,
		            ID_ANIMAL,
		            OBS) 
		            VALUES 
		            ('$nomesocio',
		            '$cidadesocio',
		            '$celularsocio',
		            '$emailsocio',
		            '$valorsocio',
		            '$forma',
		            '$diadomesocio',
		            '$lembrete',
		            '$agencia',
		            '$conta',
		            '$dv',
		            '$freq',
		            '$cpfsocio',
		            '$apadrinhar',
		            '$idanimal',
		            '$obs') ";
						
        $insert = mysqli_query($connect,$query); 
        
        if(mysqli_errno($connect)== '0'){
            
            ini_set('display_errors', 1);

		    error_reporting(E_ALL);
		    
		/*	echo "Insert code: ".$insert;
			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
            if ($apadrinhar == ''){
                  echo"<script language='javascript' type='text/javascript'>
                  alert('Cadastrado efetuado com sucesso!');
        		  window.location.href='http://gaarcampinas.org'</script>";
            } else {
                  $query = "SELECT ID,NOME_ANIMAL,RESPONSAVEL FROM ANIMAL WHERE ID= '$idanimal'";
                  $select = mysqli_query($connect,$query); 
                  
                  while ($fetch = mysqli_fetch_row($select)) {
                      $nomedoanimal = $fetch[1];
                      $resp = $fetch[2];
                  }
                  
                  $query = "SELECT EMAIL FROM VOLUNTARIOS WHERE NOME= '$resp'";
                  $select = mysqli_query($connect,$query); 
                  
                  while ($fetch = mysqli_fetch_row($select)) {
                      $emailresp = $fetch[0];
                  }
                  
                  echo"<script language='javascript' type='text/javascript'>
                  alert('Cadastrado efetuado com sucesso!');
        		  window.location.href='http://gaarcampinas.org'</script>";
            }
		

    		$from ="financeiro@gaarcampinas.org";
    		
    		$to = $emailsocio;
    		
    		$subject="Seja bem vindo(a) sócio contribuinte!";
    		
    		$headers ="MIME-Version: 1.0\n";               
    		$headers .="Content-type: text/html; charset=utf-8\n";            
    		$headers .="From: <{$from}> \r\n";    
    /*		$headers .='Bcc: {$bcc} \r\n";*/
    
    
            if ($apadrinhar == 'Não'){ 
                switch ($forma) {
                    case 'PicPay':
                        $message = "<p>Olá ".$nomesocio."! <br><br> Ficamos muito felizes em tê-lo como colaborador da nossa ONG. 
                        
                                    Atualmente temos mais de 60 cães e gatos sob nossa responsabilidade, contabilizando mais de R$ 19.000,00 em gastos fixos como pagamento de lares temporários, vacinas, castrações, compra de rações, vermífugos, tratamento médico veterinário, cirurgias (esporádicas). <br><br> Sua valiosa ajuda chegou em boa hora. Agradecemos imensamente! <br><br>
                                    
                                    A integração do nosso sistema com o Picpay ainda não está concluída, para isso pedimos que por gentileza conclua a sua contribuição acessando o site www.picpay.me/gaarcampinas e cadastre o valor. <br><br>
                		
                		Todo começo de mês você irá receber nosso relatório operacional mensal onde mostram os números das adoções e os nomes dos animais adotados :) <br><br>
            					
            		    Caso haja alguma informação que julgue incoerente, por gentileza responda esse e-mail para esclarecimentos. <br><br>
            		
            		    <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
    		                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas <br><br>
            		
            		    ***** Este e-mail foi gerado automaticamente pelo nosso site *****" ;
                		break;
                	default:
                	    $message = "Olá ".$nomesocio."! <br><br> Ficamos muito felizes em tê-lo como colaborador da nossa ONG. 
                    
                        Atualmente temos mais de 60 cães e gatos sob nossa responsabilidade, contabilizando mais de R$ 19.000,00 em gastos fixos como pagamento de lares temporários, vacinas, castrações, compra de rações, vermífugos, tratamento médico veterinário, cirurgias (esporádicas). <br><br> Sua valiosa ajuda chegou em boa hora. Agradecemos imensamente! <br><br>
                    
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
                                        </table> <br><br>
            					
            		    Todo começo de mês você irá receber nosso relatório operacional mensal onde mostram os números das adoções e os nomes dos animais adotados :) <br><br>
            					
            		    Caso haja alguma informação que julgue incoerente, por gentileza responda esse e-mail para esclarecimentos. <br><br>
            		
            		    <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
    		                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas <br><br>
            		
            		    ***** Este e-mail foi gerado automaticamente pelo nosso site *****" ;
            		    break;
                }
            } else {
                    $message = "Olá ".$nomesocio."! <br><br> Ficamos muito felizes em tê-lo como padinha/madrinha de ".$nomedoanimal.". <br><br>
                    
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
                                        
                                        
                                        $message .= "<br><br>
            					
            		Caso haja alguma informação incoerente, por gentileza responda esse e-mail. <br><br>
            		
            		<img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
    		        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas <br><br>
            		
            		***** Este e-mail foi gerado automaticamente pelo nosso site *****" ;
                }
    		
    		mail($to, $subject, $message, $headers);
    		
    		$from = "admin@gaarcampinas.org";
    
            if ($apadrinhar == 'Não'){   
                $subject="Novo sócio contribuinte cadastrado!";
    		    $to = "financeiro@gaarcampinas.org";
            } else {
    		    $subject="Novo padrinho/madrinha para ".$nomedoanimal." cadastrado!";
                $to = $emailresp;
            }
            
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
                                        </tr>";
                        if ($apadrinhar == ''){    
                            $message .= " </table> <br><br>";
                        } else {
                            $message .= "
                                        <tr>    
                                            <td align='left'>Padrinho/madrinha de: </td>
                                            <td align='left'>: ".$nomedoanimal."</td>
                                        </tr>
                                        </table> <br><br>";
                        }
                            
    					$message .= "
    					Todas essas informações estarão disponíveis também na área restrita: <br>
    					1 - Acesse o link http://gaarcampinas.org/area/login.html; <br>
    					2 - Posicione o mouse em cima do menu Financeiro, vai abrir uma lista de menus e clique em Pesquisar sócio contribuinte<BR><BR>
    					
    					***** Este e-mail foi gerado automaticamente pelo nosso site *****" ;
    		
    		//mail($to, $subject, $message, $headers);			  
		
        }else{ 
			echo "Insert code: ".$insert;
			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
			echo "Erro ao cadastrar <br><br>";
			echo "<a href='http://gaarcampinas.org/quero-ser-socio/'>Voltar</a>";
          /*echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao cadastrar');window.location
          .href='termo.php'</script>";*/
        }
}
?>