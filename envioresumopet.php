<?php 
		
/* conexao do banco de dados */
session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$ano_atu = date('Y');
$mes_atu = date('m');
$dia_atu = date('d');
$weekday = date('w');
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$parm = $_GET['action'];

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
$mail->IsHTML(true);
$log_file_msg = "";

$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);

if ($parm == "resend") {
    if ($weekday == '6'){
        $dia_prox = $dia_atu; 
    } else {
        $dia_prox = date('d',strtotime('next Saturday')); 
        $mes_atu = date('m',strtotime('next Saturday'));    
    }
} else {
    $dia_prox = date('d',strtotime('+1 day'));
}

$queryfeira = "SELECT * FROM EVENTOS WHERE DATA LIKE '".$ano_atu."-".$mes_atu."-".$dia_atu."' AND NOME_EVENTO='Feira de adoção'";
//$queryfeira = "SELECT * FROM EVENTOS WHERE DATA LIKE '".$ano_atu."-".$mes_atu."-".$dia_prox."' AND NOME_EVENTO='Feira de adoção'";
$resultfeira = mysqli_query($connect,$queryfeira);
$reccountfeira = mysqli_num_rows($resultfeira);
$rc = mysqli_fetch_row($resultfeira);
$idevento = $rc[0];
$desc = $rc[1];
$local = $rc[3];
$data = $rc[4];

$query_petfeira = "SELECT ID_ANIMAL FROM ANIMAIS_FEIRAS WHERE ID_FEIRA='$idevento'";
$result_petfeira = mysqli_query($connect,$query_petfeira);
$reccountpet = mysqli_num_rows($result_petfeira);

if ($reccountfeira <> '0' && $reccountpet <> '0') {
    
$ano_feira = substr($data,0,4);
$mes_feira = substr($data,5,2);
$dia_feira = substr($data,8,2);

$data_feira_jul = gregoriantojd($mes_feira,$dia_feira,$ano_feira);

$dias = intval($data_atu_jul) - intval($data_feira_jul);

 $bodytext = "<!DOCTYPE html>
    <html lang='pt-br'>
    <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
    
    <link rel='stylesheet' type='text/css' href='style-area.css'/>
    
    <link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>
    
    <link href='https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css' rel='stylesheet'>

    <script src='https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js'></script>
    <script src='https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/auto-refresh/bootstrap-table-auto-refresh.min.js'></script>
    <!--- BOOTSTRAP 
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <!--- BOOTSTRAP --->
    <!-- Bootstrap 5.1 -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>
    
    <!-- Bootstrap 5.1 -->
    
    </head>
    
    <body>
    <font face='verdana'> 
    <div class='d-none d-print-block'>
    <center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center>
    </div>
    <center>
        <h2>RESUMO DOS PETS</h2><br>
    </center>
    
    <br><br>";
	
	while ($fetch_petfeira = mysqli_fetch_row($result_petfeira)) {
	    
	    $idpet = $fetch_petfeira[0];
	    
	    echo "<br> id pet: ".$idpet;
	
        $macho = false;
        $femea = false;
        
        $query = "SELECT * FROM ANIMAL WHERE ID = '$idpet' ORDER BY ID DESC";
        $select = mysqli_query($connect,$query);
        $rc = mysqli_fetch_row($select);

		$idanimal = $rc[0];	
		$nomedoanimal = $rc[1];
		$idade = $rc[3];
		$especie = $rc[2];
		$porte = $rc[6];
		$sexo = $rc[4];
		$castracao = $rc[7];
		$vacinacao = $rc[9];
		$status = $rc[10];
		$textopet = $rc[15];
		$foto = $rc[16];
		$foto_2 = $rc[31];
		$foto_3 = $rc[32];
		$foto_4 = $rc[33];
		$peso = $rc[28];
		$perfil_outrosanimais = $rc[34];
        $perfil_criancas = $rc[35];
        $perfil_apto = $rc[36];
        $obs_apadrinha = $rc[39];
        $video = $rc[41];
        $divulgar_como = $rc[18];
        $resp = $rc[12];
        $email = $rc[17];
        $idade_jul = $rc[29];
		
		$ano_nascimento = substr($idade,0,4);
	    $mes_nascimento = substr($idade,5,2);
	    $dia_nascimento = substr($idade,8,2);
	    
	    //$idade = $dia_nascimento."/".$mes_nascimento."/".$ano_nascimento;
	    
        $bodytext .="<img src='https://gaarcampinas.org/pets/".$idanimal."/".$foto."' class='img-fluid' style='width: 30%; height: 30%;'>";
        
	    $bodytext .="<br><br>Nome do animal: ".$nomedoanimal."<br><br>";

        $bodytext .= $textopet."<br><br>";
        
        if ($sexo == 'Macho') {
            $macho = true;
            $temp = "adotado";
        } else {
            $femea = true;
            $temp = "adotada";
        }
        
        if ($vacinacao == 'Sim'){
            if ($macho == true) {
                $vacinado = 'Estou vacinado';  
            } else {
                $vacinado = 'Estou vacinada';
            }
        } else{ 
            if ($macho == true) {
                $vacinado = 'Não estou vacinado';  
            } else {
                $vacinado = 'Não estou vacinada';
            }
        }
        
        if ($perfil_outrosanimais == 'Não'){
            $perfil_outrosanimais="Não convivo bem com outros animais";
        } else {
            $perfil_outrosanimais="Convivo bem com outros animais";
        }
        
        if ($perfil_criancas == 'Não'){
             $perfil_criancas = "Não convivo bem com crianças";
        } else {
            $perfil_criancas="Convivo bem com crianças";
        }
        
        if ($perfil_apto == 'Sim'){
            $perfil_apto="Vivo bem em apartamento";
        } else {
            $perfil_apto="Não vivo bem em apartamento";
        }
        
        $ts1 = strtotime($idade);
        $ts2 = strtotime($data_atu);
        
        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);
        
        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);
        
        $meses = (($year2 - $year1) * 12) + ($month2 - $month1);
        
        $idade = round(($meses)/12);
        
        if ($idade == '1') {
            $idade = $idade." ano";
            
        } elseif ($idade > '1') {
            $idade = $idade." anos";
        } elseif ($idade < '1') {
            $idade = $meses." meses";
        }
        
        if ($castracao == 'Sim'){
            if ($macho == true) {
                $castracao = 'castrado';  
            } else {
                $castracao = 'castrada';
            }
        } else{ 
           if ($macho == true) {
                $castracao = 'não fui castrado ainda por causa da minha idade';  
            } else {
                $castracao = 'não fui castrada ainda por causa da minha idade';
            }
        }
            
        if ($especie == 'Felina') {
            $bodytext .= " <p> Mais um pouquinho sobre mim: <br><br>
                🔹 Sou ".$sexo." <br>
                🔹 ".$vacinado." e ".$castracao." <br>
                🐾 ".$perfil_outrosanimais."<br>
                💙 ".$perfil_criancas."<br>
                🏠 ".$perfil_apto." <br>
                🎂 Tenho aproximadamente ".$idade." <br>
                🌐 Link do meu perfil: <a href='http://gaarcampinas.org/pet.php?id=".$idpet."'>http://gaarcampinas.org/pet.php?id=".$idpet."</a> <br><br>
                ";
        } else {
            $bodytext .= " <p> Mais um pouquinho sobre mim: <br><br>
                🔹 Sou ".$sexo." e porte ".strtolower($porte)." <br>
                🔹 Peso aproximadamente ".$peso." kg <br>
                🔹 ".$vacinado." e ".$castracao." <br>
                🐾 ".$perfil_outrosanimais."<br>
                💙 ".$perfil_criancas."<br>
                🏠 ".$perfil_apto." <br>
                🎂 Tenho aproximadamente ".$idade." <br>
                🌐 Link do meu perfil: <a href='http://gaarcampinas.org/pet.php?id=".$idpet."'>http://gaarcampinas.org/pet.php?id=".$idpet."</a> <br><br>
                ";
        }
        
        $bodytext .="<br>---------------------------------------------------------------------------------------<br>";
	}

$bodytext .= " <br><br>
    	                  
    	                  <p><center><strong>OBSERVAÇÕES</strong><br><i> Todos os dados apresentados foram coletados do banco de dados do GAAR.<br></i></center><br><br>
                          </font>
                          </body>
                          </html>";
  
$bodytext .= "  <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
                <!--<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>-->
                <!--- BOOTSTRAP --->
                </font>
                </body>
                </html>

            ";
            
$subject = "Resumo pet da feira ".$dia_feira."-".$mes_feira."-".$ano_feira."";

$mail = new PHPMailer();
/*$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail*/
$mail->IsHTML(true);
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
$mail->Subject   = $subject;
$mail->Body      = $bodytext;
$mail->IsHTML(true);
$to = "contato@gaarcampinas.org";
$mail->AddAddress($to);

$lista_email .=$to;

$queryvol = "SELECT EMAIL FROM VOLUNTARIOS WHERE EMAIL <> '' AND STATUS_APROV ='Aprovado' AND SUBAREA='feira' AND EMAIL <>'0'";
//$query = "SELECT EMAIL FROM VOLUNTARIOS WHERE EMAIL = 'thaise.piculi@gmail.com'";
$selectvol = mysqli_query($connect,$queryvol);

while ($fetchvol = mysqli_fetch_row($selectvol)) {
    $to_vol =$fetchvol[0];
    //$mail->AddBCC($to_vol);
    //$mail->AddAddress($to_vol);
    $lista_email .=", ".$to_vol;
}


$mail->AddBCC("thaise.piculi@gmail.com");

if (!$mail->send()) {
    $log_file_msg="[envioresumopet.php] Erro de envio de resumo pet pra feira: Mailer Error: " . $mail->ErrorInfo." às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);  
} else {
    $log_file_msg="[envioresumopet.php] Resumo pet da feira ".$dia_atu."-".$mes_atu."-".$ano_atu."  enviado à ".$lista_email." às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg); 
    /*if ($parm =="resend"){
        echo"<script language='javascript' type='text/javascript'>
            window.close();</script>";
    }*/
}

$mail->clearAddresses();
fclose($fp);
    
} else {
    $log_file_msg="[envioresumopet.php] Resumo pet da feira executado e não enviado pois não há eventos ou não há pets cadastrados às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg);
}

mysqli_close($connect);
		
		
?>
