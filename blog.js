// blog.js
// JS opcional para interatividade do blog

// Exemplo: alerta ao clicar em "Ler Mais"
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.btn-primary');
    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            console.log('Usuário clicou em Ler Mais');
        });
    });
});