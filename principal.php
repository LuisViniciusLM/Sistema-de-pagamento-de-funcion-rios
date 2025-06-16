<?php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Vinicius Tecnologia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ViniSoftware</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav" aria-controls="menuNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="menuNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Início</a>
        </li>

        <!-- Dropdown com Submenu -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="servicosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cadastros
          </a>
          <ul class="dropdown-menu" aria-labelledby="servicosDropdown">
            <li><a class="dropdown-item" href="usuarios/usuario_listar.php">Usuários</a></li>
            <li><a class="dropdown-item" href="funcionarios/funcionario_listar.php">Funcionários</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php">Sair</a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h1>Vinicius Sistemas</h1>
  <p>Modelo simples de sistemas com cadastros básicos.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
