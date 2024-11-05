<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$usuario = $_GET['usuario'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}

        $query = "SELECT * FROM VOLUNTARIOS WHERE USUARIO = '$usuario'";
        $select = mysqli_query($connect,$query);
        $reccount = mysqli_num_rows($select);

        while ($fetch = mysqli_fetch_row($select)) {
                $usuariovol = $fetch[0];
				$nomevol = $fetch[2];	
		        $areavol = $fetch[5];	
		        $subareavol = $fetch[6];	
				$telefone = $fetch[3];
				$email = $fetch[4];
				$cep = $fetch[18];
				$endereco = $fetch[19];
				$dtnasc = $fetch[13];
				$status = $fetch[25];
				$cpc = $fetch[27];
				$cpg = $fetch[7];
				$termovol = $fetch[24];
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
    
    <title>GAAR - Atualização de voluntário</title>
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
        <br>
       <center>
        <h3>ATUALIZAÇÃO DE VOLUNTÁRIO</h3><br>
       </center>
        <form action="atualizavoluntario.php" method="POST" enctype="multipart/form-data" name="form">
            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Nome<font color="red">*</font>: </label> 
                                    <input name="nomevol" type="text" id="nomevol" maxlength="100" class="form-control" required value="<? echo $nomevol ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Status: </label> 
                                    <select class="form-control" id="statusvol" name="statusvol" required> 
                                            <option selected value="<? echo $status ?>"><? echo $status ?></option>
                                            <option value="">-----------------</option>
                                            <option value="Aprovado">Aprovado</option>
                                            <option value="Inativo">Inativo</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Login<font color="red">*</font>: </label> 
                                    <input name="usuariovol" type="text" id="usuariovol" maxlength="100" class="form-control" required value="<? echo $usuariovol ?>" disabled>
                                </div>
            </div>
            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>DDD + Celular: </label> 
                                    <input name="celularvol" type="text" id="celularvol" maxlength="20" class="form-control" required value="<? echo $telefone ?>">
                                    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>E-mail: </label> 
                                    <input name="emailvol" type="email" id="emailvol" maxlength="150" class="form-control" required value="<? echo $email ?>">
                                </div>
            </div>
            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Data de nascimento: </label> 
                                    <input name="dtnascvol" type="date" id="dtnascvol" class="form-control" required value="<? echo $dtnasc ?>">
                                    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Assinou o termo de voluntariado? </label> 
                                    <select class="form-control" id="termovol" name="termovol" required> 
                                            <option selected value="<? echo $termovol ?>"><? echo $termovol ?></option>
                                            <option value="">-----------------</option>
                                            <option value="Sim">Sim</option>
                                            <option value="Não">Não</option>
                                    </select>
                                </div>
            </div>
            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Faz parte da CPG? (Comissão Provisória dos Gatos) </label> 
                                    <select class="form-control" id="cpgvol" name="cpgvol" required> 
                                            <option selected value="<? echo $cpg ?>"><? echo $cpg ?></option>
                                            <option value="">-----------------</option>
                                            <option value="Sim">Sim</option>
                                            <option value="Não">Não</option>
                                    </select>
                                    <small id="passwordHelpBlock" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Faz parte da CPC? (Comissão Provisória dos Cães) </label> 
                                    <select class="form-control" id="cpcvol" name="cpcvol" required> 
                                            <option selected value="<? echo $cpc ?>"><? echo $cpc ?></option>
                                            <option value="">-----------------</option>
                                            <option value="Sim">Sim</option>
                                            <option value="Não">Não</option>
                                    </select>
                                    <small id="passwordHelpBlock" class="form-text text-muted"></small>
                                </div>
            </div>
            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Área: </label> 
                                    <select name="areavol" class="form-control" >
                            		    <option value="<? echo $areavol?>"><? echo $areavol?></option>
                            		    <option name="-" value="">----------------</option>
                            		<!--option name="op1" value="diretoria">Diretoria</option>-->
                            			<option value="admin">Administrativo</option>
                            			<option value="captacao">Captação</option>
                            			<option value="comunicacao">Comunicação</option>
                            			<option value="operacional">Operacional</option>
                            			<option value="financeiro">Financeiro</option>
                            		</select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sub área: </label> 
                                   <select name="subareavol" class="form-control">
                            			    <option value="<? echo $subarea?>"><? echo $descricaosubarea?></option>
                            		        <option value="">----------------</option>
                                		<!--	<option name="op12" value="diretoria">Diretoria</option> -->
                                			<option value="admin">Administrativo</option>
                                			<option value="bazar">Bazar</option>
                                			<option value="cadastrotermo">Cadastro de termos de adoção</option>
                                			<option value="caosciencia">Cãosciencia Pet</option>
                                			<option value="contabil">Contabilidade</option>
                                			<option value="designer">Designer</option>
                                			<option value="feira">Feira</option>
                                			<option value="financeiro">Financeiro</option>
                                			<option value="lt">Lar temporário</option>
                                			<option value="notas">Notas fiscais</option>
                                			<option value="operacional">Operacional</option>
                                			<option value="eventos">Organizador de eventos</option>
                                			<option value="posadocao">Pós adoção</option>
                                			<option value="redes">Redes sociais</option>
                                			<option value="site">Site</option>
                                			<option value="vet">Veterinários parceiros</option>
                                		</select>                        </div>
            </div>
            
            <font color="red"><i>* Campos obrigatórios</i></font>
            <br>
            <center><a href="javascript:form.submit()" class="btn btn-primary">Atualizar</a></center>
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
</body>