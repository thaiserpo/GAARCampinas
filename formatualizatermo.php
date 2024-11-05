<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
		
		$queryarea = "SELECT AREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
		
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
		}
		
		$_SESSION['idtermo'] = $_GET['idtermo'];		
		$id = $_SESSION['idtermo'];
		
        $query = "SELECT * FROM TERMO_ADOCAO where ID='$id'";
		$select = mysqli_query($connect,$query);
        $fetch = mysqli_fetch_row($select);
		
		$adotante = $fetch[1];
		$rg = $fetch[2];
		$cpf = $fetch[3];
		$endereco = $fetch[4];
		$complemento = $fetch[45];
		$numero = $fetch[43];
		$bairro = $fetch[5];
		$cep = $fetch[6];
		$cidade = $fetch[7];
		$estado = $fetch[44];
		$pontoref = $fetch[8];
		$telfixo = $fetch[9];		
		$celular = $fetch[10];
		$email = $fetch[11];
		$facebook = $fetch[12];
		$instagram = $fetch[13];
		$profissao = $fetch[14];
		$nomeanimal = $fetch[15];
		$especie = $fetch[16];
		$idade = $fetch[17];
		$sexo = $fetch[18];
		$cor = $fetch[19];
		$porte = $fetch[20];
		$castrado = $fetch[21];
		$dtcastracao = $fetch[22];
		$vermifug = $fetch[23];
		$vacinado = $fetch[24];
		$doses = $fetch[25];
		$possuianimal = $fetch[26];
		$sesimcastrados = $fetch[27];
		$teldoador = $fetch[28];
		$emaildoador = $fetch[29];
		$lt = $fetch[30];
		$termopor = $fetch[31];
		$dtadocao = $fetch[32];
		$localadocao = $fetch[33];
		$dtposadocao = $fetch[34];
		$posadocaopor = $fetch[35];
		$obs = $fetch[36];
		$formapgto = $fetch[41];
		$nome_foto = $fetch[46];
		$nome_fotoori = $fetch[46];
		$nome_fotoadori = $fetch[47];
		$usuario = 	$fetch[35];
		/*$usuario = $_SESSION['login'];*/
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
    
    <title>GAAR - Termo de adoção</title>
    
    <script type="text/javascript">
    
        function OnChangeRadio (radio) {
                document.getElementById('divfoto').className  = "d-block";
        }
        
        function OnChangeRadio2 (radio) {
                document.getElementById('divfoto').className  = "d-none";
        }
        
        function OnChangeRadio5 (radio) {
                document.getElementById('divfotoad').className  = "d-block";
        }
        
        function OnChangeRadio6 (radio) {
                document.getElementById('divfotoad').className  = "d-none";
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
?>
<main role="main" class="container">
	  <h2><center>ATUALIZAÇÃO DO TERMO DE ADOÇÃO NÚMERO <? echo $id?></center></h2><br>
	  <form method="POST" enctype="multipart/form-data" name="form" action="atualizatermo.php">
	      <br>
	      <center><h5>DADOS DO ADOTANTE</h5></center>
	      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nome: </label> 
                  <div class="col-sm-10">
                    <input name="adotante" type="text" required id="adotante" maxlength="100" size="70"  value="<? echo $adotante ?>" class="form-control">
                  </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
                  <label>RG: </label>
                    <input type="text" required name="rg" id="rg" maxlength="10" size="10" value="<? echo $rg ?>" class="form-control">
                    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
            </div>
            <div class="form-group col-md-6">
                  <label>CPF: </label>
                    <input type="text" required name="cpf" id="cpf" maxlength="12" size="12" value="<? echo $cpf ?>" class="form-control">
                    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
            </div>
      </div>
      <div class="form-group row">
                  <label class="col-sm-2 col-form-label">CEP: </label> 
                  <div class="col-sm-10">
            	    <input name="cep" id="cep"  maxlength="15" size="15" value="<? echo $cep ?>" required class="form-control"/>
            	    <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
            	  </div>
      </div>
    <div class="form-row">
                    <div class="form-group col-md-6">
                          <label>Endereço: </label>
        		          <input type="text" name="endereco" id="endereco" maxlength="200" required class="form-control" value="<? echo $endereco?>" />
        		    </div>
        		    <div class="form-group col-md-4">
                          <label>Complemento: </label>
        		          <input type="text" name="complemento" id="complemento" maxlength="20" required class="form-control" value="<? echo $complemento?>" />
        		    </div>
        		   <div class="form-group col-md-2">
                          <label>Número: </label>
        		            <input type="text" name="numero" id="numero" maxlength="10" required class="form-control" value="<? echo $numero?>"/ >
        		            <small id="passwordHelpBlock" class="form-text text-muted">Apenas números</small>
        		   </div>
        	</div>
        	<div class="form-row">
                    <div class="form-group col-md-6">
                          <label>Bairro: </label>
        		          <input type="text"  name="bairro" id="bairro" maxlength="50" required class="form-control" value="<? echo $bairro?>" />
        		    </div>
        		   <div class="form-group col-md-6">
                          <label>Ponto de referência: </label>
        		            <input type="text"  name="pontoref" id="pontoref" required class="form-control" value="<? echo $pontoref ?>" />
        		   </div>
        	</div>
        	<div class="form-row">
                    <div class="form-group col-md-6">
                          <label>Cidade: </label>
        		          <input type="text"  name="cidade" id="cidade" maxlength="25" required class="form-control" value="<? echo $cidade?>" />
        		    </div>
        		   <div class="form-group col-md-6">
                          <label>Estado: </label>
        		            <input type="text" required name="estado" id="estado" maxlength="5" required class="form-control" value="<? echo $estado ?>" />
        		   </div>
        	</div>
	<div class="form-row">
            <div class="form-group col-md-6">
                  <label>Telefone fixo: </label>
		          <input type="text" name="telfixo" id="telfixo" maxlength="12" size="12" value="<? echo $telfixo ?>" class="form-control">
		          <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (com DDD e sem espaços)</small>
		    </div>
		   <div class="form-group col-md-6">
                  <label>Telefone celular: </label>
		            <input type="text" required name="celular" id="celular" maxlength="15" size="15" value="<? echo $celular ?>" class="form-control">
		            <small id="passwordHelpBlock" class="form-text text-muted">Apenas números (com DDD e sem espaços)</small>
		   </div>
	</div>
	<div class="form-row">
            <div class="form-group col-md-6">
                  <label>E-mail: </label>
		          <input type="email" required name="email" id="email" maxlength="100" size="50" value="<? echo $email ?>" class="form-control">
		          <small id="passwordHelpBlock" class="form-text text-muted">Máx. 100 caracteres</small>
		    </div>
		   <div class="form-group col-md-6">
                  <label>Profissão: </label>
		            <input type="text" required name="profissao" id="profissao" maxlength="30" value="<? echo $profissao ?>" class="form-control">
		   </div>
	</div>
	<div class="form-row">
            <div class="form-group col-md-6">
                  <label>Perfil do Facebook: </label>
		          <input type="text" name="facebook" id="facebook" maxlength="30" value="<? echo $facebook ?>" class="form-control">
		          <small id="passwordHelpBlock" class="form-text text-muted">Cadastre sem espaços</small>
		    </div>
		   <div class="form-group col-md-6">
                  <label>Perfil do Instagram: </label>
                  <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                            <input type="text" class="form-control" name="instagram" id="instagram" maxlength="15" value="@<? echo $instagram ?>">
                  </div>
                  <small id="passwordHelpBlock" class="form-text text-muted">Cadastre sem espaços</small>
            </div>
	</div>
	<br>
    <center><h5>DADOS DO ANIMAL</h5></center>
	      <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Nome: </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $nomeanimal ?></label>
                  </div>
          </div>
          <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Data de nascimento aproximada: </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $idade ?></label>
                  </div>
          </div>
          <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Sexo: </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label">
                    <?php
                		switch ($fetch[18]){
                			case 'Fêmea':
                			    echo "<div class='form-check'>
                			            <input class='form-check-input' type='radio' name='sexo' id='Macho' value='Macho'> Macho 
                			          </div>
                			          <div class='form-check'>
                			            <input class='form-check-input' type='radio' name='sexo' id='Fêmea' value='Fêmea' checked> Fêmea
                			          </div>";
                			 break;
                		case 'Macho':
                			    echo "<div class='form-check'>
                			            <input class='form-check-input' type='radio' name='sexo' id='Macho' value='Macho' checked> Macho 
                			          </div>
                			          <div class='form-check'>
                			            <input class='form-check-input' type='radio' name='sexo' id='Fêmea' value='Fêmea'> Fêmea
                			          </div>";
                			 break;
                		}
	                   ?></label>
                  </div>
          </div>
          <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Espécie: </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label">
                    <?php
                		switch ($especie){
                		    case 'Canina':
                		           echo "<div class='form-check'>
                		                    <input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina' checked> Canina 
                		                 </div>
                		                 <div class='form-check'>
                		                    <input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina'> Felina
                		                 </div>";
                		          break;
                		    case 'Felina':
                		           echo "<div class='form-check'>
                		                    <input class='form-check-input' type='radio' name='especie' id='Canina' value='Canina'> Canina 
                		                 </div>
                		                 <div class='form-check'>
                		                    <input class='form-check-input' type='radio' name='especie' id='Felina' value='Felina' checked> Felina
                		                 </div>";
                		          break;
                		}
                	?></label>
                  </div>
          </div>
          <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Cor: </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $cor ?></label>
                  </div>
          </div>
          <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Porte: </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label">
                    <?php
                        switch ($porte){
                            case 'Pequeno':
                			    echo "<div class='form-check'>
                			            <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno' checked> Pequeno 
                			          </div>
                			          <div class='form-check'>
                			            <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio'> Médio 
                			          </div>
                			          <div class='form-check'>
                			            <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande'> Grande 
                			          </div>
                			          <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='porte' id='Não se aplica' value='Não se aplica'> Gato
                                      </div>";
                                break;
                                
                		    case 'Médio':
                			    echo "<div class='form-check'>
                			            <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno'> Pequeno 
                			          </div>
                			          <div class='form-check'>
                			            <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio' checked> Médio 
                			          </div>
                			          <div class='form-check'>
                			            <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande'> Grande 
                			          </div>
                			          <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='porte' id='Não se aplica' value='Não se aplica'> Gato
                                      </div>";
                                break;
                                
                	        case 'Grande':
                			    echo "<div class='form-check'>
                			            <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno'> Pequeno 
                			          </div>
                			          <div class='form-check'>
                			            <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio'> Médio 
                			          </div>
                			          <div class='form-check'>
                			            <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande' checked> Grande 
                			          </div>
                			          <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='porte' id='Não se aplica' value='Não se aplica'> Gato
                                      </div>";
                                break;
                                
                            case 'Não se aplica':
                			    echo "<div class='form-check'>
                			            <input class='form-check-input' type='radio' name='porte' id='Pequeno' value='Pequeno'> Pequeno 
                			          </div>
                			          <div class='form-check'>
                			            <input class='form-check-input' type='radio' name='porte' id='Médio' value='Médio'> Médio 
                			          </div>
                			          <div class='form-check'>
                			            <input class='form-check-input' type='radio' name='porte' id='Grande' value='Grande'> Grande 
                			          </div>
                			          <div class='form-check'>
                                        <input class='form-check-input' type='radio' name='porte' id='Não se aplica' value='Não se aplica' checked> Gato
                                      </div>";
                                break;
                		}
                	?></label>
                  </div>
          </div>
        <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Castrado? </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label">
                    <?php
                		switch ($fetch[21]){
                		    case 'Sim':
                		           echo "<div class='form-check'>
                		                    <input class='form-check-input' type='radio' name='castracao' id='Castrado' value='Castrado' checked> Sim 
                		                   </div>
                		                   <div class='form-check'>
                		                    <input class='form-check-input' type='radio' name='castracao' id='Não castrado' value='Não castrado'> Não 
                		                   </div>";
                		            break;
                		                    
                		     case 'Não':
                		           echo "<div class='form-check'>
                		                    <input class='form-check-input' type='radio' name='castracao' id='Castrado' value='Castrado'> Sim 
                		                   </div>
                		                   <div class='form-check'>
                		                    <input class='form-check-input' type='radio' name='castracao' id='Não castrado' value='Não castrado' checked> Não 
                		                   </div>";
                		            break;
                		                    
                		}
                	
                	?>
                </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Data da castração: </label> 
                  <div class="col-sm-7">
		            <input type="date" name="dtcastracao" id="dtcastracao" value="<? echo $dtcastracao ?>" class="form-control">
		          </div>
		</div>
        <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Vermifugado? </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label">
                    <?php
                    		switch ($fetch[23]){
                    		    case 'Sim':
                    		        echo "<div class='form-check'>
                    		                <input class='form-check-input' type='radio' name='vermifug' id='vermifug' value='Sim' checked> Sim 
                    		              </div>
                    		              <div class='form-check'>
                    		                <input class='form-check-input' type='radio' name='vermifug' id='vermifug' value='Não'> Não
                    		              </div>";
                    		        break;
                    		     case 'Não':
                    		        echo "<div class='form-check'>
                    		                <input class='form-check-input' type='radio' name='vermifug' id='vermifug' value='Sim'> Sim 
                    		              </div>
                    		              <div class='form-check'>
                    		                <input class='form-check-input' type='radio' name='vermifug' id='vermifug' value='Não' checked> Não
                    		              </div>";
                    		        break;
                    		}
                    ?>	
                </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Vacinado? </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label">
                    <?php
                    		switch ($fetch[24]){
                    		    case 'Sim':
                    		       echo "<div class='form-check'>
                    		                <input class='form-check-input' type='radio' name='vacinacao' id='Vacinado' value='Sim' checked> Sim 
                    		             </div>
                    		             <div class='form-check'>
                    		                <input class='form-check-input' type='radio' name='vacinacao' id='Não vacinado' value='Não'> Não
                    		          </div>";
                    		       break;
                    	        case 'Não':
                    		       echo "<div class='form-check'>
                    		                <input class='form-check-input' type='radio' name='vacinacao' id='Vacinado' value='Sim' > Sim 
                    		             </div>
                    		             <div class='form-check'>
                    		                <input class='form-check-input' type='radio' name='vacinacao' id='Não vacinado' value='Não' checked> Não
                    		          </div>";
                    		       break;
                    		}
                    ?>		
                </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Doses: </label> 
                  <div class="col-sm-7">
		            <select name="doses"  class="form-control">
		              <option name="dosebanco" value="<? echo $doses ?>" selected><? echo $doses ?></option>
		              <option name="---" value="---">------------</option>
                      <option name="dose1" value="1">1</option>
                      <option name="dose2" value="2">2</option>
                      <option name="dose3" value="3">3</option>
                    </select>
		          </div>
		</div>
       <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Possui outros animais em casa? </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label">
                    <?
                        switch ($fetch[26]){
                            case 'Sim':
                                echo "<div class='form-check'>
                                        <input class='form-check-input' name='possuianimal' type='radio' value='Sim' checked>Sim &nbsp;
                                      </div>
                                      <div class='form-check'>
                                        <input class='form-check-input' name='possuianimal' type='radio' value='Não'>Não &nbsp;
                                      </div>";
                                break;
                            case 'Não':
                                echo "<div class='form-check'>
                                        <input class='form-check-input' name='possuianimal' type='radio' value='Sim'>Sim &nbsp;
                                      </div>
                                      <div class='form-check'>
                                        <input class='form-check-input' name='possuianimal' type='radio' value='Não' checked>Não &nbsp;
                                      </div>";
                                break;
                        }
                            
                    ?>	
                </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Se sim, estão castrados? </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label">
                    <?
                        switch ($fetch[27]){
                            case 'Sim':
                                echo "<div class='form-check'>
                                        <input class='form-check-input' name='sesimcastrados' type='radio' value='Sim' checked>Sim &nbsp;
                                      </div>
                                      <div class='form-check'>
                                        <input class='form-check-input' name='sesimcastrados' type='radio' value='Não'>Não &nbsp; 
                                      </div>";
                                break;
                            case 'Não':
                                echo "<div class='form-check'>
                                        <input class='form-check-input' name='sesimcastrados' type='radio' value='Sim'>Sim &nbsp;
                                      </div>
                                      <div class='form-check'>
                                        <input class='form-check-input' name='sesimcastrados' type='radio' value='Não' checked>Não &nbsp;
                                      </div>";
                                break;
                        }
                            
                    ?>
                </div>
        </div>
        <br>
        <center><h5>DADOS DO DOADOR/RESPONSÁVEL</h5></center>
	      <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Lar temporário de: </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $lt ?></label>
                  </div>
          </div>
          <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Termo preenchido por: </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? echo $termopor ?></label>
                  </div>
          </div>
          <div class="form-group row">
                  <label class="col-sm-5 col-form-label">E-mail do doador/responsável: </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? if ($emaildoador == ''){ echo "Não possui"; }else{ echo $emaildoador;} ?></label>
                  </div>
          </div>
          <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Telefone do doador/responsável: </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label"><? if ($teldoador == ''){ echo "Não possui"; }else{ echo $teldoador;} ?></label>
                  </div>
          </div>
          <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Data da adoção: </label> 
                  <div class="col-sm-7">
                    <input class="form-control" type="date" name="dtadocao" id ="dtadocao" value="<? echo $dtadocao ?>">
                  </div>
          </div>
          <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Local da adoção: </label> 
                  <div class="col-sm-7">
                    <select name="localadocao"  class="form-control">
                          <option name="banco" value="<? echo $localadocao ?>" selected><? echo $localadocao ?></option>
                          <option name="banco" value="">----------------------------</option>
                          <option name="petcampbarao" value="Petcamp Barão Geraldo">Petcamp Barão Geraldo</option>
                          <option name="petcampjasmim" value="Petcamp Jasmim">Petcamp Jasmim</option>
                          <option name="petland" value="Petland">Petland</option>
                          <option name="leroy" value="Leroy M Dom Pedro">Leroy Merlin Dom Pedro</option>
                          <option name="forafeira" value="Fora da feira">Fora da feira</option>
                          <option name="petmarginal" value="Pet Center Marginal">Pet Center Marginal</option>
                          <option name="petz" value="Petz">Petz</option>
                    </select>
                  </div>
          </div>
          <fieldset class="form-group">
                                <div class="row">
                                  <legend class="col-form-label col-sm-5 pt-0">Forma de pagamento da taxa: </legend>
          <?
            switch($formapgto){
                case 'Dinheiro':
                    echo "<div class='col-sm-7'>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Dinheiro' checked><label class='form-check-label'>Dinheiro </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Débito'><label class='form-check-label'>Cartão - débito </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Crédito'><label class='form-check-label'>Cartão - crédito </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Transferência'><label class='form-check-label'>DOC ou TED </label>
                                    </div>
                                   </div>
                                </div>";
                    break;
                case 'Débito':
                    echo "<div class='col-sm-7'>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Dinheiro' ><label class='form-check-label'>Dinheiro </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Débito' checked><label class='form-check-label'>Cartão - débito </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Crédito'><label class='form-check-label'>Cartão - crédito </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Transferência'><label class='form-check-label'>DOC ou TED </label>
                                    </div>
                                   </div>
                                </div>";
                    break;
                case 'Crédito':
                    echo "<div class='col-sm-7'>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Dinheiro' ><label class='form-check-label'>Dinheiro </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Débito'><label class='form-check-label'>Cartão - débito </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Crédito' checked><label class='form-check-label'>Cartão - crédito </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Transferência'><label class='form-check-label'>DOC ou TED </label>
                                    </div>
                                   </div>
                                </div>";
                    break;
                case 'Transferência':
                    echo "<div class='col-sm-7'>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Dinheiro' ><label class='form-check-label'>Dinheiro </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Débito'><label class='form-check-label'>Cartão - débito </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Crédito' ><label class='form-check-label'>Cartão - crédito </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Transferência' checked><label class='form-check-label'>DOC ou TED </label>
                                    </div>
                                   </div>
                                </div>";
                    break;
                default:
                    echo "<div class='col-sm-7'>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Dinheiro' ><label class='form-check-label'>Dinheiro </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Débito'><label class='form-check-label'>Cartão - débito </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Crédito' ><label class='form-check-label'>Cartão - crédito </label>
                                    </div>
                                    <div class='form-check'>
                                      <input class='form-check-input' type='radio' name='pgtotaxa' id='pgtotaxa' value='Transferência'><label class='form-check-label'>DOC ou TED </label>
                                    </div>
                                   </div>
                                </div>";
                    break;
            }
          ?>
            </div>
          </fieldset>
          <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-5 pt-0">Deseja atualizar a foto do termo? </legend>
                      <div class="col-sm-7">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="updatefoto" id="updatefoto" value="Sim" onclick="OnChangeRadio (this)"><label class="form-check-label">Sim </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="updatefoto" id="updatefoto" value="Não" onclick="OnChangeRadio2 (this)"><label class="form-check-label">Não</label>
                        </div>
                       </div>
                    </div>
    </fieldset>
          <div id="divfoto" class="form-row d-none">
           <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" name="foto">
                    <label class="custom-file-label" for="validatedCustomFile">Escolher arquivo (nome do arquivo sem espaço)</label>
                </div> 
          </div>
    <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-5 pt-0">Deseja atualizar a foto dos adotantes? </legend>
                      <div class="col-sm-07">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="updatefotoad" id="updatefotoad" value="Sim" onclick="OnChangeRadio5 (this)"><label class="form-check-label">Sim </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="updatefotoad" id="updatefotoad" value="Não" onclick="OnChangeRadio6 (this)"><label class="form-check-label">Não</label>
                        </div>
                       </div>
                    </div>
    </fieldset>
      <div id="divfotoad" class="form-row d-none">
       <div class="custom-file">
                <input type="file" class="custom-file-input" id="validatedCustomFile" name="fotoad">
                <label class="custom-file-label" for="validatedCustomFile">Escolher arquivo</label>
            </div> 
      </div>
    <br>
    <center><h5>DADOS DO PÓS ADOÇÃO</h5></center>
	      <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Realizado em: </label> 
                  <div class="col-sm-7">
                    <input class="form-control" type="date" name="dtposadocao" id ="dtposadocao" value="<? echo $dtposadocao ?>">
                  </div>
          </div>
          <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Realizado por: </label> 
                  <div class="col-sm-7">
                      <? if ($usuario == ''){
                          $usuario = $_SESSION['login'];
                          echo "<input class='form-control' type='text' name='pospor' id ='pospor' value='".$usuario."' >";
                      } else {
                          echo "<input class='form-control' type='text' name='pospor' id ='pospor' value='".$usuario."' >";
                      }
                      ?>
                  </div>
          </div>
          <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Status: </label> 
                  <div class="col-sm-7">
                    <label class="col-sm-7 col-form-label">
                    <?php
                        switch ($fetch[37]) {
                            case 'Não realizado': 
                                echo "<div class='form-check'>
                                        <input class='form-check-input' type='radio'name='statusposadocao' value='Não realizado' checked>Não realizado &nbsp; <br>
                                      </div>
                                      <div class='form-check'>
                                        <input class='form-check-input' type='radio'name='statusposadocao' value='Pós adoção ok'>Pós adoção OK &nbsp;
                                      </div>
                                      <div class='form-check'>
                                        <input class='form-check-input' type='radio'name='statusposadocao' value='Devolvido'>Devolvido &nbsp;
                                      </div>
                                      <div class='form-check'>
                                        <input class='form-check-input' type='radio'name='statusposadocao' value='Óbito'>Óbito &nbsp;
                                      </div>
                                      <div class='form-check'>
                                        <input class='form-check-input' type='radio'name='statusposadocao' value='Readotado'>Readotado &nbsp;
                                      </div>
                                      <div class='form-check'>
                                        <input class='form-check-input' type='radio'name='statusposadocao' value='Contato não retornado'>Contato não retornado<br>
                                      </div>
                                      <div class='form-check'>
                                        <input class='form-check-input' type='radio'name='statusposadocao' value='Envio de e-mail automático'>Envio de e-mail automático<br>
                                      </div>";
                                break;
                                
                        case 'Pós adoção ok':
                            echo "<div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Não realizado'>Não realizado &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Pós adoção ok' checked>Pós adoção OK &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Devolvido'>Devolvido &nbsp;<br>
                                  </div>
                                  <div class='form-check'>    
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Óbito'>Óbito &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Readotado'>Readotado &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Contato não retornado'>Contato não retornado <br>
                                  </div>
                                  <div class='form-check'>
                                        <input class='form-check-input' type='radio'name='statusposadocao' value='Envio de e-mail automático'>Envio de e-mail automático<br>
                                      </div>";
                            break;
                            
                        case 'Devolvido':
                            echo "<div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Não realizado'>Não realizado &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Pós adoção ok'>Pós adoção OK &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Devolvido' checked>Devolvido &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Óbito'>Óbito &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Readotado'>Readotado &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Contato não retornado'>Contato não retornado <br>
                                  </div>
                                  <div class='form-check'>
                                        <input class='form-check-input' type='radio'name='statusposadocao' value='Envio de e-mail automático'>Envio de e-mail automático<br>
                                      </div>";
                            break;
                            
                        case 'Óbito':
                            echo "<div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Não realizado'>Não realizado &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Pós adoção ok'>Pós adoção OK &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Devolvido'>Devolvido &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Óbito' checked>Óbito &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Readotado'>Readotado &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Contato não retornado'>Contato não retornado <br>
                                  </div>
                                  <div class='form-check'>
                                        <input class='form-check-input' type='radio'name='statusposadocao' value='Envio de e-mail automático'>Envio de e-mail automático<br>
                                      </div>";
                            break;
                            
                        case 'Contato não retornado':
                            echo "<div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Não realizado'>Não realizado &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Pós adoção ok'>Pós adoção OK &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Devolvido'>Devolvido &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Óbito'>Óbito &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Readotado'>Readotado &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio'name='statusposadocao' value='Contato não retornado' checked>Contato não retornado <br>
                                  </div>
                                  <div class='form-check'>
                                        <input class='form-check-input' type='radio'name='statusposadocao' value='Envio de e-mail automático'>Envio de e-mail automático<br>
                                      </div>";
                            break;
                            
                        default:
                            echo "<div class='form-check'>
                                    <input class='form-check-input' type='radio' name='statusposadocao' value='Não realizado'>Não realizado &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='statusposadocao' value='Pós adoção ok'>Pós adoção OK &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='statusposadocao' value='Devolvido'>Devolvido &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='statusposadocao' value='Óbito'>Óbito &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='statusposadocao' value='Readotado'>Readotado &nbsp;<br>
                                  </div>
                                  <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='statusposadocao' value='Contato não retornado'>Contato não retornado <br>
                                  </div>
                                  <div class='form-check'>
                                        <input class='form-check-input' type='radio'name='statusposadocao' value='Envio de e-mail automático' checked>Envio de e-mail automático<br>
                                      </div>";
                            break;
                        }
                    ?>
                </div>
        </div>
        <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Observações: </label> 
                  <div class="col-sm-7">
                    <textarea name="obs" rows="10" cols="50" maxlength="2000" class="form-control"><? echo $obs?></textarea>
                  </div>
          </div>
          <br>
          <input type="text" nmae="nome_fotoori" id="nome_fotoori" value="<? echo $nome_fotoori?>" hidden>
          <input type="text" nmae="nome_fotoadori" id="nome_fotoadori" value="<? echo $nome_fotoadori?>" hidden>
        <center><a href="javascript:form.submit()" class="btn btn-primary">Atualizar</a></center>
	  </form>
	  <br>
   </div>
   <? mysqli_close($connect); ?>
   <center><a href="pesquisatermo.php" class="btn btn-primary"> Voltar</a></center> <br>
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
