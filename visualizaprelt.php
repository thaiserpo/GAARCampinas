<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,NOME FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$nomevoluntario = $fetcharea[1];
		}

		$_SESSION['id'] = $_GET['id'];		
		$id = $_SESSION['id'];
		
        $query = "SELECT * FROM FORM_VOLUNTARIO WHERE ID='$id'";
		$select = mysqli_query($connect,$query);
        $fetch = mysqli_fetch_row($select);
		
		$id = $fetch[0];
		$nome = $fetch[1];
		$cidade = $fetch[2];
		$celular = $fetch[4];
		$email = $fetch[5];
		$comoajudar = $fetch[6];
		$perg01 = $fetch[9];
		$perg02 = $fetch[10];
		$perg03 = $fetch[11];
		$perg04 = $fetch[12];
		$perg05 = $fetch[13];
		$perg06 = $fetch[14];
		$perg07 = $fetch[15];
		$perg08 = $fetch[16];
		$perg09 = $fetch[17];
		$perg10 = $fetch[18];
		$bairro = $fetch[20];
		$endereco = $fetch[21];

        $endereco = str_ireplace (',',' ',$endereco);
        
        $endereco_completo = $endereco."-".$bairro."-".$cidade;
                
        $gmaps = str_ireplace (' ','-',$endereco_completo);
		
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
    
    <title>GAAR - Candidatos a lar temporário</title>
    
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
	<br>
	   <CENTER>
	        <br>
	        <h3>CANDIDATO A SER LAR TEMPORÁRIO</h3><br>
      </CENTER> 
      <form action="#" method="POST" enctype="multipart/form-data" name="form">
	   <div class="form-group row">
                  <label class="col-sm-2 col-form-label"><strong>Nome completo: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $nome ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Endereço: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-6 col-form-label"><? echo $endereco ?></label> &nbsp;  
                    <label class="col-sm-6 col-form-label"><a href="https://www.google.com/maps/place/<? echo $gmaps ?>/" target="_blank">Veja no Google Maps</a></label>
                  </div> 
                  <label class="col-sm-2 col-form-label"><strong>Bairro: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $bairro ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Cidade: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $cidade ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Celular:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $celular ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>E-mail:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><a href="mailto:<? echo $email ?>"><? echo $email ?></a></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Como pode ajudar:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><? echo $comoajudar ?></label> 
                  </div>
        </div>
	   <div class="form-group row">
                  <label class="col-sm-12 col-form-label"><strong>1)</strong> Prefere ajudar com: </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong> <? echo $perg01 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>2)</strong> Caso seja cão, porte:</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg02 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>3) </strong>Tem outro animal em casa?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg03 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>4) </strong>Ele se dá bem com outro animal? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg04 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>5) </strong>Mora em</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg05 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>6) </strong>Tem quintal para um cão?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg06 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>7) </strong>Os muros são altos suficientes para impedir fugas? </label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg07 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>8) </strong>Todas as janelas são teladas?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg08 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>9) </strong>Todos os moradores estão de acordo em ser lar temporário?</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg09 ?></label> 
                  </div>
                  <label class="col-sm-12 col-form-label"><strong>10) </strong>Por quanto tempo pretende ser lar temporário:</label> 
                  <div class="col-sm-10">
                    <label class="col-sm-10 col-form-label"><strong>Resp.: </strong><? echo $perg10 ?></label> 
                  </div>
        </div>
    <br>
    <?
      /*echo "<center><a href='formenvioemailpretermo.php?id=$id' class='btn btn-primary'>Responder ao interessado</a> &nbsp;&nbsp;<a href='enviarpretermo.php?id=$id' class='btn btn-primary'>Enviar cópia por e-mail</a>&nbsp;&nbsp;<a href='javascript:window.print()' class='btn btn-primary'>Imprimir</a></center>";*/
    ?>
        <center>
            <input name="whats" value="Enviar WhatsApp" type="button" onClick="location.href='https://api.whatsapp.com/send?phone=55<? echo $celular ?>'" class="btn btn-primary"> &nbsp; &nbsp;
            
            <a href="aprovalt.php?id=<? echo $id ?>" class="btn btn-primary">Aprovar</a> &nbsp; &nbsp;
            <a href="reprovalt.php?id=<? echo $id ?>" class="btn btn-primary">Reprovar</a> &nbsp; &nbsp;
        </form>
        <br><br><br>
            <a href="formvisualizaprelt.php" class="btn btn-primary">Voltar</a>
        </center>
    </p>
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