<?php
session_start();
require_once "../config.php";
$title = "Login do Administrador";

// Verificando se o usuário já está logado
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Verificando se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pdo=connect_db();
    // Buscando o usuário no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE nome = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verificando a senha
    if ($user && password_verify($password, $user['PASSWORD'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['nome'];
        $_SESSION['role'] = $user['role'];

        // Redirecionando para a dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Nome de usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Nome de usuário:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
