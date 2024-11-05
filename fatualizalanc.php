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
		
		$id = $_GET['idlanc'];

		$query = "SELECT * FROM FINANCEIRO WHERE ID = '$id'";
		$select = mysqli_query($connect,$query);
		$fetch = mysqli_fetch_row($select);	
		
		$data = $fetch[1];
		$descricao = $fetch[2];
		$subcat = $fetch[3];
		$cat = $fetch[13];
		
		
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
    
    <title>GAAR - Atualização de lançcamento</title>
    
    <script type="text/javascript">
                            
                            $(document).ready(function(){
                             $("#btnAtualizalt").click(function(){
                                
                            	$.ajax({
                                	url: "atualizalt.php",
                             		type: "POST",
                             		data: {
                             		    id_lt=document.getElementById("id").value,
                             		    nome_lt: document.getElementById("nomelt").value,
                             		    endereco_lt: document.getElementById("endereco").value,
                             		    bairro_lt: document.getElementById("bairro").value,
                             		    tel_fixo_lt: document.getElementById("tel_fixo").value,
                             		    celular_lt: document.getElementById("celular").value,
                             		    email_lt: document.getElementById("email").value,
                             		    especies_lt: document.getElementById("especies").value,
                             		    qtdecaes_lt: document.getElementById("qtdecaes").value,
                             		    qtdegatos_lt: document.getElementById("qtdegatos").value,
                             		    vagasdisp_lt: document.getElementById("vagasdisp").value,
                             		    resp_lt: document.getElementById("resp").value,
                             		    ativo_lt: document.getElementById("ativo").value,
                             		    ltpago_lt: document.getElementById("ltpago").value,
                             		    banco_lt: document.getElementById("bancolt").value,
                             		    agencia_lt: document.getElementById("agencialt").value,
                             		    conta_lt: document.getElementById("contalt").value,
                             		    dv_lt: document.getElementById("dvlt").value,
                             		    cpfcnpj_lt: document.getElementById("cpfcnpj").value,
                             		    valordiario_lt: document.getElementById("valordiario").value,
                             		    qtde_vagas_lt = document.getElementById("qtdevagas").value,
                             		},
                            		success: function(response){
                            		    document.getElementById('AlertSuccess_lt').innerHTML= document.getElementById("nomelt").value + " atualizado com sucesso";
                            		    document.getElementById('lblAlertSuccess_lt').className = "alert alert-success d-block";
                                    },
                                    error: function(response){
                                        document.getElementById('AlertDanger_lt').innerHTML= document.getElementById("nomelt").value + " não foi atualizado. Por favor tente novamente"; 
                                        document.getElementById('lblAlertDanger_lt').className = "alert alert-danger d-block";
                                    }
                            	});
                            });
                            
                             
                          });   
                          

    </script>
    
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
        <h3>ATUALIZAÇÃO DE LANÇAMENTO </h3><br>
    </center>
    <form action="atualizaextrato.php" method="POST" enctype="multipart/form-data" name="form">
        <input name="id" type="text" id="id" maxlength="50" class="form-control" value="<? echo $id?>" hidden>
        <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Data: </label> 
                            <input name="dtlanc" type="date" id="dtlanc" class="form-control" value="<? echo $data?>" required disabled>
                        </div>
        </div>
        <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Descrição: </label> 
                            <input name="novadesc" type="text" id="novadesc" maxlength="300" class="form-control" value="<? echo $descricao?>" required>
                        </div>
        </div>
        <div class="form-row">
                         <div class="form-group col-md-4">
                            <label>Sub tipo: </label> 
                            <select name="subtipocat" id="subtipocat" class="form-control">
                                <option value="<? echo $subcat?>"><?echo $subcat?></option>
                                <option value="">Selecione</option>
                                <option value="Sócio">Sócio</option>
                                <option value="Bazar">Bazar</option>
                                <option value="Doações">Doações</option>
                                <option value="Rifas">Rifas</option>
                                <option value="NFP">NFP</option>
                                <option value="Vendas">Vendas</option>
                                <option value="Taxas de adoção">Taxas de adoção</option>
                                <option value="Juros">Juros</option>
                                <option value="Outras receitas">Outras receitas</option>
                                <option value="Lar temporário">Lar temporário</option>
                                <option value="Ração">Ração</option>
                                <option value="Veterinário">Veterinário</option>
                                <option value="Taxi dog">Taxi dog</option>
                                <option value="Medicamentos">Medicamentos</option>
                                <option value="Compras">Compras</option>
                                <option value="Impostos">Impostos</option>
                                <option value="Ads redes">Ads redes</option>
                                <option value="Outras despesas">Outras despesas</option>
                                <option value="Transferências">Transferências</option>
                            </select>
                        </div>
        </div>
        <div class="form-row d-none">
          <legend class="col-form-label col-sm-2 pt-0">Tipo: <font color="red"><strong>*</strong></font></legend>
          <div class="col-sm-10">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipocat" id="Despesa" value="Despesa" ><label class="form-check-label" for="gridRadios1" required>Despesa</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipocat" id="Receita" value="Receita" ><label class="form-check-label" for="gridRadios1" required>Receita</label>
            </div>
          </div>
        </div>
        <center><a href="javascript:form.submit()" class="btn btn-primary">Atualizar</a></center>
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