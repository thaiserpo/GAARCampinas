<?php 		
		/* conexao do banco de dados */
session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 
		
$lt = $_GET['lt'];

$query = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO='$lt' AND (ADOTADO='Disponível' or ADOTADO='Indisponível')";
$result = mysqli_query($connect,$query);
$reccount = mysqli_num_rows($result);

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
    
    <title>GAAR - Área do voluntário</title>
    
</head>
<body> 
<main role="main" class="container">
    <div class="starter-template">
<?

if ($reccount != '0'){
    echo "<table class='table' border 1>";
    echo "<thead class='thead-light'>";
    echo "<th scope='col'>Nome do animal</th>";
    echo "<th scope='col'>Espécie</th>";
    echo "<th scope='col'>Responsável</th>";
    echo "</thead>";
    echo "<tbody>";
    while ($fetch = mysqli_fetch_row($result)) {
        $nomeanimal = $fetch[1];
    	$especie = $fetch[2];
    	$responsavel = $fetch[12];
    		echo "<tr>";
    		echo "<td>".$nomeanimal."</td>";
    		echo "<td>".$especie."</td>";
    		echo "<td>".$responsavel."</td>";
    	    echo "</tr>";
    }   
            echo "</tbody>";
            echo "</table><br>";
    } 
    else {
        echo "<center><p>Nenhum animal encontrado</p><br>";
}
?>
</main>
<br>

<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>
