<?php 

session_start();

include ("conexao.php"); 

$nomeanimal = $_POST['nomeanimal'];
$especie = $_POST['especie'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];
$cor = $_POST['cor'];
$porte = $_POST['porte'];
$idade = $_POST['idade'];
$castracao = $_POST['castracao'];
$vacinacao = $_POST['vacinacao'];
$status = $_POST['status'];
$resp = $_POST['resp'];
/*$foto = $_FILES['foto'];*/
$obs = $_POST['obs'];
$email = $_POST['email'];
$tipoanuncio = $_POST['tipoanuncio'];
$divulgar = $_POST['divulgar'];
$uploaddir = '/home/gaarca06/public_html/pets/';
$uploadfile = $uploaddir.($_FILES['foto']['name']);
$nome_foto = $_FILES['foto']['name'];

if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
		$foto = $uploadfile;
		
		if ($idade == ''){
		    $idade = '0001-01-01';
		}
		
		if ($nomeanimal != '') {
		
    		if (($tipoanuncio =='Doação' && $castracao =='Castrado') || $tipoanuncio =='Encontrado' || $tipoanuncio =='Perdido'){
    		    $divulgar = 'Terceiros';
    		}
		
		    
        $query = "INSERT INTO ANIMAL
					(NOME_ANIMAL, 
					ESPECIE, 
					IDADE, 
					SEXO, 
					COR, 
					PORTE, 
					CASTRADO, 
					DATA_CASTRACAO, 
					VACINADO, 
					ADOTADO, 
					LAR_TEMPORARIO, 
					RESPONSAVEL, 
					DATA_ENTRADA_LT, 
					DATA_SAIDA_LT, 
					OBS, 
					FOTO,
					OBS2,
					DIVULGAR_COMO,
					TIPO_ANUNCIO,
					VACINADO_RAIVA,
					DATA_VACINACAO_RAIVA,
					EXAME_FIVFELV,
					DATA_EXAME_FIVFELV,
					IDADE_JUL) 
					VALUES
                    ('$nomeanimal',
                    '$especie',
                    '$idade',
                    '$sexo',
                    '$cor',
                    '$porte',
                    '$castracao',
                    '0001-01-01',
                    '$vacinacao',
                    '$status',
                    '0',
                    '$resp',
                    '0001-01-01',
                    '0001-01-01',
                    '$obs',
                    '$nome_foto',
                    '$email',
                    '$divulgar',
                    '$tipoanuncio',
                    '0',
                    '0001-01-01',
                    '0',
                    '0001-01-01',
                    '0')";
						
        $insert = mysqli_query($connect,$query); 	
		 
        if(mysqli_errno($connect) == '0'){
        /*    echo "Insert code: ".$insert."<br>";
			echo "Mensagem de erro: ".mysqli_error($connect). "<br>SQL Error: ".mysqli_errno($connect);*/
          echo"<script language='javascript' type='text/javascript'>
          alert('Animal cadastrado com sucesso!');
		  window.location.href='http://gaarcampinas.org/'</script>";
	    }else{
			echo "Insert code: ".$insert."<br>";
			echo "Mensagem de erro: ".mysqli_error($connect). "<br>SQL Error: ".mysqli_errno($connect);
          echo"<script language='javascript' type='text/javascript'>
          alert('Erro ao cadastrar');window.location
          .href='termo.php'</script>";
        }
		
	 	ini_set('display_errors', 1);

		error_reporting(E_ALL);
		
		$from = "admin@gaarcampinas.org";
		
		$to = "divulgacao@gaarcampinas.org";
		
		$headers = "MIME-Version: 1.0\n";               
		$headers .= "Content-type: text/html; charset=utf-8\n";            
		$headers .= "From: <{$from}> \r\n";  
		$headers .= "Bcc: thaise.piculi@gmail.com \r\n";   
			
		$message = "<p>
		
		            <h4>Novo animal de terceiros cadastrado</h4> <br><br>
		
		            <table>
                        <tr>
                            <td align='left'>Nome do animal </td>
                            <td align='left'>: ".$nomeanimal."</td>
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
                            <td align='left'>Data de nascimento aproximada </td>
                            <td align='left'>: ".$idade."</td>
                        </tr>
                        <tr>
                            <td align='left'>Porte </td>
                            <td align='left'>: ".$porte."</td>
                        </tr>
                        <tr>
                            <td align='left'>Cor </td>
                            <td align='left'>: ".$cor."</td>
                        </tr>
                        <tr>
                            <td align='left'>O animal foi castrado?</td>
                            <td align='left'>: ".$castracao."</td>
                        </tr>
                        <tr>
                            <td align='left'>O animal foi vacinado?</td>
                            <td align='left'>: ".$vacinacao."</td>
                        </tr>
                        <tr>
                            <td align='left'>Responsável</td>
                            <td align='left'>: ".$resp."</td>
                        </tr>
                        <tr>
                            <td align='left'>Contato</td>
                            <td align='left'>: ".$email."</td>
                        </tr>
                        <tr>
                            <td align='left'>Tipo do anúncio</td>
                            <td align='left'>: ".$tipoanuncio."</td>
                        </tr>
                        <tr>
                            <td align='left'>Texto para divulgação</td>
                            <td align='left'>: ".$obs."</td>
                        </tr>
                    </table>
                    <br>
        
                    <center><img class='img-responsive img-fluid rounded' src='/pets/".$nome_foto."' valign='top' align='center' width='400' height='600'/> <br><br></center>
                    
                    </p>";		
		
		$subject = "Novo animal de terceiros cadastrado";
		
		mail($to, $subject, $message, $headers);
		
		/***********************************************/
		
		
		$from = "contato@gaarcampinas.org";
		
		$to = $email;
		
		$headers = "MIME-Version: 1.0\n";               
		$headers .= "Content-type: text/html; charset=utf-8\n";            
		$headers .= "From: <{$from}> \r\n";     
			
		$message = "<p><center><img src='http://gaarcampinas.org/area/logo_transparent.png' width='80' height='80'></center><br><br>
		
		                Olá, <br><br> Seu anúncio para o animal ".$nomeanimal." foi recebido em nosso banco de dados. Caso esteja dentro das regras, será publicado em breve. <br><br>
		
                        Temos uma novidade: agora você pode consultar o status e gerenciar seus anúncios em nosso site. <br><br>
                        
                        <b>Veja como é simples</b><br>
                        1. Faça seu cadastro <a href='http://gaarcampinas.org/area/cadastro_anuncios.php' target='_blank'>clicando aqui</a><br>
                        2. No menu Anúncios você pode cadastrar um novo ou consultar os anúncios existentes.<br><br>
                        
                        Dessa forma você tem total autonomia :) <br><br>
                        
                        Caso tenha alguma dúvida ou problema, escreva para contato@gaarcampinas.org <br><br>
                        
                        - Este e-mail foi enviado automaticamente pelo nosso sistema -";		
		
		$subject = "Anúncio recebido em nosso banco de dados";
		
		mail($to, $subject, $message, $headers);
		
		
	  }
        }
	  else{
	  echo "Arquivo inválido";
	  }
?>