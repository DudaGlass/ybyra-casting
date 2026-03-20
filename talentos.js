// ====================================================
// ARQUIVO talentos.js
// FUNÇÃO: buscar talentos na API e exibir na tela
// ====================================================


// Função chamada quando clicar no botão buscar
function buscarTalentos() {


    // ====================================================
    // CAPTURA OS VALORES DOS FILTROS
    // ====================================================

    const altura = document.getElementById("filtroAltura").value

    const idade = document.getElementById("filtroIdade").value

    const nacionalidade = document.getElementById("filtroNacionalidade").value

    const etnia = document.getElementById("filtroEtnia").value



    // ====================================================
    // MONTA URL DA API COM FILTROS
    // ====================================================

    let url = "https://api.ybyra.com/talentos?"

    if (altura) {

        url += "altura=" + altura + "&"

    }

    if (idade) {

        url += "idade=" + idade + "&"

    }

    if (nacionalidade) {

        url += "nacionalidade=" + nacionalidade + "&"

    }

    if (etnia) {

        url += "etnia=" + etnia + "&"

    }



    // ====================================================
    // FAZ REQUISIÇÃO PARA A API
    // ====================================================

    fetch(url)

    .then(function(response){

        return response.json()

    })

    .then(function(dados){

        mostrarTalentos(dados)

    })

    .catch(function(error){

        console.error("Erro ao buscar talentos", error)

    })

}




// ====================================================
// FUNÇÃO PARA MOSTRAR TALENTOS NA TELA
// ====================================================

function mostrarTalentos(talentos){

    // Seleciona área onde talentos serão exibidos
    const lista = document.getElementById("listaTalentos")

    // Limpa resultados anteriores
    lista.innerHTML = ""



    // Percorre todos os talentos retornados pela API
    talentos.forEach(function(talento){

        // Cria coluna bootstrap
        const coluna = document.createElement("div")

        coluna.className = "col-md-4 mb-4"



        // Cria card do talento
        coluna.innerHTML = `

        <div class="card">

        <div class="card-body">

        <h5 class="card-title">${talento.nome}</h5>

        <p>Altura: ${talento.altura} cm</p>

        <p>Nacionalidade: ${talento.nacionalidade}</p>

        <p>Etnia: ${talento.etnia}</p>

        </div>

        </div>

        `



        // Adiciona card na página
        lista.appendChild(coluna)

    })

}