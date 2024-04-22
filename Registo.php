<?php
$title = "Registo do Aluno";
require(__DIR__ . '/inc/header.php');
require(__DIR__ . '/inc/Navar.php');
require_once "config.php";

$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $curso_err = $email_err = "";
$curso = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor, insira o Nome.";
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
        } else {
            // Verifica se o email contém o domínio da escola
            if (!preg_match("/@(a|esenviseu)\.net$/i", $email)) {
                $email_err = "O email deve ser do domínio da escola.";
            } else {
                // Verifica se o email já existe na base de dados
                $sql_check_email = "SELECT id FROM users WHERE email = :email";
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

    // Verificar se o arquivo foi enviado sem erros
    // Check if file was uploaded without errors
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

        // saves name, typr and size file
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];


        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) $uploadfile_err = "Erro: Insira um ficheiro num formato válido.";

        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) $uploadfile_err = "Erro: O tamanho do ficheiro ultrapassa o limite permitido.";

        // Verify MYME type of the file
        if (in_array($filetype, $allowed)) {
            // Check whether file exists before uploading it
            if (file_exists("upload/" . $filename)) {

                // CODIFICAR O NOME DO FICHEIRO PARA QUE SEJA ÚNICO

                $uploadfile_err = "O ficheiro " . $param_photo . " já existe.";
            }
        } else {
            $uploadfile_err = "Erro: existe problemas com o carregamento do ficheir. Tente novamente!";
            // $photo = null;
        }
    } else {
        echo "Error: " . $_FILES["photo"]["error"];
    }
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Obter informações sobre o arquivo enviado
        $file_tmp_name = $_FILES['photo']['tmp_name'];
        $file_name = $_FILES['photo']['name'];
        $file_size = $_FILES['photo']['size'];
        $file_type = $_FILES['photo']['type'];

        // Mover o arquivo temporário para um local permanente
        $upload_dir = 'uploads/';
        $target_file = $upload_dir . basename($file_name);

        // Salvar o nome do arquivo na base de dados
        // $photo = $target_file;
        $photo = basename($file_name);
    }

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($curso_err)) {
        $sql = "INSERT INTO users (username, password, email, curso, photo) VALUES (:username, :password, :email, :curso, :photo)";
        $pdo = connect_db();
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":curso", $param_curso, PDO::PARAM_STR);
            $stmt->bindParam(":photo", $param_photo, PDO::PARAM_STR);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_email = $email;
            $param_curso = $curso;
            $param_photo = $photo;

            if ($stmt->execute()) {
                if (isset($file_tmp_name)) {
                    move_uploaded_file($file_tmp_name, $target_file);
                }
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
                        <img src="img/Login.jpg" class="img-fluid mx-auto d-block mb-3" alt="Imagem de Login" style="width: 40%;">

                        <h2 class="text-center">Registo</h2>
                        <p class="text-center">Preencha este formulário para criar a sua conta.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
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
                                <select name="curso" class="form-control <?php echo (!empty($curso_err)) ? 'is-invalid' : ''; ?>">
                                    <option value="" disabled selected>Selecione o Curso</option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Ação Educativa">Ação Educativa</option>
                                    <option value="Auxiliar de Saúde">Auxiliar de Saúde</option>
                                    <option value="Desporto">Desporto</option>
                                    <option value="Eletrónica, Automação e Comando">Eletrónica, Automação e Comando</option>
                                    <option value="Gestão">Gestão</option>
                                    <option value="Gestão e Programação de Sistemas Informáticos">Gestão e Programação de Sistemas Informáticos</option>
                                    <option value="Manutenção Industrial de Metalurgia e Metalomecânica">Manutenção Industrial de Metalurgia e Metalomecânica</option>
                                    <option value="Mecatrónica Automóvel">Mecatrónica Automóvel</option>
                                    <option value="Multimédia">Multimédia</option>
                                    <option value="Turismo Ambiental e Rural">Turismo Ambiental e Rural</option>
                                </select>
                                <span class="invalid-feedback"><?php echo $curso_err; ?></span>
                            </div>


                            <div class="form-group">
                                <label>Fotografia de Perfil</label>
                                <input type="file" name="photo" class="form-control-file">
                            </div>
                            <br>
                            <div class="form-group text-center mb-3s">
                                <input type="submit" class="btn btn-primary" value="Criar Conta">
                                <input type="reset" class="btn btn-secondary ml-2" value="Limpar Dados">
                            </div>
                            <br>
                            <p class="text-center">Já tem uma conta? <a href="login.php">Entre aqui</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>