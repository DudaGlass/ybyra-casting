<?php
// artigos_db.php
// Leitura/escrita simples de artigos usando JSON para simular banco de dados.

function get_json_path() {
    return __DIR__ . '/data/artigos.json';
}

function ensure_data_file() {
    $path = get_json_path();
    if (!file_exists(dirname($path))) {
        mkdir(dirname($path), 0777, true);
    }
    if (!file_exists($path)) {
        $default = [
            [
                'id' => 1,
                'titulo' => 'Casting de Atores Premiados',
                'resumo' => 'Bastidores e curiosidades sobre a seleção de atores premiados.',
                'conteudo' => 'Neste artigo exploramos o processo de seleção de atores premiados, o perfil buscado por diretores e o impacto na carreira dos artistas. O texto destaca dicas para se preparar para testes e networking no setor cultural.',
                'imagem' => 'img/artigos/artigo1.jpg',
                'categoria' => 'Casting',
                'data' => '2026-03-17'
            ],
            [
                'id' => 2,
                'titulo' => 'Projeto Cultural X',
                'resumo' => 'Tudo sobre o projeto realizado no setor cultural e sua repercussão.',
                'conteudo' => 'Conheça o Projeto Cultural X: objetivos, parceiros, etapas de produção e exemplos reais de como a cultura pode transformar comunidades. Inclui entrevistas com artistas e gestores.',
                'imagem' => 'img/artigos/artigo2.jpg',
                'categoria' => 'Projetos',
                'data' => '2026-03-15'
            ],
            [
                'id' => 3,
                'titulo' => 'Editais abertos para artistas',
                'resumo' => 'Novas oportunidades para quem quer entrar no mercado cultural.',
                'conteudo' => 'Atualizações sobre editais abertos, prazos, documentos necessários e orientações práticas para inscrições. Ferramentas de planejamento e estratégia para artistas e produtores.',
                'imagem' => 'img/artigos/artigo3.jpg',
                'categoria' => 'Oportunidades',
                'data' => '2026-03-10'
            ]
        ];
        file_put_contents($path, json_encode($default, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}

function get_articles() {
    ensure_data_file();
    $json = file_get_contents(get_json_path());
    $articles = json_decode($json, true);
    if (!is_array($articles)) {
        return [];
    }
    usort($articles, function($a, $b) {
        return strtotime($b['data']) - strtotime($a['data']);
    });
    return $articles;
}

function get_article_by_id($id) {
    $articles = get_articles();
    foreach ($articles as $article) {
        if ($article['id'] == $id) {
            return $article;
        }
    }
    return null;
}

function save_articles($articles) {
    file_put_contents(get_json_path(), json_encode(array_values($articles), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function generate_next_id($articles) {
    $ids = array_map(fn($item) => $item['id'], $articles);
    return $ids ? max($ids) + 1 : 1;
}

function delete_article($id) {
    $articles = get_articles();
    $filtered = array_filter($articles, fn($art) => $art['id'] != $id);
    save_articles($filtered);
}
