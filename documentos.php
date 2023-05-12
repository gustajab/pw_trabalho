<?php
    require('verifica_sessao.php');
    require('twig_carregar.php');
    require('models/Model.php');
    require('models/Documento.php');

    $id = $_POST['view'] ?? $_GET['view'] ?? false;



    if($_SERVER['REQUEST_METHOD'] == 'POST' && !$_FILES['arquivo']['error']){

        $arquivo = sanitize_filename($_FILES['arquivo']['name']);

        $arquivo = verifica_nome_arquivo('uploads/',$arquivo);
        
        $nomeDoc = 'uploads/'.$arquivo;
        
        move_uploaded_file($_FILES['arquivo']['tmp_name'], 'uploads/' . $arquivo);

if(isset($_FILES['arquivo'])){
    $arq = $_FILES['arquivo'];
    $arquivo = sanitize_filename($_FILES['arquivo']['name']);
    $arquivo = verifica_nome_arquivo('uploads/',$arquivo);
    $nomeDoc = 'uploads/'.$arquivo;
        move_uploaded_file($_FILES['arquivo']['tmp_name'], 'uploads/' . $arquivo);

    if($diretorio.$arq['name'] != $diretorio){
        $arquivo = $diretorio.$arq['name'];
      }
          else{ $arquivo = $_POST['arquivo_t'];}
}

 $data_formatada = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['data_nasc'])));

// Redireciona para listagem
header('Location: listagem.php');
die;
}else {
// renderiza tela
$doc = new Documento();
$documento = $doc->getById(['id_documento' => $id]);

echo $twig->render('listagem.html', [
    $documento => 'documento',
      ]);
    die;
    }