<?php 		
/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
$login = $_SESSION['login'];

if($login == "" || $login == null){
		  echo"<script language='javDESCript' type='text/javscript'>
		  alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{

        $queryarea = "SELECT * FROM VOLUNTARIOS WHERE USUARIO ='$login'";
        $selectarea = mysqli_query($connect,$queryarea);
        
        while ($fetcharea = mysqli_fetch_row($selectarea)) {
        		$area = $fetcharea[5];
        		
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
    
    <title>GAAR - Busca de valores</title>
    
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
    <center>
           <br>
        <h3>RESULTADO DAS VENDAS DOS CALENDÁRIOS</h3><br>
        <p><label> Todas as vendas de calendários estão cadastradas aqui. Caso alguma venda não foi encontrada, cadastre <a href="formvendacalendar.php">aqui</a>. </label></p>
       </center>
<?php 			
		
				
		$clinica = $_POST['clinica'];
		
	    $query = "SELECT * FROM CLINICAS WHERE CLINICA = '".$clinica."'";
		$select = mysqli_query($connect,$query);
		$reccount = mysqli_num_rows($select);
		
		if ($reccount == 0) {
			echo "<center>Nenhum valor encontrado <br><br>";
		}else{ 
		    while ($fetchclinica = mysqli_fetch_row($select)) {
    		   	$nomeclinica = $fetchclinica[1];
    			$valorgato = $fetchclinica[10];
    			$valorgata = $fetchclinica[11];
    			$valormachop = $fetchclinica[12];
    			$valormachom = $fetchclinica[13];
    			$valormachog = $fetchclinica[14];
    			$valorfemeap = $fetchclinica[15];
    			$valorfemeam = $fetchclinica[16];
    			$valorfemeag = $fetchclinica[17];
    			echo "<div class='col-sm-10'>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitgato' value='".$valorgato."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valorgato." - gato</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitgata' value='".$valorgata."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valorgata." - gata</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitmachop' value='".$valormachop."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valormachop." - cão pequeno</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitmachom' value='".$valormachom."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valormachom." - cão médio</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitmachog' value='".$valormachog."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valormachog." - cão grande</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitfemeap' value='".$valorfemeap."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valorfemeap." - cadela pequena</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitfemeam' value='".$valorfemeam."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valorfemeam." - cadela média</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitfemeag' value='".$valorfemeag."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valorfemeag." - cadela grande</label>
                        </div>
                      </div>";
    		}
		}
		
		mysqli_close($connect);
}
?>
</center>
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