<?php
$title="Página Inicial";
require(__DIR__ . '/inc/header.php');

// Inicie a sessão
session_start();

// Conexão com o banco de dados usando PDO (substitua pelos seus detalhes de conexão)
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "site";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Defina o modo de erro do PDO como exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Consulta SQL para obter os anúncios (ajuste conforme necessário)
    $sql = "SELECT * FROM `anuncios`;";
    $result = $conn->query($sql);
} catch (PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
}

// Definir a variável de consulta SQL
$sql = "SELECT * FROM `anuncios`";

// Verificar se há um parâmetro de pesquisa
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    // Adicionar a cláusula WHERE para filtrar os resultados
    $sql .= " WHERE tipo_de_oferta LIKE '%$search%' OR carreira LIKE '%$search%' OR organismo LIKE '%$search%'";
}

try {
    // Executar a consulta
    $result = $conn->query($sql);
} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> Oferta de Emprego</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Empresa
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="Registar_empresa.php">Registrar Empresa</a></li>
                        <li><a class="dropdown-item" href="LoginEmpresa.php">Login Empresa</a></li>
                        <li><a class="dropdown-item" href="Registar_Anuncio.php">Registar Anúncios</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ajuda
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Página de Suporte</a></li>
                        <li><a class="dropdown-item" href="#">FAQ</a></li>
                        <li><a class="dropdown-item" href="contacto.php">Contato</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sobre</a></li>
                    </ul>
                </li>
            </ul>

            <?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    // Se estiver logado, exiba apenas o nome de usuário com um link para a página do usuário
?>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['username']; ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="loginDropdown">
            <!-- <img class="img-circule" height="75" data-ng-src= -->
            <a class="dropdown-item" href="<?= $_SESSION['empresa'] ? 'perfilEmpresa.php' : 'perfil.php' ?>">Perfil</a>
            <a class="dropdown-item" href="Favoritos.php"> Favoritos</a>
            <a class="dropdown-item" href="logout.php">Sair</a>
        </div>
    </div>
<?php } else {
    // Se não estiver logado, exiba o dropdown de login
?>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <!-- Substitua "Login" pelo texto desejado para o botão -->
            Login
        </button>
        <div class="dropdown-menu" aria-labelledby="loginDropdown">
            <form class="px-3 py-1" method="post" action="config.php">
                <a for="login" href="login.php">login</a>
            </form>
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Registo.php">És novo aqui? Regista-te</a>
            <a class="dropdown-item" href="reset-password.php">Esqueceste da senha?</a>
        </div>
    </div>
<?php } ?>

        </div>
    </div>
</nav>

<div class="container text-center">
    <div class="mx-auto">
        <h2>Pesquisar Ofertas de Emprego</h2>
        <form action="" method="get">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar ofertas...">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </form>
        <br>
        <table class="table table-dark table-striped-columns">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Código</th>
                    <th scope="col">Tipo de Oferta</th>
                    <th scope="col">Carreira</th>
                    <th scope="col">Organismo</th>
                    <th scope="col">Data Limite</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Verificar se há resultados da consulta
                    if ($result->rowCount() > 0) {
                        // Iterar sobre os resultados e preencher as linhas da tabela
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<th scope="row">' . $row['id'] . '</th>';
                            echo '<th scope="row">' . $row['codigo'] . '</th>';
                            echo '<td><a class="link-light"  href="detalhes_anuncio.php?id=' . $row['id'] . '">' . $row['tipo_de_oferta'] . '</a></td>';
                            echo '<td>' . $row['carreira'] . '</td>';
                            echo '<td>' . $row['organismo'] . '</td>';
                            echo '<td>' . $row['data_limite'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        // Se não houver resultados, exibir uma mensagem
                        echo '<tr><td colspan="6">Sem anúncios disponíveis.</td></tr>';
                    }
                } catch (PDOException $e) {
                    echo "Erro na consulta: " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require __DIR__ . '/inc/footer.php';
?>