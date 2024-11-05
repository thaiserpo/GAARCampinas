<?php 

session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('operacional@gaarcampinas.org', 'GAAR Campinas'); //Name is optional

$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");
$ano_atu = date("Y");
$mes_atu = date("m");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

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
    
    <title>GAAR - Cadastro de pré termo</title>
    
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">
        <br>
        <center><img src="/area/logo_transparent.png" width="70" height="70"></center>
        <br>
<?

if ($_POST["palavra"] == $_SESSION["palavra"]){
        $adotante = $_POST['adotante'];
        $rg = $_POST['rg'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $tmp_endereco = $_POST['endereco'];
        $endereco = str_replace("'","",$tmp_endereco);
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $bairro = $_POST['bairro'];
        $cep = $_POST['cep'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $profissao = $_POST['profissao'];
        $celular = $_POST['celular'];
        $email = strtolower ($_POST['email']);
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $idanimal = $_POST['idanimal'];
        $idanimalfelina = $_POST['idanimalfelina'];
        $idanimalcanina = $_POST['idanimalcanina'];
        $nomeinput = $_POST['nomeinput'];
        $especie = $_POST['especie'];
        $pelagem =$_POST['pelagem'];
        $sexo = $_POST['sexo'];
        $cor = $_POST['cor'];
        $perg1 = $_POST['perg1'];
        $perg2 = $_POST['perg2'];
        $perg3 = $_POST['perg3'];
        $perg4 = $_POST['perg4'];
        $perg5 = $_POST['perg5'];
        $perg6 = $_POST['perg6'];
        $perg7 = $_POST['perg7'];
        $perg8 = $_POST['perg8'];
        $perg9 = $_POST['perg9'];
        $perg10 = $_POST['perg10'];
        $perg11 = $_POST['perg11'];
        $perg12 = $_POST['perg12'];
        $perg13 = $_POST['perg13'];
        $perg14 = $_POST['perg14'];
        $perg15 = $_POST['perg15'];
        $perg16 = $_POST['perg16'];
        $perg17 = $_POST['perg17'];
        $perg18 = $_POST['perg18'];
        $perg19 = $_POST['perg19'];
        $perg20 = $_POST['perg20'];
        $perg21 = $_POST['perg21'];
        $perg22 = $_POST['perg22'];
        $perg23 = $_POST['perg23'];
        $perg24 = $_POST['perg24'];
        $perg25 = $_POST['perg25'];
        $perg26 = $_POST['perg26'];
        $perg27 = $_POST['perg27'];
        $perg28 = $_POST['perg28'];
        $perg29 = $_POST['perg29'];
        $perg30 = $_POST['perg30'];
        $perg31 = $_POST['perg31'];
        $perg32 = $_POST['perg32'];
        $perg33 = $_POST['perg33'];
        $perg34 = $_POST['perg34'];
        $perg35 = $_POST['perg35'];
        $perg36 = $_POST['perg36'];
        $perg37 = $_POST['perg37'];
        $perg38 = $_POST['perg38'];
        $perg39 = $_POST['perg39']; //pergunta 37
        $text_perg37 = $_POST['text_perg37']; //pergunta 37
        $perg40 = $_POST['perg40'];
        $perg41 = $_POST['perg41'];
        $perg42 = $_POST['perg42'];
        $perg43 = $_POST['perg43'];
        $perg44 = $_POST['perg44'];
        $link = $_POST['link'];
        $ficousabendo = $_POST['ficousabendo'];
        $imagem = $_FILES['foto']['tmp_name'];
        $tamanho = $_FILES['foto']['size'];
        $tipo = $_FILES['foto']['type'];
        $nome = $_FILES['foto']['name'];
        $perg45 = $_POST['perg45'];
        $obs = $_POST['obs'];
        $obs_interessado = $_POST['obs_interessado'];
        //$feira = $_POST['feira'];
        $feira = "N/A";
        $voluntario = $_POST['nomevoluntario'];
        
        $queryreprova = "SELECT EMAIL, CPF, CEP, NUMERO FROM REPROVADOS WHERE EMAIL='$email' AND CPF='$cpf' OR (CEP ='$cep' AND NUMERO='$numero')";
        $selectreprova = mysqli_query($connect,$queryreprova); 
        $reccount = mysqli_num_rows($selectreprova);
        
        if ($idanimalfelina != ''){
            $idanimal = $idanimalfelina;
        } 
    
        if ($idanimalcanina != ''){
            $idanimal = $idanimalcanina;
        } 
        
        if ($facebook == ""){
            $facebook = "0";
        }
        
        if ($instagram == ""){
            $instagram = "0";
        }
        
        $querypet= "SELECT * FROM ANIMAL WHERE ID='$idanimal' ";
        $selectpet = mysqli_query($connect,$querypet);
        $reccountpet = mysqli_num_rows ($selectpet);
        
        if ($reccountpet != '0') {
            while ($fetchpet = mysqli_fetch_row($selectpet)) {
                $nomeanimal = $fetchpet[1];
                $especie = $fetchpet[2];
                $lt =  $fetchpet[11];
                $responsavel = $fetchpet[12];
                $pelagem = $fetchpet[5];
                $sexo = $fetchpet[4];
            }
        } else {
            if ($especie == ''){
               $especie = "Espécie não definida"; 
            }
            if ($nomeanimal == ''){
                $nomeanimal = "Animal não definido";
            }
            if ($responsavel == ''){
                switch ($especie){
                    case 'Felina':
                        $responsavel = 'Carlos Ricardo Rosa';
                        $lt = 'Sem lt';
                        
                        break;
                    case 'Canina':
                        $responsavel = 'Ingrid Menz';
                        $lt = 'Sem lt';
                        break;    
                }
            }
        }
            
        	if($numero == ''){
        	    $numero = 0;
        	}
            if ($adotante == '') {
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu nome</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($endereco == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu endereço completo</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($numero == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o número de sua casa</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($bairro == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu bairro</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($cep == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu CEP</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($cidade == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha a sua cidade</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($cpf == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu CPF</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($profissao == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha a sua profissão</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($celular == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu celular</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($email == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu e-mail</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg1 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 1</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg2 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 2</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg3 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 3</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg4 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 4</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg5 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 5</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg6 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 6</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg7 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 7</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg8 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 8</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg9 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 9</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg10 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 10</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg11 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 11</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg12 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 12</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg13 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 13</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg14 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 14</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg15 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 15</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg16 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 16</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg17 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 18</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg20 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 17</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg21 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 19</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg22 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 20</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg23 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 21</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg24 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 22</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg25 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 23</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg26 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 24</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg27 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 25</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg28 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 26</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg29 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 27</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg30 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 28</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg31 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 29</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg32 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 30</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg33 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 31</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg34 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 32</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg35 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 33</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg36 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 34</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg37 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 37</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg38 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 38</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg39 == ''){ //pergunta 37
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Verifique a resposta da pergunta: ".$text_perg37." </p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg40 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 40</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg41 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 41</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg42 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 42</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg43 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 43</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } elseif ($perg44 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 44</p><br>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            } else {
            
                if ($feira == 'Sim'){
                    $obs = "Respondido presencialmente em feira - voluntário que entrevistou: ".$nomevoluntario;
                }
                
        	    $query = "INSERT INTO FORM_PRE_ADOCAO
        						(NOME_COMPLETO,  
        						CPF, 
        						EMAIL, 
        						PROFISSAO, 
        						TELFIXO, 
        						CELULAR, 
        						RUA,  
        						BAIRRO, 
        						CIDADE, 
        						CEP, 
        						NOME_ANIMAL, 
        						ESPECIE, 
        						PELAGEM,
        						SEXO, 
        						FACEBOOK,
        						INSTAGRAM,
        						PERG1, 
        						PERG2, 
        						PERG3, 
        						PERG4, 
        						PERG5, 
        						PERG6, 
        						PERG7, 
        						PERG8, 
        						PERG9, 
        						PERG10, 
        						PERG11, 
        						PERG12, 
        						PERG13, 
        						PERG14, 
        						PERG15, 
        						PERG16, 
        						PERG17, 
        						PERG18, 
        						PERG19, 
        						PERG20, 
        						PERG21, 
        						PERG22, 
        						PERG23, 
        						PERG24, 
        						PERG25, 
        						PERG26, 
        						PERG27, 
        						PERG28, 
        						PERG29, 
        						PERG30, 
        						PERG31, 
        						PERG32, 
        						PERG33, 
        						PERG34, 
        						PERG35, 
        						PERG36, 
        						PERG37, 
        						PERG38, 
        						PERG39, 
        						PERG40, 
        						PERG41, 
        						PERG42, 
        						PERG43, 
        						PERG44,
        						LINK_ANUNCIO, 
        						FOTO,
        						PERG45,
        						FICOU_SABENDO,
        						RESPONSAVEL,
        						LAR_TEMPORARIO,
        						OBS,
        						NUMERO,
        						COMPLEMENTO,
        						REPROVADO,
        						OBS_INTERESSADO,
        						RG,
        						ID_ANIMAL,
        						PRESENTE_FEIRA)
        						VALUES 
        						('$adotante',
        						'$cpf',
        						'$email',
        						'$profissao',
        						'0',
        						'$celular',
        						'$endereco',
        						'$bairro',
        						'$cidade',
        						'$cep',
        						'$nomeanimal',
        						'$especie',
        						'$pelagem',
        						'$sexo',
        						'$facebook',
        						'$instagram',
        						'$perg1',
        						'$perg2',
        						'$perg3',
        						'$perg4',
        						'$perg5',
        						'$perg6',
        						'$perg7',
        						'$perg8',
        						'$perg9',
        						'$perg10',
        						'$perg11',
        						'$perg12',
        						'$perg13',
        						'$perg14',
        						'$perg15',
        						'$perg16',
        						'$perg17',
        						'$perg18',
        						'$perg19',
        						'$perg20',
        						'$perg21',
        						'$perg22',
        						'$perg23',
        						'$perg24',
        						'$perg25',
        						'$perg26',
        						'$perg27',
        						'$perg28',
        						'$perg29',
        						'$perg30',
        						'$perg31',
        						'$perg32',
        						'$perg33',
        						'$perg34',
        						'$perg35',
        						'$perg36',
        						'$perg37',
        						'$perg38',
        						'$perg39',
        						'$perg40',
        						'$perg41',
        						'$perg42',
        						'$perg43',
        						'$perg44',
        						'$link',
        						'$imagem',
        						'$perg45',
        						'$ficousabendo',
        						'$responsavel',
        						'$lt',
        						'$obs',
        						'$numero',
        						'$complemento',
        						'0',
        						'$obs_interessado',
        						'$rg',
        						'$idanimal',
        						'$feira')";
        						
        		$insert = mysqli_query($connect,$query); 
        		
                if(mysqli_errno($connect) == '0'){
                    
                    $log_file_msg="[cadastropretermo.php] Cadastro inserido na tabela FORM_PRE_ADOCAO. Nome do interessado: ".$adotante." às ".$horaatu."\n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg);  
                    
                    $querymaxid = "SELECT MAX(ID) FROM FORM_PRE_ADOCAO";
            		$selectmaxid = mysqli_query($connect,$querymaxid); 
            		
            		while ($fetchmaxid = mysqli_fetch_row($selectmaxid)) {
            		    $id = $fetchmaxid[0];
            		}
                    
                    if ($feira == 'Sim'){

                		$subject = "Formulário de pré adoção - Versão feira ";
                		
                		$to = $emailvoluntario;
                		
                		$message = "<html>
                		            <body style='font-family:verdana'>
                		                
                		                <h2>Formulário de pré adoção - Versão feira</h2>
                		                
                		                <h4>DADOS DO ADOTANTE</H4>
                		                <table>
                                            <tr>
                                                <td align='left'>Nome completo </td>
                                                <td align='left'>: ".$adotante."</td>
                                            </tr>
                                            <tr>
                                                <td align='left'>CPF </td>
                                                <td align='left'>: ".$cpf."</td>
                                            </tr>
                                            <tr>
                                                <td align='left'>E-mail </td>
                                                <td align='left'>: ".$email."</td>
                                            </tr>
                                            <tr>
                                                <td align='left'>Profissão </td>
                                                <td align='left'>: ".$profissao."</td>
                                            </tr>
                                        </table>
                		            </body>
                		            </html>
    
                		";
            			
            			/* E-MAIL PARA O RESPONSÁVEL */ 
    
                        $bodytext = $message;
                        
                        $mail->Subject   = $subject;
                        $mail->Body      = $bodytext;
                        $mail->IsHTML(true);
                        $mail->AddAddress($to);
                        if (!$mail->send()) {
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } 
                        
                        $mail->clearAddresses();
                        
                        $log_file_msg="[cadastropretermo.php] Envio de formulário de pré adoção. Nome do interessado: ".$adotante." às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);  
                        
                        
                        echo"<script language='javascript' type='text/javascript'>
                                    alert('Pré termo enviado!'); window.close();</script>";
            			
                    } else {
                
                        if ($emailvoluntario == ''){
                            $emailvoluntario = "operacional@gaarcampinas.org";
                        }
                		
                		    /*echo "<center><h3>Pré termo enviado com sucesso!</h3><br>";
                            echo "<p>Entraremos em contato via telefone, WhatsApp ou e-mail <br><br> <i>OBS: Para garantir que os e-mails cheguem em sua caixa de entrada, sugerimos adicionar o e-mail <strong>operacional@gaarcampinas.org</strong> à lista de remetentes confiáveis. <br>Caso não adicionar, verifique sua caixa de SPAM dentro dos próximos dias</i></p>";
                            echo "<a href='http://gaarcampinas.org' class='btn btn-primary'>Voltar ao site</a></center><br>";*/

                    		/* Voluntários que irão receber os formulários */
                    		
                    		$to = "contato@gaarcampinas.org";
                    		
                    		if ($especie =='Felina') {
                    		    $queryentrevista_gato = "SELECT EMAIL FROM VOLUNTARIOS WHERE ENTREVISTADOR='Gato'";
                                $selectentrevista_gato = mysqli_query($connect,$queryentrevista_gato); 
                                while ($fetchentrevista_gato = mysqli_fetch_row($selectentrevista_gato)) {
                                        $to_bcc_gato = $fetchentrevista_gato[0];
                                        $lista_email .=", ".$to_bcc_gato;
                                        $mail->AddBCC($to_bcc_gato);
                                }
                    		    
                    		} else {
                    		    $queryentrevista_cao = "SELECT EMAIL FROM VOLUNTARIOS WHERE ENTREVISTADOR='Cachorro'";
                                $selectentrevista_cao = mysqli_query($connect,$queryentrevista_cao); 
                                while ($fetchentrevista_cao = mysqli_fetch_row($selectentrevista_cao)) {
                                        $to_bcc_cao = $fetchentrevista_cao[0];
                                        $lista_email .=", ".$to_bcc_cao;
                                        $mail->AddBCC($to_bcc_cao);
                                }
                    		}
                    		$log_file_msg="[cadastropretermo.php] E-mail de notificação enviado para ".$lista_email." às ".$horaatu."\n";
                    		$fp = fopen($log_file, 'a');//opens file in append mode  
                            fwrite($fp, $log_file_msg); 
    		
                			/* se o interessado não estiver reprovado */
                			if ($reccount < '1'){
                			    $message = "
                			             <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br></center>
                			                <p>Um novo formulário de adoção foi recebido em nosso sistema. <br><br> 
                			    
                			                <a href='www.gaarcampinas.org/area/visualizapretermo.php?login=".$login."&idpretermo=".$id."&acesso=email' target='_blank'>Clique aqui para visualizar e responder pré termo número ".$id."</a> <br><br>
                        		
                        		            Ou <br><br> 
                        		            
                        		            1- Acesse a área restrita pelo link http://gaarcampinas.org/area/login.html<br> 
                        		            2- Menu Operacional <br>
                        		            3- Menu Pesquisar pré termo online <br>
                        		           
                                              <table>
                                                        <tr>
                                                            <td align='left'>Nome do animal</td>
                                                            <td align='left'>: ".$nomeanimal."</td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Espécie</td>
                                                            <td align='left'>: ".$especie."</td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Responsável</td>
                                                            <td align='left'>: ".$responsavel."</td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Número</td>
                                                            <td align='left'>: ".$numero."</td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Nome do interessado</td>
                                                            <td align='left'>: ".$adotante."</td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>E-mail</td>
                                                            <td align='left'>: ".$email."</td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Como o interessado ficou sabendo do animal</td>
                                                            <td align='left'>: ".$ficousabendo."</td>
                                                        </tr>
                                              </table>
                                              <br><br>
                                              Por gentileza, responda o pré termo através da área restrita para que haja o registro. <br><br>
                                              
                                              <!--Para responder ao interessado, <br><br> 
                                              
                                              1- Acesse a área restrita pelo link http://gaarcampinas.org/area/login.html<br><br> 
                                              2- Menu Operacional <br><br> 
                                              3- Menu Pesquisar pré termo online <br><br>
                                              4 - Na página de visualização do termo, no final da página clicar no botão Enviar resposta ao interessado.<br><br>-->
                                              
                                              <i><center>É proibida a reprodução, parcial ou total, dos dados pessoais aqui apresentados sem prévia autorização. Todas as informações estão protegidas pela Lei Geral de Proteção de Dados Pessoais (LGPD) - LEI Nº 13.709, DE 14 DE AGOSTO DE 2018. Conheça a lei na íntegra clicando <a href='http://www.planalto.gov.br/ccivil_03/_Ato2015-2018/2018/Lei/L13709.htm' target='_blank'>aqui</a>. </center> </i></p>";
                                              
                			} else {
                			    
                			    /* se o interessado estiver reprovado */
                			    
                			    $queryupdate = "UPDATE FORM_PRE_ADOCAO
                    		                    SET REPROVADO = 'Sim'
                    		                    WHERE CPF='$cpf' OR (CEP ='$cep' AND NUMERO='$numero')";
    		                    
    		                    $update = mysqli_query($connect,$queryupdate);
    		    
                			    $message = "
                			                <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br></center>
                			                <p>Um novo formulário de adoção de um reprovado foi recebido em nosso sistema. <br><br> 
        		
                        		            <font color='red'><strong>ATENÇÃO! Esse interessado consta como reprovado em nosso sistema</strong></font><br><br>
                        		
                        		            <a href='www.gaarcampinas.org/area/visualizapretermo.php?login=".$login."&idpretermo=".$id."&acesso=email' target='_blank'>Clique aqui para visualizar e responder pré termo número ".$id."</a> <br><br>
                        		
                        		            Ou <br><br> 
                        		            
                        		            1- Acesse a área restrita pelo link http://gaarcampinas.org/area/login.html<br> 
                        		            2- Menu Operacional <br>
                        		            3- Menu Pesquisar pré termo online <br>
                        		            
                                              <table>
                                                        <tr>
                                                            <td align='left'>Nome do animal</td>
                                                            <td align='left'>: ".$nomeanimal."</td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Espécie</td>
                                                            <td align='left'>: ".$especie."</td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Responsável</td>
                                                            <td align='left'>: ".$responsavel."</td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Número</td>
                                                            <td align='left'>: ".$numero."</td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Nome do interessado</td>
                                                            <td align='left'>: ".$adotante."</td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>E-mail</td>
                                                            <td align='left'>: ".$email."</td>
                                                        </tr>
                                                        <tr>
                                                            <td align='left'>Como o interessado ficou sabendo do animal</td>
                                                            <td align='left'>: ".$ficousabendo."</td>
                                                        </tr>
                                              </table>
                                              <br><br>
                                              Por gentileza, responda o pré termo através da área restrita para que haja o registro. <br><br>
                                              
                                              <!--Para responder ao interessado, <br><br> 
                                              
                                              1- Acesse a área restrita pelo link http://gaarcampinas.org/area/login.html<br><br> 
                                              2- Menu Operacional <br><br> 
                                              3- Menu Pesquisar pré termo online <br><br>
                                              4 - Na página de visualização do termo, no final da página clicar no botão Enviar resposta ao interessado.<br><br>-->
                                              
                                              <i><center>É proibida a reprodução, parcial ou total, dos dados pessoais aqui apresentados sem prévia autorização. Todas as informações estão protegidas pela Lei Geral de Proteção de Dados Pessoais (LGPD) - LEI Nº 13.709, DE 14 DE AGOSTO DE 2018. Conheça a lei na íntegra clicando <a href='http://www.planalto.gov.br/ccivil_03/_Ato2015-2018/2018/Lei/L13709.htm' target='_blank'>aqui</a>. </center> </i></p>";
                			    
                			}
                    	
                    		$subject = "Novo formulário de pré adoção recebido para o animal ".$nomeanimal;
                    		
                    		/* E-MAIL PARA O RESPONSÁVEL */ 
    
                            $bodytext = $message;
                            
                            $mail->Subject   = $subject;
                            $mail->Body      = $bodytext;
                            $mail->IsHTML(true);
                            $mail->AddAddress($to);
                            if (!$mail->send()) {
                                echo 'Mailer Error: ' . $mail->ErrorInfo;
                            } 
                            $mail->clearAddresses();
                            
                            $log_file_msg="[cadastropretermo.php] Envio de formulário de pré adoção. Nome do interessado: ".$adotante." às ".$horaatu."\n";
                            $fp = fopen($log_file, 'a');//opens file in append mode  
                            fwrite($fp, $log_file_msg);  
                            fclose($fp); 
                    
                    		/*Envio de resposta ao interessado */
                    		
                    		$to = $email;
                    					
                    		$message = "Olá ".$adotante." ! <br><br> Recebemos seu formulário de interesse em adotar um animal sob nossa responsabilidade. <br><br> Se for aprovado, entraremos em contato via telefone, WhatsApp ou e-mail. <br><br> Verifique sua caixa de SPAM.";		
                    		
                    		$subject = "Recebemos seu formulário de interesse!";
                    		
                    		/* E-MAIL PARA O RESPONSÁVEL */ 
    
                            $bodytext = $message;
                            
                            $mail->Subject   = $subject;
                            $mail->Body      = $bodytext;
                            $mail->IsHTML(true);
                            $mail->AddAddress($to);
                            if (!$mail->send()) {
                                echo 'Mailer Error: ' . $mail->ErrorInfo;
                            } else {
                                echo"<script language='javascript' type='text/javascript'>
                                    window.close();</script>";
                            }
                            $mail->clearAddresses();
                            
                            $log_file_msg="[cadastropretermo.php] Envio de resposta ao interessado. Nome do interessado: ".$adotante." às ".$horaatu."\n";
                            $fp = fopen($log_file, 'a');//opens file in append mode  
                            fwrite($fp, $log_file_msg);  
                            fclose($fp); 
                            
                            echo"<script language='javascript' type='text/javascript'>
                                    alert('Pré termo enviado!');window.close();</script>";
                		
                	} 	
                	
                } else {
                	    
                    		$to = "thaise.piculi@gmail.com";
                    		
                    		$subject = "[GAAR Campinas] Falha no cadastro do pré termo ";
        		
                    		$message = "<p><h4>FALHA NO CADASTRO DO PRÉ TERMO</h4>
                                        <br>
                                          <table>
                                                    <tr>
                                                        <td align='left'>Nome</td>
                                                        <td align='left'>: ".$adotante."</td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left'>E-mail</td>
                                                        <td align='left'>: ".$email."</td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left'>Celular</td>
                                                        <td align='left'>: ".$celular."</td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left'>Nome do animal</td>
                                                        <td align='left'>: ".$nomeanimal."</td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left'>Espécie</td>
                                                        <td align='left'>: ".$especie."</td>
                                                    </tr>
                                          </table>
                                          <br><br>
                                            Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."
                                          </p>
                    		";
                		
                		/* E-MAIL PARA O RESPONSÁVEL */ 
    
                        $bodytext = $message;
                        
                        $mail->Subject   = $subject;
                        $mail->Body      = $bodytext;
                        $mail->IsHTML(true);
                        $mail->AddAddress($to);
                        if (!$mail->send()) {
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } else {
                            echo"<script language='javascript' type='text/javascript'>
                                window.close();</script>";
                        }
                        $mail->clearAddresses();
                        
                        $log_file_msg="[cadastropretermo.php] Falha no cadastro do pré termo. Nome do interessado: ".$adotante." - Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);  
                        fclose($fp); 
                		
            			echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                        echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                        echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
            	}
        						
                
            }
} else { //CAPTCHA INVALIDO
    echo "<h1>CAPTCHA inválido!</h1>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
}

fclose($fp); 
mysqli_close($connect);
    
?>
   </div>
</main>

<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>