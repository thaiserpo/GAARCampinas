<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$invalid_data = FALSE;

error_reporting(E_ALL);

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
        $clinica = $_POST['clinica'];
        
        if ($clinica == '') {
            echo"<script language='javascript' type='text/javascript'>
                    alert('Preencha o nome da clínica ou veterinário);
                    window.location.href='formcadastroprocedi.php'</script>";
        } else {
            
            if(isset($_POST['jarealizado'])) {
		        $statusproc = 'Aprovado';
		        $jarealizado = 'SIM';
    		} else {
    		    $jarealizado = 'NÃO';
    		}
		
            $uploaddir = "/home/gaarca06/public_html/docs/operacional/procedimentos/".$ano_atu."/".$mes_atu."";
            //$downloaddir = "http://gaarcampinas.org/docs/financeiro/extratos/".$ano_atu."/".$mes_ant."/";
            $uploadfile = $uploaddir.($_FILES['procedicsv']['name']);
            $csvfile = $_FILES['procedicsv']['name'];

            //Create directory if it does not exist
            if (!is_dir($uploaddir)) {
                mkdir($uploaddir, 0750, true);
            }

            $queryarea = "SELECT AREA,SUBAREA,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
    		$selectarea = mysqli_query($connect,$queryarea);
    			
    		while ($fetcharea = mysqli_fetch_row($selectarea)) {
    				$area = $fetcharea[0];
    				$subarea = $fetcharea[1];
    				$email = $fetcharea[2];
    		}
    		
    		if ($csvfile != ''){
    		  $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
              if(in_array($_FILES['procedicsv']['type'],$mimes)){
        		    if (move_uploaded_file($_FILES['procedicsv']['tmp_name'], $uploadfile)) {
                		    if (($handle = fopen($uploadfile, "r")) !== FALSE) {
                		        $fgetcsv = ",";
                		        fgetcsv($handle, 10000, ",");
                		        while (($data = fgetcsv($handle, 1000, $fgetcsv)) !== FALSE) {   
                                    $tmp = 0;
                                    $data_procedi = $data[0];
                                    $tmp_dia_procedi = substr($data[0],0,2);
                        		    $tmp_mes_procedi = substr($data[0],3,2);
                        		    $dia_procedi = str_pad($tmp_dia_procedi, 2, "0", STR_PAD_LEFT);
                                    $mes_procedi = str_pad($tmp_mes_procedi, 2, "0", STR_PAD_LEFT);
                        		    $ano_procedi = substr($data[0],6,4);
                                    $dtprocedi = $ano_procedi."-".$mes_procedi."-".$dia_procedi;
                                    $horaprocedi = $data[1];
                                    $codigoautoriza = $data[2];
                                    $codigoprotetor = $data[3];
                                    $nomedoanimal = $data[4];
                                    $idanimalgaar = $data[5];
                                    $especie = $data[6];
                                    $sexo = $data[7];
                                    $porte = $data[8];
                                    $idade = $data[9];
                                    $nomedotutor = $data[10];
                                    $teldotutor = $data[11];
                                    $aprovagaar = $data[12];
                                    $tipoprocedi = $data[13];
                                    $procediextra = $data[14];
                                    $produtos = $data[15];
                                    $valorgaar = $data[16];
                                    $valortutor = $data[17];
                                    $obs = $data[18];
                                    
                                    //echo "<br> codigo autoriza: ".$codigoautoriza;

                                    $count_dias_ativo = intval($dia_procedi.$mes_procedi.$ano_procedi) - intval($dia_atu.$mes_atu.$ano_atu);
                                    
                                    if ($count_dias_ativo < '0') {
                                        $codigoativo = 'NÃO';
                                    } else {
                                        $codigoativo = 'SIM';
                                    }
                                    
                                    // CHECKING DATES
                                    if (checkdate($mes_procedi,$dia_procedi,$ano_procedi)) {
                                        switch ($especie) {
                                            case 'FEL':
                                                $especie = 'Felina';
                                                break;
                                            case 'CAN':
                                                $especie = 'Canina';
                                                break;
                                        }
                                        
                                        switch ($sexo) {
                                            case 'F':
                                                $sexo = 'Fêmea';
                                                break;
                                            case 'M':
                                                $sexo = 'Macho';
                                                break;
                                        }
                                        
                                        /* SE FOR UM ANIMAL DA ONG */
                                		
                                		if ($idanimalgaar !='0' && $idanimalgaar !=''){
                                		    $querypetgaar = "SELECT * FROM ANIMAL WHERE ID = '$idanimalgaar'";
                                		    $selectpetgaar = mysqli_query($connect,$querypetgaar); 	
                                		
                                		    while ($fetchpetgaar = mysqli_fetch_row($selectpetgaar)) {
                                				$nomedoanimal = $fetchpetgaar[1];
                                				$especie = $fetchpetgaar[2];
                                				$sexo = $fetchpetgaar[4];
                                				$porte = $fetchpetgaar[6];
                                				$requigaar = $fetchpetgaar[12];
                                				$ltgaar = $fetchpetgaar[11];
                                		    }
                                		    
                                		    $queryvol = "SELECT * FROM VOLUNTARIOS WHERE NOME = '$requigaar'";
                                    		$selectvol = mysqli_query($connect,$queryvol); 	
                                    		
                                    		while ($fetchvol = mysqli_fetch_row($selectvol)) {
                                    				$nomevol = $fetchvol[2];
                                    				$celvol = $fetchvol[3];
                                    				$emailvol = $fetchvol[4];
                                    		}
                                		    
                                		    $nomedotutor = $nomevol;
                                		    $teldotutor = $celvol;
                                		    $emaildotutor = $emailvol;
                                		    
                                		    $querypet = "UPDATE ANIMAL
                                                            SET CASTRADO='Sim',
                                                            DATA_CASTRACAO = '$dtprocedi'
                                                            WHERE ID='$idanimalgaar'";
                                                                     
                                            $updatevet = mysqli_query($connect,$querypet); 
                                            
                                            echo "<br> query pet: ".$querypet;
                                                        
                                            if(mysqli_errno($connect) != '0'){
                                                            
                                                $from ="operacional@gaarcampinas.org";
                                                    		
                                                $to = '"thaise.piculi@gmail.com';
                                                    	
                                                $subject= "Erro ao atualizar o animal ".$nomedoanimal."";
                                                    		
                                                $headers ="MIME-Version: 1.0\n";               
                                                $headers .="Content-type: text/html; charset=utf-8\n";            
                                                $headers .="From: <{$from}> \r\n";    
                                                    
                                                $message = "Erro ao atualizar a tabela ANIMAL com a data de castração. <br><br>
                                                            
                                                            ID ANIMAL: ".$idanimalgaar."<br>
                                                            
                                                            SQLCODE : ".mysqli_errno($connect)."";
                                        
                                                mail($to, $subject, $message, $headers);
                                            }
                                                    
                                            $queryvet = "SELECT EMAIL FROM CLINICAS WHERE CLINICA='$clinica'";
                                            $selectvet = mysqli_query($connect,$queryvet); 	
                                                        
                                            while ($fetchvet = mysqli_fetch_row($selectvet)) {
                                            	   $emailvet = $fetchvet[0];
                                            }
                                                		
                                		} else {
                                		    $requigaar = $aprovagaar;
                                		    $emaildotutor = 0;
                                		}
                                		
                                		if ($valortutor == '-' || $valortutor == '' ){
                                		    $valortutor = 0;
                                		}
                                		
                                		if ($codigoautoriza == ''){
                                		    $codigoautoriza = 0;
                                		}
                                		
                                		if ($idade == ''){
                                		    $dtnascanimal = "0001-01-01";
                                		}
                                
                                		if (($tipoprocedi == 'Outros') || ($tipoprocedi == 'Exame') || ($tipoprocedi=='Roupa cirúrgica') || ($tipoprocedi=='Transporte') ){
                                		   $nomedoanimal = $obs;
                                		   $especie = "N/A";
                                		   $sexo = "N/A";
                                		   $porte = "N/A";
                                		   $nomedotutor = $requigaar;
                                		   $teldotutor = $celvol;
                                		   $emaildotutor = $emailvol;
                                		}
                                		
                                		if ($tipoprocedi == 'Vacina'){
                                		    $tipoprocedi = "Vacina ".$tipovacina;
                                		    if (($tipovacina =='V3') || ($tipovacina =='V4') || ($tipovacina =='V5')) {
                                		        $especie = "Felina";
                                        		$sexo = "N/A";
                                        		$porte = "N/A";
                                		    }
                                		    if (($tipovacina =='V8') || ($tipovacina =='V10')) {
                                		        $especie = "Canina";
                                        		$sexo = "N/A";
                                        		$porte = "N/A";
                                		    }
                                		}
                                		
                                		$queryvet = "SELECT ID FROM CLINICAS WHERE CLINICA ='$clinica'";
                                		$selectvet = mysqli_query($connect,$queryvet);
                                		$rc = mysqli_fetch_row($selectvet);
        			                    $id_vet = $rc[0];
                                		
                                		//$valor_qtde = floatval($valor_unit) * $qtde;
                                        //$valor = floatval($valor_qtde) - floatval ($outrasdesp) + floatval ($valoradicional);
                                		
                            		    /* TABELA DE CONTROLE DE AGENDAMENTOS */
                                        $queryagenda = "INSERT INTO AGENDAMENTO 
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
                                                        VALOR_GAAR,
                                                        EXTRA,
                                                        PRODUTOS,
                                                        ATIVO,
                                                        CLINICA,
                                                        PROCEDIMENTO,
                                                        ID_PROCEDIMENTO,
                                                        ID_GAAR,
                                                        REALIZADO,
                                                        ID_PROTETOR)
                                                        VALUES (
                                                        '$codigoautoriza',
                                                        '$dtprocedi',
                                                        '$horaprocedi',
                                                        '$nomedoanimal',
                                                        '$especie',
                                                        '$sexo',
                                                        '$porte',
                                                        '0',
                                                        '$dtnascanimal',
                                                        '$nomedotutor',
                                                        '$requigaar',
                                                        '$teldotutor',
                                                        '$emaildotutor',
                                                        '$valortutor',
                                                        '$valorgaar',
                                                        '$procediextra',
                                                        '$produtos',
                                                        '$codigoativo',
                                                        '$id_vet',
                                                        '$tipoprocedi',
                                                        '0',
                                                        '$idanimalgaar',
                                                        '$jarealizado',
                                                        '$codigoprotetor')";
                                                                         
                                            $insertagenda = mysqli_query($connect,$queryagenda); 
                                            
                                            //echo "<br> query agenda: ".$queryagenda;
    
                                            //echo "sqlcode insert agendamento: ".mysqli_errno($connect);
                                            
                                            if(mysqli_errno($connect) == '0'){
                                                    $log_file_msg .="[uploadcastracao.php] Agendamento cadastrado com sucesso: ".$codigoautoriza." por ".$login." às ".$horaatu."\n";
                                                    echo "<br> log file message: ".$log_file_msg;
                                            		$fp = fopen($log_file, 'a');//opens file in append mode  
                                                    //fwrite($fp, $log_file_msg);  
                                                    $codigoativo_list .= "<br>".$codigoativo;
                                                    $query = "INSERT INTO PROCEDIMENTOS
                                                					(DATA,
                                                					NOME_ANIMAL,
                                                					ESPECIE, 
                                                					SEXO, 
                                                					PORTE,
                                                	                NOME_TUTOR,
                                                	                TEL_TUTOR,
                                                	                REQUISITOR_GAAR,
                                                					APROVADOR_GAAR,
                                                					TIPO_PROC, 
                                                					VALOR, 
                                                					VALOR_TUTOR,
                                                					CLINICA, 
                                                					OBS,
                                                					STATUS_PROC,
                                                					EMAIL_TUTOR,
                                                					QTDE,
                                                					DESCONTO,
                                                					LOGIN,
                                                					CODIGO,
                                                					DTNASC_ANIMAL,
                                                					ID_GAAR,
                                                					ID_PROTETOR) 
                                                					VALUES
                                                            ('$dtprocedi',
                                                            '$nomedoanimal',
                                                            '$especie',
                                                            '$sexo',
                                                            '$porte',
                                                            '$nomedotutor',
                                                            '$teldotutor',
                                                            '$requigaar',
                                                            '$aprovagaar',
                                                            '$tipoprocedi',
                                                            '$valorgaar',
                                                            '$valortutor',
                                                            '$clinica',
                                                            '$obs',
                                                            '$statusproc',
                                                            '$emaildotutor',
                                                            '$qtde',
                                                            '$desconto',
                                                            '$login',
                                                            '$codigoautoriza',
                                                            '$dtnascanimal',
                                                            '$idanimalgaar',
                                                            '$codigoprotetor)";
                                                						
                                                    $insert = mysqli_query($connect,$query); 
                                                    
                                                    echo "<br> query procedi: ".$query;
                                                
                                                    $ano_dtcirurgia = substr($dtprocedi,0,4);
                                    		        $mes_dtcirurgia = substr($dtprocedi,5,2);
                                    		        $dia_dtcirurgia = substr($dtprocedi,8,2);
                                                    
                                                    if(mysqli_errno($connect) != '0'){
                                                                /*echo "<br>Insert code: ".$insert;
                                                    			echo "<br>Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);
                                                    			echo "<br>Erro ao cadastrar <br><br>";
                                                    			echo "<a href='formcadastroprocedi.php' class='btn btn-primary'>Voltar</a>";*/
                                                    			
                                                    			$from ="operacional@gaarcampinas.org";
                                                        		
                                                        		$to = '"thaise.piculi@gmail.com';
                                                        	
                                                        		$subject= "Erro ao cadastrar agendamento ".$codigoautoriza."";
                                                        		
                                                        		$headers ="MIME-Version: 1.0\n";               
                                                        		$headers .="Content-type: text/html; charset=utf-8\n";            
                                                        		$headers .="From: <{$from}> \r\n";    
                                                        
                                                                $message = "Erro ao atualizar a tabela AGENDAMENTO. <br><br>
                                                                
                                                                            CODIGO: ".$codigoautoriza."<br>
                                                                
                                                                            SQLCODE : ".mysqli_errno($connect)."<br>
                                                                            
                                                                            ERRO : ".mysqli_error($connect)."<br>";
                                            
                                                        		//mail($to, $subject, $message, $headers);
                                                    }
                                                    else {
                                                        $log_file_msg .="[uploadcastracao.php] Procedimento cadastrado com sucesso: ".$codigoautoriza." por ".$login." às ".$horaatu."\n";
                                            		    $fp = fopen($log_file, 'a');//opens file in append mode  
                                                        //fwrite($fp, $log_file_msg);  
                                                        echo "<br> log file message: ".$log_file_msg;
                                                        echo"<script language='javascript' type='text/javascript'>
                                                                    alert('Procedimento cadastrado com sucesso!');
                                                                    window.location.href='formcadastroprocedi.php'</script>";
                                                    }
                                	            } else {
                                        		//$log_file_msg .="[uploadcastracao.php] Erro ao cadastrar o código ".$codigoautoriza." procedimento ".$tipoprocedi.":  Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect)." às ".$horaatu."\n";
                                    		    $fp = fopen($log_file, 'a');//opens file in append mode  
                                                fwrite($fp, $log_file_msg);  
                        		            }   
                                        } 
                            		else {
                            		    $dtprocedi = "0001-01-01"; 
                                        $invalid_data = TRUE;
                                        //echo "<br>data procedi planilha: ".$dtprocedi;
                                        //echo "<br> checkdate: ".$mes_procedi,$dia_procedi,$ano_procedi;
                                        //echo "<br> dataprocedi: ".$data_procedi;
                                        $log_file_msg .="[uploadcastracao.php] Código não cadastrado: ".$codigoautoriza."- Motivo: data inválida às ".$horaatu."\n";
                                        echo "<br> log file message: ".$log_file_msg;
                            		    $fp = fopen($log_file, 'a');//opens file in append mode  
                                        //fwrite($fp, $log_file_msg); 
                        		    }
                            		
                		        }
        		            }
                    }
                }
            else {
                echo"<script language='javascript' type='text/javascript'>
                    alert('Arquivo não encontrado');
                    window.location.href='formcadastroprocedi.php'</script>";
            }
        }
}
fclose($fp);
mysqli_close($connect);
}
?>