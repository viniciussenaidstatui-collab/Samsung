{{-- resources/views/BL/kaiser.blade.php --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Michael Kaiser - Blue Lock Wiki</title>
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
            --kaiser-blue: #4a9eff;
            --kaiser-gold: #ffd700;
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
            background: linear-gradient(90deg, transparent, var(--kaiser-blue), transparent);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #fff 30%, var(--kaiser-blue) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .breadcrumb-custom {
            color: rgba(255,255,255,0.4);
            font-size: 0.85rem;
        }

        .breadcrumb-custom a {
            color: var(--kaiser-blue);
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
            border: 2px solid rgba(74,158,255,0.3);
            box-shadow: 0 20px 60px rgba(74,158,255,0.2);
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
            color: var(--kaiser-blue);
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-block;
            background: rgba(74,158,255,0.1);
            padding: 4px 16px;
            border-radius: 20px;
            border: 1px solid rgba(74,158,255,0.2);
            margin-bottom: 15px;
        }

        .character-quote {
            font-style: italic;
            color: rgba(255,255,255,0.7);
            font-size: 1.05rem;
            padding: 16px 20px;
            background: rgba(255,255,255,0.03);
            border-radius: 12px;
            border-left: 3px solid var(--kaiser-blue);
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
            color: var(--kaiser-blue);
            font-size: 1.1rem;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, var(--kaiser-blue), transparent);
            margin: 30px 0;
        }

        .skill-tag {
            display: inline-block;
            background: rgba(74,158,255,0.15);
            color: #8ac4ff;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(74,158,255,0.2);
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
            border-left: 3px solid var(--kaiser-blue);
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
            background: var(--kaiser-blue);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #6db3ff;
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
                    <span style="color: rgba(255,255,255,0.6);">Michael Kaiser</span>
                </div>
                <h1 class="page-title mt-2">Michael Kaiser</h1>
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
                        <img src="{{ asset('images/cubo/Kaiser.jpg') }}" alt="Michael Kaiser" class="character-image">
                        <h2 class="character-name mt-3">
                            Michael Kaiser
                            <span class="character-name-jp">ミヒャエル・カイザー</span>
                        </h2>
                        <div class="character-title">
                            <i class="fa-solid fa-crown me-1"></i>
                            "O Imperador"
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
                            <div class="value"><i class="fa-regular fa-cake"></i> 25 de Dezembro</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Altura</div>
                            <div class="value"><i class="fa-regular fa-ruler"></i> 186 cm</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Tipo Sanguíneo</div>
                            <div class="value"><i class="fa-solid fa-droplet"></i> A</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Nacionalidade</div>
                            <div class="value"><i class="fa-solid fa-flag"></i> Alemanha</div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Afiliação
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">Bastard München</span>
                            <span class="skill-tag">Alemanha U-20</span>
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
                                <i class="fa-solid fa-bullseye me-1"></i> Clinical Finisher
                            </span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Número da Camisa
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">
                                <i class="fa-solid fa-shirt me-1"></i> #10 (Bastard München)
                            </span>
                            <span class="skill-tag">
                                <i class="fa-solid fa-shirt me-1"></i> #11 (Tryouts)
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
                </div>
            </div>

            <!-- COLUNA DIREITA -->
            <div class="col-lg-8">
                <!-- Citação -->
                <div class="character-quote">
                    <i class="fa-solid fa-quote-left me-2" style="color:var(--kaiser-blue); opacity:0.5;"></i>
                    "Do you believe in the impossible?"
                    <span style="display:block; font-size:0.8rem; color:rgba(255,255,255,0.3); margin-top:4px;">
                        — Michael Kaiser, Capítulo 242
                    </span>
                </div>

                <!-- Visão Geral -->
                <div class="section-title mt-4">
                    <i class="fa-solid fa-circle-info"></i>
                    Visão Geral
                </div>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    <strong>Michael Kaiser</strong> (ミヒャエル・カイザー <em>Mihyaeru Kaizā</em>) é um prodígio atacante Sub-20 da Alemanha 
                    que joga pelo <strong>Bastard München</strong> durante a Neo Egoist League como o <strong>ás e principal atacante</strong> do time. 
                    Kaiser é considerado um prodígio e também é membro da <strong>New Generation World XI</strong>. 
                    Kaiser também joga pela Alemanha Sub-20 durante a Copa do Mundo Sub-20.
                </p>

                <div class="section-divider"></div>

                <!-- Personalidade -->
                <div class="section-title">
                    <i class="fa-solid fa-brain"></i>
                    Personalidade
                </div>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Kaiser é mostrado como um jovem <strong>arrogante</strong> que tem um complexo de superioridade. 
                    Ele vê todos ao seu redor como meros atores secundários em comparação com seu papel principal 
                    como a estrela de seu mundo. Embora seja arrogante e rudemente astuto com as pessoas que vê 
                    como inferiores, ele não é desnecessariamente rude com seus companheiros de equipe, mas os 
                    coloca em seu lugar quando eles falam desnecessariamente, mesmo que seja por seu bem.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Kaiser gosta de <strong>"erodir" os corações de seus oponentes</strong> e "fazê-los afundar em desespero". 
                    Ele particularmente gosta de infligir angústia mental em oponentes mais fracos. Mesmo sendo 
                    arrogante e rude, ele sabe quando se controlar perto de pessoas definitivamente melhores e 
                    superiores a ele, como seu líder de equipe e o melhor atacante do mundo, <strong>Noel Noa</strong>.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Em seu passado, Kaiser era uma pessoa <strong>mentalmente fraca</strong> que constantemente desistia 
                    das coisas que acreditava serem impossíveis. Para lembrar-se de nunca mais cair nessa mentalidade 
                    fraca, ele tatuou uma <strong>rosa azul</strong> em seu pescoço, que ele acredita simbolizar a 
                    <strong>realização do impossível</strong>.
                </p>

                <div class="section-divider"></div>

                <!-- Habilidades -->
                <div class="section-title">
                    <i class="fa-solid fa-star"></i>
                    Habilidades
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-bolt text-warning me-1"></i> Kaiser Impact
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Com a <strong>velocidade de chute mais rápida do mundo</strong>, Kaiser usa seu talento para dar 
                        um chute de voleio tão rápido que as pessoas têm dificuldade em notar o momento em que 
                        a bola é disparada, bem como rastrear a bola enquanto ela viaja em direção ao gol. 
                        Seu chute tem velocidade e potência para passar pelas cabeças de cinco defensores na 
                        frente do gol e pelo goleiro com precisão milimétrica.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-eye text-warning me-1"></i> Metavision
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Um termo usado para descrever a visão evoluída de um jogador que lhes dá uma 
                        <strong>perspectiva onisciente do campo</strong>. Usando seus olhos para consumir constantemente 
                        informações de sua visão central e periférica, Kaiser coleta constantemente dados 
                        sobre cada jogador, cada jogada que eles fazem e suas posições no campo.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-eye text-warning me-1"></i> Predator Eye
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Descrito como o oposto completo do Metavision, em vez de expandir sua visão, Kaiser 
                        a <strong>reduz drasticamente</strong> para marcar um gol. Kaiser usa o Predator Eye para encontrar 
                        as menores brechas para uma trajetória de chute ao mirar e executar seu Kaiser Impact.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-fire text-warning me-1"></i> Flow State
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        O estado de <strong>"imersão total"</strong> ou "estar na zona". O Flow de Kaiser ou desempenho 
                        máximo vem de abandonar sua fixação em Isagi e seu medo do fracasso, focando em 
                        produzir o melhor resultado possível e mirar mais alto enquanto arrisca suas conquistas.
                    </div>
                </div>

                <div class="d-flex flex-wrap">
                    <span class="skill-tag skill-tag-gold"><i class="fa-solid fa-bolt me-1"></i> Kaiser Impact</span>
                    <span class="skill-tag"><i class="fa-solid fa-eye me-1"></i> Metavision</span>
                    <span class="skill-tag"><i class="fa-solid fa-eye me-1"></i> Predator Eye</span>
                    <span class="skill-tag"><i class="fa-solid fa-fire me-1"></i> Flow State</span>
                    <span class="skill-tag"><i class="fa-solid fa-person-running me-1"></i> Off-the-Ball</span>
                    <span class="skill-tag"><i class="fa-solid fa-arrows-spin me-1"></i> Kaiser Impact: Magnus</span>
                    <span class="skill-tag"><i class="fa-solid fa-arrows-spin me-1"></i> Kaiser Impact: Blitzkrieg</span>
                </div>

                <div class="section-divider"></div>

                <!-- Frases -->
                <div class="section-title">
                    <i class="fa-solid fa-quote-right"></i>
                    Frases Famosas
                </div>
                <div class="quote-block">
                    <div class="text">"Do you believe in the impossible?"</div>
                    <div class="source">— Michael Kaiser, Capítulo 242</div>
                </div>
                <div class="quote-block">
                    <div class="text">"O roteiro que você escreveu é muito chato, Yoichi. Rejeitado."</div>
                    <div class="source">— Kaiser para Isagi, Capítulo 178</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Bem, ex-que-licença-me. Muito legal, Yoichi. Bem-vindo à minha dimensão."</div>
                    <div class="source">— Kaiser para Isagi, Capítulo 185</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Você finalmente é grande o suficiente para comer, Yoichi..."</div>
                    <div class="source">— Kaiser para Isagi, Capítulo 207</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Ajoelhe-se, Blue Lock."</div>
                    <div class="source">— Kaiser para Jinpachi Ego</div>
                </div>

                <div class="section-divider"></div>

                <!-- Curiosidades -->
                <div class="section-title">
                    <i class="fa-regular fa-lightbulb"></i>
                    Curiosidades
                </div>
                <ul class="trivia-list">
                    <li><strong>Signo:</strong> Capricórnio</li>
                    <li><strong>Cidade Natal:</strong> Berlim, Alemanha</li>
                    <li><strong>Tamanho do Pé:</strong> 28 cm</li>
                    <li><strong>Começou a jogar futebol:</strong> Aos 15 anos</li>
                    <li><strong>Música Favorita:</strong> Desperado - The Eagles</li>
                    <li><strong>Animais Favoritos:</strong> Cães de rua</li>
                    <li><strong>Cor de Imagem:</strong> Azul metálico</li>
                    <li><strong>Comida Favorita:</strong> Casca de pão torrada</li>
                    <li><strong>Hobbies:</strong> Ler, psicologia e filosofia</li>
                    <li><strong>Filme Favorito:</strong> One Flew Over the Cuckoo's Nest</li>
                    <li><strong>Estação Favorita:</strong> Inverno ("A solidão combina comigo")</li>
                    <li><strong>Dorme:</strong> 8 horas (7 à noite + 1 cochilo)</li>
                    <li><strong>Não tem um jogador favorito</strong> de futebol</li>
                    <li><strong>Família:</strong> Ele e seu pai</li>
                    <li><strong>O que o faz feliz:</strong> Ser considerado um inimigo</li>
                    <li><strong>O que o faz triste:</strong> Receber um presente (não sabe como reagir)</li>
                    <li><strong>Rotina matinal:</strong> Fica em frente ao espelho nu, conversando consigo mesmo, pensando que nada é impossível</li>
                    <li><strong>Ritual de sorte:</strong> Acariciar a tatuagem de rosa azul como se estivesse apertando uma corda em volta do pescoço</li>
                    <li><strong>Recebeu 800 chocolates</strong> no Dia dos Namorados</li>
                    <li><strong>Última vez que chorou:</strong> Quando se estrangulou</li>
                    <li><strong>Se tivesse 100 milhões de ienes:</strong> Compraria um jardim de rosas</li>
                    <li><strong>Figuras históricas favoritas:</strong> Nietzsche, Freud e Napoleão</li>
                </ul>

                <!-- Egoist Bible -->
                <div style="margin-top:16px; background:rgba(74,158,255,0.03); padding:16px 20px; border-radius:12px; border:1px solid rgba(74,158,255,0.08);">
                    <div style="font-size:0.75rem; text-transform:uppercase; color:var(--kaiser-blue); font-weight:700; letter-spacing:0.5px;">
                        <i class="fa-solid fa-book me-1"></i> Egoist Bible Vol. 2
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Fetiche:</strong> Faces de desespero ("Quero experimentar as profundezas da alma de uma pessoa")
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Parceira ideal:</strong> Alguém bonita, inteligente e cheia de amor
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Se não tivesse conhecido o futebol:</strong> Seria um criminoso ou morreria de fome
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Último pedido ao Papai Noel:</strong> Liberdade
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Aparições -->
                <div class="section-title">
                    <i class="fa-regular fa-clock"></i>
                    Aparições no Mangá
                </div>
                <div class="d-flex flex-wrap gap-2 mb-2">
                    <span class="skill-tag skill-tag-gold">U-20 Arc</span>
                    <span class="skill-tag skill-tag-gold">Neo Egoist League</span>
                    <span class="skill-tag skill-tag-gold">U-20 World Cup</span>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <span class="skill-tag">Capítulo 149</span>
                    <span class="skill-tag">Capítulo 156</span>
                    <span class="skill-tag">Capítulo 157</span>
                    <span class="skill-tag">Capítulo 177</span>
                    <span class="skill-tag">Capítulo 178</span>
                    <span class="skill-tag">Capítulo 185</span>
                    <span class="skill-tag">Capítulo 207</span>
                    <span class="skill-tag">Capítulo 242</span>
                    <span class="skill-tag">Capítulo 246</span>
                    <span class="skill-tag">Capítulo 329</span>
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
                            <div style="font-size:1rem; font-weight:700; color:white;">Mamoru Miyano</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div style="background:rgba(255,255,255,0.03); padding:12px 16px; border-radius:12px; border:1px solid rgba(255,255,255,0.05);">
                            <div style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                                <i class="fa-solid fa-flag-usa me-1"></i> Inglês
                            </div>
                            <div style="font-size:1rem; font-weight:700; color:white;">Christopher Wehkamp</div>
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