<?php
$title = "Detalhes do anuncio";
include('config.php');
require(__DIR__ . '/inc/header.php');
require(__DIR__ . '/inc/Navar.php');

// Obtendo a conexão com o banco de dados
$pdo = connect_db();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $anuncio_id = $_GET['id'];

    $sql = "SELECT * FROM `anuncios` WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $anuncio_id);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $anuncio = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Detalhes do Anúncio</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td><?php echo $anuncio['id']; ?></td>
                    </tr>
                    <tr>
                        <th>Código</th>
                        <td><?php echo $anuncio['codigo']; ?></td>
                    </tr>
                    <tr>
                        <th>Tipo de Oferta</th>
                        <td><?php echo $anuncio['tipo_de_oferta']; ?></td>
                    </tr>
                    <tr>
                        <th>Carreira</th>
                        <td><?php echo $anuncio['carreira']; ?></td>
                    </tr>
                    <tr>
                        <th>Organismo</th>
                        <td><?php echo $anuncio['organismo']; ?></td>
                    </tr>
                    <tr>
                        <th>Data Limite</th>
                        <td><?php echo $anuncio['data_limite']; ?></td>
                    </tr>
                    <tr>
                        <th>Descrição</th>
                        <td><?php echo $anuncio['Descricao']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <!-- Botão para adicionar aos favoritos -->
            <a href="Favoritos.php?anuncio_id=<?php echo $anuncio['id']; ?>" class="btn btn-primary">Adicionar aos Favoritos</a>
            <!-- Botão para editar o anúncio -->
            <a href="EditarAnuncio.php?id=<?php echo $anuncio['id']; ?>" class="btn btn-secondary">Editar Anúncio</a>
        </div>
    </div>
</body>

</html>
