<?php
require(__DIR__ . '/inc/header.php');
require(__DIR__ . '/inc/Navar.php');    
?>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Registo da Empresa</h2>
                        <form action="validar_Empresa.php" method="post">
                            <!-- Campos do formulário -->
                            <div class="row">
                                <div class="col">
                                    <label for="nome">Nome:</label>
                                    <input type="text" name="nome" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label for="nif">NIF:</label>
                                    <input type="number" name="nif" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="cae">CAE:</label>
                                    <input type="text" name="cae" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label for="morada">Morada:</label>
                                    <input type="text" name="morada" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="cod_postal">Código Postal:</label>
                                    <input type="text" name="cod_postal" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label for="localidade">Localidade:</label>
                                    <input type="text" name="localidade" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="descricao">Descrição:</label>
                                    <textarea name="descricao" class="form-control"></textarea>
                                </div>
                                <div class="col">
                                    <label for="tipo">Tipo:</label>
                                    <input type="text" name="tipo" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="validada">Validada:</label>
                                    <select name="validada" class="form-control">
                                        <option value=NULL selected>NULL</option>
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Registar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
