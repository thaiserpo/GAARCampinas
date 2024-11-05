<?php 
//GERA PDF DO AGENDAMENTO
session_start();

include ("conexao.php");

require_once('/home1/gaarca06/public_html/area/dompdf/autoload.inc.php');
require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

$ano_atu = date("Y");
$ano_atu_2bytes = substr($ano_atu,2,4);
$data_atu = date("Y-m-d");
$mes_atu = date("m");
$mes_prox = date("m",strtotime('+1 month'));
$ano_atu_log = date("Y"); 
$data_atu_2 = date("d-m-Y");
$horaatu = date("H:i:s");
//$dia_expiracao = date('Y-m-d', strtotime("+2 days"));

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu_log.$mes_atu."/log-".$data_atu.".txt";
$fp = fopen($log_file, 'a');//opens file in write mode 
    
// reference the Dompdf namespace
use Dompdf\Dompdf;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
    
    $queryarea = "SELECT AREA,NOME FROM VOLUNTARIOS WHERE USUARIO ='$login'";
	$selectarea = mysqli_query($connect,$queryarea);
	
	while ($fetcharea = mysqli_fetch_row($selectarea)) {
			$area = $fetcharea[0];
			$nome = $fetcharea[1];
	}

    $idpedido = $_POST['idpedido'];
    $datamulti = $_POST['dataprocedi'];
    $horamulti = $_POST['horaprocedi'];
    $procedimento = $_POST['tipoproc'];
    $nomedoanimal = $_POST['nomedoanimal'];
    $dtnasc = $_POST['dtnasc'];
    $especie = $_POST['especie'];
    $sexo = $_POST['sexo'];
    $porte = $_POST['porte'];
    $peso = $_POST['peso'];
    $idprotetor = $_POST['idprotetor'];
    $respanimal = $_POST['nomeresp'];
    $telresp = $_POST['telresp'];
    $emailresp = $_POST['emailresp'];
    $valorajuda = $_POST['valorajuda'];
    $autorizacao = $_POST['volgaar'];
    $idvet = $_POST['idvet'];
    $inalatoria = $_POST['inalatoria'];
    $quemleva = $_POST['quemleva'];
    $txtvalorajuda = $_POST['txtvalorajuda'];
    $valorgaar = $_POST['valorgaar'];
    $valorgaar_novo = $_POST['valorgaar_novo'];
    $valoradicional = $_POST['valoradicional'];
    $idanimaldogaar = $_POST['idanimaldogaar'];
    $action = $_POST['action']; //u= update | i=insert
    $ativo = $_POST['ativo'];
    $realizado = $_POST['realizado'];
    //$codprocedi = $_POST['codprocedi']; //vem do formatualizaprocedi.php
    $extra = 0;
    $produtos = $_POST['produtos'];
    $obs = $_POST['obs'];
    $obsgaar = $_POST['obsgaar'];
    $codigoautoriza = $_POST['codigoautoriza'];
    $reenvio = $_POST['reenvio'];
    $idprocedi = $_POST['idprocedi'];
    $idprocedidb = $_POST['idprocedidb'];
    
    //echo "<br> action: ".$action;
    //echo "<br> data ag: ".$datamulti;
    //echo "<br> codprocedi: ".$codigoautoriza;
    
    if ($idanimaldogaar == ""){
        $idanimaldogaar = 0;
    }
    if ($action ==""){
        $action="i"; //insert record
    } 
    
    if ($ativo ==""){
        $ativo = "SIM";
    } 
    
    if ($realizado ==""){
        $realizado = "NÃO";
    }
    
    if ($action=="i") {
        if(isset($_POST['gaarnaocastra']) && $_POST['gaarnaocastra'] == 'gaarnaocastra') {
            $valorgaar = "0";
        } else {
           if ($valorgaar_novo <> "0") {
                $valorgaar = $valorgaar_novo;
            }  
        }    
    }
    
    if ($valorgaar < "0" || $valorgaar == ""){
        $valorgaar = 0;
    }
    if ($valoradicional <> "0") {
        $valorajuda = floatval($valorajuda) + floatval($valoradicional);     
    }
    
    $tmp_obs = $obs."<br>".$obsgaar;
    
    $words = explode(" ", $autorizacao);
    $siglanome = "";
    
    foreach ($words as $w) {
      $siglanome .= $w[0];
    }
    // dra Fabiana Caociencia
    /*if ($tmp_idvet =='4' || $tmp_idvet =='58') {
        $idvet = "4";
    } elseif ($tmp_idvet =='5' || $tmp_idvet =='57') {  //dra Maira
        $idvet = "5";
    } else {
        $idvet = $tmp_idvet;
    }*/

    if ($action == "i") { //novo agendamento
        $getidvet = "SELECT MAX(ID_PROCEDIMENTO) FROM AGENDAMENTO WHERE CLINICA='$idvet'";
    	$result = mysqli_query($connect,$getidvet);
        $rc = mysqli_fetch_row($result);
        $maxid = $rc[0];
    	$novoid = intval($maxid) + 1;
    	$codprocedi = $ano_atu_2bytes."-".$idvet.$siglanome.$novoid;
    	
    	$getidprocedidb = "SELECT MAX(ID) FROM AGENDAMENTO ORDER BY ID DESC";
    	$resultidprocedidb = mysqli_query($connect,$getidprocedidb);
        $rcidprocedidb = mysqli_fetch_row($resultidprocedidb);
        $maxidprocedidb = $rcidprocedidb[0];
    	$idprocedidb = intval($maxidprocedidb) + 1;
    	
    } else { //atualização de agendamento
      $codprocedi = $codigoautoriza;  
    }
    
    $log_file_msg="[cadastroagenda.php] Action ".$action." com o código ".$codigoautoriza." feito por ".$login." às ".$horaatu."\n";
    $fp = fopen($log_file, 'a');//opens file in append mode  
    fwrite($fp, $log_file_msg); 

    $queryvet = "SELECT * FROM CLINICAS WHERE ID='$idvet'";
    $selectvet = mysqli_query($connect,$queryvet);
    $rc = mysqli_fetch_row($selectvet);
    $reccount = mysqli_num_rows($selectvet);
	
    if ($reccount != '0') {
        $nomevet = $rc[1];
    	$endvet = $rc[2];
    	$numvet = $rc[3];
    	$bairrovet = $rc[4];
    	$cidadevet = $rc[6];
    	$telvet = $rc[7];
    	$emailvet = $rc[9];
    	$valor_gato = $rc[10];
    	$valor_gata = $rc[11];
    	$valor_caop = $rc[12];
    	$valor_caom = $rc[13];
    	$valor_caog = $rc[14];
    	$valor_cadelap = $rc[15];
        $valor_cadelam = $rc[16];
        $valor_cadelag = $rc[17];
    	$valor_gatoinala = $rc[32];
    	$valor_gatainala = $rc[33];
    	$valor_caopinala = $rc[34];
        $valor_caominala = $rc[35];
        $valor_caoginala = $rc[36];
        $valor_cadelapinala = $rc[37];
        $valor_cadelaminala = $rc[38];
        $valor_cadelaginala = $rc[39];
        $valorgato_prot = $rcvet[42];
        $valorgata_prot = $rcvet[43];
        $valorcao_prot = $rcvet[44];
        $valorcadela_prot = $rcvet[45];
    	
    	$tmp_dia_expiracao = new DateTime($datamulti);
    	
    	$tmp_dia_expiracao->modify('+1 days');
    	
    	$dia_expiracao = $tmp_dia_expiracao->format('Y-m-d');
    	
    	if ($idvet =="26" || $novoid=="") { //CLINICA TESTE DA THAISE
    	    $novoid = "0";
    	}
    	
    	if ($action=="i") {
        //CASO TENHA O MESMO CODIGO COM OS MESMOS DADOS PARA O MESMO ANIMAL MAS ESTÁ CANCELADO, IRÁ EXCLUIR
    	    $prequery = "DELETE FROM AGENDAMENTO WHERE CODIGO='$codprocedi' AND ATIVO='CANCELADO'";
    	    $prequerydelete = mysqli_query($connect,$prequery); 
    	    
    	    $queryi = "INSERT INTO AGENDAMENTO
        			(CODIGO, 
        			DATA_AG, 
        			HORA_AG, 
        			NOME_ANIMAL, 
        			ESPECIE, 
        			SEXO, 
        			PORTE,
        			PESO,
        			DATA_NASC, 
        			RESPONSAVEL,
        			AUTORIZADO_POR,
        			TEL_CONTATO,
        			EMAIL_RESPONSAVEL,
        			VALOR_AJUDA,
        			PRODUTOS,
        			OBS,
        			ATIVO,
        			CLINICA,	
        			PROCEDIMENTO,
        			ID_PROCEDIMENTO,
        			ID_GAAR,
        			ID_PROTETOR,
        			QUEM_LEVA,
        			REALIZADO,
        			EXPIRA_EM,
        			EXTRA,
        			VALOR_GAAR,
        			ID) 
        			VALUES
                    ('$codprocedi',
                    '$datamulti',
                    '$horamulti',
                    '$nomedoanimal',
                    '$especie',
                    '$sexo',
                    '$porte',
                    '$peso',
                    '$dtnasc',
                    '$respanimal',
                    '$autorizacao',
                    '$telresp',
                    '$emailresp',
                    '$valorajuda',
                    '$produtos',
                    '$tmp_obs',
                    'SIM',
                    '$idvet',
                    '$procedimento',
                    '$novoid',
                    '$idanimaldogaar',
                    '$idprotetor',
                    '$quemleva',
                    'NÃO',
                    '$dia_expiracao',
                    '$extra',
                    '$valorgaar',
                    '$idprocedidb')";   
            $insert = mysqli_query($connect,$queryi); 

    	} elseif ($action=="u") {
    	    $queryu = "UPDATE AGENDAMENTO SET DATA_AG='$datamulti', 
        			HORA_AG='$horamulti', 
        			NOME_ANIMAL='$nomedoanimal', 
        			ESPECIE='$especie', 
        			SEXO='$sexo', 
        			PORTE='$porte',
        			PESO='$peso',
        			DATA_NASC='$dtnasc', 
        			RESPONSAVEL='$respanimal',
        			AUTORIZADO_POR='$autorizacao',
        			TEL_CONTATO='$telresp',
        			EMAIL_RESPONSAVEL='$emailresp',
        			VALOR_AJUDA='$valorajuda',
        			PRODUTOS='$produtos',
        			OBS='$tmp_obs',
        			ATIVO='$ativo',
        			CLINICA='$idvet',	
        			PROCEDIMENTO='$procedimento',
        			ID_PROCEDIMENTO='$idprocedi',
        			ID_GAAR='$idanimaldogaar',
        			ID_PROTETOR='$idprotetor',
        			QUEM_LEVA='$quemleva',
        			REALIZADO='$realizado',
        			EXPIRA_EM='$dia_expiracao',
        			EXTRA='$extra',
        			VALOR_GAAR='$valorgaar'
					WHERE ID='$idprocedidb'";    
			$update = mysqli_query($connect,$queryu);
			
    	}
    	
    	mysqli_commit($connect);
        
        if(mysqli_errno($connect) == '0'){

        	 $queryupdatecod = "UPDATE PEDIDO_CASTRACAO SET STATUS_PEDIDO ='APROVADO', CODIGO='$codprocedi' WHERE ID ='$idpedido'";
        	 $updatecod = mysqli_query($connect,$queryupdatecod);
        	 
        	 mysqli_commit($connect);
        	 
        	 $queryprotetor = "SELECT * FROM PROTETORES WHERE ID='$idprotetor'";
        	 $selectprotetor = mysqli_query($connect,$queryprotetor);
        	 $rc = mysqli_fetch_row($selectprotetor);
        	 $nomeprotetor = $rc[1];
        	 $telprotetor = $rc[2];
        	 
        	 
        	 if(mysqli_errno($connect) == '0'){
        	     $log_file_msg="[cadastroagenda.php] Pedido de castração ".$idpedido." foi atualizado com o código ".$codprocedi." às ".$horaatu."\n";
                 $fp = fopen($log_file, 'a');//opens file in append mode  
                 fwrite($fp, $log_file_msg); 
                 //echo $log_file_msg;
        	 } else {
        	     $log_file_msg="[cadastroagenda.php] Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."\n";
        	     $fp = fopen($log_file, 'a');//opens file in append mode  
                 fwrite($fp, $log_file_msg);
        	 }
        	 
        	 if ($idanimaldogaar <> "" || $idanimaldogaar <> "0") {
        	     $queryupdategaar = "UPDATE ANIMAL SET CASTRADO ='Sim', DATA_CASTRACAO='$datamulti' WHERE ID ='$idanimaldogaar'";
        	     $updategaar = mysqli_query($connect,$queryupdategaar);
        	     mysqli_commit($connect);
        	     if(mysqli_errno($connect) == '0'){
            	     $log_file_msg="[cadastroagenda.php] Atualização de status para castrado do animal ".$idanimaldogaar." foi realizado ".$codprocedi." às ".$horaatu."\n";
                     $fp = fopen($log_file, 'a');//opens file in append mode  
                     fwrite($fp, $log_file_msg); 
                     //echo $log_file_msg;
            	 } else {
            	     $log_file_msg="[cadastroagenda.php] Atualização de status para castrado do animal ".$idanimaldogaar." - Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."\n";
            	     $fp = fopen($log_file, 'a');//opens file in append mode  
                     fwrite($fp, $log_file_msg);
            	 }
        	 }
        	 
        	$ano_multi = substr($datamulti,0,4);
    	    $mes_multi = substr($datamulti,5,2);
    	    $dia_multi = substr($datamulti,8,2);
    	    
    	    //SALVANDO O QR CODE
            $img_qrcode="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=https://gaarcampinas.org/area/formatualizaprocediqrcode.php?cod=".$codprocedi;
            $diretorio = "/home1/gaarca06/public_html/area/imagens/";
            $nome_imagem = "qr_code_".$codprocedi.".png";
            $caminho_imagem = $diretorio . $nome_imagem;
            $conteudo_imagem = file_get_contents($img_qrcode);
            $resultado = file_put_contents($caminho_imagem, $conteudo_imagem);
            
            $path = '/home1/gaarca06/public_html/area/dompdf/logo_pequeno.png';
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $bodytext = "<center><img src='".$base64."' width='70' height='70'></center>" ;
            $bodytext .="<table style='border-style:none; font-family: Arial, sans-serif; display: inline-table;' >";
            $bodytext .="<thead style='background-color: #0000A0' class='thead-light'>";
            $bodytext .="<tr style='border-color:white; font-family: Arial, sans-serif;'>";
            //$bodytext .="<th scope='col'></th>";
            $bodytext .="<th scope='col' colspan='10' style='text-align: center;><p style='font-family:arial,verdana;'><font color='#FFFFFF'><h3>AUTORIZAÇÃO/CÓDIGO: ".$codprocedi."</h3></p></font></th>";
            $bodytext .="</tr>";
            $bodytext .="</thead>";
            $bodytext .="<tbody>";
            $bodytext .="<tr style='background-color: #FFFFFF; border-color:white;'>";
            $bodytext .="<td colspan='2'><p style='font-family: Arial,verdana;'>Nome do animal:</p></td>";
            $bodytext .="<td colspan='7'><p style='font-family: Arial,verdana;'>".$nomedoanimal."</p></td>";
            $bodytext .="<td colspan='1'>&nbsp;</td>";
            $bodytext .="</tr>";
            $bodytext .="<tr style='background-color: #FFFFFF;border-color:white; '>";
            $bodytext .="<td colspan='1' ><p style='font-family:arial,verdana;'>Procedimento:</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>".$procedimento."</p></td>";
            $bodytext .="<td colspan='8'>&nbsp;</td>";
            $bodytext .="</tr>";
            $bodytext .="<tr style='background-color: #FFFFFF'>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>Data:</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>".$dia_multi."/".$mes_multi."/".$ano_multi."</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>Horário:</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>".$horamulti."</p></td>";
            $bodytext .="<td colspan='6'>&nbsp;</td>";
            $bodytext .="</tr>";
            $bodytext .="<tr style='background-color: #FFFFFF'>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>Espécie:</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>".$especie."</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>Sexo:</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>".$sexo."</p></td>";
            $bodytext .="<td colspan='6'>&nbsp;</td>";
            $bodytext .="</tr>";
            $bodytext .="<tr style='background-color: #FFFFFF'>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>Porte:</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>".$porte."</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>Peso:</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>".$peso."kg</p></td>";
            $bodytext .="<td colspan='6'>&nbsp;</td>";
            $bodytext .="</tr>";
            $bodytext .="<tr style='background-color: #FFFFFF'>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>Responsável:</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>".$quemleva."</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>Protetor:</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>".$nomeprotetor." - Tel: ".$telprotetor."</p></td>";
            $bodytext .="<td colspan='6'>&nbsp;</td>";
            $bodytext .="</tr>";
            /*$bodytext .="<tr style='background-color: #FFFFFF'>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>Autorizado por:</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>".$autorizacao."</p></td>";
            $bodytext .="<td colspan='8'>&nbsp;</td>";
            $bodytext .="</tr>";*/
            $bodytext .="<tr style='background-color: #FFFFFF'>";
            $bodytext .="<td colspan='2'><p style='font-family:arial,verdana;'>Valor a pagar na clínica:</p></td>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'> R$".$valorajuda." <font color='red'>".$txtvalorajuda."</font></p></td>";
            $bodytext .="<td colspan='7'>&nbsp;</td>";
            $bodytext .="</tr>";
            $bodytext .="<tr style='background-color: #FFFFFF'>";
            $bodytext .="<td colspan='1'><p style='font-family:arial,verdana;'>Observações:</p></td>";

            /* dra Daniela */
            if ($idvet =='2'){
                $tmpobs = "Jejum alimentar 12h / Jejum líquido 6h. Medicação inclusa. ";
            }
            
            /* dra Elani */
            if ($idvet =='3'){
                $tmpobs = "Jejum alimentar 10h / Jejum líquido 3h. Medicação inclusa.";
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
            
            /* dra Adriana 1 - dra Sandra 7 - dra Thais 8 - dr Marcos 59 */
            if ($idvet =='1' || $idvet =='7' || $idvet =='8' || $idvet =='59'){
                $tmpobs = "Jejum alimentar de 8h e líquido de 4h. Medicação não inclusa.";
            } 
    
            if ($obsgaar =="" || $obsgaar =="0" ) {
                $tmpobsgaar= "<strong>Roupas cirúrgicas NÃO estão inclusas nessa autorização.</strong> <strong>Voucher válido apenas para o dia do procedimento e para o animal acima descrito, apresentar na entrega e retirada do animal.<br>O animal será previamente avaliado pelo veterinário e, caso precise, será utilizada a anestesia inalatória (em casos de obesidade ou animais braquicefálicos) onde o tutor/responsável deverá pagar 50% do valor.</strong>";
            } else {
                $tmpobsgaar= $obsgaar."<strong>Roupas cirúrgicas NÃO estão inclusas nessa autorização.</strong> <strong>Voucher válido apenas para o dia do procedimento e para o animal acima descrito, apresentar na entrega e retirada do animal. <br>O animal será previamente avaliado pelo veterinário e, caso precise, será utilizada a anestesia inalatória (em casos de obesidade ou animais braquicefálicos) onde o tutor/responsável deverá pagar 50% do valor.</strong>";
            }
            if ($peso >='18') {
                $tmpobsgaar .="<strong> O programa do GAAR paga castração para animais com até 20kg, se na hora da pesagem o animal exceder o limite o valor adicional deverá ser pago pelo tutor ou pelo protetor independente ao veterinário caso haja cobrança.";
            }
            $bodytext .="<td colspan='3'><p style='font-family:arial,verdana; color: red;'>".$tmpobs."<br>".$tmpobsgaar."</p></td>";
            $bodytext .="</tr>";
            $bodytext .="<tr style='background-color: #FFFFFF'>";
            $bodytext .="<td ><p style='font-family:arial,verdana;' colspan='2'>Clínica Veterinária:</p></td>";
            $bodytext .="<td colspan='8'><p style='font-family:arial,verdana; '><strong>".$nomevet."</strong> - ".$endvet.",".$numvet." - ".$bairrovet.". ".$cidadevet."</p></td>";
            $bodytext .="</tr>";
            $bodytext .="</tbody>";
            $bodytext .="</table>";
            $path_qrcode = "/home1/gaarca06/public_html/area/imagens/qr_code_".$codprocedi.".png";
            $type_qrcode = pathinfo($path_qrcode, PATHINFO_EXTENSION);
            $data_qrcode = file_get_contents($path_qrcode);
            $base64_qrcode = 'data:image/' . $type_qrcode . ';base64,' . base64_encode($data_qrcode);

            $bodytext .= "<center><img src='".$base64_qrcode."' width='100' height='100'></center><br>" ;
            $bodytext .="<br><br>Agendamento criado eletronicamente por ".$nome." dia ".$data_atu_2." às ".$horaatu."";
            
            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $dompdf->set_base_path('/home1/gaarca06/public_html/area/');
            //$dompdf->setFont('Arial', 'normal', 12);
            $dompdf->loadHtml($bodytext);
            
            // Render the HTML as PDF
            $dompdf->render();
            
            $pdfname = "/home1/gaarca06/public_html/area/vouchers/".$codprocedi.".pdf";
            // Output the generated PDF to Browser
            //$dompdf->stream($pdfname);
            // Output the generated PDF to folder
            $pdfContent = $dompdf->output();
            file_put_contents($pdfname, $pdfContent);
            
            /*ENVIO DO CÓDIGO POR E-MAIL PARA O RESPONSÁVEL */
        
            $mail = new PHPMailer();
            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail*/
            $mail->Debugoutput = 'html';
            $mail->CharSet = 'UTF-8';
            $mail->SetFrom('castracao@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
            $mail->IsHTML(true);
            $to = $emailresp;
            //$to="thaise.piculi@gmail.com";
            $mail->AddAddress($to);
            //$mail->AddBCC("thaise.piculi@gmail.com");
            $file_to_attach = "/home1/gaarca06/public_html/area/vouchers/".$codprocedi.".pdf";
            $mail->addAttachment($file_to_attach, $codprocedi.".pdf");
            
            if ($action == "i") {
                $subject = "[GAAR Campinas] Autorização de procedimento para o animal $nomedoanimal - código ".$codprocedi."";    
                $bodytext = "  <p> Olá ".$respanimal.", <br> Segue anexo seu voucher de agendamento.<br><br>";
            } elseif ($action=="u") {
                $subject = "[GAAR Campinas] Atualização da autorização para o animal $nomedoanimal - código ".$codprocedi."";
                $bodytext = "  <p> Olá ".$respanimal.", <br> Seu voucher de agendamento foi atualizado, segue anexo. <br><br>";
            }
            
                
            $bodytext .="<p><strong>OBSERVAÇÕES<br></strong>
                    1. Por gentileza, levar o código no dia do procedimento e apresentar ao veterinário. Mostre através do celular. Nessa Autorização, consta: Data, horário, jejum, endereço da Clínica e o valor disposto que deve ser pago diretamente na clínica no mesmo dia. <BR>
                    2. Caso não consiga comparecer, entre em contato com os voluntários da ONG respondendo esse e-mail.<br>
                    3. O animal será previamente avaliado pelo veterinário e, caso precise, será utilizada a anestesia inalatória (em casos de obesidade ou animais braquicefálicos) onde o tutor/responsável deverá pagar 50% do valor.<br>
                    4. Roupas cirúrgicas NÃO estão inclusas nessa autorização.<br>
                    5. Voucher válido apenas para o dia do procedimento.<br>
                    6. Acompanhar o pós-cirúrgico, explicando os procedimentos para aqueles de pouca instrução.<br><br> 
                    
                 <strong>ORIENTAÇÕES PÓS CIRÚRGICAS<br></strong>
                 • O animal, logo que chega em casa, está ligeiramente anestesiado. É normal ficar quieto;<br>
                 • Deixe-o deitado num local tranquilo para se recuperar;<br>
                 • Deixe água disponível. Ele vai beber se quiser. Não forçar;<br>
                 • Alimento poderá ser dado a partir do dia seguinte. A anestesia pode deixá-lo enjoado e sem vontade de comer;<br>
                 • Vômitos são normais; Não se preocupe;<br>
                 • Fazer a limpeza do local da cirurgia de acordo com as orientações do veterinário;<br>
                 • Explicar como deve ser aplicado o medicamento, quando houver;<br>
                 • Qualquer fato diferente desses, se comunicar urgente com o veterinário.<br>
                 • Não faça nada diferente das orientações do veterinário, pois pode perder o direito dado por ele;<br>
                 • Lembrando que a ONG Gaar. não se responsabiliza por problemas decorrentes da cirurgia. O Gaar apenas viabiliza castrações a preços reduzidos.<br>
                
                 Avisar a ONG que o animal foi castrado, ou mesmo sobre o seu estado de recuperação.<br><br>
                    
                Atenciosamente,<br>
                Equipe de castrações do GAAR
            
                        ";
            
            $mail->Subject   = $subject;
            $mail->Body      = $bodytext;
            
            // ENVIO DO E-MAIL
            if ($reenvio == "reenviar" || $action=="i") {
                if (!$mail->send()) {
                    $log_file_msg ="[cadastroagenda.php] Erro no envio do voucher ao protetor ".$to.": ".$mail->ErrorInfo." às ".$horaatu."\n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg);  
                } else {
                    $log_file_msg ="[cadastroagenda.php] Envio do voucher ao protetor ".$to." às ".$horaatu."\n";
                    $fp = fopen($log_file, 'a');//opens file in append mode  
                    fwrite($fp, $log_file_msg);
                    $mail->clearAddresses();
                
                    $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
                    $mail->IsHTML(true);
                    $to="thaise.piculi@gmail.com";
                    //$to = "contato@gaarcampinas.org";
                    $to="castracao@gaarcampinas.org";
                    $mail->AddAddress($to);
                    //$mail->AddBCC("thaise.piculi@gmail.com");
                    
                    $subject = "[GAAR Campinas] Código de autorização de procedimento - ".$codprocedi."";
                    
                    if ($action == "i") {
                        $subject = "[GAAR Campinas] Código de autorização de procedimento - ".$codprocedi."";
                        $bodytext = "  <p> Olá voluntários, <br> Esta é apenas uma notificação de que o voucher do agendamento para a(o) protetor(a) ".$respanimal." foi enviado por e-mail com sucesso.<br> Nome do animal: ".$nomedoanimal.".</p><br>";
                    } elseif ($action=="u") {
                        $subject = "[GAAR Campinas] Código de autorização de procedimento atualizado - ".$codprocedi."";
                        $bodytext = "  <p> Olá voluntários, <br> Esta é apenas uma notificação de que o voucher do agendamento para a(o) protetor(a) ".$respanimal." teve uma atualização e foi enviado por e-mail com sucesso.<br> Nome do animal: ".$nomedoanimal.".</p><br>";
                    }
                
                    
                    $mail->Subject   = $subject;
                    $mail->Body      = $bodytext;
                    
                    if (!$mail->send()) {
                        $log_file_msg ="[cadastroagenda.php] Erro no envio do voucher ao ".$to.": ".$mail->ErrorInfo." às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);  
                    } else {
                        $log_file_msg ="[cadastroagenda.php] Envio do voucher ao ".$to." às ".$horaatu."\n";
                        $fp = fopen($log_file, 'a');//opens file in append mode  
                        fwrite($fp, $log_file_msg);
                    }
                    $mail->clearAddresses();
                }    
            } else {
                
                $log_file_msg ="[cadastroagenda.php] Voucher ".$codprocedi." atualizado e não enviado por e-mail ao protetor ".$to." às ".$horaatu."\n";
                $fp = fopen($log_file, 'a');//opens file in append mode  
                fwrite($fp, $log_file_msg);  
            }
            
            echo "<html>";
            echo "<body>";
            echo"<script type='text/javascript'>
              if (confirm('Ação realizada com sucesso!')) {
                window.history.go(-2);
              }
            </script>";  
            
            echo "</body>";
            echo "</html>";
            
        }
        else {
            echo "Erro no cadastro: ".$insert." - Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."";
            if (mysqli_errno($connect) == '1062'){
                echo "<center><h3>Ops, algo deu errado!</h3>";
                echo "<p> Já existe esse código cadastrado para essa data e horário. Por favor corrija as informações.</p>";
                echo "<a href=\"javascript:window.history.go(-1)\" class=\"links\">Voltar</a>";
                //echo "Erro no cadastro: ".$insert." - Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."";
            }
            
        }
	}
	else {
	    echo "<html>";
        echo "<body>";
        echo"<script type='text/javascript'>
                  if (confirm('Nenhum veterinário encontrado')) {
                    window.history.go(-1);
                  }
                </script>";
        echo "</body>";
        echo "</html>";
	     $log_file_msg ="[cadastroagenda.php] Nenhum veterinário encontrado \n";
         $fp = fopen($log_file, 'a');//opens file in append mode  
         fwrite($fp, $log_file_msg); 
	}
	unlink ($path_qrcode);
}
fclose($fp); 
mysqli_close($connect);
?>