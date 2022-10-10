<?php
//Criar as constantes com as credencias de acesso ao banco de dados
define('HOST', 'db4free.net');
define('USER', 'tigosc');
define('PASS', 'rva-EHY5haj4bqu8bxr');
define('DBNAME', 'pessoa');

//Criar a conexão com banco de dados usando o PDO e a porta do banco de dados
try {
    $conn = new pdo('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASS);
    //echo "Conexão com banco de dados realizada com sucesso.";
} catch (PDOException $e) {
    echo "Erro: Conexão com banco de dados não foi realizada com sucesso. Erro gerado " . $e->getMessage();
}