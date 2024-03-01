<?php
include('config.php');
require(__DIR__ . '/inc/header.php');

// Verificar se o formulário foi submetido
if (isset($_GET['anuncio_id'])) {
    // Conexão com o banco de dados (substitua as credenciais conforme necessário)
    $pdo = connect_db();

    // Verificar se o ID do anúncio foi recebido
    if (!empty($_GET['anuncio_id'])) {
        $anuncio_id = $_GET['anuncio_id'];

        $sql = "SELECT COUNT(*) FROM favoritos WHERE anuncio_id = :anuncio_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':anuncio_id', $anuncio_id);
        $stmt->execute();

        if ($stmt->fetch()[0] == 0) {
            $sql1 = "INSERT INTO favoritos (anuncio_id) VALUES (:anuncio_id)";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->bindParam(':anuncio_id', $anuncio_id);
            $stmt1->execute();
        }
    }
}

// Obtendo a conexão com o banco de dados
$pdo = connect_db();

// Selecionar todos os anúncios favoritos
$sql = "SELECT * FROM favoritos JOIN anuncios ON favoritos.anuncio_id = anuncios.id";
$stmt = $pdo->query($sql);
$favoritos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Anúncios Favoritos</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Tipo de Oferta</th>
                        <th>Carreira</th>
                        <th>Organismo</th>
                        <th>Data Limite</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($favoritos as $favorito) : ?>
                        <tr>
                            <td><?php echo $favorito['id']; ?></td>
                            <td><?php echo $favorito['codigo']; ?></td>
                            <td><?php echo $favorito['tipo_de_oferta']; ?></td>
                            <td><?php echo $favorito['carreira']; ?></td>
                            <td><?php echo $favorito['organismo']; ?></td>
                            <td><?php echo $favorito['data_limite']; ?></td>
                            <td><?php echo $favorito['Descricao']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
