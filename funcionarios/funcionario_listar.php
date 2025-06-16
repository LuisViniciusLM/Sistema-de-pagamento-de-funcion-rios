<?php
include_once '../inc/funcoes.php';
require_once '../inc/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Funcionários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>            
</head>

<script language='JavaScript'>
    function incluir() {
        window.location.href = "funcionario_cadastrar.php";            
    }

    function sair() {
        window.location.href = "../index.php";            
    }

    function voltar() {
        window.location.href = "../principal.php";            
    }

    function excluir() {
        var checkboxes = document.querySelectorAll('input[name="check_id"]:checked');
        var selectedValues = [];

        checkboxes.forEach(function(checkbox) {
            selectedValues.push(checkbox.value);
        });

        if (checkboxes.length === 0) {
            alert("Nenhum funcionário foi selecionado.");
        } else if (checkboxes.length > 1) {
            alert("Selecione somente um funcionário.");
        } else {
            if (confirm("Tem certeza que deseja excluir este funcionário?")) {
                $.ajax({
                    url: 'funcionario_excluir.php',
                    type: 'POST',
                    data: { pFuncionario_id: selectedValues[0] },
                    success: function(data) {
                        const cRetorno = data.replace(/(<([^>]+)>)/ig, '').trim();
                        if (cRetorno === "0") {
                            alert("Erro na exclusão!");
                        } else {
                            alert("Exclusão realizada com sucesso!");
                            location.reload();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Erro na requisição: " + textStatus + " - " + errorThrown);                
                    }
                });
            }
        }
    }   
</script>
    
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">Funcionários Cadastrados</h3>
    <table class="table">    
        <td>
            <button type="button" class="btn btn-sm btn-primary" onclick="incluir()"> Incluir </button>                                    
            <button type="button" class="btn btn-sm btn-danger" onclick="excluir()"> Excluir </button>                        
            <button type="button" class="btn btn-sm btn-dark" onclick="sair()"> Sair </button>            
            <button type="button" class="btn btn-sm btn-warning" onclick="voltar()"> Voltar </button>                        
        </td>
    </table>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Salário</th>
                <th>Data de Admissão</th>
                <th>Status</th>
                <th>Tipo Pessoa</th>
            </tr>
        </thead>
        <tbody id="tabelaFuncionarios">
            <?php
                $sql = "SELECT f.id_funcionario, f.nome, f.cargo, f.salario, f.data_admissao, f.status, pt.nome AS tipo_pessoa
                        FROM tbFuncionarios f
                        LEFT JOIN tbPessoaTipo pt ON f.pessoa_id = pt.pessoa_tipo_id
                        ORDER BY f.nome";

                $result = $conexao->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td><input type="checkbox" name="check_id" value="' . htmlspecialchars($row['id_funcionario']) . '"></td>';
                        echo '<td>' . htmlspecialchars($row['nome']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['cargo']) . '</td>';
                        echo '<td>' . number_format($row['salario'], 3, ',', '.') . '</td>';
                        echo '<td>' . htmlspecialchars(date('d/m/Y', strtotime($row['data_admissao']))) . '</td>';
                        echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['tipo_pessoa']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7" class="text-center">Nenhum funcionário encontrado.</td></tr>';
                }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
