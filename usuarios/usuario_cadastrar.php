<?php
    include_once '../inc/funcoes.php';
    
    
    
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>        
</head>
    <script language='JavaScript'>


        function sair()
        {
            window.location.href = "../index.php";            
        }
        
        function cadastrarUsuario()
        {
            let vNome = document.getElementById("nome").value;        
            let vLogin = document.getElementById("login").value;
            let vSenha = document.getElementById("senha").value;            

            $.ajax({
                    url: './usuario_incluir.php',
                    type: 'POST',
                    data: { pNome: vNome, pLogin: vLogin , pSenha : vSenha },
                    success: function(data) 
                    {
                        const cRetorno = data.replace(/(<([^>]+)>)/ig, '').trim();
                        if (cRetorno === "0") 
                        {
                            alert("Erro no cadastro!");
                        } 
                        else 
                        {
                            alert("Cadastro realizado com sucesso");
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
                    <form action="cadastrar_usuario.php" method="POST" id="formCadastrar">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" class="form-control" id="login" name="login" required>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>
                        <button type="button" class="btn btn-primary w-100" onclick="cadastrarUsuario()">Cadastrar</button>
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

