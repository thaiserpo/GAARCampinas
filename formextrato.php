<?php
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}
else{
	
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
    
    <title>GAAR - Relatórios</title>

    <script type="text/javascript">
	
        function OnChangeRadio (radio) {
                    document.getElementById('divano').className  = "d-block";
                    document.getElementById('divmes').className  = "d-block";
                    document.getElementById('divbanco').className  = "d-block";
            }
        
        function OnChangeRadio2 (radio) {
                    document.getElementById('divano').className  = "d-block";
                    document.getElementById('divmes').className  = "d-none";
                    document.getElementById('divbanco').className  = "d-block";
            }    
        
        function OnChangeRadio3 (radio) {
                    document.getElementById('divano').className  = "d-block";
                    document.getElementById('divmes').className  = "d-block";
                    document.getElementById('divbanco').className  = "d-none";
            }   
            
            
    </script>
    
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
	   <form method='POST' action='envioemailextrato.php' name='extrato' target='_blank' enctype="multipart/form-data">
          <center>
           <br>
            <h3>EXTRATOS BANCÁRIOS</h3><br>
           </center>
        <p><strong>Caso queira fazer upload do extrato</p></strong>
        <i>Observações:</i>
        <p>- O arquivo precisa estar em formato CSV UTF-8 delimitado por vírgula</p>
        <p>- As datas precisam estar no formato dd/mm/yyyy</p>
        <p>- Uma aba por arquivo</p>
        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Extrato<font color="red"><strong>*</strong></font>: </label> 
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="extratoxls" name="extratoxls" accept=".csv">
                    <small id="passwordHelpBlock" class="form-text text-muted">Arquivo aceito em formato CSV UTF-8 delimitado por vírgula</small>
            </div>
        </div>
        <!--<div class="form-group row">
          <label class="col-sm-2 col-form-label">Banco<font color="red"><strong>*</strong></font>: </label> 
          <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="banco" id="Banco Itaú" value="Banco Itaú"> <label class="form-check-label" required>Banco Itaú</label> &nbsp; &nbsp;
                            </div>
                            <div class="form-check">    
                                <input class="form-check-input" type="radio" name="banco" id="PagBank" value="PagBank"> <label class="form-check-label">PagBank</label> &nbsp; &nbsp;
                            </div>
                            <div class="form-check">    
                                <input class="form-check-input" type="radio" name="banco" id="Mercado Pago" value="Mercado Pago"> <label class="form-check-label">Mercado Pago</label> &nbsp; &nbsp;
                            </div>
          </div>
        </div>-->
        <p><strong>Ou caso queira buscar os lançamentos bancários:</p></strong>
        <div id="divano" class="form-row d-block">
                <div class="form-group col-md-6">
                      <label>Ano: </label>
                          <select class="form-control" id="inlineFormCustomSelect" name="ano" required>
                                      <option name="branco" value="branco">Selecione</option>
                                      <?
                                		 		$queryyr = "SELECT DISTINCT(YEAR(DATA_LANC)) FROM FINANCEIRO ORDER BY DATA_LANC ASC";
                                				$selectyr = mysqli_query($connect,$queryyr);
                                				
                                				while ($fetchyr = mysqli_fetch_row($selectyr)) {
                                				    $ano_lanc = substr($fetchyr[0],0,4);
                                					echo "<option value='".$ano_lanc."'>".$ano_lanc."</option>";
                                				}
                                				
                                				
                                	  ?>
                                    
                        </select>
                </div>
        </div>
        <div id="divmes" class="form-row d-block">
                <div class="form-group col-md-6">
                      <label>Mês: </label>
                        <select class="form-control" id="inlineFormCustomSelect" name="mes" required>
                                        <option name="branco" value="branco">Selecione</option>
                                        <?
                                		 		$querymth = "SELECT DISTINCT(MONTH(DATA_LANC)) FROM FINANCEIRO ORDER BY DATA_LANC ASC";
                                				$selectmth = mysqli_query($connect,$querymth);
                                				
                                				while ($fetchmth = mysqli_fetch_row($selectmth)) {
                                					echo "<option value='".$fetchmth[0]."'>".$fetchmth[0]."</option>";
                                				}
                                				
                                				
                                	  ?>
                        </select>
                </div>
        </div>
        
         <center><a href="javascript:extrato.submit()" class="btn btn-primary">Enviar</a></center>
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
</html>