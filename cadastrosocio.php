<?php 

session_start();

include ("conexao.php"); 

$nomesocio = strtoupper($_POST['nomesocio']);
$cidadesocio = $_POST['cidadesocio'];
$celularsocio = $_POST['celularsocio'];
$emailsocio = $_POST['emailsocio'];
$valorsocio = $_POST['valorsocio'];
$outrovalor = $_POST['outrovalor'];
$forma = $_POST['forma'];
$diadomesocio = $_POST['diadomesocio'];
$lembrete = $_POST['lembrete'];
$bancosocio = $_POST['bancosocio'];
$agencia = $_POST['agsocio'];
$conta = $_POST['contasocio'];
$dv = $_POST['dv'];
$freq = $_POST['freq'];
$cpf = $_POST['cpf'];

    
    if ($nomesocio !=''){

		if ($valorsocio == 'Outro'){
				$valorsocio = $outrovalor;
		}
		
		if ($agencia == ''){
		    $agencia = 0;
		}
		
		if ($cidadesocio =='') {
		    $cidadesocio = 0;
		}
		
		if ($celularsocio =='') {
		    $celularsocio = 0;
		}
		
		if ($emailsocio =='') {
		    $emailsocio = 0;
		}

		
		$querydup = "SELECT * FROM SOCIO WHERE EMAIL = '$emailsocio'";
		$selectdup = mysqli_query($connect,$querydup); 
		$reccountdup = mysqli_num_rows($selectdup);
		
		if ($reccountdup != '0') {
		    echo"<script language='javascript' type='text/javascript'>
                  alert('Cadastro j¨¢ realizado');window.location
                  .href='formcadastrosocio.php'</script>";
		} else {
		    $query = "INSERT INTO SOCIO 
		            (NOME,
		            CIDADE,
		            TEL_CELULAR,
		            EMAIL,
		            VALOR,
		            FORMA_AJUDAR,
		            MELHOR_DIA,
		            RECEBER_LEMBRETE,
		            BANCO,
		            AGENCIA,
		            CONTA,
		            DV,
		            FREQ_DOACAO,
		            CPF) 
		            VALUES 
		            ('$nomesocio',
		            '$cidadesocio',
		            '$celularsocio',
		            '$emailsocio',
		            '$valorsocio',
		            '$forma',
		            '$diadomesocio',
		            '$lembrete',
		            '$bancosocio',
		            '$agencia',
		            '$conta',
		            '$dv',
		            '$freq',
		            '$cpf') ";
						
        $insert = mysqli_query($connect,$query); 
        
        if(mysqli_errno($connect)== '0'){
		/*	echo "Insert code: ".$insert;
			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
          echo"<script language='javascript' type='text/javascript'>
          alert('Cadastro efetuado com sucesso!');
		  window.location.href='formcadastrosocio.php'</script>";
		
        }else{ 
			echo "Insert code: ".$insert;
			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
			echo "Erro ao cadastrar <br><br>";
			echo "<a href='formcadastrosocio.php'>Voltar</a>";
          /*echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao cadastrar');window.location
          .href='termo.php'</script>";*/
        }
    }
    }
    else {
        echo"<script language='javascript' type='text/javascript'>
          alert('Preencha o campo Nome');window.location
          .href='formcadastrosocio.php'</script>";
}
?>