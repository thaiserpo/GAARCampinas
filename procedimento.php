<?php 

session_start();
$ano = date("Y");
$ano_atu = substr($ano,2,4);

include ("conexao.php"); 


require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

$codprocedi = $_GET['cod'];
$user = $_GET['user'];
if ($user =="vet") {
    $query = "SELECT * FROM AGENDAMENTO WHERE CODIGO='$codprocedi'";    
} else {
    $query = "SELECT * FROM AGENDAMENTO WHERE CODIGO='$codprocedi' AND ATIVO='SIM'";
}
$select = mysqli_query($connect,$query);
$reccount = mysqli_num_rows($select);

if ($reccount <> '0') {
    while ($fetch = mysqli_fetch_row($select)) {
	    $nomeanimal = $fetch[3];
	    $procedimento = $fetch[20];
	    $datamulti = $fetch[1];
	    $horamulti = $fetch[2];
	    $especie = $fetch[4];
	    $sexo = $fetch[5];
	    $porte =$fetch[6];
	    $peso = $fetch[7];
	    $respanimal = $fetch[9];
	    $autorizacao = $fetch[10];
	    $idvet = $fetch[19];
	    $idprotetor = $fetch[25];
	    $obsgaar = $fetch[15];
	    $valorajuda = $fetch[13];
	    $quemleva = $fetch[26];
	    $telquemleva = $fetch[11];
	    
    }
	    
    $queryvet = "SELECT * FROM CLINICAS WHERE ID='$idvet'";
    $selectvet = mysqli_query($connect,$queryvet);
    
    while ($fetchvet = mysqli_fetch_row($selectvet)) {
    	    $nomevet = $fetchvet[1];
    	    $endvet = $fetchvet[2];
    	    $numvet = $fetchvet[3];
    	    $bairrovet = $fetchvet[4];
    	    $cidadevet = $fetchvet[5];
    }
    
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
      <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- Meta tags Obrigatórias -->
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        <link rel="stylesheet" type="text/css" href="style-area.css"/>
        
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    
        <!-- Custom styles for this template -->
        <link href="navbar.css" rel="stylesheet">
        
        <title>GAAR - Código de autorização</title>
        
        <!--PDF library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
        
        <script type="text/javascript">
            function generatePDF(){
                var doc = new jsPDF();
                var msg = message;
    
                doc.setFontSize(40);
                doc.text("Octonyan loves jsPDF", 35, 25);
                doc.addImage("examples/images/Octonyan.jpg", "JPEG", 15, 40, 180, 180);
            }
        </script>
        
    </head>
    <body> 
    <main role="main" class="container">
        <div class="starter-template">
    
    <?
        if(mysqli_errno($connect) == '0'){
            $ano_multi = substr($datamulti,0,4);
    	    $mes_multi = substr($datamulti,5,2);
    	    $dia_multi = substr($datamulti,8,2);
    	    
    	    $queryprotetor = "SELECT * FROM PROTETORES WHERE ID='$idprotetor'";
        	$selectprotetor = mysqli_query($connect,$queryprotetor);
        	$rc = mysqli_fetch_row($selectprotetor);
        	$nomeprotetor = $rc[1];
        	$telprotetor = $rc[2];
    
            echo "<center><img src='https://gaarcampinas.org/area/logo_transparent.png' width='70' height='70'></center>" ;
            echo "<table style='border-style:none; font-family: Arial, sans-serif; display: inline-table;' >";
            echo "<thead style='background-color: #0000A0' class='thead-light'>";
            echo "<tr style='border-color:white; font-family: Arial, sans-serif;'>";
            echo "<th scope='col' colspan='10' style='text-align: center;><p style='font-family:arial,verdana;'><font color='#FFFFFF'><h3>AUTORIZAÇÃO/CÓDIGO: ".$codprocedi."</h3></p></font></th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            echo "<tr style='background-color: #FFFFFF'>";
            echo "<td><p style='font-family:arial,verdana;'>Nome do animal:</p></td>";
            echo "<td><p style='font-family:arial,verdana;'>".$nomeanimal."</p></td>";
            echo "<td colspan='2'>&nbsp;</td>";
            echo "</tr>";
            echo "<tr style='background-color: #FFFFFF'>";
            echo "<td ><p style='font-family:arial,verdana;'>Procedimento:</p></td>";
            echo "<td><p style='font-family:arial,verdana;'>".$procedimento."</p></td>";
            echo "<td colspan='2'>&nbsp;</td>";
            echo "</tr>";
            echo "<tr style='background-color: #FFFFFF'>";
            echo "<td ><p style='font-family:arial,verdana;'>Data:</p></td>";
            echo "<td><p style='font-family:arial,verdana;'>".$dia_multi."/".$mes_multi."/".$ano_multi."</p></td>";
            echo "<td ><p style='font-family:arial,verdana;'>Horário:</p></td>";
            echo "<td><p style='font-family:arial,verdana;'>".$horamulti."</p></td>";
            echo "</tr>";
            echo "<tr style='background-color: #FFFFFF'>";
            echo "<td ><p style='font-family:arial,verdana;'>Espécie:</p></td>";
            echo "<td><p style='font-family:arial,verdana;'>".$especie."</p></td>";
            echo "<td ><p style='font-family:arial,verdana;'>Sexo:</p></td>";
            echo "<td><p style='font-family:arial,verdana;'>".$sexo."</p></td>";
            echo "</tr>";
            echo "<tr style='background-color: #FFFFFF'>";
            echo "<td ><p style='font-family:arial,verdana;'>Porte:</p></td>";
            echo "<td><p style='font-family:arial,verdana;'>".$porte."</p></td>";
            echo "<td ><p style='font-family:arial,verdana;'>Peso:</p></td>";
            echo "<td><p style='font-family:arial,verdana;'>".$peso."kg</p></td>";
            echo "</tr>";
            echo "<tr style='background-color: #FFFFFF'>";
            echo "<td colspan='1'><p style='font-family:arial,verdana;'>Responsável:</p></td>";
            echo "<td colspan='1'><p style='font-family:arial,verdana;'>".$quemleva."</p></td>";
            echo "<td colspan='1'><p style='font-family:arial,verdana;'>Protetor:</p></td>";
            echo "<td colspan='1'><p style='font-family:arial,verdana;'>".$nomeprotetor." - Tel: ".$telprotetor."</p></td>";
            echo "<td colspan='5'>&nbsp;</td>";
            echo "</tr>";
            echo "<tr style='background-color: #FFFFFF'>";
            echo "<td ><p style='font-family:arial,verdana;'>Autorizado por:</p></td>";
            echo "<td><p style='font-family:arial,verdana;'>".$autorizacao."</p></td>";
            echo "<td colspan='2'>&nbsp;</td>";
            echo "</tr>";
            echo "<tr style='background-color: #FFFFFF'>";
            echo "<td colspan='2' ><p style='font-family:arial,verdana;'>Valor a pagar na clínica: R$".$valorajuda."</p></td>";
            echo "<td colspan='2'>&nbsp;</td>";
            echo "</tr>";
            echo "<tr style='background-color: #FFFFFF'>";
            echo "<td><p style='font-family:arial,verdana;'>Observações:</p></td>";
            /* dra Daniela */
            if ($idvet =='2'){
                $tmpobs = "Jejum alimentar 12h / Jejum líquido 6h. Medicação inclusa.";
            }
            
            /* dra Elani */
            if ($idvet =='3'){
                $tmpobs = " Jejum alimentar 10h / Jejum líquido 3h. Medicação inclusa.";
            }   
            
            /* dra Maira */
            if ($idvet =='5' || $idvet =='57'){
                if ($especie == 'Canina'){
                    $tmpobs = "Jejum alimentar 6h. Sem necessidade de fazer jejum líquido. ";    
                } else {
                    $tmpobs = "Jejum alimentar 4h (última alimentação: sachê). Sem necessidade de fazer jejum líquido. ";    
                }
                
                $tmpobs .= "Medicação não inclusa.";
            } 
            
            /* dra Fabiana Caociencia */
            if ($idvet =='4' || $idvet =='58'){
                if ($peso < '5'){
                    $tmpobs = "Jejum alimentar e líquido de 4h. ";    
                }
                if ($peso >= '5' && $peso <= '10'){
                    $tmpobs = "Jejum alimentar e líquido de 6h. ";    
                }
                if ($peso > '10' && $peso <='20'){
                    $tmpobs = "Jejum alimentar e líquido de 8h. ";    
                }
                if ($peso > '20'){
                    $tmpobs = "Jejum alimentar e líquido de 12h. ";    
                }
                $tmpobs .= "Medicação inclusa.";
            } 
            
            /* dra Adriana 1 - dra Sandra 7 - dra Thais 8 */
            if ($idvet =='1' || $idvet =='7' || $idvet =='8'){
                $tmpobs = "Jejum alimentar de 8h e líquido de 4h.<br>";
                $tmpobs .= "Medicação não inclusa.";
            } 
            if ($obsgaar <>'0') {
                echo "<td colspan='3'><p style='font-family:arial,verdana; color: red;'>".$tmpobs."<br>".$obsgaar."<br><strong>Roupas cirúrgicas NÃO estão inclusas nessa autorização.</strong><strong>Voucher válido apenas para o dia do procedimento.<br> O animal será previamente avaliado pelo veterinário e, caso precise, será utilizada a anestesia inalatória (em casos de obesidade ou animais braquicefálicos) onde o tutor/responsável deverá pagar 50% do valor.</strong></p></td>";    
            } else {
                echo "<td colspan='3'><p style='font-family:arial,verdana; color: red;'>".$tmpobs."<br><strong>Roupas cirúrgicas NÃO estão inclusas nessa autorização.</strong> <strong>Voucher válido apenas para o dia do procedimento.<br> O animal será previamente avaliado pelo veterinário e, caso precise, será utilizada a anestesia inalatória (em casos de obesidade ou animais braquicefálicos) onde o tutor/responsável deverá pagar 50% do valor.</strong></p></td>";
            }
            echo "</tr>";
            echo "<tr style='background-color: #FFFFFF'>";
            echo "<td ><p style='font-family:arial,verdana;'>Clínica Veterinária:</p></td>";
            echo "<td colspan='3'><p style='font-family:arial,verdana; '><strong>".$nomevet."</strong><br>".$endvet.",".$numvet." - ".$bairrovet.". ".$cidadevet."</p></td>";
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
            echo "<br>";
            echo "<table>";
            echo "<tr style='background-color: #FFFFFF'>";
            echo "<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=https://gaarcampinas.org/area/formatualizaprocediqrcode.php?cod=".$codprocedi."'>";
            echo "</tr>";
            echo "</table>";
            echo "<div class='d-print-none'>";
            echo "<p>Cliquei no botão abaixo para imprimir ou salvar em PDF <br><a href='javascript:window.print()' class='btn btn-primary'>Imprimir</a></p>";
            echo "</div>";
            
    
        }
} else {
        echo "<H3> <center>CÓDIGO DE AUTORIZAÇÃO EXPIRADO</H3></center><p> Por favor, faça um novo pedido aqui: <a href='https://gaarcampinas.org/quero-castrar/'>Formulário para pedido de castração</a>";
}
        
mysqli_close($connect);

?>
    <br>
    <!--<center><a href="formautoriza.php" class="btn btn-primary">Voltar</a></center>-->
    </div>
</main>
<br><br>
<footer class="footer fixed-bottom bg-light">
      <div class="container">
        <p class="text-center">GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
      </div>
    </footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>
