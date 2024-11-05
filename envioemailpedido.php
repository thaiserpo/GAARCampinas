<?php 

session_start();

include ("conexao.php"); 

$idpedido = $_GET['id'];

$queryvenda = "SELECT * FROM VENDAS_PRODUTOS WHERE ID_EVENTO ='$idpedido'";
$resultvenda = mysqli_query($connect,$queryvenda);
$reccountvenda = mysqli_num_rows($resultvenda);

while ($fetchvenda = mysqli_fetch_row($resultvenda)) {
        $nome_cliente = $fetchvenda[1];
        $endereco = $fetchvenda[19];
        $celular = $fetchvenda[2];
        $email = $fetchvenda[3];
        $idpedido = $fetchvenda[16];
}

$message = "<!DOCTYPE html>
<html lang='pt-br'>
<head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<!-- Meta tags Obrigatórias -->

<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

<!-- Bootstrap CSS -->
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>

<link rel='stylesheet' type='text/css' href='style-area.css'/>

<link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>

<!-- Custom styles for this template -->
<link href='navbar.css' rel='stylesheet'>


</head>
<body>

<main role='main' class='container'>
<p>
<div class='starter-template'>
<br>
<center><h3>DADOS DO CLIENTE</h3></center>
<div class='form-group row'>
          <label class='col-sm-2 col-form-label'><strong>Nome completo: </strong></label> 
          <div class='col-sm-10'>
            <label class='col-sm-10 col-form-label'>".$nome_cliente."</label> 
          </div>
          <label class='col-sm-2 col-form-label'><strong>Endereço: </strong></label> 
          <div class='col-sm-10'>
            <label class='col-sm-6 col-form-label'>".$endereco."</label> &nbsp;  
          </div> 
          <label class='col-sm-2 col-form-label'><strong>Telefone: </strong></label> 
          <div class='col-sm-10'>
            <label class='col-sm-6 col-form-label'>".$celular."</label> &nbsp;  
          </div> 
          <label class='col-sm-2 col-form-label'><strong>E-mail:</strong></label> 
          <div class='col-sm-10'>
            <label class='col-sm-10 col-form-label'><a href='mailto:".$email."'>".$email."</a></label> 
          </div>
</div>";

$message .="<center><h3>DADOS DO PEDIDO</h3></center>
        <div class='form-group row'>
          <table class='table' border='1'>
            <thead class='thead-light'>
				  <tr>
				    <th scope='col'>Pedido Loja Integrada</th>
					<th scope='col' colspan='1'>Item</th>
					<th scope='col' colspan='1'>Quantidade</th>
					<th scope='col' colspan='1'>Serviço</th>
			      </tr>
		    </thead>
		    <tbody>";

$querylojaint = "SELECT * FROM VENDAS_PRODUTOS WHERE ID_EVENTO ='$idpedido'";
$resultlojaint = mysqli_query($connect,$querylojaint);
$reccountlojaint = mysqli_num_rows($resultlojaint);

while ($fetchlojaint = mysqli_fetch_row($resultlojaint)) {
    $produto = $fetchlojaint[6];
    $qtd = $fetchlojaint[7];
    $status = $fetchlojaint[11];
    
    if (strpos($produto, 'Caneca') !== false) {
        $idfornec = $fetchlojaint[18];
        
        $queryfornec = "SELECT EMAIL FROM FORNECEDORES WHERE ID ='$idfornec'";
        $resultfornec = mysqli_query($connect,$queryfornec);
            
        while ($fetchfornec = mysqli_fetch_row($resultfornec)) {
                $emailfornec = $fetchfornec[0];
        }

        $message .="<tr>
             <td>".$idpedido."</td> 
             <td>".$produto."</td>          
             <td>".$qtd."</td>  
             <td>".$status."</td>  
            </tr>";
        
        $caneca = true;
    }
    
    $queryupdate = "UPDATE VENDAS_PRODUTOS SET NOTIFICACAO='Sim' WHERE ID_EVENTO ='$idpedido' AND LOCAL_VENDA LIKE '%Loja%'";
    $resultupdate = mysqli_query($connect,$queryupdate);

}       
    
    $message .="
        </tbody>
             </table>
    </div>";
    
    mysqli_close($connect); 


if ($caneca == true) {
            $message .="
            <br>
            <strong>Estampas para referência</strong><br><i>Clique para aumentar</i><br><br>
            Caneca Amor é uma palavra de 4 patas Azul: <br>
            <a href='http://gaarcampinas.org/lojinha/Amor-4patas-azul.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/Amor-4patas-azul.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Amor é uma palavra de 4 patas Rosa: <br>
            <a href='http://gaarcampinas.org/lojinha/Amor-4patas-rosa.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/Amor-4patas-rosa.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Amor é uma palavra de 4 patas Verde: <br>
            <a href='http://gaarcampinas.org/lojinha/Amor-4patas-verde.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/Amor-4patas-verde.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Lar é onde meu gato está: <br>
            <a href='http://gaarcampinas.org/lojinha/lar-gato.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/lar-gato.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Lar é onde meu cachorro está: <br>
            <a href='http://gaarcampinas.org/lojinha/lar-cachorro.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/lar-cachorro.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Que tal um café? Gato: <br>
            <a href='http://gaarcampinas.org/lojinha/Que-tal-cafe-gato-fundobranco.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/Que-tal-cafe-gato-fundobranco.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Gato poses: <br>
            <a href='http://gaarcampinas.org/lojinha/Gato-poses.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/Gato-poses.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Cachorro brincando: <br>
            <a href='http://gaarcampinas.org/lojinha/cachorro-brincando-fundo-verde.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/cachorro-brincando-fundo-verde.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Cat colorida: <br>
            <a href='http://gaarcampinas.org/lojinha/CanecaCatcolorida.jpg' target='_blank'><img src='http://gaarcampinas.org/lojinha/CanecaCatcolorida.jpg' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Patas de gato: <br>
            <a href='http://gaarcampinas.org/lojinha/CanecaPatasdegato.jpg' target='_blank'><img src='http://gaarcampinas.org/lojinha/CanecaPatasdegato.jpg' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Have a nice day cachorro: <br>
            <a href='http://gaarcampinas.org/lojinha/CanecaHaveanicedaycachorro.jpg' target='_blank'><img src='http://gaarcampinas.org/lojinha/CanecaHaveanicedaycachorro.jpg' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Dog lover: <br>
            <a href='http://gaarcampinas.org/lojinha/CanecaDoglover.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/CanecaDoglover.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Cat and dog - Pet Lover: <br>
            <a href='http://gaarcampinas.org/lojinha/CanecaCatdog.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/CanecaCatdog.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Books, cats and coffee - fundo branco: <br>
            <a href='http://gaarcampinas.org/lojinha/Books-cats-coffee-branca.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/Books-cats-coffee-branca.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Gente que ama cachorro - fundo branco: <br>
            <a href='http://gaarcampinas.org/lojinha/Gente-que-ama-cachorro-branco.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/Gente-que-ama-cachorro-branco.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Gente que ama cachorro - fundo original: <br>
            <a href='http://gaarcampinas.org/lojinha/Gente-que-ama-cachorro.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/Gente-que-ama-cachorro.png' width='50%' heigth='50%'></a>
            <br><br>
            Caneca Gente que ama gatinhos - fundo branco: <br>
            <a href='http://gaarcampinas.org/lojinha/Gente-que-ama-gatinhos-branco.png' target='_blank'><img src='http://gaarcampinas.org/lojinha/Gente-que-ama-gatinhos-branco.png' width='50%' heigth='50%'></a>
            <br><br>";
} else {
            $message .="
            <br>
            <strong>Vasos</strong><br><i>Clique para aumentar</i><br><br>
            Vaso de cachorro marrom: <br>
            <a href='http://gaarcampinas.org/lojinha/Vaso-cachorro-marrom.JPG' target='_blank'><img src='http://gaarcampinas.org/lojinha/Vaso-cachorro-marrom.JPG' width='50%' heigth='50%'></a>
            <br><br>
            Vaso de cachorro pirata: <br>
            <a href='http://gaarcampinas.org/lojinha/Vaso-cachorro-pirata.JPG' target='_blank'><img src='http://gaarcampinas.org/lojinha/Vaso-cachorro-pirata.JPG' width='50%' heigth='50%'></a>
            <br><br>
            Vaso de cachorro preto: <br>
            <a href='http://gaarcampinas.org/lojinha/Vaso-cachorro-preto.JPG' target='_blank'><img src='http://gaarcampinas.org/lojinha/Vaso-cachorro-preto.JPG' width='50%' heigth='50%'></a>
            <br><br>
            Vaso de cachorro branco: <br>
            <a href='http://gaarcampinas.org/lojinha/Vaso-cachorro-branco.JPG' target='_blank'><img src='http://gaarcampinas.org/lojinha/Vaso-cachorro-branco.JPG' width='50%' heigth='50%'></a>
            <br><br>";
}
    
$message .="</p>
    </main>
    </body>
    <!--- BOOTSTRAP --->
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
    <!--- BOOTSTRAP --->
    </body>
    </html>";

$querynotify = "UPDATE VENDAS_PRODUTOS SET NOTIFICACAO='Sim' WHERE ID_EVENTO ='$idpedido'";
$resultnotify = mysqli_query($connect,$querynotify);

ini_set('display_errors', 1);
                
error_reporting(E_ALL);

$from = "lojinha@gaarcampinas.org";

$subject = "[GAAR Campinas] Pedido #".$idpedido."";
        	
$headers = "MIME-Version: 1.0\n";               
$headers .= "Content-type: text/html; charset=utf-8\n";            
$headers .= "From: <{$from}> \r\n";
$headers .= "Reply-To: <{$from}> \r\n";  
$headers .= "Bcc: lojinha@gaarcampinas.org\r\n";

$to = $emailfornec;

echo "<br> E-mail enviado para: ".$to;
echo "<br>".$message;

$result =  mail($to, $subject, $message, $headers);

if ($result){
    echo"<script language='javascript' type='text/javascript'>
    alert('E-mail enviado!');
    window.location.href='formpesquisavendaprod.php'</script>";
    echo "E-mail enviado para: ".$to;
} else {
    echo "Erro no envio";
}


/***** E-MAIL DE NOTIFICAÇÃO PARA O CLIENTE *****/

$subject = "[GAAR Campinas] Alteração de status do pedido #".$idpedido."";
$to = $email;
$message = "Olá! <br><br> Seu pedido número ".$idpedido." está sendo confeccionado.<br><br>
                             <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
		                     Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p>";
		                     
/*mail($to, $subject, $message, $headers);

/***** E-MAIL DE NOTIFICAÇÃO PARA O CLIENTE *****/



