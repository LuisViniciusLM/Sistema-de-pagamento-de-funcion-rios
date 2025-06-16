<?php
$servername = "pagfuncionario.mysql.dbaas.com.br";
$username = "pagfuncionario";
$password = "Vini@2005";
$dbname = "pagfuncionario";

$conexao = new mysqli($servername, $username, $password, $dbname);

// verifica a conexão
if($conexao->connect_error)
{
    die("Conexao falhou: " . $conexao->connect_error);
}