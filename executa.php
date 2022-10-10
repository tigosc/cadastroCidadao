<?php
session_start();
require 'components/conexao.php';
require 'components/pis.php';
$_SESSION['query'] = '';

$operacao = (isset($_POST['enviar']) ? $_POST['enviar'] : null);
$nome = (isset($_POST['txtNome']) ? $_POST['txtNome'] : null);

if ($operacao == '2'){
  $_SESSION['query'] = "SELECT * FROM cadastro WHERE nome LIKE '%$nome%'";
} else {
  //$nome = (isset($_POST['txtNome']) ? $_POST['txtNome'] : null);
  $nis = gerarPis();

  try {
    $sql = "CREATE TABLE IF NOT EXISTS `pessoa`.`cadastro` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(220) NULL,
    `nis` DOUBLE NULL,
    PRIMARY KEY (`id`))";
    $conn->exec($sql);
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    exit;
  }

  if ($nome == true && $nis == true){
    $data = [
      'nome' => $nome,
      'nis' => $nis,
    ];
    $sql = "INSERT INTO cadastro (nome, nis) VALUES (:nome, :nis)";
    $stmt= $conn->prepare($sql);
    $stmt->execute($data);
    if($stmt > 0){
      $_SESSION['alerta'] = '<div class="alert alert-success" role="alert">
      Número NIS criado com sucesso para: '.$nome.'</div>';
    } else {
      $_SESSION['alerta'] = '<div class="alert alert-danger" role="alert">
      Ocorreu um erro, tente novamente mais tarde.</div>';
    }
  }
  $conn = null;
}

header('Location: index.php');