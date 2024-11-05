<?php 

session_start();

include ("conexao.php"); 

//require_once('/home1/gaarca06/public_html/area/vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$login = $_SESSION['login'];

/*
$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional

*/

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode 

$log_file_msg="[cadastrotermo.php] Logou às ".$horaatu."\n";
$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg); 


if($login == "" || $login == null){
        echo"<script language='javascript' type='text/javascript'>
        alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
        	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
        
        $adotante = strtoupper($_POST['adotante']);
        $rg = $_POST['rg'];
        $cpf = $_POST['cpf'];
        $endereco = $_POST['endereco'];
        $complemento = $_POST['complemento'];
        $numero = $_POST['numero'];
        $estado = $_POST['estado'];
        $bairro = $_POST['bairro'];
        $cep = $_POST['cep'];
        $cidade = strtoupper($_POST['cidade']);
        $pontoref = $_POST['pontoref'];
        $telfixo = $_POST['telfixo'];
        $celular = $_POST['celular'];
        $email = strtolower ($_POST['email']);
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $profissao = $_POST['profissao'];
        $idanimal = $_POST['idanimal'];
        $especie = $_POST['especie'];
        $idade = $_POST['idade'];
        $sexo = $_POST['sexo'];
        $cor = $_POST['cor'];
        $porte = $_POST['porte'];
        $castrado = $_POST['castrado'];
        $dtcastracao = $_POST['dtcastracao'];
        $vermifug = $_POST['vermifugado'];
        $vacinado = $_POST['vacinado'];
        $doses = $_POST['doses'];
        $possuianimal = $_POST['possuianimal'];
        $sesimcastrados = $_POST['sesimcastrados'];
        $teldoador = $_POST['teldoador'];
        $emaildoador = strtolower ($_POST['emaildoador']);
        $lt = $_POST['lt'];
        $termopor = $_POST['termopor'];
        $dtadocao = $_POST['dtadocao'];
        $localadocao = $_POST['localadocao'];
        $dtposadocao = '0001-01-01';
        $posadocaopor = '';
        $obs = '';
        $status = '';
        $usuario = $_SESSION['login'];
        $pgtotaxa = $_POST['pgtotaxa'];
        $obstaxa = $_POST['obstaxa'];
        $uploaddir = '/home/gaarca06/private/docs/termos/';
        $uploadfile = $uploaddir.($_FILES['foto']['name']);
        $nome_foto = $_FILES['foto']['name'];
        $autorizaimagem=$_POST['autorizaimagem'];
        
        $uploaddir_ad = '/home/gaarca06/public_html/docs/adotantes/';
        $uploadfile_ad = $uploaddir_ad.($_FILES['fotoad']['name']);
        $nome_fotoad = $_FILES['fotoad']['name'];
        
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
            
            <title>GAAR - Termo de adoção</title>
            
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
        				  
        			  }
        ?>
        <main role="main" class="container">
            <div class="starter-template">
                <br>
        <?
        
        
        $querytermo = "SELECT * FROM TERMO_ADOCAO where CPF = '$cpf' and ID_ANIMAL='$idanimal'";
        $selecttermo = mysqli_query($connect,$querytermo);
        $reccounttermo = mysqli_num_rows($selecttermo);
        
        $querypet= "SELECT NOME_ANIMAL,ESPECIE,IDADE FROM ANIMAL WHERE ID='$idanimal' ";
        $selectpet = mysqli_query($connect,$querypet);
            
        while ($fetchpet = mysqli_fetch_row($selectpet)) {
            $nomeanimal = $fetchpet[0];
            $especie = $fetchpet[1];
            $idadepet= $fetchpet[2];
            
            $ano_idade = substr($idade,0,4);
            $mes_idade = substr($idade,5,2);
            $dia_idade = substr($idade,8,2);
            
            $data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);
            $idade_jul = gregoriantojd($mes_idade,$dia_idade,$ano_idade);
            
            $diff_idade = intval($data_atu_jul) - intval($idade_jul) ;
        }
        
        if ($reccounttermo != '0' ) {
                  echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                  echo "<p>Já existe um termo para ".$nomeanimal."</p><br>";
                  echo "<a href='formprecadastrotermo.php' class='btn btn-primary'>Voltar</a></center><br>";
                }
        else {
        
            
            
        /*	if($logarray == $adotante){
        		 
                echo"<script language='javascript' type='text/javascript'>
                alert('Adotante já cadastrado');window.location.href='termo.php';</script>";
                die();
         
        		} 
        	  else{*/
        	  
        	    move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
        	    move_uploaded_file($_FILES['fotoad']['tmp_name'], $uploadfile_ad);
        	  
        	    if ($dtcastracao == ''){
        	        $dtcastracao = '0001-01-01';
        	    }
        	    
        	    switch ($pgtotaxa){
        	        case 'Sem taxa':
        	            $taxa = '0';
        	            $obstaxa = 'Sem taxa';
        	            break;
        	            
        	       case '':
        	            $taxa = '50';
        	            break;
        	            
        	        default:
        	            $taxa = '50';
        	            $obstaxa = '';
        	            break;
        	    }
        	    
        	    if ($autorizaimagem == '') {
        	        $autorizaimagem = 'Sim';
        	    }
                
                $query = "INSERT INTO TERMO_ADOCAO 
                        (ADOTANTE,
                        RG,
                        CPF,
                        ENDERECO,
                        BAIRRO,
                        CEP,
                        CIDADE,
                        PONTO_REF,
                        TEL_FIXO,
                        TEL_CEL,
                        EMAIL,
                        FACEBOOK,
                        INSTAGRAM,
                        PROFISSAO,
                        NOME_ANIMAL,
                        ESPECIE,
                        IDADE,
                        SEXO,
                        COR,
                        PORTE,
                        CASTRADO,
                        DATA_CASTRACAO,
                        VERMIFUGADO,
                        VACINADO,
                        DOSES,
                        POSSUI_ANIMAIS,
                        POSSUI_ANIMAIS_CASTRADOS,
                        TEL_DOADOR,
                        EMAIL_DOADOR,
                        LAR_TEMPORARIO,
                        TERMO_PREENCHIDO_POR,
                        DATA_ADOCAO,
                        LOCAL_ADOCAO,
                        POS_ADOCAO,
                        POS_ADOCAO_POR,
                        OBS,
                        STATUS_POS,
                        USUARIO,
                        PGTO_TAXA,
                        OBS_TAXA,
                        TAXA,
                        NUMERO,
                        ESTADO,
                        COMPLEMENTO,
                        FOTO,
                        FOTO_ADOTANTE,
                        REPROVADO,
                        AUTORIZA_IMAGEM,
                        ID_ANIMAL) 
                        VALUES 
                        ('$adotante',
                        '$rg',
                        '$cpf',
                        '$endereco',
                        '$bairro',
                        '$cep',
                        '$cidade',
                        '$pontoref',
                        '$telfixo',
                        '$celular',
                        '$email',
                        '$facebook',
                        '$instagram',
                        '$profissao',
                        '$nomeanimal',
                        '$especie',
                        '$idade',
                        '$sexo',
                        '$cor',
                        '$porte',
                        '$castrado',
                        '$dtcastracao',
                        '$vermifug',
                        '$vacinado',
                        '$doses',
                        '$possuianimal',
                        '$sesimcastrados',
                        '$teldoador',
                        '$emaildoador',
                        '$lt',
                        '$termopor',
                        '$dtadocao',
                        '$localadocao',
                        '$dtposadocao',
                        '0',
                        '0',
                        '0',
                        '$usuario',
                        '$pgtotaxa',
                        '$obstaxa',
                        '$taxa',
                        '$numero',
                        '$estado',
                        '$complemento',
                        '$nome_foto',
                        '$nome_fotoad',
                        '0',
                        '$autorizaimagem',
                        '$idanimal') ";
        						
                $insert = mysqli_query($connect,$query); 	
        		
        		if(mysqli_errno($connect) == '0'){
                    
        		    $getid = "SELECT ID FROM TERMO_ADOCAO WHERE ADOTANTE = '$adotante' AND RG = '$rg' AND CPF = '$cpf' AND NOME_ANIMAL = '$nomeanimal' AND ESPECIE = '$especie' ";
        			$id = mysqli_query($connect,$getid); 
        			$fetch = mysqli_fetch_row($id);
        			
        			$log_file_msg="[cadastrotermo.php] Termo cadastrado - ID ".$fetch[0]." - animal ".$nomeanimal." ID ".$idanimal." às ".$horaatu."\n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg);  
        			
        		    echo"<script language='javascript' type='text/javascript'>
                     alert('Termo cadastrado com sucesso! Número: '+".$fetch[0].");
        			 window.location.href='formprecadastrotermo.php'</script>";
        			 
        			 $sqlupdate = "UPDATE ANIMAL 
        		            SET ADOTADO = 'Adotado',
        		            DATA_SAIDA_LT ='$dtadocao',
        		            DOSES='$doses',
        		            DATA_CASTRACAO='$dtcastracao',
        		            TERMO_ADOCAO='Sim'
                            WHERE ID ='$idanimal'";
        					
        		    $update = mysqli_query($connect,$sqlupdate); 	
        		    
        		    if(mysqli_errno($connect) == '0'){
            		    $log_file_msg="[cadastrotermo.php] Status do animal ".$nomeanimal." ID ".$idanimal." atualizado para Adotado às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);  
                        
                        $sqldelete = "DELETE FROM ANIMAIS_FEIRAS WHERE ID_ANIMAL ='$idanimal'";
        		        $delete = mysqli_query($connect,$sqldelete); 
        		        
        		        if(mysqli_errno($connect) == '0'){
        		            $log_file_msg="[cadastrotermo.php] Animal ".$nomeanimal." - ID ".$idanimal." deletado da tabela ANIMAIS_FEIRA às ".$horaatu."\n";
                            $fp = fopen($log_file, 'a');//opens file in append mode  
                            fwrite($fp, $log_file_msg);   
        		        } else {
        		            $log_file_msg="[cadastrotermo.php] Erro ao deletar animal ".$nomeanimal." - ID ".$idanimal." da tabela ANIMAIS_FEIRA: Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
                            $fp = fopen($log_file, 'a');//opens file in append mode  
                            fwrite($fp, $log_file_msg);  
        		        }
        		        
        		        $sqldeletepost = "DELETE FROM ANIMAIS_REDES WHERE ID_ANIMAL ='$idanimal' AND DIA_POST >='$data_atu'";
        		        $deletepost = mysqli_query($connect,$sqldeletepost); 
        		        
        		        if(mysqli_errno($connect) == '0'){
        		            $log_file_msg="[cadastrotermo.php] Animal ".$nomeanimal." - ID ".$idanimal." deletado da tabela ANIMAIS_REDES às ".$horaatu."\n";
                            $fp = fopen($log_file, 'a');//opens file in append mode  
                            fwrite($fp, $log_file_msg);   
        		        } else {
        		            $log_file_msg="[cadastrotermo.php] Erro ao deletar animal ".$nomeanimal." - ID ".$idanimal." da tabela ANIMAIS_REDES: Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
                            $fp = fopen($log_file, 'a');//opens file in append mode  
                            fwrite($fp, $log_file_msg);  
        		        }
        		        
        		    } else {
        		        $log_file_msg="[cadastrotermo.php] Erro ao atualizado o status do animal ".$nomeanimal." - ID ".$idanimal." Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg); 
        		    }
        		    
        		    $getsocio = "SELECT EMAIL FROM SOCIO WHERE ID_ANIMAL = '$idanimal'";
        			$socio = mysqli_query($connect,$getsocio); 
        			$fetchsocio = mysqli_fetch_row($socio);
        		    
                    $mail = new PHPMailer();
                    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
                    $mail->SMTPAuth = true; // authentication enabled
                    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                    $mail->Debugoutput = 'html';
                    $mail->CharSet = 'UTF-8';
                    $mail->IsHTML(true);
                    $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
                    
                    /* EMAIL DE NOTIFICACAO AO PADRINHO/MADRINHA */
                    
                    
            		$to = $fetchsocio[0];
                    $mail->AddAddress($to);
                    
            		$subject = "[GAAR Campinas] Seu afilhado foi adotado";
            		
            		$bodytext = "Olá, <br><br> Gostaríamos de anunciar que o seu afilhado ".$nomeanimal." foi adotado!! <br><br> Agradecemos muito a sua colaboração durante todo o tempo em que ele ficou sob nossos cuidados, com certeza sua ajuda foi de grande valia. <br><br> Caso queira apadrinhar outro animal, acesse nosso site. <br><br> Atenciosamente, <br>Equipe GAAR";
            		
            		$mail->Subject   = $subject;
                    $mail->Body      = $bodytext;
                    
                    if (!$mail->send()) {
                        $log_file_msg ="[cadastrotermo.php] Erro no envio de notificação ao padrinho ou madrinha ".$to.": ".$mail->ErrorInfo." às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);  
                    } else {
                        $log_file_msg ="[cadastrotermo.php] Envio de notificação ao padrinho ou madrinha ".$to." às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);  
                    }
                    
                    $mail->clearAddresses();
        		
            		if(mysqli_errno($connect) != '0'){
            		    
            		            $mensagem = "Falha no update do animal ".$nomeanimal." - Página cadastrotermo.php<br> <p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
            		            
                        		$from = "contato@gaarcampinas.org";
                        		
                        		$to = "thaise.piculi@gmail.com";
                        		
                        		$subject = "Falha no update do animal ".$nomeanimal."";
                        
                        		$message = $mensagem ;
                        		
                        		mail($to, $subject, $message, $headers);
            		} 
            		/* EMAIL DE PARA O ADOTANTE */
            		
            		$to = $email;
                    $mail->AddAddress($to);
                    
            		$subject = "[GAAR Campinas] Cópia virtual do termo de adoção de ".$nomeanimal."";
            		
            		$bodytext = "Olá, ".$adotante." 
            		
            		            Ficamos muito felizes por você ter adotado um animal com o GAAR. Segue abaixo algumas dicas e a cópia virtual do seu termo de adoção para armazenamento, esse termo não substitui o termo físico quando for levar o animal em alguma clínica veterinária conveniada para ter desconto. Estamos enviando também algumas dicas que podem te ajudar na adaptação :)
            		            
            		            Sabe aquelas compras do dia a dia para seu pet? Você pode programá-las gratuitamente, receber em qualquer lugar do Brasil, ter liberdade total para alterar datas e produtos e ainda ganhar 10% OFF sempre! Sem taxas de adesão ou cancelamento, é assim que funciona a Assinatura GAAR Campinas em parceria com a Petlove - o maior petshop online do Brasil. 
        
                                O mais legal de tudo é que 10% do valor de suas compras (exceto frete) é doado ao GAAR em dinheiro. 
                                
                                Seja um novo assinante ou migre sua assinatura existente, garanta os melhores produtos para seu melhor amigo e ajude a garantir alimentação e cuidados para os animais assistidos pela ONG. 
                                
                                Veja como é fácil:
                                
                                1. Acesse https://gaarcampinas.petlove.com.br/
                                2. Clique no menu Assinatura e logo depois Criar assinatura 
                                3. Faça seu login, ou caso não tenha crie uma conta 
                                4. Adicione os produtos que deseja receber 
                                5. Escolha a data da primeira entrega e o intervalo entre as entregas 
                                6. Confira os dados de pagamento e entrega
                                
                                Promoção exclusiva para novos Assinantes. Desconto + Cashback de até R$ 100,00 aplicado diretamente no carrinho de compras, na criação da primeira Assinatura
                                
                                E pronto! Você receberá os produtos escolhidos na frequência escolhida :) 
                                
                                Já é assinante? Migre a sua assinatura para o GAAR, os benefícios e produtos serão mantidos. Veja como: 
                                
                                1. Acesse https://gaarcampinas.petlove.com.br/ 
                                2. Faça seu login, ou caso não tenha crie uma conta 
                                3. Clique no menu Assinatura e logo depois Minhas assinaturas 
                                4. Escolha a assinatura que deseja migrar e clique em Ver detalhes 
                                5. Clique em Migrar assinatura e confirme 
                                
                                Caso não queira ser assinante, não tem problema. Toda compra que for realizada em nossa lojinha vai ter os 10% do valor doado à ONG ;) 
                    
                                ⚠️ Utilize o cupom BOASVINDAS para sua primeira compra e aproveite os melhores produtos selecionados para deixar seu amigo mais feliz e saudável! Desconto aplicado direto no carrinho apenas para a primeira compra por CPF/usuário.
    ";          
            		$mail->Subject   = $subject;
                    $mail->Body      = $bodytext;
                    
                    if (!$mail->send()) {
                        $log_file_msg ="[cadastrotermo.php] Erro no envio de notificação ao adotante ".$to.": ".$mail->ErrorInfo." às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);  
                    } else {
                        $log_file_msg ="[cadastrotermo.php] Envio de notificação ao adotante ".$to." às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);  
                    }
                    
                    $mail->clearAddresses();
                    
            	    /*switch ($especie){
            	        case 'Canina':
            	            $mensagem .= "DICAS
                                          1. Castração: é o item no 1! > Castre a fêmea e o macho entre 5 e 6 meses de idade para que eles fiquem mais caseiros e saudáveis.
                                            A fêmea deve ser castrada não só para evitar filhotes, mas também para prevenir piometra (infecção uterina), câncer e doenças de transmissão venérea, como o TVT (Tumor Venéreo Transmissível) que ocorrem nos órgãos genitais e até no focinho, pois é causada por vírus. 
                                            No macho o mais importante é a prevenção de câncer de próstata e também o TVT. O macho deve ser castrado para evitar fugas pela ansiedade de sentir o odor de fêmeas no cio de até 2 km de distância. Também evita que ele tenha o péssimo hábito de perturbar as pernas das visitas e urinar em todos os cantos da casa para demarcar território. 
                                            2. Ao adotar, coloque uma plaquinha ou escreva o nome e telefone na coleira,> caso o cão recém-adotado escape, pois no início ainda não considera como sua a nova casa. 
                                            3. Alimentação: dê ração de boa qualidade (tipo Premium ou superior) duas vezes ao dia,> lembre – se que ração barata não tem proteína suficiente, ou a origem a proteína é péssima, e em pouco tempo seu lindo cão estará magro, triste e com a pelagem opaca. Dê ração de filhotes até os 9 meses de idade, a vontade.  Nunca compre a granel, de sacos abertos, prefira rações com embalagem do fabricante com a data de fabricação. Deixe vários potes de água disponíveis, limpos e com água fresca.
                                            4. >Se o cão fizer buracos na terra jogue as fezes dele dentro de cada buraco e tampe. 
                                            5. >Coloque telas nas janelas do apartamento. 
                                            6. >Vacine anualmente contra CINOMOSE, HEPATITE, PARVOVIROSE, PARAINFLUENZA, TRAQUEOBRONQUITE, CORONAVIROSE, LEPTOSPIROSES e Raiva. Só dê vacina em veterinários e nunca em casa de ração. Estas últimas não protegem seu animal adequadamente. 
                                            7. >Vermifugue adultos 2 vezes ao ano. Filhotes, pelo menos 3 vezes com intervalo de 10-15 dias. 
                                            8. >Se parar de comer leve imediatamente ao seu veterinário preferido. Não automedique. 
                                            9. >Dê brinquedos, cenouras ou ossos defumados para roer. 
                                            10. Tenha paciência com a animação dos filhotes, >a fase das mordidas diminui após a troca de dentes que ocorre dos 4 aos 6 meses! 
                                            
                                            Dra Ingrid Menz CRMV-SP 1569 - veterinária voluntária da ONG
                                            
                                            ";
            	            break;
            	            
            	        case 'Felina':
            	            $mensagem .= "DICAS
                                          1. Castração: é o item no 1! Castre a fêmea e o macho entre 5 e 6 meses de idade para que eles fiquem mais caseiros e saudáveis.
                                            A fêmea deve ser castrada não só para evitar filhotes, mas também para prevenir piometra (infecção uterina), câncer e várias doenças. 
                                            O macho deve ser castrado para evitar miados e namoros no telhado, não deixando ninguém dormir; para não ser arranhado e mordido por outros gatos; não infectar-se com doenças infecciosas graves, como a leucemia (FeLV) e a imunodeficiência felinas (FIV), transmitida pela saliva de gatos doentes.
                                            2. Ao adotar, deixe o gato novo em quarto fechado por 1 semana para se adaptar aos novos odores, sons, pessoas.> Será seu refúgio em caso de perigo. Depois vá soltando lentamente pela casa. Evite deixá-lo na rua/telhados/casa do vizinho, é uma questão de tempo e o gatinho vai sumir, sofre acidente ou ser eliminado por um cão ou humano. 
                                            3. Alimentação: dê ração de boa qualidade (tipo Premium ou superior) para evitar futura insuficiência renal. Dê ração de filhotes até os 9 meses de idade. Dê alimento úmido  (sachê ou carne/peixe) de vez em quando. 
                                            4. Banheiro: coloque areia sanitária (inúmeras marcas) em caixa plástica de altura condizente com o tamanho do gato. Adultos precisam de caixas mais altas para não derramar areia para fora enquanto “enterram” suas necessidades. Gatos não precisam ser treinados, eles já fazem tudo certinho. 
                                                NÃO deixe a caixa-banheiro próximo da água e da comida. Limpe a caixa de areia duas vezes ao dia, pelo menos. Eles detestam banheiro sujo.
                                            5. Coloque telas em todas as janelas de todo apartamento, inclusive as do banheiro. >Gatos podem se distrair com um passarinho ou inseto e cair. Geralmente morrem. Sobreviver é exceção.
                                            6. Coloque coleirinha para que os vizinhos saibam que este gato tem dono.
                                            7. Vacine anualmente contra Panleucopenia (Parvovirose do gato), Calicivirose,  Rinotraqueíte, Clamidiose, Leucemia Felina e Raiva. Só dê vacina em veterinários e nunca em casa de ração. Estas últimas não protegem seu animal adequadamente.
                                            8. Vermifugue adultos 2 vezes ao ano. Filhotes, pelo menos 2 vezes com, intervalo de 10-15 dias. 
                                            9. Corte a pontinha das unhas a cada 15-20 dias.
                                            10. Se parar de comer leve imediatamente ao seu veterinário preferido.
                                            11. Dê brinquedos, bolinhas de papel, tapete de sisal ou capachos, arranhadores... eles adoram.
                                            12. Tenha paciência com a animação dos filhotes! Você vai curtir muito!
                                            LEMBRE-SE: TER UM GATO FAZ VOCE TER SORTE, SER FELIZ E RENOVA SUAS ENERGIAS E O BOM HUMOR. 
                                            
                                            Dra Ingrid Menz CRMV-SP 1569 - veterinária voluntária da ONG
                                            
                                            ";
            	            break;
            	            
            	    }*/
            		             
            		$bodytext .= "O manual do adotante, a cópia digital do termo de adoção e a foto estão em anexo caso tenham sido carregadas em nosso sistema.";
                                
                    //$bodytext = $mensagem;
        
                    $mail->Subject   = $subject;
                    $mail->Body      = $bodytext;
                    $to = $emaildoador;
                    $mail->AddAddress($to);
                    $mail->AddBCC('thaise.piculi@gmail.com');
                    
                                
                                            /*echo "<H2>CONCURSO CALENDÁRIO DO GAAR 2021</H2>
                                                    <p> <br>
                                                Você acha que o seu animalzinho de estimação é o mais lindo do mundo? Então chegou a hora de compartilhar toda essa belezura com a gente e ainda ajudar a bicharada do GAAR! <br><br>
                                     
                                                Todo ano nós preparamos um calendário para ser vendido a fim de custear despesas com lares temporários, castrações, medicamentos, ração etc. E para oferecer um produto de qualidade e de acordo com o trabalho que realizamos, precisamos de boas fotos de modelos caninos ou felinos adotados, de preferência sem raça definida. <br><br>
                                                
                                                <strong>ATENÇÃO PARA ESTAS ORIENTAÇÕES:</strong> <br>
                                                
                                                - Fotos em poses naturais, sem artificialismos (sem adereços humanos, por exemplo), de cães e/ou gatos resgatados de abandono ou maus tratos, seja diretamente pelo adotante, seja por um terceiro ou por uma ONG.<br>
                                                
                                                - Não poderão ser enviadas fotos sem autoria conhecida. No caso de foto cuja autoria seja de terceiro, a responsabilidade jurídica pelo uso da foto é de quem enviá-la. <br>
                                                
                                                - Não poderá haver rosto humano na foto. <br>
                                                
                                                - Cada adotante poderá inscrever no máximo 1 (uma) fotografia digital de cada animal adotado, sozinho ou na companhia de outros animais. Foto em qualidade máxima. <br>
                                                
                                                - <font color='red'><strong>As inscrições vão até 31/07/2020 <br></strong></font>
                                                
                                                - <strong>NÃO HÁ LIMITE DE VOTOS</strong>. A votação é aberta para todos e você pode votar quantas vezes quiser mas temos algumas regrinhas: cada e-mail poderá votar apenas uma vez no dia em um único candidato, portanto você poderá votar em vários candidatos em um dia :) <br><br> 
                                                        
                                                Para quem prefere especificação técnica: fotos com resolução mínima de 1.6 Megapixels (tamanho de aprox 1536×1024 pixels e arquivo de ao menos 1.5Mb) <br><br>
                                                
                                                <a href='http://gaarcampinas.org/concursocalendario.php' target='_blank>Clica aqui e inscreva seu pet</a>";*/
            
            		$file_to_attach = '/home1/gaarca06/private/docs/termos/'.$nome_foto;
        
                    $mail->addAttachment($file_to_attach, 'Termo digital');
                    
                    $file_to_attach2 = '/home1/gaarca06/public_html/docs/adotantes/'.$nome_fotoad;
                    
                    $mail->addAttachment($file_to_attach2, 'Foto adocao');
                    
                    $file_to_attach3 = 'https://gaarcampinas.org/wp-content/uploads/2022/11/Manual-de-adocao-1.pdf';
                    
                    $mail->addAttachment($file_to_attach3, 'Manual do adotante');
                    
                    if ($diff_idade <= '365'){
                        $file_to_attach4 = '/home/gaarca06/public_html/docs/operacional/adocao_de_filhote_marco_23.docx';
                        $mail->addAttachment($file_to_attach4, 'Manual do filhote');
                    }

                    if (!$mail->send()) {
                        $log_file_msg ="[cadastrotermo.php] Erro no envio de notificação ao responsável ".$to.": ".$mail->ErrorInfo." às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);  
                    } else {
                        $log_file_msg ="[cadastrotermo.php] Envio de notificação ao responsável ".$to." às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);  
                    }
                    
                    $mail->clearAddresses();
            	
            		
                }else{
        	        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                    echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                    echo "<a href='formprecadastrotermo.php' class='btn btn-primary'>Voltar</a></center><br>";
                  /*echo"<script language='javascript' type='text/javascript'>
                  alert('Erro ao cadastrar');window.location
                  .href='formprecadastrotermo.php'</script>";*/
                
        	    }
        	   
        					  
        		
        	  }
        
        }
mysqli_close($connect);

fclose($fp); 

?>
   </div>
</main>
<footer>
    <center>GAAR - GRUPO DE APOIO AO ANIMAL DE RUA</center>
</footer>

<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>