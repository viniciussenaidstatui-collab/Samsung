<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código de Autenticação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            text-align: center;
        }
        .code {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin: 20px 0;
        }
        .message {
            font-size: 16px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Código de Autenticação</h2>
        <p class="code">{{ $codigo }}</p>
        <p class="message">Este código é válido por 10 minutos.</p>
    </div>
</body>
</html>