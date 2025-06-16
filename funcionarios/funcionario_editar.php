<?php
include_once '../inc/funcoes.php';
require_once '../inc/conexao.php';

$nome = '';
$login = '';
$id_funcionario = isset($_GET['id_funcionario']) ? intval($_GET['id_funcionario']) : 0;

if ($id_funcionario > 0) {
    $sql = "SELECT id_funcionario, nome, login FROM pagfuncionario.tbFuncionarios WHERE id_funcionario = $id_funcionario";
    salvar_log($sql, 'editar.sql');
    $result = $conexao->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $login = htmlspecialchars($row['login']);
        $nome = htmlspecialchars($row['nome']);
    } else {
        echo "<script>alert('Funcionário não encontrado.'); window.location.href='funcionario_listar.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID inválido.'); window.location.href='funcionario_listar.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>        
</head>
<script>
    function cancelar() {
        window.location.href = "funcionario_listar.php";
    }

    function sair() {
        window.location.href = "../index.php";
    }

    function salvarFuncionario(id_funcionario) {
        let vNome = document.getElementById("nome").value;
        let vLogin = document.getElementById("login").value;
        let vSenha = document.getElementById("senha").value;

        $.ajax({
            url: 'funcionario_salvar.php',
            type: 'POST',
            data: {
                id_funcionario: id_funcionario,
                pNome: vNome,
                pLogin: vLogin,
                pSenha: vSenha
            },
            success: function (data) {
                const cRetorno = data.replace(/(<([^>]+)>)/ig, '').trim();
                if (cRetorno === "0") {
                    alert("Erro na alteração!");
                } else {
                    alert("Alteração realizada com sucesso!");
                    window.location.href = "funcionario_listar.php";
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Erro na requisição: " + textStatus + " - " + errorThrown);
            }
        });
    }
</script>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Editar Funcionário</h4>
                    <form id="formEditar">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" class="form-control" id="login" name="login" value="<?php echo $login; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha (opcional)</label>
                            <input type="password" class="form-control" id="senha" name="senha">
                        </div>
                        <button type="button" class="btn btn-success w-100" onclick="salvarFuncionario(<?php echo $id_funcionario; ?>)">Salvar</button>
                        <br><br>
                        <button type="button" class="btn btn-secondary w-100" onclick="cancelar()">Cancelar</button>
                        <br><br>
                        <button type="button" class="btn btn-dark w-100" onclick="sair()">Sair</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
