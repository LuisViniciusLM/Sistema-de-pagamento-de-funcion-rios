<?php

include_once 'inc/funcoes.php';
require_once 'inc/conexao.php';

// Inicializa como não autorizado
$retorno = 0;

// Valida se a requisição é POST
if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
    // Captura e limpa os dados
    $vLogin = isset($_POST["pLogin"]) ? trim($_POST["pLogin"]) : '';
    $vSenha = isset($_POST["pSenha"]) ? trim($_POST["pSenha"]) : '';

    // Só tenta autenticar se ambos os campos estiverem preenchidos
    if (!empty($vLogin) && !empty($vSenha)) 
    {
        // Prepara a consulta
        $sql_login = $conexao->prepare("SELECT COUNT(*) AS existe FROM segurancaUsuarios WHERE login = ? AND senha = ?");
        if ($sql_login) {
            $sql_login->bind_param("ss", $vLogin, $vSenha);
            $sql_login->execute();
            $sql_login->bind_result($existe);

            if ($sql_login->fetch() && $existe > 0) {
                $retorno = 1;
                
                session_start();
                $_SESSION["usuario_logado"] = $vLogin;
            }

            $sql_login->close();
        }
    }

    $conexao->close();
    echo $retorno;
    exit;
} 
else 
{
    // Bloqueia requisições que não sejam POST
    http_response_code(405);
    echo "Método não permitido";
    exit;
}
?>
