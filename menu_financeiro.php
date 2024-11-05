<?php 
include ("conexao.php"); 

		$queryarea = "SELECT AREA,SUBAREA FROM VOLUNTARIOS WHERE USUARIO ='$login'";
		$selectarea = mysqli_query($connect,$queryarea);
			
		while ($fetcharea = mysqli_fetch_row($selectarea)) {
				$area = $fetcharea[0];
				$subarea = $fetcharea[1];
		}

        

?>
<nav class="navbar fixed-top navbar-expand-sm navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="/area/logo_transparent.png" width="70" height="70"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample03">
    <ul class="navbar-nav mr-auto">
          <? 
            if ($subarea == 'contabil'){
                echo "<li class='nav-item active'>
                        &nbsp;&nbsp;&nbsp;
                      </li>
                      <li class='nav-item active'>
                        <a class='nav-link dropdown-toggle' href='#' id='dropdown03' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Financeiro</a>
                        <div class='dropdown-menu' aria-labelledby='dropdown03'>
                            <a class='dropdown-item' href='relatorio_financeiro_contabil.php'>Relatório Contábil</a>
                        </div>
                      </li>
                      <li class='nav-item active'>
                        &nbsp;&nbsp;&nbsp;
                      </li>
                      <li class='nav-item active'>
                        <a class='nav-link' href='logout.php'>Sair</a>
                      </li>";
            } 
            if ($subarea == 'financeiro' || $subarea == 'diretoria' ){
               echo "<li class='nav-item active'>
                        <a class='nav-link' href='financeiro.php'>Home <span class='sr-only'>(current)</span></a>
                      </li>
                      <li class='nav-item active'>
                        &nbsp;&nbsp;&nbsp;
                      </li>
                      <li class='nav-item active'>
                        <a class='nav-link dropdown-toggle' href='#' id='dropdown03' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Meu menu</a>
                        <div class='dropdown-menu' aria-labelledby='dropdown03'>
                          <a class='dropdown-item' href='meusanimais.php'>Meus animais</a>
                          <a class='dropdown-item' href='formpesquisaprocedi.php'>Meus procedimentos</a>
                          <a class='dropdown-item' href='formatualizadados.php'>Meus dados</a>
                          <a class='dropdown-item' href='formcadastroreemb.php'>Cadastrar reembolso</a>
                        </div>
                      </li>
                      <li class='nav-item active'>
                        &nbsp;&nbsp;&nbsp;
                      </li>
                      <li class='nav-item active'>
                        <a class='nav-link dropdown-toggle' href='#' id='dropdown03' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Administração</a>
                        <div class='dropdown-menu' aria-labelledby='dropdown03'>
                          <a class='dropdown-item' href='formcadastroadmin.php'>Cadastrar documento</a>
                          <a class='dropdown-item' href='pesquisaadmin.php'>Repositório de documentos</a>
                        </div>
                      </li>
                      <li class='nav-item active'>
                        &nbsp;&nbsp;&nbsp;
                      </li>
                      <li class='nav-item active'>
                        <a class='nav-link dropdown-toggle' href='#' id='dropdown03' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Animais</a>
                        <div class='dropdown-menu' aria-labelledby='dropdown03'>
                          <a class='dropdown-item' href='formcadastropet.php'>Cadastrar</a>
                          <a class='dropdown-item' href='formcriatermoimpresso.php'>Criar termo de adoção</a>
                          <a class='dropdown-item' href='listapadrinhos.php'>Lista de padrinhos</a>
                          <a class='dropdown-item' href='formpesquisapetinterna.php'>Pesquisar</a>
                        </div>
                      </li>
                      <li class='nav-item active'>
                        &nbsp;&nbsp;&nbsp;
                      </li>
                      <li class='nav-item active'>
                        <a class='nav-link dropdown-toggle' href='#' id='dropdown03' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Operacional</a>
                        <div class='dropdown-menu' aria-labelledby='dropdown03'>
                          <a class='dropdown-item' href='formcadastrolt.php'>Cadastrar lar temporário</a>
                          <a class='dropdown-item' href='cadastro_vet.php'>Cadastrar veterinários</a>
                          <a class='dropdown-item' href='formcadastroprocedi.php'>Cadastrar procedimentos</a>";
                            if ($area =='diretoria'){
                                echo "<a class='dropdown-item' href='pesquisaprocedi.php'>Aprovar procedimentos</a>";
                            }
                          echo "
                          <a class='dropdown-item' href='formpesquisaprocedi.php'>Pesquisar procedimentos</a>
                        </div>
                      </li>
                      <li class='nav-item active'>
                        &nbsp;&nbsp;&nbsp;
                      </li>
                      <li class='nav-item active'>
                        <a class='nav-link dropdown-toggle' href='#' id='dropdown03' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Financeiro</a>
                        <div class='dropdown-menu' aria-labelledby='dropdown03'>
                            <a class='dropdown-item' href='formcadastrolanc.php'>Cadastrar lançamentos bancários</a>
                            <a class='dropdown-item' href='relatorio_financeiro.php'>Pesquisar lançamentos bancários</a>
                            <a class='dropdown-item' href='formpesquisaprocedi.php'>Pesquisar procedimentos veterinários</a>
                            <a class='dropdown-item' href='pesquisabazar.php'>Pesquisar bazar</a>
                            <a class='dropdown-item' href='pesquisarsocio.php'>Pesquisar sócio</a>
                            <a class='dropdown-item' href='formpesquisavendascalendar.php'>Pesquisar vendas do calendário</a>
                            <a class='dropdown-item' href='relatorio_financeiro.php'>Relatório financeiro</a>
                        </div>
                      </li>
                      <li class='nav-item active'>
                        &nbsp;&nbsp;&nbsp;
                      </li>
                      <li class='nav-item active'>
                        <a class='nav-link dropdown-toggle' href='#' id='dropdown03' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Captação</a>
                        <div class='dropdown-menu' aria-labelledby='dropdown03'>
                          <a class='dropdown-item' href='cadastro_voluntario.php' target='_blank'>Cadastro de novos voluntários</a>
                          <a class='dropdown-item' href='formcadastrobazar.php'>Cadastrar bazar</a>
                          <a class='dropdown-item' href='pesquisabazar.php'>Pesquisar bazar</a>
                          <a class='dropdown-item' href='formcadastroprod.php'>Cadastrar produto</a>
                          <a class='dropdown-item' href='formvendaprod.php'>Cadastrar venda de produto</a>
                          <a class='dropdown-item' href='formpesquisavendaprod.php'>Pesquisar venda de produto</a>
                          <a class='dropdown-item' href='estoque.php'>Estoque de produtos</a>
                          <a class='dropdown-item' href='formcadastrosocio.php'>Cadastrar sócio</a>
                          <a class='dropdown-item' href='pesquisarsocio.php'>Pesquisar sócio</a>
                          <a class='dropdown-item' href='formvendacalendar.php'>Cadastrar venda do calendário</a>
                          <a class='dropdown-item' href='formpesquisavendascalendar.php'>Pesquisar vendas do calendário</a>
                        </div>
                      </li>
                      <li class='nav-item active'>
                        &nbsp;&nbsp;&nbsp;
                      </li>
                      <li class='nav-item active'>
                        <a class='nav-link dropdown-toggle' href='#' id='dropdown03' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Relatórios</a>
                            <div class='dropdown-menu' aria-labelledby='dropdown03'>
                              <a class='dropdown-item' href='relatorio_captacao.php'>Captação</a>
                              <a class='dropdown-item' href='relatorio_adocoes.php'>Operacional</a>
                              <a class='dropdown-item' href='relatorio_financeiro.php'>Financeiro</a>
                            </div>
                      </li>
                      <li class='nav-item active'>
                        &nbsp;&nbsp;&nbsp;
                      </li>
                      <li class='nav-item active'>
                        <a class='nav-link dropdown-toggle' href='#' id='dropdown03' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Outros</a>
                        <div class='dropdown-menu' aria-labelledby='dropdown03'>
                          <a class='dropdown-item' href='http://gaarcampinas.org/veterinarios-parceiros/'>Veterinários Parceiros</a>
                          <a class='dropdown-item' href='listadeprodutos.php'>Lista de produtos</a>
                          <a class='dropdown-item' href='listaleg.php'>Lista de espera de gatos</a>
                          <a class='dropdown-item' href='listalec.php'>Lista de espera de cães</a>
                          <a class='dropdown-item' href='formcadastroreprova.php'>Cadastro de reprovados</a>
                          <a class='dropdown-item' href='pesquisareprova.php'>Lista de reprovados</a>
                        </div>
                      </li>
                      <li class='nav-item active'>
                        <a class='nav-link' href='logout.php'>Sair</a>
                      </li>";
            }
          ?>
    </ul>
  </div>
</nav>
<br><br>
<!--- BOOTSTRAP --->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

<!--- BOOTSTRAP --->
</body>
<br><br><br><br>
</html>