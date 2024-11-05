<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$idanimalter = $_POST['idanimalter'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
	$query = "SELECT * FROM ANIMAL WHERE ID = '$idanimalter'";
	$select = mysqli_query($connect,$query);
	
	$fetch = mysqli_fetch_row($select);
		
	$nomeanimal = $_POST['nomedoanimal'];
	$especie = $_POST['especie'];
	$idade = $_POST['idade'];
	$sexo = $_POST['sexo'];
	$cor = $_POST['cor'];
	$porte = $_POST['porte'];
	$castracao = $_POST['castracao'];
	$dtcastracao = $_POST['dtcastracao'];
	$vacinacao = $_POST['vacinacao'];
	$status = $_POST['status'];
	$lt = $_POST['lt'];
	$resp = $_POST['resp'];
	$dtentradalt = $_POST['dtentradalt'];
	$dtsaidalt = $_POST['dtsaidalt'];
	$obs = $_POST['obs'];
	/*$foto = $fetch[16];*/
	$emailresp = $_POST['emailresp'];
	$divulgar = $_POST['divulgar'];
	$uploaddir = '/home/gaarca06/public_html/pets/';
	$uploadfile = $uploaddir.($_FILES['foto']['name']);
	$foto = $uploadfile;
	
	
	move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
		
        $query = "UPDATE ANIMAL
					SET 
					DIVULGAR_COMO='$divulgar'
					WHERE 
					ID = '$idanimalter'";
					 				
        $insert = mysqli_query($connect,$query); 	

		 
        if(mysqli_errno($connect) == '0'){
          /*echo "Insert code: ".$insert;
			echo "Mensagem de erro: ".mysqli_error($connect). "<br>SQL Error: ".mysqli_errno($connect);*/
         echo"<script language='javascript' type='text/javascript'>
          alert('Animal atualizado com sucesso!');
		  window.location.href='pesquisapetterc.php'</script>";
	    }else{
			echo "Insert code: ".$insert;
			echo "Mensagem de erro: ".mysqli_error($connect). "<br>SQL Error: ".mysqli_errno($connect);
          echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao cadastrar');window.location
          .href='termo.php'</script>";
        }
	  
	  	ini_set('display_errors', 1);

		error_reporting(E_ALL);
		
		$from = "contato@gaarcampinas.org";
		
		$to = $emailresp;
		
		$headers = "MIME-Version: 1.0\n";               
		$headers .= "Content-type: text/html; charset=utf-8\n";            
		$headers .= "From: <{$from}> \r\n";  
		/*$headers .= "Bcc: thaise.piculi@gmail.com \r\n";   */
			
		$message = "Olá, <br><br> Seu anúncio para o animal ".$nomeanimal." foi aprovado. <br><br> Para visualização, acesse <a href='http://gaarcampinas.org/anuncios/'>Anúncios de terceiros</a>";			
		
		$subject = "Seu anúncio foi aprovado!";
		
		mail($to, $subject, $message, $headers);
}
?>