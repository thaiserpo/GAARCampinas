<?php 
session_start();

include ("area/conexao.php"); 

$login = $_SESSION['login'];
//$usuario = $_GET['usuario'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
    
    $usuariovol = $_POST['usuariovol'];
    $nomevol = $_POST['nomevol'];
    $statusvol = $_POST['statusvol'];
    $celularvol = $_POST['celularvol'];
    $emailvol = $_POST['emailvol'];
    $dtnascvol = $_POST['dtnascvol'];
    $termovol = $_POST['termovol'];
    $cpgvol = $_POST['cpgvol'];
    $cpcvol = $_POST['cpcvol'];
    $areavol = $_POST['areavol'];
    $subareavol = $_POST['subareavol'];
    
    
    /*$query = "SELECT * FROM VOLUNTARIOS WHERE USUARIO = '$usuario'";
    $select = mysqli_query($connect,$query);
    $reccount = mysqli_num_rows($select);

    while ($fetch = mysqli_fetch_row($select)) {
            $usuariovol = $fetch[0];
			$nomevol = $fetch[2];	
	        $areavol = $fetch[5];	
	        $subareavol = $fetch[6];	
			$celularvol = $fetch[3];
			$emailvol = $fetch[4];
			$cep = $fetch[18];
			$endereco = $fetch[19];
			$dtnascvol = $fetch[13];
			$statusvol = $fetch[25];
			$cpcvol = $fetch[27];
			$cpgvol = $fetch[7];
			$termovol = $fetch[24];
	}*/
	
	echo "<br> usuariovol: ".$usuariovol;
    echo "<br> statusvol: ".$statusvol;
    
    $queryupdate = "UPDATE VOLUNTARIOS SET
                    STATUS_APROV = '$statusvol',
                    WHERE USUARIO = '$usuariovol'";
                    
    $update = mysqli_query($connect,$queryupdate);
    
    echo "<br> query: ".$queryupdate;

    if(mysqli_errno($connect) == '0'){
        echo"<script language='javascript' type='text/javascript'>
                                    alert('Usuário atualizado com sucesso');window.location
                                    .href='listavoluntarios.php'</script>";
    } else {
        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
          echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
          echo "<a href='listavoluntarios.php' class='btn btn-primary'>Voltar</a></center><br>";
        /*echo"<script language='javascript' type='text/javascript'>
                                    alert('Erro ao atualizar');window.location
                                    .href='listavoluntarios.php'</script>";*/
    }

}
?>