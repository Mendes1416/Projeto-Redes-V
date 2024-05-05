<?php
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Se o usuário já estiver logado, redirecione para o índice
    header('Location: index.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = '';
$dbname = "SITE";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $utilizador = $_POST['utilizador'];
    $senha = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM empresa WHERE (nome = :utilizador OR NIF = :utilizador OR Email = :utilizador) AND Validada = 1 LIMIT 1");
    $stmt->bindParam(':utilizador', $utilizador);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($senha, $row['Password'])) {
            session_start();
            $_SESSION["nif"] = $row['nif'];
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['nome'];
            $_SESSION['empresa'] = true;
            header('Location: index.php');
            exit;
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Utilizador não encontrado ou não validado.";
    }
} catch (PDOException $e) {
    echo "Erro ao realizar login: " . $e->getMessage();
}

$conn = null;

if (isset($erro)) {
    echo $erro;
}
?>
