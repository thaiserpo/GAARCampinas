<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
$evento = strtoupper($_POST['evento']);
$endereco = $_POST['endereco'];
$data = $_POST['data'];
$nomevol = $_POST['nomevol'];
$descricao = $_POST['descricao'];
$area = $_POST['area']; 

if ($area == 'Administração'){
    $uploaddir = '/home/gaarcam1/public_html/docs/administracao/';
    $to = "voluntariosgaar@googlegroups.com";
}
if ($area == 'Captação'){
    $uploaddir = '/home/gaarcam1/public_html/docs/captacao/';
    $to = "captacao@gaarcampinas.org";
}

if ($area == 'Comunicação'){
    $uploaddir = '/home/gaarcam1/public_html/docs/comunicacao/';
    $to = "comunicacao@gaarcampinas.org,redes-sociais-gaar@googlegroups.com";
}

if ($area == 'Financeiro'){
    $uploaddir = '/home/gaarcam1/public_html/docs/financeiro/';
    $to = "financeiro@gaarcampinas.org";
}

if ($area == 'Operacional'){
    $uploaddir = '/home/gaarcam1/public_html/docs/operacional/';
    $to = "operacional@gaarcampinas.org,feiragaar@googlegroups.com";
}

$uploadfile = $uploaddir.($_FILES['file']['name']);
$nome_file = $_FILES['file']['name'];

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
		    $file = $uploadfile;
        } else {
            $file = '';
        }
		
		foreach($_POST['nomevol'] as $selected){
		        $nomes .= $selected;
		        $nomes .= ' ';
		        
		}

        $query = "INSERT INTO DOCUMENTACAO
					(EVENTO, 
					ENDERECO, 
					DATA, 
					DESCRICAO, 
					VOLUNTARIOS_PRESENTES, 
					FILE,
					AREA_PRINCIPAL) 
					VALUES
                    ('$evento',
                    '$endereco',
                    '$data',
                    '$descricao',
                    '$nomes',
                    '$nome_file', 
                    '$area')";
						
        $insert = mysqli_query($connect,$query); 	
		 
        if($insert=='0' || $insert == '1'){
		/*	echo "Insert code: ".$insert;
			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
			
			ini_set('display_errors', 1);

    		error_reporting(E_ALL);
    
    		$from ="contato@gaarcampinas.org";
    		
    		$subject="Novo documento carregado para a área ".$area."";
    		
    		$headers ="MIME-Version: 1.0\n";               
    		$headers .="Content-type: text/html; charset=utf-8\n";            
    		$headers .="From: <{$from}> \r\n";    
    /*		$headers .='Bcc: {$bcc} \r\n";*/
    
    		$message = "Novo documento carregado para a área ".$area." <br><br>
    		            Descrição: ".$descricao."<br>
    		            Nome do documento: ".$nome_file."<br><br>
    		            
    		            Para baixar acesse: <br>
    		            1. Faça login na área restrita: <a href='http://gaarcampinas.org/area/login.html'> Clique aqui </a><br>
    		            2. Posicione o mouse em cima do menu Administração <br>
    		            3. Selecione o menu Repositório de documentos <br><br>
    		            
    		            **** Este e-mail foi gerado automaticamente pelo sistema ****";
    		
    		mail($to, $subject, $message, $headers);
			
             echo"<script language='javascript' type='text/javascript'>
              alert('Cadastro realizado com sucesso!');
    		  window.location.href='formcadastroadmin.php'</script>";
	    }else{ 
			echo "Insert code: ".$insert;
			echo "Mensagem de erro: ".mysql_error(). "SQL Error: ".mysql_errno();
			echo "Erro ao cadastrar <br><br>";
			echo "<a href='formcadastroadmin.php'>Voltar</a>";
          /*echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao cadastrar');window.location
          .href='termo.php'</script>";*/
        }
}
?>