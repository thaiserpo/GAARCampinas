<!doctype html>
<html lang="pt-br">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Meta tags Obrigatórias -->
    
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS only -
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    
    <title>GAAR - Área do voluntário</title>
    
</head>
<body> 

<nav class="navbar fixed-top navbar-expand-sm navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="/area/logo_transparent.png" width="70" height="70"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarsExample03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="diretoria.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        &nbsp;&nbsp;&nbsp;
      </li>
      
      <li class="nav-item active">
        <a class="nav-link dropdown-toggle" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Meu menu</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="meusanimais.php">Meus animais</a>
          <a class="dropdown-item" href="formpesquisaprocedi.php">Meus procedimentos</a>
          <a class="dropdown-item" href="formatualizadados.php">Meus dados</a>
          <a class="dropdown-item" href="formcadastroreemb.php">Cadastrar reembolso</a>
        </div>
      </li>
      <li class="nav-item active">
        &nbsp;&nbsp;&nbsp;
      </li>
      <li class="nav-item active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administração</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <!--<a class="dropdown-item" href="formcadastroadmin.php">Cadastrar documento</a>-->
          <a class="dropdown-item" href="pesquisaadmin.php">Cadastrar comprovante</a>
          <a class="dropdown-item" href="pesquisaadmin.php">Repositório de documentos</a>
          <a class="dropdown-item" href="listavouchers.php">Lista de vouchers</a>
        </div>
      </li>
      <li class="nav-item active">
        &nbsp;&nbsp;&nbsp;
      </li>
      <li class="nav-item active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Animais</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="formcadastropet.php">Cadastrar</a>
          <a class="dropdown-item" href="formcriatermoimpresso.php">Criar termo de adoção</a>
          <a class="dropdown-item" href="listapadrinhos.php">Lista de padrinhos</a>
          <a class="dropdown-item" href="formpesquisapetinterna.php">Pesquisar</a>
        </div>
      </li>
      <li class="nav-item active">
        &nbsp;&nbsp;&nbsp;
      </li>
      <li class="nav-item active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Operacional</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="formcadastrofeira.php">Cadastrar feira</a>
          <a class="dropdown-item" href="formprecadastrotermo.php">Cadastrar termo de adoção</a>
          <a class="dropdown-item" href="pesquisatermo.php">Pesquisar termo de adoção</a>
          <a class="dropdown-item" href="pesquisapretermo.php">Pesquisar pré termo online</a>
          <a class="dropdown-item" href="formcadastrolt.php">Cadastrar lar temporário</a>
          <a class="dropdown-item" href="formvisualizaprelt.php">Candidatos a lar temporário</a>
          <a class="dropdown-item" href="formcadastroreprova.php">Cadastrar reprovado</a>
          <a class="dropdown-item" href="formpedidocastra_interno.php">Criar pedido de castração</a>
          <!--<a class="dropdown-item" href="formpesquisaprocedi.php">Pesquisar procedimentos</a>-->
          <a class="dropdown-item" href="formpesquisaagenda.php">Pesquisar agendamentos</a>
          <a class="dropdown-item" href="formautoriza.php">Aprovar solicitações</a>
          <a class="dropdown-item" href="listaprotetores.php">Lista de protetores</a>
          <a class="dropdown-item" href="listaclinicas.php">Lista de clínicas</a>
        </div>
      </li>
      <li class="nav-item active">
        &nbsp;&nbsp;&nbsp;
      </li>
      <li class="nav-item active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Financeiro</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="formcadastrolanc.php">Cadastrar lançamentos</a>
          <a class="dropdown-item" href="relatorio_financeiro.php">Pesquisar lançamentos</a>
          <a class="dropdown-item" href="pesquisabazar.php">Pesquisar bazar</a>
          <a class="dropdown-item" href="pesquisarsocio.php">Pesquisar sócio</a>
          <a class="dropdown-item" href="formpesquisavendascalendar.php">Pesquisar vendas do calendário</a>
          <a class="dropdown-item" href="relatorio_financeiro.php">Relatório</a>
          <a class="dropdown-item" href="formextrato.php">Extratos</a>
        </div>
      </li>
      <li class="nav-item active">
        &nbsp;&nbsp;&nbsp;
      </li>
      <li class="nav-item active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Captação</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="formatualizacadastro.php" target="_blank">Aprovar novos cadastros</a>
          <a class="dropdown-item" href="cadastro_voluntario.php" target="_blank">Cadastro de novos voluntários</a>
          <a class="dropdown-item" href="listavoluntarios.php" target="_blank">Lista de voluntários</a>
          <a class="dropdown-item" href="listacandidvol.php" target="_blank">Candidatos à voluntários</a>
          <a class="dropdown-item" href="formcadastroevento.php">Cadastrar evento</a>
          <!--<a class="dropdown-item" href="formcadastrobazar.php">Cadastrar bazar</a>-->
          <a class="dropdown-item" href="formpesquisaevento.php">Pesquisar evento</a>
          <a class="dropdown-item" href="formcadastroprod.php">Cadastrar produto</a>
          <a class="dropdown-item" href="formvendaprod.php">Cadastrar venda de produto</a>
          <a class="dropdown-item" href="formpesquisavendaprod.php">Pesquisar venda de produto</a>
          <a class="dropdown-item" href="estoque.php">Estoque de produtos</a>
          <a class="dropdown-item" href="formcadastrosocio.php">Cadastrar sócio</a>
          <a class="dropdown-item" href="pesquisarsocio.php">Pesquisar sócio</a>
          <!--<a class="dropdown-item" href="formvendacalendar.php">Cadastrar venda do calendário</a>
          <a class="dropdown-item" href="formpesquisavendascalendar.php">Pesquisar vendas do calendário</a>-->
        </div>
      </li>
      <li class="nav-item active">
        &nbsp;&nbsp;&nbsp;
      </li>
      <li class="nav-item active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Comunicação</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="formuploadmailmark.php">Agendar e-mail marketing</a>
          <a class="dropdown-item" href="formuploadtexto.php">Cadastrar texto para social media</a>
          <a class="dropdown-item" href="formcadastropet.php">Cadastrar animais de terceiros</a>
          <a class="dropdown-item" href="pesquisapetterc.php">Aprovar animais de terceiros</a>
          <a class="dropdown-item" href="http://gaarcampinas.org/concursocalendario.php" target="_blank">Cadastrar animal para calendário</a>
          <a class="dropdown-item" href="formpesquisapetcalendar.php" >Pesquisar animal para calendário</a>
          <a class="dropdown-item" href="gradeposts.php">Grade de programação de posts</a>
        </div>
      </li>
      <li class="nav-item active">
        &nbsp;&nbsp;&nbsp;
      </li>
      <li class="nav-item active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Relatórios</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown03">
                              <a class="dropdown-item" href="relatorio_captacao.php">Captação</a>
                              <a class="dropdown-item" href="relatorio_adocoes.php">Operacional</a>
                              <a class="dropdown-item" href="relatorio_financeiro.php">Financeiro</a>
                            </div>
      </li>
      <li class="nav-item active">
        &nbsp;&nbsp;&nbsp;
      </li>
      <li class="nav-item active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Outros</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="formcadastroreprova.php">Cadastro de reprovados</a>
          <a class="dropdown-item" href="listalec.php">Lista de espera de cães</a>
          <a class="dropdown-item" href="listaleg.php">Lista de espera de gatos</a>
          <a class="dropdown-item" href="listadeprodutos.php">Lista de produtos</a>
          <a class="dropdown-item" href="pesquisareprova.php">Lista de reprovados</a>
          <a class="dropdown-item" href="termo_voluntario.php">Termo de voluntariado</a>
          <a class="dropdown-item" href="http://gaarcampinas.org/veterinarios-parceiros/">Veterinários Parceiros</a>
        </div>
      </li>
      <li class="nav-item active">
        &nbsp;&nbsp;&nbsp;
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="logout.php">Sair</a>
      </li>
    </ul>
  </div>
</nav>
<!--- BOOTSTRAP --->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<!--- BOOTSTRAP --->
</body>
<br><br><br><br>
</html>