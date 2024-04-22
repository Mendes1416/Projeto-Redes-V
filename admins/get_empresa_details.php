<?php
// Verifica se o NIF foi recebido via POST
if (isset($_POST['NIF'])) {
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SITE";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Prepara e executa a consulta SQL para obter os detalhes da empresa pelo NIF
    $NIF = $_POST['NIF'];
    $sql = "SELECT * FROM empresa WHERE NIF = '$NIF'";
    $result = $conn->query($sql);

    if ($result) {
        // Verifica se encontrou alguma empresa
        if ($result->num_rows > 0) {
            // Retorna os detalhes da primeira empresa encontrada como JSON
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            echo json_encode(array('error' => 'Empresa não encontrada.'));
        }
    } else {
        echo json_encode(array('error' => 'Erro na consulta SQL: ' . $conn->error));
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    // Se o NIF não foi recebido, retorna uma mensagem de erro
    echo json_encode(array('error' => 'NIF não recebido.'));
}
?>
