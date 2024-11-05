<?php 

session_start();

include ("conexao.php"); 

$acesso = $_GET['acesso'];
$source = $_GET['source'];

if ($source == ''){
  $login = $_SESSION['login'];
  $source = "0"; 
  $queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
} else{
    $queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE EMAIL ='$source'";
}

$selectarea = mysqli_query($connect,$queryarea);

$rc = mysqli_fetch_row($selectarea);
$area = $rc[0];

if ($area == '') { //usuário não identificado
//if($login == "" || $login == null || $source == ""){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{

		$_SESSION['idpretermo'] = $_GET['idpretermo'];		
		$id = $_SESSION['idpretermo'];
		
        $query = "SELECT * FROM FORM_PRE_ADOCAO where ID='$id'";
		$select = mysqli_query($connect,$query);
        $fetch = mysqli_fetch_row($select);
		
		$adotante = $fetch[1];
		$cpf = $fetch[2];
		$rg = $fetch[74];
		$email = $fetch[3];
		$profissao = $fetch[4];
		$tmptelfixo = $fetch[5];
		$tmpcelular = $fetch[6];
		$endereco = $fetch[7];
		$numero = $fetch[70];
		$complemento = $fetch[71];
		$bairro = $fetch[8];
		$cidade = $fetch[9];
		$cep = $fetch[10];
		$nomeanimal = $fetch[11];
		$especie = $fetch[12];
		$pelagem = $fetch[13];
		$sexo = $fetch[14];
		$facebook = $fetch[15];
		$instagram = $fetch[16];
		$perg1 = $fetch[17];
		$perg2 = $fetch[18];
		$perg3 = $fetch[19];
		$perg4 = $fetch[20];
		$perg5 = $fetch[21];
		$perg6 = $fetch[22];
		$perg7 = $fetch[23];
		$perg8 = $fetch[24];
		$perg9 = $fetch[25];
		$perg10 = $fetch[26];
		$perg11 = $fetch[27];
		$perg12 = $fetch[28];
		$perg13 = $fetch[29];
		$perg14 = $fetch[30];
		$perg15 = $fetch[31];
		$perg16 = $fetch[32];
		$perg17 = $fetch[33];
		$perg18 = $fetch[34];
		$perg19 = $fetch[35];
		$perg20 = $fetch[36];
		$perg21 = $fetch[37];
		$perg22 = $fetch[38];
		$perg23 = $fetch[39];
		$perg24 = $fetch[40];
		$perg25 = $fetch[41];
		$perg26 = $fetch[42];
		$perg27 = $fetch[43];
		$perg28 = $fetch[44];
		$perg29 = $fetch[45];
		$perg30 = $fetch[46];
		$perg31 = $fetch[47];
		$perg32 = $fetch[48];
		$perg33 = $fetch[49];
		$perg34 = $fetch[50];
		$perg35 = $fetch[51];
		$perg36 = $fetch[52];
		$perg37 = $fetch[53];
		$perg38 = $fetch[54];
		$perg39 = $fetch[55];
		$perg40 = $fetch[56];
		$perg41 = $fetch[57];
		$perg42 = $fetch[58];
		$perg43 = $fetch[59];
		$perg44 = $fetch[60];
		$link = $fetch[61];
		$foto = $fetch[63];
		$perg45 = $fetch[63];
		$perg46 = $fetch[67];
		$perg47 = $fetch[76];
		$obs = $fetch[64];
		$obs_interessado = $fetch[73]; 
		$id_animal = $fetch[75]; 
		
		$telfixo = sprintf("(%s) %s-%s", substr($tmptelfixo, 0, 2), substr($tmptelfixo, 2, 4), substr($tmptelfixo, 6, 5));
		$celular = sprintf("(%s) %s-%s", substr($tmpcelular, 0, 2), substr($tmpcelular, 2, 4), substr($tmpcelular, 6, 6));
		
		$queryimg = "SELECT FOTO FROM ANIMAL where ID='$id_animal'";
		$selectimg = mysqli_query($connect,$queryimg);
		
		while ($fetchimg = mysqli_fetch_row($selectimg)) {
		    $path_foto = $fetchimg[0];
		}

        $endereco = str_ireplace (',',' ',$endereco);
        
        $endereco_completo = $endereco."-".$numero."-".$bairro."-".$cidade;
                
        $gmaps = str_ireplace (' ','-',$endereco_completo);
        
        $queryrepro = "SELECT * FROM REPROVADOS WHERE ADOTANTE='$adotante' AND CPF='$cpf'";
		$selectrepro = mysqli_query($connect,$queryrepro);
        $fetchrepro = mysqli_fetch_row($selectrepro);
        $reccountrepro = mysqli_num_rows($selectrepro);

		$id_repro = $fetchrepro[0];
		$adotante_repro = $fetchrepro[1];
		$vol_repro = $fetchrepro[18];   
		$obs_reprova = $fetchrepro[17];
		
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
    
    <title>GAAR - Pré termo de adoção</title>
    
    <!--- GOOGLE ADSENSE --->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
    <!--- GOOGLE ADSENSE --->
    
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
				  case 'anuncios':
				  	include_once("menu_terceiros.php") ;
					break;
				  
			  }
			  
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
	   <CENTER>
	        <h3>FORMULÁRIO DE INTERESSE NO ANIMAL <? echo $nomeanimal ?></h3><br>
	        <img class='img-responsive img-fluid rounded' src='http://gaarcampinas.org/pets/<? echo $id_animal."/".$path_foto ?>' valign='top' align='center' width='30%' height='30%'/> <br><br>
	        <h4>Pré termo número <? echo $id ?></h4><br>
      </CENTER> 
	  <form action="atualizapretermo.php" method="POST" enctype="multipart/form-data" name="form" required>
	   <div class="form-group row">
               <?
                    /*echo "<br> queryrepro: ".$queryrepro;*/
                    if ($reccountrepro <> '0' and $reccountrepro <> '') {
                        /*echo "<br>reccountrepro: ".$reccountrepro;*/
                        echo "<label class='col-sm-12 col-form-label'><strong><font color='red'>Interessado reprovado por ".$vol_repro.". <br> Motivo: ".$obs_reprova.".</font></strong></label>";
                    }
               ?>
       </div>
       <center><h5>DADOS DO INTERESSADO</h5></center>
	   <div class="form-group row">
                  <label class="col-sm-2 col-form-label"><strong>Nome completo: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $adotante ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Endereço: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-6 col-form-label"><? echo $endereco ?></label> &nbsp;  
                    <label class="col-sm-6 col-form-label"><a href="https://www.google.com/maps/place/<? echo $gmaps ?>/" target="_blank">Veja no Google Maps</a></label>
                  </div> 
                  <label class="col-sm-2 col-form-label"><strong>Complemento: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $complemento ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Número: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $numero ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Bairro: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $bairro ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>CEP: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $cep ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Cidade: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $cidade ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>CPF:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $cpf ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>RG:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $rg ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Celular:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $celular ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>E-mail:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><a href="mailto:<? echo $email ?>"><? echo $email ?></a></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Profissão:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $profissao ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Perfil do Facebook:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? if ($facebook == '') { echo "Não possui"; } else { echo "<a href='http://www.facebook.com/".$facebook."' target='_blank'>".$facebook."</a>";} ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Perfil do Instagram:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? if ($instagram == '') { echo "Não possui"; } else { echo "<a href='http://www.instagram.com/".$instagram."' target='_blank'>".$instagram."</a>";} ?></label> 
                  </div>
        </div>
       <center><h5>SOBRE O INTERESSADO E SUA FAMILIA</h5></center>
	   <div class="form-group row">
                  <label class="col-sm-12 col-form-label"><strong>1)</strong> Todos os membros da família estão dispostos a cuidar e  zelar pela saúde e segurança do animal por todo período de vida dele? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong> <? echo $perg1 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>2)</strong> Quantas pessoas moram em sua residência?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg2 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>3) </strong>Todos estão de acordo com a adoção?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg3 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>4) </strong>Quantas crianças moram com você ou te visitam com  frequência? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg4 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>5) </strong>Qual a idade das crianças?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg5 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>6) </strong>Essas crianças já tiveram algum contato com animais?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg6 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>7) </strong>Há alguém com alergias/rinites? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg7 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>8) </strong>Há alguém com problemas respiratórios? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg8 ?></label> 
                  </div>
        </div>
        <center><h5>SOBRE A MORADIA</h5></center>
	   <div class="form-group row">
                  <label class="col-sm-12 col-form-label"><strong>9) </strong>Tipo</label>
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong> <? echo $perg9 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>10)</strong> O imóvel é alugado?</label>
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg10 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>11) </strong>Caso o imóvel seja alugado, existe alguma restrição  para animais?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg11 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>12) </strong>Caso sua residência seja casa, o animal terá acesso livre à rua? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg12 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>13) </strong>Caso sua residência seja casa, qual a altura dos muros?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg13 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>14) </strong>Caso sua residência seja casa, o portão é seguro contra fugas?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg14 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>15) </strong>Caso sua residência seja apartamento, contém telas de proteção (telas de proteção para animais e crianças, diferentes de grades de proteção) em todas as janelas? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg15 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>16) </strong>Caso sua residência seja apartamento, contém telas de proteção (telas de proteção para animais e crianças, diferentes de grades de proteção) na sacada?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg16 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>17) </strong>Caso sua residência seja apartamento, contém telas de proteção (telas de proteção para animais e crianças, diferentes de grades de proteção) na janela do banheiro?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg20 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>18) </strong>Caso não pretenda  telar, como irá evitar que o animal saia para a rua ou pule a janela? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg17 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>19) </strong>Caso ocorra situações que alterem a  rotina da família (ex: mudança de casa/cidade, chegada de um bebê, separação do  casal, etc) qual seria a melhor alternativa para o animal adotado?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg21 ?></label> 
                  </div>
        </div>

       <center><h5>SOBRE CUIDADOS E CONVIVÊNCIA</h5></center>
	   <div class="form-group row">
                  <label class="col-sm-12 col-form-label"><strong>20) </strong>Você tem outros animais? </label>
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong> <? echo $perg22 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>21)</strong> Se sim, quantos?</label>
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg23 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>22) </strong>Todos vacinados contra Cinomose, Hepatite, Parvovirose, etc (V10)?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg24 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>23) </strong>Caso afirmativo, foram vacinados em: </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg25 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>24) </strong>Se não são, qual o motivo?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg26 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>25) </strong>Se tem animais, estão castrados?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg27 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>26) </strong>Quantos cães?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg28 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>27) </strong>Quantos gatos?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg29 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>28) </strong>Qual o porte dos cães?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg30 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>29) </strong>Já conviveram com outros animais? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg31 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>30) </strong>Já teve outros animais que não estão mais com você? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg32 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>31) </strong>Caso afirmativo, o que aconteceu?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg33 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>32) </strong>Em  caso de viagem, onde o animal ficará?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg34 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>33) </strong>Quantas  horas por dia o animal ficará sozinho?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg35 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>34) </strong>Qual ração pretende dar para o animal?   </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg36 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>35) </strong>Caso o animal adotado seja um filhote e tenha apenas  uma dose da vacina, pretende terminar de vaciná-lo?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg37 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>36) </strong>Terá  condições de vacinar anualmente o animal com vacinas importadas?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg38 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>37) </strong>Terá condições de custear veterinário caso o animal  necessite de cuidados no futuro? (doenças e outras necessidades) </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg39 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>38) </strong>Caso o animal adotado seja muito jovem e não esteja castrado, pretende castrar na idade correta? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg40 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>39) </strong>Caso negativo, qual o motivo? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg41 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>40) </strong>Um voluntário poderá ir até sua casa, conhecer você e  sua família, e o local onde o animal ficará, entregando-o pessoalmente?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg42 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>41) </strong>Concorda em assinar um termo de responsabilidade pelo animal?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg43 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>42) </strong>Concorda em manter contato com um(a) voluntário(a),  após a adoção, por tempo indeterminado, informando o estado do animal?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg44 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>43) </strong>O GAAR cobra uma taxa de adoção no valor de R$ 70,00 que é um valor simbólico para ajudar nas despesas que a ONG teve com o animal. Você concorda com essa taxa?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg45 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>44) </strong>Como ficou sabendo do animal?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg46 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>45) </strong>Devido ao COVID-19, gostaríamos de saber se você está presencialmente na feira de adoção</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg47 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>Link do anúncio (caso houver):  </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><a href="<? echo $link ?>"><? echo $link ?></a></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>Observações escritas pelo interessado:  </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $obs_interessado ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>Observações da ONG:  </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $obs ?></label> 
                  </div>
        </div>
	  </form>
    <br>
    <?
      echo "<center><a href='formenvioemailpretermo.php?idpretermo=$id' class='btn btn-primary'>Responder ao interessado</a> &nbsp;&nbsp;<a href='enviarpretermo.php?idpretermo=$id' target='_blank' class='btn btn-primary'>Enviar cópia por e-mail ao responsável</a>&nbsp;&nbsp;<a href='javascript:window.print()' class='btn btn-primary'>Imprimir</a><br><br><a href='pesquisapretermo.php' class='btn btn-primary'>Nova pesquisa</a> &nbsp;&nbsp;</center>";
    ?>
	<!--	<input type="submit" value="Atualizar" id="atualizar" required name="atualizar" onClick="atualizatermo();">
		<input type="submit" value="Ver todos os usuários" id="selecionar" required name="selecionar" onclick="seleciona();"> -->	  
    </p>
	</form> 
    <br>
   </div>
   <? mysqli_close($connect); ?>
</main>
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