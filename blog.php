<?php
// blog.php - Página principal do blog
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/artigos_db.php';
$artigos = get_articles();

$categorias = array_count_values(array_map(fn($a) => $a['categoria'], $artigos));
$recentes = array_slice($artigos, 0, 3);

function seo_date($d) {
    return date('d/m/Y', strtotime($d));
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog - YbyraCasting</title>
  <meta name="description" content="Blog YbyraCasting com conteúdos sobre cultura, casting e oportunidades para artistas.">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    :root { --ybyra: #DBB39C; --ybyra-dark: #9e7a65; }
    body { background: #fffdf8; color:#2b2b2b; }
    .btn-ybyra { background: var(--ybyra); border-color: var(--ybyra); color:#fff; }
    .btn-ybyra:hover { background:#b58a71; border-color:#b58a71; }
    .hero-blog { background: linear-gradient(115deg, #f6efe5, #fff); }
    .card-blog { border: 1px solid #eee; transition: 0.2s; }
    .card-blog:hover { transform: translateY(-3px); box-shadow:0 12px 30px rgba(0,0,0,.08);}    
    .badge-cat { background:#f0d9c5; color:#5f3c2a; }
    .sidebar-title { font-weight:700; color:#2e2e2e; }
    .card-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(270px, 1fr)); gap:1rem; }
  </style>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Blog",
    "name": "YbyraCasting Blog",
    "url": "https://ybyracasting.com/blog.php",
    "description": "Blog com conteúdos de casting, cultura e oportunidades para artistas.",
    "publisher": {
      "@type": "Organization",
      "name": "YbyraCasting"
    },
    "blogPost": [
      <?php foreach($artigos as $i => $art): ?>
      {
        "@type": "BlogPosting",
        "headline": "<?= htmlspecialchars($art['titulo']) ?>",
        "description": "<?= htmlspecialchars($art['resumo']) ?>",
        "datePublished": "<?= htmlspecialchars($art['data']) ?>",
        "url": "<?= 'http://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . dirname($_SERVER['REQUEST_URI']) . '/artigo.php?id=' . $art['id'] ?>"
      }<?= $i < count($artigos)-1 ? ',' : '' ?>
      <?php endforeach; ?>
    ]
  }
  </script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">YbyraCasting</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="blog.php">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="sobre.php">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="contato.php">Contato</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="hero-blog py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <p class="text-uppercase text-muted mb-2" style="letter-spacing: 1px; font-size:.8rem;">Blog Cultural</p>
          <h1 class="display-5 fw-bold">Conteúdo criativo para artistas, produtores e gestores culturais</h1>
          <p class="lead text-muted">Descubra reflexões sobre casting, projetos culturais, oportunidades e estratégias para ampliar sua visibilidade nas redes sociais.</p>
          <a href="#artigos" class="btn btn-ybyra">Ver artigos</a>
          <a href="login.php" class="btn btn-outline-secondary ms-2">Área administrativa</a>
        </div>
      </div>
    </div>
  </header>

  <main class="container my-5" id="artigos">
    <div class="row">
      <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div>
            <p class="mb-1 text-uppercase text-muted" style="font-size:.8rem;">Atualizado em <?= date('d/m/Y') ?></p>
            <h2 class="h4">Artigos recentes</h2>
            <p class="text-muted">Insights estratégicos para sua presença no setor cultural.</p>
          </div>
          <span class="badge bg-light text-dark border">Total de artigos: <?= count($artigos) ?></span>
        </div>

        <div class="card-grid">
          <?php foreach($artigos as $artigo): ?>
            <article class="card card-blog mb-3 shadow-sm">
              <img src="<?= htmlspecialchars($artigo['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($artigo['titulo']) ?>" onerror="this.src='https://via.placeholder.com/600x350?text=Ybyra+Casting';">
              <div class="card-body">
                <div class="mb-2">
                  <span class="badge badge-cat"><?= htmlspecialchars($artigo['categoria']) ?></span>
                  <small class="text-muted ms-2"><?= seo_date($artigo['data']) ?></small>
                </div>
                <h3 class="h5 card-title mb-2"><?= htmlspecialchars($artigo['titulo']) ?></h3>
                <p class="card-text text-muted"><?= htmlspecialchars($artigo['resumo']) ?></p>
                <a href="artigo.php?id=<?= $artigo['id'] ?>" class="btn btn-sm btn-ybyra">Ler mais</a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>

      <aside class="col-lg-4">
        <div class="p-3 mb-4 bg-white rounded shadow-sm border">
          <h3 class="sidebar-title h6">Categorias</h3>
          <ul class="list-group list-group-flush">
            <?php foreach($categorias as $categoria => $count): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center p-2 border-0">
                <span><?= htmlspecialchars($categoria) ?></span>
                <span class="badge bg-secondary rounded-pill"><?= $count ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="p-3 mb-4 bg-white rounded shadow-sm border">
          <h3 class="sidebar-title h6">Posts recentes</h3>
          <div class="list-group list-group-flush">
            <?php foreach($recentes as $recente): ?>
              <a href="artigo.php?id=<?= $recente['id'] ?>" class="list-group-item list-group-item-action px-0 py-2"><?= htmlspecialchars($recente['titulo']) ?></a>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="p-3 bg-white rounded shadow-sm border">
          <h3 class="sidebar-title h6">Sobre este blog</h3>
          <p class="small text-muted">Conteúdo focado em autoridade da marca YbyraCasting, para atrair público de Instagram e LinkedIn com linguagem cultural e profissional.</p>
        </div>
      </aside>
    </div>
  </main>

  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
