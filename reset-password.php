<?php
require(__DIR__ . '/inc/header.php');
// Inicialize a sessão
session_start();

// Verifique se o utilizador está logado, caso contrário, redirecione para a página de login

// Incluir arquivo de configuração
require_once "config.php";

// Defina variáveis e inicialize com valores vazios
$username = $new_password = $confirm_password = "";
$username_err = $new_password_err = $confirm_password_err = "";

// Processando dados do formulário quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar nome de utilizador
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor, insira o nome de utilizador.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validar nova senha
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Por favor, insira a nova senha.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validar e confirmar a senha
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor, confirme a senha.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "A senha não confere.";
        }
    }

    // Verifique os erros de entrada antes de atualizar o banco de dados
    if (empty($username_err) && empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare uma declaração de atualização
        $sql = "UPDATE users SET password = :password WHERE username = :username";

        // Inicializar a conexão PDO
        $pdo = connect_db();

        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Definir parâmetros
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_username = $username;

            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                // Senha atualizada com sucesso. Destrua a sessão e redirecione para a página de login
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            // Fechar declaração
            unset($stmt);
        }
        // Fechar conexão
        unset($pdo);
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Redefinir senha</h2>
                    <p class="text-center">Por favor, preencha este formulário para redefinir a sua senha.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nome de utilizador</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Nova senha</label>
                            <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                            <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Confirme a senha</label>
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" value="Redefinir">
                                <a class="btn btn-link ml-2" href="index.php">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require __DIR__ . '/inc/footer.php';
?>
