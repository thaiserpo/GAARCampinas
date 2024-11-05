<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];


if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA,NOME,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
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
    
    <title>GAAR - Upload planilha de castração</title>
    
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
	 
	function AddFoto2 () {
                                        document.getElementById('divfoto2').className  = "d-block";
                                        document.getElementById('addfoto3').className  = "d-block";
                                        document.getElementById('addfoto2').className  = "d-none";
    }
	</script>
	
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
				  
			  }
			  
		}
		
?>

<main role="main" class="container">
    <div class="starter-template">
       <center>
        <h3>PROCEDIMENTOS</h3><br>
       </center>
            <form action="uploadcastracao.php" method="POST" enctype="multipart/form-data" name="form">
                <i>Observações:</i>
                <p>- O arquivo precisa estar em formato CSV UTF-8 delimitado por vírgula</p>
                <p>- As datas precisam estar no formato dd/mm/yyyy</p>
                <p>- Uma aba por arquivo</p>
                <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Extrato<font color="red"><strong>*</strong></font>: </label> 
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" id="procedicsv" name="procedicsv" accept=".csv">
                            <small id="passwordHelpBlock" class="form-text text-muted">Arquivo aceito em formato CSV UTF-8 delimitado por vírgula</small>
                    </div>
                </div>
                <center><a href="javascript:form.submit()" class="btn btn-primary">Enviar</a></center>
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