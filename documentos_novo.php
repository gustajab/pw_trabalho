<?php
    require('verifica_sessao.php');
    require('twig_carregar.php');
    require('func/sanitize_filename.php');
    require('func/verifica_nome_arquivo.php');
    require('models/Model.php');
    require('models/Documento.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST' && !$_FILES['arquivo']['error']){

        $arquivo = sanitize_filename($_FILES['arquivo']['name']);

        $arquivo = verifica_nome_arquivo('uploads/',$arquivo);
        
        $caminho = 'uploads/'.$arquivo;
        
        move_uploaded_file($_FILES['arquivo']['tmp_name'], 'uploads/' . $arquivo);

        $timezone = new DateTimeZone('America/Sao_Paulo');
        $agora = new DateTime('now', $timezone);
        $data_formatada = $agora->format('Y-m-d H:i:s');

        $doc = new Documento();
        $doc->create([
            'nome' => $_POST['nome'],
            'caminho' => $caminho,
            'usuarios_id' => $_SESSION['id_usuario'],
            'data_upload' => $data_formatada
            ]);
          
            header('location: listagem.php');
    }
    

    




    echo $twig->render('documentos_novo.html');
