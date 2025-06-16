<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../inc/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome           = $_POST['pNome'] ?? '';
    $pessoa_id      = $_POST['pPessoa_id'] ?? null;
    $cargo          = $_POST['pCargo'] ?? '';
    $salario        = $_POST['pSalario'] ?? '';
    $data_admissao  = $_POST['pDataAdmissao'] ?? '';
    $status         = $_POST['pStatus'] ?? '';

    if (empty($nome) || empty($cargo) || empty($salario) || empty($data_admissao) || empty($status)) {
        echo "Dados incompletos";
        exit;
    }

    $sql = $conexao->prepare("INSERT INTO pagfuncionario.tbFuncionarios (nome, pessoa_id, cargo, salario, data_admissao, status) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$sql) {
        echo "Erro no prepare: " . $conexao->error;
        exit;
    }

    $sql->bind_param("sisdss", $nome, $pessoa_id, $cargo, $salario, $data_admissao, $status);

    if ($sql->execute()) {
    header("Location: funcionario_listar.php");
    exit;
} else {
    echo "Erro ao executar: " . $sql->error;
}


    $sql->close();
    $conexao->close();
} else {
    echo "Método inválido";
}
