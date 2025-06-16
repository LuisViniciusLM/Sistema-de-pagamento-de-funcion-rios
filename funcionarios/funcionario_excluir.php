<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../inc/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["pFuncionario_id"])) {
        echo "Erro: ID não enviado";
        exit;
    }

    $funcionario_id = intval($_POST["pFuncionario_id"]);

    if ($funcionario_id <= 0) {
        echo "ID inválido";
        exit;
    }

    $sql = $conexao->prepare("DELETE FROM pagfuncionario.tbFuncionarios WHERE id_funcionario = ?");
    if (!$sql) {
        echo "Erro no prepare: " . $conexao->error;
        exit;
    }

    $sql->bind_param("i", $funcionario_id);

    if ($sql->execute()) {
        echo ($sql->affected_rows > 0) ? "1" : "Nenhuma linha afetada";
    } else {
        echo "Erro ao executar: " . $sql->error;
    }

    $sql->close();
    $conexao->close();
} else {
    echo "Método inválido";
}
