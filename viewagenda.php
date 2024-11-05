<?php 

session_start();

include ("conexao.php"); 

$id = $_GET['id'];

$login = $_SESSION['login'];

if($login == "" || $login == null ){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}

        $query = "SELECT * FROM AGENDAMENTO where CODIGO='$id'";
		$select = mysqli_query($connect,$query);
        $fetch = mysqli_fetch_row($select);
		
		$data_ag = $fetch[1];
		$hora_ag = $fetch[2];
		$nomedoanimal = $fetch[3];
		$especie = $fetch[4];
		$sexo = $fetch[5];
		$porte = $fetch[6];
		$peso = $fetch[7];
		$dtnasc = $fetch[8];
		$resp = $fetch[9];
		$autorizadopor = $fetch[10];
		$telcontato = $fetch[11];
		$email_resp = $fetch[12];
		$valor_ajuda = $fetch[13];
		$valor_gaar = $fetch[14];
		$extra = $fetch[15];
		$produtos = $fetch[16];
		$obs = $fetch[17];
		$ativo = $fetch[18];
		$clinica = $fetch[19];
		$procedimento = $fetch[19];
		$data_reg = $fetch[20];
		$id_gaar = $fetch[21];
		$realizado = $fetch[22];
		
		$ano_data_ag = substr($data_ag,0,4);
        $mes_data_ag = substr($data_ag,5,2);
        $dia_data_ag = substr($data_ag,8,2);
        
        $data_ag_tmp = $dia_data_ag."/".$mes_data_ag."/".$ano_data_ag;
	

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
    
    <title>GAAR - Agendamento</title>
    
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
			  
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
	   <CENTER>
	        <h3>AGENDAMENTO <? echo $id ?></h3><br>
      </CENTER> 
	  <form action="atualizaagenda.php" method="POST" enctype="multipart/form-data" name="form" required>
       <center><h5>DADOS DO AGENDAMENTO</h5></center>
	   <div class="form-group row">
                  <label class="col-sm-2 col-form-label"><strong>Data: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $data_ag_tmp ?> - <?echo $hora_ag?>h</label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Nome do animal: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $nomedoanimal ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Espécie: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $especie ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Sexo: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $sexo ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Porte: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $porte ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Peso: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $peso ?> kg</label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Data de nascimento: </strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $dtnasc ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Responsável:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $respo ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Autorizado por:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $autorizadopor ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Telefone:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $telcontato ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>E-mail:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><a href="mailto:<? echo $email_resp ?>"><? echo $email_resp ?></a></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Valor da ajuda:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label">R$ <? echo $valor_ajuda ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Valor a ser pago pelo GAAR:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label">R$ <? echo $valor_gaar ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Extra:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $extra ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Produtos:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $produtos ?></label> 
                  </div>
                  <label class="col-sm-2 col-form-label"><strong>Obs:</strong></label> 
                  <div class="col-sm-10">
                    <label class="col-form-label"><? echo $obs ?></label> 
                  </div>
        </div>
      
	  </form>
    <br>
      <center><a href='formpesquisaagenda.php' class='btn btn-primary'>Nova pesquisa</a> &nbsp;&nbsp;</center>;
	<!--	<input type="submit" value="Atualizar" id="atualizar" required name="atualizar" onClick="atualizatermo();">
		<input type="submit" value="Ver todos os usuários" id="selecionar" required name="selecionar" onclick="seleciona();"> -->	  
    </p>
	</form> 
    <br>
   </div>
   <? 
        }
        mysqli_close($connect); 
    ?>
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