<?php
    # cadastro.php
    require('twig_carregar.php');

    $erro = $_GET['erro'] ?? false;

    echo $twig->render('cadastro.html', [
        'erro' => $erro,
    ]);