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
    
    <title>GAAR - Cadastro de pré termo</title>
    
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">
        <br>
        <center><img src="/area/logo_transparent.png" width="70" height="70"></center>
        <br>
<?

/*  require_once('recaptchalib.php');
  $privatekey = "6LfAi70UAAAAAG6UBcbbaBaYF8IdPBCir6yKhw6a";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
  } else {*/

        $adotante = $_POST['adotante'];
        $rg = $_POST['rg'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $endereco = $_POST['endereco'];
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
        $perg39 = $_POST['perg39'];
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
        $feira = $_POST['feira'];
        $voluntario = $_POST['nomevoluntario'];

        $queryreprova = "SELECT EMAIL, CPF, CEP, NUMERO FROM REPROVADOS WHERE EMAIL='$email' AND CPF='$cpf' OR (CEP ='$cep' AND NUMERO='$numero')";
        $selectreprova = mysqli_query($connect,$queryreprova); 
        $reccount = mysqli_num_rows($selectreprova);
        
        if ($idanimalfelina != ''){
            echo "<br> id felina";
            $idanimal = $idanimalfelina;
        } else if ($idanimalcanina != ''){
            echo "<br> id canina";
            $idanimal = $idanimalcanina;
        } else {
            $idanimal = 0;
        }
        
        echo "<br> idanimal=".$idanimal;
        
        $querypet= "SELECT * FROM ANIMAL WHERE ID='$idanimal' ";
        $selectpet = mysqli_query($connect,$querypet);
            
        while ($fetchpet = mysqli_fetch_row($selectpet)) {
            $nomeanimal = $fetchpet[1];
            $especie = $fetchpet[2];
            $lt =  $fetchpet[11];
            $responsavel = $fetchpet[12];
            $pelagem = $fetchpet[5];
            $sexo = $fetchpet[4];
            
            if ($especie == ''){
               $nomeanimal = "Animal não definido";
               $especie = "Espécie não definida"; 
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
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($endereco == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu endereço completo</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($numero == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o número de sua casa</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($bairro == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu bairro</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($cep == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu CEP</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($cidade == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha a sua cidade</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($cpf == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu CPF</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($profissao == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha a sua profissão</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($celular == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu celular</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($email == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Preencha o seu e-mail</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg1 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 1</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg2 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 2</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg3 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 3</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg4 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 4</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg5 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 5</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg6 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 6</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg7 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 7</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg8 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 8</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg9 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 9</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg10 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 10</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg11 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 11</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg12 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 12</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg13 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 13</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg14 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 14</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg15 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 15</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg16 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 16</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg17 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 18</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg20 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 17</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg21 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 19</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg22 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 20</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg23 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 21</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg24 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 22</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg25 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 23</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg26 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 26</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg27 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 27</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg28 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 28</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg29 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 29</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg30 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 28</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg31 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 29</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg32 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 30</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg33 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 31</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg34 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 32</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg35 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 33</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg36 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 34</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg37 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 37</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg38 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 38</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg39 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 39</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg40 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 40</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg41 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 41</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg42 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 42</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg43 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 43</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else if ($perg44 == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                echo "<p>Responda a pergunta 44</p><br>";
                echo "<a href='http://gaarcampinas.org/pretermo.php' class='btn btn-primary'>Voltar</a></center><br>";
            } else {
                
                ini_set('display_errors', 1);
                
                error_reporting(E_ALL);
                
                $queryvoluntario = "SELECT NOME, EMAIL, USUARIO FROM VOLUNTARIOS WHERE NOME='".$responsavel."'";
                $selectvoluntario = mysqli_query($connect,$queryvoluntario); 
                
                while ($fetchvoluntario = mysqli_fetch_row($selectvoluntario)) {
                        $nomevoluntario = $fetchvoluntario[0];
                        $emailvoluntario = $fetchvoluntario[1];
                        $login = $fetchvoluntario[2];
                    }
            
                if ($feira == 'Sim'){
                    $obs = "Respondido em feira - voluntário que entrevistou: ".$nomevoluntario;
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
        						RG)
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
        						'$rg')";
        						
                
            }
    
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