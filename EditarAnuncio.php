<?php
$title = "Editar Anúncio";
include('config.php');
require(__DIR__ . '/inc/header.php');
require(__DIR__ . '/inc/Navar.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: LoginEmpresa.php");
    exit();
}


// Verificar se o ID do anúncio está presente na URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $anuncio_id = $_GET['id'];

    // Obtendo a conexão com o banco de dados
    $pdo = connect_db();

    // Consulta para obter os detalhes do anúncio
    $sql = "SELECT * FROM `anuncios` WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $anuncio_id);
    $stmt->execute();

    // Verificar se o anúncio existe
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
        <div class="card">
            <h5 class="card-header text-center">Editar Anúncio</h5>
            <div class="card-body">
                <form  id="myForm" action="processarAnuncio.php" method="post">
                    <input type="hidden" name="anuncio_id" value="<?php echo $anuncio['id']; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo">Código:</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $anuncio['codigo']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_de_oferta">Tipo de Oferta:</label>
                                <input type="text" class="form-control" id="tipo_de_oferta" name="tipo_de_oferta" value="<?php echo $anuncio['tipo_de_oferta']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="carreira">Carreira:</label>
                                <input type="text" class="form-control" id="carreira" name="carreira" value="<?php echo $anuncio['carreira']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="organismo">Organismo:</label>
                                <input type="text" class="form-control" id="organismo" name="organismo" value="<?php echo $anuncio['organismo']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_limite">Data Limite:</label>
                                <input type="text" class="form-control" id="data_limite" name="data_limite" value="<?php echo $anuncio['data_limite']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descricao">Descrição:</label>
                                <textarea class="form-control" id="descricao" name="descricao"><?php echo $anuncio['Descricao']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    ?>

    <script>
        document.getElementById("myForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            // Simulate successful form processing (replace with actual processing logic)
            setTimeout(function() {
                alert("Anúncio salvo com sucesso!");
                // Optionally, submit the form after a short delay
                document.getElementById("myForm").submit();
            }, 1000); // Delay for 1 second
        });
    </script>
</body>

</html>