<?php
require(__DIR__ . '/inc/header.php');

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}

// Processa o formulário para adicionar anúncio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta ao banco de dados (substitua pelos seus detalhes de conexão)
    $servername = "localhost";
    $username = "root";
    $password = '';
    $dbname = "site";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Defina o modo de erro do PDO como exceção
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a consulta para inserir os dados na tabela de anúncios
        $stmt = $conn->prepare("INSERT INTO anuncios (codigo, tipo_oferta, user_id) VALUES (?, ?, ?)");

        // Obtém os dados do formulário
        $codigo = $_POST['codigo'];
        $tipo_oferta = $_POST['tipo_oferta'];
        $userId = $_SESSION['user_id']; // Altere para o nome real da coluna que armazena o ID do usuário na tabela

        // Executa a consulta
        $stmt->execute([$codigo, $tipo_oferta, $userId]);

        echo "Anúncio adicionado com sucesso.";

    } catch (PDOException $e) {
        echo "Erro ao adicionar anúncio: " . $e->getMessage();
    }

    // Fecha a conexão com o banco de dados
    $conn = null;
}

require(__DIR__ . '/inc/footer.php');
?>
