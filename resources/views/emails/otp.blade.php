<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Email - Encanto Pet</title>
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
            <p ">
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
