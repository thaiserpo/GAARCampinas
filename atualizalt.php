<?php 
session_start();

include ("conexao.php");
$id           =$_POST['id_lt'];
$nome_lt      =$_POST['nome_lt'];
$endereco_lt  =$_POST['endereco_lt'];
$bairro       =$_POST['bairro'];
$tel_fixo     =$_POST['tel_fixo'];
$celular      =$_POST['celular'];
$email        =$_POST['email'];
$especies     =$_POST['especies'];
$qtdecaes     =$_POST['qtdecaes'];
$qtdegatos    =$_POST['qtdegatos'];
$vagasdisp    =$_POST['vagasdisp'];
$resp         =$_POST['resp'];
$ativo        =$_POST['ativo'];
$ltpago       =$_POST['ltpago'];
$bancolt      =$_POST['bancolt'];
$agencialt    =$_POST['agencialt'];
$contalt      =$_POST['contalt'];
$dvlt         =$_POST['dvlt'];
$cpfcnpj      =$_POST['cpfcnpj'];
$valordiario  =$_POST['valordiario'];
$qtdevagas    =$_POST['qtde_vagas'];


$query = "UPDATE LT
				SET 
				LAR_TEMPORARIO = '$nome_lt',
				ENDERECO='$endereco_lt',
				BAIRRO='$bairro',
				CIDADE='0',
				TEL_FIXO='$tel_fixo',
				TEL_CELULAR='$celular',
				EMAIL='$email',
				ESPECIES='$especies',
				QTDE_CAES='$qtdecaes',
				QTDE_GATOS='$qtdegatos',
				VALOR_DIA='$valordiario',
				VOLUNTARIO_RESP='$resp',
				BANCO='$bancolt',
				AGENCIA='$agencialt',
				CONTA='$contalt',
				DV='$dvlt',
				CPF='$cpfcnpj',
				ATIVO='$ativo',
				QTDE_VAGAS='$qtdevagas',
				VAGAS_DISP='$vagasdisp',
				WHERE 
				ID  = '$id'";
				 				
$insert = mysqli_query($connect,$query); 	

if(mysqli_errno($connect) <> '0'){
		echo "Insert code: ".$insert;
		echo "Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);
}
        
mysqli_close($connect);

