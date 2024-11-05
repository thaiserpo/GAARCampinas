<?php 

session_start();

include ("conexao.php"); 

$ano = date("Y");

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
    
    <link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">

    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/auto-refresh/bootstrap-table-auto-refresh.min.js"></script>
    <!--- BOOTSTRAP --->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--- BOOTSTRAP --->
    <title>GAAR - Relatório anual </title>
    <!--- GOOGLE ADSENSE --->
     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
     <!--- GOOGLE ADSENSE --->
</head>

<body>
<main role="main" class="container">
    <div class="starter-template">
    <center>
        <img src="/area/logo_transparent.png" width="70" height="70"><br><p>Grupo de Apoio ao Animal de Rua - Campinas/SP</p><br><br>
    </center>
<?

        /** SOMATÓRIA DO SUBTIPO LANÇAMENTO **/
        function select_subtipolanc_mensal($anolanc_func,$meslanc_func,$subtipolanc_func,$connect){
				$querysumvalor = "SELECT SUM(VALOR_LANC) FROM FINANCEIRO WHERE DATA_LANC LIKE '".$anolanc_func."-".$meslanc_func."-%' AND SUBTIPO_LANC = '".$subtipolanc_func."'";
				$resultsumvalor = mysqli_query($connect,$querysumvalor);
			    $rc = mysqli_fetch_row($resultsumvalor);
			    $sum = $rc[0];
			    
			    if ($sum ==''){
			        $sum = 0;
			    }

				return($sum);
		}

        $sumvalor_adestrador_01 = select_subtipolanc_mensal($ano,'01','Adestrador',$connect);
        $sumvalor_adestrador_02 = select_subtipolanc_mensal($ano,'02','Adestrador',$connect);
        $sumvalor_adestrador_03 = select_subtipolanc_mensal($ano,'03','Adestrador',$connect);
        $sumvalor_adestrador_04 = select_subtipolanc_mensal($ano,'04','Adestrador',$connect);
        $sumvalor_adestrador_05 = select_subtipolanc_mensal($ano,'05','Adestrador',$connect);
        $sumvalor_adestrador_06 = select_subtipolanc_mensal($ano,'06','Adestrador',$connect);
        $sumvalor_adestrador_07 = select_subtipolanc_mensal($ano,'07','Adestrador',$connect);
        $sumvalor_adestrador_08 = select_subtipolanc_mensal($ano,'08','Adestrador',$connect);
        $sumvalor_adestrador_09 = select_subtipolanc_mensal($ano,'09','Adestrador',$connect);
        $sumvalor_adestrador_10 = select_subtipolanc_mensal($ano,'10','Adestrador',$connect);
        $sumvalor_adestrador_11 = select_subtipolanc_mensal($ano,'11','Adestrador',$connect);
        $sumvalor_adestrador_12 = select_subtipolanc_mensal($ano,'12','Adestrador',$connect);
        
        $sumvalor_adestrador = floatval($sumvalor_adestrador_01) + floatval($sumvalor_adestrador_02) + floatval($sumvalor_adestrador_03) + floatval($sumvalor_adestrador_04) + floatval($sumvalor_adestrador_05) + floatval($sumvalor_adestrador_06) +
                            floatval($sumvalor_adestrador_07) + floatval($sumvalor_adestrador_08) + floatval($sumvalor_adestrador_09) + floatval($sumvalor_adestrador_10) + floatval($sumvalor_adestrador_11) + floatval($sumvalor_adestrador_12);
        
      	$sumvalor_cartorio_01 = select_subtipolanc_mensal($ano,'01','Cartório',$connect);
        $sumvalor_cartorio_02 = select_subtipolanc_mensal($ano,'02','Cartório',$connect);
        $sumvalor_cartorio_03 = select_subtipolanc_mensal($ano,'03','Cartório',$connect);
        $sumvalor_cartorio_04 = select_subtipolanc_mensal($ano,'04','Cartório',$connect);
        $sumvalor_cartorio_05 = select_subtipolanc_mensal($ano,'05','Cartório',$connect);
        $sumvalor_cartorio_06 = select_subtipolanc_mensal($ano,'06','Cartório',$connect);
        $sumvalor_cartorio_07 = select_subtipolanc_mensal($ano,'07','Cartório',$connect);
        $sumvalor_cartorio_08 = select_subtipolanc_mensal($ano,'08','Cartório',$connect);
        $sumvalor_cartorio_09 = select_subtipolanc_mensal($ano,'09','Cartório',$connect);
        $sumvalor_cartorio_10 = select_subtipolanc_mensal($ano,'10','Cartório',$connect);
        $sumvalor_cartorio_11 = select_subtipolanc_mensal($ano,'11','Cartório',$connect);
        $sumvalor_cartorio_12 = select_subtipolanc_mensal($ano,'12','Cartório',$connect);
        
        $sumvalor_cartorio = floatval($sumvalor_cartorio_01) + floatval($sumvalor_cartorio_02) + floatval($sumvalor_cartorio_03) + floatval($sumvalor_cartorio_04) + floatval($sumvalor_cartorio_05) + floatval($sumvalor_cartorio_06) +
                            floatval($sumvalor_cartorio_07) + floatval($sumvalor_cartorio_08) + floatval($sumvalor_cartorio_09) + floatval($sumvalor_cartorio_10) + floatval($sumvalor_cartorio_11) + floatval($sumvalor_cartorio_12);
      	
      	$sumvalor_bricolagem_01 = select_subtipolanc_mensal($ano,'01','Bricolagem',$connect);
        $sumvalor_bricolagem_02 = select_subtipolanc_mensal($ano,'02','Bricolagem',$connect);
        $sumvalor_bricolagem_03 = select_subtipolanc_mensal($ano,'03','Bricolagem',$connect);
        $sumvalor_bricolagem_04 = select_subtipolanc_mensal($ano,'04','Bricolagem',$connect);
        $sumvalor_bricolagem_05 = select_subtipolanc_mensal($ano,'05','Bricolagem',$connect);
        $sumvalor_bricolagem_06 = select_subtipolanc_mensal($ano,'06','Bricolagem',$connect);
        $sumvalor_bricolagem_07 = select_subtipolanc_mensal($ano,'07','Bricolagem',$connect);
        $sumvalor_bricolagem_08 = select_subtipolanc_mensal($ano,'08','Bricolagem',$connect);
        $sumvalor_bricolagem_09 = select_subtipolanc_mensal($ano,'09','Bricolagem',$connect);
        $sumvalor_bricolagem_10 = select_subtipolanc_mensal($ano,'10','Bricolagem',$connect);
        $sumvalor_bricolagem_11 = select_subtipolanc_mensal($ano,'11','Bricolagem',$connect);
        $sumvalor_bricolagem_12 = select_subtipolanc_mensal($ano,'12','Bricolagem',$connect);
        
        $sumvalor_bricolagem = floatval($sumvalor_bricolagem_01) + floatval($sumvalor_bricolagem_02) + floatval($sumvalor_bricolagem_03) + floatval($sumvalor_bricolagem_04) + floatval($sumvalor_bricolagem_05) + floatval($sumvalor_bricolagem_06) +
                            floatval($sumvalor_bricolagem_07) + floatval($sumvalor_bricolagem_08) + floatval($sumvalor_bricolagem_09) + floatval($sumvalor_bricolagem_10) + floatval($sumvalor_bricolagem_11) + floatval($sumvalor_bricolagem_12);

      	$sumvalor_cemiterio_01 = select_subtipolanc_mensal($ano,'01','Cemitério',$connect);
        $sumvalor_cemiterio_02 = select_subtipolanc_mensal($ano,'02','Cemitério',$connect);
        $sumvalor_cemiterio_03 = select_subtipolanc_mensal($ano,'03','Cemitério',$connect);
        $sumvalor_cemiterio_04 = select_subtipolanc_mensal($ano,'04','Cemitério',$connect);
        $sumvalor_cemiterio_05 = select_subtipolanc_mensal($ano,'05','Cemitério',$connect);
        $sumvalor_cemiterio_06 = select_subtipolanc_mensal($ano,'06','Cemitério',$connect);
        $sumvalor_cemiterio_07 = select_subtipolanc_mensal($ano,'07','Cemitério',$connect);
        $sumvalor_cemiterio_08 = select_subtipolanc_mensal($ano,'08','Cemitério',$connect);
        $sumvalor_cemiterio_09 = select_subtipolanc_mensal($ano,'09','Cemitério',$connect);
        $sumvalor_cemiterio_10 = select_subtipolanc_mensal($ano,'10','Cemitério',$connect);
        $sumvalor_cemiterio_11 = select_subtipolanc_mensal($ano,'11','Cemitério',$connect);
        $sumvalor_cemiterio_12 = select_subtipolanc_mensal($ano,'12','Cemitério',$connect);
        
        $sumvalor_cemiterio = floatval($sumvalor_cemiterio_01) + floatval($sumvalor_cemiterio_02) + floatval($sumvalor_cemiterio_03) + floatval($sumvalor_cemiterio_04) + floatval($sumvalor_cemiterio_05) + floatval($sumvalor_cemiterio_06) +
                            floatval($sumvalor_cemiterio_07) + floatval($sumvalor_cemiterio_08) + floatval($sumvalor_cemiterio_09) + floatval($sumvalor_cemiterio_10) + floatval($sumvalor_cemiterio_11) + floatval($sumvalor_cemiterio_12);

      	
      	$sumvalor_compras_01 = select_subtipolanc_mensal($ano,'01','Compras',$connect);
        $sumvalor_compras_02 = select_subtipolanc_mensal($ano,'02','Compras',$connect);
        $sumvalor_compras_03 = select_subtipolanc_mensal($ano,'03','Compras',$connect);
        $sumvalor_compras_04 = select_subtipolanc_mensal($ano,'04','Compras',$connect);
        $sumvalor_compras_05 = select_subtipolanc_mensal($ano,'05','Compras',$connect);
        $sumvalor_compras_06 = select_subtipolanc_mensal($ano,'06','Compras',$connect);
        $sumvalor_compras_07 = select_subtipolanc_mensal($ano,'07','Compras',$connect);
        $sumvalor_compras_08 = select_subtipolanc_mensal($ano,'08','Compras',$connect);
        $sumvalor_compras_09 = select_subtipolanc_mensal($ano,'09','Compras',$connect);
        $sumvalor_compras_10 = select_subtipolanc_mensal($ano,'10','Compras',$connect);
        $sumvalor_compras_11 = select_subtipolanc_mensal($ano,'11','Compras',$connect);
        $sumvalor_compras_12 = select_subtipolanc_mensal($ano,'12','Compras',$connect);
        
        $sumvalor_compras = floatval($sumvalor_compras_01) + floatval($sumvalor_compras_02) + floatval($sumvalor_compras_03) + floatval($sumvalor_compras_04) + floatval($sumvalor_compras_05) + floatval($sumvalor_compras_06) +
                            floatval($sumvalor_compras_07) + floatval($sumvalor_compras_08) + floatval($sumvalor_compras_09) + floatval($sumvalor_compras_10) + floatval($sumvalor_compras_11) + floatval($sumvalor_compras_12);
        
        $sumvalor_grafica_01 = select_subtipolanc_mensal($ano,'01','Gráfica',$connect);
        $sumvalor_grafica_02 = select_subtipolanc_mensal($ano,'02','Gráfica',$connect);
        $sumvalor_grafica_03 = select_subtipolanc_mensal($ano,'03','Gráfica',$connect);
        $sumvalor_grafica_04 = select_subtipolanc_mensal($ano,'04','Gráfica',$connect);
        $sumvalor_grafica_05 = select_subtipolanc_mensal($ano,'05','Gráfica',$connect);
        $sumvalor_grafica_06 = select_subtipolanc_mensal($ano,'06','Gráfica',$connect);
        $sumvalor_grafica_07 = select_subtipolanc_mensal($ano,'07','Gráfica',$connect);
        $sumvalor_grafica_08 = select_subtipolanc_mensal($ano,'08','Gráfica',$connect);
        $sumvalor_grafica_09 = select_subtipolanc_mensal($ano,'09','Gráfica',$connect);
        $sumvalor_grafica_10 = select_subtipolanc_mensal($ano,'10','Gráfica',$connect);
        $sumvalor_grafica_11 = select_subtipolanc_mensal($ano,'11','Gráfica',$connect);
        $sumvalor_grafica_12 = select_subtipolanc_mensal($ano,'12','Gráfica',$connect);
        
        $sumvalor_grafica = floatval($sumvalor_grafica_01) + floatval($sumvalor_grafica_02) + floatval($sumvalor_grafica_03) + floatval($sumvalor_grafica_04) + floatval($sumvalor_grafica_05) + floatval($sumvalor_grafica_06) +
                            floatval($sumvalor_grafica_07) + floatval($sumvalor_grafica_08) + floatval($sumvalor_grafica_09) + floatval($sumvalor_grafica_10) + floatval($sumvalor_grafica_11) + floatval($sumvalor_grafica_12);

        $sumvalor_imposto_01 = select_subtipolanc_mensal($ano,'01','Impostos bancários e/ou federais',$connect);
        $sumvalor_imposto_02 = select_subtipolanc_mensal($ano,'02','Impostos bancários e/ou federais',$connect);
        $sumvalor_imposto_03 = select_subtipolanc_mensal($ano,'03','Impostos bancários e/ou federais',$connect);
        $sumvalor_imposto_04 = select_subtipolanc_mensal($ano,'04','Impostos bancários e/ou federais',$connect);
        $sumvalor_imposto_05 = select_subtipolanc_mensal($ano,'05','Impostos bancários e/ou federais',$connect);
        $sumvalor_imposto_06 = select_subtipolanc_mensal($ano,'06','Impostos bancários e/ou federais',$connect);
        $sumvalor_imposto_07 = select_subtipolanc_mensal($ano,'07','Impostos bancários e/ou federais',$connect);
        $sumvalor_imposto_08 = select_subtipolanc_mensal($ano,'08','Impostos bancários e/ou federais',$connect);
        $sumvalor_imposto_09 = select_subtipolanc_mensal($ano,'09','Impostos bancários e/ou federais',$connect);
        $sumvalor_imposto_10 = select_subtipolanc_mensal($ano,'10','Impostos bancários e/ou federais',$connect);
        $sumvalor_imposto_11 = select_subtipolanc_mensal($ano,'11','Impostos bancários e/ou federais',$connect);
        $sumvalor_imposto_12 = select_subtipolanc_mensal($ano,'12','Impostos bancários e/ou federais',$connect);
        
        $sumvalor_imposto = floatval($sumvalor_imposto_01) + floatval($sumvalor_imposto_02) + floatval($sumvalor_imposto_03) + floatval($sumvalor_imposto_04) + floatval($sumvalor_imposto_05) + floatval($sumvalor_imposto_06) +
                            floatval($sumvalor_imposto_07) + floatval($sumvalor_imposto_08) + floatval($sumvalor_imposto_09) + floatval($sumvalor_imposto_10) + floatval($sumvalor_imposto_11) + floatval($sumvalor_imposto_12);

        $sumvalor_lojavirtual_01 = select_subtipolanc_mensal($ano,'01','Mensalidade Loja Virtual',$connect);
        $sumvalor_lojavirtual_02 = select_subtipolanc_mensal($ano,'02','Mensalidade Loja Virtual',$connect);
        $sumvalor_lojavirtual_03 = select_subtipolanc_mensal($ano,'03','Mensalidade Loja Virtual',$connect);
        $sumvalor_lojavirtual_04 = select_subtipolanc_mensal($ano,'04','Mensalidade Loja Virtual',$connect);
        $sumvalor_lojavirtual_05 = select_subtipolanc_mensal($ano,'05','Mensalidade Loja Virtual',$connect);
        $sumvalor_lojavirtual_06 = select_subtipolanc_mensal($ano,'06','Mensalidade Loja Virtual',$connect);
        $sumvalor_lojavirtual_07 = select_subtipolanc_mensal($ano,'07','Mensalidade Loja Virtual',$connect);
        $sumvalor_lojavirtual_08 = select_subtipolanc_mensal($ano,'08','Mensalidade Loja Virtual',$connect);
        $sumvalor_lojavirtual_09 = select_subtipolanc_mensal($ano,'09','Mensalidade Loja Virtual',$connect);
        $sumvalor_lojavirtual_10 = select_subtipolanc_mensal($ano,'10','Mensalidade Loja Virtual',$connect);
        $sumvalor_lojavirtual_11 = select_subtipolanc_mensal($ano,'11','Mensalidade Loja Virtual',$connect);
        $sumvalor_lojavirtual_12 = select_subtipolanc_mensal($ano,'12','Mensalidade Loja Virtual',$connect);
        
        $sumvalor_lojavirtual = floatval($sumvalor_lojavirtual_01) + floatval($sumvalor_lojavirtual_02) + floatval($sumvalor_lojavirtual_03) + floatval($sumvalor_lojavirtual_04) + floatval($sumvalor_lojavirtual_05) + floatval($sumvalor_lojavirtual_06) +
                            floatval($sumvalor_lojavirtual_07) + floatval($sumvalor_lojavirtual_08) + floatval($sumvalor_lojavirtual_09) + floatval($sumvalor_lojavirtual_10) + floatval($sumvalor_lojavirtual_11) + floatval($sumvalor_lojavirtual_12);


        $sumvalor_lt_01 = select_subtipolanc_mensal($ano,'01','Lar temporário',$connect);
        $sumvalor_lt_02 = select_subtipolanc_mensal($ano,'02','Lar temporário',$connect);
        $sumvalor_lt_03 = select_subtipolanc_mensal($ano,'03','Lar temporário',$connect);
        $sumvalor_lt_04 = select_subtipolanc_mensal($ano,'04','Lar temporário',$connect);
        $sumvalor_lt_05 = select_subtipolanc_mensal($ano,'05','Lar temporário',$connect);
        $sumvalor_lt_06 = select_subtipolanc_mensal($ano,'06','Lar temporário',$connect);
        $sumvalor_lt_07 = select_subtipolanc_mensal($ano,'07','Lar temporário',$connect);
        $sumvalor_lt_08 = select_subtipolanc_mensal($ano,'08','Lar temporário',$connect);
        $sumvalor_lt_09 = select_subtipolanc_mensal($ano,'09','Lar temporário',$connect);
        $sumvalor_lt_10 = select_subtipolanc_mensal($ano,'10','Lar temporário',$connect);
        $sumvalor_lt_11 = select_subtipolanc_mensal($ano,'11','Lar temporário',$connect);
        $sumvalor_lt_12 = select_subtipolanc_mensal($ano,'12','Lar temporário',$connect);
        
        $sumvalor_lt = floatval($sumvalor_lt_01) + floatval($sumvalor_lt_02) + floatval($sumvalor_lt_03) + floatval($sumvalor_lt_04) + floatval($sumvalor_lt_05) + floatval($sumvalor_lt_06) +
                            floatval($sumvalor_lt_07) + floatval($sumvalor_lt_08) + floatval($sumvalor_lt_09) + floatval($sumvalor_lt_10) + floatval($sumvalor_lt_11) + floatval($sumvalor_lt_12);


        $sumvalor_racao_01 = select_subtipolanc_mensal($ano,'01','Ração',$connect);
        $sumvalor_racao_02 = select_subtipolanc_mensal($ano,'02','Ração',$connect);
        $sumvalor_racao_03 = select_subtipolanc_mensal($ano,'03','Ração',$connect);
        $sumvalor_racao_04 = select_subtipolanc_mensal($ano,'04','Ração',$connect);
        $sumvalor_racao_05 = select_subtipolanc_mensal($ano,'05','Ração',$connect);
        $sumvalor_racao_06 = select_subtipolanc_mensal($ano,'06','Ração',$connect);
        $sumvalor_racao_07 = select_subtipolanc_mensal($ano,'07','Ração',$connect);
        $sumvalor_racao_08 = select_subtipolanc_mensal($ano,'08','Ração',$connect);
        $sumvalor_racao_09 = select_subtipolanc_mensal($ano,'09','Ração',$connect);
        $sumvalor_racao_10 = select_subtipolanc_mensal($ano,'10','Ração',$connect);
        $sumvalor_racao_11 = select_subtipolanc_mensal($ano,'11','Ração',$connect);
        $sumvalor_racao_12 = select_subtipolanc_mensal($ano,'12','Ração',$connect);
        
        $sumvalor_racao = floatval($sumvalor_racao_01) + floatval($sumvalor_racao_02) + floatval($sumvalor_racao_03) + floatval($sumvalor_racao_04) + floatval($sumvalor_racao_05) + floatval($sumvalor_racao_06) +
                            floatval($sumvalor_racao_07) + floatval($sumvalor_racao_08) + floatval($sumvalor_racao_09) + floatval($sumvalor_racao_10) + floatval($sumvalor_racao_11) + floatval($sumvalor_racao_12);


        $sumvalor_redes_01 = select_subtipolanc_mensal($ano,'01','Anúncios patrocinados redes sociais',$connect);
        $sumvalor_redes_02 = select_subtipolanc_mensal($ano,'02','Anúncios patrocinados redes sociais',$connect);
        $sumvalor_redes_03 = select_subtipolanc_mensal($ano,'03','Anúncios patrocinados redes sociais',$connect);
        $sumvalor_redes_04 = select_subtipolanc_mensal($ano,'04','Anúncios patrocinados redes sociais',$connect);
        $sumvalor_redes_05 = select_subtipolanc_mensal($ano,'05','Anúncios patrocinados redes sociais',$connect);
        $sumvalor_redes_06 = select_subtipolanc_mensal($ano,'06','Anúncios patrocinados redes sociais',$connect);
        $sumvalor_redes_07 = select_subtipolanc_mensal($ano,'07','Anúncios patrocinados redes sociais',$connect);
        $sumvalor_redes_08 = select_subtipolanc_mensal($ano,'08','Anúncios patrocinados redes sociais',$connect);
        $sumvalor_redes_09 = select_subtipolanc_mensal($ano,'09','Anúncios patrocinados redes sociais',$connect);
        $sumvalor_redes_10 = select_subtipolanc_mensal($ano,'10','Anúncios patrocinados redes sociais',$connect);
        $sumvalor_redes_11 = select_subtipolanc_mensal($ano,'11','Anúncios patrocinados redes sociais',$connect);
        $sumvalor_redes_12 = select_subtipolanc_mensal($ano,'12','Anúncios patrocinados redes sociais',$connect);
        
        $sumvalor_redes = floatval($sumvalor_redes_01) + floatval($sumvalor_redes_02) + floatval($sumvalor_redes_03) + floatval($sumvalor_redes_04) + floatval($sumvalor_redes_05) + floatval($sumvalor_redes_06) +
                          floatval($sumvalor_redes_07) + floatval($sumvalor_redes_08) + floatval($sumvalor_redes_09) + floatval($sumvalor_redes_10) + floatval($sumvalor_redes_11) + floatval($sumvalor_redes_12);
        
        $sumvalor_renovacao_01 = select_subtipolanc_mensal($ano,'01','Renovação',$connect);
        $sumvalor_renovacao_02 = select_subtipolanc_mensal($ano,'02','Renovação',$connect);
        $sumvalor_renovacao_03 = select_subtipolanc_mensal($ano,'03','Renovação',$connect);
        $sumvalor_renovacao_04 = select_subtipolanc_mensal($ano,'04','Renovação',$connect);
        $sumvalor_renovacao_05 = select_subtipolanc_mensal($ano,'05','Renovação',$connect);
        $sumvalor_renovacao_06 = select_subtipolanc_mensal($ano,'06','Renovação',$connect);
        $sumvalor_renovacao_07 = select_subtipolanc_mensal($ano,'07','Renovação',$connect);
        $sumvalor_renovacao_08 = select_subtipolanc_mensal($ano,'08','Renovação',$connect);
        $sumvalor_renovacao_09 = select_subtipolanc_mensal($ano,'09','Renovação',$connect);
        $sumvalor_renovacao_10 = select_subtipolanc_mensal($ano,'10','Renovação',$connect);
        $sumvalor_renovacao_11 = select_subtipolanc_mensal($ano,'11','Renovação',$connect);
        $sumvalor_renovacao_12 = select_subtipolanc_mensal($ano,'12','Renovação',$connect);
        
        $sumvalor_renovacao = floatval($sumvalor_renovacao_01) + floatval($sumvalor_renovacao_02) + floatval($sumvalor_renovacao_03) + floatval($sumvalor_renovacao_04) + floatval($sumvalor_renovacao_05) + floatval($sumvalor_renovacao_06) +
                            floatval($sumvalor_renovacao_07) + floatval($sumvalor_renovacao_08) + floatval($sumvalor_renovacao_09) + floatval($sumvalor_renovacao_10) + floatval($sumvalor_renovacao_11) + floatval($sumvalor_renovacao_12);

        $sumvalor_taxidog_01 = select_subtipolanc_mensal($ano,'01','Taxi Dog',$connect);
        $sumvalor_taxidog_02 = select_subtipolanc_mensal($ano,'02','Taxi Dog',$connect);
        $sumvalor_taxidog_03 = select_subtipolanc_mensal($ano,'03','Taxi Dog',$connect);
        $sumvalor_taxidog_04 = select_subtipolanc_mensal($ano,'04','Taxi Dog',$connect);
        $sumvalor_taxidog_05 = select_subtipolanc_mensal($ano,'05','Taxi Dog',$connect);
        $sumvalor_taxidog_06 = select_subtipolanc_mensal($ano,'06','Taxi Dog',$connect);
        $sumvalor_taxidog_07 = select_subtipolanc_mensal($ano,'07','Taxi Dog',$connect);
        $sumvalor_taxidog_08 = select_subtipolanc_mensal($ano,'08','Taxi Dog',$connect);
        $sumvalor_taxidog_09 = select_subtipolanc_mensal($ano,'09','Taxi Dog',$connect);
        $sumvalor_taxidog_10 = select_subtipolanc_mensal($ano,'10','Taxi Dog',$connect);
        $sumvalor_taxidog_11 = select_subtipolanc_mensal($ano,'11','Taxi Dog',$connect);
        $sumvalor_taxidog_12 = select_subtipolanc_mensal($ano,'12','Taxi Dog',$connect);
        
        $sumvalor_taxidog = floatval($sumvalor_taxidog_01) + floatval($sumvalor_taxidog_02) + floatval($sumvalor_taxidog_03) + floatval($sumvalor_taxidog_04) + floatval($sumvalor_taxidog_05) + floatval($sumvalor_taxidog_06) +
                            floatval($sumvalor_taxidog_07) + floatval($sumvalor_taxidog_08) + floatval($sumvalor_taxidog_09) + floatval($sumvalor_taxidog_10) + floatval($sumvalor_taxidog_11) + floatval($sumvalor_taxidog_12);

        $sumvalor_vet_01 = select_subtipolanc_mensal($ano,'01','Veterinário',$connect);
        $sumvalor_vet_02 = select_subtipolanc_mensal($ano,'02','Veterinário',$connect);
        $sumvalor_vet_03 = select_subtipolanc_mensal($ano,'03','Veterinário',$connect);
        $sumvalor_vet_04 = select_subtipolanc_mensal($ano,'04','Veterinário',$connect);
        $sumvalor_vet_05 = select_subtipolanc_mensal($ano,'05','Veterinário',$connect);
        $sumvalor_vet_06 = select_subtipolanc_mensal($ano,'06','Veterinário',$connect);
        $sumvalor_vet_07 = select_subtipolanc_mensal($ano,'07','Veterinário',$connect);
        $sumvalor_vet_08 = select_subtipolanc_mensal($ano,'08','Veterinário',$connect);
        $sumvalor_vet_09 = select_subtipolanc_mensal($ano,'09','Veterinário',$connect);
        $sumvalor_vet_10 = select_subtipolanc_mensal($ano,'10','Veterinário',$connect);
        $sumvalor_vet_11 = select_subtipolanc_mensal($ano,'11','Veterinário',$connect);
        $sumvalor_vet_12 = select_subtipolanc_mensal($ano,'12','Veterinário',$connect);
        
        $sumvalor_vet = floatval($sumvalor_vet_01) + floatval($sumvalor_vet_02) + floatval($sumvalor_vet_03) + floatval($sumvalor_vet_04) + floatval($sumvalor_vet_05) + floatval($sumvalor_vet_06) +
                            floatval($sumvalor_vet_07) + floatval($sumvalor_vet_08) + floatval($sumvalor_vet_09) + floatval($sumvalor_vet_10) + floatval($sumvalor_vet_11) + floatval($sumvalor_vet_12);

        
        /* SOMATORIO DESPESAS MENSAIS */
        $sumdespesas_jan = floatval($sumvalor_adestrador_01) + floatval($sumvalor_redes_01) +  floatval($sumvalor_cartorio_01) + floatval($sumvalor_bricolagem_01) + floatval($sumvalor_cemiterio_01) + floatval($sumvalor_compras_01) +  floatval($sumvalor_grafica_01) + floatval($sumvalor_imposto_01) + floatval($sumvalor_lojavirtual_01) + floatval($sumvalor_lt_01) + floatval($sumvalor_racao_01) +  floatval ($sumvalor_renovacao_01) + floatval ($sumvalor_taxidog_01) + floatval($sumvalor_vet_01);
        $sumdespesas_fev = floatval($sumvalor_adestrador_02) + floatval($sumvalor_redes_02) +  floatval($sumvalor_cartorio_02) + floatval($sumvalor_bricolagem_02) + floatval($sumvalor_cemiterio_02) + floatval($sumvalor_compras_02) +  floatval($sumvalor_grafica_02) + floatval($sumvalor_imposto_02) + floatval($sumvalor_lojavirtual_02) + floatval($sumvalor_lt_02) + floatval($sumvalor_racao_02) +  floatval ($sumvalor_renovacao_02) + floatval ($sumvalor_taxidog_02) + floatval($sumvalor_vet_02);
        $sumdespesas_mar = floatval($sumvalor_adestrador_03) + floatval($sumvalor_redes_03) +  floatval($sumvalor_cartorio_03) + floatval($sumvalor_bricolagem_03) + floatval($sumvalor_cemiterio_03) + floatval($sumvalor_compras_03) +  floatval($sumvalor_grafica_03) + floatval($sumvalor_imposto_03) + floatval($sumvalor_lojavirtual_03) + floatval($sumvalor_lt_03) + floatval($sumvalor_racao_03) +  floatval ($sumvalor_renovacao_03) + floatval ($sumvalor_taxidog_03) + floatval($sumvalor_vet_03);
        $sumdespesas_abr = floatval($sumvalor_adestrador_04) + floatval($sumvalor_redes_04) +  floatval($sumvalor_cartorio_04) + floatval($sumvalor_bricolagem_04) + floatval($sumvalor_cemiterio_04) + floatval($sumvalor_compras_04) +  floatval($sumvalor_grafica_04) + floatval($sumvalor_imposto_04) + floatval($sumvalor_lojavirtual_04) + floatval($sumvalor_lt_04) + floatval($sumvalor_racao_04) +  floatval ($sumvalor_renovacao_04) + floatval ($sumvalor_taxidog_04) + floatval($sumvalor_vet_04);
        $sumdespesas_mai = floatval($sumvalor_adestrador_05) + floatval($sumvalor_redes_05) +  floatval($sumvalor_cartorio_05) + floatval($sumvalor_bricolagem_05) + floatval($sumvalor_cemiterio_05) + floatval($sumvalor_compras_05) +  floatval($sumvalor_grafica_05) + floatval($sumvalor_imposto_05) + floatval($sumvalor_lojavirtual_05) + floatval($sumvalor_lt_05) + floatval($sumvalor_racao_05) +  floatval ($sumvalor_renovacao_05) + floatval ($sumvalor_taxidog_05) + floatval($sumvalor_vet_05);
        $sumdespesas_jun = floatval($sumvalor_adestrador_06) + floatval($sumvalor_redes_06) +  floatval($sumvalor_cartorio_06) + floatval($sumvalor_bricolagem_06) + floatval($sumvalor_cemiterio_06) + floatval($sumvalor_compras_06) +  floatval($sumvalor_grafica_06) + floatval($sumvalor_imposto_06) + floatval($sumvalor_lojavirtual_06) + floatval($sumvalor_lt_06) + floatval($sumvalor_racao_06) +  floatval ($sumvalor_renovacao_06) + floatval ($sumvalor_taxidog_06) + floatval($sumvalor_vet_06);
        $sumdespesas_jul = floatval($sumvalor_adestrador_07) + floatval($sumvalor_redes_07) +  floatval($sumvalor_cartorio_07) + floatval($sumvalor_bricolagem_07) + floatval($sumvalor_cemiterio_07) + floatval($sumvalor_compras_07) +  floatval($sumvalor_grafica_07) + floatval($sumvalor_imposto_07) + floatval($sumvalor_lojavirtual_07) + floatval($sumvalor_lt_07) + floatval($sumvalor_racao_07) +  floatval ($sumvalor_renovacao_07) + floatval ($sumvalor_taxidog_07) + floatval($sumvalor_vet_07);
        $sumdespesas_ago = floatval($sumvalor_adestrador_08) + floatval($sumvalor_redes_08) +  floatval($sumvalor_cartorio_08) + floatval($sumvalor_bricolagem_08) + floatval($sumvalor_cemiterio_08) + floatval($sumvalor_compras_08) +  floatval($sumvalor_grafica_08) + floatval($sumvalor_imposto_08) + floatval($sumvalor_lojavirtual_08) + floatval($sumvalor_lt_08) + floatval($sumvalor_racao_08) +  floatval ($sumvalor_renovacao_08) + floatval ($sumvalor_taxidog_08) + floatval($sumvalor_vet_08);
        $sumdespesas_set = floatval($sumvalor_adestrador_09) + floatval($sumvalor_redes_09) +  floatval($sumvalor_cartorio_09) + floatval($sumvalor_bricolagem_09) + floatval($sumvalor_cemiterio_09) + floatval($sumvalor_compras_09) +  floatval($sumvalor_grafica_09) + floatval($sumvalor_imposto_09) + floatval($sumvalor_lojavirtual_09) + floatval($sumvalor_lt_09) + floatval($sumvalor_racao_09) +  floatval ($sumvalor_renovacao_09) + floatval ($sumvalor_taxidog_09) + floatval($sumvalor_vet_09);
        $sumdespesas_out = floatval($sumvalor_adestrador_10) + floatval($sumvalor_redes_10) +  floatval($sumvalor_cartorio_10) + floatval($sumvalor_bricolagem_10) + floatval($sumvalor_cemiterio_10) + floatval($sumvalor_compras_10) +  floatval($sumvalor_grafica_10) + floatval($sumvalor_imposto_10) + floatval($sumvalor_lojavirtual_10) + floatval($sumvalor_lt_10) + floatval($sumvalor_racao_10) +  floatval ($sumvalor_renovacao_10) + floatval ($sumvalor_taxidog_10) + floatval($sumvalor_vet_10);
        $sumdespesas_nov = floatval($sumvalor_adestrador_11) + floatval($sumvalor_redes_11) +  floatval($sumvalor_cartorio_11) + floatval($sumvalor_bricolagem_11) + floatval($sumvalor_cemiterio_11) + floatval($sumvalor_compras_11) +  floatval($sumvalor_grafica_11) + floatval($sumvalor_imposto_11) + floatval($sumvalor_lojavirtual_11) + floatval($sumvalor_lt_11) + floatval($sumvalor_racao_11) +  floatval ($sumvalor_renovacao_11) + floatval ($sumvalor_taxidog_11) + floatval($sumvalor_vet_11);
        $sumdespesas_dez = floatval($sumvalor_adestrador_12) + floatval($sumvalor_redes_12) +  floatval($sumvalor_cartorio_12) + floatval($sumvalor_bricolagem_12) + floatval($sumvalor_cemiterio_12) + floatval($sumvalor_compras_12) +  floatval($sumvalor_grafica_12) + floatval($sumvalor_imposto_12) + floatval($sumvalor_lojavirtual_12) + floatval($sumvalor_lt_12) + floatval($sumvalor_racao_12) +  floatval ($sumvalor_renovacao_12) + floatval ($sumvalor_taxidog_12) + floatval($sumvalor_vet_12);
        
        /* RECEITAS */
        $sumvalor_bazares_01 = select_subtipolanc_mensal($ano,'01','Bazares',$connect);
        $sumvalor_bazares_02 = select_subtipolanc_mensal($ano,'02','Bazares',$connect);
        $sumvalor_bazares_03 = select_subtipolanc_mensal($ano,'03','Bazares',$connect);
        $sumvalor_bazares_04 = select_subtipolanc_mensal($ano,'04','Bazares',$connect);
        $sumvalor_bazares_05 = select_subtipolanc_mensal($ano,'05','Bazares',$connect);
        $sumvalor_bazares_06 = select_subtipolanc_mensal($ano,'06','Bazares',$connect);
        $sumvalor_bazares_07 = select_subtipolanc_mensal($ano,'07','Bazares',$connect);
        $sumvalor_bazares_08 = select_subtipolanc_mensal($ano,'08','Bazares',$connect);
        $sumvalor_bazares_09 = select_subtipolanc_mensal($ano,'09','Bazares',$connect);
        $sumvalor_bazares_10 = select_subtipolanc_mensal($ano,'10','Bazares',$connect);
        $sumvalor_bazares_11 = select_subtipolanc_mensal($ano,'11','Bazares',$connect);
        $sumvalor_bazares_12 = select_subtipolanc_mensal($ano,'12','Bazares',$connect);
        
        $sumvalor_bazares = floatval($sumvalor_bazares_01) + floatval($sumvalor_bazares_02) + floatval($sumvalor_bazares_03) + floatval($sumvalor_bazares_04) + floatval($sumvalor_bazares_05) + floatval($sumvalor_bazares_06) +
                            floatval($sumvalor_bazares_07) + floatval($sumvalor_bazares_08) + floatval($sumvalor_bazares_09) + floatval($sumvalor_bazares_10) + floatval($sumvalor_bazares_11) + floatval($sumvalor_bazares_12);
                            
        
        $sumvalor_doacoes_01 = select_subtipolanc_mensal($ano,'01','Doações',$connect);
        $sumvalor_doacoes_02 = select_subtipolanc_mensal($ano,'02','Doações',$connect);
        $sumvalor_doacoes_03 = select_subtipolanc_mensal($ano,'03','Doações',$connect);
        $sumvalor_doacoes_04 = select_subtipolanc_mensal($ano,'04','Doações',$connect);
        $sumvalor_doacoes_05 = select_subtipolanc_mensal($ano,'05','Doações',$connect);
        $sumvalor_doacoes_06 = select_subtipolanc_mensal($ano,'06','Doações',$connect);
        $sumvalor_doacoes_07 = select_subtipolanc_mensal($ano,'07','Doações',$connect);
        $sumvalor_doacoes_08 = select_subtipolanc_mensal($ano,'08','Doações',$connect);
        $sumvalor_doacoes_09 = select_subtipolanc_mensal($ano,'09','Doações',$connect);
        $sumvalor_doacoes_10 = select_subtipolanc_mensal($ano,'10','Doações',$connect);
        $sumvalor_doacoes_11 = select_subtipolanc_mensal($ano,'11','Doações',$connect);
        $sumvalor_doacoes_12 = select_subtipolanc_mensal($ano,'12','Doações',$connect);
        
        $sumvalor_doacoes = floatval($sumvalor_doacoes_01) + floatval($sumvalor_doacoes_02) + floatval($sumvalor_doacoes_03) + floatval($sumvalor_doacoes_04) + floatval($sumvalor_doacoes_05) + floatval($sumvalor_doacoes_06) +
                            floatval($sumvalor_doacoes_07) + floatval($sumvalor_doacoes_08) + floatval($sumvalor_doacoes_09) + floatval($sumvalor_doacoes_10) + floatval($sumvalor_doacoes_11) + floatval($sumvalor_doacoes_12);

        $sumvalor_rendimentos_01 = select_subtipolanc_mensal($ano,'01','Rendimentos',$connect);
        $sumvalor_rendimentos_02 = select_subtipolanc_mensal($ano,'02','Rendimentos',$connect);
        $sumvalor_rendimentos_03 = select_subtipolanc_mensal($ano,'03','Rendimentos',$connect);
        $sumvalor_rendimentos_04 = select_subtipolanc_mensal($ano,'04','Rendimentos',$connect);
        $sumvalor_rendimentos_05 = select_subtipolanc_mensal($ano,'05','Rendimentos',$connect);
        $sumvalor_rendimentos_06 = select_subtipolanc_mensal($ano,'06','Rendimentos',$connect);
        $sumvalor_rendimentos_07 = select_subtipolanc_mensal($ano,'07','Rendimentos',$connect);
        $sumvalor_rendimentos_08 = select_subtipolanc_mensal($ano,'08','Rendimentos',$connect);
        $sumvalor_rendimentos_09 = select_subtipolanc_mensal($ano,'09','Rendimentos',$connect);
        $sumvalor_rendimentos_10 = select_subtipolanc_mensal($ano,'10','Rendimentos',$connect);
        $sumvalor_rendimentos_11 = select_subtipolanc_mensal($ano,'11','Rendimentos',$connect);
        $sumvalor_rendimentos_12 = select_subtipolanc_mensal($ano,'12','Rendimentos',$connect);
        
        $sumvalor_rendimentos = floatval($sumvalor_rendimentos_01) + floatval($sumvalor_rendimentos_02) + floatval($sumvalor_rendimentos_03) + floatval($sumvalor_rendimentos_04) + floatval($sumvalor_rendimentos_05) + floatval($sumvalor_rendimentos_06) +
                            floatval($sumvalor_rendimentos_07) + floatval($sumvalor_rendimentos_08) + floatval($sumvalor_rendimentos_09) + floatval($sumvalor_rendimentos_10) + floatval($sumvalor_rendimentos_11) + floatval($sumvalor_rendimentos_12);

        
        $sumvalor_nfp_01 = select_subtipolanc_mensal($ano,'01','Nota Fiscal Paulista',$connect);
        $sumvalor_nfp_02 = select_subtipolanc_mensal($ano,'02','Nota Fiscal Paulista',$connect);
        $sumvalor_nfp_03 = select_subtipolanc_mensal($ano,'03','Nota Fiscal Paulista',$connect);
        $sumvalor_nfp_04 = select_subtipolanc_mensal($ano,'04','Nota Fiscal Paulista',$connect);
        $sumvalor_nfp_05 = select_subtipolanc_mensal($ano,'05','Nota Fiscal Paulista',$connect);
        $sumvalor_nfp_06 = select_subtipolanc_mensal($ano,'06','Nota Fiscal Paulista',$connect);
        $sumvalor_nfp_07 = select_subtipolanc_mensal($ano,'07','Nota Fiscal Paulista',$connect);
        $sumvalor_nfp_08 = select_subtipolanc_mensal($ano,'08','Nota Fiscal Paulista',$connect);
        $sumvalor_nfp_09 = select_subtipolanc_mensal($ano,'09','Nota Fiscal Paulista',$connect);
        $sumvalor_nfp_10 = select_subtipolanc_mensal($ano,'10','Nota Fiscal Paulista',$connect);
        $sumvalor_nfp_11 = select_subtipolanc_mensal($ano,'11','Nota Fiscal Paulista',$connect);
        $sumvalor_nfp_12 = select_subtipolanc_mensal($ano,'12','Nota Fiscal Paulista',$connect);
        
        $sumvalor_nfp = floatval($sumvalor_nfp_01) + floatval($sumvalor_nfp_02) + floatval($sumvalor_nfp_03) + floatval($sumvalor_nfp_04) + floatval($sumvalor_nfp_05) + floatval($sumvalor_nfp_06) +
                            floatval($sumvalor_nfp_07) + floatval($sumvalor_nfp_08) + floatval($sumvalor_nfp_09) + floatval($sumvalor_nfp_10) + floatval($sumvalor_nfp_11) + floatval($sumvalor_nfp_12);

        $sumvalor_socios_01 = select_subtipolanc_mensal($ano,'01','Sócio',$connect);
        $sumvalor_socios_02 = select_subtipolanc_mensal($ano,'02','Sócio',$connect);
        $sumvalor_socios_03 = select_subtipolanc_mensal($ano,'03','Sócio',$connect);
        $sumvalor_socios_04 = select_subtipolanc_mensal($ano,'04','Sócio',$connect);
        $sumvalor_socios_05 = select_subtipolanc_mensal($ano,'05','Sócio',$connect);
        $sumvalor_socios_06 = select_subtipolanc_mensal($ano,'06','Sócio',$connect);
        $sumvalor_socios_07 = select_subtipolanc_mensal($ano,'07','Sócio',$connect);
        $sumvalor_socios_08 = select_subtipolanc_mensal($ano,'08','Sócio',$connect);
        $sumvalor_socios_09 = select_subtipolanc_mensal($ano,'09','Sócio',$connect);
        $sumvalor_socios_10 = select_subtipolanc_mensal($ano,'10','Sócio',$connect);
        $sumvalor_socios_11 = select_subtipolanc_mensal($ano,'11','Sócio',$connect);
        $sumvalor_socios_12 = select_subtipolanc_mensal($ano,'12','Sócio',$connect);
        
        $sumvalor_socios = floatval($sumvalor_socios_01) + floatval($sumvalor_socios_02) + floatval($sumvalor_socios_03) + floatval($sumvalor_socios_04) + floatval($sumvalor_socios_05) + floatval($sumvalor_socios_06) +
                            floatval($sumvalor_socios_07) + floatval($sumvalor_socios_08) + floatval($sumvalor_socios_09) + floatval($sumvalor_socios_10) + floatval($sumvalor_socios_11) + floatval($sumvalor_socios_12);

        $sumvalor_rifas_01 = select_subtipolanc_mensal($ano,'01','Rifas',$connect);
        $sumvalor_rifas_02 = select_subtipolanc_mensal($ano,'02','Rifas',$connect);
        $sumvalor_rifas_03 = select_subtipolanc_mensal($ano,'03','Rifas',$connect);
        $sumvalor_rifas_04 = select_subtipolanc_mensal($ano,'04','Rifas',$connect);
        $sumvalor_rifas_05 = select_subtipolanc_mensal($ano,'05','Rifas',$connect);
        $sumvalor_rifas_06 = select_subtipolanc_mensal($ano,'06','Rifas',$connect);
        $sumvalor_rifas_07 = select_subtipolanc_mensal($ano,'07','Rifas',$connect);
        $sumvalor_rifas_08 = select_subtipolanc_mensal($ano,'08','Rifas',$connect);
        $sumvalor_rifas_09 = select_subtipolanc_mensal($ano,'09','Rifas',$connect);
        $sumvalor_rifas_10 = select_subtipolanc_mensal($ano,'10','Rifas',$connect);
        $sumvalor_rifas_11 = select_subtipolanc_mensal($ano,'11','Rifas',$connect);
        $sumvalor_rifas_12 = select_subtipolanc_mensal($ano,'12','Rifas',$connect);
        
        $sumvalor_rifas = floatval($sumvalor_rifas_01) + floatval($sumvalor_rifas_02) + floatval($sumvalor_rifas_03) + floatval($sumvalor_rifas_04) + floatval($sumvalor_rifas_05) + floatval($sumvalor_rifas_06) +
                            floatval($sumvalor_rifas_07) + floatval($sumvalor_rifas_08) + floatval($sumvalor_rifas_09) + floatval($sumvalor_rifas_10) + floatval($sumvalor_rifas_11) + floatval($sumvalor_rifas_12);

        $sumvalor_taxaadocao_01 = select_subtipolanc_mensal($ano,'01','Taxa de Adoção',$connect);
        $sumvalor_taxaadocao_02 = select_subtipolanc_mensal($ano,'02','Taxa de Adoção',$connect);
        $sumvalor_taxaadocao_03 = select_subtipolanc_mensal($ano,'03','Taxa de Adoção',$connect);
        $sumvalor_taxaadocao_04 = select_subtipolanc_mensal($ano,'04','Taxa de Adoção',$connect);
        $sumvalor_taxaadocao_05 = select_subtipolanc_mensal($ano,'05','Taxa de Adoção',$connect);
        $sumvalor_taxaadocao_06 = select_subtipolanc_mensal($ano,'06','Taxa de Adoção',$connect);
        $sumvalor_taxaadocao_07 = select_subtipolanc_mensal($ano,'07','Taxa de Adoção',$connect);
        $sumvalor_taxaadocao_08 = select_subtipolanc_mensal($ano,'08','Taxa de Adoção',$connect);
        $sumvalor_taxaadocao_09 = select_subtipolanc_mensal($ano,'09','Taxa de Adoção',$connect);
        $sumvalor_taxaadocao_10 = select_subtipolanc_mensal($ano,'10','Taxa de Adoção',$connect);
        $sumvalor_taxaadocao_11 = select_subtipolanc_mensal($ano,'11','Taxa de Adoção',$connect);
        $sumvalor_taxaadocao_12 = select_subtipolanc_mensal($ano,'12','Taxa de Adoção',$connect);
        
        $sumvalor_taxaadocao = floatval($sumvalor_taxaadocao_01) + floatval($sumvalor_taxaadocao_02) + floatval($sumvalor_taxaadocao_03) + floatval($sumvalor_taxaadocao_04) + floatval($sumvalor_taxaadocao_05) + floatval($sumvalor_taxaadocao_06) +
                            floatval($sumvalor_taxaadocao_07) + floatval($sumvalor_taxaadocao_08) + floatval($sumvalor_taxaadocao_09) + floatval($sumvalor_taxaadocao_10) + floatval($sumvalor_taxaadocao_11) + floatval($sumvalor_taxaadocao_12);

        
        $sumvalor_vendas_01 = select_subtipolanc_mensal($ano,'01','Vendas',$connect);
        $sumvalor_vendas_02 = select_subtipolanc_mensal($ano,'02','Vendas',$connect);
        $sumvalor_vendas_03 = select_subtipolanc_mensal($ano,'03','Vendas',$connect);
        $sumvalor_vendas_04 = select_subtipolanc_mensal($ano,'04','Vendas',$connect);
        $sumvalor_vendas_05 = select_subtipolanc_mensal($ano,'05','Vendas',$connect);
        $sumvalor_vendas_06 = select_subtipolanc_mensal($ano,'06','Vendas',$connect);
        $sumvalor_vendas_07 = select_subtipolanc_mensal($ano,'07','Vendas',$connect);
        $sumvalor_vendas_08 = select_subtipolanc_mensal($ano,'08','Vendas',$connect);
        $sumvalor_vendas_09 = select_subtipolanc_mensal($ano,'09','Vendas',$connect);
        $sumvalor_vendas_10 = select_subtipolanc_mensal($ano,'10','Vendas',$connect);
        $sumvalor_vendas_11 = select_subtipolanc_mensal($ano,'11','Vendas',$connect);
        $sumvalor_vendas_12 = select_subtipolanc_mensal($ano,'12','Vendas',$connect);
        
        $sumvalor_vendas = floatval($sumvalor_vendas_01) + floatval($sumvalor_vendas_02) + floatval($sumvalor_vendas_03) + floatval($sumvalor_vendas_04) + floatval($sumvalor_vendas_05) + floatval($sumvalor_vendas_06) +
                            floatval($sumvalor_vendas_07) + floatval($sumvalor_vendas_08) + floatval($sumvalor_vendas_09) + floatval($sumvalor_vendas_10) + floatval($sumvalor_vendas_11) + floatval($sumvalor_vendas_12);

        
        $sumvalor_estornoreemb_01 = select_subtipolanc_mensal($ano,'01','Estorno ou Reembolso',$connect);
        $sumvalor_estornoreemb_02 = select_subtipolanc_mensal($ano,'02','Estorno ou Reembolso',$connect);
        $sumvalor_estornoreemb_03 = select_subtipolanc_mensal($ano,'03','Estorno ou Reembolso',$connect);
        $sumvalor_estornoreemb_04 = select_subtipolanc_mensal($ano,'04','Estorno ou Reembolso',$connect);
        $sumvalor_estornoreemb_05 = select_subtipolanc_mensal($ano,'05','Estorno ou Reembolso',$connect);
        $sumvalor_estornoreemb_06 = select_subtipolanc_mensal($ano,'06','Estorno ou Reembolso',$connect);
        $sumvalor_estornoreemb_07 = select_subtipolanc_mensal($ano,'07','Estorno ou Reembolso',$connect);
        $sumvalor_estornoreemb_08 = select_subtipolanc_mensal($ano,'08','Estorno ou Reembolso',$connect);
        $sumvalor_estornoreemb_09 = select_subtipolanc_mensal($ano,'09','Estorno ou Reembolso',$connect);
        $sumvalor_estornoreemb_10 = select_subtipolanc_mensal($ano,'10','Estorno ou Reembolso',$connect);
        $sumvalor_estornoreemb_11 = select_subtipolanc_mensal($ano,'11','Estorno ou Reembolso',$connect);
        $sumvalor_estornoreemb_12 = select_subtipolanc_mensal($ano,'12','Estorno ou Reembolso',$connect);
        
        $sumvalor_estornoreemb = floatval($sumvalor_estornoreemb_01) + floatval($sumvalor_estornoreemb_02) + floatval($sumvalor_estornoreemb_03) + floatval($sumvalor_estornoreemb_04) + floatval($sumvalor_estornoreemb_05) + floatval($sumvalor_estornoreemb_06) +
                            floatval($sumvalor_estornoreemb_07) + floatval($sumvalor_estornoreemb_08) + floatval($sumvalor_estornoreemb_09) + floatval($sumvalor_estornoreemb_10) + floatval($sumvalor_estornoreemb_11) + floatval($sumvalor_estornoreemb_12);

        $sumvalor_transfgaar_01 = select_subtipolanc_mensal($ano,'01','Transferência entre contas GAAR',$connect);
        $sumvalor_transfgaar_02 = select_subtipolanc_mensal($ano,'02','Transferência entre contas GAAR',$connect);
        $sumvalor_transfgaar_03 = select_subtipolanc_mensal($ano,'03','Transferência entre contas GAAR',$connect);
        $sumvalor_transfgaar_04 = select_subtipolanc_mensal($ano,'04','Transferência entre contas GAAR',$connect);
        $sumvalor_transfgaar_05 = select_subtipolanc_mensal($ano,'05','Transferência entre contas GAAR',$connect);
        $sumvalor_transfgaar_06 = select_subtipolanc_mensal($ano,'06','Transferência entre contas GAAR',$connect);
        $sumvalor_transfgaar_07 = select_subtipolanc_mensal($ano,'07','Transferência entre contas GAAR',$connect);
        $sumvalor_transfgaar_08 = select_subtipolanc_mensal($ano,'08','Transferência entre contas GAAR',$connect);
        $sumvalor_transfgaar_09 = select_subtipolanc_mensal($ano,'09','Transferência entre contas GAAR',$connect);
        $sumvalor_transfgaar_10 = select_subtipolanc_mensal($ano,'10','Transferência entre contas GAAR',$connect);
        $sumvalor_transfgaar_11 = select_subtipolanc_mensal($ano,'11','Transferência entre contas GAAR',$connect);
        $sumvalor_transfgaar_12 = select_subtipolanc_mensal($ano,'12','Transferência entre contas GAAR',$connect);
        
        $sumvalor_transfgaar = floatval($sumvalor_transfgaar_01) + floatval($sumvalor_transfgaar_02) + floatval($sumvalor_transfgaar_03) + floatval($sumvalor_transfgaar_04) + floatval($sumvalor_transfgaar_05) + floatval($sumvalor_transfgaar_06) +
                            floatval($sumvalor_transfgaar_07) + floatval($sumvalor_transfgaar_08) + floatval($sumvalor_transfgaar_09) + floatval($sumvalor_transfgaar_10) + floatval($sumvalor_transfgaar_11) + floatval($sumvalor_transfgaar_12);
                            
        /* SOMATORIO RECEITAS MENSAIS */
        $sumreceitas_jan = floatval($sumvalor_bazares_01) + floatval($sumvalor_doacoes_01) +  floatval($sumvalor_rendimentos_01) + floatval($sumvalor_nfp_01) + floatval($sumvalor_socios_01) + floatval($sumvalor_rifas_01) +  floatval($sumvalor_taxaadocao_01) + floatval($sumvalor_vendas_01) ;
        $sumreceitas_fev = floatval($sumvalor_bazares_02) + floatval($sumvalor_doacoes_02) +  floatval($sumvalor_rendimentos_02) + floatval($sumvalor_nfp_02) + floatval($sumvalor_socios_02) + floatval($sumvalor_rifas_02) +  floatval($sumvalor_taxaadocao_02) + floatval($sumvalor_vendas_02) ;
        $sumreceitas_mar = floatval($sumvalor_bazares_03) + floatval($sumvalor_doacoes_03) +  floatval($sumvalor_rendimentos_03) + floatval($sumvalor_nfp_03) + floatval($sumvalor_socios_03) + floatval($sumvalor_rifas_03) +  floatval($sumvalor_taxaadocao_03) + floatval($sumvalor_vendas_03) ;
        $sumreceitas_abr = floatval($sumvalor_bazares_04) + floatval($sumvalor_doacoes_04) +  floatval($sumvalor_rendimentos_04) + floatval($sumvalor_nfp_04) + floatval($sumvalor_socios_04) + floatval($sumvalor_rifas_04) +  floatval($sumvalor_taxaadocao_04) + floatval($sumvalor_vendas_04) ;
        $sumreceitas_mai = floatval($sumvalor_bazares_05) + floatval($sumvalor_doacoes_05) +  floatval($sumvalor_rendimentos_05) + floatval($sumvalor_nfp_05) + floatval($sumvalor_socios_05) + floatval($sumvalor_rifas_05) +  floatval($sumvalor_taxaadocao_05) + floatval($sumvalor_vendas_05) ;
        $sumreceitas_jun = floatval($sumvalor_bazares_06) + floatval($sumvalor_doacoes_06) +  floatval($sumvalor_rendimentos_06) + floatval($sumvalor_nfp_06) + floatval($sumvalor_socios_06) + floatval($sumvalor_rifas_06) +  floatval($sumvalor_taxaadocao_06) + floatval($sumvalor_vendas_06) ;
        $sumreceitas_jul = floatval($sumvalor_bazares_07) + floatval($sumvalor_doacoes_07) +  floatval($sumvalor_rendimentos_07) + floatval($sumvalor_nfp_07) + floatval($sumvalor_socios_07) + floatval($sumvalor_rifas_07) +  floatval($sumvalor_taxaadocao_07) + floatval($sumvalor_vendas_07) ;
        $sumreceitas_ago = floatval($sumvalor_bazares_08) + floatval($sumvalor_doacoes_08) +  floatval($sumvalor_rendimentos_08) + floatval($sumvalor_nfp_08) + floatval($sumvalor_socios_08) + floatval($sumvalor_rifas_08) +  floatval($sumvalor_taxaadocao_08) + floatval($sumvalor_vendas_08) ;
        $sumreceitas_set = floatval($sumvalor_bazares_09) + floatval($sumvalor_doacoes_09) +  floatval($sumvalor_rendimentos_09) + floatval($sumvalor_nfp_09) + floatval($sumvalor_socios_09) + floatval($sumvalor_rifas_09) +  floatval($sumvalor_taxaadocao_09) + floatval($sumvalor_vendas_09) ;
        $sumreceitas_out = floatval($sumvalor_bazares_10) + floatval($sumvalor_doacoes_10) +  floatval($sumvalor_rendimentos_10) + floatval($sumvalor_nfp_10) + floatval($sumvalor_socios_10) + floatval($sumvalor_rifas_10) +  floatval($sumvalor_taxaadocao_10) + floatval($sumvalor_vendas_10) ;
        $sumreceitas_nov = floatval($sumvalor_bazares_11) + floatval($sumvalor_doacoes_11) +  floatval($sumvalor_rendimentos_11) + floatval($sumvalor_nfp_11) + floatval($sumvalor_socios_11) + floatval($sumvalor_rifas_11) +  floatval($sumvalor_taxaadocao_11) + floatval($sumvalor_vendas_11) ;
        $sumreceitas_dez = floatval($sumvalor_bazares_12) + floatval($sumvalor_doacoes_12) +  floatval($sumvalor_rendimentos_12) + floatval($sumvalor_nfp_12) + floatval($sumvalor_socios_12) + floatval($sumvalor_rifas_12) +  floatval($sumvalor_taxaadocao_12) + floatval($sumvalor_vendas_12) ;

        $sumtotal_receitas = floatval($sumreceitas_jan) + floatval($sumreceitas_fev) + floatval($sumreceitas_mar) + floatval($sumreceitas_abr) + floatval($sumreceitas_mai) + floatval($sumreceitas_jun) + floatval($sumreceitas_jul) + floatval($sumreceitas_ago) + floatval($sumreceitas_set) + floatval($sumreceitas_out) + floatval($sumreceitas_nov) + floatval($sumreceitas_dez);
        
        $sumtotal_despesas = floatval($sumdespesas_jan) + floatval($sumdespesas_fev) + floatval($sumdespesas_mar) + floatval($sumdespesas_abr) + floatval($sumdespesas_mai) + floatval($sumdespesas_jun) + floatval($sumdespesas_jul) + floatval($sumdespesas_ago) + floatval($sumdespesas_set) + floatval($sumdespesas_out) + floatval($sumdespesas_nov) + floatval($sumdespesas_dez);
        
        $perc_desp_adestrador = $sumtotal_despesas - ($sumtotal_despesas / 100 * $sumvalor_adestrador);
        
        /*echo "percentual adestrador: ".$perc_desp_adestrador;*/

        echo "<H3>DESPESAS E RECEITAS - ANO ".$ano." </H3><br>";
        
        /*DESPESAS*/
        echo "<table class='table' border='0'>
                            <thead class='thead-light'>
            						  <tr>
            							<th scope='col' colspan='1'>DESPESA</th>
            							<th scope='col' colspan='1'>JAN (R$)</th>
            							<th scope='col' colspan='1'>FEV (R$)</th>
            							<th scope='col' colspan='1'>MAR (R$)</th>
            							<th scope='col' colspan='1'>ABR (R$)</th>
            							<th scope='col' colspan='1'>MAI (R$)</th>
            							<th scope='col' colspan='1'>JUN (R$)</th>
            							<th scope='col' colspan='1'>JUL (R$)</th>
            							<th scope='col' colspan='1'>AGO (R$)</th>
            							<th scope='col' colspan='1'>SET (R$)</th>
            							<th scope='col' colspan='1'>OUT (R$)</th>
            							<th scope='col' colspan='1'>NOV (R$)</th>
            							<th scope='col' colspan='1'>DEZ (R$)</th>
            						    <th scope='col' colspan='1'>TOTAL</th>
            						   </tr>
            				</thead>
            				<tbody>
            				<tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Adestrador</td>
                                <td align='left'>".number_format($sumvalor_adestrador_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_adestrador_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_adestrador_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_adestrador_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_adestrador_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_adestrador_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_adestrador_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_adestrador_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_adestrador_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_adestrador_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_adestrador_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_adestrador_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_adestrador, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Anúncios redes sociais</td>
                                <td align='left'>".number_format($sumvalor_redes_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_redes_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_redes_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_redes_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_redes_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_redes_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_redes_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_redes_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_redes_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_redes_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_redes_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_redes_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_redes, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Bricolagem</td>
                                <td align='left'>".number_format($sumvalor_bricolagem_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bricolagem_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bricolagem_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bricolagem_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bricolagem_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bricolagem_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bricolagem_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bricolagem_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bricolagem_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bricolagem_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bricolagem_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bricolagem_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_bricolagem, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Cartório</td>
                                <td align='left'>".number_format($sumvalor_cartorio_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cartorio_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cartorio_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cartorio_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cartorio_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cartorio_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cartorio_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cartorio_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cartorio_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cartorio_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cartorio_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cartorio_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_cartorio, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Cemitério</td>
                                <td align='left'>".number_format($sumvalor_cemiterio_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cemiterio_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cemiterio_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cemiterio_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cemiterio_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cemiterio_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cemiterio_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cemiterio_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cemiterio_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cemiterio_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cemiterio_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_cemiterio_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_cemiterio, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Compras</td>
                                <td align='left'>".number_format($sumvalor_compras_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_compras_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_compras_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_compras_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_compras_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_compras_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_compras_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_compras_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_compras_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_compras_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_compras_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_compras_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_compras, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Gráfica</td>
                                <td align='left'>".number_format($sumvalor_grafica_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_grafica_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_grafica_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_grafica_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_grafica_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_grafica_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_grafica_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_grafica_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_grafica_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_grafica_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_grafica_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_grafica_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_grafica, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Impostos e tarifas</td>
                                <td align='left'>".number_format($sumvalor_imposto_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_imposto_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_imposto_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_imposto_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_imposto_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_imposto_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_imposto_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_imposto_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_imposto_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_imposto_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_imposto_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_imposto_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_imposto, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Loja Integrada</td>
                                <td align='left'>".number_format($sumvalor_lojavirtual_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lojavirtual_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lojavirtual_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lojavirtual_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lojavirtual_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lojavirtual_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lojavirtual_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lojavirtual_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lojavirtual_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lojavirtual_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lojavirtual_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lojavirtual_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_lojavirtual, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Lar temporário</td>
                                <td align='left'>".number_format($sumvalor_lt_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lt_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lt_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lt_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lt_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lt_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lt_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lt_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lt_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lt_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lt_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_lt_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_lt, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Ração</td>
                                <td align='left'>".number_format($sumvalor_racao_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_racao_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_racao_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_racao_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_racao_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_racao_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_racao_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_racao_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_racao_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_racao_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_racao_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_racao_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_racao, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Renovação de domínio</td>
                                <td align='left'>".number_format($sumvalor_renovacao_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_renovacao_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_renovacao_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_renovacao_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_renovacao_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_renovacao_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_renovacao_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_renovacao_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_renovacao_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_renovacao_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_renovacao_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_renovacao_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_renovacao, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Taxi Dog</td>
                                <td align='left'>".number_format($sumvalor_taxidog_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxidog_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxidog_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxidog_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxidog_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxidog_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxidog_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxidog_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxidog_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxidog_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxidog_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxidog_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_taxidog, 2, ',', '.')."
                            </tr>
                            <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>Veterinários</td>
                                <td align='left'>".number_format($sumvalor_vet_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vet_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vet_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vet_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vet_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vet_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vet_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vet_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vet_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vet_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vet_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vet_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumvalor_vet, 2, ',', '.')."
                            </tr>
                             <tr style='color: #ff0000; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: red;'>TOTAL</td>
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumdespesas_jan,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumdespesas_fev,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumdespesas_mar,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumdespesas_abr,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumdespesas_mai,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumdespesas_jun,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumdespesas_jul,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumdespesas_ago,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumdespesas_set,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumdespesas_out,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumdespesas_nov,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>".number_format($sumdespesas_dez,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: red;'>&nbsp;
                            </tr>
                            </tbody>
             </table>";
            
            /* RECEITAS */
            echo "<table class='table' border='0'>
                            <thead class='thead-light'>
            						  <tr>
            							<th scope='col' colspan='1'>RECEITA</th>
            							<th scope='col' colspan='1'>JAN (R$)</th>
            							<th scope='col' colspan='1'>FEV (R$)</th>
            							<th scope='col' colspan='1'>MAR (R$)</th>
            							<th scope='col' colspan='1'>ABR (R$)</th>
            							<th scope='col' colspan='1'>MAI (R$)</th>
            							<th scope='col' colspan='1'>JUN (R$)</th>
            							<th scope='col' colspan='1'>JUL (R$)</th>
            							<th scope='col' colspan='1'>AGO (R$)</th>
            							<th scope='col' colspan='1'>SET (R$)</th>
            							<th scope='col' colspan='1'>OUT (R$)</th>
            							<th scope='col' colspan='1'>NOV (R$)</th>
            							<th scope='col' colspan='1'>DEZ (R$)</th>
            						    <th scope='col' colspan='1'>TOTAL</th>
            						   </tr>
            				</thead>
            				<tbody>
            				<tr style='color: #0000ff; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: blue;'>Bazares</td>
                                <td align='left'>".number_format($sumvalor_bazares_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bazares_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bazares_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bazares_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bazares_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bazares_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bazares_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bazares_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bazares_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bazares_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bazares_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_bazares_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumvalor_bazar, 2, ',', '.')."
                            </tr>
                            <tr style='color: #0000ff; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: blue;'>Doações</td>
                                <td align='left'>".number_format($sumvalor_doacoes_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_doacoes_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_doacoes_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_doacoes_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_doacoes_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_doacoes_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_doacoes_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_doacoes_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_doacoes_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_doacoes_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_doacoes_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_doacoes_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumvalor_doacoes, 2, ',', '.')."
                            </tr>
                            <tr style='color: #0000ff; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: blue;'>Rendimentos</td>
                                <td align='left'>".number_format($sumvalor_rendimentos_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rendimentos_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rendimentos_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rendimentos_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rendimentos_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rendimentos_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rendimentos_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rendimentos_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rendimentos_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rendimentos_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rendimentos_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rendimentos_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumvalor_rendimentos, 2, ',', '.')."
                            </tr>
                            <tr style='color: #0000ff; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: blue;'>NFP</td>
                                <td align='left'>".number_format($sumvalor_nfp_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_nfp_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_nfp_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_nfp_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_nfp_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_nfp_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_nfp_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_nfp_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_nfp_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_nfp_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_nfp_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_nfp_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumvalor_nfp, 2, ',', '.')."
                            </tr>
                            <tr style='color: #0000ff; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: blue;'>Sócios</td>
                                <td align='left'>".number_format($sumvalor_socios_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_socios_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_socios_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_socios_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_socios_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_socios_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_socios_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_socios_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_socios_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_socios_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_socios_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_socios_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumvalor_socios, 2, ',', '.')."
                            </tr>
                            <tr style='color: #0000ff; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: blue;'>Rifas</td>
                                <td align='left'>".number_format($sumvalor_rifas_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rifas_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rifas_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rifas_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rifas_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rifas_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rifas_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rifas_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rifas_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rifas_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rifas_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_rifas_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumvalor_rifas, 2, ',', '.')."
                            </tr>
                            <tr style='color: #0000ff; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: blue;'>Taxas de adoção</td>
                                <td align='left'>".number_format($sumvalor_taxaadocao_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxaadocao_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxaadocao_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxaadocao_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxaadocao_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxaadocao_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxaadocao_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxaadocao_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxaadocao_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxaadocao_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxaadocao_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_taxaadocao_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumvalor_taxaadocao, 2, ',', '.')."
                            </tr>
                            <tr style='color: #0000ff; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: blue;'>Vendas</td>
                                <td align='left'>".number_format($sumvalor_vendas_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vendas_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vendas_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vendas_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vendas_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vendas_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vendas_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vendas_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vendas_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vendas_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vendas_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_vendas_12,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumvalor_vendas, 2, ',', '.')."
                            </tr>
                             <tr style='color: #0000ff; font-weight:bold;'>
                                <td align='left' style='color: #ffffff; background: blue;'>TOTAL</td>
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumreceitas_jan,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumreceitas_fev,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumreceitas_mar,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumreceitas_abr,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumreceitas_mai,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumreceitas_jun,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumreceitas_jul,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumreceitas_ago,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumreceitas_set,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumreceitas_out,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumreceitas_nov,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>".number_format($sumreceitas_dez,2, ',', '.')."
                                <td align='left' style='color: #ffffff; background: blue;'>&nbsp
                            </tr>
                            </tbody>
             </table>";
    		
    		/*NÃO CONTABEIS*/
    		echo "<table class='table' border='0'>
                            <thead class='thead-light'>
            						  <tr>
            							<th scope='col' colspan='1'>NÃO CONTÁBEIS</th>
            							<th scope='col' colspan='1'>JAN (R$)</th>
            							<th scope='col' colspan='1'>FEV (R$)</th>
            							<th scope='col' colspan='1'>MAR (R$)</th>
            							<th scope='col' colspan='1'>ABR (R$)</th>
            							<th scope='col' colspan='1'>MAI (R$)</th>
            							<th scope='col' colspan='1'>JUN (R$)</th>
            							<th scope='col' colspan='1'>JUL (R$)</th>
            							<th scope='col' colspan='1'>AGO (R$)</th>
            							<th scope='col' colspan='1'>SET (R$)</th>
            							<th scope='col' colspan='1'>OUT (R$)</th>
            							<th scope='col' colspan='1'>NOV (R$)</th>
            							<th scope='col' colspan='1'>DEZ (R$)</th>
            						    <th scope='col' colspan='1'>TOTAL</th>
            						   </tr>
            				</thead>
            				<tbody>
            				<tr>
                                <td align='left'>Estorno/Reembolso</td>
                                <td align='left'>".number_format($sumvalor_estornoreemb_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_estornoreemb_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_estornoreemb_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_estornoreemb_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_estornoreemb_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_estornoreemb_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_estornoreemb_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_estornoreemb_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_estornoreemb_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_estornoreemb_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_estornoreemb_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_estornoreemb_12,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_estornoreemb, 2, ',', '.')."
                            </tr>
                            <tr>
                                <td align='left'>Transferência entre contas GAAR</td>
                                <td align='left'>".number_format($sumvalor_transfgaar_01,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_transfgaar_02,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_transfgaar_03,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_transfgaar_04,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_transfgaar_05,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_transfgaar_06,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_transfgaar_07,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_transfgaar_08,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_transfgaar_09,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_transfgaar_10,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_transfgaar_11,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_transfgaar_12,2, ',', '.')."
                                <td align='left'>".number_format($sumvalor_transfgaar, 2, ',', '.')."
                            </tr>
                            </tbody>
             </table>";
             
            /*DESPESAS E RECEITAS*/
    		echo "<table class='table' border='0'>
                            <thead class='thead-light'>
            						  <tr>
            							<th scope='col' colspan='1'>&nbsp</th>
            							<th scope='col' colspan='1'>JAN (R$)</th>
            							<th scope='col' colspan='1'>FEV (R$)</th>
            							<th scope='col' colspan='1'>MAR (R$)</th>
            							<th scope='col' colspan='1'>ABR (R$)</th>
            							<th scope='col' colspan='1'>MAI (R$)</th>
            							<th scope='col' colspan='1'>JUN (R$)</th>
            							<th scope='col' colspan='1'>JUL (R$)</th>
            							<th scope='col' colspan='1'>AGO (R$)</th>
            							<th scope='col' colspan='1'>SET (R$)</th>
            							<th scope='col' colspan='1'>OUT (R$)</th>
            							<th scope='col' colspan='1'>NOV (R$)</th>
            							<th scope='col' colspan='1'>DEZ (R$)</th>
            						    <th scope='col' colspan='1'>TOTAL</th>
            						   </tr>
            				</thead>
            				<tbody>
            				<tr>
                                <td align='left'>Despesas</td>
                                <td align='left'>".number_format($sumdespesas_jan,2, ',', '.')."
                                <td align='left'>".number_format($sumdespesas_fev,2, ',', '.')."
                                <td align='left'>".number_format($sumdespesas_mar,2, ',', '.')."
                                <td align='left'>".number_format($sumdespesas_abr,2, ',', '.')."
                                <td align='left'>".number_format($sumdespesas_mai,2, ',', '.')."
                                <td align='left'>".number_format($sumdespesas_jun,2, ',', '.')."
                                <td align='left'>".number_format($sumdespesas_jul,2, ',', '.')."
                                <td align='left'>".number_format($sumdespesas_ago,2, ',', '.')."
                                <td align='left'>".number_format($sumdespesas_set,2, ',', '.')."
                                <td align='left'>".number_format($sumdespesas_out,2, ',', '.')."
                                <td align='left'>".number_format($sumdespesas_nov,2, ',', '.')."
                                <td align='left'>".number_format($sumdespesas_dez,2, ',', '.')."
                                <td align='left'>".number_format($sumtotal_despesas,2, ',', '.')."
                            </tr>
                            <tr>
                                <td align='left'>Receitas</td>
                                <td align='left'>".number_format($sumreceitas_jan,2, ',', '.')."
                                <td align='left'>".number_format($sumreceitas_fev,2, ',', '.')."
                                <td align='left'>".number_format($sumreceitas_mar,2, ',', '.')."
                                <td align='left'>".number_format($sumreceitas_abr,2, ',', '.')."
                                <td align='left'>".number_format($sumreceitas_mai,2, ',', '.')."
                                <td align='left'>".number_format($sumreceitas_jun,2, ',', '.')."
                                <td align='left'>".number_format($sumreceitas_jul,2, ',', '.')."
                                <td align='left'>".number_format($sumreceitas_ago,2, ',', '.')."
                                <td align='left'>".number_format($sumreceitas_set,2, ',', '.')."
                                <td align='left'>".number_format($sumreceitas_out,2, ',', '.')."
                                <td align='left'>".number_format($sumreceitas_nov,2, ',', '.')."
                                <td align='left'>".number_format($sumreceitas_dez,2, ',', '.')."
                                <td align='left'>".number_format($sumtotal_receitas,2, ',', '.')."
                            </tr>
                            </tbody>
             </table>";
			 
			$assunto = "Relatório - Lançamentos mensais no ano de ".$ano."";
			
			$mensagem ="<center>
                   <br>
                    <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS</h3><br>
                    <h5>ANO ".$ano." - RECEITAS</h5>
               </center>
                <table class='table'>
                <thead class='thead-light'>
            	<th scope='col'>Mês</th>
            	<th scope='col'>Sócio</th>
            	<th scope='col'>Bazar</th>
            	<th scope='col'>NFP</th>
            	<th scope='col'>Rifas</th>
            	<th scope='col'>Vendas</th>
            	<th scope='col'>Taxas de adoção</th>
            	<th scope='col'>Juros</th>
            	<th scope='col'>Outros</th>
            	</thead>
            	<tbody>
            	<tr>
				<th scope='row'>Janeiro</th>
				<td>R$ ".$somasocio_jan."</td>
						<td>R$ ".$somabazar_jan."</td>
						<td>R$ ".$somanfp_jan."</td>
						<td>R$ ".$somarifas_jan."</td>
						<td>R$ ".$somavendas_jan."</td>
						<td>R$ ".$somataxasadocao_jan."</td>
						<td>R$ ".$somajuros_jan."</td>
						<td>R$ ".$somaoutrosrec_jan."</td>
					  </tr>
					  <tr>
					  <th scope='row'>Fevereiro</th>
						<td>R$ ".$somasocio_fev."</td>
						<td>R$ ".$somabazar_fev."</td>
						<td>R$ ".$somanfp_fev."</td>
						<td>R$ ".$somarifas_fev."</td>
						<td>R$ ".$somavendas_fev."</td>
						<td>R$ ".$somataxasadocao_fev."</td>
						<td>R$ ".$somajuros_fev."</td>
						<td>R$ ".$somaoutrosrec_fev."</td>
					  </tr>
					  <tr>
					  <th scope='row'>Março</th>
						<td>R$ ".$somasocio_mar."</td>
						<td>R$ ".$somabazar_mar."</td>
						<td>R$ ".$somanfp_mar."</td>
						<td>R$ ".$somarifas_mar."</td>
						<td>R$ ".$somavendas_mar."</td>
						<td>R$ ".$somataxasadocao_mar."</td>
						<td>R$ ".$somajuros_mar."</td>
						<td>R$ ".$somaoutrosrec_mar."</td>
					  </tr>
					  <tr>
					  <th scope='row'>Abril</th>
						<td>R$ ".$somasocio_abr."</td>
						<td>R$ ".$somabazar_abr."</td>
						<td>R$ ".$somanfp_abr."</td>
						<td>R$ ".$somarifas_abr."</td>
						<td>R$ ".$somavendas_abr."</td>
						<td>R$ ".$somataxasadocao_abr."</td>
						<td>R$ ".$somajuros_abr."</td>
						<td>R$ ".$somaoutrosrec_abr."</td>
					  </tr>
					  <tr>
					  <th scope='row'>Maio</th>
						<td>R$ ".$somasocio_mai."</td>
						<td>R$ ".$somabazar_mai."</td>
						<td>R$ ".$somanfp_mai."</td>
						<td>R$ ".$somarifas_mai."</td>
						<td>R$ ".$somavendas_mai."</td>
						<td>R$ ".$somataxasadocao_mai."</td>
						<td>R$ ".$somajuros_mai."</td>
						<td>R$ ".$somaoutrosrec_mai."</td>
					  </tr>
					  <tr>
					  <th scope='row'>Junho</th>
						<td>R$ ".$somasocio_jun."</td>
						<td>R$ ".$somabazar_jun."</td>
						<td>R$ ".$somanfp_jun."</td>
						<td>R$ ".$somarifas_jun."</td>
						<td>R$ ".$somavendas_jun."</td>
						<td>R$ ".$somataxasadocao_jun."</td>
						<td>R$ ".$somajuros_jun."</td>
						<td>R$ ".$somaoutrosrec_jun."</td>
					  </tr>
					  <tr>
					 <th scope='row'>Julho</th>
						<td>R$ ".$somasocio_jul."</td>
						<td>R$ ".$somabazar_jul."</td>
						<td>R$ ".$somanfp_jul."</td>
						<td>R$ ".$somarifas_jul."</td>
						<td>R$ ".$somavendas_jul."</td>
						<td>R$ ".$somataxasadocao_jul."</td>
						<td>R$ ".$somajuros_jul."</td>
						<td>R$ ".$somaoutrosrec_jul."</td>
					  </tr>
					  <tr>
					  <th scope='row'>Agosto</th>
						<td>R$ ".$somasocio_ago."</td>
						<td>R$ ".$somabazar_ago."</td>
						<td>R$ ".$somanfp_ago."</td>
						<td>R$ ".$somarifas_ago."</td>
						<td>R$ ".$somavendas_ago."</td>
						<td>R$ ".$somataxasadocao_ago."</td>
						<td>R$ ".$somajuros_ago."</td>
						<td>R$ ".$somaoutrosrec_ago."</td>
					  </tr>
					  <tr>
					  <th scope='row'>Setembro</th>
						<td>R$ ".$somasocio_set."</td>
						<td>R$ ".$somabazar_set."</td>
						<td>R$ ".$somanfp_set."</td>
						<td>R$ ".$somarifas_set."</td>
						<td>R$ ".$somavendas_set."</td>
						<td>R$ ".$somataxasadocao_set."</td>
						<td>R$ ".$somajuros_set."</td>
						<td>R$ ".$somaoutrosrec_set."</td>
					  </tr>
					  <tr>
					  <th scope='row'>Outubro</th>
						<td>R$ ".$somasocio_out."</td>
						<td>R$ ".$somabazar_out."</td>
						<td>R$ ".$somanfp_out."</td>
						<td>R$ ".$somarifas_out."</td>
						<td>R$ ".$somavendas_out."</td>
						<td>R$ ".$somataxasadocao_out."</td>
						<td>R$ ".$somajuros_out."</td>
						<td>R$ ".$somaoutrosrec_out."</td>
					  </tr>
					  <tr>
					  <th scope='row'>Novembro</th>
						<td>R$ ".$somasocio_nov."</td>
						<td>R$ ".$somabazar_nov."</td>
						<td>R$ ".$somanfp_nov."</td>
						<td>R$ ".$somarifas_nov."</td>
						<td>R$ ".$somavendas_nov."</td>
						<td>R$ ".$somataxasadocao_nov."</td>
						<td>R$ ".$somajuros_nov."</td>
						<td>R$ ".$somaoutrosrec_nov."</td>
					  </tr>
					  <tr>
					  <th scope='row'>Dezembro</th>
						<td>R$ ".$somasocio_dez."</td>
						<td>R$ ".$somabazar_dez."</td>
						<td>R$ ".$somanfp_dez."</td>
						<td>R$ ".$somarifas_dez."</td>
						<td>R$ ".$somavendas_dez."</td>
						<td>R$ ".$somataxasadocao_dez."</td>
						<td>R$ ".$somajuros_dez."</td>
						<td>R$ ".$somaoutrosrec_dez."</td>
					  </tr>
					  <tr>
					  <th scope='row'>TOTAL</th>
						<td scope='row'>R$ ".$totalsocio."</td>
						<td scope='row'>R$ ".$totaldoacoes."</td>
						<td scope='row'>R$ ".$totalbazar."</td>
						<td scope='row'>R$ ".$totalnfp."</td>
						<td scope='row'>R$ ".$totalrifas."</td>
						<td scope='row'>R$ ".$totalvendas."</td>
						<td scope='row'>R$ ".$totaltaxasadocao."</td>
						<td scope='row'>R$ ".$totaljuros."</td>
						<td scope='row'>R$ ".$totaloutrosrec."</td>
					  </tr>
					  </tbody>
					  </table>
					  <br>
					  <center>
                            <h3>RELATÓRIO CONTÁBIL DE LANÇAMENTOS MENSAIS</h3>
                            <br>
                            <h5>ANO ".$ano." - DESPESAS</h5>
                       </center>
            	        <table class='table'>
                        <thead class='thead-light'>
                    	<th scope='col'>Mês</th>
                    	<th scope='col'>LT + Ração</th>
                    	<th scope='col'>Veterinário</th>
                    	<th scope='col'>Táxi Dog</th>
                    	<th scope='col'>Medicamentos</th>
                    	<th scope='col'>Compras</th>
                    	<th scope='col'>Impostos</th>
                    	<th scope='col'>Outros</th>
                    	</thead>
                    	<tbody>
                    	<tr>
    					<th scope='row'>Janeiro</th>
    							<td>R$ ".$somalt_jan."</td>
    							<td>R$ ".$somavet_jan."</td>
    							<td>R$ ".$somataxidog_jan."</td>
    							<td>R$ ".$somamedicam_jan."</td>
    							<td>R$ ".$somacompras_jan."</td>
    							<td>R$ ".$somaimposto_jan."</td>
    							<td>R$ ".$somaoutrosdes_jan."</td>
    						  </tr>
    						  <th scope='row'>Fevereiro</th>
    							<td>R$ ".$somalt_fev."</td>
    							<td>R$ ".$somavet_fev."</td>
    							<td>R$ ".$somataxidog_fev."</td>
    							<td>R$ ".$somamedicam_fev."</td>
    							<td>R$ ".$somacompras_fev."</td>
    							<td>R$ ".$somaimposto_fev."</td>
    							<td>R$ ".$somaoutrosdes_fev."</td>
    						  </tr>
    						  <th scope='row'>Fevereiro</th>
    							<td>R$ ".$somalt_mar."</td>
    							<td>R$ ".$somavet_mar."</td>
    							<td>R$ ".$somataxidog_mar."</td>
    							<td>R$ ".$somamedicam_mar."</td>
    							<td>R$ ".$somacompras_mar."</td>
    							<td>R$ ".$somaimposto_mar."</td>
    							<td>R$ ".$somaoutrosdes_mar."</td>
    						  </tr>
    						  <th scope='row'>Março</th>
    							<td>R$ ".$somalt_abr."</td>
    							<td>R$ ".$somavet_abr."</td>
    							<td>R$ ".$somataxidog_abr."</td>
    							<td>R$ ".$somamedicam_abr."</td>
    							<td>R$ ".$somacompras_abr."</td>
    							<td>R$ ".$somaimposto_abr."</td>
    							<td>R$ ".$somaoutrosdes_abr."</td>
    						  </tr>
    						  <th scope='row'>Abril</th>
    							<td>R$ ".$somalt_mai."</td>
    							<td>R$ ".$somavet_mai."</td>
    							<td>R$ ".$somataxidog_mai."</td>
    							<td>R$ ".$somamedicam_mai."</td>
    							<td>R$ ".$somacompras_mai."</td>
    							<td>R$ ".$somaimposto_mai."</td>
    							<td>R$ ".$somaoutrosdes_mai."</td>
    						  </tr>
    						  <th scope='row'>Maio</th>
    							<td>R$ ".$somalt_jun."</td>
    							<td>R$ ".$somavet_jun."</td>
    							<td>R$ ".$somataxidog_jun."</td>
    							<td>R$ ".$somamedicam_jun."</td>
    							<td>R$ ".$somacompras_jun."</td>
    							<td>R$ ".$somaimposto_jun."</td>
    							<td>R$ ".$somaoutrosdes_jun."</td>
    						  </tr>
    						  <th scope='row'>Junho</th>
    							<td>R$ ".$somalt_jul."</td>
    							<td>R$ ".$somavet_jul."</td>
    							<td>R$ ".$somataxidog_jul."</td>
    							<td>R$ ".$somamedicam_jul."</td>
    							<td>R$ ".$somacompras_jul."</td>
    							<td>R$ ".$somaimposto_jul."</td>
    							<td>R$ ".$somaoutrosdes_jul."</td>
    						  </tr>
    						  <th scope='row'>Agosto</th>
    							<td>R$ ".$somalt_ago."</td>
    							<td>R$ ".$somavet_ago."</td>
    							<td>R$ ".$somataxidog_ago."</td>
    							<td>R$ ".$somamedicam_ago."</td>
    							<td>R$ ".$somacompras_ago."</td>
    							<td>R$ ".$somaimposto_ago."</td>
    							<td>R$ ".$somaoutrosdes_ago."</td>
    						  </tr>
    						  <th scope='row'>Setembro</th>
    							<td>R$ ".$somalt_set."</td>
    							<td>R$ ".$somavet_set."</td>
    							<td>R$ ".$somataxidog_set."</td>
    							<td>R$ ".$somamedicam_set."</td>
    							<td>R$ ".$somacompras_set."</td>
    							<td>R$ ".$somaimposto_set."</td>
    							<td>R$ ".$somaoutrosdes_set."</td>
    						  </tr>
    						  <th scope='row'>Outubro</th>
    							<td>R$ ".$somalt_out."</td>
    							<td>R$ ".$somavet_out."</td>
    							<td>R$ ".$somataxidog_out."</td>
    							<td>R$ ".$somamedicam_out."</td>
    							<td>R$ ".$somacompras_out."</td>
    							<td>R$ ".$somaimposto_out."</td>
    							<td>R$ ".$somaoutrosdes_out."</td>
    						  </tr>
    						  <th scope='row'>Novembro</th>
    							<td>R$ ".$somalt_nov."</td>
    							<td>R$ ".$somavet_nov."</td>
    							<td>R$ ".$somataxidog_nov."</td>
    							<td>R$ ".$somamedicam_nov."</td>
    							<td>R$ ".$somacompras_nov."</td>
    							<td>R$ ".$somaimposto_nov."</td>
    							<td>R$ ".$somaoutrosdes_nov."</td>
    						  </tr>
    						  <th scope='row'>Dezembro</th>
    							<td scope='row'>R$ ".$somalt_dez."</td>
    							<td scope='row'>R$ ".$somavet_dez."</td>
    							<td scope='row'>R$ ".$somataxidog_dez."</td>
    							<td scope='row'>R$ ".$somamedicam_dez."</td>
    							<td scope='row'>R$ ".$somacompras_dez."</td>
    							<td scope='row'>R$ ".$somaimposto_dez."</td>
    							<td scope='row'>R$ ".$somaoutrosdes_dez."</td>
    						  </tr>
    						  </tbody>
    			</table>";
?>
            <p><center><strong>OBSERVAÇÕES</strong><br><i>O valor total é a somatória dos lançamentos de todas as fontes de receitas do dia 01 até o último dia do mês coletados pelo sistema diretamente do banco de dados do GAAR <br> Dúvidas ou esclarecimentos favor entrar em contato pelo e-mail financeiro@gaarcampinas.org</i></center></center><br><br>
          <br>
          <br>
          <footer class='footer fixed-bottom bg-light'>
              <div class='container'>
                <p class='text-center'>GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
              </div>
            </footer>

    <!--- BOOTSTRAP --->
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
<!--- BOOTSTRAP --->
</div>
</main>
</body>
</html>