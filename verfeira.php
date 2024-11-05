<?php 

session_start();

include ("conexao.php"); 
include ("conexao_lojinha.php"); 

$login = $_SESSION['login'];
$idevento = $_GET['idevento'];
$source = $_GET['source'];

/*if($login == "" || $login == null ){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
        $queryarea = "SELECT AREA,SUBAREA,NOME,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
		}
*/

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
    
    <link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">

    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/auto-refresh/bootstrap-table-auto-refresh.min.js"></script>
    <!--- BOOTSTRAP --->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--- BOOTSTRAP --->
    <title>GAAR - Ver feiras </title>
    <!--- GOOGLE ADSENSE --->
     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
     <!--- GOOGLE ADSENSE --->
</head>

<body>
<main role="main" class="container">
    <div class="starter-template">
    <center>
        <img src="/area/logo_transparent.png" width="70" height="70"><br><p>Grupo de Apoio ao Animal de Rua - Campinas/SP</p><br><br>
        <h2>RELATÓRIO DAS FEIRAS</h2><br>
    </center>
    <br><br>
<?

$queryfeira = "SELECT * FROM EVENTOS WHERE ID='$idevento'";
$resultfeira = mysqli_query($connect,$queryfeira);
$reccountfeira = mysqli_num_rows($resultfeira);

$sum_total_vendas = 0;

while ($fetchfeira = mysqli_fetch_row($resultfeira)) {
    $idevento = $fetchfeira[0];
    $desc = $fetchfeira[1];
    $data = $fetchfeira[4];
    
    $ano_feira = substr($data,0,4);
    $mes_feira = substr($data,5,2);
    $dia_feira = substr($data,8,2);
    

            $total_vendas = 0;
            
            $sum_taxa = 0;
        
            echo " <h3>".$desc." - ".$dia_feira."/".$mes_feira."/".$ano_feira."</h3>
    
            <B>Voluntários presentes</B> <br><br>
                        
                        <table border='1'>
                        <thead class='thead-dark'>
        						  <tr>
        							<th scope='col' colspan='1'>Nome</th>
        							<th scope='col' colspan='2'>Cargo</th>
        						   </tr>
        				</thead> 
        			 <tbody>";
        
                $queryvol = "SELECT * FROM LISTA_DE_PRESENCA WHERE ID_EVENTO='$idevento'" ;
                $resultvol = mysqli_query($connect,$queryvol);
                while ($fetchvol = mysqli_fetch_row($resultvol)) {
                    $idvol= $fetchvol[0];
                    $nome = $fetchvol[1];
                    $cargo = $fetchvol[4];
                    
            		echo "	            <tr>
                			            <td>".$nome."</td>
                			            <td>".$cargo."</td>
                			            <td><a href='deletarecfeira.php?id=".$idvol."&tipo=vol'>Deletar</a></td>
                    				</tr>";
                }
                
                echo "</tbody>
    	                  </table>
    	                  
    	                  <br>
    	                  
    	                  <B>Animais presentes</B> <br><br>
                
                            <table border='1'>
                            <thead class='thead-dark'>
            						  <tr>
            							<th scope='col' colspan='1'>Código</th>
            							<th scope='col' colspan='1'>Nome</th>
            							<th scope='col' colspan='1'>Espécie</th>
            							<th scope='col' colspan='1'>Lar temporário</th>
            							<th scope='col' colspan='1'>Responsável</th>
            							<th scope='col' colspan='1'>Status</th>
            							<th scope='col' colspan='2'>Forma de pagamento</th>
            						   </tr>
            				</thead> 
            			 <tbody>";
                
                $querypetid = "SELECT ID_ANIMAL FROM ANIMAIS_FEIRAS WHERE ID_FEIRA='$idevento'";
                $resultpetid = mysqli_query($connect,$querypetid);
                while ($fetchpetid = mysqli_fetch_row($resultpetid)) {
                    $petid = $fetchpetid[0];
                    $querypet = "SELECT * FROM ANIMAL WHERE ID='$petid'";
                    $resultpet = mysqli_query($connect,$querypet);
                    while ($fetchpet = mysqli_fetch_row($resultpet)) {
                        $nomedoanimal = $fetchpet[1];
                        $especie = $fetchpet[2];
                        $lt = $fetchpet[11];
                        $resp = $fetchpet[12];
                        $status = $fetchpet[10];
                        
                        $querytermo = "SELECT * FROM TERMO_ADOCAO WHERE ID_ANIMAL='$petid'";
                        $resulttermo = mysqli_query($connect,$querytermo);
                        $reccounttermo = mysqli_num_rows($resulttermo);
                        
                        /*if ($reccounttermo != '0'){
                            while ($fetchtermo = mysqli_fetch_row($resulttermo)) {
                                $forma_pgto = $fetchtermo[41];
                            }  
                        } else {
                            $forma_pgto = "N/A";
                        }*/
                        
                        $forma_pgto = "N/A";
                        
                        if ($status == 'Adotado'){
                            $taxa = "50";
                            $sum_taxa = floatval($taxa) + floatval($sum_taxa);
                        }
                        
                        echo " <tr>
                			            <td>".$petid."</td>
                			            <td><a href='http://gaarcampinas.org/pet.php?id=".$petid."' target='_blank'>".$nomedoanimal."</a></td>
                			            <td>".$especie."</td>
                			            <td>".$lt."</td>
                			            <td>".$resp."</td>
                			            <td>".$status."</td>
                			            <td>".$forma_pgto."</td>";
                			             //echo "<td><a href='deletarecfeira.php?id=".$petid."&tipo=pet'>Deletar</a></td>";
                    	echo "			</tr>";
                        
                    }
                }
                echo "</tbody>
    	                  </table>
    	                  <br>
    	                  
    	                  <br>
    	                  
    	                  <B>Produtos vendidos</B> <br><br>
                
                            <table border='1'>
                            <thead class='thead-dark'>
            						  <tr>
            							<th scope='col' colspan='1'>Produto</th>
            							<th scope='col' colspan='1'>Quantidade</th>
            							<th scope='col' colspan='1'>Meio de pagamento</th>
            							<th scope='col' colspan='2'>Valor</th>
            						   </tr>
            				</thead> 
            			 <tbody>";

            	$queryprod = "SELECT * FROM VENDAS_PRODUTOS WHERE ID_EVENTO='$idevento' AND LOCAL_VENDA='Feira de adoção'";
            	$resultprod = mysqli_query($connect,$queryprod);
                while ($fetchprod = mysqli_fetch_row($resultprod)) {
                    $idprod = $fetchprod[0];
                    $proddesc = $fetchprod[6];
                    $qtdeprod = $fetchprod[7];
                    $meiopgto = $fetchprod[12];
                    $valor = $fetchprod[13];
                    
            		echo "	            <tr>
                			            <td>".$proddesc."</td>
                			            <td>".$qtdeprod."</td>
                			            <td>".$meiopgto."</td>
                			            <td>R$ ".number_format($valor, 2, ',', '.')."</td>
                			            <td><a href='deletarecfeira.php?id=".$idprod."&tipo=prod'>Deletar</a></td>
                    				</tr>";
                    $total_vendas = floatval($total_vendas) + floatval($valor);
                    $valor_total = 0;

                    }
                echo "</tbody>
    	                  </table>";
    }
    
echo "
<br>
    	                  <table>
    	                    <tbody>
    	                        <tr>
    	                            <td><strong> Total em vendas:</strong></td>
    	                            <td><strong><font color='blue'>R$ ".number_format($total_vendas, 2, ',', '.')."</font></strong></td>
    	                        </tr>
    	                        <tr>
    	                            <td><strong> Total em taxas:</strong></td>
    	                            <td><strong><font color='blue'>R$ ".number_format($sum_taxa, 2, ',', '.')."</font></strong></td>
    	                        </tr>
    	                    </tbody>
    	                  </table>
    	                  <br><br>
    	                  ";
/*}*/
?>
            <p><center><strong>OBSERVAÇÕES</strong><br><i> Todos os dados apresentados foram coletados do banco de dados do GAAR.<br>Esta notificação é automática e será enviada automaticamente 1 dia após a feira.</i></center><br><br>
          <br>
          <br>
          <footer class='footer fixed-bottom bg-light'>
              <div class='container'>
                <p class='text-center'>GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
              </div>
            </footer>

    <!--- BOOTSTRAP --->
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
<!--- BOOTSTRAP --->
</div>
</main>
</body>
</html>