<?php
require_once '../inc/conexao.php';
include_once '../inc/funcoes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_funcionario = $_POST['pFuncionario_id'];
    $nome           = $_POST['pNome'];
    $pessoa_id      = $_POST['pPessoa_id'];
    $cargo          = $_POST['pCargo'];
    $salario        = $_POST['pSalario'];
    $data_admissao  = $_POST['pDataAdmissao'];
    $status         = $_POST['pStatus'];

    try {
        salvar_log("UPDATE pagfuncionario.tbFuncionarios SET nome='$nome', pessoa_id='$pessoa_id', cargo='$cargo', salario='$salario', data_admissao='$data_admissao', status='$status' WHERE id_funcionario=$id_funcionario", 'update.sql');

        $sql = $conexao->prepare("UPDATE pagfuncionario.tbFuncionarios SET nome = ?, pessoa_id = ?, cargo = ?, salario = ?, data_admissao = ?, status = ? WHERE id_funcionario = ?");
        $sql->bind_param("sisdssi", $nome, $pessoa_id, $cargo, $salario, $data_admissao, $status, $id_funcionario);

        if ($sql->execute()) {
            $retorno = "Funcionário alterado com sucesso!";
        } else {
            $retorno = "Erro: " . $sql->error;
        }

        $sql->close();
        $conexao->close();

    } catch (PDOException $e) {
        $retorno = "Erro ao atualizar: " . $e->getMessage();
    }
    echo $retorno;
}
