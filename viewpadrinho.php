<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$id = $_GET['id'];

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
		
        $query = "SELECT * FROM APADRINHAMENTO WHERE ID_PADRINHO='$id'";
		$select = mysqli_query($connect,$query);
        $fetch = mysqli_fetch_row($select);
		
		$id = $fetch[0];
		$nome = $fetch[1];
		$celular = $fetch[2];
		$email = $fetch[3];
		$valorajuda = $fetch[4];
		$formaajuda = $fetch[5];
		$idanimal = $fetch[6];
		$frequencia = $fetch[10];
		$ativo = $fetch[11];
		
        $querypet = "SELECT NOME_ANIMAL, ESPECIE FROM ANIMAL WHERE ID ='$idanimal'";
		$selectpet = mysqli_query($connect,$querypet);
        $fetchpet = mysqli_fetch_row($selectpet);
        
        $nome_animal =  $fetchpet[0];
        $especie =  $fetchpet[1];
		
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
    
    <title>GAAR - Apadrinhamento</title>
    
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
	        <h3>APADRINHAMENTO</h3><br>
      </CENTER> 
      <form action="#" method="POST" enctype="multipart/form-data" name="form">
	   <div class="form-group row">
                  <label class="col-sm-3 col-form-label"><strong>Nome completo: </strong></label> 
                  <div class="col-sm-8">
                    <label class="col-sm-8 col-form-label"><? echo $nome ?></label> 
                  </div>
                  <label class="col-sm-3 col-form-label"><strong>Celular:</strong></label> 
                  <div class="col-sm-8">
                    <label class="col-sm-8 col-form-label"><? echo $celular ?></label> 
                  </div>
                  <label class="col-sm-3 col-form-label"><strong>E-mail:</strong></label> 
                  <div class="col-sm-8">
                    <label class="col-sm-8 col-form-label"><a href="mailto:<? echo $email ?>"><? echo $email ?></a></label> 
                  </div>
                  <label class="col-sm-3 col-form-label"><strong>Valor da contribuição:</strong></label> 
                  <div class="col-sm-8">
                    <label class="col-sm-8 col-form-label">R$ <? echo $valorajuda ?></label> 
                  </div>
                  <label class="col-sm-3 col-form-label"><strong>Forma de ajudar:</strong></label> 
                  <div class="col-sm-8">
                    <label class="col-sm-8 col-form-label"><? echo $formaajuda ?></label> 
                  </div>
                  <label class="col-sm-3 col-form-label"><strong>Animal apadrinhado:</strong></label> 
                  <div class="col-sm-8">
                    <label class="col-sm-2 col-form-label"><? echo $nome_animal ?></label> 
                    <label class="col-sm-4 col-form-label"><a href="http://www.gaarcampinas.org/pet.php?id=<? echo $idanimal ?>" target="_blank">Ver perfil</a></label> 
                  </div>
                  <label class="col-sm-3 col-form-label"><strong>Frequência da ajuda:</strong></label> 
                  <div class="col-sm-8">
                    <label class="col-sm-8 col-form-label"><? echo $frequencia ?></label> 
                  </div>
                  <label class="col-sm-3 col-form-label"><strong>Ativo?</strong></label> 
                  <div class="col-sm-8">
                    <label class="col-sm-8 col-form-label"><? echo $ativo ?></label> 
                  </div>
        </div>
        
    <br>
    <?
      /*echo "<center><a href='formenvioemailpretermo.php?id=$id' class='btn btn-primary'>Responder ao interessado</a> &nbsp;&nbsp;<a href='enviarpretermo.php?id=$id' class='btn btn-primary'>Enviar cópia por e-mail</a>&nbsp;&nbsp;<a href='javascript:window.print()' class='btn btn-primary'>Imprimir</a></center>";*/
    ?>
        <center>
            <input name="whats" value="Enviar WhatsApp" type="button" onClick="location.href='https://api.whatsapp.com/send?phone=55<? echo $celular ?>'" class="btn btn-primary"> &nbsp; &nbsp;
        </form>
        <br><br><br>
            <a href="listapadrinhos.php" class="btn btn-primary">Voltar</a>
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