<?php
// Incluir o arquivo de conexão com o banco de dados
require(__DIR__ . '/inc/header.php');
require(__DIR__.'/inc/Navar.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: LoginEmpresa.php");
    exit();
}

// Conexão com o banco de dados (substitua as credenciais conforme necessário)
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "SITE";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurar o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para recuperar os cursos do banco de dados
    $stmt = $conn->prepare("SELECT id, nome FROM cursos");
    $stmt->execute();
    $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
?>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Registro do Anúncio</h2>
                        <form action="validar_anuncio.php" method="post" id="form-anuncio">
                            <div class="form-group">
                                <label for="codigo">Código:</label>
                                <input type="text" name="codigo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo_de_oferta">Tipo de Oferta:</label>
                                <select name="tipo_de_oferta" class="form-control" required>
                                    <option value="Full-Time">Full-Time</option>
                                    <option value="Part-Time">Part-Time</option>
                                    <option value="Estágio">Estágio</option>
                                </select>
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
                            <div class="form-group">
                                <label for="curso">Curso:</label>
                                <select name="curso" class="form-control" required>
                                    <option value="">Selecione o curso...</option>
                                    <?php
                                    // Loop através dos cursos e criar uma opção para cada um
                                    foreach ($cursos as $curso) {
                                        echo "<option value='" . $curso['id'] . "'>" . $curso['nome'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Registrar Anúncio</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require(__DIR__ . '/inc/footer.php'); ?>
</body>
