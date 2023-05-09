<?php
    require('verifica_sessao.php');
    require('twig_carregar.php');
    require('models/Model.php');
    require('models/Documento.php');
    require('models/Usuario.php');

    session_start();

// Verifique se a sessão existe e se contém as informações necessárias
if (!isset($_SESSION['nome'])) {
    // Se o usuário não estiver autenticado, redirecione para a página de login
    header('Location: login.php');
    exit();
}
    $doc = new Documento();
    $documentos = $doc->getALL(['id_usuario' => $_SESSION['nome']]);
    echo $twig->render('listagem.html', [
        'doc' => $documentos,
        ]);