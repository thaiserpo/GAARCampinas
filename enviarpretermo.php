<?php

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->SetFrom('operacional@gaarcampinas.org', 'GAAR Campinas'); //Name is optional

if($login =='' || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{	
		$id = $_GET['idpretermo'];
		
		mysqli_set_charset($connect,'utf8');		
        $query ="SELECT * FROM FORM_PRE_ADOCAO where ID='$id'";
		$select = mysqli_query($connect,$query);
        $fetch = mysqli_fetch_row($select);
		
        $adotante = $fetch[1];
		$cpf = $fetch[2];
		$email = $fetch[3];
		$profissao = $fetch[4];
		$telfixo = $fetch[5];
		$celular = $fetch[6];
		$endereco = $fetch[7];
		$numero = $fetch[70];
		$bairro = $fetch[8];
		$cidade = $fetch[9];
		$cep = $fetch[10];
		$nomeanimal = $fetch[11];
		$especie = $fetch[12];
		$pelagem = $fetch[13];
		$sexo = $fetch[14];
		$facebook = $fetch[15];
		$instagram = $fetch[16];
		$perg1 = $fetch[17];
		$perg2 = $fetch[18];
		$perg3 = $fetch[19];
		$perg4 = $fetch[20];
		$perg5 = $fetch[21];
		$perg6 = $fetch[22];
		$perg7 = $fetch[23];
		$perg8 = $fetch[24];
		$perg9 = $fetch[25];
		$perg10 = $fetch[26];
		$perg11 = $fetch[27];
		$perg12 = $fetch[28];
		$perg13 = $fetch[29];
		$perg14 = $fetch[30];
		$perg15 = $fetch[31];
		$perg16 = $fetch[32];
		$perg17 = $fetch[33];
		$perg18 = $fetch[34];
		$perg19 = $fetch[35];
		$perg20 = $fetch[36];
		$perg21 = $fetch[37];
		$perg22 = $fetch[38];
		$perg23 = $fetch[39];
		$perg24 = $fetch[40];
		$perg25 = $fetch[41];
		$perg26 = $fetch[42];
		$perg27 = $fetch[43];
		$perg28 = $fetch[44];
		$perg29 = $fetch[45];
		$perg30 = $fetch[46];
		$perg31 = $fetch[47];
		$perg32 = $fetch[48];
		$perg33 = $fetch[49];
		$perg34 = $fetch[50];
		$perg35 = $fetch[51];
		$perg36 = $fetch[52];
		$perg37 = $fetch[53];
		$perg38 = $fetch[54];
		$perg39 = $fetch[55];
		$perg40 = $fetch[56];
		$perg41 = $fetch[57];
		$perg42 = $fetch[58];
		$perg43 = $fetch[59];
		$perg44 = $fetch[60];
		$link = $fetch[61];
/*		$foto = $fetch[63];*/
		$perg45 = $fetch[63];
		$obs = $fetch[64];
		$resp = $fetch[68];
			
		$queryvol ="SELECT EMAIL FROM VOLUNTARIOS WHERE NOME = '$resp'";
		$selectvol = mysqli_query($connect,$queryvol);
        $fetchvol = mysqli_fetch_row($selectvol);
		
		$emailvoluntario = $fetchvol[0];
		
		$mensagem ="<center><table width='761' align='left'>
    
         <tr>
         	<th colspan='4' align='center' valign='center'>DADOS DO INTERESSADO</th>
         </tr>
         <tr>
        	<td>&nbsp; </td>
        </tr>
         <tr>
    		<td align='right'><label>Nome: </label></td>
    	    <td align='left'>".$adotante."</td>
    	</tr>
    	<tr>
    		<td align='right'>Endereço:</td>
    		<td align='left'>".$endereco."</td>
    	</tr>
    	<tr>
    		<td align='right'>Número:</td>
    		<td align='left'>".$numero."</td>
    	</tr>
    	<tr>
    		<td align='right'>CPF:</td>
    		<td align='left'>".$cpf."</td>		
    	</tr>
    	<tr>
    		<td align='right'>Bairro:</td>
    	    <td align='left'>".$bairro."</td>
    	</tr>
    	<tr>
    		<td align='right'>CEP:</td>
    		<td align='left'>".$cep."</td>
    	</tr>
    	<tr>
    		<td align='right'><label>Cidade:</label></td>
    	    <td align='left'>".$cidade."</td>
    	</tr>
    	<tr>
    		<td align='right'><label>Celular:</label></td>
    		<td align='left'>".$celular."</td>
    	  </tr>
    	<tr>
    		<td align='right'><label>E-mail:</label></td>
    		<td align='left'><a href='mailto:".$email."'>".$email."</a></td>
    	</tr>
    	<tr>
    		<td align='right'>Profissão:</td>
    		<td align='left'>".$profissao."</td>
    	</tr>
    	<tr>
    		<td align='right'><label>Facebook:</label></td>
    	    <td align='left'>".$facebook."</td>
    	</tr>
    	<tr>
    		<td align='right'><label>Instagram:</label></td>
    		<td align='left'>".$instagram."</td>
    	</tr>
        </table></center>
        <p>&nbsp; &nbsp;</p>
    	<center>
        <table width='761' border='0'>
          <tr>
    		<th colspan='4' align='center' valign='center'>DADOS DO ANIMAL INTERESSADO</th>
          </tr>
          <tr>
            <td width='117' align='center'>Nome:</td>
            <td width='194'>".$nomeanimal."</td>
            <td width='208' align='center'><label>Espécie:</label></td>
            <td width='224'>".$especie."</td>
          </tr>
          <tr>
            <td align='center'>Cor/Pelagem:</td>
            <td>".$pelagem."</td>
            <td align='center'>Sexo:</td>
            <td>".$sexo."</td>
          </tr>
        </table>
    	</center>
            <p>&nbsp; &nbsp;</p>
        <table width='761' border='0' align='center'>
          <tr>
    		<th align='center' valign='middle'><strong>SOBRE O INTERESSADO E SUA FAMILIA</strong></th>
          </tr>
          <tr>
            <td width='181'><label><strong>1)</strong> Todos os membros da família estão dispostos a cuidar e  zelar pela saúde e segurança do animal por todo período de vida dele?  </label></td>
          </tr>
          <tr>
            <td>".$perg1."<br></td>
            </tr>
          <tr>
            <td><label><strong>2)</strong> Quantas pessoas moram em sua residência?</label></td>
          </tr>
          <tr>
            <td>".$perg2."<br><br></td>
          </tr>
          <tr>
            <td><label><strong>3) </strong>Todos estão de acordo com a adoção?</label></td>
          </tr>
          <tr>
            <td>".$perg3."<br><br></td>
          </tr>
          <tr>
            <td><p><strong>4) </strong>Quantas crianças moram com você ou te visitam com  frequência? </p></td>  
          </tr>
          <tr>
            <td>".$perg4."<br><br></td>
          </tr>                    
          <tr>
            <td><strong>5) </strong>Qual a idade das crianças?</td>
          </tr>
          <tr>
            <td>".$perg5."<br><br></td>
          </tr> 
          <tr>
            <td><strong>6) </strong>Essas crianças já tiveram algum contato com animais?</td>
          <tr>
            <td>".$perg6."<br><br></td>
          </tr>
          <tr>
            <td><strong>7) </strong>Há alguém com alergias/rinites? </td>
          <tr>
              <td>".$perg7."<br><br></td>
          </tr>
          <tr>
            <td><strong>8) </strong>Há alguém com problemas respiratórios? </td>
          </tr>
          <tr>
              <td>".$perg8."<br><br> </td>
          </tr>
          </table>
        <table width='761' border='0' align='center'>
          <tr>
            <th align='center' valign='middle'><strong>SOBRE A MORADIA</strong></th>
          </tr>
          <tr>
            <td width='181'><label><strong>9) </strong>Tipo</label></td>
          </tr>
          <tr>
            <td>".$perg9."<br><br></td>
          </tr>
          <tr>
            <td><label><strong>10)</strong> O imóvel é alugado?</label></td>
          </tr>
          <tr>
            <td>".$perg10."<br><br></td>
          </tr>
          <tr>
            <td><label><strong>11) </strong>Caso o imóvel seja alugado, existe alguma restrição  para animais?</label></td>
          </tr>
          <tr>
            <td>".$perg11."<br><br></td>
          </tr>
        </tr>
      	<tr>
        	<td><p><strong>12) </strong>Caso sua residência seja casa, o animal terá acesso livre à rua? </p></td>
        </tr>
        <tr>
          <td>".$perg12."<br><br></td>
        </tr>
        <tr>
            <td><p><strong>13) </strong>Caso sua residência seja casa, qual a altura dos muros?</p></td>
        <tr>
            <td>".$perg13."<br><br></td>
        </tr>
        <tr>
            <td><p><strong>14) </strong>Caso sua residência seja casa, o portão é seguro contra fugas?</p></td>
        </tr>
           	<td>".$perg14."<br><br></td>
          <tr>
            <td><strong>15) </strong>(ADOÇÃO DE GATOS) As Janelas são teladas?  </td>
          </tr>
          <tr>
                 <td>".$perg15."<br><br></td>
          </tr>
          <tr>
                 <td><strong>16) </strong>(ADOÇÃO DE GATOS) Se não estão teladas, pretende  telar?  </td>
          </tr> 
          <tr>
                <td>".$perg16."<br><br></td>
          </tr>
          <tr>
           		<td><strong>17) </strong>(ADOÇÃO DE GATOS) Caso não pretenda  telar, como irá evitar que o animal saia para a rua?</td>
          </tr>
          <tr>
              	<td>".$perg17."<br><br></td>
          </tr>
          <tr>
            <td><strong>18) </strong>Caso sua residência seja apartamento,  contém telas de proteção (telas de proteção para animais e crianças, diferentes  de grades de proteção) em todas as janelas? </td>
          </tr>
          <tr>
            <td>".$perg18."<br><br></td>
          </tr>
          <tr>
            <td><strong>19) </strong>Caso sua residência seja apartamento,  contém telas de proteção (telas de proteção para animais e crianças, diferentes  de grades de proteção) na sacada?</td>
          </tr>
          <tr>
              <td>".$perg19."<br><br></td>
          </tr>
          <tr>
              <td><strong>20) </strong>Caso sua residência seja apartamento,  contém telas de proteção (telas de proteção para animais e crianças, diferentes  de grades de proteção) na janela do banheiro?</td>
          </tr>      
          <tr>
                <td>".$perg20."<br><br></td>
          </tr>
          <tr>
                <td><strong>21) </strong>Caso ocorra situações que alterem a  rotina da família (ex: mudança de casa/cidade, chegada de um bebê, separação do  casal, etc) qual seria a melhor alternativa para o animal adotado? </td>
          </tr>
          <tr>
                  <td>".$perg21."<br><br></td>
          </tr>
          </table>
        <table width='761' border='0' align='center'>
          <tr>
            <th align='center' valign='middle'><strong>SOBRE CUIDADOS E CONVIVÊNCIA</strong></th>
          </tr>
          <tr>
            <td><label><strong>22) </strong>Você tem outros animais? </label></td>
          </tr>
          <tr>
            <td>".$perg22."<br><br></td>
          </tr>
          <tr>
            <td><label><strong>23)</strong> Se sim, quantos?</label></td>
          </tr>
          <tr>
            <td>".$perg23."<br><br></td>
          </tr>
          <tr>
            <td><label><strong>24) </strong>Todos vacinados?</label></td>
          </tr>
          <tr>
            <td>".$perg24."<br><br></td>
          </tr>
        </tr>
      
      	<tr>
        	<td><p><strong>25) </strong>Se são vacinados, foram vacinados em: </p>
        <tr>
          <td>".$perg25."<br><br></td>
        </tr>
        <tr>
            <td><p><strong>26) </strong>Se não são, qual o motivo?</p>
        <tr>
            <td>".$perg26."<br><br></td>
        </tr>
        <tr>
            <td><p><strong>27) </strong>Se tem animais, estão castrados?</p></td>
        </tr>
        <tr>
              <td>".$perg27."<br><br></td>
        </tr>
        <tr>
               <td><strong>28) </strong>Quantos cães?</td>
        </tr>
        <tr>
              <td>".$perg28."<br><br></td>
        </tr>
        <tr>
              <td><strong>29) </strong>Quantos gatos?</td>
        </tr>
        <tr>
             <td>".$perg29."<br><br></td>
        </tr>
        <tr>
             <td><strong>30) </strong>Qual o porte dos cães? </td>
        </tr>
        <tr>
             <td>".$perg30."<br><br></td>
        </tr>
        <tr>
             <td><strong>31) </strong>Já conviveram com outros animais? </td>
        </tr>
        <tr>
             <td>".$perg31."<br><br></td>
        </tr>
        <tr>
             <td><strong>32) </strong>Já teve outros animais que não estão mais com você? </td>
        </tr>
        <tr>
             <td>".$perg32."<br><br></td>
        </tr>
        <tr>
             <td><strong>33) </strong>Caso afirmativo, o que aconteceu? </td>     
        </tr>
        <tr>
             <td>".$perg33."<br><br></td>
        </tr>
        <tr>
              <td><strong>34) </strong>Em  caso de viagem, onde o animal ficará? </td>
        </tr>
        <tr>
              <td>".$perg34."<br><br></td>
        </tr>
        <tr>
             <td><strong>35) </strong>Quantas  horas por dia o animal ficará sozinho? </td>
        </tr>
        <tr>
             <td>".$perg35."<br><br></td>
        </tr>
        <tr>
             <td><strong>36) </strong>Qual  ração pretende dar para o animal?   </td>
        </tr>
        <tr>
             <td>".$perg36."<br><br></td>
        </tr>
        <tr>
              <td><strong>37) </strong>Caso o animal adotado seja um filhote e tenha apenas  uma dose da vacina, pretende terminar de vaciná-lo? </td>
        </tr>
        <tr>
              <td>".$perg37."<br><br></td>
        </tr>
        <tr>
              <td><strong>38) </strong>Terá  condições de vacinar anualmente o animal com vacinas importadas?   </td>
        </tr>
        <tr>
              <td>".$perg38."<br><br></td>
        </tr>
         <tr>
             <td><strong>39) </strong>Terá condições de custear veterinário caso o animal  necessite de cuidados no futuro? (doenças e outras necessidades) </td>
         </tr>
         <tr>
              <td>".$perg39."<br><br></td>
         </tr>
         <tr>
            <td><strong>40) </strong>Caso o animal adotado seja muito jovem e não esteja  castrado, pretende castrar na idade correta? </td>
         </tr>
          <tr>
              <td>".$perg40."<br><br></td>
    	</tr>
        <tr>
            <td><strong>41) </strong>Caso negativo, qual o motivo?</td>
        </tr>
        <tr>
            <td>".$perg41."<br><br></td>
        </tr>
        <tr>
            <td><strong>42) </strong>Um voluntário poderá ir até sua casa, conhecer você e  sua família, e o local onde o animal ficará, entregando-o pessoalmente?</td>
         </tr>
              <td>".$perg42."<br><br></td>
          </tr>
          <tr>
            <td><strong>43) </strong>Concorda em assinar um termo de responsabilidade pelo animal?</td>
          </tr>
              <td>".$perg43."<br><br></td>
          </tr>
          <tr>
            <td><strong>44) </strong>Concorda em manter contato com um(a) voluntário(a),  após a adoção, por tempo indeterminado, informando o estado do animal? </td>
          </tr>
              <td>".$perg44."<br><br></td>
          </tr>
          <tr>
            <td><strong>45) </strong>O GAAR cobra uma taxa de adoção no valor de R$ 50,00 que é um valor simbólico para ajudar nas despesas que a ONG teve com o animal. Você concorda com essa taxa?</td>
          </tr>
              <td>".$perg45."<br><br></td>
          </tr>
          <tr>
            <td>                                          
            <tr>
              <td>Link do anúncio (caso houver): </td>
            </tr>
           	<tr>
    		  <td>".$link."</td>>
              </tr>
          </table>";
		
/*		$adotante = $fetch[1];
		$email = $fetch[11];
		$nomeanimal = $fetch[15];	
		$dtadocao = $fetch[32];
		
		$atual= date('Y-m-d');
		
		$intervalo = $dtadocao->diff($atual);
		
		echo "Intervalo: ".$intervalo; */
	
		$bodytext = $mensagem ;
		
		$subject="[Operacional] Cópia do formulário de interesse em adoção do animal ".$nomeanimal;
		
		/* E-MAIL PARA O RESPONSÁVEL */ 
    
        $mail->Subject   = $subject;
        $mail->Body      = $bodytext;
        $mail->IsHTML(true);
        $to = $emailvoluntario;
        $mail->AddAddress($to);

		//send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo"<script language='javascript' type='text/javascript'>
              alert('E-mail enviado!');window.close();</script>";
        }
		
	    $mail->clearAddresses();
		
		}

;