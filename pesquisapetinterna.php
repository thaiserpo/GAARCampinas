<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");

$data_atu = date("Y-m-d");

$horaatu = date("H:i:s");

$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);

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
        $iddoanimal = $_POST['iddoanimal'];
		
		/*echo "<br>Especie: ".$especie;
		echo "<br>Nome: ".$nomeanimal;
		echo "<br>Status: ".$status;
		echo "<br>LT: ".$lt;
		echo "<br>Divulgar como: ".$divulgar;
		echo "<br>Porte: ".$porte; 
		
		*/
		
		if ($area == 'anuncios' && $sexo=='' ){
		        $query = "SELECT * FROM ANIMAL WHERE OBS2 = '$email' AND DIVULGAR_COMO ='Terceiros' ORDER BY NOME_ANIMAL ASC";    
		}else {
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt != '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND LAR_TEMPORARIO = '$lt' AND DIVULGAR_COMO = '".$divulgar."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt != '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND LAR_TEMPORARIO = '$lt' AND ADOTADO = '$status' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt != '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND LAR_TEMPORARIO = '$lt' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal != '' && $especie == '' && $status == '' && $lt != '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE NOME_ANIMAL like '%$nomeanimal%' AND LAR_TEMPORARIO = '$lt' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal != '' && $especie == '' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp !='' && $sexo=='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE NOME_ANIMAL like '%$nomeanimal%' AND RESPONSAVEL = '$resp' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal != '' && $especie == '' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE NOME_ANIMAL like '%$nomeanimal%' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt == '' && $divulgar != '' && $porte != '' && $resp=='' && $sexo=='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND PORTE = '$porte' AND DIVULGAR_COMO = '".$divulgar."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt == '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND DIVULGAR_COMO = '".$divulgar."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt == '' && $divulgar != '' && $porte != '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND PORTE = '$porte' AND DIVULGAR_COMO = '".$divulgar."' AND ADOTADO = '$status' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt == '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' AND DIVULGAR_COMO = '".$divulgar."' AND ADOTADO = '$status' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal != '' && $especie != '' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE NOME_ANIMAL like '%$nomeanimal%' and ESPECIE = '$especie' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal != '' && $especie != '' && $status == '' && $lt == '' && $divulgar == '' && $porte != '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE NOME_ANIMAL like '%$nomeanimal%' and ESPECIE = '$especie' and PORTE = '$porte' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == 'Canina' && $status == '' && $lt == '' && $divulgar == '' && $porte != '' && $resp=='' && $sexo=='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE ='$especie' and PORTE = '$porte'  ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == 'Felina' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE ='$especie' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && ($especie == 'Canina' || $especie == 'Felina') && $status == '' && $lt == '' && $divulgar != '' && $porte == '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '$especie' and DIVULGAR_COMO = '".$divulgar."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status != '' && $lt == '' && $divulgar == '' && $porte == '' && $resp==''&& $sexo=='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt != '' && $divulgar == '' && $porte == '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO like '%$lt%' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt == '' && $divulgar != '' && $porte == '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO = '".$divulgar."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt == '' && $divulgar == '' && $porte != '' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE PORTE = '".$porte."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt == '' && $divulgar == 'Terceiros' && $resp==''&& $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE (DIVULGAR_COMO = 'Terceiros' or DIVULGAR_COMO = 'Esperando aprovação') ORDER BY ID DESC";
    		}
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt == '' && $divulgar == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL ORDER BY NOME_ANIMAL ASC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp!='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE RESPONSAVEL ='$resp' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status != '' && $lt == '' && $divulgar == '' && $porte == '' && $resp!='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE RESPONSAVEL ='$resp' AND ADOTADO = '$status' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status != '' && $lt == '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' AND DIVULGAR_COMO = '$divulgar' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt == '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' AND ESPECIE = '".$especie."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt != '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' AND ESPECIE = '".$especie."' AND LAR_TEMPORARIO = '$lt' AND DIVULGAR_COMO = '$divulgar' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status != '' && $lt != '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' AND LAR_TEMPORARIO = '$lt' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt == '' && $divulgar == '' && $porte != '' && $resp=='' && $sexo=='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' AND ESPECIE = '".$especie."' AND PORTE = '".$porte."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt == '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo !='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '$status' AND ESPECIE = '".$especie."' AND DIVULGAR_COMO = '$divulgar' AND SEXO = '".$sexo."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt == '' && $divulgar != '' && $porte == '' && $resp=='' && $sexo !='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '".$especie."' AND DIVULGAR_COMO = '$divulgar' AND SEXO = '".$sexo."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt == '' && $divulgar == '' && $porte == '' && $resp=='' && $sexo !='' && $perfil_apto == ''){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '".$especie."' AND ADOTADO = '$status' AND SEXO = '".$sexo."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status == '' && $lt == '' && $divulgar == '' && $porte == '' && $resp =='' && $sexo !='' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ESPECIE = '".$especie."' AND SEXO = '".$sexo."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == 'Disponível' && $lt == '' && $divulgar == '' && $porte == '' && $resp =='' && $sexo =='' && $perfil_apto == 'Sim' ){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '".$status."' AND APTO = '".$perfil_apto."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status != '' && $lt == '' && $divulgar != '' && $porte != '' && $resp == '' && $sexo == '' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '".$status."' AND DIVULGAR_COMO = '".$divulgar."' AND PORTE = '".$porte."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal != '' && $especie != '' && $status != '' && $lt == '' && $divulgar != '' && $porte == '' && $resp == '' && $sexo == '' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '".$status."' AND DIVULGAR_COMO = '".$divulgar."' AND ESPECIE = '".$especie."' AND NOME_ANIMAL like '%$nomeanimal%' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status != '' && $lt == '' && $divulgar == '' && $porte != '' && $resp == '' && $sexo == '' && $perfil_apto != '' ){
    			$query = "SELECT * FROM ANIMAL WHERE ADOTADO = '".$status."' AND DIVULGAR_COMO = 'GAAR' AND PORTE = '".$porte."' AND APTO = '".$perfil_apto."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt == '' && $divulgar != '' && $porte == '' && $resp == '' && $sexo == '' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO = '".$divulgar."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal != '' && $especie == '' && $status == '' && $lt == '' && $divulgar != '' && $porte == '' && $resp == '' && $sexo == '' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO = '".$divulgar."' AND NOME_ANIMAL like '%$nomeanimal%' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status == '' && $lt != '' && $divulgar != '' && $porte == '' && $resp == '' && $sexo == '' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO = '$lt' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status != '' && $lt != '' && $divulgar == '' && $porte == '' && $resp == '' && $sexo == '' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO = '$lt' AND ADOTADO = '$status' ORDER BY ID DESC";
    		}

            if ($nomeanimal == '' && $especie == '' && $status == '' && $lt != '' && $divulgar == '' && $porte == '' && $resp == '' && $sexo == '' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO = '$lt' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie != '' && $status != '' && $lt != '' && $divulgar == '' && $porte == '' && $resp == '' && $sexo != '' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO = '$lt' AND ADOTADO = '$status' AND ESPECIE = '".$especie."' AND SEXO = '".$sexo."' ORDER BY ID DESC";
    		}
    		
    		if ($nomeanimal == '' && $especie == '' && $status != '' && $lt != '' && $divulgar == '' && $porte == '' && $resp == '' && $sexo != '' && $perfil_apto == '' ){
    			$query = "SELECT * FROM ANIMAL WHERE LAR_TEMPORARIO = '$lt' AND ADOTADO = '$status' AND SEXO = '".$sexo."' ORDER BY ID DESC";
    		}
    		
    		if ($iddoanimal <> "" ){
    			$query = "SELECT * FROM ANIMAL WHERE ID = '$iddoanimal' ORDER BY ID DESC";
    		}
		    
    		$queryresp = "SELECT RESPONSAVEL FROM ANIMAL WHERE NOME_ANIMAL = '$nomeanimal' AND ESPECIE ='$especie' ORDER BY RESPONSAVEL ASC";
            $selectresp = mysqli_query($connect,$queryresp);
            
            //echo "<p>Mensagem de erro queryresp: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
            				
            while ($fetchresp = mysqli_fetch_row($selectresp)) {
            	 $resp = $fetchresp[12];
            }
            
            $select = mysqli_query($connect,$query);
    		$reccount = mysqli_num_rows($select);
    		
    		//echo "<p>Mensagem de erro query: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
        			
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
					if ($sexo == 'Fêmea'){
					    $texto_adote = "Adote a ";    
					} else {
					    $texto_adote = "Adote o ";
					}
					$idade = $fetch[3];
					$porte = $fetch[6];
					$castracao = $fetch[7];
					$dtcastracao  = $fetch[8];
					$vacinacao = $fetch[9];
					$status = $fetch[10];
					$lt = $fetch[11];
					$resp = $fetch[12];
					$divcomo = $fetch[18];
					$foto = $fetch[16];
					$carteirinha_frente = $fetch[26];
					$carteirinha_verso = $fetch[27];
					
					$ano_castra = substr($dtcastracao,0,4);
        		    $mes_castra = substr($dtcastracao,5,2);
        		    $dia_castra = substr($dtcastracao,8,2);
					
					$ano_idade = substr($idade,0,4);
        		    $mes_idade = substr($idade,5,2);
        		    $dia_idade = substr($idade,8,2);
					
					/* CONVERSAO IDADE */ 
        
                     $idade_jul = gregoriantojd($mes_idade,$dia_idade,$ano_idade);
        
					/* CALCULO DE DIAS IDADE */
        
                    $dias_idade = intval($data_atu_jul) - intval($idade_jul);
        
					// Create a new DateTime object from the original date
                    $date = new DateTime($dtvacina_poli);
                    
                    // Add days to the date
                    if ($dias_idade <"120" && $doses < "3" ) {
                        $date->modify('+21 days');   
                    } elseif ($dias_idade > "120") {
                        $date->modify('+365 days'); 
                    }
                    // Format the date in the desired format (optional)
                    $dtvacina_prox = $date->format('Y-m-d');
                
                    
                    $ano_proxvacina = substr($dtvacina_prox,0,4);
                    $mes_proxvacina = substr($dtvacina_prox,5,2);
                    $dia_proxvacina = substr($dtvacina_prox,8,2);
        
                    $queryresp = "SELECT EMAIL FROM VOLUNTARIOS WHERE NOME ='$resp'";
            		$selectresp = mysqli_query($connect,$queryresp);
            			
            		while ($fetchresp = mysqli_fetch_row($selectresp)) {
            				$emailresp = $fetchresp[0];
            		}

					$querytermo = "SELECT * FROM TERMO_ADOCAO WHERE NOME_ANIMAL = '$nomedoanimal' and ESPECIE = '$especie' and 	LAR_TEMPORARIO = '$lt' and EMAIL_DOADOR = '$emailresp' ORDER BY DATA_ADOCAO DESC";
                    $selecttermo = mysqli_query($connect,$querytermo);
                    $reccounttermo = mysqli_num_rows($selecttermo);
                
                    $queryultimopost = "SELECT ID_ANIMAL,MAX(DIA_POST) FROM ANIMAIS_REDES WHERE ID_ANIMAL='$idanimal'";
                    $selectultimopost = mysqli_query($connect,$queryultimopost);
                    $reccount = mysqli_num_rows($selectultimopost);
                    $tmp = mysqli_fetch_row($selectultimopost);
                    
                    $ultimopost = $tmp[1];

                    if (($ultimopost <> '') && ($ultimopost <> '0000-00-00')) {
                        $ano_ultimopost = substr($ultimopost,0,4);
        		        $mes_ultimopost = substr($ultimopost,5,2);
        		        $dia_ultimopost = substr($ultimopost,8,2);
        		        $ultimopost_novo = $dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost;        
                    } else {
                        $ultimopost_novo = "Sem divulgação ainda";
                    }
        		    

                    echo "<center><img src='/area/imagens/line_termo.png'></center>";
                    echo "<table class='table'>";
        		    echo "<tbody>";
        		    $pet = "http://gaarcampinas.org/pet.php?id=".$idanimal."";
        		    	echo "
        			       <script type='text/javascript'>
                                //Constrói a URL depois que o DOM estiver pronto
                                document.addEventListener('DOMContentLoaded', function() {
                                    //conteúdo que será compartilhado: Título da página + URL
                                    //var conteudo = encodeURIComponent('document.title' + ' ' + window.location.href);
                                    var conteudo = encodeURIComponent('Adote o(a) ".$nomedoanimal."' + ' - ' + '".$historia." - ".$pet."');
                                    //altera a URL do botão
                                    document.getElementById('whatsapp-share-btt').href = 'https://api.whatsapp.com/send?text=' + conteudo;
                                }, false);
                                
                            </script>
        			        ";
					echo "<tr>";
					if ($foto ==''&& $sexo=='' ){
					    echo "<td align='center' valign='center' rowspan='15'>SEM FOTO</td>";
					}else{
					    echo "<td align='center' valign='center' rowspan='15'><img src='/pets/".$idanimal."/".$foto."' valign='top' align='center' width='375' height='400'/></td>";   
					}
					echo "</tr>";
					echo "<tr>";
					echo "<td align='left' scope='row'><b>Número do cadastro (ID)</b></td>";
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
        			echo "<td align='left' scope='row'><b>Porte</b></td>";
					echo "<td align='left' >: ".$porte."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Data de nascimento aproximada</b></td>";
					echo "<td align='left' >: ".$dia_idade."/".$mes_idade."/".$ano_idade."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Castração</b></td>";
					echo "<td align='left' >: ".$castracao."</td>";
					echo "</tr>";
					if ($castracao == 'Sim'){
                                
                        $queryvet = "SELECT CLINICA FROM AGENDAMENTO WHERE ID_GAAR ='$idanimal'";
                        $selectvet = mysqli_query($connect,$queryvet);
                        $rc = mysqli_fetch_row($selectvet);
                        $tmp_vet = $rc[0];
                        
                        $queryvet2 = "SELECT CLINICA FROM CLINICAS WHERE ID ='$tmp_vet'";
                        $selectvet2 = mysqli_query($connect,$queryvet2);
                        $rc2 = mysqli_fetch_row($selectvet2);
                        $vet = $rc2[0];
                                
                        echo "<tr>";
            			echo "<td align='left' scope='row'><b>Veterinário responsável pelo procedimento</b></td>";
    					echo "<td align='left' >: ".$vet."</td>";
    					echo "</tr>";
					}
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Data planejada para a castração</b></td>";
					echo "<td align='left' >: ".$dia_castra."/".$mes_castra."/".$ano_castra."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Próxima vacinação</b></td>";
					echo "<td align='left' >: ".$dia_proxvacina."/".$mes_proxvacina."/".$ano_proxvacina."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td align='left' scope='row'><b>Carteirinha armazenada? </b></td>";
        			if ($carteirinha_frente == '0' && $carteirinha_verso == '0'){
					    $carteirinha = 'Não';
					    echo "<td align='left' >: ".$carteirinha."</td>";
					} else {
					    $carteirinha = 'Sim';
					    echo "<td align='left' >: ".$carteirinha."</td>";
					    echo "<td align='left' ><a href='http://gaarcampinas.org/pets/".$idanimal."/".$carteirinha_frente."' target='_blank' >Frente </a> | <a href='http://gaarcampinas.org/pets/".$idanimal."/".$carteirinha_verso."' target='_blank' >Verso </a></td>";
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
        			echo "<td align='left' scope='row'><b>Último post nas redes sociais foi em</b></td>";
					echo "<td align='left' >: ".$ultimopost_novo."</td>";
					echo "</tr>";
					echo "<tr>";
					if ($area == 'anuncios'){
					    echo "<td align='center'>
                                  <a href='formatualizapet.php?idanimal=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Atualizar'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                          <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                        </svg>
                                  </button></a></td>";
					} else {
					    if ($subarea == 'diretoria' || $cpg=='Sim') {
					           echo "<td align='center>
    					              <a href='gradeposts.php?idanimal=".$fetch[0]."' target='_blank'>
    					                <button type='button' class='btn btn-primary' title='Agendar post'> Agendar post </button>
    					               </a> &nbsp;
                                  <a href='formatualizapet.php?idanimal=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Atualizar'>
        					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                </svg>
                                  </button></a> &nbsp;
                                  <a href='".$pet."' target='_blank'><button type='button' class='btn btn-primary' title='Abrir no site'>
        					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-globe2' viewBox='0 0 16 16'>
                                                  <path d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855-.143.268-.276.56-.395.872.705.157 1.472.257 2.282.287V1.077zM4.249 3.539c.142-.384.304-.744.481-1.078a6.7 6.7 0 0 1 .597-.933A7.01 7.01 0 0 0 3.051 3.05c.362.184.763.349 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9.124 9.124 0 0 1-1.565-.667A6.964 6.964 0 0 0 1.018 7.5h2.49zm1.4-2.741a12.344 12.344 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332zM8.5 5.09V7.5h2.99a12.342 12.342 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.612 13.612 0 0 1 7.5 10.91V8.5H4.51zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741H8.5zm-3.282 3.696c.12.312.252.604.395.872.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a6.696 6.696 0 0 1-.598-.933 8.853 8.853 0 0 1-.481-1.079 8.38 8.38 0 0 0-1.198.49 7.01 7.01 0 0 0 2.276 1.522zm-1.383-2.964A13.36 13.36 0 0 1 3.508 8.5h-2.49a6.963 6.963 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667zm6.728 2.964a7.009 7.009 0 0 0 2.275-1.521 8.376 8.376 0 0 0-1.197-.49 8.853 8.853 0 0 1-.481 1.078 6.688 6.688 0 0 1-.597.933zM8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855.143-.268.276-.56.395-.872A12.63 12.63 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.963 6.963 0 0 0 14.982 8.5h-2.49a13.36 13.36 0 0 1-.437 3.008zM14.982 7.5a6.963 6.963 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008h2.49zM11.27 2.461c.177.334.339.694.482 1.078a8.368 8.368 0 0 0 1.196-.49 7.01 7.01 0 0 0-2.275-1.52c.218.283.418.597.597.932zm-.488 1.343a7.765 7.765 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z'/>
                                               </svg>
                                  </button></a>&nbsp;
                                  <a href='' id='whatsapp-share-btt' rel='nofollow' target='_blank'><button type='button' class='btn btn-primary' title='Enviar via WhatsApp'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-whatsapp' viewBox='0 0 16 16'>
                                          <path d='M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z'/>
                                        </svg>
                                  </button></a>&nbsp;
                                  <a href='deletapet.php?idanimal=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Deletar'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                      </svg>
                                  </button></a></td>";
					    } else{ 
					           echo "<td align='center'>
					              <a href='formatualizapet.php?idanimal=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Atualizar'>
        					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                </svg>
                                  </button></a> &nbsp;
                                  <a href='".$pet."'><button type='button' class='btn btn-primary' title='Abrir no site'>
        					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-globe2' viewBox='0 0 16 16'>
                                                  <path d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855-.143.268-.276.56-.395.872.705.157 1.472.257 2.282.287V1.077zM4.249 3.539c.142-.384.304-.744.481-1.078a6.7 6.7 0 0 1 .597-.933A7.01 7.01 0 0 0 3.051 3.05c.362.184.763.349 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9.124 9.124 0 0 1-1.565-.667A6.964 6.964 0 0 0 1.018 7.5h2.49zm1.4-2.741a12.344 12.344 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332zM8.5 5.09V7.5h2.99a12.342 12.342 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.612 13.612 0 0 1 7.5 10.91V8.5H4.51zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741H8.5zm-3.282 3.696c.12.312.252.604.395.872.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a6.696 6.696 0 0 1-.598-.933 8.853 8.853 0 0 1-.481-1.079 8.38 8.38 0 0 0-1.198.49 7.01 7.01 0 0 0 2.276 1.522zm-1.383-2.964A13.36 13.36 0 0 1 3.508 8.5h-2.49a6.963 6.963 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667zm6.728 2.964a7.009 7.009 0 0 0 2.275-1.521 8.376 8.376 0 0 0-1.197-.49 8.853 8.853 0 0 1-.481 1.078 6.688 6.688 0 0 1-.597.933zM8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855.143-.268.276-.56.395-.872A12.63 12.63 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.963 6.963 0 0 0 14.982 8.5h-2.49a13.36 13.36 0 0 1-.437 3.008zM14.982 7.5a6.963 6.963 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008h2.49zM11.27 2.461c.177.334.339.694.482 1.078a8.368 8.368 0 0 0 1.196-.49 7.01 7.01 0 0 0-2.275-1.52c.218.283.418.597.597.932zm-.488 1.343a7.765 7.765 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z'/>
                                               </svg>
                                  </button></a></td>
                                  <td><a href='' id='whatsapp-share-btt' rel='nofollow' target='_blank'><button type='button' class='btn btn-primary' title='Enviar via WhatsApp'>
					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-whatsapp' viewBox='0 0 16 16'>
                                          <path d='M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z'/>
                                        </svg>
                                  </button></a></td>";
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
}
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
</html>