<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
$query = "SELECT USUARIO, NOME, AREA, SUBAREA  FROM VOLUNTARIOS";
$select = mysqli_query($connect,$query);
$reccount = mysqli_num_rows($select);

if ($reccount == 0) {
	echo "Nenhum registro encontrado <br><br>";
}else{ 
	echo $reccount." registros encontrados <br><br>";
	echo "<table border=1>";
	echo "<tr>";
	echo "<td>";
	echo "Usuário";
	echo "</td>";
	echo "<td>";
	echo "Nome";
	echo "</td>";
	echo "<td>";
	echo "Área";
	echo "</td>";
	echo "<td>";
	echo "Sub área";
	echo "</td>";
	echo "</tr>";
}



while ($fetch = mysqli_fetch_row($select)) {
    $usuario = $fetch[0];
    $nome = $fetch[1];
    $area = $fetch[2];
    $subarea = $fetch[3];
	echo "<tr>";
	echo "<td>";
	echo $usuario;
	echo "</td>";
	echo "<td>";
	echo $nome;
	echo "</td>";
	echo "<td>";
	echo $area;
	echo "</td>";
	echo "<td>";
	echo $subarea;
	echo "</td>";
	echo "</tr>";	
}

echo "</table>";
mysqli_close($connect);
}
?>
