<?php
session_start(); // Inicia a sessão


// Verifica se 'nome_admin' está definido na sessão
if (!isset($_SESSION['username'])) {
    // Se não estiver definido, redireciona para a página de login ou faça alguma outra ação adequada
    header("Location: LoginAdmin.php"); // Redireciona para a página de login
    exit(); // Encerra o script para garantir que nada mais seja executado
}

// Restante do seu código continua aqui...



// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SITE";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta para obter contas de usuários
$sql_usuarios = "SELECT * FROM users";
$result_usuarios = $conn->query($sql_usuarios);

// Consulta para obter empresas registradas
$sql_empresas = "SELECT * FROM empresa";
$result_empresas = $conn->query($sql_empresas);

// Consulta para obter anúncios inseridos
$sql_anuncios = "SELECT * FROM anuncios";
$result_anuncios = $conn->query($sql_anuncios);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Adicionando Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Bem-vindo, <?php echo $_SESSION['username']; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Contas</a>
                    </li>
                    <a class="nav-link" href="../index.php">Home</a>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['username']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../logout.php">Logout</a>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Contas de Alunos</strong></h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome do Aluno</th>
                                    <th>Curso</th>
                                    <th>Email</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result_usuarios->num_rows > 0) {
                                    while ($row = $result_usuarios->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["username"] . "</td>";
                                        echo "<td>" . $row["curso"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td><a href='delete_usuario.php?id=" . $row["id"] . "'>Excluir</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>Nenhuma conta de usuário encontrada</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Empresas Registradas</strong></h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome da Empresa</th>
                                            <th>Descrição</th>
                                            <th>Email</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result_empresas->num_rows > 0) {
                                            while ($row = $result_empresas->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["NIF"] . "</td>";
                                                echo "<td>" . $row["nome"] . "</td>";
                                                echo "<td>" . $row["Descricao"] . "</td>";
                                                echo "<td>" . $row["Email"] . "</td>";
                                                echo "<td><a href='delete_empresa.php?NIF=" . $row["NIF"] . "'>Excluir</a></td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>Nenhuma empresa registrada encontrada</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Anúncios Inseridos</strong></h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Código</th>
                                            <th>Tipo de Oferta</th>
                                            <th>Carreira</th>
                                            <th>Organismo</th>
                                            <th>Data Limite</th>
                                            <th>Descrição</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result_anuncios->num_rows > 0) {
                                            while ($row = $result_anuncios->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["id"] . "</td>";
                                                echo "<td>" . $row["codigo"] . "</td>";
                                                echo "<td>" . $row["tipo_de_oferta"] . "</td>";
                                                echo "<td>" . $row["carreira"] . "</td>";
                                                echo "<td>" . $row["organismo"] . "</td>";
                                                echo "<td>" . $row["data_limite"] . "</td>";
                                                echo "<td>" . $row["Descricao"] . "</td>";
                                                echo "<td><a href='delete_anuncio.php?id=" . $row["id"] . "'>Excluir</a></td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>Nenhum anúncio inserido encontrado</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Script para abrir o pop-up -->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
// Fechar conexão com o banco de dados
$conn->close();
?>