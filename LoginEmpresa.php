<?php
$title="Login da Empresa";
require(__DIR__ . '/inc/header.php');

?>

  
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container text-center border rounded p-4" style="max-width: 600px;">
       
        <h2 class="mb-4">Login da Empresa</h2>

        <form action="Validar_EmpresaLogin.php" method="post" class="col-md-6 offset-md-3">
            <!-- Campos do formulário -->
            <div class="mb-3">
                <label for="utilizador" class="form-label">Nome da Empresa, NIF ou Email:</label>
                <input type="text" name="utilizador" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>


 