<?php 

session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$login = $_SESSION['login'];
$idtermo = $_POST ['idtermo'];
$idpretermo = $_POST ['idpretermo'];
$obs = $_POST['obs'];

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode

$log_file_msg = "";
$listamail = "";

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,NOME FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$nome = $fetcharea[1];
		}
		
		if ($idtermo != ''){
		    $query = "SELECT * FROM TERMO_ADOCAO WHERE ID='$idtermo'";
    		$select = mysqli_query($connect,$query);
    			
    		while ($fetch = mysqli_fetch_row($select)) {
    				$adotante = $fetch[1];
                    $rg = $fetch[2];
                    $cpf = $fetch[3];
                    $endereco = $fetch[4];
                    $numero = $fetch[43];
                    $bairro = $fetch[5];
                    $cep = $fetch[6];
                    $cidade = $fetch[7];
                    $estado = $fetch[44];
                    $pontoref = $fetch[8];
                    $fixo = $fetch[9];
                    $celular = $fetch[10];
                    $emailadotante = $fetch[11];
                    $facebook = $fetch[12];
                    $instagram = $fetch[13];
                    $profissao = $fetch[14];
                    $complemento = $fetch[45];
                    $nomeanimal = $fetch[15];
                    $especie = $fetch[16];
                    $id_pretermo = $idtermo;
    		}
		} else if ($idpretermo != '') {
    		    $query = "SELECT * FROM FORM_PRE_ADOCAO WHERE ID='$idpretermo'";
        		$select = mysqli_query($connect,$query);
        			
        		while ($fetch = mysqli_fetch_row($select)) {
        				$adotante = $fetch[1];
                        $cpf = $fetch[2];
                        $emailadotante = $fetch[3];
                        $profissao = $fetch[4];
                        $fixo = $fetch[5];
                        $celular = $fetch[6];
                        $endereco = $fetch[7];
                        $bairro = $fetch[8];
                        $cidade = $fetch[9];
                        $estado = '';
                        $cep = $fetch[10];
                        $facebook = $fetch[15];
                        $instagram = $fetch[16];                    
                        $numero = $fetch[70];
                        $nomeanimal = $fetch[11];
                        $especie = $fetch[12];
                        $id_pretermo = $idpretermo;
        		}
    		} else {
    		    /* caso seja cadastro de reprovado feito por terceiros */
                $adotante = strtoupper($_POST['adotante']);
                $rg = $_POST['rg'];
                $cpf = $_POST['cpf'];
                $endereco = $_POST['endereco'];
                $complemento = $_POST['complemento'];
                $numero = $_POST['numero'];
                $estado = $_POST['estado'];
                $bairro = $_POST['bairro'];
                $cep = $_POST['cep'];
                $cidade = $_POST['cidade'];
                $estado = $_POST['estado'];
                $pontoref = $_POST['pontoref'];
                $telfixo = $_POST['telfixo'];
                $celular = $_POST['celular'];
                $email = strtolower ($_POST['email']);
                $facebook = $_POST['facebook'];
                $instagram = $_POST['instagram'];
                $profissao = $_POST['profissao'];
                $nomeanimal = 'Terceiros';
                $especie = 'Terceiros';
                $id_pretermo = 0;
                
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
    
    <title>GAAR - Cadastro de reprovados</title>
    
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
				  case 'ong':
				  	include_once("menu_ong.php") ;
					break;
				  
			  }
?>
<main role="main" class="container">
    <div class="starter-template">
        <br>
<?

        $query = "INSERT INTO REPROVADOS 
                (ADOTANTE,
                RG,
                CPF,
                ENDERECO,
                NUMERO,
                BAIRRO,
                CEP,
                CIDADE,
                ESTADO,
                PONTO_REF,
                TEL_FIXO,
                TEL_CEL,
                EMAIL,
                FACEBOOK,
                INSTAGRAM,
                PROFISSAO,
                OBS,
                REPROVADO_POR,
                ANIMAL_INTERESSADO,
                ESPECIE,
                ID_PRETERMO) 
                VALUES 
                ('$adotante',
                '$rg',
                '$cpf',
                '$endereco',
                '$numero',
                '$bairro',
                '$cep',
                '$cidade',
                '$estado',
                '$pontoref',
                '$telfixo',
                '$celular',
                '$email',
                '$facebook',
                '$instagram',
                '$profissao',
                '$obs',
                '$nome',
                '$nomeanimal',
                '$especie',
                '$id_pretermo')";
						
        $insert = mysqli_query($connect,$query); 
        
        if(mysqli_errno($connect) == '0'){
		    $to = "contato@gaarcampinas.org";
		    
		    $queryupdate = "UPDATE TERMO_ADOCAO
		                    SET REPROVADO = 'Sim'
		                    WHERE ID='$idtermo'";
		                    
		    $update = mysqli_query($connect,$queryupdate);
		    
		    $queryupdate = "UPDATE FORM_PRE_ADOCAO
		                    SET REPROVADO = 'Sim',
		                    OBS = 'Reprovado'
		                    WHERE ID='$idpretermo'";
		                    
		    $update = mysqli_query($connect,$queryupdate);

            $subject = "[GAAR Campinas] Novo reprovado cadastrado";
    		
    		$bodytext = "<p><h4>NOVO REPROVADO CADASTRADO</h4>
    		            <br>
                          <table>
                                    <tr>
                                        <td align='left'>Nome</td>
                                        <td align='left'>: ".$adotante."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Celular</td>
                                        <td align='left'>: ".$celular."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Reprovado por</td>
                                        <td align='left'>: ".$nome."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Pré termo</td>
                                        <td align='left'>: ".$idpretermo."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Obs:</td>
                                        <td align='left'>: ".$obs."</td>
                                    </tr>
                          </table>
                          </p>
    		";
    		
    		/** ENVIO DE CÓPIA DA RESPOSTA AOS COORDENADORES**/
    		
    		$querycoord = "SELECT EMAIL FROM VOLUNTARIOS WHERE COORDENADOR='SIM'";
    		$selectcoord = mysqli_query($connect,$querycoord);
    		
    		$mail = new PHPMailer();
            /*$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail*/
            $mail->IsHTML(true);
            $mail->Debugoutput = 'html';
            $mail->CharSet = 'UTF-8';
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
            $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
            $mail->Subject   = $subject;
            $mail->Body      = $bodytext;
            $mail->IsHTML(true);
            $to = "contato@gaarcampinas.org";
            $mail->AddAddress($to);
            
            while ($fetchcoord = mysqli_fetch_row($selectcoord)) {
                $to_vol =$fetchcoord[0];
                $mail->AddBCC($to_vol);
                //$mail->AddAddress($to_vol);
                $lista_email .=", ".$to_vol;
                //echo "<br> lista mail: ".$lista_email;
            }
          
    		if (!$mail->send()) {
                        $log_file_msg .="[cadastroreprova.php] Erro de envio do e-mail de reprovado:".$mail->ErrorInfo."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);
            } else {
                        $log_file_msg .="[cadastroreprova.php] E-mail de reprovado enviado para ".$lista_email." às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);
            }
                    
            $mail->clearAddresses();
		    
		    echo"<script language='javascript' type='text/javascript'>
             alert('Cadastrado com sucesso!');
			 window.location.href='formcadastroreprova.php'</script>";
    		
        } elseif (mysqli_errno($connect) == '1062') {
            echo"<script language='javascript' type='text/javascript'>
              alert('Reprovado já cadastrado');window.location
              .href='formcadastroreprova.php'</script>";
        }else{
            $to = "thaise.piculi@gmail.com";
            
            $subject = "[GAAR Campinas] Falha no cadastro do reprovado ";
    		
    		$bodytext = "<p><h4>FALHA NO CADASTRO DO REPROVADO</h4>
                        <br>
                          <table>
                                    <tr>
                                        <td align='left'>Nome</td>
                                        <td align='left'>: ".$adotante."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Celular</td>
                                        <td align='left'>: ".$celular."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Reprovado por</td>
                                        <td align='left'>: ".$nome."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Obs:</td>
                                        <td align='left'>: ".$obs."</td>
                                    </tr>
                          </table>
                          <br><br>
                            Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."
                          </p>
    		";
            $mail->Subject   = $subject;
            $mail->Body      = $bodytext;
          
    		$mail->send();
    		
    		$mail->clearAddresses();
    		
	        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
            echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
            echo "<a href='formcadastroreprova.php' class='btn btn-primary'>Voltar</a></center><br>";
          /*echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao cadastrar');window.location
          .href='formprecadastrotermo.php'</script>";*/
	    }
        
        fclose($fp);
}
mysqli_close($connect);
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
