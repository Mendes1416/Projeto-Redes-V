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

// Verifique se o NIF da empresa foi fornecido
if (isset($_GET['NIF'])) {
    $NIF = $_GET['NIF'];
    
    // Consulta para obter os detalhes da empresa com base no NIF
    $sql_empresa = "SELECT * FROM empresa WHERE NIF = '$NIF'";
    $result_empresa = $conn->query($sql_empresa);
    
    if ($result_empresa->num_rows > 0) {
        $empresa = $result_empresa->fetch_assoc();
    } else {
        echo "Empresa não encontrada.";
    }
} else {
    echo "NIF da empresa não fornecido.";
}

// Fechar conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empresa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Editar Empresa</h2>
    <form>
        <div class="form-group">
            <label for="nome">Nome da Empresa:</label>
            <input type="text" class="form-control" id="nome" value="<?php echo $empresa['nome']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" rows="3" readonly><?php echo $empresa['Descricao']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" value="<?php echo $empresa['Email']; ?>" readonly>
        </div>
        <!-- Adicione outros campos conforme necessário -->
        <button type="button" class="btn btn-primary" onclick="window.close()">Fechar</button>
    </form>
</div>

</body>
</html>
