{{-- resources/views/BL/loki.blade.php --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Julien Loki - Blue Lock Wiki</title>
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
            background: linear-gradient(90deg, transparent, var(--primary-purple), transparent);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #fff 30%, var(--gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .breadcrumb-custom {
            color: rgba(255,255,255,0.4);
            font-size: 0.85rem;
        }

        .breadcrumb-custom a {
            color: var(--primary-purple);
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
            border: 2px solid rgba(255,215,0,0.2);
            box-shadow: 0 20px 60px rgba(111,66,193,0.2);
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
            color: var(--gold);
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-block;
            background: rgba(255,215,0,0.1);
            padding: 4px 16px;
            border-radius: 20px;
            border: 1px solid rgba(255,215,0,0.15);
            margin-bottom: 15px;
        }

        .character-quote {
            font-style: italic;
            color: rgba(255,255,255,0.7);
            font-size: 1.05rem;
            padding: 16px 20px;
            background: rgba(255,255,255,0.03);
            border-radius: 12px;
            border-left: 3px solid var(--gold);
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
            color: var(--gold);
            font-size: 1.1rem;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, var(--primary-purple), transparent);
            margin: 30px 0;
        }

        .skill-tag {
            display: inline-block;
            background: rgba(111,66,193,0.15);
            color: #c9b0ff;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(111,66,193,0.2);
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
            border-left: 3px solid var(--primary-purple);
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
            background: var(--primary-purple);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #8b5cf6;
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
                    <span style="color: rgba(255,255,255,0.6);">Julien Loki</span>
                </div>
                <h1 class="page-title mt-2">Julien Loki</h1>
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
            <!-- COLUNA ESQUERDA - IMAGEM E INFO BÁSICA -->
            <div class="col-lg-4 mb-4">
                <div class="character-card">
                    <div class="text-center">
                        <img src="{{ asset('images/cubo/Loki.jpg') }}" alt="Julien Loki" class="character-image">
                        <h2 class="character-name mt-3">
                            Julien Loki
                            <span class="character-name-jp">ジュリアン・ロキ</span>
                        </h2>
                        <div class="character-title">
                            <i class="fa-solid fa-bolt me-1"></i>
                            "O Deus da Velocidade"
                        </div>
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <div class="label">Gênero</div>
                            <div class="value"><i class="fa-regular fa-circle"></i> Masculino</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Idade</div>
                            <div class="value"><i class="fa-regular fa-calendar"></i> 17-18 anos</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Aniversário</div>
                            <div class="value"><i class="fa-regular fa-cake"></i> 9 de Junho</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Altura</div>
                            <div class="value"><i class="fa-regular fa-ruler"></i> 178 cm</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Tipo Sanguíneo</div>
                            <div class="value"><i class="fa-solid fa-droplet"></i> AB</div>
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
                            <span class="skill-tag skill-tag-gold">Paris X Gen</span>
                            <span class="skill-tag">França U-20</span>
                            <span class="skill-tag">New Generation World XI</span>
                            <span class="skill-tag">Team World 5</span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Posição
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">
                                <i class="fa-solid fa-crosshairs me-1"></i> Atacante
                            </span>
                            <span class="skill-tag">
                                <i class="fa-solid fa-person-running me-1"></i> Counter Attacker
                            </span>
                            <span class="skill-tag">
                                <i class="fa-solid fa-shield-halved me-1"></i> Forward
                            </span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Número da Camisa
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">
                                <i class="fa-solid fa-shirt me-1"></i> #10 (França U-18, Paris X Gen & França U-20)
                            </span>
                            <span class="skill-tag">
                                <i class="fa-solid fa-shirt me-1"></i> #1 (Team World 5)
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLUNA DIREITA - INFORMAÇÕES DETALHADAS -->
            <div class="col-lg-8">
                <!-- Citação -->
                <div class="character-quote">
                    <i class="fa-solid fa-quote-left me-2" style="color:var(--gold); opacity:0.5;"></i>
                    "Uhh... is this okay? At this distance, you've got nothing but weak spots."
                    <span style="display:block; font-size:0.8rem; color:rgba(255,255,255,0.3); margin-top:4px;">
                        — Loki, Capítulo 91
                    </span>
                </div>

                <!-- Visão Geral -->
                <div class="section-title mt-4">
                    <i class="fa-solid fa-circle-info"></i>
                    Visão Geral
                </div>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    <strong>Julien Loki</strong> (ジュリアン・ロキ <em>Jurian Roki</em>) é um jogador de futebol prodígio, 
                    conhecido como um dos melhores jogadores da França, sendo considerado uma <strong>supernova na liga francesa</strong>. 
                    Julian também é membro da <strong>New Generation World XI</strong>, além de ser o atacante do 
                    <strong>Paris X Gen</strong> e da seleção francesa Sub-20 na Copa do Mundo PIFA Sub-20.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Apresentado durante a <strong>Terceira Seleção</strong>, como membro do Team World 5, ele está inicialmente no 
                    Blue Lock para analisar e classificar os jogadores. Ele retorna para ajudar a treinar o Blue Lock 
                    e participar da <strong>Neo Egoist League</strong> como o mestre striker e treinador do Estrato Francês, 
                    tudo para treinar seu pupilo, <strong>Charles Chevalier</strong>, para se tornar seu passador pessoal 
                    e assim se tornarem os melhores do mundo juntos.
                </p>

                <div class="section-divider"></div>

                <!-- Personalidade -->
                <div class="section-title">
                    <i class="fa-solid fa-brain"></i>
                    Personalidade
                </div>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Antes do jogo contra o Team World 5, Loki foi o único membro de seu time a não zombar da partida 
                    ou menosprezar o Projeto Blue Lock, mostrando um certo nível de <strong>maturidade</strong>. Isagi notou que Loki 
                    era muito <strong>educado</strong>, tendo se desculpado por seus companheiros e desejado uma boa partida. 
                    Apesar de sua educação, Isagi percebeu que Loki não estava nem um pouco nervoso em jogar contra eles, 
                    o que indica uma <strong>confiança suprema</strong> em sua própria capacidade.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Durante a Neo Egoist League, muito de sua personalidade surge com seu objetivo de treinar Charles, 
                    seu passador pessoal. Loki se mostrou um <strong>professor respeitoso</strong> com seu time, informando-os sobre 
                    as áreas que deveriam melhorar. Porém, para toda sua educação, ele é bastante <strong>orgulhoso</strong> 
                    de suas habilidades como atacante e ficou profundamente irritado quando Isagi insultou seu talento.
                </p>

                <div class="section-divider"></div>

                <!-- Habilidades -->
                <div class="section-title">
                    <i class="fa-solid fa-star"></i>
                    Habilidades
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-bolt text-warning me-1"></i> Velocidade Imensurável
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        A velocidade de Loki é sua <strong>arma definitiva</strong>, sendo capaz de arrancar explosivamente de uma posição neutra 
                        e atingir a velocidade máxima muito rapidamente. Esta velocidade é tão devastadora que Isagi não teve 
                        chance de reagir, apesar de Loki estar diretamente na sua frente.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-bolt text-warning me-1"></i> Godspeed
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Quando confrontado com alguém que consegue ler sua direção, Loki é capaz de mudar para uma 
                        <strong>velocidade ainda maior</strong> para ultrapassá-los antes que possam pará-lo. Ele usou isso 
                        para escapar completamente de Rin quando foi interceptado. Corre a <strong>37 km/h</strong> sem olhar 
                        para o passe de Hugo.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-eye text-warning me-1"></i> Predator Eye
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Descrito como o oposto completo do <strong>Metavision</strong>, em vez de expandir sua visão, Loki 
                        a reduz drasticamente, foca exclusivamente no goleiro e espera pacientemente que o oponente 
                        abaixe a guarda para marcar um gol.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-arrow-right text-warning me-1"></i> Warp Synchronicity
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Um movimento combinado de Hugo e Loki que utiliza seus talentos. Hugo entrega um 
                        <strong>passe preciso com backspin</strong>, enquanto Loki corre em alta velocidade para alcançar 
                        a bola e finalizar. Esta combinação é tão rápida que nem Aiku e Gagamaru conseguiram pará-la.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-fire text-warning me-1"></i> Flow State
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Como Ego descreve, o Flow é o estado de <strong>"imersão total"</strong> ou "estar na zona". 
                        É o estado mental em que uma pessoa está completamente imersa em um sentimento de foco energizado, 
                        envolvimento total e prazer no processo da atividade.
                    </div>
                </div>

                <div class="d-flex flex-wrap">
                    <span class="skill-tag skill-tag-gold"><i class="fa-solid fa-bolt me-1"></i> Godspeed</span>
                    <span class="skill-tag"><i class="fa-solid fa-person-running me-1"></i> Agilidade</span>
                    <span class="skill-tag"><i class="fa-solid fa-fire me-1"></i> Flow State</span>
                    <span class="skill-tag"><i class="fa-solid fa-eye me-1"></i> Predator Eye</span>
                    <span class="skill-tag"><i class="fa-solid fa-arrow-right me-1"></i> Warp Synchronicity</span>
                    <span class="skill-tag"><i class="fa-solid fa-person-running me-1"></i> Godspeed Distortion</span>
                </div>

                <div class="section-divider"></div>

                <!-- Frases -->
                <div class="section-title">
                    <i class="fa-solid fa-quote-right"></i>
                    Frases Famosas
                </div>
                <div class="quote-block">
                    <div class="text">"Os lentos morrem primeiro, essa é a lei da natureza."</div>
                    <div class="source">— Loki</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Você tem uma boa visão, mas eu sou rápido."</div>
                    <div class="source">— Loki para Rin, Capítulo 90</div>
                </div>
                <div class="quote-block">
                    <div class="text">"A partida já estava decidida na premissa de que vocês perderiam."</div>
                    <div class="source">— Loki para o Team Blue Lock</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Por favor, reivindiquem a vitória contra o Bastard München. Vocês podem considerar isso... seu último dever de casa."</div>
                    <div class="source">— Loki para o Paris X Gen, Capítulo 246</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Ei Charles, me dê mais passes que quebram a linha neste segundo tempo. Se isso terminar sem eu marcar... a Terra vai ficar triste, certo?"</div>
                    <div class="source">— Loki para Charles, Capítulo 339</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Este mundo é realmente cruel. Os sem talento nunca podem vencer os talentosos... mas nossa 'sociedade livre' os incita brutalmente a tentar mesmo assim. Essa é a regra cruel do mundo."</div>
                    <div class="source">— Loki para Hugo, Capítulo 343</div>
                </div>

                <div class="section-divider"></div>

                <!-- Curiosidades -->
                <div class="section-title">
                    <i class="fa-regular fa-lightbulb"></i>
                    Curiosidades
                </div>
                <ul class="trivia-list">
                    <li><strong>Inspiração:</strong> Loki compartilha muitas semelhanças com o jogador da vida real <strong>Kylian Mbappé</strong>, incluindo velocidade, nacionalidade francesa e o clube Paris X Gen (referência ao PSG). Seu nome "Julian" lembra "Kylian" e "Loki" lembra o segundo sobrenome de Mbappé, "Lottin".</li>
                    <li><strong>Nome:</strong> "Julian" significa "jovem" ou "de Júpiter", enquanto "Loki" vem da mitologia nórdica, associado ao deus da trapaça, conhecido por sua astúcia e natureza caótica.</li>
                    <li><strong>Mais Jovem:</strong> Loki é o <strong>Master Striker mais jovem</strong> da Neo Egoist League.</li>
                    <li><strong>Animal Favorito:</strong> Chitas ("O movimento dos músculos deles no momento do ataque é maravilhoso. Isso me faz sentir bem.")</li>
                    <li><strong>Comida Favorita:</strong> Guimauve Chocolat (marshmallow coberto de chocolate francês)</li>
                    <li><strong>Hobby:</strong> Parkour ("Faço isso incessantemente desde criança. Me faz sentir super-humano!")</li>
                    <li><strong>Filme Favorito:</strong> Predador ("Representações de humanos sendo mortos são emocionantes. Isso me faz sentir bem.")</li>
                    <li><strong>O que o faz feliz:</strong> Ser adorado. ("Quando outros ficam impressionados e sem palavras e me consideram um tipo diferente de 'humano'.")</li>
                    <li><strong>O que o faz triste:</strong> Comparações preconceituosas. Ganhar com conceitos pré-existentes.</li>
                </ul>

                <div class="section-divider"></div>

                <!-- Aparições no Mangá -->
                <div class="section-title">
                    <i class="fa-regular fa-clock"></i>
                    Aparições no Mangá
                </div>
                <div class="d-flex flex-wrap gap-2 mb-2">
                    <span class="skill-tag skill-tag-gold">Terceira Seleção</span>
                    <span class="skill-tag skill-tag-gold">Neo Egoist League</span>
                    <span class="skill-tag skill-tag-gold">U-20 World Cup</span>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <span class="skill-tag">Capítulo 87</span>
                    <span class="skill-tag">Capítulo 90</span>
                    <span class="skill-tag">Capítulo 91</span>
                    <span class="skill-tag">Capítulo 246</span>
                    <span class="skill-tag">Capítulo 310</span>
                    <span class="skill-tag">Capítulo 329</span>
                    <span class="skill-tag">Capítulo 339</span>
                    <span class="skill-tag">Capítulo 342</span>
                    <span class="skill-tag">Capítulo 343</span>
                </div>

                <div class="section-divider"></div>

                <!-- Vozes -->
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
                            <div style="font-size:1rem; font-weight:700; color:white;">Hiro Shimono</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div style="background:rgba(255,255,255,0.03); padding:12px 16px; border-radius:12px; border:1px solid rgba(255,255,255,0.05);">
                            <div style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                                <i class="fa-solid fa-flag-usa me-1"></i> Inglês
                            </div>
                            <div style="font-size:1rem; font-weight:700; color:white;">Kevin D. Thelwell</div>
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