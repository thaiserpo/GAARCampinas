<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
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
    
    <title>GAAR - Pesquisa interna de animais</title>
    
    <!--- GOOGLE ADSENSE --->
     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
     <!--- GOOGLE ADSENSE --->
    
</head>
<body> 
<?php 
		
		switch ($area) {
				  case 'operacional':
				    if ($subarea == 'lt'){
				        include_once("menu_lt.php") ;
				    }  else {
				        include_once("menu_operacional.php") ;    
				    }
				  	
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
     	<form action="pesquisapetinterna.php" id="pesquisanimal" name="pesquisanimal" method="POST">
     	    <center><p>Para pesquisar um animal, escolha uma das opções abaixo ou, se deseja visualizar todos, deixe os campos em branco</p><br></center>
            <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome do animal: </label> 
                  <div class="col-sm-10">
                    <input name="nomedoanimal" type="text" id="nomedoanimal" maxlength="20" class="form-control">
                  </div>
            </div>
            <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Código do animal: </label> 
                  <div class="col-sm-10">
                    <input name="iddoanimal" type="number" id="iddoanimal" maxlength="20" class="form-control">
                  </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Lar temporário: </label> 
                      <div class="col-sm-10">
                      <select class="form-control" id="inlineFormCustomSelect" name="lt">
                 		  <option selected value="">Selecione</option>
                 		  <?
                		 		$query = "SELECT LAR_TEMPORARIO FROM LT WHERE ATIVO='SIM' ORDER BY LAR_TEMPORARIO ASC";
                				$select = mysqli_query($connect,$query);
                				
                				while ($fetch = mysqli_fetch_row($select)) {
                					echo "<option value='".$fetch[0]."'>".$fetch[0]."</option>";
                				}
                				
                				
                		?>
                	    </select>
                	 </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Responsável: </label> 
                      <div class="col-sm-10">
                      <select class="form-control" id="inlineFormCustomSelect" name="resp">
                 		  <option selected value="">Selecione</option>
                 		  <?
                		 		$queryresp = "SELECT NOME FROM VOLUNTARIOS WHERE AREA <>'clinica' and AREA <> 'anuncios' ORDER BY NOME ASC";
                				$selectresp = mysqli_query($connect,$queryresp);
                				
                				while ($fetchresp = mysqli_fetch_row($selectresp)) {
                					echo "<option value='".$fetchresp[0]."'>".$fetchresp[0]."</option>";
                				}
                				
                				
                		?>
                	    </select>
                    </div>
                </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status: </label> 
                      <div class="col-sm-10">
                          <select name="status" class="form-control">
                              <option value="">Selecione</option>
                              <option value="Disponível">Disponível</option>
                              <option value="Indisponível">Indisponível</option>
                              <option value="Adotado">Adotado</option>
                              <option value="Adotado (sem termo)">Adotado (sem termo)</option>
                              <option value="Devolvido">Devolvido</option>
                              <option value="Óbito">Óbito</option>
                              <option value="Pré adotado">Pré adotado</option>
                              <option value="Em adaptação">Em adaptação</option>
                              <option value="Não divulgar">Não divulgar para adoção (para controle do CPG)</option>
                            </select>
                        </div>
            </div>
          <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Espécie: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="especie" id="Canina" value="Canina"><label class="form-check-label" for="gridRadios1">Canina</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="especie" id="Felina" value="Felina"><label class="form-check-label" for="gridRadios1">Felina</label>
                        </div>
                      </div>
                    </div>
         </fieldset>
         <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Sexo: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sexo" id="Macho" value="Macho"><label class="form-check-label" required>Macho </label> &nbsp;&nbsp;
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sexo" id="Fêmea" value="Fêmea"><label class="form-check-label">Fêmea </label> 
                        </div>
                      </div>
                    </div>
           </fieldset>
            <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Porte: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="porte" id="Pequeno" value="Pequeno"> <label class="form-check-label">Pequeno </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">    
                            <input class="form-check-input" type="radio" name="porte" id="Médio" value="Médio"> <label class="form-check-label">Médio </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="porte" id="Grande" value="Grande"> <label class="form-check-label">Grande </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="porte" id="Não se aplica" value="Não se aplica"> <label class="form-check-label">Gato </label> &nbsp; &nbsp;
                        </div>
                      </div>
                    </div>
                </fieldset>
            <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Perfil: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="outrosanimais" id="outrosanimais" value="Sim" ><label class="form-check-label">Convive bem com outros animais</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="outrosanimais" id="outrosanimais" value="Não" ><label class="form-check-label">Não convive bem com outros animais</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="criancas" id="criancas" value="Sim" ><label class="form-check-label">Convive bem com crianças</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="criancas" id="criancas" value="Não" ><label class="form-check-label">Não convive bem com crianças</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="apto" id="apto" value="Sim" ><label class="form-check-label">Vive bem em apartamento </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="apto" id="apto" value="Não" ><label class="form-check-label">Não vive bem em apartamento </label>
                        </div>
                       </div>
                    </div>
                </fieldset>
            <fieldset class="form-group">
                <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Divulgar como: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="divulgar" id="divulgar" value="GAAR"><label class="form-check-label">GAAR </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="divulgar" id="divulgar" value="Terceiros"><label class="form-check-label">Terceiros </label>
                        </div>
                        <div class='form-check'>
                           <input class="form-check-input" type="radio" name="divulgar" id="divulgar" value="Não divulgar"><label class='form-check-label'>Não divulgar para adoção (para controle do CPG)</label>
                        </div>
                        <div class='form-check'>
                           <input class="form-check-input" type="radio" name="divulgar" id="divulgar" value="LEG"><label class='form-check-label'>LEG</label>
                        </div>
                       </div>
                </div>
            </fieldset>
            <br>
              <center><a href="javascript:pesquisanimal.submit()" class="btn btn-primary">Pesquisar</a></center>
              <br>
      </form>
      <div>
                  <!--<div id="divlanc" class="d-none">-->
                  <div id="divanimais" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMOS ANIMAIS CADASTRADOS</h4><br>
                    	<?

                    	    $query = "SELECT * FROM ANIMAL ORDER BY ID DESC LIMIT 10";
                    		$result = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($result);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Nome</th>";
                            	echo "<th scope='col'>Espécie</th>";
                            	echo "<th scope='col'>Sexo</th>";
                            	echo "<th scope='col'>Responsável</th>";
                            	echo "<th scope='col'>LT</th>";
                            	echo "<th scope='col' colspan='2'>Status</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $id = $fetch[0];
                    	            $nome = $fetch[1];
                    				$especie = $fetch[2];
                    				$sexo = $fetch[4];
                    				$resp = $fetch[12];
                    				$lt = $fetch[11];
                    				$status = $fetch[10];
                            			echo "<tr>";
                            			echo "<td><a href='formatualizapet.php?idanimal=".$id."'>".$nome."</a></td>";
                    					echo "<td>".$especie."</td>";
                    					echo "<td>".$sexo."</td>";
                    					echo "<td>".$resp."</td>";
                    					echo "<td>".$lt."</td>";
                    					echo "<td>".$status."</td>";
                    					echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$id."' target='_blank'>Ver no site</a></td>";
                    				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum animal encontrado</p><br>";
                    		}
                    	?>
                    	</center>
                </div>
    </div>
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