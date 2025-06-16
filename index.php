<?php
include_once 'inc/funcoes.php';

$_SESSION = array();

if (!isset($_SESSION))
{
    session_start();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Vinicius</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow: hidden;
    }

    .card {
      z-index: 1;
      background-color: #FFF;
    }

    .center-container {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }


  </style>
   
    <script language='JavaScript'>
    
    function validarLogin()
    {
        let vLogin = document.getElementById("login").value;        
        let vSenha = document.getElementById("senha").value;
        
        $.ajax({
                url: 'login_validar.php',
                type: 'POST',
                data: { pLogin: vLogin, pSenha: vSenha },
                success: function(data) 
                {
                    const cRetorno = data.replace(/(<([^>]+)>)/ig, '').trim();
                    if (cRetorno === "0") 
                    {
                        alert("Login inválido!");
                    } 
                    else 
                    {
                        alert("Login validado com sucesso!");
                        window.location.href = "principal.php";
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert("Erro na requisição: " + textStatus + " - " + errorThrown);                
                }
            });
    }
    
    function cadastrarLogin()
    {
        window.location.href = "usuarios/usuario_cadastrar.php";        
    }
    </script>
  
</head>
<body>
    <div class="center-container">
    <div class="card p-4 shadow-lg" style="width: 350px;">
        <h3 class="text-center mb-3"><img src="imagens/login.jpg" style="width: 75%;" /></h3>
        <form id="loginForm">
            <div class="mb-3">
                <label for="login" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="login" placeholder="Digite seu login" required />
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" placeholder="Digite sua senha" required/>
            </div>
            <button type="button" class="btn btn-primary w-100" onclick="validarLogin()">Entrar</button>
            <!-- Inclusão do Botão de Cadastrado de Login -->
            <BR><BR>
            <button type="button" class="btn btn-dark w-100" onclick="cadastrarLogin()">Cadastrar Login</button>            
            <!-- -->
        </form>
    </div>
  </div>

</body>
</html>
