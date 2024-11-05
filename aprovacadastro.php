<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

$ano_atu = date ("Y");

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
    
$usuario = $_GET['usuario'];

        $queryvol = "SELECT * FROM VOLUNTARIOS WHERE STATUS_APROV='Esperando aprovação'";
		$selectvol = mysqli_query($connect,$queryvol);
		
		while ($fetchvol = mysqli_fetch_row($selectvol)) {
		    $email = $fetchvol[4];
		    $nome = $fetchvol[2];
		    $senha = $fetchvol[1];
		}
            		    
        $query = "UPDATE VOLUNTARIOS SET STATUS_APROV = 'Aprovado' where USUARIO='$usuario'";
        $update = mysqli_query($connect,$query);
        
        if(mysqli_errno($connect) == '0'){
            
            ini_set('display_errors', 1);
        
        		error_reporting(E_ALL);
        		
        		$from = "contato@gaarcampinas.org";
        		
        		$to = $email;
        		//$to = "thaise.piculi@gmail.com";
        		
        		$subject="Seja bem-vindo(a) ao GAAR!";
        						
        		$headers = "MIME-Version: 1.0\n";               
        		$headers .= "Content-type: text/html; charset=utf-8\n";            
        		$headers .= "From: <{$from}> \r\n";    
        		/*$headers .= "Bcc: thaise.piculi@gmail.com \r\n"; */
        			
        		$message = "Olá, ".$nome." <br><br> Seu cadastro foi aprovado. <br><br> Essas são as suas informações: <br>Login: ".$email." <br>Senha temporária: Gaar".$ano_atu."@@ <br><br> Para acessar o sistema, clique <a href='http://gaarcampinas.org/area/login.html'>aqui</a> <br><br>";
        		
        		mail($to, $subject, $message, $headers);
        		
                 echo"<script language='javascript' type='text/javascript'>
                 alert('Usuário atualizado com sucesso!');window.location.href='formatualizacadastro.php'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao atualizar - preencha pelo menos o campo login');window.location
          .href='cadastro.html'</script>";
        }
}
?>