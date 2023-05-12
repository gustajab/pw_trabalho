<?php
    require('verifica_sessao.php');
    require('twig_carregar.php');
    require('models/Model.php');
    require('models/Documento.php');
    require('models/Usuario.php');
    require('func/pesquisar.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $resultado = search($_POST['barra_pesquisa']);
        echo $twig->render('listagem.html', [
            'doc' => $resultado,
            ]);
    }else{

    $doc = new Documento();
    $documentos = $doc->getALL(['usuarios_id' => $_SESSION['id_usuario']]);
    echo $twig->render('listagem.html', [
        'doc' => $documentos,
        ]);
    }