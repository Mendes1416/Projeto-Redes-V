<?php
session_start();

require_once "../config.php";


// Verificando se o usuário já está logado
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// Verificando se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pdo = connect_db();
    // Buscando o usuário no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE nome or email = ?");
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
        $error = "Nome de Utilizador  ou PASSWORD incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2>Login Admin</h2>
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nome do Admin ou email:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group text-center mb-3">
                                <input type="submit" class="btn btn-primary" value="Entrar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>