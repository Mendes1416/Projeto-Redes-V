<?php
$title = "Editar o perfil da Empresa";
session_start();
require(__DIR__ . '/inc/header.php');
include('config.php');

// Obtém os dados do usuário
$nif= $_SESSION["NIF"];

$conn = connect_db();
$sql = "SELECT * FROM empresa WHERE NIF='$nif'";
$result = $conn->query($sql);
$nif = $result->fetch();
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $nif = $_POST['NIF'];
    $cae = $_POST['CAE'];
    $nome = $_POST['nome'];
    $email = $_POST['Email'];
    $morada = $_POST['Morada'];
    $cod_postal = $_POST['cod_postal'];
    $localidade = $_POST['localidade'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verifica se o NIF já existe
    $check_nif_sql = "SELECT COUNT(*) as count FROM empresa WHERE NIF='$nif' AND NIF != '$nif'";
    $check_nif_result = $conn->query($check_nif_sql);
    $nif_row = $check_nif_result->fetch();
    $nif_count = $nif_row['count'];

    if ($nif_count > 0) {
        // Se o NIF já existe, exibe uma mensagem de erro
        echo "O NIF fornecido já está em uso. Por favor, escolha outro NIF.";
    } else {
        // Atualiza os dados no banco de dados
        $update_sql = "UPDATE empresa SET NOME='$nome', Password='$password', CAE='$cae', Email='$email', Morada='$morada', Cod_postal='$cod_postal', Localidade='$localidade' WHERE NIF='$nif'";
        if ($conn->query($update_sql) === TRUE) {
            // Redireciona para o index
            header("Location: index.php");
            exit(); // Certifica-se de que o código não continua a ser executado após o redirecionamento
        } else {
            // Se houver um erro ao executar a consulta de atualização, exibe o erro
            echo "Erro ao atualizar perfil: ", $conn->errorCode();
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
                        <h2 class="text-center">Editar Perfil</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="nif" value="<?php echo $nif['NIF']; ?>">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nif['NOME']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="cae">CAE:</label>
                                <input type="text" class="form-control" id="cae" name="cae" value="<?php echo $nif['CAE']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $nif['Email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="morada">Morada:</label>
                                <input type="text" class="form-control" id="morada" name="morada" value="<?php echo $nif['Morada']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="cod_postal">Código Postal:</label>
                                <input type="text" class="form-control" id="cod_postal" name="cod_postal" value="<?php echo $nif['Cod_postal']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="Nif">NIF:</label>
                                <input type="text" class="form-control" name="nif" value="<?php echo $nif['NIF']; ?>" readonly>

                            </div>
                            <div class="form-group">
                                <label for="localidade">Localidade:</label>
                                <input type="text" class="form-control" id="localidade" name="localidade" value="<?php echo $nif['Localidade']; ?>" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">Salvar Alterações</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>