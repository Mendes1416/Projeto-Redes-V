<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Erro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Reportar Erro</h1>
        <form id="errorForm" method="post" action="sendError.php">
            <label for="email">Seu Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="error">Descreva o Erro:</label>
            <textarea id="error" name="error" required></textarea>
            
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>
