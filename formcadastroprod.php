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
    
    <title>GAAR - Cadastro de produtos</title>
    
	<script type="text/javascript">
                        
                            function OnChangeRadio1 (radio) {
                                        document.getElementById('divcaneca').className  = "d-block";
                                        document.getElementById('divcalendario').className  = "d-none";
                                }
                                
                            function OnChangeRadio2 (radio) {
                                        document.getElementById('divcaneca').className  = "d-none";
                                        document.getElementById('divcalendario').className  = "d-block";
                                }
                                
                            function OnChangeRadio3 (radio) {
                                        document.getElementById('valor').value  = "30.00";
                                        document.getElementById('preco_custo').value  = "17.50";
                                        document.getElementById('Com colher').disabled = true;
                                        document.getElementById('Preta').disabled = true;
                                        document.getElementById('Verde').disabled = true;
                                        document.getElementById('Marrom').disabled = true;
                                        document.getElementById('Laranja').disabled = true;
                                        document.getElementById('Azul').disabled = true;
                                        document.getElementById('Rosa').disabled = true;
                                        document.getElementById('Branca').checked = true;
                                        document.getElementById('Normal').checked = true;
                                }
                                
                            function OnChangeRadio4 (radio) {
                                        document.getElementById('valor').value  = "35.00";
                                        document.getElementById('preco_custo').value  = "17.50";
                                        document.getElementById('Com colher').disabled = false;
                                        document.getElementById('Preta').disabled = false;
                                        document.getElementById('Verde').disabled = false;
                                        document.getElementById('Marrom').disabled = false;
                                        document.getElementById('Laranja').disabled = false;
                                        document.getElementById('Azul').disabled = false;
                                        document.getElementById('Rosa').disabled = false;
                                        document.getElementById('Branca').checked = false;
                                        document.getElementById('Normal').checked = false;
                                }
                                
                            function OnChangeRadio5 (radio) {
                                        document.getElementById('valor').value  = "40.00";
                                        document.getElementById('preco_custo').value  = "25.00";
                                }
                            
                            function OnChangeRadio6 (radio) {
                                        document.getElementById('valor').value  = "35.00";
                                        document.getElementById('preco_custo').value  = "17.50";
                                }
                                

    </script>
    
</head>
<body onload="loadData()"> 
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
       <center>
        <h3>CADASTRO DE PRODUTOS</h3><br>
        <p><label> É importante cadastrar o produto pois as informações aqui preenchidas irão ser usadas para controlar o estoque, gerar estatísticas e relatórios</label></p>
       </center>
            <form action="cadastroprod.php" method="POST" enctype="multipart/form-data" name="form">
                	<fieldset class="form-group">
                        <div class="row">
                          <legend class="col-form-label col-sm-2 pt-0">Produto: </legend>
                          <div class="col-sm-5">
                              <select class="form-control" id="produto" name="produto" required> 
                                    <option selected value="">Selecione</option>
                              <? 
                                    $queryprod = "SELECT DISTINCT(PRODUTO) FROM CONTROLE_ESTOQUE ORDER BY PRODUTO ASC";
                            		$selectprod = mysqli_query($connect,$queryprod);
                            		$reccountprod = mysqli_num_rows($selectprod);
                            		
                            		while ($fetchprod = mysqli_fetch_row($selectprod)) {
                                         echo "<option value='".$fetchprod[0]."'>".$fetchprod[0]."</option>";
                                    }
                              ?>
                              </select>
                          </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                          <legend class="col-form-label col-sm-2 pt-0">Descrição: </legend>
                          <div class="col-sm-5">
                              <input name="descricao" type="text" id="descricao" maxlength="100" class="form-control" required>
                          </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Quantidade: </legend>
                                <div class="col-sm-2">
                                    <input name="qtde" type="text" id="qtde" maxlength="5" class="form-control" required>
                                </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                          <legend class="col-form-label col-sm-2 pt-0">Fornecedor: </legend>
                          <div class="col-sm-5">
                              <select class="form-control" id="idfornec" name="idfornec" required> 
                                    <option selected value="">Selecione</option>
                              <? 
                                    $queryfornec = "SELECT ID,NOME_FORNEC FROM FORNECEDORES ORDER BY NOME_FORNEC ASC";
                            		$selectfornec = mysqli_query($connect,$queryfornec);
                            		$reccountfornec = mysqli_num_rows($selectfornec);
                            		
                            		while ($fetchfornec = mysqli_fetch_row($selectfornec)) {
                                         echo "<option value='".$fetchfornec[0]."'>".$fetchfornec[1]."</option>";
                                    }
                              ?>
                              </select>
                          </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Fundo da estampa: </legend>
                                  <div class="col-sm-09">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="fundoestampa" id="Branco" value="Branco"> <label class="form-check-label">Branco </label> &nbsp; &nbsp;<br>
                                        <input class="form-check-input" type="radio" name="fundoestampa" id="Original" value="Original"> <label class="form-check-label">Original </label> &nbsp; &nbsp;<br>
                                        <input class="form-check-input" type="radio" name="fundoestampa" id="0" value="0"> <label class="form-check-label">Não se aplica</label> &nbsp; &nbsp;<br>
                                    </div>
                                   </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Volume: </legend>
                                <div class="col-sm-2">
                                    <input name="volume" type="text" id="volume" maxlength="15" class="form-control" required>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="volume0" id="volume0" value="0" onclick="OnChangeRadio3 (this)"> <label class="form-check-label">Não se aplica</label>
                                    </div>
                                </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                          <legend class="col-form-label col-sm-2 pt-0">Modelo: </legend>
                          <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="caneca_modelo" id="Normal" value="Normal" ><label class="form-check-label" for="gridRadios1" required>Normal</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="caneca_modelo" id="Com colher" value="Com colher" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1">Com colher</label>
                            </div>
                          </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                            <div class="row">
                              <legend class="col-form-label col-sm-2 pt-0">Cor interna: </legend>
                              <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="caneca_corinterna" id="Branca" value="Branca" onclick="OnChangeRadio6 (this)"><label class="form-check-label" for="gridRadios1" required>Branca</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="caneca_corinterna" id="Preta" value="Preta" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1" required>Preta</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="caneca_corinterna" id="Verde" value="Verde" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1" required>Verde</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="caneca_corinterna" id="Marrom" value="Marrom" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1" required>Marrom</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="caneca_corinterna" id="Laranja" value="Laranja" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1" required>Laranja</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="caneca_corinterna" id="Azul" value="Azul" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1" required>Azul</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="caneca_corinterna" id="Rosa" value="Rosa" onclick="OnChangeRadio5 (this)"><label class="form-check-label" for="gridRadios1" required>Rosa</label>
                                </div>
                              </div>
                            </div>
                        </fieldset>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Preço de custo: </legend>
                                <div class="col-sm-4">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">R$ </div>
                                        <input name="preco_custo" type="text" id="preco_custo" maxlength="13" class="form-control" required>
                              </div>
                              <small id="passwordHelpBlock" class="form-text text-muted">Ao invés de vírgula, coloque ponto</small>
                                </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Preço de venda: </legend>
                                <div class="col-sm-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">R$ </div>
                                            <input name="valor" type="text" id="valor" maxlength="13" class="form-control" required>
                                    </div>
                                    <small id="passwordHelpBlock" class="form-text text-muted">Ao invés de vírgula, coloque ponto</small>
                                </div>
                        </div>
                    </fieldset>
                    <div class="form-row d-none" id="divcalendario">
                        <fieldset class="form-group">
                            <div class="row">
                              <legend class="col-form-label col-sm-2 pt-0">Modelo: </legend>
                              <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="calendario_modelo" id="Mesa" value="Mesa" ><label class="form-check-label" for="gridRadios1" required>Mesa</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="calendario_modelo" id="Parede" value="Parede" ><label class="form-check-label" for="gridRadios1">Parede</label>
                                </div>
                              </div>
                            </div>
                        </fieldset>
                    </div>
                    
                <center><a href="javascript:form.submit()" class="btn btn-primary">Cadastrar</a></center>
            </form>
            <div id="divultimos" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMOS PRODUTOS CADASTRADOS</h4><br>
                    	<?

                    	    $query = "SELECT * FROM CONTROLE_ESTOQUE ORDER BY ID DESC limit 10";
                    		$select = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($select);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Código</th>";
                            	echo "<th scope='col'>Descrição</th>";
                            	echo "<th scope='col'>Valor de venda</th>";
                            	echo "<th scope='col'>Preço de custo</th>";
                            	echo "<th scope='col'>Quantidade</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($select)) {
                    	            $codigo = $fetch[0];
                    				$descprod = $fetch[1];
                    				$qtde = $fetch[2];
                    				$valor = $fetch[3];
                    				$preco_custo = $fetch[4];

                        			echo "<tr>";
                        			echo "<td>".$codigo."</td>";
                					echo "<td>".$descprod."</td>";
                					echo "<td>".$valor."</td>";
                					echo "<td>".$preco_custo."</td>";
                					echo "<td>".$qtde."</td>";
                				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum animal encontrado</p><br>";
                    		}
                    	?>
                    	<p> Para visualizar todos os pré termos recebidos, <a href="pesquisapretermo.php">clique aqui</a></p>
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
<!--- BOOTSTRAP --->
</body>
