<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
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
    <link href="css/lc_lightbox.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <title>GAAR - Pesquisa de termo</title>
    
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
        <br>
        <center><p>Para pesquisar um termo, escolha uma das opções abaixo ou, se deseja visualizar todos, deixe os campos em branco</p></center>
        <br>
     	<form action="resultadotermo.php" id="form" name="pesquisatermo"  method="POST">
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome do animal: </label> 
                  <div class="col-sm-10">
                    <input name="nomedoanimal" type="text" id="nomedoanimal" maxlength="20" class="form-control">
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome do adotante: </label> 
                  <div class="col-sm-10">
                    <input name="adotante" type="text" id="adotante" maxlength="100" class="form-control">
                  </div>
        </div>
          <div class="form-group row">
                <label class="col-sm-2 col-form-label">Lar temporário: </label> 
                      <div class="col-sm-10">
                      <select class="form-control" id="inlineFormCustomSelect" name="lt">
                 		  <option selected value="">Selecione</option>
                 		  <?
                		 		$query = "SELECT LAR_TEMPORARIO FROM LT ORDER BY LAR_TEMPORARIO ASC";
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
                		 		$queryresp = "SELECT NOME FROM VOLUNTARIOS WHERE AREA ='operacional' ORDER BY NOME ASC";
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
                              <option name="branco" value="">Selecione</option>
                              <option name="disponivel" value="Disponível">Disponível</option>
                              <option name="Adotado" value="Adotado">Adotado</option>
                              <option name="devolvido" value="Devolvido">Devolvido</option>
                              <option name="obitos" value="Óbito">Óbito</option>
                              <option name="readotado" value="Readotado">Readotado</option>
                            </select>
                        </div>
            </div>
    <div class="form-group row">
                <label class="col-sm-2 col-form-label">Mês da adoção: </label> 
                      <div class="col-sm-10">
                          <select name="mesdaadocao" class="form-control">
                              <option name="branco" value="branco">Selecione</option>
                              <option name="jan" value="01">Janeiro</option>
                              <option name="fev" value="02">Fevereiro</option>
                              <option name="mar" value="03">Março</option>
                              <option name="abr" value="04">Abril</option>
                              <option name="mai" value="05">Maio</option>
                              <option name="jun" value="06">Junho</option>
                              <option name="jul" value="07">Julho</option>
                              <option name="ago" value="08">Agosto</option>
                              <option name="set" value="09">Setembro</option>
                              <option name="out" value="10">Outubro</option>
                              <option name="nov" value="11">Novembro</option>
                              <option name="dez" value="12">Dezembro</option>
                          </select>
                        </div>
    </div>
    <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ano da adoção: </label> 
                      <div class="col-sm-10">
                          <select name="anodaadocao" class="form-control">
                              <option name="branco" value="branco">Selecione</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2023">2022</option>
                                <option value="2022">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                                <option value="2015">2015</option>
                                <option value="2014">2014</option>
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
                      <legend class="col-form-label col-sm-2 pt-0">Pós adoção realizado? </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="posadocao" id="posadocaosim" value="Sim"><label class="form-check-label" for="gridRadios1">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="posadocao" id="posadocaonao" value="Não"><label class="form-check-label" for="gridRadios1">Não</label>
                        </div>
                      </div>
                    </div>
           </fieldset>
           <br>
        <center><a href="javascript:pesquisatermo.submit()" class="btn btn-primary">Pesquisar</a></center>
      </form>
      <br>
      <div>
                  <!--<div id="divlanc" class="d-none">-->
                  <div id="divanimais" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMOS TERMOS CADASTRADOS</h4><br>
                    	<?

                    	    $query = "SELECT * FROM TERMO_ADOCAO ORDER BY ID DESC LIMIT 10";
                    		$result = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($result);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Número</th>";
                            	echo "<th scope='col'>Adotante</th>";
                            	echo "<th scope='col'>Nome</th>";
                            	echo "<th scope='col'>Espécie</th>";
                            	/*echo "<th scope='col'>LT</th>";*/
                            	echo "<th scope='col' colspan='4'>Data da adoção</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $id = $fetch[0];
                    	            $adotante = $fetch[1];
                    	            $animal = $fetch[15];
                    	            $especie = $fetch[16];
                    				$lt = $fetch[30];
                    				$dtadocao = $fetch[32];
                    				
                    				$ano_adocao = substr($dtadocao,0,4);
		                            $mes_adocao = substr($dtadocao,5,2);
		                            $dia_adocao = substr($dtadocao,8,2);
		                            
                            			echo "<tr>";
                            			echo "<td>".$id."</td>";
                            			echo "<td>".$adotante."</td>";
                            			echo "<td>".$animal."</td>";
                    					echo "<td>".$especie."</td>";
                    					/*echo "<td>".$lt."</td>";*/
                    					echo "<td>".$dia_adocao."/".$mes_adocao."/".$ano_adocao."</td>";
                    					echo "<td align='bottom' colspan='2'><a href='formvisualizatermo.php?idtermo=".$fetch[0]."' class='btn btn-primary'>Visualizar</a>&nbsp;&nbsp;<a href='formatualizatermo.php?idtermo=".$fetch[0]."' class='btn btn-primary'>Atualizar</a>&nbsp;&nbsp;</td>";
                    					if ($area =='diretoria'){
                    					    echo "<td align='bottom' colspan='1'><a href='deletatermo.php?idtermo=".$fetch[0]."' class='btn btn-primary'>Deletar</a>&nbsp;</td>";    
                    					}
                    					echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum termo encontrado</p><br>";
                    		}
                    	?>
                    	</center>
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
<script src="lib/AlloyFinger/alloy_finger.min.js"></script>
<script src="js/lc_lighbox.lite.min.js"></script>
<!--- BOOTSTRAP --->
</body>
</html>