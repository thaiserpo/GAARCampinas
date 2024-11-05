<?php 

session_start();

include ("conexao.php"); 

$nome_ctt = $_POST['nome_ctt'];
$email_ctt = $_POST['email_ctt'];
$assunto_ctt = $_POST['assunto_ctt'];
$msg_ctt = $_POST['msg_ctt'];

	if ($email_ctt != ''){
		
		echo"<script language='javascript' type='text/javascript'>
          alert('E-mail enviado com sucesso! Em breve retornaremos, por favor verifique sua caixa de SPAM.');window.location.href='http://gaarcampinas.org/'</script>";
		 
		ini_set('display_errors', 1);

		error_reporting(E_ALL);
		
		$from = "contato@gaarcampinas.org";
		
		if ($assunto_ctt == "Cupons Fiscais"){
			
			$to = $email_ctt;
						
			$headers = "MIME-Version: 1.0\n";               
			$headers .= "Content-type: text/html; charset=utf-8\n";            
			$headers .= "From: <{$from}> \r\n";  
			$headers .= "Reply-To: <{$to}> \r\n"; 
			
			$message = "Olá ".$nome_ctt." !<br><br>
			
						Doar seu cupom fiscal faz muito mais diferença do que você imagina!<br><br>

						Antes de mais nada, é necessário instalar o aplicativo Nota Fiscal Paulista e efetuar o cadastro do seu CPF no site da NF Paulista: <a href='https://www.nfp.fazenda.sp.gov.br/login.aspx'>https://www.nfp.fazenda.sp.gov.br/login.aspx</a><br><br>
						
						Feito isso, você como consumidor poderá fazer doação automática de créditos da Nota Fiscal diretamente do seu celular. Há duas maneiras de doar: <br>
						
						No seu aplicativo, você encontrará a opção de doar automaticamente para o GAAR ( CNPJ 04.825.442/0001-28) como Instituição favorita. Assim, sempre que você inserir seu CPF no ato de uma compra, uma parte do imposto será redirecionado ao GAAR como forma de doação.<br>
						
						Nesse método, a cada 100 reais você recebe cupons para participar de sorteios mensais com prêmios em dinheiro! <br>
						
						A segunda maneira possibilita que você doe mesmo sem inserir seu CPF no ato da compra. Basta guardar a Nota Fiscal e registrar manualmente através do seu aplicativo ou conseguir juntar várias, pedir em comércios, e entregar o lote para um(a) voluntário(a) do GAAR. <br><br>
						
						Mais detalhes no link <a href='http://gaarcampinas.org/atencao-nota-fiscal-paulista/'>http://gaarcampinas.org/atencao-nota-fiscal-paulista/</a> <br><br>
						Atenciosamente,<br>
						Equipe GAAR<br><br>
						****Este e-mail foi enviado automaticamente pelo nosso sistema****";
						
			$subject = "Resposta do contato feito pelo site do GAAR. Assunto: ".$assunto_ctt."";
		
		}
		if ($assunto_ctt == "Eventos" || $assunto_ctt == "Parceria" ){
			
			/*$to = "captacao@gaarcampinas.org";*/
			
			$to = $email_ctt;
				
			$headers = "MIME-Version: 1.0\n";               
			$headers .= "Content-type: text/html; charset=utf-8\n";            
			$headers .= "From: <{$from}> \r\n";  
			$headers .= "Reply-To: <{$to}> \r\n";  
			$headers .= "Bcc: captacao@gaarcampinas.org \r\n";
			
			$message = "Olá ".$nome_ctt." !<br><br>
			
						Recebemos o seu contato!  <br><br>
						Assunto: <br>
						".$assunto_ctt." <br><br>
						Mensagem:<br> 
						".$msg_ctt." <br><br>
						Em breve retornaremos :)<br><br>
						Atenciosamente,<br>
						Equipe GAAR<br><br>	
						****Este e-mail foi enviado automaticamente pelo nosso sistema****";
			
			$subject = "Resposta do contato feito pelo site do GAAR. Assunto: ".$assunto_ctt."";
		}
		
		if ($assunto_ctt == "Lar temporário"){
			
			/*$to = "captacao@gaarcampinas.org";*/
			
			$to = $email_ctt;
				
			$headers = "MIME-Version: 1.0\n";               
			$headers .= "Content-type: text/html; charset=utf-8\n";            
			$headers .= "From: <{$from}> \r\n";  
			$headers .= "Reply-To: <{$to}> \r\n";  
			$headers .= "Bcc: soniarpequeno@gmail.com,menzingrid@yahoo.com.br \r\n";
			
			$message = "Olá ".$nome_ctt." !<br><br>
			
						Recebemos o seu contato!  <br><br>
						Assunto: <br>
						".$assunto_ctt." <br><br>
						Mensagem:<br> 
						".$msg_ctt." <br><br>
						Em breve retornaremos :)<br><br>
						Atenciosamente,<br>
						Equipe GAAR<br><br>	
						****Este e-mail foi enviado automaticamente pelo nosso sistema****";
			
			$subject = "Resposta do contato feito pelo site do GAAR. Assunto: ".$assunto_ctt."";
		}
		
		if ($assunto_ctt == "Castração"){
			
			/*$to = "operacional@gaarcampinas.org";*/
			
			$to = $email_ctt;
			
			$headers = "MIME-Version: 1.0\n";               
			$headers .= "Content-type: text/html; charset=utf-8\n";            
			$headers .= "From: <{$from}> \r\n"; 
			$headers .= "Reply-To: <{$to}> \r\n";   
			
			$message = "Olá ".$nome_ctt." !<br><br>
			
						Parabéns pelo interesse em castrar seu(s) animal(s). <br><br>

						A idade recomendada para castrar é a partir de 5 meses. <br><br>
						 
						O GAAR não realiza castrações, apenas indica veterinários. <br><br>
						
						Divulgamos mutirões de castração com valor bem acessível + 1 kg de ração de boa qualidade (envie whatsapp para o projeto Cãosciência Pet (19) 99902-6211 para saber quando será o próximo. Esses números não atendem ligação, só whatsapp. Conhecemos e sabemos que fazem um trabalho sério. <br><br>				 
						
						Mas leia as informações abaixo, em especial as observações no final. <br><br> 					
						  						
						Há veterinárias solidárias que castram a preço acessível (Gatos por volta de R$ 100/ R$150. Cães até 10 Kg por volta de R$ 150 a R$ 180 - cães maiores, idosos, ou de determinadas raças podem custar mais em decorrência do anestésico). <br><br>
						
						Consulte os veterinários parceiros no site: <a href='http://gaarcampinas.org/veterinarios-parceiros/'>http://gaarcampinas.org/veterinarios-parceiros/ </a><br><br>					
						 
						
						E atenção para observações abaixo, inclusive no mutirão: <br><br>	
												
						- Alguns veterinários exigem exames de sangue pré-operatórios e há os que prescrevem antibiótico pós-operatório. Ao consultar o preço, informe-se sobre eventiuais custos adicionais. <br>
						
						- Roupinha cirúrgica não é necessário comprar, é possível improvisar uma com camiseta, no youtube há vídeos orientanco com fazer) <br><br>	
									
						O DPBEA, Departamento de Proteção e Bem Estar Animal da Prefeitura de Campinas realiza mutirões de castração gratuitos periódicos mediante agendamento prévio. Informações pelo fone 156 ou <a href='https://cidadao.campinas.sp.gov.br/'>https://cidadao.campinas.sp.gov.br/</a> <br><br>	
						
						A procura é grande e nem sempre se recebe retorno tão rápido, podendo a espera passar de a 1 ano. <br><br>	
							
						Qualquer dificuldade ou dúvida nos escreva novamente, mas não deixe de castrar seu animal na idade recomendada. <br><br>	
							 
						Se puder nos dar retorno, agradecemos.<br><br>
						
						Atenciosamente,<br>
						Equipe GAAR<br><br>
						
						****Este e-mail foi enviado automaticamente pelo nosso sistema****";
			
			$subject = "Resposta do contato feito pelo site do GAAR. Assunto: ".$assunto_ctt."";
		}
		
		if ($assunto_ctt == "Feiras de adoção"){
			
			/*$to = "operacional@gaarcampinas.org";*/
			
			$to = $email_ctt;
			
			$headers = "MIME-Version: 1.0\n";               
			$headers .= "Content-type: text/html; charset=utf-8\n";            
			$headers .= "From: <{$from}> \r\n"; 
			$headers .= "Reply-To: <{$to}> \r\n";   
			
			$message = "Olá ".$nome_ctt." !<br><br>
			
						Para visualizar o calendário completo de feiras de adoção, acesse: <a href='http://gaarcampinas.org/feiras-de-adocao/'>http://gaarcampinas.org/feiras-de-adocao/</a> <br><br>
						Atenciosamente,<br>
						Equipe GAAR<br><br>
						
						****Este e-mail foi enviado automaticamente pelo nosso sistema****";
			
			$subject = "Resposta do contato feito pelo site do GAAR. Assunto: ".$assunto_ctt."";
		}
		
		if ($assunto_ctt == "Divulgar" || $assunto_ctt == "Perdi"){
			
			/*$to = "operacional@gaarcampinas.org";*/
			
			$to = $email_ctt;
			
			$headers = "MIME-Version: 1.0\n";               
			$headers .= "Content-type: text/html; charset=utf-8\n";            
			$headers .= "From: <{$from}> \r\n"; 
			$headers .= "Reply-To: <{$to}> \r\n";   
			/*$headers .= "Bcc: thaise.piculi@gmail.com \r\n"; */
			
			$message = "Olá ".$nome_ctt." !<br><br>
			
						O GAAR abre espaço em suas redes sociais para anúncios de animais para doação, perdido ou encontrado de quem, como nós, vivencia o dia-a-dia da causa animal. Esse espaço é seu, mas deve ser usado com responsabilidade. Se você pretende anunciar um animal para DOAÇÃO, PERDIDO ou ENCONTRADO, verifique condições e instruções abaixo: <br><br>		 
		
						<b> CONDIÇÕES </b><br><br>
						1- O GAAR não se responsabiliza pelas informações contidas em anúncios de terceiros. Toda informação fornecida é de responsabilidade do anunciante. <br>					
						 
						
						2- Ao anunciar nas redes sociais do GAAR a pessoa se compromete a dar retorno sobre o status do anúncio: se o animal já foi doado, encontrado etc. Esse retorno é muito importante para atualização do caso. <br>
						
						 
						
						3- O GAAR se reserva no direito de publicar ou não os anúncios enviados. Todo conteúdo enviado será analisado e checado antes de serem publicados. <br>
						
						 
						
						4- O GAAR prioriza anúncios de animais resgatados, todos precisam estar vacinados e castrados (acima de 5 meses) que precisam ser encaminhados para um lar. <br>
		
		 
		
						5- O GAAR só publica anúncios de animais da região de Campinas/SP. <br><br>
						
						Para cadastrar seu anúncio, <a href='http://gaarcampinas.org/quero-anunciar/'> clique aqui. </a><br><br>
						
						Atenciosamente,<br>
						Equipe GAAR<br><br>
						
						****Este e-mail foi enviado automaticamente pelo nosso sistema****";
			
			$subject = "Resposta do contato feito pelo site do GAAR";
		}
		if ($assunto_ctt == "Voluntario"){
			
			/*$to = "operacional@gaarcampinas.org";*/
			
			$to = $email_ctt;
			
			$headers = "MIME-Version: 1.0\n";               
			$headers .= "Content-type: text/html; charset=utf-8\n";            
			$headers .= "From: <{$from}> \r\n"; 
			$headers .= "Reply-To: <{$to}> \r\n";   
			$headers .= "Bcc: captacao@gaarcampinas.org \r\n"; 
			
			$message = "Olá ".$nome_ctt." !<br><br>
			
						Ficamos muito felizes pelo seu interesse em ser voluntário de nossa ONG! <br><br>
						
						Pedimos que, por gentileza, cadastra-se em <a href='http://gaarcampinas.org/voluntarios.php'> Seja voluntário </a> que em breve retornaremos o contato!<br><br>
						
						Atenciosamente,<br>
						Equipe GAAR<br><br>
						
						****Este e-mail foi enviado automaticamente pelo nosso sistema****";
			
			$subject = "Resposta do contato feito pelo site do GAAR. Assunto: ".$assunto_ctt."";
		}
		
		if ($assunto_ctt == "Outros"){
			
			$from = $email_ctt;
			
			$to = "contato@gaarcampinas.org";
			
			$headers = "MIME-Version: 1.0\n";               
			$headers .= "Content-type: text/html; charset=utf-8\n";            
			$headers .= "From: <{$from}> \r\n"; 
			$headers .= "Reply-To: <{$from}> \r\n";   
			
			$message = $msg_ctt;
			
			$subject = "Contato feito pelo site. Assunto: ".$assunto_ctt."";
		}
		
		if ($assunto_ctt == "Doar itens"){
			
			$from = $email_ctt;
			
			$to = "captacao@gaarcampinas.org";
			
			$headers = "MIME-Version: 1.0\n";               
			$headers .= "Content-type: text/html; charset=utf-8\n";            
			$headers .= "From: <{$from}> \r\n"; 
			$headers .= "Reply-To: <{$from}> \r\n";   
			
			$message = $msg_ctt;
			
			$subject = "Contato feito pelo site. Assunto: ".$assunto_ctt."";
		}
		
		mail($to, $subject, $message, $headers);

	}
?>