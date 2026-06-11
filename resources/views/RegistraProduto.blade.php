<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Registrar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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

        .navbar-custom { 
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            padding: 1.5rem 0;
            border-bottom: 4px solid rgba(255,255,255,0.1);
            box-shadow: 0 4px 20px rgba(111, 66, 193, 0.2);
            margin-bottom: 30px;
        }

        .navbar-brand {
            color: white;
            font-weight: 800;
            font-size: 1.4rem;
            text-decoration: none;
        }

        .card { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(111, 66, 193, 0.05);
            transition: transform 0.3s ease;
            margin-bottom: 20px;
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

        .form-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #666;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #e1e1e1;
            padding: 12px;
            background-color: #fdfdfd;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
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
            width: 100%;
        }
        .btn-purple:hover { 
            background-color: var(--dark-purple); 
            color: white;
            box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
            transform: translateY(-2px);
        }

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
            vertical-align: middle;
        }

        .badge-id { 
            background-color: var(--soft-purple); 
            color: var(--primary-purple); 
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .badge-stock {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-stock-high { background: #d4edda; color: #155724; }
        .badge-stock-medium { background: #fff3cd; color: #856404; }
        .badge-stock-low { background: #f8d7da; color: #721c24; }

        .breadcrumb-custom {
            background-color: white;
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(111, 66, 193, 0.05);
        }
        
        .preview-image {
            max-width: 100%;
            max-height: 100px;
            border-radius: 8px;
            margin-top: 8px;
            display: none;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="/inicio">
            <i class="fa-solid fa-mobile-screen-button me-2"></i>
            SAMSUNG / STORE
        </a>
        <div class="d-flex gap-3">
            <a href="/inicio" class="btn btn-sm btn-outline-light">Início</a>
            <a href="/loja" class="btn btn-sm btn-outline-light">Loja</a>
            <a href="#" id="btnLogoutNav" class="btn btn-sm btn-outline-light">Sair</a>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <div class="breadcrumb-custom d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-house" style="color: var(--primary-purple);"></i>
            <span class="text-muted">/</span>
            <span class="fw-bold" style="color: var(--dark-purple);">Dashboard</span>
            <span class="text-muted">/</span>
            <span class="text-muted">Registro de Produtos</span>
        </div>
        <div class="text-muted small">
            <i class="fa-regular fa-calendar me-1"></i> 
            <span id="dataAtual"></span>
        </div>
    </div>
    
    <div class="row g-4">
        <!-- Formulário de Cadastro -->
        <div class="col-lg-5">
            <div class="card p-2">
                <div class="card-header-custom">
                    <i class="fa-solid fa-plus-circle"></i> Novo Produto
                </div>
                <div class="card-body">
                    <form id="formSamsung">
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fa-solid fa-mobile me-1"></i> Aparelho *
                            </label>
                            <input type="text" id="aparelho" class="form-control" placeholder="Ex: Galaxy S24 Ultra" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fa-solid fa-microchip me-1"></i> Modelo *
                            </label>
                            <input type="text" id="modelo" class="form-control" placeholder="Ex: Ultra / Plus / FE" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fa-solid fa-palette me-1"></i> Cor *
                                </label>
                                <input type="text" id="cor" class="form-control" placeholder="Ex: Titanium Black" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fa-solid fa-calendar me-1"></i> Ano *
                                </label>
                                <input type="number" id="ano" class="form-control" placeholder="2024" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fa-solid fa-tag me-1"></i> Preço (R$) *
                                </label>
                                <input type="number" id="preco" class="form-control" placeholder="6999.99" step="0.01" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fa-solid fa-boxes me-1"></i> Estoque *
                                </label>
                                <input type="number" id="estoque" class="form-control" placeholder="Quantidade" value="1" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fa-solid fa-image me-1"></i> URL da Imagem
                            </label>
                            <input type="text" id="imagem_url" class="form-control" placeholder="https://images.samsung.com/...">
                            <img id="previewImg" class="preview-image" alt="Prévia">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fa-solid fa-align-left me-1"></i> Descrição
                            </label>
                            <textarea id="descricao" class="form-control" rows="3" placeholder="Descrição do produto..."></textarea>
                        </div>
                        
                        <button type="button" id="salvaraparelho" class="btn-purple mt-2">
                            <i class="fa-solid fa-cloud-arrow-up me-2"></i> REGISTRAR PRODUTO
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabela de Estoque -->
        <div class="col-lg-7">
            <div class="card overflow-hidden">
                <div class="card-header-custom d-flex justify-content-between w-100">
                    <div>
                        <i class="fa-solid fa-list-check"></i> Estoque Atual
                        <span class="badge-id ms-2" id="contadorItens">0</span>
                    </div>
                    <div class="d-flex gap-3">
                        <button onclick="carregarProdutos()" class="btn btn-sm btn-link text-decoration-none p-0" style="color: var(--primary-purple)">
                            <i class="fa-solid fa-rotate"></i> Atualizar
                        </button>
                    </div>
                </div>
                
                <div class="table-responsive" style="max-height: 500px;">
                    <table class="table table-hover align-middle">
                        <thead style="position: sticky; top: 0; z-index: 10; background: white;">
                            <tr>
                                <th>ID</th>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tabelaCorpo">
                            <tr>
                                <td colspan="5" class="text-center py-4">Carregando produtos...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// FUNÇÃO PARA ATUALIZAR DATA
function atualizarData() {
    const data = new Date();
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    document.getElementById('dataAtual').textContent = data.toLocaleDateString('pt-BR', options);
}

// FUNÇÃO PARA CARREGAR PRODUTOS
function carregarProdutos() {
    const tabela = document.getElementById('tabelaCorpo');
    const contador = document.getElementById('contadorItens');
    let token = $.cookie('token');
    
    if (!token) {
        tabela.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-danger">Sessão expirada. Faça login novamente.</td></tr>';
        return;
    }
    
    tabela.innerHTML = '<tr><td colspan="5" class="text-center py-4"><div class="spinner-border text-primary" role="status"></div> Carregando...</td></tr>';
    
    $.ajax({
        url: "/api/todos_samsung",
        method: "POST",
        data: { token: token },
        dataType: "json",
        success: function(data) {
            if (data.erro === 'n' && data.samsung && data.samsung.length > 0) {
                contador.textContent = data.samsung.length;
                
                let html = '';
                data.samsung.forEach(item => {
                    let preco = item.preco || 0;
                    let estoque = item.estoque || 0;
                    
                    let estoqueClass = '';
                    let estoqueText = '';
                    if (estoque > 20) {
                        estoqueClass = 'badge-stock-high';
                        estoqueText = `${estoque} unidades`;
                    } else if (estoque > 5) {
                        estoqueClass = 'badge-stock-medium';
                        estoqueText = `${estoque} unidades`;
                    } else if (estoque > 0) {
                        estoqueClass = 'badge-stock-low';
                        estoqueText = `${estoque} unidades (Últimas!)`;
                    } else {
                        estoqueClass = 'badge-stock-low';
                        estoqueText = 'Esgotado';
                    }
                    
                    html += `
                        <tr>
                            <td><span class="badge-id">#${item.id}</span></td>
                            <td>
                                <strong>${item.aparelho}</strong><br>
                                <small class="text-muted">${item.modelo} • ${item.cor} • ${item.ano}</small>
                            </td>
                            <td class="fw-bold text-primary">R$ ${preco.toLocaleString('pt-BR', {minimumFractionDigits: 2})}</td>
                            <td><span class="badge-stock ${estoqueClass}">${estoqueText}</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="/altera_loja/${item.id}" class="btn btn-sm btn-outline-primary" title="Editar">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <a href="/deleta_samsung/${item.id}" class="btn btn-sm btn-outline-danger" title="Deletar" onclick="return confirm('Tem certeza?')">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    `;
                });
                
                tabela.innerHTML = html;
            } else {
                tabela.innerHTML = '<tr><td colspan="5" class="text-center py-4">Nenhum produto cadastrado.</td></tr>';
                contador.textContent = '0';
            }
        },
        error: function(xhr) {
            let mensagem = "Erro ao carregar produtos.";
            if (xhr.status === 401) {
                mensagem = "Token inválido. Faça login novamente.";
                setTimeout(() => { window.location.href = '/login'; }, 2000);
            }
            tabela.innerHTML = `<tr><td colspan="5" class="text-center py-4 text-danger">${mensagem}</td></tr>`;
            contador.textContent = '0';
        }
    });
}

// PRÉVIA DA IMAGEM
$('#imagem_url').on('input', function() {
    let url = $(this).val();
    if (url) {
        $('#previewImg').attr('src', url).show();
    } else {
        $('#previewImg').hide();
    }
});

// VERIFICAR TOKEN
function verificarToken() {
    let token = $.cookie('token');
    if (!token) {
        Swal.fire({
            icon: 'warning',
            title: 'Sessão expirada',
            text: 'Você precisa estar logado para acessar esta página.',
            confirmButtonColor: '#6f42c1'
        }).then(() => { window.location.href = '/login'; });
        return false;
    }
    return token;
}

// DOCUMENT.READY
$(document).ready(function() {
    let token = verificarToken();
    if (!token) return;
    
    atualizarData();
    setInterval(atualizarData, 60000);
    carregarProdutos();
    
    // Prévia da imagem
    $('#imagem_url').on('input', function() {
        let url = $(this).val();
        if (url) $('#previewImg').attr('src', url).show();
        else $('#previewImg').hide();
    });
    
    // Botão Salvar
    $("#salvaraparelho").click(function() {
        let tokenAtual = $.cookie('token');
        if (!tokenAtual) {
            Swal.fire({ icon: 'error', title: 'Sessão expirada', text: 'Faça login novamente.' })
                .then(() => { window.location.href = '/login'; });
            return;
        }
        
        // Validar campos
        let aparelho = $("#aparelho").val().trim();
        let modelo = $("#modelo").val().trim();
        let cor = $("#cor").val().trim();
        let ano = $("#ano").val().trim();
        let preco = $("#preco").val().trim();
        let estoque = $("#estoque").val().trim();
        let imagem_url = $("#imagem_url").val().trim();
        let descricao = $("#descricao").val().trim();
        
        if (!aparelho || !modelo || !cor || !ano) {
            Swal.fire({ icon: 'warning', title: 'Campos incompletos', text: 'Preencha todos os campos obrigatórios!' });
            return;
        }
        
        if (!preco || isNaN(preco) || parseFloat(preco) <= 0) {
            Swal.fire({ icon: 'warning', title: 'Preço inválido', text: 'Informe um preço válido!' });
            return;
        }
        
        if (!estoque || isNaN(estoque) || parseInt(estoque) < 0) {
            Swal.fire({ icon: 'warning', title: 'Estoque inválido', text: 'Informe uma quantidade válida!' });
            return;
        }
        
        if (isNaN(ano) || ano < 2000 || ano > new Date().getFullYear() + 1) {
            Swal.fire({ icon: 'warning', title: 'Ano inválido', text: 'Informe um ano válido!' });
            return;
        }
        
        let dados = {
            aparelho: aparelho,
            modelo: modelo,
            cor: cor,
            ano: parseInt(ano),
            preco: parseFloat(preco),
            estoque: parseInt(estoque),
            imagem_url: imagem_url,
            descricao: descricao,
            token: tokenAtual
        };
        
        let $btn = $(this);
        let textoOriginal = $btn.html();
        $btn.html('<i class="fa-solid fa-spinner fa-spin me-2"></i> SALVANDO...').prop('disabled', true);
        
        $.ajax({
            url: "/api/salva_samsung",
            method: "POST",
            data: dados,
            success: function(res) {
                if(res['erro'] == 'n') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: 'Produto cadastrado com sucesso!',
                        confirmButtonColor: '#6f42c1',
                        timer: 2000
                    });
                    
                    // Limpar campos
                    $("#aparelho, #modelo, #cor, #ano, #preco, #estoque, #imagem_url, #descricao").val("");
                    $("#previewImg").hide();
                    
                    carregarProdutos();
                } else {
                    Swal.fire({ icon: 'error', title: 'Erro', text: res['msg'] || 'Erro desconhecido' });
                }
            },
            error: function(xhr) {
                let mensagem = "Erro ao conectar com o servidor.";
                if (xhr.status === 401) {
                    mensagem = "Token inválido. Faça login novamente.";
                    setTimeout(() => { window.location.href = '/login'; }, 2000);
                } else if (xhr.responseJSON && xhr.responseJSON.msg) {
                    mensagem = xhr.responseJSON.msg;
                }
                Swal.fire({ icon: 'error', title: 'Erro', text: mensagem });
            },
            complete: function() {
                $btn.html(textoOriginal).prop('disabled', false);
            }
        });
    });
    
    // Logout
    $("#btnLogoutNav").click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Deseja sair?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, sair',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.removeCookie('token', { path: '/' });
                localStorage.removeItem('userEmail');
                window.location.href = '/login';
            }
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>