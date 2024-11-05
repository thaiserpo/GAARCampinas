<?php
session_start();

include ("conexao.php");

$login = $_SESSION['login'];

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
    
    <title>GAAR - Cadastro de eventos</title>
    
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
    <p><h3><center>CADASTRO DE EVENTO</center></h3></p>
    <form  action="cadastroadmin.php" method="POST" enctype="multipart/form-data" name="form">
    	<table id="cadastroadmin">
          <tr>
            <td align="left" valign="top">Evento: </td>
            <td align="left" valign="top"><input class="box" name="evento" type="text" id="evento" size="50" maxlength="100"></td>
          </tr>
          <tr>
            <td align="left" valign="top" colspan="2">&nbsp; </td>
          </tr>
          <tr>
            <td align="left" valign="top">Endereço: </td>
            <td align="left" valign="top"><input class="box" name="endereco" type="text" id="endereco" size="50" maxlength="100"></td>
          </tr>
          <tr>
            <td align="left" valign="top" colspan="2">&nbsp; </td>
          </tr>
          <tr>
            <td align="left" valign="top">Data: </td>
            <td align="left" valign="top"><input class="box" name="data" type="date" id="data" size="30" maxlength="30"></td>
          </tr>
          <tr>
            <td align="left" valign="top" colspan="2">&nbsp; </td>
          </tr>
          <tr>
            <td align="left" valign="top">Voluntários presentes: </td>
            <td align="left" valign="top">
         		  <?
        		 		$query = "SELECT NOME FROM VOLUNTARIOS ORDER BY NOME ASC";
        				$select = mysqli_query($connect,$query);
        				
        				while ($fetch = mysqli_fetch_row($select)) {
        					echo "<input class='box' type='checkbox' id='nomevol[]' name='nomevol[]' value='".$fetch[0]."'>".$fetch[0]."<br>";
        				}
        				
        				
        		?>
        	    </select></td>
          </tr>
          <tr>
            <td align="left" valign="top" colspan="2">&nbsp; </td>
          </tr>
          <tr>
            <td align="left" valign="top">Descrição: </td>
            <td align="left" valign="top"><textarea class="box"  name="descricao" cols="60" rows="20" id="celular" maxlength="1000"></textarea></td>
          </tr>
          <tr>
            <td align="left" valign="top" colspan="2">&nbsp; </td>
          </tr>
          <tr>
            <td align="left" valign="top">Arquivo: </td>
            <td align="left" valign="top">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="file">
                    <!--<input class="box"  type="file" name="file" id="file" >-->
                    <label class="custom-file-label" for="customFile"></label>
                </div>
                <script>
                    // Add the following code if you want the name of the file appear on select
                    $(".custom-file-input").on("change", function() {
                      var fileName = $(this).val().split("\\").pop();
                      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                    });
                </script>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top" colspan="2">&nbsp; </td>
          </tr>
          <tr>
              <td align="left" valign="top">Área equivalente: </td>
                <td align="left" valign="top">
            	       <input class="box" type="radio" name="area" id="area" value="Administração" >Administração <br>
            	       <input class="box" type="radio" name="area" id="area" value="Captação" >Captação <br>
            	       <input class="box" type="radio" name="area" id="area" value="Comunicação" >Comunicação <br>
            	       <input class="box" type="radio" name="area" id="area" value="Financeiro" >Financeiro <br>
            	       <input class="box" type="radio" name="area" id="area" value="Operacional" >Operacional
            	</td>
           </tr>
          <tr>
            <td colspan="4" align="center" valign="middle">
                <!--<input type="submit" value="Cadastrar" id="cadastrolt" name="cadastrolt">-->
                <a href="javascript:form.submit()" class="btn btn-primary"> Cadastrar</a>
                </td>
          </tr>
      </table>
    </form>
    <br><br><br>
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