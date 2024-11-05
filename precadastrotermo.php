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
    
    <title>GAAR - Pesquisa interna de animais</title>
    
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

        $iddoanimal = $_POST['iddoanimal'];
		$especie = $_POST['especie'];
		$lt = $_POST['lt'];
		$resp = $_POST['resp'];
		
		if ($iddoanimal != ''){
			$query = "SELECT * FROM ANIMAL WHERE ID = '$iddoanimal' ORDER BY ID DESC";
			$select = mysqli_query($connect,$query);
			$reccount = mysqli_num_rows($select);		
		
?>
<main role="main" class="container">
    <div class="starter-template">
        <br>
        <center>
        <p>Se alguma informação está divergente, por favor acesse <a href='formpesquisapetinterna.php'>aqui</a> e atualize<br>
           Para consultar todos os animais, por favor acesse <a href='formpesquisapetinterna.php'>aqui</a><br></center>
		</p>
		</center>
        
<?
        		
        		if ($reccount == 0) {
        			echo "<center>Nenhum animal encontrado <br><br>
        			        <a href='formcadastropet.php' class='btn btn-primary'>Cadastrar novo animal</a><br><br>"; 
        		}else{ 
        		    		
        			while ($fetch = mysqli_fetch_row($select)) {
        					$idanimal = $fetch[0];	
        					$nomedoanimal = $fetch[1];
        					$especie = $fetch[2];
        					$sexo = $fetch[4];
        					$castracao = $fetch[7];
        					$dtcastracao  = $fetch[8];
        					$vacinacao = $fetch[9];
        					$status = $fetch[10];
        					$lt = $fetch[11];
        					$resp = $fetch[12];
        					$divcomo = $fetch[18];
        					$foto = $fetch[16];
        					
        					$querypretermo = "SELECT * FROM FORM_PRE_ADOCAO WHERE ID_ANIMAL='".$iddoanimal."' ORDER BY NOME_ANIMAL ASC";
                    		$selectpretermo = mysqli_query($connect,$querypretermo);
                    		$reccountpretermo = mysqli_num_rows($selectpretermo);
                    		
                    		$querytermo = "SELECT * FROM TERMO_ADOCAO WHERE ID_ANIMAL='".$iddoanimal."' ORDER BY DATA_ADOCAO DESC";
                    		$selecttermo = mysqli_query($connect,$querytermo);
                    		$reccounttermo = mysqli_num_rows($selecttermo);
            		
        					echo "<div>";
        					echo "<form id='form' name='cadastratermo' action='formtermo.php' method='GET' target='_blank'>";
        					echo "<table class='table'>";
                		    echo "<tbody>";
        					echo "<tr>";
        					if ($foto ==''){
        					    echo "<td align='center' valign='middle' rowspan='10'>SEM FOTO</td>";
        					}else{
        					    echo "<td align='center' valign='middle' rowspan='10'><img src='/pets/".$iddoanimal."/".$foto."' valign='top' align='center' width='300' height='300'/></td>";   
        					}
                			echo "<td align='left' colspan='2' scope='row'><b>Nome do animal:</b></td>";
        					echo "<td align='left' colspan='2'>".$nomedoanimal."</td>";
        					echo "</tr>";
        					echo "<tr>";
                			echo "<td align='left' colspan='2' scope='row'><b>Espécie:</b></td>";
        					echo "<td align='left' colspan='2'>".$especie."</td>";
        					echo "</tr>";
        					echo "<tr>";
                			echo "<td align='left' colspan='2' scope='row'><b>Sexo: </b></td>";
        					echo "<td align='left' colspan='2'>".$sexo."</td>";
        					echo "</tr>";
        					echo "<tr>";
        					echo "<tr>";
                			echo "<td align='left' colspan='2' scope='row'><b>Responsável:</b></td>";
        					echo "<td align='left' colspan='2'>".$resp."</td>";
        					echo "</tr>";
        					echo "<tr>";
                			echo "<td align='left' colspan='2' scope='row'><b>Lar temporário de:</b></td>";
        					echo "<td align='left' colspan='2'>".$lt."</td>";
        					echo "</tr>";
                            echo "<tr>";
                			echo "<td align='left' colspan='2' scope='row'><b>Status:</b></td>";
        					echo "<td align='left' colspan='2'>".$status."</td>";
        					echo "</tr>";
        					echo "<tr>";
        					echo "&nbsp;";
        					/*echo "<td align='center' colspan='5'><a href='formtermo.php?idanimal=".$idanimal."' class='btn btn-primary'>Selecionar</a>&nbsp;</td>";*/
        					echo "</tr>";
        					echo "</tbody><br>";
        					echo "</table>";
        		
        			       if ($status != 'Adotado') {
        			        if ($reccountpretermo != '0'){
        			        echo "<center><p>Encontramos esses pré termos para ".$nomedoanimal.". Algum deles é o adotante?<br></p></center>
                                    	   <div class='form-group row'>";
                                    	            while ($fetchpretermo = mysqli_fetch_row($selectpretermo)) {
                                                          $idadotante = $fetchpretermo[0];
                                                          $adotante = $fetchpretermo[1];
                                                          echo "  <label class='col-sm-2 col-form-label'><strong>Nome completo: </strong></label> 
                                                                  <div class='col-sm-8'>
                                                                    <label class='col-sm-8 col-form-label'>".$adotante."</label> 
                                                                  </div>
                                                                  <div class='col-sm-2'>
                                                                    <label class='col-sm-2 col-form-label'><a href='formtermo.php?idanimal=".$idanimal."&idadotante=".$idadotante."' class='btn btn-primary'>Selecionar</a></label> 
                                                                  </div>";
                                    	            }
                                    	   echo "</div>";
                                    	   echo "<center><p>Caso não seja, clique no botão abaixo<br></p>
                                    	                <a href='formtermo.php?idanimal=".$idanimal."' class='btn btn-primary'>Cadastrar termo</a></center><br><br>"; 
                            } else {
                                 echo "<center><p>Não encontramos nenhum pré termo online para ".$nomedoanimal."<br><br>
                                    	            <a href='formtermo.php?idanimal=".$idanimal."' class='btn btn-primary'>Cadastrar termo</a></p></center><br><br>";
                            }
        			       }
        			       if ($status == 'Adotado') {
        			        if ($reccounttermo != '0'){
                                echo "<center><p>Encontramos esses termos de adoção para ".$nomedoanimal."<br></p></center>
                                    	   <div class='form-group row'>";
                                    	    echo "<table class='table'>";
                                            echo "<thead class='thead-light'>";
                                        	echo "<th scope='col'>Termo</th>";
                                        	echo "<th scope='col'>Adotante</th>";
                                        	echo "<th scope='col'>Data da adoção</th>";
                                        	echo "</thead>";
                                        	echo "<tbody>";
                                    	            while ($fetchtermo = mysqli_fetch_row($selecttermo)) {
                                                          $idtermo = $fetchtermo[0];
                                                          $adotante = $fetchtermo[1];
                                                          $dtadocao = $fetchtermo[32];
                                                            echo "<tr>";
                                                			echo "<td>".$idtermo."</td>";
                                        					echo "<td>".$adotante."</td>";
                                        					echo "<td>".$dtadocao."</td>";
                                        			        echo "</tr>";
                                    	            }
                                    	   echo "</tbody>";
                                    	   echo "</table>";
                                    	   echo "</div>";
                                    	   echo "<center><p>Esse animal já foi adotado. Gostaria de cadastrar um novo termo?<br></p>
                                    	            <center><a href='formtermo.php?idanimal=".$idanimal."' class='btn btn-primary'>Sim</a></p></center><br><br>";
                                
                            }
                            else {
        			           echo "<center><p>Esse animal consta como Adotado mas não foi encontrado nenhum termo. Gostaria de cadastrar?<br></p>
        			                   <a href='formtermo.php?idanimal=".$idanimal."' class='btn btn-primary'>Sim, desejo cadastrar o termo</a></p></center><br><br>";
        			       } 
        			       }
                             
                           
                    echo "<input class='form-check-input' type='radio' name='idadotante' value='".$idadotante."' hidden>";
                    echo "</form>";
                    echo "</div>";
        			}       
        			
        		}
        		
        		mysqli_close($connect);
        		
        		echo "<center><a href='formprecadastrotermo.php' class='btn btn-primary'>Voltar</a></p></center><br>";
        		
		} else {
		    echo"<script language='javascript' type='text/javascript'>
				    alert('Preencha os campos obrigatórios');
				    window.location.href='formprecadastrotermo.php'</script>";
		}
?>
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