<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

$dia_iniciopost = date('Y-m-d', strtotime('next monday'));
$dia_iniciopost_semana = date('Y-m-d', strtotime('monday this week'));
$dia_fimpost = date('Y-m-d', strtotime($dia_iniciopost. ' + 6 days'));
$dia_fimpost_semana = date('Y-m-d', strtotime('sunday this week'));

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,NOME FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$nome = $fetcharea[1];
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
    
    <title>GAAR - Área do voluntário</title>
    <!--- GOOGLE ADSENSE --->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
    <!--- GOOGLE ADSENSE --->
    
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
    <p><h3>Olá, <? echo $nome ?>! Seja bem vindo a área restrita do GAAR! Abaixo está o passo-a-passo de todas as funções disponíveis em sua área: <br><br></h3></p>
    <div id="divgradesemana" class="d-block">
        <center><h4>POSTS DA SEMANA ATUAL</h4>
        <p> <a href="https://gaarcampinas.org/area/envioemailredacao.php" target="_blank">Criar e-mail para grupo de redação</a></p></center>
        <?
            $query = "SELECT * FROM ANIMAIS_REDES WHERE DIA_POST >= '".$dia_iniciopost_semana."' AND DIA_POST <= '".$dia_fimpost_semana."' ORDER BY DIA_POST ASC";
            $select = mysqli_query($connect,$query);
            $reccount = mysqli_num_rows($select);
            
            echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>ID</th>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>Espécie</th>";
        	echo "<th scope='col' colspan='1'>Data do post</th>";
        	echo "<th scope='col' colspan='3'>Último post</th>";
        	echo "</thead>";
        	echo "<tbody>";
            
            while ($fetch = mysqli_fetch_row($select)) {
            
                $idanimal = $fetch[1];
                $data_post_semana = $fetch[2];
                $ultimo_post = $fetch[4];
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
				echo "<td>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</td>";
				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpet=".$idanimal."' target='_blank'>Deletar</a></td>";
			    echo "</tr>";
			}   
			        echo "</tbody>";
			        echo "</table><br>";
        ?>

    </div>
    <p><strong>CADASTRAR ANIMAIS DE TERCEIROS</strong><br>
        	Qualquer animal, seja da ONG ou não, que esteja procurando um lar, deve ser cadastrado através dessa opção. Os animais que forem cadastrados irão aparecer na página de busca.</p>
          <p><br>
            1 - Clique o menu Comunicação na barra superior <br>
            2 - Clique em Cadastrar animais de terceiros <br>
            3 - Preencha todos os campos, para os animais de terceiros seleciona Divulgar como Terceiros. <br>
            4 - Escolha o tipo do anúncio: Doação, Perdido ou Encontrado. <br><br>
        </p>
    <br>
    <p><strong>APROVAR ANIMAIS DE TERCEIROS </strong><br>
        	Qualquer animal que não seja da ONG que esteja procurando um lar, deve passar por aprovação para validar se está dentro das regras. Os animais que forem aprovados irão aparecer na página de busca.
            </p>
          <p>&nbsp;</p>
          <p>1 - Clique o menu Comunicação na barra superior <br>
            2 - Clique em Aprovar animais de terceiros <br>
            3 - Valide todos os campos, caso tenha alguma informação que não esteja dentro das regras, você pode escrever uma mensagem para o anunciante ou apenas não clicar em Atualizar. <br>><br>
         </p>
    <br /><br />
    </div>
</main>
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