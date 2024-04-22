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
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Adicionando Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="container">
            <h2>Contas de Usuários</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome de Usuário</th>
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
                            echo "<td>" . $row["id"] . "</td>";
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

        <div class="container">
            <h2>Empresas Registradas</h2>
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
                            // Adicionando ícone de lápis para editar perfil
                            echo "<td>
                                <a href='delete_empresa.php?NIF=" . $row["NIF"] . "'>Excluir</a>
                                <a href='javascript:void(0);' onclick='openEditPopup(" . $row["NIF"] . ")'><i class='bi bi-pencil'></i></a>
                              </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhuma empresa registrada encontrada</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="container">
            <h2>Anúncios Inseridos</h2>
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

    <!-- Modal de Edição da Empresa -->
    <div class="modal fade" id="editEmpresaModal" tabindex="-1" aria-labelledby="editEmpresaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmpresaModalLabel">Editar Empresa</h5>
                </div>
                <div class="modal-body">
                    <form id="editEmpresaForm" method="post" action="update_empresa.php">
                        <input type="hidden" id="editNIF" name="NIF">
                        <div class="form-group">
                            <label for="editNome">Nome da Empresa:</label>
                            <input type="text" class="form-control" id="editNome" name="nome">
                        </div>
                        <div class="form-group">
                            <label for="editDescricao">Descrição:</label>
                            <textarea class="form-control" id="editDescricao" name="descricao"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email:</label>
                            <input type="email" class="form-control" id="editEmail" name="email">
                        </div>
                        <!-- Adicione outros campos conforme necessário -->
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <button  type="close" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para abrir o pop-up -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function openEditPopup(NIF) {
            // Requisição AJAX para buscar os detalhes da empresa pelo NIF e preencher o formulário
            $.ajax({
                url: 'get_empresa_details.php',
                type: 'post',
                data: {
                    NIF: NIF
                },
                dataType: 'json',
                success: function(response) {
                    $('#editNIF').val(response.NIF);
                    $('#editNome').val(response.nome);
                    $('#editDescricao').val(response.Descricao);
                    $('#editEmail').val(response.Email);
                    // Preencha outros campos conforme necessário
                    $('#editEmpresaModal').modal('show');
                }
            });
        }

        // Função para atualizar os dados da empresa
        $('#editEmpresaForm').submit(function(e) {
            e.preventDefault(); // Impede o envio do formulário padrão
            var formData = $(this).serialize(); // Obtém os dados do formulário
            $.ajax({
                url: 'update_empresa.php',
                type: 'post',
                data: formData,
                success: function(response) {
                    // Exibe a mensagem de sucesso na página
                    alert(response);
                    // Fechar o modal após o sucesso
                    $('#editEmpresaModal').modal('hide');
                    // Atualizar a página ou fazer outras ações conforme necessário
                },
                error: function(xhr, status, error) {
                    // Se ocorrer um erro durante a requisição AJAX, exibe mensagem de erro
                    alert("Erro na requisição AJAX: " + error);
                }
            });
        });
    </script>
</body>
</html>
<?php
// Fechar conexão com o banco de dados
$conn->close();
?>
