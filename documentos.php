<?php

if(isset($_FILES['imagem'])){
    $img = $_FILES['imagem'];
    $arquivo = sanitize_filename($_FILES['imagem']['name']);
    $diretorio = 'assets/imagem_user/';
    move_uploaded_file($img['tmp_name'], $diretorio . $arquivo);

    if($diretorio.$img['name'] != $diretorio){
        $imagem = $diretorio.$img['name'];
      }
          else{ $imagem = $_POST['imagem_t'];}
}