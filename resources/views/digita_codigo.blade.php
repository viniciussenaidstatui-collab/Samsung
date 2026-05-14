<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação em Duas Etapas</title>
    
    <!-- Carrega jQuery APENAS uma vez, com a URL correta -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Carrega os plugins depois do jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Seu script personalizado -->
    <script src="autenticacao_dupla.js"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #6f42c1;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #2d1b4e;
        }
        h2 {
            color: #333;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Digite o código de autenticação</h2>
    <input type="text" id="codigo" placeholder="Código de autenticação">
    <input type="text" id="email" name="email" placeholder="Email">
    <button id="enviar_codigo">Enviar</button>
</body>
</html>