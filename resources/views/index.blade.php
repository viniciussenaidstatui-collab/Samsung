@extends('layouts.loja')

@section('title', 'Produtos Samsung')

@section('content')
<div class="hero-section" style="background: linear-gradient(135deg, #1428A0, #0A1870); color: white; padding: 3rem 0; margin-bottom: 2rem;">
    <div class="container text-center">
        <h1 style="font-size: 2.5rem; font-weight: 700;">Bem-vindo à Samsung Store</h1>
        <p class="lead mb-4">Os melhores smartphones, tablets e wearables você encontra aqui!</p>
    </div>
</div>

<div class="container mb-5">
    <!-- Todos os produtos -->
    <div>
        <h2 class="mb-4">
            <i class="fa-solid fa-grid-2"></i> Todos os Produtos
        </h2>
        <div class="row g-4" id="produtosContainer">
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p>Carregando produtos...</p>
            </div>
        </div>
        
        <div class="mt-4" id="paginationLinks"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentPage = 1;

function carregarProdutos(page = 1) {
    let token = $.cookie('token');
    
    $.ajax({
        url: "/api/todos_samsung",
        method: "POST",
        data: { token: token },
        success: function(res) {
            if (res.erro === 'n' && res.samsung) {
                let produtos = res.samsung;
                let html = '';
                
                produtos.forEach(produto => {
                    let preco = produto.preco || 0;
                    let estoque = produto.estoque || 0;
                    
                    html += `
                        <div class="col-md-3 col-6">
                            <div class="product-card">
                                <img src="${produto.imagem_url || 'https://images.samsung.com/is/image/samsung/p6pim/br/feature/163786000/br-feature-gallery-samsung-zk-545150600?$684_547_JPG$'}" class="product-img w-100" alt="${produto.aparelho}">
                                <div class="p-3">
                                    <h6 class="mb-1">${produto.aparelho}</h6>
                                    <p class="text-muted small">${produto.modelo} • ${produto.cor}</p>
                                    <div class="price mb-2">R$ ${preco.toLocaleString('pt-BR', {minimumFractionDigits: 2})}</div>
                                    ${estoque > 0 ? `
                                        <div class="d-flex gap-2">
                                            <a href="/loja/produto/${produto.id}" class="btn btn-outline-samsung btn-sm flex-grow-1">
                                                Ver
                                            </a>
                                            <button class="btn btn-samsung btn-sm add-to-cart" data-id="${produto.id}">
                                                <i class="fa-solid fa-cart-plus"></i>
                                            </button>
                                        </div>
                                    ` : '<button class="btn btn-secondary btn-sm w-100" disabled>Esgotado</button>'}
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                $('#produtosContainer').html(html);
                $('#paginationLinks').html('');
            } else {
                $('#produtosContainer').html(`
                    <div class="col-12 text-center py-5">
                        <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                        <h4>Nenhum produto disponível no momento</h4>
                    </div>
                `);
            }
        },
        error: function() {
            $('#produtosContainer').html(`
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-circle-exclamation fa-3x text-danger mb-3"></i>
                    <h4>Erro ao carregar produtos</h4>
                </div>
            `);
        }
    });
}

function addToCart(produtoId) {
    let token = $.cookie('token');
    
    if (!token) {
        Swal.fire({
            icon: 'warning',
            title: 'Faça login',
            text: 'Você precisa estar logado para comprar',
            confirmButtonColor: '#1428A0'
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }
    
    $.ajax({
        url: "{{ route('loja.addToCart') }}",
        method: "POST",
        data: {
            produto_id: produtoId,
            quantidade: 1,
            _token: "{{ csrf_token() }}",
            token: token
        },
        success: function(res) {
            if (res.erro === 'n') {
                Swal.fire({
                    icon: 'success',
                    title: 'Adicionado!',
                    text: res.msg,
                    timer: 1500,
                    showConfirmButton: false
                });
                if (res.cart_count > 0) {
                    $('.cart-badge').remove();
                    $('.fa-cart-shopping').after(`<span class="cart-badge">${res.cart_count}</span>`);
                }
            } else {
                Swal.fire({ icon: 'error', title: 'Erro', text: res.msg });
            }
        },
        error: function(xhr) {
            let msg = xhr.responseJSON?.msg || 'Erro ao adicionar produto';
            Swal.fire({ icon: 'error', title: 'Erro', text: msg });
        }
    });
}

$(document).ready(function() {
    carregarProdutos();
    
    $(document).on('click', '.add-to-cart', function() {
        addToCart($(this).data('id'));
    });
});
</script>
@endpush