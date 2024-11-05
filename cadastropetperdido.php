<?php 
session_start();

include ("conexao.php"); 

$nomeanimal = $_POST['nomeanimal'];
$especie = $_POST['especie'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];
$cor = $_POST['cor'];
$porte = $_POST['porte'];
$castracao = $_POST['castracao'];
$vacinacao = $_POST['vacinacao'];
$status = $_POST['status'];
$resp = $_POST['resp'];
/*$foto = $_FILES['foto'];*/
$obs = $_POST['obs'];
$divulgar = $_POST['divulgar'];
$uploaddir = '/home/gaarca06/public_html/pets/';
$uploadfile = $uploaddir.($_FILES['foto']['name']);
$nome_foto = $_FILES['foto']['name'];

if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
		$foto = $uploadfile;
		
        $query = "INSERT INTO ANIMAL
					(NOME_ANIMAL, 
					ESPECIE, 
					IDADE, 
					SEXO, 
					COR, 
					PORTE, 
					CASTRADO, 
					DATA_CASTRACAO, 
					VACINADO, 
					ADOTADO, 
					LAR_TEMPORARIO, 
					RESPONSAVEL, 
					DATA_ENTRADA_LT, 
					DATA_SAIDA_LT, 
					OBS, 
					FOTO,
					OBS2,
					DIVULGAR_COMO ) 
					VALUES
('$nomeanimal','$especie','$idade','$sexo','$cor','$porte','$castracao','0','$vacinacao','$status','0','$resp','0','0','$obs','$nome_foto','0','$divulgar')";
						
        $insert = mysqli_query($connect,$query); 	
		 
        /*if($insert=='0'){*/
          echo"<script language='javascript' type='text/javascript'>
          alert('Animal cadastrado com sucesso!');
		  window.location.href='formcadastropetterc.php'</script>";
	    /*}else{
			echo "Insert code: ".$insert;
			echo "Mensagem de erro: ".mysql_error(). "SQL Error: ".mysql_errno();
          echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao cadastrar');window.location
          .href='termo.php'</script>";
        }*/
	  }
	  else{
	  echo "Arquivo inválido";
	  }
?>