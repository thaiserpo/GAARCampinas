<?php 

session_start();

include ("conexao.php");

/*// incluir a funcionalidade do recaptcha
require_once ("recaptchalib.php");

// definir a chave secreta
$secret = "6LcwZ7oUAAAAAGQaqFS4tYQrrvGjPAAoqf_WQTJ6";

// verificar a chave secreta
$response = null;
$reCaptcha = new ReCaptcha($secret);

if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
}

// deu tudo certo?
if ($response != null && $response->success) {*/

$query = "SELECT * FROM FORM_VOLUNTARIO WHERE NOME ='luiza rocha'";
		$select = mysqli_query($connect,$query);
		
while ($fetchlt = mysqli_fetch_row($select)) {
      $nome = $fetchlt[1];
      $email = $fetchlt[5];
      $endereco = $fetchlt[21];
      $bairro = $fetchlt[20];
      $cidade = $fetchlt[2];
      $celular = $fetchlt[4];
      $perg1 = $fetchlt[9];
      $perg2 = $fetchlt[10];
      $perg3 = $fetchlt[11];
      $perg4 = $fetchlt[12];
      $perg5 = $fetchlt[13];
      $perg6 = $fetchlt[14];
      $perg7 = $fetchlt[15];
      $perg8 = $fetchlt[16];
      $perg9 = $fetchlt[17];
      $perg10 =$fetchlt[18];
}

echo "<br>perg_01: ".$perg1;

if ($perg1 !=''){

                switch ($perg1) {
                    case 'Cachorro':
                        $como_ajudar ='Lar temporário para cães';
                        $query = "SELECT EMAIL FROM VOLUNTARIOS WHERE CPC='Sim'";
                    	$result = mysqli_query($connect,$query);
                        break;
                        break;
                        
                    case 'Gato':
                        $como_ajudar ='Lar temporário para gatos';
                        $query = "SELECT EMAIL FROM VOLUNTARIOS WHERE CPG='Sim'";
                    	$result = mysqli_query($connect,$query);
                        break;
                }
                
                $reccount = mysqli_num_rows($result);
                
                $endereco_completo = $endereco."-".$bairro."-".$cidade;
                
                $gmaps = str_ireplace (' ','-',$endereco_completo);
                
				echo "<br>email: $email";
				
				echo "<br>reccount: ".$reccount;
				
			    ini_set('display_errors', 1);
    		
    				error_reporting(E_ALL);
    				
    				$from = "captacao@gaarcampinas.org";
    				
    				$to = $email;
    								
    				$headers = "MIME-Version: 1.0\n";               
    				$headers .= "Content-type: text/html; charset=utf-8\n";            
    				$headers .= "From: <{$from}> \r\n";    
    					
    				$message = "Olá, ".$nome." <br><br> Ficamos felizes pelo seu contato em ser voluntário do GAAR! <br><br>Iremos retornar o seu contato em breve :) <br><Br> Atenciosamente, <br> Equipe GAAR <br><br> ****Este e-mail foi enviado automaticamente pelo nosso sistema****";
    				
    				$subject = "[GAAR Campinas] Recebemos seu e-mail!";
    				
    				/*mail($to, $subject, $message, $headers);*/
    				
    				/*E-mail a ser enviado à diretoria */
    				
    				$from = "captacao@gaarcampinas.org";
    				
    				echo "<br>From: ".$from;
            				
    				$headers = "MIME-Version: 1.0\n";               
    				$headers .= "Content-type: text/html; charset=utf-8\n";            
    				$headers .= "From: <{$from}> \r\n";    
    				/*$headers .= "Bcc: thaise.piculi@gmail.com \r\n"; */
    					
    				$message = "Olá Operacional! <br> Recebemos o formulário de interesse de ".$nome." em ser voluntário. <br><Br> 
                                        
                        <B>DADOS DO INTERESSADO</B> <br><br>
                        
                        <table>
                        <tr>
                            <td align='left'>Celular </td>
                            <td align='left'>: ".$celular."</td>
                        </tr>
                        <tr>
                            <td align='left'>E-mail </td>
                            <td align='left'>: ".$email."</td>
                        </tr>
                        <tr>
                            <td align='left'>Endereço </td>
                            <td align='left'>: ".$endereco." &nbsp;&nbsp; <a href='https://www.google.com/maps/place/".$gmaps."/' target='_blank'>Veja no Google Maps</a></td>
                        </tr>
                        <tr>
                            <td align='left'>Bairro </td>
                            <td align='left'>: ".$bairro."</td>
                        </tr>
                        <tr>
                            <td align='left'>Cidade </td>
                            <td align='left'>: ".$cidade."</td>
                        </tr>
                        <tr>
                            <td align='left'>Gostaria de ajudar sendo lt de </td>
                            <td align='left'>: ".$perg1."</td>
                        </tr>
                        <tr>
                            <td align='left'>Porte do cão</td>
                            <td align='left'>: ".$perg2."</td>
                        </tr>
                        <tr>
                            <td align='left'>Tem outro animal em casa?</td>
                            <td align='left'>: ".$perg3."</td>
                        </tr>
                        <tr>
                            <td align='left'>Ele se dá bem com outro animal?</td>
                            <td align='left'>: ".$perg4."</td>
                        </tr>
                        <tr>
                            <td align='left'>O interessado mora em </td>
                            <td align='left'>: ".$perg5."</td>
                        </tr>
                        <tr>
                            <td align='left'>Tem quintal para um cão?</td>
                            <td align='left'>: ".$perg6."</td>
                        </tr>
                        <tr>
                            <td align='left'>Os muros são altos suficientes para impedir fugas?</td>
                            <td align='left'>: ".$perg7."</td>
                        </tr>
                        <tr>
                            <td align='left'>Todas as janelas são teladas?</td>
                            <td align='left'>: ".$perg8."</td>
                        </tr>
                        <tr>
                            <td align='left'>Todos os moradores estão de acordo em ser lar temporário?</td>
                            <td align='left'>: ".$perg9."</td>
                        </tr>
                        <tr>
                            <td align='left'>Por quanto tempo pretende ser lar temporário?</td>
                            <td align='left'>: ".$perg10."</td>
                        </tr>
                        </table>
                        
                        <br><br>
    				    
    				    Essas informações também estarão armazenadas na área restrita. 
    				    <br><br> ****Este e-mail foi enviado automaticamente pelo nosso sistema****";
    				
    				$subject = "".$nome." quer ser lar temporário para ".$perg1."";
    				
    				while ($fetch = mysqli_fetch_row($result)) {
    				    $to = $fetch[0];
    				    echo "<br>to: ".$to;
    				    echo "<br>Headers: ".$headers;
    				    echo "<br>Assunto: ".$subject;
    				    echo "<br>Mensagem: ".$message;
    				    
    				    mail($to, $subject, $message, $headers);
    				}
				
		        }
		        else {
        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
        echo "<p>Por favor escolha a espécie</p><br>";
        echo "<a href='http://gaarcampinas.org/seja-um-lar-temporario/' class='btn btn-primary'>Voltar</a></center><br>";
}

?>