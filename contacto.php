?php
/*
* Bootstrap 4 carousel w/ php
*/ 
$slider = [
    [
        'img'         => 'http://dandywebsolution.com/skdslider/slides/1.jpg',
        'title'       => 'Title 1',
        'description' => 'description 1'
    ],
];
$length = count($slider);
$index = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

</head>

<body>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        <?php for ($i = 0; $i < $length; $i++): ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>"<?php echo ($index === $i ? ' class="active"' : ''); ?>></li>
        <?php endfor; ?>
        </ol>
        <div class="carousel-inner" role="listbox">
        <?php foreach ($slider as $i => $item): ?>
            <div class="carousel-item<?php echo ($index === $i ? ' active' : ''); ?>">
            <?php echo '<img class="d-block img-fluid" src="'.$item['img'].'" alt="...">'; ?>
            <?php if ($item['title'] || $item['description']): ?>
                <div class="carousel-caption d-none d-md-block">
                <?php if ($item['title']): ?>
                    <h3><?php echo $item['title']; ?></h3>
                <?php endif; ?>
                <?php if ($item['description']): ?>
                    <p><?php echo $item['description']; ?></p>
                <?php endif; ?>
                </div>
            <?php endif; ?>
            </div>
        <?php endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>

</html>