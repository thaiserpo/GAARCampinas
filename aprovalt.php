<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$id = $_GET['id'];

if($login == "" || $login == null){
	    echo"<script language='javascript' type='text/javascript'>
        alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
    
        $queryarea = "SELECT NOME,AREA,SUBAREA,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
		        $nomevoluntario = $fetcharea[0];
				$area = $fetcharea[1];
				$subarea = $fetcharea[2];
				$emailvoluntario = $fetcharea[3];
		}
		
    		$query = "SELECT * FROM FORM_VOLUNTARIO WHERE ID='$id'";
		    $select = mysqli_query($connect,$query);
		    
    		while ($fetch = mysqli_fetch_row($select)) {
	            $nome = strtoupper($fetch[1]);
				$endereco = $fetch[21];
				$bairro = $fetch[20];
				$cidade = $fetch[2];
				$celular = $fetch[4];
				$email = $fetch[5];
				$comoajudar = $fetch[6];
				
				switch ($comoajudar) {
				    case 'Lar temporário para gatos':
				        $especies = 'Apenas gatos';
				        break;
				    case 'Lar temporário para cães':
				        $especies = 'Apenas cães';
				        break;
				    
				}
        	
        	    $query = "INSERT INTO LT
        					(LAR_TEMPORARIO, 
        					ENDERECO, 
        					BAIRRO, 
        					CIDADE, 
        					TEL_FIXO, 
        					TEL_CELULAR, 
        					EMAIL, 
        					ESPECIES, 
        					QTDE_CAES, 
        					QTDE_GATOS, 
        					VALOR_DIA,
        					VOLUNTARIO_RESP,
        					BANCO,
        					AGENCIA,
        					CONTA,
        					DV,
        					CPF) 
					    VALUES(
					        '$nome',
					        '$endereco',
					        '$bairro',
					        '$cidade',
					        '0',
					        '$celular',
					        '$email',
					        '$especies',
					        '0',
					        '0',
					        '0',
					        '$nomevoluntario',
					        '0',
					        '0',
					        '0',
					        '0',
					        '0'
					    )";
        					 				
                $insert = mysqli_query($connect,$query);
                
                echo mysqli_errno($connect);
                
                if(mysqli_errno($connect) == '0'){
                        
                        $querydel = "DELETE FROM FORM_VOLUNTARIO WHERE ID='$id'";
		                $delete = mysqli_query($connect,$querydel);
                
                		echo"<script language='javascript' type='text/javascript'>
                                  alert('Lar temporário aprovado');window.location.href='formvisualizaprelt.php'</script>";
                } else{
        		echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                          echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                          echo "<a href='formvisualizaprelt.php' class='btn btn-primary'>Voltar</a></center><br>";
                }
		}
}
	 
?>
