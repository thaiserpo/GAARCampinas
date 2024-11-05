<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$foto = $_POST['foto'];
$uploaddir = '/home/gaarca06/public_html/docs/operacional/caderno_feiras/';
$uploadfile = $uploaddir.($_FILES['foto']['name']);
$obs = $_POST['observacoes'];
$idevento = $_POST['idfeira'];

if ($obs != ''){
    $query = "UPDATE EVENTOS SET OBS='$obs' WHERE ID='$idevento'";
    $update = mysqli_query($connect,$query); 
}

if ($foto !=''){
    move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile) ;
    $query = "UPDATE EVENTOS SET FOTO='$foto' WHERE ID='$idevento'";
    $update = mysqli_query($connect,$query); 
    
    echo "SQL ERROR: ".mysqli_errno($connect);
    
}
	
 
if(mysqli_errno($connect) == '0'){
/*	echo "Insert code: ".$insert;
	echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
  echo"<script language='javascript' type='text/javascript'>
  alert('Produto cadastrado com sucesso!');
  window.location.href='formcadastroprod.php'</script>";*/
}else{ 
	echo "Insert code: ".$insert;
	echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
	echo "<a href='formcadastroprod.php'>Voltar</a>";
  /*echo"<script language='javascript' type='text/javascript'>
  alert('Erro ao cadastrar');window.location
  .href='termo.php'</script>";*/
}

?>