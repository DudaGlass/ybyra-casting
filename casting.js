// =====================================================
// ARQUIVO: casting.js
// FUNÇÃO: enviar cadastro de talentos para a API
// =====================================================


// Aguarda toda a página carregar antes de executar o código
document.addEventListener("DOMContentLoaded", function () {

    // Seleciona o formulário pelo ID definido no HTML
    const form = document.getElementById("formCasting");

    // Adiciona um evento que será executado quando o formulário for enviado
    form.addEventListener("submit", function (event) {

        // Impede que a página recarregue automaticamente ao enviar o formulário
        event.preventDefault();


        // =====================================================
        // CRIA UM OBJETO FormData PARA ARMAZENAR OS DADOS
        // =====================================================

        // FormData permite enviar textos e arquivos (fotos)
        const formData = new FormData();


        // =====================================================
        // CAPTURA OS VALORES DOS CAMPOS
        // =====================================================

        // Captura o valor digitado no campo nome
        const nome = document.getElementById("nome").value;

        // Captura data de nascimento
        const nascimento = document.getElementById("nascimento").value;

        // Captura altura
        const altura = document.getElementById("altura").value;

        // Captura peso
        const peso = document.getElementById("peso").value;

        // Captura nacionalidade
        const nacionalidade = document.getElementById("nacionalidade").value;

        // Captura etnia
        const etnia = document.getElementById("etnia").value;

        // Captura cor dos olhos
        const olhos = document.getElementById("olhos").value;

        // Captura cor do cabelo
        const cabelo = document.getElementById("cabelo").value;

        // Captura experiência profissional
        const experiencia = document.getElementById("experiencia").value;

        // Captura link de vídeo
        const video = document.getElementById("video").value;

        // Captura disponibilidade
        const disponibilidade = document.getElementById("disponibilidade").value;


        // =====================================================
        // ADICIONA OS DADOS NO OBJETO FormData
        // =====================================================

        // Adiciona nome ao formulário
        formData.append("nome", nome);

        // Adiciona nascimento
        formData.append("nascimento", nascimento);

        // Adiciona altura
        formData.append("altura", altura);

        // Adiciona peso
        formData.append("peso", peso);

        // Adiciona nacionalidade
        formData.append("nacionalidade", nacionalidade);

        // Adiciona etnia
        formData.append("etnia", etnia);

        // Adiciona cor dos olhos
        formData.append("olhos", olhos);

        // Adiciona cor do cabelo
        formData.append("cabelo", cabelo);

        // Adiciona experiência
        formData.append("experiencia", experiencia);

        // Adiciona vídeo
        formData.append("video", video);

        // Adiciona disponibilidade
        formData.append("disponibilidade", disponibilidade);



        // =====================================================
        // CAPTURA AS FOTOS ENVIADAS
        // =====================================================

        // Seleciona o campo de upload de fotos
        const fotosInput = document.getElementById("fotos");

        // Percorre todos os arquivos enviados
        for (let i = 0; i < fotosInput.files.length; i++) {

            // Adiciona cada foto no formulário
            formData.append("fotos[]", fotosInput.files[i]);

        }



        // =====================================================
        // ENVIA OS DADOS PARA A API
        // =====================================================

        fetch("https://api.ybyra.com/talentos", {  // so um exemplo

            // Método POST para enviar dados
            method: "POST",

            // Envia o objeto FormData
            body: formData

        })

        // Quando a API responder
        .then(function (response) {

            // Converte a resposta para JSON
            return response.json();

        })

        // Quando os dados forem recebidos
        .then(function (data) {

            // Mostra mensagem de sucesso
            alert("Cadastro enviado com sucesso!");

            // Limpa o formulário
            form.reset();

        })

        // Caso aconteça algum erro
        .catch(function (error) {

            // Mostra mensagem de erro
            alert("Erro ao enviar cadastro.");

            // Mostra erro no console do navegador
            console.error(error);

        });

    });

});