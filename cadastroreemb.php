<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
    
        $queryarea = "SELECT EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$email = $fetcharea[0];
		}
		
		function porcentagem_xn ( $porcentagem, $total ) {
        	return ( $porcentagem / 100 ) * $total;
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
    
    <title>GAAR - Cadastro de lançamentos</title>
    
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
?>
<main role="main" class="container">
    <div class="starter-template">
        <br>
<?
$dtlanc = $_POST['dtlanci'];
$socio = $_POST['socio'];
$vet = $_POST['vet'];
$lt = $_POST['lt'];
$desc = $_POST['desc'];
$subtipo = $_POST['subtipo'];
$banco= $_POST['banco'];
$valor = $_POST['valor'];
$novovalor = $_POST['novovalor'];
$tipo_reemb = $_POST['reembolso'];
$parcelamento = $_POST['parcelamento'];
$idsocio = $_POST['valorsocio'];
$valorcont = $_POST['valorcont'];
$compr_compra = $_FILES['compr_compra']['name'];
$uploaddir = '/home/gaarca06/public_html/docs/financeiro/';
$uploadfile = $uploaddir.($_FILES['compr_compra']['name']);
$obs = $_POST['desc'];

$querysocio = "SELECT * FROM SOCIO WHERE ID='$idsocio'";
$selectsocio = mysqli_query($connect,$querysocio);

while ($fetch = mysqli_fetch_row($selectsocio)) {
		$id = $fetch[0];	
		$nomesocio = $fetch[1];
		$agencia = $fetch[10];
		$conta = $fetch[11];
		$valorsocio = $fetch[5];
		$bancosocio = $fetch[9];
		$forma_ajudar = $fetch[6];
}

        switch ($subtipo){
            case 'Lar temporário':
            case 'Ração':
            case 'Veterinário':
            case 'Taxi dog':
            case 'Medicamentos':
            case 'Compras':
            case 'Impostos':
            case '"Outros-despesas':
                $tipo = "Despesa";
                break;
                
            case 'Sócio':  
                $desc = "Doação - ".$nomesocio;
                $obs = "Doação - ".$nomesocio;
                $tipo = "Receita";
                $parcelamento =  "1";
                $tipo_reemb = "Sem reembolso";
                if ($forma_ajudar == 'Boleto' && $bancosocio =='Pag Seguro'){
                    $valor = $valorsocio - (porcentagem_xn(3.99, $valorsocio) + 0.40);
                } else {
                    $valor = $valorsocio;
                }
                break; 
                
            case 'Doações':
            case 'Saldoemconta':
                $tipo = "Receita";
                $parcelamento =  "1";
                $tipo_reemb = "Sem reembolso";
                break; 
                
            case 'Bazar': 
            case 'Rifas': 
            case 'NFP': 
            case 'Vendas': 
            case 'Taxas': 
            case 'Juros':
            case 'Outros-receitas':
            case 'Saldo em conta':
                $tipo = "Receita";
                break;
        }
        
        /*echo "<br> forma: ".$forma_ajudar;
        echo "<br>banco: ".$bancosocio;
        echo "<br> valor socio: ".$valor;*/

	    if ($valorcont == ''){
	        $valorcont = $valor;
	        if ($tipo=='NFP'){
	            $valor = floatval($valor) / 2 ;   
	        }
	    }
	    
	    if ($dtlanc == '' ) {
	          echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
              echo "<p>Data de lançamento inválida ou em branco</p><br>";
              echo "<a href='formcadastroreemb.php' class='btn btn-primary'>Voltar</a></center><br>";
	    } else {
	        if ($compr_compra != '' && $tipo != 'Receita'){ 
                    if($_FILES['compr_compra']['size']>1000000){
                        echo"<script language='javascript' type='text/javascript'>
                        alert('Tamanho máximo do arquivo da foto 1 deve ser 1MB');
            		    window.location.href='formcadastroreemb.php'</script>";
                    } else {
                        $query = "INSERT INTO FINANCEIRO
                					(DATA_LANC, 
                				    DESCRICAO_LANC, 
                					SUBTIPO_LANC, 
                					VALOR_LANC, 
                					BANCO_LANC,
                					VALOR_REL_CONTABIL,
                					USUARIO,
                					PARCELAMENTO,
                					TIPO_REEMB,
                					COMPROVANTE_COMPRA,
                					COMPROVANTE_REEMB,
                					OBS,
                					TIPO_LANC) 
                					VALUES
                                ('$dtlanc',
                                '$desc',
                                '$subtipo',
                                '$valor',
                                '$banco',
                                '$valorcont',
                                '$login',
                                '$parcelamento',
                                '$tipo_reemb',
                                '$compr_compra',
                                '0',
                                '$obs',
                                '$tipo'
                                )";
                						
                        $insert = mysqli_query($connect,$query); 
                    
                        if (mysqli_errno($connect) == '0'){
                                    move_uploaded_file($_FILES['compr_compra']['tmp_name'], $uploadfile) ;
                                
                                    $querydoc = "INSERT INTO DOCUMENTACAO
                            					(EVENTO, 
                            					ENDERECO, 
                            					DATA, 
                            					DESCRICAO, 
                            					VOLUNTARIOS_PRESENTES, 
                            					FILE,
                            					AREA_PRINCIPAL,
                            					USUARIO) 
                            					VALUES
                                                ('',
                                                '',
                                                '$dtlanc',
                                                '$desc',
                                                '',
                                                '$compr_compra', 
                                                'Financeiro',
                                                '$login')";
                            						
                                    $insertdoc = mysqli_query($connect,$querydoc); 	
                                    
                                    /*echo "<br>sql error insert doc: ".mysqli_errno($connect);*/
                                    
                                    if (mysqli_errno($connect) == '0'){
                                        
                                        ini_set('display_errors', 1);
        
                                        error_reporting(E_ALL);
                                        
                                        $from = "financeiro@gaarcampinas.org";
                                        
                                        $headers = "MIME-Version: 1.0\n";               
                                		$headers .= "Content-type: text/html; charset=utf-8\n";            
                                		$headers .= "From: <{$from}> \r\n";
                                		$headers .= "Reply-To: <{$from}> \r\n"; 
                                        
                                        $to = $email;
                                		
                                		$subject = "[GAAR Campinas] Comprovante enviado com sucesso!";
                                		
                                		$message = "Olá, <br><br> Seu comprovante foi enviado com sucesso ao nosso banco de dados. Caso haja reembolso, será realizado no prazo solicitado. <br><br> Link do comprovante: <a href='http://www.gaarcampinas.org/docs/financeiro/".$compr_compra."' target='blank'>Download</a>. <br><br> Atenciosamente, <br>Equipe GAAR";
                                		
                                		mail($to, $subject, $message, $headers);
                                        
                                		/*	echo "Insert code: ".$insert;
                                			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
                                          echo"<script language='javascript' type='text/javascript'>
                                          alert('Lançamento cadastrado com sucesso!');
                                		  window.location.href='formcadastroreemb.php'</script>";
                        	        }else{ 
                                		  echo "<center><h3>Oooops! Algo deu errado ao cadastrar o comprovante...</h3><br>";
                                          echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                                          echo "<a href='formcadastroreemb.php' class='btn btn-primary'>Voltar</a></center><br>";
                                          /*echo"<script language='javascript' type='text/javascript'>
                                          alert('Erro ao cadastrar');window.location
                                          .href='termo.php'</script>";*/
                                }
                                }
                    } 
            } else{ 
                $query = "INSERT INTO FINANCEIRO
                					(DATA_LANC, 
                				    DESCRICAO_LANC, 
                					SUBTIPO_LANC, 
                					VALOR_LANC, 
                					BANCO_LANC,
                					VALOR_REL_CONTABIL,
                					USUARIO,
                					PARCELAMENTO,
                					TIPO_REEMB,
                					COMPROVANTE_COMPRA,
                					COMPROVANTE_REEMB,
                					OBS,
                					TIPO_LANC) 
                					VALUES
                                ('$dtlanc',
                                '$desc',
                                '$subtipo',
                                '$valor',
                                '$banco',
                                '$valorcont',
                                '$login',
                                '$parcelamento',
                                '$tipo_reemb',
                                '0',
                                '0',
                                '$obs',
                                '$tipo'
                                )";
                						
                        $insert = mysqli_query($connect,$query); 
                    
                        if (mysqli_errno($connect) == '0'){
                    		  echo"<script language='javascript' type='text/javascript'>
                              alert('Lançamento sem comprovante cadastrado com sucesso!');
                    		  window.location.href='formcadastroreemb.php'</script>";
                        }
                }
        }
}
?>

