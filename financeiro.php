<?php 

session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{
	
		$queryarea = "SELECT AREA,NOME FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$nome = $fetcharea[1];
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
    
    <!-- Estilos customizados para esse template -->
    <link href="sticky-footer.css" rel="stylesheet">
    
    <title>GAAR - Área do voluntário</title>
    
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
    <p><h3><center>Olá <? echo $nome?>! Seja bem vindo a área restrita do GAAR! Abaixo está o passo-a-passo de todas as funções disponíveis: </center> <br></h3></p>
    <?
        if ($subarea == 'contabil'){
            echo "<p>RELATÓRIO CONTÁBIL<br>
                    Aqui é possível criar relatórios de todos os lançamentos bancários cadastrados no banco de dados. </p>";
            
        } else {
            echo "
        <p><strong>CADASTRAR ANIMAIS PARA ADOÇÃO</strong><br>
        	Qualquer animal, seja da ONG ou não, que esteja procurando um lar, deve ser cadastrado através dessa opção. Os animais que forem cadastrados irão aparecer na página de busca.
            </p>
          <p>&nbsp;</p>
          <p>1 - Acesse o menu Operacional na barra superior<br>
            2 - Posicione o mouse em cima, vai abrir uma lista de menus e clique em Cadastrar animais para adoção <br>
            3 - Preencha todos os campos, para os animais da ONG seleciona Digulgar como GAAR, para animais de terceiros seleciona Divulgar como Terceiros. <br><br>
         </p>
      
       
        <strong>CADASTRAR FEIRA DE ADOÇÃO (em construção)</strong><br>
        	É importante ter o controle e organização de nossas feiras, para isso podemos cadastrar as informações aqui:
            1 - Acesse o menu Operacional na barra superior<br>
            2 - Posicione o mouse em cima, vai abrir uma lista de menus e clique em Cadastrar feira de adoção <br><br> 
      
       
        <strong>CADASTRAR TERMO DE ADOÇÃO</strong><br>
            1 - Acesse o menu Operacional na barra superior<br>
            2 - Posicione o mouse em cima, vai abrir uma lista de menus e clique em Cadastrar termo de adoção <br><br> 
      
       
        <strong>CONSULTAR TERMO DE ADOÇÃO CADASTRADO</strong><br>
            1 - Acesse o menu Operacional na barra superior<br>
            2 - Posicione o mouse em cima, vai abrir uma lista de menus e clique em Pesquisar termo de adoção. <br>
            	Nessa pesquisa é possível pesquisar um termo com vários parâmetros, inclusive o nome do animal. O resultado da pesquisa está em ordem decrescente de cadastro, para melhor visualização.<br><br>
      
       
        <strong>ATUALIZAR TERMO DE ADOÇÃO CADASTRADO</strong><br>
            1 - Acesse o menu Operacional na barra superior<br>
            2 - Posicione o mouse em cima, vai abrir uma lista de menus e clique em Pesquisar termo de adoção. Nessa pesquisa é possível pesquisar um termo com vários parâmetros, inclusive o nome do animal. O resultado da pesquisa está em ordem decrescente de cadastro, para melhor visualização<br>
            3 - Após aparecer o resultado da pesquisa, escolha o termo para atualizar no campo indicado e clique no botão Atualizar<br>
            4 - Alguns campos serão editáveis, outros não. Faça suas atualizações no termo e clique no botão Atualizar<br>
            Pronto! Termo atualizado com sucesso :)<br><br>
      
       
        <strong>PESQUISAR PRÉ TERMO ONLINE</strong><br>
            1 - Acesse o menu Operacional na barra superior<br>
            2 - Posicione o mouse em cima, vai abrir uma lista de menus e clique em Pesquisar pré termo online. Nessa pesquisa é possível pesquisar um termo com o nome do animal ou a espécie. O resultado da pesquisa está em ordem decrescente de cadastro, para melhor visualização<br>
            3 - Após aparecer o resultado da pesquisa, caso queira visualizar todas as informações, escolha o número do termo no campo indicado e clique no botão Visualizar<br>
            4 - Caso queira responder ao interessado, clique no botão Enviar resposta ao interessado<br>
            5 - Caso queira responder ao interessado via WhatsApp, clique no botão Enviar WhatsApp<br>
            6 - Caso queira enviar uma cópia do pré termo ao seu e-mail pessoal, clique no botão Enviar pré termo por e-mail<br><br>
             
      
        - Cadastrar, consultar e atualizar os lares temporários
      
      
        - Gerar relatórios        
   ";
        }
    
    
    ?>
    <br />
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
</html>