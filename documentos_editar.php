<?php
    require('verifica_sessao.php');
    require('twig_carregar.php');
    require('func/sanitize_filename.php');
    require('func/verifica_nome_arquivo.php');
    require('models/Model.php');
    require('models/Documento.php');

    $id = $_POST['id'] ?? $_GET['view'] ?? false;
    $tipo = $_POST['tipo'] ?? $_GET['tipo'] ?? false;

    if($tipo == 'novo'){
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
    }else{

    echo $twig->render('documentos_novo.html', ['tipo' => 'edita']);

}}elseif($tipo == 'edita'){

    if($_SERVER['REQUEST_METHOD'] == 'POST' && !$_FILES['arquivo']['error']){

        if($_FILES['arquivo']['name']){

        $arquivo = sanitize_filename($_FILES['arquivo']['name']);
        $arquivo = verifica_nome_arquivo('uploads/',$arquivo);
        
        move_uploaded_file($_FILES['arquivo']['tmp_name'], 'uploads/' . $arquivo);
        $caminho = 'uploads/'.$arquivo;
        
    }else{
            $caminho = $_POST['caminho'];
        }
        $doc = new Documento();
        $doc->update([
            'nome' => $_POST['nome'],
            'caminho' => $caminho,
        ], $id);
        header('location: listagem.php');
    }else{
        $doc = new Documento();
        $documento = $doc->getById($id);  
        echo $twig->render('documentos_novo.html', ['tipo' => 'edita', 'doc' => $documento]);   
    }
}
