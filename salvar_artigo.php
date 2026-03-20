<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/artigos_db.php';

$artigos = get_articles();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$editando = $id > 0;
$artigo = null;
if ($editando) {
    $artigo = get_article_by_id($id);
    if (!$artigo) {
        header('Location: painel.php');
        exit;
    }
}

$erro = '';
$sucesso = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $resumo = trim($_POST['resumo'] ?? '');
    $conteudo = trim($_POST['conteudo'] ?? '');
    $categoria = trim($_POST['categoria'] ?? 'Casting');
    $imagem = trim($_POST['imagem'] ?? 'img/artigos/default.jpg');

    if (!$titulo || !$resumo || !$conteudo) {
        $erro = 'Preencha todos os campos obrigatórios.';
    } else {
        if ($editando) {
            foreach ($artigos as &$a) {
                if ($a['id'] == $id) {
                    $a['titulo'] = $titulo;
                    $a['resumo'] = $resumo;
                    $a['conteudo'] = $conteudo;
                    $a['categoria'] = $categoria;
                    $a['imagem'] = $imagem;
                    $a['data'] = date('Y-m-d');
                    break;
                }
            }
            unset($a);
            save_articles($artigos);
            $sucesso = 'Artigo atualizado com sucesso.';
        } else {
            $novo = [
                'id' => generate_next_id($artigos),
                'titulo' => $titulo,
                'resumo' => $resumo,
                'conteudo' => $conteudo,
                'categoria' => $categoria,
                'imagem' => $imagem,
                'data' => date('Y-m-d')
            ];
            $artigos[] = $novo;
            save_articles($artigos);
            header('Location: painel.php');
            exit;
        }
    }
}

if (!$artigo) {
    $artigo = [
        'titulo' => '',
        'resumo' => '',
        'conteudo' => '',
        'categoria' => 'Casting',
        'imagem' => 'img/artigos/default.jpg'
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $editando ? 'Editar Artigo' : 'Criar Artigo' ?> - Painel Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<style>.btn-ybyra{background:#DBB39C;color:#fff;border:none;}.btn-ybyra:hover{background:#b58a71;}</style>
</head>
<body>
<div class="container mt-5">
    <h2><?= $editando ? 'Editar Artigo' : 'Criar Novo Artigo' ?></h2>
    <?php if ($erro): ?><div class="alert alert-danger"><?= $erro ?></div><?php endif; ?>
    <?php if ($sucesso): ?><div class="alert alert-success"><?= $sucesso ?></div><?php endif; ?>
    <form method="post">
      <div class="mb-3"><label class="form-label">Título</label><input type="text" class="form-control" name="titulo" value="<?= htmlspecialchars($artigo['titulo']) ?>" required></div>
      <div class="mb-3"><label class="form-label">Resumo</label><textarea class="form-control" name="resumo" rows="2" required><?= htmlspecialchars($artigo['resumo']) ?></textarea></div>
      <div class="mb-3"><label class="form-label">Conteúdo</label><textarea class="form-control" name="conteudo" rows="5" required><?= htmlspecialchars($artigo['conteudo']) ?></textarea></div>
      <div class="mb-3"><label class="form-label">Categoria</label><select class="form-select" name="categoria">
        <?php foreach(['Casting','Projetos','Bastidores','Oportunidades','Atualizações'] as $cat): ?>
          <option value="<?= $cat ?>" <?= $artigo['categoria'] === $cat ? 'selected' : '' ?>><?= $cat ?></option>
        <?php endforeach; ?>
      </select></div>
      <div class="mb-3"><label class="form-label">URL da imagem</label><input type="text" class="form-control" name="imagem" value="<?= htmlspecialchars($artigo['imagem']) ?>"></div>
      <button class="btn btn-ybyra" type="submit"><?= $editando ? 'Salvar alteração' : 'Salvar artigo' ?></button>
      <a class="btn btn-secondary ms-2" href="painel.php">Voltar</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
