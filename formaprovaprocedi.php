<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];
$id = $_GET['id'];

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
		
		$queryvet = "SELECT CLINICA FROM CLINICAS WHERE EMAIL ='$email'";
		$selectvet = mysqli_query($connect,$queryvet);
			
		while ($fetchvet = mysqli_fetch_row($selectvet)) {
				$clinica = $fetchvet[0];
		}
		
		$queryprocedi = "SELECT * FROM PROCEDIMENTOS WHERE ID = '$id'";
		$selectprocedi = mysqli_query($connect,$queryprocedi);
			
		while ($fetchproc = mysqli_fetch_row($selectprocedi)) {
				$data = $fetchproc[1];
				$nomedoanimal = $fetchproc[2];
				$especie = $fetchproc[3];
				$sexo = $fetchproc[4];
				$porte = $fetchproc[5];
				$nomedotutor = $fetchproc[6];
				$teldotutor = $fetchproc[7];
				$volgaar = $fetchproc[8];
				$tipoprocedi = $fetchproc[10];
				$valor = $fetchproc[11];
				$valortutor = $fetchproc[12];
				$clinica = $fetchproc[13];
				$statusprocedi = $fetchproc[14];
				$obs = $fetchproc[15];
				$emaildotutor = $fetchproc[16];
				$qtde = $fetchproc[17];
				
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
                            document.getElementById("valor").value = 0;
                    } else {
                        document.getElementById("valor").value = valortot;
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
		}
		
		
?>
<main role="main" class="container">
    <div class="starter-template">
       <center>
           <br>
        <h3>APROVAÇÃO DO PROCEDIMENTO <? echo $id ?></h3><br>
        <p><label> É importante cadastrar o procedimento corretamente pois as informações aqui preenchidas irão ser usadas para realizar pagamentos.</label></p>
       </center>
            <form action="aprovaprocedimento.php" method="POST" enctype="multipart/form-data" name="form">
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
                                                <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno' onclick='OnChangeRadio3 (this)' checked> <label class='form-check-label' required>Pequeno </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>    
                                                <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Médio </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Grande </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='Gato' value='Gato' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;
                                            </div>";
                                        break;
                                        
                                    case 'Médio':
                                       echo "<div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno' onclick='OnChangeRadio3 (this)'> <label class='form-check-label' required>Pequeno </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>    
                                                <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio' onclick='OnChangeRadio3 (this)' checked> <label class='form-check-label'>Médio </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Grande </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='Gato' value='Gato' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;
                                            </div>";
                                        break;
                                        
                                    case 'Grande':
                                       echo "<div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno' onclick='OnChangeRadio3 (this)'> <label class='form-check-label' required>Pequeno </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>    
                                                <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Médio </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande' onclick='OnChangeRadio3 (this)' checked> <label class='form-check-label'>Grande </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='Gato' value='Gato' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;
                                            </div>";
                                        break;
                                        
                                    case 'Gato':
                                       echo "<div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno' onclick='OnChangeRadio3 (this)'> <label class='form-check-label' required>Pequeno </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>    
                                                <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Médio </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande' onclick='OnChangeRadio3 (this)'> <label class='form-check-label'>Grande </label> &nbsp; &nbsp;
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='porte' id='Gato' value='Gato' onclick='OnChangeRadio3 (this)' checked> <label class='form-check-label'>Gato </label> &nbsp; &nbsp;
                                            </div>";
                                        break;
                                }
 
                            ?>
                          </div>
                        </div>
                    </fieldset>
                </div>
                    <br>
                    <center><h5>DADOS DO PROCEDIMENTO</h5></center>
                    <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Data: <font color="red"><strong>*</strong></font></label> 
                                <input name="dtcirurgia" type="date" id="dtcirurgia" class="form-control" required value ="<? echo $data?>">
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
                            
                            <div class='form-group col-md-4'>
                                            <label>Clínica: </label>
                                            <select class='form-control' id='inlineFormCustomSelect' name='clinica' required>
                            <?
                               if ($area == 'clinica') {
                                          $queryclinica = "SELECT * FROM CLINICAS WHERE EMAIL = '".$email."' ORDER BY CLINICA ASC";
                                } else {
                                    
                                          $queryclinica = "SELECT * FROM CLINICAS ORDER BY CLINICA ASC";
                                          echo "<option value='".$clinica."'>".$clinica."</option>";
                                                echo "<option value=''>--------------</option>";
                                }

                                                $selectclinica = mysqli_query($connect,$queryclinica);
                                                $reccount = mysqli_num_rows($selectclinica);
                                                                                     		  
                                				while ($fetchclinica = mysqli_fetch_row($selectclinica)) {
                                					echo "<option value='".$fetchclinica[1]."'>".$fetchclinica[1]."</option>";
                                					$valorgato = $fetchclinica[10];
                                					$valorgata = $fetchclinica[11];
                                					$valormachop = $fetchclinica[12];
                                					$valormachom = $fetchclinica[13];
                                					$valormachog = $fetchclinica[14];
                                					$valorfemeap = $fetchclinica[15];
                                					$valorfemeam = $fetchclinica[16];
                                					$valorfemeag = $fetchclinica[17];
                                				}
                                        	
                                    echo "</select>
                                        </div>";
                            ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                                    <label>Quantidade: <font color="red"><strong>*</strong></font></label>
                                    <select class="form-control" id="qtde" name="qtde" required onchange="OnChangeRadio4 (this)">
                                        
                                        <?
                                            echo "<option value='".$qtde."'>".$qtde."</option>";
                                            echo "<option value=''>--------------</option>";
                                        ?>
                                        
                                        <option value="0">Selecione</option>
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
                            <?
                                if ($area == 'clinica') {
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
                                        
                                } 
                                
                                if ($area == 'operacional') {
                                    echo "<div class='d-none form-group col-md-4'>
                                                <label>Valor a ser pago pelo GAAR: </label>
                                                <div class='input-group-prepend'>
                                                    <div class='input-group-text'>R$</div>
                                                        <input name='valor' type='text' id='valor' maxlength='20' class='form-control' required value='".$valor."'>
                                                </div>
                                                <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto</small>
                                        </div>
                                        <div class='form-group col-md-4'>
                                                    <label>Valor pago pelo tutor/responsável: <font color='red'><strong>*</strong></font></label>
                                                    <div class='input-group-prepend'>
                                                        <div class='input-group-text'>R$</div>
                                                            <input name='valortutor' type='text' id='valortutor' maxlength='20' class='form-control' required value='".$valortutor."'>
                                                    </div>
                                                    <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto</small>
                                        </div>
                                        ";
                                } 
                                if ($area == 'diretoria') {
                                    echo "<div class='form-group col-md-4'>
                                                <label>Valor a ser pago pelo GAAR: </label>
                                                <div class='input-group-prepend'>
                                                    <div class='input-group-text'>R$</div>
                                                        <input name='valor' type='text' id='valor' maxlength='20' class='form-control' required value='".$valor."'>
                                                </div>
                                                <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto</small>
                                        </div>
                                        <div class='form-group col-md-4'>
                                                    <label>Valor pago pelo tutor/responsável: <font color='red'><strong>*</strong></font></label>
                                                    <div class='input-group-prepend'>
                                                        <div class='input-group-text'>R$</div>
                                                            <input name='valortutor' type='text' id='valortutor' maxlength='20' class='form-control' required value='".$valortutor."'>
                                                    </div>
                                                    <small id='passwordHelpBlock' class='form-text text-muted'>Ao invés da vírgula, colocar ponto</small>
                                        </div>
                                        ";
                                } 
                                
                                
                            ?>
                    </div>
                   <div id="dadosoutros" class="d-none">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Descrição: <font color="red"><strong>*</strong></font></label> 
                                    <input name="descricap" type="text" id="descricao" maxlength="50" class="form-control" required>
                                </div>
                        </div> 
                   </div>
                   <div id="dadosprocedi" class="d-block">
                        <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Responsável do GAAR que solicitou o procedimento: <font color="red"><strong>*</strong></font></label>
                                    <select class="form-control" id="inlineFormCustomSelect" name="requigaar" required>
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
                    </div>
                    <br>
                    <div id="dadosresp" class="d-block">
                        <center><h5>DADOS DO RESPONSÁVEL</h5></center>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Nome: <font color="red"><strong>*</strong></font></label> 
                                <input name="nomedotutor" type="text" id="nomedotutor" maxlength="100" class="form-control" required value="<? echo $nomedotutor ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Telefone: <font color="red"><strong>*</strong></font></label> 
                                <input name="teldotutor" type="text" id="teldotutor" maxlength="20" class="form-control" required value="<? echo $teldotutor ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label>E-mail: </label> 
                                <input name="emaildotutor" type="email" id="emaildotutor" maxlength="100" class="form-control" required value="<? echo $emaildotutor ?>">
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                              <label>Observações: </label>
                                <textarea class="form-control" name="obs" cols="70" rows="10" id="obs"><?echo $obs ?></textarea></textarea>
                                <small id="passwordHelpBlock" class="form-text text-muted">Texto sem emojis</small>
                            </div>
                    </div>
                </div>
                <br>
                <p><font color="red"><strong>* Campos obrigatórios</strong></font></p>
                <br>
                <br>
                <p><center> Obs: Todos os cadastros de procedimentos irão entrar com o status "Esperando aprovação" mesmo se ele já tenha sido aprovado previamente via e-mail ou WhatsApp</center></p>
                <br>
                <input name="id" type="email" id="id" class="form-control" required value="<? echo $id ?>" hidden>
                <center><a href="javascript:form.submit()" class="btn btn-primary">Atualizar</a></center>
            </form>
            <br>
      <div class="form-group row">
                  <div id="divultimosprocedi" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMOS PROCEDIMENTOS CADASTRADOS</h4><br>
                    	<?
                    	    if ($area == 'clinica') {
                                          $queryclinica = "SELECT * FROM CLINICAS WHERE EMAIL = '".$email."' ORDER BY CLINICA ASC";
                                } else {
                                    
                                          $queryclinica = "SELECT * FROM CLINICAS ORDER BY CLINICA ASC";
                                }
                    	    
                    	    while ($fetchclinica = mysqli_fetch_row($selectclinica)) {
                    	    
                        	    $queryprocedi = "SELECT * FROM PROCEDIMENTOS WHERE CLINICA = '".$fetchclinica[1]."' ORDER BY ID DESC LIMIT 10";
                        		$resultprocedi = mysqli_query($connect,$queryprocedi);
                        		$reccount = mysqli_num_rows($resultprocedi);
                        		
                        		echo  "reccount : ".$reccount;
                        		
                        		if ($reccount != '0'){
                        		    echo "<table class='table'>";
                                    echo "<thead class='thead-light'>";
                                    echo "<th scope='col'>ID</th>";
                                	echo "<th scope='col'>Data</th>";
                                	echo "<th scope='col'>Clínica</th>";
                                	echo "<th scope='col'>Tipo</th>";
                                	echo "<th scope='col'>Espécie</th>";
                                	echo "<th scope='col'>Sexo</th>";
                                	echo "<th scope='col'>Quantidade</th>";
                                	echo "<th scope='col'>Valor</th>";
                                	echo "</thead>";
                                	echo "<tbody>";
                        	        while ($fetchprocedi = mysqli_fetch_row($resultprocedi)) {
                        	            $idprocedi = $fetchprocedi[0];
                        				$dtprocedi = $fetchprocedi[1];
                        				$especie = $fetchprocedi[3];
                        				$sexo = $fetchprocedi[4];
                        				$vetprocedi = $fetchprocedi[13];
                        				$tipoprocedi = $fetchprocedi[10];
                        				$valortutorprocedi = $fetchprocedi[12];
                        				$valorgaar = $fetchprocedi[11];
                        				$qtdprocedi = $fetchprocedi[17];
                        				$sum = floatval($valortutorprocedi) + floatval($valorgaar);
                                			echo "<tr>";
                                			echo "<td>".$idprocedi."</td>";
                                			echo "<td>".$dtprocedi."</td>";
                        					echo "<td>".$vetprocedi."</td>";
                        					echo "<td>".$tipoprocedi."</td>";
                        					echo "<td>".$especie."</td>";
                        					echo "<td>".$sexo."</td>";
                        					echo "<td>".$qtdprocedi."</td>";
                        					if ($area =='diretoria'){
                                        	    echo "<td>R$ ".number_format($sum,2,',', '.')."</td>";
                                        	} else {
                                        	    echo "<td>R$ ".number_format($sum,2,',', '.')."</td>";
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
                    	?>
                    	</center>
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