<?php 

session_start();

include ("conexao.php"); 

include ("calendar.php");
$anomes_atu = date("Y-m-01");

$calendar = new Calendar();

$horaatu = date("H:i:s");
$data_atu = date("Y-m-d");
$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$dtatu_format = date("d-m-Y");
$dia_iniciopost = date('Y-m-d', strtotime('next monday'));
$dia_iniciopost_semana = date('Y-m-d', strtotime('monday this week'));
$dia_fimpost = date('Y-m-d', strtotime($dia_iniciopost. ' + 13 days'));
$dia_fimpost_semana = date('Y-m-d', strtotime('sunday this week'));
$divulgado_7dias = date('Y-m-d', strtotime($data_atu. ' - 7 days'));
$divulgado_15dias = date('Y-m-d', strtotime($data_atu. ' - 15 days'));
$divulgado_30dias = date('Y-m-d', strtotime($data_atu. ' - 30 days'));
$divulgado_60dias = date('Y-m-d', strtotime($data_atu. ' - 60 days'));

//$calendar->add_event('Teste', '2022-12-05');

//$calendar->add_event('Holiday', '2022-12-14', 7); // Event will last for 7 days
//$calendar->add_event('Holiday', '2022-12-14', 7, 'red'); // change color

$login = $_SESSION['login'];
$idanimalget = $_GET['idanimal'];

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
    
	<link href="calendar.css" rel="stylesheet" type="text/css">
	
    <!--- BOOTSTRAP AND AJAX --->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--- BOOTSTRAP AND AJAX --->
    
    <script type="text/javascript" language="javascript">
    
        function OnChangeTexto (radio) {
                document.getElementById('divnovotexto').className  = "d-block";
        }
        
        $(document).ready(function(){
 
            $("#btnAdicionarAnimal").click(function(){
                
            	$.ajax({
                	url: "cadastropet_redes.php",
             		type: "POST",
             		data: {
             		    idanimal: document.getElementById("idanimal").value,
             		    datapost: document.getElementById("data_post").value,
             		    //novotexto: document.getElementById("textonovo").value,
             		    novotexto: document.getElementById("textonovo").checked,
             		    horapost: document.getElementById("horapost").value,
             		},
            		success: function(response){
            		    document.getElementById('AlertSuccess_animal').innerHTML= document.getElementById("idanimal").value + " cadastrado com sucesso";
            		    document.getElementById('lblAlertSuccess_pet').className = "alert alert-success d-block";
            		    window.location.reload(true);


                    },
                    error: function(response){
                        document.getElementById('AlertDanger_animal').value = response;
                        //document.getElementById('AlertDanger_animal').innerHTML= document.getElementById("idanimal").value + " não foi cadastrado. Por favor tente novamente"; 
                        //document.getElementById('lblAlertDanger_pet').className = "alert alert-danger d-block";
                    }
            	});
             });
             
            $("#btnAtualizarTexto").click(function(){
                
            	$.ajax({
                	url: "cadastrotexto_redes.php",
             		type: "POST",
             		data: {
             		    idanimal: document.getElementById("idanimal").value,
             		    textoredes: document.getElementById("textoredes").value,

             		},
            		success: function(response){
            		    document.getElementById('AlertSuccess_texto').innerHTML= "Texto do animal " + document.getElementById("idanimal").value + " atualizado com sucesso";
            		    document.getElementById('lblAlertSuccess_texto').className = "alert alert-success d-block";
            		    document.getElementById("textoredes").value = "";
            		    document.getElementById('divnovotexto').className  = "d-none";
                    },
                    error: function(response){
                        document.getElementById('AlertDanger_animal').value = response;
                        //document.getElementById('AlertDanger_animal').innerHTML= document.getElementById("idanimal").value + " não foi cadastrado. Por favor tente novamente"; 
                        //document.getElementById('lblAlertDanger_pet').className = "alert alert-danger d-block";
                    }
            	});
            });
            
            $("#btnAtualizarDataPost").click(function(){
                
            	$.ajax({
                	url: "atualizapet_redes.php",
             		type: "POST",
             		data: {
             		    idpet: document.getElementById("idanimal").value,
             		    novadatapost: document.getElementById("data_post_grade").value,
             		    novadatapost: document.getElementById("data_post_grade").value

             		},
            		success: function(response){
            		    document.getElementById('AlertSuccess_texto').innerHTML= "Data do post do animal " + document.getElementById("idanimal").value + " atualizada com sucesso";
            		    document.getElementById('lblAlertSuccess_texto').className = "alert alert-success d-block";
            		    document.getElementById("textoredes").value = "";
            		    document.getElementById('divnovotexto').className  = "d-none";
                    },
                    error: function(response){
                        document.getElementById('AlertDanger_animal').value = response;
                        //document.getElementById('AlertDanger_animal').innerHTML= document.getElementById("idanimal").value + " não foi cadastrado. Por favor tente novamente"; 
                        //document.getElementById('lblAlertDanger_pet').className = "alert alert-danger d-block";
                    }
            	});
            });
             
            $("#idanimal").change(function(){
                
            	$.ajax({
                	url: "pesquisaultimo_post.php",
             		type: "POST",
             		data: {
             		    idanimal: document.getElementById("idanimal").value,
             		},
            		success: function(response){
            		    document.getElementById('ultimo_data_post').value = response;
                    },
                    error: function(response){
                        document.getElementById('AlertDanger_animal').innerHTML= document.getElementById("idanimal").value + " não foi encontrado. Por favor tente novamente"; 

                    }
            	});
             });
             
            $("#data_post").change(function(){
                
            	$.ajax({
                	url: "consultahora_redes.php",
             		type: "POST",
             		data: {
             		    datapost: document.getElementById("data_post").value,
             		},
            		success: function(response){
            		    document.getElementById('horapost').value = response;
                    },
                    error: function(response){
                        //document.getElementById('AlertDanger_animal').innerHTML= document.getElementById("idanimal").value + " não foi encontrado. Por favor tente novamente"; 

                    }
            	});
             });
             
          });
    </script>
    <style>
        .myTable-row-highlight {
        background-color: #FFFF00;
        }
</style>
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
    <!--<div class="embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" src="https://www.facebook.com/creators/tools/creator-studio" allowfullscreen></iframe>
    </div> -->
    <div id="divanimais" class="form-row d-block">
        <h4><CENTER>PROGRAMAR POST</CENTER></h4>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome: </label> 
                  <div class="col-sm-6">
                    <select class="form-control" id="idanimal" name="idanimal" required> 
                        <option selected value="">Selecione</option>
                     		  <?
                     		  
                     		    if ($idanimalget <> '') {
                     		        $querypet = "SELECT ID,NOME_ANIMAL,ESPECIE FROM ANIMAL WHERE ID='$idanimalget'";
                     		    } else {
                     		        $querypet = "SELECT ID,NOME_ANIMAL,ESPECIE FROM ANIMAL WHERE ADOTADO = 'Disponível' AND DIVULGAR_COMO ='GAAR' ORDER BY NOME_ANIMAL,ESPECIE ASC";   
                     		    }
                        		$selectpet = mysqli_query($connect,$querypet);
                        		$reccountpet = mysqli_num_rows($selectpet);
                        			
                        		while ($fetchpet = mysqli_fetch_row($selectpet)) {
                        		            if ($idanimalget <> ''){
                        		                echo "<option value='".$fetchpet[0]."' selected>".$fetchpet[1]." - ".$fetchpet[2]."</option>";
                        		            } else {
                        		                echo "<option value='".$fetchpet[0]."'>".$fetchpet[1]." - ".$fetchpet[2]."</option>";
                        		            }
                        		}

                     		  ?>
                    	    </select>
                    	    <? /*echo "query pet: ".$querypet;*/ ?>
                    	    <small id="passwordHelpBlock" class="form-text text-muted">Serão exibidos apenas animais com status Disponível e Adotado (sem termo)</small>
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Último post em: </label> 
                  <div class="col-sm-3">
                    <input name="ultimo_data_post" type="date" id="ultimo_data_post" class="form-control" readonly>
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Novo post: <strong><font color="red">*</font></strong></label> 
                  <div class="col-sm-3">
                    <input name="data_post" type="date" id="data_post" class="form-control" >
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Horário: <strong><font color="red">*</font></strong></label> 
                  <div class="col-sm-3">
                      <select class="form-control" id="horapost" name="horapost" required> 
                        <option value="11:00">11:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                      </select>
                  </div>
        </div>
        <div class="form-group row">
            <button type="button" class="btn btn-primary d-block" id="btnAdicionarAnimal"> Adicionar animal </button> &nbsp; &nbsp; <button name="novotexto" id="novotexto" class="btn btn-primary d-block" onclick='OnChangeTexto (this)' >Atualizar texto </button>
        </div>
        <div class="alert alert-success d-none" role="alert" id="lblAlertSuccess_pet">
                 <label class="col-sm-4 col-form-label" id="AlertSuccess_animal">Animal cadastrado!</label> 
        </div>
        <div class="alert alert-danger d-none" role="alert" id="lblAlertDanger_pet">
          <danger><label class="col-sm-4 col-form-label" id="AlertDanger_animal">Animal não cadastrado!</label>Por favor, tente novamente.</danger> 
        </div>

        <div class="form-group row d-none" id="divnovotexto">
                  <label class="col-sm-2 col-form-label">Digite aqui: </label> 
                  <div class="col-sm-10">
                    <textarea class="form-control" name="textoredes" cols="70" rows="10" id="textoredes"></textarea></textarea>
                    <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                    <button type="button" class="btn btn-primary d-block" id="btnAtualizarTexto"> OK </button>
                  </div>
        </div>
         <div class="alert alert-success d-none" role="alert" id="lblAlertSuccess_texto">
                           <label class="col-sm-4 col-form-label" id="AlertSuccess_texto"></label> 
                  </div>
                  <div class="alert alert-danger d-none" role="alert" id="lblAlertDanger_texto">
                    <danger><label class="col-sm-4 col-form-label" id="AlertDanger_texto">Texto não atualizado!</label>Por favor, tente novamente.</danger> 
        </div>
        <div class="form-group row d-block">
                  <div class="col-sm-10">
                      <div class="form-check">
                              <input class="form-check-input" type="radio" name="textonovo" id="textonovo" value="SIM"><label class="form-check-label">Precisa de novo texto</label>
                      </div>
                  </div>
        </div>
    </div>
    <br>
    
    <p>Por favor, utilize o Estúdio de Criação do Facebook para que todos os voluntários de Comunicação tenham visibilidade da programação de posts. <a href="https://business.facebook.com/creatorstudio/" target="_blank">Acesse aqui</a></p>
    <div class="content home d-none">
    	<?=$calendar?>
    </div>
    <div id="divgradesemana" class="d-block">
        <center><h4>POSTS DA SEMANA ATUAL</h4>
        <p> <a href="https://gaarcampinas.org/area/envioemailredacao.php" target="_blank">Criar e-mail para grupo de redação</a></p></center>
        <?
            $query = "SELECT * FROM ANIMAIS_REDES WHERE DIA_POST >= '".$dia_iniciopost_semana."' AND DIA_POST <= '".$dia_fimpost_semana."' ORDER BY DIA_POST,HORA_POST ASC";
            $select = mysqli_query($connect,$query);
            $reccount = mysqli_num_rows($select);
            
            echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>ID</th>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>Espécie</th>";
        	echo "<th scope='col'>Sexo</th>";
        	echo "<th scope='col'>Status</th>";
        	echo "<th scope='col' colspan='1'>Data do post</th>";
        	echo "<th scope='col' colspan='1'>Hora do post</th>";
        	echo "<th scope='col' colspan='3'>Último post</th>";
        	echo "</thead>";
        	echo "<tbody>";
            
            while ($fetch = mysqli_fetch_row($select)) {
                
                $idpost = $fetch[0];
                $idanimal = $fetch[1];
                $data_post_semana = $fetch[2];
                $hora_post_semana = $fetch[3];
                $ultimo_post = $fetch[5];
                $dayofweek = date('w', strtotime($data_post));
                
                $querypet_redes = "SELECT NOME_ANIMAL,ESPECIE,SEXO, ADOTADO FROM ANIMAL WHERE ID='$idanimal'";
            	$selectpet_redes = mysqli_query($connect,$querypet_redes);
            	$rc = mysqli_fetch_row($selectpet_redes);
			    $nomeanimal = $rc[0];
			    $especie = $rc[1];
			    $sexo = $rc[2];
			    $status = $rc[3];
			    
			    $ano_datapost_semana = substr($data_post_semana,0,4);
    		    $mes_datapost_semana = substr($data_post_semana,5,2);
    		    $dia_datapost_semana = substr($data_post_semana,8,2);
    		    
    		    $ano_ultimopost = substr($ultimo_post,0,4);
    		    $mes_ultimopost = substr($ultimo_post,5,2);
    		    $dia_ultimopost = substr($ultimo_post,8,2);
    		    
    		    if ($data_post_semana == $data_atu) {
    		        echo "<tr class='myTable-row-highlight'>";
        			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'><label id='idanimal_grade'>".$idanimal."</label></a></td>";
        			echo "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$idanimal."' target='_blank'>".$nomeanimal."</a></td>";
        			echo "<td>".$especie."</td>";
        			echo "<td>".$sexo."</td>";
        			echo "<td>".$status."</td>";
        			//echo "<td><input name='data_post_grade' type='date' id='data_post_grade' class='form-control' value='".$data_post_semana."'></td>";
    				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
    				echo "<td>".$hora_post_semana."</td>";
    				echo "<td><label id='novadatapost'>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</label></td>";
    				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
    				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpost=".$idpost."' target='_blank'>Deletar</a></td>";
    				/*echo "<td><button type='button' class='btn btn-primary d-block' id='btnAtualizarDataPost'>Atualizar</button></td>";
    			    echo "</tr>"; 
    			    echo "<div class='alert alert-success d-none' role='alert' id='lblAlertSuccess_pet'>
                                 <label class='col-sm-4 col-form-label' id='AlertSuccess_animal'></label> 
                        </div>
                        <div class='alert alert-danger d-none' role='alert' id='lblAlertDanger_pet'>
                          <danger><label class='col-sm-4 col-form-label' id='AlertDanger_animal'></danger> 
                        </div>";*/
    		    } else {
    		        echo "<tr>";
        			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>".$idanimal."</a></td>";
        			echo "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$idanimal."' target='_blank'>".$nomeanimal."</a></td>";
        			echo "<td>".$especie."</td>";
        			echo "<td>".$sexo."</td>";
        			echo "<td>".$status."</td>";
    				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
    				echo "<td>".$hora_post_semana."</td>";
    				echo "<td>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</td>";
    				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
    				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpost=".$idpost."' target='_blank'>Deletar</a></td>";
    			    echo "</tr>"; 
    		    }
            
                
			}   
			        echo "</tbody>";
			        echo "</table><br>";
        ?>

    </div>
    
    <div id="divgradeproxsemana" class="d-block">
        <center><h4>POSTS DAS PRÓXIMAS 2 SEMANAS </h4>
        <p> <a href="https://gaarcampinas.org/area/envioemailredacao.php" target="_blank">Criar e-mail para grupo de redação</a></p></center>
        <?
            $query = "SELECT * FROM ANIMAIS_REDES WHERE DIA_POST >= '".$dia_iniciopost."' AND DIA_POST <= '".$dia_fimpost."' ORDER BY DIA_POST,HORA_POST ASC";
            $select = mysqli_query($connect,$query);
            $reccount = mysqli_num_rows($select);
            
            echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>ID</th>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>Espécie</th>";
        	echo "<th scope='col' colspan='1'>Data do post</th>";
        	echo "<th scope='col' colspan='1'>Hora do post</th>";
        	echo "<th scope='col' colspan='3'>Último post</th>";
        	echo "</thead>";
        	echo "<tbody>";
            
            while ($fetch = mysqli_fetch_row($select)) {
                
                $idpost = $fetch[0];
                $idanimal = $fetch[1];
                $data_post_semana = $fetch[2];
                $hora_post_semana = $fetch[3];
                $ultimo_post = $fetch[5];
                $dayofweek = date('w', strtotime($data_post));
                
                $querypet_redes = "SELECT NOME_ANIMAL,ESPECIE FROM ANIMAL WHERE ID='$idanimal'";
            	$selectpet_redes = mysqli_query($connect,$querypet_redes);
            	$rc = mysqli_fetch_row($selectpet_redes);
			    $nomeanimal = $rc[0];
			    $especie = $rc[1];
			    
			    $ano_datapost_semana = substr($data_post_semana,0,4);
    		    $mes_datapost_semana = substr($data_post_semana,5,2);
    		    $dia_datapost_semana = substr($data_post_semana,8,2);
    		    
    		    $ano_ultimopost = substr($ultimo_post,0,4);
    		    $mes_ultimopost = substr($ultimo_post,5,2);
    		    $dia_ultimopost = substr($ultimo_post,8,2);
            
                echo "<tr>";
    			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>".$idanimal."</a></td>";
    			echo "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$idanimal."' target='_blank'>".$nomeanimal."</a></td>";
    			echo "<td>".$especie."</td>";
				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
				echo "<td>".$hora_post_semana."</td>";
				echo "<td>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</td>";
				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpost=".$idpost."' target='_blank'>Deletar</a></td>";
			    echo "</tr>";
			}   
			        echo "</tbody>";
			        echo "</table><br>";
        ?>

    </div>
    <div id="divulgados_60dias" class="d-block">
        <?
            $query_60dias = "SELECT DISTINCT * FROM ANIMAIS_REDES WHERE DIA_POST >= '".$divulgado_60dias."' AND DIA_POST <'".$divulgado_30dias."' ORDER BY DIA_POST,HORA_POST ASC";
            $select_60dias = mysqli_query($connect,$query_60dias);
            $reccount_60dias = mysqli_num_rows($select_60dias);
            
            if ($reccount_60dias <> '0') {
                echo "<center><h4>DIVULGADOS HÁ 60 DIAS</h4></center>";
            
                echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>ID</th>";
            	echo "<th scope='col'>Nome</th>";
            	echo "<th scope='col'>Espécie</th>";
            	echo "<th scope='col'>Sexo</th>";
            	echo "<th scope='col'>Status</th>";
            	echo "<th scope='col' colspan='1'>Data do post</th>";
            	echo "<th scope='col' colspan='1'>Hora do post</th>";
            	echo "<th scope='col' colspan='3'>Último post</th>";
            	echo "</thead>";
            	echo "<tbody>";
                
                while ($fetch_60dias = mysqli_fetch_row($select_60dias)) {
                    
                    $idpost = $fetch_60dias[0];
                    $idanimal = $fetch_60dias[1];
                    $data_post_semana = $fetch_60dias[2];
                    $hora_post_semana = $fetch_60dias[3];
                    $ultimo_post = $fetch_60dias[5];
                    $dayofweek = date('w', strtotime($data_post));
                    
                    $querypet_redes = "SELECT NOME_ANIMAL,ESPECIE,SEXO, ADOTADO FROM ANIMAL WHERE ID='$idanimal'";
                	$selectpet_redes = mysqli_query($connect,$querypet_redes);
                	$rc = mysqli_fetch_row($selectpet_redes);
    			    $nomeanimal = $rc[0];
    			    $especie = $rc[1];
    			    $sexo = $rc[2];
    			    $status = $rc[3];
    			    
    			    $ano_datapost_semana = substr($data_post_semana,0,4);
        		    $mes_datapost_semana = substr($data_post_semana,5,2);
        		    $dia_datapost_semana = substr($data_post_semana,8,2);
        		    
        		    $ano_ultimopost = substr($ultimo_post,0,4);
        		    $mes_ultimopost = substr($ultimo_post,5,2);
        		    $dia_ultimopost = substr($ultimo_post,8,2);
        		    
        		    if ($data_post_semana == $data_atu) {
        		        echo "<tr class='myTable-row-highlight'>";
            			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'><label id='idanimal_grade'>".$idanimal."</label></a></td>";
            			echo "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$idanimal."' target='_blank'>".$nomeanimal."</a></td>";
            			echo "<td>".$especie."</td>";
            			echo "<td>".$sexo."</td>";
            			echo "<td>".$status."</td>";
            			//echo "<td><input name='data_post_grade' type='date' id='data_post_grade' class='form-control' value='".$data_post_semana."'></td>";
        				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
        				echo "<td>".$hora_post_semana."</td>";
        				echo "<td><label id='novadatapost'>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</label></td>";
        				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
        				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpost=".$idpost."' target='_blank'>Deletar</a></td>";
        				/*echo "<td><button type='button' class='btn btn-primary d-block' id='btnAtualizarDataPost'>Atualizar</button></td>";
        			    echo "</tr>"; 
        			    echo "<div class='alert alert-success d-none' role='alert' id='lblAlertSuccess_pet'>
                                     <label class='col-sm-4 col-form-label' id='AlertSuccess_animal'></label> 
                            </div>
                            <div class='alert alert-danger d-none' role='alert' id='lblAlertDanger_pet'>
                              <danger><label class='col-sm-4 col-form-label' id='AlertDanger_animal'></danger> 
                            </div>";*/
        		    } else {
        		        echo "<tr>";
            			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>".$idanimal."</a></td>";
            			echo "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$idanimal."' target='_blank'>".$nomeanimal."</a></td>";
            			echo "<td>".$especie."</td>";
            			echo "<td>".$sexo."</td>";
            			echo "<td>".$status."</td>";
        				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
        				echo "<td>".$hora_post_semana."</td>";
        				echo "<td>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</td>";
        				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
        				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpost=".$idpost."' target='_blank'>Deletar</a></td>";
        			    echo "</tr>"; 
        		    }
                
                    
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";    
            }
            
        ?>

    </div>
    <div id="divulgados_30dias" class="d-block">
        <?
            $query_30dias = "SELECT DISTINCT * FROM ANIMAIS_REDES WHERE DIA_POST >= '".$divulgado_30dias."' AND DIA_POST <'".$divulgado_15dias."' ORDER BY DIA_POST,HORA_POST ASC";
            $select_30dias = mysqli_query($connect,$query_30dias);
            $reccount_30dias = mysqli_num_rows($select_30dias);
            
            if ($reccount_30dias <> '0') {
                echo "<center><h4>DIVULGADOS HÁ 30 DIAS</h4></center>";
            
                echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>ID</th>";
            	echo "<th scope='col'>Nome</th>";
            	echo "<th scope='col'>Espécie</th>";
            	echo "<th scope='col'>Sexo</th>";
            	echo "<th scope='col'>Status</th>";
            	echo "<th scope='col' colspan='1'>Data do post</th>";
            	echo "<th scope='col' colspan='1'>Hora do post</th>";
            	echo "<th scope='col' colspan='3'>Último post</th>";
            	echo "</thead>";
            	echo "<tbody>";
                
                while ($fetch_30dias = mysqli_fetch_row($select_30dias)) {
                    
                    $idpost = $fetch_30dias[0];
                    $idanimal = $fetch_30dias[1];
                    $data_post_semana = $fetch_30dias[2];
                    $hora_post_semana = $fetch_30dias[3];
                    $ultimo_post = $fetch_30dias[5];
                    $dayofweek = date('w', strtotime($data_post));
                    
                    $querypet_redes = "SELECT NOME_ANIMAL,ESPECIE,SEXO, ADOTADO FROM ANIMAL WHERE ID='$idanimal'";
                	$selectpet_redes = mysqli_query($connect,$querypet_redes);
                	$rc = mysqli_fetch_row($selectpet_redes);
    			    $nomeanimal = $rc[0];
    			    $especie = $rc[1];
    			    $sexo = $rc[2];
    			    $status = $rc[3];
    			    
    			    $ano_datapost_semana = substr($data_post_semana,0,4);
        		    $mes_datapost_semana = substr($data_post_semana,5,2);
        		    $dia_datapost_semana = substr($data_post_semana,8,2);
        		    
        		    $ano_ultimopost = substr($ultimo_post,0,4);
        		    $mes_ultimopost = substr($ultimo_post,5,2);
        		    $dia_ultimopost = substr($ultimo_post,8,2);
        		    
        		    if ($data_post_semana == $data_atu) {
        		        echo "<tr class='myTable-row-highlight'>";
            			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'><label id='idanimal_grade'>".$idanimal."</label></a></td>";
            			echo "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$idanimal."' target='_blank'>".$nomeanimal."</a></td>";
            			echo "<td>".$especie."</td>";
            			echo "<td>".$sexo."</td>";
            			echo "<td>".$status."</td>";
            			//echo "<td><input name='data_post_grade' type='date' id='data_post_grade' class='form-control' value='".$data_post_semana."'></td>";
        				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
        				echo "<td>".$hora_post_semana."</td>";
        				echo "<td><label id='novadatapost'>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</label></td>";
        				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
        				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpost=".$idpost."' target='_blank'>Deletar</a></td>";
        				/*echo "<td><button type='button' class='btn btn-primary d-block' id='btnAtualizarDataPost'>Atualizar</button></td>";
        			    echo "</tr>"; 
        			    echo "<div class='alert alert-success d-none' role='alert' id='lblAlertSuccess_pet'>
                                     <label class='col-sm-4 col-form-label' id='AlertSuccess_animal'></label> 
                            </div>
                            <div class='alert alert-danger d-none' role='alert' id='lblAlertDanger_pet'>
                              <danger><label class='col-sm-4 col-form-label' id='AlertDanger_animal'></danger> 
                            </div>";*/
        		    } else {
        		        echo "<tr>";
            			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>".$idanimal."</a></td>";
            			echo "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$idanimal."' target='_blank'>".$nomeanimal."</a></td>";
            			echo "<td>".$especie."</td>";
            			echo "<td>".$sexo."</td>";
            			echo "<td>".$status."</td>";
        				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
        				echo "<td>".$hora_post_semana."</td>";
        				echo "<td>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</td>";
        				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
        				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpost=".$idpost."' target='_blank'>Deletar</a></td>";
        			    echo "</tr>"; 
        		    }
                
                    
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";    
            }
            
        ?>

    </div>
    <div id="divulgados_15dias" class="d-block">
        <?
            $query_15dias = "SELECT * FROM ANIMAIS_REDES WHERE DIA_POST >= '".$divulgado_15dias."' AND DIA_POST <'".$divulgado_7dias."' ORDER BY DIA_POST,HORA_POST ASC";
            $select_15dias = mysqli_query($connect,$query_15dias);
            $reccount_15dias = mysqli_num_rows($select_15dias);
            
            if ($reccount_15dias <> '0') {
                echo "<center><h4>DIVULGADOS HÁ 15 DIAS</h4></center>";
            
                echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>ID</th>";
            	echo "<th scope='col'>Nome</th>";
            	echo "<th scope='col'>Espécie</th>";
            	echo "<th scope='col'>Sexo</th>";
            	echo "<th scope='col'>Status</th>";
            	echo "<th scope='col' colspan='1'>Data do post</th>";
            	echo "<th scope='col' colspan='1'>Hora do post</th>";
            	echo "<th scope='col' colspan='3'>Último post</th>";
            	echo "</thead>";
            	echo "<tbody>";
                
                while ($fetch_15dias = mysqli_fetch_row($select_15dias)) {
                    
                    $idpost = $fetch_15dias[0];
                    $idanimal = $fetch_15dias[1];
                    $data_post_semana = $fetch_15dias[2];
                    $hora_post_semana = $fetch_15dias[3];
                    $ultimo_post = $fetch_15dias[5];
                    $dayofweek = date('w', strtotime($data_post));
                    
                    $querypet_redes = "SELECT NOME_ANIMAL,ESPECIE,SEXO, ADOTADO FROM ANIMAL WHERE ID='$idanimal'";
                	$selectpet_redes = mysqli_query($connect,$querypet_redes);
                	$rc = mysqli_fetch_row($selectpet_redes);
    			    $nomeanimal = $rc[0];
    			    $especie = $rc[1];
    			    $sexo = $rc[2];
    			    $status = $rc[3];
    			    
    			    $ano_datapost_semana = substr($data_post_semana,0,4);
        		    $mes_datapost_semana = substr($data_post_semana,5,2);
        		    $dia_datapost_semana = substr($data_post_semana,8,2);
        		    
        		    $ano_ultimopost = substr($ultimo_post,0,4);
        		    $mes_ultimopost = substr($ultimo_post,5,2);
        		    $dia_ultimopost = substr($ultimo_post,8,2);
        		    
        		    if ($data_post_semana == $data_atu) {
        		        echo "<tr class='myTable-row-highlight'>";
            			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'><label id='idanimal_grade'>".$idanimal."</label></a></td>";
            			echo "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$idanimal."' target='_blank'>".$nomeanimal."</a></td>";
            			echo "<td>".$especie."</td>";
            			echo "<td>".$sexo."</td>";
            			echo "<td>".$status."</td>";
            			//echo "<td><input name='data_post_grade' type='date' id='data_post_grade' class='form-control' value='".$data_post_semana."'></td>";
        				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
        				echo "<td>".$hora_post_semana."</td>";
        				echo "<td><label id='novadatapost'>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</label></td>";
        				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
        				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpost=".$idpost."' target='_blank'>Deletar</a></td>";
        				/*echo "<td><button type='button' class='btn btn-primary d-block' id='btnAtualizarDataPost'>Atualizar</button></td>";
        			    echo "</tr>"; 
        			    echo "<div class='alert alert-success d-none' role='alert' id='lblAlertSuccess_pet'>
                                     <label class='col-sm-4 col-form-label' id='AlertSuccess_animal'></label> 
                            </div>
                            <div class='alert alert-danger d-none' role='alert' id='lblAlertDanger_pet'>
                              <danger><label class='col-sm-4 col-form-label' id='AlertDanger_animal'></danger> 
                            </div>";*/
        		    } else {
        		        echo "<tr>";
            			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>".$idanimal."</a></td>";
            			echo "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$idanimal."' target='_blank'>".$nomeanimal."</a></td>";
            			echo "<td>".$especie."</td>";
            			echo "<td>".$sexo."</td>";
            			echo "<td>".$status."</td>";
        				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
        				echo "<td>".$hora_post_semana."</td>";
        				echo "<td>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</td>";
        				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
        				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpost=".$idpost."' target='_blank'>Deletar</a></td>";
        			    echo "</tr>"; 
        		    }
                
                    
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";    
            }
            
        ?>

    </div>
    <div id="divulgados_7dias" class="d-block">
        <?
            $query_7dias = "SELECT * FROM ANIMAIS_REDES WHERE DIA_POST >= '".$divulgado_7dias."' AND DIA_POST <'".$data_atu."' ORDER BY DIA_POST,HORA_POST ASC";
            $select_7dias = mysqli_query($connect,$query_7dias);
            $reccount_7dias = mysqli_num_rows($select_7dias);
            
            if ($reccount_7dias <> '0') {
                echo "<center><h4>DIVULGADOS HÁ 7 DIAS</h4></center>";
            
                echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>ID</th>";
            	echo "<th scope='col'>Nome</th>";
            	echo "<th scope='col'>Espécie</th>";
            	echo "<th scope='col'>Sexo</th>";
            	echo "<th scope='col'>Status</th>";
            	echo "<th scope='col' colspan='1'>Data do post</th>";
            	echo "<th scope='col' colspan='1'>Hora do post</th>";
            	echo "<th scope='col' colspan='3'>Último post</th>";
            	echo "</thead>";
            	echo "<tbody>";
                
                while ($fetch_7dias = mysqli_fetch_row($select_7dias)) {
                    
                    $idpost = $fetch_7dias[0];
                    $idanimal = $fetch_7dias[1];
                    $data_post_semana = $fetch_7dias[2];
                    $hora_post_semana = $fetch_7dias[3];
                    $ultimo_post = $fetch_7dias[5];
                    $dayofweek = date('w', strtotime($data_post));
                    
                    $querypet_redes = "SELECT NOME_ANIMAL,ESPECIE,SEXO, ADOTADO FROM ANIMAL WHERE ID='$idanimal'";
                	$selectpet_redes = mysqli_query($connect,$querypet_redes);
                	$rc = mysqli_fetch_row($selectpet_redes);
    			    $nomeanimal = $rc[0];
    			    $especie = $rc[1];
    			    $sexo = $rc[2];
    			    $status = $rc[3];
    			    
    			    $ano_datapost_semana = substr($data_post_semana,0,4);
        		    $mes_datapost_semana = substr($data_post_semana,5,2);
        		    $dia_datapost_semana = substr($data_post_semana,8,2);
        		    
        		    $ano_ultimopost = substr($ultimo_post,0,4);
        		    $mes_ultimopost = substr($ultimo_post,5,2);
        		    $dia_ultimopost = substr($ultimo_post,8,2);
        		    
        		    if ($data_post_semana == $data_atu) {
        		        echo "<tr class='myTable-row-highlight'>";
            			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'><label id='idanimal_grade'>".$idanimal."</label></a></td>";
            			echo "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$idanimal."' target='_blank'>".$nomeanimal."</a></td>";
            			echo "<td>".$especie."</td>";
            			echo "<td>".$sexo."</td>";
            			echo "<td>".$status."</td>";
            			//echo "<td><input name='data_post_grade' type='date' id='data_post_grade' class='form-control' value='".$data_post_semana."'></td>";
        				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
        				echo "<td>".$hora_post_semana."</td>";
        				echo "<td><label id='novadatapost'>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</label></td>";
        				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
        				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpost=".$idpost."' target='_blank'>Deletar</a></td>";
        				/*echo "<td><button type='button' class='btn btn-primary d-block' id='btnAtualizarDataPost'>Atualizar</button></td>";
        			    echo "</tr>"; 
        			    echo "<div class='alert alert-success d-none' role='alert' id='lblAlertSuccess_pet'>
                                     <label class='col-sm-4 col-form-label' id='AlertSuccess_animal'></label> 
                            </div>
                            <div class='alert alert-danger d-none' role='alert' id='lblAlertDanger_pet'>
                              <danger><label class='col-sm-4 col-form-label' id='AlertDanger_animal'></danger> 
                            </div>";*/
        		    } else {
        		        echo "<tr>";
            			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>".$idanimal."</a></td>";
            			echo "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$idanimal."' target='_blank'>".$nomeanimal."</a></td>";
            			echo "<td>".$especie."</td>";
            			echo "<td>".$sexo."</td>";
            			echo "<td>".$status."</td>";
        				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
        				echo "<td>".$hora_post_semana."</td>";
        				echo "<td>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</td>";
        				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
        				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpost=".$idpost."' target='_blank'>Deletar</a></td>";
        			    echo "</tr>"; 
        		    }
                
                    
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";    
            }
            
        ?>

    </div>
    
    <div id="divanimais" class="d-none">
                    	<center>
                               <br><h4>ÚLTIMOS ANIMAIS CADASTRADOS</h4><br>
    <?

		    echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>ID</th>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>Espécie</th>";
        	echo "<th scope='col' colspan='2'>Data do post</th>";
        	echo "</thead>";
        	echo "<tbody>";
    
            $queryredes = "SELECT * FROM ANIMAIS_REDES ORDER BY ID_POST DESC LIMIT 5";
            $selectredes = mysqli_query($connect,$queryredes);
            $reccountredes = mysqli_num_rows($selectredes);
            	
            while ($fetchredes = mysqli_fetch_row($selectredes)) {
                
            	$idpet = $fetchredes[1];
            	$data_post = $fetchredes[2];
            	$dayofweek = date('w', strtotime($data_post));
            	
            	$querypet_redes = "SELECT NOME_ANIMAL,ESPECIE FROM ANIMAL WHERE ID='$idpet'";
            	$selectpet_redes = mysqli_query($connect,$querypet_redes);
            	$rc = mysqli_fetch_row($selectpet_redes);
			    $nomeanimal = $rc[0];
			    $especie = $rc[1];
			    
			    $ano_datapost = substr($data_post,0,4);
    		    $mes_datapost = substr($data_post,5,2);
    		    $dia_datapost = substr($data_post,8,2);
            
                echo "<tr>";
    			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idpet."' target='_blank'>".$idpet."</a></td>";
    			echo "<td>".$nomeanimal."</td>";
    			echo "<td>".$especie."</td>";
				echo "<td>".$dia_datapost."/".$mes_datapost."/".$ano_datapost."</td>";
				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idpet."' target='_blank'>Criar texto</a></td>";
			    echo "</tr>";
			}   
			        echo "</tbody>";
			        echo "</table><br>";
            
            
    ?>
    <p><h3><center>GRADE DE PROGRAMAÇÃO SUGERIDA DE POSTS </center><br></h3></p>
    <p><i>Às segundas-feiras</i><br>
        09:00h – Cupom Fiscal a cada 15 dias <br>
        11:00h - Divulgação de animal da ONG<br>
        16:00h – Produto da ONG a cada 15 dias<br>
        18:00h – Divulgação de gato da ONG<br>
        20:00h - Divulgação de cachorro da ONG<br><br>
        <i>Às terças-feiras</i><br>
        09:00h – Animal perdido/encontrado/doação de terceiros<br>
        11:00h – Divulgação de animal da ONG<br>
        15:00h – Bazar (quando houver)<br>
        18:00h – Divulgação de gato da ONG<br>
        20:00h - Divulgação de cachorro da ONG<br><br>
        <i>Às quartas-feiras</i><br>
        09:00h – Parceiros a cada 15 dias / Aplicativo Joyz a cada 15 dias<br>
        13:00h – Animal perdido/encontrado/doação de terceiros<br>
        15:00h – Divulgação de animal da ONG<br>
        18:00h – Divulgação de gato da ONG<br>
        20:00h - Divulgação de cachorro da ONG<br>
        21:00h - Divulgação de cachorro da ONG<br><br>
        <i>Às quintas-feiras</i><br>
        09:00h – Posts de conscientização a cada 15 dias<br>
        11:00h - Divulgação de animal da ONG<br> 
        13:00h – Animal perdido/encontrado/doação de terceiros<br>
        15:00h – Bazar (quando houver)<br>
        18:00h – Divulgação de gato da ONG<br>
        20:00h - Divulgação de cachorro da ONG<br>
        21:00h - Divulgação de cachorro da ONG<br><br>
        <i>Às sextas-feiras</i><br>
        11:00h – Divulgação de animal da ONG<br>
        15:00h – Divulgação da feira<br>
        18:00h – Divulgação de gato da ONG<br>
        20:00h - Divulgação de cachorro da ONG<br><br>
        <i>Aos sábados</i><br>
        09:00h – 13:00h – Espaço reservado para publicações das feiras em tempo real incluindo adoções / Pós adoção quando não houver feira<br>
        15:00h - Divulgação de animal da ONG (a cada 15 dias)<br>
        15:00h – Divulgação de campanha de arrecadação de itens pra ONG (a cada 15 dias)<br>
        18:00h – Divulgação de gato da ONG<br>
        20:00h - Divulgação de cachorro da ONG<br><br>
        <i>Aos domingos</i><br>
        09:00h – 13:00h – Espaço reservado para publicações de feira em tempo real (quando houver feira) incluindo adoções / Pós adoção quando não houver feira<br>
        12:00h - Campanha de ração (a cada 15 dias)<br>
        15:00h – Divulgação de animal da ONG<br>
        18:00h – Divulgação de gato da ONG<br>
        20:00h - Divulgação de cachorro da ONG<br>
        </p>
    <br /><br />
    </div>
<?

}

mysqli_close($connect);

fclose($fp); 

if ($idanimalget <> '') {
     echo"<script language='javascript' type='text/javascript'>
	            window.close;
	      </script>";
 }

?>
</main>
<footer class="footer fixed-bottom bg-light">
      <div class="container">
        <p class="text-center">GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
      </div>
    </footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>