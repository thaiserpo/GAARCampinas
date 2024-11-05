<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	    echo"<script language='javascript' type='text/javascript'>
        alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
    
        $queryarea = "SELECT NOME,AREA,SUBAREA,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
		        $nome = $fetcharea[0];
				$area = $fetcharea[1];
				$subarea = $fetcharea[2];
				$email = $fetcharea[3];
		}
		
	    if(!empty($_GET['idprocedi'])) {
	        $idprocedi = $_GET['idprocedi'];
	        $queryproc = "SELECT * FROM PROCEDIMENTOS WHERE ID='$idprocedi'";
            $selectproc = mysqli_query($connect,$queryproc);
        
            while ($fetchproc = mysqli_fetch_row($selectproc)) {
    		    $data = $fetchproc[1];
    			$nomedoanimal = $fetchproc[2];
    			$especie = $fetchproc[3];
    			$sexo = $fetchproc[4];
    			$porte = $fetchproc[5];
    			$nomedotutor = $fetchproc[6];
    			$nomevol = $fetchproc[8];
    			$tipoproc = $fetchproc[10];
    			$valor = $fetchproc[11];
    			$valortutor = $fetchproc[12];
    			$clinica = $fetchproc[13];
    			$status = $fetchproc[14];
    			$emaildotutor = $fetchproc[16];
    			$qtde = $fetchproc[17];
    		   
    		}
    		
    		$queryvol = "SELECT * FROM VOLUNTARIOS WHERE NOME = '$nomevol'";
    		$selectvol = mysqli_query($connect,$queryvol);
    		
    		while ($fetchvol = mysqli_fetch_row($selectvol)) {
    		    $emailvol = $fetchvol[4];
    
    		} 
    	   $query = "DELETE FROM PROCEDIMENTOS
    					WHERE 
    					ID = '$idprocedi'";
    			 				
            $delete = mysqli_query($connect,$query);
    		
            if(mysqli_errno($connect) == '0'){
            
                    ini_set('display_errors', 1);
            
            		error_reporting(E_ALL);
            		
            		$from ="contato@gaarcampinas.org";
            		
            		$to = "operacional@gaarcampinas.org, financeiro@gaarcampinas.org";
            		
            		$subject = "Procedimento número ".$id." foi deletado por ".$nome."";
            		
            		$headers = "MIME-Version: 1.0\n";               
            		$headers .= "Content-type: text/html; charset=utf-8\n";            
            		$headers .= "From: <{$from}> \r\n"; 
            		$message = "Olá Diretoria Operacional e Financeira, <br><br>
            		
            		            <p> Procedimento número ".$id." foi deletado por ".$nome.". <br><br>
            		            
            		            
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
                                            <td align='left'>: ".$tipoprocedi."</td>
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
                                            <td align='left'>: ".$data."</td>
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
                                        
                        
            		            Para consultar todos os procedimentos, acesse:<br>
            		            
            		            1. <a href='http://gaarcampinas.org/area/login.html' target=_blank> Área restrita</a><br>
            		            2. Menu Operacional<br>
            		            3. Menu Pesquisar procedimentos<br><br>
            		            
            		            * Esta notificação foi gerada automaticamente através do sistema *</p>";
            		
            		/*mail($to, $subject, $message, $headers);*/
    
            		/* CÓPIA PARA O REQUISITOR GAAR */
                    
                    $from ="operacional@gaarcampinas.org";
            		
            		$to = $emailvol;
            		
            		$subject = "[GAAR Campinas] Procedimento número ".$id." foi deletado";
            		
            		$headers = "MIME-Version: 1.0\n";               
            		$headers .= "Content-type: text/html; charset=utf-8\n";            
            		$headers .= "From: <{$from}> \r\n"; 
            		$message = "Olá ".$nomevol.", <br><br>
            		
            		            <p> O procedimento número ".$id." foi deletado. <br><br>
            		            
            		            
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
                                            <td align='left'>: ".$tipoprocedi."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Quantidade</td>
                                            <td align='left'>: ".$qtde."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Data</td>
                                            <td align='left'>: ".$data."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Observações</td>
                                            <td align='left'>: ".$obs."</td>
                                        </tr>
                                        <tr>
                                            <td align='left'>Aprovado por</td>
                                            <td align='left'>: ".$nome."</td>
                                        </tr>
                                        </table>
                                        
                                        <br>
                                        
                        
            		            Para consultar todos os procedimentos, acesse:<br>
            		            
            		            1. <a href='http://gaarcampinas.org/area/login.html' target=_blank> Área restrita</a><br>
            		            2. Menu Procedimentos<br>
            		            3. Menu Consultar<br><br>
            		            
            		            * Esta notificação foi gerada automaticamente através do sistema *</p>";
            		
            		/*mail($to, $subject, $message, $headers);*/
            		
            		echo"<script language='javascript' type='text/javascript'>
                              alert('Procedimento deletado');;window.location
                                      .href='formcadastroprocedi.php';</script>";
    
    	           
    	    }
    	    else{
        		echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                          echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
                          echo "<a href='pesquisaprocedi.php' class='btn btn-primary'>Voltar</a></center><br>";
            }
	   } else {
	       echo "idprocedi: ".$_POST['idprocedi'];
	   }
	  
}
mysqli_close($connect); 
?>
