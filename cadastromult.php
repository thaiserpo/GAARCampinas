<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
    $idclinica = $_POST['idclinica'];
    $datamulti = $_POST['datamulti'];
    
    $query = "INSERT INTO MUTIROES
    			(ID_CLINICA, 
    			DATA_MUTIRAO) 
    			VALUES
                ('$idclinica',
                '$datamulti')";
    				
    $insert = mysqli_query($connect,$query); 	
     
    if(mysqli_errno($connect) == '0'){
        /*echo "Insert code: ".$insert;
    	echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
     echo"<script language='javascript' type='text/javascript'>
      alert('Cadastro realizado com sucesso!');
      window.location.href='formcadastromutirao.php'</script>";
    }else{ 
    	echo "Insert code: ".$insert;
    	echo "Mensagem de erro: ".mysql_error(). "SQL Error: ".mysql_errno();
    	echo "Erro ao cadastrar <br><br>";
    	echo "<a href='formcadastromutirao.php'>Voltar</a>";
      /*echo"<script language='javascript' type='text/javascript'>
      alert('Erro ao cadastrar');window.location
      .href='termo.php'</script>";*/
    }
}
?>
