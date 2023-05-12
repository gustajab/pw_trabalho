<?php
    require('verifica_sessao.php');
    require('twig_carregar.php');
    require('models/Model.php');
    require('models/Documento.php');
    require('models/Compartilhamento.php');

    $id = $_GET['view'] ?? false;    
        $doc = new Documento();
        $doc->delete($id);
            header('location: listagem.php');
        