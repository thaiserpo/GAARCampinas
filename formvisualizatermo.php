<?php
session_start();

include ("conexao.php");

$login = $_SESSION['login'];
$idtermo = $_GET['idtermo'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
		
		$query = "SELECT * FROM TERMO_ADOCAO WHERE ID = '$idtermo'";
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
    
    <title>GAAR - Termo de adoção</title>
    
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
				  
			  }
			  
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
<?
   while ($fetch = mysqli_fetch_row($select)) {
                $nomeadotante = $fetch[1];
                $rg = $fetch[2];
                $cpf = $fetch[3];
                $endereco = $fetch[4];
                $numero = $fetch[43];
                $bairro = $fetch[5];
                $cep = $fetch[6];
                $cidade = $fetch[7];
                $estado = $fetch[44];
                $pontoref = $fetch[8];
                $fixo = $fetch[9];
                $celular = $fetch[10];
                $emailadotante = $fetch[11];
                $facebook = $fetch[12];
                $instagram = $fetch[13];
                $profissao = $fetch[14];
				$nomedoanimal = $fetch[15];
				$especie = $fetch[16];
				$idade = $fetch[17];
				$sexo = $fetch[18];
				$cor = $fetch[19];
				$porte = $fetch[20];
				$castrado = $fetch[21];
				$dtcastracao = $fetch[22];
				$vermifugado = $fetch[23];
				$vacinado = $fetch[24];
				$doses = $fetch[25];
				$possuipets = $fetch[26];
				$possuipetscastrados = $fetch[27];
				$teldoador =$fetch[28];
				$emaildoador =$fetch[29];
				$lt = $fetch[30];
				$termopor = $fetch[31];
				$dtadocao = $fetch[32];
				$localadocao = $fetch[33];
				$posem = $fetch[34];
				$pospor = $fetch[35];
				$obs = $fetch[36];
				$statuspos = $fetch[37];
				$taxa = $fetch[41];
				$nome_foto = $fetch[46];
				$nome_fotoad = $fetch[47];
				
				$ano_castracao = substr($dtcastracao,0,4);
		        $mes_castracao = substr($dtcastracao,5,2);
		        $dia_castracao = substr($dtcastracao,8,2);
		        
		        $ano_idade = substr($idade,0,4);
		        $mes_idade = substr($idade,5,2);
		        $dia_idade = substr($idade,8,2);
				
    }


?>
    <form method="POST" name="form" action="cadastrotermo.php" onSubmit="return validar()">
	  <CENTER>
	        <h3>VISUALIZAÇÃO DO TERMO DE ADOÇÃO NÚMERO <? echo $idtermo ?></h3><br>
      </CENTER>
      <div>
	   <center><img class="img-responsive img-fluid rounded" src="/docs/adotantes/<? echo $nome_fotoad ?>" valign="top" align="center" width="600" height="800"/><br></center>
	</div>
      <center><h5>DADOS DO ANIMAL</h5></center>
      <div class="form-group row">
                  <label class="col-sm-5 col-form-label"><strong>Nome do animal: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $nomedoanimal ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Data de nascimento (aprox): </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-ssm-7 col-form-label"><? echo $dia_idade."/".$mes_idade."/".$ano_idade ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Cor: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $cor ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Espécie: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $especie?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Porte: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $porte?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Vermifugação: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $vermifugado?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Castração: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $castrado?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Data da castração: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $dia_castracao."/".$mes_castracao."/".$ano_castracao ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Vacinação: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $vacinado ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Doses: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $doses ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Possui outros animais em casa?  </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $possuipets ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Se sim, estão castrados?  </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $possuipetscastrados ?></label> 
                  </div>
      </div>
    <center><h5>DADOS DO DOADOR/RESPONSÁVEL</h5></center>
      <div class="form-group row">
                  <label class="col-sm-5 col-form-label"><strong>Lar temporário: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $lt ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Termo preenchido por: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $termopor ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Telefone do doador/responsável: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $teldoador ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>E-mail do doador/responsável: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $emaildoador ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Data da adoção: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $dtadocao ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Local da adoção: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $localadocao ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Forma de pagamento da taxa: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $taxa ?></label> 
                  </div>
      </div>
     <center><h5>DADOS DO ADOTANTE</h5></center>
      <div class="form-group row">
                  <label class="col-sm-5 col-form-label"><strong>Nome completo: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $nomeadotante ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>RG: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $rg ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>CPF: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $cpf ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>CEP: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $cep ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Endereço: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $endereco ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Número: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $numero ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Bairro: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $bairro ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Cidade: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $cidade ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Estado:  </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $estado ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Ponto de referência: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $pontoref ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Telefone fixo: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $fixo ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Telefone celular: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $celular ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>E-mail: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $emailadotante ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Profissão: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $profissao ?></label> 
                  </div>
	              <label class="col-sm-5 col-form-label"><strong>Perfil do Facebook:</strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? if ($facebook == '') { echo "Não possui"; } else { echo "<a href='http://www.facebook.com/".$facebook."' target='_blank'>".$facebook."</a>";} ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Perfil do Instagram:</strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? if ($instagram == '') { echo "Não possui"; } else { echo "<a href='http://www.instagram.com/".$instagram."' target='_blank'>".$instagram."</a>";} ?></label> 
                  </div>
	</div>
	<center><h5>PÓS ADOÇÃO</h5></center>
      <div class="form-group row">
                  <label class="col-sm-5 col-form-label"><strong>Realizado em: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $posem ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Realizado por: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $pospor ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Status: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $statuspos ?></label> 
                  </div>
                  <label class="col-sm-5 col-form-label"><strong>Observações: </strong></label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $obs ?></label> 
                  </div>
	</div>
	<div>
	   <!-- <center><img class="img-responsive img-fluid rounded" src="https://www.gaarcampinas.org/private/docs/termos/'<? echo $nome_foto ?>'" valign="top" align="center" width="600" height="800"/> <br><br> </center>-->
	   <? 
	        $foto_termo = "https://www.gaarcampinas.org/private/docs/termos/".$nome_foto;
	       
	        if ($nome_foto !='')  {
    	         echo "<center><i>Foto do termo está armazenada em uma pasta privada com acesso restrito apenas a Diretoria Operacional.</i></center>";
    	         if ($area =='diretoria'){
    	             echo "<center> Caso seja membro da Diretoria, <a href='enviofototermo.php?id=".$idtermo."' target='_blank'> clique aqui para receber via e-mail</a><br>";
    	             //echo "<img src='/home/gaarca06/private/docs/termos/".$nome_foto."'></center>";
    	         }
    	    }
	   
	   ?>
	</div>
	<br>
	<center><a href="pesquisatermo.php" class="btn btn-primary"> Nova pesquisa</a></center> <br>
   </div>
   <? mysqli_close($connect); ?>
</main>
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