{{-- resources/views/BL/sae.blade.php --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sae Itoshi - Blue Lock Wiki</title>
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
            --sae-maroon: #8b3a3a;
            --sae-teal: #4dd0e1;
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
            background: linear-gradient(90deg, transparent, var(--sae-teal), transparent);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #fff 30%, var(--sae-teal) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .breadcrumb-custom {
            color: rgba(255,255,255,0.4);
            font-size: 0.85rem;
        }

        .breadcrumb-custom a {
            color: var(--sae-teal);
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
            border: 2px solid rgba(77,208,225,0.3);
            box-shadow: 0 20px 60px rgba(77,208,225,0.2);
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
            color: var(--sae-teal);
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-block;
            background: rgba(77,208,225,0.1);
            padding: 4px 16px;
            border-radius: 20px;
            border: 1px solid rgba(77,208,225,0.2);
            margin-bottom: 15px;
        }

        .character-quote {
            font-style: italic;
            color: rgba(255,255,255,0.7);
            font-size: 1.05rem;
            padding: 16px 20px;
            background: rgba(255,255,255,0.03);
            border-radius: 12px;
            border-left: 3px solid var(--sae-teal);
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
            color: var(--sae-teal);
            font-size: 1.1rem;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, var(--sae-teal), transparent);
            margin: 30px 0;
        }

        .skill-tag {
            display: inline-block;
            background: rgba(77,208,225,0.15);
            color: #80deea;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(77,208,225,0.2);
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
            border-left: 3px solid var(--sae-teal);
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
            background: var(--sae-teal);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #80deea;
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
                    <span style="color: rgba(255,255,255,0.6);">Sae Itoshi</span>
                </div>
                <h1 class="page-title mt-2">Sae Itoshi</h1>
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
                        <img src="{{ asset('images/cubo/Sae.jpg') }}" alt="Sae Itoshi" class="character-image">
                        <h2 class="character-name mt-3">
                            Sae Itoshi
                            <span class="character-name-jp">糸師 冴</span>
                        </h2>
                        <div class="character-title">
                            <i class="fa-solid fa-crown me-1"></i>
                            "O Prodígio"
                        </div>
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <div class="label">Gênero</div>
                            <div class="value"><i class="fa-regular fa-circle"></i> Masculino</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Idade</div>
                            <div class="value"><i class="fa-regular fa-calendar"></i> 18 anos</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Aniversário</div>
                            <div class="value"><i class="fa-regular fa-cake"></i> 10 de Outubro</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Altura</div>
                            <div class="value"><i class="fa-regular fa-ruler"></i> 180 cm</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Tipo Sanguíneo</div>
                            <div class="value"><i class="fa-solid fa-droplet"></i> A</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Nacionalidade</div>
                            <div class="value"><i class="fa-solid fa-flag"></i> Japão</div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Afiliação
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">Re Al (Youth)</span>
                            <span class="skill-tag">Japão U-20</span>
                            <span class="skill-tag">New Generation World XI</span>
                            <span class="skill-tag">Buratsuta 3</span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Posição
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">
                                <i class="fa-solid fa-people-arrows me-1"></i> Central Midfielder
                            </span>
                            <span class="skill-tag">
                                <i class="fa-solid fa-arrow-up me-1"></i> Playmaker
                            </span>
                            <span class="skill-tag">
                                <i class="fa-solid fa-arrow-right me-1"></i> Offensive Midfielder
                            </span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Número da Camisa
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">
                                <i class="fa-solid fa-shirt me-1"></i> #10 (Japão U-20)
                            </span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Pé Dominante
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag">
                                <i class="fa-solid fa-shoe-prints me-1"></i> Esquerdo
                            </span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Família
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag">Rin Itoshi (Irmão)</span>
                            <span class="skill-tag">Pai (não nomeado)</span>
                            <span class="skill-tag">Mãe (não nomeada)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLUNA DIREITA -->
            <div class="col-lg-8">
                <!-- Citação -->
                <div class="character-quote">
                    <i class="fa-solid fa-quote-left me-2" style="color:var(--sae-teal); opacity:0.5;"></i>
                    "My singular interest is in becoming the best in the world. There is a fundamentally different depth to our greed."
                    <span style="display:block; font-size:0.8rem; color:rgba(255,255,255,0.3); margin-top:4px;">
                        — Sae para Sendo, Capítulo 110
                    </span>
                </div>

                <!-- Visão Geral -->
                <div class="section-title mt-4">
                    <i class="fa-solid fa-circle-info"></i>
                    Visão Geral
                </div>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    <strong>Sae Itoshi</strong> (糸師 冴 <em>Itoshi Sae</em>) é um jogador de futebol prodígio conhecido como 
                    o <strong>melhor jogador do Japão</strong>. Sae também é membro da <strong>New Generation World XI</strong>, 
                    além de ser do time juvenil do <strong>Re Al</strong>. Ele é o irmão mais velho de <strong>Rin Itoshi</strong>.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    No início da série, Sae está no Japão apenas para renovar seu passaporte, mas depois de ouvir sobre 
                    o <strong>Projeto Blue Lock</strong>, ele decide ficar. Mais tarde, ele se junta à seleção japonesa 
                    Sub-20 para enfrentar o <strong>Blue Lock Eleven</strong> na partida do Japão Sub-20. Após a 
                    conclusão da partida, Sae retorna à Espanha, mas se junta à recém-construída seleção japonesa 
                    Sub-20 na Copa do Mundo PIFA Sub-20 como parte do <strong>Buratsuta 3</strong>, para poder desafiar 
                    a Espanha Sub-20 e finalmente triunfar sobre seu <strong>adversário de longa data, Bunny Iglesias</strong>.
                </p>

                <div class="section-divider"></div>

                <!-- Personalidade -->
                <div class="section-title">
                    <i class="fa-solid fa-brain"></i>
                    Personalidade
                </div>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Desde jovem, Sae sempre foi <strong>frio, direto e sério</strong>. Ele só se importou em se tornar 
                    o melhor meio-campista do mundo e só teve tempo para coisas que o aproximassem de seu objetivo. 
                    Sae também pode ser <strong>arrogante e condescendente</strong>, menosprezando os outros, mesmo que 
                    sejam mais velhos que ele e tenham autoridade organizacional.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Sae é <strong>orgulhoso</strong> como jogador de futebol, menosprezando o futebol japonês e todos 
                    os que participam dele. Sae afirma que preferiria morrer ou jogar na Europa com um bando de 
                    estudantes universitários do que jogar na J-League ou na Seleção Japonesa. Ele é muito 
                    <strong>confiante em suas habilidades</strong> e acredita que ninguém no Japão é digno de suas 
                    habilidades como companheiro de equipe. Ele não gosta do fato de ter nascido no Japão, dizendo 
                    que simplesmente nasceu no país errado.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Durante a infância, Sae é mostrado como sendo muito mais <strong>amigável, carinhoso e amoroso</strong> 
                    com seu irmão Rin. Ele até assumiu a responsabilidade por Rin ter destruído seus brinquedos. 
                    Sae mostrou preocupação quando Rin disse que queria lutar contra um oponente mais forte, 
                    destruí-los e morrer.
                </p>

                <div class="section-divider"></div>

                <!-- Habilidades -->
                <div class="section-title">
                    <i class="fa-solid fa-star"></i>
                    Habilidades
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-futbol text-warning me-1"></i> Técnica de Chute Perfeita
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Sae tem a capacidade de controlar a <strong>intensidade, ângulo, velocidade e precisão</strong> 
                        de seus chutes em um nível extremo. Ele é capaz de realizar passes complexos usando sua 
                        técnica superior, manipulando a bola perfeitamente para que seus passes sejam fáceis de 
                        receber, mas difíceis de interceptar.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-arrows-spin text-warning me-1"></i> Reflex
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Com seus <strong>reflexos incríveis</strong>, Sae pode levar em conta todas as condições do 
                        campo e tomar decisões decisivas para levar a bola adiante e colocá-la nas mãos dos atacantes 
                        da melhor maneira possível. Sae determina quem tem a maior flexibilidade de finalização em 
                        direção ao gol e joga a bola para eles.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-eye text-warning me-1"></i> Metavision
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Sae usa sua visão evoluída para ter uma <strong>perspectiva onisciente do campo</strong>, 
                        consumindo constantemente informações de sua visão central e periférica para dominar o campo.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-fire text-warning me-1"></i> Flow State
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Sae entrou em Flow durante os últimos minutos da partida Blue Lock vs Japão Sub-20, onde 
                        ficou sério. Seu drible melhorou drasticamente, permitindo-lhe passar por Nagi e Barou.
                    </div>
                </div>

                <div class="d-flex flex-wrap">
                    <span class="skill-tag skill-tag-gold"><i class="fa-solid fa-futbol me-1"></i> Técnica de Chute Perfeita</span>
                    <span class="skill-tag"><i class="fa-solid fa-arrows-spin me-1"></i> Reflex</span>
                    <span class="skill-tag"><i class="fa-solid fa-eye me-1"></i> Metavision</span>
                    <span class="skill-tag"><i class="fa-solid fa-fire me-1"></i> Flow State</span>
                    <span class="skill-tag"><i class="fa-solid fa-person-running me-1"></i> Counter-Dribbling</span>
                    <span class="skill-tag"><i class="fa-solid fa-arrow-right me-1"></i> Trivela</span>
                    <span class="skill-tag"><i class="fa-solid fa-arrows-spin me-1"></i> Hyperspeed Scissors</span>
                </div>

                <div class="section-divider"></div>

                <!-- Frases -->
                <div class="section-title">
                    <i class="fa-solid fa-quote-right"></i>
                    Frases Famosas
                </div>
                <div class="quote-block">
                    <div class="text">"Meu único interesse é me tornar o melhor do mundo. Há uma profundidade fundamentalmente diferente em nossa ganância."</div>
                    <div class="source">— Sae para Sendo, Capítulo 110</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Quem é esse gordo e esse dupla de bob-cut?... Bem, isso acelera as coisas. Ei, velhos. Eu verifiquei os vídeos de todos aqueles jogadores do Japão Sub-20... todos são uma merda, especialmente os atacantes. Eles são um grande monte de larvas de insetos fedidos."</div>
                    <div class="source">— Sae para Buratsuta e Hoichi, Capítulo 107</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Então, enquanto você ainda estiver obcecado por ser meu irmão, nunca conseguirá me superar."</div>
                    <div class="source">— Sae para Rin, Capítulo 123</div>
                </div>
                <div class="quote-block">
                    <div class="text">"O mundo é enorme. Há jogadores melhores que eu lá fora. Mudei meu sonho; em vez de me tornar o melhor atacante, vou me tornar o melhor meio-campista do mundo."</div>
                    <div class="source">— Sae para Rin, Capítulo 124</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Vou aumentar o nível do jogo. Apenas os idiotas que conseguirem me acompanhar... verão a paisagem que vem a seguir."</div>
                    <div class="source">— Sae para Blue Lock 11, Capítulo 139</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Acontece que eu estava errado. Eu pensei que o Japão era incapaz de dar à luz atacantes decentes. Aquele que será capaz de mudar o futebol neste país... é Yoichi Isagi."</div>
                    <div class="source">— Sae para Rin, Capítulo 148</div>
                </div>

                <div class="section-divider"></div>

                <!-- Curiosidades -->
                <div class="section-title">
                    <i class="fa-regular fa-lightbulb"></i>
                    Curiosidades
                </div>
                <ul class="trivia-list">
                    <li><strong>Signo:</strong> Libra</li>
                    <li><strong>Cidade Natal:</strong> Kamakura, Província de Kanagawa</li>
                    <li><strong>Tamanho do Pé:</strong> 26.5 cm</li>
                    <li><strong>Começou a jogar futebol:</strong> Aos 1 ano</li>
                    <li><strong>Jogador Favorito:</strong> Álvaro Recoba</li>
                    <li><strong>Voltou ao Japão:</strong> Para renovar seu passaporte</li>
                    <li><strong>Hobby:</strong> Analisar dados de jogadores e times de futebol</li>
                    <li><strong>Comida Favorita:</strong> Chá de algas salgado</li>
                    <li><strong>Comida Detestada:</strong> Batatas fritas</li>
                    <li><strong>Música Favorita:</strong> Tofubeats - Suisei (feat. Seira Kariya)</li>
                    <li><strong>Mangá Favorito:</strong> GeGeGe no Kitaro</li>
                    <li><strong>Programa de TV Favorito:</strong> Chibi Maruko-chan</li>
                    <li><strong>Animal Favorito:</strong> Gaivota</li>
                    <li><strong>Filme Favorito:</strong> Taxi Driver</li>
                    <li><strong>Estação Favorita:</strong> Fim do verão</li>
                    <li><strong>Dorme:</strong> 8 horas (7 horas + 1 hora de cochilo)</li>
                    <li><strong>Fetiche:</strong> Bundas (acredita que a habilidade de um atleta pode ser determinada olhando para ela)</li>
                    <li><strong>Se tivesse 100 milhões de ienes:</strong> "Não estou interessado em uma quantia tão pequena de dinheiro"</li>
                    <li><strong>Rotina matinal:</strong> Abrir a janela, respirar fundo, ioga matinal, meditação, beber kombucha salgada e começar o dia</li>
                    <li><strong>Classificação:</strong> Sae ficou em 12º lugar na primeira pesquisa de popularidade com 336 votos</li>
                    <li><strong>Quando ri:</strong> "Todos os dias. Mostrar no rosto não é a única maneira de rir. Eu rio por dentro."</li>
                </ul>

                <!-- Egoist Bible -->
                <div style="margin-top:16px; background:rgba(77,208,225,0.03); padding:16px 20px; border-radius:12px; border:1px solid rgba(77,208,225,0.08);">
                    <div style="font-size:0.75rem; text-transform:uppercase; color:var(--sae-teal); font-weight:700; letter-spacing:0.5px;">
                        <i class="fa-solid fa-book me-1"></i> Egoist Bible
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Ponto forte:</strong> Pode permanecer neutro em qualquer situação
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Ponto fraco:</strong> Não sabe nada além de futebol
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Gasta o tempo livre:</strong> Olhando para o mar
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Último dia na Terra:</strong> Faria o melhor passe do mundo para o melhor atacante do mundo
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Aparições -->
                <div class="section-title">
                    <i class="fa-regular fa-clock"></i>
                    Aparições no Mangá
                </div>
                <div class="d-flex flex-wrap gap-2 mb-2">
                    <span class="skill-tag skill-tag-gold">Introduction Arc</span>
                    <span class="skill-tag skill-tag-gold">First Selection</span>
                    <span class="skill-tag skill-tag-gold">Second Selection</span>
                    <span class="skill-tag skill-tag-gold">Third Selection</span>
                    <span class="skill-tag skill-tag-gold">U-20 Arc</span>
                    <span class="skill-tag skill-tag-gold">Neo Egoist League</span>
                    <span class="skill-tag skill-tag-gold">U-20 World Cup</span>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <span class="skill-tag">Capítulo 4</span>
                    <span class="skill-tag">Capítulo 107</span>
                    <span class="skill-tag">Capítulo 110</span>
                    <span class="skill-tag">Capítulo 115</span>
                    <span class="skill-tag">Capítulo 123</span>
                    <span class="skill-tag">Capítulo 124</span>
                    <span class="skill-tag">Capítulo 139</span>
                    <span class="skill-tag">Capítulo 148</span>
                </div>

                <div class="section-divider"></div>

                <!-- Dublagem -->
                <div class="section-title">
                    <i class="fa-solid fa-microphone"></i>
                    Dublagem
                </div>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div style="background:rgba(255,255,255,0.03); padding:12px 16px; border-radius:12px; border:1px solid rgba(255,255,255,0.05);">
                            <div style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                                <i class="fa-solid fa-flag-japan me-1"></i> Japonês
                            </div>
                            <div style="font-size:1rem; font-weight:700; color:white;">Takahiro Sakurai</div>
                            <div style="font-size:0.8rem; color:rgba(255,255,255,0.4);">Yūko Sanpei (Jovem)</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div style="background:rgba(255,255,255,0.03); padding:12px 16px; border-radius:12px; border:1px solid rgba(255,255,255,0.05);">
                            <div style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                                <i class="fa-solid fa-flag-usa me-1"></i> Inglês
                            </div>
                            <div style="font-size:1rem; font-weight:700; color:white;">Alejandro Saab</div>
                            <div style="font-size:0.8rem; color:rgba(255,255,255,0.4);">Suzanne DeCarma (Jovem)</div>
                        </div>
                    </div>
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