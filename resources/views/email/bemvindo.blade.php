<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Bem Vindo - Samsung</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            width: 100%;
            background-color: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .header {
            background: linear-gradient(135deg, #13294b 0%, #1e3a6f 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        
        .logo {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .logo span {
            color: #00aaff;
        }
        
        .header h1 {
            font-size: 28px;
            margin-top: 10px;
            font-weight: 300;
        }
        
        .content {
            padding: 40px 30px;
            background: #ffffff;
        }
        
        .welcome-message {
            font-size: 24px;
            color: #13294b;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .welcome-message strong {
            color: #1e3a6f;
            border-bottom: 2px solid #00aaff;
            display: inline-block;
            padding-bottom: 5px;
        }
        
        .message-box {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
            padding: 25px;
            border-radius: 15px;
            margin: 25px 0;
            text-align: center;
            border-left: 4px solid #00aaff;
        }
        
        .message-box p {
            color: #333;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        
        .icon {
            font-size: 50px;
            margin-bottom: 15px;
        }
        
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #13294b 0%, #1e3a6f 100%);
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 30px;
            margin-top: 20px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }
        
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 170, 255, 0.3);
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        
        .info-card {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }
        
        .info-card .emoji {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .info-card h4 {
            color: #13294b;
            margin-bottom: 8px;
            font-size: 16px;
        }
        
        .info-card p {
            color: #666;
            font-size: 14px;
            line-height: 1.4;
        }
        
        .footer {
            background: #f8f9fa;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }
        
        .footer p {
            color: #666;
            font-size: 12px;
            margin: 5px 0;
        }
        
        .social-links {
            margin-top: 15px;
        }
        
        .social-links a {
            color: #1e3a6f;
            text-decoration: none;
            margin: 0 10px;
            font-size: 20px;
            transition: color 0.3s ease;
        }
        
        .social-links a:hover {
            color: #00aaff;
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 30px 20px;
            }
            
            .content {
                padding: 25px 20px;
            }
            
            .welcome-message {
                font-size: 20px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                SAMSUNG<span>⚡</span>
            </div>
            <h1>Bem-vindo à Família Samsung!</h1>
        </div>
        
        <div class="content">
            <div class="welcome-message">
                Olá, <strong>{{ $usuario->nome }}</strong>!
            </div>
            
            <div class="message-box">
                <div class="icon">🎉</div>
                <p><strong>Cadastro realizado com sucesso!</strong></p>
                <p>Estamos muito felizes em ter você conosco. Sua jornada na Samsung está apenas começando!</p>
            </div>
            
            <div class="info-grid">
                <div class="info-card">
                    <div class="emoji">📱</div>
                    <h4>Tecnologia de Ponta</h4>
                    <p>Acesse produtos e inovações exclusivas</p>
                </div>
                
                <div class="info-card">
                    <div class="emoji">🎁</div>
                    <h4>Ofertas Exclusivas</h4>
                    <p>Descontos especiais para novos membros</p>
                </div>
                
                <div class="info-card">
                    <div class="emoji">💡</div>
                    <h4>Suporte Premium</h4>
                    <p>Atendimento dedicado 24/7</p>
                </div>
            </div>
            
            <div style="text-align: center;">
                <a href="#" class="button">Explorar Novidades →</a>
            </div>
        </div>
        
        <div class="footer">
            <p>© 2024 Samsung Electronics. Todos os direitos reservados.</p>
            <p>Este é um email automático, por favor não responda.</p>
            <div class="social-links">
                <a href="#">📘 Facebook</a>
                <a href="#">📸 Instagram</a>
                <a href="#">🐦 Twitter</a>
            </div>
        </div>
    </div>
</body>
</html>