<?php
require(__DIR__ . '/inc/header.php');

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: LoginEmpresa.php");
    exit();
}

// Processa o formulário para adicionar anúncio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta ao banco de dados (substitua pelos seus detalhes de conexão)
    $servername = "localhost";
    $username = "root";
    $password = '';
    $dbname = "SITE";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Defina o modo de erro do PDO como exceção
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtém os dados do formulário
        $codigo = $_POST['codigo'];
        $tipo_de_oferta = $_POST['tipo_de_oferta'];
        $carreira = $_POST["carreira"];
        $organismo = $_POST["organismo"];
        $data_limite = $_POST["data_limite"];
        $descricao = $_POST["descricao"];
        $curso_id = $_POST["curso"];

        // Prepara a consulta para inserir os dados na tabela de anúncios
        $stmt = $conn->prepare("INSERT INTO anuncios (codigo, tipo_de_oferta, carreira, organismo, data_limite, descricao, curso_id)
        VALUES (:codigo, :tipo_de_oferta, :carreira, :organismo, :data_limite, :descricao, :curso_id)");

        // Executa a consulta
        $stmt->execute([
            ':codigo' => $codigo,
            ':tipo_de_oferta' => $tipo_de_oferta,
            ':carreira' => $carreira,
            ':organismo' => $organismo,
            ':data_limite' => $data_limite,
            ':descricao' => $descricao,
            ':curso_id' => $curso_id
        ]);

        echo "Anúncio adicionado com sucesso.";
    } catch (PDOException $e) {
        echo "Erro ao adicionar anúncio: " . $e->getMessage();
    }

    // Fecha a conexão com o banco de dados
    $conn = null;
}
?>
