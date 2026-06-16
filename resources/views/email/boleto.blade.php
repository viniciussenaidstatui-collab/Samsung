<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Boleto Gerado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #1428A0;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #1428A0;
            margin: 0;
        }
        .boleto-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .boleto-info p {
            margin: 8px 0;
        }
        .codigo-barras {
            background: #fff;
            border: 2px dashed #1428A0;
            padding: 15px;
            text-align: center;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
            font-size: 16px;
            letter-spacing: 2px;
            color: #1428A0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            background: #1428A0;
            color: white;
            padding: 10px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .valor {
            font-size: 24px;
            font-weight: bold;
            color: #1428A0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Boleto Samsung</h1>
            <p>Olá, {{ $usuario->nome }}!</p>
        </div>

        <p>Seu boleto foi gerado com sucesso. Seguem os dados para pagamento:</p>

        <div class="boleto-info">
            <p><strong>Valor:</strong> <span class="valor">R$ {{ number_format($valor, 2, ',', '.') }}</span></p>
            <p><strong>Vencimento:</strong> {{ date('d/m/Y', strtotime($vencimento)) }}</p>
            <p><strong>Nosso Número:</strong> {{ $nosso_numero }}</p>
        </div>

        <div class="codigo-barras">
            <strong>Código de Barras:</strong><br>
            {{ $codigo_barras }}
        </div>

        <div style="text-align: center; margin: 20px 0;">
            <p style="color: #666; font-size: 14px;">
                Este é um boleto de demonstração para testes.
            </p>
        </div>

        <div class="footer">
            <p>Este é um e-mail automático. Por favor, não responda.</p>
            <p>&copy; {{ date('Y') }} Samsung - Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>