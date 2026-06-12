<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Mensagem recebida - Encanto Pet</title>
</head>
<body style="font-family: Arial, sans-serif; color: #272936;">
    <h1 style="color: #f6b60b;">Nova mensagem do Fale conosco</h1>
    <p><strong>Nome:</strong> {{ $contactMessage->name }}</p>
    <p><strong>E-mail:</strong> {{ $contactMessage->email }}</p>
    <p><strong>Assunto:</strong> {{ $contactMessage->subject }}</p>
    <p><strong>Data e horário:</strong> {{ $contactMessage->created_at?->format('d/m/Y H:i') }}</p>
    <hr>
    <p style="white-space: pre-line;">{{ $contactMessage->message }}</p>
</body>
</html>
