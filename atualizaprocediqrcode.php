<?php 
session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('operacional@gaarcampinas.org', 'GAAR Campinas'); //Name is optional

$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");
$ano_atu = date("Y");
$mes_atu = date("m");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$codprocedi = $_POST['codprocedi'];
$idvet = $_POST['idvet'];

echo "<br> cod procedi: ".$codprocedi;
echo "<br> id vet: ".$idvet;


$query_verify = "SELECT * FROM AGENDAMENTO WHERE CODIGO='$codprocedi' AND CLINICA='$idvet' ";
$result_verify = mysqli_query($connect,$query_verify);
$rc = mysqli_fetch_row($result_verify);
$realizado = $rc[24];
$rc_verify= mysqli_num_rows($result_verify);	

$log_file_msg="[atualizaprocediqrcode.php] Registros encontrados para o select query_verify: ".$rc_verify." às ".$horaatu."\n";
$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  

if ($rc_verify <>'0' && $realizado='NÃO') {
    $query_agenda = "UPDATE AGENDAMENTO
                    SET REALIZADO='SIM'
                    WHERE CODIGO='$codprocedi' AND CLINICA='$idvet'";
                    
    $update_agenda = mysqli_query($connect,$query_agenda);
    
    mysqli_commit($connect);
    
    if(mysqli_errno($connect) == '0'){
        $log_file_msg="[atualizaprocediqrcode.php] Procedimento ".$codprocedi." atualizado para REALIZADO='SIM' pela clínica ".$idvet." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);  
        
        $mail = new PHPMailer();
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail*/
        $mail->Debugoutput = 'html';
        $mail->CharSet = 'UTF-8';
        $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
        $mail->IsHTML(true);
        $to = "castracao@gaarcampinas.org";
        //$to = "thaise.piculi@gmail.com";
        $mail->AddAddress($to);
        //$mail->AddBCC("thaise.piculi@gmail.com");
        
        $subject = "[GAAR Campinas] Agendamento ".$codprocedi." foi confirmado pela clínica";
        
        $bodytext ="Olá voluntários, <br><br> O agendamento ".$codprocedi." foi confirmado pela clínica. <br>";
        
        $mail->Subject   = $subject;
        $mail->Body      = $bodytext;
        
        if (!$mail->send()) {
            $log_file_msg ="[atualizaprocediqrcode.php] Erro no envio do e-mail para ".$to.": ".$mail->ErrorInfo." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
        } else {
            $log_file_msg ="[atualizaprocediqrcode.php] Envio do e-mail de confirmação para ".$to." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);
            $mail->clearAddresses();
            echo"<script type='text/javascript'>
              if (confirm('Procedimento atualizado!')) {
                window.close();
              }
            </script>"; 
        }
            
                        
        
        /*    
        echo"<script type='text/javascript'>
              if (confirm('Procedimento atualizado!')) {
                window.close;
                window.history.go(-1);
              }
            </script>";  */
    }
} else {
    echo "<center><br><p>ID inválido para este procedimento ou o procedimento já foi realizado.<a href=\"javascript:window.history.go(-1)\" class=\"links\"><br>Por favor, volte e preencha corretamente.</p></center>";
}
	
/*
ini_set('display_errors', 1);

error_reporting(E_ALL);

$from ="contato@gaarcampinas.org";

$to = "castracao@gaarcampinas.org";

$subject = "Procedimento número ".$id." foi atualizado por ".$clinica."";

$headers = "MIME-Version: 1.0\n";               
$headers .= "Content-type: text/html; charset=utf-8\n";            
$headers .= "From: <{$from}> \r\n"; 
$message = "Olá Diretoria Operacional, <br><br>

            <p> Houve alguma correção de informação para o procedimento número ".$id.". <br><br>
            
            
            <B>DADOS DO PROCEDIMENTO</B> <br><br>
                    
                    <table>
                    <tr>
                        <td align='left'>Nome do animal </td>
                        <td align='left'>: ".$nomedoanimal."</td>
                    </tr>
                    <tr>
                        <td align='left'>Espécie </td>
                        <td align='left'>: ".$especie."</td>
                    </tr>
                    <tr>
                        <td align='left'>Sexo </td>
                        <td align='left'>: ".$sexo."</td>
                    </tr>
                    <tr>
                        <td align='left'>Porte </td>
                        <td align='left'>: ".$porte."</td>
                    </tr>
                    <tr>
                        <td align='left'>Nome do tutor </td>
                        <td align='left'>: ".$nomedotutor."</td>
                    </tr>
                    <tr>
                        <td align='left'>Procedimento</td>
                        <td align='left'>: ".$tipoprocedi."</td>
                    </tr>
                    <tr>
                        <td align='left'>Quantidade</td>
                        <td align='left'>: ".$qtde."</td>
                    </tr>
                    <tr>
                        <td align='left'>Valor pago pelo tutor ou responsável</td>
                        <td align='left'>: R$ ".number_format($valortutor,2,',', '.')."</td>
                    </tr>
                    <tr>
                        <td align='left'>Valor a ser cobrado do GAAR</td>
                        <td align='left'>: R$ ".number_format($valorgaar,2,',', '.')."</td>
                    </tr>
                    <tr>
                        <td align='left'>Data</td>
                        <td align='left'>: ".$data."</td>
                    </tr>
                    <tr>
                        <td align='left'>Clínica ou vet</td>
                        <td align='left'>: ".$clinica."</td>
                    </tr>
                    <tr>
                        <td align='left'>Observações</td>
                        <td align='left'>: ".$obs."</td>
                    </tr>
                    </table>
                    
                    <br>
                    
    
            Para consultar todos os procedimentos, acesse:<br>
            
            1. <a href='http://gaarcampinas.org/area/login.html' target=_blank> Área restrita</a><br>
            2. Menu Operacional<br>
            3. Menu Pesquisar procedimentos<br><br>
            
            * Esta notificação foi gerada automaticamente através do sistema *</p>";



// CÓPIA PARA A CLINICA 

$from ="operacional@gaarcampinas.org";

//$to = $emailvol;

$subject = "[GAAR Campinas] Procedimento número ".$id." foi atualizado";

$headers = "MIME-Version: 1.0\n";               
$headers .= "Content-type: text/html; charset=utf-8\n";            
$headers .= "From: <{$from}> \r\n"; 
$message = "Olá ".$clinica.", <br><br>

            <p> O procedimento número ".$id." foi atualizado. <br><br>
            
            
            <B>DADOS DO PROCEDIMENTO</B> <br><br>
                    
                    <table>
                    <tr>
                        <td align='left'>Nome do animal </td>
                        <td align='left'>: ".$nomedoanimal."</td>
                    </tr>
                    <tr>
                        <td align='left'>Espécie </td>
                        <td align='left'>: ".$especie."</td>
                    </tr>
                    <tr>
                        <td align='left'>Sexo </td>
                        <td align='left'>: ".$sexo."</td>
                    </tr>
                    <tr>
                        <td align='left'>Porte </td>
                        <td align='left'>: ".$porte."</td>
                    </tr>
                    <tr>
                        <td align='left'>Nome do tutor </td>
                        <td align='left'>: ".$nomedotutor."</td>
                    </tr>
                    <tr>
                        <td align='left'>Procedimento</td>
                        <td align='left'>: ".$tipoprocedi."</td>
                    </tr>
                    <tr>
                        <td align='left'>Quantidade</td>
                        <td align='left'>: ".$qtde."</td>
                    </tr>
                    <tr>
                        <td align='left'>Valor pago pelo tutor ou responsável</td>
                        <td align='left'>: R$ ".number_format($valortutor,2,',', '.')."</td>
                    </tr>
                    <tr>
                        <td align='left'>Valor a ser cobrado do GAAR</td>
                        <td align='left'>: R$ ".number_format($valorgaar,2,',', '.')."</td>
                    </tr>
                    <tr>
                        <td align='left'>Data</td>
                        <td align='left'>: ".$data."</td>
                    </tr>
                    <tr>
                        <td align='left'>Observações</td>
                        <td align='left'>: ".$obs."</td>
                    </tr>
                    </table>
                    
                    <br>
                    
    
            Para consultar todos os procedimentos, acesse:<br>
            
            1. <a href='http://gaarcampinas.org/area/login.html' target=_blank> Área restrita</a><br>
            2. Menu Procedimentos<br>
            3. Menu Consultar<br><br>
            
            * Esta notificação foi gerada automaticamente através do sistema *</p>";

//mail($to, $subject, $message, $headers);

foreach ($_POST as $key => $value) {
    ${$key} = $value;
    $_SESSION[$key] = $value;
}



}
else{
	echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
              echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
              echo "<a href='formpesquisaagenda.php' class='btn btn-primary'>Voltar</a></center><br>";
}
}
*/
mysqli_close($connect);
?>
