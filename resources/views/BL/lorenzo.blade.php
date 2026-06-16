{{-- resources/views/BL/lorenzo.blade.php --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don Lorenzo - Blue Lock Wiki</title>
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
            --lorenzo-purple: #7b1fa2;
            --lorenzo-green: #2e7d32;
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
            background: linear-gradient(90deg, transparent, var(--lorenzo-purple), transparent);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #fff 30%, var(--lorenzo-purple) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .breadcrumb-custom {
            color: rgba(255,255,255,0.4);
            font-size: 0.85rem;
        }

        .breadcrumb-custom a {
            color: var(--lorenzo-purple);
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
            border: 2px solid rgba(123,31,162,0.3);
            box-shadow: 0 20px 60px rgba(123,31,162,0.2);
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
            color: var(--lorenzo-purple);
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-block;
            background: rgba(123,31,162,0.1);
            padding: 4px 16px;
            border-radius: 20px;
            border: 1px solid rgba(123,31,162,0.2);
            margin-bottom: 15px;
        }

        .character-quote {
            font-style: italic;
            color: rgba(255,255,255,0.7);
            font-size: 1.05rem;
            padding: 16px 20px;
            background: rgba(255,255,255,0.03);
            border-radius: 12px;
            border-left: 3px solid var(--lorenzo-purple);
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
            color: var(--lorenzo-purple);
            font-size: 1.1rem;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, var(--lorenzo-purple), transparent);
            margin: 30px 0;
        }

        .skill-tag {
            display: inline-block;
            background: rgba(123,31,162,0.15);
            color: #ce93d8;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(123,31,162,0.2);
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
            border-left: 3px solid var(--lorenzo-purple);
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
            background: var(--lorenzo-purple);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ab47bc;
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
                    <span style="color: rgba(255,255,255,0.6);">Don Lorenzo</span>
                </div>
                <h1 class="page-title mt-2">Don Lorenzo</h1>
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
                        <img src="{{ asset('images/cubo/Lorenzo.jpg') }}" alt="Don Lorenzo" class="character-image">
                        <h2 class="character-name mt-3">
                            Don Lorenzo
                            <span class="character-name-jp">ドン・ロレンゾ</span>
                        </h2>
                        <div class="character-title">
                            <i class="fa-solid fa-shield-halved me-1"></i>
                            "O Devorador de Aces"
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
                            <div class="value"><i class="fa-regular fa-cake"></i> 4 de Julho</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Altura</div>
                            <div class="value"><i class="fa-regular fa-ruler"></i> 190 cm</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Tipo Sanguíneo</div>
                            <div class="value"><i class="fa-solid fa-droplet"></i> O</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Nacionalidade</div>
                            <div class="value"><i class="fa-solid fa-flag"></i> Itália</div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Afiliação
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">Ubers</span>
                            <span class="skill-tag">Itália U-20</span>
                            <span class="skill-tag">New Generation World XI</span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Posição
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">
                                <i class="fa-solid fa-shield-halved me-1"></i> Center Back
                            </span>
                            <span class="skill-tag">
                                <i class="fa-solid fa-people-arrows me-1"></i> Libero
                            </span>
                            <span class="skill-tag">
                                <i class="fa-solid fa-arrows-up-down me-1"></i> Center Midfielder
                            </span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="label" style="font-size:0.7rem; text-transform:uppercase; color:rgba(255,255,255,0.3); font-weight:700; letter-spacing:0.5px;">
                            Número da Camisa
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="skill-tag skill-tag-gold">
                                <i class="fa-solid fa-shirt me-1"></i> #2 (Ubers)
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
                            <span class="skill-tag">Dois irmãos mais velhos</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLUNA DIREITA -->
            <div class="col-lg-8">
                <!-- Citação -->
                <div class="character-quote">
                    <i class="fa-solid fa-quote-left me-2" style="color:var(--lorenzo-purple); opacity:0.5;"></i>
                    "Don't get full of yourself after one sneaky goal... Capiché?"
                    <span style="display:block; font-size:0.8rem; color:rgba(255,255,255,0.3); margin-top:4px;">
                        — Lorenzo para Isagi, Capítulo 214
                    </span>
                </div>

                <!-- Visão Geral -->
                <div class="section-title mt-4">
                    <i class="fa-solid fa-circle-info"></i>
                    Visão Geral
                </div>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    <strong>Don Lorenzo</strong> (ドン・ロレンゾ <em>Don Rorenzo</em>) é um prodígio defensor Sub-20 da Itália 
                    que joga pelo <strong>Ubers</strong> durante a Neo Egoist League como o <strong>núcleo e estrela defensiva</strong> 
                    do time. Conhecido por ser o <strong>defensor Sub-20 mais forte do mundo</strong>, ele também é 
                    membro da <strong>New Generation World XI</strong> e é conhecido como <strong>"O Devorador de Aces"</strong>.
                </p>

                <div class="section-divider"></div>

                <!-- Personalidade -->
                <div class="section-title">
                    <i class="fa-solid fa-brain"></i>
                    Personalidade
                </div>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Lorenzo admira a <strong>força dos outros e o dinheiro</strong>. Ele acredita firmemente que o 
                    dinheiro faz o mundo girar e que não há nada neste mundo que o dinheiro não possa comprar, 
                    exibindo uma personalidade <strong>materialista</strong>. Ele só reconhece pessoas com valor 
                    agregado, e mesmo assim, elas precisam ser fortes para que ele lhes dê qualquer atenção.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Sua obsessão por dinheiro vem de sua criação; ele nasceu em uma <strong>família miserável</strong> e, 
                    depois de ser abandonado por seus pais, foi forçado a viver nas ruas. Ele passou seu tempo 
                    <strong>enganando as pessoas</strong> para sobreviver, mas eventualmente perdeu a esperança na vida 
                    e estava pronto para morrer. Felizmente, ele foi encontrado por <strong>Snuffy</strong>, que lhe 
                    ofereceu ajuda em troca de jogar futebol com ele.
                </p>
                <p style="color:rgba(255,255,255,0.75); line-height:1.8; font-size:0.95rem;">
                    Lorenzo fora do jogo pode ser bastante <strong>alegre e barulhento</strong>. Ele tende a fazer 
                    uma bagunça com o que está comendo, geralmente pipoca, e não se importa com o que os outros 
                    pensam de sua exibição. Ele é <strong>gentil e apoia seus companheiros de equipe</strong> durante 
                    o jogo. Ele tem uma admiração por Kaiser como seu <strong>rival de longa data</strong> e sua 
                    marcação individual pode parecer <strong>perseguição</strong>.
                </p>

                <div class="section-divider"></div>

                <!-- Habilidades -->
                <div class="section-title">
                    <i class="fa-solid fa-star"></i>
                    Habilidades
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-person-walking text-warning me-1"></i> Zombie Dribbling
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        O estilo de drible de Lorenzo envolve mover a parte superior e inferior do corpo de uma forma 
                        que os torna <strong>completamente descoordenados</strong>, tornando extremamente difícil ler 
                        seu centro de gravidade. Esta técnica permite que Lorenzo <strong>passe facilmente pelos 
                        adversários</strong>, confundindo-os com seus movimentos não convencionais.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-shield-halved text-warning me-1"></i> Man-Marking
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        Em conjunto com suas habilidades preditivas e físicas, Lorenzo é capaz de fazer 
                        <strong>interceptações precisas</strong> da bola, especialmente quando direcionadas ao 
                        <strong>"ás" do time adversário</strong>. Isso foi demonstrado quando ele surpreendentemente 
                        interceptou o Kaiser Impact.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-arrows-up-down text-warning me-1"></i> Defensive Stance
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        A arma defensiva principal de Lorenzo permite que ele <strong>neutralize atacantes</strong> 
                        através de posicionamento excepcional, consciência espacial e velocidade de reação. Ele 
                        controla a linha de defesa como um <strong>estrategista</strong>, lendo passes e movimentos 
                        com intuição quase instantânea.
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <div style="color:rgba(255,255,255,0.5); font-size:0.85rem; font-weight:600; margin-bottom:6px;">
                        <i class="fa-solid fa-person-running text-warning me-1"></i> Lunging
                    </div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
                        A marcação e o físico de Lorenzo em conjunto permitem que ele faça <strong>investidas longas e ousadas</strong> 
                        que podem pegar os atacantes adversários desprevenidos. Ele facilmente roubou a bola de 
                        Michael Kaiser, apesar deste ter passado pela defesa do Ubers com relativa facilidade.
                    </div>
                </div>

                <div class="d-flex flex-wrap">
                    <span class="skill-tag skill-tag-gold"><i class="fa-solid fa-person-walking me-1"></i> Zombie Dribbling</span>
                    <span class="skill-tag"><i class="fa-solid fa-shield-halved me-1"></i> Man-Marking</span>
                    <span class="skill-tag"><i class="fa-solid fa-arrows-up-down me-1"></i> Defensive Stance</span>
                    <span class="skill-tag"><i class="fa-solid fa-person-running me-1"></i> Lunging</span>
                    <span class="skill-tag"><i class="fa-solid fa-dumbbell me-1"></i> Físico</span>
                </div>

                <div class="section-divider"></div>

                <!-- Frases -->
                <div class="section-title">
                    <i class="fa-solid fa-quote-right"></i>
                    Frases Famosas
                </div>
                <div class="quote-block">
                    <div class="text">"Don't get full of yourself after one sneaky goal... Capiché?"</div>
                    <div class="source">— Lorenzo para Isagi, Capítulo 214</div>
                </div>
                <div class="quote-block">
                    <div class="text">"Yo, Michael!"</div>
                    <div class="source">— Lorenzo para Kaiser, Capítulo 210</div>
                </div>

                <div class="section-divider"></div>

                <!-- Curiosidades -->
                <div class="section-title">
                    <i class="fa-regular fa-lightbulb"></i>
                    Curiosidades
                </div>
                <ul class="trivia-list">
                    <li><strong>Nascimento:</strong> Florença, Itália</li>
                    <li><strong>Tamanho do Pé:</strong> 31 cm</li>
                    <li><strong>Acuidade Visual:</strong> 1.5</li>
                    <li><strong>Começou a jogar futebol:</strong> Aos 6 anos</li>
                    <li><strong>Jogador Favorito:</strong> Paolo Maldini</li>
                    <li><strong>Hobby:</strong> Festas rave ("Gosto de me divertir")</li>
                    <li><strong>Animal Favorito:</strong> Anaconda ("Só de olhar me dá arrepios")</li>
                    <li><strong>Filme Favorito:</strong> Seven Samurai ("O entretenimento de Kurosawa é o melhor!")</li>
                    <li><strong>Comida Favorita:</strong> Pipoca de caramelo</li>
                    <li><strong>Comida Detestada:</strong> Tudo com sabor de menta</li>
                    <li><strong>Estação Favorita:</strong> Primavera</li>
                    <li><strong>Mangá Favorito:</strong> Jujutsu Kaisen</li>
                    <li><strong>Música Favorita:</strong> Uptown Funk</li>
                    <li><strong>Lema:</strong> "A vida não é algo que você deva jogar fora"</li>
                    <li><strong>Dorme:</strong> 5 horas ("Acordo facilmente")</li>
                    <li><strong>Fetiche:</strong> Sorriso ("Garotas com sorrisos fofos são as melhores!")</li>
                    <li><strong>Ponto forte:</strong> Super Ultra Super Positivo</li>
                    <li><strong>Ponto fraco:</strong> Não consegue viver pensando no futuro</li>
                    <li><strong>Se tivesse 100 milhões de ienes:</strong> Jogaria pôquer em Las Vegas</li>
                    <li><strong>Último pedido ao Papai Noel:</strong> Sonhos, esperanças e amor</li>
                    <li><strong>Dia de folga:</strong> Beber, jogar, garotas e festas</li>
                    <li><strong>Último dia na Terra:</strong> Celebraria a "Última Festa da Terra"</li>
                    <li><strong>Se não tivesse encontrado o futebol:</strong> Estaria morto na sarjeta</li>
                    <li><strong>Levaria para uma ilha deserta:</strong> Toda sua fortuna em dinheiro</li>
                    <li><strong>Máquina do tempo:</strong> Ir para o futuro</li>
                </ul>

                <!-- Egoist Bible -->
                <div style="margin-top:16px; background:rgba(123,31,162,0.03); padding:16px 20px; border-radius:12px; border:1px solid rgba(123,31,162,0.08);">
                    <div style="font-size:0.75rem; text-transform:uppercase; color:var(--lorenzo-purple); font-weight:700; letter-spacing:0.5px;">
                        <i class="fa-solid fa-book me-1"></i> Egoist Bible
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>O que o faz feliz:</strong> Dinheiro, trabalho e amor ("Me dê dinheiro. Me dê um trabalho. Me dê amor")
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>O que o faz triste:</strong> Ser preso ("Fazer coisas erradas não é certo, certo?")
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Última vez que chorou:</strong> Quando seu ator favorito cometeu suicídio
                    </div>
                    <div style="color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:4px;">
                        <strong>Idade do primeiro amor:</strong> "Não sei, me apaixono rápido demais!"
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Aparições -->
                <div class="section-title">
                    <i class="fa-regular fa-clock"></i>
                    Aparições no Mangá
                </div>
                <div class="d-flex flex-wrap gap-2 mb-2">
                    <span class="skill-tag skill-tag-gold">Neo Egoist League</span>
                    <span class="skill-tag skill-tag-gold">U-20 World Cup</span>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <span class="skill-tag">Capítulo 209</span>
                    <span class="skill-tag">Capítulo 210</span>
                    <span class="skill-tag">Capítulo 214</span>
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