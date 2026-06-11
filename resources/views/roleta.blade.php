<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Samsung Store - Roleta de Cupons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --purple-light: #f3e8ff;
            --purple-medium: #c084fc;
            --purple-dark: #7e22ce;
            --purple-soft: #e9d5ff;
            --purple-bg: #faf5ff;
            --text-dark: #2d1b4e;
            --cyan: #06b6d4;
            --pink: #ec4899;
            --green: #22c55e;
            --amber: #f59e0b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at 20% 15%, rgba(6, 182, 212, 0.18), transparent 28%),
                radial-gradient(circle at 85% 20%, rgba(236, 72, 153, 0.16), transparent 30%),
                linear-gradient(135deg, var(--purple-bg) 0%, #f5f0ff 100%);
            color: var(--text-dark);
        }

        .navbar-purple {
            background: linear-gradient(135deg, var(--purple-dark) 0%, #9b4dff 100%);
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(126, 34, 206, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 800;
            font-size: 1.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link-custom {
            color: rgba(255,255,255,0.9) !important;
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            background: rgba(255,255,255,0.15);
            color: white !important;
            transform: translateY(-2px);
        }

        .page-shell {
            padding: 3rem 0 4rem;
        }

        .page-title h1 {
            font-size: 2.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--purple-dark), var(--cyan), var(--pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .wheel-stage,
        .coupon-panel {
            background: rgba(255,255,255,0.92);
            border: 1px solid rgba(126, 34, 206, 0.12);
            border-radius: 18px;
            box-shadow: 0 12px 30px rgba(126, 34, 206, 0.12);
        }

        .wheel-stage {
            min-height: 560px;
            padding: 28px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .pointer {
            width: 0;
            height: 0;
            border-left: 22px solid transparent;
            border-right: 22px solid transparent;
            border-top: 46px solid #111827;
            position: relative;
            z-index: 3;
            margin-bottom: -18px;
            filter: drop-shadow(0 6px 8px rgba(17,24,39,0.25));
        }

        .wheel-wrap {
            width: min(74vw, 390px);
            aspect-ratio: 1;
            position: relative;
            display: grid;
            place-items: center;
        }

        .wheel {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 12px solid #fff;
            background:
                conic-gradient(
                    var(--purple-dark) 0deg 60deg,
                    var(--cyan) 60deg 120deg,
                    var(--pink) 120deg 180deg,
                    var(--green) 180deg 240deg,
                    var(--amber) 240deg 300deg,
                    #4f46e5 300deg 360deg
                );
            box-shadow: 0 18px 40px rgba(45, 27, 78, 0.22);
            transition: transform 4.2s cubic-bezier(.12,.72,.14,1);
            position: relative;
            overflow: hidden;
        }

        .wheel::after {
            content: '';
            position: absolute;
            inset: 50%;
            width: 76px;
            height: 76px;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            background: white;
            box-shadow: 0 8px 18px rgba(17,24,39,0.24);
        }

        .wheel-label {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: start center;
            padding-top: 30px;
            color: white;
            font-size: 1.15rem;
            font-weight: 800;
            text-shadow: 0 2px 8px rgba(0,0,0,0.26);
        }

        .wheel-label span {
            transform-origin: center 165px;
        }

        .wheel-label:nth-child(1) span { transform: rotate(30deg); }
        .wheel-label:nth-child(2) span { transform: rotate(90deg); }
        .wheel-label:nth-child(3) span { transform: rotate(150deg); }
        .wheel-label:nth-child(4) span { transform: rotate(210deg); }
        .wheel-label:nth-child(5) span { transform: rotate(270deg); }
        .wheel-label:nth-child(6) span { transform: rotate(330deg); }

        .spin-btn {
            width: min(100%, 280px);
            border: none;
            border-radius: 14px;
            padding: 13px 18px;
            margin-top: 26px;
            background: linear-gradient(135deg, var(--purple-dark), #9b4dff);
            color: white;
            font-weight: 800;
            box-shadow: 0 10px 24px rgba(126, 34, 206, 0.3);
        }

        .spin-btn:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        .coupon-panel {
            padding: 24px;
            min-height: 560px;
        }

        .coupon-card {
            border: 1px dashed var(--purple-medium);
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 14px;
            background: linear-gradient(135deg, #fff, var(--purple-bg));
        }

        .coupon-code {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 10px;
            padding: 8px 10px;
            background: #fff;
            color: var(--purple-dark);
            font-weight: 800;
            letter-spacing: 0;
            border: 1px solid var(--purple-soft);
        }

        .btn-outline-purple {
            border: 2px solid var(--purple-dark);
            color: var(--purple-dark);
            background: transparent;
            border-radius: 12px;
            padding: 9px 14px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-outline-purple:hover {
            background: var(--purple-dark);
            color: white;
        }

        @media (max-width: 768px) {
            .navbar-purple .d-flex.justify-content-between {
                gap: 14px;
                align-items: flex-start !important;
                flex-direction: column;
            }

            .navbar-purple .gap-3 {
                flex-wrap: wrap;
                gap: 8px !important;
            }

            .wheel-stage,
            .coupon-panel {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
<nav class="navbar-purple">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand" href="/inicio">
                <i class="fa-solid fa-mobile-screen-button"></i>
                SAMSUNG STORE
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="/inicio" class="nav-link-custom">
                    <i class="fa-solid fa-house"></i> Inicio
                </a>
                <a href="/vitrine" class="nav-link-custom">
                    <i class="fa-solid fa-store"></i> Produtos
                </a>
                <a href="/roleta" class="nav-link-custom active">
                    <i class="fa-solid fa-gift"></i> Roleta
                </a>
                <a href="/carrinho" class="nav-link-custom">
                    <i class="fa-solid fa-cart-shopping"></i> Carrinho
                </a>
                <a href="#" id="logoutBtn" class="nav-link-custom">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
                </a>
            </div>
        </div>
    </div>
</nav>

<main class="page-shell">
    <div class="container">
        <div class="page-title mb-4">
            <h1><i class="fa-solid fa-gift me-2"></i> Roleta de Cupons</h1>
            <p class="text-muted mb-0">Gire uma vez a cada 24 horas e use seu desconto no carrinho.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <section class="wheel-stage">
                    <div class="pointer" aria-hidden="true"></div>
                    <div class="wheel-wrap">
                        <div class="wheel" id="wheel">
                            <div class="wheel-label"><span>5% OFF</span></div>
                            <div class="wheel-label"><span>10% OFF</span></div>
                            <div class="wheel-label"><span>15% OFF</span></div>
                            <div class="wheel-label"><span>20% OFF</span></div>
                            <div class="wheel-label"><span>25% OFF</span></div>
                            <div class="wheel-label"><span>30% OFF</span></div>
                        </div>
                    </div>
                    <button id="spinBtn" class="spin-btn">
                        <i class="fa-solid fa-rotate me-2"></i>Girar roleta
                    </button>
                    <p id="spinInfo" class="text-muted mt-3 mb-0 text-center"></p>
                </section>
            </div>

            <div class="col-lg-5">
                <aside class="coupon-panel">
                    <h4 class="fw-bold mb-2">Seus cupons</h4>
                    <p class="text-muted">Copie um cupom ou envie direto para o carrinho.</p>
                    <div id="couponList" class="mt-4">
                        <div class="text-center text-muted py-5">
                            <i class="fa-solid fa-ticket fa-2x mb-3"></i>
                            <p>Carregando cupons...</p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</main>

<script>
const prizeLabels = ['5% OFF', '10% OFF', '15% OFF', '20% OFF', '25% OFF', '30% OFF'];
let currentRotation = 0;

function getTokenOrRedirect() {
    const token = $.cookie('token');

    if (!token) {
        window.location.href = '/login';
        return null;
    }

    return token;
}

function authHeaders(token) {
    return { 'Authorization': 'Bearer ' + token };
}

function carregarStatus() {
    const token = getTokenOrRedirect();
    if (!token) return;

    $.ajax({
        url: '/api/roleta/status',
        method: 'GET',
        headers: authHeaders(token),
        success: function(res) {
            if (res.erro !== 'n') {
                $('#spinInfo').text(res.msg || 'Nao foi possivel carregar a roleta.');
                return;
            }

            $('#spinBtn').prop('disabled', !res.can_spin);
            $('#spinInfo').text(res.can_spin ? 'Boa sorte no giro de hoje.' : 'Voce ja girou. Volte em 24 horas.');
            renderCupons(res.coupons || []);
        },
        error: function(xhr) {
            $('#spinInfo').text(xhr.responseJSON?.msg || 'Nao foi possivel carregar a roleta.');
        }
    });
}

function renderCupons(coupons) {
    if (!coupons.length) {
        $('#couponList').html(`
            <div class="text-center text-muted py-5">
                <i class="fa-regular fa-face-smile fa-2x mb-3"></i>
                <p>Nenhum cupom disponivel ainda.</p>
            </div>
        `);
        return;
    }

    let html = '';

    coupons.forEach(coupon => {
        html += `
            <div class="coupon-card">
                <div class="d-flex justify-content-between gap-3 align-items-start mb-3">
                    <div>
                        <strong class="d-block fs-5">${coupon.label}</strong>
                        <small class="text-muted">Valido ate ${coupon.expires_at || 'sem validade definida'}</small>
                    </div>
                    <span class="coupon-code"><i class="fa-solid fa-ticket"></i>${coupon.code}</span>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn-outline-purple copy-coupon" data-code="${coupon.code}">
                        <i class="fa-regular fa-copy"></i> Copiar
                    </button>
                    <button class="btn-outline-purple use-coupon" data-code="${coupon.code}">
                        <i class="fa-solid fa-cart-shopping"></i> Usar no carrinho
                    </button>
                </div>
            </div>
        `;
    });

    $('#couponList').html(html);
}

function girarRoleta() {
    const token = getTokenOrRedirect();
    if (!token) return;

    $('#spinBtn').prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin me-2"></i>Girando...');

    $.ajax({
        url: '/api/roleta/girar',
        method: 'POST',
        headers: authHeaders(token),
        data: { token: token },
        success: function(res) {
            if (res.erro !== 'n') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Roleta indisponivel',
                    text: res.msg || 'Tente novamente mais tarde.',
                    confirmButtonColor: '#7e22ce'
                });
                carregarStatus();
                $('#spinBtn').html('<i class="fa-solid fa-rotate me-2"></i>Girar roleta');
                return;
            }

            const segmentAngle = 60;
            const selectedCenter = res.selected_index * segmentAngle + 30;
            const targetRotation = 360 * 6 + (360 - selectedCenter);
            currentRotation += targetRotation;

            $('#wheel').css('transform', `rotate(${currentRotation}deg)`);

            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: prizeLabels[res.selected_index],
                    html: `Seu cupom: <strong>${res.coupon.code}</strong>`,
                    confirmButtonColor: '#7e22ce'
                });
                $('#spinBtn').html('<i class="fa-solid fa-rotate me-2"></i>Girar roleta');
                carregarStatus();
            }, 4300);
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: xhr.responseJSON?.msg || 'Nao foi possivel girar a roleta.',
                confirmButtonColor: '#7e22ce'
            });
            $('#spinBtn').html('<i class="fa-solid fa-rotate me-2"></i>Girar roleta');
            carregarStatus();
        }
    });
}

$(document).ready(function() {
    carregarStatus();

    $('#spinBtn').click(girarRoleta);

    $(document).on('click', '.copy-coupon', function() {
        const code = $(this).data('code');
        navigator.clipboard.writeText(code);
        Swal.fire({
            icon: 'success',
            title: 'Cupom copiado',
            text: code,
            timer: 1200,
            showConfirmButton: false
        });
    });

    $(document).on('click', '.use-coupon', function() {
        localStorage.setItem('couponCode', $(this).data('code'));
        window.location.href = '/carrinho';
    });

    $('#logoutBtn').click(function(e) {
        e.preventDefault();
        $.removeCookie('token', { path: '/' });
        localStorage.removeItem('userEmail');
        localStorage.removeItem('couponCode');
        window.location.href = '/login';
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
