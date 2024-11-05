<?php 

session_start();

include ("conexao.php");

$user_agent = $_SERVER['HTTP_USER_AGENT'];

/*if (strpos($userAgent, 'Firefox') !== false) {
    $user_agent = "Firefox";
} elseif (strpos($userAgent, 'Chrome') !== false) {
    $user_agent = "Chrome";
} elseif (strpos($userAgent, 'Safari') !== false) {
    $user_agent = "Safari";
} elseif (strpos($userAgent, 'Edge') !== false) {
    $user_agent = "Edge";
} else {
    $user_agent = "Navegador não identificado";
}*/

$data_atu = date("Y-m-d");
$horaatu = date("H:i:s");
$ano_atu = date("Y");
$mes_atu = date("m");

$log_file = "/home/gaarca06/public_html/area/logs/".$ano_atu.$mes_atu."/log-".$data_atu.".txt";

$fp = fopen($log_file, 'a');//opens file in write mode  

$log_file_msg .="[login.php] Conexão com o banco de dados feita com sucesso às ".$horaatu."\n";
$fp = fopen($log_file, 'a');//opens file in append mode  
fwrite($fp, $log_file_msg);  

$_SESSION['login'] = $_POST['login'];
$login = $_SESSION['login'];
$entrar = $_POST['entrar'];
$senha = md5($_POST['senha']);
$ultimo_acesso = date("Y-m-d");

$queryarea = "SELECT * FROM VOLUNTARIOS WHERE USUARIO ='$login'";
$selectarea = mysqli_query($connect,$queryarea);

if(mysqli_errno($connect) == '0'){
    
    while ($fetcharea = mysqli_fetch_row($selectarea)) {
		$usuariobd =  $fetcharea[0];
		$senhabd =  $fetcharea[1];
		$area = $fetcharea[5];
		$subarea = $fetcharea[6];
		$resp = $fetcharea[2];
		$celular = $fetcharea[3];
		$email = $fetcharea[4];
		$cpfcnpj =  $fetcharea[9];
		$rg =  $fetcharea[11];
		$dtnasc =  $fetcharea[13];
		$nacionalidade =  $fetcharea[14];
		$estadocivil =  $fetcharea[15];
		$profissao =  $fetcharea[16];
		$cep =  $fetcharea[17];
		$endereco =  $fetcharea[18];
		$complemento =  $fetcharea[19];
		$numero =  $fetcharea[20];
		$bairro =  $fetcharea[21];
		$cidade =  $fetcharea[22];
		$estado =  $fetcharea[23];
		$status = $fetcharea[25];
    }
    
    if ($usuariobd != $login || $senhabd != $senha){
            echo"<script language='javascript' type='text/javascript'>
            alert('Login e/ou senha incorretos');window.location.href='login.html';</script>";
            die();
          } 
    else{
            if ($celular == ''){
                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                    echo "<p>Para prosseguir é necessário a atualização dos seus dados cadastrais.</p><br>";
                    echo "<p>Preencha o seu celular</p><br>";
                    echo "<a href='http://gaarcampinas.org/area/cadastro_voluntario.php?login=".$login."&atualiza=sim' class='btn btn-primary'>Atualizar cadastro</a></center><br>";
            } else {
                if ($email == ''){
                    echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                    echo "<p>Para prosseguir é necessário a atualização dos seus dados cadastrais.</p><br>";
                    echo "<p>Preencha o seu e-mail</p><br>";
                    echo "<a href='http://gaarcampinas.org/area/cadastro_voluntario.php?login=".$login."&atualiza=sim' class='btn btn-primary'>Atualizar cadastro</a></center><br>";
                }
                else {
                    if ($cpfcnpj == ''){
                        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                        echo "<p>Para prosseguir é necessário a atualização dos seus dados cadastrais.</p><br>";
                        echo "<p>Preencha o seu CPF</p><br>";
                        echo "<a href='http://gaarcampinas.org/area/cadastro_voluntario.php?login=".$login."&atualiza=sim' class='btn btn-primary'>Atualizar cadastro</a></center><br>";
                    } else {
                        if ($rg == ''){
                            echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                            echo "<p>Para prosseguir é necessário a atualização dos seus dados cadastrais.</p><br>";
                            echo "<p>Preencha o seu RG</p><br>";
                            echo "<a href='http://gaarcampinas.org/area/cadastro_voluntario.php?login=".$login."&atualiza=sim' class='btn btn-primary'>Atualizar cadastro</a></center><br>";
                        } else {
                            if ($dtnasc == ''){
                                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                                echo "<p>Para prosseguir é necessário a atualização dos seus dados cadastrais.</p><br>";
                                echo "<p>Preencha a sua data de nascimento</p><br>";
                                echo "<a href='http://gaarcampinas.org/area/cadastro_voluntario.php?login=".$login."&atualiza=sim' class='btn btn-primary'>Atualizar cadastro</a></center><br>";
                            } else {
                                if ($nacionalidade == ''){
                                    echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                                    echo "<p>Para prosseguir é necessário a atualização dos seus dados cadastrais.</p><br>";
                                    echo "<p>Preencha a sua nacionalidade</p><br>";
                                    echo "<a href='http://gaarcampinas.org/area/cadastro_voluntario.php?login=".$login."&atualiza=sim' class='btn btn-primary'>Atualizar cadastro</a></center><br>";
                                } else {
                                    if ($estadocivil == ''){
                                        echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                                        echo "<p>Para prosseguir é necessário a atualização dos seus dados cadastrais.</p><br>";
                                        echo "<p>Preencha o seu estado civil</p><br>";
                                        echo "<a href='http://gaarcampinas.org/area/cadastro_voluntario.php?login=".$login."&atualiza=sim' class='btn btn-primary'>Atualizar cadastro</a></center><br>";
                                    } else {
                                        if ($profissao == ''){
                                            echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                                            echo "<p>Para prosseguir é necessário a atualização dos seus dados cadastrais.</p><br>";
                                            echo "<p>Preencha a sua profissão</p><br>";
                                            echo "<a href='http://gaarcampinas.org/area/cadastro_voluntario.php?login=".$login."&atualiza=sim' class='btn btn-primary'>Atualizar cadastro</a></center><br>";
                                        } else {
                                            if ($cep == ''){
                                                echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                                                echo "<p>Para prosseguir é necessário a atualização dos seus dados cadastrais.</p><br>";
                                                echo "<p>Preencha o seu CEP</p><br>";
                                                echo "<a href='http://gaarcampinas.org/area/cadastro_voluntario.php?login=".$login."&atualiza=sim' class='btn btn-primary'>Atualizar cadastro</a></center><br>";
                                            } else {
                                                if ($numero == ''){
                                                    echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                                                    echo "<p>Para prosseguir é necessário a atualização dos seus dados cadastrais.</p><br>";
                                                    echo "<p>Preencha o seu número</p><br>";
                                                    echo "<a href='http://gaarcampinas.org/area/cadastro_voluntario.php?login=".$login."&atualiza=sim' class='btn btn-primary'>Atualizar cadastro</a></center><br>";
                                                } else {
                                                    if ($status == 'Aprovado') {
                                                        $query = "UPDATE VOLUNTARIOS
    					                                            SET 
    					                                                ULTIMO_ACESSO = '$ultimo_acesso'
    					                                            WHERE USUARIO='$login'";
    					                                            
    					                                $update = mysqli_query($connect,$query);
    					                                
    					                                echo "<br><H2>Login efetuado com sucesso! Redirecionando...</H2>";
    					                                
                                                		switch ($area) {
                                                				  case 'operacional':
                                                				    if ($subarea == 'lt'){
                                                				        echo "<script>document.location='lt.php'</script>";
                                                				        $log_file_msg .="[login.php] Usuário ".$login." área ".$area." acessou o sistema com o navegador ".$user_agent." às ".$horaatu."\n";
                                                                        $fp = fopen($log_file, 'a');//opens file in append mode  
                                                                        fwrite($fp, $log_file_msg);  
                                                				    }  else {
                                                				        echo "<script>document.location='operacional.php'</script>"; 
                                                				        $log_file_msg .="[login.php] Usuário ".$login." área ".$area." acessou o sistema com o navegador ".$user_agent." às ".$horaatu."\n";
                                                                        $fp = fopen($log_file, 'a');//opens file in append mode  
                                                                        fwrite($fp, $log_file_msg);  
                                                				    }
                                                				  	
                                                					break;
                                                				  case 'diretoria':
                                                				  	echo "<script>document.location='diretoria.php'</script>";
                                                				  	$log_file_msg .="[login.php] Usuário ".$login." área ".$area." acessou o sistema com o navegador ".$user_agent." às ".$horaatu."\n";
                                                                    $fp = fopen($log_file, 'a');//opens file in append mode  
                                                                    fwrite($fp, $log_file_msg);  
                                                					break;
                                                				  case 'captacao':
                                                				  	echo "<script>document.location='captacao.php'</script>";
                                                				  	$log_file_msg .="[login.php] Usuário ".$login." área ".$area." acessou o sistema com o navegador ".$user_agent." às ".$horaatu."\n";
                                                                    $fp = fopen($log_file, 'a');//opens file in append mode  
                                                                    fwrite($fp, $log_file_msg);  
                                                					break;
                                                     			  case 'financeiro':
                                                				  	echo "<script>document.location='financeiro.php'</script>";
                                                				  	$log_file_msg .="[login.php] Usuário ".$login." área ".$area." acessou o sistema com o navegador ".$user_agent." às ".$horaatu."\n";
                                                                    $fp = fopen($log_file, 'a');//opens file in append mode  
                                                                    fwrite($fp, $log_file_msg);  
                                                					break;
                                                				  case 'admin':
                                                				  	echo "<script>document.location='admin.php'</script>";
                                                				  	$log_file_msg .="[login.php] Usuário ".$login." área ".$area." acessou o sistema com o navegador ".$user_agent." às ".$horaatu."\n";
                                                                    $fp = fopen($log_file, 'a');//opens file in append mode  
                                                                    fwrite($fp, $log_file_msg);  
                                                					break;
                                                				  case 'comunicacao':
                                                				  	echo "<script>document.location='comunicacao.php'</script>";
                                                				  	$log_file_msg .="[login.php] Usuário ".$login." área ".$area." acessou o sistema com o navegador ".$user_agent." às ".$horaatu."\n";
                                                                    $fp = fopen($log_file, 'a');//opens file in append mode  
                                                                    fwrite($fp, $log_file_msg);  
                                                					break;
                                                				  case 'clinica':
                                                				  	echo "<script>document.location='vet.php'</script>";
                                                				  	$log_file_msg .="[login.php] Usuário ".$login." área ".$area." acessou o sistema com o navegador ".$user_agent." às ".$horaatu."\n";
                                                                    $fp = fopen($log_file, 'a');//opens file in append mode  
                                                                    fwrite($fp, $log_file_msg);  
                                                					break;
                                                				  case 'anuncios':
                                                				  	echo "<script>document.location='terceiros.php'</script>";
                                                				  	$log_file_msg .="[login.php] Usuário ".$login." área ".$area." acessou o sistema com o navegador ".$user_agent." às ".$horaatu."\n";
                                                                    $fp = fopen($log_file, 'a');//opens file in append mode  
                                                                    fwrite($fp, $log_file_msg);  
                                                					break;
                                                				  case 'fornecedor':
                                                				  	echo "<script>document.location='fornec.php'</script>";
                                                				  	$log_file_msg .="[login.php] Usuário ".$login." área ".$area." acessou o sistema com o navegador ".$user_agent." às ".$horaatu."\n";
                                                                    $fp = fopen($log_file, 'a');//opens file in append mode  
                                                                    fwrite($fp, $log_file_msg);  
                                                					break;
                                                				  
                                                			  }
                                                			  
                                                        } else {
                                                            echo "<center><h3>Oooops! Algo deu errado...</h3><br>";
                                                            echo "<p>Seu cadastro ainda está esperando aprovação ou foi reprovado.</p><br>";
                                                        }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } 
            }
            
         }
    
} else {
    echo "<br>Usuário ".$login." não encontrado.";
	echo "<br>Mensagem de erro: ".mysqli_error($connect). "<br> SQL Error: ".mysqli_errno($connect);
}

fclose($fp); 	
	
mysqli_close($connect);

?>