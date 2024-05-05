<?php
require(__DIR__ . '/inc/header.php');
require(__DIR__ . '/inc/Navar.php');

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
        $curso_id = $_POST["curso"]; // Novo campo

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
            ':curso_id' => $curso_id // Novo campo
        ]);

        echo "Anúncio adicionado com sucesso.";
    } catch (PDOException $e) {
        echo "Erro ao adicionar anúncio: " . $e->getMessage();
    }

    // Fecha a conexão com o banco de dados
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
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="form-anuncio">
                            <div class="form-group">
                                <label for="codigo">Código:</label>
                                <input type="text" name="codigo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo_de_oferta">Tipo de Oferta:</label>
                                <select name="tipo_de_oferta" class="form-control" required>
                                    <option value="Selecione o tipo de oferta">Tipo de oferta</option>
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
                                    <!-- Aqui você pode carregar os cursos do banco de dados -->
                                    <option value="" disabled selected>Selecione o Curso</option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Ação Educativa">Ação Educativa</option>
                                    <option value="Auxiliar de Saúde">Auxiliar de Saúde</option>
                                    <option value="Desporto">Desporto</option>
                                    <option value="Eletrónica, Automação e Comando">Eletrónica, Automação e Comando</option>
                                    <option value="Gestão">Gestão</option>
                                    <option value="Gestão e Programação de Sistemas Informáticos">Gestão e Programação de Sistemas Informáticos</option>
                                    <option value="Manutenção Industrial de Metalurgia e Metalomecânica">Manutenção Industrial de Metalurgia e Metalomecânica</option>
                                    <option value="Mecatrónica Automóvel">Mecatrónica Automóvel</option>
                                    <option value="Multimédia">Multimédia</option>
                                    <option value="Turismo Ambiental e Rural">Turismo Ambiental e Rural</option>
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
</body>
