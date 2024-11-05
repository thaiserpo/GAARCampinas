<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$codigoprocedi = $_GET['cod'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,SUBAREA,EMAIL FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
				$email = $fetcharea[2];
		}

		$queryprocedi = "SELECT * FROM AGENDAMENTO WHERE CODIGO = '$codigoprocedi'";
		$selectprocedi = mysqli_query($connect,$queryprocedi);

		while ($fetchproc = mysqli_fetch_row($selectprocedi)) {
		        $codprocedi = $fetchproc[0];
				$data_ag = $fetchproc[1];
				$hora_ag = $fetchproc[2];
				$nomedoanimal = $fetchproc[3];
				$especie = $fetchproc[4];
				$sexo = $fetchproc[5];
				$porte = $fetchproc[6];
				$peso = $fetchproc[7];
				$dt_nasc = $fetchproc[8];
				$nomedotutor = $fetchproc[9];
				$volgaar = $fetchproc[10];
				$teldotutor = $fetchproc[11];
				$emaildotutor = $fetchproc[12];
				$valortutor = $fetchproc[13];
				$valor = $fetchproc[14];
				$extra = $fetchproc[15];
				$produtos = $fetchproc[16];
				$obs = $fetchproc[17];
				$ativo = $fetchproc[18];
				$idvet = $fetchproc[19];
				$tipoprocedi = $fetchproc[20];
				$idprocedi = $fetchproc[21];
				$idanimalgaar = $fetchproc[23];
				$realizado = $fetchproc[24];
				$idprotetor = $fetchproc[25];
				$quemleva = $fetchproc[26];
				$idprocedidb = $fetchproc[28];
    	}
		
		$queryprotetor = "SELECT NOME FROM PROTETORES WHERE ID='$idprotetor'";
		$selectprotetor = mysqli_query($connect,$queryprotetor); 
		$rcprot = mysqli_fetch_row($selectprotetor);
        $nomeprotetor = $rcprot[0];
        
        $queryvet = "SELECT CLINICA FROM CLINICAS WHERE ID ='$idvet'";
        $selectvet = mysqli_query($connect,$queryvet);
        $rc = mysqli_fetch_row($selectvet);
        $nomevet = $rc[0];

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
    
    <title>GAAR - Atualização de procedimentos</title>
    
    <script type="text/javascript">
                        
            function OnChangeSelect () {
             
                    var select = document.getElementById('tipoproc').value;
                    var str = select.options[select.selectedIndex].value;
                    
                       switch (str){
                           case "Castração":
                           case "Eutanásia":
                           case "Limpeza de tártaro":
                                    document.getElementById('dadosanimal').className  = "d-block";
                                    document.getElementById('dadosresp').className  = "d-block";
                                    document.getElementById('dadosoutros').className  = "d-none";
                                    document.getElementById('dadosprocedi').className  = "d-block";
                                    break;
                                    
                           case "Outros":
                                    document.getElementById('dadosanimal').className  = "d-none";
                                    document.getElementById('dadosresp').className  = "d-none";
                                    document.getElementById('dadosoutros').className  = "d-block";
                                    document.getElementById('dadosprocedi').className  = "d-none";
                                    break;
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
                            document.getElementById("valor").value= 0;
                    } else {
                        document.getElementById("valor").value= valortot;
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
           <br>
        <h3>ATUALIZAÇÃO DO PROCEDIMENTO <? echo $id ?></h3><br>
        <p><label> É importante cadastrar o procedimento corretamente pois as informações aqui preenchidas irão ser usadas para realizar pagamentos.</label></p>
       </center>
            <form action="cadastroagenda.php" method="POST" enctype="multipart/form-data" name="form">
                <br>
                    <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Código de autorização: <font color="red"><strong><? echo $codprocedi?></strong></font></label> 
                                <input name="codigoautoriza" type="text" id="codigoautoriza" class="form-control" required value="<? echo $codprocedi?>" hidden>
                                <input name="idprocedi" type="text" id="idprocedi" class="form-control" required value="<? echo $idprocedi?>" hidden>
                            </div>
                    </div>
                    <div class="form-row">
                            <div class="form-group col-md-5">
                                <label>Nome do(a) protetor(a): <? echo $idprotetor." - ".$nomeprotetor?></font></label> 
                                <input name="idprotetor" type="text" id="idprotetor" class="form-control" required value="<? echo $idprotetor?>" hidden>
                            </div>
                    </div>
                    <div class="form-row">
                            <div class="form-group col-md-3">
                                <input name="action" type="text" id="action" class="form-control" required value="u" hidden>
                                <input name="idprocedidb" type="text" id="action" class="form-control" required value="<?echo $idprocedidb?>" hidden>
                            </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Data: <font color="red"><strong>*</strong></font></label> 
                            <input name="dataprocedi" type="date" id="dataprocedi" class="form-control" required value="<? echo $data_ag?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Hora: <font color="red"><strong>*</strong></font></label> 
                            <input name="horaprocedi" type="time" id="horaprocedi" class="form-control" required value="<? echo $hora_ag?>">
                        </div>
                    </div>
                    <div class="form-row">
                            <div class="form-group col-md-4">
                              <label>Tipo de procedimento: <font color="red"><strong>*</strong></font></label>
                                <select class="form-control" id="tipoproc" name="tipoproc" required onchange="OnChangeSelect()" > 
                                
                                <?
                                        echo "<option value='".$tipoprocedi."'>".$tipoprocedi."</option>";
                                        echo "<option value=''>--------------</option>";
                                ?>
                                 		  <option value="">Selecione</option>
                                 		  <option value="Castração">Castração</option>
                                 		  <option value="Eutanásia">Eutanásia</option>
                                 		  <option value="Limpeza de tártaro">Limpeza de tártaro</option>
                                 		  <option value="Outros">Outros</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                    <label>Quantidade: <font color="red"><strong>*</strong></font></label>
                                    <select class="form-control" id="qtde" name="qtde" required>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                    </select>
                            </div>
                            </div>
                    </div>
                    <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Clínica: <? echo $nomevet?></label> 
                                <input name="idvet" type="text" id="idvet" class="form-control" required value="<? echo $idvet?>" hidden>
                            </div>
                    </div>
                    <div class="form-row">
                            <div class="form-group col-md-3">
                                <!--<?
                                
                                    echo "<div class='form-group col-md-10'>
                                                <label>Clínica: <font color='red'><strong>*</strong></font></label>
                                                <select class='form-control' id='idvet' name='idvet' required>
                                                  <option selected value='".$idvet."'>".$nomevet."</option>
                                                  <option value=''>--------------------------</option>
                                         		  <option value=''>Para alterar, escolha uma das opções abaixo:</option>";

                                                switch ($especie){
                                                    case 'Felina':
                                                      $queryclinica = "SELECT * FROM CLINICAS WHERE ESPECIE LIKE '%Felina%' ORDER BY CLINICA ASC";
                                                      break;
                                                    case 'Canina':
                                                      $queryclinica = "SELECT * FROM CLINICAS WHERE ESPECIE ='Canina e Felina' ORDER BY CLINICA ASC";
                                                      break;
                                                }
    
                                            $selectclinica = mysqli_query($connect,$queryclinica);
                                            $reccount = mysqli_num_rows($selectclinica);
                                            
                                            while ($fetchclinica = mysqli_fetch_row($selectclinica)) {
                                    					echo "<option value='".$fetchclinica[0]."'>".$fetchclinica[1]."</option>";
                                    		}
                                            	
                                        echo "</select>
                                            </div>";
                                ?>-->
                                <p><a href="https://gaarcampinas.org/area/precosvet.php" target="_blank">Tabela de valores</a></p>
                                    <input name="idvet" type="text" id="idvet" class="form-control" required value="<? echo $idvet?>" hidden>  
                                </div>    
                    </div>
                            <?
                                /*if ($area == 'clinica') {
                                    echo "<div class='form-row'>
                                            <div class='d-block form-group col-md-6'>
                                                    <label>Tabela de valores. Para atualizar, <i><a href='formatualizavalores.php'> clique aqui</a></i></label>
                                                    <div class='col-sm-10'>
                                                        <div class='form-check'>
                                                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitgato' value='".$valorgato."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valorgato." - gato</label>
                                                        </div>
                                                        <div class='form-check'>
                                                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitgata' value='".$valorgata."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valorgata." - gata</label>
                                                        </div>
                                                        <div class='form-check'>
                                                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitmachop' value='".$valormachop."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valormachop." - cão pequeno</label>
                                                        </div>
                                                        <div class='form-check'>
                                                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitmachom' value='".$valormachom."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valormachom." - cão médio</label>
                                                        </div>
                                                        <div class='form-check'>
                                                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitmachog' value='".$valormachog."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valormachog." - cão grande</label>
                                                        </div>
                                                        <div class='form-check'>
                                                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitfemeap' value='".$valorfemeap."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valorfemeap." - cadela pequena</label>
                                                        </div>
                                                        <div class='form-check'>
                                                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitfemeam' value='".$valorfemeam."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valorfemeam." - cadela média</label>
                                                        </div>
                                                        <div class='form-check'>
                                                            <input class='form-check-input' type='radio' name='valorunit' id='valorunitfemeag' value='".$valorfemeag."' ><label class='form-check-label' for='gridRadios1' required>R$ ".$valorfemeag." - cadela grande</label>
                                                        </div>
                                                      </div>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class='form-group col-md-4'>
                                                    <label>Valor total de castrações: </label>
                                                    <div class='input-group-prepend'>
                                                        <div class='input-group-text'>R$</div>
                                                            <input name='valor' type='text' id='valor' maxlength='20' class='form-control' required value='".$valor."'>
                                                    </div>
                                                    <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto</small>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class='form-group col-md-4'>
                                                    <label>Valor total de outras despesas: </label>
                                                    <div class='input-group-prepend'>
                                                        <div class='input-group-text'>R$</div>
                                                            <input name='outrasdesp' type='text' id='outrasdesp' maxlength='20' class='form-control' required>
                                                    </div>
                                                    <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto. Descrever as despesas no campo <i>Observações</i></small>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class='d-none form-group col-md-4'>
                                                        <label>Valor pago pelo tutor/responsável: <font color='red'><strong>*</strong></font></label>
                                                        <div class='input-group-prepend'>
                                                            <div class='input-group-text'>R$</div>
                                                                <input name='valortutor' type='text' id='valortutor' maxlength='20' class='form-control' required value='".$valortutor."'>
                                                        </div>
                                                        <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto</small>
                                            </div>
                                        </div>
                                        <br> ";
                                        
                                } */
                                ?>
                                
                                <div class='form-row'>
                                            <div class='form-group col-md-3'>
                                                <label>Valor a ser pago pelo GAAR: </label>
                                                <div class='input-group-prepend'>
                                                    <div class='input-group-text'>R$</div>
                                                        <input name='valorgaar' type='text' id='valorgaar' maxlength='20' class='form-control' required value="<? echo $valor?>">
                                                </div>
                                                <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto</small>'
                                            </div>
                                            <div class='form-group col-md-3'>
                                                <label>Valor pago pelo tutor/responsável: <font color='red'><strong>*</strong></font></label>
                                                    <div class='input-group-prepend'>
                                                        <div class='input-group-text'>R$</div>
                                                            <input name='valorajuda' type='text' id='valorajuda' maxlength='20' class='form-control' required value='<? echo $valortutor ?>'>
                                                    </div>
                                                    <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto</small>
                                            </div>
                                        </div>
                    </div>
                   <div id="dadosoutros" class="d-none">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Descrição: <font color="red"><strong>*</strong></font></label> 
                                    <input name="descricao" type="text" id="descricao" maxlength="50" class="form-control" required>
                                </div>
                        </div> 
                   </div>
                   <div id="dadosprocedi" class="d-block">
                        <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Responsável do GAAR que solicitou o procedimento: <font color="red"><strong>*</strong></font></label>
                                    <select class="form-control" id="volgaar" name="volgaar" required>
                                 		  <?
                                 		  
                                 		    echo "<option value='".$volgaar."'>".$volgaar."</option>";
                                            echo "<option value=''>--------------</option>";
                                 		   
                                            if ($subarea == 'diretoria') {

                                                $queryreq = "SELECT NOME FROM VOLUNTARIOS ORDER BY NOME ASC";
                                				$selectreq = mysqli_query($connect,$queryreq);
                                				
                                				while ($fetchreq = mysqli_fetch_row($selectreq)) {
                                					echo "<option value='".$fetchreq[0]."'>".$fetchreq[0]."</option>";
                                				}
                                            } else {
                                		 		$queryreq = "SELECT NOME FROM VOLUNTARIOS WHERE AREA='operacional' ORDER BY NOME ASC";
                                				$selectreq = mysqli_query($connect,$queryreq);
                                				while ($fetchreq = mysqli_fetch_row($selectreq)) {
                                					echo "<option value='".$fetchreq[0]."'>".$fetchreq[0]."</option>";
                                				}
                                            }
                                		?>
                        	        </select>
                        	    </div>
                        </div>
                        <fieldset class="form-group">
                            <div class="row">
                              <legend class="col-form-label col-sm-2 pt-0">Ativo? </legend>
                              <div class="col-sm-10">
                                <div class="form-check">
                                    <input class='form-check-input' type='radio' name='ativo' id='ativosim' value='SIM' checked> <label class="form-check-label">Sim</label>
                                </div>
                                <div class="form-check">
                                    <input class='form-check-input' type='radio' name='ativo' id='ativonao' value='NÃO'> <label class="form-check-label">Não</label>
                                </div>
                               </div>
                        </fieldset>
                        <fieldset class="form-group">
                            <div class="row">
                              <legend class="col-form-label col-sm-2 pt-0">Realizado? </legend>
                              <div class="col-sm-10">
                                <div class="form-check">
                                    <input class='form-check-input' type='radio' name='realizado' id='realizadosim' value='SIM'> <label class="form-check-label">Sim</label>
                                </div>
                                <div class="form-check">
                                    <input class='form-check-input' type='radio' name='realizado' id='realizadonao' value='NÃO' checked> <label class="form-check-label">Não</label>
                                </div>
                              </div>
                            </div>
                        </fieldset>
                    </div>
                    <br>
                    <div id="dadosanimal" class="d-block">
                        <center><h5>DADOS DO ANIMAL</h5></center>
                        <fieldset class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nome: <font color="red"><strong>*</strong></font></label> 
                                    <input name="nomedoanimal" type="text" id="nomedoanimal" maxlength="50" class="form-control" required value="<? echo $nomedoanimal?>">
                                </div>
                        </div>
                        <br>
                        <div class="row">
                          <legend class="col-form-label col-sm-2 pt-0">Espécie: <font color="red"><strong>*</strong></font></legend>
                          <div class="col-sm-10">
                              <? if ($especie == 'Canina') {
                                  echo "
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' onclick='OnChangeRadio2 (this)' checked><label class='form-check-label' for='gridRadios1' required >Canina</label>
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' onclick='OnChangeRadio (this)'><label class='form-check-label' for='gridRadios1'>Felina</label>
                                        </div>
                                  ";
                              } else {
                                  echo "
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' onclick='OnChangeRadio2 (this)'><label class='form-check-label' for='gridRadios1' required >Canina</label>
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' onclick='OnChangeRadio (this)' checked><label class='form-check-label' for='gridRadios1'>Felina</label>
                                        </div>
                                  ";
                              }
                              
                             ?>
                          </div>
                        </div>
                        </fieldset>
                        <br>
                        <fieldset class="form-group">
                            <div class="row">
                              <legend class="col-form-label col-sm-2 pt-0">Sexo: <font color="red"><strong>*</strong></font></legend>
                              <div class="col-sm-10">
                                <? if($sexo =='Macho') {
                                    echo "  <div class='form-check'>
                                              <input class='form-check-input' type='radio' name='sexo' id='Macho' value='Macho' checked><label class='form-check-label' required>Macho </label> &nbsp;&nbsp;
                                            </div>
                                            <div class='form-check'>
                                              <input class='form-check-input' type='radio' name='sexo' id='Fêmea' value='Fêmea'><label class='form-check-label'>Fêmea </label> 
                                            </div>";
                                } else {
                                    echo "  <div class='form-check'>
                                              <input class='form-check-input' type='radio' name='sexo' id='Macho' value='Macho' ><label class='form-check-label' required>Macho </label> &nbsp;&nbsp;
                                            </div>
                                            <div class='form-check'>
                                              <input class='form-check-input' type='radio' name='sexo' id='Fêmea' value='Fêmea' checked><label class='form-check-label'>Fêmea </label> 
                                            </div>";
                                }
                                ?>
                              </div>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="form-group">
                        <div class="row">
                          <legend class="col-form-label col-sm-2 pt-0">Porte: </legend>
                          <div class="col-sm-10">
                            <?
                                switch ($porte) {
                                    case 'Pequeno':
                                       echo "<div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='Pequeno' onclick='OnChangeRadio3 (this)' checked> <label class='form-check-label' required>Pequeno </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>    
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='Médio' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Médio </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='Grande' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Grande </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='N/A' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;
                                            </div>";
                                        break;
                                        
                                    case 'Médio':
                                       echo "<div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='Pequeno' onclick='OnChangeRadio3 (this)'> <label class='form-check-label' required>Pequeno </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>    
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='Médio' onclick='OnChangeRadio3 (this)' checked> <label class='form-check-label'>Médio </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='Grande' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Grande </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='N/A' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;
                                            </div>";
                                        break;
                                        
                                    case 'Grande':
                                       echo "<div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='Pequeno' onclick='OnChangeRadio3 (this)'> <label class='form-check-label' required>Pequeno </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>    
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='Médio' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Médio </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='Grande' onclick='OnChangeRadio3 (this)' checked> <label class='form-check-label'>Grande </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='N/A' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;
                                            </div>";
                                        break;
                                        
                                    case 'N/A':
                                       echo "<div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='Pequeno' onclick='OnChangeRadio3 (this)'> <label class='form-check-label' required>Pequeno </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>    
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='Médio' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Médio </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='Grande' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Grande </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='porte' value='N/A' onclick='OnChangeRadio3 (this)' checked> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;
                                            </div>";
                                        break;
                                }
 
                            ?>
                          </div>
                        </div>
                    </fieldset>
                    <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Data de nascimento: <font color="red"><strong>*</strong></font></label> 
                                    <input name="dtnasc" type="date" id="dtnasc" maxlength="50" class="form-control" required value="<? echo $dt_nasc?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Peso (em kg): <font color="red"><strong>*</strong></font></label> 
                                    <input name="peso" type="text" id="peso" maxlength="2" class="form-control" required value="<? echo $peso?>"> 
                            </div>
                    </div>
                    <br>
                </div>
                    <br>
                    <div id="dadosresp" class="d-block">
                        <center><h5>DADOS DO RESPONSÁVEL</h5></center>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Nome: <font color="red"><strong>*</strong></font></label> 
                                <input name="nomeresp" type="text" id="nomeresp" maxlength="100" class="form-control" required value="<? echo $nomedotutor ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Telefone: <font color="red"><strong>*</strong></font></label> 
                                <input name="telresp" type="text" id="telresp" maxlength="20" class="form-control" required value="<? echo $teldotutor ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label>E-mail: </label> 
                                <input name="emailresp" type="email" id="emailresp" maxlength="100" class="form-control" required value="<? echo $emaildotutor ?>">
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Quem leva: <font color="red"><strong>*</strong></font></label> 
                                <input name="quemleva" type="text" id="quemleva" maxlength="100" class="form-control" required value="<? echo $quemleva ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                              <label>Observações: </label>
                                <textarea class="form-control" name="obs" cols="70" rows="10" id="obs"><?echo $obs ?></textarea></textarea>
                                <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis</small>
                            </div>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='d-block form-group col-md-6'>
                            <div class='col-sm-10'>
                                <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='reenvio' id='reenvio' value="reenviar"><label class='form-check-label' for='gridRadios1' required>Reenviar o voucher por e-mail a(o) protetora(o)</label>
                                </div>
                              </div>
                    </div>
                </div>
                <br>
                <p><font color="red"><strong>* Campos obrigatórios</strong></font></p>
                <br>
                <br>
                <!--<p><center> Obs: Todos os cadastros de procedimentos irão entrar com o status "Esperando aprovação" mesmo se ele já tenha sido aprovado previamente via e-mail ou WhatsApp</center></p>-->
                <input name="id" type="text" id="id" class="form-control" required value="<? echo $id ?>" hidden>
                <?
                      echo "<table align='center'>
                                <tr>
                                    <td><center><a href='javascript:form.submit()' class='btn btn-primary'>Atualizar</a> &nbsp;&nbsp;</td>
                                    <td><a href=\"javascript:window.history.go(-1)\" class='btn btn-primary'>Voltar</a></td>
                                </tr>
                            </table>";
                    ?>
            </form>
            <br>
<?
}
mysqli_close($connect);
?>
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