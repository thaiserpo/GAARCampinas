<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	$nome = $_POST['nome'];
	$celular = $_POST['celular'];
	$email = $_POST['email'];
	$area = $_POST['area'];
	$cpfcnpj =  $_POST['cpf'];
	$rg =  $_POST['rg'];
	$orgaoexp = $_POST['orgaoexp'];
	$nascimento =  $_POST['nascimento'];
	$nacionalidade =  $_POST['nacionalidade'];
	$estadocivil =  $_POST['estadocivil'];
	$profissao = $_POST['profissao'];
	$cep = $_POST['cep'];
	$endereco = $_POST['endereco'];
	$complemento =  $_POST['complemento'];
	$numero =  $_POST['numero'];
	$bairro =  $_POST['bairro'];
	$cidade =  $_POST['cidade'];
	$estado =  $_POST['estado'];
	

        $query = "UPDATE VOLUNTARIOS
					SET 
					NOME='$nome',
					CELULAR='$celular',
					EMAIL='$email',
					CPF_CNPJ='$cpfcnpj',
					RG='$rg',
					ORGAO_EXP='$orgaoexp',
					DT_NASC='$nascimento',
					NACIONALIDADE='$nacionalidade',
					ESTADO_CIVIL='$estadocivil',
					PROFISSAO='$profissao',
					CEP='$cep',
					ENDERECO='$endereco',
					COMPLEM='$resp',
					NUMERO='$numero', 
					BAIRRO='$bairro', 
					CIDADE='$cidade', 
					ESTADO='$estado'
					WHERE 
					USUARIO = '$login'";
					 				
        $insert = mysqli_query($connect,$query); 	
		 
        if(mysqli_errno($connect) == '0'){
           echo"<script language='javascript' type='text/javascript'>
              alert('Cadastro atualizado com sucesso!');
    		  window.location.href='termo_voluntario.php'</script>";
	    }
	    else{
			echo "Insert code: ".$insert;
			echo "Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);
          echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao atualizar');window.location
          .href='formatualizadados.php'</script>";
        }
	  
}
?>