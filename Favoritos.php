<?php
$title="Pagina dos Anúncios Favoritos";
include('config.php');
require(__DIR__ . '/inc/header.php');
require(__DIR__ . '/inc/Navar.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: Login.php");
    exit();
}

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

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Anúncios Favoritos</h1>
        <div class="table-responsive">
            <div class="card">
                <div class="card-body">
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
        </div>
    </div>
</body>
</html>
