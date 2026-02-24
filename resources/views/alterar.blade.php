<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <style>
        :root {
            --primary-purple: #6f42c1;
            --soft-purple: #f3f0ff;
            --dark-purple: #5227a1;
            --bg-page: #f8f7ff;
        }

        body { 
            background-color: var(--bg-page); 
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #444;
        }

        /* Navbar Estilizada */
        .navbar-custom { 
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            padding: 1.5rem 0;
            border-bottom: 4px solid rgba(255,255,255,0.1);
        }

        /* Cards com efeito de flutuação */
        .card { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(111, 66, 193, 0.05);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }

        .card-header-custom {
            background-color: transparent;
            border-bottom: 1px solid var(--soft-purple);
            padding: 20px;
            font-weight: 700;
            color: var(--primary-purple);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Inputs e Botões */
        .form-control {
            border-radius: 10px;
            border: 1px solid #e1e1e1;
            padding: 12px;
            background-color: #fdfdfd;
        }
        .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.1);
        }

        .btn-purple { 
            background-color: var(--primary-purple); 
            color: white; 
            font-weight: 600; 
            border-radius: 12px; 
            padding: 12px;
            border: none;
            transition: all 0.3s;
        }
        .btn-purple:hover { 
            background-color: var(--dark-purple); 
            color: white;
            box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
        }

        /* Tabela */
        .table {
            margin-bottom: 0;
        }
        .table thead th {
            background-color: var(--soft-purple);
            color: var(--dark-purple);
            border: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 15px;
        }
        .table tbody td {
            padding: 15px;
            border-bottom: 1px solid #f1f1f1;
        }

        .badge-id { 
            background-color: var(--soft-purple); 
            color: var(--primary-purple); 
            padding: 6px 12px;
            border-radius: 8px;
        }

        /* Status Dot */
        .status-dot {
            height: 10px;
            width: 10px;
            background-color: #2ecc71;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <input type="hidden" id="id_loja" value="{{$loja->id}}">

<nav class="navbar navbar-custom mb-5 shadow">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand text-white fw-bold italic" href="#">
            <i class="fa-solid fa-mobile-screen-button me-2"></i> SAMSUNG/STORE
        </a>
        <span class="text-white-50 small">
            <span class="status-dot"></span> Sistema Ativo
        </span>
    </div>
</nav>


<div class="container pb-5">
    <div class="row g-4">
        
        <div class="col-lg-4">
            <div class="card p-2">
                <div class="card-header-custom">
                    <i class="fa-solid fa-plus-circle"></i> Novo Cadastro
                </div>
                <div class="card-body">
                    <form id="formSamsung">
                        <div class="mb-3">
                            <label class="form-label small text-uppercase fw-bold">Aparelho</label>
                            <input value="{{ $loja->aparelho }}" type="text" id="aparelho" class="form-control" placeholder="Ex: Galaxy S24">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-uppercase fw-bold">Modelo</label>
                            <input value="{{ $loja->modelo }}" type="text" id="modelo" class="form-control" placeholder="Ex: Ultra / Plus">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label small text-uppercase fw-bold">Cor</label>
                                <input value="{{ $loja->cor }}" type="text" id="cor" class="form-control" placeholder="Titanium">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label small text-uppercase fw-bold">Ano</label>
                                <input value="{{ $loja->ano }}" type="number" id="ano" class="form-control" placeholder="2024">
                            </div>
                        </div>
                        <button type="button" id="salvaraparelho" class="btn btn-purple w-100 mt-3">
                            <i class="fa-solid fa-cloud-arrow-up me-2"></i> REGISTRAR ITEM
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card overflow-hidden">
                <div class="card-header-custom d-flex justify-content-between w-100">
                    <div><i class="fa-solid fa-list-check"></i> Estoque Atual</div>
                    <button onclick="carregarProdutos()" class="btn btn-sm btn-link text-decoration-none p-0" style="color: var(--primary-purple)">
                        <i class="fa-solid fa-rotate"></i> Atualizar
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Aparelho</th>
                                <th>Modelo</th>
                                <th>Cor</th>
                                <th>Ano</th>
                            </tr>
                        </thead>
                        <tbody id="tabelaCorpo">
                            </tbody>
                    </table>
                </div>

                <div id="loader" class="text-center py-5 d-none">
                    <div class="spinner-grow text-primary" role="status"></div>
                    <p class="mt-2 text-muted small italic">Sincronizando com a nuvem...</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    
    const API_URL = '/api';

  
    async function carregarProdutos() {
        const tabela = document.getElementById('tabelaCorpo');
        const loader = document.getElementById('loader');
        
        tabela.innerHTML = ''; 
        loader.classList.remove('d-none');

        try {
            const response = await fetch(`${API_URL}/todos_samsung`);
            const data = await response.json();

            if (data.samsung && data.samsung.length > 0) {
                data.samsung.forEach(item => {
                    tabela.innerHTML += `
                        <tr>
                            <td><span class="badge-id">#${item.id}</span></td>
                            <td><span class="fw-bold">${item.aparelho}</span></td>
                            <td><span class="text-secondary">${item.modelo}</span></td>
                            <td><i class="fa-solid fa-palette me-1 text-muted small"></i> ${item.cor}</td>
                            <td><span class="badge rounded-pill bg-light text-dark border">${item.ano}</span></td>
                        </tr>
                    `;
                });
            } else {
                tabela.innerHTML = '<tr><td colspan="5" class="text-center py-5">Nenhum produto cadastrado no momento.</td></tr>';
            }
        } catch (error) {
            console.error("Erro ao carregar:", error);
            tabela.innerHTML = '<tr><td colspan="5" class="text-center py-5 text-danger">Erro ao conectar com a API.</td></tr>';
        } finally {
            loader.classList.add('d-none');
        }
    }

    

window.onload = carregarProdutos;
</script>
<script>
    $(document).ready(function () {
    alert("funfei");
    $("#salvaraparelho").click(function () {
        $.ajax({
            url: "../api/altera_loja",
            method: "PUT",
            data: {
                
                
                cor: $("#cor").val(),
                ano: $("#ano").val(),
                modelo: $("#modelo").val(),
                aparelho: $("#aparelho").val(),
                id_loja: $("#id_loja").val()



            },
            success: function (res) {
                console.log(res);
                alert("funcionei");

            },
            error: function (xhr) {

                console.log("Erro", xhr.responseText);
            }
        });

    });

});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>