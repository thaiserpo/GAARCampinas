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
    <title>GAAR - Cadastro de mutirões </title>
    <script type="text/javascript">
	
                            function OnClick1 (radio) {
                                        document.getElementById('divvol').className  = "d-block";
                                        document.getElementById('btnEscondeListaVol').className  = "d-block";
                                        document.getElementById('btnListaVol').className  = "d-none";
                                }
                                
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
       <div id="divultimos" class="d-block">
                <center>
                               <h3>VISÃO GERAL</h3>
                               <p><label>Antes de cadastrar, verifique a tabela abaixo. Serão exibidas apenas os últimos 10 cadastrados:</label></p>
                    	<?

                    	    $querymult = "SELECT * FROM MUTIROES WHERE DATA_MUTIRAO LIKE '".$ano_atu."-%' ORDER BY ID DESC LIMIT 10";
                            $resultmult = mysqli_query($connect,$querymult);
                            $reccountmult = mysqli_num_rows($resultmult);

                    		if ($reccountmult != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-dark'>";
                            	echo "<th scope='col' colspan='2'>Data</th>";
                            	echo "<th scope='col' colspan='3'>Clínica</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetchmult = mysqli_fetch_row($resultmult)) {
                    	            $idevento = $fetchmult[0];
                                    $idclinica = $fetchmult[3];
                                    $data = $fetchmult[4];
                                    
                                    $ano_mult = substr($data,0,4);
                            		$mes_mult = substr($data,5,2);
                            		$dia_mult = substr($data,8,2);
                    	            
                    	            $queryvet = "SELECT CLINICA FROM CLINICAS WHERE ID='$idclinica'" ;
                                    $resultvet = mysqli_query($connect,$queryvet);
                                    $fetchvet = mysqli_fetch_row($resultvet);
            	                    
                        			echo "<tr>";
                        			echo "<td>".$dia_mult."/".$mes_mult."/".$ano_mult."</td>";
                					echo "<td>".$fetchvet[0]."</td>";
                				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum mutirão encontrado</p><br>";
                    		}
                    	?>
                    	</center>
    </div>
    <center>
        <h3>CADASTRO DE MUTIRÃO </h3><br>
        <p><label>  </label></p>
       </center>
    <form action="cadastromult.php" method="POST" enctype="multipart/form-data" name="form">
         <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Clínica: <strong><font color="red">*</font></strong></label> 
                  <div class="col-sm-5">
                      <select class="form-control" id="idclinica" name="idclinica" required> 
                        <option selected value="0">Selecione</option>
                        <?
                        		 		$queryevento = "SELECT * FROM CLINICAS ORDER BY CLINICA ASC";
                        				$selectevento = mysqli_query($connect,$queryevento);
                        				
                        				while ($fetchevento = mysqli_fetch_row($selectevento)) {
                        					echo "<option value='".$fetchevento[0]."'>".$fetchevento[1]."</option>";
                                    		
                        				}
                        ?>
                        </select>
                    </div>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Data: </label> 
                  <div class="col-sm-5">
                            <input name="datamulti" type="date" id="datamulti" class="form-control" required>
                  </div>                  
        </div>
        <center><a href="javascript:form.submit()" class="btn btn-primary">Cadastrar</a></center>
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
