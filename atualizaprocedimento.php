<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

$id = $_POST['id'];
$data = $_POST['dtcirurgia'];
$nomedoanimal = $_POST['nomedoanimal'];
$especie = $_POST['especie'];
$sexo = $_POST['sexo'];
$porte = $_POST['porte'];
$nomedotutor = $_POST['nomedotutor'];
$teldotutor = $_POST['teldotutor'];
$volgaar = $_POST['requigaar'];
$tipoprocedi = $_POST['tipoproc'];
$valorgaar = $_POST['valor'];
$valortutor = $_POST['valortutor'];
$clinica = $_POST['clinica'];
$obs = $_POST['obs'];
$emaildotutor = $_POST['emaildotutor'];
$qtde = $_POST['qtde'];
$codprocedi = $_POST['codprocedi'];
$jarealizado = $_POST['jarealizado'];

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
    
    <title>GAAR - Atualização de procedimentos</title>
    
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
				  	include_once("menu_clinica.php") ;
					break;
				  case 'veterinario':
				  	include_once("menu_veterinario.php") ;
					break;
				  case 'lt':
				  	include_once("menu_lt.php") ;
					break;
			  }

        if (isset($_POST['jarealizado'])) {
            $jarealizado ="SIM";
        } else {
            $jarealizado = "NÃO";
        }
        
        if ($especie =='Felina') {
            $especie ='N/A';
        }
        
        if ($teldotutor =='') {
            $teldotutor ='0';
        }
        
        if ($emaildotutor =='') {
            $emaildotutor ='0';
        }
        
	    /*$query = "UPDATE PROCEDIMENTOS
					SET 
					DATA = '$data',
					NOME_ANIMAL= '$nomedoanimal',
					ESPECIE= '$especie',
					SEXO= '$sexo',
					PORTE= '$porte',
					NOME_TUTOR= '$nomedotutor',
					TEL_TUTOR= '$teldotutor',
					REQUISITOR_GAAR= '$volgaar',
                    TIPO_PROC= '$tipoprocedi',
                    VALOR= '$valor',
                    VALOR_TUTOR= '$valortutor',
                    CLINICA= '$clinica',
                    OBS= '$obs',
                    EMAIL_TUTOR= '$emaildotutor',
                    QTDE= '$qtde',
                    STATUS_PROC ='$jarealizado'
					WHERE 
					ID = '$id'";*/
					
		$query = "INSERT INTO PROCEDIMENTOS
    					(DATA,
    					NOME_ANIMAL,
    					ESPECIE, 
    					SEXO, 
    					PORTE,
    	                NOME_TUTOR,
    	                TEL_TUTOR,
    	                REQUISITOR_GAAR,
    					APROVADOR_GAAR,
    					TIPO_PROC, 
    					VALOR, 
    					VALOR_TUTOR,
    					CLINICA, 
    					OBS,
    					STATUS_PROC,
    					EMAIL_TUTOR,
    					QTDE,
    					DESCONTO,
    					LOGIN,
    					CODIGO,
    					DTNASC_ANIMAL) 
    					VALUES
                ('$data',
                '$nomedoanimal',
                '$especie',
                '$sexo',
                '$porte',
                '$nomedotutor',
                '$teldotutor',
                '$volgaar',
                '$volgaar',
                '$tipoprocedi',
                '$valorgaar',
                '$valortutor',
                '$clinica',
                '$obs',
                'Aprovado',
                '$emaildotutor',
                '$qtde',
                '$desconto',
                '$login',
                '$codprocedi',
                '$dtnascanimal')";
    	
    	$insert = mysqli_query($connect,$query); 
					 				
        $queryvol = "SELECT * FROM VOLUNTARIOS WHERE NOME = '$volgaar'";
		$selectvol = mysqli_query($connect,$queryvol);
		
		while ($fetchvol = mysqli_fetch_row($selectvol)) {
		    $emailvol = $fetchvol[4];
		    $nome = $fetchvol[2];
		   
		}
 
        if(mysqli_errno($connect) == '0'){
            
                $query_agenda = "UPDATE AGENDAMENTO
                                    SET REALIZADO='SIM'
                                    WHERE CODIGO='$codprocedi'";
                                    
                $update_agenda = mysqli_query($connect,$query_agenda);
                
                /*echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
                
                echo"<script language='javascript' type='text/javascript'>
                        javascript:window.history.go(-2)</script>";*/

                ini_set('display_errors', 1);
        
        		error_reporting(E_ALL);
        		
        		$from ="contato@gaarcampinas.org";
        		
        		$to = "operacional@gaarcampinas.org";
        		
        		$subject = "Procedimento número ".$id." foi atualizado por ".$clinica."";
        		
        		$headers = "MIME-Version: 1.0\n";               
        		$headers .= "Content-type: text/html; charset=utf-8\n";            
        		$headers .= "From: <{$from}> \r\n"; 
        		$message = "Olá Diretoria Operacional, <br><br>
        		
        		            <p> Houve alguma correção de informação para o procedimento número ".$id.". <br><br>
        		            
        		            
        		            <B>DADOS DO PROCEDIMENTO</B> <br><br>
                                    
                                    <table>
                                    <tr>
                                        <td align='left'>Nome do animal </td>
                                        <td align='left'>: ".$nomedoanimal."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Espécie </td>
                                        <td align='left'>: ".$especie."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Sexo </td>
                                        <td align='left'>: ".$sexo."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Porte </td>
                                        <td align='left'>: ".$porte."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Nome do tutor </td>
                                        <td align='left'>: ".$nomedotutor."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Procedimento</td>
                                        <td align='left'>: ".$tipoprocedi."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Quantidade</td>
                                        <td align='left'>: ".$qtde."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Valor pago pelo tutor ou responsável</td>
                                        <td align='left'>: R$ ".number_format($valortutor,2,',', '.')."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Valor a ser cobrado do GAAR</td>
                                        <td align='left'>: R$ ".number_format($valorgaar,2,',', '.')."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Data</td>
                                        <td align='left'>: ".$data."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Clínica ou vet</td>
                                        <td align='left'>: ".$clinica."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Observações</td>
                                        <td align='left'>: ".$obs."</td>
                                    </tr>
                                    </table>
                                    
                                    <br>
                                    
                    
        		            Para consultar todos os procedimentos, acesse:<br>
        		            
        		            1. <a href='http://gaarcampinas.org/area/login.html' target=_blank> Área restrita</a><br>
        		            2. Menu Operacional<br>
        		            3. Menu Pesquisar procedimentos<br><br>
        		            
        		            * Esta notificação foi gerada automaticamente através do sistema *</p>";
        		
        		//mail($to, $subject, $message, $headers);

        		/* CÓPIA PARA A CLINICA */
                
                $from ="operacional@gaarcampinas.org";
        		
        		$to = $emailvol;
        		
        		$subject = "[GAAR Campinas] Procedimento número ".$id." foi atualizado";
        		
        		$headers = "MIME-Version: 1.0\n";               
        		$headers .= "Content-type: text/html; charset=utf-8\n";            
        		$headers .= "From: <{$from}> \r\n"; 
        		$message = "Olá ".$clinica.", <br><br>
        		
        		            <p> O procedimento número ".$id." foi atualizado. <br><br>
        		            
        		            
        		            <B>DADOS DO PROCEDIMENTO</B> <br><br>
                                    
                                    <table>
                                    <tr>
                                        <td align='left'>Nome do animal </td>
                                        <td align='left'>: ".$nomedoanimal."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Espécie </td>
                                        <td align='left'>: ".$especie."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Sexo </td>
                                        <td align='left'>: ".$sexo."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Porte </td>
                                        <td align='left'>: ".$porte."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Nome do tutor </td>
                                        <td align='left'>: ".$nomedotutor."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Procedimento</td>
                                        <td align='left'>: ".$tipoprocedi."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Quantidade</td>
                                        <td align='left'>: ".$qtde."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Valor pago pelo tutor ou responsável</td>
                                        <td align='left'>: R$ ".number_format($valortutor,2,',', '.')."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Valor a ser cobrado do GAAR</td>
                                        <td align='left'>: R$ ".number_format($valorgaar,2,',', '.')."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Data</td>
                                        <td align='left'>: ".$data."</td>
                                    </tr>
                                    <tr>
                                        <td align='left'>Observações</td>
                                        <td align='left'>: ".$obs."</td>
                                    </tr>
                                    </table>
                                    
                                    <br>
                                    
                    
        		            Para consultar todos os procedimentos, acesse:<br>
        		            
        		            1. <a href='http://gaarcampinas.org/area/login.html' target=_blank> Área restrita</a><br>
        		            2. Menu Procedimentos<br>
        		            3. Menu Consultar<br><br>
        		            
        		            * Esta notificação foi gerada automaticamente através do sistema *</p>";
        		
        		//mail($to, $subject, $message, $headers);
        		
        		foreach ($_POST as $key => $value) {
                    ${$key} = $value;
                    $_SESSION[$key] = $value;
                }
        		
        		echo"<script language='javascript' type='text/javascript'>
                  alert('Procedimento atualizado');
                  window.history.go(-2) ;
                  </script>";
                 
                 //window.location.href='formpesquisaagenda.php'

	    }
	    else{
    		echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                      echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                      echo "<a href='formpesquisaagenda.php' class='btn btn-primary'>Voltar</a></center><br>";
        }
}
mysqli_close($connect);
?>
