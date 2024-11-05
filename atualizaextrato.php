<?php 
session_start();

include ("conexao.php"); 

$idlanc = $_POST['id'];
$novadesc = $_POST['novadesc'];
$subtipocat = $_POST['subtipocat'];

switch ($subtipocat){
    case 'Sócio':
    case 'Bazar':
    case 'Doações':
    case 'Rifas':
    case 'NFP':
    case 'Vendas':
    case 'Taxas de adoção':
    case 'Juros':
    case 'Outras receitas':
        $tipocat = 'Receita';
        break;
    case 'Lar temporário':
    case 'Ração':
    case 'Veterinário':
    case 'Taxi dog':
    case 'Medicamentos':
    case 'Compras':
    case 'Impostos':
    case 'Ads redes':
    case 'Outras despesas':
    case 'Transferências':
        $tipocat = 'Despesa';
        break;
}


$queryupdate = "UPDATE FINANCEIRO SET 
                            DESCRICAO_LANC = '$novadesc',
                            TAG = '$tag',
                            TIPO_LANC = '$tipocat'
                        WHERE 
                           ID = '$idlanc'
                           
                        ";
                        
$update = mysqli_query($connect,$queryupdate);

if(mysqli_errno($connect) == '0'){
    /*echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect);
    echo "<br> Lançamento atualizado: ID ".$idlanc." - Nova categoria: ".$subtipocat;    */
    echo"<script language='javascript' type='text/javascript'>
                   
                    alert('Lançamento atualizado');
                    
                    window.close();
                    
                    </script>";
}


?>
