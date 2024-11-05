<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

$ano_atu = date('Y');
$mes_atu = date('m');
$mes_feira = date('m',strtotime('-2 months'));

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
    <title>GAAR - Cadastro de feiras </title>
    <script type="text/javascript">
	
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
                             		    cargo_vol: document.getElementById("cargovol").value,
                             		    idevento: document.getElementById("idevento").value,
                             		},
                            		success: function(response){
                            		    document.getElementById('AlertSuccess_volnome').innerHTML= document.getElementById("voluntarios").value + " cadastrado com sucesso";
                            		    document.getElementById('lblAlertSuccess_vol').className = "alert alert-success d-block";
                            		    document.getElementById('voluntarios').selectedIndex = "0"; 
                            		    document.getElementById('cargovol').selectedIndex = "0"; 
                                    },
                                    error: function(response){
                                        document.getElementById('AlertDanger_volnome').innerHTML= document.getElementById("voluntarios").value + " não foi cadastrado. Por favor tente novamente"; 
                                        document.getElementById('lblAlertDanger_vol').className = "alert alert-danger d-block";
                                        document.getElementById('voluntarios').selectedIndex = "0"; 
                            		    document.getElementById('cargovol').selectedIndex = "0"; 
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
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
       <div id="divultimos" class="d-block">
                <center>
                               <h3>VISÃO GERAL</h3>
                               <p><label>Antes de cadastrar uma opção da feira, verifique a tabela abaixo. Serão exibidas apenas as feiras do mês:</label></p>
                    	<?

                    	    $queryfeira = "SELECT * FROM EVENTOS WHERE DATA LIKE '".$ano_atu."-".$mes_atu."%' AND TIPO ='Feira de adoção' ORDER BY DATA DESC";
                            $resultfeira = mysqli_query($connect,$queryfeira);
                            $reccountfeira = mysqli_num_rows($resultfeira);

                    		if ($reccountfeira != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-dark'>";
                            	echo "<th scope='col' colspan='2'>&nbsp; </th>";
                            	echo "<th scope='col' colspan='1' align='center'>Voluntários</th>";
                            	echo "<th scope='col' colspan='1'>Animais</th>";
                            	echo "<th scope='col' colspan='6'>Produtos</th>";
                            	echo "</thead>";
                            	echo "<thead class='thead-light'>";
                            	echo "<th scope='col' colspan='1'>Data</th>";
                            	echo "<th scope='col' colspan='1'>Local</th>";
                            	echo "<th scope='col' colspan='1'>Qtde</th>";
                            	echo "<th scope='col' colspan='1'>Qtde</th>";
                            	echo "<th scope='col' colspan='4'>Qtde</th>";
                            	echo "<tbody>";
                    	        while ($fetchfeira = mysqli_fetch_row($resultfeira)) {
                    	            $idevento = $fetchfeira[0];
                                    $local = $fetchfeira[3];
                                    $data = $fetchfeira[4];
                                    
                                    $ano_feira = substr($data,0,4);
                            		$mes_feira = substr($data,5,2);
                            		$dia_feira = substr($data,8,2);
                    	            
                    	            $queryvol = "SELECT * FROM LISTA_DE_PRESENCA WHERE ID_EVENTO='$idevento'" ;
                                    $resultvol = mysqli_query($connect,$queryvol);
                                    $reccountvol = mysqli_num_rows($resultvol);
                                    
                                    if ($reccountvol !='0'){
                                        $voluntarios='Sim';
                                    } else {
                                        $voluntarios='Não';
                                    }
                    	            
                    	            $querypet = "SELECT * FROM ANIMAIS_FEIRAS WHERE ID_FEIRA='$idevento'";
                                    $resultpet = mysqli_query($connect,$querypet);
                                    $reccountpet = mysqli_num_rows($resultpet);
                                    
                                    if ($reccountpet !='0'){
                                        $animais='Sim';
                                    } else {
                                        $animais='Não';
                                    }
                                    
                                    $queryprod = "SELECT * FROM VENDAS_PRODUTOS WHERE ID_EVENTO='$idevento'";
            	                    $resultprod = mysqli_query($connect,$queryprod);
            	                    $reccountprod = mysqli_num_rows($resultprod);
            	                    
                                    if ($reccountprod !='0'){
                                        $produtos='Sim';
                                    } else {
                                        $produtos='Não';
                                    }
            	                    
                        			echo "<tr>";
                        			echo "<td>".$dia_feira."/".$mes_feira."/".$ano_feira."</td>";
                					echo "<td>".$local."</td>";
                					echo "<td>".$reccountvol."</td>";
                					echo "<td>".$reccountpet."</td>";
                					echo "<td>".$reccountprod."</td>";
                					echo "<td><a href='verfeira.php?idevento=".$idevento."' class='btn btn-primary' target='_blank'>Visualizar</a>&nbsp;</td>";
                					echo "<td><a href='envioresumopet.php?action=resend' class='btn btn-primary' target='_blank'>Enviar resumo pet</a>&nbsp;</td>";
                				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum evento encontrado</p><br>";
                    		}
                    	?>
                    	</center>
    </div>
    <center>
        <h3>CADASTRO DE FEIRA </h3><br>
        <p><label> É importante cadastrar a feira corretamente pois as informações aqui preenchidas irão ser usadas para gerar estatísticas. </label></p>
       </center>
    <form action="cadastrovol.php" method="POST" enctype="multipart/form-data" name="form">
         <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Evento: <strong><font color="red">*</font></strong></label> 
                  <div class="col-sm-5">
                      <select class="form-control" id="idevento" name="idevento" required> 
                        <option selected value="0">Selecione</option>
                        <?
                        		 		$queryevento = "SELECT * FROM EVENTOS WHERE DATA LIKE '".$ano_atu."-".$mes_atu."%' AND TIPO ='Feira de adoção' ORDER BY DATA DESC LIMIT 10";
                        		 		//$queryevento = "SELECT * FROM EVENTOS WHERE DATA LIKE '".$ano_atu."-04%' AND TIPO ='Feira de adoção' ORDER BY DATA DESC LIMIT 10";
                        				$selectevento = mysqli_query($connect,$queryevento);
                        				
                        				while ($fetchevento = mysqli_fetch_row($selectevento)) {
                        				    $data_evento = $fetchevento[4];
                        				    
                        				    $ano_evento = substr($data_evento,0,4);
                                    		$mes_evento = substr($data_evento,5,2);
                                    		$dia_evento = substr($data_evento,8,2);
                                    		$data_evento = $dia_evento."/".$mes_evento."/".$ano_evento;
                        					echo "<option value='".$fetchevento[0]."'>".$fetchevento[2]." - ".$fetchevento[3]." - ".$data_evento."</option>";
                                    		
                        				}
                        ?>
                        </select>
                        <small id="passwordHelpBlock" class="form-text text-muted">Serão exibidos apenas as feiras do mês</small>
                    </div>
        </div>
        <!--<div class="form-group row">
                  <label class="col-sm-3 col-form-label">Data: </label> 
                  <div class="col-sm-3">
                    <input name="dtfeira" type="date" id="dtfeira" class="form-control" >
                  </div>
        </div> -->
        <div class="form-row">
                <button type="button" style="margin-left:2%;margin-right:auto;display:block;" class="btn btn-primary d-block" id="btnListaVol" onclick="OnClick1 (this)"> Cadastrar voluntários presentes </button>
        </div>
        <br>
        <div id="divvol" class="form-row d-none">
            <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome: </label> 
                  <div class="col-sm-6">
                    <select class="form-control" id="voluntarios" name="voluntarios" required> 
                        <option selected value="">Selecione</option>
                        <?
                        		 		$queryvol = "SELECT USUARIO,NOME FROM VOLUNTARIOS WHERE (AREA ='operacional' OR AREA='financeiro' OR AREA='comunicacao' OR AREA='captacao' OR AREA='administrativo' OR AREA='diretoria') AND STATUS_APROV='Aprovado' ORDER BY NOME ASC";
                        				$selectvol = mysqli_query($connect,$queryvol);
                        				
                        				while ($fetchvol = mysqli_fetch_row($selectvol)) {
                        					echo "<option value='".$fetchvol[1]."'>".$fetchvol[1]."</option>";
                        				}
                        ?>
                        </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Cargo: </label> 
                    <div class="col-sm-6">
                          <select class="form-control" id="cargovol" name="cargovol" required> 
                                <option selected value="0">Selecione</option>
                                <option value="Coordenador">Coordenador</option>
                                <option value="Subcoordenador">Subcoordenador</option>
                                <option value="Voluntário">Voluntário</option>
                          </select>
                     </div>
            </div>
           <div class="form-group row">
                <button type="button" style="margin-left:2%;margin-right:auto;display:block;" class="btn btn-primary d-block" id="btnAdicionarVol"> Adicionar voluntário </button>
            </div>
            <div class="alert alert-success d-none" role="alert" id="lblAlertSuccess_vol">
                     <label class="col-sm-4 col-form-label" id="AlertSuccess_volnome">Voluntário cadastrado!</label> 
            </div>
            <div class="alert alert-danger d-none" role="alert" id="lblAlertDanger_vol">
              <danger><label class="col-sm-4 col-form-label" id="AlertDanger_volnome">Voluntário não cadastrado!</label>Por favor, tente novamente.</danger> 
            </div>
        </div>
     </form>
    <div class="form-row">
                <button type="button" style="margin-left:2%;margin-right:auto;display:block;" class="btn btn-primary d-block" id="btnListaProd" onclick="OnClick3 (this)"> Cadastrar produtos vendidos </button>
    </div>
    <br>
     <div id="divprod1" class="form-row d-none">
        <h4>PRODUTOS VENDIDOS</h4>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Produto: </label> 
                  <div class="col-sm-6">
                    <select class="form-control" id="prodvenda" name="prodvenda" required> 
                        <option selected value="">Selecione</option>
                     		  <?
                     		  
                     		    $queryprod = "SELECT * FROM CONTROLE_ESTOQUE ORDER BY PRODUTO ASC";
                        		$selectprod = mysqli_query($connect,$queryprod);
                        		$reccountprod = mysqli_num_rows($selectprod);
                        			
                        		while ($fetchprod = mysqli_fetch_row($selectprod)) {
                        					echo "<option value='".$fetchprod[7]."'>".$fetchprod[7]." - ".$fetchprod[8]."</option>";
                        		}
                     		  
                     		  ?>
                   </select>
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Quantidade: </label> 
                  <div class="col-sm-2">
                    <input name="qtdprod" type="text" id="qtdprod" maxlength="20" class="form-control" required>
                  </div>

                  <label class="col-sm-2 col-form-label">Forma de pagamento: </label> 
                  <div class="col-sm-2">
                    <select class="form-control" id="pgto" name="pgto" required > 
                        <option selected value="0">Selecione</option>
                        <option value="Dinheiro">Dinheiro</option>
                        <option value="Cartão de crédito">Cartão de crédito</option>
                        <option value="Cartão de débito">Cartão de débito</option>
                        <option value="DOC/TED">DOC/TED</option>
                        <option value="PIX">PIX</option>
                    </select>
                  </div>
        </div>
        <div class="form-group row">
            <button type="button" style="margin-left:2%;margin-right:auto;display:block;" class="btn btn-primary d-block" id="btnAdicionarProduto"> Adicionar Produto </button>
        </div>
        <div class="alert alert-success d-none" role="alert" id="lblAlertSuccess_prod">
                     <label class="col-sm-4 col-form-label" id="AlertSuccess_produto">Produto cadastrado!</label> 
            </div>
            <div class="alert alert-danger d-none" role="alert" id="lblAlertDanger_prod">
              <danger><label class="col-sm-4 col-form-label" id="AlertDanger_produto">Produto não cadastrado!</label>Por favor, tente novamente.</danger> 
            </div>
    </div>
    <div class="form-row">
                <button type="button" style="margin-left:2%;margin-right:auto;display:block;" class="btn btn-primary d-block" id="btnListaPet" onclick="OnClick4 (this)"> Cadastrar animais presentes </button>
    </div>
    <br>
     <div id="divanimais" class="form-row d-none">
        <h4>ANIMAIS PRESENTES</h4>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome: </label> 
                  <div class="col-sm-6">
                    <select class="form-control" id="idanimal" name="idanimal" required > 
                        <option selected value="">Selecione</option>
                     		  <?
                     		  
                     		    $querypet = "SELECT ID,NOME_ANIMAL FROM ANIMAL WHERE (ADOTADO = 'Disponível' or ADOTADO = 'Pré adotado' or ADOTADO = 'Adotado (sem termo)') AND DIVULGAR_COMO ='GAAR' ORDER BY NOME_ANIMAL,ESPECIE ASC";
                        		$selectpet = mysqli_query($connect,$querypet);
                        		$reccountpet = mysqli_num_rows($selectpet);
                        			
                        		while ($fetchpet = mysqli_fetch_row($selectpet)) {
                        					echo "<option value='".$fetchpet[0]."'>".$fetchpet[1]."</option>";
                        		}

                     		  ?>
                    	    </select>
                    	    <? /*echo "query pet: ".$querypet;*/ ?>
                    	    <small id="passwordHelpBlock" class="form-text text-muted">Serão exibidos apenas animais com status Disponível e Adotado (sem termo)</small>
                  </div>
        </div>
        <div class="form-group row">
            <button type="button" style="margin-left:2%;margin-right:auto;display:block;" class="btn btn-primary d-block" id="btnAdicionarAnimal"> Adicionar animal </button>
        </div>
        <div class="alert alert-success d-none" role="alert" id="lblAlertSuccess_pet">
                     <label class="col-sm-4 col-form-label" id="AlertSuccess_animal">Animal cadastrado!</label> 
            </div>
            <div class="alert alert-danger d-none" role="alert" id="lblAlertDanger_pet">
              <danger><label class="col-sm-4 col-form-label" id="AlertDanger_animal">Animal não cadastrado!</label>Por favor, tente novamente.</danger> 
            </div>
    </div>
    <br>
    <div class="form-row">
                        <div class="form-group col-md-6">
                                <label>Observações: </label> 
                                <textarea class="form-control" name="obs" cols="200" rows="5" id="obs"></textarea>
                                <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis. Doações, comentários, etc</small>
                        </div>
                        
    </div>
    <div class="alert alert-success d-none" role="alert" id="lblAlertSuccess_obs">
          Observação cadastrada !
        </div>
        <div class="alert alert-danger d-none" role="alert" id="lblAlertDanger_obs">
          <danger>Observação não cadastrada !</danger> Por favor, tente novamente.
        </div>
    <div class="form-group row">
            <button type="button" style="margin-left:2%;margin-right:auto;display:block;" class="btn btn-primary d-block" id="btnAdicionarObs"> Adicionar </button>
    </div>
    <br>	
    <div class="form-group">
                    <label for="exampleFormControlFile1">Foto do caderno</label>
                    <input type="file" class="form-control-file" id="foto_caderno" name="foto_caderno">
                    <small id="passwordHelpBlock" class="form-text text-muted">Tamanho máximo da foto: 1MB</small>
     </div>
     <div class="form-group row">
            <button type="button" style="margin-left:2%;margin-right:auto;display:block;" class="btn btn-primary d-block" id="btnAdicionarFoto"> Upload </button>
    </div>
     <div class="alert alert-success d-none" role="alert" id="lblAlertSuccess_foto">
          Foto cadastrada !
        </div>
        <div class="alert alert-danger d-none" role="alert" id="lblAlertDanger_foto">
          <danger>Foto não cadastrada !</danger> Por favor, tente novamente.
        </div>
   </div>
   </form>
   <br>
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
