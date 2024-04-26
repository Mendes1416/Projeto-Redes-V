<?php
$title = "Login do Aluno";
require(__DIR__ . '/inc/header.php');
require(__DIR__ . '/inc/Navar.php');
require_once "config.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

$username = $password = "";
$username_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor, insira o nome do utilizador ou email.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, insira sua password.";
    } else {
        $password  = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password, photo FROM users WHERE username = :username OR email = :email";
        $pdo = connect_db();
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            $param_username = $username;
            $param_email = $username;

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if (password_verify($password, $hashed_password)) {
                            // session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["photo"] = $row["photo"]; // Armazena o caminho da foto na sessão
                            $_SESSION['empresa'] = false;
                            header("location: index.php");
                            exit;
                        } else {
                            $login_err = "Nome de utilizador ou senha inválidos.";
                        }
                    }
                } else {
                    $login_err = "Nome de utilizador ou senha inválidos.";
                }
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
?>
<body>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <img src="img/Login.jpg" class="img-fluid mx-auto d-block mb-3" alt="Imagem de Login" style="width: 50%;">
                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Por favor, preencha os campos para fazer o login.</p>
                    <?php
                    if (!empty($login_err)) {
                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nome do Utilizador ou Email</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="a1234@esenviseu.net">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label>Senha</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group text-center mb-3">
                            <input type="submit" class="btn btn-primary" value="Entrar">
                        </div>
                        <p class="text-center">Esqueceu sua password? <a href="reset-password.php">Clique aqui</a>.</p>
                        <p class="text-center">Não tem uma conta? <a href="registo.php">Inscreva-se agora</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

 
