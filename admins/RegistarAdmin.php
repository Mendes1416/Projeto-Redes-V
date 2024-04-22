<?php

$title = "Registo do Administrador";
require_once "..\config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$nome = $email = $password = $confirm_password = "";
$nome_err = $email_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["nome"]))) {
        $nome_err = "Por favor, insira o Nome.";
    } else {
        $nome = trim($_POST["nome"]);
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, insira o email.";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Formato de email inválido.";
        } else {
            // Verifica se o email contém o domínio da escola
            if (!preg_match("/@(a|esenviseu)\.net$/i", $email)) {
                $email_err = "O email deve ser do domínio da escola.";
            } else {
                // Verifica se o email já existe na base de dados
                $sql_check_email = "SELECT id FROM admins WHERE email = :email";
                $pdo = connect_db();
                $stmt_check_email = $pdo->prepare($sql_check_email);
                $stmt_check_email->bindParam(":email", $param_email, PDO::PARAM_STR);
                $param_email = $email;
                $stmt_check_email->execute();
                if ($stmt_check_email->rowCount() > 0) {
                    $email_err = "Este email já está em uso.";
                }
                unset($stmt_check_email);
            }
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, insira a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "A password deve ter no mínimo 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor, confirme a password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password != $confirm_password) {
            $confirm_password_err = "As senhas não coincidem.";
        }
    }

    if (empty($nome_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO admins (nome, email, password) VALUES (:nome, :email, :password)";
        $pdo = connect_db();
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":nome", $param_nome, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            $param_nome = $nome;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if ($stmt->execute()) {
                header("location: loginAdmin.php");
                exit();
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            unset($stmt);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo do Administrador</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <img src="../img/Admin.png" class="img-fluid mx-auto d-block mb-3" alt="Imagem de Login" style="width: 40%;">

                        <h2 class="text-center">Registo</h2>
                        <p class="text-center">Preencha este formulário para criar a sua conta de administrador.</p>
                        <form id="registerForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Nome do Administrador</label>
                                <input type="text" name="nome" id="nome" class="form-control <?php echo (!empty($nome_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nome; ?>">
                                <span class="invalid-feedback"><?php echo $nome_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Confirme a senha</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </div>
                            <div class="form-group text-center mb-3">
                                <input type="submit" class="btn btn-primary" value="Criar Conta">
                                <input type="button" class="btn btn-secondary ml-2" value="Limpar Dados" onclick="clearForm()">
                            </div>
                            <p class="text-center">Já tem uma conta? <a href="loginAdmin.php">Entre aqui</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (opcional, apenas para funcionalidades do Bootstrap que usam JavaScript) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function clearForm() {
            document.getElementById("registerForm").reset();
        }
    </script>
</body>
</html>
