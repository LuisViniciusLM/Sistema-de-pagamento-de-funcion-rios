<?php
    include_once '../inc/funcoes.php';
    require_once '../inc/conexao.php';
    
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>            

</head>

    <script language='JavaScript'>

        function incluir()
        {
            window.location.href = "usuario_cadastrar.php";            
        }

        function sair()
        {
            window.location.href = "../index.php";            
        }

        function voltar()
        {
            window.location.href = "../principal.php";            
        }

        function excluir()
        {
            // Seleciona todos os checkboxes com o nome 'check_id'
            var checkboxes = document.querySelectorAll('input[name="check_id"]:checked');
            var selectedValues = [];

            // Itera sobre os checkboxes marcados e pega seus valores
            checkboxes.forEach(function(checkbox) 
            {
                selectedValues.push(checkbox.value);
            });

            if (checkboxes.length === 0) 
            {
                alert("Nenhum usuário foi selecionado.");
            } 
            else if (checkboxes.length > 1) 
            {
                alert("Selecione somente um usuário.");
            } 
            else 
            {
                if (confirm("Tem certeza que deseja excluir este item?")) 
                {
                    $.ajax({
                        url: 'usuario_excluir.php',
                        type: 'POST',
                        data: { pUsuario_id: selectedValues[0] },
                        success: function(data) {
                            const cRetorno = data.replace(/(<([^>]+)>)/ig, '').trim();
                            if (cRetorno === "0") 
                            {
                                alert("Erro na exclusão!");
                            } 
                            else 
                            {
                                alert("Exclusão realizada com sucesso!");
                                location.reload();
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) 
                        {
                            alert("Erro na requisição: " + textStatus + " - " + errorThrown);                
                        }
                    });
                }
            }
        }   
    
    
</script>
    
<body class="bg-light">

<div class="container mt-5">
    <h3 class="mb-4">Usuários Cadastrados</h3>
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
                <th>Login</th>
            </tr>
        </thead>
        <tbody id="tabelaUsuarios">
            <!-- Exemplo de linha (pode ser gerado dinamicamente com PHP ou JavaScript) -->
            <tr>
                <?php
                    // Consulta SQL
                    $sql = "SELECT usuario_id, nome, login FROM pagfuncionario.segurancaUsuarios ORDER BY nome";
                    $result = $conexao->query($sql);  
                    $i = 0;
                    if ($result->num_rows > 0) 
                    {
                        while ($row = $result->fetch_assoc()) 
                        {
                            $usuario_id = urlencode($row['usuario_id']);
                            
                            $nome = htmlspecialchars($row['nome']);
                            $nome = utf8_encode($nome);
                            $login = htmlspecialchars($row['login']);
                            $login = utf8_encode($login);
                            
                            echo '<tr>';
                            echo '<td><input type="checkbox" id="id" name="check_id" value="'.$usuario_id.'"></td>';                            
                            echo '<td>' . $nome . '</td>';
                            echo '<td><a href="usuario_editar.php?usuario_id=' . $usuario_id . '" class="text-decoration-none">' . $login . '</a></td>';
                            echo '</tr>';
                        }                        
                    }
                    else
                    {
                        echo('<td>0</td>');
                        echo('<td>Tabela vazia</td>');
                        echo('<td>Nenhum registro encontrado</td>');
                    }
                
                ?>
            </tr>
            <!-- Outras linhas aqui... -->
        </tbody>
    </table>
    
</div>


</body>
</html>


