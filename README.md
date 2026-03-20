# YbyraCasting

## Como rodar localmente
1. Abra PowerShell na pasta do projeto:
   `cd c:\Users\User\Music\ybyra-casting`
2. Inicie servidor PHP:
   `php -S localhost:8000`
3. Acesse no browser:
   - Home: `http://localhost:8000/index.php`
   - Blog: `http://localhost:8000/blog.php`
   - Sobre: `http://localhost:8000/sobre.php`
   - Contato: `http://localhost:8000/contato.php`

> Se você usar XAMPP, copie os arquivos para `c:\xampp\htdocs\ybyra-casting` e abra `http://localhost/ybyra-casting/index.php`.

## Admin (painel restrito)
- Acesse: `http://localhost:8000/login.php`
- Usuário: `admin`
- Senha: `ybyra123`
- Depois gerencie artigos em `painel.php` e `salvar_artigo.php`.

## Arquivos principais
- `blog.php` - Página do blog com cards, sidebar e SEO
- `artigo.php` - Página do artigo completo por `id`
- `artigos_db.php` - Simulação de base com JSON
- `painel.php` / `salvar_artigo.php` - CRUD de artigos
- `style.css` - Estilo global com identidade visual

## Personalizações rápidas
- Cores e tipografia: `style.css` (variáveis em `:root`)
- Logo/header/footer: `header.php`, `footer.php`
- Atualizar artigos teste: `data/artigos.json`
