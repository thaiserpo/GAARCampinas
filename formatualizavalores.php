<?php 		

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
				$email = $fetcharea[2];
		}
		
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta charset="gb18030">
    <!-- Meta tags Obrigat贸rias -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Atualização de valores</title>
    
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
				  case 'clinica':
				  	include_once("menu_vet.php") ;
					break;
				  case 'veterinario':
				  	include_once("menu_veterinario.php") ;
					break;
				  case 'lt':
				  	include_once("menu_lt.php") ;
					break;
			  }
?>
<main role="main" class="container">
    <div class="starter-template">
      <br>
         <center><h4> ATUALIZAÇÃO DOS VALORES</h4><br>
        <?
        
            $queryclinica = "SELECT * FROM CLINICAS WHERE EMAIL = '".$email."' ORDER BY CLINICA ASC";
            $selectclinica = mysqli_query($connect,$queryclinica);
            $reccount = mysqli_num_rows($selectclinica);
                                                 		  
			while ($fetchclinica = mysqli_fetch_row($selectclinica)) {
			    $id = $fetchclinica[0];
				$valorgato = $fetchclinica[10];
				$valorgata = $fetchclinica[11];
				$valormachop = $fetchclinica[12];
				$valormachom = $fetchclinica[13];
				$valormachog = $fetchclinica[14];
				$valorfemeap = $fetchclinica[15];
				$valorfemeam = $fetchclinica[16];
				$valorfemeag = $fetchclinica[17];
			}
        
        ?>
            <p> ID do cadastro: <? echo $id ?></p><br>
            <p> Todos os campos são <strong><font color="red">obrigatórios</font></strong></p></center>
            <form method="POST" name="form" action="atualizavalores.php" enctype="multipart/form-data" >
                <input name="id" type="text" id="id" maxlength="20" class="form-control" required value="<? echo $id ?>" hidden>
        	    <div class="form-row">
                    <div class="form-group col-md-4">
                            <label>Castração de gato: </label>
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                                    <input name="valorunitgato" type="text" id="valorunitgato" maxlength="20" class="form-control" required value="<? echo $valorgato ?>">
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">Ao invés da vírgula, colocar ponto</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                            <label>Castração de gata: </label>
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                                    <input name="valorunitgata" type="text" id="valorunitgata" maxlength="20" class="form-control" required value="<? echo $valorgata ?>">
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">Ao invés da vírgula, colocar ponto</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                            <label>Castração de cão pequeno: </label>
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                                    <input name="valorunitmachop" type="text" id="valorunitmachop" maxlength="20" class="form-control" required value="<? echo $valormachop ?>">
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">Ao invés da vírgula, colocar ponto</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                            <label>Castração de cão médio: </label>
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                                    <input name="valorunitmachom" type="text" id="valorunitmachom" maxlength="20" class="form-control" required value="<? echo $valormachom ?>">
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">Ao invés da vírgula, colocar ponto</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                            <label>Castração de cão grande: </label>
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                                    <input name="valorunitmachog" type="text" id="valorunitmachog" maxlength="20" class="form-control" required value="<? echo $valormachog ?>">
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">Ao invés da vírgula, colocar ponto</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                            <label>Castração de cadela pequena: </label>
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                                    <input name="valorunitfemeap" type="text" id="valorunitfemeap" maxlength="20" class="form-control" required value="<? echo $valorfemeap ?>">
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">Ao invés da vírgula, colocar ponto</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                            <label>Castração de cadela média: </label>
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                                    <input name="valorunitfemeam" type="text" id="valorunitfemeam" maxlength="20" class="form-control" required value="<? echo $valorfemeam ?>">
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">Ao invés da vírgula, colocar ponto</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                            <label>Castração de cadela grande: </label>
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                                    <input name="valorunitfemeag" type="text" id="valorunitfemeag" maxlength="20" class="form-control" required value="<? echo $valorfemeag ?>">
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">Ao invés da vírgula, colocar ponto</small>
                    </div>
                </div>
                <br>
                
                <center><a href="javascript:form.submit()" class="btn btn-primary">Atualizar</a></center>
        </form>
        <br>
<?
    }
?>
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
</html>
