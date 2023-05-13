<?php
        require('verifica_sessao.php');
        require('twig_carregar.php');
        require('models/Model.php');
        require('models/Documento.php');
        require('models/Usuario.php');
        require('func/pesquisar.php');
        
        if (isset($_GET['id_documento'])) {
            $idDocumento = $_GET['id_documento'];
            
            $doc = new Documento();
            $documento = $doc->getByID($idDocumento);
            
            if ($documento) {
                echo $twig->render('usuarios_autorizados.html', [
                    'doc' => [$documento],
                ]);
            } else {
                echo "Documento não encontrado.";
            }
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $resultado = search($_POST['barra_pesquisa']);
                echo $twig->render('usuarios_autorizados.html', [
                    'doc' => $resultado,
                ]);
            } else {
                $doc = new Documento();
                $documentos = $doc->getALL(['usuarios_id' => $_SESSION['id_usuario']]);
                echo $twig->render('usuarios_autorizados.html', [
                    'doc' => $documentos,
                ]);
            }
        }
    ?>
    