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

$query_pedido = "SELECT * FROM AGENDAMENTO";
$select_pedido = mysqli_query($connect,$query_pedido); 

while ($fetch_pedido = mysqli_fetch_row($select_pedido)) {
      $codigo = $fetch_pedido[0];
      $nome_animal = $fetch_pedido[3];
      $especie = $fetch_pedido[4];
      $sexo = $fetch_pedido[5];
      $porte = $fetch_pedido[6];
      $dtnasc = $fetch_pedido[8];
      $resp = $fetch_pedido[9];
      $email = $fetch_pedido[12];
      
      $query = "UPDATE PEDIDO_CASTRACAO SET CODIGO = '$codigo' WHERE NOME_ANIMAL='$nome_animal' AND ESPECIE='$especie' AND SEXO='$sexo' AND PORTE='$porte' AND DT_NASC='$dtnasc' AND RESPONSAVEL='$resp' AND EMAIL='$email' AND CODIGO ='0'";
      $update = mysqli_query($connect,$query); 
      
      if(mysqli_errno($connect) == '0'){
          echo "<br> ".$query;
          //$log_file_msg.="[atualizaagenda.php] ".$query." às ".$horaatu."\n";
          //$fp = fopen($log_file, 'a');//opens file in append mode  
          //fwrite($fp, $log_file_msg);
      }
      
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