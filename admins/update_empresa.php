<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SITE";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Obtém os dados do formulário
    $NIF = $_POST['NIF'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $email = $_POST['email'];
    // Adicione outros campos conforme necessário

    // Prepara e executa a consulta SQL para atualizar os dados da empresa
    $sql = "UPDATE empresa SET nome='$nome', Descricao='$descricao', Email='$email' WHERE NIF='$NIF'";

    if ($conn->query($sql) === TRUE) {
        echo "Dados da empresa atualizados com sucesso.";
    } else {
        echo "Erro ao atualizar os dados da empresa: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    // Se o formulário não foi submetido, redireciona de volta para a página anterior
    header("Location: dashboard.php");
    exit();
}
?>
