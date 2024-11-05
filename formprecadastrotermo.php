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
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <title>GAAR - Cadastro de termo</title>
    
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
        <center><p>Para cadastrar um termo, é necessário buscar os dados do animal. <br>
		           Selecione as opções abaixo ou, se deseja visualizar todos, deixe os campos em branco</p></center>
     	<form action="precadastrotermo.php" id="form" name="pesquisanimal" method="POST">
         <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome do animal<font color="red"><b>*</b></font>: </label> 
                  <div class="col-sm-5">
                    <select class="form-control" id="iddoanimal" name="iddoanimal" required>
                         		  <option selected value="">Selecione</option>
                         		  <?
                        		 		$query = "SELECT ID,NOME_ANIMAL FROM ANIMAL WHERE (ADOTADO ='Disponivel' OR ADOTADO='Adotado (sem termo)' OR ADOTADO='Em adaptação' OR ADOTADO='Pré adotado') and DIVULGAR_COMO ='GAAR' ORDER BY NOME_ANIMAL,ESPECIE ASC";
                        				$select = mysqli_query($connect,$query);
                        				
                        				while ($fetch = mysqli_fetch_row($select)) {
                        					echo "<option value='".$fetch[0]."'>".$fetch[1]."</option>";
                        				}
                        		?>
                	</select>
                	<small id="passwordHelpBlock" class="form-text text-muted">A lista será apresentada como nome e espécie de forma ascendente. Ex: para dois nomes iguais, o primeiro nome será a espécie Canina e o segundo Felina</small>
                  </div>
                  <!--<div class="col-sm-10">
                    <input name="iddoanimal" type="text" id="" maxlength="20" class="form-control">
                  </div>-->
         </div>
         <div class="form-group row">
                  <label class="col-sm-6 col-form-label">Caso o nome não esteja na lista, <a href="formpesquisapetinterna.php" target="_blank">pesquise aqui</a></label> 
         </div>
         <!--<fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Espécie<font color="red"><b>*</b></font>: </legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="especie" id="Canina" value="Canina"><label class="form-check-label" for="gridRadios1" required>Canina</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="especie" id="Felina" value="Felina"><label class="form-check-label" for="gridRadios1">Felina</label>
                        </div>
                      </div>
                    </div>
        </fieldset>-->
       <!-- <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Lar temporário<font color="red"><b>*</b></font>: </label> 
                  <div class="col-sm-10">
                    <select class="form-control" id="inlineFormCustomSelect" name="lt" required>
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
                  <label class="col-sm-2 col-form-label">Responsável (ou doador)<font color="red"><b>*</b></font>: </label> 
                  <div class="col-sm-10">
                    <select class="form-control" id="inlineFormCustomSelect" name="resp" required>
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
         </div>-->
         <div class="form-group row">
                  <label class="col-sm-12 col-form-label"><i><font color="red"><b>* Campos obrigatórios</b></font></i> </label> 
         </div>
         <center><a href="javascript:pesquisanimal.submit()" class="btn btn-primary">Pesquisar</a></center>
              </td>
          </tr>
        </table>
      </form>
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
                            	echo "<th scope='col'>Nome</th>";
                            	echo "<th scope='col'>Espécie</th>";
                            	echo "<th scope='col'>Adotante</th>";
                            	echo "<th scope='col' colspan='3'>Data da adoção</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $id = $fetch[0];
                    	            $nomeanimal = $fetch[15];
                    				$especie = $fetch[16];
                    				$adotante = $fetch[1];
                    				$dtadocao = $fetch[32];
                    				
                    				$ano_adocao = substr($dtadocao,0,4);
		                            $mes_adocao = substr($dtadocao,5,2);
		                            $dia_adocao = substr($dtadocao,8,2);

                        			echo "<tr>";
                        			echo "<td>".$id."</td>";
                        			echo "<td>".$nomeanimal."</td>";
                					echo "<td>".$especie."</td>";
                					echo "<td>".$adotante."</td>";
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
                    		        echo "<center><p>Nenhum animal encontrado</p><br>";
                    		}
                    	?>
                    	</center>
        </div>
    </div>
      <br><br>
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