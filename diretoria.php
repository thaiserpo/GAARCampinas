<?php 

$lifetime=6000;
session_set_cookie_params($lifetime);

session_start();

include ("conexao.php"); 
//include ("conexao_lojinha.php");

$login = $_SESSION['login'];

$tmpsession = session_set_cookie_params($lifetime);
$dia_iniciopost = date('Y-m-d', strtotime('next monday'));
$dia_iniciopost_semana = date('Y-m-d', strtotime('monday this week'));
$dia_fimpost = date('Y-m-d', strtotime($dia_iniciopost. ' + 6 days'));
$dia_fimpost_semana = date('Y-m-d', strtotime('sunday this week'));

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");
$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA, NOME FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$nome = $fetcharea[1];
		}
		
		$log_file_msg .="[diretoria.php] Acesso à página diretoria feito com sucesso às ".$horaatu."\n";
        $fp = fopen($log_file, 'a');//opens file in append mode  
        fwrite($fp, $log_file_msg);

?>
<!doctype html>
<html lang="pt-br">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Meta tags Obrigatórias -->
    
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS only -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">-->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">-->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>GAAR - Área do voluntário</title>
    
    <script type="text/javascript">
        function ajaxLoader(id,url,param){
            var mreq;
            // Procura o componente nativo do Mozilla/Safari para rodar o AJAX 
            if(window.XMLHttpRequest){
                // Inicializa o Componente XMLHTTP do Mozilla
                mreq = new XMLHttpRequest();
            // Caso ele não encontre, procura por uma versão ActiveX do IE 
            }else if(window.ActiveXObject){ 
                // Inicializa o Componente ActiveX para o AJAX
                mreq = new ActiveXObject("Microsoft.XMLHTTP");
            }else{ 
                // Caso não consiga inicializar nenhum dos componentes, exibe um erro
                alert("Seu navegador não tem suporte a AJAX.");
            }
            // Carrega a função de execução do AJAX
            mreq.onreadystatechange = function() {
                if(mreq.readyState == 1){
                    // Quando estiver "Carregando a página", exibe a mensagem
                    document.getElementById(id).innerHTML = 'Carregando';           
                }else if(mreq.readyState == 4){ 
                    // Quando estiver completado o Carregamento
                    // Procura pela DIV e insere as  informações 
                    document.getElementById(id).innerHTML = mreq.responseText;
                }
            };
            // Envia via método POST as informações
            mreq.open("POST",url,true);
               mreq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1") 
            mreq.send(param);
        }
    </script>
    <!--- GOOGLE ADSENSE --->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5848149407283988"
            crossorigin="anonymous"></script> <br>
    <!--- GOOGLE ADSENSE --->
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
    <p><h3><center>Olá <? echo $nome?>! Seja bem vindo a área restrita do GAAR! </center></h3></p>
    <? /*ajaxLoader('carrega','pagina.php');*/ ?>
        <div id="carrega"></div>
        <div id="divpretermos" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMOS PRÉ TERMOS CADASTRADOS</h4><br>
                    	<?

                    	    $query = "SELECT * FROM FORM_PRE_ADOCAO ORDER BY ID DESC LIMIT 5";
                    		$result = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($result);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Nome</th>";
                            	echo "<th scope='col'>Espécie</th>";
                            	echo "<th scope='col'>Responsável</th>";
                            	echo "<th scope='col'>Interessado</th>";
                            	echo "<th scope='col'>Recebido em</th>";
                            	echo "<th scope='col'>Status</th>";
                            	echo "<th scope='col'>&nbsp;</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $nomeanimal = $fetch[11];
                    				$especie = $fetch[12];
                    				$adotante = $fetch[1];
                    				$resp = $fetch[68];
                    				$recebidoem = $fetch[66];
                    				$obs = $fetch[64];
                    				
                    				if ($obs =='') {
                    				    $obs = "Não respondido";
                    				}
                    				
                    				$ano_recebidoem = substr($recebidoem,0,4);
                        		    $mes_recebidoem = substr($recebidoem,5,2);
                        		    $dia_recebidoem = substr($recebidoem,8,2);
                    				
                        			echo "<tr>";
                        			echo "<td>".$nomeanimal."</td>";
                					echo "<td>".$especie."</td>";
                					echo "<td>".$resp."</td>";
                					echo "<td>".$adotante."</td>";
                					echo "<td>".$dia_recebidoem."/".$mes_recebidoem."/".$ano_recebidoem."</td>";
                					echo "<td>".$obs."</td>";
                					echo "<td><a href='visualizapretermo.php?idpretermo=".$fetch[0]."'><button type='button' class='btn btn-primary' title='Visualizar'>
        					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                </svg>
                                            </button></a></td>";
                				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum animal encontrado</p><br>";
                    		}
                    	?>
                    	<p> Para visualizar todos os pré termos recebidos, <a href="pesquisapretermo.php">clique aqui</a></p>
                    	</center>
        </div>
        <div id="divvagaslt" class="d-none">
                    	<center>
                               <br><h4>VAGAS DISPONÍVEIS EM LARES TEMPORÁRIOS ATIVOS</h4><br>
                               <p>A atualização da quantidade de vagas disponíveis é feita automaticamente cada 1 hora.</p>
                    	<?

                    	    $query = "SELECT * FROM LT WHERE ATIVO='SIM' ORDER BY LAR_TEMPORARIO ASC ";
                    		$result = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($result);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Lar temporário</th>";
                            	echo "<th scope='col'>Espécie</th>";
                            	echo "<th scope='col'>Limites de vagas</th>";
                            	echo "<th scope='col'>Qtd de animais</th>";
                            	echo "<th scope='col'>Vagas disponíveis</th>";
                            	echo "<th scope='col'></th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $lt = $fetch[1];
                    				$especies = $fetch[8];
                    				$qtde_vagas = $fetch[19];
                    				$caes = $fetch[9];
                    				$gatos = $fetch[10];
                    				$animais_lt = intval($caes) + intval($gatos);
                    				$vagas_disp = $fetch[20];
                            			echo "<tr>";
                            			echo "<td>".$lt."</td>";
                    					echo "<td>".$especies."</td>";
                    					echo "<td>".$qtde_vagas."</td>";
                    					echo "<td>".$animais_lt."</td>";
                    					echo "<td>".$vagas_disp."</td>";
                    					if ($animais_lt == '0'){
                    					    echo "<td><a href='animaislts.php?lt=".$lt."'><button type='button' class='btn btn-primary' disabled title='Visualizar'>
                					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                          <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                          <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                        </svg>
                                                    </button></a></td>";
                    					} else {
                    					    echo "<td><a href='animaislts.php?lt=".$lt."'><button type='button' class='btn btn-primary' title='Visualizar'>
                					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                          <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                          <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                        </svg>
                                                    </button></a></td>";
                    					}
                    				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum lar temporário encontrado</p><br>";
                    		}
                    	?>
                    	<p> Para visualizar todos os termos cadastrados, <a href="pesquisatermo.php">clique aqui</a></p>
                    	</center>
        </div>
        <div id="divpedidos" class="d-none">
                    	<center>
                               <br><h4>ÚLTIMOS PEDIDOS</h4><br>
                    	<?

                    	    $querystatus = "SELECT * FROM VENDAS_PRODUTOS ORDER BY ID DESC LIMIT 10 ";
                    		$resultstatus = mysqli_query($connect,$querystatus);
                    		$reccountstatus = mysqli_num_rows($resultstatus);

                            echo "<table class='table'>
                                    <thead class='thead-light'>
                        						  <tr>
                        						    <th scope='col' colspan='1'>Pedido #</th>
                        							<th scope='col' colspan='1'>Data</th>
                        							<th scope='col' colspan='1'>Cliente</th>
                            			            <th scope='col' colspan='2'>Status</th>
                        					  
                        					      </tr>
                        				</thead>
                        				<tbody>";
                            
                            while ($fetchstatus = mysqli_fetch_row($resultstatus) ) {
                                
                                $order_id = $fetchstatus[0];
                                $date_created = $fetchstatus[8];
                        	    $status = $fetchstatus[11];
                        	    $customer_id = $fetchstatus[1];
                        

                        	    echo "<tr>";
                        					echo "<td>".$order_id."</td>";
                                			echo "<td>".$date_created."</td>";
                        					echo "<td>".$customer_id."</td>";
                        				    echo "<td>".$status."</td>";
                        				    echo "<td><a href='verpedido.php?idpedido=".$order_id."'><button type='button' class='btn btn-primary' title='Visualizar'>
                					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                          <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                          <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                        </svg>
                                                    </button></a></td>";
                        		echo "</tr>";
                                
                                }
                                

                        	   echo " </tbody>
                        	         </table>
                        	         
                        	         <br>
                        	         <center>".$reccountstatus." pedidos encontrados </center>
                        	         
                        	         <br><br>";
                        	
                            mysqli_close($connectloja);
                    	?>
                    	<p> Para visualizar todos os pedidos, <a href="listapedidos.php">clique aqui</a></p>
                    	</center>
        </div>
        <div id="divanimaisgaar" class="d-block">
                <center>
                               <br><h4>ÚLTIMOS ANIMAIS DO GAAR CADASTRADOS</h4><br>
                               <p> Serão exibidos os últimos 10 cadastros.</p>
                    	<?

                    	    $query = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO <> 'Terceiros' AND DIVULGAR_COMO <> 'Esperando aprovação' ORDER BY ID DESC LIMIT 10";
                    		$result = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($result);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Nome</th>";
                            	echo "<th scope='col'>Espécie</th>";
                            	echo "<th scope='col'>Responsável</th>";
                            	echo "<th scope='col'>LT</th>";
                            	echo "<th scope='col'>Status</th>";
                            	echo "<th scope='col'>Cadastrado em</th>";
                            	echo "<th scope='col'>Disponível em</th>";
                            	echo "<th scope='col'></th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $id = $fetch[0];
                    	            $nome = $fetch[1];
                    				$especie = $fetch[2];
                    				$resp = $fetch[12];
                    				$lt = $fetch[11];
                    				$divulgarcomo = $fetch[10];
                    				$datareg = $fetch[19];
                    				$dispem = $fetch[40];
                    				
                    				$ano_datareg = substr($datareg,0,4);
                        		    $mes_datareg = substr($datareg,5,2);
                        		    $dia_datareg = substr($datareg,8,2);
                        		    
                        		    $ano_dispsem = substr($dispem,0,4);
                        		    $mes_dispsem = substr($dispem,5,2);
                        		    $dia_dispsem = substr($dispem,8,2);
                    				
                    				if ($divulgarcomo == 'GAAR'){
                    				    $divulgarcomo = 'Disponível';
                    				}
                            			echo "<tr>";
                            			echo "<td>".$nome."</td>";
                    					echo "<td>".$especie."</td>";
                    					echo "<td>".$resp."</td>";
                    					echo "<td>".$lt."</td>";
                    					echo "<td>".$divulgarcomo."</td>";
                    					echo "<td>".$dia_datareg."/".$mes_datareg."/".$ano_datareg."</td>";
                    					echo "<td>".$dia_dispsem."/".$mes_dispsem."/".$ano_dispsem."</td>";
                    					echo "<td><a href='http://www.gaarcampinas.org/pet.php?id=".$fetch[0]."' target='_blank'><button type='button' class='btn btn-primary' title='Visualizar'>
                					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                          <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                          <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                        </svg>
                                                    </button></a></td>";
                    				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum animal encontrado</p><br>";
                    		}
                    	?>
                    	<p> Para visualizar todos os animais cadastrados, <a href="formpesquisapetinterna.php">clique aqui</a></p>
                    	</center>
                </div>
        <div id="divgradesemana" class="d-block"><br>
            <center><h4>POSTS DA SEMANA ATUAL</h4>
            <p> <a href="https://gaarcampinas.org/area/envioemailredacao.php" target="_blank">Criar e-mail para grupo de redação</a></p></center>
            <?
                $query = "SELECT * FROM ANIMAIS_REDES WHERE DIA_POST >= '".$dia_iniciopost_semana."' AND DIA_POST <= '".$dia_fimpost_semana."' ORDER BY DIA_POST ASC";
                $select = mysqli_query($connect,$query);
                $reccount = mysqli_num_rows($select);
                
                echo "<table class='table'>";
                echo "<thead class='thead-light'>";
            	echo "<th scope='col'>ID</th>";
            	echo "<th scope='col'>Nome</th>";
            	echo "<th scope='col'>Espécie</th>";
            	echo "<th scope='col' colspan='1'>Data do post</th>";
            	echo "<th scope='col' colspan='3'>Último post</th>";
            	echo "</thead>";
            	echo "<tbody>";
                
                while ($fetch = mysqli_fetch_row($select)) {
                
                    $idanimal = $fetch[1];
                    $data_post_semana = $fetch[2];
                    $hora_post_semana = $fetch[3];
                    $ultimo_post = $fetch[5];
                    $dayofweek = date('w', strtotime($data_post));
                    
                    $querypet_redes = "SELECT NOME_ANIMAL,ESPECIE FROM ANIMAL WHERE ID='$idanimal'";
                	$selectpet_redes = mysqli_query($connect,$querypet_redes);
                	$rc = mysqli_fetch_row($selectpet_redes);
    			    $nomeanimal = $rc[0];
    			    $especie = $rc[1];
    			    
    			    $ano_datapost_semana = substr($data_post_semana,0,4);
        		    $mes_datapost_semana = substr($data_post_semana,5,2);
        		    $dia_datapost_semana = substr($data_post_semana,8,2);
        		    
        		    $ano_ultimopost = substr($ultimo_post,0,4);
        		    $mes_ultimopost = substr($ultimo_post,5,2);
        		    $dia_ultimopost = substr($ultimo_post,8,2);
                
                    echo "<tr>";
        			echo "<td><a href='http://gaarcampinas.org/pet.php?id=".$idanimal."' target='_blank'>".$idanimal."</a></td>";
        			echo "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$idanimal."' target='_blank'>".$nomeanimal."</a></td>";
        			echo "<td>".$especie."</td>";
    				echo "<td>".$dia_datapost_semana."/".$mes_datapost_semana."/".$ano_datapost_semana."</td>";
    				//echo "<td>".$hora_post_semana."</td>";
    				echo "<td>".$dia_ultimopost."/".$mes_ultimopost."/".$ano_ultimopost."</td>";
    				echo "<td><a href='http://gaarcampinas.org/area/criatexto.php?idpet=".$idanimal."' target='_blank'>Criar texto</a></td>";
    				echo "<td><a href='http://gaarcampinas.org/area/deletapet_redes.php?idpet=".$idanimal."' target='_blank'>Deletar</a></td>";
    			    echo "</tr>"; 
    			}   
    			        echo "</tbody>";
    			        echo "</table><br>";
            ?>
    
        </div>
        <div id="divanimaisterceiros" class="d-none">
                <center>
                               <br><h4>ÚLTIMOS ANIMAIS DE TERCEIROS CADASTRADOS</h4><br>
                               <p> Serão exibidos os últimos 5 cadastros.</p>
                    	<?

                    	    $query = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO = 'Terceiros' OR DIVULGAR_COMO = 'Esperando aprovação' ORDER BY ID DESC LIMIT 5";
                    		$result = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($result);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Nome</th>";
                            	echo "<th scope='col'>Espécie</th>";
                            	echo "<th scope='col'>Responsável</th>";
                            	echo "<th scope='col'>LT</th>";
                            	echo "<th scope='col'></th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $id = $fetch[0];
                    	            $nome = $fetch[1];
                    				$especie = $fetch[2];
                    				$resp = $fetch[12];
                    				$lt = $fetch[11];
                            			echo "<tr>";
                            			echo "<td>".$nome."</td>";
                    					echo "<td>".$especie."</td>";
                    					echo "<td>".$resp."</td>";
                    					echo "<td>".$lt."</td>";
                    					echo "<td><a href='http://www.gaarcampinas.org/pet.php?id=".$fetch[0]."' target='_blank'><button type='button' class='btn btn-primary' title='Visualizar'>
                					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                          <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                          <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                        </svg>
                                                    </button></a></td>";
                    				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum animal encontrado</p><br>";
                    		}
                    	?>
                    	<p> Para visualizar todos os animais cadastrados, <a href="formpesquisapetinterna.php">clique aqui</a></p>
                    	</center>
                </div>
        <div id="divtermos" class="d-block">
                    	<center>
                               <br><h4>ÚLTIMOS TERMOS CADASTRADOS</h4><br>
                    	<?

                    	    $query = "SELECT * FROM TERMO_ADOCAO ORDER BY ID DESC LIMIT 5";
                    		$result = mysqli_query($connect,$query);
                    		$reccount = mysqli_num_rows($result);
                    		
                    		if ($reccount != '0'){
                    		    echo "<table class='table'>";
                                echo "<thead class='thead-light'>";
                            	echo "<th scope='col'>Nome</th>";
                            	echo "<th scope='col'>Espécie</th>";
                            	echo "<th scope='col'>Adotante</th>";
                            	echo "<th scope='col' colspan='2'>Data da adoção</th>";
                            	echo "</thead>";
                            	echo "<tbody>";
                    	        while ($fetch = mysqli_fetch_row($result)) {
                    	            $nomeanimal = $fetch[15];
                    				$especie = $fetch[16];
                    				$adotante = $fetch[1];
                    				$dtadocao = $fetch[32];
                    				
                    				$ano_adocao = substr($dtadocao,0,4);
                        		    $mes_adocao = substr($dtadocao,5,2);
                        		    $dia_adocao = substr($dtadocao,8,2);

                        			echo "<tr>";
                        			echo "<td>".$nomeanimal."</td>";
                					echo "<td>".$especie."</td>";
                					echo "<td>".$adotante."</td>";
                					echo "<td>".$dia_adocao."/".$mes_adocao."/".$ano_adocao."</td>";
                					echo "<td><a href='formvisualizatermo.php?idtermo=".$fetch[0]."' target='_blank'><button type='button' class='btn btn-primary' title='Visualizar'>
                					                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                                          <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                                          <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                                        </svg>
                                                    </button></a></td>";
                				    echo "</tr>";
                    			}   
                    			        echo "</tbody>";
                    			        echo "</table><br>";
                    			} 
                    			else {
                    		        echo "<center><p>Nenhum animal encontrado</p><br>";
                    		}
                    	?>
                    	<p> Para visualizar todos os termos cadastrados, <a href="pesquisatermo.php">clique aqui</a></p>
                    	</center>
        </div>
    <br /><br />
    </div>
</main>
<br>
<footer class="footer fixed-bottom bg-light d-sm-none">
      <div class="container">
        <p class="text-center">GAAR - GRUPO DE APOIO AO ANIMAL DE RUA </p>
      </div>
    </footer>
<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>-->

<!--- BOOTSTRAP --->

<?
fclose($fp); 
mysqli_close($connect);
?>
</body>
</html>