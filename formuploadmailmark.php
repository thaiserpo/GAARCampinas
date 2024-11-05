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
    
    <title>GAAR - Agendamento de e-mail marketing</title>
    
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
		
?>

<main role="main" class="container">
    <div class="starter-template">
       <center>
        <h3>E-MAIL MARKETING</h3><br>
        <p><label> Faça o upload dos arquivos e agende o envio do e-mail marketing. Os e-mails são enviados diariamente às 18h. <br></center></label></p>
       </center>
            <form action="uploadmailmark.php" method="POST" enctype="multipart/form-data" name="form">
                <div class="form-group col-md-6">
                            <label>Data do envio: </label> 
                            <input name="dtenvio" type="date" id="dtenvio" class="form-control" required>
                        </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Título do e-mail: </label>
                    <input type="text" class="form-control-file" id="subject" name="subject" maxlength="40">
                    <!--<input type="file" class="form-control-file" id="subject" name="subject" accept=".txt">-->
                    <small id="passwordHelpBlock" class="form-text text-muted">Limitado a 40 caracteres</small>
                </div>
                <div class="form-group col-md-6">
                    <label>Escolher imagem para o corpo do e-mail: </label>
                    <input type="file" class="form-control-file" id="body" name="body" accept=".png">
                    <small id="passwordHelpBlock" class="form-text text-muted">O arquivo deve estar no formato PNG</small>
                </div>
                <br><br>
                <!--<div class="form-group row" class="d-none">
                  <label class="col-sm-2 col-form-label">Texto para divulgação: </label> 
                  <div class="col-sm-10">
                    <textarea class="form-control" name="obs" cols="70" rows="10" id="obs" value="<? echo $obs?>"></textarea>
                    <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis.</small>
                  </div>
                </div>-->
                <center><a href="javascript:form.submit()" class="btn btn-primary">Agendar</a></center>
            </form>
            
            <div id="divtermos" class="d-none">
                    	<center>
                               <br><h4>ÚLTIMOS AGENDAMENTOS CADASTRADOS</h4><br>
                    	<?

                    	    $query = "SELECT * FROM EMAIL_MARKETING ORDER BY ID DESC LIMIT 5";
                    		$result = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($result);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Data</th>";
                            	echo "<th scope='col'>Título</th>";
                            	echo "<th scope='col'>Post</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $nomeanimal = $fetch[15];
                    				$especie = $fetch[16];
                    				$adotante = $fetch[1];
                    				$dtadocao = $fetch[32];
                    				
                    				$ano_adocao = substr($dtadocao,0,4);
                        		    $mes_adocao = substr($dtadocao,5,2);
                        		    $dia_adocao = substr($dtadocao,8,2);

                        			echo "<tr>";
                        			echo "<td>".$nomeanimal."</td>";
                					echo "<td>".$especie."</td>";
                					echo "<td>".$adotante."</td>";
                					echo "<td>".$dia_adocao."/".$mes_adocao."/".$ano_adocao."</td>";
                					echo "<td><a href='formvisualizatermo.php?idtermo=".$fetch[0]."' target='_blank'><button type='button' class='btn btn-primary' title='Visualizar'>
                					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                          <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                          <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                        </svg>
                                                    </button></a></td>";
                				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum agendamento encontrado</p><br>";
                    		}
                    	?>
                    	</center>
        </div>
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
<?
}
mysqli_close($connect);
?>