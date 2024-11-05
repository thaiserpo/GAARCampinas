<?php 
session_start();

include ("conexao.php"); 

$codmult = $_GET['codmult'];  
$action = $_GET['action'];
$parm = $_GET['parm'];

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

/*switch ($parm){
	    case 'cod':
			$parm = "cod";
	        break;
	    case 'pet':
	        $parm = "pet";
	        break;
	    case 'nometutor':
	        $parm = "nometutor";
	        break;
	    case 'vet':
	        $parm = "vet";
	        break;
	    case 'ativo':
	        $parm = "ativo";
	        break;
	    case 'realizado':
	        $parm = "realizado";
	        break;
	    default:
	        $parm = "all";
	        break;
	}
*/

$query_pedido = "SELECT * FROM AGENDAMENTO WHERE DATA_AG >= '".$data_atu."' AND ATIVO='SIM'";
$select_pedido = mysqli_query($connect,$query_pedido); 


while ($fetch_pedido = mysqli_fetch_row($select_pedido)) {
      $codigo = $fetch_pedido[0];
      $data_ag = $fetch_pedido[1];
      $nome_animal = $fetch_pedido[3];
      $especie = $fetch_pedido[4];
      $sexo = $fetch_pedido[5];
      $porte = $fetch_pedido[6];
      $dtnasc = $fetch_pedido[8];
      $resp = $fetch_pedido[9];
      $email = $fetch_pedido[12];
	  
	  $tmp_dia_expiracao = new DateTime($data_ag);
    	
	  $tmp_dia_expiracao->modify('+1 day');
	
	  $dia_expiracao = $tmp_dia_expiracao->format('Y-m-d');
      
      $query = "UPDATE AGENDAMENTO SET ATIVO = 'SIM', EXPIRA_EM='$dia_expiracao' WHERE CODIGO='$codigo' ";
      $update = mysqli_query($connect,$query); 
      
      if(mysqli_errno($connect) == '0'){
          //echo "<br> ".$query;
          $log_file_msg ="[atualizaagendadaily.php] Procedimento ".$codigo." atualizado para ATIVO=SIM às ".$horaatu."\n";
          $fp = fopen($log_file, 'a');//opens file in append mode  
          fwrite($fp, $log_file_msg);
      }
      
      $query2 = "UPDATE PEDIDO_CASTRACAO SET CODIGO = '$codigo', STATUS_PEDIDO='APROVADO' WHERE NOME_ANIMAL='$nome_animal' AND ESPECIE='$especie' AND SEXO='$sexo' AND PORTE='$porte' AND DT_NASC='$dtnasc' AND RESPONSAVEL='$resp' AND EMAIL='$email' AND CODIGO ='0'";
      $update2 = mysqli_query($connect,$query2); 
      echo "<br> query2: ",$query2;
      echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect);
}


$query_pedido_antigo = "SELECT * FROM AGENDAMENTO WHERE DATA_AG < '".$data_atu."' AND ATIVO <>'CANCELADO' ";
$select_pedido_antigo = mysqli_query($connect,$query_pedido_antigo); 
$reccount_pedido_antigo = mysqli_num_rows($select_pedido_antigo);
echo "<br> query: ".$query_pedido_antigo;
echo "<br> reccount: ".$reccount_pedido_antigo;

while ($fetch_pedido_antigo = mysqli_fetch_row($select_pedido_antigo)) {
      $codigo = $fetch_pedido_antigo[0];
      $voucher_pdf = "/home1/gaarca06/public_html/area/vouchers/".$codigo.".pdf";
      $query_pedido_antigo = "UPDATE AGENDAMENTO SET ATIVO = 'NÃO', EXPIRA_EM='$dia_expiracao' WHERE CODIGO='$codigo' ";
      $update_pedido_antigo = mysqli_query($connect,$query_pedido_antigo); 
      if (file_exists($voucher_pdf)) {
            if (unlink($voucher_pdf)) {
               $log_file_msg ="[atualizaagendadaily.php] Arquivo excluído com sucesso: ".$voucher_pdf." às ".$horaatu."\n";
               $fp = fopen($log_file, 'a');//opens file in append mode  
               fwrite($fp, $log_file_msg);
            } else {
               $log_file_msg ="[atualizaagendadaily.php] Ocorreu um erro ao excluir o arquivo ".$voucher_pdf." às ".$horaatu."\n";
               $fp = fopen($log_file, 'a');//opens file in append mode  
               fwrite($fp, $log_file_msg);
            }
      } 
      echo "<br>".$log_file_msg;
}

/*
if ($action =='SIM') {
    $action='NÃO';
} else {
    $action ='SIM';
}

if(mysqli_errno($connect) == '0'){
    echo"<script language='javascript' type='text/javascript'>
              alert('Registro atualizado com sucesso!');
    		  window.close();</script>";
} else {
        echo "Insert code: ".$insert;
        echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
}
*/

fclose($fp); 
mysqli_close($connect);

?>