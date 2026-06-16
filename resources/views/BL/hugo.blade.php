{{-- resources/views/BL/hugo.blade.php --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vivian Hugo - Blue Lock Wiki</title>
    <link rel="icon" href="{{ asset('Logo1.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-purple: #6f42c1;
            --soft-purple: #f3f0ff;
            --dark-purple: #2d1b4e;
            --gold: #ffd700;
            --dark-bg: #0a0a1a;
            --card-bg: rgba(255,255,255,0.05);
            --hugo-red: #8b1a1a;
            --hugo-burgundy: #6b1a2a;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body { 
            background: linear-gradient(135deg, #0a0a1a 0%, #1a0533 50%, #0d0d2b 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #ffffff;
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar-custom { 
            background: rgba(10, 10, 26, 0.95);
            padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: 1px;
            color: white !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand .brand-icon {
            width: 36px; height: 36px;
            background: var(--primary-purple);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }

        .nav-item-custom {
            color: rgba(255,255,255,0.6) !important;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .nav-item-custom:hover {
            color: white !important;
            background: rgba(255,255,255,0.05);
        }

        .nav-item-custom.active {
            color: white !important;
            background: var(--primary-purple);
        }

        /* HERO */
        .hero-section {
            padding: 40px 0 30px;
            position: relative;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--hugo-red), transparent);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #fff 30%, var(--hugo-red) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .breadcrumb-custom {
            color: rgba(255,255,255,0.4);
            font-size: 0.85rem;
        }

        .breadcrumb-custom a {
            color: var(--hugo-red);
            text-decoration: none;
        }

        /* CONTEÚDO PRINCIPAL */
        .main-content {
            padding: 30px 0 60px;
        }

        .character-card {
            background: var(--card-bg);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: blur(10px);
        }

        .character-image {
            width: 100%;
            max-width: 300px;
            border-radius: 16px;
            border: 2px solid rgba(139,26,26,0.3);
            box-shadow: 0 20px 60px rgba(139,26,26,0.2);
        }

        .character-name {
            font-size: 2.2rem;
            font-weight: 900;
            color: white;
            margin-bottom: 4px;
        }

        .character-name-jp {
            font-size: 1rem;
            color: rgba(255,255,255,0.4);
            font-weight: 400;
        }

        .character-title {
            color: var(--hugo-red);
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-block;
            background: rgba(139,26,26,0.1);
            padding: 4px 16px;
            border-radius: 20px;
            border: 1px solid rgba(139,26,26,0.2);
            margin-bottom: 15px;
        }

        .character-quote {
            font-style: italic;
            color: rgba(255,255,255,0.7);
            font-size: 1.05rem;
            padding: 16px 20px;
            background: rgba(255,255,255,0.03);
            border-radius: 12px;
            border-left: 3px solid var(--hugo-red);
            margin: 15px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 12px;
            margin: 20px 0;
        }

        .info-item {
            background: rgba(255,255,255,0.03);
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .info-item .label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .info-item .value {
            font-size: 0.95rem;
            font-weight: 700;
            color: white;
            margin-top: 2px;
        }

        .info-item .value i {
            margin-right: 6px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: white;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--hugo-red);
            font-size: 1.1rem;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, var(--hugo-red), transparent);
            margin: 30px 0;
        }

        .skill-tag {
            display: inline-block;
            background: rgba(139,26,26,0.15);
            color: #ff8a8a;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(139,26,26,0.2);
            margin: 4px 6px 4px 0;
        }

        .skill-tag-gold {
            background: rgba(255,215,0,0.1);
            color: var(--gold);
            border-color: rgba(255,215,0,0.2);
        }

        .trivia-list {
            list-style: none;
            padding: 0;
        }

        .trivia-list li {
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            color: rgba(255,255,255,0.8);
            font-size: 0.92rem;
        }

        .trivia-list li:last-child {
            border-bottom: none;
        }

        .trivia-list li strong {
            color: white;
        }

        .quote-block {
            background: rgba(255,255,255,0.03);
            padding: 16px 20px;
            border-radius: 12px;
            border-left: 3px solid var(--hugo-red);
            margin-bottom: 12px;
        }

        .quote-block .text {
            font-style: italic;
            color: rgba(255,255,255,0.8);
            font-size: 0.95rem;
        }

        .quote-block .source {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.3);
            margin-top: 4px;
        }

        footer {
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 20px 0;
            margin-top: 40px;
        }

        footer .text-muted {
            color: rgba(255,255,255,0.3) !important;
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .page-title { font-size: 1.8rem; }
            .character-name { font-size: 1.6rem; }
            .character-image { max-width: 200px; }
            .info-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 576px) {
            .info-grid { grid-template-columns: 1fr; }
            .character-card { padding: 20px; }
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0a0a1a;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--hugo-red);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #b32020;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar-custom">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="/inicio">
                <div class="brand-icon">
                    <i class="fa-solid fa-futbol" style="color:white; font-size:0.9rem;"></i>
                </div>
                Blue Lock Wiki
            </a>
            <div class="d-flex gap-2">
                <a href="/inicio" class="nav-item-custom">Início</a>
                <a href="#" class="nav-item-custom active">Wiki</a>
                <a href="#" class="nav-item-custom">Explorar</a>
                <a href="#" class="nav-item-custom">Personagens</a>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="breadcrumb-custom">
                    <i class="fa-regular fa-file-lines me-1"></i>
                    <a href="/inicio">Blue Lock Wiki</a> › 
                    <a href="#">Personagens</a> › 
                    <span style="color: rgba(255,255,255,0.6);">Vivian Hugo</span>
                </div>
                <h1 class="page-title mt-2">Vivian Hugo</h1>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn btn-outline-light btn-sm" style="border-radius:50px; padding:6px 18px; font-size:0.8rem; border-color:rgba(255,255,255,0.1);">
                    <i class="fa-regular fa-bookmark me-1"></i> Salvar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- CONTEÚDO PRINCIPAL -->
<div class="main-content">
    <div class="container">
        <div class="row">
            <!-- COLUNA ESQUERDA -->
            <div class="col-lg-4 mb-4">
                <div class="character-card">
                    <div class="text-center">
                        <img src="{{ asset('images/cubo/Hugo.jpg') }}" alt="Vivian Hugo" class="character-image">
                        <h2 class="character-name mt-3">
                            Vivian Hugo
                            <span class="character-name-jp">ビビアン・ユーゴー</span>
                        </h2>
                        <div class="character-title">
                            <i class="fa-solid fa-chess-queen me-1"></i>
                            "O Gênio da Lógica"
                        </div>
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <div class="label">Gênero</div>
                            <div class="value"><i class="fa-regular fa-circle"></i> Masculino</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Idade</div>
                            <div class="value"><i class="fa-regular fa-calendar"></i> 19 anos</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Aniversário</div>
                            <div class="value"><i class="fa-regular fa-cake"></i> 6 de Junho</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Altura</div>
                            <div class="value"><i class="fa-regular fa-ruler"></i> 187 cm</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Tipo Sanguíneo</div>
                            <div class="value"><i class="fa-solid fa-droplet"></i> B</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Nacionalidade</div>
                            <div class="value"><i class="fa-solid fa-flag"></i> França</div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Afiliação
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">Arsenaly</span>
                            <span class="skill-tag">França U-20</span>
                            <span class="skill-tag">New Generation World XI</span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Posição
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">
                                <i class="fa-solid fa-people-arrows me-1"></i> Center Midfielder
                            </span>
                            <span class="skill-tag">
                                <i class="fa-solid fa-shield-halved me-1"></i> Midfield General
                            </span>
                            <span class="skill-tag">
                                <i class="fa-solid fa-shield me-1"></i> Defensive Midfielder
                            </span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Número da Camisa
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">
                                <i class="fa-solid fa-shirt me-1"></i> #9 (França U-18 & França U-20)
                            </span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Pé Dominante
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag">
                                <i class="fa-solid fa-shoe-prints me-1"></i> Direito
                            </span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Família
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag">Pai (não nomeado)</span>
                            <span class="skill-tag">Mãe (não nomeada)</span>
                            <span class="skill-tag">Irmã mais velha</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLUNA DIREITA -->
            <div class="col-lg-8">
                <!-- Citação -->
                <div class="character-quote">
                    <i class="fa-solid fa-quote-left me-2" style="color:var(--hugo-red); opacity:0.5;"></i>
                    "I will win the World Cup four times... and become one of humanity's legends."
                    <span style="display:block; font-size:0.8rem; color:rgba(255,255,255,0.3); margin-top:4px;">
                        — Hugo para Isagi, Capítulo 338
                    </span>
                </div>

                <!-- Visão Geral -->
                <div class="section-title mt-4">
                    <i class="fa-solid fa-circle-info"></i>
                    Visão Geral
                </div>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    <strong>Vivian Hugo</strong> (ビビアン・ユーゴー <em>Bibian Yūgō</em>) é um jogador de futebol prodígio conhecido 
                    como um dos melhores jogadores da França. Hugo também é membro da <strong>New Generation World XI</strong>, 
                    além de ser o centroavante do <strong>Arsenaly</strong> e um <strong>meio-campista central</strong> na 
                    seleção francesa Sub-20 na Copa do Mundo PIFA Sub-20.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Ele é considerado um dos talentos mais promissores do mundo do futebol e, ao contrário de outros 
                    atacantes profissionais, ele só está interessado em se tornar o <strong>segundo melhor jogador do mundo</strong>, 
                    operando como uma <strong>"sombra"</strong> para Julien Loki, facilitando o sucesso da equipe, tudo para 
                    vencer a <strong>Copa do Mundo quatro vezes</strong> e finalmente superar o recorde de três títulos de Pelé. 
                    Notavelmente, ele desenvolveu a <strong>Teoria do Destino Adequado</strong>.
                </p>

                <div class="section-divider"></div>

                <!-- Personalidade -->
                <div class="section-title">
                    <i class="fa-solid fa-brain"></i>
                    Personalidade
                </div>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Hugo acredita em uma abordagem <strong>estrita, lógica e quase fatalista</strong> para o futebol. 
                    Desde a infância, Hugo acreditava que os indivíduos nascem com traços específicos adequados para 
                    um determinado papel e que qualquer tentativa de refutar esse destino apenas cria luta desnecessária. 
                    Ao contrário dos egoístas que querem destruir os outros, Hugo não tem má vontade para com seus 
                    oponentes, até agindo como um <strong>mentor</strong> com sua orientação.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Ele acha lógico que Isagi se destaque em sua posição natural e ordenada de <strong>número dois</strong> 
                    em vez de jogar como atacante. Suas contribuições estoicas, porém lógicas, muitas vezes enfurecem 
                    companheiros de equipe e oponentes por abordarem suas falhas. Hugo permanece <strong>calmo, indiferente 
                    e analítico</strong> mesmo em momentos de alta pressão.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Ao falar sobre ser o segundo melhor do mundo, Hugo explica que seu objetivo vai muito além das 
                    conquistas individuais. Ele quer <strong>vencer quatro Copas do Mundo</strong> e gravar seu nome na 
                    história como seu ego. Ele afirma que ser atacante não é para ele; em vez disso, <strong>moldar atacantes</strong> 
                    é sua verdadeira vocação. Hugo também proclama que nasceu para <strong>mudar os outros</strong> e, ao 
                    fazer isso, mudar o mundo.
                </p>

                <div class="section-divider"></div>

                <!-- Habilidades -->
                <div class="section-title">
                    <i class="fa-solid fa-star"></i>
                    Habilidades
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-arrows-left-right text-warning me-1"></i> Warp Synchronicity
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Um movimento combinado de Hugo e Loki que utiliza seus talentos. Hugo entrega um 
                        <strong>passe preciso com backspin</strong> (8.5 m/s), enquanto Loki corre em alta velocidade 
                        para alcançar a bola e finalizar. Esta combinação é tão rápida que nem Aiku e Gagamaru 
                        conseguiram pará-la.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-eye text-warning me-1"></i> Metavision
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Um termo usado para descrever a visão evoluída de um jogador que lhes dá uma 
                        <strong>perspectiva calculada do campo</strong>. Usando seus olhos para processar constantemente 
                        informações de sua visão central e periférica, Hugo usou Metavision para identificar 
                        o chute perfeito para seu gol, usando Charles e Loki como iscas.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-arrow-right text-warning me-1"></i> Pinpoint Backspin Pass
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Hugo entrega um <strong>passe poderoso e preciso</strong> com backspin para um local muitas vezes 
                        impossível de alcançar, mesmo que o movimento fosse lido. A velocidade deste passe é de 
                        <strong>8.5 m/s</strong>. O único destinatário deste passe é Loki devido à sua velocidade incrível.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-people-group text-warning me-1"></i> Loophole Dribble
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Usando Camus e Leyden como <strong>iscas de passe</strong>, Hugo avança pelo campo enquanto os 
                        defensores lutam para antecipar a próxima ação de Hugo. Esta jogada levou a um gol durante 
                        o jogo entre França e Japão.
                    </div>
                </div>

                <div class="d-flex flex-wrap">
                    <span class="skill-tag skill-tag-gold"><i class="fa-solid fa-arrows-left-right me-1"></i> Warp Synchronicity</span>
                    <span class="skill-tag"><i class="fa-solid fa-eye me-1"></i> Metavision</span>
                    <span class="skill-tag"><i class="fa-solid fa-arrow-right me-1"></i> Pinpoint Backspin Pass</span>
                    <span class="skill-tag"><i class="fa-solid fa-people-group me-1"></i> Loophole Dribble</span>
                    <span class="skill-tag"><i class="fa-solid fa-arrow-rotate-right me-1"></i> Counter Pass</span>
                    <span class="skill-tag"><i class="fa-solid fa-brain me-1"></i> Logical Thinking</span>
                </div>

                <div class="section-divider"></div>

                <!-- Frases -->
                <div class="section-title">
                    <i class="fa-solid fa-quote-right"></i>
                    Frases Famosas
                </div>
                <div class="quote-block">
                    <div class="text">"Diga, você... acredita em destino?"</div>
                    <div class="source">— Hugo para Isagi, Capítulo 332</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Venha e seja o número dois, Isagi Yoichi. Se você viver seu destino como o número dois... Blue Lock ainda pode se tornar mais forte. Mas se continuar perseguindo o sonho de se tornar o melhor atacante do mundo... Blue Lock será destruído aqui mesmo."</div>
                    <div class="source">— Hugo para Isagi, Capítulo 333</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Para ver uma vista que não pode ser alcançada sozinho... Eu quero me tornar o número dois do mundo. Não quero dizer segundo lugar. Estou falando de supervisionar e manipular a organização do segundo lugar mais alto. Sendo aquele que entende o número um melhor do que ninguém, um ser igual..."</div>
                    <div class="source">— Hugo, Capítulo 333</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Está bem, Loki. Duvido que esta partida termine assim. Vai ficar complicado. Parece... que o Blue Lock escolheu esse destino."</div>
                    <div class="source">— Hugo para Loki, Capítulo 339</div>
                </div>
                <div class="quote-block">
                    <div class="text">"No final do dia... os talentosos e os sem talento nunca podem se entender."</div>
                    <div class="source">— Hugo para Loki, Capítulo 343</div>
                </div>

                <div class="section-divider"></div>

                <!-- Curiosidades -->
                <div class="section-title">
                    <i class="fa-regular fa-lightbulb"></i>
                    Curiosidades
                </div>
                <ul class="trivia-list">
                    <li><strong>Signo:</strong> Gêmeos</li>
                    <li><strong>Cidade Natal:</strong> Lyon, França</li>
                    <li><strong>Tamanho do Pé:</strong> 29 cm</li>
                    <li><strong>Começou a jogar futebol:</strong> Aos 2 anos</li>
                    <li><strong>Jogador Favorito:</strong> Patrick Vieira</li>
                    <li><strong>Lema:</strong> "A aptidão é o destino. Viva seu destino. Então, a vida brilhará."</li>
                    <li><strong>Cor Favorita:</strong> Destiny Bordaux</li>
                    <li><strong>Hobby:</strong> Ler um livro em branco (ajuda a pensar)</li>
                    <li><strong>Animal Favorito:</strong> Papillon (borboleta/mariposa)</li>
                    <li><strong>Estação Favorita:</strong> Inverno ("Porque eu gosto de mangas compridas")</li>
                    <li><strong>Comida Favorita:</strong> Éclairs ("Eles testam a habilidade do confeiteiro")</li>
                    <li><strong>Comida Detestada:</strong> Abacate ("São moles e cheiram a vegetais crus")</li>
                    <li><strong>Filme Favorito:</strong> Life Is Beautiful</li>
                    <li><strong>Mangá Favorito:</strong> Cyborg 009</li>
                    <li><strong>O que o faz feliz:</strong> Ter suas ideias aceitas</li>
                    <li><strong>O que o faz triste:</strong> Abandonar sua aptidão</li>
                    <li><strong>Referência:</strong> Hugo parece ser uma referência a Hugo Cabret do livro "A Invenção de Hugo Cabret"</li>
                    <li><strong>Curiosidade:</strong> Hugo é um dos membros da New Generation World XI que não participou da Neo Egoist League</li>
                    <li><strong>Pose do Volume:</strong> Simula uma mão de robô de 3 dedos (comum em robôs de ficção científica)</li>
                </ul>

                <!-- Volume 38 Omake -->
                <div style="margin-top:16px; background:rgba(139,26,26,0.03); padding:16px 20px; border-radius:12px; border:1px solid rgba(139,26,26,0.08);">
                    <div style="font-size:0.75rem; text-transform:uppercase; color:var(--hugo-red); font-weight:700; letter-spacing:0.5px;">
                        <i class="fa-solid fa-book me-1"></i> Volume 38 Omake
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>O que o faz feliz:</strong> Ter suas ideias aceitas. ("Agora, por que você não tenta confiar no seu destino também?")
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>O que o faz triste:</strong> Abandonar sua aptidão. ("Não acho que haja futuro para uma pessoa que não considera quem ela é.")
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Motto:</strong> "Aptitude is destiny. Live your destiny. Then, life will shine."
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Aparições -->
                <div class="section-title">
                    <i class="fa-regular fa-clock"></i>
                    Aparições no Mangá
                </div>
                <div class="d-flex flex-wrap gap-2 mb-2">
                    <span class="skill-tag skill-tag-gold">U-20 World Cup Arc</span>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <span class="skill-tag">Capítulo 326</span>
                    <span class="skill-tag">Capítulo 330</span>
                    <span class="skill-tag">Capítulo 332</span>
                    <span class="skill-tag">Capítulo 333</span>
                    <span class="skill-tag">Capítulo 338</span>
                    <span class="skill-tag">Capítulo 339</span>
                    <span class="skill-tag">Capítulo 343</span>
                    <span class="skill-tag">Capítulo 345</span>
                    <span class="skill-tag">Capítulo 347</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="text-muted">
                <i class="fa-regular fa-copyright me-1"></i>
                2026 Blue Lock Wiki. Conteúdo sob CC-BY-SA.
            </div>
            <div class="d-flex gap-3">
                <a href="#" class="text-muted" style="text-decoration:none; font-size:0.8rem;">
                    <i class="fa-brands fa-discord me-1"></i> Discord
                </a>
                <a href="#" class="text-muted" style="text-decoration:none; font-size:0.8rem;">
                    <i class="fa-brands fa-twitter me-1"></i> Twitter
                </a>
                <a href="#" class="text-muted" style="text-decoration:none; font-size:0.8rem;">
                    <i class="fa-brands fa-github me-1"></i> GitHub
                </a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>