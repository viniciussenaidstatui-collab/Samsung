{{-- resources/views/layouts/loja.blade.php --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung Store - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
    <style>
        :root {
            --samsung-blue: #1428A0;
            --samsung-dark: #0A1870;
            --samsung-light: #2563EB;
        }
        
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: #f5f5f5;
        }
        
        .navbar-samsung {
            background: var(--samsung-blue);
            padding: 1rem 0;
        }
        
        .navbar-samsung .navbar-brand {
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .nav-link-custom {
            color: rgba(255,255,255,0.85) !important;
            transition: color 0.2s;
        }
        
        .nav-link-custom:hover {
            color: white !important;
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -12px;
            background: #ff4444;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.7rem;
            font-weight: bold;
        }
        
        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        
        .product-img {
            height: 200px;
            object-fit: contain;
            padding: 1rem;
            background: #f8f9fa;
        }
        
        .btn-samsung {
            background: var(--samsung-blue);
            color: white;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            border: none;
            transition: background 0.2s;
        }
        
        .btn-samsung:hover {
            background: var(--samsung-dark);
            color: white;
        }
        
        .btn-outline-samsung {
            border: 2px solid var(--samsung-blue);
            color: var(--samsung-blue);
            background: transparent;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
        }
        
        .btn-outline-samsung:hover {
            background: var(--samsung-blue);
            color: white;
        }
        
        .price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--samsung-blue);
        }
        
        .old-price {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9rem;
        }
        
        footer {
            background: #1a1a2e;
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-samsung navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('loja.index') }}">
            <i class="fa-solid fa-mobile-screen-button me-2"></i>
            Samsung Store
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-3">
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="{{ route('loja.index') }}">
                        <i class="fa-solid fa-home"></i> Início
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="{{ route('spin.index') }}">
                        <i class="fa-solid fa-gift"></i> Roleta
                    </a>
                </li>
                <li class="nav-item position-relative">
                    <a class="nav-link nav-link-custom" href="{{ route('loja.cart') }}">
                        <i class="fa-solid fa-cart-shopping fa-lg"></i>
                        @if(session('cart_count', 0) > 0)
                            <span class="cart-badge">{{ session('cart_count') }}</span>
                        @endif
                    </a>
                </li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle nav-link-custom" href="#" data-bs-toggle="dropdown">
                            <i class="fa-regular fa-user"></i> {{ auth()->user()->nome ?? auth()->user()->email }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('pedidos.index') }}">Meus Pedidos</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">
                            <i class="fa-regular fa-circle-user"></i> Entrar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Samsung Store</h5>
                <p class="text-muted">A melhor experiência em tecnologia.</p>
            </div>
            <div class="col-md-4">
                <h5>Links Úteis</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-muted text-decoration-none">Sobre Nós</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Política de Privacidade</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Termos de Uso</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contato</h5>
                <p class="text-muted">
                    <i class="fa-regular fa-envelope"></i> contato@samsungstore.com<br>
                    <i class="fa-solid fa-phone"></i> (11) 4002-8922
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>