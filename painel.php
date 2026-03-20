<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/artigos_db.php';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    delete_article($id);
    header('Location: painel.php');
    exit;
}

$artigos = get_articles();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel Admin - YBYRA Casting</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <h2>Painel Administrativo</h2>
        <p class="text-muted">Gerencie artigos de blog (simulação com JSON local).</p>
      </div>
      <div>
        <a href="logout.php" class="btn btn-outline-danger">Sair</a>
      </div>
    </div>
    <div class="mb-3">
      <a href="salvar_artigo.php" class="btn btn-ybyra">+ Novo artigo</a>
      <a href="blog.php" class="btn btn-secondary ms-2">Ver Blog</a>
    </div>

    <?php if (count($artigos) === 0): ?>
      <div class="alert alert-warning">Nenhum artigo cadastrado.</div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-striped align-middle">
          <thead>
            <tr>
              <th>Título</th>
              <th>Categoria</th>
              <th>Data</th>
              <th class="text-end">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($artigos as $art): ?>
              <tr>
                <td><?= htmlspecialchars($art['titulo']) ?></td>
                <td><?= htmlspecialchars($art['categoria']) ?></td>
                <td><?= date('d/m/Y', strtotime($art['data'])) ?></td>
                <td class="text-end">
                  <a href="artigo.php?id=<?= $art['id'] ?>" class="btn btn-sm btn-outline-primary">Ver</a>
                  <a href="salvar_artigo.php?id=<?= $art['id'] ?>" class="btn btn-sm btn-outline-warning">Editar</a>
                  <a href="painel.php?delete=<?= $art['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja excluir este artigo?');">Excluir</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
