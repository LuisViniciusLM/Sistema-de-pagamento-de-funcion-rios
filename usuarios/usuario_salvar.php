<?php

include_once '../inc/funcoes.php';
require_once '../inc/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $usuario_id = $_POST["pUsuario_id"];    
    $nome = $_POST["pNome"];
    $login = $_POST["pLogin"];
    $senha = $_POST["pSenha"];

    try 
    {
        salvar_log("UPDATE pagfuncionario.segurancaUsuarios SET nome = '$nome', login = '$login', senha = '$senha' WHERE usuario_id = $usuario_id",'insert.sql');
        $sql_update = $conexao->prepare("UPDATE pagfuncionario.segurancaUsuarios SET nome = ?, login = ?, senha = ? WHERE usuario_id = ?");
        $sql_update->bind_param("sssi", $nome, $login, $senha, $usuario_id); // "sssi": 3 strings + 1 inteiro        
        if ($sql_update->execute()) 
        {
            $retorno = "Usuário alterado com sucesso!";
        } 
        else 
        {
            $retorno = "Erro: " . $sql_update->error;
        }

        $sql_update->close();
        $conexao->close();

    } 
    catch (PDOException $e) 
    {
        $retorno = "Erro ao cadastrar: " . $e->getMessage();
    }
}

echo $retorno;
