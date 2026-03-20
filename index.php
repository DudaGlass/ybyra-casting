<?php
// index.php - Home do site
ini_set('display_errors', 1);
error_reporting(E_ALL);
$artigos = [
    [ 'titulo' => 'Filme premiado ganha destaque internacional', 'categoria' => 'Cinema', 'resumo' => 'Produção brasileira conquista espaço em festivais internacionais.', 'imagem' => 'img/artigos/artigo1.jpg' ],
    [ 'titulo' => 'Bastidores de produção na YBYRA', 'categoria' => 'Bastidores', 'resumo' => 'Processo criativo por trás das produções culturais.', 'imagem' => 'img/artigos/artigo2.jpg' ],
    [ 'titulo' => 'Novos editais abertos para artistas', 'categoria' => 'Oportunidades', 'resumo' => 'Oportunidades para artistas e profissionais do setor cultural.', 'imagem' => 'img/artigos/artigo3.jpg' ]
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ybyra Casting - Home</title>
  <meta name="description" content="Agência de casting e conteúdo cultural para projetos artísticos.">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    .hero-home {background: linear-gradient(rgba(21,20,19,.45), rgba(21,20,19,.45)), url('hero.jpg') center/cover no-repeat; color:white; padding:100px 0;}
    .btn-primary-alt{background:#DBB39C;border-color:#DBB39C;color:#fff;}
    .btn-primary-alt:hover{background:#b58a71;border-color:#b58a71;}
  </style>
</head>
<body>
<?php include 'header.php'; ?>
<section class="hero-home text-center">
  <div class="container">
    <p class="text-uppercase" style="letter-spacing:2px;font-size:.8rem;">Casting Cultural</p>
    <h1 class="display-5 fw-bold">Transformamos talentos em oportunidades reais</h1>
    <p class="lead">Conectamos artistas, criadores e marcas com projetos de alta visibilidade.</p>
    <a href="casting.html" class="btn btn-primary-alt me-2">Participe do Casting</a>
    <a href="blog.php" class="btn btn-outline-light">Ver Blog</a>
  </div>
</section>
<div class="container py-5">
  <div class="text-center mb-4"><h2>Últimos artigos</h2><p class="text-muted">Destaques para o setor cultural</p></div>
  <div class="row">
    <?php foreach ($artigos as $artigo): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <img src="<?= $artigo['imagem'] ?>" class="card-img-top" alt="<?= htmlspecialchars($artigo['titulo']) ?>" onerror="this.src='https://via.placeholder.com/900x450?text=Artigo';">
          <div class="card-body">
            <span class="badge bg-secondary mb-2"><?= htmlspecialchars($artigo['categoria']) ?></span>
            <h5 class="card-title"><?= htmlspecialchars($artigo['titulo']) ?></h5>
            <p class="card-text text-muted"><?= htmlspecialchars($artigo['resumo']) ?></p>
            <a href="blog.php" class="btn btn-sm btn-primary-alt">Ver no Blog</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
