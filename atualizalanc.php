<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	$idlanc = $_POST['idalanc'];
	$dtlanc = $_POST['dtlanc'];
	$desclanc = $_POST['desclanc'];
	$tipolanc = $_POST['$tipolanc'];
	$valorlanc = $_POST['valorlanc'];
	$bancolanc = $_POST['bancolanc'];
	$valorcontlanc = $_POST['valorcontlanc'];
	$uploaddir = '/home/gaarcam1/public_html/docs/financeiro/';
	$uploadfile = $uploaddir.($_FILES['file']['name']);
	$file = $uploadfile;
	$nome_file = $_FILES['file']['name'];
	$nome_file_ori = $_POST['file_ori'];
	
/*echo "<br> idanimal;".$idanimal;
echo "<br> nomedoanimal;".$nomedoanimal;
echo "<br> especie;".$especie;
echo "<br> idade;".$idade;
echo "<br> sexo;".$sexo;
echo "<br> cor;".$cor;
echo "<br> porte;".$porte;
echo "<br> castracao;".$castracao;
echo "<br> dtcastracao;".$dtcastracao;
echo "<br> vacinacao;".$vacinacao;
echo "<br> status;".$status;
echo "<br> lt;".$lt;
echo "<br> ltold;".$ltold;
echo "<br> resp;".$resp;
echo "<br> dtentradalt;".$dtentradalt;
echo "<br> dtsaidalt;".$dtsaidalt;
echo "<br> obs;".$obs;
echo "<br> obs2;".$obs2;
echo "<br> divulgar;".$divulgar;
echo "<br> uploaddir;".$uploaddir;
echo "<br> uploadfile;".$uploadfile;
echo "<br> foto;".$foto;
echo "<br> nome_foto;".$nome_foto;
echo "<br> nome_foto_ori;".$nome_foto_ori;
	
*/
    if ($nome_foto != ''){
    	if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
    		    $foto = $uploadfile;
    	    }
    }
	  else{
	        $nome_foto = $nome_foto_ori;
	    }
	
	if ($dtcastracao == ''){
	        $dtcastracao = '0001-01-01';
	    }
	
	if ($dtentradalt == ''){
	    $dtentradalt = '0001-01-01';
	}
	
	if ($dtsaidalt == ''){
	    $dtsaidalt = '0001-01-01';
	} else {
	    
	}

	
	if($lt == ''){
	    $lt = $ltold;
	}

        $query = "UPDATE ANIMAL
					SET 
					NOME_ANIMAL='$nomedoanimal',
					ESPECIE='$especie',
					IDADE='$idade',
					SEXO='$sexo',
					COR='$cor',
					PORTE='$porte',
					CASTRADO='$castracao',
					DATA_CASTRACAO='$dtcastracao',
					VACINADO='$vacinacao',
					ADOTADO='$status',
					LAR_TEMPORARIO='$lt',
					RESPONSAVEL='$resp',
					DATA_ENTRADA_LT='$dtentradalt', 
					DATA_SAIDA_LT='$dtsaidalt', 
					OBS='$obs', 
					FOTO='$nome_foto',
					OBS2='$obs2',
					DIVULGAR_COMO='$divulgar'
					WHERE 
					ID = '$idanimal'";
					 				
        $insert = mysqli_query($connect,$query); 	
		 
        if($insert=='0' || $insert=='1'){
        /*echo "Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);*/
        echo"<script language='javascript' type='text/javascript'>
          alert('Animal atualizado com sucesso!');
		  window.location.href='formpesquisapetinterna.php'</script>";
	    }
	    else{
			echo "Insert code: ".$insert;
			echo "Mensagem de erro: ".mysql_error(). "SQL Error: ".mysql_errno();
          echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao cadastrar');window.location
          .href='formatualizapet.php'</script>";
        }
	  
}
?>