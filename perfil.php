<?php
$title = "Editar o perfil";
require(__DIR__ . '/inc/header.php');
require(__DIR__ . '/inc/Navar.php');
include('config.php');

// Obtém os dados do usuário
$id_Utilizador = $_SESSION["id"];

$conn = connect_db();
$sql = "SELECT * FROM Alunos WHERE id=$id_Utilizador";
$result = $conn->query($sql);
$Utilizador = $result->fetch();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $id = $_POST['id'];
    $new_username = $_POST['username'];
    $curso = $_POST['curso'];

    // Verifica se o novo nome de usuário já existe
    $check_username_sql = "SELECT COUNT(*) as count FROM Alunos WHERE username='$new_username' AND id != $id";
    $check_username_result = $conn->query($check_username_sql);
    $username_row = $check_username_result->fetch();
    $username_count = $username_row['count'];

    if ($username_count > 0) {
        // Se o nome de usuário já existe, exibe uma mensagem de erro
        $alert_message = "Nome de Utilizador já existe. Por favor, escolha outro.";
    } else {
        // Atualiza os dados no banco de dados
        $update_sql = "UPDATE Alunos SET username='$new_username', curso='$curso' WHERE id=$id";
        if ($conn->query($update_sql) === TRUE) {
            // Redireciona para o index
            header("Location: index.php");
            exit(); // Certifica-se de que o código não continua a ser executado após o redirecionamento
        } else {
            // Se houver um erro ao executar a consulta de atualização, exibe o erro
            // echo "Erro ao atualizar perfil: " , $conn->error;
        }
    }
}

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Editar Perfil</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" name="id" value="<?php echo $Utilizador['id']; ?>">
                        <div class="form-group">
                            <label for="username">Nome de Utilizador:</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $Utilizador['username']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="curso">Curso:</label>
                            <input type="text" class="form-control" id="curso" name="curso" value="<?php echo $Utilizador['curso']; ?>" required>
                        </div>
                        <?php if (isset($alert_message)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $alert_message; ?>
                            </div>
                        <?php endif; ?>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require(__DIR__ . '/inc/footer.php'); ?>
