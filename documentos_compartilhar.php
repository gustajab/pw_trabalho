<?php
    require('verifica_sessao.php');
    require('twig_carregar.php');
    require('models/Model.php');
    require('models/Compartilhamento.php');
    require('models/Usuario.php');

    if (isset($_GET['id_documento'])) {
        $idDocumento = $_GET['id_documento'];
        // Restante do código para buscar e exibir o documento específico
    }
    
    $id = $_GET['id'] ?? false;    
    $id_documento = $_GET['id_documento'] ?? false;
    $tipo = $_GET['tipo'] ?? false;
    if($tipo == 'visualizar'){
    
        $doc = new Compartilhamento();
        $doc->create([
            'id_documento' => $id_documento,
            'usuarios_compartilhados_id' => $id,
            'visualizar' => '1',
            'excluir' => '0',
        ]);
            header('location: listagem.php');
    }elseif($tipo == 'excluir'){
     
          
        $doc = new Compartilhamento();
        $doc->create([
            'id_documento' => $id_documento,
            'usuarios_compartilhados_id' => $id,
            'visualizar' => '1',
            'excluir' => '1',
        ]);
            header('location: listagem.php');
        }
else{
    $user = new Usuario();
    $usuarios = $user->getALL();

    
    echo $twig->render('usuarios.html', [
        'user' => $usuarios,
        'id_documento' => $id_documento
        ]);

}