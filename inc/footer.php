<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/icon.jpg">
    <title><?php if(empty($title)) echo ""; else echo $title; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body style="background-image: url('img\Footer.png'); background-size: cover; background-position: center;">
    <!-- Conteúdo da sua página aqui -->

    <script src="js/bootstrap.bundle.min.js"></script>

    <footer class="fixed-bottom bg-light py-3 border-top">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-4 mb-3 mb-md-0 text-center">
                    <img src="img\Footer.png" alt="Logo" style="width: 100px; height: auto;">
                </div>
                <div class="col-md-4 d-flex align-items-center">
                    <span class="mb-3 mb-md-0 text-muted">© 2023 prohibited from copying</span>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
