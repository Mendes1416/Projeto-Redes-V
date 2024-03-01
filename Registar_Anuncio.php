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
        $stmt->bindParam(':descricao', $_POST['descricao']); // Corrigido para :descricao

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

<div class="container text-center">
    <div class="mx-auto">
        <h2>Registrar Novo Anúncio</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
            <button type="submit" class="btn btn-primary">Registrar Anúncio</button>
        </form>
    </div>
</div>
