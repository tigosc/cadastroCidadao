<?php
session_start();
include 'components/header.php';
include 'components/conexao.php';

$limpar = (isset($_POST['enviar']) ? $_POST['enviar'] : '');
$query = (isset($_SESSION['query']) ? $_SESSION['query'] : '');
if ($limpar =='3') {
  $query = '';
  $_SESSION['alerta']= '';
}

?>

<div class="container">
  <div class="row">
    <div class="form-group col-12 pt-5">
      <h1>Teste de geração de números do cadastro cidadão</h1>   
    </div>
  </div>  

  <form action="executa.php" method="post" name="frmNis">
    <div class="row">
      <div class="form-group col-12">
        <label for="txtNome">Digite o nome</label>
        <input type="text" class="form-control" name="txtNome" placeholder="Fulano da Silva" required>
      </div>
    </div>
    <div class="row">
      <div class="form-group btn-group mr-2 col-12">
        <div class="form-group">
          <button type="submit" class="btn btn-primary" name="enviar" value="1">Gerar novo</button>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" name="enviar" value="2">Pesquisar</button>
        </div>  
      </div>
    </div>
  </form>

  <div class="row">
    <div class="form-group col-12">
      <?= (!empty($_SESSION['alerta']) ? $_SESSION['alerta'] : ''); ?>
    </div>
  </div>
  
  <?php
  if (isset($query))
  { ?>
    <div class="form-group">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Número NIS</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if ($query != ''){
              $sql = $query;
            } else {
              $sql = "SELECT * FROM cadastro";
            }
            $result = $conn->query( $sql );
            if ($result){
              while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
                echo '<tr>';
                echo '<th scope="row">'.$linha['id'].'</th>';
                echo '<td>'.$linha['nome'].'</td>';
                echo '<td>'.$linha['nis'].'</td>';
                echo '</tr>';
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  <?php
  } 
  ?>
  <form action="#" method="post">
    <div class="row">
      <div class="form-group col-2">
        <button type="submit" class="btn btn-primary" name="enviar" value="3">Ver todos</button>
      </div>
    </div>
  </form>
  <div class="row">
    <div class="form-group">
      <p class="text-justify col-12">IMPORTANTE: Esse gerador online de números do NIS tem como intenção ajudar estudantes, programadores, analistas e testadores a gerar nis válidos. Normalmente necessários parar testar seus softwares em desenvolvimento.
A má utilização dos dados aqui gerados é de total responsabilidade do usuário.
Os números são gerados de forma aleatória, respeitando as regras de criação de cada documento. 
      </p>
    </div>
  </div>
</div> <!-- container -->
<? include 'components/footer.php';