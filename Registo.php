<?php
// session_start();
require(__DIR__ . '/inc/header.php');
require_once "config.php";

$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $curso_err = $email_err = "";
$curso = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err  = "Por favor, insira o Nome.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, insira a password.";
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

    if (empty(trim($_POST["curso"]))) {
        $curso_err = "Por favor, insira o curso.";
    } else {
        $curso = trim($_POST["curso"]);
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, insira o email.";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Formato de email inválido.";
        }
    }

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) &&   empty($email_err) && empty($curso_err)) {
        $sql = "INSERT INTO users (username, password, email, curso) VALUES (:username, :password, :email, :curso)";
        $pdo=connect_db();
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":curso", $param_curso, PDO::PARAM_STR);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_email = $email;
            $param_curso = $curso;

            if ($stmt->execute()) {
                header("location: login.php");
                exit();
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            unset($stmt);
        }
    }
}
?>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Registo</h2>
                        <p class="text-center">Preencha este formulário para criar uma conta.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Nome do utilizador </label>
                                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Senha</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                    
                                </div>
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Confirme a senha</label>
                                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </div>
                            <div class="form-group mb-3">
                                <label>Curso</label>
                                <input type="text" name="curso" class="form-control <?php echo (!empty($curso_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $curso; ?>">
                                <span class="invalid-feedback"><?php echo $curso_err; ?></span>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Criar Conta">
                                <input type="reset" class="btn btn-secondary ml-2" value="Limpar Dados">
                            </div>
                            <p class="text-center">Já tem uma conta? <a href="login.php">Entre aqui</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
