<?php
$servername = "*************************";
$username = "****************";
$password = "**************";
$dbname = "pagfuncionario";

$conexao = new mysqli($servername, $username, $password, $dbname);

// verifica a conexão
if($conexao->connect_error)
{
    die("Conexao falhou: " . $conexao->connect_error);
}
