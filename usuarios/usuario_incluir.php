<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../inc/conexao.php';

$retorno = "0";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome  = isset($_POST['pNome'])  ? trim($_POST['pNome'])  : '';
    $login = isset($_POST['pLogin']) ? trim($_POST['pLogin']) : '';
    $senha = isset($_POST['pSenha']) ? trim($_POST['pSenha']) : '';

    if (empty($nome) || empty($login) || empty($senha)) {
        echo "Dados incompletos";
        exit;
    }

    // criptografa a senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = $conexao->prepare("INSERT INTO pagfuncionario.segurancaUsuarios (nome, login, senha) VALUES (?, ?, ?)");
    if (!$sql) {
        echo "Erro no prepare: " . $conexao->error;
        exit;
    }

    $sql->bind_param("sss", $nome, $login, $senhaHash);

    if ($sql->execute()) {
        echo "1"; // sucesso
    } else {
        echo "Erro ao executar: " . $sql->error;
    }

    $sql->close();
    $conexao->close();
} else {
    echo "Método inválido";
}
