<?php 		
include ("area/conexao.php");

/* GOOGLE RECAPTCHA */
include ("recaptchalib.php");
/* GOOGLE RECAPTCHA */
		
		$especie = $_POST['especie'];
		$sexo = $_POST['sexo'];
		$cor = $_POST['cor'];
		$porte = $_POST['porte'];
		$idade = $_POST['idade'];
		
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    
<?
	        /*echo "<br> id animal: ".$idanimal;
	        echo "<br> nome animal: ".$nomedoanimal;
	        echo "<br> foto: ".$foto;*/
	    
		    echo "<meta property='og:url'           content='http://gaarcampinas.org/pet.php?id=".$id."' />
                  <meta property='og:type'          content='website' />";
            
            if ($sexo =='Fêmea'){
                echo " <meta property='og:title'         content='Adote a ".$nomeanimal."' />";
            }else {
                echo " <meta property='og:title'         content='Adote o ".$nomeanimal."' />";
            }
            
            echo "<meta property='og:description'   content='".$obs."' />
                  <meta property='og:image'         content='http://gaarcampinas.org/pets/".$foto."' />"; 
?>	
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<title>GAAR Campinas - Anúncios de terceiros</title>
		
		    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <!-- GOOGLE ADSENSE -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988" crossorigin="anonymous"></script> <br>
    <!-- GOOGLE ADSENSE -->
</head>
<body>
        <center>
            <img class="mb-4" src="/area/logo_transparent.png" alt="" width="70" height="70"><br>
        <h3> ANÚNCIOS DE TERCEIROS</h3>
        <P>O GAAR não se responsabiliza pelas informações contidas em anúncios de terceiros. Toda informação fornecida é de responsabilidade do anunciante.</p></center><br>
    	<div class="entry-container">
			<div class="entry-content" id="topo">
        		
                <center><a href="#adocao" class="btn btn-primary"> Animais para adoção</a> &nbsp; &nbsp; <a href="#perdidos" class="btn btn-primary"> Animais perdidos</a> &nbsp; &nbsp; <a href="#encontrados" class="btn btn-primary"> Animais encontrados</a></center>
                    <br>
                

<?

		$queryperdido = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO ='Terceiros' and TIPO_ANUNCIO = 'Perdido' and ADOTADO <> 'Adotado'";
		$selectperdido= mysqli_query($connect,$queryperdido);
		$reccountperdido = mysqli_num_rows($selectperdido);
		
		$querydoacao = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO ='Terceiros' and TIPO_ANUNCIO = 'Doação' and ADOTADO <> 'Adotado'";
		$selectdoacao= mysqli_query($connect,$querydoacao);
		$reccountdoacao = mysqli_num_rows($selectdoacao);
		
		$queryencontrado = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO ='Terceiros' and TIPO_ANUNCIO = 'Encontrado' and ADOTADO <> 'Adotado'";
		$selectencontrado= mysqli_query($connect,$queryencontrado);
		$reccountencontrado = mysqli_num_rows($selectencontrado);
		
		while ($fetchdoacao = mysqli_fetch_row($selectdoacao)) {
			$id = $fetchdoacao[0];
			$nomeanimal = $fetchdoacao[1];
			$nome = strtoupper($nomeanimal);
			$especie = $fetchdoacao[2];
			$idade = $fetchdoacao[3];
			$sexo = $fetchdoacao[4];
			$porte = $fetchdoacao[6];
			$castrado = $fetchdoacao[7];
			$vacinado = $fetchdoacao[9];
			$historia = $fetchdoacao[15];
			$foto = $fetchdoacao[16];	
			$resp = $fetchdoacao[12];
			$email = $fetchdoacao[17];
		
			if ($especie =='Felina'){
			    $porte = 'N/A';
			}
		    echo "<div class='album py-5 bg-light'>
			       <div class='container'>
			        <div class='row'>
                        <div class='col-md-6'>
                          <div class='card mb-6 shadow-sm'>
						        <img class='card-img-top' src='/pets/".$foto."'/>
						        <div class='card-body'>
                                <p class='card-text'>".$nome." <br>
                                    Espécie: ".$especie."<br>
                                    Sexo: ".$sexo."<br>
                                    Porte: ".$porte."<br>
                                    Data de nascimento aproximada: ".$idade."<br>
                                    Castrado? ".$castrado."<br>
            						Vacinado? ".$vacinado."<br>						
            						".$historia."<br><br>
            						Contato: <br>
            						".$resp."<br>
            						E-mail: ".$email."<br>
			                    </p>
                                  <div class='d-flex justify-content-between align-items-center'>
                                    <div class='btn-group'>
                                      <a href='mailto:".$email."' class='btn btn-primary'>Enviar e-mail</a>
                                     </div>
                                    <div class='btn-group'>
                                      <a href='https://api.whatsapp.com/send?phone=55".$resp."' class='btn btn-primary'>Enviar WhatsApp </a>
                                    </div>
                                    <!-- Your share button code -->
                                      <div class='fb-share-button' 
                                        data-href='http://gaarcampinas.org/pet.php?id=".$id."' 
                                        data-layout='button_count'>
                                      </div>
                                    <small class='text-muted'></small>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <br><center><a href='#topo'>Voltar ao topo</a></center>
                            <br>";
		}	
		
		echo "<h5><center><b><label id='encontrados'>ANIMAIS ENCONTRADOS</label></b></center></h5><br>";
		while ($fetchencontrado = mysqli_fetch_row($selectencontrado)) {
			$id = $fetchencontrado[0];
			$nomeanimal = $fetchencontrado[1];
			$nome = strtoupper($nomeanimal);
			$especie = $fetchencontrado[2];
			$idade = $fetchencontrado[3];
			$sexo = $fetchencontrado[4];
			$porte = $fetchencontrado[6];
			$castrado = $fetchencontrado[7];
			$vacinado = $fetchencontrado[9];
			$historia = $fetchencontrado[15];
			$foto = $fetchencontrado[16];	
			$resp = $fetchencontrado[12];
			$email = $fetchencontrado[17];
			echo "<div class='album py-5 bg-light'>
			       <div class='container'>
			        <div class='row'>
                        <div class='col-md-6'>
                          <div class='card mb-6 shadow-sm'>
						        <img class='card-img-top'  src='/pets/".$foto."'/>
						        <div class='card-body'>
                                <p class='card-text'>".$nome." <br>
                                    Espécie: ".$especie."<br>
                                    Sexo: ".$sexo."<br>
                                    Porte: ".$porte."<br>
                                    Data de nascimento aproximada: ".$idade."<br>
                                    Castrado? ".$castrado."<br>
            						Vacinado? ".$vacinado."<br>						
            						".$historia."<br><br>
            						Contato: <br>
            						".$resp."<br>
            						E-mail: ".$email."<br>
			                    </p>
                                  <div class='d-flex justify-content-between align-items-center'>
                                    <div class='btn-group'>
                                      <a href='mailto:".$email."' class='btn btn-primary'>Enviar e-mail</a>
                                     </div>
                                    <div class='btn-group'>
                                      <a href='https://api.whatsapp.com/send?phone=55<? echo $resp ?>' class='btn btn-primary'>Enviar WhatsApp </a>
                                    </div>
                                    <!-- Your share button code -->
                                      <div class='fb-share-button' 
                                        data-href='http://gaarcampinas.org/pet.php?id=".$id."' 
                                        data-layout='button_count'>
                                      </div>
                                    <small class='text-muted'></small>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <br>
                            <center><a href='#topo'>Voltar ao topo</a></center>
                            <br>";
        				
		}	
		
		echo "<h5><center><b> <label id='perdidos'>ANIMAIS PERDIDOS</label> </b></center></h5><br>";
		while ($fetchperdido = mysqli_fetch_row($selectperdido)) {
			$id = $fetchperdido[0];
			$nomeanimal = $fetchperdido[1];
			$nome = strtoupper($nomeanimal);
			$especie = $fetchperdido[2];
			$idade = $fetchperdido[3];
			$sexo = $fetchperdido[4];
			$porte = $fetchperdido[6];
			$castrado = $fetchperdido[7];
			$vacinado = $fetchperdido[9];
			$historia = $fetchperdido[15];
			$foto = $fetchperdido[16];	
			$resp = $fetchperdido[12];
			$email = $fetchperdido[17];
			echo "<div class='album py-5 bg-light'>
			       <div class='container'>
			        <div class='row'>
                        <div class='col-md-6'>
                          <div class='card mb-6 shadow-sm'>
						        <img class='card-img-top'  src='/pets/".$foto."'/>
						        <div class='card-body'>
                                <p class='card-text'>".$nome." <br>
                                    Espécie: ".$especie."<br>
                                    Sexo: ".$sexo."<br>
                                    Porte: ".$porte."<br>
                                    Data de nascimento aproximada: ".$idade."<br>
                                    Castrado? ".$castrado."<br>
            						Vacinado? ".$vacinado."<br>						
            						".$historia."<br><br>
            						Contato: <br>
            						".$resp."<br>
            						E-mail: ".$email."<br>
			                    </p>
                                  <div class='d-flex justify-content-between align-items-center'>
                                    <div class='btn-group'>
                                      <a href='mailto:".$email."' class='btn btn-primary'>Enviar e-mail</a>
                                     </div>
                                    <div class='btn-group'>
                                      <a href='https://api.whatsapp.com/send?phone=55<? echo $resp ?>' class='btn btn-primary'>Enviar WhatsApp </a>
                                    </div>
                                    <!-- Your share button code -->
                                      <div class='fb-share-button' 
                                        data-href='http://gaarcampinas.org/pet.php?id=".$id."' 
                                        data-layout='button_count'>
                                      </div>
                                     <small class='text-muted'></small>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <br>
                            <center><a href='#topo'>Voltar ao topo</a></center>
                            <br>";
        				
		}	
		
		mysqli_close($connect);
/*		}*/
		
?>
        </div>
    </div>
	<br><br>
	<!--<center><a href="javascript:window.close();" class="btn btn-primary">Voltar</a></center>-->

<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>