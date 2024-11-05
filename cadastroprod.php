<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{

$id = $_POST['id'];
$produto = $_POST['produto'];
$modelo = $_POST['caneca_modelo'];
$estampa = $_POST['fundoestampa'];
$caneca_corinterna = $_POST['caneca_corinterna'];
$calendario_modelo = $_POST['calendario_modelo'];
$qtde = $_POST['qtde'];
$valor = $_POST['valor'];
$preco_custo = $_POST['preco_custo'];
$fundoestampa = $_POST['fundoestampa'];
$descricao = $_POST['descricao'];
$volume = $_POST['volume'];
$caneca_corinterna = $_POST['caneca_corinterna'];

        if ($qtde == ''){
            $qtde = 0;
        }
        
        switch ($produto){
            case 'Caneca':
                /*$produto = "Caneca ".$estampa." - ".$caneca_volume." - cor interna ".$caneca_corinterna." - modelo ".$caneca_modelo." - Fundo da estampa: ".$fundoestampa."";*/
                $queryfornec = "SELECT ID FROM FORNECEDORES WHERE PRODUTO ='canecas'";
                $selectfornec = mysqli_query($connect,$queryfornec); 
                while ($fetchfornec = mysqli_fetch_row($selectfornec)) {
                        $idfornec = $fetchfornec[0];
                }
                break;
                
            case 'Calendário':
                $produto = "Calendário de ".$calendario_modelo;
                break;
        }

        		$query = "INSERT INTO CONTROLE_ESTOQUE
        					(PRODUTO, 
        					QTDE,
        					VALOR,
        					PRECO_CUSTO,
        					FUNDO_ESTAMPA,
        					DESCRICAO,
        					VOLUME,
        					MODELO,
        					COR_INTERNA,
        					ID_FORNEC)
        					VALUES
                            ('$produto',
                            '$qtde',
                            '$valor',
                            '$preco_custo',
                            '$estampa',
                            '$descricao',
                            '$volume',
                            '$modelo',
                            '$caneca_corinterna',
                            '$idfornec')";
                            
                $insert = mysqli_query($connect,$query); 	
        		 
                if(mysqli_errno($connect) == '0'){
        		/*	echo "Insert code: ".$insert;
        			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); */
                  echo"<script language='javascript' type='text/javascript'>
                  alert('Produto cadastrado com sucesso!');
        		  window.location.href='formcadastroprod.php'</script>";
        	    }else{ 
        			echo "Insert code: ".$insert;
        			echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect); 
        			echo "<a href='formcadastroprod.php'>Voltar</a>";
                  /*echo"<script language='javascript' type='text/javascript'>
                  alert('Erro ao cadastrar');window.location
                  .href='termo.php'</script>";*/
                }
		}
?>