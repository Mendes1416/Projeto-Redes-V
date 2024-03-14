<?php
include('config.php');

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se todos os campos do formulário foram preenchidos
    if (isset($_POST['anuncio_id'], $_POST['codigo'], $_POST['tipo_de_oferta'], $_POST['carreira'], $_POST['organismo'], $_POST['data_limite'], $_POST['descricao'])) {
        // Obtendo os dados do formulário
        $anuncio_id = $_POST['anuncio_id'];
        $codigo = $_POST['codigo'];
        $tipo_de_oferta = $_POST['tipo_de_oferta'];
        $carreira = $_POST['carreira'];
        $organismo = $_POST['organismo'];
        $data_limite = $_POST['data_limite'];
        $descricao = $_POST['descricao'];

        // Obtendo a conexão com o banco de dados
        $pdo = connect_db();

        // Atualizando os dados do anúncio no banco de dados
        $sql = "UPDATE `anuncios` SET codigo = :codigo, tipo_de_oferta = :tipo_de_oferta, carreira = :carreira, organismo = :organismo, data_limite = :data_limite, Descricao = :descricao WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':tipo_de_oferta', $tipo_de_oferta);
        $stmt->bindParam(':carreira', $carreira);
        $stmt->bindParam(':organismo', $organismo);
        $stmt->bindParam(':data_limite', $data_limite);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $anuncio_id);
        $stmt->execute();

        // Redirecionando de volta para a página de detalhes do anúncio
        header("Location: detalhes_anuncio.php?id=" . $anuncio_id);
        exit;
    } else {
        // Se algum campo estiver faltando, redirecione de volta para a página de edição com uma mensagem de erro
        header("Location: EditarAnuncio.php?id=" . $_POST['anuncio_id'] . "&error=missing_fields");
        exit;
    }
} else {
    // Se o formulário não foi submetido, redirecione de volta para a página de edição
    header("Location: EditarAnuncio.php?id=" . $_POST['anuncio_id']);
    exit;
}
?>
