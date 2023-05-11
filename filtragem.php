<?php
require('pdo.inc.php');
require('twig_carregar.php');

// Verifica se foi enviado um termo de pesquisa
if (isset($_GET['barra_pesquisa'])) {
    // Recebe o termo de pesquisa e remove espaços em branco extras
    $barra_pesquisa = trim($_GET['barra_pesquisa']);

    // Conecta-se ao banco de dados e executa a consulta
    $conexao = new PDO('mysql:host=localhost;dbname=gerenciamento_de_docs', 'root', '');
    $consulta = $conexao->prepare("SELECT * FROM documentos WHERE nome LIKE :item");
    $consulta->bindValue(':item', "%$barra_pesquisa%", PDO::PARAM_STR);
    $consulta->execute();

    // Recupera os resultados da pesquisa
    $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Exibe os resultados na página
    if (count($resultados) > 0) {
        foreach ($resultados as $resultado) {
            echo $resultado['nome'] . "<br>";
           
        }
    } else {
        echo "Nenhum resultado encontrado.";
    }
}

header('location: listagem.php');
die;



