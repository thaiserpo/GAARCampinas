<?php 		
		/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
$login = $_SESSION['login'];

if($login == "" || $login == null){
		  echo"<script language='javasript' type='text/javscript'>
		  alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{

    $queryarea = "SELECT * FROM VOLUNTARIOS WHERE USUARIO ='$login'";
    $selectarea = mysqli_query($connect,$queryarea);
    
    while ($fetcharea = mysqli_fetch_row($selectarea)) {
    		$area = $fetcharea[5];
    		$subarea = $fetcharea[6];
    		
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
    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Lista de voluntários</title>
    
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
    <center>
        <h3>LISTA DE VOLUNTÁRIOS APROVADOS</h3><br>
        <p><label> Aqui estão todos os voluntários ativos no sistema e na ONG. Caso algum não esteja aparecendo, cadastre <a href="cadastro_voluntario.php">aqui</a>. </label></p>
       </center>
<?php 			
            $query = "SELECT * FROM VOLUNTARIOS WHERE (AREA = 'operacional' OR AREA = 'admin' OR AREA = 'diretoria' OR AREA = 'financeiro' OR AREA = 'comunicacao' OR AREA = 'captacao') AND STATUS_APROV='Aprovado' ORDER BY NOME ASC";
    		$select = mysqli_query($connect,$query);
    		$reccount = mysqli_num_rows($select);

		if ($reccount == 0) {
			echo "<center>Nenhum voluntário encontrado <br></center>";
		}else{ 
		    echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>Área</th>";
        	echo "<th scope='col'>Subárea</th>";
        	echo "<th scope='col'>Telefone</th>";
        	echo "<th scope='col'>E-mail</th>";
        	echo "<th scope='col' colspan='3'>Status</th>";
        	echo "</thead>";
        	echo "<tbody>";
			while ($fetch = mysqli_fetch_row($select)) {
			        $usuariovol = $fetch[0];	
			        $nome = $fetch[2];	
			        $areavol = $fetch[5];	
			        $subareavol = $fetch[6];	
					$telefone = $fetch[3];
					$email = $fetch[4];
					$status = $fetch[25];
					echo "<tr>";
					echo "<td>".$nome."</td>";
					echo "<td>".$areavol."</td>";
					echo "<td>".$subareavol."</td>";
					echo "<td>".$telefone."</td>";
					echo "<td>".$email."</td>";
					echo "<td>".$status."</td>";
					if ($subarea == 'diretoria') {
                        echo "<td><a href='formatualizavol.php?usuario=".$usuariovol."'><button type='button' class='btn btn-primary' title='Atualizar'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                          <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                        </svg>
                                  </button></a></td>";
                        echo "<td><a href='desativavoluntario.php?usuario=".$usuariovol."'><button type='button' class='btn btn-primary' title='Desativar'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                      </svg>
                                  </button></a></td>";
					}
					echo "</tr>";
			}
			echo "</tbody>
			      </table> <br><center> ".$reccount." voluntários ativos</center> <Br><Br>";
		}
?>
<center>
<h3>LISTA DE VOLUNTÁRIOS INATIVOS/REPROVADOS</h3><br>
        <p><label> Aqui estão todos os voluntários desativados no sistema e na ONG. Caso algum não esteja aparecendo, cadastre <a href="cadastro_voluntario.php">aqui</a>. </label></p>
       </center>
<?php 			
            $query = "SELECT * FROM VOLUNTARIOS WHERE (AREA = 'operacional' OR AREA = 'admin' OR AREA = 'diretoria' OR AREA = 'financeiro' OR AREA = 'comunicacao' OR AREA = 'captacao') AND STATUS_APROV<>'Aprovado' ORDER BY NOME ASC";
    		$select = mysqli_query($connect,$query);
    		$reccount = mysqli_num_rows($select);

		if ($reccount == 0) {
			echo "<center>Nenhum voluntário encontrado <br></center>";
		}else{ 
		    echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>Área</th>";
        	echo "<th scope='col'>Subárea</th>";
        	echo "<th scope='col'>Telefone</th>";
        	echo "<th scope='col'>E-mail</th>";
        	echo "<th scope='col' colspan='3'>Status</th>";
        	echo "</thead>";
        	echo "<tbody>";
			while ($fetch = mysqli_fetch_row($select)) {
			        $usuariovol = $fetch[0];	
			        $nome = $fetch[2];	
			        $areavol = $fetch[5];	
			        $subareavol = $fetch[6];	
					$telefone = $fetch[3];
					$email = $fetch[4];
					$status = $fetch[25];
					echo "<tr>";
					echo "<td>".$nome."</td>";
					echo "<td>".$areavol."</td>";
					echo "<td>".$subareavol."</td>";
					echo "<td>".$telefone."</td>";
					echo "<td>".$email."</td>";
					echo "<td>".$status."</td>";
					if ($subarea == 'diretoria') {
                        echo "<td><a href='formatualizavol.php?usuario=".$usuariovol."'><button type='button' class='btn btn-primary' title='Atualizar'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                          <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                        </svg>
                                  </button></a></td>";
                        echo "<td><a href='desativavoluntario.php?usuario=".$usuariovol."'><button type='button' class='btn btn-primary' title='Desativar'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                      </svg>
                                  </button></a></td>";
					}
					echo "</tr>";
			}
			echo "</tbody>
			      </table> <br><center> ".$reccount." voluntários inativos</center> <Br><Br>";
		}
?>
<?
		mysqli_close($connect);
?>
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
</html>

