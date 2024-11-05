<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

$mes_atu = date('m');

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
    
    <link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">

    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/auto-refresh/bootstrap-table-auto-refresh.min.js"></script>
    <!--- BOOTSTRAP --->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--- BOOTSTRAP --->
    <title>GAAR - Cadastro de eventos </title>
    <script type="text/javascript">
	
	                        function OnChangeSelect (radio) {
	                                if  (document.getElementById('localevento').value == "Outro"){
	                                    document.getElementById('divoutrolocal').className  = "d-block"; 
	                                } else {
	                                    document.getElementById('divoutrolocal').className  = "d-none"; 
	                                }
                                        
                                }
                                
                            function OnClick1 (radio) {
                                        document.getElementById('divvol').className  = "d-block";
                                        document.getElementById('btnEscondeListaVol').className  = "d-block";
                                        document.getElementById('btnListaVol').className  = "d-none";
                                }
                                
                            function OnClick2 (radio) {
                                        document.getElementById('divvol').className  = "d-none";
                                        document.getElementById('btnEscondeListaVol').className  = "d-none";
                                        document.getElementById('btnListaVol').className  = "d-block";
                                        document.getElementById('divanimais').className  = "d-none";
                                }
                                
                            function OnClick3 (radio) {
                                        document.getElementById('divprod1').className  = "d-block";
                                        document.getElementById('divvol').className  = "d-none";
                                        document.getElementById('divanimais').className  = "d-none";

                                }
                                
                            function OnClick4 (radio) {
                                        document.getElementById('divanimais').className  = "d-block";
                                        document.getElementById('divprod1').className  = "d-none";
                                        document.getElementById('divvol').className  = "d-none";
                                        
                                }

                            function FechamentoCaixa (fechamento){
                                
                                var abertura = document.getElementById("aberturacaixa").value;
                                var vendasnocartao = document.getElementById("vendascartao").value;
                                var vendasdeposito = document.getElementById("vendasfisicas").value;
                                var despesas = document.getElementById("despdiarias").value;
                                
                                var total = (parseFloat(abertura) + parseFloat(vendasnocartao) + parseFloat(vendasdeposito)) - parseFloat(despesas);
                                
                                var lucro = (parseFloat(total) - parseFloat(abertura));
                                
                                if (Number.isNaN(total))
                                    total = 0;
                                    
                                document.getElementById('fechamentocaixa').value= total;
                                document.getElementById('lucro').value= lucro;
                                
                            }
                            
                            
                           $(document).ready(function(){
                             $("#btnAdicionarVol").click(function(){
                                
                            	$.ajax({
                                	url: "cadastrovol.php",
                             		type: "POST",
                             		data: {
                             		    usuario: document.getElementById("voluntarios").value,
                             		    idevento: document.getElementById("idevento").value,
                             		},
                            		success: function(response){
                            		    document.getElementById('AlertSuccess_volnome').innerHTML= document.getElementById("voluntarios").value + " cadastrado com sucesso";
                            		    document.getElementById('lblAlertSuccess_vol').className = "alert alert-success d-block";
                                    },
                                    error: function(response){
                                        document.getElementById('AlertDanger_volnome').innerHTML= document.getElementById("voluntarios").value + " não foi cadastrado. Por favor tente novamente"; 
                                        document.getElementById('lblAlertDanger_vol').className = "alert alert-danger d-block";
                                    }
                            	});
                            });
                             
                             $("#btnAdicionarProduto").click(function(){
                            	$.ajax({
                                	url: "cadastrarprod.php",
                             		type: "POST",
                             		data: {
                             		    proddesc: document.getElementById("prodvenda").value,
                             		    quantidade: document.getElementById("qtdprod").value,
                             		    idevento: document.getElementById("idevento").value,
                             		    pagamento: document.getElementById("pgto").value
                             		},
                            		success: function(response){
                            		    document.getElementById('AlertSuccess_produto').innerHTML= document.getElementById("prodvenda").value + " cadastrado com sucesso";
                            		    document.getElementById('lblAlertSuccess_prod').className = "alert alert-success d-block";
                                    },
                                    error: function(response){
                                        document.getElementById('AlertDanger_produto').innerHTML= document.getElementById("prodvenda").value + " não foi cadastrado. Por favor tente novamente"; 
                                        document.getElementById('lblAlertDanger_prod').className = "alert alert-danger d-block";
                                    }
                            	});
                            });
                            
                             $("#btnAdicionarObs").click(function(){
                                
                            	$.ajax({
                                	url: "cadastroobs.php",
                             		type: "POST",
                             		data: {
                             		    observacoes: document.getElementById("obs").value,
                             		    idfeira: document.getElementById("idevento").value,
                             		},
                            		success: function(response){
                            		    document.getElementById('lblAlertSuccess_obs').className = "alert alert-success d-block";
                                    },
                                    error: function(response){
                                        document.getElementById('lblAlertDanger_obs').className = "alert alert-danger d-block";
                                    }
                            	});
                             });
                             
                             $("#btnAdicionarAnimal").click(function(){
                                
                            	$.ajax({
                                	url: "cadastropet_feiras.php",
                             		type: "POST",
                             		data: {
                             		    idanimal: document.getElementById("idanimal").value,
                             		    idfeira: document.getElementById("idevento").value,
                             		},
                            		success: function(response){
                            		    document.getElementById('AlertSuccess_animal').innerHTML= document.getElementById("idanimal").value + " cadastrado com sucesso";
                            		    document.getElementById('lblAlertSuccess_pet').className = "alert alert-success d-block";
                                    },
                                    error: function(response){
                                        document.getElementById('AlertDanger_animal').innerHTML= document.getElementById("idanimal").value + " não foi cadastrado. Por favor tente novamente"; 
                                        document.getElementById('lblAlertDanger_pet').className = "alert alert-danger d-block";
                                    }
                            	});
                             });
                             
                             $("#btnAdicionarFoto").click(function(){
                                
                            	$.ajax({
                                	url: "cadastroobs.php",
                             		type: "POST",
                             		data: {
                             		    foto: document.getElementById("foto_caderno").value,
                             		    idfeira: document.getElementById("idevento").value,
                             		},
                            		success: function(response){
                            		    document.getElementById('lblAlertSuccess_foto').className = "alert alert-success d-block";
                                    },
                                    error: function(response){
                                        document.getElementById('lblAlertDanger_foto').className = "alert alert-danger d-block";
                                    }
                            	});
                             });
                          });
                          
                          
    </script>
    
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
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
       <center>
        <h3>CADASTRO DE EVENTOS </h3><br>
        <p><label> É importante cadastrar o evento corretamente pois as informações aqui preenchidas irão ser usadas para gerar estatísticas</label></p><br>
       </center>
    <form action="cadastroevento.php" method="POST" enctype="multipart/form-data" name="form">
        <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Data: <strong><font color="red">*</font></strong></label> 
                  <div class="col-sm-3">
                    <input name="dtevento" type="date" id="dtevento" class="form-control" >
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Evento: <strong><font color="red">*</font></strong></label> 
                  <div class="col-sm-5">
                      <select class="form-control" id="evento" name="evento" required> 
                            <option selected value="0">Selecione</option>
                            <option value="Feira de adoção">Feira de adoção</option>
                            <option value="Bazar">Bazar</option>
                            <option value="Reunião do CMPDA">Reunião do CMPDA</option>
                        </select>
                    </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Local: <strong><font color="red">*</font></strong></label> 
                  <div class="col-sm-5">
                      <select class="form-control" id="localevento" name="localevento" onChange="OnChangeSelect (this)" required> 
                            <option selected value="0">Selecione</option>
                            <option value="Petcamp Barão Geraldo">Petcamp Barão Geraldo</option>
                            <option value="Petcamp Jasmim">Petcamp Jasmim</option>
                            <option value="Praça do Côco">Praça do Côco</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
        </div>
        <div id="divoutrolocal" class="d-none">
                  <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Endereço: <strong><font color="red">*</font></strong></label> 
                      <div class="col-sm-6">
                        <input name="outrolocal" type="text" id="outrolocal" class="form-control" >
                      </div>
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Horário de início: <strong><font color="red">*</font></strong></label> 
                  <div class="col-sm-3">
                    <input name="horainicio" type="time" id="horainicio" class="form-control" >
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Horário de término: <strong><font color="red">*</font></strong></label> 
                  <div class="col-sm-3">
                    <input name="horatermino" type="time" id="horatermino" class="form-control" >
                  </div>
        </div>
        <center><a href="javascript:form.submit()" class="btn btn-primary">Cadastrar</a></center>
    </form>
    <br>
    <div class="form-group row">
                  <div id="divultimoseventos" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMOS EVENTOS CADASTRADOS</h4><br>
                    	<?

                                $queryeventos = "SELECT * FROM EVENTOS ORDER BY DATA DESC LIMIT 10";
                                $selecteventos = mysqli_query($connect,$queryeventos);
                    	        $reccounteventos = mysqli_num_rows($selecteventos);
                    	        
                    	        if ($reccount != '0'){
                        		    echo "<table class='table'>";
                                    echo "<thead class='thead-light'>";
                                	echo "<th scope='col'>Data</th>";
                                	echo "<th scope='col'>Tipo</th>";
                                	echo "<th scope='col'>Local</th>";
                                	echo "</thead>";
                                	echo "<tbody>";
                    	        
                    	           while ($fetcheventos = mysqli_fetch_row($selecteventos)) {
                        	            $idevento = $fetcheventos[0];
                        				$dtevento = $fetcheventos[4];
                        				$tipoevento = $fetcheventos[2];
                        				$localevento = $fetcheventos[3];

                        				$ano_dtevento = substr($dtevento,0,4);
                        		        $mes_dtevento = substr($dtevento,5,2);
                        		        $dia_dtevento = substr($dtevento,8,2);
                        		    
                            			echo "<tr>";
                            			echo "<td>".$dia_dtevento."/".$mes_dtevento."/".$ano_dtevento."</td>";
                    					echo "<td>".$tipoevento."</td>";
                    					echo "<td>".$localevento."</td>";
                    				    echo "</tr>";
                        			}   
                        			        echo "</tbody>";
                        			        echo "</table><br>";
                    	        }
                        		else {
                        		        echo "<p>Nenhum evento encontrado.</p><br>";
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


<?
    }
?>
</body>
</html>
