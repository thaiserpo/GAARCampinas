<?php 		
include ("area/conexao.php");

/* GOOGLE RECAPTCHA */
include ("recaptchalib.php");
/* GOOGLE RECAPTCHA */
		
$idanimal = $_GET['id'];
$data_atu = date("Y-m-d");
		
$query = "SELECT * FROM ANIMAL WHERE ID = '$idanimal' ORDER BY ID DESC";
$select = mysqli_query($connect,$query);

while ($fetch = mysqli_fetch_row($select)) {
			$idanimal = $fetch[0];	
			$nomedoanimal = $fetch[1];
			$idade = $fetch[3];
			$especie = $fetch[2];
			$porte = $fetch[6];
			$sexo = $fetch[4];
			$castracao = $fetch[7];
			$vacinacao = $fetch[9];
			$status = $fetch[10];
			$obs= $fetch[15];
			$foto = $fetch[16];
			$foto_2 = $fetch[31];
			$foto_3 = $fetch[32];
			$foto_4 = $fetch[33];
			$peso = $fetch[28];
			$perfil_outrosanimais = $fetch[34];
            $perfil_criancas = $fetch[35];
            $perfil_apto = $fetch[36];
            $obs_apadrinha = $fetch[39];
            $video = $fetch[41];
            $divulgar_como = $fetch[18];
            $resp = $fetch[12];
	        $email = $fetch[17];
	        $idade_jul = $fetch[29];
	        $fivfelv = $fetch[47];
			
			$ano_nascimento = substr($idade,0,4);
		    $mes_nascimento = substr($idade,5,2);
		    $dia_nascimento = substr($idade,8,2);
		    
		    //$idade = $dia_nascimento."/".$mes_nascimento."/".$ano_nascimento;
}
		
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta http-equiv="Content-Type" charset="utf-8"/>
    <!-- Meta tags Obrigatórias -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">

    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/auto-refresh/bootstrap-table-auto-refresh.min.js"></script>
    <!--- BOOTSTRAP 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--- BOOTSTRAP --->
    <!-- Bootstrap 5.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <!-- Bootstrap 5.1 -->
    <title>GAAR - <? echo $nomedoanimal ?> quer um lar</title>
    <!--- GOOGLE ADSENSE --->
     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
     <!--- GOOGLE ADSENSE --->
     
</head>

<body background="https://gaarcampinas.org/area/imagens/background-pet.png" text="white"> 
<main role="main" class="container">
    <div class="starter-template">
            <!-- Load Facebook SDK for JavaScript 
          <div id="fb-root"></div>
              <script>
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                    fjs.parentNode.insertBefore(js, fjs);
                  }(document, 'script', 'facebook-jssdk'));
              </script>
              
                <!-- botão compartilhar do facbook -->
        <div id="content" class="site-content">
    	    <div id="inner-content-wrapper" class="wrapper page-section">        
                <center>
                    <a href="gaarcampinas.org/quero-adotar/"><img src="/area/imagens/logo-branco.png" width="10%" height="10%"></a>
                    <p><font color="white">Grupo de Apoio ao Animal de Rua - Campinas/SP</p></font>
                </center>
            </div>
        </div>
                            
    <br>
    <h1 class="mt-4"><center><font color="white"><? echo $nomedoanimal?></center></h1></font>
    
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true" >
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active ">
                    <a href="/pets/<?echo $idanimal."/".$foto?>" target='_blank'><img src="/pets/<?echo $idanimal."/".$foto?>" class="d-block w-100" alt="..."></a>
            </div>
            <div class="carousel-item">
                    <a href="/pets/<?echo $idanimal."/".$foto_2?>" target='_blank'><img src="/pets/<?echo $idanimal."/".$foto_2?>" class="d-block w-100" alt="..."></a>
            </div>
            <div class="carousel-item">
                    <a href="/pets/<?echo $idanimal."/".$foto_3?>" target='_blank'><img src="/pets/<?echo $idanimal."/".$foto_3?>" class="d-block w-100" alt="..."></a>
            </div>
            <div class="carousel-item">
                    <a href="/pets/<?echo $idanimal."/".$foto_4?>" target='_blank'><img src="/pets/<?echo $idanimal."/".$foto_4?>" class="d-block w-100" alt="..."></a>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
    </div>
    </div>
        
    <center><font color='white'><i>Clique na foto para ampliar, deslize para ver mais.</i> <br><br> </center>
    <?
    /*echo " <table class='table'>
            <tr>
                <td><figure><a href='/pets/".$foto."' target='_blank'><img src='/pets/".$foto."' class='img-fluid' /></a></figure></td>";
                if ($foto_2 != ''){ 
                    echo "<td><figure><a href='/pets/".$foto_2."' target='_blank'><img src='/pets/".$foto_2."' class='img-fluid' /></a></figure></td>";
                } 
                if ($foto_3 != ''){ 
                    echo "<td><figure><a href='/pets/".$foto_3."' target='_blank'><img src='/pets/".$foto_3."' class='img-fluid' /></a></figure></td>";
                }
                if ($foto_4 != ''){ 
                    echo "<td><figure><a href='/pets/".$foto_4."' target='_blank'><img src='/pets/".$foto_4."' class='img-fluid' /></a></figure></td>";
                }
echo "      </tr>
          </table>";*/
            
    ?>
    </div>
<?
    /*if ($video <> '0') {
        echo "<div class='embed-responsive embed-responsive-16by9 d-block'>
                <iframe class='embed-responsive-item' src='".$video."' allowfullscreen></iframe>
              </div>";
    } else {
        echo "<div class='embed-responsive embed-responsive-16by9 d-none'>
              </div>";
    }*/
?>
	<div id="content" class="site-content">
    	<div id="inner-content-wrapper" class="wrapper page-section">
                        <p><? 
                            if ($status == "Adotado" || $status== "Adotado (sem termo)") {
                                echo "<center><h2 style='color:white'> Já ganhei um lar :) </h2></center>";
                            } else {
                                $macho = false;
                                $femea = false;
                                if ($divulgar_como == 'GAAR') {
                                    if ($video <> '0') {
                                        if ((strpos($video, 'instagram') !== false)) {
                                            echo "<center><blockquote class='instagram-media' data-instgrm-permalink='".$video."?utm_source=ig_embed&amp;utm_campaign=loading' data-instgrm-version='14' style=' background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);'><div style='padding:16px;'> <a href='https://www.instagram.com/reel/CmAEv_xgYSI/?utm_source=ig_embed&amp;utm_campaign=loading' style=' background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;' target='_blank'> <div style=' display: flex; flex-direction: row; align-items: center;'> <div style='background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;'></div> <div style='display: flex; flex-direction: column; flex-grow: 1; justify-content: center;'> <div style=' background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;'></div> <div style=' background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;'></div></div></div><div style='padding: 19% 0;'></div> <div style='display:block; height:50px; margin:0 auto 12px; width:50px;'><svg width='50px' height='50px' viewBox='0 0 60 60' version='1.1' xmlns='https://www.w3.org/2000/svg' xmlns:xlink='https://www.w3.org/1999/xlink'><g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><g transform='translate(-511.000000, -20.000000)' fill='#000000'><g><path d='M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631'></path></g></g></g></svg></div><div style='padding-top: 8px;'> <div style=' color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;'>View this post on Instagram</div></div><div style='padding: 12.5% 0;'></div> <div style='display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;'><div> <div style='background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);'></div> <div style='background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;'></div> <div style='background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);'></div></div><div style='margin-left: 8px;'> <div style=' background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;'></div> <div style=' width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)'></div></div><div style='margin-left: auto;'> <div style=' width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);'></div> <div style=' background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);'></div> <div style=' width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);'></div></div></div> <div style='display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;'> <div style=' background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;'></div> <div style=' background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;'></div></div></a><p style=' color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;'><a href='https://www.instagram.com/reel/CmAEv_xgYSI/?utm_source=ig_embed&amp;utm_campaign=loading' style=' color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;' target='_blank'>A post shared by GAAR Campinas 🐾 (@gaarcampinas)</a></p></div></blockquote> <script async src='//www.instagram.com/embed.js'></script></center>";
                                        } else {
                                            echo "<div class='embed-responsive embed-responsive-16by9 d-block'>
                                                <iframe class='embed-responsive-item' src='".$video."' allowfullscreen></iframe>
                                              </div>";   
                                        }
                                    }   
                                    if ($sexo == 'Macho') {
                                        $macho = true;
                                        $temp = "doado";
                                    } else {
                                        $femea = true;
                                        $temp = "doada";
                                    }
                                    
                                    if ($vacinacao == 'Sim'){
                                        if ($macho == true) {
                                            $vacinado = 'Estou vacinado';  
                                        } else {
                                            $vacinado = 'Estou vacinada';
                                        }
                                    } else{ 
                                        if ($macho == true) {
                                            $vacinado = 'Não estou vacinado';  
                                        } else {
                                            $vacinado = 'Não estou vacinada';
                                        }
                                    }
                                    
                                    if ($perfil_outrosanimais == 'Sim'){
                                        $perfil_outrosanimais="Convivo bem com outros animais";
                                    } else {
                                        $perfil_outrosanimais="Não convivo bem com outros animais";
                                    }
                                    
                                    if ($perfil_criancas == 'Sim'){
                                         $perfil_criancas="Convivo bem com crianças";
                                    } else {
                                         $perfil_criancas = "Não convivo bem com crianças";
                                    }
                                    
                                    if ($perfil_apto == 'Sim'){
                                        $perfil_apto="Vivo bem em apartamento";
                                        $texto_doacao = "viver em casas que não tenham rota de fuga ou apartamentos telados.";
                                    } else {
                                        $perfil_apto="Não vivo bem em apartamento";
                                        $texto_doacao = "viver em casas que não tenham rota de fuga.";
                                    }
                                    

                                    $ts1 = strtotime($idade);
                                    $ts2 = strtotime($data_atu);
                                    
                                    $year1 = date('Y', $ts1);
                                    $year2 = date('Y', $ts2);
                                    
                                    $month1 = date('m', $ts1);
                                    $month2 = date('m', $ts2);
                                    
                                    $meses = (($year2 - $year1) * 12) + ($month2 - $month1);
                                    
                                    $idade = round(($meses)/12);
                                    
                                    if ($idade == '1') {
                                        $idade = $idade." ano";
                                    } elseif ($idade > '1') {
                                        $idade = $idade." anos";
                                    } elseif ($idade < '1') {
                                        $idade = $meses." meses";
                                    }
                                    
                                    if ($castracao == 'Sim'){
                                        if ($macho == true) {
                                            $castracao = 'castrado';  
                                        } else {
                                            $castracao = 'castrada';
                                        }
                                    } else{ 
                                       if ($macho == true) {
                                            $castracao = 'não fui castrado ainda por causa da minha idade';  
                                        } else {
                                            $castracao = 'não fui castrada ainda por causa da minha idade';
                                        }
                                    }
                                    
                                    // HISTÓRIA
                                    $textopet .= $obs."<br><br>";
                                    
                                    if ($especie == 'Felina') {
                                        $textopet .= " <p> Mais um pouquinho sobre mim: <br><br>
                                            🔹 Sou ".$sexo." <br>
                                            🔹 ".$vacinado." e ".$castracao." <br>
                                            🔹 ".$fivfelv." <br>
                                            🐾 ".$perfil_outrosanimais."<br>
                                            💙 ".$perfil_criancas."<br>
                                            🏠 ".$perfil_apto." <br>
                                            🎂 Tenho aproximadamente ".$idade." <br>
                                            🔹 Só posso ser ".$temp." para ".$texto_doacao."<br><br>
                                            ";
                                        $hashtags = "#adotecomresponsabilidade #gaarcampinas #adotecampinas #adotarcampinas #adotenaocompre #naocompreadote #gatos #gatosfofos #adoteumgatinho #adoteumpet #adoteumamigo #semra�0�4adefinida";
                                    } else {
                                        $textopet .= " <p> Mais um pouquinho sobre mim: <br><br>
                                            🔹 Sou ".$sexo." e porte ".strtolower($porte)." <br>
                                            🔹 Peso aproximadamente ".$peso." kg <br>
                                            🔹 ".$vacinado." e ".$castracao." <br>
                                            🐾 ".$perfil_outrosanimais."<br>
                                            💙 ".$perfil_criancas."<br>
                                            🏠 ".$perfil_apto." <br>
                                            🎂 Tenho aproximadamente ".$idade." <br>
                                            🔹 Só posso ser ".$temp." para ".$texto_doacao."<br><br>
                                            ";
                                        $hashtags = "#adotecomresponsabilidade #gaarcampinas #adotecampinas #adotarcampinas #adotenaocompre #naocompreadote #cachorros #cachorrosfofos #adoteumcachorro #adoteumpet #adoteumamigo #semra�0�4adefinida";
                                    }
                                    
                                    
                                    $textopet .= "O que eu preciso do meu padrinho ou minha madrinha: ".$obs_apadrinha."<br><br>";
                                    
                                    echo $textopet;

                                    if ($status != 'Disponível' && $status != 'Adotado' && $status != 'Óbito'){
                					    echo "<a href='http://gaarcampinas.org/area/apadrinhe.php?id=".$idanimal."' target='_blank' class='btn btn-primary'>Quero apadrinhar</a> &nbsp; ";
                					} 
                					if ($status =='Disponível') {
                					   	echo "<a href='http://gaarcampinas.org/area/apadrinhe.php?id=".$idanimal."' target='_blank' class='btn btn-primary'>Quero apadrinhar</a> &nbsp; <a href='http://gaarcampinas.org/pretermo.php?id=".$idanimal."' target='_blank' class='btn btn-primary'>Quero adotar</a> &nbsp; <a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank' class='btn btn-primary'>Link compartilhável</a>&nbsp
                                               <a href='https://api.whatsapp.com/send?text=http://gaarcampinas.org/pet.php?id=".$idanimal."' id='whatsapp-share-btt' rel='nofollow' target='_blank' class='btn btn-primary'>Enviar via WhatsApp</a> &nbsp;
                                                    <div class='fb-share-button'
                                                            data-href='http://gaarcampinas.org/pet.php?id=".$idanimal."'  data-layout='button_count'>
                                                          </div>
                                                        <small class='text-muted'></small>
                					    "; 
                					}
                                    echo "</tr>";
                                    echo "<!-- Your share button code -->
                                              <div class='fb-share-button' 
                                                data-href='http://gaarcampinas.org/pet.php?id=".$idanimal."' 
                                                data-layout='button_count'>
                                              </div>";
            					} 
            					else { //Não é animal do GAAR
            					    if ($sexo == 'Macho') {
                                        $macho = true;
                                        $temp = "doado";
                                    } else {
                                        $femea = true;
                                        $temp = "doada";
                                    }
                                    
                                    if ($vacinacao == 'Sim'){
                                        if ($macho == true) {
                                            $vacinado = 'Estou vacinado';  
                                        } else {
                                            $vacinado = 'Estou vacinada';
                                        }
                                    } else{ 
                                        if ($macho == true) {
                                            $vacinado = 'Não estou vacinado';  
                                        } else {
                                            $vacinado = 'Não estou vacinada';
                                        }
                                    }
                                    
                                    if ($perfil_outrosanimais == 'NÃO'){
                                        $perfil_outrosanimais="Não convivo bem com outros animais";
                                    } else {
                                        $perfil_outrosanimais="Convivo bem com outros animais";
                                    }
                                    
                                    if ($perfil_criancas == 'NÃO'){
                                         $perfil_criancas = "Não convivo bem com crianças";
                                    } else {
                                        $perfil_criancas="Convivo bem com crianças";
                                    }
                                    
                                    if ($perfil_apto == 'Sim'){
                                        $perfil_apto="Vivo bem em apartamento";
                                        $texto_doacao = "viver em casas que Não tenham rota de fuga ou apartamentos telados.";
                                    } else {
                                        $perfil_apto="Não vivo bem em apartamento";
                                        $texto_doacao = "viver em casas que Não tenham rota de fuga.";
                                    }
                                    

                                    $ts1 = strtotime($idade);
                                    $ts2 = strtotime($data_atu);
                                    
                                    $year1 = date('Y', $ts1);
                                    $year2 = date('Y', $ts2);
                                    
                                    $month1 = date('m', $ts1);
                                    $month2 = date('m', $ts2);
                                    
                                    $meses = (($year2 - $year1) * 12) + ($month2 - $month1);
                                    
                                    $idade = round(($meses)/12); 
                                    
                                    if ($idade < '12') {
                                        $idade = $meses." meses";
                                    } 
                                    if ($idade == '12') {
                                        $idade = substr($idade,0,1)." ano";
                                    } 
                                    if ($idade > '12') {
                                        $idade = substr($idade,0,1)." anos";
                                    }
                                    
                                    if ($castracao == 'Sim'){
                                        if ($macho == true) {
                                            $castracao = 'castrado';  
                                        } else {
                                            $castracao = 'castrada';
                                        }
                                    } else{ 
                                       if ($macho == true) {
                                            $castracao = 'Não fui castrado ainda por causa da minha idade';  
                                        } else {
                                            $castracao = 'Não fui castrada ainda por causa da minha idade';
                                        }
                                    }
                                    
                                    // HISTÓRIA
                                    $textopet .= $obs."<br><br>";
                                    
                                    if ($especie == 'Felina') {
                                        $textopet .= " <p> Mais um pouquinho sobre mim: <br><br>
                                            Sou ".$sexo." <br>
                                            ".$vacinado." e ".$castracao." <br>
                                            ".$perfil_outrosanimais."<br>
                                            ".$perfil_criancas."<br>
                                            ".$perfil_apto." <br>
                                            Tenho aproximadamente ".$idade." <br>
                                            Sé posso ser ".$temp." para ".$texto_doacao."<br><br>
                                            ";
                                    } else {
                                        $textopet .= " <p> Mais um pouquinho sobre mim: <br><br>
                                            Sou ".$sexo." e porte ".strtolower($porte)." <br>
                                            Peso aproximadamente ".$peso." kg <br>
                                            ".$vacinado." e ".$castracao." <br>
                                            ".$perfil_outrosanimais."<br>
                                            ".$perfil_criancas."<br>
                                            ".$perfil_apto." <br>
                                            Tenho aproximadamente ".$idade." <br>
                                            Sé posso ser ".$temp." para ".$texto_doacao."<br><br>
                                            ";
                                    }
                                    $textopet .= "<p> Contato: ".$resp." - ".$email."";
                                    $textopet .= "<h3> ATENÇÃO! A ONG esté apenas ajudando na divulgação. Não é animal do GAAR.</h3";
                                    
            					    
            					}
        					
                            }
                            
                        ?><br></p>
        </div>
    </div>
    </font>
</main>

<?
mysqli_close($connect);
?>

<br>
<!--<footer class="footer fixed-bottom bg-light">
      <div class="container">
        <p class="text-center">GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
      </div>
    </footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>-->
<!--- BOOTSTRAP --->
</body>
