<?php 
session_start();

include ("conexao.php"); 

require ("vendor/autoload.php"); // Carrega a biblioteca PHPExcel

use PhpOffice\PhpSpreadsheet\IOFactory;

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
} else {
    $queryarealeg = "SELECT AREA,SUBAREA,EMAIL,NOME,CPG FROM VOLUNTARIOS WHERE USUARIO ='$login'";
	$selectarealeg = mysqli_query($connect,$queryarealeg);
	
	while ($fetcharealeg = mysqli_fetch_row($selectarealeg)) {
			$area = $fetcharealeg[0];
			$subarea = $fetcharealeg[1];
			$email = $fetcharealeg[2];
			$nomevoluntario = $fetcharealeg[3];
			$cpg = $fetcharealeg[4];
	}
        

    // Caminho para o arquivo Excel
    $excelFilePath = 'caminho/para/sua/planilha.xlsx';
    
    // Carregar a planilha
    $spreadsheet = IOFactory::load($excelFilePath);
    
    // Selecionar a primeira planilha (índice 0)
    $sheet = $spreadsheet->getSheet(0);
    
    // Obter a última linha e coluna utilizada
    $lastRow = $sheet->getHighestRow();
    $lastColumn = $sheet->getHighestColumn();
    
    // Inicializar uma tabela HTML
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>Banco</th>';
    echo '<th>Data</th>';
    echo '<th>Tag</th>';
    echo '<th>Descrição 1</th>';
    echo '<th>Descrição 2</th>';
    echo '<th>Tipo de Lançamento</th>';
    echo '<th>Valor</th>';
    echo '</tr>';
    
    // Iterar sobre as células e exibir os valores
    for ($row = 2; $row <= $lastRow; $row++) { // Começar a partir da linha 2 para evitar o cabeçalho
        echo '<tr>';
        echo '<td>' . $sheet->getCell('A' . $row)->getValue() . '</td>';
        echo '<td>' . $sheet->getCell('B' . $row)->getValue() . '</td>';
        echo '<td>' . $sheet->getCell('C' . $row)->getValue() . '</td>';
        echo '<td>' . $sheet->getCell('D' . $row)->getValue() . '</td>';
        echo '<td>' . $sheet->getCell('E' . $row)->getValue() . '</td>';
        echo '<td>' . $sheet->getCell('F' . $row)->getValue() . '</td>';
        echo '<td>' . $sheet->getCell('G' . $row)->getValue() . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';


// Feche a conexão com o banco de dados
mysqli_close($connect);
}
?>          


