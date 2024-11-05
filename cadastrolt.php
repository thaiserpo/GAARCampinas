<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
$nomelt = strtoupper($_POST['nomelt']);
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$telfixo = $_POST['telfixo'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$especies = $_POST['especies'];
$qtdecaes = $_POST['qtdecaes'];
$qtdegatos = $_POST['qtdegatos'];
$valordiarioate6m = $_POST['valordiarioate6m'];
$valordiariomais6m = $_POST['valordiariomais6m'];
$valordiarioadulto = $_POST['valordiarioadulto'];
$banco = $_POST['bancolt'];
$ag = $_POST['agencialt'];
$cc = $_POST['contalt'];
$dv = $_POST['dvlt'];
$resp = $_POST['resp'];

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$ativo =  'Sim';
$situacao = "ATIVO";

    if ($qtdecaes == ''){
        $qtdecaes = 0;
    }
    
    if ($qtdegatos == ''){
        $qtdegatos = 0;
    }
    
    if ($valordiario == ''){
        $valordiario = 0;
    }

        $query = "INSERT INTO LT
					(LAR_TEMPORARIO, 
					ENDERECO, 
					BAIRRO, 
					CIDADE, 
					TEL_FIXO, 
					TEL_CELULAR, 
					EMAIL, 
					ESPECIES, 
					QTDE_CAES, 
					QTDE_GATOS, 
					VALOR_DIA_ATE6M,
					VALOR_DIA_MAIS6M,
					VALOR_DIA_ADULTO,
					VOLUNTARIO_RESP,
					BANCO,
					AGENCIA,
					CONTA,
					DV,
					ATIVO,
					SITUACAO) 
					VALUES
                    ('$nomelt',
                    '$endereco',
                    '$bairro',
                    '$cidade',
                    '$telfixo',
                    '$celular',
                    '$email',
                    '$especies',
                    '$qtdecaes',
                    '$qtdegatos',
                    '$valordiarioate6m',
                    '$valordiariomais6m',
                    '$valordiarioadulto',
                    '$resp',
                    '$banco',
                    '$ag',
                    '$cc',
                    '$dv',
                    '$ativo',
                    '$situacao')";
						
        $insert = mysqli_query($connect,$query); 	
		 
        if(mysqli_errno($connect) == '0'){
		    /*echo "Insert code: ".$insert;
			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
         echo"<script language='javascript' type='text/javascript'>
          alert('Lar temporário cadastrado com sucesso!');
		  window.location.href='formcadastrolt.php'</script>";
	    }else{ 
	        $log_file_msg.="[cadastrolt.php] Erro no cadastro do lt ".$nomelt.". Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);
            echo"<script language='javascript' type='text/javascript'>
                  alert('Erro ao cadastrar');window.location
                  .href='termo.php'</script>";
        }
	  }
fclose($fp); 
mysqli_close($connect);
?>
