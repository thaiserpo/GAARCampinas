<?php 
session_start();

include ("conexao.php"); 

$querydoc = "SELECT * FROM DOCUMENTACAO WHERE AREA_PRINCIPAL='Financeiro'";
$selectdoc = mysqli_query($connect,$querydoc);         

while ($fetchdoc = mysqli_fetch_row($selectdoc)) {
    $bancodoc = $fetchdoc[2];
    $dtdoc = $fetchdoc[10];
    $descdoc = $fetchdoc[4];
    $valordoc = $fetchdoc[9];
    $subtipocat = $fetchdoc[11];
    $img = $fetchdoc[6];
    
    /*echo "<br> bancodoc: ".$bancodoc;
    echo "<br> datadoc : ".$dtdoc;
    echo "<br> descdoc : ".$descdoc;
    echo "<br> valordoc: ".$valordoc;
    echo "<br> subtipo : ".$subtipocat;*/
    
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
            $tipocat = 'Despesa';
            break;
    }


$queryupdate = "UPDATE FINANCEIRO SET 
                            DESCRICAO_LANC = '$descdoc',
                            SUBTIPO_LANC = '$subtipocat',
                            TIPO_LANC = '$tipocat',
                            COMPROVANTE_COMPRA = '$img'
                        WHERE 
                           DATA_LANC = '$dtdoc' AND
                           VALOR_LANC = '$valordoc' AND
                           BANCO_LANC = '$bancodoc'
                           
                           
                        ";
                        
$update = mysqli_query($connect,$queryupdate);

}

?>
