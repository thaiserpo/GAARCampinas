<?php
session_start();

include ("conexao.php");

$login = $_SESSION['login'];
$idpretermo = $_GET['idpretermo'];
$dia_atu = date("d");
$mes_atu = date("m");
$ano_atu = date("Y"); 
$data_atu = date("d-m-Y");
$horaatu = date("H:i:s");

switch ($mes_atu){
    case '01':
        $mes_atu = "janeiro";
        break;
    case '02':
        $mes_atu = "fevereiro";
        break;
    case '03':
        $mes_atu = "março";
        break;
    case '04':
        $mes_atu = "abril";
        break;
    case '05':
        $mes_atu = "maio";
        break;
    case '06':
        $mes_atu = "junho";
        break;
    case '07':
        $mes_atu = "julho";
        break;
    case '08':
        $mes_atu = "agosto";
        break;
    case '09':
        $mes_atu = "setembro";
        break;
    case '10':
        $mes_atu = "outubro";
        break;
    case '11':
        $mes_atu = "novembro";
        break;
    case '12':
        $mes_atu = "dezembro";
        break;
}

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,NOME FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$nomevol = $fetcharea[1];
		}
		
		$query = "SELECT * FROM FORM_PRE_ADOCAO WHERE ID ='$idpretermo'";
		$select = mysqli_query($connect,$query);
		
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
    
    <title>GAAR - Termo de adoção pré preenchido</title>
    
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">
<?
   if ($idpretermo <> "") {
        while ($fetch = mysqli_fetch_row($select)) {
                    $nomeadotante = $fetch[1];
                    $rg = $fetch[74];
                    $cpf = $fetch[2];
                    $endereco = $fetch[7];
                    $numero = $fetch[70];
                    $bairro = $fetch[8];
                    $cep = $fetch[10];
                    $cidade = $fetch[9];
                    $complemento = $fetch[71];
                    $fixo = $fetch[5];
                    $celular = $fetch[6];
                    $emailadotante = $fetch[3];
                    $facebook = $fetch[15];
                    $instagram = $fetch[16];
                    $profissao = $fetch[4];
                    $idanimal = $fetch[75];
                    $possuianimais = $fetch[38];
                    $saocastrados = $fetch[43];
        }    
   } else {
        $idanimal = $_GET['idanimal'];
        $nomeadotante = $_GET['adotante'];
        if (isset($_GET['dadosadotante']) && $_GET['dadosadotante'] == 'dadosadotante') {
            $nomeadotante = $_GET['adotante'];
            $rg = $_GET['rg'];
            $cpf = $_GET['cpf'];
            $endereco = $_GET['endereco'];
            $numero = $_GET['numero'];
            $bairro =  $_GET['bairro'];
            $cep = $_GET['cep'];
            $cidade = $_GET['cidade'];
            $complemento = $_GET['complemento'];
            $fixo = $_GET['telfixo'];
            $celular = $_GET['celular'];
            $emailadotante = $_GET['email'];
            $facebook =  $_GET['facebook'];
            $instagram = $_GET['instagram'];
            $profissao = $_GET['profissao'];
            $possuianimais = $_GET['possuianimal'];
            $saocastrados = $_GET['sesimcastrados'];
            
        } else {
            $nomeadotante = "<label style='width: 400px;'>&nbsp;</label>";
            $rg = "<label style='width: 80px;'>&nbsp;</label>";
            $cpf = "<label style='width: 80px;'>&nbsp;</label>";
            $endereco = "<label style='width: 300px;'>&nbsp;</label>";
            $numero = "<label style='width: 100px;'>&nbsp;</label>";
            $bairro = "<label style='width: 200px;'>&nbsp;</label>";
            $cep = "<label style='width: 100px;'>&nbsp;</label>";
            $cidade = "<label style='width: 100px;'>&nbsp;</label>";
            $complemento = "<label style='width: 100px;'>&nbsp;</label>";
            $fixo = "<label style='width: 100px;'>&nbsp;</label>";
            $celular = "<label style='width: 100px;'>&nbsp;</label>";
            $emailadotante = "<label style='width: 250px;'>&nbsp;</label>";
            $facebook = "<label style='width: 100px;'>&nbsp;</label>";
            $instagram = "<label style='width: 100px;'>&nbsp;</label>";
            $profissao = "<label style='width: 100px;'>&nbsp;</label>";
            $possuianimais= "0";
            $saocastrados ="0";
            $dia_idade = "<label style='width:50px;'>&nbsp;</label>";
            $mes_idade = "<label style='width:50px;'>&nbsp;</label>";
            $ano_idade = "<label style='width:50px;'>&nbsp;</label>"; 
        }
   }
   
    
    $querypet = "SELECT * FROM ANIMAL WHERE ID ='$idanimal'";
	$selectpet = mysqli_query($connect,$querypet);
    
    while ($fetchpet = mysqli_fetch_row($selectpet)) {
				$nomedoanimal = $fetchpet[1];
				$especie = $fetchpet[2];
				$idade = $fetchpet[3];
				$sexo = $fetchpet[4];
				$cor = $fetchpet[5];
				$porte = $fetchpet[6];
				$castrado = $fetchpet[7];
				$dtcastracao = $fetchpet[8];
				$vermifugado = $fetchpet[21];
				$vacinado = $fetchpet[9];
				$doses = $fetchpet[22];
				$responsavel = $fetchpet[12];
				$dtvacinacao = $fetchpet[30];
				$dtvermifugo = $fetchpet[46];
				$lt = $fetchpet[11];
				
				$queryresp = "SELECT CELULAR,EMAIL,NOME FROM VOLUNTARIOS WHERE NOME ='$responsavel'";
		        $selectresp = mysqli_query($connect,$queryresp);
		        $rc = mysqli_fetch_row($selectresp);
				$teldoador = $rc[0];
				$emaildoador =$rc[1];
				$nomedoador =$rc[2];
				
				$lt = $fetchpet[11];
				$obs = $fetchpet[15];
				$nome_foto = $fetchpet[16];
				
				$ano_castracao = substr($dtcastracao,0,4);
		        $mes_castracao = substr($dtcastracao,5,2);
		        $dia_castracao = substr($dtcastracao,8,2);
		        
		        $ano_vacinacao = substr($dtvacinacao,0,4);
		        $mes_vacinacao = substr($dtvacinacao,5,2);
		        $dia_vacinacao = substr($dtvacinacao,8,2);
		        
		        $ano_vermifugo = substr($dtvermifugo,0,4);
		        $mes_vermifugo = substr($dtvermifugo,5,2);
		        $dia_vermifugo = substr($dtvermifugo,8,2);
		        
		        $ano_idade = substr($idade,0,4);
		        $mes_idade = substr($idade,5,2);
		        $dia_idade = substr($idade,8,2);
				
    }


?>
    <form method="POST" name="form" action="#" onSubmit="return validar()">
	  <CENTER>
	        <h3><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'>GRUPO DE APOIO AO ANIMAL DE RUA</h3>
	        <center><small><img src="http://gaarcampinas.org/area/facebook.png" width='20' height='20'> /gaarcampinas &nbsp;<img src="http://gaarcampinas.org/area/72-723063_resultado-de-imagem-para-logo-do-instagram-vetor.png" width='20' height='20'> @gaarcampinas &nbsp;<img src="http://gaarcampinas.org/area/18-187940_free-icons-png-small-website-icon.png" width='20' height='20'> www.gaarcampinas.org</center></small></h3>
	        <br>
	        <h4><u>TERMO DE ADOÇÃO RESPONSÁVEL</h4></u>
      </CENTER>
      <div>
	</div>
	<div id="divdadosdoadotante" class="d-block">
     <center><h5><u>DADOS DO ADOTANTE</u></h5></center>
                  <table width="100%">
                      <tr>
                          <td align="left" colspan="1"><strong>NOME COMPLETO: </strong></td>
                          <td align="left" colspan="9" style="border-bottom: 1px solid black;"><? echo $nomeadotante ?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="1"><strong>RG: </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? if ($rg=="" || $rg=="0") {  } else { echo $rg; } ?></td>
                          <td align="left" colspan="1"><strong>CPF: </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? echo $cpf ?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="1"><strong>E-MAIL: </strong></td>
                          <td align="left" colspan="9" style="border-bottom: 1px solid black;"><? echo $emailadotante ?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="1"><strong>ENDEREÇO: </strong></td>
                          <td align="left" colspan="3"style="border-bottom: 1px solid black;"><? echo $endereco ?></td>
                          <td align="left" colspan="1"><strong>NÚMERO: </strong></td>
                          <td align="left" colspan="1"style="border-bottom: 1px solid black;"><? echo $numero ?></td>
                          <td align="left" colspan="1"><strong>COMPL.: </strong></td>
                          <td align="left" colspan="3"style="border-bottom: 1px solid black;"><? echo $complemento ?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="1"><strong>BAIRRO: </strong></td>
                          <td align="left" colspan="2" style="border-bottom: 1px solid black;"><? echo $bairro ?></td>
                          <td align="left" colspan="1"><strong>CEP: </strong></td>
                          <td align="left" colspan="3" style="border-bottom: 1px solid black;"><? echo $cep ?></td>
                          <td align="left" colspan="1"><strong>CIDADE/UF: </strong></td>
                          <td align="left" colspan="2" style="border-bottom: 1px solid black;"><? echo $cidade ?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="1"><strong>TELEFONE(S): </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? echo $celular ?> &nbsp; <? echo $fixo ?></td>
                          <td align="left" colspan="1"><strong>PROFISSÃO: </strong></td>
                          <td align="left" colspan="4"style="border-bottom: 1px solid black;"><? echo $profissao ?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="1"><strong>FACEBOOK: </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? if ($facebook == '0') { echo "Não possui"; } else { echo $facebook;} ?></td>
                          <td align="left" colspan="1"><strong>INSTAGRAM: </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? if ($instagram == '0') { echo "Não possui"; } else { echo $instagram;} ?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="3"><strong>POSSUI OUTROS ANIMAIS EM CASA? </strong></td>
                          <td align="left" colspan="2" style="border-bottom: 1px solid black;"><? if ($possuianimais <> "0") { echo $possuianimais; } else { echo "(&nbsp;&nbsp;&nbsp;&nbsp;)Sim &nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;)Não";} ?></td>
                          <td align="left" colspan="3"><strong>SE SIM, ESTÃO CASTRADOS? </strong></td>
                          <td align="left" colspan="2" style="border-bottom: 1px solid black;"><? if ($saocastrados <> "0") { echo $saocastrados; } else { echo "(&nbsp;&nbsp;&nbsp;&nbsp;)Sim &nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;)Não";} ?></td>
                      </tr>
                  </table>
	</div><br>
	<div id="divdadosanimal" class="d-block">
      <center><h5><u>DADOS DO ANIMAL</u></h5></center>
        <table width="100%">
                      <tr>
                          <td align="left" colspan="1" ><strong>NOME: </strong></td>
                          <td align="left" colspan="3" style="border-bottom: 1px solid black;"><? echo $nomedoanimal ?></td>
                          <td align="left" colspan="1"><strong>ESPÉCIE: </strong></td>
                          <td align="left" colspan="1" style="border-bottom: 1px solid black;"><? echo $especie ?></td>
                          <td align="left" colspan="1"><strong>SEXO: </strong></td>
                          <td align="left" colspan="2" style="border-bottom: 1px solid black;"><? echo $sexo ?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="1" ><strong>DATA DE NASCIMENTO: </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? echo $dia_idade."/".$mes_idade."/".$ano_idade ?></td>
                          <td align="left" colspan="1" ><strong>COR: </strong></td>
                          <td align="left" colspan="3" style="border-bottom: 1px solid black;"><? echo $cor ?></td>
                          <td align="left" colspan="1" ><strong>PORTE: </strong></td>
                          <td align="left" colspan="2" style="border-bottom: 1px solid black;"><? echo $porte ?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="1" ><strong>CASTRAÇÃO: </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? echo $castrado ?></td>
                          <td align="left" colspan="1" ><strong>DATA DO PROCEDIMENTO: </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? if ($dtcastracao =='0001-01-01' || $dtcastracao =='0000-00-00') { echo "____/____/_______"; } else { echo $dia_castracao."/".$mes_castracao."/".$ano_castracao; } ?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="1" ><strong>VERMIFUGAÇÃO: </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? echo $vermifugado ?></td>
                          <td align="left" colspan="1" ><strong>ÚLTIMA VERMIFUGAÇÃO EM: </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? if ($dtvermifugo =='0001-01-01' || $dtvermifugo =='0000-00-00') { echo "____/____/_______"; } else {  echo $dia_vermifugo."/".$mes_vermifugo."/".$ano_vermifugo;} ?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="1" ><strong>VACINAÇÃO: </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? echo $vacinado ?></td>
                          <td align="left" colspan="1" ><strong>DOSES: </strong></td>
                          <td align="left" colspan="2" style="border-bottom: 1px solid black;"><? echo $doses ?></td>
                          <td align="left" colspan="1" ><strong>ÚLTIMA DOSE EM: </strong></td>
                          <td align="left" colspan="3" style="border-bottom: 1px solid black;"><? if ($dtvacinacao =='0001-01-01' || $dtvacinacao =='0000-00-00') { echo "____/____/_______"; } else { echo $dia_vacinacao."/".$mes_vacinacao."/".$ano_vacinacao; }?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="1" ><strong>LAR TEMPORÁRIO: </strong></td>
                          <td align="left" colspan="9" style="border-bottom: 1px solid black;"><? echo $lt ?></td>
                      </tr>
      </table>
    </div>
    <br>
    <div id="divtermosgerais" class="d-block">
        <table width="100%">
                      <tr>
                          <td align="left">1. Ao adotar o animal acima <strong>assumo a guarda e a responsabilidade por ele. </strong>Declaro que estou ciente de todos os cuidados que o animal exige em relação às vacinações anuais (cinomose, hepatite, leptospirose, raiva entre outros);</td>
                      </tr>
                      <tr>
                          <td align="left">2. <strong>Comprometo-me </strong> a oferecer boas condições de alojamento e alimentação, assim como espaço físico para que o animal se exercite e/ou passeios regulares. Responsabilizo-me em preservar a sua saúde e a integridade, e oferecer-lhe cuidados médicos veterinários sempre que necessário. VACINAÇÃO SÓ EM CLÍNICA VETERINÁRIA;</td>
                      </tr>
                      <tr>
                          <td align="left">3. <strong>Comprometo-me a NÃO TRANSFERIR A GUARDA a outrem sem o conhecimento do doador </strong>e a permitir o acesso do doador ao local onde habita o animal. Havendo motivo justificável que me obrigue a abrir mão dele comprometo-me a avisar imediatamente o doador e a abrigar o animal até que ele encontre um lar;</td>
                      </tr>
                      <tr>
                          <td align="left">4. Tenho conhecimento de que, caso seja constatada situação inadequada ao bem estar do animal <strong>perderei a guarda sem penalidades legais.</strong></td>
                      </tr>
                      <tr>
                          <td align="left">5. <strong>Comprometo-me a esterilizar(castrar) o animal aos 5 meses de idade </strong>contribuindo para o controle da população e para sua saúde (evita piometra, câncer de mama e de próstata, doenças venéreas, diminui enfermidades transmissíveis felinas - FIV, FELV, entre outras);</td>
                      </tr>
                      <tr>
                          <td align="left">6. <strong>Declaro-me ciente das normas acima e aceito. </strong></td>
                      </tr>
        </table>    
    </div>
    <br>
    <div id="divdadosdaadocao" class="d-block">
        <center><h5><u>DADOS DA ADOÇÃO</u></h5></center>
        <table width="100%" >
                      <tr>
                          <td align="left" colspan="1"><strong>Fone do doador: </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? echo $teldoador ?></td>
                          <td align="left" colspan="1"><strong>E-mail do doador: </strong></td>
                          <td align="left" colspan="4" style="border-bottom: 1px solid black;"><? echo $emaildoador ?></td>
                      </tr>
                      <tr>
                          <td align="left" colspan="1"><strong>Termo preenchido por: </strong></td>
                          <td align="left" colspan="4" ><? echo $nomevol ?></td>
                          <td align="left" colspan="1"><strong>Local da adoção: </strong></td>
                          <? if ($idpretermo <> "") { 
                              echo "<td align='left' colspan='3' style='border-bottom: 1px solid black;'>Via internet - Feira</td>";
                             } else {
                               echo "<td align='left' colspan='3' style='border-bottom: 1px solid black;'>&nbsp;</td>";  
                             }
                           ?>
                          
                      </tr>
                      <tr>
                          <td align="left" colspan="1"><strong>Forma de pagamento: </strong></td>
                          <td align="left" colspan="4" >(&nbsp;&nbsp;&nbsp;&nbsp;)Dinheiro &nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;)Débito &nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;)Crédito &nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;)PIX</td>
                          <td align="left" colspan="1"><strong>Taxa </strong></td>
                          <td align="left" colspan="4" >R$ 70,00</td>
                      </tr>
                      <tr>
                          <td align="left" colspan="9">Autorizo o uso de minha imagem (e/ou do menor sob minha responsabilidade) para divulgação nas redes sociais:</strong></td>
                          <td align="left" colspan="1">(&nbsp;&nbsp;&nbsp;&nbsp;)Sim &nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;)Não</td>
                      </tr>
        </table>
      </div>
      <br><br>
      <div id="divassinaturasleft" class="d-block" style="float:left;">
          <table width="100%">
             <tr>
                <td align="left"><strong>_________________________________________________________ </strong></td>
             </tr>
             <tr>
                <td align="center" colspan="2"><strong>ASSINATURA DO ADOTANTE</strong></td>
             </tr>
          </table>
      </div>
      <div id="divassinaturasempty" class="d-block" style="float:left;">
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
      <div id="divassinaturasright" class="d-block" style="float:left;">
          <table width="100%">
             <tr>
                 <?
                    $caminhoassinatura = "https://gaarcampinas.org/area/imagens/signat/".$login."/assinatura.png";
                    echo "<td align='left'><strong>_________________________________________________________ </strong></td>";
                    //echo $caminhoassinatura;
                    //echo "<td align='center'><img src='https://gaarcampinas.org/area/imagens/signat/".$login."/assinatura.png' width='10%' height='10%' ></td>";
                    /*if (file_exists($caminhoassinatura)) {
                        header('Content-Type: image/jpeg');
                        echo "<td align='left'><img src='https://gaarcampinas.org/area/imagens/signat/".$login."/assinatura.png'></td>";
                     } else {
                         echo "<td align='left'><strong>_________________________________________________________ </strong></td>";
                         //echo "<td align='left'><strong>Assinatura eletrônica de ".$nomevol." às ".$horaatu."</strong></td>";
                     }*/
                  ?>
             </tr>
             <tr>
                <td align="center" colspan="2"><strong>VOLUNTÁRIO(A) DO GAAR</strong></td>
             </tr> 
          </table>
      </div>
      <br><br><br>
    <div id="divdata" class="d-block" style="float:right;">
        <p><strong>Campinas, <? echo $dia_atu?> de <?echo $mes_atu?> de <? echo $ano_atu?></strong></p>
    </div>
    <br>
    <div id="divfooter" class="d-block">
        <p><strong><center><font color="red">ABANDONAR E MALTRATAR ANIMAIS É CRIME DESCRITO NA LEI 9605/98 COM DETENÇÃO DE ATÉ 5 ANOS</font></center></strong></p>
    </div>
    <div id="divfooter2" class="d-block d-print-none">
        <p><small><center><i>Termo pré preenchido pelo sistema, favor imprimir duas vias. </i></small></center></p>
    </div>
	<br>
	<div id="divprint" class="d-block">
	    <Center><button onclick="window.print()" class="btn btn-primary d-print-none">Imprimir</button></Center>
	</div>
   </div>
</main>
<br><br>
<? 
    }
    mysqli_close($connect); 
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>