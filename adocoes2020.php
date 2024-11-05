<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null&& $sexo=='' ){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
				$email = $fetcharea[2];
				$cpg = $fetcharea[7];
		}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Meta tags Obrigatórias -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/lc_lightbox.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <title>GAAR - Pesquisa interna de animais</title>
    
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
				  case 'anuncios':
				  	include_once("menu_terceiros.php") ;
					break;
				  
			  }
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
        <center>
        <p>Os dados foram consultados da tabela de animais. <br>
           Caso o animal não tenha sido encontrado, por favor acesse o cadastro de animais <a href='formcadastropet.php'>aqui</a><br>
		</p>
		</center>
        
<?
		
		$nomeanimal = strtoupper($_POST['nomedoanimal']);
		$especie = $_POST['especie'];
		$status = $_POST['status'];
		$lt = strtoupper($_POST['lt']);
		$porte = $_POST['porte'];
		$sexo = $_POST['sexo'];
		$divulgar = $_POST['divulgar'];
		$resp = $_POST['resp'];
		$perfil_outrosanimais = $_POST['outrosanimais'];
        $perfil_criancas = $_POST['criancas'];
        $perfil_apto = $_POST['apto'];
		
		/*echo "Especie: ".$especie;
		echo "Nome: ".$nomeanimal;
		echo "Status: ".$status;
		echo "LT: ".$lt;
		echo "Divulgar como: ".$divulgar;*/
		
		if ($area == 'anuncios' && $sexo=='' ){
		        $query = "SELECT * FROM ANIMAL WHERE OBS2 = '$email' AND DIVULGAR_COMO ='Terceiros' ORDER BY NOME_ANIMAL ASC";    
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
		}else {
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt != '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND LAR_TEMPORARIO = '$lt' AND DIVULGAR_COMO = '".$divulgar."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt != '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND LAR_TEMPORARIO = '$lt' AND ADOTADO = '$status' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt != '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND LAR_TEMPORARIO = '$lt' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal != '' && $especie == '' && $status == '' && $lt != '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE NOME_ANIMAL like '%$nomeanimal%' AND LAR_TEMPORARIO = '$lt' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal != '' && $especie == '' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp !='' && $sexo=='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE NOME_ANIMAL like '%$nomeanimal%' AND RESPONSAVEL = '$resp' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    		}
    		
    		if ($nomeanimal != '' && $especie == '' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE NOME_ANIMAL like '%$nomeanimal%' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt == '' && $divulgar != '' && $porte != '' && $resp=='' && $sexo=='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND PORTE = '$porte' AND DIVULGAR_COMO = '".$divulgar."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt == '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND DIVULGAR_COMO = '".$divulgar."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt == '' && $divulgar != '' && $porte != '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND PORTE = '$porte' AND DIVULGAR_COMO = '".$divulgar."' AND ADOTADO = '$status' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt == '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND DIVULGAR_COMO = '".$divulgar."' AND ADOTADO = '$status' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal != '' && $especie != '' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE NOME_ANIMAL like '%$nomeanimal%' and ESPECIE = '$especie' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal != '' && $especie != '' && $status == '' && $lt == '' && $divulgar == '' && $porte != '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE NOME_ANIMAL like '%$nomeanimal%' and ESPECIE = '$especie' and PORTE = '$porte' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie == 'Canina' && $status == '' && $lt == '' && $divulgar == '' && $porte != '' && $resp=='' && $sexo=='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE ='$especie' and PORTE = '$porte'  ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie == 'Felina' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE ='$especie' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && ($especie == 'Canina' || $especie == 'Felina') && $status == '' && $lt == '' && $divulgar != '' && $porte == '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' and DIVULGAR_COMO = '".$divulgar."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status != '' && $lt == '' && $divulgar == '' && $porte == '' && $resp==''&& $sexo=='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt != '' && $divulgar == '' && $porte == '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO like '%$lt%' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt == '' && $divulgar != '' && $porte == '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO = '".$divulgar."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt == '' && $divulgar == '' && $porte != '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE PORTE = '".$porte."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt == '' && $divulgar == 'Terceiros' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE (DIVULGAR_COMO = 'Terceiros' or DIVULGAR_COMO = 'Esperando aprovação') ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt == '' && $divulgar == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL ORDER BY NOME_ANIMAL ASC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp!='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE RESPONSAVEL ='$resp' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status != '' && $lt == '' && $divulgar == '' && $porte == '' && $resp!='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE RESPONSAVEL ='$resp' AND ADOTADO = '$status' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status != '' && $lt == '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' AND DIVULGAR_COMO = '$divulgar' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt == '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' AND ESPECIE = '".$especie."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt != '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' AND ESPECIE = '".$especie."' AND LAR_TEMPORARIO = '$lt' AND DIVULGAR_COMO = '$divulgar' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status != '' && $lt != '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' AND LAR_TEMPORARIO = '$lt' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt == '' && $divulgar == '' && $porte != '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' AND ESPECIE = '".$especie."' AND PORTE = '".$porte."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt == '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo !='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' AND ESPECIE = '".$especie."' AND DIVULGAR_COMO = '$divulgar' AND SEXO = '".$sexo."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt == '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo !='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '".$especie."' AND DIVULGAR_COMO = '$divulgar' AND SEXO = '".$sexo."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt == '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo !='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '".$especie."' AND ADOTADO = '$status' AND SEXO = '".$sexo."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp =='' && $sexo !='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '".$especie."' AND SEXO = '".$sexo."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == 'Disponível' && $lt == '' && $divulgar == 'GAAR' && $porte == '' && $resp =='' && $sexo =='' && $perfil_apto == 'Sim' ){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '".$status."' AND APTO = '".$perfil_apto."' ORDER BY ID DESC";
    			$select = mysqli_query($connect,$query);
    			$reccount = mysqli_num_rows($select);
    		}
		
    		$queryresp = "SELECT RESPONSAVEL FROM ANIMAL WHERE NOME_ANIMAL = '$nomeanimal' AND ESPECIE ='$especie' ORDER BY NOME ASC";
            $selectresp = mysqli_query($connect,$queryresp);
            				
            while ($fetchresp = mysqli_fetch_row($selectresp)) {
            	 $resp = $fetchresp[12];
            }
        			
		}
		
		if ($reccount == 0) {
			echo "
			<center><p>Nenhum animal encontrado</p> <br></center>
			";
		}else{ 
			echo "<form id='form' name='cadastratermo' action='#' method='GET' target='_blank'>";
			while ($fetch = mysqli_fetch_row($select)) {
					$idanimal = $fetch[0];	
					$nomedoanimal = $fetch[1];
					$especie = $fetch[2];
					$sexo = $fetch[4];
					$castracao = $fetch[7];
					$dtcastracao  = $fetch[8];
					$vacinacao = $fetch[9];
					$status = $fetch[10];
					$lt = $fetch[11];
					$resp = $fetch[12];
					$divcomo = $fetch[18];
					$foto = $fetch[16];
					$pet = "http://gaarcampinas.org/pet.php?id=".$idanimal."";
					$carteirinha_frente = $fetch[26];
					$carteirinha_verso = $fetch[27];
					
					$ano_castra = substr($dtcastracao,0,4);
        		    $mes_castra = substr($dtcastracao,5,2);
        		    $dia_castra = substr($dtcastracao,8,2);
					
                    $queryresp = "SELECT EMAIL FROM VOLUNTARIOS WHERE NOME ='$resp'";
            		$selectresp = mysqli_query($connect,$queryresp);
            			
            		while ($fetchresp = mysqli_fetch_row($selectresp)) {
            				$emailresp = $fetchresp[0];
            		}

					$querytermo = "SELECT * FROM TERMO_ADOCAO WHERE NOME_ANIMAL = '$nomedoanimal' and ESPECIE = '$especie' and 	LAR_TEMPORARIO = '$lt' and EMAIL_DOADOR = '$emailresp' ORDER BY DATA_ADOCAO DESC";
                    $selecttermo = mysqli_query($connect,$querytermo);
                    $reccounttermo = mysqli_num_rows($selecttermo);

                    echo "<center><img src='/area/imagens/line_termo.png'></center>";
                    echo "<table class='table'>";
        		    echo "<tbody>";
        		    	echo "
        			       <script type='text/javascript'>
                                //Constrói a URL depois que o DOM estiver pronto
                                document.addEventListener('DOMContentLoaded', function() {
                                    //conteúdo que será compartilhado: Título da página + URL
                                    //var conteudo = encodeURIComponent('document.title' + ' ' + window.location.href);
                                    var conteudo = encodeURIComponent(document.title + ' ' + '".$pet."'+ ' - ' + 'Adote o(a) ".$nome."' + ' - ' + '".$historia."');
                                    //altera a URL do botão
                                    document.getElementById('whatsapp-share-btt').href = 'https://api.whatsapp.com/send?text=' + conteudo;
                                }, false);
                                
                            </script>
        			        ";
					echo "<tr>";
					if ($foto ==''&& $sexo=='' ){
					    echo "<td align='center' valign='middle' rowspan='12'>SEM FOTO</td>";
					}else{
					    echo "<td align='center' valign='middle' rowspan='12'><img src='/pets/".$foto."' valign='top' align='center' width='375' height='400'/></td>";   
					}
					echo "<td align='left' scope='row'><b>Número do cadastro</b></td>";
					echo "<td align='left' >: ".$idanimal."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Nome do animal</b></td>";
					echo "<td align='left' >: ".$nomedoanimal."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Espécie</b></td>";
					echo "<td align='left' >: ".$especie."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Sexo</b></td>";
					echo "<td align='left' >: ".$sexo."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Status da castração</b></td>";
					echo "<td align='left' >: ".$castracao."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Data da castração</b></td>";
					echo "<td align='left' >: ".$dia_castra."/".$mes_castra."/".$ano_castra."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Status da vacinação</b></td>";
					echo "<td align='left' >: ".$vacinacao."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Carteirinha armazenada? </b></td>";
        			if (($carteirinha_frente == '') && $carteirinha_verso == ''&& $sexo=='' ){
					    $carteirinha = 'Não';
					    echo "<td align='left' >: ".$carteirinha."</td>";
					} else {
					    $carteirinha = 'Sim';
					    echo "<td align='left' >: ".$carteirinha."</td>";
					    echo "<td align='left' ><a href='http://gaarcampinas.org/docs/carteirinhas/".$carteirinha_frente."' target='_blank' >Frente </a> | <a href='http://gaarcampinas.org/docs/carteirinhas/".$carteirinha_verso."' target='_blank' >Verso </a></td>";
					}
					
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Responsável</b></td>";
					echo "<td align='left' >: ".$resp."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Lar temporário de</b></td>";
					echo "<td align='left' >: ".$lt."</td>";
					echo "</tr>";
                    echo "<tr>";
        			echo "<td align='left' scope='row'><b>Status</b></td>";
					echo "<td align='left' >: ".$status."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Divulgar como</b></td>";
					echo "<td align='left' >: ".$divcomo."</td>";
					echo "</tr>";
					echo "<tr>";
					if ($area == 'anuncios'){
					    echo "<td align='center' colspan='4'><a href='formatualizapet.php?idanimal=".$fetch[0]."' class='btn btn-primary'>Atualizar</a>&nbsp;<a href='".$pet."' class='btn btn-primary' target='_blank'>Abrir no site</a>&nbsp;<a href='' id='whatsapp-share-btt' rel='nofollow' target='_blank' class='btn btn-primary'>Enviar via WhatsApp</a> <br></td>";
					} else {
					    if ($subarea == 'diretoria' || $cpg='Sim') {
					           echo "<td align='center' colspan='4'><a href='formatualizapet.php?idanimal=".$fetch[0]."' class='btn btn-primary'>Atualizar</a>&nbsp;<a href='".$pet."' class='btn btn-primary' target='_blank'>Abrir no site</a>&nbsp;<a href='' id='whatsapp-share-btt' rel='nofollow' target='_blank' class='btn btn-primary'>Enviar via WhatsApp</a> &nbsp; <a href='deletapet.php?idanimal=".$fetch[0]."' class='btn btn-primary'>Deletar</a><br></td>";    
					    } else{ 
					           echo "<td align='center' colspan='4'><a href='".$pet."' class='btn btn-primary' target='_blank'>Abrir no site</a>&nbsp;<a href='' id='whatsapp-share-btt' rel='nofollow' target='_blank' class='btn btn-primary'>Enviar via WhatsApp</a> &nbsp; <br></td>";    
    					}
					}
					echo "</tr>";
					echo "</tbody>";
				    echo "</table><br><br>";

					if ($status == 'Adotado') {
        			        if ($reccounttermo != '0'){
                                echo "<center><p>Encontramos esses termos de adoção para ".$nomedoanimal."<br></p></center>
                                    	   <div class='form-group row'>";
                                    	    echo "<table class='table'>";
                                            echo "<thead class='thead-light'>";
                                        	echo "<th scope='col'>Termo</th>";
                                        	echo "<th scope='col'>Adotante</th>";
                                        	echo "<th scope='col'>Data da adoção</th>";
                                        	echo "</thead>";
                                        	echo "<tbody>";
                                    	            while ($fetchtermo = mysqli_fetch_row($selecttermo)) {
                                                          $idtermo = $fetchtermo[0];
                                                          $adotante = $fetchtermo[1];
                                                          $dtadocao = $fetchtermo[32];
                                                          
                                                          $ano_adocao = substr($dtadocao,0,4);
                                                		  $mes_adocao = substr($dtadocao,5,2);
                                                		  $dia_adocao = substr($dtadocao,8,2);
		    
                                                          echo "<tr>";
                                                		  echo "<td>".$idtermo."</td>";
                                        				  echo "<td>".$adotante."</td>";
                                        				  echo "<td>".$dia_adocao."/".$mes_adocao."/".$ano_adocao."</td>";
                                        			      echo "</tr>";
                                    	            }
                                    	   echo "</tbody>";
                                    	   echo "</table>";
                                    	   echo "</div>";
                                    	   echo "<center><p>Esse animal já foi adotado. Gostaria de cadastrar um novo termo?<br></p>
                                    	            <center><a href='formtermo.php?idanimal=".$idanimal."' class='btn btn-primary'>Sim</a></p></center><br><br>";
                                
                            }
                            else {
        			           echo "<center><p>Esse animal consta como Adotado mas não foi encontrado nenhum termo. Gostaria de cadastrar?<br></p>
        			                   <a href='formtermo.php?idanimal=".$idanimal."' class='btn btn-primary'>Sim, desejo cadastrar o termo</a></p></center><br><br>";
        			       } 
        			       }
					
				
			}   

			        echo "</form>";
			        
		mysqli_data_seek($select, 0 );
		echo "</center>";
		echo "<center>".$reccount." animais encontrados <br></center>";
		/*echo "<form action='formatualizapet.php' method='post' name='atualizapet'>
				<table width='400' border='0' class='texto'>
				<tr>
				<td align='left'>Escolha o animal para atualizar: </td>
			  	<td align='right'><select name='idanimal' class='box'>";
				while ($fetch = mysqli_fetch_row($select)) {
					echo "<option value='".$fetch[0]."' id='".$fetch[0]."'>".$fetch[1]."							
						</option>";
				}
				echo "</select></td>
				</tr>
				</table><br><br>
				<input type='submit' value='Atualizar' id='atualizar' name='atualizar' class='texto'>
				</form>
				<br>
			<a href='formpesquisapetinterna.php'><font face='Verdana, Arial, Helvetica, sans-serif'>Voltar</font></a>
			</center>";*/
		echo "</div>";
		}
		
		mysqli_close($connect);
?>
    <center><a href="formpesquisapetinterna.php" class="btn btn-primary">Voltar</a></center>
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
<script src="lib/AlloyFinger/alloy_finger.min.js"></script>
<script src="js/lc_lighbox.lite.min.js"></script>
<!--- BOOTSTRAP --->
</body>
<? 
 }
?>