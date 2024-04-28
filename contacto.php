<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Contato</title>
</head>
<body>
    <h2>Entre em Contato</h2>
    <form action="enviar_email.php" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br>
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="mensagem">Mensagem:</label><br>
        <textarea id="mensagem" name="mensagem" required></textarea><br><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
