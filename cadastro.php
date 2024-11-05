<?php 

session_start();

include ("conexao.php"); 
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
    
    <title>GAAR - Cadastro</title>
<?
$_SESSION['login'] = $_POST['login'];
$login = $_SESSION['login'];
$senha = MD5($_POST['senha']);
$idcandidvol =  $_POST['idvol'];
$nome = strtoupper($_POST['nome']);
$end = $_POST['endereco'];
$cidade = $_POST['cidade'];
$num = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$celular = $_POST['celular'];
$cpfcnpj = $_POST['cpf'];
$rg = $_POST['rg'];
$profissao = $_POST['profissao'];
$nascimento = $_POST['nascimento'];
$nacionalidade = $_POST['nacionalidade'];
$estadocivil =  $_POST['estadocivil'];
$email =  strtolower ( $_POST['email']);
$area = $_POST['area'];
$subarea = $_POST['subarea'];

$name = $_POST['name'];
$query_select = "SELECT * FROM VOLUNTARIOS WHERE USUARIO = '$login'";
    $select = mysqli_query($connect,$query_select);
    $array = mysqli_fetch_array($select);
$logarray = $array['login'];
$bancovet = $_POST['bancovet'];
$agvet = $_POST['agvet'];
$contavet = $_POST['contavet'];
$dv = $_POST['dv'];
$cpfvet = $_POST['cpfvet'];
$valorgato = $_POST['valorgato'];
$valorgata = $_POST['valorgata'];
$valorcaop = $_POST['valorcaop'];
$valorcaom = $_POST['valorcaom'];
$valorcaog = $_POST['valorcaog'];
$valorcadelap = $_POST['valorcadelap'];
$valorcadelam = $_POST['valorcadelam'];
$valorcadelag = $_POST['valorcadelag'];
$relatorio_reprova = 'Não';
$cpg = 'Não';

$bancofornec = $_POST['bancofornec'];
$agfornec = $_POST['agfornec'];
$contafornec = $_POST['contafornec'];
$dvfornec = $_POST['dvfornec'];
$cpffornec = $_POST['cpffornec'];
$diapgtofornec = $_POST['diapgtofornec'];

	if($login == "" || $login == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo login deve ser preenchido');window.location.href='
    cadastro.html';</script>";
 
    }else{
      if($logarray == $login){
 
        echo"<script language='javascript' type='text/javascript'>
        alert('Esse login já existe, escolha outro');window.location.href='
        cadastro.html';</script>";
        die();
 
      }else{
         switch ($area) {
            case 'anuncios':
                  $nascimento = '2001-01-01';
                  $cep = 0;
                  $num = 0;
                  $status_aprov = 'Aprovado';
                  $cpc='Não';
                  $cpg='Não';
                  $termo_vol= 'N/A';
                  break;
            
            case 'clinica':
            case 'fornecedor':
                  $nascimento = '2001-01-01';
                  $status_aprov = 'Aprovado';
                  $cpc='Não';
                  $cpg='Não';
                  $termo_vol= 'N/A';
                  $estadocivil='N/A';
                  $profissao = $area;
                  $cpfcnpj= $cpffornec;
                  $rg = $cpffornec;
                  $nacionalidade = 'Brasileiro';
                  break;
            
            default:
                $status_aprov = 'Esperando aprovação';
                $cpc='Não';
                $cpg='Não';
                $termo_vol= 'N/A';
                
                break;

         }

        if ($cep == ''){
            $cep = 0;
        }
        
        if ($num == ''){
            $num = 0;
        }
        
        switch ($subarea) {
            case 'feira':
            case 'lt':
            case 'cadastrotermo':
            case 'cadastropet':
            case 'feira':
            case 'posadocao':
                $area ='operacional';
                break;
            case 'admin':
                $area='admin';
                break;
            case 'bazar':
            case 'eventos':
            case 'notas':
                $area='captacao';
                break;
            case 'contabil':
            case 'financeiro':
                $area='financeiro';
                break;
            case 'redes':
            case 'sites':
            case 'designer':
                $area='comunicacao';
                break;
            default:
                $subarea = $area;
        }
        
        if ($email != ''){
            $query = "INSERT INTO VOLUNTARIOS 
                        (USUARIO,
                        SENHA,
                        NOME,
                        CELULAR,
                        EMAIL,
                        CPF_CNPJ,
                        RG,
                        DT_NASC,
                        NACIONALIDADE,
                        ESTADO_CIVIL,
                        PROFISSAO,
                        CEP,
                        ENDERECO,
                        COMPLEM,
                        NUMERO,
                        BAIRRO,
                        CIDADE,
                        ESTADO,
                        AREA,
                        SUBAREA,
                        RELATORIO_REPROVA,
                        CPG,
                        STATUS_APROV,
                        CPC,
                        TERMO_VOLUNTARIADO,
                        COORDENADOR,
                        ENTREVISTADOR) 
                        VALUES (
                        '$login',
                        '$senha',
                        '$nome',
                        '$celular',
                        '$email',
                        '$cpfcnpj',
                        '$rg',
                        '$nascimento',
                        '$nacionalidade',
                        '$estadocivil',
                        '$profissao',
                        '$cep',
                        '$end',
                        '$complemento',
                        '$num',
                        '$bairro',
                        '$cidade',
                        '$estado',
                        '$area',
                        '$subarea',
                        '$relatorio_reprova',
                        '$cpg',
                        '$status_aprov',
                        '$cpc',
                        '$termo_vol',
                        '0',
                        '0')";
                        
            $insert = mysqli_query($connect,$query);
            
            if(mysqli_errno($connect) != '0'){
                    echo "<center><h3>Oooops! Algo deu errado no seu cadastro...</h3><br>";
                    if (mysqli_errno($connect) =="1062"){
                          echo "<p>Você já possui cadastro no sistema, por gentileza entre em contato pelo e-mail contato@gaarcampinas.org</p><br>";
                          echo "<a href='cadastro_voluntario.php' class='btn btn-primary'>Voltar</a></center><br>";
                    } else {
                        echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                        echo "<a href='cadastro_voluntario.php' class='btn btn-primary'>Voltar</a></center><br>";
                    }
            } else {
                $queryupdate = "UPDATE FORM_VOLUNTARIO SET STATUS_APROV='Aprovado' WHERE ID='$idcandidvol'";
                $update = mysqli_query($connect,$queryupdate);
                
                if ($area =='clinica') {
                    $query2 = "INSERT INTO CLINICAS (CLINICA,ENDERECO,NUMERO,BAIRRO,CEP,CIDADE,TELEFONE,NOME_RESP,EMAIL,VALOR_GATO,VALOR_GATA,VALOR_CAOP,VALOR_CAOM,VALOR_CAOG,VALOR_CADELAP,VALOR_CADELAM,VALOR_CADELAG) 
                               VALUES ('$nome','$end','$num','$bairro','$cep','$cidade','$celular','$nome','$email','$valorgato','$valorgata','$valorcaop','$valorcaom','$valorcaog','$valorcadelap','$valorcadelam','$valorcadelag')";
                    $insert2 = mysqli_query($connect,$query2);
                    
                    if(mysqli_errno($connect) != '0'){
                        echo "<center><h3>Oooops! Algo deu errado no cadastro da sua clínica...</h3><br>";
                              echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                              echo "<a href='cadastro_vet.php' class='btn btn-primary'>Voltar</a></center><br>";
                    } else {
                        echo "<center><img src='logo pequeno.png'><br><br>";
                        echo "<h3>Cadastro efetuado com sucesso! </h3><br>";
                        echo "<p>Você irá receber um e-mail do remetente contato@gaarcampinas.org com as informações. Caso não tenha recebido, por favor verifique sua caixa de SPAM</p><br><br>";
                        echo "<p>Para fazer o login, clique <a href='http://gaarcampinas.org/area/login.html'>aqui</a></p><br></center>";
                        
                        $message = "Olá, ".$nome." <br><br> Seja bem-vindo(a) a área restrita do GAAR.  <br><br> Essas são as suas informações: <br>Login: ".$_SESSION['login']." <br>Senha: ".$_POST['senha']." <br><br> <strong>Seus dados são pessoais e intransferíveis </strong> <br><br>";
                        
                    }
                    
                } else if ($area =='fornecedor') {
                    $query2 = "INSERT INTO FORNECEDORES (NOME_FORNEC, CPF_CNPJ, BANCO_FORNEC, AGENCIA_FORNEC, CONTA_FORNEC, DV_FORNEC, PRODUTO, MELHORDIA_FORNEC, EMAIL) 
                               VALUES ('$nome','$cpffornec','$bancofornec','$agenciafornec','$contafornec','$dvfornec','$subarea','$diapgtofornec','$email')";
                    $insert2 = mysqli_query($connect,$query2);
                    
                    if(mysqli_errno($connect) != '0'){
                        echo "<center><h3>Oooops! Algo deu errado no cadastro...</h3><br>";
                              echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                              echo "<a href='cadastro_fornec.php' class='btn btn-primary'>Voltar</a></center><br>";
                    } else {
                        echo "<center><img src='logo pequeno.png'><br><br>";
                        echo "<h3>Cadastro efetuado com sucesso! </h3><br>";
                        echo "<p>Você irá receber um e-mail do remetente contato@gaarcampinas.org com as informações. Caso não tenha recebido, por favor verifique sua caixa de SPAM</p><br><br>";
                        echo "<p>Para fazer o login, clique <a href='http://gaarcampinas.org/area/login.html'>aqui</a></p><br></center>";
                        
                        $message = "Olá, ".$nome." <br><br> Seja bem-vindo(a) a área restrita do GAAR.  <br><br> Essas são as suas informações: <br>Login: ".$_SESSION['login']." <br>Senha: ".$_POST['senha']." <br><br> <strong>Seus dados são pessoais e intransferíveis </strong> <br><br>";
                        
                    }
                   } 
                    else {
                    echo "<center><img src='logo pequeno.png'><br><br>";
                    echo "<h3>Cadastro efetuado com sucesso! Aguarde a aprovação</h3><br>";
                    echo "<p>Você irá receber um e-mail do remetente contato@gaarcampinas.org com as informações. Caso não tenha recebido, por favor verifique sua caixa de SPAM</p><br></center>";
                    
                    $message = "Olá, ".$nome." <br><br> Seja bem-vindo(a) a área restrita do GAAR.  <br><br> Essas são as suas informações: <br>Login: ".$_SESSION['login']." <br>Senha: ".$_POST['senha']." <br><br> Seu cadastro está esperando aprovação. <br><br>";
                }

        		$subject="Seja bem-vindo(a) ao GAAR!";
        		$bodytext = $message;
        		
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
                $to = $email;
                $mail->AddAddress($to);
        		
        		$mail->send();
        		
        		$mail->clearAddresses();
        		
        		// E-MAIL PARA APROVAÇÃO
        		
        		$subject="Novo cadastro realizado na área restrita";
        		$bodytext = "Nome: ".$nome." <br><br> Login: ".$_SESSION['login']." <br>Área: ".$area." <br> Subarea: ".$subarea."<br><br>";
        		
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
                $to = "thaise.piculi@gmail.com";
                $mail->AddAddress($to);
        		
        		$mail->send();
        		
        		$mail->clearAddresses();
            } 
        
            /*if(mysqli_errno($connect) == '0'){
		
            } else {
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                      echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                      echo "<a href='cadastro_voluntario.php' class='btn btn-primary'>Voltar</a></center><br>";
            }*/
      } else { 
        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
        echo "<p>E-mail inválido</p><br>";
        
        switch ($area){
            case 'clinica':
                echo "<a href='cadastro_vet.php' class='btn btn-primary'>Voltar</a></center><br>";
                break;
                
            case 'anuncios':
                echo "<a href='cadastro_anuncios.php' class='btn btn-primary'>Voltar</a></center><br>";
                break;
		
		    default:
		        echo "<a href='cadastro_voluntario.php' class='btn btn-primary'>Voltar</a></center><br>";
                break;
      }
      } 
    }

}

?>
