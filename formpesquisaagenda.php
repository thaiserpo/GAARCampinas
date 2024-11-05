<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
				$email = $fetcharea[2];
				
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
    
    <title>GAAR - Pesquisa de agendamentos</title>
    
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
				  case 'clinica':
				  	include_once("menu_vet.php") ;
					break;
				  
			  }
		
?>
<main role="main" class="container">
    <div class="starter-template">
     	<form action="pesquisaagenda.php" id="pesquisaagenda" name="pesquisaagenda" method="POST" >
     	    <center><p>Para pesquisar um agendamento, escolha uma das opções abaixo ou, se deseja visualizar todos, deixe os campos em branco</p><br></center>
          <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Código de autorização:</label> 
                            <input name="codigo" type="text" id="codigo" maxlength="20" class="form-control" required>
                        </div>
          </div>
          <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome do animal:</label> 
                            <input name="nomedoanimal" type="text" id="nomedoanimal" maxlength="20" class="form-control" required>
                        </div>
          </div>
          <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome do protetor independente: </label>
                              <select name="nomedoprotetor" id="nomedoprotetor" class="form-control">
                                  <option name="" value="">Selecione</option>
                                   <?
                                            $queryprot = "SELECT ID, NOME FROM PROTETORES WHERE SITUACAO='ATIVO' ORDER BY NOME ASC";
                            				$selectprot = mysqli_query($connect,$queryprot);
                            				
                            				while ($fetchprot = mysqli_fetch_row($selectprot)) {
                            					echo "<option value='".$fetchprot[1]."'>".$fetchprot[1]."</option>";
                            				}
                            		    ?>
                                </select>
                        </div>
          </div>
          <!--<div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome do tutor ou responsável:</label> 
                            <input name="nomedotutor" type="text" id="nomedotutor" maxlength="100" class="form-control" required>
                        </div>
          </div>
        <!--<div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Status: </label>
                          <select name="status" class="form-control">
                              <option name="" value="">Selecione</option>
                              <option name="esperando" value="Esperando aprovação">Esperando aprovação</option>
                              <option name="aprovado" value="Aprovado">Aprovado</option>
                              <option name="rejeitado" value="Rejeitado">Rejeitado</option>
                            </select>
                       </div>
        </div>-->
        <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Clínica: </label>
                          <select name="clinica" class="form-control">
                              <option name="" value="">Selecione</option>
                               <?
                        		 		if ($area == 'clinica'){
                                            $queryvet = "SELECT ID, CLINICA FROM CLINICAS WHERE EMAIL ='$email' ORDER BY CLINICA ASC";
                                        } else {
                        		 		    $queryvet = "SELECT ID, CLINICA FROM CLINICAS ORDER BY CLINICA ASC";
                                        }
                        				$selectvet = mysqli_query($connect,$queryvet);
                        				
                        				while ($fetchvet = mysqli_fetch_row($selectvet)) {
                        					echo "<option value='".$fetchvet[0]."'>".$fetchvet[1]."</option>";
                        				}
                        		    ?>
                            </select>
                        </div>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Mês do procedimento: </label>
                          <select name="mesprocedi" class="form-control">
                              <option name="" value="">Selecione</option>
                                <option value="01">Janeiro</option>
                                <option value="02">Fevereiro</option>
                                <option value="03">Março</option>
                                <option value="04">Abril</option>
                                <option value="05">Maio</option>
                                <option value="06">Junho</option>
                                <option value="07">Julho</option>
                                <option value="08">Agosto</option>
                                <option value="09">Setembro</option>
                                <option value="10">Outubro</option>
                                <option value="11">Novembro</option>
                                <option value="12">Dezembro</option>
                            </select>
                        </div>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Ano do procedimento: </label>
                          <select name="anoprocedi" class="form-control">
                              <option name="" value="">Selecione</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
        </div>
        <div class="form-row">
                      <div class="form-group col-md-6">
                          <label>Ativo: </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ativo" id="ativo" value="SIM"><label class="form-check-label" for="gridRadios1">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ativo" id="ativo" value="NÃO"><label class="form-check-label" for="gridRadios1">Não</label>
                        </div>
                    </div>
        </div>
        <div class="form-row">
                      <div class="form-group col-md-6">
                          <label>Procedimento realizado: </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="realizado" id="realizado" value="SIM"><label class="form-check-label" for="gridRadios1">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="realizado" id="realizado" value="NÃO"><label class="form-check-label" for="gridRadios1">Não</label>
                        </div>
                    </div>
        </div>
        <div class="form-row">
            <center><a href="javascript:pesquisaagenda.submit()" class="btn btn-primary">Pesquisar</a></center>
        </div
        <br>
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
<?
}
mysqli_close($connect);
?>
</body>
</html>
