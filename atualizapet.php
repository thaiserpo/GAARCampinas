<?php 
session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$login = $_SESSION['login'];

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	$idanimal = $_POST['idanimal'];
	$nomedoanimal = strtoupper($_POST['nomedoanimal']);
	$especie = $_POST['especie'];
	$peso = $_POST['peso'];
	$idade = $_POST['idade'];
	$sexo = $_POST['sexo'];
	$cor = $_POST['cor'];
	$porte = $_POST['porte'];
	$castracao = $_POST['castracao'];
	$dtcastracao = $_POST['dtcastracao'];
	$vacinacao = $_POST['vacinacao'];
	$dtvacina = $_POST['dtvacina'];
	$vermifugado = $_POST['vermifugado'];
	$despulgado = $_POST['despulgado'];
	$doses = $_POST['doses'];
	$status = $_POST['status'];
	$statusold = $_POST['statusold'];
	$lt = $_POST['lt'];
	$ltold = $_POST['ltold'];
	$resp = $_POST['resp'];
	$dtentradalt = $_POST['dtentradalt'];
	$dtsaidalt = $_POST['dtsaidalt'];
	$obs = $_POST['obs'];
	$obs2 = $_POST['obs2'];
	$obs_apadrinhamento = $_POST['obs3'];
	$divulgar = $_POST['divulgar'];
	$perfil_outrosanimais = $_POST['outrosanimais'];
    $perfil_criancas = $_POST['criancas'];
    $perfil_apto = $_POST['apto'];
    $deletarfoto1 = $_POST['deletarfoto1'];
    $deletarfoto2 = $_POST['deletarfoto2'];
    $deletarfoto3 = $_POST['deletarfoto3'];
    $deletarfoto4 = $_POST['deletarfoto4'];
    $dtdisponivel = $_POST['dtdisponivel'];
    $video = $_POST['video'];
    $vacinacao_r = $_POST['vacinacao_r'];
    $dtvacina_r = $_POST['dtvacina_r'];
    $exame_fivfelv = $_POST['exame_fivfelv'];
    $dt_exame_fivfelv = $_POST['dt_exame_fivfelv'];
    $dt_vermifugacao = $_POST['dt_vermifugacao'];
    $result_exame_fivfelv = $_POST['result_exame_fivfelv'];
	
	$uploaddir = "/home/gaarca06/public_html/pets/".$idanimal."/";
	$uploadfile1 = $uploaddir.($_FILES['foto_1']['name']);
	$uploadfile2 = $uploaddir.($_FILES['foto_2']['name']);
	$uploadfile3 = $uploaddir.($_FILES['foto_3']['name']);
	$uploadfile4 = $uploaddir.($_FILES['foto_4']['name']);
	
	$foto = $uploadfile;
	$nome_foto1 = $_FILES['foto_1']['name'];
	$nome_foto2 = $_FILES['foto_2']['name'];
	$nome_foto3 = $_FILES['foto_3']['name'];
	$nome_foto4 = $_FILES['foto_4']['name'];
	$nome_foto1_ori = $_POST['nome_foto1_ori'];
	$nome_foto2_ori = $_POST['nome_foto2_ori'];
	$nome_foto3_ori = $_POST['nome_foto3_ori'];
	$nome_foto4_ori = $_POST['nome_foto4_ori'];
	
	$carteirinha_frente_ori = $_POST=['carteirinha_frente_ori'];
	$carteirinha_verso_ori = $_POST=['carteirinha_verso_ori'];
	//$uploaddircart = '/home/gaarca06/public_html/pets/'.$idanimal;
	$carteirinha_frente = $_FILES['carteirinha_frente']['name'];
	$carteirinha_verso = $_FILES['carteirinha_verso']['name'];
    $uploadcart_frente = $uploaddir.($_FILES['carteirinha_frente']['name']);
    $uploadcart_verso = $uploaddir.($_FILES['carteirinha_verso']['name']);


?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta charset="gb18030">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/lc_lightbox.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <title>GAAR - Atualização de pet</title>
    
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">

<?

    if($_FILES['foto_1']['size']>1000000){
                   echo"<script language='javascript' type='text/javascript'>
                      alert('Tamanho máximo do arquivo da foto deve ser 1MB');
            		  window.location.href='formatualizapet.php'</script>";
    } else {
        if($_FILES['foto_2']['size']>1000000){
                   echo"<script language='javascript' type='text/javascript'>
                      alert('Tamanho máximo do arquivo da foto 2 deve ser 1MB');
            		  window.location.href='formatualizapet.php'</script>";
        } else {
            if($_FILES['foto_3']['size']>1000000){
                   echo"<script language='javascript' type='text/javascript'>
                      alert('Tamanho máximo do arquivo da foto 3 deve ser 1MB');
            		  window.location.href='formatualizapet.php'</script>";
            } else {
                if($_FILES['foto_4']['size']>1000000){
                   echo"<script language='javascript' type='text/javascript'>
                      alert('Tamanho máximo do arquivo da foto 4 deve ser 1MB');
            		  window.location.href='formatualizapet.php'</script>";
                } else {
                    if (isset($_POST['$deletarfoto1'])){
                        /* DELETA A FOTO DO SERVIDOR */
                        $deleta = $uploaddir.$nome_foto1_ori;
                        unlink($deleta);
                        $nome_foto1 = '';
                    } else {
                        if ($nome_foto1 == ''){
                            $nome_foto1 = $nome_foto1_ori;
                        } else {
                            if (move_uploaded_file($_FILES['foto_1']['tmp_name'], $uploadfile1)) {
                        		    $foto1 = $uploadfile1;
                        		    $deleta = $uploaddir.$nome_foto1_ori;
                        		    unlink ($deleta);
                        	    }
                        }
                    } 
                    
                    if (isset($_POST['$deletarfoto2'])){
                        /* DELETA A FOTO DO SERVIDOR */
                        $deleta = $uploaddir.$nome_foto2_ori;
                        unlink($deleta);
                        $nome_foto2 = '';
                    } else {
                    	if ($nome_foto2 != ''){
                        	if (move_uploaded_file($_FILES['foto_2']['tmp_name'], $uploadfile2)) {
                        		    $foto2 = $uploadfile2;
                        		    $deleta = $uploaddir.$nome_foto2_ori;
                        		    unlink ($deleta);
                        	    }
                        } else {
                            $nome_foto2 = $nome_foto2_ori;
                        }
                    }
                        
                    if (isset($_POST['$deletarfoto3'])){
                        /* DELETA A FOTO DO SERVIDOR */
                        $deleta = $uploaddir.$nome_foto3_ori;
                        unlink($deleta);
                        $nome_foto3 = '';
                    } else {
                        if ($nome_foto3 != ''){
                            	if (move_uploaded_file($_FILES['foto_3']['tmp_name'], $uploadfile3)) {
                            		    $foto3 = $uploadfile3;
                            		    $deleta = $uploaddir.$nome_foto3_ori;
                            		    unlink ($deleta);
                            	    }
                        } else {
                            $nome_foto3 = $nome_foto3_ori;
                        }   
                    }
                        
                    if (isset($_POST['$deletarfoto4'])){
                        /* DELETA A FOTO DO SERVIDOR */
                        $deleta = $uploaddir.$nome_foto4_ori;
                        unlink($deleta);
                        $nome_foto4 = '';
                    } else {
                        if ($nome_foto4 != ''){
                                	if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile4)) {
                                		    $foto4 = $uploadfile4;
                                		    $deleta = $uploaddir.$nome_foto4_ori;
                                		    unlink ($deleta);
                                	    }
                        } else {
                            $nome_foto4 = $nome_foto4_ori;	        
                        }
                    }
                	
            	if($_FILES['carteirinha_frente']['size']>1000000){
            	    $carteirinha_frente = '';
            	     echo"<script language='javascript' type='text/javascript'>
                                  alert('Tamanho máximo do arquivo da frente da carteirinha deve ser 1MB');
                        		  window.location.href='formcadastropet.php'</script>";
                } else {
                	if ($carteirinha_frente <> $carteirinha_frente_ori ){
                    	move_uploaded_file($_FILES['carteirinha_frente']['tmp_name'], $uploadcart_frente);
                    	$deleta = $uploaddircart.$carteirinha_frente_ori;
                        unlink ($deleta);
                    }
                	  else{
                	        $carteirinha_frente = $carteirinha_frente_ori;
                	}
                }
            	
            	if($_FILES['carteirinha_verso']['size']>1000000){
            	    $carteirinha_verso = '';
            	     echo"<script language='javascript' type='text/javascript'>
                                  alert('Tamanho máximo do arquivo do verso da carteirinha deve ser 1MB');
                        		  window.location.href='formcadastropet.php'</script>";
                } else {
                	if ($carteirinha_verso <> $carteirinha_verso_ori){
                        move_uploaded_file($_FILES['carteirinha_verso']['tmp_name'], $uploadcart_verso);
                        $deleta = $uploaddircart.$carteirinha_verso_ori;
                        unlink ($deleta);
                    }
                	  else{
                	        $carteirinha_verso = $carteirinha_verso_ori;
                	}
                }
            	
            	if ($dtcastracao == ''){
            	        $dtcastracao = '0001-01-01';
            	    }
            	
            	if ($dtentradalt == ''){
            	    $dtentradalt = '0001-01-01';
            	}
            	
            	if ($dtsaidalt == ''){
            	    $dtsaidalt = '0001-01-01';
            	} 
            	
            	if ($lt == ''){
            	    $lt = $ltold;
            	}
            	
            	if ($perfil_outrosanimais == ''){
            		    $perfil_outrosanimais =' Não';
        		}
        		
        		if ($status =='Disponível') {
        		    $dtdisponivel = $data_atu;
        		}
        		
        		if ($perfil_criancas == ''){
        		    $perfil_criancas =' Não';
        		}
        		
        		if ($perfil_apto == ''){
        		    $perfil_apto =' Não';
        		}
                
                $ano_idade = substr($idade,0,4);
                $mes_idade = substr($idade,5,2);
                $dia_idade = substr($idade,8,2);
                
                $idade_jul = gregoriantojd($mes_idade,$dia_idade,$ano_idade);
            		    
            	$queryvol = "SELECT EMAIL FROM VOLUNTARIOS WHERE NOME = '$resp'";
            	$selectvol = mysqli_query($connect,$queryvol); 	
            	
            	while ($fetchvol = mysqli_fetch_row($selectvol)) {
            			$emailvol = $fetchvol[0];
            	  }
            	
            	$querydtreg = "SELECT DATA_REG FROM ANIMAL WHERE ID = '$idanimal'";
            	$selectdtreg = mysqli_query($connect,$querydtreg); 	
            	
            	while ($fetchdtreg = mysqli_fetch_row($selectdtreg)) {
            			$dtreg = $fetchdtreg[0];
            	  }
                    $query = "UPDATE ANIMAL
            					SET 
            					NOME_ANIMAL='$nomedoanimal',
            					ESPECIE='$especie',
            					IDADE='$idade',
            					SEXO='$sexo',
            					COR='$cor',
            					PORTE='$porte',
            					CASTRADO='$castracao',
            					DATA_CASTRACAO='$dtcastracao',
            					VACINADO='$vacinacao',
            					DOSES='$doses',
            					ADOTADO='$status',
            					LAR_TEMPORARIO='$lt',
            					RESPONSAVEL='$resp',
            					DATA_ENTRADA_LT='$dtentradalt', 
            					DATA_SAIDA_LT='$dtsaidalt', 
            					OBS='$obs', 
            					FOTO='$nome_foto1',
            					OBS2='$obs2',
            					DIVULGAR_COMO='$divulgar',
            					DATA_REG = '$dtreg',
            					/*TIPO_ANUNCIO = '',*/
            					VERMIFUG = '$vermifugado',
            					DESPULGADO = '$despulgado',
            					CARTEIRINHA_FRENTE = '$carteirinha_frente',
            					CARTEIRINHA_VERSO = '$carteirinha_verso',
            					PESO = '$peso',
            					IDADE_JUL='$idade_jul',
            					FOTO_2 = '$nome_foto2',
            					FOTO_3 = '$nome_foto3',
            					FOTO_4 = '$nome_foto4',
            					OUTROSANIMAIS = '$perfil_outrosanimais',
            					CRIANCAS = '$perfil_criancas',
            					APTO = '$perfil_apto',
            					DATA_VACINACAO = '$dtvacina',
            					OBS_APADRINHAMENTO='$obs_apadrinhamento',
            					DISPONIVEL_EM='$dtdisponivel',
            					VIDEO='$video',
            					VACINADO_RAIVA='$vacinacao_r',
            					DATA_VACINACAO_RAIVA='$dtvacina_r',
            					EXAME_FIVFELV = '$exame_fivfelv',
            					DATA_EXAME_FIVFELV='$dt_exame_fivfelv',
            					DATA_VERMIFUG ='$dt_vermifugacao',
            					RESULT_EXAME_FIVFELV='$result_exame_fivfelv'
            					WHERE 
            					ID = '$idanimal'";
            					 				
                    $insert = mysqli_query($connect,$query); 	
            		 
                    if(mysqli_errno($connect) == '0'){
                    /*echo "Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);*/
                        $mail = new PHPMailer();
                        $mail->CharSet = 'UTF-8';
                        //Read an HTML message body from an external file, convert referenced images to embedded,
                        //convert HTML into a basic plain-text alternative body
                        //$email->msgHTML(file_get_contents('contents.html'), __DIR__);
                        $mail->SetFrom('operacional@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
                        $mail->IsHTML(true);
        
                        if ($status =='Pré adotado' || $status =='Indisponível') {
                            
                            $querylt = "SELECT EMAIL FROM LT WHERE LAR_TEMPORARIO='$lt'";
                            $selectlt = mysqli_query($connect,$querylt);
                            $rclt = mysqli_fetch_row($selectlt);
                            $emaillt = $rclt[0];
                            
                            $subject = "[GAAR Campinas] Alteração de status do animal ".$nomedoanimal."";
                            
                            $bodytext = "Olá, <br><br>
                            
                                        Estamos enviando essa notificação para comunicar que o status do animal ".$nomedoanimal." foi alterado para ".$status."<br><br>
                                        
                                        Qualquer dúvida entre em contato com o responsável do GAAR :) <br><br>
                                        
                                        <i><small> Este e-mail foi enviado automaticamente pelo sistema da ONG</small></i>";
                            
                            $mail->Subject   = $subject;
                            $mail->Body      = $bodytext;
                            $to = $emaillt;
                            $bcc = 'thaise.piculi@gmail.com';
                            $mail->AddAddress($to);
                            $mail->AddBCC($bcc);
                            $lista_mail = $to.",".$bcc."";
                            
                            if (!$mail->send()) {
                                $log_file_msg .="[atualizapet.php] Erro no envio de notificação de alteração de status do animal ".$nomedoanimal.": ".$mail->ErrorInfo." às ".$horaatu."\n";
                                $fp = fopen($log_file, 'a');//opens file in append mode  
                                fwrite($fp, $log_file_msg);  
                            } else {
                                //$queryarearedes = "SELECT EMAIL,NOME FROM VOLUNTARIOS WHERE (AREA='comunicacao' OR SUBAREA='diretoria') AND STATUS_APROV='Aprovado'";
                                $queryarearedes = "SELECT EMAIL,NOME FROM VOLUNTARIOS WHERE AREA='comunicacao' AND ENTREVISTADOR <>'0' AND STATUS_APROV='Aprovado'"; 
                        		$selectarearedes = mysqli_query($connect,$queryarearedes);
                        		
                        		while ($fetcharearedes = mysqli_fetch_row($selectarearedes)) {
                        				$emailredes = $fetcharearedes[0];
                        				$nomevoluntario = $fetcharearedes[1];
                        				$lista_mail .= $emailredes.",";
                        				$mail->AddAddress($emailredes);
                        				$mail->send();
                        				$mail->clearAddresses();
                        		}
                        		$log_file_msg .="[atualizapet.php] Envio de notificação de alteração de status do animal ".$nomedoanimal." para ".$lista_mail." às ".$horaatu."\n"; 
                                $fp = fopen($log_file, 'a');//opens file in append mode  
                                fwrite($fp, $log_file_msg);  
                            }
                            
                            
                            
                        }
                        
                        if ($statusold =='LEG'){

                    		$to = $emailvol;
                    		
                    		$subject = "O status do animal ".$nomedoanimal." foi atualizado";
                    		
                    		$message = "<p>Olá ".$resp." <br><br>
                    		
                    		            O status do animal ".$nomedoanimal." que estava na lista de espera foi alterado para ".$status." <br><br>
                    		            
                    		            <
                    		            
                    		            **** Este e-mail foi enviado automaticamente pelo nosso sistema interno **** " ;
                    		
                    		//mail($to, $subject, $message, $headers);
                    		
                    		if ($divulgar == 'GAAR' && $status =='Disponível' && ($nome_foto1 !='' || $nome_foto2 !='' || $nome_foto3 !='' || $nome_foto4 !='')){ 
                    		    
                    				$message = "<p>Olá voluntário, <br><br>
                            				            
                            				            Uma nova inscrição foi feita por ".$resp." </p><br>
                            				            
                            				            <table>
                                                                    <tr>
                                                                        <td align='left' colspan='3'>Nome do animal </td>
                                                                        <td align='left' colspan='3'>: ".$nomedoanimal."</td>
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
                                                                        <td align='left' colspan='3'>O animal foi vermifugado?</td>
                                                                        <td align='left' colspan='3'>: ".$vermifugado."</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align='left' colspan='3'>O animal foi despulgado?</td>
                                                                        <td align='left' colspan='3'>: ".$despulgado."</td>
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
                                                        
                                                        <p>Vamos ajudá-lo a encontrar um lar? Link para divulgação: <a href='http://www.gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>www.gaarcampinas.org/pet.php?id=".$idanimal."</a>
                                            
                                                        <center><img class='img-responsive img-fluid rounded' src='http://gaarcampinas.org/pets/".$idanimal."/".$nome_foto1."' valign='top' align='center' width='400' height='600'/> <br><br></center>
                                                        
                                                        * Esta notificação foi gerada automaticamente através do sistema *</p>";
                    				
                    				$subject = $nomedoanimal." pronto para divulgação";
                    				
                    				$queryarea = "SELECT AREA,EMAIL FROM VOLUNTARIOS WHERE (AREA<>'clinica' and AREA<>'anuncios') AND STATUS_APROV='Aprovado'";
                            		$selectarea = mysqli_query($connect,$queryarea);
                            			
                            		while ($fetcharea = mysqli_fetch_row($selectarea)) {
                            				$area = $fetcharea[0];
                            				$to = $fetcharea[1];
                            				
                            				//mail($to, $subject, $message, $headers);
                            		}
                    				
                    		}
                            }
                        
                        /* NOTIFICAÇÃO PARA OS VOLUNTÁRIOS DA COMUNICAÇÃO 
                        if () {
                                $queryarea = "SELECT EMAIL,NOME FROM VOLUNTARIOS WHERE SUBAREA='comunicacao' OR SUBAREA='diretoria' AND STATUS_APROV='Aprovado'";
                        		$selectarea = mysqli_query($connect,$queryarea);
                        		
                        		while ($fetcharea = mysqli_fetch_row($selectarea)) {
                        				$email = $fetcharea[0];
                        				$nomevoluntario = $fetcharea[1];
                        		}
                        }*/
                        echo"<script language='javascript' type='text/javascript'>
                          alert('Animal atualizado com sucesso!');
                		  window.location.href='formpesquisapetinterna.php'</script>";
            	    }
            	    else{
            			echo "Insert code: ".$insert;
            			echo "Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);
                      echo"<script language='javascript' type='text/javascript'>
                      alert('Erro ao cadastrar');window.location
                      .href='formatualizapet.php'</script>";
                    }
	  
            }
    }
    }
    }

}
fclose($fp);
mysqli_close($connect);
?>
    </div>
</main>
<br><br>
<footer class="footer fixed-bottom bg-light">
      <div class="container">
        <p class="text-center">GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
      </div>
    </footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="lib/AlloyFinger/alloy_finger.min.js"></script>
<script src="js/lc_lighbox.lite.min.js"></script>
<!--- BOOTSTRAP --->
</body>