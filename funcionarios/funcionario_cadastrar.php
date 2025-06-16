<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../inc/conexao.php';

// Buscar os tipos de pessoa para preencher o select
$sqlPessoaTipos = "SELECT pessoa_tipo_id, nome FROM tbPessoaTipo ORDER BY nome";
$resultTipos = $conexao->query($sqlPessoaTipos);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3 class="mb-4">Cadastro de Funcionário</h3>

    <form action="funcionario_incluir.php" method="POST" class="needs-validation" novalidate>

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="pNome" id="nome" required>
        </div>

        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" class="form-control" name="pCargo" id="cargo" required>
        </div>

        <div class="mb-3">
            <label for="salario" class="form-label">Salário</label>
            <input type="number" step="0.01" class="form-control" name="pSalario" id="salario" required>
        </div>

        <div class="mb-3">
            <label for="data_admissao" class="form-label">Data de Admissão</label>
            <input type="date" class="form-control" name="pDataAdmissao" id="data_admissao" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="pStatus" id="status" required>
                <option value="">Selecione...</option>
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pessoa_id" class="form-label">Tipo de Pessoa</label>
            <select class="form-select" name="pPessoaId" id="pessoa_id" required>
                <option value="">Selecione...</option>
                <?php while ($row = $resultTipos->fetch_assoc()): ?>
                    <option value="<?= $row['pessoa_tipo_id'] ?>"><?= htmlspecialchars($row['nome']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="funcionario_listar.php" class="btn btn-secondary">Cancelar</a>

    </form>
</div>

</body>
</html>
