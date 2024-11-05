<?php

include ("conexao.php"); 

ini_set('display_errors', 1);
            
error_reporting(E_ALL);

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

/*$query = "SELECT * FROM TERMO_ADOCAO WHERE POS_ADOCAO = '0001-01-01' ";*/

$query = "SELECT * FROM TERMO_ADOCAO WHERE STATUS_POS = '0' AND REPROVADO <> 'Sim'";
$select = mysqli_query($connect,$query);
$reccount = mysqli_num_rows($select);

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");

$dtatu = date("Y-m-d");

$dtatu_format = date("d-m-Y");

$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);

$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('posadocao@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
$mail->IsHTML(true);
$log_file_msg = "";
$listamail = "";

while ($fetch = mysqli_fetch_row($select)) {
    
    $id = $fetch[0];
    $adotante = $fetch[1];
    $emailadotante = $fetch[11];
    $nomedoanimal = $fetch[15];
    $idade = $fetch[17];
    $dataadocao = $fetch[32];
    $castrado = $fetch[21];
    $dtcastracao = $fetch[22];
    $emailresp = $fetch[29];

    $queryresp = "SELECT NOME FROM VOLUNTARIOS WHERE EMAIL='$emailresp'";
    $selectresp = mysqli_query($connect,$queryresp);
    
    while ($fetchresp = mysqli_fetch_row($selectresp)) {
        $resp = $fetchresp [0];
    }
    
    if ($emailresp == '') {
        $emailresp = "operacional@gaarcampinas.org";
    }
    
    if($resp == ''){
        $resp = "GAAR Campinas";
    } 
    
    $ano_idade = substr($idade,0,4);
    $mes_idade = substr($idade,5,2);
    $dia_idade = substr($idade,8,2);
    
    $ano_castracao = substr($dtcastracao,0,4);
    $mes_castracao = substr($dtcastracao,5,2);
    $dia_castracao = substr($dtcastracao,8,2);
    
    $ano_adocao = substr($dataadocao,0,4);
    $mes_adocao = substr($dataadocao,5,2);
    $dia_adocao = substr($dataadocao,8,2);

    /* CONVERSAO DATA GREG TO JD */
    $idade_jul = gregoriantojd($mes_idade,$dia_idade,$ano_idade);
    
    $dtadocao_jul = gregoriantojd($mes_adocao,$dia_adocao,$ano_adocao);
    
    /* CALCULO DE DIAS */
  
    $idade = intval($data_atu_jul) - intval($idade_jul) ;
    
    $dtadocao = intval($data_atu_jul) - intval($dtadocao_jul) ;
    
    if ($dtadocao == '5') {
        
        if ($castrado =='Não') {
            
	        $bodytext = "<p>Olá ".$adotante.", <br><br>
	        
	                     Somos a equipe de pós adoção do GAAR, tudo bem?<br><br>
	                     
	                     Estamos entrando em contato para saber como foi a adaptação com a casa e a também com a sua família do seu novo amigo adotado através do GAAR. 
	                     
	                     Por favor, nos conte como foi essa nova experiência.<br><br>
	                     
	                     Gostaríamos de relembrá-lo de que, para seu bichinho ficar totalmente protegido contra doenças que matam, ele precisa ter concluído o ciclo de vacinação. 
	                     
	                     Não deixe de conferir na carteira de vacinação as datas das demais doses. 
	                     
	                     É muito importante realizar o procedimento na data descrita e repetir a vacina múltipla e a anti-rábica o resto da vida e sempre em clínicas veterinárias, pela segurança e qualidade das vacinas. 
	                     
	                     Se tiver alguma dúvida, entre em contato conosco ou com um veterinário de sua confiança.<br><br> A vermifugação pode ser semestral e você mesmo pode dar ao seu animal. <br><br>
	                     
	                     Seu animal está com a castração prevista para ".$dia_castracao."/".$mes_castracao."/".$ano_castracao.". Você poderá levá-lo em seu veterinário preferido ou optar por um dos conveniados do GAAR que têm longa experiência em castrar, acesse o site e veja a lista <a href='http://gaarcampinas.org/veterinarios-parceiros/' target='_blank'>aqui</a>. Caso opte por levar a algum veterinário conveniado, pedimos que por gentileza leve sua via do termo de adoção.<br><br>
	                     
	                     Para melhorarmos os nossos registros, gostaríamos de saber o nome do veterinário (a) que você pretende ou já realizou o procedimento cirúrgico da castração e as datas da vacinação. Lembrando que é um compromisso do Gaar acompanhar o animal até que todas as vacinas iniciais sejam aplicadas e a castração realizada.<br><br>
	                     
	                     Por favor, nos envie as seguintes informações: <br><br>
	                     
	                     Castração - Data:       /       /     <br>
                         1ª. dose da Vacina (Cães e Gato): (     ) Sim    (     ) Não - Data:       /       /             <br>
                         2ª. dose da Vacina (Cães e Gato): (     ) SIm    (     ) Não - Data:       /       /             <br>
                         3ª. dose da Vacina (Cães): (     ) SIm    (     ) Não - Data:       /       /             <br>
	                     
	                     Nossa ONG está sempre procurando novos profissionais parceiros para viabilizar a castração ao maior número possível de interessados e ter o registro de um profissional comprometido com a castração, ajudando a divulgar o seu trabalho. <br><br>
	                     
	                     Vamos adorar ter notícia de vocês, receber fotos e vídeos nos traz grande alegria. <br><br>
	                     
	                     Você pode encaminhar as fotos respondendo esse e-mail.<br> <br>
                        
                        Obrigada por adotar e dar um lar a quem já tanto sofreu. <br><br>
                        
                        <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
        
        } else {
            
            $bodytext = "<p>Olá ".$adotante.", <br><br>
        
                        Somos a equipe de pós adoção do GAAR, tudo bem?<br><br>
                        
                        Estamos entrando em contato para saber como foi a adaptação com a casa e a também com a sua família do seu novo amigo adotado através do GAAR. 
                        
                        Por favor, nos conte como foi essa nova experiência.<br><br>
                        
                        Buscamos sempre o bem estar do animal e também da sua família, caso tenha alguma dúvida, estamos à disposição. Não hesite em nos procurar.<br><br>
	                     
	                    Por favor, nos envie as seguintes informações para atualizar nossos controles: <br><br>
	                     
                        1ª. dose da Vacina (Cães e Gato): (     ) Sim    (     ) Não - Data:       /       /             <br>
                        2ª. dose da Vacina (Cães e Gato): (     ) Sim    (     ) Não - Data:       /       /             <br>
                        3ª. dose da Vacina (Cães): (     ) Sim    (     ) Não - Data:       /       /             <br>
                        
                        Consulte a carteira de vacinação e o termo que você assinou no momento da adoção para checar a data da vacinação , que é um item muito importante, pois seu bichinho só estará protegido se tomar as 3 doses das vacinas V8 ou V10 no 1º ano e o reforço anual com uma dose das vacinas V8 ou V10 a cada ano, preferencialmente importadas.
                        
                        <b>E essa vacina só deve ter dada por veterinário e nunca em casa da ração.</b><br><br> Você poderá levá-lo em seu veterinário preferido ou optar por um dos conveniados do GAAR que praticam preços acessíveis, acesse o site e veja a lista <a href='http://gaarcampinas.org/veterinarios-parceiros/' target='_blank'>aqui</a>. Caso opte por levar a algum veterinário conveniado, pedimos que por gentileza leve sua via do termo de adoção.<br><br>
                        
                        Lembrando que é um compromisso do Gaar acompanhar o animal até que todas as vacinas iniciais sejam aplicadas. <br><br>
                        
                        Vamos adorar ter noticia de vocês, receber fotos e vídeos nos traz grande alegria. Você pode encaminhar as fotos respondendo esse email.<br><br>
                        
                        Buscamos sempre o bem estar do animal e também da sua família.<br><br>
                        
                        Obrigada por adotar e dar um lar a quem já tanto sofreu. <br><br>
                        
                        <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
                        Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
            
        }
        
        $subject = "[GAAR Campinas] Pós adoção de ".$nomedoanimal."";
        
        /* E-MAIL PARA O ADOTANTE */ 
        
		$to = $emailadotante;
		$mail->AddAddress($to);
		$mail->Subject   = $subject;
        $mail->Body      = $bodytext;
        
        if (!$mail->send()) {
                $log_file_msg .="[envioemailposadocao.php] Erro de envio do e-mail de pós adoção para o adotante:".$mail->ErrorInfo."\n";
        } else {
                $log_file_msg .="[envioemailposadocao.php] E-mail de pós adoção enviado ao adotante ".$to." às ".$horaatu."\n";
        }
        
        $mail->clearAddresses();
        
        /* COPIA DO E-MAIL DO ADOTANTE FOI PRA CAIXA DO POS ADOCAO */ 
        $to = $emailresp;
		$mail->AddAddress($to);
		$subject = "[GAAR Campinas] Cópia do e-mail de pós adoção de ".$nomedoanimal."";
		$bodytext .= "<strong><i> VOCÊ ESTÁ RECEBENDO A CÓPIA DO E-MAIL DE PÓS ADOÇÃO POIS É O RESPONSÁVEL PELO ANIMAL DOADO. POR FAVOR, ACOMPANHE SE HAVERÁ RETORNO </i></strong> ";
		$mail->Subject   = $subject;
        $mail->Body      = $bodytext;
    
        if (!$mail->send()) {
                $log_file_msg .="[envioemailposadocao.php] Erro de envio do e-mail de pós adoção para o responsável do GAAR :".$mail->ErrorInfo."\n";
        } else {
                $log_file_msg .="[envioemailposadocao.php] E-mail de pós adoção enviado ao responsável do GAAR ".$to." às ".$horaatu."\n";
        }

		/* ATUALIZACAO DO TERMO COM O STATUS DO PÓS ADOÇÃO */
		
		$queryup = "UPDATE TERMO_ADOCAO
					SET 
					POS_ADOCAO='$dtatu',
					STATUS_POS ='Envio de e-mail automático',
					POS_ADOCAO_POR='Envio de e-mail automático',
					OBS='* NÃO APAGAR ESSA LINHA * Primeiro contato foi feito automático via sistema em ".$dtatu_format.". Uma cópia do e-mail ao adotante foi enviado para posadocao@gaarcampinas.org'
					WHERE 
					ID = '$id'";
			 				
        $update = mysqli_query($connect,$queryup); 	
        
        if(mysqli_errno($connect) <> '0'){
            
            $from = "contato@gaarcampinas.org";
		
    		$to = "thaise.piculi@gmail.com";
    		
    		$subject = "[GAAR Campinas] Erro ao atualizar a tabela TERMO_ADOCAO";
    		
    		$headers = "MIME-Version: 1.0\n";               
    		$headers .= "Content-type: text/html; charset=utf-8\n";            
    		$headers .= "From: <{$from}> \r\n";
    		$headers .= "Reply-To: <{$from}> \r\n";    
    
    		$message = "Mensagem de erro: ".mysqli_error($connect). " <br>SQL Error: ".mysqli_errno($connect);
    		
    		mail($to, $subject, $message, $headers);
        }
            
    }

}
$mail->clearAddresses();

$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  
fclose($fp);
mysqli_close($connect);
		
?>