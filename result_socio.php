<?php 		

session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 

$login = $_SESSION['login'];
$resultsocio = $_POST['resultsocio'];
$nomedosocio = $_POST['nomedosocio'];
$emaildosocio = $_POST['emaildosocio'];
$idpet = $_POST['idpet'];
$tmp = $resultsocio;

/*if($login == "" || $login == null){
		  echo"<script language='javascript' type='text/javascript'>
		  alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{*/

$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
$selectarea = mysqli_query($connect,$queryarea);

while ($fetcharea = mysqli_fetch_row($selectarea)) {
		$area = $fetcharea[0];
}

    function boleto_sendjson($vencimento,$valor,$cpf,$nome,$email){
        
        $urlapi = 'https://ws.pagseguro.uol.com.br/recurring-payment/boletos?email=financeiro@gaarcampinas.org&token=02d20d8b-7da8-473d-8ee3-ab5ebf2ee77139322f674648953abadfe1d34196a2659026-757d-40e6-9ab8-d48b9de8fefb';
        $ch = curl_init($urlapi);
        $dadossocio = array("reference"=>"Boleto mensal", 
                            "firstDueDate"=>$vencimento, 
                            "numberOfPayments"=>01, 
                            "periodicity"=>"monthly", 
                            "amount"=>$valor, 
                            "instructions"=>"", 
                            "description"=>"Boleto mensal do GAAR", 
                            "customer"=>array(
                                "document"=>array(
                                    "type"=>"CPF", "value"=>"$cpf"), 
                            "name"=>$nome,
                            "email"=>$email,
                            "phone"=>array(
                                    "areaCode"=>"19", "number"=>"32222222"),
                            "address"=>array(
                                    "postalCode"=>"13076270", "street"=>"0", "number"=>"0", "district"=>"0", "city"=>"Campinas", "state"=>"SP"),
                                    ) );
    
        $json_str = json_encode($dadossocio);
                           
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_str);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $result = curl_exec($ch);
        //echo "result: ".$result;
        $boletoRetorno = json_decode($result,true);
        //var_dump($boletoRetorno);
        $linkpag = $boletoRetorno['boletos'][0]['paymentLink'];
        
        $ano_venc = substr($vencimento,0,4);
		$mes_venc = substr($vencimento,5,2);
		$dia_venc = substr($vencimento,8,2);
                
        curl_close($ch);
      
        //echo "<script>window.open('".$result."', '_blank');</script>";
        
        ini_set('display_errors', 1);

        error_reporting(E_ALL);
        
        $from = "financeiro@gaarcampinas.org";
		$to = $email;
		$subject = "[ GAAR Campinas ] Doação mensal - Vencimento em ".$dia_venc."-".$mes_venc."-".$ano_venc."";
		$mensagem = "<center><img src='/area/logo_transparent.png' width='70' height='70' /></center><br>
		    Olá, ".$nome." ! <br><br>
		    Segue o link do boleto de sua doação mensal com vencimento em ".$dia_venc."-".$mes_venc."-".$ano_venc." <br><br>
		    Link: ".$linkpag."<br><br><br>
		    Agradecemos sua contribuição! <br><br>
		    -- Este e-mail foi enviado automaticamente através de nosso sistema -- "; 
		
		$headers = "MIME-Version: 1.0\n";               
		$headers .= "Content-type: text/html; charset=utf-8\n";            
		$headers .= "From: <{$from}> \r\n"; 
		$message = $mensagem ;
		
		//mail($to, $subject, $message, $headers);
		
		/* NOTIFICAÇÃO PARA O FINANCEIRO */
		
		$from = "gaarcampinas@gmail.com";
		
		$to = "financeiro@gaarcampinas.org";
		
		$subject = "[GAAR Campinas] Boleto mensal enviado para ".$nome;
		
		$mensagem = "<center><img src='/area/logo_transparent.png' width='70' height='70' /></center> <br>
		
		    Olá Diretoria Financeira, <br><br>
		
		    O boleto mensal para ".$nome." foi gerado e enviado para o e-mail ".$email.". Para acompanhar o status, acesse o Pagseguro<br>
		    
		    Link do boleto: ".$linkpag."<br><br>
		    
		    - Este e-mail foi enviado automaticamente de nosso sistema - "; 
		
		$headers = "MIME-Version: 1.0\n";               
		$headers .= "Content-type: text/html; charset=utf-8\n";            
		$headers .= "From: <{$from}> \r\n"; 
		$message = $mensagem ;
		
		//mail($to, $subject, $message, $headers);
        
        echo "<br><br>link pagamento: ".$linkpag;
    }
    
    if (isset($_GET['boleto'])) {
       boleto_sendjson($_GET['vencimento'],$_GET['valor'],$_GET['cpf'],$_GET['nome'],$_GET['email']);
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
    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Sócios contribuintes</title>
    
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
         <CENTER>
	        <h3>SÓCIOS CONTRIBUINTES</h3>
         </CENTER>
<?

        if ($resultsocio != '0'){
                $query = "SELECT * FROM SOCIO WHERE FORMA_AJUDAR = '$resultsocio' ORDER BY ID DESC";
        } elseif ($nomedosocio != ''){
                $query = "SELECT * FROM SOCIO WHERE NOME LIKE '%".$nomedosocio."%' ORDER BY ID DESC";
        } elseif ($emaildosocio != ''){
                $query = "SELECT * FROM SOCIO WHERE EMAIL = '$emaildosocio' ORDER BY ID DESC";
        } elseif ($idpet == 'Todos') {
                $query = "SELECT * FROM SOCIO WHERE ID_ANIMAL <> 0 AND APADRINHAMENTO='Sim' ORDER BY ID DESC";
        } elseif ($idpet != '0') {
                $query = "SELECT * FROM SOCIO WHERE ID_ANIMAL = '$idpet' ORDER BY ID DESC";
        } else {
            $query = "SELECT * FROM SOCIO ORDER BY ID DESC";
        }

            $select = mysqli_query($connect,$query);
            $reccount = mysqli_num_rows($select);

		if ($reccount != '0') {
		    echo "<table class='table'>";
            echo "<thead class='thead-light'>";
        	echo "<th scope='col'>Nome</th>";
        	echo "<th scope='col'>E-mail</th>";
        	echo "<th scope='col'>Valor</th>";
        	echo "<th scope='col'>Forma de ajudar</th>";
        	echo "<th scope='col'>Melhor dia</th>";
        	echo "<th scope='col'>Lembrete?</th>";
        	echo "<th scope='col'>Frequência</th>";
        	echo "<th scope='col'>Apadrinhado</th>";
        	echo "<th scope='col' colspan='2'>&nbsp;</th>";
        	echo "</thead>";
        	echo "<tbody>";
			while ($fetch = mysqli_fetch_row($select)) {
					$id = $fetch[0];	
					$nome = $fetch[1];
					$email = $fetch[4];
					$valor = $fetch[5];
					$forma  = $fetch[6];
					$melhordia = $fetch[7];
					$lembrete = $fetch[8];
					$frequencia = $fetch[13];
					$cpf =  $fetch[14];
					$id_animal =  $fetch[16];
					
					$ano = date('Y');
					$mes = date('m');
					$mes_atu = date('m',strtotime('+1 months'));
					/*$tmp = str_pad($mes_atu, 2, "", STR_PAD_LEFT);*/
					/*$mes = $mes_atu ;*/
					
					if ($mes == '13'){
					    $mes = '01';
					    $ano = $ano + 1;
					}
					$vencimento = $ano ."-".$mes."-".$melhordia;
					
					$querypet = "SELECT NOME_ANIMAL FROM ANIMAL WHERE ID = '$id_animal'";
					$resultpet = mysqli_query($connect,$querypet);
					$rc = mysqli_fetch_row($resultpet);
			        $nome_animal = $rc[0];

        			echo "<tr>";
        			echo "<td>".$nome."</td>";
        			echo "<td>".$email."</td>";
        			echo "<td>R$ ".number_format($valor, 2, ',', '.')."</td>";
        			echo "<td>".$forma."</td>";
					echo "<td>".$melhordia."</td>";
					echo "<td>".$lembrete."</td>";
					echo "<td>".$frequencia."</td>";
					echo "<td><a href='https://www.gaarcampinas.org/pet.php?id=".$id_animal."' target='_blank'>".$nome_animal."</a></td>";
					echo "<td><a href='formatualizasocio.php?id=".$id."' class='btn btn-primary'>Atualizar</td>";
					if ($forma == 'Boleto'){
					    echo "<td><a href='emailsocio.php?email=".$email."' class='btn btn-primary'>Gerar boleto</button></td>";    
					} else {
					    echo "<td>&nbsp;</td>";    
					}
					if ($area == 'diretoria'){
					    echo "<td><a href='deletasocio.php?idsocio=".$id."' class='btn btn-primary'>Deletar</a>&nbsp;</td>";   
					} else{
					    echo "<td>&nbsp;</td>";
					}
					echo "</tr>";
			}	
			       	echo "</tbody>";
					echo "</table>";
					echo "<p>".$reccount." sócios encontrados</p>";
		} else {
		    echo "Nenhum registro encontrado";
		}
?>
<br>

    <center><a href="pesquisarsocio.php" class="btn btn-primary">Voltar</font></a>
    </center>
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
</html>