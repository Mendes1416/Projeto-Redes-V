<?php
$title = "Página Inicial";
require(__DIR__ . '/inc/header.php');
define("NAME_DIRECORY_UPLOAD", "upload/");

// Inicie a sessão
session_start();

$entrou = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true;

// Conexão com o banco de dados usando PDO (substitua pelos seus detalhes de conexão)
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "SITE";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Defina o modo de erro do PDO como exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Configurações de paginação
    $registros_por_pagina = 5;
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $offset = ($pagina - 1) * $registros_por_pagina;

    // Consulta SQL para obter os anúncios (ajuste conforme necessário)
    $sql = "SELECT * FROM `anuncios`";

    // Verificar se há um parâmetro de pesquisa
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        // Adicionar a cláusula WHERE para filtrar os resultados
        $sql .= " WHERE tipo_de_oferta LIKE '%$search%' OR carreira LIKE '%$search%' OR organismo LIKE '%$search%'";
    }

    // Adicionar LIMIT e OFFSET para paginação
    $sql .= " LIMIT $registros_por_pagina OFFSET $offset";

    // Executar a consulta
    $result = $conn->query($sql);

    // Consulta SQL para contar o total de registros
    $sql_total = "SELECT COUNT(*) AS total FROM `anuncios`";
    $resultado_total = $conn->query($sql_total);
    $total_registros = $resultado_total->fetch(PDO::FETCH_ASSOC)['total'];

    // Número total de páginas
    $total_paginas = ceil($total_registros / $registros_por_pagina);
} catch (PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        .rounded-image {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border: 2px solid #000;
        }
    </style>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> <strong>Esen Emprego</strong></a>
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./admins/RegistarAdmin.php">Registar Admin</a></li>
                            <li><a class="dropdown-item" href="./admins/LoginAdmin.php">Login Admin</a></li>
                        </ul>
                    </li>
                </ul>

                <?php

                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    // Se estiver logado, exiba apenas o nome de usuário com um link para a página do usuário
                ?>
                    <div class="dropdown">
                        <?php
                        if ($entrou === false) {
                            echo '<a class="dropdown-item" href="login.php"><i class="fas fa-sign-in-alt"></i>Login</a>';
                        } else {
                            echo '<a href="#" class="dropdown-toggle d-flex align-items-center text-decoration-none" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
                            echo '<span class="text-muted me-2">' . $_SESSION['username'] . '</span>';
                            if ($_SESSION['empresa']) {
                                // Se for empresa, mostrar a opção de perfil e sair
                                echo '</a>';
                            } else {
                                // Se for aluno, mostrar a foto
                                if (empty($_SESSION["photo"])) $photo = "";
                                else $photo = 'uploads/' . $_SESSION["photo"];
                                echo '<div class="d-flex justify-content-center align-items-center" style="width: 50px; height: 50px; overflow: hidden; border-radius: 50%;">';
                                echo '<img src="' . $photo . '" alt="" class="img-circle" style="width: 100%; height: 100%; object-fit: cover;">';
                                echo '</div>';
                                echo '</a>';
                            }
                        ?>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <?php if ($_SESSION['empresa']) { ?>
                                    <!-- Se for empresa, mostrar a opção de perfil e sair -->
                                    <a class="dropdown-item" href="perfilEmpresa.php">Perfil</a>
                                <?php } else { ?>
                                    <!-- Se for aluno, mostrar a opção de perfil e favoritos -->
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="<?= $photo ?>" alt="" class="rounded-circle img-fluid" style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <a class="dropdown-item" href="perfil.php">Perfil</a>
                                    <a class="dropdown-item" href="Favoritos.php">Favoritos</a>
                                <?php } ?>
                                <a class="dropdown-item" href="logout.php">Sair</a>
                            </div>
                        <?php } ?>
                    </div>


                <?php } else {
                    // Se não estiver logado, exiba o dropdown de login
                ?>

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
                                echo '<th scope="row">' . $row['codigo'] . '</th>';
                                echo '<td><a class="link-light"  href="detalhes_anuncio.php?id=' . $row['id'] . '">' . $row['tipo_de_oferta'] . '</a></td>';
                                echo '<td>' . $row['carreira'] . '</td>';
                                echo '<td>' . $row['organismo'] . '</td>';
                                echo '<td>' . date('d/m/Y', strtotime($row['data_limite'])) . '</td>';
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

    <!-- Paginação abaixo da tabela -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_paginas; $i++) : ?>
                <li class="page-item <?php if ($i == $pagina) echo 'active'; ?>"><a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
        </ul>
    </nav>

    <?php
    // Verificar se está logado como empresa
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['empresa']) {
        // Se sim, exibir o link para registrar anúncios
        echo '<div class="container text-center">';
        echo '<a class="btn btn-primary" href="Registar_Anuncio.php">Registar Anúncios</a>';
        echo '</div>';
    }
    require __DIR__ . '/inc/footer.php';
    ?>

</body>

</html>
