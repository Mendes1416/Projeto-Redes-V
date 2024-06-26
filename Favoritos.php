

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Adicione a biblioteca de ícones do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .fav-icon {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Anúncios Favoritos</h1>
        <div class="table-responsive">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código</th>
                                <th>Tipo de Oferta</th>
                                <th>Carreira</th>
                                <th>Organismo</th>
                                <th>Data Limite</th>
                                <th>Descrição</th>
                                <th>Favorito</th> <!-- Adicionando a coluna de Favoritos -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($favoritos as $favorito) : ?>
                                <tr>
                                    <td><?php echo $favorito['id']; ?></td>
                                    <td><?php echo $favorito['codigo']; ?></td>
                                    <td><?php echo $favorito['tipo_de_oferta']; ?></td>
                                    <td><?php echo $favorito['carreira']; ?></td>
                                    <td><?php echo $favorito['organismo']; ?></td>
                                    <td><?php echo $favorito['data_limite']; ?></td>
                                    <td><?php echo $favorito['Descricao']; ?></td>
                                    <td>
                                        <!-- Adicionando o ícone de favorito com a classe fav-icon para clicar -->
                                        <i class="bi <?php echo (in_array($favorito['id'], array_column($favoritos, 'anuncio_id'))) ? 'bi-heart-fill text-danger fav-icon' : 'bi-heart text-secondary fav-icon'; ?>" data-anuncio-id="<?php echo $favorito['id']; ?>"></i>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Lidar com o clique no ícone de favorito
            $('.fav-icon').click(function() {
                var anuncio_id = $(this).data('anuncio_id');
                // Fazer uma solicitação AJAX para adicionar/remover o anúncio dos favoritos
                $.get("Favoritos.php", { anuncio_id: anuncio_id })
                    .done(function() {
                        // Atualizar o ícone após a operação ser concluída
                        $(this).toggleClass('bi-heart bi-heart-fill text-secondary text-danger');
                    }.bind(this)); // Bind the current element to the function
            });
        });
    </script>
</body>
</html>
