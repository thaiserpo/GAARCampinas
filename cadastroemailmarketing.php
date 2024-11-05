<?php 
session_start();

include ("conexao.php"); 

$getmail = strtolower($_POST['getmail']);
$getnome = strtoupper($_POST['getnome']);

if ($getmail <> '') {
    $queryinsert = "INSERT INTO EMAIL_MARKETING (NOME, EMAIL,RECEBER) VALUES ('$getnome','$getmail','SIM')";
    $insert = mysqli_query($connect,$queryinsert); 
    
    if(mysqli_errno($connect) == '0'){
        ini_set('display_errors', 1);
            
        error_reporting(E_ALL);
        
        /*$from = "contato@gaarcampinas.org";*/
        $from = "operacional@gaarcampinas.org";
        
        $headers = "MIME-Version: 1.0\n";               
        $headers .= "Content-type: text/html; charset=utf-8\n";            
        $headers .= "From: <{$from}> \r\n"; 
        
        $subject = "[GAAR Campinas] Baixe o Estatuto dos animais";
        
        $to = $getmail;
        
        $message ="<center>
                <p>
                <a href='http://gaarcampinas.org/docs/administracao/estatuto_de_protecao_animal__de_campinas.pdf'>Clique aqui e baixe o Estatuto dos Animais de Campinas</a>
                </p>
                </center>
            
            <img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'><br>
            Atenciosamente, <br>Equipe GAAR.<br><br>http://gaarcampinas.org<br>http://facebook.com/gaarcampinas<br>http://instagram.com/gaarcampinas </p></center>
            
            ";
        
        $result =  mail($to, $subject, $message, $headers);
    
        if ($result){
            echo"<script language='javascript' type='text/javascript'>
                                      alert('E-mail enviado! Verifique a caixa de Spam ou lixeira');window.location
                                      .href='https://gaarcampinas.org/denuncie-maus-tratos/';</script>";
        } else {
            echo "<br>Erro no envio: ".$to;
        }
    }
    elseif (mysqli_errno($connect) == '1062'){
        echo"<script language='javascript' type='text/javascript'>
                                      alert('E-mail já cadastrado em nosso banco de dados');window.location
                                      .href='https://gaarcampinas.org/denuncie-maus-tratos/';</script>";
    }
    
} else {
    $querymail = "SELECT EMAIL FROM EMAIL_MARKETING WHERE EMAIL <> ''";
	$selectmail = mysqli_query($connect,$querymail); 
	$reccountmail = mysqli_num_rows($selectmail);

	while ($fetchmail = mysqli_fetch_row($selectmail)) { 
	    
	    $email = $fetchmail[0];

	    $query = "SELECT NOME_PADRINHO,EMAIL_PADRINHO FROM APADRINHAMENTO WHERE EMAIL_PADRINHO <> ''";
	    $select = mysqli_query($connect,$query); 
	    $reccount = mysqli_num_rows($select);
	    
	    while ($fetch = mysqli_fetch_row($select)) {
	        $nome_padrinho = $fetch[0];
	        $email_padrinho = $fetch[1];
	        
	        if ($email_padrinho != $email) {
               $queryinsert = "INSERT INTO EMAIL_MARKETING (NOME, EMAIL) VALUES ('$nome_padrinho','$email_padrinho')";
    	       $insert = mysqli_query($connect,$queryinsert); 
    	       
    	       if(mysqli_errno($connect) != '0'){
        	        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                    echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                }
    	       
            } else {
                echo "<br> e-mail já cadastrado - padrinho";
            }

	    }
	    
	    $query = "SELECT NOME_COMPLETO,EMAIL FROM FORM_PRE_ADOCAO WHERE EMAIL <> ''";
	    $select = mysqli_query($connect,$query); 
	    $reccount = mysqli_num_rows($select);
	    
	    while ($fetch = mysqli_fetch_row($select)) {
	        $nome_form_pre = $fetch[0];
	        $email_form_pre = $fetch[1];
	        
	        if ($email_form_pre != $email) {
               $queryinsert = "INSERT INTO EMAIL_MARKETING (NOME, EMAIL) VALUES ('$nome_form_pre','$email_form_pre')";
    	       /*$insert = mysqli_query($connect,$queryinsert); */
    	       
    	       if(mysqli_errno($connect) != '0'){
        	        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                    echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                }
    	       
            } else {
                echo "<br> e-mail já cadastrado - form-pre";
            }

	    }
	    
	}
}
?>