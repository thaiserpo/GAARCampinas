<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

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
$mail->SetFrom('castracao@gaarcampinas.org', 'GAAR Campinas'); //Name is optional

$data_atu = date("Y-m-d");
$ano_atu = date("Y");
$mes_atu = date("m");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$nome = $_POST['nome'];
$bairro = $_POST['bairro'];
$tmp_email = strtolower($_POST['email']);
$email = str_ireplace(" ","",$tmp_email);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$cidade = $_POST['cidade'];
$tmp_celular1 = $_POST['celular'];
$tmp_celular2 = str_ireplace("-","",$tmp_celular1);
$tmp_celular3 = str_ireplace("(","",$tmp_celular2);
$tmp_celular4 = str_ireplace(")","",$tmp_celular3);
$tmp_celular5 = str_ireplace(" ","",$tmp_celular4);
$celular = $tmp_celular5;
$areatuacao = $_POST['areatuacao'];
$linkredesocial = $_POST['linkredesocial'];

/*echo "<br> tmp mail: ".$tmp_email;
echo "<br> nome : ".$nome;
echo "<br> bairro: ".$bairro;
echo "<br> email: ".$email;
echo "<br> cidade: ".$cidade;
echo "<br> celular: ".$celular;*/

if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
    echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o e-mail corretamente</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
} elseif ($nome == "") {
    echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o seu nome</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
} elseif ($cidade == "") {
    echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
    echo "<p>Preencha a cidade</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
} elseif ($celular == "" || $celular == "0") {
    echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
    echo "<p>Preencha um celular válido</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
} elseif ($bairro == ""){
    echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o bairro</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
} elseif ($areatuacao == ""){
    echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
    echo "<p>Preencha a sua área de atuação.</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
} elseif ($linkredesocial == ""){
    echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o link de uma de suas redes sociais.</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
}elseif (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o e-mail corretamente</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
} else {
    
    $id = rand(0,500);
    
    $query = "INSERT INTO PROTETORES
    			(ID,
    			NOME, 
    			TELEFONE, 
    			EMAIL, 
    			BAIRRO, 
    			CIDADE,
    			AREA_ATUACAO,
    			LINK_REDES_SOCIAIS,
    			SITUACAO,
    			PROTETOR) 
    			VALUES
                ('$id',
                '$nome',
                '$celular',
                '$email',
                '$bairro',
                '$cidade',
                '$areatuacao',
                '$linkredesocial',
                'Esperando aprovação',
                'SIM')";
                
    $insert = mysqli_query($connect,$query); 
    
    if(mysqli_errno($connect) == '0'){
        
        $log_file_msg="[cadastro_protetor.php] Cadastro realizado com sucesso. ID: ".$id.", protetor ".$nome.", e-mail ".$email." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);
        
        $from ="castracao@gaarcampinas.org";
        
        $bodytext = "Olá ".$nome.", <br><br> Seu cadastro está esperando aprovação, pedimos que por gentileza aguarde. <br><br> Para dúvidas, escreva para castracao@gaarcampinas.org <br><br>";
        
        /*$bodytext = "Olá ".$nome.", <br><br> Segue o seu ID para solicitar castrações através do sistema do GAAR: <strong><font color='red'>".$id.".</font> ATENÇÃO: esse ID é pessoal e intransferível!</strong> <br><br> Para dúvidas, escreva para castracao@gaarcampinas.org <br><br>";
        
        $bodytext .="<p>O GAAR nasceu com o objetivo de castrar os animais de rua e/ou famílias carentes. <br>
                        Realiza castrações gratuitas SOMENTE para os animais sob a responsabilidade do Gaar.<br>
                        A Ong tem parceria com algumas clínicas veterinárias que realizam as castrações a um valor reduzido. <br>
                        Qualquer protetor independente poderá se beneficiar desses valores reduzidos. Veja os valores anexos. <br>
                        
                        Você, como protetor independente cadastrado no site do Gaar, poderá enviar um pedido de castração via e-mail. <br>
                        As solicitações serão aprovadas mediante análise da área operacional e financeira da ONG. <br>
                        O GAAR encaminha a um dos veterinários parceiros e ajuda a pagar o valor parcialmente. <br><br>
                        
                        Agora que você tem o seu ID, siga os passos:<br>
                        1º Passo: Preencher um formulário para cada animal. Observe os campos obrigatórios. Se algum campo estiver em branco o cadastro não será efetivado.<br>
                        https://gaarcampinas.org/area/formpedidocastraa.php<br><br>
                        
                        2º Passo: Após a aprovação do Operacional e do Financeiro, você receberá a Autorização via whatsapp ou email.<br><br>
                        
                        3º Passo: Você, como protetor responsável, se encarregará de encaminhar a Autorização ao Responsável, passando a seguinte informação: <br>
                        “Apresente essa Autorização na recepção da Clínica. Mostre através do celular. Nessa Autorização, consta: Data, horário, jejum, endereço da Clínica e valor a ser pago direto na clínica”.<br><br>
                        
                        <strong>Específico para a Clínica da Dra Daniela:</strong><br>
                        “Pagar em dinheiro ou Pix. Se for cartão de crédito terá uma taxa adicional do cartão”.<br><br>
                        
                        4º Passo: Acompanhar o pós-cirúrgico, explicando os procedimentos para aqueles de pouca instrução. <br>
                        •	O animal, logo que chega em casa, está ligeiramente anestesiado. É normal ficar quieto;<br>
                        •	Deixe-o deitado num local tranquilo para se recuperar;<br>
                        •	Deixe água disponível. Ele vai beber se quiser. Não forçar;<br>
                        •	Alimento poderá ser dado a partir do dia seguinte. A anestesia pode deixá-lo enjoado e sem vontade de comer;<br>
                        •	Vômitos são normais; Não se preocupe; <br>
                        •	Fazer a limpeza do local da cirurgia de acordo com as orientações do veterinário;<br>
                        •	Explicar como deve ser aplicado o medicamento, quando houver; <br>
                        •	Qualquer fato diferente desses, se comunicar urgente com o veterinário. <br>
                        •	Não faça nada diferente das orientações do veterinário, pois pode perder o direito dado por ele.<br>
                        
                        5º Passo: avisar a Ong que o animal foi castrado, ou mesmo sobre o seu estado de recuperação. <br><br>
                        </p>";
        */
        $subject = "[GAAR Campinas] Cadastro realizado com sucesso";              
        
        $mail->Subject   = $subject;
        $mail->Body      = $bodytext;
        $mail->IsHTML(true);
        $mail->AddAddress($email);
        
        if (!$mail->send()) {
            $log_file_msg="[cadastro_protetor.php] Erro de envio de e-mail para ".$email.": Mailer Error: " . $mail->ErrorInfo." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
        } else {
            $log_file_msg="[cadastro_protetor.php] Envio de notificação para ".$email." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
        }
        $mail->clearAddresses();
        
        /* ENVIO DE EMAIL PARA OS VOLUNTARIOS DE CASTRAÇÃO */
        
        $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
        
        $to ="castracao@gaarcampinas.org";
         
        $bodytext = "Olá voluntário! <br><br>O(a) protetor(a) ".$nome." se cadastrou no sistema para realizar pedidos de castrações. O ID é <strong><font color='red'>".$id."</font> É necessário autorizar o cadastro. .<br>";
        $bodytext .="Área de atuação: ".$areatuacao."<br> Link da rede social: ".$linkredesocial."";
        $subject = "[GAAR Campinas] Novo protetor cadastrado";
        
        $mail->Subject   = $subject;
        $mail->Body      = $bodytext;
        $mail->IsHTML(true);
        $mail->AddAddress($to);
        
        if (!$mail->send()) {
            $log_file_msg="[cadastro_protetor.php] Erro de envio de notificação de cadastro de protetor ".$email.": Mailer Error: " . $mail->ErrorInfo." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
        } else {
            $log_file_msg="[cadastro_protetor.php] Envio de notificação de cadastro de protetor para ".$to." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
        }
        
        //echo "<br> texto: ".$bodytext;
        
        /* E-MAIL PARA O RESPONSÁVEL */ 
    
        echo"<script language='javascript' type='text/javascript'>
        alert('Protetor cadastrado com sucesso!');
        window.location.href='formcadastro_protetores.php';</script>";
        
    }else{ 
        if(mysqli_errno($connect) == '1062'){
            $queryselectid = "SELECT ID,EMAIL FROM PROTETORES WHERE EMAIL='$email'";
            $selectid = mysqli_query($connect,$queryselectid);
            $tmpid = mysqli_fetch_row($selectid);
            
            $idprotetor = $tmpid[0];
            $emailprotetor = $tmpid[1];
            
            $bodytext = "Olá ".$nome.", <br><br> Segue o seu ID para solicitar castrações através do sistema do GAAR: <strong><font color='red'>".$idprotetor.".</font> ATENÇÃO: esse ID é pessoal e intransferível!</strong> <br><br> Para dúvidas, escreva para castracao@gaarcampinas.org <br><br>";
            
            $subject = "[GAAR Campinas] Reenvio de ID de protetor";              
        
            $mail->SetFrom('castracao@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
            $mail->Subject   = $subject;
            $mail->Body      = $bodytext;
            $mail->IsHTML(true);
            $mail->AddAddress($emailprotetor);
            
            if (!$mail->send()) {
                $log_file_msg="[cadastro_protetor.php] Erro de envio de notificação de cadastro de protetor para cadastro duplicado: Mailer Error: " . $mail->ErrorInfo." - e-mail ".$email." às ".$horaatu."\n";
                $fp = fopen($log_file, 'a');//opens file in append mode  
                fwrite($fp, $log_file_msg);  
            } else {
                $log_file_msg="[cadastro_protetor.php] Envio de notificação de cadastro de protetor para ".$emailprotetor." às ".$horaatu."\n";
                $fp = fopen($log_file, 'a');//opens file in append mode  
                fwrite($fp, $log_file_msg);  
            }
            
             echo"<script language='javascript' type='text/javascript'>
             alert('Você já possui ID. Ele foi reenviado para o e-mail cadastrado');
			 window.location.href='formcadastro_protetores.php'</script>";
    
        }
    	//echo "Insert code: ".$insert;
    	echo "Mensagem de erro: ".mysql_error(). "SQL Error: ".mysql_errno();
    	echo "Erro ao cadastrar <br><br>";
    	$log_file_msg="[cadastro_protetor.php] Erro de cadastro de protetor ".$nome." - e-mail:".$email." - telefone: ".$celular." : Mensagem de erro: ".mysql_error(). "SQL Error: ".mysql_errno()." às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);  
    	echo "<a href='formcadastro_protetores.php'>Voltar</a>";
      echo"<script language='javascript' type='text/javascript'>
      alert('Erro ao cadastrar');window.location
      .href='formcadastro_protetores.php'</script>";
    }

}
fclose($fp); 
mysqli_close($connect);
?>
