<?php
session_start();

include ("conexao.php"); 

ini_set('display_errors', 1);
            
error_reporting(E_ALL);

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
    
    $queryarea = "SELECT AREA,SUBAREA,EMAIL,NOME,CELULAR FROM VOLUNTARIOS WHERE USUARIO ='$login'";
	$selectarea = mysqli_query($connect,$queryarea);
		
	while ($fetcharea = mysqli_fetch_row($selectarea)) {
			$areavol = $fetcharea[0];
			$subareavol = $fetcharea[1];
			$email = $fetcharea[2];
			$nomevol = $fetcharea[3];
			$celular = $fetcharea[4];
	}

    
    /**
     * Limpar nome de arquivo no upload
     * 
     * Sanitization test done with the filename:
     * ÄäÆæÀàÁáÂâÃãÅåªₐāĆćÇçÐđÈèÉéÊêËëₑƒğĞÌìÍíÎîÏïīıÑñⁿÒòÓóÔôÕõØøₒÖöŒœßŠšşŞ™ÙùÚúÛûÜüÝýÿŽž¢€‰№$℃°C℉°F⁰¹²³⁴⁵⁶⁷⁸⁹₀₁₂₃₄₅₆₇₈₉±×₊₌⁼⁻₋–—‑․‥…‧.png
     * @author toscho
     * @url    https://github.com/toscho/Germanix-WordPress-Plugin
     */
    function t5f_sanitize_filename( $filename )
    {
    
        $filename    = html_entity_decode( $filename, ENT_QUOTES, 'utf-8' );
        $filename    = t5f_translit( $filename );
        $filename    = t5f_lower_ascii( $filename );
        $filename    = t5f_remove_doubles( $filename );
        return $filename;
    }
    
    /**
     * Converte maiúsculas em minúsculas e remove o resto.
     * https://github.com/toscho/Germanix-WordPress-Plugin
     *
     * @uses   apply_filters( 'germanix_lower_ascii_regex' )
     * @param  string $str Input string
     * @return string
     */
    function t5f_lower_ascii( $str )
    {
        $str     = strtolower( $str );
        $regex   = array(
            'pattern'        => '~([^a-z\d_.-])~'
            , 'replacement'  => ''
        );
        // Leave underscores, otherwise the taxonomy tag cloud in the
        // backend won’t work anymore.
        return preg_replace( $regex['pattern'], $regex['replacement'], $str );
    }
    
    
    /**
     * Reduz meta caracteres (-=+.) repetidos para apenas um.
     * https://github.com/toscho/Germanix-WordPress-Plugin
     *
     * @param  string $str Input string
     * @return string
     */
    function t5f_remove_doubles( $str )
    {
        $regex = array(
            'pattern'        => '~([=+.-])\\1+~'
            , 'replacement'  => "\\1"
        );
        return preg_replace( $regex['pattern'], $regex['replacement'], $str );
    }
    
    
    /**
     * Substitui caracteres não-ASCII.
     * https://github.com/toscho/Germanix-WordPress-Plugin
     *
     * Modified version of Heiko Rabe’s code.
     *
     * @author Heiko Rabe http://code-styling.de
     * @link   http://www.code-styling.de/?p=574
     * @param  string $str
     * @return string
     */
    function t5f_translit( $str )
    {
        $utf8 = array(
            'Ä'  => 'Ae'
            , 'ä'    => 'ae'
            , 'Æ'    => 'Ae'
            , 'æ'    => 'ae'
            , 'À'    => 'A'
            , 'à'    => 'a'
            , 'Á'    => 'A'
            , 'á'    => 'a'
            , 'Â'    => 'A'
            , 'â'    => 'a'
            , 'Ã'    => 'A'
            , 'ã'    => 'a'
            , 'Å'    => 'A'
            , 'å'    => 'a'
            , 'ª'    => 'a'
            , 'ₐ'    => 'a'
            , 'ā'    => 'a'
            , 'Ć'    => 'C'
            , 'ć'    => 'c'
            , 'Ç'    => 'C'
            , 'ç'    => 'c'
            , 'Ð'    => 'D'
            , 'đ'    => 'd'
            , 'È'    => 'E'
            , 'è'    => 'e'
            , 'É'    => 'E'
            , 'é'    => 'e'
            , 'Ê'    => 'E'
            , 'ê'    => 'e'
            , 'Ë'    => 'E'
            , 'ë'    => 'e'
            , 'ₑ'    => 'e'
            , 'ƒ'    => 'f'
            , 'ğ'    => 'g'
            , 'Ğ'    => 'G'
            , 'Ì'    => 'I'
            , 'ì'    => 'i'
            , 'Í'    => 'I'
            , 'í'    => 'i'
            , 'Î'    => 'I'
            , 'î'    => 'i'
            , 'Ï'    => 'Ii'
            , 'ï'    => 'ii'
            , 'ī'    => 'i'
            , 'ı'    => 'i'
            , 'I'    => 'I' // turkish, correct?
            , 'Ñ'    => 'N'
            , 'ñ'    => 'n'
            , 'ⁿ'    => 'n'
            , 'Ò'    => 'O'
            , 'ò'    => 'o'
            , 'Ó'    => 'O'
            , 'ó'    => 'o'
            , 'Ô'    => 'O'
            , 'ô'    => 'o'
            , 'Õ'    => 'O'
            , 'õ'    => 'o'
            , 'Ø'    => 'O'
            , 'ø'    => 'o'
            , 'ₒ'    => 'o'
            , 'Ö'    => 'Oe'
            , 'ö'    => 'oe'
            , 'Œ'    => 'Oe'
            , 'œ'    => 'oe'
            , 'ß'    => 'ss'
            , 'Š'    => 'S'
            , 'š'    => 's'
            , 'ş'    => 's'
            , 'Ş'    => 'S'
            , '™'    => 'TM'
            , 'Ù'    => 'U'
            , 'ù'    => 'u'
            , 'Ú'    => 'U'
            , 'ú'    => 'u'
            , 'Û'    => 'U'
            , 'û'    => 'u'
            , 'Ü'    => 'Ue'
            , 'ü'    => 'ue'
            , 'Ý'    => 'Y'
            , 'ý'    => 'y'
            , 'ÿ'    => 'y'
            , 'Ž'    => 'Z'
            , 'ž'    => 'z'
            // misc
            , '¢'    => 'Cent'
            , '€'    => 'Euro'
            , '‰'    => 'promille'
            , '№'    => 'Nr'
            , '$'    => 'Dollar'
            , '℃'    => 'Grad Celsius'
            , '°C' => 'Grad Celsius'
            , '℉'    => 'Grad Fahrenheit'
            , '°F' => 'Grad Fahrenheit'
            // Superscripts
            , '⁰'    => '0'
            , '¹'    => '1'
            , '²'    => '2'
            , '³'    => '3'
            , '⁴'    => '4'
            , '⁵'    => '5'
            , '⁶'    => '6'
            , '⁷'    => '7'
            , '⁸'    => '8'
            , '⁹'    => '9'
            // Subscripts
            , '₀'    => '0'
            , '₁'    => '1'
            , '₂'    => '2'
            , '₃'    => '3'
            , '₄'    => '4'
            , '₅'    => '5'
            , '₆'    => '6'
            , '₇'    => '7'
            , '₈'    => '8'
            , '₉'    => '9'
            // Operators, punctuation
            , '±'    => 'plusminus'
            , '×'    => 'x'
            , '₊'    => 'plus'
            , '₌'    => '='
            , '⁼'    => '='
            , '⁻'    => '-' // sup minus
            , '₋'    => '-' // sub minus
            , '–'    => '-' // ndash
            , '—'    => '-' // mdash
            , '‑'    => '-' // non breaking hyphen
            , '․'    => '.' // one dot leader
            , '‥'    => '..'  // two dot leader
            , '…'    => '...'  // ellipsis
            , '‧'    => '.' // hyphenation point
            , ' '    => '-'   // nobreak space
            , ' '    => '-'   // normal space
        );
    
        $str = strtr( $str, $utf8 );
        return trim( $str, '-' );
    }
    
    function floatvalue($val){
            $val = str_replace(",",".",$val);
            $val = preg_replace('/\.(?=.*\.)/', '', $val);
            return floatval($val);
        }

    $area = $_POST['area']; 
    $nome_doc_tmpname = str_replace(" ", "_",$_FILES['doc']['name']);
    $nome_doc_tmp_name = str_replace(" ", "_",$_FILES['doc']['tmp_name']);
    $nome_doc = t5f_sanitize_filename($nome_doc_tmpname);
    $nome_doc_tmp = t5f_sanitize_filename($nome_doc_tmp_name);
    /*$nome_doc = $_FILES['doc']['name'];*/
    /*$uploadfile = $uploaddir.basename($_FILES['doc']['name']);*/
    $descricao = $_POST['descricao']; 
    $tmpvalor = $_POST['valor']; 
    $data = $_POST['data']; 
    $subtipo = $_POST['subtipo'];
    $banco = $_POST['banco'];
    $lt = $_POST['lt'];
        
    if ($area == 'Administração'){
        if ((strpos($nome_doc, 'planilha_financeiro') !== false) || (strpos($nome_doc, 'prestacao_de_contas') !== false) || (strpos($nome_doc, 'gastos_com_veterinarios') !== false)) {
            $uploaddir = '/home/gaarca06/public_html/docs/financeiro/prestacaodecontas/';
        } else {
            $uploaddir = '/home/gaarca06/public_html/docs/administracao/';
        }
        $send_vol = true;
        $emaildir = 'http://gaarcampinas.org/docs/administracao/';
    }
    if ($area == 'Captação'){
        $uploaddir = '/home/gaarca06/public_html/docs/captacao/';
        $emaildir = 'http://gaarcampinas.org/docs/captacao/';
        $to = "captacao@gaarcampinas.org";
    }
    
    if ($area == 'Comunicação'){
        $uploaddir = '/home/gaarca06/public_html/docs/comunicacao/';
        $emaildir = 'http://gaarcampinas.org/docs/comunicacao/';
        $to = "comunicacao@gaarcampinas.org,thaise.piculi@gmail.com";
    }
    
    if ($area == 'Financeiro'){
        if ((strpos($nome_doc, 'planilha_financeiro') !== false) || (strpos($nome_doc, 'prestacao_de_contas') !== false)) {
            $uploaddir = '/home/gaarca06/public_html/docs/financeiro/prestacaodecontas/';
            $send_vol = true;
        } else {
            $uploaddir = '/home/gaarca06/public_html/docs/financeiro/arquivos/';   
        }
        $emaildir = 'http://gaarcampinas.org/docs/financeiro/';
        $to = "financeiro@gaarcampinas.org";
    }
    
    if ($area == 'Operacional'){
        $uploaddir = '/home/gaarca06/public_html/docs/operacional/';
        $emaildir = 'http://gaarcampinas.org/docs/operacional/';
        $to = "operacional@gaarcampinas.org,feiragaar@googlegroups.com";
    }
    
    if ($area == 'Público'){
        $uploaddir = '/home/gaarca06/public_html/docs/publico/';
        $emaildir = 'http://gaarcampinas.org/docs/publico/';
        $subtipo = "Público";
    }
    
    if ($area == 'Todos'){
        $uploaddir = '/home/gaarca06/public_html/docs/todos/';
        $emaildir = 'http://gaarcampinas.org/docs/todos/';
        $subtipo = "Todos";
        $send_vol = true;
    }
    
    if ($area == ''){
        $uploaddir = '/home/gaarca06/public_html/docs/';
        $emaildir = 'http://gaarcampinas.org/docs/';
        $to = "thaise.piculi@gmail.com";
        $subtipo ="0";
    }

    $uploadfile = $uploaddir.basename($nome_doc);

    if (move_uploaded_file($nome_doc_tmp_name, $uploadfile)) {
        if ($tmpvalor == ''){
            $valor = 0;
        } else {
            $valor = floatvalue($tmpvalor);
        }
        if ($subtipo == 'Lar temporário'){
            if ($descricao == ''){
                $descricao = "LT ".$lt ;
            } 
        } else {
            if ($descricao == ''){
                $path_parts = pathinfo($uploadfile);
                $descricao = $path_parts['filename'];  
        } 
        }

        $query = "INSERT INTO DOCUMENTACAO
			(EVENTO, 
			ENDERECO, 
			DATA, 
			DESCRICAO, 
			VOLUNTARIOS_PRESENTES, 
			FILE, 
			AREA_PRINCIPAL,
			USUARIO,
			VALOR,
			DATA_DOC,
			SUBTIPO_LANC)
			VALUES
            ('Comprovante',
             '$banco',
             NOW(),
             '$descricao',
             '',
             '$nome_doc',
             '$area',
             '$login',
             '$valor',
             '$data',
             '$subtipo')";
				
        $insert = mysqli_query($connect,$query); 	
        
        if(mysqli_errno($connect) == '0'){
            /*echo "<br> area: ".$area;
            echo "<br> nome doc: ".$nome_doc;
            echo "<br> data: ".$data;
            echo "<br> valor: ".$valor;
            echo "<br> subtipo: ".$subtipo;
            echo "<br> descricao: ".$descricao;*/
            if ($area == 'Financeiro' && $nome_doc <> ''){
                $queryupdate = "UPDATE FINANCEIRO SET 
                                    SUBTIPO_LANC = '$subtipo',
                                    DESCRICAO_LANC = CONCAT(DESCRICAO_LANC,' - $descricao'),
                                    COMPROVANTE_REEMB = '$nome_doc'
                                WHERE 
                                   DATA_LANC = '$data' AND
                                   VALOR_LANC = '$valor' AND
                                   BANCO_LANC = '$banco'
                                ";
                $update = mysqli_query($connect,$queryupdate);
                /*echo "<br> queryupdate: ".$queryupdate;
                echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
            }
            
			/*echo "Insert code: ".$insert;
			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
			
			$mail = new PHPMailer();
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = 'html';
            $mail->CharSet = 'UTF-8';
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
            $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
            $mail->IsHTML(true);
            $to = 'contato@gaarcampinas.org';
            $mail->AddAddress($to);
            $log_file_msg = "";
            $listamail = "";
    		
    		if ($send_vol == TRUE) {
    	          $queryvol = "SELECT EMAIL FROM VOLUNTARIOS WHERE AREA <> 'clinica' and AREA <> 'anuncios' and STATUS_APROV='Aprovado' ORDER BY NOME ASC";
    		      $selectvol = mysqli_query($connect,$queryvol);
    		      
    		      $subject="[GAAR Campinas] Novo documento carregado";
    		      
    		      $bodytext = "<p>Olá vountário! <br> Um novo documento da ONG foi carregado no sistema para consulta. <br><br>
    		            Nome do documento: ".$nome_doc."<br>
    		            Upload feito por: ".$nomevol."<br><br>
    		            
    		            Descrição: ".$descricao."<br>
    		            
    		            Para acessar: <br>
    		            1. Faça login aqui: <a href='http://gaarcampinas.org/area/login.html'> Clique aqui </a><br>
    		            2. Clique no menu Administração <br>
    		            3. Clique no menu Repositório de documentos <br><br>
    		            
    		            Ou <a href='".$emaildir.$nome_doc."'>clique aqui para fazer o download</a> <br><br>
    		            
    		            <i> Este e-mail foi gerado automaticamente pelo sistema e enviado à todos os voluntários ativos e sócios </i> </p>";
    		      
            	  while ($fetchvol = mysqli_fetch_row($selectvol)) {
        				$bcc_mail = $fetchvol[0];
        				$listamail .= $bcc_mail.", ";
                        $mail->AddCustomHeader("BCC: ".$bcc_mail.""); 
        		  }
        		 
                  $mail->Subject   = $subject;
                  $mail->Body      = $bodytext;
                  
        		  if (!$mail->send()) {
                            $log_file_msg .="[cadastrodoc.php] Erro de envio do e-mail de documentação:".$mail->ErrorInfo."\n";
                  } else {
                            $log_file_msg .="[cadastrodoc.php] E-mail de documentação enviado para ".$listamail." às ".$horaatu."\n";
                  }
                    
                  $mail->clearAddresses();
        		  
        		  $bodytext ="";
        		      
        		  $querysoc = "SELECT EMAIL FROM SOCIO WHERE EMAIL <> ''";
    		      $selectsoc = mysqli_query($connect,$querysoc);
    		      
    		      $bodytext = "<p>Olá sócio! <br> Um novo documento da ONG foi carregado no sistema para consulta. <br><br>
    
    		            Descrição: ".$descricao."<br><br>
    		            
    		            <a href='".$emaildir.$nome_doc."'>clique aqui para fazer o download</a> <br><br>
    		            
    		            **** Este e-mail foi gerado automaticamente pelo sistema **** </p>";
    		      
            	  while ($fetchsoc = mysqli_fetch_row($selectsoc)) {
        				$bcc_mail_soc = $fetchsoc[0];
        				$listamail .= $bcc_mail_soc.", ";
                        $mail->AddCustomHeader("BCC: ".$bcc_mail_soc.""); 
        		  }
        		  
                  $mail->Body      = $bodytext;
                  
        		  if (!$mail->send()) {
                            $log_file_msg .="[cadastrodoc.php] Erro de envio do e-mail de documentação:".$mail->ErrorInfo."\n";
                  } else {
                            $log_file_msg .="[cadastrodoc.php] E-mail de documentação enviado para ".$listamail." às ".$horaatu."\n";
                  }
                    
                  $mail->clearAddresses();   
    	      } else {
    	        $bodytext = "";
    	        $subject = "";
    	        $subject="Novo documento carregado para a área ".$area."";
        		$bodytext = "<p>Novo documento carregado para a área ".$area." <br><br>
        		            Descrição: ".$descricao."<br>
        		            Nome do documento: ".$nome_doc."<br>
        		            Upload feito por: ".$nomevol."<br><br>
        		            
        		            Para baixar acesse: <br>
        		            1. Faça login na área restrita: <a href='http://gaarcampinas.org/area/login.html'> Clique aqui </a><br>
        		            2. Clique no menu Administração <br>
        		            3. Clique no menu Repositório de documentos <br><br>
        		            
        		            Ou <a href='".$emaildir.$nome_doc."'>clique aqui para fazer o download</a> <br><br>
        		            
        		           <i> Este e-mail foi gerado automaticamente pelo sistema e enviado à todos os voluntários ativos e </i> </p>";
        		
        		  $mail->Subject   = $subject;
                  $mail->Body      = $bodytext;
                  
        		  if (!$mail->send()) {
                            $log_file_msg .="[cadastrodoc.php] Erro de envio do e-mail de documentação:".$mail->ErrorInfo."\n";
                  } else {
                            $log_file_msg .="[cadastrodoc.php] E-mailde documentação enviado para ".$listamail." às ".$horaatu."\n";
                  }
                    
                  $mail->clearAddresses();
    	    }
    		
            echo"<script language='javascript' type='text/javascript'>
            alert('Documento cadastrado com sucesso!');
    		window.location.href='pesquisaadmin.php'</script>";

	    }else{ 
			echo"<script language='javascript' type='text/javascript'>
                        alert('Documento já cadastrado - upload não realizado');window.location
                        .href='pesquisaadmin.php'</script>";
        }
    } else {
        echo "<br>Problema no upload do arquivo!\n";
    }
    


}