<?php 
session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');
require_once('/home1/gaarca06/public_html/area/fpdf/fpdf.php');
/*require("home1/gaarca06/public_html/PHPMailer/src/PHPMailer.php");
require("home1/gaarca06/public_html/PHPMailer/src/SMTP.php");*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$data_atu = date("Y-m-d");
$mes_atu = date("m");
$ano_atu = date("Y"); 
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";
$fp = fopen($log_file, 'a');//opens file in write mode  

$nomedoanimal = strtoupper($_POST['nomedoanimal']);
$dtnascanimal = $_POST['dtnascanimal'];
$especie = $_POST['especie'];
$caninaraca = $_POST['caninaraca'];
$felinaraca = $_POST['felinaraca'];
$sexo = $_POST['sexo'];
$obs = $_POST['obs'];
$volgaar = $_POST['volgaar'];
$nomevolgaar = $_POST['nomevolgaar'];
$vetcao = $_POST['vetcao'];
$vetgato = $_POST['vetgato'];
$vettodos = $_POST['vettodos'];
$melhordiahora = $_POST['horario'];
$obsmelhordiahora = $_POST['horariosim'];
$idprotetor = $_POST['idprotetor'];
$souprotetor = $_POST['souprotetor'];
$peso = $_POST['peso'];
$quemvailevar = $_POST['quemvailevar'];
$atingiu_cota = false;

if ($especie =="Canina") {
    if ($peso >'0' && $peso <='10') {
        $porte = "Pequeno";
    } 
    if ($peso >='11' && $peso <='25') {
        $porte = "Médio";
    }
    if ($peso >'25') {
        $porte = "Grande";
    } 
} else { // ESPÉCIE FELINA
    $porte = "N/A";
}

if ($especie =="Canina"){
    $raca = $caninaraca;
} else {
    $raca = $felinaraca;
}

$castracoes_protetor = "0";
$countprotetor = "0";

if ((strpos($nomedoanimal, 'SEM') !== false) ||(strpos($nomedoanimal, 'SEM NOME') !== false) || (strpos($nomedoanimal, 'GATO') !== false) || (strpos($nomedoanimal, 'GATA') !== false) || (strpos($nomedoanimal, 'CAO') !== false) || (strpos($nomedoanimal, 'CADELA') !== false) || (strpos($nomedoanimal, 'CACHORRO') !== false) || (strpos($nomedoanimal, 'CACHORRA') !== false) || (strpos($nomedoanimal, 'FILHOTE') !== false)) {
    $nome_animal_rand = rand(0,500);
    $nomedoanimal = $nomedoanimal." ".$nome_animal_rand;
}

if($vetcao <> ""){
   $tmpvet = $vetcao;
} elseif ($vetgato <> "") {
    $tmpvet = $vetgato;
} elseif ($vettodos <> "") {
    $tmpvet = $vettodos;
} 


$queryvet = "SELECT * FROM CLINICAS WHERE ID='$tmpvet'";
$selectvet = mysqli_query($connect,$queryvet); 
$rcvet = mysqli_fetch_row($selectvet);
$idvet = $rcvet[0];
$melhorvet = $rcvet[1];
$valor_gato = $rcvet[10];
$valor_gata = $rcvet[11];
$valor_caop = $rcvet[12];
$valor_caom = $rcvet[13];
$valor_caog = $rcvet[14];
$valor_cadelap = $rcvet[15];
$valor_cadelam = $rcvet[16];
$valor_cadelag = $rcvet[17];
$valor_gatoinala = $rcvet[32];
$valor_gatainala = $rcvet[33];
$valor_caopinala = $rcvet[34];
$valor_caominala = $rcvet[35];
$valor_caoginala = $rcvet[36];
$valor_cadelapinala = $rcvet[37];
$valor_cadelaminala = $rcvet[38];
$valor_cadelaginala = $rcvet[39];
$valorgato_prot = $rcvet[42];
$valorgata_prot = $rcvet[43];
$valorcao_prot = $rcvet[44];
$valorcadela_prot = $rcvet[45];
        
if ($souprotetor <> "Sim") {
    $souprotetor = "Não";
    $protetor = "NÃO";
    $idanimalgaar = 0;
    if ($idprotetor == ""){
        $idprotetor="0";
        $naoprotetor = true;
        $countprotetor = "Não";
    } 
}


if ($volgaar ==""){
    $volgaar = "Não";
}

if ($idprotetor <> "0"){
    $queryprot = "SELECT * FROM PROTETORES WHERE ID='$idprotetor' AND SITUACAO='ATIVO'";
    $selectprot = mysqli_query($connect,$queryprot); 
    $rc = mysqli_fetch_row($selectprot);
    $countprotetor = mysqli_num_rows($selectprot);
    
    if ($countprotetor <> "0"){
        $nomedotutor = $rc[1];
        $tmp_teldotutor = $rc[2];
        $emaildotutor = $rc[3];
        $bairro = $rc[4];
        $cidade= $rc[5];
        
        // VERIFICA SE HÁ AGENDAMENTOS APROVADOS PAGOS
        //$querycount = "SELECT * FROM PEDIDO_CASTRACAO WHERE ID_PROTETOR='$idprotetor' AND DATA_REG LIKE '".$ano_atu."-".$mes_atu."%'";
        $querycount = "SELECT * FROM AGENDAMENTO WHERE RESPONSAVEL='$nomedotutor' AND DATA_AG LIKE '".$ano_atu."-".$mes_atu."%' AND VALOR_AJUDA <>'0' AND ATIVO <> 'CANCELADO'";
        $selectcount = mysqli_query($connect,$querycount); 
        $castracoes_protetor = mysqli_num_rows($selectcount);
        
        // VERIFICA SE HÁ AGENDAMENTOS APROVADOS GRATUITOS
        //$querycountgratis = "SELECT * FROM PEDIDO_CASTRACAO WHERE ID_PROTETOR='$idprotetor' AND DATA_REG LIKE '".$ano_atu."-".$mes_atu."%'";
        $querycountgratis = "SELECT * FROM AGENDAMENTO WHERE RESPONSAVEL='$nomedotutor' AND DATA_AG LIKE '".$ano_atu."-".$mes_atu."%' AND VALOR_AJUDA ='0' AND ATIVO <> 'CANCELADO'";
        $selectcountgratis = mysqli_query($connect,$querycountgratis); 
        $castracoes_protetor_gratis = mysqli_num_rows($selectcountgratis);
        
        $queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE EMAIL='$emaildotutor'";
        $selectarea = mysqli_query($connect,$queryarea); 
        $rc = mysqli_fetch_row($selectarea);
        $area_gaar = $rc[0];
        
        $castracoes_totais = intval($castracoes_protetor) + intval($castracoes_protetor_gratis);
        //echo "<br> castracoes totais: ".$castracoes_totais;
        
        if ($castracoes_totais <= "8"){
            //echo "<br> cotas protetor gratis: ".$castracoes_protetor_gratis;
            if($_POST['castragratis'] == 'castragratis') { // Se a protetora escolheu cota grátis
                if (($idvet =='8' && $peso <='30' ) || $idvet =='2'){ // Se a protetora escolheu a DRA THAIS BAROZI (id 8) OU DRA DANIELA ALVES RABELLO (id 2)
                   switch ($especie){
                            case 'Canina':
                                if ($sexo=='Macho') {
                                   $valorajuda = $valorcao_prot;
                                } else {
                                   $valorajuda = $valorcadela_prot;
                                }
                                break;
                            case 'Felina':
                                if ($castracoes_protetor_gratis < "2"){ // E se ainda está dentro da cota grátis
                                    $valorajuda ="0";
                                    $obs .="<br>Castração gratuita dentro da cota";
                                }
                                else {
                                    if ($sexo=='Macho') {
                                       $valorajuda = $valorgato_prot;
                                    } else {
                                       $valorajuda = $valorgata_prot;
                                    }
                                }
                                break;
                                
                        }
                    switch ($idvet){
                        case '8':
                            if ($especie =='Canina') {
                                $obs .="<br><strong><font color='red'>ATENÇÃO: Procedimentos de castração de cães com a dra Thaís Barozi não entram na cota gratuita.</font></strong>";
                                $obstable .= "<br><strong>ATENÇÃO: Procedimentos de castração de cães com a dra Thaís Barozi não entram na cota gratuita.</strong>";    
                            }
                            break;
                        case '2':
                            if ($especie =='Canina') {
                                $obs .="<br><strong><font color='red'>ATENÇÃO: Procedimentos de castração de cães com a dra Daniela Rabello não entram na cota gratuita.</font></strong>";
                                $obstable .= "<br><strong>ATENÇÃO: Procedimentos de castração de cães com a dra Daniela Rabello não entram na cota gratuita.</strong>";
                            }
                            break;
                    }    
                    $mensagem_cotagratis = $obs;
                    
                  }elseif ($idvet <> '8') { // Se a protetora escolheu outra veterinária
                    if ($castracoes_protetor_gratis < "3"){ // E se ainda está dentro da cota grátis
                        $valorajuda ="0";
                        $obs .="<br>Castração gratuita dentro da cota";
                        $obstable .= $obs;
                    } elseif ($castracoes_protetor_gratis >= "2" && $castracoes_protetor_gratis <= "6"){ // E se não está dentro da cota grátis
                        //$valorajuda = $rcvet[2];
                        switch ($especie){
                            case 'Canina':
                                if ($sexo=='Macho') {
                                   $valorajuda = $valorcao_prot;
                                } else {
                                   $valorajuda = $valorcadela_prot;
                                }
                                break;
                            case 'Felina':
                                if ($sexo=='Macho') {
                                   $valorajuda = $valorgato_prot;
                                } else {
                                   $valorajuda = $valorgata_prot;
                                }
                                break;
                                
                        }
                        //$valorajuda = "60.00";
                        $mensagem_cotagratis = "<br> <center>Atenção: sua cota de pedidos de castrações gratuitas mensais foi atingida, o valor foi alterado. <br><strong>INFORMATIVO:</strong> Você já possui ".$castracoes_protetor_gratis." pedidos grátis e ".$castracoes_protetor." pedidos pagos no mês cadastrados no banco de dados.<br></center>";
                    }
                }
            } 
            else {
                if ($idvet =='8' && $peso <='30' && $especie == 'Canina'){ // Se a protetora escolheu a DRA THAIS BAROZI
                    if ($sexo=='Macho') {
                        $valorajuda = $valorcao_prot;
                    } else {
                       $valorajuda = $valorcadela_prot;
                    }
                    $obs .="<br>Procedimentos de castração de cães com a dra Thaís Barozi não entram na cota gratuita.";
                    $mensagem_cotagratis = $obs;
                    $obstable .= $obs;
                } else {
                    //$valorajuda = "60.00";
                    switch ($especie){
                            case 'Canina':
                                if ($sexo=='Macho') {
                                   $valorajuda = $valorcao_prot;
                                } else {
                                   $valorajuda = $valorcadela_prot;
                                }
                                break;
                            case 'Felina':
                                if ($sexo=='Macho') {
                                   $valorajuda = $valorgato_prot;
                                } else {
                                   $valorajuda = $valorgata_prot;
                                }
                                break;
                                
                        }
                }
            }
            $log_file_msg="[pedidocastra.php] Passou aqui 1 \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg);  
          } else  {
              $atingiu_cota = "Y";
              $mensagem_cotagratis = "<br> <center>Atenção: sua cota de pedidos de castrações mensais foi atingida, o valor foi alterado. <br><strong>INFORMATIVO:</strong> Você já possui ".$castracoes_protetor_gratis." pedidos grátis e ".$castracoes_protetor." pedidos pagos no mês cadastrados no banco de dados.<br></center>";
          }

} else {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>ID de protetor inválido.</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
 } 
} else {
    $idanimalgaar = $_POST['nomedoanimalgaar'];
    $nomedotutor = $_POST['nomedotutor'];
    $emaildotutor = $_POST['emaildotutor'];
    $tmp_teldotutor = $_POST['teldotutor'];
    $bairro= $_POST['bairrodotutor'];
    $cidade= $_POST['cidadedotutor'];
    $valorajuda = $_POST['valorajuda'];
    
    if ($idanimalgaar <> "0") {
        $querypetgaar= "SELECT * FROM ANIMAL WHERE ID='$idanimalgaar'";
        $selectpetgaar = mysqli_query($connect,$querypetgaar);
        $rcpetgaar = mysqli_fetch_row($selectpetgaar);
        $nomedoanimal = $rcpetgaar[1];
        $especie = $rcpetgaar[2];
        $dtnascanimal = $rcpetgaar[3];
        $sexo = $rcpetgaar[4];
        $porte = $rcpetgaar[6];
        $peso = $rcpetgaar[28]; 
    } else {
        $nomedoanimal = strtoupper($_POST['nomedoanimal']);
        $especie = $_POST['especie'];
        $dtnascanimal =  $_POST['dtnascanimal'];
        $sexo = $_POST['sexo'];
        $porte = $_POST['porte'];
        $peso = $_POST['peso'];
    }
    
    
}

$teldotutor_1 = str_replace("(", "", $tmp_teldotutor);
$teldotutor_2 = str_replace(")", "", $teldotutor_1);
$teldotutor_3 = str_replace("-", "", $teldotutor_2);
$teldotutor_4 = str_replace(" ", "", $teldotutor_3);
$teldotutor = $teldotutor_4;

function clean($string) {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.

       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
    
$phone = clean($teldotutor);

if ($volgaar == 'Não'){
$nomevolgaar = "Não";
}

if ($obs == ''){
$obs .= "0";
}

if ($melhordiahora =='Sim') {
$melhordiahora = $melhordiahora.",".$obsmelhordiahora;
}

$log_file_msg="[pedidocastra.php] Passou aqui 2 \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg);  
                    
if (!$atingiu_cota=="Y") {
    $log_file_msg="[pedidocastra.php] Não atingiu cota \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    if ($emaildotutor == '') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o e-mail</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] Email vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } elseif ($nomedoanimal == '') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o nome do animal</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] nome do animal vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } elseif ($dtnascanimal == '') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha a data de nascimento o animal</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] dt nasc vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } elseif ($especie == '') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha a espécie</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] especie vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } elseif ($peso == '') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o peso aproximado do animal</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] peso vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } elseif ($porte == '') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o porte do animal</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] porte vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } elseif ($sexo == '') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o sexo do animal</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] sexo vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } elseif ($nomedotutor == '') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o nome do tutor ou responsável</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] nome tutor vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } elseif ($tmp_teldotutor == '') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o telefone do tutor ou responsável</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] tmp tel tutor vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } elseif ($emaildotutor == '') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o e-mail do tutor ou responsável</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] email tutor vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } elseif ($cidade == '') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha a cidade</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] cidade vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } elseif ($tmpvet == '0') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o veterinário</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] vet vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } elseif ($melhordiahora == '') {
    echo "<center><h3>Ops! Algo deu errado...</h3><br>";
    echo "<p>Preencha o melhor dia e horário para o procedimento.</p><br>";
    echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
    $log_file_msg="[pedidocastra.php] melhor dia hora vazio \n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg); 
    } else {
        $query = "INSERT INTO PEDIDO_CASTRACAO
    		(NOME_ANIMAL, 
    		ESPECIE, 
    		SEXO, 
    		PORTE, 
    		DT_NASC, 
    		RESPONSAVEL, 
    		TELEFONE, 
    		EMAIL, 
    		VALOR_AJUDA, 
    		OBS, 
    		VOLUNTARIO_GAAR,
    		BAIRRO,
    		CIDADE,
    		STATUS_PEDIDO,
    		CLINICA,
    		MELHOR_DIA_HORA,
    		PESO,
    		ID_PROTETOR,
    		QUEM_LEVA,
    		CODIGO,
    		ID_GAAR) 
    		VALUES
            ('$nomedoanimal',
            '$especie',
            '$sexo',
            '$porte',
            '$dtnascanimal',
            '$nomedotutor',
            '$teldotutor',
            '$emaildotutor',
            '$valorajuda',
            '$obstable',
            '$nomevolgaar',
            '$bairro',
            '$cidade',
            '0',
            '$idvet',
            '$melhordiahora',
            '$peso',
            '$idprotetor',
            '$quemvailevar',
            '0',
            '$idanimalgaar')";
    
    $insert = mysqli_query($connect,$query); 
    
    mysqli_commit($connect);
            
    if(mysqli_errno($connect) == '0'){
         
         $getid = "SELECT MAX(ID) FROM PEDIDO_CASTRACAO WHERE RESPONSAVEL = '$nomedotutor' AND EMAIL = '$emaildotutor' AND NOME_ANIMAL = '$nomedoanimal' AND ESPECIE = '$especie' AND PORTE = '$porte' ";
    	 $id = mysqli_query($connect,$getid); 
    	 $fetch = mysqli_fetch_row($id);
    	 
    	 mysqli_commit($connect);
    	 
    	 $ano_nasc = substr($dtnascanimal,0,4);
         $mes_nasc = substr($dtnascanimal,5,2);
         $dia_nasc = substr($dtnascanimal,8,2);
    	 
    	 $idpedido = $fetch[0];
    	 
    	 $log_file_msg="[pedidocastra.php] Pedido de castração número ".$idpedido." foi realizado às ".$horaatu."\n";
         $fp = fopen($log_file, 'a');//opens file in append mode  
         fwrite($fp, $log_file_msg); 
         
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
         $mail->SetFrom('castracao@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
         $mail->IsHTML(true);
         $to = $emaildotutor;
         $mail->AddAddress($to);
         
         /* E-MAIL PARA O RESPONSÁVEL */
         $subject = "[GAAR Campinas] Pedido de castração recebido";
         
         $queryvet = "SELECT CLINICA FROM CLINICAS WHERE ID='$idvet'";
         $selectvet = mysqli_query($connect,$queryvet); 
         $rcvet = mysqli_fetch_row($selectvet);
         $vet = $rcvet[0];
         
         mysqli_commit($connect);
         
         $bodytext = "<html>
    	            <body style='font-family:verdana'>
    	                
    	                <h2>PEDIDO DE CASTRAÇÃO REALIZADO NO SITE - ID ".$idpedido."</h2>
    	                
    	                <table>
                            <tr>
                                <td align='left'>Nome </td>
                                <td align='left'>: ".$nomedoanimal."</td>
                            </tr>
                            <tr>
                                <td align='left'>Espécie </td>
                                <td align='left'>: ".$especie."</td>
                            </tr>
                            <tr>
                                <td align='left'>Raça </td>
                                <td align='left'>: ".$raca."</td>
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
                                <td align='left'>Peso </td>
                                <td align='left'>: ".$peso." kg</td>
                            </tr>
                            <tr>
                                <td align='left'>Data de nascimento </td>
                                <td align='left'>: ".$dia_nasc."/".$mes_nasc."/".$ano_nasc."</td>
                            </tr>
                            <tr>
                                <td align='left'>Protetor? </td>
                                <td align='left'>: ".$souprotetor."</td>
                            </tr>
                            <tr>
                                <td align='left'>ID do protetor </td>
                                <td align='left'>: ".$idprotetor."</td>
                            </tr>
                            <tr>
                                <td align='left'>Nome </td>
                                <td align='left'>: ".$nomedotutor."</td>
                            </tr>
                            <tr>
                                <td align='left'>Telefone para contato </td>
                                <td align='left'>: ".$teldotutor."</td>
                            </tr>
                            <tr>
                                <td align='left'>E-mail </td>
                                <td align='left'>: ".$emaildotutor."</td>
                            </tr>
                            <tr>
                                <td align='left'>Valor que consegue pagar </td>
                                <td align='left'>: R$".$valorajuda."</td>
                            </tr>
                            <tr>
                                <td align='left'>Voluntário do GAAR que intermediou </td>
                                <td align='left'>: ".$nomevolgaar."</td>
                            </tr>
                            <tr>
                                <td align='left'>Veterinária </td>
                                <td align='left'>: ".$idvet." - ".$vet."</td>
                            </tr>
                            <tr>
                                <td align='left'>Restrição de dia e/ou horário </td>
                                <td align='left'>: ".$melhordiahora."</td>
                            </tr>
                            <tr>
                                <td align='left'>Quem vai levar </td>
                                <td align='left'>: ".$quemvailevar."</td>
                            </tr>
                            <tr>
                                <td align='left'>Observações </td>
                                <td align='left'>: ".$obs."</td>
                            </tr>
                            <tr>
                                <td align='left' colspan='2'>".$mensagem_cotagratis."</td>
                            </tr>
                            <tr>
                                <td align='left' colspan='2'><strong><font color='red'>ATENÇÃO: ESSE E-MAIL NÃO É A AUTORIZAÇÃO DE CASTRAÇÃO, É APENAS UM E-MAIL INFORMATIVO. AGUARDE ORIENTAÇÕES DOS VOLUNTÁRIOS DO GAAR.</strong></font> </td>
                            </tr>
                        </table>";
         
         $mail->Subject   = $subject;
         $mail->Body      = $bodytext;
         
    	 if (!$mail->send()) {
            $log_file_msg="[pedidocastra.php] Erro de envio de pedido de castração: Mailer Error: " . $mail->ErrorInfo." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
         } else {
            $log_file_msg="[pedidocastra.php] Envio de pedido de castração para ".$to." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
         }
            
         $mail->clearAddresses();
         
         /* E-mail para o GAAR */
         $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
         $mail->IsHTML(true);
         $to = "castracao@gaarcampinas.org";
         $mail->AddAddress($to);
         //$mail->AddBCC("thaise.piculi@gmail.com");
         
     	 $subject = "[GAAR Campinas] Novo pedido de castração recebido";
    
    	 $bodytext .= " <br>
                        <p> Para autorizar e gerar o código, acesse o sistema: <br>
                        1. <a href='http://gaarcampinas.org/area/login.html'>Login</a><br>
                        2. Menu Operacional -> Aprovar solicitações<br><br>
                        Assim que gerado, o código vai ser enviado para o e-mail do tutor e do veterinário. Caso queira enviar o voucher por WhatsApp, clique nos botões disponíveis na tela do voucher.</p><br><br>
    	            </body>
    	            </html>
    	            <br><i><p>Este e-mail foi enviado automaticamente pelo sistema do GAAR. Versão BETA.</p></i>
    	 ";
    	 
    	 $mail->Subject   = $subject;
         $mail->Body      = $bodytext;
         
         if (!$mail->send()) {
            $log_file_msg="[pedidocastra.php] Erro de envio de pedido de castração: Mailer Error: " . $mail->ErrorInfo." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
            
            //$mail->clearAddresses();
         } else {
             if ($souprotetor == "Não") {
                echo "<center><h3>Pedido ".$idpedido." enviado com sucesso!</h3><br>";
                echo "<center><a href=\"javascript:window.history.go(-1)\" class=\"links\">Novo pedido</a></center>";
             } else {
                echo "<center><h3>Pedido ".$idpedido." enviado com sucesso! Você receberá as informações por e-mail</h3><br>";
                echo "<center><p>".$mensagem_cotagratis."</p><center><br>";
                echo "<p>Entraremos em contato via e-mail. <br><br> <i>OBS: Para garantir que os e-mails cheguem em sua caixa de entrada, sugerimos adicionar o e-mail <strong>castracao@gaarcampinas.org</strong> à lista de remetentes confiáveis. <br>Caso não adicionar, verifique sua caixa de SPAM dentro dos próximos dias</i></p>";
                echo "<center><strong>INFORMATIVO:</strong> Você já possui ".$castracoes_protetor_gratis." pedidos grátis e ".$castracoes_protetor." pedidos pagos no mês cadastrados no banco de dados."; 
                echo "<center><br><br><a href='https://www.gaarcampinas.org/area/formpedidocastraa.php' class='btn btn-primary'> Novo pedido </a></center>";    
             }
             $log_file_msg="[pedidocastra.php] Envio de pedido de castração número ".$idpedido." feito com sucesso às ".$horaatu."\n";
             $fp = fopen($log_file, 'a');//opens file in append mode  
             fwrite($fp, $log_file_msg);  
        }
        
    } else {
        if(mysqli_errno($connect) == '1062'){
            echo "<center><h3>Pedido já existente</h3><br>";
            echo "<center><p>Já existe um pedido para esse animal no sistema, por favor submeta um novo pedido. Obs: Por gentileza coloque um nome para o animal caso não tenha, se não quiser batizar com um nome utilize números. Por exemplo: GATO 1, GATO 2, GATO 3, etc.</p><center><br>";
            $log_file_msg="[pedidocastra.php] Erro no cadastro do pedido de castração: Insert code: ".$insert." - Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);  
            //echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Por favor, volte e preencha corretamente.</a>";
        } else {
            $log_file_msg="[pedidocastra.php] Erro no cadastro do pedido de castração: Insert code: ".$insert." - Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
            $fp = fopen($log_file, 'a');//opens file in append mode  
            fwrite($fp, $log_file_msg);
        }
      }
    }  
} else {
    echo "<br> <center>Atenção: sua cota de pedidos de castrações mensais foi atingida. Não será possível realizar mais pedidos este mês. <br><br><strong>INFORMATIVO:</strong> Você já possui ".$castracoes_protetor_gratis." pedidos grátis e ".$castracoes_protetor." pedidos pagos no mês cadastrados no banco de dados.<br></center>";
}

//if ($castracoes_protetor <= "3" && $countprotetor <> "0" && $naoprotetor == true){


fclose($fp);
mysqli_close($connect);

?>
