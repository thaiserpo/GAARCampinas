<?php

session_start();

include ("conexao.php"); 

$id_imagem = $_SESSION['idpretermo'];

$query = "SELECT FOTO FROM FORM_PRE_ADOCAO WHERE id = $id_imagem";

$resultado = mysqli_query($query);

$imagem = mysql_fetch_object($resultado);

Header( "Content-type: image/gif");

/*echo $imagem->imagem;*/

echo $imagem;

?>