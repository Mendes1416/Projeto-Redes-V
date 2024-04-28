<?php
session_start(); // Inicia a sessão

// Verifica se 'nome_admin' está definido na sessão
if (!isset($_SESSION['username'])) {
    // Se não estiver definido, redireciona para a página de login ou faça alguma outra ação adequada
    header("Location: LoginAdmin.php"); // Redireciona para a página de login
    exit(); // Encerra o script para garantir que nada mais seja executado
}

// Função para Apagar Utilizador
function deleteUtilizador($id)
{
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SITE";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Query para Apagar o Utilizador
    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Utilizador  Apagado com sucesso.";
    } else {
        echo "Erro ao apagar Utilizador: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}

// Função para Apagar empresa
function deleteEmpresa($NIF)
{
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SITE";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Query para Apagar a empresa
    $sql = "DELETE FROM empresa WHERE NIF = $NIF";

    if ($conn->query($sql) === TRUE) {
        echo "Empresa excluída com sucesso.";
    } else {
        echo "Erro ao Apagar empresa: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}

// Função para Apagar anúncio
function deleteAnuncio($id)
{
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SITE";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Query para Apagar o anúncio
    $sql = "DELETE FROM anuncios WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Anúncio Apagado com sucesso.";
    } else {
        echo "Erro ao Apagar anúncio: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}

// Se o formulário de exclusão de usuário foi submetido
if (isset($_POST['deleteUtilizador'])) {
    deleteUtilizador($_POST['id']);
}

// Se o formulário de exclusão de empresa foi submetido
if (isset($_POST['deleteEmpresa'])) {
    deleteEmpresa($_POST['NIF']);
}

// Se o formulário de exclusão de anúncio foi submetido
if (isset($_POST['deleteAnuncio'])) {
    deleteAnuncio($_POST['id']);
}
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
                    </a>
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
                                $sql_utilizador = "SELECT * FROM users";
                                $result_utilizador = $conn->query($sql_utilizador);

                                if ($result_utilizador->num_rows > 0) {
                                    while ($row = $result_utilizador->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["username"] . "</td>";
                                        echo "<td>" . $row["curso"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>
                                                <form method='post'>
                                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                                    <button type='submit' class='btn btn-danger' name='deleteUtilizador'>Apagar</button>
                                                </form>
                                              </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>Nenhuma conta de usuário encontrada</td></tr>";
                                }

                                // Fecha a conexão com o banco de dados
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                                    <th>Nome da Empresa</th>
                                    <th>Descrição</th>
                                    <th>Email</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Conexão com o banco de dados
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "SITE";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
                                }

                                // Consulta para obter empresas registradas
                                $sql_empresas = "SELECT * FROM empresa";
                                $result_empresas = $conn->query($sql_empresas);

                                if ($result_empresas->num_rows > 0) {
                                    while ($row = $result_empresas->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["nome"] . "</td>";
                                        echo "<td>" . $row["Descricao"] . "</td>";
                                        echo "<td>" . $row["Email"] . "</td>";
                                        echo "<td>
                                                <form method='post'>
                                                    <input type='hidden' name='NIF' value='" . $row["NIF"] . "'>
                                                    <button type='submit' class='btn btn-danger' name='deleteEmpresa'>Apagar</button>
                                                </form>
                                              </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>Nenhuma empresa registrada encontrada</td></tr>";
                                }

                                // Fecha a conexão com o banco de dados
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Anúncios Inseridos</strong></h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Tipo de Oferta</th>
                                    <th>Carreira</th>
                                    <th>Organismo</th>
                                    <th>Data Limite</th>
                                    <th>Descrição</th>
                                    <th>curso</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Conexão com o banco de dados
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "SITE";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
                                }

                                // Consulta para obter anúncios inseridos
                                $sql_anuncios = "SELECT * FROM anuncios";
                                $result_anuncios = $conn->query($sql_anuncios);

                                if ($result_anuncios->num_rows > 0) {
                                    while ($row = $result_anuncios->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["codigo"] . "</td>";
                                        echo "<td>" . $row["tipo_de_oferta"] . "</td>";
                                        echo "<td>" . $row["carreira"] . "</td>";
                                        echo "<td>" . $row["organismo"] . "</td>";
                                        echo "<td>" . $row["data_limite"] . "</td>";
                                        echo "<td>" . $row["Descricao"] . "</td>";
                                        echo "<td>" . $row["curso_id"] . "</td>";
                                        echo "<td>
                                                <form method='post'>
                                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                                    <button type='submit' class='btn btn-danger' name='deleteAnuncio'>Apagar</button>
                                                </form>
                                              </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>Nenhum anúncio inserido encontrado</td></tr>";
                                }

                                // Fecha a conexão com o banco de dados
                                $conn->close();
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
    <script>
        function confirmDelete(userId) {
            if (confirm("Tem certeza de que deseja apagar este usuário?")) {
                // Se o usuário confirmar, envia o formulário de exclusão
                document.getElementById('deleteForm').submit();
            } else {
                // Se o usuário cancelar, não faz nada
                return false;
            }
        }
    </script>
</body>

</html>