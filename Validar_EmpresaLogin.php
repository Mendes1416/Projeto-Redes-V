<?php

$servername = "localhost";
$username = "root";
$password = '';
$dbname = "site";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Defina o modo de erro do PDO como exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtém os dados do formulário
    $utilizador = $_POST['utilizador'];
    $senha = $_POST['password'];

    // Verifica se o usuário existe no banco de dados
    $stmt = $conn->prepare("SELECT * FROM empresa WHERE (nome = :utilizador OR NIF = :utilizador OR Email = :utilizador) AND Validada = 1 LIMIT 1");
    $stmt->bindParam(':utilizador', $utilizador);
    $stmt->execute();

    // Verifica a senha
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($senha, $row['Password'])) {
            // Login bem-sucedido. Inicia a sessão e redireciona para a página de índice
            session_start();
            $_SESSION["nif"] = $row['nif'];
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['nome'];
            $_SESSION['empresa'] = true;
            header('Location: index.php');
            exit;
        } else {
            // Exibe mensagem de senha incorreta
            $erro = "Senha incorreta.";
        }
    } else {
        // Exibe mensagem de usuário não encontrado ou não validado
        $erro = "Utilizador não encontrado ou não validado.";
    }
} catch (PDOException $e) {
    echo "Erro ao realizar login: " . $e->getMessage();
}

// Fecha a conexão com o banco de dados
$conn = null;

// Se houver algum erro, exibe-o
if (isset($erro)) {
    echo $erro;
}
