<?php
    include_once '../inc/funcoes.php';
    require_once '../inc/conexao.php';    
    
    if (isset($_GET['usuario_id'])) 
    {
        $usuario_id = intval($_GET['usuario_id']); 
        $nome = null;
        $login = null;          
        $sql = "SELECT usuario_id, nome, login FROM pagfuncionario.segurancaUsuarios WHERE usuario_id=$usuario_id";
        salvar_log($sql,'editar.sql');
        $result = $conexao->query($sql);  
        if ($result->num_rows > 0) 
        {
            $row = $result->fetch_assoc();
            $login = htmlspecialchars($row['login']);
            $nome = htmlspecialchars(utf8_encode($row['nome']));            
        }
        else
        {
            $login = 'erro';
        }
    } 
    else 
    {
        alert( "Erro na requisição");
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Usuário - Editar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>        
</head>
    <script language='JavaScript'>

        function cancelar()
        {
            window.location.href = "usuario_listar.php";            
        }

        function sair()
        {
            window.location.href = "../index.php";            
        }
        
        function salvarUsuario(usuario_id)
        {
            vUsuario_id = usuario_id;
            let vNome = document.getElementById("nome").value;        
            let vLogin = document.getElementById("login").value;
            let vSenha = document.getElementById("senha").value;            

            $.ajax({
                    url: 'usuario_salvar.php',
                    type: 'POST',
                    data: { pUsuario_id : vUsuario_id , pNome: vNome, pLogin: vLogin , pSenha : vSenha },
                    success: function(data) 
                    {
                        const cRetorno = data.replace(/(<([^>]+)>)/ig, '').trim();
                        if (cRetorno === "0") 
                        {
                            alert("Erro na alteração!");
                        } 
                        else 
                        {
                            alert("Alteração realizada com sucesso !!!");
                            window.location.href = "usuario_listar.php";
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) 
                    {
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
                    <h4 class="card-title text-center mb-4">Cadastro de Usuário</h4>
                    <form id="formCadastrar">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" value='<?php echo $nome; ?>' required>
                        </div>
                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" class="form-control" id="login" name="login" value='<?php echo $login; ?>' required>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>
                        <button type="button" class="btn btn-danger w-100" onclick="salvarUsuario('<?php echo $usuario_id; ?>')">Salvar</button>
                        <BR><BR>
                        <button type="button" class="btn btn-success w-100" onclick="cancelar()">Cancelar</button>                        
                        <BR><BR>
                        <button type="button" class="btn btn-dark w-100" onclick="sair()">Sair</button>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

