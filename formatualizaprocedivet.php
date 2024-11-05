<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$id = $_GET['id'];

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

        $query = "SELECT * FROM PROCEDIMENTOS WHERE ID ='$id'";
		$select = mysqli_query($connect,$query);
			
		while ($fetch = mysqli_fetch_row($select)) {
				$id = $fetch[0];
				$data = $fetch[1];
				$nomedoanimal = $fetch[2];
				$especie = $fetch[3];
				$sexo = $fetch[4];
				$nomedotutor = $fetch[5];
				$teldotutor = $fetch[6];
				$requigaar = $fetch[7];
				$tipoproc = $fetch[9];
				$valor = $fetch[10];
				$clinica = $fetch[11];
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
    
    <title>GAAR - Atualização de procedimentos</title>
    
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
				  case 'clinica':
				  	include_once("menu_vet.php") ;
					break;
				  case 'lt':
				  	include_once("menu_lt.php") ;
					break;
			  }
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
       <center>
        <h3>ATUALIZAÇÃO DO PROCEDIMENTO NÚMERO <label id="id" name="id"><? echo $id ?></label></h3><br>
        <p><label> É importante atualizar o procedimento corretamente pois as informações aqui preenchidas irão ser usadas para realizar pagamentos.</label></p>
       </center>
            <form action="atualizaprocedi.php" method="POST" enctype="multipart/form-data" name="form">
                	<div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Data da cirurgia:</label> 
                            <input name="dtcirurgia" type="date" id="dtcirurgia" class="form-control" value="<? echo $data?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nome do animal: </label> 
                            <input name="nomedoanimal" type="text" id="nomedoanimal" maxlength="20" class="form-control" value="<? echo $nomedoanimal?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome do tutor:</label> 
                            <input name="nomedotutor" type="text" id="nomedotutor" maxlength="100" class="form-control" value="<? echo $nomedotutor?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Telefone do tutor: </label> 
                            <input name="teldotutor" type="text" id="teldotutor" maxlength="20" class="form-control" value="<? echo $teldotutor?>" readonly>
                        </div>
                    </div>
                <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Espécie:</label> 
                            <input name="especie" type="text" id="especie" class="form-control" value="<? echo $especie?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Sexo: </label> 
                            <input name="sexo" type="text" id="sexo" class="form-control" value="<? echo $sexo?>" readonly>
                        </div>
                    </div>
                <br>
                <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Solicitante:</label> 
                            <input name="requigaar" type="text" id="requigaar" class="form-control" value="<? echo $requigaar?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Aprovador: </label>
                            <select class="form-control" id="inlineFormCustomSelect" name="aprovagaar" required>
                         		  <?
                        		 		$queryreq = "SELECT NOME FROM VOLUNTARIOS WHERE USUARIO ='$login' ORDER BY NOME ASC";
                        				$selectreq = mysqli_query($connect,$queryreq);
                        				
                        				while ($fetchreq = mysqli_fetch_row($selectreq)) {
                        					echo "<option value='".$fetchreq[0]."'>".$fetchreq[0]."</option>";
                        				}
                        		?>
                	        </select>
                    	 </div>
                    	 <div class="form-group col-md-4">
                            <label>Status: </label>
                            <select class="form-control" id="inlineFormCustomSelect" name="status" required>
                         		  <option selected name="status" value="Realizado">Realizado</option>
                	        </select>
                    	 </div>
                </div>
                <div class="form-row">
                        <div class="form-group col-md-4">
                          <label>Tipo de procedimento: </label>
                            <input name="tipoproc" type="text" id="tipoproc" class="form-control" value="<? echo $tipoproc?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Valor: </label>
                            <input name="valor" type="text" id="valor" class="form-control" value="<? echo $valor?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                             <label>Clínica: </label>
                            <input name="clinica" type="text" id="clinica" class="form-control" value="<? echo $clinica?>" readonly>
                        </div>
                </div>
                <div class="form-row">
                        <div class="form-group col-md-8">
                          <label>Observações: </label>
                            <textarea class="form-control" name="obs" cols="70" rows="10" id="obs"><? echo $obs ?></textarea>
                            <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis</small>
                        </div>
                </div>
                <input type="text" name="id" value="<? echo $id?>" hidden>
                <center><a href="javascript:form.submit()" class="btn btn-primary">Atualizar</a></center>
            </form>
    </div>
</main>
<br>
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