<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../inc/conexao.php';

$retorno = "0";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["pUsuario_id"])) {
        echo "Erro: ID não enviado";
        exit;
    }

    $usuario_id = intval($_POST["pUsuario_id"]);

    // Teste de conexão e ID
    if ($usuario_id <= 0) {
        echo "ID inválido";
        exit;
    }

    $sql = $conexao->prepare("DELETE FROM pagfuncionario.segurancaUsuarios WHERE usuario_id = ?");
    if (!$sql) {
        echo "Erro no prepare: " . $conexao->error;
        exit;
    }

    $sql->bind_param("i", $usuario_id);

    if ($sql->execute()) {
        if ($sql->affected_rows > 0) {
            echo "1";
        } else {
            echo "Nenhuma linha afetada";
        }
    } else {
        echo "Erro ao executar: " . $sql->error;
    }

    $sql->close();
    $conexao->close();
} else {
    echo "Método inválido";
}
