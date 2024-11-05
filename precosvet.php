<?php 		

session_start();

header ("Content-type: image/jpeg ");

include ("conexao.php"); 

$login = $_SESSION['login'];
$resultsocio = $_POST['resultsocio'];
$tmp = $resultsocio;

/*if($login == "" || $login == null){
		  echo"<script language='javascript' type='text/javascript'>
		  alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{*/

$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
$selectarea = mysqli_query($connect,$queryarea);

while ($fetcharea = mysqli_fetch_row($selectarea)) {
		$area = $fetcharea[0];
}

            $query = "SELECT * FROM CLINICAS ORDER BY CLINICA ASC";

            $select = mysqli_query($connect,$query);
            $reccount = mysqli_num_rows($select);

		if ($reccount != '0') {
			while ($fetch = mysqli_fetch_row($select)) {
					$id = $fetch[0];
					$clinica = $fetch[1];
					$valor_gato = $fetch[10];
					$valor_gata = $fetch[11];
					$valor_caop = $fetch[12];
					$valor_caom = $fetch[13];
					$valor_caog = $fetch[14];
					$valor_cadelap = $fetch[15];
					$valor_cadelam = $fetch[16];
					$valor_cadelag = $fetch[17];
					$valor_gato_in = $fetch[32];
					$valor_gata_in = $fetch[33];
					$valor_caop_in = $fetch[34];
					$valor_caom_in = $fetch[35];
					$valor_caog_in = $fetch[36];
					$valor_cadelap_in = $fetch[37];
					$valor_cadelam_in = $fetch[38];
					$valor_cadelag_in = $fetch[39];
					$valor_gataprenhe = $fetch[23];
					echo "<font face='Arial'>";
					echo "<hr>";
					echo "<p>Clínica: ".$clinica."</p>";
                    echo "<table class='table' border='1'>";
                    echo "<thead class='thead-light'>";
                    echo "<th scope='col'>Animal</th>";
                    echo "<th scope='col'>Valor</th>";
                    echo "</thead>";
                    echo "<tbody>";
        			echo "<tr>";
        			echo "<td>Gato</td>";
        			echo "<td>R$ ".number_format($valor_gato, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td>Gato - inalatoria</td>";
        			echo "<td>R$ ".number_format($valor_gato_in, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td>Gata</td>";
        			echo "<td>R$ ".number_format($valor_gata, 2, ',', '.')."</td>";
        			echo "</tr>";
        			echo "<tr>";
        			echo "<td>Gata prenhe</td>";
        			echo "<td>R$ ".number_format($valor_gataprenhe, 2, ',', '.')."</td>";
        			echo "</tr>";
        			echo "<tr>";
        			echo "<td>Gata - inalatoria</td>";
        			echo "<td>R$ ".number_format($valor_gata_in, 2, ',', '.')."</td>";
        			echo "</tr>";
        			echo "<tr>";
        			echo "<td>Macho - Porte pequeno</td>";
        			echo "<td>R$ ".number_format($valor_caop, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td>Macho - Porte pequeno - inalatoria</td>";
        			echo "<td>R$ ".number_format($valor_caop_in, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Macho - Porte medio</td>";
        			echo "<td>R$ ".number_format($valor_caom, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Macho - Porte medio - inalatoria</td>";
        			echo "<td>R$ ".number_format($valor_caom_in, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Macho - Porte grande</td>";
        			echo "<td>R$ ".number_format($valor_caog, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Macho - Porte grande - inalatoria</td>";
        			echo "<td>R$ ".number_format($valor_caog_in, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td>Femea - Porte pequeno</td>";
        			echo "<td>R$ ".number_format($valor_cadelap, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
        			echo "<td>Femea - Porte pequeno - inalatoria</td>";
        			echo "<td>R$ ".number_format($valor_cadelap_in, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Femea - Porte medio</td>";
        			echo "<td>R$ ".number_format($valor_cadelam, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Femea - Porte medio - inalatoria</td>";
        			echo "<td>R$ ".number_format($valor_cadelam_in, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Femea - Porte grande</td>";
        			echo "<td>R$ ".number_format($valor_cadelag, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>Femea - Porte grande - inalatoria</td>";
        			echo "<td>R$ ".number_format($valor_cadelag_in, 2, ',', '.')."</td>";
					echo "</tr>";
					echo "</tbody>";
					echo "</table></font>";
			}	
			       	
		} else {
		    echo "Nenhum registro encontrado";
		}
mysqli_close($connect);
?>
