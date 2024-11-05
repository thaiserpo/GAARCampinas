<?php 

session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$login = $_SESSION['login'];
$divulgar = $_POST['divulgar'];

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional

if ($divulgar =='LEG'){
    /* acesso via sistema */
    if($login == "" || $login == null){
    	      echo"<script language='javascript' type='text/javascript'>
              alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
    } else {
        $queryarealeg = "SELECT AREA,SUBAREA,EMAIL,NOME,CPG FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarealeg = mysqli_query($connect,$queryarealeg);
		
		while ($fetcharealeg = mysqli_fetch_row($selectarealeg)) {
				$area = $fetcharealeg[0];
				$subarea = $fetcharealeg[1];
				$email = $fetcharealeg[2];
				$nomevoluntario = $fetcharealeg[3];
				$cpg = $fetcharealeg[4];
		}
    }
} else {
        /* acesso externo ao sistema */
        $queryarea = "SELECT NOME, AREA, SUBAREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$nomevoluntario = $fetcharea[0];
				$area = $fetcharea[1];
				$subarea = $fetcharea[2];
				$cpg = $fetcharea[3];
		}

		 if ($nomevoluntario == ''){
		     $nomevoluntario = 'Não é voluntário do GAAR';
		 }
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
    
    <title>GAAR - Cadastro de animais</title>
    
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">
        <br>
<?
$nomeanimal = strtoupper($_POST['nomeanimal']);
$especie = $_POST['especie'];
$peso = $_POST['peso'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];
$cor = $_POST['cor'];
$porte = $_POST['porte'];
$castracao = $_POST['castracao'];
$dtcastracao = $_POST['dtcastracao'];
$vacinacao = $_POST['vacinacao'];
$doses = $_POST['doses'];
$vermifugado = $_POST['vermifugado'];
$status = $_POST['status'];
if ($status == 'Disponível'){
    $dtdisponivel = $data_atu;
} else{
    $dtdisponivel = "0001-01-01";
}
if ($divulgar =='LEG'){
    $lt = 'A definir';
    $resp = $nomevoluntario;
    $status = 'LEG';
} else {
    $lt = strtoupper($_POST['lt']);   
    $ltresp = strtoupper($_POST['ltresp']);  
    $resp = $_POST['resp'];
}
$emailresp = $_POST['emailresp'];
$dtentradalt = $_POST['dtentradalt'];
$dtsaidalt = $_POST['dtsaidalt'];
/*$foto = $_FILES['foto'];*/
$obs = $_POST['obs'];
$obs2 = $_POST['obs2'];
$divulgar = $_POST['divulgar'];
$tmpuploaddir = '/home/gaarca06/public_html/pets/';
$telresp = $_POST['telresp'];
$tipoanuncio = $_POST['tipoanuncio'];
$despulgado = $_POST['despulgado'];
$origem = $_POST['origem'];
$comportamento =  $_POST['comportamento'];
$perfil_outrosanimais = $_POST['outrosanimais'];
$perfil_criancas = $_POST['criancas'];
$perfil_apto = $_POST['apto'];
$microchip = $_POST['microchip'];

$carteirinha_frente = $_FILES['carteirinha_frente']['name'];
$carteirinha_verso = $_FILES['carteirinha_verso']['name'];
$dtvacina = $_POST['dtvacina'];
$obs_apadrinhamento = $_POST['obs_apadrinhamento'];
$dtdisponivel = $_POST['dtdisponivel'];
$video = $_POST['video'];
$vacinacao_r = $_POST['vacinacao_r'];
$dtvacina_r = $_POST['dtvacina_r'];
$exame_fivfelv = $_POST['exame_fivfelv'];
$dt_exame_fivfelv = $_POST['dt_exame_fivfelv'];
$dt_vermifugacao = $_POST['dt_vermifugacao'];
$result_exame_fivfelv = $_POST['result_exame_fivfelv'];

/*echo "<br> dtentradalt: ".$dtentradalt;
echo "<br> dtvacina: ".$dtvacina;*/

$queryvaga = "SELECT * FROM ANIMAL WHERE RESPONSAVEL = '$resp' AND ADOTADO ='LEG'";
$selectvaga = mysqli_query($connect,$queryvaga);
$reccount = mysqli_num_rows($selectvaga);

if ($reccount >= '3' && $status =='LEG' && $subarea !='diretoria' && $subarea !='cpg' ){
    echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
    echo "<p>Você atingiu o limite de 3 cadastros, por favor aguarde liberação para submeter uma nova inscrição</p><br>";
    echo "<a href='javascript:window.close()' class='btn btn-primary'>Fechar</a></center><br>";
} else {
if($_FILES['foto']['size']>1000000){
           echo"<script language='javascript' type='text/javascript'>
              alert('Tamanho máximo do arquivo da foto 1 deve ser 1MB');
    		  window.location.href='formcadastropet.php'</script>";
} else {
    if($_FILES['foto_2']['size']>1000000){
           echo"<script language='javascript' type='text/javascript'>
            alert('Tamanho máximo do arquivo da foto 2 deve ser 1MB');
    	    window.location.href='formcadastropet.php'</script>";
    } else {
        if($_FILES['foto_3']['size']>1000000){
              echo"<script language='javascript' type='text/javascript'>
              alert('Tamanho máximo do arquivo da foto 3 deve ser 1MB');
    		  window.location.href='formcadastropet.php'</script>";
        } else {
            if($_FILES['foto_4']['size']>1000000){
                echo"<script language='javascript' type='text/javascript'>
                alert('Tamanho máximo do arquivo da foto 1 deve ser 1MB');
    		    window.location.href='formcadastropet.php'</script>";
            } else {
                if($_FILES['carteirinha_frente']['size']>1000000){
                               echo"<script language='javascript' type='text/javascript'>
                                  alert('Tamanho máximo do arquivo da frente da carteirinha deve ser 1MB');
                        		  window.location.href='formcadastropet.php'</script>";
                } else {
                    if($_FILES['carteirinha_verso']['size']>1000000){
                               echo"<script language='javascript' type='text/javascript'>
                                  alert('Tamanho máximo do arquivo do verso da carteirinha deve ser 1MB');
                            	  window.location.href='formcadastropet.php'</script>";
                            }else {
	    
	                            $tmpfoto1 = str_replace(" ", "_",$_FILES['foto']['name']);
                                $tmpfoto2 = str_replace(" ", "_",$_FILES['foto_2']['name']);
                                $tmpfoto3 = str_replace(" ", "_",$_FILES['foto_3']['name']);
                                $tmpfoto4 = str_replace(" ", "_",$_FILES['foto_4']['name']);
                                $nome_foto =$tmpfoto1;
                                $nome_foto_2 = $tmpfoto2;
                                $nome_foto_3 = $tmpfoto3;
                                $nome_foto_4 = $tmpfoto4;
                                                        
                        	    if ($idade == ''){
                        	        $idade = "0001-01-01";
                        	    }
                        	    
                        	    if ($dtcastracao == ''){
                        		    $dtcastracao = "0001-01-01";
                        		}
                        		
                        		if ($dtvacina == ''){
                        		    $dtvacina = "0001-01-01";
                        		}
                        		
                        		if ($dtentradalt == ''){
                        		    $dtentradalt = "0001-01-01";
                        		}
                        		
                        		if ($dtsaidalt == ''){
                        		    $dtsaidalt = "0001-01-01";
                        		}
                        		
                        		if ($divulgar == 'Terceiros'){
                        		    $resp = $telresp;
                        		    $obs2 = $emailresp;
                        		    $lt = $ltresp;
                        		}
    		
                        		switch ($especie){
                        		    case 'Felina':
                        		        $peso = 0;
                            		    if ($obs_apadrinhamento == ''){
                            		        $obs_apadrinhamento = 'Ração premium ou super premium, vacinas, vermífugos, brinquedinhos, areia para minhas necessidades e muita divulgação para me ajudar a encontrar um lar';
                            		    }
                            		    break;
                            		    
                            		case 'Canina':
                            		    $exame_fivfelv ='N/A';
                            		    $result_exame_fivfelv='0';
                            		    $despulgado='N/A';
                            		    if ($obs_apadrinhamento == ''){
                            		        $obs_apadrinhamento = 'Ração premium ou super premium, vacinas, vermífugos, ajuda financeira para pagar o lar temporário e muita divulgação para me ajudar a encontrar um lar';
                            		    }
                        		}
                        		
                        		if ($perfil_outrosanimais == ''){
                        		    $perfil_outrosanimais =' Não';
                        		}
                        		
                        		if ($perfil_criancas == ''){
                        		    $perfil_criancas =' Não';
                        		}
                        		
                        		if ($perfil_apto == ''){
                        		    $perfil_apto =' Não';
                        		}
                        		
                        		if ($dt_vermifugacao == '') {
                        		    $dt_vermifugacao ='0001-01-01';
                        		}
                        		
                        		if ($microchip ==''){
                        		    $microchip='0';
                        		}
                        		
                        		$ano_idade = substr($idade,0,4);
                    		    $mes_idade = substr($idade,5,2);
                    		    $dia_idade = substr($idade,8,2);
                    		    
                    		    $idade_jul = gregoriantojd($mes_idade,$dia_idade,$ano_idade);
                    		    
                    		    $querymaxid = "SELECT MAX(ID) FROM ANIMAL";
                        		$selectmaxid = mysqli_query($connect,$querymaxid); 
                        		
                        		while ($fetchmaxid = mysqli_fetch_row($selectmaxid)) {
                        		    $id = $fetchmaxid[0];
                        		}
                        		
                        		$idanimal = intval($id) + 1;
                        
                        		$querypet = "SELECT * FROM ANIMAL WHERE NOME_ANIMAL = '$nomeanimal' AND ESPECIE ='$especie' AND RESPONSAVEL ='$resp' and LAR_TEMPORARIO='$lt' AND ADOTADO<> 'Disponível'";
                        		$selectpet = mysqli_query($connect,$querypet); 
                        		
                        		while ($fetchpet = mysqli_fetch_row($selectpet)) {
                        		    $animalcad = $fetchpet[1];
                        		    $especiecad  = $fetchpet[2];
                        		    $respcad = $fetchpet[12];
                        		    $ltcad = $fetchpet[11];
                        		};
                        		
                        		if ($nomeanimal == $animalcad && $especie == $especiecad && $resp == $respcad && $lt == $ltcad && $status <> 'Adotado'){
                        		    echo"<script language='javascript' type='text/javascript'>
                                      alert('Animal já cadastrado!');
                            		  window.location.href='formcadastropet.php'</script>";
                        		} else {
                        		    if ($resp == '' || $lt == ''){
                        		          echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                                          echo "<p>Lar temporário ou responsável inválidos</p><br>";
                                          echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
                        		    } else {
                                    		$query = "INSERT INTO ANIMAL
                                    					(NOME_ANIMAL, 
                                    					ESPECIE, 
                                    					IDADE, 
                                    					SEXO, 
                                    					COR, 
                                    					PORTE, 
                                    					CASTRADO, 
                                    					DATA_CASTRACAO, 
                                    					VACINADO, 
                                    					ADOTADO, 
                                    					LAR_TEMPORARIO, 
                                    					RESPONSAVEL, 
                                    					DATA_ENTRADA_LT, 
                                    					DATA_SAIDA_LT, 
                                    					OBS, 
                                    					FOTO,
                                    					OBS2,
                                    					DIVULGAR_COMO,
                                    					TIPO_ANUNCIO,
                                    					VERMIFUG,
                                    					DOSES,
                                    					DESPULGADO,
                                    					ORIGEM,
                                    					COMPORTAMENTO,
                                    					CARTEIRINHA_FRENTE,
                                    					CARTEIRINHA_VERSO,
                                    					PESO,
                                    					IDADE_JUL,
                                    					DATA_VACINACAO,
                                    					FOTO_2,
                                    					FOTO_3,
                                    					FOTO_4,
                                    					OUTROSANIMAIS,
                                    					CRIANCAS,
                                    					APTO,
                                    					OBS_APADRINHAMENTO,
                                    					VIDEO,
                                    					DISPONIVEL_EM,
                                    					VACINADO_RAIVA,
                                    					DATA_VACINACAO_RAIVA,
                                    					EXAME_FIVFELV,
                                    					DATA_EXAME_FIVFELV,
                                    					DATA_VERMIFUG,
                                    					RESULT_EXAME_FIVFELV,
                                    					TEXTO_REDES,
                                    					TERMO_ADOCAO,
                                    					MICROCHIP)
                                    					VALUES
                                                        ('$nomeanimal',
                                                        '$especie',
                                                        '$idade',
                                                        '$sexo',
                                                        '$cor',
                                                        '$porte',
                                                        '$castracao',
                                                        '$dtcastracao',
                                                        '$vacinacao',
                                                        '$status',
                                                        '$lt',
                                                        '$resp',
                                                        '$dtentradalt',
                                                        '$dtsaidalt',
                                                        '$obs',
                                                        '$tmpfoto1',
                                                        '$obs2',
                                                        '$divulgar',
                                                        '$tipoanuncio',
                                                        '$vermifugado',
                                                        '$doses',
                                                        '$despulgado',
                                                        '$origem',
                                                        '$comportamento',
                                                        '$carteirinha_frente',
                                                        '$carteirinha_verso',
                                                        '$peso',
                                                        '$idade_jul',
                                                        '$dtvacina',
                                                        '$tmpfoto2',
                                                        '$tmpfoto3',
                                                        '$tmpfoto4',
                                                        '$perfil_outrosanimais',
                                                        '$perfil_criancas',
                                                        '$perfil_apto',
                                                        '$obs_apadrinhamento',
                                                        '$video',
                                                        '$dtdisponivel',
                                                        '$vacinacao_r',
                                                        '$dtvacina_r',
                                                        '$exame_fivfelv',
                                                        '$dt_exame_fivfelv',
                                                        '$dt_vermifugacao',
                                                        '$result_exame_fivfelv',
                                                        '$obs',
                                                        '0',
                                                        '$microchip'
                                                        )";
                                    						
                                            $insert = mysqli_query($connect,$query); 
                                            
                                            $getmail = "SELECT EMAIL FROM LT WHERE LAR_TEMPORARIO='$lt'";
                                    		$select = mysqli_query($connect,$getmail);
                                    		$fetch = mysqli_fetch_row($select);
                                    		
                                            if(mysqli_errno($connect) == '0'){

                                                    try {
                                                       mkdir($tmpuploaddir.$idanimal); // cria diretorio com fotos do pet
                                                    } catch(ErrorException $ex) {
                                                       $log_file_msg .="[cadastropet.php] Diretório ".$tmpuploaddir.$idanimal." não foi criado com sucesso. Erro: ".$ex->getMessage()." às ".$horaatu."\n";
                                                       $fp = fopen($log_file, 'a');//opens file in append mode  
                                                       fwrite($fp, $log_file_msg);
                                                    }
                                                    
                                                    if (is_dir($tmpuploaddir.$idanimal)) { //upload de fotos do pet
                                                    
                                                        $uploaddir = "/home/gaarca06/public_html/pets/".$idanimal."/";
                                                        //$uploaddircart = '/home/gaarca06/public_html/pets/';
                                                        $uploadcart_frente = $uploaddir.($_FILES['carteirinha_frente']['name']);
                                                        $uploadcart_verso = $uploaddir.($_FILES['carteirinha_verso']['name']);
                                                        
                                                        $tmpfoto1 = str_replace(" ", "_",$_FILES['foto']['name']);
                                                        $tmpfoto2 = str_replace(" ", "_",$_FILES['foto_2']['name']);
                                                        $tmpfoto3 = str_replace(" ", "_",$_FILES['foto_3']['name']);
                                                        $tmpfoto4 = str_replace(" ", "_",$_FILES['foto_4']['name']);
                                                        
                                                        /*$uploadfile = $tmp_uploaddir.($tmpfoto1);
                                                        $uploadfile_2 = $tmp_uploaddir($tmpfoto2);
                                                        $uploadfile_3 = $tmp_uploaddir($tmpfoto3);
                                                        $uploadfile_4 = $tmp_uploaddir($tmpfoto4);*/
                                                        
                                                        $uploadfile = $uploaddir.($tmpfoto1);
                                                        $uploadfile_2 = $uploaddir.($tmpfoto2);
                                                        $uploadfile_3 = $uploaddir.($tmpfoto3);
                                                        $uploadfile_4 = $uploaddir.($tmpfoto4);
                                                        
                                                        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile) ) {
                                                            $log_file_msg.="[cadastropet.php] Erro ao fazer upload da foto 1 - Animal ID: ".$idanimal." - ".$horaatu."\n";
                                                            $fp = fopen($log_file, 'a');//opens file in append mode  
                                                            fwrite($fp, $log_file_msg);
                                                        } 
                                                        
                                                        if (!move_uploaded_file($_FILES['foto_2']['tmp_name'], $uploadfile_2)){
                                                            $log_file_msg.="[cadastropet.php] Erro ao fazer upload da foto 2 - Animal ID: ".$idanimal." - ".$horaatu."\n";
                                                            $fp = fopen($log_file, 'a');//opens file in append mode  
                                                            fwrite($fp, $log_file_msg);
                                                        }
                                                        
                                                        if (!move_uploaded_file($_FILES['foto_3']['tmp_name'], $uploadfile_3)){
                                                            $log_file_msg.="[cadastropet.php] Erro ao fazer upload da foto 3 - Animal ID: ".$idanimal." - ".$horaatu."\n";
                                                            $fp = fopen($log_file, 'a');//opens file in append mode  
                                                            fwrite($fp, $log_file_msg);
                                                        }
                                                        
                                                        if (!move_uploaded_file($_FILES['foto_4']['tmp_name'], $uploadfile_4)){
                                                            $log_file_msg.="[cadastropet.php] Erro ao fazer upload da foto 4 - Animal ID: ".$idanimal." - ".$horaatu."\n";
                                                            $fp = fopen($log_file, 'a');//opens file in append mode  
                                                            fwrite($fp, $log_file_msg);
                                                        }
                                                        
                                                    } 
            
                                                    if ($carteirinha_frente !=''){
                                                        move_uploaded_file($_FILES['carteirinha_frente']['tmp_name'], $uploadcart_frente);    
                                                    } else {
                                                            $carteirinha_frente = '0';
                                                    }
                                                
                                                    if ($carteirinha_verso !=''){
                                                        move_uploaded_file($_FILES['carteirinha_verso']['tmp_name'], $uploadcart_verso);
                                                    } else {
                                                        $carteirinha_verso = '0';
                                                    }   
                                                    
                                                    $log_file_msg.="[cadastropet.php] Animal ".$nomeanimal." - Espécie: ".$especie." com o status: ".$divulgar." cadastrado às ".$horaatu."\n";
                                                    $fp = fopen($log_file, 'a');//opens file in append mode  
                                                    fwrite($fp, $log_file_msg);
                                                    
                                                    if ($castracao == "Não"){
                                        		        $dtcastracao_ano = substr($dtcastracao,0,4);
                                        		        $dtcastracao_mes = substr($dtcastracao,5,2);
                                        		        $dtcastracao_dia = substr($dtcastracao,8,2);
                                        		        
                                        		        $queryemailresp = "SELECT EMAIL FROM VOLUNTARIOS WHERE NOME ='$resp'";
            		                                    $selectemailresp = mysqli_query($connect,$queryemailresp);
            		                                    $rc = mysqli_fetch_row($selectemailresp);
            			                                $emailresp = $rc[0];
            		
                                            		    $subject ="[GAAR Campinas] Novo animal não castrado cadastrado";
                                            		    $bodytext = "Olá voluntário,<br><br>
                                            		                Seguem os dados do animal não castrado para inclusão no agendamento de castrações:<br><br>
                                            		                <strong>ID                           : ".$idanimal."</strong><br>
                                            		                Nome do animal               : ".$nomeanimal."<br>
                                            		                Espécie                      : ".$especie."<br>
                                            		                Data de nascimento aproximada: ".$dia_idade."/".$mes_idade."/".$ano_idade."<br>
                                            		                Data prevista da castração   : ".$dtcastracao_dia."/".$dtcastracao_mes."/".$dtcastracao_ano."<br>
                                            		                Responsável do GAAR          : ".$resp."<br><br>
                                            		                
                                            		                <i><small>Esta notificação foi enviada automaticamente pelo sistema. Por favor não responda.<br> O responsável pelo animal também receberá uma cópia da notificação.</small></i>";
                                            		    
                                            		    
                                            		    /* E-MAIL PARA O GRUPO DE CASTRACOES COM O ID DO ANIMAL */ 
                    
                                                    	$mail->Subject   = $subject;
                                                        $mail->Body      = $bodytext;
                                                        $mail->IsHTML(true);
                                                        //$to = "castracao@gaarcampinas.org";
                                                        $bcc = $emailresp;
                                                        $mail->AddAddress($to);
                                                        $mail->AddBCC($bcc);
                                                        $mail->send();
                                                        $mail->clearAddresses(); 
                                                        
                                                        $log_file_msg="[cadastropet.php] Notificação enviada para os voluntários da castração do animal ".$nomeanimal." - Espécie: ".$especie."  - ID: ".$idanimal." às ".$horaatu."\n";
                                                        $fp = fopen($log_file, 'a');//opens file in append mode  
                                                        //fwrite($fp, $log_file_msg); 
                                        		    } 
                                        		    
                                        		    if ($divulgar =='LEG'){ 
                                        		        switch ($especie) {
                                        		          case 'Felina':
                                        		                mysqli_data_seek($selectarealeg,0);
                                        		                
                                        		                while ($fetcharealeg = mysqli_fetch_row($selectarealeg)) {
                                                        				$email = $fetcharealeg[2];
                                                        				$nomevoluntario = $fetcharealeg[3];
                                                        				$cpg = $fetcharealeg[4];
                                                        				
                                                        				if ($cpg == 'Sim') {
                                                        				        
                                                                					
                                                                				$to = $email;
                                                                				
                                                                				$message = "<p>Olá Comissão Provisória de Gatos, <br><br>
                                                                				            
                                                                				            Uma nova inscrição foi feita por ".$resp.": <br><BR>
                                                                				            
                                                                				            <B>DADOS DA INSCRIÇÃO</B> <br><br>
                                                                				            
                                                                				            <table>
                                                                                                <tr>
                                                                                                    <td align='left'>Nome do animal </td>
                                                                                                    <td align='left'>: ".$nomeanimal."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>Espécie </td>
                                                                                                    <td align='left'>: ".$especie."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>Sexo </td>
                                                                                                    <td align='left'>: ".$sexo."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>Data de nascimento aproximada </td>
                                                                                                    <td align='left'>: ".$idade."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>Porte </td>
                                                                                                    <td align='left'>: ".$porte."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>Cor </td>
                                                                                                    <td align='left'>: ".$cor."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>O animal foi vermifugado?</td>
                                                                                                    <td align='left'>: ".$vermifugado."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>O animal foi despulgado?</td>
                                                                                                    <td align='left'>: ".$despulgado."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>Vacinado contra a raiva?</td>
                                                                                                    <td align='left'>: ".$vacinacao_r."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>Quantas doses de vacina polivante que já tomou?</td>
                                                                                                    <td align='left'>: ".$doses."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>O animal está castrado?</td>
                                                                                                    <td align='left'>: ".$castracao."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>Data da castração ou previsão</td>
                                                                                                    <td align='left'>: ".$dtcastracao."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>Origem do animal</td>
                                                                                                    <td align='left'>: ".$origem."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>História</td>
                                                                                                    <td align='left'>: ".$obs."</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align='left'>Comportamento</td>
                                                                                                    <td align='left'>: ".$comportamento."</td>
                                                                                                </tr>
                                                                                            </table>
                                                                                            <br><br>
                                                                                            
                                                                                            Para acessar a lista: <br>
                                                                                            1. Acesse <a href='http://gaarcampinas.org/area/login.html' target='blank'> a área restrita</a> <br>
                                                                                            2. Clique no menu Outros<br>
                                                                                            3. Clique no menu Lista de espera de gatos <br><br>
                                                                                            
                                                                                            <p>Link para divulgação: <a href='http://www.gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>www.gaarcampinas.org/pet.php?id=".$idanimal."</a>
                                                                                
                                                                                            <center><img class='img-responsive img-fluid rounded' src='http://gaarcampinas.org/pets/".$nome_foto."' valign='top' align='center' width='30%' height='30%'/> <br><br></center>
                                                                                            
                                                                                            <i> Esta notificação foi gerada automaticamente através do sistema </i>";
                                                                				
                                                                				$subject = "Nova inscrição realizada na lista de espera de gatos";
                                                                				
                                                                				echo "e-mail cpg: ".$message;
                                                                				echo "<br> enviado para: ".$email;
                                                                				
                                                                				mail($to, $subject, $message, $headers);   
                                                        				}
                                                        				
                                        		                }
                                                				/* EMAIL AO VOLUNTÁRIO */
                                                				$to = $emailresp;
            
                                                				$message = "<p>Olá voluntário, <br><br>
            
                                                				            <B>DADOS DA INSCRIÇÃO</B> <br><br>
                                                				            
                                                				            <table>
                                                                                <tr>
                                                                                    <td align='left'>Nome do animal </td>
                                                                                    <td align='left'>: ".$nomeanimal."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Espécie </td>
                                                                                    <td align='left'>: ".$especie."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Sexo </td>
                                                                                    <td align='left'>: ".$sexo."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Data de nascimento aproximada </td>
                                                                                    <td align='left'>: ".$idade."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Porte </td>
                                                                                    <td align='left'>: ".$porte."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Cor </td>
                                                                                    <td align='left'>: ".$cor."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>O animal foi vermifugado?</td>
                                                                                    <td align='left'>: ".$vermifugado."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>O animal foi despulgado?</td>
                                                                                    <td align='left'>: ".$despulgado."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Vacinado contra a raiva?</td>
                                                                                    <td align='left'>: ".$vacinacao_r."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Quantas doses de vacina polivalente que já tomou?</td>
                                                                                    <td align='left'>: ".$doses."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>O animal está castrado?</td>
                                                                                    <td align='left'>: ".$castracao."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Data da castração ou previsão</td>
                                                                                    <td align='left'>: ".$dtcastracao."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Origem do animal</td>
                                                                                    <td align='left'>: ".$origem."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>História</td>
                                                                                    <td align='left'>: ".$obs."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Comportamento</td>
                                                                                    <td align='left'>: ".$comportamento."</td>
                                                                                </tr>
                                                                            </table>
                                                                            <br><br>
                                                                            
                                                                            Para acessar a lista:
                                                                            1. Acesse <a href='http://gaarcampinas.org/area/login.html' target='blank'> a área restrita</a> <br>
                                                                            2. Clique no menu Outros<br>
                                                                            3. Clique no menu Lista de espera de gatos <br><br>
                                                                            
                                                                            <p>Link para divulgação: <a href='http://www.gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>www.gaarcampinas.org/pet.php?id=".$idanimal."</a>
                                                                
                                                                            <center><img class='img-responsive img-fluid rounded' src='http://gaarcampinas.org/pets/".$nome_foto."' valign='top' align='center' width='30%' height='30%'/> <br><br></center>
                                                    
                                                                            * Esta notificação foi gerada automaticamente através do sistema *</p>";
                                                				
                                                				$subject = "Nova inscrição realizada na lista de espera de gatos";
                                                				
                                                				mail($to, $subject, $message, $headers);
                        
                                                		        break;
                                                		        
                                        		            case 'Canina':   
                                                    				$to = "thaise.piculi@gmail.com";
                                                    								
                                                    				$headers = "MIME-Version: 1.0\n";               
                                                    				$headers .= "Content-type: text/html; charset=utf-8\n";  
                                                    				/*$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";*/
                                                    				$headers .= "From: <{$from}> \r\n";    
                                                    				/*$headers .= "Bcc: contato@gaarcampinas.org, thaise.piculi@gmail.com \r\n"; */
                                                    					
                                                    				$message = "<p>Olá Comissão Provisória de Cães, <br><br>
                                                    				            
                                                    				            Seguem os dados da inscrição feita por ".$resp.": <br><BR>
                                                    				            
                                                    				           <B>DADOS DA INSCRIÇÃO</B> <br><br>
                                                				            
                                                				            <table>
                                                                                <tr>
                                                                                    <td align='left'>Nome do animal </td>
                                                                                    <td align='left'>: ".$nomeanimal."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Espécie </td>
                                                                                    <td align='left'>: ".$especie."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Sexo </td>
                                                                                    <td align='left'>: ".$sexo."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Data de nascimento aproximada </td>
                                                                                    <td align='left'>: ".$idade."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Porte </td>
                                                                                    <td align='left'>: ".$porte."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Cor </td>
                                                                                    <td align='left'>: ".$cor."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>O animal foi vermifugado?</td>
                                                                                    <td align='left'>: ".$vermifugado."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>O animal foi despulgado?</td>
                                                                                    <td align='left'>: ".$despulgado."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Vacinado contra a raiva?</td>
                                                                                    <td align='left'>: ".$vacinacao_r."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Quantas doses de vacina polivalente que já tomou?</td>
                                                                                    <td align='left'>: ".$doses."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>O animal está castrado?</td>
                                                                                    <td align='left'>: ".$castracao."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Data da castração ou previsão</td>
                                                                                    <td align='left'>: ".$dtcastracao."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Origem do animal</td>
                                                                                    <td align='left'>: ".$origem."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>História</td>
                                                                                    <td align='left'>: ".$obs."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Comportamento</td>
                                                                                    <td align='left'>: ".$comportamento."</td>
                                                                                </tr>
                                                                            </table>
                                                                            <br>
                                                                            
                                                                            <br><br>
                                                                            
                                                                            Para acessar a lista:
                                                                            1. Acesse <a href='http://gaarcampinas.org/area/login.html' target='blank'> a área restrita</a> <br>
                                                                            2. Clique no menu Outros<br>
                                                                            3. Clique no menu Lista de espera de cães <br><br>
                                                                            
                                                                            <p>Link para divulgação: <a href='http://www.gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>www.gaarcampinas.org/pet.php?id=".$idanimal."</a>
                                                                
                                                                            <center><img class='img-responsive img-fluid rounded' src='http://gaarcampinas.org/pets/".$nome_foto."' valign='top' align='center' width='30%' height='30%'/> <br><br></center>
                                                    
                                                                            * Esta notificação foi gerada automaticamente através do sistema *</p>";
                                                    				
                                                    				$subject = "Nova inscrição realizada na lista de espera de cães";
                                                    				
                                                    				mail($to, $subject, $message, $headers);
                                                    				
                                                    				/* EMAIL AO VOLUNTÁRIO */
            
                                                    				$to = $emailresp;
                                                    								
                                                    				$message = "<p>Olá voluntário, <br><br>
                                                    				            
                                                    				            <B>DADOS DA INSCRIÇÃO</B> <br><br>
                                                				            
                                                				                <table>
                                                                                <tr>
                                                                                    <td align='left'>Nome do animal </td>
                                                                                    <td align='left'>: ".$nomeanimal."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Espécie </td>
                                                                                    <td align='left'>: ".$especie."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Sexo </td>
                                                                                    <td align='left'>: ".$sexo."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Data de nascimento aproximada </td>
                                                                                    <td align='left'>: ".$idade."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Porte </td>
                                                                                    <td align='left'>: ".$porte."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Cor </td>
                                                                                    <td align='left'>: ".$cor."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>O animal foi vermifugado?</td>
                                                                                    <td align='left'>: ".$vermifugado."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>O animal foi despulgado?</td>
                                                                                    <td align='left'>: ".$despulgado."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Vacinado contra a raiva?</td>
                                                                                    <td align='left'>: ".$vacinacao_r."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Quantas doses de vacina que já tomou?</td>
                                                                                    <td align='left'>: ".$doses."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>O animal está castrado?</td>
                                                                                    <td align='left'>: ".$castracao."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Data da castração ou previsão</td>
                                                                                    <td align='left'>: ".$dtcastracao."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Origem do animal</td>
                                                                                    <td align='left'>: ".$origem."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>História</td>
                                                                                    <td align='left'>: ".$obs."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='left'>Comportamento</td>
                                                                                    <td align='left'>: ".$comportamento."</td>
                                                                                </tr>
                                                                            </table>
                                                                            <br>
                                                                            
                                                                            Para acessar a lista:
                                                                            1. Acesse <a href='http://gaarcampinas.org/area/login.html' target='blank'> a área restrita</a> <br>
                                                                            2. Clique no menu Outros<br>
                                                                            3. Clique no menu Lista de espera de gatos <br><br>
                                                                            
                                                                            <p>Link para divulgação: <a href='http://www.gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>www.gaarcampinas.org/pet.php?id=".$idanimal."</a>
                                                                
                                                                            <center><img class='img-responsive img-fluid rounded' src='http://gaarcampinas.org/pets/".$nome_foto."' valign='top' align='center' width='400' height='600'/> <br><br></center>
                                                    
                                                                            * Esta notificação foi gerada automaticamente através do sistema *</p>";
                                                    				
                                                    				$subject = "Nova inscrição realizada na lista de espera de cães";
                                                    				
                                                    				mail($to, $subject, $message, $headers);
                                                    				
                                                    				echo"<script language='javascript' type='text/javascript'>
                                                                    alert('Inscrição realizada com sucesso!');
                                                    		        window.location.href='forminscricaoleg.php'</script>";
                                                    		        break;
                                        		      }
                                        		  } 
                                        		    if ($divulgar =='GAAR' && $status == 'Disponível' && $nome_foto !=''){ 
            
                                                		        $bodytext = "<p>Olá voluntário, <br><br>
                                                				            
                                                				            Uma nova inscrição foi feita no sistema. </p><br>
                                                				            
                                                				            <p>Vamos ajudá-lo a encontrar um lar? Link para divulgação: <a href='http://www.gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>www.gaarcampinas.org/pet.php?id=".$idanimal."</a>
                                                				            
                                                				            <table>
                                                                                        <tr>
                                                                                            <td align='left' colspan='3'>Nome do animal </td>
                                                                                            <td align='left' colspan='3'>: ".$nomeanimal."</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align='left' colspan='3'>Espécie </td>
                                                                                            <td align='left' colspan='3'>: ".$especie."</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align='left' colspan='3'>Sexo </td>
                                                                                            <td align='left' colspan='3'>: ".$sexo."</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align='left' colspan='3'>Data de nascimento aproximada </td>
                                                                                            <td align='left' colspan='3'>: ".$idade."</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align='left' colspan='3'>Porte </td>
                                                                                            <td align='left' colspan='3'>: ".$porte."</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align='left' colspan='3'>O animal está castrado?</td>
                                                                                            <td align='left' colspan='3'>: ".$castracao."</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align='left' colspan='3'>Data da castração ou previsão</td>
                                                                                            <td align='left' colspan='3'>: ".$dtcastracao."</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align='left' colspan='3'>História</td>
                                                                                            <td align='left' colspan='3'>: ".$obs."</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align='left' colspan='3'>Comportamento</td>
                                                                                            <td align='left' colspan='3'>: ".$comportamento."</td>
                                                                                        </tr>
                                                                                    </table><br><br>
                                                                
                                                                            <center><img class='img-responsive img-fluid rounded' src='http://gaarcampinas.org/pets/".$idanimal."/".$nome_foto."' valign='top' align='center' width='400' height='600'/> <br><br></center>
                                                                            
                                                                            <small><i>Esta notificação foi gerada automaticamente através do sistema</i></small></p>";
                                        				
                                        				$subject = "[GAAR Campinas]".$nomeanimal." cadastrado e pronto para divulgação";
                                            	
                                            		    
                                            		    /* E-MAIL PARA O GRUPO DE CASTRACOES COM O ID DO ANIMAL */ 
                    
                                                    	$mail->Subject   = $subject;
                                                        $mail->Body      = $bodytext;
                                                        $mail->IsHTML(true);
                                                        $bcc = "thaise.piculi@gmail.com";
                                                        $mail->AddBCC($bcc);
                                                        
                                        				$queryarea = "SELECT AREA,EMAIL FROM VOLUNTARIOS WHERE AREA='comunicacao' AND STATUS_APROV='Aprovado'";
                                                		$selectarea = mysqli_query($connect,$queryarea);
                                                		
                                                		$lista_mail = 0;
                                                		
                                                		while ($fetcharea = mysqli_fetch_row($selectarea)) {
                                                				$area = $fetcharea[0];
                                                				$to = $fetcharea[1];
                                                				$mail->AddAddress($to);
                                                                $mail->send();
                                                                $mail->clearAddresses();
                                                                $lista_mail .= $to.", ";
                                                		}
                                                		$log_file_msg="[cadastropet.php] Notificação enviada para os voluntários das redes sociais ".$lista_mail." às ".$horaatu."\n";
                                                        $fp = fopen($log_file, 'a');//opens file in append mode  
                                                        fwrite($fp, $log_file_msg); 
                                        		  }
                                        		  
                                        		    echo"<script language='javascript' type='text/javascript'>
                                                                alert('Cadastro realizado com sucesso!');
                                                		        window.location.href='formcadastropet.php'</script>";
                                                
                                                }else {
                                                    $log_file_msg.="[cadastropet.php] Erro no cadastro do animal ".$nomeanimal." - Espécie: ".$especie.". Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
                                                    $fp = fopen($log_file, 'a');//opens file in append mode  
                                                    fwrite($fp, $log_file_msg);
                                                }
                                                		        
                        		    }
                		    }
    }
}
        }
    }
}
}
}
fclose($fp); 
mysqli_close($connect);

?>          

