<?php 		
include ("area/conexao.php");

$query = "SELECT NOME_ANIMAL FROM ANIMAL WHERE FOTO <> '' AND (DIVULGAR_COMO <> 'Terceiros' AND DIVULGAR_COMO <> 'Esperando aprovação') AND (ADOTADO <> 'Adotado' AND ADOTADO <> 'Óbito') ORDER BY NOME_ANIMAL ASC";
$select = mysqli_query($connect,$query);

$queryfoto = "SELECT * FROM ANIMAL WHERE FOTO <> '' AND (DIVULGAR_COMO <> 'Terceiros' AND DIVULGAR_COMO <> 'Esperando aprovação') AND (ADOTADO <> 'Adotado' AND ADOTADO <> 'Óbito') ORDER BY RAND() LIMIT 12";
$selectfoto = mysqli_query($connect,$queryfoto);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Meta tags Obrigatórias -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    
    <title>GAAR - Quero apadrinhar</title>
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
<main role="main" class="container">
    <div class="starter-template">
       <center>
			<a href="http://www.gaarcampinas.org"><img src="/area/logo_transparent.png" width="70" height="70"></a><br>
            <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Apadrinhe um animal abandonado</h1><br>
            <p>O apadrinhamento é um ato de amor que ajuda a manter uma vida enquanto o animal espera por sua família definitiva. As despesas que temos mantendo todos os animais assistidos são altas, portanto sua doação serve para que o GAAR tenha condições de ajudar tantos outros que ainda estão em condições de abandono nas ruas. <br>
            
            Além disso, vários animais esperam sua adoção por muito tempo, e alguns têm pouca chance de ser adotados, por motivos como idade, tamanho e aparência, inclusive preconceito contra sua cor. Eles também merecem ter alguém que se importe com eles, e o apadrinhamento é uma forma de isso acontecer. <br>
            
            Contribuindo mensalmente com um valor estipulado por você para o animal de sua escolha, podemos custear medicamentos, ração, castração e cirurgia para o seu "afilhado" de quatro patas. Você recebe um relatório sobre o animal, te atualizando e oferecendo a oportunidade de ter contato real com ele. <br>
            
            Se você gostaria de adotar mas por algum motivo não pode, ama animais e quer ajudá-los, essa é uma grande chance que o GAAR proporciona para que possamos fazer a diferença JUNTOS.</p>

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
            			                <figure><img src='/pets/".$foto."' alt='Avatar' class='image'></figure>
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
            <p>A gente te ajuda a encontrar seu novo apadrinhado ;) Use o critério de buscas abaixo ou então é só clicar em Pesquisar. </p><br>
            <form action="pesquisapet.php" method="POST" enctype="multipart/form-data" name="form" onSubmit="return validar()">
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
                 	 <br>
                 	 <p>Ou pesquise apenas pelo nome do animal:</p>
                 	    <select class="form-control" id="inlineFormCustomSelect" name="nome">
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
        <a href="javascript:form.submit()" class="btn btn-button">Pesquisar</a><br><br></center>
        <input type="text" name="apadrinhar" id="apadrinhar" value="apadrinhar" hidden>
    </form>
</div>
</main>
<br><br>
<footer class="footer fixed-bottom bg-light">
      <div class="container">
        <p class="text-center">GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
      </div>
</footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>