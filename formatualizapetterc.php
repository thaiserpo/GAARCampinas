<?php
session_start();

include ("conexao.php");

$login = $_SESSION['login'];
$idanimalter = $_GET['idanimal'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
		
		$query = "SELECT * FROM ANIMAL WHERE ID = '$idanimalter'";
		$select = mysqli_query($connect,$query);
		$fetch = mysqli_fetch_row($select);		
		
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
    
    <title>GAAR - Atualização de animais de terceiros</title>
    
    <script type="text/javascript">
	function validaimagem() {
		var extensoesOk = ",.gif,.jpg,.jpeg,.png,.gif,.bmp,";
		var extensao	= "," + document.form.foto.value.substr( document.form.foto.value.length - 4 ).toLowerCase() + ",";
		window.document.write(extensao);
		if (document.form.foto.value == "")
		 {alert("O campo do endereço da imagem está vazio!!")}
		else if( extensoesOk.indexOf( extensao ) == -1 )
		 { alert( document.form.foto.value + "\nNão possui uma extensão válida" );javascript:location.reload()}
		else {javascript:tamanhos()}	 
		}
		
		function tamanhos() {
		var imagem=new Image();
		imagem.src=document.form.foto.value;
		tamanho_imagem = imagem.fileSize 
		img_tan = tamanho_imagem
		if (tamanho_imagem < 0)
		 {javascript:tamanhos()}
		else if (tamanho_imagem > 150000)
		{alert("O tamanho da Imagem é muito grande ...  "+tamanho_imagem+" Bytes!!");javascript:location.reload()}
		else 
		{javascript:ativafigura()}
		}
		function ativafigura() {
			largura = document.getElementById("foto").width;
			altura = document.getElementById("foto").height;
			if (largura > 400 || altura > 400 ){
				alert("A imagem é "+largura+"x"+altura+" está fora do padrão requerido: 400 x 400");javascript:location.reload()
		  	}
		  }
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
     <CENTER>
	        <br>
	        <h3>ATUALIZAÇÃO DE ANIMAIS DE TERCEIROS</h3>
      </CENTER>
      <br>
	<form action="atualizapetterc.php" method="POST" enctype="multipart/form-data" name="formatualiza">
	    <input class="box" type="text" name="idanimalter" id="idanimalter" value="<? echo $fetch[0]; ?>" hidden>
       <center><h5>DADOS DO ANIMAL</h5></center>
       <div>
	   <center><img class="img-responsive img-fluid rounded" src="/pets/'<? echo $fetch[16]; ?>'" valign="top" align="center" width="600" height="800"/> <br><br> </center>
	    </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome: </label> 
                  <div class="col-sm-4">
                    <input name="nomedoanimal" type="text" id="nomedoanimal" maxlength="20" class="form-control" value="<? echo $fetch[1]; ?>">
                  </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Espécie: </label> 
                  <div class="col-sm-4">
                    <input name="especie" type="text" id="especie" maxlength="10" class="form-control" value="<? echo $fetch[2]; ?>">
                  </div>
        </div>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Data de nascimento (aproximada): </label> 
                  <div class="col-sm-4">
                    <input name="idade" type="text" id="idade" class="form-control" value="<? echo $fetch[3]; ?>">
                  </div>
      </div>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Sexo: </label> 
                  <div class="col-sm-4">
                    <input name="sexo" type="text" id="sexo" maxlength="6" class="form-control" value="<? echo $fetch[4]; ?>">
                  </div>
      </div>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Cor: </label> 
                  <div class="col-sm-4">
                    <input name="cor" type="text" id="cor" maxlength="50" class="form-control" value="<? echo $fetch[5]; ?>">
                  </div>
      </div>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Porte: </label> 
                  <div class="col-sm-4">
                    <input name="porte" type="text" id="porte" maxlength="13" class="form-control" value="<? echo $fetch[6]; ?>">
                  </div>
      </div>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Castração: </label> 
                  <div class="col-sm-4">
                    <input name="castracao" type="text" id="castracao" maxlength="15" class="form-control" value="<? echo $fetch[7]; ?>">
                  </div>
      </div>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Vacinação: </label> 
                  <div class="col-sm-4">
                    <input name="vacinacao" type="text" id="vacinacao" maxlength="15" class="form-control" value="<? echo $fetch[9]; ?>">
                  </div>
      </div>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Telefone: </label> 
                  <div class="col-sm-4">
                    <input name="resp" type="text" id="resp" maxlength="15" class="form-control" value="<? echo $fetch[12]; ?>">
                  </div>
      </div>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">E-mail: </label> 
                  <div class="col-sm-4">
                    <input name="emailresp" type="text" id="emailresp" maxlength="15" class="form-control" value="<? echo $fetch[17]; ?>">
                  </div>
      </div>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Divulgar como: </label> 
                  <div class="col-sm-4">
                    <input type="radio" name="divulgar" id="divulgar" value="Terceiros" checked>Terceiros <br>
                    <input type="radio" name="divulgar" id="divulgar" value="Não aprovado">Não aprovado
                  </div>
      </div>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Texto: </label> 
                  <div class="col-sm-4">
                    <textarea name="obs" cols="50" rows="10" id="obs"><? echo $fetch[15]; ?></textarea>
                  </div>
      </div>
       <Center><a href="javascript:formatualiza.submit()" class="btn btn-primary">Atualizar</a></Center>
	</form>
	<br>
	<form action="envioemailpetterc.php" method="POST" enctype="multipart/form-data" name="formenviaresp">
    	<center><h5>RESPOSTA AO ANUNCIANTE</h5></center>
    	<br>
    	<input type="text" name="nomeanimal" id="nomeanimal" value="<? echo $fetch[1]; ?>" hidden><input type="text" name="email" id="email" value="<? echo $fetch[17]; ?>" hidden>
        <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Caso tenha alguma observação a fazer, digite sua mensagem: </label>
                  <div class="col-sm-4">
                    <textarea name="resposta" cols="50" rows="10" id="resposta"></textarea>
                  </div>
        </div>
        <Center><a href="javascript:formenviaresp.submit()" class="btn btn-primary">Enviar resposta ao anunciante</a></Center>
    </form>
    <br>
     <Center><a href="pesquisapetterc.php" class="btn btn-primary">Voltar</a></Center>
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