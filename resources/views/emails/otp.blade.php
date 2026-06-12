<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Email - Encanto Pet</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; background: #f4f4f4; padding: 20px; }
        .wrapper { max-width: 500px; margin: 40px auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,.08); }
        .header { background: linear-gradient(135deg, #f2c94c, #f2a900); padding: 32px; text-align: center; }
        .header h1 { color: #333; font-size: 22px; font-weight: 700; }
        .body { padding: 36px 32px; text-align: center; }
        .body p { color: #555; font-size: 15px; line-height: 1.6; margin-bottom: 20px; }
        .code-box { background: #fffbea; border: 2px dashed #f2c94c; border-radius: 12px; padding: 20px 32px; display: inline-block; margin: 16px 0 28px; }
        .code-box span { font-size: 42px; font-weight: 700; letter-spacing: 14px; color: #333; }
        .expiry { background: #fef3cd; border-radius: 8px; padding: 10px 16px; font-size: 13px; color: #856404; margin-bottom: 24px; }
        .footer { padding: 20px 32px; border-top: 1px solid #f0f0f0; text-align: center; }
        .footer p { font-size: 12px; color: #aaa; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>🐾 Encanto Pet</h1>
        </div>
        <div class="body">
            <p>Olá, <strong>{{ $userName }}</strong>!</p>
            <p>Use o código abaixo para confirmar seu cadastro:</p>
            <div class="code-box">
                <span>{{ $code }}</span>
            </div>
            <div class="expiry">
                ⏱ Este código expira em <strong>10 minutos</strong>.
            </div>
            <p style="font-size:13px;color:#888;">
                Se você não realizou este cadastro, ignore este email.<br>
                Nunca compartilhe este código com ninguém.
            </p>
        </div>
        <div class="footer">
            <p>Encanto Pet &mdash; O melhor para o seu bichinho 🐶🐱</p>
        </div>
    </div>
</body>
</html>
