<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$idprocedi = $_GET['id'];

$data_atu = date("Y-m-d");
$mes_atu = date("m");
$ano_atu = date("Y"); 
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";
$fp = fopen($log_file, 'a');//opens file in write mode  

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA,EMAIL,NOME,CELULAR FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
				$email = $fetcharea[2];
				$nome_vol= $fetcharea[3];
				$celular = $fetcharea[4];
		}
		
		$queryprocedi = "SELECT * FROM PEDIDO_CASTRACAO WHERE ID='$idprocedi'";
		$selectprocedi = mysqli_query($connect,$queryprocedi); 
        $rc = mysqli_fetch_row($selectprocedi);
        $countpedido = mysqli_num_rows($selectprocedi);
        
        $nomedoanimal = $rc[1];
        $especie = $rc[2];
		$sexo = $rc[3];
		$porte = $rc[4];
		$peso = $rc[18];
		$dtnasc = $rc[5];
		$idprotetor = $rc[19];
		$nomeresp = $rc[6];
		$telresp = $rc[7];
		$emailresp = $rc[8];
		$valorajuda = $rc[9];
		$obs = $rc[10];
		$volgaar = $rc[11];
		$bairro = $rc[13];
		$cidade = $rc[14];
		$status = $rc[15];
		$tmpmelhorvet = $rc[16];
		$melhordia= $rc[17];
		$quemleva = $rc[20];
		$obs = $rc[10];
	    $valorgaar_novo = 0;
	    $idanimaldogaar = $rc[22];
		
		$queryvet = "SELECT * FROM CLINICAS WHERE ID='$tmpmelhorvet'";
		$selectvet = mysqli_query($connect,$queryvet); 
        $rcvet = mysqli_fetch_row($selectvet);
        $idvet = $rcvet[0];
        $melhorvet = $rcvet[1];
        $valor_gato = $rcvet[10];
    	$valor_gata = $rcvet[11];
    	$valor_caop = $rcvet[12];
    	$valor_caom = $rcvet[13];
    	$valor_caog = $rcvet[14];
    	$valor_cadelap = $rcvet[15];
        $valor_cadelam = $rcvet[16];
        $valor_cadelag = $rcvet[17];
    	$valor_gatoinala = $rcvet[32];
    	$valor_gatainala = $rcvet[33];
    	$valor_caopinala = $rcvet[34];
        $valor_caominala = $rcvet[35];
        $valor_caoginala = $rcvet[36];
        $valor_cadelapinala = $rcvet[37];
        $valor_cadelaminala = $rcvet[38];
        $valor_cadelaginala = $rcvet[39];
        $valorgato_prot = $rcvet[42];
        $valorgata_prot = $rcvet[43];
        $valorcao_prot = $rcvet[44];
        $valorcadela_prot = $rcvet[45];
        
        switch ($especie){
            case 'Canina':
                if ($sexo =="Macho" && $porte =="Pequeno"){
                    $valorgaar = floatval($valor_caop) - floatval($valorajuda);   
                }
                if ($sexo =="Macho" && $porte =="Médio"){
                    $valorgaar = floatval($valor_caom) - floatval($valorajuda);   
                }
                if ($sexo =="Macho" && $porte =="Grande"){
                    $valorgaar = floatval($valor_caog) - floatval($valorajuda);   
                }
                if ($sexo =="Fêmea" && $porte =="Pequeno"){
                    $valorgaar = floatval($valor_cadelap) - floatval($valorajuda);   
                }
                if ($sexo =="Fêmea" && $porte =="Médio"){
                    $valorgaar = floatval($valor_cadelam) - floatval($valorajuda);   
                }
                if ($sexo =="Fêmea" && $porte =="Grande"){
                    $valorgaar = floatval($valor_cadelag) - floatval($valorajuda);   
                }
                break;
            case 'Felina':
                if ($sexo =='Macho'){
                    $valorgaar = floatval($valor_gato) - floatval($valorajuda);    
                } else {
                    $valorgaar = floatval($valor_gata) - floatval($valorajuda);    
                }
                break;
        }
        
        if ($valorgaar <"0"){
            $valorgaar= 0;
        }
		
		$ano_nascimento = substr($dtnasc,0,4);
	    $mes_nascimento = substr($dtnasc,5,2);
	    $dia_nascimento = substr($dtnasc,8,2);
	    
	    if ($volgaar =="Não" || $volgaar =="") {
	        $volgaar = $nome_vol;
	    }
	    
	    $queryprotetor = "SELECT NOME FROM PROTETORES WHERE ID='$idprotetor'";
		$selectprotetor = mysqli_query($connect,$queryprotetor); 
		$rcprot = mysqli_fetch_row($selectprotetor);
        $nomedoresp = $rcprot[0];
        
        $querycount = "SELECT * FROM AGENDAMENTO WHERE RESPONSAVEL='$nomedoresp' AND DATA_AG LIKE '".$ano_atu."-".$mes_atu."%' AND VALOR_AJUDA <>'0' AND ATIVO<>'CANCELADO'";
        $selectcount = mysqli_query($connect,$querycount); 
        $castracoes_protetor = mysqli_num_rows($selectcount);
        
		$querycountgratis = "SELECT * FROM AGENDAMENTO WHERE RESPONSAVEL='$nomedoresp' AND DATA_AG LIKE '".$ano_atu."-".$mes_atu."%' AND VALOR_AJUDA ='0' AND ATIVO<>'CANCELADO'";
        $selectcountgratis = mysqli_query($connect,$querycountgratis); 
        $castracoes_protetor_gratis = mysqli_num_rows($selectcountgratis);
        
        if ($castracoes_protetor_gratis < "3" && $valorajuda < "50"){ // E se ainda está dentro da cota grátis e não quer usar a cota grátis
                $valorajuda ="0";
        } elseif ($castracoes_protetor_gratis >= "3" && $castracoes_protetor <= "5"){ // E se não está dentro da cota grátis
            $txtvalorajuda = "(Valor alterado)";
            if ($especie =='Canina'){
                if ($sexo=='Fêmea'){
                    $valorajuda = $valorcadela_prot;   
                } else {
                    $valorajuda = $valorcao_prot;   
                }
            } 
            if ($especie =='Felina'){
               if ($sexo=='Fêmea'){
                    $valorajuda = $valorgata_prot;   
                } else {
                    $valorajuda = $valorgato_prot;   
                } 
            }
        }
        
        if ($idvet =="8") { //DRA THAIS BAROZI
            switch ($especie){
                case 'Canina':
                    $valorajuda ="100";
                    if ($sexo =="Macho" && $porte =="Pequeno"){
                        $valorgaar = floatval($valor_caopinala) - floatval($valorajuda);   
                    }
                    if ($sexo =="Macho" && $porte =="Médio"){
                        $valorgaar = floatval($valor_caominala) - floatval($valorajuda);   
                    }
                    if ($sexo =="Macho" && $porte =="Grande"){
                        $valorgaar = floatval($valor_caoginala) - floatval($valorajuda);   
                    }
                    if ($sexo =="Fêmea" && $porte =="Pequeno"){
                        $valorgaar = floatval($valor_cadelapinala) - floatval($valorajuda);   
                    }
                    if ($sexo =="Fêmea" && $porte =="Médio"){
                        $valorgaar = floatval($valor_cadelaminala) - floatval($valorajuda);   
                    }
                    if ($sexo =="Fêmea" && $porte =="Grande"){
                        $valorgaar = floatval($valor_cadelaginala) - floatval($valorajuda);   
                    }
                    break;
                case 'Felina':
                    if ($sexo =='Macho'){
                        $valorgaar = floatval($valor_gatoinala) - floatval($valorajuda);    
                    } else {
                        $valorgaar = floatval($valor_gatainala) - floatval($valorajuda);    
                    }
                    break;
            }
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
    
    <title>GAAR - Autorização de procedimentos</title>
    
    <script type="text/javascript">

        function abrir(URL) {

  var width = 150;
  var height = 250;

  var left = 99;
  var top = 99;

  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');

}
                        
        function OnChangeSelect () {
             
                    var select = document.getElementById('tipoproc');
                    var str = select.options[select.selectedIndex].value;
                    
                       switch (str){
                           case "Castração":
                           case "Eutanásia":
                           case "Consulta":       
                           case "Limpeza de tártaro":
                                    document.getElementById('dadosanimal').className  = "d-block";
                                    //document.getElementById('dadosanimalp2').className  = "d-block";
                                    document.getElementById('dadosresp').className  = "d-block";
                                    document.getElementById('dadosoutros').className  = "d-none";
                                    document.getElementById('dadosprocedi').className  = "d-block";
                                    document.getElementById('divvalordesconto').className  = "d-block";
                                    document.getElementById('divvalortutor').className  = "d-block";
                                    document.getElementById('respgaar').className  = "d-block";
                                    document.getElementById('divfooter').className  = "d-block";
                                    document.getElementById('dtnascanimal').className  = "d-block";
                                    break;
                                    
                           case "Outros":
                           case "Cirurgia":
                                    document.getElementById('dadosvacina').className  = "d-none";
                                    document.getElementById('dadosanimal').className  = "d-none";
                                    //document.getElementById('dadosanimalp2').className  = "d-none";
                                    document.getElementById('dadosresp').className  = "d-resp";
                                    document.getElementById('dadosoutros').className  = "d-block";
                                    document.getElementById('dadosprocedi').className  = "d-block";
                                    document.getElementById('divvaloroutros').className  = "d-block";
                                    document.getElementById('divvalordesconto').className  = "d-block";
                                    document.getElementById('respgaar').className  = "d-block"; 
                                    document.getElementById('divobs').className  = "d-block"; 
                                    document.getElementById('divfooter').className  = "d-block";
                           
                           case "Vacina":
                                    document.getElementById('dadosresp').className  = "d-none";
                                    document.getElementById('dadosanimal').className  = "d-block";
                                    //document.getElementById('dadosanimalp2').className  = "d-block";
                                    document.getElementById('dadosoutros').className  = "d-block";
                                    document.getElementById('dadosprocedi').className  = "d-block";
                                    document.getElementById('divvaloroutros').className  = "d-block";
                                    document.getElementById('divvalordesconto').className  = "d-block";
                                    document.getElementById('respgaar').className  = "d-block";
                                    document.getElementById('dadosvacina').className  = "d-block";
                                    document.getElementById('divfooter').className  = "d-block";
                                    break;
                                    
                            case "Exame":
                            case "Roupa cirúrgica":
                            case "Transporte":
                                    document.getElementById('dadosanimal').className  = "d-none";
                                    //document.getElementById('dadosanimalp2').className  = "d-none";
                                    document.getElementById('dadosresp').className  = "d-none";
                                    document.getElementById('dadosoutros').className  = "d-block";
                                    document.getElementById('dadosprocedi').className  = "d-block";
                                    document.getElementById('divvaloroutros').className  = "d-block";
                                    document.getElementById('divvalordesconto').className  = "d-block";
                                    document.getElementById('respgaar').className  = "d-block";
                                    document.getElementById('dadosvacina').className  = "d-block";
                                    document.getElementById('divfooter').className  = "d-block";
                                    break;

                            default:
                                   document.getElementById('dadosanimal').className  = "d-none";
                                   //document.getElementById('dadosanimalp2').className  = "d-none";
                                   document.getElementById('dadosresp').className  = "d-none";
                                   document.getElementById('dadosoutros').className  = "d-none";
                                   document.getElementById('dadosprocedi').className  = "d-none"; 
                                   document.getElementById('divfooter').className  = "d-block";
                       }
         }
         
        function OnChangeSelect2 () {
             
                    var select = document.getElementById('idanimalgaar');
                    var str = select.options[select.selectedIndex].value;
                    
                       if (!str){ // se o id estiver vazio
                          //document.getElementById('dadosanimalp2').className  = "d-block";
                          document.getElementById('respgaar').className  = "d-block";
                          document.getElementById('dadosresp').className  = "d-block";
                          document.getElementById('digitanome').className  = "d-block";
                          document.getElementById('textoanimalgaar').className  = "d-none";
                          document.getElementById('qtde').selectedIndex = "0"; 
                       } else {
                          document.getElementById('textoanimalgaar').className  = "d-block";
                          //document.getElementById('dadosanimalp2').className  = "d-none";
                          document.getElementById('respgaar').className  = "d-none";
                          document.getElementById('dadosresp').className  = "d-none";
                          document.getElementById('digitanome').className  = "d-none";
                          document.getElementById('qtde').selectedIndex = "1"; 
                          
                       }
                                
         }
         
        function OnChangeRadio (radio) {
                    document.getElementById('Gato').checked = true;
                    document.getElementById('Gato').disabled  = false;
            }
            
        function OnChangeRadio2 (radio) {
                    document.getElementById('Gato').disabled  = true;
                    document.getElementById('Gato').checked = false;
        }
        
        function OnChangeRadio3 (radio) {
                    
                    var canina =   document.getElementById('Canina').checked;
                    var felina =   document.getElementById('Felina').checked;
                    var femea =   document.getElementById('Fêmea').checked;
                    var macho =   document.getElementById('Macho').checked;
                    var gato =   document.getElementById('Gato').checked;
                    var portep =   document.getElementById('Pequeno').checked;
                    var portem =   document.getElementById('Médio').checked;
                    var porteg =   document.getElementById('Grande').checked;
                    
                    if (felina && macho) {
                        document.getElementById('valorunitgato').checked = true;
                    }
                    
                    if (felina && femea) {
                        document.getElementById('valorunitgata').checked = true;
                    }
                    
                    if (canina && macho && portep) {
                        document.getElementById('valorunitmachop').checked = true;
                    }
                    
                    if (canina && macho && portem) {
                        document.getElementById('valorunitmachom').checked = true;
                    }
                    
                    if (canina && macho && porteg) {
                        document.getElementById('valorunitmachog').checked = true;
                    }
                    
                    if (canina && femea && portep) {
                        document.getElementById('valorunitfemeap').checked = true;
                    }
                    
                    if (canina && femea && portem) {
                        document.getElementById('valorunitfemeam').checked = true;
                    }
                    
                    if (canina && femea && porteg) {
                        document.getElementById('valorunitfemeag').checked = true;
                    }
                    
                    
        }
        
        function OnChangeRadio4 (radio) {
            
                    var canina =   document.getElementById('Canina').checked;
                    var felina =   document.getElementById('Felina').checked;
                    var femea =   document.getElementById('Fêmea').checked;
                    var macho =   document.getElementById('Macho').checked;
                    var gato =   document.getElementById('Gato').checked;
                    var portep =   document.getElementById('Pequeno').checked;
                    var portem =   document.getElementById('Médio').checked;
                    var porteg =   document.getElementById('Grande').checked;
                    
                    var valorunitgato = document.getElementById("valorunitgato").value;
                    var valorunitgata = document.getElementById("valorunitgata").value;
                    var valorunitmachop = document.getElementById("valorunitmachop").value;
                    var valorunitmachom = document.getElementById("valorunitmachom").value;
                    var valorunitmachog = document.getElementById("valorunitmachog").value;
                    var valorunitfemeap = document.getElementById("valorunitfemeap").value;
                    var valorunitfemeam = document.getElementById("valorunitfemeam").value;
                    var valorunitfemeag = document.getElementById("valorunitfemeag").value;
                    
                    var qtd = parseInt(document.getElementById("qtde").value);

                    
                    if (felina && macho) {
                        var valorunit = parseFloat(valorunitgato);
                    }
                    
                    if (felina && femea) {
                        var valorunit = parseFloat(valorunitgata);
                    }
                    
                    if (canina && macho && portep) {
                        var valorunit = parseFloat(valorunitmachop);
                    }
                    
                    if (canina && macho && portem) {
                        var valorunit = parseFloat(valorunitmachom);
                    }
                    
                    if (canina && macho && porteg) {
                        var valorunit = parseFloat(valorunitmachog);
                    }
                    
                    if (canina && femea && portep) {
                        var valorunit = parseFloat(valorunitfemeap);
                    }
                    
                    if (canina && femea && portem) {
                        var valorunit = parseFloat(valorunitfemeam);
                    }
                    
                    if (canina && femea && porteg) {
                        var valorunit = parseFloat(valorunitfemeag);
                    }
                    
                    var valortot = qtd * valorunit;

                    if (Number.isNaN(valortot)) {
                            document.getElementById("valor").value = 0;
                    } else {
                        document.getElementById("valor").value = valortot;
                    }
                    
        }
        
        function OnClick1 () {
            
                    var checkbox = document.getElementById("responsavel");
                    
                    if (checkbox.checked == 1){
                        document.getElementById('dadosresp').className  = "d-none";
                    } else {
                        document.getElementById('dadosresp').className  = "d-block";
                    }
        
        }
        
        function checkDados () {
            
                    var select = document.getElementById('requigaar');
                    var requigaar = select.options[select.selectedIndex].value;
                    
                       if (!requigaar){
                           alert('Preencha o campo Responsável do GAAR');
                           document.getElementById('requigaar').focus();
                       }
        
        }
        
        function loadData(){
                document.getElementById('dtcirurgia').valueAsDate = new Date();
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
				  case 'clinica':
				  	include_once("menu_vet.php") ;
					break;
				  case 'veterinario':
				  	include_once("menu_veterinario.php") ;
					break;
				  case 'lt':
				  	include_once("menu_lt.php") ;
					break;
			  }

		
?>
<main role="main" class="container">
    <div class="starter-template">
       <center>
        <h3>AUTORIZAÇÃO DE PROCEDIMENTOS</h3><br>
        <h4>PEDIDO NÚMERO <?echo $idprocedi?></h4>
       </center>
       <br>
        <form action="cadastroagenda.php" method="POST" enctype="multipart/form-data" name="form"> 
                    <input name="idpedido" type="text" id="idpedido" class="form-control" value="<? echo $idprocedi ?>" hidden>
                    <fieldset class="form-group">
                        <?
                            if ($idanimaldogaar <> "0") {
                                echo "<script>
                                        document.getElementById('divgaar').className  = 'd-block';
                                        document.getElementById('divprotetor').className  = 'd-none';
                                      </script>";
                            } else {
                                echo "<script>
                                        document.getElementById('divgaar').className  = 'd-none';
                                        document.getElementById('divprotetor').className  = 'd-block';
                                      </script>";
                            }
                        ?>
                        <div id="divprotetor" class="d-block">
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">ID de protetor: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $idprotetor ?></label>
                                    <input name="idprotetor" type="text" id="idprotetor" class="form-control" value="<? echo $idprotetor ?>" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Agendamentos gratuitos autorizados no mês: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $castracoes_protetor_gratis ?></label>
                                    <input name="agendamentos" type="text" id="agendamentos" class="form-control" value="<? echo $castracoes_protetor_gratis ?>" hidden>
                                </div>
                            </div>
                             <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Agendamentos pagos autorizados no mês: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $castracoes_protetor ?></label>
                                    <input name="agendamentos" type="text" id="agendamentos" class="form-control" value="<? echo $castracoes_protetor ?>" hidden>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Nome: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $nomeresp ?></label>
                                    <input name="nomeresp" type="text" id="nomeresp" class="form-control" value="<? echo $nomeresp ?>" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Telefone: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $telresp ?></label>
                                    <input name="telresp" type="text" id="telresp" class="form-control" value="<? echo $telresp ?>" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">E-mail: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $emailresp ?></label>
                                    <input name="emailresp" type="text" id="emailresp" class="form-control" value="<? echo $emailresp ?>" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Bairro: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0" > <? echo $bairro ?></label>
                                    <input name="bairro" type="text" id="bairro" class="form-control" value="<? echo $bairro ?>" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Cidade: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0" id="cidade"> <? echo $cidade ?></label>
                                    <input name="cidade" type="text" id="cidade" class="form-control" value="<? echo $cidade ?>" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Valor que pode ajudar: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0">R$<? echo $valorajuda ?> <font color="red"><? echo $txtvalorajuda?></font></label>
                                    <input name="valorajuda" type="text" id="valorajuda" class="form-control" value="<? echo $valorajuda ?>" hidden>
                                    <input name="txtvalorajuda" type="text" id="txtvalorajuda" class="form-control" value="<? echo $txtvalorajuda?>" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Veterinária escolhida: </legend> 
                                <div class="col-sm-8">
                                    <label class="col-form-label col-sm-8 pt-0" id=""><? echo $melhorvet ?></label>
                                    <input name="melhorvet" type="text" id="melhorvet" class="form-control" value="<? echo $melhorvet ?>" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Melhor dia e horário: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0" id=""><? echo $melhordia ?></label>
                                    <input name="melhordia" type="text" id="melhordia" class="form-control" value="<? echo $melhordia ?>" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Voluntário do GAAR que intermediou: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0" id=""><? echo $volgaar ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Quem vai levar o animal: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $quemleva ?></label>
                                    <input name="quemleva" type="text" id="quemleva" class="form-control" value="<? echo $quemleva ?>" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Obs: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $obs ?></label>
                                    <input name="obs" type="text" id="obs" class="form-control" value="<? echo $obs ?>" hidden>
                                </div>
                        </div>
                        <br>
                        <div id="divgaar" class="d-block">
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">ID de animal do GAAR: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $idanimaldogaar ?></label>
                                    <input name="idanimaldogaar" type="text" id="idanimaldogaar" class="form-control" value="<? echo $idanimaldogaar ?>" hidden>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Nome do animal: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"><? echo $nomedoanimal ?></label>
                                    <input name="nomedoanimal" type="text" id="nomedoanimal" class="form-control" value="<? echo $nomedoanimal ?>" hidden>
                                </div>
                        </div>  
                        <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Data de nascimento aproximada: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"><? echo $dia_nascimento."/".$mes_nascimento."/".$ano_nascimento ?></label>
                                    <input name="dtnasc" type="text" id="dtnasc" class="form-control" value="<? echo $dtnasc ?>" hidden>
                                </div>
                        </div>  
                        <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Espécie: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $especie ?></label>
                                    <input name="especie" type="text" id="especie" class="form-control" value="<? echo $especie ?>" hidden>
                                </div>
                        </div> 
                        <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Porte: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $porte ?></label>
                                    <input name="porte" type="text" id="porte" class="form-control" value="<? echo $porte ?>" hidden>
                                </div>
                        </div> 
                        <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Sexo: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $sexo ?></label>
                                    <input name="sexo" type="text" id="sexo" class="form-control" value="<? echo $sexo ?>" hidden>
                                </div>
                        </div>
                        <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Peso: </legend> 
                                <div class="col-sm-5">
                                    <label class="col-form-label col-sm-9 pt-0"> <? echo $peso ?> kg</label>
                                    <input name="peso" type="text" id="peso" class="form-control" value="<? echo $peso ?>" hidden>
                                </div>
                        </div>
                    </fieldset>
                    <br><br>
                    <div id="dadosprocedi" class="form-row d-block">
                        <center><h5>DADOS DO PROCEDIMENTO OU SERVIÇO</h5></center>
                        <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Código:</label> 
                                    <input name="codigoautoriza" type="text" id="codigoautoriza" maxlenght="12" class="form-control" required>
                                    <small id="passwordHelpBlock" class="form-text text-muted">Inserir o código caso já tenha sido gerado. Se não tiver, deixe em branco que o sistema gerará um automaticamente. </small>
                                </div>
                                
                        </div>
                        <div class="form-row">
                                <div class="form-group col-md-6">
                                <legend class="col-form-label col-sm-7 pt-0">Voluntário que autorizou: </legend> 
                                    <!--<label class="col-form-label col-sm-9 pt-0" id=""><? echo $volgaar ?></label>-->
                                    <select class='form-control' id='volgaar' name='volgaar' required>
                                                        <option selected value="<? echo $volgaar?>"><? echo $volgaar?></option>";
                                         		        <option value=''>-------------------</option>";
                                                    <?
                                                        $queryvol = "SELECT NOME FROM VOLUNTARIOS WHERE AREA = 'diretoria' ORDER BY NOME ASC";
                                                        $selectvol = mysqli_query($connect,$queryvol);
                                                        $reccount = mysqli_num_rows($selectvol);
                                                        
                                                        while ($fetchvol = mysqli_fetch_row($selectvol)) {
                                                					echo "<option value='".$fetchvol[0]."'>".$fetchvol[0]."</option>";
                                                		}
                                                    ?>
                                    </select>
                                    <small id="passwordHelpBlock" class="form-text text-muted">Caso não tenha voluntário intermediário, o nome do voluntário logado aparecerá como primeira opção. </small>
                                </div>
                        </div>
                        <br>
                        <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label>Tipo do procedimento: <font color="red"><strong>*</strong></font></label>
                                    <!--<select class="form-control" id="tipoproc" name="tipoproc" required onchange="OnChangeSelect()" > -->
                                    <? if ($countpedido <> '0') {
                                        echo "<select class='form-control' id='tipoproc' name='tipoproc' required> 
                                     		    <option value=''>Selecione</option>
                                         		<option value='Castração' selected>Castração</option>
                                         		<option value='Cirurgia'>Cirurgia</option>
                                         		<option value='Consulta'>Consulta</option>
                                         		<option value='Eutanásia'>Eutanásia</option>
                                         		<option value='Exame'>Exame</option>
                                         		<option value='Limpeza de tártaro'>Limpeza de tártaro</option>
                                         		<option value='Roupa cirúrgica'>Roupa cirúrgica</option>
                                         		<option value='Transporte'>Transporte</option>
                                         		<option value='Vacina'>Vacina</option>
                                     		  </select>";
                                    } else {
                                        echo "<select class='form-control' id='tipoproc' name='tipoproc' required> 
                                         		  <option value=''>Selecione</option>
                                         		  <option value='Castração'>Castração</option>
                                         		  <option value='Cirurgia'>Cirurgia</option>
                                         		  <option value='Consulta'>Consulta</option>
                                         		  <option value='Eutanásia'>Eutanásia</option>
                                         		  <option value='Exame'>Exame</option>
                                         		  <option value='Limpeza de tártaro'>Limpeza de tártaro</option>
                                         		  <option value='Roupa cirúrgica'>Roupa cirúrgica</option>
                                         		  <!--<option value='Outros'>Outros</option>-->
                                         		  <option value='Transporte'>Transporte</option>
                                         		  <option value='Vacina'>Vacina</option>
                                              </select>";
                                    }
                                    ?>
                                </div>
                        </div>
                        <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Data: <font color="red"><strong>*</strong></font></label> 
                                    <input name="dataprocedi" type="date" id="dataprocedi" class="form-control" required>
                                </div>
                                
                        </div>
                        <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Hora: <font color="red"><strong>*</strong></font></label> 
                                    <input name="horaprocedi" type="time" id="horaprocedi" class="form-control" required>
                                </div>
                                
                        </div>
                        <div class="form-row">
                                
                                <?
                                
                                    echo "<div class='form-group col-md-6'>
                                                <label>Clínica: <font color='red'><strong>*</strong></font></label>
                                                <select class='form-control' id='idvet' name='idvet' required>
                                                  <option selected value='".$idvet."'>".$melhorvet."</option>
                                                  <option value=''>--------------------------</option>
                                         		  <option value=''>Para alterar, escolha uma das opções abaixo:</option>";
                                         		  
                                            if ($area == 'clinica') {
                                                      $queryclinica = "SELECT * FROM CLINICAS WHERE EMAIL = '".$email."' ORDER BY CLINICA ASC";
                                            } else {
                                                switch ($especie){
                                                    case 'Felina':
                                                      $queryclinica = "SELECT * FROM CLINICAS WHERE ESPECIE LIKE '%Felina%' ORDER BY CLINICA ASC";
                                                      break;
                                                    case 'Canina':
                                                      $queryclinica = "SELECT * FROM CLINICAS WHERE ESPECIE ='Canina e Felina' ORDER BY CLINICA ASC";
                                                      break;
                                                }
                                            }
                                    
    
                                            $selectclinica = mysqli_query($connect,$queryclinica);
                                            $reccount = mysqli_num_rows($selectclinica);
                                            
                                            while ($fetchclinica = mysqli_fetch_row($selectclinica)) {
                                    					echo "<option value='".$fetchclinica[0]."'>".$fetchclinica[1]."</option>";
                                    		}
                                            	
                                        echo "</select>
                                            </div>";
                                ?>
                                <p><a href="https://gaarcampinas.org/area/precosvet.php" target="_blank">Tabela de valores</a></p>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="inalatoria" name="inalatoria">
                          <label class="form-check-label" for="defaultCheck1">Anestesia inalatória</label>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                        <label>Quantidade: <font color="red"><strong>*</strong></font></label>
                                        <!--<select class="form-control" id="qtde" name="qtde" required onchange="OnChangeRadio4 (this)">-->
                                        <select class="form-control" id="qtde" name="qtde" required>
                                            <option value="01">01</option>
                                        </select>
                            </div>
                        </div>
                                <?
                                
                                    mysqli_data_seek($selectclinica, 0);
                                    
                                    while ($fetchclinica = mysqli_fetch_row($selectclinica)) {
                                    					$nomeclinica = $fetchclinica[1];
                                    					$valorgato = $fetchclinica[10];
                                    					$valorgata = $fetchclinica[11];
                                    					$valormachop = $fetchclinica[12];
                                    					$valormachom = $fetchclinica[13];
                                    					$valormachog = $fetchclinica[14];
                                    					$valorfemeap = $fetchclinica[15];
                                    					$valorfemeam = $fetchclinica[16];
                                    					$valorfemeag = $fetchclinica[17];
                                    }    
                                    $tmpclinica = $nomeclinica;
                                    
                                    echo "<div class='form-row'>
                                                <div class='form-group col-md-10'>
                                                        <small id='passwordHelpBlock' class='form-text text-muted'>Valor total de castrações será calculado de acordo com a quantidade ao cadastrar o procedimento</small>
                                                </div>
                                            </div>
                                            <div class='form-row d-none' id='divvaloroutros'>
                                                <div class='form-group col-md-6'>
                                                        <label>Valor total de outras despesas: </label>
                                                        <div class='input-group-prepend'>
                                                            <div class='input-group-text'>R$</div>
                                                                <input name='outrasdesp' type='text' id='outrasdesp' maxlength='20' class='form-control' required>
                                                        </div>
                                                        <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto. Descrever no campo <i>Observações</i></small>
                                                </div>
                                            </div>
                                            <div class='form-row d-none' id='divvalordesconto'>
                                                <div class='form-group col-md-6'>
                                                        <label>Desconto: </label>
                                                        <div class='input-group-prepend'>
                                                            <div class='input-group-text'>R$</div>
                                                                <input name='desconto' type='text' id='desconto' maxlength='20' class='form-control' required value='0.0'>
                                                        </div>
                                                        <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto. Descrever no campo <i>Observações</i></small>
                                                </div>
                                            </div>
                                            <div class='form-row d-none' id='divvalortutor'>
                                                <div class='d-none form-group col-md-6'>
                                                            <label>Valor pago pelo tutor/responsável: <font color='red'><strong>*</strong></font></label>
                                                            <div class='input-group-prepend'>
                                                                <div class='input-group-text'>R$</div>
                                                                    <input name='valortutor' type='text' id='valortutor' maxlength='20' class='form-control' required>
                                                            </div>
                                                            <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto</small>
                                                </div>
                                            </div>
                                            <div class='form-group col-md-6'>
                                                        <label>Valor adicional (caso o protetor queira pagar a mais além do valor já mencionado): </label>
                                                        <div class='input-group-prepend'>
                                                            <div class='input-group-text'>R$</div>
                                                                <input name='valoradicional' type='text' id='valoradicional' maxlength='20' class='form-control' required>
                                                        </div>
                                                        <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto</small>
                                            </div>
                                            <div class='form-group col-md-6'>
                                                        <label>Valor que o GAAR vai pagar: </label>
                                                        <div class='input-group-prepend'>
                                                                <label>R$ ".$valorgaar."</label>
                                                                <input name='valorgaar' type='text' id='valorgaar' maxlength='20' class='form-control' value='".$valorgaar."' hidden>
                                                        </div>
                                                        <small id='passwordHelpBlock' class='form-text text-muted'> </small>
                                            </div>
                                            <div class='form-group col-md-6'>
                                                        <label>Novo valor que o GAAR irá pagar: </label>
                                                        <div class='input-group-prepend'>
                                                            <div class='input-group-text'>R$</div>
                                                                <input name='valorgaar_novo' type='text' id='valorgaar_novo' maxlength='20' class='form-control' value='".$valorgaar_novo."' required>
                                                        </div>
                                                        <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto.  </small>
                                            </div>
                                            ";

                                ?>
                                <div class="form-group col-md-8">
                                    <input type="checkbox" class="form-check-input" id="gaarnaocastra" name="gaarnaocastra" value="gaarnaocastra">
                                    <label class="form-check-label" for="exampleCheck1">O GAAR não irá subsidiar o procedimento.</label>
                                </div>
                    </div>
                    <br>
                    <div id="divobs" class="form-row d-none">
                        <div class="form-row">
                                <div class="form-group col-md-8">
                                  <label>Observações: <font color="red"><strong>*</strong> obrigatório para procedimento 'Outros'</font></label>
                                    <textarea class="form-control" name="obsgaar" cols="70" rows="10" id="obsgaar"></textarea>
                                    <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis</small>
                                </div>
                        </div>
                    </div>
                    <div id="divfooter" class="form-row d-block">
                    <p><font color="red"><strong>* Campos obrigatórios</strong></font></p>
                    <br><br>
                    <?
                      echo "<table align='center'>
                                <tr>
                                    <td><center><a href='javascript:form.submit()' class='btn btn-primary'>Cadastrar</a> &nbsp;&nbsp;</td>
                                    <td><a href='formenvioemailcastracao.php?idpedidocastra=".$idprocedi."' class='btn btn-primary'>Responder ao interessado</a> &nbsp;&nbsp;</td>
                                    <td><a href=\"javascript:window.history.go(-1)\" class='btn btn-primary'>Voltar</a></td>
                                </tr>
                            </table>";
                    ?>
                </div>
                </div>
                <br>
                
            </form>
            <br>
              <div class="form-group row">
                          <div id="divultimosprocedi" class="d-block">
                            	<center>
                                       <br><h4>ÚLTIMOS PROCEDIMENTOS CADASTRADOS</h4><br>
                            	<?
                            	    if ($area == 'clinica') {
                                                  $queryclinica = "SELECT * FROM AGENDAMENTO WHERE CLINICA = '".$tmpclinica."' ORDER BY DATA_AG DESC LIMIT 10";
                                        } else {
                                            
                                                  $queryclinica = "SELECT * FROM AGENDAMENTO ORDER BY DATA_REG DESC LIMIT 10";
                                        }
                                        
                                        $selectclinica = mysqli_query($connect,$queryclinica);
                            	        $reccount = mysqli_num_rows($selectclinica);
                            	        
                            	        if ($reccount != '0'){
                                		    echo "<table class='table'>";
                                            echo "<thead class='thead-light'>";
                                            /*echo "<th scope='col'>ID</th>";*/
                                            echo "<th scope='col'>Código</th>";
                                        	echo "<th scope='col'>Data</th>";
                                        	echo "<th scope='col'>Hora</th>";
                                        	echo "<th scope='col'>Nome do animal</th>";
                                        	echo "<th scope='col'>Espécie</th>";
                                        	echo "<th scope='col'>Responsável</th>";
                                        	echo "<th scope='col'>Ativo</th>";
                                        	//echo "<th scope='col'>Quantidade</th>";
                                        	//echo "<th scope='col'>Valor</th>";
                                        	echo "<th scope='col' colspan='2'>&nbsp</th>";
                                        	echo "</thead>";
                                        	echo "<tbody>";
                            	        
                            	           while ($fetchclinica = mysqli_fetch_row($selectclinica)) {
                                	            $codigoautoriza = $fetchclinica[0];
                                				$dtclinica = $fetchclinica[1];
                                				$horaclinica = $fetchclinica[2];
                                				$nomeanimal = $fetchclinica[3];
                                				$especie = $fetchclinica[4];
                                				$respgaar = $fetchclinica[10];
                                				$qtdclinica = $fetchclinica[17];
                                				$valor_ajuda = $fetchclinica[13];
                                				$valor_gaar = $fetchclinica[14];
                                				$ativo = $fetchclinica[18];
                                				$sum = floatval($valor_gaar) - floatval($valor_ajuda);
                                				
                                				$ano_dtclinica = substr($dtclinica,0,4);
                                		        $mes_dtclinica = substr($dtclinica,5,2);
                                		        $dia_dtclinica = substr($dtclinica,8,2);
                                		    
                                        			echo "<tr>";
                                        			/*echo "<td>".$idprocedi."</td>";*/
                                        			echo "<td>".$codigoautoriza."</td>";
                                        			echo "<td>".$dia_dtclinica."/".$mes_dtclinica."/".$ano_dtclinica."</td>";
                                					echo "<td>".$horaclinica."</td>";
                                					echo "<td>".$nomeanimal."</td>";
                                					echo "<td>".$especie."</td>";
                                					echo "<td>".$respgaar."</td>";
                                					//echo "<td>".$qtdclinica."</td>";
                                				    /*if ($area =='diretoria'){
                                                	    echo "<td>R$ ".number_format($sum,2,',', '.')."</td>";
                                                	} else {
                                                	    echo "<td>R$ ".number_format($sum,2,',', '.')."</td>";
                                                	}*/
                                                	echo "<td>".$ativo."</td>";
                                                	if ($subarea =='diretoria' || $subarea =='financeiro'){
                                        				        /*echo "<td colspan='2'><div class='d-print-none'><a href='formatualizaprocedi.php' class='btn btn-primary'>Atualizar</a>&nbsp;<a href='aprovaprocedimento.php' class='btn btn-primary' target='_blank'>Aprovar</a><a href='javascript:form.submit()'>Apagar</a></div></td>"; */
                                        				        echo "<td colspan='2'><div class='d-print-none'><a href='deletaprocedimento.php?idprocedi=".$idprocedi."' class='btn btn-primary'>Apagar</a></div></td>";    
                                        			}else {
                                        				        echo"<td>&nbsp;</td>";    
                                        			}
                                				    echo "</tr>";
                                			}   
                                			        echo "</tbody>";
                                			        echo "</table><br>";
                            	        }
                                		else {
                                		        echo "<p>Nenhum procedimento encontrado para a data ".$dataprocedi."</p><br>";
                                		}
                                		mysqli_close($connect);
                            	?>
                            	</center>
                    </div>
              </div>
    </div>
</main>
<br><br>
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
<?
}
mysqli_close($connect);
?>
</html>
