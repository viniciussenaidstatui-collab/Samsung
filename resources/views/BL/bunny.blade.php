{{-- resources/views/BL/bunny.blade.php --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bunny Iglesias - Blue Lock Wiki</title>
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
            --bunny-lavender: #b39ddb;
            --bunny-red: #c62828;
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
            background: linear-gradient(90deg, transparent, var(--bunny-lavender), transparent);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #fff 30%, var(--bunny-lavender) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .breadcrumb-custom {
            color: rgba(255,255,255,0.4);
            font-size: 0.85rem;
        }

        .breadcrumb-custom a {
            color: var(--bunny-lavender);
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
            border: 2px solid rgba(179,157,219,0.3);
            box-shadow: 0 20px 60px rgba(179,157,219,0.2);
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
            color: var(--bunny-lavender);
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-block;
            background: rgba(179,157,219,0.1);
            padding: 4px 16px;
            border-radius: 20px;
            border: 1px solid rgba(179,157,219,0.2);
            margin-bottom: 15px;
        }

        .character-quote {
            font-style: italic;
            color: rgba(255,255,255,0.7);
            font-size: 1.05rem;
            padding: 16px 20px;
            background: rgba(255,255,255,0.03);
            border-radius: 12px;
            border-left: 3px solid var(--bunny-lavender);
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
            color: var(--bunny-lavender);
            font-size: 1.1rem;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, var(--bunny-lavender), transparent);
            margin: 30px 0;
        }

        .skill-tag {
            display: inline-block;
            background: rgba(179,157,219,0.15);
            color: #d4c0e8;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(179,157,219,0.2);
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
            border-left: 3px solid var(--bunny-lavender);
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
            background: var(--bunny-lavender);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #d4c0e8;
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
                    <span style="color: rgba(255,255,255,0.6);">Bunny Iglesias</span>
                </div>
                <h1 class="page-title mt-2">Bunny Iglesias</h1>
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
                        <img src="{{ asset('images/cubo/Bunny.jpg') }}" alt="Bunny Iglesias" class="character-image">
                        <h2 class="character-name mt-3">
                            Bunny Iglesias
                            <span class="character-name-jp">バニー・イグレシアス</span>
                        </h2>
                        <div class="character-title">
                            <i class="fa-solid fa-arrow-up me-1"></i>
                            "O Coelho Saltitante"
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
                            <div class="label">Altura</div>
                            <div class="value"><i class="fa-regular fa-ruler"></i> 191 cm</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Cor do Cabelo</div>
                            <div class="value"><i class="fa-solid fa-palette"></i> Lavanda</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Cor dos Olhos</div>
                            <div class="value"><i class="fa-regular fa-eye"></i> Vermelho</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Nacionalidade</div>
                            <div class="value"><i class="fa-solid fa-flag"></i> Espanha</div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Afiliação
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">FC Barcha</span>
                            <span class="skill-tag">Espanha U-20</span>
                            <span class="skill-tag">New Generation World XI</span>
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
                                <i class="fa-solid fa-person me-1"></i> Target Man
                            </span>
                            <span class="skill-tag">
                                <i class="fa-solid fa-user-plus me-1"></i> Second Striker
                            </span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Número da Camisa
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">
                                <i class="fa-solid fa-shirt me-1"></i> #19 (FC Barcha)
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
                </div>
            </div>

            <!-- COLUNA DIREITA -->
            <div class="col-lg-8">
                <!-- Citação -->
                <div class="character-quote">
                    <i class="fa-solid fa-quote-left me-2" style="color:var(--bunny-lavender); opacity:0.5;"></i>
                    "When I see a joyful person like you ... it makes me want to die!"
                    <span style="display:block; font-size:0.8rem; color:rgba(255,255,255,0.3); margin-top:4px;">
                        — Bunny para Isagi, Capítulo 307
                    </span>
                </div>

                <!-- Visão Geral -->
                <div class="section-title mt-4">
                    <i class="fa-solid fa-circle-info"></i>
                    Visão Geral
                </div>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    <strong>Bunny Iglesias</strong> (バニー・イグレシアス <em>Banī Igureshiasu</em>) é um jogador de futebol prodígio 
                    conhecido como um dos melhores jogadores da Espanha. Bunny também é membro da 
                    <strong>New Generation World XI</strong>, além de ser do time principal do <strong>FC Barcha</strong> 
                    e um atacante na seleção espanhola Sub-20 durante a Copa do Mundo PIFA Sub-20.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Uma figura chave tanto em gols quanto em assistências para o time principal do FC Barcha desde a 
                    segunda metade da temporada, ele é considerado um dos talentos mais promissores do mundo do futebol. 
                    Ele é um <strong>adversário de longa data</strong> do melhor jogador do Japão, <strong>Sae Itoshi</strong>, 
                    e a razão de sua participação na seleção japonesa Sub-20 na Copa do Mundo PIFA Sub-20.
                </p>

                <div class="section-divider"></div>

                <!-- Personalidade -->
                <div class="section-title">
                    <i class="fa-solid fa-brain"></i>
                    Personalidade
                </div>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Bunny Iglesias parece ser <strong>calmo, educado e de voz suave</strong>, frequentemente usando um 
                    sorriso gentil que esconde uma turbulência emocional mais profunda. Ele fala com uma honestidade 
                    desapegada, ocasionalmente revelando um lado <strong>apático e melancólico</strong>, especialmente 
                    quando discute sua própria conexão com o futebol. Embora respeitoso na conversa, seus comentários 
                    podem ser sutilmente <strong>autodepreciativos</strong>.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    No entanto, parece que ele também pode ser bastante <strong>brincalhão</strong> com os outros. Durante 
                    o primeiro encontro de Bunny e Isagi, Isagi perguntou o nome do prato que Bunny estava comendo. 
                    Bunny deliberadamente deu a ele uma grafia invertida do prato ('Auedif' em vez de 'Fideua'). 
                    Isso mostra que ele tem um lado <strong>travesso</strong>; ele é até chamado de "brincalhão" por Isagi.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Apesar disso, Bunny tem <strong>aversão ao otimismo</strong>, pois observar a euforia revela sua 
                    <strong>natureza suicida</strong>.
                </p>

                <div class="section-divider"></div>

                <!-- Habilidades -->
                <div class="section-title">
                    <i class="fa-solid fa-star"></i>
                    Habilidades
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-arrow-up text-warning me-1"></i> Poder de Salto
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Isagi se referiu à sua habilidade de salto como <strong>"irreal"</strong>, pois ele recebeu o 
                        passe lob de Lavinho e marcou um gol com um chute de tesoura acima das cabeças dos jogadores 
                        do Chicorid. Daí seu nome 'Bunny' (Coelho).
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-people-group text-warning me-1"></i> Técnica Profissional
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Não só ele faz parte da New Generation World XI, mas ele é um <strong>jogador chave</strong> 
                        em gols e assistências. Sendo um jogador central no ataque de sua equipe, ele é uma 
                        <strong>estrela em ascensão</strong> que acredita-se que liderará o FC Barcha no futuro.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-scissors text-warning me-1"></i> Scissor Kick
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Um chute no ar que se assemelha a uma <strong>tesoura</strong>. Uma perna é usada para impulso de 
                        salto e a outra perna para chutar a bola. Bunny realizou um poderoso chute de tesoura 
                        durante a partida contra o Chicorid.
                    </div>
                </div>

                <div class="d-flex flex-wrap">
                    <span class="skill-tag skill-tag-gold"><i class="fa-solid fa-arrow-up me-1"></i> Poder de Salto</span>
                    <span class="skill-tag"><i class="fa-solid fa-scissors me-1"></i> Scissor Kick</span>
                    <span class="skill-tag"><i class="fa-solid fa-futbol me-1"></i> Técnica Profissional</span>
                </div>

                <div class="section-divider"></div>

                <!-- Frases -->
                <div class="section-title">
                    <i class="fa-solid fa-quote-right"></i>
                    Frases Famosas
                </div>
                <div class="quote-block">
                    <div class="text">"Oh... então você é um de nós também?"</div>
                    <div class="source">— Bunny para Isagi, Capítulo 326</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Quando vejo uma pessoa alegre como você... me dá vontade de morrer!"</div>
                    <div class="source">— Bunny para Isagi, Capítulo 307</div>
                </div>

                <div class="section-divider"></div>

                <!-- Curiosidades -->
                <div class="section-title">
                    <i class="fa-regular fa-lightbulb"></i>
                    Curiosidades
                </div>
                <ul class="trivia-list">
                    <li><strong>Cicatrizes:</strong> Bunny possui duas cicatrizes no rosto: uma vertical no olho direito e uma horizontal na bochecha e nariz direitos. Ele também tem uma cicatriz no lado esquerdo do pescoço e muitas cicatrizes nos braços e ombros.</li>
                    <li><strong>FC Barcha:</strong> Bunny entrou no time principal do FC Barcha no meio da temporada atual e, no início da partida contra o Chicorid, ele já havia marcado <strong>12 gols</strong>.</li>
                    <li><strong>Pé Dominante:</strong> Esquerdo</li>
                    <li><strong>New Generation World XI:</strong> Bunny está entre os membros da New Generation World XI que não participaram da Neo Egoist League.</li>
                    <li><strong>Time Principal:</strong> De todos os membros da New Generation World XI revelados, além de Julian Loki, Bunny é o único que joga no <strong>time principal</strong> de seu clube.</li>
                    <li><strong>Rivalidade:</strong> Ele é um <strong>adversário de longa data</strong> do melhor jogador do Japão, <strong>Sae Itoshi</strong>.</li>
                    <li><strong>Significado do Nome:</strong> Seu sobrenome, "Iglesias", significa "igrejas" em espanhol.</li>
                    <li><strong>Estilo Casual:</strong> Bunny usa um boné preto com um rosto de coelho na frente, casaco verde sem botões com bordas rasgadas e camiseta branca com a inscrição "Solo Yo" ("Apenas Eu" em espanhol).</li>
                </ul>

                <!-- Detalhes adicionais -->
                <div style="margin-top:16px; background:rgba(179,157,219,0.03); padding:16px 20px; border-radius:12px; border:1px solid rgba(179,157,219,0.08);">
                    <div style="font-size:0.75rem; text-transform:uppercase; color:var(--bunny-lavender); font-weight:700; letter-spacing:0.5px;">
                        <i class="fa-solid fa-info-circle me-1"></i> Informações Adicionais
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Gols marcados:</strong> 12 gols na metade da temporada pelo FC Barcha
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Time:</strong> FC Barcha (Time Principal)
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Rival:</strong> Sae Itoshi
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
                    <span class="skill-tag">Capítulo 307</span>
                    <span class="skill-tag">Capítulo 326</span>
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