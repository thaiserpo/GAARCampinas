<?php 
session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

$id = $_GET['id'];
$action = $_GET['action'];

$login = $_SESSION['login'];

$hoje = date("Y-m-d");
$data_atu = date("Y-m-d");
$mes_atu = date("m");
$ano_atu = date("Y"); 
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";
$fp = fopen($log_file, 'a');//opens file in write mode  

if ($login <>"") {
    $queryselect = "SELECT NOME, EMAIL FROM PROTETORES WHERE ID = '".$id."'";
    $select = mysqli_query($connect,$queryselect);
    $rc = mysqli_fetch_row($select);
    $nome = $rc[0];
    $email = $rc[1];
    
    if ($action == "u") {
        $queryupdate = "UPDATE PROTETORES SET SITUACAO='ATIVO' WHERE ID = '".$id."'"; 
        $log_file_msg="[alterarstatusprot.php] Protetor(a) ID ".$id." foi aprovado às ".$horaatu."\n";
        $statusparamailcastracao = "aprovado";
        $subject = "[GAAR Campinas] Seu cadastro foi aprovado!";
        $bodytext = "Olá ".$nome."<br><br> Seu cadastro foi aprovado no programa de castração do GAAR. <br>Para realizar pedidos, utilize seu ID: <strong><font color='red'>".$id.". LEIA ATENTAMENTE AS REGRAS DO PROGRAMA NO DOCUMENTO ANEXO</font></strong>. <br>Qualquer dúvida responda este e-mail.<br><br> Equipe GAAR.";
        $status_protetor = "ativo";
        
    } elseif ($action == "d") {
        $queryupdate = "UPDATE PROTETORES SET SITUACAO='INATIVO' WHERE ID = '".$id."'";
        $log_file_msg="[alterarstatusprot.php] Protetor(a) ID ".$id." foi reprovado às ".$horaatu."\n";
        $statusparamailcastracao = "reprovado";
        $subject = "[GAAR Campinas] Seu cadastro foi reprovado";
        $bodytext = "Olá ".$nome."<br><br> Seu cadastro foi reprovado no programa de castração do GAAR por não se enquadrar em nossas regras internas. <br>Qualquer dúvida responda este e-mail.<br><br> Equipe GAAR.";
        $status_protetor = "inativo";
    }
    $update = mysqli_query($connect,$queryupdate);
    
    mysqli_commit($connect);
    
    if(mysqli_errno($connect) == '0'){
        
            $log_file_msg ="[alterarstatusprot.php] Cadastro do protetor ID ".$id." - ".$nome." alterado para ".$status_protetor." por ".$login." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg); 
    
            $mail = new PHPMailer();
            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail*/
            $mail->Debugoutput = 'html';
            $mail->CharSet = 'UTF-8';
            $mail->SetFrom('castracao@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
            $mail->IsHTML(true);
            $to = $email;
            //$to = "thaise.piculi@gmail.com";
            $mail->AddAddress($to);
            $mail->AddBCC("thaise.piculi@gmail.com");
            if ($statusparamailcastracao == "aprovado"){
                $file_to_attach = '/home1/gaarca06/public_html/docs/administracao/regras_do_programa_de_castracao_do_gaar.pdf';
                $mail->addAttachment($file_to_attach, 'Regras do programa');    
            } else {
                $mail->clearAttachments();
            }
            
            $mail->Subject   = $subject;
            $mail->Body      = $bodytext;
                
            if (!$mail->send()) {
                $log_file_msg ="[alterarstatusprot.php] Erro no envio do e-mail ao protetor ".$to.": ".$mail->ErrorInfo." às ".$horaatu."\n";
                $fp = fopen($log_file, 'a');//opens file in append mode  
                fwrite($fp, $log_file_msg);  
            } else {
                $log_file_msg ="[alterarstatusprot.php] Envio do e-mail ao protetor ".$to." às ".$horaatu."\n";
                $fp = fopen($log_file, 'a');//opens file in append mode  
                fwrite($fp, $log_file_msg);
                $mail->clearAddresses();
                $to = "castracao@gaarcampinas.org";
                $mail->AddAddress($to);
                $mail->AddBCC("thaise.piculi@gmail.com");
                
                $subject = "[GAAR Campinas] Alteração de status do protetor ID ".$id."";
    
                $bodytext = "Olá voluntário, <br><br> O cadastro do protetor ID <strong><font color='red'>".$id." - ".$nome."</font></strong> foi ".$statusparamailcastracao." por ".$login." <br><br> <small> Este e-mail foi enviado automaticamente pelo sistema apenas para conhecimento.</small>";
                
                $mail->Subject   = $subject;
                $mail->Body      = $bodytext;
                $mail->send();
            }
            
            echo"<script type='text/javascript'>
                      if (confirm('Cadastro atualizado!')) {
                        window.history.go(-1);
                      }
                    </script>"; 
    }
}
fclose($fp); 
mysqli_close($connect);
?>