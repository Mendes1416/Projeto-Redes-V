<?php
require(__DIR__ . '/inc/Navar.php');    
// Conexão com o banco de dados (substitua pelos seus detalhes de conexão)
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "site";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Defina o modo de erro do PDO como exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se todos os campos obrigatórios foram preenchidos
    $campos_obrigatorios = array('nif', 'cae', 'nome', 'email', 'morada', 'cod_postal', 'localidade', 'password', 'validada');
    foreach ($campos_obrigatorios as $campo) {
        if (empty($_POST[$campo])) {
            throw new Exception("Por favor, preencha todos os campos obrigatórios.");
        }
    }

    // Obtém os dados do formulário
    $nif = $_POST['nif'];
    $cae = $_POST['cae'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $morada = $_POST['morada'];
    $cod_postal = $_POST['cod_postal'];
    $localidade = $_POST['localidade'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $validada = $_POST['validada'];

     

    // Prepara a consulta para inserir os dados na tabela empresas
    $stmt = $conn->prepare("INSERT INTO empresa (NIF, CAE, nome, Email, Morada, Cod_postal, Localidade, Descricao, Tipo, Password, Validada) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Executa a consulta
    $stmt->execute([$nif, $cae, $nome, $email, $morada, $cod_postal, $localidade, $descricao, $tipo, $password, $validada]);

    echo "Registo da empresa realizado com sucesso.";

    // Redireciona para o index
    header("Location: index.php");
    exit(); // Certifique-se de sair após o redirecionamento

} catch (PDOException $e) {
    echo "Erro ao registar empresa: " . $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}
// Fecha a conexão com o banco de dados
$conn = null;
?>
