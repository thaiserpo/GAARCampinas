<?php 		
include ("area/conexao.php");

$query = "SELECT NOME_ANIMAL FROM ANIMAL WHERE DIVULGAR_COMO ='GAAR' and ADOTADO = 'Disponível' and FOTO <> '' ORDER BY NOME_ANIMAL ASC";
$select = mysqli_query($connect,$query);

$queryfoto = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO ='GAAR' and ADOTADO = 'Disponível' and FOTO <> '' ORDER BY RAND() LIMIT 12";
$selectfoto = mysqli_query($connect,$queryfoto);

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
    
    <title>GAAR - Quero adotar</title>
    <script type="text/javascript" >
                  	function OnChangeRadio (radio) {
                                        document.getElementById('Pequeno').disabled  = true;
                                        document.getElementById('Médio').disabled  = true;
                                        document.getElementById('Grande').disabled  = true;
                    }
                    
                    function OnChangeRadio2 (radio) {
                                        document.getElementById('Pequeno').disabled  = false;
                                        document.getElementById('Médio').disabled  = false;
                                        document.getElementById('Grande').disabled  = false;
                                        
                                        if (document.getElementById('nomeanimal').checked == true) {
                                            document.getElementById('nomeanimal').checked = false;
                                        } else
                                        
                    }
			
              </script>
   <script src='https://www.google.com/recaptcha/api.js' async defer></script>
   <style>
        .containerimage {
            position: relative;
            width: 100%;
        }
        
        .image {
            display: block;
            width: 100%;
            height: 100%;
        }
        
        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
            background-color: #2d5ff5;
        }
        
        .text {
            color: #FFFFFF;
            font-size: 25px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
            opacity: 1;
            font-weight: bold;
            font-style: normal;
        }
        
        .containerimage:hover .overlay {
            opacity: 0.75;
        }
    </style>
    <!--- GOOGLE ADSENSE --->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
    <!--- GOOGLE ADSENSE --->
</head>
<body>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
     crossorigin="anonymous"></script>
<!-- Anúncios 1 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5848149407283988"
     data-ad-slot="4700026599"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<main role="main" class="container">
    <div class="starter-template">
       <center>
			<a href="http://www.gaarcampinas.org"><img src="/area/logo_transparent.png" width="70" height="70"></a><br>
            <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Amor não se compra, se adota</h1><br>
            <p>A expectativa de vida de um cão ou gato é de aproximadamente 15 anos e ele precisarão de sua proteção e atenção até a velhice ou em uma eventual doença. Adoção é assunto sério!</p>

        </center>
            <div class="container">

                  <h2 class="font-weight-light text-center text-lg-left mt-4 mb-0">Conheça alguns de nossos animais</h2>
                
                  <hr class="mt-2 mb-5">

                <div class="row text-center text-lg-left">

                <?
                    while ($fetchfoto = mysqli_fetch_row($selectfoto)) {
                        echo "<div class='col-lg-3 col-md-4 col-6'>";
                            $id = $fetchfoto[0];
            			    $nomedoanimal = $fetchfoto[1];
            			    $obs = $fetchfoto[15];
            			    $foto = $fetchfoto[16];

            			    echo "<div class='containerimage'>
            			            <div>
                			            <a href='pet.php?id=".$id."' class='d-block mb-4 h-100' target='_blank'>
            			                <figure><img src='/pets/".$id."/".$foto."' alt='Avatar' class='image'></figure>
            			                <div class='overlay'>
                                            <div class='text'>".$nomedoanimal."</div>
                                        </div>
                			            </a>
                    			    </div>
                                  </div>";
            			echo "</div>";
        	        }
                ?>
                </div>
                <hr class="mt-2 mb-5">
            </div>
        <br>
            <p>Use o critério de busca abaixo ou pesquise apenas pelo nome do animal (não é necessário selecionar espécie, sexo e porte). </p><br>
            <form action="pesquisapet.php" method="POST" enctype="multipart/form-data" name="form" onSubmit="return validar()" target="_blank">
                      <p>Espécie: </p>
                           <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' onclick='OnChangeRadio2 (this)'>Canina
                           </div>
                           <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' onclick='OnChangeRadio (this)'>Felina
                           </div>
                      
                      <br>
                      <p>Sexo: </p>
                           <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='sexo' id='Fêmea' value='Fêmea' onclick='OnChangeRadio (this)' >Fêmea
                           </div>
                           <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='sexo' id='Macho' value='Macho' onclick='OnChangeRadio2 (this)'>Macho
                           </div>
                           
                      <br>
                      <p>Porte: </p>
                           <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno' onclick='OnChangeRadio (this)' >Pequeno (até 12kg)
                           </div>
                           <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio' onclick='OnChangeRadio2 (this)'>Médio (de 13kg a 25kg)
                           </div>
                           <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande' onclick='OnChangeRadio2 (this)'>Grande (acima de 25kg)
                           </div>
                           
                     <br>
                     <p>Características: </p>
                           <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='apto' id='aptoSim' value='Sim' onclick='OnChangeRadio (this)' >Vive bem em apartamento
                           </div>
                           <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='apto' id='aptoNão' value='Não' onclick='OnChangeRadio2 (this)'>Vive bem em casa
                           </div>
                           <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='apto' id='aptoNA' value='' onclick='OnChangeRadio2 (this)'>Não tenho preferência
                           </div>
                     <br>
                    <!-- <p>Idade: </p>
                           <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='idade' id='0-6m' value='0-6m' onclick='OnChangeRadio (this)' >Até 6 meses
                           </div>
                           <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='idade' id='6-12m' value='6-12m' onclick='OnChangeRadio2 (this)'>Entre 6 a 12 meses
                           </div>
                           <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='idade' id='1-2a' value='1-2a' onclick='OnChangeRadio2 (this)'>Entre 1 a 2 anos
                           </div>
                           <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='idade' id='2-4a' value='2-4a' onclick='OnChangeRadio2 (this)'>Entre 2 a 4 anos
                           </div>
                           <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='idade' id='4-6a' value='4-6a' onclick='OnChangeRadio2 (this)'>Entre 4 a 6 anos
                           </div>
                           <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='idade' id='6+' value='6+' onclick='OnChangeRadio2 (this)'>Acima de 6 anos
                           </div>
                     -->
                 	 <p>_____________________________________________</p>
                 	 
                 	 <p>Nome do animal:</p>
                 	    <select class="form-control" id="nome" name="nome">
                 	        <option selected value="" selected>Selecione</option>
                 	 <? 
                 	    while ($fetch = mysqli_fetch_row($select)) {
                 	        $nomedoanimal = $fetch[0];
                 	        echo "<option value='".$nomedoanimal."'>".$nomedoanimal."</option>";
                 	    } 
                 	 ?>
                 	    </select>
  <br>
                <?
                    require_once('recaptchalib.php');
                    $publickey = "6LfAi70UAAAAAAQnjIdoJz4Z8oCBOs9WsiUBVe70"; // you got this from the signup page
                    /*echo recaptcha_get_html($publickey);*/
                ?>
        <br>
        <a href="javascript:form.submit()">Pesquisar</a><br><br></center>
    </form>
</div>
</main>
</body>
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
<!--- BOOTSTRAP --->
</body>
</html>