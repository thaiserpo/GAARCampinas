<?php 		

session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 

ini_set('display_errors', 1);

error_reporting(E_ALL);

$login = $_SESSION['login'];

/*if($login == "" || $login == null){
		  echo"<script language='javascript' type='text/javascript'>
		  alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{*/

$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
$selectarea = mysqli_query($connect,$queryarea);

while ($fetcharea = mysqli_fetch_row($selectarea)) {
		$area = $fetcharea[0];
}

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
    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Sócios contribuintes</title>
    
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
			  
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
<form action="result_socio.php" id="result_socio" name="result_socio" method="POST">
     	    <center><p>Para pesquisar um sócio, escolha uma das opções abaixo ou se preferir apenas clique em Pesquisar para exibir todos os resultados:</p><br></center>
          <div class="form-group row">
                <label class="col-sm-3 col-form-label">Forma da contribuição: </label> 
                      <div class="col-sm-5">
                          <select name="resultsocio" class="form-control">
                              <option name="resultsocio" value="0">Selecione</option>
                              <option name="resultsocio" value="Apoia.se">Apoia.se</option>
                              <option name="resultsocio" value="Banco">Bancos (DOC/TED) </option>
                              <option name="resultsocio" value="Boleto">Boleto</option>
                              <option name="resultsocio" value="Pag Seguro">PagSeguro</option>
                              <option name="resultsocio" value="PicPay">PicPay</option>
                              <option name="resultsocio" value="PIX">PIX</option>
                            </select>
                        </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nome do sócio: </label> 
                      <div class="col-sm-5">
                          <input name="nomedosocio" type="text" id="nomedosocio" maxlength="100" class="form-control" required>
                        </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">E-mail: </label> 
                      <div class="col-sm-5">
                          <input name="emaildosocio" type="text" id="emaildosocio" maxlength="100" class="form-control" required>
                        </div>
            </div>
            <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nome do animal apadrinhado: </label> 
                  <div class="col-sm-5">
                    <select class="form-control" id="idpet" name="idpet" required>
                         		  <option selected value="0">Selecione</option><div class="form-group row">
                         		  <option value="0">----------------</option>
                         		  <option value="Todos">TODOS</option>
                         		  <option value="0">----------------</option>
                         		  <?
                        		 		$querypet = "SELECT ID,NOME_ANIMAL FROM ANIMAL WHERE (ADOTADO ='Disponivel' OR ADOTADO='Adotado (sem termo)' OR ADOTADO='Em adaptação' OR ADOTADO='Pré adotado') and DIVULGAR_COMO ='GAAR' ORDER BY NOME_ANIMAL,ESPECIE ASC";
                        				$selectpet = mysqli_query($connect,$querypet);
                        				
                        				while ($fetchpet = mysqli_fetch_row($selectpet)) {
                        					echo "<option value='".$fetchpet[0]."'>".$fetchpet[1]."</option>";
                        				}
                        		?>
                	</select>
                	<small id="passwordHelpBlock" class="form-text text-muted">A lista será apresentada como nome e espécie de forma ascendente. Ex: para dois nomes iguais, o primeiro nome será a espécie Canina e o segundo Felina</small>
                  </div>
                  <!--<div class="col-sm-10">
                    <input name="iddoanimal" type="text" id="" maxlength="20" class="form-control">
                  </div>-->
         </div>
        <center><a href="javascript:result_socio.submit()" class="btn btn-primary">Pesquisar</a></center>
        <br>
      </form>
    </div>
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