<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
        ini_set('display_errors', 1);
    
        error_reporting(E_ALL);
    
        $queryarea = "SELECT AREA,SUBAREA,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
				$email = $fetcharea[2];
		}

        $dtcirurgia = $_POST['dtcirurgia'];
        $nomedoanimal = strtoupper($_POST['nomedoanimal']);
        $idanimalgaar= strtoupper($_POST['idanimalgaar']);
        $especie = $_POST['especie'];
        $sexo = $_POST['sexo'];
        $porte = $_POST['porte'];
        $nomedotutor = strtoupper($_POST['nomedotutor']);
        $teldotutor = $_POST['teldotutor'];
        $emaildotutor = $_POST['emaildotutor'];
        $requigaar = $_POST['requigaar'];
        $aprovagaar = $_POST['aprovagaar'];
        $tipoproc = $_POST['tipoproc'];
        /*$valor = $_POST['valor'];*/
        $outrasdesp = $_POST['outrasdesp'];
        $valortutor = $_POST['valortutor'];
        $desconto = $_POST['desconto'];
        $clinica = $_POST['clinica'];
        $obs = $_POST['obs'];
        $qtde = $_POST['qtde'];
        $descricao = $_POST['descricao'];
        $statusproc = 'Esperando aprovação';
        $jarealizado = $_POST['jarealizado'];
        $tipovacina = $_POST['tipovacina'];
        $codigoautoriza = $_POST['codigoautoriza'];
        $dtnascanimal = $_POST['dtnascanimal'];
        $valorajuda = $_POST['valorajuda'];
        $inalatoria = $_POST['inalatoria'];
        $valoradicional = $_POST['valoradicional'];

        /* SE FOR UM ANIMAL DA ONG */
		
		if ($idanimalgaar !='0'){
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
		} 
		else {
		/* SE NAO FOR UM ANIMAL DA ONG */
		  $aprovagaar = $requigaar; 
		}

		if(isset($_POST['jarealizado'])) {
		      $statusproc = 'Aprovado';
		      $codigoativo = 'NÃO';
		} else {
		    $codigoativo = 'SIM';
		}
		
		if(isset($_POST['responsavel'])) {
		      $nomedotutor = $nomevol;
		      $teldotutor = $celvol;
		      $emaildotutor = $emailvol;
		      $requigaar =  $aprovagaar;
		} else {
		    
		}
		 
		if ($dtcirurgia == ''){
		    $dtcirurgia = "0001-01-01";
		}
		
		if ($valortutor == '' || $valorajuda == '' ){
		    $valortutor = 0;
		}
		
		if ($valoradicional == '') {
		    $valoradicional = 0;
		}
		
		if ($valortutor == '' && $valorajuda != '' ){
		    $valortutor = $valorajuda;
		}
		
		if ($valortutor != '' && $valorajuda == '' ){
		    $valorajuda = $valortutor;
		}
		
		if ($outrasdesp == ''){
		    $outrasdesp = 0;
		}
		
		if ($emaildotutor == ''){
		    $emaildotutor = 0;
		}
		
		if ($codigoautoriza == ''){
		    $codigoautoriza = 0;
		}
		
		if ($dtnascanimal == ''){
		    $dtnascanimal = 0;
		}

		if (($tipoproc == 'Outros') || ($tipoproc == 'Exame') || ($tipoproc=='Roupa cirúrgica') || ($tipoproc=='Transporte') ){
		   $nomedoanimal = $obs;
		   $especie = "N/A";
		   $sexo = "N/A";
		   $porte = "N/A";
		   $nomedotutor = $requigaar;
		   $teldotutor = $celvol;
		   $emaildotutor = $emailvol;
		}
		
		if ($tipoproc == 'Vacina'){
		    $tipoproc = "Vacina ".$tipovacina;
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
		
		if ($especie =='Felina') {
		    switch($sexo){
		        case 'Macho':
		            $queryvet = "SELECT ID, VALOR_GATO FROM CLINICAS WHERE CLINICA ='$clinica'";
		            break;
		        case 'Fêmea':
		            $queryvet = "SELECT ID, VALOR_GATA FROM CLINICAS WHERE CLINICA ='$clinica'";
		            break;
		        case 'Fêmea prenhe':
		            $queryvet = "SELECT ID, VALOR_GATA_PRENHE FROM CLINICAS WHERE CLINICA ='$clinica'";
		            break;
		    }
		} 
		if ($especie =='Canina') {
		    switch($sexo){
		        case 'Macho':
		            if ($porte =='Pequeno' && isset($_POST['inalatoria'])){
		                $queryvet = "SELECT ID, VALOR_CAOP_IN FROM CLINICAS WHERE CLINICA ='$clinica'";  
		            }
		            if ($porte =='Pequeno' && !isset($_POST['inalatoria'])){
		                $queryvet = "SELECT ID, VALOR_CAOP FROM CLINICAS WHERE CLINICA ='$clinica'";  
		            }
		            if ($porte =='Médio' && isset($_POST['inalatoria'])){
		                $queryvet = "SELECT ID, VALOR_CAOM_IN FROM CLINICAS WHERE CLINICA ='$clinica'";    
		            } 
		            if ($porte =='Médio' && !isset($_POST['inalatoria'])){
		                $queryvet = "SELECT ID, VALOR_CAOM FROM CLINICAS WHERE CLINICA ='$clinica'";   
		            }
		            if ($porte =='Grande' && isset($_POST['inalatoria'])){
		                $queryvet = "SELECT ID, VALOR_CAOG_IN FROM CLINICAS WHERE CLINICA ='$clinica'";    
		            }
		            if ($porte =='Grande' && !isset($_POST['inalatoria'])){
		                $queryvet = "SELECT ID, VALOR_CAOG FROM CLINICAS WHERE CLINICA ='$clinica'";    
		            }
		            
		            break;
		        case 'Fêmea':
		            if ($porte =='Pequeno' && isset($_POST['inalatoria'])){
		                $queryvet = "SELECT ID, VALOR_CADELAP_IN FROM CLINICAS WHERE CLINICA ='$clinica'";    
		            } 
		            if ($porte =='Pequeno' && !isset($_POST['inalatoria'])){
		                $queryvet = "SELECT ID, VALOR_CADELAP FROM CLINICAS WHERE CLINICA ='$clinica'";  
		            }
		            if ($porte =='Médio' && isset($_POST['inalatoria'])){
		                $queryvet = "SELECT ID, VALOR_CADELAM_IN FROM CLINICAS WHERE CLINICA ='$clinica'";    
		            }
		            if ($porte =='Médio' && !isset($_POST['inalatoria'])){
		                $queryvet = "SELECT ID, VALOR_CADELAM FROM CLINICAS WHERE CLINICA ='$clinica'";   
		            }
		            if ($porte =='Grande' && isset($_POST['inalatoria'])){
		                $queryvet = "SELECT ID, VALOR_CADELAG_IN FROM CLINICAS WHERE CLINICA ='$clinica'";    
		            } 
		            if ($porte =='Grande' && !isset($_POST['inalatoria'])){
		                $queryvet = "SELECT ID, VALOR_CADELAG FROM CLINICAS WHERE CLINICA ='$clinica'";    
		            }
		            break;
		    }
		} 
		
		/* TESTE */
		echo "<br> query vet: ".$queryvet;
		
		$selectvet = mysqli_query($connect,$queryvet);
			
		while ($fetchvet = mysqli_fetch_row($selectvet)) {
				$id_vet = $fetchvet[0];
				$valor_unit = $fetchvet[1];
		}
		
		if ($desconto == ''){
		    $desconto = 0;
		    $valor_qtde = floatval($valor_unit) * $qtde;
            $valor = floatval($valor_qtde) + floatval ($outrasdesp) + floatval ($valoradicional);
		} else{
		    $valor_qtde = floatval($valor_unit) * $qtde;
            $valor = floatval($valor_qtde) + floatval ($outrasdesp) + floatval ($valoradicional) - floatval ($desconto);
		}
        
		$queryagenda = "INSERT INTO AGENDAMENTO 
                        (CODIGO,
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
                        ATIVO,
                        CLINICA,
                        PROCEDIMENTO,
                        ID_PROCEDIMENTO,
                        ID_GAAR,
                        REALIZADO)
                        VALUES (
                        '$codigoautoriza',
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
                        '$valorajuda',
                        '$codigoativo',
                        '$id_vet',
                        '$tipoproc',
                        '0',
                        '$idanimalgaar',
                        'NÃO')                                       
                     ";
                     
        $insertagenda = mysqli_query($connect,$queryagenda); 
                        
        if(mysqli_errno($connect) == '0'){
            if(isset($_POST['jarealizado'])) {
                        /* TABELA DE CONTROLE DE PROCEDIMENTOS */
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
                        					DTNASC_ANIMAL) 
                        					VALUES
                                    ('$dtcirurgia',
                                    '$nomedoanimal',
                                    '$especie',
                                    '$sexo',
                                    '$porte',
                                    '$nomedotutor',
                                    '$teldotutor',
                                    '$requigaar',
                                    '$aprovagaar',
                                    '$tipoproc',
                                    '$valor',
                                    '$valortutor',
                                    '$clinica',
                                    '$obs',
                                    '$statusproc',
                                    '$emaildotutor',
                                    '$qtde',
                                    '$desconto',
                                    '$login',
                                    '$codigoautoriza',
                                    '$dtnascanimal')";
                        						
                        $insert = mysqli_query($connect,$query); 
                        
                        $ano_dtcirurgia = substr($dtcirurgia,0,4);
            		    $mes_dtcirurgia = substr($dtcirurgia,5,2);
            		    $dia_dtcirurgia = substr($dtcirurgia,8,2);
		    

                        if(mysqli_errno($connect) != '0'){
                            /*echo "<br>Insert code: ".$insert;
                			echo "<br>Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);
                			echo "<br>Erro ao cadastrar <br><br>";
                			echo "<a href='formcadastroprocedi.php' class='btn btn-primary'>Voltar</a>";*/
                			
                			$from ="operacional@gaarcampinas.org";
                    		
                    		$to = '"thaise.piculi@gmail.com';
                    	
                    		$subject= "Erro ao cadastrar procedimento ".$codigoautoriza."";
                    		
                    		$headers ="MIME-Version: 1.0\n";               
                    		$headers .="Content-type: text/html; charset=utf-8\n";            
                    		$headers .="From: <{$from}> \r\n";    
                    
                            $message = "Erro ao atualizar a tabela PROCEDIMENTO. <br><br>
                            
                                        CODIGO: ".$codigoautoriza."<br>
                            
                                        SQLCODE : ".mysqli_errno($connect)."<br>
                                        
                                        ERRO : ".mysqli_error($connect)."<br>";
        
                    		mail($to, $subject, $message, $headers);
                        }
                    
                        $querypet = "UPDATE ANIMAL
                                     SET CASTRADO='Sim',
                                         DATA_CASTRACAO = '$dtcirurgia'
                                     WHERE ID='$idanimalgaar'";
                                     
                        $updatevet = mysqli_query($connect,$querypet); 
                        
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
                        
                        
                		
                        if ($statusproc !='Aprovado'){
            			    
            			    /* CÓPIA DO PROCEDIMENTO ENVIADA PARA O VOLUNTÁRIO */
                
                    		$from ="operacional@gaarcampinas.org";
                    		
                    		$to = $emailvol;
                    	
                    		$subject= "Seu procedimento foi submetido com sucesso - nome do animal ".$nomedoanimal."";
                    		
                    		$headers ="MIME-Version: 1.0\n";               
                    		$headers .="Content-type: text/html; charset=utf-8\n";            
                    		$headers .="From: <{$from}> \r\n";    
                    
                            $message = "Olá ".$requigaar." !<br><br> Seu procedimento foi submetido à aprovação do setor operacional.<br> Aguarde atualizações.<br><br> 
                                        
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
                                            <td align='left'>: ".$tipoproc."</td>
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
                                            <td align='left'>: R$ ".number_format($valor,2,',', '.')."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Data</td>
                                            <td align='left'>: ".$dia_dtcirurgia."/".$mes_dtcirurgia."/".$ano_dtcirurgia."</td>
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
                                        
                            <p><center> Obs: Todos os cadastros de procedimentos irão entrar com o status 'Esperando aprovação' mesmo se ele já tenha sido aprovado previamente via e-mail ou WhatsApp</center></p> <br><br>
                            
                            * Esta notificação foi gerada automaticamente através do sistema *";
        
                    		/*mail($to, $subject, $message, $headers);*/
                    		
                    		/**** CÓPIA DO PROCEDIMENTO ENVIADO AO OPERACIONAL *****/
                    		
                    		$from = $email;
                    		
                    		$to = "operacional@gaarcampinas.org, financeiro@gaarcampinas.org";
                    		
                    		$subject= "Novo procedimento foi submetido no sistema - nome do animal ".$nomedoanimal."";
                    		
                    		$headers ="MIME-Version: 1.0\n";               
                    		$headers .="Content-type: text/html; charset=utf-8\n";            
                    		$headers .="From: <{$from}> \r\n";    
                    
                            $message = "Olá Diretoria Operacional e Financeira, <br><br> Um novo procedimento foi submetido à sua aprovação em nosso sistema. <br><br> 
                            
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
                                            <td align='left'>: ".$tipoproc."</td>
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
                                            <td align='left'>Valor a ser pago pelo GAAR</td>
                                            <td align='left'>: R$ ".number_format($valor,2,',', '.')."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Data</td>
                                            <td align='left'>: ".$dia_dtcirurgia."/".$mes_dtcirurgia."/".$ano_dtcirurgia."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Clínica ou vet</td>
                                            <td align='left'>: ".$clinica."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Voluntário que solicitou  : </td>
                                            <td align='left'>: ".$requigaar."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Observações</td>
                                            <td align='left'>: ".$obs."</td>
                                        </tr>
                                        </table>
                                        
                                        <br><br>
                                        
                                        Para aprovar:<br>
                                        1. Acesse o sistema <a href ='http://gaarcampinas.org/area/login.html'> aqui </a> <br>
                                        2. Clique no menu Operacional <br>
                                        3. Clique em Aprovar procedimento <br><br>
                                        
                                        Após a aprovação, o requisitante irá receber um e-mail de notificação. <br><br>
                            
                            * Esta notificação foi gerada automaticamente através do sistema *";
        
                    		/*mail($to, $subject, $message, $headers);*/
                		
            			    /* CÓPIA DO PROCEDIMENTO ENVIADA A CLINICA */
                		
                    		$from ="operacional@gaarcampinas.org";
                    		
                    		$to = $emailvet;
                    	
                    		$subject= "Procedimento submetido com sucesso - nome do animal ".$nomedoanimal."";
                    		
                    		$headers ="MIME-Version: 1.0\n";               
                    		$headers .="Content-type: text/html; charset=utf-8\n";            
                    		$headers .="From: <{$from}> \r\n";    
                    
                            $message = "Olá ".$clinica." !<br><br> O procedimento foi submetido à aprovação do setor operacional da ONG.<br> Aguarde atualizações.<br><br> 
                                        
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
                                            <td align='left'>: ".$tipoproc."</td>
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
                                            <td align='left'>: R$ ".number_format($valor,2,',', '.')."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Data</td>
                                            <td align='left'>: ".$dia_dtcirurgia."/".$mes_dtcirurgia."/".$ano_dtcirurgia."</td>
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
                                        
                                        <p><center> Obs: Todos os cadastros de procedimentos irão entrar com o status 'Esperando aprovação' mesmo se ele já tenha sido aprovado previamente via e-mail ou WhatsApp</center></p> <br><br>
                            
                            * Esta notificação foi gerada automaticamente através do sistema e tem caráter informativo*";
        
            			}
            			
            			/*mail($to, $subject, $message, $headers); 
            			        echo"<script language='javascript' type='text/javascript'>
                                alert('Procedimento cadastrado com sucesso!');
                                 window.location.href='formcadastroprocedi.php'</script>";*/
            			
            			if ($emaildotutor != ''){
                		    
                    		/**** NOTIFICAÇÃO ENVIADA AO RESPONSÁVEL *****/
                    		
                    		$from ="operacional@gaarcampinas.org";
                    		
                    		$to = $emaildotutor;
                    		
                    		/*$to = "gaarcampinas@gmail.com";*/
                    	
                    		$subject= "Seu procedimento foi submetido no sistema - nome do animal ".$nomedoanimal."";
                    		
                    		$headers ="MIME-Version: 1.0\n";               
                    		$headers .="Content-type: text/html; charset=utf-8\n";            
                    		$headers .="From: <{$from}> \r\n";    
                    
                            $message = "Olá ".$nomedotutor." <br><br> Seu procedimento foi submetido em nosso sistema. <br><br> 
                            
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
                                            <td align='left'>: ".$tipoproc."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Quantidade</td>
                                            <td align='left'>: ".$qtde."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Data</td>
                                            <td align='left'>: ".$dia_dtcirurgia."/".$mes_dtcirurgia."/".$ano_dtcirurgia."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Clínica ou vet</td>
                                            <td align='left'>: ".$clinica."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Voluntário que solicitou</td>
                                            <td align='left'>: ".$requigaar."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Observações</td>
                                            <td align='left'>: ".$obs."</td>
                                        </tr>
                                        </table>
                                        
                                        <br><br>
                            
                            * Esta notificação foi gerada automaticamente através do sistema e serve apenas para seu conhecimento e controle da ONG *";
                            
                            /*mail($to, $subject, $message, $headers);*/
                		}
      
            }
            	    }else{ 
            			echo "<br>Insert code: ".$insert;
            			echo "<br>Mensagem de erro: ".mysqli_error($connect). "SQL Error: ".mysqli_errno($connect);
            			echo "<br>Erro ao cadastrar <br><br>";
            			echo "<a href='formcadastroprocedi.php' class='btn btn-primary'>Voltar</a>";
                    }
    		}

?>
