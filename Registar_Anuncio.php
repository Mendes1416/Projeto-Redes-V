<?php
require(__DIR__ . '/inc/header.php');
?>

<?php
// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados (substitua as credenciais conforme necessário)
    $servername = "localhost";
    $username = "root";
    $password = '';
    $dbname = "SITE";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Configurar o PDO para lançar exceções em caso de erro
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar a declaração de inserção
        $stmt = $conn->prepare("INSERT INTO anuncios (codigo, tipo_de_oferta, carreira, organismo, data_limite, descricao) VALUES (:codigo, :tipo_de_oferta, :carreira, :organismo, :data_limite, :descricao)");

        // Ligação dos parâmetros da declaração de inserção
        $stmt->bindParam(':codigo', $_POST['codigo']);
        $stmt->bindParam(':tipo_de_oferta', $_POST['tipo_de_oferta']);
        $stmt->bindParam(':carreira', $_POST['carreira']);
        $stmt->bindParam(':organismo', $_POST['organismo']);
        $stmt->bindParam(':data_limite', $_POST['data_limite']);
        $stmt->bindParam(':descricao', $_POST['descricao']);

        // Executar a declaração
        $stmt->execute();

        echo "Anúncio inserido com sucesso!";
    } catch (PDOException $e) {
        echo "Erro na inserção do anúncio: " . $e->getMessage();
    }

    // Fechar a conexão
    $conn = null;
}
?>


<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Registo do Anúncio</h2>
                        <form action="validar_anuncio.php" method="post" id="form-anuncio">
                            <div class="form-group">
                                <label for="codigo">Código:</label>
                                <input type="text" name="codigo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo_de_oferta">Tipo de Oferta:</label>
                                <input type="text" name="tipo_de_oferta" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="carreira">Carreira:</label>
                                <input type="text" name="carreira" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="organismo">Organismo:</label>
                                <input type="text" name="organismo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="data_limite">Data Limite:</label>
                                <input type="date" name="data_limite" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="descricao">Descrição:</label>
                                <textarea name="descricao" class="form-control" required></textarea>
                            </div>
                            <br>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Registar Anúncio</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require(__DIR__ . '/inc/footer.php'); ?>
    
</body>
</body>