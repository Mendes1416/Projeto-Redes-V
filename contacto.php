<?php
 

?>
<!-- loading modal --->
<div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loadingModal">Loading</h5>
            </div>
            <div class="modal-body">
                A sua requisição está a ser enviada...
            </div>
        </div>
    </div>
</div>


<title>Plataforma</title>
<!-- Conteúdo específico da página Plataforma -->
<div class="animcontainer">
    <section class="py-5 text-center container">
        <div class="row py-lg-5 text-light">
        <div class="col-lg-6 col-md-8 mx-auto" data-aos="fade-down">
            <h1 class="fw-light">Plataforma</h1>
            <p class="lead">Queres requisitar o pocket school para implementar na tua escola? <br> Este é o sítio certo.
                Preenche o seguinte formulário e vais receber uma resposta no teu email.
            </p>
        </div>
        </div>
    </section>
</div>

<?php if (isset($_SESSION['username'])): ?>
<div class="container my-5">
    <h1>Requisição da versão de teste</h1>
    
    <form action="processar_req.php" method="post">
        <div class="mb-3">
            <label for="escolaNome" class="form-label">Nome do requisitante</label>
            <input type="text" class="form-control" id="escolaNome" name="escolaNome" required>
        </div>
        <div class="mb-3">
            <label for="contatoNome" class="form-label">Instituição de ensino a que pertence</label>
            <input type="text" class="form-control" id="contatoNome" name="contatoNome" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Endereço de email institucional</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Endereço de email pessoal (opcional)</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="mensagem" class="form-label">Motivo da requisição</label>
            <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loadingModal">Enviar Requisição</button>
    </form>


    <!-- Toasts -->
    <div class="position-fixed bottom-0 end-0 p-3">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto">Sucesso</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
                </div>
                <div class="toast-body">
                    <?php echo $_SESSION['success']; ?>
                </div>
            </div>
        <?php unset($_SESSION['success']); endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <script> $('#loadingModal').modal('hide'); </script>
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-danger text-white">
                    <strong class="me-auto">Erro</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
                </div>
                <div class="toast-body">
                    <?php echo $_SESSION['error']; ?>
                </div>
            </div>
        <?php unset($_SESSION['error']); endif; ?>
    </div>
    <script>
    // Fecha automaticamente as toasts após alguns segundos
    window.addEventListener('DOMContentLoaded', (event) => {
        const toasts = document.querySelectorAll('.toast');
        toasts.forEach((toast) => {
            const bsToast = new bootstrap.Toast(toast, { delay: 5000 });
            bsToast.show();
        });
    });

    </script>   

</div>

<?php else: ?>
    <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron text-center">
                <h1 class="display-4">Acesso Restrito</h1>
                <p class="lead">Tem de estar autenticado para aceder ao conteúdo desta página.</p>
                <hr class="my-4">
                <p>Faça o login ou registe-se para continuar.</p>
                <p class="lead">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Fazer Login</a>
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registerModal">Registar-se</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
    include('inc/footer.php'); 
?>