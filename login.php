<?php
    # login.php
    require('twig_carregar.php');

    $erro = $_GET['erro'] ?? false;

    echo $twig->render('index.html', [
        'erro' => $erro,
    ]);