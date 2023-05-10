<?php
    require('verifica_sessao.php');
    require('twig_carregar.php');
    require('models/Model.php');
    require('models/Documento.php');
    require('models/Usuario.php');

   
    $doc = new Documento();
    $documentos = $doc->getALL(['usuarios_id' => $_SESSION['nome']]);
    echo $twig->render('listagem.html', [
        'doc' => $documentos,
        ]);