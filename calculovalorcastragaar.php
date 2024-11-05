<?php

include ("conexao.php"); 

$query = "SELECT * FROM AGENDAMENTO WHERE (ESPECIE = 'Canina' AND peso >= 20) OR (ESPECIE = 'Felina' AND peso >= 4)";
$select = mysqli_query($connect,$query);
$reccount = mysqli_num_rows($select);

while ($fetch = mysqli_fetch_row($select)) {
    $idagenda = $fetch[0]; 
    $especie = $fetch[4]; 
    $sexo = $fetch[5];
    $peso = $fetch[8];
    $porte = $fetch[6];
    $valor_ajuda = $fetch[13];
    $idvet = $fetch[19];
    $idprot = $fetch[25];
    
    $queryvet = "SELECT * FROM CLINICAS WHERE ID='$idvet'";
    $selectvet = mysqli_query($connect,$queryvet);
    $rc= mysqli_fetch_row($selectvet);
    $reccount = mysqli_num_rows($selectvet);
    $id = $rc[0];
    $valorgato = $rc[10];
    $valorgata =  $rc[11];
    $valorcaop = $rc[12];
    $valorcaom = $rc[13];
    $valorcaog = $rc[14];
    $valorcadelap = $rc[15];
    $valorcadelam = $rc[16];
    $valorcadelag = $rc[17];
    $valorgataprenhe = $rc[23];
    $valorgatoin = $rc[32];
    $valorgatain = $rc[33];
    $valorcaopin = $rc[34];
    $valorcaomin = $rc[35];
    $valorcaogin = $rc[36];
    $valorcadelapin = $rc[37];
    $valorcadelamin = $rc[38];
    $valorcadelagin =$rc[39];
    $valorgatoprot =$rc[42];
    $valorgataprot =$rc[43];
    $valorcaoprot =$rc[44];
    $valorcadelaprot =$rc[45];
    
    switch ($especie){
        case 'Felina':
            if ($peso >="3"){
                
            }
            break;
            
        case 'Canina':
            if ($idvet=="4" || $idvet =="58"){ //dra Fabiana
                if ($peso >="20"){
                    if ($sexo == "Fêmea" && $porte == "Pequeno") {
                        $valorgaar =  $valorcadelapin/2;
                        $valorajuda = $valorcadelapin/2;
                        echo "<br> Porte P";
                        $queryupdate = "UPDATE AGENDAMENTO SET VALOR_GAAR='".$valorgaar."', VALOR_AJUDA='".$valorajuda."' WHERE ID='$idagenda'";
                        echo "<br> ".$queryupdate;
                    }
                    if ($sexo == "Fêmea" && $porte == "Médio") {
                        $valorgaar =  $valorcadelamin /2;
                        $valorajuda =  $valorcadelamin /2;
                        echo "<br> Porte M";
                        echo "<br> valor cadela M: ".$valorcadelamin;
                        $queryupdate = "UPDATE AGENDAMENTO SET VALOR_GAAR='".$valorgaar."', VALOR_AJUDA='".$valorajuda."' WHERE ID='$idagenda'";
                        echo "<br> ".$queryupdate;
                    }
                    if ($sexo == "Fêmea" && $porte == "Grande") {
                        $valorgaar =  $valorcadelagin /2;
                        $valorajuda =  $valorcadelagin /2;
                        echo "<br> Porte G";
                        echo "<br> valor cadela G: ".$valorcadelagin;
                        $queryupdate = "UPDATE AGENDAMENTO SET VALOR_GAAR='".$valorgaar."', VALOR_AJUDA='".$valorajuda."' WHERE ID='$idagenda'";
                        echo "<br> ".$queryupdate;
                    }
                }
            }
            break;
        default:
            break;
    }
}                		     
mysqli_close($connect);
		
?>