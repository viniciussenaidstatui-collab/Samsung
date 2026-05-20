<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Recuperação de Senha</title>
</head>
<body style="font-family: sans-serif; background: #f5f5f5; padding: 32px;">
    <div style="max-width: 480px; margin: 0 auto; background: #fff; border-radius: 8px; padding: 32px;">
        <h2 style="margin-top: 0;">Recuperação de senha</h2>
        <p>Recebemos uma solicitação para redefinir a sua senha.</p>
        <p>Use o código abaixo. Ele é válido por <strong>10 minutos</strong>:</p>

        <div style="font-size: 32px; font-weight: bold; letter-spacing: 8px; text-align: center;
                    background: #f0f0f0; border-radius: 8px; padding: 16px; margin: 24px 0;">
            {{ $codigo }}
        </div>

        <p style="color: #888; font-size: 13px;">
            Se você não solicitou a recuperação de senha, ignore este e-mail.
            Sua senha não será alterada.
        </p>
    </div>
</body>
</html>