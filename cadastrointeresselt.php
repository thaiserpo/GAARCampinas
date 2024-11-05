<?php 

session_start();

include ("conexao.php");

$nome = $_POST['nome'];
$email =  strtolower ( $_POST['email']);
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$celular= $_POST['celular'];
$cidade = $_POST['cidade'];
$perg1 = $_POST['perg1'];
$perg2 = $_POST['perg2'];
$perg3 = $_POST['perg3'];
$perg4 = $_POST['perg4'];
$perg5 = $_POST['perg5'];
$perg6 = $_POST['perg6'];
$perg7 = $_POST['perg7'];
$perg8 = $_POST['perg8'];
$perg9 = $_POST['perg9'];
$perg10 = $_POST['perg10'];
$spam  = $_POST['spam'];
$nomeanimal = $_POST['nomeanimal'];

//echo "<br><a href=\"javascript:window.history.go(-1)\" class=\"links\">Voltar</a>";

if ($nomeanimal != ''){
    $como_pode_ajudar = "Deseja ser lar temporário para o animal ".$nomeanimal;
} else {
    $como_pode_ajudar = "Lar temporário";
}

switch ($perg1) {
    case 'Cachorro':
        $como_ajudar ='Lar temporário para cães';
        /*$querycpc = "SELECT EMAIL FROM VOLUNTARIOS WHERE CPC='Sim'";
    	$resultcpc = mysqli_query($connect,$querycpc);*/
    	//echo "<br> switch cachorro";
        break;
        
    case 'Gato':
        $como_ajudar ='Lar temporário para gatos';
        /*$querycpg = "SELECT EMAIL FROM VOLUNTARIOS WHERE CPG='Sim'";
    	$resultcpg = mysqli_query($connect,$querycpg);*/
    	//echo "<br> switch gato";
        break;
        
    default:
        break;
}

//$endereco_completo = $endereco."-".$bairro."-".$cidade;

//echo "<br> endereço: ".$endereco_completo;

$gmaps = str_ireplace (' ','-',$endereco_completo);

$query = "INSERT INTO FORM_VOLUNTARIO (NOME,
                                        EMAIL,
                                        ENDERECO,
                                        BAIRRO,
                                        CIDADE,
                                        TEL_CELULAR,
                                        PERG_01,
                                        PERG_02,
                                        PERG_03,
                                        PERG_04,
                                        PERG_05,
                                        PERG_06,
                                        PERG_07,
                                        PERG_08,
                                        PERG_09,
                                        PERG_10,
                                        COMO_AJUDAR,
                                        COMO_PODE_AJUDAR,
                                        STATUS_APROV) 
                               VALUES ('$nome',
                                       '$email',
                                       '$endereco',
                                       '$bairro',
                                       '$cidade',
                                       '$celular',
                                       '$perg1',
                                       '$perg2',
                                       '$perg3',
                                       '$perg4',
                                       '$perg5',
                                       '$perg6',
                                       '$perg7',
                                       '$perg8',
                                       '$perg9',
                                       '$perg10',
                                       '$como_ajudar',
                                       '$como_pode_ajudar',
                                       '0')";
                                       
//echo "<br> query: ".$query;

$insert = mysqli_query($connect,$query);

//echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";

if(mysqli_errno($connect) == '0'){
    echo"<script language='javascript' type='text/javascript'>
        alert('Cadastro realizado com sucesso!');
        window.location.href='https://gaarcampinas.org/'</script>";
} else {
    echo "<p>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect)."</p><br>";
}
                
                

?>