<?php 

session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
$login = $_SESSION['login'];
$idcandidvol = $_GET['id'];


if($login == "" || $login == null ){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}

		$query = "SELECT * FROM FORM_VOLUNTARIO WHERE ID ='$idcandidvol' ORDER BY ID DESC";
    	$select = mysqli_query($connect,$query);
    	$reccount = mysqli_num_rows($select);
    	$fetch = mysqli_fetch_row($select);
		
		$idcandidvol = $fetch[0];	
        $nomecandidvol = $fetch[1];	
        $telcandidvol = $fetch[4];	
        $emailcandidvol = $fetch[5];	
		$areacandidvol = $fetch[6];
		$comopodeajudar = $fetch[7];
		$dtcandidvol = $fetch[23];
		$bairrovol = $fetch[20];
		$enderecovol = $fetch[21];
		
		
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
    
    <title>GAAR - Candidato à voluntário</title>
    
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
	        <h3>CANDIDATO À VOLUNTÁRIO</h3><br>
      </CENTER> 
	  <form action="atualizapretermo.php" method="POST" enctype="multipart/form-data" name="form" required>
      	    <div class="form-group row">
                  <label class="col-sm-3 col-form-label pull-right" ><strong>Cadastro número: </strong></label> 
                  <div class="col-sm-08">
                    <label class="col-form-label pull-right"><? echo $idcandidvol ?></label> 
                  </div>
            </div>
      	    <div class="form-group row">
                  <label class="col-sm-3 col-form-label pull-right" ><strong>Nome completo: </strong></label> 
                  <div class="col-sm-08">
                    <label class="col-form-label pull-right"><? echo $nomecandidvol ?></label> 
                  </div>
            </div>
            <div class="form-group row">
                  <label class="col-sm-3 col-form-label pull-right"><strong>Telefone: </strong></label> 
                  <div class="col-sm-08">
                    <label class="col-form-label pull-right"><? echo $telcandidvol ?></label> 
                  </div> 
            </div>
            <div class="form-group row">
                  <label class="col-sm-3 col-form-label pull-right"><strong>Endereço: </strong></label> 
                  <div class="col-sm-08">
                    <label class="col-form-label pull-right"><? echo $enderecovol ?></label> 
                  </div> 
            </div>
            <div class="form-group row">
                  <label class="col-sm-3 col-form-label pull-right"><strong>Bairro: </strong></label> 
                  <div class="col-sm-08">
                    <label class="col-form-label pull-right"><? echo $bairrovol ?></label> 
                  </div> 
            </div>
            <div class="form-group row">
                  <label class="col-sm-3 col-form-label pull-right"><strong>E-mail:</strong></label> 
                  <div class="col-sm-08">
                    <label class="col-form-label pull-right"><a href="mailto:<? echo $emailcandidvol ?>"><? echo $emailcandidvol ?></a></label> 
                  </div>
            </div>
            <div class="form-group row">
                  <label class="col-sm-3 col-form-label pull-right"><strong>Área que pode ajudar:</strong></label> 
                  <div class="col-sm-08">
                    <label class="col-form-label pull-right"><? echo $areacandidvol ?></label> 
                  </div>
            </div>
            <div class="form-group row">
                  <label class="col-sm-3 col-form-label pull-right"><strong>Como pode ajudar:</strong></label> 
                  <div class="col-sm-08">
                    <label class="col-form-label pull-right"><? echo $comopodeajudar ?></label> 
                  </div>
            </div>
        </div>
	  </form>
    <br>
    <div class="form-group row">
        <div class="col-sm-04">
            <form method="POST" name="enviowhatspretermo" action="enviowhatspretermo.php">
                <center><input name="whats" value="Enviar WhatsApp" type="button" onClick="location.href='https://api.whatsapp.com/send?phone=55<? echo $telcandidvol ?>'" class="btn btn-primary"></center>
            </form>
        </div>
        &nbsp;&nbsp;
        <div class="col-sm-04">
            <form method="POST" name="enviowhatspretermo" action="enviowhatspretermo.php">
                <center><a href='mailto:<? echo $emailcandidvol ?>' class='btn btn-primary'>Enviar e-mail</a></center>
            </form>
        </div>
        &nbsp;&nbsp;
        <div class="col-sm-04">
            <form method="GET" name="cadastro_voluntario" action="cadastro_voluntario.php">
                <center><a href="cadastro_voluntario.php?idvol=<? echo trim($idcandidvol) ?>" class='btn btn-primary'>Fazer cadastro no sistema</a></center>
            </form>
        </div>
    </div>
        <center><a href='listacandidvol.php' class='btn btn-primary'>Nova pesquisa</a> &nbsp;&nbsp;</center>
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