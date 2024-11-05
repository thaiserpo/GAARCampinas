<?php 
session_start();

include ("conexao.php"); 

$queryarea = "SELECT AREA,NOME,USUARIO FROM VOLUNTARIOS WHERE AREA='operacional'";
$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$nomevol = $fetcharea[1];
				$usuario = $fetcharea[2];
				
				$nomeDaPasta = "/home1/gaarca06/public_html/area/imagens/signat/".$usuario;
				
				if (mkdir($nomeDaPasta)) {
                    echo "Pasta ".$nomeDaPasta." criada com sucesso! <br>";
                } else {
                    echo "Não foi possível criar a pasta ".$nomeDaPasta."<br>";
                }
				
		}


?>