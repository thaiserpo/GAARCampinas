<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$idlanc = $_GET['idlanc'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
		}
		
		$querylanc = "SELECT * FROM FINANCEIRO WHERE ID ='$idlanc'";
		$selectlanc = mysqli_query($connect,$querylanc);
		
		while ($fetchlanc = mysqli_fetch_row($selectlanc)) {
		    $dtlanc = $fetchlanc[1] ;
		    $desclanc = $fetchlanc[2] ;
		    $tipolanc = $fetchlanc[3] ;
		    $valorlanc = $fetchlanc[4] ;
		    $bancolanc = $fetchlanc[6] ;
		    $valorcontlanc = $fetchlanc[7] ;
		}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Meta tags Obrigatórias -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <title>GAAR - Atualização de lançamentos</title>
    <script>
        function ShowDiv() {
            var socio = form.socio.value;
        
            document.write(socio);
        
            if (document.form.socio[0].checked == false ){
                alert('Preencha o campo Sócio');
				return false;
                
               // document.getElementById("socio").style.display = 'block';
            }
        }
        
    </script>
</head>
<body> 
<?php 
		
		switch ($area) {
				  case 'operacional':
				  	include_once("menu_operacional.php") ;
					break;
				  case 'diretoria':
				  	include_once("menu_diretoria.php") ;
					break;
				  case 'captacao':
				  	include_once("menu_captacao.php") ;
					break;
     			  case 'financeiro':
				  	include_once("menu_financeiro.php") ;
					break;
				  case 'admin':
				  	include_once("menu_admin.php") ;
					break;
				  case 'comunicacao':
				  	include_once("menu_comunicacao.php") ;
					break;
				  
			  }
			  
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
       <center>
        <h3>ATUALIZAÇÃO DE LANÇAMENTOS BANCÁRIOS</h3><br>
        <p><label> É importante atualizar o lançamento corretamente pois as informações aqui preenchidas irão ser usadas para realizar pagamentos, gerar estatísticas e relatórios.</label></p>
       <br></center>
  <form action="cadastrolanc.php" method="POST" enctype="multipart/form-data" name="form">
        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Data: </label> 
                            <input type="date" id="dtlanc" name ="dtlanc" class="form-control" required value="<? echo $dtlanc ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Descrição: </label> 
                            <input type="text" id="desc" maxlength="500" name ="desc" class="form-control" required value="<? echo $desclanc ?>">
                        </div>
        </div>
                            <?
                                if ($tipolanc =='Sócio'){
                                   echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio' checked><label class='form-check-label' for='gridRadios1' > Sócio </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1'> Nota Fiscal Paulista </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1'> Taxas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'> Outras receitas </label> <br>
                                            </div>
                                             </div>
                                            </div>
                                            </fieldset>
                                            <fieldset class='form-group'>
                                                <div class='row'>
                                                  <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                                  <div class='col-sm-10'>
                                                    <div class='form-check'>
                                                        <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                        <input type ='radio' id='tipo' name ='tipo' value='Ração'><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                        <input type ='radio' id='tipo' name ='tipo' value='Veterinário'><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                        <input type ='radio' id='tipo' name ='tipo' value='Taxi dog'><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                        <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                        <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                        <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                        <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                                </div>
                                             </div>
                                            </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Bazar'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Bazar' checked><label class='form-check-label' for='gridRadios1'  > Bazar </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1'> Nota Fiscal Paulista </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1'> Taxas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração'><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário'><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog'><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                                </div>
                                             </div>
                                            </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Doações'){
                                   echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Doações' checked><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1'> Nota Fiscal Paulista </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1'> Taxas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração'><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário'><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog'><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                                </div>
                                             </div>
                                            </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Rifas'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Rifas' checked><label class='form-check-label' for='gridRadios1' checked> Rifas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1'> Nota Fiscal Paulista </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1'> Taxas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração'><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário'><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog'><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                                </div>
                                             </div>
                                            </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='NFP'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='NFP' checked><label class='form-check-label' for='gridRadios1' checked> Nota Fiscal Paulista </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1'> Taxas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração'><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário'><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog'><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                                </div>
                                             </div>
                                            </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Vendas'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1' > Nota Fiscal Paulista </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Vendas' checked><label class='form-check-label' for='gridRadios1' checked> Vendas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1'> Taxas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração'><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário'><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog'><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                                </div>
                                             </div>
                                            </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Taxas'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1' > Nota Fiscal Paulista </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Taxas' checked><label class='form-check-label' for='gridRadios1' checked> Taxas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração'><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário'><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog'><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                                </div>
                                             </div>
                                            </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Juros'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1' > Nota Fiscal Paulista </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1' > Taxas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Juros' checked><label class='form-check-label' for='gridRadios1' checked> Juros </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração'><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário'><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog'><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                                </div>
                                             </div>
                                            </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Outros-receitas'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1' > Nota Fiscal Paulista </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1' > Taxas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas' checked><label class='form-check-label' for='gridRadios1'  checked> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração'><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário'><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog'><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                                </div>
                                             </div>
                                            </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='LT'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1' > Nota Fiscal Paulista </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1' > Taxas </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                        <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'  checked> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                            <input type ='radio' id='tipo' name ='tipo' value='LT' checked><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                            <input type ='radio' id='tipo' name ='tipo' value='Ração'><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                            <input type ='radio' id='tipo' name ='tipo' value='Veterinário'><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                            <input type ='radio' id='tipo' name ='tipo' value='Taxi dog'><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                            <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                            <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                            <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                            <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                            </div>
                                         </div>
                                        </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Ração'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1' > Nota Fiscal Paulista </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1' > Taxas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'  checked> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração' checked><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário'><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog'><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                            </div>
                                         </div>
                                        </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Veterinário'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1' > Nota Fiscal Paulista </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1' > Taxas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'  checked> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração' ><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário' checked><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog'><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                            </div>
                                         </div>
                                        </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Taxi dog'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1' > Nota Fiscal Paulista </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1' > Taxas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'  checked> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração' ><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário' ><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog' checked><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos'><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                            </div>
                                         </div>
                                        </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Medicamentos'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1' > Nota Fiscal Paulista </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1' > Taxas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'  checked> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração' ><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário' ><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog' ><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos' checked><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras'><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                            </div>
                                         </div>
                                        </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Compras'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1' > Nota Fiscal Paulista </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1' > Taxas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'  checked> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração' ><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário' ><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog' ><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos' ><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras' checked><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos'><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                            </div>
                                         </div>
                                        </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Impostos'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1' > Nota Fiscal Paulista </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1' > Taxas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'  checked> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração' ><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário' ><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog' ><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos' ><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras' ><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos' checked><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas'><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                            </div>
                                         </div>
                                        </div>
                                        </fieldset>";
                                }
                                if ($tipolanc =='Outros-despesas'){
                                    echo "<fieldset class='form-group'>
                                        <div class='row'>
                                          <legend class='col-form-label col-sm-2 pt-0'>Receitas<font color='red'><strong>*</strong></font>: </legend>
                                          <div class='col-sm-10'>
                                            <div class='form-check'>
                                                <input type ='radio' id='tipo' name ='tipo' value='Sócio'><label class='form-check-label' for='gridRadios1'> Sócio </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Bazar'><label class='form-check-label' for='gridRadios1'> Bazar </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Doações'><label class='form-check-label' for='gridRadios1'> Doações </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Rifas'><label class='form-check-label' for='gridRadios1'> Rifas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='NFP'><label class='form-check-label' for='gridRadios1' > Nota Fiscal Paulista </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Vendas'><label class='form-check-label' for='gridRadios1'> Vendas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Taxas'><label class='form-check-label' for='gridRadios1' > Taxas </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Juros'><label class='form-check-label' for='gridRadios1'> Juros </label> <br>
                                                <input type ='radio' id='tipo' name ='tipo' value='Outros-receitas'><label class='form-check-label' for='gridRadios1'  checked> Outras receitas </label> <br>
                                        </div>
                                         </div>
                                        </div>
                                        </fieldset>
                                        <fieldset class='form-group'>
                                            <div class='row'>
                                              <legend class='col-form-label col-sm-2 pt-0'>Despesas<font color='red'><strong>*</strong></font>: </legend>
                                              <div class='col-sm-10'>
                                                <div class='form-check'>
                                                    <input type ='radio' id='tipo' name ='tipo' value='LT'><label class='form-check-label' for='gridRadios1'> Lar temporário</label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Ração' ><label class='form-check-label' for='gridRadios1'> Ração </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Veterinário' ><label class='form-check-label' for='gridRadios1'> Veterinário </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Taxi dog' ><label class='form-check-label' for='gridRadios1'> Táxi dog </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Medicamentos' ><label class='form-check-label' for='gridRadios1'> Medicamentos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Compras' ><label class='form-check-label' for='gridRadios1'> Compras </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Impostos' ><label class='form-check-label' for='gridRadios1'> Impostos </label> <br>
                                                    <input type ='radio' id='tipo' name ='tipo' value='Outros-despesas' checked><label class='form-check-label' for='gridRadios1'> Outras despesas </label> <br>
                                            </div>
                                         </div>
                                        </div>
                                        </fieldset>";
                                }
                            ?>
                        </div>
                     </div>
                    </div>
                    <br>
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Banco da operação<font color="red"><strong>*</strong></font>:</legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                            <?
                                if ($bancolanc == 'Banco Itaú'){
                                    echo "<input type ='radio'id='banco' name ='banco' value='Banco Itaú' checked><label class='form-check-label' for='gridRadios1'> Banco Itaú</label> <br>
                                            <input type ='radio'id='banco' name ='banco' value='Banco do Brasil'><label class='form-check-label' for='gridRadios1'>Banco do Brasil</label> <br>
                                            <input type ='radio'id='banco' name ='banco' value='Pagseguro'><label class='form-check-label' for='gridRadios1'>Pagseguro</label></label> <br>
                                            <input type ='radio'id='banco' name ='banco' value='Apoiese'><label class='form-check-label' for='gridRadios1'>Apoia.se</label> <br>";
                                }
                                if ($bancolanc == 'Banco do Brasil'){
                                    echo "<input type ='radio'id='banco' name ='banco' value='Banco Itaú' ><label class='form-check-label' for='gridRadios1'> Banco Itaú</label> <br>
                                            <input type ='radio'id='banco' name ='banco' value='Banco do Brasil' checked><label class='form-check-label' for='gridRadios1'>Banco do Brasil</label> <br>
                                            <input type ='radio'id='banco' name ='banco' value='Pagseguro'><label class='form-check-label' for='gridRadios1'>Pagseguro</label></label> <br>
                                            <input type ='radio'id='banco' name ='banco' value='Apoiese'><label class='form-check-label' for='gridRadios1'>Apoia.se</label> <br>";
                                }
                                if ($bancolanc == 'Pagseguro'){
                                    echo "<input type ='radio'id='banco' name ='banco' value='Banco Itaú' ><label class='form-check-label' for='gridRadios1'> Banco Itaú</label> <br>
                                            <input type ='radio'id='banco' name ='banco' value='Banco do Brasil'><label class='form-check-label' for='gridRadios1'>Banco do Brasil</label> <br>
                                            <input type ='radio'id='banco' name ='banco' value='Pagseguro' checked><label class='form-check-label' for='gridRadios1'>Pagseguro</label></label> <br>
                                            <input type ='radio'id='banco' name ='banco' value='Apoiese'><label class='form-check-label' for='gridRadios1'>Apoia.se</label> <br>";
                                }
                                if ($bancolanc == 'Apoiese'){
                                    echo "<input type ='radio'id='banco' name ='banco' value='Banco Itaú' ><label class='form-check-label' for='gridRadios1'> Banco Itaú</label> <br>
                                            <input type ='radio'id='banco' name ='banco' value='Banco do Brasil'><label class='form-check-label' for='gridRadios1'>Banco do Brasil</label> <br>
                                            <input type ='radio'id='banco' name ='banco' value='Pagseguro' checked><label class='form-check-label' for='gridRadios1'>Pagseguro</label></label> <br>
                                            <input type ='radio'id='banco' name ='banco' value='Apoiese' checked><label class='form-check-label' for='gridRadios1'>Apoia.se</label> <br>";
                                }
                            ?>
                        </div>
                      </div>
                    </div>
                </fieldset>
     <div class="form-row">
            <div class="form-group col-md-6">
                  <label>Valor<font color="red"><strong>*</strong></font>: </label>
                  <div class="input-group-prepend">
                        <div class="input-group-text">R$</div>
                            <input type="text" class="form-control" type="text" id="valor" name="valor" value="<? echo $valorlanc ?>">
                  </div>
            </div>
		   <div class="form-group col-md-6">
		            <? if ($subarea =='diretoria') {
		                echo "<label>Relatório contábil: </label>
		                      <div class='input-group-prepend'>
                                <div class='input-group-text'>R$</div>
                                    <input type='text' class='form-control'name='valorcont' id='valorcont' value='".$valorcontlanc."'>
                                </div>
                              </div>";
		            }
                  ?>
    <div class="form-row">
            <label>Recibo ou comprovante: </label>
            <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" name="file">
                    <label class="custom-file-label" for="validatedCustomFile">Escolher arquivo</label>
                </div>
            </div>
    </div>
	</div>
	<br><br>
	<font color="red"><strong>* Campos obrigatórios</strong></font><br>
   <center><a href="javascript:form.submit()" class="btn btn-primary">Cadastrar</a></center>
      </form>
      <br>
    </div>
</main>
<br>
<footer class="footer fixed-bottom bg-light">
      <div class="container">
        <p class="text-center">GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
      </div>
    </footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>