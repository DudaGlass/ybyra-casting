<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/artigos_db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$artigo = get_article_by_id($id);
if (!$artigo) {
    http_response_code(404);
    $artigo = [
        'titulo' => 'Artigo não encontrado',
        'resumo' => 'O artigo solicitado não foi localizado.',
        'conteudo' => 'Verifique se o link está correto e tente novamente.',
        'imagem' => 'https://via.placeholder.com/1200x500?text=Artigo+não+encontrado',
        'categoria' => 'Erro',
        'data' => date('Y-m-d')
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($artigo['titulo']) ?> - YbyraCasting</title>
  <meta name="description" content="<?= htmlspecialchars($artigo['resumo']) ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>.btn-ybyra{background:#DBB39C;color:#fff;border:none;}.btn-ybyra:hover{background:#b58a71;}</style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">YbyraCasting</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="sobre.php">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="contato.php">Contato</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="bg-light py-4">
    <div class="container">
      <small class="text-muted"><?= htmlspecialchars($artigo['categoria']) ?>  <?= date('d/m/Y', strtotime($artigo['data'])) ?></small>
      <h1 class="mt-2"><?= htmlspecialchars($artigo['titulo']) ?></h1>
      <p class="lead text-muted"><?= htmlspecialchars($artigo['resumo']) ?></p>
    </div>
  </section>

  <div class="container my-4">
    <img src="<?= htmlspecialchars($artigo['imagem']) ?>" class="img-fluid rounded mb-4" alt="<?= htmlspecialchars($artigo['titulo']) ?>" onerror="this.src='https://via.placeholder.com/1200x500?text=Sem+imagem';">
    <div class="row">
      <div class="col-lg-8">
        <article>
          <p><?= nl2br(htmlspecialchars($artigo['conteudo'])) ?></p>
          <p>Conteúdo adicional de exemplo para mostrar o artigo completo e engajar o público.</p>
        </article>
      </div>
      <div class="col-lg-4">
        <div class="p-3 border rounded bg-white shadow-sm">
          <h5>Mais posts</h5>
          <ul class="list-unstyled">
            <?php foreach (array_slice(get_articles(), 0, 3) as $item): ?>
              <li><a href="artigo.php?id=<?= $item['id'] ?>"><?= htmlspecialchars($item['titulo']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <a href="blog.php" class="btn btn-ybyra mt-3">Voltar ao Blog</a>
  </div>

  <?php include 'footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
