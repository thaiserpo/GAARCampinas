<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

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
				$celular = $fetcharea[3];
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
    
    <title>GAAR - Cadastro de procedimentos</title>
    
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
<body onload="loadData()">
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
        <h3>CADASTRO DE PROCEDIMENTOS</h3><br>
        <p><label> O GAAR nasceu com o intuito de ajudar a castrar os animais, caso você seja protetor independente ou pertence à família de baixa renda e gostaria de castrar o seu animal, preencha o formulário abaixo. Os pedidos serão aprovados mediante análise da área operacional e financeira do GAAR.</label> Para garantir que os e-mails cheguem em sua caixa de entrada, sugerimos adicionar o e-mail <strong>operacional@gaarcampinas.org</strong> à lista de remetentes confiáveis. </p>
       </center>
            <form action="uploadcastracao.php" method="POST" enctype="multipart/form-data" name="form">
                <i>Observações:</i>
                <p>- O arquivo precisa estar em formato CSV UTF-8 delimitado por vírgula</p>
                <p>- As datas precisam estar no formato dd/mm/yyyy</p>
                <p>- Uma aba por arquivo</p>
                <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Clínica ou veterinário: <font color='red'><strong>*</strong></font></label>
                        <div class="col-sm-6">    
                            <select class='form-control' id='clinica' name='clinica' required>
                        		<option selected value=''>Selecione</option>";
                                                 <?  $queryclinica = "SELECT * FROM CLINICAS  ORDER BY CLINICA ASC";
                                                     $selectclinica = mysqli_query($connect,$queryclinica);
                                                     $reccount = mysqli_num_rows($selectclinica);
                                                            
                                                    while ($fetchclinica = mysqli_fetch_row($selectclinica)) {
                                                    	echo "<option value='".$fetchclinica[1]."'>".$fetchclinica[1]."</option>";
                                                    }        	
                                                   ?> 
                            </select>
                        </div>
                </div>
                <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Planilha<font color="red"><strong>*</strong></font>: </label> 
                        <div class="col-sm-9">
                            <input type="file" class="form-control-file" id="procedicsv" name="procedicsv" accept=".csv">
                            <small id="passwordHelpBlock" class="form-text text-muted">Arquivo aceito em formato CSV UTF-8 delimitado por vírgula</small>
                        </div>
                </div>
                <div class="form-group row">
                        <div class="col-sm-9">
                                <input type="checkbox" class="form-check-input" id="jarealizado" name="jarealizado" checked>
                                <label class="form-check-label" for="exampleCheck1">Procedimentos já realizados</label>
                        </div>
                </div>
                <center><a href="javascript:form.submit()" class="btn btn-primary">Enviar</a></center>
            </form>

            <br>
              <div class="form-group row">
                          <div id="divultimosprocedi" class="d-block">
                            	<center>
                                       <br><h4>ÚLTIMOS PROCEDIMENTOS CADASTRADOS</h4><br>
                            	<?
                            	    if ($area == 'clinica') {
                                                  $queryclinica = "SELECT * FROM PROCEDIMENTOS WHERE CLINICA = '".$tmpclinica."' ORDER BY DATA_REG DESC LIMIT 10";
                                        } else {
                                            
                                                  $queryclinica = "SELECT * FROM PROCEDIMENTOS ORDER BY DATA_REG DESC LIMIT 10";
                                        }
                                        
                                        $selectclinica = mysqli_query($connect,$queryclinica);
                            	        $reccount = mysqli_num_rows($selectclinica);
                            	        
                            	        if ($reccount != '0'){
                                		    echo "<table class='table'>";
                                            echo "<thead class='thead-light'>";
                                            /*echo "<th scope='col'>ID</th>";*/
                                            echo "<th scope='col'>Voucher</th>";
                                        	echo "<th scope='col'>Data</th>";
                                        	echo "<th scope='col'>Clínica</th>";
                                        	echo "<th scope='col'>Tipo</th>";
                                        	echo "<th scope='col'>Espécie</th>";
                                        	echo "<th scope='col'>Responsável do GAAR</th>";
                                        	echo "<th scope='col'>Quantidade</th>";
                                        	echo "<th scope='col'>Valor</th>";
                                        	echo "<th scope='col' colspan='2'>&nbsp</th>";
                                        	echo "</thead>";
                                        	echo "<tbody>";
                            	        
                            	           while ($fetchclinica = mysqli_fetch_row($selectclinica)) {
                                	            $idprocedi = $fetchclinica[0];
                                				$dtclinica = $fetchclinica[1];
                                				$especie = $fetchclinica[3];
                                				$sexo = $fetchclinica[4];
                                				$respgaar = $fetchclinica[8];
                                				$vetclinica = $fetchclinica[13];
                                				$tipoclinica = $fetchclinica[10];
                                				$valortutorclinica = $fetchclinica[12];
                                				$valorgaar = $fetchclinica[11];
                                				$qtdclinica = $fetchclinica[17];
                                				$codigoautoriza = $fetchclinica[21];
                                				$sum = floatval($valorgaar) - floatval($valortutorclinica);
                                				
                                				$ano_dtclinica = substr($dtclinica,0,4);
                                		        $mes_dtclinica = substr($dtclinica,5,2);
                                		        $dia_dtclinica = substr($dtclinica,8,2);
                                		    
                                        			echo "<tr>";
                                        			/*echo "<td>".$idprocedi."</td>";*/
                                        			echo "<td>".$codigoautoriza."</td>";
                                        			echo "<td>".$dia_dtclinica."/".$mes_dtclinica."/".$ano_dtclinica."</td>";
                                					echo "<td>".$vetclinica."</td>";
                                					echo "<td>".$tipoclinica."</td>";
                                					echo "<td>".$especie."</td>";
                                					echo "<td>".$respgaar."</td>";
                                					echo "<td>".$qtdclinica."</td>";
                                					if ($area =='diretoria'){
                                                	    echo "<td>R$ ".number_format($sum,2,',', '.')."</td>";
                                                	} else {
                                                	    echo "<td>R$ ".number_format($sum,2,',', '.')."</td>";
                                                	}
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
