<?php 

session_start();

include ("conexao.php"); 
include ("conexao_lojinha.php"); 

$login = $_SESSION['login'];
$idpet= $_GET['idpet'];
$data_atu = date("Y-m-d");
$dia_semana = date('w');

/*if($login == "" || $login == null ){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
        $queryarea = "SELECT AREA,SUBAREA,NOME,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
		}

*/
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
    
    <link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">

    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/auto-refresh/bootstrap-table-auto-refresh.min.js"></script>
    <!--- BOOTSTRAP --->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--- BOOTSTRAP --->
    <title>GAAR - Cria texto </title>
    <!--- GOOGLE ADSENSE --->
     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
     <!--- GOOGLE ADSENSE --->
     <script>	
        function myFunction() {
          // Get the text field
          var copyText = document.getElementById("copybutton");
        
          // Select the text field
          copyText.select();
          copyText.setSelectionRange(0, 99999); // For mobile devices
        
           // Copy the text inside the text field
          navigator.clipboard.writeText(copyText.value);
        
          // Alert the copied text
          //alert("Texto copiado: " + copyText.value);
          alert("Texto copiado");
        }
     </script>
</head>

<body>
<main role="main" class="container">
    <div class="starter-template">
    <center>
        <img src="/area/logo_transparent.png" width="70" height="70"><br><p>Grupo de Apoio ao Animal de Rua - Campinas/SP</p><br><br>
        <h2>TEXTO PARA DIVULGAÇÃO DO ANIMAL ID <a href="http://gaarcampinas.org/pet.php?id=<? echo $idpet?>"><? echo $idpet?></a></h2>
    </center>
    <br><br>
<?

$macho = false;
$femea = false;

$uploaddir = '/home/gaarca06/public_html/docs/comunicacao/textos/';
    
$textopet = file_get_contents($uploaddir."textopet-id".$idpet.".txt");

$query = "SELECT * FROM ANIMAL WHERE ID= '$idpet' ORDER BY ID DESC";
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
					$textopet = $fetch[48];
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
			        $fivfelv = $fetch[47];
			        $idade_jul = $fetch[29];
					
					$ano_nascimento = substr($idade,0,4);
        		    $mes_nascimento = substr($idade,5,2);
        		    $dia_nascimento = substr($idade,8,2);
        		    
        		    //$idade = $dia_nascimento."/".$mes_nascimento."/".$ano_nascimento;
}


$copybutton = $textopet."<br><br>";

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
        $vacinado = 'não estou vacinado';  
    } else {
        $vacinado = 'não estou vacinada';
    }
}

if ($perfil_outrosanimais == "Sim"){
    $outrosanimais = "Convivo bem com outros animais";
} else {
    $outrosanimais = "Não convivo bem com outros animais";
}

if ($perfil_criancas == 'Sim'){
     $perfil_criancas = "Convivo bem com crianças";
} else {
    $perfil_criancas="Não convivo bem com crianças";
}

if ($perfil_apto == 'Sim'){
    $perfil_apto="Vivo bem em apartamento";
    $texto_doacao = "viver em casas que não tenham rota de fuga ou apartamentos telados.";
} else {
    $perfil_apto="Não vivo bem em apartamento";
    $texto_doacao = "viver em casas que não tenham rota de fuga.";
}

switch ($dia_semana){
    case '1':
        $hashtags ="#segundafeira ";
        break;
    case '2':
        $hashtags ="#terçafeira ";
        break;
    case '3':
        $hashtags ="#quartafeira ";
        break;
    case '4':
        $hashtags ="#quintafeira ";
        break;
    case '5':
        $hashtags ="#sextafeira ";
        break;
    case '6':
        $hashtags ="#sábado ";
        break;
    case '7':
        $hashtags ="#domingo ";
        break;
    default:
        break;
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
    $hashtags .= "#filhotes ";
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

if ($especie == 'Felina') {
    $copybutton .= " <p> Mais um pouquinho sobre mim: <br><br>
        🔹 Sou ".$sexo." <br>";
        if ($fivfelv <> '0') {
            $copybutton .= "🔹 ".$fivfelv."<br>";
        }
        $copybutton .= "🔹 ".$vacinado." e ".$castracao." <br>
        🐾 ".$outrosanimais."<br>
        💙 ".$perfil_criancas."<br>
        🏠 ".$perfil_apto." <br>
        🎂 Tenho aproximadamente ".$idade." <br>
        🔹 Só posso ser ".$temp." para ".$texto_doacao."<br><br>
        ";
    $hashtags .= "#viralata #campinas #adotecomresponsabilidade #gaarcampinas #adotecampinas #adotarcampinas #adotenaocompre #naocompreadote #gatos #gatosfofos #adoteumgatinho #adoteumpet #adoteumamigo #semraçadefinida";
} else {
    $copybutton .= " <p> Mais um pouquinho sobre mim: <br><br>
        🔹 Sou ".$sexo." e porte ".strtolower($porte)." <br>
        🔹 Peso aproximadamente ".$peso." kg <br>
        🔹 ".$vacinado." e ".$castracao." <br>
        🐾 ".$outrosanimais."<br>
        💙 ".$perfil_criancas."<br>
        🏠 ".$perfil_apto." <br>
        🎂 Tenho aproximadamente ".$idade." <br>
        🔹 Só posso ser ".$temp." para ".$texto_doacao."<br><br>
        ";
    $hashtags .= "#viralata #campinas #adotecomresponsabilidade #gaarcampinas #adotecampinas #adotarcampinas #adotenaocompre #naocompreadote #cachorros #cachorrosfofos #adoteumcachorro #adoteumpet #adoteumamigo #semraçadefinida";
}

$copybutton .= "
        Lembre-se de que adotar um animal é uma responsabilidade de longo prazo e requer comprometimento. Certifique-se de que você tem tempo e recursos para cuidar deste animal adequadamente antes de adotá-lo.<br><br>
        
        Para adotar, acesse o link em nossa bio ou preencha o formulário aqui 👇🏻 <br>
        🌐 www.gaarcampinas.org/pretermo/ (abra preferencialmente no Google Chrome) <br><br>
        
        Conheça todos os nossos peludos disponíveis acessando o site:<br>
        🌐 www.gaarcampinas.org<br></p>";
        
$copybutton .= $hashtags;

echo $copybutton;

mysqli_close($connect);

fclose($fp); 

?>
            <!--<input type="text" id="copybutton" name="copybutton" value="<? echo $copybutton?>" hidden>
            <a id="myLink" href="#" onclick="myFunction();" class="btn btn-primary">Copiar texto</a>-->
            <p><center><strong>OBSERVAÇÕES</strong><br><i> Todos os dados apresentados foram coletados do banco de dados do GAAR.<br></i></center><br><br>
          <br>
          <br>
          <footer class='footer fixed-bottom bg-light'>
              <div class='container'>
                <p class='text-center'>GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
              </div>
            </footer>

    <!--- BOOTSTRAP --->
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
<!--- BOOTSTRAP --->
</div>
</main>
</body>
</html>