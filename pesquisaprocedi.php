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
    
    <title>GAAR - Pesquisa de procedimentos</title>
    
    <script type="text/javascript">
        window.onload = function() {
          document.getElementById('text-print-relatorio').style.display = 'none';
        };
        
        setTimeout(function(){
           window.location.reload(1);
        }, 60000);


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
				  case 'clinica':
				  	include_once("menu_vet.php") ;
					break;
				  
			  }
		
?>
<main role="main" class="container">
    <div class="starter-template">
        <div class="d-none d-print-block">
            <center><img src="/area/logo_transparent.png" width="70" height="70"></center>
        </div>
        <br>
        <center>
        <p>Os dados foram consultados da tabela de procedimentos. <br>
           Caso o procedimento não tenha sido encontrado, por favor entre em contato com a diretoria.<br><br>
           <i><p>A página será recarregada a cada 60 segundos</p></i> <br>
		</p>
		</center>
        
<?
        if ($area =='clinica'){
            $queryvet = "SELECT CLINICA FROM CLINICAS WHERE EMAIL ='$email'";
    		$selectvet = mysqli_query($connect,$queryvet);
    			
    		while ($fetchvet = mysqli_fetch_row($selectvet)) {
    				$vet = $fetchvet[0];
    		}
    		
    		$query = "SELECT * FROM PROCEDIMENTOS WHERE CLINICA = '$vet' ORDER BY DATA DESC";
    		$select = mysqli_query($connect,$query);
    		$reccount = mysqli_num_rows($select);
    		
        } else {	
            
    		$nomedoanimal = strtoupper($_POST['nomedoanimal']);
    		$nomedotutor = strtoupper($_POST['nomedotutor']);
    		$status = $_POST['status'];
    		$requigaar = $_POST['requigaar'];
    		$clinica = $_POST['clinica'];
		
    		if ($nomedoanimal != '' && $nomedotutor == '' && $status == '' && $requigaar == '' && $clinica == ''){
    			$query = "SELECT * FROM PROCEDIMENTOS WHERE NOME_ANIMAL like '%$nomedoanimal%' ORDER BY DATA DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomedoanimal == '' && $nomedotutor != '' && $status == '' && $requigaar == '' && $clinica == ''){
    			$query = "SELECT * FROM PROCEDIMENTOS WHERE NOME_TUTOR like '%$nomedotutor%' ORDER BY DATA DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomedoanimal == '' && $nomedotutor == '' && $status != '' && $requigaar == '' && $clinica == ''){
    			$query = "SELECT * FROM PROCEDIMENTOS WHERE STATUS_PROC = '$status' ORDER BY DATA DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomedoanimal == '' && $nomedotutor == '' && $status == '' && $requigaar != '' && $clinica == ''){
    			$query = "SELECT * FROM PROCEDIMENTOS WHERE REQUISITOR_GAAR = '$requigaar' ORDER BY DATA DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomedoanimal != '' && $nomedotutor != '' && $status == '' && $requigaar == '' && $clinica == ''){
    			$query = "SELECT * FROM PROCEDIMENTOS WHERE NOME_ANIMAL like '%$nomedoanimal%' and NOME_TUTOR like '%".$nomedotutor."%' ORDER BY DATA DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomedoanimal != '' && $nomedotutor != '' && $status != '' && $requigaar == '' && $clinica == ''){
    			$query = "SELECT * FROM PROCEDIMENTOS WHERE NOME_ANIMAL like '%$nomedoanimal%' and NOME_TUTOR like '%".$nomedotutor."%' and STATUS_PROC = '$status' ORDER BY DATA DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomedoanimal != '' && $nomedotutor != '' && $status != '' && $requigaar != '' && $clinica == ''){
    			$query = "SELECT * FROM PROCEDIMENTOS WHERE NOME_ANIMAL like '%$nomedoanimal%' and NOME_TUTOR like '%".$nomedotutor."%' and STATUS_PROC = '$status' AND REQUISITOR_GAAR = '$requigaar' ORDER BY DATA DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomedoanimal == '' && $nomedotutor == '' && $status == '' && $requigaar == '' && $clinica == ''){
    			$query = "SELECT * FROM PROCEDIMENTOS ORDER BY DATA DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomedoanimal == '' && $nomedotutor == '' && $status == '' && $requigaar == '' && $clinica != ''){
    			$query = "SELECT * FROM PROCEDIMENTOS WHERE CLINICA = '$clinica' ORDER BY DATA DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomedoanimal == '' && $nomedotutor == '' && $status != '' && $requigaar == '' && $clinica != ''){
    			$query = "SELECT * FROM PROCEDIMENTOS WHERE CLINICA = '$clinica' AND STATUS_PROC = '$status' ORDER BY DATA DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
        }
		
		$queryresp = "SELECT RESPONSAVEL FROM ANIMAL WHERE NOME_ANIMAL = '$nomedoanimal' AND ESPECIE ='$especie' ORDER BY NOME ASC";
        $selectresp = mysqli_query($connect,$queryresp);
        				
        while ($fetchresp = mysqli_fetch_row($selectresp)) {
        	 $resp = $fetchresp[12];
        }
        
        if ($reccount <> '0') {
?>
        <form id='form' name='procedi' action='deletaprocedimento.php' method='POST' target='_blank'>
            <table class='table'>
            <thead class='thead-dark'>
				  <tr>
							<th scope='col' colspan='2'>&nbsp;</th>
							<th scope='col' colspan='3'>DADOS DO ANIMAL</th>
                            <th scope='col' colspan='2'>DADOS DO GAAR</th>
    			            <th scope='col' colspan='2'>DADOS DA CLÍNICA</th>
    			            <th scope='col' colspan='2'>&nbsp;</th>
    			          <tr>
			</thead> 
            <thead class='thead-light'>
						  <tr>
						    <th scope='col'>ID</th>
							<th scope='col'>Data</th>
							<th scope='col'>Animal</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Tutor</th>
<?
							if ($status !='Esperando aprovação') {
							    echo "<th scope='col'>Aprovador</th>
							    <th scope='col'>Valor</th>
    							<th scope='col'>Procedimento</th>
    							<th scope='col'>Clínica</th>
    							<th scope='col'>Status</th>
    							<th scope='col' colspan='1'>&nbsp;</th>";
							} else {
							    echo "<th scope='col'>Valor</th>
    							<th scope='col'>Procedimento</th>
    							<th scope='col'>Clínica</th>
    							<th scope='col'>Status</th>
    							<th scope='col' colspan='2'>&nbsp;</th>";
    						}
?>
					</tr>
				</thead> 
				<tbody>
<?
			while ($fetch = mysqli_fetch_row($select)) {
					$id = $fetch[0];
					$data = $fetch[1];
					$nomedoanimal = $fetch[2];
					$especie = $fetch[3];
					$sexo = $fetch[4];
					$porte = $fetch[5];
					$nomedotutor = $fetch[6];
					$requigaar = $fetch[8];
					$aprovagaar  = $fetch[9];
					$tipoproc = $fetch[10];
					$valor = $fetch[11];
					$valortutor = $fetch[12];
					$clinica = $fetch[13];
					$status = $fetch[14];
					$emaildotutor = $fetch[16];
					$qtde = $fetch[17];
					
					$ano_proc = substr($data,0,4);
        		    $mes_proc = substr($data,5,2);
        		    $dia_proc = substr($data,8,2);
?>
		    
        		    <tbody>
					<tr>
					<td><input type='checkbox' name='idprocedi[]' value="<? echo $id ?>"><?echo $id?></td>
        			<td><? echo $dia_proc ."/".$mes_proc ."/".$ano_proc ?></td>
					<td><? echo $nomedoanimal ?></td>
				    <td><? echo $especie ?></td>
				    <td><? echo $nomedotutor?></td>
<?
				    if ($status !='Esperando aprovação') {
				        echo "<td>".$aprovagaar."</td>";
				    }
?>
                    <td><? echo $valor ?></td>
				    <td><? echo $tipoproc ?></td>
				    <td><? echo $clinica ?></td>
				    <td><? echo $status ?></td>
					</tr>
				
<?
			}
			echo "	</tbody>
			    </table><br>";
			    
			if ($subarea =='diretoria' || $subarea =='financeiro'){
				        /*echo "<td colspan='2'><div class='d-print-none'><a href='formatualizaprocedi.php' class='btn btn-primary'>Atualizar</a>&nbsp;<a href='aprovaprocedimento.php' class='btn btn-primary' target='_blank'>Aprovar</a><a href='javascript:form.submit()'>Apagar</a></div></td>"; */
				        echo "<td colspan='2'><div class='d-print-none'><a href='javascript:form.submit()' class='btn btn-primary'>Apagar</a></div></td>";    
			}else {
				        echo"<td>&nbsp;</td>";    
			}
?>
  
		</form> <br>
		<p><? echo $reccount?> procedimentos encontrados <br></p>
		</center>
<?
    } else {
        echo"<p> <strong> <center> Nenhum procedimento encontrado </center> </strong></p>";
    } 
    mysqli_close($connect);
}
?>
        </form><br>
<center>
<div class="d-print-none">
<form action="enviarrelatorios.php" method="post" name="emailrelatorio">
    <div class="d-print-none">
        <center><p><strong>OBSERVAÇÕES</strong><br>
            <i>Os valores apresentados são as informações cadastradas pelos veterinários e coletadas pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail operacional@gaarcampinas.org</i></center>      
            <input type="text" id="assunto" name="assunto" value="<? echo $assunto ?>" hidden>
        <!--<textarea name="obs" cols="50" rows="20" id="obs"></textarea><br><br>-->
        <input type="text" id="mensagem" name="mensagem" value="<? echo $mensagem ?>" hidden><br><br>
        <a href="javascript:emailrelatorio.submit()" class="btn btn-primary">Enviar relatório por e-mail</a> &nbsp; <a href="javascript:window.print()" class="btn btn-primary">Download</a>
    </div>  
</form>
    <br>
    <a href="formpesquisaprocedi.php" class="btn btn-primary">Nova pesquisa</a>
	<br><br>
</div>
</center>
<div class="d-none d-print-block">
        <center><p><strong>OBSERVAÇÕES</strong><br>
                <i>Os valores apresentados são as informações cadastradas pelos veterinários e coletadas pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail operacional@gaarcampinas.org</i></center>      
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